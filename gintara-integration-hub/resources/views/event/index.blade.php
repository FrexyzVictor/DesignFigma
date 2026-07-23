<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Manajemen Event</title>

    <link rel="stylesheet" href="{{ asset('css/event/style.css') }}">

    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>

<body>

<div class="container">

    <div class="header">

        <div>

            <h1>Manajemen Event</h1>

            <p>
                Kelola seluruh data event pada sistem.
            </p>

        </div>

        <a href="{{ route('events.create') }}" class="btn-primary">

            <i class="bi bi-plus-circle"></i>

            Tambah Event

        </a>

    </div>

    @if(session('success'))

        <div class="success">

            {{ session('success') }}

        </div>

    @endif

    @php

        $total = $events->count();

        $aktif = $events->where('status','Aktif')->count();

        $selesai = $events->where('status','Selesai')->count();

        $dibatalkan = $events->where('status','Dibatalkan')->count();

    @endphp

    <div class="stats">

        <div class="stat-card">

            <h3>Total Event</h3>

            <div class="number">

                {{ $total }}

            </div>

        </div>

        <div class="stat-card">

            <h3>Aktif</h3>

            <div class="number">

                {{ $aktif }}

            </div>

        </div>

        <div class="stat-card">

            <h3>Selesai</h3>

            <div class="number">

                {{ $selesai }}

            </div>

        </div>

        <div class="stat-card">

            <h3>Dibatalkan</h3>

            <div class="number">

                {{ $dibatalkan }}

            </div>

        </div>

    </div>

    <div class="table-container">

        <table>

            <thead>

                <tr>

                    <th>No</th>

                    <th>Nama Event</th>

                    <th>Tanggal</th>

                    <th>Lokasi</th>

                    <th>Penyelenggara</th>

                    <th>Status</th>

                    <th style="text-align:center">
                        Aksi
                    </th>

                </tr>

            </thead>

            <tbody>

            @forelse($events as $event)

                <tr>

                    <td>{{ $loop->iteration }}</td>

                    <td>
                        <strong>{{ $event->nama }}</strong>
                    </td>

                    <td>{{ $event->tanggal }}</td>

                    <td>{{ $event->lokasi }}</td>

                    <td>{{ $event->penyelenggara }}</td>

                    <td>

                        <span class="status {{ strtolower($event->status) }}">

                            {{ $event->status }}

                        </span>

                    </td>

                    <td>

                        <div class="actions">

                            <a href="{{ route('events.show', $event) }}" class="btn-small btn-view">

                                <i class="bi bi-eye"></i>

                                Lihat

                            </a>

                            <a href="{{ route('events.edit', $event) }}" class="btn-small btn-edit">

                                <i class="bi bi-pencil-square"></i>

                                Edit

                            </a>

                            <form action="{{ route('events.destroy', $event) }}" method="POST"
                                onsubmit="return confirm('Yakin ingin menghapus event ini?')">

                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn-small btn-delete">

                                    <i class="bi bi-trash"></i>

                                    Hapus

                                </button>

                            </form>

                        </div>

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="7" class="empty-state">

                        <i class="bi bi-calendar-event"></i>

                        <p style="margin-top:15px;">

                            Belum ada data event.

                        </p>

                    </td>

                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

</div>

</body>

</html>