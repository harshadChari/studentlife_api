-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 23, 2019 at 01:37 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `studentlife`
--

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` varchar(23) NOT NULL,
  `name` varchar(75) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `user_id` varchar(23) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `created_at`, `user_id`) VALUES
('5dd119abf0c143.52630392', 'my first grp', '2019-11-17 15:28:03', '5dada8ebc2d567.20749654'),
('5dd13c31176cf6.00294191', 'tymca', '2019-11-17 17:55:21', '5dada8ebc2d567.20749654'),
('5dd13ebb03ae13.00184250', 'my second grp', '2019-11-17 18:06:11', '5dada8ebc2d567.20749654'),
('5dd13ef3c1daf8.92318960', 'my second grp', '2019-11-17 18:07:07', '5dada8ebc2d567.20749654'),
('5dd141810403a5.73706153', 'guyu', '2019-11-17 18:18:01', '5dada8ebc2d567.20749654'),
('5dd26c9ede4751.11867879', 'my second grp', '2019-11-18 15:34:14', '5dada8ebc2d567.20749654');

-- --------------------------------------------------------

--
-- Table structure for table `group_members`
--

CREATE TABLE `group_members` (
  `user_id` varchar(23) NOT NULL,
  `group_id` varchar(23) NOT NULL,
  `admin_state` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `group_members`
--

INSERT INTO `group_members` (`user_id`, `group_id`, `admin_state`) VALUES
('5dada8ebc2d567.20749654', '5dd119abf0c143.52630392', 0),
('5dada8ebc2d567.20749654', '5dd13c31176cf6.00294191', 0),
('5dada8ebc2d567.20749654', '5dd13ef3c1daf8.92318960', 1),
('5dada8ebc2d567.20749654', '5dd141810403a5.73706153', 1),
('5dada8ebc2d567.20749654', '5dd26c9ede4751.11867879', 1),
('5dc254f7746a16.79451858', '5dd141810403a5.73706153', 0);

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `image` varchar(500) NOT NULL,
  `tags` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `image`, `tags`) VALUES
(1, 'overcome.jpg', 'gift'),
(2, 'overcome.jpg', 'gift');

-- --------------------------------------------------------

--
-- Table structure for table `notices`
--

CREATE TABLE `notices` (
  `id` varchar(23) NOT NULL,
  `user_id` varchar(23) NOT NULL,
  `title` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `document_path` varchar(250) DEFAULT NULL,
  `access` tinyint(4) NOT NULL DEFAULT 0,
  `group_id` varchar(23) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notices`
--

INSERT INTO `notices` (`id`, `user_id`, `title`, `content`, `document_path`, `access`, `group_id`, `created_at`) VALUES
('5dce68d0eee9c1.83952313', '5dc254f7746a16.79451858', 'Complete Api', 'You must finish this api in 45 minutes or else you will need more time you lazy rascal.', 'http://192.168.141.1/studentlife_api/api/uploads/19.jpg', 0, NULL, '2019-11-17 00:00:00'),
('5dce7675dfb516.40967842', '5dc254f7746a16.79451858', 'last', 'one', 'http://192.168.141.1/studentlife_api/api/uploads/19.jpg', 0, NULL, '2019-11-17 00:00:00'),
('5dce78ba3e5f18.43489291', '5dc254f7746a16.79451858', 'ss', 'nn', 'http://192.168.141.1/studentlife_api/api/uploads/19.jpg', 0, NULL, '2019-11-17 00:00:00'),
('5dd0f3ce16a349.43931707', '5dc254f7746a16.79451858', 'work', 'alwyas', 'http://192.168.141.1/studentlife_api/api/uploads/19.jpg', 0, NULL, '2019-11-17 00:00:00'),
('5dd12162915028.60618341', '5dada8ebc2d567.20749654', '1st grp post', 'listen to me', 'http://192.168.141.1/studentlife_api/api/uploads/19.jpg', 1, '5dd119abf0c143.52630392', '2019-11-17 16:00:58'),
('5dd14ea3940678.08929093', '5dada8ebc2d567.20749654', 'got it', 'Lgfyg', 'http://192.168.141.1/studentlife_api/api/uploads/19.jpg', 0, NULL, '2019-11-17 19:14:03'),
('5dd14fdb306a82.85474925', '5dada8ebc2d567.20749654', 'isa ', 'tomirrow', 'http://192.168.141.1/studentlife_api/api/uploads/19.jpg', 1, '5dd119abf0c143.52630392', '2019-11-17 19:19:15'),
('5dd198d9d18782.91959391', '5dada8ebc2d567.20749654', 'with image', 'vasfadfafsdfa', 'http://192.168.141.1/studentlife_api/api/uploads/19.jpg', 0, NULL, '2019-11-18 00:30:41'),
('5dd1993d5765d5.18455405', '5dada8ebc2d567.20749654', 'with image', 'vasfadfafsdfa', 'http://192.168.141.1/studentlife_api/api/uploads/19.jpg', 0, NULL, '2019-11-18 00:32:21'),
('5dd1998c9d9f75.45511160', '5dada8ebc2d567.20749654', 'with image', 'vasfadfafsdfa', 'http://192.168.141.1/studentlife_api/api/uploads/19.jpg', 0, NULL, '2019-11-18 00:33:40'),
('5dd199bcde9617.90830562', '5dada8ebc2d567.20749654', 'with image', 'vasfadfafsdfa', 'http://192.168.141.1/studentlife_api/api/uploads/19.jpg', 0, NULL, '2019-11-18 00:34:28'),
('5dd19cf8cd0c09.41044146', '5dada8ebc2d567.20749654', 'with image', 'vasfadfafsdfa', 'http://192.168.141.1/studentlife_api/api/uploads/19.jpg', 1, '5dd13c31176cf6.00294191', '2019-11-18 00:48:16'),
('5dd26e38ddc825.82497285', '5dada8ebc2d567.20749654', 'news', 'good news', 'http://192.168.141.1/studentlife_api/api/uploads/19.jpg', 1, '5dd13ef3c1daf8.92318960', '2019-11-18 15:41:04'),
('5dd579a568fbe3.90661558', '5dada8ebc2d567.20749654', 'dhfugit', 'cjfjgigi', 'http://192.168.141.1/studentlife_api/api/uploads/19.jpg', 1, '5dd13ef3c1daf8.92318960', '2019-11-20 23:06:37'),
('5dd57aafac03d8.15335193', '5dada8ebc2d567.20749654', ' hcuft', 'iguf', 'http://192.168.141.1/studentlife_api/api/uploads/19.jpg', 1, '5dd13ef3c1daf8.92318960', '2019-11-20 23:11:03'),
('5dd57aeb2616f5.25957820', '5dada8ebc2d567.20749654', ' jfuf', 'gkboh', 'http://192.168.141.1/studentlife_api/api/uploads/19.jpg', 1, '5dd13ef3c1daf8.92318960', '2019-11-20 23:12:03'),
('5dd57c87bfd021.32945923', '5dada8ebc2d567.20749654', ' vhhy', 'yjnhu', 'http://192.168.141.1/studentlife_api/api/uploads/19.jpg', 1, '5dd119abf0c143.52630392', '2019-11-20 23:18:55'),
('5dd57d9b9ca747.31489245', '5dada8ebc2d567.20749654', ' bcug', 'gigoho', 'http://192.168.141.1/studentlife_api/api/uploads/19.jpg', 1, '5dd119abf0c143.52630392', '2019-11-20 23:23:31'),
('5dd57f84a4bb29.75899732', '5dada8ebc2d567.20749654', 'ucfu', 'fjgi', 'http://192.168.141.1/studentlife_api/api/uploads/19.jpg', 0, '5dd119abf0c143.52630392', '2019-11-20 23:31:40'),
('5dd57fb8cbac65.57731591', '5dada8ebc2d567.20749654', 'jhhhh', '6666', 'http://192.168.141.1/studentlife_api/api/uploads/19.jpg', 0, '5dd119abf0c143.52630392', '2019-11-20 23:32:32'),
('5dd5802a56c303.73022855', '5dada8ebc2d567.20749654', 'hur', '4444', 'http://192.168.141.1/studentlife_api/api/uploads/19.jpg', 0, '5dd119abf0c143.52630392', '2019-11-20 23:34:26'),
('5dd58165943889.51352064', '5dada8ebc2d567.20749654', 'kittu', '765', 'http://192.168.141.1/studentlife_api/api/uploads/19.jpg', 1, '5dd119abf0c143.52630392', '2019-11-20 23:39:41'),
('5dd582f357f208.09095674', '5dada8ebc2d567.20749654', 'lastu', '1112', 'http://192.168.141.1/studentlife_api/api/uploads/19.jpg', 1, '5dd119abf0c143.52630392', '2019-11-20 23:46:19'),
('5dd58494015d13.73951464', '5dada8ebc2d567.20749654', 'cjvui', '57585', 'http://192.168.141.1/studentlife_api/api/uploads/19.jpg', 1, '5dd141810403a5.73706153', '2019-11-20 23:53:16'),
('5dd584abe390f3.96136525', '5dada8ebc2d567.20749654', 'fufuut', 't4', NULL, 1, '5dd141810403a5.73706153', '2019-11-20 23:53:39'),
('5dd58510b19cf6.17345212', '5dada8ebc2d567.20749654', 'vhh', 'p0p00', 'http://192.168.141.1/studentlife_api/api/uploads/19.jpg', 1, '5dd141810403a5.73706153', '2019-11-20 23:55:20'),
('5dd58c19bcbc37.51263753', '5dada8ebc2d567.20749654', 'xrsrssd', 'dte5e', 'http://192.168.141.1/studentlife_api/api/uploads/19.jpg', 1, '5dd13ef3c1daf8.92318960', '2019-11-21 00:25:21'),
('5dd58ccbcaeb35.25733929', '5dada8ebc2d567.20749654', 'xtdddyf', 'tdtd', 'http://192.168.141.1/studentlife_api/api/uploads/19.jpg', 1, '5dd13ef3c1daf8.92318960', '2019-11-21 00:28:19'),
('5dd911928c4336.14236934', '5dada8ebc2d567.20749654', 'this is a post', 'with an imzge', 'http://192.168.141.1/studentlife_api/api/./../uploads/29.jpg', 1, '5dd26c9ede4751.11867879', '2019-11-23 16:31:38'),
('5dd911a6d1dc14.62306796', '5dada8ebc2d567.20749654', 'this is a post without an image', 'got it', 'http://192.168.141.1/studentlife_api/api/./../uploads/30.jpg', 1, '5dd26c9ede4751.11867879', '2019-11-23 16:31:58'),
('5dd911e927fa27.86194429', '5dada8ebc2d567.20749654', 'oksy ', 'really', NULL, 1, '5dd26c9ede4751.11867879', '2019-11-23 16:33:05');

-- --------------------------------------------------------

--
-- Table structure for table `period`
--

CREATE TABLE `period` (
  `id` varchar(23) NOT NULL,
  `timetable_id` varchar(23) NOT NULL,
  `day_index` int(11) NOT NULL,
  `date` date NOT NULL,
  `period_index` int(11) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `subject_id` varchar(23) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `semester`
--

CREATE TABLE `semester` (
  `id` varchar(23) NOT NULL,
  `user_id` varchar(23) NOT NULL,
  `title` varchar(25) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `status` varchar(15) NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `semester`
--

INSERT INTO `semester` (`id`, `user_id`, `title`, `start_date`, `end_date`, `status`) VALUES
('5db48f864c6359.50848401', '5dada8ebc2d567.20749654', 'sem 1', '2019-07-12', '2019-10-28', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `id` varchar(23) NOT NULL,
  `sem_id` varchar(23) NOT NULL,
  `name` varchar(25) NOT NULL,
  `type` varchar(20) NOT NULL,
  `class` varchar(20) DEFAULT NULL,
  `teacher` varchar(20) DEFAULT NULL,
  `internal_mks` decimal(10,0) NOT NULL,
  `external_mks` decimal(10,0) NOT NULL,
  `obt_mks` decimal(10,0) NOT NULL,
  `grade` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `timetable`
--

CREATE TABLE `timetable` (
  `id` varchar(23) NOT NULL,
  `sem_id` varchar(23) NOT NULL,
  `title` varchar(35) NOT NULL,
  `type` varchar(20) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `unique_id` varchar(23) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `encrypted_password` varchar(80) NOT NULL,
  `salt` varchar(10) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `unique_id`, `name`, `email`, `encrypted_password`, `salt`, `created_at`, `updated_at`) VALUES
(1, '5dada8ebc2d567.20749654', 'user one', 'userone@email.com', '3nQoM61r3f3O5LKWcuWG283P+KNlMDVkYmZmNzg1', 'e05dbff785', '2019-10-21 18:17:39', NULL),
(2, '5dc254f7746a16.79451858', 'user two', 'usertwo@email.com', 'jTz/ideNrIhycNd0OpF/zWUUEhU0NDViYjEyYTRi', '445bb12a4b', '2019-11-06 10:37:03', NULL),
(3, '5dc9068a8eea27.66857900', 'user three', 'userthree@email.com', 'muIc5IFGowsXL7BrHuBhnIlrEm41OGJhODFjNDRm', '58ba81c44f', '2019-11-11 12:28:18', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `creator_id` (`user_id`);

--
-- Indexes for table `group_members`
--
ALTER TABLE `group_members`
  ADD PRIMARY KEY (`user_id`,`group_id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notices`
--
ALTER TABLE `notices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `group_id` (`group_id`);

--
-- Indexes for table `period`
--
ALTER TABLE `period`
  ADD PRIMARY KEY (`id`),
  ADD KEY `timetable_id` (`timetable_id`),
  ADD KEY `subject_id` (`subject_id`);

--
-- Indexes for table `semester`
--
ALTER TABLE `semester`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sem_id` (`sem_id`);

--
-- Indexes for table `timetable`
--
ALTER TABLE `timetable`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sem_id` (`sem_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_id` (`unique_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `groups`
--
ALTER TABLE `groups`
  ADD CONSTRAINT `groups_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`unique_id`);

--
-- Constraints for table `notices`
--
ALTER TABLE `notices`
  ADD CONSTRAINT `notices_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`unique_id`),
  ADD CONSTRAINT `notices_ibfk_2` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`);

--
-- Constraints for table `period`
--
ALTER TABLE `period`
  ADD CONSTRAINT `period_ibfk_1` FOREIGN KEY (`timetable_id`) REFERENCES `timetable` (`id`),
  ADD CONSTRAINT `period_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`id`);

--
-- Constraints for table `semester`
--
ALTER TABLE `semester`
  ADD CONSTRAINT `semester_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`unique_id`);

--
-- Constraints for table `subject`
--
ALTER TABLE `subject`
  ADD CONSTRAINT `subject_ibfk_1` FOREIGN KEY (`sem_id`) REFERENCES `semester` (`id`);

--
-- Constraints for table `timetable`
--
ALTER TABLE `timetable`
  ADD CONSTRAINT `timetable_ibfk_1` FOREIGN KEY (`sem_id`) REFERENCES `semester` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
