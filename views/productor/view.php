<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Productor */

$this->title = $model->idProductor;
$this->params['breadcrumbs'][] = ['label' => 'Productors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="productor-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->idProductor], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->idProductor], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idProductor',
            'nombre',
            'cuit',
            'idLocalidad',
            'idProvincia',
            'nombreCalle',
            'numeroCalle',
            'numeroTelefono',
            'facebook',
            'Instagram',
            'twitter',
            'web',
        ],
    ]) ?>

</div>
