<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "red_social".
 *
 * @property int $idRed_social
 * @property string $nombre
 * @property bool $baja
 */
class RedSocial extends \yii\db\ActiveRecord
{
    public $asignacion='Agregar';//para asignar productores a la red social
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'red_social';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre'], 'required'],
            [['baja'], 'boolean'],
            [['nombre'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idRed_social' => 'Id Red Social',
            'nombre' => 'Nombre',
            'baja' => 'Baja',
        ];
    }

    /**
     * {@inheritdoc}
     * @return RedSocialQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RedSocialQuery(get_called_class());
    }
}
