@php
  $badgeClass = match($item['status']) {
      'berhasil' => 'g-badge--success',
      'tertunda' => 'g-badge--warning',
      default    => 'g-badge--danger',
  };
  $iconTone = match($item['status']) {
      'berhasil' => 'bg-success-bg text-success',
      'tertunda' => 'bg-warning-bg text-warning',
      default    => 'bg-danger-bg text-danger',
  };
  $icon = match($item['status']) {
      'berhasil' => 'check',
      'tertunda' => 'clock',
      default    => 'alert',
  };
@endphp

{{--
  Satu markup untuk semua ukuran layar:
  - Mobile (default): flex row sederhana, ikon + teks + badge di kanan.
  - Desktop (lg+): berubah jadi grid 4 kolom yang terasa seperti baris tabel
    (Kegiatan / Sumber / Waktu / Status), tanpa perlu file/markup terpisah.
--}}
<div class="flex items-center gap-3 py-3 lg:grid lg:grid-cols-[1.6fr_1fr_1fr_auto] lg:items-center lg:gap-4
            {{ (isset($loop) && !$loop->last) ? 'border-b border-gray-100' : '' }}">

  <div class="flex items-center gap-3 min-w-0 flex-1 lg:flex-none">
    <span class="w-9 h-9 rounded-xl flex items-center justify-center shrink-0 {{ $iconTone }}">
      @include('dashboard.partials.icon', ['name' => $icon, 'class' => 'w-4 h-4'])
    </span>
    <div class="min-w-0">
      <p class="text-sm font-semibold text-ink truncate">{{ $item['title'] }}</p>
      <p class="text-xs text-ink-soft lg:hidden">Sumber: {{ $item['source'] }} &bull; {{ $item['time'] }}</p>
      <p class="text-xs text-ink-soft">{{ $item['ref'] }}</p>
    </div>
  </div>

  <p class="hidden lg:block text-sm text-ink-soft">{{ $item['source'] }}</p>
  <p class="hidden lg:block text-sm text-ink-soft">{{ $item['time'] }}</p>

  <span class="g-badge {{ $badgeClass }} shrink-0">{{ ucfirst($item['status']) }}</span>
</div>
