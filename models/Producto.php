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
