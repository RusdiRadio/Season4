<!DOCTYPE html>
<html>
<head>
    <title>Data Prediksi</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        table, th, td {
            border: 1px solid black;
            padding: 6px;
            text-align: center;
        }
        th {
            background-color: #eee;
        }
    </style>
</head>
<body>
    <h2 style="text-align:center;">Laporan Data Prediksi</h2>
    <table>
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
                <td>{{ \Carbon\Carbon::parse($p->tanggal_diagnosa)->format('d-m-Y') }}</td>
                <td>{{ $p->status_diagnosa }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
