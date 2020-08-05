<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Feria */

$this->title = 'Modificar Feria ';
$this->params['breadcrumbs'][] = ['label' => 'Feria', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nombre, 'url' => ['view', 'id' => $model->idFeria]];
$this->params['breadcrumbs'][] = 'Modificar';
?>
<div class="feria-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'localidadesModel' => $localidadesModel,
        'vista' => $vista,
    ]) ?>

</div>
