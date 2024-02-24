<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[EstadisticasJugador]].
 *
 * @see EstadisticasJugador
 */
class EstadisticasJugadorQuery extends \yii\db\ActiveQuery
{
    /**
     * {@inheritdoc}
     * @return EstadisticasJugador[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return EstadisticasJugador|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
