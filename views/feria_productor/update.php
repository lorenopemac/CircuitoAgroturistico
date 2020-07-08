<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\FeriaProductor */

$this->title = 'Update Feria Productor: ' . $model->idFeria_productor;
$this->params['breadcrumbs'][] = ['label' => 'Feria Productors', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idFeria_productor, 'url' => ['view', 'id' => $model->idFeria_productor]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="feria-productor-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
