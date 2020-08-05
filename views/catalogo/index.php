<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use kartik\select2\Select2;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ProductorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Productos en Venta';
$this->params['breadcrumbs'][] = $this->title;
?>

<h1> Productos en Venta </h1>
<div class="categoria-index" >
<?php \yii\widgets\Pjax::begin();?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'nombre',
            'descripcion',
            [
                'attribute' => 'imagenes',
                'format' => 'html',
                'label' => 'Imagen',
                'value' => function ($data) {
                    return Html::a('<img src='.Yii::getAlias('@web'). '/uploads/1.jpg" style= "border-radius:50%;height: 90px; width: 90px;" class="img-circle" alt="User Image"/>' );
                },
            ],
            ['attribute'=>'productor',
             'value'=> 'productor.nombre'],

            
        ],
    ]); ?>

<?php Pjax::end(); ?>

</div>