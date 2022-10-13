-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 20, 2022 at 03:27 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `restorant`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `nama_admin` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `id_jabatan` int(11) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `no_telp_admin` varchar(15) NOT NULL,
  `foto_admin` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `nama_admin`, `username`, `password`, `id_jabatan`, `alamat`, `no_telp_admin`, `foto_admin`) VALUES
(1, 'Opit', 'sadboy', 'sadboy', 1, 'Gianyar', '08986545983', 'opit.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_makanan`
--

CREATE TABLE `kategori_makanan` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori_makanan`
--

INSERT INTO `kategori_makanan` (`id_kategori`, `nama_kategori`) VALUES
(1, 'Makanan'),
(2, 'Minuman');

-- --------------------------------------------------------

--
-- Table structure for table `meja`
--

CREATE TABLE `meja` (
  `id_meja` int(11) NOT NULL,
  `nama_meja` int(10) NOT NULL,
  `id_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `meja`
--

INSERT INTO `meja` (`id_meja`, `nama_meja`, `id_status`) VALUES
(3, 3, 1),
(4, 4, 2),
(8, 1, 2),
(9, 2, 2),
(14, 5, 2),
(16, 6, 2),
(17, 7, 2),
(18, 8, 2),
(19, 9, 2),
(20, 10, 2),
(21, 11, 2),
(24, 12, 2);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id_menu` int(11) NOT NULL,
  `nama_menu` varchar(100) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `harga_menu` int(100) NOT NULL,
  `fotomenu` varchar(1000) NOT NULL,
  `id_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id_menu`, `nama_menu`, `id_kategori`, `harga_menu`, `fotomenu`, `id_status`) VALUES
(65, 'Bakso', 1, 10000, 'bakso kaldu kambing.jpg', 1),
(66, 'Es Jeruk', 2, 3000, 'es jeruk strubbery.jpg', 1),
(67, 'Teh Hijau', 2, 5000, 'green tea.jpg', 1),
(68, 'Ramen', 1, 15000, 'ramen original.jpg', 1),
(84, 'Spageti', 1, 20000, 'spagetty chiceken meet.jpg', 1),
(85, 'Pizza', 1, 15000, 'pizza mie telor spesial.jpg', 1),
(86, 'Teh Lemon', 2, 5000, 'lemon tea.jpg', 1),
(87, 'Sate', 1, 25000, 'sate lilit indonesian food.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `nama_pelanggan` varchar(100) NOT NULL,
  `alamat_pelanggan` varchar(100) NOT NULL,
  `no_telp_pelanggan` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `nama_pelanggan`, `alamat_pelanggan`, `no_telp_pelanggan`) VALUES
(1, 'REGULER', '-', '0'),
(2, 'I Made Yudiana', 'Buruan', '081123456789'),
(3, 'Opit', 'Gianyar', '08986545983'),
(4, 'Antok', 'Denpasar', '08112345678'),
(5, 'Bayu', 'Denpasar', '123456789'),
(6, 'Jerry', 'Sidan', '123123123'),
(7, 'Wirawan', 'Bedulu', '085237954200'),
(8, 'Mang Solin', 'Blahbatuh', '-'),
(9, 'Wandas', 'Flotres', '-'),
(10, 'Deta', 'Blahbatuh', '-');

-- --------------------------------------------------------

--
-- Table structure for table `pesan`
--

CREATE TABLE `pesan` (
  `id_pesanan` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `jumlah_pesan` int(10) NOT NULL,
  `harga_pesan` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pesan`
--

INSERT INTO `pesan` (`id_pesanan`, `id_menu`, `jumlah_pesan`, `harga_pesan`) VALUES
(1, 65, 3, 30000),
(1, 66, 2, 6000),
(4, 66, 3, 9000),
(4, 68, 3, 45000),
(6, 65, 4, 40000),
(6, 86, 4, 20000),
(7, 68, 7, 105000),
(7, 66, 7, 21000),
(8, 84, 5, 100000),
(8, 85, 20, 300000),
(8, 66, 10, 30000),
(10, 85, 20, 300000),
(10, 86, 20, 100000),
(10, 87, 20, 400000),
(11, 85, 10, 150000),
(12, 85, 10, 150000),
(13, 67, 100, 500000),
(14, 84, 100, 2000000),
(15, 85, 10, 150000),
(16, 68, 10, 150000),
(16, 66, 5, 15000),
(16, 86, 5, 25000),
(19, 85, 5, 75000),
(19, 66, 5, 15000),
(19, 67, 3, 15000),
(19, 87, 3, 60000),
(19, 65, 6, 60000),
(19, 86, 6, 30000),
(20, 65, 6, 60000),
(20, 66, 6, 18000),
(20, 87, 9, 180000),
(21, 85, 9, 135000),
(22, 85, 9, 135000),
(23, 68, 2, 30000),
(23, 66, 2, 6000),
(23, 87, 22, 440000),
(24, 84, 9, 180000),
(24, 67, 9, 45000),
(30, 68, 7, 105000),
(30, 67, 7, 35000),
(31, 66, 7, 21000),
(31, 87, 7, 140000),
(32, 68, 8, 120000),
(32, 66, 100, 300000),
(33, 85, 9, 135000),
(33, 66, 7, 21000),
(37, 85, 9, 135000),
(37, 66, 7, 21000),
(38, 68, 9, 135000),
(39, 65, 3, 30000),
(39, 66, 3, 9000),
(39, 87, 5, 100000),
(40, 65, 4, 40000),
(41, 85, 2, 30000),
(43, 65, 5, 50000),
(43, 66, 5, 15000),
(44, 65, 2, 20000),
(44, 66, 2, 6000);

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `id_pesanan` int(11) NOT NULL,
  `id_admin` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `id_meja` int(11) NOT NULL,
  `waktu_pemesanan` datetime NOT NULL,
  `diskon` int(30) NOT NULL,
  `total_harga` int(30) NOT NULL,
  `id_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`id_pesanan`, `id_admin`, `id_pelanggan`, `id_meja`, `waktu_pemesanan`, `diskon`, `total_harga`, `id_status`) VALUES
(1, 1, 1, 3, '2018-06-18 20:19:16', 0, 36000, 2),
(13, 2, 1, 21, '2018-07-02 11:08:27', 0, 500000, 2),
(14, 2, 3, 9, '2018-08-31 11:09:57', 200000, 1800000, 2),
(16, 2, 8, 9, '2017-12-02 11:21:15', 19000, 171000, 2),
(19, 2, 3, 17, '2018-06-02 15:59:50', 25500, 229500, 2),
(23, 2, 3, 3, '2018-07-03 11:48:42', 47600, 428400, 2),
(24, 2, 2, 8, '2018-07-03 11:53:00', 22500, 202500, 2),
(31, 1, 1, 4, '2018-07-03 12:49:55', 0, 161000, 2),
(32, 2, 5, 8, '2018-05-03 18:53:23', 42000, 378000, 2),
(33, 2, 7, 9, '2018-07-03 19:44:06', 15600, 140400, 2),
(37, 2, 2, 19, '2018-03-03 20:25:17', 15600, 140400, 2),
(39, 2, 10, 9, '2018-04-03 21:34:09', 13900, 125100, 2),
(40, 1, 1, 8, '2018-07-26 19:50:28', 0, 40000, 2),
(41, 1, 1, 9, '2019-06-13 20:47:16', 0, 30000, 2),
(43, 1, 1, 14, '2022-03-20 22:24:30', 0, 65000, 2),
(44, 1, 1, 14, '2022-03-20 22:25:03', 0, 26000, 2);

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `id_status` int(11) NOT NULL,
  `status` varchar(30) NOT NULL,
  `sedang` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`id_status`, `status`, `sedang`) VALUES
(1, 'Ada', 'On Proses'),
(2, 'Habis', 'Selesai');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `kategori_makanan`
--
ALTER TABLE `kategori_makanan`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `meja`
--
ALTER TABLE `meja`
  ADD PRIMARY KEY (`id_meja`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id_pesanan`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id_status`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kategori_makanan`
--
ALTER TABLE `kategori_makanan`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `meja`
--
ALTER TABLE `meja`
  MODIFY `id_meja` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id_pesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `id_status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
