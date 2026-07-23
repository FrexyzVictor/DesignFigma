<<<<<<< HEAD
=======
import './bootstrap';
// Jika project kamu sudah punya resources/js/bootstrap.js (axios, echo, dll),
// import di sini: import './bootstrap';
// Jika project kamu sudah punya resources/js/bootstrap.js (axios, echo, dll),
// import di sini: import './bootstrap';
>>>>>>> 587fbbf538d652fa21935511d92a9091d378a0ba


import Alpine from 'alpinejs';

window.Alpine = Alpine;

<<<<<<< HEAD
Alpine.start();
=======
  toggle.addEventListener('change', () => {
    const isDark = toggle.checked;
    document.documentElement.classList.toggle('dark', isDark);
    localStorage.setItem('gintara-theme', isDark ? 'dark' : 'light');
    showToast(isDark ? 'Mode gelap diaktifkan' : 'Mode terang diaktifkan', 'primary');
  });
}

/**
 * Deteksi device di sisi client (opsional) — hanya untuk kebutuhan JS
 * tambahan (misal animasi berbeda, lazy-load beda, dsb). Tampilan/layout
 * TIDAK bergantung ke sini — itu murni ditangani Tailwind breakpoint `lg:`
 * di Blade, supaya tetap 1 file, tetap cepat, dan tidak "flicker".
 */
function markDeviceType() {
  const isMobile = window.matchMedia('(max-width: 1023px)').matches;
  document.documentElement.dataset.device = isMobile ? 'mobile' : 'desktop';
}

/**
 * Header jadi sedikit "mengangkat" (shadow muncul) begitu halaman di-scroll,
 * supaya konten di baliknya terasa berlapis, bukan menempel datar.
 */
function initHeaderScrollShadow() {
  const header = document.querySelector('header');
  if (!header) return;

  const toggle = () => {
    header.classList.toggle('shadow-card-lg', window.scrollY > 4);
  };
  toggle();
  window.addEventListener('scroll', toggle, { passive: true });
}

/**
 * Elemen dengan [data-stagger] akan membuat anak-anak langsungnya (kartu,
 * baris, dsb) muncul satu-satu dengan jeda kecil saat halaman dimuat —
 * bukan langsung nongol semua sekaligus. Efeknya halus, ~40ms per item,
 * dibatasi supaya list panjang tidak terasa lambat.
 */
function initStaggerAnimations() {
  const containers = document.querySelectorAll('[data-stagger]');
  containers.forEach((container) => {
    const items = Array.from(container.children);
    items.forEach((item, i) => {
      item.classList.add('g-stagger-item');
      item.style.animationDelay = `${Math.min(i * 45, 400)}ms`;
    });
  });
}

/**
 * Angka pada kartu statistik (mis. "Total Kegiatan") dihitung naik dari 0
 * ke nilai aslinya saat pertama kali terlihat di layar — bikin dashboard
 * terasa "hidup" saat pertama dibuka, tanpa mengganggu pembacaan data.
 */
function initCountUpStats() {
  const targets = document.querySelectorAll('[data-count-to]');
  if (!targets.length) return;

  const animate = (el) => {
    const to = parseFloat(el.dataset.countTo);
    if (Number.isNaN(to)) return;

    const duration = 700;
    const start = performance.now();
    const isInt = Number.isInteger(to);

    function tick(now) {
      const progress = Math.min((now - start) / duration, 1);
      const eased = 1 - Math.pow(1 - progress, 3); // ease-out cubic
      const value = to * eased;
      el.textContent = isInt ? Math.round(value).toString() : value.toFixed(1);

      if (progress < 1) {
        requestAnimationFrame(tick);
      } else {
        el.textContent = isInt ? to.toString() : to.toFixed(1);
        el.classList.add('g-count-pop');
      }
    }
    requestAnimationFrame(tick);
  };

  if ('IntersectionObserver' in window) {
    const observer = new IntersectionObserver((entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          animate(entry.target);
          observer.unobserve(entry.target);
        }
      });
    }, { threshold: 0.4 });

    targets.forEach((el) => observer.observe(el));
  } else {
    targets.forEach(animate);
  }
}

/**
 * Efek ripple (lingkaran memudar dari titik klik) untuk elemen berpenanda
 * [data-ripple]. Elemen tersebut juga harus punya class .g-ripple-container
 * (posisi relative + overflow hidden) supaya ripple-nya tidak bocor keluar.
 */
function initRipple() {
  document.querySelectorAll('[data-ripple]').forEach((el) => {
    el.addEventListener('pointerdown', (e) => {
      const rect = el.getBoundingClientRect();
      const size = Math.max(rect.width, rect.height) * 1.4;
      const span = document.createElement('span');

      span.className = 'g-ripple';
      span.style.width = `${size}px`;
      span.style.height = `${size}px`;
      span.style.left = `${e.clientX - rect.left - size / 2}px`;
      span.style.top = `${e.clientY - rect.top - size / 2}px`;

      el.appendChild(span);
      span.addEventListener('animationend', () => span.remove());
    });
  });
}

/**
 * Tombol "Sinkronkan Data" / "Segarkan Semua": ikon berputar selagi request
 * berjalan, lalu kasih toast konfirmasi singkat saat selesai.
 */
function initRefreshButtons() {
  document.querySelectorAll('[data-action="refresh"]').forEach((btn) => {
    btn.addEventListener('click', async () => {
      const icon = btn.querySelector('[data-refresh-icon]');
      icon?.classList.add('animate-spin');
      btn.disabled = true;

      try {
        const url = btn.dataset.refreshUrl;
        if (url) {
          await fetch(url, {
            method: 'POST',
            headers: {
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content ?? '',
              Accept: 'application/json',
            },
          });
          // Reload data secukupnya di sini, atau window.location.reload()
        } else {
          await new Promise((r) => setTimeout(r, 900)); // demo delay
        }
        showToast('Data berhasil disinkronkan', 'success');
      } catch (err) {
        showToast('Gagal menyinkronkan data', 'danger');
      } finally {
        icon?.classList.remove('animate-spin');
        btn.disabled = false;
      }
    });
  });
}

/**
 * Filter pill (Semua/Berhasil/Tertunda/Gagal di halaman Event): klik salah
 * satu akan menandainya aktif dan melepas status aktif dari yang lain.
 * Murni UI di sisi client — sambungkan ke query/filter asli sesuai
 * kebutuhan (mis. submit form, fetch ulang list, dsb).
 */
function initFilterPills() {
  document.querySelectorAll('[data-pill-group]').forEach((group) => {
    group.querySelectorAll('[data-pill]').forEach((pill) => {
      pill.addEventListener('click', () => {
        group.querySelectorAll('[data-pill]').forEach((p) => {
          p.classList.remove('bg-primary', 'text-white', 'border-primary');
          p.classList.add('bg-white', 'text-ink-soft', 'border-gray-100');
        });
        pill.classList.remove('bg-white', 'text-ink-soft', 'border-gray-100');
        pill.classList.add('bg-primary', 'text-white', 'border-primary');
      });
    });
  });
}

/**
 * "Tandai semua dibaca" di halaman Notifikasi: titik biru unread memudar
 * halus lalu hilang, bukan langsung lenyap.
 */
function initMarkAllRead() {
  document.querySelectorAll('[data-mark-all-read]').forEach((btn) => {
    btn.addEventListener('click', () => {
      const section = btn.closest('div')?.parentElement;
      const dots = section
        ? section.querySelectorAll('[data-unread-dot]')
        : document.querySelectorAll('[data-unread-dot]');

      dots.forEach((dot) => {
        dot.style.opacity = '0';
        setTimeout(() => dot.remove(), 300);
      });

      showToast('Semua notifikasi ditandai sudah dibaca', 'success');
    });
  });
}

/** Tandai menu aktif (bottom nav mobile & sidebar desktop) berdasarkan URL saat ini */
function initActiveNav() {
  const path = window.location.pathname;
  document.querySelectorAll('[data-nav-link]').forEach((link) => {
    if (link.getAttribute('href') === path) {
      link.classList.add('is-active');
    }
  });
}

/**
 * Toast kecil di pojok bawah — dipakai untuk konfirmasi aksi ringan
 * (sinkron berhasil, notifikasi ditandai dibaca, dll). Tidak menumpuk
 * banyak: toast baru menggantikan yang lama.
 */
let __toastEl = null;
function showToast(message, tone = 'primary') {
  const toneClass = {
    primary: 'bg-ink text-white',
    success: 'bg-success text-white',
    danger: 'bg-danger text-white',
  }[tone] ?? 'bg-ink text-white';

  __toastEl?.remove();

  const toast = document.createElement('div');
  toast.className = `g-toast-enter fixed z-50 left-1/2 -translate-x-1/2 bottom-24 lg:bottom-8
                      ${toneClass} text-sm font-medium px-4 py-2.5 rounded-full shadow-card-lg`;
  toast.textContent = message;
  document.body.appendChild(toast);
  __toastEl = toast;

  setTimeout(() => {
    toast.classList.remove('g-toast-enter');
    toast.classList.add('g-toast-leave');
    toast.addEventListener('animationend', () => toast.remove(), { once: true });
  }, 2200);
}
>>>>>>> 587fbbf538d652fa21935511d92a9091d378a0ba
