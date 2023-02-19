-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 09, 2022 at 06:18 PM
-- Server version: 8.0.18
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pharmacy`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `admin_id` tinyint(5) NOT NULL AUTO_INCREMENT,
  `username` varchar(10) NOT NULL,
  `password` varchar(10) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `username`, `password`, `date`) VALUES
(1, 'Alifarooq', 'Pakispak2', '2022-12-03 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `cashier`
--

DROP TABLE IF EXISTS `cashier`;
CREATE TABLE IF NOT EXISTS `cashier` (
  `cashier_id` tinyint(5) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(15) NOT NULL,
  `last_name` varchar(15) NOT NULL,
  `staff_id` varchar(10) NOT NULL,
  `postal_address` varchar(20) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `email` varchar(20) NOT NULL,
  `username` varchar(10) NOT NULL,
  `password` varchar(10) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`cashier_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cashier`
--

INSERT INTO `cashier` (`cashier_id`, `first_name`, `last_name`, `staff_id`, `postal_address`, `phone`, `email`, `username`, `password`, `date`) VALUES
(1, 'M', 'Ahmad', '5', 'Azmir Town', '0302342242', 'M.Ahmad123@gmail.com', 'Ahmad', 'Pakispak2', '2022-12-03 23:16:41');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `invoice_no` int(255) NOT NULL,
  `cust_name` varchar(255) NOT NULL,
  `drug` varchar(255) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `tot` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `drug`
--

DROP TABLE IF EXISTS `drug`;
CREATE TABLE IF NOT EXISTS `drug` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `drug_id` varchar(255) NOT NULL,
  `intial_cost` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `drugtype`
--

DROP TABLE IF EXISTS `drugtype`;
CREATE TABLE IF NOT EXISTS `drugtype` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `description` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `drugtype`
--

INSERT INTO `drugtype` (`id`, `description`, `category`) VALUES
(1, 'Tablets', 'Painkiller'),
(2, 'Syrup', 'Malaria'),
(3, 'Tubes/bottles', 'Reproductive'),
(4, 'Others', 'Stomach relief');

-- --------------------------------------------------------

--
-- Table structure for table `ids`
--

DROP TABLE IF EXISTS `ids`;
CREATE TABLE IF NOT EXISTS `ids` (
  `userid` int(255) NOT NULL AUTO_INCREMENT,
  `ids` varchar(255) NOT NULL,
  `invoice_id` varchar(255) NOT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ids`
--

INSERT INTO `ids` (`userid`, `ids`, `invoice_id`) VALUES
(1, '1901093', '10'),
(2, '1901093', '10'),
(3, '1901093', '10'),
(4, '2', '11'),
(5, '4', '12'),
(6, '', '13'),
(7, '', '14'),
(8, '', '15'),
(9, '', '16'),
(10, '', '17'),
(11, '', '18'),
(12, '', '19'),
(13, '', '20'),
(14, '3', '21'),
(15, '4', '22'),
(16, '1901093', '10'),
(17, '1901093', '10');

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

DROP TABLE IF EXISTS `invoice`;
CREATE TABLE IF NOT EXISTS `invoice` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `invoice_id` int(255) NOT NULL,
  `customer_name` varchar(30) NOT NULL,
  `served_by` varchar(15) NOT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'Unpaid',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`id`, `invoice_id`, `customer_name`, `served_by`, `status`, `date`) VALUES
(1, 10, 'MAF', '2342', 'Pending', '2022-12-26 01:29:42'),
(4, 11, 'Ali', 'Gulberg', 'Pending', '2022-12-08 12:40:13'),
(5, 12, 'Ahmad', 'Uet', 'Pending', '2022-12-09 08:05:01'),
(14, 21, 'Ahmad', 'Uet', 'Pending', '2022-12-09 10:18:37'),
(15, 22, 'Farhan', 'Uet', 'Pending', '2022-12-09 16:50:51'),
(16, 10, 'simon wagura gatu', 'Uet', 'Pending', '2022-12-09 16:55:28'),
(17, 10, 'simon wagura gatu', 'Uet', 'Pending', '2022-12-09 16:58:09');

--
-- Triggers `invoice`
--
DROP TRIGGER IF EXISTS `invoice`;
DELIMITER $$
CREATE TRIGGER `invoice` AFTER INSERT ON `invoice` FOR EACH ROW BEGIN
     SET @date=NOW();
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `invoice_details`
--

DROP TABLE IF EXISTS `invoice_details`;
CREATE TABLE IF NOT EXISTS `invoice_details` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `invoice` varchar(255) NOT NULL,
  `drug` varchar(255) NOT NULL,
  `cost` int(5) DEFAULT NULL,
  `quantity` int(5) NOT NULL,
  `day` varchar(255) NOT NULL,
  `month` varchar(255) NOT NULL,
  `year` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice_details`
--

INSERT INTO `invoice_details` (`id`, `invoice`, `drug`, `cost`, `quantity`, `day`, `month`, `year`) VALUES
(1, '10', '5', 10, 21, '26', 'July', '2022'),
(2, '10', '5', 10, 21, '26', 'July', '2022'),
(3, '10', '9', 12, 10, '26', 'July', '2022'),
(4, '10', '5', 10, 21, '26', 'July', '2022'),
(5, '10', '9', 12, 10, '26', 'July', '2022'),
(6, '10', '32', 22, 4, '26', 'July', '2022'),
(8, '11', '5', 100, 20, '8', 'December', '2022'),
(12, '22', '34', 10, 20, '9', 'December', '2022'),
(16, '10', '34', 10, 2, '9', 'December', '2022'),
(20, '10', '34', 10, 2, '9', 'December', '2022'),
(21, '10', '34', 10, 50, '9', 'December', '2022');

-- --------------------------------------------------------

--
-- Table structure for table `manager`
--

DROP TABLE IF EXISTS `manager`;
CREATE TABLE IF NOT EXISTS `manager` (
  `manager_id` tinyint(5) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(15) NOT NULL,
  `last_name` varchar(15) NOT NULL,
  `staff_id` varchar(10) NOT NULL,
  `postal_address` varchar(20) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `email` varchar(20) NOT NULL,
  `username` varchar(10) NOT NULL,
  `password` varchar(10) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`manager_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `manager`
--

INSERT INTO `manager` (`manager_id`, `first_name`, `last_name`, `staff_id`, `postal_address`, `phone`, `email`, `username`, `password`, `date`) VALUES
(4, 'M', 'Huzifa', '5', 'UET Lahore', '03007995343', 'alifarooq123@gmail.c', 'Huzifa', 'Pakispak2', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `paymenttypes`
--

DROP TABLE IF EXISTS `paymenttypes`;
CREATE TABLE IF NOT EXISTS `paymenttypes` (
  `id` tinyint(5) NOT NULL AUTO_INCREMENT,
  `Name` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `paymenttypes`
--

INSERT INTO `paymenttypes` (`id`, `Name`) VALUES
(1, 'Cash'),
(2, 'Credit card'),
(3, 'Mobile Money'),
(4, 'Cheque');

-- --------------------------------------------------------

--
-- Table structure for table `pharmacist`
--

DROP TABLE IF EXISTS `pharmacist`;
CREATE TABLE IF NOT EXISTS `pharmacist` (
  `pharmacist_id` tinyint(5) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(15) NOT NULL,
  `last_name` varchar(15) NOT NULL,
  `staff_id` varchar(10) NOT NULL,
  `postal_address` varchar(20) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `email` varchar(20) NOT NULL,
  `username` varchar(10) NOT NULL,
  `password` varchar(10) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`pharmacist_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pharmacist`
--

INSERT INTO `pharmacist` (`pharmacist_id`, `first_name`, `last_name`, `staff_id`, `postal_address`, `phone`, `email`, `username`, `password`, `date`) VALUES
(9, 'Ali', 'Farooq', '124', 'Uet', '03007995343', 'rn4004341@gmail.com', 'Ali', 'Pakispak2', '2022-12-09 11:44:23');

-- --------------------------------------------------------

--
-- Table structure for table `prescription`
--

DROP TABLE IF EXISTS `prescription`;
CREATE TABLE IF NOT EXISTS `prescription` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `prescription_id` varchar(255) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `invoice_id` varchar(255) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prescription`
--

INSERT INTO `prescription` (`id`, `prescription_id`, `customer_id`, `customer_name`, `invoice_id`, `phone`, `date`) VALUES
(1, '999', 1901093, 'simon wagura gatu', '10', '0728441045', '2022-12-26 01:29:41'),
(2, '1', 5, 'Ali', '12', '03007995343', '2022-12-09 10:05:44'),
(13, '1000', 3, 'Ahmad', '21', '03007995343', '2022-12-09 10:18:37'),
(14, '1000', 4, 'Farhan', '22', '03003534352', '2022-12-09 16:50:51');

--
-- Triggers `prescription`
--
DROP TRIGGER IF EXISTS `Prescription`;
DELIMITER $$
CREATE TRIGGER `Prescription` AFTER INSERT ON `prescription` FOR EACH ROW BEGIN
SET@date=NOW();
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `prescription_details`
--

DROP TABLE IF EXISTS `prescription_details`;
CREATE TABLE IF NOT EXISTS `prescription_details` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `pres_id` int(5) NOT NULL,
  `drug_name` varchar(255) NOT NULL,
  `strength` varchar(15) NOT NULL,
  `dose` varchar(15) NOT NULL,
  `quantity` varchar(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=62 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `prescription_details`
--

INSERT INTO `prescription_details` (`id`, `pres_id`, `drug_name`, `strength`, `dose`, `quantity`) VALUES
(1, 999, '5', '10 mg', '1x3', '21'),
(2, 999, '5', '10 mg', '1x3', '21'),
(3, 999, '9', '5 mg', '1x2', '10'),
(4, 999, '5', '10 mg', '1x3', '21'),
(5, 999, '9', '5 mg', '1x2', '10'),
(6, 999, '5', '10 mg', '1x3', '21'),
(7, 999, '9', '5 mg', '1x2', '10'),
(8, 999, '32', '100mg', '1x2 ', '4'),
(9, 999, '5', '10 mg', '1x3', '21'),
(10, 999, '9', '5 mg', '1x2', '10'),
(11, 999, '32', '100mg', '1x2 ', '4'),
(12, 999, '5', '10 mg', '1x3', '21'),
(13, 999, '9', '5 mg', '1x2', '10'),
(14, 999, '32', '100mg', '1x2 ', '4'),
(16, 1000, '5', '10mg', '1', '20'),
(20, 1000, '34', '100mg', '1', '20'),
(24, 999, '34', '10mg', '1', '2'),
(28, 999, '34', '10mg', '1', '2'),
(32, 999, '34', '10mg', '1', '2'),
(36, 999, '34', '10mg', '1', '2'),
(39, 999, '', '100mg', '1x2 ', '4'),
(40, 999, '34', '10mg', '1', '2'),
(41, 999, '34', '10mg', '20', '50'),
(42, 999, '', '10 mg', '1x3', '21'),
(43, 999, '', '5 mg', '1x2', '10'),
(44, 999, '', '100mg', '1x2 ', '4'),
(45, 999, '34', '10mg', '1', '2'),
(46, 999, '34', '10mg', '20', '50'),
(47, 999, '', '10 mg', '1x3', '21'),
(48, 999, '', '5 mg', '1x2', '10'),
(49, 999, '', '100mg', '1x2 ', '4'),
(50, 999, '34', '10mg', '1', '2'),
(51, 999, '34', '10mg', '20', '50'),
(52, 999, '', '10 mg', '1x3', '21'),
(53, 999, '', '5 mg', '1x2', '10'),
(54, 999, '', '100mg', '1x2 ', '4'),
(55, 999, '34', '10mg', '1', '2'),
(56, 999, '34', '10mg', '20', '50'),
(57, 999, '', '10 mg', '1x3', '21'),
(58, 999, '', '5 mg', '1x2', '10'),
(59, 999, '', '100mg', '1x2 ', '4'),
(60, 999, '34', '10mg', '1', '2'),
(61, 999, '34', '10mg', '20', '50');

-- --------------------------------------------------------

--
-- Table structure for table `receipts`
--

DROP TABLE IF EXISTS `receipts`;
CREATE TABLE IF NOT EXISTS `receipts` (
  `reciptNo` int(10) NOT NULL AUTO_INCREMENT,
  `customer_id` varchar(10) NOT NULL,
  `total` int(10) NOT NULL,
  `payType` varchar(10) NOT NULL,
  `serialno` varchar(10) DEFAULT NULL,
  `served_by` varchar(15) NOT NULL,
  `date` varchar(255) NOT NULL,
  PRIMARY KEY (`reciptNo`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `receipts`
--

INSERT INTO `receipts` (`reciptNo`, `customer_id`, `total`, `payType`, `serialno`, `served_by`, `date`) VALUES
(1, '1901093', 88, 'Cash', '10002', 'sam', 'Thursday, July 26 2022'),
(10, '1901093', 500, 'Cash', '10004', 'Ahmad', 'Thursday, January 01 1970, 12:00:00 AM');

--
-- Triggers `receipts`
--
DROP TRIGGER IF EXISTS `receipts`;
DELIMITER $$
CREATE TRIGGER `receipts` AFTER INSERT ON `receipts` FOR EACH ROW BEGIN
     SET @date=NOW();
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

DROP TABLE IF EXISTS `sales`;
CREATE TABLE IF NOT EXISTS `sales` (
  `userid` int(255) NOT NULL AUTO_INCREMENT,
  `invoice` varchar(255) NOT NULL,
  `drug` varchar(255) NOT NULL,
  `cost` varchar(255) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `day` varchar(255) NOT NULL,
  `month` varchar(255) NOT NULL,
  `year` varchar(255) NOT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`userid`, `invoice`, `drug`, `cost`, `quantity`, `day`, `month`, `year`) VALUES
(1, '10', '5', '10', '21', '26', 'July', '2022'),
(4, '11', '5', '100', '20', '8', 'December', '2022'),
(15, '22', '34', '10', '20', '9', 'December', '2022'),
(16, '10', '34', '10', '2', '9', 'December', '2022'),
(17, '10', '34', '10', '50', '9', 'December', '2022');

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

DROP TABLE IF EXISTS `stock`;
CREATE TABLE IF NOT EXISTS `stock` (
  `stock_id` tinyint(5) NOT NULL AUTO_INCREMENT,
  `drug_name` varchar(20) NOT NULL,
  `category` varchar(20) NOT NULL,
  `description` varchar(50) NOT NULL,
  `company` varchar(20) NOT NULL,
  `supplier` varchar(20) NOT NULL,
  `strength` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `cost` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `date_supplied` date NOT NULL,
  PRIMARY KEY (`stock_id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`stock_id`, `drug_name`, `category`, `description`, `company`, `supplier`, `strength`, `quantity`, `cost`, `status`, `date_supplied`) VALUES
(35, 'brufen', 'Tablets', 'Stomach relief', 'vezf', 'zinxef', '100', 30, 15, 'low', '2022-12-09');

-- --------------------------------------------------------

--
-- Table structure for table `tempprescri`
--

DROP TABLE IF EXISTS `tempprescri`;
CREATE TABLE IF NOT EXISTS `tempprescri` (
  `userid` int(255) NOT NULL AUTO_INCREMENT,
  `customer_id` varchar(255) NOT NULL,
  `customer_name` varchar(30) DEFAULT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `drug_name` varchar(30) NOT NULL,
  `strength` varchar(30) NOT NULL,
  `dose` varchar(30) NOT NULL,
  `quantity` varchar(30) NOT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tempprescri`
--

INSERT INTO `tempprescri` (`userid`, `customer_id`, `customer_name`, `phone`, `drug_name`, `strength`, `dose`, `quantity`) VALUES
(4, '2', 'Ali', '03003534352', 'Select Drug', '10mg', '1', '20'),
(5, '2', 'Ali', '03003534352', 'Piriton', '10mg', '1', '20'),
(6, '4', 'Ahmad', '03007995343', 'Select Drug', '10mg', '1', '20'),
(7, '2', 'Ali', '03007995343', 'Select Drug', '10mg', '1', '20'),
(8, '2', 'Ali', '03007995343', 'panadol', '10mg', '1', '20'),
(9, '4', 'Farhan', '03003534352', 'Select Drug', '100mg', '1', '20'),
(10, '4', 'Farhan', '03003534352', 'panadol', '100mg', '1', '20');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
