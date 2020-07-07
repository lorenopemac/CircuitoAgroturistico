<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\ProductorSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="productor-search" >

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <div class="col-md-3 col-xs-12">
        <?= $form->field($model, 'nombre') ?>
    </div>

    <div class="col-md-3 col-xs-12">
        <?= $form->field($model, 'cuit') ?>
    </div>

    <div class="col-md-3 col-xs-12">
        <?=  $form->field($model, 'idProvincia')->widget(Select2::classname(), [
                        'data' => $provinciasModel,
                        'options' => ['placeholder' => 'Seleccione una Provincia'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ])  ?>
    </div>

    <div class="col-md-3 col-xs-12">
        <?=  $form->field($model, 'idLocalidad')->widget(Select2::classname(), [
                        'data' => $localidadesModel,
                        'options' => ['placeholder' => 'Seleccione una Localidad'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ])  ?>
    </div>

    

    <div class="form-group col-xs-12">
        <?= Html::submitButton('Buscar', ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Cancelar', ['/productor/index'], ['class'=>'btn btn-warning']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
