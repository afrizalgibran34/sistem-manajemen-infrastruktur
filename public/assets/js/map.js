class MapManager {
    constructor(containerId, options = {}) {
        this.containerId = containerId;
        this.defaultCenter = options.center || [-6.597146, 106.806039];
        this.defaultZoom = options.zoom || 13;
        this.map = null;
        this.markers = [];
        this.tileLayers = {};
        this.currentTileLayer = null;
        this.currentLayerName = "OpenStreetMap";
        this.titikData = [];
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

        this.addTileLayers();
        this.createCustomLayerControl();
        this.invalidateSize();
        this.handleResize();

        return true;
    }

    addTileLayers() {
        this.tileLayers = {
            OpenStreetMap: L.tileLayer(
                "https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png",
                { attribution: "© OpenStreetMap contributors", maxZoom: 19 }
            ),
            "OpenStreetMap HOT": L.tileLayer(
                "https://{s}.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png",
                {
                    attribution: "© OpenStreetMap contributors, Tiles by HOT",
                    maxZoom: 19,
                }
            ),
            "OpenStreetMap DE": L.tileLayer(
                "https://{s}.tile.openstreetmap.de/{z}/{x}/{y}.png",
                { attribution: "© OpenStreetMap contributors", maxZoom: 19 }
            ),
            "OpenStreetMap FR": L.tileLayer(
                "https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png",
                {
                    attribution: "© OpenStreetMap France | © OpenStreetMap",
                    maxZoom: 19,
                }
            ),
            "CartoDB Positron": L.tileLayer(
                "https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}.png",
                { attribution: "© OpenStreetMap © CARTO", maxZoom: 19 }
            ),
            "CartoDB Dark": L.tileLayer(
                "https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}.png",
                { attribution: "© OpenStreetMap © CARTO", maxZoom: 19 }
            ),
            "Stamen Toner": L.tileLayer(
                "https://stamen-tiles-{s}.a.ssl.fastly.net/toner/{z}/{x}/{y}.png",
                {
                    attribution: "Map tiles by Stamen Design, CC BY 3.0",
                    maxZoom: 19,
                }
            ),
            "Stamen Terrain": L.tileLayer(
                "https://stamen-tiles-{s}.a.ssl.fastly.net/terrain/{z}/{x}/{y}.png",
                {
                    attribution: "Map tiles by Stamen Design, CC BY 3.0",
                    maxZoom: 19,
                }
            ),
            "ESRI Imagery": L.tileLayer(
                "https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}",
                { attribution: "Tiles © Esri", maxZoom: 19 }
            ),
            "Google Streets": L.tileLayer(
                "https://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}",
                {
                    attribution: "© Google",
                    maxZoom: 20,
                    subdomains: ["mt0", "mt1", "mt2", "mt3"],
                }
            ),
            "Google Satellite": L.tileLayer(
                "https://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}",
                {
                    attribution: "© Google",
                    maxZoom: 20,
                    subdomains: ["mt0", "mt1", "mt2", "mt3"],
                }
            ),
        };

        this.currentTileLayer = this.tileLayers["OpenStreetMap"].addTo(
            this.map
        );
    }

    createCustomLayerControl() {
        const controlContainer = L.DomUtil.create(
            "div",
            "leaflet-control-layers-custom"
        );
        controlContainer.style.cssText = `
            position: absolute;
            top: 10px;
            right: 10px;
            z-index: 1000;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.15);
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        `;

        const select = L.DomUtil.create("select", "", controlContainer);
        select.style.cssText = `
            padding: 10px 32px 10px 14px;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            color: #374151;
            background: white;
            cursor: pointer;
            outline: none;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%23374151' d='M6 9L1 4h10z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 10px center;
            min-width: 180px;
        `;

        select.addEventListener("mouseenter", () => {
            select.style.background =
                "linear-gradient(to bottom, #f9fafb, white)";
            select.style.backgroundImage =
                "url(\"data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%23374151' d='M6 9L1 4h10z'/%3E%3C/svg%3E\")";
            select.style.backgroundRepeat = "no-repeat";
            select.style.backgroundPosition = "right 10px center";
        });

        select.addEventListener("mouseleave", () => {
            select.style.background = "white";
            select.style.backgroundImage =
                "url(\"data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%23374151' d='M6 9L1 4h10z'/%3E%3C/svg%3E\")";
            select.style.backgroundRepeat = "no-repeat";
            select.style.backgroundPosition = "right 10px center";
        });

        Object.keys(this.tileLayers).forEach((layerName) => {
            const option = L.DomUtil.create("option", "", select);
            option.value = layerName;
            option.textContent = layerName;
            if (layerName === this.currentLayerName) {
                option.selected = true;
            }
        });

        select.addEventListener("change", (e) => {
            const selectedLayer = e.target.value;
            this.switchLayer(selectedLayer);
        });

        L.DomEvent.disableClickPropagation(controlContainer);
        L.DomEvent.disableScrollPropagation(controlContainer);

        this.map.getContainer().appendChild(controlContainer);
    }

    switchLayer(layerName) {
        if (this.currentTileLayer) {
            this.map.removeLayer(this.currentTileLayer);
        }
        this.currentTileLayer = this.tileLayers[layerName];
        this.currentTileLayer.addTo(this.map);
        this.currentLayerName = layerName;
    }

    createCustomIcon(isOnline) {
        const color = isOnline ? "#0080FE" : "#EF4444";
        const svgIcon = `
            <svg width="36" height="48" viewBox="0 0 36 48" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <filter id="shadow" x="-50%" y="-50%" width="200%" height="200%">
                        <feGaussianBlur in="SourceAlpha" stdDeviation="2"/>
                        <feOffset dx="0" dy="2" result="offsetblur"/>
                        <feComponentTransfer>
                            <feFuncA type="linear" slope="0.3"/>
                        </feComponentTransfer>
                        <feMerge>
                            <feMergeNode/>
                            <feMergeNode in="SourceGraphic"/>
                        </feMerge>
                    </filter>
                </defs>
                <g filter="url(#shadow)">
                    <path d="M18 2C10.268 2 4 8.268 4 16c0 9.75 13 28 14 28s14-18.25 14-28c0-7.732-6.268-14-14-14z" 
                          fill="${color}" stroke="white" stroke-width="2"/>
                    <circle cx="18" cy="16" r="6" fill="white"/>
                </g>
            </svg>
        `;

        return L.divIcon({
            html: svgIcon,
            className: "custom-marker-icon",
            iconSize: [36, 48],
            iconAnchor: [18, 48],
            popupAnchor: [0, -48],
        });
    }

    addMarkers(data) {
        if (!data || !Array.isArray(data) || data.length === 0) {
            console.log("No marker data available");
            return;
        }

        this.titikData = data; // Store data for sidebar access
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

                const isOnline = titik.status.toLowerCase() === "on";
                const customIcon = this.createCustomIcon(isOnline);

                const marker = L.marker([lat, lng], { icon: customIcon });
                marker.addTo(this.map);

                const statusText = isOnline
                    ? '<span style="color: #10B981; font-weight: 600;">● ONLINE</span>'
                    : '<span style="color: #EF4444; font-weight: 600;">● OFFLINE</span>';

                marker.bindPopup(
                    `
                    <div style="padding: 12px; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; min-width: 180px;">
                        <div style="font-size: 16px; font-weight: 600; color: #111827; margin-bottom: 8px;">
                            ${titik.nama_titik || "Lokasi " + (index + 1)}
                        </div>
                        <div style="font-size: 14px; color: #6B7280; display: flex; align-items: center; gap: 6px; margin-bottom: 12px;">
                            <span style="color: #9CA3AF;">Status:</span> ${statusText}
                        </div>
                        <button class="detail-btn" data-titik-id="${
                            titik.id_titik
                        }" style="background: #3B82F6; color: white; border: none; padding: 8px 16px; border-radius: 6px; font-size: 14px; font-weight: 500; cursor: pointer; width: 100%; transition: background-color 0.2s;">
                            Lihat Detail
                        </button>
                    </div>
                `,
                    {
                        maxWidth: 300,
                        className: "custom-popup",
                    }
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

    showSidebar(titikId) {
        // Deprecated: prefer fetchAndShowSidebar which gets fresh data from server
        this.fetchAndShowSidebar(titikId);
    }

    /**
     * Fetch titik detail from server and open sidebar
     */
    fetchAndShowSidebar(titikId) {
        if (!titikId) return;

        fetch(`/peta/detail/${titikId}`, { credentials: "same-origin" })
            .then((res) => {
                if (!res.ok) throw new Error("Data not found");
                return res.json();
            })
            .then((titik) => {
                this.populateSidebarFromData(titik);
                // show sidebar
                document
                    .getElementById("detail-sidebar")
                    .classList.remove("translate-x-full");
                document
                    .getElementById("sidebar-overlay")
                    .classList.remove("hidden");
                document.body.style.overflow = "hidden";
            })
            .catch((err) => {
                console.error("Error loading detail:", err);
            });
    }

    /**
     * Populate sidebar DOM elements using the titik object (raw DB fields + relations)
     */
    populateSidebarFromData(titik) {
        if (!titik) return;

        const get = (v, fallback = "-") =>
            v !== null && v !== undefined && v !== "" ? v : fallback;

        // Basic fields from titik_lokasi table
        document.getElementById("detail-nama-titik").textContent = get(
            titik.nama_titik
        );
        document.getElementById("detail-keterangan").textContent = get(
            titik.keterangan
        );
        document.getElementById("detail-koneksi").textContent = get(
            titik.koneksi
        );
        document.getElementById("detail-perangkat").textContent = get(
            titik.perangkat
        );
        document.getElementById("detail-latitude").textContent = get(
            titik.latitude
        );
        document.getElementById("detail-longitude").textContent = get(
            titik.longitude
        );

        // IDs and raw foreign keys
        document.getElementById("detail-backbone").textContent =
            titik.backbone && titik.backbone.jenis_backbone
                ? titik.backbone.jenis_backbone
                : titik.id_backbone || "-";
        document.getElementById("detail-uplink").textContent =
            titik.uplink && titik.uplink.jenis_uplink
                ? titik.uplink.jenis_uplink
                : titik.id_uplink || "-";

        // Related names when available (via eager loading)
        document.getElementById("detail-wilayah").textContent = titik.wilayah
            ? get(titik.wilayah.nama_wilayah)
            : "-";
        document.getElementById("detail-kec-kel").textContent = titik.kec_kel
            ? get(titik.kec_kel.nama_kec_kel)
            : "-";
        document.getElementById("detail-klasifikasi").textContent =
            titik.klasifikasi ? get(titik.klasifikasi.klasifikasi) : "-";

        // Status
        const isOnline =
            titik.status && String(titik.status).toLowerCase() === "on";
        const statusElement = document.getElementById("detail-status");
        const statusDot = document.getElementById("detail-status-dot");
        const statusText = document.getElementById("detail-status-text");

        statusElement.className = `inline-flex items-center px-3 py-2 rounded-md text-sm font-medium ${
            isOnline ? "bg-green-100 text-green-800" : "bg-red-100 text-red-800"
        }`;
        statusDot.style.backgroundColor = isOnline ? "#10B981" : "#EF4444";
        statusText.textContent = isOnline
            ? "ONLINE"
            : titik.status
            ? titik.status
            : "-";
    }

    hideSidebar() {
        document
            .getElementById("detail-sidebar")
            .classList.add("translate-x-full");
        document.getElementById("sidebar-overlay").classList.add("hidden");
        document.body.style.overflow = ""; // Restore scroll
    }
}

// Add custom CSS for popup
const style = document.createElement("style");
style.textContent = `
    .custom-marker-icon {
        background: none;
        border: none;
    }
    
    .custom-popup .leaflet-popup-content-wrapper {
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        padding: 0;
    }
    
    .custom-popup .leaflet-popup-content {
        margin: 0;
    }
    
    .custom-popup .leaflet-popup-tip {
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
`;
document.head.appendChild(style);

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

            // Event delegation for detail buttons in popups
            document.addEventListener("click", function (e) {
                // Use closest to handle clicks on inner elements inside the button
                const btn = e.target.closest
                    ? e.target.closest(".detail-btn")
                    : null;
                if (btn) {
                    e.preventDefault();
                    e.stopPropagation();
                    const titikId = btn.getAttribute("data-titik-id");
                    // Use fetch to get fresh data and show sidebar
                    mapManager.fetchAndShowSidebar(titikId);
                }
            });

            // Close sidebar events
            document
                .getElementById("close-sidebar")
                .addEventListener("click", function () {
                    mapManager.hideSidebar();
                });

            document
                .getElementById("close-sidebar-left")
                .addEventListener("click", function () {
                    mapManager.hideSidebar();
                });

            document
                .getElementById("sidebar-overlay")
                .addEventListener("click", function () {
                    mapManager.hideSidebar();
                });

            // Close on escape key
            document.addEventListener("keydown", function (e) {
                if (e.key === "Escape") {
                    mapManager.hideSidebar();
                }
            });
        } catch (error) {
            console.error("Error initializing map:", error);
        }
    }, 400);
});
