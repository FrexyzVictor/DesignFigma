<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $profile = [
            'name'   => $user->name ?? 'Binn Admin',
            'email'  => $user->email ?? 'admin@gintara.net',
            'avatar' => $user->avatar ?? null,
            'plan'   => 'FREE',
        ];

        $sections = [
            [
                'label' => 'Tampilan',
                'items' => [
                    [
                        'label' => 'Mode Gelap',
                        'icon' => 'moon',
                        'tone' => 'primary',
                        'type' => 'toggle',
                        'key' => 'dark_mode',
                    ],
                ],
            ],

            [
                'label' => 'Akun',
                'items' => [
                    [
                        'label' => 'Informasi Pribadi',
                        'icon' => 'user',
                        'tone' => 'primary',
                        'route' => '#',
                    ],
                    [
                        'label' => 'Preferensi Sinkronisasi',
                        'icon' => 'sync',
                        'tone' => 'primary',
                        'route' => '#',
                    ],
                ],
            ],

            [
                'label' => 'Privasi & Keamanan',
                'items' => [
                    [
                        'label' => 'Izin',
                        'icon' => 'shield',
                        'tone' => 'success',
                        'route' => '#',
                    ],
                ],
            ],

            [
                'label' => 'Notifikasi',
                'items' => [
                    [
                        'label' => 'Notifikasi Push',
                        'icon' => 'bell',
                        'tone' => 'warning',
                        'type' => 'toggle',
                        'checked' => false,
                    ],
                ],
            ],

            [
                'label' => 'Dukungan',
                'items' => [
                    [
                        'label' => 'Pusat Bantuan',
                        'icon' => 'help',
                        'tone' => 'danger',
                        'route' => '#',
                    ],
                    [
                        'label' => 'Laporkan Masalah',
                        'icon' => 'alert-circle',
                        'tone' => 'danger',
                        'route' => '#',
                    ],
                ],
            ],
        ];

        return view('dashboard.settings', [
            'user' => $user,
            'greeting' => $this->greetingByTime(),

        return view('dashboard.settings.settings', [
            'profile' => $profile,
            'sections' => $sections,

            'appVersion' => '2.4.1 (build 882)',

            'logoutRoute' => route('logout'),
        ]);
    }

    protected function greetingByTime(): string
    {
        $hour = now()->hour;

        return match (true) {
            $hour < 11 => 'Selamat Pagi',
            $hour < 15 => 'Selamat Siang',
            $hour < 18 => 'Selamat Sore',
            default => 'Selamat Malam',
        };
    }
}