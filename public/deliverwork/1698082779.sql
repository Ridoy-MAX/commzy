-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:4306
-- Generation Time: Oct 20, 2023 at 07:15 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `commzy`
--

-- --------------------------------------------------------

--
-- Table structure for table `conversation_user`
--

CREATE TABLE `conversation_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `conversation_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `conversation_user`
--

INSERT INTO `conversation_user` (`id`, `user_id`, `conversation_id`, `created_at`, `updated_at`) VALUES
(1, 3, 1, '2023-10-19 23:05:29', '2023-10-19 23:05:29'),
(2, 4, 1, '2023-10-19 23:05:29', '2023-10-19 23:05:29'),
(3, 2, 2, '2023-10-19 23:05:44', '2023-10-19 23:05:44'),
(4, 4, 2, '2023-10-19 23:05:44', '2023-10-19 23:05:44'),
(5, 2, 3, '2023-10-19 23:05:47', '2023-10-19 23:05:47'),
(6, 2, 3, '2023-10-19 23:05:47', '2023-10-19 23:05:47');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `conversation_user`
--
ALTER TABLE `conversation_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `conversation_user_user_id_foreign` (`user_id`),
  ADD KEY `conversation_user_conversation_id_foreign` (`conversation_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `conversation_user`
--
ALTER TABLE `conversation_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `conversation_user`
--
ALTER TABLE `conversation_user`
  ADD CONSTRAINT `conversation_user_conversation_id_foreign` FOREIGN KEY (`conversation_id`) REFERENCES `conversations` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `conversation_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
