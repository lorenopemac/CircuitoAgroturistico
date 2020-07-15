<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "imagen_productor".
 *
 * @property int $idImagen_productor
 * @property int $idImagen
 * @property int $idProductor
 * @property bool $baja
 */
class ImagenProductor extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'imagen_productor';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idImagen', 'idProductor'], 'required'],
            [['idImagen', 'idProductor'], 'integer'],
            [['baja'], 'boolean'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idImagen_productor' => 'Id Imagen Productor',
            'idImagen' => 'Id Imagen',
            'idProductor' => 'Id Productor',
            'baja' => 'Baja',
        ];
    }
}
