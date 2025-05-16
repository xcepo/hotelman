-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 21, 2024 at 08:35 AM
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
-- Database: `hotel`
--

-- --------------------------------------------------------

--
-- Table structure for table `brgy`
--

CREATE TABLE `brgy` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brgy`
--

INSERT INTO `brgy` (`id`, `name`) VALUES
(1, 'Barangay 1, Bacolod'),
(2, 'Barangay 2, Bacolod'),
(3, 'Barangay 3, Bacolod'),
(4, 'Barangay 4, Bacolod'),
(5, 'Barangay 5, Bacolod'),
(6, 'Barangay 6, Bacolod'),
(7, 'Barangay 7, Bacolod'),
(8, 'Barangay 8, Bacolod'),
(9, 'Barangay 9, Bacolod'),
(10, 'Barangay 10, Bacolod'),
(11, 'Barangay 11, Bacolod'),
(12, 'Barangay 12, Bacolod'),
(13, 'Barangay 13, Bacolod'),
(14, 'Barangay 14, Bacolod'),
(15, 'Barangay 15, Bacolod');

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`id`, `name`) VALUES
(1, 'Alaminos, Pangasinan'),
(2, 'Angeles City'),
(3, 'Antipolo'),
(4, 'Bacolod'),
(5, 'Bacoor'),
(6, 'Baguio'),
(7, 'Balanga, Bataan'),
(8, 'Baliwag'),
(9, 'Batac'),
(10, 'Batangas City'),
(11, 'Bayawan'),
(12, 'Baybay'),
(13, 'Bayugan'),
(14, 'Biñan'),
(15, 'Bislig'),
(16, 'Bogo, Cebu'),
(17, 'Borongan'),
(18, 'Butuan'),
(19, 'Cabadbaran'),
(20, 'Cabanatuan'),
(21, 'Cabuyao'),
(22, 'Calamba, Laguna'),
(23, 'Calapan'),
(24, 'Calbayog'),
(25, 'Caloocan'),
(26, 'Candon'),
(27, 'Canlaon'),
(28, 'Carcar'),
(29, 'Catbalogan'),
(30, 'Cauayan, Isabela'),
(31, 'Bago'),
(32, 'Bais'),
(33, 'Carmona'),
(34, 'Tacloban');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `name`) VALUES
(1, 'Front Desk'),
(2, 'Housekeeping'),
(3, 'Food and Beverage'),
(4, 'Sales and Marketing'),
(5, 'Finance'),
(6, 'Human Resources'),
(7, 'Engineering'),
(8, 'Security'),
(9, 'Guest Services'),
(10, 'Event Management');

-- --------------------------------------------------------

--
-- Table structure for table `gender`
--

CREATE TABLE `gender` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gender`
--

INSERT INTO `gender` (`id`, `name`) VALUES
(1, 'MALE'),
(2, 'FEMALE'),
(3, 'PREFER NOT TO SAY');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `usertype_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `username`, `password`, `usertype_id`) VALUES
(1, 'admin', 'admin', 1),
(2, 'front', 'front', 2),
(10, 'Charles', '123', 3);

-- --------------------------------------------------------

--
-- Table structure for table `method`
--

CREATE TABLE `method` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `method`
--

INSERT INTO `method` (`id`, `name`) VALUES
(1, 'Cash (Front Desk)'),
(2, 'Gcash'),
(3, 'Maya'),
(4, 'Bank Transfer');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int(11) NOT NULL,
  `reservation_id` int(11) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `method_id` int(11) DEFAULT NULL,
  `pstatuts_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `reservation_id`, `amount`, `method_id`, `pstatuts_id`) VALUES
(7, 12, 118000, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
  `id` int(11) NOT NULL,
  `lname` varchar(255) DEFAULT NULL,
  `fname` varchar(255) DEFAULT NULL,
  `mname` varchar(255) DEFAULT NULL,
  `bday` varchar(255) DEFAULT NULL,
  `contactnum` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `login_id` int(11) NOT NULL,
  `gender_id` int(11) DEFAULT NULL,
  `brgy_id` int(11) DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `region_id` int(11) DEFAULT NULL,
  `province_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`id`, `lname`, `fname`, `mname`, `bday`, `contactnum`, `email`, `login_id`, `gender_id`, `brgy_id`, `city_id`, `region_id`, `province_id`) VALUES
(2, 'Buqueto', 'Charles', 'B', '2024-01-02', '09865472555', 'anuj.lpu1@gmail.com', 10, 1, 14, 14, 15, 16);

-- --------------------------------------------------------

--
-- Table structure for table `province`
--

CREATE TABLE `province` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `province`
--

INSERT INTO `province` (`id`, `name`) VALUES
(1, 'Abra'),
(2, 'Agusan del Norte'),
(3, 'Agusan del Sur'),
(4, 'Aklan'),
(5, 'Albay'),
(6, 'Antique'),
(7, 'Apayao'),
(8, 'Aurora'),
(9, 'Basilan'),
(10, 'Bataan'),
(11, 'Batanes'),
(12, 'Batangas'),
(13, 'Benguet'),
(14, 'Biliran'),
(15, 'Bohol'),
(16, 'Bukidnon'),
(17, 'Bulacan'),
(18, 'Cagayan'),
(19, 'Camarines Norte'),
(20, 'Camarines Sur'),
(21, 'Camiguin'),
(22, 'Capiz'),
(23, 'Catanduanes'),
(24, 'Cavite'),
(25, 'Cebu'),
(26, 'Compostela Valley'),
(27, 'Cotabato'),
(28, 'Davao del Norte'),
(29, 'Davao del Sur'),
(30, 'Davao Occidental'),
(31, 'Davao Oriental'),
(32, 'Dinagat Islands'),
(33, 'Eastern Samar'),
(34, 'Guimaras'),
(35, 'Ifugao'),
(36, 'Ilocos Norte'),
(37, 'Ilocos Sur'),
(38, 'Iloilo'),
(39, 'Isabela'),
(40, 'Kalinga'),
(41, 'La Union'),
(42, 'Laguna'),
(43, 'Lanao del Norte'),
(44, 'Lanao del Sur'),
(45, 'Leyte'),
(46, 'Maguindanao'),
(47, 'Marinduque'),
(48, 'Masbate'),
(49, 'Misamis Occidental'),
(50, 'Misamis Oriental'),
(51, 'Mountain Province'),
(52, 'Negros Occidental'),
(53, 'Negros Oriental'),
(54, 'Northern Samar'),
(55, 'Nueva Ecija'),
(56, 'Nueva Vizcaya'),
(57, 'Occidental Mindoro'),
(58, 'Oriental Mindoro'),
(59, 'Palawan'),
(60, 'Pampanga'),
(61, 'Pangasinan'),
(62, 'Quezon'),
(63, 'Quirino'),
(64, 'Rizal'),
(65, 'Romblon'),
(66, 'Samar'),
(67, 'Sarangani'),
(68, 'Siquijor'),
(69, 'Sorsogon'),
(70, 'South Cotabato'),
(71, 'Southern Leyte'),
(72, 'Sultan Kudarat'),
(73, 'Sulu'),
(74, 'Surigao del Norte'),
(75, 'Surigao del Sur'),
(76, 'Tarlac'),
(77, 'Tawi-Tawi'),
(78, 'Zambales'),
(79, 'Zamboanga del Norte'),
(80, 'Zamboanga del Sur'),
(81, 'Zamboanga Sibugay');

-- --------------------------------------------------------

--
-- Table structure for table `pstatus`
--

CREATE TABLE `pstatus` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pstatus`
--

INSERT INTO `pstatus` (`id`, `name`) VALUES
(1, 'PAID'),
(2, 'UNPAID');

-- --------------------------------------------------------

--
-- Table structure for table `region`
--

CREATE TABLE `region` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `region`
--

INSERT INTO `region` (`id`, `name`) VALUES
(1, 'Region I – Ilocos Region'),
(2, 'Region II – Cagayan Valley'),
(3, 'Region III – Central Luzon'),
(4, 'Region IV‑A – CALABARZON'),
(5, 'MIMAROPA Region'),
(6, 'Region V – Bicol Region'),
(7, 'Region VI – Western Visayas'),
(8, 'Region VII – Central Visayas'),
(9, 'Region VIII – Eastern Visayas'),
(10, 'Region IX – Zamboanga Peninsula'),
(11, 'Region X – Northern Mindanao'),
(12, 'Region XI – Davao Region'),
(13, 'Region XII – SOCCSKSARGEN'),
(14, 'Region XIII – Caraga'),
(15, 'NCR – National Capital Region'),
(16, 'CAR – Cordillera Administrative Region'),
(17, 'BARMM – Bangsamoro Autonomous Region in Muslim Mindanao');

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `id` int(11) NOT NULL,
  `login_id` int(11) DEFAULT NULL,
  `rooms_id` int(11) DEFAULT NULL,
  `checkin_date` date DEFAULT NULL,
  `checkout_date` date DEFAULT NULL,
  `reservation` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`id`, `login_id`, `rooms_id`, `checkin_date`, `checkout_date`, `reservation`) VALUES
(12, 10, 4, '2024-01-22', '2024-01-31', '2024-01-21');

-- --------------------------------------------------------

--
-- Table structure for table `roomfeedback`
--

CREATE TABLE `roomfeedback` (
  `id` int(11) NOT NULL,
  `rooms_id` int(11) DEFAULT NULL,
  `stars_id` int(11) DEFAULT NULL,
  `contents` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roomfeedback`
--

INSERT INTO `roomfeedback` (`id`, `rooms_id`, `stars_id`, `contents`) VALUES
(1, 1, 3, 'fair'),
(2, 1, 1, 'bad, stinky'),
(3, 1, 5, 'very comfortable');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `room_number` varchar(255) DEFAULT NULL,
  `roomtype_id` int(11) DEFAULT NULL,
  `roomrate` int(11) DEFAULT NULL,
  `roomstatus_id` int(11) DEFAULT NULL,
  `image_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `room_number`, `roomtype_id`, `roomrate`, `roomstatus_id`, `image_path`) VALUES
(1, '101', 1, 5000, 1, 'uploads/single.jpeg'),
(2, '102', 2, 10000, 1, 'uploads/large_DDBDB.jpeg'),
(3, '103', 4, 9000, 1, 'uploads/f1.jpeg'),
(4, '104', 6, 13000, 2, 'uploads/1.jpeg'),
(5, '105', 7, 10000, 1, 'uploads/RR-King-Bedroom.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `roomstatus`
--

CREATE TABLE `roomstatus` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roomstatus`
--

INSERT INTO `roomstatus` (`id`, `name`) VALUES
(1, 'available'),
(2, 'unavailable');

-- --------------------------------------------------------

--
-- Table structure for table `roomtype`
--

CREATE TABLE `roomtype` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roomtype`
--

INSERT INTO `roomtype` (`id`, `name`) VALUES
(1, 'Single Room'),
(2, 'Double Room'),
(3, 'Twin Room'),
(4, 'Triple Room'),
(5, 'Quad Room'),
(6, 'Queen Room'),
(7, 'King Room'),
(8, 'Twin/Double Room'),
(9, 'Suite'),
(10, 'Studio'),
(11, 'Villa'),
(12, 'Bungalow'),
(13, 'Apartment'),
(14, 'Penthouse Suite');

-- --------------------------------------------------------

--
-- Table structure for table `rules`
--

CREATE TABLE `rules` (
  `id` int(11) NOT NULL,
  `content` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rules`
--

INSERT INTO `rules` (`id`, `content`) VALUES
(1, 'Check-in time is 3:00 PM. Check-out time is 12:00 PM.'),
(2, 'Please present a valid government-issued ID during check-in.'),
(3, 'Smoking is not allowed in the rooms or common areas. Smoking is only permitted in designated smoking areas.'),
(4, 'Pets are not allowed in the hotel premises.'),
(5, 'Keep noise levels to a minimum after 10:00 PM to ensure a quiet environment for all guests.'),
(6, 'Lost or damaged room keys will incur a replacement fee.'),
(7, 'Guests are responsible for any damages caused to hotel property during their stay.'),
(8, 'Ensure all valuables are secured. The hotel is not liable for any loss or damage.'),
(9, 'Complimentary Wi-Fi is available for guests. Please ask at the front desk for login details.'),
(10, 'For any assistance or inquiries, please contact the front desk staff.');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int(11) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `fname` varchar(255) DEFAULT NULL,
  `mname` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contactnum` int(11) NOT NULL,
  `department_id` int(11) DEFAULT NULL,
  `gender_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `lname`, `fname`, `mname`, `address`, `email`, `contactnum`, `department_id`, `gender_id`) VALUES
(2, 'Black', 'White', 'Gray', 'taga didto', 'katsuofx01@gmail.com', 2147483647, 8, 1),
(3, 'Buck', 'George', 'm', 'brgy 88 dhashda', 'anuj.lpu1@gmail.com', 2147483647, 8, 1);

-- --------------------------------------------------------

--
-- Table structure for table `stars`
--

CREATE TABLE `stars` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stars`
--

INSERT INTO `stars` (`id`, `name`) VALUES
(1, '1 Star'),
(2, '2 Stars'),
(3, '3 Stars'),
(4, '4 Stars'),
(5, '5 Stars');

-- --------------------------------------------------------

--
-- Table structure for table `usertype`
--

CREATE TABLE `usertype` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usertype`
--

INSERT INTO `usertype` (`id`, `name`) VALUES
(1, 'admin'),
(2, 'frontdesk'),
(3, 'member');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brgy`
--
ALTER TABLE `brgy`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gender`
--
ALTER TABLE `gender`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usertype_id` (`usertype_id`);

--
-- Indexes for table `method`
--
ALTER TABLE `method`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reservation_id` (`reservation_id`),
  ADD KEY `method_id` (`method_id`),
  ADD KEY `pstatuts_id` (`pstatuts_id`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gender_id` (`gender_id`),
  ADD KEY `brgy_id` (`brgy_id`),
  ADD KEY `city_id` (`city_id`),
  ADD KEY `region_id` (`region_id`),
  ADD KEY `province_id` (`province_id`),
  ADD KEY `login_id` (`login_id`);

--
-- Indexes for table `province`
--
ALTER TABLE `province`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pstatus`
--
ALTER TABLE `pstatus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `region`
--
ALTER TABLE `region`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `login_id` (`login_id`),
  ADD KEY `rooms_id` (`rooms_id`);

--
-- Indexes for table `roomfeedback`
--
ALTER TABLE `roomfeedback`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rooms_id` (`rooms_id`),
  ADD KEY `stars_id` (`stars_id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `roomtype_id` (`roomtype_id`),
  ADD KEY `roomstatus_id` (`roomstatus_id`);

--
-- Indexes for table `roomstatus`
--
ALTER TABLE `roomstatus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roomtype`
--
ALTER TABLE `roomtype`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rules`
--
ALTER TABLE `rules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`),
  ADD KEY `department_id` (`department_id`),
  ADD KEY `gender_id` (`gender_id`);

--
-- Indexes for table `stars`
--
ALTER TABLE `stars`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usertype`
--
ALTER TABLE `usertype`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brgy`
--
ALTER TABLE `brgy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `gender`
--
ALTER TABLE `gender`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `method`
--
ALTER TABLE `method`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `profile`
--
ALTER TABLE `profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `province`
--
ALTER TABLE `province`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `pstatus`
--
ALTER TABLE `pstatus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `region`
--
ALTER TABLE `region`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `roomfeedback`
--
ALTER TABLE `roomfeedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `roomstatus`
--
ALTER TABLE `roomstatus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `roomtype`
--
ALTER TABLE `roomtype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `rules`
--
ALTER TABLE `rules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `stars`
--
ALTER TABLE `stars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `usertype`
--
ALTER TABLE `usertype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `login`
--
ALTER TABLE `login`
  ADD CONSTRAINT `login_ibfk_1` FOREIGN KEY (`usertype_id`) REFERENCES `usertype` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`reservation_id`) REFERENCES `reservation` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `payment_ibfk_2` FOREIGN KEY (`method_id`) REFERENCES `method` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `payment_ibfk_3` FOREIGN KEY (`pstatuts_id`) REFERENCES `pstatus` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `profile`
--
ALTER TABLE `profile`
  ADD CONSTRAINT `profile_ibfk_1` FOREIGN KEY (`gender_id`) REFERENCES `gender` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `profile_ibfk_2` FOREIGN KEY (`brgy_id`) REFERENCES `brgy` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `profile_ibfk_3` FOREIGN KEY (`city_id`) REFERENCES `city` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `profile_ibfk_4` FOREIGN KEY (`region_id`) REFERENCES `region` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `profile_ibfk_5` FOREIGN KEY (`province_id`) REFERENCES `province` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `profile_ibfk_6` FOREIGN KEY (`login_id`) REFERENCES `login` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `reservation_ibfk_1` FOREIGN KEY (`login_id`) REFERENCES `login` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reservation_ibfk_2` FOREIGN KEY (`rooms_id`) REFERENCES `rooms` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `roomfeedback`
--
ALTER TABLE `roomfeedback`
  ADD CONSTRAINT `roomfeedback_ibfk_1` FOREIGN KEY (`rooms_id`) REFERENCES `rooms` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `roomfeedback_ibfk_2` FOREIGN KEY (`stars_id`) REFERENCES `stars` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rooms`
--
ALTER TABLE `rooms`
  ADD CONSTRAINT `rooms_ibfk_1` FOREIGN KEY (`roomtype_id`) REFERENCES `roomtype` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rooms_ibfk_2` FOREIGN KEY (`roomstatus_id`) REFERENCES `roomstatus` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `staff`
--
ALTER TABLE `staff`
  ADD CONSTRAINT `staff_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `department` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `staff_ibfk_2` FOREIGN KEY (`gender_id`) REFERENCES `gender` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
