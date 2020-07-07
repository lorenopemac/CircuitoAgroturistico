<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\ProductoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="producto-search" >
<?php \yii\widgets\Pjax::begin();?>
    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    
    <div class="col-md-4 col-xs-12">
        <?= $form->field($model, 'nombre') ?>
    </div>

    <div class="col-md-4 col-xs-12">        
        <?= $form->field($model, 'descripcion') ?>
    </div>

    <div class="col-md-4 col-xs-12">
        <?=  $form->field($model, 'idProductor')->widget(Select2::classname(), [
            'data' => $productoresModel,
            'options' => ['placeholder' => 'Seleccione un Productor'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ])  ?>
    </div>
    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>
<?php \yii\widgets\Pjax::end();?>
</div>
