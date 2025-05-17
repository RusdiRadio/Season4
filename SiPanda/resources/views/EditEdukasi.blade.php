@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="pagetitle">
  <h1>Dashboard</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
      <li class="breadcrumb-item active">Edit Edukasi</li>
    </ol>
  </nav>
</div>

<section class="section">
  <div class="row">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Form Edit Edukasi</h5>

        <!-- Vertical Form -->
        <form class="row g-3" method="POST" action="#" enctype="multipart/form-data">
          @csrf
          <div class="col-12">
            <label for="judul" class="form-label">Judul</label>
            <input type="text" class="form-control" id="judul" name="judul" placeholder="Masukkan judul">
          </div>

          <div class="col-12">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" placeholder="Tuliskan deskripsi..."></textarea>
          </div>

          <div class="col-12">
            <label for="tanggal" class="form-label">Tanggal Buat</label>
            <input type="date" class="form-control" id="tanggal" name="tanggal">
          </div>

          <div class="col-12">
            <label for="foto" class="form-label">Upload Gambar (Opsional)</label>
            <input class="form-control" type="file" id="foto" name="foto" accept="image/*">
          </div>

          <div class="text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
            <button type="button" class="btn btn-secondary" onclick="window.location.href='{{ route('edukasi') }}'">Reset</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</section>
@endsection
