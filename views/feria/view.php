<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Feria */

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Ferias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="feria-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            
            'nombre',
            'localidad.nombre',
        ],
    ]) ?>

<p>
        <?= Html::a('Editar', ['update', 'id' => $model->idFeria], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->idFeria], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Desea eliminar esta feria?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
</div>
