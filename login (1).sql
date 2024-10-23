-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-10-2024 a las 19:20:08
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `login`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE `comentarios` (
  `id` int(11) NOT NULL,
  `video_id` int(11) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `comentario` text DEFAULT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `video_id` int(11) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `correo`, `password`) VALUES
(1, 'admin@admin.com', '$2y$10$tcDmgt2S9BGS0WRvFFrNc.pO6rq4o95/4G13WAYg1I6CKr7etbhhS'),
(4, 'admin@mail.com', '$2y$10$LPvZuUHOP26ZtbIAXgBJg.23edloTj4WmdagIOB.qv7CRq0PY0Mqu'),
(5, 'root@gmail.com', '$2y$10$MfQgjdestBHdQ5D8EwuBWOUPa5mijnzXiihWaMDy9AoaAbyzKSlqO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `videos`
--

CREATE TABLE `videos` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `titulo` varchar(255) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `url_video` varchar(255) DEFAULT NULL,
  `url_miniatura` varchar(255) DEFAULT NULL,
  `fecha_subida` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `videos`
--

INSERT INTO `videos` (`id`, `id_usuario`, `titulo`, `descripcion`, `url_video`, `url_miniatura`, `fecha_subida`) VALUES
(29, NULL, 'hola que', 'asd', 'videos/videoplayback.mp4', 'miniaturas/depositphotos_274096748-stock-photo-parquet-wood-texture-dark-wooden.jpg', '2024-10-22 19:23:33'),
(30, NULL, 'Video gracioso', 'sad', 'videos/videoplayback.mp4', 'miniaturas/depositphotos_274096748-stock-photo-parquet-wood-texture-dark-wooden.jpg', '2024-10-22 19:36:12'),
(31, NULL, 'Video gracioso', 'sad', 'videos/videoplayback.mp4', 'miniaturas/depositphotos_274096748-stock-photo-parquet-wood-texture-dark-wooden.jpg', '2024-10-22 19:37:02'),
(32, NULL, 'Video gracioso', 'sad', 'videos/videoplayback.mp4', 'miniaturas/depositphotos_274096748-stock-photo-parquet-wood-texture-dark-wooden.jpg', '2024-10-22 19:37:58'),
(33, NULL, 'Video gracioso', 'sad', 'videos/videoplayback.mp4', 'miniaturas/depositphotos_274096748-stock-photo-parquet-wood-texture-dark-wooden.jpg', '2024-10-22 19:37:59'),
(34, NULL, 'Video gracioso', 'sad', 'videos/videoplayback.mp4', 'miniaturas/depositphotos_274096748-stock-photo-parquet-wood-texture-dark-wooden.jpg', '2024-10-22 19:38:21'),
(35, NULL, 'Video gracioso', 'sad', 'videos/videoplayback.mp4', 'miniaturas/depositphotos_274096748-stock-photo-parquet-wood-texture-dark-wooden.jpg', '2024-10-22 19:38:24'),
(36, NULL, 'Video gracioso', 'sad', 'videos/videoplayback.mp4', 'miniaturas/depositphotos_274096748-stock-photo-parquet-wood-texture-dark-wooden.jpg', '2024-10-22 19:39:45'),
(37, NULL, 'Video gracioso', 'sad', 'videos/videoplayback.mp4', 'miniaturas/depositphotos_274096748-stock-photo-parquet-wood-texture-dark-wooden.jpg', '2024-10-22 19:41:15'),
(38, NULL, 'Video gracioso', 'sad', 'videos/videoplayback.mp4', 'miniaturas/depositphotos_274096748-stock-photo-parquet-wood-texture-dark-wooden.jpg', '2024-10-22 19:41:41'),
(39, NULL, 'Video gracioso', 'sad', 'videos/videoplayback.mp4', 'miniaturas/depositphotos_274096748-stock-photo-parquet-wood-texture-dark-wooden.jpg', '2024-10-22 19:43:12');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `video_id` (`video_id`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `video_id` (`video_id`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `email` (`correo`);

--
-- Indices de la tabla `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `videos`
--
ALTER TABLE `videos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `comentarios_ibfk_1` FOREIGN KEY (`video_id`) REFERENCES `videos` (`id`),
  ADD CONSTRAINT `comentarios_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`video_id`) REFERENCES `videos` (`id`),
  ADD CONSTRAINT `likes_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `videos`
--
ALTER TABLE `videos`
  ADD CONSTRAINT `videos_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
