-- MySQL dump 10.14  Distrib 5.5.60-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: nano
-- ------------------------------------------------------
-- Server version	5.5.60-MariaDB

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
-- Table structure for table `layouts`
--

DROP TABLE IF EXISTS `layouts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `layouts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(60) DEFAULT NULL COMMENT 'レイアウト名',
  `value` tinyint(1) DEFAULT NULL COMMENT '分割値',
  `function_type` tinyint(1) DEFAULT '0' COMMENT '機能種別',
  `created` datetime DEFAULT NULL COMMENT '登録日時',
  `modified` datetime DEFAULT NULL COMMENT '最終更新日時',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `layouts`
--

LOCK TABLES `layouts` WRITE;
/*!40000 ALTER TABLE `layouts` DISABLE KEYS */;
INSERT INTO `layouts` VALUES (1,'1列',1,1,'2019-03-25 13:00:00','2019-03-25 13:00:00'),(2,'2列',2,1,'2019-03-25 13:00:00','2019-03-25 13:00:00'),(3,'3列',3,1,'2019-03-25 13:00:00','2019-03-25 13:00:00'),(4,'4列',4,1,'2019-03-25 13:00:00','2019-03-25 13:00:00'),(5,'6列',6,1,'2019-03-25 13:00:00','2019-03-25 13:00:00');
/*!40000 ALTER TABLE `layouts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tasks`
--

DROP TABLE IF EXISTS `tasks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tasks` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(60) DEFAULT NULL COMMENT 'タスク名',
  `due_date` date DEFAULT NULL COMMENT '期限',
  `color_code` varchar(30) DEFAULT '#FFFFFF' COMMENT 'カラーコード',
  `search_memo` text COMMENT 'メモ検索用カラム',
  `pin_flag` tinyint(1) DEFAULT '0' COMMENT 'ピン止めフラグ',
  `created` datetime DEFAULT NULL COMMENT '登録日時',
  `modified` datetime DEFAULT NULL COMMENT '最終更新日時',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tasks`
--

LOCK TABLES `tasks` WRITE;
/*!40000 ALTER TABLE `tasks` DISABLE KEYS */;
INSERT INTO `tasks` VALUES (13,'20190327_タスク',NULL,'#ffffd6','コードリファクタリング 打ち合わせ参加 ',NULL,'2019-03-27 11:13:46','2019-03-27 11:13:46'),(14,'プレゼン資料','2019-04-27','#ffd6ff','先方に提出 ',1,'2019-03-27 11:15:07','2019-03-27 11:15:07'),(15,'20190326_タスク',NULL,'#ffffff','実装（9割完了させる） ',NULL,'2019-03-27 11:16:14','2019-03-27 11:16:14'),(16,'ローソン有り','2019-03-26','#ead6ff','てすと ※コード ',0,'2019-03-27 11:23:23','2019-03-27 11:38:16');
/*!40000 ALTER TABLE `tasks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tasks_details`
--

DROP TABLE IF EXISTS `tasks_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tasks_details` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tasks_id` bigint(20) unsigned NOT NULL,
  `memo` text COMMENT 'メモ',
  `done_flg` tinyint(4) DEFAULT '0' COMMENT '完了フラグ',
  `created` datetime DEFAULT NULL COMMENT '登録日時',
  `modified` datetime DEFAULT NULL COMMENT '最終更新日時',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=123 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tasks_details`
--

LOCK TABLES `tasks_details` WRITE;
/*!40000 ALTER TABLE `tasks_details` DISABLE KEYS */;
INSERT INTO `tasks_details` VALUES (116,13,'コードリファクタリング',0,'2019-03-27 11:13:46','2019-03-27 11:13:46'),(117,13,'打ち合わせ参加',0,'2019-03-27 11:13:46','2019-03-27 11:13:46'),(118,14,'先方に提出',0,'2019-03-27 11:15:07','2019-03-27 11:15:07'),(119,15,'実装（9割完了させる）',1,'2019-03-27 11:16:14','2019-03-27 11:20:42');
/*!40000 ALTER TABLE `tasks_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tasks_layouts`
--

DROP TABLE IF EXISTS `tasks_layouts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tasks_layouts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `layouts_id` bigint(20) unsigned NOT NULL COMMENT 'レイアウトID',
  `created` datetime DEFAULT NULL COMMENT '登録日時',
  `modified` datetime DEFAULT NULL COMMENT '最終更新日時',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tasks_layouts`
--

LOCK TABLES `tasks_layouts` WRITE;
/*!40000 ALTER TABLE `tasks_layouts` DISABLE KEYS */;
INSERT INTO `tasks_layouts` VALUES (2,3,'2019-03-27 11:06:59','2019-03-27 11:38:05');
/*!40000 ALTER TABLE `tasks_layouts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` varchar(20) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-03-26 19:59:13
