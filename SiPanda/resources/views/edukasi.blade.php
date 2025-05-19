@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

@php
use Illuminate\Support\Str;
@endphp
<!-- Bootstrap Icons CDN (jika belum) -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

<div class="pagetitle">
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
        <a href="{{ route('tambahedukasi') }}" class="btn mb-3" style="background-color: #0d6efd; border-color: #0d6efd; color: #fff;">
          <i class="bi bi-plus-circle"></i> Tambah
        </a>

        <!-- Bordered Table -->
        <table class="table table-bordered">
          <thead>
            <tr>
              <th scope="col">No</th>
              <th scope="col">id</th>
              <th scope="col">Judul</th>
              <th scope="col">Konten</th>
              <th scope="col">Deskripsi</th>
              <th scope="col">Tanggal Buat</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse($edukasi as $index => $data)
            <tr>
              <th scope="row">{{ $index + 1 }}</th>
              <td>{{ $data->id }}</td>   
              <td>{{ $data->judul }}</td>
              <td>
              @if($data->konten)
                <img src="{{ asset('storage/images/' . $data->konten) }}" alt="konten {{ $data->konten }}" style="max-width: 100px; height: auto;">
              @else
                <span class="text-muted">Tidak ada gambar</span>
              @endif
            </td>
            <td>{{ Str::limit($data->deskripsi, 25, '...') }}</td>
              <td>{{ $data->created_at->format('d-m-Y') }}</td>
              <td>
                @foreach ($edukasi as $item)
                  <a href="{{ route('EditEdukasi', $item->id) }}" class="btn btn-sm btn-primary me-1" title="Edit">
                    <i class="bi bi-pencil-square"></i>
                  </a>
                @endforeach

                <a href="{{ route('HapusEdukasi', $data->id) }}" class="btn btn-sm btn-danger" title="Hapus" onclick="return confirm('Yakin ingin menghapus konten ini?')">
                  <i class="bi bi-trash"></i>
                </a>
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="5" class="text-center">Tidak ada data edukasi.</td>
            </tr>
            @endforelse
          </tbody>
        </table>
        <!-- End Bordered Table -->
      </div>
    </div>
  </div>
</section>
@endsection
