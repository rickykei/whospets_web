-- MySQL dump 10.13  Distrib 5.5.16, for Linux (i686)
--
-- Host: localhost    Database: yiishop
-- ------------------------------------------------------
-- Server version	5.5.16

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
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;
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
INSERT INTO `shop_address` VALUES (7,'mr','sakurai','atsushi','test','199','test','Japan');
INSERT INTO `shop_address` VALUES (8,'mr','sakurai','atsushi','test','199','test','Japan');
INSERT INTO `shop_address` VALUES (9,'mr','sakurai','atsushi','test','199','test','Japan');
INSERT INTO `shop_address` VALUES (10,'mr','sakurai','atsushi','test','199','test','Japan');
INSERT INTO `shop_address` VALUES (11,'mr','sakurai','atsushi','test','199','test','Japan');
INSERT INTO `shop_address` VALUES (12,'mr','sakurai','atsushi','test','199','test','Japan');
INSERT INTO `shop_address` VALUES (13,'mr','sakurai','atsushi','test','199','test','Japan');
INSERT INTO `shop_address` VALUES (14,'mr','sakurai','atsushi','test','199','test','Japan');
INSERT INTO `shop_address` VALUES (15,'mr','sakurai','atsushi','test','199','test','Japan');
INSERT INTO `shop_address` VALUES (16,'mr','sakurai','atsushi','test','199','test','Japan');
INSERT INTO `shop_address` VALUES (17,'mr','sakurai','atsushi','test','199','test','Japan');
INSERT INTO `shop_address` VALUES (18,'mr','sakurai','atsushi','test','199','test','Japan');
INSERT INTO `shop_address` VALUES (19,'mr','sakurai','atsushi','test','199','test','Japan');
INSERT INTO `shop_address` VALUES (20,'mr','sakurai','atsushi','test','199','test','Japan');
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
INSERT INTO `shop_category` VALUES (1,0,'エッセンシャルオイル','','');
INSERT INTO `shop_category` VALUES (2,0,'ハーブウォーター','','');
INSERT INTO `shop_category` VALUES (4,0,'キャリアオイル','','');
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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop_image`
--

LOCK TABLES `shop_image` WRITE;
/*!40000 ALTER TABLE `shop_image` DISABLE KEYS */;
INSERT INTO `shop_image` VALUES (3,'オレンジスイート','essential_oil.jpg',2);
INSERT INTO `shop_image` VALUES (4,'ベルガモット','essential_oil.jpg',3);
INSERT INTO `shop_image` VALUES (5,'アプリコットオイル','p_12644.jpg',4);
INSERT INTO `shop_image` VALUES (6,'カモマイルジャーマン','p_10202.jpg',5);
INSERT INTO `shop_image` VALUES (8,'イランイラン','essential_oil.jpg',6);
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop_order`
--

LOCK TABLES `shop_order` WRITE;
/*!40000 ALTER TABLE `shop_order` DISABLE KEYS */;
INSERT INTO `shop_order` VALUES (1,1,7,8,1322839746,'new',NULL,NULL,1,1,'');
INSERT INTO `shop_order` VALUES (2,1,9,10,1322863956,'new',NULL,NULL,1,1,'');
INSERT INTO `shop_order` VALUES (3,1,11,12,1322864578,'new',NULL,NULL,1,1,'');
INSERT INTO `shop_order` VALUES (4,1,13,14,1322873880,'new',NULL,NULL,1,1,'');
INSERT INTO `shop_order` VALUES (5,1,15,16,1322874106,'new',NULL,NULL,1,1,'');
INSERT INTO `shop_order` VALUES (6,1,17,18,1322893420,'new',NULL,NULL,1,1,'');
INSERT INTO `shop_order` VALUES (7,1,19,20,1322905919,'new',NULL,NULL,1,1,'');
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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop_order_position`
--

LOCK TABLES `shop_order_position` WRITE;
/*!40000 ALTER TABLE `shop_order_position` DISABLE KEYS */;
INSERT INTO `shop_order_position` VALUES (1,1,3,2,'null');
INSERT INTO `shop_order_position` VALUES (2,2,2,1,'null');
INSERT INTO `shop_order_position` VALUES (3,2,3,1,'null');
INSERT INTO `shop_order_position` VALUES (4,3,2,1,'null');
INSERT INTO `shop_order_position` VALUES (5,3,4,1,'null');
INSERT INTO `shop_order_position` VALUES (6,3,3,1,'null');
INSERT INTO `shop_order_position` VALUES (7,4,2,1,'null');
INSERT INTO `shop_order_position` VALUES (8,5,4,1,'null');
INSERT INTO `shop_order_position` VALUES (9,6,5,1,'null');
INSERT INTO `shop_order_position` VALUES (10,6,2,1,'null');
INSERT INTO `shop_order_position` VALUES (11,6,3,1,'null');
INSERT INTO `shop_order_position` VALUES (12,6,4,1,'null');
INSERT INTO `shop_order_position` VALUES (13,7,2,2,'null');
INSERT INTO `shop_order_position` VALUES (14,7,3,3,'null');
INSERT INTO `shop_order_position` VALUES (15,7,6,4,'null');
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop_payment_method`
--

LOCK TABLES `shop_payment_method` WRITE;
/*!40000 ALTER TABLE `shop_payment_method` DISABLE KEYS */;
INSERT INTO `shop_payment_method` VALUES (1,'現金払い','現金払い',1,0);
INSERT INTO `shop_payment_method` VALUES (2,'銀行振込','銀行振込',1,0);
INSERT INTO `shop_payment_method` VALUES (3,'代金引換','代金引換',1,0);
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop_product_specification`
--

LOCK TABLES `shop_product_specification` WRITE;
/*!40000 ALTER TABLE `shop_product_specification` DISABLE KEYS */;
INSERT INTO `shop_product_specification` VALUES (1,'Weight','none',1);
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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop_product_variation`
--

LOCK TABLES `shop_product_variation` WRITE;
/*!40000 ALTER TABLE `shop_product_variation` DISABLE KEYS */;
INSERT INTO `shop_product_variation` VALUES (9,1,5,1,'please enter a number here',0,0);
INSERT INTO `shop_product_variation` VALUES (10,1,1,2,'variation1',3,0);
INSERT INTO `shop_product_variation` VALUES (11,1,1,3,'variation2',6,0);
INSERT INTO `shop_product_variation` VALUES (12,1,2,4,'variation3',9,0);
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
  `descriptionDisplay` text,
  `keywords` varchar(255) DEFAULT NULL,
  `price` varchar(45) DEFAULT NULL,
  `language` varchar(45) DEFAULT NULL,
  `specifications` text,
  PRIMARY KEY (`product_id`),
  KEY `fk_products_category` (`category_id`),
  CONSTRAINT `fk_products_category` FOREIGN KEY (`category_id`) REFERENCES `shop_category` (`category_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop_products`
--

LOCK TABLES `shop_products` WRITE;
/*!40000 ALTER TABLE `shop_products` DISABLE KEYS */;
INSERT INTO `shop_products` VALUES (2,1,1,1,'オレンジスイート','爽やかで甘くフルーティな香り。気分を明るく、リフレッシュするのに最適です。\r\n異名称：スイートオレンジ\r\n\r\n\r\n●精油名：オレンジ・スィート（果皮）\r\n●学名：Citrus sinensis (Ze) (10ml)\r\n●科名：ミカン科\r\n●蒸留部位：果皮\r\n●主な産地：イタリア、ブラジル、モロッコ\r\n●蒸散速度：トップノート（中）\r\n●相性の良い精油：柑橘系、クラリーセージ、フランキンセンス、ネロリ、ミルラ、ラベンダー類、スパイス系\r\n●禁忌または注意事項：用法用量を守って使用すれば禁忌なし。\r\n','<p>爽やかで甘くフルーティな香り。気分を明るく、リフレッシュするのに最適です。<br />異名称：スイートオレンジ</p><p>●精油名：オレンジ・スィート（果皮）<br />●学名：Citrus sinensis (Ze) (10ml)<br />●科名：ミカン科<br />●蒸留部位：果皮<br />●主な産地：イタリア、ブラジル、モロッコ<br />●蒸散速度：トップノート（中）<br />●相性の良い精油：柑橘系、クラリーセージ、フランキンセンス、ネロリ、ミルラ、ラベンダー類、スパイス系<br />●禁忌または注意事項：用法用量を守って使用すれば禁忌なし。</p><br />','','2300',NULL,'{\"Weight\":\"\"}');
INSERT INTO `shop_products` VALUES (3,1,1,1,'ベルガモット','透明感のある甘い柑橘の香り。\r\nリラックスだけでなく、リフレッシュにもおすすめです。異名称：ベルガモットオレンジ、ベルガモットオレンジピール\r\n\r\n●精油名：ベルガモット（果皮）\r\n●学名：Citrus aurantium ssp. bergamia (Ze) (10ml)\r\n●科名：ミカン科\r\n●蒸留部位：果皮\r\n●主な産地：イタリア、コートジボワール\r\n●蒸散速度：トップノート（高）\r\n●相性の良い精油：柑橘系、ネロリ、レモングラス、エレミ、プチグレン、ラベンダー類、クラリーセージ、ゼラニウム類、バジル\r\n●禁忌または注意事項：フロクマリン類を含んでいるので光感作（光毒性）作用がある。塗布した肌を４～５時間は直射日光（紫外線）に当てないよう注意が必要。','<p>透明感のある甘い柑橘の香り。<br />リラックスだけでなく、リフレッシュにもおすすめです。異名称：ベルガモットオレンジ、ベルガモットオレンジピール</p><p>●精油名：ベルガモット（果皮）<br />●学名：Citrus aurantium ssp. bergamia (Ze) (10ml)<br />●科名：ミカン科<br />●蒸留部位：果皮<br />●主な産地：イタリア、コートジボワール<br />●蒸散速度：トップノート（高）<br />●相性の良い精油：柑橘系、ネロリ、レモングラス、エレミ、プチグレン、ラベンダー類、クラリーセージ、ゼラニウム類、バジル<br />●禁忌または注意事項：フロクマリン類を含んでいるので光感作（光毒性）作用がある。塗布した肌を４～５時間は直射日光（紫外線）に当てないよう注意が必要。</p><br />','','3200',NULL,'{\"Weight\":\"\",\"Color\":\"\",\"Some random attribute\":\"\",\"Material\":\"\",\"Specific number\":\"\"}');
INSERT INTO `shop_products` VALUES (4,4,1,1,'アプリコットオイル','アンズの種子からとれる植物油。\r\nほのかに甘い香りで、皮膚への浸透性が期待できます。\r\n\r\n■ 商品名 	アプリコット油\r\n■ 内容量 	50ml\r\n■ 使用成分 	アプリコット油\r\n■ 説明 	種子を圧搾\r\nオレイン酸やリノール酸を多く含み、適度な粘性と甘い香りをもちます。\r\n■ 使い方 	適量を手にとり、お肌に塗布してください。\r\n■ 保存方法 	高温多湿の場所を避けて保存してください。\r\n■ メーカー名 	プラナロム社\r\n■ 輸入業者 	株式会社 健草医学舎\r\n■ 区分 	ベルギー製／化粧品\r\n','<p>アンズの種子からとれる植物油。<br />ほのかに甘い香りで、皮膚への浸透性が期待できます。</p><p>■ 商品名   アプリコット油<br />■ 内容量   50ml<br />■ 使用成分  アプリコット油<br />■ 説明    種子を圧搾<br />オレイン酸やリノール酸を多く含み、適度な粘性と甘い香りをもちます。<br />■ 使い方   適量を手にとり、お肌に塗布してください。<br />■ 保存方法  高温多湿の場所を避けて保存してください。<br />■ メーカー名     プラナロム社<br />■ 輸入業者  株式会社 健草医学舎<br />■ 区分    ベルギー製／化粧品</p><br />','','2300',NULL,'{\"Weight\":\"\"}');
INSERT INTO `shop_products` VALUES (5,2,1,1,'カモマイルジャーマンウォーター','ハーブウォーターには微量の精油成分が含まれ、精油ともハーブティーとも違った特質により、穏やかな香りと作用が楽しめます。\r\n国産ハーブウォーターは自然環境豊かな土地で完全無農薬有機栽培により育てられたハーブを南アルプスの地下水を使用し蒸留しました。\r\n徹底した品質管理と衛生管理のもとに製造された最高水準の製品です。\r\n\r\n保存料・防腐剤を一切使用しておりませんので、１０℃～２０℃で保存し、開封後は3ヶ月以内に使用して下さい。\r\n\r\n●このハーブ水は、日本国内で無農薬・有機栽培で産出されたハーブより蒸留した無添加・自然化粧水です。\r\n●保存料・防腐剤等を一切使用しておりませんので、10～20℃で保存し、開封後は３ヶ月以内にご使用ください。\r\n\r\n\r\n■ 商品名 	ケンソー・ハーブウォーター・カモマイルジャーマン\r\n■ 全成分 	カモマイルジャーマン水\r\n■ 内容量 	200ml\r\n■ 保存方法 	開封後は冷蔵庫にて保管してください。\r\n■ 使い方 	適量を手に取りご使用ください。\r\n■ メーカー名 	株式会社健草医学舎\r\n■ 区分 	日本製／化粧品\r\n\r\n\r\n●食品ではありませんので飲まないでください。\r\n●お子様の手の届かない場所に保管してください。\r\n●容器ボトルを落としたり、強い衝撃を与えると割れる恐れがありますので、\r\n取り扱いにはご注意ください。 ','<p>ハーブウォーターには微量の精油成分が含まれ、精油ともハーブティーとも違った特質により、穏やかな香りと作用が楽しめます。<br />国産ハーブウォーターは自然環境豊かな土地で完全無農薬有機栽培により育てられたハーブを南アルプスの地下水を使用し蒸留しました。<br />徹底した品質管理と衛生管理のもとに製造された最高水準の製品です。</p><p>保存料・防腐剤を一切使用しておりませんので、１０℃～２０℃で保存し、開封後は3ヶ月以内に使用して下さい。</p><p>●このハーブ水は、日本国内で無農薬・有機栽培で産出されたハーブより蒸留した無添加・自然化粧水です。<br />●保存料・防腐剤等を一切使用しておりませんので、10～20℃で保存し、開封後は３ヶ月以内にご使用ください。</p><p>■ 商品名   ケンソー・ハーブウォーター・カモマイルジャーマン<br />■ 全成分   カモマイルジャーマン水<br />■ 内容量   200ml<br />■ 保存方法  開封後は冷蔵庫にて保管してください。<br />■ 使い方   適量を手に取りご使用ください。<br />■ メーカー名     株式会社健草医学舎<br />■ 区分    日本製／化粧品</p><p>●食品ではありませんので飲まないでください。<br />●お子様の手の届かない場所に保管してください。<br />●容器ボトルを落としたり、強い衝撃を与えると割れる恐れがありますので、<br />取り扱いにはご注意ください。</p><br />','','2200',NULL,'{\"Weight\":\"\"}');
INSERT INTO `shop_products` VALUES (6,1,1,1,'イランイラン','甘美で人を陶酔させる香り。心をなごませるセクシャルな香りは寝室の香りとしても最適。\r\n\r\n●精油名：イランイラン\r\n●学名：Cananga Odorata (10ml)\r\n●科名：バンレイシ科科\r\n●蒸留部位：花\r\n●主な産地：マダガスカル\r\n●蒸散速度：ミドルノート（中）\r\n●相性の良い精油：ジャスミン、ローズ、ローズウッド、オポポナックス、シトロネラ、ネロリ、カモマイル、ゼラニウム類、柑橘系\r\n●禁忌または注意事項：用法用量を守って使用すれば禁忌なし。 ','<p>甘美で人を陶酔させる香り。心をなごませるセクシャルな香りは寝室の香りとしても最適。</p><p>●精油名：イランイラン<br />●学名：Cananga Odorata (10ml)<br />●科名：バンレイシ科科<br />●蒸留部位：花<br />●主な産地：マダガスカル<br />●蒸散速度：ミドルノート（中）<br />●相性の良い精油：ジャスミン、ローズ、ローズウッド、オポポナックス、シトロネラ、ネロリ、カモマイル、ゼラニウム類、柑橘系<br />●禁忌または注意事項：用法用量を守って使用すれば禁忌なし。</p><br />','','4300',NULL,'{\"Weight\":\"\"}');
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop_shipping_method`
--

LOCK TABLES `shop_shipping_method` WRITE;
/*!40000 ALTER TABLE `shop_shipping_method` DISABLE KEYS */;
INSERT INTO `shop_shipping_method` VALUES (1,'0-5','ゆうぱっく','ゆうぱっくによる配送です。500円かかります。',1,500);
INSERT INTO `shop_shipping_method` VALUES (1,'5-10','ゆうぱっく','ゆうぱっくによる配送です。500円かかります。',1,500);
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop_tax`
--

LOCK TABLES `shop_tax` WRITE;
/*!40000 ALTER TABLE `shop_tax` DISABLE KEYS */;
INSERT INTO `shop_tax` VALUES (1,'消費税5%',5);
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

-- Dump completed on 2011-12-03 23:45:56
