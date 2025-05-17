<div class="container-fluid p-0">
        <nav class="navbar navbar-expand-lg bg-white navbar-light py-3 py-lg-0 px-lg-5">
            <a href="#" class="navbar-brand ml-lg-3">
            <h1 class="m-0 text-uppercase" style="color: #f0afbf;">
                <img src="{{ asset('assets1/img/4.png') }}" alt="Logo" style="height: 40px; width: auto;" class="me-2">
                OvaSafe
            </h1>

            </a>
            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-between px-lg-3" id="navbarCollapse">
                <div class="navbar-nav mx-auto py-0">
                    <a href="#" class="nav-item nav-link active">Home</a>
                    <a href="#tentang" class="nav-item nav-link">Tentang</a> 
                    <a href="#tentang1" class="nav-item nav-link">Pengenalan PCOS</a> 
                    <a href="#edukasi" class="nav-item nav-link">Edukasi</a>

                    <!-- <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Fitur</a>
                    <div class="dropdown-menu m-0">
                            <a href="detail.html" class="dropdown-item">Data User</a>
                            <a href="feature.html" class="dropdown-item">Riwayat</a>
                            <a href="team.html" class="dropdown-item">Manajemen Edukasi</a>
                        </div>
                        </div> -->
                        <!-- <a href="#" class="nav-item nav-link">Kontak</a> -->
                        </div>

                        <a href="{{ route('login') }}" class="btn py-2 px-4 d-none d-lg-block me-2"
                            style="background-color: white; border: 1px solid gray; color: #f0afbf;">
                            Login
                        </a>

                        <a href="{{ route('register') }}" class="btn py-2 px-4 d-none d-lg-block"
                        style="background-color: #f0afbf; border: 1px solid gray; color: white;">
                        Daftar
                    </a>
            </div>
        </nav>
    </div>