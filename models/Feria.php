<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "feria".
 *
 * @property int $idFeria
 * @property string $nombre
 */
class Feria extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'feria';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre'], 'required'],
            [['nombre'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idFeria' => 'Id Feria',
            'nombre' => 'Nombre',
        ];
    }

    /**
     * {@inheritdoc}
     * @return FeriaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new FeriaQuery(get_called_class());
    }
}
