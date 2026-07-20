@php
  $toneBg = match($item['tone'] ?? 'primary') {
      'success' => 'bg-success-bg text-success',
      'warning' => 'bg-warning-bg text-warning',
      'danger'  => 'bg-danger-bg text-danger',
      default   => 'bg-primary-50 text-primary',
  };
@endphp

<a href="{{ $item['route'] ?? '#' }}" data-ripple
   class="g-ripple-container flex items-center gap-3 bg-white px-4 py-3 {{ ($item['type'] ?? 'link') === 'toggle' ? 'pointer-events-none' : 'hover:bg-surface/60 active:bg-surface' }} transition-colors duration-150">
  <span class="w-9 h-9 rounded-xl flex items-center justify-center shrink-0 {{ $toneBg }}">
    @include('partials.icon', ['name' => $item['icon'], 'class' => 'w-4 h-4'])
  </span>
  <span class="text-sm font-medium text-ink flex-1">{{ $item['label'] }}</span>

  @if(($item['type'] ?? 'link') === 'toggle')
    <label class="relative inline-flex items-center cursor-pointer pointer-events-auto">
      <input type="checkbox" class="sr-only peer" {{ ($item['checked'] ?? false) ? 'checked' : '' }}>
      <div class="g-toggle-track"></div>
      <div class="g-toggle-thumb"></div>
    </label>
  @else
    @include('partials.icon', ['name' => 'chevron-right', 'class' => 'w-4 h-4 text-ink-soft shrink-0'])
  @endif
</a>
