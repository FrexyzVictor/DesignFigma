<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

/**
 * DetectDevice
 *
 * Menentukan apakah request datang dari HP (Android/iPhone/dsb) atau
 * dari PC/Laptop/Mac, lalu membagikan variabel $isMobile & $deviceView
 * ke semua view. Controller tinggal panggil:
 *
 *      return view("dashboard.{$deviceView}");
 *
 * atau langsung cek session('device') di Blade kalau perlu.
 *
 * Deteksi murni dari User-Agent (tanpa package tambahan), plus opsi
 * override manual lewat query string ?view=mobile / ?view=desktop
 * supaya gampang di-test dari laptop tanpa perlu emulator HP.
 */
class DetectDevice
{
    public function handle(Request $request, Closure $next)
    {
        // Override manual untuk testing: /dashboard?view=mobile atau ?view=desktop
        if ($request->has('view') && in_array($request->query('view'), ['mobile', 'desktop'])) {
            $request->session()->put('device_view_override', $request->query('view'));
        }

        $override = $request->session()->get('device_view_override');

        if ($override) {
            $isMobile = $override === 'mobile';
        } else {
            $isMobile = $this->isMobileUserAgent($request->userAgent() ?? '');
        }

        $deviceView = $isMobile ? 'mobile' : 'desktop';

        // Tersedia otomatis di semua Blade view: {{ $isMobile }} / {{ $deviceView }}
        View::share('isMobile', $isMobile);
        View::share('deviceView', $deviceView);

        $request->attributes->set('isMobile', $isMobile);
        $request->attributes->set('deviceView', $deviceView);

        return $next($request);
    }

    protected function isMobileUserAgent(string $userAgent): bool
    {
        // iPhone, iPad (Safari desktop-mode iPad dikecualikan sengaja karena
        // layar iPad cukup lebar untuk versi desktop, silakan sesuaikan jika
        // ingin iPad tetap dianggap mobile)
        $mobilePattern = '/Mobile|Android|iPhone|iPod|BlackBerry|IEMobile|Opera Mini/i';

        return (bool) preg_match($mobilePattern, $userAgent);
    }
}
