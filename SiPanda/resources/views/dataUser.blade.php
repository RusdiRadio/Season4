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
              <div class="mb-3">
              <a href="/export/excel" class="btn btn-success"><i class="fa fa-file-excel"></i> Export to Excel</a>
              <a href="/export/pdf" class="btn btn-danger"><i class="fa fa-file-pdf"></i> Export to PDF</a>
            </div>

              <!-- Bordered Table -->
              <table class="table table-bordered">
              <thead>
                <tr>
                  <th scope="col" class="text-center">No</th>
                  <th scope="col">ID</th>
                  <th scope="col">Nama</th>
                  <th scope="col">Username</th>
                  <th scope="col">Email</th>
                  <th scope="col">Password</th>
                </tr>
              </thead>
              <tbody>
              @forelse ($pengguna as $index => $user)
                <tr>
                  <td>{{ $index + 1 }}</td>
                  <td>{{ $user->id_user }}</td>
                  <td>{{ $user->nama }}</td>
                  <td>{{ $user->username }}</td>
                  <td>{{ $user->email }}</td>
                  <td>{{ \Illuminate\Support\Str::limit($user->password, 20, '...') }}</td>
                </tr>
              @empty
                <tr>
                  <td colspan="6" class="text-center">Tidak ada data pengguna.</td>
                </tr>
              @endforelse
            </tbody>
          </table>

              <!-- End Bordered Table -->

            </div>
          </div>
</section>
@endsection
