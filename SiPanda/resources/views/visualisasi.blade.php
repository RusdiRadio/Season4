@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="pagetitle">
  <h1>Dashboard</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
      <li class="breadcrumb-item active">Visualisasi</li>
    </ol>
  </nav>
</div>

<section class="section">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Pie Chart Jumlah Terdiagnosa PCOS Berdasarkan Umur</h5>

        <!-- Pie Chart -->
        <div id="pieChart"></div>

        <script>
          document.addEventListener("DOMContentLoaded", () => {
            new ApexCharts(document.querySelector("#pieChart"), {
              series: @json($pieSeries),
              chart: {
                height: 350,
                type: 'pie',
                toolbar: {
                  show: true
                }
              },
              labels: @json($pieLabels)
            }).render();
          });
        </script>
        <!-- End Pie Chart -->

      </div>
    </div>
  </div>
</section>

@endsection
