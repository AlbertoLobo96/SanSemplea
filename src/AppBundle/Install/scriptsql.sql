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
  `descripcion` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla bbdd_tfg.grado: ~6 rows (aproximadamente)
/*!40000 ALTER TABLE `grado` DISABLE KEYS */;
INSERT INTO `grado` (`id`, `nombre`, `descripcion`) VALUES
	(1, 'DAW', 'CFGS. Desarrollo Aplicaciones Webs'),
	(2, 'AAW', 'CFGS. Administración de Aplicaciones Webs'),
	(3, 'SMR', 'CFGM. Sistemas Microinformáticos y Redes'),
	(4, 'AF', 'CFGS. Administración y Finanzas.'),
	(5, 'GA', 'CFGM. Gestión Administrativa.'),
	(6, 'GAC', 'CFGM. Gestión Actividades Comerciales'),
	(7, 'GVE', 'CFGS. Gestión de Ventas y Espacios Comerciales.');
/*!40000 ALTER TABLE `grado` ENABLE KEYS */;

-- Volcando estructura para tabla bbdd_tfg.grados_alumnos
CREATE TABLE IF NOT EXISTS `grados_alumnos` (
  `usuario_id` int(11) NOT NULL,
  `grado_id` int(11) NOT NULL,
  PRIMARY KEY (`usuario_id`,`grado_id`),
  KEY `IDX_154D292ADB38439E` (`usuario_id`),
  KEY `IDX_154D292A91A441CC` (`grado_id`),
  CONSTRAINT `FK_154D292A91A441CC` FOREIGN KEY (`grado_id`) REFERENCES `grado` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_154D292ADB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla bbdd_tfg.grados_alumnos: ~8 rows (aproximadamente)
/*!40000 ALTER TABLE `grados_alumnos` DISABLE KEYS */;
INSERT INTO `grados_alumnos` (`usuario_id`, `grado_id`) VALUES
	(1, 1),
	(2, 1),
	(3, 2),
	(6, 1),
	(6, 2),
	(7, 1),
	(9, 3),
	(13, 1),
	(13, 2),
	(13, 3),
	(13, 4);
/*!40000 ALTER TABLE `grados_alumnos` ENABLE KEYS */;

-- Volcando estructura para tabla bbdd_tfg.grados_ofertas
CREATE TABLE IF NOT EXISTS `grados_ofertas` (
  `oferta_id` int(11) NOT NULL,
  `grado_id` int(11) NOT NULL,
  PRIMARY KEY (`oferta_id`,`grado_id`),
  KEY `IDX_341AA72FAFBF624` (`oferta_id`),
  KEY `IDX_341AA7291A441CC` (`grado_id`),
  CONSTRAINT `FK_341AA7291A441CC` FOREIGN KEY (`grado_id`) REFERENCES `grado` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_341AA72FAFBF624` FOREIGN KEY (`oferta_id`) REFERENCES `oferta` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla bbdd_tfg.grados_ofertas: ~5 rows (aproximadamente)
/*!40000 ALTER TABLE `grados_ofertas` DISABLE KEYS */;
INSERT INTO `grados_ofertas` (`oferta_id`, `grado_id`) VALUES
	(1, 1),
	(1, 2),
	(1, 3),
	(2, 1),
	(3, 1),
	(4, 7);
/*!40000 ALTER TABLE `grados_ofertas` ENABLE KEYS */;

-- Volcando estructura para tabla bbdd_tfg.oferta
CREATE TABLE IF NOT EXISTS `oferta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `telefono` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `tipo` int(11) NOT NULL,
  `descripcion` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `enlaces` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `archivos` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `validar` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla bbdd_tfg.oferta: ~20 rows (aproximadamente)
/*!40000 ALTER TABLE `oferta` DISABLE KEYS */;
INSERT INTO `oferta` (`id`, `nombre`, `email`, `telefono`, `tipo`, `descripcion`, `enlaces`, `archivos`, `validar`) VALUES
	(1, 'asfas1', 'asfasf@asd.es', '13213', 1, 'asddasfasfas', 'asdfasfas', 'asfsafasdf', 1),
	(2, 'asfas2', 'asfasf@asd.es', '13213', 1, 'asddasfasfas', 'asdfasfas', 'asfsafasdf', 1),
	(3, 'asfas3', 'asfasf@asd.es', '13213', 2, 'asddasfasfas', 'asdfasfas', 'asfsafasdf', 1),
	(4, 'asfas1', 'asfasf@asd.es', '13213', 1, 'asddasfasfas', 'asdfasfas', 'asfsafasdf', 1),
	(5, 'asfas1', 'asfasf@asd.es', '13213', 2, 'asddasfasfas', 'asdfasfas', 'asfsafasdf', 1),
	(6, 'asfas1', 'asfasf@asd.es', '13213', 3, 'asddasfasfas', 'asdfasfas', 'asfsafasdf', 0),
	(7, 'asfas1', 'asfasf@asd.es', '13213', 1, 'asddasfasfas', 'asdfasfas', 'asfsafasdf', 0),
	(9, 'asfas1', 'asfasf@asd.es', '13213', 1, 'asddasfasfas', 'asdfasfas', 'asfsafasdf', 0),
	(10, 'asfas1', 'asfasf@asd.es', '13213', 1, 'asddasfasfas', 'asdfasfas', 'asfsafasdf', 0),
	(11, 'asfas1', 'asfasf@asd.es', '13213', 1, 'asddasfasfas', 'asdfasfas', 'asfsafasdf', 0),
	(12, 'asfas1', 'asfasf@asd.es', '13213', 1, 'asddasfasfas', 'asdfasfas', 'asfsafasdf', 0),
	(13, 'asfas1', 'asfasf@asd.es', '13213', 1, 'asddasfasfas', 'asdfasfas', 'asfsafasdf', 0),
	(14, 'asfas1', 'asfasf@asd.es', '13213', 1, 'asddasfasfas', 'asdfasfas', 'asfsafasdf', 0),
	(15, 'asfas1', 'asfasf@asd.es', '13213', 1, 'asddasfasfas', 'asdfasfas', 'asfsafasdf', 0),
	(16, 'asfas1', 'asfasf@asd.es', '13213', 1, 'asddasfasfas', 'asdfasfas', 'asfsafasdf', 0),
	(17, 'asfas1', 'asfasf@asd.es', '13213', 1, 'asddasfasfas', 'asdfasfas', 'asfsafasdf', 0),
	(18, 'asfas1', 'asfasf@asd.es', '13213', 1, 'asddasfasfas', 'asdfasfas', 'asfsafasdf', 0);
/*!40000 ALTER TABLE `oferta` ENABLE KEYS */;

-- Volcando estructura para tabla bbdd_tfg.usuario
CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nif` varchar(9) COLLATE utf8_unicode_ci NOT NULL,
  `nombre` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Recibir` int(11) DEFAULT NULL,
  `apellido` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `telefono` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `foto` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `passwd` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `rol` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `curso` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_EDD889C1E7927C74` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Volcando datos para la tabla bbdd_tfg.usuario: ~11 rows (aproximadamente)
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` (`id`, `nif`, `nombre`, `Recibir`, `apellido`, `telefono`, `email`, `foto`, `passwd`, `rol`, `curso`) VALUES
	(1, '49161075R', 'Alberto', 0, 'Lobo', '698547128', 'bosssansemplea@gmail.com', '1528214261.png', '$2y$11$4Y6GR7A8f.ZmpZR2uuZFSusVNyY8w0s6WIDPVrgTh6D1WxSrHujEe', 'ROLE_ADMIN', '2016'),
	(2, '49161075', 'Alberto', 0, 'Lobo', '51454', 'asd1@asd.es', 'map.png', '$2a$04$7cw8xapnk1F.pfMasX7ja.r2875puVhev23UKkAGwg1Oqflssi3Sa', 'ROLE_ADMIN', '2016'),
	(3, '49161075', 'Alberto', 0, 'Lobo', '51454', 'asd2@asd.es', 'map.png', '$2a$04$7cw8xapnk1F.pfMasX7ja.r2875puVhev23UKkAGwg1Oqflssi3Sa', 'ROLE_ADMIN', '2016'),
	(6, '49161075', 'Alberto', 0, 'Lobo', '51454', 'asd5@asd.es', 'map.png', '$2a$04$7cw8xapnk1F.pfMasX7ja.r2875puVhev23UKkAGwg1Oqflssi3Sa', 'ROLE_USER', '2016'),
	(7, '49161075', 'Alberto', 0, 'Lobo', '51454', 'asd6@asd.es', 'map.png', '$2a$04$7cw8xapnk1F.pfMasX7ja.r2875puVhev23UKkAGwg1Oqflssi3Sa', 'ROLE_USER', '2016'),
	(9, '49161075', 'Alberto', 0, 'Lobo', '51454', 'asd8@asd.es', 'map.png', '$2a$04$7cw8xapnk1F.pfMasX7ja.r2875puVhev23UKkAGwg1Oqflssi3Sa', 'ROLE_USER', '2016'),
	(10, '49161075', 'Alberto', 0, 'Lobo', '51454', 'asd9@asd.es', 'map.png', '$2a$04$7cw8xapnk1F.pfMasX7ja.r2875puVhev23UKkAGwg1Oqflssi3Sa', 'ROLE_USER', '2016'),
	(11, '49161075', 'Alberto', 0, 'Lobo', '51454', 'asd10@asd.es', 'map.png', '$2a$04$7cw8xapnk1F.pfMasX7ja.r2875puVhev23UKkAGwg1Oqflssi3Sa', 'ROLE_USER', '2016'),
	(12, '49161075', 'Alberto', 0, 'Lobo', '51454', 'asd11@asd.es', 'map.png', '$2a$04$7cw8xapnk1F.pfMasX7ja.r2875puVhev23UKkAGwg1Oqflssi3Sa', 'ROLE_USER', '2016'),
	(13, '49161075a', 'prueba', 1, 'prueba', '123456789', 'alberto_trinidad_lobo@hotmail.es', '1529238630.jpeg', '$2y$11$/6DKwyp8WiNOoCRnwUaMHuhUlvW7wDqpD2CzIIC6ozKkxb/.BGMZa', 'ROLE_USER', '2016');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
