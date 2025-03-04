-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 21, 2024 at 08:07 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `user_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `user_blog`
--

CREATE TABLE `user_blog` (
  `ID` int(1) NOT NULL,
  `Image` longblob NOT NULL,
  `Heading` varchar(25) NOT NULL,
  `AboutPlace` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `First Name` varchar(20) NOT NULL,
  `Middle Name` varchar(20) NOT NULL,
  `Last Name` varchar(20) NOT NULL,
  `Email Id` varchar(35) NOT NULL,
  `Phone Number` bigint(10) NOT NULL,
  `DOB` date NOT NULL,
  `Gender` text NOT NULL,
  `New Password` varchar(12) NOT NULL,
  `Confirm Password` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`First Name`, `Middle Name`, `Last Name`, `Email Id`, `Phone Number`, `DOB`, `Gender`, `New Password`, `Confirm Password`) VALUES
('asas', 'sasd', 's', 'aada123@gmail.com', 7899005819, '1987-01-04', 'male', 'qwerty', 'qwerty'),
('asas', 'weer', 'v', 'ad@345gmail.com', 7899005819, '2005-05-12', 'male', 'asdf', 'asdf'),
('Rajesh', 'Anand', 'Adigar', 'AdigaR3405@gmail.com', 7899005819, '1997-06-17', 'male', 'Adigar', 'Adigar'),
('Casasa', 'ssas', 'L', 'aDMiM@gmail.com', 7899005819, '2005-01-17', 'male', 'Rajesh', 'Rajesh'),
('Ram', 'Ok', 'Sure', 'admin454120@gmail.com', 7899005819, '1001-02-01', 'male', 'Copy', 'Copy'),
('Mayur', 'Ravikumar', 'Heggede', 'admin5@gmail.com', 7899005819, '2003-04-12', 'male', 'Mayur', 'Mayur'),
('Ramm', 'ok', 'yes', 'admin79@gmail.com', 7899005819, '2022-08-21', 'male', 'Copy', 'Copy'),
('Ram', 'Mohan ', 'Jonu', 'admin_86@gmail.com', 7899005819, '1924-02-12', 'male', 'yes', 'yes'),
('Rajesh', 'Avil', 'Doe', 'ajax4545@gmail.com', 7899005819, '2003-04-17', 'male', 'aaa', 'aaa'),
('qwerty', 'adassvdy', 'z', 'asdsefefec@gmail.com', 7899005819, '0000-00-00', 'female', '123456', '123456'),
('Joy', 'Roy', 'Doe', 'joy456@gmail.com', 7899005819, '2003-04-17', 'male', 'Rajesh', 'Rajesh'),
('Joy', 'Roy', 'Doe', 'joy4@gmail.com', 7899005819, '2003-04-17', 'male', 'joy567', 'joy567'),
('Rajesh', 'Babu', 'L', 'mohanad458@gmail.com', 7899005819, '2003-04-17', 'male', 'Rajesh', 'Rajesh'),
('Rajesh', 'Aradhya', 'H V', 'rajaradhya1704@gmail.com', 7899005819, '2003-04-17', 'male', 'Rajesh', 'Rajesh'),
('Joy', 'Avil', 'H A', 'xzxzx@gmail.com', 7899005819, '2005-08-07', 'male', 'Rajesh', 'Rajesh');

-- --------------------------------------------------------

--
-- Table structure for table `user_login`
--

CREATE TABLE `user_login` (
  `ID` int(11) NOT NULL,
  `Email` varchar(35) NOT NULL,
  `Password` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_login`
--

INSERT INTO `user_login` (`ID`, `Email`, `Password`) VALUES
(1, 'rajaradhya1704@gmail.com', 'Rajesh'),
(2, 'mohanad458@gmail.com', 'Rajesh'),
(3, 'joy456@gmail.com', 'Rajesh'),
(4, 'joy4@gmail.com', 'joy567'),
(5, 'admin5@gmail.com', 'Mayur'),
(6, 'ajax4545@gmail.com', 'aaa'),
(7, 'aada123@gmail.com', 'qwerty'),
(8, 'AdigaR3405@gmail.com', 'Adigar'),
(9, 'xzxzx@gmail.com', 'Rajesh'),
(10, 'aDMiM@gmail.com', 'Rajesh'),
(11, 'asdsefefec@gmail.com', '123456'),
(12, 'ad@345gmail.com', 'asdf'),
(13, 'admin79@gmail.com', 'Copy'),
(14, 'admin454120@gmail.com', 'Copy'),
(15, 'admin_86@gmail.com', 'yes');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user_blog`
--
ALTER TABLE `user_blog`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`Email Id`);

--
-- Indexes for table `user_login`
--
ALTER TABLE `user_login`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Email` (`Email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user_login`
--
ALTER TABLE `user_login`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_login`
--
ALTER TABLE `user_login`
  ADD CONSTRAINT `user_login_ibfk_1` FOREIGN KEY (`Email`) REFERENCES `user_details` (`Email Id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
