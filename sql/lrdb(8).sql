-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 26, 2025 at 10:45 PM
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

--
-- Dumping data for table `contact_msg`
--

INSERT INTO `contact_msg` (`id`, `name`, `email`, `message`, `subject`, `reply_msg`, `replied`, `submitted_at`) VALUES
(1, 'asfasdf', 'domakandhacking@gmail.com', 'dasdfasdf', 'asdf', 'df', 'Yes', '2025-08-16 23:19:09');

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
(214, 'asdfasdfasdf', '123123', 'dsfasdf', '2025-08-26 00:00:00', NULL, 12);

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
  `department_confirm_sign` longtext DEFAULT NULL,
  `department_confirm_stamp` longtext DEFAULT NULL,
  `status` enum('Pending','Department Approvel','Rejected','Finished','Confirmed') NOT NULL DEFAULT 'Pending',
  `is_resubmit` tinyint(1) NOT NULL DEFAULT 0,
  `submitted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee_req_form`
--

INSERT INTO `employee_req_form` (`id`, `user_id`, `serial_number`, `name`, `position`, `department_address`, `phone`, `report_receiver_name`, `report_receiver_position`, `report_receiver_address`, `report_receiver_time`, `occupation`, `department_confirm_sign`, `department_confirm_stamp`, `status`, `is_resubmit`, `submitted_at`) VALUES
(12, 14, '001', 'dsfasdf', 'asdfasdf', 'dsafasdf', '096667756343', 'dfasdf', 'asdfasdf', 'asdfasdf', '2025-08-26 11:01:00', '[{\"occupation\":\"\\u1026\\u1038\\u1005\\u102e\\u1038\\/ \\u1012\\u102f-\\u1026\\u1038\\u1005\\u102e\\u1038\",\"male\":\"3\",\"female\":\"\",\"qualification\":\"\\u1019\\u1030\\u101c\\u1010\\u1014\\u103a\\u1038\\u1021\\u1031\\u102c\\u1004\\u103a\",\"skill\":\"-\",\"working_type_period\":\"asdfasdf\",\"salary\":\"asdfasdf\"}]', NULL, NULL, 'Finished', 0, '2025-08-26 16:35:04');

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
(14, 12, '002', '000001', '2025-08-26 23:05:04');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=271;

--
-- AUTO_INCREMENT for table `employee_req_form`
--
ALTER TABLE `employee_req_form`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `serial_numbers`
--
ALTER TABLE `serial_numbers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

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
