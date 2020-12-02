-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-12-2020 a las 13:57:19
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `biblioteca`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `autores`
--

CREATE TABLE `autores` (
  `numero_autor` int(5) UNSIGNED NOT NULL,
  `nombres` varchar(30) NOT NULL,
  `apellidos` varchar(30) NOT NULL,
  `numero_ciudad` int(6) UNSIGNED DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `fecha_muerte` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `autores`
--

INSERT INTO `autores` (`numero_autor`, `nombres`, `apellidos`, `numero_ciudad`, `fecha_nacimiento`, `fecha_muerte`) VALUES
(1, 'José', 'Saramago', 56846, '1922-11-16', '2010-06-18'),
(2, 'Philip Kindred', 'Dick', 245166, '1928-12-16', '1982-03-02'),
(3, 'Jorge Mario Pedro', 'Vargas Llosa', 11453, '1936-03-28', NULL),
(4, 'Osvaldo', 'Soriano', 11526, '1943-01-06', '1997-01-29'),
(5, 'Leopold ', 'Trepper', 19767, '1904-02-23', '1982-01-19'),
(6, 'Sigmund', 'Freud', 48588, '1856-05-06', '1939-09-23'),
(7, 'Immanuel', 'Kant', 24975, '1724-04-22', '1804-02-12'),
(8, 'Andrea', 'Camilieri', 42395, '1925-09-06', '2019-07-17'),
(9, 'Leonardo', 'Padura', 13300, '1955-10-09', NULL),
(10, 'Raymond', 'Chandler', 245166, '1888-07-23', '1959-03-26');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciudades`
--

CREATE TABLE `ciudades` (
  `numero_ciudad` int(6) UNSIGNED NOT NULL,
  `nombre_ciudad` varchar(30) NOT NULL,
  `codigo_pais` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ciudades`
--

INSERT INTO `ciudades` (`numero_ciudad`, `nombre_ciudad`, `codigo_pais`) VALUES
(6396, 'Madrid', 'ES'),
(6881, 'Bogotá', 'CO'),
(7308, 'Buenos Aires', 'AR'),
(7556, 'Barcelona', 'ES'),
(7732, 'Montevideo', 'UY'),
(7833, 'Lisboa', 'PT'),
(11453, 'Arequipa', 'PE'),
(11526, 'Mar Del Plata', 'AR'),
(13300, 'La Habana', 'CU'),
(19767, 'Nowy Targ', 'PL'),
(24975, 'Königsberg', 'DE'),
(42395, 'Porto Empedocle', 'IT'),
(48588, 'Pribor', 'CZ'),
(56846, 'Azinhaga', 'PT'),
(245166, 'San Ana', 'US'),
(254195, 'Ciudad La Paz', 'BO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `editoriales`
--

CREATE TABLE `editoriales` (
  `id_editorial` varchar(4) NOT NULL,
  `nombre_editorial` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `editoriales`
--

INSERT INTO `editoriales` (`id_editorial`, `nombre_editorial`) VALUES
('AL01', 'Alfaguara'),
('AN01', 'Anagrama'),
('BR01', 'Brunelas'),
('CO01', 'Contexto'),
('MI01', 'Minitauro');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ejemplares`
--

CREATE TABLE `ejemplares` (
  `numero_ejemplar` int(6) UNSIGNED NOT NULL,
  `numero_libro` int(5) UNSIGNED NOT NULL,
  `nombre_estado` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ejemplares`
--

INSERT INTO `ejemplares` (`numero_ejemplar`, `numero_libro`, `nombre_estado`) VALUES
(1, 1, 'domicilio'),
(2, 1, 'sala'),
(3, 1, 'mantenimiento'),
(4, 2, 'domicilio'),
(5, 2, 'domicilio'),
(6, 2, 'domicilio'),
(7, 3, 'sala'),
(8, 3, 'sala'),
(9, 3, 'sala'),
(10, 4, 'domicilio'),
(11, 4, 'mantenimiento'),
(12, 5, 'sala'),
(13, 5, 'sala'),
(14, 6, 'mantenimiento'),
(15, 6, 'mantenimiento'),
(16, 7, 'sala'),
(17, 7, 'mantenimiento'),
(18, 8, 'domicilio'),
(19, 8, 'baja'),
(20, 9, 'mantenimiento'),
(21, 9, 'mantenimiento'),
(22, 10, 'domicilio'),
(23, 10, 'domicilio'),
(24, 11, 'domicilio'),
(25, 11, 'domicilio'),
(26, 12, 'domicilio'),
(27, 12, 'domicilio'),
(28, 12, 'sala'),
(29, 12, 'sala'),
(30, 12, 'domicilio'),
(31, 12, 'domicilio'),
(32, 13, 'sala'),
(33, 13, 'sala'),
(34, 13, 'mantenimiento'),
(35, 13, 'mantenimiento'),
(36, 15, 'sala'),
(37, 15, 'domicilio'),
(38, 15, 'mantenimiento'),
(39, 8, 'domicilio'),
(40, 19, 'domicilio'),
(41, 19, 'domicilio'),
(42, 20, 'domicilio'),
(43, 20, 'domicilio'),
(44, 21, 'domicilio'),
(45, 21, 'domicilio'),
(46, 21, 'domicilio'),
(47, 22, 'domicilio'),
(48, 22, 'domicilio'),
(49, 23, 'domicilio'),
(50, 23, 'domicilio'),
(51, 24, 'D'),
(52, 24, 'D'),
(53, 25, 'D');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

CREATE TABLE `estado` (
  `nombre_estado` varchar(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `estado`
--

INSERT INTO `estado` (`nombre_estado`) VALUES
('baja'),
('domicilio'),
('mantenimiento'),
('sala');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libros`
--

CREATE TABLE `libros` (
  `numero_libro` int(5) UNSIGNED NOT NULL,
  `titulo` varchar(300) NOT NULL,
  `subtitulo` varchar(300) DEFAULT NULL,
  `edicion` varchar(10) DEFAULT NULL,
  `anio` int(10) UNSIGNED DEFAULT NULL,
  `cant_paginas` int(10) UNSIGNED DEFAULT NULL,
  `numero_ciudad` int(6) UNSIGNED DEFAULT NULL,
  `id_editorial` varchar(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `libros`
--

INSERT INTO `libros` (`numero_libro`, `titulo`, `subtitulo`, `edicion`, `anio`, `cant_paginas`, `numero_ciudad`, `id_editorial`) VALUES
(1, 'El hombre duplicado', NULL, '1ra', 2013, 514, 6396, 'AL01'),
(2, 'Ensayo para la ceguera', NULL, '2da', 1998, 213, 6396, 'AL01'),
(3, 'El informe de la minoría', NULL, '2da', 1983, 123, 7308, 'MI01'),
(4, '¿Sueñan los androides con ovejas eléctricas? ', NULL, '3ra', 1985, 159, 7308, 'MI01'),
(5, 'La fiesta del Chivo', NULL, '1ra', 2000, 456, 7556, 'AN01'),
(6, 'Lituma en los Andes', NULL, '2da', 2000, 753, 7556, 'AN01'),
(7, 'Triste y solitario final', NULL, '4ta', 2010, 189, 7308, 'BR01'),
(8, 'No habrá más penas ni olvidos', NULL, '3ra', 2000, 147, 7308, 'BR01'),
(9, 'La orquesta roja', NULL, '5ta', 1985, 1278, 7732, 'CO01'),
(10, 'El gran juego', 'Inteligencia soviética en la Europa nazi', '1ra', 1975, 1879, 7732, 'CO01'),
(11, 'El chiste y la relación con lo inconciente', NULL, '3ra', 1987, 1453, 6396, 'AL01'),
(12, 'El yo y el ello', 'y otras obras', '5ta', 1999, 258, 6396, 'AN01'),
(13, 'La critica de la razón pura', NULL, '1ra', 1954, 1547, 7556, 'BR01'),
(14, 'Crítica de la razón práctica ', NULL, '4ta', 1975, 258, 6396, 'BR01'),
(15, 'La forma del agua', NULL, '1ra', 1998, 247, 7308, 'MI01'),
(16, 'La paciencia de la araña', NULL, '2da', 1999, 369, 7308, 'MI01'),
(17, 'El hombre que amaba a los perros', NULL, '1ra', 2010, 576, 7732, 'CO01'),
(18, 'Herejes', NULL, '2da', 2013, 2587, 7732, 'CO01'),
(19, 'El sueño eterno', NULL, '1ra', 1995, 258, 6396, 'BR01'),
(20, 'Adiós muñeca', NULL, '1ra', 1996, 369, 6396, 'BR01'),
(21, 'La ventana siniestra', NULL, '2da', 1996, 147, 6396, 'BR01'),
(22, 'La dama del lago', NULL, '1ra', 1996, 789, 6396, 'BR01'),
(23, 'La hermana pequeña', NULL, '1ra', 1996, 456, 6396, 'BR01'),
(24, 'El largo adiós', NULL, '1ra', 1997, 159, 6396, 'BR01'),
(25, 'Cocktail de barro', NULL, '1ra', 1987, 753, 6396, 'BR01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libros_autores`
--

CREATE TABLE `libros_autores` (
  `numero_libro` int(5) UNSIGNED NOT NULL,
  `numero_autor` int(5) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `libros_autores`
--

INSERT INTO `libros_autores` (`numero_libro`, `numero_autor`) VALUES
(1, 1),
(2, 1),
(3, 2),
(4, 2),
(5, 3),
(6, 3),
(7, 4),
(8, 4),
(9, 5),
(10, 5),
(11, 6),
(12, 6),
(13, 7),
(14, 7),
(15, 8),
(16, 8),
(17, 9),
(18, 9),
(19, 10),
(20, 10),
(21, 10),
(22, 10),
(23, 10),
(24, 10),
(25, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paises`
--

CREATE TABLE `paises` (
  `codigo_pais` varchar(2) NOT NULL,
  `nombre_pais` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `paises`
--

INSERT INTO `paises` (`codigo_pais`, `nombre_pais`) VALUES
('DE', 'Alemania'),
('AR', 'Argentina'),
('BO', 'Bolivia'),
('CO', 'Colombia'),
('CU', 'Cuba'),
('ES', 'España'),
('US', 'Estados Unidos de America'),
('IT', 'Italia'),
('MX', 'México'),
('UY', 'Montevideo'),
('PE', 'Perú'),
('PL', 'Polonia'),
('PT', 'Portugal'),
('CZ', 'Republica Checa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestamos`
--

CREATE TABLE `prestamos` (
  `numero_prestamo` int(6) UNSIGNED NOT NULL,
  `numero_socio` int(5) UNSIGNED NOT NULL,
  `tipo_prestamo` varchar(1) NOT NULL,
  `fecha_prestamo` date NOT NULL,
  `fecha_limite_devolucion` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `prestamos`
--

INSERT INTO `prestamos` (`numero_prestamo`, `numero_socio`, `tipo_prestamo`, `fecha_prestamo`, `fecha_limite_devolucion`) VALUES
(1, 3, 'D', '2020-10-05', '2020-10-12'),
(2, 1, 'D', '2020-08-03', '2020-08-10'),
(3, 1, 'D', '2020-10-19', '2020-10-26'),
(4, 5, 'D', '2020-11-01', '2020-11-09'),
(5, 3, 'D', '2020-09-01', '2020-09-08'),
(6, 1, 'D', '2020-11-13', '2020-11-20'),
(7, 1, 'D', '2020-11-13', '2020-11-20'),
(8, 1, 'D', '2020-11-13', '2020-11-20'),
(9, 1, 'D', '2020-11-13', '2020-11-20'),
(10, 1, 'D', '2020-11-13', '2020-11-20'),
(11, 1, 'D', '2020-11-13', '2020-11-20'),
(12, 1, 'D', '2020-11-13', '2020-11-20'),
(13, 1, 'D', '2020-11-13', '2020-11-20'),
(14, 1, 'D', '2020-11-13', '2020-11-20'),
(15, 1, 'D', '2020-11-13', '2020-11-20'),
(16, 1, 'D', '2020-11-13', '2020-11-20'),
(17, 1, 'D', '2020-11-13', '2020-11-20'),
(18, 1, 'D', '2020-11-13', '2020-11-20'),
(19, 1, 'D', '2020-11-13', '2020-11-20'),
(20, 1, 'D', '2020-11-13', '2020-11-20'),
(21, 1, 'D', '2020-11-13', '2020-11-20'),
(22, 1, 'D', '2020-11-13', '2020-11-20'),
(23, 1, 'D', '2020-11-13', '2020-11-20'),
(24, 1, 'D', '2020-11-13', '2020-11-20'),
(25, 1, 'D', '2020-11-13', '2020-11-20'),
(26, 1, 'D', '2020-11-13', '2020-11-20'),
(27, 1, 'D', '2020-11-13', '2020-11-20'),
(28, 1, 'D', '2020-11-13', '2020-11-20'),
(29, 1, 'D', '2020-11-13', '2020-11-20'),
(30, 1, 'D', '2020-11-13', '2020-11-20'),
(31, 1, 'D', '2020-11-13', '2020-11-20'),
(32, 1, 'D', '2020-11-13', '2020-11-20'),
(33, 1, 'D', '2020-11-13', '2020-11-20'),
(34, 1, 'D', '2020-11-13', '2020-11-20'),
(35, 1, 'D', '2020-11-13', '2020-11-20'),
(36, 1, 'D', '2020-11-13', '2020-11-20'),
(37, 1, 'D', '2020-11-13', '2020-11-20'),
(38, 1, 'D', '2020-11-13', '2020-11-20'),
(39, 1, 'D', '2020-11-13', '2020-11-20'),
(40, 1, 'D', '2020-11-13', '2020-11-20'),
(41, 1, 'D', '2020-11-13', '2020-11-20'),
(42, 1, 'D', '2020-11-13', '2020-11-20'),
(43, 1, 'D', '2020-11-15', '2020-11-22'),
(44, 1, 'D', '2020-11-15', '2020-11-22'),
(45, 1, 'D', '2020-11-15', '2020-11-22'),
(46, 1, 'D', '2020-11-15', '2020-11-22'),
(47, 1, 'D', '2020-11-15', '2020-11-22'),
(48, 1, 'D', '2020-11-15', '2020-11-22'),
(49, 1, 'D', '2020-11-15', '2020-11-22'),
(50, 1, 'D', '2020-11-15', '2020-11-22'),
(51, 1, 'D', '2020-11-15', '2020-11-22'),
(52, 1, 'D', '2020-11-16', '2020-11-23'),
(53, 1, 'D', '2020-11-16', '2020-11-23'),
(54, 1, 'D', '2020-11-16', '2020-11-23'),
(55, 1, 'D', '2020-11-16', '2020-11-23'),
(56, 1, 'D', '2020-11-16', '2020-11-23'),
(57, 1, 'D', '2020-11-16', '2020-11-23'),
(58, 1, 'D', '2020-11-16', '2020-11-23'),
(59, 1, 'D', '2020-11-16', '2020-11-23'),
(60, 1, 'D', '2020-11-16', '2020-11-23'),
(61, 1, 'D', '2020-11-16', '2020-11-23'),
(62, 1, 'D', '2020-11-16', '2020-11-23'),
(63, 1, 'D', '2020-11-16', '2020-11-23'),
(64, 1, 'D', '2020-11-18', '2020-11-25'),
(65, 1, 'D', '2020-11-18', '2020-11-25'),
(66, 1, 'D', '2020-11-18', '2020-11-25'),
(67, 1, 'D', '2020-11-18', '2020-11-25'),
(68, 1, 'D', '2020-11-18', '2020-11-25'),
(69, 1, 'D', '2020-11-19', '2020-11-26'),
(70, 1, 'D', '2020-11-19', '2020-11-26'),
(71, 2, 'D', '2020-11-21', '2020-11-28'),
(72, 2, 'D', '2020-11-21', '2020-11-28'),
(73, 2, 'D', '2020-11-01', '2020-11-08'),
(74, 1, 'D', '2020-11-22', '2020-11-29'),
(75, 4, 'D', '2020-11-22', '2020-11-29'),
(76, 1, 'D', '2020-11-22', '2020-11-29'),
(77, 1, 'D', '2020-11-23', '2020-11-30'),
(78, 1, 'D', '2020-11-23', '2020-11-30'),
(79, 4, 'D', '2020-11-23', '2020-11-30'),
(80, 2, 'D', '2020-11-02', '2020-11-09'),
(81, 2, 'D', '2020-11-23', '2020-11-30'),
(82, 1, 'D', '2020-11-23', '2020-11-30'),
(83, 1, 'D', '2020-11-23', '2020-11-30'),
(84, 1, 'D', '2020-11-23', '2020-11-30'),
(85, 1, 'D', '2020-11-25', '2020-12-02'),
(86, 1, 'D', '2020-11-25', '2020-12-02'),
(87, 1, 'D', '2020-11-25', '2020-12-02'),
(88, 1, 'D', '2020-11-25', '2020-12-02'),
(89, 2, 'D', '2020-11-25', '2020-12-02'),
(90, 2, 'D', '2020-11-25', '2020-12-02'),
(91, 1, 'D', '2020-11-25', '2020-12-02'),
(92, 1, 'D', '2020-11-25', '2020-12-02'),
(93, 1, 'D', '2020-11-30', '2020-12-07'),
(94, 1, 'D', '2020-12-01', '2020-12-08'),
(95, 1, 'D', '2020-12-01', '2020-12-08'),
(96, 1, 'D', '2020-12-01', '2020-12-08'),
(97, 1, 'D', '2020-12-01', '2020-12-08'),
(98, 4, 'D', '2020-12-01', '2020-12-08'),
(99, 1, 'D', '2020-12-02', '2020-12-09');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestamos_ejemplares`
--

CREATE TABLE `prestamos_ejemplares` (
  `numero_prestamo` int(6) UNSIGNED NOT NULL,
  `numero_ejemplar` int(6) NOT NULL,
  `fecha_efectiva_devolucion` date DEFAULT NULL,
  `precio_multa` decimal(10,0) DEFAULT NULL,
  `fecha_pago_multa` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `prestamos_ejemplares`
--

INSERT INTO `prestamos_ejemplares` (`numero_prestamo`, `numero_ejemplar`, `fecha_efectiva_devolucion`, `precio_multa`, `fecha_pago_multa`) VALUES
(1, 4, '2020-09-07', NULL, NULL),
(2, 5, '2020-11-14', NULL, NULL),
(2, 6, '2020-11-14', NULL, NULL),
(3, 18, '2020-10-30', NULL, NULL),
(4, 18, '2020-11-14', NULL, NULL),
(5, 4, '2020-11-14', NULL, NULL),
(5, 39, '2020-09-30', NULL, NULL),
(43, 39, '2020-11-14', NULL, NULL),
(44, 1, '2020-11-14', NULL, NULL),
(44, 4, '2020-11-14', NULL, NULL),
(45, 5, '2020-11-14', NULL, NULL),
(46, 1, '2020-11-14', NULL, NULL),
(46, 4, '2020-11-14', NULL, NULL),
(47, 1, '2020-11-14', NULL, NULL),
(47, 4, '2020-11-14', NULL, NULL),
(48, 1, '2020-11-14', NULL, NULL),
(48, 4, '2020-11-14', NULL, NULL),
(49, 1, '2020-11-14', NULL, NULL),
(49, 4, '2020-11-14', NULL, NULL),
(50, 1, '2020-11-14', NULL, NULL),
(50, 4, '2020-11-14', NULL, NULL),
(51, 1, '2020-11-15', NULL, NULL),
(51, 4, '2020-11-15', NULL, NULL),
(52, 18, '2020-11-15', NULL, NULL),
(52, 40, '2020-11-15', NULL, NULL),
(52, 42, '2020-11-15', NULL, NULL),
(52, 44, '2020-11-16', NULL, NULL),
(52, 47, '2020-11-16', NULL, NULL),
(53, 44, '2020-11-15', NULL, NULL),
(53, 47, '2020-11-15', NULL, NULL),
(54, 47, '2020-11-15', NULL, NULL),
(57, 18, '2020-11-16', NULL, NULL),
(57, 40, '2020-11-16', NULL, NULL),
(57, 42, '2020-11-16', NULL, NULL),
(57, 44, '2020-11-16', NULL, NULL),
(57, 47, '2020-11-16', NULL, NULL),
(57, 49, '2020-11-16', NULL, NULL),
(58, 40, '2020-11-16', NULL, NULL),
(58, 42, '2020-11-16', NULL, NULL),
(60, 49, '2020-11-16', '10', NULL),
(61, 42, '2020-11-16', NULL, NULL),
(61, 44, '2020-11-16', NULL, NULL),
(62, 18, '2020-11-16', NULL, NULL),
(62, 22, '2020-11-16', NULL, NULL),
(63, 18, '2020-11-16', NULL, NULL),
(63, 22, '2020-11-16', NULL, NULL),
(64, 44, '2020-11-18', NULL, NULL),
(65, 18, '2020-11-18', NULL, NULL),
(66, 42, '2020-11-18', NULL, NULL),
(66, 44, '2020-11-18', NULL, NULL),
(66, 47, '2020-11-18', NULL, NULL),
(67, 22, '2020-11-18', NULL, NULL),
(68, 18, '2020-11-18', NULL, NULL),
(70, 40, '2020-11-19', NULL, NULL),
(70, 42, '2020-11-19', NULL, NULL),
(70, 44, '2020-11-19', NULL, NULL),
(71, 40, '2020-11-21', NULL, NULL),
(71, 42, '2020-11-21', NULL, NULL),
(72, 41, '2020-11-21', NULL, NULL),
(72, 43, '2020-11-21', NULL, NULL),
(73, 18, '2020-11-21', '130', NULL),
(74, 42, '2020-11-22', NULL, NULL),
(75, 40, '2020-12-01', '20', NULL),
(75, 42, '2020-11-22', NULL, NULL),
(75, 44, '2020-11-22', NULL, NULL),
(75, 47, '2020-11-22', NULL, NULL),
(75, 49, '2020-11-22', NULL, NULL),
(76, 41, '2020-11-23', NULL, NULL),
(76, 42, '2020-11-23', NULL, NULL),
(76, 44, '2020-11-23', NULL, NULL),
(76, 47, '2020-11-23', NULL, NULL),
(76, 49, '2020-11-23', NULL, NULL),
(77, 41, '2020-11-23', NULL, NULL),
(77, 42, '2020-11-23', NULL, NULL),
(77, 44, '2020-11-23', NULL, NULL),
(77, 47, '2020-11-23', NULL, NULL),
(77, 49, '2020-11-23', NULL, NULL),
(78, 22, '2020-11-23', NULL, NULL),
(78, 41, '2020-11-23', NULL, NULL),
(78, 42, '2020-11-23', NULL, NULL),
(78, 44, '2020-11-23', NULL, NULL),
(78, 47, '2020-11-23', NULL, NULL),
(78, 49, '2020-11-23', NULL, NULL),
(79, 18, '2020-12-01', '10', NULL),
(79, 22, '2020-12-01', '10', NULL),
(80, 23, '2020-11-25', '160', NULL),
(81, 41, '2020-11-25', NULL, NULL),
(81, 42, '2020-11-25', NULL, NULL),
(82, 43, '2020-11-23', NULL, NULL),
(82, 44, '2020-11-23', NULL, NULL),
(83, 43, '2020-11-23', NULL, NULL),
(83, 44, '2020-11-23', NULL, NULL),
(83, 47, '2020-11-23', NULL, NULL),
(83, 49, '2020-11-23', NULL, NULL),
(84, 39, '2020-11-23', NULL, NULL),
(84, 43, '2020-11-23', NULL, NULL),
(84, 44, '2020-11-23', NULL, NULL),
(84, 47, '2020-11-23', NULL, NULL),
(84, 49, '2020-11-23', NULL, NULL),
(85, 43, '2020-11-25', NULL, NULL),
(85, 44, '2020-11-25', NULL, NULL),
(85, 47, '2020-11-25', NULL, NULL),
(85, 49, '2020-11-25', NULL, NULL),
(86, 39, '2020-11-25', NULL, NULL),
(87, 39, '2020-11-25', NULL, NULL),
(88, 43, '2020-11-25', NULL, NULL),
(88, 47, '2020-11-25', NULL, NULL),
(89, 39, '2020-11-25', NULL, NULL),
(90, 39, '2020-11-25', NULL, NULL),
(91, 23, '2020-11-25', NULL, NULL),
(91, 39, '2020-11-25', NULL, NULL),
(91, 42, '2020-11-25', NULL, NULL),
(91, 44, '2020-11-25', NULL, NULL),
(92, 10, '2020-11-25', NULL, NULL),
(92, 24, '2020-11-25', NULL, NULL),
(92, 26, '2020-11-25', NULL, NULL),
(92, 39, '2020-11-25', NULL, NULL),
(93, 23, '2020-11-30', NULL, NULL),
(94, 41, '2020-12-01', NULL, NULL),
(94, 42, '2020-12-01', NULL, NULL),
(94, 44, '2020-12-01', NULL, NULL),
(95, 43, '2020-12-01', NULL, NULL),
(95, 49, '2020-12-01', NULL, NULL),
(96, 23, '2020-12-01', NULL, NULL),
(97, 18, '2020-12-01', NULL, NULL),
(98, 18, '2020-12-01', NULL, NULL),
(99, 22, '2020-12-02', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `socios`
--

CREATE TABLE `socios` (
  `numero_socio` int(5) UNSIGNED NOT NULL,
  `dni` int(8) UNSIGNED NOT NULL,
  `nombres` varchar(30) NOT NULL,
  `apellidos` varchar(30) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `calle` varchar(30) NOT NULL,
  `numero_dir` int(5) UNSIGNED DEFAULT NULL,
  `piso` int(2) UNSIGNED DEFAULT NULL,
  `departamento` varchar(2) NOT NULL,
  `codigo_postal` int(4) UNSIGNED DEFAULT NULL,
  `municipio` varchar(30) NOT NULL,
  `provincia` varchar(30) NOT NULL,
  `email` varchar(320) NOT NULL,
  `clave` varchar(40) NOT NULL,
  `tipo_usuario` int(1) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `socios`
--

INSERT INTO `socios` (`numero_socio`, `dni`, `nombres`, `apellidos`, `fecha_nacimiento`, `calle`, `numero_dir`, `piso`, `departamento`, `codigo_postal`, `municipio`, `provincia`, `email`, `clave`, `tipo_usuario`) VALUES
(1, 30123456, 'Juan Martín', 'Walsh', '1984-07-21', 'Melincue', 3965, 2, 'b', 1598, 'CABA', 'CABA', 'juanwalsh@gmail.com', '797ca9ce510d101c51cc17eb8446fc375bef981a', 2),
(2, 30789456, 'Andrés', 'Brenner', '1984-07-23', 'Albarellos', 2147, NULL, '', 1406, 'CABA', 'CABA', 'andresbrenner@gmail.com', 'f578c690e5ce4f9224482009bca3a757914ec97f', 2),
(3, 13258963, 'Debora', 'Yanco', '1963-01-29', 'Pareja', 2547, 3, 'b', 1408, 'CABA', 'CABA', 'deborayanco@gmail.com', 'fa355b9f65f1d2a109383e94c21c162162d4f1b4', 3),
(4, 4789654, 'Leon', 'Yanco', '1938-06-21', 'Corrientes', 4258, 9, 'b', 1364, 'CABA', 'CABA', 'leonyanco@gmail.com', 'dc94d1c83a9079a7d0cee69830013c6eacc0d10d', 4),
(5, 31258963, 'Guido', 'Benedetti', '1985-12-30', 'Aristobulo del Valle', 14, NULL, '', 1879, 'San Isidro', 'Provincia de Buenos Aires', 'guidobenedetti@gmail.com', '', 1),
(6, 8978654, 'Fernando', 'Olub', '1950-04-22', 'La serena', 2587, 4, 'f', 1365, 'San Martin', 'Provincia de Buenos Aires', 'fernandoolub@gmail.com', '', 2),
(7, 25753951, 'Carla', 'Deiana', '1978-05-21', 'Cuenca', 325, 2, 'e', 2587, 'Rosario', 'Santa Fe', 'carladeiana@gmail.com', '', 3),
(8, 20357951, 'Noelia', 'Roca', '1970-12-01', 'José Marmol', 5, NULL, '', 8796, 'Almirante Brwon', 'Provincia de Buenos Aires', 'noeliaroca@gmail.com', '', 0),
(9, 15486247, 'Nora', 'Biaggio', '1950-07-25', 'Artigas', 1212, 5, 'h', 7896, 'Avellaneda', 'Provincia de Buenos Aires', '', '', 4),
(10, 32753951, 'Lucila', 'Angrisano', '1986-04-11', 'Cochabamba', 546, 2, '', 9874, 'CABA', 'CABA', 'lucila@gmail.com', '', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_usuario`
--

CREATE TABLE `tipo_usuario` (
  `numero_tipo` int(1) UNSIGNED NOT NULL,
  `descripcion` varchar(30) NOT NULL,
  `cantidad_libros` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipo_usuario`
--

INSERT INTO `tipo_usuario` (`numero_tipo`, `descripcion`, `cantidad_libros`) VALUES
(1, 'normal', 3),
(2, 'Investigador grado', 6),
(3, 'Investigador maestria', 9),
(4, 'Investigador doctorado', 12);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `autores`
--
ALTER TABLE `autores`
  ADD PRIMARY KEY (`numero_autor`),
  ADD KEY `numero_ciudad` (`numero_ciudad`);

--
-- Indices de la tabla `ciudades`
--
ALTER TABLE `ciudades`
  ADD PRIMARY KEY (`numero_ciudad`),
  ADD KEY `codigo_pais` (`codigo_pais`);

--
-- Indices de la tabla `editoriales`
--
ALTER TABLE `editoriales`
  ADD PRIMARY KEY (`id_editorial`);

--
-- Indices de la tabla `ejemplares`
--
ALTER TABLE `ejemplares`
  ADD PRIMARY KEY (`numero_ejemplar`),
  ADD KEY `numero_libro` (`numero_libro`);

--
-- Indices de la tabla `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`nombre_estado`);

--
-- Indices de la tabla `libros`
--
ALTER TABLE `libros`
  ADD PRIMARY KEY (`numero_libro`),
  ADD KEY `ciudades2` (`numero_ciudad`),
  ADD KEY `id_editorial` (`id_editorial`);

--
-- Indices de la tabla `libros_autores`
--
ALTER TABLE `libros_autores`
  ADD PRIMARY KEY (`numero_libro`,`numero_autor`),
  ADD KEY `numa` (`numero_autor`);

--
-- Indices de la tabla `paises`
--
ALTER TABLE `paises`
  ADD PRIMARY KEY (`codigo_pais`),
  ADD UNIQUE KEY `nombre_pais` (`nombre_pais`);

--
-- Indices de la tabla `prestamos`
--
ALTER TABLE `prestamos`
  ADD PRIMARY KEY (`numero_prestamo`),
  ADD KEY `nume` (`numero_socio`);

--
-- Indices de la tabla `prestamos_ejemplares`
--
ALTER TABLE `prestamos_ejemplares`
  ADD PRIMARY KEY (`numero_prestamo`,`numero_ejemplar`);

--
-- Indices de la tabla `socios`
--
ALTER TABLE `socios`
  ADD PRIMARY KEY (`numero_socio`),
  ADD UNIQUE KEY `dni` (`dni`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `autores`
--
ALTER TABLE `autores`
  MODIFY `numero_autor` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `ejemplares`
--
ALTER TABLE `ejemplares`
  MODIFY `numero_ejemplar` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT de la tabla `libros`
--
ALTER TABLE `libros`
  MODIFY `numero_libro` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `prestamos`
--
ALTER TABLE `prestamos`
  MODIFY `numero_prestamo` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT de la tabla `socios`
--
ALTER TABLE `socios`
  MODIFY `numero_socio` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `autores`
--
ALTER TABLE `autores`
  ADD CONSTRAINT `numero_ciudad` FOREIGN KEY (`numero_ciudad`) REFERENCES `ciudades` (`numero_ciudad`);

--
-- Filtros para la tabla `ciudades`
--
ALTER TABLE `ciudades`
  ADD CONSTRAINT `codigo_pais` FOREIGN KEY (`codigo_pais`) REFERENCES `paises` (`codigo_pais`);

--
-- Filtros para la tabla `ejemplares`
--
ALTER TABLE `ejemplares`
  ADD CONSTRAINT `numero_libro` FOREIGN KEY (`numero_libro`) REFERENCES `libros` (`numero_libro`);

--
-- Filtros para la tabla `libros`
--
ALTER TABLE `libros`
  ADD CONSTRAINT `ciudades2` FOREIGN KEY (`numero_ciudad`) REFERENCES `ciudades` (`numero_ciudad`),
  ADD CONSTRAINT `id_editorial` FOREIGN KEY (`id_editorial`) REFERENCES `editoriales` (`id_editorial`);

--
-- Filtros para la tabla `libros_autores`
--
ALTER TABLE `libros_autores`
  ADD CONSTRAINT `numa` FOREIGN KEY (`numero_autor`) REFERENCES `autores` (`numero_autor`),
  ADD CONSTRAINT `numl` FOREIGN KEY (`numero_libro`) REFERENCES `libros` (`numero_libro`);

--
-- Filtros para la tabla `prestamos`
--
ALTER TABLE `prestamos`
  ADD CONSTRAINT `nume` FOREIGN KEY (`numero_socio`) REFERENCES `socios` (`numero_socio`);

--
-- Filtros para la tabla `prestamos_ejemplares`
--
ALTER TABLE `prestamos_ejemplares`
  ADD CONSTRAINT `fk` FOREIGN KEY (`numero_prestamo`) REFERENCES `prestamos` (`numero_prestamo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
