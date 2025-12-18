<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Stok Barang</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #000;
        }
        th {
            background: #f0f0f0;
            text-align: center;
        }
        td {
            padding: 4px;
            vertical-align: middle;
        }
        h3 {
            text-align: center;
            margin-bottom: 10px;
        }
        img {
            max-width: 60px;
            max-height: 60px;
        }
    </style>
</head>
<body>

<h3>LAPORAN STOK BARANG</h3>

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Barang</th>
            <th>Jenis Barang</th>
            <th>Kuantitas</th>
            <th>Satuan</th>
            <th>Terpakai</th>
            <th>Sisa</th>
            <th>Foto</th>
            <th>Keterangan</th>
            <th>Kondisi</th>
            <th>Tahun Pengadaan</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($data as $row)
        <tr>
            <td align="center">{{ $loop->iteration }}</td>
            <td>{{ $row->barang->nama_barang ?? '-' }}</td>
            <td>{{ $row->barang->jenis_barang ?? '-' }}</td>
            <td align="center">{{ $row->kuantitas }}</td>
            <td align="center">{{ $row->satuan }}</td>
            <td align="center">{{ $row->terpakai }}</td>
            <td align="center">{{ $row->sisa }}</td>

           <td align="center">
                @php
                    $fotoPath = storage_path('app/public/' . $row->foto);
                @endphp

                @if ($row->foto && file_exists($fotoPath))
                    <img src="{{ $fotoPath }}" style="width:60px;">
                @else
                    -
                @endif
            </td>
            <td>{{ $row->keterangan }}</td>
            <td align="center">{{ $row->kondisi ?? '-' }}</td>
            <td align="center">{{ $row->tahun_pengadaan ?? '-' }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>
