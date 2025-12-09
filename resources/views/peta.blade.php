

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

    @push('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" 
          integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" 
          crossorigin="" />
    <style>
        /* Ensure map container has proper dimensions */
        #map {
            width: 100%;
            height: 600px;
            min-height: 600px;
            background: #f0f0f0;
            position: relative;
            z-index: 1;
        }
        
        /* Force Leaflet container to fill parent */
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
        
        /* Proper z-index hierarchy */
        .leaflet-tile-pane {
            z-index: 2;
        }
        
        .leaflet-overlay-pane {
            z-index: 4;
        }
        
        .leaflet-shadow-pane {
            z-index: 5;
        }
        
        .leaflet-marker-pane {
            z-index: 6;
        }
        
        .leaflet-tooltip-pane {
            z-index: 7;
        }
        
        .leaflet-popup-pane {
            z-index: 8;
        }
        
        /* Ensure tiles are visible */
        .leaflet-tile {
            visibility: visible !important;
            opacity: 1 !important;
        }
    </style>
    @endpush

    @push('scripts')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" 
            integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" 
            crossorigin=""></script>
    <script>
        // Ensure DOM is fully loaded
        document.addEventListener('DOMContentLoaded', function() {
            console.log('DOM loaded, initializing map...');
            
            // Wait for container to be fully rendered
            setTimeout(function() {
                try {
                    var titikData = @json($titik);
                    console.log('Titik data:', titikData);

                    // Verify container exists and has dimensions
                    var mapContainer = document.getElementById('map');
                    if (!mapContainer) {
                        console.error('Map container #map not found in DOM');
                        return;
                    }
                    
                    console.log('Map container found:', {
                        width: mapContainer.offsetWidth,
                        height: mapContainer.offsetHeight
                    });
                    
                    // Remove any existing map instance
                    if (window.mapInstance) {
                        window.mapInstance.remove();
                    }

                    // Initialize Leaflet map with proper configuration
                    var map = L.map('map', {
                        center: [-6.597146, 106.806039],
                        zoom: 13,
                        zoomControl: true,
                        scrollWheelZoom: true,
                        doubleClickZoom: true,
                        boxZoom: true,
                        keyboard: true,
                        dragging: true,
                        touchZoom: true,
                        preferCanvas: false,
                        renderer: L.canvas()
                    });
                    
                    // Store map instance globally
                    window.mapInstance = map;
                    
                    console.log('Map initialized');

                    // Add OpenStreetMap tile layer
                    var tileLayer = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
                        maxZoom: 19,
                        minZoom: 1,
                        tileSize: 256,
                        zoomOffset: 0,
                        crossOrigin: true
                    });
                    
                    tileLayer.addTo(map);
                    console.log('Tile layer added');
                    
                    // Event listener for tile loading
                    tileLayer.on('loading', function() {
                        console.log('Tiles loading...');
                    });
                    
                    tileLayer.on('load', function() {
                        console.log('Tiles loaded successfully');
                    });
                    
                    tileLayer.on('tileerror', function(error) {
                        console.error('Tile loading error:', error);
                    });

                    // Add markers if data exists
                    var markerCount = 0;
                    if (titikData && Array.isArray(titikData) && titikData.length > 0) {
                        var bounds = [];
                        
                        titikData.forEach(function(titik, index) {
                            if (titik.latitude && titik.longitude) {
                                try {
                                    var lat = parseFloat(titik.latitude);
                                    var lng = parseFloat(titik.longitude);
                                    
                                    if (isNaN(lat) || isNaN(lng)) {
                                        console.warn('Invalid coordinates for titik:', titik);
                                        return;
                                    }
                                    
                                    var marker = L.marker([lat, lng]);
                                    marker.addTo(map);
                                    marker.bindPopup('<b>' + (titik.nama_titik || 'Lokasi ' + (index + 1)) + '</b>');
                                    
                                    bounds.push([lat, lng]);
                                    markerCount++;
                                } catch (e) {
                                    console.error('Error adding marker:', e, titik);
                                }
                            }
                        });
                        
                        console.log('Added ' + markerCount + ' markers');
                        
                        // Fit map to markers if multiple points exist
                        if (bounds.length > 1) {
                            map.fitBounds(bounds, { padding: [50, 50] });
                        }
                    } else {
                        console.log('No titik data available');
                    }

                    // Force map to recalculate size after initialization
                    setTimeout(function() {
                        map.invalidateSize();
                        console.log('Map size invalidated');
                    }, 100);
                    
                    // Additional invalidation for safety
                    setTimeout(function() {
                        map.invalidateSize();
                        console.log('Map size invalidated (second pass)');
                    }, 500);

                    // Handle window resize for responsiveness
                    var resizeTimeout;
                    window.addEventListener('resize', function() {
                        clearTimeout(resizeTimeout);
                        resizeTimeout = setTimeout(function() {
                            if (map) {
                                map.invalidateSize();
                                console.log('Map resized');
                            }
                        }, 250);
                    });
                    
                    console.log('Map initialization complete');
                    
                } catch (error) {
                    console.error('Error initializing map:', error);
                }
            }, 400);
        });
    </script>
    @endpush
</x-app-layout>