<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use dosamigos\leaflet\types\LatLng;
use dosamigos\leaflet\layers\Marker;
use dosamigos\leaflet\layers\TileLayer;
use dosamigos\leaflet\LeafLet;
use dosamigos\leaflet\widgets\Map;  

\yii\web\YiiAsset::register($this);


/**
 * Creación de marcadores del mapa y de las capa del mismo
 * recorriendo cada feria que se mostrara en el mapa
 */
$markers = [];
foreach ($ferias as $feria) {
    if(!is_null($feria['latitud'])){
        $centerMarker = new LatLng(['lat' => $feria['latitud'], 'lng' => $feria['longitud']]);
        // now lets create a marker that we are going to place on our map
        $descripcion = 'Feria : '.$feria['nombre'];
        $marker = new Marker(['latLng' => $centerMarker, 'popupContent' => $descripcion
        ]);
        $markers[] = $marker; // add the marker (addLayer is used to add different layers to our map)
    }
}
$center = new LatLng(['lat' => '-38.930277', 'lng' => '-68.245006']);// centro del mapa
$tileLayer = new TileLayer([
    'urlTemplate' => 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
    'clientOptions' => [
        'attribution' => '' .
        'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>',
    //'subdomains' => 'nix'
    ]
]);
/**
 * Fin Creación de marcadores del mapa y de las capa del mismo
*/

?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
    .card {
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
        margin: auto;
        font-family: arial;
        margin-top: 1.5px;
        height: 420px;
        
    }

    hr {
        border: 0;
        clear:both;
        display:block;
        width: 98%;               
        background-color: lightgrey;
        height: 3px;
        }

        .file-preview-image{
            height: 300px;
            width: 100%;
        }

        * {box-sizing: border-box;}
    body {font-family: Verdana, sans-serif;}
    .mySlides {display: none;}
    img {vertical-align: middle;}

    /* Slideshow container */
    .slideshow-container {
    max-width: 1000px;
    position: relative;
    margin: auto;
    }

    /* Caption text */
    .text {
    color: #f2f2f2;
    font-size: 15px;
    padding: 8px 12px;
    position: absolute;
    bottom: 8px;
    width: 100%;
    text-align: center;
    }

    /* Number text (1/3 etc) */
    .numbertext {
    color: #f2f2f2;
    font-size: 12px;
    padding: 8px 12px;
    position: absolute;
    top: 0;
    }

    /* The dots/bullets/indicators */
    .dot {
    height: 25px;
    width: 25px;
    margin: 0 2px;
    background-color: #bbb;
    border-radius: 50%;
    display: inline-block;
    transition: background-color 0.6s ease;
    }

    .active {
    background-color: #717171;
    }

    /* Fading animation */
    .fade {
    -webkit-animation-name: fade;
    -webkit-animation-duration: 1.5s;
    animation-name: fade;
    animation-duration: 1.5s;
    }

    @-webkit-keyframes fade {
    from {opacity: .4} 
    to {opacity: 1}
    }

    @keyframes fade {
    from {opacity: .4} 
    to {opacity: 1}
    }

    /* On smaller screens, decrease text size */
    @media only screen and (max-width: 100%) {
    .text {font-size: 11px}
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
<div class="producto-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="col-md-12 col-xs-12" style="padding-bottom: 25px;">     
        <div class="col-md-6 col-xs-12 card">     

        <div class="slideshow-container">

        <div class="mySlides fade">
        <div class="numbertext">1 / 3</div>
        <?php if(sizeof($model->imagenes)>0){ ?>
            <?= $model->imagenes[0]?>
        <?php }else{?>
            <?= Html::img(Yii::getAlias('@web')."/uploads/default.png",['class'=>'file-preview-image','width' => '100%','max-height' => '100px']);?>
        <?php }?>
        </div>

        <div class="mySlides fade">
        <div class="numbertext">2 / 3</div>
        <?php if(sizeof($model->imagenes)>1){ ?>
            <?= $model->imagenes[1]?>
        <?php }else{?>
            <?= Html::img(Yii::getAlias('@web')."/uploads/default.png",['class'=>'file-preview-image','width' => '100%','max-height' => '100px']);?>
        <?php }?>
        </div>

        <div class="mySlides fade">
        <div class="numbertext">3 / 3</div>
        <?php if(sizeof($model->imagenes)>2){ ?>
            <?= $model->imagenes[2]?>
        <?php }else{?>
            <?= Html::img(Yii::getAlias('@web')."/uploads/default.png",['class'=>'file-preview-image','width' => '100%','max-height' => '100px']);?>
        <?php }?>
        </div>

        </div>
        <br>

        <div style="text-align:center">
        <span class="dot"></span> 
        <span class="dot"></span> 
        <span class="dot"></span> 
        </div>
            
    </div>
    <!-- Medios de pago -->
        <div class="col-md-6 col-xs-12 card">     
            
        <ul class="list-unstyled">
            <h2 style="text-align: center;"><?= $model->nombre ?></h2>
            <hr>
            <li><h4 > <?= $model->descripcion ?> </h4></li>
            <hr>
            <li><h4><strong>Productor</strong>&nbsp;&nbsp;&nbsp;   <?= $model->productor->nombreFantasia ?> </h4></li>
            <hr>
            <li>
                <h4><strong>Medios de Pago: </strong></h4>
                <?php foreach($imagenesPago as $imagen):?>        
                    <?= $imagen ?>
                <?php endforeach; ?>

            </li>
        </ul>
        </div>
    </div>        
    <!-- Información del productor -->
    <div class="col-md-12 col-xs-12">     
        <div class="col-md-12 col-xs-12">   
                <h2>Sobre el Productor</h2>
        </div>
        <div class="col-md-6 col-xs-12 card">  
            <ul class="list-unstyled">
                <h2><?= $modelProductor->nombreFantasia ?></h2>
                <hr>
                <li><h4><strong>Localidad: </strong>&nbsp;&nbsp;&nbsp;   <?= $modelProductor->localidad->nombre ?> </h4></li>
                <hr>
                <li><h4><strong>Telefono: </strong>&nbsp;&nbsp;&nbsp;   <?= $modelProductor->numeroTelefono ?> </h4></li>
                <hr>
                <li><h4><strong>Dirección: </strong>&nbsp;&nbsp;&nbsp;   <?= $modelProductor->nombreCalle?>  al <?= $modelProductor->numeroCalle?> </h4></li>
            </ul>
            <hr>
            <h4> <strong>Redes Sociales: </strong>&nbsp;  </h4>
            <?php if(array_key_exists('facebook',$redesSociales)){ ?>
                <a href=<?= $redesSociales['facebook']?>  target="_blank" class="fa fa-facebook" style="margin-left:150px;"></a>
            <?php } ?>
            <?php if(array_key_exists('twitter',$redesSociales)){ ?>
                <a href=<?= $redesSociales['twitter']?>  target="_blank" class="fa fa-twitter"></a>
            <?php } ?>
            <?php if(array_key_exists('instagram',$redesSociales)){ ?>
                <a href=<?= $redesSociales['instagram']?>  target="_blank" class="fa fa-instagram"></a>
            <?php } ?>
            <?php if(array_key_exists('youtube',$redesSociales)){ ?>
                <a href=<?= $redesSociales['youtube']?>  target="_blank" class="fa fa-youtube"></a>
            <?php } ?>

        </div>
        <!--Mapa de ferias del productor -->
        <div class="col-md-6 col-xs-12 card">  
            <h4><strong>Ferias: </strong></>
            <?php 
                if (count($markers) > 0) {
                $leaflet = new LeafLet([
                    'tileLayer' => $tileLayer, // set the TileLayer
                    'center' => $center, // set the center
                    'zoom'=>10,
                ]);

                foreach ($markers as $marker) {
                    $leaflet->addLayer($marker);
                }
                echo Map::widget(['leafLet' => $leaflet,'options' => ['style' => 'min-height: 380px']]);
                } else{
                    echo 'El Productor no participa en ferias actualmente';
                }
            ?>
        </div>
    </div>      
</div>
<div class="clearfix"></div>


<script>
/**
*   Slide de imagenes - Carousel
*/
var slideIndex = 0;
showSlides();

function showSlides() {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";  
  }
  slideIndex++;
  if (slideIndex > slides.length) {slideIndex = 1}    
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " active";
  setTimeout(showSlides, 3200); // Change image every 2 seconds
}
</script>

