-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-11-2024 a las 01:01:09
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `proyecto`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `categoria_id` int(10) UNSIGNED NOT NULL,
  `descripción` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`categoria_id`, `descripción`) VALUES
(1, 'Administrador'),
(2, 'Suscriptor');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`, `descripcion`) VALUES
(1, 'SUPLEMENTOS', 'SUPLEMENTOS DE GIMNASIO'),
(2, 'APARATOS', 'APARATOS DE GIMNASIO'),
(3, 'ACCESORIOS', 'ACCESORIOS DE ENTRENAMIENTO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clases`
--

CREATE TABLE `clases` (
  `clase_id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `horario` time NOT NULL,
  `imagen_url` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clases`
--

INSERT INTO `clases` (`clase_id`, `nombre`, `horario`, `imagen_url`) VALUES
(49, 'NATACION', '08:00:00', '../static/uploads/clases/1732837838_natacion.jpg'),
(53, 'BOXEO', '10:00:00', '../static/uploads/clases/1732837875_uploadse-portada-boxeadora.jpg'),
(54, 'YOGA', '13:00:00', '../static/uploads/clases/yoga-7140566_640.jpg'),
(55, 'SPINNING', '16:00:00', '../static/uploads/clases/Diseno-sin-titulo-30.jpg'),
(56, 'TAEKWONDO', '18:00:00', '../static/uploads/clases/taekwondo-3.jpg'),
(57, 'CROSSFIT', '20:00:00', '../static/uploads/clases/cross.jpg'),
(58, 'ZUMBA', '21:00:00', '../static/uploads/clases/zumba.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contactos`
--

CREATE TABLE `contactos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `msj` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `contactos`
--

INSERT INTO `contactos` (`id`, `nombre`, `email`, `msj`) VALUES
(1, 'Candela', 'candela@gmail.com', 'Probando  '),
(2, 'Pedro', 'pedro@gmail.com', 'Probando 2   '),
(3, 'agus', 'alanosa@gmail.com', 'probando');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `precio` decimal(10,2) NOT NULL,
  `categoria_id` int(11) DEFAULT NULL,
  `stock` int(11) DEFAULT 0,
  `fecha_agregado` timestamp NOT NULL DEFAULT current_timestamp(),
  `imagen_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `descripcion`, `precio`, `categoria_id`, `stock`, `fecha_agregado`, `imagen_url`) VALUES
(16, 'Pelota de Peso', '6kg \r\nDiámetro: 35cm\r\nCosturas reforzadas', 50000.00, 3, 100, '2024-11-28 23:32:09', '../static/uploadspelotaPeso.jpg'),
(17, 'Pesa Rusa', 'Kettlebell DeporAr\r\n12 kg\r\nMaterial PVC', 45000.00, 3, 250, '2024-11-28 23:36:07', '../static/uploadskettleBell.jpg'),
(18, 'Pesas Tobilleras', 'Energy Fit\r\n4kg \r\nRegulable al talle', 6371.00, 3, 80, '2024-11-28 23:38:39', '../static/uploadstobilleras.jpg'),
(19, 'Soga de Salto', 'Speed Rope PVC\r\nMedida 2.90 mts\r\nLargo 14 cm', 5000.00, 3, 20, '2024-11-28 23:39:51', '../static/uploadssoga.jpg'),
(20, 'Colchoneta', 'Follow Fit\r\nMedidas: 100x50x4', 30599.00, 3, 55, '2024-11-28 23:40:35', '../static/uploadscolchonetas.jpg'),
(21, 'Creatina', 'Star Nutrition\r\nSin sabor, no trae Scoop\r\n5 gr de creatina pura', 24974.00, 1, 150, '2024-11-28 23:41:32', '../static/uploadscreatina.jpg'),
(22, 'Barras Integrales', 'Integra\r\nAlto en fibra y proteina, 100% naturales', 2500.00, 1, 500, '2024-11-28 23:43:13', '../static/uploadsbarrasIntegra.jpg'),
(23, 'Botellas Deportivas', 'Conserva la temperatura\r\nCapacidad 750ml', 24974.00, 3, 60, '2024-11-28 23:44:06', '../static/uploadsbotellas.jpg'),
(24, 'Calleras', 'Talle unico\r\nLargo de tira: 30cm\r\nLargo de base: 19cm', 15000.00, 3, 10, '2024-11-28 23:45:02', '../static/uploadscalleras.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas`
--

CREATE TABLE `reservas` (
  `usuario_id` int(11) NOT NULL,
  `clase_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `reservas`
--

INSERT INTO `reservas` (`usuario_id`, `clase_id`) VALUES
(2, 2),
(2, 3),
(3, 3),
(0, 1),
(0, 4),
(6, 2),
(6, 45),
(11, 45),
(6, 52);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `usuario_id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `apellido` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `usuario` varchar(20) NOT NULL,
  `contrasenia` varchar(200) NOT NULL,
  `categoria_id` int(11) NOT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  `es_premium` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`usuario_id`, `nombre`, `apellido`, `email`, `usuario`, `contrasenia`, `categoria_id`, `fecha_inicio`, `fecha_fin`, `es_premium`) VALUES
(6, 'Lucas', 'Gordillo', 'gordillolucas26@yaho', 'Lucas666', '$2y$10$.JR000skpRFMgYOueF9M3eMehq3jUHiJ6kvJEIV/ppxzGsyrk6TXm', 1, '2024-11-14', '2024-12-14', 1),
(11, 'micaela', 'Lanosa', 'lanosa@gmail.com', 'Agus666', '$2y$10$TJWi60yQ843uKCfCOTmSCuJMXyP/K/fV9yk9hKmAIA2TI0cDgdl8u', 2, '2024-11-28', '2024-12-28', 1),
(12, 'Pedro', 'Lanosa', 'pedro@gmail.com', 'pedro', '$2y$10$OSLzTXFo5zGGKmMcsT4z7OwWmP7dIp4.RCVflB.wE3q7jcsHlI7r6', 2, '2024-11-28', '2024-12-28', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`categoria_id`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `clases`
--
ALTER TABLE `clases`
  ADD PRIMARY KEY (`clase_id`);

--
-- Indices de la tabla `contactos`
--
ALTER TABLE `contactos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categoria_id` (`categoria_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`usuario_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `categoria_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `clases`
--
ALTER TABLE `clases`
  MODIFY `clase_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT de la tabla `contactos`
--
ALTER TABLE `contactos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `usuario_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
