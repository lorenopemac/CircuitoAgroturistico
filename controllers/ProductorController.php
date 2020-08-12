<?php

namespace app\controllers;
use yii\helpers\Html;
use Yii;
use app\models\Productor;
use app\models\FeriaProductor;
use app\models\ProductorSearch;
use app\models\RedSocial;
use app\models\Imagen;
use app\models\RedsocialProductor;
use app\models\RedSocialSearch;
use app\models\ImagenProductor;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\UploadForm;
use yii\web\UploadedFile;
use yii\data\ArrayDataProvider;
use app\common\components\AccessRule;
use yii\filters\AccessControl;
/**
 * ProductorController implements the CRUD actions for Productor model.
 */
class ProductorController extends Controller
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
                        'actions' => ['create', 'update','index', 'view', 'delete','createanticipo'],
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
     * Lists all Productor models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductorSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $provinciasModel = \yii\helpers\ArrayHelper::map(\app\models\Provincia::find()->where([])->orderBy(['nombre'=>SORT_ASC])->all(), 'idProvincia', 'nombre');
        $localidadesModel = \yii\helpers\ArrayHelper::map(\app\models\Localidad::find()->where([])->orderBy(['nombre'=>SORT_ASC])->all(), 'idLocalidad', 'nombre');

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'provinciasModel' => $provinciasModel,
            'localidadesModel' => $localidadesModel,
        ]);
    }

    /**
     * Displays a single Productor model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $redProductor = RedsocialProductor::find()
                        ->joinWith('redSocial')
                        ->where(['idProductor'=>$id])
                        ->all();
        $provider = new ArrayDataProvider([
            'allModels' => $redProductor,
            'pagination' =>[
                'pageSize'=>10,
            ],
            'sort'=>[
                'attributes' => [''],
            ],
        ]);
        return $this->render('view', [
            'model' => $this->findModel($id),
            'provider' => $provider,
        ]);
    }

    /**
     * Creates a new Productor model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $provinciasModel = \yii\helpers\ArrayHelper::map(\app\models\Provincia::find()->where([])->orderBy(['nombre'=>SORT_ASC])->all(), 'idProvincia', 'nombre');
        $localidadesModel = \yii\helpers\ArrayHelper::map(\app\models\Localidad::find()->where([])->orderBy(['nombre'=>SORT_ASC])->all(), 'idLocalidad', 'nombre');
        $feriasModel = \yii\helpers\ArrayHelper::map(\app\models\Feria::find()->where(['baja'=>0])->orderBy(['nombre'=>SORT_ASC])->all(), 'idFeria', 'nombre');
        $searchModelRedes = new RedSocialSearch();
        $dataProviderRedes = $searchModelRedes->search(Yii::$app->request->queryParams,true);
        
        //Agrego productor para utilizar el id en la carga de redes sociales
        $model = new Productor();
        if (!(Yii::$app->request->isPost)) {
            $model->baja = true;
            $model->idProvincia = 1;
            $model->nombre = "vacio";
            $model->cuit = 0;
            $model->idLocalidad = 1;
            $model->numeroTelefono = 0;
            $model->save();
            $idProductor = $model->idProductor;
            $model->numeroTelefono = null;
            $model->nombre = null;
            $model->idLocalidad= null;
            $model->cuit = null;
            $model->numeroCalle = 0;
        }
        //fin carga
        
        if ($model->load(Yii::$app->request->post()) ) {
            $model->idProductor= $_POST['idProductor'];
            if($model->ferias>0){
                $this->guardarFerias($model);    
            }
            if($_POST['idProductor'] > 0){
                $model=$this->findModel($_POST['idProductor']);
            }
            $model->setAttributes(Yii::$app->request->post()['Productor'], false);
            $model->imagenes = UploadedFile::getInstances($model, 'imagenes');    
            $model->baja = 0;
            if($model->save()){
                $this->guardarRedesFaltantes($model);
                if($model->imagenes){
                    if(sizeof($model->imagenes)>0){
                        $imagenes = $this->guardarImagenes($model);
                        $model->upload($imagenes);
                    }
                }
                //Borrado de Produtores vacio
                $connection = Yii::$app->getDb();
                $command = $connection->createCommand("DELETE FROM productor WHERE nombre='vacio' AND baja=true")->execute();
                return $this->redirect(['index']);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'provinciasModel' => $provinciasModel,
            'localidadesModel' => $localidadesModel,
            'feriasModel' => $feriasModel,
            'dataProviderRedes'=>$dataProviderRedes,
            'vista'=>false,
            'idProductor' =>$idProductor,                      
        ]);
    }


    /**
     * Guarda las Redes Sociales del Productor faltante.
     * Hace mas sencilla la busqueda para editar
     * @param Productor $model
     * @throws NotFoundHttpException if the model cannot be found
     */
    private function guardarRedesFaltantes($model){
        //REDES
        $redes = RedSocial::find()
                ->where(['baja'=>false])
                ->all();
        foreach($redes as $red){
            $redProductor = RedsocialProductor::find()
                        ->where(['idProductor'=>$model->idProductor,'idRed_social'=>$red->idRed_social])
                        ->one();
            if(!$redProductor){//SI NO EXISTE ESA RED SOCIAL PARA EL PRODUCTOR, CREO UNA VACIA
                $redProductor = new RedsocialProductor();
                $redProductor->idProductor= $model->idProductor;
                $redProductor->idRed_social= $red->idRed_social;
                $redProductor->direccion= "No Informa";
                $redProductor->save();
            }
        }
    }


    /**
     * Guarda las Imagenes del Productor.
     * @param Productor $model
     * @throws NotFoundHttpException if the model cannot be found
     */
    private function guardarImagenes($model){
        $indice = 0;
        foreach($model->imagenes as $imagen){
            $modelImagen = new Imagen();
            $modelImagenProductor = new ImagenProductor();
            $modelImagen->extension = $imagen->extension;
            $modelImagen->save();
            $modelImagenProductor->idImagen = $modelImagen->idImagen;
            $modelImagenProductor->idProductor = $model->idProductor;
            $modelImagenProductor->save();
            $imagenes[$indice]= $modelImagen;
            $indice = $indice +1;
        }
        return $imagenes;
    }

    /**
     * Guarda las Ferias en las que participa el Productor.
     * @param Productor $model
     * @throws NotFoundHttpException if the model cannot be found
     */
    private function guardarFerias($model){
        foreach($model->ferias as $idFeria){
            $feriaProductor = new FeriaProductor();
            $feriaProductor->idProductor =$model->idProductor;
            $feriaProductor->idFeria= $idFeria;
            $feriaProductor->save();
        }

    }

    /**
     * Guarda las Ferias en las que participa el Productor.
     * @param Productor $model
     * @throws NotFoundHttpException if the model cannot be found
     */
    private function editarFerias($model,$feriasProductor){
        
        //ELIMINAR
        if(!(is_string($model->ferias) && sizeof($feriasProductor)==0)){
            if(is_string($model->ferias) && sizeof($feriasProductor)>0){//se eliminan todos 
                foreach($feriasProductor  as $idFeria){    
                    $feriaProductor = FeriaProductor::find()
                                    ->where(['idProductor'=>$model->idProductor, 'idFeria'=>$idFeria])
                                    ->one();
                    $feriaProductor->delete();
                }    
            }else{
                foreach($feriasProductor  as $idFeria){// se eliminan solo algunos
                    if(!is_numeric(array_search($idFeria,$model->ferias))){//si no existia esa feria para el productor y ya no esta mas
                        $feriaProductor = FeriaProductor::find()
                                        ->where(['idProductor'=>$model->idProductor, 'idFeria'=>$idFeria])
                                        ->one();
                        $feriaProductor->delete();
                    }
                }
                //guardado
                foreach($model->ferias  as $idFeria){//se agregan
                    if(array_search($idFeria,$feriasProductor)==false){//si no existia esa feria para el productor
                        $feriaProductor = new FeriaProductor();
                        $feriaProductor->idProductor = $model->idProductor;
                        $feriaProductor->idFeria= $idFeria;
                        $feriaProductor->save();
                    }                            
                }
            }
        }
    }

    /**
     * Updates an existing Productor model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        //REDES SOCIALES
        $redProductor = RedsocialProductor::find()
                        ->joinWith('redSocial')
                        ->where(['idProductor'=>$id])
                        ->all();
        
        $providerRedes = new ArrayDataProvider([
            'allModels' => $redProductor,
            'pagination' =>[
                'pageSize'=>10,
            ],
            'sort'=>[
                'attributes' => [''],
            ],
        ]);
        //FIN REDES SOCIALES
        $provinciasModel = \yii\helpers\ArrayHelper::map(\app\models\Provincia::find()->where([])->orderBy(['nombre'=>SORT_ASC])->all(), 'idProvincia', 'nombre');
        $localidadesModel = \yii\helpers\ArrayHelper::map(\app\models\Localidad::find()->where([])->orderBy(['nombre'=>SORT_ASC])->all(), 'idLocalidad', 'nombre');
        $feriasModel = \yii\helpers\ArrayHelper::map(\app\models\Feria::find()->where([])->orderBy(['nombre'=>SORT_ASC])->all(), 'idFeria', 'nombre');
        $vista =true;
        $this->cargarImagenes($model);
        
        //$model->imagenes = $model->getDisplayImage();
        $feriasProductor = \yii\helpers\ArrayHelper::map(\app\models\FeriaProductor::find()->where(['idProductor'=>$id])->all(), 'idFeria_productor', 'idFeria');
        $ferias = array();
        $indice=0;
        if(sizeof($feriasProductor)){
            foreach($feriasProductor as $idFeria){
                $ferias[$indice] =  $idFeria;
                $indice = $indice +1;
            }
        }   
        $model->ferias = $ferias;
        if ($model->load(Yii::$app->request->post()) ) {
            $this->editarFerias($model,$feriasProductor);    
            $this->guardarRedesFaltantes($model);
            $model->imagenes = UploadedFile::getInstances($model, 'imagenes');
            if($model->imagenes){
                if(sizeof($model->imagenes)>0){
                    $this->guardarImagenes($model);
                    $model->upload($imagenes);
                }
            }
            $model->save();
            return $this->redirect(['view', 'id' => $model->idProductor]);
        }

        return $this->render('update', [
            'model' => $model,
            'provinciasModel' => $provinciasModel,
            'localidadesModel' => $localidadesModel,
            'feriasModel' => $feriasModel,
            'dataProviderRedes'=>$providerRedes,
            'vista'=>$vista,
            'idProductor' =>$model->idProductor,                      
        ]);
    }


    /**
     * Carga las imagenes del productor 
     * @param Productor $model
     * @throws NotFoundHttpException if the model cannot be found
     */
    private function cargarImagenes($model){
        $imagenProductor = ImagenProductor::find()
                            ->where(['idProductor'=>$model->idProductor])
                            ->all();
        $model->imagenes = array();
        foreach($imagenProductor as $imgProductor){
            $imagen = Imagen::find()
                    ->where(['idImagen'=>$imgProductor->idImagen])
                    ->one();
            array_push($model->imagenes,Html::img(Yii::getAlias('@web')."/uploads/".$imagen->idImagen.".".$imagen->extension,['class'=>'file-preview-image','width' => '200px','height' => '210px'])) ;          
        }
    }

    /**
     * Deletes an existing Productor model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        //$this->findModel($id)->delete();
        $model = $this->findModel($id);
        $model->baja = 1;
        $model->save();
        return $this->redirect(['index']);
    }

    /**
     * Finds the Productor model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Productor the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Productor::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }


    public function actionGuardarred(){
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $params= Yii::$app->request->post();
        $retorno=false;

        $redProductor = new RedsocialProductor();
        $redProductor = RedsocialProductor::find()
                        ->where(['idRed_social'=>$params['idRed']])
                        ->andWhere(['idProductor'=>$params['idProductor']])
                        ->one();

        if(!($redProductor)){
            $redProductor = new RedsocialProductor();
        }
        $redProductor->idProductor= $params['idProductor'];
        $redProductor->idRed_social= $params['idRed'];
        $redProductor->direccion= $params['direccion'];
        if($redProductor->save())    {
            $retorno=true;
        }
        
        return[
            'exito'=> $retorno,
        ];
    }


}
