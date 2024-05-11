-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 11-06-2019 a las 01:37:12
-- Versión del servidor: 5.7.23
-- Versión de PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `cit`
--
CREATE DATABASE IF NOT EXISTS `cit` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `cit`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrador`
--

DROP TABLE IF EXISTS `administrador`;
CREATE TABLE IF NOT EXISTS `administrador` (
  `noEmpleado` int(10) DEFAULT NULL,
  `correo` varchar(60) DEFAULT NULL,
  `contrasenia` varchar(32) DEFAULT NULL,
  `estado` int(1) DEFAULT NULL,
  KEY `empleado_administrador_fk` (`noEmpleado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `administrador`
--

INSERT INTO `administrador` (`noEmpleado`, `correo`, `contrasenia`, `estado`) VALUES
(9999, 'correo@correo.com', 'oscar123', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumno`
--

DROP TABLE IF EXISTS `alumno`;
CREATE TABLE IF NOT EXISTS `alumno` (
  `boleta` int(10) NOT NULL,
  `nombre` varchar(30) DEFAULT NULL,
  `apePat` varchar(15) DEFAULT NULL,
  `apeMat` varchar(15) DEFAULT NULL,
  `grupo` varchar(5) DEFAULT NULL,
  `semestre` int(1) DEFAULT NULL,
  PRIMARY KEY (`boleta`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `alumno`
--

INSERT INTO `alumno` (`boleta`, `nombre`, `apePat`, `apeMat`, `grupo`, `semestre`) VALUES
(2016140262, 'Karen', 'HipÃ³lito', 'JimÃ©nez', '1IM1', 1),
(2017140161, 'Diego Armando', 'Apolonio', 'Villegas', '3IM4', 3),
(2017140222, 'Catherine ', 'Arzate ', 'Valencia ', '1IM1', 1),
(2017140891, 'Ãlvaro Jared', 'Esquivel', 'Victoriano', '3IM4', 3),
(2017140902, 'Lourdes SofÃ­a', 'Flores', 'SalmorÃ¡n', '5IM3', 5),
(2017140961, 'JesÃºs Ricardo', 'Flores', 'SÃ¡nchez', '1IM4', 1),
(2017141451, 'Joshua Uziel', 'HernÃ¡ndez', 'Loza', '4IM2', 4),
(2017141541, 'Juan Antonio', 'Jacobo', 'MartÃ­nez', '5IM4', 5),
(2017141771, 'Uriel', 'Maldonado', 'Ãvalos', '2IM2', 2),
(2017141782, 'Mildred Yafit', 'Maca', 'Olvera', '3IM4', 3),
(2017142041, 'Raymundo', 'Mendoza', 'RamÃrez', '5IM4', 5),
(2017142112, 'Jovanna Iridian', 'Mendoza ', 'JuÃ¡rez ', '3IM3', 3),
(2017142121, 'Rafael', 'Moreno', 'EspÃ­ndola', '3IM1', 3),
(2017142541, 'Joel', 'Ramos', 'PinzÃ³n', '3IM4', 3),
(2017143091, 'Daniel', 'SuÃ¡rez', 'GonzÃ¡lez', '3IM4', 3),
(2017143132, 'FÃ¡tima', 'Salazar', 'HernÃ¡ndez', '4IM2', 4),
(2017143231, 'AndrÃ©s', 'Vanegas', 'GarcÃ­a', '1IM4', 1),
(2017143272, 'MarÃ­a Fernanda', 'SÃ¡nchez', 'Vite', '5IM2', 5),
(2017143481, 'Mauricio de JesÃºs', 'Nava', 'Tavera', '4IM6', 4),
(2017143482, 'Angela', 'Trinidad', 'Guillen', '5IM3', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documentos`
--

DROP TABLE IF EXISTS `documentos`;
CREATE TABLE IF NOT EXISTS `documentos` (
  `codDoc` int(4) NOT NULL,
  `nomDoc` varchar(60) DEFAULT NULL,
  `descripcion` varchar(150) DEFAULT NULL,
  `espera` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`codDoc`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `documentos`
--

INSERT INTO `documentos` (`codDoc`, `nomDoc`, `descripcion`, `espera`) VALUES
(1001, 'Constancia de Inscripción', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nam, sequi!', '1 día'),
(1002, 'Constancia para Trámite de Servicio Social', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Totam, magni.', '5 días'),
(1003, 'Constancia de Estudios', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repellat, velit?', '1 día'),
(1004, 'Constancia de Periodo Vacacional', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus, minima!', '2 días'),
(1005, 'Constancia para Trámite de Prácticas Profesionales', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Delectus, amet.', '4 días'),
(1006, 'Boleta de Calificaciones Informativa', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempore, quisquam.', '5 días'),
(1007, 'Boleta Departamental', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempora, amet.', '3 días'),
(1008, 'Boleta Global de Calificaciones Certificada', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tenetur, voluptate.', '10 días');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

DROP TABLE IF EXISTS `empleado`;
CREATE TABLE IF NOT EXISTS `empleado` (
  `noEmpleado` int(10) NOT NULL,
  `nombre` varchar(30) DEFAULT NULL,
  `apePat` varchar(15) DEFAULT NULL,
  `apeMat` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`noEmpleado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`noEmpleado`, `nombre`, `apePat`, `apeMat`) VALUES
(4502, 'Carlos', 'Amador', 'Jiménez'),
(9999, 'Oscar', 'Sánchez', 'Servín');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial`
--

DROP TABLE IF EXISTS `historial`;
CREATE TABLE IF NOT EXISTS `historial` (
  `boleta` int(10) DEFAULT NULL,
  `noSolicitud` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`noSolicitud`),
  KEY `usuario_historial_fk` (`boleta`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud`
--

DROP TABLE IF EXISTS `solicitud`;
CREATE TABLE IF NOT EXISTS `solicitud` (
  `noSolicitud` int(11) NOT NULL AUTO_INCREMENT,
  `codDoc` int(4) DEFAULT NULL,
  `fechaSolicitud` date DEFAULT NULL,
  `fechaEntrega` date DEFAULT NULL,
  `motivo` varchar(100) DEFAULT NULL,
  `autorizacion` int(1) DEFAULT NULL,
  `archivo` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`noSolicitud`),
  KEY `documentos_solicitud_fk` (`codDoc`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `boleta` int(10) DEFAULT NULL,
  `correo` varchar(60) DEFAULT NULL,
  `contrasenia` varchar(50) DEFAULT NULL,
  `solDisponibles` int(2) DEFAULT NULL,
  KEY `alumno_usuario_fk` (`boleta`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
