<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Pelanggan</title>

    <link rel="stylesheet" href="{{ asset('css/customers/style.css') }}">

    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>

<body>

<div class="container">

    <div class="header">

        <div>

            <h1>Edit Pelanggan</h1>

            <p>
                Perbarui informasi pelanggan.
            </p>

        </div>

        <a href="{{ route('customers.index') }}" class="btn-primary">

            <i class="bi bi-arrow-left"></i>

            Kembali

        </a>

    </div>

    @if($errors->any())

        <div class="success" style="background:#ffe5e5;color:#d32f2f;">

            <ul style="margin-left:20px;">

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif

    <div class="table-container" style="padding:30px;">

        <form action="{{ route('customers.update', $customer->id) }}" method="POST">

            @csrf
            @method('PUT')

            <div class="form-group">

                <label>Nama Pelanggan</label>

                <input
                    type="text"
                    name="nama"
                    class="form-control"
                    value="{{ old('nama', $customer->nama) }}"
                    required>

            </div>

            <div class="form-group">

                <label>Nomor Telepon</label>

                <input
                    type="text"
                    name="telepon"
                    class="form-control"
                    value="{{ old('telepon', $customer->telepon) }}"
                    required>

            </div>

            <div class="form-group">

                <label>Alamat</label>

                <textarea
                    name="alamat"
                    class="form-control"
                    rows="4">{{ old('alamat', $customer->alamat) }}</textarea>

            </div>

            <div class="form-group">

                <label>Username PPPoE</label>

                <input
                    type="text"
                    name="pppoe_username"
                    class="form-control"
                    value="{{ old('pppoe_username', $customer->pppoe_username) }}">

            </div>

            <div class="form-group">

                <label>Status</label>

                <select name="status" class="form-control">

                    <option value="aktif"
                        {{ old('status', $customer->status) == 'aktif' ? 'selected' : '' }}>
                        Aktif
                    </option>

                    <option value="suspend"
                        {{ old('status', $customer->status) == 'suspend' ? 'selected' : '' }}>
                        Suspend
                    </option>

                    <option value="berhenti"
                        {{ old('status', $customer->status) == 'berhenti' ? 'selected' : '' }}>
                        Berhenti
                    </option>

                </select>

            </div>

            <div class="actions" style="margin-top:25px;">

                <button type="submit" class="btn-small btn-edit">

                    <i class="bi bi-check-circle"></i>

                    Update

                </button>

                <a href="{{ route('customers.index') }}" class="btn-small btn-view">

                    <i class="bi bi-arrow-left-circle"></i>

                    Kembali

                </a>

            </div>

        </form>

    </div>

</div>

</body>
</html>