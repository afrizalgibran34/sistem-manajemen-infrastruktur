<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Data Titik Lokasi</title>

    <style>
        body {
            font-family: sans-serif;
            font-size: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #000;
            padding: 4px;
        }

        th {
            text-align: center;
            font-weight: bold;
        }

        td {
            text-align: center;
        }

        td:nth-child(2),
        td:nth-child(3),
        td:nth-child(4),
        td:nth-child(5),
        td:nth-child(10),
        td:nth-child(11),
        td:nth-child(12) {
            text-align: left;
        }

        @page {
            margin: 1cm 1cm 3cm 1cm;
        }
    </style>
</head>
<body>

<h2 style="text-align:center;">Data Titik Lokasi</h2>

@if($filters['search'] || $filters['wilayah'] || $filters['tahun_dari'] || $filters['tahun_sampai'])
<div style="margin-bottom: 10px;">
    <strong>Data Berdasarkan:</strong><br>
    @if($filters['search'])
        Titik Lokasi: {{ $filters['search'] }}<br>
    @endif
    @if($filters['wilayah'])
        Wilayah: {{ $filters['wilayah'] }}<br>
    @endif
    @if($filters['tahun_dari'] || $filters['tahun_sampai'])
        Tahun Pembangunan: 
        @if($filters['tahun_dari'] && $filters['tahun_sampai'])
            {{ $filters['tahun_dari'] }} - {{ $filters['tahun_sampai'] }}
        @elseif($filters['tahun_dari'])
            Dari {{ $filters['tahun_dari'] }}
        @elseif($filters['tahun_sampai'])
            Sampai {{ $filters['tahun_sampai'] }}
        @endif
        <br>
    @endif
</div>
@endif

<table>
    <thead>
        <tr>
            <th>NO</th>
            <th>TITIK LOKASI</th>
            <th>WILAYAH</th>
            <th>PD / UNIT</th>
            <th>KLASIFIKASI</th>
            <th>KONEKSI</th>
            <th>PANJANG FO (m)</th>
            <th>TAHUN PEMBANGUNAN</th>
            <th>STATUS</th>
            <th>BACKBONE</th>
            <th>UPLINK</th>
            <th>PERANGKAT</th>
        </tr>
    </thead>

    <tbody>
        @forelse ($data as $row)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $row->nama_titik }}</td>
            <td>{{ $row->wilayah->nama_wilayah ?? '-' }}</td>
            <td>{{ $row->kec_kel->nama_kec_kel ?? '-' }}</td>
            <td>{{ $row->klasifikasi->klasifikasi ?? '-' }}</td>
            <td>{{ $row->koneksi }}</td>
            <td>
                @if($row->koneksi === 'FO')
                    {{ $row->panjang_fo ?? '-' }}
                @else
                    -
                @endif
            </td>
            <td>{{ $row->tahun_pembangunan }}</td>
            <td>{{ $row->status }}</td>
            <td>{{ $row->backbone->jenis_backbone ?? '-' }}</td>
            <td>{{ $row->uplink->jenis_uplink ?? '-' }}</td>
            <td>{{ $row->perangkat }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="12" style="text-align: center; padding: 20px;">
                Tidak ada data
            </td>
        </tr>
        @endforelse
    </tbody>
</table>

</body>
</html>