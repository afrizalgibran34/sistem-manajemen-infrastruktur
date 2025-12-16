<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Data Barang Keluar</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
        }
        h3 {
            text-align: center;
            margin-bottom: 10px;
        }
        .meta {
            margin-bottom: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #000;
            padding: 5px;
            text-align: center;
        }
        th {
            background: #f0f0f0;
        }
    </style>
</head>
<body>

<h3>LAPORAN DATA BARANG KELUAR</h3>

<div class="meta">
    Tanggal Cetak: {{ date('d-m-Y') }}
</div>

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Lokasi</th>
            <th>Barang</th>
            <th>Jumlah</th>
            <th>Keterangan</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $i => $row)
        <tr>
            <td>{{ $i + 1 }}</td>
            <td>{{ \Carbon\Carbon::parse($row->tanggal)->format('d-m-Y') }}</td>
            <td>{{ $row->lokasi->nama_lokasi ?? '-' }}</td>
            <td>{{ $row->barang->nama_barang ?? '-' }}</td>
            <td>{{ $row->jumlah }}</td>
            <td>{{ $row->keterangan }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>
