<?php

namespace app\controllers;

use Yii;
use app\models\Feria;
use app\models\FeriaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

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
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idFeria]);
        }

        return $this->render('create', [
            'model' => $model,
            'localidadesModel' => $localidadesModel,
        ]);
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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->idFeria]);
        }

        return $this->render('update', [
            'model' => $model,
            'localidadesModel' => $localidadesModel,
        ]);
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
