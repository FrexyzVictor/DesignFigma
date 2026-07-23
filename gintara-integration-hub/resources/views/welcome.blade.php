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
</head>
<body class="relative min-h-screen overflow-x-hidden bg-surface text-ink">

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
        <img src="{{ asset('images/logo.png') }}" alt="Logo GINTARA.NET" class="w-40 lg:w-52 mx-auto lg:mx-0 mb-6">

        <h1 class="text-4xl lg:text-6xl font-extrabold leading-tight mb-5">
          Selamat Datang di <span class="text-primary">GINTARA.NET</span>
        </h1>

        <p class="text-base lg:text-lg leading-relaxed text-ink-soft max-w-xl mx-auto lg:mx-0">
          Platform Master Data Sync untuk mengelola sinkronisasi data pelanggan, monitoring aplikasi,
          dan integrasi sistem secara real-time dengan tampilan modern dan mudah digunakan.
        </p>

        <div class="mt-8 flex flex-col sm:flex-row flex-wrap justify-center lg:justify-start gap-4">
          <a href="{{ route('login') }}"
             data-ripple
             class="g-btn-primary g-ripple-container flex-1 sm:flex-none sm:min-w-[220px] px-6 py-4 text-sm lg:text-base">
            @include('dashboard.partials.icon', ['name' => 'grid', 'class' => 'w-5 h-5'])
            Masuk Dashboard
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

          <div class="g-card g-card--interactive">
            <div class="w-14 h-14 rounded-2xl bg-primary-50 flex items-center justify-center text-primary mb-4">
              @include('dashboard.partials.icon', ['name' => 'sync', 'class' => 'w-7 h-7'])
            </div>
            <h3 class="font-bold text-ink mb-1.5">Sinkronisasi Data</h3>
            <p class="text-sm leading-relaxed text-ink-soft">Sinkronisasi pelanggan antar aplikasi secara otomatis.</p>
          </div>

          <div class="g-card g-card--interactive">
            <div class="w-14 h-14 rounded-2xl bg-primary-50 flex items-center justify-center text-primary mb-4">
              @include('dashboard.partials.icon', ['name' => 'activity', 'class' => 'w-7 h-7'])
            </div>
            <h3 class="font-bold text-ink mb-1.5">Dashboard</h3>
            <p class="text-sm leading-relaxed text-ink-soft">Monitoring aktivitas dan status aplikasi secara real-time.</p>
          </div>

          <div class="g-card g-card--interactive">
            <div class="w-14 h-14 rounded-2xl bg-primary-50 flex items-center justify-center text-primary mb-4">
              @include('dashboard.partials.icon', ['name' => 'user', 'class' => 'w-7 h-7'])
            </div>
            <h3 class="font-bold text-ink mb-1.5">Pelanggan</h3>
            <p class="text-sm leading-relaxed text-ink-soft">Kelola data pelanggan dengan mudah dan cepat.</p>
          </div>

          <div class="g-card g-card--interactive">
            <div class="w-14 h-14 rounded-2xl bg-primary-50 flex items-center justify-center text-primary mb-4">
              @include('dashboard.partials.icon', ['name' => 'shield', 'class' => 'w-7 h-7'])
            </div>
            <h3 class="font-bold text-ink mb-1.5">Keamanan</h3>
            <p class="text-sm leading-relaxed text-ink-soft">Role Super Admin dan Admin dengan kontrol akses yang aman.</p>
          </div>

        </div>
      </div>
    </section>

    <footer class="text-center py-8 text-sm text-ink-soft">
      © {{ date('Y') }} GINTARA.NET • Connect More, Empower All
    </footer>

  </div>

</body>
</html>