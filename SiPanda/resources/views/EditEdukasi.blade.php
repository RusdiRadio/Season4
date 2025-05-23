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
       <form class="row g-3" method="POST" action="{{ route('UpdateEdukasi', $edukasi->id) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')


      <div class="col-12">
        <label for="id" class="form-label">Id</label>
        <input type="text" class="form-control" id="id" name="id" value="{{ $edukasi->id }}" readonly>
      </div>

      <div class="col-12">
        <label for="judul" class="form-label">Judul</label>
        <input type="text" class="form-control" id="judul" name="judul" value="{{ $edukasi->judul }}">
      </div>

      <div class="col-12">
        <label for="konten" class="form-label">Konten <small>(Ganti jika ingin mengubah)</small></label>
        <input class="form-control" type="file" id="konten" name="konten">
        <small>File saat ini: {{ $edukasi->konten }}</small>
      </div>

      <div class="col-12">
        <label for="deskripsi" class="form-label">Deskripsi</label>
        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3">{{ $edukasi->deskripsi }}</textarea>
      </div>

      <!-- <div class="col-12">
        <label for="tanggal" class="form-label">Tanggal Buat</label>
        <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ \Carbon\Carbon::parse($edukasi->tanggal)->format('Y-m-d') }}">
      </div> -->

      <div class="text-center">
        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="{{ route('edukasi') }}" class="btn btn-secondary">Kembali</a>
      </div>
    </form>

          </div>
    </div>
  </div>
</section>
@endsection
