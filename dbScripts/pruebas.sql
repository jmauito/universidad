-- MySQL dump 10.16  Distrib 10.1.26-MariaDB, for Linux (i686)
--
-- Host: localhost    Database: pruebas
-- ------------------------------------------------------
-- Server version	10.1.26-MariaDB

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
-- Table structure for table `aca_alumno`
--

DROP TABLE IF EXISTS `aca_alumno`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `aca_alumno` (
  `persona` char(8) NOT NULL,
  `condicion` char(1) NOT NULL DEFAULT 'R',
  PRIMARY KEY (`persona`),
  CONSTRAINT `aca_alumno_mae_persona_FK` FOREIGN KEY (`persona`) REFERENCES `mae_persona` (`persona`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `aca_alumno`
--

LOCK TABLES `aca_alumno` WRITE;
/*!40000 ALTER TABLE `aca_alumno` DISABLE KEYS */;
INSERT INTO `aca_alumno` VALUES ('00000008','R');
/*!40000 ALTER TABLE `aca_alumno` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `aca_alumnoCurricula`
--

DROP TABLE IF EXISTS `aca_alumnoCurricula`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `aca_alumnoCurricula` (
  `persona` char(8) NOT NULL,
  `curricula` tinyint(3) unsigned NOT NULL,
  UNIQUE KEY `aca_alumnoCurricula_UN` (`persona`,`curricula`),
  KEY `aca_alumnoCurricula_aca_curricula_FK` (`curricula`),
  CONSTRAINT `aca_alumnoCurricula_aca_alumno_FK` FOREIGN KEY (`persona`) REFERENCES `aca_alumno` (`persona`) ON UPDATE CASCADE,
  CONSTRAINT `aca_alumnoCurricula_aca_curricula_FK` FOREIGN KEY (`curricula`) REFERENCES `aca_curricula` (`curricula`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `aca_alumnoCurricula`
--

LOCK TABLES `aca_alumnoCurricula` WRITE;
/*!40000 ALTER TABLE `aca_alumnoCurricula` DISABLE KEYS */;
INSERT INTO `aca_alumnoCurricula` VALUES ('00000008',1);
/*!40000 ALTER TABLE `aca_alumnoCurricula` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `aca_curricula`
--

DROP TABLE IF EXISTS `aca_curricula`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `aca_curricula` (
  `curricula` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `carrera` tinyint(3) unsigned NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `alias` char(10) NOT NULL,
  `vigente` tinyint(1) NOT NULL,
  `estado` char(1) NOT NULL DEFAULT 'A',
  PRIMARY KEY (`curricula`),
  UNIQUE KEY `aca_curriculaNombre_UN` (`nombre`),
  UNIQUE KEY `aca_curriculaAlias_UN` (`alias`),
  KEY `fk_curricula_estructura` (`carrera`),
  CONSTRAINT `fk_curricula_estructura` FOREIGN KEY (`carrera`) REFERENCES `mae_carrera` (`carrera`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `aca_curricula`
--

LOCK TABLES `aca_curricula` WRITE;
/*!40000 ALTER TABLE `aca_curricula` DISABLE KEYS */;
INSERT INTO `aca_curricula` VALUES (1,1,'Currícula 1','Plan 1',1,'A');
/*!40000 ALTER TABLE `aca_curricula` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `aca_cursoProgramado`
--

DROP TABLE IF EXISTS `aca_cursoProgramado`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `aca_cursoProgramado` (
  `cursoProgramado` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `sede` tinyint(3) unsigned NOT NULL,
  `materia` int(10) unsigned NOT NULL,
  `paralelo` char(5) NOT NULL,
  `semestre` int(10) unsigned NOT NULL,
  `estado` char(1) NOT NULL DEFAULT 'A',
  PRIMARY KEY (`cursoProgramado`),
  KEY `aca_cursoProgramado_aca_materia_FK` (`materia`),
  CONSTRAINT `aca_cursoProgramado_aca_materia_FK` FOREIGN KEY (`materia`) REFERENCES `aca_materia` (`materia`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `aca_cursoProgramado`
--

LOCK TABLES `aca_cursoProgramado` WRITE;
/*!40000 ALTER TABLE `aca_cursoProgramado` DISABLE KEYS */;
INSERT INTO `aca_cursoProgramado` VALUES (1,1,1,'1A',1,'A'),(2,1,2,'1A',1,'A'),(3,1,3,'1A',1,'A'),(4,1,4,'2A',2,'A'),(5,1,6,'2A',2,'A'),(6,1,5,'2A',2,'A');
/*!40000 ALTER TABLE `aca_cursoProgramado` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `aca_materia`
--

DROP TABLE IF EXISTS `aca_materia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `aca_materia` (
  `materia` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `curricula` tinyint(3) unsigned NOT NULL,
  `ciclo` tinyint(3) unsigned NOT NULL,
  `codigo` char(10) NOT NULL,
  `estado` char(1) NOT NULL DEFAULT 'A',
  PRIMARY KEY (`materia`),
  UNIQUE KEY `aca_materiaCodigo_UN` (`codigo`),
  KEY `aca_materia_aca_curricula_FK` (`curricula`),
  CONSTRAINT `aca_materia_aca_curricula_FK` FOREIGN KEY (`curricula`) REFERENCES `aca_curricula` (`curricula`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `aca_materia`
--

LOCK TABLES `aca_materia` WRITE;
/*!40000 ALTER TABLE `aca_materia` DISABLE KEYS */;
INSERT INTO `aca_materia` VALUES (1,'Redes I',1,1,'sr001','A'),(2,'Programación I',1,1,'sp001','A'),(3,'Matemáticas',1,1,'sm001','A'),(4,'Redes II',1,2,'sr002','A'),(5,'Programación II',1,2,'sp002','A'),(6,'Análisis matemático',1,2,'sam001','A');
/*!40000 ALTER TABLE `aca_materia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `aca_rendimiento`
--

DROP TABLE IF EXISTS `aca_rendimiento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `aca_rendimiento` (
  `rendimiento` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `cursoProgramado` bigint(20) unsigned NOT NULL,
  `persona` char(8) NOT NULL,
  `promedio` decimal(5,3) DEFAULT NULL,
  PRIMARY KEY (`rendimiento`),
  KEY `aca_rendimiento_aca_cursoProgramado_FK` (`cursoProgramado`),
  KEY `aca_rendimiento_mae_persona_FK` (`persona`),
  CONSTRAINT `aca_rendimiento_aca_cursoProgramado_FK` FOREIGN KEY (`cursoProgramado`) REFERENCES `aca_cursoProgramado` (`cursoProgramado`) ON UPDATE CASCADE,
  CONSTRAINT `aca_rendimiento_mae_persona_FK` FOREIGN KEY (`persona`) REFERENCES `mae_persona` (`persona`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `aca_rendimiento`
--

LOCK TABLES `aca_rendimiento` WRITE;
/*!40000 ALTER TABLE `aca_rendimiento` DISABLE KEYS */;
INSERT INTO `aca_rendimiento` VALUES (1,1,'00000008',75.000),(2,2,'00000008',76.000),(3,3,'00000008',23.000);
/*!40000 ALTER TABLE `aca_rendimiento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cob_ctacteAlumno`
--

DROP TABLE IF EXISTS `cob_ctacteAlumno`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cob_ctacteAlumno` (
  `persona` char(8) NOT NULL,
  `debe` decimal(10,4) NOT NULL,
  KEY `cob_ctacteAlumno_aca_alumno_FK` (`persona`),
  CONSTRAINT `cob_ctacteAlumno_aca_alumno_FK` FOREIGN KEY (`persona`) REFERENCES `aca_alumno` (`persona`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cob_ctacteAlumno`
--

LOCK TABLES `cob_ctacteAlumno` WRITE;
/*!40000 ALTER TABLE `cob_ctacteAlumno` DISABLE KEYS */;
INSERT INTO `cob_ctacteAlumno` VALUES ('00000008',100.0000);
/*!40000 ALTER TABLE `cob_ctacteAlumno` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `horario`
--

DROP TABLE IF EXISTS `horario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `horario` (
  `horario` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `estado` char(1) NOT NULL DEFAULT 'A',
  `nombre` varchar(200) NOT NULL,
  PRIMARY KEY (`horario`),
  UNIQUE KEY `horarioNombre_UN` (`nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `horario`
--

LOCK TABLES `horario` WRITE;
/*!40000 ALTER TABLE `horario` DISABLE KEYS */;
INSERT INTO `horario` VALUES (1,'A','Horario matutino de prueba');
/*!40000 ALTER TABLE `horario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `horarioPeriodo`
--

DROP TABLE IF EXISTS `horarioPeriodo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `horarioPeriodo` (
  `horarioPeriodo` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `estado` char(1) NOT NULL DEFAULT 'A',
  `dia` enum('lunes','martes','miércoles','jueves','viernes','sábado','domingo') NOT NULL,
  `horaInicio` time NOT NULL,
  `horaFin` time NOT NULL,
  `horario` int(10) unsigned NOT NULL,
  PRIMARY KEY (`horarioPeriodo`),
  UNIQUE KEY `horarioPeriodoInicio_UN` (`dia`,`horaInicio`,`horario`),
  UNIQUE KEY `horarioPeriodoFin_UN` (`dia`,`horaFin`,`horario`),
  KEY `horarioPeriodo_horario_FK` (`horario`),
  CONSTRAINT `horarioPeriodo_horario_FK` FOREIGN KEY (`horario`) REFERENCES `horario` (`horario`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `horarioPeriodo`
--

LOCK TABLES `horarioPeriodo` WRITE;
/*!40000 ALTER TABLE `horarioPeriodo` DISABLE KEYS */;
INSERT INTO `horarioPeriodo` VALUES (1,'A','lunes','07:00:00','08:00:00',1),(2,'A','lunes','08:00:00','09:00:00',1),(4,'A','lunes','09:00:00','10:00:00',1),(5,'A','lunes','10:00:00','11:00:00',1),(6,'A','lunes','11:00:00','12:00:00',1),(7,'A','lunes','12:00:00','13:00:00',1),(8,'A','martes','07:00:00','08:00:00',1),(9,'A','martes','08:00:00','09:00:00',1),(10,'A','martes','09:00:00','10:00:00',1),(11,'A','martes','10:00:00','11:00:00',1),(12,'A','martes','11:00:00','12:00:00',1),(13,'A','martes','12:00:00','13:00:00',1);
/*!40000 ALTER TABLE `horarioPeriodo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mae_carrera`
--

DROP TABLE IF EXISTS `mae_carrera`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mae_carrera` (
  `carrera` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `alias` char(10) NOT NULL,
  `estado` char(10) NOT NULL DEFAULT 'A',
  PRIMARY KEY (`carrera`),
  UNIQUE KEY `mae_carreraNombre_UN` (`nombre`),
  UNIQUE KEY `mae_carreraAlias_UN` (`alias`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mae_carrera`
--

LOCK TABLES `mae_carrera` WRITE;
/*!40000 ALTER TABLE `mae_carrera` DISABLE KEYS */;
INSERT INTO `mae_carrera` VALUES (1,'Ingeniería de Sistemas','Sistemas','A');
/*!40000 ALTER TABLE `mae_carrera` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mae_persona`
--

DROP TABLE IF EXISTS `mae_persona`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mae_persona` (
  `persona` char(8) NOT NULL,
  `nombreCompleto` varchar(243) NOT NULL,
  `apellidoPaterno` varchar(60) NOT NULL,
  `apellidoMaterno` varchar(60) DEFAULT NULL,
  `primerNombre` varchar(60) NOT NULL,
  `segundoNombre` varchar(60) DEFAULT NULL,
  `correoInstitucional` char(200) DEFAULT NULL,
  `correoPersonal` varchar(200) DEFAULT NULL,
  `cedulaIdentidad` char(10) NOT NULL,
  `ruc` char(13) DEFAULT NULL,
  `estado` char(1) NOT NULL DEFAULT 'A' COMMENT '''A:activo I:inactivo''',
  PRIMARY KEY (`persona`),
  UNIQUE KEY `mae_persona_UNcedula` (`cedulaIdentidad`),
  UNIQUE KEY `mae_persona_UNcorreoInstitucional` (`correoInstitucional`),
  FULLTEXT KEY `mae_persona_nombreCompleto_IDX` (`nombreCompleto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mae_persona`
--

LOCK TABLES `mae_persona` WRITE;
/*!40000 ALTER TABLE `mae_persona` DISABLE KEYS */;
INSERT INTO `mae_persona` VALUES ('00000002','a','a','a','a','a','a','a','a','a','A'),('00000003','Armijos Enriquez Beatriz Elizabeth','Armijos','Enriquez','Beatriz','Elizabeth','barmijose@educacion.gob.ec','beatriz20elizabeth@hotmail.com','140001254','ddd','A'),('00000004','Zárate Ponce Frederich Daniel','Zárate','Ponce','d','ddd','j','j','j','j','A'),('00000005','Orellana  Esteban ','Orellana','','Esteban','','n','n','n','n','A'),('00000006','Pipiolo','p','p','p','p','p','p','p','p','A'),('00000007','o o o o','o','o','o','o','o','o','oo','o','A'),('00000008','CalderÃ³n Toral Fernando Oswaldo','CalderÃ³n','Toral','Fernando','Oswaldo','fcalderont@ucacue.edu.ec','patas@hotmail.com','01235656','012','A'),('00000009','gg g f g','gg','g','f','g','g','g','g','g','A'),('00000010','m m m m','m','m','m','m','m','m','m','m','A'),('00000011','v v  v','v','v','','v','v','v','vv','v','A'),('00000012','z z z z','z','z','z','z','z','z','z','z','A'),('00000013','Erazo Mosquera PlÃ¡cido Augusto','Erazo','Mosquera','PlÃ¡cido','Augusto','perazom@ucacue.edu.ec','placido@hotmail.com','12457896','','A'),('00000014','Erazo er er er','Erazo','er','er','er','er','er','er','','A'),('00000015','67 67 67 67','67','67','67','67','67m,,','67,,,','67','67','A'),('00000016','Armijosmi mi mi mi','Armijosmi','mi','mi','mi','mi','mi','mi','mi','A'),('00000017','Ã±l Ã±l Ã±l Ã±l','Ã±l','Ã±l','Ã±l','Ã±l','lÃ±','Ã±l','Ã±l','Ã±l','A'),('00000018','req req erwq req','req','req','erwq','req','req','req','reqw','reqw','A'),('00000019','nmnm nmnmn mnmn nmnmnm','nmnm','nmnmn','mnmn','nmnmnm','nmnm','nmnmn','mnmn','nmnmn','A'),('00000020','ccccccccccccccc ccccccccccc cccccccccccccc cccccccccccccccccccc','ccccccccccccccc','ccccccccccc','cccccccccccccc','cccccccccccccccccccc','cccccccccccccccccccc','ccccccccccccc','cccccccccc','ccccccccccccc','A'),('00000021','vbvbvbvb vbvbv vbvbvb vbvbvb','vbvbvbvb','vbvbv','vbvbvb','vbvbvb','vbvbvbvb','vbvbvb','vbvbvb','vbvbv','A'),('00000022','ffgfgfgfgfg  fgfgfgfgfgf fgfgfgfgfgfg','ffgfgfgfgfg','','fgfgfgfgfgf','fgfgfgfgfgfg','fgfgfgfgf','fgfgfgf','fgfgfgfgf','fgfgfg','A'),('00000023','lÃ±lÃ±lÃ±l lÃ±lÃ±lÃ± Ã±lÃ±lÃ±l Ã±lÃ±lÃ±l','lÃ±lÃ±lÃ±l','lÃ±lÃ±lÃ±','Ã±lÃ±lÃ±l','Ã±lÃ±lÃ±l','lÃ±lÃ±l','lÃ±lÃ±l','lÃ±lÃ±l','lÃ±lÃ±','A'),('00000024','k k kkkkkkkkkkkk kkkkkkkkkkk','k','k','kkkkkkkkkkkk','kkkkkkkkkkk','k','k','k','k','A'),('00000025','tyty tyty tyty tyty','tyty','tyty','tyty','tyty','tyty','tyty','tyty','tyty','A'),('00000026','zxcv zxcv zxcv zcv','zxcv','zxcv','zxcv','zcv','zxcv','zxcv','zxcv','zxcv','A'),('00000027','Aristizabalsss Escobarss Juansss Estebansss','Aristizabalsss','Escobarss','Juansss','Estebansss','jaristizabal@ucacue.edu.ec','juanes@musica.com','789','','A'),('00000028','111111111111111 11111111111111111 111111111111 1111111111111','111111111111111','11111111111111111','111111111111','1111111111111','11111111111111','111111111111111','1111111111','111111111111','A'),('00000030','Guerra Paz Juan Luis','Guerra','Paz','Juan','Luis','jguerrap@ucacue.edu.ec','juanluis@440.com','100000','','A'),('00000031','ggggggggggggggg gggggggggggggg ggggggggggg gggggggggggg','ggggggggggggggg','gggggggggggggg','ggggggggggg','gggggggggggg','ggggggggggggggggggggg','gggggggggggggggg','gggggggggg','g','A'),('00000032','iii iii iiiiii iii','iii','iii','iiiiii','iii','iii','iii','iii','iii','A'),('00000033','ZÃ¡rate Flor Mateo SebastiÃ¡n','ZÃ¡rate','Flor','Mateo','SebastiÃ¡n','mzaratef@ucacue.edu.ec','choloquerido@hotmail.com','45','','A'),('00000034','Serrano Prado Segundo Humberto','Serrano','Prado','Segundo','Humberto','sserranop@ucacue.edu.ec','segundo@hotmail.com','012345','','A'),('00000035','ju ju ju ju','ju','ju','ju','ju','ju','ju','ju','ju','A'),('00000036','rere rere rere rere','rere','rere','rere','rere','rere','rere','rere','rere','A'),('00000037','koko koko koko koko','koko','koko','koko','koko','koko','koko','koko','koko','A'),('00000038','Valverde Minchala Boris ','Valverde','Minchala','Boris','','lolo','lolo','lolo','lolo','A'),('00000039','34 34 34 34','34','34','34','34','34','34','34','34','A'),('00000040','Messi dd Marcelo Leonel','Messi','dd','Marcelo','Leonel','d','d','d','d','A'),('00000041','vb vb vb vb','vb','vb','vb','vb','vb','vb','vb','vb','A'),('00000042','pario gata cuatro gatitos','pario','gata','cuatro','gatitos','daf','adf','adsf','adf','A'),('00000043','dasf sdfa asdf asdf','dasf','sdfa','asdf','asdf','sfda','sdaf','asdf','dsafas','A'),('00000044','pou po poui pou','pou','po','poui','pou','pou','po','po','po','A'),('00000045','uyuy uyuy uyuy uyuy','uyuy','uyuy','uyuy','uyuy','yuyu','yuy','yuy','uy','A'),('00000046','apellido seg nombre otro','apellido','seg','nombre','otro','dasf','qq','qq','qq','A'),('00000047','xd xd xd xd','xd','xd','xd','xd','xd','xd','xd','xd','A'),('00000048','84 84 84 84','84','84','84','84','84','84','84','84','A'),('00000049','24 24 24 24','24','24','24','24','24','24','24','24','A'),('00000050','maria maria maria maria','maria','maria','maria','maria','maria','mair','ma','a','A');
/*!40000 ALTER TABLE `mae_persona` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'IGNORE_SPACE,STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER pruebas.mae_persona_auditoria
BEFORE UPDATE
ON pruebas.mae_persona FOR EACH ROW
insert into mae_persona_aud (persona,nombreCompleto_old,primerNombre_old,segundoNombre_old,apellidoPaterno_old,
apellidoMaterno_old,correoInstitucional_old,correoPersonal_old,cedulaIdentidad_old,ruc_old,
estado_old,
nombreCompleto_new,primerNombre_new,segundoNombre_new,apellidoPaterno_new,apellidoMaterno_new,
correoInstitucional_new,correoPersonal_new,cedulaIdentidad_new,ruc_new,estado_new
,fecha,accion)
VALUES (old.persona, OLD.nombreCompleto,OLD.primerNombre,OLD.segundoNombre,OLD.apellidoPaterno,OLD.apellidoMaterno,
OLD.correoInstitucional,OLD.correoPersonal,OLD.cedulaIdentidad,OLD.ruc,OLD.estado,
NEW.nombreCompleto,NEW.primerNombre,NEW.segundoNombre,NEW.apellidoPaterno,NEW.apellidoMaterno,
NEW.correoInstitucional,NEW.correoPersonal,NEW.cedulaIdentidad,NEW.ruc,NEW.estado,
NOW() ,'U'
) */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `mae_persona_aud`
--

DROP TABLE IF EXISTS `mae_persona_aud`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mae_persona_aud` (
  `persona_aud` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `persona` char(8) NOT NULL,
  `nombreCompleto_old` varchar(243) DEFAULT NULL,
  `apellidoPaterno_old` varchar(60) DEFAULT NULL,
  `apellidoMaterno_old` varchar(60) DEFAULT NULL,
  `primerNombre_old` varchar(60) DEFAULT NULL,
  `segundoNombre_old` varchar(60) DEFAULT NULL,
  `correoInstitucional_old` char(200) DEFAULT NULL,
  `correoPersonal_old` varchar(200) DEFAULT NULL,
  `cedulaIdentidad_old` char(10) DEFAULT NULL,
  `ruc_old` char(13) DEFAULT NULL,
  `estado_old` char(1) DEFAULT 'A' COMMENT '''A:activo I:inactivo''',
  `nombreCompleto_new` varchar(243) DEFAULT NULL,
  `apellidoPaterno_new` varchar(60) DEFAULT NULL,
  `apellidoMaterno_new` varchar(60) DEFAULT NULL,
  `primerNombre_new` varchar(60) DEFAULT NULL,
  `segundoNombre_new` varchar(60) DEFAULT NULL,
  `correoInstitucional_new` varchar(200) DEFAULT NULL,
  `correoPersonal_new` varchar(200) DEFAULT NULL,
  `cedulaIdentidad_new` varchar(100) DEFAULT NULL,
  `ruc_new` varchar(13) DEFAULT NULL,
  `estado_new` varchar(1) DEFAULT NULL,
  `fecha` datetime NOT NULL,
  `usuario` varchar(60) NOT NULL DEFAULT 'system',
  `accion` char(1) NOT NULL COMMENT '(I)nsert,(U)pdate,(D)elete',
  PRIMARY KEY (`persona_aud`),
  KEY `mae_persona_aud_persona_IDX` (`persona`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mae_persona_aud`
--

LOCK TABLES `mae_persona_aud` WRITE;
/*!40000 ALTER TABLE `mae_persona_aud` DISABLE KEYS */;
INSERT INTO `mae_persona_aud` VALUES (1,'00000004','dd d dd d ddd','dd','d dd','d','ddd','j','j','j','j','A','Zárate Ponce Frederich Daniel','dd','d dd','d','ddd','j','j','j','j','A','2017-10-23 00:00:00','system','U'),(2,'00000004','Zárate Ponce Frederich Daniel','dd','d dd','d','ddd','j','j','j','j','A','Zárate Ponce Frederich Daniel','Zárate','Ponce','d','ddd','j','j','j','j','A','2017-10-23 00:00:00','system','U'),(3,'00000006','p p p p','p','p','p','p','p','p','p','p','A','Pipiolo','p','p','p','p','p','p','p','p','A','2017-10-23 21:38:04','system','U');
/*!40000 ALTER TABLE `mae_persona_aud` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mae_sede`
--

DROP TABLE IF EXISTS `mae_sede`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mae_sede` (
  `sede` tinyint(4) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `alias` varchar(10) NOT NULL,
  `estado` char(1) NOT NULL DEFAULT 'A',
  PRIMARY KEY (`sede`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mae_sede`
--

LOCK TABLES `mae_sede` WRITE;
/*!40000 ALTER TABLE `mae_sede` DISABLE KEYS */;
INSERT INTO `mae_sede` VALUES (1,'Matriz','CUE','A');
/*!40000 ALTER TABLE `mae_sede` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mae_semestre`
--

DROP TABLE IF EXISTS `mae_semestre`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mae_semestre` (
  `semestre` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `alias` char(10) NOT NULL,
  `estado` char(1) NOT NULL DEFAULT 'A',
  `vigente` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`semestre`),
  UNIQUE KEY `mae_semestreNombre_UN` (`nombre`),
  UNIQUE KEY `mae_semestreAlias_UN` (`alias`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mae_semestre`
--

LOCK TABLES `mae_semestre` WRITE;
/*!40000 ALTER TABLE `mae_semestre` DISABLE KEYS */;
INSERT INTO `mae_semestre` VALUES (1,'Marzo 2017 - Agosto 2017','20162','A',0),(2,'Septiembre 2017 - Febrero 2018','20171','A',1);
/*!40000 ALTER TABLE `mae_semestre` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `per_cargo`
--

DROP TABLE IF EXISTS `per_cargo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `per_cargo` (
  `cargo` char(3) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  PRIMARY KEY (`cargo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `per_cargo`
--

LOCK TABLES `per_cargo` WRITE;
/*!40000 ALTER TABLE `per_cargo` DISABLE KEYS */;
INSERT INTO `per_cargo` VALUES ('001','Docente Tiempo Completo'),('002','Docente medio tiempo');
/*!40000 ALTER TABLE `per_cargo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `per_trabajador`
--

DROP TABLE IF EXISTS `per_trabajador`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `per_trabajador` (
  `persona` char(8) NOT NULL,
  `cargo` char(3) NOT NULL,
  PRIMARY KEY (`persona`),
  KEY `per_trabajador_per_cargo_FK` (`cargo`),
  CONSTRAINT `per_trabajador_mae_persona_FK` FOREIGN KEY (`persona`) REFERENCES `mae_persona` (`persona`) ON UPDATE CASCADE,
  CONSTRAINT `per_trabajador_per_cargo_FK` FOREIGN KEY (`cargo`) REFERENCES `per_cargo` (`cargo`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `per_trabajador`
--

LOCK TABLES `per_trabajador` WRITE;
/*!40000 ALTER TABLE `per_trabajador` DISABLE KEYS */;
INSERT INTO `per_trabajador` VALUES ('00000005','001'),('00000008','001'),('00000027','001'),('00000030','001'),('00000033','001'),('00000034','001'),('00000035','001'),('00000038','001'),('00000039','001'),('00000040','001'),('00000042','001'),('00000043','001'),('00000044','001'),('00000045','001'),('00000046','001'),('00000047','001'),('00000003','002');
/*!40000 ALTER TABLE `per_trabajador` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sys_errorLog`
--

DROP TABLE IF EXISTS `sys_errorLog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sys_errorLog` (
  `error` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `errorNumber` int(10) unsigned NOT NULL,
  `errorDescription` varchar(100) DEFAULT NULL,
  `fecha` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modulo` char(3) NOT NULL,
  `interfaz` char(3) NOT NULL,
  PRIMARY KEY (`error`),
  KEY `sysError_modulo_IDX` (`modulo`,`interfaz`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sys_errorLog`
--

LOCK TABLES `sys_errorLog` WRITE;
/*!40000 ALTER TABLE `sys_errorLog` DISABLE KEYS */;
/*!40000 ALTER TABLE `sys_errorLog` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sys_interfaz`
--

DROP TABLE IF EXISTS `sys_interfaz`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sys_interfaz` (
  `interfaz` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `modulo` int(10) unsigned NOT NULL,
  `estado` char(1) NOT NULL DEFAULT 'A',
  `file` varchar(100) NOT NULL,
  PRIMARY KEY (`interfaz`),
  KEY `sys_interfaz_sys_modulo_FK` (`modulo`),
  KEY `sys_interfaz_interfaz_IDX` (`interfaz`,`nombre`) USING BTREE,
  CONSTRAINT `sys_interfaz_sys_modulo_FK` FOREIGN KEY (`modulo`) REFERENCES `sys_modulo` (`modulo`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sys_interfaz`
--

LOCK TABLES `sys_interfaz` WRITE;
/*!40000 ALTER TABLE `sys_interfaz` DISABLE KEYS */;
INSERT INTO `sys_interfaz` VALUES (1,'Mantenimiento',1,'A','trabajador.php'),(2,'Mantenimiento',2,'A','matricula.php');
/*!40000 ALTER TABLE `sys_interfaz` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sys_modulo`
--

DROP TABLE IF EXISTS `sys_modulo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sys_modulo` (
  `modulo` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `estado` char(1) NOT NULL DEFAULT 'A',
  PRIMARY KEY (`modulo`),
  UNIQUE KEY `sys_modulo_UN` (`nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sys_modulo`
--

LOCK TABLES `sys_modulo` WRITE;
/*!40000 ALTER TABLE `sys_modulo` DISABLE KEYS */;
INSERT INTO `sys_modulo` VALUES (1,'Trabajadores','A'),(2,'Matrículas','A');
/*!40000 ALTER TABLE `sys_modulo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sys_nivelUsuario`
--

DROP TABLE IF EXISTS `sys_nivelUsuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sys_nivelUsuario` (
  `nivelUsuario` char(3) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `estado` char(1) NOT NULL DEFAULT 'A' COMMENT '''A:activo I:Inactivo''',
  PRIMARY KEY (`nivelUsuario`),
  UNIQUE KEY `sys_nivelUsuario_UN` (`nombre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sys_nivelUsuario`
--

LOCK TABLES `sys_nivelUsuario` WRITE;
/*!40000 ALTER TABLE `sys_nivelUsuario` DISABLE KEYS */;
INSERT INTO `sys_nivelUsuario` VALUES ('000','root','A');
/*!40000 ALTER TABLE `sys_nivelUsuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sys_usuario`
--

DROP TABLE IF EXISTS `sys_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sys_usuario` (
  `usuario` char(10) NOT NULL,
  `persona` char(8) NOT NULL,
  `password` varchar(100) NOT NULL,
  `estado` char(1) NOT NULL DEFAULT 'A',
  PRIMARY KEY (`usuario`),
  UNIQUE KEY `sys_usuario_UN` (`persona`),
  KEY `sys_usuario_usuario_IDX` (`usuario`) USING BTREE,
  KEY `sys_usuario_persona_IDX` (`persona`) USING BTREE,
  CONSTRAINT `sys_usuario_mae_persona_FK` FOREIGN KEY (`persona`) REFERENCES `mae_persona` (`persona`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sys_usuario`
--

LOCK TABLES `sys_usuario` WRITE;
/*!40000 ALTER TABLE `sys_usuario` DISABLE KEYS */;
INSERT INTO `sys_usuario` VALUES ('mzarate','00000002','mauito','A');
/*!40000 ALTER TABLE `sys_usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sys_usuarioInterfaz`
--

DROP TABLE IF EXISTS `sys_usuarioInterfaz`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sys_usuarioInterfaz` (
  `usuario` char(10) NOT NULL,
  `interfaz` int(10) unsigned NOT NULL,
  `canInsert` tinyint(1) NOT NULL DEFAULT '0',
  `canEdit` tinyint(1) NOT NULL DEFAULT '0',
  `canDelete` tinyint(1) NOT NULL DEFAULT '0',
  `nivelUsuario` char(3) DEFAULT NULL,
  PRIMARY KEY (`usuario`,`interfaz`),
  KEY `sys_usuarioInterfaz_sys_interfaz_FK` (`interfaz`),
  KEY `sys_usuarioInterfaz_sys_nivelUsuario_FK` (`nivelUsuario`),
  CONSTRAINT `sys_usuarioInterfaz_sys_interfaz_FK` FOREIGN KEY (`interfaz`) REFERENCES `sys_interfaz` (`interfaz`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `sys_usuarioInterfaz_sys_nivelUsuario_FK` FOREIGN KEY (`nivelUsuario`) REFERENCES `sys_nivelUsuario` (`nivelUsuario`) ON UPDATE CASCADE,
  CONSTRAINT `sys_usuarioInterfaz_sys_usuario_FK` FOREIGN KEY (`usuario`) REFERENCES `sys_usuario` (`usuario`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sys_usuarioInterfaz`
--

LOCK TABLES `sys_usuarioInterfaz` WRITE;
/*!40000 ALTER TABLE `sys_usuarioInterfaz` DISABLE KEYS */;
INSERT INTO `sys_usuarioInterfaz` VALUES ('mzarate',1,1,1,1,'000'),('mzarate',2,1,1,1,'000');
/*!40000 ALTER TABLE `sys_usuarioInterfaz` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `v_acaAlumno`
--

DROP TABLE IF EXISTS `v_acaAlumno`;
/*!50001 DROP VIEW IF EXISTS `v_acaAlumno`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `v_acaAlumno` (
  `persona` tinyint NOT NULL,
  `nombreCompleto` tinyint NOT NULL,
  `condicion` tinyint NOT NULL,
  `primerNombre` tinyint NOT NULL,
  `segundoNombre` tinyint NOT NULL,
  `apellidoPaterno` tinyint NOT NULL,
  `apellidoMaterno` tinyint NOT NULL,
  `correoInstitucional` tinyint NOT NULL,
  `correoPersonal` tinyint NOT NULL,
  `cedulaIdentidad` tinyint NOT NULL,
  `ruc` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `v_perTrabajador`
--

DROP TABLE IF EXISTS `v_perTrabajador`;
/*!50001 DROP VIEW IF EXISTS `v_perTrabajador`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `v_perTrabajador` (
  `persona` tinyint NOT NULL,
  `nombreCompleto` tinyint NOT NULL,
  `cargo` tinyint NOT NULL,
  `primerNombre` tinyint NOT NULL,
  `segundoNombre` tinyint NOT NULL,
  `apellidoPaterno` tinyint NOT NULL,
  `apellidoMaterno` tinyint NOT NULL,
  `correoInstitucional` tinyint NOT NULL,
  `correoPersonal` tinyint NOT NULL,
  `cedulaIdentidad` tinyint NOT NULL,
  `ruc` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Final view structure for view `v_acaAlumno`
--

/*!50001 DROP TABLE IF EXISTS `v_acaAlumno`*/;
/*!50001 DROP VIEW IF EXISTS `v_acaAlumno`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `v_acaAlumno` AS select `a`.`persona` AS `persona`,`p`.`nombreCompleto` AS `nombreCompleto`,`a`.`condicion` AS `condicion`,`p`.`primerNombre` AS `primerNombre`,`p`.`segundoNombre` AS `segundoNombre`,`p`.`apellidoPaterno` AS `apellidoPaterno`,`p`.`apellidoMaterno` AS `apellidoMaterno`,`p`.`correoInstitucional` AS `correoInstitucional`,`p`.`correoPersonal` AS `correoPersonal`,`p`.`cedulaIdentidad` AS `cedulaIdentidad`,`p`.`ruc` AS `ruc` from (`aca_alumno` `a` join `mae_persona` `p` on((`a`.`persona` = `p`.`persona`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `v_perTrabajador`
--

/*!50001 DROP TABLE IF EXISTS `v_perTrabajador`*/;
/*!50001 DROP VIEW IF EXISTS `v_perTrabajador`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `v_perTrabajador` AS select `t`.`persona` AS `persona`,`p`.`nombreCompleto` AS `nombreCompleto`,`t`.`cargo` AS `cargo`,`p`.`primerNombre` AS `primerNombre`,`p`.`segundoNombre` AS `segundoNombre`,`p`.`apellidoPaterno` AS `apellidoPaterno`,`p`.`apellidoMaterno` AS `apellidoMaterno`,`p`.`correoInstitucional` AS `correoInstitucional`,`p`.`correoPersonal` AS `correoPersonal`,`p`.`cedulaIdentidad` AS `cedulaIdentidad`,`p`.`ruc` AS `ruc` from (`per_trabajador` `t` join `mae_persona` `p` on((`t`.`persona` = `p`.`persona`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-04-25 20:47:33
