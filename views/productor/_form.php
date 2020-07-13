<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\file\FileInput;
/* @var $this yii\web\View */
/* @var $model app\models\Productor */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="productor-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="col-md-6 col-xs-12">     
        <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-md-6 col-xs-12">     
        <?= $form->field($model, 'cuit')->textInput() ?>
    </div>
    <div class="col-md-6 col-xs-12">     
        <?=  $form->field($model, 'idProvincia')->widget(Select2::classname(), [
                    'data' => $provinciasModel,
                    'options' => ['placeholder' => 'Seleccione una Provincia'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ])  ?>
    </div>
    <div class="col-md-6 col-xs-12">     
        <?=  $form->field($model, 'idLocalidad')->widget(Select2::classname(), [
                    'data' => $localidadesModel,
                    'options' => ['placeholder' => 'Seleccione una Localidad'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ])  ?>
    </div>
    
    <div class="col-md-6 col-xs-12">     
        <?= $form->field($model, 'nombreCalle')->textInput(['maxlength' => true]) ?>
    </div>

    <div class="col-md-6 col-xs-12">     
        <?= $form->field($model, 'numeroCalle')->textInput() ?>
    </div>

    <div class="col-md-12 col-xs-12">     
        <?= $form->field($model, 'numeroTelefono')->textInput() ?>
    </div>

    <div class="col-md-6 col-xs-12">     
        <?= $form->field($model, 'facebook')->textInput(['maxlength' => true]) ?>
    </div>

    <div class="col-md-6 col-xs-12">     
        <?= $form->field($model, 'Instagram')->textInput(['maxlength' => true]) ?>
    </div>

    <div class="col-md-6 col-xs-12">     
        <?= $form->field($model, 'twitter')->textInput(['maxlength' => true]) ?>
    </div>

    <div class="col-md-6 col-xs-12">     
        <?= $form->field($model, 'web')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-md-6 col-xs-12">     
        <?= $form->field($model, 'ferias')->checkboxList($feriasModel, [

                'separator' => '<br>',

                'itemOptions' => [

                'class' => 'feria'

                ]

                ])->label('Ferias en que Participa');

        ?>
    </div>

    <div class="col-md-6 col-xs-12">     
        <?= $form->field($model, 'imagen')->widget(FileInput::classname(), [
        'options' => ['accept' => 'image/*'],
        ]);?>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
<?php
$options = [
    'urlBase' => \yii\helpers\BaseUrl::base(),
];
$this->registerJs(
    "const urls = " . \yii\helpers\Json::htmlEncode($options) . ";",
    \yii\web\View::POS_HEAD,
    'yiiOptions'
);

$this->registerJs("
// No mas enter para submit
    $('#resolver').on('keyup keypress', function(e) {
        var keyCode = e.keyCode;
        if (keyCode === 13) {
        e.preventDefault();
        }
    });

")

?>


</div>
