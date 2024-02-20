DROP TABLE IF EXISTS `anuncios_patrocinador`;
CREATE TABLE `anuncios_patrocinador` (
  `id` int(6) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `id_patrocinador` int(6) unsigned zerofill NOT NULL,
  `texto_anuncio` varchar(255) DEFAULT NULL,
  `id_imagen` int(6) unsigned zerofill NOT NULL,
  `categoria` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_id_idAnuncio` (`id_patrocinador`),
  KEY `fk_id_idImgPatrocinador` (`id_imagen`),
  CONSTRAINT `fk_id_idAnuncio` FOREIGN KEY (`id_patrocinador`) REFERENCES `patrocinadores` (`id`),
  CONSTRAINT `fk_id_idImgPatrocinador` FOREIGN KEY (`id_imagen`) REFERENCES `imagenes` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
DROP TABLE IF EXISTS `comentarios`;
CREATE TABLE `comentarios` (
  `id` int(6) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `id_partido` int(6) unsigned zerofill NOT NULL,
  `id_usuario` int(6) unsigned zerofill NOT NULL,
  `fecha_hora` timestamp NOT NULL DEFAULT current_timestamp(),
  `texto_comentario` varchar(255) DEFAULT NULL,
  `id_comentario_padre` int(6) unsigned zerofill NOT NULL,
  `hilo_cerrado` tinyint(4) DEFAULT NULL,
  `num_denuncias` int(6) DEFAULT NULL,
  `bloqueado` tinyint(4) DEFAULT NULL,
  `fecha_hora_bloqueo` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `fk_id_idPartido` (`id_partido`),
  KEY `fk_id_idUsuario` (`id_usuario`),
  KEY `fk_id_idComentarioPadre` (`id_comentario_padre`),
  CONSTRAINT `fk_id_idComentarioPadre` FOREIGN KEY (`id_comentario_padre`) REFERENCES `comentarios` (`id`),
  CONSTRAINT `fk_id_idPartido` FOREIGN KEY (`id_partido`) REFERENCES `partidos_jornada` (`id`),
  CONSTRAINT `fk_id_idUsuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
DROP TABLE IF EXISTS `equipos`;
CREATE TABLE `equipos` (
  `id` int(6) unsigned zerofill NOT NULL AUTO_INCREMENT COMMENT 'Identificador interno del equipo',
  `id_liga` int(6) unsigned zerofill NOT NULL COMMENT 'Identificador de la liga',
  `id_temporada` int(6) unsigned zerofill NOT NULL COMMENT 'Identificador de la temporada',
  `nombre` varchar(100) NOT NULL COMMENT 'Nombre del equipo',
  `descripcion` varchar(200) NOT NULL COMMENT 'Descripción general del equipo',
  `id_escudo` int(6) unsigned zerofill NOT NULL COMMENT 'Identificador interno de la imagen del escudo',
  `n_jugadores` int(2) NOT NULL COMMENT 'Número de jugadores que componen el equipo',
  `gestor_eq` int(6) unsigned zerofill DEFAULT NULL COMMENT 'Gestor único del equipo',
  `video` varchar(255) DEFAULT NULL COMMENT 'Vídeo promocional',
  PRIMARY KEY (`id`),
  KEY `id_liga` (`id_liga`),
  KEY `fk_idTemporada` (`id_temporada`),
  KEY `fk_id_idImagenL` (`id_escudo`),
  KEY `fk_gestor_eq` (`gestor_eq`),
  CONSTRAINT `equipos_ibfk_1` FOREIGN KEY (`id_liga`) REFERENCES `ligas` (`id`),
  CONSTRAINT `fk_gestor_eq` FOREIGN KEY (`gestor_eq`) REFERENCES `usuarios` (`id`),
  CONSTRAINT `fk_idTemporada` FOREIGN KEY (`id_temporada`) REFERENCES `temporadas` (`id`),
  CONSTRAINT `fk_id_idImagenL` FOREIGN KEY (`id_escudo`) REFERENCES `imagenes` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
INSERT INTO `equipos` (`id`,`id_liga`,`id_temporada`,`nombre`,`descripcion`,`id_escudo`,`n_jugadores`,`gestor_eq`,`video`) VALUES ('000001','000001','000002','Los Angeles Lakers','Equipo de División Pacífico de la Conferencia Oeste','000004','15','','');
INSERT INTO `equipos` (`id`,`id_liga`,`id_temporada`,`nombre`,`descripcion`,`id_escudo`,`n_jugadores`,`gestor_eq`,`video`) VALUES ('000002','000001','000002','New York Knicks','Equipo de División Atlántico de la Conferencia Este','000007','15','','');
INSERT INTO `equipos` (`id`,`id_liga`,`id_temporada`,`nombre`,`descripcion`,`id_escudo`,`n_jugadores`,`gestor_eq`,`video`) VALUES ('000003','000001','000002','Chicago Bulls','Equipo de División Central de la Conferencia Este','000009','15','','');
INSERT INTO `equipos` (`id`,`id_liga`,`id_temporada`,`nombre`,`descripcion`,`id_escudo`,`n_jugadores`,`gestor_eq`,`video`) VALUES ('000004','000001','000002','Atlanta Hawks','Equipo de División Sureste de la Conferencia Este','000008','15','','');
INSERT INTO `equipos` (`id`,`id_liga`,`id_temporada`,`nombre`,`descripcion`,`id_escudo`,`n_jugadores`,`gestor_eq`,`video`) VALUES ('000005','000002','000006','Real Madrid Baloncesto','Equipo de 1931 apodado los Blancos','000005','14','','');
INSERT INTO `equipos` (`id`,`id_liga`,`id_temporada`,`nombre`,`descripcion`,`id_escudo`,`n_jugadores`,`gestor_eq`,`video`) VALUES ('000006','000002','000006','Fundación CB Granada','Fundado en 2012 con presente y mucho futuro','000006','11','','');
DROP TABLE IF EXISTS `equipos_patrocinadores`;
CREATE TABLE `equipos_patrocinadores` (
  `id_equipo` int(6) unsigned zerofill NOT NULL,
  `id_patrocinador` int(6) unsigned zerofill NOT NULL,
  KEY `fk_id_idEquipoEP` (`id_equipo`),
  KEY `fk_id_idPatrocinadorEP` (`id_patrocinador`),
  CONSTRAINT `fk_id_idEquipoEP` FOREIGN KEY (`id_equipo`) REFERENCES `equipos` (`id`),
  CONSTRAINT `fk_id_idPatrocinadorEP` FOREIGN KEY (`id_patrocinador`) REFERENCES `patrocinadores` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
DROP TABLE IF EXISTS `estadisticas_equipo`;
CREATE TABLE `estadisticas_equipo` (
  `id` int(6) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `id_temporada` int(6) unsigned zerofill NOT NULL,
  `id_equipo` int(6) unsigned zerofill NOT NULL,
  `partidos_jugados` int(6) DEFAULT NULL,
  `victorias` int(6) DEFAULT NULL,
  `derrotas` int(6) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_id_idEquipo` (`id_equipo`),
  KEY `fk_id_idTemporada` (`id_temporada`),
  CONSTRAINT `fk_id_idEquipo` FOREIGN KEY (`id_equipo`) REFERENCES `equipos` (`id`),
  CONSTRAINT `fk_id_idTemporada` FOREIGN KEY (`id_temporada`) REFERENCES `temporadas` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
DROP TABLE IF EXISTS `estadisticas_jugador`;
CREATE TABLE `estadisticas_jugador` (
  `id` int(6) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `id_temporada` int(6) unsigned zerofill NOT NULL,
  `id_equipo` int(6) unsigned zerofill NOT NULL,
  `id_jugador` int(6) unsigned zerofill NOT NULL,
  `partidos_jugados` int(6) DEFAULT NULL,
  `puntos` int(6) DEFAULT NULL,
  `rebotes` int(6) DEFAULT NULL,
  `asistencias` int(6) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_id_idTemporadaJ` (`id_temporada`),
  KEY `fk_id_idJugador` (`id_jugador`),
  KEY `fk_id_idEquipoEJ` (`id_equipo`),
  CONSTRAINT `fk_id_idEquipoEJ` FOREIGN KEY (`id_equipo`) REFERENCES `equipos` (`id`),
  CONSTRAINT `fk_id_idJugador` FOREIGN KEY (`id_jugador`) REFERENCES `jugadores` (`id`),
  CONSTRAINT `fk_id_idTemporadaJ` FOREIGN KEY (`id_temporada`) REFERENCES `temporadas` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
DROP TABLE IF EXISTS `estadisticas_jugador_partido`;
CREATE TABLE `estadisticas_jugador_partido` (
  `id` int(6) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `id_jugador` int(6) unsigned zerofill NOT NULL,
  `id_partido` int(6) unsigned zerofill NOT NULL,
  `id_equipo` int(6) unsigned zerofill NOT NULL,
  `puntos` int(6) DEFAULT NULL,
  `rebotes` int(6) DEFAULT NULL,
  `asistencias` int(6) DEFAULT NULL,
  `minutos` int(6) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_id_idJugadorP` (`id_jugador`),
  KEY `fk_id_idPartidoJ` (`id_partido`),
  KEY `fk_id_idEquipoE` (`id_equipo`),
  CONSTRAINT `fk_id_idEquipoE` FOREIGN KEY (`id_equipo`) REFERENCES `equipos` (`id`),
  CONSTRAINT `fk_id_idJugadorP` FOREIGN KEY (`id_jugador`) REFERENCES `jugadores` (`id`),
  CONSTRAINT `fk_id_idPartidoJ` FOREIGN KEY (`id_partido`) REFERENCES `partidos_jornada` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
DROP TABLE IF EXISTS `imagenes`;
CREATE TABLE `imagenes` (
  `id` int(6) unsigned zerofill NOT NULL AUTO_INCREMENT COMMENT 'Identificador interno de la imagen',
  `foto` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
INSERT INTO `imagenes` (`id`,`foto`) VALUES ('000001','perfil-blanco.png');
INSERT INTO `imagenes` (`id`,`foto`) VALUES ('000002','liga-nba.png');
INSERT INTO `imagenes` (`id`,`foto`) VALUES ('000003','liga-acb.png');
INSERT INTO `imagenes` (`id`,`foto`) VALUES ('000004','lakers-logo.png');
INSERT INTO `imagenes` (`id`,`foto`) VALUES ('000005','realmadrid-logo.png');
INSERT INTO `imagenes` (`id`,`foto`) VALUES ('000006','Escudo_Covirán_Granada.png');
INSERT INTO `imagenes` (`id`,`foto`) VALUES ('000007','knicks.png');
INSERT INTO `imagenes` (`id`,`foto`) VALUES ('000008','hawks.png');
INSERT INTO `imagenes` (`id`,`foto`) VALUES ('000009','bulls.png');
INSERT INTO `imagenes` (`id`,`foto`) VALUES ('000015','');
INSERT INTO `imagenes` (`id`,`foto`) VALUES ('000021','Kobe_Bryant_8.jpg');
INSERT INTO `imagenes` (`id`,`foto`) VALUES ('000023','Kobe_Bryant_8.jpg');
INSERT INTO `imagenes` (`id`,`foto`) VALUES ('000026','');
INSERT INTO `imagenes` (`id`,`foto`) VALUES ('000027','');
INSERT INTO `imagenes` (`id`,`foto`) VALUES ('000028','Kobe_Bryant_8.jpg');
INSERT INTO `imagenes` (`id`,`foto`) VALUES ('000029','Kobe_Bryant_8.jpg');
DROP TABLE IF EXISTS `jornadas_temporada`;
CREATE TABLE `jornadas_temporada` (
  `id` int(6) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `id_temporada` int(6) unsigned zerofill NOT NULL,
  `numero` int(6) NOT NULL COMMENT 'Número de la jornada',
  `fecha_inicio` date NOT NULL,
  `fecha_final` date NOT NULL,
  `video` varchar(255) DEFAULT NULL COMMENT 'Vídeo promocional',
  PRIMARY KEY (`id`),
  KEY `id_temporada` (`id_temporada`),
  CONSTRAINT `jornadas_temporada_ibfk_1` FOREIGN KEY (`id_temporada`) REFERENCES `temporadas` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
INSERT INTO `jornadas_temporada` (`id`,`id_temporada`,`numero`,`fecha_inicio`,`fecha_final`,`video`) VALUES ('000001','000002','1','2023-10-24','2023-10-29','');
INSERT INTO `jornadas_temporada` (`id`,`id_temporada`,`numero`,`fecha_inicio`,`fecha_final`,`video`) VALUES ('000002','000002','2','2023-10-30','2023-11-05','');
INSERT INTO `jornadas_temporada` (`id`,`id_temporada`,`numero`,`fecha_inicio`,`fecha_final`,`video`) VALUES ('000003','000002','3','2023-11-06','2023-11-12','');
INSERT INTO `jornadas_temporada` (`id`,`id_temporada`,`numero`,`fecha_inicio`,`fecha_final`,`video`) VALUES ('000004','000002','4','2023-11-13','2023-11-19','');
INSERT INTO `jornadas_temporada` (`id`,`id_temporada`,`numero`,`fecha_inicio`,`fecha_final`,`video`) VALUES ('000005','000002','5','2023-11-20','2023-11-26','');
INSERT INTO `jornadas_temporada` (`id`,`id_temporada`,`numero`,`fecha_inicio`,`fecha_final`,`video`) VALUES ('000006','000006','1','2023-09-23','2023-09-24','');
INSERT INTO `jornadas_temporada` (`id`,`id_temporada`,`numero`,`fecha_inicio`,`fecha_final`,`video`) VALUES ('000007','000006','2','2023-09-27','2023-10-04','');
INSERT INTO `jornadas_temporada` (`id`,`id_temporada`,`numero`,`fecha_inicio`,`fecha_final`,`video`) VALUES ('000008','000006','3','2023-09-30','2023-10-11','');
INSERT INTO `jornadas_temporada` (`id`,`id_temporada`,`numero`,`fecha_inicio`,`fecha_final`,`video`) VALUES ('000009','000006','4','2023-10-07','2023-10-08','');
INSERT INTO `jornadas_temporada` (`id`,`id_temporada`,`numero`,`fecha_inicio`,`fecha_final`,`video`) VALUES ('000010','000006','5','2023-10-14','2023-10-15','');
INSERT INTO `jornadas_temporada` (`id`,`id_temporada`,`numero`,`fecha_inicio`,`fecha_final`,`video`) VALUES ('000011','000006','21','2024-02-03','2023-02-04','');
INSERT INTO `jornadas_temporada` (`id`,`id_temporada`,`numero`,`fecha_inicio`,`fecha_final`,`video`) VALUES ('000012','000006','22','2024-02-10','2023-02-11','');
DROP TABLE IF EXISTS `jugadores`;
CREATE TABLE `jugadores` (
  `id` int(6) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `id_equipo` int(6) unsigned zerofill NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `id_imagen` int(6) unsigned zerofill NOT NULL,
  `posicion` varchar(50) DEFAULT NULL,
  `altura` double DEFAULT NULL,
  `peso` double DEFAULT NULL,
  `nacionalidad` varchar(50) DEFAULT NULL,
  `video` varchar(255) DEFAULT NULL COMMENT 'Vídeo promocional',
  PRIMARY KEY (`id`),
  KEY `fk_id_idEJ` (`id_equipo`),
  KEY `fk_id_idImgJugadores` (`id_imagen`),
  CONSTRAINT `fk_id_idEJ` FOREIGN KEY (`id_equipo`) REFERENCES `equipos` (`id`),
  CONSTRAINT `fk_id_idImgJugadores` FOREIGN KEY (`id_imagen`) REFERENCES `imagenes` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
DROP TABLE IF EXISTS `ligas`;
CREATE TABLE `ligas` (
  `id` int(6) unsigned zerofill NOT NULL AUTO_INCREMENT COMMENT 'Identificador interno de la liga',
  `nombre` varchar(50) NOT NULL COMMENT 'Nombre común de la liga',
  `descripcion` varchar(255) NOT NULL COMMENT 'Descripción de la liga',
  `pais` varchar(50) NOT NULL COMMENT 'País en el que acontece la liga',
  `id_imagen` int(6) unsigned zerofill NOT NULL,
  `video` varchar(255) DEFAULT NULL COMMENT 'Vídeo promocional',
  PRIMARY KEY (`id`),
  KEY `fk_id_idImgLigas` (`id_imagen`),
  CONSTRAINT `fk_id_idImgLigas` FOREIGN KEY (`id_imagen`) REFERENCES `imagenes` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
INSERT INTO `ligas` (`id`,`nombre`,`descripcion`,`pais`,`id_imagen`,`video`) VALUES ('000001','NBA','Liga Estadounidense de Basket','USA','000002','https://www.youtube.com/embed/uUwb0x_AdL8?si=LIxT8Qet6JkIjksZ');
INSERT INTO `ligas` (`id`,`nombre`,`descripcion`,`pais`,`id_imagen`,`video`) VALUES ('000002','ACB','Liga Española, ahora llamada Endesa por patrocinio','España','000003','https://www.youtube.com/embed/NQp5KW7rZ9k?si=iiWyQfFnMQf5EKWn');
INSERT INTO `ligas` (`id`,`nombre`,`descripcion`,`pais`,`id_imagen`,`video`) VALUES ('000006','LEB plata','liga de 2 B Española','España ','000029','https://www.youtube.com/watch?v=fqckMbE9I00');
DROP TABLE IF EXISTS `noticias`;
CREATE TABLE `noticias` (
  `id` int(6) unsigned zerofill NOT NULL AUTO_INCREMENT COMMENT 'Identificador interno de la noticia',
  `titular` varchar(100) NOT NULL COMMENT 'Titular de la noticia',
  `descripcion` varchar(300) NOT NULL COMMENT 'Descripción de la noticia',
  `texto` varchar(2000) NOT NULL COMMENT 'Texto de la noticia',
  `id_imagen` int(6) unsigned zerofill NOT NULL COMMENT 'Foto de la noticia',
  `id_creador` int(6) unsigned zerofill NOT NULL COMMENT 'Identificador del creador de la noticia',
  `fecha` date NOT NULL COMMENT 'Fecha de la noticia',
  PRIMARY KEY (`id`),
  KEY `id_creador` (`id_creador`),
  KEY `fk_id_idImgNoticias` (`id_imagen`),
  CONSTRAINT `fk_id_idImgNoticias` FOREIGN KEY (`id_imagen`) REFERENCES `imagenes` (`id`),
  CONSTRAINT `noticias_ibfk_1` FOREIGN KEY (`id_creador`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
DROP TABLE IF EXISTS `partidos_jornada`;
CREATE TABLE `partidos_jornada` (
  `id` int(6) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `id_jornada` int(6) unsigned zerofill NOT NULL,
  `id_equipo_local` int(6) unsigned zerofill NOT NULL,
  `id_equipo_visitante` int(6) unsigned zerofill NOT NULL,
  `horario` timestamp NULL DEFAULT NULL,
  `lugar` varchar(255) DEFAULT NULL,
  `resultado_local` int(6) DEFAULT NULL,
  `resultado_visitante` int(6) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_id_idEquipoLocal` (`id_equipo_local`),
  KEY `fk_id_idEquipoVisitante` (`id_equipo_visitante`),
  KEY `fk_id_idJornadaP` (`id_jornada`),
  CONSTRAINT `fk_id_idEquipoLocal` FOREIGN KEY (`id_equipo_local`) REFERENCES `equipos` (`id`),
  CONSTRAINT `fk_id_idEquipoVisitante` FOREIGN KEY (`id_equipo_visitante`) REFERENCES `equipos` (`id`),
  CONSTRAINT `fk_id_idJornadaP` FOREIGN KEY (`id_jornada`) REFERENCES `jornadas_temporada` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
INSERT INTO `partidos_jornada` (`id`,`id_jornada`,`id_equipo_local`,`id_equipo_visitante`,`horario`,`lugar`,`resultado_local`,`resultado_visitante`) VALUES ('000001','000006','000005','000006','2023-09-23 18:30:00','WiZink Center Madrid','83','76');
INSERT INTO `partidos_jornada` (`id`,`id_jornada`,`id_equipo_local`,`id_equipo_visitante`,`horario`,`lugar`,`resultado_local`,`resultado_visitante`) VALUES ('000002','000001','000003','000002','2024-09-25 20:00:00','United Center, Chicago, Illniois','','');
INSERT INTO `partidos_jornada` (`id`,`id_jornada`,`id_equipo_local`,`id_equipo_visitante`,`horario`,`lugar`,`resultado_local`,`resultado_visitante`) VALUES ('000003','000001','000001','000004','2024-09-26 17:30:00','Crypto.com Arena, Los Ángeles, California','','');
DROP TABLE IF EXISTS `patrocinadores`;
CREATE TABLE `patrocinadores` (
  `id` int(6) unsigned zerofill NOT NULL AUTO_INCREMENT COMMENT 'Identificador interno del patrocinador',
  `nombre` varchar(50) NOT NULL COMMENT 'Nombre del patrocinador',
  `descripcion` varchar(200) NOT NULL COMMENT 'Descripción del patrocinador',
  `id_imagen` int(6) unsigned zerofill NOT NULL COMMENT 'Foto del patrocinador',
  PRIMARY KEY (`id`),
  KEY `fk_id_idImgPatrocinadores` (`id_imagen`),
  CONSTRAINT `fk_id_idImgPatrocinadores` FOREIGN KEY (`id_imagen`) REFERENCES `imagenes` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` int(6) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
INSERT INTO `roles` (`id`,`nombre`) VALUES ('000001','Superadministrador');
INSERT INTO `roles` (`id`,`nombre`) VALUES ('000002','Administrador');
INSERT INTO `roles` (`id`,`nombre`) VALUES ('000003','Moderador');
INSERT INTO `roles` (`id`,`nombre`) VALUES ('000004','GestorLigas');
INSERT INTO `roles` (`id`,`nombre`) VALUES ('000005','Patrocinador/Anunciante');
INSERT INTO `roles` (`id`,`nombre`) VALUES ('000006','GestorEquipos');
INSERT INTO `roles` (`id`,`nombre`) VALUES ('000007','Cliente');
DROP TABLE IF EXISTS `temporadas`;
CREATE TABLE `temporadas` (
  `id` int(6) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `id_liga` int(6) unsigned zerofill NOT NULL COMMENT 'ID de la Liga a la que pertenece',
  `texto_de_titulo` varchar(50) DEFAULT NULL,
  `fecha_inicial` date DEFAULT NULL,
  `fecha_final` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_id_idTempLiga` (`id_liga`),
  CONSTRAINT `fk_id_idTempLiga` FOREIGN KEY (`id_liga`) REFERENCES `ligas` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
INSERT INTO `temporadas` (`id`,`id_liga`,`texto_de_titulo`,`fecha_inicial`,`fecha_final`) VALUES ('000001','000001','NBA 2024-25','2024-10-20','2025-04-20');
INSERT INTO `temporadas` (`id`,`id_liga`,`texto_de_titulo`,`fecha_inicial`,`fecha_final`) VALUES ('000002','000001','NBA 2023-24','2023-10-24','2024-04-14');
INSERT INTO `temporadas` (`id`,`id_liga`,`texto_de_titulo`,`fecha_inicial`,`fecha_final`) VALUES ('000003','000001','NBA 2022-23','2022-10-18','2023-04-09');
INSERT INTO `temporadas` (`id`,`id_liga`,`texto_de_titulo`,`fecha_inicial`,`fecha_final`) VALUES ('000004','000001','NBA 2021-22','2021-10-19','2022-04-10');
INSERT INTO `temporadas` (`id`,`id_liga`,`texto_de_titulo`,`fecha_inicial`,`fecha_final`) VALUES ('000005','000002','ACB 2024-25','2024-09-14','2025-06-13');
INSERT INTO `temporadas` (`id`,`id_liga`,`texto_de_titulo`,`fecha_inicial`,`fecha_final`) VALUES ('000006','000002','ACB 2023-24','2023-09-23','2024-06-24');
INSERT INTO `temporadas` (`id`,`id_liga`,`texto_de_titulo`,`fecha_inicial`,`fecha_final`) VALUES ('000007','000002','ACB 2022-23','2022-09-17','2023-06-22');
INSERT INTO `temporadas` (`id`,`id_liga`,`texto_de_titulo`,`fecha_inicial`,`fecha_final`) VALUES ('000008','000002','ACB 2021-22','2021-09-18','2022-06-19');
DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `id` int(6) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `apellido1` varchar(50) NOT NULL,
  `apellido2` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `provincia` varchar(50) NOT NULL,
  `id_rol` int(6) unsigned zerofill NOT NULL,
  `username` varchar(50) NOT NULL,
  `id_imagen` int(6) unsigned zerofill NOT NULL COMMENT 'Foto del usuario (la de perfil)',
  PRIMARY KEY (`id`),
  KEY `fk_id_idRoles` (`id_rol`),
  KEY `fk_id_idImagenU` (`id_imagen`),
  CONSTRAINT `fk_id_idImagenU` FOREIGN KEY (`id_imagen`) REFERENCES `imagenes` (`id`),
  CONSTRAINT `fk_id_idRoles` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
INSERT INTO `usuarios` (`id`,`nombre`,`apellido1`,`apellido2`,`email`,`password`,`provincia`,`id_rol`,`username`,`id_imagen`) VALUES ('000001','Administrador Supremo','superadmin','superadmin','superadmin@usal.es','$2y$13$cv/e83DBf4PuC6DRYmDvqO3.4692vmpOS5vpzPxMMTgz9vyLS5lRu','Zamora','000001','superadmin','000001');
INSERT INTO `usuarios` (`id`,`nombre`,`apellido1`,`apellido2`,`email`,`password`,`provincia`,`id_rol`,`username`,`id_imagen`) VALUES ('000002','Marcos','Castro','Aragón','admin@email.com','$2y$13$cv/e83DBf4PuC6DRYmDvqO3.4692vmpOS5vpzPxMMTgz9vyLS5lRu','Zamora','000002','admin','000001');
INSERT INTO `usuarios` (`id`,`nombre`,`apellido1`,`apellido2`,`email`,`password`,`provincia`,`id_rol`,`username`,`id_imagen`) VALUES ('000003','Iago','Gasamans','Losada','mod@email.com','$2y$13$cv/e83DBf4PuC6DRYmDvqO3.4692vmpOS5vpzPxMMTgz9vyLS5lRu','Zamora','000003','moderador','000001');
INSERT INTO `usuarios` (`id`,`nombre`,`apellido1`,`apellido2`,`email`,`password`,`provincia`,`id_rol`,`username`,`id_imagen`) VALUES ('000004','Jorge','Abella','Cabezas','gestorli@email.com','$2y$13$cv/e83DBf4PuC6DRYmDvqO3.4692vmpOS5vpzPxMMTgz9vyLS5lRu','León','000004','gestorligas','000001');
INSERT INTO `usuarios` (`id`,`nombre`,`apellido1`,`apellido2`,`email`,`password`,`provincia`,`id_rol`,`username`,`id_imagen`) VALUES ('000005','Álex','Alonso','Vicente','patrocinador@email.com','$2y$13$cv/e83DBf4PuC6DRYmDvqO3.4692vmpOS5vpzPxMMTgz9vyLS5lRu','Zamora','000005','patrocinador','000001');
INSERT INTO `usuarios` (`id`,`nombre`,`apellido1`,`apellido2`,`email`,`password`,`provincia`,`id_rol`,`username`,`id_imagen`) VALUES ('000006','David','Pérez','Esteban','gestoreq@email.com','$2y$13$cv/e83DBf4PuC6DRYmDvqO3.4692vmpOS5vpzPxMMTgz9vyLS5lRu','Zamora','000006','gestorequipos','000001');
INSERT INTO `usuarios` (`id`,`nombre`,`apellido1`,`apellido2`,`email`,`password`,`provincia`,`id_rol`,`username`,`id_imagen`) VALUES ('000007','Diego','Iglesias','Estevez','cliente@email.com','$2y$13$cv/e83DBf4PuC6DRYmDvqO3.4692vmpOS5vpzPxMMTgz9vyLS5lRu','Zamora','000007','cliente','000001');
