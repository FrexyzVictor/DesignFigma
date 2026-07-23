@csrf

<div class="flex flex-col gap-4">

  <div>
    <label class="text-sm font-semibold text-ink block mb-1.5">Nama Event</label>
    <input type="text" name="nama" value="{{ old('nama', $event->nama ?? '') }}" required
           placeholder="Masukkan nama event"
           class="w-full bg-white border border-gray-100 rounded-xl px-4 py-2.5 text-sm text-ink outline-none focus:border-primary-200">
    @error('nama') <p class="text-xs text-danger mt-1">{{ $message }}</p> @enderror
  </div>

  <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
    <div>
      <label class="text-sm font-semibold text-ink block mb-1.5">Tanggal Event</label>
      <input type="date" name="tanggal" value="{{ old('tanggal', optional($event->tanggal ?? null)->format('Y-m-d') ?? $event->tanggal ?? '') }}" required
             class="w-full bg-white border border-gray-100 rounded-xl px-4 py-2.5 text-sm text-ink outline-none focus:border-primary-200">
      @error('tanggal') <p class="text-xs text-danger mt-1">{{ $message }}</p> @enderror
    </div>
    <div>
      <label class="text-sm font-semibold text-ink block mb-1.5">Status</label>
      <select name="status" required
              class="w-full bg-white border border-gray-100 rounded-xl px-4 py-2.5 text-sm text-ink outline-none focus:border-primary-200">
        @if(!isset($event))
          <option value="">Pilih Status</option>
        @endif
        @foreach(['Aktif', 'Selesai', 'Dibatalkan'] as $option)
          <option value="{{ $option }}" @selected(old('status', $event->status ?? '') === $option)>{{ $option }}</option>
        @endforeach
      </select>
      @error('status') <p class="text-xs text-danger mt-1">{{ $message }}</p> @enderror
    </div>
  </div>

  <div>
    <label class="text-sm font-semibold text-ink block mb-1.5">Lokasi</label>
    <input type="text" name="lokasi" value="{{ old('lokasi', $event->lokasi ?? '') }}" required
           placeholder="Masukkan lokasi event"
           class="w-full bg-white border border-gray-100 rounded-xl px-4 py-2.5 text-sm text-ink outline-none focus:border-primary-200">
    @error('lokasi') <p class="text-xs text-danger mt-1">{{ $message }}</p> @enderror
  </div>

  <div>
    <label class="text-sm font-semibold text-ink block mb-1.5">Penyelenggara</label>
    <input type="text" name="penyelenggara" value="{{ old('penyelenggara', $event->penyelenggara ?? '') }}" required
           placeholder="Masukkan nama penyelenggara"
           class="w-full bg-white border border-gray-100 rounded-xl px-4 py-2.5 text-sm text-ink outline-none focus:border-primary-200">
    @error('penyelenggara') <p class="text-xs text-danger mt-1">{{ $message }}</p> @enderror
  </div>

  <div>
    <label class="text-sm font-semibold text-ink block mb-1.5">Deskripsi (opsional)</label>
    <textarea name="deskripsi" rows="4" placeholder="Masukkan deskripsi event"
              class="w-full bg-white border border-gray-100 rounded-xl px-4 py-2.5 text-sm text-ink outline-none focus:border-primary-200">{{ old('deskripsi', $event->deskripsi ?? '') }}</textarea>
    @error('deskripsi') <p class="text-xs text-danger mt-1">{{ $message }}</p> @enderror
  </div>

  <div class="flex items-center gap-3 pt-2">
    <button type="submit" data-ripple class="g-ripple-container g-btn-primary px-5 py-2.5 text-sm">
      {{ $submitLabel ?? 'Simpan' }}
    </button>
    <a href="{{ isset($event) ? route('events.show', $event) : route('events.index') }}"
       class="text-sm font-semibold text-ink-soft">
      Batal
    </a>
  </div>

</div>
