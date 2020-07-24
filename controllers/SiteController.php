<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\common\components\AccessRule;
use app\models\User;
use app\models\Usuario;
use app\models\Convocatoria;
use app\models\ConvocatoriaSearch;
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'ruleConfig' => [
                    'class' => AccessRule::className(),
                ],
                'only' => ['logout','about','contact'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],[
                        'actions' => ['about'],
                        'allow' => true,
                        // Allow users, moderators and admins to create
                        'roles' => ['?'],
                        
                    ],[
                        'actions' => ['contact'],
                        'allow' => true,
                        // Allow users, moderators and admins to create
                        'roles' => ['?'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        //$arraySalida = $this->armarTortasTotales();
       /* $var = 25;
        $result = \Yii::$app->db->createCommand("CALL  	sp_AvancePeriodos(".$var.")") 
        ->queryAll();
        print_r($result);*/
        return $this->render('index',[
            //'salidaTorta' => $arraySalida
        ]);
    }


/**
 * Armado del json para 
 */
    public function armarTortasTotales(){

        $var = 0;
        $var2 = 0;
        $ht = \Yii::$app->db->createCommand("CALL  	sp_CantidadViviendasObrasTipoObra(".$var.",".$var2.")") 
        ->queryAll();
        $salida = array();//Array 
        foreach($ht as $fila)
        {   
            //SE LLENAN LOS ARREGLOS POR SEPARADO DE CADA TIPO DE OBRA
            if($fila["tipoObra"] == "Vivienda"){
                $salidaVivi[] = array(
                    'idTipoObra' => ($fila["idtipoobra"]), 
                    'id'        =>     ($fila["superestado"]), 
                    'name'        =>     ($fila["estado"]), 
                    'y'         =>     floatval($fila["cantVivienda"])
                );
            }
            if($fila["tipoObra"] == "Infraestructura"){
                $salidaInfra[] = array(
                    'idTipoObra' => ($fila["idtipoobra"]), 
                    'id'        =>     ($fila["superestado"]), 
                    'name'        =>     ($fila["estado"]), 
                    'y'         =>     floatval($fila["cantObras"])
                );
            }
            if($fila["tipoObra"] == "Mejoramiento"){
                $salidaMejo[] = array(
                    'idTipoObra' => ($fila["idtipoobra"]), 
                    'id'        =>     ($fila["superestado"]), 
                    'name'        =>     ($fila["estado"]), 
                    'y'         =>     floatval($fila["cantObras"])
                );
            }
            if($fila["tipoObra"] == "Proyecto"){
                $salidaProy[] = array(
                    'idTipoObra' => ($fila["idtipoobra"]), 
                    'id'        =>     ($fila["superestado"]), 
                    'y'         =>     floatval($fila["cantObras"]),
                    'name'        =>     ($fila["estado"])
                );
            }
        }
        //INSERTAR EL RESULTADO DE CADA TIPO DE OBRA        
        if (isset($salidaVivi)){      
            array_push($salida, $salidaVivi);
        }
        if (isset($salidaInfra)){
            array_push($salida, $salidaInfra);
        }
        if (isset($salidaMejo)){
            array_push($salida, $salidaMejo);
        }
        if (isset($salidaProy)){
            array_push($salida, $salidaProy);
        }
        //print_r($salida);
        //echo json_encode($salida);//DEVUELVE UN JSON
        //print_r($salida[0]);
        return $salida;
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }


    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionRegistro()
    {

        $model = new Usuario();
        //$modelAux = new \app\models\Registro();    //carga del modelo para utilizarlo luego
        
        if ($model->load(\Yii::$app->request->post())){// si se realizo un submit del boton guardar
            
            //$model->fecha_registro =  date("d/m/Y");//se carga la fecha de registro
            $claveOrig = $model->password;
            $model->password = \Yii::$app->getSecurity()->generatePasswordHash($model->password);
            $usuarios = \yii\helpers\ArrayHelper::map(\app\models\Usuario::find()->all(), 'idUsuario', 'usuario');
            
            if(! \Yii::$app->getSecurity()->validatePassword($model->passwordRepetida,$model->password)) 
            {
                //Clave es distinta de Clave Repetida
                echo \yii2mod\alert\Alert::widget([
                    'options' => [
                        'title' => "Las claves no coinciden!",
                        'type'=> 'error',
                        'animation' => "slide-from-bottom",

                    ]
                ]);
                $model->password = $claveOrig; // para que no se vea todo como un hash
            }elseif(in_array($model->usuario,$usuarios)){
                //Ya existe el usuario
                echo \yii2mod\alert\Alert::widget([
                    'options' => [
                        'title' => "El usuario ya existe!",
                        'type'=> 'error',
                        'animation' => "slide-from-top",
                    ]
                ]);
                $model->password = $claveOrig;
            }
            else{
                 if ($model->save()) {//guardado de los datos 
                    $this->redirect('@web/site/login');
                    
                }else{//falla
                    echo \yii2mod\alert\Alert::widget([
                        'options' => [
                            'title' => "Fallo el Registro",
                            'type'=> 'error',
                            'animation' => "slide-from-top",
                        ]
                    ]); 
                }
            }   
        }
        return $this->render('registro', [// en caso de que no se quiera guardar y solo se accede por primera vez
            'model' => $model,
        ]);
    }
}
