<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\select2\Select2;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ProductorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Productores';
$this->params['breadcrumbs'][] = $this->title;
?>

<style>
hr {
  border: 0;
  clear:both;
  display:block;
  width: 98%;               
  background-color: lightgrey;
  height: 3px;
}
</style>

<div class="productor-index" >

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Agregar Productor', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Mapa de Productores', ['catalogo/mapaproductores'], ['class' => 'btn btn-primary']) ?>
    </p>

    <hr>

    <?php Pjax::begin(); ?>
    <?php  echo $this->render('_search', ['model' => $searchModel, 'provinciasModel' => $provinciasModel,'localidadesModel' => $localidadesModel,]); ?>

    <hr>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'nombre',
            ['attribute'=>'N. Fantasía',
             'value'=> 'nombreFantasia'],
            'cuit',
            ['attribute'=>'Localidad',
             'value'=> 'localidad.nombre'],
            'numeroTelefono',
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
                                    $url =Url::to(['productor/activar?id='.$model->idProductor]);
                                    return $url;
                                }else{
                                    if ($action === 'update') {
                                        $url =Url::to(['productor/update?id='.$model->idProductor]);
                                        return $url;
                                    }
                                    if ($action === 'delete') {
                                        $url =Url::to(['productor/delete?id='.$model->idProductor]);
                                        return $url;
                                    }
                                    if ($action === 'view') {
                                        $url =Url::to(['productor/view?id='.$model->idProductor]);
                                        return $url;
                                    }
                                }
                         }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
