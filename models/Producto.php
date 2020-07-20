<?php

namespace app\models;
use app\models\Productor;
use Yii;

/**
 * This is the model class for table "producto".
 *
 * @property int $idProducto
 * @property string $nombre
 * @property string $descripcion
 * @property int $idProductor
 */
class Producto extends \yii\db\ActiveRecord
{
    public $imagenes;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'producto';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'descripcion','idProductor'], 'required'],
            [['nombre'], 'string', 'max' => 100],
            [['descripcion'], 'string', 'max' => 200],
            [['idProductor'], 'exist', 'skipOnError' => true, 'targetClass' => Productor::className(), 'targetAttribute' => ['idProductor' => 'idProductor']],
            [['imagenes'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg', 'maxFiles' => 4],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idProducto' => 'Id Producto',
            'nombre' => 'Nombre',
            'descripcion' => 'Descripcion',
            'idProductor'  => 'Productor'
        ];
    }

    public function upload($array)
    {
        $indice=0;
        if ($this->validate()) { 
            foreach ($this->imagenes as $file) {
                $file->saveAs('@app/uploads/' . $array[$indice]->idImagen . '.' . $file->extension);
                $indice = $indice + 1;
            }
            return true;
        } else {
            return false;
        }
    }

    public function getImagenesProducto(){
        return $this->hasMany(ImagenProducto::className(), ['idProducto' => 'idProducto']);
    }


    /**
     * {@inheritdoc}
     * @return ProductoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProductoQuery(get_called_class());
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductor()
    {
        return $this->hasOne(Productor::className(), ['idProductor' => 'idProductor']);
    }
}
