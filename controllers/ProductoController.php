<?php

namespace app\controllers;

use Yii;
use app\models\Producto;
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
        return $this->render('view', [
            'model' => $this->findModel($id),
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
        $productoresModel = \yii\helpers\ArrayHelper::map(\app\models\Productor::find()->where([])->orderBy(['nombre'=>SORT_ASC])->all(), 'idProductor', 'nombre');
        $categoriasModel = \yii\helpers\ArrayHelper::map(\app\models\Categoria::find()->where([])->orderBy(['nombre'=>SORT_ASC])->all(), 'idCategoria', 'nombre');
        
        if ($model->load(Yii::$app->request->post())  ) {
            $model->imagenes = UploadedFile::getInstances($model, 'imagenes');
            
            if($model->save()){
                $indice = 0;
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
                $model->upload($imagenes);
                $this->guardarCategorias($model);
                return $this->redirect(['view', 'id' => $model->idProducto]);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'productoresModel' => $productoresModel,
            'categoriasModel' => $categoriasModel,
        ]);
    }


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
        $productoresModel = \yii\helpers\ArrayHelper::map(\app\models\Productor::find()->where([])->orderBy(['nombre'=>SORT_ASC])->all(), 'idProductor', 'nombre');
        $categoriasModel = \yii\helpers\ArrayHelper::map(\app\models\Categoria::find()->where([])->orderBy(['nombre'=>SORT_ASC])->all(), 'idCategoria', 'nombre');
        $categoriasProducto = \yii\helpers\ArrayHelper::map(\app\models\CategoriaProducto::find()->where(['idProducto'=>$id])->all(), 'idCategoria_producto', 'idCategoria');
        $categorias = array();
        $indice=0;
        foreach($categoriasProducto as $categoriaProd){
            $categorias[$indice] =  Categoria::find()->where(['idCategoria'=> $categoriaProd])->one();
            $indice = $indice +1;
        }
        $model->categorias = $categorias;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idProducto]);
        }
        /*$imagen = Imagen::find()
                ->where(['idImagen' => 20, 'baja' => 0])
                ->one();
        //$imagenVista = $model->getDisplayImage($imagen);
        
        $model->imagenes[0] = Html::img("@app/uploads/20.png");;
        
        
        //print_r($imagenVista);
        //exit;*/

        return $this->render('update', [
            'productoresModel' => $productoresModel,
            'model' => $model,
            'categoriasModel' => $categoriasModel,
        ]);
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
        $this->findModel($id)->delete();

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
}
