-- MySQL dump 10.13  Distrib 5.7.25, for Linux (x86_64)
--
-- Host: localhost    Database: engima
-- ------------------------------------------------------
-- Server version	5.7.25-0ubuntu0.18.04.2

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
-- Table structure for table `genre`
--

DROP TABLE IF EXISTS `genre`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `genre` (
  `id_genre` char(5) NOT NULL,
  `genre_name` varchar(25) NOT NULL,
  PRIMARY KEY (`id_genre`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `genre`
--

LOCK TABLES `genre` WRITE;
/*!40000 ALTER TABLE `genre` DISABLE KEYS */;
INSERT INTO `genre` VALUES ('GEN01','Comedy'),('GEN02','Horror'),('GEN03','Romance'),('GEN04','Sci-Fi'),('GEN06','Drama'),('GEN07','Action'),('GEN08','Documentary'),('GEN09','Thriller'),('GEN10','Rom-Com'),('GEN11','Fantasy'),('GEN12','Biography'),('GEN13','Famuly'),('GEN14','Musical'),('GEN15','Adventure');
/*!40000 ALTER TABLE `genre` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `movie`
--

DROP TABLE IF EXISTS `movie`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `movie` (
  `id_movie` char(7) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `runtime` int(10) unsigned NOT NULL,
  `tanggal_rilis` date NOT NULL,
  `sinopsis` longtext NOT NULL,
  `poster` longblob NOT NULL,
  PRIMARY KEY (`id_movie`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `movie`
--

LOCK TABLES `movie` WRITE;
/*!40000 ALTER TABLE `movie` DISABLE KEYS */;
INSERT INTO `movie` VALUES ('MOV0001','Anna',118,'2019-06-22','Di balik keanggunan Anna Poliatova (Sasha Luss) terdapat sebuah rahasia. Model cantik ini adalah senjata yang sangat mematikan.Kemampuannya membunuh di lapangan menjadikan Anna salah satu agen rahasia yang paling ditakuti.',_binary 'home/muhnrdnhsn/Desktop/IF310/tugas-besar-1-2019/src/back-end/database/movpos_Anna.jpg'),('MOV0002','Bumi Manusia',181,'2019-08-15','Ini adalah kisah dua anak manusia yang meramu cinta di atas pentas pergelutan tanah kolonial awal abad 20.Inilah kisah Minke dan Annelies. Cinta yang hadir di hati Minke untuk Annelies, membuatnya mengalami pergulatan batin tak berkesudahan. Dia, pemuda pribumi, Jawa totok. Sementara Annelies, gadis Indo Belanda anak seorang Nyai.Bapak Minke yang baru saja diangkat jadi Bupati, tak pernah setuju Minke dekat dengan keluarga Nyai, sebab posisi Nyai di masa itu dianggap sama rendah dengan binatang peliharaan.Namun Nyai yang satu ini, Nyai Ontosoroh, ibunda Annelies, berbeda. Minke mengagumi segala pemikiran dan perjuangannya melawan keangkuhan hegemoni bangsa kolonial.Bagi Minke, Nyai Ontosoroh adalah cerminan modernisasi yang kala itu sedang memulai geliatnya. Ketika keangkuhan hukum kolonial mencoba merenggut paksa Annelies dari sisi Minke, Nyai Ontosoroh pula yang meletupkan semangat agar Minke terus maju dan memekikkan satu kata, \"Lawan!\" ',_binary 'home/muhnrdnhsn/Desktop/IF310/tugas-besar-1-2019/src/back-end/database/movpos_BumiManusia.jpg'),('MOV0003','47 METERS DOWN: UNCAGED',90,'2019-08-23','Liburan empat gadis untuk menyelam ke sebuah kota bawah air yang hancur berubah menjadi tragedi.Nyawa mereka terancam saat hiu ganas berada disekitar mereka. Kini keempatnya berusaha menyelamatkan diri dari ganasnya gigi tajam hiu besar.',_binary 'home/muhnrdnhsn/Desktop/IF310/tugas-besar-1-2019/src/back-end/database/movpos_47MetersDown.jpg'),('MOV0004','ANGEL HAS FALLEN',121,'2019-08-21','Liburan empat gadis untuk menyelam ke sebuah kota bawah air yang hancur berubah menjadi tragedi.Nyawa mereka terancam saat hiu ganas berada disekitar mereka. Kini keempatnya berusaha menyelamatkan diri dari ganasnya gigi tajam hiu besar.Pasca percobaan pembunuhan Presiden AS. Agen rahasia Mike Banning (Gerard Butler) kini menjadi tersangka utama. Tidak terima, Mike kabur dan berusaha mengungkap pihak yang telah menjebaknya.',_binary 'home/muhnrdnhsn/Desktop/IF310/tugas-besar-1-2019/src/back-end/database/movpos_AngleHasFallen.jpg'),('MOV0005','ONCE UPON A TIME IN HOLLYWOOD',160,'2019-08-24','Mengambil latar Los Angeles tahun 1969, Once Upon a Time in Hollywood akan berkisah tentang Rick Dalton (Leonardo DiCaprio), seorang bintang televisi yang pernah berjaya di masanya. Dengan berkembangnya industri layar lebar hollywood, Rick dan pemeran penggantinya Cliff Booth (Brad Pitt) memutuskan bekerja sama untuk mengejar karir di industri film.',_binary 'home/muhnrdnhsn/Desktop/IF310/tugas-besar-1-2019/src/back-end/database/movpos_OnceUponATimeInHollywood.jpg');
/*!40000 ALTER TABLE `movie` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `moviegenre`
--

DROP TABLE IF EXISTS `moviegenre`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `moviegenre` (
  `id_movie` char(7) NOT NULL,
  `id_genre` char(5) NOT NULL,
  PRIMARY KEY (`id_movie`,`id_genre`),
  KEY `fk_moviegenre_1_idx` (`id_genre`),
  CONSTRAINT `fk_moviegenre_1` FOREIGN KEY (`id_genre`) REFERENCES `genre` (`id_genre`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_moviegenre_2` FOREIGN KEY (`id_movie`) REFERENCES `movie` (`id_movie`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `moviegenre`
--

LOCK TABLES `moviegenre` WRITE;
/*!40000 ALTER TABLE `moviegenre` DISABLE KEYS */;
INSERT INTO `moviegenre` VALUES ('MOV0005','GEN01'),('MOV0003','GEN02'),('MOV0002','GEN06'),('MOV0003','GEN06'),('MOV0005','GEN06'),('MOV0001','GEN07'),('MOV0004','GEN07'),('MOV0001','GEN09'),('MOV0003','GEN15');
/*!40000 ALTER TABLE `moviegenre` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `moviereview`
--

DROP TABLE IF EXISTS `moviereview`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `moviereview` (
  `id_review` char(7) NOT NULL,
  `id_movie` char(7) NOT NULL,
  `username` varchar(20) NOT NULL,
  PRIMARY KEY (`id_review`,`id_movie`,`username`),
  KEY `fk_moviereview_1_idx` (`id_movie`),
  KEY `fk_moviereview_3_idx` (`username`),
  CONSTRAINT `fk_moviereview_1` FOREIGN KEY (`id_movie`) REFERENCES `movie` (`id_movie`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_moviereview_2` FOREIGN KEY (`id_review`) REFERENCES `review` (`id_review`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_moviereview_3` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `moviereview`
--

LOCK TABLES `moviereview` WRITE;
/*!40000 ALTER TABLE `moviereview` DISABLE KEYS */;
/*!40000 ALTER TABLE `moviereview` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `review`
--

DROP TABLE IF EXISTS `review`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `review` (
  `id_review` char(7) NOT NULL,
  `description` longtext NOT NULL,
  `rating` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id_review`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `review`
--

LOCK TABLES `review` WRITE;
/*!40000 ALTER TABLE `review` DISABLE KEYS */;
/*!40000 ALTER TABLE `review` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `schedule`
--

DROP TABLE IF EXISTS `schedule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `schedule` (
  `id_schedule` char(15) NOT NULL,
  `jadwal` datetime NOT NULL,
  `id_movie` char(7) NOT NULL,
  PRIMARY KEY (`id_schedule`),
  KEY `fk_schedule_1_idx` (`id_movie`),
  CONSTRAINT `fk_schedule_1` FOREIGN KEY (`id_movie`) REFERENCES `movie` (`id_movie`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `schedule`
--

LOCK TABLES `schedule` WRITE;
/*!40000 ALTER TABLE `schedule` DISABLE KEYS */;
/*!40000 ALTER TABLE `schedule` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `seat`
--

DROP TABLE IF EXISTS `seat`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `seat` (
  `id_seat` int(10) unsigned NOT NULL,
  `status` int(10) unsigned NOT NULL,
  `id_schedule` char(15) NOT NULL,
  `harga` bigint(10) unsigned NOT NULL,
  PRIMARY KEY (`id_seat`),
  KEY `fk_seat_1_idx` (`id_schedule`),
  CONSTRAINT `fk_seat_1` FOREIGN KEY (`id_schedule`) REFERENCES `schedule` (`id_schedule`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `seat`
--

LOCK TABLES `seat` WRITE;
/*!40000 ALTER TABLE `seat` DISABLE KEYS */;
/*!40000 ALTER TABLE `seat` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transaction`
--

DROP TABLE IF EXISTS `transaction`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transaction` (
  `id_transaction` char(15) NOT NULL,
  `username` varchar(20) NOT NULL,
  `id_seat` int(10) unsigned NOT NULL,
  `id_schedule` char(15) NOT NULL,
  PRIMARY KEY (`id_transaction`),
  KEY `fk_transaction_1_idx` (`username`),
  KEY `fk_transaction_2_idx` (`id_seat`),
  KEY `fk_transaction_3_idx` (`id_schedule`),
  CONSTRAINT `fk_transaction_1` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_transaction_2` FOREIGN KEY (`id_seat`) REFERENCES `seat` (`id_seat`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_transaction_3` FOREIGN KEY (`id_schedule`) REFERENCES `schedule` (`id_schedule`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transaction`
--

LOCK TABLES `transaction` WRITE;
/*!40000 ALTER TABLE `transaction` DISABLE KEYS */;
/*!40000 ALTER TABLE `transaction` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `username` varchar(20) NOT NULL,
  `email` varchar(13) NOT NULL,
  `no_telp` varchar(50) NOT NULL,
  `pictureprofile` longblob NOT NULL,
  `password` varchar(100) NOT NULL,
  `token` varchar(100) NOT NULL,
  `token_expdate` datetime NOT NULL,
  PRIMARY KEY (`username`),
  UNIQUE KEY `email_UNIQUE` (`no_telp`),
  UNIQUE KEY `no_telp_UNIQUE` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
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

-- Dump completed on 2019-09-22 20:06:17
