<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\select2\Select2;
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
                    
                    return Html::img('@web/uploads/'.'3.jpg',['width' => '60px']);
    
                },
    
            ],
            ['attribute'=>'productor',
             'value'=> 'productor.nombre'],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

<?php Pjax::end(); ?>

</div>