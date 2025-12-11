@extends('layouts.app', [
    'activePage' => 'peta',
    'title' => 'Peta'
])

@section('content')
<div class="p-4 md:p-6">
    <div class="max-w-full mx-auto">
        {{-- Page Header --}}
        <div class="mb-6">
            <h1 class="text-2xl font-semibold text-gray-800">Peta</h1>
        </div>

        {{-- Search and Filter Form --}}
        <div class="bg-white rounded-lg shadow-sm border-0 mb-6">
            <div class="p-4 sm:p-6">
                <form method="GET" action="{{ route('peta') }}">
                    <div class="flex flex-col lg:flex-row gap-4">
                        {{-- Search Location Point --}}
                        <div class="flex-1">
                            <label for="search" class="block text-sm font-semibold text-gray-700 mb-2">
                                Cari Lokasi:
                            </label>
                            <div class="flex flex-col sm:flex-row gap-2">
                                <input 
                                    type="text" 
                                    name="search" 
                                    id="search"
                                    value="{{ request('search') }}"
                                    placeholder="Cari berdasarkan nama lokasi"
                                    class="flex-1 w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                                />
                                <button 
                                    type="submit"
                                    class="w-full sm:w-auto px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-md transition whitespace-nowrap"
                                >
                                    Cari
                                </button>
                            </div>
                        </div>

                        {{-- Kecamatan/Kelurahan Dropdown --}}
                        <div class="flex-1">
                            <label for="id_kec_kel" class="block text-sm font-semibold text-gray-700 mb-2">
                                Filter:
                            </label>
                            <div class="flex flex-col sm:flex-row gap-2">
                                <select 
                                    name="id_kec_kel" 
                                    id="id_kec_kel"
                                    class="flex-1 w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
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
                                    class="w-full sm:w-auto px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-md transition whitespace-nowrap"
                                >
                                    Cari
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        {{-- Map Container --}}
        <div class="bg-white rounded-lg shadow-sm border-0">
            <div class="p-6">
                <div id="map"></div>
            </div>
        </div>
    </div>
</div>
@endsection

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

    /* Select2 styling to match Tailwind */
    .select2-container--default .select2-selection--single {
        height: 42px;
        border-radius: 0.375rem;
        border: 1px solid #d1d5db;
        padding: 0 1rem;
    }
    
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 40px;
        padding-left: 0;
        color: #374151;
    }
    
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 40px;
        right: 12px;
    }
    
    .select2-container--default.select2-container--focus .select2-selection--single {
        border-color: #3b82f6;
        box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.5);
    }
</style>
@endpush

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
