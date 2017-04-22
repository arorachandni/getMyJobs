-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 30, 2016 at 01:29 PM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `orberadmin`
--

-- --------------------------------------------------------

--
-- Table structure for table `jobs_admins`
--

CREATE TABLE `jobs_admins` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `mobile_number` varchar(255) NOT NULL,
  `created` date NOT NULL,
  `modified` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jobs_admins`
--

INSERT INTO `jobs_admins` (`id`, `first_name`, `last_name`, `username`, `email`, `password`, `mobile_number`, `created`, `modified`) VALUES
(1, 'Master', 'Admin', 'admin', 'admintest@gmail.com', 'db55655fe83311eb722f82941b9f0ffeec2e4b6b', '9688855858', '0000-00-00', '2016-06-21');

-- --------------------------------------------------------

--
-- Table structure for table `jobs_answers`
--

CREATE TABLE `jobs_answers` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `question_id` int(11) DEFAULT NULL,
  `answer` text,
  `created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `jobs_categories`
--

CREATE TABLE `jobs_categories` (
  `id` int(11) NOT NULL,
  `name_eng` varchar(255) DEFAULT NULL,
  `name_ch` text CHARACTER SET utf8,
  `status` int(1) NOT NULL DEFAULT '1',
  `created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jobs_categories`
--

INSERT INTO `jobs_categories` (`id`, `name_eng`, `name_ch`, `status`, `created`) VALUES
(1, 'Acne', '\n粉刺', 1, '0000-00-00'),
(2, 'Anti-Agign', '反Agign', 1, '0000-00-00'),
(3, 'Rash&Itch', '皮疹瘙癢及', 1, '0000-00-00'),
(4, 'Dandruff', '頭皮', 1, '0000-00-00'),
(5, 'Skin Discoloration', '\n皮膚變色', 1, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `jobs_cms_pages`
--

CREATE TABLE `jobs_cms_pages` (
  `id` int(11) NOT NULL,
  `page_name` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description_eng` text,
  `description_ch` text,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0=>''Inactive'',1=>''Active''',
  `created` date NOT NULL,
  `modified` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jobs_cms_pages`
--

INSERT INTO `jobs_cms_pages` (`id`, `page_name`, `alias`, `title`, `description_eng`, `description_ch`, `status`, `created`, `modified`) VALUES
(1, 'About Us', 'ABOUT', 'About Company', '<p>Vestibulum rutrum, lectus non aliquam&nbsp; malesuada, tellus velit faucibus neque, id ultrices ante eros venenatis&nbsp; velit. Proin adipiscing rhoncus eros, at vulputate mauris consequat ut.&nbsp; In volutpat neque massa, at porttitor sapien porta bibendum. Donec&nbsp; tincidunt nec ipsum sed aliquam. Curabitur auctor pretium Vestibulum&nbsp; rutrum, lectus non aliquam malesuada, tellus velit faucibus neque, id&nbsp; ultrices ante eros venenatis velit. Proin adipiscing rhoncus eros, at&nbsp; vulputate mauris consequat ut. In volutpat neque massa, at porttitor&nbsp; sapien porta bibendum. Donec tincidunt nec ipsum sed aliquam. Curabitur&nbsp; auctor pretium Vestibulum rutrum, lectus non aliquam malesuada, tellus&nbsp; velit faucibus neque, id ultrices ante eros venenatis velit. Proin&nbsp; adipiscing rhoncus eros, at vulputate mauris consequat ut. In volutpat&nbsp; neque massa, at porttitor sapien porta.Vestibulum rutrum, lectus non&nbsp; aliquam malesuada, tellus velit faucibus.</p>\n<p>Vestibulum rutrum, lectus non aliquam malesuada, tellus velit faucibus neque, id ultrices ante eros venenatis velit. Proin adipiscing rhoncus eros, at vulputate mauris consequat ut. In volutpat neque massa, at porttitor sapien porta bibendum. Donec tincidunt nec ipsum sed aliquam. Curabitur auctor pretium Vestibulum rutrum, lectus non aliquam malesuada, tellus velit faucibus neque, id ultrices ante eros venenatis velit. Proin adipiscing rhoncus eros, at vulputate mauris consequat ut.</p>', NULL, 1, '0000-00-00', '2016-05-31'),
(2, 'Terms & Conditions', 'TERMS', 'Terms & Conditions', '<p>Vestibulum rutrum, lectus non aliquam&nbsp; malesuada, tellus velit faucibus neque, id ultrices ante eros venenatis&nbsp; velit. Proin adipiscing rhoncus eros, at vulputate mauris consequat ut.&nbsp; In volutpat neque massa, at porttitor sapien porta bibendum. Donec&nbsp; tincidunt nec ipsum sed aliquam. Curabitur auctor pretium Vestibulum&nbsp; rutrum, lectus non aliquam malesuada, tellus velit faucibus neque, id&nbsp; ultrices ante eros venenatis velit. Proin adipiscing rhoncus eros, at&nbsp; vulputate mauris consequat ut. In volutpat neque massa, at porttitor&nbsp; sapien porta bibendum. Donec tincidunt nec ipsum sed aliquam. Curabitur&nbsp; auctor pretium Vestibulum rutrum, lectus non aliquam malesuada, tellus&nbsp; velit faucibus neque, id ultrices ante eros venenatis velit. Proin&nbsp; adipiscing rhoncus eros, at vulputate mauris consequat ut. In volutpat&nbsp; neque massa, at porttitor sapien porta.Vestibulum rutrum, lectus non&nbsp; aliquam malesuada, tellus velit faucibus.</p>\n<p>Vestibulum rutrum, lectus non aliquam malesuada, tellus velit faucibus neque, id ultrices ante eros venenatis velit. Proin adipiscing rhoncus eros, at vulputate mauris consequat ut. In volutpat neque massa, at porttitor sapien porta bibendum. Donec tincidunt nec ipsum sed aliquam. Curabitur auctor pretium Vestibulum rutrum, lectus non aliquam malesuada, tellus velit faucibus neque, id ultrices ante eros venenatis velit. Proin adipiscing rhoncus eros, at vulputate mauris consequat ut.</p>', NULL, 1, '2015-10-05', '2016-05-31'),
(3, 'Privacy Policy', 'PRIVACY', 'Privacy Policy', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>', NULL, 1, '2015-10-05', '2016-07-13');

-- --------------------------------------------------------

--
-- Table structure for table `jobs_country`
--

CREATE TABLE `jobs_country` (
  `id` int(11) NOT NULL,
  `iso` char(2) NOT NULL,
  `name` varchar(80) NOT NULL,
  `nicename` varchar(80) NOT NULL,
  `iso3` char(3) DEFAULT NULL,
  `numcode` smallint(6) DEFAULT NULL,
  `phonecode` int(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jobs_country`
--

INSERT INTO `jobs_country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES
(1, 'AF', 'AFGHANISTAN', 'Afghanistan', 'AFG', 4, 93),
(2, 'AL', 'ALBANIA', 'Albania', 'ALB', 8, 355),
(3, 'DZ', 'ALGERIA', 'Algeria', 'DZA', 12, 213),
(4, 'AS', 'AMERICAN SAMOA', 'American Samoa', 'ASM', 16, 1684),
(5, 'AD', 'ANDORRA', 'Andorra', 'AND', 20, 376),
(6, 'AO', 'ANGOLA', 'Angola', 'AGO', 24, 244),
(7, 'AI', 'ANGUILLA', 'Anguilla', 'AIA', 660, 1264),
(8, 'AQ', 'ANTARCTICA', 'Antarctica', NULL, NULL, 0),
(9, 'AG', 'ANTIGUA AND BARBUDA', 'Antigua and Barbuda', 'ATG', 28, 1268),
(10, 'AR', 'ARGENTINA', 'Argentina', 'ARG', 32, 54),
(11, 'AM', 'ARMENIA', 'Armenia', 'ARM', 51, 374),
(12, 'AW', 'ARUBA', 'Aruba', 'ABW', 533, 297),
(13, 'AU', 'AUSTRALIA', 'Australia', 'AUS', 36, 61),
(14, 'AT', 'AUSTRIA', 'Austria', 'AUT', 40, 43),
(15, 'AZ', 'AZERBAIJAN', 'Azerbaijan', 'AZE', 31, 994),
(16, 'BS', 'BAHAMAS', 'Bahamas', 'BHS', 44, 1242),
(17, 'BH', 'BAHRAIN', 'Bahrain', 'BHR', 48, 973),
(18, 'BD', 'BANGLADESH', 'Bangladesh', 'BGD', 50, 880),
(19, 'BB', 'BARBADOS', 'Barbados', 'BRB', 52, 1246),
(20, 'BY', 'BELARUS', 'Belarus', 'BLR', 112, 375),
(21, 'BE', 'BELGIUM', 'Belgium', 'BEL', 56, 32),
(22, 'BZ', 'BELIZE', 'Belize', 'BLZ', 84, 501),
(23, 'BJ', 'BENIN', 'Benin', 'BEN', 204, 229),
(24, 'BM', 'BERMUDA', 'Bermuda', 'BMU', 60, 1441),
(25, 'BT', 'BHUTAN', 'Bhutan', 'BTN', 64, 975),
(26, 'BO', 'BOLIVIA', 'Bolivia', 'BOL', 68, 591),
(27, 'BA', 'BOSNIA AND HERZEGOVINA', 'Bosnia and Herzegovina', 'BIH', 70, 387),
(28, 'BW', 'BOTSWANA', 'Botswana', 'BWA', 72, 267),
(29, 'BV', 'BOUVET ISLAND', 'Bouvet Island', NULL, NULL, 0),
(30, 'BR', 'BRAZIL', 'Brazil', 'BRA', 76, 55),
(31, 'IO', 'BRITISH INDIAN OCEAN TERRITORY', 'British Indian Ocean Territory', NULL, NULL, 246),
(32, 'BN', 'BRUNEI DARUSSALAM', 'Brunei Darussalam', 'BRN', 96, 673),
(33, 'BG', 'BULGARIA', 'Bulgaria', 'BGR', 100, 359),
(34, 'BF', 'BURKINA FASO', 'Burkina Faso', 'BFA', 854, 226),
(35, 'BI', 'BURUNDI', 'Burundi', 'BDI', 108, 257),
(36, 'KH', 'CAMBODIA', 'Cambodia', 'KHM', 116, 855),
(37, 'CM', 'CAMEROON', 'Cameroon', 'CMR', 120, 237),
(38, 'CA', 'CANADA', 'Canada', 'CAN', 124, 1),
(39, 'CV', 'CAPE VERDE', 'Cape Verde', 'CPV', 132, 238),
(40, 'KY', 'CAYMAN ISLANDS', 'Cayman Islands', 'CYM', 136, 1345),
(41, 'CF', 'CENTRAL AFRICAN REPUBLIC', 'Central African Republic', 'CAF', 140, 236),
(42, 'TD', 'CHAD', 'Chad', 'TCD', 148, 235),
(43, 'CL', 'CHILE', 'Chile', 'CHL', 152, 56),
(44, 'CN', 'CHINA', 'China', 'CHN', 156, 86),
(45, 'CX', 'CHRISTMAS ISLAND', 'Christmas Island', NULL, NULL, 61),
(46, 'CC', 'COCOS (KEELING) ISLANDS', 'Cocos (Keeling) Islands', NULL, NULL, 672),
(47, 'CO', 'COLOMBIA', 'Colombia', 'COL', 170, 57),
(48, 'KM', 'COMOROS', 'Comoros', 'COM', 174, 269),
(49, 'CG', 'CONGO', 'Congo', 'COG', 178, 242),
(50, 'CD', 'CONGO, THE DEMOCRATIC REPUBLIC OF THE', 'Congo, the Democratic Republic of the', 'COD', 180, 243),
(51, 'CK', 'COOK ISLANDS', 'Cook Islands', 'COK', 184, 682),
(52, 'CR', 'COSTA RICA', 'Costa Rica', 'CRI', 188, 506),
(53, 'CI', 'COTE D''IVOIRE', 'Cote D''Ivoire', 'CIV', 384, 225),
(54, 'HR', 'CROATIA', 'Croatia', 'HRV', 191, 385),
(55, 'CU', 'CUBA', 'Cuba', 'CUB', 192, 53),
(56, 'CY', 'CYPRUS', 'Cyprus', 'CYP', 196, 357),
(57, 'CZ', 'CZECH REPUBLIC', 'Czech Republic', 'CZE', 203, 420),
(58, 'DK', 'DENMARK', 'Denmark', 'DNK', 208, 45),
(59, 'DJ', 'DJIBOUTI', 'Djibouti', 'DJI', 262, 253),
(60, 'DM', 'DOMINICA', 'Dominica', 'DMA', 212, 1767),
(61, 'DO', 'DOMINICAN REPUBLIC', 'Dominican Republic', 'DOM', 214, 1809),
(62, 'EC', 'ECUADOR', 'Ecuador', 'ECU', 218, 593),
(63, 'EG', 'EGYPT', 'Egypt', 'EGY', 818, 20),
(64, 'SV', 'EL SALVADOR', 'El Salvador', 'SLV', 222, 503),
(65, 'GQ', 'EQUATORIAL GUINEA', 'Equatorial Guinea', 'GNQ', 226, 240),
(66, 'ER', 'ERITREA', 'Eritrea', 'ERI', 232, 291),
(67, 'EE', 'ESTONIA', 'Estonia', 'EST', 233, 372),
(68, 'ET', 'ETHIOPIA', 'Ethiopia', 'ETH', 231, 251),
(69, 'FK', 'FALKLAND ISLANDS (MALVINAS)', 'Falkland Islands (Malvinas)', 'FLK', 238, 500),
(70, 'FO', 'FAROE ISLANDS', 'Faroe Islands', 'FRO', 234, 298),
(71, 'FJ', 'FIJI', 'Fiji', 'FJI', 242, 679),
(72, 'FI', 'FINLAND', 'Finland', 'FIN', 246, 358),
(73, 'FR', 'FRANCE', 'France', 'FRA', 250, 33),
(74, 'GF', 'FRENCH GUIANA', 'French Guiana', 'GUF', 254, 594),
(75, 'PF', 'FRENCH POLYNESIA', 'French Polynesia', 'PYF', 258, 689),
(76, 'TF', 'FRENCH SOUTHERN TERRITORIES', 'French Southern Territories', NULL, NULL, 0),
(77, 'GA', 'GABON', 'Gabon', 'GAB', 266, 241),
(78, 'GM', 'GAMBIA', 'Gambia', 'GMB', 270, 220),
(79, 'GE', 'GEORGIA', 'Georgia', 'GEO', 268, 995),
(80, 'DE', 'GERMANY', 'Germany', 'DEU', 276, 49),
(81, 'GH', 'GHANA', 'Ghana', 'GHA', 288, 233),
(82, 'GI', 'GIBRALTAR', 'Gibraltar', 'GIB', 292, 350),
(83, 'GR', 'GREECE', 'Greece', 'GRC', 300, 30),
(84, 'GL', 'GREENLAND', 'Greenland', 'GRL', 304, 299),
(85, 'GD', 'GRENADA', 'Grenada', 'GRD', 308, 1473),
(86, 'GP', 'GUADELOUPE', 'Guadeloupe', 'GLP', 312, 590),
(87, 'GU', 'GUAM', 'Guam', 'GUM', 316, 1671),
(88, 'GT', 'GUATEMALA', 'Guatemala', 'GTM', 320, 502),
(89, 'GN', 'GUINEA', 'Guinea', 'GIN', 324, 224),
(90, 'GW', 'GUINEA-BISSAU', 'Guinea-Bissau', 'GNB', 624, 245),
(91, 'GY', 'GUYANA', 'Guyana', 'GUY', 328, 592),
(92, 'HT', 'HAITI', 'Haiti', 'HTI', 332, 509),
(93, 'HM', 'HEARD ISLAND AND MCDONALD ISLANDS', 'Heard Island and Mcdonald Islands', NULL, NULL, 0),
(94, 'VA', 'HOLY SEE (VATICAN CITY STATE)', 'Holy See (Vatican City State)', 'VAT', 336, 39),
(95, 'HN', 'HONDURAS', 'Honduras', 'HND', 340, 504),
(96, 'HK', 'HONG KONG', 'Hong Kong', 'HKG', 344, 852),
(97, 'HU', 'HUNGARY', 'Hungary', 'HUN', 348, 36),
(98, 'IS', 'ICELAND', 'Iceland', 'ISL', 352, 354),
(99, 'IN', 'INDIA', 'India', 'IND', 356, 91),
(100, 'ID', 'INDONESIA', 'Indonesia', 'IDN', 360, 62),
(101, 'IR', 'IRAN, ISLAMIC REPUBLIC OF', 'Iran, Islamic Republic of', 'IRN', 364, 98),
(102, 'IQ', 'IRAQ', 'Iraq', 'IRQ', 368, 964),
(103, 'IE', 'IRELAND', 'Ireland', 'IRL', 372, 353),
(104, 'IL', 'ISRAEL', 'Israel', 'ISR', 376, 972),
(105, 'IT', 'ITALY', 'Italy', 'ITA', 380, 39),
(106, 'JM', 'JAMAICA', 'Jamaica', 'JAM', 388, 1876),
(107, 'JP', 'JAPAN', 'Japan', 'JPN', 392, 81),
(108, 'JO', 'JORDAN', 'Jordan', 'JOR', 400, 962),
(109, 'KZ', 'KAZAKHSTAN', 'Kazakhstan', 'KAZ', 398, 7),
(110, 'KE', 'KENYA', 'Kenya', 'KEN', 404, 254),
(111, 'KI', 'KIRIBATI', 'Kiribati', 'KIR', 296, 686),
(112, 'KP', 'KOREA, DEMOCRATIC PEOPLE''S REPUBLIC OF', 'Korea, Democratic People''s Republic of', 'PRK', 408, 850),
(113, 'KR', 'KOREA, REPUBLIC OF', 'Korea, Republic of', 'KOR', 410, 82),
(114, 'KW', 'KUWAIT', 'Kuwait', 'KWT', 414, 965),
(115, 'KG', 'KYRGYZSTAN', 'Kyrgyzstan', 'KGZ', 417, 996),
(116, 'LA', 'LAO PEOPLE''S DEMOCRATIC REPUBLIC', 'Lao People''s Democratic Republic', 'LAO', 418, 856),
(117, 'LV', 'LATVIA', 'Latvia', 'LVA', 428, 371),
(118, 'LB', 'LEBANON', 'Lebanon', 'LBN', 422, 961),
(119, 'LS', 'LESOTHO', 'Lesotho', 'LSO', 426, 266),
(120, 'LR', 'LIBERIA', 'Liberia', 'LBR', 430, 231),
(121, 'LY', 'LIBYAN ARAB JAMAHIRIYA', 'Libyan Arab Jamahiriya', 'LBY', 434, 218),
(122, 'LI', 'LIECHTENSTEIN', 'Liechtenstein', 'LIE', 438, 423),
(123, 'LT', 'LITHUANIA', 'Lithuania', 'LTU', 440, 370),
(124, 'LU', 'LUXEMBOURG', 'Luxembourg', 'LUX', 442, 352),
(125, 'MO', 'MACAO', 'Macao', 'MAC', 446, 853),
(126, 'MK', 'MACEDONIA, THE FORMER YUGOSLAV REPUBLIC OF', 'Macedonia, the Former Yugoslav Republic of', 'MKD', 807, 389),
(127, 'MG', 'MADAGASCAR', 'Madagascar', 'MDG', 450, 261),
(128, 'MW', 'MALAWI', 'Malawi', 'MWI', 454, 265),
(129, 'MY', 'MALAYSIA', 'Malaysia', 'MYS', 458, 60),
(130, 'MV', 'MALDIVES', 'Maldives', 'MDV', 462, 960),
(131, 'ML', 'MALI', 'Mali', 'MLI', 466, 223),
(132, 'MT', 'MALTA', 'Malta', 'MLT', 470, 356),
(133, 'MH', 'MARSHALL ISLANDS', 'Marshall Islands', 'MHL', 584, 692),
(134, 'MQ', 'MARTINIQUE', 'Martinique', 'MTQ', 474, 596),
(135, 'MR', 'MAURITANIA', 'Mauritania', 'MRT', 478, 222),
(136, 'MU', 'MAURITIUS', 'Mauritius', 'MUS', 480, 230),
(137, 'YT', 'MAYOTTE', 'Mayotte', NULL, NULL, 269),
(138, 'MX', 'MEXICO', 'Mexico', 'MEX', 484, 52),
(139, 'FM', 'MICRONESIA, FEDERATED STATES OF', 'Micronesia, Federated States of', 'FSM', 583, 691),
(140, 'MD', 'MOLDOVA, REPUBLIC OF', 'Moldova, Republic of', 'MDA', 498, 373),
(141, 'MC', 'MONACO', 'Monaco', 'MCO', 492, 377),
(142, 'MN', 'MONGOLIA', 'Mongolia', 'MNG', 496, 976),
(143, 'MS', 'MONTSERRAT', 'Montserrat', 'MSR', 500, 1664),
(144, 'MA', 'MOROCCO', 'Morocco', 'MAR', 504, 212),
(145, 'MZ', 'MOZAMBIQUE', 'Mozambique', 'MOZ', 508, 258),
(146, 'MM', 'MYANMAR', 'Myanmar', 'MMR', 104, 95),
(147, 'NA', 'NAMIBIA', 'Namibia', 'NAM', 516, 264),
(148, 'NR', 'NAURU', 'Nauru', 'NRU', 520, 674),
(149, 'NP', 'NEPAL', 'Nepal', 'NPL', 524, 977),
(150, 'NL', 'NETHERLANDS', 'Netherlands', 'NLD', 528, 31),
(151, 'AN', 'NETHERLANDS ANTILLES', 'Netherlands Antilles', 'ANT', 530, 599),
(152, 'NC', 'NEW CALEDONIA', 'New Caledonia', 'NCL', 540, 687),
(153, 'NZ', 'NEW ZEALAND', 'New Zealand', 'NZL', 554, 64),
(154, 'NI', 'NICARAGUA', 'Nicaragua', 'NIC', 558, 505),
(155, 'NE', 'NIGER', 'Niger', 'NER', 562, 227),
(156, 'NG', 'NIGERIA', 'Nigeria', 'NGA', 566, 234),
(157, 'NU', 'NIUE', 'Niue', 'NIU', 570, 683),
(158, 'NF', 'NORFOLK ISLAND', 'Norfolk Island', 'NFK', 574, 672),
(159, 'MP', 'NORTHERN MARIANA ISLANDS', 'Northern Mariana Islands', 'MNP', 580, 1670),
(160, 'NO', 'NORWAY', 'Norway', 'NOR', 578, 47),
(161, 'OM', 'OMAN', 'Oman', 'OMN', 512, 968),
(162, 'PK', 'PAKISTAN', 'Pakistan', 'PAK', 586, 92),
(163, 'PW', 'PALAU', 'Palau', 'PLW', 585, 680),
(164, 'PS', 'PALESTINIAN TERRITORY, OCCUPIED', 'Palestinian Territory, Occupied', NULL, NULL, 970),
(165, 'PA', 'PANAMA', 'Panama', 'PAN', 591, 507),
(166, 'PG', 'PAPUA NEW GUINEA', 'Papua New Guinea', 'PNG', 598, 675),
(167, 'PY', 'PARAGUAY', 'Paraguay', 'PRY', 600, 595),
(168, 'PE', 'PERU', 'Peru', 'PER', 604, 51),
(169, 'PH', 'PHILIPPINES', 'Philippines', 'PHL', 608, 63),
(170, 'PN', 'PITCAIRN', 'Pitcairn', 'PCN', 612, 0),
(171, 'PL', 'POLAND', 'Poland', 'POL', 616, 48),
(172, 'PT', 'PORTUGAL', 'Portugal', 'PRT', 620, 351),
(173, 'PR', 'PUERTO RICO', 'Puerto Rico', 'PRI', 630, 1787),
(174, 'QA', 'QATAR', 'Qatar', 'QAT', 634, 974),
(175, 'RE', 'REUNION', 'Reunion', 'REU', 638, 262),
(176, 'RO', 'ROMANIA', 'Romania', 'ROM', 642, 40),
(177, 'RU', 'RUSSIAN FEDERATION', 'Russian Federation', 'RUS', 643, 7),
(178, 'RW', 'RWANDA', 'Rwanda', 'RWA', 646, 250),
(179, 'SH', 'SAINT HELENA', 'Saint Helena', 'SHN', 654, 290),
(180, 'KN', 'SAINT KITTS AND NEVIS', 'Saint Kitts and Nevis', 'KNA', 659, 1869),
(181, 'LC', 'SAINT LUCIA', 'Saint Lucia', 'LCA', 662, 1758),
(182, 'PM', 'SAINT PIERRE AND MIQUELON', 'Saint Pierre and Miquelon', 'SPM', 666, 508),
(183, 'VC', 'SAINT VINCENT AND THE GRENADINES', 'Saint Vincent and the Grenadines', 'VCT', 670, 1784),
(184, 'WS', 'SAMOA', 'Samoa', 'WSM', 882, 684),
(185, 'SM', 'SAN MARINO', 'San Marino', 'SMR', 674, 378),
(186, 'ST', 'SAO TOME AND PRINCIPE', 'Sao Tome and Principe', 'STP', 678, 239),
(187, 'SA', 'SAUDI ARABIA', 'Saudi Arabia', 'SAU', 682, 966),
(188, 'SN', 'SENEGAL', 'Senegal', 'SEN', 686, 221),
(190, 'SC', 'SEYCHELLES', 'Seychelles', 'SYC', 690, 248),
(191, 'SL', 'SIERRA LEONE', 'Sierra Leone', 'SLE', 694, 232),
(192, 'SG', 'SINGAPORE', 'Singapore', 'SGP', 702, 65),
(193, 'SK', 'SLOVAKIA', 'Slovakia', 'SVK', 703, 421),
(194, 'SI', 'SLOVENIA', 'Slovenia', 'SVN', 705, 386),
(195, 'SB', 'SOLOMON ISLANDS', 'Solomon Islands', 'SLB', 90, 677),
(196, 'SO', 'SOMALIA', 'Somalia', 'SOM', 706, 252),
(197, 'ZA', 'SOUTH AFRICA', 'South Africa', 'ZAF', 710, 27),
(198, 'GS', 'SOUTH GEORGIA AND THE SOUTH SANDWICH ISLANDS', 'South Georgia and the South Sandwich Islands', NULL, NULL, 0),
(199, 'ES', 'SPAIN', 'Spain', 'ESP', 724, 34),
(200, 'LK', 'SRI LANKA', 'Sri Lanka', 'LKA', 144, 94),
(201, 'SD', 'SUDAN', 'Sudan', 'SDN', 736, 249),
(202, 'SR', 'SURINAME', 'Suriname', 'SUR', 740, 597),
(203, 'SJ', 'SVALBARD AND JAN MAYEN', 'Svalbard and Jan Mayen', 'SJM', 744, 47),
(204, 'SZ', 'SWAZILAND', 'Swaziland', 'SWZ', 748, 268),
(205, 'SE', 'SWEDEN', 'Sweden', 'SWE', 752, 46),
(206, 'CH', 'SWITZERLAND', 'Switzerland', 'CHE', 756, 41),
(207, 'SY', 'SYRIAN ARAB REPUBLIC', 'Syrian Arab Republic', 'SYR', 760, 963),
(208, 'TW', 'TAIWAN, PROVINCE OF CHINA', 'Taiwan, Province of China', 'TWN', 158, 886),
(209, 'TJ', 'TAJIKISTAN', 'Tajikistan', 'TJK', 762, 992),
(210, 'TZ', 'TANZANIA, UNITED REPUBLIC OF', 'Tanzania, United Republic of', 'TZA', 834, 255),
(211, 'TH', 'THAILAND', 'Thailand', 'THA', 764, 66),
(212, 'TL', 'TIMOR-LESTE', 'Timor-Leste', NULL, NULL, 670),
(213, 'TG', 'TOGO', 'Togo', 'TGO', 768, 228),
(214, 'TK', 'TOKELAU', 'Tokelau', 'TKL', 772, 690),
(215, 'TO', 'TONGA', 'Tonga', 'TON', 776, 676),
(216, 'TT', 'TRINIDAD AND TOBAGO', 'Trinidad and Tobago', 'TTO', 780, 1868),
(217, 'TN', 'TUNISIA', 'Tunisia', 'TUN', 788, 216),
(218, 'TR', 'TURKEY', 'Turkey', 'TUR', 792, 90),
(219, 'TM', 'TURKMENISTAN', 'Turkmenistan', 'TKM', 795, 7370),
(220, 'TC', 'TURKS AND CAICOS ISLANDS', 'Turks and Caicos Islands', 'TCA', 796, 1649),
(221, 'TV', 'TUVALU', 'Tuvalu', 'TUV', 798, 688),
(222, 'UG', 'UGANDA', 'Uganda', 'UGA', 800, 256),
(223, 'UA', 'UKRAINE', 'Ukraine', 'UKR', 804, 380),
(224, 'AE', 'UNITED ARAB EMIRATES', 'United Arab Emirates', 'ARE', 784, 971),
(225, 'GB', 'UNITED KINGDOM', 'United Kingdom', 'GBR', 826, 44),
(226, 'US', 'UNITED STATES', 'United States', 'USA', 840, 1),
(227, 'UM', 'UNITED STATES MINOR OUTLYING ISLANDS', 'United States Minor Outlying Islands', NULL, NULL, 1),
(228, 'UY', 'URUGUAY', 'Uruguay', 'URY', 858, 598),
(229, 'UZ', 'UZBEKISTAN', 'Uzbekistan', 'UZB', 860, 998),
(230, 'VU', 'VANUATU', 'Vanuatu', 'VUT', 548, 678),
(231, 'VE', 'VENEZUELA', 'Venezuela', 'VEN', 862, 58),
(232, 'VN', 'VIET NAM', 'Viet Nam', 'VNM', 704, 84),
(233, 'VG', 'VIRGIN ISLANDS, BRITISH', 'Virgin Islands, British', 'VGB', 92, 1284),
(234, 'VI', 'VIRGIN ISLANDS, U.S.', 'Virgin Islands, U.s.', 'VIR', 850, 1340),
(235, 'WF', 'WALLIS AND FUTUNA', 'Wallis and Futuna', 'WLF', 876, 681),
(236, 'EH', 'WESTERN SAHARA', 'Western Sahara', 'ESH', 732, 212),
(237, 'YE', 'YEMEN', 'Yemen', 'YEM', 887, 967),
(238, 'ZM', 'ZAMBIA', 'Zambia', 'ZMB', 894, 260),
(239, 'ZW', 'ZIMBABWE', 'Zimbabwe', 'ZWE', 716, 263),
(240, 'RS', 'SERBIA', 'Serbia', 'SRB', 688, 381),
(241, 'AP', 'ASIA PACIFIC REGION', 'Asia / Pacific Region', '0', 0, 0),
(242, 'ME', 'MONTENEGRO', 'Montenegro', 'MNE', 499, 382),
(243, 'AX', 'ALAND ISLANDS', 'Aland Islands', 'ALA', 248, 358),
(244, 'BQ', 'BONAIRE, SINT EUSTATIUS AND SABA', 'Bonaire, Sint Eustatius and Saba', 'BES', 535, 599),
(245, 'CW', 'CURACAO', 'Curacao', 'CUW', 531, 599),
(246, 'GG', 'GUERNSEY', 'Guernsey', 'GGY', 831, 44),
(247, 'IM', 'ISLE OF MAN', 'Isle of Man', 'IMN', 833, 44),
(248, 'JE', 'JERSEY', 'Jersey', 'JEY', 832, 44),
(249, 'XK', 'KOSOVO', 'Kosovo', '---', 0, 381),
(250, 'BL', 'SAINT BARTHELEMY', 'Saint Barthelemy', 'BLM', 652, 590),
(251, 'MF', 'SAINT MARTIN', 'Saint Martin', 'MAF', 663, 590),
(252, 'SX', 'SINT MAARTEN', 'Sint Maarten', 'SXM', 534, 1),
(253, 'SS', 'SOUTH SUDAN', 'South Sudan', 'SSD', 728, 211);

-- --------------------------------------------------------

--
-- Table structure for table `jobs_events`
--

CREATE TABLE `jobs_events` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `event_title` text,
  `description` text,
  `location` varchar(255) DEFAULT NULL,
  `start_at` time DEFAULT NULL,
  `end_at` time DEFAULT NULL,
  `upload_id` bigint(20) DEFAULT NULL,
  `eventdate` date DEFAULT NULL,
  `lat` varchar(50) DEFAULT NULL,
  `lng` varchar(50) DEFAULT NULL,
  `eventype` tinyint(4) DEFAULT '0' COMMENT '0=>public, 1=>private',
  `status` tinyint(4) DEFAULT '1' COMMENT '1=>live, 2=>cancel, 3=>deleted',
  `createdon` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jobs_events`
--

INSERT INTO `jobs_events` (`id`, `user_id`, `event_title`, `description`, `location`, `start_at`, `end_at`, `upload_id`, `eventdate`, `lat`, `lng`, `eventype`, `status`, `createdon`) VALUES
(1, 1, 'test title', 'test desc', 'del', '12:02:40', '02:00:00', 1, '2016-11-20', '24.00', '25.00', 1, 1, '2016-08-12 07:55:15'),
(2, 2, 'test title another', 'test desc', 'del', '12:02:00', '02:00:00', 1, '2016-11-20', '24.00', '25.00', 1, 1, '2016-08-24 13:19:36'),
(3, 1, 'test title third', 'test desc', 'del', '12:00:00', '02:00:00', 1, '2016-07-20', '24.00', '25.00', 1, 1, '2016-08-24 13:20:02'),
(4, 10, 'test title another testing', 'test desc', 'del', '13:45:34', '17:00:00', 1, '2016-08-16', '24.00', '25.00', 1, 1, '2016-08-16 09:24:38'),
(5, 10, 'parul event', 'testing description', 'delhi', '12:00:00', '16:00:00', 1, '2017-08-15', '24.00', '25.00', 1, 1, '2016-08-30 09:13:44'),
(8, NULL, 'cristmus', 'this is my description', 'meerut', '00:15:00', '00:15:00', NULL, '2016-08-31', '65484865', '46547656', 0, 1, '2016-08-30 10:06:14'),
(9, NULL, 'cristmusidff', 'this is mydffgg dd', 'meerutdd', '00:15:00', '00:15:00', NULL, '2016-10-12', '65484865', '46547656', 0, 1, '2016-08-30 11:19:51');

-- --------------------------------------------------------

--
-- Table structure for table `jobs_favourites`
--

CREATE TABLE `jobs_favourites` (
  `id` int(11) NOT NULL,
  `event_id` bigint(20) DEFAULT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `favourite` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(4) DEFAULT '1' COMMENT '1=>favorite, 2=>reported'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jobs_favourites`
--

INSERT INTO `jobs_favourites` (`id`, `event_id`, `user_id`, `favourite`, `status`) VALUES
(3, 1, 1, 1, 1),
(6, 3, 7, 0, 1),
(7, 2, 2, 0, 1),
(8, 2, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `jobs_invite`
--

CREATE TABLE `jobs_invite` (
  `id` bigint(20) NOT NULL,
  `eventid` bigint(20) DEFAULT NULL,
  `userid` bigint(20) DEFAULT NULL,
  `accepted` tinyint(4) DEFAULT '0' COMMENT '0=>Unaccepted, 1=>Accepted'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `jobs_invitetemp`
--

CREATE TABLE `jobs_invitetemp` (
  `id` bigint(20) NOT NULL,
  `temp_event_id` int(11) DEFAULT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `isuser` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `jobs_mails`
--

CREATE TABLE `jobs_mails` (
  `id` int(10) NOT NULL,
  `mail_slug` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `mail_title` varchar(255) NOT NULL,
  `var` text NOT NULL,
  `description` text NOT NULL,
  `created` date DEFAULT NULL,
  `modified` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jobs_mails`
--

INSERT INTO `jobs_mails` (`id`, `mail_slug`, `subject`, `mail_title`, `var`, `description`, `created`, `modified`) VALUES
(1, 'register_new', 'Fantasy Registration', 'mail title has been changed', '{ActiveLink},{email},{password}', '<div style="margin:20px 5px 5px 5px; font-family:Arial,Helvetica,sans-serif; font-size:12px; color:#000000;">Hello,<br />\n<br />\nCongratulation! account has been created successfully.</div>\n<div style="margin:20px 5px 5px 5px; font-family:Arial,Helvetica,sans-serif; font-size:12px; color:#000000;">Your login credentials are as follows:<br />\n<br />\n<strong>Email:&nbsp;</strong>{email}<br />\n<strong>Password:&nbsp;</strong>{password}<br />\n<br />\n<p>To complete your registration, please click the link: {ActiveLink} to confirm your account and your e-mail address.</p>\n\n<br />\nIf you have any questions, please contact info@zipdermapp.com <br />\n&nbsp;</div>\n<div style="margin:20px 5px 5px 5px; font-family:Arial,Helvetica,sans-serif; font-size:12px; color:#000000;">Thank you,<br />\nZipderm</div>', '2014-02-17', '2016-07-13'),
(2, 'forgot_password', 'Fantasy Forgot Password', 'Fantasy Forgot Password', '{firstName},{lastName},{email},{password}', '<div style="margin:20px 5px 5px 5px; font-family:Arial,Helvetica,sans-serif; font-size:12px; color:#000000;">Hello {firstName} {lastName},&nbsp;<br />\r\n<br />\r\nYour new login credentials are as follows:<br />\r\n<br />\r\n<strong>Email:&nbsp;</strong>{email}<br />\r\n<strong>Password:&nbsp;</strong>{password}<br />\r\n<br />\r\nIf you have any questions, please contact info@fantasyapp.com <br />\r\n<br />\r\nThank you<br />\r\nFantasy</div>', '2014-02-18', '2016-07-13'),
(3, 'reset_password', 'Fantasy Password Recovery', 'Fantasy Password Recovery', '{firstName},{lastName},{email},{password}', '<div style="margin:20px 5px 5px 5px; font-family:Arial,Helvetica,sans-serif; font-size:12px; color:#000000;">Hello {firstName} {lastName},&nbsp;<br />\r\n<br />\r\nYour Fantasy password has been reset. Your new login credentials are as follows:<br />\r\n<br />\r\n<strong>Email:&nbsp;</strong>{email}<br />\r\n<strong>Password:&nbsp;</strong>{password}<br />\r\n<br />\r\nIf you have any questions, please contact info@fantasyapp.com <br />\r\n<br />\r\nThank you<br />\r\nFantasy</div>\r\n<p>&nbsp;</p>', '2014-02-25', '2016-07-13'),
(6, 'contact', 'Fantasy Contact Us', 'mail title has been changed', '{firstName},{lastName},{email}, {phone}, {subject}, {message}', '<div style="margin:20px 5px 5px 5px; font-family:Arial,Helvetica,sans-serif; font-size:12px; color:#000000;">Hello,<br />\r\n<br />\r\nUser contact to you successfully.</div>\r\n<div style="margin:20px 5px 5px 5px; font-family:Arial,Helvetica,sans-serif; font-size:12px; color:#000000;">User Information are as follows:<br />\r\n<br />\r\n<strong>First Name:&nbsp;</strong> {firstName}<br />\r\n<strong>Last Name:&nbsp;</strong> {lastName}<br />\r\n<strong>Email:&nbsp;</strong> {email}<br />\r\n<strong>Phone:&nbsp;</strong> {phone}<br />\r\n<strong>Subject:&nbsp;</strong> {subject}<br />\r\n<strong>Message:&nbsp;</strong> {message}</div>\r\n<div style="margin:20px 5px 5px 5px; font-family:Arial,Helvetica,sans-serif; font-size:12px; color:#000000;"><span style="font-size: 12px;">If you have any questions, please contact info@fantasyapp.com</span><span style="font-size: 12px;">&nbsp;</span></div>\r\n<div style="margin:17px 5px 5px 5px; font-family:Arial,Helvetica,sans-serif; font-size:12px; color:#000000;">Thank you,<br />\r\nFantasy</div>', '2014-02-17', '2016-07-13');

-- --------------------------------------------------------

--
-- Table structure for table `jobs_posts`
--

CREATE TABLE `jobs_posts` (
  `id` int(10) NOT NULL,
  `comment` text NOT NULL,
  `post_media_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `event_id` int(10) NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jobs_posts`
--

INSERT INTO `jobs_posts` (`id`, `comment`, `post_media_id`, `user_id`, `event_id`, `created`) VALUES
(1, 'this is test comment', 1, 1, 1, '2016-07-27 17:08:05'),
(2, 'this is new comment', 12, 1, 1, '2016-07-27 17:32:13'),
(3, '', 1, 11, 2, '2016-08-11 10:52:35'),
(4, 'Hi testing comment', 1, 11, 2, '2016-08-11 10:55:09'),
(5, 'Hi testing comment', 1, 11, 2, '2016-08-11 10:57:48'),
(6, 'Hi testing comment', 1, 11, 2, '2016-08-11 10:58:26');

-- --------------------------------------------------------

--
-- Table structure for table `jobs_questions`
--

CREATE TABLE `jobs_questions` (
  `id` int(11) NOT NULL,
  `question_eng` text,
  `question_ch` text,
  `correct_answer` text,
  `type` varchar(5) NOT NULL,
  `status` varchar(1) NOT NULL DEFAULT '1',
  `created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jobs_questions`
--

INSERT INTO `jobs_questions` (`id`, `question_eng`, `question_ch`, `correct_answer`, `type`, `status`, `created`) VALUES
(1, 'Head lice or dandruff?', NULL, NULL, '', '1', '2016-07-20'),
(2, 'Dandruff or head lice?', NULL, NULL, '', '1', '2016-07-20'),
(3, 'What to do for oily scalp?', NULL, NULL, '', '1', '2016-07-20'),
(4, 'Treatment for pimples?', NULL, NULL, '', '1', '2016-07-20');

-- --------------------------------------------------------

--
-- Table structure for table `jobs_uploads`
--

CREATE TABLE `jobs_uploads` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `event_id` int(10) NOT NULL,
  `media_type` varchar(20) NOT NULL,
  `upload_for` varchar(20) NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1' COMMENT '1=>live, 0=>deleted',
  `uploadedon` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jobs_uploads`
--

INSERT INTO `jobs_uploads` (`id`, `user_id`, `event_id`, `media_type`, `upload_for`, `url`, `status`, `uploadedon`) VALUES
(1, 42, 3, 'image', 'userprofile', 'fpouw1472445803.jpg', 1, '2016-08-29 04:43:23'),
(2, 55, 0, 'image', 'userprofile', 'pai3o1472449790.jpg', 1, '2016-08-29 05:49:50'),
(3, 56, 0, 'image', 'userprofile', 'j5axl1472450163.jpg', 1, '2016-08-29 05:56:03'),
(4, 57, 0, 'image', 'userprofile', '3i0701472533305.jpg', 1, '2016-08-30 05:01:45'),
(5, 1, 8, 'image', 'banner', '3i0701472533305.jpg', 1, '2016-08-30 10:23:02'),
(6, 1, 9, 'image', 'banner', 'opnc1472555991.jpg', 1, '2016-08-30 11:19:51');

-- --------------------------------------------------------

--
-- Table structure for table `jobs_users`
--

CREATE TABLE `jobs_users` (
  `id` bigint(20) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(250) NOT NULL,
  `gender` tinyint(4) DEFAULT NULL COMMENT '1=>Male, 2=>Female',
  `countrycode` varchar(10) DEFAULT NULL,
  `mobile` varchar(16) DEFAULT NULL,
  `otp` varchar(6) DEFAULT NULL,
  `deviceid` varchar(200) DEFAULT NULL,
  `lat` varchar(50) DEFAULT NULL,
  `lng` varchar(50) DEFAULT NULL,
  `address` text,
  `upload_id` int(11) DEFAULT NULL,
  `lastlogin` datetime DEFAULT NULL,
  `status` tinyint(4) DEFAULT '0' COMMENT '1->Active, 0=>Inactive',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jobs_users`
--

INSERT INTO `jobs_users` (`id`, `username`, `fullname`, `email`, `password`, `gender`, `countrycode`, `mobile`, `otp`, `deviceid`, `lat`, `lng`, `address`, `upload_id`, `lastlogin`, `status`, `created`) VALUES
(1, 'kamlesh', 'kamlesh kumardddddddddd', 'test@yopmail.com', '', 1, '91', '8421301500', '1234', '12345', '24', '25', 'Noida', 1, NULL, 1, '2016-08-29 06:09:46'),
(4, 'parul', NULL, NULL, '', NULL, '91', '8754123690', '1234', NULL, NULL, NULL, 'sdsad', NULL, NULL, 1, '2016-08-19 06:45:22'),
(5, 'sumit', 'dfdsf', 'adfas@fdsf.dsfas', '', 1, '91', '8975485210', '1234', NULL, NULL, NULL, 'sdsad', NULL, NULL, 1, '2016-08-19 06:45:24'),
(6, 'kamleshdata', 'dddddddddddd', 'kamlesh@yopmail.com', '', 0, '355', '8421301500', NULL, NULL, NULL, NULL, 'sdsad', NULL, NULL, 1, '2016-08-19 11:30:48'),
(40, 'ssd', 'sdsds', 'dsdsd@gmail.com', '13cf256660d364b32755154adaa509718052d7d1', 0, '994', '121212121', NULL, NULL, NULL, NULL, 'sdsdsd', NULL, NULL, 0, '2016-08-19 12:43:23'),
(41, 'ssd', 'sdsds', 'dsdgggsd@gmail.com', '13cf256660d364b32755154adaa509718052d7d1', 0, '994', '121212121', NULL, NULL, NULL, NULL, 'sdsdsd', NULL, NULL, 0, '2016-08-19 12:43:43'),
(42, 'sumetkumardata', 'sumit kumarname', 'dsdggxccgsd@gmail.com', '13cf256660d364b32755154adaa509718052d7d1', 1, 'AF', '1111111112', NULL, NULL, NULL, NULL, 'Noida sector 21', NULL, NULL, 0, '2016-08-29 04:29:40'),
(52, 'sumit', 'kumar kumar', 'sddde@gmail.com', '13cf256660d364b32755154adaa509718052d7d1', 1, 'AI', '1212121212', NULL, NULL, NULL, NULL, 'noida sector 55', NULL, NULL, 0, '2016-08-29 05:42:17'),
(53, 'sumit', 'kumar kumar', 'sdddde@gmail.com', '13cf256660d364b32755154adaa509718052d7d1', 1, 'AI', '1212121212', NULL, NULL, NULL, NULL, 'noida sector 55', NULL, NULL, 0, '2016-08-29 05:45:31'),
(54, 'sumit', 'kumar kumar', 'sddddfde@gmail.com', '13cf256660d364b32755154adaa509718052d7d1', 1, 'AI', '1212121212', NULL, NULL, NULL, NULL, 'noida sector 55', NULL, NULL, 0, '2016-08-29 05:46:02'),
(55, 'kal', 'kalllll', 'kalll@gmail.com', '8414ad3bd7786158a9592f674e89cfbb1469bffc', 1, 'AS', '12121212', NULL, NULL, NULL, NULL, 'noida sector 200', NULL, NULL, 0, '2016-08-30 05:27:21'),
(56, 'tinkle', 'tinkle kumar', 'tinkle@gmail.com', '13cf256660d364b32755154adaa509718052d7d1', 1, 'AS', '12121212', NULL, NULL, NULL, NULL, 'noida sector 200', NULL, NULL, 0, '2016-08-29 05:58:58'),
(57, 'kamleshq', 'sdsad', 'testq@yopmail.com', '8414ad3bd7786158a9592f674e89cfbb1469bffc', 1, 'AF', '1212121212', NULL, NULL, NULL, NULL, 'ssdfsdf', NULL, NULL, 0, '2016-08-30 05:23:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jobs_admins`
--
ALTER TABLE `jobs_admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs_answers`
--
ALTER TABLE `jobs_answers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs_categories`
--
ALTER TABLE `jobs_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs_cms_pages`
--
ALTER TABLE `jobs_cms_pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs_country`
--
ALTER TABLE `jobs_country`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs_events`
--
ALTER TABLE `jobs_events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs_favourites`
--
ALTER TABLE `jobs_favourites`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs_invite`
--
ALTER TABLE `jobs_invite`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs_invitetemp`
--
ALTER TABLE `jobs_invitetemp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs_mails`
--
ALTER TABLE `jobs_mails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs_posts`
--
ALTER TABLE `jobs_posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs_questions`
--
ALTER TABLE `jobs_questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs_uploads`
--
ALTER TABLE `jobs_uploads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs_users`
--
ALTER TABLE `jobs_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jobs_admins`
--
ALTER TABLE `jobs_admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `jobs_answers`
--
ALTER TABLE `jobs_answers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `jobs_categories`
--
ALTER TABLE `jobs_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `jobs_cms_pages`
--
ALTER TABLE `jobs_cms_pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `jobs_country`
--
ALTER TABLE `jobs_country`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=254;
--
-- AUTO_INCREMENT for table `jobs_events`
--
ALTER TABLE `jobs_events`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `jobs_favourites`
--
ALTER TABLE `jobs_favourites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `jobs_invite`
--
ALTER TABLE `jobs_invite`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `jobs_invitetemp`
--
ALTER TABLE `jobs_invitetemp`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `jobs_mails`
--
ALTER TABLE `jobs_mails`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `jobs_posts`
--
ALTER TABLE `jobs_posts`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `jobs_questions`
--
ALTER TABLE `jobs_questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `jobs_uploads`
--
ALTER TABLE `jobs_uploads`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `jobs_users`
--
ALTER TABLE `jobs_users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
