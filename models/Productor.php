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
 * @property string|null $facebook
 * @property string|null $Instagram
 * @property string|null $twitter
 * @property string|null $web
 */
class Productor extends \yii\db\ActiveRecord
{

    public $ferias;
    public $imagen;
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
            [['idProvincia'], 'exist', 'skipOnError' => true, 'targetClass' => Provincia::className(), 'targetAttribute' => ['idProvincia' => 'idProvincia']],
            [['idLocalidad'], 'exist', 'skipOnError' => true, 'targetClass' => Localidad::className(), 'targetAttribute' => ['idLocalidad' => 'idLocalidad']],
            ['ferias', 'each', 'rule' => ['integer']],
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
