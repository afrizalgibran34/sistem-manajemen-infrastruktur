/**
 * Leaflet Map Initialization
 * Manages interactive map display with markers
 */

class MapManager {
    constructor(containerId, options = {}) {
        this.containerId = containerId;
        this.defaultCenter = options.center || [-6.597146, 106.806039];
        this.defaultZoom = options.zoom || 13;
        this.map = null;
        this.markers = [];
    }

    /**
     * Initialize the map
     */
    init() {
        console.log('Initializing map...');
        
        const mapContainer = document.getElementById(this.containerId);
        if (!mapContainer) {
            console.error(`Map container #${this.containerId} not found in DOM`);
            return false;
        }

        console.log('Map container found:', {
            width: mapContainer.offsetWidth,
            height: mapContainer.offsetHeight
        });

        // Remove existing map instance if any
        if (window.mapInstance) {
            window.mapInstance.remove();
        }

        // Initialize Leaflet map
        this.map = L.map(this.containerId, {
            center: this.defaultCenter,
            zoom: this.defaultZoom,
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
        window.mapInstance = this.map;
        console.log('Map initialized');

        // Add tile layer
        this.addTileLayer();
        
        // Force map to recalculate size
        this.invalidateSize();
        
        // Handle window resize
        this.handleResize();

        return true;
    }

    /**
     * Add OpenStreetMap tile layer
     */
    addTileLayer() {
        const tileLayer = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
            maxZoom: 19,
            minZoom: 1,
            tileSize: 256,
            zoomOffset: 0,
            crossOrigin: true
        });

        tileLayer.addTo(this.map);
        console.log('Tile layer added');

        // Tile loading events
        tileLayer.on('loading', () => console.log('Tiles loading...'));
        tileLayer.on('load', () => console.log('Tiles loaded successfully'));
        tileLayer.on('tileerror', (error) => console.error('Tile loading error:', error));
    }

    /**
     * Add markers to the map
     * @param {Array} data - Array of location objects with latitude, longitude, and nama_titik
     */
    addMarkers(data) {
        if (!data || !Array.isArray(data) || data.length === 0) {
            console.log('No marker data available');
            return;
        }

        const bounds = [];
        let markerCount = 0;

        data.forEach((titik, index) => {
            if (titik.latitude && titik.longitude) {
                try {
                    const lat = parseFloat(titik.latitude);
                    const lng = parseFloat(titik.longitude);

                    if (isNaN(lat) || isNaN(lng)) {
                        console.warn('Invalid coordinates for titik:', titik);
                        return;
                    }

                    const marker = L.marker([lat, lng]);
                    marker.addTo(this.map);
                    marker.bindPopup(`<b>${titik.nama_titik || 'Lokasi ' + (index + 1)}</b>`);

                    this.markers.push(marker);
                    bounds.push([lat, lng]);
                    markerCount++;
                } catch (e) {
                    console.error('Error adding marker:', e, titik);
                }
            }
        });

        console.log(`Added ${markerCount} markers`);

        // Fit map to markers if multiple points exist
        if (bounds.length > 1) {
            this.map.fitBounds(bounds, { padding: [50, 50] });
        } else if (bounds.length === 1) {
            this.map.setView(bounds[0], this.defaultZoom);
        }
    }

    /**
     * Force map to recalculate its size
     */
    invalidateSize() {
        setTimeout(() => {
            this.map.invalidateSize();
            console.log('Map size invalidated');
        }, 100);

        setTimeout(() => {
            this.map.invalidateSize();
            console.log('Map size invalidated (second pass)');
        }, 500);
    }

    /**
     * Handle window resize events
     */
    handleResize() {
        let resizeTimeout;
        window.addEventListener('resize', () => {
            clearTimeout(resizeTimeout);
            resizeTimeout = setTimeout(() => {
                if (this.map) {
                    this.map.invalidateSize();
                    console.log('Map resized');
                }
            }, 250);
        });
    }

    /**
     * Clear all markers from the map
     */
    clearMarkers() {
        this.markers.forEach(marker => marker.remove());
        this.markers = [];
    }

    /**
     * Destroy the map instance
     */
    destroy() {
        if (this.map) {
            this.map.remove();
            this.map = null;
            window.mapInstance = null;
        }
    }
}

// Initialize map when DOM is ready
document.addEventListener('DOMContentLoaded', function() {
    // Wait for container to be fully rendered
    setTimeout(function() {
        try {
            // Get data from global variable (set by blade template)
            const titikData = window.titikData || [];

            // Create and initialize map
            const mapManager = new MapManager('map', {
                center: [-6.597146, 106.806039],
                zoom: 13
            });

            if (mapManager.init()) {
                mapManager.addMarkers(titikData);
                console.log('Map initialization complete');
            }
        } catch (error) {
            console.error('Error initializing map:', error);
        }
    }, 400);
});
