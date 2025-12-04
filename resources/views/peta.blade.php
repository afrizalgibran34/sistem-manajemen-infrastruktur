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
                    <div id="map" style="height: 600px; width: 100%; z-index: 1;"></div>
                </div>
            </div>
        </div>
    </div>

    @push('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet. css" 
          integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" 
          crossorigin="" />
    <style>
        #map {
            background: #f0f0f0;
        }
        .leaflet-container {
            z-index: 1;
        }
    </style>
    @endpush

    @push('scripts')
    <script src="https://unpkg.com/leaflet@1. 9.4/dist/leaflet.js" 
            integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" 
            crossorigin=""></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Tunggu sedikit agar container siap
            setTimeout(function() {
                var titikData = @json($titik);

                // Inisialisasi map
                var map = L.map('map', {
                    center: [-6.597146, 106.806039],
                    zoom: 13,
                    zoomControl: true
                });

                // Tambahkan tile layer dengan opsi yang lebih lengkap
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
                    maxZoom: 19,
                    minZoom: 1,
                }). addTo(map);

                // Tambahkan markers
                titikData.forEach(function(titik) {
                    L.marker([titik.latitude, titik.longitude])
                        .addTo(map)
                        .bindPopup(titik.nama_titik);
                });

                // Fix map size
                map.invalidateSize();
            }, 250);
        });
    </script>
    @endpush
</x-app-layout>