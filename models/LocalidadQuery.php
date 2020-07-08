<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Localidad]].
 *
 * @see Localidad
 */
class LocalidadQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Localidad[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Localidad|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
