<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Tambah Pelanggan</title>

    <link rel="stylesheet" href="{{ asset('css/customers/style.css') }}">

    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>

<body>

<div class="container">

    <div class="header">

        <div>

            <h1>Tambah Pelanggan</h1>

            <p>
                Tambahkan data pelanggan baru ke dalam sistem.
            </p>

        </div>

        <a href="{{ route('customers.index') }}" class="btn-primary">

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

        <form action="{{ route('customers.store') }}" method="POST">

            @csrf

            <div class="form-group">

                <label>Nama Pelanggan</label>

                <input
                    type="text"
                    name="nama"
                    class="form-control"
                    placeholder="Masukkan nama pelanggan"
                    value="{{ old('nama') }}"
                    required>

            </div>

            <div class="form-group">

                <label>Nomor Telepon</label>

                <input
                    type="text"
                    name="telepon"
                    class="form-control"
                    placeholder="08xxxxxxxxxx"
                    value="{{ old('telepon') }}"
                    required>

            </div>

            <div class="form-group">

                <label>Alamat</label>

                <textarea
                    name="alamat"
                    class="form-control"
                    placeholder="Masukkan alamat pelanggan">{{ old('alamat') }}</textarea>

            </div>

            <div class="form-group">

                <label>Username PPPoE</label>

                <input
                    type="text"
                    name="pppoe_username"
                    class="form-control"
                    placeholder="Masukkan username PPPoE"
                    value="{{ old('pppoe_username') }}">

            </div>

            <div class="button-group">

                <button type="submit" class="btn-small btn-edit">

                    <i class="bi bi-check-circle"></i>

                    Simpan

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
<<<<<<< HEAD

=======
>>>>>>> 49861d242f046c724dd80a6d6bd7a79575525042
</html>