<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
/* @var $this yii\web\View */
/* @var $model app\models\Producto */


$this->params['breadcrumbs'][] = ['label' => 'Productos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="producto-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="col-md-12 col-xs-12" style="padding-bottom: 25px;">     
        <div class="col-md-6 col-xs-12">     
            <?php
                foreach ($model->imagenes as $imagen)
                {
                    echo $imagen;
                }
            ?>
        </div>
        <div class="col-md-6 col-xs-12">     
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [

                    'nombre',
                    'descripcion',
                    'productor.nombre',
                ],
            ]) ?>
        </div>
    </div>        
    <div class="col-md-12 col-xs-12">     
        <div class="col-md-12 col-xs-12">   
                <h2>Productor</h2>
        </div>
        <div class="col-md-6 col-xs-12">  
            <?= DetailView::widget([
                'model' => $modelProductor,
                'attributes' => [
                    'nombre',
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
                'dataProvider' => $providerProductor,
                'columns' => [
                    
                    ['attribute'=>'Red Social',
                    'value'=> 'redSocial.nombre'],
                    ['attribute'=>'Link',
                    'value'=> 'direccion'],
                ],
            ]); ?>
        </div>
    </div>
    <div class="col-md-12 col-xs-12">   
        <p>
            <?= Html::a('Modificar', ['update', 'id' => $model->idProducto], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Eliminar', ['delete', 'id' => $model->idProducto], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>
        </p>
    </div>            
</div>
