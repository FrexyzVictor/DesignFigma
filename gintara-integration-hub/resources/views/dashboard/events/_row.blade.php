@php
  $statusKey = strtolower($event->status);
  $badgeClass = match($event->status) {
      'Aktif'      => 'g-badge--success',
      'Dibatalkan' => 'g-badge--danger',
      default      => 'bg-primary-50 text-primary', // Selesai
  };
  $iconTone = match($event->status) {
      'Aktif'      => 'bg-success-bg text-success',
      'Dibatalkan' => 'bg-danger-bg text-danger',
      default      => 'bg-primary-50 text-primary', // Selesai
  };
  $statusIcon = match($event->status) {
      'Aktif'      => 'activity',
      'Dibatalkan' => 'alert-circle',
      default      => 'check', // Selesai
  };
  $tanggalFormatted = \Illuminate\Support\Carbon::parse($event->tanggal)->format('d M Y');
@endphp

{{--
  Satu markup untuk semua ukuran layar, dengan atribut data-* untuk
  pencarian & filter status langsung di browser (lihat app.js: initLiveFilter).
  - Mobile: kartu dengan ikon avatar, detail berikon, badge status pojok kanan atas.
  - Desktop (lg+): baris tabel (Event / Tanggal / Lokasi / Penyelenggara / Status / Aksi).
--}}
<div class="relative g-card lg:rounded-none lg:shadow-none lg:p-0
            lg:grid lg:grid-cols-[1.7fr_.9fr_1fr_1fr_auto_auto] lg:items-center lg:gap-4 lg:py-4
            {{ (isset($loop) && !$loop->last) ? 'lg:border-b lg:border-gray-100' : '' }}"
     data-filter-item
     data-search="{{ strtolower($event->nama.' '.$event->lokasi.' '.$event->penyelenggara) }}"
     data-status="{{ $statusKey }}">

  {{-- Badge status: pojok kanan atas di mobile, kolom tersendiri di desktop --}}
  <span class="g-badge {{ $badgeClass }} absolute top-3 right-3 lg:static lg:order-5 lg:justify-self-start">
    {{ $event->status }}
  </span>

  {{-- Ikon avatar + nama --}}
  <a href="{{ route('events.show', $event) }}" class="flex items-start gap-3 pr-20 lg:pr-0 hover:opacity-80 transition-opacity">
    <span class="w-11 h-11 rounded-xl flex items-center justify-center shrink-0 {{ $iconTone }}">
      @include('dashboard.partials.icon', ['name' => $statusIcon, 'class' => 'w-5 h-5'])
    </span>
    <div class="min-w-0">
      <p class="text-sm font-semibold text-ink truncate">{{ $event->nama }}</p>
      <p class="text-xs text-ink-soft mt-0.5">{{ $tanggalFormatted }}</p>
    </div>
  </a>

  {{-- Detail berikon: tampil di HP sebagai baris kecil, di desktop jadi kolom tabel --}}
  <p class="hidden lg:flex lg:items-center lg:gap-1.5 text-sm text-ink-soft">
    @include('dashboard.partials.icon', ['name' => 'calendar', 'class' => 'w-3.5 h-3.5 shrink-0'])
    {{ $tanggalFormatted }}
  </p>
  <p class="flex items-center gap-1.5 text-xs lg:text-sm text-ink-soft mt-2.5 lg:mt-0 truncate">
    @include('dashboard.partials.icon', ['name' => 'map-pin', 'class' => 'w-3.5 h-3.5 shrink-0'])
    {{ $event->lokasi }}
  </p>
  <p class="flex items-center gap-1.5 text-xs lg:text-sm text-ink-soft mt-1.5 lg:mt-0 truncate">
    @include('dashboard.partials.icon', ['name' => 'users', 'class' => 'w-3.5 h-3.5 shrink-0'])
    {{ $event->penyelenggara }}
  </p>

  {{-- Aksi: tombol ikon+label, konsisten dengan gaya tombol di halaman lain --}}
  <div class="flex items-center gap-2 mt-3 lg:mt-0 lg:order-6">
    <a href="{{ route('events.show', $event) }}" data-ripple
       class="g-ripple-container inline-flex items-center gap-1.5 text-xs font-semibold text-ink-soft bg-surface lg:bg-transparent lg:hover:bg-surface rounded-lg px-2.5 py-1.5 transition-colors">
      @include('dashboard.partials.icon', ['name' => 'eye', 'class' => 'w-3.5 h-3.5'])
      Lihat
    </a>
    <a href="{{ route('events.edit', $event) }}" data-ripple
       class="g-ripple-container inline-flex items-center gap-1.5 text-xs font-semibold text-primary bg-primary-50 rounded-lg px-2.5 py-1.5 transition-colors">
      @include('dashboard.partials.icon', ['name' => 'chevron-right', 'class' => 'w-3.5 h-3.5 hidden'])
      Edit
    </a>
    <form action="{{ route('events.destroy', $event) }}" method="POST"
          onsubmit="return confirm('Yakin ingin menghapus event ini?')">
      @csrf
      @method('DELETE')
      <button type="submit" data-ripple
              class="g-ripple-container inline-flex items-center gap-1.5 text-xs font-semibold text-danger bg-danger-bg rounded-lg px-2.5 py-1.5 transition-colors">
        @include('dashboard.partials.icon', ['name' => 'trash', 'class' => 'w-3.5 h-3.5'])
        Hapus
      </button>
    </form>
  </div>
</div>