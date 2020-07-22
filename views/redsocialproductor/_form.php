<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RedsocialProductor */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="redsocial-productor-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idRed_social')->textInput() ?>

    <?= $form->field($model, 'idProductor')->textInput() ?>

    <?= $form->field($model, 'direccion')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
