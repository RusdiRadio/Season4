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
       <form class="row g-3" method="POST" action="{{ route('UpdateEdukasi', $edukasi->id_edukasi) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')


      <div class="col-12">
        <label for="id_edukasi" class="form-label">Id</label>
        <input type="text" class="form-control" id="id_edukasi" name="id_edukasi" value="{{ $edukasi->id_edukasi }}" readonly>
      </div>

      <div class="col-12">
        <label for="judul" class="form-label">Judul</label>
        <input type="text" class="form-control" id="judul" name="judul" value="{{ $edukasi->judul }}">
      </div>

      <!-- <div class="col-12">
        <label for="konten" class="form-label">Konten <small>(Ganti jika ingin mengubah)</small></label>
        <input class="form-control" type="file" id="konten" name="konten">
        <small>File saat ini: {{ $edukasi->konten }}</small>
        <img src="{{ asset('storage/' . $edukasi->konten) }}" alt="Konten" width="200">
      </div> -->

      <div class="col-12">
      <label for="konten" class="form-label">Konten <small>(Ganti jika ingin mengubah)</small></label>
      <input class="form-control" type="file" id="konten" name="konten">

      @if ($edukasi->konten)
        <div class="mt-2">
          <small>File saat ini:</small><br>
          <img src="{{ asset('storage/images/' . $edukasi->konten) }}" alt="Konten Saat Ini" width="200" class="img-thumbnail">
        </div>
      @else
        <small>Tidak ada file gambar saat ini.</small>
      @endif
    </div>


      <div class="col-12">
        <label for="deskripsi" class="form-label">Deskripsi</label>
        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3">{{ $edukasi->deskripsi }}</textarea>
      </div>

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
