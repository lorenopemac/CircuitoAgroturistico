<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Provincia */


$this->params['breadcrumbs'][] = ['label' => 'Provincias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="provincia-view">

    <h1><?= Html::encode($this->title) ?></h1>

    

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'nombre',
        ],
    ]) ?>

    <p>
        <?= Html::a('Modificar', ['update', 'id' => $model->idProvincia], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->idProvincia], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
</div>
