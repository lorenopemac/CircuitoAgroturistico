<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ProductorSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="productor-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'idProductor') ?>

    <?= $form->field($model, 'nombre') ?>

    <?= $form->field($model, 'cuit') ?>

    <?= $form->field($model, 'idLocalidad') ?>

    <?= $form->field($model, 'idProvincia') ?>

    <?php   $form->field($model, 'nombreCalle') ?>

    <?php   $form->field($model, 'numeroCalle') ?>

    <?php   $form->field($model, 'numeroTelefono') ?>

    <?php   $form->field($model, 'facebook') ?>

    <?php   $form->field($model, 'Instagram') ?>

    <?php   $form->field($model, 'twitter') ?>

    <?php   $form->field($model, 'web') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
