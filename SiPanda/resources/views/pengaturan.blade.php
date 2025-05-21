@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="pagetitle">
  <h1>Dashboard</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
      <li class="breadcrumb-item active">Profile</li>
    </ol>
  </nav>
</div>

<section class="section profile">
      <div class="row">
        <div class="col-xl-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

              <img src="assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
              @php $user = auth()->user(); @endphp

              <h2>{{ $user->nama }}</h2>
              <h3>Petugas Puskesmas</h3>
              <!-- <div class="social-links mt-2">
                <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
              </div> -->
            </div>
          </div>

        </div>

        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                </li>

                <!-- <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-settings">Settings</button>
                </li> -->

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
                </li>

              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">

                  <h5 class="card-title">Profile Details</h5>

                  <div class="row">
                  <div class="col-lg-3 col-md-4 label">Nama</div>

                  <div class="col-lg-9 col-md-8">
                    @if(Auth::check())
                      {{ Auth::user()->nama }}
                    @else
                      <em>Belum login</em>
                    @endif
                  </div>
                </div>


                  <!-- <div class="row">
                    <div class="col-lg-3 col-md-4 label">Company</div>
                    <div class="col-lg-9 col-md-8">Lueilwitz, Wisoky and Leuschke</div>
                  </div> -->

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Pekerjaan</div>
                    <div class="col-lg-9 col-md-8"> </div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Alamat</div>
                    <div class="col-lg-9 col-md-8"> </div>
                  </div>

                  <!-- <div class="row">
                    <div class="col-lg-3 col-md-4 label">Address</div>
                    <div class="col-lg-9 col-md-8">A108 Adam Street, New York, NY 535022</div>
                  </div> -->

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Phone</div>
                    <div class="col-lg-9 col-md-8"></div>
                  </div>

                  <div class="row">
                  <div class="col-lg-3 col-md-4 label">Email</div>
                  <div class="col-lg-9 col-md-8">
                    @if(Auth::check())
                      {{ Auth::user()->email }}
                    @else
                      <em>Belum login</em>
                    @endif
                  </div>
                </div>
                </div>

                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                  <!-- Profile Edit Form -->
                      <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row mb-3">
                          <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                          <div class="col-md-8 col-lg-9">
                      <img src="{{ Auth::check() && Auth::user()->foto ? asset('storage/profile/' . Auth::user()->foto) : asset('assets/img/profile-img.jpg') }}" alt="Profile" class="img-thumbnail" width="150">

                            <div class="pt-2">
                              <input type="file" name="image" id="image" accept="image/*" style="display: none;" onchange="document.getElementById('profileForm').submit();">
                              <label for="image" class="btn btn-primary btn-sm" title="Upload new profile image" style="cursor:pointer;">
                                <i class="bi bi-upload"></i>
                              </label>

                            @if(Auth::check() && Auth::user()->foto)
                              <button type="submit" name="delete_photo" value="1" class="btn btn-danger btn-sm" title="Remove my profile image" onclick="return confirm('Yakin ingin menghapus foto profil?')">
                                <i class="bi bi-trash"></i>
                              </button>
                              @endif
                            </div>
                          </div>
                        </div>

                        <div class="row mb-3">
                          <label class="col-lg-3 col-md-4 col-form-label">Nama</label>
                          <div class="col-lg-9 col-md-8">
                            <input type="text" class="form-control" value="{{ Auth::guard('admin')->user()->nama }}" readonly>
                          </div>
                        </div>

                        <div class="row mb-3">
                          <label class="col-lg-3 col-md-4 col-form-label" for="pekerjaan">Pekerjaan</label>
                          <div class="col-lg-9 col-md-8">
                            <input type="text" name="pekerjaan" id="pekerjaan" class="form-control" value="{{ old('pekerjaan', Auth::guard('admin')->user()->pekerjaan) }}">
                          </div>
                        </div>

                        <div class="row mb-3">
                          <label class="col-lg-3 col-md-4 col-form-label" for="alamat">Alamat</label>
                          <div class="col-lg-9 col-md-8">
                            <textarea name="alamat" id="alamat" class="form-control">{{ old('alamat', Auth::guard('admin')->user()->alamat) }}</textarea>
                          </div>
                        </div>

                        <div class="row mb-3">
                          <label class="col-lg-3 col-md-4 col-form-label" for="no_hp">No HP</label>
                          <div class="col-lg-9 col-md-8">
                            <input type="text" name="no_hp" id="no_hp" class="form-control" value="{{ old('no_hp', Auth::guard('admin')->user()->no_hp) }}">
                          </div>
                        </div>

                        <div class="row mb-3">
                          <label class="col-lg-3 col-md-4 col-form-label">Email</label>
                          <div class="col-lg-9 col-md-8">
                            <input type="email" class="form-control" value="{{ Auth::guard('admin')->user()->email }}" readonly>
                          </div>
                        </div>

                        <div class="row mb-3">
                          <div class="col-lg-9 col-md-8 offset-lg-3 offset-md-4">
                            <button type="submit" class="btn btn-primary">Update Profil</button>
                          </div>
                        </div>
                      </form>
                </div>
                <div class="tab-pane fade pt-3" id="profile-settings">

                  <!-- Settings Form -->
                  <!-- <form>

                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Email Notifications</label>
                      <div class="col-md-8 col-lg-9">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="changesMade" checked>
                          <label class="form-check-label" for="changesMade">
                            Changes made to your account
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="newProducts" checked>
                          <label class="form-check-label" for="newProducts">
                            Information on new products and services
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="proOffers">
                          <label class="form-check-label" for="proOffers">
                            Marketing and promo offers
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="securityNotify" checked disabled>
                          <label class="form-check-label" for="securityNotify">
                            Security alerts
                          </label>
                        </div>
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                  </form>End settings Form -->

                </div>

                <div class="tab-pane fade pt-3" id="profile-change-password">
                  <!-- Change Password Form -->
                  <form>

                    <div class="row mb-3">
                      <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Password lama</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="password" type="password" class="form-control" id="currentPassword">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">Password Baru</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="newpassword" type="password" class="form-control" id="newPassword">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">masukkan Password Baru</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="renewpassword" type="password" class="form-control" id="renewPassword">
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Change Password</button>
                    </div>
                  </form><!-- End Change Password Form -->

                </div>

              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>
      </div>
    </section>
@endsection
