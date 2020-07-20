<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "imagen_producto".
 *
 * @property int $idImagen_producto
 * @property int $idImagen
 * @property int $idProducto
 * @property bool $baja
 */
class ImagenProducto extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'imagen_producto';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idImagen', 'idProducto'], 'required'],
            [['idImagen', 'idProducto'], 'integer'],
            [['baja'], 'boolean'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idImagen_producto' => 'Id Imagen Producto',
            'idImagen' => 'Id Imagen',
            'idProducto' => 'Id Producto',
            'baja' => 'Baja',
        ];
    }
}
