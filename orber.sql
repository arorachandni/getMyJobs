-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 28, 2016 at 06:57 AM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 5.5.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `orber`
--

-- --------------------------------------------------------

--
-- Table structure for table `orber_admins`
--

CREATE TABLE `orber_admins` (
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
-- Dumping data for table `orber_admins`
--

INSERT INTO `orber_admins` (`id`, `first_name`, `last_name`, `username`, `email`, `password`, `mobile_number`, `created`, `modified`) VALUES
(1, 'Master', 'Admin', 'admin', 'admintest@gmail.com', 'db55655fe83311eb722f82941b9f0ffeec2e4b6b', '9688855858', '0000-00-00', '2016-06-21');

-- --------------------------------------------------------

--
-- Table structure for table `orber_answers`
--

CREATE TABLE `orber_answers` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `question_id` int(11) DEFAULT NULL,
  `answer` text,
  `created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `orber_categories`
--

CREATE TABLE `orber_categories` (
  `id` int(11) NOT NULL,
  `name_eng` varchar(255) DEFAULT NULL,
  `name_ch` text CHARACTER SET utf8,
  `status` int(1) NOT NULL DEFAULT '1',
  `created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orber_categories`
--

INSERT INTO `orber_categories` (`id`, `name_eng`, `name_ch`, `status`, `created`) VALUES
(1, 'Acne', '\n粉刺', 1, '0000-00-00'),
(2, 'Anti-Agign', '反Agign', 1, '0000-00-00'),
(3, 'Rash&Itch', '皮疹瘙癢及', 1, '0000-00-00'),
(4, 'Dandruff', '頭皮', 1, '0000-00-00'),
(5, 'Skin Discoloration', '\n皮膚變色', 1, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `orber_cms_pages`
--

CREATE TABLE `orber_cms_pages` (
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
-- Dumping data for table `orber_cms_pages`
--

INSERT INTO `orber_cms_pages` (`id`, `page_name`, `alias`, `title`, `description_eng`, `description_ch`, `status`, `created`, `modified`) VALUES
(1, 'About Us', 'ABOUT', 'About Company', '<p>Vestibulum rutrum, lectus non aliquam&nbsp; malesuada, tellus velit faucibus neque, id ultrices ante eros venenatis&nbsp; velit. Proin adipiscing rhoncus eros, at vulputate mauris consequat ut.&nbsp; In volutpat neque massa, at porttitor sapien porta bibendum. Donec&nbsp; tincidunt nec ipsum sed aliquam. Curabitur auctor pretium Vestibulum&nbsp; rutrum, lectus non aliquam malesuada, tellus velit faucibus neque, id&nbsp; ultrices ante eros venenatis velit. Proin adipiscing rhoncus eros, at&nbsp; vulputate mauris consequat ut. In volutpat neque massa, at porttitor&nbsp; sapien porta bibendum. Donec tincidunt nec ipsum sed aliquam. Curabitur&nbsp; auctor pretium Vestibulum rutrum, lectus non aliquam malesuada, tellus&nbsp; velit faucibus neque, id ultrices ante eros venenatis velit. Proin&nbsp; adipiscing rhoncus eros, at vulputate mauris consequat ut. In volutpat&nbsp; neque massa, at porttitor sapien porta.Vestibulum rutrum, lectus non&nbsp; aliquam malesuada, tellus velit faucibus.</p>\n<p>Vestibulum rutrum, lectus non aliquam malesuada, tellus velit faucibus neque, id ultrices ante eros venenatis velit. Proin adipiscing rhoncus eros, at vulputate mauris consequat ut. In volutpat neque massa, at porttitor sapien porta bibendum. Donec tincidunt nec ipsum sed aliquam. Curabitur auctor pretium Vestibulum rutrum, lectus non aliquam malesuada, tellus velit faucibus neque, id ultrices ante eros venenatis velit. Proin adipiscing rhoncus eros, at vulputate mauris consequat ut.</p>', NULL, 1, '0000-00-00', '2016-05-31'),
(2, 'Terms & Conditions', 'TERMS', 'Terms & Conditions', '<p>Vestibulum rutrum, lectus non aliquam&nbsp; malesuada, tellus velit faucibus neque, id ultrices ante eros venenatis&nbsp; velit. Proin adipiscing rhoncus eros, at vulputate mauris consequat ut.&nbsp; In volutpat neque massa, at porttitor sapien porta bibendum. Donec&nbsp; tincidunt nec ipsum sed aliquam. Curabitur auctor pretium Vestibulum&nbsp; rutrum, lectus non aliquam malesuada, tellus velit faucibus neque, id&nbsp; ultrices ante eros venenatis velit. Proin adipiscing rhoncus eros, at&nbsp; vulputate mauris consequat ut. In volutpat neque massa, at porttitor&nbsp; sapien porta bibendum. Donec tincidunt nec ipsum sed aliquam. Curabitur&nbsp; auctor pretium Vestibulum rutrum, lectus non aliquam malesuada, tellus&nbsp; velit faucibus neque, id ultrices ante eros venenatis velit. Proin&nbsp; adipiscing rhoncus eros, at vulputate mauris consequat ut. In volutpat&nbsp; neque massa, at porttitor sapien porta.Vestibulum rutrum, lectus non&nbsp; aliquam malesuada, tellus velit faucibus.</p>\n<p>Vestibulum rutrum, lectus non aliquam malesuada, tellus velit faucibus neque, id ultrices ante eros venenatis velit. Proin adipiscing rhoncus eros, at vulputate mauris consequat ut. In volutpat neque massa, at porttitor sapien porta bibendum. Donec tincidunt nec ipsum sed aliquam. Curabitur auctor pretium Vestibulum rutrum, lectus non aliquam malesuada, tellus velit faucibus neque, id ultrices ante eros venenatis velit. Proin adipiscing rhoncus eros, at vulputate mauris consequat ut.</p>', NULL, 1, '2015-10-05', '2016-05-31'),
(3, 'Privacy Policy', 'PRIVACY', 'Privacy Policy', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>', NULL, 1, '2015-10-05', '2016-07-13');

-- --------------------------------------------------------

--
-- Table structure for table `orber_events`
--

CREATE TABLE `orber_events` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `event_title` text,
  `description` text,
  `location` varchar(255) DEFAULT NULL,
  `start_at` time DEFAULT NULL,
  `end_at` time DEFAULT NULL,
  `bannerid` bigint(20) DEFAULT NULL,
  `eventdate` datetime DEFAULT NULL,
  `lat` varchar(50) DEFAULT NULL,
  `lng` varchar(50) DEFAULT NULL,
  `eventype` tinyint(4) DEFAULT '0' COMMENT '0=>public, 1=>private',
  `status` tinyint(4) DEFAULT '1' COMMENT '1=>live, 2=>cancel, 3=>deleted',
  `createdon` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orber_events`
--

INSERT INTO `orber_events` (`id`, `user_id`, `event_title`, `description`, `location`, `start_at`, `end_at`, `bannerid`, `eventdate`, `lat`, `lng`, `eventype`, `status`, `createdon`) VALUES
(1, 1, 'test title', 'test desc', 'del', '17:00:00', '02:00:00', 1, '2016-10-20 10:20:00', '24.00', '25.00', 1, 1, '2016-07-26 11:24:25'),
(2, 1, 'test title another', 'test desc', 'del', '17:00:00', '02:00:00', 1, '2016-10-20 10:20:00', '24.00', '25.00', 1, 1, '2016-07-26 11:31:53'),
(3, 1, 'test title third', 'test desc', 'del', '17:00:00', '02:00:00', 1, '2016-10-20 10:20:00', '24.00', '25.00', 1, 1, '2016-07-26 12:11:03');

-- --------------------------------------------------------

--
-- Table structure for table `orber_favoritevent`
--

CREATE TABLE `orber_favoritevent` (
  `id` int(11) NOT NULL,
  `eventid` bigint(20) DEFAULT NULL,
  `userid` bigint(20) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL COMMENT '1=>favorite, 2=>reported'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `orber_invite`
--

CREATE TABLE `orber_invite` (
  `id` bigint(20) NOT NULL,
  `eventid` bigint(20) DEFAULT NULL,
  `userid` bigint(20) DEFAULT NULL,
  `accepted` tinyint(4) DEFAULT '0' COMMENT '0=>Unaccepted, 1=>Accepted'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `orber_mails`
--

CREATE TABLE `orber_mails` (
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
-- Dumping data for table `orber_mails`
--

INSERT INTO `orber_mails` (`id`, `mail_slug`, `subject`, `mail_title`, `var`, `description`, `created`, `modified`) VALUES
(1, 'register_new', 'Fantasy Registration', 'mail title has been changed', '{ActiveLink},{email},{password}', '<div style="margin:20px 5px 5px 5px; font-family:Arial,Helvetica,sans-serif; font-size:12px; color:#000000;">Hello,<br />\n<br />\nCongratulation! account has been created successfully.</div>\n<div style="margin:20px 5px 5px 5px; font-family:Arial,Helvetica,sans-serif; font-size:12px; color:#000000;">Your login credentials are as follows:<br />\n<br />\n<strong>Email:&nbsp;</strong>{email}<br />\n<strong>Password:&nbsp;</strong>{password}<br />\n<br />\n<p>To complete your registration, please click the link: {ActiveLink} to confirm your account and your e-mail address.</p>\n\n<br />\nIf you have any questions, please contact info@zipdermapp.com <br />\n&nbsp;</div>\n<div style="margin:20px 5px 5px 5px; font-family:Arial,Helvetica,sans-serif; font-size:12px; color:#000000;">Thank you,<br />\nZipderm</div>', '2014-02-17', '2016-07-13'),
(2, 'forgot_password', 'Fantasy Forgot Password', 'Fantasy Forgot Password', '{firstName},{lastName},{email},{password}', '<div style="margin:20px 5px 5px 5px; font-family:Arial,Helvetica,sans-serif; font-size:12px; color:#000000;">Hello {firstName} {lastName},&nbsp;<br />\r\n<br />\r\nYour new login credentials are as follows:<br />\r\n<br />\r\n<strong>Email:&nbsp;</strong>{email}<br />\r\n<strong>Password:&nbsp;</strong>{password}<br />\r\n<br />\r\nIf you have any questions, please contact info@fantasyapp.com <br />\r\n<br />\r\nThank you<br />\r\nFantasy</div>', '2014-02-18', '2016-07-13'),
(3, 'reset_password', 'Fantasy Password Recovery', 'Fantasy Password Recovery', '{firstName},{lastName},{email},{password}', '<div style="margin:20px 5px 5px 5px; font-family:Arial,Helvetica,sans-serif; font-size:12px; color:#000000;">Hello {firstName} {lastName},&nbsp;<br />\r\n<br />\r\nYour Fantasy password has been reset. Your new login credentials are as follows:<br />\r\n<br />\r\n<strong>Email:&nbsp;</strong>{email}<br />\r\n<strong>Password:&nbsp;</strong>{password}<br />\r\n<br />\r\nIf you have any questions, please contact info@fantasyapp.com <br />\r\n<br />\r\nThank you<br />\r\nFantasy</div>\r\n<p>&nbsp;</p>', '2014-02-25', '2016-07-13'),
(6, 'contact', 'Fantasy Contact Us', 'mail title has been changed', '{firstName},{lastName},{email}, {phone}, {subject}, {message}', '<div style="margin:20px 5px 5px 5px; font-family:Arial,Helvetica,sans-serif; font-size:12px; color:#000000;">Hello,<br />\r\n<br />\r\nUser contact to you successfully.</div>\r\n<div style="margin:20px 5px 5px 5px; font-family:Arial,Helvetica,sans-serif; font-size:12px; color:#000000;">User Information are as follows:<br />\r\n<br />\r\n<strong>First Name:&nbsp;</strong> {firstName}<br />\r\n<strong>Last Name:&nbsp;</strong> {lastName}<br />\r\n<strong>Email:&nbsp;</strong> {email}<br />\r\n<strong>Phone:&nbsp;</strong> {phone}<br />\r\n<strong>Subject:&nbsp;</strong> {subject}<br />\r\n<strong>Message:&nbsp;</strong> {message}</div>\r\n<div style="margin:20px 5px 5px 5px; font-family:Arial,Helvetica,sans-serif; font-size:12px; color:#000000;"><span style="font-size: 12px;">If you have any questions, please contact info@fantasyapp.com</span><span style="font-size: 12px;">&nbsp;</span></div>\r\n<div style="margin:17px 5px 5px 5px; font-family:Arial,Helvetica,sans-serif; font-size:12px; color:#000000;">Thank you,<br />\r\nFantasy</div>', '2014-02-17', '2016-07-13');

-- --------------------------------------------------------

--
-- Table structure for table `orber_posts`
--

CREATE TABLE `orber_posts` (
  `id` int(10) NOT NULL,
  `comment` text NOT NULL,
  `post_media_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `event_id` int(10) NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orber_posts`
--

INSERT INTO `orber_posts` (`id`, `comment`, `post_media_id`, `user_id`, `event_id`, `created`) VALUES
(1, 'this is test comment', 1, 1, 1, '2016-07-27 17:08:05'),
(2, 'this is new comment', 12, 1, 1, '2016-07-27 17:32:13');

-- --------------------------------------------------------

--
-- Table structure for table `orber_questions`
--

CREATE TABLE `orber_questions` (
  `id` int(11) NOT NULL,
  `question_eng` text,
  `question_ch` text,
  `correct_answer` text,
  `type` varchar(5) NOT NULL,
  `status` varchar(1) NOT NULL DEFAULT '1',
  `created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orber_questions`
--

INSERT INTO `orber_questions` (`id`, `question_eng`, `question_ch`, `correct_answer`, `type`, `status`, `created`) VALUES
(1, 'Head lice or dandruff?', NULL, NULL, '', '1', '2016-07-20'),
(2, 'Dandruff or head lice?', NULL, NULL, '', '1', '2016-07-20'),
(3, 'What to do for oily scalp?', NULL, NULL, '', '1', '2016-07-20'),
(4, 'Treatment for pimples?', NULL, NULL, '', '1', '2016-07-20');

-- --------------------------------------------------------

--
-- Table structure for table `orber_uploads`
--

CREATE TABLE `orber_uploads` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `event_id` int(10) NOT NULL,
  `media_type` varchar(20) NOT NULL,
  `upload_for` varchar(20) NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1' COMMENT '1=>live, 0=>deleted',
  `uploadedon` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orber_uploads`
--

INSERT INTO `orber_uploads` (`id`, `user_id`, `event_id`, `media_type`, `upload_for`, `url`, `status`, `uploadedon`) VALUES
(1, 11, 3, 'image', 'post', 'http://localhost/orber/usr-5798936739958.jpg', 1, '2016-07-27 16:26:39'),
(2, 11, 3, 'image', 'post', 'http://localhost/orber/img/postsimg/usr-5798945250fcf.jpg', 1, '2016-07-27 16:30:34'),
(3, 11, 3, 'image', 'post', 'http://localhost/orber/img/postsimg/usr-579894b062f45.jpg', 1, '2016-07-27 16:32:08'),
(4, 11, 3, 'video', 'post', 'http://localhost/orber/img/videos/video-579894ce8a170.wmv', 1, '2016-07-27 16:32:38'),
(5, 11, 3, 'video', 'post', 'http://localhost/orber/img/videos/video-57989c438c470.wmv', 1, '2016-07-27 17:04:27');

-- --------------------------------------------------------

--
-- Table structure for table `orber_users`
--

CREATE TABLE `orber_users` (
  `id` bigint(20) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `gender` tinyint(4) DEFAULT NULL COMMENT '1=>Male, 2=>Female',
  `countrycode` varchar(10) DEFAULT NULL,
  `mobile` varchar(16) DEFAULT NULL,
  `otp` varchar(6) DEFAULT NULL,
  `deviceid` varchar(200) DEFAULT NULL,
  `lat` varchar(50) DEFAULT NULL,
  `lng` varchar(50) DEFAULT NULL,
  `address` text,
  `profilepic` int(11) DEFAULT NULL,
  `lastlogin` datetime DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1' COMMENT '1->Active, 0=>Inactive',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orber_users`
--

INSERT INTO `orber_users` (`id`, `username`, `fullname`, `email`, `gender`, `countrycode`, `mobile`, `otp`, `deviceid`, `lat`, `lng`, `address`, `profilepic`, `lastlogin`, `status`, `created`) VALUES
(1, 'kamlesh', 'kamlesh kumardddddddddd', 'test@yopmail.com', 1, '91', '8421301500', '1234', '12345', '24', '25', 'Noida', 1, NULL, 1, '2016-07-27 06:17:53'),
(4, 'parul', NULL, NULL, NULL, '91', '8754123690', '1234', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2016-07-26 09:33:13'),
(5, 'sumit', NULL, NULL, NULL, '91', '8957458210', '1234', NULL, NULL, NULL, NULL, NULL, NULL, 1, '2016-07-26 10:22:13'),
(6, 'kamlesh', 'dddddddddddd', 'test@yopmail.com', 1, '91', '8421301500', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2016-07-27 06:18:13'),
(7, 'sumit', 'sumit kumar', 'sumit@gmail.com', 3, 'us', '1234', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2016-07-27 07:11:10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orber_admins`
--
ALTER TABLE `orber_admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orber_answers`
--
ALTER TABLE `orber_answers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orber_categories`
--
ALTER TABLE `orber_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orber_cms_pages`
--
ALTER TABLE `orber_cms_pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orber_events`
--
ALTER TABLE `orber_events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orber_favoritevent`
--
ALTER TABLE `orber_favoritevent`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orber_invite`
--
ALTER TABLE `orber_invite`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orber_mails`
--
ALTER TABLE `orber_mails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orber_posts`
--
ALTER TABLE `orber_posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orber_questions`
--
ALTER TABLE `orber_questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orber_uploads`
--
ALTER TABLE `orber_uploads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orber_users`
--
ALTER TABLE `orber_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orber_admins`
--
ALTER TABLE `orber_admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `orber_answers`
--
ALTER TABLE `orber_answers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `orber_categories`
--
ALTER TABLE `orber_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `orber_cms_pages`
--
ALTER TABLE `orber_cms_pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `orber_events`
--
ALTER TABLE `orber_events`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `orber_favoritevent`
--
ALTER TABLE `orber_favoritevent`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `orber_invite`
--
ALTER TABLE `orber_invite`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `orber_mails`
--
ALTER TABLE `orber_mails`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `orber_posts`
--
ALTER TABLE `orber_posts`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `orber_questions`
--
ALTER TABLE `orber_questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `orber_uploads`
--
ALTER TABLE `orber_uploads`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `orber_users`
--
ALTER TABLE `orber_users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
