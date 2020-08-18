<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ProvinciaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Provincias';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="provincia-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Agregar Provincia', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            
            'nombre',
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
                                    $url =Url::to(['provincia/activar?id='.$model->idProvincia]);
                                    return $url;
                                }else{
                                    if ($action === 'update') {
                                        $url =Url::to(['provincia/update?id='.$model->idProvincia]);
                                        return $url;
                                    }
                                    if ($action === 'delete') {
                                        $url =Url::to(['provincia/delete?id='.$model->idProvincia]);
                                        return $url;
                                    }
                                    if ($action === 'view') {
                                        $url =Url::to(['provincia/view?id='.$model->idProvincia]);
                                        return $url;
                                    }
                                }
                         }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
