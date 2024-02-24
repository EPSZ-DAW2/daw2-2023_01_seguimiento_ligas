-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-01-2024 a las 12:02:11
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
DROP DATABASE IF EXISTS `daw2_2023_01_seguimiento_ligas_deportivas`;

--
-- Base de datos: `ligabasket`
--
CREATE DATABASE IF NOT EXISTS `daw2_2023_01_seguimiento_ligas_deportivas` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `daw2_2023_01_seguimiento_ligas_deportivas`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `anuncios_patrocinador`
--

CREATE TABLE `anuncios_patrocinador` (
  `id` int(6) UNSIGNED ZEROFILL NOT NULL,
  `id_patrocinador` int(6) UNSIGNED ZEROFILL NOT NULL,
  `texto_anuncio` varchar(255) DEFAULT NULL,
  `id_imagen` int(6) UNSIGNED ZEROFILL NOT NULL,
  `categoria` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE `comentarios` (
  `id` int(6) UNSIGNED ZEROFILL NOT NULL,
  `id_partido` int(6) UNSIGNED ZEROFILL NOT NULL,
  `id_usuario` int(6) UNSIGNED ZEROFILL NOT NULL,
  `fecha_hora` timestamp NOT NULL DEFAULT current_timestamp(),
  `texto_comentario` varchar(255) DEFAULT NULL,
  `id_comentario_padre` int(6) UNSIGNED ZEROFILL NOT NULL,
  `hilo_cerrado` tinyint(4) DEFAULT NULL,
  `num_denuncias` int(6) DEFAULT NULL,
  `bloqueado` tinyint(4) DEFAULT NULL,
  `fecha_hora_bloqueo` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipos`
--

CREATE TABLE `equipos` (
  `id` int(6) UNSIGNED ZEROFILL NOT NULL COMMENT 'Identificador interno del equipo',
  `id_liga` int(6) UNSIGNED ZEROFILL NOT NULL COMMENT 'Identificador de la liga',
  `id_temporada` int(6) UNSIGNED ZEROFILL NOT NULL COMMENT 'Identificador de la temporada',
  `nombre` varchar(100) NOT NULL COMMENT 'Nombre del equipo',
  `descripcion` varchar(200) NOT NULL COMMENT 'Descripción general del equipo',
  `id_escudo` int(6) UNSIGNED ZEROFILL NOT NULL COMMENT 'Identificador interno de la imagen del escudo',
  `n_jugadores` int(2) NOT NULL COMMENT 'Número de jugadores que componen el equipo',
  `gestor_eq` int(6) UNSIGNED ZEROFILL NULL COMMENT 'Gestor único del equipo',
  `video` varchar(255) DEFAULT NULL COMMENT 'Vídeo promocional'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipos_patrocinadores`
--

CREATE TABLE `equipos_patrocinadores` (
  `id_equipo` int(6) UNSIGNED ZEROFILL NOT NULL,
  `id_patrocinador` int(6) UNSIGNED ZEROFILL NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadisticas_equipo`
--

CREATE TABLE `estadisticas_equipo` (
  `id` int(6) UNSIGNED ZEROFILL NOT NULL,
  `id_temporada` int(6) UNSIGNED ZEROFILL NOT NULL,
  `id_equipo` int(6) UNSIGNED ZEROFILL NOT NULL,
  `partidos_jugados` int(6) DEFAULT NULL,
  `victorias` int(6) DEFAULT NULL,
  `derrotas` int(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadisticas_jugador`
--

CREATE TABLE `estadisticas_jugador` (
  `id` int(6) UNSIGNED ZEROFILL NOT NULL,
  `id_temporada` int(6) UNSIGNED ZEROFILL NOT NULL,
  `id_equipo` int(6) UNSIGNED ZEROFILL NOT NULL,
  `id_jugador` int(6) UNSIGNED ZEROFILL NOT NULL,
  `partidos_jugados` int(6) DEFAULT NULL,
  `puntos` int(6) DEFAULT NULL,
  `rebotes` int(6) DEFAULT NULL,
  `asistencias` int(6) DEFAULT NULL,
  `activo` tinyint DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadisticas_jugador_partido`
--

CREATE TABLE `estadisticas_jugador_partido` (
  `id` int(6) UNSIGNED ZEROFILL NOT NULL,
  `id_jugador` int(6) UNSIGNED ZEROFILL NOT NULL,
  `id_partido` int(6) UNSIGNED ZEROFILL NOT NULL,
  `id_equipo` int(6) UNSIGNED ZEROFILL NOT NULL,
  `puntos` int(6) DEFAULT NULL,
  `rebotes` int(6) DEFAULT NULL,
  `asistencias` int(6) DEFAULT NULL,
  `minutos` int(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenes`
--

CREATE TABLE `imagenes` (
  `id` int(6) UNSIGNED ZEROFILL NOT NULL COMMENT 'Identificador interno de la imagen',
  `foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jornadas_temporada`
--

CREATE TABLE `jornadas_temporada` (
  `id` int(6) UNSIGNED ZEROFILL NOT NULL,
  `id_temporada` int(6) UNSIGNED ZEROFILL NOT NULL,
  `numero` int(6) NOT NULL COMMENT 'Número de la jornada',
  `fecha_inicio` date NOT NULL,
  `fecha_final` date NOT NULL,
  `video` varchar(255) DEFAULT NULL COMMENT 'Vídeo promocional'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jugadores`
--

CREATE TABLE `jugadores` (
  `id` int(6) UNSIGNED ZEROFILL NOT NULL,
  `id_equipo` int(6) UNSIGNED ZEROFILL NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `id_imagen` int(6) UNSIGNED ZEROFILL NOT NULL,
  `posicion` varchar(50) DEFAULT NULL,
  `altura` double DEFAULT NULL,
  `peso` double DEFAULT NULL,
  `nacionalidad` varchar(50) DEFAULT NULL,
  `video` varchar(255) DEFAULT NULL COMMENT 'Vídeo promocional',
  `activo` tinyint DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ligas`
--

CREATE TABLE `ligas` (
  `id` int(6) UNSIGNED ZEROFILL NOT NULL COMMENT 'Identificador interno de la liga',
  `nombre` varchar(50) NOT NULL COMMENT 'Nombre común de la liga',
  `descripcion` varchar(255) NOT NULL COMMENT 'Descripción de la liga',
  `pais` varchar(50) NOT NULL COMMENT 'País en el que acontece la liga',
  `id_imagen` int(6) UNSIGNED ZEROFILL NOT NULL,
  `video` varchar(255) DEFAULT NULL COMMENT 'Vídeo promocional',
  `estado` varchar(255) DEFAULT NULL COMMENT 'Estado de la liga'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------




--
-- Estructura de tabla para la tabla `noticias`
--

CREATE TABLE `noticias` (
  `id` int(6) UNSIGNED ZEROFILL NOT NULL COMMENT 'Identificador interno de la noticia',
  `titular` varchar(100) NOT NULL COMMENT 'Titular de la noticia',
  `descripcion` varchar(300) NOT NULL COMMENT 'Descripción de la noticia',
  `texto` varchar(2000) NOT NULL COMMENT 'Texto de la noticia',
  `id_imagen` int(6) UNSIGNED ZEROFILL NOT NULL COMMENT 'Foto de la noticia',
  `id_creador` int(6) UNSIGNED ZEROFILL NOT NULL COMMENT 'Identificador del creador de la noticia',
  `fecha` date NOT NULL COMMENT 'Fecha de la noticia'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `partidos_jornada`
--

CREATE TABLE `partidos_jornada` (
  `id` int(6) UNSIGNED ZEROFILL NOT NULL,
  `id_jornada` int(6) UNSIGNED ZEROFILL NOT NULL,
  `id_equipo_local` int(6) UNSIGNED ZEROFILL NOT NULL,
  `id_equipo_visitante` int(6) UNSIGNED ZEROFILL NOT NULL,
  `horario` timestamp NULL DEFAULT NULL,
  `lugar` varchar(255) DEFAULT NULL,
  `resultado_local` int(6) DEFAULT NULL,
  `resultado_visitante` int(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `patrocinadores`
--

CREATE TABLE `patrocinadores` (
  `id` int(6) UNSIGNED ZEROFILL NOT NULL COMMENT 'Identificador interno del patrocinador',
  `nombre` varchar(50) NOT NULL COMMENT 'Nombre del patrocinador',
  `descripcion` varchar(200) NOT NULL COMMENT 'Descripción del patrocinador',
  `id_imagen` int(6) UNSIGNED ZEROFILL NOT NULL COMMENT 'Foto del patrocinador'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(6) UNSIGNED ZEROFILL NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `temporadas`
--

CREATE TABLE `temporadas` (
  `id` int(6) UNSIGNED ZEROFILL NOT NULL,
  `id_liga` int(6) UNSIGNED ZEROFILL NOT NULL COMMENT 'ID de la Liga a la que pertenece',
  `texto_de_titulo` varchar(50) DEFAULT NULL,
  `fecha_inicial` date DEFAULT NULL,
  `fecha_final` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(6) UNSIGNED ZEROFILL NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido1` varchar(50) NOT NULL,
  `apellido2` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `provincia` varchar(50) NOT NULL,
  `id_rol` int(6) UNSIGNED ZEROFILL NOT NULL,
  `username` varchar(50) NOT NULL,
  `id_imagen` int(6) UNSIGNED ZEROFILL NOT NULL COMMENT 'Foto del usuario (la de perfil)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------


--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `anuncios_patrocinador`
--
ALTER TABLE `anuncios_patrocinador`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_id_idAnuncio` (`id_patrocinador`),
  ADD KEY `fk_id_idImgPatrocinador` (`id_imagen`);

--
-- Indices de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_id_idPartido` (`id_partido`),
  ADD KEY `fk_id_idUsuario` (`id_usuario`),
  ADD KEY `fk_id_idComentarioPadre` (`id_comentario_padre`);

--
-- Indices de la tabla `equipos`
--
ALTER TABLE `equipos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_liga` (`id_liga`),
  ADD KEY `fk_idTemporada` (`id_temporada`),
  ADD KEY `fk_id_idImagenL` (`id_escudo`),
  ADD KEY `fk_gestor_eq` (`gestor_eq`);

--
-- Indices de la tabla `equipos_patrocinadores`
--
ALTER TABLE `equipos_patrocinadores`
  ADD KEY `fk_id_idEquipoEP` (`id_equipo`),
  ADD KEY `fk_id_idPatrocinadorEP` (`id_patrocinador`);

--
-- Indices de la tabla `estadisticas_equipo`
--
ALTER TABLE `estadisticas_equipo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_id_idEquipo` (`id_equipo`),
  ADD KEY `fk_id_idTemporada` (`id_temporada`);

--
-- Indices de la tabla `estadisticas_jugador`
--
ALTER TABLE `estadisticas_jugador`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_id_idTemporadaJ` (`id_temporada`),
  ADD KEY `fk_id_idJugador` (`id_jugador`),
  ADD KEY `fk_id_idEquipoEJ` (`id_equipo`);

--
-- Indices de la tabla `estadisticas_jugador_partido`
--
ALTER TABLE `estadisticas_jugador_partido`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_id_idJugadorP` (`id_jugador`),
  ADD KEY `fk_id_idPartidoJ` (`id_partido`),
  ADD KEY `fk_id_idEquipoE` (`id_equipo`);

--
-- Indices de la tabla `imagenes`
--
ALTER TABLE `imagenes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `jornadas_temporada`
--
ALTER TABLE `jornadas_temporada`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_temporada` (`id_temporada`);

--
-- Indices de la tabla `jugadores`
--
ALTER TABLE `jugadores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_id_idEJ` (`id_equipo`),
  ADD KEY `fk_id_idImgJugadores` (`id_imagen`);

--
-- Indices de la tabla `ligas`
--
ALTER TABLE `ligas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_id_idImgLigas` (`id_imagen`);

--
-- Indices de la tabla `noticias`
--
ALTER TABLE `noticias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_creador` (`id_creador`),
  ADD KEY `fk_id_idImgNoticias` (`id_imagen`);

--
-- Indices de la tabla `partidos_jornada`
--
ALTER TABLE `partidos_jornada`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_id_idEquipoLocal` (`id_equipo_local`),
  ADD KEY `fk_id_idEquipoVisitante` (`id_equipo_visitante`),
  ADD KEY `fk_id_idJornadaP` (`id_jornada`);

--
-- Indices de la tabla `patrocinadores`
--
ALTER TABLE `patrocinadores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_id_idImgPatrocinadores` (`id_imagen`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `temporadas`
--
ALTER TABLE `temporadas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_id_idTempLiga` (`id_liga`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_id_idRoles` (`id_rol`),
  ADD KEY `fk_id_idImagenU` (`id_imagen`);


--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `anuncios_patrocinador`
--
ALTER TABLE `anuncios_patrocinador`
  MODIFY `id` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `equipos`
--
ALTER TABLE `equipos`
  MODIFY `id` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'Identificador interno del equipo';

--
-- AUTO_INCREMENT de la tabla `estadisticas_equipo`
--
ALTER TABLE `estadisticas_equipo`
  MODIFY `id` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `estadisticas_jugador`
--
ALTER TABLE `estadisticas_jugador`
  MODIFY `id` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `estadisticas_jugador_partido`
--
ALTER TABLE `estadisticas_jugador_partido`
  MODIFY `id` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `imagenes`
--
ALTER TABLE `imagenes`
  MODIFY `id` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'Identificador interno de la imagen';

--
-- AUTO_INCREMENT de la tabla `jornadas_temporada`
--
ALTER TABLE `jornadas_temporada`
  MODIFY `id` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `jugadores`
--
ALTER TABLE `jugadores`
  MODIFY `id` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ligas`
--
ALTER TABLE `ligas`
  MODIFY `id` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'Identificador interno de la liga';

--
-- AUTO_INCREMENT de la tabla `noticias`
--
ALTER TABLE `noticias`
  MODIFY `id` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'Identificador interno de la noticia';

--
-- AUTO_INCREMENT de la tabla `partidos_jornada`
--
ALTER TABLE `partidos_jornada`
  MODIFY `id` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `patrocinadores`
--
ALTER TABLE `patrocinadores`
  MODIFY `id` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'Identificador interno del patrocinador';

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `temporadas`
--
ALTER TABLE `temporadas`
  MODIFY `id` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `anuncios_patrocinador`
--
ALTER TABLE `anuncios_patrocinador`
  ADD CONSTRAINT `fk_id_idAnuncio` FOREIGN KEY (`id_patrocinador`) REFERENCES `patrocinadores` (`id`),
  ADD CONSTRAINT `fk_id_idImgPatrocinador` FOREIGN KEY (`id_imagen`) REFERENCES `imagenes` (`id`);

--
-- Filtros para la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `fk_id_idComentarioPadre` FOREIGN KEY (`id_comentario_padre`) REFERENCES `comentarios` (`id`),
  ADD CONSTRAINT `fk_id_idPartido` FOREIGN KEY (`id_partido`) REFERENCES `partidos_jornada` (`id`),
  ADD CONSTRAINT `fk_id_idUsuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `equipos`
--
ALTER TABLE `equipos`
  ADD CONSTRAINT `equipos_ibfk_1` FOREIGN KEY (`id_liga`) REFERENCES `ligas` (`id`),
  ADD CONSTRAINT `fk_idTemporada` FOREIGN KEY (`id_temporada`) REFERENCES `temporadas` (`id`),
  ADD CONSTRAINT `fk_id_idImagenL` FOREIGN KEY (`id_escudo`) REFERENCES `imagenes` (`id`),
  ADD CONSTRAINT `fk_gestor_eq` FOREIGN KEY (`gestor_eq`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `equipos_patrocinadores`
--
ALTER TABLE `equipos_patrocinadores`
  ADD CONSTRAINT `fk_id_idEquipoEP` FOREIGN KEY (`id_equipo`) REFERENCES `equipos` (`id`),
  ADD CONSTRAINT `fk_id_idPatrocinadorEP` FOREIGN KEY (`id_patrocinador`) REFERENCES `patrocinadores` (`id`);

--
-- Filtros para la tabla `estadisticas_equipo`
--
ALTER TABLE `estadisticas_equipo`
  ADD CONSTRAINT `fk_id_idEquipo` FOREIGN KEY (`id_equipo`) REFERENCES `equipos` (`id`),
  ADD CONSTRAINT `fk_id_idTemporada` FOREIGN KEY (`id_temporada`) REFERENCES `temporadas` (`id`);

--
-- Filtros para la tabla `estadisticas_jugador`
--
ALTER TABLE `estadisticas_jugador`
  ADD CONSTRAINT `fk_id_idEquipoEJ` FOREIGN KEY (`id_equipo`) REFERENCES `equipos` (`id`),
  ADD CONSTRAINT `fk_id_idJugador` FOREIGN KEY (`id_jugador`) REFERENCES `jugadores` (`id`),
  ADD CONSTRAINT `fk_id_idTemporadaJ` FOREIGN KEY (`id_temporada`) REFERENCES `temporadas` (`id`);

--
-- Filtros para la tabla `estadisticas_jugador_partido`
--
ALTER TABLE `estadisticas_jugador_partido`
  ADD CONSTRAINT `fk_id_idJugadorP` FOREIGN KEY (`id_jugador`) REFERENCES `jugadores` (`id`),
  ADD CONSTRAINT `fk_id_idPartidoJ` FOREIGN KEY (`id_partido`) REFERENCES `partidos_jornada` (`id`),
  ADD CONSTRAINT `fk_id_idEquipoE` FOREIGN KEY (`id_equipo`) REFERENCES `equipos` (`id`);

--
-- Filtros para la tabla `jornadas_temporada`
--
ALTER TABLE `jornadas_temporada`
  ADD CONSTRAINT `jornadas_temporada_ibfk_1` FOREIGN KEY (`id_temporada`) REFERENCES `temporadas` (`id`);

--
-- Filtros para la tabla `jugadores`
--
ALTER TABLE `jugadores`
  ADD CONSTRAINT `fk_id_idEJ` FOREIGN KEY (`id_equipo`) REFERENCES `equipos` (`id`),
  ADD CONSTRAINT `fk_id_idImgJugadores` FOREIGN KEY (`id_imagen`) REFERENCES `imagenes` (`id`);

--
-- Filtros para la tabla `ligas`
--
ALTER TABLE `ligas`
  ADD CONSTRAINT `fk_id_idImgLigas` FOREIGN KEY (`id_imagen`) REFERENCES `imagenes` (`id`);

--
-- Filtros para la tabla `noticias`
--
ALTER TABLE `noticias`
  ADD CONSTRAINT `fk_id_idImgNoticias` FOREIGN KEY (`id_imagen`) REFERENCES `imagenes` (`id`),
  ADD CONSTRAINT `noticias_ibfk_1` FOREIGN KEY (`id_creador`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `partidos_jornada`
--
ALTER TABLE `partidos_jornada`
  ADD CONSTRAINT `fk_id_idEquipoLocal` FOREIGN KEY (`id_equipo_local`) REFERENCES `equipos` (`id`),
  ADD CONSTRAINT `fk_id_idEquipoVisitante` FOREIGN KEY (`id_equipo_visitante`) REFERENCES `equipos` (`id`),
  ADD CONSTRAINT `fk_id_idJornadaP` FOREIGN KEY (`id_jornada`) REFERENCES `jornadas_temporada` (`id`);

--
-- Filtros para la tabla `patrocinadores`
--
ALTER TABLE `patrocinadores`
  ADD CONSTRAINT `fk_id_idImgPatrocinadores` FOREIGN KEY (`id_imagen`) REFERENCES `imagenes` (`id`);

--
-- Filtros para la tabla `temporadas`
--
ALTER TABLE `temporadas`
  ADD CONSTRAINT `fk_id_idTempLiga` FOREIGN KEY (`id_liga`) REFERENCES `ligas` (`id`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_id_idRoles` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id`),
  ADD CONSTRAINT `fk_id_idImagenU` FOREIGN KEY (`id_imagen`) REFERENCES `imagenes` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


/* --------------  EJEMPLOS  --------------------------- */

-- INSERTAMOS LOS ROLES
INSERT IGNORE INTO `roles` (`nombre`) VALUES
('Superadministrador'),
('Administrador'),
('Moderador'),
('GestorLigas'),
('Patrocinador/Anunciante'),
('GestorEquipos'),
('Cliente');

INSERT IGNORE INTO `imagenes` (`foto`) VALUES
('perfil-blanco.png');

SET @imagen_perfil := LAST_INSERT_ID();

-- INSERTAMOS USUARIOS DE EJEMPLO
INSERT IGNORE INTO `usuarios` (`nombre`, `apellido1`, `apellido2`, `email`, `password`, `provincia`, `id_rol`, `username`, `id_imagen`) VALUES
('Administrador Supremo', 'superadmin', 'superadmin', 'superadmin@usal.es', '$2y$13$cv/e83DBf4PuC6DRYmDvqO3.4692vmpOS5vpzPxMMTgz9vyLS5lRu', 'Zamora', 1, 'superadmin', @imagen_perfil),
('Marcos', 'Castro', 'Aragón', 'admin@email.com', '$2y$13$cv/e83DBf4PuC6DRYmDvqO3.4692vmpOS5vpzPxMMTgz9vyLS5lRu', 'Zamora', 2, 'admin', @imagen_perfil),
('Iago', 'Gasamans', 'Losada', 'mod@email.com', '$2y$13$cv/e83DBf4PuC6DRYmDvqO3.4692vmpOS5vpzPxMMTgz9vyLS5lRu', 'Zamora', 3, 'moderador', @imagen_perfil),
('Jorge', 'Abella', 'Cabezas', 'gestorli@email.com', '$2y$13$cv/e83DBf4PuC6DRYmDvqO3.4692vmpOS5vpzPxMMTgz9vyLS5lRu', 'León', 4, 'gestorligas', @imagen_perfil),
('Álex', 'Alonso', 'Vicente', 'patrocinador@email.com', '$2y$13$cv/e83DBf4PuC6DRYmDvqO3.4692vmpOS5vpzPxMMTgz9vyLS5lRu', 'Zamora', 5, 'patrocinador', @imagen_perfil),
('David', 'Pérez', 'Esteban', 'gestoreq@email.com', '$2y$13$cv/e83DBf4PuC6DRYmDvqO3.4692vmpOS5vpzPxMMTgz9vyLS5lRu', 'Zamora', 6, 'gestorequipos', @imagen_perfil),
('Diego', 'Iglesias', 'Estevez', 'cliente@email.com', '$2y$13$cv/e83DBf4PuC6DRYmDvqO3.4692vmpOS5vpzPxMMTgz9vyLS5lRu', 'Zamora', 7, 'cliente', @imagen_perfil);


-- INSERTAMOS LAS IMAGENES DE LIGA NBA Y ACB
INSERT IGNORE INTO `imagenes` (`foto`) VALUES
('liga-nba.png');

SET @imagen_nba := LAST_INSERT_ID();

INSERT IGNORE INTO `imagenes` (`foto`) VALUES
('liga-acb.png');

SET @imagen_acb := LAST_INSERT_ID();


-- INSERTAMOS LAS LIGAS NBA Y ACB
INSERT IGNORE INTO `ligas` (`nombre`, `descripcion`, `pais`, `id_imagen`, `video`, `estado`) VALUES
('NBA', 'Liga Estadounidense de Basket', 'USA', @imagen_nba, 'https://www.youtube.com/embed/uUwb0x_AdL8?si=LIxT8Qet6JkIjksZ', 'Activa');

SET @id_nba := LAST_INSERT_ID();

INSERT IGNORE INTO `ligas` (`nombre`, `descripcion`, `pais`, `id_imagen`, `video`, `estado`) VALUES
('ACB', 'Liga Española, ahora llamada Endesa por patrocinio', 'España', @imagen_acb, 'https://www.youtube.com/embed/NQp5KW7rZ9k?si=iiWyQfFnMQf5EKWn', 'Activa');

SET @id_acb := LAST_INSERT_ID();

-- TEMPORADAS 2023-24 DE LAS LIGAS NBA Y ACB
INSERT IGNORE INTO `temporadas` (`id_liga`, `texto_de_titulo`, `fecha_inicial`, `fecha_final`) VALUES
(@id_nba, 'NBA 2024-25', '2024-10-20', '2025-04-20');

SET @temporada_nba24 := LAST_INSERT_ID();

INSERT IGNORE INTO `temporadas` (`id_liga`, `texto_de_titulo`, `fecha_inicial`, `fecha_final`) VALUES
(@id_nba, 'NBA 2023-24', '2023-10-24', '2024-04-14');

SET @temporada_nba23 := LAST_INSERT_ID();

INSERT IGNORE INTO `temporadas` (`id_liga`, `texto_de_titulo`, `fecha_inicial`, `fecha_final`) VALUES
(@id_nba, 'NBA 2022-23', '2022-10-18', '2023-04-09');

SET @temporada_nba21 := LAST_INSERT_ID();

INSERT IGNORE INTO `temporadas` (`id_liga`, `texto_de_titulo`, `fecha_inicial`, `fecha_final`) VALUES
(@id_nba, 'NBA 2021-22', '2021-10-19', '2022-04-10');

SET @temporada_nba21 := LAST_INSERT_ID();

INSERT IGNORE INTO `temporadas` (`id_liga`, `texto_de_titulo`, `fecha_inicial`, `fecha_final`) VALUES
(@id_acb, 'ACB 2024-25', '2024-09-14', '2025-06-13');

SET @temporada_acb24 := LAST_INSERT_ID();

INSERT IGNORE INTO `temporadas` (`id_liga`, `texto_de_titulo`, `fecha_inicial`, `fecha_final`) VALUES
(@id_acb, 'ACB 2023-24', '2023-09-23', '2024-06-24');

SET @temporada_acb23 := LAST_INSERT_ID();

INSERT IGNORE INTO `temporadas` (`id_liga`, `texto_de_titulo`, `fecha_inicial`, `fecha_final`) VALUES
(@id_acb, 'ACB 2022-23', '2022-09-17', '2023-06-22');

SET @temporada_acb22 := LAST_INSERT_ID();

INSERT IGNORE INTO `temporadas` (`id_liga`, `texto_de_titulo`, `fecha_inicial`, `fecha_final`) VALUES
(@id_acb, 'ACB 2021-22', '2021-09-18', '2022-06-19');

SET @temporada_acb21 := LAST_INSERT_ID();


-- INSERTAMOS LAS IMAGENES DE LOS ESCUDOS DE LOS EQUIPOS DE LA LIGA NBA Y ACB
INSERT IGNORE INTO `imagenes` (`foto`) VALUES
('lakers-logo.png');

SET @escudo_lakers := LAST_INSERT_ID();

INSERT IGNORE INTO `imagenes` (`foto`) VALUES
('realmadrid-logo.png');

SET @escudo_realmadrid := LAST_INSERT_ID();

INSERT IGNORE INTO `imagenes` (`foto`) VALUES
('Escudo_Covirán_Granada.png');

SET @escudo_granada:= LAST_INSERT_ID();

INSERT IGNORE INTO `imagenes` (`foto`) VALUES
('knicks.png');

SET @escudo_knicks:= LAST_INSERT_ID();

INSERT IGNORE INTO `imagenes` (`foto`) VALUES
('hawks.png');

SET @escudo_hawks:= LAST_INSERT_ID();

INSERT IGNORE INTO `imagenes` (`foto`) VALUES
('bulls.png');

SET @escudo_bulls:= LAST_INSERT_ID();

-- ALGUNOS EQUIPOS DE LA NBA Y ACB

INSERT IGNORE INTO `equipos` (`id_liga`, `id_temporada`, `nombre`, `descripcion`, `id_escudo`, `n_jugadores`) VALUES
(@id_nba, @temporada_nba23, 'Los Angeles Lakers', 'Equipo de División Pacífico de la Conferencia Oeste', @escudo_lakers, 15);

SET @lakers:= LAST_INSERT_ID();

INSERT IGNORE INTO `equipos` (`id_liga`, `id_temporada`, `nombre`, `descripcion`, `id_escudo`, `n_jugadores`) VALUES
(@id_nba, @temporada_nba23, 'New York Knicks', 'Equipo de División Atlántico de la Conferencia Este', @escudo_knicks, 15);

SET @knicks:= LAST_INSERT_ID();

INSERT IGNORE INTO `equipos` (`id_liga`, `id_temporada`, `nombre`, `descripcion`, `id_escudo`, `n_jugadores`) VALUES
(@id_nba, @temporada_nba23, 'Chicago Bulls', 'Equipo de División Central de la Conferencia Este', @escudo_bulls, 15);

SET @bulls:= LAST_INSERT_ID();

INSERT IGNORE INTO `equipos` (`id_liga`, `id_temporada`, `nombre`, `descripcion`, `id_escudo`, `n_jugadores`) VALUES
(@id_nba, @temporada_nba23, 'Atlanta Hawks', 'Equipo de División Sureste de la Conferencia Este', @escudo_hawks, 15);

SET @hawks:= LAST_INSERT_ID();

INSERT IGNORE INTO `equipos` (`id_liga`, `id_temporada`, `nombre`, `descripcion`, `id_escudo`, `n_jugadores`) VALUES
(@id_acb, @temporada_acb23, 'Real Madrid Baloncesto', 'Equipo de 1931 apodado los Blancos', @escudo_realmadrid, 14);

SET @realmadrid:= LAST_INSERT_ID();

INSERT IGNORE INTO `equipos` (`id_liga`, `id_temporada`, `nombre`, `descripcion`, `id_escudo`, `n_jugadores`) VALUES
(@id_acb, @temporada_acb23, 'Fundación CB Granada', 'Fundado en 2012 con presente y mucho futuro', @escudo_granada, 11);

SET @granada:= LAST_INSERT_ID();

-- ALGUNAS JORNADAS
INSERT IGNORE INTO `jornadas_temporada` (`id_temporada`, `numero`, `fecha_inicio`, `fecha_final`) VALUES
(@temporada_nba23, 1, '2023-10-24', '2023-10-29'),
(@temporada_nba23, 2, '2023-10-30', '2023-11-05'),
(@temporada_nba23, 3, '2023-11-06', '2023-11-12'),
(@temporada_nba23, 4, '2024-04-20', '2024-04-24'),
(@temporada_nba23, 5, '2024-05-01', '2024-05-03');

SET @j1nba := LAST_INSERT_ID();

INSERT IGNORE INTO `jornadas_temporada` (`id_temporada`, `numero`, `fecha_inicio`, `fecha_final`) VALUES
(@temporada_acb23, 1, '2023-09-23', '2023-09-24'),
(@temporada_acb23, 2, '2023-09-27', '2023-10-04'),
(@temporada_acb23, 3, '2024-03-10', '2024-03-12'),
(@temporada_acb23, 4, '2024-03-18', '2024-03-22'),
(@temporada_acb23, 5, '2024-04-03', '2024-04-06');

SET @j1acb := LAST_INSERT_ID();

-- PARTIDOS DE EJEMPLO

INSERT IGNORE INTO `partidos_jornada` (`id_jornada`, `id_equipo_local`, `id_equipo_visitante`, `horario`, `lugar`, `resultado_local`,`resultado_visitante`) VALUES 
(@j1acb, @realmadrid, @granada, '2023-09-23 18:30:00', 'WiZink Center Madrid', 83, 76);

INSERT IGNORE INTO `partidos_jornada` (`id_jornada`, `id_equipo_local`, `id_equipo_visitante`, `horario`, `lugar`) VALUES 
(@j1nba, @bulls, @knicks, '2024-09-25 20:00:00', 'United Center, Chicago, Illniois'),
(@j1nba, @lakers, @hawks, '2024-09-26 17:30:00', 'Crypto.com Arena, Los Ángeles, California');

INSERT IGNORE INTO `estadisticas_equipo` (`id_temporada`, `id_equipo`, `partidos_jugados`, `victorias`, `derrotas`) VALUES
(@temporada_acb23, @realmadrid, 15, 10, 5),
(@temporada_acb23, @lakers, 12, 9, 3),
(@temporada_acb22, @realmadrid, 30, 23, 7),
(@temporada_acb22, @hawks, 30, 22, 8),
(@temporada_acb22, @granada, 30, 18, 12);