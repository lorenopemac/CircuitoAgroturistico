<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Producto */

$this->title = 'Agregar Producto';
$this->params['breadcrumbs'][] = ['label' => 'Producto', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="producto-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'productoresModel' => $productoresModel,
        'categoriasModel' => $categoriasModel,
        'vista'=>$vista,
    ]) ?>

</div>
