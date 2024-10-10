-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 29, 2024 at 08:22 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `user_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `position` varchar(250) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `position`, `password`, `created_at`) VALUES
(4, 'Admin1', 'IT Admin', '$2y$10$fhik/fgbx7DbN/tXHn/Oo.EIEfH1Iy7gQDQiCl4/Hg2GPgccVV/yO', '2024-09-19 06:17:38');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `sign_in_time` datetime DEFAULT NULL,
  `sign_out_time` datetime DEFAULT NULL,
  `total_working_hours` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `user_id`, `sign_in_time`, `sign_out_time`, `total_working_hours`) VALUES
(19, 3, '2024-09-25 09:18:40', '2024-09-25 09:19:45', '00:01:05'),
(24, 4, '2024-09-25 10:03:37', NULL, NULL),
(25, 3, '2024-09-25 12:18:27', '2024-09-25 17:39:44', '05:21:17');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `name`, `created_at`) VALUES
(1, 'test client', '2024-09-23 05:31:56'),
(2, 'test client 2', '2024-09-23 05:36:30'),
(3, 'test client 3', '2024-09-23 05:36:30'),
(4, 'test 4', '2024-09-23 08:01:27'),
(5, 'test5', '2024-09-23 08:18:19');

-- --------------------------------------------------------

--
-- Table structure for table `clients_calenders`
--

CREATE TABLE `clients_calenders` (
  `id` int(11) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `event_date` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clients_calenders`
--

INSERT INTO `clients_calenders` (`id`, `client_id`, `title`, `description`, `event_date`, `created_at`) VALUES
(1, 1, 'abc', 'abcdef', '2024-09-25', '2024-09-23 06:13:16'),
(2, 2, 'abc', 'abcfre', '2024-09-26', '2024-09-23 06:14:10'),
(3, 3, 'abc', 'abculyuio', '2024-09-27', '2024-09-23 06:14:20'),
(4, 1, 'social media posters', 'SMP - IN,FB,TW', '2024-09-27', '2024-09-23 06:19:41'),
(5, 1, 'adgfrad', 'adbfdrg', '2024-09-30', '2024-09-23 06:26:21'),
(6, 1, 'oct2', 'sm-in.tw,fb', '2024-10-02', '2024-09-24 03:33:59');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `employee_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `position` varchar(100) DEFAULT NULL,
  `department` varchar(100) DEFAULT NULL,
  `salary` decimal(10,2) DEFAULT NULL,
  `hire_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`employee_id`, `user_id`, `position`, `department`, `salary`, `hire_date`) VALUES
(1, 1, 'Test POST', 'Test EPost', 200.00, '2024-09-04'),
(2, 2, 'Test Epost', 'TestPOST', 250.00, '2024-09-03'),
(3, 3, 'Software Engineer', 'IT', 30000.00, '2024-08-14'),
(4, 4, 'Content Writer', 'IT', 35000.00, '2024-06-01');

-- --------------------------------------------------------

--
-- Table structure for table `employee_reports`
--

CREATE TABLE `employee_reports` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `report_date` date DEFAULT NULL,
  `work_description` text DEFAULT NULL,
  `submission_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee_reports`
--

INSERT INTO `employee_reports` (`id`, `user_id`, `report_date`, `work_description`, `submission_time`) VALUES
(3, 3, '2024-09-23', 'test\r\ntest\r\ntest\r\ntest\r\ntest', '2024-09-23 05:13:54'),
(4, 3, '2024-09-23', 'test', '2024-09-23 08:15:05');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `event_date` date NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `event_date`, `title`, `description`) VALUES
(4, '2024-09-21', 'Work From Home', 'Today to one week complete wrok from home due to workspace maintance.'),
(5, '2024-09-30', 'test', 'month end');

-- --------------------------------------------------------

--
-- Table structure for table `leads`
--

CREATE TABLE `leads` (
  `id` int(11) NOT NULL,
  `quote_id` varchar(255) NOT NULL,
  `client_name` varchar(255) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `message` text DEFAULT NULL,
  `next_followup` date DEFAULT NULL,
  `status` enum('Interested','Exited','Break','Success') NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `leads`
--

INSERT INTO `leads` (`id`, `quote_id`, `client_name`, `phone`, `message`, `next_followup`, `status`, `updated_at`) VALUES
(1, 't1', 't1', '12345678', 'test1', '2024-09-28', 'Exited', '2024-09-23 08:14:01'),
(2, 't2', 't2', '87654321', 'test2', '2024-09-25', 'Exited', '2024-09-17 10:11:13'),
(3, 't3', 't3', '756', 't3', '2024-09-21', 'Interested', '2024-09-18 03:55:35'),
(4, 't4', 't4', '45', 't4', '2024-09-30', 'Exited', '2024-09-19 03:55:35'),
(5, 't5', 't5', '54', 't5', '2024-09-21', 'Interested', '2024-09-18 03:59:36'),
(6, 't6', 't6', '67', 't6', '2024-09-28', 'Success', '2024-09-20 05:02:39'),
(7, 't7', 't7', '67', 't7', '2024-09-29', 'Exited', '2024-09-18 04:00:24'),
(8, 't8', 't8', '789', 't8', '2024-09-30', 'Interested', '2024-09-18 04:00:24'),
(9, 't9', 't9', '08', 't9', '2024-09-18', 'Interested', '2024-09-18 04:02:11'),
(10, 't10', 't10', '345', 't10', '2024-10-17', 'Success', '2024-09-20 05:02:47'),
(11, 't11', 't11', '234534', 't11', '2024-09-28', 'Interested', '2024-09-25 08:07:32'),
(12, 't12', 't12', '1233245', 'test12', '2024-10-11', 'Interested', '2024-09-21 02:03:14'),
(13, 't13', 't13', '56543746567', 'test', '2024-09-28', 'Interested', '2024-09-23 04:47:00');

-- --------------------------------------------------------

--
-- Table structure for table `leave_requests`
--

CREATE TABLE `leave_requests` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `leave_type` varchar(50) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `reason` text DEFAULT NULL,
  `status` enum('pending','approved','rejected') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `leave_requests`
--

INSERT INTO `leave_requests` (`id`, `user_id`, `leave_type`, `start_date`, `end_date`, `reason`, `status`, `created_at`) VALUES
(5, 3, 'casual', '2024-09-26', '2024-09-27', 'test', 'approved', '2024-09-21 05:17:41'),
(6, 3, 'casual', '2024-09-28', '2024-09-29', 'test', 'rejected', '2024-09-23 08:14:28'),
(7, 3, 'casual', '2024-09-27', '2024-09-30', 'Solo Trip', 'approved', '2024-09-24 03:47:47');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_read` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `message`, `created_at`, `is_read`) VALUES
(10, 3, 'Your leave request has been approved.', '2024-09-24 04:45:44', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `task_name` varchar(255) DEFAULT NULL,
  `started_date` date DEFAULT NULL,
  `completed_date` date DEFAULT NULL,
  `status` enum('Pending','Completed','Cancelled') DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `user_id`, `task_name`, `started_date`, `completed_date`, `status`) VALUES
(7, 1, 'test1', '2024-09-23', '0000-00-00', 'Pending'),
(8, 2, 'test1', '2024-09-23', '0000-00-00', 'Pending'),
(9, 4, 'test1', '2024-09-23', '0000-00-00', 'Pending'),
(10, 3, 'test1', '2024-09-23', '2024-09-25', 'Completed');

-- --------------------------------------------------------

--
-- Table structure for table `todolist`
--

CREATE TABLE `todolist` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `task_name` varchar(255) NOT NULL,
  `is_completed` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `phone`) VALUES
(1, 'user1', '$2y$10$WXjR8gyZaJqeqfAEzBE7Luid4P0lvcdKuNJa7rCR9ctaPpLILLcBm', 'user1@gmail.com', ''),
(2, 'user2', '$2y$10$aHz3HYIHhW9bSwZiQ1cKT.dYFu6hdiLpGG8iE6UjY.L6OmPh1kYYS', 'user2@gmail.com', ''),
(3, 'Alan Shaju', '$2y$10$hZGUHt5DhEUtZ/Uwn.s7A.UMVv3A0akTqpGxjrZqSH3GneIYk6W2C', 'alanshaju26@gmail.com', '7593968558'),
(4, 'Akshay Joyal', '$2y$10$jofxaFEf/miFft0jixGiyeJhshZnX3/fOGm6Wfoz5TiUMVCxja7ku', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients_calenders`
--
ALTER TABLE `clients_calenders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_id` (`client_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`employee_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `employee_reports`
--
ALTER TABLE `employee_reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leads`
--
ALTER TABLE `leads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leave_requests`
--
ALTER TABLE `leave_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `todolist`
--
ALTER TABLE `todolist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `clients_calenders`
--
ALTER TABLE `clients_calenders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `employee_reports`
--
ALTER TABLE `employee_reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `leads`
--
ALTER TABLE `leads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `leave_requests`
--
ALTER TABLE `leave_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `todolist`
--
ALTER TABLE `todolist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `clients_calenders`
--
ALTER TABLE `clients_calenders`
  ADD CONSTRAINT `clients_calenders_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`);

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `employee_reports`
--
ALTER TABLE `employee_reports`
  ADD CONSTRAINT `employee_reports_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `leave_requests`
--
ALTER TABLE `leave_requests`
  ADD CONSTRAINT `leave_requests_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `todolist`
--
ALTER TABLE `todolist`
  ADD CONSTRAINT `todolist_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
