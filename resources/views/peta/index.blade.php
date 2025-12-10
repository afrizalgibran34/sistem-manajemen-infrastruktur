<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Peta') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Search and Filter Form --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <form method="GET" action="{{ route('peta') }}" class="flex gap-6">
                        {{-- Search Location Point --}}
                        <div>
                            <label for="search" class="block text-sm font-semibold text-gray-900 dark:text-gray-100 mb-3">
                                Cari Lokasi:
                            </label>
                            <div class="flex gap-2">
                                <input 
                                    type="text" 
                                    name="search" 
                                    id="search"
                                    value="{{ request('search') }}"
                                    placeholder="Cari berdasarkan nama lokasi"
                                    class="flex-1 px-4 py-2.5 rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 focus:border-blue-600 focus:ring-2 focus:ring-blue-600 focus:ring-opacity-50 transition-colors"
                                />
                                <button 
                                    type="submit"
                                    class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-200"
                                >
                                    Cari
                                </button>
                            </div>
                        </div>

                        {{-- Kecamatan/Kelurahan Dropdown --}}
                        <div>
                            <label for="id_kec_kel" class="block text-sm font-semibold text-gray-900 dark:text-gray-100 mb-3">
                                Filter:
                            </label>
                            <div class="flex gap-2">
                                <select 
                                    name="id_kec_kel" 
                                    id="id_kec_kel"
                                    class="flex-1 px-4 py-2.5 rounded-lg border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100 focus:border-blue-600 focus:ring-2 focus:ring-blue-600 focus:ring-opacity-50 transition-colors"
                                >
                                    <option value="">Filter berdasarkan kecamatan/kelurahan</option>
                                    @foreach($kecKel as $kk)
                                        <option value="{{ $kk->id_kec_kel }}" 
                                            {{ request('id_kec_kel') == $kk->id_kec_kel ? 'selected' : '' }}>
                                            {{ $kk->nama_kec_kel }}
                                        </option>
                                    @endforeach
                                </select>
                                <button 
                                    type="submit"
                                    class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-200"
                                >
                                    Cari
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Map Container --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div id="map"></div>
                </div>
            </div>
        </div>
    </div>

    {{-- Leaflet CSS --}}
    @push('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" 
          integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" 
          crossorigin="" />
    
    {{-- Select2 CSS for searchable dropdown --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    
    <style>
        /* Map container styles */
        #map {
            width: 100%;
            height: 600px;
            min-height: 600px;
            background: #f0f0f0;
            position: relative;
            z-index: 1;
        }
        
        /* Leaflet container */
        .leaflet-container {
            width: 100% !important;
            height: 100% !important;
            z-index: 1;
            position: relative;
        }
        
        /* Ensure tiles and markers render correctly */
        .leaflet-pane,
        .leaflet-tile,
        .leaflet-marker-icon,
        .leaflet-marker-shadow,
        .leaflet-tile-container,
        .leaflet-pane > svg,
        .leaflet-pane > canvas,
        .leaflet-zoom-box,
        .leaflet-image-layer,
        .leaflet-layer {
            position: absolute;
            left: 0;
            top: 0;
        }
        
        /* Z-index hierarchy for map layers */
        .leaflet-tile-pane { z-index: 2; }
        .leaflet-overlay-pane { z-index: 4; }
        .leaflet-shadow-pane { z-index: 5; }
        .leaflet-marker-pane { z-index: 6; }
        .leaflet-tooltip-pane { z-index: 7; }
        .leaflet-popup-pane { z-index: 8; }
        
        /* Ensure tiles are visible */
        .leaflet-tile {
            visibility: visible !important;
            opacity: 1 !important;
        }

        /* Select2 styling */
        .select2-container--default .select2-selection--single {
            height: 42px;
            border-radius: 0.5rem;
            border: 1px solid #d1d5db;
            padding: 0.5rem 1rem;
        }
        
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 26px;
            padding-left: 0;
        }
        
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 40px;
        }
        
        /* Select2 dark mode styling */
        .dark .select2-container--default .select2-selection--single {
            background-color: #374151;
            border-color: #4b5563;
            color: #f3f4f6;
        }
        
        .dark .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: #f3f4f6;
        }
        
        .dark .select2-dropdown {
            background-color: #374151;
            border-color: #4b5563;
        }
        
        .dark .select2-container--default .select2-results__option {
            background-color: #374151;
            color: #f3f4f6;
        }
        
        .dark .select2-container--default .select2-results__option--highlighted[aria-selected] {
            background-color: #2563eb;
            color: white;
        }
        
        .dark .select2-container--default .select2-search--dropdown .select2-search__field {
            background-color: #4b5563;
            border-color: #6b7280;
            color: #f3f4f6;
        }
    </style>
    @endpush

    {{-- Leaflet JS and Map Initialization --}}
    @push('scripts')
    {{-- jQuery (required for Select2) --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    
    {{-- Select2 JS for searchable dropdown --}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" 
            integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" 
            crossorigin=""></script>
    
    {{-- Pass data to JavaScript --}}
    <script>
        window.titikData = @json($titik ?? []);
    </script>
    
    {{-- Initialize Select2 for searchable dropdown --}}
    <script>
        $(document).ready(function() {
            $('#id_kec_kel').select2({
                placeholder: 'Filter berdasarkan kecamatan/kelurahan',
                allowClear: true,
                width: '100%',
                language: {
                    noResults: function() {
                        return "Tidak ada hasil";
                    },
                    searching: function() {
                        return "Mencari...";
                    }
                }
            });
        });
    </script>
    
    {{-- Map initialization script --}}
    <script src="{{ asset('assets/js/map.js') }}"></script>
    @endpush
</x-app-layout>
