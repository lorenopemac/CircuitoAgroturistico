<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\MedioPago */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="medio-pago-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <div class="col-md-12 col-xs-12">     
        <?= $form->field($model, 'imagen')->widget(FileInput::classname(), [
            'options' => ['multiple' => true],
            'pluginOptions' => [
                'initialPreview'=>[$model->imagen],
                'initialPreviewConfig' => $initialPreviewConfig,
                'previewFileType' => 'any', 
                'maxFileCount'=>10,
                'showCaption'=> false,
                'showRemove'=> true,
                'deleteUrl' => Url::to('eliminarimagen'),
                
                'showUpload'=> false]
            ]);
        ?>
    </div>

    <?= $form->field($model, 'baja')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
