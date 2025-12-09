<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Peta') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
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
    </style>
    @endpush

    {{-- Leaflet JS and Map Initialization --}}
    @push('scripts')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" 
            integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" 
            crossorigin=""></script>
    
    {{-- Pass data to JavaScript --}}
    <script>
        window.titikData = @json($titik ?? []);
    </script>
    
    {{-- Map initialization script --}}
    <script src="{{ asset('assets/js/map.js') }}"></script>
    @endpush
</x-app-layout>
