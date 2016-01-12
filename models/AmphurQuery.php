<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Amphur]].
 *
 * @see Amphur
 */
class AmphurQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return Amphur[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Amphur|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}