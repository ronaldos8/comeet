-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 30, 2016 at 09:10 AM
-- Server version: 5.7.14
-- PHP Version: 7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_comeet`
--

-- --------------------------------------------------------

--
-- Table structure for table `meeting`
--

CREATE TABLE `meeting` (
  `m_id` int(11) NOT NULL,
  `m_name` varchar(30) NOT NULL,
  `m_desc` longtext NOT NULL,
  `venue` varchar(30) NOT NULL,
  `start_period` date NOT NULL,
  `end_period` date NOT NULL,
  `n_accomodate` varchar(20) DEFAULT NULL,
  `duration` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `meeting`
--

INSERT INTO `meeting` (`m_id`, `m_name`, `m_desc`, `venue`, `start_period`, `end_period`, `n_accomodate`, `duration`) VALUES
(22, 'Briefing Panitia', 'Briefing Panitia', 'BPU UPI', '2016-11-30', '2016-12-02', '3', 60),
(20, 'Rapat Departemen', 'Membahas permasalahan yang ada di departemen', 'Auditorium FPMIPA A', '2016-12-10', '2016-12-16', '3', 120),
(21, 'Launching Comeet App', 'Acara peresmian aplikasi comeet', 'Microsoft Center, Redmond, Ame', '2016-11-30', '2016-12-02', '3', 120),
(18, 'Rapat Besar Dinamik 12', 'Rapat koordinasi antar divisi di dinamik 12', 'FPMIPA C (GIK)', '2016-11-01', '2016-11-05', '3', 120),
(19, 'Rapat Pimpinan', 'Rapat untuk membahas kurikulum pendidikan dan jadwal semester ganjil', 'Meeting room FPMIPA A', '2016-11-10', '2016-11-11', '3', 120),
(23, 'Briefing anitia', 'Briefing Panitia', 'BPU UPI', '2016-11-30', '2016-12-02', '3', 60),
(24, 'Briefing anitia', 'Briefing Panitia', 'BPU UPI', '2016-11-30', '2016-12-02', '3', 60),
(25, 'Makrab', 'Malam keakraban bersama alumni', 'Lembang', '2016-11-30', '2016-12-02', '1', 240),
(26, 'Makrab', 'Malam keakraban bersama alumni', 'Lembang', '2016-11-30', '2016-12-02', '2', 240),
(27, 'Konferensi Asia Afrika', 'Konferensi Asia Afrika', 'Gedung KAA', '2016-12-08', '2016-12-21', '3', 360),
(28, 'Konferensi Asia Afrika', 'Konferensi Asia Afrika', 'Gedung KAA', '2016-12-08', '2016-12-21', '3', 360),
(31, 'sidang A', 'deskripsi sidang a', 'ruang rapat', '2016-11-30', '2016-12-07', '3', 2),
(30, 'Meeting 111', 'meting', 'dimana aja', '2016-11-03', '2016-11-17', '3', 10);

-- --------------------------------------------------------

--
-- Table structure for table `meeting_role`
--

CREATE TABLE `meeting_role` (
  `mr_id` int(11) NOT NULL,
  `mr_name` varchar(20) NOT NULL,
  `pro_quo` int(11) NOT NULL,
  `m_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `meeting_role`
--

INSERT INTO `meeting_role` (`mr_id`, `mr_name`, `pro_quo`, `m_id`) VALUES
(51, 'Linux Co-Founded', 100, 21),
(50, 'Microsoft Co-Fouded', 100, 21),
(49, 'Sekretaris', 90, 20),
(48, 'Wakil Dekan', 95, 20),
(46, 'Kaprodi Pilkom', 95, 19),
(47, 'Dekan', 100, 20),
(45, 'Kaprodi Ilkom', 95, 19),
(44, 'Dekan FPMIPA', 100, 19),
(43, 'Koordinator Acara', 90, 18),
(42, 'Sekretaris', 90, 18),
(41, 'Ketua Pelaksana', 100, 18),
(52, 'Mahasiswa', 100, 21),
(53, 'Ketua', 100, 22),
(54, 'Wakil', 90, 22),
(55, 'Sekretaris', 80, 22),
(56, 'Peran 1', 100, 23),
(57, 'Peran 2', 90, 23),
(58, 'Peran 3', 80, 23),
(59, 'Peran 1', 100, 24),
(60, 'Peran 2', 90, 24),
(61, 'Peran 3', 80, 24),
(62, 'Alumni', 100, 25),
(63, 'Ketua Alumni', 100, 26),
(64, 'Wakil ketua alumni', 80, 26),
(65, 'Peran 1', 100, 27),
(66, 'Peran 2', 90, 27),
(67, 'peran 3', 90, 27),
(68, 'Peran 1', 100, 28),
(69, 'Peran 2', 90, 28),
(70, 'peran 3', 90, 28),
(78, 'copromotor', 50, 31),
(77, 'promotor', 100, 31),
(74, 'Peran 1', 100, 30),
(75, 'Peran 2', 100, 30),
(76, 'peran 3', 100, 30),
(79, 'penguji', 100, 31);

-- --------------------------------------------------------

--
-- Table structure for table `personnel`
--

CREATE TABLE `personnel` (
  `p_id` int(11) NOT NULL,
  `p_name` varchar(20) NOT NULL,
  `p_type` varchar(15) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `personnel`
--

INSERT INTO `personnel` (`p_id`, `p_name`, `p_type`) VALUES
(6, 'John Doe', NULL),
(5, 'Ronaldo Simanjuntak', NULL),
(4, 'Ricardo', NULL),
(7, 'Asley', NULL),
(8, 'Dave Stuart', NULL),
(10, 'Bill Gates', NULL),
(11, 'Linus Benedict Torva', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `personnel_role`
--

CREATE TABLE `personnel_role` (
  `pr_id` int(11) NOT NULL,
  `mr_id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `personnel_role`
--

INSERT INTO `personnel_role` (`pr_id`, `mr_id`, `p_id`) VALUES
(55, 58, 4),
(54, 57, 6),
(53, 56, 5),
(52, 55, 7),
(51, 54, 5),
(50, 53, 6),
(49, 52, 5),
(48, 51, 11),
(47, 50, 10),
(46, 49, 7),
(45, 48, 8),
(44, 47, 4),
(43, 46, 6),
(42, 45, 8),
(41, 44, 5),
(40, 43, 7),
(39, 42, 6),
(38, 41, 5),
(56, 59, 6),
(57, 60, 4),
(58, 61, 4),
(59, 62, 7),
(60, 63, 8),
(61, 64, 4),
(62, 68, 6),
(63, 68, 5),
(64, 68, 7),
(65, 69, 6),
(66, 69, 5),
(67, 69, 7),
(68, 70, 6),
(69, 70, 5),
(70, 70, 7),
(101, 79, 7),
(100, 79, 5),
(99, 79, 6),
(98, 78, 11),
(97, 78, 8),
(96, 77, 4),
(89, 74, 6),
(90, 74, 5),
(91, 74, 4),
(92, 75, 7),
(93, 75, 8),
(94, 76, 10),
(95, 76, 11);

-- --------------------------------------------------------

--
-- Table structure for table `slot`
--

CREATE TABLE `slot` (
  `slot_id` int(11) NOT NULL,
  `desc_time` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `slot`
--

INSERT INTO `slot` (`slot_id`, `desc_time`) VALUES
(1, '2016-11-28'),
(2, '2016-11-29'),
(3, '2016-11-30'),
(4, '2016-12-01'),
(5, '2016-12-02'),
(6, '2016-11-03');

-- --------------------------------------------------------

--
-- Table structure for table `timetable`
--

CREATE TABLE `timetable` (
  `t_id` int(11) NOT NULL,
  `m_id` int(11) NOT NULL,
  `slot_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `timetable`
--

INSERT INTO `timetable` (`t_id`, `m_id`, `slot_id`) VALUES
(44, 27, 6),
(10, 19, 4),
(42, 21, 1),
(39, 18, 1),
(40, 25, 4),
(43, 26, 5),
(37, 23, 4),
(32, 30, 2),
(41, 28, 3),
(36, 20, 4),
(45, 22, 6),
(46, 24, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `meeting`
--
ALTER TABLE `meeting`
  ADD PRIMARY KEY (`m_id`);

--
-- Indexes for table `meeting_role`
--
ALTER TABLE `meeting_role`
  ADD PRIMARY KEY (`mr_id`),
  ADD KEY `m_id` (`m_id`);

--
-- Indexes for table `personnel`
--
ALTER TABLE `personnel`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `personnel_role`
--
ALTER TABLE `personnel_role`
  ADD PRIMARY KEY (`pr_id`),
  ADD KEY `mr_id` (`mr_id`),
  ADD KEY `p_id` (`p_id`);

--
-- Indexes for table `slot`
--
ALTER TABLE `slot`
  ADD PRIMARY KEY (`slot_id`);

--
-- Indexes for table `timetable`
--
ALTER TABLE `timetable`
  ADD PRIMARY KEY (`t_id`),
  ADD KEY `m_id` (`m_id`),
  ADD KEY `slot_id` (`slot_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `meeting`
--
ALTER TABLE `meeting`
  MODIFY `m_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `meeting_role`
--
ALTER TABLE `meeting_role`
  MODIFY `mr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;
--
-- AUTO_INCREMENT for table `personnel`
--
ALTER TABLE `personnel`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `personnel_role`
--
ALTER TABLE `personnel_role`
  MODIFY `pr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;
--
-- AUTO_INCREMENT for table `slot`
--
ALTER TABLE `slot`
  MODIFY `slot_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `timetable`
--
ALTER TABLE `timetable`
  MODIFY `t_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
