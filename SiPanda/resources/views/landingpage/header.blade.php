<div class="jumbotron jumbotron-fluid position-relative overlay-bottom" style="margin-bottom: 90px;">
  <style>
    .cta-buttons {
      display: flex;
      justify-content: center;
      gap: 1rem;
      margin-top: 20px;
    }
    .btn-primary, .btn-secondary {
      padding: 12px 24px !important;
      border-radius: 8px !important;
      text-decoration: none !important;
      font-weight: bold !important;
      font-size: 16px !important;
      transition: background 0.3s ease !important;
    }
    .btn-primary {
      background-color: #e91e63 !important;
      color: white !important;
      border: none !important;
    }
    .btn-primary:hover { background-color: #c2185b !important; }
    .btn-secondary {
      background-color: transparent !important;
      color: #e91e63 !important;
      border: 2px solid #e91e63 !important;
    }
    .btn-secondary:hover { background-color: #c2185b !important; color: white !important; }
  </style>

  <div class="container text-center my-5 py-5">
    <h1 class="text-white mt-4 mb-4">Kenali dan Deteksi Dini PCOS Bersama</h1>
    <h1 class="text-white display-1 mb-5">OVASAFE</h1>
    <div class="cta-buttons">
      <a href="#download" class="btn-primary">Coba Sekarang</a>
      <a href="javascript:void(0)" id="scrollToggle" class="btn btn-secondary">Pelajari Lebih Lanjut</a>
    </div>
  </div>
</div>

<script>
  let scrollInterval = null;
  let isScrolling = false;

  function startScroll() {
    if (isScrolling) return;
    isScrolling = true;
    scrollInterval = setInterval(() => {
      window.scrollBy({ top: 1, behavior: 'smooth' });
      if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight) {
        stopScroll();
      }
    }, 20);
  }

  function stopScroll() {
    clearInterval(scrollInterval);
    isScrolling = false;
  }

  function toggleScroll() {
    if (isScrolling) stopScroll();
    else startScroll();
  }

  const scrollToggle = document.getElementById('scrollToggle');

  // Klik tombol: mulai scroll
  scrollToggle.addEventListener('click', e => {
    e.stopPropagation();
    startScroll();
  });

  // Klik di mana saja kecuali di dalam .navbar: toggle scroll
  document.addEventListener('click', e => {
    if (e.target.closest('.navbar')) {
      // klik di navbar → abaikan
      return;
    }
    // klik di luar navbar (bisa tombol atau area lain) → toggle
    toggleScroll();
  });
</script>
