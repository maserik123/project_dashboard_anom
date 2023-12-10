-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 10, 2023 at 09:43 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `monitoring_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `criteria_project`
--

CREATE TABLE `criteria_project` (
  `criteria_project_id` int(11) NOT NULL,
  `criteria_project_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `criteria_project`
--

INSERT INTO `criteria_project` (`criteria_project_id`, `criteria_project_name`) VALUES
(1, 'Kajian'),
(2, 'Fisik'),
(3, 'Kerjasama');

-- --------------------------------------------------------

--
-- Table structure for table `issue_problem`
--

CREATE TABLE `issue_problem` (
  `issue_problem_id` int(11) NOT NULL,
  `problem` text DEFAULT NULL,
  `solution` text DEFAULT NULL,
  `pic_project_dtl_id` int(11) DEFAULT NULL,
  `master_project_id` int(11) DEFAULT NULL,
  `status` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `issue_problem`
--

INSERT INTO `issue_problem` (`issue_problem_id`, `problem`, `solution`, `pic_project_dtl_id`, `master_project_id`, `status`) VALUES
(1, 'tes', 'test', 1, 10, 'completed');

-- --------------------------------------------------------

--
-- Table structure for table `master_project`
--

CREATE TABLE `master_project` (
  `master_project_id` int(11) NOT NULL,
  `project_name` varchar(255) NOT NULL,
  `criteria_project_id` int(11) NOT NULL,
  `project_description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `master_project`
--

INSERT INTO `master_project` (`master_project_id`, `project_name`, `criteria_project_id`, `project_description`) VALUES
(10, 'Kerjasama NPEA', 3, 'Akses Proyek NPEA merupakan PSN milik PT IPC yang melintasi lahan C.01, C.02 dan C.03 milik KBN\r\nKerja Sama antara Kawasan Industri dan Pelabuhan (Pilot Project PT Kawasan Berikat Nusantara)'),
(11, 'Perpanjangan Kerjasama Tj. Priok', 1, '-'),
(12, 'Imbreng Asset PT KCN', 3, '-'),
(13, 'Aktivasi MBI sebagai JV KI', 3, '-'),
(14, 'Pengembangan PT KGM', 3, '-'),
(15, 'Pengembangan PT KPL', 1, '-'),
(16, 'Pengembangan Pelabuhan C 05', 1, '-'),
(17, 'Pembangunan Gudang Konsolidasi', 2, '-'),
(18, 'Pembangunan WTP C 05', 2, '-'),
(19, 'Pembangunan WWTP C 01', 3, '-'),
(20, 'Kerjasama Pengelolaan FO', 3, '-'),
(21, 'Kerjasama dengan Nindiya Beton', 3, '-'),
(22, 'Real Demand Survey', 1, '-'),
(23, 'Pembangunan Jalan Akses RSUP', 2, '-'),
(24, 'Renovasi Bangunan Blok A-33', 2, '-'),
(25, 'Pengecoran Jalan Irian', 2, '-'),
(26, 'Pengadaan Prasarana Lift RSUP', 2, '-');

-- --------------------------------------------------------

--
-- Table structure for table `pic_project_dtl`
--

CREATE TABLE `pic_project_dtl` (
  `pic_project_dtl_id` int(11) NOT NULL,
  `pic_project_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pic_project_dtl`
--

INSERT INTO `pic_project_dtl` (`pic_project_dtl_id`, `pic_project_name`) VALUES
(1, 'BISDEV'),
(2, 'HUKUM'),
(3, 'OPTEK'),
(4, 'KOMERSIL'),
(5, 'PANDA'),
(6, 'CAKUNG'),
(7, 'KEU'),
(9, 'TIM');

-- --------------------------------------------------------

--
-- Table structure for table `pic_project_hdr`
--

CREATE TABLE `pic_project_hdr` (
  `pic_project_hdr_id` int(11) NOT NULL,
  `pic_project_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pic_project_hdr`
--

INSERT INTO `pic_project_hdr` (`pic_project_hdr_id`, `pic_project_name`) VALUES
(1, 'BISDEV'),
(2, 'HUKUM'),
(3, 'OPTEK'),
(4, 'KOMERSIL'),
(6, 'TIM');

-- --------------------------------------------------------

--
-- Table structure for table `project_information`
--

CREATE TABLE `project_information` (
  `project_information_id` int(11) NOT NULL,
  `master_project_id` int(11) NOT NULL,
  `consultant_name` varchar(255) NOT NULL,
  `contract_price` varchar(25) NOT NULL,
  `termyn_value` int(11) NOT NULL,
  `payed` varchar(12) NOT NULL,
  `kind_of_consultant` enum('Consultant','Mitra') DEFAULT NULL,
  `waktu_konsultan_mitra` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `project_information`
--

INSERT INTO `project_information` (`project_information_id`, `master_project_id`, `consultant_name`, `contract_price`, `termyn_value`, `payed`, `kind_of_consultant`, `waktu_konsultan_mitra`) VALUES
(4, 10, 'Consultan1', '1000000', 3, '500000', 'Consultant', '3 Bulan'),
(5, 10, 'PT Pelindo (Persero)', '50000000', 5, '3000000', 'Mitra', 'Jangka Panjang');

-- --------------------------------------------------------

--
-- Table structure for table `project_m_dtl`
--

CREATE TABLE `project_m_dtl` (
  `project_m_dtl_id` int(11) NOT NULL,
  `master_project_id` int(11) NOT NULL,
  `project_activity` text NOT NULL,
  `pic_project_dtl_id` int(11) NOT NULL,
  `dateline` text NOT NULL,
  `progress` varchar(45) NOT NULL,
  `ket` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `project_m_dtl`
--

INSERT INTO `project_m_dtl` (`project_m_dtl_id`, `master_project_id`, `project_activity`, `pic_project_dtl_id`, `dateline`, `progress`, `ket`) VALUES
(4, 10, 'Head of Agreement (HoA) Pembentukan Tim Bersama', 2, '2021-12-14', '100', '-'),
(5, 10, 'Kick Off Meeting Pelaksanaan HoA', 9, '2023-12-31', '75', '-');

-- --------------------------------------------------------

--
-- Table structure for table `project_m_hdr`
--

CREATE TABLE `project_m_hdr` (
  `project_m_hdr_id` int(11) NOT NULL,
  `master_project_id` int(11) NOT NULL,
  `pic_project_hdr_id` int(11) NOT NULL,
  `criteria_project_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `capex_budget` varchar(255) NOT NULL DEFAULT '0',
  `capex_realization` varchar(255) NOT NULL DEFAULT '0',
  `contract_value` varchar(255) NOT NULL DEFAULT '0',
  `revenue_target` varchar(255) NOT NULL DEFAULT '0',
  `revenue_realization` varchar(255) NOT NULL DEFAULT '0',
  `project_status_id` int(11) NOT NULL,
  `progress_kajian` varchar(45) NOT NULL DEFAULT '0',
  `progress_fisik` varchar(45) NOT NULL DEFAULT '0',
  `update_status` text NOT NULL,
  `foto` text NOT NULL,
  `crt_date` date DEFAULT NULL,
  `update_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `project_m_hdr`
--

INSERT INTO `project_m_hdr` (`project_m_hdr_id`, `master_project_id`, `pic_project_hdr_id`, `criteria_project_id`, `start_date`, `end_date`, `capex_budget`, `capex_realization`, `contract_value`, `revenue_target`, `revenue_realization`, `project_status_id`, `progress_kajian`, `progress_fisik`, `update_status`, `foto`, `crt_date`, `update_date`) VALUES
(3, 10, 1, 0, '2023-11-01', '2023-11-15', '10000', '19000000', '0', '5000000000', '4000000', 11, '35', '0', '', '1702199058page_pcr.png', '2023-12-06', '2023-12-08'),
(5, 11, 2, 0, '2023-12-11', '2024-01-30', '24000000', '0', '26000000', '0', '0', 3, '23', '45', '', '', '2023-12-11', '2023-12-11');

-- --------------------------------------------------------

--
-- Table structure for table `project_status`
--

CREATE TABLE `project_status` (
  `project_status_id` int(11) NOT NULL,
  `status_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `project_status`
--

INSERT INTO `project_status` (`project_status_id`, `status_name`) VALUES
(1, 'Belum Mulai'),
(2, 'Persiapan'),
(3, 'Perencanaan'),
(4, 'Kajian'),
(5, 'Pengadaan'),
(6, 'Kordinasi'),
(7, 'Fisik'),
(8, 'Lelang Mitra'),
(9, 'Perawatan'),
(10, 'Selesai'),
(11, 'Pending'),
(12, 'Cancel');

-- --------------------------------------------------------

--
-- Table structure for table `risk_mitigation`
--

CREATE TABLE `risk_mitigation` (
  `risk_mitigation_id` int(11) NOT NULL,
  `master_project_id` int(11) NOT NULL,
  `risk_profile` text NOT NULL,
  `mitigation` text NOT NULL,
  `checklist` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `risk_mitigation`
--

INSERT INTO `risk_mitigation` (`risk_mitigation_id`, `master_project_id`, `risk_profile`, `mitigation`, `checklist`) VALUES
(1, 1, 'Ini masalah yang cukup berat', 'Membuat', '1'),
(2, 1, 'Sangatlah berat ini koh', 'Asuransi', ''),
(4, 10, 'Nilai Kompensasi yang tidak sesuai', 'Penunjukan KJPP pembanding sebagai second opinion', '1'),
(5, 10, 'Kehilangan Pendapatan Jangka Panjang (Lahan Komersial)', 'Perjanjian anak dengan Pelindo tentang  pengembangan bisnis', ''),
(6, 10, 'Ada beberapa investor yang lahan sewanya berkurang', 'Disiapkan lahan pengganti untuk relokasi investor', '0'),
(7, 10, 'Adanya gugatan dari investor PPTI/Non PPTI', 'Dilakukan sosialisasi 1 on 1 kepada para tenant', '1'),
(8, 10, 'Citra PT KBN menjadi buruk', 'Kewajiban PT Pelindo untuk menjaga kebersihan kawasan', '1');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userid` int(11) NOT NULL,
  `full_name` varchar(115) NOT NULL,
  `nick_name` varchar(115) NOT NULL,
  `initial` text NOT NULL,
  `NIP` text NOT NULL,
  `email` varchar(115) NOT NULL,
  `address` text NOT NULL,
  `phone_number` varchar(50) NOT NULL,
  `picture` text NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userid`, `full_name`, `nick_name`, `initial`, `NIP`, `email`, `address`, `phone_number`, `picture`, `create_date`) VALUES
(4, 'abg', 'ABG', 'FAR', '20017861', 'haha@gmail.com', 'medan pekanbaru', '082233445566', '', '2023-12-03 17:40:07'),
(5, 'Benget Manahan Siregar', 'Benget', 'BMS', '20088334', 'benget@globalnet.lcl', 'Serapung', '09334455666', '', '2022-07-30 04:45:48'),
(6, 'Samsul Rizal', 'Sam', 'SRZ', '23344551', 'samsul@kerinci.lcl', 'medan', '08233445566', '', '2022-07-30 04:46:02'),
(7, 'User1', 'user satu', 'U1', '12345', 'asdf@gmail.com', 'Indonesia', '09334455666', '', '2023-12-03 17:40:19'),
(8, 'test', 'test', 'DF', '223424', 'rrr@gnnn.mm', '', '', '', '2023-12-03 18:01:01'),
(9, 'Agung', '', '', '', 'agung@gmail.com', '', '083455663355', '', '2023-12-03 18:25:35'),
(10, 'rianda', '', '', '', 'rianda@gmail.com', '', '08123345533', '', '2023-12-03 18:27:06'),
(11, 'rianda', '', '', '', 'rianda@gmail.com', '', '08123345533', '', '2023-12-03 18:27:30'),
(12, 'jihan', '', '', '', 'jihan@gmail.com', '', '083944554423', '', '2023-12-03 18:29:09'),
(13, 'ayam', '', '', '', 'ayam@gmail.com', '', '082332323232', '', '2023-12-03 18:31:16');

-- --------------------------------------------------------

--
-- Table structure for table `user_log`
--

CREATE TABLE `user_log` (
  `user_log_id` int(11) NOT NULL,
  `ip_address` varchar(50) NOT NULL,
  `jenis_aksi` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `tanggal` date NOT NULL,
  `userid` int(11) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_login`
--

CREATE TABLE `user_login` (
  `user_login_id` int(11) NOT NULL,
  `oauth_provider` varchar(15) NOT NULL,
  `oauth_uid` varchar(50) NOT NULL,
  `userid` int(11) NOT NULL,
  `username` varchar(115) NOT NULL,
  `password` varchar(115) NOT NULL,
  `link` varchar(255) NOT NULL,
  `user_role_id` int(11) NOT NULL,
  `block_status` varchar(15) NOT NULL,
  `access_status` varchar(15) NOT NULL,
  `online_status` varchar(12) DEFAULT NULL,
  `time_online` timestamp NULL DEFAULT NULL,
  `time_offline` timestamp NULL DEFAULT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_login`
--

INSERT INTO `user_login` (`user_login_id`, `oauth_provider`, `oauth_uid`, `userid`, `username`, `password`, `link`, `user_role_id`, `block_status`, `access_status`, `online_status`, `time_online`, `time_offline`, `create_date`) VALUES
(4, '', '', 4, 'penyewa', '5ebe2294ecd0e0f08eab7690d2a6ee69', '', 7, '0', '', 'offline', '2023-12-03 18:58:41', NULL, '2023-12-03 18:58:41'),
(7, '', '', 6, 'peminjam', '5ebe2294ecd0e0f08eab7690d2a6ee69', '', 9, '0', '', 'online', '2023-12-03 18:59:04', NULL, '2023-12-03 18:59:04'),
(8, '', '', 5, 'administrator', '5ebe2294ecd0e0f08eab7690d2a6ee69', '', 10, '0', '', 'online', '2023-12-10 20:43:11', NULL, '2023-12-10 20:43:11'),
(9, '', '', 8, 'agung123', '6f5d0ad4bc971cddc51a0c5f74bdf3fd', '', 7, '', '', 'offline', '2023-12-03 18:26:34', NULL, '2023-12-03 18:26:34'),
(10, '', '', 9, 'rianda', '5ebe2294ecd0e0f08eab7690d2a6ee69', '', 9, '', '', NULL, NULL, NULL, '2023-12-03 18:27:06'),
(11, '', '', 10, 'rianda', '5ebe2294ecd0e0f08eab7690d2a6ee69', '', 9, '', '', NULL, NULL, NULL, '2023-12-03 18:27:30'),
(12, '', '', 11, 'jihan123', '5ebe2294ecd0e0f08eab7690d2a6ee69', '', 10, '', '', NULL, NULL, NULL, '2023-12-03 18:29:10'),
(13, '', '', 12, 'ayam123', '5ebe2294ecd0e0f08eab7690d2a6ee69', '', 7, '', '', 'offline', '2023-12-03 18:34:44', NULL, '2023-12-03 18:34:44');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `user_role_id` int(11) NOT NULL,
  `role` text NOT NULL,
  `description` text NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`user_role_id`, `role`, `description`, `create_date`) VALUES
(7, 'penyewa', 'Yang menyewakan laptop', '2023-12-03 17:12:45'),
(9, 'peminjam', 'Yang meminjam laptop', '2023-12-03 17:12:55'),
(10, 'admin', 'yang mengapprove', '2023-12-03 17:13:04');

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_project_m_dtl`
-- (See below for the actual view)
--
CREATE TABLE `v_project_m_dtl` (
`project_m_dtl_id` int(11)
,`project_name` varchar(255)
,`project_activity` text
,`pic_project_name` varchar(255)
,`dateline` text
,`progress` varchar(45)
,`ket` text
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_project_m_hdr`
-- (See below for the actual view)
--
CREATE TABLE `v_project_m_hdr` (
`project_m_hdr_id` int(11)
,`project_name` varchar(255)
,`pic_project_name` varchar(255)
,`criteria_project_name` varchar(255)
,`start_date` date
,`end_date` date
,`duration` decimal(16,4)
,`capex_budget` varchar(255)
,`capex_realization` varchar(255)
,`contract_value` varchar(255)
,`revenue_target` varchar(255)
,`revenue_realization` varchar(255)
,`status_name` varchar(255)
,`progress_project` double
,`progress_fisik` varchar(45)
,`progress_kajian` varchar(45)
,`foto` text
,`mitigation` bigint(21)
,`checklist` bigint(21)
,`update_status` varchar(11)
);

-- --------------------------------------------------------

--
-- Structure for view `v_project_m_dtl`
--
DROP TABLE IF EXISTS `v_project_m_dtl`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_project_m_dtl`  AS SELECT `a`.`project_m_dtl_id` AS `project_m_dtl_id`, `b`.`project_name` AS `project_name`, `a`.`project_activity` AS `project_activity`, `c`.`pic_project_name` AS `pic_project_name`, `a`.`dateline` AS `dateline`, `a`.`progress` AS `progress`, `a`.`ket` AS `ket` FROM ((`project_m_dtl` `a` join `master_project` `b` on(`b`.`master_project_id` = `a`.`master_project_id`)) join `pic_project_dtl` `c` on(`c`.`pic_project_dtl_id` = `a`.`pic_project_dtl_id`)) ORDER BY `a`.`project_m_dtl_id` ASC ;

-- --------------------------------------------------------

--
-- Structure for view `v_project_m_hdr`
--
DROP TABLE IF EXISTS `v_project_m_hdr`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_project_m_hdr`  AS SELECT `a`.`project_m_hdr_id` AS `project_m_hdr_id`, `b`.`project_name` AS `project_name`, `c`.`pic_project_name` AS `pic_project_name`, `d`.`criteria_project_name` AS `criteria_project_name`, `a`.`start_date` AS `start_date`, `a`.`end_date` AS `end_date`, (select (to_days(`a`.`end_date`) - to_days(`a`.`start_date`)) / 30.436875) AS `duration`, `a`.`capex_budget` AS `capex_budget`, `a`.`capex_realization` AS `capex_realization`, `a`.`contract_value` AS `contract_value`, `a`.`revenue_target` AS `revenue_target`, `a`.`revenue_realization` AS `revenue_realization`, `e`.`status_name` AS `status_name`, (select sum(`project_m_dtl`.`progress`) / count(`project_m_dtl`.`master_project_id`) AS `progress` from `project_m_dtl` where `project_m_dtl`.`master_project_id` = `a`.`master_project_id`) AS `progress_project`, `a`.`progress_fisik` AS `progress_fisik`, `a`.`progress_kajian` AS `progress_kajian`, `a`.`foto` AS `foto`, (select count(`risk_mitigation`.`mitigation`) from `risk_mitigation` where `risk_mitigation`.`mitigation` <> '' and `risk_mitigation`.`mitigation` is not null and `risk_mitigation`.`master_project_id` = `a`.`master_project_id`) AS `mitigation`, (select count(`risk_mitigation`.`checklist`) from `risk_mitigation` where `risk_mitigation`.`checklist` <> '' and `risk_mitigation`.`checklist` is not null and `risk_mitigation`.`master_project_id` = `a`.`master_project_id`) AS `checklist`, CASE WHEN `a`.`update_date` = curdate() THEN 'Up to Date' WHEN to_days(curdate()) - to_days(`a`.`update_date`) >= 2 AND to_days(curdate()) - to_days(`a`.`update_date`) <= 7 THEN '2 - 7 Days' WHEN to_days(curdate()) - to_days(`a`.`update_date`) >= 7 AND to_days(curdate()) - to_days(`a`.`update_date`) <= 14 THEN '7 - 14 Days' WHEN to_days(curdate()) - to_days(`a`.`update_date`) > 14 THEN '> 2 Weeks ' ELSE 'Not Started' END AS `update_status` FROM ((((`project_m_hdr` `a` join `master_project` `b` on(`b`.`master_project_id` = `a`.`master_project_id`)) join `pic_project_hdr` `c` on(`c`.`pic_project_hdr_id` = `a`.`pic_project_hdr_id`)) join `criteria_project` `d` on(`d`.`criteria_project_id` = `b`.`criteria_project_id`)) join `project_status` `e` on(`e`.`project_status_id` = `a`.`project_status_id`)) ORDER BY `a`.`project_m_hdr_id` ASC ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `criteria_project`
--
ALTER TABLE `criteria_project`
  ADD PRIMARY KEY (`criteria_project_id`);

--
-- Indexes for table `issue_problem`
--
ALTER TABLE `issue_problem`
  ADD PRIMARY KEY (`issue_problem_id`);

--
-- Indexes for table `master_project`
--
ALTER TABLE `master_project`
  ADD PRIMARY KEY (`master_project_id`);

--
-- Indexes for table `pic_project_dtl`
--
ALTER TABLE `pic_project_dtl`
  ADD PRIMARY KEY (`pic_project_dtl_id`);

--
-- Indexes for table `pic_project_hdr`
--
ALTER TABLE `pic_project_hdr`
  ADD PRIMARY KEY (`pic_project_hdr_id`);

--
-- Indexes for table `project_information`
--
ALTER TABLE `project_information`
  ADD PRIMARY KEY (`project_information_id`);

--
-- Indexes for table `project_m_dtl`
--
ALTER TABLE `project_m_dtl`
  ADD PRIMARY KEY (`project_m_dtl_id`);

--
-- Indexes for table `project_m_hdr`
--
ALTER TABLE `project_m_hdr`
  ADD PRIMARY KEY (`project_m_hdr_id`);

--
-- Indexes for table `project_status`
--
ALTER TABLE `project_status`
  ADD PRIMARY KEY (`project_status_id`);

--
-- Indexes for table `risk_mitigation`
--
ALTER TABLE `risk_mitigation`
  ADD PRIMARY KEY (`risk_mitigation_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `user_log`
--
ALTER TABLE `user_log`
  ADD PRIMARY KEY (`user_log_id`);

--
-- Indexes for table `user_login`
--
ALTER TABLE `user_login`
  ADD PRIMARY KEY (`user_login_id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`user_role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `criteria_project`
--
ALTER TABLE `criteria_project`
  MODIFY `criteria_project_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `issue_problem`
--
ALTER TABLE `issue_problem`
  MODIFY `issue_problem_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `master_project`
--
ALTER TABLE `master_project`
  MODIFY `master_project_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `pic_project_dtl`
--
ALTER TABLE `pic_project_dtl`
  MODIFY `pic_project_dtl_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `pic_project_hdr`
--
ALTER TABLE `pic_project_hdr`
  MODIFY `pic_project_hdr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `project_information`
--
ALTER TABLE `project_information`
  MODIFY `project_information_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `project_m_dtl`
--
ALTER TABLE `project_m_dtl`
  MODIFY `project_m_dtl_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `project_m_hdr`
--
ALTER TABLE `project_m_hdr`
  MODIFY `project_m_hdr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `project_status`
--
ALTER TABLE `project_status`
  MODIFY `project_status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `risk_mitigation`
--
ALTER TABLE `risk_mitigation`
  MODIFY `risk_mitigation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `user_log`
--
ALTER TABLE `user_log`
  MODIFY `user_log_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_login`
--
ALTER TABLE `user_login`
  MODIFY `user_login_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `user_role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
