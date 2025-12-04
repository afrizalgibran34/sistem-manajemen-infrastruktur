<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    <x-nav-link :href="route('peta')" :active="request()->routeIs('peta')">
                        {{ __('Peta') }}
                    </x-nav-link>
                    {{-- Dropdown Data Jaringan --}}
<div class="hidden sm:flex sm:items-center sm:ms-10">

    <div x-data="{ open: false }" class="relative">

        <!-- Tombol Dropdown -->
        <button @click="open = !open"
            class="flex items-center text-gray-600 dark:text-gray-300 hover:text-gray-800 dark:hover:text-white">
            <span>Data Jaringan</span>
            <svg class="ms-1 h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                      d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 011.08 1.04l-4.25 4.25a.75.75 0 01-1.08 0L5.21 8.27a.75.75 0 01.02-1.06z"
                      clip-rule="evenodd" />
            </svg>
        </button>

        <!-- Isi Dropdown -->
        <div x-show="open"
            @click.away="open = false"
            class="absolute mt-2 w-48 bg-white dark:bg-gray-800 rounded shadow-lg py-1 z-50">

            <x-nav-link :href="route('wilayah.index')" :active="request()->routeIs('wilayah.index')" class="block px-4 py-2">
                Wilayah
            </x-nav-link>

            <x-nav-link :href="route('kec_kel.index')" :active="request()->routeIs('kec_kel.index')" class="block px-4 py-2">
                Kec/Kel
            </x-nav-link>

            <x-nav-link :href="route('klasifikasi.index')" :active="request()->routeIs('klasifikasi.index')" class="block px-4 py-2">
                Klasifikasi
            </x-nav-link>

            <x-nav-link :href="route('koneksi.index')" :active="request()->routeIs('koneksi.index')" class="block px-4 py-2">
                Koneksi
            </x-nav-link>

            <x-nav-link :href="route('status.index')" :active="request()->routeIs('status.index')" class="block px-4 py-2">
                Status
            </x-nav-link>

            <x-nav-link :href="route('backbone.index')" :active="request()->routeIs('backbone.index')" class="block px-4 py-2">
                Backbone
            </x-nav-link>

            <x-nav-link :href="route('uplink.index')" :active="request()->routeIs('uplink.index')" class="block px-4 py-2">
                Uplink
            </x-nav-link>

            <x-nav-link :href="route('perangkat.index')" :active="request()->routeIs('perangkat.index')" class="block px-4 py-2">
                Perangkat
            </x-nav-link>

            <x-nav-link :href="route('titik_lokasi.index')" :active="request()->routeIs('titik_lokasi.index')" class="block px-4 py-2">
                Titik Lokasi
            </x-nav-link>

        </div>

    </div>

</div>

                   {{-- Dropdown Data Laporan Jaringan --}}
<div class="hidden sm:flex sm:items-center sm:ms-10">

    <div x-data="{ open: false }" class="relative">

        <!-- Tombol Dropdown -->
        <button @click="open = !open"
            class="flex items-center text-gray-600 dark:text-gray-300 hover:text-gray-800 dark:hover:text-white">
            <span>Data Laporan Jaringan</span>
            <svg class="ms-1 h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                      d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 011.08 1.04l-4.25 4.25a.75.75 0 01-1.08 0L5.21 8.27a.75.75 0 01.02-1.06z"
                      clip-rule="evenodd" />
            </svg>
        </button>

        <!-- Isi Dropdown -->
        <div x-show="open"
             @click.away="open = false"
             class="absolute mt-2 w-56 bg-white dark:bg-gray-800 rounded shadow-lg py-1 z-50">

            <x-nav-link :href="route('perangkatdaerah.index')" 
                        :active="request()->routeIs('perangkatdaerah.index')" 
                        class="block px-4 py-2">
                Perangkat Daerah
            </x-nav-link>

            <x-nav-link :href="route('jenis_masalah.index')" 
                        :active="request()->routeIs('jenis_masalah.index')" 
                        class="block px-4 py-2">
                Jenis Masalah
            </x-nav-link>

            <x-nav-link :href="route('bulan.index')" 
                        :active="request()->routeIs('bulan.index')" 
                        class="block px-4 py-2">
                Bulan
            </x-nav-link>

            <x-nav-link :href="route('gangguan.index')" 
                        :active="request()->routeIs('gangguan.index')" 
                        class="block px-4 py-2">
                Gangguan
            </x-nav-link>

        </div>

    </div>

</div>

                    {{-- Dropdown Data Stok Opname --}}
<div class="hidden sm:flex sm:items-center sm:ms-10">

    <div x-data="{ open: false }" class="relative">

        <!-- Tombol Dropdown -->
        <button @click="open = !open"
            class="flex items-center text-gray-600 dark:text-gray-300 hover:text-gray-800 dark:hover:text-white">
            <span>Data Stok Opname</span>
            <svg class="ms-1 h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                      d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 011.08 1.04l-4.25 4.25a.75.75 0 01-1.08 0L5.21 8.27a.75.75 0 01.02-1.06z"
                      clip-rule="evenodd" />
            </svg>
        </button>

        <!-- Isi Dropdown -->
        <div x-show="open"
            @click.away="open = false"
            class="absolute mt-2 w-56 bg-white dark:bg-gray-800 rounded shadow-lg py-1 z-50">

            <x-nav-link :href="route('barang.index')"
                        :active="request()->routeIs('barang.index')"
                        class="block px-4 py-2">
                Barang
            </x-nav-link>

            <x-nav-link :href="route('stok_barang.index')"
                        :active="request()->routeIs('stok_barang.index')"
                        class="block px-4 py-2">
                Stok Barang
            </x-nav-link>

            <x-nav-link :href="route('lokasi.index')"
                        :active="request()->routeIs('lokasi.index')"
                        class="block px-4 py-2">
                Lokasi
            </x-nav-link>

            <x-nav-link :href="route('transaksi_barang.index')"
                        :active="request()->routeIs('transaksi_barang.index')"
                        class="block px-4 py-2">
                Transaksi Barang
            </x-nav-link>

        </div>

    </div>

</div>


                </div>
                 
            </div>
            
            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
