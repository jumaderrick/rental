-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 03, 2016 at 03:26 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 7.0.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rental`
--

-- --------------------------------------------------------

--
-- Table structure for table `activities`
--

CREATE TABLE `activities` (
  `id` int(11) NOT NULL,
  `activity` text NOT NULL,
  `createdAt` int(11) NOT NULL,
  `browser` text NOT NULL,
  `os` text NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `createdAt`) VALUES
(1, 'Joyce', 'shiqo', '2016-10-30 14:23:02');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `surname` varchar(30) NOT NULL,
  `othername` varchar(100) NOT NULL,
  `dateofemployement` date NOT NULL,
  `gender` enum('M','F') NOT NULL,
  `jobcode` int(11) NOT NULL,
  `createdAt` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `surname`, `othername`, `dateofemployement`, `gender`, `jobcode`, `createdAt`) VALUES
(4, 'Munene', 'Alex Muriithi', '2016-11-23', 'M', 1, 1478165080),
(5, 'Njoroge', 'Josphat Mugo', '2016-11-16', 'M', 2, 1478165162);

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` int(11) NOT NULL,
  `expensename` text NOT NULL,
  `amount` float NOT NULL,
  `dateofexpense` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `house_details`
--

CREATE TABLE `house_details` (
  `id` int(11) NOT NULL,
  `houseno` text NOT NULL,
  `plotnumber` int(11) NOT NULL,
  `rent` float NOT NULL,
  `occupied` enum('0','1') NOT NULL,
  `tenant` int(11) NOT NULL,
  `dateoccupied` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `house_details`
--

INSERT INTO `house_details` (`id`, `houseno`, `plotnumber`, `rent`, `occupied`, `tenant`, `dateoccupied`) VALUES
(1, 'EGF-76', 1, 3000, '1', 1, 1477987296),
(2, 'GH-z', 1, 4000, '0', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `jobdetails`
--

CREATE TABLE `jobdetails` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `jobcode` varchar(100) NOT NULL,
  `allowances` float NOT NULL,
  `tax` float NOT NULL,
  `createdAt` int(11) NOT NULL,
  `salary` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jobdetails`
--

INSERT INTO `jobdetails` (`id`, `title`, `jobcode`, `allowances`, `tax`, `createdAt`, `salary`) VALUES
(1, 'C.E.O', 'CXER', 1000, 20, 1478181081, 1000),
(2, 'Secretary', 'SCY', 250, 10, 1478181095, 10000);

-- --------------------------------------------------------

--
-- Table structure for table `landlord_details`
--

CREATE TABLE `landlord_details` (
  `id` int(11) NOT NULL,
  `surname` text NOT NULL,
  `othername` text NOT NULL,
  `plotno` text NOT NULL,
  `telno` text NOT NULL,
  `amount` float NOT NULL,
  `landlordno` varchar(30) NOT NULL,
  `gender` enum('M','F') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `landlord_details`
--

INSERT INTO `landlord_details` (`id`, `surname`, `othername`, `plotno`, `telno`, `amount`, `landlordno`, `gender`) VALUES
(1, 'Njuguna', 'Geoffrey Maina', '', '0719432359', 30000, 'LAIYdsgoHRD', 'M');

-- --------------------------------------------------------

--
-- Table structure for table `landlord_disbursement`
--

CREATE TABLE `landlord_disbursement` (
  `id` int(11) NOT NULL,
  `tenantno` int(11) NOT NULL,
  `landlordno` int(11) NOT NULL,
  `hseno` int(11) NOT NULL,
  `plotno` int(11) NOT NULL,
  `amount` float NOT NULL,
  `disdate` int(11) NOT NULL,
  `transaction` varchar(40) NOT NULL,
  `deduct` float NOT NULL,
  `tax` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `landlord_disbursement`
--

INSERT INTO `landlord_disbursement` (`id`, `tenantno`, `landlordno`, `hseno`, `plotno`, `amount`, `disdate`, `transaction`, `deduct`, `tax`) VALUES
(6, 1, 1, 1, 1, 4800, 1478174140, 'TR68B6H686N', 1200, 600);

-- --------------------------------------------------------

--
-- Table structure for table `plots`
--

CREATE TABLE `plots` (
  `id` int(11) NOT NULL,
  `plotname` text NOT NULL,
  `plotnumber` text NOT NULL,
  `landlord` int(11) NOT NULL,
  `picture` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `plots`
--

INSERT INTO `plots` (`id`, `plotname`, `plotnumber`, `landlord`, `picture`) VALUES
(1, 'Maina Plaza', '4444', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `rates`
--

CREATE TABLE `rates` (
  `id` int(11) NOT NULL,
  `rate` float NOT NULL,
  `active` enum('0','1') NOT NULL DEFAULT '1',
  `createdAt` int(11) NOT NULL,
  `tax` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rates`
--

INSERT INTO `rates` (`id`, `rate`, `active`, `createdAt`, `tax`) VALUES
(2, 20, '1', 1478173774, 10),
(4, 4, '0', 1478176159, 6);

-- --------------------------------------------------------

--
-- Table structure for table `rent_details`
--

CREATE TABLE `rent_details` (
  `id` int(11) NOT NULL,
  `tenant_no` int(11) NOT NULL,
  `rent_paid` float NOT NULL,
  `rent_balance` float NOT NULL,
  `rent_fine` float NOT NULL,
  `rent_advance` text NOT NULL,
  `plotno` int(11) NOT NULL,
  `houseno` int(11) NOT NULL,
  `datepaid` int(11) NOT NULL,
  `transaction` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rent_details`
--

INSERT INTO `rent_details` (`id`, `tenant_no`, `rent_paid`, `rent_balance`, `rent_fine`, `rent_advance`, `plotno`, `houseno`, `datepaid`, `transaction`) VALUES
(8, 1, 6000, 0, 0, '', 1, 1, 1478174140, 'TRJ8JJH8J8N');

-- --------------------------------------------------------

--
-- Table structure for table `tenant_details`
--

CREATE TABLE `tenant_details` (
  `id` int(11) NOT NULL,
  `surname` text NOT NULL,
  `othername` text NOT NULL,
  `hseno` int(11) NOT NULL,
  `plotno` int(11) NOT NULL,
  `hseAllocDate` int(11) NOT NULL,
  `telno` text NOT NULL,
  `tenantno` text NOT NULL,
  `gender` enum('M','F') NOT NULL,
  `createdAt` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tenant_details`
--

INSERT INTO `tenant_details` (`id`, `surname`, `othername`, `hseno`, `plotno`, `hseAllocDate`, `telno`, `tenantno`, `gender`, `createdAt`) VALUES
(1, 'Njuguna', 'Antony Njeri', 1, 1, 1477996762, '0718546287', 'Tc0lYb7EJ1N', 'M', 1477906789);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `house_details`
--
ALTER TABLE `house_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobdetails`
--
ALTER TABLE `jobdetails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `landlord_details`
--
ALTER TABLE `landlord_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `landlord_disbursement`
--
ALTER TABLE `landlord_disbursement`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `plots`
--
ALTER TABLE `plots`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rates`
--
ALTER TABLE `rates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rent_details`
--
ALTER TABLE `rent_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tenant_details`
--
ALTER TABLE `tenant_details`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activities`
--
ALTER TABLE `activities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `house_details`
--
ALTER TABLE `house_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `jobdetails`
--
ALTER TABLE `jobdetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `landlord_details`
--
ALTER TABLE `landlord_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `landlord_disbursement`
--
ALTER TABLE `landlord_disbursement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `plots`
--
ALTER TABLE `plots`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `rates`
--
ALTER TABLE `rates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `rent_details`
--
ALTER TABLE `rent_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `tenant_details`
--
ALTER TABLE `tenant_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
username joyce
pass shiqo