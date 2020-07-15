<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "imagen".
 *
 * @property int $idImagen
 * @property string $extension
 */
class Imagen extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'imagen';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['extension'], 'required'],
            [['extension'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idImagen' => 'Id Imagen',
            'extension' => 'Extension',
        ];
    }

    public function getImagen($idImagen){
        $imagen = Imagen::find()
                ->where(['idImagen' => $this->idObra, 'baja' => 0])
                ->one();
        return $imagen;
    }
}
