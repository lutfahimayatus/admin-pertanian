-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 30, 2022 at 03:32 AM
-- Server version: 5.7.21
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `admin_pertanian`
--

-- --------------------------------------------------------

--
-- Table structure for table `akses`
--

DROP TABLE IF EXISTS `akses`;
CREATE TABLE IF NOT EXISTS `akses` (
  `id_akses` tinyint(10) NOT NULL AUTO_INCREMENT,
  `hak_akses` varchar(50) NOT NULL,
  PRIMARY KEY (`id_akses`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `detail_transaksi`
--

DROP TABLE IF EXISTS `detail_transaksi`;
CREATE TABLE IF NOT EXISTS `detail_transaksi` (
  `id_detailtransaksi` int(11) NOT NULL AUTO_INCREMENT,
  `id_produk` int(11) NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `total_harga` int(100) NOT NULL,
  PRIMARY KEY (`id_detailtransaksi`),
  KEY `id_transaksi` (`id_transaksi`),
  KEY `id_produk` (`id_produk`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_transaksi`
--

INSERT INTO `detail_transaksi` (`id_detailtransaksi`, `id_produk`, `id_transaksi`, `qty`, `total_harga`) VALUES
(1, 46, 15, 2, 24),
(2, 47, 16, 1, 0),
(4, 46, 18, 3, 36),
(5, 44, 18, 2, 24600),
(6, 49, 18, 3, 36963);

-- --------------------------------------------------------

--
-- Table structure for table `kota`
--

DROP TABLE IF EXISTS `kota`;
CREATE TABLE IF NOT EXISTS `kota` (
  `id_kota` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kota` varchar(50) NOT NULL,
  `ongkos_kirim` varchar(100) NOT NULL,
  PRIMARY KEY (`id_kota`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kota`
--

INSERT INTO `kota` (`id_kota`, `nama_kota`, `ongkos_kirim`) VALUES
(1, 'Jember', '10000'),
(2, 'Surabaya', '50000'),
(9, 'Madiun', '80000'),
(10, 'Banyuwangi', '20000'),
(11, 'Bondowoso', '12500'),
(12, 'Situbondo', '12500');

-- --------------------------------------------------------

--
-- Table structure for table `pemasok`
--

DROP TABLE IF EXISTS `pemasok`;
CREATE TABLE IF NOT EXISTS `pemasok` (
  `id_pemasok` int(11) NOT NULL AUTO_INCREMENT,
  `nama_pemasok` varchar(100) NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  PRIMARY KEY (`id_pemasok`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

DROP TABLE IF EXISTS `produk`;
CREATE TABLE IF NOT EXISTS `produk` (
  `id_produk` int(11) NOT NULL AUTO_INCREMENT,
  `nama_produk` varchar(100) NOT NULL,
  `gambar` text NOT NULL,
  `harga` int(50) NOT NULL,
  `stok` int(11) NOT NULL,
  `deskripsi_produk` varchar(200) NOT NULL,
  PRIMARY KEY (`id_produk`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `nama_produk`, `gambar`, `harga`, `stok`, `deskripsi_produk`) VALUES
(44, 'Ex quibusdam dolorem', 'Screenshot_20221111_165107.png,Screenshot_20221114_141815.png,Screenshot_20221114_192929.png', 12300, 1, 'Ratione incididunt N'),
(45, 'Et dignissimos nostr', 'Screenshot_20221115_183135.png,Screenshot_20221116_110754.png,Screenshot_20221116_134131.png', 0, 0, 'Qui distinctio Aspe'),
(46, 'Commodo est consequ', 'Screenshot_20221116_110754.png,Screenshot_20221116_134131.png', 12, 12, 'Omnis explicabo Ut '),
(47, 'Non optio non optio', '', 0, 0, 'Officia iusto in min'),
(48, 'Incididunt velit vo', '', 0, 0, 'Aut error sint volup'),
(49, '123123', '', 12321, 213123, '2312313123                                        '),
(50, 'Antracol', 'antracol.jpg', 2000, 500, 'sjdhriyf'),
(51, 'Confidor 5 WP', 'confidor 5 wp.jpg', 500, 1000, 'sjhdrygf');

-- --------------------------------------------------------

--
-- Table structure for table `restok`
--

DROP TABLE IF EXISTS `restok`;
CREATE TABLE IF NOT EXISTS `restok` (
  `id_restok` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal_restok` date NOT NULL,
  `id_pemasok` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `stok_masuk` varchar(50) NOT NULL,
  `harga_beli` varchar(50) NOT NULL,
  `harga_jual` varchar(50) NOT NULL,
  PRIMARY KEY (`id_restok`),
  UNIQUE KEY `id_produk` (`id_produk`),
  UNIQUE KEY `id_pemasok` (`id_pemasok`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

DROP TABLE IF EXISTS `transaksi`;
CREATE TABLE IF NOT EXISTS `transaksi` (
  `id_transaksi` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal_transaksi` varchar(30) NOT NULL,
  `total_bayar` varchar(100) NOT NULL,
  `bukti_transaksi` varchar(225) NOT NULL,
  `status_transaksi` enum('SUKSES','PENDING','GAGAL','ERROR','BELUM_BAYAR') NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_kota` int(11) NOT NULL,
  `alamat` text NOT NULL,
  `no_resi` varchar(225) DEFAULT NULL,
  PRIMARY KEY (`id_transaksi`),
  KEY `id_user` (`id_user`),
  KEY `id_kota` (`id_kota`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `tanggal_transaksi`, `total_bayar`, `bukti_transaksi`, `status_transaksi`, `id_user`, `id_kota`, `alamat`, `no_resi`) VALUES
(12, '2022-12-24 17:05:01', '24', '', 'SUKSES', 8, 2, '', NULL),
(13, '2022-12-24 17:06:02', '24', '', 'SUKSES', 8, 2, '', NULL),
(14, '2022-12-24 17:39:13', '24', 'B9C72D08-4FD4-4914-B8D1-97B6EF287D17 (1).jpg', 'BELUM_BAYAR', 8, 2, '', NULL),
(15, '2022-12-24 17:48:15', '24', '', 'BELUM_BAYAR', 8, 2, '', NULL),
(16, '2022-12-24 17:49:11', '24678', '', 'BELUM_BAYAR', 8, 2, '', NULL),
(17, '2022-12-24 17:53:59', '61599', 'After Report  Photo.png', 'BELUM_BAYAR', 8, 2, '', NULL),
(18, '2022-12-24 17:55:29', '61599', 'After Report  Photo.png', 'BELUM_BAYAR', 8, 2, '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `id_kota` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `nama_user` varchar(100) NOT NULL,
  `role` enum('user','admin','operator','') NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `no_telp` int(20) NOT NULL,
  PRIMARY KEY (`id_user`),
  KEY `id_kota` (`id_kota`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `id_kota`, `username`, `password`, `email`, `nama_user`, `role`, `alamat`, `no_telp`) VALUES
(1, 0, 'sucot', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 'zerofiq@mailinator.com', 'Kathleen', 'user', '', 0),
(2, 0, 'adminadmin', 'f6fdffe48c908deb0f4c3bd36c032e72', 'admin@admin.com', 'Lukman Afandi', 'admin', '', 0),
(3, 0, 'admin@admin.com', 'f6fdffe48c908deb0f4c3bd36c032e72', 'admin@admin.com', 'Kessie', 'user', '', 0),
(4, 2, '', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 'qocadypu@mailinator.com', 'figek', 'user', '', 0),
(5, 2, '', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 'qujedafu@mailinator.com', 'sapeh', 'user', '', 0),
(6, 1, '', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 'puwixorobe@mailinator.com', 'zinitas', 'user', '', 0),
(7, 1, '', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 'xojuqujaga@mailinator.com', 'dipupusaje', 'user', '', 0),
(8, 2, 'jupesedit', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 'vimy@mailinator.com', 'Elvis Malone', 'user', 'Eius proident excep', 0),
(9, 1, 'lutfahs', '7596304782f59a990fa4722cc4f1ab20', 'lutfahimayatus@gmail.com', 'lutfa himayatus', 'user', 'Jl. PB Sudirman 126', 12344321);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD CONSTRAINT `detail_transaksi_ibfk_2` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_transaksi_ibfk_3` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `restok`
--
ALTER TABLE `restok`
  ADD CONSTRAINT `restok_ibfk_1` FOREIGN KEY (`id_pemasok`) REFERENCES `pemasok` (`id_pemasok`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `restok_ibfk_2` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `transaksi_ibfk_3` FOREIGN KEY (`id_kota`) REFERENCES `kota` (`id_kota`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
