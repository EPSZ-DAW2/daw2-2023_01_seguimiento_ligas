<?php

namespace app\models;
use Yii;

/**
 * This is the model class for table "{{%comentarios}}".
 *
 * @property int $id
 * @property int $id_partido
 * @property int $id_usuario
 * @property string $fecha_hora
 * @property string|null $texto_comentario
 * @property int $id_comentario_padre
 * @property int|null $hilo_cerrado
 * @property int|null $num_denuncias
 * @property int|null $bloqueado
 * @property string|null $fecha_hora_bloqueo
 *
 * @property Usuario $usuario
 * @property Partido $partido
 * @property Comentario $comentarioPadre
 */

class Comentarios extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'comentarios';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_partido', 'id_usuario', 'fecha_hora', 'texto_comentario'], 'required'],
            [['id_partido', 'id_usuario', 'id_comentario_padre', 'num_denuncias'], 'integer'],
            [['fecha_hora', 'fecha_hora_bloqueo'], 'safe'],
            [['texto_comentario'], 'string', 'max' => 255],
            [['hilo_cerrado', 'bloqueado'], 'boolean'],
            [['id_partido'], 'exist', 'skipOnError' => true, 'targetClass' => PartidosJornada::class, 'targetAttribute' => ['id_partido' => 'id']],
            [['id_usuario'], 'exist', 'skipOnError' => true, 'targetClass' => Usuarios::class, 'targetAttribute' => ['id_usuario' => 'id']],
            [['id_comentario_padre'], 'exist', 'skipOnError' => true, 'targetClass' => Comentarios::class, 'targetAttribute' => ['id_comentario_padre' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_partido' => 'ID Partido',
            'id_usuario' => 'ID Usuario',
            'fecha_hora' => 'Fecha Hora',
            'texto_comentario' => 'Texto Comentario',
            'id_comentario_padre' => 'ID Comentario Padre',
            'hilo_cerrado' => 'Hilo Cerrado',
            'num_denuncias' => 'Num Denuncias',
            'bloqueado' => 'Bloqueado',
            'fecha_hora_bloqueo' => 'Fecha Hora Bloqueo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(Usuarios::class, ['id' => 'id_usuario']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPartido()
    {
        return $this->hasOne(PartidosJornada::class, ['id' => 'id_partido']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComentarioPadre()
    {
        return $this->hasOne(Comentarios::class, ['id' => 'id_comentario_padre']);
    }
}
