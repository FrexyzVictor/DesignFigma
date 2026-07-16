<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Pelanggan</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }

        .container { max-width: 1200px; margin: 0 auto; }

        .header {
            background: white;
            padding: 20px 30px;
            border-radius: 8px;
            margin-bottom: 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header h1 { color: #333; font-size: 28px; }

        .btn-primary {
            background: #667eea;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            transition: background 0.3s;
            text-decoration: none;
            display: inline-block;
        }

        .btn-primary:hover { background: #5568d3; }

        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            text-align: center;
        }

        .stat-card h3 { color: #999; font-size: 14px; margin-bottom: 10px; }
        .stat-card .number { font-size: 32px; color: #667eea; font-weight: bold; }

        .table-container {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            overflow: hidden;
        }

        table { width: 100%; border-collapse: collapse; }

        thead { background: #f5f5f5; border-bottom: 2px solid #ddd; }
        th {
            padding: 15px;
            text-align: left;
            color: #333;
            font-weight: 600;
            font-size: 14px;
        }
        td {
            padding: 15px;
            border-bottom: 1px solid #eee;
            color: #666;
            font-size: 14px;
        }
        tbody tr:hover { background: #f9f9f9; }

        .status {
            display: inline-block;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .status.aktif { background: #d4edda; color: #155724; }
        .status.suspend { background: #fff3cd; color: #856404; }
        .status.berhenti { background: #f8d7da; color: #721c24; }

        .actions { display: flex; gap: 10px; }

        .btn-small {
            padding: 6px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 12px;
            text-decoration: none;
            display: inline-block;
            transition: opacity 0.3s;
        }

      .btn-edit,
.btn-delete,
.btn-view {
    padding: 8px 18px;
    border: 1px solid rgba(255,255,255,0.35);
    border-radius: 12px;
    color: #fff;
    font-weight: 600;
    cursor: pointer;
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.18);
    transition: all 0.3s ease;
}

/* Edit */
.btn-edit {
    background: rgba(46, 125, 50, 0.75);
}

.btn-edit:hover {
    background: rgba(46, 125, 50, 0.9);
    transform: translateY(-2px);
    box-shadow: 0 12px 25px rgba(46,125,50,0.35);
}

/* Delete */
.btn-delete {
    background: rgba(198, 40, 40, 0.75);
}

.btn-delete:hover {
    background: rgba(198, 40, 40, 0.9);
    transform: translateY(-2px);
    box-shadow: 0 12px 25px rgba(198,40,40,0.35);
}

/* View */
.btn-view {
    background: rgba(21, 101, 192, 0.75);
}

.btn-view:hover {
    background: rgba(21, 101, 192, 0.9);
    transform: translateY(-2px);
    box-shadow: 0 12px 25px rgba(21,101,192,0.35);
}

        .empty-state { text-align: center; padding: 60px 20px; color: #999; }
        .loading { text-align: center; padding: 40px; color: #667eea; }

        .success {
            background: #d4edda;
            color: #155724;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .error {
            background: #f8d7da;
            color: #721c24;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        @media (max-width: 768px) {
            .header { flex-direction: column; gap: 15px; text-align: center; }
            table { font-size: 12px; }
            th, td { padding: 10px; }
            .actions { flex-direction: column; }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>📊 Manajemen Pelanggan</h1>
            <a href="#" class="btn-primary" onclick="alert('Tambah Pelanggan - Coming Soon')">+ Tambah Pelanggan</a>
        </div>

        <div class="stats">
            <div class="stat-card">
                <h3>Total Pelanggan</h3>
                <div class="number" id="total-customers">-</div>
            </div>
            <div class="stat-card">
                <h3>Status Aktif</h3>
                <div class="number" id="active-customers">-</div>
            </div>
            <div class="stat-card">
                <h3>Status Suspend</h3>
                <div class="number" id="suspend-customers">-</div>
            </div>
            <div class="stat-card">
                <h3>Status Berhenti</h3>
                <div class="number" id="stop-customers">-</div>
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
                <tbody id="customers-body">
                    <tr><td colspan="8" class="loading">⏳ Memuat data...</td></tr>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        async function loadCustomers() {
            try {
                const response = await fetch('/api/customers');
                const data = await response.json();

                // API may return array or {data: []}
                const customers = Array.isArray(data) ? data : (data.data || []);

                displayCustomers(customers);
                updateStats(customers);
            } catch (error) {
                console.error('Error:', error);
                document.getElementById('customers-body').innerHTML =
                    '<tr><td colspan="8" style="text-align:center;color:red;">❌ Gagal memuat data</td></tr>';
            }
        }

        function displayCustomers(customers) {
            const tbody = document.getElementById('customers-body');

            if (!customers.length) {
                tbody.innerHTML = '<tr><td colspan="8" class="empty-state">Tidak ada data pelanggan</td></tr>';
                return;
            }

            tbody.innerHTML = customers.map((customer, index) => `
                <tr>
                    <td>${index + 1}</td>
                    <td><strong>${customer.nama ?? '-'}</strong></td>
                    <td>${customer.telepon ?? '-'}</td>
                    <td>${customer.alamat ?? '-'}</td>
                    <td><code>${customer.pppoe_username ?? '-'}</code></td>
                    <td>
                        <span class="status ${(customer.status ?? '').toLowerCase()}">
                            ${(customer.status ?? '').toString().toUpperCase()}
                        </span>
                    </td>
                    <td><small>${customer.sync_status ?? '-'}</small></td>
                    <td>
                        <div class="actions">
                            <button class="btn-small btn-view" onclick="viewCustomer(${customer.id})">Lihat</button>
                            <button class="btn-small btn-edit" onclick="editCustomer(${customer.id})">Edit</button>
                            <button class="btn-small btn-delete" onclick="deleteCustomer(${customer.id})">Hapus</button>
                        </div>
                    </td>
                </tr>
            `).join('');
        }

        function updateStats(customers) {
            document.getElementById('total-customers').textContent = customers.length;
            document.getElementById('active-customers').textContent = customers.filter(c => c.status === 'aktif').length;
            document.getElementById('suspend-customers').textContent = customers.filter(c => c.status === 'suspend').length;
            document.getElementById('stop-customers').textContent = customers.filter(c => c.status === 'berhenti').length;
        }

        function viewCustomer(id) { alert(`View Customer ID: ${id} - Coming Soon`); }
        function editCustomer(id) { alert(`Edit Customer ID: ${id} - Coming Soon`); }
        function deleteCustomer(id) {
            if (confirm('Yakin ingin menghapus pelanggan ini?')) {
                alert(`Delete Customer ID: ${id} - Coming Soon`);
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            loadCustomers();
            setInterval(loadCustomers, 10000);
        });
    </script>
</body>
</html>

