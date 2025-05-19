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
</div><!-- End Page Title -->

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
                <i class="bi bi-file-medical text-primary"></i>
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
                <i class="bi bi-heart-fill text-success"></i>
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

      <!-- Edukasi & Info -->
      <div class="col-lg-6">
        <div class="card">
          <div class="card-body pb-0">
            <h5 class="card-title">Edukasi &amp; Info PCOS</h5>
            <div class="news">
              @if($edukasi->count() > 0)
                @foreach ($edukasi as $item)
                  <div class="post-item clearfix">
                    <img src="{{ asset('storage/images/' . $item->konten) }}" alt="{{ $item->judul }}" style="max-height: 70px;">
                    <h4><a href="#">{{ $item->judul }}</a></h4>
                    <p>{{ Str::limit($item->deskripsi, 100, '...') }}</p>
                  </div>
                @endforeach
              @else
                <p>Tidak ada informasi edukasi tersedia saat ini.</p>
              @endif
            </div>
          </div>
        </div>
      </div>

    </div><!-- End row -->
  </div>
</section>
@endsection
