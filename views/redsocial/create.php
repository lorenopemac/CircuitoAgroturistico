<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RedSocial */

$this->title = 'Crear Red Social';
$this->params['breadcrumbs'][] = ['label' => 'Red Socials', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="red-social-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
