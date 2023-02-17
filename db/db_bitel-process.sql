-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-02-2023 a las 23:30:09
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
-- Estructura de tabla para la tabla `attached_files`
--

CREATE TABLE `attached_files` (
  `id` int(11) NOT NULL,
  `attach_name` varchar(250) NOT NULL,
  `attach_file` varchar(250) NOT NULL,
  `process_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `attached_files`
--

INSERT INTO `attached_files` (`id`, `attach_name`, `attach_file`, `process_id`) VALUES
(7, 'How to Assess and Ensure UX criteria_Guide.05.xlsx', 'How to Assess and Ensure UX criteria_Guide.05_1676042953.xlsx', 5),
(8, 'Level index (2).xlsx', 'Level index (2)_1676042953.xlsx', 5),
(9, 'Appendix 01.docx', 'Appendix 01_1676042953.docx', 5),
(10, 'Process index_Require form.docx', 'Process index_Require form_1676042953.docx', 5),
(11, 'For example_1676041517.xlsx', 'For example_1676041517_1676063365.xlsx', 3),
(18, 'Check list.xlsx', 'Check list_1676064608.xlsx', 3),
(20, 'Index_Process_Pagev1.0 (1).docx', 'Index_Process_Pagev1.0 (1)_1676064608.docx', 3),
(22, 'PROCESS LIST (1) (3).xlsx', 'PROCESS LIST (1) (3)_1676064608.xlsx', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `processes`
--

CREATE TABLE `processes` (
  `id` int(11) NOT NULL,
  `parentId` int(11) DEFAULT NULL,
  `name` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `main_file` varchar(200) NOT NULL,
  `bizagi_folder` varchar(200) NOT NULL,
  `icon` varchar(25) NOT NULL,
  `isDirectory` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `processes`
--

INSERT INTO `processes` (`id`, `parentId`, `name`, `description`, `main_file`, `bizagi_folder`, `icon`, `isDirectory`) VALUES
(1, NULL, 'IT Division', 'Information Tecnology Division description...', 'pdf_1676575456.pdf', '', 'folder', 1),
(2, 1, 'DBUS Department', '', '', '', 'folder', 1),
(3, 6, 'Process to do something', '', '', '', 'textdocument', 0),
(4, NULL, 'Customer Service', 'Customer Service Description', '', '', 'folder', 1),
(5, 2, 'Another Process', '', '', '', 'textdocument', 0),
(6, NULL, 'Folder 3163543', 'Description Information', '', '', 'folder', 1),
(7, 4, 'PROCESS.VTP.IT.01_Receiving and developing software requirements process in Viettel Peru (TRIAL)', 'Some information', '', '', 'textdocument', 0),
(8, NULL, 'New Process', 'This is a description about the new process', '', '', 'folder', 1),
(9, 1, 'FOLDER', 'This is a simple description', '', '', 'folder', 1),
(10, 11, 'Process to do something', 'Some description about \"Process to do something\"', '', '', 'textdocument', 0),
(11, 8, 'Process 004', 'Process 004 Description....', '', '', 'textdocument', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(1, 'admin', '$2y$10$Z0j2/seNGcc129dG939nH.WIDfZDDy5mEACY1xX4bV2.q6KZv4Grq', 'admin');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `attached_files`
--
ALTER TABLE `attached_files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `process_id` (`process_id`);

--
-- Indices de la tabla `processes`
--
ALTER TABLE `processes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `attached_files`
--
ALTER TABLE `attached_files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `processes`
--
ALTER TABLE `processes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `attached_files`
--
ALTER TABLE `attached_files`
  ADD CONSTRAINT `attached_files_ibfk_1` FOREIGN KEY (`process_id`) REFERENCES `processes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
