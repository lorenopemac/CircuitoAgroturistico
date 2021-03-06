<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Localidad */

$this->title = 'Modificar Localidad ';
$this->params['breadcrumbs'][] = ['label' => 'Localidad', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nombre, 'url' => ['view', 'id' => $model->idLocalidad]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="localidad-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'provinciasModel' => $provinciasModel,
    ]) ?>

</div>
