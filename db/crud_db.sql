-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 11, 2026 at 10:40 AM
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
-- Database: `crud_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_logs`
--

CREATE TABLE `admin_logs` (
  `log_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `action` varchar(100) NOT NULL,
  `booking_id` int(11) DEFAULT NULL,
  `details` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_logs`
--

INSERT INTO `admin_logs` (`log_id`, `admin_id`, `action`, `booking_id`, `details`, `created_at`) VALUES
(1, 2, 'confirm_booking', 2, 'Booking confirmed with payment method: cash', '2026-05-09 04:41:55');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `booking_id` int(11) NOT NULL,
  `booking_reference` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `cottage_id` int(11) NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `customer_email` varchar(100) NOT NULL,
  `customer_phone` varchar(20) NOT NULL,
  `booking_date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `total_days` int(11) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `status` enum('pending','confirmed','cancelled','completed') DEFAULT 'pending',
  `payment_status` enum('unpaid','paid','refunded') DEFAULT 'unpaid',
  `special_requests` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `approved_by` int(11) DEFAULT NULL,
  `approved_at` datetime DEFAULT NULL,
  `admin_notes` text DEFAULT NULL,
  `payment_method` enum('cash','gcash','bank_transfer') DEFAULT 'cash',
  `payment_reference` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`booking_id`, `booking_reference`, `user_id`, `cottage_id`, `customer_name`, `customer_email`, `customer_phone`, `booking_date`, `start_time`, `end_time`, `total_days`, `total_amount`, `status`, `payment_status`, `special_requests`, `created_at`, `approved_by`, `approved_at`, `admin_notes`, `payment_method`, `payment_reference`) VALUES
(1, 'RES202605083808', 1, 1, 'loveee', 'love@gmail.com', '091966100271', '2026-05-10', '10:37:00', '22:37:00', 12, 6000.00, 'pending', 'unpaid', '', '2026-05-08 14:37:50', NULL, NULL, NULL, 'cash', NULL),
(2, 'RES202605093821', 1, 13, 'loveee', 'love@gmail.com', '091966100271', '2026-05-11', '09:00:00', '18:00:00', 2, 5000.00, 'confirmed', 'unpaid', '', '2026-05-09 04:24:34', 2, '2026-05-09 04:41:55', '', 'cash', ''),
(3, 'RES202605098499', 2, 13, 'Winnie Resort Manager', 'admin@winniesresort.com', '09123456789', '2026-05-21', '09:00:00', '18:00:00', 2, 5000.00, 'pending', 'unpaid', '', '2026-05-09 09:10:20', NULL, NULL, NULL, 'cash', NULL),
(4, 'RES202605106492', 3, 1, 'loveee', 'loveee@gmail.com', '12345678901', '2026-05-11', '09:00:00', '18:00:00', 2, 6000.00, 'pending', 'unpaid', '', '2026-05-10 13:16:15', NULL, NULL, NULL, 'cash', NULL),
(5, 'RES202605119771', 1, 4, 'loveee', 'love@gmail.com', '091966100271', '2026-05-12', '09:00:00', '18:00:00', 1, 15000.00, 'pending', 'unpaid', '', '2026-05-11 07:04:23', NULL, NULL, NULL, 'cash', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cottages`
--

CREATE TABLE `cottages` (
  `cottage_id` int(11) NOT NULL,
  `cottage_name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `price_per_day` decimal(10,2) NOT NULL,
  `capacity` int(11) DEFAULT 2,
  `image` varchar(255) DEFAULT NULL,
  `status` enum('available','maintenance') DEFAULT 'available',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cottages`
--

INSERT INTO `cottages` (`cottage_id`, `cottage_name`, `description`, `price_per_day`, `capacity`, `image`, `status`, `created_at`) VALUES
(1, '🌊 Beach Front Kubo', 'Traditional nipa hut with stunning ocean view. Perfect for couples and small families. Includes electric fan and comfortable seating.', 3000.00, 4, NULL, 'available', '2026-05-08 10:18:58'),
(2, '🏠 Family Villa', 'Spacious villa perfect for family gatherings. Features air conditioning, private bathroom, kitchenette, and private pool access.', 8000.00, 10, NULL, 'available', '2026-05-08 10:18:58'),
(3, '💑 Couple\'s Paradise', 'Cozy romantic hut with beach front view. Includes king size bed, air conditioning, and private veranda.', 5000.00, 2, NULL, 'available', '2026-05-08 10:18:58'),
(4, '🎉 Function Hall', 'Airconditioned grand hall perfect for events, parties, and weddings. Capacity up to 30 people. Includes sound system.', 15000.00, 30, NULL, 'available', '2026-05-08 10:18:58'),
(5, '⭐ Deluxe Suite', 'Modern luxury suite with AC, 50\" TV, mini bar, private bathroom with hot shower, and ocean view balcony.', 7000.00, 2, NULL, 'available', '2026-05-08 10:18:58'),
(6, '🏖️ Premium Beach House', 'Luxury beach house with direct beach access. Features 2 bedrooms, living room, kitchen, and private garden.', 12000.00, 6, NULL, 'available', '2026-05-08 10:18:58'),
(7, '🌊 Beach Front Kubo', 'Traditional nipa hut with stunning ocean view. Perfect for couples and small families. Includes electric fan and comfortable seating.', 3000.00, 4, NULL, 'available', '2026-05-08 10:19:12'),
(8, '🏠 Family Villa', 'Spacious villa perfect for family gatherings. Features air conditioning, private bathroom, kitchenette, and private pool access.', 8000.00, 10, NULL, 'available', '2026-05-08 10:19:12'),
(9, '💑 Couple\'s Paradise', 'Cozy romantic hut with beach front view. Includes king size bed, air conditioning, and private veranda.', 5000.00, 2, NULL, 'available', '2026-05-08 10:19:12'),
(10, '🎉 Function Hall', 'Airconditioned grand hall perfect for events, parties, and weddings. Capacity up to 30 people. Includes sound system.', 15000.00, 30, NULL, 'available', '2026-05-08 10:19:12'),
(11, '⭐ Deluxe Suite', 'Modern luxury suite with AC, 50\" TV, mini bar, private bathroom with hot shower, and ocean view balcony.', 7000.00, 2, NULL, 'available', '2026-05-08 10:19:12'),
(12, '🏖️ Premium Beach House', 'Luxury beach house with direct beach access. Features 2 bedrooms, living room, kitchen, and private garden.', 12000.00, 6, NULL, 'available', '2026-05-08 10:19:12'),
(13, 'Standard Room', 'Basic room with fan and private bathroom', 2500.00, 2, NULL, 'available', '2026-05-09 04:18:50'),
(14, 'Superior Room', 'Spacious room with AC and hot shower', 4500.00, 4, NULL, 'available', '2026-05-09 04:18:50');

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE `login_attempts` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `attempt_time` datetime NOT NULL,
  `user_agent` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login_attempts`
--

INSERT INTO `login_attempts` (`id`, `email`, `ip_address`, `attempt_time`, `user_agent`) VALUES
(36, 'glennazuelo1@gmail.com', '::142432432', '2025-04-15 13:15:00', ''),
(0, 'glennazuelo1@gmail.com', '::1', '2026-05-08 08:59:30', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36 Edg/148.0.0.0');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_logs`
--

CREATE TABLE `tbl_logs` (
  `LOGID` int(11) NOT NULL,
  `USERID` varchar(30) DEFAULT NULL,
  `ACTION` text DEFAULT NULL,
  `DATELOG` varchar(30) DEFAULT NULL,
  `TIMELOG` varchar(30) DEFAULT NULL,
  `user_ip_address` text DEFAULT NULL,
  `device_used` text DEFAULT NULL,
  `USER_NAME` varchar(100) DEFAULT NULL,
  `identifier` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_logs`
--

INSERT INTO `tbl_logs` (`LOGID`, `USERID`, `ACTION`, `DATELOG`, `TIMELOG`, `user_ip_address`, `device_used`, `USER_NAME`, `identifier`) VALUES
(1, '1', 'New User has been apdated: Glenn Azuelo', '2025-07-21', '20:11:13', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36', NULL, 'UPDATED'),
(2, '1', 'Logout', '2025-07-21', '20:12:03', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36', NULL, 'LOGOUT'),
(3, '1', 'Login: Glenn Azuelo', '2025-07-21', '20:12:16', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36', NULL, 'LOGIN'),
(4, '1', 'Logout', '2025-07-21', '20:14:42', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36', NULL, 'LOGOUT'),
(5, '10', 'Login: Cherry Ann Grandia', '2025-07-21', '20:14:47', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36', NULL, 'LOGIN'),
(6, '10', 'New User has been apdated: Glenn Azuelo', '2025-07-21', '20:18:03', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36', '10', 'UPDATED'),
(7, '10', 'New User has been apdated: Cherry Ann Grandia', '2025-07-21', '20:19:17', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36', NULL, 'UPDATED'),
(8, '10', 'Logout', '2025-07-21', '20:19:18', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36', NULL, 'LOGOUT'),
(9, '1', 'Login: Glenn Azuelo', '2025-07-21', '20:19:23', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36', 'Glenn Azuelo', 'LOGIN'),
(10, '1', 'Logout', '2025-07-21', '20:19:56', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36', 'Glenn Azuelo', 'LOGOUT'),
(11, '1', 'Login: Glenn Azuelo', '2025-07-21', '20:21:27', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36', 'Glenn Azuelo', 'LOGIN'),
(12, '1', 'New User has been added: xxx', '2025-07-21', '20:32:39', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36', 'Glenn Azuelo', 'ADD'),
(13, '1', 'Delete user', '2025-07-21', '20:32:44', '::1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/133.0.0.0 Safari/537.36', 'Glenn Azuelo', 'DELETED');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `role` enum('admin','customer') DEFAULT 'customer',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `email`, `full_name`, `phone`, `role`, `created_at`) VALUES
(1, 'love', '25f9e794323b453885f5181f1b624d0b', 'love@gmail.com', 'loveee', '091966100271', 'customer', '2026-05-08 14:37:11'),
(2, 'admin', '0192023a7bbd73250516f069df18b500', 'admin@winniesresort.com', 'Winnie Resort Manager', '09123456789', 'admin', '2026-05-09 04:35:31'),
(3, 'loveee', '25f9e794323b453885f5181f1b624d0b', 'loveee@gmail.com', 'loveee', '12345678901', 'customer', '2026-05-10 13:05:49');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_logs`
--
ALTER TABLE `admin_logs`
  ADD PRIMARY KEY (`log_id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`booking_id`),
  ADD UNIQUE KEY `booking_reference` (`booking_reference`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `cottage_id` (`cottage_id`);

--
-- Indexes for table `cottages`
--
ALTER TABLE `cottages`
  ADD PRIMARY KEY (`cottage_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_logs`
--
ALTER TABLE `admin_logs`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `cottages`
--
ALTER TABLE `cottages`
  MODIFY `cottage_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin_logs`
--
ALTER TABLE `admin_logs`
  ADD CONSTRAINT `admin_logs_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`cottage_id`) REFERENCES `cottages` (`cottage_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
