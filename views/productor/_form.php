<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\grid\GridView;
use kartik\select2\Select2;
use kartik\file\FileInput;
use kartik\grid\EditableColumnAction;
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
</style>
<div class="productor-form">

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
    
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
    
    <div class="col-md-6 col-xs-12">     
        <?= $form->field($model, 'ferias')->checkboxList($feriasModel, [
                'separator' => '<br>',
                'itemOptions' => [
                'class' => 'feria'
                ]

                ])->label('Ferias en que Participa');

        ?>
    </div>

                    

    <div class="col-md-12 col-xs-12">     
        <?= $form->field($model, 'imagenes[]')->widget(FileInput::classname(), [
            'options' => ['multiple' => true],
            'pluginOptions' => [
                'initialPreview'=>[$model->imagenes],
                'previewFileType' => 'any', 
                'maxFileCount'=>10,
                'showCaption'=> false,
                'showRemove'=> false,
                
                'showUpload'=> false]
            ]);
        ?>
    </div>
    
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
              <img src="<?php '@app/uploads/2.jpg'; ?>">
        <?php } ?>
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
$urlGuardarRed = Url::to(['productor/guardarred']);
$validar = false;
$this->registerJs("
var validar= false;
/*$('.renombrar').click(function(e){
    
    //var value = this.id;
    //var t = $.trim($('#'+value+'nom').html());
    var fila = $(this).closest('tr');
    //console.log( fila.find('td:eq(2)').text() );
    $(this).closest('div').attr('contenteditable','true'); //lo hace editable
    
    //console.log( $(this).closest('div').value() );
    //console.log($('#'+this.id).html());
}); */


$('.renombrar').on('blur', function(e){
    
    
    if(!validar){// PARA QUE NO REALICEN MULTIPLES LLAMADAS
        //console.log($(this).closest('.productor-form').find('input').find(this.id)[0]); 
        //console.log($(this).next('input').find(this.id));
        console.log(($(this).closest('input')).eq(0).val());
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
$( 'document' ).ready(function() {
    console.log( 'ready!' );
});

");

?>


</div>
