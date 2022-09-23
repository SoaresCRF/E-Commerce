CREATE DATABASE  IF NOT EXISTS `ecommerce` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `ecommerce`;
-- MySQL dump 10.13  Distrib 8.0.30, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: ecommerce
-- ------------------------------------------------------
-- Server version	8.0.30

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
-- Table structure for table `carrinho`
--

DROP TABLE IF EXISTS `carrinho`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `carrinho` (
  `cpf` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `cod_produto` int unsigned NOT NULL,
  `quantidade` int unsigned NOT NULL,
  `total` int unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carrinho`
--

LOCK TABLES `carrinho` WRITE;
/*!40000 ALTER TABLE `carrinho` DISABLE KEYS */;
INSERT INTO `carrinho` VALUES ('69360810886',11,1,6),('69360810886',4,1,10),('69360810886',27,1,2000);
/*!40000 ALTER TABLE `carrinho` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clientes_cadastrados`
--

DROP TABLE IF EXISTS `clientes_cadastrados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `clientes_cadastrados` (
  `nome_cliente` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `cpf` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `celular` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `data_nasc` date NOT NULL,
  `sexo` varchar(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `cep` varchar(8) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `estado` varchar(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `cidade` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `bairro` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `rua` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `numero_casa` varchar(7) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `senha` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `data_cadastro` datetime NOT NULL,
  `cargo` varchar(7) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'cliente',
  PRIMARY KEY (`cpf`),
  UNIQUE KEY `cpf_UNIQUE` (`cpf`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  UNIQUE KEY `username_UNIQUE` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clientes_cadastrados`
--

LOCK TABLES `clientes_cadastrados` WRITE;
/*!40000 ALTER TABLE `clientes_cadastrados` DISABLE KEYS */;
INSERT INTO `clientes_cadastrados` VALUES ('Matheus Soares','09660138598','matheussoares@hotmail.com','75911111111','2001-03-02','H','91530010','RS','Porto Alegre','Partenon','Rua Albion','57','soarescrf','Matheus123@','2022-07-23 12:24:40','cliente'),('Marcos Vinícius','69360810886','marcosvinicius@hotmail.com','11988347653','1990-07-12','H','03544090','SP','São Paulo','Cidade Patriarca','Praça Divinolândia','54','marcos123','Marcos123@','2022-07-23 12:49:26','cliente');
/*!40000 ALTER TABLE `clientes_cadastrados` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `controle_venda`
--

DROP TABLE IF EXISTS `controle_venda`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `controle_venda` (
  `cod_produto` int unsigned NOT NULL,
  `cpf_cliente` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nome_produto` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `fornecedor` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `valor_venda` double unsigned NOT NULL,
  `qtd_comprada` int unsigned NOT NULL,
  `total_venda` double unsigned NOT NULL,
  `data_venda` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `controle_venda`
--

LOCK TABLES `controle_venda` WRITE;
/*!40000 ALTER TABLE `controle_venda` DISABLE KEYS */;
INSERT INTO `controle_venda` VALUES (40,'09660138598','Battlefield','Electronic Arts',350,3,1050,'2022-07-23'),(16,'09660138598','Espumante s/ alcool','Freixenet',17,1,17,'2022-07-23'),(14,'69360810886','Cachaça','Saliníssima',15,3,45,'2022-07-23'),(17,'69360810886','Galaxy S20','samsung',2000,3,6000,'2022-07-23'),(22,'69360810886','Galaxy S22 plus','samsung',5000,1,5000,'2022-07-23'),(23,'69360810886','Iphone 13','Apple',5000,1,5000,'2022-07-23'),(40,'69360810886','Battlefield','Electronic Arts',350,2,700,'2022-07-23'),(1,'09660138598','Macarrão','Barilla',8,2,16,'2022-09-19'),(40,'09660138598','Battlefield','Electronic Arts',350,8,2800,'2022-09-20'),(34,'09660138598','FIFA 19','EA Sports',250,1,250,'2022-09-20'),(14,'09660138598','Cachaça','Saliníssima',15,6,90,'2022-09-20'),(1,'09660138598','Macarrão','Barilla',8,1,8,'2022-09-20'),(11,'09660138598','Cerveja puro malte','Spaten',6,2,12,'2022-09-20'),(13,'09660138598','Cachaça 150 anos','Ypióca',70,2,140,'2022-09-20'),(27,'09660138598','Core I5 - 6ª Geração','intel',2000,1,2000,'2022-09-20'),(36,'09660138598','God of war','sony',200,1,200,'2022-09-20'),(35,'09660138598','CSGO','VALVE',60,1,60,'2022-09-20'),(15,'09660138598','Espumante','Casa Perini',12,2,24,'2022-09-20');
/*!40000 ALTER TABLE `controle_venda` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `funcionarios`
--

DROP TABLE IF EXISTS `funcionarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `funcionarios` (
  `usuario_id` int unsigned NOT NULL AUTO_INCREMENT,
  `usuario` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `senha` varchar(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '123',
  `cargo` varchar(7) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`usuario_id`),
  UNIQUE KEY `usuario_UNIQUE` (`usuario`),
  UNIQUE KEY `usuario_id_UNIQUE` (`usuario_id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `funcionarios`
--

LOCK TABLES `funcionarios` WRITE;
/*!40000 ALTER TABLE `funcionarios` DISABLE KEYS */;
INSERT INTO `funcionarios` VALUES (1,'admin','123','gerente',1),(26,'dono','123','dono',1);
/*!40000 ALTER TABLE `funcionarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pedidos_concluidos`
--

DROP TABLE IF EXISTS `pedidos_concluidos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pedidos_concluidos` (
  `cpf_cliente` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `cod_produto` int unsigned NOT NULL,
  `nome_produto` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `fornecedor` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `qtd_comprada` int unsigned NOT NULL,
  `total_comprado` double unsigned NOT NULL,
  `data_compra` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pedidos_concluidos`
--

LOCK TABLES `pedidos_concluidos` WRITE;
/*!40000 ALTER TABLE `pedidos_concluidos` DISABLE KEYS */;
INSERT INTO `pedidos_concluidos` VALUES ('09660138598',15,'Espumante','Casa Perini',2,24,'2022-09-20');
/*!40000 ALTER TABLE `pedidos_concluidos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `produtos`
--

DROP TABLE IF EXISTS `produtos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `produtos` (
  `cod_produto` int unsigned NOT NULL,
  `nome_produto` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `fornecedor` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `custo_produto` double unsigned NOT NULL,
  `valor_venda` double unsigned NOT NULL,
  `estoque` int unsigned NOT NULL,
  `data_cadastro` date NOT NULL,
  `categoria` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  UNIQUE KEY `cod_produto_UNIQUE` (`cod_produto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produtos`
--

LOCK TABLES `produtos` WRITE;
/*!40000 ALTER TABLE `produtos` DISABLE KEYS */;
INSERT INTO `produtos` VALUES (1,'Macarrão','Barilla',3,8,34,'2022-07-23','Alimento'),(2,'Feijão carioca','Kicaldo',2,5,9,'2022-06-26','Alimento'),(3,'Arroz orgânico','Tio João',5,10,20,'2022-06-26','Alimento'),(4,'Ketchup','Hellmann\'s',5,10,16,'2022-06-26','Alimento'),(5,'Maionese','Heinz',5,10,18,'2022-06-26','Alimento'),(6,'Mostarda tradicional','Heinz',3,7,19,'2022-06-26','Alimento'),(7,'Ketchup','Heinz',4,7,21,'2022-06-26','Alimento'),(8,'Leite Condensado','Nestle',2,6,24,'2022-06-26','Alimento'),(9,'Gin','Tanqueray sevilla',2,6,19,'2022-06-26','Bebida'),(10,'Gin','Apogee',2,7,19,'2022-06-26','Bebida'),(11,'Cerveja puro malte','Spaten',2,6,21,'2022-06-26','Bebida'),(12,'Cerveja','Budweiser',2,8,14,'2022-06-26','Bebida'),(13,'Cachaça 150 anos','Ypióca',3,70,18,'2022-06-26','Bebida'),(14,'Cachaça','Saliníssima',2,15,11,'2022-06-26','Bebida'),(15,'Espumante','Casa Perini',4,12,23,'2022-06-26','Bebida'),(16,'Espumante s/ alcool','Freixenet',4,17,17,'2022-06-26','Bebida'),(17,'Galaxy S20','samsung',1000,2000,96,'2022-06-26','Celular'),(18,'Poco F3','xiaomi',1200,2500,98,'2022-06-26','Celular'),(19,'LG K10','LG',500,900,49,'2022-06-26','Celular'),(20,'Moto Z2 Play','Motorola',500,1250,66,'2022-06-26','Celular'),(21,'Poco X3 PRO','xiaomi',1200,2400,59,'2022-06-26','Celular'),(22,'Galaxy S22 plus','samsung',2000,5000,79,'2022-06-26','Celular'),(23,'Iphone 13','Apple',1000,5000,54,'2022-06-26','Celular'),(24,'Iphone 13 PRO MAX','apple',1500,7000,99,'2022-06-26','Celular'),(25,'RTX 2080','nvidia',1000,2400,56,'2022-06-26','Hardware'),(26,'RTX 3080','nvidia',1400,3500,41,'2022-06-26','Hardware'),(27,'Core I5 - 6ª Geração','intel',1000,2000,10,'2022-06-26','Hardware'),(28,'Core I9 - 12ª Geração','Intel',2000,4000,40,'2022-06-26','Hardware'),(29,'SSD 128 GB','Kingston',100,350,13,'2022-06-26','Hardware'),(30,'SSD 256 GB','Kingston',200,500,9,'2022-06-26','Hardware'),(31,'Ryzen threadripper PRO','AMD',1000,3000,52,'2022-06-26','Hardware'),(32,'Ryzen 5600','AMD',1000,3000,12,'2022-06-26','Hardware'),(33,'FIFA 22','EA Sports',100,250,14,'2022-06-26','Jogo'),(34,'FIFA 19','EA Sports',100,250,17,'2022-06-26','Jogo'),(35,'CSGO','VALVE',15,60,52,'2022-06-26','Jogo'),(36,'God of war','sony',40,200,14,'2022-06-26','Jogo'),(37,'League of legends','Riot games',12,20,16,'2022-06-26','Jogo'),(38,'Minecraft','mojang',15,100,99,'2022-06-26','Jogo'),(39,'UFC 22','EA Sports',50,250,97,'2022-06-26','Jogo'),(40,'Battlefield','Electronic Arts',80,350,15,'2022-06-26','Jogo');
/*!40000 ALTER TABLE `produtos` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-09-23 16:01:40
