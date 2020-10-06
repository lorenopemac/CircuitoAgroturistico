<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Productor */

$this->title = 'Crear Productor';
$this->params['breadcrumbs'][] = ['label' => 'Productor', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['breadcrumbs'][] = 'Crear';
?>
<div class="productor-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'provinciasModel' => $provinciasModel,
        'localidadesModel' => $localidadesModel,
        'feriasModel' => $feriasModel,
        'dataProviderRedes'=>$dataProviderRedes,
        'vista'=>$vista,
        'idProductor' => $idProductor, 
        'medioPagoModel' => $medioPagoModel,    
    ]) ?>

</div>
