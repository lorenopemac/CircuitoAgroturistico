<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Producto */

$this->title = 'Modificación de Producto ' ;
$this->params['breadcrumbs'][] = ['label' => 'Productos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nombre, 'url' => ['view', 'id' => $model->idProducto]];
$this->params['breadcrumbs'][] = 'Modificar';
?>
<div class="producto-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'productoresModel' => $productoresModel,
        'categoriasModel' => $categoriasModel,
        'vista'=>$vista,
        'initialPreviewConfig' => $initialPreviewConfig,                
    ]) ?>

</div>
