<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RedsocialProductor */

$this->title = 'Create Redsocial Productor';
$this->params['breadcrumbs'][] = ['label' => 'Redsocial Productors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="redsocial-productor-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
