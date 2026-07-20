@extends('layouts.app')
@section('title', 'Daftar Aplikasi - Gintara Net')

@section('content')

<div class="lg:flex lg:items-center lg:justify-between mb-4 lg:mb-6">
  <div>
    <p class="hidden lg:block text-sm text-ink-soft">GINTARA NET &bull; Integrasi</p>
    <h1 class="text-lg lg:text-2xl font-bold text-ink">Daftar Aplikasi</h1>
  </div>
  <a href="#" data-ripple class="g-ripple-container g-btn-primary hidden lg:inline-flex px-4 py-2.5 text-sm">
    @include('partials.icon', ['name' => 'plus', 'class' => 'w-4 h-4'])
    Tambah Aplikasi
  </a>
</div>

{{-- Tombol tambah mengambang khusus mobile — pakai `fixed` (bukan `absolute`)
     supaya posisinya selalu tetap di layar, tidak ikut "tumpah" ke elemen lain
     tergantung tinggi kontainer di atasnya. --}}
<a href="#" data-ripple
   class="g-ripple-container g-btn-primary lg:hidden fixed bottom-24 right-5 z-30 w-12 h-12 rounded-full p-0 shadow-card-lg">
  @include('partials.icon', ['name' => 'plus', 'class' => 'w-5 h-5'])
</a>

{{-- Search + filter --}}
<div class="flex items-center gap-2 mb-5">
  <label class="flex-1 flex items-center gap-2 bg-white border border-gray-100 rounded-xl px-3 py-2.5">
    @include('partials.icon', ['name' => 'search', 'class' => 'w-4 h-4 text-ink-soft'])
    <input type="text" placeholder="Cari sistem..."
           class="w-full text-sm bg-transparent outline-none placeholder:text-ink-soft/70">
  </label>
  <button type="button" class="w-11 h-11 shrink-0 rounded-xl bg-white border border-gray-100 flex items-center justify-center text-ink-soft">
    @include('partials.icon', ['name' => 'filter', 'class' => 'w-4 h-4'])
  </button>
</div>

{{-- Daftar aplikasi: 1 kolom di HP, grid beberapa kolom di layar besar --}}
<div class="flex flex-col gap-4 lg:grid lg:grid-cols-2 xl:grid-cols-3 lg:gap-5" data-stagger>
  @forelse($apps as $app)
    @include('partials.app-card', ['app' => $app])
  @empty
    <p class="text-sm text-ink-soft text-center py-10 lg:col-span-full">Belum ada aplikasi yang terhubung.</p>
  @endforelse
</div>

@endsection
