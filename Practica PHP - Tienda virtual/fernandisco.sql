-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-01-2018 a las 03:45:28
-- Versión del servidor: 5.5.27
-- Versión de PHP: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `fernandisco`
--
CREATE DATABASE `fernandisco` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `fernandisco`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE IF NOT EXISTS `clientes` (
  `DNI` varchar(9) NOT NULL,
  `NOMBRE` varchar(30) NOT NULL,
  `DIRECCION` varchar(30) NOT NULL,
  `USUARIO` varchar(10) NOT NULL,
  `PASSWORD` varchar(32) NOT NULL,
  PRIMARY KEY (`DNI`,`USUARIO`),
  KEY `DNI` (`DNI`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`DNI`, `NOMBRE`, `DIRECCION`, `USUARIO`, `PASSWORD`) VALUES
('11111111A', 'Antonio', 'Calle Dos 12', 'usuario', '202cb962ac59075b964b07152d234b70'),
('12345678C', 'Fernando', 'Calle Falsa 123', 'admin', '21232f297a57a5a743894a0e4a801fc3'),
('987654321', 'Luis', 'Calle Tres', 'Luis3', '202cb962ac59075b964b07152d234b70');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `familia`
--

CREATE TABLE IF NOT EXISTS `familia` (
  `COD` int(6) NOT NULL AUTO_INCREMENT,
  `NOMBRE` varchar(200) NOT NULL,
  PRIMARY KEY (`COD`),
  KEY `COD` (`COD`),
  KEY `COD_2` (`COD`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `familia`
--

INSERT INTO `familia` (`COD`, `NOMBRE`) VALUES
(1, 'Rock'),
(2, 'Pop'),
(3, 'Reggae'),
(4, 'Jazz'),
(5, 'Blues'),
(6, 'Flamenco');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lineas`
--

CREATE TABLE IF NOT EXISTS `lineas` (
  `NUM_PEDIDO` int(4) NOT NULL,
  `NUM_LINEA` int(11) NOT NULL,
  `PRODUCTO` varchar(150) NOT NULL,
  `PRECIO` decimal(9,2) NOT NULL,
  PRIMARY KEY (`NUM_PEDIDO`,`NUM_LINEA`),
  KEY `NUM_PEDIDO` (`NUM_PEDIDO`),
  KEY `NUM_LINEA` (`NUM_LINEA`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `lineas`
--

INSERT INTO `lineas` (`NUM_PEDIDO`, `NUM_LINEA`, `PRODUCTO`, `PRECIO`) VALUES
(35, 1, 'The Dark Side of the Moon', 12.50),
(35, 2, 'Nevermind', 18.25),
(36, 1, 'The Dark Side of the Moon', 12.50),
(36, 3, '21', 13.95),
(36, 8, 'Giant Steps', 5.99),
(37, 2, 'Nevermind', 18.25),
(37, 5, 'Legend', 5.99),
(37, 12, 'La leyenda del tiempo', 28.50);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE IF NOT EXISTS `pedidos` (
  `NUM_PEDIDO` int(4) NOT NULL AUTO_INCREMENT,
  `DNI` varchar(9) NOT NULL,
  `FECHA` date NOT NULL,
  `TOTAL_PEDIDO` decimal(9,2) NOT NULL,
  PRIMARY KEY (`NUM_PEDIDO`),
  KEY `NUM_PEDIDO` (`NUM_PEDIDO`),
  KEY `DNI` (`DNI`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=38 ;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`NUM_PEDIDO`, `DNI`, `FECHA`, `TOTAL_PEDIDO`) VALUES
(35, '12345678C', '2018-01-13', 55.75),
(36, '11111111A', '2018-01-13', 85.34),
(37, '987654321', '2018-01-13', 52.74);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE IF NOT EXISTS `producto` (
  `COD` int(12) NOT NULL AUTO_INCREMENT,
  `NOMBRE` varchar(200) NOT NULL,
  `NOMBRE_CORTO` varchar(50) NOT NULL,
  `DESCRIPCION` text NOT NULL,
  `PVP` decimal(9,2) NOT NULL,
  `FAMILIA` int(10) NOT NULL,
  `STOCK` int(3) NOT NULL,
  PRIMARY KEY (`COD`),
  KEY `COD` (`COD`),
  KEY `PVP` (`PVP`),
  KEY `FAMILIA` (`FAMILIA`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`COD`, `NOMBRE`, `NOMBRE_CORTO`, `DESCRIPCION`, `PVP`, `FAMILIA`, `STOCK`) VALUES
(1, 'The Dark Side of the Moon', 'Pink Floyd', 'The Dark Side of the Moon –en español: «El Lado oscuro de la Luna»– es un álbum conceptual, el octavo de estudio de la banda británica de rock progresivo Pink Floyd.', 12.50, 1, 28),
(2, 'Nevermind', 'Nirvana', 'Nevermind es el segundo álbum de estudio de la banda estadounidense Nirvana, publicado el 24 de septiembre de 1991. Producido por Butch Vig, Nevermind fue el primer lanzamiento de la banda con DGC Records', 18.25, 1, 34),
(3, '21', 'Adele', '21 es el segundo álbum de estudio de la cantautora británica Adele, ', 13.95, 2, 21),
(4, 'Off the Wall', 'Michael Jackson ', 'Off the Wall es el quinto álbum solista de Michael Jackson editado en 1979. Con alrededor de 20 millones de copias vendidas en todo el mundo', 8.75, 2, 19),
(5, 'Legend', 'Bob Marley', 'Legend es un álbum de grandes éxitos de Bob Marley and the Wailers publicado el 8 de mayo de 1984 a través de Island Records', 5.99, 3, 7),
(6, 'Guess Who''s Coming', 'Black Uhuru', 'El origen del nombre de “Black Uhuru” proviene del Swahili, que se traduce como «Libertad». Por ende, su traducción sería «Libertad Negra»', 10.15, 3, 12),
(7, 'Live in Paris', 'Diana krall', 'Live in Paris es el séptimo álbum de la pianista y cantante de Jazz canadiense Diana Krall, editado en 2002.', 6.99, 4, 14),
(8, 'Giant Steps', 'John Coltrane', 'Giant Steps es el quinto álbum de estudio de John Coltrane como líder. El álbum, su primera grabación para Atlantic Records, fue grabado entre mayo y diciembre de 1959', 5.99, 4, 18),
(9, 'Live at the Regal', 'B. B. King', 'Cuarto album de 1965', 10.99, 5, 25),
(10, 'From the Cradle', 'Eric clapton', 'Disco de versiones estándar de blues. Canciones que le han acompañado desde joven, canciones de su vida, de sus “bluesman” preferidos, que quiso plasmar en este álbum donde se da el gusto, por que el blues, es el camino que siempre ha querido seguir.', 7.99, 5, 24),
(11, 'Joyas prestadas', 'Niña pastori', 'Joyas Prestadas es el sexto álbum de Niña Pastori, versionando canciones de distintos artistas, e incluye canciones de autores como Serrat, Alejandro Sanz, Manolo García, Juan Luis Guerra entre otros, en el inconfundible estilo de Niña Pastori', 9.90, 6, 22),
(12, 'La leyenda del tiempo', 'Camaron de la isla', 'La leyenda del tiempo es el décimo álbum del cantaor andaluz Camarón. Está considerada una de las obras más importantes de la historia del flamenco', 28.50, 6, 39);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `lineas`
--
ALTER TABLE `lineas`
  ADD CONSTRAINT `lineas_ibfk_1` FOREIGN KEY (`NUM_PEDIDO`) REFERENCES `pedidos` (`NUM_PEDIDO`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lineas_ibfk_2` FOREIGN KEY (`NUM_LINEA`) REFERENCES `producto` (`COD`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`DNI`) REFERENCES `clientes` (`DNI`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`FAMILIA`) REFERENCES `familia` (`COD`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
