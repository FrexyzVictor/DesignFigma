@extends('layouts.app')
@section('title', 'Notifikasi - Gintara Net')

@section('content')

<div class="lg:max-w-2xl">

  <div class="flex items-center justify-between mb-4 lg:mb-6">
    <div>
      <p class="hidden lg:block text-sm text-ink-soft">GINTARA NET &bull; Notifikasi</p>
      <h1 class="text-lg lg:text-2xl font-bold text-ink">Notifikasi</h1>
    </div>
    <button type="button" class="w-10 h-10 rounded-full bg-white shadow-card lg:shadow-none lg:bg-surface flex items-center justify-center text-ink-soft">
      @include('partials.icon', ['name' => 'sliders', 'class' => 'w-5 h-5'])
    </button>
  </div>

  {{-- Search --}}
  <label class="g-card lg:bg-white lg:border lg:border-gray-100 flex items-center gap-2 py-2.5 mb-6">
    @include('partials.icon', ['name' => 'search', 'class' => 'w-4 h-4 text-ink-soft'])
    <input type="text" placeholder="Cari notifikasi..."
           class="w-full text-sm bg-transparent outline-none placeholder:text-ink-soft/70">
  </label>

  @forelse($groups as $groupLabel => $items)
    <div class="mb-6">
      <div class="flex items-center justify-between mb-3">
        <h2 class="text-sm font-bold text-ink">{{ $groupLabel }}</h2>
        @if($groupLabel === 'Hari Ini')
          <button type="button" data-ripple data-mark-all-read class="g-ripple-container text-xs font-semibold text-primary">Tandai semua dibaca</button>
        @endif
      </div>
      <div class="flex flex-col gap-3" data-stagger>
        @foreach($items as $notif)
          @include('partials.notification-item', ['notif' => $notif])
        @endforeach
      </div>
    </div>
  @empty
    <p class="text-sm text-ink-soft text-center py-10">Belum ada notifikasi.</p>
  @endforelse

</div>

@endsection
