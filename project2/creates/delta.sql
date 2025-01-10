-- MySQL dump 10.13  Distrib 8.0.38, for Win64 (x86_64)
--
-- Host: localhost    Database: njpetersen
-- ------------------------------------------------------
-- Server version	5.5.5-10.11.10-MariaDB

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
-- Table structure for table `Cart`
--

DROP TABLE IF EXISTS `Cart`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Cart` (
  `CartItemID` bigint(20) NOT NULL AUTO_INCREMENT,
  `Uname` varchar(255) DEFAULT NULL,
  `GuestID` bigint(20) unsigned DEFAULT NULL,
  `ProductID` int(10) unsigned NOT NULL,
  `Quantity` int(10) unsigned NOT NULL,
  PRIMARY KEY (`CartItemID`),
  KEY `Uname` (`Uname`),
  KEY `ProductID` (`ProductID`),
  KEY `Cart_Cart__fk` (`GuestID`),
  CONSTRAINT `Cart_Cart__fk` FOREIGN KEY (`GuestID`) REFERENCES `Guests` (`GuestID`),
  CONSTRAINT `Cart_ibfk_1` FOREIGN KEY (`Uname`) REFERENCES `Users` (`Uname`),
  CONSTRAINT `Cart_ibfk_2` FOREIGN KEY (`ProductID`) REFERENCES `Products` (`ProductID`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Cart`
--

LOCK TABLES `Cart` WRITE;
/*!40000 ALTER TABLE `Cart` DISABLE KEYS */;
INSERT INTO `Cart` VALUES (34,NULL,10,1,1),(35,NULL,10,2,1);
/*!40000 ALTER TABLE `Cart` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Comments`
--

DROP TABLE IF EXISTS `Comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Comments` (
  `CommentID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `Comment` mediumtext NOT NULL,
  `Username` tinytext NOT NULL,
  `PostID` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`CommentID`),
  KEY `PostID` (`PostID`),
  CONSTRAINT `Comments_ibfk_1` FOREIGN KEY (`PostID`) REFERENCES `Posts` (`PostID`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Comments`
--

LOCK TABLES `Comments` WRITE;
/*!40000 ALTER TABLE `Comments` DISABLE KEYS */;
INSERT INTO `Comments` VALUES (1,'I like dogs too!','DogLover29',3),(2,'I also like dogs!','bmidnf0238sdmma9f0rirpco56',3),(3,'So does this guy, ehhhhh!','bmidnf0238sdmma9f0rirpco56',3),(4,'And what a post it is!','bmidnf0238sdmma9f0rirpco56',1),(5,'Yes, a great post!','jvk1ra6u20pu686oc5n2dq10af',2),(16,'Looks like it is!','jvk1ra6u20pu686oc5n2dq10af',4),(17,'I like Python!','jvk1ra6u20pu686oc5n2dq10af',5),(18,'My dog is a dingo!','jvk1ra6u20pu686oc5n2dq10af',3);
/*!40000 ALTER TABLE `Comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Contacts`
--

DROP TABLE IF EXISTS `Contacts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Contacts` (
  `ContactID` int(11) NOT NULL AUTO_INCREMENT,
  `First` varchar(100) NOT NULL,
  `Last` varchar(100) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Inquiry` longtext NOT NULL,
  PRIMARY KEY (`ContactID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Contacts`
--

LOCK TABLES `Contacts` WRITE;
/*!40000 ALTER TABLE `Contacts` DISABLE KEYS */;
INSERT INTO `Contacts` VALUES (1,'Johnny','Test','Johnny@Test.com','This is a test inquiry.');
/*!40000 ALTER TABLE `Contacts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Customers`
--

DROP TABLE IF EXISTS `Customers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Customers` (
  `CustomerID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `First` varchar(100) NOT NULL,
  `Last` varchar(100) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Birthday` date NOT NULL,
  `CountryCode` varchar(3) NOT NULL,
  `Phone1` varchar(3) NOT NULL,
  `Phone2` varchar(3) NOT NULL,
  `Phone3` varchar(4) NOT NULL,
  `Street` varchar(256) NOT NULL,
  `City` tinytext NOT NULL,
  `State` tinytext NOT NULL,
  `Zip` varchar(5) NOT NULL,
  `Country` varchar(50) NOT NULL,
  `Notes` varchar(256) DEFAULT NULL,
  `Banned` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`CustomerID`),
  UNIQUE KEY `Email` (`Email`),
  UNIQUE KEY `Email_pk` (`Email`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Customers`
--

LOCK TABLES `Customers` WRITE;
/*!40000 ALTER TABLE `Customers` DISABLE KEYS */;
INSERT INTO `Customers` VALUES (1,'Nicholas','Petersen','njpetersen@hawkmail.hfcc.edu','1990-01-01','1','123','456','7890','123 Homeward St','Sometown','MI','12345','USA','Owner',0),(2,'Chad','Banks','crbanks1@hfcc.edu','1990-01-01','1','098','765','4321','098 Somewhere Ln','Citytown','MI','12345','USA','First customer',0),(3,'Tom','Sawyer','tom@twainsbrain.com','1785-03-19','1','583','390','9683','6839 White Fence Dr','St. Petersburg','MO','56325','USA','Doesnt know what digital means. Good customer though.',0),(4,'Luke','Skywalker','luke@therebellion.com','1975-09-04','98','356','235','6933','Crashed X-wing','Dagobah','Sluis Sector','90000','Outer Rim','Highly interested in AI art',0),(16,'Test','User','test@user.com','2024-12-04','USA','123','456','7890','123 Test St','Testville','AL','12345','USA',NULL,0),(17,'Test','User 2','test@user2.com','2024-12-04','USA','98','765','4321','321 Tset ts','Testopolis','AL','54321','USA',NULL,0),(18,'Test','User 3','test@user3.com','2024-12-04','USA','582','168','2165','355 sdfw st','alkse','OK','23454','USA',NULL,0),(19,'Test','User 4','test@user4.com','2024-12-04','USA','985','461','6413','32516 sdfljwl ts','wefasdf','KS','98562','USA',NULL,0),(23,'Test','User 5','test@user5.com','2024-12-04','USA','968','451','6165','6516 sdfolij st','sdfnlk','AL','65465','USA',NULL,0);
/*!40000 ALTER TABLE `Customers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Diet`
--

DROP TABLE IF EXISTS `Diet`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Diet` (
  `DietPlan` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Food` varchar(50) NOT NULL,
  `Price` decimal(5,2) NOT NULL,
  `description` text NOT NULL,
  `GrainFree` tinyint(1) NOT NULL,
  PRIMARY KEY (`DietPlan`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Diet`
--

LOCK TABLES `Diet` WRITE;
/*!40000 ALTER TABLE `Diet` DISABLE KEYS */;
INSERT INTO `Diet` VALUES (1,'Hills Science Diet',45.99,'30lb bag dry dog food, beef flavor',1);
/*!40000 ALTER TABLE `Diet` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Dogs`
--

DROP TABLE IF EXISTS `Dogs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Dogs` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `DogName` varchar(25) NOT NULL,
  `Breed` varchar(50) DEFAULT NULL,
  `Gender` tinyint(1) NOT NULL,
  `Age` tinyint(3) unsigned DEFAULT NULL,
  `Vaccinated` tinyint(1) NOT NULL,
  `AdoptFee` decimal(6,2) unsigned DEFAULT NULL,
  `OwnerID` int(10) unsigned DEFAULT NULL,
  `DietPlan` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `OwnerID` (`OwnerID`),
  KEY `DietPlan` (`DietPlan`),
  CONSTRAINT `Dogs_ibfk_1` FOREIGN KEY (`OwnerID`) REFERENCES `Owners` (`UserID`),
  CONSTRAINT `Dogs_ibfk_2` FOREIGN KEY (`DietPlan`) REFERENCES `Diet` (`DietPlan`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Dogs`
--

LOCK TABLES `Dogs` WRITE;
/*!40000 ALTER TABLE `Dogs` DISABLE KEYS */;
INSERT INTO `Dogs` VALUES (1,'Dexter','Husky',0,2,1,399.99,1,NULL);
/*!40000 ALTER TABLE `Dogs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `FileList`
--

DROP TABLE IF EXISTS `FileList`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `FileList` (
  `FileNumber` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Filename` varchar(255) DEFAULT NULL,
  `Location` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`FileNumber`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `FileList`
--

LOCK TABLES `FileList` WRITE;
/*!40000 ALTER TABLE `FileList` DISABLE KEYS */;
INSERT INTO `FileList` VALUES (1,'goldstar.png','../uploads/goldstar.png'),(2,'Test File.txt','../uploads/Test File.txt'),(3,'btc.png','../uploads/btc.png');
/*!40000 ALTER TABLE `FileList` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Guests`
--

DROP TABLE IF EXISTS `Guests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Guests` (
  `GuestID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `SessionID` varchar(255) NOT NULL,
  `CartID` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`GuestID`),
  UNIQUE KEY `SessionID` (`SessionID`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Guests`
--

LOCK TABLES `Guests` WRITE;
/*!40000 ALTER TABLE `Guests` DISABLE KEYS */;
INSERT INTO `Guests` VALUES (1,'kmm2k7knsb5rk72m91hm5de5j0',NULL),(2,'83irtk27q08q23t9ptune1li22',NULL),(8,'l53cfm9mj06267lmdnk01k9heq',NULL),(9,'pi36510dtmmfldrvok48f7tdla',NULL),(10,'2tbd99g3i406trdtl9f5krrt39',NULL);
/*!40000 ALTER TABLE `Guests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Order_Items`
--

DROP TABLE IF EXISTS `Order_Items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Order_Items` (
  `LineItem` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `OrderNum` int(10) unsigned NOT NULL,
  `ProductID` int(10) unsigned NOT NULL,
  `Quantity` int(11) NOT NULL,
  PRIMARY KEY (`LineItem`),
  KEY `ProductID` (`ProductID`),
  KEY `OrderNum` (`OrderNum`),
  CONSTRAINT `Order_Items_ibfk_1` FOREIGN KEY (`ProductID`) REFERENCES `Products` (`ProductID`),
  CONSTRAINT `Order_Items_ibfk_2` FOREIGN KEY (`OrderNum`) REFERENCES `Orders` (`OrderNum`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Order_Items`
--

LOCK TABLES `Order_Items` WRITE;
/*!40000 ALTER TABLE `Order_Items` DISABLE KEYS */;
INSERT INTO `Order_Items` VALUES (3,11,1,1),(4,11,2,3),(5,14,1,1),(6,14,2,1),(7,15,1,1),(8,26,1,1),(9,26,2,1),(10,27,1,1),(11,27,1,1),(12,28,1,1),(13,28,2,1),(14,29,1,1),(15,29,2,1),(16,30,1,1),(17,30,2,1);
/*!40000 ALTER TABLE `Order_Items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Orders`
--

DROP TABLE IF EXISTS `Orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Orders` (
  `OrderNum` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `CustomerID` int(10) unsigned DEFAULT NULL,
  `GuestID` bigint(20) unsigned DEFAULT NULL,
  `DateOrdered` datetime NOT NULL,
  `Subtotal` decimal(10,0) NOT NULL,
  `Tax` decimal(10,0) NOT NULL,
  `Shipping` decimal(10,0) NOT NULL,
  `Total` decimal(10,0) NOT NULL,
  `CountryCode` varchar(3) NOT NULL,
  `Phone` varchar(10) NOT NULL,
  `Street` varchar(256) NOT NULL,
  `City` tinytext NOT NULL,
  `State` tinytext NOT NULL,
  `Zip` mediumint(9) NOT NULL,
  `Country` varchar(50) NOT NULL,
  PRIMARY KEY (`OrderNum`),
  KEY `CustomerID` (`CustomerID`),
  KEY `Orders___fk` (`GuestID`),
  CONSTRAINT `Orders___fk` FOREIGN KEY (`GuestID`) REFERENCES `Guests` (`GuestID`),
  CONSTRAINT `Orders_ibfk_1` FOREIGN KEY (`CustomerID`) REFERENCES `Customers` (`CustomerID`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Orders`
--

LOCK TABLES `Orders` WRITE;
/*!40000 ALTER TABLE `Orders` DISABLE KEYS */;
INSERT INTO `Orders` VALUES (11,1,NULL,'2024-12-01 13:54:50',174,10,20,204,'52','1234567890','123 Homeward St','Sometown','MI',12345,'Uni'),(12,1,NULL,'2024-12-01 14:37:06',78,5,20,103,'52','1234567890','123 Homeward St','Sometown','MI',12345,'Uni'),(13,1,NULL,'2024-12-01 14:41:28',78,5,20,103,'52','1234567890','123 Homeward St','Sometown','MI',23421,'Uni'),(14,1,NULL,'2024-12-01 14:43:09',78,5,20,103,'52','1234567890','123 Homeward St','Sometown','MI',12345,'Uni'),(15,1,NULL,'2024-12-04 16:05:59',30,2,20,52,'52','1234567890','123 Homeward St','Sometown','MI',23423,'Uni'),(23,NULL,NULL,'2024-12-11 13:42:52',78,5,20,103,'52','3216516516','lsdjlk st','slkdjf','MI',23456,'USA'),(24,NULL,NULL,'2024-12-11 13:43:22',78,5,20,103,'52','3216516516','lsdjlk st','slkdjf','MI',23456,'USA'),(25,NULL,NULL,'2024-12-11 13:44:03',78,5,20,103,'52','3216516516','lsdjlk st','slkdjf','MI',23456,'USA'),(26,NULL,9,'2024-12-11 13:44:39',78,5,20,103,'52','3216516516','lsdjlk st','slkdjf','MI',23456,'USA'),(27,NULL,9,'2024-12-11 13:58:29',60,4,20,84,'52','2345234523','asdfa as','sadf','mi',99999,'sad'),(28,NULL,10,'2024-12-11 14:10:02',78,5,20,103,'52','3452345234','sdfsf','sdf','mi',33455,'sdf'),(29,NULL,10,'2024-12-11 14:16:33',78,5,20,103,'52','5678565675','dfgsd er','sedrdf','df',34534,'hjf'),(30,1,NULL,'2024-12-11 14:17:17',78,5,20,103,'52','1234567890','123 Homeward St','Sometown','MI',45645,'Uni');
/*!40000 ALTER TABLE `Orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Owners`
--

DROP TABLE IF EXISTS `Owners`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Owners` (
  `UserID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Username` varchar(50) NOT NULL,
  `FirstName` varchar(50) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Birthday` date NOT NULL,
  `Phone` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`UserID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Owners`
--

LOCK TABLES `Owners` WRITE;
/*!40000 ALTER TABLE `Owners` DISABLE KEYS */;
INSERT INTO `Owners` VALUES (1,'njpetersen','Nicholas','Petersen','njpetersen@hawkmail.hfcc.edu','1900-01-01',3135556666),(2,'ajones','Adam','Jones','ajones@somedomain.com','1990-05-22',3135677333),(3,'dhuanosta','Denice','Huanosta','dhuanosta1@hawkmial.hfcc.edu','1996-06-20',3135940239);
/*!40000 ALTER TABLE `Owners` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Pass`
--

DROP TABLE IF EXISTS `Pass`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Pass` (
  `PW` varchar(255) NOT NULL,
  `Uname` varchar(255) NOT NULL,
  UNIQUE KEY `Uname` (`Uname`),
  CONSTRAINT `Pass_ibfk_1` FOREIGN KEY (`Uname`) REFERENCES `Users` (`Uname`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Pass`
--

LOCK TABLES `Pass` WRITE;
/*!40000 ALTER TABLE `Pass` DISABLE KEYS */;
INSERT INTO `Pass` VALUES ('ef92b778bafe771e89245b89ecbc08a44a4e166c06659911881f383d4473e94f','Admin'),('a20aff106fe011d5dd696e3b7105200ff74331eeb8e865bb80ebd82b12665a07','Backup'),('9bca39bbda0d8f794d28f4b00d178796ddcfa26c02a41d91c12ffd17a5bc6e46','Chad'),('45cbc1b08677bad95d731750916583b206ebc26c7ba877c0aa533f964e291340','Luke'),('e6e07510d6531af5f403d1e6d0eb997855b6453488aaee6a9dd10ad5133f936a','Nick'),('5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8','Test'),('5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8','test2'),('5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8','test3'),('5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8','test4'),('5e884898da28047151d0e56f8dc6292773603d0d6aabbdd62a11ef721d1542d8','test5'),('88c812f232589f9997f4cedeb0f13d636567c70811c520369611cee1b8a08a7e','Tom');
/*!40000 ALTER TABLE `Pass` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Posts`
--

DROP TABLE IF EXISTS `Posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Posts` (
  `PostID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `Username` tinytext NOT NULL,
  `Title` text NOT NULL,
  `Content` mediumtext NOT NULL,
  PRIMARY KEY (`PostID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Posts`
--

LOCK TABLES `Posts` WRITE;
/*!40000 ALTER TABLE `Posts` DISABLE KEYS */;
INSERT INTO `Posts` VALUES (1,'Nick','Post 1','This is post 1!'),(2,'James','Post 2','This is Post 2!'),(3,'John','Dogs!','My name is john and I like dogs.'),(4,'jvk1ra6u20pu686oc5n2dq10af','Testing New Post Button','Is it working?'),(5,'jvk1ra6u20pu686oc5n2dq10af','Favorite Programming Lanuage','What is everyone\'s favorite language? Mine is PHP!');
/*!40000 ALTER TABLE `Posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Products`
--

DROP TABLE IF EXISTS `Products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Products` (
  `ProductID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) NOT NULL,
  `Image` varchar(255) DEFAULT NULL,
  `Description` varchar(255) NOT NULL,
  `Price` decimal(7,2) NOT NULL,
  `Quantity` int(10) unsigned NOT NULL,
  `Rating` tinyint(5) DEFAULT NULL,
  `Discontinued` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`ProductID`),
  UNIQUE KEY `Products_pk` (`Name`),
  CONSTRAINT `quantity_not_negative` CHECK (`Quantity` >= 0),
  CONSTRAINT `rating_not_negative` CHECK (`Rating` >= 0),
  CONSTRAINT `price_not_negative` CHECK (`Price` >= 0),
  CONSTRAINT `discontinued_true_false` CHECK (`Discontinued` = 0 or `Discontinued` = 1)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Products`
--

LOCK TABLES `Products` WRITE;
/*!40000 ALTER TABLE `Products` DISABLE KEYS */;
INSERT INTO `Products` VALUES (1,'Abstract Scene','/images/abstract1.webp','A beatiful abstract shape combining warm and cool colors',29.99,17,3,0),(2,'Vibrant Cityscape','/images/cityscape1.webp','A high energy and buslting city street',47.95,9,5,0),(3,'Cosmic Wonder','/images/cosmicScene1.webp','A stunning alien landscape with cosmic wonder abound',54.25,0,4,0),(11,'Test Product 2','/images/test.jpg','Another updated description',1.00,0,5,1),(14,'Test Product 3','','This is another test',2.99,0,0,1),(15,'Test Product 1','/images/update.jpg','blah blah blah blah blah blah',2.99,0,3,1),(16,'Test Product 4','/images/test.jpg','Yet another test product.',100.00,65,4,1),(17,'Test Product 5','/images/test.jpg','This is an updated description.',453.00,434358,5,1),(18,'Test Product 7','/images/test.jpg','this is test 7',1.99,1,5,1),(19,'Test Product 6','','This is a test without an image',2.99,0,3,1),(20,'Test Product Update 2','/images/update.jpg','asdfwefswdefe',2345.00,23,4,1);
/*!40000 ALTER TABLE `Products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Users`
--

DROP TABLE IF EXISTS `Users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Users` (
  `Uname` varchar(255) NOT NULL,
  `CustomerID` int(10) unsigned DEFAULT NULL,
  `CartID` varchar(255) DEFAULT NULL,
  `OrderNum` int(10) unsigned DEFAULT NULL,
  `IsAdmin` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`Uname`),
  UNIQUE KEY `Uname` (`Uname`),
  KEY `CustomerID` (`CustomerID`),
  KEY `OrderNum` (`OrderNum`),
  CONSTRAINT `Users_ibfk_1` FOREIGN KEY (`CustomerID`) REFERENCES `Customers` (`CustomerID`),
  CONSTRAINT `Users_ibfk_2` FOREIGN KEY (`OrderNum`) REFERENCES `Orders` (`OrderNum`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Users`
--

LOCK TABLES `Users` WRITE;
/*!40000 ALTER TABLE `Users` DISABLE KEYS */;
INSERT INTO `Users` VALUES ('Admin',NULL,NULL,NULL,1),('Backup',NULL,NULL,NULL,0),('Chad',2,NULL,NULL,0),('Luke',4,NULL,NULL,0),('Nick',1,NULL,NULL,1),('Test',16,NULL,NULL,0),('test2',17,NULL,NULL,0),('test3',18,NULL,NULL,0),('test4',19,NULL,NULL,0),('test5',23,NULL,NULL,0),('Tom',3,NULL,NULL,0);
/*!40000 ALTER TABLE `Users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `midterm_cars`
--

DROP TABLE IF EXISTS `midterm_cars`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `midterm_cars` (
  `CarID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Make` varchar(50) NOT NULL,
  `Model` varchar(50) NOT NULL,
  `Price` decimal(10,0) NOT NULL,
  `Year` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`CarID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `midterm_cars`
--

LOCK TABLES `midterm_cars` WRITE;
/*!40000 ALTER TABLE `midterm_cars` DISABLE KEYS */;
INSERT INTO `midterm_cars` VALUES (1,'Jeep','Grand Cherokee',29900,2007),(2,'Dodge','Neon',5890,2005),(3,'Buick','Skylark',500,1985),(4,'Ford','Focus',2006,6000),(5,'Ford','Escape',2010,13000);
/*!40000 ALTER TABLE `midterm_cars` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-12-11 15:15:22
