-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 17, 2020 at 03:30 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `skdbl`
--

-- --------------------------------------------------------

--
-- Table structure for table `allocationdetails`
--

CREATE TABLE `allocationdetails` (
  `aid` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `departmentCode` varchar(2) NOT NULL,
  `branchCode` varchar(3) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `entryDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `allocationdetails`
--

INSERT INTO `allocationdetails` (`aid`, `pid`, `departmentCode`, `branchCode`, `quantity`, `entryDate`) VALUES
(101, 402, 'IT', 'BRT', 3, '2020-08-09 04:56:29'),
(102, 402, 'IT', 'ITH', 3, '2020-08-11 06:13:15'),
(103, 401, 'IT', 'BRT', 4, '2020-08-11 06:44:23');

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE `branch` (
  `branchCode` varchar(3) NOT NULL,
  `branchNo` int(11) NOT NULL,
  `branchName` varchar(15) NOT NULL,
  `location` varchar(30) NOT NULL,
  `establishedDate` date DEFAULT NULL,
  `postingDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`branchCode`, `branchNo`, `branchName`, `location`, `establishedDate`, `postingDate`) VALUES
('BRT', 1, 'Biratnagar', 'Main Road, Biratnagar', '2008-08-08', '2020-07-20 04:54:10'),
('DRN', 3, 'Dharan', 'Dharan, Sunsari, Province 1', '2015-10-07', '2020-08-16 09:25:38'),
('ITH', 2, 'Itahari', 'Itahari', '2009-09-09', '2020-07-20 05:00:55');

-- --------------------------------------------------------

--
-- Table structure for table `categorydetails`
--

CREATE TABLE `categorydetails` (
  `cid` int(11) NOT NULL,
  `cName` varchar(30) NOT NULL,
  `cCode` varchar(3) NOT NULL,
  `creationDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categorydetails`
--

INSERT INTO `categorydetails` (`cid`, `cName`, `cCode`, `creationDate`) VALUES
(302, 'Electronic goods', 'ELE', '2020-08-06 10:25:45'),
(301, 'Furniture', 'FUR', '2020-08-06 08:10:55');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `departmentCode` varchar(2) NOT NULL,
  `departmentNo` int(11) NOT NULL,
  `departmentName` varchar(30) NOT NULL,
  `postingDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`departmentCode`, `departmentNo`, `departmentName`, `postingDate`) VALUES
('FN', 2, 'Finance', '2020-07-20 05:09:35'),
('GS', 3, 'General Service', '2020-07-20 05:10:05'),
('HR', 5, 'Human Resource', '2020-07-20 05:11:08'),
('IA', 4, 'Internal Audit', '2020-07-20 05:10:36'),
('IT', 1, 'Information Technology', '2020-07-20 05:08:46'),
('LN', 6, 'Loan', '2020-08-16 09:45:26');

-- --------------------------------------------------------

--
-- Table structure for table `itemsvendor`
--

CREATE TABLE `itemsvendor` (
  `ivid` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `vid` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `totalCost` bigint(20) DEFAULT NULL,
  `entryDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `itemsvendor`
--

INSERT INTO `itemsvendor` (`ivid`, `pid`, `vid`, `quantity`, `totalCost`, `entryDate`) VALUES
(601, 401, 801, 4, 28000, '2020-08-11 08:53:21'),
(610, 401, 801, 1, 7000, '2020-08-13 12:28:37'),
(611, 401, 801, 2, 14000, '2020-08-13 12:31:17'),
(612, 401, 801, 3, 21000, '2020-08-14 17:43:18'),
(613, 401, 801, 3, 21000, '2020-08-16 08:26:22'),
(614, 401, 801, 1, 7000, '2020-08-16 08:26:30');

-- --------------------------------------------------------

--
-- Table structure for table `logindetails`
--

CREATE TABLE `logindetails` (
  `id` int(11) NOT NULL,
  `userName` varchar(25) NOT NULL,
  `password` varchar(21) NOT NULL,
  `creationDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `logindetails`
--

INSERT INTO `logindetails` (`id`, `userName`, `password`, `creationDate`) VALUES
(100, 'admin', '5f4dcc3b5aa765d61d832', '2020-08-05 08:58:39');

-- --------------------------------------------------------

--
-- Table structure for table `personaldetails`
--

CREATE TABLE `personaldetails` (
  `id` int(11) NOT NULL,
  `fName` varchar(255) DEFAULT NULL,
  `mName` varchar(255) DEFAULT NULL,
  `lName` varchar(255) DEFAULT NULL,
  `userName` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `postingDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `personaldetails`
--

INSERT INTO `personaldetails` (`id`, `fName`, `mName`, `lName`, `userName`, `password`, `postingDate`) VALUES
(100, 'Stock', 'Admin', 'SKDBL', 'admin', '5f4dcc3b5aa765d61d8327deb882cf99', '2020-08-05 09:40:03');

-- --------------------------------------------------------

--
-- Table structure for table `productdetails`
--

CREATE TABLE `productdetails` (
  `pid` int(11) NOT NULL,
  `pName` varchar(50) NOT NULL,
  `pSpecification` varchar(50) DEFAULT NULL,
  `pCompany` varchar(30) DEFAULT NULL,
  `pRate` float DEFAULT NULL,
  `pSCategory` varchar(30) NOT NULL,
  `entryDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `productdetails`
--

INSERT INTO `productdetails` (`pid`, `pName`, `pSpecification`, `pCompany`, `pRate`, `pSCategory`, `entryDate`) VALUES
(401, 'Color Printer', 'C4HJ890', 'HP', 7000, 'Printer', '2020-08-05 11:16:57'),
(402, 'Desk', '2 ft * 1 ft', 'Sample Furnitures', NULL, 'Table', '2020-08-08 13:37:45');

-- --------------------------------------------------------

--
-- Table structure for table `productstock`
--

CREATE TABLE `productstock` (
  `pid` int(11) NOT NULL,
  `inUse` int(11) NOT NULL,
  `damaged` int(11) NOT NULL DEFAULT 0,
  `inStock` int(11) NOT NULL DEFAULT 0,
  `total` int(11) NOT NULL,
  `entryDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `productstock`
--

INSERT INTO `productstock` (`pid`, `inUse`, `damaged`, `inStock`, `total`, `entryDate`) VALUES
(401, 9, 2, 4, 15, '2020-08-11 06:43:06'),
(402, 6, 1, 0, 7, '2020-08-09 04:34:18');

-- --------------------------------------------------------

--
-- Table structure for table `subcategorydetails`
--

CREATE TABLE `subcategorydetails` (
  `scid` int(11) NOT NULL,
  `scName` varchar(30) NOT NULL,
  `cCode` varchar(3) NOT NULL,
  `creationDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subcategorydetails`
--

INSERT INTO `subcategorydetails` (`scid`, `scName`, `cCode`, `creationDate`) VALUES
(901, 'Chair', 'FUR', '2020-08-06 08:15:36'),
(902, 'Printer', 'ELE', '2020-08-06 10:26:47'),
(903, 'Table', 'FUR', '2020-08-08 13:37:22');

-- --------------------------------------------------------

--
-- Table structure for table `vendordetails`
--

CREATE TABLE `vendordetails` (
  `vid` int(11) NOT NULL,
  `vName` varchar(50) NOT NULL,
  `vAddress` varchar(50) NOT NULL,
  `vContactNo` bigint(10) NOT NULL,
  `vAltContactNo` bigint(10) DEFAULT NULL,
  `vEmail` varchar(30) DEFAULT NULL,
  `vOwner` varchar(30) DEFAULT NULL,
  `entryDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vendordetails`
--

INSERT INTO `vendordetails` (`vid`, `vName`, `vAddress`, `vContactNo`, `vAltContactNo`, `vEmail`, `vOwner`, `entryDate`) VALUES
(801, 'Sample Suppliers', 'Biratnagar 9, Morang', 9876543210, 456093, '', 'Sample Sample', '2020-08-06 11:12:59'),
(802, 'Random Sample', 'Random Sample', 9876567654, 657676, 'sample2@sample.com', 'Random Sample', '2020-08-07 06:29:07'),
(803, 'Add Vendor Sample', 'Add Vendor Sample', 9843565476, 547983, 'addvendor@sample.com', 'Add Vendor Sample', '2020-08-07 11:35:43'),
(804, 'Edit Vendor Sample', 'Edit Vendor Sample', 9828736366, 523533, 'editvendor@sample.com', 'Edit Vendor Sample', '2020-08-07 15:01:37');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `allocationdetails`
--
ALTER TABLE `allocationdetails`
  ADD PRIMARY KEY (`aid`),
  ADD KEY `pid` (`pid`),
  ADD KEY `departmentCode` (`departmentCode`),
  ADD KEY `branchCode` (`branchCode`);

--
-- Indexes for table `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`branchCode`),
  ADD UNIQUE KEY `branchNo` (`branchNo`);

--
-- Indexes for table `categorydetails`
--
ALTER TABLE `categorydetails`
  ADD PRIMARY KEY (`cCode`),
  ADD UNIQUE KEY `cid` (`cid`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`departmentCode`),
  ADD UNIQUE KEY `departmentNo` (`departmentNo`);

--
-- Indexes for table `itemsvendor`
--
ALTER TABLE `itemsvendor`
  ADD PRIMARY KEY (`ivid`);

--
-- Indexes for table `logindetails`
--
ALTER TABLE `logindetails`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `userName` (`userName`);

--
-- Indexes for table `personaldetails`
--
ALTER TABLE `personaldetails`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `userNAme` (`userName`);

--
-- Indexes for table `productdetails`
--
ALTER TABLE `productdetails`
  ADD PRIMARY KEY (`pid`),
  ADD KEY `pSCategory` (`pSCategory`);

--
-- Indexes for table `productstock`
--
ALTER TABLE `productstock`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `subcategorydetails`
--
ALTER TABLE `subcategorydetails`
  ADD PRIMARY KEY (`scName`),
  ADD UNIQUE KEY `scid` (`scid`),
  ADD KEY `cCode` (`cCode`);

--
-- Indexes for table `vendordetails`
--
ALTER TABLE `vendordetails`
  ADD PRIMARY KEY (`vid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `allocationdetails`
--
ALTER TABLE `allocationdetails`
  MODIFY `aid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `branch`
--
ALTER TABLE `branch`
  MODIFY `branchNo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `categorydetails`
--
ALTER TABLE `categorydetails`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=303;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `departmentNo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `itemsvendor`
--
ALTER TABLE `itemsvendor`
  MODIFY `ivid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=615;

--
-- AUTO_INCREMENT for table `logindetails`
--
ALTER TABLE `logindetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `personaldetails`
--
ALTER TABLE `personaldetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `productdetails`
--
ALTER TABLE `productdetails`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=403;

--
-- AUTO_INCREMENT for table `subcategorydetails`
--
ALTER TABLE `subcategorydetails`
  MODIFY `scid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=904;

--
-- AUTO_INCREMENT for table `vendordetails`
--
ALTER TABLE `vendordetails`
  MODIFY `vid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=805;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `allocationdetails`
--
ALTER TABLE `allocationdetails`
  ADD CONSTRAINT `allocationdetails_ibfk_1` FOREIGN KEY (`pid`) REFERENCES `productdetails` (`pid`),
  ADD CONSTRAINT `allocationdetails_ibfk_2` FOREIGN KEY (`departmentCode`) REFERENCES `department` (`departmentCode`),
  ADD CONSTRAINT `allocationdetails_ibfk_3` FOREIGN KEY (`branchCode`) REFERENCES `branch` (`branchCode`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
