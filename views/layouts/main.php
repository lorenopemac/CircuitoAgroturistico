<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'Madriguera',
        'brandUrl' => 'http://madriguera.fi.uncoma.edu.ar/sitio/ace/',
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'Inicio', 'url' => ['/site/index']],
            [
                'label' => 'Catálogos',
                'icon' => 'share',
                'url' => '#',
                'items' => [
                    ['label' => 'Agroturismo', 'url' => ['/catalogoagro/index']],
                    ['label' => 'Catálogo', 'url' => ['/catalogo/index']],
                    ['label' => 'Mapa de Ferias', 'url' => ['/catalogo/mapaferias']],
                    ['label' => 'Mapa de Productores', 'url' => ['/catalogo/mapaproductores']],
                ],
            ],
            ['label' => 'Feria', 'url' => ['/feria/index']],
            ['label' => 'Producto', 'url' => ['/producto/index']],
            ['label' => 'Productor', 'url' => ['/productor/index']],
            ['label' => 'Categoria', 'url' => ['/categoria/index']],
            ['label' => 'Medio Pago', 'url' => ['/mediopago/index']],
            ['label' => 'Red Social', 'url' => ['/redsocial/index']],
            [
                'label' => 'Ubicación',
                'icon' => 'share',
                'url' => '#',
                'items' => [
                    ['label' => 'Provincia', 'url' => ['/provincia/index']],
                    ['label' => 'Localidad', 'url' => ['/localidad/index']],
                ],
            ],
            Yii::$app->user->isGuest ? (
                ['label' => 'Ingresar', 'url' => ['/site/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Salir (' . Yii::$app->user->identity->usuario . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            )
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Ferias de Productores <?= date('Y') ?></p>

        <p class="pull-right"><?= "FAI" ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
