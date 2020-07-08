<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[FeriaProductor]].
 *
 * @see FeriaProductor
 */
class FeriaProductorQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return FeriaProductor[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return FeriaProductor|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
