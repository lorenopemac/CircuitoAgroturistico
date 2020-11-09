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
        //BUSCO CATEGORIAS QUE NO SEAN AGROTURISMO
        $idsCategoria = \yii\helpers\ArrayHelper::map(\app\models\Categoria::find()->where(['baja'=>0,'esAgroturismo'=>1])->orderBy(['idCategoria'=>SORT_ASC])->all(), 'idCategoria', 'idCategoria');
        //PRODUCTOS PARA EL FILTRADO
        $productos = Producto::find()
                    ->joinWith('categorias')
                    ->where(['producto.baja'=>0,'idCategoria'=>$idsCategoria]) 
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



    /**
     * Updates an existing Categoria model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return productores filtrados
     */
    public function actionFiltrocategoria(){
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $params= Yii::$app->request->get();
        
        $productos = Producto::find()
                    ->joinWith('categorias')
                    ->where(['baja'=>0,'idCategoria'=>$params['idCategoria']]) 
                    ->all();
        $imagenes = array();//ARRAY CON NOMBRES DE LAS IMAGENES DE SALIDA
        foreach($productos as $producto){
            
            $productorImagen = ImagenProducto::find()
                                ->where(['idProducto'=>$producto->idProducto])
                                ->one();
            if($productorImagen){
                $imagen = Imagen::find()
                            ->where(['idImagen'=>$productorImagen->idImagen])
                            ->one();    
                array_push($imagenes,$imagen->idImagen.".".$imagen->extension);
            }else{
                array_push($imagenes,"default.png");
            }
        }
        
        return[
            'productos' => $productos,
            'imagenes' => $imagenes,
        ];
    }

    /**
     * @return productores filtrados
     */
    public function actionFiltroferia(){
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $params= Yii::$app->request->get();

        //BUSCO PRODUCTORES QUE PARTICIPEN EN LA FERIA DE PARAMETRO
        $productores = Productor::find()
                    ->joinWith('feriaproductor')
                    ->where(['baja'=>0,'idFeria'=>$params['idFeria']]) 
                    ->all();
        $arrayIds = array();
        foreach($productores as $productor){
            array_push($arrayIds,$productor->idProductor);
        }
        //FILTRO FERIAS QUE NO SEAN AGROTURISMO
        $idsCategoria = \yii\helpers\ArrayHelper::map(\app\models\Categoria::find()->where(['baja'=>0,'esAgroturismo'=>1])->orderBy(['idCategoria'=>SORT_ASC])->all(), 'idCategoria', 'idCategoria');
        $productos = Producto::find()
                    ->joinWith('productor')
                    ->joinWith('categorias')
                    ->where(['producto.baja'=>0,'producto.idProductor'=>$arrayIds,'idCategoria'=>$idsCategoria]) 
                    ->all();
        $imagenes = array();//ARRAY CON NOMBRES DE LAS IMAGENES DE SALIDA
        foreach($productos as $producto){
            $productorImagen = ImagenProducto::find()
                                ->where(['idProducto'=>$producto->idProducto])
                                ->one();
            if($productorImagen){
                $imagen = Imagen::find()
                            ->where(['idImagen'=>$productorImagen->idImagen])
                            ->one();    
                array_push($imagenes,$imagen->idImagen.".".$imagen->extension);
            }else{
                array_push($imagenes,"default.png");
            }
        }

        return[
            'productos' => $productos,
            'imagenes' => $imagenes,
        ];
    }
   

    /**
     * @return productores filtrados
     */
    public function actionFiltrolocalidad(){
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $params= Yii::$app->request->get();

        //BUSCO PRODUCTORES QUE PARTICIPEN EN LA FERIA DE PARAMETRO
        $productores = Productor::find()
                    ->where(['baja'=>0,'idLocalidad'=>$params['idLocalidad']]) 
                    ->all();
        //ARRAY DE IDS DE PRODUCTORES
        $arrayIds = array();
        foreach($productores as $productor){
            array_push($arrayIds,$productor->idProductor);
        }
        //BUSCO CATEGORIAS QUE NO SEAN AGROTURISMO
        $idsCategoria = \yii\helpers\ArrayHelper::map(\app\models\Categoria::find()->where(['baja'=>0,'esAgroturismo'=>1])->orderBy(['idCategoria'=>SORT_ASC])->all(), 'idCategoria', 'idCategoria');
        $productos = Producto::find()
                    ->joinWith('productor')
                    ->joinWith('categorias')
                    ->where(['producto.baja'=>0,'producto.idProductor'=>$arrayIds,'idCategoria'=>$idsCategoria]) 
                    ->all();

        $imagenes = array();//ARRAY CON NOMBRES DE LAS IMAGENES DE SALIDA
        foreach($productos as $producto){
            $productorImagen = ImagenProducto::find()
                                ->where(['idProducto'=>$producto->idProducto])
                                ->one();
            if($productorImagen){
                $imagen = Imagen::find()
                            ->where(['idImagen'=>$productorImagen->idImagen])
                            ->one();    
                array_push($imagenes,$imagen->idImagen.".".$imagen->extension);
            }else{
                array_push($imagenes,"default.png");
            }
        }

        return[
            'productos' => $productos,
            'imagenes' => $imagenes,
        ];
    }
}