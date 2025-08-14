-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 14, 2025 at 11:49 PM
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
-- Database: `lrdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `about`
--

CREATE TABLE `about` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `body` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `about`
--

INSERT INTO `about` (`id`, `title`, `body`) VALUES
(1, 'about us', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc,');

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `email`, `password`, `created_at`) VALUES
(1, 'admin', 'admin@gmail.com', '$2y$10$dfx061TqL8Xg0xFkdXVEM.IwjGlksyE99iFMudW.4Sbn81GFATVmC', '2025-08-15 02:15:33');

-- --------------------------------------------------------

--
-- Table structure for table `applications`
--

CREATE TABLE `applications` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `age` int(11) NOT NULL,
  `fatherName` varchar(200) NOT NULL,
  `nrc` varchar(100) DEFAULT NULL,
  `picture` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `registration_date` datetime NOT NULL DEFAULT current_timestamp(),
  `township` varchar(100) NOT NULL,
  `serial_number` varchar(100) DEFAULT NULL,
  `birth_date` date NOT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `religion` varchar(100) NOT NULL,
  `edu_level` varchar(100) NOT NULL,
  `stable_address` varchar(255) NOT NULL,
  `images` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `status` enum('Approved','Pending','Rejected') NOT NULL DEFAULT 'Pending',
  `message` text DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `is_resubmit` tinyint(1) NOT NULL DEFAULT 0,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `applications`
--

INSERT INTO `applications` (`id`, `name`, `age`, `fatherName`, `nrc`, `picture`, `phone`, `email`, `registration_date`, `township`, `serial_number`, `birth_date`, `gender`, `religion`, `edu_level`, `stable_address`, `images`, `status`, `message`, `user_id`, `is_resubmit`, `updated_at`) VALUES
(9, 'updated name', 0, '0', '၁၄/ခလဖ(နိုင်)122222', '/static/uploads/picture/f6e736c1941dd9eb8b007d49837cb0dc.png', '09666775646', 'dom@gmail.com', '2025-07-30 23:33:52', 'ဟင်္သာတ', '001', '2007-07-03', 'Female', 'ဗုဒ္ဓဘာသာ', 'မူလတန်းအောင်', 'asdf', '{\"nrc\":\"[\\\"static\\\\\\/uploads\\\\\\/nrc\\\\\\/688a692fbe074_photo_2025-05-28_18-42-06.jpg\\\",\\\"static\\\\\\/uploads\\\\\\/nrc\\\\\\/688a692fbe105_photo_2025-05-28_18-42-13.jpg\\\"]\",\"certificate\":\"\\/static\\/uploads\\/certificate\\/6bf0b2b5c4bc56ce2d8ef71805ac7ea9.jpeg\"}', 'Approved', 'We are checking ur details\r\nadsf', 11, 0, '2025-07-30 00:00:00'),
(10, 'Kyaw Kyaw', 18, 'U Kyaw Mya', '၁၄/ဟသတ(နိုင်)123456', '/static/uploads/picture/6f8299235c8ea6a8304622a2e24bc4de.png', '0989893498', 'kyawkyaw@gmail.com', '2025-08-13 00:01:14', 'ဟင်္သာတ', '002', '2003-01-01', 'Male', 'ဗုဒ္ဓဘာသာ', 'မူလတန်းအောင်', 'Hinthada', '{\"nrc\":\"[\\\"static\\\\\\/uploads\\\\\\/nrc\\\\\\/689b7a626fcad_photo_2025-05-22_17-31-17.jpg\\\",\\\"static\\\\\\/uploads\\\\\\/nrc\\\\\\/689b7a626fd36_photo_2025-05-22_17-15-28.jpg\\\"]\",\"certificate\":\"\\/static\\/uploads\\/certificate\\/6613b0ec7c5580888537abfc2c9af9de.jpg\"}', 'Approved', 'We\'ve approved your request', 15, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `google_map` text NOT NULL,
  `phone` varchar(14) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `google_map`, `phone`, `email`, `address`) VALUES
(1, 'htsdf', 'asdf', 'sadf', 'asdf');

-- --------------------------------------------------------

--
-- Table structure for table `contact_msg`
--

CREATE TABLE `contact_msg` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `subject` varchar(200) NOT NULL,
  `reply_msg` text DEFAULT NULL,
  `replied` enum('Yes','No') NOT NULL DEFAULT 'No',
  `submitted_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `department_approval`
--

CREATE TABLE `department_approval` (
  `id` int(11) NOT NULL,
  `toDeliver` varchar(255) NOT NULL,
  `department_name` varchar(200) NOT NULL,
  `approval_req_date` datetime NOT NULL DEFAULT current_timestamp(),
  `employee_requested_date` datetime DEFAULT NULL,
  `employee_req_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `department_approval`
--

INSERT INTO `department_approval` (`id`, `toDeliver`, `department_name`, `approval_req_date`, `employee_requested_date`, `employee_req_id`) VALUES
(12, 'asdf', 'asdf', '2025-08-14 00:00:00', NULL, 4);

-- --------------------------------------------------------

--
-- Table structure for table `employee_req_form`
--

CREATE TABLE `employee_req_form` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `department_address` text DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `report_receiver` text DEFAULT NULL,
  `occupation` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`occupation`)),
  `status` enum('Pending','Department Approvel','Rejected','Finished') NOT NULL DEFAULT 'Pending',
  `letter_no` varchar(50) DEFAULT NULL,
  `is_resubmit` tinyint(1) NOT NULL DEFAULT 0,
  `submitted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee_req_form`
--

INSERT INTO `employee_req_form` (`id`, `user_id`, `name`, `position`, `department_address`, `phone`, `report_receiver`, `occupation`, `status`, `letter_no`, `is_resubmit`, `submitted_at`) VALUES
(4, 14, 'asdf', 'asdf', 'asdf', '0989893498', 'asdf', '[{\"occupation\":\"\\u101b\\u102f\\u1036\\u1038\\u1021\\u1000\\u1030\\/\\u1005\\u102c\\u1015\\u102d\\u102f\\u1037\",\"male\":\"3\",\"female\":\"\",\"qualification\":\"\\u1019\\u1030\\u101c\\u1010\\u1014\\u103a\\u1038\\u1021\\u1031\\u102c\\u1004\\u103a\",\"salary\":\"22323 2332\"}]', 'Rejected', 'asdf', 0, '2025-08-13 18:07:46');

-- --------------------------------------------------------

--
-- Table structure for table `serial_numbers`
--

CREATE TABLE `serial_numbers` (
  `id` int(11) NOT NULL,
  `form_id` int(11) NOT NULL,
  `serial_number` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `serial_numbers`
--

INSERT INTO `serial_numbers` (`id`, `form_id`, `serial_number`) VALUES
(5, 4, '002');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(200) NOT NULL,
  `type` enum('employer','employee') NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `type`, `created_at`) VALUES
(11, 'Tester', 'tester@gmail.com', '$2y$10$gWO81JF5oOAVZIiajAmKze6lNp6gJE5s9dHHRiNsLge0ikPmIWiSG', 'employee', '2025-07-30 18:55:17'),
(12, 'kyawkyaw', 'kyaw@gmail.com', '$2y$10$Ld0efm2h25ti9VQgp.l1WeLZgGzz6ozf/zktrG5sxMdmoVOKYPmqC', 'employee', '2025-07-31 01:36:54'),
(14, 'employer', 'employer@gmail.com', '$2y$10$4/deCK34mjTAgadwt0xnT.vbpzrIbwe7UDkD2/SsJanGJLmkN8BuG', 'employer', '2025-07-31 17:02:42'),
(15, 'employee', 'employee@gmail.com', '$2y$10$SS5w7PpIRj7zaRzyQDFz6.zrezZr7C8uoYE2tRvHtPbJHCn9lSoh6', 'employee', '2025-08-09 03:47:26'),
(16, 'domak12', 'domakandhacking@gmail.com', '$2y$10$XPktfORkyQOVop2lTVggMuAKU0FKLoliCbckIiPAsZhadwY8O3isy', 'employer', '2025-08-13 20:12:09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about`
--
ALTER TABLE `about`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `applications`
--
ALTER TABLE `applications`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `serial_number` (`serial_number`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_msg`
--
ALTER TABLE `contact_msg`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `department_approval`
--
ALTER TABLE `department_approval`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `employee_req_id` (`employee_req_id`);

--
-- Indexes for table `employee_req_form`
--
ALTER TABLE `employee_req_form`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `serial_numbers`
--
ALTER TABLE `serial_numbers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `form_id` (`form_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about`
--
ALTER TABLE `about`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `applications`
--
ALTER TABLE `applications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contact_msg`
--
ALTER TABLE `contact_msg`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `department_approval`
--
ALTER TABLE `department_approval`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `employee_req_form`
--
ALTER TABLE `employee_req_form`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `serial_numbers`
--
ALTER TABLE `serial_numbers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `applications`
--
ALTER TABLE `applications`
  ADD CONSTRAINT `applications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `department_approval`
--
ALTER TABLE `department_approval`
  ADD CONSTRAINT `department_approval_ibfk_1` FOREIGN KEY (`employee_req_id`) REFERENCES `employee_req_form` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `employee_req_form`
--
ALTER TABLE `employee_req_form`
  ADD CONSTRAINT `employee_req_form_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `serial_numbers`
--
ALTER TABLE `serial_numbers`
  ADD CONSTRAINT `serial_numbers_ibfk_1` FOREIGN KEY (`form_id`) REFERENCES `employee_req_form` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
