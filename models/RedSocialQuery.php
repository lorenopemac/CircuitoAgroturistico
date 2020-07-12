<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[RedSocial]].
 *
 * @see RedSocial
 */
class RedSocialQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return RedSocial[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return RedSocial|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
