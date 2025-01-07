-- MySQL dump 10.13  Distrib 8.0.40, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: ProyectoDBRAUL
-- ------------------------------------------------------
-- Server version	9.1.0

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
-- Table structure for table `Carrito`
--

DROP TABLE IF EXISTS `Carrito`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Carrito` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `emailCarrito` varchar(45) DEFAULT NULL,
  `idproducto` int DEFAULT NULL,
  `cantidad` int DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Carrito`
--

LOCK TABLES `Carrito` WRITE;
/*!40000 ALTER TABLE `Carrito` DISABLE KEYS */;
INSERT INTO `Carrito` VALUES (15,'raul@gmail.com',1,1);
/*!40000 ALTER TABLE `Carrito` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Categoria`
--

DROP TABLE IF EXISTS `Categoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Categoria` (
  `IDcategoria` int NOT NULL,
  `nombreCategoria` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`IDcategoria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Categoria`
--

LOCK TABLES `Categoria` WRITE;
/*!40000 ALTER TABLE `Categoria` DISABLE KEYS */;
INSERT INTO `Categoria` VALUES (1,'Pizza'),(2,'Bebida'),(3,'Entrante');
/*!40000 ALTER TABLE `Categoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Descuento`
--

DROP TABLE IF EXISTS `Descuento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Descuento` (
  `IDdescuento` int NOT NULL,
  `Porcentaje` int DEFAULT NULL,
  PRIMARY KEY (`IDdescuento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Descuento`
--

LOCK TABLES `Descuento` WRITE;
/*!40000 ALTER TABLE `Descuento` DISABLE KEYS */;
INSERT INTO `Descuento` VALUES (1,0),(2,15),(3,5);
/*!40000 ALTER TABLE `Descuento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Pedido`
--

DROP TABLE IF EXISTS `Pedido`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Pedido` (
  `IDpedido` int NOT NULL AUTO_INCREMENT,
  `emailusuario` varchar(45) DEFAULT NULL,
  `Fechapedido` datetime DEFAULT NULL,
  `Cantidad` varchar(45) DEFAULT NULL,
  `Precio` varchar(45) DEFAULT NULL,
  `IDdescuento` int DEFAULT NULL,
  PRIMARY KEY (`IDpedido`),
  KEY `iddescuentoo_idx` (`IDdescuento`),
  CONSTRAINT `iddescuentoo` FOREIGN KEY (`IDdescuento`) REFERENCES `Descuento` (`IDdescuento`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Pedido`
--

LOCK TABLES `Pedido` WRITE;
/*!40000 ALTER TABLE `Pedido` DISABLE KEYS */;
INSERT INTO `Pedido` VALUES (7,'raul@gmail.com','2025-01-06 03:46:51','1','8.49',2);
/*!40000 ALTER TABLE `Pedido` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Pedido_Producto`
--

DROP TABLE IF EXISTS `Pedido_Producto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Pedido_Producto` (
  `Precio` float NOT NULL,
  `Cantidad` int DEFAULT NULL,
  `IDpedido` int DEFAULT NULL,
  `IDproducto` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Pedido_Producto`
--

LOCK TABLES `Pedido_Producto` WRITE;
/*!40000 ALTER TABLE `Pedido_Producto` DISABLE KEYS */;
INSERT INTO `Pedido_Producto` VALUES (9.99,1,7,7);
/*!40000 ALTER TABLE `Pedido_Producto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Producto`
--

DROP TABLE IF EXISTS `Producto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Producto` (
  `IDproducto` int NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(45) DEFAULT NULL,
  `PrecioBase` float DEFAULT NULL,
  `Imagen` varchar(45) DEFAULT NULL,
  `IDdescuento` int DEFAULT NULL,
  `IDcategoria` int DEFAULT NULL,
  PRIMARY KEY (`IDproducto`),
  KEY `iddescuento_idx` (`IDdescuento`),
  KEY `idcategoria_idx` (`IDcategoria`),
  CONSTRAINT `idcategoria` FOREIGN KEY (`IDcategoria`) REFERENCES `Categoria` (`IDcategoria`),
  CONSTRAINT `iddescuento` FOREIGN KEY (`IDdescuento`) REFERENCES `Descuento` (`IDdescuento`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Producto`
--

LOCK TABLES `Producto` WRITE;
/*!40000 ALTER TABLE `Producto` DISABLE KEYS */;
INSERT INTO `Producto` VALUES (1,'Pizza Pepperoni',9.99,'pizza',1,1),(2,'Pizza Jamon York',9.99,'jamonyork',1,1),(3,'Pizza 4 Quesos',11.99,'4quesos',1,1),(4,'Pizza Vegetariana',9.99,'pizzaveggie',1,1),(5,'Pizza BBQ',11.99,'pizzabbq',1,1),(6,'Pizza con Bacon',9.99,'pizzabacon',1,1),(7,'Pizza con Piña',9.99,'pizzahawai',1,1),(8,'Coca-Cola',2.25,'cocacola',1,2),(9,'Fanta Naranja',2.25,'fanta',1,2),(10,'Agua mineral',1,'agua',1,2),(11,'Patatas francesas',2.5,'patatas',1,3),(12,'Patatas deluxe',2.8,'patatasd',1,3);
/*!40000 ALTER TABLE `Producto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Usuario`
--

DROP TABLE IF EXISTS `Usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Usuario` (
  `IDusuario` int NOT NULL AUTO_INCREMENT,
  `email` varchar(45) NOT NULL,
  `usuario` varchar(45) DEFAULT NULL,
  `passwd` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`IDusuario`,`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Usuario`
--

LOCK TABLES `Usuario` WRITE;
/*!40000 ALTER TABLE `Usuario` DISABLE KEYS */;
INSERT INTO `Usuario` VALUES (1,'raul@gmail.com','raul puchol','$2y$10$3dNshRjXbB5kPA9yCmZNrOqPveyLQjR/pPNd4z1bmGyNFsI5xP9dq');
/*!40000 ALTER TABLE `Usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `log`
--

DROP TABLE IF EXISTS `log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `log` (
  `email` varchar(45) NOT NULL,
  `fecha` datetime DEFAULT NULL,
  `mensaje` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `log`
--

LOCK TABLES `log` WRITE;
/*!40000 ALTER TABLE `log` DISABLE KEYS */;
INSERT INTO `log` VALUES ('raul@gmail.com','2025-01-04 16:14:22','Sesion cerrada'),('raul@gmail.com','2025-01-04 16:15:16','Sesion cerrada'),('raul@gmail.com','2025-01-04 16:16:28','Sesion iniciada'),('raul@gmail.com','2025-01-06 03:25:08','Sesion cerrada'),('raul@gmail.com','2025-01-06 03:25:27','Sesion iniciada'),('raul@gmail.com','2025-01-06 03:25:35','Sesion cerrada'),('raul@gmail.com','2025-01-06 03:25:52','Sesion iniciada'),('raul@gmail.com','2025-01-06 03:47:28','Sesion cerrada'),('raul@gmail.com','2025-01-06 03:48:17','Sesion iniciada'),('raul@gmail.com','2025-01-07 16:39:58','Sesion iniciada');
/*!40000 ALTER TABLE `log` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-01-07 18:14:40
