<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use kartik\select2\Select2;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ProductorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Productos en Venta';
$this->params['breadcrumbs'][] = $this->title;
?>

<h1> Productos en Venta </h1>
<div class="categoria-index" >
<?php \yii\widgets\Pjax::begin();?>

<?php foreach($productos as $producto):?>
    <div class="col-lg-4">
        <p></p><h2 style="text-align:center"><?= Html::a(Html::encode($producto->nombre)) ?></h2><p></p>
        
        <p style="text-align:center"><?= $producto->imagenes[0] ?>  </p>

        <p style="text-align:center" ><?= $producto->descripcion ?></p>
        
        <p style="text-align:center"><?= Html::a('Ver más', ['/producto/view','id'=>$producto->idProducto], ['class'=>'btn btn-success']) ?></p>
    </div>
<?php endforeach; ?>

<?php Pjax::end(); ?>

</div>