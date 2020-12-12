<?php
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

use dosamigos\leaflet\types\LatLng;
use dosamigos\leaflet\layers\Marker;
use dosamigos\leaflet\layers\TileLayer;
use dosamigos\leaflet\LeafLet;
use dosamigos\leaflet\widgets\Map;  

/* @var $this yii\web\View */
/* @var $model app\models\Productor */

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Productors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
/**
 * Creación de marcadores del mapa y de las capa del mismo
 * recorriendo cada feria que se mostrara en el mapa
 */
$markers = [];
if(!is_null($model->latitud)){
    $centerMarker = new LatLng(['lat' => $model->latitud, 'lng' => $model->longitud]);
    // now lets create a marker that we are going to place on our map
    $descripcion = 'Feria : '.$model->nombre;
    $marker = new Marker(['latLng' => $centerMarker, 'popupContent' => $descripcion
    ]);
    $markers[] = $marker; // add the marker (addLayer is used to add different layers to our map)
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

?>
<div class="productor-view">

    <h1><?= Html::encode($this->title) ?></h1>

    
    <div class="col-md-12 col-xs-12">  
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'nombre',
                'cuit',
                'provincia.nombre',
                'localidad.nombre',
                'nombreCalle',
                'numeroCalle',
                'numeroTelefono',
            ],
        ]) ?>
    </div>
    <div class="col-md-6 col-xs-12">  
        <?=  GridView::widget([
            'dataProvider' => $provider,
            'columns' => [
                'redSocial.nombre',
                'direccion'    ,
            ],
        ]); ?>
    </div>


    <div class="col-md-6 col-xs-12">  
        <h4> Ubicación   <h4>    
        <?php 
                if (count($markers) > 0) {
                $leaflet = new LeafLet([
                    'tileLayer' => $tileLayer, // set the TileLayer
                    'center' => $center, // set the center
                    'zoom'=>10,
                ]);

                foreach ($markers as $marker) {
                    $leaflet->addLayer($marker);
                }
                
                echo Map::widget(['leafLet' => $leaflet,'options' => ['style' => 'min-height: 380px']]);
                } else{
                    echo 'El Productor no participa en ferias actualmente';
                }
        ?>

    </div>

    <div class="col-md-12 col-xs-12">              
        <p>
            <?= Html::a('Editar', ['update', 'id' => $model->idProductor], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Eliminar', ['delete', 'id' => $model->idProductor], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>
        </p>
    </div>
</div>
