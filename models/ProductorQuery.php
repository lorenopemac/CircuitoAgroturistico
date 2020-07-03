<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Productor]].
 *
 * @see Productor
 */
class ProductorQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Productor[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Productor|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
