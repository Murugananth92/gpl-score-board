-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 14, 2019 at 11:31 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test1`
--

-- --------------------------------------------------------

--
-- Table structure for table `ball_records`
--

CREATE TABLE `ball_records` (
  `ball_id` int(11) NOT NULL,
  `over_id` int(11) NOT NULL,
  `ball_number` int(11) NOT NULL,
  `bowler` int(11) NOT NULL,
  `runs_scored` int(11) NOT NULL,
  `batsman` int(11) NOT NULL,
  `is_wide` tinyint(4) NOT NULL DEFAULT 0,
  `is_noball` tinyint(4) NOT NULL DEFAULT 0,
  `is_byes` tinyint(4) NOT NULL DEFAULT 0,
  `is_wicket` tinyint(4) NOT NULL DEFAULT 0,
  `is_runout` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `batsman_ball_records`
--

CREATE TABLE `batsman_ball_records` (
  `batsman_ball_record_id` int(11) NOT NULL,
  `inning_id` int(11) NOT NULL,
  `batsman_id` int(11) NOT NULL,
  `ball_id` int(11) NOT NULL,
  `runs_scored` int(11) NOT NULL,
  `is_4` tinyint(4) NOT NULL DEFAULT 0,
  `is_6` tinyint(4) NOT NULL DEFAULT 0,
  `is_out` tinyint(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `batsman_innings`
--

CREATE TABLE `batsman_innings` (
  `batsman_inning_id` int(11) NOT NULL,
  `inning_id` int(11) NOT NULL,
  `batsman` int(11) NOT NULL,
  `runs_scored` int(11) NOT NULL,
  `total_4` int(11) NOT NULL,
  `total_6` int(11) NOT NULL,
  `balls_faced` int(11) NOT NULL,
  `is_out` tinyint(4) NOT NULL,
  `wicket_type` enum('Bowled','Catch Out','Run Out','Stumped','Hit Wicket','Ball Handled','Field Obstruction','Retired') DEFAULT NULL,
  `wicket_assist1` int(11) DEFAULT NULL,
  `wicket_assist2` int(11) DEFAULT NULL,
  `bowler` int(11) NOT NULL,
  `is_retired` tinyint(4) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bowler_innings`
--

CREATE TABLE `bowler_innings` (
  `bowler_inning_id` int(11) NOT NULL,
  `inning_id` int(11) NOT NULL,
  `bowler` int(11) NOT NULL,
  `runs_gave` int(11) NOT NULL,
  `overs_bowled` int(11) NOT NULL,
  `balls_bowled` int(11) NOT NULL,
  `wickets` int(11) NOT NULL,
  `wides` int(11) NOT NULL,
  `no_balls` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fall_of_wickets`
--

CREATE TABLE `fall_of_wickets` (
  `fall_of_wicket_id` int(11) NOT NULL,
  `inning_id` int(11) NOT NULL,
  `ball_id` int(11) NOT NULL,
  `batsman` int(11) NOT NULL,
  `run` int(11) NOT NULL COMMENT 'team runs at the moment',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `group_id` int(11) NOT NULL,
  `group_name` varchar(255) NOT NULL,
  `tournament_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `group_points`
--

CREATE TABLE `group_points` (
  `group_points_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `tournament_team_id` int(11) NOT NULL,
  `net_run_rate` float DEFAULT NULL,
  `points` int(11) NOT NULL,
  `wins` int(11) NOT NULL,
  `losses` int(11) NOT NULL,
  `n/r` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `innings`
--

CREATE TABLE `innings` (
  `inning_id` int(11) NOT NULL,
  `inning_number` enum('1','2') NOT NULL,
  `inning_name` varchar(100) NOT NULL,
  `match_id` int(11) NOT NULL,
  `batting_team` int(11) NOT NULL,
  `bowling_team` int(11) NOT NULL,
  `batsman_1` int(11) NOT NULL,
  `batsman_2` int(11) NOT NULL,
  `batsman_on_strike` int(11) DEFAULT NULL,
  `bowler` int(11) NOT NULL,
  `runs_scored` int(11) DEFAULT NULL,
  `wickets_lost` int(11) DEFAULT NULL,
  `overs_bowled` int(11) DEFAULT NULL,
  `balls_bowled_in_current_over` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `is_completed` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `matches`
--

CREATE TABLE `matches` (
  `match_id` int(11) NOT NULL,
  `tournament_id` int(11) NOT NULL,
  `team_1` int(11) NOT NULL,
  `team_2` int(11) NOT NULL,
  `match_date` date NOT NULL,
  `match_venue` varchar(150) NOT NULL,
  `live_match` tinyint(4) NOT NULL DEFAULT 0,
  `umpire_1` int(11) DEFAULT NULL,
  `umpire_2` int(11) DEFAULT NULL,
  `scorer` int(11) DEFAULT NULL,
  `toss_won` int(11) DEFAULT NULL,
  `toss_option` enum('bat','bowl') DEFAULT NULL,
  `match_overs` int(11) DEFAULT 12,
  `winning_team` int(11) DEFAULT NULL,
  `man_of_match` int(11) DEFAULT NULL,
  `man_of_match_description` varchar(150) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `is_completed` tinyint(4) NOT NULL DEFAULT 0,
  `is_rescheduled` tinyint(4) NOT NULL DEFAULT 0,
  `comments` varchar(150) DEFAULT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `matches`
--

INSERT INTO `matches` (`match_id`, `tournament_id`, `team_1`, `team_2`, `match_date`, `match_venue`, `live_match`, `umpire_1`, `umpire_2`, `scorer`, `toss_won`, `toss_option`, `match_overs`, `winning_team`, `man_of_match`, `man_of_match_description`, `created_at`, `updated_at`, `created_by`, `updated_by`, `is_completed`, `is_rescheduled`, `comments`, `is_deleted`) VALUES
(1, 1, 7, 5, '2019-11-02', 'Emerald Ground ', 0, NULL, NULL, NULL, NULL, NULL, 12, NULL, NULL, NULL, '2019-10-10 19:17:35', '2019-11-14 15:38:51', 1, NULL, 0, 0, NULL, 0),
(2, 1, 4, 6, '2019-11-02', 'Emerald Ground ', 0, NULL, NULL, NULL, NULL, NULL, 12, NULL, NULL, NULL, '2019-10-10 19:17:35', '2019-11-14 15:38:51', 1, NULL, 0, 0, NULL, 0),
(3, 1, 3, 1, '2019-11-09', 'Emerald Ground ', 0, NULL, NULL, NULL, NULL, NULL, 12, NULL, NULL, NULL, '2019-10-10 19:17:35', '2019-11-14 15:38:51', 1, NULL, 0, 0, NULL, 0),
(4, 1, 6, 7, '2019-11-09', 'Emerald Ground ', 0, NULL, NULL, NULL, NULL, NULL, 12, NULL, NULL, NULL, '2019-10-10 19:17:35', '2019-11-13 14:56:32', 1, NULL, 0, 0, NULL, 0),
(5, 1, 8, 5, '2019-11-09', 'Emerald Ground ', 0, NULL, NULL, NULL, NULL, NULL, 12, NULL, NULL, NULL, '2019-10-10 19:17:35', '2019-11-13 12:14:24', 1, NULL, 0, 0, NULL, 0),
(6, 1, 2, 4, '2019-11-09', 'Emerald Ground ', 0, NULL, NULL, NULL, NULL, NULL, 12, NULL, NULL, NULL, '2019-10-10 19:17:35', '2019-11-13 12:14:24', 1, NULL, 0, 0, NULL, 0),
(7, 1, 5, 3, '2019-11-16', 'Emerald Ground ', 0, NULL, NULL, NULL, NULL, NULL, 12, NULL, NULL, NULL, '2019-10-10 19:17:35', '2019-11-13 12:14:24', 1, NULL, 0, 0, NULL, 0),
(8, 1, 6, 2, '2019-11-16', 'Emerald Ground ', 0, NULL, NULL, NULL, NULL, NULL, 12, NULL, NULL, NULL, '2019-10-10 19:17:35', '2019-11-13 12:14:24', 1, NULL, 0, 0, NULL, 0),
(9, 1, 7, 8, '2019-11-16', 'Emerald Ground ', 0, NULL, NULL, NULL, NULL, NULL, 12, NULL, NULL, NULL, '2019-10-10 19:24:14', '2019-11-13 12:14:24', 1, NULL, 0, 0, NULL, 0),
(10, 1, 4, 1, '2019-11-16', 'Emerald Ground ', 0, NULL, NULL, NULL, NULL, NULL, 12, NULL, NULL, NULL, '2019-10-10 19:24:14', '2019-11-13 12:14:24', 1, NULL, 0, 0, NULL, 0),
(11, 1, 8, 3, '2019-11-23', 'Emerald Ground ', 0, NULL, NULL, NULL, NULL, NULL, 12, NULL, NULL, NULL, '2019-10-10 19:24:14', '2019-11-13 12:14:24', 1, NULL, 0, 0, NULL, 0),
(12, 1, 1, 6, '2019-11-23', 'Emerald Ground ', 0, NULL, NULL, NULL, NULL, NULL, 12, NULL, NULL, NULL, '2019-10-10 19:24:14', '2019-11-13 12:14:24', 1, NULL, 0, 0, NULL, 0),
(13, 1, 2, 7, '2019-11-23', 'Emerald Ground ', 0, NULL, NULL, NULL, NULL, NULL, 12, NULL, NULL, NULL, '2019-10-10 19:24:14', '2019-11-13 12:14:24', 1, NULL, 0, 0, NULL, 0),
(14, 1, 5, 4, '2019-11-23', 'Emerald Ground ', 0, NULL, NULL, NULL, NULL, NULL, 12, NULL, NULL, NULL, '2019-10-10 19:24:14', '2019-11-13 12:14:24', 1, NULL, 0, 0, NULL, 0),
(15, 1, 3, 7, '2019-11-30', 'Emerald Ground ', 0, NULL, NULL, NULL, NULL, NULL, 12, NULL, NULL, NULL, '2019-10-10 19:24:14', '2019-11-13 12:14:24', 1, NULL, 0, 0, NULL, 0),
(16, 1, 2, 1, '2019-11-30', 'Emerald Ground ', 0, NULL, NULL, NULL, NULL, NULL, 12, NULL, NULL, NULL, '2019-10-10 19:24:14', '2019-11-13 12:14:24', 1, NULL, 0, 0, NULL, 0),
(17, 1, 6, 5, '2019-11-30', 'Emerald Ground ', 0, NULL, NULL, NULL, NULL, NULL, 12, NULL, NULL, NULL, '2019-10-10 19:24:14', '2019-11-13 12:14:24', 1, NULL, 0, 0, NULL, 0),
(18, 1, 8, 4, '2019-11-30', 'Emerald Ground ', 0, NULL, NULL, NULL, NULL, NULL, 12, NULL, NULL, NULL, '2019-10-10 19:24:14', '2019-11-13 12:14:24', 1, NULL, 0, 0, NULL, 0),
(19, 1, 6, 8, '2019-12-07', 'Emerald Ground ', 0, NULL, NULL, NULL, NULL, NULL, 12, NULL, NULL, NULL, '2019-10-10 19:31:02', '2019-11-13 12:14:24', 1, NULL, 0, 0, NULL, 0),
(20, 1, 1, 7, '2019-12-07', 'Emerald Ground ', 0, NULL, NULL, NULL, NULL, NULL, 12, NULL, NULL, NULL, '2019-10-10 19:31:02', '2019-10-16 15:01:18', 1, NULL, 0, 0, NULL, 0),
(21, 1, 5, 2, '2019-12-07', 'Emerald Ground ', 0, NULL, NULL, NULL, NULL, NULL, 12, NULL, NULL, NULL, '2019-10-10 19:31:02', '2019-11-06 12:15:34', 1, NULL, 0, 0, NULL, 0),
(22, 1, 4, 3, '2019-12-07', 'Emerald Ground ', 0, NULL, NULL, NULL, NULL, NULL, 12, NULL, NULL, NULL, '2019-10-10 19:31:02', '2019-10-10 19:31:56', 1, NULL, 0, 0, NULL, 0),
(23, 1, 3, 6, '2019-12-14', 'Emerald Ground ', 0, NULL, NULL, NULL, NULL, NULL, 12, NULL, NULL, NULL, '2019-10-10 19:31:02', '2019-11-06 12:15:32', 1, NULL, 0, 0, NULL, 0),
(24, 1, 2, 8, '2019-12-14', 'Emerald Ground ', 0, NULL, NULL, NULL, NULL, NULL, 12, NULL, NULL, NULL, '2019-10-10 19:31:02', '2019-11-06 12:15:30', 1, NULL, 0, 0, NULL, 0),
(25, 1, 1, 5, '2019-12-14', 'Emerald Ground ', 0, NULL, NULL, NULL, NULL, NULL, 12, NULL, NULL, NULL, '2019-10-10 19:31:02', '2019-11-06 12:15:28', 1, NULL, 0, 0, NULL, 0),
(26, 1, 7, 4, '2019-12-14', 'Emerald Ground ', 0, NULL, NULL, NULL, NULL, NULL, 12, NULL, NULL, NULL, '2019-10-10 19:31:02', '2019-11-13 12:14:24', 1, NULL, 0, 0, NULL, 0),
(27, 1, 1, 8, '2019-12-21', 'Emerald Ground ', 0, NULL, NULL, NULL, NULL, NULL, 12, NULL, NULL, NULL, '2019-10-10 19:31:02', '2019-11-13 12:14:24', 1, NULL, 0, 0, NULL, 0),
(28, 1, 3, 2, '2019-12-21', 'Emerald Ground ', 0, NULL, NULL, NULL, NULL, NULL, 12, NULL, NULL, NULL, '2019-10-10 19:31:02', '2019-11-13 12:14:24', 1, NULL, 0, 0, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `match_logs`
--

CREATE TABLE `match_logs` (
  `log_id` int(11) NOT NULL,
  `match_id` int(11) NOT NULL,
  `inning_id` int(11) NOT NULL,
  `batsman_onstrike` int(11) NOT NULL,
  `batsman` int(11) NOT NULL,
  `bowler` int(11) NOT NULL,
  `over` int(11) NOT NULL,
  `ball` int(11) NOT NULL,
  `runs` int(11) NOT NULL,
  `wickets` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `match_squads`
--

CREATE TABLE `match_squads` (
  `match_squad_id` int(11) NOT NULL,
  `match_id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL COMMENT 'Tournament team Id',
  `player_id` int(11) NOT NULL,
  `player_role` enum('player','captain','vice captain') NOT NULL DEFAULT 'player',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `over_records`
--

CREATE TABLE `over_records` (
  `over_id` int(11) NOT NULL,
  `inning_id` int(11) NOT NULL,
  `over_number` int(11) NOT NULL,
  `bowler` int(11) NOT NULL,
  `runs_gave` int(11) NOT NULL,
  `wickets` int(11) NOT NULL,
  `extras` int(11) NOT NULL,
  `byes` int(11) NOT NULL,
  `wides` int(11) NOT NULL,
  `no_balls` int(11) NOT NULL,
  `dots` int(11) NOT NULL,
  `is_completed` tinyint(4) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `players`
--

CREATE TABLE `players` (
  `player_id` int(11) NOT NULL,
  `player_name` varchar(150) NOT NULL COMMENT 'Eg: Ahmed Suhail',
  `player_avatar` varchar(255) NOT NULL COMMENT 'Eg: image.jpg',
  `player_email` varchar(255) NOT NULL,
  `company` enum('CG','G2') NOT NULL,
  `employee_id` varchar(11) NOT NULL,
  `player_role` enum('Batsman','Bowler','All Rounder') NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `players`
--

INSERT INTO `players` (`player_id`, `player_name`, `player_avatar`, `player_email`, `company`, `employee_id`, `player_role`, `created_at`, `updated_at`, `created_by`, `updated_by`, `is_deleted`) VALUES
(1, 'JOHN MELCHIOR A', '', 'john@g2techsoft.com', 'G2', '244', 'All Rounder', '2019-10-09 19:53:58', NULL, 1, NULL, 0),
(2, 'POOBALAN C', '', 'poobalan@g2techsoft.com', 'G2', '104', 'All Rounder', '2019-10-09 19:54:32', NULL, 1, NULL, 0),
(3, 'ARAVINDAN N', '', 'aravindan@g2techsoft.com', 'G2', '504', 'All Rounder', '2019-10-09 19:54:54', NULL, 1, NULL, 0),
(4, 'BALACHANDAR K', '', 'balachandar@g2techsoft.com', 'G2', '445', 'All Rounder', '2019-10-09 19:55:19', NULL, 1, NULL, 0),
(5, 'INBAKUMAR', '', 'inbakumar@g2techsoft.com', 'G2', '406', 'All Rounder', '2019-10-09 19:55:43', NULL, 1, NULL, 0),
(6, 'KANNAN M', '', 'kannan@g2techsoft.com', 'G2', '193', 'All Rounder', '2019-10-09 19:56:25', NULL, 1, NULL, 0),
(7, 'VIJAYAKUMAR S', '', 'vijayakumar@g2techsoft.com', 'G2', '400', 'All Rounder', '2019-10-09 19:56:52', NULL, 1, NULL, 0),
(8, 'SALMAN SULTHAN S', '', 'salman@g2techsoft.com', 'G2', '386', 'All Rounder', '2019-10-09 19:57:24', NULL, 1, NULL, 0),
(9, 'SANTHOSH KUMAR', '', 'santhosh@g2techsoft.com', 'G2', '529', 'All Rounder', '2019-10-09 19:58:03', NULL, 1, NULL, 0),
(10, 'VIGNESH', '', 'vignesh@g2techsoft.com', 'G2', '486', 'All Rounder', '2019-10-09 19:58:29', NULL, 1, NULL, 0),
(11, 'NAVEENKUMAR G', '', 'naveenkumar@g2techsoft.com', 'G2', '476', 'All Rounder', '2019-10-09 19:59:02', NULL, 1, NULL, 0),
(12, 'SIVA CHANDRU', '', 'sivachandru@cgvakindia.com', 'CG', '1087', 'All Rounder', '2019-10-09 19:59:38', NULL, 1, NULL, 0),
(13, 'BHARATH KUMAR P', '', 'bharath@g2techsoft.com', 'G2', '503', 'All Rounder', '2019-10-09 20:00:11', NULL, 1, NULL, 0),
(14, 'SURESH KUMAR G', '', 'sureshkumar@g2techsoft.com', 'G2', '245', 'All Rounder', '2019-10-09 20:01:00', NULL, 1, NULL, 0),
(15, 'PRASANTH A', '', 'prasantha@g2techsoft.com', 'G2', '540', 'All Rounder', '2019-10-09 20:01:36', NULL, 1, NULL, 0),
(16, 'ARUN S', '', 'arun@cgvakindia.com', 'CG', '689', 'All Rounder', '2019-10-09 20:06:53', '2019-10-09 20:15:17', 1, 1, 0),
(17, 'MADESWARAN P', '', 'madeswaran@cgvakindia.com', 'CG', '992', 'All Rounder', '2019-10-09 20:07:21', '2019-10-09 20:15:23', 1, 1, 0),
(18, 'YUVARAJ S', '', 'yuvaraj.s@cgvakindia.com', 'CG', '971', 'All Rounder', '2019-10-09 20:16:01', NULL, 1, NULL, 0),
(19, 'VIJAYAKUMAR M', '', 'vijayakumar.m@cgvakindia.com', 'CG', '1081', 'All Rounder', '2019-10-09 20:16:27', NULL, 1, NULL, 0),
(20, 'SUBASH STARLIN E ', '', 'subash@cgvakindia.com', 'CG', '970', 'All Rounder', '2019-10-09 20:16:46', NULL, 1, NULL, 0),
(21, 'GANESH RAJA S', '', 'ganeshraja@cgvakindia.com', 'CG', '1023', 'All Rounder', '2019-10-09 20:17:15', NULL, 1, NULL, 0),
(22, 'VISHNU MAHESWARAN K', '', 'vishnu@cgvakindia.com', 'CG', '1076', 'All Rounder', '2019-10-09 20:17:38', NULL, 1, NULL, 0),
(23, 'VIMAL KARTHIK A', '', 'vimalkarthik@cgvakindia.com', 'CG', '1089', 'All Rounder', '2019-10-09 20:18:34', NULL, 1, NULL, 0),
(24, 'ARAVINDAN K', '', 'aravindan@cgvakindia.com', 'CG', '1010', 'All Rounder', '2019-10-09 20:18:56', NULL, 1, NULL, 0),
(25, 'VIGNESH C', '', 'vignesh.c@cgvakindia.com', 'CG', '940', 'All Rounder', '2019-10-09 20:19:23', NULL, 1, NULL, 0),
(26, 'MANOJKUMAR A S', '', 'manojkumar.a@cgvakindia.com', 'CG', '1026', 'All Rounder', '2019-10-09 20:20:26', NULL, 1, NULL, 0),
(27, 'DHINESHKUMAR S', '', 'dhineshkumar@cgvakindia.com', 'CG', '894', 'All Rounder', '2019-10-09 20:21:23', NULL, 1, NULL, 0),
(28, 'SUBASH V', '', 'subash.v@cgvakindia.com', 'CG', '1028', 'All Rounder', '2019-10-09 20:21:47', NULL, 1, NULL, 0),
(29, 'ARUNGOKUL J', '', 'arungokul@g2techsoft.com', 'G2', '554', 'All Rounder', '2019-10-09 20:22:09', '2019-10-09 20:22:47', 1, 1, 0),
(30, 'KARTHIKEYAN R', '', 'ramasamykarthik@cgvakindia.com', 'CG', '978', 'All Rounder', '2019-10-09 20:22:36', NULL, 1, NULL, 0),
(31, 'PARTHIBAN E', '', 'parthiban@cgvakindia.com', 'CG', '766', 'All Rounder', '2019-10-09 20:32:36', NULL, 1, NULL, 0),
(32, 'VIDHYA PRAKASH B', '', 'vidhyaprakash@g2techsoft.com', 'G2', '206', 'All Rounder', '2019-10-09 20:32:56', NULL, 1, NULL, 0),
(33, 'SANTHOSH KUMAR K', '', 'Santhoshkumar.k@cgvakindia.com', 'CG', '656', 'All Rounder', '2019-10-09 20:33:18', NULL, 1, NULL, 0),
(34, 'KARTHIK', '', 'karthick.k@cgvakindia.com', 'CG', '1099', 'All Rounder', '2019-10-09 20:33:41', '2019-11-14 15:59:58', 1, 1, 0),
(35, 'SARAVANA KUMAR P ', '', 'saravana@g2techsoft.com', 'G2', '334', 'All Rounder', '2019-10-09 20:34:05', NULL, 1, NULL, 0),
(36, 'MANIKANDAN A', '', 'manikandana@g2techsoft.com', 'G2', '535', 'All Rounder', '2019-10-09 20:34:27', NULL, 1, NULL, 0),
(37, 'ARNOLD', '', 'arnold@cgvakindia.com', 'CG', '1085', 'All Rounder', '2019-10-09 20:36:43', NULL, 1, NULL, 0),
(38, 'RAM PRASAD S', '', 'ramprasad@g2techsoft.com', 'G2', '363', 'All Rounder', '2019-10-09 20:37:12', NULL, 1, NULL, 0),
(39, 'RAGURAMAN A', '', 'raguraman@g2techsoft.com', 'G2', '174', 'All Rounder', '2019-10-09 20:37:36', NULL, 1, NULL, 0),
(40, 'SATHEESH V', '', 'satheesh@cgvakindia.com', 'CG', '767', 'All Rounder', '2019-10-09 20:38:01', NULL, 1, NULL, 0),
(41, 'SANTHOSH A', '', 'santhosh@g2techsoft.com', 'G2', '435', 'All Rounder', '2019-10-09 20:38:31', NULL, 1, NULL, 0),
(42, 'SATHISH', '', 'sathish@g2techsoft.com', 'G2', '73', 'All Rounder', '2019-10-09 20:39:12', NULL, 1, NULL, 0),
(43, 'PRAKASH A', '', 'prakash@cgvakindia.com', 'CG', '973', 'All Rounder', '2019-10-09 20:41:26', NULL, 1, NULL, 0),
(44, 'PRASANTH S', '', 'phil@g2techsoft.com', 'G2', '454', 'All Rounder', '2019-10-09 20:41:52', NULL, 1, NULL, 0),
(45, 'VENKATESH KUMAR G', '', 'vincent@g2techsoft.com', 'G2', '509', 'All Rounder', '2019-10-09 20:42:14', NULL, 1, NULL, 0),
(46, 'LAWRENCE MARIA JAYAKUMAR ', '', 'luke@cgvakindia.com', 'CG', '967', 'All Rounder', '2019-10-10 12:29:47', '2019-10-10 12:41:10', 1, NULL, 0),
(47, 'SYLVANUS PRITHIM SUGANTH', '', 'stephen@cgvakindia.com', 'CG', '958', 'All Rounder', '2019-10-10 12:30:17', '2019-10-10 12:41:13', 1, NULL, 0),
(48, 'MOHAMED ROSHAN', '', 'roy@cgvakindia.com', 'CG', '1035', 'All Rounder', '2019-10-10 12:30:48', '2019-10-10 12:41:16', 1, NULL, 0),
(49, 'MANOJ KUMAR A', '', 'michael@cgvakinida.com', 'CG', '812', 'All Rounder', '2019-10-10 12:31:25', '2019-10-10 12:41:40', 1, NULL, 0),
(50, 'RAJESH KUMAR K ', '', 'robert@cgvakindia.com', 'CG', '815', 'All Rounder', '2019-10-10 12:31:51', '2019-10-10 12:41:38', 1, NULL, 0),
(51, 'JOHNNY RATHAN', '', 'jason@cgvakindia.com', 'CG', '1065', 'All Rounder', '2019-10-10 12:33:11', '2019-10-10 12:41:35', 1, NULL, 0),
(52, 'NESAMANI DIVAKAR', '', 'dennis@cgvakindia.com', 'CG', '1088', 'All Rounder', '2019-10-10 12:33:45', '2019-10-10 12:41:34', 1, NULL, 0),
(53, 'SHIVA R', '', 'saul@cgvakindia.com', 'CG', '1049', 'All Rounder', '2019-10-10 12:34:10', '2019-10-10 12:41:32', 1, NULL, 0),
(54, 'AYYANDURAI ', '', 'ayyandurai@cgvakindia.com', 'CG', '999', 'All Rounder', '2019-10-10 12:34:33', '2019-10-10 12:41:30', 1, NULL, 0),
(55, 'VIGNESH R', '', 'vince.r@cgvakindia.com', 'CG', '1066', 'All Rounder', '2019-10-10 12:34:59', '2019-10-10 12:41:28', 1, NULL, 0),
(56, 'RAMESH MARAN', '', 'rameshmaran@cgvakindia.com', 'CG', '1018', 'All Rounder', '2019-10-10 12:35:26', '2019-10-10 12:41:26', 1, NULL, 0),
(57, 'JAMES RAVIN KUMAR', '', 'rameshmaran@cgvakindia.com ', 'CG', '0003', 'All Rounder', '2019-10-10 12:36:54', '2019-11-14 15:49:13', 1, 1, 0),
(58, 'SHANTOSH MURTHY', '', 'shannon@cgvak.com', 'CG', '816', 'All Rounder', '2019-10-10 12:37:32', '2019-10-10 12:41:21', 1, NULL, 0),
(59, 'FRANKLIN DAVID', '', 'franklin@cgvak.com', 'CG', '782', 'All Rounder', '2019-10-10 12:38:18', '2019-10-10 12:41:18', 1, NULL, 0),
(63, 'ERIC SHAJIL', '', 'eric@cgvakindia.com', 'CG', '797', 'All Rounder', '2019-10-10 12:48:43', '2019-10-10 19:41:53', 1, 1, 0),
(64, 'VIGNESH K V', '', 'vignesh.v@cgvakindia.com', 'CG', '849', 'All Rounder', '2019-10-10 12:50:24', NULL, 1, NULL, 0),
(65, 'RAJEESH K', '', 'rajeesh@cgvakinida.com', 'CG', '255', 'All Rounder', '2019-10-10 12:52:42', NULL, 1, NULL, 0),
(66, 'ARUN KUMAR S', '', 'arunkumar.s@cgvakindia.com', 'CG', '883', 'All Rounder', '2019-10-10 12:53:16', NULL, 1, NULL, 0),
(67, 'BALAJI K S', '', 'balajiks@cgvakindia.com', 'CG', '742', 'All Rounder', '2019-10-10 12:53:43', NULL, 1, NULL, 0),
(68, 'GOWTHAM ', '', 'gowtham.b@cgvakindia.com', 'CG', '877', 'All Rounder', '2019-10-10 12:56:49', NULL, 1, NULL, 0),
(69, 'SELWYN SHAHIL S', '', 'selwynshahil@cgvakindia.com', 'CG', '711', 'All Rounder', '2019-10-10 12:57:33', NULL, 1, NULL, 0),
(70, 'UDHAYAKUMAR K', '', 'udhayakumar@g2tsolutions.com', 'G2', '279', 'All Rounder', '2019-10-10 12:58:26', NULL, 1, NULL, 0),
(71, 'THANGARAJ', '', 'thangaraj@cgvakindia.com', 'CG', '923', 'All Rounder', '2019-10-10 12:59:34', NULL, 1, NULL, 0),
(72, 'BASKAR', '', 'baskar@cgvakindia.com', 'CG', '913', 'All Rounder', '2019-10-10 13:00:15', NULL, 1, NULL, 0),
(73, 'ALDRIN DIYAS A', '', 'aldrindiyas@cgvakindia.com', 'CG', '1057', 'All Rounder', '2019-10-10 13:00:46', NULL, 1, NULL, 0),
(74, 'DEEPAN NAGARAJAN', '', 'deepan@cgvakindia.com', 'CG', '754', 'All Rounder', '2019-10-10 13:01:14', NULL, 1, NULL, 0),
(75, 'SARATHKUMAR B', '', 'sarathkumar@cgvakindia.com', 'CG', '1097', 'All Rounder', '2019-10-10 13:01:37', '2019-11-14 15:49:55', 1, 1, 0),
(76, 'DENESH K.S ', '', 'deneshinbox@gmail.com', 'G2', 'Trainee', 'All Rounder', '2019-10-10 13:02:14', '2019-10-17 15:37:59', 1, NULL, 0),
(77, 'VASANTH', '', 'vasanth@gmail.com', 'G2', '560', 'All Rounder', '2019-10-10 13:04:11', NULL, 1, NULL, 0),
(78, 'JAGADISH', '', 'jagadish@cgvakindia.com', 'CG', '1074', 'All Rounder', '2019-10-10 13:04:44', NULL, 1, NULL, 0),
(79, 'NAGALINGAM V', '', 'nagalingam@cgvakindia.com', 'CG', '398', 'All Rounder', '2019-10-10 13:05:57', NULL, 1, NULL, 0),
(80, 'KESAVAN R', '', 'kesavan@cgvakindia.com', 'CG', '770', 'All Rounder', '2019-10-10 13:06:20', NULL, 1, NULL, 0),
(81, 'PRAKASH P', '', 'prakash.p@cgvakindia.com', 'CG', '822', 'All Rounder', '2019-10-10 13:06:41', NULL, 1, NULL, 0),
(82, 'PRABAKARAN M', '', 'prabakaran@cgvakindia.com', 'CG', '922', 'All Rounder', '2019-10-10 13:07:04', NULL, 1, NULL, 0),
(83, 'GOWRISHANKAR D', '', 'gowrishankar@cgvakindia.com', 'CG', '1080', 'All Rounder', '2019-10-10 13:07:30', NULL, 1, NULL, 0),
(84, 'MUTHUKUMAR D', '', 'muthukumar@cgvakindia.com', 'CG', '1017', 'All Rounder', '2019-10-10 13:11:58', NULL, 1, NULL, 0),
(85, 'MARIMUTHU G', '', 'marimuthu@cgvakindia.com', 'CG', '1027', 'All Rounder', '2019-10-10 13:12:33', NULL, 1, NULL, 0),
(86, 'ELAVARASAN G', '', 'elavarasan@cgvakindia.com', 'CG', '809', 'All Rounder', '2019-10-10 13:14:32', NULL, 1, NULL, 0),
(87, 'SATHISHKUMAR P', '', 'sathish.p@cgvakindia.com', 'CG', '929', 'All Rounder', '2019-10-10 13:15:11', NULL, 1, NULL, 0),
(88, 'PRASANNA G', '', 'paul@cgvakindia.com', 'CG', '675', 'All Rounder', '2019-10-10 13:15:38', NULL, 1, NULL, 0),
(89, 'SHIVA PRASAD R', '', 'shelton@cgvakindia.com', 'CG', '907', 'All Rounder', '2019-10-10 13:16:10', NULL, 1, NULL, 0),
(90, 'MURUGANANTH', '', 'murugananth@cgvakindia.com', 'CG', '1005', 'All Rounder', '2019-10-10 13:16:42', NULL, 1, NULL, 0),
(91, 'VETRIVEL M', '', 'vetrivel@cgvakindia.com', 'CG', '824', 'All Rounder', '2019-10-10 13:17:07', NULL, 1, NULL, 0),
(92, 'BALASUBRAMANIAM SP', '', 'balasubramaniyam@cgvakindia.com', 'CG', '1040', 'All Rounder', '2019-10-10 13:17:36', NULL, 1, NULL, 0),
(93, 'PARAMASIVAN ', '', 'paramasivan@g2techsoft.com', 'G2', '331', 'All Rounder', '2019-10-10 13:19:54', NULL, 1, NULL, 0),
(94, 'MUKESH ', '', 'mukesh@g2techsoft.com', 'G2', '447', 'All Rounder', '2019-10-10 13:20:14', NULL, 1, NULL, 0),
(95, 'DINESH KUMAR', '', 'dineshkumar.p@cgvakindia.com', 'CG', '1009', 'All Rounder', '2019-10-10 13:20:36', NULL, 1, NULL, 0),
(96, 'KATHIRAVAN BALAKRISHNAN', '', 'kathiravan@g2techsoft.com', 'G2', '465', 'All Rounder', '2019-10-10 13:20:58', NULL, 1, NULL, 0),
(97, 'KARTHIK ', '', 'karthik.s@g2techsoft.com', 'G2', '352', 'All Rounder', '2019-10-10 13:21:20', NULL, 1, NULL, 0),
(98, 'MANIKANDAN S', '', 'manikandan.s@cgvakindia.com ', 'CG', '979', 'All Rounder', '2019-10-10 13:21:43', '2019-11-14 15:53:11', 1, 1, 0),
(99, 'JD PRASAD VINUKONDA', '', 'prasadv@g2techsoft.com', 'G2', '543', 'All Rounder', '2019-10-10 13:22:06', NULL, 1, NULL, 0),
(100, 'OMKAR ', '', 'lekkalaomkar@cgvakindia.com', 'CG', '924', 'All Rounder', '2019-10-10 13:22:28', NULL, 1, NULL, 0),
(101, 'PRAVEEN ', '', 'praveen@g2techsoft.com', 'G2', '555', 'All Rounder', '2019-10-10 13:22:52', NULL, 1, NULL, 0),
(102, 'SUBBI SENNIMALAI', '', 'ssennimalai@nectarcorp.com ', 'CG', '0000', 'All Rounder', '2019-10-10 13:23:14', '2019-11-14 15:57:20', 1, 1, 0),
(103, 'SUGANTH KUMAR', '', 'suganthkumar@g2techsoft.com', 'G2', '551', 'All Rounder', '2019-10-10 13:23:40', NULL, 1, NULL, 0),
(104, 'JOJIN ANDREWS EAPEN', '', 'jojin@cgvakindia.com', 'CG', '1012', 'All Rounder', '2019-10-10 13:24:10', NULL, 1, NULL, 0),
(105, 'VISUVASA SIMON', '', 'visuvasasimon@g2techsoft.com', 'G2', '541', 'All Rounder', '2019-10-10 13:24:41', NULL, 1, NULL, 0),
(106, 'RAJIV RAVINDRAN ', '', 'rajivr@cgvakindia.com', 'CG', '983', 'All Rounder', '2019-10-10 13:25:13', NULL, 1, NULL, 0),
(107, 'ARAVINDH CHANDRASEKARAN', '', 'aravindh@cgvakindia.com', 'CG', '984', 'All Rounder', '2019-10-10 13:25:39', NULL, 1, NULL, 0),
(108, 'DHARMALINGAM P', '', 'dharmalingam@cgvakindia.com', 'CG', '655', 'All Rounder', '2019-10-10 13:26:44', NULL, 1, NULL, 0),
(109, 'PRADEEP KUMAR K ', '', 'pradeep@cgvakindia.com', 'CG', '810', 'All Rounder', '2019-10-10 13:27:24', NULL, 1, NULL, 0),
(110, 'ASHOK KUMAR T', '', 'ashokkumar.t@cgvakindia.com', 'CG', '579', 'All Rounder', '2019-10-10 13:27:48', NULL, 1, NULL, 0),
(111, 'KARTHIK K', '', 'karthik@cgvakindia.com', 'CG', '848', 'All Rounder', '2019-10-10 13:28:47', NULL, 1, NULL, 0),
(112, 'KARUNA M', '', 'karuna@cgvakindia.com', 'CG', '1083', 'All Rounder', '2019-10-10 13:29:10', NULL, 1, NULL, 0),
(113, 'KATHIRESAN M', '', 'kathiresan.m@cgvakindia.com', 'CG', '963', 'All Rounder', '2019-10-10 13:29:31', NULL, 1, NULL, 0),
(114, 'LAKSHMI NARAYANAN B', '', 'lakshmi@cgvakindia.com', 'CG', '962', 'All Rounder', '2019-10-10 13:29:53', NULL, 1, NULL, 0),
(115, 'PREM KUMAR R', '', 'premkumar@cgvakindia.com', 'CG', '982', 'All Rounder', '2019-10-10 13:30:13', NULL, 1, NULL, 0),
(116, 'RAJESH KUMAR R', '', 'rajeshkumar.r@cgvakindia.com', 'CG', '1059', 'All Rounder', '2019-10-10 13:30:38', NULL, 1, NULL, 0),
(117, 'RANJITH R K', '', 'ranjith.rk@cgvakindia.com', 'CG', '1046', 'All Rounder', '2019-10-10 13:31:45', NULL, 1, NULL, 0),
(118, 'SANTHOSH KUMAR G', '', 'santhoshkumar@cgvakindia.com', 'CG', '912', 'All Rounder', '2019-10-10 13:32:07', NULL, 1, NULL, 0),
(119, 'SHANMUGADOSS A', '', 'shanmugadoss@cgvakindia.com', 'CG', '439', 'All Rounder', '2019-10-10 13:32:54', NULL, 1, NULL, 0),
(120, 'VINOTHKANNAN M', '', 'vinothkannan@cgvakindia.com', 'CG', '1008', 'All Rounder', '2019-10-10 13:33:16', NULL, 1, NULL, 0),
(121, 'SHANKAR A M', '', 'shankar.m@cgvakindia.com', 'CG', '1094', 'All Rounder', '2019-10-10 13:33:46', NULL, 1, NULL, 0),
(122, 'ASHWIN N', '', 'ashwin.n@cgvakindia.com', 'CG', '1100', 'All Rounder', '2019-11-14 15:51:51', NULL, 1, NULL, 0),
(123, 'TAMIL SELVAN', '', 'tamilselvan@cgvakindia.com', 'CG', '1101', 'All Rounder', '2019-11-14 15:57:57', NULL, 1, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE `teams` (
  `team_id` int(11) NOT NULL,
  `team_name` varchar(150) NOT NULL COMMENT 'Eg: Chennai Super Kings',
  `team_logo` varchar(255) NOT NULL COMMENT 'Eg: image.jpg',
  `is_active` enum('T','F') NOT NULL DEFAULT 'T' COMMENT 'T - True, F - False',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`team_id`, `team_name`, `team_logo`, `is_active`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1, 'BLASTERS', '', 'T', '2019-10-10 13:38:10', NULL, 1, NULL),
(2, 'CSK', '', 'T', '2019-10-10 13:38:43', NULL, 1, NULL),
(3, 'KK5.0', '', 'T', '2019-10-10 13:38:54', NULL, 1, NULL),
(4, 'SCORPION KINGS', '', 'T', '2019-10-10 13:41:08', NULL, 1, NULL),
(5, 'SHIELDZ XI', '', 'T', '2019-10-10 13:41:17', NULL, 1, NULL),
(6, 'SOUP BOYS', '', 'T', '2019-10-10 13:41:27', NULL, 1, NULL),
(7, 'STRIKERS XI', '', 'T', '2019-10-10 13:41:35', NULL, 1, NULL),
(8, 'TUSKERS', '', 'T', '2019-10-10 13:41:42', NULL, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tournaments`
--

CREATE TABLE `tournaments` (
  `tournament_id` int(11) NOT NULL,
  `tournament_name` varchar(150) NOT NULL COMMENT 'Eg: GPL 2019',
  `tournament_year` int(4) NOT NULL,
  `is_active` enum('T','F') NOT NULL DEFAULT 'T' COMMENT 'T - True, F - False',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tournaments`
--

INSERT INTO `tournaments` (`tournament_id`, `tournament_name`, `tournament_year`, `is_active`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1, 'GPL  19-20', 2019, 'T', '2019-10-10 13:45:00', NULL, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tournament_players`
--

CREATE TABLE `tournament_players` (
  `tournament_players_id` int(11) NOT NULL,
  `tournament_team_id` int(11) NOT NULL,
  `player_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tournament_players`
--

INSERT INTO `tournament_players` (`tournament_players_id`, `tournament_team_id`, `player_id`, `created_at`, `updated_at`, `created_by`, `updated_by`, `is_deleted`) VALUES
(1, 1, 1, '2019-10-10 13:58:57', NULL, NULL, NULL, 0),
(2, 1, 2, '2019-10-10 13:58:57', NULL, NULL, NULL, 0),
(3, 1, 3, '2019-10-10 13:58:57', NULL, NULL, NULL, 0),
(4, 1, 4, '2019-10-10 13:58:57', NULL, NULL, NULL, 0),
(5, 1, 5, '2019-10-10 13:58:57', NULL, NULL, NULL, 0),
(6, 1, 6, '2019-10-10 13:58:57', NULL, NULL, NULL, 0),
(7, 1, 7, '2019-10-10 13:58:57', NULL, NULL, NULL, 0),
(8, 1, 8, '2019-10-10 13:58:57', NULL, NULL, NULL, 0),
(9, 1, 9, '2019-10-10 13:58:57', NULL, NULL, NULL, 0),
(10, 1, 10, '2019-10-10 13:58:57', NULL, NULL, NULL, 0),
(11, 1, 11, '2019-10-10 13:58:57', NULL, NULL, NULL, 0),
(12, 1, 12, '2019-10-10 13:58:57', NULL, NULL, NULL, 0),
(13, 1, 13, '2019-10-10 13:58:57', NULL, NULL, NULL, 0),
(14, 1, 14, '2019-10-10 13:58:57', NULL, NULL, NULL, 0),
(15, 1, 15, '2019-10-10 13:58:57', NULL, NULL, NULL, 0),
(16, 2, 16, '2019-10-10 14:00:43', NULL, NULL, NULL, 0),
(17, 2, 17, '2019-10-10 14:00:43', NULL, NULL, NULL, 0),
(18, 2, 18, '2019-10-10 14:00:43', NULL, NULL, NULL, 0),
(19, 2, 19, '2019-10-10 14:00:43', NULL, NULL, NULL, 0),
(20, 2, 20, '2019-10-10 14:00:43', NULL, NULL, NULL, 0),
(21, 2, 21, '2019-10-10 14:00:43', NULL, NULL, NULL, 0),
(22, 2, 22, '2019-10-10 14:00:43', NULL, NULL, NULL, 0),
(23, 2, 23, '2019-10-10 14:00:43', NULL, NULL, NULL, 0),
(24, 2, 24, '2019-10-10 14:00:43', NULL, NULL, NULL, 0),
(25, 2, 25, '2019-10-10 14:00:43', NULL, NULL, NULL, 0),
(26, 2, 26, '2019-10-10 14:00:43', NULL, NULL, NULL, 0),
(27, 2, 27, '2019-10-10 14:00:43', NULL, NULL, NULL, 0),
(28, 2, 28, '2019-10-10 14:00:43', NULL, NULL, NULL, 0),
(29, 2, 29, '2019-10-10 14:00:43', NULL, NULL, NULL, 0),
(30, 2, 30, '2019-10-10 14:00:43', NULL, NULL, NULL, 0),
(31, 3, 31, '2019-10-10 14:01:53', NULL, NULL, NULL, 0),
(32, 3, 32, '2019-10-10 14:01:53', NULL, NULL, NULL, 0),
(33, 3, 33, '2019-10-10 14:01:53', NULL, NULL, NULL, 0),
(34, 3, 34, '2019-10-10 14:01:53', NULL, NULL, NULL, 0),
(35, 3, 35, '2019-10-10 14:01:53', NULL, NULL, NULL, 0),
(36, 3, 36, '2019-10-10 14:01:53', NULL, NULL, NULL, 0),
(37, 3, 37, '2019-10-10 14:01:53', NULL, NULL, NULL, 0),
(38, 3, 38, '2019-10-10 14:01:53', NULL, NULL, NULL, 0),
(39, 3, 39, '2019-10-10 14:01:53', NULL, NULL, NULL, 0),
(40, 3, 40, '2019-10-10 14:01:53', NULL, NULL, NULL, 0),
(41, 3, 41, '2019-10-10 14:01:53', NULL, NULL, NULL, 0),
(42, 3, 42, '2019-10-10 14:01:53', NULL, NULL, NULL, 0),
(43, 3, 43, '2019-10-10 14:01:53', NULL, NULL, NULL, 0),
(44, 3, 44, '2019-10-10 14:01:53', NULL, NULL, NULL, 0),
(45, 3, 45, '2019-10-10 14:01:53', NULL, NULL, NULL, 0),
(46, 4, 46, '2019-10-10 14:03:12', NULL, NULL, NULL, 0),
(47, 4, 47, '2019-10-10 14:03:12', NULL, NULL, NULL, 0),
(48, 4, 48, '2019-10-10 14:03:12', NULL, NULL, NULL, 0),
(49, 4, 49, '2019-10-10 14:03:12', NULL, NULL, NULL, 0),
(50, 4, 50, '2019-10-10 14:03:12', NULL, NULL, NULL, 0),
(51, 4, 51, '2019-10-10 14:03:12', NULL, NULL, NULL, 0),
(52, 4, 52, '2019-10-10 14:03:12', NULL, NULL, NULL, 0),
(53, 4, 53, '2019-10-10 14:03:12', NULL, NULL, NULL, 0),
(54, 4, 54, '2019-10-10 14:03:12', NULL, NULL, NULL, 0),
(55, 4, 55, '2019-10-10 14:03:12', NULL, NULL, NULL, 0),
(56, 4, 56, '2019-10-10 14:03:12', NULL, NULL, NULL, 0),
(57, 4, 57, '2019-10-10 14:03:12', NULL, NULL, NULL, 0),
(58, 4, 58, '2019-10-10 14:03:12', NULL, NULL, NULL, 0),
(59, 4, 59, '2019-10-10 14:03:12', NULL, NULL, NULL, 0),
(60, 4, 63, '2019-10-10 14:03:12', NULL, NULL, NULL, 0),
(61, 5, 64, '2019-10-10 14:04:11', NULL, NULL, NULL, 0),
(62, 5, 65, '2019-10-10 14:04:11', NULL, NULL, NULL, 0),
(63, 5, 66, '2019-10-10 14:04:11', NULL, NULL, NULL, 0),
(64, 5, 67, '2019-10-10 14:04:11', NULL, NULL, NULL, 0),
(65, 5, 68, '2019-10-10 14:04:11', NULL, NULL, NULL, 0),
(66, 5, 69, '2019-10-10 14:04:11', NULL, NULL, NULL, 0),
(67, 5, 70, '2019-10-10 14:04:11', NULL, NULL, NULL, 0),
(68, 5, 71, '2019-10-10 14:04:11', NULL, NULL, NULL, 0),
(69, 5, 72, '2019-10-10 14:04:11', NULL, NULL, NULL, 0),
(70, 5, 73, '2019-10-10 14:04:11', NULL, NULL, NULL, 0),
(71, 5, 74, '2019-10-10 14:04:11', NULL, NULL, NULL, 0),
(72, 5, 75, '2019-10-10 14:04:11', NULL, NULL, NULL, 0),
(73, 5, 76, '2019-10-10 14:04:11', NULL, NULL, NULL, 0),
(74, 5, 77, '2019-10-10 14:04:11', NULL, NULL, NULL, 0),
(75, 5, 78, '2019-10-10 14:04:11', NULL, NULL, NULL, 0),
(76, 6, 79, '2019-10-10 14:40:08', NULL, NULL, NULL, 0),
(77, 6, 80, '2019-10-10 14:40:08', NULL, NULL, NULL, 0),
(78, 6, 81, '2019-10-10 14:40:08', NULL, NULL, NULL, 0),
(79, 6, 82, '2019-10-10 14:40:08', NULL, NULL, NULL, 0),
(80, 6, 83, '2019-10-10 14:40:08', NULL, NULL, NULL, 0),
(81, 6, 84, '2019-10-10 14:40:08', NULL, NULL, NULL, 0),
(82, 6, 85, '2019-10-10 14:40:08', NULL, NULL, NULL, 0),
(83, 6, 86, '2019-10-10 14:40:08', NULL, NULL, NULL, 0),
(84, 6, 87, '2019-10-10 14:40:08', NULL, NULL, NULL, 0),
(85, 6, 88, '2019-10-10 14:40:08', NULL, NULL, NULL, 0),
(86, 6, 89, '2019-10-10 14:40:08', NULL, NULL, NULL, 0),
(87, 6, 90, '2019-10-10 14:40:08', NULL, NULL, NULL, 0),
(88, 6, 91, '2019-10-10 14:40:08', NULL, NULL, NULL, 0),
(89, 6, 92, '2019-10-10 14:40:08', NULL, NULL, NULL, 0),
(90, 7, 93, '2019-10-10 14:42:11', NULL, NULL, NULL, 0),
(91, 7, 94, '2019-10-10 14:42:11', NULL, NULL, NULL, 0),
(92, 7, 95, '2019-10-10 14:42:11', NULL, NULL, NULL, 0),
(93, 7, 96, '2019-10-10 14:42:11', NULL, NULL, NULL, 0),
(94, 7, 97, '2019-10-10 14:42:11', NULL, NULL, NULL, 0),
(95, 7, 98, '2019-10-10 14:42:11', NULL, NULL, NULL, 0),
(96, 7, 99, '2019-10-10 14:42:11', NULL, NULL, NULL, 0),
(97, 7, 100, '2019-10-10 14:42:11', NULL, NULL, NULL, 0),
(98, 7, 101, '2019-10-10 14:42:11', NULL, NULL, NULL, 0),
(99, 7, 102, '2019-10-10 14:42:11', NULL, NULL, NULL, 0),
(100, 7, 103, '2019-10-10 14:42:11', NULL, NULL, NULL, 0),
(101, 7, 104, '2019-10-10 14:42:11', NULL, NULL, NULL, 0),
(102, 7, 105, '2019-10-10 14:42:11', NULL, NULL, NULL, 0),
(103, 7, 106, '2019-10-10 14:42:11', NULL, NULL, NULL, 0),
(104, 7, 107, '2019-10-10 14:42:11', NULL, NULL, NULL, 0),
(105, 8, 108, '2019-10-10 14:44:32', NULL, NULL, NULL, 0),
(106, 8, 109, '2019-10-10 14:44:32', NULL, NULL, NULL, 0),
(107, 8, 110, '2019-10-10 14:44:32', NULL, NULL, NULL, 0),
(108, 8, 111, '2019-10-10 14:44:32', NULL, NULL, NULL, 0),
(109, 8, 112, '2019-10-10 14:44:32', NULL, NULL, NULL, 0),
(110, 8, 113, '2019-10-10 14:44:32', NULL, NULL, NULL, 0),
(111, 8, 114, '2019-10-10 14:44:32', NULL, NULL, NULL, 0),
(112, 8, 115, '2019-10-10 14:44:32', NULL, NULL, NULL, 0),
(113, 8, 116, '2019-10-10 14:44:32', NULL, NULL, NULL, 0),
(114, 8, 117, '2019-10-10 14:44:32', NULL, NULL, NULL, 0),
(115, 8, 118, '2019-10-10 14:44:32', NULL, NULL, NULL, 0),
(116, 8, 119, '2019-10-10 14:44:32', NULL, NULL, NULL, 0),
(117, 8, 120, '2019-10-10 14:44:32', NULL, NULL, NULL, 0),
(118, 8, 121, '2019-10-10 14:44:32', NULL, NULL, NULL, 0),
(119, 6, 122, '2019-11-14 15:52:03', NULL, NULL, NULL, 0),
(120, 8, 123, '2019-11-14 15:58:08', NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tournament_teams`
--

CREATE TABLE `tournament_teams` (
  `tournament_team_id` int(11) NOT NULL,
  `tournament_id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  `captain` int(11) NOT NULL,
  `vice_captain` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `is_active` enum('T','F') NOT NULL DEFAULT 'T'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tournament_teams`
--

INSERT INTO `tournament_teams` (`tournament_team_id`, `tournament_id`, `team_id`, `captain`, `vice_captain`, `created_at`, `updated_at`, `created_by`, `updated_by`, `is_active`) VALUES
(1, 1, 1, 1, 2, '2019-10-10 13:48:20', NULL, 1, NULL, 'T'),
(2, 1, 2, 16, 17, '2019-10-10 13:49:17', NULL, 1, NULL, 'T'),
(3, 1, 3, 31, 32, '2019-10-10 13:51:39', NULL, 1, NULL, 'T'),
(4, 1, 4, 46, 47, '2019-10-10 13:52:08', NULL, 1, NULL, 'T'),
(5, 1, 5, 64, 65, '2019-10-10 13:53:16', NULL, 1, NULL, 'T'),
(6, 1, 6, 79, 80, '2019-10-10 13:54:05', NULL, 1, NULL, 'T'),
(7, 1, 7, 93, 94, '2019-10-10 13:54:28', NULL, 1, NULL, 'T'),
(8, 1, 8, 108, 109, '2019-10-10 13:55:02', NULL, 1, NULL, 'T');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(100) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `is_active` enum('T','F') NOT NULL DEFAULT 'T' COMMENT 'T - True, F - False',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_email`, `user_password`, `is_active`, `created_at`, `updated_at`, `updated_by`) VALUES
(1, 'Administrator', 'gpl@cgvakindia.com', 'f5a427e642b32397af3cd5f3f361814f', 'T', '2019-10-02 17:46:05', '2019-10-08 13:03:02', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ball_records`
--
ALTER TABLE `ball_records`
  ADD PRIMARY KEY (`ball_id`),
  ADD KEY `over_id` (`over_id`),
  ADD KEY `bowler` (`bowler`),
  ADD KEY `batsman` (`batsman`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indexes for table `batsman_ball_records`
--
ALTER TABLE `batsman_ball_records`
  ADD PRIMARY KEY (`batsman_ball_record_id`);

--
-- Indexes for table `batsman_innings`
--
ALTER TABLE `batsman_innings`
  ADD PRIMARY KEY (`batsman_inning_id`),
  ADD KEY `wicket_assist1` (`wicket_assist1`),
  ADD KEY `wicket_assist2` (`wicket_assist2`);

--
-- Indexes for table `bowler_innings`
--
ALTER TABLE `bowler_innings`
  ADD PRIMARY KEY (`bowler_inning_id`);

--
-- Indexes for table `fall_of_wickets`
--
ALTER TABLE `fall_of_wickets`
  ADD PRIMARY KEY (`fall_of_wicket_id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`group_id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`),
  ADD KEY `tournament_id` (`tournament_id`);

--
-- Indexes for table `group_points`
--
ALTER TABLE `group_points`
  ADD PRIMARY KEY (`group_points_id`),
  ADD KEY `group_id` (`group_id`),
  ADD KEY `tournament_team_id` (`tournament_team_id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `deleted_by` (`updated_by`);

--
-- Indexes for table `innings`
--
ALTER TABLE `innings`
  ADD PRIMARY KEY (`inning_id`),
  ADD UNIQUE KEY `unique_combination` (`inning_number`,`match_id`,`batting_team`,`bowling_team`),
  ADD KEY `match_id` (`match_id`),
  ADD KEY `batting_team` (`batting_team`),
  ADD KEY `bowling_team` (`bowling_team`),
  ADD KEY `batsman_1` (`batsman_1`),
  ADD KEY `batsman_2` (`batsman_2`),
  ADD KEY `batsman_on_strike` (`batsman_on_strike`),
  ADD KEY `bowler` (`bowler`),
  ADD KEY `updated_by` (`updated_by`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `matches`
--
ALTER TABLE `matches`
  ADD PRIMARY KEY (`match_id`),
  ADD KEY `tournament_id` (`tournament_id`),
  ADD KEY `team_1` (`team_1`),
  ADD KEY `team_2` (`team_2`),
  ADD KEY `umpire_1` (`umpire_1`),
  ADD KEY `umpire_2` (`umpire_2`),
  ADD KEY `scorer` (`scorer`),
  ADD KEY `toss_won` (`toss_won`),
  ADD KEY `winning_team` (`winning_team`),
  ADD KEY `man_of_match` (`man_of_match`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indexes for table `match_logs`
--
ALTER TABLE `match_logs`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `match_squads`
--
ALTER TABLE `match_squads`
  ADD PRIMARY KEY (`match_squad_id`),
  ADD UNIQUE KEY `match_id_2` (`match_id`,`team_id`,`player_id`),
  ADD KEY `updated_by` (`updated_by`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `player_id` (`player_id`),
  ADD KEY `team_id` (`team_id`),
  ADD KEY `match_id` (`match_id`);

--
-- Indexes for table `over_records`
--
ALTER TABLE `over_records`
  ADD PRIMARY KEY (`over_id`);

--
-- Indexes for table `players`
--
ALTER TABLE `players`
  ADD PRIMARY KEY (`player_id`),
  ADD UNIQUE KEY `employee_id` (`employee_id`),
  ADD KEY `created_by` (`created_by`,`updated_by`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`team_id`),
  ADD KEY `created_by` (`created_by`,`updated_by`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indexes for table `tournaments`
--
ALTER TABLE `tournaments`
  ADD PRIMARY KEY (`tournament_id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indexes for table `tournament_players`
--
ALTER TABLE `tournament_players`
  ADD PRIMARY KEY (`tournament_players_id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`),
  ADD KEY `tournament_team_id` (`tournament_team_id`),
  ADD KEY `player_id` (`player_id`);

--
-- Indexes for table `tournament_teams`
--
ALTER TABLE `tournament_teams`
  ADD PRIMARY KEY (`tournament_team_id`),
  ADD KEY `tournament_id` (`tournament_id`),
  ADD KEY `team_id` (`team_id`),
  ADD KEY `captain` (`captain`),
  ADD KEY `vice_captain` (`vice_captain`),
  ADD KEY `created_by` (`created_by`,`updated_by`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `updated_by` (`updated_by`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ball_records`
--
ALTER TABLE `ball_records`
  MODIFY `ball_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `batsman_ball_records`
--
ALTER TABLE `batsman_ball_records`
  MODIFY `batsman_ball_record_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `batsman_innings`
--
ALTER TABLE `batsman_innings`
  MODIFY `batsman_inning_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bowler_innings`
--
ALTER TABLE `bowler_innings`
  MODIFY `bowler_inning_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fall_of_wickets`
--
ALTER TABLE `fall_of_wickets`
  MODIFY `fall_of_wicket_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `group_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `group_points`
--
ALTER TABLE `group_points`
  MODIFY `group_points_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `innings`
--
ALTER TABLE `innings`
  MODIFY `inning_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `matches`
--
ALTER TABLE `matches`
  MODIFY `match_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `match_logs`
--
ALTER TABLE `match_logs`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `match_squads`
--
ALTER TABLE `match_squads`
  MODIFY `match_squad_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `over_records`
--
ALTER TABLE `over_records`
  MODIFY `over_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `players`
--
ALTER TABLE `players`
  MODIFY `player_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `team_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tournaments`
--
ALTER TABLE `tournaments`
  MODIFY `tournament_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tournament_players`
--
ALTER TABLE `tournament_players`
  MODIFY `tournament_players_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT for table `tournament_teams`
--
ALTER TABLE `tournament_teams`
  MODIFY `tournament_team_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ball_records`
--
ALTER TABLE `ball_records`
  ADD CONSTRAINT `ball_records_ibfk_1` FOREIGN KEY (`over_id`) REFERENCES `over_records` (`over_id`),
  ADD CONSTRAINT `ball_records_ibfk_2` FOREIGN KEY (`bowler`) REFERENCES `players` (`player_id`),
  ADD CONSTRAINT `ball_records_ibfk_3` FOREIGN KEY (`batsman`) REFERENCES `players` (`player_id`),
  ADD CONSTRAINT `ball_records_ibfk_4` FOREIGN KEY (`created_by`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `ball_records_ibfk_5` FOREIGN KEY (`updated_by`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `groups`
--
ALTER TABLE `groups`
  ADD CONSTRAINT `groups_ibfk_1` FOREIGN KEY (`tournament_id`) REFERENCES `tournaments` (`tournament_id`),
  ADD CONSTRAINT `groups_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `groups_ibfk_3` FOREIGN KEY (`updated_by`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `group_points`
--
ALTER TABLE `group_points`
  ADD CONSTRAINT `group_points_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`group_id`),
  ADD CONSTRAINT `group_points_ibfk_2` FOREIGN KEY (`tournament_team_id`) REFERENCES `tournament_teams` (`tournament_team_id`),
  ADD CONSTRAINT `group_points_ibfk_3` FOREIGN KEY (`created_by`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `group_points_ibfk_4` FOREIGN KEY (`updated_by`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `innings`
--
ALTER TABLE `innings`
  ADD CONSTRAINT `innings_ibfk_1` FOREIGN KEY (`match_id`) REFERENCES `matches` (`match_id`),
  ADD CONSTRAINT `innings_ibfk_2` FOREIGN KEY (`batting_team`) REFERENCES `teams` (`team_id`),
  ADD CONSTRAINT `innings_ibfk_3` FOREIGN KEY (`bowling_team`) REFERENCES `teams` (`team_id`),
  ADD CONSTRAINT `innings_ibfk_4` FOREIGN KEY (`batsman_1`) REFERENCES `players` (`player_id`),
  ADD CONSTRAINT `innings_ibfk_5` FOREIGN KEY (`batsman_2`) REFERENCES `players` (`player_id`),
  ADD CONSTRAINT `innings_ibfk_6` FOREIGN KEY (`batsman_on_strike`) REFERENCES `players` (`player_id`),
  ADD CONSTRAINT `innings_ibfk_7` FOREIGN KEY (`bowler`) REFERENCES `players` (`player_id`),
  ADD CONSTRAINT `innings_ibfk_8` FOREIGN KEY (`created_by`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `innings_ibfk_9` FOREIGN KEY (`updated_by`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `matches`
--
ALTER TABLE `matches`
  ADD CONSTRAINT `matches_ibfk_1` FOREIGN KEY (`tournament_id`) REFERENCES `tournaments` (`tournament_id`),
  ADD CONSTRAINT `matches_ibfk_10` FOREIGN KEY (`created_by`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `matches_ibfk_11` FOREIGN KEY (`updated_by`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `matches_ibfk_2` FOREIGN KEY (`team_1`) REFERENCES `tournament_teams` (`tournament_team_id`),
  ADD CONSTRAINT `matches_ibfk_3` FOREIGN KEY (`team_2`) REFERENCES `tournament_teams` (`tournament_team_id`),
  ADD CONSTRAINT `matches_ibfk_4` FOREIGN KEY (`umpire_1`) REFERENCES `players` (`player_id`),
  ADD CONSTRAINT `matches_ibfk_5` FOREIGN KEY (`umpire_2`) REFERENCES `players` (`player_id`),
  ADD CONSTRAINT `matches_ibfk_6` FOREIGN KEY (`scorer`) REFERENCES `players` (`player_id`),
  ADD CONSTRAINT `matches_ibfk_7` FOREIGN KEY (`toss_won`) REFERENCES `teams` (`team_id`),
  ADD CONSTRAINT `matches_ibfk_8` FOREIGN KEY (`winning_team`) REFERENCES `teams` (`team_id`),
  ADD CONSTRAINT `matches_ibfk_9` FOREIGN KEY (`man_of_match`) REFERENCES `players` (`player_id`);

--
-- Constraints for table `match_squads`
--
ALTER TABLE `match_squads`
  ADD CONSTRAINT `match_squads_ibfk_1` FOREIGN KEY (`match_id`) REFERENCES `matches` (`match_id`),
  ADD CONSTRAINT `match_squads_ibfk_2` FOREIGN KEY (`team_id`) REFERENCES `tournament_teams` (`tournament_team_id`),
  ADD CONSTRAINT `match_squads_ibfk_3` FOREIGN KEY (`player_id`) REFERENCES `players` (`player_id`),
  ADD CONSTRAINT `match_squads_ibfk_4` FOREIGN KEY (`created_by`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `match_squads_ibfk_5` FOREIGN KEY (`updated_by`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `players`
--
ALTER TABLE `players`
  ADD CONSTRAINT `players_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `players_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
