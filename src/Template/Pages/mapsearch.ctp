<?php

$this->layout = 'default2';

?>

<?php $this->start('css'); ?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.5/leaflet.css" />

<?php $this->end(); ?>

<?php $this->start('script'); ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.5/leaflet.js"></script>
<script src="https://www.mapquestapi.com/sdk/leaflet/v2.s/mq-map.js?key=SALK4pAZEps4Oy7g1QUpBXn0duOXhskp"></script>

<script type="text/javascript">
    window.onload = function () {
        var mapLayer = MQ.mapLayer(), map;

        map = L.map('map', {
            layers: mapLayer,
//                    center: [ 40.731701, -73.993411 ],
            center: [35.970205, -86.910204],
            zoom: 12
        });
    }
</script>

<?php $this->end(); ?>

<div id='map' style='width:1100px; height:530px;'></div>