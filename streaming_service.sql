-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 12, 2022 at 10:50 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `streaming_service`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`) VALUES
(2, 'Basketball'),
(3, 'Gymnastics'),
(6, 'Others'),
(7, 'Swimming');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `comment_id` int(11) NOT NULL,
  `video_id` int(11) NOT NULL,
  `user_email` varchar(400) NOT NULL,
  `comment` varchar(10000) NOT NULL,
  `comment_date` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`comment_id`, `video_id`, `user_email`, `comment`, `comment_date`) VALUES
(1, 55, 'sachinkhatri53@gmail.com', 'Bolt is a legend', '2022-09-25 15:38:05pm'),
(2, 55, 'sachinkhatri53@gmail.com', 'True pride of the nation', '2022-09-25 15:38:37pm'),
(3, 55, 'sachinkhatri53@gmail.com', 'Hello', '2022-09-25 15:40:42pm'),
(4, 55, 'sachinkhatri53@gmail.com', 'Legend', '2022-09-25 15:42:21pm'),
(15, 55, 'sachinkhatri53@gmail.com', 'Hello', '2022-09-25 15:54:03pm'),
(16, 55, 'sachinkhatri53@gmail.com', 'hi', '2022-09-25 15:54:20pm'),
(17, 55, 'sachinkhatri53@gmail.com', 'asdads', '2022-09-25 15:54:40pm'),
(18, 55, 'bsl33bsal@gmail.com', 'Hello', '2022-09-28 14:06:42pm'),
(19, 55, 'bsl33bsal@gmail.com', 'Hi', '2022-09-28 14:06:55pm'),
(20, 55, 'bsl33bsal@gmail.com', 'Usain is legend', '2022-09-28 14:07:08pm'),
(21, 61, 'bsl33bsal@gmail.com', 'WOW !! GREAT', '2022-09-29 11:41:26am'),
(24, 60, 'sachinkhatri53@gmail.com', 'Phelps is just wow', '2022-09-29 21:05:11pm'),
(25, 60, '', 'Sheer determination from the man', '2022-09-30 01:22:23am'),
(26, 60, 'bishalpkr.2056@gmail.com', 'Nice Video', '2022-09-30 10:31:12am'),
(27, 64, 'bsl33bsal@gmail.com', 'She is incredible', '2022-10-12 21:23:35pm'),
(28, 62, 'bishalaryal1067@gmail.com', 'Wow a very nice event', '2022-10-12 22:42:23pm'),
(29, 65, 'bishalaryal1067@gmail.com', 'Wow she is great', '2022-10-12 22:47:39pm');

-- --------------------------------------------------------

--
-- Table structure for table `fixtures`
--

CREATE TABLE `fixtures` (
  `fixture_id` int(11) NOT NULL,
  `fixture_title` varchar(250) NOT NULL,
  `fixture_date` varchar(250) NOT NULL,
  `fixture_category` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fixtures`
--

INSERT INTO `fixtures` (`fixture_id`, `fixture_title`, `fixture_date`, `fixture_category`) VALUES
(23, '100m Hurdle race', '2022-09-30 01:33', 'Marathon'),
(27, '500m relay race (men)', '2022-10-14 00:15', 'Marathon'),
(28, 'Japan vs Belgium', '2022-09-30 07:45', 'Football');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `image_id` int(11) NOT NULL,
  `image_path` varchar(250) NOT NULL,
  `image_caption` varchar(250) NOT NULL,
  `image_category` varchar(250) NOT NULL,
  `upload_date` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`image_id`, `image_path`, `image_caption`, `image_category`, `upload_date`) VALUES
(14, 'marathon.jpg', 'Marathon', 'Marathon', '2022-09-29 / 10:36:05am'),
(16, 'stadium.jpg', 'Stadium', 'Others', '2022-10-12 / 20:03:51pm');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `video_id` int(11) NOT NULL,
  `email` varchar(400) NOT NULL,
  `action` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`video_id`, `email`, `action`) VALUES
(55, 'sachinkhatri53@gmail.com', 'liked'),
(60, 'bishalpkr.2056@gmail.com', 'liked'),
(64, 'bsl33bsal@gmail.com', 'liked'),
(62, 'bishalaryal1067@gmail.com', 'liked');

-- --------------------------------------------------------

--
-- Table structure for table `live`
--

CREATE TABLE `live` (
  `live_id` int(11) NOT NULL,
  `title` varchar(500) NOT NULL,
  `url` varchar(500) NOT NULL,
  `category` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `live`
--

INSERT INTO `live` (`live_id`, `title`, `url`, `category`) VALUES
(3, 'Athletics Day 6 ', 'https://www.youtube.com/embed/v07MQfL1lRw', 'Others');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `message_id` int(11) NOT NULL,
  `full_name` varchar(300) NOT NULL,
  `email` varchar(300) NOT NULL,
  `message` varchar(10000) NOT NULL,
  `status` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `news_id` int(11) NOT NULL,
  `news_title` varchar(250) NOT NULL,
  `image_path` varchar(250) NOT NULL,
  `news_description` varchar(5000) NOT NULL,
  `news_date` varchar(250) NOT NULL,
  `news_category` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`news_id`, `news_title`, `image_path`, `news_description`, `news_date`, `news_category`) VALUES
(4, 'A lot of stadiums being renovated', 'stadium.jpg', 'Before the start of the olympic event a lot of stadiums are being renovated. Stadiums were facing problems like leakage, rats and pests.', '2022-10-12 / 20:05:36pm', 'Others'),
(5, 'Marathon date rescheduled', 'marathon.jpg', 'Due to some complications olympic committee is deciding to postpone and reschedule 100m (men and women) marathon ', '2022-10-12 / 20:24:02pm', 'Marathon'),
(6, 'Discussion about the rules of olympics', 'discuss.jpg', 'There are serious discussions being held for changing the rules of various sports in olympics', '2022-10-12 / 22:17:54pm', 'Others'),
(8, 'Inverstigation of doping cases', 'marathon.jpg', 'Doping cases are being seriously investigated to find the culprit', '2022-10-12 / 23:55:27pm', 'Others');

-- --------------------------------------------------------

--
-- Table structure for table `password_requests`
--

CREATE TABLE `password_requests` (
  `request_id` int(11) NOT NULL,
  `requested_by` varchar(250) NOT NULL,
  `request_date` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_information`
--

CREATE TABLE `user_information` (
  `full_name` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `country` varchar(250) NOT NULL,
  `phone_number` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `status` varchar(10) NOT NULL,
  `role` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='user information.. of streaming service';

--
-- Dumping data for table `user_information`
--

INSERT INTO `user_information` (`full_name`, `email`, `country`, `phone_number`, `password`, `status`, `role`) VALUES
('Jack Jacobs', 'bishalpkr.2056@gmail.com', 'Afghanistan', '5569841', '$2y$11$oUCQRKtlEL/3kmiNEGTuDewX8uM5ihIJVgzqoPF3M5CCSc8Z9MD7i', 'active', 'user'),
('Ram Hari', 'bishalaryal@ismt.edu.np', 'Afghanistan', '96475113', '$2y$11$oUCQRKtlEL/3kmiNEGTuDewX8uM5ihIJVgzqoPF3M5CCSc8Z9MD7i', 'active', 'user'),
('Walt Morgan', 'bsl33bsal@gmail.com', 'United Kingdom', '4545613264', '$2y$11$DbuLFbJoC3V2EjH2p6Qm7eFKf2FA8LSLbxptxpxpVOEVHJ1ZNG1bK', 'active', 'user'),
('Admin', 'FunOlympic@gmail.com', 'Chaiyna', '01336987', '$2y$11$5EUA66uMvAjBTMSdcj3mCuN4CC44FJ0vGX1/YA8WxmcIMHuxJJYpS', 'active', 'admin'),
('Bishal Aryal', 'bishalaryal1067@gmail.com', 'Nepal', '9867341502', '$2y$11$3u/2njKs8C8aJSR0WDpjE.oXYeW6maXL8AivEzSss4VarJ2d14Q8.', 'active', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `user_security`
--

CREATE TABLE `user_security` (
  `email` varchar(250) NOT NULL,
  `security_question` varchar(1500) NOT NULL,
  `answer` varchar(1000) NOT NULL,
  `security_pin` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_security`
--

INSERT INTO `user_security` (`email`, `security_question`, `answer`, `security_pin`) VALUES
('bsl33bsal@gmail.com', 'Where do you live?', 'home', '3412'),
('sachinkhatri53@gmail.com', 'What is the name of you favorite pet?', 'tommy', '2580'),
('bsl33bsal@gmail.com', 'Where do you go for vacation?', 'tinkune', '9867'),
('sachinkhatri53@gmail.com', 'What is the name of you favorite pet?', 'tommy', '3054'),
('bishalpkr.2056@gmail.com', 'Where do you live?', 'home', '1234'),
('bishalaryal@ismt.edu.np', 'Where do you live?', 'home', '1234'),
('bsl33bsal@gmail.com', 'Where do you live?', 'Heaven', '6688'),
('bsl33bsal@gmail.com', 'Where do you live?', 'Heaven', '6688'),
('bishalaryal1067@gmail.com', 'Where do you live?', 'Heaven', '6688'),
('bishalaryal1067@gmail.com', 'Where do you live?', 'Heaven', '6688');

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `video_id` int(11) NOT NULL,
  `video_path` varchar(500) NOT NULL,
  `video_title` varchar(250) NOT NULL,
  `video_description` varchar(5000) NOT NULL,
  `video_date` varchar(250) NOT NULL,
  `video_category` varchar(100) NOT NULL,
  `view_count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`video_id`, `video_path`, `video_title`, `video_description`, `video_date`, `video_category`, `view_count`) VALUES
(60, 'https://www.youtube.com/embed/e-ldwePuoW0', 'Best of micheal phelps', 'Highlights from micheal phelps', '2022-09-29 / 08:33:41am', 'Marathon', 104),
(62, 'https://www.youtube.com/embed/CwzjlmBLfrQ', 'Mr. Bean perform at the olympics', 'Wonderful performance by Mr.Bean in the olympic event.', '2022-10-12 / 16:44:02pm', 'Others', 11),
(64, 'https://www.youtube.com/embed/3jReR9pL4Nw', 'Nadia Comaneci and her story', 'Life story of a splendid gymnast Nadia Comaneci', '2022-10-12 / 16:51:13pm', 'Gymnastics', 8);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `fixtures`
--
ALTER TABLE `fixtures`
  ADD PRIMARY KEY (`fixture_id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`image_id`);

--
-- Indexes for table `live`
--
ALTER TABLE `live`
  ADD PRIMARY KEY (`live_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`message_id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`news_id`);

--
-- Indexes for table `password_requests`
--
ALTER TABLE `password_requests`
  ADD PRIMARY KEY (`request_id`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`video_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `fixtures`
--
ALTER TABLE `fixtures`
  MODIFY `fixture_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `live`
--
ALTER TABLE `live`
  MODIFY `live_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `news_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `password_requests`
--
ALTER TABLE `password_requests`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `video_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
