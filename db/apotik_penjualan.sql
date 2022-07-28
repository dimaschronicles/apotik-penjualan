-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 28, 2022 at 04:09 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `apotik_penjualan`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` int(11) NOT NULL,
  `nama_barang` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `nama_barang`) VALUES
(4, 'Paramex'),
(5, 'Ultra Flu'),
(7, 'Bodrex'),
(8, 'Mylanta'),
(9, 'Antangin');

-- --------------------------------------------------------

--
-- Table structure for table `jenis`
--

CREATE TABLE `jenis` (
  `id_jenis` int(11) NOT NULL,
  `nama_jenis` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jenis`
--

INSERT INTO `jenis` (`id_jenis`, `nama_jenis`) VALUES
(1, 'Obat Cair'),
(2, 'Tablet'),
(3, 'Kapsul'),
(4, 'Obat Oles'),
(5, 'Obat Tetes'),
(6, 'Inhaler');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'Obat Bebas'),
(2, 'Obat Bebas Terbatas'),
(3, 'Obat Keras'),
(5, 'Obat Herbal'),
(7, 'Obat Wajib Apotek');

-- --------------------------------------------------------

--
-- Table structure for table `obat`
--

CREATE TABLE `obat` (
  `id_obat` int(11) NOT NULL,
  `nama_obat` varchar(128) NOT NULL,
  `jenis` varchar(128) NOT NULL,
  `kategori` varchar(128) NOT NULL,
  `stok` int(11) DEFAULT NULL,
  `harga` int(11) NOT NULL,
  `id_supplier` int(11) NOT NULL,
  `keterangan` text NOT NULL,
  `time_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `obat`
--

INSERT INTO `obat` (`id_obat`, `nama_obat`, `jenis`, `kategori`, `stok`, `harga`, `id_supplier`, `keterangan`, `time_created`) VALUES
(5, 'Ultra Flu', 'Tablet', 'Obat Bebas', 65, 3500, 2, '<p>Obat flu dan demam</p>', 1657556251),
(6, 'Bodrex', 'Tablet', 'Obat Bebas', 40, 3000, 3, '<p>Obat Sakit Kepala</p>', 1657556691),
(7, 'Paramex', 'Tablet', 'Obat Bebas', NULL, 2000, 1, '<p>-</p>', 1657590545),
(8, 'Mylanta', 'Tablet', 'Obat Bebas', NULL, 15000, 1, '<p>-</p>', 1657694171),
(9, 'Antangin', 'Obat Cair', 'Obat Bebas', NULL, 3000, 2, '<p>-</p>', 1658992839);

-- --------------------------------------------------------

--
-- Table structure for table `obat_transaksi`
--

CREATE TABLE `obat_transaksi` (
  `id_obat_transaksi` int(11) NOT NULL,
  `id_obat` int(11) NOT NULL,
  `no_batch` varchar(20) DEFAULT NULL,
  `jumlah_masuk` int(11) DEFAULT NULL,
  `jumlah_keluar` int(11) NOT NULL,
  `jumlah_sisa` int(11) DEFAULT NULL,
  `keterangan_transaksi` text NOT NULL,
  `status` varchar(20) NOT NULL,
  `tanggal_transaksi` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `obat_transaksi`
--

INSERT INTO `obat_transaksi` (`id_obat_transaksi`, `id_obat`, `no_batch`, `jumlah_masuk`, `jumlah_keluar`, `jumlah_sisa`, `keterangan_transaksi`, `status`, `tanggal_transaksi`) VALUES
(2, 5, '890080', 100, 0, 200, '<p>-</p>', 'masuk', '2022-07-28'),
(3, 5, NULL, NULL, 35, 65, '<p>-</p>', 'keluar', '2022-07-29'),
(4, 6, '575888', 50, 0, 50, '<p>-</p>', 'masuk', '2022-07-28'),
(5, 6, NULL, NULL, 10, 40, '<p>-</p>', 'keluar', '2022-07-28');

-- --------------------------------------------------------

--
-- Table structure for table `satuan`
--

CREATE TABLE `satuan` (
  `id_satuan` int(11) NOT NULL,
  `nama_satuan` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `satuan`
--

INSERT INTO `satuan` (`id_satuan`, `nama_satuan`) VALUES
(2, 'PCS'),
(3, 'Box'),
(4, 'Kaplet'),
(6, 'Botol');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id_supplier` int(11) NOT NULL,
  `nama_supplier` varchar(128) NOT NULL,
  `telp_supplier` varchar(20) NOT NULL,
  `alamat_supplier` text NOT NULL,
  `keterangan_supplier` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id_supplier`, `nama_supplier`, `telp_supplier`, `alamat_supplier`, `keterangan_supplier`) VALUES
(1, 'Semarang', '089234567891', 'Jl. Soekarno', 'askdjaklsjdklasjkdaskldj'),
(2, 'Solo', '17231232323', 'Jl Kemerdekaan', 'Supplier alat kesehatan'),
(3, 'Purwokerto', '082394033294', 'Jl. Subroto', '-'),
(4, 'Kudus', '083823582619', 'Jl. Ahmad Dahlan', '-');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_obat` int(11) NOT NULL,
  `nama_pembeli` varchar(128) NOT NULL,
  `jumlah_keluar` int(11) NOT NULL,
  `sub_total` int(11) NOT NULL,
  `status` varchar(20) NOT NULL,
  `tanggal_keluar` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_user`, `id_obat`, `nama_pembeli`, `jumlah_keluar`, `sub_total`, `status`, `tanggal_keluar`) VALUES
(6, 1, 5, 'Joko', 3, 10500, 'sell', '2022-07-28 05:07:50'),
(7, 1, 8, 'Joko', 5, 75000, 'sell', '2022-07-28 05:40:48'),
(8, 1, 5, 'Joko', 5, 17500, 'sell', '2022-07-28 09:03:38'),
(9, 1, 6, 'Anwar', 5, 15000, 'sell', '2022-07-28 09:06:30');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(128) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `role` int(11) NOT NULL,
  `date_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `nama`, `email`, `no_hp`, `role`, `date_created`) VALUES
(1, 'farhann', '$2y$10$OLZyoSr5VsOXtftwLT732u4c9m2/UYL09Gop0HeDsdb24DjwkZSAW', 'Farhan Ramdhani Ashri', 'farhanramdhani@gmail.com', '083844699012', 1, '2020-12-01 12:51:37'),
(4, 'dimasc', '$2y$10$OLZyoSr5VsOXtftwLT732u4c9m2/UYL09Gop0HeDsdb24DjwkZSAW', 'Dimas Chronicles', 'dimaschronicles@gmail.com', '081903304446', 2, '2022-07-28 01:51:18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `jenis`
--
ALTER TABLE `jenis`
  ADD PRIMARY KEY (`id_jenis`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `obat`
--
ALTER TABLE `obat`
  ADD PRIMARY KEY (`id_obat`);

--
-- Indexes for table `obat_transaksi`
--
ALTER TABLE `obat_transaksi`
  ADD PRIMARY KEY (`id_obat_transaksi`);

--
-- Indexes for table `satuan`
--
ALTER TABLE `satuan`
  ADD PRIMARY KEY (`id_satuan`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id_supplier`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `jenis`
--
ALTER TABLE `jenis`
  MODIFY `id_jenis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `obat`
--
ALTER TABLE `obat`
  MODIFY `id_obat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `obat_transaksi`
--
ALTER TABLE `obat_transaksi`
  MODIFY `id_obat_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `satuan`
--
ALTER TABLE `satuan`
  MODIFY `id_satuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id_supplier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
