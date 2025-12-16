<div class="fixed top-0 left-0 h-screen w-60 sidebar-gradient text-white overflow-y-auto z-[1000] sidebar">
    <div class="px-4 py-6 text-center border-b border-white/10">
        <h3 class="text-lg font-semibold m-0 leading-snug">Sistem Manajemen Aset Infrastruktur</h3>
    </div>

    <div class="py-4">
        {{-- Dashboard --}}
        <div class="my-1">
            <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-3 text-white/90 no-underline transition-all duration-200 text-sm hover:bg-white/10 hover:text-white @if($activePage == 'dashboard') bg-white/20 text-white font-medium @endif">
                <i class="fas fa-chart-line w-6 mr-3 text-base"></i>
                <span>Dashboard</span>
            </a>
        </div>

        {{-- Peta Jaringan --}}
        <div class="my-1">
            <a href="{{ route('peta') }}" class="flex items-center px-4 py-3 text-white/90 no-underline transition-all duration-200 text-sm hover:bg-white/10 hover:text-white @if($activePage == 'peta') bg-white/20 text-white font-medium @endif">
                <i class="fas fa-map-marked-alt w-6 mr-3 text-base"></i>
                <span>Peta Jaringan</span>
            </a>
        </div>

        {{-- Data Infrastruktur Jaringan --}}
        <div class="my-1">
            <a href="javascript:void(0)" 
               class="menu-link has-submenu flex items-center px-4 py-3 text-white/90 no-underline transition-all duration-200 text-sm hover:bg-white/10 hover:text-white @if(in_array($activePage,['titik_lokasi_index','titik_lokasi_create','wilayah','kec_kel','klasifikasi','backbone','uplink'])) active bg-white/20 text-white font-medium @endif"
               onclick="toggleSubmenu(this)">
                <i class="fas fa-network-wired w-6 mr-3 text-base"></i>
                <span class="flex-1">Data Infrastruktur Jaringan</span>
            </a>
            <div class="submenu bg-black/10 @if(in_array($activePage,['titik_lokasi_index','titik_lokasi_create','wilayah','kec_kel','klasifikasi','backbone','uplink'])) show @endif">
                <a href="{{ route('titik_lokasi.index') }}" class="block py-2.5 pl-[3.25rem] pr-4 text-white/85 no-underline text-[0.85rem] transition-all duration-200 hover:bg-white/10 hover:text-white @if($activePage=='titik_lokasi_index') bg-white/15 text-white font-medium @endif">
                    Data Jaringan
                </a>
                <a href="{{ route('titik_lokasi.create') }}" class="block py-2.5 pl-[3.25rem] pr-4 text-white/85 no-underline text-[0.85rem] transition-all duration-200 hover:bg-white/10 hover:text-white @if($activePage=='titik_lokasi_create') bg-white/15 text-white font-medium @endif">
                    Input Data Jaringan
                </a>
                <a href="{{ route('wilayah.index') }}" class="block py-2.5 pl-[3.25rem] pr-4 text-white/85 no-underline text-[0.85rem] transition-all duration-200 hover:bg-white/10 hover:text-white @if($activePage=='wilayah') bg-white/15 text-white font-medium @endif">
                    Tambah Data Wilayah
                </a>
                <a href="{{ route('kec_kel.index') }}" class="block py-2.5 pl-[3.25rem] pr-4 text-white/85 no-underline text-[0.85rem] transition-all duration-200 hover:bg-white/10 hover:text-white @if($activePage=='kec_kel') bg-white/15 text-white font-medium @endif">
                    Tambah PD/Unit Kerja/Instansi</a>
                <a href="{{ route('klasifikasi.index') }}" class="block py-2.5 pl-[3.25rem] pr-4 text-white/85 no-underline text-[0.85rem] transition-all duration-200 hover:bg-white/10 hover:text-white @if($activePage=='klasifikasi') bg-white/15 text-white font-medium @endif">
                    Tambah Data Klasifikasi
                </a>
                <a href="{{ route('backbone.index') }}" class="block py-2.5 pl-[3.25rem] pr-4 text-white/85 no-underline text-[0.85rem] transition-all duration-200 hover:bg-white/10 hover:text-white @if($activePage=='backbone') bg-white/15 text-white font-medium @endif">
                    Tambah Data Backbone
                </a>
                <a href="{{ route('uplink.index') }}" class="block py-2.5 pl-[3.25rem] pr-4 text-white/85 no-underline text-[0.85rem] transition-all duration-200 hover:bg-white/10 hover:text-white @if($activePage=='uplink') bg-white/15 text-white font-medium @endif">
                    Tambah Data Uplink
                </a>
            </div>
        </div>

        {{-- Laporan Gangguan Jaringan --}}
        <div class="my-1">
            <a href="javascript:void(0)" 
               class="menu-link has-submenu flex items-center px-4 py-3 text-white/90 no-underline transition-all duration-200 text-sm hover:bg-white/10 hover:text-white @if(in_array($activePage,['gangguan_index','gangguan_create','jenis_masalah'])) active bg-white/20 text-white font-medium @endif"
               onclick="toggleSubmenu(this)">
                <i class="fas fa-exclamation-triangle w-6 mr-3 text-base"></i>
                <span class="flex-1">Laporan Gangguan Jaringan</span>
            </a>
            <div class="submenu bg-black/10 @if(in_array($activePage,['gangguan_index','gangguan_create','jenis_masalah'])) show @endif">
                <a href="{{ route('gangguan.index') }}" class="block py-2.5 pl-[3.25rem] pr-4 text-white/85 no-underline text-[0.85rem] transition-all duration-200 hover:bg-white/10 hover:text-white @if($activePage=='gangguan_index') bg-white/15 text-white font-medium @endif">
                    Data Gangguan
                </a>
                <a href="{{ route('gangguan.create') }}" class="block py-2.5 pl-[3.25rem] pr-4 text-white/85 no-underline text-[0.85rem] transition-all duration-200 hover:bg-white/10 hover:text-white @if($activePage=='gangguan_create') bg-white/15 text-white font-medium @endif">
                    Input Data Gangguan
                </a>
                <a href="{{ route('jenis_masalah.index') }}" class="block py-2.5 pl-[3.25rem] pr-4 text-white/85 no-underline text-[0.85rem] transition-all duration-200 hover:bg-white/10 hover:text-white @if($activePage=='jenis_masalah') bg-white/15 text-white font-medium @endif">
                    Tambah Data Jenis Masalah
                </a>
            </div>
        </div>

        {{-- Stok Barang --}}
        <div class="my-1">
            <a href="javascript:void(0)" 
               class="menu-link has-submenu flex items-center px-4 py-3 text-white/90 no-underline transition-all duration-200 text-sm hover:bg-white/10 hover:text-white @if(in_array($activePage,['stok_barang_index','stok_barang_create','barang_keluar','barang'])) active bg-white/20 text-white font-medium @endif"
               onclick="toggleSubmenu(this)">
                <i class="fas fa-boxes w-6 mr-3 text-base"></i>
                <span class="flex-1">Stok Barang</span>
            </a>
            <div class="submenu bg-black/10 @if(in_array($activePage,['stok_barang_index','stok_barang_create','barang_keluar','barang'])) show @endif">
                <a href="{{ route('stok_barang.index') }}" class="block py-2.5 pl-[3.25rem] pr-4 text-white/85 no-underline text-[0.85rem] transition-all duration-200 hover:bg-white/10 hover:text-white @if($activePage=='stok_barang_index') bg-white/15 text-white font-medium @endif">
                    Data Stok Barang
                </a>
                <a href="{{ route('stok_barang.create') }}" class="block py-2.5 pl-[3.25rem] pr-4 text-white/85 no-underline text-[0.85rem] transition-all duration-200 hover:bg-white/10 hover:text-white @if($activePage=='stok_barang_create') bg-white/15 text-white font-medium @endif">
                    Input Stok Barang
                </a>
                <a href="{{ route('transaksi_barang.index') }}" class="block py-2.5 pl-[3.25rem] pr-4 text-white/85 no-underline text-[0.85rem] transition-all duration-200 hover:bg-white/10 hover:text-white @if($activePage=='barang_keluar') bg-white/15 text-white font-medium @endif">
                    Input Barang Keluar
                </a>
                <a href="{{ route('barang.index') }}" class="block py-2.5 pl-[3.25rem] pr-4 text-white/85 no-underline text-[0.85rem] transition-all duration-200 hover:bg-white/10 hover:text-white @if($activePage=='barang') bg-white/15 text-white font-medium @endif">
                    Tambah Data Barang
                </a>
            </div>
        </div>
    </div>
</div>
