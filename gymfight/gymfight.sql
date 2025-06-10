-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-06-2025 a las 12:48:24
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `gymfight`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistencias`
--

CREATE TABLE `asistencias` (
  `id` int(11) NOT NULL,
  `cliente_id` int(11) NOT NULL,
  `membresia_id` int(11) NOT NULL,
  `fecha_asistencia` date NOT NULL,
  `fecha_hora` datetime DEFAULT current_timestamp(),
  `tipo` enum('entrada','salida') NOT NULL DEFAULT 'entrada'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `asistencias`
--

INSERT INTO `asistencias` (`id`, `cliente_id`, `membresia_id`, `fecha_asistencia`, `fecha_hora`, `tipo`) VALUES
(9, 157, 9, '0000-00-00', '2025-06-04 01:47:23', 'entrada'),
(10, 287, 10, '0000-00-00', '2025-06-04 22:53:07', 'entrada'),
(11, 287, 10, '0000-00-00', '2025-06-04 22:53:13', 'entrada'),
(12, 287, 10, '0000-00-00', '2025-06-04 22:53:39', 'entrada'),
(13, 287, 10, '0000-00-00', '2025-06-04 22:53:42', 'entrada'),
(17, 287, 10, '0000-00-00', '2025-06-05 06:29:05', 'entrada'),
(18, 287, 10, '0000-00-00', '2025-06-05 06:29:30', 'entrada'),
(19, 287, 10, '0000-00-00', '2025-06-05 13:55:32', 'entrada'),
(20, 287, 10, '0000-00-00', '2025-06-05 13:55:38', 'entrada'),
(21, 287, 10, '0000-00-00', '2025-06-05 13:55:47', 'entrada'),
(22, 287, 10, '0000-00-00', '2025-06-05 16:17:33', 'entrada'),
(23, 287, 10, '0000-00-00', '2025-06-05 17:29:43', 'entrada'),
(24, 287, 10, '0000-00-00', '2025-06-05 18:10:25', 'entrada'),
(25, 287, 12, '0000-00-00', '2025-06-05 18:28:14', 'entrada'),
(26, 287, 12, '0000-00-00', '2025-06-05 19:50:11', 'entrada'),
(27, 287, 13, '0000-00-00', '2025-06-05 19:52:12', 'entrada'),
(28, 287, 13, '0000-00-00', '2025-06-05 20:09:42', 'entrada'),
(29, 296, 14, '0000-00-00', '2025-06-05 20:15:40', 'entrada'),
(30, 296, 14, '0000-00-00', '2025-06-05 20:26:56', 'entrada'),
(31, 291, 15, '0000-00-00', '2025-06-05 22:54:10', 'entrada'),
(32, 310, 16, '0000-00-00', '2025-06-06 08:59:46', 'entrada'),
(33, 310, 16, '0000-00-00', '2025-06-06 08:59:54', 'entrada'),
(34, 296, 14, '0000-00-00', '2025-06-06 09:23:30', 'entrada'),
(35, 297, 17, '0000-00-00', '2025-06-06 09:25:00', 'entrada'),
(36, 297, 17, '0000-00-00', '2025-06-06 09:25:02', 'entrada'),
(37, 206, 18, '0000-00-00', '2025-06-06 09:42:31', 'entrada'),
(38, 206, 18, '0000-00-00', '2025-06-06 09:42:34', 'entrada'),
(39, 199, 19, '0000-00-00', '2025-06-06 15:03:10', 'entrada'),
(40, 286, 20, '0000-00-00', '2025-06-06 15:05:27', 'entrada'),
(41, 286, 20, '0000-00-00', '2025-06-06 15:05:28', 'entrada'),
(42, 267, 21, '0000-00-00', '2025-06-06 15:08:38', 'entrada'),
(43, 296, 14, '0000-00-00', '2025-06-06 15:10:48', 'entrada'),
(44, 162, 22, '0000-00-00', '2025-06-06 15:42:15', 'entrada'),
(45, 159, 23, '0000-00-00', '2025-06-06 15:43:30', 'entrada'),
(46, 319, 24, '0000-00-00', '2025-06-06 16:08:40', 'entrada'),
(47, 319, 24, '0000-00-00', '2025-06-06 16:08:42', 'entrada'),
(48, 319, 24, '0000-00-00', '2025-06-06 16:08:44', 'entrada'),
(49, 319, 24, '0000-00-00', '2025-06-06 16:08:45', 'entrada'),
(50, 319, 24, '0000-00-00', '2025-06-06 16:39:53', 'entrada'),
(51, 309, 25, '0000-00-00', '2025-06-06 16:59:12', 'entrada'),
(52, 157, 9, '0000-00-00', '2025-06-06 17:22:05', 'entrada'),
(53, 157, 9, '0000-00-00', '2025-06-06 17:49:32', 'entrada'),
(54, 157, 9, '0000-00-00', '2025-06-06 17:49:38', 'entrada'),
(55, 183, 33, '0000-00-00', '2025-06-06 19:18:02', 'entrada'),
(56, 183, 33, '0000-00-00', '2025-06-06 19:18:07', 'entrada'),
(57, 208, 32, '0000-00-00', '2025-06-06 19:20:45', 'entrada'),
(68, 271, 44, '0000-00-00', '2025-06-06 19:57:02', 'entrada'),
(69, 271, 44, '0000-00-00', '2025-06-06 19:57:03', 'entrada'),
(70, 271, 44, '0000-00-00', '2025-06-06 19:57:04', 'entrada'),
(71, 271, 44, '0000-00-00', '2025-06-06 19:57:05', 'entrada'),
(72, 271, 44, '0000-00-00', '2025-06-06 19:57:06', 'entrada'),
(73, 271, 44, '0000-00-00', '2025-06-06 19:57:07', 'entrada'),
(74, 271, 44, '0000-00-00', '2025-06-06 19:57:08', 'entrada'),
(75, 271, 44, '0000-00-00', '2025-06-06 19:57:09', 'entrada'),
(76, 323, 29, '0000-00-00', '2025-06-06 21:13:08', 'entrada'),
(77, 229, 54, '0000-00-00', '2025-06-06 21:18:56', 'entrada'),
(78, 161, 53, '0000-00-00', '2025-06-06 22:23:31', 'entrada'),
(79, 318, 38, '0000-00-00', '2025-06-09 08:35:09', 'entrada'),
(80, 310, 16, '0000-00-00', '2025-06-09 09:13:06', 'entrada'),
(81, 172, 26, '0000-00-00', '2025-06-09 17:26:04', 'entrada'),
(82, 309, 25, '0000-00-00', '2025-06-09 17:54:13', 'entrada'),
(83, 164, 55, '0000-00-00', '2025-06-09 19:01:10', 'entrada'),
(84, 164, 55, '0000-00-00', '2025-06-09 19:01:13', 'entrada'),
(85, 164, 55, '0000-00-00', '2025-06-09 19:01:14', 'entrada'),
(86, 164, 55, '0000-00-00', '2025-06-09 19:01:19', 'entrada'),
(87, 208, 32, '0000-00-00', '2025-06-09 19:05:39', 'entrada'),
(88, 324, 56, '0000-00-00', '2025-06-09 19:45:44', 'entrada'),
(89, 185, 57, '0000-00-00', '2025-06-09 20:58:50', 'entrada'),
(90, 269, 58, '0000-00-00', '2025-06-09 21:01:33', 'entrada'),
(91, 229, 54, '0000-00-00', '2025-06-09 21:27:27', 'entrada'),
(92, 161, 53, '0000-00-00', '2025-06-09 23:00:27', 'entrada'),
(93, 235, 28, '0000-00-00', '2025-06-10 00:06:40', 'entrada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clases`
--

CREATE TABLE `clases` (
  `id` int(11) NOT NULL,
  `profesor_id` int(11) NOT NULL,
  `dia_semana` enum('Lunes','Martes','Miércoles','Jueves','Viernes','Sábado','Domingo') NOT NULL,
  `hora_inicio` time NOT NULL,
  `duracion_minutos` int(11) NOT NULL,
  `pago_por_clase` decimal(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clases_dadas`
--

CREATE TABLE `clases_dadas` (
  `id` int(11) NOT NULL,
  `turno_id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `alumnos` int(11) DEFAULT 0,
  `observaciones` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clases_realizadas`
--

CREATE TABLE `clases_realizadas` (
  `id` int(11) NOT NULL,
  `profesor_id` int(11) NOT NULL,
  `dia` date NOT NULL,
  `horario_inicio` time DEFAULT NULL,
  `horario_fin` time DEFAULT NULL,
  `hora` time NOT NULL,
  `turno_id` int(11) DEFAULT NULL,
  `es_recuperacion` tinyint(1) DEFAULT 0,
  `fecha` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `dni` varchar(20) NOT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `correo` varchar(100) DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `fecha_ingreso` date DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `rfid_uid` varchar(100) DEFAULT NULL,
  `tarjeta_rfid` varchar(50) DEFAULT NULL,
  `estado` varchar(20) NOT NULL DEFAULT 'Activo',
  `fecha_vencimiento` date DEFAULT NULL,
  `dias_restantes` int(11) DEFAULT 0,
  `dias_disponibles` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `nombre`, `apellido`, `dni`, `telefono`, `correo`, `fecha_nacimiento`, `fecha_ingreso`, `email`, `rfid_uid`, `tarjeta_rfid`, `estado`, `fecha_vencimiento`, `dias_restantes`, `dias_disponibles`) VALUES
(157, 'MIA ISABELLA', 'Pasini', '47799704', '2664481673', NULL, NULL, NULL, 'isapasini8@gmail.com', '0005975179', NULL, 'Activo', '2025-07-04', 25, 0),
(158, 'MARCO', 'Reta', '47669476', '54-2665033335', NULL, NULL, NULL, 'marcoereta@sanluis.edu.ar', NULL, NULL, 'Activo', NULL, 0, 0),
(159, 'VICTORIA', 'Garcia', '46257903', '54-2948455864', '', '2005-02-08', NULL, '', '0000611542', NULL, 'Activo', '2025-06-30', 21, 0),
(160, 'SERGIO ARIEL', 'Calderon', '28491496', '54-2664635795', NULL, NULL, NULL, 'gauchitogil7@gmail.com', NULL, NULL, 'Activo', NULL, 0, 0),
(161, 'MARCOS', 'Lopez', '30481436', '2664835058', '', '1984-01-26', NULL, 'elmejocitolopez@hotmail.com.ar', '0000600940', NULL, 'Activo', '2025-07-07', 28, 0),
(162, 'NICOLAS', 'Sosa', '46806522', '54-2664661258', '', '2005-10-17', NULL, '', '0003398912', NULL, 'Activo', '2025-06-30', 21, 0),
(163, 'JOS? EDUARDO', 'Gomez', '26781420', '54-2664988739', NULL, NULL, NULL, 'josegomezz2881@gmail.com', NULL, NULL, 'Activo', NULL, 0, 0),
(164, 'MICAELA', 'Alfonzo', '47669433', '54-2664619234', '', '2006-11-01', NULL, 'micaelaalfonzo84@gmail.com', '0004815450', NULL, 'Activo', '2025-06-07', 0, 0),
(165, 'VANESSA', 'Alcaraz', '25166169', '54-2665105155', NULL, NULL, NULL, 'vanesalca2903@gmail.com', NULL, NULL, 'Activo', NULL, 0, 0),
(166, 'SANTIAGO', 'Olivera', '47318493', '54-2665101791', '', '2006-11-05', NULL, '', '0000603335', NULL, 'Activo', '2025-06-12', 3, 0),
(167, 'JOSE ALEJANDRO', 'Ag?ero', '32872410', '54-2664488573', NULL, NULL, NULL, 'alemarinobianc@gmail.com', NULL, NULL, 'Activo', NULL, 0, 0),
(168, 'LEANDRO', 'Quevedo', '39092222', '54-2665101565', NULL, NULL, NULL, '', NULL, NULL, 'Activo', NULL, 0, 0),
(169, 'CHRISTIAN', 'Gaedo', '44738826', '54-2664003505', NULL, NULL, NULL, '', NULL, NULL, 'Activo', NULL, 0, 0),
(170, 'SOSA SOL', 'Nahir', '35196835', '2664546799', NULL, NULL, NULL, '', NULL, NULL, 'Activo', NULL, 0, 0),
(171, 'MATEO', 'Suarez', '43809868', '3534454015', NULL, NULL, NULL, '', NULL, NULL, 'Activo', NULL, 0, 0),
(172, 'JONATHAN', 'Aval', '36571365', '54-2215628137', '', '1991-10-22', NULL, '', '0006122028', NULL, 'Activo', '2025-06-12', 3, 0),
(173, 'LUCAS', 'Gutierrez', '35105869', '54-2664324345', NULL, NULL, NULL, 'lucasabelgutierrez@gmail.com', NULL, NULL, 'Activo', NULL, 0, 0),
(174, 'MAXIMILIANO BENJAMIN', 'Abaurre', '52354975', '54-2664704774', NULL, NULL, NULL, '', NULL, NULL, 'Activo', NULL, 0, 0),
(175, 'VALENTINA', 'Nolef', '50916773', '54-3512270397', NULL, NULL, NULL, 'valentinanolef573@gmail.com', NULL, NULL, 'Activo', NULL, 0, 0),
(176, 'LUCIANA AZUL', 'Nolef', '47664933', '54-3513263028', NULL, NULL, NULL, 'lulunolef@gmail.com', NULL, NULL, 'Activo', NULL, 0, 0),
(177, 'ALEXIS', 'Chavero', '48354312', '54-2665247330', '', '2008-03-12', NULL, '', '0000428128', NULL, 'Activo', '2025-06-07', 0, 0),
(178, 'FATIMA', 'Balmaceda', '47266608', '54-2665276725', NULL, NULL, NULL, '', NULL, NULL, 'Activo', NULL, 0, 0),
(179, 'LUCIANO', 'Sanchez', '38750487', '54-2664774911', NULL, NULL, NULL, '', NULL, NULL, 'Activo', NULL, 0, 0),
(180, 'JONATHAN', 'Miranda', '35316298', '54-2613612654', NULL, NULL, NULL, 'yony5397@gmail.com', NULL, NULL, 'Activo', NULL, 0, 0),
(181, 'ULISES YOEL', 'Abaurre', '29214773', '-', NULL, NULL, NULL, '', NULL, NULL, 'Activo', NULL, 0, 0),
(182, 'GUSTAVO', 'Quieroga', '24242735', '-2664626104', NULL, NULL, NULL, 'gustavoquiroga_07@hotmail.com', NULL, NULL, 'Activo', NULL, 0, 0),
(183, 'MELANIE', 'Jolivot', '48661037', '2665045801', '', '2008-09-21', NULL, '', '0005949264', NULL, 'Activo', '2025-06-22', 13, 0),
(184, 'MATIAS', 'Reta', '42278978', '54-2664615723', NULL, NULL, NULL, '', NULL, NULL, 'Activo', NULL, 0, 0),
(185, 'NICOLLE', 'Allendes', '42220521', '54-2664859106', '', '1999-10-16', NULL, 'allendesnicolle@gmail.com', '0000386163', NULL, 'Activo', '2025-05-28', 0, 0),
(186, 'CARLOS', 'Colabello', '36491187', '54-2664667759', NULL, NULL, NULL, 'nadinsadaca@gmail.com', NULL, NULL, 'Activo', NULL, 0, 0),
(187, 'AUGUSTO', 'Petrino', '48660725', '54-2664940942', '', '2008-08-05', NULL, '', '0003421726', NULL, 'Activo', '2025-06-05', 0, 0),
(188, 'RICARDO DAVID', 'Ojeda', '34182677', '2664730999', NULL, NULL, NULL, 'ojedaricardodavid@gmail.com', NULL, NULL, 'Activo', NULL, 0, 0),
(189, 'LUCIANO MAXIMILIANO', 'Lopez', '48112116', '54-2664329469', '', '2007-07-14', NULL, '', '0009812338', NULL, 'Activo', '2025-06-28', 19, 0),
(190, 'LUDMILA', 'Barrientos', '50916325', '54-2664569049', NULL, NULL, NULL, '', NULL, NULL, 'Activo', NULL, 0, 0),
(191, 'SANTINO', 'Violante', '48660871', '54-2664935956', NULL, NULL, NULL, '', NULL, NULL, 'Activo', NULL, 0, 0),
(192, 'KEVIN', 'Paez', '42142071', '54-2664018276', NULL, NULL, NULL, '', NULL, NULL, 'Activo', NULL, 0, 0),
(193, 'NICOLLE', 'Barrientos', '54163159', '54-2664569049', NULL, NULL, NULL, '', NULL, NULL, 'Activo', NULL, 0, 0),
(194, 'SEBASTIAN', 'Contrera', '34060211', '2664023427', NULL, NULL, NULL, '', NULL, NULL, 'Activo', NULL, 0, 0),
(195, 'FRANCO', 'Herrera', '35857158', '54-2664306242', NULL, NULL, NULL, '', NULL, NULL, 'Activo', NULL, 0, 0),
(196, 'ALEJO', 'Contrera', '53997195', '2664637914', NULL, NULL, NULL, '', NULL, NULL, 'Activo', NULL, 0, 0),
(197, 'EMANUEL', 'Fernandez', '42357183', '2664571176', NULL, NULL, NULL, '', NULL, NULL, 'Activo', NULL, 0, 0),
(198, 'ELIEZER', 'Herrera', '45474826', '54-2664860263', NULL, NULL, NULL, '', NULL, NULL, 'Activo', NULL, 0, 0),
(199, 'MAYCOL', 'Benitez', '46808039', '54-2664979516', '', '2006-01-09', NULL, '', '0003400128', NULL, 'Activo', '2025-06-17', 8, 0),
(200, 'LOURDES', 'Rodriguwez', '47669068', '-2664707370', NULL, NULL, NULL, '', NULL, NULL, 'Activo', NULL, 0, 0),
(201, 'JORGE', 'Michel', '29841737', '54-2665068418', NULL, NULL, NULL, 'jmitchell2405@gmail.com', NULL, NULL, 'Activo', NULL, 0, 0),
(202, 'MARCELO LEONARDO', 'Perrone', '34699597', '54-2664302227', '', '1989-06-28', NULL, 'elmatador_29@hotmail.com', '0001692023', NULL, 'Activo', '2025-05-30', 0, 0),
(203, 'SESMILO', 'Abril', '47266803', '54-2664024086', NULL, NULL, NULL, 'sesmiloabril@gmail.com', NULL, NULL, 'Activo', NULL, 0, 0),
(204, 'AGUSTIN', 'Fuentes', '45802926', '54-2664883075', NULL, NULL, NULL, 'agustinfuentes631@gmail.com', NULL, NULL, 'Activo', NULL, 0, 0),
(205, 'NICOLAS', 'Gimenez', '35768064', '54-2664507070', NULL, NULL, NULL, 'nicolasgimenez91@live.com', NULL, NULL, 'Activo', NULL, 0, 0),
(206, 'PABLO', 'Castro', '48150666', '54-2664012868', '', '2007-09-20', NULL, 'pablocastro171187@gmail.com', '0001762716', NULL, 'Activo', '2025-07-01', 22, 0),
(207, 'AYRTON', 'Ojeda', '54164238', '54-2664730999', NULL, NULL, NULL, '', NULL, NULL, 'Activo', NULL, 0, 0),
(208, 'ANDREINA', 'Lucero', '36711896', '54-2613386811', '', '1992-06-08', NULL, '', '0000548755', NULL, 'Activo', '2025-06-25', 16, 0),
(209, 'EMANUEL EZEQUIEL', 'Franco', '46260128', '54-2664701358', NULL, NULL, NULL, 'can.irove23lili@gmail.com', NULL, NULL, 'Activo', NULL, 0, 0),
(210, 'VANESA', 'Lopez', '31637261', '54-2664000408', NULL, NULL, NULL, '', NULL, NULL, 'Activo', NULL, 0, 0),
(211, 'SHEILA', 'Garro', '48661257', '54-2664193021', NULL, NULL, NULL, 'Sheilangarro@sanluis.edu.ar', NULL, NULL, 'Activo', NULL, 0, 0),
(212, 'TOMAS', 'Molina', '50668089', '54-2664831964', NULL, NULL, NULL, 'walmolina61@gmail.com', NULL, NULL, 'Activo', NULL, 0, 0),
(213, 'JUAN CRUZ', 'Sanchez', '50820518', '54-2665000111', NULL, NULL, NULL, '', NULL, NULL, 'Activo', NULL, 0, 0),
(214, 'FACUNDO', 'Lara', '47487021', '54-2644417439', '', '2006-05-13', NULL, 'Larafacundo050@gmail.com', '0005972745', NULL, 'Activo', '2025-06-14', 5, 0),
(215, 'JUAN PABLO', 'Zambrano', '50480126', '54-2664867980', NULL, NULL, NULL, 'Zambranovr@gmail.com', NULL, NULL, 'Activo', NULL, 0, 0),
(216, 'ROCIO', 'Besabe', '46408745', '54-', NULL, NULL, NULL, '', NULL, NULL, 'Activo', NULL, 0, 0),
(217, 'JULIANA', 'Besabe', '50118151', '54-', NULL, NULL, NULL, '', NULL, NULL, 'Activo', NULL, 0, 0),
(218, 'Felipe Olivera', 'Aguirre', '48866091', '2664-563132', NULL, NULL, NULL, 'Oliveraaguirrefelipe@gmail.com', NULL, NULL, 'Activo', NULL, 0, 0),
(219, 'SAID ADRIEL CARINI', 'Carini', '46549743', '54-2665271035', NULL, NULL, NULL, 'saidadriel26@gmail.com', NULL, NULL, 'Activo', NULL, 0, 0),
(220, 'SANTIAGO', 'Molina', '49937741', '54-2664707363', '', '2010-01-06', NULL, '', '0009811658', NULL, 'Activo', '2025-06-06', 0, 0),
(221, 'VICTORIA', 'Morales', '45140878', '54-2664196595', NULL, NULL, NULL, '', NULL, NULL, 'Activo', NULL, 0, 0),
(222, 'Gonzalo', 'Salinas', '39993384', '54-2664362452', NULL, NULL, NULL, 'Talo.salinas12@gmail.com', NULL, NULL, 'Activo', NULL, 0, 0),
(223, 'PEDRO', 'Orteau', '33958337', '54-2664858595', NULL, NULL, NULL, '', NULL, NULL, 'Activo', NULL, 0, 0),
(224, 'GAEL', 'Orteau', '52553641', '54-2664858595', NULL, NULL, NULL, '', NULL, NULL, 'Activo', NULL, 0, 0),
(225, 'ROCIO', 'Amaya', '42751901', '54-2664839792', NULL, NULL, NULL, '', NULL, NULL, 'Activo', NULL, 0, 0),
(226, 'FACUNDO', 'Villalba', '42976791', '54-2664857676', NULL, NULL, NULL, '', NULL, NULL, 'Activo', NULL, 0, 0),
(227, 'Sanchez David', 'Sanchez', '46617120', '54-2664950838', NULL, NULL, NULL, 'Huetagoyenadaiana@gmail.com', NULL, NULL, 'Activo', NULL, 0, 0),
(228, 'LUCAS', 'Valenzuela', '37723844', '54-2664725754', NULL, NULL, NULL, '', NULL, NULL, 'Activo', NULL, 0, 0),
(229, 'Esteban Fernando', 'Nesprias', '28184653', '54-2664747996', '', '1980-09-08', NULL, 'nespriasesteban@gmail.com', '0000548934', NULL, 'Activo', '2025-07-02', 23, 0),
(230, 'vicente', 'Montero', '49346594', '54-2664682621', NULL, NULL, NULL, 'vicentemontero2091@gmail.com', NULL, NULL, 'Activo', NULL, 0, 0),
(231, 'Ignacio', 'Godoy', '33757452', '266-4878020', NULL, NULL, NULL, 'ignacio.g182@gmail.com', NULL, NULL, 'Activo', NULL, 0, 0),
(232, 'Gabriel', 'Salinas', '49867741', '54-2664947457', NULL, NULL, NULL, 'Salinasagustin@sanluis.edu.ar', NULL, NULL, 'Activo', NULL, 0, 0),
(233, 'KAREN', 'Salinas', '35315300', '54-2665118465', NULL, NULL, NULL, '', NULL, NULL, 'Activo', NULL, 0, 0),
(234, 'CAMILO', 'Perez', '52049298', '54-2665118465', NULL, NULL, NULL, '', NULL, NULL, 'Activo', NULL, 0, 0),
(235, 'tomas', 'Amaya', '43840328', '54-2665286020', '', '2002-03-01', NULL, 'Tadeamaya2002@gmail.com', '0004930481', NULL, 'Activo', '2025-07-02', 23, 0),
(236, 'Kevin', 'Fagotti', '42065802', '54-2665053473', NULL, NULL, NULL, 'fagottikevin@gmail..com', NULL, NULL, 'Activo', NULL, 0, 0),
(237, 'Daniel', 'Tejada', '46072768', '54-2665119929', NULL, NULL, NULL, 'Danielgaeltejadapecorari@gmail.com', NULL, NULL, 'Activo', NULL, 0, 0),
(238, 'Jonathan', 'Rodriguwez', '45563331', '54-2664201525', NULL, NULL, NULL, 'Jonathanarielrodriguez18@gmail.com', NULL, NULL, 'Activo', NULL, 0, 0),
(239, 'IGNACIO', 'Balmaceda', '46485720', '54-2664660008', NULL, NULL, NULL, '', NULL, NULL, 'Activo', NULL, 0, 0),
(240, 'Jorge', 'Aguirre', '34877754', '54-2664640870', NULL, NULL, NULL, '34877754ja@gmail.com', NULL, NULL, 'Activo', NULL, 0, 0),
(241, 'Esteban Agust?n', 'Flores', '43490313', '54-2664502662', NULL, NULL, NULL, 'aguflores544@gmail.com', NULL, NULL, 'Activo', NULL, 0, 0),
(242, 'Maxi', 'Gatica', '45382469', '54-2664770002', NULL, NULL, NULL, 'maxi68gatica@gmail.com', NULL, NULL, 'Activo', NULL, 0, 0),
(243, 'Quiroga', 'Lara', '44954879', '54-2664863447', NULL, NULL, NULL, 'Laraquiroga375@gmail.com', NULL, NULL, 'Activo', NULL, 0, 0),
(244, 'Martin Ignacio', 'Ramirez', '53572704', '54-2664878718', NULL, NULL, NULL, 'Giselasanchezz1626@gmail.com', NULL, NULL, 'Activo', NULL, 0, 0),
(245, 'GIOVANNI', 'Aguilera', '55416829', '54-2664898148', NULL, NULL, NULL, '', NULL, NULL, 'Activo', NULL, 0, 0),
(246, 'fabiana', 'Pallarez', '20414406', '54-2664335205', NULL, NULL, NULL, '', NULL, NULL, 'Activo', NULL, 0, 0),
(247, 'Agustina', 'Giacomazzi', '39382322', '2664-974450', NULL, NULL, NULL, 'Ailengiacomazzi7@gmail.com', NULL, NULL, 'Activo', NULL, 0, 0),
(248, 'Sergio', 'Ferreyra', '23483786', '54-2664506137', NULL, NULL, NULL, '', NULL, NULL, 'Activo', NULL, 0, 0),
(249, 'Cristobal', 'Ferreyra', '52358543', '54-2664506137', NULL, NULL, NULL, '', NULL, NULL, 'Activo', NULL, 0, 0),
(250, 'Ismael', 'Alvarez', '39990686', '54-2664682950', NULL, NULL, NULL, '', NULL, NULL, 'Activo', NULL, 0, 0),
(251, 'Jonathan', 'Rodriguwez', '46485719', '54-2665040032', NULL, NULL, NULL, 'Jonederrod@gmail.com', NULL, NULL, 'Activo', NULL, 0, 0),
(252, 'Camelin', 'Rua', '43551801', '54-2664846127', NULL, NULL, NULL, 'camelinrua01@gmail.com', NULL, NULL, 'Activo', NULL, 0, 0),
(253, 'Cinthia', 'Rua', '40318603', '54-2664858860', NULL, NULL, NULL, 'Ruacinthiasoledad@gmail.com', NULL, NULL, 'Activo', NULL, 0, 0),
(254, 'Florencia', 'Britos', '36227943', '54-2664386000', NULL, NULL, NULL, 'britosflorencia@yahoo.com', NULL, NULL, 'Activo', NULL, 0, 0),
(255, 'Alejandro', 'Videla', '35475353', '54-2664709236', NULL, NULL, NULL, 'bekovidela@gmail.com', NULL, NULL, 'Activo', NULL, 0, 0),
(256, 'siracusa', 'Siracusa', '33515630', '54-2665037234', NULL, NULL, NULL, 'vanesasiracusa85@gmail.com', NULL, NULL, 'Activo', NULL, 0, 0),
(257, 'Gustavo rodrigo', 'Diaz', '36559479', '54-2665252383', NULL, NULL, NULL, 'Gustavodiaz3655@gmail.com', NULL, NULL, 'Activo', NULL, 0, 0),
(258, 'erika judith', 'Quiroga', '29887697', '54-2664632870', NULL, NULL, NULL, '', NULL, NULL, 'Activo', NULL, 0, 0),
(259, 'Romina', 'Godoy', '32817529', '266-4855578', NULL, NULL, NULL, 'romisolgod@gmail.com', NULL, NULL, 'Activo', NULL, 0, 0),
(260, 'Facundo', 'Romero', '46807701', '54-2665103591', NULL, NULL, NULL, 'fr665258@gmail.com', NULL, NULL, 'Activo', NULL, 0, 0),
(261, 'juan', 'Benitez', '42245847', '54-3585044870', NULL, NULL, NULL, 'tunnki20@gmail.com', NULL, NULL, 'Activo', NULL, 0, 0),
(262, 'Willians', 'Andrada', '32491500', '02664-15862044', NULL, NULL, NULL, 'wiandrada@cencosud.com', NULL, NULL, 'Activo', NULL, 0, 0),
(263, 'Myriam', 'Miranda', '29426174', '54-2664770627', NULL, NULL, NULL, 'myriammiranda034@gmail.com', NULL, NULL, 'Activo', NULL, 0, 0),
(264, 'Bianca', 'Rojas', '43157911', '54-Hhjbv', NULL, NULL, NULL, 'hhjk', NULL, NULL, 'Activo', NULL, 0, 0),
(265, 'juan', 'Pereyra', '39799572', '54-2664977569', NULL, NULL, NULL, '', NULL, NULL, 'Activo', NULL, 0, 0),
(266, 'Lucas', 'Ochoa', '38221304', '54-2664866846', NULL, NULL, NULL, 'Lucas_nestor19@hotmail.com', NULL, NULL, 'Activo', NULL, 0, 0),
(267, 'Rodrigo', 'Castro', '39091218', '54-2664859640', '', '1995-06-12', NULL, '', '0004849768', NULL, 'Activo', '2025-06-26', 17, 0),
(268, 'Juan', 'Villanueva', '43384025', '54-2664715523', NULL, NULL, NULL, '', NULL, NULL, 'Activo', NULL, 0, 0),
(269, 'lucia', 'Funes', '44680224', '54-2302610041', '', '0000-00-00', NULL, '', '0000588155', NULL, 'Activo', NULL, 0, 0),
(270, 'Mar?a Ayelen', 'Mayordomo', '42909151', '54-2665244992', NULL, NULL, NULL, 'ayeelen2024@gmail.com', NULL, NULL, 'Activo', NULL, 0, 0),
(271, 'Uma Merlina', 'Gatica', '52049106', '2664-130513', '', '2012-01-24', NULL, 'mariaelenaalcaraz11@gmail.com', '0006029727', NULL, 'Activo', '2025-06-06', 0, 0),
(272, 'Roc?o', 'Oviedo', '47670395', '54-2665108493', NULL, NULL, NULL, 'rociooviedo0812.ma@gmail.com', NULL, NULL, 'Activo', NULL, 0, 0),
(273, 'nicol', 'Aguilera', '48017600', '54-2664033765', NULL, NULL, NULL, '', NULL, NULL, 'Activo', NULL, 0, 0),
(274, 'Alberto jose', 'Montiel', '43359827', '54-2664564049', NULL, NULL, NULL, 'Montielbeto10@gmail.com', NULL, NULL, 'Activo', NULL, 0, 0),
(275, 'Martin Mu?oz', 'Almeida', '58345206', '54-2665116525', NULL, NULL, NULL, '', NULL, NULL, 'Activo', NULL, 0, 0),
(276, 'Guadalupe Carina', 'Escudero', '46617290', '54-2665137727', NULL, NULL, NULL, 'guadaescu11@gmail.com', NULL, NULL, 'Activo', NULL, 0, 0),
(277, 'Facundo David memian', 'Mu?oz', '48150701', '54-2664009965', NULL, NULL, NULL, '', NULL, NULL, 'Activo', NULL, 0, 0),
(278, 'Coria giuliano', 'Nahir', '46545395', '54-2664613821', NULL, NULL, NULL, 'Gulianoc21@gmail.com', NULL, NULL, 'Activo', NULL, 0, 0),
(279, 'Tiziano', 'Dagfal', '48660684', '54-2664173282', NULL, NULL, NULL, '', NULL, NULL, 'Activo', NULL, 0, 0),
(280, 'luciano', 'Torres', '35916666', '54-2664298950', NULL, NULL, NULL, '', NULL, NULL, 'Activo', NULL, 0, 0),
(281, 'brenda', 'Mur', '37822069', '54-2664298950', NULL, NULL, NULL, '', NULL, NULL, 'Activo', NULL, 0, 0),
(282, 'yutiel', 'Torres', '56088319', '-', NULL, NULL, NULL, '', NULL, NULL, 'Activo', NULL, 0, 0),
(283, 'ignacio', 'Torres', '57407460', '-', NULL, NULL, NULL, '', NULL, NULL, 'Activo', NULL, 0, 0),
(284, 'aylen', 'Torres', '52356298', '-', NULL, NULL, NULL, '', NULL, NULL, 'Activo', NULL, 0, 0),
(285, 'maycol nicolas', 'Aguilera', '43282156', '54-2664868909', NULL, NULL, NULL, '', NULL, NULL, 'Activo', NULL, 0, 0),
(286, 'Andres', 'Ochoa', '48527523', '54-2664898005', '', '2008-05-08', NULL, 'ochoaandres809@gmail.com', '0004895982', NULL, 'Activo', '2025-06-20', 11, 0),
(287, 'Emma', 'Abaurre', '57601598', '-2664704774', '', '0000-00-00', NULL, 'Joelabaurre@gmail.com', '0000591593', NULL, 'Activo', '2025-07-04', 25, 0),
(288, 'M?a', 'Amaya', '56652772', '54-2664928121', NULL, NULL, NULL, 'maribelcalderon316@gmail.com', NULL, NULL, 'Activo', NULL, 0, 0),
(289, 'EMANUEL', 'Arias', '46164189', '54-2664325152', NULL, NULL, NULL, '', NULL, NULL, 'Activo', NULL, 0, 0),
(290, 'valent?n', 'Lorenzino', '48270067', '54-', NULL, NULL, NULL, 'valentinlorenzino838@gmail.com', NULL, NULL, 'Activo', NULL, 0, 0),
(291, 'Ignacio', 'Oviedo', '44752616', '54-2665277088', '', '2002-07-22', NULL, 'ignnaoviedo@gmail.com', '0004736054', NULL, 'Activo', '2025-07-06', 27, 0),
(292, 'Melodi', 'Guzman', '49494222', '54-2664014422', NULL, NULL, NULL, '', NULL, NULL, 'Activo', NULL, 0, 0),
(293, 'Amalia', 'Lucero', '41841651', '266-4303675', NULL, NULL, NULL, 'amavlucero16@gmail.com', NULL, NULL, 'Activo', NULL, 0, 0),
(294, 'MARIA DEL CARMEN', 'Romero', '34877743', '54-2664002714', NULL, NULL, NULL, '', NULL, NULL, 'Activo', NULL, 0, 0),
(295, 'leonel', 'Landa', '44953203', '54-2665139753', NULL, NULL, NULL, '', NULL, NULL, 'Activo', NULL, 0, 0),
(296, 'Isaias', 'Reta', '43953762', '54-2664037034', '', '0000-00-00', NULL, 'retamarceloisaias@gmail.com', '0000598072', NULL, 'Activo', '2025-07-05', 26, 0),
(297, 'Ivan', 'Reta', '45800853', '54-2664862818', '', '0000-00-00', NULL, 'retaivantobias@gmail.com', '0006185806', NULL, 'Activo', '2025-07-02', 23, 0),
(298, 'LUIS', 'Baron', '48527637', '54-2664842835', NULL, NULL, NULL, '', NULL, NULL, 'Activo', NULL, 0, 0),
(299, 'Ana laura', 'Lucero', '36046457', '266-5110114', NULL, NULL, NULL, 'analaura_144@hotmail.com', NULL, NULL, 'Activo', NULL, 0, 0),
(300, 'GUERRY JUAN PABLO', 'fiorillo', '54163112', '54-2265047912', NULL, NULL, NULL, '', NULL, NULL, 'Activo', NULL, 0, 0),
(301, 'GUERRY IGNACIO BENJAMIN', 'fiorillo', '52356463', '54-2665047912', NULL, NULL, NULL, '', NULL, NULL, 'Activo', NULL, 0, 0),
(302, 'VALENTINO OJEDA', 'Oviedo', '57319216', '54-2665100775', NULL, NULL, NULL, '', NULL, NULL, 'Activo', NULL, 0, 0),
(303, 'walter', 'Gatica', '27337896', '54-2664251854', NULL, NULL, NULL, '', NULL, NULL, 'Activo', NULL, 0, 0),
(304, 'marita', 'Alcaraz', '31047779', '54-2665130513', '', '1985-01-17', NULL, '', '0009811597', NULL, 'Activo', '2025-06-06', 0, 0),
(305, 'enzo joaquin', 'Cabral', '49102765', '54-2664548702', NULL, NULL, NULL, '', NULL, NULL, 'Activo', NULL, 0, 0),
(306, 'Leonel Elias De', 'De Bella', '41682821', '54-2646209757', NULL, NULL, NULL, 'leoneldebella1999@gmail.com', NULL, NULL, 'Activo', NULL, 0, 0),
(307, 'Mariana Soledad', 'Ochoa', '44738124', '2664-407973', NULL, NULL, NULL, 'ochoasoledad26@gmail.com', NULL, NULL, 'Activo', NULL, 0, 0),
(308, 'Benjamin', 'Francisco', '42706894', '54-3874830925', NULL, NULL, NULL, 'Benjamin16francisco@gmail.com', NULL, NULL, 'Activo', NULL, 0, 0),
(309, 'tobias antonio hess', 'Cadelago', '50667915', '54-2664035796', '', '2010-10-22', NULL, '', '0003429931', NULL, 'Activo', '2025-06-28', 19, 0),
(310, 'tiago', 'Fernandez', '48354219', '54-2664327660', '', '2008-02-23', NULL, 'fernandeztiagogabriel@gmail.com', '0003400604', NULL, 'Activo', '2025-07-02', 23, 0),
(311, 'Tomas Joaquin', 'Gallardo', '45382734', '54-2664164014', '', '2004-03-24', NULL, 'tomas.joaqgallardo@gmail.com', '0004721767', NULL, 'Activo', '2025-06-06', 0, 0),
(312, 'emilio', 'Stella', '48270382', '54-2664006356', '', '2008-03-11', NULL, '', '0006048462', NULL, 'Activo', '2025-06-18', 9, 0),
(313, 'Joaquin', 'SAIN', '46807917', '54-2664407032', '', '2007-07-14', NULL, 'Joakosain7@gmail.com', '0006062560', NULL, 'Activo', '2025-06-27', 18, 0),
(314, 'Agust?n', 'Molina', '52358453', '54-2664831964', '', '0000-00-00', NULL, 'walmolina61@gmail.com', '0000594072', NULL, 'Activo', NULL, 0, 0),
(315, 'gabriel alejandro quiroga', 'Chavez', '46260046', '54-2664016533', '', '2004-12-15', NULL, '', '0003399888', NULL, 'Activo', '2025-06-11', 2, 0),
(316, 'jehiel ismael', 'Reta', '48661293', '54-2665241878', '', '2008-11-03', NULL, '', '0003419022', NULL, 'Activo', '2025-06-11', 2, 0),
(317, 'Fer', 'Perez', '37639216', '54-2657206926', NULL, NULL, NULL, 'fer.perez5toc2@gmail.com', NULL, NULL, 'Activo', NULL, 0, 0),
(318, 'gino', 'Pinelli', '46333191', '54-2665039365', '', '2005-07-29', NULL, '', '0000581081', NULL, 'Activo', '2025-06-18', 9, 0),
(319, 'Nahir Alihuen Garcia', 'Moyano', '52353367', '266-4200181', '', '2012-02-23', NULL, '', '0006174581', NULL, 'Activo', '2025-06-20', 11, 0),
(320, 'matias', 'Diaz', '35503870', '54-2665125045', '', '1992-04-07', NULL, '', '0003419251', NULL, 'Activo', '2025-06-22', 13, 0),
(321, 'Agustina', 'Fredes', '47266751', '-2664154223', NULL, NULL, NULL, 'afredes675@gmail.com', NULL, NULL, 'Activo', NULL, 0, 0),
(322, 'David', 'Etcheves', '33955561', '54-92664858926', NULL, NULL, NULL, 'davidetcheves@gmail.com', NULL, NULL, 'Activo', NULL, 0, 0),
(323, 'santiago', 'Arce', '45382012', '2664-879674', '', '2004-02-02', NULL, 'Santiagoarce0990@gmail.com', '0006052556', NULL, 'Activo', '2025-06-30', 21, 0),
(324, 'morena', 'orozco', '48620693', '2665069310', '', '2008-07-11', NULL, NULL, '0006171214', NULL, 'Activo', NULL, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingresos_profesores`
--

CREATE TABLE `ingresos_profesores` (
  `id` int(11) NOT NULL,
  `profesor_id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `hora_ingreso` time NOT NULL,
  `hora_egreso` time DEFAULT NULL,
  `tipo` enum('ingreso','egreso') NOT NULL DEFAULT 'ingreso',
  `fecha_hora` datetime NOT NULL DEFAULT current_timestamp(),
  `hora_entrada` time DEFAULT NULL,
  `hora_salida` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ingresos_profesores`
--

INSERT INTO `ingresos_profesores` (`id`, `profesor_id`, `fecha`, `hora_ingreso`, `hora_egreso`, `tipo`, `fecha_hora`, `hora_entrada`, `hora_salida`) VALUES
(1, 1, '0000-00-00', '00:00:00', NULL, 'ingreso', '2025-06-05 05:40:36', NULL, NULL),
(2, 1, '0000-00-00', '00:00:00', NULL, 'egreso', '2025-06-05 05:40:45', NULL, NULL),
(3, 1, '0000-00-00', '00:00:00', NULL, 'ingreso', '2025-06-05 05:40:46', NULL, NULL),
(4, 1, '0000-00-00', '00:00:00', NULL, 'egreso', '2025-06-05 05:59:07', NULL, NULL),
(5, 1, '0000-00-00', '00:00:00', NULL, 'ingreso', '2025-06-05 06:00:28', NULL, NULL),
(6, 1, '0000-00-00', '00:00:00', NULL, 'ingreso', '2025-06-05 06:29:17', NULL, NULL),
(7, 1, '0000-00-00', '00:00:00', NULL, 'ingreso', '2025-06-05 06:29:25', NULL, NULL),
(8, 1, '0000-00-00', '00:00:00', NULL, 'ingreso', '2025-06-05 13:55:52', NULL, NULL),
(9, 1, '0000-00-00', '00:00:00', NULL, 'ingreso', '2025-06-05 14:13:28', NULL, NULL),
(10, 1, '0000-00-00', '00:00:00', NULL, 'ingreso', '2025-06-05 14:14:00', NULL, NULL),
(11, 1, '0000-00-00', '00:00:00', NULL, 'ingreso', '2025-06-05 16:17:12', NULL, NULL),
(12, 1, '0000-00-00', '00:00:00', NULL, 'ingreso', '2025-06-05 16:17:18', NULL, NULL),
(13, 1, '0000-00-00', '00:00:00', NULL, 'ingreso', '2025-06-05 16:17:25', NULL, NULL),
(14, 1, '0000-00-00', '00:00:00', NULL, 'ingreso', '2025-06-05 17:29:51', NULL, NULL),
(15, 1, '0000-00-00', '00:00:00', NULL, 'ingreso', '2025-06-05 17:29:56', NULL, NULL),
(16, 1, '0000-00-00', '00:00:00', NULL, 'ingreso', '2025-06-05 18:10:13', '18:10:13', '18:10:20'),
(17, 1, '0000-00-00', '00:00:00', NULL, 'ingreso', '2025-06-05 18:28:20', '18:28:20', NULL),
(18, 1, '0000-00-00', '00:00:00', NULL, 'ingreso', '2025-06-05 19:49:59', NULL, NULL),
(19, 1, '2025-06-05', '00:00:00', NULL, 'ingreso', '2025-06-05 19:52:20', '19:52:20', '19:52:25'),
(20, 1, '2025-06-05', '00:00:00', NULL, 'ingreso', '2025-06-05 20:08:27', '20:08:27', '20:09:49'),
(21, 3, '2025-06-05', '00:00:00', NULL, 'ingreso', '2025-06-05 23:00:04', '23:00:04', '23:00:14'),
(22, 1, '2025-06-06', '00:00:00', NULL, 'ingreso', '2025-06-06 15:06:17', '15:06:17', '15:06:21'),
(23, 1, '2025-06-06', '00:00:00', NULL, 'ingreso', '2025-06-06 15:06:25', '15:06:25', '17:18:28'),
(24, 2, '2025-06-06', '00:00:00', NULL, 'ingreso', '2025-06-06 17:00:04', '17:00:04', '17:00:11'),
(25, 2, '2025-06-06', '00:00:00', NULL, 'ingreso', '2025-06-06 17:01:07', '17:01:07', '18:59:20'),
(26, 1, '2025-06-06', '00:00:00', NULL, 'ingreso', '2025-06-06 17:21:58', '17:21:58', NULL),
(27, 3, '2025-06-06', '00:00:00', NULL, 'ingreso', '2025-06-06 21:53:25', '21:53:25', '21:53:29'),
(28, 3, '2025-06-06', '00:00:00', NULL, 'ingreso', '2025-06-06 22:01:24', '22:01:24', '22:25:40'),
(29, 1, '0000-00-00', '00:00:00', NULL, 'ingreso', '2025-06-06 22:11:34', NULL, NULL),
(30, 3, '2025-06-09', '00:00:00', NULL, 'ingreso', '2025-06-09 07:48:43', '07:48:43', NULL),
(31, 2, '2025-06-09', '00:00:00', NULL, 'ingreso', '2025-06-09 16:59:31', '16:59:31', '19:00:43'),
(32, 1, '2025-06-09', '00:00:00', NULL, 'ingreso', '2025-06-09 17:15:00', '17:15:00', '17:15:14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `membresias`
--

CREATE TABLE `membresias` (
  `id` int(11) NOT NULL,
  `cliente_id` int(11) NOT NULL,
  `plan_id` int(11) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_vencimiento` date DEFAULT NULL,
  `fecha_fin` date NOT NULL,
  `monto_pagado` decimal(10,2) NOT NULL,
  `metodo_pago` varchar(50) NOT NULL,
  `clases_restantes` int(11) NOT NULL,
  `plan_adicional_id` int(11) DEFAULT NULL,
  `monto` decimal(10,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `membresias`
--

INSERT INTO `membresias` (`id`, `cliente_id`, `plan_id`, `fecha_inicio`, `fecha_vencimiento`, `fecha_fin`, `monto_pagado`, `metodo_pago`, `clases_restantes`, `plan_adicional_id`, `monto`) VALUES
(8, 157, 2, '2025-06-03', '2025-07-03', '0000-00-00', 15000.00, 'efectivo', 0, NULL, 0.00),
(9, 157, 2, '2025-06-04', '2025-07-04', '0000-00-00', 15000.00, 'Crédito', 4, NULL, 0.00),
(10, 287, 10, '2025-06-04', '2025-07-04', '2025-07-04', 24000.00, 'Transferencia', 0, NULL, 0.00),
(12, 287, 10, '2025-06-04', '2025-07-04', '2025-07-04', 24000.00, 'Transferencia', 10, NULL, 0.00),
(13, 287, 10, '2025-06-02', '2025-07-02', '2025-07-02', 20000.00, 'Efectivo', 10, NULL, 0.00),
(14, 296, 10, '2025-06-05', '2025-07-05', '2025-07-05', 20000.00, 'Transferencia', 8, NULL, 0.00),
(15, 291, 18, '2025-06-06', '2025-07-06', '2025-07-06', 20500.00, 'Transferencia', 7, NULL, 0.00),
(16, 310, 19, '2025-06-02', '2025-07-02', '2025-07-02', 24000.00, 'Transferencia', 9, NULL, 0.00),
(17, 297, 19, '2025-06-02', '2025-07-02', '2025-07-02', 20000.00, 'Transferencia', 10, NULL, 0.00),
(18, 206, 19, '2025-06-01', '2025-07-01', '2025-07-01', 25500.00, 'Transferencia', 10, NULL, 0.00),
(19, 199, 19, '2025-05-17', '2025-06-17', '2025-06-17', 20000.00, 'Transferencia', 11, NULL, 0.00),
(20, 286, 19, '2025-05-20', '2025-06-20', '2025-06-20', 25500.00, 'Transferencia', 10, NULL, 0.00),
(21, 267, 18, '2025-05-26', '2025-06-26', '2025-06-26', 15000.00, 'Transferencia', 7, NULL, 0.00),
(22, 162, 18, '2025-05-30', '2025-06-30', '2025-06-30', 15000.00, 'Transferencia', 7, NULL, 0.00),
(23, 159, 18, '2025-05-30', '2025-06-30', '2025-06-30', 15000.00, 'Transferencia', 7, NULL, 0.00),
(24, 319, 19, '2025-05-20', '2025-06-20', '2025-06-20', 20000.00, 'Transferencia', 7, NULL, 0.00),
(25, 309, 19, '2025-05-28', '2025-06-28', '2025-06-28', 20000.00, 'Transferencia', 10, NULL, 0.00),
(26, 172, 22, '2025-05-12', '2025-06-12', '2025-06-12', 35000.00, 'Transferencia', 23, NULL, 0.00),
(27, 164, 22, '2025-05-07', '2025-06-07', '2025-06-07', 35000.00, 'Transferencia', 24, NULL, 0.00),
(28, 235, 20, '2025-06-02', '2025-07-02', '2025-07-02', 25000.00, 'Cuenta Corriente', 34, NULL, 0.00),
(29, 323, 18, '2025-05-30', '2025-06-30', '2025-06-30', 15000.00, 'Transferencia', 7, NULL, 0.00),
(30, 189, 19, '2025-05-28', '2025-06-28', '2025-06-28', 20000.00, 'Efectivo', 12, NULL, 0.00),
(31, 313, 19, '2025-05-27', '2025-06-27', '2025-06-27', 20000.00, 'Efectivo', 12, NULL, 0.00),
(32, 208, 18, '2025-05-25', '2025-06-25', '2025-06-25', 15000.00, 'Transferencia', 6, NULL, 0.00),
(33, 183, 19, '2025-05-22', '2025-06-22', '2025-06-22', 20000.00, 'Transferencia', 10, NULL, 0.00),
(36, 320, 19, '2025-05-22', '2025-06-22', '2025-06-22', 20000.00, 'Efectivo', 12, NULL, 0.00),
(37, 312, 19, '2025-05-18', '2025-06-18', '2025-06-18', 20000.00, 'Efectivo', 12, NULL, 0.00),
(38, 318, 19, '2025-05-18', '2025-06-18', '2025-06-18', 20000.00, 'Efectivo', 11, NULL, 0.00),
(39, 214, 19, '2025-05-14', '2025-06-14', '2025-06-14', 20000.00, 'Efectivo', 12, NULL, 0.00),
(40, 166, 19, '2025-05-12', '2025-06-12', '2025-06-12', 20000.00, 'Transferencia', 12, NULL, 0.00),
(41, 315, 19, '2025-05-11', '2025-06-11', '2025-06-11', 20000.00, 'Efectivo', 12, NULL, 0.00),
(42, 316, 18, '2025-05-11', '2025-06-11', '2025-06-11', 15000.00, 'Efectivo', 8, NULL, 0.00),
(44, 271, 19, '2025-05-06', '2025-06-06', '2025-06-06', 20000.00, 'Transferencia', 4, NULL, 0.00),
(45, 304, 24, '2025-05-06', '2025-06-06', '2025-06-06', 15000.00, 'Transferencia', 12, NULL, 0.00),
(46, 187, 19, '2025-05-05', '2025-06-05', '2025-06-05', 20000.00, 'Transferencia', 12, NULL, 0.00),
(47, 177, 19, '2025-05-07', '2025-06-07', '2025-06-07', 20000.00, 'Efectivo', 12, NULL, 0.00),
(48, 220, 19, '2025-05-06', '2025-06-06', '2025-06-06', 20000.00, 'Transferencia', 12, NULL, 0.00),
(49, 311, 18, '2025-05-06', '2025-06-06', '2025-06-06', 15000.00, 'Efectivo', 8, NULL, 0.00),
(50, 229, 18, '2025-05-05', '2025-06-05', '2025-06-05', 15000.00, 'Transferencia', 8, NULL, 0.00),
(51, 202, 19, '2025-04-30', '2025-05-30', '2025-05-30', 20000.00, 'Transferencia', 12, NULL, 0.00),
(52, 185, 19, '2025-04-28', '2025-05-28', '2025-05-28', 20000.00, 'Transferencia', 12, NULL, 0.00),
(53, 161, 19, '2025-06-07', '2025-07-07', '2025-07-07', 20000.00, 'Transferencia', 10, NULL, 0.00),
(54, 229, 19, '2025-06-02', '2025-07-02', '2025-07-02', 20000.00, 'Transferencia', 10, NULL, 0.00),
(55, 164, 22, '2025-06-09', '2025-07-09', '2025-07-09', 35000.00, 'Transferencia', 20, NULL, 0.00),
(56, 324, 19, '2025-06-09', '2025-07-09', '2025-07-09', 20000.00, 'Transferencia', 11, NULL, 0.00),
(57, 185, 19, '2025-06-09', '2025-07-09', '2025-07-09', 20000.00, 'Transferencia', 11, NULL, 0.00),
(58, 269, 16, '2025-06-09', '2025-07-09', '2025-07-09', 8000.00, 'Transferencia', 0, NULL, 0.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `membresias_adicionales`
--

CREATE TABLE `membresias_adicionales` (
  `id` int(11) NOT NULL,
  `membresia_id` int(11) NOT NULL,
  `adicional_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `membresias_adicionales`
--

INSERT INTO `membresias_adicionales` (`id`, `membresia_id`, `adicional_id`) VALUES
(1, 12, 1),
(2, 15, 3),
(3, 16, 1),
(4, 18, 3),
(5, 20, 3),
(6, 58, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `membresia_adicionales`
--

CREATE TABLE `membresia_adicionales` (
  `id` int(11) NOT NULL,
  `membresia_id` int(11) NOT NULL,
  `adicional_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos`
--

CREATE TABLE `pagos` (
  `id` int(11) NOT NULL,
  `cliente_id` int(11) NOT NULL,
  `membresia_id` int(11) NOT NULL,
  `fecha_pago` date NOT NULL,
  `monto` decimal(10,2) NOT NULL,
  `metodo_pago` varchar(50) NOT NULL,
  `fecha` date NOT NULL DEFAULT curdate(),
  `observaciones` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos_adicionales`
--

CREATE TABLE `pagos_adicionales` (
  `id` int(11) NOT NULL,
  `membresia_id` int(11) NOT NULL,
  `concepto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos_profesores`
--

CREATE TABLE `pagos_profesores` (
  `id` int(11) NOT NULL,
  `profesor_id` int(11) NOT NULL,
  `fecha_pago` date NOT NULL,
  `monto` decimal(10,2) NOT NULL,
  `metodo_pago` enum('Efectivo','Transferencia','Débito','Crédito') NOT NULL,
  `observaciones` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `planes`
--

CREATE TABLE `planes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `clases` int(11) DEFAULT NULL,
  `monto` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `planes`
--

INSERT INTO `planes` (`id`, `nombre`, `clases`, `monto`) VALUES
(1, '1 clase', 1, 5000.00),
(2, '8 clases mensuales', 8, 15000.00),
(3, '12 clases mensuales', 12, 20000.00),
(4, '12 clases mensuales', 12, 20000.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `planes_adicionales`
--

CREATE TABLE `planes_adicionales` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `monto` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `planes_adicionales`
--

INSERT INTO `planes_adicionales` (`id`, `nombre`, `monto`) VALUES
(1, 'guantes', 4000.00),
(2, 'vendas', 1000.00),
(3, 'guantes y vendas', 5500.00),
(4, 'guantes vendas y tibiales', 7000.00),
(5, 'tibiales', 2000.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `planes_membresia`
--

CREATE TABLE `planes_membresia` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `cantidad_clases` int(11) DEFAULT 0,
  `duracion_dias` int(11) DEFAULT 30,
  `precio` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `planes_membresia`
--

INSERT INTO `planes_membresia` (`id`, `nombre`, `cantidad_clases`, `duracion_dias`, `precio`) VALUES
(1, '1 clase', 1, 1, 4500.00),
(2, '8 clases mensuales', 8, 30, 15000.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `talle` varchar(50) DEFAULT NULL,
  `tipo` enum('Protección','Indumentaria') NOT NULL,
  `talle_oz` varchar(20) DEFAULT NULL,
  `precio_compra` decimal(10,2) DEFAULT NULL,
  `precio_venta` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `talle`, `tipo`, `talle_oz`, `precio_compra`, `precio_venta`) VALUES
(1, 'VENDAS PROYECT', 'UNICO', 'Protección', NULL, 18000.00, 24490.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos_indumentaria`
--

CREATE TABLE `productos_indumentaria` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `talle` varchar(20) NOT NULL,
  `precio_compra` decimal(10,2) NOT NULL,
  `precio_venta` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos_protecciones`
--

CREATE TABLE `productos_protecciones` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `talle` varchar(20) NOT NULL,
  `precio_compra` decimal(10,2) NOT NULL,
  `precio_venta` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesores`
--

CREATE TABLE `profesores` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telefono` varchar(50) DEFAULT NULL,
  `rfid_uid` varchar(100) DEFAULT NULL,
  `dni` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `profesores`
--

INSERT INTO `profesores` (`id`, `nombre`, `apellido`, `email`, `telefono`, `rfid_uid`, `dni`) VALUES
(1, 'david', 'cabral', '', '2664700966', '0003399158', '86886886'),
(2, 'emiliano', 'gonzalez', '', '2664774677', '0003433769', '43221926'),
(3, 'RENZO', 'AGUIRRE', '', '', '0004782855', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro_profesores`
--

CREATE TABLE `registro_profesores` (
  `id` int(11) NOT NULL,
  `profesor_id` int(11) NOT NULL,
  `tipo` enum('ingreso','egreso') NOT NULL,
  `timestamp` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rfid_logs`
--

CREATE TABLE `rfid_logs` (
  `id` int(11) NOT NULL,
  `profesor_id` int(11) NOT NULL,
  `rfid_uid` varchar(100) NOT NULL,
  `tipo_evento` enum('entrada','salida') NOT NULL,
  `fecha_hora` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tarifas`
--

CREATE TABLE `tarifas` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `monto` decimal(10,2) NOT NULL,
  `creado_en` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_membresia`
--

CREATE TABLE `tipos_membresia` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `cantidad_clases` int(11) DEFAULT NULL,
  `duracion_dias` int(11) DEFAULT 30,
  `precio` decimal(10,2) NOT NULL,
  `monto` decimal(10,2) NOT NULL DEFAULT 0.00,
  `clases` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipos_membresia`
--

INSERT INTO `tipos_membresia` (`id`, `nombre`, `cantidad_clases`, `duracion_dias`, `precio`, `monto`, `clases`) VALUES
(16, '1 Clase Suelta', NULL, 30, 0.00, 4000.00, 1),
(17, '4 Clases por Mes', NULL, 30, 0.00, 10000.00, 4),
(18, '8 Clases Mensuales', NULL, 30, 0.00, 15000.00, 8),
(19, '12 Clases Mensuales', NULL, 30, 0.00, 20000.00, 12),
(20, 'Clases Ilimitadas', NULL, 30, 0.00, 25000.00, 35),
(21, 'bimetral 16 clases', NULL, 30, 0.00, 25000.00, 16),
(22, 'bimetral 24 clases', NULL, 30, 0.00, 35000.00, 24),
(23, 'plan familiar', NULL, 30, 0.00, 12500.00, 8),
(24, 'plan familiar 12', NULL, 30, 0.00, 15000.00, 12),
(25, 'descuentos 50% 8 c', NULL, 30, 0.00, 7500.00, 8),
(26, 'descuento 50% 12', NULL, 30, 0.00, 10000.00, 12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_membresias`
--

CREATE TABLE `tipo_membresias` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `cantidad_clases` int(11) NOT NULL,
  `duracion_dias` int(11) NOT NULL,
  `precio` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `turnos`
--

CREATE TABLE `turnos` (
  `id` int(11) NOT NULL,
  `profesor_id` int(11) NOT NULL,
  `dia_semana` enum('Lunes','Martes','Miércoles','Jueves','Viernes','Sábado','Domingo') NOT NULL,
  `hora_inicio` time NOT NULL,
  `duracion_minutos` int(11) NOT NULL,
  `pago_por_clase` decimal(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `turnos_clases`
--

CREATE TABLE `turnos_clases` (
  `id` int(11) NOT NULL,
  `profesor_id` int(11) NOT NULL,
  `dia_semana` enum('Lunes','Martes','Miércoles','Jueves','Viernes','Sábado','Domingo') NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_fin` time NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id` int(11) NOT NULL,
  `producto` varchar(100) NOT NULL,
  `cliente_id` int(11) NOT NULL,
  `metodo_pago` varchar(50) NOT NULL,
  `monto` decimal(10,2) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas_productos`
--

CREATE TABLE `ventas_productos` (
  `id` int(11) NOT NULL,
  `producto_id` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `fecha` datetime DEFAULT current_timestamp(),
  `metodo_pago` varchar(50) DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `precio_venta` decimal(10,2) NOT NULL DEFAULT 0.00,
  `fecha_venta` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asistencias`
--
ALTER TABLE `asistencias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cliente_id` (`cliente_id`),
  ADD KEY `membresia_id` (`membresia_id`);

--
-- Indices de la tabla `clases`
--
ALTER TABLE `clases`
  ADD PRIMARY KEY (`id`),
  ADD KEY `profesor_id` (`profesor_id`);

--
-- Indices de la tabla `clases_dadas`
--
ALTER TABLE `clases_dadas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `turno_id` (`turno_id`);

--
-- Indices de la tabla `clases_realizadas`
--
ALTER TABLE `clases_realizadas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_profesor` (`profesor_id`),
  ADD KEY `fk_turno` (`turno_id`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `dni` (`dni`),
  ADD UNIQUE KEY `rfid_uid` (`rfid_uid`);

--
-- Indices de la tabla `ingresos_profesores`
--
ALTER TABLE `ingresos_profesores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `profesor_id` (`profesor_id`);

--
-- Indices de la tabla `membresias`
--
ALTER TABLE `membresias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cliente_id` (`cliente_id`);

--
-- Indices de la tabla `membresias_adicionales`
--
ALTER TABLE `membresias_adicionales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `membresia_id` (`membresia_id`),
  ADD KEY `adicional_id` (`adicional_id`);

--
-- Indices de la tabla `membresia_adicionales`
--
ALTER TABLE `membresia_adicionales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `membresia_id` (`membresia_id`),
  ADD KEY `adicional_id` (`adicional_id`);

--
-- Indices de la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cliente_id` (`cliente_id`),
  ADD KEY `membresia_id` (`membresia_id`);

--
-- Indices de la tabla `pagos_adicionales`
--
ALTER TABLE `pagos_adicionales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `membresia_id` (`membresia_id`);

--
-- Indices de la tabla `pagos_profesores`
--
ALTER TABLE `pagos_profesores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `profesor_id` (`profesor_id`);

--
-- Indices de la tabla `planes`
--
ALTER TABLE `planes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `planes_adicionales`
--
ALTER TABLE `planes_adicionales`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `planes_membresia`
--
ALTER TABLE `planes_membresia`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos_indumentaria`
--
ALTER TABLE `productos_indumentaria`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos_protecciones`
--
ALTER TABLE `productos_protecciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `profesores`
--
ALTER TABLE `profesores`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `rfid_uid` (`rfid_uid`);

--
-- Indices de la tabla `registro_profesores`
--
ALTER TABLE `registro_profesores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `profesor_id` (`profesor_id`);

--
-- Indices de la tabla `rfid_logs`
--
ALTER TABLE `rfid_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `profesor_id` (`profesor_id`);

--
-- Indices de la tabla `tarifas`
--
ALTER TABLE `tarifas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipos_membresia`
--
ALTER TABLE `tipos_membresia`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_membresias`
--
ALTER TABLE `tipo_membresias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `turnos`
--
ALTER TABLE `turnos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `profesor_id` (`profesor_id`);

--
-- Indices de la tabla `turnos_clases`
--
ALTER TABLE `turnos_clases`
  ADD PRIMARY KEY (`id`),
  ADD KEY `profesor_id` (`profesor_id`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cliente_id` (`cliente_id`);

--
-- Indices de la tabla `ventas_productos`
--
ALTER TABLE `ventas_productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `producto_id` (`producto_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `asistencias`
--
ALTER TABLE `asistencias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT de la tabla `clases`
--
ALTER TABLE `clases`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `clases_dadas`
--
ALTER TABLE `clases_dadas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `clases_realizadas`
--
ALTER TABLE `clases_realizadas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=325;

--
-- AUTO_INCREMENT de la tabla `ingresos_profesores`
--
ALTER TABLE `ingresos_profesores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `membresias`
--
ALTER TABLE `membresias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT de la tabla `membresias_adicionales`
--
ALTER TABLE `membresias_adicionales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `membresia_adicionales`
--
ALTER TABLE `membresia_adicionales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pagos`
--
ALTER TABLE `pagos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `pagos_adicionales`
--
ALTER TABLE `pagos_adicionales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pagos_profesores`
--
ALTER TABLE `pagos_profesores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `planes`
--
ALTER TABLE `planes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `planes_adicionales`
--
ALTER TABLE `planes_adicionales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `planes_membresia`
--
ALTER TABLE `planes_membresia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `productos_indumentaria`
--
ALTER TABLE `productos_indumentaria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `productos_protecciones`
--
ALTER TABLE `productos_protecciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `profesores`
--
ALTER TABLE `profesores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `registro_profesores`
--
ALTER TABLE `registro_profesores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `rfid_logs`
--
ALTER TABLE `rfid_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tarifas`
--
ALTER TABLE `tarifas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipos_membresia`
--
ALTER TABLE `tipos_membresia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `tipo_membresias`
--
ALTER TABLE `tipo_membresias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `turnos`
--
ALTER TABLE `turnos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `turnos_clases`
--
ALTER TABLE `turnos_clases`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ventas_productos`
--
ALTER TABLE `ventas_productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `asistencias`
--
ALTER TABLE `asistencias`
  ADD CONSTRAINT `asistencias_ibfk_1` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `asistencias_ibfk_2` FOREIGN KEY (`membresia_id`) REFERENCES `membresias` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `clases`
--
ALTER TABLE `clases`
  ADD CONSTRAINT `clases_ibfk_1` FOREIGN KEY (`profesor_id`) REFERENCES `profesores` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `clases_dadas`
--
ALTER TABLE `clases_dadas`
  ADD CONSTRAINT `clases_dadas_ibfk_1` FOREIGN KEY (`turno_id`) REFERENCES `turnos_clases` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `clases_realizadas`
--
ALTER TABLE `clases_realizadas`
  ADD CONSTRAINT `clases_realizadas_ibfk_1` FOREIGN KEY (`profesor_id`) REFERENCES `profesores` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `clases_realizadas_ibfk_2` FOREIGN KEY (`turno_id`) REFERENCES `turnos` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_profesor` FOREIGN KEY (`profesor_id`) REFERENCES `profesores` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_turno` FOREIGN KEY (`turno_id`) REFERENCES `turnos` (`id`) ON DELETE SET NULL;

--
-- Filtros para la tabla `ingresos_profesores`
--
ALTER TABLE `ingresos_profesores`
  ADD CONSTRAINT `ingresos_profesores_ibfk_1` FOREIGN KEY (`profesor_id`) REFERENCES `profesores` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `membresias`
--
ALTER TABLE `membresias`
  ADD CONSTRAINT `membresias_ibfk_1` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `membresias_adicionales`
--
ALTER TABLE `membresias_adicionales`
  ADD CONSTRAINT `membresias_adicionales_ibfk_1` FOREIGN KEY (`membresia_id`) REFERENCES `membresias` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `membresias_adicionales_ibfk_2` FOREIGN KEY (`adicional_id`) REFERENCES `planes_adicionales` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `membresia_adicionales`
--
ALTER TABLE `membresia_adicionales`
  ADD CONSTRAINT `membresia_adicionales_ibfk_1` FOREIGN KEY (`membresia_id`) REFERENCES `membresias` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `membresia_adicionales_ibfk_2` FOREIGN KEY (`adicional_id`) REFERENCES `planes_adicionales` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD CONSTRAINT `pagos_ibfk_1` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pagos_ibfk_2` FOREIGN KEY (`membresia_id`) REFERENCES `membresias` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `pagos_adicionales`
--
ALTER TABLE `pagos_adicionales`
  ADD CONSTRAINT `pagos_adicionales_ibfk_1` FOREIGN KEY (`membresia_id`) REFERENCES `membresias` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `pagos_profesores`
--
ALTER TABLE `pagos_profesores`
  ADD CONSTRAINT `pagos_profesores_ibfk_1` FOREIGN KEY (`profesor_id`) REFERENCES `profesores` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `registro_profesores`
--
ALTER TABLE `registro_profesores`
  ADD CONSTRAINT `registro_profesores_ibfk_1` FOREIGN KEY (`profesor_id`) REFERENCES `profesores` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `rfid_logs`
--
ALTER TABLE `rfid_logs`
  ADD CONSTRAINT `rfid_logs_ibfk_1` FOREIGN KEY (`profesor_id`) REFERENCES `profesores` (`id`);

--
-- Filtros para la tabla `turnos`
--
ALTER TABLE `turnos`
  ADD CONSTRAINT `turnos_ibfk_1` FOREIGN KEY (`profesor_id`) REFERENCES `profesores` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `turnos_clases`
--
ALTER TABLE `turnos_clases`
  ADD CONSTRAINT `turnos_clases_ibfk_1` FOREIGN KEY (`profesor_id`) REFERENCES `profesores` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `ventas_ibfk_1` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `ventas_productos`
--
ALTER TABLE `ventas_productos`
  ADD CONSTRAINT `ventas_productos_ibfk_1` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
