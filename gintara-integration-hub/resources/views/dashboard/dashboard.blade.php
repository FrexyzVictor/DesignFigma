@extends('dashboard.layouts.app')
  @section('title', 'Beranda - Gintara Net')

  @section('content')

  {{-- Search bar khusus HP untuk Beranda (di desktop sudah ada di header) --}}
  <label class="g-card flex items-center gap-2 py-2.5 mb-4 lg:hidden">
    @include('dashboard.partials.icon', ['name' => 'search', 'class' => 'w-4 h-4 text-ink-soft'])
    <input type="text" placeholder="Cari integrasi atau aplikasi..."
          class="w-full text-sm bg-transparent outline-none placeholder:text-ink-soft/70">
  </label>

  {{-- Judul + tombol aksi cepat: baris ikon di HP, tombol berlabel di desktop --}}
  <div class="lg:flex lg:items-center lg:justify-between mb-4 lg:mb-6">
    <div class="hidden lg:block">
      <p class="text-sm text-ink-soft">GINTARA NET &bull; Ringkasan Operasional</p>
      <h1 class="text-2xl font-bold text-ink">{{ $greeting }}, {{ $user->name }}</h1>
    </div>

    {{-- Aksi Cepat: grid ikon 4 kolom di HP, jadi tombol berlabel sejajar di desktop --}}
    <h2 class="text-sm font-bold text-ink mb-3 lg:hidden">Aksi Cepat</h2>
    <div class="grid grid-cols-4 gap-3 mb-6 lg:mb-0 lg:flex lg:gap-2 lg:w-auto">
      @foreach($quickActions as $action)
        <a href="{{ $action['route'] }}"
          class="flex flex-col items-center gap-1.5
                  lg:flex-row lg:gap-2 lg:bg-white lg:border lg:border-gray-100 lg:shadow-card lg:rounded-xl lg:px-4 lg:py-2.5 lg:text-sm lg:font-medium lg:hover:border-primary-100 lg:hover:text-primary lg:transition">
          <span class="w-12 h-12 rounded-2xl bg-white shadow-card flex items-center justify-center text-primary
                        lg:w-auto lg:h-auto lg:shadow-none lg:bg-transparent lg:rounded-none">
            @include('dashboard.partials.icon', ['name' => $action['icon'], 'class' => 'w-5 h-5 lg:w-4 lg:h-4'])
          </span>
          <span class="text-[11px] text-ink-soft text-center leading-tight lg:text-sm lg:text-ink">{{ $action['label'] }}</span>
        </a>
      @endforeach
    </div>
  </div>

  {{-- Stats: 2 kolom di HP, 4 kolom sejajar di desktop --}}
  <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 lg:gap-4 mb-6 lg:mb-8" data-stagger>
    @foreach($stats as $stat)
      @include('dashboard.partials.stat-card', ['stat' => $stat])
    @endforeach
  </div>

  {{-- Dari sini: satu kolom di HP (ditumpuk), dua kolom di desktop (log lebih lebar + status di samping) --}}
  <div class="lg:grid lg:grid-cols-3 lg:gap-6">

    {{-- Kegiatan Terbaru --}}
    <div class="lg:col-span-2 order-2 lg:order-1">
      <div class="flex items-center justify-between mb-2 lg:mb-0">
        <h2 class="text-sm lg:text-base font-bold text-ink lg:px-5 lg:pt-5">Kegiatan Terbaru</h2>
        <a href="#" class="text-xs font-semibold text-primary lg:hidden">Lihat Semua</a>
      </div>

      <div class="g-card lg:p-0 lg:overflow-hidden">
        <a href="#" class="hidden lg:block text-xs font-semibold text-primary text-right px-5 pt-2">Lihat Semua Log</a>

        {{-- Header kolom: hanya tampil di desktop, meniru tabel --}}
        <div class="hidden lg:grid lg:grid-cols-[1.6fr_1fr_1fr_auto] lg:gap-4 text-xs text-ink-soft border-y border-gray-100 px-5 py-2 mt-3">
          <span>Kegiatan</span>
          <span>Sumber</span>
          <span>Waktu</span>
          <span>Status</span>
        </div>

        <div class="divide-y divide-gray-100 lg:divide-y-0 lg:px-5">
          @foreach($activities as $item)
            @include('dashboard.partials.activity-item', ['item' => $item])
          @endforeach
        </div>
      </div>
    </div>

    {{-- Status Aplikasi --}}
    <div class="order-1 lg:order-2 mb-6 lg:mb-0">
      <div class="flex items-center justify-between mb-3">
        <h2 class="text-sm lg:text-base font-bold text-ink">Status Aplikasi</h2>
        <button data-action="refresh" data-ripple class="g-ripple-container text-xs font-semibold text-primary flex items-center gap-1">
          Segarkan Semua
          <span data-refresh-icon>@include('dashboard.partials.icon', ['name' => 'refresh', 'class' => 'w-3.5 h-3.5'])</span>
        </button>
      </div>
      <div class="grid grid-cols-2 gap-3">
        @foreach($apps as $app)
          @include('dashboard.partials.status-card', ['app' => $app])
        @endforeach
      </div>
    </div>

  </div>

  @endsection 