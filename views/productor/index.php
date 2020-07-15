<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ProductorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Productores';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="productor-index" >

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Agregar Productor', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php  echo $this->render('_search', ['model' => $searchModel, 'provinciasModel' => $provinciasModel,'localidadesModel' => $localidadesModel,]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'nombre',
            'cuit',
            
            ['attribute'=>'Localidad',
             'value'=> 'localidad.nombre'],
            'nombreCalle',
            'numeroCalle',
            'numeroTelefono',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
