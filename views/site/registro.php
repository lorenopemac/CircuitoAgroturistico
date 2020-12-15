
<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\captcha\Captcha;

/* @var $this yii\web\View */
/* @var $model app\models\Registro */
/* @var $form ActiveForm */

/**
     * @var string
     */

?>
<div class="registroView">

<?php

?>
    <?php $form = ActiveForm::begin(); ?>
    
    <div class="jumbotron jumbotron-fluid">
        <div> 
            <div class="container" >
                
            
                </div>    
                <div class="col-sm-4" > 
                    <div > 
                        <h4>Usuario: </h4>
                        <?= $form->field($model, 'usuario') 
                        ->label(false) ?>
                    </div> 

                    <div> 
                        <h4>Contraseña: </h4>
                        <?= $form->field($model, 'password') 
                        ->label(false)
                        ->passwordInput()?>
                    </div> 

                    <div> 
                        <h4>Repetir Contraseña: </h4>
                        <?= $form->field($model, 'passwordRepetida') 
                        ->label(false)
                        ->passwordInput()?>
                    </div> 

                    <div class="form-group">
                        <?= Html::submitButton('Registrarse', ['class' => 'btn btn-primary', 'name'=> 'register-button' ]) ?>
                    </div>
                    
                
                
            </div> 
            
        </div>
    </div>
    <?php ActiveForm::end(); ?>
    
</div><!-- registroView -->