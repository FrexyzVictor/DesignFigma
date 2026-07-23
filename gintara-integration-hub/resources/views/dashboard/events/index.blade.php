@extends('dashboard.layouts.app')
@section('title', 'Manajemen Event - Gintara Net')

@php
  $total = $events->count();
  $aktif = $events->where('status', 'Aktif')->count();
  $selesai = $events->where('status', 'Selesai')->count();
  $dibatalkan = $events->where('status', 'Dibatalkan')->count();
@endphp

@section('content')

<div class="lg:flex lg:items-center lg:justify-between mb-4 lg:mb-6">
  <div>
    <p class="hidden lg:block text-sm text-ink-soft">GINTARA NET &bull; Manajemen Event</p>
    <h1 class="text-lg lg:text-2xl font-bold text-ink">Manajemen Event</h1>
  </div>
  <a href="{{ route('events.create') }}" data-ripple class="g-ripple-container g-btn-primary hidden lg:inline-flex px-4 py-2.5 text-sm">
    @include('dashboard.partials.icon', ['name' => 'plus', 'class' => 'w-4 h-4'])
    Tambah Event
  </a>
  {{-- Tombol tambah mengambang khusus mobile — posisi dikunci pakai style inline
       supaya tetap benar di kanan-bawah walau ada masalah build/cache CSS. --}}
  <a href="{{ route('events.create') }}" data-ripple
     style="position:fixed; bottom:6rem; right:1.25rem; z-index:30;"
     class="g-ripple-container g-btn-primary lg:hidden w-12 h-12 rounded-full p-0 shadow-card-lg">
    @include('dashboard.partials.icon', ['name' => 'plus', 'class' => 'w-5 h-5'])
  </a>
</div>

@if(session('success'))
  <div class="g-badge g-badge--success mb-4">{{ session('success') }}</div>
@endif

{{-- Ringkasan status --}}
<div class="grid grid-cols-2 lg:grid-cols-4 gap-3 mb-6" data-stagger>
  <div class="g-card flex items-center gap-3">
    <span class="w-10 h-10 rounded-xl flex items-center justify-center shrink-0 bg-primary-50 text-primary">
      @include('dashboard.partials.icon', ['name' => 'activity', 'class' => 'w-5 h-5'])
    </span>
    <div>
      <p class="text-xl font-bold text-ink" data-count-to="{{ $total }}">0</p>
      <p class="text-xs text-ink-soft">Total Event</p>
    </div>
  </div>
  <div class="g-card flex items-center gap-3">
    <span class="w-10 h-10 rounded-xl flex items-center justify-center shrink-0 bg-success-bg text-success">
      @include('dashboard.partials.icon', ['name' => 'activity', 'class' => 'w-5 h-5'])
    </span>
    <div>
      <p class="text-xl font-bold text-success" data-count-to="{{ $aktif }}">0</p>
      <p class="text-xs text-ink-soft">Aktif</p>
    </div>
  </div>
  <div class="g-card flex items-center gap-3">
    <span class="w-10 h-10 rounded-xl flex items-center justify-center shrink-0 bg-primary-50 text-primary">
      @include('dashboard.partials.icon', ['name' => 'check', 'class' => 'w-5 h-5'])
    </span>
    <div>
      <p class="text-xl font-bold text-primary" data-count-to="{{ $selesai }}">0</p>
      <p class="text-xs text-ink-soft">Selesai</p>
    </div>
  </div>
  <div class="g-card flex items-center gap-3">
    <span class="w-10 h-10 rounded-xl flex items-center justify-center shrink-0 bg-danger-bg text-danger">
      @include('dashboard.partials.icon', ['name' => 'alert-circle', 'class' => 'w-5 h-5'])
    </span>
    <div>
      <p class="text-xl font-bold text-danger" data-count-to="{{ $dibatalkan }}">0</p>
      <p class="text-xs text-ink-soft">Dibatalkan</p>
    </div>
  </div>
</div>

<div class="g-card lg:p-0 lg:bg-transparent lg:shadow-none" data-live-filter="event-list">

  {{-- Search --}}
  <label class="flex items-center gap-2 bg-surface lg:bg-white lg:border lg:border-gray-100 rounded-xl px-3 py-2.5 mb-4">
    @include('dashboard.partials.icon', ['name' => 'search', 'class' => 'w-4 h-4 text-ink-soft'])
    <input type="text" data-live-filter-input="event-list"
           placeholder="Cari nama, lokasi, atau penyelenggara..."
           class="w-full text-sm bg-transparent outline-none placeholder:text-ink-soft/70">
  </label>

  {{-- Filter status: pill — filter langsung di sisi client, tanpa reload halaman --}}
  <div class="flex items-center gap-2 mb-4 overflow-x-auto no-scrollbar">
    @foreach(['semua' => 'Semua', 'aktif' => 'Aktif', 'selesai' => 'Selesai', 'dibatalkan' => 'Dibatalkan'] as $value => $label)
      <button type="button" data-ripple data-live-filter-pill="event-list" data-value="{{ $value }}"
        class="g-ripple-container shrink-0 px-4 py-2 rounded-full text-sm font-semibold border transition-all duration-200
               {{ $value === 'semua' ? 'bg-primary text-white border-primary' : 'bg-white text-ink-soft border-gray-100 hover:border-primary-200' }}">
        {{ $label }}
      </button>
    @endforeach
  </div>

  {{-- Header kolom: hanya tampil di desktop --}}
  <div class="hidden lg:grid lg:grid-cols-[1.7fr_.9fr_1fr_1fr_auto_auto] lg:gap-4 text-xs text-ink-soft border-y border-gray-100 px-1 py-2 mb-2">
    <span>Event</span>
    <span>Tanggal</span>
    <span>Lokasi</span>
    <span>Penyelenggara</span>
    <span>Status</span>
    <span>Aksi</span>
  </div>

  {{-- Daftar event: kartu bertumpuk di mobile, baris tabel di desktop --}}
  <div class="flex flex-col gap-3 lg:gap-0 lg:bg-white lg:rounded-card lg:shadow-card lg:px-5" data-stagger>
    @forelse($events as $event)
      @include('dashboard.events._row', ['event' => $event])
    @empty
      <div class="text-center py-12">
        @include('dashboard.partials.icon', ['name' => 'activity', 'class' => 'w-10 h-10 text-ink-soft/40 mx-auto mb-3'])
        <p class="text-sm text-ink-soft">Belum ada data event.</p>
      </div>
    @endforelse

    {{-- Muncul kalau pencarian/filter tidak menemukan hasil apa pun (bukan berarti datanya kosong) --}}
    <div data-filter-empty class="text-center py-12" style="display:none;">
      @include('dashboard.partials.icon', ['name' => 'search', 'class' => 'w-10 h-10 text-ink-soft/40 mx-auto mb-3'])
      <p class="text-sm text-ink-soft">Tidak ada event yang cocok dengan pencarian/filter ini.</p>
    </div>
  </div>

</div>

@endsection