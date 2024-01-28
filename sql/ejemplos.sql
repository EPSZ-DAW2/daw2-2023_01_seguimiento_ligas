-- INSERTAMOS LOS ROLES
INSERT IGNORE INTO `roles` (`nombre`) VALUES
('Administrador'),
('Moderador'),
('GestorLigas'),
('Patrocinador/Anunciante'),
('GestorEquipos'),
('Cliente');

-- INSERTAMOS USUARIOS DE EJEMPLO
INSERT IGNORE INTO `usuarios` (`nombre`, `apellido1`, `apellido2`, `email`, `password`, `provincia`, `id_rol`, `username`) VALUES
('Marcos', 'Castro', 'Aragón', 'admin@email.com', 'admin', 'Zamora', 1, 'admin'),
('Iago', 'Gasamans', 'Losada', 'mod@email.com', 'moderador', 'Zamora', 2, 'moderador'),
('Jorge', 'Abella', 'Cabezas', 'gestorli@email.com', 'gestorli', 'León', 3, 'gestor de ligas'),
('Álex', 'Alonso', 'Vicente', 'patrocinador@email.com', 'patrocinador', 'Zamora', 4, 'patrocinador'),
('David', 'Pérez', 'Esteban', 'gestoreq@email.com', 'gestoreq', 'Zamora', 5, 'gestor de equipos'),
('Diego', 'Iglesias', 'Estevez', 'cliente@email.com', 'cliente', 'Zamora', 6, 'cliente');


-- INSERTAMOS LAS IMAGENES DE LIGA NBA Y ACB
INSERT IGNORE INTO `imagenes` (`foto`) VALUES
('liga-nba.png');

SET @imagen_nba := LAST_INSERT_ID();

INSERT IGNORE INTO `imagenes` (`foto`) VALUES
('liga-acb.png');

SET @imagen_acb := LAST_INSERT_ID();


-- INSERTAMOS LAS LIGAS NBA Y ACB
INSERT IGNORE INTO `ligas` (`nombre`, `pais`, `id_imagen`) VALUES
('Liga NBA', 'USA', @imagen_nba);

SET @id_nba := LAST_INSERT_ID();

INSERT IGNORE INTO `ligas` (`nombre`, `pais`, `id_imagen`) VALUES
('Liga ACB', 'España', @imagen_acb);

SET @id_acb := LAST_INSERT_ID();

-- TEMPORADAS 2023-24 DE LAS LIGAS NBA Y ACB
INSERT IGNORE INTO `temporadas` (`id_liga`, `texto_de_titulo`, `fecha_inicial`, `fecha_final`) VALUES
(@id_nba, 'Liga NBA 2023-24', '2023-10-24', '2024-04-14');

SET @temporada_nba := LAST_INSERT_ID();

INSERT IGNORE INTO `temporadas` (`id_liga`, `texto_de_titulo`, `fecha_inicial`, `fecha_final`) VALUES
(@id_acb, 'Liga ACB 2023-24', '2023-09-23', '2024-06-24');

SET @temporada_acb := LAST_INSERT_ID();


-- INSERTAMOS LAS IMAGENES DE LOS ESCUDOS DE LOS EQUIPOS DE LA LIGA NBA Y ACB
INSERT IGNORE INTO `imagenes` (`foto`) VALUES
('lakers-logo.png');

SET @escudo_lakers := LAST_INSERT_ID();

INSERT IGNORE INTO `imagenes` (`foto`) VALUES
('realmadrid-logo.png');

SET @escudo_realmadrid := LAST_INSERT_ID();

-- ALGUNOS EQUIPOS DE LA NBA Y ACB

INSERT IGNORE INTO `equipos` (`id_liga`, `nombre`, `descripcion`, `id_escudo`, `n_jugadores`) VALUES
(@id_nba, 'Los Angeles Lakers', 'Equipo de División Pacífico de la Conferencia Oeste', @escudo_lakers, 15),
(@id_acb, 'Real Madrid Baloncesto', 'Equipo de 1931 apodado los Blancos', @escudo_realmadrid, 14);

-- ALGUNAS JORNADAS
INSERT IGNORE INTO `jornadas_temporada` (`id_temporada`, `numero`, `fecha_inicio`, `fecha_final`) VALUES
(@temporada_nba, 1, '2023-10-24', '2023-10-29'),
(@temporada_nba, 2, '2023-10-30', '2023-11-05'),
(@temporada_nba, 3, '2023-11-06', '2023-11-12'),
(@temporada_nba, 4, '2023-11-13', '2023-11-19'),
(@temporada_nba, 5, '2023-11-20', '2023-11-26'),
(@temporada_acb, 1, '2023-09-23', '2023-09-24'),
(@temporada_acb, 2, '2023-09-27', '2023-10-04'),
(@temporada_acb, 3, '2023-09-30', '2023-10-11'),
(@temporada_acb, 4, '2023-10-07', '2023-10-08'),
(@temporada_acb, 5, '2023-10-14', '2023-10-15');

SET @j5acb := LAST_INSERT_ID();

-- PARTIDOS DE EJEMPLO

INSERT IGNORE INTO `partidos_jornada` (`id_jornada`, `id_equipo_local`, `id_equipo_visitante`, `horario`, `lugar`) VALUES 
(@j5acb, @id_nba, @id_acb, '2024-03-04 18:30:00', 'WiZink Center Madrid');

INSERT IGNORE INTO `jugadores` (`id_equipo`, `nombre`, `descripcion`, `id_imagen`, `posicion`, `altura`, `peso`, `nacionalidad`) VALUES 
(000001, 'paco lopez', 'un rumano que le pega patadas al balon', @id_liga, 'delantero pichichi', 1.20, 300, 'Rumano');