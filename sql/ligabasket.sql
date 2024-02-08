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
  `asistencias` int(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadisticas_jugador_partido`
--

CREATE TABLE `estadisticas_jugador_partido` (
  `id` int(6) UNSIGNED ZEROFILL NOT NULL,
  `id_jugador` int(6) UNSIGNED ZEROFILL NOT NULL,
  `id_partido` int(6) UNSIGNED ZEROFILL NOT NULL,
  `puntos` int(6) DEFAULT NULL,
  `rebotes` int(6) DEFAULT NULL,
  `asistencias` int(6) DEFAULT NULL,
  `minutos` int(6) DEFAULT NULL,
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
  `video` varchar(255) DEFAULT NULL COMMENT 'Vídeo promocional'
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
  `video` varchar(255) DEFAULT NULL COMMENT 'Vídeo promocional'
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
  ADD KEY `fk_id_idImagenL` (`id_escudo`);

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
  ADD KEY `fk_id_idPartidoJ` (`id_partido`);

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
  ADD CONSTRAINT `fk_id_idImagenL` FOREIGN KEY (`id_escudo`) REFERENCES `imagenes` (`id`);

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
  ADD CONSTRAINT `fk_id_idPartidoJ` FOREIGN KEY (`id_partido`) REFERENCES `partidos_jornada` (`id`);

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
