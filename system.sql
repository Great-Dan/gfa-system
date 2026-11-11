-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 10, 2026 at 02:31 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `system`
--

-- --------------------------------------------------------

--
-- Table structure for table `backups`
--

CREATE TABLE `backups` (
  `id` int(11) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `executives`
--

CREATE TABLE `executives` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `role` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `executives`
--

INSERT INTO `executives` (`id`, `name`, `role`, `created_at`) VALUES
(1, 'Nana Akuffo Addo', 'Flagbearrer', '2026-10-10 00:15:05');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `dob` date DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `name`, `dob`, `age`, `active`, `created_at`) VALUES
(1, 'Joan Laporta', '1962-06-29', 64, 1, '2026-10-10 00:15:39');

-- --------------------------------------------------------

--
-- Table structure for table `players`
--

CREATE TABLE `players` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `dob` date DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `players`
--

INSERT INTO `players` (`id`, `name`, `dob`, `age`, `created_at`) VALUES
(1, 'Lamine Yamal', '2007-07-13', 19, '2026-10-10 00:16:03');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'admin'),
(3, 'captain'),
(2, 'president');

-- --------------------------------------------------------

--
-- Table structure for table `two_factor_codes`
--

CREATE TABLE `two_factor_codes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `code_hash` varchar(255) NOT NULL,
  `expires_at` datetime NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `two_factor_codes`
--

INSERT INTO `two_factor_codes` (`id`, `user_id`, `code_hash`, `expires_at`, `created_at`) VALUES
(1, 2, '$2y$10$FeVH5gWkM6rfVtCPDPClW.D28nzid3euExC2z1Pv/Vq1ZY.Hz5ZAy', '2026-10-10 02:07:14', '2026-10-10 00:02:14'),
(2, 2, '$2y$10$zgxoYcncIoWiEHPfQ6wsyOx6aNpzkXSK.4qLj7sRba8bDv4Bl55M6', '2026-10-10 02:10:29', '2026-10-10 00:05:29'),
(3, 2, '$2y$10$3x47QzJDl10e0EoP42mYpONRNZIaKMbEDgO1qleIVs/NGdz6gFp5u', '2026-10-10 02:11:34', '2026-10-10 00:06:34'),
(4, 2, '$2y$10$3cZsYgUp/Kw/n/vijR4DV.VmARWSgVz0nBtm8YVY09qp.UHkmpNkW', '2026-10-10 02:12:00', '2026-10-10 00:07:00'),
(5, 1, '$2y$10$558pJ2nhjf/zjNfx7rIgH.MlFvnInOmyFRQkT/4SEZgN5BntMvs3i', '2026-10-10 02:13:13', '2026-10-10 00:08:13'),
(6, 3, '$2y$10$OXURoMJgkPSh4SYN4cAILu68urNXZJni9/zIYikK6HZonkugD9o16', '2026-10-10 02:16:04', '2026-10-10 00:11:04'),
(7, 1, '$2y$10$dG7RWd.m8vSHqdYwu90DTe8boBFvLsLFTkCHyz9P3pQWAQIZJms1O', '2026-10-10 02:16:59', '2026-10-10 00:11:59'),
(8, 3, '$2y$10$X0FcXL9PotyDHj1JCPAqCu8FHtiabZdp5cwpWYX/bJ6a/W28rTTKe', '2026-10-10 02:21:14', '2026-10-10 00:16:14'),
(9, 1, '$2y$10$wrImiC01pBekmIBtK5uLDuCOpBWtLDtQ6pQ5dIwMrTWvrP/zlUZWy', '2026-10-10 02:26:27', '2026-10-10 00:21:27');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(200) DEFAULT NULL,
  `role_id` int(11) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `salt` varchar(64) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `role_id`, `password_hash`, `salt`, `created_at`) VALUES
(1, 'admin', 'admin@gfa.local', 1, '$argon2id$v=19$m=65536,t=4,p=1$dXBKLzdQbzk4Z1RGelJidA$Iea6MgqrIQf9ZEn8qsCHkY/Q3w+vAVUo/GF7VXYTWK8', '4ea22e14e1ba48f22edcbf4bd05b0cd6', '2026-10-10 00:00:50'),
(2, 'president', 'president@gfa.local', 2, '$argon2id$v=19$m=65536,t=4,p=1$SzE5SFB6LkM0ODFiQ3R1ag$ulyZbqt1xmQhQmKdQFa9NWQ/wyzkkQSul63QPw7LZmw', 'ffa94466c9c53b89b6543b9ecacf2fd7', '2026-10-10 00:00:50'),
(3, 'captain', 'captain@gfa.local', 3, '$argon2id$v=19$m=65536,t=4,p=1$U2VyTldPeEFUREdGTzRRTg$b9O9n+pb/TO+uYD/EGPaHVjdPqxEQzk7zqr6B8qCx+U', 'f954f61622315c299a3cd78acd049491', '2026-10-10 00:00:50');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `backups`
--
ALTER TABLE `backups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `executives`
--
ALTER TABLE `executives`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_members_active` (`active`);

--
-- Indexes for table `players`
--
ALTER TABLE `players`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `two_factor_codes`
--
ALTER TABLE `two_factor_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `backups`
--
ALTER TABLE `backups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `executives`
--
ALTER TABLE `executives`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `players`
--
ALTER TABLE `players`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `two_factor_codes`
--
ALTER TABLE `two_factor_codes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `two_factor_codes`
--
ALTER TABLE `two_factor_codes`
  ADD CONSTRAINT `two_factor_codes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
