-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost:3306
-- Tiempo de generación: 04-01-2020 a las 06:44:53
-- Versión del servidor: 5.7.21-log
-- Versión de PHP: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `listadeprecios`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulo`
--

CREATE TABLE IF NOT EXISTS `articulo` (
  `id_articulo` int(255) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(255) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `preciodecompra` decimal(10,2) NOT NULL,
  `porcentaje` decimal(10,2) NOT NULL,
  `ganancia` decimal(10,2) NOT NULL,
  `preciofinal` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id_articulo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=49 ;

--
-- Volcado de datos para la tabla `articulo`
--

INSERT INTO `articulo` (`id_articulo`, `codigo`, `descripcion`, `preciodecompra`, `porcentaje`, `ganancia`, `preciofinal`) VALUES
(47, '063524654', 'ANGULO 35X35', '120.00', '30.00', '36.00', '156.00'),
(48, '13241654', 'DESFRIBILADOR ATOMLUX', '120.00', '150.00', '180.00', '300.00');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
