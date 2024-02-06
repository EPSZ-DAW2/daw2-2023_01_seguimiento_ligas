-- INSERTAMOS LOS ROLES
INSERT IGNORE INTO `roles` (`nombre`) VALUES
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
('Marcos', 'Castro', 'Aragón', 'admin@email.com', '$2y$13$cv/e83DBf4PuC6DRYmDvqO3.4692vmpOS5vpzPxMMTgz9vyLS5lRu', 'Zamora', 1, 'admin', @imagen_perfil),
('Iago', 'Gasamans', 'Losada', 'mod@email.com', '$2y$13$cv/e83DBf4PuC6DRYmDvqO3.4692vmpOS5vpzPxMMTgz9vyLS5lRu', 'Zamora', 2, 'moderador', @imagen_perfil),
('Jorge', 'Abella', 'Cabezas', 'gestorli@email.com', '$2y$13$cv/e83DBf4PuC6DRYmDvqO3.4692vmpOS5vpzPxMMTgz9vyLS5lRu', 'León', 3, 'gestorligas', @imagen_perfil),
('Álex', 'Alonso', 'Vicente', 'patrocinador@email.com', '$2y$13$cv/e83DBf4PuC6DRYmDvqO3.4692vmpOS5vpzPxMMTgz9vyLS5lRu', 'Zamora', 4, 'patrocinador', @imagen_perfil),
('David', 'Pérez', 'Esteban', 'gestoreq@email.com', '$2y$13$cv/e83DBf4PuC6DRYmDvqO3.4692vmpOS5vpzPxMMTgz9vyLS5lRu', 'Zamora', 5, 'gestorequipos', @imagen_perfil),
('Diego', 'Iglesias', 'Estevez', 'cliente@email.com', '$2y$13$cv/e83DBf4PuC6DRYmDvqO3.4692vmpOS5vpzPxMMTgz9vyLS5lRu', 'Zamora', 6, 'cliente', @imagen_perfil);


-- INSERTAMOS LAS IMAGENES DE LIGA NBA Y ACB
INSERT IGNORE INTO `imagenes` (`foto`) VALUES
('liga-nba.png');

SET @imagen_nba := LAST_INSERT_ID();

INSERT IGNORE INTO `imagenes` (`foto`) VALUES
('liga-acb.png');

SET @imagen_acb := LAST_INSERT_ID();


-- INSERTAMOS LAS LIGAS NBA Y ACB
INSERT IGNORE INTO `ligas` (`nombre`, `descripcion`, `pais`, `id_imagen`, `video`) VALUES
('Liga NBA', 'Liga Estadounidense de Basket', 'USA', @imagen_nba, 'https://www.youtube.com/embed/uUwb0x_AdL8?si=LIxT8Qet6JkIjksZ');

SET @id_nba := LAST_INSERT_ID();

INSERT IGNORE INTO `ligas` (`nombre`, `descripcion`, `pais`, `id_imagen`, `video`) VALUES
('Liga ACB', 'Liga Española, ahora llamada Endesa por patrocinio', 'España', @imagen_acb, 'https://www.youtube.com/embed/NQp5KW7rZ9k?si=iiWyQfFnMQf5EKWn');

SET @id_acb := LAST_INSERT_ID();

-- TEMPORADAS 2023-24 DE LAS LIGAS NBA Y ACB
INSERT IGNORE INTO `temporadas` (`id_liga`, `texto_de_titulo`, `fecha_inicial`, `fecha_final`) VALUES
(@id_nba, 'Liga NBA 2024-25', '2024-10-20', '2025-04-20');

SET @temporada_nba24 := LAST_INSERT_ID();

INSERT IGNORE INTO `temporadas` (`id_liga`, `texto_de_titulo`, `fecha_inicial`, `fecha_final`) VALUES
(@id_nba, 'Liga NBA 2023-24', '2023-10-24', '2024-04-14');

SET @temporada_nba23 := LAST_INSERT_ID();

INSERT IGNORE INTO `temporadas` (`id_liga`, `texto_de_titulo`, `fecha_inicial`, `fecha_final`) VALUES
(@id_nba, 'Liga NBA 2022-23', '2022-10-18', '2023-04-09');

SET @temporada_nba21 := LAST_INSERT_ID();

INSERT IGNORE INTO `temporadas` (`id_liga`, `texto_de_titulo`, `fecha_inicial`, `fecha_final`) VALUES
(@id_nba, 'Liga NBA 2021-22', '2021-10-19', '2022-04-10');

SET @temporada_nba21 := LAST_INSERT_ID();

INSERT IGNORE INTO `temporadas` (`id_liga`, `texto_de_titulo`, `fecha_inicial`, `fecha_final`) VALUES
(@id_acb, 'Liga ACB 2024-25', '2024-09-14', '2025-06-13');

SET @temporada_acb24 := LAST_INSERT_ID();

INSERT IGNORE INTO `temporadas` (`id_liga`, `texto_de_titulo`, `fecha_inicial`, `fecha_final`) VALUES
(@id_acb, 'Liga ACB 2023-24', '2023-09-23', '2024-06-24');

SET @temporada_acb23 := LAST_INSERT_ID();

INSERT IGNORE INTO `temporadas` (`id_liga`, `texto_de_titulo`, `fecha_inicial`, `fecha_final`) VALUES
(@id_acb, 'Liga ACB 2022-23', '2022-09-17', '2023-06-22');

SET @temporada_acb22 := LAST_INSERT_ID();

INSERT IGNORE INTO `temporadas` (`id_liga`, `texto_de_titulo`, `fecha_inicial`, `fecha_final`) VALUES
(@id_acb, 'Liga ACB 2021-22', '2021-09-18', '2022-06-19');

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
(@temporada_nba23, 4, '2023-11-13', '2023-11-19'),
(@temporada_nba23, 5, '2023-11-20', '2023-11-26');

SET @j1nba := LAST_INSERT_ID();

INSERT IGNORE INTO `jornadas_temporada` (`id_temporada`, `numero`, `fecha_inicio`, `fecha_final`) VALUES
(@temporada_acb23, 1, '2023-09-23', '2023-09-24'),
(@temporada_acb23, 2, '2023-09-27', '2023-10-04'),
(@temporada_acb23, 3, '2023-09-30', '2023-10-11'),
(@temporada_acb23, 4, '2023-10-07', '2023-10-08'),
(@temporada_acb23, 5, '2023-10-14', '2023-10-15'),
(@temporada_acb23, 21, '2024-02-03', '2023-02-04'),
(@temporada_acb23, 22, '2024-02-10', '2023-02-11');

SET @j1acb := LAST_INSERT_ID();

-- PARTIDOS DE EJEMPLO

INSERT IGNORE INTO `partidos_jornada` (`id_jornada`, `id_equipo_local`, `id_equipo_visitante`, `horario`, `lugar`, `resultado_local`,`resultado_visitante`) VALUES 
(@j1acb, @realmadrid, @granada, '2023-09-23 18:30:00', 'WiZink Center Madrid', 83, 76);

INSERT IGNORE INTO `partidos_jornada` (`id_jornada`, `id_equipo_local`, `id_equipo_visitante`, `horario`, `lugar`) VALUES 
(@j1nba, @bulls, @knicks, '2024-09-25 20:00:00', 'United Center, Chicago, Illniois');

INSERT IGNORE INTO `partidos_jornada` (`id_jornada`, `id_equipo_local`, `id_equipo_visitante`, `horario`, `lugar`) VALUES 
(@j1nba, @lakers, @hawks, '2024-09-26 17:30:00', 'Crypto.com Arena, Los Ángeles, California');