-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 18, 2020 at 04:08 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `10118071_akademik`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_dosen`
--

CREATE TABLE IF NOT EXISTS `tb_dosen` (
`id_dsn` int(11) NOT NULL,
  `nip` char(15) NOT NULL,
  `nama_dsn` varchar(50) NOT NULL,
  `jk` char(1) NOT NULL,
  `agama` varchar(15) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `no_telp` char(15) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_dosen`
--

INSERT INTO `tb_dosen` (`id_dsn`, `nip`, `nama_dsn`, `jk`, `agama`, `tgl_lahir`, `no_telp`, `alamat`) VALUES
(1, '12345001', 'Andry Heryandi, MT.', 'L', 'Islam', '1990-01-01', '081848364898', 'Jln. Soekarno Hatta'),
(2, '12345002', 'Maya Hermawati, S.Kom.', 'P', 'Islam', '1999-02-04', '089772836283', 'Jln. Cahaya Permata'),
(3, '12345003', 'Angga Setyadi, M.Kom.', 'L', 'Islam', '1987-07-03', '089262871628', 'Jln. Asri Indah');

-- --------------------------------------------------------

--
-- Table structure for table `tb_jurusan`
--

CREATE TABLE IF NOT EXISTS `tb_jurusan` (
  `kode_jsn` char(8) NOT NULL,
  `nama_jsn` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_jurusan`
--

INSERT INTO `tb_jurusan` (`kode_jsn`, `nama_jsn`) VALUES
('MJ', 'Manajemen (S1)'),
('SI', 'Sistem Informasi (S1)'),
('SK', 'Sistem Komputer (D3)'),
('TE', 'Teknik Elektro (S1)'),
('TI', 'Teknik Informatika (S1)');

-- --------------------------------------------------------

--
-- Table structure for table `tb_mahasiswa`
--

CREATE TABLE IF NOT EXISTS `tb_mahasiswa` (
`id_mhs` int(11) NOT NULL,
  `nim` char(8) NOT NULL,
  `nama_mhs` varchar(50) NOT NULL,
  `jk` char(1) NOT NULL,
  `agama` varchar(15) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `no_telp` char(15) NOT NULL,
  `alamat` text NOT NULL,
  `kode_jsn` char(8) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_mahasiswa`
--

INSERT INTO `tb_mahasiswa` (`id_mhs`, `nim`, `nama_mhs`, `jk`, `agama`, `tgl_lahir`, `no_telp`, `alamat`, `kode_jsn`) VALUES
(1, '10118071', 'David Aditya W', 'L', 'Islam', '1999-10-08', '083121153350', 'Jln. Belendung', 'TI'),
(3, '10118072', 'Dinda Nurhaliza', 'P', 'Islam', '2000-11-08', '089368261839', 'Jln. Citra Indah', 'MJ'),
(5, '10118073', 'Aji Septian', 'L', 'Islam', '1998-08-13', '081383638489', 'Jln. Surya Abadi', 'SI');

-- --------------------------------------------------------

--
-- Table structure for table `tb_matakuliah`
--

CREATE TABLE IF NOT EXISTS `tb_matakuliah` (
  `kode_mk` char(8) NOT NULL,
  `nama_mk` varchar(25) NOT NULL,
  `sks` int(11) NOT NULL,
  `semester` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_matakuliah`
--

INSERT INTO `tb_matakuliah` (`kode_mk`, `nama_mk`, `sks`, `semester`) VALUES
('MT04', 'Matematika Numerik', 3, 4),
('PG04', 'Provis GUI', 3, 4),
('SB04', 'Basis Data 2', 4, 4),
('SI04', 'Sistem Informasi', 2, 4),
('SO04', 'Sistem Operasi', 2, 4);

-- --------------------------------------------------------

--
-- Table structure for table `tb_perkuliahan`
--

CREATE TABLE IF NOT EXISTS `tb_perkuliahan` (
`id_pk` int(11) NOT NULL,
  `tgl_pk` date NOT NULL,
  `nim` char(8) NOT NULL,
  `kode_mk` char(8) NOT NULL,
  `nip` char(15) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_perkuliahan`
--

INSERT INTO `tb_perkuliahan` (`id_pk`, `tgl_pk`, `nim`, `kode_mk`, `nip`) VALUES
(5, '2020-08-15', '10118071', 'PG04', '12345001'),
(7, '2020-08-15', '10118072', 'MT04', '12345002');

-- --------------------------------------------------------

--
-- Table structure for table `tb_users`
--

CREATE TABLE IF NOT EXISTS `tb_users` (
`id_users` int(11) NOT NULL,
  `nama_users` varchar(50) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `role` enum('admin','operator') NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_users`
--

INSERT INTO `tb_users` (`id_users`, `nama_users`, `username`, `password`, `role`) VALUES
(4, 'David Aditya W', 'admin', 'admin', 'admin'),
(5, 'Vieds Aditya', 'operator', 'operator', 'operator');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_dosen`
--
ALTER TABLE `tb_dosen`
 ADD PRIMARY KEY (`id_dsn`), ADD UNIQUE KEY `nip` (`nip`);

--
-- Indexes for table `tb_jurusan`
--
ALTER TABLE `tb_jurusan`
 ADD PRIMARY KEY (`kode_jsn`);

--
-- Indexes for table `tb_mahasiswa`
--
ALTER TABLE `tb_mahasiswa`
 ADD PRIMARY KEY (`id_mhs`), ADD UNIQUE KEY `nim` (`nim`);

--
-- Indexes for table `tb_matakuliah`
--
ALTER TABLE `tb_matakuliah`
 ADD PRIMARY KEY (`kode_mk`);

--
-- Indexes for table `tb_perkuliahan`
--
ALTER TABLE `tb_perkuliahan`
 ADD PRIMARY KEY (`id_pk`);

--
-- Indexes for table `tb_users`
--
ALTER TABLE `tb_users`
 ADD PRIMARY KEY (`id_users`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_dosen`
--
ALTER TABLE `tb_dosen`
MODIFY `id_dsn` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tb_mahasiswa`
--
ALTER TABLE `tb_mahasiswa`
MODIFY `id_mhs` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tb_perkuliahan`
--
ALTER TABLE `tb_perkuliahan`
MODIFY `id_pk` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tb_users`
--
ALTER TABLE `tb_users`
MODIFY `id_users` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
