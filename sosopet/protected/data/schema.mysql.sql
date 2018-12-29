-- MySQL dump 10.13  Distrib 5.5.14, for Linux (i686)
--
-- Host: localhost    Database: yiishop
-- ------------------------------------------------------
-- Server version	5.5.14

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
-- Table structure for table `shop_address`
--

DROP TABLE IF EXISTS `shop_address`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shop_address` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `street` varchar(255) NOT NULL,
  `zipcode` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop_address`
--

LOCK TABLES `shop_address` WRITE;
/*!40000 ALTER TABLE `shop_address` DISABLE KEYS */;
INSERT INTO `shop_address` VALUES (1,'mr','sakurai','atsushi','test','199','test','Japan');
INSERT INTO `shop_address` VALUES (3,'mr','sakurai','atsushi','test','199','test','Japan');
INSERT INTO `shop_address` VALUES (4,'mr','sakurai','atsushi','test','199','test','Japan');
INSERT INTO `shop_address` VALUES (5,'mr','sakurai','atsushi','test','199','test','Japan');
INSERT INTO `shop_address` VALUES (6,'mr','sakurai','atsushi','test','199','test','Japan');
/*!40000 ALTER TABLE `shop_address` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shop_category`
--

DROP TABLE IF EXISTS `shop_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shop_category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `title` varchar(45) NOT NULL,
  `description` text,
  `language` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop_category`
--

LOCK TABLES `shop_category` WRITE;
/*!40000 ALTER TABLE `shop_category` DISABLE KEYS */;
INSERT INTO `shop_category` VALUES (1,0,'Primary Articles',NULL,NULL);
INSERT INTO `shop_category` VALUES (2,0,'Secondary Articles',NULL,NULL);
INSERT INTO `shop_category` VALUES (3,1,'Red Primary Articles',NULL,NULL);
INSERT INTO `shop_category` VALUES (4,1,'Green Primary Articles',NULL,NULL);
INSERT INTO `shop_category` VALUES (5,2,'Red Secondary Articles',NULL,NULL);
/*!40000 ALTER TABLE `shop_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shop_customer`
--

DROP TABLE IF EXISTS `shop_customer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shop_customer` (
  `customer_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `address_id` int(11) NOT NULL,
  `delivery_address_id` int(11) NOT NULL,
  `billing_address_id` int(11) NOT NULL,
  `email` varchar(45) NOT NULL,
  `phone` varchar(255) NOT NULL,
  PRIMARY KEY (`customer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop_customer`
--

LOCK TABLES `shop_customer` WRITE;
/*!40000 ALTER TABLE `shop_customer` DISABLE KEYS */;
INSERT INTO `shop_customer` VALUES (1,0,6,0,0,'ccc@ddd.eee','012-345-6789');
/*!40000 ALTER TABLE `shop_customer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shop_image`
--

DROP TABLE IF EXISTS `shop_image`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shop_image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(45) NOT NULL,
  `filename` varchar(45) NOT NULL,
  `product_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Image_Products` (`product_id`),
  CONSTRAINT `fk_Image_Products` FOREIGN KEY (`product_id`) REFERENCES `shop_products` (`product_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop_image`
--

LOCK TABLES `shop_image` WRITE;
/*!40000 ALTER TABLE `shop_image` DISABLE KEYS */;
INSERT INTO `shop_image` VALUES (3,'aaa','40514.jpg',1);
INSERT INTO `shop_image` VALUES (4,'2','54114.jpg',2);
INSERT INTO `shop_image` VALUES (5,'3','4950344542741.jpg',3);
INSERT INTO `shop_image` VALUES (6,'4','7437012.jpg',4);
/*!40000 ALTER TABLE `shop_image` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shop_order`
--

DROP TABLE IF EXISTS `shop_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shop_order` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `delivery_address_id` int(11) NOT NULL,
  `billing_address_id` int(11) NOT NULL,
  `ordering_date` int(11) NOT NULL,
  `status` enum('new','in_progress','done','cancelled') NOT NULL DEFAULT 'new',
  `ordering_done` tinyint(1) DEFAULT NULL,
  `ordering_confirmed` tinyint(1) DEFAULT NULL,
  `payment_method` int(11) NOT NULL,
  `shipping_method` int(11) NOT NULL,
  `comment` text,
  PRIMARY KEY (`order_id`),
  KEY `fk_order_customer` (`customer_id`),
  CONSTRAINT `fk_order_customer1` FOREIGN KEY (`customer_id`) REFERENCES `shop_customer` (`customer_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop_order`
--

LOCK TABLES `shop_order` WRITE;
/*!40000 ALTER TABLE `shop_order` DISABLE KEYS */;
/*!40000 ALTER TABLE `shop_order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shop_order_position`
--

DROP TABLE IF EXISTS `shop_order_position`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shop_order_position` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `specifications` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop_order_position`
--

LOCK TABLES `shop_order_position` WRITE;
/*!40000 ALTER TABLE `shop_order_position` DISABLE KEYS */;
/*!40000 ALTER TABLE `shop_order_position` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shop_payment_method`
--

DROP TABLE IF EXISTS `shop_payment_method`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shop_payment_method` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text,
  `tax_id` int(11) NOT NULL,
  `price` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop_payment_method`
--

LOCK TABLES `shop_payment_method` WRITE;
/*!40000 ALTER TABLE `shop_payment_method` DISABLE KEYS */;
INSERT INTO `shop_payment_method` VALUES (1,'cash','You pay cash',1,0);
INSERT INTO `shop_payment_method` VALUES (2,'advance Payment','You pay in advance, we deliver',1,0);
INSERT INTO `shop_payment_method` VALUES (3,'cash on delivery','You pay when we deliver',1,0);
INSERT INTO `shop_payment_method` VALUES (4,'invoice','We deliver and send a invoice',1,0);
INSERT INTO `shop_payment_method` VALUES (5,'paypal','You pay by paypal',1,0);
/*!40000 ALTER TABLE `shop_payment_method` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shop_product_specification`
--

DROP TABLE IF EXISTS `shop_product_specification`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shop_product_specification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `input_type` enum('none','select','textfield','image') NOT NULL DEFAULT 'select',
  `required` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop_product_specification`
--

LOCK TABLES `shop_product_specification` WRITE;
/*!40000 ALTER TABLE `shop_product_specification` DISABLE KEYS */;
INSERT INTO `shop_product_specification` VALUES (1,'Weight','none',1);
INSERT INTO `shop_product_specification` VALUES (2,'Color','select',0);
INSERT INTO `shop_product_specification` VALUES (3,'Some random attribute','none',0);
INSERT INTO `shop_product_specification` VALUES (4,'Material','none',1);
INSERT INTO `shop_product_specification` VALUES (5,'Specific number','textfield',1);
/*!40000 ALTER TABLE `shop_product_specification` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shop_product_variation`
--

DROP TABLE IF EXISTS `shop_product_variation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shop_product_variation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `specification_id` int(11) NOT NULL,
  `position` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `price_adjustion` float NOT NULL,
  `weight_adjustion` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop_product_variation`
--

LOCK TABLES `shop_product_variation` WRITE;
/*!40000 ALTER TABLE `shop_product_variation` DISABLE KEYS */;
INSERT INTO `shop_product_variation` VALUES (1,1,1,2,'variation1',3,0);
INSERT INTO `shop_product_variation` VALUES (2,1,1,3,'variation2',6,0);
INSERT INTO `shop_product_variation` VALUES (3,1,2,4,'variation3',9,0);
INSERT INTO `shop_product_variation` VALUES (4,1,5,1,'please enter a number here',0,0);
/*!40000 ALTER TABLE `shop_product_variation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shop_products`
--

DROP TABLE IF EXISTS `shop_products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shop_products` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `status` int(10) NOT NULL,
  `tax_id` int(11) NOT NULL,
  `title` varchar(45) NOT NULL,
  `description` text,
  `keywords` varchar(255) DEFAULT NULL,
  `price` varchar(45) DEFAULT NULL,
  `language` varchar(45) DEFAULT NULL,
  `specifications` text,
  PRIMARY KEY (`product_id`),
  KEY `fk_products_category` (`category_id`),
  CONSTRAINT `fk_products_category` FOREIGN KEY (`category_id`) REFERENCES `shop_category` (`category_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop_products`
--

LOCK TABLES `shop_products` WRITE;
/*!40000 ALTER TABLE `shop_products` DISABLE KEYS */;
INSERT INTO `shop_products` VALUES (1,1,0,1,'Demonstration of Article with variations','Hello, World!',NULL,'19.99',NULL,NULL);
INSERT INTO `shop_products` VALUES (2,1,0,2,'Another Demo Article with less Tax','!!',NULL,'29.99',NULL,NULL);
INSERT INTO `shop_products` VALUES (3,2,0,1,'Demo3','',NULL,'',NULL,NULL);
INSERT INTO `shop_products` VALUES (4,4,0,1,'Demo4','',NULL,'7, 55',NULL,NULL);
/*!40000 ALTER TABLE `shop_products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shop_shipping_method`
--

DROP TABLE IF EXISTS `shop_shipping_method`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shop_shipping_method` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `weight_range` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text,
  `tax_id` int(11) NOT NULL,
  `price` double NOT NULL,
  PRIMARY KEY (`id`,`weight_range`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop_shipping_method`
--

LOCK TABLES `shop_shipping_method` WRITE;
/*!40000 ALTER TABLE `shop_shipping_method` DISABLE KEYS */;
INSERT INTO `shop_shipping_method` VALUES (1,'1-5','Delivery by postal Service','We deliver by Postal Service. 2.99 units of money are charged for that',1,2.99);
INSERT INTO `shop_shipping_method` VALUES (1,'5-10','Delivery by postal Service','We deliver by Postal Service. 2.99 units of money are charged for that',1,2.99);
/*!40000 ALTER TABLE `shop_shipping_method` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shop_tax`
--

DROP TABLE IF EXISTS `shop_tax`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shop_tax` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `percent` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop_tax`
--

LOCK TABLES `shop_tax` WRITE;
/*!40000 ALTER TABLE `shop_tax` DISABLE KEYS */;
INSERT INTO `shop_tax` VALUES (1,'19%',19);
INSERT INTO `shop_tax` VALUES (2,'7%',7);
/*!40000 ALTER TABLE `shop_tax` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2011-11-30 18:27:53
