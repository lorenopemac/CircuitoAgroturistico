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
    public $imagenes;
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
            [['latitud','longitud'], 'string', 'max' => 500],
            [['idLocalidad'], 'integer'],
            [['imagenes'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg', 'maxFiles' => 4],
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

    public function upload($array)
    {
        $indice=0;
        if ($this->validate()) { 
            foreach ($this->imagenes as $file) {
                $file->saveAs(Yii::getAlias('@app')."/web/uploads/" . $array[$indice]->idImagen . '.' . $file->extension);
                $indice = $indice + 1;
            }
            return true;
        } else {
            return false;
        }
    }

    public function getImagenesFeria(){
        return $this->hasMany(ImagenFeria::className(), ['idFeria' => 'idFeria']);
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
