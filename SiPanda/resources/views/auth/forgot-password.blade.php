<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <title>Forgot Password | OvaSafe</title>

  <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" />
</head>

<body>
  <main>
    <div class="container">
      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="{{ url('/') }}" class="logo d-flex align-items-center w-auto">
                  <img src="{{ asset('assets/img/4.png') }}" alt="OvaSafe Logo" />
                  <span class="d-none d-lg-block">OvaSafe</span>
                </a>
              </div>

              <div class="card mb-3">
                <div class="card-body">
                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Forgot Your Password?</h5>
                    <p class="text-center small">Enter your email to reset your password</p>
                  </div>

                  @if (session('status'))
                    <div class="alert alert-success" role="alert">
                      {{ session('status') }}
                    </div>
                  @endif

                  @if ($errors->any())
                    <div class="alert alert-danger" role="alert">
                      <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                        @endforeach
                      </ul>
                    </div>
                  @endif

                  <form method="POST" action="{{ route('password.email') }}" class="row g-3 needs-validation" novalidate>
                    @csrf
                    <div class="col-12">
                      <label for="email" class="form-label">Email</label>
                      <input
                        type="email"
                        name="email"
                        id="email"
                        class="form-control @error('email') is-invalid @enderror"
                        value="{{ old('email') }}"
                        required
                        autofocus
                      />
                      <div class="invalid-feedback">
                        @error('email')
                          {{ $message }}
                        @else
                          Please enter your email address.
                        @enderror
                      </div>
                    </div>

                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit">
                        Send Password Reset Link
                      </button>
                    </div>

                    <div class="col-12 text-center">
                      <a href="{{ route('login') }}" class="small">Back to login</a>
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

  <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
