-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 30, 2025 at 11:10 AM
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
(1, 'about us', '<div><font color=\"#374151\" face=\"Segoe UI\"><span style=\"font-size: 18px;\"><b>Labour online register system ရေးသားရခြင်းမှာ-အလုပ်သမားကတ်လျှောက်ထားသူများအနေဖြင့်&nbsp;</b></span></font></div><div><font color=\"#374151\" face=\"Segoe UI\"><span style=\"font-size: 18px;\"><b>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;(၁) အချိန်ကုန်သက်သာ‌စေခြင်း</b></span></font></div><div><font color=\"#374151\" face=\"Segoe UI\"><span style=\"font-size: 18px;\"><b>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;(၂) လွယ်ကူလျှင်မြန်ခြင်း</b></span></font></div><div><font color=\"#374151\" face=\"Segoe UI\"><span style=\"font-size: 18px;\"><b>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;(၃) အလုပ်လျှောက်ရလွယ်ကူစေခြင်းတို့ဖြစ်သည်။&nbsp;</b></span></font></div><div><font color=\"#374151\" face=\"Segoe UI\"><span style=\"font-size: 18px;\"><b>ဝန်ထမ်းများအနေဖြင့်လည်း&nbsp;</b></span></font></div><div><font color=\"#374151\" face=\"Segoe UI\"><span style=\"font-size: 18px;\"><b>&nbsp; &nbsp; &nbsp; &nbsp; (၁)&nbsp; အချိန်ကုန်သက်သာပြီး စာရွက်စာတန်းများကုန်ကျသက်သာစေခြင်း၊</b></span></font></div><div><font color=\"#374151\" face=\"Segoe UI\"><span style=\"font-size: 18px;\"><b>&nbsp; &nbsp; &nbsp; &nbsp; (၂) လုပ်ငန်းများအချိန်မှီပြီးမြောက်စေခြင်း၊</b></span></font></div><div><font color=\"#374151\" face=\"Segoe UI\"><span style=\"font-size: 18px;\"><b>&nbsp; &nbsp; &nbsp; &nbsp;(၃)&nbsp; e-government နှင့်အညီဆောင်ရွက်နိုင်ခြင်း၊&nbsp;</b></span></font></div><div><font color=\"#374151\" face=\"Segoe UI\"><span style=\"font-size: 18px;\"><b>&nbsp; &nbsp; &nbsp; &nbsp;(၄) အချက်အလက်များလုံခြုံစိတ်ချစွာသိမ်းထားနိုင်ခြင်း</b></span></font></div><div><font color=\"#374151\" face=\"Segoe UI\"><span style=\"font-size: 18px;\"><b>&nbsp; &nbsp; &nbsp; &nbsp;(၅) အချက်အလက်များအလွယ်တကူပြန်လည်ရှာဖွေနိုင်ခြင်း လုပ်ငန်းတွင်ကျယ်စွာလုပ်ကိုင်နိုင်ခြင်း တို့ဖြစ်သည်။</b></span></font></div><div><font color=\"#374151\" face=\"Segoe UI\"><span style=\"font-size: 18px;\"><b>&nbsp;အလုပ်သမားကတ်လျှောက်ထားသူများ လုပ်ဆောင်ရမည့်အဆင့်များ</b></span></font></div><div><font color=\"#374151\" face=\"Segoe UI\"><span style=\"font-size: 18px;\"><b>အဆင့်(၁)&nbsp; &nbsp;မှတ်ပုံတင်ရန်‌လျှောက်ထားခြင်းခေါင်းစဉ်အောက်မှ&nbsp; \"Account\" ကို Click နှိပ်ပါ။</b></span></font></div><div><font color=\"#374151\" face=\"Segoe UI\"><span style=\"font-size: 18px;\"><b>အဆင်(၂)&nbsp; &nbsp;သုံးစွဲသူ၏အမည်၊ လျှို့ဝှက်ကုဒ်များဖြင့်ဝင်ရောက်၍ အကောင့်ဖွင့်ပါ။ အကောင့်ဖွင့်ပြီးသော သုံးစွဲသူများသည် အမည်၊ လျှို့ဝှက်ကုဒ်များဖြည့်၍&nbsp; &nbsp;</b></span></font></div><div><font color=\"#374151\" face=\"Segoe UI\"><span style=\"font-size: 18px;\"><b>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;\"Login\"ကိုClickနှိပ်ပါ။&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</b></span></font></div><div><font color=\"#374151\" face=\"Segoe UI\"><span style=\"font-size: 18px;\"><b>အဆင်(၃)&nbsp; &nbsp; ဝင်ရန်ကိုနှိပ်ပြီးလျှင် လျှောက်လွှာမှ Passport Size ဓာတ်ပုံ(အပြာရောင်နောက်ခံ)အား Upload ပြုလုပ်ရန်၊</b></span></font></div><div><font color=\"#374151\" face=\"Segoe UI\"><span style=\"font-size: 18px;\"><b>အဆင်(၄)&nbsp; &nbsp; &nbsp;ဖြည့်စွက်ရန်လိုအပ်သော အချက်အလက်များကို ပြည့်စုံစွာဖြည့်စွက်ရမည်ဖြစ်ပြီး အောက်တွင် မှတ်ပုံတင်မိတ္တူနှင့် အောင်လက်မှတ်မိတ္တူတို့အားUpload&nbsp;</b></span></font></div><div><font color=\"#374151\" face=\"Segoe UI\"><span style=\"font-size: 18px;\"><b>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ပြုလုပ်ရန်</b></span></font></div><div><font color=\"#374151\" face=\"Segoe UI\"><span style=\"font-size: 18px;\"><b>အဆင်(၅)&nbsp; &nbsp; အချက်အလက်များပြည့်စုံမှန်ကန်ပါက \"Submit\" ကို Click နှိပ်ပါ။&nbsp;</b></span></font></div><div><font color=\"#374151\" face=\"Segoe UI\"><span style=\"font-size: 18px;\"><b>မှတ်ချက်။&nbsp; &nbsp; ။ (လျှောက်ထားရန်အတွက် လုပ်ငန်းရှင်မှ Register ပြုလုပ်ခဲ့သည့်User Name ၊ Password နှင့် email တို့အား မှတ်သားထားရန် လိုအပ်ပါသည်။)&nbsp; &nbsp; &nbsp; &nbsp;</b></span></font></div><div><br></div>');

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
  `status` enum('Approved','Pending','Rejected','Resubmitted') NOT NULL DEFAULT 'Pending',
  `message` text DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `is_resubmit` tinyint(1) NOT NULL DEFAULT 0,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `applications`
--

INSERT INTO `applications` (`id`, `name`, `age`, `fatherName`, `nrc`, `picture`, `phone`, `email`, `registration_date`, `township`, `serial_number`, `birth_date`, `gender`, `religion`, `edu_level`, `stable_address`, `images`, `status`, `message`, `user_id`, `is_resubmit`, `updated_at`) VALUES
(10, 'Kyaw Kyaw', 18, 'U Kyaw Mya', '၁၄/ခလဖ(နိုင်)123456', '/static/uploads/picture/6f8299235c8ea6a8304622a2e24bc4de.png', '0989893498', 'kyawkyaw@gmail.com', '2025-08-13 00:01:14', 'ဟင်္သာတ', '002', '2003-01-01', 'Male', 'ဗုဒ္ဓဘာသာ', 'မူလတန်းအောင်', 'Hinthada', '{\"nrc\":\"[\\\"static\\\\\\/uploads\\\\\\/nrc\\\\\\/689b7a626fcad_photo_2025-05-22_17-31-17.jpg\\\",\\\"static\\\\\\/uploads\\\\\\/nrc\\\\\\/689b7a626fd36_photo_2025-05-22_17-15-28.jpg\\\"]\",\"certificate\":\"\\/static\\/uploads\\/certificate\\/6613b0ec7c5580888537abfc2c9af9de.jpg\"}', 'Approved', 'We\'ve approved your request', 15, 0, '2025-08-17 00:00:00'),
(11, 'Mg Mg Hla', 20, 'Kyaw Kyaw Naing', '၁၄/ဟသတ(နိုင်)၁၂၃၁၂၃', '/static/uploads/picture/dd3356af568cc85a9b4b46cec97d331e.jpeg', '0989893498', 'tester1@gmail.com', '2025-08-26 23:13:05', 'ဟင်္သာတ', '003', '2007-08-01', 'Female', 'ဗုဒ္ဓဘာသာ', 'မူလတန်းအောင်', 'Hinthada No 1', '{\"nrc\":\"[\\\"static\\\\\\/uploads\\\\\\/nrc\\\\\\/68ade4198388e_photo_2025-05-22_17-15-28.jpg\\\",\\\"static\\\\\\/uploads\\\\\\/nrc\\\\\\/68ade419838ec_photo_2025-05-28_18-42-06.jpg\\\"]\",\"certificate\":\"\\/static\\/uploads\\/certificate\\/48ca65977e5ab0927454b3cbf1dc8663.jpg\"}', 'Approved', 'We approved you', 25, 0, NULL);

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
(1, 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3801.756830662532!2d95.4539544742161!3d17.661672494847533!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30c0c1a5a1b89e2d%3A0x7f9e7970d31a744e!2sLabour%20Exchange%20Office!5e0!3m2!1sen!2smm!4v1755950993942!5m2!1sen!2smm', '096664354545,', 'labordepartment@gmail.com', 'Hinthada Labor');

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
  `outletter_no` varchar(10) DEFAULT NULL,
  `department_name` varchar(200) NOT NULL,
  `approval_req_date` datetime NOT NULL DEFAULT current_timestamp(),
  `employee_requested_date` datetime DEFAULT NULL,
  `employee_req_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `department_approval`
--

INSERT INTO `department_approval` (`id`, `toDeliver`, `outletter_no`, `department_name`, `approval_req_date`, `employee_requested_date`, `employee_req_id`) VALUES
(272, '<div><b>Kyaw Kyaw</b></div><div><b>asdasdf</b></div>', '23423', 'asdfasdf', '2025-08-30 00:00:00', NULL, 13);

-- --------------------------------------------------------

--
-- Table structure for table `employee_req_form`
--

CREATE TABLE `employee_req_form` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `serial_number` varchar(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `department_address` text DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `report_receiver_name` varchar(200) DEFAULT NULL,
  `report_receiver_position` varchar(200) NOT NULL,
  `report_receiver_address` text NOT NULL,
  `report_receiver_time` datetime NOT NULL,
  `occupation` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`occupation`)),
  `signature` longtext DEFAULT NULL,
  `letter_no` varchar(50) DEFAULT NULL,
  `status` enum('Pending','Department Approvel','Rejected','Finished','Confirmed') NOT NULL DEFAULT 'Pending',
  `is_resubmit` tinyint(1) NOT NULL DEFAULT 0,
  `submitted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee_req_form`
--

INSERT INTO `employee_req_form` (`id`, `user_id`, `serial_number`, `name`, `position`, `department_address`, `phone`, `report_receiver_name`, `report_receiver_position`, `report_receiver_address`, `report_receiver_time`, `occupation`, `signature`, `letter_no`, `status`, `is_resubmit`, `submitted_at`) VALUES
(13, 14, '001', 'asdfasdf', 'asdfasdf', 'CB Bank(Hinthada)', '09666775646', 'asdfas', 'dasdfasdf', 'asdfasdf', '2025-08-14 11:01:00', '[{\"occupation\":\"\\u1026\\u1038\\u1005\\u102e\\u1038\\/ \\u1012\\u102f-\\u1026\\u1038\\u1005\\u102e\\u1038\",\"male\":\"3\",\"female\":\"\",\"qualification\":\"\\u1019\\u1030\\u101c\\u1010\\u1014\\u103a\\u1038\\u1021\\u1031\\u102c\\u1004\\u103a\",\"skill\":\"-\",\"working_type_period\":\"dfasdaf\",\"salary\":\"12312\"}]', 'data:image/png;base64,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', '123123123', 'Finished', 0, '2025-08-30 08:52:28');

-- --------------------------------------------------------

--
-- Table structure for table `serial_numbers`
--

CREATE TABLE `serial_numbers` (
  `id` int(11) NOT NULL,
  `form_id` int(11) NOT NULL,
  `serial_number` varchar(255) NOT NULL,
  `approved_serial` varchar(20) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `serial_numbers`
--

INSERT INTO `serial_numbers` (`id`, `form_id`, `serial_number`, `approved_serial`, `created_at`) VALUES
(16, 13, '002', '000001', '2025-08-30 15:22:28'),
(17, 13, '003', '000002', '2025-08-30 15:35:31');

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
(15, 'Mg Hla', 'employee@gmail.com', '$2y$10$SS5w7PpIRj7zaRzyQDFz6.zrezZr7C8uoYE2tRvHtPbJHCn9lSoh6', 'employee', '2025-08-09 03:47:26'),
(22, 'testemployer', 'testemployer@gmail.com', '$2y$10$pcgdFdyXG02h0R7XephgteyaedNwnIk1URRaiLiKFeORLbQp8mjqS', 'employer', '2025-08-19 23:17:07'),
(24, 'testemployee@gmail.com', 'testemployee@gmail.com', '$2y$10$Hb85zABJMLBqKa.2p.X3IuPmjXqwaiKPjnKCeeZ5V7Js4koiI3Goa', 'employee', '2025-08-23 18:06:41'),
(25, 'Employee Tester', 'tester1@gmail.com', '$2y$10$XPWNBbVXJirw4uKjxKsxfu.GkxlXkReQ4A8nXOgC4krnzNWZiGxQi', 'employee', '2025-08-26 23:11:02');

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
  ADD UNIQUE KEY `serial_number` (`serial_number`),
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contact_msg`
--
ALTER TABLE `contact_msg`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `department_approval`
--
ALTER TABLE `department_approval`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=292;

--
-- AUTO_INCREMENT for table `employee_req_form`
--
ALTER TABLE `employee_req_form`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `serial_numbers`
--
ALTER TABLE `serial_numbers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

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
