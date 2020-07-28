<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model app\models\RedSocial */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="red-social-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <div class="col-md-12 col-xs-12">     
        <?= $form->field($model, 'imagen')->widget(FileInput::classname(), [
            'options' => ['multiple' => true],
            'pluginOptions' => [
                'initialPreview'=>[$model->imagen],
                'previewFileType' => 'any', 
                'maxFileCount'=>10,
                'showCaption'=> false,
                'showRemove'=> false,
                
                'showUpload'=> false]
            ]);
        ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
