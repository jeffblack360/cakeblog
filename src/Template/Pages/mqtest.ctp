<?php

$this->layout = false;

?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.5/leaflet.css" />

        <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.5/leaflet.js"></script>
        <script src="https://www.mapquestapi.com/sdk/leaflet/v2.s/mq-map.js?key=SALK4pAZEps4Oy7g1QUpBXn0duOXhskp"></script>
        <script src="http://www.mapquestapi.com/sdk/leaflet/v2.s/mq-geocoding.js?key=SALK4pAZEps4Oy7g1QUpBXn0duOXhskp"></script>

        <script type="text/javascript">
            window.onload = function () {
                MQ.geocode().search([
                    'franklin tn',
                    'columbia tn',
                    'dickson tn'
                ])
                        .on('success', function (e) {
                            var results = e.result,
                                    html = '',
                                    group = [],
                                    features,
                                    marker,
                                    result,
                                    latlng,
                                    prop,
                                    best,
                                    val,
                                    map,
                                    r,
                                    i;

                            map = L.map('map', {
                                layers: MQ.mapLayer()
                            });

                            for (i = 0; i < results.length; i++) {
                                result = results[i].best;
                                latlng = result.latlng;

                                html += '<div style="width:300px; float:left;">';
                                html += '<p><strong>Geocoded Location #' + (i + 1) + '</strong></p>';

                                for (prop in result) {
                                    r = result[prop];

                                    if (prop === 'displayLatLng') {
                                        val = r.lat + ', ' + r.lng;
                                    } else if (prop === 'mapUrl') {
                                        val = '<br /><img src="' + r + '" />';
                                    } else {
                                        val = r;
                                    }

                                    html += prop + ' : ' + val + '<br />';
                                }

                                html += '</div>';

                                // create POI markers for each location
                                marker = L.marker([latlng.lat, latlng.lng])
                                        .bindPopup(result.adminArea5 + ', ' + result.adminArea3);

                                group.push(marker);
                            }

                            // add POI markers to the map and zoom to the features
                            features = L.featureGroup(group).addTo(map);
                            map.fitBounds(features.getBounds());

                            // show location information
                            L.DomUtil.get('info').innerHTML = html;
                        });


            }
        </script>
    </head>

    <body style='border:0; margin: 0'>
        <div id='map' style='width:1100px; height:530px;'></div>
        <div id="info"></div>
    </body>
</html>