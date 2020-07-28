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
    <div class="col-md-12 col-xs-12">  
        <?=  GridView::widget([
            'dataProvider' => $provider,
            'columns' => [
                'redSocial.nombre',
                'direccion'    ,
            ],
        ]); ?>
    </div>

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
