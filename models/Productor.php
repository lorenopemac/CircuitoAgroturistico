<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "productor".
 *
 * @property int $id
 * @property string $nombre
 * @property string|null $direccion
 * @property string|null $email
 * @property string $cuit
 */
class Productor extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'productor';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'cuit'], 'required'],
            [['nombre', 'direccion'], 'string', 'max' => 30],
            [['email'], 'string', 'max' => 50],
            [['cuit'], 'string', 'max' => 20],
            ['email','email'],
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
            'direccion' => 'Direccion',
            'email' => 'Email',
            'cuit' => 'Cuit',
        ];
    }

    /**
     * {@inheritdoc}
     * @return ProductorQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProductorQuery(get_called_class());
    }
}
