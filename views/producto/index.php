<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\grid\GridView;
use kartik\select2\Select2;
use yii\helpers\Url;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ProductoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Productos';
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

<div class="producto-index">
    <?php \yii\widgets\Pjax::begin();?>
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Agregar Producto', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <hr>
    
    <div class="producto-search" >
        <div class="box box-success">
        <div class="box-header with-border">
            
        </div>
        
            <?php $form = ActiveForm::begin([
                'action' => ['index'],
                'method' => 'get',
                'options' => [
                    'data-pjax' => 1
                ],
            ]); ?>
            
            <div class="col-md-4 col-xs-12">
                <?= $form->field($searchModel, 'nombre') ?>
            </div>

            <div class="col-md-4 col-xs-12">        
                <?= $form->field($searchModel, 'descripcion') ?>
            </div>

            <div class="col-md-4 col-xs-12">
                <?=  $form->field($searchModel, 'idProductor')->widget(Select2::classname(), [
                    'data' => $productoresModel,
                    'options' => ['placeholder' => 'Seleccione un Productor'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ])  ?>
            </div>
            <div class="form-group">
                <?= Html::submitButton('Buscar', ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Cancelar', ['/producto/index'], ['class'=>'btn btn-warning']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
        </div>
        </div>

    <hr>                    

    <div class="box-body">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'nombre',
            'descripcion',
            ['attribute'=>'productor',
             'value'=> 'productor.nombre'],
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
                                    $url =Url::to(['producto/activar?id='.$model->idProducto]);
                                    return $url;
                                }else{
                                    if ($action === 'update') {
                                        $url =Url::to(['producto/update?id='.$model->idProducto]);
                                        return $url;
                                    }
                                    if ($action === 'delete') {
                                        $url =Url::to(['producto/delete?id='.$model->idProducto]);
                                        return $url;
                                    }
                                    if ($action === 'view') {
                                        $url =Url::to(['producto/view?id='.$model->idProducto]);
                                        return $url;
                                    }
                                }
                         }
            ],
        ],
    ]); ?>

<?php \yii\widgets\Pjax::end();?>

</div>
