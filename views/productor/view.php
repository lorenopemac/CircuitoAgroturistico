<?php
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Productor */

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Productors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
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
        <div id="googleMap" style="width:100%;height:200px;"></div>

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
