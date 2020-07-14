<?php

namespace app\models;
use app\models\Provincia;
use app\models\Localidad;

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
 */
class Productor extends \yii\db\ActiveRecord
{

    public $ferias;
    public $imagenes;
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
            [['idProvincia'], 'exist', 'skipOnError' => true, 'targetClass' => Provincia::className(), 'targetAttribute' => ['idProvincia' => 'idProvincia']],
            [['idLocalidad'], 'exist', 'skipOnError' => true, 'targetClass' => Localidad::className(), 'targetAttribute' => ['idLocalidad' => 'idLocalidad']],
            ['ferias', 'each', 'rule' => ['integer']],
            [['imagenes'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg', 'maxFiles' => 4],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idProductor' => 'Id Productor',
            'nombre' => 'Nombre o Razón Social',
            'cuit' => 'Cuit',
            'idLocalidad' => 'Localidad',
            'idProvincia' => 'Provincia',
            'nombreCalle' => 'Nombre Calle',
            'numeroCalle' => 'Numero Calle',
            'numeroTelefono' => 'Numero Telefono',
        ];
    }


    public function upload()
    {
        if ($this->validate()) { 
            foreach ($this->imagenes as $file) {
                $file->saveAs('@app/uploads/' . $file->baseName . '.' . $file->extension);
            }
            return true;
        } else {
            return false;
        }
    }

    /**
     * {@inheritdoc}
     * @return ProductorQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProductorQuery(get_called_class());
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
