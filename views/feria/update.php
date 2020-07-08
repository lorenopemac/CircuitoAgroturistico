<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Feria */

$this->title = 'Update Feria: ' . $model->idFeria;
$this->params['breadcrumbs'][] = ['label' => 'Ferias', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idFeria, 'url' => ['view', 'id' => $model->idFeria]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="feria-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
