@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="pagetitle">
  <h1>Dashboard</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
      <li class="breadcrumb-item active">Dashboard</li>
    </ol>
  </nav>
</div>

<section class="section dashboard">
  <div class="row">

    <!-- Info Cards -->
    <div class="row">
      <!-- Pengguna Terdaftar -->
      <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="card info-card sales-card">
          <div class="card-body">
            <h5 class="card-title">Pengguna Terdaftar</h5>
            <div class="d-flex align-items-center">
              <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                <i class="bi bi-people"></i>
              </div>
              <div class="ps-3">
                <h6>15</h6>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Riwayat Diagnosa -->
      <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="card info-card revenue-card">
          <div class="card-body">
            <h5 class="card-title">Riwayat Diagnosa</h5>
            <div class="d-flex align-items-center">
              <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                <i class="bi bi-file-medical" style="color: black;"></i>
              </div>
              <div class="ps-3">
                <h6>10</h6>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Terindikasi PCOS -->
      <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="card info-card sales-card">
          <div class="card-body">
            <h5 class="card-title">Terindikasi PCOS</h5>
            <div class="d-flex align-items-center">
              <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                <i class="bi bi-heart-pulse-fill text-danger"></i>
              </div>
              <div class="ps-3">
                <h6>15</h6>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Tidak Terindikasi -->
      <div class="col-lg-3 col-md-6 col-sm-12">
        <div class="card info-card revenue-card">
          <div class="card-body">
            <h5 class="card-title">Tidak Terindikasi</h5>
            <div class="d-flex align-items-center">
              <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                <i class="bi bi-heart-fill"></i>
              </div>
              <div class="ps-3">
                <h6>10</h6>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div><!-- End Info Cards -->

    <!-- Chart and News -->

    <div class="row">
      <!-- Bar Chart -->
      <div class="col-lg-6">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Grafik Jumlah Terdiagnosis PCOS Tiap Bulan</h5>

              <!-- Bar Chart -->
              <canvas id="barChart" style="height: 600px;"></canvas>

              <script>
                document.addEventListener("DOMContentLoaded", () => {
                  new Chart(document.querySelector('#barChart'), {
                    type: 'bar',
                    data: {
                      labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
                      datasets: [{
                        label: 'Bar Chart',
                        data: [65, 59, 80, 81, 56, 55, 40, 50, 45, 12, 34, 98],
                        backgroundColor: [
                          'rgba(255, 99, 132, 0.2)',
                          'rgba(255, 159, 64, 0.2)',
                          'rgba(255, 205, 86, 0.2)',
                          'rgba(75, 192, 192, 0.2)',
                          'rgba(54, 162, 235, 0.2)',
                          'rgba(153, 102, 255, 0.2)',
                          'rgba(201, 203, 207, 0.2)',
                          'rgba(255, 99, 132, 0.2)',
                          'rgba(255, 159, 64, 0.2)',
                          'rgba(255, 205, 86, 0.2)',
                          'rgba(75, 192, 192, 0.2)',
                          'rgba(54, 162, 235, 0.2)'
                        ],
                        borderColor: [
                          'rgb(255, 99, 132)',
                          'rgb(255, 159, 64)',
                          'rgb(255, 205, 86)',
                          'rgb(75, 192, 192)',
                          'rgb(54, 162, 235)',
                          'rgb(153, 102, 255)',
                          'rgb(201, 203, 207)',
                          'rgb(255, 99, 132)',
                          'rgb(255, 159, 64)',
                          'rgb(255, 205, 86)',
                          'rgb(75, 192, 192)',
                          'rgb(54, 162, 235)'
                        ],
                        borderWidth: 1
                      }]
                    },
                    options: {
                      plugins: {
                        legend: {
                          display: false // Menyembunyikan kotak legenda
                        }
                      },
                      scales: {
                        y: {
                          beginAtZero: true
                        }
                      }
                    }
                  });
                });
              </script>

              <!-- End Bar CHart -->

            </div>
          </div>
        </div>

      <!-- News & Updates -->
      <div class="col-lg-6">
        <div class="card">
          
          <div class="card-body pb-0">
            <h5 class="card-title">Edukasi &amp; Info PCOS </h5>
            <div class="news">

            <div class="post-item clearfix">
            <img src="assets/img/edu1.jpg" alt="">
            <h4><a href="#">Kenali Gejala Awal PCOS</a></h4>
            <p>PCOS dapat dikenali dari menstruasi tidak teratur, jerawat berlebihan, dan rambut tumbuh di area yang tidak biasa. Deteksi dini penting untuk penanganan tepat.</p>
          </div>

          <div class="post-item clearfix">
                <img src="assets/img/olahraga.webp" alt="">
                <h4><a href="#">Manfaat Olahraga Rutin untuk Penderita PCOS</a></h4>
                <p>Aktivitas fisik teratur membantu menyeimbangkan hormon dan meningkatkan sensitivitas insulin pada penderita PCOS.</p>
              </div>

              <div class="post-item clearfix">
                <img src="assets/img/edu2.jpg" alt="">
                <h4><a href="#">Pola Makan Sehat yang Disarankan</a></h4>
                <p>Konsumsi makanan rendah karbohidrat, tinggi serat, serta menghindari fast food dapat memperbaiki kondisi tubuh penderita PCOS.</p>
              </div>

              <div class="post-item clearfix">
                <img src="assets/img/edu3.png" alt="">
                <h4><a href="#">PCOS dan Hubungannya dengan Kesuburan</a></h4>
                <p>PCOS dapat menyebabkan gangguan ovulasi, namun dengan pengobatan dan perubahan gaya hidup, peluang kehamilan tetap ada.</p>
              </div>

              <div class="post-item clearfix">
                <img src="assets/img/edu4.png" alt="">
                <h4><a href="#">Cara Mengelola Stres pada Penderita PCOS</a></h4>
                <p>Stres memicu ketidakseimbangan hormon. Teknik relaksasi seperti yoga atau meditasi efektif membantu manajemen stres.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div><!-- End Chart and News -->

  </div>
</section>
@endsection
