<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Clasificador]].
 *
 * @see Clasificador
 */
class ClasificadorQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Clasificador[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Clasificador|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
