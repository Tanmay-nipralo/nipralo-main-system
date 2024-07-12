-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 24, 2024 at 02:23 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bigdreams_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `assets`
--

CREATE TABLE `assets` (
  `id` int(50) NOT NULL,
  `asset_name` varchar(255) DEFAULT NULL,
  `purchase_date` text DEFAULT NULL,
  `model` varchar(255) NOT NULL,
  `warrenty` varchar(255) DEFAULT NULL,
  `value` varchar(100) DEFAULT NULL,
  `asset_user` varchar(255) DEFAULT NULL,
  `created_at` timestamp(6) NULL DEFAULT NULL,
  `updated_at` timestamp(6) NULL DEFAULT NULL,
  `status` int(10) DEFAULT NULL COMMENT '1 working 2 repair'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assets`
--

INSERT INTO `assets` (`id`, `asset_name`, `purchase_date`, `model`, `warrenty`, `value`, `asset_user`, `created_at`, `updated_at`, `status`) VALUES
(19, 'Dell ', '22-01-2024', '#2334344', '5 month', '35000', '40', '2024-01-22 03:09:14.000000', '0000-00-00 00:00:00.000000', 1),
(20, 'HP', '22-01-2024', '#2334344', '12 month', '500000', '41', '2024-01-22 03:09:32.000000', '0000-00-00 00:00:00.000000', 1);

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(50) NOT NULL,
  `client_name` varchar(255) DEFAULT NULL,
  `client_mail` varchar(255) DEFAULT NULL,
  `primary_phone` int(10) DEFAULT NULL,
  `secondary_phone` int(10) DEFAULT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `company_des` text NOT NULL,
  `company_address` text DEFAULT NULL,
  `company_logo` text NOT NULL,
  `created_at` timestamp(6) NULL DEFAULT NULL,
  `updated_at` timestamp(6) NULL DEFAULT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `client_name`, `client_mail`, `primary_phone`, `secondary_phone`, `company_name`, `company_des`, `company_address`, `company_logo`, `created_at`, `updated_at`, `status`) VALUES
(1, 'Dheeraj', 'info.successhunters@gmail.com', 2147483647, 2147483647, 'TCS ninga', 'fsahl sjfk ', NULL, 'uploads/person1.png', '2023-12-29 01:34:32.000000', '2023-12-29 05:11:24.000000', 0),
(2, 'kaleem sir', 'info.successhunters@gmail.com', 1800993099, 2147483647, 'Big dreams', 'description', NULL, 'uploads/person5.png', '2023-12-29 01:36:28.000000', '2023-12-29 05:28:58.000000', 0),
(3, 'Akshay', 'info.successhunters@gmail.com', 2147483647, 1234567897, 'testimonial', 'this is description page', '1511 NEPPERHAN AVE', 'uploads/express-delivery (1).png', '2023-12-29 01:42:15.000000', '2024-01-09 02:42:14.000000', 1),
(4, 'hello', 'info.successhunters@gmail.com', 2147483647, 2147483647, 'Capitolium', 'salfw ', NULL, 'uploads/yes-2-2-m-semi-stitched-2-2-m-jwellery-dwine-sa-nd-chi-original-imag99cjhyfyybyq.webp', '2023-12-29 01:43:34.000000', '2023-12-29 05:11:05.000000', 0),
(5, 'ashok', 'info.successhunters@gmail.com', 2147483647, 2147483647, '4 rest', 'skfa f', NULL, 'uploads/facial-powders-with-nail-polish-leaf-table.jpg', '2023-12-29 02:37:34.000000', '2023-12-29 05:22:09.000000', 0),
(6, 'Gaurav Sadvelkar', 'test@gmail.com', 2147483647, 2147483647, 'Big dreams', 'this is description page', 'test ', 'uploads/RUBY-Clients-Logo-27-768x431.jpg', '2023-12-30 04:34:02.000000', '2024-01-09 02:42:22.000000', 1),
(7, 'kaleem Sir', 'kaleem@gmail.com', 1234567896, 1234567894, 'Info tech', 'technical company', NULL, 'uploads/RUBY-Clients-Logo-31-768x431.jpg', '2023-12-30 04:57:13.000000', '0000-00-00 00:00:00.000000', 0),
(8, 'Gaurav Sadvelkar', 'gua@gmail.com', 1234567897, 123456785, 'Nipraaloo', 'asfa ', NULL, 'uploads/RUBY-Clients-Logo-36-768x431.jpg', '2024-01-05 09:20:11.000000', '2024-01-05 09:20:38.000000', 0),
(9, 'Prince', '', 0, 0, '', '', '', '', '2024-01-09 02:21:45.000000', '0000-00-00 00:00:00.000000', 0),
(10, 'The Prince', 'prince@gmail.com', 2147483647, 1234567894, 'Dream World', 'prince@gmail.com', 'A-wing Airoli  20', 'uploads/RUBY-Clients-Logo-40-768x431.jpg', '2024-01-09 02:22:43.000000', '2024-01-09 02:39:19.000000', 1),
(11, 'Abhishek Shukla', 'abhishek@gmail.com', 2147483647, 2147483647, 'Abhiskek', 'Classes ', 'A-11 B-Wing airoli', 'uploads/RUBY-Clients-Logo-35-768x431.jpg', '2024-01-09 02:40:56.000000', '0000-00-00 00:00:00.000000', 1),
(12, 'MK BHD', 'mk@gmail.com', 2147483647, 2147483647, 'BHD', 'Youtube chanel ', 'Youtube channel', 'uploads/jain-temple.jpg', '2024-01-11 08:17:55.000000', '0000-00-00 00:00:00.000000', 1);

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `department_name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `department_name`, `created_at`, `updated_at`, `status`) VALUES
(4, 'Sensory', '2023-12-27 01:15:14', '2023-12-28 03:06:18', 0),
(19, 'developer', '2023-12-28 23:50:26', '2023-12-29 03:40:51', 0),
(20, 'technical team', '2023-12-28 23:51:12', '2023-12-28 23:58:28', 0),
(21, 'Executive ', '2023-12-28 23:52:43', '0000-00-00 00:00:00', 0),
(22, 'Business Analyst', '2023-12-29 08:31:46', '0000-00-00 00:00:00', 1),
(23, ' Tester', '2023-12-29 08:32:02', '2023-12-29 08:32:14', 1),
(24, 'Developer', '2023-12-29 08:32:32', '0000-00-00 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `designations`
--

CREATE TABLE `designations` (
  `id` int(50) NOT NULL,
  `department_name` varchar(255) DEFAULT NULL,
  `designation` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `designations`
--

INSERT INTO `designations` (`id`, `department_name`, `designation`, `created_at`, `updated_at`, `status`) VALUES
(15, 'technical team', 'Developer', '2023-12-29 00:01:49', '0000-00-00 00:00:00', 0),
(16, 'developer', 'Web developer', '2023-12-29 00:33:17', '2023-12-29 03:41:11', 0),
(17, 'Developer', 'front-end Developer', '2023-12-29 08:33:09', '0000-00-00 00:00:00', 1),
(18, 'Business Analyst', 'Backend developer', '2023-12-29 08:34:44', '2024-01-23 07:16:02', 1);

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` int(11) NOT NULL,
  `project_id` int(11) DEFAULT NULL,
  `document_name` varchar(250) DEFAULT NULL,
  `document_description` text DEFAULT NULL,
  `file_path` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`id`, `project_id`, `document_name`, `document_description`, `file_path`, `created_at`, `updated_at`) VALUES
(13, 13, 'Layout design', 'sdfa', 'uploads/RUBY-Clients-Logo-34-768x431.jpg', '2024-01-09 08:43:57', '0000-00-00 00:00:00'),
(15, 16, 'page layout', 'fasdfa', 'uploads/RUBY-Clients-Logo-27-768x431.jpg', '2024-01-09 08:44:44', '0000-00-00 00:00:00'),
(16, 16, 'Home page', 'this is description', 'uploads/RUBY-Clients-Logo-35-768x431.jpg', '2024-01-09 08:52:52', '0000-00-00 00:00:00'),
(17, 13, 'page layout', 'rtgaesf', 'uploads/RUBY-Clients-Logo-34-768x431.jpg', '2024-01-09 08:57:48', '0000-00-00 00:00:00'),
(18, 19, 'sdf', 'ssdfas', 'uploads/sondai.jpg', '2024-01-11 00:54:55', '0000-00-00 00:00:00'),
(19, 24, 'Layout design', 'j', 'uploads/About us  option 2.docx', '2024-01-23 01:15:54', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `employee_id` varchar(50) DEFAULT NULL,
  `employee_type` varchar(100) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `mail` varchar(25) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `joining_date` text DEFAULT NULL,
  `phone` int(10) DEFAULT NULL,
  `department` varchar(255) DEFAULT NULL,
  `designation` varchar(255) DEFAULT NULL,
  `photo` text DEFAULT NULL,
  `address` text DEFAULT NULL,
  `birth_date` text DEFAULT NULL,
  `gender` text DEFAULT NULL,
  `bank_name` varchar(255) DEFAULT NULL,
  `account_no` varchar(255) DEFAULT NULL,
  `ifsc_code` varchar(255) DEFAULT NULL,
  `pan_no` varchar(255) DEFAULT NULL,
  `created_at` timestamp(6) NULL DEFAULT NULL,
  `updated_at` timestamp(6) NULL DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `employee_id`, `employee_type`, `first_name`, `last_name`, `mail`, `password`, `joining_date`, `phone`, `department`, `designation`, `photo`, `address`, `birth_date`, `gender`, `bank_name`, `account_no`, `ifsc_code`, `pan_no`, `created_at`, `updated_at`, `status`) VALUES
(39, NULL, 'Admin', 'Rayan', 'helmander', 'rayan@gmail.com', '$2y$10$5NBSV9He1bIDguRiogN.5u./F0dYhYt6ZhJ3LJRxYdDoi4mMN2QjK', '10-01-2024', 1234567894, '23', '17', 'uploads/RUBY-Clients-Logo-43-768x431.jpg', 'A-wing 45 Airoli ', '26-01-2024', 'female', 'BOB', '1223336448899', 'SADFJP45', 'ABCDFREEWOPD', '2024-01-10 06:05:05.000000', '2024-01-22 07:45:25.000000', 1),
(40, NULL, 'Employee', 'Anurag', 'shukla', 'anurag@gmail.com', '$2y$10$VOq83d4voexPOKIuZzqx.uOdPLRMm2aKx8q/dbLT/qY9v21ESCW3K', '10-01-2024', 2147483647, '22', '17', 'uploads/RUBY-Clients-Logo-28-768x431.jpg', 'Ghansoli ', '12-01-2024', 'male', 'Union Bank', '12345678934', 'ADGC123', 'ARFTY23FE90', '2024-01-10 08:11:55.000000', '2024-01-22 07:47:14.000000', 1),
(41, NULL, 'Admin', 'Gaurav', 'Singh', 'gaurav@gmail.com', '$2y$10$xxKkrCaUFaW/eoFOD5Dr2.v81.rZp897jMlkGVf6eKzi4gOCVOzee', '11-01-2024', 2147483647, '24', '17', 'uploads/RUBY-Clients-Logo-37-768x431.jpg', NULL, NULL, NULL, 'SBI', '1223336448899', 'ADGC123', 'ABCDFREEWOPD', '2024-01-11 00:18:41.000000', '2024-01-22 07:46:33.000000', 1),
(42, NULL, 'Employee', 'Prince', 'Yadav', 'prince@gmail.com', '$2y$10$HoEmJ.2kd3.BGEIVbzzXROpXUEJIWLjWhghSz3bS91OXstfrVCfaK', '13-01-2024', 2147483647, '22', '18', 'uploads/ulhas-vally.jpg', '', '26-01-2024', 'male', 'MUMBAI', '1223336448899', 'ADGC123', 'ABCDFREEWOPD', '2024-01-13 02:20:55.000000', '2024-01-23 07:49:44.000000', 1),
(43, NULL, 'Admin', 'Kaleem', 'Sir', 'kaleem@gmail.com', '$2y$10$oqMR/bGUMdWSl06x3nA.yOOzKilaE76ASE71eJ1cQaAM6B2wzAavO', '22-01-2024', 234567892, '22', '17', 'uploads/abt-ban-01.jpg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2024-01-22 02:31:29.000000', '2024-01-22 02:58:47.000000', 1),
(44, NULL, 'Employee', 'Akshay', 'Khabale', 'akshay.k@nipraalo.com', '$2y$10$noGGpl.DtYJ66L67QwF6bO9moE7XfIWx2VIwtUWW8XNXKzT.6nXGC', '31-01-2023', 2147483647, '23', '17', 'uploads/2f539befb8_11zon.jpg', '', '', 'male', NULL, NULL, NULL, NULL, '2024-01-22 16:42:50.000000', '2024-01-22 16:43:28.000000', 1);

-- --------------------------------------------------------

--
-- Table structure for table `emp_salary`
--

CREATE TABLE `emp_salary` (
  `id` int(20) NOT NULL,
  `client_id` int(20) NOT NULL,
  `salary_amount` varchar(255) DEFAULT NULL,
  `payment_type` varchar(100) DEFAULT NULL,
  `pf_contribution` varchar(20) DEFAULT NULL,
  `pf` varchar(25) DEFAULT NULL,
  `pf_no` varchar(100) DEFAULT NULL,
  `employee_pf_rate` varchar(20) DEFAULT NULL,
  `employer_pf_rate` varchar(20) DEFAULT NULL,
  `esi_contribution` varchar(20) DEFAULT NULL,
  `esi` varchar(20) DEFAULT NULL,
  `esi_no` varchar(100) DEFAULT NULL,
  `employee_esi_rate` varchar(20) DEFAULT NULL,
  `employer_esi_rate` varchar(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `update_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `emp_salary`
--

INSERT INTO `emp_salary` (`id`, `client_id`, `salary_amount`, `payment_type`, `pf_contribution`, `pf`, `pf_no`, `employee_pf_rate`, `employer_pf_rate`, `esi_contribution`, `esi`, `esi_no`, `employee_esi_rate`, `employer_esi_rate`, `created_at`, `update_at`) VALUES
(1, 40, '8000', 'Cash', 'Yes', 'Yes', 'AScfdf55523df', '1%', '3%', 'Yes', 'Yes', '$sdjfhad h54fs', '2%', '1%', '2024-01-11 03:08:26', '2024-01-11 06:22:44'),
(2, 0, '6000', 'Bank transfer', 'Yes', 'Yes', 'AScfdf55523df', '1%', '3%', 'Yes', 'Yes', '$sdjfhad h54fs', '1%', '3%', '2024-01-11 06:17:51', NULL),
(3, 39, '15000', 'Bank transfer', 'Yes', 'Select PF contribution', 'AScfdf55523df', '2%', '0%', 'Yes', 'Select ESI contribut', '$sdjfhad h54fs', '3%', '3%', '2024-01-11 06:25:22', '2024-01-11 06:54:54'),
(4, 41, '18000', 'Bank transfer', 'Yes', 'Yes', 'AScfdf55523df', '3%', '2%', 'Yes', 'Yes', '#45psarince', '2%', '4%', '2024-01-11 06:55:45', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(10) NOT NULL,
  `event_name` varchar(255) DEFAULT NULL,
  `event_date` varchar(20) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `created_at` timestamp(6) NULL DEFAULT NULL,
  `updated_at` timestamp(6) NULL DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `holiday`
--

CREATE TABLE `holiday` (
  `id` int(11) NOT NULL,
  `holiday_name` varchar(255) DEFAULT NULL,
  `holiday_date` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `holiday`
--

INSERT INTO `holiday` (`id`, `holiday_name`, `holiday_date`, `created_at`, `updated_at`, `status`) VALUES
(4, 'New Year', '30-12-2023', '2023-12-30 00:52:36', '2023-12-30 01:44:06', 0),
(5, 'Merry Chrishmas', '29-12-2023', '2023-12-30 01:39:49', '2023-12-30 01:43:16', 1),
(6, 'Bakrid', '31-12-2023', '2023-12-30 01:54:09', '0000-00-00 00:00:00', 0),
(7, 'New Year', '05-01-2024', '2024-01-04 00:16:27', '0000-00-00 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` int(50) NOT NULL,
  `project_name` varchar(250) DEFAULT NULL,
  `client_id` text DEFAULT NULL,
  `start_date` varchar(25) DEFAULT NULL,
  `end_date` varchar(25) DEFAULT NULL,
  `rate_value` varchar(250) DEFAULT NULL,
  `rate_type` varchar(250) DEFAULT NULL,
  `priority` varchar(255) DEFAULT NULL,
  `project_leader` text DEFAULT NULL,
  `team_member` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `project_document` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `update_at` timestamp NULL DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `project_category` varchar(255) NOT NULL,
  `project_status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `project_name`, `client_id`, `start_date`, `end_date`, `rate_value`, `rate_type`, `priority`, `project_leader`, `team_member`, `description`, `project_document`, `created_at`, `update_at`, `status`, `project_category`, `project_status`) VALUES
(19, 'CRM', '3', '10-01-2024', '24-01-2024', '4500', 'Fixed', 'High', '[{\"id\":\"39\",\"name\":\"Rayan\",\"status\":\"1\",\"role\":\"Admin\"}]', '[{\"id\":\"41\",\"name\":\"Gaurav\",\"status\":\"1\",\"role\":\"Admin\"},{\"id\":\"39\",\"name\":\"Rayan\",\"status\":\"1\",\"role\":\"Admin\"},{\"id\":\"40\",\"name\":\"Anurag\",\"status\":\"1\",\"role\":\"Employee\"}]', 'hig sfja  dsfap sdfps sdjf asef dfjapsf sdfj esfiap dklfjaspf aksdfjasof asdfjaspf ', 'uploads/RUBY-Clients-Logo-36-768x431.jpg', '0000-00-00 00:00:00', '2024-01-23 01:59:36', 1, 'App', 'Completed Projects'),
(20, 'Local Project', '8', '11-01-2024', '27-01-2024', '9000', 'Fixed', 'High', '[{\"id\":\"40\",\"name\":\"Anurag\",\"status\":\"1\",\"role\":\"Employee\"}]', '[{\"id\":\"41\",\"name\":\"Gaurav\",\"status\":\"1\",\"role\":\"Employee\"},{\"id\":\"39\",\"name\":\"Rayan\",\"status\":\"1\",\"role\":\"Select Role\"}]', 'this is descirption of projects', 'uploads/sondai.jpg', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'App', 'Outgoing Projects'),
(21, 'Pulperoo', '8', '13-01-2024', '27-01-2024', '52', 'Fixed', 'High', '[{\"id\":\"40\",\"name\":\"Anurag\",\"status\":\"1\",\"role\":\"Employee\"}]', '[{\"id\":\"41\",\"name\":\"Gaurav\",\"status\":\"1\",\"role\":\"Employee\"},{\"id\":\"39\",\"name\":\"Rayan\",\"status\":\"1\",\"role\":\"Select Role\"}]', 'this is project database ', 'uploads/jain-temple.jpg', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'App', 'Completed Projects'),
(22, 'Gold mines', '8', '13-01-2024', '27-01-2024', '5000', 'Fixed', 'Low', '[{\"id\":\"39\",\"name\":\"Rayan\",\"status\":\"1\",\"role\":\"Select Role\"}]', '[{\"id\":\"40\",\"name\":\"Anurag\",\"status\":\"1\",\"role\":\"Employee\"},{\"id\":\"39\",\"name\":\"Rayan\",\"status\":\"1\",\"role\":\"Select Role\"}]', 'fsdd', 'uploads/sondai.jpg', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'App', 'Outgoing Projects'),
(23, 'Fastrack', '6', '13-01-2024', '27-01-2024', '500', 'Hourly', 'Medium', '[{\"id\":\"41\",\"name\":\"Gaurav\",\"status\":\"1\",\"role\":\"Employee\"}]', '[{\"id\":\"40\",\"name\":\"Anurag\",\"status\":\"1\",\"role\":\"Employee\"},{\"id\":\"39\",\"name\":\"Rayan\",\"status\":\"1\",\"role\":\"Select Role\"}]', 'fastrack is good no. company in world ', 'uploads/bahiri caves.jpg', '0000-00-00 00:00:00', NULL, 1, 'Website', 'Hold Projects'),
(24, 'asdad', '3', '23-01-2024', '19-01-2024', '44', 'Hourly', 'High', '[{\"id\":\"44\",\"name\":\"Akshay\",\"status\":\"1\",\"role\":\"Employee\"}]', '[{\"id\":\"40\",\"name\":\"Anurag\",\"status\":\"1\",\"role\":\"Employee\"},{\"id\":\"44\",\"name\":\"Akshay\",\"status\":\"1\",\"role\":\"Employee\"}]', '', NULL, '2024-01-22 17:10:00', '2024-01-23 01:17:57', 1, 'Website', 'Outgoing Projects');

-- --------------------------------------------------------

--
-- Table structure for table `project_subtask`
--

CREATE TABLE `project_subtask` (
  `id` int(11) NOT NULL,
  `project_id` int(20) DEFAULT NULL,
  `task_id` int(11) NOT NULL,
  `tittle` varchar(255) DEFAULT NULL,
  `assign_by` varchar(255) DEFAULT NULL,
  `assign_to` varchar(255) NOT NULL,
  `start_date` text NOT NULL,
  `end_date` text NOT NULL,
  `time_period` varchar(255) DEFAULT NULL,
  `priority` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `subtask_status` text DEFAULT NULL COMMENT '1 for commpleted and 0 for pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `project_subtask`
--

INSERT INTO `project_subtask` (`id`, `project_id`, `task_id`, `tittle`, `assign_by`, `assign_to`, `start_date`, `end_date`, `time_period`, `priority`, `description`, `subtask_status`, `created_at`, `updated_at`) VALUES
(31, 19, 20, 'design', '[{\"id\":\"39\",\"name\":\"Rayan\",\"status\":\"1\",\"role\":\"Admin\"}]', '[{\"id\":\"41\",\"name\":\"Gaurav\",\"status\":\"1\",\"role\":\"Admin\"}]', '21-01-2024', '23-01-2024', '2 Week', 'Medium', 'dsfa', '1', '2024-01-20 23:34:36', '2024-01-20 23:39:07'),
(33, 19, 20, 'header task', '[{\"id\":\"39\",\"name\":\"Rayan\",\"status\":\"1\",\"role\":\"Admin\"}]', '[{\"id\":\"41\",\"name\":\"Gaurav\",\"status\":\"1\",\"role\":\"Admin\"}]', '21-01-2024', '23-01-2024', '1 Month', 'Medium', 'safkf', '1', '2024-01-21 02:49:41', '2024-01-22 01:23:41'),
(34, 19, 19, 'Design Part', '[{\"id\":\"39\",\"name\":\"Rayan\",\"status\":\"1\",\"role\":\"Admin\"}]', '[{\"id\":\"40\",\"name\":\"Anurag\",\"status\":\"1\",\"role\":\"Employee\"}]', '03-01-2024', '01-02-2024', '1 Week', 'Low', 'xcv', '1', '2024-01-22 00:29:17', '2024-01-23 01:59:47'),
(35, 19, 19, 'Div section', '[{\"id\":\"39\",\"name\":\"Rayan\",\"status\":\"1\",\"role\":\"Admin\"}]', '[{\"id\":\"41\",\"name\":\"Gaurav\",\"status\":\"1\",\"role\":\"Admin\"}]', '22-01-2024', '18-01-2024', '2 Week', 'High', 'dsfad', '0', '2024-01-22 00:56:29', '2024-01-22 01:13:54'),
(36, 22, 22, 'Footer Page', '[{\"id\":\"39\",\"name\":\"Rayan\",\"status\":\"1\",\"role\":\"Admin\"}]', '[{\"id\":\"40\",\"name\":\"Anurag\",\"status\":\"1\",\"role\":\"Employee\"}]', '23-01-2024', '22-01-2024', '2 Week', 'High', 'sdfas', '1', '2024-01-22 07:48:52', '0000-00-00 00:00:00'),
(37, 24, 24, 'Footer Page', '[{\"id\":\"44\",\"name\":\"Akshay\",\"status\":\"1\",\"role\":\"Employee\"}]', '[{\"id\":\"44\",\"name\":\"Akshay\",\"status\":\"1\",\"role\":\"Employee\"}]', '11-01-2024', '17-01-2024', '2 Week', 'Medium', 'k', '0', '2024-01-23 01:16:57', '2024-01-23 06:50:10');

-- --------------------------------------------------------

--
-- Table structure for table `project_task`
--

CREATE TABLE `project_task` (
  `id` int(20) NOT NULL,
  `project_id` int(20) DEFAULT NULL,
  `tittle` varchar(255) DEFAULT NULL,
  `priority` text NOT NULL,
  `description` text NOT NULL,
  `assign_by` varchar(255) DEFAULT NULL,
  `assign_to` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `start_date` text NOT NULL,
  `end_date` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `project_task`
--

INSERT INTO `project_task` (`id`, `project_id`, `tittle`, `priority`, `description`, `assign_by`, `assign_to`, `created_at`, `updated_at`, `start_date`, `end_date`) VALUES
(19, 19, 'footer', 'Low', 'hello', '[{\"id\":\"39\",\"name\":\"Rayan\",\"status\":\"1\",\"role\":\"Admin\"}]', '[{\"id\":\"41\",\"name\":\"Gaurav\",\"status\":\"1\",\"role\":\"Admin\"}]', '2024-01-19 06:16:59', '2024-01-20 22:44:47', '26-01-2024', '30-01-2024'),
(20, 19, 'Design Part', 'Medium', 'sdfa', '[{\"id\":\"39\",\"name\":\"Rayan\",\"status\":\"1\",\"role\":\"Admin\"}]', '[{\"id\":\"41\",\"name\":\"Gaurav\",\"status\":\"1\",\"role\":\"Admin\"}]', '2024-01-19 06:19:20', '0000-00-00 00:00:00', '25-01-2024', '26-01-2024'),
(21, 20, 'Design Part', 'Medium', 'dfs', '[{\"id\":\"40\",\"name\":\"Anurag\",\"status\":\"1\",\"role\":\"Employee\"}]', '[{\"id\":\"39\",\"name\":\"Rayan\",\"status\":\"1\",\"role\":\"Admin\"}]', '2024-01-19 08:17:18', '0000-00-00 00:00:00', '19-01-2024', '25-01-2024'),
(22, 22, 'Design Part', 'Medium', 'dsfa', '[{\"id\":\"39\",\"name\":\"Rayan\",\"status\":\"1\",\"role\":\"Admin\"}]', '[{\"id\":\"40\",\"name\":\"Anurag\",\"status\":\"1\",\"role\":\"Employee\"}]', '2024-01-22 07:48:33', '0000-00-00 00:00:00', '22-01-2024', '25-01-2024'),
(23, 22, 'Footer Page', 'Medium', 'fsda', '[{\"id\":\"39\",\"name\":\"Rayan\",\"status\":\"1\",\"role\":\"Admin\"}]', '[{\"id\":\"40\",\"name\":\"Anurag\",\"status\":\"1\",\"role\":\"Employee\"}]', '2024-01-22 08:18:50', '0000-00-00 00:00:00', '10-01-2024', '23-01-2024'),
(24, 24, 'Design Part', 'Low', 'h', '[{\"id\":\"44\",\"name\":\"Akshay\",\"status\":\"1\",\"role\":\"Employee\"}]', '[{\"id\":\"40\",\"name\":\"Anurag\",\"status\":\"1\",\"role\":\"Employee\"}]', '2024-01-23 01:16:27', '0000-00-00 00:00:00', '24-01-2024', '25-01-2024');

-- --------------------------------------------------------

--
-- Table structure for table `salary`
--

CREATE TABLE `salary` (
  `id` int(50) NOT NULL,
  `employee_id` varchar(50) DEFAULT NULL,
  `net_salary` int(255) DEFAULT NULL,
  `basic_salary` int(255) DEFAULT NULL,
  `tds` varchar(255) DEFAULT NULL,
  `da` varchar(255) DEFAULT NULL,
  `esi` varchar(255) DEFAULT NULL,
  `hra` varchar(255) DEFAULT NULL,
  `pf` varchar(255) DEFAULT NULL,
  `conveyance` varchar(255) DEFAULT NULL,
  `leave` varchar(255) DEFAULT NULL,
  `allowance` varchar(255) DEFAULT NULL,
  `prof_tax` varchar(255) DEFAULT NULL,
  `medical_allowance` varchar(255) DEFAULT NULL,
  `labour_welfare` varchar(255) DEFAULT NULL,
  `other` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assets`
--
ALTER TABLE `assets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `designations`
--
ALTER TABLE `designations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emp_salary`
--
ALTER TABLE `emp_salary`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `holiday`
--
ALTER TABLE `holiday`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_subtask`
--
ALTER TABLE `project_subtask`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_task`
--
ALTER TABLE `project_task`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `salary`
--
ALTER TABLE `salary`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assets`
--
ALTER TABLE `assets`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `designations`
--
ALTER TABLE `designations`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `emp_salary`
--
ALTER TABLE `emp_salary`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `holiday`
--
ALTER TABLE `holiday`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `project_subtask`
--
ALTER TABLE `project_subtask`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `project_task`
--
ALTER TABLE `project_task`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `salary`
--
ALTER TABLE `salary`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
