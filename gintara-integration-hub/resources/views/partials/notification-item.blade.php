@php
  $iconTone = match($notif['tone']) {
      'success' => 'bg-success-bg text-success',
      'warning' => 'bg-warning-bg text-warning',
      'danger'  => 'bg-danger-bg text-danger',
      default   => 'bg-primary-50 text-primary',
  };
@endphp

<div class="g-card flex gap-3">
  <span class="w-10 h-10 rounded-xl flex items-center justify-center shrink-0 {{ $iconTone }}">
    @include('partials.icon', ['name' => $notif['icon'], 'class' => 'w-5 h-5'])
  </span>
  <div class="min-w-0 flex-1">
    <div class="flex items-center gap-2">
      <p class="text-sm font-semibold text-ink truncate">{{ $notif['title'] }}</p>
      @if(!$notif['read'])
        <span data-unread-dot class="w-1.5 h-1.5 rounded-full bg-primary shrink-0 transition-opacity duration-300"></span>
      @endif
    </div>
    <p class="text-sm text-ink-soft mt-0.5 leading-relaxed">{{ $notif['description'] }}</p>
    <p class="text-xs text-ink-soft/70 mt-1.5">{{ $notif['time'] }}</p>
  </div>
</div>
