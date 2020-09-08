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

<div class="categoria-index" >
<?php \yii\widgets\Pjax::begin();?>


<div class="mb-2" fxlayout="row" fxlayout.lt-md="column" fxlayoutalign="space-between start" fxlayoutalign.lt-md="start center" style="flex-direction: row; box-sizing: border-box; display: flex; place-content: flex-start space-between; align-items: flex-start;">
    <div fxlayout="row wrap" fxlayoutalign="center strech" class="ng-star-inserted" style="flex-flow: row wrap; box-sizing: border-box; display: flex; place-content: stretch center; align-items: stretch;">
        <div  class="col-lg-3 jumbotron" fxflex.gt-sm="20"  id="filtros" style="flex: 1 1 100%; box-sizing: border-box; max-width: 20%; background: #d8dde6 ;"> 
            <div style=" width: 100%;">
                <div  class="titulo"><h3>Categorías</h3></div>
                <div class="categorias">
                    <?php foreach($categorias as $categoria):?>        
                        <label><input type="radio" class="categoria" name="categoria" id=<?= $categoria->idCategoria ?>> <?= $categoria->nombre ?> </label>
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
                        
                        <p style="text-align:center"><?= Html::a('Ver más', ['/producto/view','id'=>$producto->idProducto], ['class'=>'btn btn-success']) ?></p>
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


$urlFiltrarCategoria = Url::to(['catalogo/filtrocategoria']);
$validar = false;
$this->registerJs("
$('.categoria').click(function(e){
    if(this.id > 0){// PARA QUE NO REALICEN MULTIPLES LLAMADAS
        $.ajax({
            url: '$urlFiltrarCategoria',
            type: 'post',
            data: {
            'idCategoria' : this.id,
            },
            success: function(res){
                console.log(res.productos[0]);
                $( '.producto' ).empty();
                var tamaño = Object.keys(res.productos).length;
                
                for (var indice = 0; indice < tamaño; indice++) {
                    $( '.productos' ).append('<div class=col-lg-4 producto><p></p><h4 style=text-align:center>'+res.productos[indice]['nombre']+'</h4><p></p><p style=text-align:center>'+res.productos[indice]['descripcion']+'</p><p style=text-align:center>'+<?= Html::a(+'Ver más'+, [+'/producto/view'+,+'id'+=>'+res.productos[indice]['idProducto']+'], ['class'=>'btn btn-success']) ?></p>');
                }
                

            }
        })
    }
});


");
?>
