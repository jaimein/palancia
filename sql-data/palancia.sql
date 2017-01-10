-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 10-01-2017 a las 17:44:39
-- Versión del servidor: 5.5.53-0ubuntu0.14.04.1
-- Versión de PHP: 5.5.9-1ubuntu4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `palancia`
--

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `buena`
--
CREATE TABLE IF NOT EXISTS `buena` (
`fecha` datetime
,`grupo` varchar(255)
,`poblacion` varchar(45)
,`tipo` varchar(45)
);
-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fiesta`
--

CREATE TABLE IF NOT EXISTS `fiesta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` datetime DEFAULT NULL,
  `grupo_id` int(11) NOT NULL,
  `tipo_id` int(11) NOT NULL,
  `poblacion_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`tipo_id`,`poblacion_id`,`grupo_id`),
  KEY `fk_fiesta_tipo_idx` (`tipo_id`),
  KEY `fk_fiesta_poblacion1_idx` (`poblacion_id`),
  KEY `fk_fiesta_grupo1_idx` (`grupo_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `fiesta`
--

INSERT INTO `fiesta` (`id`, `fecha`, `grupo_id`, `tipo_id`, `poblacion_id`) VALUES
(1, '2017-08-15 23:00:00', 1, 2, 4),
(2, '2017-01-13 00:00:00', 3, 3, 2),
(3, '2017-01-13 00:30:00', 2, 1, 2),
(4, '2017-01-14 14:00:00', 1, 4, 2),
(5, '2017-01-14 17:30:00', 3, 6, 2),
(6, '2017-01-28 07:59:18', 2, 2, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo`
--

CREATE TABLE IF NOT EXISTS `grupo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=26 ;

--
-- Volcado de datos para la tabla `grupo`
--

INSERT INTO `grupo` (`id`, `nombre`) VALUES
(1, 'Desconocido'),
(2, 'TS'),
(3, 'Hnos. Benet'),
(4, 'Hnos. Orero'),
(5, 'asdf'),
(6, 'abc'),
(10, 'poi'),
(11, 'poi'),
(12, 'poi'),
(13, 'poi'),
(14, 'poi'),
(15, 'poi'),
(16, 'poi'),
(17, 'poi'),
(18, 'poi'),
(19, 'poi'),
(20, 'poi'),
(21, 'fdsa'),
(22, 'fdsa'),
(23, 'fdsa'),
(24, 'fdsa'),
(25, 'fdsa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `login_attempts`
--

CREATE TABLE IF NOT EXISTS `login_attempts` (
  `id` int(11) NOT NULL,
  `time` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  KEY `index_id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `login_attempts`
--

INSERT INTO `login_attempts` (`id`, `time`) VALUES
(1, '1481788244');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `poblacion`
--

CREATE TABLE IF NOT EXISTS `poblacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `poblacion` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=29 ;

--
-- Volcado de datos para la tabla `poblacion`
--

INSERT INTO `poblacion` (`id`, `poblacion`) VALUES
(1, 'Segorbe'),
(2, 'Villa de Altura'),
(3, 'Jérica'),
(4, 'Viver'),
(5, 'Soneja'),
(6, 'Castellnovo'),
(7, 'Navajas'),
(8, 'Caudiel'),
(9, 'Geldo'),
(10, 'Sot de Ferrer'),
(11, 'Bejís'),
(12, 'Cárrica'),
(13, 'Chóvar'),
(14, 'Azuébar'),
(15, 'Algimia de Almonacid'),
(16, 'Teresa'),
(17, 'Almedíjar'),
(18, 'Vall de Almonacid'),
(19, 'El Toro'),
(20, 'Torás'),
(21, 'Gaibiel'),
(22, 'Barracas'),
(23, 'Benafer'),
(24, 'Pina de Montalgrao'),
(25, 'Matet'),
(26, 'Higueras'),
(27, 'Sacañet'),
(28, 'Pavías');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo`
--

CREATE TABLE IF NOT EXISTS `tipo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Volcado de datos para la tabla `tipo`
--

INSERT INTO `tipo` (`id`, `descripcion`) VALUES
(1, 'discomovil'),
(2, 'verbena'),
(3, 'toro embolado'),
(4, 'entrada de toros'),
(5, 'entrada de toros y caballos'),
(6, 'vaquillas'),
(7, 'desencajona'),
(8, 'prueba'),
(9, 'asdf'),
(10, 'asdf');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` char(128) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `usuario` (`usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `password`) VALUES
(1, 'vlc', '909635acb574f6d70b2d76058692c69aec16e4cf0c8c741c88f0d2cad0bbbec6d59f3b2df977708cbba7bedd75b8659c7e1374c7a6935a66c1fc9777e04f69e7'),
(2, 'ausias', 'fe17c62cdd39fd6abe5d0bb07f523432af4a20b4219438ccb04508285e782191cc8cd380706ad3bf9695ba77cea31695263fb53808a8cd4ef94dc3618c462e03');

-- --------------------------------------------------------

--
-- Estructura para la vista `buena`
--
DROP TABLE IF EXISTS `buena`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `buena` AS select `fiesta`.`fecha` AS `fecha`,`grupo`.`nombre` AS `grupo`,`poblacion`.`poblacion` AS `poblacion`,`tipo`.`descripcion` AS `tipo` from (((`fiesta` join `poblacion`) join `tipo`) join `grupo`) where ((`poblacion`.`id` = `fiesta`.`poblacion_id`) and (`fiesta`.`tipo_id` = `tipo`.`id`) and (`grupo`.`id` = `fiesta`.`grupo_id`)) order by `fiesta`.`fecha`,`poblacion`.`poblacion`,`tipo`.`descripcion`,`fiesta`.`grupo_id`;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `fiesta`
--
ALTER TABLE `fiesta`
  ADD CONSTRAINT `fk_fiesta_grupo1` FOREIGN KEY (`grupo_id`) REFERENCES `grupo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_fiesta_poblacion1` FOREIGN KEY (`poblacion_id`) REFERENCES `poblacion` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_fiesta_tipo` FOREIGN KEY (`tipo_id`) REFERENCES `tipo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD CONSTRAINT `login_attempts_ibfk_1` FOREIGN KEY (`id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
