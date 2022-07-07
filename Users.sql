-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 07-07-2022 a las 15:25:03
-- Versión del servidor: 5.7.31
-- Versión de PHP: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `interview_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Users`
--
-- EN ESTA BASE DE DATOS LAS CONTRASEÑAS ESTN ENCRIPTADAS en el CAMPO PASSWORD
DROP TABLE IF EXISTS `Users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(225) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fullName` varchar(225) NOT NULL,
  `createdAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatedAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `Users`
--

INSERT INTO `Users` (`id`, `user`, `password`, `fullName`, `createdAt`, `updatedAt`) VALUES
(13, 'admin', '$2y$12$bDyTBOCz7oUHBIkrMW/3n.9OwJx0ZKk.YyMVS071f29b5ff4QfCOS', 'apellidoPrueba1', '2022-07-07 10:15:14', '2022-07-07 10:15:14'),
(14, 'admin2', '$2y$12$Q/BJrxMfxNE6kXJTXq0mbOZ3ZEH5gZ9U.kRJB7vdJJ4BLrr1yn9te', 'apellidoPrueba2', '2022-07-07 10:15:52', '2022-07-07 10:15:52');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
