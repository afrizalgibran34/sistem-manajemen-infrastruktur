<div class="sidebar" data-image="{{ asset('assets/light-bootstrap/img/sidebar-5.jpg') }}">
    <div class="sidebar-wrapper">
        <div class="logo">
            <a href="{{ route('dashboard') }}" class="simple-text">
                {{ config('app.name', 'Laravel') }}
            </a>
        </div>

        <ul class="nav">

            {{-- Data Analisis --}}
            <li class="nav-item @if($activePage == 'dashboard') active @endif">
                <a class="nav-link" href="{{ route('dashboard') }}">
                    <i class="nc-icon nc-chart-pie-35"></i>
                    <p>Data Analisis</p>
                </a>
            </li>
            {{-- Peta --}}
            <li class="nav-item @if($activePage == 'peta') active @endif">
                <a class="nav-link" href="{{ route('peta') }}">
                    <i class="nc-icon nc-pin-3"></i>
                    <p>Peta</p>
                </a>
            </li>

            {{-- DATA JARINGAN --}}
            <li class="nav-item">
                <a data-toggle="collapse" href="#dataJaringan"
                    class="nav-link @if(in_array($activePage,['wilayah','kec_kel','klasifikasi','koneksi','status','backbone','uplink','perangkat','titik_lokasi'])) active @endif">
                    <i class="nc-icon nc-bullet-list-67"></i>
                    <p>Data Jaringan <b class="caret"></b></p>
                </a>

                <div class="collapse @if(in_array($activePage,['wilayah','kec_kel','klasifikasi','koneksi','status','backbone','uplink','perangkat','titik_lokasi'])) show @endif"
                    id="dataJaringan">
                    <ul class="nav">

                        <li class="nav-item @if($activePage=='wilayah') active @endif">
                            <a class="nav-link" href="{{ route('wilayah.index') }}">
                                <span>Wilayah</span>
                            </a>
                        </li>

                        <li class="nav-item @if($activePage=='kec_kel') active @endif">
                            <a class="nav-link" href="{{ route('kec_kel.index') }}">
                                
                                <span>Kec/Kel</span>
                            </a>
                        </li>

                        <li class="nav-item @if($activePage=='klasifikasi') active @endif">
                            <a class="nav-link" href="{{ route('klasifikasi.index') }}">
                                <span>Klasifikasi</span>
                            </a>
                        </li>

                        <li class="nav-item @if($activePage=='koneksi') active @endif">
                            <a class="nav-link" href="{{ route('koneksi.index') }}">
                                <span>Koneksi</span>
                            </a>
                        </li>

                        <li class="nav-item @if($activePage=='status') active @endif">
                            <a class="nav-link" href="{{ route('status.index') }}">
                                <span>Status</span>
                            </a>
                        </li>

                        <li class="nav-item @if($activePage=='backbone') active @endif">
                            <a class="nav-link" href="{{ route('backbone.index') }}">
                                <span>Backbone</span>
                            </a>
                        </li>

                        <li class="nav-item @if($activePage=='uplink') active @endif">
                            <a class="nav-link" href="{{ route('uplink.index') }}">
                                <span>Uplink</span>
                            </a>
                        </li>

                        <li class="nav-item @if($activePage=='perangkat') active @endif">
                            <a class="nav-link" href="{{ route('perangkat.index') }}">
                                <span>Perangkat</span>
                            </a>
                        </li>

                        <li class="nav-item @if($activePage=='titik_lokasi') active @endif">
                            <a class="nav-link" href="{{ route('titik_lokasi.index') }}">
                                <span>Titik Lokasi</span>
                            </a>
                        </li>

                    </ul>
                </div>
            </li>

            {{-- DATA LAPORAN JARINGAN --}}
            <li class="nav-item">
                <a data-toggle="collapse" href="#laporanJaringan"
                    class="nav-link @if(in_array($activePage,['perangkatdaerah','jenis_masalah','bulan','gangguan'])) active @endif">
                    <i class="nc-icon nc-bullet-list-67"></i>
                    <p>Laporan Jaringan <b class="caret"></b></p>
                </a>

                <div class="collapse @if(in_array($activePage,['perangkatdaerah','jenis_masalah','bulan','gangguan'])) show @endif"
                    id="laporanJaringan">
                    <ul class="nav">

                        <li class="nav-item @if($activePage=='perangkatdaerah') active @endif">
                            <a class="nav-link" href="{{ route('perangkatdaerah.index') }}">
                                Perangkat Daerah
                            </a>
                        </li>

                        <li class="nav-item @if($activePage=='jenis_masalah') active @endif">
                            <a class="nav-link" href="{{ route('jenis_masalah.index') }}">
                                Jenis Masalah
                            </a>
                        </li>

                        <li class="nav-item @if($activePage=='bulan') active @endif">
                            <a class="nav-link" href="{{ route('bulan.index') }}">
                                Bulan
                            </a>
                        </li>

                        <li class="nav-item @if($activePage=='gangguan') active @endif">
                            <a class="nav-link" href="{{ route('gangguan.index') }}">
                                Gangguan
                            </a>
                        </li>

                    </ul>
                </div>
            </li>

            {{-- DATA STOK OPNAME --}}
            <li class="nav-item">
                <a data-toggle="collapse" href="#stokOpname"
                    class="nav-link @if(in_array($activePage,['barang','stok_barang','lokasi','transaksi_barang'])) active @endif">
                    <i class="nc-icon nc-bullet-list-67"></i>
                    <p>Stok Opname <b class="caret"></b></p>
                </a>

                <div class="collapse @if(in_array($activePage,['barang','stok_barang','lokasi','transaksi_barang'])) show @endif"
                    id="stokOpname">
                    <ul class="nav">

                        <li class="nav-item @if($activePage=='barang') active @endif">
                            <a class="nav-link" href="{{ route('barang.index') }}">
                                Barang
                            </a>
                        </li>

                        <li class="nav-item @if($activePage=='stok_barang') active @endif">
                            <a class="nav-link" href="{{ route('stok_barang.index') }}">
                                Stok Barang
                            </a>
                        </li>

                        <li class="nav-item @if($activePage=='lokasi') active @endif">
                            <a class="nav-link" href="{{ route('lokasi.index') }}">
                                Lokasi
                            </a>
                        </li>

                        <li class="nav-item @if($activePage=='transaksi_barang') active @endif">
                            <a class="nav-link" href="{{ route('transaksi_barang.index') }}">
                                Transaksi Barang
                            </a>
                        </li>

                    </ul>
                </div>
            </li>

        </ul>
    </div>
</div>
