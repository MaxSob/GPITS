-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 17-01-2018 a las 15:47:55
-- Versión del servidor: 5.5.58-0ubuntu0.14.04.1
-- Versión de PHP: 5.5.9-1ubuntu4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `mits`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `interactions`
--

CREATE TABLE IF NOT EXISTS `interactions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user` varchar(45) DEFAULT NULL,
  `query` text,
  `response` text,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=115 ;

--
-- Volcado de datos para la tabla `interactions`
--

INSERT INTO `interactions` (`id`, `user`, `query`, `response`, `date`) VALUES
(84, '4', 'Â¿como se hace un ADA?conversation', 'Â¿Puedes reformular la pregunta?', '2018-01-16 12:03:35'),
(87, '4', 'Â¿QuÃ© elementos tiene un ADA?', '\nLas actividades de aprendizaje se componen de los siguientes elementos:\n|parse|<br />\nForma de trabajo: en equipo, de manera individual, en binas o en trÃ­os, por citar algunas formas.\n|parse|<br />\nAcciÃ³n: mediante el uso de verbos activos escritos en infinitivo, por ejemplo, describir, elaborar.\n|parse|<br />\nProducto: es la evidencia del trabajo que el estudiante realiza en funciÃ³n de la(s) estrategia(s) de enseÃ±anza y aprendizaje seleccionada(s) por el profesor\n|parse|<br />\nContenido: referente al desagregado de contenidos planteados en las unidades de la secuencia didÃ¡ctica.\n', '2018-01-16 12:06:15'),
(88, '4', 'Â¿QUE ELEMENTOS DEBE CONTENER UN ADA?', '\nLas actividades de aprendizaje son las acciones concretas que realizarÃ¡ el estudiante para lograr el resultado de aprendizaje y que en conjunto con otras conducirÃ¡n al desarrollo de las competencias de al asignatura\n', '2018-01-16 12:08:24'),
(94, '4', 'Â¿QUE ELEMENTOS DEBE CONTENER UN ?', '\nLas actividades de aprendizaje se componen de los siguientes elementos:\n|parse|<br />\nForma de trabajo: en equipo, de manera individual, en binas o en trÃ­os, por citar algunas formas.\n|parse|<br />\nAcciÃ³n: mediante el uso de verbos activos escritos en infinitivo, por ejemplo, describir, elaborar.\n|parse|<br />\nProducto: es la evidencia del trabajo que el estudiante realiza en funciÃ³n de la(s) estrategia(s) de enseÃ±anza y aprendizaje seleccionada(s) por el profesor\n|parse|<br />\nContenido: referente al desagregado de contenidos planteados en las unidades de la secuencia didÃ¡ctica.\n', '2018-01-16 12:12:03'),
(97, '4', 'Â¿QUE ELEMENETOS CONTIENE UN ADA?', '\nLas actividades de aprendizaje son las acciones concretas que realizarÃ¡ el estudiante para lograr el resultado de aprendizaje y que en conjunto con otras conducirÃ¡n al desarrollo de las competencias de al asignatura\n', '2018-01-16 12:15:37'),
(108, '4', 'Â¿COMO CONFIGURO UNA ENTREGA DE LA TAREA?', '\n El mÃ³dulo de actividad tarea le permite al maestro comunicar quehaceres, recolectar los trabajos y proporcionar calificaciones y retroalimentaciÃ³n.\n', '2018-01-16 12:22:50'),
(113, '4', 'Â¿COMO CONFIGURO EL TIPO DE ENVIO?', '\nLa tarea tiene dos tipos de envÃ­o:\nTexto en lÃ­nea:\nSi se habilita, los estudiantes pueden escribir texto enriquecido directamente en un campo editor (de Moodle) para su envÃ­o.\nEnvÃ­os de archivo:\nSi se habilita, los estudiantes pueden subir uno o mÃ¡s archivos a modo de envÃ­o.\n', '2018-01-16 12:29:39'),
(114, '4', 'Â¿COMO SE CONFIGURA LA ENTREGA POR GRUPO?', '\nSi se habilita, los estudiantes serÃ¡n divididos en grupos basados en el conjunto de grupos por defecto o un agrupamiento a la medida. Un envÃ­o en grupo estarÃ¡ compartido entre los miembros del grupo y todos los miembros del grupo verÃ¡n los cambios de todos ellos al envÃ­o.\n', '2018-01-16 12:30:49');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
