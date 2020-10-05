<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\MedioPago */

$this->title = 'Update Medio Pago: ' . $model->idMedio_pago;
$this->params['breadcrumbs'][] = ['label' => 'Medio Pagos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->idMedio_pago, 'url' => ['view', 'id' => $model->idMedio_pago]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="medio-pago-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
