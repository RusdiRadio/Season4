@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="pagetitle">
  <h1>Dashboard</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
      <li class="breadcrumb-item active">Edit Info PCOS</li>
    </ol>
  </nav>
</div>

<section class="section">
  <div class="row">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Form Edit Info PCOS</h5>

        <!-- Vertical Form -->
        <form class="row g-3" method="POST" action="{{ route('updateinfo', $info->id_info) }}" enctype="multipart/form-data">
          @csrf
          @method('PUT')

          <div class="col-12">
            <label for="id_info" class="form-label">ID</label>
            <input type="text" class="form-control" id="id_info" name="id_info" value="{{ $info->id_info }}" readonly>
          </div>

          <div class="col-12">
            <label for="judul" class="form-label">Judul</label>
            <input type="text" class="form-control" id="judul" name="judul" value="{{ $info->judul }}">
          </div>

          <div class="col-12">
            <label for="konten" class="form-label">Konten <small>(Ganti jika ingin mengubah)</small></label>
            <input class="form-control" type="file" id="konten" name="konten">

            @if ($info->konten)
              <div class="mt-2">
                <small>File saat ini:</small><br>
                <img src="{{ asset('storage/images/' . $info->konten) }}" alt="Konten Saat Ini" width="200" class="img-thumbnail">
              </div>
            @else
              <small>Tidak ada file gambar saat ini.</small>
            @endif
          </div>

          <div class="col-12">
            <label for="deskripsi" class="form-label">Deskripsi</label>
            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3">{{ $info->deskripsi }}</textarea>
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
