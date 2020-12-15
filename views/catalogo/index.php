<?php
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use kartik\select2\Select2;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use dosamigos\leaflet\types\LatLng;
use dosamigos\leaflet\layers\Marker;
use dosamigos\leaflet\layers\TileLayer;
use dosamigos\leaflet\LeafLet;
use dosamigos\leaflet\widgets\Map;  
/* @var $this yii\web\View */
/* @var $searchModel app\models\ProductorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
\yii\web\YiiAsset::register($this);

?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
   integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
   crossorigin=""/>
<style>
    .button1 {background-color: #4CAF50;} /* Green */
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

.modalButton{
    width:100%;
    height: 70px;
}

.cards {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  max-width: 350px;
  margin: auto;
  text-align: center;
  font-family: arial;
  margin-top: 10.5px;
}

.price {
  color: grey;
  font-size: 22px;
}

.cards button {
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

.cards button:hover {
  opacity: 0.7;
}
.file-preview-image{
    height: 300px;
    width: 100%;
}

div.categorias {
    overflow: auto;
    max-height: 800px;
}
div.ferias {
    overflow: auto;
    max-height: 600px;
}

div.localidad{
    overflow: auto;
    max-height: 600px;
}

/* Style all font awesome icons */
.fa {
    padding: 10px;
    font-size: 30px;
    width: 50px;
    height: 50px;
    text-align: center;
    text-decoration: none;
    border-radius: 50%;
    }

    /* Add a hover effect if you want */
    .fa:hover {
    opacity: 0.7;
    }

    /* Set a specific color for each brand */

    /* Facebook */
    .fa-facebook {
    background: #3B5998;
    color: white;
    }

    /* Twitter */
    .fa-twitter {
    background: #55ACEE;
    color: white;
    }

    .fa-instagram {
    background: #E1306C;
    color: white;
    }

    .fa-youtube {
    background: #bb0000;
    color: white;
    }

</style>
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
   integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
   crossorigin=""></script>
   <script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs/dist/tf.min.js"> </script>
   <script type="text/javascript">
      // Notice how this gets configured before we load Font Awesome
      window.FontAwesomeConfig = { autoReplaceSvg: false }
    </script>

<div class="categoria-index" >


<div   >
    <div  style=" box-sizing: border-box; display: flex; place-content: stretch ;">
        <div  class="" id="filtros" style="flex: 1 1 100%; box-sizing: border-box; max-width: 20%; background: #d8dde6 ;"> 
            <div class="col-md-3"style=" width: 100%; padding-left:20%;">
                <div  class="titulo"><h3><u>Categoría</u></h3></div>
                <div class=" categorias">
                    
                    <?php foreach($categorias as $categoria):?>        
                        <label><input type="radio" class=" categoria" name="categoria" id=<?= $categoria->idCategoria ?>> <?= $categoria->nombre ?> </label>
                        <hr>
                    <?php endforeach; ?>
                </div>
                <div  class="titulo"><h3><u>Feria</u></h3></div>
                <div class="ferias">
                    <?php foreach($ferias as $feria):?>        
                        <label><input type="radio" class="  feria" name="feria" id=<?= $feria->idFeria ?>> <?= $feria->nombre ?> </label>
                        <hr>
                    <?php endforeach; ?>
                </div>
                <div  class="titulo"><h3><u>Localidad</u></h3></div>
                <div class="localidad">
                    <?php foreach($localidades as $localidad):?>        
                        <label><input type="radio" class=" localidad" name="localidad" id=<?= $localidad->idLocalidad ?>> <?= $localidad->nombre ?> </label>
                        <hr>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <div  class="col-md-9" >
            
            <div class="productos">
                <?php foreach($productos as $producto):?>
                    <div class="col-lg-4 cards">
                        <?= $producto->imagenes[0] ?>  
                        <p></p>
                        <b> <h4 style="height:50px; text-align:center"><?= $producto->nombre ?></h4></b> 
                        <p style="height:10px"></p>
                        <a class="modalButton btn btn-success" href="<?=Url::to(['producto/view', 'id'=>$producto->idProducto]); ?>"><h3>Ver más</h3></a>
                    </div>
                <?php endforeach; ?>
                <?php 
                    Modal::begin([
                        'header' => 'Ver Producto',
                        'id' => 'modal',
                        'size' => 'modal-lg',
                    ]);
                    echo "<div id='modalContent'></div>";
                    Modal::end();
                ?>
            </div>
        </div>
    </div>
</div>



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

$urlFiltrarLocalidad = '../../aplicacion/CircuitoAgroturisticoTest/web/catalogo/filtrolocalidad';
$urlFiltrarCategoria = '../../aplicacion/CircuitoAgroturisticoTest/web/catalogo/filtrocategoria';
$urlFiltrarFeria = '../../aplicacion/CircuitoAgroturisticoTest/web/catalogo/filtroferia';

$urlProducto = '../../aplicacion/CircuitoAgroturisticoTest/web/producto/view';//Url::to(['producto/view']);
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
                $( '.col-lg-4' ).remove();
                var tamaño = Object.keys(res.productos).length;
                for (var indice = 0; indice < tamaño; indice++) {
                        $( '.productos' ).append('<div class=\'col-lg-4 cards \'><p style=text-align:center><img class=\'file-preview-image\' src='+direccion+'/aplicacion/CircuitoAgroturistico/web/uploads/'+ res.imagenes[indice] \n
                        +' width=200px height=210px > </p><p></p><h4 style= \'height:50px; text-align:center \'>'+  \n
                        res.productos[indice]['nombre']+'</h4><p></p><p style=text-align:center> <modalButton type=button  class= \'modalButton  btn btn-lg btn-success \' href='+direccion+'/aplicacion/CircuitoAgroturistico/web/producto/view?id='+res.productos[indice]['idProducto'] +' id='+ res.productos[indice]['idProducto'] +'>Ver más</button></p>');
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
                    $( '.productos' ).append('<div class=\'col-lg-4 cards \'><p style=text-align:center><img class=\'file-preview-image\' src='+direccion+'/aplicacion/CircuitoAgroturistico/web/uploads/'+ res.imagenes[indice] \n
                    +' width=200px height=210px > </p><p></p><h4 style= \'height:50px; text-align:center \'>'+  \n
                    res.productos[indice]['nombre']+'</h4><p></p><p style=text-align:center> <button type=button  class= \'modalButton  btn btn-lg btn-success \' id='+ res.productos[indice]['idProducto'] +'>Ver más</button></p>');
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
                    $( '.productos' ).append('<div class=\'col-lg-4 cards \'><p style=text-align:center><img class=\'file-preview-image\' src='+direccion+'/aplicacion/CircuitoAgroturistico/web/uploads/'+ res.imagenes[indice] \n
                    +' width=200px height=210px > </p><p></p><h4 style= \'height:50px; text-align:center \'>'+ \n
                    res.productos[indice]['nombre']+'</h4><p></p><p style=text-align:center> <button type=button  class= \'modalButton  btn btn-lg btn-success \' id='+ res.productos[indice]['idProducto'] +'>Ver más</button></p>');
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

$('.modalButton').click(function (){
    $.get($(this).attr('href'), function(data) {
        $('#modal').modal('show').find('#modalContent').html(data);
        

    });
    return false;
});

$('#modal').on('shown.bs.modal', function(event) {
    window.dispatchEvent(new Event('resize'));
});
    
");
?>
