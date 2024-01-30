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

    /**
     * Filtra las ligas por el nombre.
     *
     * @param string|null $nombre
     * @return $this
     */
    public function nombre($nombre)
    {
        return $this->andWhere(['nombre' => $nombre]);
    }

    /**
     * Filtra las ligas por el país.
     *
     * @param string|null $pais
     * @return $this
     */
    public function pais($pais)
    {
        return $this->andWhere(['pais' => $pais]);
    }

    /**
     * Ordena las ligas por ID de forma descendente.
     *
     * @return $this
     */
    public function ordenarPorIdDesc()
    {
        return $this->orderBy(['id' => SORT_DESC]);
    }

    // Otros métodos de consulta pueden ser agregados según tus necesidades
}

