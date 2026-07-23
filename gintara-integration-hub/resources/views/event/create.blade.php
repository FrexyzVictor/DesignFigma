<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Tambah Event</title>

    <link rel="stylesheet" href="{{ asset('css/event/style.css') }}">

    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>

<body>

<div class="container">

    <div class="header">

        <div>

            <h1>Tambah Event</h1>

            <p>
                Tambahkan data event baru ke dalam sistem.
            </p>

        </div>

        <a href="{{ route('events.index') }}" class="btn-primary">

            <i class="bi bi-arrow-left"></i>

            Kembali

        </a>

    </div>

    @if($errors->any())

        <div class="error">

            <ul style="margin-left:20px;">

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif

    <div class="table-container" style="padding:30px;">

        <form action="{{ route('events.store') }}" method="POST">

            @csrf

            <div class="form-group">

                <label>Nama Event</label>

                <input
                    type="text"
                    name="nama"
                    class="form-control"
                    placeholder="Masukkan nama event"
                    value="{{ old('nama') }}"
                    required>

            </div>

            <div class="form-group">

                <label>Tanggal Event</label>

                <input
                    type="date"
                    name="tanggal"
                    class="form-control"
                    value="{{ old('tanggal') }}"
                    required>

            </div>

            <div class="form-group">

                <label>Lokasi</label>

                <input
                    type="text"
                    name="lokasi"
                    class="form-control"
                    placeholder="Masukkan lokasi event"
                    value="{{ old('lokasi') }}"
                    required>

            </div>

            <div class="form-group">

                <label>Penyelenggara</label>

                <input
                    type="text"
                    name="penyelenggara"
                    class="form-control"
                    placeholder="Masukkan nama penyelenggara"
                    value="{{ old('penyelenggara') }}"
                    required>

            </div>

            <div class="form-group">

                <label>Status</label>

                <select
                    name="status"
                    class="form-control"
                    required>

                    <option value="">Pilih Status</option>

                    <option value="Aktif" {{ old('status') == 'Aktif' ? 'selected' : '' }}>
                        Aktif
                    </option>

                    <option value="Selesai" {{ old('status') == 'Selesai' ? 'selected' : '' }}>
                        Selesai
                    </option>

                    <option value="Dibatalkan" {{ old('status') == 'Dibatalkan' ? 'selected' : '' }}>
                        Dibatalkan
                    </option>

                </select>

            </div>

            <div class="form-group">

                <label>Deskripsi</label>

                <textarea
                    name="deskripsi"
                    class="form-control"
                    rows="5"
                    placeholder="Masukkan deskripsi event">{{ old('deskripsi') }}</textarea>

            </div>

            <div class="button-group">

                <button type="submit" class="btn-small btn-edit">

                    <i class="bi bi-check-circle"></i>

                    Simpan

                </button>

                <a href="{{ route('events.index') }}" class="btn-small btn-view">

                    <i class="bi bi-arrow-left-circle"></i>

                    Kembali

                </a>

            </div>

        </form>

    </div>

</div>

</body>

</html>