@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="pagetitle">
  <h1>Dashboard</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
      <li class="breadcrumb-item active">Riwayat</li>
    </ol>
  </nav>
</div>

<section class="section">
  <div class="row">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Tabel Prediksi</h5>

        <table class="table table-bordered">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama</th>
              <th>Umur</th>
              <th>Berat Badan</th>
              <th>Tinggi Badan</th>
              <th>Siklus Haid</th>
              <th>Lingkar Panggul</th>
              <th>Lingkar Pinggang</th>
              <th>Kenaikan Berat Badan</th>
              <th>Pertumbuhan Rambut Berlebih</th>
              <th>Penggelapan Lipatan Kulit</th>
              <th>Kerontokan Rambut</th>
              <th>Jerawat</th>
              <th>FastFood</th>
              <th>BMI</th>
              <th>Tanggal Diagnosa</th>
              <th>Status Diagnosa</th>
              <th>Edukasi</th>
            </tr>
          </thead>
          <tbody>
            @foreach($prediksi as $p)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $p->nama }}</td>
              <td>{{ $p->Umur }}</td>
              <td>{{ $p->Berat_kg }}</td>
              <td>{{ $p->Tinggi_cm }}</td>
              <td>{{ $p->Siklus_Haid }}</td>
              <td>{{ $p->Lingkar_Panggul_cm }}</td>
              <td>{{ $p->Lingkar_Pinggang_cm }}</td>
              <td>{{ $p->Kenaikan_BB ? 'Ya' : 'Tidak' }}</td>
              <td>{{ $p->Pertumbuhan_Rambut_di_Area_Tidak_Wajar ? 'Ya' : 'Tidak' }}</td>
              <td>{{ $p->Penggelapan_Kulit_di_Area_Lipatan ? 'Ya' : 'Tidak' }}</td>
              <td>{{ $p->Kerontokan_Rambut ? 'Ya' : 'Tidak' }}</td>
              <td>{{ $p->Jerawat ? 'Ya' : 'Tidak' }}</td>
              <td>{{ $p->Sering_Makan_FastFood ? 'Ya' : 'Tidak' }}</td>
              <td>{{ $p->BMI }}</td>
              <td>{{ $p->tanggal_diagnosa }}</td>
              <td>{{ $p->status_diagnosa }}</td>
             <td>
                @if ($p->status_diagnosa == "Anda terdiagnosa PCOS")
                  <button class="btn btn-primary btnLihatEdukasi" data-userid="{{ $p->id }}">Lihat Edukasi</button>
                @elseif ($p->status_diagnosa == "Anda tidak terdiagnosa PCOS")
                  <button class="btn btn-success" disabled>Selamat Selalu Jaga kesehatan Anda</button>
                @else
                  -
                @endif
              </td>

            </tr>
            @endforeach
          </tbody>
        </table>

        <!-- Modal Edukasi -->
        <div class="modal fade" id="modalEdukasi" tabindex="-1" aria-labelledby="modalEdukasiLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="modalEdukasiLabel">Informasi Edukasi PCOS</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body" id="containerEdukasi">
                <!-- Edukasi akan muncul di sini -->
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</section>
@endsection

@section('scripts')


<script>
document.querySelectorAll('.btnLihatEdukasi').forEach(button => {
  button.addEventListener('click', function() {
    fetch("{{ url('/edukasi-pcos') }}")
      .then(response => {
        if (!response.ok) throw new Error('Network response was not ok');
        return response.json();
      })
      .then(data => {
        const container = document.getElementById('containerEdukasi');
        container.innerHTML = '';

        if (data.length === 0) {
          container.innerHTML = '<p>Data edukasi belum tersedia.</p>';
        } else {
          data.forEach((item, index) => {
            const fullText = item.deskripsi || '';
            let deskripsiOnly = fullText;
            let tipsText = '';

            // Pisahkan bagian "Tips" dari deskripsi jika ada
            if (fullText.includes('Tips')) {
              const parts = fullText.split('Tips');
              deskripsiOnly = parts[0].trim();
              tipsText = parts[1].trim();
            }

            // Proses tips menjadi poin-poin
            let tipsHtml = '';
            if (tipsText) {
              const tipsList = tipsText.split(/\d+\.\s*/).filter(Boolean);
              if (tipsList.length > 0) {
                tipsHtml += `<div class="mt-2"><h6><strong>Tips:</strong></h6>`;
                tipsList.forEach((tip, i) => {
                  tipsHtml += `<p style="text-align: justify; margin-left: 1rem;"><strong>${i + 1}.</strong> ${tip.trim()}</p>`;
                });
                tipsHtml += `</div>`;
              } else {
                tipsHtml += `<div class="mt-2"><h6><strong>Tips:</strong></h6><p style="text-align: justify; margin-left: 1rem;">${tipsText}</p></div>`;
              }
            }

            // Tampilkan konten edukasi
            container.innerHTML += `
              <div style="margin-bottom: 25px;">
                <h5>${index + 1}. ${item.judul}</h5>
                <img src="{{ asset('storage/images') }}/${item.konten}" style="max-width:100%; height:auto; margin-bottom:10px;">
                <p style="text-align: justify;">${deskripsiOnly}</p>
                ${tipsHtml}
              </div>
            `;
          });
        }

        const modal = new bootstrap.Modal(document.getElementById('modalEdukasi'));
        modal.show();
      })
      .catch(err => {
        alert('Gagal mengambil data edukasi. Cek console untuk detail.');
        console.error('Fetch error:', err);
      });
  });
});
</script>


@endsection
