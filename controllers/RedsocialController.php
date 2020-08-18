<?php

namespace app\controllers;

use Yii;
use app\models\RedSocial;
use app\models\Imagen;
use app\models\RedSocialSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\common\components\AccessRule;
use yii\filters\AccessControl;
use yii\web\UploadedFile;

use yii\helpers\Html;
/**
 * RedSocialController implements the CRUD actions for RedSocial model.
 */
class RedsocialController extends Controller
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
     * Lists all RedSocial models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RedSocialSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single RedSocial model.
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
     * Creates a new RedSocial model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new RedSocial();

        if ($model->load(Yii::$app->request->post()) ) {
            $model->imagen = UploadedFile::getInstances($model, 'imagen');    
            if($model->imagen){//TIENE UNA IMAGEN CARGADA
                $modelImagen = new Imagen();
                $modelImagen->extension = $model->imagen[0]->extension;
                $modelImagen->save();
                $model->idImagen = $modelImagen->idImagen;
                $model->imagen = $model->imagen[0];
                $model->upload($modelImagen);
                $model->imagen = null;
            }
            //print_r($model);
            //exit;
            if($model->save()){
                
                return $this->redirect(['view', 'id' => $model->idRed_social]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing RedSocial model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $initialPreview =  array();
        $model = $this->findModel($id);
        $imagen = Imagen::find()
                    ->where(['idImagen'=>$model->idImagen])
                    ->one();
        if($imagen){
            $model->imagen = Html::img(Yii::getAlias('@web')."/uploads/".$imagen->idImagen.".".$imagen->extension,['class'=>'file-preview-image','width' => '200px','height' => '210px']);
            $elemento=array('caption' => $imagen->idImagen.".".$imagen->extension, 'size' => '873727', 'key'=>$imagen->idImagen );
            array_push($initialPreview,$elemento);
        }
        if ($model->load(Yii::$app->request->post())) {

            $model->imagen = UploadedFile::getInstances($model, 'imagen');    
            if(sizeof($model->imagen)>0){//TIENE UNA IMAGEN CARGADA
                $modelImagen = new Imagen();
                $modelImagen->extension = $model->imagen[0]->extension;
                $modelImagen->save();
                $model->idImagen = $modelImagen->idImagen;
                $model->imagen = $model->imagen[0];
            }
            
            //print_r($model);
            //exit;
            if($model->save()){
                if($modelImagen){
                    $model->upload($modelImagen);
                }
                return $this->redirect(['view', 'id' => $model->idRed_social]);
            }
        }

        return $this->render('update', [
            'model' => $model,
            'initialPreviewConfig' => $initialPreview,        
        ]);
    }

    /**
     * Deletes an existing RedSocial model.
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
     * Finds the RedSocial model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return RedSocial the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = RedSocial::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionEliminarimagen(){
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $params= Yii::$app->request->post();
        
        $redSocial = RedSocial::find()
                            ->where(['idImagen'=>$params['key']])
                            ->one();
        $redSocial->idImagen = null;
        $redSocial->save();
        return true;
    }
}
