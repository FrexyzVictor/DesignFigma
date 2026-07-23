<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Detail Event</title>

    <link rel="stylesheet" href="{{ asset('css/event/style.css') }}">

    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>

<body>

<div class="container">

    <div class="header">

        <div>

            <h1>Detail Event</h1>

            <p>
                Informasi lengkap mengenai event.
            </p>

        </div>

        <a href="{{ route('events.index') }}" class="btn-primary">

            <i class="bi bi-arrow-left"></i>

            Kembali

        </a>

    </div>

    <div class="table-container" style="padding:30px;">

        <table>

            <tbody>

                <tr>
                    <th width="220">Nama Event</th>
                    <td>{{ $event->nama }}</td>
                </tr>

                <tr>
                    <th>Tanggal Event</th>
                    <td>{{ $event->tanggal }}</td>
                </tr>

                <tr>
                    <th>Lokasi</th>
                    <td>{{ $event->lokasi }}</td>
                </tr>

                <tr>
                    <th>Penyelenggara</th>
                    <td>{{ $event->penyelenggara }}</td>
                </tr>

                <tr>
                    <th>Status</th>
                    <td>
                        <span class="status {{ strtolower($event->status) }}">
                            {{ strtoupper($event->status) }}
                        </span>
                    </td>
                </tr>

                <tr>
                    <th>Deskripsi</th>
                    <td>
                        {{ $event->deskripsi ?? '-' }}
                    </td>
                </tr>

                <tr>
                    <th>Dibuat</th>
                    <td>{{ $event->created_at }}</td>
                </tr>

                <tr>
                    <th>Terakhir Diubah</th>
                    <td>{{ $event->updated_at }}</td>
                </tr>

            </tbody>

        </table>

        <div class="button-group" style="margin-top:30px;">

            <a href="{{ route('events.edit', $event) }}" class="btn-small btn-edit">

                <i class="bi bi-pencil-square"></i>

                Edit

            </a>

            <a href="{{ route('events.index') }}" class="btn-small btn-view">

                <i class="bi bi-arrow-left-circle"></i>

                Kembali

            </a>

        </div>

    </div>

</div>

</body>

</html>