-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-01-2020 a las 23:22:57
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `palancia`
--
CREATE DATABASE IF NOT EXISTS `palancia` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `palancia`;

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `buena`
-- (Véase abajo para la vista actual)
--
DROP VIEW IF EXISTS `buena`;
CREATE TABLE IF NOT EXISTS `buena` (
`id` int(11)
,`fecha` datetime
,`grupo` varchar(255)
,`poblacion` varchar(45)
,`tipo` varchar(45)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fiesta`
--

DROP TABLE IF EXISTS `fiesta`;
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `fiesta`
--

INSERT IGNORE INTO `fiesta` (`id`, `fecha`, `grupo_id`, `tipo_id`, `poblacion_id`) VALUES
(1, '2019-08-15 23:00:00', 1, 2, 4),
(2, '2019-01-13 00:00:00', 3, 3, 2),
(3, '2019-01-13 00:30:00', 2, 1, 2),
(4, '2019-01-14 14:00:00', 1, 4, 2),
(5, '2019-01-14 17:30:00', 3, 6, 2),
(6, '2019-01-28 07:59:18', 2, 2, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo`
--

DROP TABLE IF EXISTS `grupo`;
CREATE TABLE IF NOT EXISTS `grupo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=90 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `grupo`
--

INSERT IGNORE INTO `grupo` (`id`, `nombre`) VALUES
(1, 'Desconocido'),
(2, 'TS'),
(3, 'Hnos. Benet'),
(4, 'Hnos. Orero'),
(5, 'Comisión'),
(6, 'San Antón'),
(7, 'Orquesta La pato'),
(8, 'Ganaderia Asensi de Orba'),
(9, 'Ganadería Los chatos'),
(10, 'Ganadería Gavira'),
(11, 'Ganadería Ramón Benet'),
(12, 'asdf'),
(13, 'Ganadería Miguel Parejo'),
(14, 'Ganadería La Paloma'),
(15, 'Ganadería Germán Vidal'),
(16, 'Orquesta Vértigo'),
(17, 'Ganadería Fernando Machancoses'),
(18, 'Ganadería Jose Vicente Machancoses y Ganadería Fernando Machancoses'),
(19, 'Toros de Albarreal'),
(20, 'Ganadería Dani Machancoses'),
(21, 'Ganadería Hnos. Guillamón'),
(22, 'Ganadería Cantera Villareal'),
(23, 'Orquesta Platino'),
(24, 'Ganadería Félix Ozcos'),
(25, 'Orquesta Modena'),
(26, 'Orquesta Supernova'),
(27, 'Vehiculos de inercia'),
(28, 'ASPECO'),
(29, 'Orquesta ENERGY SHOW'),
(30, 'DJ RV'),
(31, 'Orquesta LA TRIBU'),
(32, 'Festival DJ\'s 4-9-17 Soneja'),
(33, 'Orquesta GAMMA + EMOTION'),
(34, 'BPM'),
(35, 'Orquesta SPARTA'),
(36, 'Ganadería Pance Melió'),
(37, 'Orquesta XTRA'),
(38, 'Orquesta EMOTION'),
(39, 'Orquesta GAMMA'),
(40, 'DUO-DUETTO'),
(41, 'Orquesta SUPERMAGIC'),
(42, 'Orquesta LA MASCARA'),
(43, 'A.Q.M.'),
(44, 'Orquesta LA SENDA'),
(45, 'Pirotecnia Hermanos Caballer'),
(46, 'Ganadería MONTES'),
(47, 'Ganadería Alberto Garrido'),
(48, 'Ganadería Hnos. CALI'),
(49, 'Ganadería El Portero'),
(50, 'Orquesta EVASION'),
(51, 'Ganadería Juan Faet'),
(52, 'Chatos-Dani_Machancoses'),
(53, 'Disco Piramide'),
(54, 'Orquesta Pervesion Band'),
(55, 'animal caliente tributo barricada'),
(56, 'Orquesta CENTAURO'),
(57, 'Orquesta AGORA'),
(58, 'Orquesta MONTESOL'),
(59, 'Orquesta MUNDO'),
(60, 'HOLLYWOOD EL MUSICAL'),
(61, 'Ganadería Domingo el Val'),
(63, 'Ganadería alberto granchel'),
(64, 'Ganadería El cid'),
(65, 'Evaristo-Saliner'),
(66, 'Ganadería Benavent'),
(67, 'Ganadería nuno casquinha'),
(68, 'Ganadería Gerardo Gamón'),
(69, 'Licor de Fardacho'),
(70, 'over dose homenaje a acdc'),
(71, 'Ganadería Raul Monferrer'),
(72, 'strenos rock band'),
(73, 'Orquesta Gamma Live'),
(74, 'Orquesta La Furia'),
(75, 'Grupo rock altura 22_s'),
(76, 'Grupo rock altura 23_s'),
(77, 'Dj\'s de casa - altura'),
(78, 'Alex Puchades'),
(79, 'Orquesta el grupo'),
(80, 'ññññ'),
(81, 'ñññ'),
(82, 'BandalayEvents'),
(83, 'Orquesta LA VIVA'),
(84, 'Orquesta LA VALENCIA'),
(85, 'Discomovil DAMOON'),
(86, 'Discomovil SPACE'),
(87, 'Hnos. Navarre'),
(88, 'Se pondrán nuevos datos, pero hasta entonces nada por falta de tiempo '),
(89, 'WE-LOVE-80');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `login_attempts`
--

DROP TABLE IF EXISTS `login_attempts`;
CREATE TABLE IF NOT EXISTS `login_attempts` (
  `id` int(11) NOT NULL,
  `time` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  KEY `index_id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `login_attempts`
--

INSERT IGNORE INTO `login_attempts` (`id`, `time`) VALUES
(1, '1481788244'),
(1, '1579436826'),
(1, '1579437959');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `poblacion`
--

DROP TABLE IF EXISTS `poblacion`;
CREATE TABLE IF NOT EXISTS `poblacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `poblacion` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `ubicacion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `poblacion`
--

INSERT IGNORE INTO `poblacion` (`id`, `poblacion`, `ubicacion`) VALUES
(1, 'Segorbe', 'https://goo.gl/maps/wSVJtbihXNy'),
(2, 'Villa de Altura', 'https://goo.gl/maps/8aLjhXyMVRF2'),
(3, 'Jérica', 'https://goo.gl/maps/ZQvbCCHBtSq'),
(4, 'Viver', 'https://goo.gl/maps/qApWEa3BHHy'),
(5, 'Soneja', 'https://goo.gl/maps/6DfJxhc5sEA2'),
(6, 'Castellnovo', 'https://goo.gl/maps/ydmZ49eVKhE2'),
(7, 'Navajas', 'https://goo.gl/maps/4KgTUkhkP1k'),
(8, 'Caudiel', 'https://goo.gl/maps/1Rf1XwTk4UD2'),
(9, 'Geldo', 'https://goo.gl/maps/6y65KSdwUSP2'),
(10, 'Sot de Ferrer', 'https://goo.gl/maps/2rQyuF1Aj8P2'),
(11, 'Bejís', 'https://goo.gl/maps/zvY4381s2862'),
(12, 'Cárrica', ''),
(13, 'Chóvar', 'https://goo.gl/maps/kP3UTsYMpQD2'),
(14, 'Azuébar', 'https://goo.gl/maps/DAuYW2zq1Dz'),
(15, 'Algimia de Almonacid', 'https://goo.gl/maps/F3jrB6xBzQL2'),
(16, 'Teresa', 'https://goo.gl/maps/cobaeJvKZ8H2'),
(17, 'Almedíjar', 'https://goo.gl/maps/mW21RKYBBY62'),
(18, 'Vall de Almonacid', 'https://goo.gl/maps/nfvUBd6aymH2'),
(19, 'El Toro', 'https://goo.gl/maps/jSEzYGBryay'),
(20, 'Torás', 'https://goo.gl/maps/pn1pX5vfpXD2'),
(21, 'Gaibiel', 'https://goo.gl/maps/HLaMCjoAGfr'),
(22, 'Barracas', 'https://goo.gl/maps/8JoWNNjBLS52'),
(23, 'Benafer', 'https://goo.gl/maps/D3DDiatCDnM2'),
(24, 'Pina de Montalgrao', 'https://goo.gl/maps/9KHYGWegJYv'),
(25, 'Matet', 'https://goo.gl/maps/T5EcAPd7Nur'),
(26, 'Higueras', 'https://goo.gl/maps/4W473QCTZ6D2'),
(27, 'Sacañet', 'https://goo.gl/maps/inBYAn3jrzz'),
(28, 'Pavías', 'https://goo.gl/maps/Rm9DEBLDi252');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo`
--

DROP TABLE IF EXISTS `tipo`;
CREATE TABLE IF NOT EXISTS `tipo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `tipo`
--

INSERT IGNORE INTO `tipo` (`id`, `descripcion`) VALUES
(1, 'Discomovil'),
(2, 'Verbena'),
(3, 'Toro embolado'),
(4, 'Entrada de toros'),
(5, 'Entrada de toros y caballos'),
(6, 'Vaquillas'),
(7, 'Desencajona');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` char(128) COLLATE utf8_unicode_ci NOT NULL,
  `tipo` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `usuario` (`usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT IGNORE INTO `usuarios` (`id`, `usuario`, `password`, `tipo`) VALUES
(1, 'vlc', '909635acb574f6d70b2d76058692c69aec16e4cf0c8c741c88f0d2cad0bbbec6d59f3b2df977708cbba7bedd75b8659c7e1374c7a6935a66c1fc9777e04f69e7', 1),
(2, 'ausias', 'fe17c62cdd39fd6abe5d0bb07f523432af4a20b4219438ccb04508285e782191cc8cd380706ad3bf9695ba77cea31695263fb53808a8cd4ef94dc3618c462e03', 0);

-- --------------------------------------------------------

--
-- Estructura para la vista `buena`
--
DROP TABLE IF EXISTS `buena`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `buena`  AS  select `fiesta`.`id` AS `id`,`fiesta`.`fecha` AS `fecha`,`grupo`.`nombre` AS `grupo`,`poblacion`.`poblacion` AS `poblacion`,`tipo`.`descripcion` AS `tipo` from (((`fiesta` join `poblacion`) join `tipo`) join `grupo`) where `poblacion`.`id` = `fiesta`.`poblacion_id` and `fiesta`.`tipo_id` = `tipo`.`id` and `grupo`.`id` = `fiesta`.`grupo_id` order by `fiesta`.`fecha`,`poblacion`.`poblacion`,`tipo`.`descripcion`,`fiesta`.`grupo_id` ;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
