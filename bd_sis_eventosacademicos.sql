-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-05-2020 a las 20:04:19
-- Versión del servidor: 10.1.36-MariaDB
-- Versión de PHP: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd_sis_eventosacademicos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistentes_evento`
--

CREATE TABLE `asistentes_evento` (
  `id_asistente` int(6) NOT NULL,
  `dni_asistente` int(8) NOT NULL,
  `nombres_asistente` varchar(300) NOT NULL,
  `apellidos_asistente` varchar(300) NOT NULL,
  `fecha_ingreso` date NOT NULL,
  `hora_ingreso` time(6) NOT NULL,
  `hora_salida` time(6) NOT NULL,
  `nro_evento` int(4) NOT NULL,
  `id_usuario` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `asistentes_evento`
--

INSERT INTO `asistentes_evento` (`id_asistente`, `dni_asistente`, `nombres_asistente`, `apellidos_asistente`, `fecha_ingreso`, `hora_ingreso`, `hora_salida`, `nro_evento`, `id_usuario`) VALUES
(2, 47344754, 'CRISTHIAN MARIO', 'VERA HUAMANI', '2020-04-20', '16:07:04.000000', '22:30:21.000000', 20, 'cverah'),
(3, 31007202, 'MARIO', 'VERA UTANI', '2020-04-20', '16:08:23.000000', '22:00:00.000000', 20, 'cverah'),
(4, 45643743, 'DENIS', 'BONIFACIO HIDALGO', '2020-04-20', '16:13:18.000000', '14:29:45.000000', 20, 'cverah'),
(5, 31008243, 'SUSANA', 'DAVILA GUILLEN', '2020-04-20', '16:20:00.000000', '14:26:48.000000', 20, 'cverah'),
(6, 444, 'asdasd', 'asdasd', '2020-04-08', '14:14:18.000000', '22:08:13.000000', 18, 'cverah'),
(7, 47546732, 'NELLY', 'SANTISTEBAN SANDOVAL', '2020-04-20', '20:44:02.000000', '00:00:00.000000', 20, 'cverah'),
(8, 47543243, 'RONALD BARONI', 'DELGADO ALVAREZ', '2020-04-20', '21:23:06.000000', '00:00:00.000000', 20, 'cverah');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `certificado`
--

CREATE TABLE `certificado` (
  `id_certificado` int(5) NOT NULL,
  `nombre_cert` varchar(500) NOT NULL,
  `anio` year(4) NOT NULL,
  `nro_evento` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `certificado`
--

INSERT INTO `certificado` (`id_certificado`, `nombre_cert`, `anio`, `nro_evento`) VALUES
(14, 'certificado sdfsd', 2020, 15),
(15, 'certificado lavado de activos VRAE', 2020, 22),
(16, 'cert taller asdas', 2020, 20),
(17, 'covid', 2020, 25);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evento`
--

CREATE TABLE `evento` (
  `nro_evento` int(4) NOT NULL,
  `tipo_evento` varchar(100) NOT NULL,
  `nombre_evento` varchar(1000) NOT NULL,
  `ponentes` varchar(1000) NOT NULL,
  `lugar` varchar(1000) NOT NULL,
  `direccion` varchar(350) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time(6) NOT NULL,
  `estado` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `evento`
--

INSERT INTO `evento` (`nro_evento`, `tipo_evento`, `nombre_evento`, `ponentes`, `lugar`, `direccion`, `fecha`, `hora`, `estado`) VALUES
(13, 'Curso', 'lavado de activos en la regiÃ³n de apurimac adagdsh asdhajsdh asdnajsdajs asdkhasjd adhajsd ajsdhas asdasjd aksdhajsdh ajsdhajsdhasjdh', 'Dr. YANCARLOS AUGUSTO MALASQUEZ LARA\r\nDr. MARIA DEL CARMEN QUISPE HUAMAN\r\n', 'Auditorio Jose Maria Arguedas de la Corte Superior de Justicia de Apurimac', 'Av. Diaz Barcenas Nro 100 - Abancay - Apurimac', '2020-04-17', '11:30:00.000000', 'abierto'),
(14, 'Seminario Taller', 'lavado de activos en talaaal', 'Dr. LUCERO DE GUADALUPE ARBILDO HUAYUNGA\r\nDr. YENNIFER CAROL MARTINEZ TORRES\r\n', 'Auditorio Jose Maria Arguedas de la Corte Superior de Justicia de Apurimac', 'Av. Diaz Barcenas Nro 100', '2020-04-17', '16:00:00.000000', 'abierto'),
(15, 'sdfsd', 'sdfsdgdgh asddasdas asdasda', 'asdasdasd\r\nasdasdas', 'asdasdasd', 'asadasdas', '2020-04-08', '06:13:10.000000', 'cerrado'),
(18, 'sdfdsd', 'sdfsdf', 'sdfsdf', 'sdfsdf', 'sdfsdf', '2020-04-07', '03:03:03.000000', 'abierto'),
(19, 'sdfdsd', 'sdfsdf', 'sdfsdf', 'sdfsdf', 'sdfsdf', '2020-04-07', '03:03:03.000000', 'abierto'),
(20, 'taller', 'asdas asdasd asd assdas da dasdas asd as das a sdas dasd ', 'asd as das dads as dasd as d', 'adsadasd ', 'asdasd as d', '2020-04-21', '12:57:00.000000', 'cerrado'),
(21, 'taller', 'asdas asdasd asd assdas da dasdas asd as das a sdas dasd ', 'asd as das dads as dasd as d', 'adsadasd ', 'asdasd as d', '2020-04-29', '12:20:00.000000', 'abierto'),
(22, 'Curso', 'Lavado de Activos VRAE', 'Dr. CRISTHIAN MARIO\r\nDr. CHRISTOPHER ARTURO BOBBIO CAMAC\r\n', 'Auditorio Jose Maria Arguedas de la Corte Superior de Justicia de Apurimac', 'Av. Diaz Barcenas Nro 100', '2020-04-16', '14:00:00.000000', 'cerrado'),
(23, 'Seminario', 'Lavado de Activos VRAE', 'Dr. MARIO\r\nDr. LUIS FELIX PACHECO ZANABRIA\r\n', 'Auditorio Jose Maria Arguedas de la Corte Superior de Justicia de Apurimac', 'Av. Diaz Barcenas Nro 100', '2020-04-30', '08:00:00.000000', 'abierto'),
(24, 'Seminario', 'Lavado de Activos VRAE', 'Dr. MARIO\r\nDr. LUIS FELIX PACHECO ZANABRIA\r\n', 'Auditorio Jose Maria Arguedas de la Corte Superior de Justicia de Apurimac', 'Av. Diaz Barcenas Nro 100', '2020-04-30', '08:00:00.000000', 'abierto'),
(25, 'Curso', 'covid', 'Dr. LUIS FELIX PACHECO ZANABRIA\r\n', 'faceboj', 'Av. Diaz Barcenas Nro 100', '2020-05-06', '15:30:00.000000', 'cerrado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `expositor`
--

CREATE TABLE `expositor` (
  `id_expositor` int(4) NOT NULL,
  `dni` int(8) NOT NULL,
  `nombre_completo` varchar(300) NOT NULL,
  `entidad` varchar(500) NOT NULL,
  `cargo` varchar(500) NOT NULL,
  `correo` varchar(500) NOT NULL,
  `celular` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `expositor`
--

INSERT INTO `expositor` (`id_expositor`, `dni`, `nombre_completo`, `entidad`, `cargo`, `correo`, `celular`) VALUES
(1, 47344754, 'CRISTHIAN MARIO ', 'CSJ Apurimac', 'as', 'as', 0),
(2, 31007202, 'MARIO ', 'CSJ Apurimac', 'sdsd', 'as', 0),
(3, 10025295, 'LUIS FELIX PACHECO ZANABRIA', 'CSJ Apurimac', 'asas', 'dsdsa', 932333333),
(4, 45647383, 'MARIA DEL CARMEN QUISPE HUAMAN', 'CSJ Apurimac', 'juez del 1Â° JUP - CSJ AP', 'm@pj.pj.gob.pe', 91335121),
(5, 72772132, 'LUCERO DE GUADALUPE ARBILDO HUAYUNGA', 'CSJ Apurimac', 'soporte', 'cverah', 9238),
(6, 76324576, 'CHRISTOPHER ARTURO BOBBIO CAMAC', 'CSJ Apurimac', 'asd', 'asd', 9898),
(7, 47523456, 'YENNIFER CAROL MARTINEZ TORRES', 'CSJ Apurimac', 'ais seÃ±or', 'as', 656777),
(8, 45347543, 'YANCARLOS AUGUSTO MALASQUEZ LARA', 'CSJ ApurÃ­mac', 'JosÃ© marÃ­a Arguesa', 'asdasd', 4545);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inscripcion`
--

CREATE TABLE `inscripcion` (
  `id_inscripcion` int(4) NOT NULL,
  `dni_inscripcion` int(8) NOT NULL,
  `nombres_inscripcion` varchar(200) NOT NULL,
  `apellidos_inscripcion` varchar(250) NOT NULL,
  `fecha_inscripcion` date NOT NULL,
  `hora_inscripcion` time(6) NOT NULL,
  `correo` varchar(300) NOT NULL,
  `telefono` int(9) NOT NULL,
  `habilitacion_cert` varchar(50) NOT NULL,
  `nro_evento` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `inscripcion`
--

INSERT INTO `inscripcion` (`id_inscripcion`, `dni_inscripcion`, `nombres_inscripcion`, `apellidos_inscripcion`, `fecha_inscripcion`, `hora_inscripcion`, `correo`, `telefono`, `habilitacion_cert`, `nro_evento`) VALUES
(2, 5555555, 'wefwe', 'wefwef', '2020-04-30', '08:00:00.000000', 'cvrer', 888888, '', 13),
(3, 47344754, 'CRISTHIAN MARIO', 'VERA HUAMANI', '2020-04-18', '12:56:14.000000', 'cverah@pj.gob.pe', 999999999, 'habilitado', 20),
(4, 31007202, 'MARIO', 'VERA UTANI', '2020-04-18', '14:17:01.000000', 'cverah@pj.gob.pe', 666666666, 'habilitado', 20),
(6, 31006142, 'LAURIANA', 'HUAMANI CHAVEZ', '2020-04-18', '14:29:27.000000', 'cverah@pj.gob.pe', 444444444, '', 20),
(7, 74128616, 'JOEL', 'MEZA BACA', '2020-05-06', '12:39:12.000000', 'lovob@gmail.com', 999999999, 'habilitado', 25),
(8, 44444446, 'asdsdg', 'xdfsdgfsd', '2020-05-06', '12:44:00.000000', 'c@gmail.com666', 999999999, 'deshabilitado', 25),
(9, 22222222, 'sabino ', 'kari benites', '2020-05-06', '12:51:36.000000', 'c@gmail.com666', 888888888, 'habilitado', 25);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` varchar(60) NOT NULL,
  `password` varchar(60) NOT NULL,
  `dni_usuario` int(8) NOT NULL,
  `nombres_user` varchar(500) NOT NULL,
  `apellidos_user` varchar(20) NOT NULL,
  `cargo` varchar(200) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `correo` varchar(300) NOT NULL,
  `telefono` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `password`, `dni_usuario`, `nombres_user`, `apellidos_user`, `cargo`, `tipo`, `correo`, `telefono`) VALUES
('asdas', '', 31007202, 'MARIO', 'VERA UTANI', 'asd', 'usuario', 'asd', 0),
('cverah', 'e10adc3949ba59abbe56e057f20f883e', 47344754, 'CRISTHIAN MARIO', 'VERA HUAMANI', '', 'administrador', '', 0),
('dhuamani', '', 47345765, 'LI DAVID', 'HUAMANI PAREDES', 'asistente judicial', 'usuario', 'cverah@pj.gob.pe', 344444),
('sdasdsa', '', 75330167, 'KATERIN BRISET', 'CAPCHA ROJAS', 'asa', 'usuario', 'as', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asistentes_evento`
--
ALTER TABLE `asistentes_evento`
  ADD PRIMARY KEY (`id_asistente`),
  ADD KEY `nro_evento` (`nro_evento`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `certificado`
--
ALTER TABLE `certificado`
  ADD PRIMARY KEY (`id_certificado`),
  ADD KEY `id_asistente` (`nro_evento`);

--
-- Indices de la tabla `evento`
--
ALTER TABLE `evento`
  ADD PRIMARY KEY (`nro_evento`);

--
-- Indices de la tabla `expositor`
--
ALTER TABLE `expositor`
  ADD PRIMARY KEY (`id_expositor`);

--
-- Indices de la tabla `inscripcion`
--
ALTER TABLE `inscripcion`
  ADD PRIMARY KEY (`id_inscripcion`),
  ADD KEY `nro_evento` (`nro_evento`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `asistentes_evento`
--
ALTER TABLE `asistentes_evento`
  MODIFY `id_asistente` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `certificado`
--
ALTER TABLE `certificado`
  MODIFY `id_certificado` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `evento`
--
ALTER TABLE `evento`
  MODIFY `nro_evento` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `expositor`
--
ALTER TABLE `expositor`
  MODIFY `id_expositor` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `inscripcion`
--
ALTER TABLE `inscripcion`
  MODIFY `id_inscripcion` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `asistentes_evento`
--
ALTER TABLE `asistentes_evento`
  ADD CONSTRAINT `asistentes_evento_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`),
  ADD CONSTRAINT `asistentes_evento_ibfk_3` FOREIGN KEY (`nro_evento`) REFERENCES `evento` (`nro_evento`);

--
-- Filtros para la tabla `certificado`
--
ALTER TABLE `certificado`
  ADD CONSTRAINT `certificado_ibfk_1` FOREIGN KEY (`nro_evento`) REFERENCES `evento` (`nro_evento`);

--
-- Filtros para la tabla `inscripcion`
--
ALTER TABLE `inscripcion`
  ADD CONSTRAINT `inscripcion_ibfk_1` FOREIGN KEY (`nro_evento`) REFERENCES `evento` (`nro_evento`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
