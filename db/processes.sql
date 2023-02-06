-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-02-2023 a las 00:32:33
-- Versión del servidor: 10.4.25-MariaDB
-- Versión de PHP: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bitel-process`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `processes`
--

CREATE TABLE `processes` (
  `id` int(11) NOT NULL,
  `parentId` int(11) DEFAULT NULL,
  `name` varchar(200) NOT NULL,
  `main_file` varchar(200) NOT NULL,
  `bizagi_foder` varchar(200) NOT NULL,
  `icon` varchar(12) NOT NULL,
  `isDirectory` tinyint(1) NOT NULL,
  `expanded` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `processes`
--

INSERT INTO `processes` (`id`, `parentId`, `name`, `main_file`, `bizagi_foder`, `icon`, `isDirectory`, `expanded`) VALUES
(1, NULL, '1: PROCESS.VTP.PRO.01_Process to launch a new product', 'Appendix 01_How to issue, appraise and post process.pdf', 'New Model', 'file', 0, 0),
(2, NULL, '2: Sale Division', '', '', 'activefolder', 1, 0),
(3, 2, '3: Information Technology Division', '', '', 'activefolder', 1, 0),
(4, 5, '4: PROCESS.VTP.IT.01_Receiving and developing software requirements  process in Viettel Peru (TRIAL)', 'PROCESS.VTP.IT.01_Receiving and developing software requirements process in Viettel Peru (TRIAL).pdf', 'PROCESS.VTP.IT.01', 'file', 0, 0),
(5, 2, '5: PROCESS.VTP.HR.01_Process Application on health and safety at work', 'PROCESS.VTP.HR.01_Process Application on health and safety at work.pdf', '', 'file', 0, 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `processes`
--
ALTER TABLE `processes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `processes`
--
ALTER TABLE `processes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
