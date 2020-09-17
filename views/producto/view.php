<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
/* @var $this yii\web\View */
/* @var $model app\models\Producto */

\yii\web\YiiAsset::register($this);
?>
<div class="producto-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="col-md-12 col-xs-12" style="padding-bottom: 25px;">     
        <div class="col-md-6 col-xs-12">     
            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                    <li data-target="#myCarousel" data-slide-to="1"></li>
                    <li data-target="#myCarousel" data-slide-to="2"></li>
                </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner">
                    <?php
                        $indice =0;
                        foreach ($model->imagenes as $imagen)
                        {
                            if($indice==0){
                                $options = ['class' => ['item active']];
                            }else{
                                $options = ['class' => ['item']];
                            }
                            echo Html::tag('div', $imagen , $options);
                            $indice=$indice +1;
                        }
                    ?>
                </div>

                <!-- Left and right controls -->
                <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#myCarousel" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
            
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
