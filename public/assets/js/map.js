class MapManager {
    constructor(containerId, options = {}) {
        this.containerId = containerId;
        this.defaultCenter = options.center || [-6.597146, 106.806039];
        this.defaultZoom = options.zoom || 13;
        this.map = null;
        this.markers = [];
    }

    init() {
        const mapContainer = document.getElementById(this.containerId);
        if (!mapContainer) {
            console.error(
                `Map container #${this.containerId} not found in DOM`
            );
            return false;
        }

        if (window.mapInstance) window.mapInstance.remove();

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
            renderer: L.canvas(),
        });

        window.mapInstance = this.map;

        this.addTileLayer();
        this.invalidateSize();
        this.handleResize();

        return true;
    }

    addTileLayer() {
        const tileLayer = L.tileLayer(
            "https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}.png",
            {
                attribution:
                    '&copy; <a href="https://carto.com/">CARTO</a> | Map data © OpenStreetMap contributors',
                maxZoom: 20,
                minZoom: 1,
                tileSize: 256,
                zoomOffset: 0,
                crossOrigin: true,
            }
        );

        tileLayer.addTo(this.map);
    }

    addMarkers(data) {
        if (!data || !Array.isArray(data) || data.length === 0) {
            console.log("No marker data available");
            return;
        }

        const bounds = [];
        let markerCount = 0;

        data.forEach((titik, index) => {
            if (titik.latitude && titik.longitude) {
                const lat = parseFloat(titik.latitude);
                const lng = parseFloat(titik.longitude);

                if (isNaN(lat) || isNaN(lng)) {
                    console.warn("Invalid coordinates for titik:", titik);
                    return;
                }

                const marker = L.marker([lat, lng]);
                marker.addTo(this.map);

                marker.bindPopup(
                    `<b>${titik.nama_titik || "Lokasi " + (index + 1)}</b>`
                );

                this.markers.push(marker);
                bounds.push([lat, lng]);
                markerCount++;
            }
        });

        console.log(`Added ${markerCount} markers`);

        if (bounds.length > 1) {
            this.map.fitBounds(bounds, { padding: [50, 50] });
        } else if (bounds.length === 1) {
            this.map.setView(bounds[0], this.defaultZoom);
        }
    }

    invalidateSize() {
        setTimeout(() => this.map.invalidateSize(), 100);
        setTimeout(() => this.map.invalidateSize(), 500);
    }

    handleResize() {
        let resizeTimeout;
        window.addEventListener("resize", () => {
            clearTimeout(resizeTimeout);
            resizeTimeout = setTimeout(() => {
                if (this.map) this.map.invalidateSize();
            }, 250);
        });
    }

    clearMarkers() {
        this.markers.forEach((marker) => marker.remove());
        this.markers = [];
    }

    destroy() {
        if (this.map) {
            this.map.remove();
            this.map = null;
            window.mapInstance = null;
        }
    }
}

document.addEventListener("DOMContentLoaded", function () {
    setTimeout(function () {
        try {
            const titikData = window.titikData || [];

            const mapManager = new MapManager("map", {
                center: [-6.597146, 106.806039],
                zoom: 13,
            });

            if (mapManager.init()) {
                mapManager.addMarkers(titikData);
            }
        } catch (error) {
            console.error("Error initializing map:", error);
        }
    }, 400);
});
