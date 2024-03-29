<?php

namespace backend\models\query;

/**
 * This is the ActiveQuery class for [[\backend\models\Companies]].
 *
 * @see \backend\models\Companies
 */
class CompaniesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \backend\models\Companies[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \backend\models\Companies|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
