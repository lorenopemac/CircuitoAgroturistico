<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "medio_pago".
 *
 * @property int $idMedio_pago
 * @property string $nombre
 * @property int|null $idImagen
 * @property bool $baja
 */
class MedioPago extends \yii\db\ActiveRecord
{
    public $imagen;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'medio_pago';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[ 'nombre'], 'required'],
            [['idMedio_pago', 'idImagen'], 'integer'],
            [['baja'], 'boolean'],
            [['nombre'], 'string', 'max' => 450],
            [['idMedio_pago'], 'unique'],
            [['imagen'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg', 'maxFiles' => 1],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idMedio_pago' => 'Id Medio Pago',
            'nombre' => 'Nombre',
            'idImagen' => 'Id Imagen',
            'baja' => 'Baja',
        ];
    }

    public function upload($modelImagen)
    {
        
        if ($this->validate()) {
            $this->imagen->saveAs(Yii::getAlias('@app')."/web/uploads/" . $modelImagen->idImagen . '.' . $modelImagen->extension);
            return true;
        } else {
            return false;
        }
    }
}
