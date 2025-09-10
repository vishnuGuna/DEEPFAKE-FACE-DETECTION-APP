-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 30, 2025 at 10:54 AM
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
-- Database: `deepfake`
--

-- --------------------------------------------------------

--
-- Table structure for table `analysis`
--

CREATE TABLE `analysis` (
  `id` int(11) NOT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `result` varchar(10) DEFAULT NULL,
  `confidence` double DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `analysis`
--

INSERT INTO `analysis` (`id`, `file_path`, `result`, `confidence`, `created_at`) VALUES
(1, 'uploads/a03224dc2c0f55d77853d9ce8dc881 (1).JPEG', 'real', 0, '2025-05-29 06:38:23'),
(2, 'uploads/upload_video.mp4', 'real', 0, '2025-05-29 07:34:06'),
(3, 'uploads/upload_video.mp4', 'real', 0, '2025-05-29 07:34:17'),
(4, 'uploads/upload_video.mp4', 'real', 0, '2025-05-29 07:34:40'),
(5, 'uploads/upload_video.mp4', 'real', 0, '2025-05-29 07:34:53'),
(6, 'uploads/upload_video.mp4', 'real', 0, '2025-05-29 07:47:15'),
(7, 'uploads/upload_video.mp4', 'real', 0, '2025-05-29 07:47:45'),
(8, 'uploads/upload_video.mp4', 'real', 0, '2025-05-29 07:53:54'),
(9, 'uploads/upload_video.mp4', 'real', 0, '2025-05-29 07:54:32'),
(10, 'uploads/upload_video.mp4', 'fake', 66.67, '2025-05-29 07:55:39'),
(11, 'uploads/upload_video.mp4', 'real', 26.67, '2025-05-29 07:58:06'),
(12, 'uploads/upload_video.mp4', 'real', 0, '2025-05-29 08:01:06'),
(13, 'uploads/upload_video.mp4', 'real', 0, '2025-05-29 08:03:13'),
(14, 'uploads/upload_video.mp4', 'real', 0, '2025-05-29 08:05:42'),
(15, 'uploads/upload_video.mp4', 'fake', 66.67, '2025-05-29 08:05:58'),
(16, 'uploads/upload_video.mp4', 'real', 0, '2025-05-29 08:06:33'),
(17, 'uploads/upload_video.mp4', 'real', 26.67, '2025-05-29 08:06:55'),
(18, 'uploads/upload_video.mp4', 'fake', 60, '2025-05-29 08:10:08'),
(19, 'uploads/68387b593dc69_IMG_20231022_165147.jpg', 'real', 0.57, '2025-05-29 15:21:03'),
(20, 'uploads/upload_video.mp4', 'real', 0, '2025-05-29 17:06:40'),
(21, 'uploads/683896a6928a8_upload_image.jpg', 'real', 0.57, '2025-05-29 17:17:31'),
(22, 'uploads/683896c6d7835_upload_image.jpg', 'real', 0.57, '2025-05-29 17:18:04'),
(23, 'uploads/6838973edd6a6_upload_image.jpg', 'real', 0.57, '2025-05-29 17:20:04'),
(24, 'uploads/upload_video.mp4', 'real', 0, '2025-05-29 17:22:57'),
(25, 'uploads/683898419eecc_upload_image.jpg', 'real', 0.57, '2025-05-29 17:24:23'),
(26, 'uploads/68389a81d0ff5_1000176842.jpg', 'real', 0.57, '2025-05-29 17:33:59'),
(27, 'uploads/68389a850ad9f_1000176842.jpg', 'real', 0.57, '2025-05-29 17:34:03'),
(28, 'uploads/68389a850a491_1000176842.jpg', 'real', 0.57, '2025-05-29 17:34:03'),
(29, 'uploads/68389abf30a49_1000161828.jpg', 'real', 0.55, '2025-05-29 17:35:00'),
(30, 'uploads/68389ae3ce095_1000166387.jpg', 'real', 0.57, '2025-05-29 17:35:37'),
(31, 'uploads/68389b08e45bc_1000161596.jpg', 'real', 0.56, '2025-05-29 17:36:14'),
(32, 'uploads/68389b2382e1e_1000156503.jpg', 'real', 0.55, '2025-05-29 17:36:40'),
(33, 'uploads/68389f2c5383d_1000176961.jpg', 'real', 0.56, '2025-05-29 17:53:54'),
(34, 'uploads/68389f45c3237_1000176964.jpg', 'real', 0.56, '2025-05-29 17:54:19'),
(35, 'uploads/68389f67a4787_1000176957.jpg', 'real', 0.58, '2025-05-29 17:54:52'),
(36, 'uploads/68389f71d38f7_1000176958.jpg', 'real', 0.56, '2025-05-29 17:55:02'),
(37, 'uploads/68389f810e955_1000174562.jpg', 'real', 0.56, '2025-05-29 17:55:19'),
(38, 'uploads/68389f97e5a68_1000167765.jpg', 'real', 0.57, '2025-05-29 17:55:42'),
(39, 'uploads/6838a0d9550a7_fakee.jpg', 'real', 0.56, '2025-05-29 18:01:02'),
(40, 'uploads/6838a328ddd92_fakee.jpg', 'fake', 0.56, '2025-05-29 18:10:54'),
(41, 'uploads/6838a3506b3a3_IMG_20231022_170712.jpg', 'fake', 0.58, '2025-05-29 18:11:33'),
(42, 'uploads/6838a3ee25245_1000176964.jpg', 'fake', 0.56, '2025-05-29 18:14:10'),
(43, 'uploads/6838a3f748cc9_1000176842.jpg', 'fake', 0.57, '2025-05-29 18:14:19'),
(44, 'uploads/6838a3f84532d_1000176842.jpg', 'fake', 0.57, '2025-05-29 18:14:20'),
(45, 'uploads/upload_video.mp4', 'real', 0, '2025-05-29 18:45:22'),
(46, 'uploads/upload_video.mp4', 'real', 0, '2025-05-29 18:45:36'),
(47, 'uploads/6838ab8b2f40e_IMG_20231022_170712.jpg', 'real', 0.58, '2025-05-29 18:46:40'),
(48, 'uploads/6838abaac1e53_fake.jpg', 'real', 0.56, '2025-05-29 18:47:16'),
(49, 'uploads/683940414a340_fake.jpg', 'real', 0.56, '2025-05-30 05:21:28'),
(50, 'uploads/683941179ac92_IMG_20231022_165147.jpg', 'real', 0.57, '2025-05-30 05:24:50'),
(51, 'uploads/6839413616413_fakee.jpg', 'real', 0.56, '2025-05-30 05:25:20'),
(52, 'uploads/683942da4909f_fakee.jpg', 'real', 1, '2025-05-30 05:32:21'),
(53, 'uploads/683942feb816f_IMG_20231027_073828.jpg', 'fake', 0.84, '2025-05-30 05:32:58'),
(54, 'uploads/6839435c47dc0_IMG_20231027_073828.jpg', 'real', 0.84, '2025-05-30 05:34:31'),
(55, 'uploads/68394371b0ba8_fakee.jpg', 'fake', 1, '2025-05-30 05:34:52'),
(56, 'uploads/68395df58e382_1000176964.jpg', 'fake', 1, '2025-05-30 07:28:52'),
(57, 'uploads/68395e1b58c04_1000176964.jpg', 'fake', 1, '2025-05-30 07:28:52'),
(58, 'uploads/upload_video.mp4', 'real', 0, '2025-05-30 07:29:18'),
(59, 'uploads/6839604355e1d_1000176964.jpg', 'fake', 1, '2025-05-30 07:37:45'),
(60, 'uploads/6839605048bd9_1000176957.jpg', 'fake', 0.91, '2025-05-30 07:37:56'),
(61, 'uploads/68396062c100e_1000176842.jpg', 'real', 0.87, '2025-05-30 07:38:15'),
(62, 'uploads/683960af2f80d_1000176964.jpg', 'fake', 1, '2025-05-30 07:39:31'),
(63, 'uploads/6839620367df3_1000177059.jpg', 'real', 0.79, '2025-05-30 07:45:12'),
(64, 'uploads/683962118b888_1000177060.jpg', 'fake', 0.93, '2025-05-30 07:45:25'),
(65, 'uploads/upload_video.mp4', 'fake', 100, '2025-05-30 07:47:25'),
(66, 'uploads/upload_video.mp4', 'fake', 100, '2025-05-30 07:47:51'),
(67, 'uploads/upload_video.mp4', 'real', 0, '2025-05-30 07:48:52'),
(68, 'uploads/upload_video.mp4', 'real', 0, '2025-05-30 07:49:53'),
(69, 'uploads/upload_video.mp4', 'real', 0, '2025-05-30 07:50:12'),
(70, 'uploads/upload_video.mp4', 'fake', 100, '2025-05-30 07:51:11'),
(71, 'uploads/upload_video.mp4', 'fake', 69.57, '2025-05-30 07:52:35'),
(72, 'uploads/upload_video.mp4', 'fake', 66.67, '2025-05-30 07:56:20'),
(73, 'uploads/upload_video.mp4', 'real', 0, '2025-05-30 07:56:37'),
(74, 'uploads/upload_video.mp4', 'real', 0, '2025-05-30 07:57:08'),
(75, 'uploads/683964f2a44a6_1000177060.jpg', 'fake', 0.93, '2025-05-30 07:57:42'),
(76, 'uploads/683964f49ac0f_1000177060.jpg', 'fake', 0.93, '2025-05-30 07:57:44'),
(77, 'uploads/683965038850d_1000177060.jpg', 'fake', 0.93, '2025-05-30 07:57:59'),
(78, 'uploads/6839650f2f9b8_1000177059.jpg', 'real', 0.79, '2025-05-30 07:58:11'),
(79, 'uploads/upload_video.mp4', 'real', 100, '2025-05-30 08:00:55'),
(80, 'uploads/upload_video.mp4', 'real', 100, '2025-05-30 08:01:14'),
(81, 'uploads/upload_video.mp4', 'fake', 33.33, '2025-05-30 08:01:27'),
(82, 'uploads/upload_video.mp4', 'real', 100, '2025-05-30 08:35:04'),
(83, 'uploads/68396dc8641d6_1000177060.jpg', 'fake', 93.37, '2025-05-30 08:35:24'),
(84, 'uploads/upload_video.mp4', 'real', 100, '2025-05-30 08:35:39'),
(85, 'uploads/68396de9d973d_1000177059.jpg', 'real', 78.51, '2025-05-30 08:35:57'),
(86, 'uploads/68396dec423c7_1000177059.jpg', 'real', 78.51, '2025-05-30 08:36:00'),
(87, 'uploads/upload_video.mp4', 'real', 100, '2025-05-30 08:36:59'),
(88, 'uploads/upload_video.mp4', 'real', 100, '2025-05-30 08:38:44'),
(89, 'uploads/upload_video.mp4', 'fake', 33.33, '2025-05-30 08:40:22'),
(90, 'uploads/upload_video.mp4', 'real', 100, '2025-05-30 08:40:44'),
(91, 'uploads/68396f19b06aa_1000176961.jpg', 'fake', 100, '2025-05-30 08:41:01'),
(92, 'uploads/68396f2569a34_1000177059.jpg', 'real', 78.51, '2025-05-30 08:41:13');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `confirmPassword` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `confirmPassword`) VALUES
(1, 'mouuu', 'mouu@gmail.com', '1234', ''),
(7, 'vishn', 'mou.06@gmail.com', '1234', ''),
(10, 'vishnu', 'mouu2@gmail.com', '1234', ''),
(14, 'mouu', 'vyshu@gmail.com', '1234', ''),
(18, 'vishnu', 'mounikk@gmail.com', '1234', ''),
(25, 'vishnu', 'mouni@gmail.com', '1234', ''),
(34, 'vish', 'pothula@33gmail.com', '1234', ''),
(35, 'vamsi', 'vamsi@1gmail.com', '12345', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `analysis`
--
ALTER TABLE `analysis`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `analysis`
--
ALTER TABLE `analysis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
