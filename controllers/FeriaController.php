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
        if ($model->load(Yii::$app->request->post())) {
            $model->imagenes = UploadedFile::getInstances($model, 'imagenes');    
            if($model->save()){
                if($model->imagenes){
                    if(sizeof($model->imagenes)>0){
                        $imagenes = $this->guardarImagenes($model);
                        $model->upload($imagenes);
                    }
                }
                return $this->redirect(['view', 'id' => $model->idFeria]);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'localidadesModel' => $localidadesModel,
            'vista' => $vista,
        ]);
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
        $localidadesModel = \yii\helpers\ArrayHelper::map(\app\models\Localidad::find()->where([])->orderBy(['nombre'=>SORT_ASC])->all(), 'idLocalidad', 'nombre');
        $vista = true;
        $this->cargarImagenes($model);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idFeria]);
        }

        return $this->render('update', [
            'model' => $model,
            'localidadesModel' => $localidadesModel,
            'vista' => $vista,
        ]);
    }

    /**
     * Carga las imagenes del productor 
     * @param Productor $model
     * @throws NotFoundHttpException if the model cannot be found
     */
    private function cargarImagenes($model){
        $imagenesFeria= ImagenFeria::find()
                            ->where(['idFeria'=>$model->idFeria])
                            ->all();
        $model->imagenes = array();
        foreach($imagenesFeria as $imgFeria){
            $imagen = Imagen::find()
                    ->where(['idImagen'=>$imgFeria->idImagen])
                    ->one();
            array_push($model->imagenes,Html::img(Yii::getAlias('@web')."/uploads/".$imagen->idImagen.".".$imagen->extension,['class'=>'file-preview-image','width' => '200px','height' => '210px'])) ;          
        }
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
        $this->findModel($id)->delete();

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
}
