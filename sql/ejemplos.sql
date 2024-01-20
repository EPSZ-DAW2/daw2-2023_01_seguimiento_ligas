-- INSERTAMOS UNA IMAGEN DE EJEMPLO
INSERT INTO `imagenes` (`foto`) VALUES
('foto liga');

SET @id_liga := LAST_INSERT_ID();

INSERT INTO `imagenes` (`foto`) VALUES
('foto escudo');

SET @id_escudo := LAST_INSERT_ID();

INSERT INTO `imagenes` (`foto`) VALUES
('foto jugadores');

SET @id_jugadores := LAST_INSERT_ID();

-- INSERTAMOS UNA LIGA DE EJEMPLO
INSERT INTO `ligas` (`nombre`, `pais`, `id_imagen`) VALUES
('Liga ACB', 'España', @id_liga);


INSERT INTO `equipos` (`id_liga`, `nombre`, `descripcion`, `id_imagen_escudo`, `id_imagen`, `n_jugadores`) VALUES
(@id_liga, 'Suika FC', 'Equipo de Zamora enfocado en ganar', @id_escudo, @id_jugadores, 15);