<div class="sidebar" data-image="{{ asset('assets/light-bootstrap/img/sidebar-5.jpg') }}">
    <div class="sidebar-wrapper">

        <div class="logo">
            <a href="{{ route('dashboard') }}" class="simple-text">
                Sistem Manajemen Aset Infrastruktur
            </a>
        </div>

        <ul class="nav">

            <li class="nav-item @if($activePage == 'dashboard') active @endif">
                <a class="nav-link" href="{{ route('dashboard') }}">
                    <i class="nc-icon nc-bank"></i>
                    <p>Dashboard</p>
                </a>
            </li>

            <li class="nav-item @if($activePage == 'peta') active @endif">
                <a class="nav-link" href="{{ route('peta') }}">
                    <i class="nc-icon nc-pin-3"></i>
                    <p>Peta Jaringan</p>
                </a>
            </li>

            <li class="nav-item">
                <a data-toggle="collapse" href="#infra"
                    class="nav-link @if(in_array($activePage,[
                        'titik_lokasi','wilayah','kec_kel','klasifikasi','koneksi','status',
                        'backbone','uplink','perangkat'
                    ])) active @endif">
                        <i class="nc-icon nc-layout-11"></i>
                        <p>Data Infrastruktur Jaringan <b class="caret"></b></p>
                </a>

                <div class="collapse @if(in_array($activePage,[
                    'titik_lokasi','wilayah','kec_kel','klasifikasi','koneksi','status',
                    'backbone','uplink','perangkat'
                ])) show @endif" id="infra">

                    <ul class="nav ml-3">

                        <li class="nav-item">
                            <a class="nav-link" data-toggle="collapse" href="#masterDataJaringan">
                                <p class="d-flex justify-content-between align-items-center m-0">
                                    Data Jaringan
                                    <i class="fa fa-angle-right"></i>
                                </p>
                            </a>

                            <div class="collapse @if(in_array($activePage,[
                                'wilayah','kec_kel','klasifikasi','koneksi','status',
                                'backbone','uplink','perangkat'
                            ])) show @endif" id="masterDataJaringan" data-parent="#infra">

                                <ul class="nav ml-3">

                                    <li class="nav-item @if($activePage=='wilayah') active @endif">
                                        <a class="nav-link" href="{{ route('wilayah.index') }}">
                                            Tambah Data Wilayah
                                        </a>
                                    </li>

                                    <li class="nav-item @if($activePage=='kec_kel') active @endif">
                                        <a class="nav-link" href="{{ route('kec_kel.index') }}">
                                            Tambah Data Kec/Kel
                                        </a>
                                    </li>

                                    <li class="nav-item @if($activePage=='klasifikasi') active @endif">
                                        <a class="nav-link" href="{{ route('klasifikasi.index') }}">
                                            Tambah Data Klasifikasi
                                        </a>
                                    </li>

                                    <li class="nav-item @if($activePage=='backbone') active @endif">
                                        <a class="nav-link" href="{{ route('backbone.index') }}">
                                            Tambah Data Backbone
                                        </a>
                                    </li>

                                    <li class="nav-item @if($activePage=='uplink') active @endif">
                                        <a class="nav-link" href="{{ route('uplink.index') }}">
                                            Tambah Data Uplink
                                        </a>
                                    </li>

                                </ul>
                            </div>
                        </li>

                        <li class="nav-item @if($activePage=='titik_lokasi') active @endif">
                            <a class="nav-link" href="{{ route('titik_lokasi.index') }}">
                                Input Data Jaringan
                            </a>
                        </li>

                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a data-toggle="collapse" href="#gangguan"
                class="nav-link @if(in_array($activePage,[
                    'gangguan','perangkatdaerah','jenis_masalah','bulan'
                ])) active @endif">
                    <i class="nc-icon nc-alert-circle-i"></i>
                    <p>Laporan Gangguan Jaringan <b class="caret"></b></p>
                </a>

                <div class="collapse @if(in_array($activePage,[
                    'gangguan','perangkatdaerah','jenis_masalah','bulan'
                ])) show @endif" id="gangguan">

                    <ul class="nav ml-3">

                        <li class="nav-item">
                            <a class="nav-link" data-toggle="collapse" href="#masterGangguan">
                                <p class="d-flex justify-content-between align-items-center m-0">
                                    Data Gangguan
                                    <i class="fa fa-angle-right"></i>
                                </p>
                            </a>

                            <div class="collapse @if(in_array($activePage,[
                                'perangkatdaerah','jenis_masalah','bulan'
                            ])) show @endif" id="masterGangguan" data-parent="#gangguan">

                                <ul class="nav ml-3">

                                    <li class="nav-item @if($activePage=='perangkatdaerah') active @endif">
                                        <a class="nav-link" href="{{ route('perangkatdaerah.index') }}">
                                            Tambah Data Perangkat Daerah
                                        </a>
                                    </li>

                                    <li class="nav-item @if($activePage=='jenis_masalah') active @endif">
                                        <a class="nav-link" href="{{ route('jenis_masalah.index') }}">
                                            Tambah Data Jenis Masalah
                                        </a>
                                    </li>

                                    <li class="nav-item @if($activePage=='bulan') active @endif">
                                        <a class="nav-link" href="{{ route('bulan.index') }}">
                                            Tambah Data Bulan
                                        </a>
                                    </li>

                                </ul>
                            </div>
                        </li>

                        <li class="nav-item @if($activePage=='gangguan') active @endif">
                            <a class="nav-link" href="{{ route('gangguan.index') }}">
                                Input Data Gangguan
                            </a>
                        </li>

                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a data-toggle="collapse" href="#stok"
                class="nav-link @if(in_array($activePage,[
                    'barang','stok_barang','lokasi','barang_keluar'
                ])) active @endif">
                    <i class="nc-icon nc-box"></i>
                    <p>Stok Barang <b class="caret"></b></p>
                </a>

                <div class="collapse @if(in_array($activePage,[
                    'barang','stok_barang','lokasi','barang_keluar'
                ])) show @endif" id="stok">

                    <ul class="nav ml-3">

                        <li class="nav-item">
                            <a class="nav-link" data-toggle="collapse" href="#masterStokBarang">
                                <p class="d-flex justify-content-between align-items-center m-0">
                                    Data Stok Barang
                                    <i class="fa fa-angle-right"></i>
                                </p>
                            </a>

                            <div class="collapse @if(in_array($activePage,[
                                'barang','lokasi'
                            ])) show @endif" id="masterStokBarang" data-parent="#stok">

                                <ul class="nav ml-3">

                                    <li class="nav-item @if($activePage=='barang') active @endif">
                                        <a class="nav-link" href="{{ route('barang.index') }}">
                                            Tambah Data Barang
                                        </a>
                                    </li>

                                    <li class="nav-item @if($activePage=='lokasi') active @endif">
                                        <a class="nav-link" href="{{ route('lokasi.index') }}">
                                            Tambah Data Lokasi
                                        </a>
                                    </li>

                                </ul>
                            </div>
                        </li>

                        <li class="nav-item @if($activePage=='stok_barang') active @endif">
                            <a class="nav-link" href="{{ route('stok_barang.index') }}">
                                Input Stok Barang
                            </a>
                        </li>

                        <li class="nav-item @if($activePage=='barang_keluar') active @endif">
                            <a class="nav-link" href="{{ route('transaksi_barang.index') }}">
                                Input Barang Keluar
                            </a>
                        </li>

                    </ul>
                </div>
            </li>

        </ul>
    </div>
</div>
