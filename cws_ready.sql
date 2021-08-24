-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 24, 2021 at 05:55 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cws_ready`
--

-- --------------------------------------------------------

--
-- Table structure for table `back_dues`
--

CREATE TABLE `back_dues` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `remark` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `status` tinyint(1) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `back_dues`
--

INSERT INTO `back_dues` (`id`, `remark`, `amount`, `user_id`, `status`, `created_at`, `updated_at`) VALUES
(1, NULL, '900', 5, 0, '2021-08-02 19:20:58', '2021-08-03 03:45:02');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `discount_price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `course_type` tinyint(4) NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `banner_image` varchar(2455) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `duration` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `featured` enum('yes','no') COLLATE utf8mb4_unicode_ci DEFAULT 'no',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `title`, `slug`, `price`, `discount_price`, `course_type`, `image`, `banner_image`, `duration`, `description`, `featured`, `created_at`, `updated_at`) VALUES
(1, 'Php & mysqli', 'php-mysqli', '1599', '1299', 0, '1623810511-php-mysqli.jpg', '1627930568-php-mysqli.png', '2', 'PHP is a general-purpose scripting language especially suited to web development. It was originally created by Danish-Canadian programmer Rasmus Lerdorf in 1994. The PHP reference implementation is no', 'yes', '2021-06-16 03:58:31', '2021-08-02 18:56:08'),
(2, 'Html & Css', 'html-css', '999', '699', 0, '1623813373-html-css.png', NULL, '1', 'HTML (the Hypertext Markup Language) and CSS (Cascading Style Sheets) are two of the core technologies for building Web pages. HTML provides the structure of the page, CSS the (visual and aural) layout', NULL, '2021-06-16 04:46:13', '2021-06-16 04:46:13'),
(3, 'Laravel', 'laravel', '1699', '1499', 1, '1623813796-laravel.png', '1627930655-laravel.png', '2', 'Laravel is a free, open-source PHP web framework, created by Taylor Otwell and intended for the development of web applications following the model–view–controller architectural pattern and based', 'yes', '2021-06-16 04:53:16', '2021-08-02 18:57:35'),
(4, 'React js', 'react-js', '1399', '2000', 0, '1623813870-react-js.png', NULL, '2', 'React is an open-source, front end, JavaScript library for building user interfaces or UI components. It is maintained by Facebook and a community of individual developers and companies. React can be', 'yes', '2021-06-16 04:54:30', '2021-06-16 04:54:30'),
(5, 'Python + WX Desktop APP Development', 'python-wx-desktop-app-development', '2599', '1899', 0, '1623816105-python-wx-desktop-app-development.png', NULL, '3', 'The Python logo is a trademark of the Python Software Foundation, which is responsible for defending against any damaging or confusing uses of the trademark. See the PSF Trademark Usage Policy. In gen', 'yes', '2021-06-16 05:31:45', '2021-06-16 05:31:45'),
(6, 'theory', 'theory', '1233', '1200', 1, '1627908307-theory.png', NULL, '2', 'dkfdjgfdjhdf', NULL, '2021-08-02 12:45:07', '2021-08-02 12:45:07');

-- --------------------------------------------------------

--
-- Table structure for table `enrolls`
--

CREATE TABLE `enrolls` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) DEFAULT NULL,
  `status` tinyint(1) DEFAULT 0,
  `payment` enum('installment','full','monthly') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `enrolls`
--

INSERT INTO `enrolls` (`id`, `user_id`, `course_id`, `order_id`, `status`, `payment`, `created_at`, `updated_at`) VALUES
(26, 3, 5, 10, 1, 'installment', '2021-08-02 14:39:45', '2021-08-02 14:41:39'),
(27, 3, 6, 11, 1, 'full', '2021-08-02 14:44:32', '2021-08-02 15:53:02'),
(28, 3, 1, 11, 1, 'full', '2021-08-02 14:44:49', '2021-08-02 15:53:02'),
(31, 5, 3, 12, 1, 'full', '2021-08-03 01:01:59', '2021-08-03 01:04:27'),
(33, 5, 4, 13, 1, 'installment', '2021-08-03 01:04:52', '2021-08-03 01:05:20');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2021_06_14_055535_create_courses_table', 1),
(5, '2021_06_16_145210_create_enrolls_table', 1),
(6, '2021_06_16_152535_create_paytms_table', 1),
(7, '2021_07_26_224906_create_site_settings_table', 2),
(8, '2021_07_28_231519_create_orders_table', 3),
(9, '2021_07_28_232212_create_workshops_table', 3),
(10, '2021_08_01_225536_create_workshop_enrolls_table', 4),
(11, '2021_08_03_003032_create_back_dues_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `ordered` tinyint(1) DEFAULT 0,
  `payment` enum('installment','full','monthly') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `ordered`, `payment`, `created_at`, `updated_at`) VALUES
(10, 3, 1, 'installment', '2021-08-02 14:39:45', '2021-08-02 14:41:39'),
(11, 3, 1, 'full', '2021-08-02 14:44:32', '2021-08-02 15:53:02'),
(12, 5, 1, 'full', '2021-08-03 00:59:43', '2021-08-03 01:04:27'),
(13, 5, 1, 'installment', '2021-08-03 01:04:52', '2021-08-03 01:05:21');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `paytms`
--

CREATE TABLE `paytms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` bigint(20) NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `fee` int(11) NOT NULL,
  `order_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `enroll_id` bigint(20) UNSIGNED DEFAULT NULL,
  `workshop_id` bigint(20) DEFAULT NULL,
  `back_dues_id` bigint(20) DEFAULT NULL,
  `transaction_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `paytms`
--

INSERT INTO `paytms` (`id`, `name`, `mobile`, `email`, `status`, `fee`, `order_id`, `user_id`, `enroll_id`, `workshop_id`, `back_dues_id`, `transaction_id`, `created_at`, `updated_at`) VALUES
(29, 'user', 9876543224, 'user@gmail.com', 1, 760, '999517', 3, 10, NULL, NULL, '20210802111212800110168906902865453', '2021-08-02 14:39:50', '2021-08-02 14:40:08'),
(30, 'user', 9876543224, 'user@gmail.com', 1, 100, '928108', 3, 10, NULL, NULL, '20210802111212800110168781802871786', '2021-08-02 14:41:09', '2021-08-02 14:41:39'),
(31, 'user', 9876543224, 'user@gmail.com', 1, 1000, '819006', 3, 11, NULL, NULL, '20210802111212800110168349002858365', '2021-08-02 14:45:00', '2021-08-02 14:45:22'),
(32, 'user', 9876543224, 'user@gmail.com', 0, 1000, '216999', 3, 11, NULL, NULL, '0', '2021-08-02 14:57:17', '2021-08-02 14:57:17'),
(33, 'user', 9876543224, 'user@gmail.com', 1, 1499, '845939', 3, 11, NULL, NULL, '20210802111212800110168783402871796', '2021-08-02 15:52:43', '2021-08-02 15:53:02'),
(34, 'Alok Kumar Kushwaha', 9113751193, 'kumaralok1884@gmail.com', 1, 1499, '109386', 5, 12, NULL, NULL, '20210803111212800110168873802852523', '2021-08-03 01:04:06', '2021-08-03 01:04:27'),
(35, 'Alok Kumar Kushwaha', 9113751193, 'kumaralok1884@gmail.com', 1, 800, '117220', 5, 13, NULL, NULL, '20210803111212800110168730802871479', '2021-08-03 01:05:01', '2021-08-03 01:05:20'),
(36, 'Alok Kumar Kushwaha', 9113751193, 'kumaralok1884@gmail.com', 0, 1400, 'Alok Kumar Kushwaha_54259', 5, NULL, NULL, NULL, '0', '2021-08-03 03:27:20', '2021-08-03 03:27:20'),
(37, 'Alok Kumar Kushwaha', 9113751193, 'kumaralok1884@gmail.com', 0, 1400, 'Alok Kumar Kushwaha_456504', 5, NULL, NULL, NULL, '0', '2021-08-03 03:27:31', '2021-08-03 03:27:31'),
(40, 'Alok Kumar Kushwaha', 9113751193, 'kumaralok1884@gmail.com', 0, 900, '421063', 5, NULL, NULL, 1, '0', '2021-08-03 03:45:28', '2021-08-03 03:45:28');

-- --------------------------------------------------------

--
-- Table structure for table `site_settings`
--

CREATE TABLE `site_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `facebook` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkedin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `github` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `favicon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `site_settings`
--

INSERT INTO `site_settings` (`id`, `facebook`, `linkedin`, `github`, `twitter`, `contact`, `email`, `address`, `about`, `logo`, `favicon`, `created_at`, `updated_at`) VALUES
(1, 'https://www.facebook.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1627321579.png', NULL, '2021-08-01 18:37:24');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mother_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `father_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `education` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dob` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` enum('0','1','2') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_type` enum('student','admin') COLLATE utf8mb4_unicode_ci DEFAULT 'student',
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `mother_name`, `father_name`, `contact`, `education`, `dob`, `gender`, `address`, `user_type`, `email`, `email_verified_at`, `password`, `image`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin', 'admin', '9876543210', 'admin', '2021-12-12', '0', 'admin', 'admin', 'admin@gmail.com', NULL, '$2y$10$N9ExutLBKlknPusknrTMaOQ30gQwMgi5079q0SzdkU8ke0Em7y9yi', NULL, NULL, '2021-06-20 18:22:27', '2021-08-01 18:35:07'),
(3, 'user w', 'user', 'user', '9876543224', 'user', '2021-06-28', '1', 'test', 'student', 'user@gmail.com', NULL, '$2y$10$j8jAEGeF70gX/Jw/UmtpmuXX4rZL1MFEfpS3k8SVRCy10m6wFnZxW', '1627928063.png', NULL, '2021-06-20 18:49:37', '2021-08-02 18:14:23'),
(4, 'user', 'user', 'user', '9878988768', 'user', '2021-06-22', '0', 'user', 'student', 'user1@gmail.com', NULL, '$2y$10$QTV0/ktxovP0Bzm.yii61OArOHn6e0pur4HRCLwCmfP3u6Vppwy/q', '1624339701.png', NULL, '2021-06-22 05:28:21', '2021-06-22 05:28:21'),
(5, 'Alok Kumar Kushwaha', 'upendra kushwaha', 'anita devi', '9113751193', 'bca', '1998-12-26', '0', 'Manjhali chowk near madhubani bazaar', 'student', 'kumaralok1884@gmail.com', NULL, '$2y$10$92Hfb9QgEeKEsDTzeQi8repEeBcVhmJzWsF1YRn/oyEPcIS3HEVZe', '1627932058.jpg', NULL, '2021-08-02 19:20:58', '2021-08-02 19:20:58');

-- --------------------------------------------------------

--
-- Table structure for table `workshops`
--

CREATE TABLE `workshops` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `event_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fee` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `workshops`
--

INSERT INTO `workshops` (`id`, `title`, `description`, `event_date`, `last_date`, `fee`, `time`, `image`, `created_at`, `updated_at`) VALUES
(5, 'Laravel foodie', 'Food delivery system with online payment', '2021-08-08', '2021-08-10', '100', '12:32', '1627931040.png', '2021-08-02 19:04:00', '2021-08-02 19:04:00');

-- --------------------------------------------------------

--
-- Table structure for table `workshop_enrolls`
--

CREATE TABLE `workshop_enrolls` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `payment_id` bigint(20) UNSIGNED NOT NULL,
  `workshop_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `back_dues`
--
ALTER TABLE `back_dues`
  ADD PRIMARY KEY (`id`),
  ADD KEY `back_dues_user_id_foreign` (`user_id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enrolls`
--
ALTER TABLE `enrolls`
  ADD PRIMARY KEY (`id`),
  ADD KEY `enrolls_user_id_foreign` (`user_id`),
  ADD KEY `enrolls_course_id_foreign` (`course_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `paytms`
--
ALTER TABLE `paytms`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `paytms_order_id_unique` (`order_id`),
  ADD KEY `paytms_enroll_id_foreign` (`enroll_id`),
  ADD KEY `paytms_user_id_foreign` (`user_id`);

--
-- Indexes for table `site_settings`
--
ALTER TABLE `site_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `workshops`
--
ALTER TABLE `workshops`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `workshop_enrolls`
--
ALTER TABLE `workshop_enrolls`
  ADD PRIMARY KEY (`id`),
  ADD KEY `workshop_enrolls_user_id_foreign` (`user_id`),
  ADD KEY `workshop_enrolls_payment_id_foreign` (`payment_id`),
  ADD KEY `workshop_enrolls_workshop_id_foreign` (`workshop_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `back_dues`
--
ALTER TABLE `back_dues`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `enrolls`
--
ALTER TABLE `enrolls`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `paytms`
--
ALTER TABLE `paytms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `site_settings`
--
ALTER TABLE `site_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `workshops`
--
ALTER TABLE `workshops`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `workshop_enrolls`
--
ALTER TABLE `workshop_enrolls`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `back_dues`
--
ALTER TABLE `back_dues`
  ADD CONSTRAINT `back_dues_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `enrolls`
--
ALTER TABLE `enrolls`
  ADD CONSTRAINT `enrolls_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`),
  ADD CONSTRAINT `enrolls_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `paytms`
--
ALTER TABLE `paytms`
  ADD CONSTRAINT `paytms_enroll_id_foreign` FOREIGN KEY (`enroll_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `paytms_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `workshop_enrolls`
--
ALTER TABLE `workshop_enrolls`
  ADD CONSTRAINT `workshop_enrolls_payment_id_foreign` FOREIGN KEY (`payment_id`) REFERENCES `paytms` (`id`),
  ADD CONSTRAINT `workshop_enrolls_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `workshop_enrolls_workshop_id_foreign` FOREIGN KEY (`workshop_id`) REFERENCES `workshops` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
