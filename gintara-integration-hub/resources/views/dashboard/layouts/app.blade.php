<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover, maximum-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title', 'Gintara Net')</title>
  <link rel="icon" type="image/png" href="{{ asset('images/Gintara.png') }}">
  <link rel="apple-touch-icon" href="{{ asset('images/Gintara.png') }}">

 
  <script>
    (function () {
      
      if (localStorage.getItem('gintara-theme') === 'dark') {
        document.documentElement.classList.add('dark');
      }
    })();
  </script>

  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-surface min-h-screen text-ink relative overflow-x-hidden">

 
  <div class="g-bg-blobs" aria-hidden="true">
    <span class="g-blob g-blob--1"></span>
    <span class="g-blob g-blob--2"></span>
    <span class="g-blob g-blob--3"></span>
    <span class="g-blob g-blob--4"></span>
  </div>

  <div class="lg:flex min-h-screen relative z-10">

    {{-- Sidebar: disembunyikan di HP, tampil mulai layar besar (lg = 1024px+) --}}
    <aside class="hidden lg:flex w-64 shrink-0 bg-white border-r border-gray-100 flex-col py-6 px-4 sticky top-0 h-screen z-10">
      <div class="flex items-center px-2 mb-8">
        <img src="{{ asset('images/logo.png') }}" alt="Gintara Net" class="h-7 w-auto">
      </div>

      <nav class="flex flex-col gap-1">
        <a href="{{ route('dashboard') }}" data-nav-link data-ripple class="g-sidebar-link g-ripple-container">
          @include('dashboard.partials.icon', ['name' => 'home', 'class' => 'w-5 h-5']) Beranda
        </a>
        <a href="{{ route('events') }}" data-nav-link data-ripple class="g-sidebar-link g-ripple-container">
          @include('dashboard.partials.icon', ['name' => 'activity', 'class' => 'w-5 h-5']) Event
        </a>
        <a href="{{ route('apps') }}" data-nav-link data-ripple class="g-sidebar-link g-ripple-container">
          @include('dashboard.partials.icon', ['name' => 'apps', 'class' => 'w-5 h-5']) Aplikasi
        </a>
        <a href="{{ route('sync-logs') }}" data-nav-link data-ripple class="g-sidebar-link g-ripple-container">
          @include('dashboard.partials.icon', ['name' => 'list', 'class' => 'w-5 h-5']) Log Sinkronisasi
        </a>
      </nav>

      <div class="mt-auto">
        <a href="{{ route('settings') }}" data-nav-link data-ripple class="g-sidebar-link g-ripple-container">
          @include('dashboard.partials.icon', ['name' => 'user', 'class' => 'w-5 h-5']) Profil
        </a>
      </div>
    </aside>

    {{-- Konten utama --}}
    <div class="flex-1 flex flex-col min-w-0 pb-24 lg:pb-0">

      {{-- Header: versi ringkas di HP (avatar+sapaan+bell), versi lengkap di desktop (search+bell+profil) --}}
      <header class="bg-white border-b border-gray-100 sticky top-0 z-30
                      px-4 py-4 flex items-center justify-between
                      lg:h-16 lg:px-8 lg:py-0">

        {{-- Sapaan + avatar: tampil penuh di HP, jadi search bar di desktop --}}
        <div class="flex items-center gap-3 lg:hidden">
          @php
            $__user = $user ?? (object) ['name' => 'Pengguna', 'avatar' => null];
            $__greeting = $greeting ?? 'Halo';
          @endphp
          <img src="{{ $__user->avatar ?? 'https://ui-avatars.com/api/?name='.urlencode($__user->name) }}"
               class="w-11 h-11 rounded-full object-cover border border-gray-100" alt="{{ $__user->name }}">
          <div>
            <p class="text-[11px] tracking-wide text-ink-soft font-medium">GINTARA NET</p>
            <p class="text-base font-bold text-ink leading-tight">{{ $__greeting }}, {{ $__user->name }}</p>
          </div>
        </div>

        <label class="hidden lg:flex items-center gap-2 bg-surface rounded-xl px-3 py-2 w-96">
          @include('dashboard.partials.icon', ['name' => 'search', 'class' => 'w-4 h-4 text-ink-soft'])
          <input type="text" placeholder="Cari integrasi atau aplikasi..."
                 class="w-full text-sm bg-transparent outline-none placeholder:text-ink-soft/70">
        </label>

        <div class="flex items-center gap-4">
          <a href="{{ route('notifications') }}" class="relative w-10 h-10 rounded-full bg-white lg:bg-surface shadow-card lg:shadow-none flex items-center justify-center text-ink-soft">
            @include('dashboard.partials.icon', ['name' => 'bell', 'class' => 'w-5 h-5'])
            <span class="absolute top-2 right-2.5 w-2 h-2 rounded-full bg-danger"></span>
          </a>
          <div class="hidden lg:flex items-center gap-2">
            <img src="{{ $__user->avatar ?? 'https://ui-avatars.com/api/?name='.urlencode($__user->name) }}"
                 class="w-9 h-9 rounded-full object-cover border border-gray-100" alt="{{ $__user->name }}">
            <div class="text-sm leading-tight">
              <p class="font-semibold text-ink">{{ $__user->name }}</p>
              <p class="text-xs text-ink-soft">Admin</p>
            </div>
          </div>
        </div>
      </header>

      <main class="flex-1 p-4 lg:p-8">
        @yield('content')
      </main>
    </div>
  </div>

  {{-- Bottom nav: tampil di HP saja, hilang otomatis di layar besar --}}
  <nav class="g-bottom-nav lg:hidden">
    <a href="{{ route('dashboard') }}" data-nav-link>
      <span class="g-nav-bubble g-ripple-container" data-ripple>
        @include('dashboard.partials.icon', ['name' => 'home', 'class' => 'w-5 h-5'])
      </span>
      Beranda
    </a>
    <a href="{{ route('events') }}" data-nav-link>
      <span class="g-nav-bubble g-ripple-container" data-ripple>
        @include('dashboard.partials.icon', ['name' => 'activity', 'class' => 'w-5 h-5'])
      </span>
      Event
    </a>
    <a href="{{ route('apps') }}" data-nav-link>
      <span class="g-nav-bubble g-ripple-container" data-ripple>
        @include('dashboard.partials.icon', ['name' => 'apps', 'class' => 'w-5 h-5'])
      </span>
      Aplikasi
    </a>
    <a href="{{ route('settings') }}" data-nav-link>
      <span class="g-nav-bubble g-ripple-container" data-ripple>
        @include('dashboard.partials.icon', ['name' => 'user', 'class' => 'w-5 h-5'])
      </span>
      Profil
    </a>
  </nav>

</body>
</html>