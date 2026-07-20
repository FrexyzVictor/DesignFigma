@php
  $tone = $stat['tone'] ?? 'primary';
  $toneBg = match($tone) {
      'success' => 'bg-success-bg text-success',
      'danger'  => 'bg-danger-bg text-danger',
      default   => 'bg-primary-50 text-primary',
  };
@endphp

<div class="g-card flex flex-col gap-3">
  <div class="flex items-center justify-between">
    <span class="w-9 h-9 rounded-xl flex items-center justify-center {{ $toneBg }}">
      @include('partials.icon', ['name' => $stat['icon'], 'class' => 'w-4 h-4'])
    </span>
    @if(!empty($stat['trend']))
      <span class="text-xs font-semibold {{ ($stat['trendUp'] ?? true) ? 'text-success' : 'text-danger' }}">
        {{ $stat['trend'] }}
      </span>
    @endif
  </div>
  <div>
    @if(is_numeric($stat['value']))
      <p class="text-xl lg:text-2xl font-bold text-ink leading-none" data-count-to="{{ $stat['value'] }}">0</p>
    @else
      <p class="text-xl lg:text-2xl font-bold text-ink leading-none">{{ $stat['value'] }}</p>
    @endif
    <p class="text-xs text-ink-soft mt-1">{{ $stat['label'] }}</p>
  </div>
</div>
