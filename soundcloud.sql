-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 17, 2016 at 11:18 PM
-- Server version: 5.7.16-0ubuntu0.16.04.1
-- PHP Version: 5.6.28-1+deb.sury.org~xenial+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `soundcloud`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `email` varchar(255) NOT NULL,
  `password` varchar(50) NOT NULL,
  `name` varchar(200) NOT NULL,
  `confirmed` tinyint(1) NOT NULL DEFAULT '0',
  `confirm_key` int(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`email`, `password`, `name`, `confirmed`, `confirm_key`) VALUES
('a', '1', '', 1, 0),
('admin', '1', '', 1, 12345678),
('clone2301@gmail.com', '1', 'thai', 0, 8227539),
('hau', '1', '', 1, 0),
('hau123', '1', '', 1, 0),
('hau1234', '1', '', 1, 0),
('hau12345', '1', '', 0, 0),
('hau2', '1', '', 0, 0),
('hau3', '1', '', 0, 0),
('hoangthai.95@gmail.com', '1', 'thai', 1, 37707519),
('maiphuongloan96@gmail.com', 'melien230771', '', 0, 0),
('manhtruonghedspi@gmail.com', '1', 'truongnm', 1, 68920898),
('nhom940com@gmail.com', '1', 'thai', 1, 29238891),
('thai1', '1', '', 1, 0),
('truong', '1', '', 0, 0),
('truongkechun@gmail.com', '123456', '', 0, 0),
('vu', '1', '', 0, 0),
('vu123', '1', '', 0, 0),
('vu24', '1', '', 0, 0),
('vuphamas@gmail.com', '1', 'vu', 1, 62551879);

-- --------------------------------------------------------

--
-- Table structure for table `action`
--

CREATE TABLE `action` (
  `actionID` int(8) NOT NULL,
  `userID` int(8) NOT NULL,
  `songID` int(8) DEFAULT NULL,
  `playlistID` int(8) DEFAULT NULL,
  `time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `action`
--

INSERT INTO `action` (`actionID`, `userID`, `songID`, `playlistID`, `time`) VALUES
(1, 3, 97, NULL, '2016-11-29 19:16:30'),
(2, 3, 98, NULL, '2016-11-29 19:18:10'),
(4, 3, 100, NULL, '2016-11-29 19:21:17'),
(8, 1, NULL, 16, '2016-11-29 16:30:23'),
(9, 3, 104, NULL, '2016-11-29 21:13:52'),
(10, 3, 105, NULL, '2016-12-01 16:04:25'),
(12, 3, 107, NULL, '2016-12-03 16:24:20'),
(13, 3, 108, NULL, '2016-12-03 17:12:52'),
(17, 3, 112, NULL, '2016-12-03 17:14:55'),
(18, 3, 113, NULL, '2016-12-03 17:17:03'),
(19, 3, 114, NULL, '2016-12-03 21:31:24'),
(24, 3, 119, NULL, '2016-12-04 23:24:33'),
(25, 5, 120, NULL, '2016-12-04 23:27:08'),
(26, 3, 121, NULL, '2016-12-05 19:25:47'),
(27, 3, 122, NULL, '2016-12-05 19:49:37'),
(28, 3, 123, NULL, '2016-12-05 19:49:50'),
(29, 3, 124, NULL, '2016-12-05 19:51:17'),
(30, 6, 125, NULL, '2016-12-05 19:53:52'),
(31, 3, 126, NULL, '2016-12-05 19:57:35'),
(38, 6, 133, NULL, '2016-12-05 20:13:46'),
(39, 6, 134, NULL, '2016-12-05 20:14:11'),
(40, 6, 135, NULL, '2016-12-05 20:15:56'),
(41, 6, 136, NULL, '2016-12-05 20:17:13'),
(42, 6, 137, NULL, '2016-12-05 20:17:20'),
(43, 6, 138, NULL, '2016-12-05 20:46:19'),
(44, 3, 139, NULL, '2016-12-06 18:53:03'),
(49, 19, 144, NULL, '2016-12-09 11:14:39'),
(50, 17, 145, NULL, '2016-12-09 11:22:54'),
(51, 19, 146, NULL, '2016-12-09 11:23:36'),
(53, 17, 148, NULL, '2016-12-09 11:25:42'),
(54, 20, 149, NULL, '2016-12-09 11:28:28'),
(55, 19, 150, NULL, '2016-12-09 11:28:56'),
(56, 19, 151, NULL, '2016-12-09 11:31:39'),
(58, 1, 153, NULL, '2016-12-09 14:46:01'),
(59, 1, 154, NULL, '2016-12-09 14:52:37');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminID` varchar(8) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminID`, `email`) VALUES
('', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `cmtID` int(12) NOT NULL,
  `time` datetime NOT NULL,
  `content` text NOT NULL,
  `userID` int(8) NOT NULL,
  `songID` int(8) DEFAULT NULL,
  `playlistID` int(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`cmtID`, `time`, `content`, `userID`, `songID`, `playlistID`) VALUES
(6, '2016-11-29 19:31:39', 'lul', 3, 98, NULL),
(7, '2016-11-29 19:31:43', 'thai ngu loz', 3, 98, NULL),
(8, '2016-12-01 20:03:08', 'lul', 3, 105, NULL),
(9, '2016-12-01 20:03:10', 'dm xin vcc', 3, 105, NULL),
(10, '2016-12-05 16:37:02', 'a', 3, 119, NULL),
(11, '2016-12-07 09:43:45', 'z', 3, 139, NULL),
(12, '2016-12-07 09:43:46', 'wqeqwe', 3, 139, NULL),
(14, '2016-12-09 11:44:53', 'ã„ã„ã­ãˆãˆãˆãˆï¼ï¼ï¼', 19, 148, NULL),
(15, '2016-12-09 11:52:17', 'dfgdfg', 17, NULL, 36);

-- --------------------------------------------------------

--
-- Table structure for table `follow`
--

CREATE TABLE `follow` (
  `userID1` int(8) NOT NULL,
  `userID2` int(8) NOT NULL,
  `time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `follow`
--

INSERT INTO `follow` (`userID1`, `userID2`, `time`) VALUES
(1, 3, '2016-12-09 14:53:18'),
(3, 1, '2016-12-09 14:53:56'),
(3, 4, '2016-12-01 18:32:02'),
(3, 6, '2016-12-05 18:40:52'),
(3, 7, '0000-00-00 00:00:00'),
(3, 8, '0000-00-00 00:00:00'),
(3, 10, '2016-12-05 18:39:20'),
(5, 1, '2016-12-01 16:29:28'),
(6, 1, '2016-12-05 17:27:19'),
(6, 3, '2016-12-05 17:11:41'),
(6, 5, '2016-12-05 17:26:52'),
(8, 5, '0000-00-00 00:00:00'),
(10, 1, '2016-12-01 10:11:25'),
(11, 1, '2016-12-01 10:30:32'),
(12, 1, '2016-12-01 10:31:47'),
(17, 1, '2016-12-08 20:40:05'),
(17, 3, '2016-12-09 11:11:58'),
(17, 5, '2016-12-09 11:12:10'),
(17, 20, '2016-12-09 11:33:08'),
(19, 3, '2016-12-09 11:19:53'),
(19, 17, '2016-12-09 11:17:41'),
(19, 20, '2016-12-09 11:21:23'),
(20, 3, '2016-12-09 11:22:09'),
(20, 17, '2016-12-09 11:21:44'),
(20, 19, '2016-12-09 11:21:56');

-- --------------------------------------------------------

--
-- Table structure for table `genre`
--

CREATE TABLE `genre` (
  `genreID` int(2) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `likesong`
--

CREATE TABLE `likesong` (
  `userID` int(8) NOT NULL,
  `songID` int(8) NOT NULL,
  `time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `likesong`
--

INSERT INTO `likesong` (`userID`, `songID`, `time`) VALUES
(3, 72, '2016-12-06 20:09:32'),
(3, 83, '2016-12-01 15:29:58'),
(3, 98, '2016-12-01 14:44:38'),
(3, 153, '2016-12-09 14:54:15'),
(3, 158, '2016-12-09 13:17:45'),
(5, 81, '2016-12-01 14:58:49'),
(5, 83, '2016-12-01 16:15:59'),
(17, 141, '2016-12-09 10:35:29'),
(17, 149, '2016-12-09 11:33:14'),
(19, 148, '2016-12-09 11:44:44');

-- --------------------------------------------------------

--
-- Table structure for table `playlist`
--

CREATE TABLE `playlist` (
  `playlistID` int(8) NOT NULL,
  `name` varchar(50) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `viewCount` int(11) NOT NULL DEFAULT '0',
  `likeCount` int(11) NOT NULL DEFAULT '0',
  `userID` int(8) NOT NULL,
  `createTime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `playlist`
--

INSERT INTO `playlist` (`playlistID`, `name`, `image`, `viewCount`, `likeCount`, `userID`, `createTime`) VALUES
(7, 'aaa', NULL, 0, 0, 5, '2016-11-28 16:10:20'),
(12, 'haupro', NULL, 0, 0, 3, '2016-11-29 15:30:45'),
(13, 'hau1', NULL, 0, 0, 6, '2016-11-29 15:35:24'),
(16, 'fdghdfhdfh', NULL, 0, 0, 3, '2016-11-29 16:30:23'),
(27, 'lul', NULL, 0, 0, 0, '2016-12-01 18:17:54'),
(29, 'aabbcc', NULL, 0, 0, 3, '2016-12-02 01:25:54'),
(30, 'lululul', NULL, 0, 0, 3, '2016-12-03 16:28:33'),
(33, 'd', NULL, 0, 0, 1, '2016-12-08 09:26:08'),
(34, 'Favorite', NULL, 0, 0, 19, '2016-12-09 11:48:35'),
(36, 'myplaylist', NULL, 0, 0, 17, '2016-12-09 11:51:18'),
(38, 'demo', NULL, 0, 0, 1, '2016-12-09 13:08:49'),
(39, 'demo', NULL, 0, 0, 1, '2016-12-09 13:08:54'),
(40, 'demi2', NULL, 0, 0, 1, '2016-12-09 13:09:05'),
(41, 'demi2dsd', NULL, 0, 0, 1, '2016-12-09 13:09:10');

-- --------------------------------------------------------

--
-- Table structure for table `song`
--

CREATE TABLE `song` (
  `songID` int(8) NOT NULL,
  `title` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `artist` varchar(50) DEFAULT NULL,
  `length` time DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `lyric` text,
  `genre` varchar(100) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `album` varchar(50) DEFAULT NULL,
  `viewCount` int(11) NOT NULL DEFAULT '0',
  `likeCount` int(11) NOT NULL DEFAULT '0',
  `uploadTime` datetime DEFAULT NULL,
  `userID` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `song`
--

INSERT INTO `song` (`songID`, `title`, `name`, `artist`, `length`, `year`, `lyric`, `genre`, `image`, `album`, `viewCount`, `likeCount`, `uploadTime`, `userID`) VALUES
(72, 'Addicted To You.mp3', 'Addicted To You.mp3', 'Avicii,Mac Davis,Audra Mae', NULL, 0, NULL, '', NULL, 'True', 1, 1, '2016-11-28 10:00:12', 5),
(77, 'Addicted To You.mp3', 'Addicted To You.mp3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2016-11-28 16:10:42', 5),
(78, 'Anata no Egao (ballad Version).mp3', 'Anata no Egao (ballad Version).mp3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 7, 0, '2016-11-28 16:14:59', 5),
(79, 'Ai Cho TÃ´i TÃ¬nh YÃªu.mp3', 'Ai Cho TÃ´i TÃ¬nh YÃªu.mp3', 'Le Quyen', NULL, 0, NULL, '', NULL, 'Album Moi Cua Le Quyen Tao De Nghe Choi', 13, 0, '2016-11-28 16:16:02', 5),
(82, 'Maps - Maroon 5 [MP3 320kbps].mp3', 'Maps - Maroon 5 [MP3 320kbps].mp3', 'Maroon 5', NULL, 2014, NULL, '(13)Pop', NULL, 'Maps (Single)', 0, 0, '2016-11-29 15:06:21', 3),
(87, 'Orange - 7__ Seven Oops_ [MP3 320kbps].mp3', 'Orange - 7__ Seven Oops_ [MP3 320kbps].mp3', '7!! (Seven Oops)', NULL, 2015, NULL, '(13)Pop', NULL, 'Orange (Shigatsu wa Kimi no Uso ED2)', 100, 0, '2016-11-29 15:20:20', 3),
(88, 'Maps - Maroon 5 [MP3 320kbps].mp3', 'Maps - Maroon 5 [MP3 320kbps].mp3', 'Maroon 5', NULL, 2014, NULL, '(13)Pop', NULL, 'Maps (Single)', 151, 0, '2016-11-29 15:33:06', 6),
(89, 'Stitches - Shawn Mendes [MP3 320kbps].mp3', 'Stitches - Shawn Mendes [MP3 320kbps].mp3', 'Shawn Mendes', NULL, 2015, NULL, '(13)Pop', NULL, 'Handwritten', 20, 0, '2016-11-29 15:34:30', 6),
(90, 'Piercing Light Mako Remix_ - League Of L [MP3 320kbps].mp3', 'Piercing Light Mako Remix_ - League Of L [MP3 320kbps].mp3', 'League Of Legends', NULL, 2016, NULL, 'Remix', NULL, 'Warsongs', 201, 0, '2016-11-29 16:59:21', 3),
(92, '1dfgdfgdfgdf gdf gdfg ', 'To The Beginning - Kalafina [MP3 320kbps].mp3', 'thai ngu loz', NULL, 2014, NULL, '(13)Pop', NULL, 'THE BEST ?Blue?', 1, 0, '2016-11-29 17:05:32', 3),
(93, 'Orange - 7__ Seven Oops_ [MP3 320kbps].mp3', 'Orange - 7__ Seven Oops_ [MP3 320kbps].mp3', '7!! (Seven Oops)', NULL, 2015, NULL, '(13)Pop', NULL, 'Orange (Shigatsu wa Kimi no Uso ED2)', 302, 0, '2016-11-29 17:18:18', 3),
(94, 'Chasing The Sun - The Wanted.mp3', 'Chasing The Sun - The Wanted.mp3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2016-11-29 17:21:03', 2),
(95, 'Chasing The Sun - The Wanted.mp3', 'noob', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, '2016-11-29 17:21:31', 2),
(96, 'Orange - 7__ Seven Oops_ [MP3 320kbps].mp3', 'Orange - 7__ Seven Oops_ [MP3 320kbps].mp3', '7!! (Seven Oops)', NULL, 2015, NULL, '(13)Pop', NULL, 'Orange (Shigatsu wa Kimi no Uso ED2)', 301, 0, '2016-11-29 18:57:43', 3),
(97, 'Keep On Keeping On - Mizuki [MP3 320kbps].mp3', 'Keep On Keeping On - Mizuki [MP3 320kbps].mp3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 31, 0, '2016-11-29 19:16:30', 3),
(98, 'Aliez - Mizuki [MP3 320kbps].mp3', 'Aliez - Mizuki [MP3 320kbps].mp3', 'mizuki', NULL, 2014, NULL, '(13)Pop', NULL, 'A/Z?aLIEz (Aldnoah.Zero ED1 & ED2)', 20, 1, '2016-11-29 19:18:10', 3),
(100, 'Heavenly Blue - Kalafina [MP3 320kbps].mp3', 'Heavenly Blue - Kalafina [MP3 320kbps].mp3', 'Kalafina', NULL, 2014, NULL, '(13)Pop', NULL, 'THE BEST ?Blue?', 30, 0, '2016-11-29 19:21:17', 3),
(104, 'Marc Barrachina Sanchez - Endless Summer.mp3', 'Marc Barrachina Sanchez - Endless Summer.mp3', 'Marc Barrachina Sanchez', NULL, 2016, NULL, 'Dance/Electronica, House, Disco House, Funky House', NULL, 'SA048Nu Funk', 31, 0, '2016-11-29 21:13:52', 3),
(105, 'Aqua Terrarium - Yanagi Nagi [MP3 320kbps].mp3', 'Aqua Terrarium - Yanagi Nagi [MP3 320kbps].mp3', 'Yanagi Nagi', NULL, 2013, NULL, '(13)Pop', NULL, 'ED Nagi no Asukara', 223, 0, '2016-12-01 16:04:25', 3),
(107, 'Piercing Light Mako Remix_ - League Of L [MP3 320kbps].mp3', 'Piercing Light Mako Remix_ - League Of L [MP3 320kbps].mp3', 'League Of Legends', NULL, 2016, NULL, 'Remix', NULL, 'Warsongs', 4, 0, '2016-12-03 16:24:20', 3),
(108, 'Orange - 7__ Seven Oops_ [MP3 320kbps].mp3', 'Orange - 7__ Seven Oops_ [MP3 320kbps].mp3', '7!! (Seven Oops)', NULL, 2015, NULL, '(13)Pop', NULL, 'Orange (Shigatsu wa Kimi no Uso ED2)', 2, 0, '2016-12-03 17:12:52', 3),
(112, 'Flash Funk Marshmello Remix_ - League Of [MP3 320kbps].mp3', 'Flash Funk Marshmello Remix_ - League Of [MP3 320kbps].mp3', 'League Of Legends', NULL, 2016, NULL, 'Remix', NULL, 'Warsongs', 2, 0, '2016-12-03 17:14:55', 3),
(113, 'To The Beginning - Kalafina [MP3 320kbps].mp3', 'To The Beginning - Kalafina [MP3 320kbps].mp3', 'Kalafina', NULL, 2014, NULL, '(13)Pop', NULL, 'THE BEST ?Blue?', 3, 0, '2016-12-03 17:17:03', 3),
(114, 'Orange - 7__ Seven Oops_ [MP3 320kbps].mp3', 'Orange - 7__ Seven Oops_ [MP3 320kbps].mp3', '7!! (Seven Oops)', NULL, 2015, NULL, '(13)Pop', NULL, 'Orange (Shigatsu wa Kimi no Uso ED2)', 1, 0, '2016-12-03 21:31:24', 3),
(115, 'Orange - 7__ Seven Oops_ [MP3 320kbps].mp3', 'Orange - 7__ Seven Oops_ [MP3 320kbps].mp3', '7!! (Seven Oops)', NULL, 2015, NULL, '(13)Pop', NULL, 'Orange (Shigatsu wa Kimi no Uso ED2)', 0, 0, '2016-12-03 21:32:00', 14),
(116, 'Heavenly Blue - Kalafina [MP3 320kbps].mp3', 'Heavenly Blue - Kalafina [MP3 320kbps].mp3', 'Kalafina', NULL, 2014, NULL, '(13)Pop', NULL, 'THE BEST ?Blue?', 0, 0, '2016-12-03 21:32:08', 14),
(117, 'Aqua Terrarium - Yanagi Nagi [MP3 320kbps].mp3', 'Aqua Terrarium - Yanagi Nagi [MP3 320kbps].mp3', 'Yanagi Nagi', NULL, 2013, NULL, '(13)Pop', NULL, 'ED Nagi no Asukara', 0, 0, '2016-12-03 21:32:16', 14),
(118, 'Aliez - Mizuki [MP3 320kbps].mp3', 'Aliez - Mizuki [MP3 320kbps].mp3', 'mizuki', NULL, 2014, NULL, '(13)Pop', NULL, 'A/Z?aLIEz (Aldnoah.Zero ED1 & ED2)', 0, 0, '2016-12-03 21:32:24', 14),
(119, 'Maps - Maroon 5 [MP3 320kbps].mp3', 'Maps - Maroon 5 [MP3 320kbps].mp3', 'Maroon 5', NULL, 2014, NULL, '(13)Pop', NULL, 'Maps (Single)', 4, 0, '2016-12-04 23:24:33', 3),
(120, 'Stitches - Shawn Mendes [MP3 320kbps].mp3', 'Stitches - Shawn Mendes [MP3 320kbps].mp3', 'Shawn Mendes', NULL, 2015, NULL, '(13)Pop', NULL, 'Handwritten', 0, 0, '2016-12-04 23:27:08', 5),
(121, 'Bai hat max xin', 'Aqua Terrarium - Yanagi Nagi [MP3 320kbps].mp3', 'Yanagi Nagi', NULL, 2013, NULL, '(13)Pop', NULL, 'ED Nagi no Asukara', 4, 0, '2016-12-05 19:25:47', 3),
(122, 'To The Beginning - Kalafina [MP3 320kbps]', 'To The Beginning - Kalafina [MP3 320kbps].mp3', 'Kalafina', NULL, 2014, NULL, '(13)Pop', NULL, 'THE BEST ?Blue?', 1, 0, '2016-12-05 19:49:37', 3),
(123, 'Maps - Maroon 5 [MP3 320kbps]', 'Maps - Maroon 5 [MP3 320kbps].mp3', 'Maroon 5', NULL, 2014, NULL, '(13)Pop', NULL, 'Maps (Single)', 1, 0, '2016-12-05 19:49:50', 3),
(124, 'Orange - 7__ Seven Oops_ [MP3 320kbps]', 'Orange - 7__ Seven Oops_ [MP3 320kbps].mp3', '7!! (Seven Oops)', NULL, 2015, NULL, '(13)Pop', NULL, 'Orange (Shigatsu wa Kimi no Uso ED2)', 1, 0, '2016-12-05 19:51:17', 3),
(125, 'Orange', 'Orange - 7__ Seven Oops_ [MP3 320kbps].mp3', '7!! (Seven Oops)', NULL, 2015, NULL, '(13)Pop', NULL, 'Orange (Shigatsu wa Kimi no Uso ED2)', 0, 0, '2016-12-05 19:53:52', 6),
(126, 'Orange - 7__ Seven Oops_ [MP3 320kbps]', 'Orange - 7__ Seven Oops_ [MP3 320kbps].mp3', '7!! (Seven Oops)', NULL, 2015, NULL, '(13)Pop', NULL, 'Orange (Shigatsu wa Kimi no Uso ED2)', 2, 0, '2016-12-05 19:57:35', 3),
(133, 'Keep On Keeping On - Mizuki [MP3 320kbps]', 'Keep On Keeping On - Mizuki [MP3 320kbps].mp3', 'mizuki', NULL, 2014, NULL, '(13)Pop', NULL, 'A/Z?aLIEz (Aldnoah.Zero ED1 & ED2)', 1, 0, '2016-12-05 20:13:46', 6),
(134, 'Maps - Maroon 5 [MP3 320kbps]', 'Maps - Maroon 5 [MP3 320kbps].mp3', 'Maroon 5', NULL, 2014, NULL, '(13)Pop', NULL, 'Maps (Single)', 0, 0, '2016-12-05 20:14:11', 6),
(135, 'Orange', 'Orange - 7__ Seven Oops_ [MP3 320kbps].mp3', '7!! (Seven Oops)', NULL, 2015, NULL, '(13)Pop', NULL, 'Orange (Shigatsu wa Kimi no Uso ED2)', 0, 0, '2016-12-05 20:15:56', 6),
(136, 'Keep on keeping on', 'Keep On Keeping On - Mizuki [MP3 320kbps].mp3', 'mizuki', NULL, 2014, NULL, '(13)Pop', NULL, 'A/Z?aLIEz (Aldnoah.Zero ED1 & ED2)', 0, 0, '2016-12-05 20:17:13', 6),
(137, 'Aqua Terrarium', 'Aqua Terrarium - Yanagi Nagi [MP3 320kbps].mp3', 'Yanagi Nagi', NULL, 2013, NULL, '(13)Pop', NULL, 'ED Nagi no Asukara', 0, 0, '2016-12-05 20:17:20', 6),
(138, 'Endless Summer', 'Marc Barrachina Sanchez - Endless Summer.mp3', 'Marc Barrachina Sanchez', NULL, 2016, NULL, 'Dance/Electronica, House, Disco House, Funky House', NULL, 'SA048Nu Funk', 0, 0, '2016-12-05 20:46:19', 6),
(139, 'Endless Summer', 'Marc Barrachina Sanchez - Endless Summer.mp3', 'Marc Barrachina Sanchez', NULL, 2016, NULL, 'Dance/Electronica, House, Disco House, Funky House', '139shockbladezed.jpg', 'SA048Nu Funk', 1845, 34, '2016-12-06 18:53:03', 3),
(142, 'One More Night', 'One More Night - Maroon 5.mp3', 'Maroon 5', NULL, 0, NULL, '', NULL, 'mp3.zing.vn', 1, 0, '2016-12-09 10:32:44', 18),
(143, 'Lemonade', 'Lemonade - Alexandra Stan.mp3', 'Alexandra Stan', NULL, 0, NULL, '', NULL, 'mp3.zing.vn', 5, 0, '2016-12-09 10:33:56', 18),
(144, 'Falling In Love', 'Falling In Love.mp3', 'Us The Duo', NULL, 2014, NULL, '(80)', '144AlbumArt_{6CE90F34-22C0-4B47-ACB3-632FA2BAD2CA}_Large.jpg', 'No Matter Where You Are', 133, 44, '2016-12-09 11:14:39', 19),
(145, 'Keep on keeping on', 'Keep On Keeping On - Mizuki [MP3 320kbps].mp3', 'mizuki', NULL, 2014, NULL, '(13)Pop', NULL, 'A/Z?aLIEz (Aldnoah.Zero ED1 & ED2)', 1, 0, '2016-12-09 11:22:54', 17),
(146, 'Faded', 'Faded.mp3', 'Alan Walker', NULL, 0, NULL, '', '146AlbumArt_{4AB55CB0-D484-48DD-A492-A5853906C107}_Large.jpg', '', 1, 0, '2016-12-09 11:23:36', 19),
(148, 'I Need A Doctor', 'I Need A Doctor - Dr_ Dre_ Eminem_ Skyla (www.YeuCaHat.com).mp3', 'Dr. Dre Ft. Emiem and Skylar G', NULL, 2011, NULL, '(17)', NULL, 'music.Yeucahat.com', 2, 1, '2016-12-09 11:25:42', 17),
(149, 'Bokutachi No Uta', 'Bokutachi No Uta ZetsunenNoTempest ED 2 - Tomohisa Sako.mp3', 'Tomohisa Sako', NULL, 0, NULL, '', '149bnu.jpg', '', 7, 1, '2016-12-09 11:28:28', 20),
(150, 'Can\'t Feel My Face', 'Can\'t Feel My Face.mp3', 'The Weeknd', NULL, 0, NULL, '', '150AlbumArt_{4E5953D2-1DE4-4B1E-8C1D-1EA21844043B}_Large.jpg', '', 1, 0, '2016-12-09 11:28:56', 19),
(151, 'Come Away With Me', 'Come Away With Me.mp3', 'Norah Jones', NULL, 0, NULL, '', '151AlbumArt_{8EEFBF5B-C02F-46FA-9434-DE66E6DAA01C}_Large.jpg', '', 5223, 23, '2016-12-09 11:31:39', 19),
(153, 'Piercing Light (Mako Remix)', 'Piercing Light Mako Remix_ - League Of L [MP3 320kbps].mp3', 'League Of Legends', NULL, 2016, NULL, 'Remix', NULL, 'Warsongs', 1, 1, '2016-12-09 14:46:01', 1),
(154, 'Bai Ca Thit Cho', 'Bai Ca Thit Cho - Nguyen Hai Phong.mp3', 'Nguyen Hai Phong', NULL, 0, NULL, '', NULL, 'mp3.zing.vn', 1, 0, '2016-12-09 14:52:37', 1);

-- --------------------------------------------------------

--
-- Table structure for table `songinplaylist`
--

CREATE TABLE `songinplaylist` (
  `songID` int(8) NOT NULL,
  `playlistID` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `songinplaylist`
--

INSERT INTO `songinplaylist` (`songID`, `playlistID`) VALUES
(87, 12),
(105, 12),
(88, 13),
(89, 13),
(89, 16),
(98, 16),
(98, 29),
(148, 36);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userID` int(8) NOT NULL,
  `name` varchar(50) NOT NULL,
  `dob` date DEFAULT NULL,
  `gender` varchar(50) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `bio` varchar(255) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT 'default.jpg',
  `ispro` tinyint(1) DEFAULT '0',
  `followercount` int(11) NOT NULL DEFAULT '0',
  `email` varchar(255) NOT NULL,
  `uploaded` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userID`, `name`, `dob`, `gender`, `address`, `bio`, `avatar`, `ispro`, `followercount`, `email`, `uploaded`) VALUES
(1, 'VÅ© HoÃ ng ThÃ¡i', '1995-01-23', 'Male', 'Thanh HÃ³a', 'VÅ© HoÃ ng ThÃ¡i Ä‘áº¹p trai', '116924007232_dde86164b7_o.jpg', 0, 9, 'thai1', 3),
(3, 'Pháº¡m PhÃº Háº­u', '1995-06-24', 'Male', 'dep trai', 'Pháº¡m PhÃº Háº­u', '3cac.jpg', 1, 6, 'hau123', 12),
(4, 'truongnm', NULL, NULL, NULL, NULL, 'default.jpg', 0, 2, 'truongkechun@gmail.com', 1),
(5, 'Nguyá»…n Máº¡nh TrÆ°á»ng', '1995-07-23', 'Male', 'Shinjuku', 'Cuá»‘c Ä‘á» @ HUST', '5IMG_0276.jpg', 0, 3, 'truong', 2),
(6, 'hau', NULL, NULL, NULL, NULL, 'default.jpg', 0, 2, 'hau12345', 9),
(7, 'thÃ¡i giÃ ', NULL, NULL, NULL, NULL, 'default.jpg', 0, 1, 'maiphuongloan96@gmail.com', 1),
(8, 'vu', NULL, NULL, NULL, NULL, 'default.jpg', 0, 2, 'vu', 1),
(9, '123', NULL, NULL, NULL, NULL, 'default.jpg', 0, 1, 'vu123', 1),
(10, 'hau', NULL, NULL, NULL, NULL, 'default.jpg', 1, 1, 'hau1234', 1),
(11, 'haupro', NULL, NULL, NULL, NULL, 'default.jpg', 0, 0, 'hau2', 1),
(12, '123', NULL, NULL, NULL, NULL, 'default.jpg', 0, 0, 'hau3', 1),
(17, 'thÃ¡i vh', '1995-01-23', 'Male', '', 'Ä‘áº¹p zai, há»c giá»i, Ä‘Ã¡ng yÃªu', '17ava.jpg', 1, 2, 'hoangthai.95@gmail.com', 4),
(19, 'TrÆ°á»ng Nguyá»…n ', '1995-07-23', 'Male', 'Shinjuku', 'TrÆ°á»ng Nguyá»…n ', '19small.jpg', 0, 2, 'manhtruonghedspi@gmail.com', 4),
(20, 'vu', '1995-05-24', 'Male', 'Ha Noi', 'vu', '20yuna.jpg', 1, 2, 'vuphamas@gmail.com', 1),
(21, 'thai', NULL, NULL, NULL, NULL, 'default.jpg', 0, 0, 'nhom940com@gmail.com', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `action`
--
ALTER TABLE `action`
  ADD PRIMARY KEY (`actionID`),
  ADD KEY `playlistID` (`playlistID`),
  ADD KEY `time` (`time`),
  ADD KEY `songID` (`songID`),
  ADD KEY `userID` (`userID`),
  ADD KEY `fk_time` (`time`,`songID`),
  ADD KEY `fk_time2` (`time`,`playlistID`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminID`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`cmtID`),
  ADD KEY `userID` (`userID`,`songID`,`playlistID`),
  ADD KEY `fk_cmt_song_songid` (`songID`),
  ADD KEY `fk_cmt_playlist_plid` (`playlistID`);

--
-- Indexes for table `follow`
--
ALTER TABLE `follow`
  ADD PRIMARY KEY (`userID1`,`userID2`),
  ADD KEY `fk_fl_user_userid2` (`userID2`);

--
-- Indexes for table `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`genreID`);

--
-- Indexes for table `likesong`
--
ALTER TABLE `likesong`
  ADD PRIMARY KEY (`userID`,`songID`),
  ADD KEY `fk_likesong_user_songid` (`songID`);

--
-- Indexes for table `playlist`
--
ALTER TABLE `playlist`
  ADD PRIMARY KEY (`playlistID`),
  ADD KEY `createTime` (`createTime`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `song`
--
ALTER TABLE `song`
  ADD PRIMARY KEY (`songID`),
  ADD KEY `uploadTime` (`uploadTime`),
  ADD KEY `userID` (`userID`),
  ADD KEY `userID_2` (`userID`);

--
-- Indexes for table `songinplaylist`
--
ALTER TABLE `songinplaylist`
  ADD PRIMARY KEY (`songID`,`playlistID`),
  ADD KEY `fk_sip_pl_plid` (`playlistID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userID`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `action`
--
ALTER TABLE `action`
  MODIFY `actionID` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;
--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `cmtID` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `playlist`
--
ALTER TABLE `playlist`
  MODIFY `playlistID` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT for table `song`
--
ALTER TABLE `song`
  MODIFY `songID` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=155;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userID` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `action`
--
ALTER TABLE `action`
  ADD CONSTRAINT `fk_time` FOREIGN KEY (`time`,`songID`) REFERENCES `song` (`uploadTime`, `songID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_time2` FOREIGN KEY (`time`,`playlistID`) REFERENCES `playlist` (`createTime`, `playlistID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user_action_userID` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`email`) REFERENCES `account` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `fk_cmt_pl_plid` FOREIGN KEY (`playlistID`) REFERENCES `playlist` (`playlistID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_cmt_song_songid` FOREIGN KEY (`songID`) REFERENCES `song` (`songID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_cmt_user_userid` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `follow`
--
ALTER TABLE `follow`
  ADD CONSTRAINT `fk_fl_user_userid1` FOREIGN KEY (`userID1`) REFERENCES `user` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_fl_user_userid2` FOREIGN KEY (`userID2`) REFERENCES `user` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `likesong`
--
ALTER TABLE `likesong`
  ADD CONSTRAINT `fk_likesong_user_userid` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `songinplaylist`
--
ALTER TABLE `songinplaylist`
  ADD CONSTRAINT `fk_sip_pl_plid` FOREIGN KEY (`playlistID`) REFERENCES `playlist` (`playlistID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_sip_song_songid` FOREIGN KEY (`songID`) REFERENCES `song` (`songID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_user_acc_email` FOREIGN KEY (`email`) REFERENCES `account` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
