-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-11-2017 a las 16:45:30
-- Versión del servidor: 10.1.26-MariaDB
-- Versión de PHP: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd_empresa`
--

-- --------------------------------------------------------
CREATE DATABASE  `bd_empresa`;

USE `bd_empresa`;
--
-- Estructura de tabla para la tabla `tbl_incidencia`
--

CREATE TABLE `tbl_incidencia` (
  `idIncidencia` int(4) NOT NULL,
  `descripcionIncidencia` varchar(100) DEFAULT NULL,
  `fechaIncidencia` datetime DEFAULT NULL,
  `idRecurso` int(4) DEFAULT NULL,
  `estado` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_recurso`
--

CREATE TABLE `tbl_recurso` (
  `idRecurso` int(4) NOT NULL,
  `nombreRecursos` varchar(35) DEFAULT NULL,
  `tipoRecursos` enum('Sala','Material') DEFAULT NULL,
  `Ocupado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_recurso`
--

INSERT INTO `tbl_recurso` (`idRecurso`, `nombreRecursos`, `tipoRecursos`, `Ocupado`) VALUES
(1, 'Aula teoría con proyector 01', 'Sala', 0),
(2, 'Aula teoría con proyector 02', 'Sala', 0),
(3, 'Aula teoría sin proyector', 'Sala', 0),
(4, 'Aula informática 01', 'Sala', 0),
(5, 'Aula informática 02', 'Sala', 0),
(6, 'Despacho para entrevistas 01', 'Sala', 0),
(7, 'Despacho para entrevistas 02', 'Sala', 0),
(8, 'Sala de reuniones', 'Sala', 0),
(9, 'Proyector portátil', 'Material', 0),
(10, 'Carro de portátiles', 'Material', 0),
(11, 'Portátil', 'Material', 0),
(12, 'Portátil ', 'Material', 0),
(13, 'Portátil', 'Material', 0),
(14, 'Móvil', 'Material', 0),
(15, 'Móvil', 'Material', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_reserva`
--

CREATE TABLE `tbl_reserva` (
  `idReserva` int(4) NOT NULL,
  `fechaReserva` datetime DEFAULT NULL,
  `fechaLiberamiento` datetime DEFAULT NULL,
  `idUsuario` int(4) DEFAULT NULL,
  `idRecurso` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_reserva`
--

INSERT INTO `tbl_reserva` (`idReserva`, `fechaReserva`, `fechaLiberamiento`, `idUsuario`, `idRecurso`) VALUES
(448, '2014-11-23 15:17:13', '2014-11-23 15:21:12', 3, 1),
(449, '2014-11-23 15:20:47', '2014-11-23 15:21:13', 3, 2),
(450, '2015-11-23 15:21:50', '2015-11-23 15:21:52', 3, 1),
(451, '2015-11-23 15:22:45', '2015-11-23 15:22:47', 1, 1),
(452, '2017-11-23 16:30:56', NULL, 1, 3),
(453, '2017-11-23 16:30:57', NULL, 1, 4),
(454, '2015-11-23 16:31:37', NULL, 2, 5),
(455, '2015-11-23 16:31:37', NULL, 2, 6),
(456, '2014-11-23 16:31:38', NULL, 2, 7),
(457, '2014-11-23 16:36:53', NULL, 4, 1),
(458, '2016-11-23 16:36:53', NULL, 4, 2),
(459, '2017-11-23 16:36:54', NULL, 4, 8),
(460, '2017-11-23 16:37:51', NULL, 4, 8),
(461, '2017-11-23 16:38:40', NULL, 5, 15),
(462, '2015-11-23 16:38:41', NULL, 5, 10),
(463, '2015-11-23 16:38:43', NULL, 5, 14),
(464, '2014-11-23 16:39:25', NULL, 6, 4),
(465, '2015-11-23 16:39:27', NULL, 6, 13),
(466, '2016-11-23 16:39:29', NULL, 6, 12),
(467, '2017-11-23 16:41:07', NULL, 7, 5),
(468, '2017-11-23 16:41:08', NULL, 7, 6),
(469, '2016-11-23 16:41:08', NULL, 7, 7),
(470, '2015-11-23 16:41:48', NULL, 8, 11),
(471, '2014-11-23 16:41:50', NULL, 8, 9),
(472, '2016-11-23 16:41:51', NULL, 8, 8),
(473, '2015-11-23 16:43:20', NULL, 9, 11),
(474, '2014-11-23 16:43:22', NULL, 9, 7),
(475, '2016-11-23 16:43:24', NULL, 9, 9),
(476, '2017-11-23 16:44:03', NULL, 10, 8),
(477, '2017-11-23 16:44:04', NULL, 10, 10),
(478, '2016-11-23 16:44:06', NULL, 10, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_usuario`
--

CREATE TABLE `tbl_usuario` (
  `idUsuario` int(4) NOT NULL,
  `nombreUsuario` varchar(15) DEFAULT NULL,
  `apellidoUsuario` varchar(15) DEFAULT NULL,
  `dniUsuario` varchar(9) DEFAULT NULL,
  `mailUsuario` varchar(35) DEFAULT NULL,
  `telefonoUsuario` int(9) DEFAULT NULL,
  `direccionUsuario` varchar(60) DEFAULT NULL,
  `passwordUsuario` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tbl_usuario`
--

INSERT INTO `tbl_usuario` (`idUsuario`, `nombreUsuario`, `apellidoUsuario`, `dniUsuario`, `mailUsuario`, `telefonoUsuario`, `direccionUsuario`, `passwordUsuario`) VALUES
(1, 'Juan', 'Alvarez', '45246798L', 'juanalvarez@gmail.com', 612346789, 'juanalvarez@gmail.com', '12345'),
(2, 'Carlos', 'Pedro', '56934567F', 'carlospedro@gmail.com', 625678946, 'C/ Balmes nº 2 1º4', '5678'),
(3, 'Helena', 'Perez', '67434678N', 'helenaperez@gmail.com', 634689457, 'C/ Gerona nº 4 2º1', '6789'),
(4, 'Jordi', 'Baró', '56746745M', 'jordibaro@gmail.com', 634683456, 'C/ Amalia nº 6  2º4', '23456'),
(5, 'Victor', 'Cabrera', '54237854R', 'victorcabrera@gmail.com', 623578546, 'victorcabrera@gmail.com', '3456'),
(6, 'Xavi', 'Campo', '26745778F', 'xavicampo@gmail.com', 623577878, 'C/ Ribes nº 9 3º1', '67890'),
(7, 'Ricardo', 'Jaume', '45736896L', 'ricardojaume@gmail.com', 675456854, 'C/ Gava nº 4 1º2', '7890'),
(8, 'Fran', 'López', '86456567G', 'franlopez@gmail.com', 633478789, 'C/ Miro nº 2 4º2', '234567'),
(9, 'Sergi', 'Mateo', '34656546D', 'sergimateo@gmail.com', 635457567, 'C/ Tarragona', '567890'),
(10, 'Alba', 'Vilanova', '63468246K', 'albavilanova@gmail.com', 634687804, 'C/ Olesa nº 3 2º2', '345678');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbl_incidencia`
--
ALTER TABLE `tbl_incidencia`
  ADD PRIMARY KEY (`idIncidencia`),
  ADD KEY `FK_incidencia_recurso` (`idRecurso`);

--
-- Indices de la tabla `tbl_recurso`
--
ALTER TABLE `tbl_recurso`
  ADD PRIMARY KEY (`idRecurso`);

--
-- Indices de la tabla `tbl_reserva`
--
ALTER TABLE `tbl_reserva`
  ADD PRIMARY KEY (`idReserva`),
  ADD KEY `FK_reserva_usuario` (`idUsuario`),
  ADD KEY `FK_reserva_recurso` (`idRecurso`);

--
-- Indices de la tabla `tbl_usuario`
--
ALTER TABLE `tbl_usuario`
  ADD PRIMARY KEY (`idUsuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbl_incidencia`
--
ALTER TABLE `tbl_incidencia`
  MODIFY `idIncidencia` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=192;

--
-- AUTO_INCREMENT de la tabla `tbl_recurso`
--
ALTER TABLE `tbl_recurso`
  MODIFY `idRecurso` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `tbl_reserva`
--
ALTER TABLE `tbl_reserva`
  MODIFY `idReserva` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=479;

--
-- AUTO_INCREMENT de la tabla `tbl_usuario`
--
ALTER TABLE `tbl_usuario`
  MODIFY `idUsuario` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tbl_incidencia`
--
ALTER TABLE `tbl_incidencia`
  ADD CONSTRAINT `FK_incidencia_recurso` FOREIGN KEY (`idRecurso`) REFERENCES `tbl_recurso` (`idRecurso`);

--
-- Filtros para la tabla `tbl_reserva`
--
ALTER TABLE `tbl_reserva`
  ADD CONSTRAINT `FK_reserva_recurso` FOREIGN KEY (`idRecurso`) REFERENCES `tbl_recurso` (`idRecurso`),
  ADD CONSTRAINT `FK_reserva_usuario` FOREIGN KEY (`idUsuario`) REFERENCES `tbl_usuario` (`idUsuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
