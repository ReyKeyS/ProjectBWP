-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 24, 2022 at 09:44 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.0.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_proyek`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id_cate` varchar(200) NOT NULL,
  `nama` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id_cate`, `nama`) VALUES
('CA001', 'Mouse'),
('CA002', 'Keyboard'),
('CA003', 'VGA'),
('CA004', 'Processor'),
('CA005', 'Motherboard'),
('CA006', 'RAM');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id_products` varchar(200) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `desc` varchar(255) DEFAULT NULL,
  `price` bigint(20) NOT NULL,
  `stok` int(11) NOT NULL,
  `brand` varchar(200) DEFAULT NULL,
  `id_cate` varchar(200) NOT NULL,
  `gmbr` varchar(255) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id_products`, `nama`, `desc`, `price`, `stok`, `brand`, `id_cate`, `gmbr`, `status`) VALUES
('PR0001', 'Intel I3 10105F', '-', 1000000, 13, '', 'CA004', 'products/intel-i3-10105f.jpg', 1),
('PR0002', 'Logitech G102', 'Mouse gaming sejuta umat', 250000, 17, 'Logitech', 'CA001', 'products/logitech-g102.jpeg', 1),
('PR0003', 'Colorful RTX 3050', '-', 4500000, 12, 'NVIDIA', 'CA003', 'products/rtx-3050-colorful.jpg', 1),
('PR0004', 'Ryzen 5 3600', '-', 2000000, 7, 'AMD', 'CA004', 'products/ryzen5-3600.jpeg', 1),
('PR0005', 'Gigabyte Aorus B550', 'ATX Model', 3250000, 3, '', 'CA005', 'products/Gigabyte-B550-Aorus.jpeg', 1),
('PR0006', 'Kingston RAM PC/Laptop 16GB', 'RAM PC/Laptop 16GB. Garansi ORI. Mohon baca desc sebelum tanya', 1000000, 3, 'Kingston', 'CA006', 'products/ram_kingston_8gb.jpg', 1),
('PR0007', 'VGA Colorful GTX 3050', 'ini description', 7000000, 4, 'NVIDIA', 'CA003', 'products/vgacolorful.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_users` varchar(200) NOT NULL,
  `nama` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `telp` varchar(100) DEFAULT NULL,
  `alamat` varchar(200) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_users`, `nama`, `email`, `telp`, `alamat`, `password`, `status`) VALUES
('US0001', 'Ryan', 'ryk@gmail.com', '081234567891', 'Ngangel', '123', 1),
('US0002', 'paddy', 'paddy@mail.com', '089512753', 'Jl medayu selaran', '111', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id_cate`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id_products`),
  ADD KEY `id_cate` (`id_cate`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_users`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`id_cate`) REFERENCES `categories` (`id_cate`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
