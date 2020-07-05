<?php
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Producto */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="producto-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model,'descripcion')->textInput(['style'=>'width:100%;height: 50px;']);?>

    <?=  $form->field($model, 'idProductor')->widget(Select2::classname(), [
        'data' => $productoresModel,
        'options' => ['placeholder' => 'Seleccione un Productor'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])  ?>

    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
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