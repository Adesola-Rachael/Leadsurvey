-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 15, 2021 at 06:32 PM
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
(8, 'elpadjo', 'Create New Campaign 3', 'Create New Campaign Create New Campaign Create New Campaign', 10, 100, '24 May 2021', '02 Aug 2021', 'survey', '', 'not-started', '2021-05-24 18:47:50', '2021-05-14 17:41:31'),
(9, 'elpadjo', 'Create New Campaign 3', 'Create New Campaign Create New Campaign Create New Campaign', 10, 100, '24 May 2021', '02 Aug 2021', 'quiz', '', 'trashed', '2021-06-10 10:45:34', '2021-05-14 20:58:07'),
(10, 'elpadjo', 'Overview of the design with CSS 1', 'Create try', 1, 4, '14 May 2021', '21 May 2021', 'quiz', NULL, 'ongoing', '2021-05-24 18:47:30', '2021-05-14 21:29:01'),
(11, 'elpadjo', 'Create Edit Now 4', 'Create Edit Campaign  Create Edit Campaign', 8, 30, '14 May 2021', '09 Jul 2021', 'poll', '', 'ended', '2021-05-24 19:53:55', '2021-05-14 21:56:48'),
(12, 'elpadjo', 'vest into right now', 'Describe vest into right now', 3, 15, '15 May 2021', '05 Jun 2021', 'quiz', NULL, 'ongoing', '2021-05-24 18:48:25', '2021-05-15 14:56:07'),
(13, 'treasure', 'name', 'thios ia the description', 10, 3, '15 Dec 2021', '23 Feb 2022', 'quiz', '', 'not-started', '2021-12-15 13:18:55', '2021-12-15 13:18:55'),
(14, 'treasure', 'name', 'thios ia the description', 10, 3, '15 Dec 2021', '23 Feb 2022', 'quiz', '', 'not-started', '2021-12-15 13:18:58', '2021-12-15 13:18:58');

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
  `country_abbr` varchar(20) NOT NULL,
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
(1, 'elpadjo', 10, 'Best Campaign', 3, 'survey', 'josserayz@gmail.com', 'Dosubi Joshua', '08039211989', '', 'Lagos', 'Nigeria', '---', 'Male', '25-64', '2021-06-10', 'active', '2021-06-11 10:38:22', '2021-06-10 11:28:51'),
(2, 'elpadjo', 0, 'Upload', 0, 'Manual', 'padjomag@gmail.com', 'Padjo', '08036989654', '', 'Lagos State', 'Nigeria', NULL, 'Male', '15-24', '2021-06-11', 'active', '2021-06-12 13:28:00', '2021-06-11 17:39:00'),
(3, 'treasure', 0, 'Upload', 0, 'Manual', 'hit@gmail.com', 'Kings Hitman', '+23481225890', '', 'Abuja', 'Nigeria', NULL, 'Male', '25-64', '2021-12-13', 'trashed', '2021-12-13 08:37:25', '2021-12-13 08:07:50'),
(20, 'treasure', 0, 'Upload', 0, 'Manual', 'gtreasure162@gmail.com', 'treasure', '081635907111', '', 'Grodnenskaya', 'Belarus', NULL, 'Male', '<15', '2021-12-13', 'trashed', '2021-12-15 13:37:14', '2021-12-13 08:48:06'),
(21, 'treasure', 0, 'Upload', 0, 'Manual', 'gtreasur11e162@gmail.com', 'treasure', '0816359071111', '', 'Ondo', 'Nigeria', NULL, 'Male', '15-24', '2021-12-13', 'trashed', '2021-12-14 14:55:38', '2021-12-13 08:49:17'),
(22, 'elpadjo', 0, 'Upload', 0, 'Manual', 'rachaeladesolami1616@gmail.com', 'treasure', '000', '', 'Ondo', 'Nigeria', NULL, 'Male', '15-24', '2021-12-13', 'active', '2021-12-13 09:26:03', '2021-12-13 09:26:03'),
(23, 'treasure', 0, 'Upload', 0, 'Manual', 'bola@gmail.com', 'Tolu', '7787878', '', 'Kebbi', 'Nigeria', NULL, 'Male', '15-24', '2021-12-14', 'trashed', '2021-12-15 10:52:50', '2021-12-14 15:02:51'),
(24, 'treasure', 0, 'Upload', 0, 'Manual', 'tife@gmail.com', 'boluwatife', '123344433', '', 'ondo', 'Bahrain', NULL, 'Female', '15-24', '2021-12-14', 'trashed', '2021-12-15 10:52:51', '2021-12-14 17:53:13'),
(25, 'treasure', 0, 'Upload', 0, 'Manual', 'gtreasure@gmail.com', 'Lola', '+12345', '', 'ondo', 'Bahrain', NULL, 'Male', '15-24', '2021-12-15', 'trashed', '2021-12-15 13:37:14', '2021-12-15 09:28:18'),
(26, 'treasure', 0, 'Upload', 0, 'Manual', 'ko@gmail.com', 'Bolami', '+2348163590610', '', 'Benue', 'Nigeria', NULL, 'Male', '15-24', '2021-12-15', 'trashed', '2021-12-15 10:53:35', '2021-12-15 10:13:56'),
(27, 'treasure', 0, 'Upload', 0, 'Manual', 'ai45u@gmail.com', 'yisa', '4838743', 'BD', 'Rajshahi', 'Bangladesh', NULL, 'Male', '25-64', '2021-12-15', 'active', '2021-12-15 17:17:19', '2021-12-15 10:18:14'),
(28, 'treasure', 0, 'Upload', 0, 'Manual', 'tr@gmail.com', 'newe name', 'r453678865', '', 'Abseron', 'Azerbaijan', NULL, 'Male', '25-64', '2021-12-15', 'trashed', '2021-12-15 13:46:31', '2021-12-15 10:32:48'),
(29, 'treasure', 0, 'Upload', 0, 'Manual', 'helo@gmail.com', 'name', '111', '', 'Corozal', 'Belize', NULL, 'Male', '15-24', '2021-12-15', 'trashed', '2021-12-15 13:46:31', '2021-12-15 10:44:54'),
(30, 'treasure', 0, 'Upload', 0, 'Manual', 'maio@gmail.com', 'name', '12345', 'BD', 'Chittagong', 'Bangladesh', NULL, 'Female', '15-24', '2021-12-15', 'active', '2021-12-15 17:17:27', '2021-12-15 12:53:33'),
(31, 'treasure', 0, 'Upload', 0, 'Manual', 'mom@gmail.com', 'male', '334', 'BY', 'Minsk City', 'Belarus', NULL, 'Male', '25-64', '2021-12-15', 'active', '2021-12-15 17:17:35', '2021-12-15 12:55:23'),
(32, 'treasure', 0, 'Upload', 0, 'Manual', 'exam@gmail.com', 'name', '+1234', '', 'Brest', 'Belarus', NULL, 'Male', '15-24', '2021-12-15', 'active', '2021-12-15 13:00:31', '2021-12-15 13:00:31'),
(33, 'treasure', 0, 'Upload', 0, 'Manual', 'gre111a@gmail.com', 'Olanipekun', '081561123111', '', 'Niger', 'Aba', NULL, 'Female', '25-59', '2021-12-15', 'active', '2021-12-15 13:01:36', '2021-12-15 13:01:36'),
(34, 'treasure', 0, 'Upload', 0, 'Manual', 'aba@gmail.com', 'Olanipekun', '0815611123111', '', 'Niger', 'Moroco', NULL, 'Female', '15-24', '2021-12-15', 'active', '2021-12-15 13:01:36', '2021-12-15 13:01:36'),
(35, 'treasure', 0, 'Upload', 0, 'Manual', 'gtre162@gmail.com', 'treasure', '812430765', 'AU', 'Tasmania', 'Australia', NULL, 'Female', '25-64', '2021-12-15', 'active', '2021-12-15 17:17:48', '2021-12-15 13:01:36'),
(36, 'treasure', 0, 'Upload', 0, 'Manual', 'bob@gmail.com', 'Tolulope', '08156348709', '', 'kokoroko', 'Americal', NULL, 'Male', '25-64', '2021-12-15', 'active', '2021-12-15 13:01:36', '2021-12-15 13:01:36'),
(37, 'treasure', 0, 'Upload', 0, 'Manual', 'jola@gmail.com', 'treasure', '453535', '', 'Kebbi', 'Aba', NULL, 'Male', '15-24', '2021-12-15', 'active', '2021-12-15 13:01:36', '2021-12-15 13:01:36'),
(38, 'treasure', 0, 'Upload', 0, 'Manual', 'sure162@gmail.com', 'treasure', '0819071009878', '', 'Ondo', 'Nigeria', NULL, 'Female', '15-24', '2021-12-15', 'active', '2021-12-15 13:01:36', '2021-12-15 13:01:36'),
(39, 'treasure', 0, 'Upload', 0, 'Manual', 'bob89@gmail.com', 'treasure', '76876', '', 'Osun', 'Aba', NULL, 'Male', '15-24', '2021-12-15', 'active', '2021-12-15 13:01:36', '2021-12-15 13:01:36'),
(40, 'treasure', 0, 'Upload', 0, 'Manual', 'ab89oooa@gmail.com', 'treasure', '08169071', 'BE', 'Wallonia', 'Belgium', NULL, 'Female', '15-24', '2021-12-15', 'active', '2021-12-15 17:17:57', '2021-12-15 13:01:36'),
(41, 'treasure', 0, 'Upload', 0, 'Manual', 'g62@gmail.com', 'treasure', '0816357789789071', '', 'Ondo', 'Togo', NULL, 'Male', '15-24', '2021-12-15', 'active', '2021-12-15 13:01:36', '2021-12-15 13:01:36'),
(42, 'treasure', 0, 'Upload', 0, 'Manual', 'a.@gmail.com', 'male', '1234566', '', 'Saint Lucy', 'Barbados', NULL, 'Male', '25-64', '2021-12-15', 'active', '2021-12-15 13:14:25', '2021-12-15 13:14:25'),
(43, 'treasure', 0, 'Upload', 0, 'Manual', 'email@gmail.com', 'name', '12345098', '', 'Gomel', 'Belarus', NULL, 'Male', '15-24', '2021-12-15', 'active', '2021-12-15 13:30:13', '2021-12-15 13:30:13'),
(44, 'treasure', 0, 'Upload', 0, 'Manual', 'name@gmail.com', 'nmae', '123458978', '', 'Muharraq', 'Bahrain', NULL, 'Female', '25-64', '2021-12-15', 'active', '2021-12-15 15:16:11', '2021-12-15 15:16:11'),
(45, 'treasure', 0, 'Upload', 0, 'Manual', 'e@gmail.com', 'name', '123455678', 'BD', 'Sylhet', 'Bangladesh', NULL, 'Male', '15-24', '2021-12-15', 'active', '2021-12-15 17:18:05', '2021-12-15 15:51:04');

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
(1, 'elpadjo', '$2y$10$o035ZgAM17Bx4MFeYXSfuORF0LlAt/AZHvEQb7u./OOegFh8Vox82', 0, 'client', 'josserayz@gmail.com', '389bc7bb1e1c2a5e7e147703232a88f6', '', NULL, 0, 'registered', '2021-04-05 23:26:17', '2021-04-05 22:26:17'),
(13, 'treasure', '$2y$10$yp7J2qn.dseg50rXqHviRuN/hPu9B2Jbnw5ZMCHKbGorwYPx3Bp92', 0, 'client', 'gtreasure162@gmail.com', 'df7f28ac89ca37bf1abd2f6c184fe1cf', '', 'a597e50502f5ff68e3e25b9114205d4a', 1, 'registered', '2021-12-13 16:35:25', '2021-12-13 15:35:25');

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
(13, 'treasure', 'treasure', NULL, NULL, NULL, NULL, NULL, 'gtreasure162@gmail.com', 28, 'active', '2021-12-13 15:35:25', '2021-12-13 15:35:25');

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
  MODIFY `sn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

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
  MODIFY `sn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

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
  MODIFY `sn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `user_data`
--
ALTER TABLE `user_data`
  MODIFY `sn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

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
