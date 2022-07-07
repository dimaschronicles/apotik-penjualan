-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 07, 2022 at 07:37 AM
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
(1, 'Tolak Angin'),
(2, 'Antangin');

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
(6, 'Inhaler'),
(7, 'Obat Suntik');

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
(4, 'Obat Golongan Narkotika'),
(5, 'Obat Herbal'),
(6, 'Obat Psikotropika'),
(7, 'Obat Wajib Apotek');

-- --------------------------------------------------------

--
-- Table structure for table `obat`
--

CREATE TABLE `obat` (
  `id_obat` int(11) NOT NULL,
  `no_batch_` varchar(20) DEFAULT NULL,
  `nama_obat` varchar(128) NOT NULL,
  `jenis` varchar(128) NOT NULL,
  `kategori` varchar(128) NOT NULL,
  `stok` int(11) DEFAULT NULL,
  `id_supplier` int(11) NOT NULL,
  `keterangan` text NOT NULL,
  `time_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `obat`
--

INSERT INTO `obat` (`id_obat`, `no_batch_`, `nama_obat`, `jenis`, `kategori`, `stok`, `id_supplier`, `keterangan`, `time_created`) VALUES
(2, NULL, 'Tolak Angin', 'Obat Cair', 'Obat Bebas', 180, 1, '<p>-</p>', 1657171240);

-- --------------------------------------------------------

--
-- Table structure for table `obat_keluar`
--

CREATE TABLE `obat_keluar` (
  `id_obat_keluar` int(11) NOT NULL,
  `id_obat` int(11) NOT NULL,
  `stok_awal` int(11) NOT NULL,
  `jumlah_keluar` int(11) NOT NULL,
  `sisa` int(11) NOT NULL,
  `keterangan_keluar` text NOT NULL,
  `tanggal_keluar` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `obat_masuk`
--

CREATE TABLE `obat_masuk` (
  `id_obat_masuk` int(11) NOT NULL,
  `id_obat` int(11) NOT NULL,
  `id_supplier` int(11) NOT NULL,
  `stok_awal` int(11) NOT NULL,
  `jumlah_masuk` int(11) NOT NULL,
  `sisa` int(11) NOT NULL,
  `keterangan_masuk` text NOT NULL,
  `tanggal_masuk` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `obat_transaksi`
--

CREATE TABLE `obat_transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `id_obat` int(11) NOT NULL,
  `no_batch` varchar(20) DEFAULT NULL,
  `nama_satuan` varchar(20) NOT NULL,
  `jumlah_masuk` int(11) DEFAULT NULL,
  `jumlah_keluar` int(11) DEFAULT NULL,
  `jumlah_sisa` int(11) DEFAULT NULL,
  `id_supplier` int(11) DEFAULT NULL,
  `keterangan_transaksi` text NOT NULL,
  `status` varchar(20) NOT NULL,
  `tanggal_transaksi` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `obat_transaksi`
--

INSERT INTO `obat_transaksi` (`id_transaksi`, `id_obat`, `no_batch`, `nama_satuan`, `jumlah_masuk`, `jumlah_keluar`, `jumlah_sisa`, `id_supplier`, `keterangan_transaksi`, `status`, `tanggal_transaksi`) VALUES
(2, 2, '131232', '', 100, NULL, 200, NULL, '<p>1 box berisi 50</p>', 'masuk', '2022-07-07'),
(3, 2, NULL, 'PCS', NULL, 20, 180, NULL, '<p>dibeli</p>', 'keluar', '2022-07-08');

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
(1, 'Buah'),
(2, 'PCS'),
(3, 'Box'),
(4, 'Kaplet'),
(5, 'Unit'),
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
(2, 'Solo', '17231232323', 'Jl Kemerdekaan', 'Supplier alat kesehatan');

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
  `is_active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `nama`, `email`, `no_hp`, `role`, `is_active`) VALUES
(1, 'dimaschronicles', '$2y$10$OLZyoSr5VsOXtftwLT732u4c9m2/UYL09Gop0HeDsdb24DjwkZSAW', 'Dimas Cahyo Nur Aditya', 'dimaschronicles@gmail.com', '081903304446', 1, 1),
(2, 'anggie', '$2y$10$OLZyoSr5VsOXtftwLT732u4c9m2/UYL09Gop0HeDsdb24DjwkZSAW', 'Anggie Febriansyah', 'anggiefebriyanz@gmail.com', '081587672132', 2, 1),
(3, 'farhan', '$2y$10$OLZyoSr5VsOXtftwLT732u4c9m2/UYL09Gop0HeDsdb24DjwkZSAW', 'Farhan Ramdhani Ashari', 'farhanramdhani@gmail.com', '089334421354', 2, 1);

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
-- Indexes for table `obat_keluar`
--
ALTER TABLE `obat_keluar`
  ADD PRIMARY KEY (`id_obat_keluar`);

--
-- Indexes for table `obat_masuk`
--
ALTER TABLE `obat_masuk`
  ADD PRIMARY KEY (`id_obat_masuk`);

--
-- Indexes for table `obat_transaksi`
--
ALTER TABLE `obat_transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

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
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  MODIFY `id_obat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `obat_keluar`
--
ALTER TABLE `obat_keluar`
  MODIFY `id_obat_keluar` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `obat_masuk`
--
ALTER TABLE `obat_masuk`
  MODIFY `id_obat_masuk` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `obat_transaksi`
--
ALTER TABLE `obat_transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `satuan`
--
ALTER TABLE `satuan`
  MODIFY `id_satuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id_supplier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
