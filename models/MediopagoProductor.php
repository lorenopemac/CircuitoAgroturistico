<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "mediopago_productor".
 *
 * @property int $idMediopago_productor
 * @property int $idMedio_pago
 * @property int $idProductor
 */
class MediopagoProductor extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mediopago_productor';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[ 'idMedio_pago', 'idProductor'], 'required'],
            [['idMediopago_productor', 'idMedio_pago', 'idProductor'], 'integer'],
            [['idMediopago_productor'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idMediopago_productor' => 'Id Mediopago Productor',
            'idMedio_pago' => 'Id Medio Pago',
            'idProductor' => 'Id Productor',
        ];
    }

    
}
