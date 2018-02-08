-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 17-01-2018 a las 15:47:21
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
(74, '3', 'Â¿quÃ© es un ada?', '\nLas actividades de aprendizaje son las acciones concretas que realizarÃ¡ el estudiante para lograr el resultado de aprendizaje y que en conjunto con otras conducirÃ¡n al desarrollo de las competencias de al asignatura\n', '2018-01-15 11:48:33'),
(75, '3', 'cuales son los elementos de un ada', '\nLas actividades de aprendizaje son las acciones concretas que realizarÃ¡ el estudiante para lograr el resultado de aprendizaje y que en conjunto con otras conducirÃ¡n al desarrollo de las competencias de al asignatura\n', '2018-01-15 11:48:55'),
(76, '3', 'cÃ³mo hago un ada?', '\nLas actividades de aprendizaje son las acciones concretas que realizarÃ¡ el estudiante para lograr el resultado de aprendizaje y que en conjunto con otras conducirÃ¡n al desarrollo de las competencias de al asignatura\n', '2018-01-15 11:49:09'),
(77, '3', 'Â¿cuales son las partes?', '\nLas actividades de aprendizaje se componen de los siguientes elementos:\n|parse|<br />\nForma de trabajo: en equipo, de manera individual, en binas o en trÃ­os, por citar algunas formas.\n|parse|<br />\nAcciÃ³n: mediante el uso de verbos activos escritos en infinitivo, por ejemplo, describir, elaborar.\n|parse|<br />\nProducto: es la evidencia del trabajo que el estudiante realiza en funciÃ³n de la(s) estrategia(s) de enseÃ±anza y aprendizaje seleccionada(s) por el profesor\n|parse|<br />\nContenido: referente al desagregado de contenidos planteados en las unidades de la secuencia didÃ¡ctica.\n', '2018-01-15 11:49:27'),
(78, '3', 'tengo hambre', '\nLas actividades de aprendizaje se componen de los siguientes elementos:\n|parse|<br />\nForma de trabajo: en equipo, de manera individual, en binas o en trÃ­os, por citar algunas formas.\n|parse|<br />\nAcciÃ³n: mediante el uso de verbos activos escritos en infinitivo, por ejemplo, describir, elaborar.\n|parse|<br />\nProducto: es la evidencia del trabajo que el estudiante realiza en funciÃ³n de la(s) estrategia(s) de enseÃ±anza y aprendizaje seleccionada(s) por el profesor\n|parse|<br />\nContenido: referente al desagregado de contenidos planteados en las unidades de la secuencia didÃ¡ctica.\n', '2018-01-15 11:59:15'),
(79, '3', 'que es un ada', '\nLas actividades de aprendizaje son las acciones concretas que realizarÃ¡ el estudiante para lograr el resultado de aprendizaje y que en conjunto con otras conducirÃ¡n al desarrollo de las competencias de al asignatura\n', '2018-01-15 11:59:43'),
(80, '3', 'que es un ada', '\nLas actividades de aprendizaje son las acciones concretas que realizarÃ¡ el estudiante para lograr el resultado de aprendizaje y que en conjunto con otras conducirÃ¡n al desarrollo de las competencias de al asignatura\n', '2018-01-16 12:02:39'),
(81, '3', 'como se hace un ada', '\nLas actividades de aprendizaje son las acciones concretas que realizarÃ¡ el estudiante para lograr el resultado de aprendizaje y que en conjunto con otras conducirÃ¡n al desarrollo de las competencias de al asignatura\n', '2018-01-16 12:02:43'),
(82, '3', 'cuales son las partes de un ada', '\nLas actividades de aprendizaje se componen de los siguientes elementos:\n|parse|<br />\nForma de trabajo: en equipo, de manera individual, en binas o en trÃ­os, por citar algunas formas.\n|parse|<br />\nAcciÃ³n: mediante el uso de verbos activos escritos en infinitivo, por ejemplo, describir, elaborar.\n|parse|<br />\nProducto: es la evidencia del trabajo que el estudiante realiza en funciÃ³n de la(s) estrategia(s) de enseÃ±anza y aprendizaje seleccionada(s) por el profesor\n|parse|<br />\nContenido: referente al desagregado de contenidos planteados en las unidades de la secuencia didÃ¡ctica.\n', '2018-01-16 12:02:55'),
(83, '3', 'cuales son los elementos', '\nLas actividades de aprendizaje se componen de los siguientes elementos:\n|parse|<br />\nForma de trabajo: en equipo, de manera individual, en binas o en trÃ­os, por citar algunas formas.\n|parse|<br />\nAcciÃ³n: mediante el uso de verbos activos escritos en infinitivo, por ejemplo, describir, elaborar.\n|parse|<br />\nProducto: es la evidencia del trabajo que el estudiante realiza en funciÃ³n de la(s) estrategia(s) de enseÃ±anza y aprendizaje seleccionada(s) por el profesor\n|parse|<br />\nContenido: referente al desagregado de contenidos planteados en las unidades de la secuencia didÃ¡ctica.\n', '2018-01-16 12:03:08'),
(85, '3', 'que debe contener un ada', '\nLas actividades de aprendizaje se componen de los siguientes elementos:\n|parse|<br />\nForma de trabajo: en equipo, de manera individual, en binas o en trÃ­os, por citar algunas formas.\n|parse|<br />\nAcciÃ³n: mediante el uso de verbos activos escritos en infinitivo, por ejemplo, describir, elaborar.\n|parse|<br />\nProducto: es la evidencia del trabajo que el estudiante realiza en funciÃ³n de la(s) estrategia(s) de enseÃ±anza y aprendizaje seleccionada(s) por el profesor\n|parse|<br />\nContenido: referente al desagregado de contenidos planteados en las unidades de la secuencia didÃ¡ctica.\n', '2018-01-16 12:05:21'),
(86, '3', 'tienes un ejemplo ?', 'Este es un ejemplo de ada |parse|<img src="/GPITS/conf/images/ada_example.png">|parse|<a target="_blank" href="/GPITS/conf/images/ada_example.png">DescÃ¡rgalo aquÃ­</a>', '2018-01-16 12:05:55'),
(89, '3', 'como se hace un ada', '\nLas actividades de aprendizaje se componen de los siguientes elementos:\n|parse|<br />\nForma de trabajo: en equipo, de manera individual, en binas o en trÃ­os, por citar algunas formas.\n|parse|<br />\nAcciÃ³n: mediante el uso de verbos activos escritos en infinitivo, por ejemplo, describir, elaborar.\n|parse|<br />\nProducto: es la evidencia del trabajo que el estudiante realiza en funciÃ³n de la(s) estrategia(s) de enseÃ±anza y aprendizaje seleccionada(s) por el profesor\n|parse|<br />\nContenido: referente al desagregado de contenidos planteados en las unidades de la secuencia didÃ¡ctica.\n', '2018-01-16 12:09:54'),
(90, '3', 'que elementos tiene un ada', '\nLas actividades de aprendizaje se componen de los siguientes elementos:\n|parse|<br />\nForma de trabajo: en equipo, de manera individual, en binas o en trÃ­os, por citar algunas formas.\n|parse|<br />\nAcciÃ³n: mediante el uso de verbos activos escritos en infinitivo, por ejemplo, describir, elaborar.\n|parse|<br />\nProducto: es la evidencia del trabajo que el estudiante realiza en funciÃ³n de la(s) estrategia(s) de enseÃ±anza y aprendizaje seleccionada(s) por el profesor\n|parse|<br />\nContenido: referente al desagregado de contenidos planteados en las unidades de la secuencia didÃ¡ctica.\n', '2018-01-16 12:10:19'),
(91, '3', 'que elementos debe contener un ada', '\nLas actividades de aprendizaje son las acciones concretas que realizarÃ¡ el estudiante para lograr el resultado de aprendizaje y que en conjunto con otras conducirÃ¡n al desarrollo de las competencias de al asignatura\n', '2018-01-16 12:10:49'),
(92, '3', 'que elementos debe tener un ada', '\nLas actividades de aprendizaje son las acciones concretas que realizarÃ¡ el estudiante para lograr el resultado de aprendizaje y que en conjunto con otras conducirÃ¡n al desarrollo de las competencias de al asignatura\n', '2018-01-16 12:10:58'),
(93, '3', 'que ELEMENOS DEBE TENER UN ada', '\nLas actividades de aprendizaje se componen de los siguientes elementos:\n|parse|<br />\nForma de trabajo: en equipo, de manera individual, en binas o en trÃ­os, por citar algunas formas.\n|parse|<br />\nAcciÃ³n: mediante el uso de verbos activos escritos en infinitivo, por ejemplo, describir, elaborar.\n|parse|<br />\nProducto: es la evidencia del trabajo que el estudiante realiza en funciÃ³n de la(s) estrategia(s) de enseÃ±anza y aprendizaje seleccionada(s) por el profesor\n|parse|<br />\nContenido: referente al desagregado de contenidos planteados en las unidades de la secuencia didÃ¡ctica.\n', '2018-01-16 12:11:56'),
(95, '3', 'que recomendaciones', '\nLas actividades de aprendizaje se componen de los siguientes elementos:\n|parse|<br />\nForma de trabajo: en equipo, de manera individual, en binas o en trÃ­os, por citar algunas formas.\n|parse|<br />\nAcciÃ³n: mediante el uso de verbos activos escritos en infinitivo, por ejemplo, describir, elaborar.\n|parse|<br />\nProducto: es la evidencia del trabajo que el estudiante realiza en funciÃ³n de la(s) estrategia(s) de enseÃ±anza y aprendizaje seleccionada(s) por el profesor\n|parse|<br />\nContenido: referente al desagregado de contenidos planteados en las unidades de la secuencia didÃ¡ctica.\n', '2018-01-16 12:13:49'),
(96, '3', 'borrar', '\nLas actividades de aprendizaje se componen de los siguientes elementos:\n|parse|<br />\nForma de trabajo: en equipo, de manera individual, en binas o en trÃ­os, por citar algunas formas.\n|parse|<br />\nAcciÃ³n: mediante el uso de verbos activos escritos en infinitivo, por ejemplo, describir, elaborar.\n|parse|<br />\nProducto: es la evidencia del trabajo que el estudiante realiza en funciÃ³n de la(s) estrategia(s) de enseÃ±anza y aprendizaje seleccionada(s) por el profesor\n|parse|<br />\nContenido: referente al desagregado de contenidos planteados en las unidades de la secuencia didÃ¡ctica.\n', '2018-01-16 12:14:01'),
(98, '3', 'cuales son las partes de un ada', '\nLas actividades de aprendizaje se componen de los siguientes elementos:\n|parse|<br />\nForma de trabajo: en equipo, de manera individual, en binas o en trÃ­os, por citar algunas formas.\n|parse|<br />\nAcciÃ³n: mediante el uso de verbos activos escritos en infinitivo, por ejemplo, describir, elaborar.\n|parse|<br />\nProducto: es la evidencia del trabajo que el estudiante realiza en funciÃ³n de la(s) estrategia(s) de enseÃ±anza y aprendizaje seleccionada(s) por el profesor\n|parse|<br />\nContenido: referente al desagregado de contenidos planteados en las unidades de la secuencia didÃ¡ctica.\n', '2018-01-16 12:19:30'),
(99, '3', 'cuales son las formas de trabajo', '\nLas actividades de aprendizaje se componen de los siguientes elementos:\n|parse|<br />\nForma de trabajo: en equipo, de manera individual, en binas o en trÃ­os, por citar algunas formas.\n|parse|<br />\nAcciÃ³n: mediante el uso de verbos activos escritos en infinitivo, por ejemplo, describir, elaborar.\n|parse|<br />\nProducto: es la evidencia del trabajo que el estudiante realiza en funciÃ³n de la(s) estrategia(s) de enseÃ±anza y aprendizaje seleccionada(s) por el profesor\n|parse|<br />\nContenido: referente al desagregado de contenidos planteados en las unidades de la secuencia didÃ¡ctica.\n', '2018-01-16 12:19:47'),
(100, '3', 'necesito mÃ¡s ayuda', '\nLas actividades de aprendizaje se componen de los siguientes elementos:\n|parse|<br />\nForma de trabajo: en equipo, de manera individual, en binas o en trÃ­os, por citar algunas formas.\n|parse|<br />\nAcciÃ³n: mediante el uso de verbos activos escritos en infinitivo, por ejemplo, describir, elaborar.\n|parse|<br />\nProducto: es la evidencia del trabajo que el estudiante realiza en funciÃ³n de la(s) estrategia(s) de enseÃ±anza y aprendizaje seleccionada(s) por el profesor\n|parse|<br />\nContenido: referente al desagregado de contenidos planteados en las unidades de la secuencia didÃ¡ctica.\n', '2018-01-16 12:19:57'),
(101, '3', 'dime sobre tareasconversation', 'Â¿Puedes reformular la pregunta?', '2018-01-16 12:20:31'),
(102, '3', 'dame informaciÃ³n sobre tareasconversation', 'Â¿Puedes reformular la pregunta?', '2018-01-16 12:20:49'),
(103, '3', 'que es una tarea', '\n El mÃ³dulo de actividad tarea le permite al maestro comunicar quehaceres, recolectar los trabajos y proporcionar calificaciones y retroalimentaciÃ³n.\n', '2018-01-16 12:21:11'),
(104, '3', 'como configuro una tarea', '\n El mÃ³dulo de actividad tarea le permite al maestro comunicar quehaceres, recolectar los trabajos y proporcionar calificaciones y retroalimentaciÃ³n.\n', '2018-01-16 12:21:24'),
(105, '3', 'que va en la pestaÃ±a general', '\n El mÃ³dulo de actividad tarea le permite al maestro comunicar quehaceres, recolectar los trabajos y proporcionar calificaciones y retroalimentaciÃ³n.\n', '2018-01-16 12:21:47'),
(106, '3', 'que va en nombre de la tarea', '\n El mÃ³dulo de actividad tarea le permite al maestro comunicar quehaceres, recolectar los trabajos y proporcionar calificaciones y retroalimentaciÃ³n.\n', '2018-01-16 12:21:59'),
(107, '3', 'que va en filtros adicionales', '\nPueden aÃ±adirse filtros adicionales para usar en la tarea, tales como plantillas de respuesta. Los enlaces para descarga de los archivos se mostrarÃ¡n en la pÃ¡gina de la tarea, debajo de la descripciÃ³n.\n', '2018-01-16 12:22:08'),
(109, '3', 'como configuro la entrega de la tarea', '\nPueden aÃ±adirse filtros adicionales para usar en la tarea, tales como plantillas de respuesta. Los enlaces para descarga de los archivos se mostrarÃ¡n en la pÃ¡gina de la tarea, debajo de la descripciÃ³n.\n', '2018-01-16 12:22:55'),
(110, '3', 'que es habilitar', '\n El mÃ³dulo de actividad tarea le permite al maestro comunicar quehaceres, recolectar los trabajos y proporcionar calificaciones y retroalimentaciÃ³n.\n', '2018-01-16 12:24:47'),
(111, '3', 'que es limite de palabras', '\nSi estÃ¡n habilitados los envÃ­os de texto en-lÃ­nea, este es el nÃºmero mÃ¡ximo de palabras que cada estudiante tendrÃ¡ permitido enviar.\n', '2018-01-16 12:24:59'),
(112, '3', 'que es tipo de envio', '\nLa tarea tiene dos tipos de envÃ­o:\nTexto en lÃ­nea:\nSi se habilita, los estudiantes pueden escribir texto enriquecido directamente en un campo editor (de Moodle) para su envÃ­o.\nEnvÃ­os de archivo:\nSi se habilita, los estudiantes pueden subir uno o mÃ¡s archivos a modo de envÃ­o.\n', '2018-01-16 12:29:35');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
