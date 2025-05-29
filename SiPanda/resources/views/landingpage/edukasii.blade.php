<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>OvaSafe</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

        <!-- Favicon -->
        <link href="{{ asset('assets1/img/4.png') }}" rel="icon">

        <!-- Google Web Fonts -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500;600;700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet"> 

        <!-- Font Awesome -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

        <!-- Libraries Stylesheet -->
        <link href="{{ asset('assets1/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

        <!-- Customized Bootstrap Stylesheet -->
        <link href="{{ asset('assets1/css/style.css') }}" rel="stylesheet">


</head>

<body>
   


    <!-- Navbar Start -->
    @include('landingpage.navbar')
    <!-- Navbar End -->


    <!-- Header Start -->
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
    <h1 class="text-white mt-4 mb-4">Mari Belajar Cara Menghindari</h1>
    <h1 class="text-white display-1 mb-5">PCOS?</h1>
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


    <!-- Header End -->

    <!-- About Start -->
    <!-- About End -->

    <!-- About Start -->
    <!-- About End -->
     
    <!-- edukasi Start -->
    <!-- edukasi End -->
     


    

    


    

    


    

    <div class="container-fluid bg-dark text-white-50 border-top py-4" style="border-color: rgba(256, 256, 256, .1) !important;">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-md-left mb-3 mb-md-0">
                    <p class="m-0">Copyright &copy; <a class="text-white" href="#">OvaSafe</a>
                    </p>
                </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary rounded-0 btn-lg-square back-to-top"><i class="fa fa-angle-double-up"></i></a>

<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('assets1/lib/easing/easing.min.js') }}"></script>
<script src="{{ asset('assets1/lib/waypoints/waypoints.min.js') }}"></script>
<script src="{{ asset('assets1/lib/counterup/counterup.min.js') }}"></script>
<script src="{{ asset('assets1/lib/owlcarousel/owl.carousel.min.js') }}"></script>

<!-- Template Javascript -->
<script src="{{ asset('assets1/js/main.js') }}"></script>

</body>

</html>