<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "categoria".
 *
 * @property int $idCategoria
 * @property string $nombre
 * @property string|null $descripcion
 * @property bool $baja
 */
class Categoria extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'categoria';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre'], 'required'],
            [['baja'], 'boolean'],
            [['nombre'], 'string', 'max' => 65],
            [['descripcion'], 'string', 'max' => 150],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idCategoria' => 'Id Categoria',
            'nombre' => 'Nombre',
            'descripcion' => 'Descripcion',
            'baja' => 'Baja',
        ];
    }
}
