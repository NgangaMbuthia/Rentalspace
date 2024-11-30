-- phpMyAdmin SQL Dump
-- version 4.6.4deb1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 07, 2017 at 02:03 PM
-- Server version: 5.7.18-0ubuntu0.16.10.1
-- PHP Version: 7.0.18-0ubuntu0.16.10.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `realestate`
--

-- --------------------------------------------------------

--
-- Table structure for table `agents`
--

CREATE TABLE `agents` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `auth_key` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `validity_in_months` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '12',
  `expiry_date` date DEFAULT NULL,
  `status` enum('Pending','Approved','Suspended','Expired') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telephone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_person` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `postal_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `street` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `town` varchar(11) COLLATE utf8_unicode_ci DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `agents`
--

INSERT INTO `agents` (`id`, `user_id`, `auth_key`, `validity_in_months`, `expiry_date`, `status`, `created_at`, `updated_at`, `deleted_at`, `name`, `telephone`, `email`, `contact_person`, `postal_address`, `street`, `town`) VALUES
(1, 2, 'mVxSrwlhv2fT9485ojG6nGdtEwb4To7b6nNv1twgHDnJa876zW1eFqpVaRIqzUZtO', '12', '2018-04-15', 'Approved', '2017-04-15 10:05:23', '2017-04-16 10:15:26', NULL, 'Qooetu  companies ', '+254708236804', 'hisanyad@gmail.com', NULL, '4296-30200', '2018-04-15', 'Nairobi'),
(5, 57, '3cjGdedCixtQ9E4uvzfQ2oE6dSmpFFr4GCcP1ZYsUKWHGkvfbJ4848XIoSUayMmkQ', '12', '2018-04-30', 'Approved', '2017-04-30 20:16:30', '2017-04-30 20:16:30', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(6, 64, 'fNh4Vsp5FYIUS9qxd7moenu9WrkItNfElexOAvwYFG6PYGfjpNUGlYyZXKeXsP6tL', '12', '2018-04-30', 'Approved', '2017-04-30 20:25:10', '2017-04-30 20:25:10', NULL, 'Khetias  Kitale', '+254708236804', 'kam@gmial.com', NULL, '4296-30200', NULL, 'Kisumu');

-- --------------------------------------------------------

--
-- Table structure for table `amentities`
--

CREATE TABLE `amentities` (
  `id` int(10) UNSIGNED NOT NULL,
  `property_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `amentities`
--

INSERT INTO `amentities` (`id`, `property_id`, `name`, `created_at`, `updated_at`) VALUES
(8, 1, 'On-site laundry', '2017-04-15 14:52:47', '2017-04-15 14:52:47'),
(9, 1, 'Dishwasher', '2017-04-15 14:52:47', '2017-04-15 14:52:47'),
(10, 2, 'In-unit laundry', '2017-04-15 15:19:54', '2017-04-15 15:19:54'),
(11, 2, 'On-site laundry', '2017-04-15 15:19:54', '2017-04-15 15:19:54'),
(12, 2, 'Security', '2017-04-15 15:19:54', '2017-04-15 15:19:54'),
(13, 2, 'Air Conditioning', '2017-04-15 15:19:54', '2017-04-15 15:19:54'),
(14, 2, 'Dishwasher', '2017-04-15 15:19:54', '2017-04-15 15:19:54'),
(15, 2, 'Natural lighting', '2017-04-15 15:19:54', '2017-04-15 15:19:54'),
(16, 3, 'In-unit laundry', '2017-04-30 20:07:12', '2017-04-30 20:07:12'),
(17, 3, 'On-site laundry', '2017-04-30 20:07:12', '2017-04-30 20:07:12'),
(18, 3, 'Security', '2017-04-30 20:07:12', '2017-04-30 20:07:12'),
(19, 3, 'Air Conditioning', '2017-04-30 20:07:12', '2017-04-30 20:07:12'),
(20, 3, 'Balcony', '2017-04-30 20:07:12', '2017-04-30 20:07:12'),
(21, 3, 'Dishwasher', '2017-04-30 20:07:12', '2017-04-30 20:07:12'),
(22, 3, 'Natural lighting', '2017-04-30 20:07:12', '2017-04-30 20:07:12'),
(23, 3, 'Outdoor space', '2017-04-30 20:07:12', '2017-04-30 20:07:12'),
(24, 3, 'TV Cable', '2017-04-30 20:07:12', '2017-04-30 20:07:12'),
(25, 3, 'Storage', '2017-04-30 20:07:12', '2017-04-30 20:07:12'),
(26, 3, 'Assigned parking Lots', '2017-04-30 20:07:12', '2017-04-30 20:07:12'),
(27, 3, 'Shared amenities (pool, fitness center)', '2017-04-30 20:07:12', '2017-04-30 20:07:12'),
(28, 4, 'In-unit laundry<', '2017-04-30 20:51:42', '2017-04-30 20:51:42'),
(29, 4, 'On-site laundry', '2017-04-30 20:51:42', '2017-04-30 20:51:42'),
(30, 4, 'Security', '2017-04-30 20:51:42', '2017-04-30 20:51:42'),
(31, 4, 'Air Conditioning', '2017-04-30 20:51:42', '2017-04-30 20:51:42'),
(32, 4, 'Balcony', '2017-04-30 20:51:42', '2017-04-30 20:51:42'),
(33, 4, 'Dishwasher', '2017-04-30 20:51:42', '2017-04-30 20:51:42'),
(34, 4, 'Natural lighting', '2017-04-30 20:51:42', '2017-04-30 20:51:42'),
(35, 4, 'Outdoor space', '2017-04-30 20:51:42', '2017-04-30 20:51:42'),
(36, 4, 'TV Cable', '2017-04-30 20:51:42', '2017-04-30 20:51:42'),
(37, 4, 'Garden', '2017-04-30 20:51:42', '2017-04-30 20:51:42'),
(38, 4, 'Storage', '2017-04-30 20:51:42', '2017-04-30 20:51:42'),
(39, 4, 'Assigned parking Lots', '2017-04-30 20:51:42', '2017-04-30 20:51:42'),
(40, 4, 'Shared amenities (pool, fitness center)', '2017-04-30 20:51:42', '2017-04-30 20:51:42');

-- --------------------------------------------------------

--
-- Table structure for table `bulk_groups`
--

CREATE TABLE `bulk_groups` (
  `id` int(10) UNSIGNED NOT NULL,
  `group_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `owner_id` int(11) DEFAULT NULL,
  `owner_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `bulk_groups`
--

INSERT INTO `bulk_groups` (`id`, `group_name`, `owner_id`, `owner_type`, `created_at`, `updated_at`) VALUES
(1, 'Monterey Villa and Apartments ', 1, 'Provider', '2017-04-15 15:19:44', '2017-04-15 16:02:56'),
(2, 'Rose Kamau Wanjiku', 1, 'Provider', '2017-04-15 16:16:59', '2017-04-15 16:16:59'),
(3, 'Gate Guards', 1, 'Provider', '2017-04-15 16:18:31', '2017-04-15 16:18:31'),
(8, 'Auroville apartments', 1, 'Provider', '2017-04-15 19:33:06', '2017-04-15 19:33:06'),
(9, 'Block A ', 1, 'Provider', '2017-04-15 20:46:32', '2017-04-15 20:46:32'),
(10, 'Block B', 1, 'Provider', '2017-04-15 20:52:57', '2017-04-15 20:52:57'),
(11, 'Ngong Road Apartment', 1, 'Provider', '2017-04-30 20:07:10', '2017-04-30 20:07:10'),
(12, 'Rose Villa Apartments', 1, 'Provider', '2017-04-30 20:51:40', '2017-04-30 20:51:40');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `scope` enum('global','local') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'local',
  `provider_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `deleted_at`, `created_at`, `updated_at`, `display_name`, `scope`, `provider_id`) VALUES
(1, 'Residential Standalone', NULL, NULL, '2017-04-15 08:06:58', '2017-04-15 08:06:58', NULL, 'global', NULL),
(2, 'Commercial residential property', NULL, NULL, '2017-04-15 08:06:58', '2017-04-15 08:06:58', NULL, 'global', NULL),
(3, 'Commercial business building', NULL, NULL, '2017-04-15 08:06:59', '2017-04-15 08:06:59', NULL, 'global', NULL),
(4, 'Commercial Residentals', NULL, NULL, '2017-04-15 10:11:58', '2017-04-15 10:11:58', NULL, 'local', 1);

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(10) UNSIGNED NOT NULL,
  `group_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `alt_phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `send_status` enum('Active','Inactive') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `group_id`, `name`, `email`, `mobile`, `alt_phone`, `send_status`, `created_at`, `updated_at`) VALUES
(2, 1, 'Rose Njeri Kamwea', 'njeri@gmail.com', '+254712794691', '+254712794691', 'Inactive', '2017-04-15 18:58:18', '2017-04-15 18:58:18'),
(6, 8, 'Mary Bosire', 'hisanyad@gmail.com', '+254708236804', NULL, 'Inactive', '2017-04-15 19:33:06', '2017-04-15 19:33:06'),
(36, 9, 'John Peter', 'john@gmail.com', '+2547000000', '+254790000', 'Inactive', '2017-04-15 21:23:03', '2017-04-15 21:23:03'),
(37, 9, 'Peter John', 'perer@mail.com ', '+254722334456', '+254767777', 'Inactive', '2017-04-15 21:23:03', '2017-04-15 21:23:03'),
(38, 9, 'Mary John', 'mary@gmail.com', '+254700121212', '4674748', 'Inactive', '2017-04-15 21:23:03', '2017-04-15 21:23:03'),
(39, 10, 'Grace Marks', 'grace@g.com', '+254708236804', NULL, 'Inactive', '2017-04-15 21:23:03', '2017-04-15 21:23:03'),
(40, 10, 'Vitalis Simon', 'vitalis@gmail.com', '+254708236804', '6776', 'Inactive', '2017-04-15 21:23:03', '2017-04-15 21:23:03'),
(49, 1, 'Isanya Hillary', 'hisanyad@gmail.com', '+254708236804', '+254708236804', 'Inactive', '2017-04-17 16:27:46', '2017-04-17 16:27:46'),
(50, 8, 'Stephen Mwaura', 'stephen.mwaura@ict.go.ke', '+356666666666', NULL, 'Inactive', '2017-04-17 20:37:47', '2017-04-17 20:37:47');

-- --------------------------------------------------------

--
-- Table structure for table `deposits`
--

CREATE TABLE `deposits` (
  `id` int(10) UNSIGNED NOT NULL,
  `tenant_id` int(10) UNSIGNED NOT NULL,
  `amount` double NOT NULL DEFAULT '0',
  `status` enum('Unpaid','Paid','Refunded') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Unpaid',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `deposits`
--

INSERT INTO `deposits` (`id`, `tenant_id`, `amount`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 14, 2500, 'Unpaid', '2017-04-15 19:33:07', '2017-04-15 19:33:07', NULL),
(3, 15, 2500, 'Unpaid', '2017-04-17 20:37:47', '2017-04-17 20:37:47', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `directors`
--

CREATE TABLE `directors` (
  `id` int(10) UNSIGNED NOT NULL,
  `supplier_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `identification` enum('National ID','Passport Number') COLLATE utf8_unicode_ci DEFAULT NULL,
  `identifaction_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `emergency_contacts`
--

CREATE TABLE `emergency_contacts` (
  `id` int(10) UNSIGNED NOT NULL,
  `tenant_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `relationship` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'spouse',
  `postal_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `postal_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `emergency_contacts`
--

INSERT INTO `emergency_contacts` (`id`, `tenant_id`, `name`, `relationship`, `postal_address`, `postal_code`, `email`, `phone`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 14, 'Isanya Hillary', 'Spouse', '30200', '30200', 'hghggh@ggg.vom', '+35-65-3636-5366', '2017-04-15 19:33:07', '2017-04-15 19:33:07', NULL),
(3, 15, 'Simon Saitoti', 'Brother', '30200', '30200', 'dkjkjd', '+54-44-4444-4444', '2017-04-17 20:37:47', '2017-04-17 20:37:47', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `employed_tenants`
--

CREATE TABLE `employed_tenants` (
  `id` int(10) UNSIGNED NOT NULL,
  `tenant_id` int(10) UNSIGNED NOT NULL,
  `employer_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `job_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `contact_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `contact_phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'Pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `employed_tenants`
--

INSERT INTO `employed_tenants` (`id`, `tenant_id`, `employer_name`, `job_title`, `contact_name`, `contact_phone`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 14, 'Geecko Group Holdings Limited', 'Software Developer', 'Timothy Njue', '+45-45-6565-5665', 'Pending', '2017-04-15 19:33:07', '2017-04-15 19:33:07', NULL),
(3, 15, 'ICTA', 'Web designer', 'Patrick Omari', '+67-37-7848-7487', 'Pending', '2017-04-17 20:37:47', '2017-04-17 20:37:47', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `EventCodes`
--

CREATE TABLE `EventCodes` (
  `id` int(11) NOT NULL,
  `DeviceTypeId` int(11) NOT NULL,
  `DeviceEventId` int(11) NOT NULL,
  `DeviceEventName` varchar(255) NOT NULL,
  `EventName` varchar(255) NOT NULL,
  `EventId` varchar(11) DEFAULT NULL,
  `EventCodeId` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `EventCodes`
--

INSERT INTO `EventCodes` (`id`, `DeviceTypeId`, `DeviceEventId`, `DeviceEventName`, `EventName`, `EventId`, `EventCodeId`, `created_at`, `updated_at`) VALUES
(1, 1, 0, 'Location Reply', 'Location Reply', 'NULL', 1, '2017-04-21 09:43:41', '2017-04-21 12:43:41'),
(3, 1, 1, 'Log position', 'Log position', 'NULL', 2, '2017-04-21 09:43:52', '2017-04-21 12:43:52'),
(4, 1, 2, 'Auto Reply', 'Auto Reply', 'NULL', 3, '2017-04-21 09:43:52', '2017-04-21 12:43:52'),
(5, 1, 3, 'Timer Report', 'Timer Report', 'NULL', 4, '2017-04-21 09:43:52', '2017-04-21 12:43:52'),
(6, 1, 8, 'Speeding report position', 'Speeding report position', 'NULL', 5, '2017-04-21 09:43:52', '2017-04-21 12:43:52'),
(7, 1, 9, 'Vehicle towed report', 'Vehicle towed report', 'NULL', 6, '2017-04-21 09:43:52', '2017-04-21 12:43:52'),
(8, 1, 11, 'Input1', 'Input1', 'NULL', 7, '2017-04-21 09:43:52', '2017-04-21 12:43:52'),
(9, 1, 12, 'Input2', 'Input2', 'NULL', 8, '2017-04-21 09:43:52', '2017-04-21 12:43:52'),
(10, 1, 13, 'Input3', 'Input3', 'NULL', 9, '2017-04-21 09:43:52', '2017-04-21 12:43:52'),
(11, 1, 14, 'Input4', 'Input4', 'NULL', 10, '2017-04-21 09:43:52', '2017-04-21 12:43:52'),
(12, 1, 21, 'RFID report', 'RFID report', 'NULL', 11, '2017-04-21 09:43:52', '2017-04-21 12:43:52'),
(13, 1, 30, 'SOS position', 'SOS position', 'NULL', 12, '2017-04-21 09:43:53', '2017-04-21 12:43:53'),
(14, 1, 35, 'Barcode Scanner (8110)', 'Barcode Scanner (8110)', 'NULL', 13, '2017-04-21 09:43:53', '2017-04-21 12:43:53'),
(15, 1, 40, 'Main power low report', 'Main power low report', 'NULL', 14, '2017-04-21 09:43:53', '2017-04-21 12:43:53'),
(16, 1, 41, 'Main power lose report', 'Main power lose report', 'NULL', 15, '2017-04-21 09:43:53', '2017-04-21 12:43:53'),
(17, 1, 42, 'Backup battery low report', 'Backup battery low report', 'NULL', 16, '2017-04-21 09:43:53', '2017-04-21 12:43:53'),
(18, 1, 43, 'GPS destroyed report', 'GPS destroyed report', 'NULL', 17, '2017-04-21 09:43:53', '2017-04-21 12:43:53'),
(19, 1, 60, 'IDLE starts', 'IDLE starts', 'NULL', 18, '2017-04-21 09:43:53', '2017-04-21 12:43:53'),
(20, 1, 61, 'IDLE ends   ', 'IDLE ends   ', 'NULL', 19, '2017-04-21 09:43:53', '2017-04-21 12:43:53'),
(21, 1, 110, 'Ignition Off', 'Ignition Off', '1', 20, '2017-04-21 09:43:53', '2017-04-21 12:43:53'),
(22, 1, 111, 'Ignition On', 'Ignition On', '2', 21, '2017-04-21 09:43:53', '2017-04-21 12:43:53'),
(23, 1, 120, 'Door Closed', 'Door Closed', '3', 22, '2017-04-21 09:43:53', '2017-04-21 12:43:53'),
(24, 1, 121, 'Door Opened', 'Door Opened', '4', 23, '2017-04-21 09:43:53', '2017-04-21 12:43:53'),
(25, 2, 0, 'Location Reply', 'Location Reply', 'NULL', 24, '2017-04-21 09:43:53', '2017-04-21 12:43:53'),
(26, 2, 1, 'Log position', 'Log position', 'NULL', 25, '2017-04-21 09:43:53', '2017-04-21 12:43:53'),
(27, 2, 2, 'Auto Reply', 'Auto Reply', 'NULL', 26, '2017-04-21 09:43:53', '2017-04-21 12:43:53'),
(28, 2, 11, 'Ignition (ACC) Status', 'Ignition (ACC) Status', 'NULL', 27, '2017-04-21 09:43:53', '2017-04-21 12:43:53'),
(29, 2, 12, 'Input1', 'Input1', 'NULL', 28, '2017-04-21 09:43:53', '2017-04-21 12:43:53'),
(30, 2, 13, 'Input2', 'Input2', 'NULL', 29, '2017-04-21 09:43:53', '2017-04-21 12:43:53'),
(31, 2, 14, 'Input3', 'Input3', 'NULL', 30, '2017-04-21 09:43:53', '2017-04-21 12:43:53'),
(32, 2, 15, 'Input4', 'Input4', 'NULL', 31, '2017-04-21 09:43:53', '2017-04-21 12:43:53'),
(33, 2, 16, 'Input5', 'Input5', 'NULL', 32, '2017-04-21 09:43:53', '2017-04-21 12:43:53'),
(34, 2, 17, 'Input6', 'Input6', 'NULL', 33, '2017-04-21 09:43:53', '2017-04-21 12:43:53'),
(35, 2, 18, 'Input7', 'Input7', 'NULL', 34, '2017-04-21 09:43:53', '2017-04-21 12:43:53'),
(36, 2, 21, 'RFID report', 'RFID report', 'NULL', 35, '2017-04-21 09:43:54', '2017-04-21 12:43:54'),
(37, 2, 35, 'Barcode Report', 'Barcode Report', 'NULL', 36, '2017-04-21 09:43:54', '2017-04-21 12:43:54'),
(38, 2, 50, 'IGN from OFF to ON', 'IGN from OFF to ON', 'NULL', 37, '2017-04-21 09:43:54', '2017-04-21 12:43:54'),
(39, 2, 51, 'Input 1 from OFF to ON', 'Input 1 from OFF to ON', 'NULL', 38, '2017-04-21 09:43:54', '2017-04-21 12:43:54'),
(40, 2, 52, 'Input 2 from OFF to ON', 'Input 2 from OFF to ON', 'NULL', 39, '2017-04-21 09:43:54', '2017-04-21 12:43:54'),
(41, 2, 53, 'Input 3 from OFF to ON', 'Input 3 from OFF to ON', 'NULL', 40, '2017-04-21 09:43:54', '2017-04-21 12:43:54'),
(42, 2, 54, 'Input 4 from OFF to ON', 'Input 4 from OFF to ON', 'NULL', 41, '2017-04-21 09:43:54', '2017-04-21 12:43:54'),
(43, 2, 59, 'FTP Download Report', 'FTP Download Report', 'NULL', 42, '2017-04-21 09:43:54', '2017-04-21 12:43:54'),
(44, 2, 60, 'FTP Download Fail', 'FTP Download Fail', 'NULL', 43, '2017-04-21 09:43:54', '2017-04-21 12:43:54'),
(45, 2, 61, 'File Update Report', 'File Update Report', 'NULL', 44, '2017-04-21 09:43:54', '2017-04-21 12:43:54'),
(46, 2, 62, 'File Update Fail', 'File Update Fail', 'NULL', 45, '2017-04-21 09:43:54', '2017-04-21 12:43:54'),
(47, 2, 160, 'Power-Up Alert', 'Power-Up Alert', 'NULL', 46, '2017-04-21 09:43:54', '2017-04-21 12:43:54'),
(48, 2, 161, 'Engine Status Alert', 'Engine Status Alert', 'NULL', 47, '2017-04-21 09:43:54', '2017-04-21 12:43:54'),
(49, 2, 162, 'High Speed Alert', 'High Speed Alert', 'NULL', 48, '2017-04-21 09:43:54', '2017-04-21 12:43:54'),
(50, 2, 163, 'High Speed Report', 'High Speed Report', 'NULL', 49, '2017-04-21 09:43:54', '2017-04-21 12:43:54'),
(51, 2, 164, 'GeoFence Entry Alert', 'GeoFence Entry Alert', 'NULL', 50, '2017-04-21 09:43:54', '2017-04-21 12:43:54'),
(52, 2, 165, 'GeoFence Exit Alert', 'GeoFence Exit Alert', 'NULL', 51, '2017-04-21 09:43:54', '2017-04-21 12:43:54'),
(53, 2, 166, 'Main Power Low Alert', 'Main Power Low Alert', 'NULL', 52, '2017-04-21 09:43:54', '2017-04-21 12:43:54'),
(54, 2, 167, 'Main Power Failure Alert', 'Main Power Failure Alert', 'NULL', 53, '2017-04-21 09:43:54', '2017-04-21 12:43:54'),
(55, 2, 168, 'Battery Power Low Alert', 'Battery Power Low Alert', 'NULL', 54, '2017-04-21 09:43:54', '2017-04-21 12:43:54'),
(56, 2, 169, 'Battery Power Failure Alert', 'Battery Power Failure Alert', 'NULL', 55, '2017-04-21 09:43:54', '2017-04-21 12:43:54'),
(57, 2, 170, 'Main Power removal Alert', 'Main Power removal Alert', 'NULL', 56, '2017-04-21 09:43:55', '2017-04-21 12:43:55'),
(58, 2, 171, 'Heartbeat', 'Heartbeat', 'NULL', 57, '2017-04-21 09:43:55', '2017-04-21 12:43:55'),
(59, 2, 172, 'GPS Failure Alert(No GPS Lock)', 'GPS Failure Alert(No GPS Lock)', 'NULL', 58, '2017-04-21 09:43:55', '2017-04-21 12:43:55'),
(60, 2, 173, 'GPS Antenna Failure Alert', 'GPS Antenna Failure Alert', 'NULL', 59, '2017-04-21 09:43:55', '2017-04-21 12:43:55'),
(61, 2, 174, 'Home Alert', 'Home Alert', 'NULL', 60, '2017-04-21 09:43:55', '2017-04-21 12:43:55'),
(62, 2, 175, 'Main Power Restored Alert', 'Main Power Restored Alert', 'NULL', 61, '2017-04-21 09:43:55', '2017-04-21 12:43:55'),
(63, 2, 176, 'Battery Power Restored Alert', 'Battery Power Restored Alert', 'NULL', 62, '2017-04-21 09:43:55', '2017-04-21 12:43:55'),
(64, 2, 177, 'Tow Alert', 'Tow Alert', 'NULL', 63, '2017-04-21 09:43:55', '2017-04-21 12:43:55'),
(65, 2, 178, 'GPS Module Failure Alert', 'GPS Module Failure Alert', 'NULL', 64, '2017-04-21 09:43:55', '2017-04-21 12:43:55'),
(66, 2, 179, 'Motion Detection Alert', 'Motion Detection Alert', 'NULL', 65, '2017-04-21 09:43:55', '2017-04-21 12:43:55'),
(67, 2, 180, 'Impact Detection Alert', 'Impact Detection Alert', 'NULL', 66, '2017-04-21 09:43:55', '2017-04-21 12:43:55'),
(68, 2, 181, 'Pre-impact data Alert', 'Pre-impact data Alert', 'NULL', 67, '2017-04-21 09:43:55', '2017-04-21 12:43:55'),
(69, 2, 182, 'Post-impact data Alert', 'Post-impact data Alert', 'NULL', 68, '2017-04-21 09:43:55', '2017-04-21 12:43:55'),
(70, 2, 183, 'Idle-Alert', 'Idle-Alert', 'NULL', 69, '2017-04-21 09:43:55', '2017-04-21 12:43:55'),
(71, 2, 184, 'Idle Alert Report', 'Idle Alert Report', 'NULL', 70, '2017-04-21 09:43:55', '2017-04-21 12:43:55'),
(72, 2, 185, 'Analog Input 1 Report', 'Analog Input 1 Report', 'NULL', 71, '2017-04-21 09:43:55', '2017-04-21 12:43:55'),
(73, 2, 186, 'Analog Input 2 Report', 'Analog Input 2 Report', 'NULL', 72, '2017-04-21 09:43:55', '2017-04-21 12:43:55'),
(74, 2, 191, 'Geo-fence speed Alert', 'Geo-fence speed Alert', 'NULL', 73, '2017-04-21 09:43:55', '2017-04-21 12:43:55'),
(75, 2, 193, 'Entering Low Power Mode Report', 'Entering Low Power Mode Report', 'NULL', 74, '2017-04-21 09:43:56', '2017-04-21 12:43:56'),
(76, 2, 194, 'Wake-up from Very Low Power Mode Report', 'Wake-up from Very Low Power Mode Report', 'NULL', 75, '2017-04-21 09:43:56', '2017-04-21 12:43:56'),
(77, 2, 199, 'Deceleration start report 2', 'Deceleration start report 2', 'NULL', 76, '2017-04-21 09:43:56', '2017-04-21 12:43:56'),
(78, 2, 200, 'Deceleration stop report 2', 'Deceleration stop report 2', 'NULL', 77, '2017-04-21 09:43:56', '2017-04-21 12:43:56'),
(79, 2, 201, 'Wake-up from Very Low Power Mode Report', 'Wake-up from Very Low Power Mode Report', 'NULL', 78, '2017-04-21 09:43:56', '2017-04-21 12:43:56'),
(80, 2, 202, 'Entering from Very Low Power Mode Report', 'Entering from Very Low Power Mode Report', 'NULL', 79, '2017-04-21 09:43:56', '2017-04-21 12:43:56'),
(81, 2, 205, 'GPS Antenna Connect Report', 'GPS Antenna Connect Report', 'NULL', 80, '2017-04-21 09:43:56', '2017-04-21 12:43:56'),
(82, 2, 206, 'Acceleration start report', 'Acceleration start report', 'NULL', 81, '2017-04-21 09:43:56', '2017-04-21 12:43:56'),
(83, 2, 207, 'Acceleration stop report', 'Acceleration stop report', 'NULL', 82, '2017-04-21 09:43:56', '2017-04-21 12:43:56'),
(84, 2, 208, 'Deceleration start report', 'Deceleration start report', 'NULL', 83, '2017-04-21 09:43:56', '2017-04-21 12:43:56'),
(85, 2, 209, 'Deceleration stop report', 'Deceleration stop report', 'NULL', 84, '2017-04-21 09:43:56', '2017-04-21 12:43:56'),
(86, 2, 210, 'Geo-fence speed alert end', 'Geo-fence speed alert end', 'NULL', 85, '2017-04-21 09:43:56', '2017-04-21 12:43:56'),
(87, 2, 211, 'Enter roaming state alert', 'Enter roaming state alert', 'NULL', 86, '2017-04-21 09:43:56', '2017-04-21 12:43:56'),
(88, 2, 212, 'Exit roaming state report', 'Exit roaming state report', 'NULL', 87, '2017-04-21 09:43:56', '2017-04-21 12:43:56'),
(89, 2, 215, 'Garmin connect', 'Garmin connect', 'NULL', 88, '2017-04-21 09:43:56', '2017-04-21 12:43:56'),
(90, 2, 216, 'Garmin Disconnect', 'Garmin Disconnect', 'NULL', 89, '2017-04-21 09:43:56', '2017-04-21 12:43:56'),
(91, 2, 256, 'CCD/CMOS Camera Data', 'CCD/CMOS Camera Data', 'NULL', 90, '2017-04-21 09:43:56', '2017-04-21 12:43:56'),
(92, 2, 110, 'Ignition Off', 'Ignition Off', '1', 91, '2017-04-21 09:43:56', '2017-04-21 12:43:56'),
(93, 2, 111, 'Ignition On', 'Ignition On', '2', 92, '2017-04-21 09:43:56', '2017-04-21 12:43:56'),
(94, 2, 120, 'Door Closed', 'Door Closed', '3', 93, '2017-04-21 09:43:56', '2017-04-21 12:43:56'),
(95, 2, 121, 'Door Opened', 'Door Opened', '4', 94, '2017-04-21 09:43:56', '2017-04-21 12:43:56'),
(96, 3, 5, 'Login', 'Login', 'NULL', 95, '2017-04-21 09:43:57', '2017-04-21 12:43:57'),
(97, 3, 1, 'Auto Reply', 'Auto Reply', 'NULL', 96, '2017-04-21 09:43:57', '2017-04-21 12:43:57'),
(98, 3, 2, 'Auto Reply', 'Auto Reply', 'NULL', 97, '2017-04-21 09:43:57', '2017-04-21 12:43:57'),
(99, 3, 10, 'Vehicle Power Off', 'Vehicle Power Off', 'NULL', 98, '2017-04-21 09:43:57', '2017-04-21 12:43:57'),
(100, 3, 11, 'Geo-Fence(IN)', 'Geo-Fence(IN)', 'NULL', 99, '2017-04-21 09:43:57', '2017-04-21 12:43:57'),
(101, 3, 12, 'SOS', 'SOS', 'NULL', 100, '2017-04-21 09:43:57', '2017-04-21 12:43:57'),
(102, 3, 13, 'Alarm', 'Alarm', 'NULL', 101, '2017-04-21 09:43:57', '2017-04-21 12:43:57'),
(103, 3, 14, 'Lowspeed', 'Lowspeed', 'NULL', 102, '2017-04-21 09:43:57', '2017-04-21 12:43:57'),
(104, 3, 15, 'Overspeed', 'Overspeed', 'NULL', 103, '2017-04-21 09:43:57', '2017-04-21 12:43:57'),
(105, 3, 16, 'Geo-Fence(OUT)', 'Geo-Fence(OUT)', 'NULL', 104, '2017-04-21 09:43:57', '2017-04-21 12:43:57'),
(106, 3, 17, 'Vehicle Power Off', 'Vehicle Power Off', 'NULL', 105, '2017-04-21 09:43:57', '2017-04-21 12:43:57'),
(107, 3, 18, 'Geo-Fence(IN)', 'Geo-Fence(IN)', 'NULL', 106, '2017-04-21 09:43:57', '2017-04-21 12:43:57'),
(108, 3, 19, 'SOS', 'SOS', 'NULL', 107, '2017-04-21 09:43:57', '2017-04-21 12:43:57'),
(109, 3, 20, 'Alarm', 'Alarm', 'NULL', 108, '2017-04-21 09:43:57', '2017-04-21 12:43:57'),
(110, 3, 21, 'Lowspeed', 'Lowspeed', 'NULL', 109, '2017-04-21 09:43:57', '2017-04-21 12:43:57'),
(111, 3, 22, 'Overspeed', 'Overspeed', 'NULL', 110, '2017-04-21 09:43:57', '2017-04-21 12:43:57'),
(112, 3, 23, 'Geo-Fence(OUT)', 'Geo-Fence(OUT)', 'NULL', 111, '2017-04-21 09:43:57', '2017-04-21 12:43:57'),
(113, 3, 24, 'Location Reply', 'Location Reply', 'NULL', 112, '2017-04-21 09:43:57', '2017-04-21 12:43:57'),
(114, 1, -1, 'Connect', 'Connect', '-1', 113, '2017-04-21 09:43:57', '2017-04-21 12:43:57'),
(115, 1, -2, 'Disconnected', 'Disconnected', '-2', 114, '2017-04-21 09:43:57', '2017-04-21 12:43:57'),
(116, 2, -1, 'Connect', 'Connect', '-1', 115, '2017-04-21 09:43:58', '2017-04-21 12:43:58'),
(117, 2, -2, 'Disconnected', 'Disconnected', '-2', 116, '2017-04-21 09:43:58', '2017-04-21 12:43:58'),
(118, 3, -1, 'Connect', 'Connect', '-1', 117, '2017-04-21 09:43:58', '2017-04-21 12:43:58'),
(119, 3, -2, 'Disconnected', 'Disconnected', '-2', 118, '2017-04-21 09:43:58', '2017-04-21 12:43:58'),
(120, 1, 130, 'Door Closed', 'Door Closed', '3', 119, '2017-04-21 09:43:58', '2017-04-21 12:43:58'),
(121, 1, 131, 'Door Opened', 'Door Opened', '4', 120, '2017-04-21 09:43:58', '2017-04-21 12:43:58'),
(122, 3, 25, 'Auto Reply', 'Auto Reply', 'NULL', 121, '2017-04-21 09:43:58', '2017-04-21 12:43:58'),
(123, 4, 1, 'SOS Pressed', 'SOS Pressed', 'NULL', 122, '2017-04-21 09:43:58', '2017-04-21 12:43:58'),
(124, 4, 2, 'Call Pressed', 'Call Pressed', 'NULL', 123, '2017-04-21 09:43:58', '2017-04-21 12:43:58'),
(125, 4, 3, 'Door Opened', 'Door Opened', '4', 124, '2017-04-21 09:43:58', '2017-04-21 12:43:58'),
(126, 4, 4, 'Iginition On', 'Iginition On', '2', 125, '2017-04-21 09:43:58', '2017-04-21 12:43:58'),
(127, 4, 5, 'Input5 Active', 'Input5 Active', 'NULL', 126, '2017-04-21 09:43:58', '2017-04-21 12:43:58'),
(128, 4, 9, 'SOS Released', 'SOS Released', 'NULL', 127, '2017-04-21 09:43:58', '2017-04-21 12:43:58'),
(129, 4, 10, 'Input2 Inactive', 'Input2 Inactive', 'NULL', 128, '2017-04-21 09:43:58', '2017-04-21 12:43:58'),
(130, 4, 11, 'Door Closed', 'Door Closed', '3', 129, '2017-04-21 09:43:58', '2017-04-21 12:43:58'),
(131, 4, 12, 'Iginition Off', 'Iginition Off', '1', 130, '2017-04-21 09:43:58', '2017-04-21 12:43:58'),
(132, 4, 13, 'Input5 Inactive', 'Input5 Inactive', 'NULL', 131, '2017-04-21 09:43:58', '2017-04-21 12:43:58'),
(133, 4, 17, 'Low battery', 'Low battery', 'NULL', 132, '2017-04-21 09:43:58', '2017-04-21 12:43:58'),
(134, 4, 18, 'Low External Power', 'Low External Power', 'NULL', 133, '2017-04-21 09:43:59', '2017-04-21 12:43:59'),
(135, 4, 19, 'Speeding', 'Speeding', 'NULL', 134, '2017-04-21 09:43:59', '2017-04-21 12:43:59'),
(136, 4, 20, 'Enter Geofence', 'Enter Geofence', 'NULL', 135, '2017-04-21 09:43:59', '2017-04-21 12:43:59'),
(137, 4, 21, 'Exit Geofence', 'Exit Geofence', 'NULL', 136, '2017-04-21 09:43:59', '2017-04-21 12:43:59'),
(138, 4, 22, 'External Power On', 'External Power On', 'NULL', 137, '2017-04-21 09:43:59', '2017-04-21 12:43:59'),
(139, 4, 23, 'External Power Off', 'External Power Off', 'NULL', 138, '2017-04-21 09:43:59', '2017-04-21 12:43:59'),
(140, 4, 24, 'No Fix', 'No Fix', 'NULL', 139, '2017-04-21 09:43:59', '2017-04-21 12:43:59'),
(141, 4, 25, 'Fix', 'Fix', 'NULL', 140, '2017-04-21 09:43:59', '2017-04-21 12:43:59'),
(142, 4, 26, 'Enter Sleep', 'Enter Sleep', 'NULL', 141, '2017-04-21 09:43:59', '2017-04-21 12:43:59'),
(143, 4, 27, 'Exit Sleep', 'Exit Sleep', 'NULL', 142, '2017-04-21 09:43:59', '2017-04-21 12:43:59'),
(144, 4, 28, 'GPS Cut', 'GPS Cut', 'NULL', 143, '2017-04-21 09:43:59', '2017-04-21 12:43:59'),
(145, 4, 29, 'Reboot', 'Reboot', 'NULL', 144, '2017-04-21 09:43:59', '2017-04-21 12:43:59'),
(146, 4, 30, 'Impact', 'Impact', 'NULL', 145, '2017-04-21 09:43:59', '2017-04-21 12:43:59'),
(147, 4, 31, 'Heart beat', 'Heart beat', 'NULL', 146, '2017-04-21 09:43:59', '2017-04-21 12:43:59'),
(148, 4, 32, 'Heading Change', 'Heading Change', 'NULL', 147, '2017-04-21 09:43:59', '2017-04-21 12:43:59'),
(149, 4, 33, 'Distance Interval Report', 'Distance Interval Report', 'NULL', 148, '2017-04-21 09:43:59', '2017-04-21 12:43:59'),
(150, 4, 34, 'Location Reply', 'Location Reply', 'NULL', 149, '2017-04-21 09:43:59', '2017-04-21 12:43:59'),
(151, 4, 35, 'Auto Reply', 'Auto Reply', 'NULL', 150, '2017-04-21 09:43:59', '2017-04-21 12:43:59'),
(152, 4, 36, 'Tow', 'Tow', 'NULL', 151, '2017-04-21 09:43:59', '2017-04-21 12:43:59'),
(153, 4, 37, 'RFID', 'RFID', 'NULL', 152, '2017-04-21 09:43:59', '2017-04-21 12:43:59'),
(154, 4, 39, 'Picture', 'Picture', 'NULL', 153, '2017-04-21 09:44:00', '2017-04-21 12:44:00'),
(155, 4, 65, 'Press Input1 (SOS) to Call', 'Press Input1 (SOS) to Call', 'NULL', 154, '2017-04-21 09:44:00', '2017-04-21 12:44:00'),
(156, 4, 66, 'Press Input2 to Call', 'Press Input2 to Call', 'NULL', 155, '2017-04-21 09:44:00', '2017-04-21 12:44:00'),
(157, 4, 67, 'Press Input3 to Call', 'Press Input3 to Call', 'NULL', 156, '2017-04-21 09:44:00', '2017-04-21 12:44:00'),
(158, 4, 68, 'Press Input4 to Call', 'Press Input4 to Call', 'NULL', 157, '2017-04-21 09:44:00', '2017-04-21 12:44:00'),
(159, 4, 69, 'Press Input5 to Call', 'Press Input5 to Call', 'NULL', 158, '2017-04-21 09:44:00', '2017-04-21 12:44:00'),
(160, 4, 70, 'Reject Incoming Call', 'Reject Incoming Call', 'NULL', 159, '2017-04-21 09:44:00', '2017-04-21 12:44:00'),
(161, 4, 71, 'Report Location after Incoming Call', 'Report Location after Incoming Call', 'NULL', 160, '2017-04-21 09:44:00', '2017-04-21 12:44:00'),
(162, 4, 72, 'Auto Answer Incoming Call', 'Auto Answer Incoming Call', 'NULL', 161, '2017-04-21 09:44:00', '2017-04-21 12:44:00'),
(163, 4, 73, 'Listen-in (Voice Monitoring)', 'Listen-in (Voice Monitoring)', 'NULL', 162, '2017-04-21 09:44:00', '2017-04-21 12:44:00'),
(164, 4, 129, 'Rush Decelerate Alarm', 'Rush Decelerate Alarm', 'NULL', 163, '2017-04-21 09:44:00', '2017-04-21 12:44:00'),
(165, 4, 130, 'Rush Accelerate Alarm', 'Rush Accelerate Alarm', 'NULL', 164, '2017-04-21 09:44:00', '2017-04-21 12:44:00'),
(166, 4, 131, 'RPM Over Speed Alarm', 'RPM Over Speed Alarm', 'NULL', 165, '2017-04-21 09:44:00', '2017-04-21 12:44:00'),
(167, 4, 132, 'RPM Recovery to Normal from Speeding Alarm', 'RPM Recovery to Normal from Speeding Alarm', 'NULL', 166, '2017-04-21 09:44:00', '2017-04-21 12:44:00'),
(168, 4, 133, 'Iginition on When Parking Overtime Alarm', 'Iginition on When Parking Overtime Alarm', 'NULL', 167, '2017-04-21 09:44:00', '2017-04-21 12:44:00'),
(169, 4, 134, 'Recovery Alarm (Iginition off or Car Runs Again)', 'Recovery Alarm (Iginition off or Car Runs Again)', 'NULL', 168, '2017-04-21 09:44:00', '2017-04-21 12:44:00'),
(170, 4, 135, 'Fatigue Driving Alarm', 'Fatigue Driving Alarm', 'NULL', 169, '2017-04-21 09:44:00', '2017-04-21 12:44:00'),
(171, 4, 136, 'Overtime Rest after Fatigue Driving Alarm', 'Overtime Rest after Fatigue Driving Alarm', 'NULL', 170, '2017-04-21 09:44:00', '2017-04-21 12:44:00'),
(172, 4, 137, 'Engine Overheat Alarm', 'Engine Overheat Alarm', 'NULL', 171, '2017-04-21 09:44:00', '2017-04-21 12:44:00'),
(173, 4, 138, 'Speed Recovery to Normal Alarm', 'Speed Recovery to Normal Alarm', 'NULL', 172, '2017-04-21 09:44:00', '2017-04-21 12:44:00'),
(174, 4, 139, 'Maintenance Alarm', 'Maintenance Alarm', 'NULL', 173, '2017-04-21 09:44:00', '2017-04-21 12:44:00'),
(175, 4, 140, 'Engine Error Alarm', 'Engine Error Alarm', 'NULL', 174, '2017-04-21 09:44:00', '2017-04-21 12:44:00'),
(176, 4, 141, 'Ready Status Error Alarm', 'Ready Status Error Alarm', 'NULL', 175, '2017-04-21 09:44:01', '2017-04-21 12:44:01'),
(177, 4, 142, 'Health Inspect Alarm', 'Health Inspect Alarm', 'NULL', 176, '2017-04-21 09:44:01', '2017-04-21 12:44:01'),
(178, 4, 143, 'Low Fuel Alarm', 'Low Fuel Alarm', 'NULL', 177, '2017-04-21 09:44:01', '2017-04-21 12:44:01'),
(179, 4, 144, 'Iginition On', 'Iginition On', 'NULL', 178, '2017-04-21 09:44:01', '2017-04-21 12:44:01'),
(180, 4, 145, 'igintion Off', 'igintion Off', 'NULL', 179, '2017-04-21 09:44:01', '2017-04-21 12:44:01'),
(181, 4, 146, 'Car Starts Alarm', 'Car Starts Alarm', 'NULL', 180, '2017-04-21 09:44:01', '2017-04-21 12:44:01'),
(182, 4, 147, 'Car Stops Alarm', 'Car Stops Alarm', 'NULL', 181, '2017-04-21 09:44:01', '2017-04-21 12:44:01'),
(183, 4, 148, 'Reply for A1 Command, set the authorized number', 'Reply for A1 Command, set the authorized number', 'NULL', 182, '2017-04-21 09:44:01', '2017-04-21 12:44:01'),
(184, 4, 149, 'Reply for A2 Command, set the authorized number', 'Reply for A2 Command, set the authorized number', 'NULL', 183, '2017-04-21 09:44:01', '2017-04-21 12:44:01'),
(185, 4, 150, 'Reply for A3 Command, set the authorized number', 'Reply for A3 Command, set the authorized number', 'NULL', 184, '2017-04-21 09:44:01', '2017-04-21 12:44:01'),
(186, 4, 151, 'Reply for A4 Command, set the authorized number', 'Reply for A4 Command, set the authorized number', 'NULL', 185, '2017-04-21 09:44:01', '2017-04-21 12:44:01'),
(187, 4, 152, 'Reply for A5 Command, set the authorized number', 'Reply for A5 Command, set the authorized number', 'NULL', 186, '2017-04-21 09:44:01', '2017-04-21 12:44:01'),
(188, 4, 153, 'Set speeding Alarm', 'Set speeding Alarm', 'NULL', 187, '2017-04-21 09:44:01', '2017-04-21 12:44:01'),
(189, 4, 154, 'Set GEO fence', 'Set GEO fence', 'NULL', 188, '2017-04-21 09:44:01', '2017-04-21 12:44:01'),
(190, 4, 155, 'Set The Time Zone', 'Set The Time Zone', 'NULL', 189, '2017-04-21 09:44:01', '2017-04-21 12:44:01'),
(191, 4, 156, 'Set low battery Alarm', 'Set low battery Alarm', 'NULL', 190, '2017-04-21 09:44:01', '2017-04-21 12:44:01'),
(192, 4, 157, 'Modify password', 'Modify password', 'NULL', 191, '2017-04-21 09:44:01', '2017-04-21 12:44:01'),
(193, 4, 158, 'Recover ACC or Engine', 'Recover ACC or Engine', 'NULL', 192, '2017-04-21 09:44:02', '2017-04-21 12:44:02'),
(194, 4, 159, 'Cut the ACC or Engine', 'Cut the ACC or Engine', 'NULL', 193, '2017-04-21 09:44:02', '2017-04-21 12:44:02'),
(195, 4, 160, 'Switch to the listen in Mode', 'Switch to the listen in Mode', 'NULL', 194, '2017-04-21 09:44:02', '2017-04-21 12:44:02'),
(196, 4, 161, 'Switch to the talk Mode', 'Switch to the talk Mode', 'NULL', 195, '2017-04-21 09:44:02', '2017-04-21 12:44:02'),
(197, 4, 162, 'Set the APN,IP and Port', 'Set the APN,IP and Port', 'NULL', 196, '2017-04-21 09:44:02', '2017-04-21 12:44:02'),
(198, 4, 163, 'Set Username and Password for APN', 'Set Username and Password for APN', 'NULL', 197, '2017-04-21 09:44:02', '2017-04-21 12:44:02'),
(199, 4, -10, 'Setting unsuccessful', 'Setting unsuccessful', 'NULL', 198, '2017-04-21 09:44:02', '2017-04-21 12:44:02'),
(200, 4, -20, 'Uknown command', 'Uknown command', 'NULL', 199, '2017-04-21 09:44:02', '2017-04-21 12:44:02'),
(201, 4, -2, 'Disconnected', 'Disconnected', '-2', 200, '2017-04-21 09:44:02', '2017-04-21 12:44:02'),
(202, 15, 4000, 'Server confirms tracker’s login', 'Server confirms tracker’s login', 'NULL', 251, '2017-04-21 09:44:02', '2017-04-21 12:44:02'),
(203, 15, 5000, 'Tracker’s login', 'Tracker’s login', 'NULL', 252, '2017-04-21 09:44:02', '2017-04-21 12:44:02'),
(204, 15, 4101, 'Request one single location report', 'Location Reply', 'NULL', 253, '2017-04-21 09:44:02', '2017-04-21 12:44:02'),
(205, 15, 4102, 'Set time interval for continuous tracking', 'Set time interval for continuous tracking', 'NULL', 254, '2017-04-21 09:44:02', '2017-04-21 12:44:02'),
(206, 15, 4103, 'Set authorized phone number', 'Set authorized phone number', 'NULL', 255, '2017-04-21 09:44:02', '2017-04-21 12:44:02'),
(207, 15, 4104, 'Reserved', 'Reserved', 'NULL', 256, '2017-04-21 09:44:02', '2017-04-21 12:44:02'),
(208, 15, 4105, 'Set speed limit for over speed alarm', 'Set speed limit for over speed alarm', 'NULL', 257, '2017-04-21 09:44:02', '2017-04-21 12:44:02'),
(209, 15, 4106, 'Set movement alert', 'Set movement alert', 'NULL', 258, '2017-04-21 09:44:02', '2017-04-21 12:44:02'),
(210, 15, 4107, 'Set Geo-fence', 'Set Geo-fence', 'NULL', 259, '2017-04-21 09:44:03', '2017-04-21 12:44:03'),
(211, 15, 4207, 'Set Geo-fence', 'Set Geo-fence', 'NULL', 260, '2017-04-21 09:44:03', '2017-04-21 12:44:03'),
(212, 15, 4108, 'Set extended functions', 'Set extended functions', 'NULL', 261, '2017-04-21 09:44:03', '2017-04-21 12:44:03'),
(213, 15, 4109, 'Reserved', 'Reserved', 'NULL', 262, '2017-04-21 09:44:03', '2017-04-21 12:44:03'),
(214, 15, 4111, 'Reserved', 'Reserved', 'NULL', 264, '2017-04-21 09:44:03', '2017-04-21 12:44:03'),
(215, 15, 4112, 'Reserved', 'Reserved', 'NULL', 265, '2017-04-21 09:44:03', '2017-04-21 12:44:03'),
(216, 15, 4113, 'Set sleep mode for power saving', 'Set sleep mode for power saving', 'NULL', 266, '2017-04-21 09:44:03', '2017-04-21 12:44:03'),
(217, 15, 4114, 'Output control (safe - 10Km/h)', 'Output control (safe - 10Km/h)', 'NULL', 267, '2017-04-21 09:44:03', '2017-04-21 12:44:03'),
(218, 15, 5114, 'Output control (safe - 20Km/h)', 'Output control (safe - 20Km/h)', 'NULL', 268, '2017-04-21 09:44:03', '2017-04-21 12:44:03'),
(219, 15, 4115, 'Output control (general)', 'Output control (general)', 'NULL', 269, '2017-04-21 09:44:03', '2017-04-21 12:44:03'),
(220, 15, 4116, 'Set GPRS alert for buttons or inputs', 'Set GPRS alert for buttons or inputs', 'NULL', 270, '2017-04-21 09:44:03', '2017-04-21 12:44:03'),
(221, 15, 4126, 'Set power saving when tracker is immobile', 'Set power saving when tracker is immobile', 'NULL', 271, '2017-04-21 09:44:03', '2017-04-21 12:44:03'),
(222, 15, 4130, 'Set telephone number for wiretapping', 'Set telephone number for wiretapping', 'NULL', 272, '2017-04-21 09:44:03', '2017-04-21 12:44:03'),
(223, 15, 4131, 'Set interval for logging', 'Set interval for logging', 'NULL', 273, '2017-04-21 09:44:03', '2017-04-21 12:44:03'),
(224, 15, 4132, 'Set time zone', 'Set time zone', 'NULL', 274, '2017-04-21 09:44:03', '2017-04-21 12:44:03'),
(225, 15, 9000, 'Reserved', 'Reserved', 'NULL', 275, '2017-04-21 09:44:03', '2017-04-21 12:44:03'),
(226, 15, 9001, 'Reserved', 'Reserved', 'NULL', 276, '2017-04-21 09:44:03', '2017-04-21 12:44:03'),
(227, 15, 9002, 'Read time interval of continuous tracking', 'Read time interval of continuous tracking', 'NULL', 277, '2017-04-21 09:44:03', '2017-04-21 12:44:03'),
(228, 15, 9003, 'Read authorized phone number', 'Read authorized phone number', 'NULL', 278, '2017-04-21 09:44:03', '2017-04-21 12:44:03'),
(229, 15, 9004, 'Reserved', 'Reserved', 'NULL', 279, '2017-04-21 09:44:03', '2017-04-21 12:44:03'),
(230, 15, 9005, 'Reserved', 'Reserved', 'NULL', 280, '2017-04-21 09:44:03', '2017-04-21 12:44:03'),
(231, 15, 9007, 'Reserved', 'Reserved', 'NULL', 281, '2017-04-21 09:44:04', '2017-04-21 12:44:04'),
(232, 15, 9008, 'Reserved', 'Reserved', 'NULL', 282, '2017-04-21 09:44:04', '2017-04-21 12:44:04'),
(233, 15, 9011, 'Reserved', 'Reserved', 'NULL', 283, '2017-04-21 09:44:04', '2017-04-21 12:44:04'),
(234, 15, 9012, 'Reserved', 'Reserved', 'NULL', 284, '2017-04-21 09:44:04', '2017-04-21 12:44:04'),
(235, 15, 9013, 'Reserved', 'Reserved', 'NULL', 285, '2017-04-21 09:44:04', '2017-04-21 12:44:04'),
(236, 15, 9016, 'Read logging waypoints', 'Read logging waypoints', 'NULL', 286, '2017-04-21 09:44:04', '2017-04-21 12:44:04'),
(237, 15, 9955, 'Single location report', 'Auto Reply', 'NULL', 287, '2017-04-21 09:44:04', '2017-04-21 12:44:04'),
(238, 15, 9999, 'Alarm command ', 'Alarm command ', 'NULL', 288, '2017-04-21 09:44:04', '2017-04-21 12:44:04'),
(239, 15, -1, 'Connect', 'Connect', 'NULL', 289, '2017-04-21 09:44:04', '2017-04-21 12:44:04'),
(240, 15, -2, 'Disconnected', 'Disconnected', 'NULL', 290, '2017-04-21 09:44:04', '2017-04-21 12:44:04'),
(241, 15, 999910, 'Ignition Off', 'Ignition On', '1', 291, '2017-04-21 09:44:04', '2017-04-21 12:44:04'),
(242, 15, 999911, 'Ignition On', 'Ignition Off', '2', 292, '2017-04-21 09:44:04', '2017-04-21 12:44:04'),
(243, 15, 999920, 'Door Closed', 'Door Closed', '3', 293, '2017-04-21 09:44:04', '2017-04-21 12:44:04'),
(244, 15, 999921, 'Door Open', 'Door Open', '4', 294, '2017-04-21 09:44:04', '2017-04-21 12:44:04'),
(245, 15, 999930, 'Door Closed', 'Door Closed', '3', 295, '2017-04-21 09:44:04', '2017-04-21 12:44:04'),
(246, 15, 999931, 'Door Open', 'Door Open', '4', 296, '2017-04-21 09:44:04', '2017-04-21 12:44:04'),
(247, 15, 999940, 'Door Closed', 'Door Closed', '3', 297, '2017-04-21 09:44:04', '2017-04-21 12:44:04'),
(248, 15, 999941, 'Door Open', 'Door Open', '4', 298, '2017-04-21 09:44:04', '2017-04-21 12:44:04'),
(249, 15, 999950, 'Door Closed', 'Door Closed', '3', 299, '2017-04-21 09:44:04', '2017-04-21 12:44:04'),
(250, 15, 999951, 'Door Open', 'Door Open', '4', 300, '2017-04-21 09:44:04', '2017-04-21 12:44:04'),
(251, 2, 130, 'Door Closed', 'Door Closed', '3', 301, '2017-04-21 09:44:05', '2017-04-21 12:44:05'),
(252, 2, 131, 'Door Opened', 'Door Opened', '4', 302, '2017-04-21 09:44:05', '2017-04-21 12:44:05'),
(253, 5, 1, 'Location Reply', 'Location Reply', 'NULL', 303, '2017-04-21 09:44:05', '2017-04-21 12:44:05'),
(254, 5, 2, 'Auto Reply', 'Auto Reply', 'NULL', 304, '2017-04-21 09:44:05', '2017-04-21 12:44:05'),
(255, 5, 11, 'GPS antenna open/disconnect', 'GPS antenna open/disconnect', 'NULL', 305, '2017-04-21 09:44:05', '2017-04-21 12:44:05'),
(256, 5, 12, 'GPS antenna short circuit', 'GPS antenna short circuit', 'NULL', 306, '2017-04-21 09:44:05', '2017-04-21 12:44:05'),
(257, 5, 13, 'GPS antenna re-connect', 'GPS antenna re-connect', 'NULL', 307, '2017-04-21 09:44:05', '2017-04-21 12:44:05'),
(258, 5, 20, 'Enter power saving mode', 'Enter power saving mode', 'NULL', 308, '2017-04-21 09:44:05', '2017-04-21 12:44:05'),
(259, 5, 21, 'Exit power saving mode', 'Exit power saving mode', 'NULL', 309, '2017-04-21 09:44:05', '2017-04-21 12:44:05'),
(260, 5, 30, 'FTP download complete', 'FTP download complete', 'NULL', 310, '2017-04-21 09:44:05', '2017-04-21 12:44:05'),
(261, 5, 31, 'FTP download fail', 'FTP download fail', 'NULL', 311, '2017-04-21 09:44:05', '2017-04-21 12:44:05'),
(262, 5, 32, 'File update complete', 'File update complete', 'NULL', 312, '2017-04-21 09:44:05', '2017-04-21 12:44:05'),
(263, 5, 33, 'File update fail', 'File update fail', 'NULL', 313, '2017-04-21 09:44:05', '2017-04-21 12:44:05'),
(264, 5, 50, 'Ignition status change', 'Ignition status change', 'NULL', 314, '2017-04-21 09:44:05', '2017-04-21 12:44:05'),
(265, 5, 51, 'Engine status change', 'Engine status change', 'NULL', 315, '2017-04-21 09:44:05', '2017-04-21 12:44:05'),
(266, 5, 52, 'Analog input report', 'Analog input report', 'NULL', 316, '2017-04-21 09:44:05', '2017-04-21 12:44:05'),
(267, 5, 53, 'Main power low alert', 'Main power low alert', 'NULL', 317, '2017-04-21 09:44:05', '2017-04-21 12:44:05'),
(268, 5, 54, 'Main power restore report', 'Main power restore report', 'NULL', 318, '2017-04-21 09:44:05', '2017-04-21 12:44:05'),
(269, 5, 55, 'Backup battery low alert', 'Backup battery low alert', 'NULL', 319, '2017-04-21 09:44:05', '2017-04-21 12:44:05'),
(270, 5, 56, 'Digital input 1 status change alert', 'Digital input 1 status change alert', 'NULL', 320, '2017-04-21 09:44:06', '2017-04-21 12:44:06'),
(271, 5, 57, 'Digital input 2 status change alert', 'Digital input 2 status change alert', 'NULL', 321, '2017-04-21 09:44:06', '2017-04-21 12:44:06'),
(272, 5, 58, 'Digital input 3 status change alert', 'Digital input 3 status change alert', 'NULL', 322, '2017-04-21 09:44:06', '2017-04-21 12:44:06'),
(273, 5, 59, 'Main power failure', 'Main power failure', 'NULL', 323, '2017-04-21 09:44:06', '2017-04-21 12:44:06'),
(274, 5, 60, 'Backup battery power restore', 'Backup battery power restore', 'NULL', 324, '2017-04-21 09:44:06', '2017-04-21 12:44:06'),
(275, 5, 101, 'Vehicle idle alert', 'Vehicle idle alert', 'NULL', 325, '2017-04-21 09:44:06', '2017-04-21 12:44:06'),
(276, 5, 102, 'End of idle alert', 'End of idle alert', 'NULL', 326, '2017-04-21 09:44:06', '2017-04-21 12:44:06'),
(277, 5, 103, 'Speeding alert', 'Speeding alert', 'NULL', 327, '2017-04-21 09:44:06', '2017-04-21 12:44:06'),
(278, 5, 104, 'End of speeding alert', 'End of speeding alert', 'NULL', 328, '2017-04-21 09:44:06', '2017-04-21 12:44:06'),
(279, 5, 105, 'Entering geo-fence', 'Entering geo-fence', 'NULL', 329, '2017-04-21 09:44:06', '2017-04-21 12:44:06'),
(280, 5, 106, 'Exiting geo-fence', 'Exiting geo-fence', 'NULL', 330, '2017-04-21 09:44:06', '2017-04-21 12:44:06'),
(281, 5, 107, 'Speeding in geo-fence', 'Speeding in geo-fence', 'NULL', 331, '2017-04-21 09:44:06', '2017-04-21 12:44:06'),
(282, 5, 108, 'End of geo-fence speeding', 'End of geo-fence speeding', 'NULL', 332, '2017-04-21 09:44:06', '2017-04-21 12:44:06'),
(283, 5, 111, 'Vehicle tow alert', 'Vehicle tow alert', 'NULL', 333, '2017-04-21 09:44:06', '2017-04-21 12:44:06'),
(284, 5, 112, 'Motion detection alert', 'Motion detection alert', 'NULL', 334, '2017-04-21 09:44:06', '2017-04-21 12:44:06'),
(285, 5, 117, 'Impact detection alert', 'Impact detection alert', 'NULL', 335, '2017-04-21 09:44:06', '2017-04-21 12:44:06'),
(286, 5, 140, 'RFID report', 'RFID report', 'NULL', 336, '2017-04-21 09:44:06', '2017-04-21 12:44:06'),
(287, 5, 141, 'One wire iButton attach report', 'One wire iButton attach report', 'NULL', 337, '2017-04-21 09:44:06', '2017-04-21 12:44:06'),
(288, 5, 142, 'One wire iButton remove report', 'One wire iButton remove report', 'NULL', 338, '2017-04-21 09:44:06', '2017-04-21 12:44:06'),
(289, 5, 143, 'Digital fuel sensor 1 reading report', 'Digital fuel sensor 1 reading report', 'NULL', 339, '2017-04-21 09:44:06', '2017-04-21 12:44:06'),
(290, 5, 144, 'Digital fuel sensor 2 reading report', 'Digital fuel sensor 2 reading report', 'NULL', 340, '2017-04-21 09:44:06', '2017-04-21 12:44:06'),
(291, 5, 152, 'One wire temperature sensor 1 report', 'One wire temperature sensor 1 report', 'NULL', 341, '2017-04-21 09:44:06', '2017-04-21 12:44:06'),
(292, 5, 153, 'One wire temperature sensor 2 report', 'One wire temperature sensor 2 report', 'NULL', 342, '2017-04-21 09:44:07', '2017-04-21 12:44:07'),
(293, 5, 560, 'Door Closed', 'Door Closed', '3', 343, '2017-04-21 09:44:07', '2017-04-21 12:44:07'),
(294, 5, 570, 'Door Closed', 'Door Closed', '3', 344, '2017-04-21 09:44:07', '2017-04-21 12:44:07'),
(295, 5, 580, 'Door Closed', 'Door Closed', '3', 345, '2017-04-21 09:44:07', '2017-04-21 12:44:07'),
(296, 5, 561, 'Door Opened', 'Door Opened', '4', 346, '2017-04-21 09:44:07', '2017-04-21 12:44:07'),
(297, 5, 571, 'Door Opened', 'Door Opened', '4', 347, '2017-04-21 09:44:07', '2017-04-21 12:44:07'),
(298, 5, 581, 'Door Opened', 'Door Opened', '4', 348, '2017-04-21 09:44:07', '2017-04-21 12:44:07'),
(299, 5, 510, 'Ignition Off', 'Ignition Off', 'NULL', 349, '2017-04-21 09:44:07', '2017-04-21 12:44:07'),
(300, 5, 511, 'Ignition On', 'Ignition On', 'NULL', 350, '2017-04-21 09:44:07', '2017-04-21 12:44:07'),
(301, 5, -1, 'Connect', 'Connect', '-1', 351, '2017-04-21 09:44:07', '2017-04-21 12:44:07'),
(302, 5, -2, 'Overdue', 'Overdue', '-2', 352, '2017-04-21 09:44:07', '2017-04-21 12:44:07'),
(303, 5, 501, 'Acc On', 'Acc On', '2', 353, '2017-04-21 09:44:07', '2017-04-21 12:44:07'),
(304, 5, 500, 'Acc Off', 'Acc Off', '1', 354, '2017-04-21 09:44:07', '2017-04-21 12:44:07'),
(305, 5, 0, 'Location Reply', 'Location Reply', 'NULL', 355, '2017-04-21 09:44:07', '2017-04-21 12:44:07'),
(306, 5, 161, 'Checking Version', 'Checking Version', 'NULL', 356, '2017-04-21 09:44:07', '2017-04-21 12:44:07');

-- --------------------------------------------------------

--
-- Table structure for table `gate_electronics`
--

CREATE TABLE `gate_electronics` (
  `id` int(10) UNSIGNED NOT NULL,
  `gate_id` int(10) UNSIGNED NOT NULL,
  `property_id` int(11) DEFAULT NULL,
  `visitor_id` int(10) UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `serial_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `make` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `model` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `other_details` text COLLATE utf8_unicode_ci,
  `time_in` datetime DEFAULT NULL,
  `time_out` datetime DEFAULT NULL,
  `action1` enum('INSIDE','OUTSIDE') COLLATE utf8_unicode_ci DEFAULT NULL,
  `action2` enum('INSIDE','OUTSIDE') COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` enum('Active','Inactive','Booked') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `gate_electronics`
--

INSERT INTO `gate_electronics` (`id`, `gate_id`, `property_id`, `visitor_id`, `type`, `serial_number`, `make`, `model`, `other_details`, `time_in`, `time_out`, `action1`, `action2`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 2, 'Laptop', '5cb2081fmx', 'HP', 'Compaq', NULL, '2017-04-18 00:10:11', '2017-05-11 08:36:34', 'INSIDE', 'OUTSIDE', 'Inactive', '2017-04-17 21:10:11', '2017-05-11 05:36:34'),
(2, 1, 1, 3, 'Laptop', '5cb2081fmx4', 'HP', 'Pavillion', NULL, '2017-04-18 00:11:07', '2017-04-18 00:12:33', 'INSIDE', 'OUTSIDE', 'Inactive', '2017-04-17 21:11:07', '2017-04-17 21:12:33');

-- --------------------------------------------------------

--
-- Table structure for table `gate_gateassignments`
--

CREATE TABLE `gate_gateassignments` (
  `id` int(10) UNSIGNED NOT NULL,
  `gate_id` int(10) UNSIGNED NOT NULL,
  `guard_id` int(10) UNSIGNED NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `assigned_by` int(10) UNSIGNED NOT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Active',
  `next_assignment` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `gate_gateassignments`
--

INSERT INTO `gate_gateassignments` (`id`, `gate_id`, `guard_id`, `start_date`, `end_date`, `assigned_by`, `status`, `next_assignment`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2017-04-04', '2017-06-28', 2, 'Active', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `gate_gates`
--

CREATE TABLE `gate_gates` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `telephone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `alt_telephone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `min_guards` int(11) NOT NULL DEFAULT '1',
  `max_guards` int(11) DEFAULT NULL,
  `current_guards` int(11) DEFAULT NULL,
  `property_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `gate_gates`
--

INSERT INTO `gate_gates` (`id`, `name`, `telephone`, `alt_telephone`, `min_guards`, `max_guards`, `current_guards`, `property_id`, `created_at`, `updated_at`) VALUES
(1, 'Gate A', '+254708236804', '+254708236804', 1, 2, NULL, 1, '2017-04-17 21:03:16', '2017-04-17 21:03:16'),
(2, 'Gate B', '+254708236805', '+254708236805', 1, 2, NULL, 1, '2017-04-17 21:03:40', '2017-04-17 21:03:40'),
(3, 'Gate A', '+254708236890', '+254708236890', 1, 2, NULL, 2, '2017-04-17 21:04:14', '2017-04-17 21:04:14');

-- --------------------------------------------------------

--
-- Table structure for table `gate_guards`
--

CREATE TABLE `gate_guards` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `provider_id` int(10) UNSIGNED DEFAULT NULL,
  `property_id` int(10) UNSIGNED DEFAULT NULL,
  `date_employed` date DEFAULT NULL,
  `employer_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `employer_mobile` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `assignment_status` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'Not Assigned',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `gate_guards`
--

INSERT INTO `gate_guards` (`id`, `user_id`, `provider_id`, `property_id`, `date_employed`, `employer_name`, `employer_mobile`, `assignment_status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 20, 1, 1, NULL, 'Senaga East Africa', '6767676', 'Not Assigned', '2017-04-17 21:05:08', '2017-04-17 21:05:08', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `gate_incidents`
--

CREATE TABLE `gate_incidents` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `gate_id` int(10) UNSIGNED NOT NULL,
  `provider_id` int(10) UNSIGNED NOT NULL,
  `property_id` int(10) UNSIGNED NOT NULL,
  `incident_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `insident_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `incident_time` time DEFAULT NULL,
  `incident_date` date DEFAULT NULL,
  `incident_description` text COLLATE utf8_unicode_ci,
  `status` enum('Open','Pending','Resolved','Closed') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Open',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `gate_incidents`
--

INSERT INTO `gate_incidents` (`id`, `user_id`, `gate_id`, `provider_id`, `property_id`, `incident_name`, `insident_code`, `incident_time`, `incident_date`, `incident_description`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 20, 1, 1, 1, 'Theft', 'kUCTYm64', '15:21:46', '2017-05-12', 'djjhdhddjd', 'Open', '2017-05-12 12:21:53', '2017-05-12 12:21:53', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `gate_vehicles`
--

CREATE TABLE `gate_vehicles` (
  `id` int(10) UNSIGNED NOT NULL,
  `gate_id` int(10) UNSIGNED NOT NULL,
  `property_id` int(11) DEFAULT NULL,
  `visitor_id` int(10) UNSIGNED NOT NULL,
  `make` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `model` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reg_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `driver_license` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `time_in` time DEFAULT NULL,
  `time_out` time DEFAULT NULL,
  `action1` enum('INSIDE','OUTSIDE') COLLATE utf8_unicode_ci DEFAULT NULL,
  `action2` enum('INSIDE','OUTSIDE') COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` enum('Active','Inactive','Booked') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gate_visitors`
--

CREATE TABLE `gate_visitors` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mobile` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `alt_mobile` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `host_id` int(10) UNSIGNED NOT NULL,
  `gate_id` int(10) UNSIGNED NOT NULL,
  `property_id` int(11) DEFAULT NULL,
  `time_in` datetime DEFAULT NULL,
  `time_out` datetime DEFAULT NULL,
  `action1` enum('INSIDE','OUTSIDE') COLLATE utf8_unicode_ci DEFAULT NULL,
  `action2` enum('INSIDE','OUTSIDE') COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` enum('Active','Inactive','Booked') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `gate_visitors`
--

INSERT INTO `gate_visitors` (`id`, `name`, `email_address`, `mobile`, `alt_mobile`, `id_number`, `host_id`, `gate_id`, `property_id`, `time_in`, `time_out`, `action1`, `action2`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Rose Njeri Kamwea', 'kev@gmail.com', '+27678478784', NULL, '29797758', 18, 1, 1, '2000-09-15 00:00:00', '2017-05-10 23:51:14', 'INSIDE', 'OUTSIDE', 'Inactive', '2017-04-17 21:09:15', '2017-05-10 20:51:14'),
(2, 'Isanyad Hillary', 'hisanyad@gmail..com', '+27678478784', NULL, '40903993', 19, 1, 1, '2000-10-11 00:00:00', '2017-05-11 08:36:34', 'INSIDE', 'OUTSIDE', 'Inactive', '2017-04-17 21:10:11', '2017-05-11 05:36:34'),
(3, 'David Otuya', 'daveotyuya@gmail.com', '+254719289389', NULL, '5050900', 19, 1, 1, '2000-11-07 00:00:00', '2017-04-18 00:12:33', 'INSIDE', 'OUTSIDE', 'Inactive', '2017-04-17 21:11:07', '2017-04-17 21:12:33'),
(4, 'Isanyad Hillary', 'hisanyad@gmail..com', '+254719289389', NULL, '30273027', 18, 1, 1, '2017-05-12 11:07:49', '2017-05-12 11:08:44', 'INSIDE', 'OUTSIDE', 'Inactive', '2017-05-12 08:07:49', '2017-05-12 08:08:44');

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` int(10) UNSIGNED NOT NULL,
  `invoice_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `issued_to` int(10) UNSIGNED NOT NULL,
  `issue_date` date DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `space_id` int(10) UNSIGNED DEFAULT NULL,
  `provider_id` int(10) UNSIGNED DEFAULT NULL,
  `amount` double NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `reason` text COLLATE utf8_unicode_ci,
  `status` enum('Overdue','Pending','Paid','On Hold','InValid','Cancelled') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `invoice_number`, `issued_to`, `issue_date`, `due_date`, `space_id`, `provider_id`, `amount`, `description`, `reason`, `status`, `created_at`, `updated_at`) VALUES
(3, '#276751', 18, '2017-04-15', '2017-04-22', 1, 1, 27500, NULL, NULL, 'Paid', '2017-04-15 19:33:07', '2017-04-15 22:20:14'),
(4, '#234818', 19, '2017-04-17', '2017-04-24', 2, 1, 30000, NULL, NULL, 'Paid', '2017-04-17 20:37:47', '2017-04-17 20:41:44'),
(5, '#206460', 18, '2017-04-17', '2017-05-01', 1, 1, 1500, 'djdjdkjjd', NULL, 'Pending', '2017-04-17 20:55:03', '2017-04-17 20:55:03'),
(6, '#239530', 18, '2017-04-18', '2017-05-02', 1, 1, 2500, 'djkdkjjdddjdjd', NULL, 'Paid', '2017-04-17 21:01:28', '2017-04-17 21:18:55'),
(7, '#142076', 18, '2017-05-01', '2017-05-08', 1, 1, 17500, 'Being Request for Rent payment for next Month', NULL, 'Pending', '2017-05-07 20:23:36', '2017-05-07 20:23:36'),
(8, '#161116', 19, '2017-05-01', '2017-05-08', 2, 1, 5000, 'Being Request for Rent payment for next Month', NULL, 'Pending', '2017-05-07 20:23:37', '2017-05-07 20:23:37');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8_unicode_ci NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_requests`
--

CREATE TABLE `job_requests` (
  `id` int(10) UNSIGNED NOT NULL,
  `property_id` int(11) NOT NULL,
  `client_user_id` int(11) NOT NULL,
  `provider_id` int(11) DEFAULT NULL,
  `job_start_date` date DEFAULT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `job_description` text COLLATE utf8_unicode_ci,
  `status` enum('Pending','Approved','Rejected','Suspended','Completed','OnGoing') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Pending',
  `request_close_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `service_number` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reason` text COLLATE utf8_unicode_ci,
  `repair_request_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `job_requests`
--

INSERT INTO `job_requests` (`id`, `property_id`, `client_user_id`, `provider_id`, `job_start_date`, `type`, `job_description`, `status`, `request_close_date`, `created_at`, `updated_at`, `service_number`, `reason`, `repair_request_id`) VALUES
(1, 1, 2, 14, '2017-05-18', 'Plumbing', NULL, 'Rejected', '2017-05-02', NULL, '2017-04-29 11:53:12', '968090', 'Am much occuped', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `owner_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `owner_id` int(11) NOT NULL,
  `old_value` text COLLATE utf8_unicode_ci,
  `new_value` text COLLATE utf8_unicode_ci,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `route` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ip` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `user_id`, `owner_type`, `owner_id`, `old_value`, `new_value`, `type`, `route`, `ip`, `created_at`, `updated_at`) VALUES
(1, 1, 'App\\User', 2, 'null', '{"name":"Abraham Moses","email":"hisanyad@gmail.com","password":"$2y$10$oaYWVgo9HYAmN2TMXjhvQuz62wIDbGKUnPkfSab\\/6C3AnnWHiCtZu","verification_code":"tCemkP","provider":"manual","social":0}', 'created', 'http://realestate.dev/backend/provider/store', '127.0.0.1', '2017-04-15 10:05:23', '2017-04-15 10:05:23'),
(2, 1, 'App\\User', 1, '{"remember_token":null}', '{"remember_token":"BHFMzgSfQHkMOwxVsmJ0aLscf2sP5aEFho0QNNSxgaCsTlXacS0yiisZi8D7"}', 'updated', 'http://realestate.dev/logout', '127.0.0.1', '2017-04-15 10:05:43', '2017-04-15 10:05:43'),
(3, 2, 'App\\User', 3, 'null', '{"email":"hilaryisanya@yahoo.com","name":"76767676","verification_code":"2ivgPufm","confirmed_at":"2017-04-15 13:18:47","password":"$2y$10$BiO6LIbIuSbXFHfbybA3MO1.LzyZDfcpojCTtjK0rC3p\\/MKmxWj5q","provider":"Manual"}', 'created', 'http://realestate.dev/backend/property/update_details/1', '127.0.0.1', '2017-04-15 10:18:47', '2017-04-15 10:18:47'),
(4, 2, 'App\\User', 2, '{"remember_token":null}', '{"remember_token":"Fr43Kps30KgAeFllDAwudNmOXlPebhR8TnbHOchqYrOHvfNrpPtwpWaaRxEO"}', 'updated', 'http://realestate.dev/logout', '127.0.0.1', '2017-04-15 10:22:54', '2017-04-15 10:22:54'),
(5, 1, 'App\\User', 1, '{"remember_token":"BHFMzgSfQHkMOwxVsmJ0aLscf2sP5aEFho0QNNSxgaCsTlXacS0yiisZi8D7"}', '{"remember_token":"1fK04bJslXIsmbEhTR5vu9w8tMOi82sMY9BYycC4O9yaNvurep0o1MKVHuRd"}', 'updated', 'http://realestate.dev/logout', '127.0.0.1', '2017-04-15 14:36:33', '2017-04-15 14:36:33'),
(20, 2, 'App\\User', 18, 'null', '{"name":"Mary Bosire","email":"mary@gmail.com","password":"$2y$10$FKz9l.qzqI1g6j7wksFeF.wcTnYsPhYNUIsKqe2xwOaSKftmWRk9a","verification_code":"gMoxmwCE","confirmed_at":"2017-04-15 22:33:06","provider":"Manual"}', 'created', 'http://realestate.dev/backend/tenants/store', '127.0.0.1', '2017-04-15 19:33:06', '2017-04-15 19:33:06'),
(21, 2, 'App\\User', 2, '{"remember_token":"Fr43Kps30KgAeFllDAwudNmOXlPebhR8TnbHOchqYrOHvfNrpPtwpWaaRxEO"}', '{"remember_token":"JSIvJmPCNdmSFYzErEFe8IvwClKkcncGvieJe4jJ186YNUIuA7uxBnoQrYWi"}', 'updated', 'http://realestate.dev/logout', '127.0.0.1', '2017-04-17 08:26:38', '2017-04-17 08:26:38'),
(22, 1, 'App\\User', 1, '{"remember_token":"1fK04bJslXIsmbEhTR5vu9w8tMOi82sMY9BYycC4O9yaNvurep0o1MKVHuRd"}', '{"remember_token":"JzZzQXQDRiwe5jhdjoGxgR1m7McxCaza09TC23nA8wRM2x0beE8Wp0uruVsJ"}', 'updated', 'http://realestate.dev/logout', '127.0.0.1', '2017-04-17 08:38:50', '2017-04-17 08:38:50'),
(23, 2, 'App\\User', 2, '{"remember_token":"JSIvJmPCNdmSFYzErEFe8IvwClKkcncGvieJe4jJ186YNUIuA7uxBnoQrYWi"}', '{"remember_token":"LJ5PFsI4IqZ92d0PPMKh3QJ8TiP45xNCOov9jl5vSrXeS3TrbK5pzT1d5OGb"}', 'updated', 'http://realestate.dev/logout', '127.0.0.1', '2017-04-17 19:06:10', '2017-04-17 19:06:10'),
(24, 18, 'App\\User', 18, '{"remember_token":null}', '{"remember_token":"1flD4rmNFoo9Ljs4t6FvYptMgJQPbgjlzQP4uVSAmLenjo5BmUX8ODZ7MaSu"}', 'updated', 'http://realestate.dev/logout', '127.0.0.1', '2017-04-17 19:55:06', '2017-04-17 19:55:06'),
(25, 2, 'App\\User', 19, 'null', '{"name":"Stephen Mwaura","email":"stephen.mwaura@ict.go.ke","password":"$2y$10$HYAweifH24zR1.4ybksbiOUtmvtDvzpLSHAp9DOcJHduJnbHSFPye","verification_code":"eDXrIOdh","confirmed_at":"2017-04-17 23:37:47","provider":"Manual"}', 'created', 'http://realestate.dev/backend/tenants/store', '127.0.0.1', '2017-04-17 20:37:47', '2017-04-17 20:37:47'),
(26, 2, 'App\\User', 2, '{"remember_token":"LJ5PFsI4IqZ92d0PPMKh3QJ8TiP45xNCOov9jl5vSrXeS3TrbK5pzT1d5OGb"}', '{"remember_token":"5OMf6ZlUg1sT5vCvyk8XyDX11GT57YYyMOX6b5CZX8cndOp7bNiJMjZ8dAcw"}', 'updated', 'http://realestate.dev/logout', '127.0.0.1', '2017-04-17 20:46:33', '2017-04-17 20:46:33'),
(27, 18, 'App\\User', 18, '{"remember_token":"1flD4rmNFoo9Ljs4t6FvYptMgJQPbgjlzQP4uVSAmLenjo5BmUX8ODZ7MaSu"}', '{"remember_token":"6m62Z22msPWJAdKg6CszG7vqKdba8kDN6p6hC95hK41sQ69s5JWbceY9Q7i1"}', 'updated', 'http://realestate.dev/logout', '127.0.0.1', '2017-04-17 20:48:41', '2017-04-17 20:48:41'),
(28, 2, 'App\\User', 2, '{"remember_token":"5OMf6ZlUg1sT5vCvyk8XyDX11GT57YYyMOX6b5CZX8cndOp7bNiJMjZ8dAcw"}', '{"remember_token":"UlYZ4dWHhE8kprdXn3vbHABBhLpniG2H0kKv2LRPWXaWOeP5B0pgiVQXXA2m"}', 'updated', 'http://realestate.dev/logout', '127.0.0.1', '2017-04-17 20:56:12', '2017-04-17 20:56:12'),
(29, 18, 'App\\User', 18, '{"remember_token":"6m62Z22msPWJAdKg6CszG7vqKdba8kDN6p6hC95hK41sQ69s5JWbceY9Q7i1"}', '{"remember_token":"n4HnNcZDfLvdQTofkUF8WNXzdLODVXwKWr8vMDPVeeURVcSBy4FpLMelsypt"}', 'updated', 'http://realestate.dev/logout', '127.0.0.1', '2017-04-17 20:59:50', '2017-04-17 20:59:50'),
(30, 2, 'App\\User', 20, 'null', '{"name":"Joseph Mutie","email":"8vz@hk4.gov","password":"$2y$10$oYIcLVRf.TqCnw4MrRd3be45Uf5AQzYb8Kl4nJEUY789kwuU.lFDm","provider":"Manual","verification_code":"d4Pmtm","status":"Active","confirmed_at":"2017-04-18 00:05:08"}', 'created', 'http://realestate.dev/security/guards/create', '127.0.0.1', '2017-04-17 21:05:08', '2017-04-17 21:05:08'),
(31, 2, 'App\\User', 2, '{"remember_token":"UlYZ4dWHhE8kprdXn3vbHABBhLpniG2H0kKv2LRPWXaWOeP5B0pgiVQXXA2m"}', '{"remember_token":"RsVt02N45qmNWa0v1XdAFBvbO7O1GsJAjOIzlNIRQwbz5ltoZVow9p63n3wz"}', 'updated', 'http://realestate.dev/logout', '127.0.0.1', '2017-04-17 21:06:36', '2017-04-17 21:06:36'),
(32, 20, 'App\\User', 20, '{"remember_token":null}', '{"remember_token":"ASayFf21Jj03cdUnRajtMNcfblwjNto4VLuZ2rPcS3koebtSorwjXa8BrsO3"}', 'updated', 'http://realestate.dev/logout', '127.0.0.1', '2017-04-17 21:12:37', '2017-04-17 21:12:37'),
(33, 2, 'App\\User', 2, '{"remember_token":"RsVt02N45qmNWa0v1XdAFBvbO7O1GsJAjOIzlNIRQwbz5ltoZVow9p63n3wz"}', '{"remember_token":"BUOAoObkbHdP0uijvh20ANhCu6RPMh2w8KGCSegOatK8DBPydJABQkfWbMDV"}', 'updated', 'http://realestate.dev/logout', '127.0.0.1', '2017-04-17 21:21:19', '2017-04-17 21:21:19'),
(34, 2, 'App\\User', 2, '{"remember_token":"BUOAoObkbHdP0uijvh20ANhCu6RPMh2w8KGCSegOatK8DBPydJABQkfWbMDV"}', '{"remember_token":"GkO0wMWatY1TfukBTJNN0BdO61Qlbltoxl0GxViY7FekAz5aD55vEg0QGvj8"}', 'updated', 'http://localhost/isanyd/public/logout', '127.0.0.1', '2017-04-19 10:03:15', '2017-04-19 10:03:15'),
(35, 2, 'App\\User', 2, '{"remember_token":"GkO0wMWatY1TfukBTJNN0BdO61Qlbltoxl0GxViY7FekAz5aD55vEg0QGvj8"}', '{"remember_token":"a66reh5OauQg9c2ZzBzGf7h8fWeFCnnyiDniG2GCrPEEmvZ1NxoAnPBVSuay"}', 'updated', 'http://localhost/isanyd/public/logout', '127.0.0.1', '2017-04-19 10:05:13', '2017-04-19 10:05:13'),
(65, NULL, 'App\\User', 50, 'null', '{"name":"Isanya Hillary Likovelo","email":"mwea@gmail.com","password":"$2y$10$9YsrBCEtG4ykewiaF1P1ye7lwNhYP.uHKqlKa2INIJ7i4MQyiIZX2","verification_code":"0Bp32HtY","provider":"Manual"}', 'created', 'http://realestate.dev/application/patners', '127.0.0.1', '2017-04-29 07:28:03', '2017-04-29 07:28:03'),
(66, NULL, 'App\\User', 51, 'null', '{"name":"Moses Shikutwa","email":"moses@gmail.com","password":"$2y$10$d8aFelhsBT\\/kXNaVWso9duNqpkpz0jyd.Qu4qvS6XU7hKgoL.7EcK","verification_code":"7pGD0N5p","provider":"Manual"}', 'created', 'http://realestate.dev/application/patners', '127.0.0.1', '2017-04-29 07:31:45', '2017-04-29 07:31:45'),
(67, NULL, 'App\\User', 52, 'null', '{"name":"Moses Shikutwa","email":"mwea4@gmail.com","password":"$2y$10$8tkTPGeTeRZ8itN..1MIGOCfhieJa1TjX\\/j9kHv9WlTA5gGiS5bKy","verification_code":"gW5UqnBD","provider":"Manual"}', 'created', 'http://realestate.dev/application/patners', '127.0.0.1', '2017-04-29 07:32:38', '2017-04-29 07:32:38'),
(68, 52, 'App\\User', 53, 'null', '{"name":"Isanya Hillary","email":"isanya@gmail.com","password":"$2y$10$knHnJb7SKqNOvenfOacXq.KudfiSoXnVu\\/7ZWg.BXqD0Z.9u4RUBO","verification_code":"HXsLlYoy","provider":"Manual"}', 'created', 'http://realestate.dev/application/patners', '127.0.0.1', '2017-04-29 07:36:02', '2017-04-29 07:36:02'),
(69, 53, 'App\\User', 53, '{"remember_token":null}', '{"remember_token":"YVYSpjyICk7cxFn6tzPZYWRBeMwNa5CEnkEU2yGBSMXeT2fGOqgTOETxClpo"}', 'updated', 'http://realestate.dev/logout', '127.0.0.1', '2017-04-29 11:07:14', '2017-04-29 11:07:14'),
(70, 2, 'App\\User', 2, '{"remember_token":"a66reh5OauQg9c2ZzBzGf7h8fWeFCnnyiDniG2GCrPEEmvZ1NxoAnPBVSuay"}', '{"remember_token":"eOLQWZkhcMQSILiKIi3Q3uTgiv9XRUU9o3qnNoDXiiYe05SVBWYMEKwGmEAR"}', 'updated', 'http://realestate.dev/logout', '127.0.0.1', '2017-04-29 11:11:07', '2017-04-29 11:11:07'),
(71, 53, 'App\\User', 53, '{"remember_token":"YVYSpjyICk7cxFn6tzPZYWRBeMwNa5CEnkEU2yGBSMXeT2fGOqgTOETxClpo"}', '{"remember_token":"ObLpDYAkJcp2S1QmXj8JlXori5zeIkHFiBdu6kbbDx5W5AznZaWeudCLBlo0"}', 'updated', 'http://realestate.dev/logout', '127.0.0.1', '2017-04-29 11:53:38', '2017-04-29 11:53:38'),
(72, 2, 'App\\User', 2, '{"remember_token":"eOLQWZkhcMQSILiKIi3Q3uTgiv9XRUU9o3qnNoDXiiYe05SVBWYMEKwGmEAR"}', '{"remember_token":"bywvKAit8Aq6K8ZQg5oEpNtako6H8CigCTL92gFtJ2xg1MGVtGvFc3vPfJ2m"}', 'updated', 'http://realestate.dev/logout', '127.0.0.1', '2017-04-29 11:56:08', '2017-04-29 11:56:08'),
(73, 1, 'App\\User', 1, '{"remember_token":"JzZzQXQDRiwe5jhdjoGxgR1m7McxCaza09TC23nA8wRM2x0beE8Wp0uruVsJ"}', '{"remember_token":"qAGhBSvSEVwfxp3x2gn8NhEPn1jELBEN3cZcaPQJISei0vcTYLa9uzFRiZog"}', 'updated', 'http://realestate.dev/logout', '127.0.0.1', '2017-04-29 12:30:56', '2017-04-29 12:30:56'),
(74, 1, 'App\\User', 1, '{"remember_token":"qAGhBSvSEVwfxp3x2gn8NhEPn1jELBEN3cZcaPQJISei0vcTYLa9uzFRiZog"}', '{"remember_token":"aN3u5DBrgHO2T404X97xIFyE5pOnyR2Zj1U5WjX6aTmQmU74UqG13S1kJxVa"}', 'updated', 'http://realestate.dev/logout', '127.0.0.1', '2017-04-29 12:49:16', '2017-04-29 12:49:16'),
(75, 53, 'App\\User', 53, '{"remember_token":"ObLpDYAkJcp2S1QmXj8JlXori5zeIkHFiBdu6kbbDx5W5AznZaWeudCLBlo0"}', '{"remember_token":"Ed85lBXalN8rb2kUHuOJYNgyKi6E1iLvOkYrwmyHYN7jVqZforrMo2bCcFec"}', 'updated', 'http://realestate.dev/logout', '127.0.0.1', '2017-04-29 18:23:43', '2017-04-29 18:23:43'),
(76, 2, 'App\\User', 2, '{"remember_token":"bywvKAit8Aq6K8ZQg5oEpNtako6H8CigCTL92gFtJ2xg1MGVtGvFc3vPfJ2m"}', '{"remember_token":"4daIpNfPCfsJGeXSat8D3cTTlepx8NwC8Xf4QWphxfG5bMWTBtAFi77RJOyW"}', 'updated', 'http://realestate.dev/logout', '127.0.0.1', '2017-04-29 18:24:10', '2017-04-29 18:24:10'),
(77, 1, 'App\\User', 1, '{"remember_token":"aN3u5DBrgHO2T404X97xIFyE5pOnyR2Zj1U5WjX6aTmQmU74UqG13S1kJxVa"}', '{"remember_token":"uc3zXKvKszhRpsNMZlFpfco0jkFg0fL3DajrnuL69Hm1LFaQfMHnIVfDEgYm"}', 'updated', 'http://realestate.dev/logout', '127.0.0.1', '2017-04-30 06:32:14', '2017-04-30 06:32:14'),
(78, 53, 'App\\User', 53, '{"remember_token":"Ed85lBXalN8rb2kUHuOJYNgyKi6E1iLvOkYrwmyHYN7jVqZforrMo2bCcFec"}', '{"remember_token":"RUj8WsyBg3yCjocHlTTKny8QxPF9yPDYEqGngLFiAs7oXsE1QjmMUXDPMDjw"}', 'updated', 'http://realestate.dev/logout', '127.0.0.1', '2017-04-30 07:07:20', '2017-04-30 07:07:20'),
(79, 1, 'App\\User', 1, '{"remember_token":"uc3zXKvKszhRpsNMZlFpfco0jkFg0fL3DajrnuL69Hm1LFaQfMHnIVfDEgYm"}', '{"remember_token":"2Aa5utjw0JN7Tp06UnJDjaGUgLxUVwLkOLThn9Hr4YGI3bYUom3pFGmBP7LI"}', 'updated', 'http://realestate.dev/logout', '127.0.0.1', '2017-04-30 07:50:06', '2017-04-30 07:50:06'),
(80, 53, 'App\\User', 53, '{"remember_token":"RUj8WsyBg3yCjocHlTTKny8QxPF9yPDYEqGngLFiAs7oXsE1QjmMUXDPMDjw"}', '{"remember_token":"UkSqDcMs65GSf4CKwe9XIUNoORVLzMlDucy2d9C6fE3Vpj6AVainMQFh3ukf"}', 'updated', 'http://realestate.dev/logout', '127.0.0.1', '2017-04-30 07:50:48', '2017-04-30 07:50:48'),
(81, 2, 'App\\User', 2, '{"remember_token":"4daIpNfPCfsJGeXSat8D3cTTlepx8NwC8Xf4QWphxfG5bMWTBtAFi77RJOyW"}', '{"remember_token":"FyTwt5pNT36A7iX42vbZZN0ZmXxYfygGPvnoXj80kRQmNDpdMkhMxQxHlYqk"}', 'updated', 'http://realestate.dev/logout', '127.0.0.1', '2017-04-30 07:56:59', '2017-04-30 07:56:59'),
(82, 1, 'App\\User', 1, '{"remember_token":"2Aa5utjw0JN7Tp06UnJDjaGUgLxUVwLkOLThn9Hr4YGI3bYUom3pFGmBP7LI"}', '{"remember_token":"mSr8TnykQAsy8NiT8TxyBhkIv6eIaTRKGwSZIlZTZ9EBY63RXGxENO41eQTC"}', 'updated', 'http://realestate.dev/logout', '127.0.0.1', '2017-04-30 09:57:45', '2017-04-30 09:57:45'),
(83, 2, 'App\\User', 2, '{"remember_token":"FyTwt5pNT36A7iX42vbZZN0ZmXxYfygGPvnoXj80kRQmNDpdMkhMxQxHlYqk"}', '{"remember_token":"8Qo73dqBfjsNbEhyBess0JDWSf4sLaWUgKNpS6Pw1CbzGgk9xhxXHn1xh95i"}', 'updated', 'http://realestate.dev/logout', '127.0.0.1', '2017-04-30 10:14:14', '2017-04-30 10:14:14'),
(84, 1, 'App\\User', 1, '{"remember_token":"mSr8TnykQAsy8NiT8TxyBhkIv6eIaTRKGwSZIlZTZ9EBY63RXGxENO41eQTC"}', '{"remember_token":"Lbjf1rRsUBjGOgypFvwAu2Lpz5QcyQCqCh773d5WzIC2R7cVA2CoyAiECuWQ"}', 'updated', 'http://realestate.dev/logout', '127.0.0.1', '2017-04-30 11:37:57', '2017-04-30 11:37:57'),
(85, 2, 'App\\User', 2, '{"remember_token":"8Qo73dqBfjsNbEhyBess0JDWSf4sLaWUgKNpS6Pw1CbzGgk9xhxXHn1xh95i"}', '{"remember_token":"naAs6GecZFGO1iR90CehpK5fRSA5g20rtPZIljmDN3Ct2ITS65j5ihCzhmEc"}', 'updated', 'http://realestate.dev/logout', '127.0.0.1', '2017-04-30 11:51:24', '2017-04-30 11:51:24'),
(86, 1, 'App\\User', 1, '{"remember_token":"Lbjf1rRsUBjGOgypFvwAu2Lpz5QcyQCqCh773d5WzIC2R7cVA2CoyAiECuWQ"}', '{"remember_token":"Oa3TvD8pkaf2goNobgpiS2jD8bijiCNUfmk1GW6fU8MwK249E6LF1csLU95n"}', 'updated', 'http://realestate.dev/logout', '127.0.0.1', '2017-04-30 11:51:58', '2017-04-30 11:51:58'),
(87, 2, 'App\\User', 2, '{"remember_token":"naAs6GecZFGO1iR90CehpK5fRSA5g20rtPZIljmDN3Ct2ITS65j5ihCzhmEc"}', '{"remember_token":"hc3EwHqGcJ6M7n4EijpkZIZKeTaX5tl2Rg59Y2UTce20VwZlOIcxKG70DOYt"}', 'updated', 'http://realestate.dev/logout', '127.0.0.1', '2017-04-30 12:07:58', '2017-04-30 12:07:58'),
(88, 1, 'App\\User', 53, '{"status":"Active"}', '{"status":"Blocked"}', 'updated', 'http://realestate.dev/admin/user/block/53', '127.0.0.1', '2017-04-30 12:11:01', '2017-04-30 12:11:01'),
(89, 1, 'App\\User', 3, '{"status":"Active"}', '{"status":"Blocked"}', 'updated', 'http://realestate.dev/admin/user/block/3', '127.0.0.1', '2017-04-30 14:04:58', '2017-04-30 14:04:58'),
(90, 1, 'App\\User', 1, '{"remember_token":"Oa3TvD8pkaf2goNobgpiS2jD8bijiCNUfmk1GW6fU8MwK249E6LF1csLU95n"}', '{"remember_token":"5Lo5e78rKjjoLkGQpVUL3NvNGZ5XEcBQGy7MAGM6673FQW2gwAE6ILQLP8ht"}', 'updated', 'http://realestate.dev/logout', '127.0.0.1', '2017-04-30 15:02:11', '2017-04-30 15:02:11'),
(91, 2, 'App\\User', 2, '{"remember_token":"hc3EwHqGcJ6M7n4EijpkZIZKeTaX5tl2Rg59Y2UTce20VwZlOIcxKG70DOYt"}', '{"remember_token":"UFK725wm2oRVqOAa2cd6pfgOwFOjHCCDzl5YcerDgfclgHSc4Edn6mZqzUEz"}', 'updated', 'http://realestate.dev/logout', '127.0.0.1', '2017-04-30 15:05:59', '2017-04-30 15:05:59'),
(92, 1, 'App\\User', 1, '{"remember_token":"5Lo5e78rKjjoLkGQpVUL3NvNGZ5XEcBQGy7MAGM6673FQW2gwAE6ILQLP8ht"}', '{"remember_token":"voqBF2pU2bIEd2cLwfcmX958qljeUgZ6xE4do0lUfAswWeHihzRAsl3cCxJ1"}', 'updated', 'http://realestate.dev/logout', '127.0.0.1', '2017-04-30 17:40:40', '2017-04-30 17:40:40'),
(93, 18, 'App\\User', 18, '{"remember_token":"n4HnNcZDfLvdQTofkUF8WNXzdLODVXwKWr8vMDPVeeURVcSBy4FpLMelsypt"}', '{"remember_token":"14FStWClhHNs9r1IW35Df6o8TTLUoVoC41lvo80WZ3JJ1ddbZKGyQynATQYj"}', 'updated', 'http://realestate.dev/logout', '127.0.0.1', '2017-04-30 17:48:42', '2017-04-30 17:48:42'),
(94, 1, 'App\\User', 1, '{"remember_token":"voqBF2pU2bIEd2cLwfcmX958qljeUgZ6xE4do0lUfAswWeHihzRAsl3cCxJ1"}', '{"remember_token":"dp6itoQfI6zLH3U2fq9iquryrXm1mIh3D4rSio2869dG9GFAmyMaXhvS4q2E"}', 'updated', 'http://realestate.dev/logout', '127.0.0.1', '2017-04-30 19:43:01', '2017-04-30 19:43:01'),
(95, 1, 'App\\User', 1, '{"remember_token":"dp6itoQfI6zLH3U2fq9iquryrXm1mIh3D4rSio2869dG9GFAmyMaXhvS4q2E"}', '{"remember_token":"7LpFV5gFUkxWaPdc5sZjorpLUoUd06ocn8MxS8Pvb9KTNYEMvkpL0lTDLwC2"}', 'updated', 'http://realestate.dev/logout', '127.0.0.1', '2017-04-30 19:43:51', '2017-04-30 19:43:51'),
(96, 2, 'App\\User', 2, '{"remember_token":"UFK725wm2oRVqOAa2cd6pfgOwFOjHCCDzl5YcerDgfclgHSc4Edn6mZqzUEz"}', '{"remember_token":"UAj5hMZKKzWVGq3xCc7peRp3m7V16RzYfeQOOhAefy1yvEAXicYbfAuePLTI"}', 'updated', 'http://realestate.dev/logout', '127.0.0.1', '2017-04-30 19:44:33', '2017-04-30 19:44:33'),
(97, 1, 'App\\User', 1, '{"remember_token":"7LpFV5gFUkxWaPdc5sZjorpLUoUd06ocn8MxS8Pvb9KTNYEMvkpL0lTDLwC2"}', '{"remember_token":"bzuEi4e3U51NBgyrLdXqOajd4FS3LBvsuV9d4eDieJtFRjbSwEfKY8xe3oGW"}', 'updated', 'http://realestate.dev/logout', '127.0.0.1', '2017-04-30 19:45:21', '2017-04-30 19:45:21'),
(98, 2, 'App\\User', 2, '{"remember_token":"UAj5hMZKKzWVGq3xCc7peRp3m7V16RzYfeQOOhAefy1yvEAXicYbfAuePLTI"}', '{"remember_token":"VP340NPlta4jUHyVuucxjImbHsnXG2yX8tmLzzv9JzA60nA6pPqKfxdeduP0"}', 'updated', 'http://realestate.dev/logout', '127.0.0.1', '2017-04-30 20:02:30', '2017-04-30 20:02:30'),
(99, 1, 'App\\User', 1, '{"remember_token":"bzuEi4e3U51NBgyrLdXqOajd4FS3LBvsuV9d4eDieJtFRjbSwEfKY8xe3oGW"}', '{"remember_token":"xgBC2qo3QKOrmJcftESq7cUjAiumhgIzjbzR5qjtrCW54QpXgLq3LtpRlHJL"}', 'updated', 'http://realestate.dev/logout', '127.0.0.1', '2017-04-30 20:04:32', '2017-04-30 20:04:32'),
(100, 2, 'App\\User', 2, '{"remember_token":"VP340NPlta4jUHyVuucxjImbHsnXG2yX8tmLzzv9JzA60nA6pPqKfxdeduP0"}', '{"remember_token":"c0JL0eRbftyjBv2zQvJfBFKb1wefW8LeVWfxEtE8x4ST5Ey1i4yiEH5DPrmK"}', 'updated', 'http://realestate.dev/logout', '127.0.0.1', '2017-04-30 20:12:40', '2017-04-30 20:12:40'),
(104, 1, 'App\\User', 57, 'null', '{"name":"Salama  Salama","email":"salama@gmail.com","password":"$2y$10$8NCmL6.Aqo6\\/Kj7gWQCJE.Ts3\\/20kUgl0FXNP0EsgOzjr00rNu6PC","verification_code":"KDDgcF","provider":"manual","social":0}', 'created', 'http://realestate.dev/backend/provider/store', '127.0.0.1', '2017-04-30 20:16:30', '2017-04-30 20:16:30'),
(111, 1, 'App\\User', 64, 'null', '{"name":"Khetias Kitale","email":"kam@gmial.com","password":"$2y$10$BC9lcShGXwSTRPrYZXq8KeGNWefJhHVfPQp3oRQajrfjSteRn4sUS","verification_code":"9BrDmE","provider":"manual","social":0}', 'created', 'http://realestate.dev/backend/provider/store', '127.0.0.1', '2017-04-30 20:25:10', '2017-04-30 20:25:10'),
(112, 1, 'App\\User', 1, '{"remember_token":"xgBC2qo3QKOrmJcftESq7cUjAiumhgIzjbzR5qjtrCW54QpXgLq3LtpRlHJL"}', '{"remember_token":"vHo5UbYJQbZKXZPaVVqRSBYraN3tAg0P3sYMBUn3yUTQQgDzpxrdq7zF0bIP"}', 'updated', 'http://realestate.dev/logout', '127.0.0.1', '2017-04-30 20:45:57', '2017-04-30 20:45:57'),
(113, 2, 'App\\User', 2, '{"remember_token":"c0JL0eRbftyjBv2zQvJfBFKb1wefW8LeVWfxEtE8x4ST5Ey1i4yiEH5DPrmK"}', '{"remember_token":"RckPZkq0nf0CAqWIHouOEVhLJ1xraZxlliAKJaz6IASsu06zcuaDvQLZFm5t"}', 'updated', 'http://realestate.dev/logout', '127.0.0.1', '2017-05-10 19:15:05', '2017-05-10 19:15:05'),
(114, 2, 'App\\User', 2, '{"remember_token":"RckPZkq0nf0CAqWIHouOEVhLJ1xraZxlliAKJaz6IASsu06zcuaDvQLZFm5t"}', '{"remember_token":"wW8EAfyrzRJZCTE5UeS3EryuXKbVCmXXN9Hsb3mrYpQwqymsucUawEuDOvQp"}', 'updated', 'http://realestate.dev/logout', '127.0.0.1', '2017-05-10 19:15:48', '2017-05-10 19:15:48'),
(115, 18, 'App\\User', 18, '{"remember_token":"14FStWClhHNs9r1IW35Df6o8TTLUoVoC41lvo80WZ3JJ1ddbZKGyQynATQYj"}', '{"remember_token":"xTB47mCUdTiTKkoIq8l5JrJRuoiKpxKwrRqaA42KHfxoIdz8jCH1xOp5DIv5"}', 'updated', 'http://realestate.dev/logout', '127.0.0.1', '2017-05-10 20:24:33', '2017-05-10 20:24:33'),
(116, 20, 'App\\User', 20, '{"remember_token":"ASayFf21Jj03cdUnRajtMNcfblwjNto4VLuZ2rPcS3koebtSorwjXa8BrsO3"}', '{"remember_token":"koK4u70clobl3On7vxwnVMsamdn0kc9tXzPJlsHuB2sdnYI9juGUmsv3xlJz"}', 'updated', 'http://realestate.dev/logout', '127.0.0.1', '2017-05-11 06:21:22', '2017-05-11 06:21:22'),
(117, 18, 'App\\User', 18, '{"remember_token":"xTB47mCUdTiTKkoIq8l5JrJRuoiKpxKwrRqaA42KHfxoIdz8jCH1xOp5DIv5"}', '{"remember_token":"VoByia4fZLfoQ147L4DUyHTd4LOanbmVeD7BBRxY8Ifio6yOnuMXPl8LzIIL"}', 'updated', 'http://realestate.dev/logout', '127.0.0.1', '2017-05-13 07:13:20', '2017-05-13 07:13:20'),
(118, 2, 'Modules\\Backend\\Entities\\Plot', 1, '{"added_valeu":"[\\"Is Fenced\\",\\"Title Deeds Available\\",\\"Internal Murram Roads\\"]","description":"jvjhfhfjffhffj  fnbffhhjffhjf  fhjfjhhfj"}', '{"added_valeu":"[\\"Is Fenced\\",\\"Title Deeds Available\\"]","description":"jvjhfhfjffhffj  fnbffhhjffhjf  fhjfjhhfj  fjhjfhjfhjfhjfh"}', 'updated', 'http://realestate.dev/backend/plots/update/1', '127.0.0.1', '2017-05-14 07:57:46', '2017-05-14 07:57:46'),
(119, 2, 'Modules\\Backend\\Entities\\Plot', 1, '{"city":"Mwea"}', '{"city":"Mwea Teberre"}', 'updated', 'http://realestate.dev/backend/plots/update/1', '127.0.0.1', '2017-05-14 07:59:24', '2017-05-14 07:59:24'),
(120, 2, 'Modules\\Backend\\Entities\\Plot', 1, '{"added_valeu":"[\\"Is Fenced\\",\\"Title Deeds Available\\"]"}', '{"added_valeu":"[\\"Is Fenced\\",\\"Title Deeds Available\\",\\"Perimeter wall\\"]"}', 'updated', 'http://realestate.dev/backend/plots/update/1', '127.0.0.1', '2017-05-14 08:01:35', '2017-05-14 08:01:35'),
(121, 2, 'Modules\\Backend\\Entities\\Plot', 1, '{"plot_status":"On Sale"}', '{"plot_status":"Sold"}', 'updated', 'http://realestate.dev/backend/plots/update/1', '127.0.0.1', '2017-05-14 08:52:51', '2017-05-14 08:52:51'),
(122, 2, 'Modules\\Backend\\Entities\\Plot', 1, '{"plot_status":"Sold"}', '{"plot_status":"On Sale"}', 'updated', 'http://realestate.dev/backend/plots/update/1', '127.0.0.1', '2017-05-14 09:04:06', '2017-05-14 09:04:06'),
(123, 2, 'Modules\\Backend\\Entities\\Plot', 1, '{"added_valeu":"[\\"Is Fenced\\",\\"Title Deeds Available\\",\\"Perimeter wall\\"]"}', '{"added_valeu":"[\\"Is Fenced\\",\\"Connected Water\\",\\"Title Deeds Available\\",\\"Perimeter wall\\",\\"Police post\\"]"}', 'updated', 'http://realestate.dev/backend/plots/update/1', '127.0.0.1', '2017-05-14 09:49:38', '2017-05-14 09:49:38'),
(124, 2, 'Modules\\Backend\\Entities\\Plot', 1, '{"added_valeu":"[\\"Is Fenced\\",\\"Connected Water\\",\\"Title Deeds Available\\",\\"Perimeter wall\\",\\"Police post\\"]"}', '{"added_valeu":"[\\"Is Fenced\\",\\"Connected Water\\",\\"Next To Hospital\\",\\"Title Deeds Available\\",\\"Perimeter wall\\",\\"Police post\\"]"}', 'updated', 'http://realestate.dev/backend/plots/update/1', '127.0.0.1', '2017-05-14 09:52:27', '2017-05-14 09:52:27');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Provider',
  `type_id` int(11) DEFAULT NULL,
  `message` text COLLATE utf8_unicode_ci,
  `delvery_status` enum('DELIVERED','EXPIRED','HANDSET_ERRORS','OK','OPERATOR_ERRORS','PENDING','REJECTED','UNDELIVERABLE','USER_ERRORS') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'DELIVERED',
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mesage_size` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `type`, `type_id`, `message`, `delvery_status`, `phone`, `mesage_size`, `created_at`, `updated_at`) VALUES
(1, 'Provider', 1, 'New PropertyAuroville apartments is being added by - +254708236804with the following details:\n Ip Address127.0.0.1\n Server Name :realestate.dev\n  : Server Address :127.111.73.1\n Requested url :/backend/property/store Agents :Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:52.0) Gecko/20100101 Firefox/52.0', 'DELIVERED', '+254708236804', 2, '2017-03-15 10:15:25', '2017-04-15 10:15:25'),
(2, 'Provider', 1, 'Dear 76767676 A new Account has been created for you at the Qootu.com platform. use your email :hilaryisanya@yahoo.com  and  Password :qZgmT6 to log to the portal', 'DELIVERED', '+254708236804', 2, '2017-04-15 10:18:49', '2017-04-15 10:18:49'),
(3, 'Provider', 1, 'New PropertyMonterey Villa and Apartments is being added by - +254708236804with the following details:\n Ip Address127.0.0.1\n Server Name :realestate.dev\n  : Server Address :127.111.73.1\n Requested url :/backend/property/store Agents :Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:52.0) Gecko/20100101 Firefox/52.0', 'DELIVERED', '+254708236804', 2, '2017-03-15 15:19:54', '2017-04-15 15:19:54'),
(12, 'Provider', 1, 'Dear Qooetu  companies , 300 has been debitted to your account.You will be notified shortly once transaction has been approved by SMS Service Provider', 'DELIVERED', '+254708236804', 2, '2017-04-16 10:38:20', '2017-04-16 10:38:20'),
(13, 'Provider', 1, 'Transaction #:3563656730, Dear Isanya Hillary ,Qooetu  companies   has purchased SMS Items for 300. Kindly approve the transaction to activate the sms items', 'DELIVERED', '+254708236804', 2, '2017-04-16 10:38:20', '2017-04-16 10:38:20'),
(14, 'Provider', 1, 'Transaction #:3563656730, Dear David Otuya ,Qooetu  companies   has purchased SMS Items for 300. Kindly approve the transaction to activate the sms items', 'DELIVERED', '+254719289389', 2, '2017-04-16 10:38:20', '2017-04-16 10:38:20'),
(15, 'Provider', 1, 'Dear Qooetu  companies , 1000 has been debitted to your account.You will be notified shortly once transaction has been approved by SMS Service Provider', 'DELIVERED', '+254708236804', 2, '2017-04-16 10:39:22', '2017-04-16 10:39:22'),
(16, 'Provider', 1, 'Transaction #:4dvchn90, Dear Isanya Hillary ,Qooetu  companies   has purchased SMS Items for 1000. Kindly approve the transaction to activate the sms items', 'DELIVERED', '+254708236804', 1, '2017-04-16 10:39:22', '2017-04-16 10:39:22'),
(17, 'Provider', 1, 'Transaction #:4dvchn90, Dear David Otuya ,Qooetu  companies   has purchased SMS Items for 1000. Kindly approve the transaction to activate the sms items', 'DELIVERED', '+254719289389', 1, '2017-04-16 10:39:22', '2017-04-16 10:39:22'),
(18, 'Provider', 1, 'Dear Qooetu  companies , 250 has been debitted to your account.You will be notified shortly once transaction has been approved by SMS Service Provider', 'DELIVERED', '+254708236804', 2, '2017-04-16 11:09:21', '2017-04-16 11:09:21'),
(19, 'Provider', 1, 'Transaction #:LDG803NYK, Dear Isanya Hillary ,Qooetu  companies   has purchased SMS Items for 250. Kindly approve the transaction to activate the sms items', 'DELIVERED', '+254708236804', 1, '2017-04-16 11:09:21', '2017-04-16 11:09:21'),
(20, 'Provider', 1, 'Transaction #:LDG803NYK, Dear David Otuya ,Qooetu  companies   has purchased SMS Items for 250. Kindly approve the transaction to activate the sms items', 'DELIVERED', '+254719289389', 1, '2017-04-16 11:09:21', '2017-04-16 11:09:21'),
(21, 'Provider', 1, 'Dear Qooetu  companies , 250 has been debitted to your account.You will be notified shortly once transaction has been approved by SMS Service Provider', 'DELIVERED', '+254708236804', 2, '2017-04-16 11:10:57', '2017-04-16 11:10:57'),
(22, 'Provider', 1, 'Transaction #:LDG803NYK, Dear Isanya Hillary ,Qooetu  companies   has purchased SMS Items for 250. Kindly approve the transaction to activate the sms items', 'DELIVERED', '+254708236804', 1, '2017-04-16 11:10:58', '2017-04-16 11:10:58'),
(23, 'Provider', 1, 'Transaction #:LDG803NYK, Dear David Otuya ,Qooetu  companies   has purchased SMS Items for 250. Kindly approve the transaction to activate the sms items', 'DELIVERED', '+254719289389', 1, '2017-04-16 11:11:00', '2017-04-16 11:11:00'),
(24, 'Provider', 1, 'Dear Qooetu  companies , 250 has been debitted to your account.You will be notified shortly once transaction has been approved by SMS Service Provider', 'DELIVERED', '+254708236804', 2, '2017-04-16 11:39:25', '2017-04-16 11:39:25'),
(25, 'Provider', 1, 'Transaction #:LDG906NYM, Dear Isanya Hillary ,Qooetu  companies   has purchased SMS Items for 250. Kindly approve the transaction to activate the sms items', 'DELIVERED', '+254708236804', 1, '2017-04-16 11:39:33', '2017-04-16 11:39:33'),
(26, 'Provider', 1, 'Transaction #:LDG906NYM, Dear David Otuya ,Qooetu  companies   has purchased SMS Items for 250. Kindly approve the transaction to activate the sms items', 'DELIVERED', '+254719289389', 1, '2017-04-16 11:39:37', '2017-04-16 11:39:37'),
(27, 'Provider', 1, 'Dear Qooetu  companies , 300 has been debitted to your account.You will be notified shortly once transaction has been approved by SMS Service Provider', 'DELIVERED', '+254708236804', 2, '2017-04-16 11:49:07', '2017-04-16 11:49:07'),
(28, 'Provider', 1, 'Transaction #:LDG803QW4H, Dear Isanya Hillary ,Qooetu  companies   has purchased SMS Items for 300. Kindly approve the transaction to activate the sms items', 'DELIVERED', '+254708236804', 1, '2017-04-16 11:49:12', '2017-04-16 11:49:12'),
(29, 'Provider', 1, 'Transaction #:LDG803QW4H, Dear David Otuya ,Qooetu  companies   has purchased SMS Items for 300. Kindly approve the transaction to activate the sms items', 'DELIVERED', '+254719289389', 1, '2017-04-16 11:49:14', '2017-04-16 11:49:14'),
(30, 'Provider', 1, 'djdjkjddjkddddjddjkdjd', 'DELIVERED', '+254712794691', 1, '2017-04-17 16:13:49', '2017-04-17 16:13:49'),
(31, 'Provider', 1, 'djdjkjddjkddddjddjkdjd', 'DELIVERED', '+254712794691', 1, '2017-04-17 16:15:18', '2017-04-17 16:15:18'),
(32, 'Provider', 1, 'djdjkjddjkddddjddjkdjd', 'DELIVERED', '+254708236804', 1, '2017-04-17 16:15:25', '2017-04-17 16:15:25'),
(33, 'Provider', 1, 'djdjkjddjkddddjddjkdjd', 'DELIVERED', '+254708236804', 1, '2017-04-17 16:15:29', '2017-04-17 16:15:29'),
(34, 'Provider', 1, 'Test Bulk SMS', 'DELIVERED', '+254708236804', 1, '2017-04-17 16:16:22', '2017-04-17 16:16:22'),
(35, 'Provider', 1, 'Test Bulk SMS', 'DELIVERED', '+254708236804', 1, '2017-04-17 16:16:24', '2017-04-17 16:16:24'),
(36, 'Provider', 1, 'dkjdkjdkjdkjdjdjd', 'DELIVERED', '+254708236804', 1, '2017-04-17 16:23:13', '2017-04-17 16:23:13'),
(37, 'Provider', 1, 'dkjdkjdkjdkjdjdjd', 'DELIVERED', '+254708236804', 1, '2017-04-17 16:23:14', '2017-04-17 16:23:14'),
(38, 'Provider', 1, 'dkjdkjdkjdkjdjdjd', 'DELIVERED', '+254708236804', 1, '2017-04-17 16:23:32', '2017-04-17 16:23:32'),
(39, 'Provider', 1, 'dkjdkjdkjdkjdjdjd', 'DELIVERED', '+254708236804', 1, '2017-04-17 16:23:32', '2017-04-17 16:23:32'),
(40, 'Provider', 1, 'dkjdkjdkjdkjdjdjd', 'DELIVERED', '+254708236804', 1, '2017-04-17 16:24:52', '2017-04-17 16:24:52'),
(41, 'Provider', 1, 'dkjdkjdkjdkjdjdjd', 'DELIVERED', '+254708236804', 1, '2017-04-17 16:24:52', '2017-04-17 16:24:52'),
(42, 'Provider', 1, 'dkjdkjdkjdkjdjdjd', 'DELIVERED', '+254708236804', 1, '2017-04-17 16:25:34', '2017-04-17 16:25:34'),
(43, 'Provider', 1, 'dkjdkjdkjdkjdjdjd', 'DELIVERED', '+254708236804', 1, '2017-04-17 16:25:34', '2017-04-17 16:25:34'),
(44, 'Provider', 1, 'dkjdkjdkjdkjdjdjd', 'DELIVERED', '+254708236804', 1, '2017-04-17 16:26:01', '2017-04-17 16:26:01'),
(45, 'Provider', 1, 'dkjdkjdkjdkjdjdjd', 'DELIVERED', '+254708236804', 1, '2017-04-17 16:26:01', '2017-04-17 16:26:01'),
(46, 'Provider', 1, 'Kindly Pay Your Rent By 5th of Next Month', 'DELIVERED', '+254708236804', 1, '2017-04-17 16:31:17', '2017-04-17 16:31:17'),
(47, 'Provider', 1, 'Kindly Pay Your Rent By 5th of Next Month', 'DELIVERED', '+254708236804', 1, '2017-04-17 16:31:17', '2017-04-17 16:31:17'),
(48, 'Provider', 1, 'Kindly Pay Your Rent By 5th of Next Month', 'DELIVERED', '+254708236804', 1, '2017-04-17 16:31:29', '2017-04-17 16:31:29'),
(49, 'Provider', 1, 'Kindly Pay Your Rent By 5th of Next Month', 'DELIVERED', '+254708236804', 1, '2017-04-17 16:31:29', '2017-04-17 16:31:29'),
(50, 'Provider', 1, 'Laravel does have a \'later\' method for the Mail class, but it won\'t send email repeatedly.\r\n\r\nMail::later(5, \'emails.welcome\', $data, function($message)\r\n{\r\n    $message->to(\'foo@example.com\', \'John Smith\')->subject(\'Welcome!\');\r\n});\r\n', 'DELIVERED', '+254708236804', 1, '2017-04-17 16:37:09', '2017-04-17 16:37:09'),
(51, 'Provider', 1, 'Laravel does have a \'later\' method for the Mail class, but it won\'t send email repeatedly.\r\n\r\nMail::later(5, \'emails.welcome\', $data, function($message)\r\n{\r\n    $message->to(\'foo@example.com\', \'John Smith\')->subject(\'Welcome!\');\r\n});\r\n', 'DELIVERED', '+254708236804', 1, '2017-04-17 16:37:11', '2017-04-17 16:37:11'),
(52, 'Provider', 1, 'dlkdlkddkldkldklkdkd', 'DELIVERED', '+254708236804', 1, '2017-04-17 16:41:17', '2017-04-17 16:41:17'),
(53, 'Provider', 1, 'test', 'DELIVERED', '+254708236804', 1, '2017-04-17 16:44:33', '2017-04-17 16:44:33'),
(54, 'Provider', 1, 'kldlkdkllkdkldlkdkldlkd', 'DELIVERED', '+254708236804', 1, '2017-04-17 16:49:19', '2017-04-17 16:49:19'),
(55, 'Provider', 1, 'Dear Isanya Hillary ,Mary Bosire has created a new Space Repair Request with the following details :\n  Unit :Auroville-A001 \n Priority  :High\n Repair Type:Electrical Wiring\n Expected Visit Date :2017-04-20\n Repair  Ticket#820628', 'DELIVERED', '+254708236804', 2, '2017-04-17 20:47:40', '2017-04-17 20:47:40'),
(56, 'Provider', 1, 'Dear Isanya Hillary ,Mary Bosire has created a new Space Repair Request with the following details :\n  Unit :Auroville-A001 \n Priority  :High\n Repair Type:Electrical Wiring\n Expected Visit Date :2017-04-20\n Repair  Ticket#249442', 'DELIVERED', '+254708236804', 2, '2017-04-17 20:48:08', '2017-04-17 20:48:08'),
(57, 'Provider', 1, 'Dear Mary Bosire Your Repair Request with Ticket Number #820628 Has been Closed ', 'DELIVERED', '+25-47-0823-6804', 1, '2017-04-17 20:51:13', '2017-04-17 20:51:13'),
(58, 'Provider', 1, 'Dear Mary Bosire Your Repair Request with Ticket Number #249442 Has been Closed ', 'DELIVERED', '+25-47-0823-6804', 1, '2017-04-17 21:01:23', '2017-04-17 21:01:23'),
(59, 'Provider', 1, 'Dear Qooetu  companies , 250 has been debitted to your account.You will be notified shortly once transaction has been approved by SMS Service Provider', 'DELIVERED', '+254708236804', 2, '2017-04-22 11:15:46', '2017-04-22 11:15:46'),
(60, 'Provider', 1, 'Transaction #:LDL7Q2WR3R, Dear Isanya Hillary ,Qooetu  companies   has purchased SMS Items for 250. Kindly approve the transaction to activate the sms items', 'DELIVERED', '+254708236804', 1, '2017-04-22 11:15:48', '2017-04-22 11:15:48'),
(61, 'Provider', 1, 'Transaction #:LDL7Q2WR3R, Dear David Otuya ,Qooetu  companies   has purchased SMS Items for 250. Kindly approve the transaction to activate the sms items', 'DELIVERED', '+254719289389', 1, '2017-04-22 11:15:49', '2017-04-22 11:15:49'),
(62, 'Provider', 1, 'Dear Qooetu  companies , 300 has been debitted to your account.You will be notified shortly once transaction has been approved by SMS Service Provider', 'DELIVERED', '+254708236804', 2, '2017-04-30 10:01:16', '2017-04-30 10:01:16'),
(63, 'Provider', 1, 'Transaction #:LDTOSPIONG, Dear Isanya Hillary ,Qooetu  companies   has purchased SMS Items for 300. Kindly approve the transaction to activate the sms items', 'DELIVERED', '+254708236804', 1, '2017-04-30 10:01:17', '2017-04-30 10:01:17'),
(64, 'Provider', 1, 'Transaction #:LDTOSPIONG, Dear David Otuya ,Qooetu  companies   has purchased SMS Items for 300. Kindly approve the transaction to activate the sms items', 'DELIVERED', '+254719289389', 1, '2017-04-30 10:01:17', '2017-04-30 10:01:17'),
(65, 'Provider', 1, 'New PropertyNgong Road Apartment is being added by Qooetu  companies - +254708236804with the following details:\n Ip Address127.0.0.1\n Server Name :realestate.dev\n  : Server Address :127.111.73.1\n Requested url :/backend/property/store Agents :Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:53.0) Gecko/20100101 Firefox/53.0', 'DELIVERED', '+254708236804', 2, '2017-04-30 20:07:12', '2017-04-30 20:07:12'),
(66, 'Provider', 1, 'New PropertyRose Villa Apartments is being added by Qooetu  companies - +254708236804with the following details:\n Ip Address127.0.0.1\n Server Name :realestate.dev\n  : Server Address :127.111.73.1\n Requested url :/backend/property/store Agents :Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:53.0) Gecko/20100101 Firefox/53.0', 'DELIVERED', '+254708236804', 2, '2017-04-30 20:51:42', '2017-04-30 20:51:42'),
(67, 'Provider', 1, 'Dear Mary Bosire a new Invoice for this month (May,2017)rent payment has been emailed to you.The invoice Number is #142076', 'DELIVERED', '+25-47-0823-6804', 2, '2017-05-07 20:23:37', '2017-05-07 20:23:37'),
(68, 'Provider', 1, 'Dear Stephen Mwaura a new Invoice for this month (May,2017)rent payment has been emailed to you.The invoice Number is #161116', 'DELIVERED', '+35-66-6666-6666', 2, '2017-05-07 20:23:39', '2017-05-07 20:23:39');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2015_08_01_104512_create_log_table', 1),
(4, '2016_09_30_135246_entrust_setup_tables', 1),
(5, '2016_10_01_091807_create_profiles_table', 1),
(6, '2016_10_01_131551_create_uploads_table', 1),
(7, '2016_10_22_085611_create_agents_table', 1),
(8, '2016_10_22_165502_create_properties_table', 1),
(9, '2016_10_22_171214_create_amentities_table', 1),
(10, '2016_10_30_132139_create_user_variable', 1),
(11, '2016_11_17_141011_create_propertie_images_table', 1),
(12, '2016_11_17_190737_create_spaces_table', 1),
(13, '2016_11_17_200433_create_space_images_table', 1),
(14, '2016_11_19_090200_create_tenants_table', 1),
(15, '2016_11_19_114203_create_tenant_payments_table', 1),
(16, '2016_11_20_135704_create_repairs_table', 1),
(17, '2016_12_05_135744_create_categories_table', 1),
(18, '2016_12_05_140406_create_sub_categories_table', 1),
(19, '2016_12_06_124752_add_extra_column_property', 1),
(20, '2016_12_16_112850_add_columns_to_spaces_table', 1),
(21, '2017_01_02_090207_create_deposits_table', 1),
(22, '2017_01_02_090909_create_emegency_contacts', 1),
(23, '2017_01_02_092358_create_tenants_occupants', 1),
(24, '2017_01_02_093527_create_possessions_table', 1),
(25, '2017_01_02_093913_create_students_table', 1),
(26, '2017_01_02_095034_create_employed_tenants_table', 1),
(27, '2017_01_02_100511_alter_tenants_table', 1),
(28, '2017_02_01_212949_add_columns_properties', 1),
(29, '2017_02_04_141245_add_expected_end_date_tenants', 1),
(30, '2017_02_06_184720_add_lease_date_fields', 1),
(31, '2017_02_11_095019_create_tenant_charges_table', 1),
(32, '2017_02_12_104435_add_manager_field_properties', 1),
(33, '2017_02_12_132326_create_invoices_table', 1),
(34, '2017_02_12_160246_add_invoice_id_payments', 1),
(35, '2017_02_12_191946_add_columns_property', 1),
(36, '2017_02_13_193842_add_invoice_number_repair', 1),
(37, '2017_02_14_190923_create_vaccation_notifications', 1),
(38, '2017_02_17_184039_add_columns_agents_table', 1),
(39, '2017_02_19_141305_add_balance_payments', 1),
(40, '2017_02_25_082509_create_suppliers_table', 1),
(41, '2017_03_03_205915_create_directors_table', 1),
(42, '2017_03_04_065435_provider_supplier_table', 1),
(43, '2017_03_05_144608_create_quatations_table', 1),
(44, '2017_03_09_105654_add_columns_categories', 1),
(45, '2017_03_10_135937_create_messages_table', 1),
(46, '2017_03_10_144650_create_system_modules_table', 1),
(47, '2017_03_10_145554_create_provider_modules_table', 1),
(48, '2017_03_25_180216_create_repair_requests', 2),
(49, '2017_04_10_214816_create_groups_table', 2),
(50, '2017_04_12_163107_add_contry_street', 2),
(51, '2017_04_14_203657_add_agency_fieds', 2),
(52, '2017_04_15_192434_create_contacts_table', 3),
(53, '2017_04_16_113258_create_topup_histories_table', 4),
(54, '2017_04_16_114116_create_topup_table', 5),
(55, '2017_04_16_205500_create_jobs_table', 6),
(57, '2017_04_17_120403_create_smesages_table', 7),
(58, '2017_03_28_232636_create_gate_table', 8),
(59, '2017_03_28_233246_create_guards_table', 8),
(60, '2017_03_28_234130_create_gate_gateassignments_table', 8),
(61, '2017_03_28_235023_create_gate_visitors_table', 8),
(62, '2017_03_29_000209_create_gate_vehicles_table', 8),
(63, '2017_03_29_000748_create_gate_electronics_table', 8),
(64, '2017_03_31_184833_add_roles', 8),
(65, '2017_04_28_233500_create_providers_table', 9),
(66, '2017_04_29_120143_create_job_requests', 10),
(68, '2017_05_11_004610_create_incidents_table', 11),
(69, '2017_05_13_123518_add_repair_request_id', 12),
(74, '2017_05_13_144410_create_plots_table', 13);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'access-backend', 'Access application Backend', 'Allow Users to loginto the application and perform various activitie', '2017-04-15 08:06:29', '2017-04-14 21:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`permission_id`, `role_id`) VALUES
(1, 1),
(1, 3),
(1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `plots`
--

CREATE TABLE `plots` (
  `id` int(10) UNSIGNED NOT NULL,
  `provider_id` int(10) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `area` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_phone_two` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_email_two` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `plot_price` double NOT NULL DEFAULT '0',
  `plot_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `plot_size` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `added_valeu` text COLLATE utf8_unicode_ci,
  `account_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bank_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `branch` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `logitude` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `latitude` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `account_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `plot_status` enum('Pending','On Sale','Sold') COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `plots`
--

INSERT INTO `plots` (`id`, `provider_id`, `name`, `country`, `state`, `area`, `city`, `contact_phone`, `contact_email`, `contact_phone_two`, `contact_email_two`, `plot_price`, `plot_id`, `plot_size`, `added_valeu`, `account_name`, `bank_name`, `branch`, `logitude`, `latitude`, `account_number`, `plot_status`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Mwea Schemes', 'Kenya', 'Kirinyaga', 'Mwea', 'Mwea Teberre', '0719289389', 'dav@gmail.com', '0708236804', 'isanya@mail.com', 10000000, 'MYrFu2', '1 acre', '["Is Fenced","Connected Water","Next To Hospital","Title Deeds Available","Perimeter wall","Police post"]', 'I sanya Hillary', 'NIC Bank', 'CITY CENTER', NULL, NULL, '1000000', 'On Sale', 'jvjhfhfjffhffj  fnbffhhjffhjf  fhjfjhhfj  fjhjfhjfhjfhjfh', '2017-05-13 16:21:24', '2017-05-14 09:52:27', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `plot_images`
--

CREATE TABLE `plot_images` (
  `id` int(10) UNSIGNED NOT NULL,
  `plot_id` int(10) UNSIGNED DEFAULT NULL,
  `image_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `plot_images`
--

INSERT INTO `plot_images` (`id`, `plot_id`, `image_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(52, 1, 9, '2017-05-14 09:52:27', '2017-05-14 09:52:27', NULL),
(53, 1, 13, '2017-05-14 09:52:28', '2017-05-14 09:52:28', NULL),
(54, 1, 14, '2017-05-14 09:52:28', '2017-05-14 09:52:28', NULL),
(55, 1, 3, '2017-05-14 09:52:28', '2017-05-14 09:52:28', NULL),
(56, 1, 4, '2017-05-14 09:52:28', '2017-05-14 09:52:28', NULL),
(57, 1, 7, '2017-05-14 09:52:28', '2017-05-14 09:52:28', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `possessions`
--

CREATE TABLE `possessions` (
  `id` int(10) UNSIGNED NOT NULL,
  `tenant_id` int(10) UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fee_charged` double NOT NULL DEFAULT '0',
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `possessions`
--

INSERT INTO `possessions` (`id`, `tenant_id`, `type`, `name`, `number`, `fee_charged`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(3, 14, 'Pet', 'Germany Shephard Dogs', '2', 0, 'Pending', '2017-04-15 19:33:07', '2017-04-15 19:33:07', NULL),
(4, 14, 'Vehicle', 'Bus', 'KCB 567C', 0, 'Pending', '2017-04-15 19:33:07', '2017-04-15 19:33:07', NULL),
(5, 15, 'Vehicle', 'Car', 'KCV456M', 0, 'Pending', '2017-04-17 20:37:47', '2017-04-17 20:37:47', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE `profiles` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `gender` enum('Male','Female') COLLATE utf8_unicode_ci DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `telephone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `postal_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `id_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `timezone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` enum('Compelete','Incomplete') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Incomplete',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`id`, `user_id`, `gender`, `dob`, `telephone`, `country`, `postal_address`, `city`, `id_number`, `timezone`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Incomplete', '2017-04-15 08:06:34', '2017-04-15 08:06:34', NULL),
(2, 2, NULL, NULL, '+254708236804', NULL, '4296-30200', 'dghdhgd', NULL, NULL, 'Incomplete', '2017-04-15 10:05:23', '2017-04-15 10:05:23', NULL),
(3, 3, NULL, NULL, '+254708236804', NULL, '456', NULL, NULL, NULL, 'Incomplete', '2017-04-15 10:18:47', '2017-04-15 10:18:47', NULL),
(18, 18, 'Female', NULL, '+25-47-0823-6804', NULL, '4296-30200', NULL, '30303030', 'Africa/Nairobi', 'Incomplete', '2017-04-15 19:33:06', '2017-04-15 19:33:06', NULL),
(19, 19, 'Male', NULL, '+35-66-6666-6666', NULL, '4296-30200', NULL, '10101010', 'Africa/Nairobi', 'Incomplete', '2017-04-17 20:37:47', '2017-04-17 20:37:47', NULL),
(20, 20, NULL, NULL, '+254708236804', NULL, '4296-30200', NULL, '65767689', NULL, 'Incomplete', '2017-04-17 21:05:08', '2017-04-17 21:05:08', NULL),
(45, 50, NULL, NULL, '+254708236804', NULL, '4296-30200', NULL, '30303025', 'Africa/Nairobi', 'Incomplete', '2017-04-29 07:28:03', '2017-04-29 07:28:03', NULL),
(46, 51, NULL, NULL, '+254708236804', NULL, '4296-30200', NULL, '30303026', 'Africa/Nairobi', 'Incomplete', '2017-04-29 07:31:45', '2017-04-29 07:31:45', NULL),
(47, 52, NULL, NULL, '+254708236804', NULL, '4296-30200', NULL, '30303027', 'Africa/Nairobi', 'Incomplete', '2017-04-29 07:32:38', '2017-04-29 07:32:38', NULL),
(48, 53, NULL, NULL, '+254708236804', 'Kenya', '678-0900', 'CBD', '30303032', 'Africa/Nairobi', 'Compelete', '2017-04-29 07:36:02', '2017-04-29 18:00:17', NULL),
(52, 57, NULL, NULL, '0708236804', NULL, '467664', 'Kisumu', NULL, NULL, 'Incomplete', '2017-04-30 20:16:30', '2017-04-30 20:16:30', NULL),
(59, 64, NULL, NULL, '+254708236804', NULL, '4296-30200', 'Kisumu', NULL, NULL, 'Incomplete', '2017-04-30 20:25:10', '2017-04-30 20:25:10', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `properties`
--

CREATE TABLE `properties` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `provider_id` int(10) UNSIGNED NOT NULL,
  `unit_price` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `currency` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `town` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `location` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bathrooms` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bedrooms` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `area` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cover_image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` enum('For Sale','For Rent') COLLATE utf8_unicode_ci DEFAULT NULL,
  `other_details` text COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `category_id` int(10) UNSIGNED DEFAULT NULL,
  `postal_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `subcategory_id` int(10) UNSIGNED DEFAULT NULL,
  `no_of_bathroom` int(11) DEFAULT NULL,
  `no_of_bedrooms` int(11) DEFAULT NULL,
  `servant_quater` int(11) DEFAULT NULL,
  `managed_by` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `manager_phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Manager_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `manager_postal` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `account_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `account_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bank_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `branch` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `paybill` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mpesa_phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tax_charged` int(11) NOT NULL DEFAULT '0',
  `country` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Kenya',
  `street_road` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `agency` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Personal Assistant',
  `agent_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `agency_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `no_of_Garages` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `properties`
--

INSERT INTO `properties` (`id`, `title`, `provider_id`, `unit_price`, `currency`, `description`, `town`, `location`, `bathrooms`, `bedrooms`, `area`, `cover_image`, `type`, `other_details`, `status`, `created_at`, `updated_at`, `category_id`, `postal_address`, `subcategory_id`, `no_of_bathroom`, `no_of_bedrooms`, `servant_quater`, `managed_by`, `manager_phone`, `Manager_email`, `manager_postal`, `account_number`, `account_name`, `bank_name`, `branch`, `paybill`, `mpesa_phone`, `tax_charged`, `country`, `street_road`, `agency`, `agent_id`, `agency_id`, `no_of_Garages`) VALUES
(1, 'Auroville apartments', 1, '14000', '$', 'jsjsjshsss', 'Nairobi', 'CBD', NULL, NULL, '0', NULL, 'For Sale', 'not Set', 'Pending', '2017-04-15 10:15:17', '2017-04-15 14:52:47', 4, '4296-30200', 10, 0, 0, 0, 'Isanya Hillary', '+254708236804', 'hilaryisanya@yahoo.com', '456', '1002678', 'Arovilla', 'Equity Bank', 'Rongai', '', '+254708236804', 0, 'Kenya', 'Waiyaki ways', 'Personal Assistant', '3', NULL, 2),
(2, 'Monterey Villa and Apartments', 1, NULL, NULL, 'dhjhddjhdjhdhhjdhdjdd', 'Nairobi', 'CBD', NULL, NULL, '', NULL, 'For Rent', 'not Set', 'Pending', '2017-04-15 15:19:44', '2017-04-15 15:19:44', 1, '4296-30200', 1, 2, 6, 4, 'Isanya Hillary', NULL, 'hilaryisanya@yahoo.com', NULL, '12345', '', 'Equity Bank', 'Rongai', '4545', NULL, 0, 'Kenya', 'Waiyaki ways', 'Personal Assistant', NULL, NULL, NULL),
(3, 'Ngong Road Apartment', 1, NULL, NULL, 'hjjhhjhhjjh', 'Nairobi', '644', NULL, NULL, '67 by 78', NULL, 'For Rent', 'not Set', 'Pending', '2017-04-30 20:07:10', '2017-04-30 20:07:10', 2, '4296-30200', 3, 32, 40, 4, 'isanya hillary', NULL, 'dhjjhdjhjd@gmail.com', NULL, 'hjhh', 'kjjjjkj', 'jjj', 'hjhjhj', 'kjjkkjkj', NULL, 0, 'Kenya', 'Waiyaki ways', 'Personal Assistant', NULL, NULL, NULL),
(4, 'Rose Villa Apartments', 1, NULL, NULL, 'dkmjkddjkdjjdkjdjdk', 'Nairobi', 'jhjhhd', NULL, NULL, '', NULL, 'For Rent', 'not Set', 'Approved', '2017-04-30 20:51:40', '2017-04-30 20:51:40', 2, '678-0900', 3, 32, 40, 4, 'djjhjdhdjd', NULL, 'ddbhhd@g.com', NULL, 'jhhdhjsjhs', '564564564', 'dhhjhjd', 'hdhdjhd', '536564', NULL, 0, 'Kenya', 'Waiyaki ways', 'Personal Assistant', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `property_images`
--

CREATE TABLE `property_images` (
  `id` int(10) UNSIGNED NOT NULL,
  `property_id` int(10) UNSIGNED NOT NULL,
  `image_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `property_images`
--

INSERT INTO `property_images` (`id`, `property_id`, `image_id`, `created_at`, `updated_at`) VALUES
(44, 1, 4, '2017-04-15 14:52:46', '2017-04-15 14:52:46'),
(45, 1, 3, '2017-04-15 14:52:46', '2017-04-15 14:52:46'),
(46, 1, 2, '2017-04-15 14:52:46', '2017-04-15 14:52:46'),
(47, 1, 1, '2017-04-15 14:52:46', '2017-04-15 14:52:46'),
(48, 1, 4, '2017-04-15 14:52:46', '2017-04-15 14:52:46'),
(49, 1, 3, '2017-04-15 14:52:46', '2017-04-15 14:52:46'),
(50, 1, 2, '2017-04-15 14:52:46', '2017-04-15 14:52:46'),
(51, 1, 1, '2017-04-15 14:52:46', '2017-04-15 14:52:46'),
(52, 1, 5, '2017-04-15 14:52:46', '2017-04-15 14:52:46'),
(53, 1, 1, '2017-04-15 14:52:46', '2017-04-15 14:52:46'),
(54, 1, 2, '2017-04-15 14:52:46', '2017-04-15 14:52:46'),
(55, 1, 3, '2017-04-15 14:52:46', '2017-04-15 14:52:46'),
(56, 1, 4, '2017-04-15 14:52:46', '2017-04-15 14:52:46'),
(57, 1, 7, '2017-04-15 14:52:46', '2017-04-15 14:52:46'),
(58, 1, 10, '2017-04-15 14:52:46', '2017-04-15 14:52:46'),
(59, 1, 1, '2017-04-15 14:52:47', '2017-04-15 14:52:47'),
(60, 2, 2, '2017-04-15 15:19:54', '2017-04-15 15:19:54'),
(61, 2, 9, '2017-04-15 15:19:54', '2017-04-15 15:19:54'),
(62, 2, 10, '2017-04-15 15:19:54', '2017-04-15 15:19:54'),
(63, 3, 1, '2017-04-30 20:07:12', '2017-04-30 20:07:12'),
(64, 3, 2, '2017-04-30 20:07:12', '2017-04-30 20:07:12'),
(65, 3, 3, '2017-04-30 20:07:12', '2017-04-30 20:07:12'),
(66, 3, 4, '2017-04-30 20:07:12', '2017-04-30 20:07:12'),
(67, 3, 5, '2017-04-30 20:07:12', '2017-04-30 20:07:12'),
(68, 4, 1, '2017-04-30 20:51:42', '2017-04-30 20:51:42'),
(69, 4, 2, '2017-04-30 20:51:42', '2017-04-30 20:51:42'),
(70, 4, 3, '2017-04-30 20:51:42', '2017-04-30 20:51:42'),
(71, 4, 4, '2017-04-30 20:51:42', '2017-04-30 20:51:42'),
(72, 4, 5, '2017-04-30 20:51:42', '2017-04-30 20:51:42'),
(73, 4, 6, '2017-04-30 20:51:42', '2017-04-30 20:51:42'),
(74, 4, 8, '2017-04-30 20:51:42', '2017-04-30 20:51:42'),
(75, 4, 9, '2017-04-30 20:51:42', '2017-04-30 20:51:42');

-- --------------------------------------------------------

--
-- Table structure for table `provider_modules`
--

CREATE TABLE `provider_modules` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Provider',
  `type_id` int(11) NOT NULL,
  `module_id` int(10) UNSIGNED NOT NULL,
  `amount` double NOT NULL DEFAULT '1',
  `no_of_users` int(11) DEFAULT NULL,
  `date_subscribed` date NOT NULL,
  `status` enum('Active','Expired') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Active',
  `last_renewed_on` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `provider_modules`
--

INSERT INTO `provider_modules` (`id`, `type`, `type_id`, `module_id`, `amount`, `no_of_users`, `date_subscribed`, `status`, `last_renewed_on`, `created_at`, `updated_at`) VALUES
(1, 'Provider', 1, 1, 4500, 1, '2017-04-15', 'Active', '2017-04-15', '2017-04-15 10:05:23', '2017-04-15 10:05:23'),
(2, 'Provider', 1, 2, 4500, 1, '2017-04-15', 'Active', '2017-04-15', '2017-04-15 10:05:23', '2017-04-15 10:05:23'),
(3, 'Provider', 1, 3, 4500, 1, '2017-04-15', 'Active', '2017-04-15', '2017-04-15 10:05:23', '2017-04-15 10:05:23'),
(4, 'Provider', 1, 4, 4500, 1, '2017-04-15', 'Active', '2017-04-15', '2017-04-15 10:05:23', '2017-04-15 10:05:23'),
(5, 'Provider', 1, 5, 4500, 1, '2017-04-15', 'Active', '2017-04-15', '2017-04-15 10:05:23', '2017-04-15 10:05:23'),
(6, 'Provider', 1, 6, 4500, 1, '2017-04-15', 'Active', '2017-04-15', '2017-04-15 10:05:23', '2017-04-15 10:05:23'),
(7, 'Provider', 1, 7, 4500, 1, '2017-04-15', 'Active', '2017-04-15', '2017-04-15 10:05:23', '2017-04-15 10:05:23'),
(11, 'Provider', 5, 1, 4500, 1, '2017-04-30', 'Active', '2017-04-30', '2017-04-30 20:16:30', '2017-04-30 20:16:30'),
(12, 'Provider', 5, 2, 4500, 1, '2017-04-30', 'Active', '2017-04-30', '2017-04-30 20:16:30', '2017-04-30 20:16:30'),
(13, 'Provider', 5, 3, 4500, 1, '2017-04-30', 'Active', '2017-04-30', '2017-04-30 20:16:30', '2017-04-30 20:16:30'),
(14, 'Provider', 6, 1, 4500, 1, '2017-04-30', 'Active', '2017-04-30', '2017-04-30 20:25:10', '2017-04-30 20:25:10'),
(15, 'Provider', 6, 2, 4500, 1, '2017-04-30', 'Active', '2017-04-30', '2017-04-30 20:25:10', '2017-04-30 20:25:10'),
(16, 'Provider', 6, 3, 4500, 1, '2017-04-30', 'Active', '2017-04-30', '2017-04-30 20:25:10', '2017-04-30 20:25:10'),
(17, 'Provider', 6, 4, 4500, 1, '2017-04-30', 'Active', '2017-04-30', '2017-04-30 20:25:10', '2017-04-30 20:25:10'),
(18, 'Provider', 6, 5, 4500, 1, '2017-04-30', 'Active', '2017-04-30', '2017-04-30 20:25:10', '2017-04-30 20:25:10'),
(19, 'Provider', 6, 6, 4500, 1, '2017-04-30', 'Active', '2017-04-30', '2017-04-30 20:25:10', '2017-04-30 20:25:10'),
(20, 'Provider', 6, 7, 4500, 1, '2017-04-30', 'Active', '2017-04-30', '2017-04-30 20:25:10', '2017-04-30 20:25:10');

-- --------------------------------------------------------

--
-- Table structure for table `provider_suppliers`
--

CREATE TABLE `provider_suppliers` (
  `id` int(10) UNSIGNED NOT NULL,
  `provider_id` int(10) UNSIGNED NOT NULL,
  `supplier_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quatations`
--

CREATE TABLE `quatations` (
  `id` int(10) UNSIGNED NOT NULL,
  `provider_id` int(10) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `item_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `item_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `quantity` int(11) NOT NULL DEFAULT '1',
  `supllier_list` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `repairs`
--

CREATE TABLE `repairs` (
  `id` int(10) UNSIGNED NOT NULL,
  `request_id` int(11) DEFAULT NULL,
  `provider_id` int(10) UNSIGNED NOT NULL,
  `space_id` int(10) UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `job_done_by` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `person_responsible` enum('Landloard','Tenant') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Landloard',
  `user_id` int(11) DEFAULT NULL,
  `technician_fee` double NOT NULL,
  `total_cost` double NOT NULL,
  `repair_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `repair_date` date DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `invoice_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `repairs`
--

INSERT INTO `repairs` (`id`, `request_id`, `provider_id`, `space_id`, `type`, `job_done_by`, `person_responsible`, `user_id`, `technician_fee`, `total_cost`, `repair_code`, `repair_date`, `description`, `created_at`, `updated_at`, `invoice_number`) VALUES
(2, 1, 1, 1, 'Elecrical Repairs', 'Wafula John', 'Tenant', 18, 500, 1500, 'VTDVIN3Y', '2017-03-22', 'djdjdkjjd', '2017-03-17 20:55:03', '2017-04-17 20:55:03', '#206460'),
(3, 2, 1, 1, 'Floor Repairs', 'Isanya Hillary', 'Tenant', 18, 500, 2500, 'BGZSOD3H', '2017-04-26', 'djkdkjjdddjdjd', '2017-04-17 21:01:28', '2017-04-17 21:01:28', '#239530');

-- --------------------------------------------------------

--
-- Table structure for table `repair_items`
--

CREATE TABLE `repair_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `repair_id` int(10) UNSIGNED NOT NULL,
  `item_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `unit_price` double NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `receit_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `supplier_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_supplied` date DEFAULT NULL,
  `is_paid` enum('Yes','No') COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `repair_items`
--

INSERT INTO `repair_items` (`id`, `repair_id`, `item_name`, `unit_price`, `quantity`, `created_at`, `updated_at`, `receit_number`, `supplier_id`, `date_supplied`, `is_paid`) VALUES
(1, 2, 'Bulb Holders', 1000, 5000, '2017-04-17 20:55:03', '2017-04-17 20:55:03', 'dhghgdd', NULL, '2017-04-19', 'Yes'),
(2, 3, 'Cement', 1000, 2, '2017-04-17 21:01:28', '2017-04-17 21:01:28', 'ertabnd', NULL, '2017-04-20', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `repair_requests`
--

CREATE TABLE `repair_requests` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `space_id` int(10) UNSIGNED NOT NULL,
  `priorty` enum('High','Medium','Low','Urgent') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'High',
  `level` enum('Emergency Repair','Urgent Repair','Routine Repair') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Routine Repair',
  `type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `expected_repair_date` date DEFAULT NULL,
  `expected_investination_date` date DEFAULT NULL,
  `repair_ticket` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('Pending','Closed','Open','Processed','Others') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `repair_requests`
--

INSERT INTO `repair_requests` (`id`, `user_id`, `space_id`, `priorty`, `level`, `type`, `description`, `expected_repair_date`, `expected_investination_date`, `repair_ticket`, `status`, `created_at`, `updated_at`) VALUES
(1, 18, 1, 'High', 'Emergency Repair', 'Electrical Wiring', 'jhnhjhjjhhjhjjh nbjhhjhhjhjhjjh   hjhjhjhhjhjjhhj   jhjhjjhhjhjhjhjhj   hjjhhjhjjjhhj   nnjnmnmnmnm', '2017-04-20', '2017-04-18', '#820628', 'Processed', '2017-04-17 20:47:40', '2017-04-17 20:51:25'),
(2, 18, 1, 'High', 'Emergency Repair', 'Electrical Wiring', 'jhnhjhjjhhjhjjh nbjhhjhhjhjhjjh   hjhjhjhhjhjjhhj   jhjhjjhhjhjhjhjhj   hjjhhjhjjjhhj   nnjnmnmnmnm', '2017-04-20', '2017-04-18', '#249442', 'Closed', '2017-04-17 20:47:58', '2017-04-17 21:01:28');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'Adminstartor', 'In charge of the system administration', '2017-04-15 08:06:25', '2017-04-15 08:06:25'),
(2, 'Renter', 'Tenant', 'Tenants are those hiring spaces or houses.', '2017-04-15 08:06:25', '2017-04-15 08:06:25'),
(3, 'Provider', 'Landloads/Providers', 'A provider will be the person who will be providing houses(s) to be hired. A provider can be \n                         Individual person or a company with many houses A provider must have one or more houses', '2017-04-15 08:06:25', '2017-04-15 08:06:25'),
(4, 'Agents', 'Agents', 'Those who can act in case of provider', '2017-04-15 08:06:25', '2017-04-15 08:06:25'),
(5, 'Guard', 'Security Guard', 'A person in charge of security of a given area', '2017-04-17 19:33:47', '2017-04-17 19:33:47'),
(6, 'serviceProvider', 'Service Provider', 'Those Providing Services for Repairs', '2017-04-28 20:47:04', '2017-04-28 20:47:04');

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`user_id`, `role_id`) VALUES
(1, 1),
(18, 2),
(19, 2),
(2, 3),
(57, 3),
(64, 3),
(3, 4),
(20, 5),
(50, 6),
(51, 6),
(52, 6),
(53, 6);

-- --------------------------------------------------------

--
-- Table structure for table `service_providers`
--

CREATE TABLE `service_providers` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `daily_price` double NOT NULL DEFAULT '0',
  `current_rating` enum('1','2','3','4','5') COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
  `nationality` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `current_nationality` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `location` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `town` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `first_ref` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ref_one_phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `second_ref` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ref_two_phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `current_balance` double NOT NULL DEFAULT '0',
  `service_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Pending',
  `qualification` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `institution` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `years` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `scanned_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `good_conduct` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `payment_frequency` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reason` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `service_providers`
--

INSERT INTO `service_providers` (`id`, `user_id`, `type`, `daily_price`, `current_rating`, `nationality`, `current_nationality`, `location`, `town`, `first_ref`, `ref_one_phone`, `second_ref`, `ref_two_phone`, `current_balance`, `service_code`, `status`, `qualification`, `institution`, `years`, `scanned_id`, `good_conduct`, `payment_frequency`, `reason`, `created_at`, `updated_at`) VALUES
(11, 50, 'ELECTRICIAN', 0, '1', 'Kenyan', 'Kenya', 'Rongai', 'Nairobi', 'David Otuya', '+254708236804', 'Kelvin Nyaoga', '0708236804', 0, '183852', 'Approved', NULL, NULL, NULL, NULL, NULL, NULL, 'jfkjfkjkfjjkf djjdjkd', '2017-04-29 07:28:03', '2017-04-30 08:13:21'),
(12, 51, 'ELECTRICIAN', 0, '1', 'Kenyan', 'Kenya', 'Rongai', 'Kisumu', 'David Otuya', '+254708236804', 'Kelvin Nyaoga', '0708236804', 0, NULL, 'Suspended', NULL, NULL, NULL, NULL, NULL, NULL, 'No certficate of good conduct provided', '2017-04-29 07:31:45', '2017-04-30 08:08:46'),
(13, 52, 'ELECTRICIAN', 0, '1', 'Kenyan', 'Kenya', 'CBD', 'Kisumu', 'David Otuya', '+254708236804', 'Kelvin Nyaoga', '0708236804', 0, NULL, 'Rejected', NULL, NULL, NULL, NULL, NULL, NULL, 'kjkjkkkjkj', '2017-04-29 07:32:38', '2017-04-30 08:08:11'),
(14, 53, 'WELDER', 1200, '1', 'Kenyan', 'Kenya', 'CBD', 'CBD', 'David Otuya', '+254708236804', 'Kelvin Nyaoga', '+254708236804', 0, '365894', 'Approved', 'Polytechnic', 'Moi University', '5 Years', '53_scanned_id.jpg', '53_good_conduct.jpg', 'Immediately After Job', 'Not Complience', '2017-04-29 07:36:02', '2017-04-30 07:49:46');

-- --------------------------------------------------------

--
-- Table structure for table `smessages`
--

CREATE TABLE `smessages` (
  `id` int(10) UNSIGNED NOT NULL,
  `owner_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `owner_id` int(10) UNSIGNED NOT NULL,
  `group_ids` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  `type` enum('Sms','Email','Both') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Email',
  `send_date` date NOT NULL,
  `send_time` time NOT NULL,
  `send_day` enum('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday') COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('Pending','Active','Sent') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `smessages`
--

INSERT INTO `smessages` (`id`, `owner_type`, `owner_id`, `group_ids`, `message`, `type`, `send_date`, `send_time`, `send_day`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Provider', 1, '["9", "10"]', 'dkjdkjdjkdkjdkdjdd', 'Sms', '2017-04-20', '10:00:00', 'Thursday', 'Active', '2017-04-17 15:13:09', '2017-04-17 15:13:09'),
(2, 'Provider', 1, '["1", "2", "3", "9"]', 'ddjjkddjkdkjdd  d  d dhgdhhdjhdjhjhdhdd  ddhdhhjdhjdjhjhjdjhdjd  ddhhjhjdhjdhjhdhjhjdhjd d  dhjhdhjdjjhdjhdjd', 'Both', '2017-04-30', '02:30:00', 'Sunday', 'Active', '2017-04-17 15:17:44', '2017-04-17 15:17:44');

-- --------------------------------------------------------

--
-- Table structure for table `spaces`
--

CREATE TABLE `spaces` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `property_id` int(10) UNSIGNED NOT NULL,
  `currency` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'KES',
  `unit_price` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Free',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `no_of_bathrooms` int(11) DEFAULT NULL,
  `no_of_bedrooms` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `spaces`
--

INSERT INTO `spaces` (`id`, `title`, `number`, `property_id`, `currency`, `unit_price`, `status`, `created_at`, `updated_at`, `deleted_at`, `no_of_bathrooms`, `no_of_bedrooms`, `description`) VALUES
(1, 'Auroville-A001', 'A001', 1, 'KES', '15000', 'Occupied', '2017-04-15 10:20:33', '2017-04-15 19:33:07', NULL, NULL, NULL, 'jdhdjdhjdjdd'),
(2, 'Aurovilla-A002', 'A002', 1, 'KES', '25000', 'Occupied', '2017-04-17 20:33:34', '2017-04-17 20:37:47', NULL, NULL, NULL, 'dhdhdjdhdjddhjddhdhd dhdhjdhjhjdhjddj');

-- --------------------------------------------------------

--
-- Table structure for table `space_images`
--

CREATE TABLE `space_images` (
  `id` int(10) UNSIGNED NOT NULL,
  `space_id` int(10) UNSIGNED NOT NULL,
  `image_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `space_images`
--

INSERT INTO `space_images` (`id`, `space_id`, `image_id`, `created_at`, `updated_at`) VALUES
(1, 1, 7, '2017-04-15 10:20:33', '2017-04-15 10:20:33'),
(2, 1, 7, '2017-04-15 10:20:34', '2017-04-15 10:20:34'),
(3, 1, 8, '2017-04-15 10:20:34', '2017-04-15 10:20:34'),
(4, 1, 7, '2017-04-15 10:20:34', '2017-04-15 10:20:34'),
(5, 1, 8, '2017-04-15 10:20:34', '2017-04-15 10:20:34'),
(6, 1, 9, '2017-04-15 10:20:34', '2017-04-15 10:20:34'),
(7, 2, 5, '2017-04-17 20:33:35', '2017-04-17 20:33:35'),
(8, 2, 7, '2017-04-17 20:33:35', '2017-04-17 20:33:35'),
(9, 2, 8, '2017-04-17 20:33:35', '2017-04-17 20:33:35'),
(10, 2, 9, '2017-04-17 20:33:35', '2017-04-17 20:33:35');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(10) UNSIGNED NOT NULL,
  `tenant_id` int(10) UNSIGNED NOT NULL,
  `reg_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `institution_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `year_of_study` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Year One',
  `course_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `course_duration` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`id`, `category_id`, `name`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Bungalow', NULL, '2017-04-15 08:06:59', '2017-04-15 08:06:59', NULL),
(2, 1, 'massionate', NULL, '2017-04-15 08:06:59', '2017-04-15 08:06:59', NULL),
(3, 2, 'Apartments', NULL, '2017-04-15 08:06:59', '2017-04-15 08:06:59', NULL),
(4, 3, 'Malls', NULL, '2017-04-15 08:07:00', '2017-04-15 08:07:00', NULL),
(5, 3, 'Office Spaces', NULL, '2017-04-15 08:07:00', '2017-04-15 08:07:00', NULL),
(6, 3, 'Retail stores', NULL, '2017-04-15 08:07:00', '2017-04-15 08:07:00', NULL),
(7, 3, 'Farm Land', NULL, '2017-04-15 08:07:00', '2017-04-15 08:07:00', NULL),
(8, 3, 'Medical Centers', NULL, '2017-04-15 08:07:00', '2017-04-15 08:07:00', NULL),
(9, 3, 'Garages', NULL, '2017-04-15 08:07:00', '2017-04-15 08:07:00', NULL),
(10, 4, 'Apartment', NULL, '2017-04-15 10:12:29', '2017-04-15 10:12:29', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int(10) UNSIGNED NOT NULL,
  `legal_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `trading_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reg_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `country_of_origin` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `service_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `vat` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `core_commodity` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `supplier_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `website` text COLLATE utf8_unicode_ci,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telephone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `alt_phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address_line` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `physical_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `street` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `location` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bulding` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_position` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_postal_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sector` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bank_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `account_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `account_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `branch` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `others_details` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `system_modules`
--

CREATE TABLE `system_modules` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `standard_charges` double NOT NULL DEFAULT '4500',
  `no_of_clients` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `system_modules`
--

INSERT INTO `system_modules` (`id`, `name`, `standard_charges`, `no_of_clients`, `created_at`, `updated_at`) VALUES
(1, 'properties and Spaces Management', 4500, 3, '2017-04-15 08:07:39', '2017-04-30 20:25:10'),
(2, 'Tenants/Lease Management', 4500, 3, '2017-04-15 08:07:39', '2017-04-30 20:25:10'),
(3, 'Invoice Management', 4500, 3, '2017-04-15 08:07:39', '2017-04-30 20:25:10'),
(4, 'Maintanance Module', 4500, 2, '2017-04-15 08:07:40', '2017-04-30 20:25:10'),
(5, 'Users and Gate Module', 4500, 2, '2017-04-15 08:07:40', '2017-04-30 20:25:10'),
(6, 'SMS and Bulk Emails Module', 4500, 2, '2017-04-15 08:07:40', '2017-04-30 20:25:10'),
(7, 'Advertising Module', 4500, 2, '2017-04-15 08:07:40', '2017-04-30 20:25:10');

-- --------------------------------------------------------

--
-- Table structure for table `tenants`
--

CREATE TABLE `tenants` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `provider_id` int(10) UNSIGNED NOT NULL,
  `space_id` int(10) UNSIGNED NOT NULL,
  `entry_date` date DEFAULT NULL,
  `expected_end_date` date DEFAULT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `monthly_fee` double DEFAULT NULL,
  `current_status` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `has_smokers` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'No',
  `smoker_number` int(11) DEFAULT NULL,
  `type` enum('Student','Self Employed','Employed') COLLATE utf8_unicode_ci DEFAULT NULL,
  `stay_duration` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `has_requirement` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'No',
  `requirement` text COLLATE utf8_unicode_ci,
  `scanned_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tenants`
--

INSERT INTO `tenants` (`id`, `user_id`, `provider_id`, `space_id`, `entry_date`, `expected_end_date`, `status`, `monthly_fee`, `current_status`, `created_at`, `updated_at`, `has_smokers`, `smoker_number`, `type`, `stay_duration`, `has_requirement`, `requirement`, `scanned_id`) VALUES
(14, 18, 1, 1, '2017-02-17', '2017-02-19', 'Occupied', NULL, 'Active', '2017-04-15 19:33:06', '2017-04-15 19:33:06', 'No', 0, 'Employed', '6-12 MONTHS', 'No', '', '0'),
(15, 19, 1, 2, '2017-04-18', '2020-04-30', 'Occupied', NULL, 'Active', '2017-04-17 20:37:47', '2017-04-17 20:37:47', 'No', 0, 'Employed', '2 YEARS+', 'Yes', 'Painting to be done', '0');

-- --------------------------------------------------------

--
-- Table structure for table `tenants_occupants`
--

CREATE TABLE `tenants_occupants` (
  `id` int(10) UNSIGNED NOT NULL,
  `tenant_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `identification` enum('National ID','Birth Certificate','Passport','Allien Card') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'National ID',
  `number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `age` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tenants_occupants`
--

INSERT INTO `tenants_occupants` (`id`, `tenant_id`, `name`, `identification`, `number`, `age`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2, 14, 'Grace B', 'Birth Certificate', '123455', 5, '2017-04-15 19:33:07', '2017-04-15 19:33:07', NULL),
(3, 15, 'Henry C', 'Birth Certificate', '1234', 4, '2017-04-17 20:37:47', '2017-04-17 20:37:47', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tenant_charges`
--

CREATE TABLE `tenant_charges` (
  `id` int(10) UNSIGNED NOT NULL,
  `tenant_id` int(10) UNSIGNED NOT NULL,
  `charge_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `charge_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `effective_from` date DEFAULT NULL,
  `status` enum('Active','Inactive') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tenant_charges`
--

INSERT INTO `tenant_charges` (`id`, `tenant_id`, `charge_code`, `charge_name`, `amount`, `effective_from`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(9, 14, NULL, 'Deposit', 10000, '2017-02-17', 'Active', '2017-04-15 19:33:07', '2017-04-15 19:33:07', NULL),
(10, 14, NULL, 'Rent', 15000, '2017-02-17', 'Active', '2017-04-15 19:33:07', '2017-04-15 19:33:07', NULL),
(11, 14, NULL, 'Pet Fees', 0, '2017-02-17', 'Active', '2017-04-15 19:33:07', '2017-04-15 19:33:07', NULL),
(12, 14, NULL, 'Parking Fees', 2500, '2017-02-17', 'Active', '2017-04-15 19:33:07', '2017-04-15 19:33:07', NULL),
(13, 15, NULL, 'Deposit', 25000, '2017-04-18', 'Active', '2017-04-17 20:37:47', '2017-04-17 20:37:47', NULL),
(14, 15, NULL, 'Rent', 2500, '2017-04-18', 'Active', '2017-04-17 20:37:47', '2017-04-17 20:37:47', NULL),
(15, 15, NULL, 'Parking Fees', 2500, '2017-04-18', 'Active', '2017-04-17 20:37:47', '2017-04-17 20:37:47', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tenant_payments`
--

CREATE TABLE `tenant_payments` (
  `id` int(10) UNSIGNED NOT NULL,
  `tenant_id` int(10) UNSIGNED NOT NULL,
  `payment_mode` enum('Bankslip','Cheque','Cash','MPesa','Paybal','Others') COLLATE utf8_unicode_ci NOT NULL,
  `reference_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Rent',
  `space_id` int(10) UNSIGNED NOT NULL,
  `provider_id` int(10) UNSIGNED NOT NULL,
  `debit` double NOT NULL,
  `credit` double NOT NULL,
  `fee_charges` double DEFAULT NULL,
  `transaction_date` date NOT NULL,
  `year` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `month` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `system_transaction_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `invoice_id` int(10) UNSIGNED DEFAULT NULL,
  `balance` double NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tenant_payments`
--

INSERT INTO `tenant_payments` (`id`, `tenant_id`, `payment_mode`, `reference_number`, `type`, `space_id`, `provider_id`, `debit`, `credit`, `fee_charges`, `transaction_date`, `year`, `month`, `system_transaction_number`, `description`, `created_at`, `updated_at`, `invoice_id`, `balance`) VALUES
(2, 14, 'Cash', 'XSFBWCNBFANVY', 'Payment Reversal', 1, 1, 0, 27500, 0, '2017-04-15', NULL, NULL, 'TguiWmo', 'Being New Payment For The Space', '2017-04-15 19:33:07', '2017-04-15 19:33:07', 3, -27500),
(3, 14, 'Cash', 'CBFRGJJK45', 'Rent', 1, 1, 27500, 0, 0, '2017-04-16', '2017', '04', 'oCZVnAp5', 'sghsgsghsshshgsgh shgsgsshs', '2017-04-15 22:20:13', '2017-04-15 22:20:13', 3, 0),
(4, 15, 'Cash', 'OFGHWZXGHZQWA', 'Payment Reversal', 2, 1, 0, 30000, 0, '2017-04-17', NULL, NULL, 'u54s1lr', 'Being New Payment For The Space', '2017-04-17 20:37:47', '2017-04-17 20:37:47', 4, -30000),
(5, 15, 'Cash', 'CBFRGJJ127', 'Rent', 2, 1, 30000, 0, 0, '2017-04-26', '2017', '04', 'jNmGzO59', 'Being Deposit,Rent and Other Charges', '2017-04-17 20:41:44', '2017-04-17 20:41:44', 4, 0),
(6, 14, 'Others', 'VTDVIN3Y', 'Repairs', 1, 1, 0, 1500, 0, '2017-04-22', '2017', '04', 'bIflYYAX', 'Being payment for repairs caused by Tenant(s)', '2017-04-17 20:55:03', '2017-04-17 20:55:03', NULL, -1500),
(7, 14, 'Others', 'BGZSOD3H', 'Repairs', 1, 1, 0, 2500, 0, '2017-04-26', '2017', '04', 'QCdS66M2', 'Being payment for repairs caused by Tenant(s)', '2017-04-17 21:01:28', '2017-04-17 21:01:28', NULL, -4000),
(8, 14, 'Bankslip', 'CBFRGJJK456', 'Rent', 1, 1, 2500, 0, 0, '2017-04-16', '2017', '04', 'tuFg9zpy', 'okddiooiee', '2017-04-17 21:18:55', '2017-04-17 21:18:55', 6, -1500),
(9, 14, 'Cash', '#142076/0LY3', 'Rent', 1, 1, 0, 17500, NULL, '2017-05-01', '2017', '05', 'BUxFUjZi', 'Request For Rent Payment for Invoice #142076', '2017-05-07 20:23:36', '2017-05-07 20:23:36', 7, -19000),
(10, 15, 'Cash', '#161116/wqbR', 'Rent', 2, 1, 0, 5000, NULL, '2017-05-01', '2017', '05', 'R3WrZPxz', 'Request For Rent Payment for Invoice #161116', '2017-05-07 20:23:37', '2017-05-07 20:23:37', 8, -5000);

-- --------------------------------------------------------

--
-- Table structure for table `topups`
--

CREATE TABLE `topups` (
  `id` int(10) UNSIGNED NOT NULL,
  `owner_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `owner_id` int(10) UNSIGNED NOT NULL,
  `active_balance` double NOT NULL,
  `last_topup` date NOT NULL,
  `amount` double NOT NULL,
  `histrory_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `topups`
--

INSERT INTO `topups` (`id`, `owner_type`, `owner_id`, `active_balance`, `last_topup`, `amount`, `histrory_id`, `created_at`, `updated_at`) VALUES
(1, 'Provider', 1, 300, '2017-04-30', 300, 5, '2017-04-16 11:10:54', '2017-04-30 10:37:47');

-- --------------------------------------------------------

--
-- Table structure for table `topup_histories`
--

CREATE TABLE `topup_histories` (
  `id` int(10) UNSIGNED NOT NULL,
  `owner_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `owner_id` int(10) UNSIGNED NOT NULL,
  `amount` double NOT NULL,
  `gateway` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `transaction_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('Pending','Accepted','Rejected') COLLATE utf8_unicode_ci NOT NULL,
  `reason` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `topup_histories`
--

INSERT INTO `topup_histories` (`id`, `owner_type`, `owner_id`, `amount`, `gateway`, `transaction_code`, `status`, `reason`, `created_at`, `updated_at`) VALUES
(1, 'Provider', 1, 250, 'Safaricom Mpesa', 'LDG803NYK', 'Accepted', NULL, '2017-04-16 11:10:54', '2017-04-16 11:10:54'),
(2, 'Provider', 1, 250, 'Airtel Money', 'LDG906NYM', 'Rejected', 'kkjkkjjkj', '2017-04-16 11:39:22', '2017-04-30 11:24:50'),
(3, 'Provider', 1, 300, 'Safaricom Mpesa', 'LDG803QW4H', 'Rejected', NULL, '2017-04-16 11:49:02', '2017-04-16 11:49:02'),
(4, 'Provider', 1, 250, 'Safaricom Mpesa', 'LDL7Q2WR3R', 'Rejected', 'NO Such Transaction Number', '2017-04-22 11:15:44', '2017-04-30 11:24:21'),
(5, 'Provider', 1, 300, 'Airtel Money', 'LDTOSPIONG', 'Accepted', NULL, '2017-04-30 10:01:14', '2017-04-30 10:37:47');

-- --------------------------------------------------------

--
-- Table structure for table `uploads`
--

CREATE TABLE `uploads` (
  `id` int(10) UNSIGNED NOT NULL,
  `filename` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `extention` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `uploads`
--

INSERT INTO `uploads` (`id`, `filename`, `extention`, `user_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, '149225125260X.jpeg', 'jpeg', 2, NULL, '2017-04-15 10:14:12', '2017-04-15 10:14:12'),
(2, '149225126460X.jpeg', 'jpeg', 2, NULL, '2017-04-15 10:14:24', '2017-04-15 10:14:24'),
(3, '149225127160X.jpeg', 'jpeg', 2, NULL, '2017-04-15 10:14:31', '2017-04-15 10:14:31'),
(4, '149225127960X.jpeg', 'jpeg', 2, NULL, '2017-04-15 10:14:39', '2017-04-15 10:14:39'),
(5, '149225130360X.jpg', 'jpg', 2, NULL, '2017-04-15 10:15:03', '2017-04-15 10:15:03'),
(6, '149225149460X.jpg', 'jpg', 2, NULL, '2017-04-15 10:18:14', '2017-04-15 10:18:14'),
(7, '149225150560X.jpeg', 'jpeg', 2, NULL, '2017-04-15 10:18:25', '2017-04-15 10:18:25'),
(8, '149225161260X.jpeg', 'jpeg', 2, NULL, '2017-04-15 10:20:12', '2017-04-15 10:20:12'),
(9, '149225162560X.jpg', 'jpg', 2, NULL, '2017-04-15 10:20:25', '2017-04-15 10:20:25'),
(10, '149226706960X.png', 'png', 2, NULL, '2017-04-15 14:37:49', '2017-04-15 14:37:49'),
(11, '149262537930X.png', 'png', 2, NULL, '2017-04-19 18:09:39', '2017-04-19 18:09:39'),
(12, '149347289360X.png', 'png', 53, NULL, '2017-04-29 13:34:54', '2017-04-29 13:34:54'),
(13, '149468664960X.jpg', 'jpg', 2, NULL, '2017-05-13 14:44:09', '2017-05-13 14:44:09'),
(14, '149468666660X.jpg', 'jpg', 2, NULL, '2017-05-13 14:44:26', '2017-05-13 14:44:26');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `social` int(11) NOT NULL DEFAULT '0',
  `verification_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `confirmed_at` datetime DEFAULT NULL,
  `status` enum('Blocked','Active') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Active',
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `avatar`, `provider`, `social`, `verification_code`, `confirmed_at`, `status`, `remember_token`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'System Admin', 'admin@realestate.com', '$2y$10$Z3JIAKNUopBwJaAZz1Neb.j7MGPNU1Sq93N1EcQya4WNRV472Ug4G', NULL, 'manual', 0, 'S1TZ4PXH', '2017-04-15 00:00:00', 'Active', 'vHo5UbYJQbZKXZPaVVqRSBYraN3tAg0P3sYMBUn3yUTQQgDzpxrdq7zF0bIP', NULL, '2017-04-15 08:06:22', '2017-04-30 20:45:57'),
(2, 'Abraham Moses', 'hisanyad@gmail.com', '$2y$10$oaYWVgo9HYAmN2TMXjhvQuz62wIDbGKUnPkfSab/6C3AnnWHiCtZu', NULL, 'manual', 0, 'tCemkP', NULL, 'Active', 'wW8EAfyrzRJZCTE5UeS3EryuXKbVCmXXN9Hsb3mrYpQwqymsucUawEuDOvQp', NULL, '2017-04-15 10:05:23', '2017-05-10 19:15:48'),
(3, '76767676', 'hilaryisanya@yahoo.com', '$2y$10$BiO6LIbIuSbXFHfbybA3MO1.LzyZDfcpojCTtjK0rC3p/MKmxWj5q', NULL, 'Manual', 0, '2ivgPufm', '2017-04-15 13:18:47', 'Blocked', NULL, NULL, '2017-04-15 10:18:47', '2017-04-30 14:04:58'),
(18, 'Mary Bosire', 'mary@gmail.com', '$2y$10$FKz9l.qzqI1g6j7wksFeF.wcTnYsPhYNUIsKqe2xwOaSKftmWRk9a', NULL, 'Manual', 0, 'gMoxmwCE', '2017-04-15 22:33:06', 'Active', 'VoByia4fZLfoQ147L4DUyHTd4LOanbmVeD7BBRxY8Ifio6yOnuMXPl8LzIIL', NULL, '2017-04-15 19:33:06', '2017-05-13 07:13:20'),
(19, 'Stephen Mwaura', 'stephen.mwaura@ict.go.ke', '$2y$10$HYAweifH24zR1.4ybksbiOUtmvtDvzpLSHAp9DOcJHduJnbHSFPye', NULL, 'Manual', 0, 'eDXrIOdh', '2017-04-17 23:37:47', 'Active', NULL, NULL, '2017-04-17 20:37:47', '2017-04-17 20:37:47'),
(20, 'Joseph Mutie', '8vz@hk4.gov', '$2y$10$Z3JIAKNUopBwJaAZz1Neb.j7MGPNU1Sq93N1EcQya4WNRV472Ug4G', NULL, 'Manual', 0, 'd4Pmtm', '2017-04-18 00:05:08', 'Active', 'koK4u70clobl3On7vxwnVMsamdn0kc9tXzPJlsHuB2sdnYI9juGUmsv3xlJz', NULL, '2017-04-17 21:05:08', '2017-05-11 06:21:22'),
(50, 'Isanya Hillary Likovelo', 'mwea@gmail.com', '$2y$10$9YsrBCEtG4ykewiaF1P1ye7lwNhYP.uHKqlKa2INIJ7i4MQyiIZX2', NULL, 'Manual', 0, '0Bp32HtY', NULL, 'Active', NULL, NULL, '2017-04-29 07:28:03', '2017-04-29 07:28:03'),
(51, 'Moses Shikutwa', 'moses@gmail.com', '$2y$10$d8aFelhsBT/kXNaVWso9duNqpkpz0jyd.Qu4qvS6XU7hKgoL.7EcK', NULL, 'Manual', 0, '7pGD0N5p', NULL, 'Active', NULL, NULL, '2017-04-29 07:31:45', '2017-04-29 07:31:45'),
(52, 'Moses Shikutwa', 'mwea4@gmail.com', '$2y$10$8tkTPGeTeRZ8itN..1MIGOCfhieJa1TjX/j9kHv9WlTA5gGiS5bKy', NULL, 'Manual', 0, 'gW5UqnBD', NULL, 'Active', NULL, NULL, '2017-04-29 07:32:38', '2017-04-29 07:32:38'),
(53, 'Isanya Hillary', 'isanya@gmail.com', '$2y$10$knHnJb7SKqNOvenfOacXq.KudfiSoXnVu/7ZWg.BXqD0Z.9u4RUBO', NULL, 'Manual', 0, 'HXsLlYoy', NULL, 'Blocked', 'UkSqDcMs65GSf4CKwe9XIUNoORVLzMlDucy2d9C6fE3Vpj6AVainMQFh3ukf', NULL, '2017-04-29 07:36:02', '2017-04-30 12:11:01'),
(57, 'Salama  Salama', 'salama@gmail.com', '$2y$10$8NCmL6.Aqo6/Kj7gWQCJE.Ts3/20kUgl0FXNP0EsgOzjr00rNu6PC', NULL, 'manual', 0, 'KDDgcF', NULL, 'Active', NULL, NULL, '2017-04-30 20:16:30', '2017-04-30 20:16:30'),
(64, 'Khetias Kitale', 'kam@gmial.com', '$2y$10$BC9lcShGXwSTRPrYZXq8KeGNWefJhHVfPQp3oRQajrfjSteRn4sUS', NULL, 'manual', 0, '9BrDmE', NULL, 'Active', NULL, NULL, '2017-04-30 20:25:10', '2017-04-30 20:25:10');

-- --------------------------------------------------------

--
-- Table structure for table `user_variables`
--

CREATE TABLE `user_variables` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vaccation_notifications`
--

CREATE TABLE `vaccation_notifications` (
  `id` int(10) UNSIGNED NOT NULL,
  `tenant_id` int(10) UNSIGNED NOT NULL,
  `date_reported` date DEFAULT NULL,
  `vaccation_date` date DEFAULT NULL,
  `reason` text COLLATE utf8_unicode_ci,
  `status` enum('Approved','Rejected','Pending') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agents`
--
ALTER TABLE `agents`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `agents_auth_key_unique` (`auth_key`);

--
-- Indexes for table `amentities`
--
ALTER TABLE `amentities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bulk_groups`
--
ALTER TABLE `bulk_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `bulk_groups_group_name_unique` (`group_name`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_name_unique` (`name`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contacts_group_id_foreign` (`group_id`);

--
-- Indexes for table `deposits`
--
ALTER TABLE `deposits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `deposits_tenant_id_foreign` (`tenant_id`);

--
-- Indexes for table `directors`
--
ALTER TABLE `directors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `directors_supplier_id_foreign` (`supplier_id`);

--
-- Indexes for table `emergency_contacts`
--
ALTER TABLE `emergency_contacts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `emergency_contacts_tenant_id_foreign` (`tenant_id`);

--
-- Indexes for table `employed_tenants`
--
ALTER TABLE `employed_tenants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employed_tenants_tenant_id_foreign` (`tenant_id`);

--
-- Indexes for table `EventCodes`
--
ALTER TABLE `EventCodes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gate_electronics`
--
ALTER TABLE `gate_electronics`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gate_electronics_gate_id_foreign` (`gate_id`),
  ADD KEY `gate_electronics_visitor_id_foreign` (`visitor_id`);

--
-- Indexes for table `gate_gateassignments`
--
ALTER TABLE `gate_gateassignments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gate_gateassignments_gate_id_foreign` (`gate_id`),
  ADD KEY `gate_gateassignments_guard_id_foreign` (`guard_id`),
  ADD KEY `gate_gateassignments_assigned_by_foreign` (`assigned_by`);

--
-- Indexes for table `gate_gates`
--
ALTER TABLE `gate_gates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gate_guards`
--
ALTER TABLE `gate_guards`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gate_guards_user_id_foreign` (`user_id`),
  ADD KEY `gate_guards_provider_id_foreign` (`provider_id`),
  ADD KEY `gate_guards_property_id_foreign` (`property_id`);

--
-- Indexes for table `gate_incidents`
--
ALTER TABLE `gate_incidents`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `gate_incidents_insident_code_unique` (`insident_code`),
  ADD KEY `gate_incidents_gate_id_foreign` (`gate_id`),
  ADD KEY `gate_incidents_user_id_foreign` (`user_id`),
  ADD KEY `gate_incidents_provider_id_foreign` (`provider_id`),
  ADD KEY `gate_incidents_property_id_foreign` (`property_id`);

--
-- Indexes for table `gate_vehicles`
--
ALTER TABLE `gate_vehicles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gate_vehicles_gate_id_foreign` (`gate_id`),
  ADD KEY `gate_vehicles_visitor_id_foreign` (`visitor_id`);

--
-- Indexes for table `gate_visitors`
--
ALTER TABLE `gate_visitors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gate_visitors_host_id_foreign` (`host_id`),
  ADD KEY `gate_visitors_gate_id_foreign` (`gate_id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `invoices_invoice_number_unique` (`invoice_number`),
  ADD KEY `invoices_issued_to_foreign` (`issued_to`),
  ADD KEY `invoices_space_id_foreign` (`space_id`),
  ADD KEY `invoices_provider_id_foreign` (`provider_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_reserved_at_index` (`queue`,`reserved_at`);

--
-- Indexes for table `job_requests`
--
ALTER TABLE `job_requests`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_key` (`service_number`),
  ADD KEY `job_requests_repair_request_id_foreign` (`repair_request_id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
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
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_unique` (`name`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `permission_role_role_id_foreign` (`role_id`);

--
-- Indexes for table `plots`
--
ALTER TABLE `plots`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `plots_plot_id_unique` (`plot_id`),
  ADD KEY `plots_provider_id_foreign` (`provider_id`);

--
-- Indexes for table `plot_images`
--
ALTER TABLE `plot_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `plot_images_plot_id_foreign` (`plot_id`),
  ADD KEY `plot_images_image_id_foreign` (`image_id`);

--
-- Indexes for table `possessions`
--
ALTER TABLE `possessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `possessions_tenant_id_foreign` (`tenant_id`);

--
-- Indexes for table `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `profiles_user_id_foreign` (`user_id`);

--
-- Indexes for table `properties`
--
ALTER TABLE `properties`
  ADD PRIMARY KEY (`id`),
  ADD KEY `properties_provider_id_foreign` (`provider_id`),
  ADD KEY `properties_category_id_foreign` (`category_id`),
  ADD KEY `properties_subcategory_id_foreign` (`subcategory_id`);

--
-- Indexes for table `property_images`
--
ALTER TABLE `property_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `property_images_property_id_foreign` (`property_id`),
  ADD KEY `property_images_image_id_foreign` (`image_id`);

--
-- Indexes for table `provider_modules`
--
ALTER TABLE `provider_modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `provider_suppliers`
--
ALTER TABLE `provider_suppliers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `provider_suppliers_supplier_id_foreign` (`supplier_id`),
  ADD KEY `provider_suppliers_provider_id_foreign` (`provider_id`);

--
-- Indexes for table `quatations`
--
ALTER TABLE `quatations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `quatations_provider_id_foreign` (`provider_id`);

--
-- Indexes for table `repairs`
--
ALTER TABLE `repairs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `repairs_repair_code_unique` (`repair_code`),
  ADD KEY `repairs_space_id_foreign` (`space_id`),
  ADD KEY `repairs_provider_id_foreign` (`provider_id`);

--
-- Indexes for table `repair_items`
--
ALTER TABLE `repair_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `repair_items_repair_id_foreign` (`repair_id`);

--
-- Indexes for table `repair_requests`
--
ALTER TABLE `repair_requests`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `repair_requests_repair_ticket_unique` (`repair_ticket`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`user_id`,`role_id`),
  ADD KEY `role_user_role_id_foreign` (`role_id`);

--
-- Indexes for table `service_providers`
--
ALTER TABLE `service_providers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `service_providers_service_code_unique` (`service_code`);

--
-- Indexes for table `smessages`
--
ALTER TABLE `smessages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `spaces`
--
ALTER TABLE `spaces`
  ADD PRIMARY KEY (`id`),
  ADD KEY `spaces_property_id_foreign` (`property_id`);

--
-- Indexes for table `space_images`
--
ALTER TABLE `space_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `space_images_space_id_foreign` (`space_id`),
  ADD KEY `space_images_image_id_foreign` (`image_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `students_reg_number_unique` (`reg_number`),
  ADD KEY `students_tenant_id_foreign` (`tenant_id`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sub_categories_name_unique` (`name`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `suppliers_reg_number_unique` (`reg_number`),
  ADD UNIQUE KEY `suppliers_legal_name_unique` (`legal_name`),
  ADD UNIQUE KEY `suppliers_vat_unique` (`vat`),
  ADD UNIQUE KEY `suppliers_account_number_unique` (`account_number`);

--
-- Indexes for table `system_modules`
--
ALTER TABLE `system_modules`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `system_modules_name_unique` (`name`);

--
-- Indexes for table `tenants`
--
ALTER TABLE `tenants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tenants_space_id_foreign` (`space_id`),
  ADD KEY `tenants_provider_id_foreign` (`provider_id`),
  ADD KEY `tenants_user_id_foreign` (`user_id`);

--
-- Indexes for table `tenants_occupants`
--
ALTER TABLE `tenants_occupants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tenants_occupants_tenant_id_foreign` (`tenant_id`);

--
-- Indexes for table `tenant_charges`
--
ALTER TABLE `tenant_charges`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tenant_charges_tenant_id_foreign` (`tenant_id`);

--
-- Indexes for table `tenant_payments`
--
ALTER TABLE `tenant_payments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tenant_payments_reference_number_unique` (`reference_number`),
  ADD UNIQUE KEY `tenant_payments_system_transaction_number_unique` (`system_transaction_number`),
  ADD KEY `tenant_payments_space_id_foreign` (`space_id`),
  ADD KEY `tenant_payments_provider_id_foreign` (`provider_id`),
  ADD KEY `tenant_payments_tenant_id_foreign` (`tenant_id`),
  ADD KEY `tenant_payments_invoice_id_foreign` (`invoice_id`);

--
-- Indexes for table `topups`
--
ALTER TABLE `topups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `topups_histrory_id_foreign` (`histrory_id`);

--
-- Indexes for table `topup_histories`
--
ALTER TABLE `topup_histories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `topup_histories_transaction_code_unique` (`transaction_code`);

--
-- Indexes for table `uploads`
--
ALTER TABLE `uploads`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uploads_user_id_foreign` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_verification_code_unique` (`verification_code`);

--
-- Indexes for table `user_variables`
--
ALTER TABLE `user_variables`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vaccation_notifications`
--
ALTER TABLE `vaccation_notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vaccation_notifications_tenant_id_foreign` (`tenant_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agents`
--
ALTER TABLE `agents`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `amentities`
--
ALTER TABLE `amentities`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT for table `bulk_groups`
--
ALTER TABLE `bulk_groups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
--
-- AUTO_INCREMENT for table `deposits`
--
ALTER TABLE `deposits`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `directors`
--
ALTER TABLE `directors`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `emergency_contacts`
--
ALTER TABLE `emergency_contacts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `employed_tenants`
--
ALTER TABLE `employed_tenants`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `EventCodes`
--
ALTER TABLE `EventCodes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=307;
--
-- AUTO_INCREMENT for table `gate_electronics`
--
ALTER TABLE `gate_electronics`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `gate_gateassignments`
--
ALTER TABLE `gate_gateassignments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `gate_gates`
--
ALTER TABLE `gate_gates`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `gate_guards`
--
ALTER TABLE `gate_guards`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `gate_incidents`
--
ALTER TABLE `gate_incidents`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `gate_vehicles`
--
ALTER TABLE `gate_vehicles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `gate_visitors`
--
ALTER TABLE `gate_visitors`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `job_requests`
--
ALTER TABLE `job_requests`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;
--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;
--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `plots`
--
ALTER TABLE `plots`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `plot_images`
--
ALTER TABLE `plot_images`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;
--
-- AUTO_INCREMENT for table `possessions`
--
ALTER TABLE `possessions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;
--
-- AUTO_INCREMENT for table `properties`
--
ALTER TABLE `properties`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `property_images`
--
ALTER TABLE `property_images`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;
--
-- AUTO_INCREMENT for table `provider_modules`
--
ALTER TABLE `provider_modules`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `provider_suppliers`
--
ALTER TABLE `provider_suppliers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `quatations`
--
ALTER TABLE `quatations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `repairs`
--
ALTER TABLE `repairs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `repair_items`
--
ALTER TABLE `repair_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `repair_requests`
--
ALTER TABLE `repair_requests`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `service_providers`
--
ALTER TABLE `service_providers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `smessages`
--
ALTER TABLE `smessages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `spaces`
--
ALTER TABLE `spaces`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `space_images`
--
ALTER TABLE `space_images`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `system_modules`
--
ALTER TABLE `system_modules`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tenants`
--
ALTER TABLE `tenants`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `tenants_occupants`
--
ALTER TABLE `tenants_occupants`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tenant_charges`
--
ALTER TABLE `tenant_charges`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `tenant_payments`
--
ALTER TABLE `tenant_payments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `topups`
--
ALTER TABLE `topups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `topup_histories`
--
ALTER TABLE `topup_histories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `uploads`
--
ALTER TABLE `uploads`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;
--
-- AUTO_INCREMENT for table `user_variables`
--
ALTER TABLE `user_variables`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `vaccation_notifications`
--
ALTER TABLE `vaccation_notifications`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `contacts`
--
ALTER TABLE `contacts`
  ADD CONSTRAINT `contacts_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `bulk_groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `deposits`
--
ALTER TABLE `deposits`
  ADD CONSTRAINT `deposits_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `directors`
--
ALTER TABLE `directors`
  ADD CONSTRAINT `directors_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `emergency_contacts`
--
ALTER TABLE `emergency_contacts`
  ADD CONSTRAINT `emergency_contacts_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `employed_tenants`
--
ALTER TABLE `employed_tenants`
  ADD CONSTRAINT `employed_tenants_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `gate_electronics`
--
ALTER TABLE `gate_electronics`
  ADD CONSTRAINT `gate_electronics_gate_id_foreign` FOREIGN KEY (`gate_id`) REFERENCES `gate_gates` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `gate_electronics_visitor_id_foreign` FOREIGN KEY (`visitor_id`) REFERENCES `gate_visitors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `gate_gateassignments`
--
ALTER TABLE `gate_gateassignments`
  ADD CONSTRAINT `gate_gateassignments_assigned_by_foreign` FOREIGN KEY (`assigned_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `gate_gateassignments_gate_id_foreign` FOREIGN KEY (`gate_id`) REFERENCES `gate_gates` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `gate_gateassignments_guard_id_foreign` FOREIGN KEY (`guard_id`) REFERENCES `gate_guards` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `gate_guards`
--
ALTER TABLE `gate_guards`
  ADD CONSTRAINT `gate_guards_property_id_foreign` FOREIGN KEY (`property_id`) REFERENCES `properties` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `gate_guards_provider_id_foreign` FOREIGN KEY (`provider_id`) REFERENCES `agents` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `gate_guards_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `gate_incidents`
--
ALTER TABLE `gate_incidents`
  ADD CONSTRAINT `gate_incidents_gate_id_foreign` FOREIGN KEY (`gate_id`) REFERENCES `gate_gates` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `gate_incidents_property_id_foreign` FOREIGN KEY (`property_id`) REFERENCES `properties` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `gate_incidents_provider_id_foreign` FOREIGN KEY (`provider_id`) REFERENCES `agents` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `gate_incidents_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `gate_vehicles`
--
ALTER TABLE `gate_vehicles`
  ADD CONSTRAINT `gate_vehicles_gate_id_foreign` FOREIGN KEY (`gate_id`) REFERENCES `gate_gates` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `gate_vehicles_visitor_id_foreign` FOREIGN KEY (`visitor_id`) REFERENCES `gate_visitors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `gate_visitors`
--
ALTER TABLE `gate_visitors`
  ADD CONSTRAINT `gate_visitors_gate_id_foreign` FOREIGN KEY (`gate_id`) REFERENCES `gate_gates` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `gate_visitors_host_id_foreign` FOREIGN KEY (`host_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `invoices_issued_to_foreign` FOREIGN KEY (`issued_to`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `invoices_provider_id_foreign` FOREIGN KEY (`provider_id`) REFERENCES `agents` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `invoices_space_id_foreign` FOREIGN KEY (`space_id`) REFERENCES `spaces` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `job_requests`
--
ALTER TABLE `job_requests`
  ADD CONSTRAINT `job_requests_repair_request_id_foreign` FOREIGN KEY (`repair_request_id`) REFERENCES `repair_requests` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `plots`
--
ALTER TABLE `plots`
  ADD CONSTRAINT `plots_provider_id_foreign` FOREIGN KEY (`provider_id`) REFERENCES `agents` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `plot_images`
--
ALTER TABLE `plot_images`
  ADD CONSTRAINT `plot_images_image_id_foreign` FOREIGN KEY (`image_id`) REFERENCES `uploads` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `plot_images_plot_id_foreign` FOREIGN KEY (`plot_id`) REFERENCES `plots` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `possessions`
--
ALTER TABLE `possessions`
  ADD CONSTRAINT `possessions_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `profiles`
--
ALTER TABLE `profiles`
  ADD CONSTRAINT `profiles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `properties`
--
ALTER TABLE `properties`
  ADD CONSTRAINT `properties_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `properties_provider_id_foreign` FOREIGN KEY (`provider_id`) REFERENCES `agents` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `properties_subcategory_id_foreign` FOREIGN KEY (`subcategory_id`) REFERENCES `sub_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `property_images`
--
ALTER TABLE `property_images`
  ADD CONSTRAINT `property_images_image_id_foreign` FOREIGN KEY (`image_id`) REFERENCES `uploads` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `property_images_property_id_foreign` FOREIGN KEY (`property_id`) REFERENCES `properties` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `provider_suppliers`
--
ALTER TABLE `provider_suppliers`
  ADD CONSTRAINT `provider_suppliers_provider_id_foreign` FOREIGN KEY (`provider_id`) REFERENCES `agents` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `provider_suppliers_supplier_id_foreign` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `quatations`
--
ALTER TABLE `quatations`
  ADD CONSTRAINT `quatations_provider_id_foreign` FOREIGN KEY (`provider_id`) REFERENCES `agents` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `repairs`
--
ALTER TABLE `repairs`
  ADD CONSTRAINT `repairs_provider_id_foreign` FOREIGN KEY (`provider_id`) REFERENCES `agents` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `repairs_space_id_foreign` FOREIGN KEY (`space_id`) REFERENCES `spaces` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `repair_items`
--
ALTER TABLE `repair_items`
  ADD CONSTRAINT `repair_items_repair_id_foreign` FOREIGN KEY (`repair_id`) REFERENCES `repairs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `spaces`
--
ALTER TABLE `spaces`
  ADD CONSTRAINT `spaces_property_id_foreign` FOREIGN KEY (`property_id`) REFERENCES `properties` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `space_images`
--
ALTER TABLE `space_images`
  ADD CONSTRAINT `space_images_image_id_foreign` FOREIGN KEY (`image_id`) REFERENCES `uploads` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `space_images_space_id_foreign` FOREIGN KEY (`space_id`) REFERENCES `spaces` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tenants`
--
ALTER TABLE `tenants`
  ADD CONSTRAINT `tenants_provider_id_foreign` FOREIGN KEY (`provider_id`) REFERENCES `agents` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tenants_space_id_foreign` FOREIGN KEY (`space_id`) REFERENCES `spaces` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tenants_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tenants_occupants`
--
ALTER TABLE `tenants_occupants`
  ADD CONSTRAINT `tenants_occupants_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tenant_charges`
--
ALTER TABLE `tenant_charges`
  ADD CONSTRAINT `tenant_charges_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tenant_payments`
--
ALTER TABLE `tenant_payments`
  ADD CONSTRAINT `tenant_payments_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tenant_payments_provider_id_foreign` FOREIGN KEY (`provider_id`) REFERENCES `agents` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tenant_payments_space_id_foreign` FOREIGN KEY (`space_id`) REFERENCES `spaces` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tenant_payments_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `topups`
--
ALTER TABLE `topups`
  ADD CONSTRAINT `topups_histrory_id_foreign` FOREIGN KEY (`histrory_id`) REFERENCES `topup_histories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `uploads`
--
ALTER TABLE `uploads`
  ADD CONSTRAINT `uploads_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `vaccation_notifications`
--
ALTER TABLE `vaccation_notifications`
  ADD CONSTRAINT `vaccation_notifications_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
