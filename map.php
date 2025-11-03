<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peta & Data Kecamatan</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #ffe6f0; /* From input.php */
            height: 100vh;
            box-sizing: border-box;
        }
        .container {
            display: flex;
            gap: 20px;
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1); /* From input.php */
            height: calc(100% - 40px);
            box-sizing: border-box;
        }
        #map {
            flex: 2; /* Map takes 2/3 of the space */
            height: 100%;
            border-radius: 8px;
        }
        #table-container {
            flex: 1; /* Table takes 1/3 of the space */
            height: 100%;
            overflow-y: auto;
        }
        h2 {
            text-align: center;
            color: #333; /* From input.php */
            margin-top: 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        thead {
            background-color: #ff6fa5; /* From input.php */
            color: white;
            position: sticky;
            top: 0;
        }
        tbody tr:nth-child(even) {
            background-color: #fce4ec;
        }
    </style>
</head>
<body>

    <div class="container">
        <div id="map"></div>
        <div id="table-container">
            <h2>Data Kecamatan</h2>
            <table id="data-table">
                <thead>
                    <tr>
                        <th>Kecamatan</th>
                        <th>Luas (km²)</th>
                        <th>Jumlah Penduduk</th>
                        <th>Latitude</th>
                        <th>Longitude</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Data will be inserted here by JavaScript -->
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script>
        var map = L.map('map');

        // Define Basemaps
        var basemaps = {
            'Street View': L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }),
            'Dark Mode': L.tileLayer('https://tiles.stadiamaps.com/tiles/alidade_smooth_dark/{z}/{x}/{y}{r}.png', {
                attribution: '&copy; <a href="https://stadiamaps.com/">Stadia Maps</a>, &copy; <a href="https://openmaptiles.org/">OpenMapTiles</a> &copy; <a href="https://openstreetmap.org">OpenStreetMap</a> contributors'
            }),
            'Satellite View': L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
                attribution: 'Tiles &copy; Esri &mdash; Source: Esri, i-cubed, USDA, USGS, AEX, GeoEye, Getmapping, Aerogrid, IGN, IGP, UPR-EGP, and the GIS User Community'
            })
        };

        // Set default basemap
        basemaps['Street View'].addTo(map);

        // Add layer control
        L.control.layers(basemaps).addTo(map);

        fetch('get_data.php')
            .then(response => response.json())
            .then(data => {
                var geojsonLayer = L.geoJSON(data, {
                    onEachFeature: function (feature, layer) {
                        var popupContent = `<b>${feature.properties.name}</b><br>` +
                                         `Luas: ${feature.properties.luas} km²<br>` +
                                         `Jumlah Penduduk: ${feature.properties.jumlah_penduduk}`;
                        layer.bindPopup(popupContent);
                    }
                }).addTo(map);

                if (geojsonLayer.getBounds().isValid()) {
                    map.fitBounds(geojsonLayer.getBounds());
                } else {
                    map.setView([-6.9175, 107.6191], 10);
                }

                // Populate the table
                const tableBody = document.querySelector('#data-table tbody');
                tableBody.innerHTML = ''; // Clear existing rows
                data.features.forEach(feature => {
                    const row = tableBody.insertRow();
                    const cell1 = row.insertCell(0);
                    const cell2 = row.insertCell(1);
                    const cell3 = row.insertCell(2);
                    const cell4 = row.insertCell(3);
                    const cell5 = row.insertCell(4);
                    cell1.textContent = feature.properties.name;
                    cell2.textContent = feature.properties.luas;
                    cell3.textContent = feature.properties.jumlah_penduduk;
                    cell4.textContent = feature.geometry.coordinates[1]; // Latitude
                    cell5.textContent = feature.geometry.coordinates[0]; // Longitude
                });
            });
    </script>

</body>
</html>
