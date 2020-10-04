<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use kartik\select2\Select2;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ProductorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>
<style>
    .button1 {background-color: #4CAF50;} /* Green */

</style>
    
<div class="categoria-index" >
<?php \yii\widgets\Pjax::begin();?>

<div class="mb-2" fxlayout="row" fxlayout.lt-md="column" fxlayoutalign="space-between start" fxlayoutalign.lt-md="start" style="flex-direction: row; box-sizing: border-box; display: flex; place-content: flex-start space-between; align-items: flex-start;">
    <div fxlayout="row wrap" fxlayoutalign="center strech" class="ng-star-inserted" style="flex-flow: row wrap; box-sizing: border-box; display: flex; place-content: stretch ; align-items: stretch;">
        <div  class="col-lg-3 jumbotron" fxflex.gt-sm="20"  id="filtros" style="flex: 1 1 100%; box-sizing: border-box; max-width: 20%; background: #d8dde6 ;"> 
            <div style=" width: 100%;">
                <div  class="titulo"><h3><u>Categoría</u></h3></div>
                <div class="categorias">
                    <?php foreach($categorias as $categoria):?>        
                        <label><input type="radio" class="categoria" name="categoria" id=<?= $categoria->idCategoria ?>> <?= $categoria->nombre ?> </label>
                    <?php endforeach; ?>
                </div>
                <div  class="titulo"><h3><u>Feria</u></h3></div>
                <div class="ferias">
                    <?php foreach($ferias as $feria):?>        
                        <label><input type="radio" class="feria" name="feria" id=<?= $feria->idFeria ?>> <?= $feria->nombre ?> </label>
                    <?php endforeach; ?>
                </div>
                <div  class="titulo"><h3><u>Localidad</u></h3></div>
                <div class="localidad">
                    <?php foreach($localidades as $localidad):?>        
                        <label><input type="radio" class="localidad" name="localidad" id=<?= $localidad->idLocalidad ?>> <?= $localidad->nombre ?> </label>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <div fxlayout="row wrap" fxlayoutalign="center strech" class="col-lg-9 jumbotron" style="flex-flow: row wrap; box-sizing: border-box; display: flex; place-content: stretch center; align-items: stretch; ">
            
            <div class="productos">
                <?php foreach($productos as $producto):?>
                    <div class="col-lg-4 producto">
                        <p></p><h4 style="text-align:center"><?= Html::a(Html::encode($producto->nombre)) ?></h4><p></p>
                        
                        <p style="text-align:center"><?= $producto->imagenes[0] ?>  </p>
                        <!--
                        <p style="text-align:center" ><?= $producto->descripcion ?></p> !-->
                        
                        <p style="text-align:center"><button type="button" class="btn btn-success" id= <?=$producto->idProducto?> >Ver más</button></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<?php Pjax::end(); ?>

</div>
<?php
$options = [
    'urlBase' => \yii\helpers\BaseUrl::base(),
];
$this->registerJs(
    "const urls = " . \yii\helpers\Json::htmlEncode($options) . ";",
    \yii\web\View::POS_HEAD,
    'yiiOptions'
);


$url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";
$urlFiltrarLocalidad = Url::to(['catalogo/filtrolocalidad']);
$urlFiltrarCategoria = Url::to(['catalogo/filtrocategoria']);
$urlFiltrarFeria = Url::to(['catalogo/filtroferia']);
$urlProducto = Url::to(['producto/view']);
$validar = false;
$this->registerJs("

$('.categoria').click(function(e){
    if(this.id > 0){// PARA QUE NO REALICEN MULTIPLES LLAMADAS
        direccion = '$url';
        $.ajax({
            url: '$urlFiltrarCategoria',
            type: 'post',
            data: {
            'idCategoria' : this.id,
            },
            success: function(res){
                console.log(res.productos[0]);
                $( '.col-lg-4' ).remove();
                var tamaño = Object.keys(res.productos).length;
                var clase = 'col-lg-4 producto';
                for (var indice = 0; indice < tamaño; indice++) {
                $( '.productos' ).append('<div class=col-lg-4 ><p></p><h4 style=text-align:center>'+ \n
                res.productos[indice]['nombre']+'</h4><p></p><p style=text-align:center><img class=\'file-preview-image\' src='+direccion+'/aplicacion/CircuitoAgroturistico/web/uploads/'+ res.imagenes[indice] \n
                +' width=200px height=210px > </p><p style=text-align:center> <button type=button  class= \'button1  btn btn-lg btn-success \' id='+ res.productos[indice]['idProducto'] +'>Ver más</button></p>');
                }
                

            }
        })
    }
});



$('.feria').click(function(e){
    if(this.id > 0){// PARA QUE NO REALICEN MULTIPLES LLAMADAS
        direccion = '$url';
        $.ajax({
            url: '$urlFiltrarFeria',
            type: 'post',
            data: {
            'idFeria' : this.id,
            },
            success: function(res){
                $( '.col-lg-4' ).remove();
                var tamaño = Object.keys(res.productos).length;
                var clase = 'col-lg-4 producto';
                for (var indice = 0; indice < tamaño; indice++) {
                $( '.productos' ).append('<div class=col-lg-4 ><p></p><h4 style=text-align:center>'+ \n
                res.productos[indice]['nombre']+'</h4><p></p><p style=text-align:center><img class=\'file-preview-image\' src='+direccion+'/aplicacion/CircuitoAgroturistico/web/uploads/'+ res.imagenes[indice] \n
                +' width=200px height=210px > </p><p style=text-align:center> <button type=button  class= \'button1  btn btn-lg btn-success \' id='+ res.productos[indice]['idProducto'] +'>Ver más</button></p>');
                }
                

            }
        })
    }
});


$('.localidad').click(function(e){
    if(this.id > 0){// PARA QUE NO REALICEN MULTIPLES LLAMADAS
        direccion = '$url';
        $.ajax({
            url: '$urlFiltrarLocalidad',
            type: 'post',
            data: {
            'idLocalidad' : this.id,
            },
            success: function(res){
                $( '.col-lg-4' ).remove();
                var tamaño = Object.keys(res.productos).length;
                var clase = 'col-lg-4 producto';
                for (var indice = 0; indice < tamaño; indice++) {
                $( '.productos' ).append('<div class=col-lg-4 ><p></p><h4 style=text-align:center>'+ \n
                res.productos[indice]['nombre']+'</h4><p></p><p style=text-align:center><img class=\'file-preview-image\' src='+direccion+'/aplicacion/CircuitoAgroturistico/web/uploads/'+ res.imagenes[indice] \n
                +' width=200px height=210px > </p><p style=text-align:center> <button type=button  class= \'button1  btn btn-lg btn-success \' id='+ res.productos[indice]['idProducto'] +'>Ver más</button></p>');
                }
                

            }
        })
    }
});


$( '.productos' ).on('click','.btn', function(){
    console.log('$urlProducto');
    url = '$urlProducto';
    window.location.href = url+'?id='+this.id;
    
    //var url = '+.Url::toRoute('default/over-write?id=');

  });

");
?>
