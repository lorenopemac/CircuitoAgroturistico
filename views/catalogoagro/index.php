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
    .en-linea {
        display: flex;
        justify-content: left;
        align-items: left;
        flex-wrap: wrap;
        text-align: left;
        border: 0px solid black;
    }
    .categorias { float: initial; width:100%;}
    hr {
            border: 0;
            clear:both;
            display:block;
            width: 90%;               
            background-color: white;
            height: 1px;
            margin-top: 1px;
            margin-bottom: 1px;
        }

        .producto {
            border: 2px outset rgba(28,110,164,0.11);
            border-radius: 6px;
        }
        .card {
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
        max-width: 300px;
        margin: auto;
        text-align: center;
        font-family: arial;
        margin-top: 10.5px;
        }

        .price {
        color: grey;
        font-size: 22px;
        }

        .card button {
        border: none;
        outline: 0;
        padding: 12px;
        color: white;
        background-color: #4CAF50;
        text-align: center;
        cursor: pointer;
        width: 100%;
        font-size: 18px;
        }

        .card button:hover {
        opacity: 0.7;
        }
        .file-preview-image{
            height: 250px;
            width: 100%;
        }
</style>
    
<div class="categoria-index" >
<?php \yii\widgets\Pjax::begin();?>

<div  style=" box-sizing: border-box; display: flex; place-content: stretch ;">
        <div  class="" id="filtros" style="flex: 1 1 100%; box-sizing: border-box; max-width: 20%; background: #d8dde6 ;"> 
            <div class="col-md-3"style=" width: 100%; padding-left:20%;">
                <div  class="titulo"><h3><u>Categoría</u></h3></div>
                <div class=" categorias">
                    <?php foreach($categorias as $categoria):?>        
                        <label><input type="radio" class="categoria" name="categoria" id=<?= $categoria->idCategoria ?>> <?= $categoria->nombre ?> </label>
                        <hr>
                    <?php endforeach; ?>
                </div>
                <div  class="titulo"><h3><u>Feria</u></h3></div>
                <div class="ferias">
                    <?php foreach($ferias as $feria):?>        
                        <label><input type="radio" class="feria" name="feria" id=<?= $feria->idFeria ?>> <?= $feria->nombre ?> </label>
                        <hr>
                    <?php endforeach; ?>
                </div>
                <div  class="titulo"><h3><u>Localidad</u></h3></div>
                <div class="localidad">
                    <?php foreach($localidades as $localidad):?>        
                        <label><input type="radio" class="localidad" name="localidad" id=<?= $localidad->idLocalidad ?>> <?= $localidad->nombre ?> </label>
                        <hr>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <div  class="col-md-9" >
            
            <div class="productos">
                <?php foreach($productos as $producto):?>
                    <div class="col-lg-4 card">
                        <?= $producto->imagenes[0] ?>  

                        <p></p><h4 style="text-align:center"><b> <?= $producto->nombre ?></b> </h4><p></p>

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
$urlFiltrarLocalidad = '../../aplicacion/CircuitoAgroturistico/web/catalogoagro/filtrolocalidad';
$urlFiltrarCategoria = '../../aplicacion/CircuitoAgroturistico/web/catalogoagro/filtrocategoria';
$urlFiltrarFeria = '../../aplicacion/CircuitoAgroturistico/web/catalogoagro/filtroferia';
$urlProducto = Url::to(['producto/view']);
$validar = false;
$this->registerJs("

$('.categoria').click(function(e){
    if(this.id > 0){// PARA QUE NO REALICEN MULTIPLES LLAMADAS
        direccion = '$url';
        $.ajax({
            url: '$urlFiltrarCategoria',
            type: 'get',
            data: {
            'idCategoria' : this.id,
            },
            success: function(res){
                console.log(res.productos[0]);
                $( '.col-lg-4' ).remove();
                var tamaño = Object.keys(res.productos).length;
                
                for (var indice = 0; indice < tamaño; indice++) {
                $( '.productos' ).append('<div class=\'col-lg-4 card \' ><p></p><h4 style=text-align:center>'+ \n
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
            type: 'get',
            data: {
            'idFeria' : this.id,
            },
            success: function(res){
                $( '.col-lg-4' ).remove();
                var tamaño = Object.keys(res.productos).length;
                
                for (var indice = 0; indice < tamaño; indice++) {
                $( '.productos' ).append('<div class=\'col-lg-4 card \' ><p></p><h4 style=text-align:center>'+ \n
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
            type: 'get',
            data: {
            'idLocalidad' : this.id,
            },
            success: function(res){
                $( '.col-lg-4' ).remove();
                var tamaño = Object.keys(res.productos).length;
                
                for (var indice = 0; indice < tamaño; indice++) {
                $( '.productos' ).append('<div class=\'col-lg-4 card \' ><p></p><h4 style=text-align:center>'+ \n
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
