<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pelanggan</title>

    <style>

        *{margin:0;padding:0;box-sizing:border-box;}

        body{
            font-family:'Segoe UI',sans-serif;
            background:linear-gradient(135deg,#667eea 0%,#764ba2 100%);
            min-height:100vh;
            padding:30px;
        }

        .container{
            max-width:700px;
            margin:auto;
        }

        .card{
            background:#fff;
            border-radius:10px;
            box-shadow:0 5px 15px rgba(0,0,0,.15);
            overflow:hidden;
        }

        .card-header{
            padding:20px 25px;
            border-bottom:1px solid #eee;
        }

        .card-body{
            padding:25px;
        }

        .form-group{
            margin-bottom:18px;
        }

        label{
            display:block;
            margin-bottom:8px;
            font-weight:600;
        }

        input,
        textarea{
            width:100%;
            padding:12px;
            border:1px solid #ccc;
            border-radius:6px;
            outline:none;
        }

        input:focus,
        textarea:focus{
            border-color:#667eea;
        }

        textarea{
            min-height:100px;
            resize:vertical;
        }

        .button-group{
            display:flex;
            gap:10px;
            margin-top:20px;
        }

        .btn{
            padding:12px 22px;
            border:none;
            border-radius:6px;
            cursor:pointer;
            text-decoration:none;
            color:#fff;
        }

        .btn-primary{background:#667eea;}
        .btn-primary:hover{background:#5568d3;}

        .btn-secondary{background:#6c757d;}
        .btn-secondary:hover{background:#5a6268;}

        .error{
            color:red;
            font-size:13px;
            margin-top:5px;
        }

    </style>

</head>
<body>

<div class="container">

    <div class="card">

        <div class="card-header">
            <h2>Tambah Pelanggan</h2>
        </div>

        <div class="card-body">

            <form action="{{ route('customers.store') }}" method="POST">

                @csrf

                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" name="nama" value="{{ old('nama') }}">
                    @error('nama')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Telepon</label>
                    <input type="text" name="telepon" value="{{ old('telepon') }}">
                    @error('telepon')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Alamat</label>
                    <textarea name="alamat">{{ old('alamat') }}</textarea>
                </div>

                <div class="form-group">
                    <label>Username PPPoE</label>
                    <input type="text" name="pppoe_username" value="{{ old('pppoe_username') }}">
                </div>

                <div class="button-group">

                    <button class="btn btn-primary">
                        Simpan
                    </button>

                    <a href="{{ route('customers.index') }}" class="btn btn-secondary">
                        Kembali
                    </a>

                </div>

            </form>

        </div>

    </div>

</div>

</body>
</html>