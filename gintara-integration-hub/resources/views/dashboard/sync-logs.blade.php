@extends('dashboard.layouts.app')
@section('title', 'Log Sinkronisasi - Gintara Net')

@section('content')

<div class="lg:flex lg:items-center lg:justify-between mb-4 lg:mb-6">
  <div>
    <p class="hidden lg:block text-sm text-ink-soft">GINTARA NET &bull; Integrasi</p>
    <h1 class="text-lg lg:text-2xl font-bold text-ink">Log Sinkronisasi</h1>
  </div>
  <button type="button" data-action="refresh" data-ripple
          class="g-ripple-container hidden lg:inline-flex items-center gap-2 bg-white border border-gray-100 shadow-card rounded-xl px-4 py-2.5 text-sm font-medium text-ink hover:border-primary-100 hover:text-primary transition">
    <span data-refresh-icon>@include('dashboard.partials.icon', ['name' => 'refresh', 'class' => 'w-4 h-4'])</span>
    Sinkronkan Sekarang
  </button>
</div>

<div class="g-card lg:p-0 lg:bg-transparent lg:shadow-none">

  {{-- Search --}}
  <label class="flex items-center gap-2 bg-surface lg:bg-white lg:border lg:border-gray-100 rounded-xl px-3 py-2.5 mb-4">
    @include('dashboard.partials.icon', ['name' => 'search', 'class' => 'w-4 h-4 text-ink-soft'])
    <input type="text" placeholder="Cari aplikasi atau referensi log..."
           class="w-full text-sm bg-transparent outline-none placeholder:text-ink-soft/70">
  </label>

  {{-- Filter status --}}
  <div class="flex items-center gap-2 mb-4 overflow-x-auto no-scrollbar" data-pill-group>
    @foreach(['Semua' => true, 'Berhasil' => false, 'Tertunda' => false, 'Gagal' => false] as $label => $active)
      <button type="button" data-ripple data-pill
        class="g-ripple-container shrink-0 px-4 py-2 rounded-full text-sm font-semibold border transition-all duration-200
               {{ $active ? 'bg-primary text-white border-primary' : 'bg-white text-ink-soft border-gray-100 hover:border-primary-200' }}">
        {{ $label }}
      </button>
    @endforeach
  </div>

  {{-- Ringkasan singkat --}}
  <div class="grid grid-cols-3 gap-3 mb-4 lg:mb-6">
    <div class="g-card py-3 text-center">
      <p class="text-lg font-bold text-ink">{{ $summary['total'] }}</p>
      <p class="text-[11px] text-ink-soft">Total Hari Ini</p>
    </div>
    <div class="g-card py-3 text-center">
      <p class="text-lg font-bold text-success">{{ $summary['success'] }}</p>
      <p class="text-[11px] text-ink-soft">Berhasil</p>
    </div>
    <div class="g-card py-3 text-center">
      <p class="text-lg font-bold text-danger">{{ $summary['failed'] }}</p>
      <p class="text-[11px] text-ink-soft">Gagal</p>
    </div>
  </div>

  {{-- Header kolom: hanya tampil di desktop --}}
  <div class="hidden lg:grid lg:grid-cols-[1.6fr_.8fr_.8fr_.8fr_1fr_auto] lg:gap-4 text-xs text-ink-soft border-y border-gray-100 px-1 py-2 mb-2">
    <span>Aplikasi</span>
    <span>Arah</span>
    <span>Data</span>
    <span>Durasi</span>
    <span>Waktu</span>
    <span>Status</span>
  </div>

  {{-- Daftar log: kartu bertumpuk di mobile, baris tabel di desktop --}}
  <div class="flex flex-col gap-3 lg:gap-0 lg:bg-white lg:rounded-card lg:shadow-card lg:px-5" data-stagger>
    @forelse($logs as $log)
      @include('dashboard.partials.sync-log-item', ['log' => $log])
    @empty
      <p class="text-sm text-ink-soft text-center py-10">Belum ada log sinkronisasi.</p>
    @endforelse
  </div>

</div>

@endsection