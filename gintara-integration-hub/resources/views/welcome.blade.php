<!-- <!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>GINTARA.NET</title>
<link rel="icon" type="image/png" href="{{ asset('images/Gintara.png') }}">
<link rel="shortcut icon" type="image/png" href="{{ asset('images/Gintara.png') }}">
<link rel="apple-touch-icon" href="{{ asset('images/Gintara.png') }}">
@vite(['resources/css/app.css','resources/js/app.js'])

{{-- Style khusus splash intro. Idealnya dipindah ke resources/css/app.css,
     ditaruh inline di sini supaya langsung jalan tanpa menyentuh file app.css kamu. --}}
<style>
  body.g-locked{ overflow:hidden; }

  #g-splash{
    position:fixed; inset:0; z-index:100;
    display:flex; flex-direction:column; align-items:center; justify-content:center; gap:22px;
    background:
      radial-gradient(700px 500px at 50% 30%, rgba(37,99,235,.35), transparent 60%),
      linear-gradient(160deg,#0c1730 0%,#101b33 45%,#16233f 100%);
    cursor:pointer;
    clip-path: circle(150% at var(--cx,50%) var(--cy,50%));
    transition: clip-path .95s cubic-bezier(.65,0,.35,1);
  }
  #g-splash.g-closing{ clip-path: circle(0% at var(--cx,50%) var(--cy,50%)); }
  #g-splash.g-hidden{ display:none; }
  #g-splash::before{
    content:''; position:absolute; inset:0; opacity:.35; pointer-events:none;
    background-image: radial-gradient(rgba(255,255,255,.06) 1px, transparent 1px);
    background-size: 26px 26px;
  }

  .g-splash-logo-wrap{ position:relative; display:flex; align-items:center; justify-content:center; }
  .g-splash-ring{
    position:absolute; width:220px; height:220px; border-radius:9999px;
    border:1.5px solid rgba(96,146,255,.35);
    animation: gRingPulse 2.6s ease-out infinite;
  }
  .g-splash-ring.g-r2{ animation-delay:.9s; }
  @keyframes gRingPulse{
    0%{ transform:scale(.55); opacity:.9; }
    100%{ transform:scale(1.5); opacity:0; }
  }

  .g-splash-logo{
    position:relative; padding:26px 34px; border-radius:24px;
    background:rgba(255,255,255,.07); border:1px solid rgba(255,255,255,.14);
    backdrop-filter:blur(6px);
    transition: transform .35s cubic-bezier(.34,1.56,.64,1), box-shadow .35s ease;
  }
  .g-splash-logo:hover{ transform:scale(1.05); box-shadow:0 16px 45px -10px rgba(37,99,235,.55); }
  .g-splash-logo img{ width:180px; height:auto; display:block; filter:drop-shadow(0 6px 18px rgba(37,99,235,.35)); }
  #g-splash.g-clicked .g-splash-logo{ animation: gLogoPop .55s cubic-bezier(.34,1.56,.64,1) forwards; }
  @keyframes gLogoPop{
    0%{ transform:scale(1); }
    35%{ transform:scale(1.14); }
    60%{ transform:scale(.94); }
    100%{ transform:scale(1.22); opacity:0; }
  }

  .g-splash-hint{
    display:flex; flex-direction:column; align-items:center; gap:8px; margin-top:6px;
    color:rgba(255,255,255,.55); font-size:13px; transition:opacity .25s ease;
  }
  #g-splash.g-clicked .g-splash-hint{ opacity:0; }
  .g-splash-hint svg{ animation: gBounceHint 1.4s ease-in-out infinite; }
  @keyframes gBounceHint{ 0%,100%{ transform:translateY(0); } 50%{ transform:translateY(6px); } }

  /* elemen hero muncul bertahap setelah splash terbuka */
  .g-reveal{ opacity:0; transform:translateY(22px); transition:opacity .7s cubic-bezier(.22,1,.36,1), transform .7s cubic-bezier(.22,1,.36,1); }
  .g-reveal.g-in{ opacity:1; transform:none; }
</style>
</head>
<body class="relative min-h-screen overflow-x-hidden bg-surface text-ink g-locked">

  {{-- ============ SPLASH INTRO ============ --}}
  <div id="g-splash" role="button" tabindex="0" aria-label="Ketuk logo untuk masuk">
    <div class="g-splash-logo-wrap">
      <span class="g-splash-ring"></span>
      <span class="g-splash-ring g-r2"></span>
      <div class="g-splash-logo" id="gSplashLogo">
        <img src="{{ asset('images/logo.png') }}" alt="Logo GINTARA.NET">
      </div>
    </div>
    <div class="g-splash-hint">
      <span>Ketuk logo untuk masuk</span>
      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 9l6 6 6-6"/></svg>
    </div>
  </div>

  {{-- Latar gelembung mengambang, dari app.css --}}
  <div class="g-bg-blobs">
    <span class="g-blob g-blob--1"></span>
    <span class="g-blob g-blob--2"></span>
    <span class="g-blob g-blob--3"></span>
    <span class="g-blob g-blob--4"></span>
  </div>

  <div class="relative z-10 max-w-6xl mx-auto px-6 py-10 lg:py-16">

    {{-- HERO --}}
    <section class="min-h-[80vh] flex flex-col lg:flex-row items-center justify-between gap-12 lg:gap-16">

      <div class="flex-1 text-center lg:text-left">
        <img src="{{ asset('images/logo.png') }}" alt="Logo GINTARA.NET"
             class="g-reveal w-40 lg:w-52 mx-auto lg:mx-0 mb-6" style="transition-delay:.05s">

        <h1 class="g-reveal text-4xl lg:text-6xl font-extrabold leading-tight mb-5" style="transition-delay:.14s">
          Selamat Datang di <span class="text-primary">GINTARA.NET</span>
        </h1>

        <p class="g-reveal text-base lg:text-lg leading-relaxed text-ink-soft max-w-xl mx-auto lg:mx-0" style="transition-delay:.22s">
          Platform Master Data Sync untuk mengelola sinkronisasi data pelanggan, monitoring aplikasi,
          dan integrasi sistem secara real-time dengan tampilan modern dan mudah digunakan.
        </p>

        <div class="g-reveal mt-8 flex flex-col sm:flex-row flex-wrap justify-center lg:justify-start gap-4" style="transition-delay:.3s">
          <a href="{{ route('login') }}"
             data-ripple
             class="g-btn-primary g-ripple-container flex-1 sm:flex-none sm:min-w-[220px] px-6 py-4 text-sm lg:text-base">
            @include('dashboard.partials.icon', ['name' => 'grid', 'class' => 'w-5 h-5'])
            Sign In
          </a>

          <a href="{{ route('customers.index') }}"
             data-ripple
             class="g-ripple-container flex-1 sm:flex-none sm:min-w-[220px] flex items-center justify-center gap-2
                    px-6 py-4 rounded-xl text-sm lg:text-base font-semibold
                    text-primary border-2 border-primary bg-white
                    hover:bg-primary hover:text-white hover:-translate-y-0.5
                    transition-all duration-200">
            @include('dashboard.partials.icon', ['name' => 'user', 'class' => 'w-5 h-5'])
            Manajemen Pelanggan
          </a>
        </div>
      </div>

      <div class="flex-1 w-full">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5" data-stagger>

          <div class="g-card g-card--interactive g-reveal" style="transition-delay:.38s">
            <div class="w-14 h-14 rounded-2xl bg-primary-50 flex items-center justify-center text-primary mb-4">
              @include('dashboard.partials.icon', ['name' => 'sync', 'class' => 'w-7 h-7'])
            </div>
            <h3 class="font-bold text-ink mb-1.5">Sinkronisasi Data</h3>
            <p class="text-sm leading-relaxed text-ink-soft">Sinkronisasi pelanggan antar aplikasi secara otomatis.</p>
          </div>

          <div class="g-card g-card--interactive g-reveal" style="transition-delay:.46s">
            <div class="w-14 h-14 rounded-2xl bg-primary-50 flex items-center justify-center text-primary mb-4">
              @include('dashboard.partials.icon', ['name' => 'activity', 'class' => 'w-7 h-7'])
            </div>
            <h3 class="font-bold text-ink mb-1.5">Dashboard</h3>
            <p class="text-sm leading-relaxed text-ink-soft">Monitoring aktivitas dan status aplikasi secara real-time.</p>
          </div>

          <div class="g-card g-card--interactive g-reveal" style="transition-delay:.54s">
            <div class="w-14 h-14 rounded-2xl bg-primary-50 flex items-center justify-center text-primary mb-4">
              @include('dashboard.partials.icon', ['name' => 'user', 'class' => 'w-7 h-7'])
            </div>
            <h3 class="font-bold text-ink mb-1.5">Pelanggan</h3>
            <p class="text-sm leading-relaxed text-ink-soft">Kelola data pelanggan dengan mudah dan cepat.</p>
          </div>

          <div class="g-card g-card--interactive g-reveal" style="transition-delay:.62s">
            <div class="w-14 h-14 rounded-2xl bg-primary-50 flex items-center justify-center text-primary mb-4">
              @include('dashboard.partials.icon', ['name' => 'shield', 'class' => 'w-7 h-7'])
            </div>
            <h3 class="font-bold text-ink mb-1.5">Keamanan</h3>
            <p class="text-sm leading-relaxed text-ink-soft">Role Super Admin dan Admin dengan kontrol akses yang aman.</p>
          </div>

        </div>
      </div>
    </section>

    <footer class="g-reveal text-center py-8 text-sm text-ink-soft" style="transition-delay:.7s">
      © {{ date('Y') }} GINTARA.NET • Connect More, Empower All
    </footer>

  </div>

  <script>
  (function(){
    const splash = document.getElementById('g-splash');
    const logo = document.getElementById('gSplashLogo');
    const revealItems = document.querySelectorAll('.g-reveal');
    let opened = false;

    function openSplash(){
      if (opened) return;
      opened = true;

      const rect = logo.getBoundingClientRect();
      const cx = ((rect.left + rect.width / 2) / window.innerWidth) * 100;
      const cy = ((rect.top + rect.height / 2) / window.innerHeight) * 100;
      splash.style.setProperty('--cx', cx + '%');
      splash.style.setProperty('--cy', cy + '%');

      splash.classList.add('g-clicked');

      setTimeout(() => splash.classList.add('g-closing'), 260);

      splash.addEventListener('transitionend', function handler(ev){
        if (ev.propertyName !== 'clip-path') return;
        splash.classList.add('g-hidden');
        document.body.classList.remove('g-locked');
        splash.removeEventListener('transitionend', handler);
        revealItems.forEach(el => el.classList.add('g-in'));
      });
    }

    splash.addEventListener('click', openSplash);
    splash.addEventListener('keydown', (e) => {
      if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); openSplash(); }
    });
  })();
  </script>

</body>
</html> -->

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>GINTARA.NET</title>
<link rel="icon" type="image/png" href="{{ asset('images/Gintara.png') }}">
<link rel="shortcut icon" type="image/png" href="{{ asset('images/Gintara.png') }}">
<link rel="apple-touch-icon" href="{{ asset('images/Gintara.png') }}">
@vite(['resources/css/app.css','resources/js/app.js'])

{{-- Style khusus splash intro. Idealnya dipindah ke resources/css/app.css,
     ditaruh inline di sini supaya langsung jalan tanpa menyentuh file app.css kamu. --}}
<style>
  body.g-locked{ overflow:hidden; }

  #g-splash{
    position:fixed; inset:0; z-index:100;
    display:flex; flex-direction:column; align-items:center; justify-content:center; gap:22px;
    background:
      radial-gradient(700px 500px at 50% 30%, rgba(37,99,235,.35), transparent 60%),
      linear-gradient(160deg,#0c1730 0%,#101b33 45%,#16233f 100%);
    cursor:pointer;
    clip-path: circle(150% at var(--cx,50%) var(--cy,50%));
    transition: clip-path .95s cubic-bezier(.65,0,.35,1);
  }
  #g-splash.g-closing{ clip-path: circle(0% at var(--cx,50%) var(--cy,50%)); }
  #g-splash.g-hidden{ display:none; }
  #g-splash::before{
    content:''; position:absolute; inset:0; opacity:.35; pointer-events:none;
    background-image: radial-gradient(rgba(255,255,255,.06) 1px, transparent 1px);
    background-size: 26px 26px;
  }

  .g-splash-logo-wrap{ position:relative; display:flex; align-items:center; justify-content:center; }
  .g-splash-ring{
    position:absolute; width:220px; height:220px; border-radius:9999px;
    border:1.5px solid rgba(96,146,255,.35);
    animation: gRingPulse 2.6s ease-out infinite;
  }
  .g-splash-ring.g-r2{ animation-delay:.9s; }
  @keyframes gRingPulse{
    0%{ transform:scale(.55); opacity:.9; }
    100%{ transform:scale(1.5); opacity:0; }
  }

  .g-splash-logo{
    position:relative; padding:26px 34px; border-radius:24px;
    background:rgba(255,255,255,.07); border:1px solid rgba(255,255,255,.14);
    backdrop-filter:blur(6px);
    transition: transform .35s cubic-bezier(.34,1.56,.64,1), box-shadow .35s ease;
  }
  .g-splash-logo:hover{ transform:scale(1.05); box-shadow:0 16px 45px -10px rgba(37,99,235,.55); }
  .g-splash-logo img{ width:180px; height:auto; display:block; filter:drop-shadow(0 6px 18px rgba(37,99,235,.35)); }
  #g-splash.g-clicked .g-splash-logo{ animation: gLogoPop .55s cubic-bezier(.34,1.56,.64,1) forwards; }
  @keyframes gLogoPop{
    0%{ transform:scale(1); }
    35%{ transform:scale(1.14); }
    60%{ transform:scale(.94); }
    100%{ transform:scale(1.22); opacity:0; }
  }

  .g-splash-hint{
    display:flex; flex-direction:column; align-items:center; gap:10px; margin-top:6px;
    color:rgba(255,255,255,.55); font-size:13px; transition:opacity .25s ease;
  }
  #g-splash.g-clicked .g-splash-hint{ opacity:0; }
  .g-splash-dots{ display:flex; gap:6px; }
  .g-splash-dots i{
    width:6px; height:6px; border-radius:9999px; background:rgba(96,146,255,.9);
    animation: gDotBlink 1.1s ease-in-out infinite;
  }
  .g-splash-dots i:nth-child(2){ animation-delay:.15s; }
  .g-splash-dots i:nth-child(3){ animation-delay:.3s; }
  @keyframes gDotBlink{ 0%,80%,100%{ opacity:.25; transform:scale(.8); } 40%{ opacity:1; transform:scale(1.15); } }

  /* elemen hero muncul bertahap setelah splash terbuka */
  .g-reveal{ opacity:0; transform:translateY(22px); transition:opacity .7s cubic-bezier(.22,1,.36,1), transform .7s cubic-bezier(.22,1,.36,1); }
  .g-reveal.g-in{ opacity:1; transform:none; }
</style>
</head>
<body class="relative min-h-screen overflow-x-hidden bg-surface text-ink g-locked">

  {{-- ============ SPLASH INTRO ============ --}}
  <div id="g-splash" role="button" tabindex="0" aria-label="Memuat GINTARA.NET, ketuk untuk lewati">
    <div class="g-splash-logo-wrap">
      <span class="g-splash-ring"></span>
      <span class="g-splash-ring g-r2"></span>
      <div class="g-splash-logo" id="gSplashLogo">
        <img src="{{ asset('images/logo.png') }}" alt="Logo GINTARA.NET">
      </div>
    </div>
    <div class="g-splash-hint">
      <span id="gSplashHintText">Menyiapkan GINTARA.NET…</span>
      <span class="g-splash-dots"><i></i><i></i><i></i></span>
    </div>
  </div>

  {{-- Latar gelembung mengambang, dari app.css --}}
  <div class="g-bg-blobs">
    <span class="g-blob g-blob--1"></span>
    <span class="g-blob g-blob--2"></span>
    <span class="g-blob g-blob--3"></span>
    <span class="g-blob g-blob--4"></span>
  </div>

  <div class="relative z-10 max-w-6xl mx-auto px-6 py-10 lg:py-16">

    {{-- HERO --}}
    <section class="min-h-[80vh] flex flex-col lg:flex-row items-center justify-between gap-12 lg:gap-16">

      <div class="flex-1 text-center lg:text-left">
        <img src="{{ asset('images/logo.png') }}" alt="Logo GINTARA.NET"
             class="g-reveal w-40 lg:w-52 mx-auto lg:mx-0 mb-6" style="transition-delay:.05s">

        <h1 class="g-reveal text-4xl lg:text-6xl font-extrabold leading-tight mb-5" style="transition-delay:.14s">
          Selamat Datang di <span class="text-primary">GINTARA.NET</span>
        </h1>

        <p class="g-reveal text-base lg:text-lg leading-relaxed text-ink-soft max-w-xl mx-auto lg:mx-0" style="transition-delay:.22s">
          Platform Master Data Sync untuk mengelola sinkronisasi data pelanggan, monitoring aplikasi,
          dan integrasi sistem secara real-time dengan tampilan modern dan mudah digunakan.
        </p>

        <div class="g-reveal mt-8 flex flex-col sm:flex-row flex-wrap justify-center lg:justify-start gap-4" style="transition-delay:.3s">
          <a href="{{ route('login') }}"
             data-ripple
             class="g-btn-primary g-ripple-container flex-1 sm:flex-none sm:min-w-[220px] px-6 py-4 text-sm lg:text-base">
            @include('dashboard.partials.icon', ['name' => 'grid', 'class' => 'w-5 h-5'])
            Sign In
          </a>

          <a href="{{ route('customers.index') }}"
             data-ripple
             class="g-ripple-container flex-1 sm:flex-none sm:min-w-[220px] flex items-center justify-center gap-2
                    px-6 py-4 rounded-xl text-sm lg:text-base font-semibold
                    text-primary border-2 border-primary bg-white
                    hover:bg-primary hover:text-white hover:-translate-y-0.5
                    transition-all duration-200">
            @include('dashboard.partials.icon', ['name' => 'user', 'class' => 'w-5 h-5'])
            Manajemen Pelanggan
          </a>
        </div>
      </div>

      <div class="flex-1 w-full">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5" data-stagger>

          <div class="g-card g-card--interactive g-reveal" style="transition-delay:.38s">
            <div class="w-14 h-14 rounded-2xl bg-primary-50 flex items-center justify-center text-primary mb-4">
              @include('dashboard.partials.icon', ['name' => 'sync', 'class' => 'w-7 h-7'])
            </div>
            <h3 class="font-bold text-ink mb-1.5">Sinkronisasi Data</h3>
            <p class="text-sm leading-relaxed text-ink-soft">Sinkronisasi pelanggan antar aplikasi secara otomatis.</p>
          </div>

          <div class="g-card g-card--interactive g-reveal" style="transition-delay:.46s">
            <div class="w-14 h-14 rounded-2xl bg-primary-50 flex items-center justify-center text-primary mb-4">
              @include('dashboard.partials.icon', ['name' => 'activity', 'class' => 'w-7 h-7'])
            </div>
            <h3 class="font-bold text-ink mb-1.5">Dashboard</h3>
            <p class="text-sm leading-relaxed text-ink-soft">Monitoring aktivitas dan status aplikasi secara real-time.</p>
          </div>

          <div class="g-card g-card--interactive g-reveal" style="transition-delay:.54s">
            <div class="w-14 h-14 rounded-2xl bg-primary-50 flex items-center justify-center text-primary mb-4">
              @include('dashboard.partials.icon', ['name' => 'user', 'class' => 'w-7 h-7'])
            </div>
            <h3 class="font-bold text-ink mb-1.5">Pelanggan</h3>
            <p class="text-sm leading-relaxed text-ink-soft">Kelola data pelanggan dengan mudah dan cepat.</p>
          </div>

          <div class="g-card g-card--interactive g-reveal" style="transition-delay:.62s">
            <div class="w-14 h-14 rounded-2xl bg-primary-50 flex items-center justify-center text-primary mb-4">
              @include('dashboard.partials.icon', ['name' => 'shield', 'class' => 'w-7 h-7'])
            </div>
            <h3 class="font-bold text-ink mb-1.5">Keamanan</h3>
            <p class="text-sm leading-relaxed text-ink-soft">Role Super Admin dan Admin dengan kontrol akses yang aman.</p>
          </div>

        </div>
      </div>
    </section>

    <footer class="g-reveal text-center py-8 text-sm text-ink-soft" style="transition-delay:.7s">
      © {{ date('Y') }} GINTARA.NET • Connect More, Empower All
    </footer>

  </div>

  <script>
  (function(){
    const splash = document.getElementById('g-splash');
    const logo = document.getElementById('gSplashLogo');
    const revealItems = document.querySelectorAll('.g-reveal');
    let opened = false;

    function openSplash(){
      if (opened) return;
      opened = true;

      const rect = logo.getBoundingClientRect();
      const cx = ((rect.left + rect.width / 2) / window.innerWidth) * 100;
      const cy = ((rect.top + rect.height / 2) / window.innerHeight) * 100;
      splash.style.setProperty('--cx', cx + '%');
      splash.style.setProperty('--cy', cy + '%');

      splash.classList.add('g-clicked');

      setTimeout(() => splash.classList.add('g-closing'), 260);

      splash.addEventListener('transitionend', function handler(ev){
        if (ev.propertyName !== 'clip-path') return;
        splash.classList.add('g-hidden');
        document.body.classList.remove('g-locked');
        splash.removeEventListener('transitionend', handler);
        revealItems.forEach(el => el.classList.add('g-in'));
      });
    }

    // buka otomatis setelah jeda singkat — logo tetap bisa diklik untuk skip lebih cepat
    const AUTO_OPEN_DELAY = 1800;
    const autoTimer = setTimeout(openSplash, AUTO_OPEN_DELAY);

    splash.addEventListener('click', () => { clearTimeout(autoTimer); openSplash(); });
    splash.addEventListener('keydown', (e) => {
      if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); clearTimeout(autoTimer); openSplash(); }
    });
  })();
  </script>

</body>
</html>