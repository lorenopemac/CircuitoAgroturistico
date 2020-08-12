<?php

namespace app\controllers;

use Yii;
use app\models\Categoria;
use app\models\Producto;
use app\models\ProductoSearch;
use app\models\CategoriaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\common\components\AccessRule;
use yii\filters\AccessControl;
use yii\helpers\Html;
use app\models\ImagenProducto;
use app\models\Imagen;
/**
 * CategoriaController implements the CRUD actions for Categoria model.
 */
class CatalogoController extends Controller
{
    /**
     * {@inheritdoc}
     */
    /*public function behaviors()
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
    }*/

    /**
     * Lists all Categoria models.
     * @return mixed
     */
    public function actionIndex()
    {
        //$searchModel = new ProductoSearch();
        //$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $productos = Producto::find()
                    ->where(['baja'=>0]) 
                    ->all();
        foreach($productos as $producto){
            $productorImagen = ImagenProducto::find()
                                ->where(['idProducto'=>$producto->idProducto])
                                ->one();
            if($productorImagen){
                $imagen = Imagen::find()
                            ->where(['idImagen'=>$productorImagen->idImagen])
                            ->one();
                            
                $producto->imagenes[0]= Html::img(Yii::getAlias('@web')."/uploads/".$imagen->idImagen.".".$imagen->extension,['class'=>'file-preview-image','width' => '200px','height' => '210px']);
            }else{
                $producto->imagenes[0]= Html::img(Yii::getAlias('@web')."/uploads/default.png",['class'=>'file-preview-image','width' => '200px','height' => '210px']);    
            }
            
        }
        return $this->render('index', [
            //'searchModel' => $searchModel, 
            //'dataProvider' => $dataProvider,
            'productos' => $productos,
        ]);
    }



    /**
     * Displays a single Categoria model.
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
     * Creates a new Categoria model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Categoria();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idCategoria]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Categoria model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idCategoria]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

   

    
}
