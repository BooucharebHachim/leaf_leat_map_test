<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="leaflet-1.7/leaflet.css" />
    <link rel="stylesheet" href="leaflet-routing-machine-3.2.12/leaflet-routing-machine.css">
    <script src="leaflet-1.7/leaflet.js"></script>
    <script src="leaflet-routing-machine-3.2.12/leaflet-routing-machine.min.js"></script>
    <script src="lrm/lrm-graphhopper-1.2.0.js"></script>

</head>

<body>


    <div id="map" style="width: 100%;height: 700px;">

    </div>

    <script>
        ///crating map container
        var map = L.map('map', {
            center: [36.45, 7.433333],
            zoom: 12
        });
        /* get cords of clicking point */ 
        map.on('click',function(e){
            //x=>e.latlng.lat
            console.log(e.latlng.lat);
            //y=>e.latlng.lng
            console.log(e.latlng.lng);
        });



        /*---------------*/
        /// add map layer
        L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
            maxZoom: 18,
            attribution: '',
            id: 'mapbox/streets-v11',
            tileSize: 512,
            zoomOffset: -1
        }).addTo(map);


        ///var posted cords
        <?php
        /*
        echo "var library_cords = { latitude: " . $_GET['x'] . ", longitude: " . $_GET['y'] . " };";
        echo "var user_cords = { latitude: " . $_GET['x'] . ", longitude: " . $_GET['y'] . " }";
        */
        ?>

        var library_cords={latitude:36.44,longitude:7.44};
        var user_cords={latitude:36.4492,longitude:7.4211};

        //var mbr=L.Routing.mapbox(accessToken, { profile : 'mapbox/walking' });
       var control=L.Routing.control({
                waypoints: [
                    L.latLng(user_cords.latitude, user_cords.longitude), /*starter point */
                    L.latLng(library_cords.latitude, library_cords.longitude) /*end point */
                ],
                router: L.Routing.graphHopper('5f0a6be0-b8d9-4b80-aacd-b6ae99c43b7c')
                ,
                routeWhileDragging: true,
                
                createMarker: function(i, wp, nWps) {
                    if (i === 0) {
                        ///start point marker and icons 
                        return L.marker(wp.latLng, {
                            icon: L.icon({
                                iconUrl: 'trans.png',
                                iconSize: [19, 20],
                                popupAnchor: [-3, -76],
                                shadowSize: [68, 95],
                                shadowAnchor: [22, 94],
                            }),
                            title: "Myposition"
                        });
                    }
                    // end  point marker and icons
                    if (i === nWps - 1) {
                        return L.marker(wp.latLng, {
                            icon: L.icon({
                                iconUrl: 'trans.png',
                                iconSize: [19, 20],
                                popupAnchor: [-3, -76],
                                shadowSize: [68, 95],
                                shadowAnchor: [22, 94]
                            }),
                            title: "Central unive library"
                        });
                    }
                }

            }).addTo(map);


                

                // user marker
                  var marker= L.marker(L.latLng(user_cords.latitude, user_cords.longitude), {
                            icon: L.icon({
                                iconUrl: 'user.png',
                                iconSize: [19, 20],
                                popupAnchor: [-3, -76],
                                shadowSize: [68, 95],
                                shadowAnchor: [22, 94]
                            }),
                            title: "Central unive library"
                        }).addTo(map);

                  // library marker
                  var libmarker= L.marker(L.latLng(library_cords.latitude, library_cords.longitude), {
                            icon: L.icon({
                                iconUrl: 'library.png',
                                iconSize: [19, 20],
                                popupAnchor: [-3, -76],
                                shadowSize: [68, 95],
                                shadowAnchor: [22, 94]
                            }),
                            title: "Central unive library"
                        }).addTo(map);
            //library popup
            libmarker.bindPopup('<p>Hello world!<br />This is a nice popup.</p>')
            .offset(0,1)
            .openPopup();



               

    </script>
</body>

</html>