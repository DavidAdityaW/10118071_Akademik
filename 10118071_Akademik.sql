-- MySQL dump 10.13  Distrib 8.0.21, for Win64 (x86_64)
--
-- Host: localhost    Database: 10118071_akademik
-- ------------------------------------------------------
-- Server version	8.0.21

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
-- Table structure for table `tb_dosen`
--

DROP TABLE IF EXISTS `tb_dosen`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_dosen` (
  `id_dsn` int NOT NULL AUTO_INCREMENT,
  `nip` char(15) NOT NULL,
  `nama_dsn` varchar(50) NOT NULL,
  `jk` char(1) NOT NULL,
  `agama` varchar(15) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `no_telp` char(15) NOT NULL,
  `alamat` text NOT NULL,
  PRIMARY KEY (`id_dsn`),
  UNIQUE KEY `nip` (`nip`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_dosen`
--

LOCK TABLES `tb_dosen` WRITE;
/*!40000 ALTER TABLE `tb_dosen` DISABLE KEYS */;
INSERT INTO `tb_dosen` VALUES (1,'12345001','Andry Heryandi, MT.','L','Islam','1990-01-01','081848364898','Jln. Soekarno Hatta'),(2,'12345002','Maya Hermawati, S.Kom.','P','Islam','1999-02-04','089772836283','Jln. Cahaya Permata'),(3,'12345003','Angga Setyadi, M.Kom.','L','Islam','1987-07-03','089262871628','Jln. Asri Indah');
/*!40000 ALTER TABLE `tb_dosen` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_jurusan`
--

DROP TABLE IF EXISTS `tb_jurusan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_jurusan` (
  `kode_jsn` char(8) NOT NULL,
  `nama_jsn` varchar(25) NOT NULL,
  PRIMARY KEY (`kode_jsn`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_jurusan`
--

LOCK TABLES `tb_jurusan` WRITE;
/*!40000 ALTER TABLE `tb_jurusan` DISABLE KEYS */;
INSERT INTO `tb_jurusan` VALUES ('MJ','Manajemen (S1)'),('SI','Sistem Informasi (S1)'),('SK','Sistem Komputer (D3)'),('TE','Teknik Elektro (S1)'),('TI','Teknik Informatika (S1)');
/*!40000 ALTER TABLE `tb_jurusan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_mahasiswa`
--

DROP TABLE IF EXISTS `tb_mahasiswa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_mahasiswa` (
  `id_mhs` int NOT NULL AUTO_INCREMENT,
  `nim` char(8) NOT NULL,
  `nama_mhs` varchar(50) NOT NULL,
  `jk` char(1) NOT NULL,
  `agama` varchar(15) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `no_telp` char(15) NOT NULL,
  `alamat` text NOT NULL,
  `kode_jsn` char(8) NOT NULL,
  PRIMARY KEY (`id_mhs`),
  UNIQUE KEY `nim` (`nim`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_mahasiswa`
--

LOCK TABLES `tb_mahasiswa` WRITE;
/*!40000 ALTER TABLE `tb_mahasiswa` DISABLE KEYS */;
INSERT INTO `tb_mahasiswa` VALUES (1,'10118071','David Aditya W','L','Islam','1999-10-08','083121153350','Jln. Belendung','TI'),(3,'10118072','Dinda Nurhaliza','P','Islam','2000-11-08','089368261839','Jln. Citra Indah','MJ'),(5,'10118073','Aji Septian','L','Islam','1998-08-13','081383638489','Jln. Surya Abadi','SI');
/*!40000 ALTER TABLE `tb_mahasiswa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_matakuliah`
--

DROP TABLE IF EXISTS `tb_matakuliah`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_matakuliah` (
  `kode_mk` char(8) NOT NULL,
  `nama_mk` varchar(25) NOT NULL,
  `sks` int NOT NULL,
  `semester` int NOT NULL,
  PRIMARY KEY (`kode_mk`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_matakuliah`
--

LOCK TABLES `tb_matakuliah` WRITE;
/*!40000 ALTER TABLE `tb_matakuliah` DISABLE KEYS */;
INSERT INTO `tb_matakuliah` VALUES ('MT04','Matematika Numerik',3,4),('PG04','Provis GUI',3,4),('SB04','Basis Data 2',4,4),('SI04','Sistem Informasi',2,4),('SO04','Sistem Operasi',2,4);
/*!40000 ALTER TABLE `tb_matakuliah` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_perkuliahan`
--

DROP TABLE IF EXISTS `tb_perkuliahan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_perkuliahan` (
  `id_pk` int NOT NULL AUTO_INCREMENT,
  `tgl_pk` date NOT NULL,
  `nim` char(8) NOT NULL,
  `kode_mk` char(8) NOT NULL,
  `nip` char(15) NOT NULL,
  PRIMARY KEY (`id_pk`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_perkuliahan`
--

LOCK TABLES `tb_perkuliahan` WRITE;
/*!40000 ALTER TABLE `tb_perkuliahan` DISABLE KEYS */;
INSERT INTO `tb_perkuliahan` VALUES (5,'2020-08-15','10118071','PG04','12345001'),(7,'2020-08-15','10118072','MT04','12345002');
/*!40000 ALTER TABLE `tb_perkuliahan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_users`
--

DROP TABLE IF EXISTS `tb_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tb_users` (
  `id_users` int NOT NULL AUTO_INCREMENT,
  `nama_users` varchar(50) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `role` enum('admin','operator') NOT NULL,
  PRIMARY KEY (`id_users`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_users`
--

LOCK TABLES `tb_users` WRITE;
/*!40000 ALTER TABLE `tb_users` DISABLE KEYS */;
INSERT INTO `tb_users` VALUES (4,'David Aditya W','admin','admin','admin'),(5,'Vieds Aditya','operator','operator','operator');
/*!40000 ALTER TABLE `tb_users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-08-18 20:49:58
