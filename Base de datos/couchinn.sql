-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-06-2016 a las 06:02:03
-- Versión del servidor: 10.1.13-MariaDB
-- Versión de PHP: 5.6.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `couchinn`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `couch`
--

CREATE TABLE `couch` (
  `id_couch` int(11) NOT NULL,
  `titulo` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` varchar(150) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `id_tipo` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `Porcentaje` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `capacidad` smallint(6) NOT NULL,
  `imagen` char(100) NOT NULL,
  `id_reserva` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `couch`
--

INSERT INTO `couch` (`id_couch`, `titulo`, `descripcion`, `id_tipo`, `fecha`, `Porcentaje`, `capacidad`, `imagen`, `id_reserva`, `id_usuario`) VALUES
(1, 'Casa en el Lago', 'Es una casa grande que se encuentra junto al lago, ideal para la familia', 10, '2016-05-03', '50%', 3, 'imagenes/couchs/lakeHouse.jpg\n\n\n\n\nÿÛ?C', 1, 1),
(2, 'Departamento', 'Departamento lujoso', 20, '2016-05-17', '20%', 1, 'imagenes/couchs/dpto.jpg', 2, 2),
(3, 'Choza', 'Choza de africa', 30, '2016-05-04', '10%', 10, 'imagenes/couchs/choza.jpg', 3, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagenes_couchs`
--

CREATE TABLE `imagenes_couchs` (
  `id_img` int(11) NOT NULL,
  `id_couch` varchar(100) NOT NULL,
  `imagen` char(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `imagenes_couchs`
--

INSERT INTO `imagenes_couchs` (`id_img`, `id_couch`, `imagen`) VALUES
(1, '1', 'imagenes/couchs/lakeHouse.jpg'),
(2, '1', 'imagenes/couchs/lakeHouse2.jpg'),
(3, '1', 'imagenes/couchs/lakeHouse3.jpg'),
(4, '2', 'imagenes/couchs/dpto.jpg'),
(5, '2', 'imagenes/couchs/dpto2.jpg'),
(6, '2', 'imagenes/couchs/dpto.jpg'),
(7, '3', 'imagenes/couchs/choza.jpg'),
(8, '3', 'imagenes/couchs/choza2.jpg'),
(9, '3', 'imagenes/couchs/choza3.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_de_couch`
--

CREATE TABLE `tipo_de_couch` (
  `id_tipo` int(11) NOT NULL,
  `tipo` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipo_de_couch`
--

INSERT INTO `tipo_de_couch` (`id_tipo`, `tipo`) VALUES
(15, 'cabana'),
(17, 'departamento'),
(22, 'habitacion'),
(24, 'depto');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `apellido` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(70) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `passw` varchar(10) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `telefono` int(20) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `tipo` varchar(7) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='tipo puede ser ''admin'',''comun'' o ''premium''';

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nombre`, `apellido`, `email`, `passw`, `telefono`, `fecha_nacimiento`, `tipo`) VALUES
(1, 'nahu', 'apa', 'nahuapa@altomail.com', 'contra', 4841234, '1994-05-01', 'comun'),
(2, 'el', 'adminCapo', 'admin@mail.com', 'admin', 12345678, '1990-05-02', 'admin'),
(3, 'doyel', 'benitez', 'doyel@hotmail.com', '12345', 6054429, '2016-05-25', 'admin');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `couch`
--
ALTER TABLE `couch`
  ADD PRIMARY KEY (`id_couch`);

--
-- Indices de la tabla `imagenes_couchs`
--
ALTER TABLE `imagenes_couchs`
  ADD PRIMARY KEY (`id_img`);

--
-- Indices de la tabla `tipo_de_couch`
--
ALTER TABLE `tipo_de_couch`
  ADD PRIMARY KEY (`id_tipo`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `couch`
--
ALTER TABLE `couch`
  MODIFY `id_couch` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `imagenes_couchs`
--
ALTER TABLE `imagenes_couchs`
  MODIFY `id_img` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `tipo_de_couch`
--
ALTER TABLE `tipo_de_couch`
  MODIFY `id_tipo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
