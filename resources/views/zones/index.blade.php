<head>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <link rel="stylesheet" href="{{ asset('css/styles_navbar.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
</head>
<body>
    <nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
        <header id="header">
            <ul>
                <!-- <li><a href="/users">Usuaris</a></li>
                <li><a href="/incidences">Incidències</a></li>
                <li><a href="/zones/create">+ Zona</a></li>
                <li><a href="/logout">Tancar sessió</a></li>
                <li><a href="/">Home</a></li> -->
                <li><a href="/">Home</a></li>
                <li><a href="/incidences">Incidències</a></li>
                <li><a href="/zones/create">+ Zona</a></li>
                <li><a href="/users">Usuaris</a></li>
                <li><a href="/logout">Tancar sessió</a></li>
                
               <!--  <li><a href="/incidences">Incidències</a></li>
                <li><a href="/zones">Zones</a></li> -->
                
            </ul>
        </header>
    </nav>

    <div id="map" style="height: 100%;"></div>

    <script>
    var map = L.map('map').setView([41.569420, 2.257558], 16);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    var zones = {!! json_encode($zones) !!};
    var incidences = {!! json_encode($incidencies) !!};

    var svgMarkup = '<svg width="40dp" height="40dp" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path fill="#e74c3c" d="M12,0C7.582,0,4,3.582,4,8c0,1.421,0.382,2.75,1.031,3.906c0.108,0.192,0.221,0.381,0.344,0.563l6.625,11.531l6.625-11.531c0.102-0.151,0.19-0.311,0.281-0.469l0.063-0.094C19.618,10.75,20,9.421,20,8C20,3.582,16.418,0,12,0z M12,4c2.209,0,4,1.791,4,4s-1.791,4-4,4s-4-1.791-4-4S9.791,4,12,4z"/><path fill="#c0392b" d="M12,3c-2.761,0-5,2.239-5,5s2.239,5,5,5s5-2.239,5-5S14.761,3,12,3z M12,5c1.657,0,3,1.343,3,3s-1.343,3-3,3s-3-1.343-3-3S10.343,5,12,5z"/></svg>';    
    var customIcon = L.divIcon({
        className: 'custom-icon',
        html: svgMarkup,
        iconSize: [35, 35],
        iconAnchor: [17.5, 35],
        popupAnchor: [0, -15]
    });
    zones.forEach(function(zone) {
        if (zone.Latitude != null && zone.Longitude != null){
            var latitude = zone.Latitude;
            var longitude = zone.Longitude;
            L.marker([latitude, longitude], {icon: customIcon}).addTo(map)
            .bindPopup('<p>Nom de la zona: '+ zone.Nom +
            '<br>Descripció: '+ zone.Descripcio);
            
        }
        var cont = 0;
        incidences.forEach(function(incidence) {
            var latitudes = [0.000050, -0.000050, 0.000090];
            var longitudes = [0.000050, -0.000050, 0.000090];
            if (incidence.Zona == zone.id){
            var latitude = parseFloat(zone.Latitude) + latitudes[cont];
            var longitude = parseFloat(zone.Longitude) + longitudes[cont];
            L.marker([latitude, longitude]).addTo(map)
            .bindPopup('<p>Nom incidència: '+ incidence.Nom +
            '<br>Descripció: '+ incidence.Descripcio);
            
            cont++;
            if (cont >= latitudes.length) {
                cont = 0;
            }
            }
        });
    });


    </script>
</body>