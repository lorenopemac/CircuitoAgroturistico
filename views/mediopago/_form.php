<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MedioPago */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="medio-pago-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idMedio_pago')->textInput() ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'idImagen')->textInput() ?>

    <?= $form->field($model, 'baja')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
