CREATE DATABASE  IF NOT EXISTS `dwesbd04` ;
USE `dwesbd04`;

DROP TABLE IF EXISTS `salas`;
DROP TABLE IF EXISTS `cines`;

CREATE TABLE `cines` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) DEFAULT NULL,
  `direccion` varchar(200) DEFAULT NULL,
  `mail` varchar(200) DEFAULT NULL,
  `telefono` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

CREATE TABLE `salas` (
  `idCine` int(11) NOT NULL,
  `idSala` int(2) NOT NULL,
  `pelicula` varchar(100) DEFAULT NULL,
  `aforo` int(3) DEFAULT NULL,
  `es3d` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`idCine`,`idSala`),
  KEY `fkCin` (`idCine`),
  CONSTRAINT `fkCin` FOREIGN KEY (`idCine`) REFERENCES `cines` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




INSERT INTO `cines` VALUES (1,'Artea','direccion1','nuevomail@mail.com','999');
INSERT INTO `cines` VALUES (2,'Deportivo de getxo','DIRECCION1','MAIL','TELEFONO');
INSERT INTO `salas` VALUES (1,1,'Los juegos del hambre Modificado',100,1);
INSERT INTO `salas` VALUES (1,2,'pelicula',100,1);
INSERT INTO `salas` VALUES (2,1,'Los juegos del hambre2',NULL,NULL);
