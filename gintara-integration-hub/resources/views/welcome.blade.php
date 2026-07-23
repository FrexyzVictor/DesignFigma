<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>GINTARA.NET</title>
@vite(['resources/css/app.css','resources/js/app.js'])
<style>
*{margin:0;padding:0;box-sizing:border-box;font-family:Inter,Arial,sans-serif}
html{scroll-behavior:smooth}
body{background:linear-gradient(135deg,#eef4ff,#fff);min-height:100vh;color:#1e293b;overflow:hidden}
body.unlocked{overflow:auto}

/* ============ SPLASH ============ */
#splash{
  position:fixed;inset:0;z-index:100;
  display:flex;flex-direction:column;align-items:center;justify-content:center;gap:22px;
  background:
    radial-gradient(700px 500px at 50% 30%, rgba(37,99,235,.35), transparent 60%),
    linear-gradient(160deg,#0c1730 0%,#101b33 45%,#16233f 100%);
  cursor:pointer;
  clip-path:circle(150% at var(--cx,50%) var(--cy,50%));
  transition:clip-path .95s cubic-bezier(.65,0,.35,1);
}
#splash.closing{clip-path:circle(0% at var(--cx,50%) var(--cy,50%));}
#splash.hidden{display:none;}

#splash::before{
  content:'';position:absolute;inset:0;opacity:.35;pointer-events:none;
  background-image:radial-gradient(rgba(255,255,255,.06) 1px, transparent 1px);
  background-size:26px 26px;
}

.splash-logo-wrap{position:relative;display:flex;align-items:center;justify-content:center}
.splash-ring{
  position:absolute;width:170px;height:170px;border-radius:50%;
  border:1.5px solid rgba(96,146,255,.35);
  animation:ringPulse 2.6s ease-out infinite;
}
.splash-ring.r2{animation-delay:.9s}
@keyframes ringPulse{
  0%{transform:scale(.6);opacity:.9}
  100%{transform:scale(1.6);opacity:0}
}

.splash-logo{
  position:relative;width:96px;height:96px;border-radius:26px;
  background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.12);
  display:flex;align-items:center;justify-content:center;
  backdrop-filter:blur(6px);
  transition:transform .35s cubic-bezier(.34,1.56,.64,1), box-shadow .35s ease;
  box-shadow:0 0 0 rgba(37,99,235,0);
}
.splash-logo:hover{transform:scale(1.06);box-shadow:0 12px 40px -8px rgba(37,99,235,.55)}
#splash.clicked .splash-logo{animation:logoPop .55s cubic-bezier(.34,1.56,.64,1)}
@keyframes logoPop{
  0%{transform:scale(1)}
  35%{transform:scale(1.22) rotate(-6deg)}
  60%{transform:scale(.92) rotate(3deg)}
  100%{transform:scale(1.35);opacity:.0}
}
.splash-logo svg{width:52px;height:52px}
#splash.clicked .splash-logo svg .door-l{animation:doorL .55s ease forwards}
#splash.clicked .splash-logo svg .door-r{animation:doorR .55s ease forwards}
@keyframes doorL{to{transform:translateX(-6px) rotate(-18deg)}}
@keyframes doorR{to{transform:translateX(6px) rotate(18deg)}}

.splash-word{font-weight:800;font-size:22px;letter-spacing:.5px;color:#fff;transition:opacity .3s ease}
.splash-word span{color:#5b8def}
.splash-tag{font-size:11.5px;letter-spacing:1.5px;color:rgba(255,255,255,.45);text-transform:uppercase;margin-top:-8px}

.splash-hint{
  display:flex;flex-direction:column;align-items:center;gap:8px;margin-top:18px;
  color:rgba(255,255,255,.55);font-size:13px;transition:opacity .25s ease;
}
#splash.clicked .splash-hint{opacity:0}
.splash-hint svg{animation:bounceHint 1.4s ease-in-out infinite}
@keyframes bounceHint{0%,100%{transform:translateY(0)}50%{transform:translateY(6px)}}

/* ============ PAGE ============ */
.container{max-width:1200px;margin:auto;padding:40px}
.hero{min-height:90vh;display:flex;align-items:center;justify-content:space-between;gap:60px}
.left,.right{flex:1}
.logo{width:220px;margin-bottom:25px}
h1{font-size:58px;line-height:1.15;margin-bottom:20px;font-weight:800}
h1 span{color:#2563eb}
p{font-size:18px;line-height:1.8;color:#64748b;max-width:560px}
.buttons{margin-top:35px;display:flex;flex-wrap:wrap;gap:16px}
.buttons a{flex:1;min-width:220px;display:flex;align-items:center;justify-content:center;gap:8px;padding:16px 24px;border-radius:14px;text-decoration:none;font-weight:700;transition:.3s;position:relative;overflow:hidden}
.btn-primary{background:#2563eb;color:#fff;box-shadow:0 10px 25px rgba(37,99,235,.25)}
.btn-primary:hover{background:#1d4ed8;transform:translateY(-3px)}
.btn-secondary{background:#fff;color:#2563eb;border:2px solid #2563eb}
.btn-secondary:hover{background:#2563eb;color:#fff;transform:translateY(-3px)}
.cards{display:grid;grid-template-columns:repeat(2,1fr);gap:20px}
.card{background:#fff;padding:25px;border-radius:20px;box-shadow:0 15px 35px rgba(0,0,0,.08);transition:transform .3s ease,box-shadow .3s ease}
.card:hover{transform:translateY(-6px);box-shadow:0 22px 45px rgba(0,0,0,.1)}
.icon{width:60px;height:60px;border-radius:16px;background:#dbeafe;display:flex;align-items:center;justify-content:center;font-size:30px;margin-bottom:15px}
.card h3{margin-bottom:10px}
.card p{font-size:15px;line-height:1.7}
footer{text-align:center;padding:30px;color:#64748b}

/* reveal-on-open animation for hero content */
.reveal-item{opacity:0;transform:translateY(22px);transition:opacity .7s cubic-bezier(.22,1,.36,1), transform .7s cubic-bezier(.22,1,.36,1)}
.reveal-item.in{opacity:1;transform:none}

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

<!-- ============ SPLASH SCREEN ============ -->
<div id="splash" role="button" tabindex="0" aria-label="Ketuk logo untuk masuk">
  <div class="splash-logo-wrap">
    <span class="splash-ring"></span>
    <span class="splash-ring r2"></span>
    <div class="splash-logo" id="splashLogo">
      {{-- Ganti dengan logo asli jika punya versi ikon saja, mis: asset('images/logo-icon.png') --}}
      <svg viewBox="0 0 32 32" fill="none">
        <path class="door-l" d="M4 6 L20 16 L4 26 Z" fill="#5b8def"/>
        <path class="door-r" d="M14 6 L28 16 L14 26" stroke="#5b8def" stroke-width="4.5" stroke-linecap="round" stroke-linejoin="round" fill="none" opacity="0.4"/>
      </svg>
    </div>
  </div>
  <div style="text-align:center">
    <p class="splash-word">GINTARA<span>.NET</span></p>
    <p class="splash-tag">Connect More, Empower All</p>
  </div>
  <div class="splash-hint">
    <span>Ketuk logo untuk masuk</span>
    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 9l6 6 6-6"/></svg>
  </div>
</div>

<!-- ============ MAIN PAGE ============ -->
<div class="container">
<section class="hero">
  <div class="left">
    <div class="reveal-item" style="transition-delay:.05s">
      <img src="{{ asset('images/logo.png') }}" class="logo" alt="Logo">
    </div>
    <h1 class="reveal-item" style="transition-delay:.14s">Selamat Datang di <span>GINTARA.NET</span></h1>
    <p class="reveal-item" style="transition-delay:.22s">Platform Master Data Sync untuk mengelola sinkronisasi data pelanggan, monitoring aplikasi, dan integrasi sistem secara real-time dengan tampilan modern dan mudah digunakan.</p>
    <div class="buttons reveal-item" style="transition-delay:.3s">
      <a href="{{ route('login') }}" class="btn-primary" id="signInBtn">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M15 3h4a2 2 0 012 2v14a2 2 0 01-2 2h-4"/><path d="M10 17l5-5-5-5"/><path d="M15 12H3"/></svg>
        Sign In
      </a>
      <a href="{{ route('customers.index') }}" class="btn-secondary">👥 Manajemen Pelanggan</a>
    </div>
  </div>
  <div class="right">
    <div class="cards">
      <div class="card reveal-item" style="transition-delay:.38s"><div class="icon">🔄</div><h3>Sinkronisasi Data</h3><p>Sinkronisasi pelanggan antar aplikasi secara otomatis.</p></div>
      <div class="card reveal-item" style="transition-delay:.46s"><div class="icon">📊</div><h3>Dashboard</h3><p>Monitoring aktivitas dan status aplikasi secara real-time.</p></div>
      <div class="card reveal-item" style="transition-delay:.54s"><div class="icon">👥</div><h3>Pelanggan</h3><p>Kelola data pelanggan dengan mudah dan cepat.</p></div>
      <div class="card reveal-item" style="transition-delay:.62s"><div class="icon">🛡️</div><h3>Keamanan</h3><p>Role Super Admin dan Admin dengan kontrol akses yang aman.</p></div>
    </div>
  </div>
</section>
</div>
<footer>© {{ date('Y') }} GINTARA.NET • Connect More, Empower All</footer>

<script>
(function(){
  const splash = document.getElementById('splash');
  const logo = document.getElementById('splashLogo');
  const revealItems = document.querySelectorAll('.reveal-item');
  let opened = false;

  function openSplash(e){
    if (opened) return;
    opened = true;

    // titik klik jadi pusat animasi iris-wipe
    const rect = logo.getBoundingClientRect();
    const cx = ((rect.left + rect.width / 2) / window.innerWidth) * 100;
    const cy = ((rect.top + rect.height / 2) / window.innerHeight) * 100;
    splash.style.setProperty('--cx', cx + '%');
    splash.style.setProperty('--cy', cy + '%');

    splash.classList.add('clicked');

    setTimeout(() => {
      splash.classList.add('closing');
    }, 260);

    splash.addEventListener('transitionend', function handler(ev){
      if (ev.propertyName !== 'clip-path') return;
      splash.classList.add('hidden');
      document.body.classList.add('unlocked');
      splash.removeEventListener('transitionend', handler);

      // stagger reveal konten hero
      revealItems.forEach(el => el.classList.add('in'));
    });
  }

  splash.addEventListener('click', openSplash);
  splash.addEventListener('keydown', (e) => {
    if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); openSplash(e); }
  });
})();
</script>
</body>
</html>