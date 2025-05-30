<!DOCTYPE html>
<html>
<head>
    <title>Data Riwayat</title>
    <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }
        th, td {
            padding: 6px;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <h2>Data Riwayat</h2>
    <table width="100%">
        <thead>
            <tr>
                <th>No</th>
                <th>ID Riwayat</th>
                <th>ID User</th>
                <th>Nama</th>
                <th>Umur</th>
                <th>Tanggal Diagnosa</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($riwayat as $index => $r)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $r->id_riwayat }}</td>
                <td>{{ $r->id_user }}</td>
                <td>{{ $r->nama }}</td>
                <td>{{ $r->umur }}</td>
                <td>{{ $r->tanggal_diagnosa }}</td>
                <td>{{ $r->status }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
