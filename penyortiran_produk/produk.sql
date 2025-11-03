-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 23, 2025 at 05:40 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `produk`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kategori`
--

CREATE TABLE `tbl_kategori` (
  `id_kategori` int NOT NULL,
  `kategori` varchar(50) NOT NULL,
  `tanggal_input` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_kategori`
--

INSERT INTO `tbl_kategori` (`id_kategori`, `kategori`, `tanggal_input`) VALUES
(1, 'Sepatu', '2025-10-23 03:27:37'),
(2, 'Fashion', '2025-10-23 03:27:37'),
(3, 'laptop', '2025-10-23 10:40:57'),
(4, 'elektronik', '2025-10-23 10:41:54'),
(5, 'Topi', '2025-10-23 10:53:17'),
(6, 'tradisional', '2025-10-23 12:18:42');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_produk`
--

CREATE TABLE `tbl_produk` (
  `id_produk` int NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `deskripsi` text,
  `id_kategori` int DEFAULT NULL,
  `kondisi` varchar(20) DEFAULT NULL,
  `harga` decimal(15,0) DEFAULT NULL,
  `harga_diskon` decimal(15,2) DEFAULT '0.00',
  `harga_akhir` decimal(15,0) DEFAULT NULL,
  `qty` int DEFAULT '0',
  `tipe_diskon` varchar(50) DEFAULT NULL,
  `nilai_diskon` float DEFAULT '0',
  `tanggal_input` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_produk`
--

INSERT INTO `tbl_produk` (`id_produk`, `nama_produk`, `deskripsi`, `id_kategori`, `kondisi`, `harga`, `harga_diskon`, `harga_akhir`, `qty`, `tipe_diskon`, `nilai_diskon`, `tanggal_input`) VALUES
(1, 'adidus', 'awdjakd', 4, 'Baru', 2000, 0.00, 1000, 1, 'Normal', 1000, '2025-10-23 05:13:44'),
(2, 'acuk', 'dawdawhdj', 2, 'Baru', 20000, 0.00, 18000, 1, 'Diskon', 10, '2025-10-23 05:19:23'),
(3, 'niko', 'sepatu', 1, 'Bekas', 50000, 0.00, 45000, 2, 'Diskon', 10, '2025-10-23 05:22:16');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int NOT NULL,
  `username` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(100) NOT NULL,
  `hak_akses` varchar(50) NOT NULL,
  `tanggal_masuk` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `hak_akses`, `tanggal_masuk`) VALUES
(1, 'adminfadhlan', 'cd91cabb6262a1c7b489c969c1ffe551', 'adminfadhlan', '2025-10-23 00:09:32');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_kategori`
--
ALTER TABLE `tbl_kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `tbl_produk`
--
ALTER TABLE `tbl_produk`
  ADD PRIMARY KEY (`id_produk`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_kategori`
--
ALTER TABLE `tbl_kategori`
  MODIFY `id_kategori` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_produk`
--
ALTER TABLE `tbl_produk`
  MODIFY `id_produk` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
