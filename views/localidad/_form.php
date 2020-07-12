<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
/* @var $this yii\web\View */
/* @var $model app\models\Localidad */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="localidad-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?=  $form->field($model, 'idProvincia')->widget(Select2::classname(), [
                    'data' => $provinciasModel,
                    'options' => ['placeholder' => 'Seleccione una Provincia'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ])  ?>

    <?= $form->field($model, 'codigoPostal')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
