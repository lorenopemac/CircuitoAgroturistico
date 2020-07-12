<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "localidad".
 *
 * @property int $idLocalidad
 * @property string $nombre
 * @property int $idProvincia
 * @property int|null $codigoPostal
 * @property string|null $localidadcol
 */
class Localidad extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'localidad';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'idProvincia'], 'required'],
            [['idProvincia', 'codigoPostal'], 'integer'],
            [['nombre'], 'string', 'max' => 100],
            [['localidadcol'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idLocalidad' => 'Id Localidad',
            'nombre' => ' Localidad',
            'idProvincia' => ' Provincia',
            'codigoPostal' => 'Codigo Postal',
            'localidadcol' => 'Localidadcol',
        ];
    }

    /**
     * {@inheritdoc}
     * @return LocalidadQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new LocalidadQuery(get_called_class());
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProvincia()
    {
        return $this->hasOne(Provincia::className(), ['idProvincia' => 'idProvincia']);
    }
}
