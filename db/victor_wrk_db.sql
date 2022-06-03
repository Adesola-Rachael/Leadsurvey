-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 03, 2022 at 11:23 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `victor_wrk_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `campaigns`
--

CREATE TABLE `campaigns` (
  `sn` int(11) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `title` varchar(50) NOT NULL,
  `descr` varchar(200) DEFAULT NULL,
  `duration` int(3) DEFAULT NULL COMMENT 'in weeks',
  `goal` int(11) NOT NULL COMMENT 'total leads aimed for',
  `start_date` varchar(15) DEFAULT NULL,
  `end_date` varchar(15) DEFAULT NULL,
  `feedback_tool` varchar(10) DEFAULT NULL,
  `feedback_data` varchar(10) DEFAULT NULL,
  `status` varchar(20) NOT NULL COMMENT 'NOT-STARTED, ONGOING, ENDED',
  `time_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  `time_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `campaigns`
--

INSERT INTO `campaigns` (`sn`, `user_id`, `title`, `descr`, `duration`, `goal`, `start_date`, `end_date`, `feedback_tool`, `feedback_data`, `status`, `time_modified`, `time_created`) VALUES
(8, 'elpadjo', 'Create New Campaign 3', 'Create New Campaign Create New Campaign Create New Campaign', 10, 100, '24 May 2021', '02 Aug 2021', 'survey', '', 'ongoing', '2021-12-22 14:01:13', '2021-05-14 17:41:31'),
(9, 'elpadjo', 'Create New Campaign 3', 'Create New Campaign Create New Campaign Create New Campaign', 10, 100, '24 May 2021', '02 Aug 2021', 'quiz', '', 'ongoing', '2021-12-22 14:07:20', '2021-05-14 20:58:07'),
(10, 'elpadjo', 'Overview of the design with CSS 1', 'Create try', 1, 4, '14 May 2021', '21 May 2021', 'quiz', NULL, 'ongoing', '2021-12-22 14:06:32', '2021-05-14 21:29:01'),
(11, 'elpadjo', 'Create Edit Now 4', 'Create Edit Campaign  Create Edit Campaign', 8, 30, '14 May 2021', '09 Jul 2021', 'poll', '', 'not-started', '2021-12-22 14:06:42', '2021-05-14 21:56:48'),
(12, 'elpadjo', 'vest into right now', 'Describe vest into right now', 3, 15, '15 May 2021', '05 Jun 2021', 'quiz', NULL, 'not-started', '2021-12-22 14:06:09', '2021-05-15 14:56:07'),
(13, 'treasure', 'name', 'thios ia the description', 10, 3, '15 Dec 2021', '23 Feb 2022', 'quiz', '', 'ongoing', '2021-12-22 14:04:16', '2021-12-15 13:18:55'),
(14, 'treasure', 'name', 'thios ia the description', 10, 3, '15 Dec 2021', '23 Feb 2022', 'quiz', '', 'not-started', '2021-12-22 14:04:16', '2021-12-15 13:18:58'),
(15, 'treasure', 'hhjjh', 'jhjjhj', 5, 76, '16 Dec 2021', '20 Jan 2022', 'survey', '', 'ongoing', '2021-12-22 14:04:16', '2021-12-16 04:59:28'),
(16, 'treasure', 'yuyu', 'jk', 6, 9, '16 Dec 2021', '27 Jan 2022', 'survey', '', 'ongoing', '2021-12-22 14:04:17', '2021-12-16 04:59:48'),
(17, 'treasure', 'u', 'iik', 6, 7, '16 Dec 2021', '27 Jan 2022', 'survey', '', 'not-started', '2021-12-22 14:04:17', '2021-12-16 05:00:11'),
(18, 'treasure', 'yuyu', 'uu', 67, 8, '16 Dec 2021', '30 Mar 2023', 'survey', '', 'ongoing', '2021-12-22 14:04:17', '2021-12-16 05:00:30'),
(19, 'treasure', 'yyu', 'uuu', 12, 12, '16 Dec 2021', '10 Mar 2022', 'quiz', '', 'trashed', '2022-01-02 16:20:00', '2021-12-16 05:01:06'),
(20, 'treasure', 'uh', 'uu', 12, 7, '16 Dec 2021', '10 Mar 2022', 'quiz', '', 'ongoing', '2021-12-22 14:04:17', '2021-12-16 05:01:28'),
(21, 'treasure', 'yuyu', 'yu', 6, 6, '16 Dec 2021', '27 Jan 2022', 'survey', '', 'trashed', '2022-01-02 16:33:29', '2021-12-16 05:02:21'),
(22, 'treasure', 'y66', '8', 7, 7, '16 Dec 2021', '03 Feb 2022', 'poll', '', 'trashed', '2021-12-22 14:04:57', '2021-12-16 05:02:39'),
(23, 'treasure', 'uu', 'fghj', 12, 9, '16 Dec 2021', '10 Mar 2022', 'survey', '', 'trashed', '2021-12-22 14:05:11', '2021-12-16 05:03:20'),
(24, 'treasure', 'uu', 'fghj', 12, 9, '16 Dec 2021', '10 Mar 2022', 'survey', '', 'trashed', '2021-12-22 14:04:45', '2021-12-16 05:03:23'),
(25, 'treasure', 'uu', '', 12, 9, '16 Dec 2021', '10 Mar 2022', 'survey', '', 'trashed', '2022-01-02 16:33:06', '2021-12-16 05:03:25'),
(26, 'bolatito', 'New Campaign1', 'This is a new campaign', 2, 10, '03 Jun 2022', '17 Jun 2022', 'quiz', '', 'not-started', '2022-06-03 02:40:55', '2022-06-03 02:40:55');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `sn` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `subject` varchar(100) DEFAULT NULL,
  `message` varchar(300) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'green',
  `response_msg` varchar(250) DEFAULT NULL,
  `response_time` datetime DEFAULT NULL,
  `response_uploader` varchar(50) DEFAULT NULL,
  `time_created` datetime NOT NULL,
  `time_modified` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` char(2) CHARACTER SET utf8 NOT NULL,
  `countryName` varchar(100) CHARACTER SET utf8 NOT NULL,
  `code` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `countryName`, `code`) VALUES
('CA', 'Canada', '+1'),
('US', 'United States', '+1'),
('AD', 'Andorra', '+376'),
('AE', 'United Arab Emirates', '+971'),
('AF', 'Afghanistan', '+93'),
('AG', 'Antigua and Barbuda', '+268'),
('AL', 'Albania', '+355'),
('AM', 'Armenia', '+374'),
('AO', 'Angola', '+244'),
('AR', 'Argentina', '+54'),
('AT', 'Austria', '+43'),
('AU', 'Australia', '+61'),
('AZ', 'Azerbaijan', '+994'),
('BA', 'Bosnia/Herzegovina', '+387'),
('BB', 'Barbados', '+246'),
('BD', 'Bangladesh', '+880'),
('BE', 'Belgium', '+32'),
('BF', 'Burkina Faso', '+226'),
('BG', 'Bulgaria', '+359'),
('BH', 'Bahrain', '+973'),
('BI', 'Burundi', '+257'),
('BJ', 'Benin', '+229'),
('BM', 'Bermuda', '+441'),
('BN', 'Brunei Darussalam', '+673'),
('BO', 'Bolivia', '+591'),
('BR', 'Brazil', '+55'),
('BS', 'Bahamas', '+242'),
('BT', 'Bhutan', '+975'),
('BW', 'Botswana', '+267'),
('BY', 'Belarus', '+375'),
('BZ', 'Belize', '+501'),
('CF', 'Central African Republic', '+236'),
('CG', 'Congo', '+242'),
('CH', 'Switzerland', '+41'),
('CI', 'Cote D\'Ivoire', '+225'),
('CL', 'Chile', '+56'),
('CM', 'Cameroon', '+237'),
('CN', 'China', '+86'),
('CO', 'Colombia', '+57'),
('CR', 'Costa Rica', '+506'),
('CU', 'Cuba', '+53'),
('CV', 'Cape Verde', '+238'),
('CY', 'Cyprus', '+357'),
('CZ', 'Czech Republic', '+420'),
('DE', 'Germany', '+49'),
('DJ', 'Djibouti', '+253'),
('DK', 'Denmark', '+45'),
('DM', 'Dominica', '+767'),
('DO', 'Dominican Republic', '+809'),
('DZ', 'Algeria', '+213'),
('EC', 'Ecuador', '+593'),
('EE', 'Estonia', '+372'),
('EG', 'Egypt', '+20'),
('ES', 'Spain', '+34'),
('ET', 'Ethiopia', '+251'),
('FI', 'Finland', '+358'),
('FJ', 'Fiji', '+679'),
('FM', 'Micronesia', '+691'),
('FR', 'France', '+33'),
('GA', 'Gabon', '+241'),
('GB', 'United Kingdom', '+44'),
('GD', 'Grenada', '+473'),
('GE', 'Georgia', '+995'),
('GH', 'Ghana', '+233'),
('GL', 'Greenland', '+299'),
('GM', 'Gambia', '+220'),
('GN', 'Guinea', '+224'),
('GQ', 'Equatorial Guinea', '+240'),
('GR', 'Greece', '+30'),
('GT', 'Guatemala', '+502'),
('GW', 'Guinea-Bissau', '+245'),
('GY', 'Guyana', '+592'),
('HN', 'Honduras', '+504'),
('HR', 'Croatia', '+385'),
('HT', 'Haiti', '+509'),
('HU', 'Hungary', '+36'),
('ID', 'Indonesia', '+62'),
('IE', 'Ireland', '+353'),
('IL', 'Israel', '+972'),
('IN', 'India', '+91'),
('IQ', 'Iraq', '+964'),
('IR', 'Iran', '+98'),
('IS', 'Iceland', '+354'),
('IT', 'Italy', '+39'),
('JM', 'Jamaica', '+876'),
('JO', 'Jordan', '+962'),
('JP', 'Japan', '+81'),
('KE', 'Kenya', '+254'),
('KG', 'Kyrgyzstan', '+996'),
('KH', 'Cambodia', '+855'),
('KI', 'Kiribati', '+686'),
('KM', 'Comoros', '+269'),
('KN', 'Saint Kitts and Nevis', '+869'),
('KP', 'Korea (North)', '+850'),
('KR', 'Korea (South)', '+82'),
('KW', 'Kuwait', '+965'),
('KY', 'Cayman Islands', '+345'),
('KZ', 'Kazakstan', '+7'),
('LA', 'Lao People\'s', '+856'),
('LB', 'Lebanon', '+961'),
('LC', 'Saint Lucia', '+758'),
('LI', 'Liechtenstein', '+423'),
('LK', 'Sri Lanka', '+94'),
('LR', 'Liberia', '+231'),
('LS', 'Lesotho', '+266'),
('LT', 'Lithuania', '+370'),
('LU', 'Luxembourg', '+352'),
('LV', 'Latvia', '+371'),
('LY', 'Libya', '+218'),
('MA', 'Morocco', '+212'),
('MC', 'Monaco', '+377'),
('MD', 'Moldova', '+373'),
('MG', 'Madagascar', '+261'),
('MK', 'Macedonia', '+389'),
('ML', 'Mali', '+223'),
('MM', 'Myanmar', '+95'),
('MN', 'Mongolia', '+976'),
('MO', 'Macau', '+853'),
('MR', 'Mauritania', '+222'),
('MS', 'Montserrat', '+664'),
('MU', 'Mauritius', '+230'),
('MV', 'Maldives', '+960'),
('MW', 'Malawi', '+265'),
('MX', 'Mexico', '+52'),
('MY', 'Malaysia', '+60'),
('MZ', 'Mozambique', '+258'),
('NA', 'Namibia', '+264'),
('NE', 'Niger', '+227'),
('NG', 'Nigeria', '+234'),
('NI', 'Nicaragua', '+505'),
('NL', 'Netherlands', '+31'),
('NO', 'Norway', '+47'),
('NP', 'Nepal', '+977'),
('NR', 'Nauru', '+674'),
('NZ', 'New Zealand', '+64'),
('OM', 'Oman', '+968'),
('PA', 'Panama', '+507'),
('PE', 'Peru', '+51'),
('PG', 'Papua New Guinea', '+675'),
('PH', 'Philippines', '+63'),
('PK', 'Pakistan', '+92'),
('PL', 'Poland', '+48'),
('PT', 'Portugal', '+351'),
('PY', 'Paraguay', '+595'),
('QA', 'Qatar', '+974'),
('RO', 'Romania', '+40'),
('RU', 'Russia', '+7'),
('RW', 'Rwanda', '+250'),
('SA', 'Saudi Arabia', '+966'),
('SB', 'Solomon Islands', '+677'),
('SC', 'Seychelles', '+248'),
('SD', 'Sudan', '+249'),
('SE', 'Sweden', '+46'),
('SH', 'Saint Helena', '+290'),
('SK', 'Slovakia', '+421'),
('SL', 'Sierra Leone', '+232'),
('SM', 'San Marino', '+378'),
('SN', 'Senegal', '+221'),
('SO', 'Somalia', '+252'),
('SR', 'Suriname', '+597'),
('ST', 'Sao Tome and Principe', '+239'),
('SV', 'El Salvador', '+503'),
('SY', 'Syria', '+963'),
('SZ', 'Swaziland', '+268'),
('TD', 'Chad', '+235'),
('TG', 'Togo', '+228'),
('TH', 'Thailand', '+66'),
('TM', 'Turkmenistan', '+993'),
('TN', 'Tunisia', '+216'),
('TO', 'Tonga', '+676'),
('TR', 'Turkey', '+90'),
('TT', 'Trinidad and Tobago', '+868'),
('TW', 'Taiwan', '+886'),
('TZ', 'Tanzania', '+255'),
('UA', 'Ukraine', '+380'),
('UG', 'Uganda', '+256'),
('UY', 'Uruguay', '+598'),
('UZ', 'Uzbekistan', '+998'),
('VC', 'St. Vincent and the Grenadines', '+784'),
('VE', 'Venezuela', '+58'),
('VN', 'Vietnam', '+84'),
('VU', 'Vanuatu', '+678'),
('WS', 'Samoa', '+685'),
('YE', 'Yemen', '+967'),
('ZA', 'South Africa', '+27'),
('ZM', 'Zambia', '+260'),
('ZR', 'Congo, Dem. Rep. of (former Zaire) ', '+243'),
('ZW', 'Zimbabwe', '+263'),
('SG', 'Singapore', '+65'),
('HK', 'Hong Kong', '+852'),
('ME', 'Montenegro', '+382'),
('RS', 'Serbia', '+381');

-- --------------------------------------------------------

--
-- Table structure for table `feedback_responses`
--

CREATE TABLE `feedback_responses` (
  `sn` int(11) NOT NULL,
  `candidate_user_id` varchar(20) NOT NULL,
  `feedback_tool_id` int(11) NOT NULL,
  `ques1_ans` varchar(200) NOT NULL,
  `ques2_ans` varchar(200) NOT NULL,
  `ques3_ans` varchar(200) NOT NULL,
  `ques4_ans` varchar(200) DEFAULT NULL,
  `ques5_ans` varchar(200) DEFAULT NULL,
  `ques6_ans` varchar(200) DEFAULT NULL,
  `ques7_ans` varchar(200) DEFAULT NULL,
  `ques8_ans` varchar(200) DEFAULT NULL,
  `ques9_ans` varchar(200) DEFAULT NULL,
  `ques10_ans` varchar(200) DEFAULT NULL,
  `completion_time` int(11) NOT NULL,
  `date_taken` date NOT NULL,
  `status` varchar(20) NOT NULL,
  `time_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  `time_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `feedback_tool`
--

CREATE TABLE `feedback_tool` (
  `sn` int(11) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `tool_type` varchar(20) NOT NULL COMMENT 'quiz, survey, poll',
  `title` varchar(100) NOT NULL,
  `descr` varchar(200) NOT NULL,
  `ques1` int(11) NOT NULL,
  `ques2` int(11) NOT NULL,
  `ques3` int(11) NOT NULL,
  `ques4` int(11) DEFAULT NULL,
  `ques5` int(11) DEFAULT NULL,
  `ques6` int(11) DEFAULT NULL,
  `ques7` int(11) DEFAULT NULL,
  `ques8` int(11) DEFAULT NULL,
  `ques9` int(11) DEFAULT NULL,
  `ques10` int(11) DEFAULT NULL,
  `status` varchar(20) NOT NULL,
  `time_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  `time_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `leads`
--

CREATE TABLE `leads` (
  `sn` int(11) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `campaign_id` int(11) DEFAULT NULL,
  `campaign` varchar(150) NOT NULL,
  `lead_tool_id` int(11) DEFAULT NULL,
  `lead_tool_type` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `full_name` varchar(100) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `country_abbr` varchar(10) NOT NULL,
  `state` varchar(50) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `address` varchar(150) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `agegroup` varchar(10) DEFAULT NULL COMMENT '<15, 15-24, 25-64, 65+ ',
  `date_created` date NOT NULL,
  `status` varchar(20) NOT NULL,
  `time_modified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `time_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `leads`
--

INSERT INTO `leads` (`sn`, `user_id`, `campaign_id`, `campaign`, `lead_tool_id`, `lead_tool_type`, `email`, `full_name`, `phone_number`, `country_abbr`, `state`, `country`, `address`, `gender`, `agegroup`, `date_created`, `status`, `time_modified`, `time_created`) VALUES
(1, 'elpadjo', 10, 'Best Campaign', 3, 'survey', 'josserayz@gmail.com', 'Dosubi Joshua', '08039211989', '', 'Lagos', 'Nigeria', '---', 'Male', '25-64', '2021-06-10', '[active]', '2022-01-02 17:28:51', '2021-06-10 11:28:51'),
(2, 'elpadjo', 0, 'Upload', 0, 'Manual', 'padjomag@gmail.com', 'Padjo', '08036989654', '', 'Lagos State', 'Nigeria', NULL, 'Male', '15-24', '2021-06-11', '[active]', '2022-01-02 17:28:51', '2021-06-11 17:39:00'),
(94, 'treasure', 0, 'Upload', 0, 'Manual', 'si@gmail.com', 'sic', '344434', 'pm', 'bles', 'buo', NULL, '', '20-24', '2022-02-25', 'active', '2022-02-25 10:58:06', '2022-02-25 10:58:06'),
(95, 'treasure', 0, 'Upload', 0, 'Manual', 'ai45uyy@gmail.com', 'yisa', '483yy8743', 'BJ', 'Alibori', 'Benin', NULL, 'Male', '25-64', '2022-02-25', 'active', '2022-02-25 10:58:06', '2022-02-25 10:58:06'),
(96, 'treasure', 0, 'Upload', 0, 'Manual', 'mayny@gmail.com', 'many', '123555545', 'MD', 'Lagos', 'Nigeria', NULL, '', '23-30', '2022-02-25', 'active', '2022-02-25 10:58:07', '2022-02-25 10:58:07'),
(97, 'treasure', 0, 'Upload', 0, 'Manual', 'siyy@gmail.com', 'sic', '34445534', 'pm', 'bles', 'buo', NULL, '', '20-24', '2022-02-25', 'active', '2022-02-25 10:58:07', '2022-02-25 10:58:07'),
(98, 'treasure', 0, 'Upload', 0, 'Manual', 'simy@gmail.com', 'myname', '3455654434', 'pm', 'lai', 'main', NULL, '', '22-32', '2022-02-25', 'active', '2022-02-25 10:58:07', '2022-02-25 10:58:07'),
(99, 'treasure', 0, 'Upload', 0, 'Manual', 'me@gmail.com', 'name', '11111111111111', 'BY', 'Gomel', 'Belarus', NULL, 'Male', '15-24', '2022-02-25', 'active', '2022-02-25 10:58:07', '2022-02-25 10:58:07'),
(100, 'treasure', 0, 'Upload', 0, 'Manual', 'me1@gmail.com', 'namenme', '11111110001111111', 'AT', 'Lower Austria', 'Austria', NULL, 'Male', '64+', '2022-02-25', 'active', '2022-02-25 10:58:07', '2022-02-25 10:58:07'),
(101, 'treasure', 0, 'Upload', 0, 'Manual', 'me12@gmail.com', 'namenmeme', '1111111001101111111', 'BD', 'Rangpur Division', 'Bangladesh', NULL, 'Male', '64+', '2022-02-25', 'active', '2022-02-25 10:58:07', '2022-02-25 10:58:07'),
(102, 'treasure', 0, 'Upload', 0, 'Manual', 'nee@gmail.com', 'network', '880968', 'AD', 'Encamp', 'Andorra', NULL, 'Male', '15-24', '2022-02-25', 'active', '2022-02-25 10:58:07', '2022-02-25 10:58:07'),
(103, 'treasure', 0, 'Upload', 0, 'Manual', 'neie@gmail.com', 'network', '88092368', 'BH', 'Southern Governorate', 'Bahrain', NULL, 'Male', '15-24', '2022-02-25', 'active', '2022-02-25 10:58:07', '2022-02-25 10:58:07'),
(104, 'treasure', 0, 'Upload', 0, 'Manual', 'ie@gmail.com', 'Berlin', '8809230068', 'BY', 'Grodnenskaya', 'Belarus', NULL, 'Female', '15-24', '2022-02-25', 'active', '2022-02-25 11:03:18', '2022-02-25 10:58:07'),
(105, 'treasure', 0, 'Upload', 0, 'Manual', 'Sola@gmail.com', 'name', '+23481634412', 'BB', 'Saint Philip', 'Barbados', NULL, 'Male', '25-64', '2022-02-25', 'active', '2022-02-25 11:02:23', '2022-02-25 10:58:07'),
(106, 'treasure', 0, 'Upload', 0, 'Manual', 'my@gmail.com', 'myname', '901235678', 'BE', 'Brussels Capital', 'Belgium', NULL, 'Female', '15-24', '2022-02-25', 'trashed', '2022-02-25 11:43:25', '2022-02-25 10:58:07'),
(107, 'treasure', 0, 'Upload', 0, 'Manual', 'man@gmail.com', 'newname', '90909090', 'BY', 'Minsk', 'Belarus', NULL, 'Male', '15-24', '2022-02-25', 'trashed', '2022-02-25 11:43:02', '2022-02-25 10:58:41'),
(108, 'treasure', 0, 'Upload', 0, 'Manual', 'bol@gmail.com', 'bola', '808080', 'BE', 'Brussels Capital', 'Belgium', NULL, 'Male', '25-64', '2022-02-25', 'trashed', '2022-02-25 11:42:10', '2022-02-25 11:10:50'),
(109, 'bolatito', 0, 'Upload', 0, 'Manual', 'maki@gmail.com', 'my name', '09809879', 'NE', 'Zinder', 'Niger', NULL, 'Male', '15-24', '2022-06-03', 'active', '2022-06-03 02:32:59', '2022-06-03 02:32:59'),
(110, 'bolatito', 0, 'Upload', 0, 'Manual', 'fila@gmail.com', 'mila', '86657890', 'BH', 'Southern Governorate', 'Bahrain', NULL, 'Male', '25-64', '2022-06-03', 'active', '2022-06-03 02:33:01', '2022-06-03 02:33:01'),
(111, 'bolatito', 0, 'Upload', 0, 'Manual', 'Alima@gmail.com', 'Kemi Adams', '+234 8163490619', 'DZ', 'Jijel', 'Algeria', NULL, 'Male', '15-24', '2022-06-03', 'active', '2022-06-03 02:36:35', '2022-06-03 02:36:35'),
(112, 'Amaka', 0, 'Upload', 0, 'Manual', 'nono@gmail.com', 'name', '+1234', 'UA', 'Volyn', 'Ukraine', NULL, 'Male', '15-24', '2022-06-03', 'active', '2022-06-03 09:04:10', '2022-06-03 08:59:19'),
(113, 'Amaka', 0, 'Upload', 0, 'Manual', 'yh@gmail.com', 'Aminat', '456789', 'BY', 'Brest', 'Belarus', NULL, 'Male', '25-64', '2022-06-03', 'active', '2022-06-03 09:06:22', '2022-06-03 09:05:03');

-- --------------------------------------------------------

--
-- Table structure for table `poll_questions`
--

CREATE TABLE `poll_questions` (
  `sn` int(11) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `type` varchar(50) NOT NULL,
  `question` varchar(200) NOT NULL,
  `option_a` varchar(200) NOT NULL DEFAULT '',
  `option_b` varchar(200) NOT NULL DEFAULT '',
  `option_c` varchar(200) NOT NULL DEFAULT '',
  `option_d` varchar(200) NOT NULL DEFAULT '',
  `option_e` varchar(200) DEFAULT NULL,
  `question_img` varchar(50) DEFAULT NULL,
  `option_a_img` varchar(50) DEFAULT NULL,
  `option_b_img` varchar(50) DEFAULT NULL,
  `option_c_img` varchar(50) DEFAULT NULL,
  `option_d_img` varchar(50) DEFAULT NULL,
  `option_e_img` varchar(50) DEFAULT NULL,
  `status` varchar(20) NOT NULL,
  `time_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  `time_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `quiz_questions`
--

CREATE TABLE `quiz_questions` (
  `sn` int(11) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `type` varchar(50) NOT NULL COMMENT 'T/F, multi-option, no-option, ',
  `question` varchar(200) NOT NULL,
  `option_a` varchar(200) NOT NULL DEFAULT '',
  `option_b` varchar(200) NOT NULL DEFAULT '',
  `option_c` varchar(200) NOT NULL DEFAULT '',
  `option_d` varchar(200) NOT NULL DEFAULT '',
  `answer` varchar(200) NOT NULL,
  `question_img` varchar(50) DEFAULT NULL,
  `option_a_img` varchar(50) DEFAULT NULL,
  `option_b_img` varchar(50) DEFAULT NULL,
  `option_c_img` varchar(50) DEFAULT NULL,
  `option_d_img` varchar(50) DEFAULT NULL,
  `answer_img` varchar(50) DEFAULT NULL,
  `status` varchar(20) NOT NULL,
  `time_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  `time_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `site_features`
--

CREATE TABLE `site_features` (
  `sn` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `description` varchar(300) DEFAULT NULL,
  `status` enum('1','2') NOT NULL,
  `time_created` datetime NOT NULL,
  `time_modified` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `survey_questions`
--

CREATE TABLE `survey_questions` (
  `sn` int(11) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `type` varchar(50) NOT NULL,
  `question` varchar(200) NOT NULL,
  `question_img` varchar(50) DEFAULT NULL,
  `status` varchar(20) NOT NULL,
  `time_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  `time_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_auth`
--

CREATE TABLE `user_auth` (
  `sn` int(11) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `access_level` int(11) DEFAULT NULL,
  `user_type` varchar(50) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `hash` varchar(50) NOT NULL,
  `plan` varchar(20) NOT NULL COMMENT '''free'',''basic'',''gold'',''Diamond''',
  `verification_id` varchar(255) DEFAULT NULL,
  `verifircation_status` tinyint(1) DEFAULT 0 COMMENT '1,0',
  `status` varchar(30) NOT NULL DEFAULT 'registered' COMMENT '''registered'',''activated'',''awaiting_approval'',''verified'',''suspended'',''trashed''',
  `time_created` datetime NOT NULL,
  `time_modified` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_auth`
--

INSERT INTO `user_auth` (`sn`, `user_name`, `password`, `access_level`, `user_type`, `email`, `hash`, `plan`, `verification_id`, `verifircation_status`, `status`, `time_created`, `time_modified`) VALUES
(29, 'Joshua', '$2y$10$m5HeXtWxh7kU3NS/SZUe5uPt7YPjC/TcXIlSOAyrW1Bml.2gmoA/C', 0, 'client', 'jvine300@gmail.com', '45645a27c4f1adc8a7a835976064a86d', '', '17d63b1625c816c22647a73e1482372b', 0, 'registered', '2022-02-28 10:04:08', '2022-02-28 09:04:08'),
(55, 'treasure', '$2y$10$.4XgYgIklkbP6BocVXW7COPOb7PePxu.tD7LDI5nBLrKiHe5u09OW', 0, 'client', 'gtreasure162@gmail.com', 'fbd7939d674997cdb4692d34de8633c4', '', '2bb232c0b13c774965ef8558f0fbd615', 0, 'registered', '2022-03-02 10:50:12', '2022-03-02 09:50:12'),
(56, 'bolatito', '$2y$10$bje2ECBMcmwJdiu8Pl2UMemaRiUEBoAOmjoj5.ZC.OP5UEcS848fK', 0, 'client', 'rachaeladesolami1616@gmail.com', 'b337e84de8752b27eda3a12363109e80', '', '06997f04a7db92466a2baa6ebc8b872d', 1, 'registered', '2022-06-02 18:58:32', '2022-06-02 17:58:32'),
(57, 'clara', '$2y$10$JtShtAv.9UzG00Tlk.HYYuUJAjC4hOc3LjItQ6tZjRE1zhtYT5g4y', 0, 'client', 'vic650283@gmail.com', 'cb70ab375662576bd1ac5aaf16b3fca4', '', '70efdf2ec9b086079795c442636b55fb', 0, 'registered', '2022-06-03 07:16:46', '2022-06-03 06:16:46'),
(58, 'Amaka', '$2y$10$aclBpkRUyQWqd37Fa5AbJOrXvwY0D7TsoafwwXPvmulnz1EWANTTG', 0, 'client', 'ama@gmail.com', '2ca65f58e35d9ad45bf7f3ae5cfd08f1', '', 'b73dfe25b4b8714c029b37a6ad3006fa', 0, 'registered', '2022-06-03 07:21:31', '2022-06-03 06:21:31');

-- --------------------------------------------------------

--
-- Table structure for table `user_data`
--

CREATE TABLE `user_data` (
  `sn` int(11) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `image` varchar(250) DEFAULT NULL,
  `gender` char(1) DEFAULT NULL COMMENT '''m'',''f''',
  `dob` date DEFAULT NULL,
  `nationality` varchar(100) DEFAULT NULL,
  `phone_num` varchar(100) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `percentage_complete` int(3) NOT NULL DEFAULT 28,
  `status` varchar(30) NOT NULL DEFAULT 'active',
  `time_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `time_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_data`
--

INSERT INTO `user_data` (`sn`, `user_name`, `full_name`, `image`, `gender`, `dob`, `nationality`, `phone_num`, `email`, `percentage_complete`, `status`, `time_created`, `time_modified`) VALUES
(1, 'elpadjo', 'Dosubi Joshua', NULL, NULL, NULL, NULL, NULL, 'josserayz@gmail.com', 28, 'active', '2021-04-05 22:26:17', '2021-04-05 22:26:17'),
(2, 'treasure', 'treasure', NULL, NULL, NULL, NULL, NULL, 'gtreasure162@gmail.com', 28, 'active', '2021-12-06 09:53:34', '2021-12-06 09:53:34'),
(3, 'treasure', 'treasure', NULL, NULL, NULL, NULL, NULL, 'gtreasure162@gmail.com', 28, 'active', '2021-12-06 09:54:50', '2021-12-06 09:54:50'),
(4, 'treasure', 'treasure', NULL, NULL, NULL, NULL, NULL, 'gtreasure162@gmail.com', 28, 'active', '2021-12-06 11:32:48', '2021-12-06 11:32:48'),
(5, 'rachael', 'treasure', NULL, NULL, NULL, NULL, NULL, 'rachaeladesolami1616@gmail.com', 28, 'active', '2021-12-06 12:16:15', '2021-12-06 12:16:15'),
(6, 'tolumi', 'Tolu', NULL, NULL, NULL, NULL, NULL, 'rachaeladesolami1616@gmail.com', 28, 'active', '2021-12-09 10:59:49', '2021-12-09 10:59:49'),
(7, 'tolumi', 'Tolulope', NULL, NULL, NULL, NULL, NULL, 'rachaeladesolami1616@gmail.com', 28, 'active', '2021-12-09 11:03:02', '2021-12-09 11:03:02'),
(8, 'bolatini', 'treasure', NULL, NULL, NULL, NULL, NULL, 'olorunfunmilayoadesola@gmail.com', 28, 'active', '2021-12-13 12:33:10', '2021-12-13 12:33:10'),
(9, 'treasure', 'treasure', NULL, NULL, NULL, NULL, NULL, 'gtreasure162@gmail.com', 28, 'active', '2021-12-13 13:31:24', '2021-12-13 13:31:24'),
(10, 'trebo', 'treasure', NULL, NULL, NULL, NULL, NULL, 'rachaeladesolami1616@gmail.com', 28, 'active', '2021-12-13 13:32:56', '2021-12-13 13:32:56'),
(11, 'treasure', 'treasure', NULL, NULL, NULL, NULL, NULL, 'gtreasure162@gmail.com', 28, 'active', '2021-12-13 15:13:46', '2021-12-13 15:13:46'),
(12, 'monanai', 'treasure', NULL, NULL, NULL, NULL, NULL, 'rachaeladesolami1616@gmail.com', 28, 'active', '2021-12-13 15:20:25', '2021-12-13 15:20:25'),
(13, 'treasure', 'treasure', NULL, NULL, NULL, NULL, NULL, 'gtreasure162@gmail.com', 28, 'active', '2021-12-13 15:35:25', '2021-12-13 15:35:25'),
(14, 'adebola', 'name', NULL, NULL, NULL, NULL, NULL, 'name@gmail.com', 28, 'active', '2021-12-16 09:59:15', '2021-12-16 09:59:15'),
(15, 'kolintin', 'Kolinton', NULL, NULL, NULL, NULL, NULL, 'koin@gmail.com', 28, 'active', '2021-12-30 12:38:15', '2021-12-30 12:38:15'),
(16, 'bingo', 'bola', NULL, NULL, NULL, NULL, NULL, 'bo@gmail.com', 28, 'active', '2022-01-05 14:52:24', '2022-01-05 14:52:24'),
(17, 'eamily', 'name', NULL, NULL, NULL, NULL, NULL, 'naime@gmail.com', 28, 'active', '2022-01-06 13:50:03', '2022-01-06 13:50:03'),
(18, 'boluwade', 'name', NULL, NULL, NULL, NULL, NULL, 'me@gmail.com', 28, 'active', '2022-01-06 13:52:01', '2022-01-06 13:52:01'),
(19, 'treasure', 'treasure', NULL, NULL, NULL, NULL, NULL, 'gtreasure162@gmail.com', 28, 'active', '2022-02-25 11:55:31', '2022-02-25 11:55:31'),
(20, 'myname', 'name', NULL, NULL, NULL, NULL, NULL, 'rachaeladesolami1616@gmail.com', 28, 'active', '2022-02-25 12:01:10', '2022-02-25 12:01:10'),
(21, 'myname', 'name', NULL, NULL, NULL, NULL, NULL, 'rachaeladesolami1616@gmail.com', 28, 'active', '2022-02-25 12:11:52', '2022-02-25 12:11:52'),
(22, 'treatme', 'treatme', NULL, NULL, NULL, NULL, NULL, 'gtreasure162@gmail.com', 28, 'active', '2022-02-25 12:13:13', '2022-02-25 12:13:13'),
(23, 'treatme', 'treatme', NULL, NULL, NULL, NULL, NULL, 'gtreasure162@gmail.com', 28, 'active', '2022-02-25 12:24:55', '2022-02-25 12:24:55'),
(24, 'myname', 'mynae', NULL, NULL, NULL, NULL, NULL, 'gtreasure162@gmail.com', 28, 'active', '2022-02-25 12:43:55', '2022-02-25 12:43:55'),
(25, 'myname', 'my name', NULL, NULL, NULL, NULL, NULL, 'gtreasure162@gmail.com', 28, 'active', '2022-02-26 02:28:30', '2022-02-26 02:28:30'),
(26, 'myname', 'name', NULL, NULL, NULL, NULL, NULL, 'gtreasure162@gmail.com', 28, 'active', '2022-02-26 02:57:35', '2022-02-26 02:57:35'),
(27, 'rachael', 'thisname', NULL, NULL, NULL, NULL, NULL, 'rachaeladesolami1616@gmail.com', 28, 'active', '2022-02-28 08:55:57', '2022-02-28 08:55:57'),
(28, 'rachael', 'thisname', NULL, NULL, NULL, NULL, NULL, 'rachaeladesolami1616@gmail.com', 28, 'active', '2022-02-28 09:00:44', '2022-02-28 09:00:44'),
(29, 'Joshua', 'Joshua', NULL, NULL, NULL, NULL, NULL, 'jvine300@gmail.com', 28, 'active', '2022-02-28 09:04:08', '2022-02-28 09:04:08'),
(30, 'deborah', 'bolanle', NULL, NULL, NULL, NULL, NULL, 'rachaeladesola@gmail.com', 28, 'active', '2022-03-01 06:51:39', '2022-03-01 06:51:39'),
(31, 'treasure', 'bolanle', NULL, NULL, NULL, NULL, NULL, 'rachaeladesola@gmail.com', 28, 'active', '2022-03-01 06:54:10', '2022-03-01 06:54:10'),
(32, 'treasure', 'racahel Eniola', NULL, NULL, NULL, NULL, NULL, 'rachaeladesola@gmail.com', 28, 'active', '2022-03-01 06:58:34', '2022-03-01 06:58:34'),
(33, 'treasure', 'bola', NULL, NULL, NULL, NULL, NULL, 'rachaeladesola@gmail.com', 28, 'active', '2022-03-01 07:04:25', '2022-03-01 07:04:25'),
(34, 'treasure', 'newname', NULL, NULL, NULL, NULL, NULL, 'rachaeladesola@gmail.com', 28, 'active', '2022-03-01 07:08:28', '2022-03-01 07:08:28'),
(35, 'treasure', 'mynae', NULL, NULL, NULL, NULL, NULL, 'rachaeladesola@gmail.com', 28, 'active', '2022-03-01 07:11:05', '2022-03-01 07:11:05'),
(36, 'treasure', 'myname', NULL, NULL, NULL, NULL, NULL, 'rachaeladesola@gmail.com', 28, 'active', '2022-03-01 07:26:27', '2022-03-01 07:26:27'),
(37, 'treasure', 'treasure', NULL, NULL, NULL, NULL, NULL, 'rachaeladesola@gmail.com', 28, 'active', '2022-03-01 07:31:00', '2022-03-01 07:31:00'),
(38, 'treasure', 'treasure', NULL, NULL, NULL, NULL, NULL, 'rachaeladesola@gmail.com', 28, 'active', '2022-03-01 07:32:02', '2022-03-01 07:32:02'),
(39, 'treasure', 'treasure', NULL, NULL, NULL, NULL, NULL, 'rachaeladesola@gmail.com', 28, 'active', '2022-03-01 07:34:59', '2022-03-01 07:34:59'),
(40, 'treasure', 'treasure', NULL, NULL, NULL, NULL, NULL, 'rachaeladesola@gmail.com', 28, 'active', '2022-03-01 07:39:44', '2022-03-01 07:39:44'),
(41, 'treasure', 'myname', NULL, NULL, NULL, NULL, NULL, 'rachaeladesolami1616@gmail.com', 28, 'active', '2022-03-01 08:46:03', '2022-03-01 08:46:03'),
(42, 'deborah', 'debo', NULL, NULL, NULL, NULL, NULL, 'debbieoluwabunmi120@gmail.com', 28, 'active', '2022-03-01 08:55:08', '2022-03-01 08:55:08'),
(43, 'rachael', 'Rachael', NULL, NULL, NULL, NULL, NULL, 'gtreasure162@gmail.com', 28, 'active', '2022-03-02 03:46:08', '2022-03-02 03:46:08'),
(44, 'treasure', 'myname', NULL, NULL, NULL, NULL, NULL, 'gtreasure162@gmail.com', 28, 'active', '2022-03-02 03:53:33', '2022-03-02 03:53:33'),
(45, 'treasure', 'treasure', NULL, NULL, NULL, NULL, NULL, 'gtreasure162@gmail.com', 28, 'active', '2022-03-02 04:20:53', '2022-03-02 04:20:53'),
(46, 'debonak', 'Bebo', NULL, NULL, NULL, NULL, NULL, 'debbie123@gmai.com', 28, 'active', '2022-03-02 09:11:53', '2022-03-02 09:11:53'),
(47, 'debon12ak', 'Bebo', NULL, NULL, NULL, NULL, NULL, 'debbie12123@gmai.com', 28, 'active', '2022-03-02 09:13:18', '2022-03-02 09:13:18'),
(48, 'bolanleo', 'name', NULL, NULL, NULL, NULL, NULL, 'bola@mail.com', 28, 'active', '2022-03-02 09:18:35', '2022-03-02 09:18:35'),
(49, 'bolanle1o', 'name', NULL, NULL, NULL, NULL, NULL, 'bo12la@mail.com', 28, 'active', '2022-03-02 09:20:19', '2022-03-02 09:20:19'),
(50, 'kemisola', 'name', NULL, NULL, NULL, NULL, NULL, 'bola12@mail.com', 28, 'active', '2022-03-02 09:21:19', '2022-03-02 09:21:19'),
(51, 'elpnojo', 'name', NULL, NULL, NULL, NULL, NULL, 'bolmma@mail.com', 28, 'active', '2022-03-02 09:26:44', '2022-03-02 09:26:44'),
(52, 'treasure', 'treasure', NULL, NULL, NULL, NULL, NULL, 'gtreasure162@gmail.com', 28, 'active', '2022-03-02 09:29:06', '2022-03-02 09:29:06'),
(53, 'treasure', 'treasure', NULL, NULL, NULL, NULL, NULL, 'gtreasure162@gmail.com', 28, 'active', '2022-03-02 09:32:17', '2022-03-02 09:32:17'),
(54, 'treasure', 'treasure', NULL, NULL, NULL, NULL, NULL, 'gtreasure162@gmail.com', 28, 'active', '2022-03-02 09:42:07', '2022-03-02 09:42:07'),
(55, 'treasure', 'treasure', NULL, NULL, NULL, NULL, NULL, 'gtreasure162@gmail.com', 28, 'active', '2022-03-02 09:50:12', '2022-03-02 09:50:12'),
(56, 'bolatito', 'Tanimila', NULL, NULL, NULL, NULL, NULL, 'rachaeladesolami1616@gmail.com', 28, 'active', '2022-06-02 17:58:32', '2022-06-02 17:58:32'),
(57, 'clara', 'Clara', NULL, NULL, NULL, NULL, NULL, 'vic650283@gmail.com', 28, 'active', '2022-06-03 06:16:47', '2022-06-03 06:16:47'),
(58, 'Amaka', 'Amaka', NULL, NULL, NULL, NULL, NULL, 'ama@gmail.com', 28, 'active', '2022-06-03 06:21:31', '2022-06-03 06:21:31');

-- --------------------------------------------------------

--
-- Table structure for table `user_log`
--

CREATE TABLE `user_log` (
  `sn` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `logged_in` datetime NOT NULL,
  `logged_out` datetime NOT NULL,
  `time_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_plan`
--

CREATE TABLE `user_plan` (
  `sn` int(11) NOT NULL,
  `id` varchar(10) NOT NULL,
  `title` varchar(50) NOT NULL,
  `descr` varchar(200) NOT NULL,
  `price` int(11) NOT NULL,
  `status` varchar(20) NOT NULL,
  `time_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  `time_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_subscriptions`
--

CREATE TABLE `user_subscriptions` (
  `sn` int(11) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `plan_id` varchar(20) NOT NULL,
  `plan_startdate` date NOT NULL,
  `plan_enddate` date NOT NULL,
  `plan_gracedate` date NOT NULL,
  `plan_termination_date` date NOT NULL,
  `status` varchar(20) NOT NULL,
  `time_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  `time_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `campaigns`
--
ALTER TABLE `campaigns`
  ADD PRIMARY KEY (`sn`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`sn`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `countries` ADD FULLTEXT KEY `country_search_index` (`id`,`countryName`);

--
-- Indexes for table `feedback_responses`
--
ALTER TABLE `feedback_responses`
  ADD PRIMARY KEY (`sn`);

--
-- Indexes for table `feedback_tool`
--
ALTER TABLE `feedback_tool`
  ADD PRIMARY KEY (`sn`);

--
-- Indexes for table `leads`
--
ALTER TABLE `leads`
  ADD PRIMARY KEY (`sn`);

--
-- Indexes for table `poll_questions`
--
ALTER TABLE `poll_questions`
  ADD PRIMARY KEY (`sn`);

--
-- Indexes for table `quiz_questions`
--
ALTER TABLE `quiz_questions`
  ADD PRIMARY KEY (`sn`);

--
-- Indexes for table `site_features`
--
ALTER TABLE `site_features`
  ADD PRIMARY KEY (`sn`);

--
-- Indexes for table `survey_questions`
--
ALTER TABLE `survey_questions`
  ADD PRIMARY KEY (`sn`);

--
-- Indexes for table `user_auth`
--
ALTER TABLE `user_auth`
  ADD PRIMARY KEY (`sn`);

--
-- Indexes for table `user_data`
--
ALTER TABLE `user_data`
  ADD PRIMARY KEY (`sn`);

--
-- Indexes for table `user_log`
--
ALTER TABLE `user_log`
  ADD PRIMARY KEY (`sn`);

--
-- Indexes for table `user_plan`
--
ALTER TABLE `user_plan`
  ADD PRIMARY KEY (`sn`);

--
-- Indexes for table `user_subscriptions`
--
ALTER TABLE `user_subscriptions`
  ADD PRIMARY KEY (`sn`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `campaigns`
--
ALTER TABLE `campaigns`
  MODIFY `sn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `sn` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `feedback_responses`
--
ALTER TABLE `feedback_responses`
  MODIFY `sn` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `feedback_tool`
--
ALTER TABLE `feedback_tool`
  MODIFY `sn` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `leads`
--
ALTER TABLE `leads`
  MODIFY `sn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

--
-- AUTO_INCREMENT for table `poll_questions`
--
ALTER TABLE `poll_questions`
  MODIFY `sn` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quiz_questions`
--
ALTER TABLE `quiz_questions`
  MODIFY `sn` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `site_features`
--
ALTER TABLE `site_features`
  MODIFY `sn` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `survey_questions`
--
ALTER TABLE `survey_questions`
  MODIFY `sn` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_auth`
--
ALTER TABLE `user_auth`
  MODIFY `sn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `user_data`
--
ALTER TABLE `user_data`
  MODIFY `sn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `user_log`
--
ALTER TABLE `user_log`
  MODIFY `sn` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_plan`
--
ALTER TABLE `user_plan`
  MODIFY `sn` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_subscriptions`
--
ALTER TABLE `user_subscriptions`
  MODIFY `sn` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
