@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="pagetitle">
  <h1>Dashboard</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
      <li class="breadcrumb-item active">Riwayat</li>
    </ol>
  </nav>
</div>

<section class="section">
  <div class="row">
 <div class="card">
            <div class="card-body">
              <h5 class="card-title">Tabel Prediksi</h5>
              <div class="mb-3">
  <!-- <a href="/export/excel" class="btn btn-success"><i class="fa fa-file-excel"></i> Export to Excel</a>
  <a href="/export/pdf" class="btn btn-danger"><i class="fa fa-file-pdf"></i> Export to PDF</a> -->
</div>

              <!-- <p>Berikut adalah tabel Data User, yaitu daftar lengkap pengguna yang telah mendaftar dan menggunakan aplikasi pendeteksi PCOS. </p> -->
              <!-- Bordered Table -->
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Age</th>
                    <th scope="col">Weight</th>
                    <th scope="col">Height</th>
                    <th scope="col">Cycle</th>
                    <th scope="col">Hip</th>
                    <th scope="col">Waist</th>
                    <th scope="col">Weight gain</th>
                    <th scope="col">Hair Growth</th>
                    <th scope="col">Darkening Skin Folds</th>
                    <th scope="col">Hair Lossy</th>
                    <th scope="col">Pimples</th>
                    <th scope="col">Fastfood</th>
                    <th scope="col">BMI</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Status</th>
                    <th scope="col">Edukasi</th>



                  </tr>
                </thead>
                <tbody>
                  
                </tbody>
              </table>
              <!-- End Bordered Table -->

            </div>
          </div>
</section>
@endsection
