<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "feria_productor".
 *
 * @property int $idFeria_productor
 * @property int|null $idFeria
 * @property int|null $idProductor
 */
class FeriaProductor extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'feria_productor';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idFeria', 'idProductor'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idFeria_productor' => 'Id Feria Productor',
            'idFeria' => 'Id Feria',
            'idProductor' => 'Id Productor',
        ];
    }

    /**
     * {@inheritdoc}
     * @return FeriaProductorQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new FeriaProductorQuery(get_called_class());
    }
}
