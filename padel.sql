CREATE DATABASE  IF NOT EXISTS `padel` /*!40100 DEFAULT CHARACTER SET utf8mb3 */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `padel`;
-- MySQL dump 10.13  Distrib 8.0.34, for Win64 (x86_64)
--
-- Host: localhost    Database: padel
-- ------------------------------------------------------
-- Server version	8.2.0

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `court`
--

DROP TABLE IF EXISTS `court`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `court` (
  `idcourt` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `img` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idcourt`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `court`
--

LOCK TABLES `court` WRITE;
/*!40000 ALTER TABLE `court` DISABLE KEYS */;
INSERT INTO `court` VALUES (1,'Master','padel1.jpeg'),(2,'Black Panter','padel1.jpeg'),(3,'Lion','padel1.jpeg'),(4,'Boluda','padel1.jpeg'),(5,'Devil','padel1.jpeg'),(6,'Copacabana','padel1.jpeg');
/*!40000 ALTER TABLE `court` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `play`
--

DROP TABLE IF EXISTS `play`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `play` (
  `iduser` int NOT NULL,
  `idreservation` int NOT NULL,
  `username` varchar(45) DEFAULT NULL,
  `idplay` int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`idplay`),
  KEY `fk_user_has_reservation_reservation1_idx` (`idreservation`),
  KEY `fk_user_has_reservation_user_idx` (`iduser`),
  CONSTRAINT `fk_user_has_reservation_reservation1` FOREIGN KEY (`idreservation`) REFERENCES `reservation` (`idreservation`),
  CONSTRAINT `fk_user_has_reservation_user` FOREIGN KEY (`iduser`) REFERENCES `user` (`iduser`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `play`
--

LOCK TABLES `play` WRITE;
/*!40000 ALTER TABLE `play` DISABLE KEYS */;
INSERT INTO `play` VALUES (2,1,'gabi',1),(2,1,'Pepe',2),(2,1,'Pedro',3),(2,2,'paco',6),(2,2,'Pedro',7),(2,2,'sofia',8),(2,2,'julio',9),(1,6,'sofia',11),(1,6,'s',12),(1,6,'gsfg',13),(1,6,'a',14),(1,8,'Tomas',19),(1,8,'lolo',20),(1,1,'sofia',21),(1,1,'sofia',22),(1,8,'paco',23),(1,8,'nico',24),(1,10,'nico',33),(1,10,'a',34),(1,10,'Pedro',35),(1,11,'nico',36),(1,11,'s',37),(1,12,'asdf',38),(1,12,'a',39),(1,16,'paco',45),(1,16,'raquel',46),(1,21,'sofia',47),(1,21,'gabi',48),(1,21,'pablo',49),(1,21,'adri',50),(1,10,'adri',51),(1,10,'adri',52),(1,16,'adri',53),(1,16,'adri',54);
/*!40000 ALTER TABLE `play` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reservation`
--

DROP TABLE IF EXISTS `reservation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reservation` (
  `idreservation` int NOT NULL AUTO_INCREMENT,
  `idtimetable` int NOT NULL,
  `idcourt` int NOT NULL,
  `date` datetime DEFAULT CURRENT_TIMESTAMP,
  `playdate` date DEFAULT NULL,
  PRIMARY KEY (`idreservation`),
  KEY `fk_reservation_timetable1_idx` (`idtimetable`),
  KEY `fk_reservation_court1_idx` (`idcourt`),
  CONSTRAINT `fk_reservation_court1` FOREIGN KEY (`idcourt`) REFERENCES `court` (`idcourt`),
  CONSTRAINT `fk_reservation_timetable1` FOREIGN KEY (`idtimetable`) REFERENCES `timetable` (`idtimetable`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reservation`
--

LOCK TABLES `reservation` WRITE;
/*!40000 ALTER TABLE `reservation` DISABLE KEYS */;
INSERT INTO `reservation` VALUES (1,3,1,'2024-05-08 19:26:12','2024-05-23'),(2,4,1,'2024-05-08 19:43:16','2024-05-25'),(4,5,2,'2024-05-08 20:04:20','2024-05-24'),(5,5,1,'2024-05-08 20:35:24','2024-05-08'),(6,6,1,'2024-05-09 15:54:30','2024-05-16'),(8,1,1,'2024-05-09 19:19:10','2024-05-09'),(10,4,4,'2024-05-09 20:21:52','2024-05-29'),(11,6,2,'2024-05-09 20:24:02','2024-05-30'),(12,7,6,'2024-05-09 20:24:22','2024-05-09'),(14,5,5,'2024-05-10 15:57:17','2024-05-10'),(15,5,5,'2024-05-10 15:57:24','2024-05-10'),(16,5,5,'2024-05-10 15:57:27','2024-05-10'),(17,6,2,'2024-05-10 16:01:19','2024-05-10'),(18,6,2,'2024-05-10 16:01:38','2024-05-10'),(19,6,2,'2024-05-10 16:02:06','2024-05-10'),(20,6,2,'2024-05-10 16:02:39','2024-05-10'),(21,5,3,'2024-05-10 16:30:19','2024-05-17'),(22,5,1,'2024-05-10 16:36:32','2024-05-10'),(23,5,1,'2024-05-10 16:36:57','2024-05-10'),(24,4,4,'2024-05-10 16:47:46','2024-05-10');
/*!40000 ALTER TABLE `reservation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `timetable`
--

DROP TABLE IF EXISTS `timetable`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `timetable` (
  `idtimetable` int NOT NULL AUTO_INCREMENT,
  `time` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idtimetable`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `timetable`
--

LOCK TABLES `timetable` WRITE;
/*!40000 ALTER TABLE `timetable` DISABLE KEYS */;
INSERT INTO `timetable` VALUES (1,'09:00-11:00'),(2,'11:00-13:00'),(3,'13:00-15:00'),(4,'15:00-17:00'),(5,'17:00-19:00'),(6,'19:00-21:00'),(7,'21:00-23:00');
/*!40000 ALTER TABLE `timetable` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `iduser` int NOT NULL AUTO_INCREMENT,
  `username` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`iduser`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'Sofi','sofia@hotmail.com','12345'),(2,'nico','nico@gmail.com','12345');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-05-10 16:52:04
