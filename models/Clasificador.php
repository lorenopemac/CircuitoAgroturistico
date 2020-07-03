<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "clasificador".
 *
 * @property int $id
 * @property string $nombre
 * @property string|null $descripcion
 */
class Clasificador extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'clasificador';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre'], 'required'],
            [['nombre'], 'string', 'max' => 45],
            [['descripcion'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
            'descripcion' => 'Descripcion',
        ];
    }

    /**
     * {@inheritdoc}
     * @return ClasificadorQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ClasificadorQuery(get_called_class());
    }
}
