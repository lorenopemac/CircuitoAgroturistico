<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\grid\GridView;
use kartik\select2\Select2;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ProductoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Productos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="producto-index">
    <?php \yii\widgets\Pjax::begin();?>
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Agregar Producto', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    
    
    <div class="producto-search">
        <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-area-chart"></i>&nbsp;Detalle de Avance Fisico</h3>
        </div>
        <div class="box-body">
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
                <?= Html::a('cancelar', ['/producto/index'], ['class'=>'btn btn-warning']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
        </div>
        </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'nombre',
            'descripcion',
            ['attribute'=>'productor',
             'value'=> 'productor.nombre'],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

<?php \yii\widgets\Pjax::end();?>

</div>
