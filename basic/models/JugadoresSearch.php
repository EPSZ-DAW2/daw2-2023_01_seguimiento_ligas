<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Jugadores;

class JugadoresSearch extends Jugadores
{
    public $nombre_equipo; // Variable para almacenar el nombre del equipo

    public function rules()
    {
        return [
            [['id', 'id_equipo', 'id_imagen'], 'integer'],
            [['nombre', 'descripcion', 'posicion', 'altura', 'peso', 'nacionalidad', 'video', 'nombre_equipo'], 'safe'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }
    
    public function search($params)
    {
        $query = Jugadores::find()->joinWith('equipo'); // Usa joinWith para acceder a la relación
    
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
    
        $this->load($params);
    
        if (!$this->validate()) {
            return $dataProvider;
        }
    
        $query->andFilterWhere([
            'jugadores.id' => $this->id,
            'jugadores.id_equipo' => $this->id_equipo,
            'jugadores.id_imagen' => $this->id_imagen,
        ]);
    
        $query->andFilterWhere(['like', 'jugadores.nombre', $this->nombre])
            ->andFilterWhere(['like', 'jugadores.descripcion', $this->descripcion])
            ->andFilterWhere(['like', 'jugadores.posicion', $this->posicion])
            ->andFilterWhere(['like', 'jugadores.altura', $this->altura])
            ->andFilterWhere(['like', 'jugadores.peso', $this->peso])
            ->andFilterWhere(['like', 'jugadores.nacionalidad', $this->nacionalidad])
            ->andFilterWhere(['like', 'jugadores.video', $this->video])
            ->andFilterWhere(['like', 'equipos.nombre', $this->nombre_equipo]); // Filtra por el nombre del equipo
    
        return $dataProvider;
    }
    
}
