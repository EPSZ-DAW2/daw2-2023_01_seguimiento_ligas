-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-02-2024 a las 15:35:38
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `daw2_2023_01_seguimiento_ligas_deportivas`
--

DROP DATABASE IF EXISTS `daw2_2023_01_seguimiento_ligas_deportivas`;

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
  `gestor_eq` int(6) UNSIGNED ZEROFILL DEFAULT NULL COMMENT 'Gestor único del equipo',
  `video` varchar(255) DEFAULT NULL COMMENT 'Vídeo promocional'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `equipos`
--

INSERT INTO `equipos` (`id`, `id_liga`, `id_temporada`, `nombre`, `descripcion`, `id_escudo`, `n_jugadores`, `gestor_eq`, `video`) VALUES
(000001, 000002, 000006, 'Los Angeles Lakers', 'Equipo de División Pacífico de la Conferencia Oeste', 000004, 15, 000006, NULL),
(000002, 000001, 000002, 'New York Knicks', 'Equipo de División Atlántico de la Conferencia Este', 000007, 15, NULL, NULL),
(000003, 000001, 000002, 'Chicago Bulls', 'Equipo de División Central de la Conferencia Este', 000009, 15, NULL, NULL),
(000004, 000001, 000002, 'Atlanta Hawks', 'Equipo de División Sureste de la Conferencia Este', 000008, 15, NULL, NULL),
(000005, 000002, 000006, 'Real Madrid Baloncesto', 'Equipo de 1931 apodado los Blancos', 000005, 14, NULL, NULL),
(000006, 000002, 000006, 'Fundación CB Granada', 'Fundado en 2012 con presente y mucho futuro', 000006, 11, NULL, NULL);

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
  `derrotas` int(6) DEFAULT NULL,
  `empates` int(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `estadisticas_equipo`
--

INSERT INTO `estadisticas_equipo` (`id`, `id_temporada`, `id_equipo`, `partidos_jugados`, `victorias`, `derrotas`, `empates`) VALUES
(000001, 000006, 000005, 15, 10, 5, NULL),
(000002, 000006, 000001, 12, 9, 3, NULL),
(000003, 000007, 000005, 30, 23, 7, NULL),
(000004, 000007, 000004, 30, 22, 8, NULL),
(000005, 000007, 000006, 30, 18, 12, NULL),
(000006, 000001, 000003, NULL, NULL, NULL, NULL),
(000007, 000005, 000001, NULL, NULL, NULL, NULL);

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
  `puntos` float DEFAULT NULL,
  `rebotes` float DEFAULT NULL,
  `asistencias` float DEFAULT NULL,
  `activo` tinyint(4) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `estadisticas_jugador`
--

INSERT INTO `estadisticas_jugador` (`id`, `id_temporada`, `id_equipo`, `id_jugador`, `partidos_jugados`, `puntos`, `rebotes`, `asistencias`, `activo`) VALUES
(000006, 000002, 000001, 000006, 1, 12, 5, 7, 1),
(000007, 000002, 000001, 000007, 2, 5, 8.5, 1, 1),
(000009, 000001, 000002, 000009, 0, 0, 0, 0, 1),
(000010, 000002, 000004, 000010, 1, 3, 5, 7, 1),
(000011, 000001, 000004, 000011, 0, 0, 0, 0, 1),
(000012, 000005, 000005, 000012, 0, 0, 0, 0, 1),
(000013, 000005, 000005, 000013, 0, 0, 0, 0, 1),
(000014, 000005, 000006, 000014, 0, 0, 0, 0, 1);

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

--
-- Volcado de datos para la tabla `estadisticas_jugador_partido`
--

INSERT INTO `estadisticas_jugador_partido` (`id`, `id_jugador`, `id_partido`, `id_equipo`, `puntos`, `rebotes`, `asistencias`, `minutos`) VALUES
(000001, 000007, 000003, 000001, 11, 10, 2, 5),
(000002, 000010, 000003, 000004, 3, 5, 7, 12),
(000003, 000007, 000004, 000001, 0, 7, 0, 1),
(000005, 000006, 000004, 000001, 12, 5, 7, 23);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenes`
--

CREATE TABLE `imagenes` (
  `id` int(6) UNSIGNED ZEROFILL NOT NULL COMMENT 'Identificador interno de la imagen',
  `foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `imagenes`
--

INSERT INTO `imagenes` (`id`, `foto`) VALUES
(000001, 'perfil-blanco.png'),
(000002, 'liga-nba.png'),
(000003, 'liga-acb.png'),
(000004, 'lakers-logo.png'),
(000005, 'realmadrid-logo.png'),
(000006, 'Escudo_Covirán_Granada.png'),
(000007, 'knicks.png'),
(000008, 'hawks.png'),
(000009, 'bulls.png'),
(000010, 'davis.png'),
(000011, 'caruso.jpg'),
(000012, 'lavine.png'),
(000013, 'lonzo.jpg'),
(000014, 'vicevic.png'),
(000015, 'austin.jpg'),
(000016, 'R.png'),
(000017, 'bogdanovic.png'),
(000018, 'brunson.png'),
(000019, 'trae.jpg'),
(000020, 'capela.png'),
(000021, 'rudy.jpg'),
(000022, 'sin-foto.png'),
(000023, 'sin-foto.png');

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

--
-- Volcado de datos para la tabla `jornadas_temporada`
--

INSERT INTO `jornadas_temporada` (`id`, `id_temporada`, `numero`, `fecha_inicio`, `fecha_final`, `video`) VALUES
(000001, 000002, 1, '2023-10-24', '2023-10-29', NULL),
(000002, 000002, 2, '2023-10-30', '2023-11-05', NULL),
(000003, 000002, 3, '2023-11-06', '2023-11-12', NULL),
(000004, 000002, 4, '2024-04-20', '2024-04-24', NULL),
(000005, 000002, 5, '2024-05-01', '2024-05-03', NULL),
(000006, 000006, 1, '2023-09-23', '2023-09-24', NULL),
(000007, 000006, 2, '2023-09-27', '2023-10-04', NULL),
(000008, 000006, 3, '2024-03-10', '2024-03-12', NULL),
(000009, 000006, 4, '2024-03-18', '2024-03-22', NULL),
(000010, 000006, 5, '2024-04-03', '2024-04-06', NULL);

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
  `activo` tinyint(4) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `jugadores`
--

INSERT INTO `jugadores` (`id`, `id_equipo`, `nombre`, `descripcion`, `id_imagen`, `posicion`, `altura`, `peso`, `nacionalidad`, `video`, `activo`) VALUES
(000001, 000001, 'Anthony Davis', 'Ala-pívot apodado \"La Ceja\"', 000010, 'Ala-pívot', 2.11, 115, 'Estados Unidos de America', 'https://www.youtube.com/embed/0ufyaXWbsnc?si=mwk8hZpAGwNmjo37', 1),
(000002, 000003, 'Alex Caruso', 'Alero muy sacrificado y luchador', 000011, 'Alero', 1.93, 83.01, 'Estados Unidos de America', 'https://www.youtube.com/embed/eoT0S5gAJYY?si=_gsUw1sfnEWKDIuk', 1),
(000003, 000003, 'Zach Lavine', 'Escolta con gran potencia de salto', 000012, 'Escolta', 1.96, 91, 'Estados Unidos de America', '', 1),
(000004, 000003, 'Lonzo Ball', 'Base con buena visión de juego', 000013, 'Base', 1.98, 86, 'Estados Unidos de America', '', 1),
(000005, 000003, 'Nikola Vucevic', 'Pívot poderoso con grandes movimientos', 000014, 'Pívot', 2.11, 118, 'Montenegro', '', 1),
(000006, 000001, 'Austin Reeves', 'Escolta novato con gran proyección', 000015, 'Escolta', 1.96, 93, 'Estados Unidos de America', '', 1),
(000007, 000001, 'Lebron James', 'Alero considerado el mejor jugador de la historia', 000016, 'Alero', 2.06, 113, 'Estados Unidos de America', '', 0),
(000008, 000002, 'Bodjan Bogdanovic', 'Alero polivalente', 000017, 'Alero', 2.03, 103, 'Croacia', '', 1),
(000009, 000002, 'Jalen Brunson', 'Base sacrificado y con gran tiro de 3', 000018, 'Base', 1.85, 83, 'Estados Unidos de America', '', 1),
(000010, 000004, 'Trae Young', 'Base provocador con gran tiro', 000019, 'Base', 1.85, 82, 'Estados Unidos de America', '', 1),
(000011, 000004, 'Clint Capela', 'Pívot reboteador y luchador', 000020, 'Pívot', 2.08, 109, 'Suiza', '', 1),
(000012, 000005, 'Rudy Fernández', 'Alero con gran tiro de tres puntos', 000021, 'Alero', 1.95, 87, 'España', '', 1),
(000013, 000005, 'Facundo Campazzo', 'Base muy rápido y buen pasador', 000022, 'Base', 1.8, 88.5, 'Argentina', '', 1),
(000014, 000006, 'Cristiano Felicio', 'Pívot anotador y con gran presencia en la zona', 000023, 'Pívot', 2.11, 103, 'Brasil', '', 1);

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

--
-- Volcado de datos para la tabla `ligas`
--

INSERT INTO `ligas` (`id`, `nombre`, `descripcion`, `pais`, `id_imagen`, `video`, `estado`) VALUES
(000001, 'NBA', 'Liga Estadounidense de Basket', 'USA', 000002, 'https://www.youtube.com/embed/uUwb0x_AdL8?si=LIxT8Qet6JkIjksZ', 'Activa'),
(000002, 'ACB', 'Liga Española, ahora llamada Endesa por patrocinio', 'España', 000003, 'https://www.youtube.com/embed/NQp5KW7rZ9k?si=iiWyQfFnMQf5EKWn', 'Activa');

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

--
-- Volcado de datos para la tabla `partidos_jornada`
--

INSERT INTO `partidos_jornada` (`id`, `id_jornada`, `id_equipo_local`, `id_equipo_visitante`, `horario`, `lugar`, `resultado_local`, `resultado_visitante`) VALUES
(000001, 000006, 000005, 000006, '2023-09-23 18:30:00', 'WiZink Center Madrid', 83, 76),
(000005, 000006, 000006, 000005, '2023-09-23 20:00:00', 'Un estadio', NULL, NULL),
(000002, 000001, 000003, 000002, '2024-09-25 20:00:00', 'United Center, Chicago, Illniois', NULL, NULL),
(000003, 000001, 000001, 000004, '2024-09-26 17:30:00', 'Crypto.com Arena, Los Ángeles, California', NULL, NULL),
(000004, 000005, 000001, 000003, '2024-05-02 16:40:00', 'Aqui', NULL, NULL);

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

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `nombre`) VALUES
(000001, 'Superadministrador'),
(000002, 'Administrador'),
(000003, 'Moderador'),
(000004, 'GestorLigas'),
(000005, 'Patrocinador/Anunciante'),
(000006, 'GestorEquipos'),
(000007, 'Cliente');

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

--
-- Volcado de datos para la tabla `temporadas`
--

INSERT INTO `temporadas` (`id`, `id_liga`, `texto_de_titulo`, `fecha_inicial`, `fecha_final`) VALUES
(000001, 000001, 'NBA 2024-25', '2024-10-20', '2025-04-20'),
(000002, 000001, 'NBA 2023-24', '2023-10-24', '2024-04-14'),
(000003, 000001, 'NBA 2022-23', '2022-10-18', '2023-04-09'),
(000004, 000001, 'NBA 2021-22', '2021-10-19', '2022-04-10'),
(000005, 000002, 'ACB 2024-25', '2024-09-14', '2025-06-13'),
(000006, 000002, 'ACB 2023-24', '2023-09-23', '2024-06-24'),
(000007, 000002, 'ACB 2022-23', '2022-09-17', '2023-06-22'),
(000008, 000002, 'ACB 2021-22', '2021-09-18', '2022-06-19');

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

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellido1`, `apellido2`, `email`, `password`, `provincia`, `id_rol`, `username`, `id_imagen`) VALUES
(000001, 'Administrador Supremo', 'superadmin', 'superadmin', 'superadmin@usal.es', '$2y$13$cv/e83DBf4PuC6DRYmDvqO3.4692vmpOS5vpzPxMMTgz9vyLS5lRu', 'Zamora', 000001, 'superadmin', 000001),
(000002, 'Marcos', 'Castro', 'Aragón', 'admin@email.com', '$2y$13$cv/e83DBf4PuC6DRYmDvqO3.4692vmpOS5vpzPxMMTgz9vyLS5lRu', 'Zamora', 000002, 'admin', 000001),
(000003, 'Iago', 'Gasamans', 'Losada', 'mod@email.com', '$2y$13$cv/e83DBf4PuC6DRYmDvqO3.4692vmpOS5vpzPxMMTgz9vyLS5lRu', 'Zamora', 000003, 'moderador', 000001),
(000004, 'Jorge', 'Abella', 'Cabezas', 'gestorli@email.com', '$2y$13$cv/e83DBf4PuC6DRYmDvqO3.4692vmpOS5vpzPxMMTgz9vyLS5lRu', 'León', 000004, 'gestorligas', 000001),
(000005, 'Álex', 'Alonso', 'Vicente', 'patrocinador@email.com', '$2y$13$cv/e83DBf4PuC6DRYmDvqO3.4692vmpOS5vpzPxMMTgz9vyLS5lRu', 'Zamora', 000005, 'patrocinador', 000001),
(000006, 'David', 'Pérez', 'Esteban', 'gestoreq@email.com', '$2y$13$cv/e83DBf4PuC6DRYmDvqO3.4692vmpOS5vpzPxMMTgz9vyLS5lRu', 'Zamora', 000006, 'gestorequipos', 000001),
(000007, 'Diego', 'Iglesias', 'Estevez', 'cliente@email.com', '$2y$13$cv/e83DBf4PuC6DRYmDvqO3.4692vmpOS5vpzPxMMTgz9vyLS5lRu', 'Zamora', 000007, 'cliente', 000001);

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
  MODIFY `id` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'Identificador interno del equipo', AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `estadisticas_equipo`
--
ALTER TABLE `estadisticas_equipo`
  MODIFY `id` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `estadisticas_jugador`
--
ALTER TABLE `estadisticas_jugador`
  MODIFY `id` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `estadisticas_jugador_partido`
--
ALTER TABLE `estadisticas_jugador_partido`
  MODIFY `id` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `imagenes`
--
ALTER TABLE `imagenes`
  MODIFY `id` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'Identificador interno de la imagen', AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `jornadas_temporada`
--
ALTER TABLE `jornadas_temporada`
  MODIFY `id` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `jugadores`
--
ALTER TABLE `jugadores`
  MODIFY `id` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `ligas`
--
ALTER TABLE `ligas`
  MODIFY `id` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'Identificador interno de la liga', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `noticias`
--
ALTER TABLE `noticias`
  MODIFY `id` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'Identificador interno de la noticia';

--
-- AUTO_INCREMENT de la tabla `partidos_jornada`
--
ALTER TABLE `partidos_jornada`
  MODIFY `id` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `patrocinadores`
--
ALTER TABLE `patrocinadores`
  MODIFY `id` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'Identificador interno del patrocinador';

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `temporadas`
--
ALTER TABLE `temporadas`
  MODIFY `id` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(6) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
  ADD CONSTRAINT `fk_gestor_eq` FOREIGN KEY (`gestor_eq`) REFERENCES `usuarios` (`id`),
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
  ADD CONSTRAINT `fk_id_idEquipoE` FOREIGN KEY (`id_equipo`) REFERENCES `equipos` (`id`),
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
  ADD CONSTRAINT `fk_id_idImagenU` FOREIGN KEY (`id_imagen`) REFERENCES `imagenes` (`id`),
  ADD CONSTRAINT `fk_id_idRoles` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
