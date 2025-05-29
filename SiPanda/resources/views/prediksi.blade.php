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
                    <th scope="col">No</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Umur</th>
                    <th scope="col">Berat Badan</th>
                    <th scope="col">Tinggi Badan</th>
                    <th scope="col">Siklus Haid</th>
                    <th scope="col">Lingkar Panggul</th>
                    <th scope="col">Lingkar Pingggang</th>
                    <th scope="col">Kenaikan Berat Badan</th>
                    <th scope="col">Pertumbuhan Rambut Berlebih</th>
                    <th scope="col">Penggelapan Lipatan Kulit</th>
                    <th scope="col">Kerontokan Rambut</th>
                    <th scope="col">Jerawat</th>
                    <th scope="col">FastFood</th>
                    <th scope="col">BMI</th>
                    <th scope="col">Tanggal Diagnosa</th>
                    <th scope="col">Status Diagnosa</th>
                    <th scope="col">Edukasi</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($prediksi as $p)
                    <tr>
                    <td>{{ $loop->iteration}}</td>
                    <td>{{ $p->nama }}</td>
                    <td>{{ $p->Umur }}</td>
                    <td>{{ $p->Berat_kg }}</td>
                    <td>{{ $p->Tinggi_cm }}</td>
                    <td>{{ $p->Siklus_Haid }}</td>
                    <td>{{ $p->Lingkar_Panggul_cm }}</td>
                    <td>{{ $p->Lingkar_Pinggang_cm }}</td>
                    <td>{{ $p->Kenaikan_BB ? 'Ya' : 'Tidak' }}</td>
                    <td>{{ $p->Pertumbuhan_Rambut_di_Area_Tidak_Wajar ? 'Ya' : 'Tidak' }}</td>
                    <td>{{ $p->Penggelapan_Kulit_di_Area_Lipatan ? 'Ya' : 'Tidak' }}</td>
                    <td>{{ $p->Kerontokan_Rambut ? 'Ya' : 'Tidak' }}</td>
                    <td>{{ $p->Jerawat ? 'Ya' : 'Tidak' }}</td>
                    <td>{{ $p->Sering_Makan_FastFood ? 'Ya' : 'Tidak' }}</td>
                    <td>{{ $p->BMI }}</td>
                    <td>{{ $p->tanggal_diagnosa }}</td>
                    <td>{{ $p->status_diagnosa }}</td>
                    <td>{{ $p->edukasi ?? '-' }}</td>
                </tr>
                    @endforeach
                </tbody>
              </table>
              <!-- End Bordered Table -->

            </div>
          </div>
</section>
@endsection
