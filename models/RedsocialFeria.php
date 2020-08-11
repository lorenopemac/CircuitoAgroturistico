<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "redsocial_Feria".
 *
 * @property int $idRedsocial_Feria
 * @property string $idRed_social
 * @property string $idFeria
 */
class RedsocialFeria extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'redsocial_Feria';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idRed_social', 'idFeria'], 'required'],
            [['idRed_social'], 'integer'],
            [['idFeria'], 'integer'],
            [['direccion'], 'string', 'max' => 150],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idRedsocial_Feria' => 'Id Redsocial Feria',
            'idRed_social' => 'Id Red Social',
            'idFeria' => 'Id Feria',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRedSocial()
    {
        return $this->hasOne(RedSocial::className(), ['idRed_social' => 'idRed_social']);
    }
}
