<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $ferias[] app\models\Registro */
use dosamigos\leaflet\types\LatLng;
use dosamigos\leaflet\layers\Marker;
use dosamigos\leaflet\layers\TileLayer;
use dosamigos\leaflet\LeafLet;
use dosamigos\leaflet\widgets\Map;

// first lets setup the center of our map
// The Tile Layer (very important)
$markers = [];
foreach ($productores as $productor) {
    if(!is_null($productor[1]) && !(strpos($productor[1],'°'))){
        $centerMarker = new LatLng(['lat' => $productor[1], 'lng' => $productor[2]]);

// now lets create a marker that we are going to place on our map
        $descripcion = $productor[0];
        $marker = new Marker(['latLng' => $centerMarker, 'popupContent' => $descripcion
        ]);
        $markers[] = $marker; // add the marker (addLayer is used to add different layers to our map)
    }
}
$center = new LatLng(['lat' => '-38.930277', 'lng' => '-68.245006']);// centro del mapa
$tileLayer = new TileLayer([
    'urlTemplate' => 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
    'clientOptions' => [
        'attribution' => '' .
        'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>',
    //'subdomains' => 'nix'
    ]
        ]);

// now our component and we are going to configure it
// finally render the widget
// we could also do
// echo $leaflet->widget();

?>


<style>
    #w0{
        height : 700px !important;
    }
</style>

<div class="mapa">
    
    <?php 
        if (count($markers) > 0) {
        $leaflet = new LeafLet([
            'tileLayer' => $tileLayer, // set the TileLayer
            'center' => $center, // set the center
            'zoom'=>11,
        ]);

        foreach ($markers as $marker) {
            $leaflet->addLayer($marker);
        }
        echo Map::widget(['leafLet' => $leaflet,'options' => []]);
        } else{
            echo 'No tiene puntos para mostrar';
        }
     ?>
</div>
