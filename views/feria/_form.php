<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\file\FileInput;
use yii\helpers\Url;
use yii\grid\GridView;
/* @var $this yii\web\View */
/* @var $model app\models\Feria */
/* @var $form yii\widgets\ActiveForm */
?>

<style>
hr {
  border: 0;
  clear:both;
  display:block;
  width: 98%;               
  background-color: lightgrey;
  height: 3px;
}
</style>

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

    <hr>

    <div class="col-md-12 col-xs-12">         
        <?php if(!$vista){ ?>
            <?= $form->field($model, 'imagenes[]')->widget(FileInput::classname(), [
                'options' => ['multiple' => true],
                'pluginOptions' => [
                    'previewFileType' => 'any', 
                    'maxFileCount'=>10,
                    'showRemove' => true,
                    'showCaption'=> false,
                    'showRemove'=> true,
                    'showUpload'=> false]
                ]);
            ?>
        <?php }else{ ?>
            <?= $form->field($model, 'imagenes[]')->widget(FileInput::classname(), [
          
      'options' => ['multiple' => true],
                'pluginOptions' => [
                    'initialPreview'=>$model->imagenes,
                    'initialPreviewConfig' => $initialPreviewConfig,
                    'previewFileType' => 'any', 
                    'maxFileCount'=>10,
                    'showRemove' => true,
                    'showCaption'=> false,
                    'showRemove'=> true,
                    'showUpload'=> false,
                    'deleteUrl' => Url::to('eliminarimagen'),
                    ]
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
    <div class="form-group">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success','name' =>'idFeria','value' => $idFeria]) ?>
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
$urlGuardarRed = Url::to(['feria/guardarred']);
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
            var idFeria = '$model->idFeria';
            $.ajax({
                url: '$urlGuardarRed',
                type: 'post',
                data: {
                'idRed' : idRedSocial,
                'direccion' : direccion,
                'idFeria' : idFeria
                },
                success: function(res){
                    //console.log(res.exito);
                    validar= false;
                }
            })
        }
    }
});

$('.file-preview').on('click', function() {
    console.log('File deletion was successful! ' );
});    

");
?>

</div>
