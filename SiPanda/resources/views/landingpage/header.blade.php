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
    }, 15);
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

<!--start tentang ovasafe -->

<div class="container-fluid py-5" id="tentang">
    <div class="container py-5">
        <div class="row">
            <!-- Kolom Teks (kiri) -->
            <div class="col-lg-7 mb-5 mb-lg-0">
                <div class="section-title position-relative mb-4">
                    <h6 class="d-inline-block position-relative text-secondary text-uppercase pb-2">Tentang OvaSafe</h6>
                    <h1 class="display-4">Apa itu OvaSafe?</h1>
                </div>
                <p style="text-align: justify;">
                <strong>Ovasafe</strong> adalah aplikasi berbasis web dan mobile yang dirancang untuk membantu wanita mengenali tanda-tanda awal <em>PCOS</em> (Polycystic Ovary Syndrome) secara mandiri. Melalui fitur prediksi cerdas dan konten edukatif, Ovasafe hadir sebagai solusi digital yang mendukung kesehatan reproduksi wanita secara lebih mudah dan praktis.
                </p>

                <p style="text-align: justify;">
                Dengan mengisi beberapa data seperti siklus menstruasi, indeks massa tubuh (BMI), serta gejala umum seperti jerawat hormonal atau pertumbuhan rambut berlebih, Ovasafe akan memberikan hasil prediksi awal apakah seseorang berpotensi mengalami PCOS.
                </p>

                <p style="text-align: justify;">
                Jika terindikasi, pengguna akan mendapatkan edukasi khusus berupa saran pola makan, gaya hidup sehat, dan informasi penting lainnya yang dapat membantu mengelola gejala sejak dini. Semua ini disediakan secara <strong>gratis</strong>, <strong>aman</strong>, dan <strong>mudah diakses</strong> oleh siapa saja.
                </p>

            </div>

            <!-- Kolom Gambar (kanan) -->
            <div class="col-lg-5">
                <div class="position-relative h-100">
                    <img class="position-absolute w-100 h-100" 
                         src="{{ asset('assets1/img/4.png') }}" 
                         style="object-fit: cover; left: 0;">
                </div>
            </div>
        </div>
    </div>
</div>

<!-- start tentang pcos -->

<div class="container-fluid py-5" id="tentang1">
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-5 mb-5 mb-lg-0" style="min-height: 500px;">
                <div class="position-relative h-100">
                    <img class="position-absolute w-100 h-100" 
                        src="{{ asset('assets1/img/ovaa.jpg') }}" 
                        style="object-fit: cover; left: -20px; position: absolute;">
                </div>
            </div>

            <div class="col-lg-7">
                <div class="section-title position-relative mb-4">
                    <h6 class="d-inline-block position-relative text-secondary text-uppercase pb-2">Pengenalan PCOS</h6>
                    <h1 class="display-4">Apa itu PCOS</h1>
                </div>
                <p style="text-align: justify;">
                    PCOS (Polycystic Ovary Syndrome) adalah kondisi hormonal yang umum terjadi pada perempuan usia reproduktif. Ditandai dengan gangguan siklus menstruasi, kelebihan hormon androgen (hormon pria), dan munculnya banyak kista kecil di ovarium, PCOS dapat memengaruhi kesuburan, berat badan, serta kesehatan jangka panjang seperti risiko diabetes dan penyakit jantung. Deteksi dini dan penanganan yang tepat sangat penting untuk menjaga kualitas hidup penderita PCOS.
                </p>

                <h1 class="display-4">Gejala Umum PCOS</h1>

                <p style="text-align: justify;">
                    1. Siklus menstruasi tidak teratur (jarang haid, haid terlalu sering, atau tidak haid sama sekali)<br>
                    2. Jerawat berlebih dan kulit berminyak<br>
                    3. Pertumbuhan rambut berlebih (wajah, dada, perut, atau punggung)<br>
                    4. Sulit hamil atau gangguan kesuburan<br>
                    5. Berat badan mudah naik, terutama di sekitar perut<br>
                    6. Rambut menipis atau rontok seperti pola kebotakan pria<br>
                    7. Kulit menghitam di area lipatan seperti leher atau ketiak (akantosis nigrikans)
                </p>
            </div>
        </div>
    </div>
</div>

<!-- start edukasi -->

<div class="container-fluid bg-image" style="margin: 90px 0;" id="edukasi">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 my-5 pt-5 pb-lg-5">
                <div class="section-title position-relative mb-4">
                    <h6 class="d-inline-block position-relative text-secondary text-uppercase pb-2">Edukasi</h6>
                    <h1 class="display-4">Apa Saja Yang Harus Dilakukan Untuk Menghindari PCOS?</h1>
                </div>
                <p class="mb-4 pb-2">Meskipun faktor genetik memiliki peran dalam PCOS, ada beberapa langkah yang dapat diambil untuk membantu mencegah atau mengelola gejala PCOS. Berikut adalah beberapa cara yang bisa diterapkan untuk mencegah atau mengurangi risiko PCOS:</p>
                
                <div class="d-flex mb-3">
                <div class="btn-icon bg-primary mr-4">
                    <!-- Ikon yang lebih relevan untuk "Pola Makan Sehat" -->
                    <i class="fa fa-2x fa-apple-alt text-white"></i>
                </div>
                <div class="mt-n1">
                    <h4>Pola Makan Sehat</h4>
                    <p>Labore rebum duo est Sit dolore eos sit tempor eos stet, vero vero clita magna kasd no nonumy et eos dolor magna ipsum.</p>
                </div>
            </div>

            <div class="d-flex mb-3">
            <div class="btn-icon bg-secondary mr-4">
                <!-- Ikon yang lebih relevan untuk "Olahraga Teratur" -->
                <i class="fa fa-2x fa-dumbbell text-white"></i>
            </div>
            <div class="mt-n1">
                <h4>Olahraga Teratur</h4>
                <p>Labore rebum duo est Sit dolore eos sit tempor eos stet, vero vero clita magna kasd no nonumy et eos dolor magna ipsum.</p>
            </div>
        </div>

        <div class="d-flex">
            <div class="btn-icon bg-warning mr-4">
                <!-- Ikon yang lebih relevan untuk "Menjaga Berat Badan Ideal" -->
                <i class="fa fa-2x fa-weight text-white"></i>
            </div>
            <div class="mt-n1">
                <h4>Menjaga Berat Badan Ideal</h4>
                <p class="m-0">Labore rebum duo est Sit dolore eos sit tempor eos stet, vero vero clita magna kasd no nonumy et eos dolor magna ipsum.</p>
            </div>
        </div>

            </div>
            <div class="col-lg-5" style="min-height: 500px;">
                <div class="position-relative h-100">
                    <img class="position-absolute w-100 h-100" 
                         src="{{ asset('assets1/img/image.png') }}" 
                         style="object-fit: cover; object-position: center;"/>
                </div>
            </div>
        </div>
    </div>
</div>

