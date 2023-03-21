-- MySQL dump 10.13  Distrib 8.0.29, for Linux (x86_64)
--
-- Host: 10.9.1.218    Database: ITSSTG2023
-- ------------------------------------------------------
-- Server version	8.0.32

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
-- Table structure for table `amministrazione`
--

DROP TABLE IF EXISTS `amministrazione`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `amministrazione` (
  `id_amministrazione` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL DEFAULT 'admin',
  `password` varchar(255) NOT NULL DEFAULT 'admin',
  `ruoli` int DEFAULT '1',
  PRIMARY KEY (`id_amministrazione`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `amministrazione`
--

LOCK TABLES `amministrazione` WRITE;
/*!40000 ALTER TABLE `amministrazione` DISABLE KEYS */;
/*!40000 ALTER TABLE `amministrazione` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `aziende`
--

DROP TABLE IF EXISTS `aziende`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `aziende` (
  `id_azienda` int NOT NULL AUTO_INCREMENT,
  `ragione_sociale` varchar(45) NOT NULL,
  `piva` int NOT NULL,
  `codice_fiscale` varchar(45) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `cognome` varchar(45) NOT NULL,
  `telefono` int NOT NULL,
  `mail` varchar(45) NOT NULL,
  `indirizzo_azienda` varchar(45) NOT NULL,
  `data_creazione_profilo` datetime NOT NULL,
  `data_eliminazione_profilo` datetime DEFAULT NULL,
  `ruolo` int NOT NULL DEFAULT '2',
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id_azienda`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `aziende`
--

LOCK TABLES `aziende` WRITE;
/*!40000 ALTER TABLE `aziende` DISABLE KEYS */;
/*!40000 ALTER TABLE `aziende` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `privati`
--

DROP TABLE IF EXISTS `privati`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `privati` (
  `id_privato` int NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `cognome` varchar(45) NOT NULL,
  `telefono` int NOT NULL,
  PRIMARY KEY (`id_privato`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `privati`
--

LOCK TABLES `privati` WRITE;
/*!40000 ALTER TABLE `privati` DISABLE KEYS */;
/*!40000 ALTER TABLE `privati` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prodotti`
--

DROP TABLE IF EXISTS `prodotti`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `prodotti` (
  `id_prodotto` int NOT NULL AUTO_INCREMENT,
  `immagini` blob NOT NULL,
  `titolo` varchar(50) NOT NULL,
  `descrizione` text NOT NULL,
  `data_creazione` datetime NOT NULL,
  `data_fine` date DEFAULT NULL,
  `id_privato` int NOT NULL,
  PRIMARY KEY (`id_prodotto`),
  KEY `fk_prodotto_privato_idx` (`id_privato`),
  CONSTRAINT `fk_prodotto_privato` FOREIGN KEY (`id_privato`) REFERENCES `privati` (`id_privato`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prodotti`
--

LOCK TABLES `prodotti` WRITE;
/*!40000 ALTER TABLE `prodotti` DISABLE KEYS */;
/*!40000 ALTER TABLE `prodotti` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proposte_eliminate`
--

DROP TABLE IF EXISTS `proposte_eliminate`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `proposte_eliminate` (
  `id_azienda` int NOT NULL,
  `id_prodotto` int NOT NULL,
  PRIMARY KEY (`id_azienda`,`id_prodotto`),
  KEY `fk_proposte_eliminate_prodotto_idx` (`id_prodotto`),
  CONSTRAINT `fk_proposte_eliminate_azienda` FOREIGN KEY (`id_azienda`) REFERENCES `aziende` (`id_azienda`),
  CONSTRAINT `fk_proposte_eliminate_prodotto` FOREIGN KEY (`id_prodotto`) REFERENCES `prodotti` (`id_prodotto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proposte_eliminate`
--

LOCK TABLES `proposte_eliminate` WRITE;
/*!40000 ALTER TABLE `proposte_eliminate` DISABLE KEYS */;
/*!40000 ALTER TABLE `proposte_eliminate` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-02-21 12:38:57
