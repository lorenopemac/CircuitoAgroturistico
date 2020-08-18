<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\CategoriaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Categorias';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="categoria-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Agregar Categoria', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'nombre',
            'descripcion',
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
                                    $url =Url::to(['categoria/activar?id='.$model->idCategoria]);
                                    return $url;
                                }else{
                                    if ($action === 'update') {
                                        $url =Url::to(['categoria/update?id='.$model->idCategoria]);
                                        return $url;
                                    }
                                    if ($action === 'delete') {
                                        $url =Url::to(['categoria/delete?id='.$model->idCategoria]);
                                        return $url;
                                    }
                                    if ($action === 'view') {
                                        $url =Url::to(['categoria/view?id='.$model->idCategoria]);
                                        return $url;
                                    }
                                }
                         }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
