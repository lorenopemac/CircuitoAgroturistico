<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model app\models\Feria */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="feria-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <div class="col-md-6 col-xs-12">     
        <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-md-6 col-xs-12">         
        <?=  $form->field($model, 'idLocalidad')->widget(Select2::classname(), [
                        'data' => $localidadesModel,
                        'options' => ['placeholder' => 'Seleccione una Localidad'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
            ])  
        ?>
    </div>

    <div class="col-md-12 col-xs-12">         
        <?php if(!$vista){ ?>
            <?= $form->field($model, 'imagenes[]')->widget(FileInput::classname(), [
                'options' => ['multiple' => true],
                'pluginOptions' => [
                    'previewFileType' => 'any', 
                    'maxFileCount'=>10,
                    'showRemove' => true,
                    'showCaption'=> false,
                    'showRemove'=> false,
                    
                    'showUpload'=> false]
                ]);
            ?>
        <?php }else{ ?>
            <?= $form->field($model, 'imagenes[]')->widget(FileInput::classname(), [
                'options' => ['multiple' => true],
                'pluginOptions' => [
                    'initialPreview'=>$model->imagenes,
                    'previewFileType' => 'any', 
                    'maxFileCount'=>10,
                    'showRemove' => true,
                    'showCaption'=> false,
                    'showRemove'=> false,
                    
                    'showUpload'=> false]
                ]);
            ?>
        <?php } ?>
    </div>
    <div class="col-md-6 col-xs-12" style="display:none">     
        <?= $form->field($model, 'latitud')->textInput(['maxlength' => true]) ?>
    </div>

    <div class="col-md-6 col-xs-12" style="display:none">     
        <?= $form->field($model, 'longitud')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
