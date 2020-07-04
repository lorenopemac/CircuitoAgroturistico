<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Productor */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="productor-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cuit')->textInput() ?>

    <?= $form->field($model, 'idLocalidad')->textInput() ?>

    <?= $form->field($model, 'idProvincia')->textInput() ?>

    <?= $form->field($model, 'nombreCalle')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'numeroCalle')->textInput() ?>

    <?= $form->field($model, 'numeroTelefono')->textInput() ?>

    <?= $form->field($model, 'facebook')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Instagram')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'twitter')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'web')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
