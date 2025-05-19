<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />

  <title>OvaSafe</title>

  <!-- CSS dan lainnya seperti sebelumnya... -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet" />
  <link href="assets/css/style.css" rel="stylesheet" />
</head>

<body>
  <main>
    <div class="container">
      <section
        class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4"
      >
        <div class="container">
          <div class="row justify-content-center">
            <div
              class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center"
            >
              <div class="d-flex justify-content-center py-4">
                <a href="index.html" class="logo d-flex align-items-center w-auto">
                  <img src="assets/img/4.png" alt="" />
                  <span class="d-none d-lg-block">OvaSafe</span>
                </a>
              </div>
              <!-- End Logo -->

              <div class="card mb-3">
                <div class="card-body">
                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
                    <p class="text-center small">
                      Enter your username & password to login
                    </p>
                  </div>

                  <!-- Tampilkan pesan success jika ada -->
                  @if(session('success'))
                  <div class="alert alert-success">
                    {{ session('success') }}
                  </div>
                  @endif

                  <!-- Tampilkan pesan error dari validasi dan error login -->
                  @if ($errors->any())
                  <div class="alert alert-danger">
                    <ul class="mb-0">
                      @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                      @endforeach
                    </ul>
                  </div>
                  @endif

                  <form
                    method="POST"
                    action="{{ route('login') }}"
                    class="row g-3 needs-validation"
                    novalidate
                  >
                    @csrf
                    <div class="col-12">
                      <label for="yourUsername" class="form-label">Username</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                        <input
                          type="text"
                          name="username"
                          class="form-control @error('username') is-invalid @enderror"
                          id="yourUsername"
                          value="{{ old('username') }}"
                          required
                        />
                        <div class="invalid-feedback">
                          @error('username')
                          {{ $message }}
                          @else
                          Please enter your username.
                          @enderror
                        </div>
                      </div>
                    </div>

                    <!-- Bagian password dengan icon mata -->
                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Password</label>
                      <div class="input-group has-validation">
                        <input
                          type="password"
                          name="password"
                          class="form-control @error('password') is-invalid @enderror"
                          id="yourPassword"
                          required
                        />
                        <button
                          type="button"
                          class="btn btn-outline-secondary"
                          id="togglePassword"
                          tabindex="-1"
                        >
                          <i class="bi bi-eye" id="togglePasswordIcon"></i>
                        </button>
                        <div class="invalid-feedback">
                          @error('password')
                          {{ $message }}
                          @else
                          Please enter your password!
                          @enderror
                        </div>
                      </div>
                    </div>

                    <div class="col-12">
                      <div class="form-check">
                        <input
                          class="form-check-input"
                          type="checkbox"
                          name="remember"
                          value="true"
                          id="rememberMe"
                          {{ old('remember') ? 'checked' : '' }}
                        />
                        <label class="form-check-label" for="rememberMe">Remember me</label>
                      </div>
                    </div>

                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit">Login</button>
                    </div>

                    <div class="col-12">
                      <p class="small mb-0">
                        Don't have an account?
                        <a href="{{ route('register') }}">Create an account</a>
                      </p>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </main>
  <!-- End #main -->

  <!-- JS Files seperti sebelumnya -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <script>
    const togglePassword = document.querySelector("#togglePassword");
    const passwordInput = document.querySelector("#yourPassword");
    const toggleIcon = document.querySelector("#togglePasswordIcon");

    togglePassword.addEventListener("click", function () {
      const type =
        passwordInput.getAttribute("type") === "password" ? "text" : "password";
      passwordInput.setAttribute("type", type);

      if (type === "password") {
        toggleIcon.classList.remove("bi-eye-slash");
        toggleIcon.classList.add("bi-eye");
      } else {
        toggleIcon.classList.remove("bi-eye");
        toggleIcon.classList.add("bi-eye-slash");
      }
    });
  </script>
</body>

</html>
