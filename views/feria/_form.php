<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Feria */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="feria-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    
    <?=  $form->field($model, 'idLocalidad')->widget(Select2::classname(), [
                     'data' => $localidadesModel,
                     'options' => ['placeholder' => 'Seleccione una Localidad'],
                     'pluginOptions' => [
                         'allowClear' => true
                     ],
        ])  
    ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
