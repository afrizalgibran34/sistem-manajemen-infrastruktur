<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Data Stok Barang</title>

    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #000;
            padding: 6px;
            text-align: left;
        }
        th {
            background: #f0f0f0;
            font-weight: bold;
            text-align: center;
        }
    </style>
</head>
<body>

<h2>Data Stok Barang</h2>

<table>
    <thead>
        <tr>
            <th>NO</th>
            <th>NAMA BARANG</th>
            <th>JENIS BARANG</th>
            <th>KUANTITAS</th>
            <th>SATUAN</th>
            <th>TERPAKAI</th>
            <th>SISA</th>
            <th>KONDISI</th>
            <th>TAHUN PENGADAAN</th>
            <th>KETERANGAN</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($data as $row)
        <tr>
            <td style="text-align:center">{{ $loop->iteration }}</td>
            <td>{{ $row->barang->nama_barang ?? '-' }}</td>
            <td>{{ $row->barang->jenis_barang ?? '-' }}</td>
            <td style="text-align:center">{{ $row->kuantitas }}</td>
            <td style="text-align:center">{{ $row->satuan }}</td>
            <td style="text-align:center">{{ $row->terpakai }}</td>
            <td style="text-align:center">{{ $row->sisa }}</td>
            <td style="text-align:center">{{ $row->kondisi ?? '-' }}</td>
            <td style="text-align:center">{{ $row->tahun_pengadaan ?? '-' }}</td>
            <td>{{ $row->keterangan }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>
