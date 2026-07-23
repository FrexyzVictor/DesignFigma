<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>GINTARA.NET</title>
@vite(['resources/css/app.css','resources/js/app.js'])
<style>
*{margin:0;padding:0;box-sizing:border-box;font-family:Inter,Arial,sans-serif}
body{background:linear-gradient(135deg,#eef4ff,#fff);min-height:100vh;color:#1e293b}
.container{max-width:1200px;margin:auto;padding:40px}
.hero{min-height:90vh;display:flex;align-items:center;justify-content:space-between;gap:60px}
.left,.right{flex:1}
.logo{width:220px;margin-bottom:25px}
h1{font-size:58px;line-height:1.15;margin-bottom:20px;font-weight:800}
h1 span{color:#2563eb}
p{font-size:18px;line-height:1.8;color:#64748b;max-width:560px}
.buttons{margin-top:35px;display:flex;flex-wrap:wrap;gap:16px}
.buttons a{flex:1;min-width:220px;display:flex;align-items:center;justify-content:center;padding:16px 24px;border-radius:14px;text-decoration:none;font-weight:700;transition:.3s}
.btn-primary{background:#2563eb;color:#fff;box-shadow:0 10px 25px rgba(37,99,235,.25)}
.btn-primary:hover{background:#1d4ed8;transform:translateY(-3px)}
.btn-secondary{background:#fff;color:#2563eb;border:2px solid #2563eb}
.btn-secondary:hover{background:#2563eb;color:#fff;transform:translateY(-3px)}
.btn-success{background:#10b981;color:#fff;box-shadow:0 10px 25px rgba(16,185,129,.25)}
.btn-success:hover{background:#059669;transform:translateY(-3px)}
.cards{display:grid;grid-template-columns:repeat(2,1fr);gap:20px}
.card{background:#fff;padding:25px;border-radius:20px;box-shadow:0 15px 35px rgba(0,0,0,.08);transition:.3s}
.card:hover{transform:translateY(-6px)}
.icon{width:60px;height:60px;border-radius:16px;background:#dbeafe;display:flex;align-items:center;justify-content:center;font-size:30px;margin-bottom:15px}
.card h3{margin-bottom:10px}
.card p{font-size:15px;line-height:1.7}
footer{text-align:center;padding:30px;color:#64748b}
@media(max-width:900px){
.hero{flex-direction:column;text-align:center}
.buttons{justify-content:center}
.cards{grid-template-columns:1fr}
h1{font-size:42px}
.logo{width:180px}
p{margin:auto}
}
</style>
</head>
<body>
<div class="container">
<section class="hero">
<div class="left">
<img src="{{ asset('images/logo.png') }}" class="logo" alt="Logo">
<h1>Selamat Datang di <span>GINTARA.NET</span></h1>
<p>Platform Master Data Sync untuk mengelola sinkronisasi data pelanggan, monitoring aplikasi, dan integrasi sistem secara real-time dengan tampilan modern dan mudah digunakan.</p>
<div class="buttons">
<a href="{{ route('login') }}" class="btn-primary">📊 Masuk Dashboard</a>
<a href="{{ route('customers.index') }}" class="btn-secondary">👥 Manajemen Pelanggan</a>
</div>
</div>
<div class="right">
<div class="cards">
<div class="card"><div class="icon">🔄</div><h3>Sinkronisasi Data</h3><p>Sinkronisasi pelanggan antar aplikasi secara otomatis.</p></div>
<div class="card"><div class="icon">📊</div><h3>Dashboard</h3><p>Monitoring aktivitas dan status aplikasi secara real-time.</p></div>
<div class="card"><div class="icon">👥</div><h3>Pelanggan</h3><p>Kelola data pelanggan dengan mudah dan cepat.</p></div>
<div class="card"><div class="icon">🛡️</div><h3>Keamanan</h3><p>Role Super Admin dan Admin dengan kontrol akses yang aman.</p></div>
</div>
</div>
</section>
</div>
<footer>© {{ date('Y') }} GINTARA.NET • Connect More, Empower All</footer>
</body>
</html>