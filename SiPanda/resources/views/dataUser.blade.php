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
            </div>

              <!-- Bordered Table -->
              <table class="table table-bordered">
              <thead>
                <tr>
                  <th scope="col" class="text-center">No</th>
                  <th scope="col">Nama</th>
                  <th scope="col">Username</th>
                  <th scope="col">Email</th>
                </tr>
              </thead>
              <tbody>
              @forelse ($pengguna as $index => $user)
                <tr>
                  <td>{{ $index + 1 }}</td>
                  <td>{{ $user->nama }}</td>
                  <td>{{ $user->username }}</td>
                  <td>{{ $user->email }}</td>
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
