<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Otomatis tersedia di semua view yang extend layouts.app,
        // jadi tiap controller (Dashboard, Event, Aplikasi, dst) tidak perlu
        // mengulang kirim $user & $greeting sendiri-sendiri.
        View::composer('layouts.app', function ($view) {
            $user = auth()->user() ?? (object) [
                'name' => 'Diyo',
                'avatar' => null,
            ];

            $hour = now()->hour;
            $greeting = match (true) {
                $hour < 11 => 'Selamat Pagi',
                $hour < 15 => 'Selamat Siang',
                $hour < 18 => 'Selamat Sore',
                default => 'Selamat Malam',
            };

            $view->with([
                'user' => $view->getData()['user'] ?? $user,
                'greeting' => $view->getData()['greeting'] ?? $greeting,
            ]);
        });
    }
}
