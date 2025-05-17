@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="pagetitle">
    <!-- Bootstrap Icons CDN (jika belum) -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <h1>Dashboard</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
      <li class="breadcrumb-item active">Edukasi</li>
    </ol>
  </nav>
</div>

<section class="section">
  <div class="row">
  <div class="card">
            <div class="card-body">
            <h5 class="card-title">Tabel Edukasi</h5>
            <a href="{{ route('tambahedukasi') }}"class="btn mb-3" style="background-color: #0d6efd; border-color: #0d6efd; color: #fff;">
            <i class="bi bi-plus-circle"></i> Tambah
          </a>


              <!-- Bordered Table -->
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Judul</th>
                    <th scope="col">Deskripsi</th>
                    <th scope="col">Tanggal Buat</th>
                    <th scope="col">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>Makanan Sehat untuk Wanita PCOS</td>
                    <td>Tips memilih makanan tinggi serat dan rendah gula untuk mengurangi gejala.</td>
                    <td>2025-04-01</td>
                    <td>
                    <a href="{{ route('EditEdukasi') }}" class="btn btn-sm btn-primary me-1" title="Edit">
                      <i class="bi bi-pencil-square"></i>
                    </a>
                       </a>
                        <a href="/edukasi/hapus/1" class="btn btn-sm btn-danger" title="Hapus" onclick="return confirm('Yakin ingin menghapus konten ini?')">
                        <i class="bi bi-trash"></i>
                        </a>
                    </td>
                    </tr>

                </tbody>
              </table>
              <!-- End Bordered Table -->

            </div>
          </div>
</section>
@endsection
