<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Ligas]].
 *
 * @see Ligas
 */
class LigasQuery extends \yii\db\ActiveQuery
{
    /**
     * {@inheritdoc}
     * @return Ligas[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Ligas|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
