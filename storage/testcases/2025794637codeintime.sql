-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 16, 2017 at 08:57 PM
-- Server version: 5.5.54-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `codeintime`
--

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2017_03_12_102112_create_question_table', 2),
(4, '2017_03_12_102939_create_submissions_table', 2),
(5, '2017_03_15_101941_create_rules_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE IF NOT EXISTS `questions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `constraint` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `sample` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `input_tc` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `output_tc` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `max_score` int(11) NOT NULL DEFAULT '0',
  `current_score` int(11) NOT NULL DEFAULT '0',
  `correct_sub` int(11) NOT NULL DEFAULT '0',
  `attempted` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `title`, `details`, `constraint`, `sample`, `input_tc`, `output_tc`, `max_score`, `current_score`, `correct_sub`, `attempted`, `created_at`, `updated_at`) VALUES
(1, 'Sum of two nos', 'Print a+b', 'none', 'none', 'input1.txt', 'output1.txt', 100, 100, 0, 0, NULL, NULL),
(2, 'Diff', 'a-b', 'none', 'none', 'input2.txt', 'output2.txt', 100, 100, 0, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `rules`
--

CREATE TABLE IF NOT EXISTS `rules` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rule` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `rules`
--

INSERT INTO `rules` (`id`, `rule`, `created_at`, `updated_at`) VALUES
(1, 'Rule no 1', NULL, NULL),
(2, 'Rule Np2', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `submissions`
--

CREATE TABLE IF NOT EXISTS `submissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ques_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `marks` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=22 ;

--
-- Dumping data for table `submissions`
--

INSERT INTO `submissions` (`id`, `ques_id`, `user_id`, `status`, `marks`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'AC', 100, NULL, NULL),
(2, 1, 1, 'CE', 0, NULL, NULL),
(3, 1, 1, 'WA', 0, NULL, NULL),
(4, 2, 1, 'WA', 0, NULL, NULL),
(5, 1, 2, 'AC', 50, NULL, NULL),
(6, 2, 1, 'AC', 25, NULL, NULL),
(7, 1, 2, 'WA', 0, NULL, NULL),
(8, 2, 1, 'WA', 0, NULL, NULL),
(9, 2, 1, 'CE', 0, NULL, NULL),
(10, 1, 2, 'WA', 0, NULL, NULL),
(11, 2, 2, 'AC', 50, NULL, NULL),
(12, 1, 1, 'AC', 0, '2017-03-16 08:06:41', '2017-03-16 08:06:41'),
(13, 1, 1, 'AC', 0, '2017-03-16 08:07:01', '2017-03-16 08:07:01'),
(14, 1, 1, 'WA', 0, '2017-03-16 08:07:25', '2017-03-16 08:07:25'),
(15, 1, 1, 'WA', 0, '2017-03-16 08:16:15', '2017-03-16 08:16:15'),
(16, 1, 1, 'WA', 0, '2017-03-16 08:17:33', '2017-03-16 08:17:33'),
(17, 1, 1, 'AC', 100, '2017-03-16 08:17:46', '2017-03-16 08:17:46'),
(18, 1, 1, 'WA', 0, '2017-03-16 08:20:29', '2017-03-16 08:20:29'),
(19, 1, 1, 'WA', 0, '2017-03-16 08:21:00', '2017-03-16 08:21:00'),
(20, 1, 1, 'WA', 0, '2017-03-16 08:29:13', '2017-03-16 08:29:13'),
(21, 1, 1, 'AC', 100, '2017-03-16 08:29:34', '2017-03-16 08:29:34');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `college` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'JSS',
  `year` int(11) NOT NULL DEFAULT '1',
  `mobile` bigint(20) NOT NULL DEFAULT '0',
  `score` int(11) NOT NULL DEFAULT '0',
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `college`, `year`, `mobile`, `score`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Himanshu Agrawal', 'himagr0001@gmail.com', 'JSS Academy of Technical Education', 1, 8285885415, 0, '$2y$10$LQK5VhJ0Dxu02SG65i3WYe9vyxq2ak3OoKqGosEEfbmHTddh1zfim', 'JKaiWkXOXxoU5g9t7Xlypw7hZXaorY4n3h389qSEdzLFXk1p8lAFc6Mp6u2X', '2017-03-12 04:50:51', '2017-03-12 04:50:51'),
(2, 'Hello', 'himagr0002@gmail.com', 'jss', 1, 989898, 0, '$2y$10$6kUnA/458foOWfJEqGwUqeMZyywPLxWiIUqONQC1gDBlFFrMtmyeq', NULL, '2017-03-16 06:15:51', '2017-03-16 06:15:51');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
