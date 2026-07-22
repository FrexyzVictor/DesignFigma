@extends('layouts.app')
@section('title', 'Pengaturan - Gintara Net')

@section('content')

<div class="lg:max-w-2xl">

  <div class="mb-4 lg:mb-6">
    <p class="text-xs uppercase tracking-wide text-ink-soft font-medium"></p>
    <h1 class="text-lg lg:text-2xl font-bold text-ink">Pengaturan</h1>
  </div>

  {{-- Kartu profil --}}
  <div class="g-card flex items-center gap-3 mb-6">
    <img src="{{ $profile['avatar'] ?? 'https://ui-avatars.com/api/?name='.urlencode($profile['name']) }}"
         class="w-14 h-14 rounded-full object-cover border border-gray-100 shrink-0" alt="{{ $profile['name'] }}">
    <div class="min-w-0 flex-1">
      <p class="font-semibold text-ink">{{ $profile['name'] }}</p>
      <p class="text-sm text-ink-soft truncate">{{ $profile['email'] }}</p>
    </div>
    <span class="g-badge bg-primary-50 text-primary shrink-0">{{ $profile['plan'] }}</span>
  </div>

  @foreach($sections as $section)
    <div class="mb-6">
      <p class="text-xs uppercase tracking-wide text-ink-soft font-semibold mb-2 px-1">{{ $section['label'] }}</p>
      <div class="bg-white rounded-card shadow-card overflow-hidden divide-y divide-gray-100" data-stagger>
        @foreach($section['items'] as $item)
          @include('partials.setting-item', ['item' => $item])
        @endforeach
      </div>
    </div>
  @endforeach

  {{-- Keluar --}}
  <form method="POST" action="{{ $logoutRoute ?? '#' }}">
    @csrf
    <button type="submit" data-ripple
            class="g-ripple-container w-full flex items-center justify-center gap-2 bg-danger-bg text-danger font-semibold rounded-card py-3.5 mb-4 hover:bg-danger/10 active:scale-[.99] transition-all">
      @include('partials.icon', ['name' => 'logout', 'class' => 'w-4 h-4'])
      Keluar
    </button>
  </form>

  <p class="text-center text-xs text-ink-soft/70 mb-6">Versi {{ $appVersion ?? '1.0.0' }}</p>

</div>

@endsection
