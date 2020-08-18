<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Productor */

$this->title = 'Modificar Productor: ' . $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Productores', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nombre, 'url' => ['view', 'id' => $model->nombre]];
$this->params['breadcrumbs'][] = 'Modificar';
?>
<div class="productor-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'provinciasModel' => $provinciasModel,
        'localidadesModel' => $localidadesModel,
        'feriasModel' => $feriasModel,
        'dataProviderRedes'=>$dataProviderRedes,
        'vista'=>$vista,
        'idProductor' =>$idProductor,        
        'initialPreviewConfig' => $initialPreviewConfig,                    
    ]) ?>

</div>
