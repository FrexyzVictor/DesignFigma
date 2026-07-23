@php
  $statusLabel = match($app['status']) {
      'online'      => 'Online',
      'maintenance' => 'Pemeliharaan',
      default       => 'Offline',
  };
  $dotClass = match($app['status']) {
      'online'      => 'g-dot--online',
      'maintenance' => 'g-dot--maintenance',
      default       => 'g-dot--offline',
  };
  $textClass = match($app['status']) {
      'online'      => 'text-success',
      'maintenance' => 'text-warning',
      default       => 'text-danger',
  };
@endphp

<div class="g-card">
  <div class="flex items-center gap-2">
    <span class="g-dot {{ $dotClass }}"></span>
    <p class="font-semibold text-sm text-ink">{{ $app['name'] }}</p>
  </div>
  <p class="text-xs text-ink-soft mt-1">{{ $app['desc'] }}</p>
  <p class="text-xs font-medium mt-2 {{ $textClass }}">{{ $statusLabel }}</p>
</div>
