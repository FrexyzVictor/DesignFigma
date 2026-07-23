<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Manajemen Pelanggan</title>

    <link rel="stylesheet" href="{{ asset('css/customers/style.css') }}">

    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>

<body>

<div class="container">

    <div class="header">

        <div>

            <h1>Manajemen Pelanggan</h1>

            <p>
                Kelola seluruh data pelanggan pada sistem.
            </p>

        </div>

        <a href="{{ route('customers.create') }}" class="btn-primary">

            <i class="bi bi-plus-circle"></i>

            Tambah Pelanggan

        </a>

    </div>

    @if(session('success'))

        <div class="success">

            {{ session('success') }}

        </div>

    @endif

    @php

        $total = $customers->count();

        $aktif = $customers->where('status','aktif')->count();

        $suspend = $customers->where('status','suspend')->count();

        $berhenti = $customers->where('status','berhenti')->count();

    @endphp

    <div class="stats">

        <div class="stat-card">

            <h3>Total Pelanggan</h3>

            <div class="number">

                {{ $total }}

            </div>

        </div>

        <div class="stat-card">

            <h3>Pelanggan Aktif</h3>

            <div class="number">

                {{ $aktif }}

            </div>

        </div>

        <div class="stat-card">

            <h3>Status Suspend</h3>

            <div class="number">

                {{ $suspend }}

            </div>

        </div>

        <div class="stat-card">

            <h3>Status Berhenti</h3>

            <div class="number">

                {{ $berhenti }}

            </div>

        </div>

    </div>

    <div class="table-container">

        <table>

            <thead>

                <tr>

                    <th>No</th>

                    <th>Nama</th>

                    <th>Telepon</th>

                    <th>Alamat</th>

                    <th>Username PPPoE</th>

                    <th>Status</th>

                    <th>Sinkronisasi</th>

                    <th style="text-align:center">
                        Aksi
                    </th>

                </tr>

            </thead>

            <tbody>

            @forelse($customers as $customer)

                <tr>

                    <td>

                        {{ $loop->iteration }}

                    </td>

                    <td>

                        <strong>

                            {{ $customer->nama }}

                        </strong>

                    </td>

                    <td>

                        {{ $customer->telepon }}

                    </td>

                    <td>

                        {{ $customer->alamat }}

                    </td>

                    <td>

                        <code>

                            {{ $customer->pppoe_username }}

                        </code>

                    </td>

                    <td>

                        <span class="status {{ strtolower($customer->status) }}">

                            {{ strtoupper($customer->status) }}

                        </span>

                    </td>

                    <td>

                        {{ $customer->sync_status }}

                    </td>

                    <td>

                        <div class="actions">

                            <button
                                class="btn-small btn-view"
                                onclick="viewCustomer({{ $customer->id }})">

                                <i class="bi bi-eye"></i>

                                Lihat

                            </button>

                            <button
                                class="btn-small btn-edit"
                                onclick="editCustomer({{ $customer->id }})">

                                <i class="bi bi-pencil-square"></i>

                                Edit

                            </button>

                            <button
                                class="btn-small btn-delete"
                                onclick="deleteCustomer({{ $customer->id }})">

                                <i class="bi bi-trash"></i>

                                Hapus

                            </button>

                        </div>

                    </td>

                </tr>
                @empty

<tr>

    <td colspan="8" class="empty-state">

        <i class="bi bi-database-x"></i>

        <p style="margin-top:15px;">

            Belum ada data pelanggan.

        </p>

    </td>

</tr>

@endforelse

</tbody>

</table>

</div>

</div>

<script>

const BASE_URL = "{{ url('customers') }}";

const CSRF_TOKEN = "{{ csrf_token() }}";

</script>

<script src="{{ asset('js/customers/script.js') }}"></script>

</body>

</html>