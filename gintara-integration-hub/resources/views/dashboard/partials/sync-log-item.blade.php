@php
  $badgeClass = match($log['status']) {
      'berhasil' => 'g-badge--success',
      'tertunda' => 'g-badge--warning',
      default    => 'g-badge--danger',
  };
  $iconTone = match($log['status']) {
      'berhasil' => 'bg-success-bg text-success',
      'tertunda' => 'bg-warning-bg text-warning',
      default    => 'bg-danger-bg text-danger',
  };
@endphp

{{--
  Satu markup untuk semua ukuran layar:
  - Mobile: kartu dengan detail bertumpuk.
  - Desktop (lg+): baris tabel (Aplikasi / Arah / Data / Durasi / Waktu / Status).
--}}
<div class="g-card lg:rounded-none lg:shadow-none lg:p-0
            lg:grid lg:grid-cols-[1.6fr_.8fr_.8fr_.8fr_1fr_auto] lg:items-center lg:gap-4 lg:py-4
            {{ (isset($loop) && !$loop->last) ? 'lg:border-b lg:border-gray-100' : '' }}">

  <div class="flex items-start justify-between gap-2 lg:contents">
    <div class="flex items-center gap-3 min-w-0">
      <span class="w-10 h-10 rounded-xl flex items-center justify-center shrink-0 {{ $iconTone }}">
        @include('dashboard.partials.icon', ['name' => $log['icon'], 'class' => 'w-5 h-5'])
      </span>
      <div class="min-w-0">
        <p class="text-sm font-semibold text-ink truncate">{{ $log['app'] }}</p>
        <p class="text-xs text-ink-soft">{{ $log['ref'] }}</p>
      </div>
    </div>
    <span class="g-badge {{ $badgeClass }} shrink-0 lg:order-6 lg:justify-self-start">{{ ucfirst($log['status']) }}</span>
  </div>

  <div class="flex items-center gap-4 mt-3 lg:mt-0 lg:contents text-xs text-ink-soft">
    <div class="lg:order-2">
      <p class="uppercase tracking-wide text-[10px] lg:hidden">Arah</p>
      <p class="text-ink lg:text-ink-soft font-medium lg:font-normal">{{ $log['direction'] }}</p>
    </div>
    <div class="lg:order-3">
      <p class="uppercase tracking-wide text-[10px] lg:hidden">Data</p>
      <p class="text-ink lg:text-ink-soft font-medium lg:font-normal">{{ $log['records'] }} baris</p>
    </div>
    <div class="lg:order-4">
      <p class="uppercase tracking-wide text-[10px] lg:hidden">Durasi</p>
      <p class="text-ink lg:text-ink-soft font-medium lg:font-normal">{{ $log['duration'] }}</p>
    </div>
  </div>

  <p class="text-xs text-ink-soft mt-2 lg:mt-0 lg:order-5">{{ $log['time'] }}</p>
</div>
