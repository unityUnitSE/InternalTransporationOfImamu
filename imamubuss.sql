-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 27, 2023 at 08:45 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `imamubuss`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `MAILID` varchar(40) NOT NULL,
  `PWORD` varchar(20) NOT NULL,
  `FNAME` varchar(20) NOT NULL,
  `LNAME` varchar(20) DEFAULT NULL,
  `ADDR` varchar(100) DEFAULT NULL,
  `PHNO` decimal(12,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`MAILID`, `PWORD`, `FNAME`, `LNAME`, `ADDR`, `PHNO`) VALUES
('admin1@demo.com', '234eds', '123123', '123123', '123123', 123123),
('admin2@demo.com', '3435', '123123', '123123', '123123', 123123),
('admin45@demo.com', '', '', '', '', 0),
('admin4@demo.com', '34t', '123123', '123123', '123123', 123123),
('admin5@demo.com', '', '', '', '', 0),
('admin@demo.com', 'admin', 'System', 'Admin', 'Demo Address 123 colony', 9874561230),
('Dena.i.s.s.1423@gmail.com', 'Dina1122', 'Dina', 'Alswailem', '-1213&', 558274121),
('Fayalmuqbil@gmail.com', 'Fa@1234', 'Fay', 'Almuqbil', 'Cs college ', 538741488),
('Feemmq93@gmail.com', 'fifi@1234', 'Fay', 'Cs', 'Cs college ', 538741488),
('hadeel156@hotmail.com', '111', 'H', 'N', 'N', 78),
('hadeel1@hotmail.com', '123', 'HADEEL', 'n', 'a', 222),
('hadeel2@hotmail.com', '111', 'h', 'm', 'a', 222),
('hadeel3@hotmail.com', '111', 'h', 'n', 'a', 22),
('hadeel5@hotmail.com', '111', 'h', 'n', 'a', 222),
('hadeel6@hotmail.com', '111', 'h', 'n', 'n', 222),
('hadeel@hotmail.com', '123', 'h', 'h', 'h', 222),
('hadeel_156@hotmail.com', '123456', 'Had', 'Nas', 'Hhhhhh', 394939292),
('hs.ose@hotmail.com', '123321', 'hessah', 'bhl', '324', 582737438),
('hussainzagzoug@gmail.com', '', '123123', '123123', '123123', 123123),
('taifaltuwaim@yahoo.com', 'taif11', 'Taif', 'Altuwaim', 'Imamu', 505471363);

-- --------------------------------------------------------

--
-- Table structure for table `buses`
--

CREATE TABLE `buses` (
  `BS_NO` decimal(10,0) NOT NULL,
  `BS_NAME` varchar(70) NOT NULL,
  `FROM_STN` varchar(20) NOT NULL,
  `TO_STN` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `buses`
--

INSERT INTO `buses` (`BS_NO`, `BS_NAME`, `FROM_STN`, `TO_STN`) VALUES
(10001, 'aaaa1', 'bbbb1', 'cccc1'),
(10002, 'aaaa2', 'bbbb2', 'cccc2'),
(10003, 'aaaa3', 'bbbb3', 'cccc3');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `MAILID` varchar(40) NOT NULL,
  `PWORD` varchar(20) NOT NULL,
  `FNAME` varchar(20) NOT NULL,
  `LNAME` varchar(20) DEFAULT NULL,
  `ADDR` varchar(100) DEFAULT NULL,
  `PHNO` decimal(12,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`MAILID`, `PWORD`, `FNAME`, `LNAME`, `ADDR`, `PHNO`) VALUES
('shashi@demo.com', 'shashi', 'Shashi', 'Raj', 'Kolkata, West Bengal', 954745222);

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `BusID` int(36) NOT NULL,
  `MAILID` varchar(40) DEFAULT NULL,
  `BS_NO` decimal(10,0) DEFAULT NULL,
  `DAYDATE` date DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`BusID`, `MAILID`, `BS_NO`, `DAYDATE`) VALUES
(1, 'shashi@demo.com', 10006, '2023-10-25'),
(2, 'shashi@demo.com', 10001, '2023-10-25'),
(3, 'shashi@demo.com', 10004, '2023-10-26'),
(4, 'admin@demo.com', 10001, '2023-10-26'),
(9, 'admin@demo.com', 10001, '2023-10-27'),
(10, 'hadeel6@hotmail.com', 0, '2023-10-27'),
(11, 'hadeel5@hotmail.com', 10001, '2023-10-27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`MAILID`);

--
-- Indexes for table `buses`
--
ALTER TABLE `buses`
  ADD PRIMARY KEY (`BS_NO`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`MAILID`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`BusID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `BusID` int(36) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
