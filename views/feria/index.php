<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\FeriaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ferias';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="feria-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Crear Feria', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php echo $this->render('_search', ['model' => $searchModel,'localidadesModel' => $localidadesModel]); ?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            
            'nombre',
            ['attribute'=>'Localidad',
             'value'=> 'localidad.nombre'],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
