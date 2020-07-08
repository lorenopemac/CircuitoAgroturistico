<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\FeriaProductor */

$this->title = 'Create Feria Productor';
$this->params['breadcrumbs'][] = ['label' => 'Feria Productors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="feria-productor-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
