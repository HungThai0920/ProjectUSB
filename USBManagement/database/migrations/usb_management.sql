-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 25, 2024 at 11:55 AM
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
-- Database: `usb_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `usb_borrowing`
--

CREATE TABLE `usb_borrowing` (
  `borrowing_id` int(11) NOT NULL,
  `usb_id` int(11) DEFAULT NULL,
  `card_number` int(11) DEFAULT NULL,
  `purpose` enum('upload','download','transfer') DEFAULT NULL,
  `file_name` varchar(255) DEFAULT NULL,
  `web_link` varchar(255) DEFAULT NULL,
  `borrow_time` datetime DEFAULT current_timestamp(),
  `return_time` datetime DEFAULT NULL,
  `borrowing_status` enum('pending','approved','returned') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `usb_borrowing`
--

INSERT INTO `usb_borrowing` (`borrowing_id`, `usb_id`, `card_number`, `purpose`, `file_name`, `web_link`, `borrow_time`, `return_time`, `borrowing_status`) VALUES
(1, 1, 41, 'upload', 'test.xlsx', 'sdasdsa.com', '2024-07-17 07:30:13', NULL, 'approved'),
(2, 1, 41, 'upload', 'test.xlsx', 'sdasdsa.com', '2024-07-17 08:22:07', NULL, 'approved'),
(3, 1, 41, 'upload', 'test.xlsx', 'sdasdsa.com', '2024-07-17 08:40:04', NULL, 'approved'),
(4, 1, 41, 'upload', 'test.xlsx', 'sdasdsa.com', '2024-07-17 08:43:51', NULL, 'approved'),
(10, 10, 41, 'upload', '123.txt', 'abz.com', '2024-08-14 23:55:16', NULL, 'approved'),
(11, 20, 42, 'upload', 'qwe.txt', 'abzd.com', '2024-08-14 23:56:16', NULL, 'approved'),
(12, 19, 42, 'upload', '123.txt', 'abzd.com', '2024-08-15 00:07:28', NULL, 'approved'),
(13, 29, 41, 'download', '123.txt', 'abz.com', '2024-08-15 00:12:54', NULL, 'approved');

-- --------------------------------------------------------

--
-- Table structure for table `usb_devices`
--

CREATE TABLE `usb_devices` (
  `usb_id` int(11) NOT NULL,
  `usb_name` varchar(100) DEFAULT NULL,
  `usb_status` enum('ready','borrowed') DEFAULT NULL,
  `card_number` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `usb_devices`
--

INSERT INTO `usb_devices` (`usb_id`, `usb_name`, `usb_status`, `card_number`) VALUES
(1, NULL, NULL, 41),
(10, 'USB02', 'borrowed', NULL),
(19, '2222', 'borrowed', NULL),
(20, '222255555', 'borrowed', NULL),
(27, 'geg4rgr', 'borrowed', NULL),
(28, '56565665656565656565', 'borrowed', NULL),
(29, 'USB03', 'borrowed', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `card_number` int(11) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `department` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `access_level` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`card_number`, `user_name`, `password`, `department`, `email`, `access_level`) VALUES
(41, 'Nguyễn Văn Hiển', '123456', 'IT', 'HIEN.NGUYEN@FENGTAY.COM', 1),
(42, 'A', '123456', 'it', 'it@fengtay.com', 1),
(43, 'B', '123456', 'IT', 'B@NH.com', 1),
(44, 'test11', '123456', 'GA', 'test3@NH.com', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `usb_borrowing`
--
ALTER TABLE `usb_borrowing`
  ADD PRIMARY KEY (`borrowing_id`),
  ADD KEY `usb_id` (`usb_id`),
  ADD KEY `user_id` (`card_number`);

--
-- Indexes for table `usb_devices`
--
ALTER TABLE `usb_devices`
  ADD PRIMARY KEY (`usb_id`),
  ADD KEY `user_id` (`card_number`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`card_number`),
  ADD UNIQUE KEY `username` (`user_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `usb_borrowing`
--
ALTER TABLE `usb_borrowing`
  MODIFY `borrowing_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `usb_devices`
--
ALTER TABLE `usb_devices`
  MODIFY `usb_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `card_number` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `usb_borrowing`
--
ALTER TABLE `usb_borrowing`
  ADD CONSTRAINT `usb_borrowing_ibfk_1` FOREIGN KEY (`usb_id`) REFERENCES `usb_devices` (`usb_id`),
  ADD CONSTRAINT `usb_borrowing_ibfk_2` FOREIGN KEY (`card_number`) REFERENCES `users` (`card_number`);

--
-- Constraints for table `usb_devices`
--
ALTER TABLE `usb_devices`
  ADD CONSTRAINT `usb_devices_ibfk_1` FOREIGN KEY (`card_number`) REFERENCES `users` (`card_number`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
