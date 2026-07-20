<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pelanggan</title>

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
        }

        body{
            font-family:'Segoe UI',Tahoma,Geneva,Verdana,sans-serif;
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

        .card-header h2{
            color:#333;
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
            color:#444;
        }

        input,
        textarea,
        select{
            width:100%;
            padding:12px;
            border:1px solid #ccc;
            border-radius:6px;
            font-size:14px;
            outline:none;
        }

        input:focus,
        textarea:focus,
        select:focus{
            border-color:#667eea;
        }

        textarea{
            resize:vertical;
            min-height:100px;
        }

        .button-group{
            display:flex;
            gap:10px;
            margin-top:25px;
        }

        .btn{
            border:none;
            padding:12px 22px;
            border-radius:6px;
            cursor:pointer;
            font-size:14px;
            text-decoration:none;
            color:white;
            transition:.3s;
        }

        .btn-primary{
            background:#667eea;
        }

        .btn-primary:hover{
            background:#5568d3;
        }

        .btn-secondary{
            background:#6c757d;
        }

        .btn-secondary:hover{
            background:#5a6268;
        }

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
            <h2>Edit Pelanggan</h2>
        </div>

        <div class="card-body">

            <form action="{{ route('customers.update',$customer->id) }}" method="POST">

                @csrf
                @method('PUT')

                <div class="form-group">

                    <label>Nama</label>

                    <input
                        type="text"
                        name="nama"
                        value="{{ old('nama',$customer->nama) }}">

                    @error('nama')
                        <div class="error">{{ $message }}</div>
                    @enderror

                </div>

                <div class="form-group">

                    <label>Telepon</label>

                    <input
                        type="text"
                        name="telepon"
                        value="{{ old('telepon',$customer->telepon) }}">

                    @error('telepon')
                        <div class="error">{{ $message }}</div>
                    @enderror

                </div>

                <div class="form-group">

                    <label>Alamat</label>

                    <textarea name="alamat">{{ old('alamat',$customer->alamat) }}</textarea>

                </div>

                <div class="form-group">

                    <label>Username PPPoE</label>

                    <input
                        type="text"
                        name="pppoe_username"
                        value="{{ old('pppoe_username',$customer->pppoe_username) }}">

                </div>

                <div class="form-group">

                    <label>Status</label>

                    <select name="status">

                        <option value="aktif"
                            {{ $customer->status=='aktif'?'selected':'' }}>
                            Aktif
                        </option>

                        <option value="suspend"
                            {{ $customer->status=='suspend'?'selected':'' }}>
                            Suspend
                        </option>

                        <option value="berhenti"
                            {{ $customer->status=='berhenti'?'selected':'' }}>
                            Berhenti
                        </option>

                    </select>

                </div>

                <div class="button-group">

                    <button type="submit" class="btn btn-primary">
                        Update
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