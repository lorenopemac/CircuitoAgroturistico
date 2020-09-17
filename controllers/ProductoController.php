<?php

namespace app\controllers;

use Yii;
use app\models\Producto;
use app\models\Productor;
use app\models\RedSocialSearch;
use app\models\RedsocialProductor;
use app\models\ProductoSearch;
use app\models\Categoria;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\UploadForm;
use yii\web\UploadedFile;
use app\models\Imagen;
use app\models\CategoriaProducto;
use app\models\ImagenProducto;
use app\common\components\AccessRule;
use yii\filters\AccessControl;
use yii\helpers\Html;
use yii\data\ArrayDataProvider;
/**
 * ProductoController implements the CRUD actions for Producto model.
 */
class ProductoController extends Controller
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
                        'actions' => ['create','update', 'index', 'view', 'delete','createanticipo'],
                        'allow' => true,
                        // Allow users, moderators and admins to create
                        'roles' => ['@'],

                    ], 
                    [
                        'actions' => ['update'],
                        'allow' => true,
                        // Allow users, moderators and admins to create
                        'roles' => [1],
                    ],
                    [
                        'actions' => ['view'],
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
     * Lists all Producto models.
     * @return mixed
     */
    public function actionIndex()
    {
        
        $searchModel = new ProductoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $productoresModel = \yii\helpers\ArrayHelper::map(\app\models\Productor::find()->where([])->orderBy(['nombre'=>SORT_ASC])->all(), 'idProductor', 'nombre');


        return $this->render('index', [
            
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'productoresModel' => $productoresModel,
        ]);
    }

    /**
     * Displays a single Producto model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $this->layout = 'catalogo';
        $model=$this->findModel($id);
        $data = $this->cargarImagenes($model);

        $modelProductor = Productor::find()->where(['idProductor'=>$model->idProductor])->one();
        $redProductor = RedsocialProductor::find()
                        ->joinWith('redSocial')
                        ->where(['idProductor'=>$modelProductor->idProductor,'baja'=>0])
                        ->all();
        $providerProductor = new ArrayDataProvider([
            'allModels' => $redProductor,
            'pagination' =>[
                'pageSize'=>10,
            ],
            'sort'=>[
                'attributes' => [''],
            ],
        ]);

        return $this->render('view', [
            'model' => $model,
            'modelProductor'=> $modelProductor,
            'providerProductor' => $providerProductor,
        ]);
    }

    /**
     * Creates a new Producto model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Producto();
        $productoresModel = \yii\helpers\ArrayHelper::map(\app\models\Productor::find()->where(['baja'=>0])->orderBy(['nombre'=>SORT_ASC])->all(), 'idProductor', 'nombre');
        $categoriasModel = \yii\helpers\ArrayHelper::map(\app\models\Categoria::find()->where(['baja'=>0])->orderBy(['nombre'=>SORT_ASC])->all(), 'idCategoria', 'nombre');
        $vista =false;
        if ($model->load(Yii::$app->request->post())  ) {
            $model->imagenes = UploadedFile::getInstances($model, 'imagenes');
            
            if($model->save()){
                $indice = 0;
                $imagenes = array();
                foreach($model->imagenes as $imagen){
                    $modelImagen = new Imagen();
                    $modelImagenProducto = new ImagenProducto();
                    $modelImagen->extension = $imagen->extension;
                    $modelImagen->save();
                    $modelImagenProducto->idImagen = $modelImagen->idImagen;
                    $modelImagenProducto->idProducto = $model->idProducto;
                    $modelImagenProducto->save();
                    $imagenes[$indice]= $modelImagen;
                    $indice = $indice +1;
                }
                if(sizeof($imagenes)>0){
                    $model->upload($imagenes);
                }
                if(sizeof($model->categorias)){
                    $this->guardarCategorias($model);
                }
                return $this->redirect(['view', 'id' => $model->idProducto]);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'productoresModel' => $productoresModel,
            'categoriasModel' => $categoriasModel,
            'vista'=>$vista,
        ]);
    }

    /**
     * Guarda las Categorias en las que participa el Productor.
     * @param Producto $model
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function guardarCategorias($model){
        foreach($model->categorias as $idCategoria){
            $categoriaProductor = new CategoriaProducto();
            $categoriaProductor->idProducto= $model->idProducto;
            $categoriaProductor->idCategoria= $idCategoria;
            $categoriaProductor->save();
        }
    }

    /**
     * Updates an existing Producto model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $productoresModel = \yii\helpers\ArrayHelper::map(\app\models\Productor::find()->where(['baja'=>0])->orderBy(['nombre'=>SORT_ASC])->all(), 'idProductor', 'nombre');
        $categoriasModel = \yii\helpers\ArrayHelper::map(\app\models\Categoria::find()->where(['baja'=>0])->orderBy(['nombre'=>SORT_ASC])->all(), 'idCategoria', 'nombre');
        $categoriasProducto = \yii\helpers\ArrayHelper::map(\app\models\CategoriaProducto::find()->where(['idProducto'=>$id])->all(), 'idCategoria_producto', 'idCategoria');
        $vista =true;
        $initialPreviewConfig = $this->cargarImagenes($model);
        $categorias = array();
        $indice=0;
        foreach($categoriasProducto as $categoriaProd){
            $categorias[$indice] =  Categoria::find()->where(['idCategoria'=> $categoriaProd])->one();
            $indice = $indice +1;
        }
        $model->categorias = $categorias;

        if ($model->load(Yii::$app->request->post())) {
            if( $model->save()){
                $model->imagenes = UploadedFile::getInstances($model, 'imagenes');
                $indice = 0;
                $imagenes = array();
                foreach($model->imagenes as $imagen){
                    $modelImagen = new Imagen();
                    $modelImagenProducto = new ImagenProducto();
                    $modelImagen->extension = $imagen->extension;
                    $modelImagen->save();
                    $modelImagenProducto->idImagen = $modelImagen->idImagen;
                    $modelImagenProducto->idProducto = $model->idProducto;
                    $modelImagenProducto->save();
                    $imagenes[$indice]= $modelImagen;
                    $indice = $indice +1;
                }
                if(sizeof($imagenes)>0){
                    $model->upload($imagenes);
                }
                $this->editarCategorias($model,$categoriasProducto);
                return $this->redirect(['view', 'id' => $model->idProducto]);
            }
        }
        return $this->render('update', [
            'productoresModel' => $productoresModel,
            'model' => $model,
            'categoriasModel' => $categoriasModel,
            'vista'=>$vista,
            'initialPreviewConfig' => $initialPreviewConfig,                
        ]);
    }


    /**
     * Carga las imagenes del producto
     * @param Productor $model
     * @throws NotFoundHttpException if the model cannot be found
     */
    private function cargarImagenes($model){
        $initialPreview =  array();
        $imagenProducto = ImagenProducto::find()
                            ->where(['idProducto'=>$model->idProducto])
                            ->all();
        $model->imagenes = array();
        foreach($imagenProducto as $imgProducto){
            $imagen = Imagen::find()
                    ->where(['idImagen'=>$imgProducto->idImagen])
                    ->one();
            array_push($model->imagenes,Html::img(Yii::getAlias('@web')."/uploads/".$imagen->idImagen.".".$imagen->extension,['class'=>'file-preview-image','width' => '200px','height' => '170px'])) ;          
            $elemento=array('caption' => $imagen->idImagen.".".$imagen->extension, 'size' => '873727', 'key'=>$imagen->idImagen );
            array_push($initialPreview,$elemento);
        }
        return $initialPreview;
    }

    /**
     * Guarda o Borra las Categorias en las que participa el Productor.
     * @param Producto $model
     * @param CategoriaProducto $categoriasProducto
     * @throws NotFoundHttpException if the model cannot be found
     */
    private function editarCategorias($model,$categoriasProducto){
        
        //ELIMINAR
        if(!(is_string($model->categorias) && sizeof($categoriasProducto)==0)){
            if(is_string($model->categorias) && sizeof($categoriasProducto)>0){//se eliminan todos 
                foreach($categoriasProducto  as $idCategoria){    
                    $categoriaProducto = CategoriaProducto::find()
                                    ->where(['idProducto'=>$model->idProducto, 'idCategoria'=>$idCategoria])
                                    ->one();
                    $categoriaProducto->delete();
                }    
            }else{
                foreach($categoriasProducto  as $idCategoria){// se eliminan solo algunos
                    if(!is_numeric(array_search($idCategoria,$model->categorias))){//si no existia esa categoria para el producto y ya no esta mas
                        $categoriaProducto = CategoriaProducto::find()
                                        ->where(['idProducto'=>$model->idProducto, 'idCategoria'=>$idCategoria])
                                        ->one();
                        $categoriaProducto->delete();
                    }
                }
                //guardado
                foreach($model->categorias  as $idCategoria){//se agregan
                    if(array_search($idCategoria,$categoriasProducto)==false){//si no existia esa categoria para el producto
                        $categoriaProducto = new CategoriaProducto();
                        $categoriaProducto->idProducto = $model->idProducto;
                        $categoriaProducto->idCategoria= $idCategoria;
                        $categoriaProducto->save();
                    }                            
                }
            }
        }
    }    

    /**
     * Deletes an existing Producto model.
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
     * Finds the Producto model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Producto the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Producto::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionEliminarimagen(){
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $params= Yii::$app->request->post();
        
        $imagenProducto = ImagenProducto::find()
                            ->where(['idImagen'=>$params['key']])
                            ->one();
        $imagenProducto->delete();
        $imagen = Imagen::find()
                ->where(['idImagen'=>$params['key']])
                ->one();
        unlink(Yii::getAlias('@app')."/web/uploads/".$imagen->idImagen.".".$imagen->extension);
        $imagen->delete();
        return true;
    }

    public function actionActivar($id)
    {
        $model = $this->findModel($id);
        $model->baja = 0;
        $model->save();
        return $this->redirect(['index']);
    }
}

