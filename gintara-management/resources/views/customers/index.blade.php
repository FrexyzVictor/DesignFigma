<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Pelanggan</title>
    @vite(['resources/css/customers.css', 'resources/js/customers.js'])
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="header-title">
                <span class="icon-box icon-box-header" aria-hidden="true">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/></svg>
                </span>
                <div>
                    <h1>Manajemen Pelanggan</h1>
                    <span class="subtitle">Kelola data pelanggan dan status koneksi PPPoE</span>
                </div>
            </div>
            <a href="#" id="add-customer-btn" class="btn-primary">
                <span class="plus-icon" aria-hidden="true">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                </span>
                Tambah Pelanggan
            </a>
        </div>

        <div class="stats">
            <div class="stat-card">
                <div class="stat-icon total" aria-hidden="true">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                </div>
                <div class="stat-info">
                    <h3>Total Pelanggan</h3>
                    <div class="number" id="total-customers">-</div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon success" aria-hidden="true">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                </div>
                <div class="stat-info">
                    <h3>Status Aktif</h3>
                    <div class="number" id="active-customers">-</div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon pending" aria-hidden="true">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                </div>
                <div class="stat-info">
                    <h3>Status Suspend</h3>
                    <div class="number" id="suspend-customers">-</div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon failed" aria-hidden="true">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>
                </div>
                <div class="stat-info">
                    <h3>Status Berhenti</h3>
                    <div class="number" id="stop-customers">-</div>
                </div>
            </div>
        </div>

        <div class="table-container">
            <div class="table-scroll">
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
                        <tr><td colspan="8" class="loading"><span class="spinner"></span>Memuat data...</td></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>