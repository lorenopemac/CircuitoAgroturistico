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
            [['nombre','idLocalidad'], 'required'],
            [['nombre'], 'string', 'max' => 45],
            [['idLocalidad'], 'integer'],
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
            'idLocalidad' => 'Localidad'
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProvincia()
    {
        return $this->hasOne(Provincia::className(), ['idProvincia' => 'idProvincia']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLocalidad()
    {
        return $this->hasOne(Localidad::className(), ['idLocalidad' => 'idLocalidad']);
    }
}
