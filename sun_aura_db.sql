-- MySQL dump 10.13  Distrib 8.0.22, for Linux (x86_64)
--
-- Host: localhost    Database: sun_aura_db
-- ------------------------------------------------------
-- Server version	8.0.22-0ubuntu0.20.04.3

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `aura_color_longcloudyday`
--

DROP TABLE IF EXISTS `aura_color_longcloudyday`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `aura_color_longcloudyday` (
  `id` int NOT NULL AUTO_INCREMENT,
  `colors` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `aura_color_longcloudyday`
--

LOCK TABLES `aura_color_longcloudyday` WRITE;
/*!40000 ALTER TABLE `aura_color_longcloudyday` DISABLE KEYS */;
INSERT INTO `aura_color_longcloudyday` VALUES (1,'16624a 1c5972'),(2,'623e16 72651c'),(3,'165d62 571935'),(6,'781a48 0f562d'),(7,'105c53 21266d');
/*!40000 ALTER TABLE `aura_color_longcloudyday` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `aura_color_longsunnyday`
--

DROP TABLE IF EXISTS `aura_color_longsunnyday`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `aura_color_longsunnyday` (
  `id` int NOT NULL AUTO_INCREMENT,
  `colors` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `aura_color_longsunnyday`
--

LOCK TABLES `aura_color_longsunnyday` WRITE;
/*!40000 ALTER TABLE `aura_color_longsunnyday` DISABLE KEYS */;
INSERT INTO `aura_color_longsunnyday` VALUES (1,'3abd77 2f6cbb 4fc317'),(9,'70961d 67358a 1ec63e'),(11,'43b2ba a219c0 2ef05c');
/*!40000 ALTER TABLE `aura_color_longsunnyday` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `aura_color_shortcloudyday`
--

DROP TABLE IF EXISTS `aura_color_shortcloudyday`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `aura_color_shortcloudyday` (
  `id` int NOT NULL AUTO_INCREMENT,
  `colors` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `aura_color_shortcloudyday`
--

LOCK TABLES `aura_color_shortcloudyday` WRITE;
/*!40000 ALTER TABLE `aura_color_shortcloudyday` DISABLE KEYS */;
INSERT INTO `aura_color_shortcloudyday` VALUES (1,'363857 203428'),(2,'343320 2e5b56'),(3,'5b2e2e 452626'),(5,'4d4753 3f4a44'),(7,'303131 212539');
/*!40000 ALTER TABLE `aura_color_shortcloudyday` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `aura_color_shortsunnyday`
--

DROP TABLE IF EXISTS `aura_color_shortsunnyday`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `aura_color_shortsunnyday` (
  `id` int NOT NULL AUTO_INCREMENT,
  `colors` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `aura_color_shortsunnyday`
--

LOCK TABLES `aura_color_shortsunnyday` WRITE;
/*!40000 ALTER TABLE `aura_color_shortsunnyday` DISABLE KEYS */;
INSERT INTO `aura_color_shortsunnyday` VALUES (1,'387245 4a8283 5367b4'),(2,'704676 a37354 6e6c4d'),(3,'7e4d6a 42766d 707646');
/*!40000 ALTER TABLE `aura_color_shortsunnyday` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `aura_image_duo`
--

DROP TABLE IF EXISTS `aura_image_duo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `aura_image_duo` (
  `id` int NOT NULL AUTO_INCREMENT,
  `layer` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `aura_image_duo`
--

LOCK TABLES `aura_image_duo` WRITE;
/*!40000 ALTER TABLE `aura_image_duo` DISABLE KEYS */;
INSERT INTO `aura_image_duo` VALUES (1,'duo01.png'),(2,'duo02.png'),(3,'duo03.png'),(4,'duo04.png'),(5,'duo05.png'),(6,'duo06.png'),(7,'duo07.png'),(8,'duo08.png'),(9,'duo09.png'),(10,'duo10.png'),(11,'duo11.png'),(12,'duo12.png'),(13,'duo13.png'),(14,'duo14.png'),(15,'duo15.png'),(16,'duo16.png'),(17,'duo17.png'),(18,'duo18.png'),(19,'duo19.png'),(20,'duo20.png');
/*!40000 ALTER TABLE `aura_image_duo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `aura_image_trio`
--

DROP TABLE IF EXISTS `aura_image_trio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `aura_image_trio` (
  `id` int NOT NULL AUTO_INCREMENT,
  `layer` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `aura_image_trio`
--

LOCK TABLES `aura_image_trio` WRITE;
/*!40000 ALTER TABLE `aura_image_trio` DISABLE KEYS */;
INSERT INTO `aura_image_trio` VALUES (1,'trio01.png'),(2,'trio02.png'),(3,'trio03.png'),(4,'trio04.png'),(5,'trio05.png'),(6,'trio06.png'),(7,'trio07.png'),(8,'trio08.png'),(9,'trio09.png'),(10,'trio10.png'),(11,'trio11.png'),(12,'trio12.png'),(13,'trio13.png'),(14,'trio14.png'),(15,'trio15.png'),(16,'trio16.png'),(17,'trio17.png'),(18,'trio18.png'),(19,'trio19.png'),(20,'trio20.png');
/*!40000 ALTER TABLE `aura_image_trio` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-12-11 20:25:50
