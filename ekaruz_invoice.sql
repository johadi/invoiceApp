-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 06, 2017 at 05:07 PM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ekaruz_invoice`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'admin',
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `type`, `username`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'johadi', '$2y$10$o/nJumvO3A8bNkDN8DzRj.3q6qssqbn.1yv8wkMnddzNqzXKk.WeO', 'q82GIJvrXb1xLayg8Pxvj8msB0jsUUARQMgyDmbta7Y5yniq8sdEea9sZi0n', '2017-06-04 22:31:15', '2017-06-04 22:31:15');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `first_name`, `last_name`, `email`, `phone1`, `phone2`, `company_name`, `company_address`, `gender`, `created_at`, `updated_at`) VALUES
(1, 'jimoh', 'hadi', 'jimoh.hadi@gmail.com', '08163041269', '08100112233', 'Jimoh hadi Computers', '18 Adekunle treet oshodi Lagos', 'Male', '2017-06-04 22:33:43', '2017-06-04 22:33:43'),
(2, 'Lawal', 'Abdulkadir', 'lawalkadir@gmail.com', '08163041267', '08176547865', 'Lawal Sons Company', '23 Minna road, Niger', 'Male', '2017-06-04 22:35:02', '2017-06-04 22:35:02'),
(3, 'Sherif', 'Adavuruku', 'sherif@gmail.com', '08163043578', '08176500524', 'Sherif global ltd', '28 imo estate, Ajaokuta,Kogi', 'Male', '2017-06-04 22:36:31', '2017-06-04 22:36:31'),
(4, 'Okafor', 'Emmanuel', 'emma@gmail.com', '08163041267', '08176902345', 'Emma Nigeria PLC', '12 Irawo owuro street ,Alimosho ,Lagos', 'Male', '2017-06-06 15:01:25', '2017-06-06 15:01:25');

-- --------------------------------------------------------

--
-- Table structure for table `ekaruzs`
--

CREATE TABLE `ekaruzs` (
  `id` int(10) UNSIGNED NOT NULL,
  `phone1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `street_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `town_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state_address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `ekaruzs`
--

INSERT INTO `ekaruzs` (`id`, `phone1`, `phone2`, `email`, `street_address`, `town_address`, `state_address`, `created_at`, `updated_at`) VALUES
(1, '08163041269', '09045789645', 'support@ekaruz.com', '14 Oyedele street', 'Alimosho', 'Lagos', '2017-06-04 23:28:36', '2017-06-04 23:28:36');

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` int(10) UNSIGNED NOT NULL,
  `invoice_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `ekaruz_id` int(11) NOT NULL,
  `due_date` date NOT NULL DEFAULT '2017-06-04',
  `completed` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `invoice_number`, `payment_method`, `client_id`, `admin_id`, `ekaruz_id`, `due_date`, `completed`, `created_at`, `updated_at`) VALUES
(2, '123443211', 'Mobile Banking', 3, 1, 1, '2017-07-25', 1, '2017-06-05 09:28:35', '2017-06-05 22:30:09'),
(5, '1530868031', '', 0, 0, 0, '2017-06-04', 0, '2017-06-06 07:49:09', '2017-06-06 07:49:09'),
(8, '1091827055', '', 0, 0, 0, '2017-06-04', 0, '2017-06-06 09:40:29', '2017-06-06 09:40:29'),
(9, '763763663', 'Cash Deposit', 2, 1, 1, '2017-06-24', 1, '2017-06-06 09:55:27', '2017-06-06 11:07:46'),
(10, '1743458435', '', 0, 0, 0, '2017-06-04', 0, '2017-06-06 11:06:18', '2017-06-06 11:06:18'),
(11, '1999841414', '', 0, 0, 0, '2017-06-04', 0, '2017-06-06 11:07:21', '2017-06-06 11:07:21');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `title`, `description`, `price`, `quantity`, `total`, `invoice_id`, `created_at`, `updated_at`) VALUES
(2, 'React Application', 'Kaban React development with notes', 1500, 13, 19500, 2, '2017-06-05 09:30:16', '2017-06-05 09:30:16'),
(3, 'Hosting', 'The react app hosting', 200, 1, 200, 2, '2017-06-05 09:31:13', '2017-06-05 09:31:13'),
(4, 'Domain (1 year)', 'Buying the domain name for one year', 100, 12, 1200, 2, '2017-06-05 09:32:15', '2017-06-05 09:32:15'),
(5, 'Web Application', 'Ecommerce website design', 1000, 2, 2000, 3, '2017-06-05 09:49:21', '2017-06-05 09:49:21'),
(7, 'Laravel App', 'web app by Laravel', 1300, 2, 2600, 2, '2017-06-05 22:11:59', '2017-06-05 22:11:59'),
(8, 'React', 'React App dev', 300, 6, 1800, 2, '2017-06-05 22:21:03', '2017-06-05 22:21:03'),
(9, 'Tech', 'Web maintenance', 3500, 1, 3500, 2, '2017-06-05 22:22:44', '2017-06-05 22:22:44'),
(14, 'Desktop Application', 'Chat Application', 2500, 2, 5000, 9, '2017-06-06 09:56:14', '2017-06-06 09:56:14');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_admins_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2017_06_02_173651_create_clients_table', 1),
(4, '2017_06_02_173857_create_items_table', 1),
(5, '2017_06_02_174005_create_invoices_table', 1),
(6, '2017_06_02_174105_create_ekaruzs_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_username_unique` (`username`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `clients_email_unique` (`email`);

--
-- Indexes for table `ekaruzs`
--
ALTER TABLE `ekaruzs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ekaruzs_email_unique` (`email`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `ekaruzs`
--
ALTER TABLE `ekaruzs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
