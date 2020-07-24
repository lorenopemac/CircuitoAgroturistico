
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
            <div class="container" style="background-color: #d5f5e3 ">
            <div class="col-sm-8"  style="background-color:  #d5f5e3  "> 
                <h2>
                    Buscar producto y productores regionales
                </h2>
                <ul>
                <h4>
                    <br>
                    <li>Encuentra los mejores productos</li>
                    <br>
                </h4>
                </ul>
            
                </div>    
                <div class="col-sm-4" style="background-color: #d5f5e3 "> 
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
    </div>
    <?php ActiveForm::end(); ?>
    
</div><!-- registroView -->