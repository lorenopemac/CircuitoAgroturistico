<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Productor */

$this->title = 'Crear Productor';
$this->params['breadcrumbs'][] = ['label' => 'Productors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="productor-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'provinciasModel' => $provinciasModel,
        'localidadesModel' => $localidadesModel,
        'feriasModel' => $feriasModel,
        
        'dataProviderRedes'=>$dataProviderRedes,
    ]) ?>

</div>
