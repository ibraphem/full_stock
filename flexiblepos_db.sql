-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.41-MariaDB-cll-lve - MariaDB Server
-- Server OS:                    Linux
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table flexlwhc_fpos_prod.accounts
CREATE TABLE IF NOT EXISTS `accounts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `company` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `branch_name` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `account_no` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pin` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `balance` decimal(12,2) NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `accounts_user_id_foreign` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table flexlwhc_fpos_prod.accounts: 0 rows
/*!40000 ALTER TABLE `accounts` DISABLE KEYS */;
/*!40000 ALTER TABLE `accounts` ENABLE KEYS */;

-- Dumping structure for table flexlwhc_fpos_prod.companies
CREATE TABLE IF NOT EXISTS `companies` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `language` varchar(5) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'en',
  `logo_path` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `fevicon_path` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `starting_balance` decimal(12,2) NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `companies_user_id_foreign` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table flexlwhc_fpos_prod.companies: 0 rows
/*!40000 ALTER TABLE `companies` DISABLE KEYS */;
/*!40000 ALTER TABLE `companies` ENABLE KEYS */;

-- Dumping structure for table flexlwhc_fpos_prod.company_users
CREATE TABLE IF NOT EXISTS `company_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `company_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_type` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table flexlwhc_fpos_prod.company_users: 0 rows
/*!40000 ALTER TABLE `company_users` DISABLE KEYS */;
/*!40000 ALTER TABLE `company_users` ENABLE KEYS */;

-- Dumping structure for table flexlwhc_fpos_prod.currencies
CREATE TABLE IF NOT EXISTS `currencies` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `digital_code` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `precision` tinyint(4) NOT NULL,
  `subunit` int(11) NOT NULL,
  `symbol_first` tinyint(1) NOT NULL,
  `decimal_mark` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `thousands_separator` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `symbol` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=165 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table flexlwhc_fpos_prod.currencies: 164 rows
/*!40000 ALTER TABLE `currencies` DISABLE KEYS */;
INSERT INTO `currencies` (`id`, `name`, `code`, `digital_code`, `precision`, `subunit`, `symbol_first`, `decimal_mark`, `thousands_separator`, `symbol`, `created_at`, `updated_at`) VALUES
	(1, 'UAE Dirham', 'AED', '784', 2, 100, 1, '.', ',', 'د.إ', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(2, 'Afghani', 'AFN', '971', 2, 100, 0, '.', ',', '؋', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(3, 'Lek', 'ALL', '8', 2, 100, 0, '.', ',', 'L', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(4, 'Armenian Dram', 'AMD', '51', 2, 100, 0, '.', ',', 'դր.', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(5, 'Netherlands Antillean Guilder', 'ANG', '532', 2, 100, 1, ',', '.', 'ƒ', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(6, 'Kwanza', 'AOA', '973', 2, 100, 0, '.', ',', 'Kz', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(7, 'Argentine Peso', 'ARS', '32', 2, 100, 1, ',', '.', '$', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(8, 'Australian Dollar', 'AUD', '36', 2, 100, 1, '.', ' ', '$', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(9, 'Aruban Florin', 'AWG', '533', 2, 100, 0, '.', ',', 'ƒ', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(10, 'Azerbaijanian Manat', 'AZN', '944', 2, 100, 1, '.', ',', '₼', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(11, 'Convertible Mark', 'BAM', '977', 2, 100, 1, '.', ',', 'КМ', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(12, 'Barbados Dollar', 'BBD', '52', 2, 100, 0, '.', ',', '$', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(13, 'Taka', 'BDT', '50', 2, 100, 1, '.', ',', '৳', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(14, 'Bulgarian Lev', 'BGN', '975', 2, 100, 0, '.', ',', 'лв', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(15, 'Bahraini Dinar', 'BHD', '48', 3, 1000, 1, '.', ',', 'ب.د', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(16, 'Burundi Franc', 'BIF', '108', 0, 1, 0, '.', ',', 'Fr', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(17, 'Bermudian Dollar', 'BMD', '60', 2, 100, 1, '.', ',', '$', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(18, 'Brunei Dollar', 'BND', '96', 2, 100, 1, '.', ',', '$', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(19, 'Boliviano', 'BOB', '68', 2, 100, 1, '.', ',', 'Bs.', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(20, 'Mvdol', 'BOV', '984', 2, 100, 1, '.', ',', 'Bs.', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(21, 'Brazilian Real', 'BRL', '986', 2, 100, 1, ',', '.', 'R$', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(22, 'Bahamian Dollar', 'BSD', '44', 2, 100, 1, '.', ',', '$', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(23, 'Ngultrum', 'BTN', '64', 2, 100, 0, '.', ',', 'Nu.', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(24, 'Pula', 'BWP', '72', 2, 100, 1, '.', ',', 'P', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(25, 'Belarussian Ruble', 'BYN', '974', 0, 1, 0, ',', ' ', 'Br', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(26, 'Belize Dollar', 'BZD', '84', 2, 100, 1, '.', ',', '$', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(27, 'Canadian Dollar', 'CAD', '124', 2, 100, 1, '.', ',', '$', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(28, 'Congolese Franc', 'CDF', '976', 2, 100, 0, '.', ',', 'Fr', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(29, 'Swiss Franc', 'CHF', '756', 2, 100, 1, '.', ',', 'CHF', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(30, 'Unidades de fomento', 'CLF', '990', 0, 1, 1, ',', '.', 'UF', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(31, 'Chilean Peso', 'CLP', '152', 0, 1, 1, ',', '.', '$', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(32, 'Yuan Renminbi', 'CNY', '156', 2, 100, 1, '.', ',', '¥', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(33, 'Colombian Peso', 'COP', '170', 2, 100, 1, ',', '.', '$', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(34, 'Costa Rican Colon', 'CRC', '188', 2, 100, 1, ',', '.', '₡', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(35, 'Peso Convertible', 'CUC', '931', 2, 100, 0, '.', ',', '$', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(36, 'Cuban Peso', 'CUP', '192', 2, 100, 1, '.', ',', '$', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(37, 'Cape Verde Escudo', 'CVE', '132', 2, 100, 0, '.', ',', '$', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(38, 'Czech Koruna', 'CZK', '203', 2, 100, 0, ',', '.', 'Kč', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(39, 'Djibouti Franc', 'DJF', '262', 0, 1, 0, '.', ',', 'Fdj', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(40, 'Danish Krone', 'DKK', '208', 2, 100, 0, ',', '.', 'kr', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(41, 'Dominican Peso', 'DOP', '214', 2, 100, 1, '.', ',', '$', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(42, 'Algerian Dinar', 'DZD', '12', 2, 100, 0, '.', ',', 'د.ج', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(43, 'Egyptian Pound', 'EGP', '818', 2, 100, 1, '.', ',', 'ج.م', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(44, 'Nakfa', 'ERN', '232', 2, 100, 0, '.', ',', 'Nfk', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(45, 'Ethiopian Birr', 'ETB', '230', 2, 100, 0, '.', ',', 'Br', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(46, 'Euro', 'EUR', '978', 2, 100, 1, ',', '.', '€', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(47, 'Fiji Dollar', 'FJD', '242', 2, 100, 0, '.', ',', '$', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(48, 'Falkland Islands Pound', 'FKP', '238', 2, 100, 0, '.', ',', '£', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(49, 'Pound Sterling', 'GBP', '826', 2, 100, 1, '.', ',', '£', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(50, 'Lari', 'GEL', '981', 2, 100, 0, '.', ',', 'ლ', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(51, 'Ghana Cedi', 'GHS', '936', 2, 100, 1, '.', ',', '₵', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(52, 'Gibraltar Pound', 'GIP', '292', 2, 100, 1, '.', ',', '£', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(53, 'Dalasi', 'GMD', '270', 2, 100, 0, '.', ',', 'D', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(54, 'Guinea Franc', 'GNF', '324', 0, 1, 0, '.', ',', 'Fr', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(55, 'Quetzal', 'GTQ', '320', 2, 100, 1, '.', ',', 'Q', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(56, 'Guyana Dollar', 'GYD', '328', 2, 100, 0, '.', ',', '$', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(57, 'Hong Kong Dollar', 'HKD', '344', 2, 100, 1, '.', ',', '$', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(58, 'Lempira', 'HNL', '340', 2, 100, 1, '.', ',', 'L', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(59, 'Croatian Kuna', 'HRK', '191', 2, 100, 1, ',', '.', 'kn', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(60, 'Gourde', 'HTG', '332', 2, 100, 0, '.', ',', 'G', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(61, 'Forint', 'HUF', '348', 2, 100, 0, ',', '.', 'Ft', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(62, 'Rupiah', 'IDR', '360', 2, 100, 1, ',', '.', 'Rp', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(63, 'New Israeli Sheqel', 'ILS', '376', 2, 100, 1, '.', ',', '₪', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(64, 'Indian Rupee', 'INR', '356', 2, 100, 1, '.', ',', '₹', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(65, 'Iraqi Dinar', 'IQD', '368', 3, 1000, 0, '.', ',', 'ع.د', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(66, 'Iranian Rial', 'IRR', '364', 2, 100, 1, '.', ',', '﷼', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(67, 'Iceland Krona', 'ISK', '352', 0, 1, 1, ',', '.', 'kr', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(68, 'Jamaican Dollar', 'JMD', '388', 2, 100, 1, '.', ',', '$', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(69, 'Jordanian Dinar', 'JOD', '400', 3, 100, 1, '.', ',', 'د.ا', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(70, 'Yen', 'JPY', '392', 0, 1, 1, '.', ',', '¥', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(71, 'Kenyan Shilling', 'KES', '404', 2, 100, 1, '.', ',', 'KSh', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(72, 'Som', 'KGS', '417', 2, 100, 0, '.', ',', 'som', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(73, 'Riel', 'KHR', '116', 2, 100, 0, '.', ',', '៛', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(74, 'Comoro Franc', 'KMF', '174', 0, 1, 0, '.', ',', 'Fr', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(75, 'North Korean Won', 'KPW', '408', 2, 100, 0, '.', ',', '₩', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(76, 'Won', 'KRW', '410', 0, 1, 1, '.', ',', '₩', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(77, 'Kuwaiti Dinar', 'KWD', '414', 3, 1000, 1, '.', ',', 'د.ك', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(78, 'Cayman Islands Dollar', 'KYD', '136', 2, 100, 1, '.', ',', '$', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(79, 'Tenge', 'KZT', '398', 2, 100, 0, '.', ',', '〒', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(80, 'Kip', 'LAK', '418', 2, 100, 0, '.', ',', '₭', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(81, 'Lebanese Pound', 'LBP', '422', 2, 100, 1, '.', ',', 'ل.ل', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(82, 'Sri Lanka Rupee', 'LKR', '144', 2, 100, 0, '.', ',', '₨', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(83, 'Liberian Dollar', 'LRD', '430', 2, 100, 0, '.', ',', '$', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(84, 'Loti', 'LSL', '426', 2, 100, 0, '.', ',', 'L', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(85, 'Lithuanian Litas', 'LTL', '440', 2, 100, 0, '.', ',', 'Lt', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(86, 'Latvian Lats', 'LVL', '428', 2, 100, 1, '.', ',', 'Ls', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(87, 'Libyan Dinar', 'LYD', '434', 3, 1000, 0, '.', ',', 'ل.د', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(88, 'Moroccan Dirham', 'MAD', '504', 2, 100, 0, '.', ',', 'د.م.', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(89, 'Moldovan Leu', 'MDL', '498', 2, 100, 0, '.', ',', 'L', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(90, 'Malagasy Ariary', 'MGA', '969', 2, 5, 1, '.', ',', 'Ar', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(91, 'Denar', 'MKD', '807', 2, 100, 0, '.', ',', 'ден', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(92, 'Kyat', 'MMK', '104', 2, 100, 0, '.', ',', 'K', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(93, 'Tugrik', 'MNT', '496', 2, 100, 0, '.', ',', '₮', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(94, 'Pataca', 'MOP', '446', 2, 100, 0, '.', ',', 'P', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(95, 'Ouguiya', 'MRO', '478', 2, 5, 0, '.', ',', 'UM', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(96, 'Mauritius Rupee', 'MUR', '480', 2, 100, 1, '.', ',', '₨', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(97, 'Rufiyaa', 'MVR', '462', 2, 100, 0, '.', ',', 'MVR', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(98, 'Kwacha', 'MWK', '454', 2, 100, 0, '.', ',', 'MK', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(99, 'Mexican Peso', 'MXN', '484', 2, 100, 1, '.', ',', '$', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(100, 'Malaysian Ringgit', 'MYR', '458', 2, 100, 1, '.', ',', 'RM', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(101, 'Mozambique Metical', 'MZN', '943', 2, 100, 1, ',', '.', 'MTn', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(102, 'Namibia Dollar', 'NAD', '516', 2, 100, 0, '.', ',', '$', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(103, 'Naira', 'NGN', '566', 2, 100, 1, '.', ',', '₦', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(104, 'Cordoba Oro', 'NIO', '558', 2, 100, 0, '.', ',', 'C$', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(105, 'Norwegian Krone', 'NOK', '578', 2, 100, 0, ',', '.', 'kr', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(106, 'Nepalese Rupee', 'NPR', '524', 2, 100, 1, '.', ',', '₨', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(107, 'New Zealand Dollar', 'NZD', '554', 2, 100, 1, '.', ',', '$', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(108, 'Rial Omani', 'OMR', '512', 3, 1000, 1, '.', ',', 'ر.ع.', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(109, 'Balboa', 'PAB', '590', 2, 100, 0, '.', ',', 'B/.', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(110, 'Nuevo Sol', 'PEN', '604', 2, 100, 1, '.', ',', 'S/.', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(111, 'Kina', 'PGK', '598', 2, 100, 0, '.', ',', 'K', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(112, 'Philippine Peso', 'PHP', '608', 2, 100, 1, '.', ',', '₱', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(113, 'Pakistan Rupee', 'PKR', '586', 2, 100, 1, '.', ',', '₨', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(114, 'Zloty', 'PLN', '985', 2, 100, 0, ',', ' ', 'zł', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(115, 'Guarani', 'PYG', '600', 0, 1, 1, '.', ',', '₲', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(116, 'Qatari Rial', 'QAR', '634', 2, 100, 0, '.', ',', 'ر.ق', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(117, 'New Romanian Leu', 'RON', '946', 2, 100, 1, ',', '.', 'Lei', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(118, 'Serbian Dinar', 'RSD', '941', 2, 100, 1, '.', ',', 'РСД', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(119, 'Russian Ruble', 'RUB', '643', 2, 100, 0, ',', '.', '₽', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(120, 'Rwanda Franc', 'RWF', '646', 0, 1, 0, '.', ',', 'FRw', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(121, 'Saudi Riyal', 'SAR', '682', 2, 100, 1, '.', ',', 'ر.س', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(122, 'Solomon Islands Dollar', 'SBD', '90', 2, 100, 0, '.', ',', '$', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(123, 'Seychelles Rupee', 'SCR', '690', 2, 100, 0, '.', ',', '₨', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(124, 'Sudanese Pound', 'SDG', '938', 2, 100, 1, '.', ',', '£', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(125, 'Swedish Krona', 'SEK', '752', 2, 100, 0, ',', ' ', 'kr', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(126, 'Singapore Dollar', 'SGD', '702', 2, 100, 1, '.', ',', '$', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(127, 'Saint Helena Pound', 'SHP', '654', 2, 100, 0, '.', ',', '£', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(128, 'Leone', 'SLL', '694', 2, 100, 0, '.', ',', 'Le', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(129, 'Somali Shilling', 'SOS', '706', 2, 100, 0, '.', ',', 'Sh', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(130, 'Surinam Dollar', 'SRD', '968', 2, 100, 0, '.', ',', '$', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(131, 'South Sudanese Pound', 'SSP', '728', 2, 100, 0, '.', ',', '£', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(132, 'Dobra', 'STD', '678', 2, 100, 0, '.', ',', 'Db', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(133, 'El Salvador Colon', 'SVC', '222', 2, 100, 1, '.', ',', '₡', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(134, 'Syrian Pound', 'SYP', '760', 2, 100, 0, '.', ',', '£S', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(135, 'Lilangeni', 'SZL', '748', 2, 100, 1, '.', ',', 'E', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(136, 'Baht', 'THB', '764', 2, 100, 1, '.', ',', '฿', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(137, 'Somoni', 'TJS', '972', 2, 100, 0, '.', ',', 'ЅМ', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(138, 'Turkmenistan New Manat', 'TMT', '934', 2, 100, 0, '.', ',', 'T', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(139, 'Tunisian Dinar', 'TND', '788', 3, 1000, 0, '.', ',', 'د.ت', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(140, 'Pa’anga', 'TOP', '776', 2, 100, 1, '.', ',', 'T$', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(141, 'Turkish Lira', 'TRY', '949', 2, 100, 1, ',', '.', '₺', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(142, 'Trinidad and Tobago Dollar', 'TTD', '780', 2, 100, 0, '.', ',', '$', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(143, 'New Taiwan Dollar', 'TWD', '901', 2, 100, 1, '.', ',', '$', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(144, 'Tanzanian Shilling', 'TZS', '834', 2, 100, 1, '.', ',', 'Sh', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(145, 'Hryvnia', 'UAH', '980', 2, 100, 0, '.', ',', '₴', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(146, 'Uganda Shilling', 'UGX', '800', 0, 1, 0, '.', ',', 'USh', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(147, 'US Dollar', 'USD', '840', 2, 100, 1, '.', ',', '$', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(148, 'Peso Uruguayo', 'UYU', '858', 2, 100, 1, ',', '.', '$', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(149, 'Uzbekistan Sum', 'UZS', '860', 2, 100, 0, '.', ',', NULL, '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(150, 'Bolivar', 'VEF', '937', 2, 100, 1, ',', '.', 'Bs F', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(151, 'Dong', 'VND', '704', 0, 1, 1, ',', '.', '₫', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(152, 'Vatu', 'VUV', '548', 0, 1, 1, '.', ',', 'Vt', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(153, 'Tala', 'WST', '882', 2, 100, 0, '.', ',', 'T', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(154, 'CFA Franc BEAC', 'XAF', '950', 0, 1, 0, '.', ',', 'Fr', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(155, 'Silver', 'XAG', '961', 0, 1, 0, '.', ',', 'oz t', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(156, 'Gold', 'XAU', '959', 0, 1, 0, '.', ',', 'oz t', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(157, 'East Caribbean Dollar', 'XCD', '951', 2, 100, 1, '.', ',', '$', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(158, 'SDR (Special Drawing Right)', 'XDR', '960', 0, 1, 0, '.', ',', 'SDR', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(159, 'CFA Franc BCEAO', 'XOF', '952', 0, 1, 0, '.', ',', 'Fr', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(160, 'CFP Franc', 'XPF', '953', 0, 1, 0, '.', ',', 'Fr', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(161, 'Yemeni Rial', 'YER', '886', 2, 100, 0, '.', ',', '﷼', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(162, 'Rand', 'ZAR', '710', 2, 100, 1, '.', ',', 'R', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(163, 'Zambian Kwacha', 'ZMW', '967', 2, 100, 0, '.', ',', 'ZK', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(164, 'Zimbabwe Dollar', 'ZWL', '932', 2, 100, 1, '.', ',', '$', '2019-10-01 19:51:03', '2019-10-01 19:51:03');
/*!40000 ALTER TABLE `currencies` ENABLE KEYS */;

-- Dumping structure for table flexlwhc_fpos_prod.customers
CREATE TABLE IF NOT EXISTS `customers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone_number` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `avatar` varchar(191) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'no-foto.png',
  `address` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `zip` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `company_name` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `account` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `prev_balance` decimal(8,2) DEFAULT NULL,
  `payment` decimal(8,2) DEFAULT NULL,
  `type` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table flexlwhc_fpos_prod.customers: 1 rows
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
INSERT INTO `customers` (`id`, `name`, `email`, `phone_number`, `avatar`, `address`, `city`, `state`, `zip`, `company_name`, `account`, `prev_balance`, `payment`, `type`, `created_at`, `updated_at`) VALUES
	(1, 'Walking Customer', NULL, NULL, 'no-foto.png', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2019-10-01 19:51:06', '2019-10-01 19:51:06');
/*!40000 ALTER TABLE `customers` ENABLE KEYS */;

-- Dumping structure for table flexlwhc_fpos_prod.customer_payments
CREATE TABLE IF NOT EXISTS `customer_payments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `payment` decimal(12,2) NOT NULL,
  `payment_type` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `comments` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `customer_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `customer_payments_customer_id_foreign` (`customer_id`),
  KEY `customer_payments_user_id_foreign` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table flexlwhc_fpos_prod.customer_payments: 0 rows
/*!40000 ALTER TABLE `customer_payments` DISABLE KEYS */;
/*!40000 ALTER TABLE `customer_payments` ENABLE KEYS */;

-- Dumping structure for table flexlwhc_fpos_prod.daily_reports
CREATE TABLE IF NOT EXISTS `daily_reports` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `prev_balance` decimal(12,2) NOT NULL,
  `total_sales` decimal(12,2) NOT NULL,
  `total_payment` decimal(12,2) NOT NULL,
  `total_dues` decimal(12,2) NOT NULL,
  `sale_profit` decimal(12,2) NOT NULL,
  `total_income` decimal(12,2) NOT NULL,
  `total_expense` decimal(12,2) NOT NULL,
  `total_receivings` decimal(12,2) NOT NULL,
  `total_receivings_payment` decimal(12,2) NOT NULL,
  `total_receivings_dues` decimal(12,2) NOT NULL,
  `total_supplier_payment` decimal(12,2) NOT NULL,
  `total_costing` decimal(12,2) NOT NULL,
  `net_balance` decimal(12,2) NOT NULL,
  `total_profit` decimal(12,2) NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `daily_reports_user_id_foreign` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table flexlwhc_fpos_prod.daily_reports: 0 rows
/*!40000 ALTER TABLE `daily_reports` DISABLE KEYS */;
/*!40000 ALTER TABLE `daily_reports` ENABLE KEYS */;

-- Dumping structure for table flexlwhc_fpos_prod.expenses
CREATE TABLE IF NOT EXISTS `expenses` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `qty` int(11) NOT NULL,
  `unit_price` decimal(12,2) NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `payment` decimal(12,2) NOT NULL,
  `dues` decimal(12,2) NOT NULL,
  `total` decimal(12,2) NOT NULL,
  `payment_type` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `expense_category_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `expenses_user_id_foreign` (`user_id`),
  KEY `expenses_expense_category_id_foreign` (`expense_category_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table flexlwhc_fpos_prod.expenses: 0 rows
/*!40000 ALTER TABLE `expenses` DISABLE KEYS */;
/*!40000 ALTER TABLE `expenses` ENABLE KEYS */;

-- Dumping structure for table flexlwhc_fpos_prod.expense_categories
CREATE TABLE IF NOT EXISTS `expense_categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table flexlwhc_fpos_prod.expense_categories: 0 rows
/*!40000 ALTER TABLE `expense_categories` DISABLE KEYS */;
/*!40000 ALTER TABLE `expense_categories` ENABLE KEYS */;

-- Dumping structure for table flexlwhc_fpos_prod.flexible_pos_settings
CREATE TABLE IF NOT EXISTS `flexible_pos_settings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `language` varchar(5) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'en',
  `logo_path` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `fevicon_path` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `company_name` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `owner_name` text COLLATE utf8_unicode_ci,
  `company_address` text COLLATE utf8_unicode_ci NOT NULL,
  `starting_balance` decimal(12,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `currency_code` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table flexlwhc_fpos_prod.flexible_pos_settings: 0 rows
/*!40000 ALTER TABLE `flexible_pos_settings` DISABLE KEYS */;
/*!40000 ALTER TABLE `flexible_pos_settings` ENABLE KEYS */;

-- Dumping structure for table flexlwhc_fpos_prod.inventories
CREATE TABLE IF NOT EXISTS `inventories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `item_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `in_out_qty` int(11) NOT NULL,
  `remarks` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `inventories_item_id_foreign` (`item_id`),
  KEY `inventories_user_id_foreign` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table flexlwhc_fpos_prod.inventories: 0 rows
/*!40000 ALTER TABLE `inventories` DISABLE KEYS */;
/*!40000 ALTER TABLE `inventories` ENABLE KEYS */;

-- Dumping structure for table flexlwhc_fpos_prod.items
CREATE TABLE IF NOT EXISTS `items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `upc_ean_isbn` varchar(90) COLLATE utf8_unicode_ci DEFAULT NULL,
  `item_name` varchar(90) COLLATE utf8_unicode_ci NOT NULL,
  `size` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `avatar` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'no-foto.png',
  `cost_price` decimal(9,2) NOT NULL,
  `selling_price` decimal(9,2) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT '1',
  `type` int(11) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `stock_limit` tinyint(4) NOT NULL DEFAULT '0',
  `expire_date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table flexlwhc_fpos_prod.items: 0 rows
/*!40000 ALTER TABLE `items` DISABLE KEYS */;
/*!40000 ALTER TABLE `items` ENABLE KEYS */;

-- Dumping structure for table flexlwhc_fpos_prod.item_kit_items
CREATE TABLE IF NOT EXISTS `item_kit_items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `item_kit_id` int(10) unsigned NOT NULL,
  `item_id` int(10) unsigned NOT NULL,
  `cost_price` decimal(15,2) NOT NULL,
  `selling_price` decimal(15,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_cost_price` decimal(15,2) NOT NULL,
  `total_selling_price` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `item_kit_items_item_kit_id_foreign` (`item_kit_id`),
  KEY `item_kit_items_item_id_foreign` (`item_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table flexlwhc_fpos_prod.item_kit_items: 0 rows
/*!40000 ALTER TABLE `item_kit_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `item_kit_items` ENABLE KEYS */;

-- Dumping structure for table flexlwhc_fpos_prod.item_kit_item_temps
CREATE TABLE IF NOT EXISTS `item_kit_item_temps` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `item_id` int(10) unsigned NOT NULL,
  `cost_price` decimal(15,2) NOT NULL,
  `selling_price` decimal(15,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_cost_price` decimal(15,2) NOT NULL,
  `total_selling_price` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `item_kit_item_temps_item_id_foreign` (`item_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table flexlwhc_fpos_prod.item_kit_item_temps: 0 rows
/*!40000 ALTER TABLE `item_kit_item_temps` DISABLE KEYS */;
/*!40000 ALTER TABLE `item_kit_item_temps` ENABLE KEYS */;

-- Dumping structure for table flexlwhc_fpos_prod.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table flexlwhc_fpos_prod.migrations: 32 rows
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2015_05_29_074713_create_customers_table', 1),
	(4, '2015_05_30_015027_create_items_table', 1),
	(5, '2015_05_30_073533_create_suppliers_table', 1),
	(6, '2015_06_02_010425_create_inventories_table', 1),
	(7, '2015_06_03_013557_create_receivings_table', 1),
	(8, '2015_06_03_134547_create_receiving_temps_table', 1),
	(9, '2015_06_06_083156_create_sales_table', 1),
	(10, '2015_06_06_083159_create_sale_temps_table', 1),
	(11, '2015_06_07_042753_create_receiving_items_table', 1),
	(12, '2015_06_08_050821_create_sale_items_table', 1),
	(13, '2015_06_12_214916_create_item_kit_item_temps_table', 1),
	(14, '2015_06_12_224226_create_item_kit_items_table', 1),
	(15, '2015_06_16_163101_create_tutapos_settings_table', 1),
	(16, '2017_05_22_165812_add_discount_tax_grandtotal_to_sales', 1),
	(17, '2018_03_23_021440_create_sale_payments_table', 1),
	(18, '2018_03_25_141132_create_flexible_pos_settings_table', 1),
	(19, '2018_03_27_011844_create_customer_payments_table', 1),
	(20, '2018_03_27_022156_create_expense_categories_table', 1),
	(21, '2018_03_27_022640_create_expenses_table', 1),
	(22, '2018_04_03_213954_create_daily_reports_table', 1),
	(23, '2018_04_07_213837_create_receiving_payments_table', 1),
	(24, '2018_04_07_214803_create_supplier_payments_table', 1),
	(25, '2018_04_21_212541_create_accounts_table', 1),
	(26, '2018_05_01_111157_create_transactions_table', 1),
	(27, '2019_02_07_160619_create_companies_table', 1),
	(28, '2019_02_07_170531_create_company_users_table', 1),
	(29, '2019_02_08_131317_create_permission_tables', 1),
	(30, '2019_08_03_115934_create_currencies_table', 1),
	(31, '2019_08_03_121015_add_currency_id_to_settings', 1),
	(32, '2019_09_18_235801_add_stock_limit_to_items_table', 1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Dumping structure for table flexlwhc_fpos_prod.model_has_permissions
CREATE TABLE IF NOT EXISTS `model_has_permissions` (
  `permission_id` int(10) unsigned NOT NULL,
  `model_type` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table flexlwhc_fpos_prod.model_has_permissions: 0 rows
/*!40000 ALTER TABLE `model_has_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `model_has_permissions` ENABLE KEYS */;

-- Dumping structure for table flexlwhc_fpos_prod.model_has_roles
CREATE TABLE IF NOT EXISTS `model_has_roles` (
  `role_id` int(10) unsigned NOT NULL,
  `model_type` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table flexlwhc_fpos_prod.model_has_roles: 1 rows
/*!40000 ALTER TABLE `model_has_roles` DISABLE KEYS */;
INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
	(1, 'App\\User', 1);
/*!40000 ALTER TABLE `model_has_roles` ENABLE KEYS */;

-- Dumping structure for table flexlwhc_fpos_prod.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table flexlwhc_fpos_prod.password_resets: 0 rows
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Dumping structure for table flexlwhc_fpos_prod.permissions
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `label` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=134 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table flexlwhc_fpos_prod.permissions: 133 rows
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` (`id`, `label`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
	(1, 'List Items', 'items.index', 'web', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(2, 'Create Items', 'items.create', 'web', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(3, 'Store Items', 'items.store', 'web', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(4, 'View Items', 'items.show', 'web', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(5, 'Delete Items', 'items.destroy', 'web', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(6, 'Update Items', 'items.update', 'web', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(7, 'Edit Items', 'items.edit', 'web', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(8, 'List Inventory', 'inventory.index', 'web', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(9, 'Create Inventory', 'inventory.create', 'web', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(10, 'Store Inventory', 'inventory.store', 'web', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(11, 'View Inventory', 'inventory.show', 'web', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(12, 'Delete Inventory', 'inventory.destroy', 'web', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(13, 'Update Inventory', 'inventory.update', 'web', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(14, 'Edit Inventory', 'inventory.edit', 'web', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(15, 'List Customers', 'customers.index', 'web', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(16, 'Create Customers', 'customers.create', 'web', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(17, 'Store Customers', 'customers.store', 'web', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(18, 'View Customers', 'customers.show', 'web', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(19, 'Delete Customers', 'customers.destroy', 'web', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(20, 'Update Customers', 'customers.update', 'web', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(21, 'Edit Customers', 'customers.edit', 'web', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(22, 'List Suppliers', 'suppliers.index', 'web', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(23, 'Create Suppliers', 'suppliers.create', 'web', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(24, 'Store Suppliers', 'suppliers.store', 'web', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(25, 'View Suppliers', 'suppliers.show', 'web', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(26, 'Delete Suppliers', 'suppliers.destroy', 'web', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(27, 'Update Suppliers', 'suppliers.update', 'web', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(28, 'Edit Suppliers', 'suppliers.edit', 'web', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(29, 'List Receivings', 'receivings.index', 'web', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(30, 'Create Receivings', 'receivings.create', 'web', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(31, 'Store Receivings', 'receivings.store', 'web', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(32, 'View Receivings', 'receivings.show', 'web', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(33, 'Delete Receivings', 'receivings.destroy', 'web', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(34, 'Update Receivings', 'receivings.update', 'web', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(35, 'Edit Receivings', 'receivings.edit', 'web', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(36, 'List Transactions', 'transactions.index', 'web', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(37, 'Create Transactions', 'transactions.create', 'web', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(38, 'Store Transactions', 'transactions.store', 'web', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(39, 'View Transactions', 'transactions.show', 'web', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(40, 'Delete Transactions', 'transactions.destroy', 'web', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(41, 'Update Transactions', 'transactions.update', 'web', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(42, 'Edit Transactions', 'transactions.edit', 'web', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(43, 'List Supplierpayments', 'supplierpayments.index', 'web', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(44, 'Create Supplierpayments', 'supplierpayments.create', 'web', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(45, 'Store Supplierpayments', 'supplierpayments.store', 'web', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(46, 'View Supplierpayments', 'supplierpayments.show', 'web', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(47, 'Delete Supplierpayments', 'supplierpayments.destroy', 'web', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(48, 'Update Supplierpayments', 'supplierpayments.update', 'web', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(49, 'Edit Supplierpayments', 'supplierpayments.edit', 'web', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(50, 'List Sales', 'sales.index', 'web', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(51, 'Create Sales', 'sales.create', 'web', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(52, 'Store Sales', 'sales.store', 'web', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(53, 'View Sales', 'sales.show', 'web', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(54, 'Delete Sales', 'sales.destroy', 'web', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(55, 'Update Sales', 'sales.update', 'web', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(56, 'Edit Sales', 'sale.edit', 'web', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(57, 'List Salepayments', 'salepayments.index', 'web', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(58, 'Create Salepayments', 'salepayments.create', 'web', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(59, 'Store Salepayments', 'salepayments.store', 'web', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(60, 'View Salepayments', 'salepayments.show', 'web', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(61, 'Delete Salepayments', 'salepayments.destroy', 'web', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(62, 'Update Salepayments', 'salepayments.update', 'web', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(63, 'Edit Salepayments', 'salepayments.edit', 'web', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(64, 'List Dailyreport', 'dailyreport.index', 'web', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(65, 'Create Dailyreport', 'dailyreport.create', 'web', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(66, 'Store Dailyreport', 'dailyreport.store', 'web', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(67, 'View Dailyreport', 'dailyreport.show', 'web', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(68, 'Delete Dailyreport', 'dailyreport.destroy', 'web', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(69, 'Update Dailyreport', 'dailyreport.update', 'web', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(70, 'Edit Dailyreport', 'dailyreport.edit', 'web', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(71, 'List Receivingpayments', 'receivingpayments.index', 'web', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(72, 'Create Receivingpayments', 'receivingpayments.create', 'web', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(73, 'Store Receivingpayments', 'receivingpayments.store', 'web', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(74, 'View Receivingpayments', 'receivingpayments.show', 'web', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(75, 'Delete Receivingpayments', 'receivingpayments.destroy', 'web', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(76, 'Update Receivingpayments', 'receivingpayments.update', 'web', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(77, 'Edit Receivingpayments', 'receivingpayments.edit', 'web', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(78, 'List Expense', 'expense.index', 'web', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(79, 'Create Expense', 'expense.create', 'web', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(80, 'Store Expense', 'expense.store', 'web', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(81, 'View Expense', 'expense.show', 'web', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(82, 'Delete Expense', 'expense.destroy', 'web', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(83, 'Update Expense', 'expense.update', 'web', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(84, 'Edit Expense', 'expense.edit', 'web', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(85, 'List Expensecategory', 'expensecategory.index', 'web', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(86, 'Create Expensecategory', 'expensecategory.create', 'web', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(87, 'Store Expensecategory', 'expensecategory.store', 'web', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(88, 'View Expensecategory', 'expensecategory.show', 'web', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(89, 'Delete Expensecategory', 'expensecategory.destroy', 'web', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(90, 'Update Expensecategory', 'expensecategory.update', 'web', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(91, 'Edit Expensecategory', 'expensecategory.edit', 'web', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(92, 'List Customerpayments', 'customerpayments.index', 'web', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(93, 'Create Customerpayments', 'customerpayments.create', 'web', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(94, 'Store Customerpayments', 'customerpayments.store', 'web', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(95, 'View Customerpayments', 'customerpayments.show', 'web', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(96, 'Delete Customerpayments', 'customerpayments.destroy', 'web', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(97, 'Update Customerpayments', 'customerpayments.update', 'web', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(98, 'Edit Customerpayments', 'customerpayments.edit', 'web', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(99, 'List Accounts', 'accounts.index', 'web', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(100, 'Create Accounts', 'accounts.create', 'web', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(101, 'Store Accounts', 'accounts.store', 'web', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(102, 'View Accounts', 'accounts.show', 'web', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(103, 'Delete Accounts', 'accounts.destroy', 'web', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(104, 'Update Accounts', 'accounts.update', 'web', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(105, 'Edit Accounts', 'accounts.edit', 'web', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(106, 'List Employees', 'employees.index', 'web', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(107, 'Create Employees', 'employees.create', 'web', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(108, 'Store Employees', 'employees.store', 'web', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(109, 'View Employees', 'employees.show', 'web', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(110, 'Delete Employees', 'employees.destroy', 'web', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(111, 'Update Employees', 'employees.update', 'web', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(112, 'Edit Employees', 'employees.edit', 'web', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(113, 'List Settings', 'flexiblepossetting.index', 'web', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(114, 'Create Settings', 'flexiblepossetting.create', 'web', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(115, 'Store Settings', 'flexiblepossetting.store', 'web', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(116, 'View Settings', 'flexiblepossetting.show', 'web', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(117, 'Delete Settings', 'flexiblepossetting.destroy', 'web', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(118, 'Update Settings', 'flexiblepossetting.update', 'web', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(119, 'Edit Settings', 'flexiblepossetting.edit', 'web', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(120, 'List Permissions', 'permissions.list', 'web', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(121, 'Assaign Roles', 'assaign.roles', 'web', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(122, 'Create Roles', 'employeerole.create', 'web', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(123, 'Create Permission Role', 'permissionrole.create', 'web', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(124, 'Create Permissions', 'permissions.create', 'web', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(125, 'Getsales Reports', 'reports.getsales', 'web', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(126, 'CreateDaily Reports', 'reports.createdaily', 'web', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(127, 'CreatePast Reports', 'reports.createpast', 'web', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(128, 'GetDaily Reports', 'reports.getdaily', 'web', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(129, 'CreateCustom Items', 'items.customcreate', 'web', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(130, 'PrintSales Reports', 'reports.printsales', 'web', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(131, 'GetAllSale Reports', 'reports.getsalereport', 'web', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(132, 'Sale-receive-chart Dashboard', 'Sale-receive-chart Dashboard', 'web', '2019-10-01 19:51:03', '2019-10-01 19:51:03'),
	(133, 'Latest-income-expense Dashboard', 'Latest-income-expense Dashboard', 'web', '2019-10-01 19:51:03', '2019-10-01 19:51:03');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;

-- Dumping structure for table flexlwhc_fpos_prod.receivings
CREATE TABLE IF NOT EXISTS `receivings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `supplier_id` int(10) unsigned DEFAULT NULL,
  `payment_type` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `total` decimal(12,2) NOT NULL,
  `payment` decimal(12,2) NOT NULL,
  `dues` decimal(12,2) NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `status` tinyint(4) NOT NULL,
  `comments` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `receivings_supplier_id_foreign` (`supplier_id`),
  KEY `receivings_user_id_foreign` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table flexlwhc_fpos_prod.receivings: 0 rows
/*!40000 ALTER TABLE `receivings` DISABLE KEYS */;
/*!40000 ALTER TABLE `receivings` ENABLE KEYS */;

-- Dumping structure for table flexlwhc_fpos_prod.receiving_items
CREATE TABLE IF NOT EXISTS `receiving_items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `receiving_id` int(10) unsigned NOT NULL,
  `item_id` int(10) unsigned NOT NULL,
  `cost_price` decimal(9,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_cost` decimal(9,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `receiving_items_receiving_id_foreign` (`receiving_id`),
  KEY `receiving_items_item_id_foreign` (`item_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table flexlwhc_fpos_prod.receiving_items: 0 rows
/*!40000 ALTER TABLE `receiving_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `receiving_items` ENABLE KEYS */;

-- Dumping structure for table flexlwhc_fpos_prod.receiving_payments
CREATE TABLE IF NOT EXISTS `receiving_payments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `payment` decimal(12,2) NOT NULL,
  `payment_type` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `comments` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dues` decimal(12,2) NOT NULL,
  `receiving_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `receiving_payments_receiving_id_foreign` (`receiving_id`),
  KEY `receiving_payments_user_id_foreign` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table flexlwhc_fpos_prod.receiving_payments: 0 rows
/*!40000 ALTER TABLE `receiving_payments` DISABLE KEYS */;
/*!40000 ALTER TABLE `receiving_payments` ENABLE KEYS */;

-- Dumping structure for table flexlwhc_fpos_prod.receiving_temps
CREATE TABLE IF NOT EXISTS `receiving_temps` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `item_id` int(10) unsigned NOT NULL,
  `cost_price` decimal(9,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_cost` decimal(9,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `receiving_temps_item_id_foreign` (`item_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table flexlwhc_fpos_prod.receiving_temps: 0 rows
/*!40000 ALTER TABLE `receiving_temps` DISABLE KEYS */;
/*!40000 ALTER TABLE `receiving_temps` ENABLE KEYS */;

-- Dumping structure for table flexlwhc_fpos_prod.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table flexlwhc_fpos_prod.roles: 1 rows
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
	(1, 'admin', 'web', '2019-10-01 19:51:04', '2019-10-01 19:51:04');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;

-- Dumping structure for table flexlwhc_fpos_prod.role_has_permissions
CREATE TABLE IF NOT EXISTS `role_has_permissions` (
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table flexlwhc_fpos_prod.role_has_permissions: 133 rows
/*!40000 ALTER TABLE `role_has_permissions` DISABLE KEYS */;
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
	(1, 1),
	(2, 1),
	(3, 1),
	(4, 1),
	(5, 1),
	(6, 1),
	(7, 1),
	(8, 1),
	(9, 1),
	(10, 1),
	(11, 1),
	(12, 1),
	(13, 1),
	(14, 1),
	(15, 1),
	(16, 1),
	(17, 1),
	(18, 1),
	(19, 1),
	(20, 1),
	(21, 1),
	(22, 1),
	(23, 1),
	(24, 1),
	(25, 1),
	(26, 1),
	(27, 1),
	(28, 1),
	(29, 1),
	(30, 1),
	(31, 1),
	(32, 1),
	(33, 1),
	(34, 1),
	(35, 1),
	(36, 1),
	(37, 1),
	(38, 1),
	(39, 1),
	(40, 1),
	(41, 1),
	(42, 1),
	(43, 1),
	(44, 1),
	(45, 1),
	(46, 1),
	(47, 1),
	(48, 1),
	(49, 1),
	(50, 1),
	(51, 1),
	(52, 1),
	(53, 1),
	(54, 1),
	(55, 1),
	(56, 1),
	(57, 1),
	(58, 1),
	(59, 1),
	(60, 1),
	(61, 1),
	(62, 1),
	(63, 1),
	(64, 1),
	(65, 1),
	(66, 1),
	(67, 1),
	(68, 1),
	(69, 1),
	(70, 1),
	(71, 1),
	(72, 1),
	(73, 1),
	(74, 1),
	(75, 1),
	(76, 1),
	(77, 1),
	(78, 1),
	(79, 1),
	(80, 1),
	(81, 1),
	(82, 1),
	(83, 1),
	(84, 1),
	(85, 1),
	(86, 1),
	(87, 1),
	(88, 1),
	(89, 1),
	(90, 1),
	(91, 1),
	(92, 1),
	(93, 1),
	(94, 1),
	(95, 1),
	(96, 1),
	(97, 1),
	(98, 1),
	(99, 1),
	(100, 1),
	(101, 1),
	(102, 1),
	(103, 1),
	(104, 1),
	(105, 1),
	(106, 1),
	(107, 1),
	(108, 1),
	(109, 1),
	(110, 1),
	(111, 1),
	(112, 1),
	(113, 1),
	(114, 1),
	(115, 1),
	(116, 1),
	(117, 1),
	(118, 1),
	(119, 1),
	(120, 1),
	(121, 1),
	(122, 1),
	(123, 1),
	(124, 1),
	(125, 1),
	(126, 1),
	(127, 1),
	(128, 1),
	(129, 1),
	(130, 1),
	(131, 1),
	(132, 1),
	(133, 1);
/*!40000 ALTER TABLE `role_has_permissions` ENABLE KEYS */;

-- Dumping structure for table flexlwhc_fpos_prod.sales
CREATE TABLE IF NOT EXISTS `sales` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` int(10) unsigned DEFAULT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `payment_type` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `comments` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `discount` decimal(9,2) NOT NULL,
  `tax` decimal(9,2) NOT NULL,
  `grand_total` decimal(9,2) NOT NULL,
  `payment` decimal(9,2) NOT NULL,
  `dues` decimal(9,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sales_customer_id_foreign` (`customer_id`),
  KEY `sales_user_id_foreign` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table flexlwhc_fpos_prod.sales: 0 rows
/*!40000 ALTER TABLE `sales` DISABLE KEYS */;
/*!40000 ALTER TABLE `sales` ENABLE KEYS */;

-- Dumping structure for table flexlwhc_fpos_prod.sale_items
CREATE TABLE IF NOT EXISTS `sale_items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sale_id` int(10) unsigned NOT NULL,
  `item_id` int(10) unsigned NOT NULL,
  `cost_price` decimal(15,2) NOT NULL,
  `selling_price` decimal(15,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_cost` decimal(15,2) NOT NULL,
  `total_selling` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sale_items_sale_id_foreign` (`sale_id`),
  KEY `sale_items_item_id_foreign` (`item_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table flexlwhc_fpos_prod.sale_items: 0 rows
/*!40000 ALTER TABLE `sale_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `sale_items` ENABLE KEYS */;

-- Dumping structure for table flexlwhc_fpos_prod.sale_payments
CREATE TABLE IF NOT EXISTS `sale_payments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `payment` decimal(12,2) NOT NULL,
  `payment_type` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `comments` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dues` decimal(12,2) NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `sale_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sale_payments_user_id_foreign` (`user_id`),
  KEY `sale_payments_sale_id_foreign` (`sale_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table flexlwhc_fpos_prod.sale_payments: 0 rows
/*!40000 ALTER TABLE `sale_payments` DISABLE KEYS */;
/*!40000 ALTER TABLE `sale_payments` ENABLE KEYS */;

-- Dumping structure for table flexlwhc_fpos_prod.sale_temps
CREATE TABLE IF NOT EXISTS `sale_temps` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `item_id` int(10) unsigned NOT NULL,
  `cost_price` decimal(9,2) NOT NULL,
  `selling_price` decimal(9,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_cost` decimal(9,2) NOT NULL,
  `total_selling` decimal(9,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sale_temps_item_id_foreign` (`item_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table flexlwhc_fpos_prod.sale_temps: 0 rows
/*!40000 ALTER TABLE `sale_temps` DISABLE KEYS */;
/*!40000 ALTER TABLE `sale_temps` ENABLE KEYS */;

-- Dumping structure for table flexlwhc_fpos_prod.suppliers
CREATE TABLE IF NOT EXISTS `suppliers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `company_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone_number` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'no-foto.png',
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `zip` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `comments` text COLLATE utf8_unicode_ci,
  `account` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `prev_balance` decimal(12,2) DEFAULT NULL,
  `payment` decimal(12,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table flexlwhc_fpos_prod.suppliers: 0 rows
/*!40000 ALTER TABLE `suppliers` DISABLE KEYS */;
/*!40000 ALTER TABLE `suppliers` ENABLE KEYS */;

-- Dumping structure for table flexlwhc_fpos_prod.supplier_payments
CREATE TABLE IF NOT EXISTS `supplier_payments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `payment` decimal(12,2) NOT NULL,
  `payment_type` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `comments` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `supplier_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `supplier_payments_supplier_id_foreign` (`supplier_id`),
  KEY `supplier_payments_user_id_foreign` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table flexlwhc_fpos_prod.supplier_payments: 0 rows
/*!40000 ALTER TABLE `supplier_payments` DISABLE KEYS */;
/*!40000 ALTER TABLE `supplier_payments` ENABLE KEYS */;

-- Dumping structure for table flexlwhc_fpos_prod.transactions
CREATE TABLE IF NOT EXISTS `transactions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `transaction_type` tinyint(4) NOT NULL,
  `transaction_with` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `amount` decimal(8,2) NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `account_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `transactions_user_id_foreign` (`user_id`),
  KEY `transactions_account_id_foreign` (`account_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table flexlwhc_fpos_prod.transactions: 0 rows
/*!40000 ALTER TABLE `transactions` DISABLE KEYS */;
/*!40000 ALTER TABLE `transactions` ENABLE KEYS */;

-- Dumping structure for table flexlwhc_fpos_prod.tutapos_settings
CREATE TABLE IF NOT EXISTS `tutapos_settings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `languange` varchar(5) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'en',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table flexlwhc_fpos_prod.tutapos_settings: 0 rows
/*!40000 ALTER TABLE `tutapos_settings` DISABLE KEYS */;
/*!40000 ALTER TABLE `tutapos_settings` ENABLE KEYS */;

-- Dumping structure for table flexlwhc_fpos_prod.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Dumping data for table flexlwhc_fpos_prod.users: 1 rows
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'admin', 'admin@flexibleit.net', '$2y$10$WKji2YJ2wQNWf6zJ5vdFQe34.al7rXr.NrhrKLqmw8pbFKbZuxy16', 'tx8qVqauu8vz0laz9RVoKoc7zK1cwcFY4LtXmzgaXMKqzwaAgKjoO13yZO0c', '2019-10-01 19:51:02', '2019-10-01 19:51:02');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
