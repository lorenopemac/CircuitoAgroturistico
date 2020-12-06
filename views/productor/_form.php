<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\grid\GridView;
use kartik\select2\Select2;
use kartik\file\FileInput;
use kartik\grid\EditableColumnAction;
use kartik\markdown\MarkdownEditor;

/* @var $this yii\web\View */
/* @var $model app\models\Productor */
/* @var $form yii\widgets\ActiveForm */
?>

<style>

table{
  border: 0,5px solid black;
  width: 100%;
}

tr,th, td {
    border: 1px solid black;
}
div.feria{
    overflow: auto;
    max-height: 250px;
}

hr {
  border: 0;
  clear:both;
  display:block;
  width: 98%;               
  background-color: lightgrey;
  height: 3px;
}


</style>
<div class="productor-form">

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
    
    <div class="col-md-6 col-xs-12">     
        <?= $form->field($model, 'nombreApellido')->textInput() ?>
    </div>
    <div class="col-md-6 col-xs-12">     
        <?= $form->field($model, 'nombreFantasia')->textInput() ?>
    </div>
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
    <div class="col-md-6 col-xs-12">     
        <?= $form->field($model, 'numeroTelefono')->textInput() ?>
    </div>
    
    <div class="col-md-6 col-xs-12 feria">     
        <?= $form->field($model, 'ferias')->checkboxList($feriasModel, [
                'separator' => '<br>',
                'itemOptions' => [
                'class' => 'feria'
                ]
                ])->label('Ferias en que Participa');

        ?>
    </div>

    <hr>

    <div class="col-md-12 col-xs-12" id='editor-en' name='editor-en'>     
        <?= $form->field($model, 'descripcion')->widget(
            MarkdownEditor::classname(), 
            ['height' => 300, 'encodeLabels' => false, 'language'=> 'ru']
        );?>
    </div>

    <hr>

    <div class="col-md-12 col-xs-12">           
        <?= $form->field($model, 'mediospago')->checkboxList($medioPagoModel, [
                'separator' => '<br>',
                'itemOptions' => [
                'class' => 'mediopago'
                ]
                ])->label('Medios de pago que acepta el productor:');

        ?>
    </div>

    <hr>

    <div class="col-md-12 col-xs-12">     
        <?php if(!$vista){ ?>
            <?= $form->field($model, 'imagenes[]')->widget(FileInput::classname(), [
                'options' => ['multiple' => true, 'class' => 'fileInputClass'],
                'pluginOptions' => [
                    'previewFileType' => 'any', 
                    'maxFileCount'=>10,
                    'showRemove' => true,
                    'showCaption'=> false,
                    'showRemove' => true,
                    
                    'showUpload'=> false,
                    'deleteUrl' => Url::to(''),
                    ]
                ]);
            ?>
        <?php }else{ ?>
            <?= $form->field($model, 'imagenes[]')->widget(FileInput::classname(), [
                'options' => ['multiple' => true, 'class' => 'fileInputClass'],
                'pluginOptions' => [
                    'initialPreview'=>$model->imagenes,
                    'initialPreviewConfig' => $initialPreviewConfig,
                    'previewFileType' => 'any', 
                    'maxFileCount'=>10,
                    'showRemove' => true,
                    'showCaption'=> false,
                    'showRemove'=> false,
                    'deleteUrl' => Url::to('eliminarimagen'),
                    'showUpload'=> false]
                ]);
            ?>
        <?php } ?>
    </div>

    <hr>
    
    <div class="col-md-12 col-xs-12">  
        <?php if(!$vista){ ?>
            <?=  GridView::widget([
                'dataProvider' => $dataProviderRedes,
                'columns' => [
                    'nombre',

                    [	'attribute' => 'asignacion', 
                            'label'  => 'Dirección',
                            'content'  => function($data){
                                            return Html::a(
                                                '<div id="'.$data['idRed_social'].'">
                                                    <input class="renombrar" id="'.$data['idRed_social'].'"  type="text"/>', 
                                                null, 
                                                ['title' => 'Modificar',]).
                                                "</div>";
                                        }
                        ],
                    
                ],
            ]); ?>
        <?php }else{ ?>
            <?=  GridView::widget([
                'dataProvider' => $dataProviderRedes,
                'columns' => [
                    'redSocial.nombre',

                    [	'attribute' => 'direccion', 
                            'label'  => 'Dirección',
                            'content'  => function($data){
                                            return Html::a(
                                                '<div id="'.$data['idRed_social'].'">
                                                    <input class="renombrar" id="'.$data['idRed_social'].'"  type="text" value="'.$data['direccion'].'"/>', 
                                                null, 
                                                ['title' => 'Modificar',]).
                                                "</div>";
                                        }
                        ],
                    
                ],
            ]); ?>
        <?php } ?>
    </div>

    <hr>
    
    <div class="col-md-6 col-xs-12" >     
        <?= $form->field($model, 'latitud')->textInput(['maxlength' => true]) ?>
    </div>

    <div class="col-md-6 col-xs-12" >     
        <?= $form->field($model, 'longitud')->textInput(['maxlength' => true]) ?>
    </div>
    <div class="form-group col-md-12 col-xs-12">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success','name' =>'idProductor','value' => $idProductor]) ?>
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
$urlGuardarRed = Url::to(['productor/guardarred']);
$validar = false;
$this->registerJs("
var validar= false;

$('.renombrar').on('blur', function(e){
    if(!validar){// PARA QUE NO REALICEN MULTIPLES LLAMADAS
        validar=true;
        var fila = $(this).closest('tr');
        if(e.type === 'blur' ) {
            //LLAMADA AJAX ACA
            var idRedSocial = this.id;
            var direccion  = $(this).closest('input').eq(0).val();
            var idProductor = '$model->idProductor';
            $.ajax({
                url: '$urlGuardarRed',
                type: 'post',
                data: {
                'idRed' : idRedSocial,
                'direccion' : direccion,
                'idProductor' : idProductor
                },
                success: function(res){
                    //console.log(res.exito);
                    validar= false;
                }
            })
        }
    }
});

const fileInput = $('.file-input');

fileInput.on('filebeforedelete', handleRemovedFile);

/**
 * Cuando se elimina el archivo dentro del input
 * se borra la tabla y se esconde el boton
*/
function handleRemovedFile(event, id, index)
{
    
}

");
?>


</div>
