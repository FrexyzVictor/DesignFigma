<body>

<div class="container">

    <div class="header">
        <h1>📊 Manajemen Pelanggan</h1>

        <a href="{{ route('customers.create') }}" class="btn-primary">
            + Tambah Pelanggan
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
            <div class="number">{{ $total }}</div>
        </div>

        <div class="stat-card">
            <h3>Status Aktif</h3>
            <div class="number">{{ $aktif }}</div>
        </div>

        <div class="stat-card">
            <h3>Status Suspend</h3>
            <div class="number">{{ $suspend }}</div>
        </div>

        <div class="stat-card">
            <h3>Status Berhenti</h3>
            <div class="number">{{ $berhenti }}</div>
        </div>

    </div>

    <div class="table-container">

        <table>

            <thead>

                <tr>
                    <th>No</th>
                    <th>Nama Pelanggan</th>
                    <th>Telepon</th>
                    <th>Alamat</th>
                    <th>Username PPPoE</th>
                    <th>Status</th>
                    <th>Sync Status</th>
                    <th>Aksi</th>
                </tr>

            </thead>

            <tbody>

            @forelse($customers as $customer)

                <tr>

                    <td>{{ $loop->iteration }}</td>

                    <td>
                        <strong>{{ $customer->nama }}</strong>
                    </td>

                    <td>{{ $customer->telepon }}</td>

                    <td>{{ $customer->alamat }}</td>

                    <td>
                        <code>{{ $customer->pppoe_username }}</code>
                    </td>

                    <td>
                        <span class="status {{ strtolower($customer->status) }}">
                            {{ strtoupper($customer->status) }}
                        </span>
                    </td>

                    <td>{{ $customer->sync_status }}</td>

                    <td>

                        <div class="actions">

                            <button
                                class="btn-small btn-view"
                                onclick="viewCustomer({{ $customer->id }})">
                                Lihat
                            </button>

                            <button
                                class="btn-small btn-edit"
                                onclick="editCustomer({{ $customer->id }})">
                                Edit
                            </button>

                            <button
                                class="btn-small btn-delete"
                                onclick="deleteCustomer({{ $customer->id }})">
                                Hapus
                            </button>

                        </div>

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="8" class="empty-state">
                        Tidak ada data pelanggan
                    </td>

                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

</div>

<script>

function viewCustomer(id){
    window.location.href="/customers/"+id;
}

function editCustomer(id){
    window.location.href="/customers/"+id+"/edit";
}

function deleteCustomer(id){

    if(!confirm("Yakin ingin menghapus pelanggan ini?")){
        return;
    }

    const form=document.createElement("form");

    form.method="POST";
    form.action="/customers/"+id;

    const token=document.createElement("input");
    token.type="hidden";
    token.name="_token";
    token.value="{{ csrf_token() }}";

    const method=document.createElement("input");
    method.type="hidden";
    method.name="_method";
    method.value="DELETE";

    form.appendChild(token);
    form.appendChild(method);

    document.body.appendChild(form);

    form.submit();

}

</script>

</body>