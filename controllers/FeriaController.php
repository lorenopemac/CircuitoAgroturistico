<?php

namespace app\controllers;

use Yii;
use yii\helpers\Html;
use app\models\Feria;
use app\models\FeriaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\UploadForm;
use yii\web\UploadedFile;
use app\models\Imagen;
use app\models\ImagenFeria;
use app\common\components\AccessRule;
use yii\filters\AccessControl;
use app\models\RedsocialFeria;
use app\models\RedSocialSearch;
use app\models\RedSocial;
use yii\data\ArrayDataProvider;
/**
 * FeriaController implements the CRUD actions for Feria model.
 */
class FeriaController extends Controller
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
                'only' => ['index', 'view', 'create', 'update', 'delete','createanticipo'],
                'rules' => [
                    [
                        'actions' => ['update','create', 'update','index', 'view', 'delete','createanticipo'],
                        'allow' => true,
                        // Allow users, moderators and admins to create
                        'roles' => ['@'],

                    ], [
                        'actions' => ['update'],
                        'allow' => true,
                        // Allow users, moderators and admins to create
                        'roles' => [1],
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
     * Lists all Feria models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FeriaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $localidadesModel = \yii\helpers\ArrayHelper::map(\app\models\Localidad::find()->where([])->orderBy(['nombre'=>SORT_ASC])->all(), 'idLocalidad', 'nombre');

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'localidadesModel' => $localidadesModel,
        ]);
    }

    /**
     * Displays a single Feria model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Feria model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Feria();
        $localidadesModel = \yii\helpers\ArrayHelper::map(\app\models\Localidad::find()->where([])->orderBy(['nombre'=>SORT_ASC])->all(), 'idLocalidad', 'nombre');
        $vista = false;
        $searchModelRedes = new RedSocialSearch();
        $dataProviderRedes = $searchModelRedes->search(Yii::$app->request->queryParams);

        if (!(Yii::$app->request->isPost)) {
            $model->baja = true;
            $model->nombre = "vacio";
            $model->idLocalidad = 1;
            $model->save();
            $idFeria = $model->idFeria;
            $model->nombre = " ";
            $model->idLocalidad = 0;
        }
        if ($model->load(Yii::$app->request->post())) {
            $model->idFeria= $_POST['idFeria'];
            $imagenes = UploadedFile::getInstances($model, 'imagenes');    
            if($_POST['idFeria'] > 0){
                $model=$this->findModel($_POST['idFeria']);
            }
            $model->imagenes = $imagenes;
            $model->setAttributes(Yii::$app->request->post()['Feria'], false);
            $model->baja = 0;
            
            if($model->save()){
                $this->guardarRedesFaltantes($model);
                if($model->imagenes){
                    if(sizeof($model->imagenes)>0){
                        $imagenes = $this->guardarImagenes($model);
                        $model->upload($imagenes);
                    }
                }
                //BORRADO DE FERIAS TEMPORALES
                $connection = Yii::$app->getDb();
                $command = $connection->createCommand("DELETE FROM feria  WHERE nombre='vacio' AND baja=true")->execute();
                return $this->redirect(['view', 'id' => $model->idFeria]);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'localidadesModel' => $localidadesModel,
            'vista' => $vista,
            'dataProviderRedes'=>$dataProviderRedes,
            'idFeria' =>$idFeria,                      
        ]);
    }


    /**
     * Guarda las Redes Sociales del Feria faltante.
     * Hace mas sencilla la busqueda para editar
     * @param Feria $model
     * @throws NotFoundHttpException if the model cannot be found
     */
    private function guardarRedesFaltantes($model){
        //REDES
        $redes = RedSocial::find()
                ->where(['baja'=>false])
                ->all();
        foreach($redes as $red){
            $redFeria = RedsocialFeria::find()
                        ->where(['idFeria'=>$model->idFeria,'idRed_social'=>$red->idRed_social])
                        ->one();
            if(!$redFeria){//SI NO EXISTE ESA RED SOCIAL PARA EL Feria, CREO UNA VACIA
                $redFeria = new RedsocialFeria();
                $redFeria->idFeria= $model->idFeria;
                $redFeria->idRed_social= $red->idRed_social;
                $redFeria->direccion= "No Informa";
                $redFeria->save();   
            }
        }
    }

    /**
     * Guarda las Imagenes de la Feria.
     * @param Feria $model
     * @throws NotFoundHttpException if the model cannot be found
     */
    private function guardarImagenes($model){
        $imagenes = array();
        $indice = 0;
        foreach($model->imagenes as $imagen){
            $modelImagen = new Imagen();
            $modelImagenFeria = new ImagenFeria();
            $modelImagen->extension = $imagen->extension;
            $modelImagen->save();
            $modelImagenFeria->idImagen = $modelImagen->idImagen;
            $modelImagenFeria->idFeria = $model->idFeria;
            $modelImagenFeria->save();
            $imagenes[$indice]= $modelImagen;
            $indice = $indice +1;
        }
        return $imagenes;
    }

    /**
     * Updates an existing Feria model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $redFeria = RedsocialFeria::find()
                        ->joinWith('redSocial')
                        ->where(['idFeria'=>$id])
                        ->all();
        
        $providerRedes = new ArrayDataProvider([
            'allModels' => $redFeria,
            'pagination' =>[
                'pageSize'=>10,
            ],
            'sort'=>[
                'attributes' => [''],
            ],
        ]);
        $localidadesModel = \yii\helpers\ArrayHelper::map(\app\models\Localidad::find()->where([])->orderBy(['nombre'=>SORT_ASC])->all(), 'idLocalidad', 'nombre');
        $vista = true;
        $initialPreviewConfig = $this->cargarImagenes($model);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->imagenes = UploadedFile::getInstances($model, 'imagenes');    
            if($model->imagenes){
                if(sizeof($model->imagenes)>0){
                    $imagenes = $this->guardarImagenes($model);
                    $model->upload($imagenes);
                }
            }
            return $this->redirect(['view', 'id' => $model->idFeria]);
        }

        return $this->render('update', [
            'model' => $model,
            'localidadesModel' => $localidadesModel,
            'vista' => $vista,
            'dataProviderRedes'=>$providerRedes,
            'idFeria' =>$model->idFeria,            
            'initialPreviewConfig' => $initialPreviewConfig,    
        ]);
    }

    /**
     * Carga las imagenes del Feria 
     * @param Feria $model
     * @throws NotFoundHttpException if the model cannot be found
     */
    private function cargarImagenes($model){
        $initialPreview =  array();
        $imagenesFeria= ImagenFeria::find()
                            ->where(['idFeria'=>$model->idFeria])
                            ->all();
        $model->imagenes = array();
        foreach($imagenesFeria as $imgFeria){
            $imagen = Imagen::find()
                    ->where(['idImagen'=>$imgFeria->idImagen])
                    ->one();
            array_push($model->imagenes,Html::img(Yii::getAlias('@web')."/uploads/".$imagen->idImagen.".".$imagen->extension,['class'=>'file-preview-image','width' => '200px','height' => '210px'])) ;          
            $elemento=array('caption' => $imagen->idImagen.".".$imagen->extension, 'size' => '873727', 'key'=>$imagen->idImagen );
            array_push($initialPreview,$elemento);
        }
        return $initialPreview;
    }

    /**
     * Deletes an existing Feria model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->baja = 1;
        $model->save();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Feria model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Feria the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Feria::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionGuardarred(){
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $params= Yii::$app->request->post();
        $retorno=false;

        $redFeria = new RedsocialFeria();
        $redFeria = RedsocialFeria::find()
                        ->where(['idRed_social'=>$params['idRed']])
                        ->andWhere(['idFeria'=>$params['idFeria']])
                        ->one();

        if(!($redFeria)){
            $redFeria = new RedsocialFeria();
        }
        $redFeria->idFeria= $params['idFeria'];
        $redFeria->idRed_social= $params['idRed'];
        $redFeria->direccion= $params['direccion'];
        if($redFeria->save())    {
            $retorno=true;
        }
        
        return[
            'exito'=> $retorno,
        ];
    }


    public function actionEliminarimagen(){
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $params= Yii::$app->request->post();
        
        $imagenProductor = ImagenFeria::find()
                            ->where(['idImagen'=>$params['key']])
                            ->one();
        $imagenProductor->delete();
        $imagen = Imagen::find()
                ->where(['idImagen'=>$params['key']])
                ->one();
        unlink(Yii::getAlias('@app')."/web/uploads/".$imagen->idImagen.".".$imagen->extension);
        $imagen->delete();
        return true;
    }
}
