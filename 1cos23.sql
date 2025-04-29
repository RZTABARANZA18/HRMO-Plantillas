-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 05, 2024 at 08:09 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `1cos23`
--

-- --------------------------------------------------------

--
-- Table structure for table `df`
--

CREATE TABLE `df` (
  `id` int(11) NOT NULL,
  `cos_id` varchar(250) NOT NULL,
  `duties` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `df`
--

INSERT INTO `df` (`id`, `cos_id`, `duties`) VALUES
(1, '1', ' A.	Schedule of duty Monday-Friday at 8:00 am – 12:00 noon and 1:00 pm – 5:00 pm except on holidays.'),
(2, '1', 'B.	Assist in processing document related to procurement and other documents'),
(3, '1', 'C.	Assist in submitting GSIS Remittances/Submit updated GSIS records.'),
(4, '1', 'D.	Assist in submitting monthly report (CSC)'),
(5, '1', 'E.	Assist in all the activities related to Mayor’s or HR office undertakings.'),
(6, '2', 'A.	Receive/Release Incoming/Outgoing Communication'),
(7, '2', 'B.	Act as Liaison at HRM Office'),
(8, '2', 'C.	Maintain cleanliness at the Human Resource Management office'),
(9, '2', 'D.	To do run errands'),
(10, '2', 'E.	Assist in the computation of Leave Credits'),
(11, '2', 'F.	Do other Task Deemed Necessary as directed immediate supervisor or the LCE'),
(12, '3', 'A.	To interview clients and encode the information given in the application for registration of births, deaths and application for marriage license and type other related documents'),
(13, '3', 'B.	To interview clients for securing civil registry documents at Philippine Statistic Authority'),
(14, '3', 'C.	To prepare documents necessary for procurement of office supplies (liaison officer) and other vouchers'),
(15, '3', 'D.	Does other works assigned by the Municipal Civil Registrar'),
(16, '4', 'A.	To interview clients and encode the information given in the application for registration of births, deaths and application for marriage license and type other related documents.'),
(17, '4', 'B.	To interview clients for securing civil registry documents at Philippine Statistic Authority'),
(18, '4', 'C.	To prepare documents necessary for procurement of office supplies (liaison officer) and other vouchers'),
(19, '4', 'D.	Does other works assigned by the Municipal Civil Registrar');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `cos_name` text NOT NULL,
  `cos_address` text NOT NULL,
  `cos_position` text NOT NULL,
  `cos_salary` varchar(100) NOT NULL,
  `cos_office` text NOT NULL,
  `cos_from` varchar(100) NOT NULL,
  `cos_to` varchar(100) NOT NULL,
  `cos_charging` text NOT NULL,
  `cos_receive` varchar(100) NOT NULL,
  `sign1` varchar(50) NOT NULL,
  `sign2` varchar(50) NOT NULL,
  `signrank1` varchar(50) NOT NULL,
  `signrank2` varchar(50) NOT NULL,
  `cos_id` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `cos_name`, `cos_address`, `cos_position`, `cos_salary`, `cos_office`, `cos_from`, `cos_to`, `cos_charging`, `cos_receive`, `sign1`, `sign2`, `signrank1`, `signrank2`, `cos_id`) VALUES
(1, 'ARCHER JAY A. BACOLOD', 'POBLACION, SIBAGAT AGUSAN DEL SUR', 'DATA ENCODER', '12,000.00', 'HUMAN RESOURCE MANAGEMENT OFFICE', 'JANUARY 3', 'JUNE 30', 'HRD OTHER MOOE', 'JANUARY 2', 'DAN RALPH M. SUBLA', '', 'Municipal Administrator', '', 1),
(2, 'BERNIE S. BAYRON', 'Purok-12A Poblacion, Sibagat, Agusan del Sur', 'OFFICE AIDE', '8,000.00', 'HUMAN RESOURCE MANAGEMENT OFFICE', 'JANUARY 3', 'JUNE 30', 'HRD OTHER MOOE', 'JANUARY 2', 'DAN RALPH M. SUBLA', '', 'Municipal Administrator', '', 2),
(3, 'ARESA J. STA. ANA', 'Purok 2, El Rio Sibagat, Agusan del Sur', 'Clerk', '8,000.00', 'Municipal Civil Registrar', 'January 2', 'June 30', 'OTHER MOOE (MCR)', 'January 2', 'ELIZABETH M. BADAJOS', '', 'Municipal Civil Registrar', '', 3),
(4, 'ROWENA M. TUBAY', 'Purok 7, Poblacion Sibagat, Agusan del Sur', 'Clerk', '8,000.00', 'Municipal Civil Registrar', 'January 2', 'June 30', 'OTHER MOOE (MCR)', 'January 2', 'ELIZABETH M. BADAJOS', '', 'Municipal Civil Registrar', '', 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `df`
--
ALTER TABLE `df`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `df`
--
ALTER TABLE `df`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
