-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 08, 2016 at 09:44 AM
-- Server version: 5.5.34
-- PHP Version: 5.4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `quizder`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_badge`
--

CREATE TABLE IF NOT EXISTS `tbl_badge` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text,
  `image` text,
  `criterium` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_badge`
--

INSERT INTO `tbl_badge` (`id`, `name`, `image`, `criterium`) VALUES
(1, '', '', '\r'),
(2, '', '', '\r');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_game`
--

CREATE TABLE IF NOT EXISTS `tbl_game` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `quiz_id` int(11) DEFAULT NULL,
  `player_id` int(11) DEFAULT NULL,
  `player_points` int(11) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `started_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `tbl_game`
--

INSERT INTO `tbl_game` (`id`, `quiz_id`, `player_id`, `player_points`, `rating`, `started_at`) VALUES
(1, 6, 1, 54, 5, '2016-02-05 07:47:15'),
(2, 2, 1, 60, 3, '2016-02-06 16:51:20'),
(3, 4, 3, 71, 5, '2016-02-08 13:20:12'),
(4, 2, 2, 38, 4, '2016-02-05 07:47:15'),
(5, 6, 1, 44, 4, '2016-02-06 16:51:20'),
(6, 2, 1, 30, 3, '2016-02-08 13:20:12'),
(7, 2, 1, 21, 4, '2016-02-05 07:47:15'),
(8, 3, 2, 80, 4, '2016-02-06 16:51:20'),
(9, 6, 2, 90, 5, '2016-02-08 13:20:12'),
(10, 2, 3, 100, 4, '2016-02-05 07:47:15');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_player`
--

CREATE TABLE IF NOT EXISTS `tbl_player` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text,
  `nick_name` text,
  `profile_picture` text,
  `email_address` text,
  `facebook_id` text,
  `google_id` text,
  `twitter_id` text,
  `gender` text,
  `date_of_birth` date DEFAULT NULL,
  `country` text,
  `membership_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=34 ;

--
-- Dumping data for table `tbl_player`
--

INSERT INTO `tbl_player` (`id`, `name`, `nick_name`, `profile_picture`, `email_address`, `facebook_id`, `google_id`, `twitter_id`, `gender`, `date_of_birth`, `country`, `membership_id`, `created_at`) VALUES
(1, 'Balint Kolosi', 'Kolo719', 'http://example.com/something/image.jpg', 'kolosi.balint@yahoo.com', 'kolosi.balint', NULL, '', 'male', '1989-06-19', 'HUN', 0, '2016-02-08 15:41:44'),
(2, 'John Doe', 'Doey', 'http://example.com/something/image.jpg', 'johndoe@gmail.com', '', NULL, '', 'male', '1992-11-27', 'USA', 0, '2016-02-08 15:41:47'),
(3, 'Mary Watson', 'Mary W', 'http://example.com/something/image.jpg', 'mwatson@hotmail.com', '', NULL, 'mary.watson20', 'female', '1980-12-12', 'CAN', 1, '2016-02-08 15:41:50');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_player_badge`
--

CREATE TABLE IF NOT EXISTS `tbl_player_badge` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `player_id` int(11) DEFAULT NULL,
  `badge_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tbl_player_badge`
--

INSERT INTO `tbl_player_badge` (`id`, `player_id`, `badge_id`, `created_at`) VALUES
(1, 2, 1, '2016-02-06 16:51:20'),
(2, 4, 2, '2016-02-08 13:20:12');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_quiz`
--

CREATE TABLE IF NOT EXISTS `tbl_quiz` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text,
  `description` text,
  `category` text,
  `time` int(11) DEFAULT NULL,
  `incorrect_image` text,
  `correct_image` text,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `tbl_quiz`
--

INSERT INTO `tbl_quiz` (`id`, `name`, `description`, `category`, `time`, `incorrect_image`, `correct_image`, `created_at`) VALUES
(1, 'Countries of Europe', '', 'Geography', 120, NULL, NULL, NULL),
(2, 'Countries of Asia', '', 'Geography', 120, NULL, NULL, NULL),
(3, 'Countries of Africa', '', 'Geography', 120, NULL, NULL, NULL),
(4, 'US states', '', 'Geography', 120, NULL, NULL, NULL),
(5, 'States of Germany', '', 'Geography', 45, NULL, NULL, NULL),
(6, 'Regions of Italy', '', 'Geography', 60, NULL, NULL, NULL),
(7, '25 most populous US cities', '', 'Geography', 75, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_quiz_answer`
--

CREATE TABLE IF NOT EXISTS `tbl_quiz_answer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `quiz_id` int(11) DEFAULT NULL,
  `correct_answer` int(11) DEFAULT NULL,
  `answer_image` text,
  `answer_text` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=441 ;

--
-- Dumping data for table `tbl_quiz_answer`
--

INSERT INTO `tbl_quiz_answer` (`id`, `quiz_id`, `correct_answer`, `answer_image`, `answer_text`) VALUES
(1, 1, 1, NULL, 'Albania'),
(2, 1, 1, NULL, 'Andorra'),
(3, 1, 1, NULL, 'Austria'),
(4, 1, 1, NULL, 'Belarus'),
(5, 1, 1, NULL, 'Belgium'),
(6, 1, 1, NULL, 'Bosnia and Herzegovina'),
(7, 1, 1, NULL, 'Bulgaria'),
(8, 1, 1, NULL, 'Croatia'),
(9, 1, 1, NULL, 'Cyprus'),
(10, 1, 1, NULL, 'Czech Republic'),
(11, 1, 1, NULL, 'Denmark'),
(12, 1, 1, NULL, 'Estonia'),
(13, 1, 1, NULL, 'Finland'),
(14, 1, 1, NULL, 'France'),
(15, 1, 1, NULL, 'Germany'),
(16, 1, 1, NULL, 'Greece'),
(17, 1, 1, NULL, 'Hungary'),
(18, 1, 1, NULL, 'Iceland'),
(19, 1, 1, NULL, 'Ireland'),
(20, 1, 1, NULL, 'Italy'),
(21, 1, 1, NULL, 'Latvia'),
(22, 1, 1, NULL, 'Liechtenstein'),
(23, 1, 1, NULL, 'Lithuania'),
(24, 1, 1, NULL, 'Luxembourg'),
(25, 1, 1, NULL, 'Macedonia'),
(26, 1, 1, NULL, 'Malta'),
(27, 1, 1, NULL, 'Moldova'),
(28, 1, 1, NULL, 'Monaco'),
(29, 1, 1, NULL, 'Montenegro'),
(30, 1, 1, NULL, 'Netherlands'),
(31, 1, 1, NULL, 'Norway'),
(32, 1, 1, NULL, 'Poland'),
(33, 1, 1, NULL, 'Portugal'),
(34, 1, 1, NULL, 'Romania'),
(35, 1, 1, NULL, 'San Marino'),
(36, 1, 1, NULL, 'Serbia'),
(37, 1, 1, NULL, 'Slovakia'),
(38, 1, 1, NULL, 'Slovenia'),
(39, 1, 1, NULL, 'Spain'),
(40, 1, 1, NULL, 'Sweden'),
(41, 1, 1, NULL, 'Switzerland'),
(42, 1, 1, NULL, 'Ukraine'),
(43, 1, 1, NULL, 'United Kingdom'),
(44, 1, 1, NULL, 'Vatican City'),
(45, 1, 1, NULL, 'Turkey'),
(46, 1, 0, NULL, 'Cameroon'),
(47, 1, 0, NULL, 'Chad'),
(48, 1, 0, NULL, 'Egypt'),
(49, 1, 0, NULL, 'Eritrea'),
(50, 1, 0, NULL, 'Gabon'),
(51, 1, 0, NULL, 'Gambia'),
(52, 1, 0, NULL, 'Ghana'),
(53, 1, 0, NULL, 'Guinea'),
(54, 1, 0, NULL, 'Ivory Coast'),
(55, 1, 0, NULL, 'Lesotho'),
(56, 1, 0, NULL, 'Malawi'),
(57, 1, 0, NULL, 'Mali'),
(58, 1, 0, NULL, 'Morocco'),
(59, 1, 0, NULL, 'Rwanda'),
(60, 1, 0, NULL, 'Senegal'),
(61, 1, 0, NULL, 'Togo'),
(62, 1, 0, NULL, 'Tunisia'),
(63, 1, 0, NULL, 'Bahrain'),
(64, 1, 0, NULL, 'Bhutan'),
(65, 1, 0, NULL, 'Myanmar'),
(66, 1, 0, NULL, 'Israel'),
(67, 1, 0, NULL, 'Jordan'),
(68, 1, 0, NULL, 'Kyrgyzstan'),
(69, 1, 0, NULL, 'Nepal'),
(70, 1, 0, NULL, 'Vietnam'),
(71, 1, 0, NULL, 'Yemen'),
(72, 1, 0, NULL, 'Russia'),
(73, 1, 0, NULL, 'Angola'),
(74, 1, 0, NULL, 'Syria'),
(75, 1, 0, NULL, 'Brunei'),
(76, 1, 0, NULL, 'Iran'),
(77, 1, 0, NULL, 'Bangladesh'),
(78, 1, 0, NULL, 'Oman'),
(79, 1, 0, NULL, 'Philippines'),
(80, 1, 0, NULL, 'Uganda'),
(81, 2, 1, NULL, 'Afghanistan'),
(82, 2, 1, NULL, 'Bahrain'),
(83, 2, 1, NULL, 'Bangladesh'),
(84, 2, 1, NULL, 'Bhutan'),
(85, 2, 1, NULL, 'Brunei'),
(86, 2, 1, NULL, 'Burma (Myanmar)'),
(87, 2, 1, NULL, 'Cambodia'),
(88, 2, 1, NULL, 'China'),
(89, 2, 1, NULL, 'East Timor'),
(90, 2, 1, NULL, 'India'),
(91, 2, 1, NULL, 'Indonesia'),
(92, 2, 1, NULL, 'Iran'),
(93, 2, 1, NULL, 'Iraq'),
(94, 2, 1, NULL, 'Israel'),
(95, 2, 1, NULL, 'Japan'),
(96, 2, 1, NULL, 'Jordan'),
(97, 2, 1, NULL, 'Kazakhstan'),
(98, 2, 1, NULL, 'North Korea'),
(99, 2, 1, NULL, 'South Korea'),
(100, 2, 1, NULL, 'Kuwait'),
(101, 2, 1, NULL, 'Kyrgyzstan'),
(102, 2, 1, NULL, 'Laos'),
(103, 2, 1, NULL, 'Lebanon'),
(104, 2, 1, NULL, 'Malaysia'),
(105, 2, 1, NULL, 'Maldives'),
(106, 2, 1, NULL, 'Mongolia'),
(107, 2, 1, NULL, 'Nepal'),
(108, 2, 1, NULL, 'Oman'),
(109, 2, 1, NULL, 'Pakistan'),
(110, 2, 1, NULL, 'Philippines'),
(111, 2, 1, NULL, 'Qatar'),
(112, 2, 1, NULL, 'Russian Federation'),
(113, 2, 1, NULL, 'Saudi Arabia'),
(114, 2, 1, NULL, 'Singapore'),
(115, 2, 1, NULL, 'Sri Lanka'),
(116, 2, 1, NULL, 'Syria'),
(117, 2, 1, NULL, 'Tajikistan'),
(118, 2, 1, NULL, 'Thailand'),
(119, 2, 1, NULL, 'Turkey'),
(120, 2, 1, NULL, 'Turkmenistan'),
(121, 2, 1, NULL, 'United Arab Emirates'),
(122, 2, 1, NULL, 'Uzbekistan'),
(123, 2, 1, NULL, 'Vietnam'),
(124, 2, 1, NULL, 'Yemen'),
(125, 2, 0, NULL, 'Albania'),
(126, 2, 0, NULL, 'Belarus'),
(127, 2, 0, NULL, 'Bosnia and Herzegovina'),
(128, 2, 0, NULL, 'Cyprus'),
(129, 2, 0, NULL, 'Estonia'),
(130, 2, 0, NULL, 'Latvia'),
(131, 2, 0, NULL, 'Macedonia'),
(132, 2, 0, NULL, 'Moldova'),
(133, 2, 0, NULL, 'Montenegro'),
(134, 2, 0, NULL, 'Netherlands'),
(135, 2, 0, NULL, 'Serbia'),
(136, 2, 0, NULL, 'Barbados'),
(137, 2, 0, NULL, 'Belize'),
(138, 2, 0, NULL, 'Grenada'),
(139, 2, 0, NULL, 'Trinidad and Tobago'),
(140, 2, 0, NULL, 'Honduras'),
(141, 2, 0, NULL, 'Nauru'),
(142, 2, 0, NULL, 'Palau'),
(143, 2, 0, NULL, 'Kiribati'),
(144, 2, 0, NULL, 'Guyana'),
(145, 2, 0, NULL, 'Suriname'),
(146, 2, 0, NULL, 'Saint Lucia'),
(147, 2, 0, NULL, 'Botswana'),
(148, 2, 0, NULL, 'Chad'),
(149, 2, 0, NULL, 'Eritrea'),
(150, 2, 0, NULL, 'Gambia'),
(151, 2, 0, NULL, 'Ivory Coast'),
(152, 2, 0, NULL, 'Lesotho'),
(153, 2, 0, NULL, 'Liberia'),
(154, 2, 0, NULL, 'Libya'),
(155, 2, 0, NULL, 'Morocco'),
(156, 2, 0, NULL, 'Rwanda'),
(157, 2, 0, NULL, 'Somalia'),
(158, 2, 0, NULL, 'Togo'),
(159, 2, 0, NULL, 'Uganda'),
(160, 2, 0, NULL, 'Zambia'),
(161, 3, 1, NULL, 'Algeria'),
(162, 3, 1, NULL, 'Angola'),
(163, 3, 1, NULL, 'Benin'),
(164, 3, 1, NULL, 'Botswana'),
(165, 3, 1, NULL, 'Burkina'),
(166, 3, 1, NULL, 'Burundi'),
(167, 3, 1, NULL, 'Cameroon'),
(168, 3, 1, NULL, 'Cape Verde'),
(169, 3, 1, NULL, 'Central African Republic'),
(170, 3, 1, NULL, 'Chad'),
(171, 3, 1, NULL, 'Comoros'),
(172, 3, 1, NULL, 'Congo'),
(173, 3, 1, NULL, 'Congo, Democratic Republic of'),
(174, 3, 1, NULL, 'Djibouti'),
(175, 3, 1, NULL, 'Egypt'),
(176, 3, 1, NULL, 'Equatorial Guinea'),
(177, 3, 1, NULL, 'Eritrea'),
(178, 3, 1, NULL, 'Ethiopia'),
(179, 3, 1, NULL, 'Gabon'),
(180, 3, 1, NULL, 'Gambia'),
(181, 3, 1, NULL, 'Ghana'),
(182, 3, 1, NULL, 'Guinea'),
(183, 3, 1, NULL, 'Guinea-Bissau'),
(184, 3, 1, NULL, 'Ivory Coast'),
(185, 3, 1, NULL, 'Kenya'),
(186, 3, 1, NULL, 'Lesotho'),
(187, 3, 1, NULL, 'Liberia'),
(188, 3, 1, NULL, 'Libya'),
(189, 3, 1, NULL, 'Madagascar'),
(190, 3, 1, NULL, 'Malawi'),
(191, 3, 1, NULL, 'Mali'),
(192, 3, 1, NULL, 'Mauritania'),
(193, 3, 1, NULL, 'Mauritius'),
(194, 3, 1, NULL, 'Morocco'),
(195, 3, 1, NULL, 'Mozambique'),
(196, 3, 1, NULL, 'Namibia'),
(197, 3, 1, NULL, 'Niger'),
(198, 3, 1, NULL, 'Nigeria'),
(199, 3, 1, NULL, 'Rwanda'),
(200, 3, 1, NULL, 'Sao Tome and Principe'),
(201, 3, 1, NULL, 'Senegal'),
(202, 3, 1, NULL, 'Seychelles'),
(203, 3, 1, NULL, 'Sierra Leone'),
(204, 3, 1, NULL, 'Somalia'),
(205, 3, 1, NULL, 'South Africa'),
(206, 3, 1, NULL, 'South Sudan'),
(207, 3, 1, NULL, 'Sudan'),
(208, 3, 1, NULL, 'Swaziland'),
(209, 3, 1, NULL, 'Tanzania'),
(210, 3, 1, NULL, 'Togo'),
(211, 3, 1, NULL, 'Tunisia'),
(212, 3, 1, NULL, 'Uganda'),
(213, 3, 1, NULL, 'Zambia'),
(214, 3, 1, NULL, 'Zimbabwe'),
(215, 3, 0, NULL, 'Antigua and Barbuda'),
(216, 3, 0, NULL, 'Belize'),
(217, 3, 0, NULL, 'Dominica'),
(218, 3, 0, NULL, 'Guatemala'),
(219, 3, 0, NULL, 'Nicaragua'),
(220, 3, 0, NULL, 'Saint Lucia'),
(221, 3, 0, NULL, 'Trinidad and Tobago'),
(222, 3, 0, NULL, 'Kiribati'),
(223, 3, 0, NULL, 'Nauru'),
(224, 3, 0, NULL, 'Palau'),
(225, 3, 0, NULL, 'Samoa'),
(226, 3, 0, NULL, 'Tonga'),
(227, 3, 0, NULL, 'Belarus'),
(228, 3, 0, NULL, 'Croatia'),
(229, 3, 0, NULL, 'Estonia'),
(230, 3, 0, NULL, 'Latvia'),
(231, 3, 0, NULL, 'Malta'),
(232, 3, 0, NULL, 'Monaco'),
(233, 3, 0, NULL, 'Bahrain'),
(234, 3, 0, NULL, 'East Timor'),
(235, 3, 0, NULL, 'Kazakhstan'),
(236, 3, 0, NULL, 'Lebanon'),
(237, 3, 0, NULL, 'Oman'),
(238, 3, 0, NULL, 'Qatar'),
(239, 3, 0, NULL, 'Tajikistan'),
(240, 3, 0, NULL, 'Syria'),
(241, 4, 1, NULL, 'Alabama'),
(242, 4, 1, NULL, 'Alaska'),
(243, 4, 1, NULL, 'Arizona'),
(244, 4, 1, NULL, 'Arkansas'),
(245, 4, 1, NULL, 'California'),
(246, 4, 1, NULL, 'Colorado'),
(247, 4, 1, NULL, 'Connecticut'),
(248, 4, 1, NULL, 'Delaware'),
(249, 4, 1, NULL, 'Florida'),
(250, 4, 1, NULL, 'Georgia'),
(251, 4, 1, NULL, 'Hawaii'),
(252, 4, 1, NULL, 'Idaho'),
(253, 4, 1, NULL, 'Illinois'),
(254, 4, 1, NULL, 'Indiana'),
(255, 4, 1, NULL, 'Iowa'),
(256, 4, 1, NULL, 'Kansas'),
(257, 4, 1, NULL, 'Kentucky'),
(258, 4, 1, NULL, 'Louisiana'),
(259, 4, 1, NULL, 'Maine'),
(260, 4, 1, NULL, 'Maryland'),
(261, 4, 1, NULL, 'Massachusetts'),
(262, 4, 1, NULL, 'Michigan'),
(263, 4, 1, NULL, 'Minnesota'),
(264, 4, 1, NULL, 'Mississippi'),
(265, 4, 1, NULL, 'Missouri'),
(266, 4, 1, NULL, 'Montana'),
(267, 4, 1, NULL, 'Nebraska'),
(268, 4, 1, NULL, 'Nevada'),
(269, 4, 1, NULL, 'New Hampshire'),
(270, 4, 1, NULL, 'New Jersey'),
(271, 4, 1, NULL, 'New Mexico'),
(272, 4, 1, NULL, 'New York'),
(273, 4, 1, NULL, 'North Carolina'),
(274, 4, 1, NULL, 'North Dakota'),
(275, 4, 1, NULL, 'Ohio'),
(276, 4, 1, NULL, 'Oklahoma'),
(277, 4, 1, NULL, 'Oregon'),
(278, 4, 1, NULL, 'Pennsylvania'),
(279, 4, 1, NULL, 'Rhode Island'),
(280, 4, 1, NULL, 'South Carolina'),
(281, 4, 1, NULL, 'South Dakota'),
(282, 4, 1, NULL, 'Tennessee'),
(283, 4, 1, NULL, 'Texas'),
(284, 4, 1, NULL, 'Utah'),
(285, 4, 1, NULL, 'Vermont'),
(286, 4, 1, NULL, 'Virginia'),
(287, 4, 1, NULL, 'Washington'),
(288, 4, 1, NULL, 'West Virginia'),
(289, 4, 1, NULL, 'Wisconsin'),
(290, 4, 1, NULL, 'Wyoming'),
(291, 4, 0, NULL, 'Samoa'),
(292, 4, 0, NULL, 'Guam'),
(293, 4, 0, NULL, 'Puerto Rico'),
(294, 4, 0, NULL, 'Quebec'),
(295, 4, 0, NULL, 'Nova Scotia'),
(296, 4, 0, NULL, 'New Brunswick'),
(297, 4, 0, NULL, 'Manitoba'),
(298, 4, 0, NULL, 'British Columbia'),
(299, 4, 0, NULL, 'Prince Edward Island'),
(300, 4, 0, NULL, 'Saskatchewan'),
(301, 4, 0, NULL, 'Alberta'),
(302, 4, 0, NULL, 'Newfoundland and Labrador'),
(303, 4, 0, NULL, 'Calisota'),
(304, 4, 0, NULL, 'Coventry'),
(305, 4, 0, NULL, 'North Montana'),
(306, 4, 0, NULL, 'Ames'),
(307, 4, 0, NULL, 'Midlands'),
(308, 4, 0, NULL, 'Fremont'),
(309, 4, 0, NULL, 'Michisota'),
(310, 4, 0, NULL, 'Mickewa'),
(311, 4, 0, NULL, 'Oconee'),
(312, 4, 0, NULL, 'Pennsyltucky'),
(313, 4, 0, NULL, 'Washagon'),
(314, 4, 0, NULL, 'New Guernsey'),
(315, 4, 0, NULL, 'Bikini Bottom'),
(316, 4, 0, NULL, 'New Delaware'),
(317, 4, 0, NULL, 'Wichita'),
(318, 4, 0, NULL, 'New Temperance'),
(319, 4, 0, NULL, 'San Andreas'),
(320, 4, 0, NULL, 'Panem'),
(321, 5, 1, NULL, 'Baden-Württemberg'),
(322, 5, 1, NULL, 'Bremen'),
(323, 5, 1, NULL, 'Mecklenburg-Western Pomerania'),
(324, 5, 1, NULL, 'Saxony'),
(325, 5, 1, NULL, 'Bavaria'),
(326, 5, 1, NULL, 'Hamburg'),
(327, 5, 1, NULL, 'North Rhine-Westphalia'),
(328, 5, 1, NULL, 'Saxony-Anhalt'),
(329, 5, 1, NULL, 'Berlin'),
(330, 5, 1, NULL, 'Hesse'),
(331, 5, 1, NULL, 'Rhineland-Palatinate'),
(332, 5, 1, NULL, 'Schleswig-Holstein'),
(333, 5, 1, NULL, 'Brandenburg'),
(334, 5, 1, NULL, 'Lower Saxony'),
(335, 5, 1, NULL, 'Saarland'),
(336, 5, 1, NULL, 'Thuringia'),
(337, 5, 0, NULL, 'Burgenland'),
(338, 5, 0, NULL, 'Kärnten '),
(339, 5, 0, NULL, 'Niederösterreich '),
(340, 5, 0, NULL, 'Oberösterreich '),
(341, 5, 0, NULL, 'Salzburg '),
(342, 5, 0, NULL, 'Steiermark '),
(343, 5, 0, NULL, 'Tirol '),
(344, 5, 0, NULL, 'Vorarlberg '),
(345, 5, 0, NULL, 'Limburg'),
(346, 5, 0, NULL, 'Walloon Brabant'),
(347, 5, 0, NULL, 'Hainaut'),
(348, 5, 0, NULL, 'Gelderland'),
(349, 5, 0, NULL, 'Freisland'),
(350, 5, 0, NULL, 'Groningen'),
(351, 6, 1, NULL, 'Abruzzo'),
(352, 6, 1, NULL, 'Aosta Valley'),
(353, 6, 1, NULL, 'Apulia'),
(354, 6, 1, NULL, 'Basilicata'),
(355, 6, 1, NULL, 'Calabria'),
(356, 6, 1, NULL, 'Campania'),
(357, 6, 1, NULL, 'Emilia Romagna'),
(358, 6, 1, NULL, 'Friuli Venezia Giulia'),
(359, 6, 1, NULL, 'Lazio'),
(360, 6, 1, NULL, 'Liguria'),
(361, 6, 1, NULL, 'Lombardy'),
(362, 6, 1, NULL, 'Marche'),
(363, 6, 1, NULL, 'Molise'),
(364, 6, 1, NULL, 'Piedmont'),
(365, 6, 1, NULL, 'Sardinia'),
(366, 6, 1, NULL, 'Sicily'),
(367, 6, 1, NULL, 'Trentino-Alto Adige'),
(368, 6, 1, NULL, 'Tuscany'),
(369, 6, 1, NULL, 'Umbria'),
(370, 6, 1, NULL, 'Veneto'),
(371, 6, 0, NULL, 'Catalonia'),
(372, 6, 0, NULL, 'Valencia'),
(373, 6, 0, NULL, 'Murcia'),
(374, 6, 0, NULL, 'Galicia'),
(375, 6, 0, NULL, 'Ceuta'),
(376, 6, 0, NULL, 'Corsica'),
(377, 6, 0, NULL, 'Monaco'),
(378, 6, 0, NULL, 'San Marino'),
(379, 6, 0, NULL, 'Vatican'),
(380, 6, 0, NULL, 'Malta'),
(381, 6, 0, NULL, 'Firenze'),
(382, 6, 0, NULL, 'Bologna'),
(383, 6, 0, NULL, 'Milano'),
(384, 6, 0, NULL, 'Napoli'),
(385, 6, 0, NULL, 'Gorizia'),
(386, 6, 0, NULL, 'Trieste'),
(387, 6, 0, NULL, 'Geneva'),
(388, 6, 0, NULL, 'Ticino'),
(389, 6, 0, NULL, 'Valais'),
(390, 6, 0, NULL, 'Monza'),
(391, 7, 1, NULL, 'New York'),
(392, 7, 1, NULL, 'Los Angeles'),
(393, 7, 1, NULL, 'Chicago'),
(394, 7, 1, NULL, 'Houston'),
(395, 7, 1, NULL, 'Philadelphia'),
(396, 7, 1, NULL, 'Phoenix'),
(397, 7, 1, NULL, 'San Antonio'),
(398, 7, 1, NULL, 'San Diego'),
(399, 7, 1, NULL, 'Dallas'),
(400, 7, 1, NULL, 'San Jose'),
(401, 7, 1, NULL, 'Austin'),
(402, 7, 1, NULL, 'Jacksonville'),
(403, 7, 1, NULL, 'San Francisco'),
(404, 7, 1, NULL, 'Indianapolis'),
(405, 7, 1, NULL, 'Columbus'),
(406, 7, 1, NULL, 'Fort Worth'),
(407, 7, 1, NULL, 'Charlotte'),
(408, 7, 1, NULL, 'Detroit'),
(409, 7, 1, NULL, 'El Paso'),
(410, 7, 1, NULL, 'Seattle'),
(411, 7, 1, NULL, 'Denver'),
(412, 7, 1, NULL, 'Washington'),
(413, 7, 1, NULL, 'Memphis'),
(414, 7, 1, NULL, 'Boston'),
(415, 7, 1, NULL, 'Nashville'),
(416, 7, 0, NULL, 'Baltimore'),
(417, 7, 0, NULL, 'Oklahoma City'),
(418, 7, 0, NULL, 'Portland'),
(419, 7, 0, NULL, 'Las Vegas'),
(420, 7, 0, NULL, 'Louisville'),
(421, 7, 0, NULL, 'Milwaukee'),
(422, 7, 0, NULL, 'Albuquerque'),
(423, 7, 0, NULL, 'Tucson'),
(424, 7, 0, NULL, 'Fresno'),
(425, 7, 0, NULL, 'Sacramento'),
(426, 7, 0, NULL, 'Long Beach'),
(427, 7, 0, NULL, 'Kansas City'),
(428, 7, 0, NULL, 'Mesa'),
(429, 7, 0, NULL, 'Atlanta'),
(430, 7, 0, NULL, 'Virginia Beach'),
(431, 7, 0, NULL, 'Omaha'),
(432, 7, 0, NULL, 'Colorado Springs'),
(433, 7, 0, NULL, 'Raleigh'),
(434, 7, 0, NULL, 'Miami'),
(435, 7, 0, NULL, 'Oakland'),
(436, 7, 0, NULL, 'Minneapolis'),
(437, 7, 0, NULL, 'Tulsa'),
(438, 7, 0, NULL, 'Cleveland'),
(439, 7, 0, NULL, 'Wichita'),
(440, 7, 0, NULL, 'Arlington');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_quiz_answers_given`
--

CREATE TABLE IF NOT EXISTS `tbl_quiz_answers_given` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `game_id` int(11) DEFAULT NULL,
  `answer_id` int(11) DEFAULT NULL,
  `given_answer` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=64 ;

--
-- Dumping data for table `tbl_quiz_answers_given`
--

INSERT INTO `tbl_quiz_answers_given` (`id`, `game_id`, `answer_id`, `given_answer`) VALUES
(33, 1, 1, 0),
(34, 1, 2, 1),
(35, 1, 3, 0),
(36, 1, 4, 0),
(37, 1, 5, 1),
(38, 1, 6, 0),
(39, 1, 7, 1),
(40, 1, 8, 0),
(41, 1, 9, 0),
(42, 1, 10, 0),
(43, 1, 11, 1),
(44, 1, 12, 1),
(45, 1, 13, 0),
(46, 1, 14, 1),
(47, 1, 15, 1),
(48, 1, 16, 0),
(49, 1, 17, 0),
(50, 1, 18, 0),
(51, 1, 19, 0),
(52, 1, 20, 0),
(53, 1, 21, 0),
(54, 1, 22, 0),
(55, 1, 23, 0),
(56, 1, 24, 1),
(57, 1, 25, 0),
(58, 1, 26, 0),
(59, 1, 27, 0),
(60, 1, 28, 0),
(61, 1, 29, 1),
(62, 1, 30, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
