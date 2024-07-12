-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:4306
-- Generation Time: Oct 20, 2023 at 07:14 PM
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
-- Table structure for table `chats`
--

CREATE TABLE `chats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sender_id` bigint(20) UNSIGNED NOT NULL,
  `receiver_id` bigint(20) UNSIGNED NOT NULL,
  `conversation_id` bigint(20) UNSIGNED NOT NULL,
  `message` text NOT NULL,
  `attachments` text DEFAULT NULL,
  `custom_offers` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `chats`
--

INSERT INTO `chats` (`id`, `sender_id`, `receiver_id`, `conversation_id`, `message`, `attachments`, `custom_offers`, `created_at`, `updated_at`) VALUES
(1, 4, 3, 1, 'Unity Larson has joined the conversation. You can now send messages to eachother.', NULL, NULL, '2023-10-19 17:05:29', '2023-10-19 17:05:29'),
(2, 4, 2, 2, 'Unity Larson has joined the conversation. You can now send messages to eachother.', NULL, NULL, '2023-10-19 17:05:44', '2023-10-19 17:05:44'),
(3, 2, 2, 3, 'Admin User has joined the conversation. You can now send messages to eachother.', NULL, NULL, '2023-10-19 17:05:47', '2023-10-19 17:05:47'),
(4, 2, 2, 3, 'hi', NULL, NULL, '2023-10-19 17:06:06', '2023-10-19 17:06:06'),
(5, 2, 4, 2, 'hi', NULL, NULL, '2023-10-19 17:07:32', '2023-10-19 17:07:32'),
(6, 2, 4, 2, 'How are you ?', NULL, NULL, '2023-10-19 17:11:21', '2023-10-19 17:11:21'),
(7, 4, 2, 2, 'Hi, I am doing great.', NULL, NULL, '2023-10-19 17:12:21', '2023-10-19 17:12:21'),
(8, 4, 2, 2, 'How are you doing ?', NULL, NULL, '2023-10-19 17:12:33', '2023-10-19 17:12:33'),
(9, 2, 4, 2, 'Oh, My dear I am also doing great.', NULL, NULL, '2023-10-19 17:27:39', '2023-10-19 17:27:39'),
(10, 2, 4, 2, 'I need to talk with you about some project.', NULL, NULL, '2023-10-19 17:29:06', '2023-10-19 17:29:06'),
(11, 2, 4, 2, 'Are you available ?', NULL, NULL, '2023-10-19 17:29:18', '2023-10-19 17:29:18'),
(12, 4, 2, 2, 'Sure please let me know what would you like to talk about  ?', NULL, NULL, '2023-10-19 17:29:48', '2023-10-19 17:29:48'),
(13, 2, 4, 2, 'I would like to draw a picture of a horse ? Can you make it ?', NULL, NULL, '2023-10-19 17:35:55', '2023-10-19 17:35:55'),
(14, 4, 2, 2, 'Yes, I can do that for you. Can you please describe more about it ?', NULL, NULL, '2023-10-19 17:37:02', '2023-10-19 17:37:02'),
(15, 2, 4, 2, 'Sure, I am trying make a black horse. Running on a ground. Practicing for the race.', NULL, NULL, '2023-10-19 17:37:37', '2023-10-19 17:37:37'),
(16, 4, 2, 2, 'Okay perfect. Please send me a offer from my services.', NULL, NULL, '2023-10-19 17:38:02', '2023-10-19 17:38:02'),
(17, 4, 2, 2, 'http://127.0.0.1:8000/inbox/open/admin123', NULL, NULL, '2023-10-19 17:39:54', '2023-10-19 17:39:54'),
(18, 2, 4, 2, 'GG', NULL, NULL, '2023-10-19 18:20:38', '2023-10-19 18:20:38'),
(19, 4, 2, 2, 'Okay I will check', NULL, NULL, '2023-10-19 18:21:56', '2023-10-19 18:21:56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chats`
--
ALTER TABLE `chats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chats_sender_id_foreign` (`sender_id`),
  ADD KEY `chats_receiver_id_foreign` (`receiver_id`),
  ADD KEY `chats_conversation_id_foreign` (`conversation_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chats`
--
ALTER TABLE `chats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chats`
--
ALTER TABLE `chats`
  ADD CONSTRAINT `chats_conversation_id_foreign` FOREIGN KEY (`conversation_id`) REFERENCES `conversations` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `chats_receiver_id_foreign` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `chats_sender_id_foreign` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
