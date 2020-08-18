<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\LocalidadSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Localidades';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="localidad-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Agregar Localidad', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php  echo $this->render('_search', ['model' => $searchModel,'provinciasModel' => $provinciasModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
    
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            
            'nombre',
            ['attribute'=>'Provincia',
             'value'=> 'provincia.nombre'],
            'codigoPostal',
            ['label'=>'Activo',
            'format'=>'raw',
            'value' => function($model, $key, $index, $column) { return $model->baja == 0 ? 'Si' : 'No';},],

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} &nbsp {view} &nbsp {activar} &nbsp {delete}',
                'header' => '',
                'buttons'=>[
                    'activar' => function ($url, $model) {     
                          return Html::a('<span class="glyphicon glyphicon-ok"></span>', $url, [
                              'title' => Yii::t('yii', 'Activar'),
                          ]);                                
                      },
                    'delete' => function ($url, $model) {     
                        return Html::a('<span class="glyphicon glyphicon-ban-circle"></span>', $url, [
                            'title' => Yii::t('yii', 'Desactivar'),
                        ]);                                
                    },
                  ],
                'urlCreator' => function ($action, $model, $key, $index) {
                                if ($action === 'activar') {
                                    $url =Url::to(['localidad/activar?id='.$model->idLocalidad]);
                                    return $url;
                                }else{
                                    if ($action === 'update') {
                                        $url =Url::to(['localidad/update?id='.$model->idLocalidad]);
                                        return $url;
                                    }
                                    if ($action === 'delete') {
                                        $url =Url::to(['localidad/delete?id='.$model->idLocalidad]);
                                        return $url;
                                    }
                                    if ($action === 'view') {
                                        $url =Url::to(['localidad/view?id='.$model->idLocalidad]);
                                        return $url;
                                    }
                                }
                         }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
