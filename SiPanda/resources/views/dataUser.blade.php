@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="pagetitle">
  <h1>Dashboard</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
      <li class="breadcrumb-item active">Data User</li>
    </ol>
  </nav>
</div>

<section class="section">
  <div class="row">
 <div class="card">
            <div class="card-body">
              <h5 class="card-title">Tabel Data User </h5>
              <p>Berikut adalah tabel Data User, yaitu daftar lengkap pengguna yang telah mendaftar dan menggunakan aplikasi pendeteksi PCOS. </p>
              <div class="mb-3">
  <a href="/export/excel" class="btn btn-success"><i class="fa fa-file-excel"></i> Export to Excel</a>
  <a href="/export/pdf" class="btn btn-danger"><i class="fa fa-file-pdf"></i> Export to PDF</a>
</div>

              <!-- Bordered Table -->
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Email</th>
                    <th scope="col">Umur</th>
                    <th scope="col">Tanggal Terakhir Diagnosa</th>
                    <th scope="col">Status</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">1</th>
                    <td>sri</td>
                    <td>sri@gmail.com</td>
                    <td>20</td>
                    <td>2025-01-12</td>
                    <td><span class="badge bg-danger">PCOS</span></td>
                  </tr>
                  <tr>
                    <th scope="row">2</th>
                    <td>dini</td>
                    <td>dini@gmail.com</td>
                    <td>22</td>
                    <td>2025-02-08</td>
                    <td><span class="badge bg-success">Tidak PCOS</span></td>                  </tr>
                </tbody>
              </table>
              <!-- End Bordered Table -->

            </div>
          </div>
</section>
@endsection
