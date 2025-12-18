<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Titik Lokasi</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 10px;
        }

        .title {
            text-align: center;
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .subtitle {
            text-align: center;
            font-size: 11px;
            margin-bottom: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #000;
            padding: 4px 6px;
            text-align: center;
            vertical-align: middle;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        .text-left {
            text-align: left;
        }

        .footer {
            margin-top: 15px;
            font-size: 9px;
            text-align: right;
        }
    </style>
</head>
<body>

    <div class="title">LAPORAN DATA TITIK LOKASI JARINGAN</div>
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
                <th>TAHUN</th>
                <th>STATUS</th>
                <th>BACKBONE</th>
                <th>UPLINK</th>
                <th>PERANGKAT</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($data as $row)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td class="text-left">{{ $row->nama_titik }}</td>
                    <td>{{ $row->wilayah->nama_wilayah ?? '-' }}</td>
                    <td>{{ $row->kec_kel->nama_kec_kel ?? '-' }}</td>
                    <td>{{ $row->klasifikasi->klasifikasi ?? '-' }}</td>
                    <td>{{ $row->koneksi }}</td>
                    <td>
                        {{ $row->koneksi === 'FO' ? ($row->panjang_fo ?? '-') : '-' }}
                    </td>
                    <td>{{ $row->tahun_pembangunan }}</td>
                    <td>{{ $row->status }}</td>
                    <td>{{ $row->backbone->jenis_backbone ?? '-' }}</td>
                    <td>{{ $row->uplink->jenis_uplink ?? '-' }}</td>
                    <td>{{ $row->perangkat }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Sistem Manajemen Aset Infrastruktur
    </div>

</body>
</html>
