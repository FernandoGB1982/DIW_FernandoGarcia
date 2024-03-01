-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-02-2024 a las 13:28:38
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 7.3.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyecto_guitarra`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `guitarras`
--

CREATE TABLE `guitarras` (
  `idGuitarras` int(11) NOT NULL,
  `Nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Precio` double NOT NULL,
  `Descripcion` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Portada` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Cantidad` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `guitarras`
--

INSERT INTO `guitarras` (`idGuitarras`, `Nombre`, `Precio`, `Descripcion`, `Portada`, `Cantidad`) VALUES
(1, 'Fender Stratocaster', 1500, 'Una de las guitarras eléctricas más icónicas de todos los tiempos.', '1', 0),
(2, 'Gibson Les Paul', 2000, 'Una guitarra versátil, con un sonido cálido y potente.', '2', 2),
(3, 'Ibanez RG', 1800, 'Una guitarra diseñada para los amantes del metal y la velocidad.', '3', 4),
(4, 'PRS Custom 24', 2500, 'Un modelo de lujo con tonos ricos y una excelente artesanía.', '4', 10),
(5, 'Jackson Soloist', 1700, 'Guitarra de alto rendimiento para guitarristas de metal y rock.', '5', 10),
(6, 'ESP Eclipse', 1900, 'Una guitarra versátil con un estilo único y un sonido potente.', '6', 12),
(7, 'Epiphone Sheraton II', 1600, 'Una guitarra semihueca con un tono suave y cálido.', '7', 8),
(8, 'Gretsch White Falcon', 3000, 'Un modelo emblemático conocido por su estilo y sonido distintivos.', '8', 8),
(9, 'Music Man Majesty', 3200, 'Guitarra de alta gama con características innovadoras y un sonido potente.', '9', 8),
(10, 'Schecter Hellraiser', 1500, 'Guitarra de metal con un diseño elegante y un rendimiento excepcional.', '10', 6),
(11, 'Taylor 814ce', 3500, 'Una guitarra acústica de alta calidad con un sonido rico y equilibrado.', '11', 6),
(12, 'Martin D-28', 3100, 'Una guitarra acústica clásica conocida por su tono cálido y resonante.', '12', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE `pedido` (
  `idpedido` int(11) NOT NULL,
  `fecha_pedido` date DEFAULT NULL,
  `idusuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `pedido`
--

INSERT INTO `pedido` (`idpedido`, `fecha_pedido`, `idusuario`) VALUES
(60, '2024-02-29', 1),
(61, '2024-02-29', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidoinfo`
--

CREATE TABLE `pedidoinfo` (
  `idpedido` int(11) NOT NULL,
  `idGuitarra` int(11) DEFAULT NULL,
  `precio` double DEFAULT NULL,
  `cantidad` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `pedidoinfo`
--

INSERT INTO `pedidoinfo` (`idpedido`, `idGuitarra`, `precio`, `cantidad`) VALUES
(60, 2, 2000, 2),
(60, 12, 3100, 2),
(61, 4, 2500, 2),
(61, 5, 1700, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idusuario` int(11) NOT NULL,
  `usuario` varchar(255) DEFAULT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `correo` varchar(255) DEFAULT NULL,
  `passwordUsuario` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idusuario`, `usuario`, `telefono`, `correo`, `passwordUsuario`) VALUES
(1, 'Fernando', '123456789', 'correo@correo.com', '1234');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `guitarras`
--
ALTER TABLE `guitarras`
  ADD PRIMARY KEY (`idGuitarras`);

--
-- Indices de la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`idpedido`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idusuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `guitarras`
--
ALTER TABLE `guitarras`
  MODIFY `idGuitarras` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `pedido`
--
ALTER TABLE `pedido`
  MODIFY `idpedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
