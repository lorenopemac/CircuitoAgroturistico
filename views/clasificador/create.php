<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Clasificador */

$this->title = 'Crear Clasificador';
$this->params['breadcrumbs'][] = ['label' => 'Clasificadors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="clasificador-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
