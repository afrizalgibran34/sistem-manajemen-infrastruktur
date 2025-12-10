<div class="sidebar" data-image="{{ asset('assets/light-bootstrap/img/sidebar-5.jpg') }}">
    <div class="sidebar-wrapper">

        <div class="logo">
            <a href="{{ route('dashboard') }}" class="simple-text">
                Sistem Manajemen Aset Infrastruktur
            </a>
        </div>

        <ul class="nav">

            {{-- DASHBOARD --}}
            <li class="nav-item @if($activePage=='dashboard') active @endif">
                <a class="nav-link" href="{{ route('dashboard') }}">
                    <i class="nc-icon nc-bank"></i>
                    <p>Dashboard</p>
                </a>
            </li>

            {{-- PETA --}}
            <li class="nav-item @if($activePage=='peta') active @endif">
                <a class="nav-link" href="{{ route('peta') }}">
                    <i class="nc-icon nc-pin-3"></i>
                    <p>Peta Jaringan</p>
                </a>
            </li>

            {{-- DATA INFRASTRUKTUR --}}
            <li class="nav-item">
                <a data-toggle="collapse" href="#infra"
                   class="nav-link @if(in_array($activePage,[
                        'titik_lokasi_index','titik_lokasi_create',
                        'wilayah','kec_kel','klasifikasi','backbone','uplink'
                   ])) active @endif">

                    <i class="nc-icon nc-layout-11"></i>
                    <p>Data Infrastruktur Jaringan <b class="caret"></b></p>
                </a>

                <div class="collapse @if(in_array($activePage,[
                    'titik_lokasi_index','titik_lokasi_create',
                    'wilayah','kec_kel','klasifikasi','backbone','uplink'
                ])) show @endif" id="infra">

                    <ul class="nav ml-3">

                        <li class="nav-item @if($activePage=='titik_lokasi_index') active @endif">
                            <a class="nav-link" href="{{ route('titik_lokasi.index') }}">
                                Data Jaringan
                            </a>
                        </li>

                        <li class="nav-item @if($activePage=='titik_lokasi_create') active @endif">
                            <a class="nav-link" href="{{ route('titik_lokasi.create') }}">
                                Input Data Jaringan
                            </a>
                        </li>

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

            {{-- LAPORAN GANGGUAN --}}
            <li class="nav-item">
                <a data-toggle="collapse" href="#gangguan"
                   class="nav-link @if(in_array($activePage,[
                        'gangguan_index','gangguan_create','jenis_masalah'
                   ])) active @endif">

                    <i class="nc-icon nc-alert-circle-i"></i>
                    <p>Laporan Gangguan Jaringan <b class="caret"></b></p>
                </a>

                <div class="collapse @if(in_array($activePage,[
                    'gangguan_index','gangguan_create','jenis_masalah'
                ])) show @endif" id="gangguan">

                    <ul class="nav ml-3">

                        <li class="nav-item @if($activePage=='gangguan_index') active @endif">
                            <a class="nav-link" href="{{ route('gangguan.index') }}">
                                Data Gangguan
                            </a>
                        </li>

                        <li class="nav-item @if($activePage=='gangguan_create') active @endif">
                            <a class="nav-link" href="{{ route('gangguan.create') }}">
                                Input Data Gangguan
                            </a>
                        </li>

                        <li class="nav-item @if($activePage=='jenis_masalah') active @endif">
                            <a class="nav-link" href="{{ route('jenis_masalah.index') }}">
                                Tambah Data Jenis Masalah
                            </a>
                        </li>

                    </ul>
                </div>
            </li>

            {{-- STOK BARANG --}}
            <li class="nav-item">
                <a data-toggle="collapse" href="#stok"
                   class="nav-link @if(in_array($activePage,[
                        'stok_barang_index','stok_barang_create',
                        'barang_keluar','barang'
                   ])) active @endif">

                    <i class="nc-icon nc-box"></i>
                    <p>Stok Barang <b class="caret"></b></p>
                </a>

                <div class="collapse @if(in_array($activePage,[
                    'stok_barang_index','stok_barang_create',
                    'barang_keluar','barang'
                ])) show @endif" id="stok">

                    <ul class="nav ml-3">

                        <li class="nav-item @if($activePage=='stok_barang_index') active @endif">
                            <a class="nav-link" href="{{ route('stok_barang.index') }}">
                                Data Stok Barang
                            </a>
                        </li>

                        <li class="nav-item @if($activePage=='stok_barang_create') active @endif">
                            <a class="nav-link" href="{{ route('stok_barang.create') }}">
                                Input Stok Barang
                            </a>
                        </li>

                        <li class="nav-item @if($activePage=='barang_keluar') active @endif">
                            <a class="nav-link" href="{{ route('transaksi_barang.index') }}">
                                Input Barang Keluar
                            </a>
                        </li>

                        <li class="nav-item @if($activePage=='barang') active @endif">
                            <a class="nav-link" href="{{ route('barang.index') }}">
                                Tambah Data Barang
                            </a>
                        </li>

                    </ul>
                </div>
            </li>

        </ul>
    </div>
</div>
