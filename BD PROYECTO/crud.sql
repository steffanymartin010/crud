-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-06-2022 a las 21:04:48
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `crud`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `cod_producto` int(50) UNSIGNED NOT NULL,
  `nom_producto` varchar(30) NOT NULL,
  `descripcion_producto` varchar(30) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`cod_producto`, `nom_producto`, `descripcion_producto`, `created_at`, `updated_at`) VALUES
(22000303, 'Aceite Diana', '900ml', '2022-06-16 15:20:47', '2022-06-16 18:49:29'),
(77007980, 'Arroz Sonora', '500gr', '2022-06-16 15:38:26', '2022-06-16 18:22:28'),
(267014203, 'Whisky Red Label', '750ml', '2022-06-16 18:47:35', '2022-06-16 18:47:35'),
(1018007151, 'Aceite Premier', '1000cm3', '2022-06-16 18:42:10', '2022-06-16 18:42:10'),
(1018007267, 'Aceite Riquisimo', '500ml', '2022-06-16 18:42:52', '2022-06-16 18:42:52'),
(1018007502, 'Aceite Riquisimo', '1000ml', '2022-06-16 18:43:30', '2022-06-16 18:43:30'),
(2020112017, 'La MuÃ±eca Spaghetti', '250gr', '2022-06-16 18:57:51', '2022-06-16 18:57:51'),
(2404005034, 'Aguardiente Nectar', '375ml', '2022-06-16 18:52:23', '2022-06-16 18:52:23'),
(4294967295, 'Whisky Chivas Regal', '750ml', '2022-06-16 18:45:13', '2022-06-16 18:45:13');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`cod_producto`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `cod_producto` int(50) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4294967296;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
