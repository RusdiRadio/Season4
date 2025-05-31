<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
      <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : 'collapsed' }}" href="{{ route('dashboard') }}">
      <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

        <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#dataDropdown" data-bs-toggle="collapse" href="#">
          <i class="bi bi-card-list"></i><span>Data Master</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="dataDropdown" class="nav-content collapse {{ request()->routeIs('dataUser', 'Riwayat') ? 'show' : '' }}" data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{ route('dataUser') }}" class="{{ request()->routeIs('dataUser') ? 'active' : '' }}">
              <i class="bi bi-person"></i><span>Data User</span>
            </a>
          </li>
          <li>
            <a href="{{ route('riwayat') }}" class="{{ request()->routeIs('riwayat') ? 'active' : '' }}">
              <i class="bi bi-clock-history"></i><span>Riwayat</span>
            </a>
          </li>
        </ul>
      </li><!-- End data-->

      <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('visualisasi') ? 'active' : 'collapsed' }}" href="{{ route('visualisasi') }}">
          <i class="bi bi-pie-chart"></i>
                <span>Visualisasi</span>
              </a>
      </li><!-- End data User Page Nav -->

      <li class="nav-item">
      <a class="nav-link {{ request()->routeIs('prediksi') ? 'active' : 'collapsed' }}" href="{{ route('prediksi') }}">
    <i class="bi bi-graph-up"></i>
          <span>Prediksi</span>
        </a>
      </li><!-- End prediksi Page Nav -->

      
      <li class="nav-item">
      <a class="nav-link {{ request()->routeIs('info-edukasi') ? 'active' : 'collapsed' }}" href="{{ route('info-edukasi') }}">
      <i class="bi bi-book"></i>
          <span>Info PCOS & edukasi </span>
        </a>
      </li><!-- End data User Page Nav -->

      <!-- <li class="nav-heading">LAPORAN</li>

      <li class="nav-item">
      <a class="nav-link {{ request()->routeIs('cetakDat') ? 'active' : 'collapsed' }}" href="{{ route('cetakData') }}">
      <i class="bi bi-box-arrow-up"></i>
          <span>Export Data</span>
        </a>
      </li> end prediksi -->


      

    </ul>

  </aside>