<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "usuario".
 *
 * @property int $idUsuario
 * @property string $usuario
 * @property string $password
 * @property bool $baja
 
 * @property int|null $id_rol
 */
class Usuario extends \yii\db\ActiveRecord
{
    public $passwordRepetida;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'usuario';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['usuario', 'password'], 'required'],
            [['baja'], 'boolean'],
            [[ 'id_rol'], 'integer'],
            [['usuario'], 'string', 'max' => 450],
            [['password','passwordRepetida'], 'string', 'max' => 550],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idUsuario' => 'Id Usuario',
            'usuario' => 'Usuario',
            'password' => 'Contraseña',
            'baja' => 'Baja',
            
            'id_rol' => 'Id Rol',
            'passwordRepetida' => 'Repetir Contraseña'
        ];
    }
    
}
