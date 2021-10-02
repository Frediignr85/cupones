-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-10-2021 a las 04:35:16
-- Versión del servidor: 10.4.17-MariaDB
-- Versión de PHP: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `cupones`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblcanje_oferta`
--

CREATE TABLE `tblcanje_oferta` (
  `id_canje_oferta` int(11) NOT NULL,
  `usuario_canje` varchar(255) NOT NULL,
  `id_oferta` int(11) NOT NULL,
  `id_compra_general` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblcliente`
--

CREATE TABLE `tblcliente` (
  `id_cliente` int(11) NOT NULL,
  `nombres` varchar(75) NOT NULL,
  `apellidos` varchar(75) NOT NULL,
  `id_municipio` int(11) NOT NULL,
  `id_departamento` int(11) NOT NULL,
  `direccion` varchar(250) NOT NULL,
  `telefono1` varchar(10) NOT NULL,
  `telefono2` varchar(10) DEFAULT NULL,
  `correo` varchar(150) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `dui` varchar(12) NOT NULL,
  `id_estado` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblcompra_detalle`
--

CREATE TABLE `tblcompra_detalle` (
  `id_compra_detalle` int(11) NOT NULL,
  `id_compra_especifica` int(11) NOT NULL,
  `id_oferta` int(11) NOT NULL,
  `precio_unitario` decimal(18,4) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `cantidad_canjeada` int(11) NOT NULL,
  `total_compra` decimal(18,4) NOT NULL,
  `total_ahorrado` decimal(18,4) NOT NULL,
  `id_estado` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `update_at` datetime NOT NULL DEFAULT current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tblcompra_detalle`
--

INSERT INTO `tblcompra_detalle` (`id_compra_detalle`, `id_compra_especifica`, `id_oferta`, `precio_unitario`, `cantidad`, `cantidad_canjeada`, `total_compra`, `total_ahorrado`, `id_estado`, `created_at`, `update_at`, `deleted_at`) VALUES
(1, 1, 1, '11.0000', 1, 0, '11.0000', '100.0000', 1, '2021-09-29 15:00:32', '2021-09-29 15:00:32', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblcompra_especifica`
--

CREATE TABLE `tblcompra_especifica` (
  `id_compra_especifica` int(11) NOT NULL,
  `id_compra_general` int(11) NOT NULL,
  `id_empresa` int(11) NOT NULL,
  `total_compra` decimal(18,4) NOT NULL,
  `total_ahorrado` decimal(18,4) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tblcompra_especifica`
--

INSERT INTO `tblcompra_especifica` (`id_compra_especifica`, `id_compra_general`, `id_empresa`, `total_compra`, `total_ahorrado`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, '100.0000', '12.0000', '2021-09-29 15:00:48', '2021-09-29 15:00:48', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblcompra_general`
--

CREATE TABLE `tblcompra_general` (
  `id_compra_general` int(11) NOT NULL,
  `total_compra` decimal(18,4) NOT NULL,
  `total_ahorrado` decimal(18,4) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `nombre_dueno` varchar(150) NOT NULL,
  `nombre_tarjeta` varchar(100) NOT NULL,
  `numero_tarjeta` varchar(20) NOT NULL,
  `fecha_expiracion` varchar(10) NOT NULL,
  `ccv` varchar(5) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbldepartamento`
--

CREATE TABLE `tbldepartamento` (
  `id_departamento` int(11) NOT NULL,
  `nombre_departamento` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `deleted_at` datetime DEFAULT NULL,
  `id_pais` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbldepartamento`
--

INSERT INTO `tbldepartamento` (`id_departamento`, `nombre_departamento`, `created_at`, `updated_at`, `deleted_at`, `id_pais`) VALUES
(1, 'Ahuachapán', '2020-11-30 13:33:56', '2020-11-30 13:33:56', NULL, 1),
(2, 'Santa Ana', '2020-11-30 13:33:56', '2020-11-30 13:33:56', NULL, 1),
(3, 'Sonsonate', '2020-11-30 13:33:56', '2020-11-30 13:33:56', NULL, 1),
(4, 'La Libertad', '2020-11-30 13:33:56', '2020-11-30 13:33:56', NULL, 1),
(5, 'Chalatenango', '2020-11-30 13:33:56', '2020-11-30 13:33:56', NULL, 1),
(6, 'San Salvador', '2020-11-30 13:33:56', '2020-11-30 13:33:56', NULL, 1),
(7, 'Cuscatlán', '2020-11-30 13:33:56', '2020-11-30 13:33:56', NULL, 1),
(8, 'La Paz', '2020-11-30 13:33:56', '2020-11-30 13:33:56', NULL, 1),
(9, 'Cabañas', '2020-11-30 13:33:56', '2020-11-30 13:33:56', NULL, 1),
(10, 'San Vicente', '2020-11-30 13:33:56', '2020-11-30 13:33:56', NULL, 1),
(11, 'Usulután', '2020-11-30 13:33:56', '2020-11-30 13:33:56', NULL, 1),
(12, 'Morazán', '2020-11-30 13:33:56', '2020-11-30 13:33:56', NULL, 1),
(13, 'San Miguel', '2020-11-30 13:33:56', '2020-11-30 13:33:56', NULL, 1),
(14, 'La Unión', '2020-11-30 13:33:56', '2020-11-30 13:33:56', NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbldependiente`
--

CREATE TABLE `tbldependiente` (
  `id_dependiente` int(11) NOT NULL,
  `nombres` varchar(150) NOT NULL,
  `apellidos` varchar(150) NOT NULL,
  `correo` varchar(200) NOT NULL,
  `id_empresa` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbldependiente`
--

INSERT INTO `tbldependiente` (`id_dependiente`, `nombres`, `apellidos`, `correo`, `id_empresa`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Fredy Mauricio', 'Benitez Orellana', 'fredymauricio.benitez.orellana@gmail.com', 0, '2021-10-01 19:28:04', '2021-10-01 19:28:04', NULL),
(2, 'Fredy Mauricio', 'Benitez Orellana', 'fredymauricio.benitez.orellana@gmail.com', 1, '2021-10-01 19:28:28', '2021-10-01 19:28:28', NULL),
(3, 'Fredy Mauricio', 'Benitez Orellana', 'fredymauricio.benitez.orellana@gmail.com', 1, '2021-10-01 19:28:29', '2021-10-01 19:28:29', NULL),
(4, 'Fredy Mauricio', 'Benitez Orellana', 'fredymauricio.benitez.orellana@gmail.com', 1, '2021-10-01 19:28:50', '2021-10-01 19:28:50', NULL),
(5, 'Fredy Mauricio', 'Benitez Orellana', 'fredymauricio.benitez.orellana@gmail.com', 1, '2021-10-01 19:28:51', '2021-10-01 19:28:51', NULL),
(6, 'Fredy', 'Benitez', 'fredymauricio@gmail.com', 1, '2021-10-01 19:29:05', '2021-10-01 19:29:05', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbldocente`
--

CREATE TABLE `tbldocente` (
  `id_docente` int(11) NOT NULL,
  `nombres` varchar(75) NOT NULL,
  `apellidos` varchar(75) NOT NULL,
  `fecha_de_nacimiento` date NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `codigo` varchar(15) NOT NULL,
  `unique_id` text NOT NULL,
  `id_sucursal` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbldocente`
--

INSERT INTO `tbldocente` (`id_docente`, `nombres`, `apellidos`, `fecha_de_nacimiento`, `usuario`, `codigo`, `unique_id`, `id_sucursal`, `id_usuario`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Fredy Mauricio', 'Benitez Orellana', '0000-00-00', 'Fredy_Benitez', 'DOC2021000', '', 1, 6, '2021-08-11 09:35:39', '2021-08-11 09:35:39', NULL),
(2, 'Ingrid Roxana', 'Argueta Claros', '0000-00-00', 'Ingrid_Roxana', 'DOC2021000', '', 1, 7, '2021-08-11 09:36:20', '2021-08-11 09:36:20', NULL),
(3, 'Martin', 'Marcos', '1995-03-15', 'Martin_Marcos', 'DOC20210002', '', 1, 8, '2021-08-11 09:39:34', '2021-08-11 09:39:34', '2021-08-11 09:59:00'),
(4, 'Martin', 'Marcos', '2000-02-10', 'martin_123', 'DOC20210003', '', 1, 9, '2021-08-11 09:40:48', '2021-08-11 09:40:48', '2021-08-11 09:59:00'),
(5, 'Kevin Antonio', 'Espinoza ', '1990-11-20', 'Kevin_Espinoza', 'DOC20210004', '', 1, 10, '2021-08-11 09:41:19', '2021-08-11 09:41:19', NULL),
(6, 'Emerson Francisco', 'Cartagena Candelario', '1990-10-10', 'Emerson_Cartagena', 'DOC20210005', '', 1, 40, '2021-08-11 18:29:25', '2021-08-11 18:29:25', NULL),
(7, 'Estela Yasmin', 'Fuentez Ortiz', '1990-10-20', 'Estela_Fuentez', 'DOC20210006', '', 1, 41, '2021-08-16 12:35:45', '2021-08-16 12:35:45', NULL),
(8, 'Armando Jose', 'Turcios Campos', '2000-05-20', 'Armando_Campos', 'DOC20210007', '', 1, 44, '2021-08-27 19:43:53', '2021-08-27 19:43:53', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblempleado`
--

CREATE TABLE `tblempleado` (
  `id_empleado` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `apellido` varchar(30) NOT NULL,
  `codigo` varchar(50) NOT NULL,
  `correlativo` varchar(5) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `telefono` varchar(10) NOT NULL,
  `imagen` text DEFAULT NULL,
  `dui` varchar(11) NOT NULL,
  `fecha_de_nacimiento` date NOT NULL,
  `sueldo` float DEFAULT NULL,
  `id_area` int(11) NOT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `deleted_at` datetime DEFAULT NULL,
  `id_tipo_empleado_EMP` int(11) NOT NULL,
  `id_estado_EMP` int(11) NOT NULL,
  `id_sexo_EMP` int(11) NOT NULL,
  `id_sucursal_EMP` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tblempleado`
--

INSERT INTO `tblempleado` (`id_empleado`, `nombre`, `apellido`, `codigo`, `correlativo`, `direccion`, `telefono`, `imagen`, `dui`, `fecha_de_nacimiento`, `sueldo`, `id_area`, `fecha_inicio`, `created_at`, `updated_at`, `deleted_at`, `id_tipo_empleado_EMP`, `id_estado_EMP`, `id_sexo_EMP`, `id_sucursal_EMP`) VALUES
(1, 'Fredy Mauricio', 'Benitez Orellana', '00000', '000', 'colonia las brisas', '7875575', NULL, '000000', '1990-04-13', NULL, 0, NULL, '2021-04-15 09:29:32', '2021-04-15 09:29:32', NULL, 1, 1, 2, 1),
(5, 'FREDYSS', 'BENITEZ ', '0218001', '1', 'COLONIA PRESITA', '7875-9666', 'img/608ec054c84d8_FREDY.jpg', '35465453-1', '1997-11-20', 600, 2, '2021-05-02', '2021-05-02 08:23:31', '2021-05-02 09:08:00', NULL, 4, 1, 2, 1),
(6, 'INGRID ROXANA', 'ARGUETA CLAROS', '0218002', '2', 'ATO NUEVO', '7978-5253', 'img/608eb6761194f_ROXANA.jpg', '37758554-6', '1997-09-11', 500, 3, '2021-05-02', '2021-05-02 08:25:58', '2021-05-02 08:25:58', NULL, 2, 1, 1, 1),
(7, 'JOSE ELIAS', 'GONZALES BLANCO', '0218003', '3', 'COLONIA MOLINO', '7485-9999', 'img/608eb6ad70b38_ELIAS.jpg', '53443524-4', '1997-03-20', 550, 2, '2021-05-02', '2021-05-02 08:26:53', '2021-05-02 08:26:53', NULL, 3, 1, 2, 1),
(8, 'TATIANA MARCELA', 'PORTILLO CUADRA', '0218004', '4', 'CIUDAD PACIFIC A', '7485-96', 'img/608ec0a5d6b46_atencion.jpg', '45645645-6', '1994-06-22', 500, 3, '2021-05-02', '2021-05-02 09:09:25', '2021-05-02 09:09:25', NULL, 2, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblempresa`
--

CREATE TABLE `tblempresa` (
  `id_empresa` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `propietario` varchar(255) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `telefono1` varchar(10) NOT NULL,
  `telefono2` varchar(10) NOT NULL,
  `website` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `nit` varchar(18) NOT NULL,
  `logo` varchar(100) NOT NULL,
  `timer` int(11) NOT NULL,
  `sms` int(11) NOT NULL,
  `ws` int(11) NOT NULL,
  `texto` text NOT NULL,
  `moneda` varchar(100) NOT NULL,
  `simbolo` varchar(10) NOT NULL,
  `mri` float NOT NULL,
  `mrs` float NOT NULL,
  `mes` float NOT NULL,
  `mei` float NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `deleted_at` datetime DEFAULT NULL,
  `id_municipio_EMP` int(11) NOT NULL,
  `forma_fiscal` int(11) NOT NULL,
  `control_interno` int(11) NOT NULL,
  `razon_social` varchar(100) NOT NULL,
  `giro` varchar(200) NOT NULL,
  `nrc` varchar(15) NOT NULL,
  `tipo_pag` int(11) NOT NULL,
  `tipo_facturacion` int(11) NOT NULL,
  `contado` int(11) NOT NULL,
  `credito` int(11) NOT NULL,
  `remisiones` int(11) NOT NULL,
  `seguros` int(11) NOT NULL,
  `logo_activo` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tblempresa`
--

INSERT INTO `tblempresa` (`id_empresa`, `nombre`, `propietario`, `direccion`, `telefono1`, `telefono2`, `website`, `email`, `nit`, `logo`, `timer`, `sms`, `ws`, `texto`, `moneda`, `simbolo`, `mri`, `mrs`, `mes`, `mei`, `created_at`, `updated_at`, `deleted_at`, `id_municipio_EMP`, `forma_fiscal`, `control_interno`, `razon_social`, `giro`, `nrc`, `tipo_pag`, `tipo_facturacion`, `contado`, `credito`, `remisiones`, `seguros`, `logo_activo`) VALUES
(1, 'UNIVERSIDAD DE ORIENTE', 'JUNTA DIRECTIVA', '4ta. Calle Poniente 705 San Miguel, El Salvador', '7777-7777', '0000-000', 'www.univo.edu.sv', 'univo@univo.edu.sv', '0000-000000-000-', 'img/611b105eacbc1_univo.jpg', 0, 3000, 100, 'Estimado {paciente} le recordamos que el dia {fecha} tiene una cita con nosotros a las {hora}. Atte. Clinica', 'Dolares', '$', 5, 7, 5, 8, '2020-12-03 08:43:44', '2021-08-29 08:33:00', NULL, 81, 0, 1, '', '', '', 0, 0, 1, 1, 1, 1, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblempresa_ofertante`
--

CREATE TABLE `tblempresa_ofertante` (
  `id_empresa` int(11) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `codigo` varchar(7) NOT NULL,
  `direccion` text NOT NULL,
  `id_municipio` int(11) NOT NULL,
  `id_departamento` int(11) NOT NULL,
  `nombre_contacto` varchar(150) NOT NULL,
  `telefono` varchar(10) NOT NULL,
  `correo` varchar(150) NOT NULL,
  `id_rubro` int(11) NOT NULL,
  `id_estado` int(11) NOT NULL,
  `porcentaje` float NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tblempresa_ofertante`
--

INSERT INTO `tblempresa_ofertante` (`id_empresa`, `nombre`, `codigo`, `direccion`, `id_municipio`, `id_departamento`, `nombre_contacto`, `telefono`, `correo`, `id_rubro`, `id_estado`, `porcentaje`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Asados el Colocho', '123123', 'Colonia la esperanza santa gertrudis', 203, 6, 'Colocho', '1596-5566', 'colocho@gmail.com', 1, 1, 20, '2021-09-28 22:54:03', '2021-09-28 22:54:03', NULL),
(3, 'Automotores Umanzor', '123123', 'Colonia Gavidia', 68, 13, 'Jairo Umanzor', '91736-5966', 'fredy@gmail.com', 1, 1, 25, '2021-09-29 16:31:25', '2021-09-29 16:31:25', NULL),
(6, '123', '123123', '123123', 4, 1, '123', '123', 'hila@gmail.com', 1, 1, 11, '2021-09-29 18:12:08', '2021-09-29 18:12:08', '2021-09-29 19:12:14'),
(7, 'Tacos Marinita', 'ELQ843', 'Colonia Hermosillo', 81, 13, 'Marina Fuentes', '4859-6656', 'marina@gmail.com', 1, 1, 25, '2021-09-29 20:19:46', '2021-09-29 20:19:46', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblhistorial_justificaciones`
--

CREATE TABLE `tblhistorial_justificaciones` (
  `id_historial` int(11) NOT NULL,
  `id_oferta` int(11) NOT NULL,
  `justificacion` text NOT NULL,
  `fecha_justificacion` date NOT NULL,
  `hora_justificacion` time NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblmenu`
--

CREATE TABLE `tblmenu` (
  `id_menu` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `prioridad` int(11) NOT NULL,
  `icono` varchar(255) NOT NULL,
  `visible` tinyint(4) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `update_at` datetime NOT NULL DEFAULT current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tblmenu`
--

INSERT INTO `tblmenu` (`id_menu`, `nombre`, `prioridad`, `icono`, `visible`, `created_at`, `update_at`, `deleted_at`) VALUES
(3, 'Estudiantes', 8, 'fa fa-users', 0, '2021-05-01 00:40:15', '2021-05-01 00:40:15', NULL),
(4, 'Configuraciones', 100, 'fa fa-gears', 1, '2021-05-01 11:21:55', '2021-05-01 11:21:55', NULL),
(8, 'Facultades', 10, 'fa fa-medium', 0, '2021-07-25 16:28:33', '2021-07-25 16:28:33', NULL),
(9, 'Carreras', 11, 'fa fa-book', 0, '2021-07-25 16:28:33', '2021-07-25 16:28:33', NULL),
(10, 'Materias', 7, 'fa fa-book', 0, '2021-07-26 20:54:45', '2021-07-26 20:54:45', NULL),
(11, 'Docentes', 7, 'fa fa-user-circle', 0, '2021-07-26 21:44:00', '2021-07-26 21:44:00', NULL),
(12, 'Cursos', 2, 'fa fa-bolt', 0, '2021-08-11 11:21:54', '2021-08-11 11:21:54', NULL),
(13, 'Evaluaciones', 4, 'fa fa-tasks', 0, '2021-08-11 21:10:19', '2021-08-11 21:10:19', NULL),
(14, 'Empresas', 1, 'fa fa-university', 1, '2021-09-28 20:06:15', '2021-09-28 20:06:15', NULL),
(15, 'Rubros', 1, 'fa fa-glass ', 1, '2021-09-29 19:29:35', '2021-09-29 19:29:35', NULL),
(16, 'Ofertas Pendientes', 3, 'fa fa-hand-paper-o', 1, '2021-10-01 11:39:12', '2021-10-01 11:39:12', NULL),
(17, 'Ofertas Aprobadas', 4, 'fa fa-hand-peace-o', 1, '2021-10-01 11:39:12', '2021-10-01 11:39:12', NULL),
(18, 'Ofertas Activas', 5, 'fa fa-check ', 1, '2021-10-01 11:39:12', '2021-10-01 11:39:12', NULL),
(19, 'Ofertas Pasadas', 6, 'fa fa-backward', 1, '2021-10-01 11:39:12', '2021-10-01 11:39:12', NULL),
(20, 'Ofertas Rechazadas', 7, 'fa fa-times', 1, '2021-10-01 11:39:12', '2021-10-01 11:39:12', NULL),
(21, 'Ofertas descartadas', 8, 'fa fa-trash', 1, '2021-10-01 11:39:12', '2021-10-01 11:39:12', NULL),
(22, 'Ofertas', 1, 'fa fa-star', 1, '2021-10-01 16:19:51', '2021-10-01 16:19:51', NULL),
(23, 'Dependientes', 8, 'fa fa-users', 1, '2021-10-01 18:48:58', '2021-10-01 18:48:58', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblmodulo`
--

CREATE TABLE `tblmodulo` (
  `id_modulo` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `icono` varchar(255) NOT NULL,
  `mostrar_menu` tinyint(4) NOT NULL,
  `admin` tinyint(4) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `deleted_at` datetime DEFAULT NULL,
  `id_menu_MOD` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tblmodulo`
--

INSERT INTO `tblmodulo` (`id_modulo`, `nombre`, `descripcion`, `filename`, `icono`, `mostrar_menu`, `admin`, `created_at`, `updated_at`, `deleted_at`, `id_menu_MOD`) VALUES
(9, 'Admin Estudiantes', 'Admin Estudiantes', 'admin_estudiante.php', '', 1, 1, '2021-05-01 08:47:01', '2021-05-01 08:47:01', NULL, 3),
(10, 'Agregar Estudiante', 'Agregar Estudiante', 'agregar_estudiante.php', '', 0, 0, '2021-05-01 08:47:01', '2021-05-01 08:47:01', NULL, 3),
(11, 'Editar Estudiante', 'Editar Estudiante', 'editar_estudiante.php', '', 0, 0, '2021-05-01 08:47:01', '2021-05-01 08:47:01', NULL, 3),
(12, 'Ver Estudiante', 'Ver Estudiante', 'ver_estudiante.php', '', 0, 0, '2021-05-01 08:47:01', '2021-05-01 08:47:01', NULL, 3),
(13, 'Estado Estudiante', 'Estado Estudiante', 'estado_estudiante.php', '', 0, 0, '2021-05-01 08:47:01', '2021-05-01 08:47:01', NULL, 3),
(14, 'Usuarios', 'Administrar Usuarios', 'admin_usuario.php', '', 1, 1, '2021-05-01 11:24:44', '2021-05-01 11:24:44', NULL, 4),
(15, 'Eliminar Usuarios', 'Eliminar Usuarios', 'borrar_usuario.php', '', 0, 0, '2021-05-01 11:24:44', '2021-05-01 11:24:44', NULL, 4),
(16, 'Editar Usuarios', 'Editar Usuarios', 'editar_usuario.php', '', 0, 0, '2021-05-01 11:24:44', '2021-05-01 11:24:44', NULL, 4),
(17, 'Permisos Usuario', 'Permisos Usuario', 'permiso_usuario.php', '', 0, 0, '2021-05-01 11:24:44', '2021-05-01 11:24:44', NULL, 4),
(18, 'Agregar Usuario', 'Agregar Usuario', 'agregar_usuario.php', '', 0, 0, '2021-05-01 11:24:44', '2021-05-01 11:24:44', NULL, 4),
(19, 'Datos Institucion', 'Datos Institucion', 'admin_empresa.php', '', 1, 1, '2021-05-01 11:24:44', '2021-05-01 11:24:44', NULL, 4),
(34, 'Admin Facultad', 'Admin Facultad', 'admin_facultad.php', '', 1, 1, '2021-07-25 16:33:15', '2021-07-25 16:33:15', NULL, 8),
(35, 'Agregar Facultad', 'Agregar Facultad', 'agregar_facultad.php', '', 0, 0, '2021-07-25 16:33:15', '2021-07-25 16:33:15', NULL, 8),
(36, 'Editar Facultad', 'Editar Facultad', 'editar_facultad.php', '', 0, 0, '2021-07-25 16:33:15', '2021-07-25 16:33:15', NULL, 8),
(37, 'Borrar Facultad', 'Borrar Facultad', 'borrar_facultad.php', '', 0, 0, '2021-07-25 16:33:15', '2021-07-25 16:33:15', NULL, 8),
(38, 'Admin Carreras', 'Admin Carreras', 'admin_carreras.php', '', 1, 1, '2021-07-25 16:33:15', '2021-07-25 16:33:15', NULL, 9),
(39, 'Agregar Carrera', 'Agregar Carrera', 'agregar_carrera.php', '', 0, 0, '2021-07-25 16:33:15', '2021-07-25 16:33:15', NULL, 9),
(40, 'Editar Carrera', 'Editar Carrera', 'editar_carrera.php', '', 0, 0, '2021-07-25 16:33:15', '2021-07-25 16:33:15', NULL, 9),
(41, 'Borrar Carrera', 'Borrar Carrera', 'borrar_carrera.php', '', 0, 0, '2021-07-25 16:33:15', '2021-07-25 16:33:15', NULL, 9),
(42, 'Admin Materias', 'Admin Materias', 'admin_materia.php', '', 1, 1, '2021-07-26 20:56:22', '2021-07-26 20:56:22', NULL, 10),
(43, 'Agregar Materia', 'Agregar Materia', 'agregar_materia.php', '', 0, 0, '2021-07-26 20:56:22', '2021-07-26 20:56:22', NULL, 10),
(44, 'Editar Materia', 'Editar Materia', 'editar_materia.php', '', 0, 0, '2021-07-26 20:56:22', '2021-07-26 20:56:22', NULL, 10),
(45, 'Borrar Materia', 'Borrar Materia', 'borrar_materia.php', '', 0, 0, '2021-07-26 20:56:22', '2021-07-26 20:56:22', NULL, 10),
(46, 'Admin Docentes', 'Admin Docentes', 'admin_docente.php', '', 1, 1, '2021-07-26 21:47:41', '2021-07-26 21:47:41', NULL, 11),
(47, 'Agregar Docente', 'Agregar Docente', 'agregar_docente.php', '', 0, 0, '2021-07-26 21:47:41', '2021-07-26 21:47:41', NULL, 11),
(48, 'Editar Docente', 'Editar Docente', 'editar_docente.php', '', 0, 0, '2021-07-26 21:47:41', '2021-07-26 21:47:41', NULL, 11),
(49, 'Borrar Docente', 'Borrar Docente', 'borrar_docente.php', '', 0, 0, '2021-07-26 21:47:41', '2021-07-26 21:47:41', NULL, 11),
(50, 'Admin Cursos', 'Admin Cursos', 'admin_curso.php', '', 1, 1, '2021-08-11 11:24:47', '2021-08-11 11:24:47', NULL, 12),
(51, 'Agregar Curso', 'Agregar Curso', 'agregar_curso.php', '', 0, 0, '2021-08-11 11:24:47', '2021-08-11 11:24:47', NULL, 12),
(52, 'Editar Curso', 'Editar Curso', 'editar_curso.php', '', 0, 0, '2021-08-11 11:24:47', '2021-08-11 11:24:47', NULL, 12),
(53, 'Borrar Curso', 'Borrar Curso', 'borrar_curso.php', '', 0, 0, '2021-08-11 11:24:47', '2021-08-11 11:24:47', NULL, 12),
(54, 'Estado Curso', 'Estado Curso', 'estado_curso.php', '', 0, 0, '2021-08-11 11:24:47', '2021-08-11 11:24:47', NULL, 12),
(55, 'Admin Estudiantes Curso', 'Admin Estudiantes Curso', 'estudiantes_cursos.php', '', 0, 0, '2021-08-11 11:24:47', '2021-08-11 11:24:47', NULL, 12),
(56, 'Admin Docentes Curso', 'Admin Docentes Curso', 'docentes_cursos.php', '', 0, 0, '2021-08-11 11:24:47', '2021-08-11 11:24:47', NULL, 12),
(57, 'Admin Evaluaciones', 'Admin Evaluaciones', 'admin_evaluaciones.php', '', 1, 1, '2021-08-11 21:16:40', '2021-08-11 21:16:40', NULL, 13),
(58, 'Agregar Evaluacion', 'Agregar Evaluacion', 'agregar_evaluacion.php', '', 0, 0, '2021-08-11 21:16:40', '2021-08-11 21:16:40', NULL, 13),
(59, 'Editar Evaluacion', 'Editar Evaluacion', 'editar_evaluacion.php', '', 0, 0, '2021-08-11 21:16:40', '2021-08-11 21:16:40', NULL, 13),
(60, 'Borrar Evaluacion', 'Borrar Evaluacion', 'borrar_evaluacion.php', '', 0, 0, '2021-08-11 21:16:40', '2021-08-11 21:16:40', NULL, 13),
(61, 'Realizar Evaluacion', 'Realizar Evaluacion', 'realizar_evaluacion.php', '', 0, 0, '2021-08-11 21:16:40', '2021-08-11 21:16:40', NULL, 13),
(62, 'Resultados Evaluacion', 'Resultados Evaluacion', 'resultados_evaluacion.php', '', 0, 0, '2021-08-11 21:16:40', '2021-08-11 21:16:40', NULL, 13),
(64, 'Ver Evaluacion', 'Ver Evaluacion', 'ver_evaluacion.php', '', 0, 0, '2021-08-11 21:16:40', '2021-08-11 21:16:40', NULL, 13),
(65, 'Ver Curso', 'Ver Curso', 'ver_curso.php', '', 0, 0, '2021-08-15 13:49:06', '2021-08-15 13:49:06', NULL, 12),
(66, 'Ver Resultado Evaluacion', 'Ver Resultado Evaluacion', 'ver_resultado_evaluacion.php', '', 0, 0, '2021-08-15 23:46:25', '2021-08-15 23:46:25', NULL, 13),
(67, 'Imprimir Resultado Individual', 'Imprimir Resultado Individual', 'resultado_individual.php', '', 0, 0, '2021-08-15 23:46:25', '2021-08-15 23:46:25', NULL, 13),
(68, 'Imprimir Resultado General', 'Imprimir Resultado General', 'resultado_general.php', '', 0, 0, '2021-08-15 23:46:25', '2021-08-15 23:46:25', NULL, 13),
(69, 'Admin Empresas', 'Admin Empresas', 'empresa/', '', 1, 1, '2021-09-28 20:09:02', '2021-09-28 20:09:02', NULL, 14),
(70, 'Agregar Empresa', 'Agregar Empresa', 'empresa/agregar_empresa', '', 0, 0, '2021-09-28 20:09:02', '2021-09-28 20:09:02', NULL, 14),
(71, 'Editar Empresa', 'Editar Empresa', 'empresa/editar_empresa', '', 0, 0, '2021-09-28 20:09:02', '2021-09-28 20:09:02', NULL, 14),
(72, 'Borrar Empresa', 'Borrar Empresa', 'empresa/borrar_empresa', '', 0, 0, '2021-09-28 20:09:02', '2021-09-28 20:09:02', NULL, 14),
(73, 'Admin Rubros', 'Admin Rubros', 'rubros/', '', 1, 1, '2021-09-29 19:31:28', '2021-09-29 19:31:28', NULL, 15),
(74, 'Agregar Rubro', 'Agregar Rubro', 'rubros/agregar_rubro/', '', 0, 0, '2021-09-29 19:31:28', '2021-09-29 19:31:28', NULL, 15),
(75, 'Editar Rubro', 'Editar Rubro', 'rubros/editar_rubro/', '', 0, 0, '2021-09-29 19:31:28', '2021-09-29 19:31:28', NULL, 15),
(76, 'Borrar Rubro', 'Borrar Rubro', 'rubros/borrar_rubro', '', 0, 0, '2021-09-29 19:31:28', '2021-09-29 19:31:28', NULL, 15),
(77, 'Ofertas Pendientes', 'Ofertas Pendientes', 'ofertas_pendientes/', '', 1, 1, '2021-10-01 11:42:19', '2021-10-01 11:42:19', NULL, 16),
(78, 'Ofertas Aprobadas', 'Ofertas Aprobadas', 'ofertas_aprobadas/', '', 1, 1, '2021-10-01 11:42:19', '2021-10-01 11:42:19', NULL, 17),
(79, 'Ofertas Activas', 'Ofertas Activas', 'ofertas_activas/', '', 1, 1, '2021-10-01 11:42:19', '2021-10-01 11:42:19', NULL, 18),
(80, 'Ofertas Pasadas', 'Ofertas Pasadas', 'ofertas_pasadas', '', 1, 1, '2021-10-01 11:42:19', '2021-10-01 11:42:19', NULL, 19),
(81, 'Ofertas Rechazadas', 'Ofertas Rechazadas', 'ofertas_rechazadas/', '', 1, 1, '2021-10-01 11:42:19', '2021-10-01 11:42:19', NULL, 20),
(82, 'Ofertas Descartadas', 'Ofertas Descartadas', 'ofertas_descartadas/', '', 1, 1, '2021-10-01 11:42:19', '2021-10-01 11:42:19', NULL, 21),
(83, 'Agregar Oferta', 'Agregar Oferta', 'ofertas/agregar_oferta', '', 1, 1, '2021-10-01 16:20:16', '2021-10-01 16:20:16', NULL, 22),
(84, 'Admin Dependientes', 'Admin Dependientes', 'dependientes/', '', 1, 1, '2021-10-01 18:50:48', '2021-10-01 18:50:48', NULL, 23),
(85, 'Agregar Dependiente', 'Agregar Dependiente', 'dependientes/agregar_dependiente', '', 0, 0, '2021-10-01 18:50:48', '2021-10-01 18:50:48', NULL, 23),
(86, 'Editar Dependiente', 'Editar Dependiente', 'dependientes/editar_dependiente', '', 0, 0, '2021-10-01 18:50:48', '2021-10-01 18:50:48', NULL, 23),
(87, 'Borrar Dependiente', 'Borrar Dependiente', 'dependientes/borrar_dependiente', '', 0, 0, '2021-10-01 18:50:48', '2021-10-01 18:50:48', NULL, 23);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblmunicipio`
--

CREATE TABLE `tblmunicipio` (
  `id_municipio` int(11) NOT NULL,
  `municipio` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `deleted_at` datetime DEFAULT NULL,
  `id_departamento_MUN` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tblmunicipio`
--

INSERT INTO `tblmunicipio` (`id_municipio`, `municipio`, `created_at`, `updated_at`, `deleted_at`, `id_departamento_MUN`) VALUES
(1, 'Ahuachapán', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 1),
(2, 'Jujutla', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 1),
(3, 'Atiquizaya', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 1),
(4, 'Concepción de Ataco', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 1),
(5, 'El Refugio', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 1),
(6, 'Guaymango', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 1),
(7, 'Apaneca', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 1),
(8, 'San Francisco Menéndez', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 1),
(9, 'San Lorenzo', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 1),
(10, 'San Pedro Puxtla', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 1),
(11, 'Tacuba', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 1),
(12, 'Turín', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 1),
(13, 'Candelaria de la Frontera', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 2),
(14, 'Chalchuapa', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 2),
(15, 'Coatepeque', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 2),
(16, 'El Congo', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 2),
(17, 'El Porvenir', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 2),
(18, 'Masahuat', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 2),
(19, 'Metapán', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 2),
(20, 'San Antonio Pajonal', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 2),
(21, 'San Sebastián Salitrillo', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 2),
(22, 'Santa Ana', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 2),
(23, 'Santa Rosa Guachipilín', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 2),
(24, 'Santiago de la Frontera', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 2),
(25, 'Texistepeque', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 2),
(26, 'Acajutla', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 3),
(27, 'Armenia', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 3),
(28, 'Caluco', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 3),
(29, 'Cuisnahuat', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 3),
(30, 'Izalco', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 3),
(31, 'Juayúa', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 3),
(32, 'Nahuizalco', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 3),
(33, 'Nahulingo', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 3),
(34, 'Salcoatitán', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 3),
(35, 'San Antonio del Monte', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 3),
(36, 'San Julián', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 3),
(37, 'Santa Catarina Masahuat', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 3),
(38, 'Santa Isabel Ishuatán', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 3),
(39, 'Santo Domingo de Guzmán', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 3),
(40, 'Sonsonate', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 3),
(41, 'Sonzacate', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 3),
(42, 'Alegría', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 4),
(43, 'Berlín', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 11),
(44, 'California', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 11),
(45, 'Concepción Batres', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 11),
(46, 'El Triunfo', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 11),
(47, 'Ereguayquín', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 11),
(48, 'Estanzuelas', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 11),
(49, 'Jiquilisco', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 11),
(50, 'Jucuapa', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 11),
(51, 'Jucuarán', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 11),
(52, 'Mercedes Umaña', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 11),
(53, 'Nueva Granada', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 11),
(54, 'Ozatlán', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 11),
(55, 'Puerto El Triunfo', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 11),
(56, 'San Agustín', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 11),
(57, 'San Buenaventura', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 11),
(58, 'San Dionisio', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 11),
(59, 'San Francisco Javier', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 11),
(60, 'Santa Elena', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 11),
(61, 'Santa María', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 11),
(62, 'Santiago de María', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 11),
(63, 'Tecapán', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 11),
(64, 'Usulután', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 11),
(65, 'Carolina', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 13),
(66, 'Chapeltique', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 13),
(67, 'Chinameca', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 13),
(68, 'Chirilagua', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 13),
(69, 'Ciudad Barrios', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 13),
(70, 'Comacarán', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 13),
(71, 'El Tránsito', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 13),
(72, 'Lolotique', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 13),
(73, 'Moncagua', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 13),
(74, 'Nueva Guadalupe', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 13),
(75, 'Nuevo Edén de San Juan', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 13),
(76, 'Quelepa', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 13),
(77, 'San Antonio del Mosco', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 13),
(78, 'San Gerardo', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 13),
(79, 'San Jorge', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 13),
(80, 'San Luis de la Reina', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 13),
(81, 'San Miguel', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 13),
(82, 'San Rafael Oriente', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 13),
(83, 'Sesori', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 13),
(84, 'Uluazapa', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 13),
(85, 'Arambala', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 12),
(86, 'Cacaopera', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 12),
(87, 'Chilanga', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 12),
(88, 'Corinto', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 12),
(89, 'Delicias de Concepción', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 12),
(90, 'El Divisadero', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 12),
(91, 'El Rosario', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 12),
(92, 'Gualococti', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 12),
(93, 'Guatajiagua', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 12),
(94, 'Joateca', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 12),
(95, 'Jocoaitique', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 12),
(96, 'Jocoro', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 12),
(97, 'Lolotiquillo', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 12),
(98, 'Meanguera', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 12),
(99, 'Osicala', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 12),
(100, 'Perquín', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 12),
(101, 'San Carlos', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 12),
(102, 'San Fernando', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 12),
(103, 'San Francisco Gotera', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 12),
(104, 'San Isidro', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 12),
(105, 'San Simón', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 12),
(106, 'Sensembra', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 12),
(107, 'Sociedad', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 12),
(108, 'Torola', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 12),
(109, 'Yamabal', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 12),
(110, 'Yoloaiquín', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 12),
(111, 'La Unión', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 14),
(112, 'San Alejo', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 14),
(113, 'Yucuaiquín', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 14),
(114, 'Conchagua', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 14),
(115, 'Intipucá', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 14),
(116, 'San José', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 14),
(117, 'El Carmen', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 14),
(118, 'Yayantique', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 14),
(119, 'Bolívar', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 14),
(120, 'Meanguera del Golfo', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 14),
(121, 'Santa Rosa de Lima', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 14),
(122, 'Pasaquina', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 14),
(123, 'ANAMOROS', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 14),
(124, 'Nueva Esparta', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 14),
(125, 'El Sauce', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 14),
(126, 'Concepción de Oriente', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 14),
(127, 'Polorós', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 14),
(128, 'Lislique ', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 14),
(129, 'Antiguo Cuscatlán', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 4),
(130, 'Chiltiupán', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 4),
(131, 'Ciudad Arce', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 4),
(132, 'Colón', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 4),
(133, 'Comasagua', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 4),
(134, 'Huizúcar', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 4),
(135, 'Jayaque', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 4),
(136, 'Jicalapa', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 4),
(137, 'La Libertad', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 4),
(138, 'Santa Tecla', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 4),
(139, 'Nuevo Cuscatlán', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 4),
(140, 'San Juan Opico', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 4),
(141, 'Quezaltepeque', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 4),
(142, 'Sacacoyo', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 4),
(143, 'San José Villanueva', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 4),
(144, 'San Matías', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 4),
(145, 'San Pablo Tacachico', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 4),
(146, 'Talnique', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 4),
(147, 'Tamanique', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 4),
(148, 'Teotepeque', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 4),
(149, 'Tepecoyo', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 4),
(150, 'Zaragoza', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 4),
(151, 'Agua Caliente', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 5),
(152, 'Arcatao', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 5),
(153, 'Azacualpa', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 5),
(154, 'Cancasque', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 5),
(155, 'Chalatenango', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 5),
(156, 'Citalá', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 5),
(157, 'Comapala', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 5),
(158, 'Concepción Quezaltepeque', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 5),
(159, 'Dulce Nombre de María', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 5),
(160, 'El Carrizal', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 5),
(161, 'El Paraíso', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 5),
(162, 'La Laguna', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 5),
(163, 'La Palma', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 5),
(164, 'La Reina', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 5),
(165, 'Las Vueltas', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 5),
(166, 'Nueva Concepción', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 5),
(167, 'Nueva Trinidad', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 5),
(168, 'Nombre de Jesús', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 5),
(169, 'Ojos de Agua', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 5),
(170, 'Potonico', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 5),
(171, 'San Antonio de la Cruz', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 5),
(172, 'San Antonio Los Ranchos', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 5),
(173, 'San Fernando', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 5),
(174, 'San Francisco Lempa', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 5),
(175, 'San Francisco Morazán', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 5),
(176, 'San Ignacio', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 5),
(177, 'San Isidro Labrador', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 5),
(178, 'Las Flores', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 5),
(179, 'San Luis del Carmen', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 5),
(180, 'San Miguel de Mercedes', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 5),
(181, 'San Rafael', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 5),
(182, 'Santa Rita', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 5),
(183, 'Tejutla', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 5),
(184, 'Cojutepeque', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 7),
(185, 'Candelaria', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 7),
(186, 'El Carmen', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 7),
(187, 'El Rosario', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 7),
(188, 'Monte San Juan', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 7),
(189, 'Oratorio de Concepción', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 7),
(190, 'San Bartolomé Perulapía', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 7),
(191, 'San Cristóbal', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 7),
(192, 'San José Guayabal', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 7),
(193, 'San Pedro Perulapán', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 7),
(194, 'San Rafael Cedros', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 7),
(195, 'San Ramón', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 7),
(196, 'Santa Cruz Analquito', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 7),
(197, 'Santa Cruz Michapa', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 7),
(198, 'Suchitoto', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 7),
(199, 'Tenancingo', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 7),
(200, 'Aguilares', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 6),
(201, 'Apopa', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 6),
(202, 'Ayutuxtepeque', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 6),
(203, 'Cuscatancingo', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 6),
(204, 'Ciudad Delgado', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 6),
(205, 'El Paisnal', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 6),
(206, 'Guazapa', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 6),
(207, 'Ilopango', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 6),
(208, 'Mejicanos', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 6),
(209, 'Nejapa', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 6),
(210, 'Panchimalco', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 6),
(211, 'Rosario de Mora', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 6),
(212, 'San Marcos', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 6),
(213, 'San Martín', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 6),
(214, 'San Salvador', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 6),
(215, 'Santiago Texacuangos', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 6),
(216, 'Santo Tomás', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 6),
(217, 'Soyapango', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 6),
(218, 'Tonacatepeque', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 6),
(219, 'Zacatecoluca', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 8),
(220, 'Cuyultitán', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 8),
(221, 'El Rosario', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 8),
(222, 'Jerusalén', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 8),
(223, 'Mercedes La Ceiba', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 8),
(224, 'Olocuilta', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 8),
(225, 'Paraíso de Osorio', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 8),
(226, 'San Antonio Masahuat', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 8),
(227, 'San Emigdio', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 8),
(228, 'San Francisco Chinameca', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 8),
(229, 'San Pedro Masahuat', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 8),
(230, 'San Juan Nonualco', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 8),
(231, 'San Juan Talpa', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 8),
(232, 'San Juan Tepezontes', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 8),
(233, 'San Luis La Herradura', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 8),
(234, 'San Luis Talpa', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 8),
(235, 'San Miguel Tepezontes', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 8),
(236, 'San Pedro Nonualco', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 8),
(237, 'San Rafael Obrajuelo', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 8),
(238, 'Santa María Ostuma', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 8),
(239, 'Santiago Nonualco', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 8),
(240, 'Tapalhuaca', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 8),
(241, 'Cinquera', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 9),
(242, 'Dolores', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 9),
(243, 'Guacotecti', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 9),
(244, 'Ilobasco', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 9),
(245, 'Jutiapa', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 9),
(246, 'San Isidro', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 9),
(247, 'Sensuntepeque', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 9),
(248, 'Tejutepeque', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 9),
(249, 'Victoria', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 9),
(250, 'Apastepeque', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 10),
(251, 'Guadalupe', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 10),
(252, 'San Cayetano Istepeque', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 10),
(253, 'San Esteban Catarina', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 10),
(254, 'San Ildefonso', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 10),
(255, 'San Lorenzo', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 10),
(256, 'San Sebastián', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 10),
(257, 'San Vicente', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 10),
(258, 'Santa Clara', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 10),
(259, 'Santo Domingo', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 10),
(260, 'Tecoluca', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 10),
(261, 'Tepetitán', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 10),
(262, 'Verapaz', '2020-11-30 13:37:39', '2020-11-30 13:37:39', NULL, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbloferta`
--

CREATE TABLE `tbloferta` (
  `id_oferta` int(11) NOT NULL,
  `titulo_oferta` varchar(100) NOT NULL,
  `precio_regular` decimal(18,4) NOT NULL,
  `precio_oferta` decimal(18,4) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `fecha_limite` date NOT NULL,
  `cantidad_limite_cupones` int(11) DEFAULT NULL,
  `descripcion` text NOT NULL,
  `otros_detalles` text DEFAULT NULL,
  `justificacion` text DEFAULT NULL,
  `ilimitado` tinyint(4) NOT NULL,
  `id_estado` int(11) NOT NULL,
  `id_empresa` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tbloferta`
--

INSERT INTO `tbloferta` (`id_oferta`, `titulo_oferta`, `precio_regular`, `precio_oferta`, `fecha_inicio`, `fecha_fin`, `fecha_limite`, `cantidad_limite_cupones`, `descripcion`, `otros_detalles`, `justificacion`, `ilimitado`, `id_estado`, `id_empresa`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Oferta nUeva', '111.0000', '11.0000', '2021-09-29', '2021-09-30', '2021-10-15', 100, 'alklk;as', '123', NULL, 0, 6, 1, '2021-09-29 15:01:36', '2021-09-29 15:01:36', NULL),
(2, 'Oferta nueva', '15.0000', '10.0000', '0000-00-00', '0000-00-00', '0000-00-00', 100, 'Aprovecha esta ofera', '', NULL, 0, 1, 1, '2021-10-01 17:06:46', '2021-10-01 17:06:46', NULL),
(3, 'Super promocion', '25.0000', '20.0000', '2021-10-02', '2021-10-31', '2021-11-30', 150, 'Rebaja del 20% en todos tus productos', 'Agregando detalles perturbadores', 'Se rechazaq esta propuesta ', 0, 6, 1, '2021-10-01 17:26:15', '2021-10-01 17:26:15', '2021-10-01 18:40:03');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblpais`
--

CREATE TABLE `tblpais` (
  `id_pais` int(11) NOT NULL,
  `pais` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tblpais`
--

INSERT INTO `tblpais` (`id_pais`, `pais`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'EL SALVADOR', '2020-11-30 13:31:00', '2020-11-30 13:31:00', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblrubro`
--

CREATE TABLE `tblrubro` (
  `id_rubro` int(11) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `descripcion` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tblrubro`
--

INSERT INTO `tblrubro` (`id_rubro`, `nombre`, `descripcion`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Comedor', 'Este es un rubro de Comedores', '2021-09-29 14:59:49', '2021-09-29 14:59:49', NULL),
(2, 'Venta de Motocicletas', 'Holaa', '2021-09-29 19:45:58', '2021-09-29 19:45:58', NULL),
(3, '123', '123', '2021-09-29 20:01:43', '2021-09-29 20:01:43', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblsexo`
--

CREATE TABLE `tblsexo` (
  `id_sexo` int(11) NOT NULL,
  `sexo` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tblsexo`
--

INSERT INTO `tblsexo` (`id_sexo`, `sexo`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'FEMENINO', '2020-12-03 09:27:39', '2020-12-03 09:27:39', NULL),
(2, 'MASCULINO', '2020-12-03 09:27:39', '2020-12-03 09:27:39', NULL),
(3, 'OTRO', '2020-12-03 09:27:39', '2020-12-03 09:27:39', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbltipo_usuario`
--

CREATE TABLE `tbltipo_usuario` (
  `id_tipo_usuario` int(11) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tbltipo_usuario`
--

INSERT INTO `tbltipo_usuario` (`id_tipo_usuario`, `tipo`, `descripcion`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'ADMINISTRADOR', 'ADMINISTRADOR', '2021-07-26 21:40:40', '2021-07-26 21:40:40', NULL),
(2, 'DOCENTE', 'DOCENTE', '2021-07-26 21:40:40', '2021-07-26 21:40:40', NULL),
(3, 'ESTUDIANTE', 'ESTUDIANTE', '2021-07-26 21:40:40', '2021-07-26 21:40:40', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblusuario`
--

CREATE TABLE `tblusuario` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(60) NOT NULL,
  `usuario` varchar(60) NOT NULL,
  `password` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `deleted_at` datetime DEFAULT NULL,
  `id_tipo_usuario` int(11) NOT NULL,
  `id_dependiente` int(11) DEFAULT NULL,
  `id_admin_sucursal` int(11) NOT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `activo` tinyint(4) NOT NULL,
  `id_sucursal` int(11) NOT NULL,
  `id_empresa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tblusuario`
--

INSERT INTO `tblusuario` (`id_usuario`, `nombre`, `usuario`, `password`, `created_at`, `updated_at`, `deleted_at`, `id_tipo_usuario`, `id_dependiente`, `id_admin_sucursal`, `id_cliente`, `activo`, `id_sucursal`, `id_empresa`) VALUES
(2, 'Administrador de Sistema', 'admin', '827ccb0eea8a706c4c34a16891f84e7b', '2020-12-03 09:02:53', '2020-12-10 10:49:00', NULL, 1, -1, 0, NULL, 1, 1, 0),
(5, 'elias', 'Keiry_Virginia', '29a2b2e1849474d94d12051309c7b4d7', '2021-05-02 08:48:07', '2021-05-02 08:48:07', NULL, 1, 7, 0, NULL, 1, 1, 0),
(6, 'Fredy Mauricio', 'Fredy_Benitez', '11d2cbd738c7436679d45a24db32f9ad', '2021-08-11 09:35:39', '2021-08-11 09:35:39', NULL, 2, 1, 0, 0, 1, 1, 0),
(7, 'Ingrid Roxana', 'Ingrid_Roxana', 'e3390f914a2babbad2ad006f4e544737', '2021-08-11 09:36:20', '2021-08-11 09:36:20', NULL, 2, 2, 0, 0, 1, 1, 0),
(8, 'Martin', 'Martin_Marcos', 'f482259273ffd79b2728971e7b878ed8', '2021-08-11 09:39:34', '2021-08-11 09:39:34', NULL, 2, 3, 0, 0, 1, 1, 0),
(9, 'Martin', 'Elias_Gonzales', 'cfbbc7fb5d5f597e5bbe5e8cb7035170', '2021-08-11 09:40:48', '2021-08-11 09:40:48', NULL, 2, 4, 0, 0, 1, 1, 0),
(10, 'Kevin Antonio', 'Kevin_Espinoza', '69b248c59200ceb800daadbb9de6d798', '2021-08-11 09:41:19', '2021-08-11 09:41:19', NULL, 2, 5, 0, 0, 1, 1, 0),
(13, 'frediignr', 'EST20210000', 'ad8ea97be12752efd3cde77114674847', '2021-08-11 10:47:52', '2021-08-11 10:47:52', NULL, 3, NULL, 0, 3, 1, 1, 0),
(14, 'Elias_Batres', 'EST20210001', 'cf754f5401fb166cff0d894029d81f5b', '2021-08-11 10:50:40', '2021-08-11 10:50:40', NULL, 3, NULL, 0, 4, 1, 1, 0),
(15, 'Ingrid_Roxana', 'EST20210002', 'b3a37afac871b33fed4fdaaafa70da83', '2021-08-11 17:56:13', '2021-08-11 17:56:13', NULL, 3, NULL, 0, 5, 1, 1, 0),
(16, 'Fredy_Benitez', 'EST20210003', 'cb9d2461150e3d2d054e437561842ef2', '2021-08-11 17:56:40', '2021-08-11 17:56:40', NULL, 3, NULL, 0, 6, 1, 1, 0),
(17, 'Keiry_Virginia', 'EST20210004', 'fb8d293282441b7e150cb908cdda8701', '2021-08-11 17:57:39', '2021-08-11 17:57:39', NULL, 3, NULL, 0, 7, 1, 1, 0),
(18, 'Airon_Bautista', 'EST20210005', '318c81549e198bb5fb0ef545642fac1a', '2021-08-11 18:13:02', '2021-08-11 18:13:02', NULL, 3, NULL, 0, 8, 1, 1, 0),
(19, 'Blanca_Mendez', 'EST20210006', 'd0e9a5be7c31886679a62eb7875090f8', '2021-08-11 18:13:33', '2021-08-11 18:13:33', NULL, 3, NULL, 0, 9, 1, 1, 0),
(20, 'Blanca_Guardado', 'EST20210007', '8e3b5cbd32b9622694b97ab8cd902b24', '2021-08-11 18:14:26', '2021-08-11 18:14:26', NULL, 3, NULL, 0, 10, 1, 1, 0),
(21, 'Carlos_Vargas', 'EST20210008', 'b343ebf885fa59bef47663da90d075e5', '2021-08-11 18:15:26', '2021-08-11 18:15:26', NULL, 3, NULL, 0, 11, 1, 1, 0),
(22, 'Cesar_Morales', 'EST20210009', '9a3f666a2871000d70eb76cf9cb825a7', '2021-08-11 18:16:04', '2021-08-11 18:16:04', NULL, 3, NULL, 0, 12, 1, 1, 0),
(23, 'Cindy_Molina', 'EST20210010', '4b64e6ae5637d95b09f80265b667ee81', '2021-08-11 18:16:30', '2021-08-11 18:16:30', NULL, 3, NULL, 0, 13, 1, 1, 0),
(24, 'Christian_Chamul', 'EST20210011', 'dff9a61757fed1edbdf08b1d796c444a', '2021-08-11 18:17:38', '2021-08-11 18:17:38', NULL, 3, NULL, 0, 14, 1, 1, 0),
(25, 'Dilver_Yanez', 'EST20210012', '92284da8eab8c2f12dc1ae2465e77fde', '2021-08-11 18:18:11', '2021-08-11 18:18:11', NULL, 3, NULL, 0, 15, 1, 1, 0),
(26, 'Emerson_Cartagena', 'EST20210013', '79466c04ebd513ce8df9a0ade5ab6f25', '2021-08-11 18:19:09', '2021-08-11 18:19:09', NULL, 3, NULL, 0, 16, 1, 1, 0),
(27, 'Francisco_Mendez', 'EST20210014', '60861c594b10150825313dfac2ecc363', '2021-08-11 18:19:39', '2021-08-11 18:19:39', NULL, 3, NULL, 0, 17, 1, 1, 0),
(28, 'Guillermo_Martinez', 'EST20210015', 'a15833c08f699f9f688db5608b84e474', '2021-08-11 18:20:15', '2021-08-11 18:20:15', NULL, 3, NULL, 0, 18, 1, 1, 0),
(29, 'Heysel_Pereira', 'EST20210016', '32f33d39d24134466e021a9e65003b82', '2021-08-11 18:20:44', '2021-08-11 18:20:44', NULL, 3, NULL, 0, 19, 1, 1, 0),
(30, 'Jhonatan_Hernandez', 'EST20210017', '4b585e78aa048f1491d994dc3db50393', '2021-08-11 18:21:13', '2021-08-11 18:21:13', NULL, 3, NULL, 0, 20, 1, 1, 0),
(31, 'Josue_Barahona', 'EST20210018', '95adff0fe32a170290dbde87fa5a1fc2', '2021-08-11 18:21:44', '2021-08-11 18:21:44', NULL, 3, NULL, 0, 21, 1, 1, 0),
(32, 'Karla_Maldonado', 'EST20210019', '3bb706d51879adf94c5e9d4e6f93890c', '2021-08-11 18:22:28', '2021-08-11 18:22:28', NULL, 3, NULL, 0, 22, 1, 1, 0),
(33, 'Kevin_Flores', 'EST20210020', '26263d17b8c9d80940ae3c8996c459e1', '2021-08-11 18:22:51', '2021-08-11 18:22:51', NULL, 3, NULL, 0, 23, 1, 1, 0),
(34, 'Kevin_Rodriguez', 'EST20210021', '1440b6e2238c0dfa42c71f816d0f45d6', '2021-08-11 18:24:54', '2021-08-11 18:24:54', NULL, 3, NULL, 0, 24, 1, 1, 0),
(35, 'Manuel_Reyes', 'EST20210022', '7af89ad90508f9320cebaed6e55b4ffe', '2021-08-11 18:25:31', '2021-08-11 18:25:31', NULL, 3, NULL, 0, 25, 1, 1, 0),
(36, 'Miguel_Perez', 'EST20210023', '5f1584a0f0a9a3c7c14f7a0005bc3688', '2021-08-11 18:25:54', '2021-08-11 18:25:54', NULL, 3, NULL, 0, 26, 1, 1, 0),
(37, 'Oscar_Lopez', 'EST20210024', 'e9f96ca907fbef2a7704bca43166849a', '2021-08-11 18:26:23', '2021-08-11 18:26:23', NULL, 3, NULL, 0, 27, 1, 1, 0),
(38, 'Reina_Zavala', 'EST20210025', 'ddab8e038b6e041b14638e922b9041ad', '2021-08-11 18:27:22', '2021-08-11 18:27:22', NULL, 3, NULL, 0, 28, 1, 1, 0),
(39, 'Wilber_Perdomo', 'EST20210026', 'c13188c23f2b27958df80dae9abd2380', '2021-08-11 18:27:48', '2021-08-11 18:27:48', NULL, 3, NULL, 0, 29, 1, 1, 0),
(40, 'Emerson_Cartagena', 'Emerson_Cartagena', '3c923a682d7c1cdca089fb52b23eb0f0', '2021-08-11 18:29:25', '2021-08-11 18:29:25', NULL, 2, 6, 0, 0, 0, 1, 0),
(41, 'Estela_Fuentez', 'DOC20210006', '9024fd55fe8a9587ee49b371ff2d93bd', '2021-08-16 12:35:45', '2021-08-16 17:50:00', NULL, 2, 7, 0, 0, 1, 1, 0),
(42, 'Administrador 2', 'admin2', 'c84258e9c39059a89ab77d846ddab909', '2021-08-16 17:55:20', '2021-08-16 17:55:20', NULL, 1, NULL, 0, NULL, 1, 1, 0),
(43, 'Cristian_Pineda', 'EST20210027', '59e17d8eb6d0204e060102c9e2680ca2', '2021-08-16 19:08:24', '2021-08-16 19:08:24', NULL, 3, NULL, 0, 30, 1, 1, 0),
(44, 'Armando_Campos', 'DOC20210007', '827ccb0eea8a706c4c34a16891f84e7b', '2021-08-27 19:43:53', '2021-08-27 19:43:53', NULL, 2, 8, 0, 0, 1, 1, 0),
(45, 'Luis_Guevara', 'EST20210028', '3bc9135a76a1afbfd7e829a3bb025cbe', '2021-08-27 19:51:08', '2021-08-27 19:51:08', NULL, 3, NULL, 0, 31, 1, 1, 0),
(46, 'Antonio Juarez', 'EST20210029', 'e24ed772e7d723800bf5e736e0bf9243', '2021-08-29 08:17:44', '2021-08-29 08:17:44', NULL, 3, NULL, 0, 32, 1, 1, 0),
(47, 'Fredy Mauricio Benitez Orellana', 'Fredy_Benitez_6', '25f9e794323b453885f5181f1b624d0b', '2021-10-01 19:29:05', '2021-10-01 19:29:05', NULL, 3, 6, 0, 0, 0, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblusuario_modulo`
--

CREATE TABLE `tblusuario_modulo` (
  `id_modulo_usuario` int(11) NOT NULL,
  `id_modulo` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `tblusuario_modulo`
--

INSERT INTO `tblusuario_modulo` (`id_modulo_usuario`, `id_modulo`, `id_usuario`, `created_at`, `updated_at`, `deleted_at`) VALUES
(20, 32, 5, '2021-05-02 08:48:24', '2021-05-02 08:48:24', NULL),
(21, 33, 5, '2021-05-02 08:48:24', '2021-05-02 08:48:24', NULL),
(22, 20, 5, '2021-05-02 08:48:24', '2021-05-02 08:48:24', NULL),
(23, 21, 5, '2021-05-02 08:48:24', '2021-05-02 08:48:24', NULL),
(24, 22, 5, '2021-05-02 08:48:24', '2021-05-02 08:48:24', NULL),
(25, 23, 5, '2021-05-02 08:48:24', '2021-05-02 08:48:24', NULL),
(26, 24, 5, '2021-05-02 08:48:24', '2021-05-02 08:48:24', NULL),
(27, 25, 5, '2021-05-02 08:48:24', '2021-05-02 08:48:24', NULL),
(28, 26, 5, '2021-05-02 08:48:24', '2021-05-02 08:48:24', NULL),
(29, 27, 5, '2021-05-02 08:48:24', '2021-05-02 08:48:24', NULL),
(30, 28, 5, '2021-05-02 08:48:24', '2021-05-02 08:48:24', NULL),
(199, 67, 2, '2021-08-16 12:49:06', '2021-08-16 12:49:06', NULL),
(200, 61, 2, '2021-08-16 12:49:06', '2021-08-16 12:49:06', NULL),
(211, 67, 14, '2021-08-16 12:52:31', '2021-08-16 12:52:31', NULL),
(212, 61, 14, '2021-08-16 12:52:31', '2021-08-16 12:52:31', NULL),
(213, 67, 15, '2021-08-16 12:52:38', '2021-08-16 12:52:38', NULL),
(214, 61, 15, '2021-08-16 12:52:38', '2021-08-16 12:52:38', NULL),
(215, 67, 16, '2021-08-16 12:52:58', '2021-08-16 12:52:58', NULL),
(216, 61, 16, '2021-08-16 12:52:58', '2021-08-16 12:52:58', NULL),
(217, 67, 17, '2021-08-16 12:53:05', '2021-08-16 12:53:05', NULL),
(218, 61, 17, '2021-08-16 12:53:05', '2021-08-16 12:53:05', NULL),
(219, 67, 18, '2021-08-16 12:53:14', '2021-08-16 12:53:14', NULL),
(220, 61, 18, '2021-08-16 12:53:14', '2021-08-16 12:53:14', NULL),
(221, 67, 19, '2021-08-16 12:53:21', '2021-08-16 12:53:21', NULL),
(222, 61, 19, '2021-08-16 12:53:21', '2021-08-16 12:53:21', NULL),
(223, 67, 20, '2021-08-16 12:53:29', '2021-08-16 12:53:29', NULL),
(224, 61, 20, '2021-08-16 12:53:29', '2021-08-16 12:53:29', NULL),
(225, 67, 21, '2021-08-16 12:53:38', '2021-08-16 12:53:38', NULL),
(226, 61, 21, '2021-08-16 12:53:38', '2021-08-16 12:53:38', NULL),
(227, 67, 22, '2021-08-16 12:53:43', '2021-08-16 12:53:43', NULL),
(228, 61, 22, '2021-08-16 12:53:43', '2021-08-16 12:53:43', NULL),
(229, 67, 23, '2021-08-16 12:53:50', '2021-08-16 12:53:50', NULL),
(230, 61, 23, '2021-08-16 12:53:50', '2021-08-16 12:53:50', NULL),
(231, 67, 24, '2021-08-16 12:53:57', '2021-08-16 12:53:57', NULL),
(232, 61, 24, '2021-08-16 12:53:57', '2021-08-16 12:53:57', NULL),
(233, 67, 25, '2021-08-16 12:54:04', '2021-08-16 12:54:04', NULL),
(234, 61, 25, '2021-08-16 12:54:04', '2021-08-16 12:54:04', NULL),
(235, 67, 26, '2021-08-16 12:54:10', '2021-08-16 12:54:10', NULL),
(236, 61, 26, '2021-08-16 12:54:10', '2021-08-16 12:54:10', NULL),
(237, 67, 27, '2021-08-16 12:54:16', '2021-08-16 12:54:16', NULL),
(238, 61, 27, '2021-08-16 12:54:16', '2021-08-16 12:54:16', NULL),
(239, 67, 28, '2021-08-16 12:54:22', '2021-08-16 12:54:22', NULL),
(240, 61, 28, '2021-08-16 12:54:22', '2021-08-16 12:54:22', NULL),
(241, 67, 29, '2021-08-16 12:54:28', '2021-08-16 12:54:28', NULL),
(242, 61, 29, '2021-08-16 12:54:28', '2021-08-16 12:54:28', NULL),
(243, 67, 30, '2021-08-16 12:54:34', '2021-08-16 12:54:34', NULL),
(244, 61, 30, '2021-08-16 12:54:34', '2021-08-16 12:54:34', NULL),
(245, 67, 31, '2021-08-16 12:54:39', '2021-08-16 12:54:39', NULL),
(246, 61, 31, '2021-08-16 12:54:39', '2021-08-16 12:54:39', NULL),
(247, 67, 32, '2021-08-16 12:54:45', '2021-08-16 12:54:45', NULL),
(248, 61, 32, '2021-08-16 12:54:45', '2021-08-16 12:54:45', NULL),
(249, 67, 33, '2021-08-16 12:54:52', '2021-08-16 12:54:52', NULL),
(250, 61, 33, '2021-08-16 12:54:52', '2021-08-16 12:54:52', NULL),
(251, 67, 34, '2021-08-16 12:54:57', '2021-08-16 12:54:57', NULL),
(252, 61, 34, '2021-08-16 12:54:57', '2021-08-16 12:54:57', NULL),
(253, 67, 35, '2021-08-16 12:55:02', '2021-08-16 12:55:02', NULL),
(254, 61, 35, '2021-08-16 12:55:02', '2021-08-16 12:55:02', NULL),
(255, 67, 36, '2021-08-16 12:55:07', '2021-08-16 12:55:07', NULL),
(256, 61, 36, '2021-08-16 12:55:07', '2021-08-16 12:55:07', NULL),
(257, 67, 37, '2021-08-16 12:55:13', '2021-08-16 12:55:13', NULL),
(258, 61, 37, '2021-08-16 12:55:13', '2021-08-16 12:55:13', NULL),
(259, 67, 38, '2021-08-16 12:55:18', '2021-08-16 12:55:18', NULL),
(260, 61, 38, '2021-08-16 12:55:18', '2021-08-16 12:55:18', NULL),
(261, 67, 39, '2021-08-16 12:55:23', '2021-08-16 12:55:23', NULL),
(262, 61, 39, '2021-08-16 12:55:23', '2021-08-16 12:55:23', NULL),
(263, 50, 41, '2021-08-16 12:56:14', '2021-08-16 12:56:14', NULL),
(264, 51, 41, '2021-08-16 12:56:14', '2021-08-16 12:56:14', NULL),
(265, 54, 41, '2021-08-16 12:56:14', '2021-08-16 12:56:14', NULL),
(266, 57, 41, '2021-08-16 12:56:14', '2021-08-16 12:56:14', NULL),
(267, 58, 41, '2021-08-16 12:56:14', '2021-08-16 12:56:14', NULL),
(268, 59, 41, '2021-08-16 12:56:14', '2021-08-16 12:56:14', NULL),
(269, 60, 41, '2021-08-16 12:56:14', '2021-08-16 12:56:14', NULL),
(270, 62, 41, '2021-08-16 12:56:14', '2021-08-16 12:56:14', NULL),
(271, 63, 41, '2021-08-16 12:56:14', '2021-08-16 12:56:14', '2021-08-22 12:05:00'),
(272, 64, 41, '2021-08-16 12:56:14', '2021-08-16 12:56:14', NULL),
(273, 65, 41, '2021-08-16 12:56:14', '2021-08-16 12:56:14', NULL),
(274, 66, 41, '2021-08-16 12:56:14', '2021-08-16 12:56:14', NULL),
(275, 67, 41, '2021-08-16 12:56:14', '2021-08-16 12:56:14', NULL),
(276, 68, 41, '2021-08-16 12:56:14', '2021-08-16 12:56:14', NULL),
(319, 50, 6, '2021-08-16 12:56:59', '2021-08-16 12:56:59', NULL),
(320, 51, 6, '2021-08-16 12:56:59', '2021-08-16 12:56:59', NULL),
(321, 54, 6, '2021-08-16 12:56:59', '2021-08-16 12:56:59', NULL),
(322, 57, 6, '2021-08-16 12:56:59', '2021-08-16 12:56:59', NULL),
(323, 58, 6, '2021-08-16 12:56:59', '2021-08-16 12:56:59', NULL),
(324, 59, 6, '2021-08-16 12:56:59', '2021-08-16 12:56:59', NULL),
(325, 60, 6, '2021-08-16 12:56:59', '2021-08-16 12:56:59', NULL),
(326, 62, 6, '2021-08-16 12:56:59', '2021-08-16 12:56:59', NULL),
(327, 63, 6, '2021-08-16 12:56:59', '2021-08-16 12:56:59', NULL),
(328, 64, 6, '2021-08-16 12:56:59', '2021-08-16 12:56:59', NULL),
(329, 65, 6, '2021-08-16 12:56:59', '2021-08-16 12:56:59', NULL),
(330, 66, 6, '2021-08-16 12:56:59', '2021-08-16 12:56:59', NULL),
(331, 67, 6, '2021-08-16 12:56:59', '2021-08-16 12:56:59', NULL),
(332, 68, 6, '2021-08-16 12:56:59', '2021-08-16 12:56:59', NULL),
(333, 50, 40, '2021-08-16 17:34:26', '2021-08-16 17:34:26', NULL),
(334, 51, 40, '2021-08-16 17:34:26', '2021-08-16 17:34:26', NULL),
(335, 54, 40, '2021-08-16 17:34:26', '2021-08-16 17:34:26', NULL),
(336, 57, 40, '2021-08-16 17:34:26', '2021-08-16 17:34:26', NULL),
(337, 58, 40, '2021-08-16 17:34:26', '2021-08-16 17:34:26', NULL),
(338, 59, 40, '2021-08-16 17:34:26', '2021-08-16 17:34:26', NULL),
(339, 60, 40, '2021-08-16 17:34:26', '2021-08-16 17:34:26', NULL),
(340, 62, 40, '2021-08-16 17:34:26', '2021-08-16 17:34:26', NULL),
(341, 63, 40, '2021-08-16 17:34:26', '2021-08-16 17:34:26', NULL),
(342, 64, 40, '2021-08-16 17:34:26', '2021-08-16 17:34:26', NULL),
(343, 65, 40, '2021-08-16 17:34:26', '2021-08-16 17:34:26', NULL),
(344, 66, 40, '2021-08-16 17:34:26', '2021-08-16 17:34:26', NULL),
(345, 67, 40, '2021-08-16 17:34:26', '2021-08-16 17:34:26', NULL),
(346, 68, 40, '2021-08-16 17:34:26', '2021-08-16 17:34:26', NULL),
(347, 50, 10, '2021-08-16 17:34:30', '2021-08-16 17:34:30', NULL),
(348, 51, 10, '2021-08-16 17:34:30', '2021-08-16 17:34:30', NULL),
(349, 54, 10, '2021-08-16 17:34:30', '2021-08-16 17:34:30', NULL),
(350, 57, 10, '2021-08-16 17:34:30', '2021-08-16 17:34:30', NULL),
(351, 58, 10, '2021-08-16 17:34:30', '2021-08-16 17:34:30', NULL),
(352, 59, 10, '2021-08-16 17:34:30', '2021-08-16 17:34:30', NULL),
(353, 60, 10, '2021-08-16 17:34:30', '2021-08-16 17:34:30', NULL),
(354, 62, 10, '2021-08-16 17:34:30', '2021-08-16 17:34:30', NULL),
(355, 63, 10, '2021-08-16 17:34:30', '2021-08-16 17:34:30', NULL),
(356, 64, 10, '2021-08-16 17:34:30', '2021-08-16 17:34:30', NULL),
(357, 65, 10, '2021-08-16 17:34:30', '2021-08-16 17:34:30', NULL),
(358, 66, 10, '2021-08-16 17:34:30', '2021-08-16 17:34:30', NULL),
(359, 67, 10, '2021-08-16 17:34:30', '2021-08-16 17:34:30', NULL),
(360, 68, 10, '2021-08-16 17:34:30', '2021-08-16 17:34:30', NULL),
(361, 50, 7, '2021-08-16 17:34:34', '2021-08-16 17:34:34', NULL),
(362, 51, 7, '2021-08-16 17:34:34', '2021-08-16 17:34:34', NULL),
(363, 54, 7, '2021-08-16 17:34:34', '2021-08-16 17:34:34', NULL),
(364, 57, 7, '2021-08-16 17:34:34', '2021-08-16 17:34:34', NULL),
(365, 58, 7, '2021-08-16 17:34:34', '2021-08-16 17:34:34', NULL),
(366, 59, 7, '2021-08-16 17:34:34', '2021-08-16 17:34:34', NULL),
(367, 60, 7, '2021-08-16 17:34:34', '2021-08-16 17:34:34', NULL),
(368, 62, 7, '2021-08-16 17:34:34', '2021-08-16 17:34:34', NULL),
(369, 63, 7, '2021-08-16 17:34:34', '2021-08-16 17:34:34', NULL),
(370, 64, 7, '2021-08-16 17:34:34', '2021-08-16 17:34:34', NULL),
(371, 65, 7, '2021-08-16 17:34:34', '2021-08-16 17:34:34', NULL),
(372, 66, 7, '2021-08-16 17:34:34', '2021-08-16 17:34:34', NULL),
(373, 67, 7, '2021-08-16 17:34:34', '2021-08-16 17:34:34', NULL),
(374, 68, 7, '2021-08-16 17:34:34', '2021-08-16 17:34:34', NULL),
(375, 67, 43, '2021-08-16 19:08:24', '2021-08-16 19:08:24', NULL),
(376, 61, 43, '2021-08-16 19:08:24', '2021-08-16 19:08:24', NULL),
(377, 46, 41, '2021-08-22 11:45:37', '2021-08-22 11:45:37', '2021-08-22 12:05:00'),
(378, 47, 41, '2021-08-22 11:45:37', '2021-08-22 11:45:37', '2021-08-22 12:05:00'),
(379, 34, 41, '2021-08-22 12:05:52', '2021-08-22 12:05:52', NULL),
(393, 50, 44, '2021-08-27 19:49:28', '2021-08-27 19:49:28', NULL),
(394, 51, 44, '2021-08-27 19:49:28', '2021-08-27 19:49:28', NULL),
(395, 54, 44, '2021-08-27 19:49:28', '2021-08-27 19:49:28', NULL),
(396, 57, 44, '2021-08-27 19:49:28', '2021-08-27 19:49:28', NULL),
(397, 58, 44, '2021-08-27 19:49:28', '2021-08-27 19:49:28', NULL),
(398, 59, 44, '2021-08-27 19:49:28', '2021-08-27 19:49:28', NULL),
(399, 60, 44, '2021-08-27 19:49:28', '2021-08-27 19:49:28', NULL),
(400, 62, 44, '2021-08-27 19:49:28', '2021-08-27 19:49:28', NULL),
(401, 64, 44, '2021-08-27 19:49:28', '2021-08-27 19:49:28', NULL),
(402, 65, 44, '2021-08-27 19:49:28', '2021-08-27 19:49:28', NULL),
(403, 66, 44, '2021-08-27 19:49:28', '2021-08-27 19:49:28', NULL),
(404, 67, 44, '2021-08-27 19:49:28', '2021-08-27 19:49:28', NULL),
(405, 68, 44, '2021-08-27 19:49:28', '2021-08-27 19:49:28', NULL),
(406, 67, 45, '2021-08-27 19:51:08', '2021-08-27 19:51:08', NULL),
(407, 61, 45, '2021-08-27 19:51:08', '2021-08-27 19:51:08', NULL),
(408, 67, 46, '2021-08-29 08:17:44', '2021-08-29 08:17:44', NULL),
(409, 61, 46, '2021-08-29 08:17:44', '2021-08-29 08:17:44', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tblcanje_oferta`
--
ALTER TABLE `tblcanje_oferta`
  ADD PRIMARY KEY (`id_canje_oferta`);

--
-- Indices de la tabla `tblcliente`
--
ALTER TABLE `tblcliente`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indices de la tabla `tblcompra_detalle`
--
ALTER TABLE `tblcompra_detalle`
  ADD PRIMARY KEY (`id_compra_detalle`);

--
-- Indices de la tabla `tblcompra_especifica`
--
ALTER TABLE `tblcompra_especifica`
  ADD PRIMARY KEY (`id_compra_especifica`);

--
-- Indices de la tabla `tblcompra_general`
--
ALTER TABLE `tblcompra_general`
  ADD PRIMARY KEY (`id_compra_general`);

--
-- Indices de la tabla `tbldepartamento`
--
ALTER TABLE `tbldepartamento`
  ADD PRIMARY KEY (`id_departamento`);

--
-- Indices de la tabla `tbldependiente`
--
ALTER TABLE `tbldependiente`
  ADD PRIMARY KEY (`id_dependiente`);

--
-- Indices de la tabla `tbldocente`
--
ALTER TABLE `tbldocente`
  ADD PRIMARY KEY (`id_docente`);

--
-- Indices de la tabla `tblempleado`
--
ALTER TABLE `tblempleado`
  ADD PRIMARY KEY (`id_empleado`);

--
-- Indices de la tabla `tblempresa`
--
ALTER TABLE `tblempresa`
  ADD PRIMARY KEY (`id_empresa`);

--
-- Indices de la tabla `tblempresa_ofertante`
--
ALTER TABLE `tblempresa_ofertante`
  ADD PRIMARY KEY (`id_empresa`);

--
-- Indices de la tabla `tblhistorial_justificaciones`
--
ALTER TABLE `tblhistorial_justificaciones`
  ADD PRIMARY KEY (`id_historial`);

--
-- Indices de la tabla `tblmenu`
--
ALTER TABLE `tblmenu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indices de la tabla `tblmodulo`
--
ALTER TABLE `tblmodulo`
  ADD PRIMARY KEY (`id_modulo`);

--
-- Indices de la tabla `tblmunicipio`
--
ALTER TABLE `tblmunicipio`
  ADD PRIMARY KEY (`id_municipio`);

--
-- Indices de la tabla `tbloferta`
--
ALTER TABLE `tbloferta`
  ADD PRIMARY KEY (`id_oferta`);

--
-- Indices de la tabla `tblpais`
--
ALTER TABLE `tblpais`
  ADD PRIMARY KEY (`id_pais`);

--
-- Indices de la tabla `tblrubro`
--
ALTER TABLE `tblrubro`
  ADD PRIMARY KEY (`id_rubro`);

--
-- Indices de la tabla `tblsexo`
--
ALTER TABLE `tblsexo`
  ADD PRIMARY KEY (`id_sexo`);

--
-- Indices de la tabla `tbltipo_usuario`
--
ALTER TABLE `tbltipo_usuario`
  ADD PRIMARY KEY (`id_tipo_usuario`);

--
-- Indices de la tabla `tblusuario`
--
ALTER TABLE `tblusuario`
  ADD PRIMARY KEY (`id_usuario`);

--
-- Indices de la tabla `tblusuario_modulo`
--
ALTER TABLE `tblusuario_modulo`
  ADD PRIMARY KEY (`id_modulo_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tblcanje_oferta`
--
ALTER TABLE `tblcanje_oferta`
  MODIFY `id_canje_oferta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tblcliente`
--
ALTER TABLE `tblcliente`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tblcompra_detalle`
--
ALTER TABLE `tblcompra_detalle`
  MODIFY `id_compra_detalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tblcompra_especifica`
--
ALTER TABLE `tblcompra_especifica`
  MODIFY `id_compra_especifica` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tblcompra_general`
--
ALTER TABLE `tblcompra_general`
  MODIFY `id_compra_general` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbldepartamento`
--
ALTER TABLE `tbldepartamento`
  MODIFY `id_departamento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `tbldependiente`
--
ALTER TABLE `tbldependiente`
  MODIFY `id_dependiente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `tbldocente`
--
ALTER TABLE `tbldocente`
  MODIFY `id_docente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `tblempleado`
--
ALTER TABLE `tblempleado`
  MODIFY `id_empleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `tblempresa`
--
ALTER TABLE `tblempresa`
  MODIFY `id_empresa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tblempresa_ofertante`
--
ALTER TABLE `tblempresa_ofertante`
  MODIFY `id_empresa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `tblhistorial_justificaciones`
--
ALTER TABLE `tblhistorial_justificaciones`
  MODIFY `id_historial` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tblmenu`
--
ALTER TABLE `tblmenu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `tblmodulo`
--
ALTER TABLE `tblmodulo`
  MODIFY `id_modulo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT de la tabla `tblmunicipio`
--
ALTER TABLE `tblmunicipio`
  MODIFY `id_municipio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=263;

--
-- AUTO_INCREMENT de la tabla `tbloferta`
--
ALTER TABLE `tbloferta`
  MODIFY `id_oferta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tblpais`
--
ALTER TABLE `tblpais`
  MODIFY `id_pais` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tblrubro`
--
ALTER TABLE `tblrubro`
  MODIFY `id_rubro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tblsexo`
--
ALTER TABLE `tblsexo`
  MODIFY `id_sexo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tbltipo_usuario`
--
ALTER TABLE `tbltipo_usuario`
  MODIFY `id_tipo_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tblusuario`
--
ALTER TABLE `tblusuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT de la tabla `tblusuario_modulo`
--
ALTER TABLE `tblusuario_modulo`
  MODIFY `id_modulo_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=410;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
