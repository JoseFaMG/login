-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 23-06-2024 a las 14:11:46
-- Versión del servidor: 8.0.17
-- Versión de PHP: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `controldeacceso`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos`
--

CREATE TABLE `alumnos` (
  `id` int(11) NOT NULL,
  `matricula` varchar(50) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `cuatrimestre` int(11) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `estado` enum('permitido','pendiente','denegado') NOT NULL,
  `fecha_registro` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `alumnos`
--

INSERT INTO `alumnos` (`id`, `matricula`, `nombre`, `cuatrimestre`, `correo`, `estado`, `fecha_registro`) VALUES
(1, '220070697', 'Jose Fabian Muñozcano Guzman', 9, 'j.muxozcano.g656@edu.utc.mx', 'permitido', '2024-05-20 16:21:52'),
(2, '220073267', 'Lorena Sanchez Miranda', 9, 'l.sanchez.m623@edu.utc.mx', 'permitido', '2024-05-20 16:25:41'),
(3, '230085132', 'Alexia Itzel Baeza Torres', 6, 'a.baeza.t919@edu.utc.mx', 'permitido', '2024-05-20 19:05:57'),
(4, '220069348', 'Luis Angel Mosco Salazar', 9, 'l.mosco.s776@edu.utc.mx', 'permitido', '2024-06-04 14:17:06'),
(6, '12345', 'Juan Pérez', 1, 'juan.perez@instituto.edu.mx', 'permitido', '2024-06-23 13:48:35'),
(7, '12346', 'Ana Gómez', 2, 'ana.gomez@instituto.edu.mx', 'pendiente', '2024-06-23 13:48:35'),
(8, '12347', 'Luis García', 3, 'luis.garcia@instituto.edu.mx', 'denegado', '2024-06-23 13:48:35');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
