<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
/* @var $this yii\web\View */
/* @var $model app\models\Producto */

\yii\web\YiiAsset::register($this);
?>

<style>
    .card {
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
        margin: auto;
        text-align: center;
        font-family: arial;
        margin-top: 1.5px;
        height: 380px;
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
        height: 320px;
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
        <div class="col-md-6 col-xs-12 card">     
            
        <ul class="list-unstyled">
            <h2><?= $model->nombre ?></h2>
            <hr>
            <li><h4> <strong>Descripción: </strong>&nbsp;    <?= $model->descripcion ?> </h4></li>
            <hr>
            <li><h4><strong>Productor</strong>&nbsp;&nbsp;&nbsp;   <?= $model->productor->nombre ?> </h4></li>
        </ul>
        </div>
    </div>        
    <div class="col-md-12 col-xs-12">     
        <div class="col-md-12 col-xs-12">   
                <h2>Sobre el Productor</h2>
        </div>
        <div class="col-md-6 col-xs-12 card">  
            <?= DetailView::widget([
                'model' => $modelProductor,
                'attributes' => [
                    'nombre',
                    'provincia.nombre',
                    'localidad.nombre',
                    'nombreCalle',
                    'numeroCalle',
                    'numeroTelefono',
                ],
            ]) ?>
        </div>
        <div class="col-md-6 col-xs-12 card">  
            <?=  GridView::widget([
                'dataProvider' => $providerProductor,
                'columns' => [
                    
                    ['attribute'=>'Red Social',
                    'value'=> 'redSocial.nombre'],
                    ['attribute'=>'Link',
                    'value'=> 'direccion'],
                ],
            ]); ?>
        </div>
    </div>      
</div>

<script>
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
  setTimeout(showSlides, 2500); // Change image every 2 seconds
}
</script>