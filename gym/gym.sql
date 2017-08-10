-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-02-2017 a las 01:10:32
-- Versión del servidor: 10.1.21-MariaDB
-- Versión de PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `gym`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulos`
--

CREATE TABLE `articulos` (
  `id` int(10) UNSIGNED NOT NULL,
  `descripcion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `contenido` text COLLATE utf8_unicode_ci NOT NULL,
  `categorias_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `articulos`
--

INSERT INTO `articulos` (`id`, `descripcion`, `contenido`, `categorias_id`, `created_at`, `updated_at`) VALUES
(1, 'si bueno ', 'trivago', 1, '2016-10-04 03:00:00', '2016-10-04 03:00:00'),
(2, 'pelota', 'beuno no lo', 1, '2016-10-04 03:00:00', '2016-10-04 03:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulos_img`
--

CREATE TABLE `articulos_img` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `articulos_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulos_tag`
--

CREATE TABLE `articulos_tag` (
  `id` int(10) UNSIGNED NOT NULL,
  `articulo_id` int(10) UNSIGNED NOT NULL,
  `tag_id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(10) UNSIGNED NOT NULL,
  `descripcion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `estado` enum('A','B') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'A',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `descripcion`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'ppreuba de', 'A', '2016-10-03 03:00:00', '2016-10-03 03:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2016_10_03_142149_categorias', 1),
('2016_10_03_142824_articulos', 2),
('2016_10_03_160700_articulos_img', 2),
('2016_10_03_162559_tags', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos`
--

CREATE TABLE `pagos` (
  `id_pago` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `periodo` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `monto` double DEFAULT NULL,
  `dias_retraso` float DEFAULT NULL,
  `monto_incremento` float DEFAULT NULL,
  `fecha_hora` datetime DEFAULT NULL,
  `usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pagos`
--

INSERT INTO `pagos` (`id_pago`, `id_cliente`, `periodo`, `id_producto`, `monto`, `dias_retraso`, `monto_incremento`, `fecha_hora`, `usuario`) VALUES
(1, 30, 2, 3, 600, NULL, NULL, '2017-02-03 22:33:10', 2),
(2, 49, 2, 3, 600, NULL, NULL, '2017-02-03 22:39:18', 2),
(3, 48, 2, 3, 600, NULL, NULL, '2017-02-03 22:43:26', 2),
(4, 47, 2, 1, 500, NULL, NULL, '2017-02-03 22:43:44', 2),
(5, 46, 2, 3, 600, NULL, NULL, '2017-02-03 22:43:58', 2),
(6, 25, 2, 3, 600, NULL, NULL, '2017-02-03 22:47:58', 2),
(7, 44, 2, 9, 500, NULL, NULL, '2017-02-03 22:49:11', 2),
(8, 15, 2, 27, 600, NULL, NULL, '2017-02-03 22:50:20', 2),
(9, 11, 2, 3, 600, NULL, NULL, '2017-02-03 22:53:00', 2),
(10, 19, 2, 3, 600, NULL, NULL, '2017-02-03 22:53:22', 2),
(11, 51, 2, 3, 600, NULL, NULL, '2017-02-03 22:57:51', 2),
(12, 52, 2, 3, 600, NULL, NULL, '2017-02-03 23:01:48', 2),
(13, 53, 2, 9, 500, NULL, NULL, '2017-02-03 23:09:48', 2),
(14, 54, 2, 9, 500, NULL, NULL, '2017-02-03 23:14:56', 2),
(15, 55, 2, 21, 800, NULL, NULL, '2017-02-03 23:21:43', 2),
(16, 56, 2, 7, 800, NULL, NULL, '2017-02-03 23:24:25', 2),
(17, 57, 2, 7, 800, NULL, NULL, '2017-02-03 23:25:50', 2),
(18, 58, 2, 3, 800, NULL, NULL, '2017-02-03 23:28:24', 2),
(19, 59, 2, 4, 800, NULL, NULL, '2017-02-03 23:38:17', 2),
(21, 32, 2, 3, 600, NULL, NULL, '2017-02-04 00:08:50', 2),
(22, 61, 1, 7, 400, NULL, NULL, '2017-02-04 00:16:59', 2),
(23, 62, 1, 7, 400, NULL, NULL, '2017-02-04 00:17:56', 2),
(24, 63, 1, 21, 800, NULL, NULL, '2017-02-04 00:20:57', 2),
(25, 64, 2, 27, 600, NULL, NULL, '2017-02-04 00:30:22', 2),
(26, 65, 1, 21, 800, NULL, NULL, '2017-02-04 00:32:07', 2),
(27, 66, 1, 3, 600, NULL, NULL, '2017-02-04 00:33:42', 2),
(28, 67, 1, 3, 600, NULL, NULL, '2017-02-04 00:34:46', 2),
(29, 68, 1, 3, 350, NULL, NULL, '2017-02-04 00:36:38', 2),
(30, 21, 1, 3, 350, NULL, NULL, '2017-02-04 00:37:23', 2),
(31, 10, 1, 1, 350, NULL, NULL, '2017-02-04 00:38:00', 2),
(32, 69, 1, 33, 1350, NULL, NULL, '2017-02-04 00:41:42', 2),
(33, 41, 1, 1, 350, NULL, NULL, '2017-02-04 00:42:21', 2),
(34, 70, 1, 29, 300, NULL, NULL, '2017-02-04 00:45:22', 2),
(35, 38, 1, 9, 500, NULL, NULL, '2017-02-04 00:46:34', 2),
(36, 71, 1, 3, 600, NULL, NULL, '2017-02-04 00:48:21', 2),
(37, 6, 1, 7, 350, NULL, NULL, '2017-02-04 00:49:22', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas`
--

CREATE TABLE `personas` (
  `id_persona` int(10) NOT NULL COMMENT 'Identificador de la persona en el dominio.',
  `nombre` varchar(50) CHARACTER SET latin1 NOT NULL DEFAULT '' COMMENT 'Primer nombre de la persona.',
  `onombre` varchar(30) CHARACTER SET latin1 DEFAULT NULL COMMENT 'Otros nombres de la persona.',
  `apellido` varchar(40) CHARACTER SET latin1 NOT NULL DEFAULT '' COMMENT 'Apellido de soltero de la persona.',
  `oapellido` varchar(25) CHARACTER SET latin1 DEFAULT NULL COMMENT 'Otros apellidos de la persona.',
  `dni` varchar(10) DEFAULT NULL,
  `cuil` varchar(100) DEFAULT NULL,
  `localidad` varchar(100) DEFAULT NULL,
  `art` varchar(100) DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT '0000-00-00' COMMENT 'Fecha de nacimiento de la persona.',
  `sexo` char(1) CHARACTER SET latin1 DEFAULT '' COMMENT 'Codigo, sera seleccionado de la tabla persona_sexo.',
  `domicilio` varchar(80) CHARACTER SET latin1 DEFAULT NULL COMMENT 'Calle donde vive la persona.',
  `domicilio_dni` varchar(100) DEFAULT NULL,
  `ocupacion` varchar(100) DEFAULT NULL,
  `empresa` varchar(100) DEFAULT NULL,
  `rol` varchar(50) DEFAULT NULL,
  `pais_nacimiento` char(2) CHARACTER SET latin1 DEFAULT '' COMMENT 'Id pais. Sera seleccionado de la tabla pais.',
  `telefono_particular` varchar(30) CHARACTER SET latin1 DEFAULT '0' COMMENT 'Numero telefonico particular de la persona.',
  `telefono_celular` varchar(30) CHARACTER SET latin1 DEFAULT '0' COMMENT 'Numero telefonico del celular de la persona.',
  `telefono_celular2` int(20) DEFAULT NULL,
  `mail` varchar(250) DEFAULT NULL,
  `jornada` text,
  `antiguedad` text,
  `cod_estado` char(5) CHARACTER SET latin1 NOT NULL DEFAULT 'A' COMMENT 'Id estado. Sera seleccionado de la tabla persona_estado.',
  `usuario` int(10) UNSIGNED ZEROFILL NOT NULL DEFAULT '0000000000' COMMENT 'Identificador del usuario que efectua el alta, la modificacion o la baja del registro. Ref. tabla, usuario_datos_generales.',
  `fecha_alta` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Guarda la fecha en la que se produjo el alta del registro.',
  `fecha_ultima_modificacion` datetime DEFAULT '0000-00-00 00:00:00' COMMENT 'Guarda la fecha en la que se produjo la ultima modificacion sobre el registro.',
  `id_dominio` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='personas.; InnoDB free: 11264 kB; (`cod_estado`) REFE' ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `personas`
--

INSERT INTO `personas` (`id_persona`, `nombre`, `onombre`, `apellido`, `oapellido`, `dni`, `cuil`, `localidad`, `art`, `fecha_nacimiento`, `sexo`, `domicilio`, `domicilio_dni`, `ocupacion`, `empresa`, `rol`, `pais_nacimiento`, `telefono_particular`, `telefono_celular`, `telefono_celular2`, `mail`, `jornada`, `antiguedad`, `cod_estado`, `usuario`, `fecha_alta`, `fecha_ultima_modificacion`, `id_dominio`) VALUES
(3, 'jose', NULL, 'Ponce', NULL, NULL, NULL, NULL, NULL, '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', NULL, NULL, NULL, NULL, 'A', 0000000002, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(4, 'Yanina', NULL, 'Terreni', NULL, NULL, NULL, NULL, NULL, '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', NULL, NULL, NULL, NULL, 'A', 0000000002, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(5, 'Loriana', NULL, 'Morgenstern', NULL, NULL, NULL, NULL, NULL, '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '154 210527', NULL, NULL, NULL, NULL, 'A', 0000000002, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(6, 'MARECELO', NULL, ' ZEMBRUSKI ', NULL, NULL, NULL, NULL, NULL, '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '154-560926', NULL, NULL, NULL, NULL, 'A', 0000000002, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(7, 'CAROLINA', NULL, 'ABRAZIAN', NULL, NULL, NULL, NULL, NULL, '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A', 0000000002, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(8, 'TAMARA', NULL, 'ACOSTA ', NULL, NULL, NULL, NULL, NULL, '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '154 680946', NULL, NULL, NULL, NULL, 'A', 0000000002, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(9, 'MARIA CLARA', NULL, 'ACUÑA ', NULL, '13.732.498', NULL, NULL, NULL, '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A', 0000000002, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(10, 'MARIA DE ROSARIO', NULL, 'ACUÑA ', NULL, '44.226.674', NULL, NULL, NULL, '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '154 621006', NULL, NULL, NULL, NULL, 'A', 0000000002, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(11, 'LUCRECIA', NULL, 'PERNIGOTTI', NULL, '34826330', NULL, NULL, NULL, '1991-06-26', NULL, NULL, 'FELIX DE AZARA 1663', NULL, NULL, NULL, NULL, NULL, '154 206215', NULL, 'LUCRECIA.PERNIGOTTI@GMEIL.COM', NULL, NULL, 'A', 0000000002, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(12, 'DANIELA', NULL, 'AGUILAR ', NULL, NULL, NULL, NULL, NULL, '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A', 0000000002, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(13, 'GABRIELA', NULL, 'ALONSO ', NULL, NULL, NULL, NULL, NULL, '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A', 0000000002, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(14, 'MARIELA', NULL, 'ALVARENGA ', NULL, '26.286.082', NULL, NULL, NULL, '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '154 281094', NULL, NULL, NULL, NULL, 'A', 0000000002, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(15, 'SOFIA', NULL, 'GONZALEZ', NULL, '33.687.870', NULL, NULL, NULL, '1988-07-05', NULL, NULL, 'CHACRA 107 CASA 71', NULL, NULL, NULL, NULL, NULL, '154 646322', NULL, 'SOFIA0588@HOTMAIL.COM', NULL, NULL, 'A', 0000000002, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(16, 'Veronica', NULL, 'Arotcharen', NULL, NULL, NULL, NULL, NULL, '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A', 0000000001, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(17, 'Ricardo', NULL, 'Rodriguez', NULL, NULL, NULL, NULL, NULL, '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A', 0000000001, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(18, 'SUSANA', NULL, 'AMARILLA ', NULL, '20.815.253', NULL, NULL, NULL, '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '154397568', NULL, NULL, NULL, NULL, 'A', 0000000002, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(19, 'VALERIA', NULL, 'ANDRUSYZSYN  ', NULL, '30.790.419', NULL, NULL, NULL, '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '154 169818', NULL, NULL, NULL, NULL, 'A', 0000000002, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(20, 'CECILIA', NULL, 'AQUINO ', NULL, NULL, NULL, NULL, NULL, '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A', 0000000002, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(21, 'MONICA', NULL, 'BARRERA ', NULL, '17.441.610', NULL, NULL, NULL, '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '154 634688', NULL, NULL, NULL, NULL, 'A', 0000000002, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(22, 'MARIANA', NULL, 'BARRIO ', NULL, '27.488.182', NULL, NULL, NULL, '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A', 0000000002, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(23, ' DANIELA', NULL, 'BARRIONUEVO', NULL, NULL, NULL, NULL, NULL, '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A', 0000000002, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(24, 'MANUEL', NULL, 'BELTRAMI ', NULL, NULL, NULL, NULL, NULL, '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A', 0000000002, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(25, 'FLORENCIA', NULL, 'DEFILIPPI', NULL, '33735212', NULL, NULL, NULL, '1988-05-13', NULL, NULL, 'ROQUE SAENZ PEÑA 2506', NULL, NULL, NULL, NULL, NULL, '154 140245', NULL, 'FLORENCIA DEFILIPPI@GMEIL.COM', NULL, NULL, 'A', 0000000002, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(26, ' MARIANA', NULL, 'BARRIO', NULL, '27.488.182', NULL, NULL, NULL, '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A', 0000000002, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(27, 'MARIELA', NULL, 'BERTONI ', NULL, NULL, NULL, NULL, NULL, '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '154634745', NULL, NULL, NULL, NULL, 'A', 0000000002, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(28, 'FLORENCIA', NULL, 'CACERES ', NULL, NULL, NULL, NULL, NULL, '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A', 0000000002, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(29, ' ADRIANA', NULL, 'CAMPOS', NULL, '95.177.528', NULL, NULL, NULL, '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '3794895616', NULL, NULL, NULL, NULL, 'A', 0000000002, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(30, 'KIARA', NULL, 'CANTEROS ', NULL, NULL, NULL, NULL, NULL, '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A', 0000000002, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(31, ' DARIO', NULL, 'CARANBRI', NULL, NULL, NULL, NULL, NULL, '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A', 0000000002, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(32, 'LAURA', NULL, 'CIBILS ', NULL, '28169382', NULL, NULL, NULL, '1980-05-24', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '154695075', NULL, 'mlcibils@yahoo.com.ar', NULL, NULL, 'A', 0000000002, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(33, 'MIRIAN', NULL, 'COMPARINI ', NULL, NULL, NULL, NULL, NULL, '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A', 0000000002, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(34, 'COMPES MARIANA', NULL, 'COMPES ', NULL, NULL, NULL, NULL, NULL, '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A', 0000000002, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(35, 'VIVIANA', NULL, 'CONDE ', NULL, NULL, NULL, NULL, NULL, '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A', 0000000002, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(36, 'DORA', NULL, 'DOMINGUEZ ', NULL, '24.509.105', NULL, NULL, NULL, '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '154 323239', NULL, NULL, NULL, NULL, 'A', 0000000002, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(37, 'ROMINA', NULL, 'CORONEL ', NULL, '27.918.984', NULL, NULL, NULL, '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '154 674975', NULL, NULL, NULL, NULL, 'A', 0000000002, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(38, 'SABRINA', NULL, 'CORREA ', NULL, '34829257', NULL, NULL, NULL, '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A', 0000000002, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(39, 'JOSEFINA', NULL, 'ESCALADA ', NULL, NULL, NULL, NULL, NULL, '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A', 0000000002, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(40, 'MARTITA', NULL, 'ESCALADA ', NULL, '5.163.691', NULL, NULL, NULL, '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4424977', NULL, NULL, NULL, NULL, NULL, 'A', 0000000002, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(41, 'NADIA', NULL, 'ESTACIUK', NULL, '44.072.764', NULL, NULL, NULL, '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '154 785049', NULL, NULL, NULL, NULL, 'A', 0000000002, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(42, 'PATRICIA', NULL, 'FERNANDEZ', NULL, NULL, NULL, NULL, NULL, '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4544815', '154311913', NULL, NULL, NULL, NULL, 'A', 0000000002, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(43, 'MARIA ALEJANDRA', NULL, 'OLEXEN', NULL, '27800009', NULL, NULL, NULL, '1979-11-14', NULL, NULL, 'BENAVIDES 1120', NULL, NULL, NULL, NULL, NULL, '154 671417', NULL, NULL, NULL, NULL, 'A', 0000000002, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(44, 'VANESA', NULL, 'FLORENTIN', NULL, '29658683', NULL, NULL, NULL, '1982-11-29', NULL, NULL, 'URUGUAY', NULL, NULL, NULL, NULL, NULL, '154 904134', NULL, NULL, NULL, NULL, 'A', 0000000002, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(45, ' FANNY', NULL, 'FIGARI', NULL, '32.330.014', NULL, NULL, NULL, '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '154 252780', NULL, NULL, NULL, NULL, 'A', 0000000002, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(46, 'SILVIA', NULL, 'GONZALEZ', NULL, NULL, NULL, NULL, NULL, '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A', 0000000002, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(47, 'YENHY', NULL, 'DIAZ', NULL, NULL, NULL, NULL, NULL, '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A', 0000000002, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(48, 'LAURA', NULL, 'OSTACHU', NULL, '20.460.754', NULL, NULL, NULL, '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '154 626346', NULL, NULL, NULL, NULL, 'A', 0000000002, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(49, 'RITA', NULL, 'FIGUEREDO', NULL, NULL, NULL, NULL, NULL, '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A', 0000000002, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(50, 'CRISTIAN', NULL, 'PEDERSEN ', NULL, NULL, NULL, NULL, NULL, '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A', 0000000002, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(51, 'CARLA', NULL, 'LOPEZ ', NULL, '31911644', NULL, NULL, NULL, '1985-12-11', NULL, NULL, 'BLAS PARERA 2579 2b', NULL, NULL, NULL, NULL, NULL, '3764867241', NULL, NULL, NULL, NULL, 'A', 0000000002, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(52, 'CATALINA', NULL, 'SPACIUK', NULL, '35487104', NULL, NULL, NULL, '1992-10-15', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '3764685020', NULL, NULL, NULL, NULL, 'A', 0000000002, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(53, 'SILVANA', NULL, 'KRUK', NULL, NULL, NULL, NULL, NULL, '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A', 0000000002, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(54, 'GABRIELA', NULL, 'KARABEN', NULL, NULL, NULL, NULL, NULL, '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A', 0000000002, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(55, 'SEBASTIAN', NULL, 'LAMPERTTI', NULL, NULL, NULL, NULL, NULL, '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A', 0000000002, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(56, 'SEBASTIAN', NULL, 'GONZALEZ MOLINA', NULL, NULL, NULL, NULL, NULL, '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A', 0000000002, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(57, 'MARIANO', NULL, 'KITEGROSKI ', NULL, NULL, NULL, NULL, NULL, '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A', 0000000002, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(58, 'SANDRA', NULL, 'BOYESUK', NULL, NULL, NULL, NULL, NULL, '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A', 0000000002, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(59, 'DORIS', NULL, 'MANFREDINI', NULL, '5.818.603', NULL, NULL, NULL, '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4425805', '154-549771 ', NULL, NULL, NULL, NULL, 'A', 0000000002, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(60, 'CAROLINA', NULL, 'REPETO', NULL, NULL, NULL, NULL, NULL, '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A', 0000000002, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(61, 'HERNAN', NULL, 'GIMENEZ', NULL, NULL, NULL, NULL, NULL, '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A', 0000000002, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(62, 'JORGE', NULL, 'Rodriguez', NULL, NULL, NULL, NULL, NULL, '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A', 0000000002, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(63, 'CAROLINA', NULL, 'KOHEN', NULL, NULL, NULL, NULL, NULL, '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A', 0000000002, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(64, 'NATALIA', NULL, 'LLAMOSA', NULL, NULL, NULL, NULL, NULL, '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A', 0000000002, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(65, 'LOURDES', NULL, 'SILLER', NULL, NULL, NULL, NULL, NULL, '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A', 0000000002, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(66, 'DEBORA', NULL, 'ROCHA', NULL, NULL, NULL, NULL, NULL, '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A', 0000000002, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(67, 'MARIA ', NULL, 'SAGGIN', NULL, NULL, NULL, NULL, NULL, '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A', 0000000002, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(68, 'CECILIA', NULL, 'TORRESI', NULL, NULL, NULL, NULL, NULL, '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A', 0000000002, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(69, 'FABIAN', NULL, 'BENITEZ', NULL, NULL, NULL, NULL, NULL, '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A', 0000000002, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(70, 'VALENTINA', NULL, 'GONZALEZ', NULL, NULL, NULL, NULL, NULL, '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A', 0000000002, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(71, 'MARIANA', NULL, 'MARTIN', NULL, NULL, NULL, NULL, NULL, '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A', 0000000002, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1),
(72, 'MARCELO', NULL, 'ZEMBRUSKI', NULL, NULL, NULL, NULL, NULL, '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'A', 0000000002, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas_dias`
--

CREATE TABLE `personas_dias` (
  `id_persona_dias` int(5) NOT NULL,
  `id_persona` int(11) NOT NULL,
  `lunes` enum('S','N') DEFAULT 'N',
  `martes` enum('S','N') DEFAULT 'N',
  `miercoles` enum('S','N') DEFAULT 'N',
  `jueves` enum('S','N') DEFAULT 'N',
  `viernes` enum('S','N') DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `personas_dias`
--

INSERT INTO `personas_dias` (`id_persona_dias`, `id_persona`, `lunes`, `martes`, `miercoles`, `jueves`, `viernes`) VALUES
(1, 3, 'S', 'S', NULL, NULL, NULL),
(2, 4, NULL, NULL, 'S', NULL, NULL),
(3, 5, NULL, 'S', NULL, 'S', NULL),
(4, 6, 'S', NULL, 'S', NULL, 'S'),
(5, 7, 'S', 'S', 'S', 'S', 'S'),
(6, 8, NULL, 'S', NULL, 'S', NULL),
(7, 9, NULL, NULL, 'S', NULL, 'S'),
(8, 10, 'S', NULL, 'S', NULL, NULL),
(9, 11, 'S', NULL, 'S', NULL, 'S'),
(10, 12, 'S', 'S', 'S', 'S', 'S'),
(11, 13, 'S', 'S', 'S', 'S', 'S'),
(12, 14, 'S', NULL, 'S', NULL, 'S'),
(13, 15, 'S', NULL, 'S', NULL, 'S'),
(14, 16, NULL, NULL, NULL, NULL, NULL),
(15, 17, 'S', 'S', NULL, NULL, NULL),
(16, 18, 'S', NULL, 'S', NULL, 'S'),
(17, 19, 'S', NULL, 'S', NULL, 'S'),
(18, 20, 'S', NULL, 'S', NULL, 'S'),
(19, 21, 'S', NULL, 'S', NULL, 'S'),
(20, 22, 'S', NULL, NULL, 'S', 'S'),
(21, 23, NULL, 'S', NULL, 'S', NULL),
(22, 24, 'S', NULL, 'S', NULL, 'S'),
(23, 25, 'S', NULL, 'S', NULL, 'S'),
(24, 26, 'S', NULL, NULL, 'S', 'S'),
(25, 27, 'S', NULL, 'S', NULL, 'S'),
(26, 28, 'S', NULL, 'S', NULL, 'S'),
(27, 29, 'S', NULL, 'S', NULL, 'S'),
(28, 30, 'S', NULL, 'S', NULL, 'S'),
(29, 31, 'S', NULL, 'S', NULL, 'S'),
(30, 32, 'S', NULL, NULL, 'S', 'S'),
(31, 33, 'S', NULL, 'S', NULL, 'S'),
(32, 34, 'S', NULL, 'S', NULL, 'S'),
(33, 35, 'S', NULL, 'S', NULL, 'S'),
(34, 36, NULL, 'S', NULL, 'S', NULL),
(35, 37, NULL, 'S', NULL, 'S', NULL),
(36, 38, NULL, 'S', NULL, 'S', NULL),
(37, 39, 'S', NULL, 'S', NULL, 'S'),
(38, 40, NULL, 'S', NULL, 'S', NULL),
(39, 41, NULL, 'S', NULL, 'S', NULL),
(40, 42, 'S', NULL, 'S', NULL, 'S'),
(41, 43, NULL, 'S', NULL, 'S', NULL),
(42, 44, NULL, 'S', NULL, 'S', NULL),
(43, 45, 'S', NULL, 'S', NULL, 'S'),
(44, 46, 'S', NULL, 'S', NULL, 'S'),
(45, 47, NULL, 'S', NULL, 'S', NULL),
(46, 48, 'S', NULL, 'S', NULL, 'S'),
(47, 49, 'S', NULL, 'S', NULL, 'S'),
(48, 50, NULL, NULL, NULL, NULL, NULL),
(49, 51, 'S', NULL, 'S', NULL, 'S'),
(50, 52, 'S', NULL, 'S', NULL, 'S'),
(51, 53, NULL, 'S', NULL, 'S', NULL),
(52, 54, NULL, 'S', NULL, 'S', NULL),
(53, 55, 'S', NULL, 'S', NULL, 'S'),
(54, 56, 'S', NULL, 'S', NULL, 'S'),
(55, 57, 'S', NULL, 'S', NULL, 'S'),
(56, 58, 'S', NULL, 'S', NULL, 'S'),
(57, 59, 'S', NULL, 'S', NULL, 'S'),
(58, 60, 'S', NULL, 'S', NULL, 'S'),
(59, 61, 'S', NULL, 'S', NULL, 'S'),
(60, 62, 'S', NULL, 'S', NULL, 'S'),
(61, 63, 'S', NULL, 'S', NULL, 'S'),
(62, 64, 'S', NULL, 'S', NULL, 'S'),
(63, 65, 'S', NULL, 'S', NULL, 'S'),
(64, 66, 'S', NULL, 'S', NULL, 'S'),
(65, 67, 'S', NULL, 'S', NULL, 'S'),
(66, 68, 'S', NULL, 'S', NULL, 'S'),
(67, 69, NULL, 'S', 'S', NULL, 'S'),
(68, 70, 'S', NULL, 'S', NULL, 'S'),
(69, 71, 'S', NULL, 'S', NULL, 'S'),
(70, 72, 'S', NULL, 'S', NULL, 'S');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_producto` int(5) NOT NULL,
  `descripcion` varchar(250) DEFAULT NULL,
  `precio` double DEFAULT NULL,
  `ingreso10_15` int(5) DEFAULT NULL,
  `ingreso15_20` int(5) DEFAULT NULL,
  `ingreso20_25` int(5) DEFAULT NULL,
  `ingreso25_30` int(5) DEFAULT NULL,
  `incremento_dia` float DEFAULT NULL,
  `estado` varchar(5) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_producto`, `descripcion`, `precio`, `ingreso10_15`, `ingreso15_20`, `ingreso20_25`, `ingreso25_30`, `incremento_dia`, `estado`) VALUES
(1, 'Entrenamiento Funcional 2 x semana ', 500, NULL, NULL, NULL, NULL, NULL, 'A'),
(2, 'Salud y Calidad de Vida 2 x semana', 600, NULL, NULL, NULL, NULL, NULL, 'A'),
(3, 'Entrenamiento Funcional 3 x semana', 600, NULL, NULL, NULL, NULL, NULL, 'A'),
(4, 'Salud y Calidad de Vida 3 x semana', 700, NULL, NULL, NULL, NULL, NULL, 'A'),
(5, 'Entrenamiento Funcional TODOS LOS DIAS', 700, NULL, NULL, NULL, NULL, NULL, 'A'),
(6, 'Entrenamiento Deportivo 2 x semana', 600, NULL, NULL, NULL, NULL, NULL, 'A'),
(7, 'Entrenamiento Deportivo 3 x semana', 700, NULL, NULL, NULL, NULL, NULL, 'A'),
(8, 'Entrenamiento Deportivo TODOS LOS DIAS', 1000, NULL, NULL, NULL, NULL, NULL, 'A'),
(9, 'Cardio Jump 2 x semana', 500, NULL, NULL, NULL, NULL, NULL, 'A'),
(10, 'Cardio Jump 3 x semana', 600, NULL, NULL, NULL, NULL, NULL, 'A'),
(11, 'Zumba 2 x semana', 500, NULL, NULL, NULL, NULL, NULL, 'A'),
(12, 'Entrenamiento Personalizado 2 x semana', 1300, NULL, NULL, NULL, NULL, NULL, 'A'),
(13, 'Entrenamiento Personalizado 3 x semana', 1500, NULL, NULL, NULL, NULL, NULL, 'A'),
(14, 'Rehabilitacion Funcional 2 x semana', 600, NULL, NULL, NULL, NULL, NULL, 'A'),
(15, 'Rehabilitacion Funcional 3 x semana', 700, NULL, NULL, NULL, NULL, NULL, 'A'),
(16, 'GAP 2 x semana', 450, NULL, NULL, NULL, NULL, NULL, 'A'),
(17, 'GAP 3 x semana', 550, NULL, NULL, NULL, NULL, NULL, 'A'),
(18, 'Baile 2 x semana', 500, NULL, NULL, NULL, NULL, NULL, 'A'),
(19, 'Baile 3 x semana', 600, NULL, NULL, NULL, NULL, NULL, 'A'),
(20, 'Salud y Rehabilitacion 2 x semana', 700, NULL, NULL, NULL, NULL, NULL, 'A'),
(21, 'Salud y Rehabilitacion 3 x semana', 800, NULL, NULL, NULL, NULL, NULL, 'A'),
(22, 'Entrenamiento de Alto Rendimiento 2 x semana', 3000, NULL, NULL, NULL, NULL, NULL, 'A'),
(23, 'Entrenamiento de Alto Rendimiento 3 x semana', 3500, NULL, NULL, NULL, NULL, NULL, 'A'),
(24, 'Entrenamiento de Alto Rendimiento TODOS LOS DIAS', 4000, NULL, NULL, NULL, NULL, NULL, 'A'),
(25, 'Yoga Deportiva 2 x semana', 600, NULL, NULL, NULL, NULL, NULL, 'A'),
(26, 'Entrenamiento Funcional Principiante 2 x semana', 500, NULL, NULL, NULL, NULL, NULL, 'A'),
(27, 'Entrenamiento Funcional Principiante 3 x semana', 600, NULL, NULL, NULL, NULL, NULL, 'A'),
(28, 'Cardio Jump 2x1 ENERO', 250, NULL, NULL, NULL, NULL, NULL, 'A'),
(29, 'Funcional -%50 familiares 3 x semana', 300, NULL, NULL, NULL, NULL, NULL, 'A'),
(30, 'GRUPO YAGUARETE 1/2 MES ENERO- DEPORTIVO', 450, NULL, NULL, NULL, NULL, NULL, 'A'),
(31, 'ENTRENAMIENTO DEPORTIVO X3 -GRUPO YAGUARETE -10% DESC.', 720, NULL, NULL, NULL, NULL, NULL, 'A'),
(32, 'ENTRENAMIENTO DEPORTIVO X2 -GPO. YAGUARETE -10% DESC', 630, NULL, NULL, NULL, NULL, NULL, 'A'),
(33, 'Entrenamiento Personalizado x3- GPO YAGUARETE -10%DESC', 1350, NULL, NULL, NULL, NULL, NULL, 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos_dias`
--

CREATE TABLE `productos_dias` (
  `id_producto_dias` int(5) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `lunes` enum('S','N') DEFAULT 'N',
  `martes` enum('S','N') DEFAULT 'N',
  `miercoles` enum('S','N') DEFAULT 'N',
  `jueves` enum('S','N') DEFAULT 'N',
  `viernes` enum('S','N') DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `productos_dias`
--

INSERT INTO `productos_dias` (`id_producto_dias`, `id_producto`, `lunes`, `martes`, `miercoles`, `jueves`, `viernes`) VALUES
(1, 1, 'S', NULL, 'S', NULL, 'S'),
(5, 3, NULL, 'S', NULL, 'S', NULL),
(6, 1, NULL, NULL, NULL, NULL, NULL),
(7, 2, 'S', NULL, 'S', NULL, 'S'),
(8, 3, NULL, NULL, NULL, NULL, NULL),
(9, 4, 'S', NULL, 'S', NULL, 'S'),
(10, 5, 'S', 'S', 'S', 'S', 'S'),
(11, 6, NULL, NULL, NULL, NULL, NULL),
(12, 7, NULL, NULL, NULL, NULL, NULL),
(13, 8, NULL, NULL, NULL, NULL, NULL),
(14, 9, 'S', 'S', 'S', 'S', 'S'),
(15, 10, 'S', 'S', 'S', 'S', 'S'),
(16, 11, NULL, 'S', NULL, 'S', NULL),
(17, 12, NULL, NULL, NULL, NULL, NULL),
(18, 13, NULL, NULL, NULL, NULL, NULL),
(19, 14, 'S', NULL, 'S', NULL, 'S'),
(20, 15, 'S', NULL, 'S', NULL, 'S'),
(21, 16, 'S', NULL, 'S', NULL, 'S'),
(22, 17, 'S', NULL, 'S', NULL, 'S'),
(23, 18, 'S', NULL, 'S', NULL, 'S'),
(24, 19, 'S', NULL, 'S', NULL, 'S'),
(25, 20, 'S', NULL, 'S', NULL, 'S'),
(26, 21, 'S', NULL, 'S', NULL, 'S'),
(27, 22, NULL, NULL, NULL, NULL, NULL),
(28, 23, NULL, NULL, NULL, NULL, NULL),
(29, 24, NULL, NULL, NULL, NULL, NULL),
(30, 25, NULL, 'S', NULL, 'S', NULL),
(31, 26, 'S', NULL, 'S', NULL, 'S'),
(32, 27, 'S', NULL, 'S', NULL, 'S'),
(33, 28, NULL, NULL, NULL, NULL, NULL),
(34, 29, 'S', NULL, 'S', NULL, 'S'),
(35, 30, 'S', NULL, 'S', NULL, 'S'),
(36, 31, 'S', NULL, 'S', NULL, 'S'),
(37, 32, NULL, 'S', NULL, 'S', NULL),
(38, 33, NULL, 'S', 'S', NULL, 'S');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `relaciones`
--

CREATE TABLE `relaciones` (
  `id_relacion` int(11) NOT NULL,
  `id_persona` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `fecha_carga` date DEFAULT NULL,
  `fecha_inicio` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `relaciones`
--

INSERT INTO `relaciones` (`id_relacion`, `id_persona`, `id_producto`, `fecha_carga`, `fecha_inicio`) VALUES
(1, 5, 9, NULL, '2017-01-09'),
(2, 6, 7, NULL, '2017-01-18'),
(3, 7, 5, NULL, '2017-01-10'),
(4, 8, 9, NULL, '2017-01-05'),
(5, 9, 1, NULL, '2017-02-02'),
(6, 10, 1, NULL, '2017-01-23'),
(7, 11, 3, NULL, '2017-02-02'),
(8, 12, 5, NULL, '2017-01-16'),
(9, 13, 5, NULL, '2017-01-04'),
(10, 14, 13, NULL, '2017-01-16'),
(11, 15, 27, NULL, '2017-02-02'),
(12, 4, 17, NULL, '2017-02-02'),
(13, 4, 16, NULL, '2017-02-02'),
(14, 18, 3, NULL, '2017-01-09'),
(15, 19, 3, NULL, '2017-02-01'),
(16, 20, 3, NULL, '2017-01-09'),
(17, 21, 3, NULL, '2017-01-23'),
(18, 22, 3, NULL, '2017-01-02'),
(19, 23, 28, NULL, '2017-01-03'),
(20, 24, 13, NULL, '2017-01-13'),
(21, 25, 3, NULL, '2017-02-02'),
(22, 26, 3, NULL, '2017-01-02'),
(23, 27, 3, NULL, '2017-01-04'),
(24, 28, 3, NULL, '2017-01-04'),
(25, 29, 3, NULL, '2017-01-11'),
(26, 30, 3, NULL, '2017-01-13'),
(27, 31, 21, NULL, '2017-01-06'),
(28, 32, 3, NULL, '2017-01-03'),
(29, 32, 28, NULL, '2017-01-12'),
(30, 33, 21, NULL, '2017-01-11'),
(31, 34, 3, NULL, '2017-01-11'),
(32, 35, 29, NULL, '2017-01-18'),
(33, 36, 28, NULL, '2017-01-10'),
(34, 37, 28, NULL, '2017-01-10'),
(35, 38, 9, NULL, '2017-01-19'),
(36, 39, 3, NULL, '2017-01-04'),
(37, 40, 1, NULL, '2017-01-03'),
(38, 41, 1, NULL, '2017-01-19'),
(39, 42, 21, NULL, '2017-02-02'),
(40, 43, 9, NULL, '2017-02-02'),
(41, 44, 9, NULL, '2017-02-02'),
(42, 45, 3, NULL, '2017-01-09'),
(43, 46, 3, NULL, '2017-02-03'),
(44, 47, 1, NULL, '2017-02-03'),
(45, 48, 3, NULL, '2017-02-03'),
(46, 49, 3, NULL, '2017-01-02'),
(47, 51, 3, NULL, '2017-01-18'),
(48, 52, 3, NULL, '2017-02-03'),
(49, 53, 9, NULL, '2017-02-03'),
(50, 54, 9, NULL, '2017-02-03'),
(51, 54, 9, NULL, '2017-02-03'),
(52, 55, 21, NULL, '2017-02-03'),
(53, 56, 7, NULL, '2017-02-03'),
(54, 57, 7, NULL, '2017-02-03'),
(55, 58, 3, NULL, '2017-02-03'),
(56, 59, 4, NULL, '2017-02-03'),
(57, 60, 4, NULL, '2017-01-27'),
(58, 61, 7, NULL, '2017-01-26'),
(59, 62, 7, NULL, '2017-01-26'),
(60, 63, 21, NULL, '2017-01-26'),
(61, 64, 27, NULL, '2017-02-03'),
(62, 65, 21, NULL, '2017-01-26'),
(63, 66, 3, NULL, '2017-01-25'),
(64, 67, 3, NULL, '2017-01-25'),
(65, 68, 3, NULL, '2017-01-23'),
(66, 69, 33, NULL, '2017-01-20'),
(67, 70, 29, NULL, '2017-01-19'),
(68, 71, 3, NULL, '2017-01-18'),
(69, 72, 7, NULL, '2017-01-18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tags`
--

CREATE TABLE `tags` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tipo` enum('comun','admin') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'comun',
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `tipo`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Jose Fonde', 'albertojoseponce@gmail.com', '$2y$10$sbk/axlKR3fJixBpQEXAVuhSK26n3R0IQ32aUggdnykSZffWTpVw2', 'comun', NULL, '2016-10-03 19:57:17', '2016-10-03 19:57:17'),
(3, 'prueba de jose', 'jose@josepone', 'prueba de jose', 'comun', NULL, '2016-10-05 03:21:38', '2016-10-05 03:21:38'),
(5, 'sadsad', 'sandratamburini@tinosalud.com.ar', '$2y$10$hsVnFBBn3ziTVpbLTGAk2.UXysGlTUBuGKvYFS3dIguB/DkZXSiYO', 'comun', NULL, '2016-10-05 06:33:59', '2016-10-05 06:33:59'),
(6, 'pelado', 'paldao@pela', '$2y$10$lhnsfztn47q0/tva1VUfM.kilMeUUAwn9e4.fP2.WinsJx3/O5EiS', 'comun', NULL, '2016-10-05 16:10:21', '2016-10-05 16:10:21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(10) UNSIGNED ZEROFILL NOT NULL COMMENT 'Identificador de usuario.',
  `clave` varchar(50) NOT NULL COMMENT 'Clave que usara el usuario en conjunto con su id.',
  `nombre` varchar(50) NOT NULL DEFAULT '' COMMENT 'Nombre de usuario. (cuenta).',
  `id_persona` int(10) UNSIGNED ZEROFILL NOT NULL DEFAULT '0000000000' COMMENT 'Id de la persona federada. Ref. tabla persona_federacion.',
  `estado` enum('A','B') NOT NULL DEFAULT 'A' COMMENT 'Admite solamente valores A=activo; B=baja.',
  `fecha_baja` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Fecha en la que se dio de baja el registro.',
  `fecha_ultima_modificacion` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Fecha en la que se realizo la ultima modificacion del registro.',
  `usuario` int(10) UNSIGNED ZEROFILL NOT NULL DEFAULT '0000000000' COMMENT 'Id del usuario que modifico por ultima vez el registro.'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='Usuarios.' ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `clave`, `nombre`, `id_persona`, `estado`, `fecha_baja`, `fecha_ultima_modificacion`, `usuario`) VALUES
(0000000001, 'jponce', 'jponce', 0000000001, 'A', '0000-00-00 00:00:00', '2014-08-04 00:00:00', 0000000001),
(0000000002, 'yani2017', 'yterreni', 0000000002, 'A', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0000000001),
(0000000064, 'cekym', 'veronica', 0000000016, 'A', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0000000000),
(0000000065, 'mia2014', 'ricardo', 0000000017, 'A', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0000000000);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `articulos`
--
ALTER TABLE `articulos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `articulos_categorias_id_foreign` (`categorias_id`);

--
-- Indices de la tabla `articulos_img`
--
ALTER TABLE `articulos_img`
  ADD PRIMARY KEY (`id`),
  ADD KEY `articulos_img_articulos_id_foreign` (`articulos_id`);

--
-- Indices de la tabla `articulos_tag`
--
ALTER TABLE `articulos_tag`
  ADD PRIMARY KEY (`id`),
  ADD KEY `articulos_tag_articulo_id_foreign` (`articulo_id`),
  ADD KEY `articulos_tag_tag_id_foreign` (`tag_id`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD PRIMARY KEY (`id_pago`),
  ADD KEY `id_cliente` (`id_cliente`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indices de la tabla `personas`
--
ALTER TABLE `personas`
  ADD PRIMARY KEY (`id_persona`),
  ADD KEY `cod_estado` (`cod_estado`),
  ADD KEY `sexo` (`sexo`),
  ADD KEY `id_persona` (`id_persona`);

--
-- Indices de la tabla `personas_dias`
--
ALTER TABLE `personas_dias`
  ADD PRIMARY KEY (`id_persona_dias`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `productos_dias`
--
ALTER TABLE `productos_dias`
  ADD PRIMARY KEY (`id_producto_dias`);

--
-- Indices de la tabla `relaciones`
--
ALTER TABLE `relaciones`
  ADD PRIMARY KEY (`id_relacion`);

--
-- Indices de la tabla `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `nombre` (`nombre`),
  ADD KEY `id_persona_federada` (`id_persona`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `articulos`
--
ALTER TABLE `articulos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `articulos_img`
--
ALTER TABLE `articulos_img`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `articulos_tag`
--
ALTER TABLE `articulos_tag`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `pagos`
--
ALTER TABLE `pagos`
  MODIFY `id_pago` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT de la tabla `personas`
--
ALTER TABLE `personas`
  MODIFY `id_persona` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Identificador de la persona en el dominio.', AUTO_INCREMENT=73;
--
-- AUTO_INCREMENT de la tabla `personas_dias`
--
ALTER TABLE `personas_dias`
  MODIFY `id_persona_dias` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;
--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT de la tabla `productos_dias`
--
ALTER TABLE `productos_dias`
  MODIFY `id_producto_dias` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT de la tabla `relaciones`
--
ALTER TABLE `relaciones`
  MODIFY `id_relacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;
--
-- AUTO_INCREMENT de la tabla `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT COMMENT 'Identificador de usuario.', AUTO_INCREMENT=66;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `articulos`
--
ALTER TABLE `articulos`
  ADD CONSTRAINT `articulos_categorias_id_foreign` FOREIGN KEY (`categorias_id`) REFERENCES `categorias` (`id`);

--
-- Filtros para la tabla `articulos_img`
--
ALTER TABLE `articulos_img`
  ADD CONSTRAINT `articulos_img_articulos_id_foreign` FOREIGN KEY (`articulos_id`) REFERENCES `articulos` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `articulos_tag`
--
ALTER TABLE `articulos_tag`
  ADD CONSTRAINT `articulos_tag_articulo_id_foreign` FOREIGN KEY (`articulo_id`) REFERENCES `articulos` (`id`),
  ADD CONSTRAINT `articulos_tag_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
