<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Feria */

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Ferias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="feria-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            
            'nombre',
            'localidad.nombre',
        ],
    ]) ?>

    <div class="col-md-12 col-xs-12">  
        <h4> Ubicación   <h4>    
        <div id="googleMap" style="width:100%;height:200px;"></div>

    </div>

<p>
        <?= Html::a('Editar', ['update', 'id' => $model->idFeria], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->idFeria], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Desea eliminar esta feria?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
</div>
<script>
    var latitud = parseFloat(<?php echo json_encode($model->latitud) ?>);
    var longitud = parseFloat(<?php echo json_encode($model->longitud) ?>);
    function myMap() {
        const myLatLng = { lat: latitud, lng: longitud };
        lat = 0;
        long = 0;
        
        if(!isNaN(latitud)){
            lat = latitud;
            long = longitud ;
        }else{
            lat = -38.95146614;
            long = -68.05905819;
        }
        
        var mapProp= {
            center:new google.maps.LatLng(lat,long),
            zoom:15,
        };
 
    var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
 
    new google.maps.Marker({
        position: myLatLng,
        map,
        title: "Productor"
    });
}
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBbryvr-215IpAVrBJ50KY6DToPUplMcmM&callback=myMap"></script>
