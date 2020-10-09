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
use app\models\Feria;
use app\models\Localidad;
use app\models\Productor;


/**
 * CategoriaController implements the CRUD actions for Categoria model.
 */
class CatalogoagroController extends Controller
{

    /**
     * Lists all Categoria models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout = 'catalogo';//LAYOUT SIN FOOT - HEAD
        $productos = Producto::find()
                    ->where(['baja'=>0]) 
                    ->all();
        //CATEGORIAS PARA EL FILTRADO
        $categorias = Categoria::find()
        ->where(['baja'=>0,'esAgroturismo'=>1]) 
        ->orderBy(['nombre'=>SORT_ASC])
        ->all();
        //FERIAS PARA EL FILTRADO
        $ferias = Feria::find()
        ->where(['baja'=>0]) 
        ->orderBy(['nombre'=>SORT_ASC])
        ->all();
        //LOCALIDADES PARA EL FILTRADO
        $localidades = Localidad::find()
        ->where(['baja'=>0]) 
        ->orderBy(['nombre'=>SORT_ASC])
        ->all();
        //TODOS LOS PRODUCTOS + IMAGENES SIN FILTRADO
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
            'categorias' => $categorias,
            'productos' => $productos,
            'ferias' => $ferias,
            'localidades' => $localidades,
        ]);
    }



}