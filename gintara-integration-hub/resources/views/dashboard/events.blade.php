@extends('dashboard.layouts.app')
@section('title', 'Riwayat Event - Gintara Net')

@section('content')

<div class="lg:flex lg:items-center lg:justify-between mb-4 lg:mb-6">
  <div>
    <p class="hidden lg:block text-sm text-ink-soft">GINTARA NET &bull; Riwayat Event</p>
    <h1 class="text-lg lg:text-2xl font-bold text-ink">Riwayat Event</h1>
  </div>
  <a href="#" data-ripple class="g-ripple-container g-btn-primary hidden lg:inline-flex px-4 py-2.5 text-sm">
    @include('dashboard.partials.icon', ['name' => 'plus', 'class' => 'w-4 h-4'])
    Buat Event
  </a>
  {{-- Tombol tambah floating khusus mobile — posisi dikunci pakai style inline
       (bukan cuma class Tailwind) supaya tetap benar di kanan-bawah walau
       ada masalah build/cache CSS. Tetap "fixed" = ikut diam di tempat saat discroll. --}}
  <a href="#" data-ripple
     style="position:fixed; bottom:6rem; right:1.25rem; z-index:30;"
     class="g-ripple-container g-btn-primary lg:hidden w-12 h-12 rounded-full p-0 shadow-card-lg">
    @include('dashboard.partials.icon', ['name' => 'plus', 'class' => 'w-5 h-5'])
  </a>
</div>

<div class="g-card lg:p-0 lg:bg-transparent lg:shadow-none">

  {{-- Search --}}
  <label class="flex items-center gap-2 bg-surface lg:bg-white lg:border lg:border-gray-100 rounded-xl px-3 py-2.5 mb-4">
    @include('dashboard.partials.icon', ['name' => 'search', 'class' => 'w-4 h-4 text-ink-soft'])
    <input type="text" placeholder="Cari ID atau sumber..."
           class="w-full text-sm bg-transparent outline-none placeholder:text-ink-soft/70">
  </label>

  {{-- Filter status: pill tabs --}}
  <div class="flex items-center gap-2 mb-4 overflow-x-auto no-scrollbar" data-pill-group>
    @foreach(['Semua' => true, 'Berhasil' => false, 'Tertunda' => false, 'Gagal' => false] as $label => $active)
      <button type="button" data-ripple data-pill
        class="g-ripple-container shrink-0 px-4 py-2 rounded-full text-sm font-semibold border transition-all duration-200
               {{ $active ? 'bg-primary text-white border-primary' : 'bg-white text-ink-soft border-gray-100 hover:border-primary-200' }}">
        {{ $label }}
      </button>
    @endforeach
  </div>

  {{-- Rentang tanggal --}}
  <button type="button" class="w-full flex items-center justify-between bg-white border border-gray-100 rounded-xl px-4 py-3 mb-4 lg:mb-6 lg:w-72">
    <span class="flex items-center gap-2 text-sm text-ink">
      @include('dashboard.partials.icon', ['name' => 'calendar', 'class' => 'w-4 h-4 text-ink-soft'])
      {{ $dateRange }}
    </span>
    @include('dashboard.partials.icon', ['name' => 'chevron-down', 'class' => 'w-4 h-4 text-ink-soft'])
  </button>

  {{-- Header kolom: hanya tampil di desktop --}}
  <div class="hidden lg:grid lg:grid-cols-[1.8fr_1fr_1fr_auto_auto] lg:gap-4 text-xs text-ink-soft border-y border-gray-100 px-1 py-2 mb-2">
    <span>Event</span>
    <span>Sumber</span>
    <span>Waktu</span>
    <span>Status</span>
    <span>Aksi</span>
  </div>

  {{-- Daftar event: kartu bertumpuk di mobile, baris tabel di desktop --}}
  <div class="flex flex-col gap-3 lg:gap-0 lg:bg-white lg:rounded-card lg:shadow-card lg:px-5" data-stagger>
    @forelse($events as $event)
      @include('dashboard.partials.event-item', ['event' => $event])
    @empty
      <p class="text-sm text-ink-soft text-center py-10">Belum ada event yang tercatat.</p>
    @endforelse
  </div>

</div>

@endsection