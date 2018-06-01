-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.1.31-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win32
-- HeidiSQL Versión:             9.5.0.5277
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Volcando estructura de base de datos para bbdd_tfg
CREATE DATABASE IF NOT EXISTS `bbdd_tfg` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `bbdd_tfg`;

-- Volcando estructura para tabla bbdd_tfg.grado
CREATE TABLE IF NOT EXISTS `grado` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla bbdd_tfg.grado: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `grado` DISABLE KEYS */;
INSERT INTO `grado` (`id`, `nombre`) VALUES
	(1, 'DAW'),
	(2, 'ASIR'),
	(3, 'DAM');
/*!40000 ALTER TABLE `grado` ENABLE KEYS */;

-- Volcando estructura para tabla bbdd_tfg.grado_alumno
CREATE TABLE IF NOT EXISTS `grado_alumno` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `grado_id` int(11) DEFAULT NULL,
  `alumno_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_D8C7963591A441CC` (`grado_id`),
  KEY `IDX_D8C79635FC28E5EE` (`alumno_id`),
  CONSTRAINT `FK_D8C7963591A441CC` FOREIGN KEY (`grado_id`) REFERENCES `grado` (`id`),
  CONSTRAINT `FK_D8C79635FC28E5EE` FOREIGN KEY (`alumno_id`) REFERENCES `usuario` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla bbdd_tfg.grado_alumno: ~11 rows (aproximadamente)
/*!40000 ALTER TABLE `grado_alumno` DISABLE KEYS */;
INSERT INTO `grado_alumno` (`id`, `grado_id`, `alumno_id`) VALUES
	(1, 1, 1),
	(2, 2, 1),
	(3, 3, 1),
	(4, 1, 2),
	(5, 2, 3),
	(6, 3, 4),
	(7, 1, 5),
	(8, 1, 6),
	(9, 2, 6),
	(10, 1, 7),
	(11, 3, 9);
/*!40000 ALTER TABLE `grado_alumno` ENABLE KEYS */;

-- Volcando estructura para tabla bbdd_tfg.grado_oferta
CREATE TABLE IF NOT EXISTS `grado_oferta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `grado_id` int(11) DEFAULT NULL,
  `oferta_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_B88B8BEA91A441CC` (`grado_id`),
  KEY `IDX_B88B8BEAFAFBF624` (`oferta_id`),
  CONSTRAINT `FK_B88B8BEA91A441CC` FOREIGN KEY (`grado_id`) REFERENCES `grado` (`id`),
  CONSTRAINT `FK_B88B8BEAFAFBF624` FOREIGN KEY (`oferta_id`) REFERENCES `oferta` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla bbdd_tfg.grado_oferta: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `grado_oferta` DISABLE KEYS */;
INSERT INTO `grado_oferta` (`id`, `grado_id`, `oferta_id`) VALUES
	(1, 1, 1),
	(2, 3, 1);
/*!40000 ALTER TABLE `grado_oferta` ENABLE KEYS */;

-- Volcando estructura para tabla bbdd_tfg.oferta
CREATE TABLE IF NOT EXISTS `oferta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `telefono` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `tipo` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `enlaces` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `archivos` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `validar` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla bbdd_tfg.oferta: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `oferta` DISABLE KEYS */;
INSERT INTO `oferta` (`id`, `nombre`, `email`, `telefono`, `tipo`, `descripcion`, `enlaces`, `archivos`, `validar`) VALUES
	(1, 'asfas1', 'asfasf@asd.es', '13213', '1', 'asddasfasfas', 'asdfasfas', 'asfsafasdf', 1),
	(2, 'asfas1', 'asfasf@asd.es', '13213', '1', 'asddasfasfas', 'asdfasfas', 'asfsafasdf', 1),
	(3, 'asfas1', 'asfasf@asd.es', '13213', '1', 'asddasfasfas', 'asdfasfas', 'asfsafasdf', 1),
	(4, 'asfas1', 'asfasf@asd.es', '13213', '1', 'asddasfasfas', 'asdfasfas', 'asfsafasdf', 1),
	(5, 'asfas1', 'asfasf@asd.es', '13213', '1', 'asddasfasfas', 'asdfasfas', 'asfsafasdf', 1),
	(6, 'asfas1', 'asfasf@asd.es', '13213', '1', 'asddasfasfas', 'asdfasfas', 'asfsafasdf', 0),
	(7, 'asfas1', 'asfasf@asd.es', '13213', '1', 'asddasfasfas', 'asdfasfas', 'asfsafasdf', 0),
	(8, 'asfas1', 'asfasf@asd.es', '13213', '1', 'asddasfasfas', 'asdfasfas', 'asfsafasdf', 0),
	(9, 'asfas1', 'asfasf@asd.es', '13213', '1', 'asddasfasfas', 'asdfasfas', 'asfsafasdf', 0),
	(10, 'asfas1', 'asfasf@asd.es', '13213', '1', 'asddasfasfas', 'asdfasfas', 'asfsafasdf', 0),
	(11, 'asfas1', 'asfasf@asd.es', '13213', '1', 'asddasfasfas', 'asdfasfas', 'asfsafasdf', 0),
	(12, 'asfas1', 'asfasf@asd.es', '13213', '1', 'asddasfasfas', 'asdfasfas', 'asfsafasdf', 0),
	(13, 'asfas1', 'asfasf@asd.es', '13213', '1', 'asddasfasfas', 'asdfasfas', 'asfsafasdf', 0),
	(14, 'asfas1', 'asfasf@asd.es', '13213', '1', 'asddasfasfas', 'asdfasfas', 'asfsafasdf', 0),
	(15, 'asfas1', 'asfasf@asd.es', '13213', '1', 'asddasfasfas', 'asdfasfas', 'asfsafasdf', 0),
	(16, 'asfas1', 'asfasf@asd.es', '13213', '1', 'asddasfasfas', 'asdfasfas', 'asfsafasdf', 0),
	(17, 'asfas1', 'asfasf@asd.es', '13213', '1', 'asddasfasfas', 'asdfasfas', 'asfsafasdf', 0),
	(18, 'asfas1', 'asfasf@asd.es', '13213', '1', 'asddasfasfas', 'asdfasfas', 'asfsafasdf', 0),
	(19, 'asfas1', 'asfasf@asd.es', '13213', '1', 'asddasfasfas', 'asdfasfas', 'asfsafasdf', 0),
	(20, 'asfas1', 'asfasf@asd.es', '13213', '1', 'asddasfasfas', 'asdfasfas', 'asfsafasdf', 0);
/*!40000 ALTER TABLE `oferta` ENABLE KEYS */;

-- Volcando estructura para tabla bbdd_tfg.usuario
CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nif` varchar(9) COLLATE utf8_unicode_ci NOT NULL,
  `nombre` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `apellido` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `telefono` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `foto` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `passwd` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `rol` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `curso` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_EDD889C1E7927C74` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla bbdd_tfg.usuario: ~12 rows (aproximadamente)
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` (`id`, `nif`, `nombre`, `apellido`, `telefono`, `email`, `foto`, `passwd`, `rol`, `curso`) VALUES
	(1, '49161075', 'Alberto', 'Lobo', '51454', 'asd@asd.es', 'map.png', '$2a$04$7cw8xapnk1F.pfMasX7ja.r2875puVhev23UKkAGwg1Oqflssi3Sa', 'ROLE_ADMIN', '2016'),
	(2, '49161075', 'Alberto', 'Lobo', '51454', 'asd1@asd.es', 'map.png', '$2a$04$7cw8xapnk1F.pfMasX7ja.r2875puVhev23UKkAGwg1Oqflssi3Sa', 'ROLE_ADMIN', '2016'),
	(3, '49161075', 'Alberto', 'Lobo', '51454', 'asd2@asd.es', 'map.png', '$2a$04$7cw8xapnk1F.pfMasX7ja.r2875puVhev23UKkAGwg1Oqflssi3Sa', 'ROLE_ADMIN', '2016'),
	(4, '49161075', 'Alberto', 'Lobo', '51454', 'asd3@asd.es', 'map.png', '$2a$04$7cw8xapnk1F.pfMasX7ja.r2875puVhev23UKkAGwg1Oqflssi3Sa', 'ROLE_ADMIN', '2016'),
	(5, '49161075', 'Alberto', 'Lobo', '51454', 'asd4@asd.es', 'map.png', '$2a$04$7cw8xapnk1F.pfMasX7ja.r2875puVhev23UKkAGwg1Oqflssi3Sa', 'ROLE_USER', '2016'),
	(6, '49161075', 'Alberto', 'Lobo', '51454', 'asd5@asd.es', 'map.png', '$2a$04$7cw8xapnk1F.pfMasX7ja.r2875puVhev23UKkAGwg1Oqflssi3Sa', 'ROLE_USER', '2016'),
	(7, '49161075', 'Alberto', 'Lobo', '51454', 'asd6@asd.es', 'map.png', '$2a$04$7cw8xapnk1F.pfMasX7ja.r2875puVhev23UKkAGwg1Oqflssi3Sa', 'ROLE_USER', '2016'),
	(8, '49161075', 'Alberto', 'Lobo', '51454', 'asd7@asd.es', 'map.png', '$2a$04$7cw8xapnk1F.pfMasX7ja.r2875puVhev23UKkAGwg1Oqflssi3Sa', 'ROLE_USER', '2016'),
	(9, '49161075', 'Alberto', 'Lobo', '51454', 'asd8@asd.es', 'map.png', '$2a$04$7cw8xapnk1F.pfMasX7ja.r2875puVhev23UKkAGwg1Oqflssi3Sa', 'ROLE_USER', '2016'),
	(10, '49161075', 'Alberto', 'Lobo', '51454', 'asd9@asd.es', 'map.png', '$2a$04$7cw8xapnk1F.pfMasX7ja.r2875puVhev23UKkAGwg1Oqflssi3Sa', 'ROLE_USER', '2016'),
	(11, '49161075', 'Alberto', 'Lobo', '51454', 'asd10@asd.es', 'map.png', '$2a$04$7cw8xapnk1F.pfMasX7ja.r2875puVhev23UKkAGwg1Oqflssi3Sa', 'ROLE_USER', '2016'),
	(12, '49161075', 'Alberto', 'Lobo', '51454', 'asd11@asd.es', 'map.png', '$2a$04$7cw8xapnk1F.pfMasX7ja.r2875puVhev23UKkAGwg1Oqflssi3Sa', 'ROLE_USER', '2016');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
