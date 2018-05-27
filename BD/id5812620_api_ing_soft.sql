-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 27-05-2018 a las 03:13:38
-- Versión del servidor: 10.1.31-MariaDB
-- Versión de PHP: 7.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `id5812620_api_ing_soft`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos`
--

CREATE TABLE `alumnos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `edad` date NOT NULL,
  `telefono` int(11) NOT NULL,
  `direccion` varchar(80) NOT NULL,
  `carne` text,
  `grado` text,
  `genero` varchar(6) NOT NULL,
  `es_favorito` tinyint(1) NOT NULL DEFAULT '1',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `carrera` varchar(200) NOT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `alumnos`
--

INSERT INTO `alumnos` (`id`, `nombre`, `apellido`, `edad`, `telefono`, `direccion`, `carne`, `grado`, `genero`, `es_favorito`, `is_active`, `carrera`, `created_at`) VALUES
(4, 'juanito', 'g', '2018-06-23', 53533453, 'san marcos', '43', 'quinto', 'mascul', 1, 2, 'compu', '2018-05-23 00:00:00'),
(30, 'Luis Eduardo', 'De leon', '2000-03-09', 1234123, 'Quetzaltenango', '09032265', 'Cuarto', 'Hombre', 1, 1, 'EducaciÃ³n', '2018-04-24 10:13:27'),
(31, 'Jose', 'Miranda', '2000-09-21', 123123123, 'San Marcos', '0903131888', 'Cuarto', 'Hombre', 1, 1, 'ComputaciÃ³n', '2018-04-24 11:54:38'),
(32, 'jorge', 'fuentes', '2018-05-20', 77608985, 'san marcos', '0903-14-2345', 'quinto', 'mascul', 1, 1, 'compu', '2018-04-24 00:00:00'),
(50, 'evelyn', 'tebalan', '0000-00-00', 66, 'san marcos', '6', 'sexto', 'mujer', 1, 1, 'compu', '0000-00-00 00:00:00'),
(60, 'evelyn', 'tebalan', '0000-00-00', 66, 'san marcos', '6', 'sexto', 'mujer', 1, 1, 'compu', '0000-00-00 00:00:00'),
(61, 'evelyn', 'tebalan', '2018-04-22', 66, 'san marcos', '6', 'sexto', 'mujer', 1, 1, 'compu', '2018-05-22 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignaciones`
--

CREATE TABLE `asignaciones` (
  `idAsig` int(11) NOT NULL,
  `idEmpleado` int(11) NOT NULL,
  `idEstudiante` int(11) NOT NULL,
  `estado` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `asignaciones`
--

INSERT INTO `asignaciones` (`idAsig`, `idEmpleado`, `idEstudiante`, `estado`) VALUES
(1, 1, 1, 'aceptada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carreras`
--

CREATE TABLE `carreras` (
  `idCarrera` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `carreras`
--

INSERT INTO `carreras` (`idCarrera`, `nombre`) VALUES
(1, 'computacion'),
(2, 'educacion'),
(3, 'mecanica'),
(4, 'parvulario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuarto_compu`
--

CREATE TABLE `cuarto_compu` (
  `idCuarto_compu` int(11) NOT NULL,
  `compu_aplicada` int(11) NOT NULL,
  `sistemas_software` int(11) NOT NULL,
  `lab_I` int(11) NOT NULL,
  `expresion_art` int(11) NOT NULL,
  `idEst` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cuarto_compu`
--

INSERT INTO `cuarto_compu` (`idCuarto_compu`, `compu_aplicada`, `sistemas_software`, `lab_I`, `expresion_art`, `idEst`) VALUES
(1, 43, 45, 76, 54, 1),
(2, 56, 0, 34, 76, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuarto_comun`
--

CREATE TABLE `cuarto_comun` (
  `idCuarto_comun` int(11) NOT NULL,
  `mate` int(11) NOT NULL,
  `lenguaje_literatura` int(11) NOT NULL,
  `ingles` int(11) NOT NULL,
  `fisica_fun` int(11) NOT NULL,
  `compu_aplicada` int(11) NOT NULL,
  `edu_fisica` int(11) NOT NULL,
  `conta` int(11) NOT NULL,
  `filosofia` int(11) NOT NULL,
  `tics` int(11) NOT NULL,
  `idEst` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cuarto_comun`
--

INSERT INTO `cuarto_comun` (`idCuarto_comun`, `mate`, `lenguaje_literatura`, `ingles`, `fisica_fun`, `compu_aplicada`, `edu_fisica`, `conta`, `filosofia`, `tics`, `idEst`) VALUES
(1, 46, 65, 76, 87, 56, 45, 76, 45, 46, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuarto_educacion`
--

CREATE TABLE `cuarto_educacion` (
  `idCuarto_edu` int(11) NOT NULL,
  `produc_des` int(11) NOT NULL,
  `elab_proyecto` int(11) NOT NULL,
  `psicologia` int(11) NOT NULL,
  `mam` int(11) NOT NULL,
  `funda_pedagogia` int(11) NOT NULL,
  `estrategia_aprendizaje` int(11) NOT NULL,
  `idEst` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cuarto_educacion`
--

INSERT INTO `cuarto_educacion` (`idCuarto_edu`, `produc_des`, `elab_proyecto`, `psicologia`, `mam`, `funda_pedagogia`, `estrategia_aprendizaje`, `idEst`) VALUES
(1, 45, 65, 76, 56, 56, 76, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuarto_mecanica`
--

CREATE TABLE `cuarto_mecanica` (
  `idCuarto_mecanica` int(11) NOT NULL,
  `metal_I` int(11) NOT NULL,
  `proceso_soldadura` int(11) NOT NULL,
  `mant_auto` int(11) NOT NULL,
  `higiene_trab` int(11) NOT NULL,
  `admin_mant` int(11) NOT NULL,
  `idEst` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cuarto_mecanica`
--

INSERT INTO `cuarto_mecanica` (`idCuarto_mecanica`, `metal_I`, `proceso_soldadura`, `mant_auto`, `higiene_trab`, `admin_mant`, `idEst`) VALUES
(1, 56, 56, 65, 45, 76, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuarto_parvulario`
--

CREATE TABLE `cuarto_parvulario` (
  `idCuarto_parvu` int(11) NOT NULL,
  `literatura_hispa` int(11) NOT NULL,
  `len_infantil` int(11) NOT NULL,
  `estudio_economico` int(11) NOT NULL,
  `psicologia` int(11) NOT NULL,
  `pedag_general` int(11) NOT NULL,
  `didactica_general` int(11) NOT NULL,
  `his_educacion` int(11) NOT NULL,
  `form_musical` int(11) NOT NULL,
  `intro_danza` int(11) NOT NULL,
  `idEst` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cuarto_parvulario`
--

INSERT INTO `cuarto_parvulario` (`idCuarto_parvu`, `literatura_hispa`, `len_infantil`, `estudio_economico`, `psicologia`, `pedag_general`, `didactica_general`, `his_educacion`, `form_musical`, `intro_danza`, `idEst`) VALUES
(1, 45, 45, 46, 76, 45, 67, 47, 34, 75, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docentes`
--

CREATE TABLE `docentes` (
  `id` int(11) NOT NULL,
  `no` varchar(45) DEFAULT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `apellido` varchar(50) DEFAULT NULL,
  `genero` varchar(3) DEFAULT NULL,
  `fecha_de_nac` date DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `telefono` varchar(45) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `category_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `docentes`
--

INSERT INTO `docentes` (`id`, `no`, `nombre`, `apellido`, `genero`, `fecha_de_nac`, `email`, `direccion`, `telefono`, `is_active`, `category_id`, `created_at`) VALUES
(2, NULL, 'Adan', 'Barrios', NULL, NULL, 'adan@gmail.com', 'Xela', '32329382938', 1, 1, '2017-11-03 01:07:29'),
(3, NULL, 'Gladys', 'Rivera', NULL, NULL, 'gr@gmail.com', 'San Pedro', '9328293829', 1, NULL, '2017-11-03 01:08:34'),
(4, NULL, 'Roberto', 'Castillo', NULL, NULL, 'roberCast@gmail.com', 'San Marcos', '58547894', 1, 1, '2017-11-03 13:17:54'),
(10, '', 'Juancho', 'Perez', '', '0000-00-00', 'perz@gmail.com', 'xela', '113245', 1, 1, '2018-09-10 00:00:00'),
(20, '', 'Juan', 'Perez', 'hom', '1980-09-10', 'perz@gmail.com', 'xela', '113245', 1, 1, '2018-09-10 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `idEmpleado` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `apellido` varchar(255) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `telefono` varchar(255) NOT NULL,
  `correo` varchar(255) NOT NULL,
  `idRol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`idEmpleado`, `nombre`, `apellido`, `direccion`, `telefono`, `correo`, `idRol`) VALUES
(1, 'Juan', 'Perez', 'san marcos', '7760-4534', '', 2),
(3, 'pedro', 'gomez', 'san marcos', '7760-4535', '', 2),
(4, 'tony', 'juarez', 'san marcos', '7760-4535', '', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudiantes`
--

CREATE TABLE `estudiantes` (
  `idEstudiante` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `apellido` varchar(255) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `telefono` varchar(255) NOT NULL,
  `grado` varchar(50) NOT NULL,
  `clave` int(11) NOT NULL,
  `idCarrera` int(20) NOT NULL,
  `idNota` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `estudiantes`
--

INSERT INTO `estudiantes` (`idEstudiante`, `nombre`, `apellido`, `direccion`, `telefono`, `grado`, `clave`, `idCarrera`, `idNota`) VALUES
(1, 'pe', 'gomez', 'san pedro sac.', '7760-3485', 'cuarto', 3, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notas`
--

CREATE TABLE `notas` (
  `idNota` int(11) NOT NULL,
  `unidad_I` int(11) NOT NULL,
  `unidad_II` int(11) NOT NULL,
  `unidad_III` int(11) NOT NULL,
  `final` int(11) NOT NULL,
  `idEst` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `notas`
--

INSERT INTO `notas` (`idNota`, `unidad_I`, `unidad_II`, `unidad_III`, `final`, `idEst`) VALUES
(1, 45, 54, 46, 57, 2),
(2, 45, 65, 76, 67, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `publicaciones`
--

CREATE TABLE `publicaciones` (
  `id` int(11) NOT NULL,
  `asunto` varchar(100) DEFAULT NULL,
  `descripcion` text,
  `mensaje` text,
  `dia` varchar(45) DEFAULT NULL,
  `hora` varchar(45) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `is_web` tinyint(1) DEFAULT NULL,
  `publica` int(11) NOT NULL,
  `payment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `pacient_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `publicaciones`
--

INSERT INTO `publicaciones` (`id`, `asunto`, `descripcion`, `mensaje`, `dia`, `hora`, `created_at`, `is_web`, `publica`, `payment_id`, `user_id`, `pacient_id`, `status_id`) VALUES
(17, 'nueva tarea', 'tarea para entregar ', NULL, '2018-04-27', '01:00', '2018-04-23 15:18:33', NULL, 2, 1, 12, 0, 3),
(18, 'Entrega Proyecto', 'Entrega Final de Proyecto', NULL, '2018-04-30', '14:00', '2018-04-24 10:22:42', NULL, 4, 1, 12, 0, 1),
(19, 'publicaciones', 'Junta de maestros ', NULL, '2018-04-27', '10:00', '2018-04-24 11:51:43', NULL, 4, 1, 12, 0, 1),
(20, 'Feria de san marcos\"\"\"', 'sadadasd\"', NULL, '2018-04-25', '01:00', '2018-04-24 12:00:13', NULL, 4, 2, 12, 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `quinto_compu`
--

CREATE TABLE `quinto_compu` (
  `idQuinto_compu` int(11) NOT NULL,
  `etica_pro` int(11) NOT NULL,
  `rep_tecnico` int(11) NOT NULL,
  `produ_digitales` int(11) NOT NULL,
  `lab_II` int(11) NOT NULL,
  `idEst` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `quinto_compu`
--

INSERT INTO `quinto_compu` (`idQuinto_compu`, `etica_pro`, `rep_tecnico`, `produ_digitales`, `lab_II`, `idEst`) VALUES
(1, 45, 65, 45, 56, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `quinto_comun`
--

CREATE TABLE `quinto_comun` (
  `idQuinto_comun` int(11) NOT NULL,
  `mate` int(11) NOT NULL,
  `lenguaje_literatura` int(11) NOT NULL,
  `ingles` int(11) NOT NULL,
  `csfc` int(11) NOT NULL,
  `estadistica` int(11) NOT NULL,
  `biologia` int(11) NOT NULL,
  `quimica` int(11) NOT NULL,
  `seminario` int(11) NOT NULL,
  `expresion_art` int(11) NOT NULL,
  `idEstudiante` int(11) NOT NULL,
  `idEst` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `quinto_comun`
--

INSERT INTO `quinto_comun` (`idQuinto_comun`, `mate`, `lenguaje_literatura`, `ingles`, `csfc`, `estadistica`, `biologia`, `quimica`, `seminario`, `expresion_art`, `idEstudiante`, `idEst`) VALUES
(1, 35, 56, 56, 43, 76, 35, 56, 67, 46, 45, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `quinto_educacion`
--

CREATE TABLE `quinto_educacion` (
  `idQuinto_edu` int(11) NOT NULL,
  `mam` int(11) NOT NULL,
  `tics` int(11) NOT NULL,
  `ciencia_tec` int(11) NOT NULL,
  `psico_evolutiva` int(11) NOT NULL,
  `iden_docente` int(11) NOT NULL,
  `paradigmas_edu` int(11) NOT NULL,
  `idEst` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `quinto_educacion`
--

INSERT INTO `quinto_educacion` (`idQuinto_edu`, `mam`, `tics`, `ciencia_tec`, `psico_evolutiva`, `iden_docente`, `paradigmas_edu`, `idEst`) VALUES
(1, 34, 45, 56, 67, 56, 57, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `quinto_mecanica`
--

CREATE TABLE `quinto_mecanica` (
  `idQuinto_mecanica` int(11) NOT NULL,
  `tics` int(11) NOT NULL,
  `metal_II` int(11) NOT NULL,
  `motores_gasolina` int(11) NOT NULL,
  `tec_metalmec` int(11) NOT NULL,
  `idEst` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `quinto_mecanica`
--

INSERT INTO `quinto_mecanica` (`idQuinto_mecanica`, `tics`, `metal_II`, `motores_gasolina`, `tec_metalmec`, `idEst`) VALUES
(1, 46, 56, 67, 45, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `quinto_parvulario`
--

CREATE TABLE `quinto_parvulario` (
  `idQuinto_parvu` int(11) NOT NULL,
  `pre_lectura` int(11) NOT NULL,
  `legis_escolar` int(11) NOT NULL,
  `psico_nineo` int(11) NOT NULL,
  `estadistica` int(11) NOT NULL,
  `didactica_parvu` int(11) NOT NULL,
  `moral_pro` int(11) NOT NULL,
  `elab_didactico` int(11) NOT NULL,
  `manualidades_infantiles` int(11) NOT NULL,
  `for_musical` int(11) NOT NULL,
  `art_plasticas` int(11) NOT NULL,
  `evalu_escolar` int(11) NOT NULL,
  `idEst` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `quinto_parvulario`
--

INSERT INTO `quinto_parvulario` (`idQuinto_parvu`, `pre_lectura`, `legis_escolar`, `psico_nineo`, `estadistica`, `didactica_parvu`, `moral_pro`, `elab_didactico`, `manualidades_infantiles`, `for_musical`, `art_plasticas`, `evalu_escolar`, `idEst`) VALUES
(1, 35, 57, 57, 78, 56, 78, 45, 34, 46, 68, 87, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `idRol` int(11) NOT NULL,
  `cargo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`idRol`, `cargo`) VALUES
(1, 'director'),
(2, 'docente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sexto_parvulario`
--

CREATE TABLE `sexto_parvulario` (
  `idSexto_parvu` int(11) NOT NULL,
  `lit_infantil` int(11) NOT NULL,
  `intro_filosofia` int(11) NOT NULL,
  `pluricultural_medicina` int(11) NOT NULL,
  `seminario_edu` int(11) NOT NULL,
  `juegos_edu` int(11) NOT NULL,
  `for_musical` int(11) NOT NULL,
  `teatro_infantil` int(11) NOT NULL,
  `prac_docente` int(11) NOT NULL,
  `idEst` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sexto_parvulario`
--

INSERT INTO `sexto_parvulario` (`idSexto_parvu`, `lit_infantil`, `intro_filosofia`, `pluricultural_medicina`, `seminario_edu`, `juegos_edu`, `for_musical`, `teatro_infantil`, `prac_docente`, `idEst`) VALUES
(1, 46, 57, 67, 56, 45, 57, 67, 56, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `name` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `lastname` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `email` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `password` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_admin` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `username`, `name`, `lastname`, `email`, `password`, `is_active`, `is_admin`, `created_at`) VALUES
(1, 'admin', 'administrador', 'administrador', 'admin@admin', '90b9aa7e25f80cf4f64e990b78a9fc5ebd6cecad', 1, 1, NULL),
(2, 'marce', 'marce', 'ochoa', 'marce@gmail.com', '90b9aa7e25f80cf4f64e990b78a9fc5ebd6cecad', 1, 1, NULL),
(3, 'admin2', 'admin2', 'administrator', 'admin24', 'e4df782e9185732c1bb3efcf052a21d4c11c605f', 1, 1, '2017-11-01 00:00:00'),
(10, 'mynor', 'Mynor Rene', 'Berduo', 'mynor@gmail.com', 'adcd7048512e64b48da55b027577886ee5a36350', 1, 1, '2017-11-01 13:35:28'),
(11, 'adonias', 'Adonias Antonio', 'Antonio', 'adonias@gmail.com', 'adcd7048512e64b48da55b027577886ee5a36350', 1, 1, '2017-11-01 13:36:18');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `asignaciones`
--
ALTER TABLE `asignaciones`
  ADD PRIMARY KEY (`idAsig`);

--
-- Indices de la tabla `carreras`
--
ALTER TABLE `carreras`
  ADD PRIMARY KEY (`idCarrera`);

--
-- Indices de la tabla `cuarto_compu`
--
ALTER TABLE `cuarto_compu`
  ADD PRIMARY KEY (`idCuarto_compu`);

--
-- Indices de la tabla `cuarto_comun`
--
ALTER TABLE `cuarto_comun`
  ADD PRIMARY KEY (`idCuarto_comun`);

--
-- Indices de la tabla `cuarto_educacion`
--
ALTER TABLE `cuarto_educacion`
  ADD PRIMARY KEY (`idCuarto_edu`);

--
-- Indices de la tabla `cuarto_mecanica`
--
ALTER TABLE `cuarto_mecanica`
  ADD PRIMARY KEY (`idCuarto_mecanica`);

--
-- Indices de la tabla `cuarto_parvulario`
--
ALTER TABLE `cuarto_parvulario`
  ADD PRIMARY KEY (`idCuarto_parvu`);

--
-- Indices de la tabla `docentes`
--
ALTER TABLE `docentes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_medico_categoria1_idx` (`category_id`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`idEmpleado`),
  ADD KEY `idRol` (`idRol`);

--
-- Indices de la tabla `estudiantes`
--
ALTER TABLE `estudiantes`
  ADD PRIMARY KEY (`idEstudiante`),
  ADD KEY `idCarrera` (`idCarrera`),
  ADD KEY `idNota` (`idNota`);

--
-- Indices de la tabla `notas`
--
ALTER TABLE `notas`
  ADD PRIMARY KEY (`idNota`);

--
-- Indices de la tabla `publicaciones`
--
ALTER TABLE `publicaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_reservacion_medico_idx` (`publica`),
  ADD KEY `fk_reservacion_pago1_idx` (`payment_id`),
  ADD KEY `fk_reservacion_usuario1_idx` (`user_id`),
  ADD KEY `fk_reservacion_paciente1_idx` (`pacient_id`),
  ADD KEY `fk_reservacion_estado1_idx` (`status_id`);

--
-- Indices de la tabla `quinto_compu`
--
ALTER TABLE `quinto_compu`
  ADD PRIMARY KEY (`idQuinto_compu`);

--
-- Indices de la tabla `quinto_comun`
--
ALTER TABLE `quinto_comun`
  ADD PRIMARY KEY (`idQuinto_comun`);

--
-- Indices de la tabla `quinto_educacion`
--
ALTER TABLE `quinto_educacion`
  ADD PRIMARY KEY (`idQuinto_edu`);

--
-- Indices de la tabla `quinto_mecanica`
--
ALTER TABLE `quinto_mecanica`
  ADD PRIMARY KEY (`idQuinto_mecanica`);

--
-- Indices de la tabla `quinto_parvulario`
--
ALTER TABLE `quinto_parvulario`
  ADD PRIMARY KEY (`idQuinto_parvu`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`idRol`);

--
-- Indices de la tabla `sexto_parvulario`
--
ALTER TABLE `sexto_parvulario`
  ADD PRIMARY KEY (`idSexto_parvu`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT de la tabla `asignaciones`
--
ALTER TABLE `asignaciones`
  MODIFY `idAsig` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `carreras`
--
ALTER TABLE `carreras`
  MODIFY `idCarrera` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `cuarto_compu`
--
ALTER TABLE `cuarto_compu`
  MODIFY `idCuarto_compu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `cuarto_comun`
--
ALTER TABLE `cuarto_comun`
  MODIFY `idCuarto_comun` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `cuarto_educacion`
--
ALTER TABLE `cuarto_educacion`
  MODIFY `idCuarto_edu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `cuarto_mecanica`
--
ALTER TABLE `cuarto_mecanica`
  MODIFY `idCuarto_mecanica` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `cuarto_parvulario`
--
ALTER TABLE `cuarto_parvulario`
  MODIFY `idCuarto_parvu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `docentes`
--
ALTER TABLE `docentes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `idEmpleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `estudiantes`
--
ALTER TABLE `estudiantes`
  MODIFY `idEstudiante` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `notas`
--
ALTER TABLE `notas`
  MODIFY `idNota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `publicaciones`
--
ALTER TABLE `publicaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `quinto_compu`
--
ALTER TABLE `quinto_compu`
  MODIFY `idQuinto_compu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `quinto_comun`
--
ALTER TABLE `quinto_comun`
  MODIFY `idQuinto_comun` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `quinto_educacion`
--
ALTER TABLE `quinto_educacion`
  MODIFY `idQuinto_edu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `quinto_mecanica`
--
ALTER TABLE `quinto_mecanica`
  MODIFY `idQuinto_mecanica` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `quinto_parvulario`
--
ALTER TABLE `quinto_parvulario`
  MODIFY `idQuinto_parvu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `idRol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `sexto_parvulario`
--
ALTER TABLE `sexto_parvulario`
  MODIFY `idSexto_parvu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD CONSTRAINT `empleados_ibfk_1` FOREIGN KEY (`idRol`) REFERENCES `roles` (`idRol`);

--
-- Filtros para la tabla `estudiantes`
--
ALTER TABLE `estudiantes`
  ADD CONSTRAINT `estudiantes_ibfk_1` FOREIGN KEY (`idCarrera`) REFERENCES `carreras` (`idCarrera`),
  ADD CONSTRAINT `estudiantes_ibfk_2` FOREIGN KEY (`idNota`) REFERENCES `notas` (`idNota`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
