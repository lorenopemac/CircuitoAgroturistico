<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\FeriaProductor */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="feria-productor-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idFeria')->textInput() ?>

    <?= $form->field($model, 'idProductor')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
