<?php
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use kartik\markdown\MarkdownEditor;

/* @var $this yii\web\View */
/* @var $model app\models\Producto */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="producto-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="col-md-12 col-xs-12">     
        <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="col-md-12 col-xs-12" id='editor-en' name='editor-en'>     
        <?= $form->field($model, 'descripcion')->widget(
            MarkdownEditor::classname(), 
            ['height' => 300, 'encodeLabels' => false, 'language'=> 'ru']
        );?>
    </div>
    <div class="col-md-12 col-xs-12">     
        <?=  $form->field($model, 'idProductor')->widget(Select2::classname(), [
            'data' => $productoresModel,
            'options' => ['placeholder' => 'Seleccione un Productor'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ])  ?>
    </div>
    <div class="col-md-12 col-xs-12">     
        <?= $form->field($model, 'categorias')->checkboxList($categoriasModel, [
                'separator' => '<br>',
                'itemOptions' => [
                'class' => 'clasificador'
                ]

                ])->label('Categorias del Prodcuto');

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
                    'showRemove' => true,
                    'showUpload'=> false,
                    //'deleteUrl' => Url::to('<url>'),
                    ]
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
                    'showRemove'=> true,
                    
                    'showUpload'=> false]
                ]);
            ?>
        <?php } ?>
    </div>
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