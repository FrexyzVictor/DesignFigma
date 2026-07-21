<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Detail Pelanggan</title>

    <link rel="stylesheet" href="{{ asset('css/customers/style.css') }}">

    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>

<body>

<div class="container">

    <div class="header">

        <div>

            <h1>Detail Pelanggan</h1>

            <p>
                Informasi lengkap data pelanggan.
            </p>

        </div>

        <div class="actions">

            <a href="{{ route('customers.index') }}" class="btn-small btn-view">

                <i class="bi bi-arrow-left"></i>

                Kembali

            </a>

            <a href="{{ route('customers.edit', $customer->id) }}" class="btn-small btn-edit">

                <i class="bi bi-pencil-square"></i>

                Edit

            </a>

        </div>

    </div>

    <div class="table-container">

        <table>

            <tbody>

                <tr>
                    <th width="220">ID</th>
                    <td>{{ $customer->id }}</td>
                </tr>

                <tr>
                    <th>Nama Pelanggan</th>
                    <td>{{ $customer->nama }}</td>
                </tr>

                <tr>
                    <th>Telepon</th>
                    <td>{{ $customer->telepon }}</td>
                </tr>

                <tr>
                    <th>Alamat</th>
                    <td>{{ $customer->alamat ?: '-' }}</td>
                </tr>

                <tr>
                    <th>Username PPPoE</th>
                    <td>{{ $customer->pppoe_username ?: '-' }}</td>
                </tr>

                <tr>
                    <th>Status</th>
                    <td>
                        <span class="status {{ strtolower($customer->status) }}">
                            {{ strtoupper($customer->status) }}
                        </span>
                    </td>
                </tr>

                <tr>
                    <th>Sync Status</th>
                    <td>{{ $customer->sync_status }}</td>
                </tr>

                <tr>
                    <th>Dibuat</th>
                    <td>{{ $customer->created_at }}</td>
                </tr>

                <tr>
                    <th>Terakhir Diubah</th>
                    <td>{{ $customer->updated_at }}</td>
                </tr>

            </tbody>

        </table>

    </div>

</div>

</body>
</html>