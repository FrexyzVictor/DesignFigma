@php
  $statusLabel = match($app['status']) {
      'aktif'       => 'Aktif',
      'pemeliharaan'=> 'Pemeliharaan',
      default       => 'Nonaktif',
  };
  $badgeClass = match($app['status']) {
      'aktif'        => 'g-badge--success',
      'pemeliharaan' => 'g-badge--warning',
      default        => 'g-badge--danger',
  };
  $iconTone = match($app['status']) {
      'aktif'        => 'bg-primary-50 text-primary',
      'pemeliharaan' => 'bg-warning-bg text-warning',
      default        => 'bg-danger-bg text-danger',
  };
@endphp

<div class="g-card g-card--interactive flex flex-col gap-3 relative">

  <div class="flex items-start justify-between gap-2">
    <div class="flex items-center gap-3 min-w-0">
      <span class="w-11 h-11 rounded-xl flex items-center justify-center shrink-0 {{ $iconTone }}">
        @include('dashboard.partials.icon', ['name' => $app['icon'], 'class' => 'w-5 h-5'])
      </span>
      <div class="min-w-0">
        <p class="font-semibold text-sm text-ink truncate">{{ $app['name'] }}</p>
        <p class="text-xs text-ink-soft truncate">{{ $app['category'] }}</p>
      </div>
    </div>
    <span class="g-badge {{ $badgeClass }} shrink-0">{{ $statusLabel }}</span>
  </div>

  <p class="text-sm text-ink-soft leading-relaxed">{{ $app['description'] }}</p>

  <div class="flex items-center justify-between pt-2 border-t border-gray-100">
    <div class="text-xs text-ink-soft leading-tight">
      <p class="uppercase tracking-wide text-[10px]">Sinkronisasi Terakhir</p>
      <p>{{ $app['syncedAt'] }}</p>
    </div>
    <a href="{{ $app['detailRoute'] ?? '#' }}" data-ripple
       class="g-ripple-container text-xs font-semibold bg-primary-50 text-primary rounded-lg px-3 py-2 hover:bg-primary-100 active:scale-95 transition-all">
      Lihat Detail
    </a>
  </div>
</div>
