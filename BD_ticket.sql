CREATE DATABASE  IF NOT EXISTS `ticket` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `ticket`;
-- MySQL dump 10.13  Distrib 5.7.9, for Win64 (x86_64)
--
-- Host: localhost    Database: ticket
-- ------------------------------------------------------
-- Server version	5.7.11-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `bitacora`
--

DROP TABLE IF EXISTS `bitacora`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bitacora` (
  `bitCve` varchar(100) NOT NULL,
  `UsuCve` int(11) NOT NULL,
  `BitFecha` datetime DEFAULT NULL,
  `Accion` varchar(250) DEFAULT NULL,
  `AccionClave` varchar(250) DEFAULT NULL,
  `Tablaaccion` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`bitCve`),
  KEY `usuarios` (`UsuCve`),
  CONSTRAINT `FK_bitacora_usuarios` FOREIGN KEY (`UsuCve`) REFERENCES `usuarios` (`UsuCve`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bitacora`
--

LOCK TABLES `bitacora` WRITE;
/*!40000 ALTER TABLE `bitacora` DISABLE KEYS */;
/*!40000 ALTER TABLE `bitacora` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estatus`
--

DROP TABLE IF EXISTS `estatus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estatus` (
  `EstCve` int(11) NOT NULL,
  `EstDesc` varchar(100) DEFAULT NULL,
  `Activo` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estatus`
--

LOCK TABLES `estatus` WRITE;
/*!40000 ALTER TABLE `estatus` DISABLE KEYS */;
INSERT INTO `estatus` VALUES (1,'Abierto','1'),(2,'Cerrado','1');
/*!40000 ALTER TABLE `estatus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `modulos`
--

DROP TABLE IF EXISTS `modulos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `modulos` (
  `ModCve` int(11) NOT NULL,
  `ModSub` int(11) NOT NULL,
  `ModDesc` varchar(100) DEFAULT NULL,
  `ModUrl` varchar(100) DEFAULT NULL,
  `ModOrden` int(11) NOT NULL,
  `ModActivo` char(1) DEFAULT NULL,
  PRIMARY KEY (`ModCve`,`ModSub`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `modulos`
--

LOCK TABLES `modulos` WRITE;
/*!40000 ALTER TABLE `modulos` DISABLE KEYS */;
INSERT INTO `modulos` VALUES (1,0,'Ticket','tciket',1,'1'),(1,1,'Crear Ticket','Nuevo',2,'1'),(1,2,'Ticket Abierto','Listado',3,'1'),(1,3,'Ticket Cerrado','Listado',4,'1'),(1,4,'Listado de Ticket','Listado',5,'1'),(2,0,'Usuarios','usuario',1,'1'),(2,1,'Crear Usuario','Nuevo',1,'1'),(2,2,'Lista Usuarios','Listado',1,'1');
/*!40000 ALTER TABLE `modulos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `seguridad`
--

DROP TABLE IF EXISTS `seguridad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `seguridad` (
  `Usucve` int(11) NOT NULL,
  `ModCve` int(11) NOT NULL,
  `ModSub` int(11) NOT NULL,
  `Accion` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`Usucve`,`ModCve`,`ModSub`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `seguridad`
--

LOCK TABLES `seguridad` WRITE;
/*!40000 ALTER TABLE `seguridad` DISABLE KEYS */;
INSERT INTO `seguridad` VALUES (1,1,0,NULL),(1,1,1,NULL),(1,1,2,NULL),(1,1,3,NULL),(1,2,0,NULL),(1,2,1,NULL);
/*!40000 ALTER TABLE `seguridad` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sesion`
--

DROP TABLE IF EXISTS `sesion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sesion` (
  `SesCve` varchar(100) NOT NULL,
  `UsuCve` int(11) NOT NULL,
  `SesFecha` datetime DEFAULT NULL,
  `SesHora` varchar(6) DEFAULT NULL,
  PRIMARY KEY (`SesCve`),
  KEY `usuarios` (`UsuCve`),
  CONSTRAINT `FK_sesion_usuarios` FOREIGN KEY (`UsuCve`) REFERENCES `usuarios` (`UsuCve`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sesion`
--

LOCK TABLES `sesion` WRITE;
/*!40000 ALTER TABLE `sesion` DISABLE KEYS */;
INSERT INTO `sesion` VALUES ('5dcb06b5611e600f11b5b9295847c365',1,'2016-05-31 19:30:11','19:30');
/*!40000 ALTER TABLE `sesion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ticket`
--

DROP TABLE IF EXISTS `ticket`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ticket` (
  `TicCve` int(11) NOT NULL,
  `Tictipo` varchar(1) DEFAULT NULL,
  `TicArea` varchar(90) DEFAULT NULL,
  `TicFecha` datetime NOT NULL,
  `UsuCve` int(11) NOT NULL,
  `TicTitulo` varchar(150) NOT NULL,
  `TicDescripcion` varchar(300) NOT NULL,
  `TicAdjunto` varchar(100) DEFAULT NULL,
  `TicEstatus` char(1) NOT NULL,
  `TicAtiende` int(11) NOT NULL,
  `TicFechaCierre` datetime NOT NULL,
  `TicObservaciones` varchar(300) NOT NULL,
  PRIMARY KEY (`TicCve`),
  KEY `usuarios` (`UsuCve`),
  CONSTRAINT `FK_ticket_usuarios` FOREIGN KEY (`UsuCve`) REFERENCES `usuarios` (`UsuCve`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ticket`
--

LOCK TABLES `ticket` WRITE;
/*!40000 ALTER TABLE `ticket` DISABLE KEYS */;
/*!40000 ALTER TABLE `ticket` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ticketdetalle`
--

DROP TABLE IF EXISTS `ticketdetalle`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ticketdetalle` (
  `TidcCve` int(11) NOT NULL,
  `TiCcve` int(11) NOT NULL,
  `TicFecha` datetime NOT NULL,
  `UsuCve` int(11) NOT NULL,
  `TicComentario` varchar(150) NOT NULL,
  PRIMARY KEY (`TidcCve`),
  KEY `usuarios` (`UsuCve`),
  KEY `ticket` (`TiCcve`),
  CONSTRAINT `FK_ticketDetalle_ticket` FOREIGN KEY (`TiCcve`) REFERENCES `ticket` (`TicCve`),
  CONSTRAINT `FK_ticketDetalle_usuarios` FOREIGN KEY (`UsuCve`) REFERENCES `usuarios` (`UsuCve`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ticketdetalle`
--

LOCK TABLES `ticketdetalle` WRITE;
/*!40000 ALTER TABLE `ticketdetalle` DISABLE KEYS */;
/*!40000 ALTER TABLE `ticketdetalle` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipousuario`
--

DROP TABLE IF EXISTS `tipousuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipousuario` (
  `TipoCve` int(11) NOT NULL,
  `TipoDesc` varchar(100) DEFAULT NULL,
  `Tipoestatus` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipousuario`
--

LOCK TABLES `tipousuario` WRITE;
/*!40000 ALTER TABLE `tipousuario` DISABLE KEYS */;
INSERT INTO `tipousuario` VALUES (1,'Administrador','1'),(2,'Cliente','1'),(3,'Soporte','1');
/*!40000 ALTER TABLE `tipousuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `UsuCve` int(11) NOT NULL,
  `UsuNombre` varchar(35) DEFAULT NULL,
  `UsuApellidos` varchar(50) DEFAULT NULL,
  `UsuMail` varchar(60) DEFAULT NULL,
  `UsuPassword` varchar(25) DEFAULT NULL,
  `UsuActivo` char(1) NOT NULL,
  `UsuTipo` char(1) DEFAULT NULL,
  PRIMARY KEY (`UsuCve`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'xochitl','Carmen Arenas','xochitl.ca.0@gmail.com','x90x','1','1');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'ticket'
--

--
-- Dumping routines for database 'ticket'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-05-31 19:40:21
