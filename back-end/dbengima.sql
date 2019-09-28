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
INSERT INTO `genre` VALUES ('GEN01','Comedy'),('GEN02','Horror'),('GEN03','Romance'),('GEN04','Sci-Fi'),('GEN06','Drama'),('GEN07','Action'),('GEN08','Documentary'),('GEN09','Thriller'),('GEN10','Rom-Com'),('GEN11','Fantasy'),('GEN12','Biography'),('GEN13','Family'),('GEN14','Musical'),('GEN15','Adventure'),('GEN16','Superhero'),('GEN17','Crime'),('GEN18','Mystery');
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
INSERT INTO `movie` VALUES ('mov0001','47 Meters Down: Uncaged',90,'2019-08-23','Liburan empat gadis untuk menyelam ke sebuah kota bawah air yang hancur berubah menjadi tragedi.Nyawa mereka terancam saat hiu ganas berada disekitar mereka. Kini keempatnya berusaha menyelamatkan diri dari ganasnya gigi tajam hiu besar.',_binary 'localhost:8888/src/back-end/pictures/movies/mov0001.jpg'),('mov0002','Angel Has Fallen',121,'2019-08-21','Pasca percobaan pembunuhan Presiden AS. Agen rahasia Mike Banning (Gerard Butler) kini menjadi tersangka utama. Tidak terima, Mike kabur dan berusaha mengungkap pihak yang telah menjebaknya.',_binary 'localhost:8888/src/back-end/pictures/movies/mov0002.jpg'),('mov0003','ANNA',118,'2019-06-22','Di balik keanggunan Anna Poliatova (Sasha Luss) terdapat sebuah rahasia. Model cantik ini adalah senjata yang sangat mematikan.Kemampuannya membunuh di lapangan menjadikan Anna salah satu agen rahasia yang paling ditakuti.',_binary 'localhost:8888/src/back-end/pictures/movies/mov0003.jpg'),('mov0004','Bumi Manusia',181,'2019-08-15','Ini adalah kisah dua anak manusia yang meramu cinta di atas pentas pergelutan tanah kolonial awal abad 20.Inilah kisah Minke dan Annelies. Cinta yang hadir di hati Minke untuk Annelies, membuatnya mengalami pergulatan batin tak berkesudahan. Dia, pemuda pribumi, Jawa totok. Sementara Annelies, gadis Indo Belanda anak seorang Nyai.Bapak Minke yang baru saja diangkat jadi Bupati, tak pernah setuju Minke dekat dengan keluarga Nyai, sebab posisi Nyai di masa itu dianggap sama rendah dengan binatang peliharaan.Namun Nyai yang satu ini, Nyai Ontosoroh, ibunda Annelies, berbeda. Minke mengagumi segala pemikiran dan perjuangannya melawan keangkuhan hegemoni bangsa kolonial.Bagi Minke, Nyai Ontosoroh adalah cerminan modernisasi yang kala itu sedang memulai geliatnya. Ketika keangkuhan hukum kolonial mencoba merenggut paksa Annelies dari sisi Minke, Nyai Ontosoroh pula yang meletupkan semangat agar Minke terus maju dan memekikkan satu kata, \"Lawan!\" ',_binary 'localhost:8888/src/back-end/pictures/movies/mov0004.jpg'),('mov0005','Once Upon A Time In Hollywood',160,'2019-08-24','Mengambil latar Los Angeles tahun 1969, Once Upon a Time in Hollywood akan berkisah tentang Rick Dalton (Leonardo DiCaprio), seorang bintang televisi yang pernah berjaya di masanya. Dengan berkembangnya industri layar lebar hollywood, Rick dan pemeran penggantinya Cliff Booth (Brad Pitt) memutuskan bekerja sama untuk mengejar karir di industri film.',_binary 'localhost:8888/src/back-end/pictures/movies/mov0005.jpg'),('mov0006','Ready Or Not',94,'2019-08-24','Ready or Not adalah kisah seorang pengantin muda (Samara Weaving) ketika ia bergabung dengan keluarga besar suami barunya (Mark O\'Brien) yang kaya dan eksentrik (Adam Brody, Henry Czerny, Andie MacDowell) dalam tradisi keluarga yang berubah menjadi permainan mematikan dengan semua orang berjuang untuk bertahan hidup.',_binary 'localhost:8888/src/back-end/pictures/movies/mov0006.jpg'),('mov0007','Gundala',123,'2019-08-29','Sancaka hidup di jalanan sejak ditinggal ayah dan ibunya. Menghadapi hidup yang keras, Sancaka belajar untuk bertahan hidup dengan tidak peduli dengan orang lain dan hanya mencoba untuk mendapatkan tempat yang aman bagi dirinya sendiri. Ketika situasi kota semakin tidak aman dan ketidakadilan merajalela di seluruh negeri, Sancaka harus buat keputusan yang berat, tetap hidup di zona amannya, atau keluar sebagai Gundala untuk membela orang-orang yang ditindas.',_binary 'localhost:8888/src/back-end/pictures/movies/mov0007.jpg'),('mov0008','Twivortiare',103,'2019-08-29','Pertama mereka bertemu, langsung jatuh cinta. Dalam hitungan bulan, mereka menikah. Setelah dua tahun, setelah lelah dengan semua konflik dan pertengkaran yang tak berujung, akhirnya, sang Dokter Bedah yang super sibuk, Beno Wicaksono (REZA RAHARDIAN), dan Sang Bankir sukses, Alexandra Rhea (RAIHAANUN) memutuskan untuk bercerai.Sahabat Alex, Wina (ANGGIKA BOLSTERI), menyebutnya sebagai perceraian yang tak pernah serius berpisah, karena tautan berbagai peristiwa senantiasa mempertemukan mereka. Sekali pun ada laki-laki lain, Denny (DENNY SUMARGO) yang berusaha mengisi hati Alexandra, tapi tetap saja, kuatnya rasa cinta yang dipaksa untuk mati, malah makin bersemi. Mereka pun bersatu lagi. Pernikahan kedua pun terjadi.Kali ini Beno dan Alex berjanji, akan menjalani pernikahan ini dengan sikap lebih dewasa, saling mengerti dan mau mengalah. Mereka yakin, mereka bisa, karena masih saling cinta. Tapi apakah benar, cinta saja cukup? atau yang mereka rasakan itu... bukanlah cinta?',_binary 'localhost:8888/src/back-end/pictures/movies/mov0008.jpg'),('mov0009','IT Chapter Two',168,'2019-09-04','Seri kedua akan melanjutkan kisah para anggota Losers Club.Dua puluh tujuh tahun setelah pertemuan pertama mereka dengan Pennywise yang menakutkan, Losers Club telah dewasa dan berpisah.Sampai sebuah panggilan telepon membawa Losers Club kembali untuk bertemu hantu kelam dari masa lalu mereka.',_binary 'localhost:8888/src/back-end/pictures/movies/mov0009.jpg'),('mov0010','Chasing The Dragon II: Wild Wild Bunch',101,'2019-09-06','Chasing the Dragon II: Wild Wild Bunch diangkat dari kejadian nyata yang pernah terjadi di Hong Kong pada 1990-an. Logan (Tony Leung Ka Fai) adalah kepala geng yang melakukan bisnis perdagangan manusia.Untuk menangkap ketua geng, kepolisian Hong Kong memutuskan untuk mengirim Sky (Louis Koo), agen rahasia yang misinya adalah untuk menyusup, menyelamatkan sandera dan menangkap seluruh kelompok Logan dan membawa mereka ke pengadilan.',_binary 'localhost:8888/src/back-end/pictures/movies/mov0010.jpg'),('mov0011','CHHICHHORE',143,'2019-09-06','Chhichhore akan membawa kisah penuh kegembiraan dan kesenangan yang terjadi di sebuah asrama kampus. Dunia di mana seseorang bertemu dengan karakter baru yang menarik, berbagi waktu bersama dan berakhir jadi teman sejati seumur hidup.Anni (Sushant Singh Rajput) Maya (Shraddha Kapoor) Sexa (Varun Sharma), Derek (Tahir Raj Bhasin), Mummy (Tushar Pandey), Acid (Naveen Polishetty) dan Bevda (Saharsh Shukla) adalah karakter yang bertemu di kampus dan menjadi sahabat. Bersama-sama, kelompok ini akan menjalani masa-masa indah, senang dan sedih. Saat mereka berpisah, kelompok ini akhirnya bertemu kembali dengan cara yang tidak pernah mereka pikirkan sebelumnya.',_binary 'localhost:8888/src/back-end/pictures/movies/mov0011.jpg'),('mov0012','Warkop DKI Reborn',103,'2019-09-12','Warkop DKI - Dono, Kasino, Indro kali ini mendapat tugas sebagai agen polisi rahasia. Mereka dibawah komando Komandan Cok, yang kehilangan tangan kanannya, Karman, saat mensinyalir adanya money laundry di dunia perfilman Indonesia. Tepatnya di sebuah PH yang dimiliki Amir Muka. Warkop DKI akhirnya bisa masuk dalam dunia film dan terlibat dalam sebuah pembuatan film komedi berpasangan dengan artis sinetron yang hijrah ke dunia film, Inka.Saat party, Warkop DKI yang sedang menyelidiki malah membuat Inka terjebak bersama mereka di sebuah ruangan. Warkop DKI dan Inka jatuh pingsan. Saat terbangun, Warkop DKI kaget karena berada di padang pasir! Tapi Inka lenyap! Pencarian Warkop DKI mencari jejak Inka, malah menyeret mereka dalam petualangan seru di padang pasir...',_binary 'localhost:8888/src/back-end/pictures/movies/mov0012.jpg'),('mov0013','Lorong',93,'2019-09-12','Terbangun pasca melahirkan, MAYANG (PRISIA NASUTION) mendapatkan kabar tidak seperti yang ia harapkan dari REZA (WINKY WIRYAWAN) sang suami, bahwa bayi pertama mereka telah meninggal dunia. Tapi kerelaan Mayang sebagai seorang ibu tidak begitu saja. Mayang mencari bayinya yang semua orang di rumah sakit yakin bahwa dirinya hanya berhalusinasi.Dia lantas menghubungi pihak kepolisian untuk mencari titik terang kasus janggal ini. Usaha Mayang menemui jalan buntu setelah dr. VERA (NOVA ELIZA) yang membantunya melahirkan, berhasil memberikan bukti berupa dokumen kematian bayinya, lengkap dengan beberapa foto kejadian. Di tengah keputusasaan, Mayang yang memilih tidak menyerah akhirnya mulai dianggap gila oleh sebagian orang di rumah sakit, termasuk suaminya sendiri. Hal ini ditambah dengan Mayang yang merasa terus diikuti roh penasaran. Apa yang sebenarnya terjadi? Dan siapakah yang benar, Mayang atau pihak rumah sakit dan Reza?',_binary 'localhost:8888/src/back-end/pictures/movies/mov0013.jpg'),('mov0014','BOO!',88,'2018-10-12','Berawal dari sebuah lelucon, sebuah keluarga mendapat teror mengerikan dari iblis yang datang mengancam mereka. Nyawa satu keluarga terancam karena mereka mengabaikan peringatan. Sang ayah yang tidak percaya dengan lelucon itu akhirnya menyadari ada kekuatan jahat datang dan meneror keluarganya.',_binary 'localhost:8888/src/back-end/pictures/movies/mov0014.jpg'),('mov0015','Rambo: Last Blood',99,'2019-09-18','John Rambo (Sylvester Stallone) harus menghadapi masa lalunya dan kembali mengeluarkan keterampilan tempurnya untuk membalas dendam dalam misi terakhir yang sangat berbahaya.',_binary 'localhost:8888/src/back-end/pictures/movies/mov0015.jpg');
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
INSERT INTO `moviegenre` VALUES ('mov0005','GEN01'),('mov0011','GEN01'),('mov0012','GEN01'),('mov0001','GEN02'),('mov0006','GEN02'),('mov0009','GEN02'),('mov0013','GEN02'),('mov0014','GEN02'),('mov0001','GEN06'),('mov0004','GEN06'),('mov0005','GEN06'),('mov0008','GEN06'),('mov0011','GEN06'),('mov0014','GEN06'),('mov0002','GEN07'),('mov0003','GEN07'),('mov0007','GEN07'),('mov0010','GEN07'),('mov0015','GEN07'),('mov0003','GEN09'),('mov0006','GEN09'),('mov0009','GEN09'),('mov0013','GEN09'),('mov0010','GEN12'),('mov0001','GEN15'),('mov0007','GEN16'),('mov0010','GEN17'),('mov0014','GEN18');
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
INSERT INTO `moviereview` VALUES ('REV0001','mov0001','nurdin'),('REV0002','mov0002','nurdin');
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
INSERT INTO `review` VALUES ('REV0001','Filmnya mantap gan',5),('REV0002','Filmnya mantap gan',7);
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
  `email` varchar(100) NOT NULL,
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
INSERT INTO `user` VALUES ('nurdin','muhnrdnhsn@gmail.com','+6285781234123',_binary 'nurdin.jpg','123456','INITOKEN','2019-09-25 12:24:00');
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

-- Dump completed on 2019-09-28 10:27:49
