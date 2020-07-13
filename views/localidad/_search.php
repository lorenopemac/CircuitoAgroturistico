<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $model app\models\LocalidadSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="localidad-search">

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
        <?=  $form->field($model, 'idProvincia')->widget(Select2::classname(), [
            'data' => $provinciasModel,
            'options' => ['placeholder' => 'Seleccione una Provincia'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ])  ?>
    </div>
    <div class="col-md-4 col-xs-12">        
        <?= $form->field($model, 'codigoPostal') ?>
    </div>                    
    <div class="form-group">
        <?= Html::submitButton('Buscar', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Cancelar', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
