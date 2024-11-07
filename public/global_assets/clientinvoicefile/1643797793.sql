-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 02, 2022 at 09:57 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel-crm`
--

-- --------------------------------------------------------

--
-- Table structure for table `add_field_team`
--

CREATE TABLE `add_field_team` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `team_leader` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `project_manager_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quality_analyst_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `add_field_team`
--

INSERT INTO `add_field_team` (`id`, `team_leader`, `project_manager_name`, `quality_analyst_name`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'raga', 'nandha', 'fizel', 1, '2022-01-22 00:04:46', '2022-01-22 00:04:46'),
(2, 'nohal', 'ziya', 'muba', 1, '2022-01-22 00:16:36', '2022-01-22 00:16:36');

-- --------------------------------------------------------

--
-- Table structure for table `bid-rfq`
--

CREATE TABLE `bid-rfq` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `rfq_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vendor_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `industry` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `follow_up_date` date DEFAULT NULL,
  `currency` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `setup_cost` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `recruitment` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `incentives` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `moderation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transcript` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `others` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sample_size` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_cost` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `persons` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comments` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` enum('won','lost','next') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'next',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bid-rfq`
--

INSERT INTO `bid-rfq` (`id`, `rfq_no`, `client_id`, `vendor_id`, `user_id`, `date`, `industry`, `follow_up_date`, `currency`, `setup_cost`, `recruitment`, `incentives`, `moderation`, `transcript`, `others`, `sample_size`, `total_cost`, `country`, `persons`, `comments`, `type`, `created_at`, `updated_at`) VALUES
(1, 'RFQ1-2022', 'raga', 'eswar', '1', '2022-01-06', 'Paper', '2022-01-20', '', '10,10', '10,10', '10,10', '10,10', '10,10', '10,10', '10,10', '60,60', 'Afghanistan', '', NULL, 'next', '2022-01-06 00:15:24', '2022-01-31 04:20:43'),
(2, 'RFQ2-2022', 'raga,raga', 'eswar,eswar', '1', '2022-01-06', 'Sugar', '2022-01-25', '', '50,100,20,20', '10,10,20,20', '10,10,20,20', '10,10,20,20', '10,10,20,20', '10,10,20,20', '10,10,20,20', '100,150,120,120', 'Australia,Bangladesh', '', NULL, 'next', '2022-01-06 00:19:39', '2022-01-21 02:22:24'),
(5, 'RFQ3-2022', 'raga', 'eswar', '1', '2022-01-10', 'Sugar', '2022-01-05', '', '10,10', '10,10', '10,10', '10,10', '10,10', '10,10', '10,10', '60,60', 'Azerbaijan', '', NULL, 'won', '2022-01-10 06:41:03', '2022-01-10 06:41:03'),
(6, 'RFQ6-2022', 'raga', 'eswar', '1', '2022-01-10', 'Paper', '2022-01-06', 'USD', '10,10', '40,40', '10,10', '10,10', '10,10', '10,10', '10,10', '90,90', 'Albania', '', NULL, 'lost', '2022-01-10 06:45:06', '2022-01-21 06:45:50'),
(7, 'RFQ7-2022', 'raga', 'eswar', '1', '2022-01-17', 'Sugar', '2022-01-18', 'Sugar', '10,10', '10,10', '10,10', '10,10', '10,10', '10,10', '10,10', '60,60', 'Bahrain', '', NULL, 'won', '2022-01-17 04:47:13', '2022-01-17 04:47:13'),
(8, 'RFQ8-2022', 'raga', 'eswar', '1', '2022-01-17', 'Sugar', '2022-01-18', 'USD', '10,10', '10,10', '10,10', '10,10', '10,10', '10,10', '10,10', '60,60', 'Afghanistan', '', NULL, 'won', '2022-01-17 05:11:48', '2022-01-20 00:06:29'),
(9, 'RFQ9-2022', 'nihal', 'eswar', '1', '2022-01-17', 'Sugar', '2022-01-18', 'USD', '10,10', '10,10', '10,10', '10,10', '10,10', '10,10', '10,10', '60,60', 'Bahrain', '', NULL, 'lost', '2022-01-17 05:18:46', '2022-01-19 08:51:35'),
(10, 'RFQ10-2022', 'nihal', 'eswar', '1', '2022-01-17', 'Sugar', '2022-01-26', 'USD', '10,10', '10,10', '10,10', '10,10', '10,10', '10,10', '10,10', '60,60', 'Afghanistan', '', NULL, 'next', '2022-01-17 06:51:58', '2022-01-21 02:25:37'),
(11, 'RFQ11-2022', 'dfdg', 'wefwffw', '1', '2022-02-01', 'Paper', '2022-02-01', 'Euro', '1,3', '1,3', '3,3', '3,13', '3,3', '2,3', '15,13', '13,28', 'Armenia', '', NULL, 'next', '2022-01-31 23:56:50', '2022-01-31 23:57:22');

-- --------------------------------------------------------

--
-- Table structure for table `bid_industry`
--

CREATE TABLE `bid_industry` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vendor_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `setup_cost` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `recruitment` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `incentives` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `moderation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transcript` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `others` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sample_size` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_cost` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rfq_id` bigint(20) UNSIGNED NOT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `client_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_manager` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_phoneno` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_whatsapp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`id`, `client_name`, `client_country`, `client_manager`, `client_email`, `client_phoneno`, `user_id`, `client_whatsapp`, `created_at`, `updated_at`) VALUES
(1, 'raga', 'Albania', 'yogesh', 'raga6007@gmail.com', '987456321', '1', '987456321', '2022-01-06 00:06:01', '2022-01-06 00:06:01'),
(2, 'nihal', 'china', 'test', 'deen34@gmail.com', '84231231325', '', '789456133', '2022-01-11 00:10:15', '2022-01-11 00:10:15'),
(3, 'nihal', 'china', 'test', 'deen34@gmail.com', '84231231325', '', '789456133', '2022-01-11 00:10:26', '2022-01-11 00:10:26'),
(4, 'nihal', 'china', 'test', 'deen34@gmail.com', '84231231325', '', '789456133', '2022-01-11 00:36:38', '2022-01-11 00:36:38'),
(5, 'nihal', 'china', 'test', 'deen34@gmail.com', '84231231325', '', '789456133', '2022-01-11 00:36:58', '2022-01-11 00:36:58'),
(6, 'yogesh', 'Albania', 'yogesh', 'raga6007@gmail.com', '465465464561', '1', '46456565999999', '2022-01-11 04:13:57', '2022-01-11 04:13:57'),
(7, 'samy', 'Andorra', 'nathan', 'samy22@gmail.com', '8969846496589', '1', '74984999999999', '2022-01-17 04:28:45', '2022-01-17 04:28:45'),
(8, 'dfdg', 'Anguilla', 'fgdf', 'vinay@abc', '565465654', '1', '5646456456456', '2022-01-31 23:55:36', '2022-01-31 23:55:36');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`id`, `code`, `name`, `created_at`, `updated_at`) VALUES
(1, 'AF', 'Afghanistan', NULL, NULL),
(2, 'AL', 'Albania', NULL, NULL),
(3, 'DZ', 'Algeria', NULL, NULL),
(4, 'AS', 'American Samoa', NULL, NULL),
(5, 'AD', 'Andorra', NULL, NULL),
(6, 'AO', 'Angola', NULL, NULL),
(7, 'AI', 'Anguilla', NULL, NULL),
(8, 'AQ', 'Antarctica', NULL, NULL),
(9, 'AG', 'Antigua And Barbuda', NULL, NULL),
(10, 'AR', 'Argentina', NULL, NULL),
(11, 'AM', 'Armenia', NULL, NULL),
(12, 'AW', 'Aruba', NULL, NULL),
(13, 'AU', 'Australia', NULL, NULL),
(14, 'AT', 'Austria', NULL, NULL),
(15, 'AZ', 'Azerbaijan', NULL, NULL),
(16, 'BS', 'Bahamas The', NULL, NULL),
(17, 'BH', 'Bahrain', NULL, NULL),
(18, 'BD', 'Bangladesh', NULL, NULL),
(19, 'BB', 'Barbados', NULL, NULL),
(20, 'BY', 'Belarus', NULL, NULL),
(21, 'BE', 'Belgium', NULL, NULL),
(22, 'BZ', 'Belize', NULL, NULL),
(23, 'BJ', 'Benin', NULL, NULL),
(24, 'BM', 'Bermuda', NULL, NULL),
(25, 'BT', 'Bhutan', NULL, NULL),
(26, 'BO', 'Bolivia', NULL, NULL),
(27, 'BA', 'Bosnia and Herzegovina', NULL, NULL),
(28, 'BW', 'Botswana', NULL, NULL),
(29, 'BV', 'Bouvet Island', NULL, NULL),
(30, 'BR', 'Brazil', NULL, NULL),
(31, 'IO', 'British Indian Ocean Territory', NULL, NULL),
(32, 'BN', 'Brunei', NULL, NULL),
(33, 'BG', 'Bulgaria', NULL, NULL),
(34, 'BF', 'Burkina Faso', NULL, NULL),
(35, 'BI', 'Burundi', NULL, NULL),
(36, 'KH', 'Cambodia', NULL, NULL),
(37, 'CM', 'Cameroon', NULL, NULL),
(38, 'CA', 'Canada', NULL, NULL),
(39, 'CV', 'Cape Verde', NULL, NULL),
(40, 'KY', 'Cayman Islands', NULL, NULL),
(41, 'CF', 'Central African Republic', NULL, NULL),
(42, 'TD', 'Chad', NULL, NULL),
(43, 'CL', 'Chile', NULL, NULL),
(44, 'CN', 'China', NULL, NULL),
(45, 'CX', 'Christmas Island', NULL, NULL),
(46, 'CC', 'Cocos (Keeling) Islands', NULL, NULL),
(47, 'CO', 'Colombia', NULL, NULL),
(48, 'KM', 'Comoros', NULL, NULL),
(49, 'CG', 'Congo', NULL, NULL),
(50, 'CD', 'Congo The Democratic Republic Of The', NULL, NULL),
(51, 'CK', 'Cook Islands', NULL, NULL),
(52, 'CR', 'Costa Rica', NULL, NULL),
(53, 'CI', 'Cote DIvoire (Ivory Coast)', NULL, NULL),
(54, 'HR', 'Croatia (Hrvatska)', NULL, NULL),
(55, 'CU', 'Cuba', NULL, NULL),
(56, 'CY', 'Cyprus', NULL, NULL),
(57, 'CZ', 'Czech Republic', NULL, NULL),
(58, 'DK', 'Denmark', NULL, NULL),
(59, 'DJ', 'Djibouti', NULL, NULL),
(60, 'DM', 'Dominica', NULL, NULL),
(61, 'DO', 'Dominican Republic', NULL, NULL),
(62, 'TP', 'East Timor', NULL, NULL),
(63, 'EC', 'Ecuador', NULL, NULL),
(64, 'EG', 'Egypt', NULL, NULL),
(65, 'SV', 'El Salvador', NULL, NULL),
(66, 'GQ', 'Equatorial Guinea', NULL, NULL),
(67, 'ER', 'Eritrea', NULL, NULL),
(68, 'EE', 'Estonia', NULL, NULL),
(69, 'ET', 'Ethiopia', NULL, NULL),
(70, 'XA', 'External Territories of Australia', NULL, NULL),
(71, 'FK', 'Falkland Islands', NULL, NULL),
(72, 'FO', 'Faroe Islands', NULL, NULL),
(73, 'FJ', 'Fiji Islands', NULL, NULL),
(74, 'FI', 'Finland', NULL, NULL),
(75, 'FR', 'France', NULL, NULL),
(76, 'GF', 'French Guiana', NULL, NULL),
(77, 'PF', 'French Polynesia', NULL, NULL),
(78, 'TF', 'French Southern Territories', NULL, NULL),
(79, 'GA', 'Gabon', NULL, NULL),
(80, 'GM', 'Gambia The', NULL, NULL),
(81, 'GE', 'Georgia', NULL, NULL),
(82, 'DE', 'Germany', NULL, NULL),
(83, 'GH', 'Ghana', NULL, NULL),
(84, 'GI', 'Gibraltar', NULL, NULL),
(85, 'GR', 'Greece', NULL, NULL),
(86, 'GL', 'Greenland', NULL, NULL),
(87, 'GD', 'Grenada', NULL, NULL),
(88, 'GP', 'Guadeloupe', NULL, NULL),
(89, 'GU', 'Guam', NULL, NULL),
(90, 'GT', 'Guatemala', NULL, NULL),
(91, 'XU', 'Guernsey and Alderney', NULL, NULL),
(92, 'GN', 'Guinea', NULL, NULL),
(93, 'GW', 'Guinea-Bissau', NULL, NULL),
(94, 'GY', 'Guyana', NULL, NULL),
(95, 'HT', 'Haiti', NULL, NULL),
(96, 'HM', 'Heard and McDonald Islands', NULL, NULL),
(97, 'HN', 'Honduras', NULL, NULL),
(98, 'HK', 'Hong Kong S.A.R.', NULL, NULL),
(99, 'HU', 'Hungary', NULL, NULL),
(100, 'IS', 'Iceland', NULL, NULL),
(101, 'IN', 'India', NULL, NULL),
(102, 'ID', 'Indonesia', NULL, NULL),
(103, 'IR', 'Iran', NULL, NULL),
(104, 'IQ', 'Iraq', NULL, NULL),
(105, 'IE', 'Ireland', NULL, NULL),
(106, 'IL', 'Israel', NULL, NULL),
(107, 'IT', 'Italy', NULL, NULL),
(108, 'JM', 'Jamaica', NULL, NULL),
(109, 'JP', 'Japan', NULL, NULL),
(110, 'XJ', 'Jersey', NULL, NULL),
(111, 'JO', 'Jordan', NULL, NULL),
(112, 'KZ', 'Kazakhstan', NULL, NULL),
(113, 'KE', 'Kenya', NULL, NULL),
(114, 'KI', 'Kiribati', NULL, NULL),
(115, 'KP', 'Korea North', NULL, NULL),
(116, 'KR', 'Korea South', NULL, NULL),
(117, 'KW', 'Kuwait', NULL, NULL),
(118, 'KG', 'Kyrgyzstan', NULL, NULL),
(119, 'LA', 'Laos', NULL, NULL),
(120, 'LV', 'Latvia', NULL, NULL),
(121, 'LB', 'Lebanon', NULL, NULL),
(122, 'LS', 'Lesotho', NULL, NULL),
(123, 'LR', 'Liberia', NULL, NULL),
(124, 'LY', 'Libya', NULL, NULL),
(125, 'LI', 'Liechtenstein', NULL, NULL),
(126, 'LT', 'Lithuania', NULL, NULL),
(127, 'LU', 'Luxembourg', NULL, NULL),
(128, 'MO', 'Macau S.A.R.', NULL, NULL),
(129, 'MK', 'Macedonia', NULL, NULL),
(130, 'MG', 'Madagascar', NULL, NULL),
(131, 'MW', 'Malawi', NULL, NULL),
(132, 'MY', 'Malaysia', NULL, NULL),
(133, 'MV', 'Maldives', NULL, NULL),
(134, 'ML', 'Mali', NULL, NULL),
(135, 'MT', 'Malta', NULL, NULL),
(136, 'XM', 'Man (Isle of)', NULL, NULL),
(137, 'MH', 'Marshall Islands', NULL, NULL),
(138, 'MQ', 'Martinique', NULL, NULL),
(139, 'MR', 'Mauritania', NULL, NULL),
(140, 'MU', 'Mauritius', NULL, NULL),
(141, 'YT', 'Mayotte', NULL, NULL),
(142, 'MX', 'Mexico', NULL, NULL),
(143, 'FM', 'Micronesia', NULL, NULL),
(144, 'MD', 'Moldova', NULL, NULL),
(145, 'MC', 'Monaco', NULL, NULL),
(146, 'MN', 'Mongolia', NULL, NULL),
(147, 'MS', 'Montserrat', NULL, NULL),
(148, 'MA', 'Morocco', NULL, NULL),
(149, 'MZ', 'Mozambique', NULL, NULL),
(150, 'MM', 'Myanmar', NULL, NULL),
(151, 'NA', 'Namibia', NULL, NULL),
(152, 'NR', 'Nauru', NULL, NULL),
(153, 'NP', 'Nepal', NULL, NULL),
(154, 'AN', 'Netherlands Antilles', NULL, NULL),
(155, 'NL', 'Netherlands The', NULL, NULL),
(156, 'NC', 'New Caledonia', NULL, NULL),
(157, 'NZ', 'New Zealand', NULL, NULL),
(158, 'NI', 'Nicaragua', NULL, NULL),
(159, 'NE', 'Niger', NULL, NULL),
(160, 'NG', 'Nigeria', NULL, NULL),
(161, 'NU', 'Niue', NULL, NULL),
(162, 'NF', 'Norfolk Island', NULL, NULL),
(163, 'MP', 'Northern Mariana Islands', NULL, NULL),
(164, 'NO', 'Norway', NULL, NULL),
(165, 'OM', 'Oman', NULL, NULL),
(166, 'PK', 'Pakistan', NULL, NULL),
(167, 'PW', 'Palau', NULL, NULL),
(168, 'PS', 'Palestinian Territory Occupied', NULL, NULL),
(169, 'PA', 'Panama', NULL, NULL),
(170, 'PG', 'Papua new Guinea', NULL, NULL),
(171, 'PY', 'Paraguay', NULL, NULL),
(172, 'PE', 'Peru', NULL, NULL),
(173, 'PH', 'Philippines', NULL, NULL),
(174, 'PN', 'Pitcairn Island', NULL, NULL),
(175, 'PL', 'Poland', NULL, NULL),
(176, 'PT', 'Portugal', NULL, NULL),
(177, 'PR', 'Puerto Rico', NULL, NULL),
(178, 'QA', 'Qatar', NULL, NULL),
(179, 'RE', 'Reunion', NULL, NULL),
(180, 'RO', 'Romania', NULL, NULL),
(181, 'RU', 'Russia', NULL, NULL),
(182, 'RW', 'Rwanda', NULL, NULL),
(183, 'SH', 'Saint Helena', NULL, NULL),
(184, 'KN', 'Saint Kitts And Nevis', NULL, NULL),
(185, 'LC', 'Saint Lucia', NULL, NULL),
(186, 'PM', 'Saint Pierre and Miquelon', NULL, NULL),
(187, 'VC', 'Saint Vincent And The Grenadines', NULL, NULL),
(188, 'WS', 'Samoa', NULL, NULL),
(189, 'SM', 'San Marino', NULL, NULL),
(190, 'ST', 'Sao Tome and Principe', NULL, NULL),
(191, 'SA', 'Saudi Arabia', NULL, NULL),
(192, 'SN', 'Senegal', NULL, NULL),
(193, 'RS', 'Serbia', NULL, NULL),
(194, 'SC', 'Seychelles', NULL, NULL),
(195, 'SL', 'Sierra Leone', NULL, NULL),
(196, 'SG', 'Singapore', NULL, NULL),
(197, 'SK', 'Slovakia', NULL, NULL),
(198, 'SI', 'Slovenia', NULL, NULL),
(199, 'XG', 'Smaller Territories of the UK', NULL, NULL),
(200, 'SB', 'Solomon Islands', NULL, NULL),
(201, 'SO', 'Somalia', NULL, NULL),
(202, 'ZA', 'South Africa', NULL, NULL),
(203, 'GS', 'South Georgia', NULL, NULL),
(204, 'SS', 'South Sudan', NULL, NULL),
(205, 'ES', 'Spain', NULL, NULL),
(206, 'LK', 'Sri Lanka', NULL, NULL),
(207, 'SD', 'Sudan', NULL, NULL),
(208, 'SR', 'Suriname', NULL, NULL),
(209, 'SJ', 'Svalbard And Jan Mayen Islands', NULL, NULL),
(210, 'SZ', 'Swaziland', NULL, NULL),
(211, 'SE', 'Sweden', NULL, NULL),
(212, 'CH', 'Switzerland', NULL, NULL),
(213, 'SY', 'Syria', NULL, NULL),
(214, 'TW', 'Taiwan', NULL, NULL),
(215, 'TJ', 'Tajikistan', NULL, NULL),
(216, 'TZ', 'Tanzania', NULL, NULL),
(217, 'TH', 'Thailand', NULL, NULL),
(218, 'TG', 'Togo', NULL, NULL),
(219, 'TK', 'Tokelau', NULL, NULL),
(220, 'TO', 'Tonga', NULL, NULL),
(221, 'TT', 'Trinidad And Tobago', NULL, NULL),
(222, 'TN', 'Tunisia', NULL, NULL),
(223, 'TR', 'Turkey', NULL, NULL),
(224, 'TM', 'Turkmenistan', NULL, NULL),
(225, 'TC', 'Turks And Caicos Islands', NULL, NULL),
(226, 'TV', 'Tuvalu', NULL, NULL),
(227, 'UG', 'Uganda', NULL, NULL),
(228, 'UA', 'Ukraine', NULL, NULL),
(229, 'AE', 'United Arab Emirates', NULL, NULL),
(230, 'GB', 'United Kingdom', NULL, NULL),
(231, 'US', 'United States', NULL, NULL),
(232, 'UM', 'United States Minor Outlying Islands', NULL, NULL),
(233, 'UY', 'Uruguay', NULL, NULL),
(234, 'UZ', 'Uzbekistan', NULL, NULL),
(235, 'VU', 'Vanuatu', NULL, NULL),
(236, 'VA', 'Vatican City State (Holy See)', NULL, NULL),
(237, 'VE', 'Venezuela', NULL, NULL),
(238, 'VN', 'Vietnam', NULL, NULL),
(239, 'VG', 'Virgin Islands (British)', NULL, NULL),
(240, 'VI', 'Virgin Islands (US)', NULL, NULL),
(241, 'WF', 'Wallis And Futuna Islands', NULL, NULL),
(242, 'EH', 'Western Sahara', NULL, NULL),
(243, 'YE', 'Yemen', NULL, NULL),
(244, 'YU', 'Yugoslavia', NULL, NULL),
(245, 'ZM', 'Zambia', NULL, NULL),
(246, 'ZW', 'Zimbabwe', NULL, NULL);

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
-- Table structure for table `field_new`
--

CREATE TABLE `field_new` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `project_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `purchase_order_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `respondent_incentives` int(11) NOT NULL,
  `project_manager_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quality_analyst_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `project_deliverable` int(11) NOT NULL,
  `questionnarie` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `other_document` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `survey_link` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sample_target` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sample_achieved` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `manager`
--

CREATE TABLE `manager` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_no` int(11) NOT NULL,
  `whatsapp_no` int(11) NOT NULL,
  `photo` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `other_document` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `experiance` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `others` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qualification` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2021_10_19_101622_laratrust_setup_tables', 1),
(6, '2021_10_19_115535_create_client_table', 1),
(7, '2021_10_19_115828_create_vendor_table', 1),
(8, '2021_10_19_115943_create_countries_table', 1),
(9, '2021_10_19_120106_create_bid-rfq_table', 1),
(10, '2021_10_19_120508_create_won_project_table', 1),
(11, '2021_10_19_122005_create_country_table', 1),
(12, '2021_10_20_073950_create_projects_comments_table', 1),
(13, '2021_10_21_043336_create_operation_new_table', 1),
(14, '2021_10_21_052746_create_manager_table', 1),
(15, '2021_11_05_073624_create_bid_industry_table', 1),
(16, '2021_12_06_053851_create_field_new_table', 1),
(17, '2021_12_07_111833_create_supplier_table', 1),
(18, '2022_01_19_093409_create_add_field_team', 2),
(19, '2022_01_24_090608_create_project_completed_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `operation_new`
--

CREATE TABLE `operation_new` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `project_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `purchase_order_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `respondent_incentives` int(11) NOT NULL,
  `team_leader` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `project_manager_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quality_analyst_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `project_deliverable` int(11) NOT NULL,
  `questionnarie` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `other_document` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `survey_link` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sample_target` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sample_achieved` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comments` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('stop','completed','hold') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'hold',
  `rfq` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `operation_new`
--

INSERT INTO `operation_new` (`id`, `project_no`, `purchase_order_no`, `respondent_incentives`, `team_leader`, `project_manager_name`, `quality_analyst_name`, `project_deliverable`, `questionnarie`, `other_document`, `survey_link`, `country_name`, `sample_target`, `sample_achieved`, `comments`, `user_id`, `status`, `rfq`, `client_id`, `created_at`, `updated_at`) VALUES
(11, 'PNO121-2022', 'PO111-2022', 52, 'raga', 'nandha', 'fizel', 20, 'global_assets/questionnaries/1643621128.csv', 'global_assets/other_document/1643621128.csv', 'global_assets/survey_link/1643621128.csv', 'Belgium', '101,101,101,101,101', '101,101,101,101,101', NULL, 1, 'completed', 'RFQ10-2022-nihal', 'nihal', '2022-01-31 03:55:28', '2022-01-31 03:56:24'),
(12, 'PNO122-2022', 'PO112-2022', 52, 'nohal', 'nandha', 'fizel', 20, 'global_assets/questionnaries/1643621575.csv', 'global_assets/other_document/1643621575.csv', 'global_assets/survey_link/1643621575.csv', 'American Samoa', '500,500,500,500,500', '500,500,500,500,500', NULL, 1, 'hold', 'RFQ2-2022-raga', 'raga', '2022-01-31 04:02:55', '2022-01-31 04:04:30'),
(13, 'PNO123-2022', 'PO113-2022', 52, 'raga', 'nandha', 'muba', 10, 'global_assets/questionnaries/1643622786.csv', 'global_assets/other_document/1643622786.csv', 'global_assets/survey_link/1643622786.csv', 'Barbados', '10,10,1,010,10', '10,10,01,10,1', NULL, 1, 'hold', 'RFQ1-2022_raga', 'raga', '2022-01-31 04:23:06', '2022-01-31 04:23:44');

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
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permission_user`
--

CREATE TABLE `permission_user` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `user_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `projects_comments`
--

CREATE TABLE `projects_comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `comments` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `rfq_no` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `project_completed`
--

CREATE TABLE `project_completed` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `clientadvance` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `clientbalance` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vendoradvance` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vendorbalance` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `respondentfile` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `clientinvoicefile` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `vendorinvoicefile` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_confirmation` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `vendor_confirmation` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `project_completed`
--

INSERT INTO `project_completed` (`id`, `clientadvance`, `clientbalance`, `vendoradvance`, `vendorbalance`, `respondentfile`, `clientinvoicefile`, `vendorinvoicefile`, `client_confirmation`, `vendor_confirmation`, `user_id`, `created_at`, `updated_at`) VALUES
(2, 'Yes', 'Yes', 'Yes', 'Yes', 'global_assets/respondentfile/1643026979.csv', 'global_assets/clientinvoicefile/1643026979.csv', 'global_assets/vendorinvoicefile/1643026979.csv', 'global_assets/client_confirmation/1643026979.csv', 'global_assets/vendor_confirmation/1643026979.csv', 1, '2022-01-24 06:52:59', '2022-01-24 06:52:59'),
(3, 'Yes', 'Yes', 'Yes', 'Yes', 'global_assets/respondentfile/1643027866.csv', 'global_assets/clientinvoicefile/1643027866.csv', 'global_assets/vendorinvoicefile/1643027866.csv', 'global_assets/client_confirmation/1643027866.csv', 'global_assets/vendor_confirmation/1643027866.csv', 1, '2022-01-24 07:07:46', '2022-01-24 07:07:46'),
(4, 'Yes', 'Yes', 'Yes', 'Yes', 'global_assets/respondentfile/1643097121.csv', 'global_assets/clientinvoicefile/1643097121.csv', 'global_assets/vendorinvoicefile/1643097121.csv', 'global_assets/client_confirmation/1643097121.csv', 'global_assets/vendor_confirmation/1643097121.csv', 1, '2022-01-25 02:22:01', '2022-01-25 02:22:01'),
(5, 'Yes', 'Yes', 'Yes', 'Yes', 'global_assets/respondentfile/1643097574.csv', 'global_assets/clientinvoicefile/1643097574.csv', 'global_assets/vendorinvoicefile/1643097574.csv', 'global_assets/client_confirmation/1643097574.csv', 'global_assets/vendor_confirmation/1643097574.csv', 1, '2022-01-25 02:29:34', '2022-01-25 02:29:34'),
(6, 'Yes', 'Yes', 'Yes', 'Yes', 'global_assets/respondentfile/1643101056.csv', 'global_assets/clientinvoicefile/1643101056.csv', 'global_assets/vendorinvoicefile/1643101056.csv', 'global_assets/client_confirmation/1643101056.csv', 'global_assets/vendor_confirmation/1643101056.csv', 1, '2022-01-25 03:27:36', '2022-01-25 03:27:36'),
(7, 'Yes', 'Yes', 'Yes', 'Yes', 'global_assets/respondentfile/1643101697.csv', 'global_assets/clientinvoicefile/1643101697.csv', 'global_assets/vendorinvoicefile/1643101697.csv', 'global_assets/client_confirmation/1643101697.csv', 'global_assets/vendor_confirmation/1643101697.csv', 1, '2022-01-25 03:38:17', '2022-01-25 03:38:17'),
(8, 'Yes', 'Yes', 'Yes', 'Yes', 'global_assets/respondentfile/1643102134.csv', 'global_assets/clientinvoicefile/1643102134.csv', 'global_assets/vendorinvoicefile/1643102134.csv', 'global_assets/client_confirmation/1643102134.csv', 'global_assets/vendor_confirmation/1643102134.csv', 1, '2022-01-25 03:45:34', '2022-01-25 03:45:34'),
(9, 'Yes', 'Yes', 'Yes', 'Yes', 'global_assets/respondentfile/1643102228.csv', 'global_assets/clientinvoicefile/1643102228.csv', 'global_assets/vendorinvoicefile/1643102228.csv', 'global_assets/client_confirmation/1643102228.csv', 'global_assets/vendor_confirmation/1643102228.csv', 1, '2022-01-25 03:47:08', '2022-01-25 03:47:08'),
(10, 'Yes', 'Yes', 'Yes', 'Yes', 'global_assets/respondentfile/1643102423.csv', 'global_assets/clientinvoicefile/1643102423.csv', 'global_assets/vendorinvoicefile/1643102423.csv', 'global_assets/client_confirmation/1643102423.csv', 'global_assets/vendor_confirmation/1643102423.csv', 1, '2022-01-25 03:50:23', '2022-01-25 03:50:23'),
(11, 'Yes', 'Yes', 'Yes', 'Yes', 'global_assets/respondentfile/1643102701.csv', 'global_assets/clientinvoicefile/1643102701.csv', 'global_assets/vendorinvoicefile/1643102701.csv', 'global_assets/client_confirmation/1643102701.csv', 'global_assets/vendor_confirmation/1643102701.csv', 1, '2022-01-25 03:55:01', '2022-01-25 03:55:01'),
(12, 'Yes', 'Yes', 'Yes', 'Yes', 'global_assets/respondentfile/1643103485.csv', 'global_assets/clientinvoicefile/1643103485.csv', 'global_assets/vendorinvoicefile/1643103485.csv', 'global_assets/client_confirmation/1643103485.txt', 'global_assets/vendor_confirmation/1643103485.csv', 1, '2022-01-25 04:08:05', '2022-01-25 04:08:05'),
(13, 'Yes', 'Yes', 'Yes', 'Yes', 'global_assets/respondentfile/1643259247.csv', 'global_assets/clientinvoicefile/1643259247.csv', 'global_assets/vendorinvoicefile/1643259247.csv', 'global_assets/client_confirmation/1643259247.csv', 'global_assets/vendor_confirmation/1643259247.csv', 1, '2022-01-26 23:24:07', '2022-01-26 23:24:07'),
(14, 'Yes', 'Yes', 'Yes', 'Yes', 'global_assets/respondentfile/1643259296.csv', 'global_assets/clientinvoicefile/1643259296.csv', 'global_assets/vendorinvoicefile/1643259296.csv', 'global_assets/client_confirmation/1643259296.csv', 'global_assets/vendor_confirmation/1643259296.csv', 1, '2022-01-26 23:24:56', '2022-01-26 23:24:56'),
(15, 'Yes', 'Yes', 'Yes', 'Yes', 'global_assets/respondentfile/1643621179.csv', 'global_assets/clientinvoicefile/1643621179.csv', 'global_assets/vendorinvoicefile/1643621179.csv', 'global_assets/client_confirmation/1643621179.csv', 'global_assets/vendor_confirmation/1643621179.csv', 1, '2022-01-31 03:56:19', '2022-01-31 03:56:19');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `user_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `supplier_company` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `supplier_manager` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `supplier_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `supplier_phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `supplier_whatsapp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `supplier_country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `other_detail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_type` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `user_type`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'rajaganesh', 'rajaganesh6007@gmail.com', NULL, '$2y$10$jhT/GGF.PtuNqtc4W1YeM./plduSnEmdKlhZ2jgWAJ7he.krnQcfy', 'admin', NULL, '2022-01-06 00:02:51', '2022-01-06 00:02:51'),
(2, 'yogesh', 'yogesh007@gmail.com', NULL, '$2y$10$RaFHTFdxyVzX5hGCNcBXhOmcIsJMrnSFMkR6sIZjvx9CqyN4PVQWS', 'admin', NULL, '2022-01-17 05:08:33', '2022-01-17 05:08:33'),
(3, 'arif', 'arif99@gmail.com', NULL, '$2y$10$ilzvs8wz5AUIj6Y0uR76C.lncBWl0v21g9Q3193GA923yDN395SDW', 'operation', NULL, '2022-01-27 23:02:02', '2022-01-27 23:02:02');

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE `vendor` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `vendor_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vendor_country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vendor_manager` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vendor_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vendor_phoneno` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vendor_whatsapp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vendor`
--

INSERT INTO `vendor` (`id`, `vendor_name`, `vendor_country`, `vendor_manager`, `vendor_email`, `vendor_phoneno`, `vendor_whatsapp`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'eswar', 'Albania', 'loga', 'ragav22@gmail.com', '963258741', '963258741', '1', '2022-01-06 00:06:41', '2022-01-06 00:06:41'),
(2, 'wefwffw', 'Armenia', 'ddfff', 'ragav22@gmail.com', '54435353', '34535353454', '1', '2022-01-31 23:55:57', '2022-01-31 23:55:57');

-- --------------------------------------------------------

--
-- Table structure for table `won_project`
--

CREATE TABLE `won_project` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `rfq_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_id` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `project_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `project_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `project_execution` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `currency` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `project_start_date` date NOT NULL,
  `project_end_date` date NOT NULL,
  `date` date NOT NULL,
  `client_total` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `vendor_total` int(11) NOT NULL,
  `client_advance` int(11) NOT NULL,
  `client_balance` int(11) NOT NULL,
  `vendor_advance` int(11) NOT NULL,
  `vendor_balance` int(11) NOT NULL,
  `client_contract` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `vendor_contract` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_margin` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `won_project`
--

INSERT INTO `won_project` (`id`, `rfq_no`, `client_id`, `project_name`, `project_type`, `project_execution`, `currency`, `project_start_date`, `project_end_date`, `date`, `client_total`, `user_id`, `vendor_total`, `client_advance`, `client_balance`, `vendor_advance`, `vendor_balance`, `client_contract`, `vendor_contract`, `total_margin`, `created_at`, `updated_at`) VALUES
(12, 'RFQ10-2022-nihal', 'nihal', 'deen', 'Qualitative', 'Insource', '₹', '2022-01-27', '2022-01-07', '0000-00-00', 10000, 1, 15000, 5000, 5000, 5000, 10000, 'global_assets/client_contract/1643372041.csv', 'global_assets/vendor_contract/1643372041.csv', 10000, '2022-01-28 06:44:01', '2022-01-28 06:44:01'),
(13, 'RFQ2-2022-raga', 'raga', 'don', 'Qualitative', 'Insource', '₹', '2022-01-26', '2022-01-05', '0000-00-00', 100, 1, 100, 5000, 5000, 5000, 10000, 'global_assets/client_contract/1643621493.csv', 'global_assets/vendor_contract/1643621493.csv', 10000, '2022-01-31 04:01:33', '2022-01-31 04:01:33'),
(14, 'RFQ1-2022_raga', 'raga', 'don', 'Qualitative', 'Insource', '₹', '2022-01-24', '2021-12-28', '0000-00-00', 100, 1, 100, 5000, 5000, 5000, 10000, 'global_assets/client_contract/1643622707.csv', 'global_assets/vendor_contract/1643622707.txt', 10000, '2022-01-31 04:21:47', '2022-01-31 04:21:47'),
(15, 'RFQ11-2022_dfdg', 'dfdg', 'project1', 'Qualitative', 'Insource', '$', '2022-02-09', '2022-02-09', '0000-00-00', 100, 1, 100, 100, 100, 5000, 10000, 'global_assets/client_contract/1643693311.csv', 'global_assets/vendor_contract/1643693311.csv', 500, '2022-01-31 23:58:31', '2022-01-31 23:58:31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `add_field_team`
--
ALTER TABLE `add_field_team`
  ADD PRIMARY KEY (`id`),
  ADD KEY `add_field_team_user_id_foreign` (`user_id`);

--
-- Indexes for table `bid-rfq`
--
ALTER TABLE `bid-rfq`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bid_industry`
--
ALTER TABLE `bid_industry`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bid_industry_rfq_id_foreign` (`rfq_id`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `field_new`
--
ALTER TABLE `field_new`
  ADD PRIMARY KEY (`id`),
  ADD KEY `field_new_user_id_foreign` (`user_id`);

--
-- Indexes for table `manager`
--
ALTER TABLE `manager`
  ADD PRIMARY KEY (`id`),
  ADD KEY `manager_user_id_foreign` (`user_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `operation_new`
--
ALTER TABLE `operation_new`
  ADD PRIMARY KEY (`id`),
  ADD KEY `operation_new_user_id_foreign` (`user_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

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
-- Indexes for table `permission_user`
--
ALTER TABLE `permission_user`
  ADD PRIMARY KEY (`user_id`,`permission_id`,`user_type`),
  ADD KEY `permission_user_permission_id_foreign` (`permission_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `projects_comments`
--
ALTER TABLE `projects_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `projects_comments_rfq_no_foreign` (`rfq_no`),
  ADD KEY `projects_comments_user_id_foreign` (`user_id`);

--
-- Indexes for table `project_completed`
--
ALTER TABLE `project_completed`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_completed_user_id_foreign` (`user_id`);

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
  ADD PRIMARY KEY (`user_id`,`role_id`,`user_type`),
  ADD KEY `role_user_role_id_foreign` (`role_id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `won_project`
--
ALTER TABLE `won_project`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `add_field_team`
--
ALTER TABLE `add_field_team`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `bid-rfq`
--
ALTER TABLE `bid-rfq`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `bid_industry`
--
ALTER TABLE `bid_industry`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=247;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `field_new`
--
ALTER TABLE `field_new`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `manager`
--
ALTER TABLE `manager`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `operation_new`
--
ALTER TABLE `operation_new`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `projects_comments`
--
ALTER TABLE `projects_comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `project_completed`
--
ALTER TABLE `project_completed`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `vendor`
--
ALTER TABLE `vendor`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `won_project`
--
ALTER TABLE `won_project`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `add_field_team`
--
ALTER TABLE `add_field_team`
  ADD CONSTRAINT `add_field_team_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `bid_industry`
--
ALTER TABLE `bid_industry`
  ADD CONSTRAINT `bid_industry_rfq_id_foreign` FOREIGN KEY (`rfq_id`) REFERENCES `bid-rfq` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `field_new`
--
ALTER TABLE `field_new`
  ADD CONSTRAINT `field_new_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `manager`
--
ALTER TABLE `manager`
  ADD CONSTRAINT `manager_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `operation_new`
--
ALTER TABLE `operation_new`
  ADD CONSTRAINT `operation_new_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `permission_user`
--
ALTER TABLE `permission_user`
  ADD CONSTRAINT `permission_user_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `projects_comments`
--
ALTER TABLE `projects_comments`
  ADD CONSTRAINT `projects_comments_rfq_no_foreign` FOREIGN KEY (`rfq_no`) REFERENCES `bid-rfq` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `projects_comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `project_completed`
--
ALTER TABLE `project_completed`
  ADD CONSTRAINT `project_completed_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
