-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 04, 2020 at 02:03 PM
-- Server version: 10.1.33-MariaDB
-- PHP Version: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `beatybella`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_setting`
--

CREATE TABLE `admin_setting` (
  `id` int(11) NOT NULL,
  `phone_no` varchar(20) NOT NULL DEFAULT '+91 21456987',
  `email` varchar(255) NOT NULL DEFAULT 'support@email.com',
  `address` text,
  `pp` text NOT NULL,
  `notification` int(11) NOT NULL DEFAULT '1',
  `currency_symbol` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '$',
  `currency` varchar(255) NOT NULL DEFAULT 'USD',
  `time_slot_length` int(11) NOT NULL DEFAULT '30',
  `verification` int(11) NOT NULL DEFAULT '0',
  `sms_gateway` varchar(20) NOT NULL DEFAULT 'twilio',
  `country_code` varchar(4) NOT NULL DEFAULT '+91',
  `offline_payment` int(11) NOT NULL DEFAULT '1',
  `stipe_status` int(11) NOT NULL DEFAULT '0',
  `paypal_status` int(11) NOT NULL DEFAULT '0',
  `razor_status` int(11) NOT NULL DEFAULT '0',
  `ios_version` varchar(255) NOT NULL DEFAULT '1.0.2',
  `android_version` varchar(255) NOT NULL DEFAULT '1.0.5',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_setting`
--

INSERT INTO `admin_setting` (`id`, `phone_no`, `email`, `address`, `pp`, `notification`, `currency_symbol`, `currency`, `time_slot_length`, `verification`, `sms_gateway`, `country_code`, `offline_payment`, `stipe_status`, `paypal_status`, `razor_status`, `ios_version`, `android_version`, `created_at`, `updated_at`) VALUES
(1, '+4478788778772', 'support@email.com', 'Massachusetts Turnpike', '<h2 style=\"letter-spacing: normal; padding: 0px; font-family: Roboto, Helvetica, Arial, sans-serif; font-size: 45px; line-height: 48px; margin: 24px 0px; color: rgb(97, 97, 97);\">Privacy Policy d</h2><p style=\"letter-spacing: normal; padding: 0px; line-height: 24px; font-size: 14px; margin-right: 0px; margin-bottom: 16px; margin-left: 0px; color: rgb(97, 97, 97); font-family: Roboto, Helvetica, sans-serif;\">[Developer/Company name] built the [App Name] app as [open source/free/freemium/ad-supported/commercial] app. This SERVICE is provided by [Developer/Company name] [at no cost] and is intended for use as is.</p><p style=\"letter-spacing: normal; padding: 0px; line-height: 24px; font-size: 14px; margin-right: 0px; margin-bottom: 16px; margin-left: 0px; color: rgb(97, 97, 97); font-family: Roboto, Helvetica, sans-serif;\">This page is used to inform visitors regarding [my/our] policies with the collection, use, and disclosure of Personal Information if anyone decided to use [my/our] Service.</p><p style=\"letter-spacing: normal; padding: 0px; line-height: 24px; font-size: 14px; margin-right: 0px; margin-bottom: 16px; margin-left: 0px; color: rgb(97, 97, 97); font-family: Roboto, Helvetica, sans-serif;\">If you choose to use [my/our] Service, then you agree to the collection and use of information in relation to this policy. The Personal Information that [I/We] collect is used for providing and improving the Service. [I/We] will not use or share your information with anyone except as described in this Privacy Policy.</p><p style=\"letter-spacing: normal; padding: 0px; line-height: 24px; font-size: 14px; margin-right: 0px; margin-bottom: 16px; margin-left: 0px; color: rgb(97, 97, 97); font-family: Roboto, Helvetica, sans-serif;\">The terms used in this Privacy Policy have the same meanings as in our Terms and Conditions, which is accessible at [App Name] unless otherwise defined in this Privacy Policy.</p><div><strong style=\"letter-spacing: normal; color: rgb(97, 97, 97); font-family: Roboto, Helvetica, sans-serif; font-size: 14px;\">Information Collection and Use</strong></div><div><p style=\"letter-spacing: normal; padding: 0px; line-height: 24px; font-size: 14px; margin-right: 0px; margin-bottom: 16px; margin-left: 0px; color: rgb(97, 97, 97); font-family: Roboto, Helvetica, sans-serif;\">For a better experience, while using our Service, [I/We] may require you to provide us with certain personally identifiable information[add whatever else you collect here, e.g. users name, address, location, pictures] The information that [I/We] request will be [retained on your device and is not collected by [me/us] in any way]/[retained by us and used as described in this privacy policy].</p><p style=\"letter-spacing: normal; padding: 0px; line-height: 24px; font-size: 14px; margin-right: 0px; margin-bottom: 16px; margin-left: 0px; color: rgb(97, 97, 97); font-family: Roboto, Helvetica, sans-serif;\">The app does use third party services that may collect information used to identify you.</p><div style=\"letter-spacing: normal; color: rgb(97, 97, 97); font-family: Roboto, Helvetica, sans-serif; font-size: 14px;\"><p style=\"padding: 0px; line-height: 24px; letter-spacing: 0px; margin-right: 0px; margin-bottom: 16px; margin-left: 0px;\">Link to privacy policy of third party service providers used by the app</p><ul style=\"letter-spacing: 0px; line-height: 24px;\"><li><a href=\"https://www.google.com/policies/privacy/\" target=\"_blank\" style=\"-webkit-tap-highlight-color: rgba(255, 255, 255, 0); color: rgb(68, 138, 255);\">Google Play Services</a></li></ul><p style=\"padding: 0px; line-height: 24px; margin-right: 0px; margin-bottom: 16px; margin-left: 0px;\"><strong>Log Data</strong></p><p style=\"padding: 0px; line-height: 24px; margin-right: 0px; margin-bottom: 16px; margin-left: 0px;\">[I/We] want to inform you that whenever you use [my/our] Service, in a case of an error in the app [I/We] collect data and information (through third party products) on your phone called Log Data. This Log Data may include information such as your device Internet Protocol (“IP”) address, device name, operating system version, the configuration of the app when utilizing [my/our] Service, the time and date of your use of the Service, and other statistics.</p></div><br></div>', 1, '₹', 'INR', 60, 0, 'twilio', '+913', 1, 1, 1, 1, '2.2.03', '20.2.2', NULL, '2020-06-03 13:09:29');

-- --------------------------------------------------------

--
-- Table structure for table `app_users`
--

CREATE TABLE `app_users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone_no` varchar(20) DEFAULT NULL,
  `image` varchar(255) NOT NULL DEFAULT 'default.png',
  `address` text,
  `device_token` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `liked_salon` text,
  `OTP` varchar(6) DEFAULT '',
  `noti` int(11) NOT NULL DEFAULT '1',
  `verified` int(11) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `app_users`
--

INSERT INTO `app_users` (`id`, `name`, `email`, `password`, `phone_no`, `image`, `address`, `device_token`, `status`, `liked_salon`, `OTP`, `noti`, `verified`, `created_at`, `updated_at`) VALUES
(9, 'der', 'user@user.com', '$2y$10$T7hAfwGKXQ.K7akQaez3tu1YHfiK4x8xThXZ.NEYNOYYEZbPEegBe', '123456', 'default.png', NULL, NULL, 0, NULL, '', 1, 1, '2020-05-23 05:14:43', '2020-05-24 04:31:20'),
(10, 'der', 'user@user.com1', '$2y$10$jlSTTzjOhsqOpw8/Z03IxOwH1gNde8dMR9ufNqB7r8wYs1G0ypwqi', '123456sad', 'default.png', NULL, NULL, 1, NULL, '', 1, 1, '2020-05-23 09:10:10', '2020-05-23 09:10:10'),
(11, 'test', 'test@gmail.com', '$2y$10$LBIc6OnRGczC0PkfSu31Y.oqrq2u22PYwTLX1KFLkO4a0ZIkzudOm', '12345689', '5ed5f91ceae46.jpg', NULL, '12095236-2119-4881-a96a-9924bafa3aaf', 1, NULL, '8629', 1, 1, '2020-05-25 06:21:59', '2020-06-04 10:36:59'),
(12, 'rio', 'rio@gmail.com', '$2y$10$ub9V.eJZJVa1PRQKltjdFuk2dYEi8r2ZXt1XiOJ6h5KIlRmtZ7D0C', '8200284277', 'default.png', NULL, NULL, 1, NULL, '9021', 1, 1, '2020-05-25 09:19:26', '2020-05-25 09:20:10');

-- --------------------------------------------------------

--
-- Table structure for table `booking_child`
--

CREATE TABLE `booking_child` (
  `id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `duration` int(11) NOT NULL,
  `start_time` datetime DEFAULT NULL,
  `end_time` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `booking_child`
--

INSERT INTO `booking_child` (`id`, `booking_id`, `service_id`, `emp_id`, `duration`, `start_time`, `end_time`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 30, '2020-06-03 09:00:00', '2020-06-03 09:30:00', '2020-06-03 17:55:36', '2020-06-03 17:55:36'),
(2, 2, 9, 2, 20, '2020-06-04 09:00:00', '2020-06-04 09:20:00', '2020-06-04 11:42:14', '2020-06-04 11:42:14'),
(3, 3, 1, 1, 30, '2020-06-05 20:00:00', '2020-06-05 20:30:00', '2020-06-04 13:08:25', '2020-06-04 13:08:25'),
(4, 3, 2, 1, 40, '2020-06-05 20:30:00', '2020-06-05 21:10:00', '2020-06-04 13:08:25', '2020-06-04 13:08:25'),
(5, 3, 3, 1, 50, '2020-06-05 21:10:00', '2020-06-05 22:00:00', '2020-06-04 13:08:25', '2020-06-04 13:08:25'),
(6, 3, 7, 2, 20, '2020-06-05 22:00:00', '2020-06-05 22:20:00', '2020-06-04 13:08:25', '2020-06-04 13:08:25'),
(7, 3, 8, 2, 45, '2020-06-05 22:20:00', '2020-06-05 23:05:00', '2020-06-04 13:08:25', '2020-06-04 13:08:25'),
(8, 3, 9, 2, 20, '2020-06-05 23:05:00', '2020-06-05 23:25:00', '2020-06-04 13:08:25', '2020-06-04 13:08:25'),
(9, 4, 1, 1, 30, '2020-06-05 13:00:00', '2020-06-05 13:30:00', '2020-06-04 14:36:50', '2020-06-04 14:36:50'),
(10, 4, 2, 1, 40, '2020-06-05 13:30:00', '2020-06-05 14:10:00', '2020-06-04 14:36:50', '2020-06-04 14:36:50'),
(11, 5, 2, 1, 40, '2020-06-04 20:00:00', '2020-06-04 20:40:00', '2020-06-04 14:53:03', '2020-06-04 14:53:03'),
(12, 6, 1, 1, 30, '2020-06-04 17:00:00', '2020-06-04 17:30:00', '2020-06-04 15:14:06', '2020-06-04 15:14:06'),
(13, 7, 2, 1, 40, '2020-06-09 16:00:00', '2020-06-09 16:40:00', '2020-06-04 16:15:15', '2020-06-04 16:15:15');

-- --------------------------------------------------------

--
-- Table structure for table `booking_master`
--

CREATE TABLE `booking_master` (
  `id` int(11) NOT NULL,
  `booking_id` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL,
  `offer_id` int(11) DEFAULT NULL,
  `total` float NOT NULL,
  `discount` float NOT NULL DEFAULT '0',
  `duration` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '0' COMMENT '0 = waiting 1 =confirm 2=complate 3=cancel',
  `payment_status` int(11) NOT NULL DEFAULT '0' COMMENT '0= no 1 = yes',
  `payment_token` varchar(255) DEFAULT NULL,
  `payment_method` varchar(255) NOT NULL DEFAULT 'Offline',
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `booking_master`
--

INSERT INTO `booking_master` (`id`, `booking_id`, `user_id`, `branch_id`, `start_time`, `end_time`, `offer_id`, `total`, `discount`, `duration`, `status`, `payment_status`, `payment_token`, `payment_method`, `updated_at`, `created_at`) VALUES
(1, 'bhk-5ed796', 11, 1, '2020-06-03 09:00:00', '2020-06-03 09:30:00', NULL, 30, 0, 30, 2, 0, NULL, 'Offline', '2020-06-04 11:39:06', '2020-06-03 17:55:36'),
(2, 'bhk-5ed890', 11, 1, '2020-06-04 09:00:00', '2020-06-04 09:20:00', NULL, 35, 0, 20, 3, 1, NULL, 'Offline', '2020-06-04 13:12:32', '2020-06-04 11:42:14'),
(3, 'bhk-5ed8a4', 11, 1, '2020-06-05 20:00:00', '2020-06-05 23:25:00', NULL, 210, 0, 205, 2, 1, NULL, 'Offline', '2020-06-04 13:10:29', '2020-06-04 13:08:25'),
(4, 'bhk-5ed8b9', 11, 3, '2020-06-05 13:00:00', '2020-06-05 14:10:00', NULL, 55, 0, 70, 0, 0, NULL, 'Offline', '2020-06-04 14:36:50', '2020-06-04 14:36:50'),
(5, 'bhk-5ed8bd', 11, 1, '2020-06-04 20:00:00', '2020-06-04 20:40:00', NULL, 25, 0, 40, 0, 0, NULL, 'Offline', '2020-06-04 14:53:03', '2020-06-04 14:53:03'),
(6, 'bhk-5ed8c2', 11, 1, '2020-06-04 17:00:00', '2020-06-04 17:30:00', NULL, 30, 0, 30, 0, 0, NULL, 'Offline', '2020-06-04 15:14:06', '2020-06-04 15:14:06'),
(7, 'bhk-5ed8d0', 11, 1, '2020-06-09 16:00:00', '2020-06-09 16:40:00', NULL, 25, 0, 40, 0, 1, 'tok_1GqGZSFluOgnsqwfZN30BsWg', 'Strip', '2020-06-04 16:15:15', '2020-06-04 16:15:15');

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE `branch` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `for_who` int(11) NOT NULL DEFAULT '0',
  `description` text NOT NULL,
  `icon` varchar(50) NOT NULL DEFAULT 'default.png',
  `start_time` time NOT NULL DEFAULT '09:00:00',
  `end_time` time NOT NULL DEFAULT '23:00:00',
  `category` text,
  `manager` text,
  `employee` text,
  `is_featured` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`id`, `name`, `address`, `for_who`, `description`, `icon`, `start_time`, `end_time`, `category`, `manager`, `employee`, `is_featured`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Addictive Beauty', 'West minister Business Road, UK', 0, 'At Addictive Beauty Salon We never compromise on quality to  the highest standards of Hygiene and products,', '5ed795bb3710c.png', '09:00:00', '20:00:00', '3,1', '12', '8,9', 1, 1, '2020-06-03 17:47:56', '2020-06-03 17:58:12', NULL),
(2, 'Barbarella Salon', 'rajkot  gujrat', 2, 'At Addictive Beauty Salon We never compromise on quality to insur', '5ed79560a64a0.png', '09:00:00', '19:00:00', '1', '11', '9', 1, 1, '2020-06-03 17:49:44', '2020-06-04 12:59:39', NULL),
(3, 'The Makeover Place', '341 Saint Nicholas Ave, New York, NY 10027, USA', 1, 'At Addictive Beauty Salon We never compromise on qual', '5ed795abc27b7.png', '08:00:00', '18:00:00', '3,1,2', '13', '10,8,9', 0, 1, '2020-06-03 17:50:59', '2020-06-03 17:58:31', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL DEFAULT 'default.png',
  `is_trending` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `icon`, `is_trending`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Hair', '5ed78dd951db3.png', 1, 1, '2020-06-03 17:17:37', '2020-06-03 17:17:37', NULL),
(2, 'Spa', '5ed78df24b612.png', 1, 1, '2020-06-03 17:18:02', '2020-06-03 17:18:02', NULL),
(3, 'Eyebrows & Lashes', '5ed78e062fd1a.png', 0, 1, '2020-06-03 17:18:22', '2020-06-03 17:18:22', NULL),
(4, 'Nail', '5ed78e1be14c0.png', 0, 1, '2020-06-03 17:18:43', '2020-06-03 17:18:43', NULL),
(5, 'Therapy Center', '5ed78e373e025.png', 0, 1, '2020-06-03 17:19:11', '2020-06-03 17:19:11', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `currency`
--

CREATE TABLE `currency` (
  `id` int(11) NOT NULL,
  `country` varchar(100) DEFAULT NULL,
  `currency` varchar(100) DEFAULT NULL,
  `code` varchar(100) DEFAULT NULL,
  `symbol` varchar(100) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `currency`
--

INSERT INTO `currency` (`id`, `country`, `currency`, `code`, `symbol`) VALUES
(1, 'Albania', 'Leke', 'ALL', 'Lek'),
(2, 'America', 'Dollars', 'USD', '$'),
(3, 'Afghanistan', 'Afghanis', 'AFN', '؋'),
(4, 'Argentina', 'Pesos', 'ARS', '$'),
(5, 'Aruba', 'Guilders', 'AWG', 'Afl'),
(6, 'Australia', 'Dollars', 'AUD', '$'),
(7, 'Azerbaijan', 'New Manats', 'AZN', '₼'),
(8, 'Bahamas', 'Dollars', 'BSD', '$'),
(9, 'Barbados', 'Dollars', 'BBD', '$'),
(10, 'Belarus', 'Rubles', 'BYR', 'p.'),
(11, 'Belgium', 'Euro', 'EUR', '€'),
(12, 'Beliz', 'Dollars', 'BZD', 'BZ$'),
(13, 'Bermuda', 'Dollars', 'BMD', '$'),
(14, 'Bolivia', 'Bolivianos', 'BOB', '$b'),
(15, 'Bosnia and Herzegovina', 'Convertible Marka', 'BAM', 'KM'),
(16, 'Botswana', 'Pula', 'BWP', 'P'),
(17, 'Bulgaria', 'Leva', 'BGN', 'Лв.'),
(18, 'Brazil', 'Reais', 'BRL', 'R$'),
(19, 'Britain (United Kingdom)', 'Pounds', 'GBP', '£\r\n'),
(20, 'Brunei Darussalam', 'Dollars', 'BND', '$'),
(21, 'Cambodia', 'Riels', 'KHR', '៛'),
(22, 'Canada', 'Dollars', 'CAD', '$'),
(23, 'Cayman Islands', 'Dollars', 'KYD', '$'),
(24, 'Chile', 'Pesos', 'CLP', '$'),
(25, 'China', 'Yuan Renminbi', 'CNY', '¥'),
(26, 'Colombia', 'Pesos', 'COP', '$'),
(27, 'Costa Rica', 'Colón', 'CRC', '₡'),
(28, 'Croatia', 'Kuna', 'HRK', 'kn'),
(29, 'Cuba', 'Pesos', 'CUP', '₱'),
(30, 'Cyprus', 'Euro', 'EUR', '€'),
(31, 'Czech Republic', 'Koruny', 'CZK', 'Kč'),
(32, 'Denmark', 'Kroner', 'DKK', 'kr'),
(33, 'Dominican Republic', 'Pesos', 'DOP ', 'RD$'),
(34, 'East Caribbean', 'Dollars', 'XCD', '$'),
(35, 'Egypt', 'Pounds', 'EGP', '£'),
(36, 'El Salvador', 'Colones', 'SVC', '$'),
(37, 'England (United Kingdom)', 'Pounds', 'GBP', '£'),
(38, 'Euro', 'Euro', 'EUR', '€'),
(39, 'Falkland Islands', 'Pounds', 'FKP', '£'),
(40, 'Fiji', 'Dollars', 'FJD', '$'),
(41, 'France', 'Euro', 'EUR', '€'),
(42, 'Ghana', 'Cedis', 'GHC', 'GH₵'),
(43, 'Gibraltar', 'Pounds', 'GIP', '£'),
(44, 'Greece', 'Euro', 'EUR', '€'),
(45, 'Guatemala', 'Quetzales', 'GTQ', 'Q'),
(46, 'Guernsey', 'Pounds', 'GGP', '£'),
(47, 'Guyana', 'Dollars', 'GYD', '$'),
(48, 'Holland (Netherlands)', 'Euro', 'EUR', '€'),
(49, 'Honduras', 'Lempiras', 'HNL', 'L'),
(50, 'Hong Kong', 'Dollars', 'HKD', '$'),
(51, 'Hungary', 'Forint', 'HUF', 'Ft'),
(52, 'Iceland', 'Kronur', 'ISK', 'kr'),
(53, 'India', 'Rupees', 'INR', '₹'),
(54, 'Indonesia', 'Rupiahs', 'IDR', 'Rp'),
(55, 'Iran', 'Rials', 'IRR', '﷼'),
(56, 'Ireland', 'Euro', 'EUR', '€'),
(57, 'Isle of Man', 'Pounds', 'IMP', '£'),
(58, 'Israel', 'New Shekels', 'ILS', '₪'),
(59, 'Italy', 'Euro', 'EUR', '€'),
(60, 'Jamaica', 'Dollars', 'JMD', 'J$'),
(61, 'Japan', 'Yen', 'JPY', '¥'),
(62, 'Jersey', 'Pounds', 'JEP', '£'),
(63, 'Kazakhstan', 'Tenge', 'KZT', '₸'),
(64, 'Korea (North)', 'Won', 'KPW', '₩'),
(65, 'Korea (South)', 'Won', 'KRW', '₩'),
(66, 'Kyrgyzstan', 'Soms', 'KGS', 'Лв'),
(67, 'Laos', 'Kips', 'LAK', '	₭'),
(68, 'Latvia', 'Lati', 'LVL', 'Ls'),
(69, 'Lebanon', 'Pounds', 'LBP', '£'),
(70, 'Liberia', 'Dollars', 'LRD', '$'),
(71, 'Liechtenstein', 'Switzerland Francs', 'CHF', 'CHF'),
(72, 'Lithuania', 'Litai', 'LTL', 'Lt'),
(73, 'Luxembourg', 'Euro', 'EUR', '€'),
(74, 'Macedonia', 'Denars', 'MKD', 'Ден\r\n'),
(75, 'Malaysia', 'Ringgits', 'MYR', 'RM'),
(76, 'Malta', 'Euro', 'EUR', '€'),
(77, 'Mauritius', 'Rupees', 'MUR', '₹'),
(78, 'Mexico', 'Pesos', 'MXN', '$'),
(79, 'Mongolia', 'Tugriks', 'MNT', '₮'),
(80, 'Mozambique', 'Meticais', 'MZN', 'MT'),
(81, 'Namibia', 'Dollars', 'NAD', '$'),
(82, 'Nepal', 'Rupees', 'NPR', '₹'),
(83, 'Netherlands Antilles', 'Guilders', 'ANG', 'ƒ'),
(84, 'Netherlands', 'Euro', 'EUR', '€'),
(85, 'New Zealand', 'Dollars', 'NZD', '$'),
(86, 'Nicaragua', 'Cordobas', 'NIO', 'C$'),
(87, 'Nigeria', 'Nairas', 'NGN', '₦'),
(88, 'North Korea', 'Won', 'KPW', '₩'),
(89, 'Norway', 'Krone', 'NOK', 'kr'),
(90, 'Oman', 'Rials', 'OMR', '﷼'),
(91, 'Pakistan', 'Rupees', 'PKR', '₹'),
(92, 'Panama', 'Balboa', 'PAB', 'B/.'),
(93, 'Paraguay', 'Guarani', 'PYG', 'Gs'),
(94, 'Peru', 'Nuevos Soles', 'PEN', 'S/.'),
(95, 'Philippines', 'Pesos', 'PHP', 'Php'),
(96, 'Poland', 'Zlotych', 'PLN', 'zł'),
(97, 'Qatar', 'Rials', 'QAR', '﷼'),
(98, 'Romania', 'New Lei', 'RON', 'lei'),
(99, 'Russia', 'Rubles', 'RUB', '₽'),
(100, 'Saint Helena', 'Pounds', 'SHP', '£'),
(101, 'Saudi Arabia', 'Riyals', 'SAR', '﷼'),
(102, 'Serbia', 'Dinars', 'RSD', 'ع.د'),
(103, 'Seychelles', 'Rupees', 'SCR', '₹'),
(104, 'Singapore', 'Dollars', 'SGD', '$'),
(105, 'Slovenia', 'Euro', 'EUR', '€'),
(106, 'Solomon Islands', 'Dollars', 'SBD', '$'),
(107, 'Somalia', 'Shillings', 'SOS', 'S'),
(108, 'South Africa', 'Rand', 'ZAR', 'R'),
(109, 'South Korea', 'Won', 'KRW', '₩'),
(110, 'Spain', 'Euro', 'EUR', '€'),
(111, 'Sri Lanka', 'Rupees', 'LKR', '₹'),
(112, 'Sweden', 'Kronor', 'SEK', 'kr'),
(113, 'Switzerland', 'Francs', 'CHF', 'CHF'),
(114, 'Suriname', 'Dollars', 'SRD', '$'),
(115, 'Syria', 'Pounds', 'SYP', '£'),
(116, 'Taiwan', 'New Dollars', 'TWD', 'NT$'),
(117, 'Thailand', 'Baht', 'THB', '฿'),
(118, 'Trinidad and Tobago', 'Dollars', 'TTD', 'TT$'),
(119, 'Turkey', 'Lira', 'TRY', 'TL'),
(120, 'Turkey', 'Liras', 'TRL', '₺'),
(121, 'Tuvalu', 'Dollars', 'TVD', '$'),
(122, 'Ukraine', 'Hryvnia', 'UAH', '₴'),
(123, 'United Kingdom', 'Pounds', 'GBP', '£'),
(124, 'United States of America', 'Dollars', 'USD', '$'),
(125, 'Uruguay', 'Pesos', 'UYU', '$U'),
(126, 'Uzbekistan', 'Sums', 'UZS', 'so\'m'),
(127, 'Vatican City', 'Euro', 'EUR', '€'),
(128, 'Venezuela', 'Bolivares Fuertes', 'VEF', 'Bs'),
(129, 'Vietnam', 'Dong', 'VND', '₫\r\n'),
(130, 'Yemen', 'Rials', 'YER', '﷼'),
(131, 'Zimbabwe', 'Zimbabwe Dollars', 'ZWD', 'Z$');

-- --------------------------------------------------------

--
-- Table structure for table `employee_detail`
--

CREATE TABLE `employee_detail` (
  `id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `description` text,
  `service` text,
  `icon` varchar(255) NOT NULL DEFAULT 'default.png',
  `status` int(11) NOT NULL DEFAULT '1',
  `experience` text,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee_detail`
--

INSERT INTO `employee_detail` (`id`, `emp_id`, `address`, `description`, `service`, `icon`, `status`, `experience`, `created_at`, `updated_at`) VALUES
(1, 8, '320 Oxford St,  Paddington NSW 2021', 'A high-fashion stylist and educator with 17 years of experience under her belt', '3,1,2', '5ed793d46fbd5.jpg', 1, '10 Year', '2020-06-03 17:43:08', '2020-06-03 17:43:08'),
(2, 9, 'Wasaga Beach ON, Canada', 'From colouring and cutting to styling, Zoia is an all-rounder', '7,9,8', '5ed79424be04a.jpg', 1, 'Art Director & Senior Colour Specialist', '2020-06-03 17:44:28', '2020-06-03 17:44:28'),
(3, 10, 'Miami Beach FL, USA', 'After completing his apprenticeship in Adelaide,', '4,6,5', '5ed7947723826.jpg', 1, 'Art Director & Senior Colour Specialist', '2020-06-03 17:45:51', '2020-06-03 17:45:51');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2019_08_19_000000_create_failed_jobs_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 2),
(4, '2016_06_01_000001_create_oauth_auth_codes_table', 2),
(5, '2016_06_01_000002_create_oauth_access_tokens_table', 2),
(6, '2016_06_01_000003_create_oauth_refresh_tokens_table', 2),
(7, '2016_06_01_000004_create_oauth_clients_table', 2),
(8, '2016_06_01_000005_create_oauth_personal_access_clients_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `notification_tbl`
--

CREATE TABLE `notification_tbl` (
  `id` int(11) NOT NULL,
  `booking_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `title` text NOT NULL,
  `sub_title` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notification_tbl`
--

INSERT INTO `notification_tbl` (`id`, `booking_id`, `user_id`, `sender_id`, `title`, `sub_title`, `created_at`, `updated_at`) VALUES
(1, 2, 11, 1, '{{farm_title}} Has Accepted Your Booking Request.', 'more information please contact {{owner_name}}.', '2020-06-04 11:47:21', '2020-06-04 11:47:21'),
(2, 2, 11, 1, '{{farm_title}} Has Accepted Your Booking Request.', 'more information please contact {{owner_name}}.', '2020-06-04 11:47:23', '2020-06-04 11:47:23'),
(3, 2, 11, 1, '{{farm_title}} Has Accepted Your Booking Request.', 'more information please contact {{owner_name}}.', '2020-06-04 11:47:25', '2020-06-04 11:47:25'),
(4, 2, 11, 1, '{{farm_title}} Has Accepted Your Booking Request.', 'more information please contact {{owner_name}}.', '2020-06-04 11:47:26', '2020-06-04 11:47:26'),
(5, 2, 11, 1, '{{farm_title}} Has Accepted Your Booking Request.', 'more information please contact {{owner_name}}.', '2020-06-04 11:47:27', '2020-06-04 11:47:27'),
(6, 2, 11, 1, '{{farm_title}} Has Accepted Your Booking Request.', 'more information please contact {{owner_name}}.', '2020-06-04 11:47:28', '2020-06-04 11:47:28'),
(7, 2, 11, 1, '{{farm_title}} Has Accepted Your Booking Request.', 'more information please contact {{owner_name}}.', '2020-06-04 11:47:29', '2020-06-04 11:47:29'),
(8, 2, 11, 1, '{{farm_title}} Has Accepted Your Booking Request.', 'more information please contact {{owner_name}}.', '2020-06-04 11:47:30', '2020-06-04 11:47:30'),
(9, 2, 11, 1, '{{farm_title}} Has Accepted Your Booking Request.', 'more information please contact {{owner_name}}.', '2020-06-04 11:47:31', '2020-06-04 11:47:31'),
(10, 2, 11, 1, '{{farm_title}} Has Accepted Your Booking Request.', 'more information please contact {{owner_name}}.', '2020-06-04 11:47:32', '2020-06-04 11:47:32'),
(11, 2, 11, 1, '{{farm_title}} Has Accepted Your Booking Request.', 'more information please contact {{owner_name}}.', '2020-06-04 11:47:33', '2020-06-04 11:47:33'),
(12, 2, 11, 1, '{{farm_title}} Has Accepted Your Booking Request.', 'more information please contact {{owner_name}}.', '2020-06-04 11:47:34', '2020-06-04 11:47:34'),
(13, 2, 11, 1, '{{farm_title}} Has Accepted Your Booking Request.', 'more information please contact {{owner_name}}.', '2020-06-04 11:47:35', '2020-06-04 11:47:35'),
(14, 2, 11, 1, '{{farm_title}} Has Accepted Your Booking Request.', 'more information please contact {{owner_name}}.', '2020-06-04 11:47:36', '2020-06-04 11:47:36'),
(15, 2, 11, 1, '{{farm_title}} Has Accepted Your Booking Request.', 'more information please contact {{owner_name}}.', '2020-06-04 11:47:37', '2020-06-04 11:47:37'),
(16, 2, 11, 1, '{{farm_title}} Has Accepted Your Booking Request.', 'more information please contact {{owner_name}}.', '2020-06-04 11:47:37', '2020-06-04 11:47:37'),
(17, 2, 11, 1, '{{farm_title}} Has Accepted Your Booking Request.', 'more information please contact {{owner_name}}.', '2020-06-04 11:47:38', '2020-06-04 11:47:38'),
(18, 2, 11, 1, '{{farm_title}} Has Accepted Your Booking Request.', 'more information please contact {{owner_name}}.', '2020-06-04 11:47:39', '2020-06-04 11:47:39'),
(19, 2, 11, 1, '{{farm_title}} Has Accepted Your Booking Request.', 'more information please contact {{owner_name}}.', '2020-06-04 11:47:40', '2020-06-04 11:47:40'),
(20, 2, 11, 1, '{{farm_title}} Has Accepted Your Booking Request.', 'more information please contact {{owner_name}}.', '2020-06-04 11:47:42', '2020-06-04 11:47:42'),
(21, 2, 11, 1, '{{farm_title}} Has Accepted Your Booking Request.', 'more information please contact {{owner_name}}.', '2020-06-04 11:47:43', '2020-06-04 11:47:43'),
(22, 2, 11, 1, '{{farm_title}} Has Accepted Your Booking Request.', 'more information please contact {{owner_name}}.', '2020-06-04 11:47:44', '2020-06-04 11:47:44'),
(23, 2, 11, 1, '{{farm_title}} Has Accepted Your Booking Request.', 'more information please contact {{owner_name}}.', '2020-06-04 11:47:44', '2020-06-04 11:47:44'),
(24, 2, 11, 1, '{{farm_title}} Has Accepted Your Booking Request.', 'more information please contact {{owner_name}}.', '2020-06-04 11:47:45', '2020-06-04 11:47:45'),
(25, 2, 11, 1, '{{farm_title}} Has Accepted Your Booking Request.', 'more information please contact {{owner_name}}.', '2020-06-04 11:47:46', '2020-06-04 11:47:46'),
(26, 2, 11, 1, '{{farm_title}} Has Accepted Your Booking Request.', 'more information please contact {{owner_name}}.', '2020-06-04 11:47:47', '2020-06-04 11:47:47'),
(27, 2, 11, 1, '{{farm_title}} Has Accepted Your Booking Request.', 'more information please contact {{owner_name}}.', '2020-06-04 11:47:48', '2020-06-04 11:47:48'),
(28, 2, 11, 1, '{{farm_title}} Has Accepted Your Booking Request.', 'more information please contact {{owner_name}}.', '2020-06-04 11:47:49', '2020-06-04 11:47:49'),
(29, 2, 11, 1, '{{farm_title}} Has Accepted Your Booking Request.', 'more information please contact {{owner_name}}.', '2020-06-04 11:47:50', '2020-06-04 11:47:50'),
(30, 2, 11, 1, '{{farm_title}} Has Accepted Your Booking Request.', 'more information please contact {{owner_name}}.', '2020-06-04 11:47:51', '2020-06-04 11:47:51'),
(31, 2, 11, 1, '{{farm_title}} Has Accepted Your Booking Request.', 'more information please contact {{owner_name}}.', '2020-06-04 11:47:51', '2020-06-04 11:47:51'),
(32, 2, 11, 1, '{{farm_title}} Has Accepted Your Booking Request.', 'more information please contact {{owner_name}}.', '2020-06-04 11:47:52', '2020-06-04 11:47:52'),
(33, 2, 11, 1, '{{farm_title}} Has Accepted Your Booking Request.', 'more information please contact {{owner_name}}.', '2020-06-04 11:47:53', '2020-06-04 11:47:53'),
(34, 2, 11, 1, '{{farm_title}} Has Accepted Your Booking Request.', 'more information please contact {{owner_name}}.', '2020-06-04 11:47:54', '2020-06-04 11:47:54'),
(35, 2, 11, 1, '{{farm_title}} Has Accepted Your Booking Request.', 'more information please contact {{owner_name}}.', '2020-06-04 11:47:55', '2020-06-04 11:47:55'),
(36, 2, 11, 1, '{{farm_title}} Has Accepted Your Booking Request.', 'more information please contact {{owner_name}}.', '2020-06-04 11:48:16', '2020-06-04 11:48:16'),
(37, 2, 11, 1, '{{farm_title}} Has Accepted Your Booking Request.', 'more information please contact {{owner_name}}.', '2020-06-04 11:48:28', '2020-06-04 11:48:28'),
(38, 2, 11, 1, '{{farm_title}} Has Accepted Your Booking Request.', 'more information please contact {{owner_name}}.', '2020-06-04 11:48:29', '2020-06-04 11:48:29'),
(39, 2, 11, 1, '{{farm_title}} Has Accepted Your Booking Request.', 'more information please contact {{owner_name}}.', '2020-06-04 11:48:30', '2020-06-04 11:48:30'),
(40, 2, 11, 1, '{{farm_title}} Has Accepted Your Booking Request.', 'more information please contact {{owner_name}}.', '2020-06-04 11:48:31', '2020-06-04 11:48:31'),
(41, 2, 11, 1, '{{farm_title}} Has Accepted Your Booking Request.', 'more information please contact {{owner_name}}.', '2020-06-04 11:48:31', '2020-06-04 11:48:31'),
(42, 2, 11, 1, '{{farm_title}} Has Accepted Your Booking Request.', 'more information please contact {{owner_name}}.', '2020-06-04 11:48:32', '2020-06-04 11:48:32'),
(43, 2, 11, 1, '{{farm_title}} Has Accepted Your Booking Request.', 'more information please contact {{owner_name}}.', '2020-06-04 11:48:34', '2020-06-04 11:48:34'),
(44, 2, 11, 1, '{{farm_title}} Has Accepted Your Booking Request.', 'more information please contact {{owner_name}}.', '2020-06-04 11:48:34', '2020-06-04 11:48:34'),
(45, 2, 11, 1, '{{farm_title}} Has Accepted Your Booking Request.', 'more information please contact {{owner_name}}.', '2020-06-04 11:48:35', '2020-06-04 11:48:35'),
(46, 2, 11, 1, '{{farm_title}} Has Accepted Your Booking Request.', 'more information please contact {{owner_name}}.', '2020-06-04 11:48:36', '2020-06-04 11:48:36'),
(47, 2, 11, 1, '{{farm_title}} Has Accepted Your Booking Request.', 'more information please contact {{owner_name}}.', '2020-06-04 11:48:37', '2020-06-04 11:48:37'),
(48, 2, 11, 1, '{{farm_title}} Has Accepted Your Booking Request.', 'more information please contact {{owner_name}}.', '2020-06-04 11:48:38', '2020-06-04 11:48:38'),
(49, 2, 11, 1, '{{farm_title}} Has Accepted Your Booking Request.', 'more information please contact {{owner_name}}.', '2020-06-04 11:48:38', '2020-06-04 11:48:38'),
(50, 2, 11, 1, '{{farm_title}} Has Accepted Your Booking Request.', 'more information please contact {{owner_name}}.', '2020-06-04 11:48:39', '2020-06-04 11:48:39'),
(51, 2, 11, 1, '{{farm_title}} Has Accepted Your Booking Request.', 'more information please contact {{owner_name}}.', '2020-06-04 11:48:40', '2020-06-04 11:48:40'),
(52, 2, 11, 1, '{{farm_title}} Has Accepted Your Booking Request.', 'more information please contact {{owner_name}}.', '2020-06-04 11:48:41', '2020-06-04 11:48:41'),
(53, 2, 11, 1, '{{farm_title}} Has Accepted Your Booking Request.', 'more information please contact {{owner_name}}.', '2020-06-04 11:48:41', '2020-06-04 11:48:41'),
(54, 2, 11, 1, '{{farm_title}} Has Accepted Your Booking Request.', 'more information please contact {{owner_name}}.', '2020-06-04 11:48:42', '2020-06-04 11:48:42'),
(55, 2, 11, 1, '{{farm_title}} Has Accepted Your Booking Request.', 'more information please contact {{owner_name}}.', '2020-06-04 11:48:57', '2020-06-04 11:48:57'),
(56, 2, 11, 1, '{{farm_title}} Has Accepted Your Booking Request.', 'more information please contact {{owner_name}}.', '2020-06-04 11:48:58', '2020-06-04 11:48:58'),
(57, 2, 11, 1, '{{farm_title}} Has Accepted Your Booking Request.', 'more information please contact {{owner_name}}.', '2020-06-04 11:48:58', '2020-06-04 11:48:58'),
(58, 2, 11, 1, '{{farm_title}} Has Accepted Your Booking Request.', 'more information please contact {{owner_name}}.', '2020-06-04 11:48:59', '2020-06-04 11:48:59'),
(59, 2, 11, 1, '{{farm_title}} Has Accepted Your Booking Request.', 'more information please contact {{owner_name}}.', '2020-06-04 11:49:01', '2020-06-04 11:49:01'),
(60, 2, 11, 1, '{{farm_title}} Has Accepted Your Booking Request.', 'more information please contact {{owner_name}}.', '2020-06-04 11:49:02', '2020-06-04 11:49:02'),
(61, 2, 11, 1, '{{farm_title}} Has Accepted Your Booking Request.', 'more information please contact {{owner_name}}.', '2020-06-04 11:49:02', '2020-06-04 11:49:02'),
(62, 2, 11, 1, '{{farm_title}} Has Accepted Your Booking Request.', 'more information please contact {{owner_name}}.', '2020-06-04 11:49:03', '2020-06-04 11:49:03'),
(63, 2, 11, 1, '{{farm_title}} Has Accepted Your Booking Request.', 'more information please contact {{owner_name}}.', '2020-06-04 11:49:04', '2020-06-04 11:49:04'),
(64, 2, 11, 1, '{{farm_title}} Has Accepted Your Booking Request.', 'more information please contact {{owner_name}}.', '2020-06-04 11:49:05', '2020-06-04 11:49:05'),
(65, 2, 11, 1, '{{farm_title}} Has Accepted Your Booking Request.', 'more information please contact {{owner_name}}.', '2020-06-04 11:49:06', '2020-06-04 11:49:06'),
(66, 2, 11, 1, '{{farm_title}} Has Accepted Your Booking Request.', 'more information please contact {{owner_name}}.', '2020-06-04 11:49:06', '2020-06-04 11:49:06'),
(67, 2, 11, 1, '{{farm_title}} Has Accepted Your Booking Request.', 'more information please contact {{owner_name}}.', '2020-06-04 11:49:40', '2020-06-04 11:49:40'),
(68, 2, 11, 1, '{{farm_title}} Has Accepted Your Booking Request.', 'more information please contact {{owner_name}}.', '2020-06-04 11:49:41', '2020-06-04 11:49:41'),
(69, 2, 11, 1, '{{farm_title}} Has Accepted Your Booking Request.', 'more information please contact {{owner_name}}.', '2020-06-04 11:49:41', '2020-06-04 11:49:41'),
(70, 2, 11, 1, '{{farm_title}} Has Accepted Your Booking Request.', 'more information please contact {{owner_name}}.', '2020-06-04 11:49:42', '2020-06-04 11:49:42'),
(71, 2, 11, 1, '{{farm_title}} Has Accepted Your Booking Request.', 'more information please contact {{owner_name}}.', '2020-06-04 11:49:42', '2020-06-04 11:49:42'),
(72, 2, 11, 1, '{{farm_title}} Has Accepted Your Booking Request.', 'more information please contact {{owner_name}}.', '2020-06-04 11:49:43', '2020-06-04 11:49:43'),
(73, 2, 11, 1, '{{farm_title}} Has Accepted Your Booking Request.', 'more information please contact {{owner_name}}.', '2020-06-04 11:49:43', '2020-06-04 11:49:43'),
(74, 2, 11, 1, '{{farm_title}} Has Accepted Your Booking Request.', 'more information please contact {{owner_name}}.', '2020-06-04 11:49:44', '2020-06-04 11:49:44'),
(75, 2, 11, 1, '{{farm_title}} Has Accepted Your Booking Request.', 'more information please contact {{owner_name}}.', '2020-06-04 11:49:44', '2020-06-04 11:49:44'),
(76, 2, 11, 1, '{{farm_title}} Has Accepted Your Booking Request.', 'more information please contact {{owner_name}}.', '2020-06-04 11:49:45', '2020-06-04 11:49:45'),
(77, 2, 11, 1, '{{farm_title}} Has Accepted Your Booking Request.', 'more information please contact {{owner_name}}.', '2020-06-04 11:49:46', '2020-06-04 11:49:46'),
(78, 2, 11, 1, '{{farm_title}} Has Accepted Your Booking Request.', 'more information please contact {{owner_name}}.', '2020-06-04 11:49:46', '2020-06-04 11:49:46'),
(79, 2, 11, 1, '{{farm_title}} Has Accepted Your Booking Request.', 'more information please contact {{owner_name}}.', '2020-06-04 11:49:47', '2020-06-04 11:49:47'),
(80, 2, 11, 1, '{{farm_title}} Has Accepted Your Booking Request.', 'more information please contact {{owner_name}}.', '2020-06-04 11:49:47', '2020-06-04 11:49:47'),
(81, 2, 11, 1, '{{farm_title}} Has Accepted Your Booking Request.', 'more information please contact {{owner_name}}.', '2020-06-04 11:50:14', '2020-06-04 11:50:14'),
(82, 3, 11, 1, '{{farm_title}} Has Accepted Your Booking Request.', 'more information please contact {{owner_name}}.', '2020-06-04 13:09:18', '2020-06-04 13:09:18'),
(83, 2, 11, 1, 'Booking For {{farm_title}}  is cancel', 'Your Booking on {{check_in_date}}    is Cancel please many further information bhk-5ed890 keep this ref no.', '2020-06-04 13:11:07', '2020-06-04 13:11:07');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_access_tokens`
--

INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
('0545b126260925a44fca9d612aa2a1c1d6256fd2bc1a0aae5fce95cd697b608e3fa2cc391c811156', 9, 1, 'user', '[]', 0, '2020-05-22 23:44:43', '2020-05-22 23:44:43', '2021-05-23 05:14:43'),
('05b49b12c59ed340dad204fccc6b7cc7dab88b592649a9935f7de10eb4b1a16aaeb16619b45f7aa2', 11, 1, 'users', '[]', 0, '2020-05-25 04:17:09', '2020-05-25 04:17:09', '2021-05-25 09:47:09'),
('26fc4734b4fd3fe4acbbc4c53bb7e9631d5c7bf1fddb9fe691d13ec09414052c05aaf6d74983125b', 11, 1, 'users', '[]', 0, '2020-05-25 04:19:14', '2020-05-25 04:19:14', '2021-05-25 09:49:14'),
('2c924e1c964ed6f75868c561b251ec25ee07d8da34cbb86850f3f7652abc1e1abafbf422d267bf4d', 11, 1, 'Workeasy', '[]', 0, '2020-05-25 04:10:33', '2020-05-25 04:10:33', '2021-05-25 09:40:33'),
('34e1eddf412ad19d97f4b3596261f8b10ca6fcf2fc9bc2e45f2f4ebbae6d625552c9f653b9c2fd0a', 11, 1, 'Workeasy', '[]', 0, '2020-05-25 04:16:59', '2020-05-25 04:16:59', '2021-05-25 09:46:59'),
('376ea75ff0b99dfa21c92e71c9a213dbcf9ffadc86c9ce4e965b07e31b8c7e639229b5f1a777acc8', 11, 1, 'user', '[]', 0, '2020-05-25 01:47:39', '2020-05-25 01:47:39', '2021-05-25 07:17:39'),
('3d9542a80a739f78967f524a9928a35526da4a69a723f91a78bc1cd9794fba9b2c6b088291a4547b', 11, 1, 'user', '[]', 0, '2020-06-01 10:07:59', '2020-06-01 10:07:59', '2021-06-01 15:37:59'),
('5f08c7ed1b20e8d04062f1256582e66abc6f38d8677eb9dfe99e67ed9cc4fcaac8d17f91b278605a', 11, 1, 'users', '[]', 0, '2020-05-25 04:15:36', '2020-05-25 04:15:36', '2021-05-25 09:45:36'),
('6c8a2b052d72c91b0f2bc1a9d09c72516f593b5789b38209873c55a4054a104ccb01098ad7606920', 11, 1, 'user', '[]', 0, '2020-06-03 06:42:59', '2020-06-03 06:42:59', '2021-06-03 12:12:59'),
('7b6d0c3bf520c9c6af55923fb4be3149c0e46fcae31066e8e469273e838ad79ad269a2e08dfde3fd', 11, 1, 'user', '[]', 0, '2020-05-30 00:43:55', '2020-05-30 00:43:55', '2021-05-30 06:13:55'),
('827b741599c2c056d3aa5a08f8d5f1624a25d2a208cb5ef0c3b699374bf594563546aae1c37372fa', 11, 1, 'user', '[]', 0, '2020-05-25 01:19:48', '2020-05-25 01:19:48', '2021-05-25 06:49:48'),
('86afd36c0991606ce4eb9b83403ee733f8d2ad2d61b5e878b3afbf5f046adc8d722d1fe2b9ef64fa', 12, 1, 'Workeasy', '[]', 0, '2020-05-25 03:51:03', '2020-05-25 03:51:03', '2021-05-25 09:21:03'),
('87e02567e99098e9940d6c4438b8fb34472f948a8e7c7bc4070449b3253cc5395ee7d021d105a11f', 11, 1, 'user', '[]', 0, '2020-05-25 04:17:49', '2020-05-25 04:17:49', '2021-05-25 09:47:49'),
('8877e2f5b69444ebf1fd6483fddc3098fbaa77e9d42baaef8ec51eeee7572813a55e3f94bea2db43', 11, 1, 'user', '[]', 0, '2020-06-04 06:07:06', '2020-06-04 06:07:06', '2021-06-04 11:37:06'),
('88fc99e58aeff25fedb29daccdcec6eadc0e0cc0da6adc57e92eb9b561ffa1c33b06b1288cf652b1', 11, 1, 'Workeasy', '[]', 0, '2020-05-25 04:18:37', '2020-05-25 04:18:37', '2021-05-25 09:48:37'),
('9378d7dbd880f98ba9910475810e97a573749b8945064ef0a6422a37e8e978b5ea166292e93ec239', 11, 1, 'user', '[]', 0, '2020-06-02 09:21:49', '2020-06-02 09:21:49', '2021-06-02 14:51:49'),
('a2e60715c9e9fe70110f4049c4358ae0ff57194d4c3b19bde1bf211fc8340af62933e047268678ad', 10, 1, 'user', '[]', 0, '2020-05-23 03:40:10', '2020-05-23 03:40:10', '2021-05-23 09:10:10'),
('a359f7f4410c205d6cd9bf20110225146b6795967b1fcf16d98df5ebb191592fe328367c716ae1c5', 11, 1, 'user', '[]', 0, '2020-05-25 03:47:16', '2020-05-25 03:47:16', '2021-05-25 09:17:16'),
('b2ea7b4d1a9af5cd5a46a772ff91fd202d2f4def8211bad5277d7d0cfd7d9e13a9993fbc00a41fdf', 11, 1, 'user', '[]', 0, '2020-05-25 03:31:39', '2020-05-25 03:31:39', '2021-05-25 09:01:39'),
('b525bf9f6d2a8c50eb90d45d3e84382c5a2cff87592be84031e178bf244b0094416c2483c5255313', 11, 1, 'user', '[]', 0, '2020-05-25 01:51:08', '2020-05-25 01:51:08', '2021-05-25 07:21:08'),
('bb5167340c45ca374142eec9035f1bada925b1f95719cede944bd9a205abc60001d725a9fa20ae46', 11, 1, 'user', '[]', 0, '2020-06-03 06:25:13', '2020-06-03 06:25:13', '2021-06-03 11:55:13'),
('c5a3abd20547557a5a445b2f9c22384cdce15fce919e406beadd603d0531ef6aed5fc8b06e7448db', 11, 1, 'user', '[]', 0, '2020-06-02 09:46:45', '2020-06-02 09:46:45', '2021-06-02 15:16:45'),
('ca0daec7bb839c4356e0e5fe6a3a10b7595abe3ef47ffe3a1193fefce7cea5e259acac44e1fb0e6a', 11, 1, 'user', '[]', 0, '2020-05-25 00:52:00', '2020-05-25 00:52:00', '2021-05-25 06:22:00'),
('d1d697b86f748e16f94583624f8c1aab71fe690289a036fe7833881eafea8446ea93e03c43094d89', 11, 1, 'user', '[]', 0, '2020-06-02 09:45:06', '2020-06-02 09:45:06', '2021-06-02 15:15:06'),
('ded9e044b601381a2a4d016aba81171bcdf8634d51b1a00b21aeaedd3b70332226719038483044b5', 12, 1, 'user', '[]', 0, '2020-05-25 03:49:26', '2020-05-25 03:49:26', '2021-05-25 09:19:26'),
('e8ece925afb59775e3254256c141a23d3123080a90c49ce0edb81f0edde6152df3d65d88563a8921', 11, 1, 'Workeasy', '[]', 0, '2020-05-25 04:14:29', '2020-05-25 04:14:29', '2021-05-25 09:44:29'),
('fa992d35c3bbff7016f997f0a3796fe5b503cb774f4fe69242c842ee93c36557369b460d2d0b993b', 11, 1, 'Workeasy', '[]', 0, '2020-05-25 04:07:00', '2020-05-25 04:07:00', '2021-05-25 09:37:00');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_clients`
--

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `provider`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(1, NULL, 'beatybella Personal Access Client', 'dekhOdyeIA6QIj1rYOHhYH0tGrfJiqMsNkEMxXKG', NULL, 'http://localhost', 1, 0, 0, '2020-05-22 23:12:05', '2020-05-22 23:12:05'),
(2, NULL, 'beatybella Password Grant Client', 'NEtwr0hheZN2No5pEMlV4X3KfDYm0cV4wVTBwxtv', 'users', 'http://localhost', 0, 1, 0, '2020-05-22 23:12:05', '2020-05-22 23:12:05');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_personal_access_clients`
--

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2020-05-22 23:12:05', '2020-05-22 23:12:05');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `offers`
--

CREATE TABLE `offers` (
  `id` int(11) NOT NULL,
  `branch_id` text,
  `title` varchar(255) NOT NULL,
  `how_expire` int(11) DEFAULT '0' COMMENT '0 = date 1 use',
  `expiry_date` date DEFAULT NULL,
  `max_usage` int(11) DEFAULT '-1',
  `max_use_user` int(11) DEFAULT '-1' COMMENT '-1 = unlimited',
  `min_amount` int(11) DEFAULT '-1' COMMENT '-1 = 0',
  `discount_type` int(11) DEFAULT '0' COMMENT '0 = amiount 1 = per',
  `discount` float DEFAULT NULL,
  `status` int(11) DEFAULT '0' COMMENT '0 = deactive 1 active',
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `title`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'dashboard', NULL, NULL, NULL),
(2, 'role_access', NULL, NULL, NULL),
(3, 'role_create', NULL, NULL, NULL),
(4, 'role_edit', NULL, NULL, NULL),
(5, 'role_show', NULL, NULL, NULL),
(6, 'role_delete', NULL, NULL, NULL),
(7, 'user_access', NULL, NULL, NULL),
(8, 'user_create', NULL, NULL, NULL),
(9, 'user_edit', NULL, NULL, NULL),
(10, 'user_show', NULL, NULL, NULL),
(11, 'user_delete', NULL, NULL, NULL),
(12, 'category_access', NULL, NULL, NULL),
(13, 'category_create', NULL, NULL, NULL),
(14, 'category_edit', NULL, NULL, NULL),
(15, 'category_show', NULL, NULL, NULL),
(16, 'category_delete', NULL, NULL, NULL),
(17, 'subcategory_access', NULL, NULL, NULL),
(18, 'subcategory_create', NULL, NULL, NULL),
(19, 'subcategory_edit', NULL, NULL, NULL),
(20, 'subcategory_show', NULL, NULL, NULL),
(21, 'subcategory_delete', NULL, NULL, NULL),
(38, 'earning_access', NULL, NULL, NULL),
(39, 'earning_show', NULL, NULL, NULL),
(40, 'earning_settle', NULL, NULL, NULL),
(41, 'notification_access', NULL, NULL, NULL),
(42, 'notification_edit', NULL, NULL, NULL),
(43, 'custom_notification_access', NULL, NULL, NULL),
(44, 'report_access', NULL, NULL, NULL),
(45, 'setting_access', NULL, NULL, NULL),
(46, 'privacy_access', NULL, NULL, NULL),
(47, 'privacy_edit', NULL, NULL, NULL),
(48, 'faq_access', NULL, NULL, NULL),
(49, 'faq_create', NULL, NULL, NULL),
(50, 'faq_edit', NULL, NULL, NULL),
(51, 'faq_show', NULL, NULL, NULL),
(52, 'faq_delete', NULL, NULL, NULL),
(53, 'lang_access', NULL, NULL, NULL),
(54, 'lang_create', NULL, NULL, NULL),
(55, 'lang_edit', NULL, NULL, NULL),
(56, 'lang_show', NULL, NULL, NULL),
(57, 'lang_delete', NULL, NULL, NULL),
(58, 'city_access', NULL, NULL, NULL),
(59, 'city_create', NULL, NULL, NULL),
(60, 'city_edit', NULL, NULL, NULL),
(61, 'city_show', NULL, NULL, NULL),
(62, 'city_delete', NULL, NULL, NULL),
(63, 'facilities_access', NULL, NULL, NULL),
(64, 'facilities_create', NULL, NULL, NULL),
(65, 'facilities_edit', NULL, NULL, NULL),
(66, 'facilities_show', NULL, NULL, NULL),
(67, 'facilities_delete', NULL, NULL, NULL),
(68, 'buildingType_access', NULL, NULL, NULL),
(69, 'buildingType_create', NULL, NULL, NULL),
(70, 'buildingType_edit', NULL, NULL, NULL),
(71, 'buildingType_show', NULL, NULL, NULL),
(72, 'buildingType_delete', NULL, NULL, NULL),
(73, 'subscription_access', NULL, NULL, NULL),
(74, 'subscription_create', NULL, NULL, NULL),
(75, 'subscription_edit', NULL, NULL, NULL),
(76, 'subscription_show', NULL, NULL, NULL),
(77, 'subscription_delete', NULL, NULL, NULL),
(78, 'appUser_access', NULL, NULL, NULL),
(79, 'appUser_edit', NULL, NULL, NULL),
(80, 'owner_access', NULL, NULL, NULL),
(81, 'owner_show', NULL, NULL, NULL),
(82, 'owner_edit', NULL, NULL, NULL),
(83, 'role_access1', NULL, NULL, NULL),
(84, 'branch_access', NULL, NULL, NULL),
(85, 'branch_create', NULL, NULL, NULL),
(86, 'branch_edit', NULL, NULL, NULL),
(87, 'branch_show', NULL, NULL, NULL),
(88, 'branch_delete', NULL, NULL, NULL),
(89, 'offer_access', NULL, NULL, NULL),
(90, 'offer_create', NULL, NULL, NULL),
(91, 'offer_edit', NULL, NULL, NULL),
(92, 'offer_show', NULL, NULL, NULL),
(93, 'offer_delete', NULL, NULL, NULL),
(94, 'appuser_access', NULL, NULL, NULL),
(95, 'appuser_edit', NULL, NULL, NULL),
(96, 'booking_access', NULL, NULL, NULL),
(97, 'booking_edit', NULL, NULL, NULL),
(98, 'employee_access', NULL, NULL, NULL),
(99, 'employee_create', NULL, NULL, NULL),
(100, 'employee_edit', NULL, NULL, NULL),
(101, 'employee_delete', NULL, NULL, NULL),
(102, 'employee_show', NULL, NULL, NULL),
(103, 'custom_notification_access', NULL, NULL, NULL),
(104, 'branch_manager_access', NULL, NULL, NULL),
(105, 'branch_booking_access', NULL, NULL, NULL),
(106, 'branch_employee_access', NULL, NULL, NULL),
(107, 'branch_review_access', NULL, NULL, NULL),
(108, 'review_access', NULL, NULL, NULL),
(109, 'booking_employee_access', NULL, NULL, NULL),
(110, 'review_access', NULL, NULL, NULL),
(111, 'review_access', NULL, NULL, NULL),
(112, 'branch_review_access', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `role_id` int(10) UNSIGNED NOT NULL,
  `permission_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`role_id`, `permission_id`) VALUES
(1, 1),
(2, 2),
(2, 4),
(2, 5),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 8),
(1, 10),
(1, 11),
(1, 9),
(1, 38),
(1, 39),
(1, 40),
(3, 7),
(1, 7),
(1, 42),
(1, 43),
(1, 44),
(1, 41),
(4, 7),
(5, 3),
(1, 45),
(1, 46),
(1, 47),
(1, 48),
(1, 49),
(1, 50),
(1, 51),
(1, 52),
(1, 53),
(1, 54),
(1, 55),
(1, 56),
(1, 57),
(1, 58),
(1, 59),
(1, 60),
(1, 61),
(1, 62),
(1, 63),
(1, 64),
(1, 65),
(1, 66),
(1, 67),
(1, 68),
(1, 69),
(1, 70),
(1, 71),
(1, 72),
(1, 73),
(1, 74),
(1, 75),
(1, 76),
(1, 77),
(1, 78),
(1, 79),
(1, 80),
(1, 81),
(1, 82),
(6, 2),
(6, 3),
(6, 4),
(8, 1),
(7, 3),
(7, 5),
(1, 12),
(1, 13),
(1, 14),
(1, 15),
(1, 16),
(1, 17),
(1, 18),
(1, 19),
(1, 20),
(1, 21),
(1, 84),
(1, 85),
(1, 86),
(1, 87),
(1, 88),
(1, 89),
(1, 90),
(1, 91),
(1, 92),
(1, 93),
(1, 83),
(1, 94),
(1, 95),
(1, 96),
(1, 97),
(1, 98),
(1, 99),
(1, 100),
(1, 101),
(1, 102),
(1, 103),
(9, 104),
(9, 105),
(9, 106),
(9, 107),
(9, 88),
(10, 12),
(10, 13),
(10, 14),
(10, 15),
(10, 17),
(10, 18),
(10, 19),
(10, 20),
(10, 89),
(10, 90),
(10, 91),
(10, 92);

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `star` int(11) NOT NULL DEFAULT '0',
  `cmt` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`id`, `user_id`, `branch_id`, `booking_id`, `star`, `cmt`, `created_at`, `updated_at`) VALUES
(1, 11, 1, 1, 5, 'good services', '2020-06-04 11:42:59', '2020-06-04 11:42:59');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `title`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Admin', NULL, NULL, NULL),
(2, 'Wow', '2020-01-23 06:46:34', '2020-01-24 00:00:29', '2020-01-24 00:00:29'),
(3, 'Finase', '2020-01-29 07:34:27', '2020-06-03 11:20:32', '2020-06-03 11:20:32'),
(4, 'Finance Officer', '2020-02-02 04:45:37', '2020-05-19 22:48:58', '2020-05-19 22:48:58'),
(5, 'Super visor 2', '2020-02-10 04:09:56', '2020-06-03 11:20:38', '2020-06-03 11:20:38'),
(6, 'title', '2020-05-19 22:40:44', '2020-06-03 11:20:42', '2020-06-03 11:20:42'),
(7, 'sda', '2020-05-19 22:52:45', '2020-06-03 11:20:49', '2020-06-03 11:20:49'),
(8, 'xcv', '2020-05-19 22:56:25', '2020-06-03 11:20:57', '2020-06-03 11:20:57'),
(9, 'Branch Manager', '2020-05-25 21:28:00', '2020-05-25 21:28:00', NULL),
(10, 'Data Entry Oprator', '2020-06-03 11:22:05', '2020-06-03 11:22:05', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`user_id`, `role_id`) VALUES
(1, 1),
(2, 3),
(2, 6),
(2, 5),
(3, 3),
(3, 5),
(3, 7),
(4, 9),
(5, 8),
(6, 8),
(7, 8),
(11, 9),
(12, 9),
(13, 9),
(14, 10);

-- --------------------------------------------------------

--
-- Table structure for table `static_notification`
--

CREATE TABLE `static_notification` (
  `id` int(11) NOT NULL,
  `for_what` varchar(255) NOT NULL,
  `title` text NOT NULL,
  `sub_title` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `for_who` int(11) NOT NULL DEFAULT '0' COMMENT '0 = user 1 = provide 2= both',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `static_notification`
--

INSERT INTO `static_notification` (`id`, `for_what`, `title`, `sub_title`, `status`, `for_who`, `created_at`, `updated_at`) VALUES
(2, 'Approved Booking (User)', '{{farm_title}} Has Accepted Your Booking Request.', 'more information please contact {{owner_name}}.', 1, 0, '2020-01-31 02:10:03', '2020-05-07 04:46:25'),
(3, 'Cancel Booking (Owner - User)', 'Booking For {{farm_title}}  is cancel', 'Your Booking on {{check_in_date}}    is Cancel please many further information {{booking_id}} keep this ref no.', 1, 0, '2020-01-31 00:00:00', '2020-05-07 04:48:20'),
(6, 'Booking Rejected (User)', 'Dear {{user_name}}, {{farm_title}}  Just Reject Booking Req', 'tatatattatata', 1, 0, '0000-00-00 00:00:00', '2020-05-07 04:50:01');

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `icon` varchar(255) NOT NULL DEFAULT 'default.png',
  `is_best` int(11) NOT NULL DEFAULT '0',
  `price` float NOT NULL DEFAULT '10',
  `description` varchar(255) DEFAULT NULL,
  `for_who` int(11) NOT NULL DEFAULT '0' COMMENT '0 = both 1 = women 2 = male',
  `duration` int(11) NOT NULL DEFAULT '0',
  `preparation_time` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`id`, `name`, `cat_id`, `icon`, `is_best`, `price`, `description`, `for_who`, `duration`, `preparation_time`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Hair Wash Herbal', 1, 'default.png', 1, 30, 'Looking for a quick haircut? This is the one for you.', 0, 20, 10, 1, '2020-06-03 17:22:26', '2020-06-03 17:22:26', NULL),
(2, 'Professional Hair Wash', 1, 'default.png', 0, 25, 'Looking for a quick haircut? This is the one for you.', 1, 30, 10, 1, '2020-06-03 17:23:15', '2020-06-03 17:23:25', NULL),
(3, 'Hair Spa Wash', 1, 'default.png', 0, 35, 'Looking for a quick haircut? This is the one for you.', 0, 45, 5, 1, '2020-06-03 17:23:57', '2020-06-03 17:23:57', NULL),
(4, 'Deep Tissue Massage', 2, 'default.png', 1, 300, 'Slow,firm and specific strokes help to relieve chronic muscle tension and pain,improve mobility and circulation. This massage melts away stress and brings your body back to a relaxed state.', 0, 90, 25, 1, '2020-06-03 17:33:29', '2020-06-03 17:33:29', NULL),
(5, 'Swedish Massage', 2, 'default.png', 0, 600, 'Swedish massage therapy is probably one of the more relaxing and therapeutic massage techniques.', 2, 120, 20, 1, '2020-06-03 17:34:18', '2020-06-03 17:35:32', NULL),
(6, 'Foot Rub', 2, 'default.png', 0, 50, 'Foot reflexology is based on the principle that there are reflex points on the feet that correspond to every organ', 1, 120, 20, 1, '2020-06-03 17:34:53', '2020-06-03 17:35:41', NULL),
(7, 'Brow Shaping', 3, 'default.png', 0, 35, 'We will analyse your bone structure and brow history & determine the best shape.', 1, 15, 5, 1, '2020-06-03 17:38:43', '2020-06-04 12:02:01', NULL),
(8, 'Henna Brow Tinting', 3, 'default.png', 0, 50, 'Henna tinting \'stains\' the skin more effectively & naturally than regular tinting and sets to a powder like matte finish.', 1, 30, 15, 1, '2020-06-03 17:39:27', '2020-06-04 12:02:40', NULL),
(9, 'Custom Tinting', 3, 'default.png', 1, 35, 'Custom Blended for each client to either add thickness, lighten hair, fill in gaps and soften the brows.', 1, 10, 10, 1, '2020-06-03 17:40:20', '2020-06-04 12:03:01', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin Admin', 'admin@admin.com', '2020-05-19 01:07:15', '$2y$10$tqKuEqlmW1p5FjXG8d03N.wLfJL5hEL2T7M8PDEUOIb3hUWuQ.VxK', 'QnKFZMUSJAZ7N9akWgGpg7NdT5zwgbiYEx1TBnRx8Si6T0ifGEHbcNT14PrK', '2020-05-19 01:07:15', '2020-05-19 01:07:15'),
(8, 'Paloma', 'Paloma@Paloma.com', NULL, '$2y$10$d1bUEAalIuCCrfiaGzcyNe0Cvo.qw.wg2hF5taTnjb237lYfroQh6', NULL, '2020-06-03 12:13:08', '2020-06-03 12:13:08'),
(9, 'Zoia', 'zoia@email.com', NULL, '$2y$10$TZPHeJCRGpHfO4ZgfL00Z..Vq8/JDdVRgICFVPI5io38Tlr87SgRO', NULL, '2020-06-03 12:14:28', '2020-06-03 12:14:28'),
(10, 'Josh', 'Josh@email.com', NULL, '$2y$10$YzSQCvyIjvFVEs9XaTuFau4nsjcdN9V3kGfURYJA.3ufzdl411yGS', NULL, '2020-06-03 12:15:51', '2020-06-03 12:15:51'),
(11, 'James Mason', 'JamesMason@mail.com', NULL, '$2y$10$eZM9HHA6WCbAgai6DRv33.r0wBEAf0Iufja4EV5Mrpu6sCCFYS6CG', NULL, '2020-06-03 12:26:43', '2020-06-03 12:26:43'),
(12, 'Carter Wyatt', 'CarterWyatt@email.com', NULL, '$2y$10$m.ruxYyrV0uz70yKOHHggOz3MstvWT17IkuCsYxs8oY6U4HGLZ3Aa', NULL, '2020-06-03 12:27:30', '2020-06-03 12:27:30'),
(13, 'Julian Grayson', 'JulianGrayson@mail.com', NULL, '$2y$10$aeskuNwJXeY7AxDd81LnfusR0bnP5/sT4cMniPFsSO5yjHn3Agmq.', NULL, '2020-06-03 12:27:58', '2020-06-03 12:27:58'),
(14, 'Data Oprator', 'dataoprator@email.com', NULL, '$2y$10$bN6JLnGmA0fdsJsx3XADz.WIrVN2cr5w1Mkvb8.Ns.zuhFd99Hl/.', NULL, '2020-06-03 12:29:35', '2020-06-03 12:29:35');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_setting`
--
ALTER TABLE `admin_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `app_users`
--
ALTER TABLE `app_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booking_child`
--
ALTER TABLE `booking_child`
  ADD PRIMARY KEY (`id`),
  ADD KEY `booking_id` (`booking_id`,`service_id`,`emp_id`),
  ADD KEY `service_id` (`service_id`);

--
-- Indexes for table `booking_master`
--
ALTER TABLE `booking_master`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`,`branch_id`),
  ADD KEY `branch_id` (`branch_id`),
  ADD KEY `offer_id` (`offer_id`);

--
-- Indexes for table `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `currency`
--
ALTER TABLE `currency`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_detail`
--
ALTER TABLE `employee_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `emp_id` (`emp_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification_tbl`
--
ALTER TABLE `notification_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_auth_codes_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offers`
--
ALTER TABLE `offers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD KEY `role_id_fk_476162` (`role_id`),
  ADD KEY `permission_id_fk_476162` (`permission_id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`,`booking_id`),
  ADD KEY `booking_id` (`booking_id`),
  ADD KEY `branch_id` (`branch_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD KEY `user_id_fk_476171` (`user_id`),
  ADD KEY `role_id_fk_476171` (`role_id`);

--
-- Indexes for table `static_notification`
--
ALTER TABLE `static_notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cat_id` (`cat_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_setting`
--
ALTER TABLE `admin_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `app_users`
--
ALTER TABLE `app_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `booking_child`
--
ALTER TABLE `booking_child`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `booking_master`
--
ALTER TABLE `booking_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `branch`
--
ALTER TABLE `branch`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `currency`
--
ALTER TABLE `currency`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- AUTO_INCREMENT for table `employee_detail`
--
ALTER TABLE `employee_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `notification_tbl`
--
ALTER TABLE `notification_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `offers`
--
ALTER TABLE `offers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `static_notification`
--
ALTER TABLE `static_notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking_child`
--
ALTER TABLE `booking_child`
  ADD CONSTRAINT `booking_child_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `booking_master` (`id`),
  ADD CONSTRAINT `booking_child_ibfk_2` FOREIGN KEY (`service_id`) REFERENCES `sub_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `booking_master`
--
ALTER TABLE `booking_master`
  ADD CONSTRAINT `booking_master_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `app_users` (`id`),
  ADD CONSTRAINT `booking_master_ibfk_2` FOREIGN KEY (`branch_id`) REFERENCES `branch` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `booking_master_ibfk_3` FOREIGN KEY (`offer_id`) REFERENCES `offers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `employee_detail`
--
ALTER TABLE `employee_detail`
  ADD CONSTRAINT `employee_detail_ibfk_1` FOREIGN KEY (`emp_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `app_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `review_ibfk_2` FOREIGN KEY (`booking_id`) REFERENCES `booking_master` (`id`),
  ADD CONSTRAINT `review_ibfk_3` FOREIGN KEY (`branch_id`) REFERENCES `branch` (`id`);

--
-- Constraints for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD CONSTRAINT `sub_categories_ibfk_1` FOREIGN KEY (`cat_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
