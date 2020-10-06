<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\MedioPago */

$this->params['breadcrumbs'][] = ['label' => 'Medio Pagos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="medio-pago-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'nombre',
            'baja:boolean',
        ],
    ]) ?>


    <p>
        <?= Html::a('Editar', ['update', 'id' => $model->idMedio_pago], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->idMedio_pago], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Quiere eliminar este medio de pago?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

</div>
