<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Productor */

$this->title = 'Update Productor: ' . $model->idProductor;
$this->params['breadcrumbs'][] = ['label' => 'Productors', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idProductor, 'url' => ['view', 'id' => $model->idProductor]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="productor-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
