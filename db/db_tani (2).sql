-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 25, 2022 at 01:15 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_tani`
--

-- --------------------------------------------------------

--
-- Table structure for table `akses`
--

CREATE TABLE `akses` (
  `id_akses` tinyint(10) NOT NULL,
  `hak_akses` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `detail_transaksi`
--

CREATE TABLE `detail_transaksi` (
  `id_detailtransaksi` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `total_harga` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

CREATE TABLE `kota` (
  `id_kota` int(11) NOT NULL,
  `nama_kota` varchar(50) NOT NULL,
  `ongkos_kirim` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kota`
--

INSERT INTO `kota` (`id_kota`, `nama_kota`, `ongkos_kirim`) VALUES
(1, 'Jember', '10000'),
(2, 'Probolinggo', '20000');

-- --------------------------------------------------------

--
-- Table structure for table `pemasok`
--

CREATE TABLE `pemasok` (
  `id_pemasok` int(11) NOT NULL,
  `nama_pemasok` varchar(100) NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `gambar` text NOT NULL,
  `harga` int(50) NOT NULL,
  `stok` int(11) NOT NULL,
  `deskripsi_produk` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `nama_produk`, `gambar`, `harga`, `stok`, `deskripsi_produk`) VALUES
(44, 'Ex quibusdam dolorem', 'Screenshot_20221111_165107.png,Screenshot_20221114_141815.png,Screenshot_20221114_192929.png', 12300, 1, 'Ratione incididunt N'),
(45, 'Et dignissimos nostr', 'Screenshot_20221115_183135.png,Screenshot_20221116_110754.png,Screenshot_20221116_134131.png', 0, 0, 'Qui distinctio Aspe'),
(46, 'Commodo est consequ', 'Screenshot_20221116_110754.png,Screenshot_20221116_134131.png', 12, 12, 'Omnis explicabo Ut '),
(47, 'Non optio non optio', '', 0, 0, 'Officia iusto in min'),
(48, 'Incididunt velit vo', '', 0, 0, 'Aut error sint volup'),
(49, '123123', '', 12321, 213123, '2312313123                                        ');

-- --------------------------------------------------------

--
-- Table structure for table `restok`
--

CREATE TABLE `restok` (
  `id_restok` int(11) NOT NULL,
  `tanggal_restok` date NOT NULL,
  `id_pemasok` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `stok_masuk` varchar(50) NOT NULL,
  `harga_beli` varchar(50) NOT NULL,
  `harga_jual` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `tanggal_transaksi` varchar(30) NOT NULL,
  `total_bayar` varchar(100) NOT NULL,
  `bukti_transaksi` varchar(225) NOT NULL,
  `status_transaksi` enum('SUKSES','PENDING','GAGAL','ERROR','BELUM_BAYAR') NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_kota` int(11) NOT NULL,
  `alamat` text NOT NULL,
  `no_resi` varchar(225) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `id_kota` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `nama_user` varchar(100) NOT NULL,
  `role` enum('user','admin','operator','') NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `no_telp` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(8, 2, 'jupesedit', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 'vimy@mailinator.com', 'Elvis Malone', 'user', 'Eius proident excep', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akses`
--
ALTER TABLE `akses`
  ADD PRIMARY KEY (`id_akses`);

--
-- Indexes for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD PRIMARY KEY (`id_detailtransaksi`),
  ADD KEY `id_transaksi` (`id_transaksi`),
  ADD KEY `id_produk` (`id_produk`) USING BTREE;

--
-- Indexes for table `kota`
--
ALTER TABLE `kota`
  ADD PRIMARY KEY (`id_kota`);

--
-- Indexes for table `pemasok`
--
ALTER TABLE `pemasok`
  ADD PRIMARY KEY (`id_pemasok`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `restok`
--
ALTER TABLE `restok`
  ADD PRIMARY KEY (`id_restok`),
  ADD UNIQUE KEY `id_produk` (`id_produk`),
  ADD UNIQUE KEY `id_pemasok` (`id_pemasok`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_kota` (`id_kota`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id_kota` (`id_kota`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `akses`
--
ALTER TABLE `akses`
  MODIFY `id_akses` tinyint(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  MODIFY `id_detailtransaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `kota`
--
ALTER TABLE `kota`
  MODIFY `id_kota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pemasok`
--
ALTER TABLE `pemasok`
  MODIFY `id_pemasok` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `restok`
--
ALTER TABLE `restok`
  MODIFY `id_restok` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
