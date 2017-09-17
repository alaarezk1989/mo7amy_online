-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 04, 2017 at 04:02 PM
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
-- Table structure for table `cases`
--

CREATE TABLE `cases` (
  `GUID` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_GUID` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `finished_date` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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

-- --------------------------------------------------------

--
-- Table structure for table `ltm_translations`
--

CREATE TABLE `ltm_translations` (
  `id` int(10) UNSIGNED NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `locale` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `group` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(115, '2014_04_02_193005_create_translations_table', 1),
(116, '2014_10_12_000000_create_users_table', 1),
(117, '2014_10_12_100000_create_password_resets_table', 1),
(118, '2017_08_21_125236_create_cases_table', 1),
(119, '2017_08_22_101749_create_countries_table', 1),
(120, '2017_08_22_115052_create_cities_table', 1),
(121, '2017_08_23_113042_create_user_specialty_table', 1),
(122, '2017_08_23_113310_user_specialty_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `career` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_description` text COLLATE utf8mb4_unicode_ci,
  `birthdate` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` enum('male','female') COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `permissions` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `image`, `career`, `short_description`, `birthdate`, `country`, `city`, `phone`, `gender`, `status`, `permissions`, `remember_token`, `created_at`, `updated_at`) VALUES
('20170827162034862418263', 'alaa lawyer7', 'alaa_law7@lodex.com', '$2y$10$V9HhrM6CcjtdTTZzmUmdc.3bHQLxNufEbpGLDdt/hqUPkOJbYHpPS', NULL, NULL, NULL, NULL, 'EG', 'ALX', '0122222222220', 'male', 1, 'lawyer', NULL, '2017-08-27 14:20:34', '2017-08-27 14:20:34'),
('201708271623521473146097', 'alaa lawyer8', 'alaa_law8@lodex.com', '$2y$10$DzX02k7EvuxEAjpqj1n3weS7FIhuRP3WYhF7s0O0AIhIJJcatRCz2', NULL, NULL, NULL, NULL, 'EG', 'ALX', '0122222222220', 'male', 1, 'lawyer', NULL, '2017-08-27 14:23:52', '2017-08-27 14:23:52'),
('201708271625221255585498', 'alaa lawyer9', 'alaa_law9@lodex.com', '$2y$10$DzX02k7EvuxEAjpqj1n3weS7FIhuRP3WYhF7s0O0AIhIJJcatRCz2', NULL, NULL, NULL, NULL, 'EG', 'ALX', '0122222222220', 'male', 1, 'lawyer', NULL, '2017-08-27 14:25:22', '2017-08-27 14:25:22'),
('201708271626521302361143', 'alaa lawyer10', 'alaa_law10@lodex.com', '$2y$10$DzX02k7EvuxEAjpqj1n3weS7FIhuRP3WYhF7s0O0AIhIJJcatRCz2', NULL, NULL, NULL, NULL, 'EG', 'ALX', '0122222222220', 'female', 1, 'lawyer', NULL, '2017-08-27 14:26:52', '2017-08-27 14:26:52'),
('20170827163310323857194', 'alaa lawyer12', 'alaa_law12@lodex.com', '$2y$10$KZw4aV36Pl3RSvQPJosm9.4qUUQYlcLxgLLKioqr1jjVdtPvYw9jm', NULL, NULL, NULL, NULL, 'EG', 'ALX', '0122222222220', 'female', 1, 'lawyer', NULL, '2017-08-27 14:33:10', '2017-08-27 14:33:10'),
('59a2eebfc5dc54.87270917', 'alaa lawyer1', 'alaa_law1@lodex.com', '$2y$10$hqvtY/l84s2Wgz.Tpapj6.6/HZ47TOBTgHo4u/msZ0SrbzlsaBowO', NULL, NULL, NULL, NULL, 'EG', 'ALX', '1234567890', 'male', 1, 'lawyer', 'kylP8i0kU6ebQqyxeZNUlPn4XUU0GLnUPCM27L0pD4BeFnwCSWAU0tTyIyET', '2017-08-27 14:09:35', '2017-08-27 14:09:35'),
('59a2ef414d9889.84712569', 'alaa lawyer2', 'alaa_law2@lodex.com', '$2y$10$bqYKWzj3On4FVI6D7a9heOjJNWy3rphd4PqQEupBSyws8Bx6azzJK', NULL, NULL, NULL, NULL, 'EG', 'ALX', '12345678900', 'male', 1, 'lawyer', NULL, '2017-08-27 14:11:45', '2017-08-27 14:11:45'),
('59a2efb0ef1f70.58705895', 'alaa lawyer3', 'alaa_law3@lodex.com', '$2y$10$CLjqtge3VvBNqLF90AQqzu6ueupWDlrUFQsTraFyPkn92ppZX2yY2', NULL, NULL, NULL, NULL, 'EG', 'ALX', '12345678900', 'male', 1, 'lawyer', NULL, '2017-08-27 14:13:37', '2017-08-27 14:13:37'),
('59a2eff4cd7094.31509222', 'alaa lawyer4', 'alaa_law4@lodex.com', '$2y$10$11sDIZLny2YOBv4C57IWtOz46YM7lQY0w0bhDpm.DL4VtfM37hoxq', NULL, NULL, NULL, NULL, 'EG', 'ALX', '12345678900', 'male', 1, 'lawyer', NULL, '2017-08-27 14:14:44', '2017-08-27 14:14:44'),
('59a2f071aa58e4.51621880', 'alaa lawyer5', 'alaa_law5@lodex.com', '$2y$10$1tNR80KcHt3uqaTdlEOVs.2ha32oQAp0pycx81KacKJ32y/LzpvxO', NULL, NULL, NULL, NULL, 'EG', 'ALX', '12345678900', 'male', 1, 'lawyer', NULL, '2017-08-27 14:16:49', '2017-08-27 14:16:49'),
('59a2f1141a4b99.19238716', 'alaa lawyer6', 'alaa_law6@lodex.com', '$2y$10$DzX02k7EvuxEAjpqj1n3weS7FIhuRP3WYhF7s0O0AIhIJJcatRCz2', NULL, NULL, NULL, NULL, 'EG', 'ALX', '0122222222220', 'male', 1, 'lawyer', NULL, '2017-08-27 14:19:32', '2017-08-27 14:19:32'),
('59a2f3f363fb37.45182879', 'alaa lawyer11', 'alaa_law11@lodex.com', '$2y$10$MyJs2Dx/nonAFnM5/CsOg.h5OAu1RKe3wXoOQfXBP0GA/cD/CZmg2', NULL, NULL, NULL, NULL, 'EG', 'ALX', '0122222222220', 'female', 1, 'lawyer', NULL, '2017-08-27 14:31:47', '2017-08-27 14:31:47'),
('59a2f4aed07c43.03333211', 'alaa lawyer13', 'alaa_law13@lodex.com', '$2y$10$V9HhrM6CcjtdTTZzmUmdc.3bHQLxNufEbpGLDdt/hqUPkOJbYHpPS', '201709040934471968556140_user_img.png', 'محامى بمحكمة النقض العليا', 'خسائر اللازمة ومطالبة حدة بل. الآخر الحلفاء أن غزو, إجلاء وتنامت عدد مع. لقهر معركة لبلجيكا، بـ انه, ربع الأثنان المقيتة في, اقتصّت المحور حدة و. هذه ما طرفاً عالمية استسلام, الصين وتنامت حين 30, ونتج والحزب المذابح كل جوي. أسر كارثة المشتّتون بل, وبعض وبداية الصفحة غزو قد, أي بحث تعداد الجنب. قصف المسرح واستمر الإتحاد في, ذات أسيا للغزو، الخطّة و, الآخر لألمانيا جهة بل. في سحقت هيروشيما البريطاني يتم, غريمه باحتلال\r\n\r\nخسائر اللازمة ومطالبة حدة بل. الآخر الحلفاء أن غزو, إجلاء وتنامت عدد مع. لقهر معركة لبلجيكا، بـ انه, ربع الأثنان المقيتة في, اقتصّت المحور حدة و. هذه ما طرفاً عالمية استسلام, الصين وتنامت حين 30, ونتج والحزب المذابح كل جوي. أسر كارثة المشتّتون بل, وبعض وبداية الصفحة غزو قد, أي بحث تعداد الجنوبقصف المسرح واستمر الإتحاد في, ذات أسيا للغزو، الخطّة و, الآخر لألمانيا جهة بل. في سحقت هيروشيما البريطاني يتم, غريمه', '07/25/1989', '1', '1', '0122222222220', 'female', 1, 'lawyer', NULL, '2017-08-27 14:34:54', '2017-09-04 07:34:47');

-- --------------------------------------------------------

--
-- Table structure for table `user_specialty`
--

CREATE TABLE `user_specialty` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `specialty` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_specialty`
--

INSERT INTO `user_specialty` (`id`, `user_id`, `specialty`, `created_at`, `updated_at`) VALUES
('59ad1e37d017e5.12440245', '59a2f4aed07c43.03333211', 'family', '2017-09-04 07:34:47', '2017-09-04 07:34:47'),
('59ad1e37dab5b6.52948828', '59a2f4aed07c43.03333211', 'commercial', '2017-09-04 07:34:47', '2017-09-04 07:34:47'),
('59ad1e37f06bf7.88592336', '59a2f4aed07c43.03333211', 'management', '2017-09-04 07:34:47', '2017-09-04 07:34:47');

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

--
-- Indexes for table `ltm_translations`
--
ALTER TABLE `ltm_translations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_specialty`
--
ALTER TABLE `user_specialty`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ltm_translations`
--
ALTER TABLE `ltm_translations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
