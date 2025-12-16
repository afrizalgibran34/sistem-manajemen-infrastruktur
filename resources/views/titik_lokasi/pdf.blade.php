<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Data Titik Lokasi</title>

    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #000; padding: 6px; text-align: left; }
        th { background: #f0f0f0; font-weight: bold; }
    </style>
</head>
<body>

<h2>Data Titik Lokasi Jaringan</h2>

<table>
    <thead>
        <tr>
            <th>NO</th>
            <th>Titik/Lokasi Layanan</th>
            <th>WILAYAH</th>
            <th>PD/UNIT KERJA/INSTANSI</th>
            <th>KLASIFIKASI AREA</th>
            <th>KONEKSI</th>
            <th>BACKBONE</th>
            <th>UPLINK</th>
            <th>PERANGKAT</th>
            <th>KETERANGAN</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($data as $row)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $row->nama_titik }}</td>
            <td>{{ $row->wilayah->nama_wilayah ?? '-' }}</td>
            <td>{{ $row->kec_kel->nama_kec_kel ?? '-' }}</td>
            <td>{{ $row->klasifikasi->klasifikasi ?? '-' }}</td>
            <td>{{ $row->koneksi }}</td>
            <td>{{ $row->backbone->jenis_backbone ?? '-' }}</td>
            <td>{{ $row->uplink->jenis_uplink ?? '-' }}</td>
            <td>{{ $row->perangkat }}</td>
            <td>{{ $row->keterangan }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>
