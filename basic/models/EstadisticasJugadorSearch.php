<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\EstadisticasJugador;

class EstadisticasJugadorSearch extends EstadisticasJugador
{
    // Define los atributos para la búsqueda
    public function rules()
    {
        return [
            [['id', 'id_temporada', 'id_equipo', 'id_jugador', 'partidos_jugados', 'puntos', 'rebotes', 'asistencias'], 'safe'],
        ];
    }

    public function attributes()
    {
        return array_merge(parent::attributes(), [
            'jugador.nombre',
            'equipo.nombre',
            'temporada.texto_de_titulo',
        ]);
    }

    // Aplica los filtros de búsqueda
    public function search($params)
    {
        $query = EstadisticasJugador::find();
    
        // Configura las relaciones para poder buscar en ellas
        $query->joinWith(['equipo', 'jugador', 'temporada']);
    
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
    
        // Validación para cargar los datos con el formulario
        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }
    
        // Filtrar los datos con la relación
        $query->andFilterWhere([
            'estadisticas_jugador.id' => $this->id,
            'estadisticas_jugador.partidos_jugados' => $this->partidos_jugados,
            'estadisticas_jugador.puntos' => $this->puntos,
            'estadisticas_jugador.rebotes' => $this->rebotes,
            'estadisticas_jugador.asistencias' => $this->asistencias,
        ]);
    
        // Filtrar por nombre de jugador
        $query->andFilterWhere(['like', 'jugadores.nombre', $this->id_jugador]);
        
        // Filtrar por nombre de equipo
        $query->andFilterWhere(['like', 'equipos.nombre', $this->id_equipo]);
        
        // Filtrar por texto_de_titulo de temporada
        $query->andFilterWhere(['like', 'temporadas.texto_de_titulo', $this->id_temporada]);
    
        return $dataProvider;
    }    

}
