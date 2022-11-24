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
('CA004','Processor'),
('CA005','Motherboard'),
('CA006','RAM'),
('CA007','Power Supply'),
('CA008','Casing'),
('CA009','Cooling'),
('CA010','SSD'),
('CA011','HDD'),
('CA012','Monitor');

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
('PR0001','Intel I3 10105F','-',1000000,13,'','CA004','products/intel-i3-10105f.jpg',1),
('PR0002','Logitech G102','Mouse gaming sejuta umat',250000,17,'Logitech','CA001','products/logitech-g102.jpeg',1),
('PR0003','Colorful RTX 3050','-',4500000,12,'NVIDIA','CA003','products/rtx-3050-colorful.jpg',1),
('PR0004','Ryzen 5 3600','-',2000000,7,'AMD','CA004','products/ryzen5-3600.jpeg',1),
('PR0005','Gigabyte Aorus B550','ATX Model',3250000,3,'','CA005','products/Gigabyte-B550-Aorus.jpeg',1),
('PR0006','Kingston RAM PC/Laptop 16GB','ini description ',1000000,2,'Kingston','CA006','products/ram_kingston_8gb.jpg',1),
('PR0007','VGA Colorful GTX 3050','ini desc baca desc sebelum tanya',7000000,4,'NVIDIA','CA003','products/vgacolorful.jpg',1),
('PR0008','VGA Platinum ','ini desc',178000,1,'VGEN','CA006','products/vgaplatinum.jfif',1),
('PR0009','Asus TUF RTX 3060','Graphics Card: NVIDIA® GeForce RTX™ 3060 LHR\r\nThe Ultimate Play GeForce RTX 30 series Laptop with 2nd gen RTX (RT & AI)\r\n\r\nBus Standard :PCI Express 4.0\r\nOpenGL :OpenGL®4.6\r\nVideo Memory :12GB GDDR6\r\n\r\nEngine Clock :\r\nOC Mode - 1807 MHz (Boost Clock)\r\nGam',6880000,4,'Asus','CA003','products/download (1).png',1),
('PR0010','Colorful RTX 3070 NB','Chip Series GeForce® RTX 3070\r\nProduct Series Colorful Series\r\nGPU Code Name GA104\r\nManufacturing Process 8nm\r\nCUDA Cores 5888\r\nCore Clock Base:1500Mhz; Boost:1725Mhz\r\nMemory Speed Grade 14Gbps\r\nMemory Size 8GB\r\nMemory Bus Width 256 bit\r\nMemory Type GDDR6',11700000,3,'Colorful','CA003','products/4b58e22c-90ef-4530-94a5-aedbb61b1499.jpg',1),
('PR0011','RTX 3070ti Suprim X','MODEL NAME\r\nGeForce RTX™ 3070 Ti SUPRIM X 8G\r\nGRAPHICS PROCESSING UNIT\r\nNVIDIA® GeForce RTX™ 3070 Ti\r\nINTERFACE\r\nPCI Express® Gen 4\r\nCUDA® CORES\r\n6144 Units\r\nCORE CLOCKS\r\nEXTREME Mode: 1875 MHz (MSI Center)\r\nGAMING Mode & SILENT Mode: 1860 MHz\r\nMEMORY SPE',13872000,4,'MSI ','CA003','products/unnamed.jpg',1),
('PR0012','MSI MAG301CR2','Deskripsi MSI Optix MAG301CR2 MONITOR [1080p, 200Hz]\r\n\r\nCurved Gaming display (1500R) – The best gameplay immersion.\r\n\r\nMystic Light – The ultimate gaming finish.\r\n\r\nWFHD High Resolution - Game titles will even look better, displaying more details due to ',5100000,3,'MSI','CA012','products/82b2dc4d-76fd-4282-b1db-a61694ee83ff.jpg',1),
('PR0013','Xiaomi Ultrawide Curved Gaming Monitor 34 inch','SILAHKAN PILIH LAMA GARANSI DI VARIANT.\r\n\r\nDalam Box:\r\n1 x Mi Ultra Wide Curved Gaming Monitor 1440P 144Hz AMD Free-Sync 34 Inch\r\n1 x Base\r\n1 x Bracket\r\n1 x Power Adapter\r\n1 x DP Cable\r\n4 x Screws\r\n4 x Bolts\r\n1 x Base Screw\r\n1 x Instruction Manual\r\n\r\nspes',6000000,7,'Xiaomi','CA012','products/xiaomi-ultra-wide-curved-gaming-monitor-1440p-144hz-amd-free-sync-34-inch-black-1.jpg',1),
('PR0014','MSI G27CQ4','Curved Gaming display (1500R) – The best gameplay immersion.\r\n\r\nWQHD High Resolution – Game titles will even look better, displaying more details due to the WQHD\r\nresolution.\r\n\r\n165Hz Refresh Rate – Real smooth gaming.\r\n\r\n1ms response time – Eliminate scr',5000000,15,'MSI','CA012','products/MSI G27CQ4.jpg',1),
('PR0015','Viewsonic 24 inch 144hz','Monitor kentank',2500000,2,'View Sonic','CA012','products/VX2458-P-mhd_RF01_pc.jpg',1),
('PR0016','i3 10100f','Spesifikasi Inti Intel Core i3-10100F\r\nProduct Collection 10th Generation Intel Core i3 Processors\r\nCode Name Comet Lake\r\nLithography 14 nm\r\n# of Cores 4\r\n# of Threads 8\r\nProcessor Base Frequency 3.60 GHz\r\nMax Turbo Frequency 4.30 GHz\r\nCache 6 MB Intel Sm',1100000,3,'Intel','CA004','products/intel_intel_core_i3-10100f_i3_10100f_3-6ghz_up_to_4-3ghz_box_socket_lga_1200__full01_mvbw37ud.jpg',1),
('PR0017','i5 9400f','Processor Name : Intel Core i5-9400F 2.9Ghz Up To 4.1Ghz - Cache 9MB [Box] Socket LGA 1151V2 - Coffeelake Series\r\nBrand : Intel\r\nCPU Socket Type : LGA 1151V2\r\nProcessors Generation : 9th Gen\r\nFamily : Coffeelake\r\nCores : 6\r\nThreads : 6\r\nOperating Frequenc',1600000,3,'Intel','CA004','products/7e5d346c3466baa8c0e93de88a80b649.jpg',1),
('PR0018','i7 10700','Intel I7 BAGUS INI AHIHIHIH',5000000,3,'Intel','CA004','products/intel_processor_intel_core_i7_10700f_i7-10700f_2-90_ghz_lga_1200_box_full01_rg6ca6ju.jpg',1),
('PR0019','AMD Ryzen 5 5600x','AMD Ryzen™ 5 5600X\r\nSpecifications\r\n# of CPU Cores : 6\r\n# of Threads : 12\r\nBase Clock : 3.7GHz\r\nMax Boost Clock : Up to 4.6GHz\r\nTotal L2 Cache : 3MB\r\nTotal L3 Cache : 32MB\r\nUnlocked : Yes\r\nCMOS : TSMC 7nm FinFET\r\nPackage : AM4\r\nPCI Express® Version : PCIe',2700000,12,'AMD','CA004','products/messageImage_1656317325871.jpg',1),
('PR0020','Ryzen 9','Garansi Resmi EMD/AGS 3 Tahun\r\nKonfirmasi Persediaan Stok Barang Sebelum Order ya\r\n\r\nSpecifications\r\n\r\n# of CPU Cores\r\n12\r\n\r\n# of Threads\r\n24\r\n\r\nBase Clock\r\n3.7GHz\r\n\r\nMax Boost Clock\r\nUp to 4.8GHz\r\n\r\nTotal L2 Cache\r\n6MB\r\n\r\nTotal L3 Cache\r\n64MB\r\n\r\nUnlocked',5995000,10,'AMD','CA004','products/messageImage_1656317340590.jpg',1),
('PR0021','POWER SUPPLY / PSU PC 80+ GOLD ASUS ROG STRIX 650G / 650WATT','GARANSI RESMI 10TAHUN\r\n\r\nIntel Specification\r\nATX12V\r\n\r\nDimensi\r\n16 x 15 x8.6 Centimeter\r\n\r\nEfficiency\r\n80Plus Gold\r\n\r\nProtection Features\r\nOPP/OVP/SCP/OCP/OTP\r\n\r\nHazardous Materials\r\nROHS\r\n\r\nAC Input Range\r\n100-240Vac\r\n\r\nThermal Features\r\nROG Thermal Sol',2100000,3,'Asus','CA007','products/1489178_80f57ad9-8438-46a9-a9fa-a93253d54c7b_500_500.jpg',1),
('PR0022','MSI A650GF','MPG A650GF\r\nATX\r\n650W\r\n100-240Vac\r\n115Vac/10.0A max. 230Vac/5.0A max.\r\n47Hz ~ 63Hz\r\nUp to 90% (80 Plus Gold)\r\n140 mm\r\n150mm x160mm x86mm\r\nActive PFC\r\nOCP / OVP / OPP / OTP / SCP / UVP',1500000,12,'MSI','CA007','products/MSI 650W 80 GOLD.jpg',1),
('PR0023','Thermaltake SMART BX RGB 550w','Deskripsi PSU Thermaltake Smart BX1 RGB 650W 80 plus Bronze PSU 650W Bronze\r\nThermaltake SMART BX1 RGB 650W (230V)\r\nP/N : PS-SPR-0650NHSABE-1\r\n\r\n80 PLUS Bronze certified non-modular PSU with 256-color 10 LED RGB fan.\r\nP/N : PS-SPR-0650NHSABE-1\r\nWATTS : 65',900000,3,'Thermaltake','CA007','products/BX 1 smart rgb 550w.jpg',1),
('PR0024','MSI B450M Mortar MAX','OVERVIEW :\r\nSupports AMD Ryzen™ 1st and 2nd Generation/ Ryzen™ with Radeon™ Vega Graphics Processors for Socket AM4\r\nSupports DDR4 Memory, up to 3466(OC) MHz\r\nExtended Heatsink Design: MSI extended PWM and enhanced circuit design ensures even high-end pro',1450000,20,'AMD','CA005','products/img30944-1618653854.jpg',1),
('PR0025','MSI MAG Z490 Tomahawk','- Supports 10th Gen Intel Core / Pentium Celeron processors for LGA 1200 socket\r\n- Supports DDR4 Memory, up to 5000(OC) MHz\r\n- Ready 4 the Future: Support Lightning Gen 4 Solution for the future\r\n- Premium Thermal Solution: Extended Heatsink Design and M.',4100000,6,'MSI','CA005','products/messageImage_1632809716507.jpg',1),
('PR0026','MSI MPG Z590 Gaming Force','Supports 11th and 10th Gen Intel Core / Pentium Celeron processors for LGA 1200 socket\r\n\r\nSupports DDR4 Memory, up to 5333(OC) MHz\r\n\r\nLightning Fast Game experience: PCIe 4.0, Lightning Gen 4 x4 M.2, USB 3.2 Gen 2x2\r\n\r\nEnhanced Power Design: 16+1+1 Duet R',5400000,12,'MSI','CA005','products/product_1613124755399.jpg',1),
('PR0027','Gigabyte B460M D2V','Intel® B460 Ultra Durable Motherboard with GIGABYTE 8118 Gaming LAN, PCIe Gen3 x4 M.2, Anti-Sulfur Resistor, Smart Fan 5\r\n\r\nSupports 10th Gen Intel® Core™ Processors\r\nDual Channel Non-ECC Unbuffered DDR4, 2 DIMMs\r\nHybrid Digital PWM Design\r\nHigh Quality A',1400000,6,'Gigabyte','CA005','products/13757756_500115a8-cdea-4fe4-b7b0-f303bdf64ce5_700_700.jpg',1),
('PR0028','RAM DDR4 SODimm V-GeN RESCUE 4GB PC19200/2400Mhz (Memory Laptop VGEN)','Dimensi : 68mm x 30mm x 2mm\r\nKecepatan : 2400Mhz\r\nChipset : V-GeN\r\nSlot : DIMM 260 Pin\r\nType : Unbuffered\r\nVoltage : 1.2V\r\nECC : No\r\nRegistered : No\r\nGaransi : Limited Lifetime Warranty',220000,12,'VGEN','CA006','products/1ab26574-e52c-4f30-97a9-2f462eb6e886.jpg',1),
('PR0029','RAM DDR4 SODimm V-GeN RESCUE 8GB PC19200/2400Mhz (Memory Laptop VGEN)','Dimensi : 68mm x 30mm x 2mm\r\nKecepatan : 2400Mhz\r\nChipset : V-GeN\r\nSlot : DIMM 260 Pin\r\nType : Unbuffered\r\nVoltage : 1.2V\r\nECC : No\r\nRegistered : No\r\nGaransi : Limited Lifetime Warranty',340000,10,'VGEN','CA006','products/4c56936f-4787-4709-b3ec-d42d951c5d12.jpg',1),
('PR0030','VGEN LONGDIMM 8 GB DDR4','Dimensi : 130mm x 30mm x 2mm\r\nKecepatan : 2400Mhz\r\nChipset : V-GeN\r\nSlot : DIMM 288 Pin\r\nType : Unbuffered\r\nVoltage : 1.2V\r\nECC : No\r\nRegistered : No\r\nGaransi Limited Lifetime Warranty',340000,6,'VGEN','CA006','products/messageImage_1616039661698.jpg',1),
('PR0031','VGEN LONGDIMM 16 GB DDR4','Dimensi : 68mm x 30mm x 2mm\r\nKecepatan : 3200Mhz\r\nChipset : Major Brand (Samsung/SKHynix/Micron)\r\nSlot : DIMM 260 Pin\r\nType : Unbuffered\r\nVoltage : 1.2V\r\nECC : No\r\nRegistered : No\r\nGaransi : Limited Lifetime Warranty',750000,72,'VGEN','CA006','products/messageImage_1616039661698.jpg',1),
('PR0032','MEMORY RAM KINGSTON LONGDIMM 8GB DDR4 PC21300 2666MHZ - LONGDIM 8 GB','Garansi Lifetime\r\n\r\nMemory Capacity 8GB\r\nModel/Series/Type ValueRAM\r\nBrand Kingston\r\nCASLatency CL19\r\nData Width X64\r\nForm Factor DDR4\r\nMemory Voltage 1.2v\r\nModule Type DIMM\r\nOperating Temperature 0C to 85C\r\nPins 288 Pin\r\nProduct Type/Family DRAM\r\nRAM Mem',600000,13,'Kingston','CA006','products/messageImage_1616042727891.jpg',1),
('PR0033','RAM KINGSTON LONGDIMM DDR4 16GB PC 21300 / 2666MHz','Deskripsi produk :\r\n* Barang 100% Baru\r\n* Pemakaian untuk PC\r\n* Kapasitas 16GB\r\n* Speed 2666MHz\r\n* Kompatible ( Cocok ) dengan semua motherboard yang menggunakan DDR4\r\n* Premium Quality, menggunakan IC CHIP Yang Ori\r\n* Voltage : 1.2V (LOW VOLTAGE)\r\n\r\nGara',750000,12,'Kingston','CA006','products/messageImage_1616042727891.jpg',1),
('PR0034','Casing Armagedon NIMITZ N7','Armaggeddon NIMITZ N7 - Excellent ATX With Multi Color Effects\r\n\r\nTEMPERED GLASS SIDE PANEL\r\nDarkness Tempered Glass Side Panel\r\nChassis Material : SPCC Blackened Steel Palte 0.45 mm on Top ,0,4 mm Other Side\r\n\r\nSpesifikasi :\r\nChassis Size L330 X W208 X H',500000,7,'Armagedon','CA008','products/n7-500x500.jpg',1),
('PR0035','MSI Vampiric 100L','MSI MAG VAMPIRIC 100L Gaming Case\r\n\r\nPRODUCT NAME : MAG VAMPIRIC 100L\r\n\r\nI/O PORTS\r\nUSB 3.2 Gen 1 Type A x 1\r\nUSB 2.0 x2\r\nAudio x1\r\nMic x1\r\n\r\nDRIVER BAYS : 2.5” x 2 + 3.5” x 2 (1 x compatible with 2.5”)\r\nCASE EXPANSION SLOTS : 7\r\nMAXIMUM GPU LENGTH : 300m',670000,3,'MSI','CA008','products/vampiric 100l.jpg',1),
('PR0036','MSI SEKIRA CASE','Face of Visible Greatness\r\n-Can install up to 6x system fans, providing ventilation and stable performance to the whole system\r\n-Three dust filters to prevent dust from entering the system\r\n-Top vent lid provides additional system airflow and protection\r\n',1100000,3,'MSI','CA008','products/Casing MSI Bannered.jpg',1),
('PR0037','Darkflash L6','CPU COOLER DarkFlash L6 Heat Sink CPU Air Cooler\r\n\r\n- Mohon tanyakan stok terlebih dahulu sebelum order\r\n- Spesifikasi dan harga dapat berubah sewaktu-waktu tanpa pemberitahuan\r\n- Siap Kirim ke seluruh Indonesia\r\n- Harap konfirmasi jika barang sudah di te',280000,32,'DarkFlash','CA009','products/5b5adfa7-849d-4499-b2ba-416877accba6.jpg',1),
('PR0038','MSI Coreliquid 240r','SPECIFICATIONS\r\n\r\nNumber of Fans : 2\r\nFan Dimensions : 120 x 120 x 25mm / 4.7 x 4.7 x 0.98 inches\r\nFan Speed : 500 ~ 2000 RPM\r\nFan PowerConsumption : 1.8 W\r\nFan Rated Current : 0.15 A\r\nFan Rated Voltage : 12V DC\r\nFan Bearing : Two Ball Bearing\r\nFan Air Pr',1200000,5,'MSI','CA009','products/Coreliquid 240r v2 bannered.jpg',1),
('PR0039','MSI Coreliquid K360','NUMBER OF FANS : 3\r\nFAN DIMENSIONS : 120 x 120 x 25mm / 4.7 x 4.7 x 0.98 inches\r\nFAN SPEED : 0 ~ 2500 RPM\r\nFAN POWER CONSUMPTION : 3.36 W\r\nFAN RATED CURRENT : 0.28 A\r\nFAN RATED VOLTAGE : 12V DC\r\nFAN LIFE EXPECTANCY : 100,000 Hours\r\nFAN BEARING : Two Ball ',3000000,5,'MSI','CA009','products/Wcooling MSI Larang.jpg',1),
('PR0040','Deepcool Castle 360 RGB','DEEPCOOL LIQUID COOLING\r\n\r\nTechnical Spec\r\n\r\nPump Dimensions\r\n91×79×71 mm\r\n\r\nRadiator Dimensions\r\n402×120×27 mm\r\n\r\nRadiator Material\r\nAluminum\r\n\r\nNet Weight\r\n1768 g\r\n\r\nTube length\r\n465 mm\r\n\r\nPump Speed\r\n2550 RPM±10%\r\n\r\nPump Noise\r\n17.8 dB(A)\r\n\r\nPump Conne',1780000,3,'DeepCool','CA009','products/131283.jpg',1),
('PR0041','VGEN SSD 128 GB','Spesifikasi M.2 SATA:\r\nCapacity: 128GB, 256GB, 512GB, 1TB, 2TB\r\nInterface: M.2 / AHCI\r\nForm Factor: M.2 (2280)\r\nController: Asolid / Silicon Motion\r\nRead Speed: Up to 550 MB/s\r\nWrite Speed: Up to 520 MB/s\r\nGaransi Resmi 3 Tahun (Rusak langsung tukar, tida',180000,3,'VGEN','CA010','products/68d34788a3bd79e09abdbbf3ca94027c.jpg',1),
('PR0042','VGEN SSD 256 GB','Spesifikasi M.2 SATA:\r\nCapacity: 128GB, 256GB, 512GB, 1TB, 2TB\r\nInterface: M.2 / AHCI\r\nForm Factor: M.2 (2280)\r\nController: Asolid / Silicon Motion\r\nRead Speed: Up to 550 MB/s\r\nWrite Speed: Up to 520 MB/s\r\nGaransi Resmi 3 Tahun (Rusak langsung tukar, tida',400000,16,'VGEN','CA010','products/6ce5d6dcb60a686f9e32c7e90c047530.jpg',1),
('PR0043','VGEN SSD 512 GB','Spesifikasi M.2 SATA:\r\nCapacity: 128GB, 256GB, 512GB, 1TB, 2TB\r\nInterface: M.2 / AHCI\r\nForm Factor: M.2 (2280)\r\nController: Asolid / Silicon Motion\r\nRead Speed: Up to 550 MB/s\r\nWrite Speed: Up to 520 MB/s\r\nGaransi Resmi 3 Tahun (Rusak langsung tukar, tida',780000,7,'VGEN','CA010','products/https_s1.bukalapak.com_img_13619532981_large_data.jpeg',1),
('PR0044','SSD Colorful CN600 DDR 1TB PCIE 3.0 GEN3 M.2 NVME','Specification\r\nColorful CN600 1TB M.2 NVMe M2 PCIe Gen3x4 SSD\r\n\r\nSSD Series CN Series\r\nCapacity 1TB\r\nInterface M.2 NVME Interface\r\nNAND Type 3D NAND\r\nMaster Control YES\r\nRead Speed（Write Speed) 2000MB/S-1500MB/S',1890000,4,'Colorful','CA010','products/314325_22fc57f9-e32d-4ce7-b0ae-b65e5cce21da_636_636 (1).jfif',1),
('PR0045','SSD Colorful CN600 DDR 512GB PCIE 3.0 GEN3 M.2 NVME','Spesifikasi :\r\n- SSD Series : CN Series\r\n- Capacity : 512GB\r\n- Interface : M.2 NVME\r\n- NAND Type : 3D NAND\r\n- Master Control : YES\r\n- Read Speed（Write Speed) : 1500MB/S-500MB/S\r\n- Cache : N',780000,3,'Colorful','CA010','products/314325_22fc57f9-e32d-4ce7-b0ae-b65e5cce21da_636_636 (1).jfif',1),
('PR0046','SSD INTEL 660p 512gb','SSD Intel ni',790000,5,'Intel','CA010','products/messageImage_1633961194359.jpg',1),
('PR0047','SSD MSI SPATIUM M390 NVMe M.2 500GB','MODEL NAME SPATIUM M390 NVMe M.2\r\nCAPACITY 500GB 1TB\r\nCONTROLLER PHISON E15T\r\nFLASH MEMORY 3D NAND\r\nFORM FACTOR M.2 2280\r\nINTERFACE PCIe Gen3x4, NVMe 1.4\r\nCOMPATIBILITY PCIe Gen3 / Gen2 / Gen1\r\nDIMENSIONS 80.00mm (L) x 22.00mm (W) x 2.15mm (H)\r\nSEQUENTIAL',1000000,13,'MSI','CA010','products/messageImage_1637254740595.jpg',1),
('PR0048','Hdd Seagate 1TB Barracuda Internal Sata 3.5in','Seagate Barracuda 1TB HDD / Hardisk / Harddisk Internal PC 3.5\"\r\n\r\nSeagate BarraCuda sangat sesuai untuk Penyimpanan desktop, Penyimpanan all-in-one, Server Rumah, Perangkat DAS.\r\n\r\nSemua harddisk dalam famili BarraCuda dilengkapi dengan Multi-Tier Cachin',600000,4,'Seagate','CA011','products/70ee190711dfb9c446e654f01ce127a4.jpg',1),
('PR0049','Hdd Seagate 2TB Barracuda Internal Sata 3.5in','Hardisk Internal seagate 1TB 2TB 4TB HDD pc 3.5\" 7200 RPM | Resmi 2Th\r\n3.5 SATA 3 7200 RPM\r\n\r\nGaransi Resmi 2 Tahun\r\n\r\nBARACUDA 35 2 TB ST2000DM008\r\nBARACUDA 35 4 TB ST4000DM004\r\n\r\nSpesifikasi:\r\nCapacity : 1TB / 2TB / 4TB\r\n7200 rpm, \r\n64MB cache\r\nSATA 6Gb',910000,7,'Seagate','CA011','products/70ee190711dfb9c446e654f01ce127a4.jpg',1),
('PR0050','WD 1TB SATA3 Caviar Blue for PC','Specifications\r\n- Model Number: WD10EZEX\r\n- Interface: SATA 6 Gb/s\r\n- Form Factor: 3.5 Inch\r\n- RPM Class: 7200\r\n- Capacity: 1 TB\r\n- Cache: 64 MB\r\n\r\nDetail produk dari HDD WD 1 TB internal Blue',650000,4,'WD','CA011','products/7701906_6d96d200-bd53-4e36-84eb-45f6bcb81274_1280_960.jpg',1),
('PR0051','WD 2TB SATA3 Caviar Blue for PC','Specifications\r\n- Model Number: WD10EZEX\r\n- Interface: SATA 6 Gb/s\r\n- Form Factor: 3.5 Inch\r\n- RPM Class: 7200\r\n- Capacity: 2 TB\r\n- Cache: 64 MB\r\n\r\nDetail produk dari HDD WD 2 TB internal Blue',960000,6,'WD','CA011','products/7701906_6d96d200-bd53-4e36-84eb-45f6bcb81274_1280_960.jpg',1);

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
('US0002','paddy','paddy@mail.com','089512753','Jl medayu selaran','111',1),
('US0003','Michael Lukas Tjandra','lukastjan13@gmail.com','089517508300','Ngagel Jaya Tengah 52','123',1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
