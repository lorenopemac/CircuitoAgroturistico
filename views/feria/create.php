<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Feria */

$this->title = 'Create Feria';
$this->params['breadcrumbs'][] = ['label' => 'Feria', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="feria-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'localidadesModel' => $localidadesModel,
        'vista' => $vista,
    ]) ?>

</div>
