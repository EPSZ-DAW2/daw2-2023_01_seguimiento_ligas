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
(@id_nba, 'Temporada 2023-24 de la NBA', '2023-10-24', '2024-04-14');

INSERT IGNORE INTO `temporadas` (`id_liga`, `texto_de_titulo`, `fecha_inicial`, `fecha_final`) VALUES
(@id_acb, 'Liga ACB 2023-24', '2023-09-23', '2024-06-24');


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



INSERT IGNORE INTO `jugadores` (`id_equipo`, `nombre`, `descripcion`, `id_imagen`, `posicion`, `altura`, `peso`, `nacionalidad`) VALUES 
(000001, 'paco lopez', 'un rumano que le pega patadas al balon', @id_liga, 'delantero pichichi', 1.20, 300, 'Rumano');