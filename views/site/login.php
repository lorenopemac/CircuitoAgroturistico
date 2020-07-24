<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = 'Iniciar Sesión';

$fieldOptions1 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-envelope form-control-feedback'></span>"
];

$fieldOptions2 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-lock form-control-feedback'></span>"
];
?>
<div class="login-box">
    <div class="login-logo">
        <a href="#"><b>Circuito Agroturistico</b></a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">Iniciá sesión</p>

        <?php $form = ActiveForm::begin(['id' => 'login-form', 'enableClientValidation' => false]); ?>

        <?= $form
            ->field($model, 'username', $fieldOptions1)
            ->label(false)
            ->textInput(['placeholder' => 'usuario']) ?>

        <?= $form
            ->field($model, 'password', $fieldOptions2)
            ->label(false)
            ->passwordInput(['placeholder' => 'contraseña']) ?>

        <div class="row">
            <div class="col-xs-8">
                <?= $form->field($model, 'rememberMe')->checkbox()->label('Recordame') ?>
            </div>
            <!-- /.col -->
            <div class="col-md-6 col-xs-12">    
                <?= Html::submitButton('Iniciar Sesión', ['class' => 'btn btn-success btn-block btn-flat', 'name' => 'login-button']) ?>
            </div>
            <!-- /.col -->
            <div class="col-md-6 col-xs-12">    
                <?= Html::a('Registrate', ['/site/registro'], ['class'=>'btn btn-primary btn-block btn-flat', ]) ?>
            </div>
        </div>


        <?php ActiveForm::end(); ?>

        <div class="social-auth-links text-center">
       <!--     <p>- OR -</p>
            <a href="#" class="btn btn-block btn-social btn-google-plus btn-flat"><i class="fa fa-google-plus"></i> Sign
                in using Google+</a> -->
        </div>
        <!-- /.social-auth-links -->
        
    </div>
    <!-- /.login-box-body -->
</div><!-- /.login-box -->
