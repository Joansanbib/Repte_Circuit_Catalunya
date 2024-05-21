<head>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
</head>
<body>
    <div id="map" style="height: 100%;"></div>

    <script>
    var map = L.map('map').setView([41.569420, 2.257558], 16);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    var zones = {!! json_encode($zones) !!};

    // usuarios.forEach(function(usuario) {
    //     if (usuario.Poblacion != null && usuario.Poblacion != ''){
    //         var latitud = usuario.Latitud;
    //         var longitud = usuario.Longitud;
    //         L.marker([latitud, longitud]).addTo(map)
    //             .bindPopup('<p>Nombre completo: '+ usuario.Nombre + usuario.Apellido +
    //             '<br>Email: '+ usuario.Email);
                
    //     }
    // });

    </script>
</body>