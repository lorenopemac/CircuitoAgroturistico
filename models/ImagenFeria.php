<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "imagen_feria".
 *
 * @property int $idImagen_feria
 * @property int $idImagen
 * @property int $idFeria
 * @property bool $baja
 */
class ImagenFeria extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'imagen_feria';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idImagen', 'idFeria'], 'required'],
            [['idImagen', 'idFeria'], 'integer'],
            [['baja'], 'boolean'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idImagen_feria' => 'Id Imagen Feria',
            'idImagen' => 'Id Imagen',
            'idFeria' => 'Id Feria',
            'baja' => 'Baja',
        ];
    }
}
