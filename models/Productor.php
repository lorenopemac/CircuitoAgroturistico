<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "productor".
 *
 * @property int $idProductor
 * @property string $nombre
 * @property int $cuit
 * @property int $idLocalidad
 * @property int $idProvincia
 * @property string|null $nombreCalle
 * @property int|null $numeroCalle
 * @property int $numeroTelefono
 * @property string|null $facebook
 * @property string|null $Instagram
 * @property string|null $twitter
 * @property string|null $web
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
            [['nombre', 'cuit', 'idLocalidad', 'idProvincia', 'numeroTelefono'], 'required'],
            [['cuit', 'idLocalidad', 'idProvincia', 'numeroCalle', 'numeroTelefono'], 'integer'],
            [['nombre'], 'string', 'max' => 45],
            [['nombreCalle'], 'string', 'max' => 100],
            [['facebook', 'Instagram', 'twitter', 'web'], 'string', 'max' => 150],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idProductor' => 'Id Productor',
            'nombre' => 'Nombre',
            'cuit' => 'Cuit',
            'idLocalidad' => 'Localidad',
            'idProvincia' => 'Id Provincia',
            'nombreCalle' => 'Nombre Calle',
            'numeroCalle' => 'Numero Calle',
            'numeroTelefono' => 'Numero Telefono',
            'facebook' => 'Facebook',
            'Instagram' => 'Instagram',
            'twitter' => 'Twitter',
            'web' => 'Web',
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
