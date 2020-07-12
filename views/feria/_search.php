<?php

use yii\helpers\Html;
use kartik\select2\Select2;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\FeriaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="feria-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    
    <div class="col-md-6 col-xs-12">        
      <?= $form->field($model, 'nombre') ?>
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

    <div class="form-group col-md-12 col-xs-12">
        <?= Html::submitButton('Buscar', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Cancelar', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
