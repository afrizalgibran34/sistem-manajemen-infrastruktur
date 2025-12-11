<div class="fixed top-0 left-0 h-screen w-60 sidebar-gradient text-white overflow-y-auto z-[1000] sidebar">
    <div class="px-4 py-6 text-center border-b border-white/10">
        <h3 class="text-lg font-semibold m-0 leading-snug">Sistem Informasi Manajemen Aset Infrastruktur</h3>
    </div>

    <div class="py-4">
        {{-- Dashboard --}}
        <div class="my-1">
            <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-3 text-white/90 no-underline transition-all duration-200 text-sm hover:bg-white/10 hover:text-white @if($activePage == 'dashboard') bg-white/20 text-white font-medium @endif">
                <i class="fas fa-th-large w-6 mr-3 text-base"></i>
                <span>DASHBOARD</span>
            </a>
        </div>

        {{-- Data Analisis --}}
        <div class="my-1">
            <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-3 text-white/90 no-underline transition-all duration-200 text-sm hover:bg-white/10 hover:text-white @if($activePage == 'data-analisis') bg-white/20 text-white font-medium @endif">
                <i class="fas fa-chart-pie w-6 mr-3 text-base"></i>
                <span>DATA ANALISIS</span>
            </a>
        </div>

        {{-- Peta --}}
        <div class="my-1">
            <a href="{{ route('peta') }}" class="flex items-center px-4 py-3 text-white/90 no-underline transition-all duration-200 text-sm hover:bg-white/10 hover:text-white @if($activePage == 'peta') bg-white/20 text-white font-medium @endif">
                <i class="fas fa-map-marker-alt w-6 mr-3 text-base"></i>
                <span>PETA</span>
            </a>
        </div>

        {{-- Data Jaringan --}}
        <div class="my-1">
            <a href="javascript:void(0)" 
               class="menu-link has-submenu flex items-center px-4 py-3 text-white/90 no-underline transition-all duration-200 text-sm hover:bg-white/10 hover:text-white @if(in_array($activePage,['wilayah','kec_kel','klasifikasi','koneksi','status','backbone','uplink','perangkat','titik_lokasi'])) active bg-white/20 text-white font-medium @endif"
               onclick="toggleSubmenu(this)">
                <i class="fas fa-list w-6 mr-3 text-base"></i>
                <span class="flex-1">DATA JARINGAN</span>
            </a>
            <div class="submenu bg-black/10 @if(in_array($activePage,['wilayah','kec_kel','klasifikasi','koneksi','status','backbone','uplink','perangkat','titik_lokasi'])) show @endif">
                <a href="{{ route('wilayah.index') }}" class="block py-2.5 pl-[3.25rem] pr-4 text-white/85 no-underline text-[0.85rem] transition-all duration-200 hover:bg-white/10 hover:text-white @if($activePage=='wilayah') bg-white/15 text-white font-medium @endif">
                    WILAYAH
                </a>
                <a href="{{ route('kec_kel.index') }}" class="block py-2.5 pl-[3.25rem] pr-4 text-white/85 no-underline text-[0.85rem] transition-all duration-200 hover:bg-white/10 hover:text-white @if($activePage=='kec_kel') bg-white/15 text-white font-medium @endif">
                    KEC/KEL
                </a>
                <a href="{{ route('klasifikasi.index') }}" class="block py-2.5 pl-[3.25rem] pr-4 text-white/85 no-underline text-[0.85rem] transition-all duration-200 hover:bg-white/10 hover:text-white @if($activePage=='klasifikasi') bg-white/15 text-white font-medium @endif">
                    KLASIFIKASI
                </a>
                <a href="{{ route('koneksi.index') }}" class="block py-2.5 pl-[3.25rem] pr-4 text-white/85 no-underline text-[0.85rem] transition-all duration-200 hover:bg-white/10 hover:text-white @if($activePage=='koneksi') bg-white/15 text-white font-medium @endif">
                    KONEKSI
                </a>
                <a href="{{ route('status.index') }}" class="block py-2.5 pl-[3.25rem] pr-4 text-white/85 no-underline text-[0.85rem] transition-all duration-200 hover:bg-white/10 hover:text-white @if($activePage=='status') bg-white/15 text-white font-medium @endif">
                    STATUS
                </a>
                <a href="{{ route('backbone.index') }}" class="block py-2.5 pl-[3.25rem] pr-4 text-white/85 no-underline text-[0.85rem] transition-all duration-200 hover:bg-white/10 hover:text-white @if($activePage=='backbone') bg-white/15 text-white font-medium @endif">
                    BACKBONE
                </a>
                <a href="{{ route('uplink.index') }}" class="block py-2.5 pl-[3.25rem] pr-4 text-white/85 no-underline text-[0.85rem] transition-all duration-200 hover:bg-white/10 hover:text-white @if($activePage=='uplink') bg-white/15 text-white font-medium @endif">
                    UPLINK
                </a>
                <a href="{{ route('perangkat.index') }}" class="block py-2.5 pl-[3.25rem] pr-4 text-white/85 no-underline text-[0.85rem] transition-all duration-200 hover:bg-white/10 hover:text-white @if($activePage=='perangkat') bg-white/15 text-white font-medium @endif">
                    PERANGKAT
                </a>
                <a href="{{ route('titik_lokasi.index') }}" class="block py-2.5 pl-[3.25rem] pr-4 text-white/85 no-underline text-[0.85rem] transition-all duration-200 hover:bg-white/10 hover:text-white @if($activePage=='titik_lokasi') bg-white/15 text-white font-medium @endif">
                    TITIK LOKASI
                </a>
            </div>
        </div>

        {{-- Laporan Jaringan --}}
        <div class="my-1">
            <a href="javascript:void(0)" 
               class="menu-link has-submenu flex items-center px-4 py-3 text-white/90 no-underline transition-all duration-200 text-sm hover:bg-white/10 hover:text-white @if(in_array($activePage,['perangkatdaerah','jenis_masalah','bulan','gangguan'])) active bg-white/20 text-white font-medium @endif"
               onclick="toggleSubmenu(this)">
                <i class="fas fa-list w-6 mr-3 text-base"></i>
                <span class="flex-1">LAPORAN JARINGAN</span>
            </a>
            <div class="submenu bg-black/10 @if(in_array($activePage,['perangkatdaerah','jenis_masalah','bulan','gangguan'])) show @endif">
                <a href="{{ route('perangkatdaerah.index') }}" class="block py-2.5 pl-[3.25rem] pr-4 text-white/85 no-underline text-[0.85rem] transition-all duration-200 hover:bg-white/10 hover:text-white @if($activePage=='perangkatdaerah') bg-white/15 text-white font-medium @endif">
                    PERANGKAT DAERAH
                </a>
                <a href="{{ route('jenis_masalah.index') }}" class="block py-2.5 pl-[3.25rem] pr-4 text-white/85 no-underline text-[0.85rem] transition-all duration-200 hover:bg-white/10 hover:text-white @if($activePage=='jenis_masalah') bg-white/15 text-white font-medium @endif">
                    JENIS MASALAH
                </a>
                <a href="{{ route('bulan.index') }}" class="block py-2.5 pl-[3.25rem] pr-4 text-white/85 no-underline text-[0.85rem] transition-all duration-200 hover:bg-white/10 hover:text-white @if($activePage=='bulan') bg-white/15 text-white font-medium @endif">
                    BULAN
                </a>
                <a href="{{ route('gangguan.index') }}" class="block py-2.5 pl-[3.25rem] pr-4 text-white/85 no-underline text-[0.85rem] transition-all duration-200 hover:bg-white/10 hover:text-white @if($activePage=='gangguan') bg-white/15 text-white font-medium @endif">
                    GANGGUAN
                </a>
            </div>
        </div>

        {{-- Stok Opname --}}
        <div class="my-1">
            <a href="javascript:void(0)" 
               class="menu-link has-submenu flex items-center px-4 py-3 text-white/90 no-underline transition-all duration-200 text-sm hover:bg-white/10 hover:text-white @if(in_array($activePage,['barang','stok_barang','lokasi','transaksi_barang'])) active bg-white/20 text-white font-medium @endif"
               onclick="toggleSubmenu(this)">
                <i class="fas fa-list w-6 mr-3 text-base"></i>
                <span class="flex-1">STOK OPNAME</span>
            </a>
            <div class="submenu bg-black/10 @if(in_array($activePage,['barang','stok_barang','lokasi','transaksi_barang'])) show @endif">
                <a href="{{ route('barang.index') }}" class="block py-2.5 pl-[3.25rem] pr-4 text-white/85 no-underline text-[0.85rem] transition-all duration-200 hover:bg-white/10 hover:text-white @if($activePage=='barang') bg-white/15 text-white font-medium @endif">
                    BARANG
                </a>
                <a href="{{ route('stok_barang.index') }}" class="block py-2.5 pl-[3.25rem] pr-4 text-white/85 no-underline text-[0.85rem] transition-all duration-200 hover:bg-white/10 hover:text-white @if($activePage=='stok_barang') bg-white/15 text-white font-medium @endif">
                    STOK BARANG
                </a>
                <a href="{{ route('lokasi.index') }}" class="block py-2.5 pl-[3.25rem] pr-4 text-white/85 no-underline text-[0.85rem] transition-all duration-200 hover:bg-white/10 hover:text-white @if($activePage=='lokasi') bg-white/15 text-white font-medium @endif">
                    LOKASI
                </a>
                <a href="{{ route('transaksi_barang.index') }}" class="block py-2.5 pl-[3.25rem] pr-4 text-white/85 no-underline text-[0.85rem] transition-all duration-200 hover:bg-white/10 hover:text-white @if($activePage=='transaksi_barang') bg-white/15 text-white font-medium @endif">
                    TRANSAKSI BARANG
                </a>
            </div>
        </div>
    </div>
</div>
