-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2023 at 10:36 AM
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
(1, 'Kerjasama NPEA', 1, 'This is for the NPEA Projects'),
(2, 'Imbreng Aset PT.KCN', 2, 'This is project Imbreng');

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
(7, 'KEU');

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
(4, 'KOMERSIL');

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
  `kind_of_consultant` enum('Consultant','Mitra') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `project_information`
--

INSERT INTO `project_information` (`project_information_id`, `master_project_id`, `consultant_name`, `contract_price`, `termyn_value`, `payed`, `kind_of_consultant`) VALUES
(1, 1, 'Nama Konsultan 1', '1000000', 3, '200000', 'Mitra'),
(2, 1, 'Nama Konsultan 2', '2000000', 3, '200000', 'Consultant');

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
(1, 1, 'Pengajuan Anggaran', 5, '2023-12-03', '100', ''),
(2, 1, 'Penyusunan KAK', 2, '2023-11-03', '50', 'test'),
(3, 1, 'test ahgha', 1, '2023-12-03', '60', 'testtt');

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
  `capex_budget` varchar(255) NOT NULL,
  `capex_realization` varchar(255) NOT NULL,
  `revenue_target` varchar(255) NOT NULL,
  `revenue_realization` varchar(255) NOT NULL,
  `project_status_id` int(11) NOT NULL,
  `progress` varchar(45) NOT NULL,
  `update_status` text NOT NULL,
  `crt_date` date DEFAULT NULL,
  `update_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `project_m_hdr`
--

INSERT INTO `project_m_hdr` (`project_m_hdr_id`, `master_project_id`, `pic_project_hdr_id`, `criteria_project_id`, `start_date`, `end_date`, `capex_budget`, `capex_realization`, `revenue_target`, `revenue_realization`, `project_status_id`, `progress`, `update_status`, `crt_date`, `update_date`) VALUES
(1, 1, 2, 2, '2023-10-01', '2023-11-30', '4000000', '3000000', '2000000', '1500000', 2, 'diambil dari totalan', '', '2023-12-03', '2023-11-12');

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
(1, 1, 'Ini masalah yang cukup berat', 'Membuat', 'Disetujui'),
(2, 1, 'Sangatlah berat ini koh', 'Asuransi', '');

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
,`duration` int(6)
,`capex_budget` varchar(255)
,`capex_realization` varchar(255)
,`revenue_target` varchar(255)
,`revenue_realization` varchar(255)
,`status_name` varchar(255)
,`progress` double
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

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_project_m_hdr`  AS SELECT `a`.`project_m_hdr_id` AS `project_m_hdr_id`, `b`.`project_name` AS `project_name`, `c`.`pic_project_name` AS `pic_project_name`, `d`.`criteria_project_name` AS `criteria_project_name`, `a`.`start_date` AS `start_date`, `a`.`end_date` AS `end_date`, period_diff(extract(year_month from `a`.`end_date`),extract(year_month from `a`.`start_date`)) AS `duration`, `a`.`capex_budget` AS `capex_budget`, `a`.`capex_realization` AS `capex_realization`, `a`.`revenue_target` AS `revenue_target`, `a`.`revenue_realization` AS `revenue_realization`, `e`.`status_name` AS `status_name`, (select sum(`project_m_dtl`.`progress`) / count(`project_m_dtl`.`master_project_id`) AS `progress` from `project_m_dtl` where `project_m_dtl`.`master_project_id` = `a`.`master_project_id`) AS `progress`, (select count(`risk_mitigation`.`mitigation`) from `risk_mitigation` where `risk_mitigation`.`mitigation` <> '' and `risk_mitigation`.`mitigation` is not null and `risk_mitigation`.`master_project_id` = `a`.`master_project_id`) AS `mitigation`, (select count(`risk_mitigation`.`checklist`) from `risk_mitigation` where `risk_mitigation`.`checklist` <> '' and `risk_mitigation`.`checklist` is not null and `risk_mitigation`.`master_project_id` = `a`.`master_project_id`) AS `checklist`, CASE WHEN `a`.`update_date` = curdate() THEN 'Up to Date' WHEN to_days(curdate()) - to_days(`a`.`update_date`) >= 2 AND to_days(curdate()) - to_days(`a`.`update_date`) <= 7 THEN '2 - 7 Days' WHEN to_days(curdate()) - to_days(`a`.`update_date`) >= 7 AND to_days(curdate()) - to_days(`a`.`update_date`) <= 14 THEN '7 - 14 Days' WHEN to_days(curdate()) - to_days(`a`.`update_date`) > 14 THEN '> 2 Weeks ' ELSE 'Not Started' END AS `update_status` FROM ((((`project_m_hdr` `a` join `master_project` `b` on(`b`.`master_project_id` = `a`.`master_project_id`)) join `pic_project_hdr` `c` on(`c`.`pic_project_hdr_id` = `a`.`pic_project_hdr_id`)) join `criteria_project` `d` on(`d`.`criteria_project_id` = `a`.`criteria_project_id`)) join `project_status` `e` on(`e`.`project_status_id` = `a`.`project_status_id`)) ORDER BY `a`.`project_m_hdr_id` ASC ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `criteria_project`
--
ALTER TABLE `criteria_project`
  ADD PRIMARY KEY (`criteria_project_id`);

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `criteria_project`
--
ALTER TABLE `criteria_project`
  MODIFY `criteria_project_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `master_project`
--
ALTER TABLE `master_project`
  MODIFY `master_project_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `pic_project_dtl`
--
ALTER TABLE `pic_project_dtl`
  MODIFY `pic_project_dtl_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pic_project_hdr`
--
ALTER TABLE `pic_project_hdr`
  MODIFY `pic_project_hdr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `project_information`
--
ALTER TABLE `project_information`
  MODIFY `project_information_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `project_m_dtl`
--
ALTER TABLE `project_m_dtl`
  MODIFY `project_m_dtl_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `project_m_hdr`
--
ALTER TABLE `project_m_hdr`
  MODIFY `project_m_hdr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `project_status`
--
ALTER TABLE `project_status`
  MODIFY `project_status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `risk_mitigation`
--
ALTER TABLE `risk_mitigation`
  MODIFY `risk_mitigation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
