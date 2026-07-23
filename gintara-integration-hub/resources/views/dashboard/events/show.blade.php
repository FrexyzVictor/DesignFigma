@extends('dashboard.layouts.app')
@section('title', $event->nama . ' - Gintara Net')

@php
  $badgeClass = match($event->status) {
      'Aktif'      => 'g-badge--success',
      'Dibatalkan' => 'g-badge--danger',
      default      => 'bg-primary-50 text-primary', // Selesai
  };
@endphp

@section('content')

<div class="mb-4 lg:mb-6 flex items-center gap-3">
  <a href="{{ route('events.index') }}" class="w-9 h-9 rounded-xl bg-white shadow-card flex items-center justify-center text-ink-soft shrink-0">
    @include('dashboard.partials.icon', ['name' => 'chevron-left', 'class' => 'w-4 h-4'])
  </a>
  <div>
    <p class="hidden lg:block text-sm text-ink-soft">GINTARA NET &bull; Manajemen Event</p>
    <h1 class="text-lg lg:text-2xl font-bold text-ink">Detail Event</h1>
  </div>
</div>

<div class="g-card lg:max-w-xl">

  <div class="flex items-start justify-between gap-3 mb-5">
    <div class="flex items-center gap-3 min-w-0">
      <span class="w-12 h-12 rounded-xl flex items-center justify-center shrink-0 bg-primary-50 text-primary">
        @include('dashboard.partials.icon', ['name' => 'activity', 'class' => 'w-6 h-6'])
      </span>
      <div class="min-w-0">
        <p class="font-bold text-ink text-lg truncate">{{ $event->nama }}</p>
        <p class="text-xs text-ink-soft">{{ \Illuminate\Support\Carbon::parse($event->tanggal)->format('d M Y') }}</p>
      </div>
    </div>
    <span class="g-badge {{ $badgeClass }} shrink-0">{{ $event->status }}</span>
  </div>

  <dl class="grid grid-cols-2 gap-4 mb-5 pb-5 border-b border-gray-100">
    <div class="flex items-start gap-2">
      @include('dashboard.partials.icon', ['name' => 'map-pin', 'class' => 'w-4 h-4 text-ink-soft mt-0.5'])
      <div>
        <dt class="text-xs uppercase tracking-wide text-ink-soft mb-1">Lokasi</dt>
        <dd class="text-sm font-medium text-ink">{{ $event->lokasi }}</dd>
      </div>
    </div>
    <div class="flex items-start gap-2">
      @include('dashboard.partials.icon', ['name' => 'users', 'class' => 'w-4 h-4 text-ink-soft mt-0.5'])
      <div>
        <dt class="text-xs uppercase tracking-wide text-ink-soft mb-1">Penyelenggara</dt>
        <dd class="text-sm font-medium text-ink">{{ $event->penyelenggara }}</dd>
      </div>
    </div>
    <div>
      <dt class="text-xs uppercase tracking-wide text-ink-soft mb-1">Dibuat</dt>
      <dd class="text-sm font-medium text-ink">{{ $event->created_at->format('d M Y, H:i') }}</dd>
    </div>
    <div>
      <dt class="text-xs uppercase tracking-wide text-ink-soft mb-1">Terakhir Diubah</dt>
      <dd class="text-sm font-medium text-ink">{{ $event->updated_at->format('d M Y, H:i') }}</dd>
    </div>
  </dl>

  <div class="mb-6">
    <p class="text-xs uppercase tracking-wide text-ink-soft mb-1.5">Deskripsi</p>
    <p class="text-sm text-ink-soft leading-relaxed">
      {{ $event->deskripsi ?: 'Tidak ada deskripsi tambahan untuk event ini.' }}
    </p>
  </div>

  <div class="flex items-center gap-3">
    <a href="{{ route('events.edit', $event) }}" data-ripple class="g-ripple-container g-btn-primary px-4 py-2.5 text-sm">
      @include('dashboard.partials.icon', ['name' => 'chevron-right', 'class' => 'w-4 h-4 hidden'])
      Edit Event
    </a>
    <form action="{{ route('events.destroy', $event) }}" method="POST"
          onsubmit="return confirm('Yakin ingin menghapus event ini?')">
      @csrf
      @method('DELETE')
      <button type="submit" class="inline-flex items-center gap-2 text-sm font-semibold text-danger bg-danger-bg rounded-xl px-4 py-2.5">
        @include('dashboard.partials.icon', ['name' => 'trash', 'class' => 'w-4 h-4'])
        Hapus
      </button>
    </form>
  </div>

</div>

@endsection
