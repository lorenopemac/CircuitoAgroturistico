<?php

namespace app\controllers;

use Yii;
use app\models\Productor;
use app\models\FeriaProductor;
use app\models\ProductorSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

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
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
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
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Productor model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Productor();
        $model->idProvincia = 1;
        $provinciasModel = \yii\helpers\ArrayHelper::map(\app\models\Provincia::find()->where([])->orderBy(['nombre'=>SORT_ASC])->all(), 'idProvincia', 'nombre');
        $localidadesModel = \yii\helpers\ArrayHelper::map(\app\models\Localidad::find()->where([])->orderBy(['nombre'=>SORT_ASC])->all(), 'idLocalidad', 'nombre');

        $feriasModel = \yii\helpers\ArrayHelper::map(\app\models\Feria::find()->where([])->orderBy(['nombre'=>SORT_ASC])->all(), 'idFeria', 'nombre');

        if ($model->load(Yii::$app->request->post()) ) {
            //print_r($model->ferias[0]);
            //exit;
            $model->save();
            $this->guardarFerias($model);
            return $this->redirect(['view', 'id' => $model->idProductor]);
        }

        return $this->render('create', [
            'model' => $model,
            'provinciasModel' => $provinciasModel,
            'localidadesModel' => $localidadesModel,
            'feriasModel' => $feriasModel,
        ]);
    }


    public function guardarFerias($model){
        foreach($model->ferias as $idFeria){
            $feriaProductor = new FeriaProductor();
            $feriaProductor->idProductor= $model->idProductor;
            $feriaProductor->idFeria= $idFeria;
            $feriaProductor->save();
            

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
        $provinciasModel = \yii\helpers\ArrayHelper::map(\app\models\Provincia::find()->where([])->orderBy(['nombre'=>SORT_ASC])->all(), 'idProvincia', 'nombre');
        $localidadesModel = \yii\helpers\ArrayHelper::map(\app\models\Localidad::find()->where([])->orderBy(['nombre'=>SORT_ASC])->all(), 'idLocalidad', 'nombre');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idProductor]);
        }

        return $this->render('update', [
            'model' => $model,
            'provinciasModel' => $provinciasModel,
            'localidadesModel' => $localidadesModel,
        ]);
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
        $this->findModel($id)->delete();

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
}
