-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 30, 2024 at 02:08 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dmsdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `DoctorID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `Firstname` varchar(255) DEFAULT NULL,
  `Lastname` varchar(255) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `ContactDetails` varchar(255) DEFAULT NULL,
  `Specialization` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`DoctorID`, `UserID`, `Firstname`, `Lastname`, `Address`, `ContactDetails`, `Specialization`) VALUES
(1, 5, 'Gayan', 'Muthukumara', 'Kurunegala', '0713442101', 'Eye'),
(4, 13, 'Amal', 'Nuwan', 'Kandy', '0713442101', 'Heart');

-- --------------------------------------------------------

--
-- Table structure for table `fileup`
--

CREATE TABLE `fileup` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fileup`
--

INSERT INTO `fileup` (`id`, `title`, `image`) VALUES
(7, 'test', '7547-report.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `labadmins`
--

CREATE TABLE `labadmins` (
  `LabAdminID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `Firstname` varchar(255) DEFAULT NULL,
  `Lastname` varchar(255) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `ContactDetails` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `labadmins`
--

INSERT INTO `labadmins` (`LabAdminID`, `UserID`, `Firstname`, `Lastname`, `Address`, `ContactDetails`) VALUES
(1, 6, 'Nimmi', 'Muthukumarana', '223 Rubble Lane', '0412345678');

-- --------------------------------------------------------

--
-- Table structure for table `medicalreports`
--

CREATE TABLE `medicalreports` (
  `ReportID` int(11) NOT NULL,
  `PatientID` int(11) DEFAULT NULL,
  `LabAdminID` int(11) DEFAULT NULL,
  `ReportTitle` varchar(255) DEFAULT NULL,
  `File` varchar(255) NOT NULL,
  `Date` date DEFAULT NULL,
  `UploadBy` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `medicalreports`
--

INSERT INTO `medicalreports` (`ReportID`, `PatientID`, `LabAdminID`, `ReportTitle`, `File`, `Date`, `UploadBy`) VALUES
(9, 1, 1, 'blood report', '7783-Medical-Report-Form-PDF.pdf', '2024-04-02', 'Lab Admin'),
(10, 4, NULL, 'blood report', '5735-SIT707-8.1P.pdf', '2024-05-01', 'Patient');

-- --------------------------------------------------------

--
-- Table structure for table `patientrecords`
--

CREATE TABLE `patientrecords` (
  `PatientRecordID` int(11) NOT NULL,
  `PatientID` int(11) DEFAULT NULL,
  `DoctorID` int(11) DEFAULT NULL,
  `Date` date DEFAULT NULL,
  `Diagnosis` varchar(255) DEFAULT NULL,
  `Comments` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patientrecords`
--

INSERT INTO `patientrecords` (`PatientRecordID`, `PatientID`, `DoctorID`, `Date`, `Diagnosis`, `Comments`) VALUES
(1, 4, 1, '2024-04-02', 'Hi doctor . I have a problem on my eye.', NULL),
(2, 4, 4, '2024-04-02', 'TEST', NULL),
(3, 4, 1, '2024-04-02', 'test', 'You can meet me'),
(4, 4, 4, '2024-04-02', 'test', NULL),
(5, 4, 4, '2024-04-02', 'test', NULL),
(6, 1, 1, '2024-04-02', 'hi doctor', 'you can go to near hospital'),
(7, 4, 4, '2024-05-01', 'test message', 'test comment');

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `PatientID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `Firstname` varchar(255) DEFAULT NULL,
  `Lastname` varchar(255) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `ContactDetails` varchar(255) DEFAULT NULL,
  `NotificationPreferences` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`PatientID`, `UserID`, `Firstname`, `Lastname`, `Address`, `ContactDetails`, `NotificationPreferences`) VALUES
(1, 8, 'Anil', 'Perera', 'Kandy', '0712442103', 'SMS'),
(4, 15, 'Sunil', 'Perera', 'Kandy', '0712441569', 'Email');

-- --------------------------------------------------------

--
-- Table structure for table `pharmacists`
--

CREATE TABLE `pharmacists` (
  `PharmacistID` int(11) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `Firstname` varchar(255) DEFAULT NULL,
  `Lastname` varchar(255) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `ContactDetails` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pharmacists`
--

INSERT INTO `pharmacists` (`PharmacistID`, `UserID`, `Firstname`, `Lastname`, `Address`, `ContactDetails`) VALUES
(1, 14, 'Nuwan', 'Gayan', 'test', '0779469179'),
(2, 16, 'Nimal', 'Santha', 'Kandyy', '0713442156');

-- --------------------------------------------------------

--
-- Table structure for table `userprivileges`
--

CREATE TABLE `userprivileges` (
  `UserID` int(11) DEFAULT NULL,
  `Privilege` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userprivileges`
--

INSERT INTO `userprivileges` (`UserID`, `Privilege`) VALUES
(5, 'doctor'),
(6, 'labadmin'),
(7, 'systemadmin'),
(8, 'patient'),
(9, 'patient'),
(10, 'patient'),
(11, 'doctor'),
(12, 'doctor'),
(13, 'doctor'),
(14, 'pharmacist'),
(15, 'patient'),
(16, 'pharmacist');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `Username`, `Email`, `Password`) VALUES
(5, 'Gayan', 'gayan@gmail.com', 'Gayan@#$123'),
(6, 'Nimmi', 'nimmi@gmail.com', 'Nimmi@#$123'),
(7, 'Admin', 'admin@gmail.com', 'Admin@#$123'),
(8, 'Saman', 'saman@gmail.com', 'Saman@#$123'),
(9, 'Niluka', 'niluka@gmail.com', 'Niluka@#$123'),
(10, 'erterterte', 'sirdon@gmail.com', 'Gayan@#$123'),
(11, 'Gayan1', 'gayan1@gmail.com', 'Gayan@#$123'),
(12, 'wewegwreg', 'rgerger@gmail.com', 'Abc#$%123'),
(13, 'Gihan', 'gihan@gmail.com', 'Gihan@#$123'),
(14, 'Test', 'testp@gmail.com', 'Test@#$123'),
(15, 'SunilP', 'anil@gmail.com', 'Anil@#$123'),
(16, 'NimalS', 'nimal@gmail.com', 'Nimal@#$123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`DoctorID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `fileup`
--
ALTER TABLE `fileup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `labadmins`
--
ALTER TABLE `labadmins`
  ADD PRIMARY KEY (`LabAdminID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `medicalreports`
--
ALTER TABLE `medicalreports`
  ADD PRIMARY KEY (`ReportID`),
  ADD KEY `LabAdminID` (`LabAdminID`),
  ADD KEY `medicalreports_ibfk_1` (`PatientID`);

--
-- Indexes for table `patientrecords`
--
ALTER TABLE `patientrecords`
  ADD PRIMARY KEY (`PatientRecordID`),
  ADD KEY `PatientID` (`PatientID`),
  ADD KEY `DoctorID` (`DoctorID`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`PatientID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `pharmacists`
--
ALTER TABLE `pharmacists`
  ADD PRIMARY KEY (`PharmacistID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `userprivileges`
--
ALTER TABLE `userprivileges`
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `DoctorID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `fileup`
--
ALTER TABLE `fileup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `labadmins`
--
ALTER TABLE `labadmins`
  MODIFY `LabAdminID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `medicalreports`
--
ALTER TABLE `medicalreports`
  MODIFY `ReportID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `patientrecords`
--
ALTER TABLE `patientrecords`
  MODIFY `PatientRecordID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `PatientID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pharmacists`
--
ALTER TABLE `pharmacists`
  MODIFY `PharmacistID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `doctors`
--
ALTER TABLE `doctors`
  ADD CONSTRAINT `doctors_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`);

--
-- Constraints for table `labadmins`
--
ALTER TABLE `labadmins`
  ADD CONSTRAINT `labadmins_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`);

--
-- Constraints for table `medicalreports`
--
ALTER TABLE `medicalreports`
  ADD CONSTRAINT `medicalreports_ibfk_1` FOREIGN KEY (`PatientID`) REFERENCES `patients` (`PatientID`),
  ADD CONSTRAINT `medicalreports_ibfk_2` FOREIGN KEY (`LabAdminID`) REFERENCES `labadmins` (`LabAdminID`);

--
-- Constraints for table `patientrecords`
--
ALTER TABLE `patientrecords`
  ADD CONSTRAINT `patientrecords_ibfk_1` FOREIGN KEY (`PatientID`) REFERENCES `patients` (`PatientID`),
  ADD CONSTRAINT `patientrecords_ibfk_2` FOREIGN KEY (`DoctorID`) REFERENCES `doctors` (`DoctorID`);

--
-- Constraints for table `patients`
--
ALTER TABLE `patients`
  ADD CONSTRAINT `patients_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`);

--
-- Constraints for table `pharmacists`
--
ALTER TABLE `pharmacists`
  ADD CONSTRAINT `pharmacists_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`);

--
-- Constraints for table `userprivileges`
--
ALTER TABLE `userprivileges`
  ADD CONSTRAINT `userprivileges_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
