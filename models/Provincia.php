<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "provincia".
 *
 * @property int $idProvincia
 * @property string $nombre
 */
class Provincia extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'provincia';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre'], 'required'],
            [['nombre'], 'string', 'max' => 75],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idProvincia' => 'Id Provincia',
            'nombre' => 'Nombre',
        ];
    }

    /**
     * {@inheritdoc}
     * @return ProvinciaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProvinciaQuery(get_called_class());
    }
}
