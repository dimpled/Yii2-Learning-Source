<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Emp]].
 *
 * @see Emp
 */
class EmpQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return Emp[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Emp|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}