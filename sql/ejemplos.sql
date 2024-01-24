-- INSERTAMOS UNA IMAGEN DE EJEMPLO
INSERT IGNORE INTO `imagenes` (`foto`) VALUES
('web/liga_acb.jpeg');

SET @imagen_liga := LAST_INSERT_ID();

INSERT IGNORE INTO `imagenes` (`foto`) VALUES
('web/escudo_liga.jpeg');

SET @id_escudo := LAST_INSERT_ID();

INSERT IGNORE INTO `imagenes` (`foto`) VALUES
('foto jugadores');

SET @id_jugadores := LAST_INSERT_ID();

-- INSERTAMOS UNA LIGA DE EJEMPLO
INSERT IGNORE INTO `ligas` (`nombre`, `pais`, `id_imagen`) VALUES
('Liga ACB', 'España', @imagen_liga);

SET @id_liga := LAST_INSERT_ID();


INSERT IGNORE INTO `equipos` (`id_liga`, `nombre`, `descripcion`, `id_escudo`, `n_jugadores`) VALUES
(@id_liga, 'Suika CB', 'Equipo de Zamora enfocado en ganar', @id_escudo, 15),
(@id_liga, 'Zamora Basket', 'Los partidos se ganan en la cancha', @id_escudo, 21);

INSERT IGNORE INTO `temporadas` (`texto_de_titulo`, `fecha_inicial`, `fecha_final`) VALUES
('2023-2024', '2023-09-01', '2024-05-30');

INSERT IGNORE INTO `jugadores` (`id_equipo`, `nombre`, `descripcion`, `id_imagen`, `posicion`, `altura`, `peso`, `nacionalidad`) VALUES 
(000001, 'paco lopez', 'un rumano que le pega patadas al balon', @id_liga, 'delantero pichichi', 1.20, 300, 'Rumano');