-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 04, 2017 at 03:55 PM
-- Server version: 5.7.19-0ubuntu0.17.04.1
-- PHP Version: 7.0.22-0ubuntu0.17.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mo7amy_online`
--

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` varchar(191) CHARACTER SET utf8 NOT NULL,
  `local` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `local`, `name`, `country_id`, `created_at`, `updated_at`) VALUES
('1', 'ar', 'القاهره', '1', NULL, NULL),
('10', 'ar', 'المنطقه الثانيه', '4', NULL, NULL),
('11', 'en', 'area1', '3', NULL, NULL),
('12', 'en', 'area 2', '3', NULL, NULL),
('13', 'en', 'test1', '9', NULL, NULL),
('14', 'en', 'test2', '10', NULL, NULL),
('15', 'ar', 'تيست 1', '4', NULL, NULL),
('2', 'ar', 'اﻷسكندريه', '1', NULL, NULL),
('3', 'en', 'cairo', '6', NULL, NULL),
('4', 'en', 'alex', '6', NULL, NULL),
('5', 'en', 'sharqa', '7', NULL, NULL),
('6', 'en', 'gada', '7', NULL, NULL),
('7', 'ar', 'الشارقه', '2', NULL, NULL),
('8', 'ar', 'جده', '2', NULL, NULL),
('9', 'ar', 'المنطقه اﻷولى', '4', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` varchar(255) CHARACTER SET utf8 NOT NULL,
  `local` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `local`, `name`, `created_at`, `updated_at`) VALUES
('1', 'ar', 'مصر', NULL, NULL),
('10', 'en', 'gzaar', NULL, NULL),
('2', 'ar', 'السعوديه', NULL, NULL),
('3', 'ar', 'تونس', NULL, NULL),
('4', 'ar', 'ليبيا', NULL, NULL),
('5', 'ar', 'الجزائر', NULL, NULL),
('6', 'en', 'egypt', NULL, NULL),
('7', 'en', 'soudia', NULL, NULL),
('8', 'en', 'tounis', NULL, NULL),
('9', 'en', 'libia', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
