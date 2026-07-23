@php
  $badgeClass = match($event['status']) {
      'berhasil' => 'g-badge--success',
      'tertunda' => 'g-badge--warning',
      default    => 'g-badge--danger',
  };
  $iconTone = match($event['status']) {
      'berhasil' => 'bg-success-bg text-success',
      'tertunda' => 'bg-warning-bg text-warning',
      default    => 'bg-danger-bg text-danger',
  };
@endphp

{{--
  Satu markup untuk semua ukuran layar:
  - Mobile: kartu dengan badge status di pojok kanan atas.
  - Desktop (lg+): baris tabel (Event / Sumber / Waktu / Status / Aksi).
--}}
<div class="relative g-card lg:rounded-none lg:shadow-none lg:p-0
            lg:grid lg:grid-cols-[1.8fr_1fr_1fr_auto_auto] lg:items-center lg:gap-4 lg:py-4
            {{ (isset($loop) && !$loop->last) ? 'lg:border-b lg:border-gray-100' : '' }}">

  {{-- Badge status: pojok kanan atas di mobile, kolom tersendiri di desktop --}}
  <span class="g-badge {{ $badgeClass }} absolute top-3 right-3 lg:static lg:order-4 lg:justify-self-start">
    {{ ucfirst($event['status']) }}
  </span>

  <div class="flex items-start gap-3 pr-16 lg:pr-0">
    <span class="w-10 h-10 rounded-xl flex items-center justify-center shrink-0 {{ $iconTone }}">
      @include('dashboard.partials.icon', ['name' => $event['icon'], 'class' => 'w-5 h-5'])
    </span>
    <div class="min-w-0">
      <p class="text-sm font-semibold text-ink truncate">{{ $event['title'] }}</p>
      <p class="text-xs text-ink-soft">{{ $event['ref'] }}</p>
      <p class="text-xs text-ink-soft mt-1 lg:hidden">Sumber: {{ $event['source'] }} &bull; {{ $event['time'] }}</p>

      <button type="button"
              onclick="return confirm('Hapus event ini?')"
              class="lg:hidden inline-flex items-center gap-1 text-xs font-semibold text-danger mt-2">
        @include('dashboard.partials.icon', ['name' => 'trash', 'class' => 'w-3.5 h-3.5'])
        Hapus
      </button>
    </div>
  </div>

  <p class="hidden lg:block text-sm text-ink-soft">{{ $event['source'] }}</p>
  <p class="hidden lg:block text-sm text-ink-soft">{{ $event['time'] }}</p>

  <button type="button"
          onclick="return confirm('Hapus event ini?')"
          class="hidden lg:inline-flex items-center gap-1 text-xs font-semibold text-danger lg:order-5">
    @include('dashboard.partials.icon', ['name' => 'trash', 'class' => 'w-3.5 h-3.5'])
    Hapus
  </button>
</div>
