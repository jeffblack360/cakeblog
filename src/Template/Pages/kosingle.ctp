<?php

use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Network\Exception\NotFoundException;

$this->layout = false;

?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.7.5/leaflet.css" />
        <script type="text/javascript" src="http://www.mapquestapi.com/sdk/leaflet/v2.s/mq-map.js?key=Kmjtd%7Cluua2qu7n9%2C7a%3Do5-lzbgq"></script>

        <script type="text/javascript">

            window.onload = function() {
              L.map('maprjb', {
                layers: MQ.mapLayer(),
                center: [ 40.731701, -73.993411 ],
                zoom: 12
              });
            };

        </script>

    </head>
    <body>

        <div>   

            <ul class="folders" data-bind="foreach: folders">
                <li data-bind="text: $data,
                   css: { selected: $data === $root.chosenFolderId() },
                   click: $root.goToFolder">
                </li>
            </ul>

        </div>



        <div id="maprjb" style="width:1000px; height:400px;"></div>


        <!-- JavaScript Files Here -->
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/knockout/3.4.0/knockout-min.js"></script>
        <script type="text/javascript" src="/js/kosingle.js"></script>
    </body>
</html>
