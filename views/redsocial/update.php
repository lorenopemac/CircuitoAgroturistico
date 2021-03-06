<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RedSocial */

$this->title = 'Modificar Red Social ';
$this->params['breadcrumbs'][] = ['label' => 'Red Social', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nombre, 'url' => ['view', 'id' => $model->idRed_social]];
$this->params['breadcrumbs'][] = 'Modificar';
?>
<div class="red-social-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'initialPreviewConfig' => $initialPreviewConfig,      
    ]) ?>

</div>
