<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Gangguan Jaringan</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 11px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #000;
            padding: 5px;
            text-align: left;
        }

        th {
            background: #f0f0f0;
        }

        h3 {
            text-align: center;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<h3>LAPORAN GANGGUAN JARINGAN</h3>

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Bulan</th>
            <th>Tanggal</th>
            <th>Wilayah</th>
            <th>Titik / Lokasi Layanan</th>
            <th>FO / Wireless</th>
            <th>Jenis Masalah</th>
            <th>Keterangan</th>
            <th>Penanganan</th>
            <th>Jumlah Kunjungan</th>
            <th>Status Masalah</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $i => $row)
        <tr>
            <td>{{ $i + 1 }}</td>
            <td>{{ $row->bulan }}</td>
            <td>{{ \Carbon\Carbon::parse($row->tanggal)->format('d-m-Y') }}</td>
            <td>{{ $row->wilayah->nama_wilayah ?? '-' }}</td>
            <td>{{ $row->titik->nama_titik ?? '-' }}</td>
            <td>{{ $row->fo_wireless }}</td>
            <td>{{ $row->jenis_masalah->nama_masalah ?? '-' }}</td>
            <td>{{ $row->keterangan }}</td>
            <td>{{ $row->penanganan }}</td>
            <td>{{ $row->jumlah_kunjungan }}</td>
            <td>{{ $row->status_masalah }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>
