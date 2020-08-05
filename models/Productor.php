<?php

namespace app\models;
use app\models\Provincia;
use app\models\Localidad;
use yii\helpers\Html;
use Yii;

/**
 * This is the model class for table "productor".
 *
 * @property int $idProductor
 * @property string $nombre
 * @property int $cuit
 * @property int $idLocalidad
 * @property int $idProvincia
 * @property string|null $nombreCalle
 * @property int|null $numeroCalle
 * @property int $numeroTelefono
 */
class Productor extends \yii\db\ActiveRecord
{

    public $ferias;
    public $imagenes;
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'productor';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'cuit', 'idLocalidad', 'idProvincia', 'numeroTelefono'], 'required'],
            [['cuit', 'idLocalidad', 'idProvincia', 'numeroCalle', 'numeroTelefono'], 'integer'],
            [['nombre'], 'string', 'max' => 45],
            [['nombreCalle'], 'string', 'max' => 100],
            [['latitud','longitud'], 'string', 'max' => 500],
            [['idProvincia'], 'exist', 'skipOnError' => true, 'targetClass' => Provincia::className(), 'targetAttribute' => ['idProvincia' => 'idProvincia']],
            [['idLocalidad'], 'exist', 'skipOnError' => true, 'targetClass' => Localidad::className(), 'targetAttribute' => ['idLocalidad' => 'idLocalidad']],
            ['ferias', 'each', 'rule' => ['integer']],
            [['imagenes'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg', 'maxFiles' => 4],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idProductor' => 'Id Productor',
            'nombre' => 'Nombre o Razón Social',
            'cuit' => 'Cuit',
            'idLocalidad' => 'Localidad',
            'idProvincia' => 'Provincia',
            'nombreCalle' => 'Nombre Calle',
            'numeroCalle' => 'Numero Calle',
            'numeroTelefono' => 'Numero Telefono',
        ];
    }


    public function upload($array)
    {
        $indice=0;
        if ($this->validate()) { 
            foreach ($this->imagenes as $file) {
                $file->saveAs(Yii::getAlias('@app')."/web/uploads/" . $array[$indice]->idImagen . '.' . $file->extension);
                $indice = $indice + 1;
            }
            return true;
        } else {
            return false;
        }
    }



    public function getImagenesProductor(){
        return $this->hasMany(ImagenProductor::className(), ['idProductor' => 'idProductor']);
    }


    /**
     * {@inheritdoc}
     * @return ProductorQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProductorQuery(get_called_class());
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProvincia()
    {
        return $this->hasOne(Provincia::className(), ['idProvincia' => 'idProvincia']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLocalidad()
    {
        return $this->hasOne(Localidad::className(), ['idLocalidad' => 'idLocalidad']);
    }

    public function getDisplayImage() {
        /*if (empty($model->imagenes)) {
            // if you do not want a placeholder
            $image = null;
    
            // else if you want to display a placeholder
            $image = Html::img(self::IMAGE_PLACEHOLDER, [
                'alt'=>Yii::t('app', 'No avatar yet'),
                'title'=>Yii::t('app', 'Upload your avatar by selecting browse below'),
                'class'=>'file-preview-image'
                // add a CSS class to make your image styling consistent
            ]);
        }
        else {
            
            $image = Html::img(Yii::$app->urlManager->baseUrl . '/uploads/' . $model->imagenes, [
                'alt'=>Yii::t('app', 'Avatar for ') ,
                'title'=>Yii::t('app', 'Click remove button below to remove this image'),
                'class'=>'file-preview-image'
                // add a CSS class to make your image styling consistent
            ]);
        }
    
        // enclose in a container if you wish with appropriate styles
        return ($image == null) ? null : 
            Html::tag('div', $image, ['class' => 'file-preview-frame']); */
    }

}
