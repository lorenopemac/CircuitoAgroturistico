<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RedsocialProductor */

$this->title = 'Update Redsocial Productor: ' . $model->idRedsocial_Productor;
$this->params['breadcrumbs'][] = ['label' => 'Redsocial Productors', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idRedsocial_Productor, 'url' => ['view', 'id' => $model->idRedsocial_Productor]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="redsocial-productor-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
