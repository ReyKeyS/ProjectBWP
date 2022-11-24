/*
SQLyog Community v13.1.9 (64 bit)
MySQL - 10.4.25-MariaDB : Database - db_proyek
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_proyek` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `db_proyek`;

/*Table structure for table `categories` */

DROP TABLE IF EXISTS `categories`;

CREATE TABLE `categories` (
  `id_cate` varchar(200) NOT NULL,
  `nama` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id_cate`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `categories` */

insert  into `categories`(`id_cate`,`nama`) values 
('CA001','Mouse'),
('CA002','Keyboard'),
('CA003','VGA'),
('CA004','Processor');

/*Table structure for table `products` */

DROP TABLE IF EXISTS `products`;

CREATE TABLE `products` (
  `id_products` varchar(200) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `desc` varchar(255) DEFAULT NULL,
  `price` bigint(20) NOT NULL,
  `stok` int(11) NOT NULL,
  `brand` varchar(200) DEFAULT NULL,
  `id_cate` varchar(200) NOT NULL,
  `gmbr` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id_products`),
  KEY `id_cate` (`id_cate`),
  CONSTRAINT `products_ibfk_1` FOREIGN KEY (`id_cate`) REFERENCES `categories` (`id_cate`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `products` */

insert  into `products`(`id_products`,`nama`,`desc`,`price`,`stok`,`brand`,`id_cate`,`gmbr`,`status`) values 
('PR0001','Intel I3 10105F','-',1000000,1,'','CA004','products/intel-i3-10105f.jpg',1),
('PR0002','Logitech G102','Mouse gaming sejuta umat',250000,5,'Logitech','CA001','products/logitech-g102.jpeg',1),
('PR0003','Colorful RTX 3050','-',4500000,2,'NVIDIA','CA003','products/rtx-3050-colorful.jpg',1);

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id_users` varchar(200) NOT NULL,
  `nama` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `telp` varchar(100) DEFAULT NULL,
  `alamat` varchar(200) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id_users`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `users` */

insert  into `users`(`id_users`,`nama`,`email`,`telp`,`alamat`,`password`,`status`) values 
('US0001','Ryan','ryk@gmail.com','081234567891','Ngangel','123',1),
('US0002','paddy','paddy@mail.com','089512753','Jl medayu selaran','111',1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
