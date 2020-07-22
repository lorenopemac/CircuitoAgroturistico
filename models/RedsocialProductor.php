<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "redsocial_Productor".
 *
 * @property int $idRedsocial_Productor
 * @property int $idRed_social
 * @property int $idProductor
 * @property string $direccion
 */
class RedsocialProductor extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'redsocial_Productor';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idRed_social', 'idProductor', 'direccion'], 'required'],
            [['idRed_social', 'idProductor'], 'integer'],
            [['direccion'], 'string', 'max' => 150],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idRedsocial_Productor' => 'Id Redsocial Productor',
            'idRed_social' => 'Id Red Social',
            'idProductor' => 'Id Productor',
            'direccion' => 'Direccion',
        ];
    }
}
