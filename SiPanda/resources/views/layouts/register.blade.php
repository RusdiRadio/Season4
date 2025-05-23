<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />

  <title>OvaSafe</title>
  <meta content="" name="description" />
  <meta content="" name="keywords" />

  <!-- Favicons -->
  <link href="{{ asset('assets/img/4.png') }}" rel="icon" />
  <link href="{{ asset('assets/img/4.png') }}" rel="apple-touch-icon" />

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect" />
  <link
    href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
    rel="stylesheet"
  />

  <!-- Vendor CSS Files -->
  <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/vendor/quill/quill.snow.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/vendor/simple-datatables/style.css') }}" rel="stylesheet" />

  <!-- Template Main CSS File -->
  <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" />
</head>

<body>
  <main>
    <div class="container">
      <section
        class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4"
      >
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
              <div class="d-flex justify-content-center py-4">
                <a href="{{ url('/') }}" class="logo d-flex align-items-center w-auto">
                  <img src="{{ asset('assets/img/4.png') }}" alt="" />
                  <span class="d-none d-lg-block">OvaSafe</span>
                </a>
              </div>

              <div class="card mb-3">
                <div class="card-body">
                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Create an Account</h5>
                  </div>

                  @if ($errors->any())
                  <div class="alert alert-danger">
                    <ul class="mb-0">
                      @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                      @endforeach
                    </ul>
                  </div>
                  @endif

                <form method="POST" action="{{ route('register') }}" autocomplete="off" class="row g-3 needs-validation" novalidate>
                  @csrf

                    <div class="col-12">
                      <label for="nama" class="form-label">Nama</label>
                      <input
                        type="text"
                        name="nama"
                        class="form-control"
                        id="nama"
                        value="{{ old('nama') }}"
                        required
                      />
                      <div class="invalid-feedback">Please, enter your name!</div>
                    </div>

                    <div class="col-12">
                      <label for="yourEmail" class="form-label">Email</label>
                      <input
                        type="email"
                        name="email"
                        class="form-control"
                        id="yourEmail"
                        value="{{ old('email') }}"
                        required
                      />
                      <div class="invalid-feedback">Please enter a valid Email address!</div>
                    </div>

                    <div class="col-12">
                      <label for="yourUsername" class="form-label">Username</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                        <input type="text" name="username" class="form-control" id="yourUsername"
                          value="{{ old('username') }}" autocomplete="off" required />
                        <div class="invalid-feedback">Please choose a username.</div>
                      </div>
                    </div>

                    <div class="col-12 position-relative">
                      <label for="yourPassword" class="form-label">Password</label>
                      <div class="input-group">
                        <input type="password" name="password" class="form-control" id="yourPassword"
                          autocomplete="new-password" required />
                        <span class="input-group-text toggle-password" style="cursor: pointer;">
                          <i class="bi bi-eye" id="togglePasswordIcon"></i>
                        </span>
                        <div class="invalid-feedback">Please enter your password!</div>
                      </div>
                    </div>

                    <div class="col-12 position-relative">
                      <label for="yourPasswordConfirm" class="form-label">Confirm Password</label>
                      <div class="input-group">
                        <input
                          type="password"
                          name="password_confirmation"
                          class="form-control"
                          id="yourPasswordConfirm"
                          required
                        />
                        <span class="input-group-text toggle-password" style="cursor: pointer;">
                          <i class="bi bi-eye" id="togglePasswordConfirmIcon"></i>
                        </span>
                        <div class="invalid-feedback">Please confirm your password!</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <div class="form-check">
                        <input
                          class="form-check-input"
                          name="terms"
                          type="checkbox"
                          value="1"
                          id="acceptTerms"
                          required
                        />
                        <label class="form-check-label" for="acceptTerms"
                          >I agree and accept the
                          <a href="#">terms and conditions</a></label
                        >
                        <div class="invalid-feedback">You must agree before submitting.</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit">Create Account</button>
                    </div>

                    <div class="col-12">
                      <p class="small mb-0">
                        Already have an account?
                        <a href="{{ route('login') }}">Log in</a>
                      </p>
                    </div>
                  </form>
                </div>
              </div>

              <div class="credits">
                <!-- Designed by BootstrapMade -->
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </main>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"
    ><i class="bi bi-arrow-up-short"></i
  ></a>

  <!-- Vendor JS Files -->
  <script src="{{ asset('assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/chart.js/chart.umd.js') }}"></script>
  <script src="{{ asset('assets/vendor/echarts/echarts.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/quill/quill.js') }}"></script>
  <script src="{{ asset('assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
  <script src="{{ asset('assets/vendor/tinymce/tinymce.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>

  <!-- Template Main JS File -->
  <script src="{{ asset('assets/js/main.js') }}"></script>

  <!-- Toggle password visibility -->
  <script>
    const togglePassword = document.querySelector('#togglePasswordIcon');
    const password = document.querySelector('#yourPassword');

    togglePassword.addEventListener('click', function () {
      const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
      password.setAttribute('type', type);
      this.classList.toggle('bi-eye');
      this.classList.toggle('bi-eye-slash');
    });

    const togglePasswordConfirm = document.querySelector('#togglePasswordConfirmIcon');
    const passwordConfirm = document.querySelector('#yourPasswordConfirm');

    togglePasswordConfirm.addEventListener('click', function () {
      const type = passwordConfirm.getAttribute('type') === 'password' ? 'text' : 'password';
      passwordConfirm.setAttribute('type', type);
      this.classList.toggle('bi-eye');
      this.classList.toggle('bi-eye-slash');
    });
  </script>
</body>

</html>
