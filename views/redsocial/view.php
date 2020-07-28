<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\RedSocial */

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Red Socials', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="red-social-view">

    <h1><?= Html::encode($this->title) ?></h1>

    

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'nombre',
            'baja:boolean',
        ],
    ]) ?>

    <p>
        <?= Html::a('Modificar', ['update', 'id' => $model->idRed_social], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->idRed_social], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

</div>
