-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Cze 13, 2024 at 10:49 PM
-- Wersja serwera: 10.4.32-MariaDB
-- Wersja PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `4tp_1-projektphp`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `applications`
--

CREATE TABLE `applications` (
  `application_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `job_offer_id` int(11) NOT NULL,
  `application_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `applications`
--

INSERT INTO `applications` (`application_id`, `user_id`, `job_offer_id`, `application_date`) VALUES
(4, 14, 9, '2024-06-13');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `category`
--

CREATE TABLE `category` (
  `category_id` smallint(5) UNSIGNED NOT NULL,
  `category_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`) VALUES
(1, 'Category 1'),
(2, 'Category 2');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `company`
--

CREATE TABLE `company` (
  `company_id` smallint(5) UNSIGNED NOT NULL,
  `company_name` tinytext NOT NULL,
  `company_login` text NOT NULL,
  `company_password` text NOT NULL,
  `city` tinytext DEFAULT NULL,
  `street` tinytext DEFAULT NULL,
  `street_number` tinyint(4) DEFAULT NULL,
  `longtitude` decimal(15,10) DEFAULT NULL,
  `latitude` decimal(15,10) DEFAULT NULL,
  `info` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`company_id`, `company_name`, `company_login`, `company_password`, `city`, `street`, `street_number`, `longtitude`, `latitude`, `info`) VALUES
(4, 'Apple1', 'das', '$2y$10$.Yj/uJh098Yz.zJWd8DDuuonHfy2e8aW3zljsiXr13hzXY5WQNnuC', 'Limanowa', 'Limanowa', 123, NULL, NULL, 'dadsadas');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `courses`
--

CREATE TABLE `courses` (
  `courses_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `course_name` text NOT NULL,
  `organizer` text NOT NULL,
  `course_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `education`
--

CREATE TABLE `education` (
  `education_id` smallint(5) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `level` tinytext NOT NULL,
  `school_name` tinytext NOT NULL,
  `place_of_residence` tinytext NOT NULL,
  `field_of_study` tinytext NOT NULL,
  `study_period_start` date NOT NULL,
  `study_period_end` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `job_offer`
--

CREATE TABLE `job_offer` (
  `offer_id` int(11) NOT NULL,
  `offer_name` tinytext NOT NULL,
  `company_id` smallint(6) UNSIGNED NOT NULL,
  `job_name` tinytext NOT NULL,
  `job_level` tinytext NOT NULL,
  `type_of_contract` tinytext NOT NULL,
  `employment_dimension` tinytext NOT NULL,
  `type_of_work` tinytext NOT NULL,
  `salary_range_min` tinytext NOT NULL,
  `salary_range_max` tinytext NOT NULL,
  `days_of_work` tinytext NOT NULL,
  `work_hours_min` tinyint(3) UNSIGNED NOT NULL,
  `work_hours_max` tinyint(3) UNSIGNED NOT NULL,
  `end_of_recrutation` date NOT NULL,
  `category_id` smallint(5) UNSIGNED NOT NULL,
  `responsibilities` mediumtext NOT NULL,
  `requirements` mediumtext NOT NULL,
  `benefits` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `job_offer`
--

INSERT INTO `job_offer` (`offer_id`, `offer_name`, `company_id`, `job_name`, `job_level`, `type_of_contract`, `employment_dimension`, `type_of_work`, `salary_range_min`, `salary_range_max`, `days_of_work`, `work_hours_min`, `work_hours_max`, `end_of_recrutation`, `category_id`, `responsibilities`, `requirements`, `benefits`) VALUES
(9, 'asd', 4, 'asd', 'sad', 'sad', 'asd', 'asd', '123', '123', 'pn-pt', 22, 23, '2024-06-05', 1, 'asddas', 'asddsa', 'dasasd');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `links`
--

CREATE TABLE `links` (
  `link_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `link` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `profession_experience`
--

CREATE TABLE `profession_experience` (
  `profession_experience_id` smallint(5) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `position` tinytext NOT NULL,
  `company_name` tinytext NOT NULL,
  `company_city` tinytext NOT NULL,
  `company_street` tinytext NOT NULL,
  `employment_period_start` date NOT NULL,
  `employment_period_end` date NOT NULL,
  `duties` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_login` text NOT NULL,
  `user_password` text NOT NULL,
  `firstname` tinytext NOT NULL,
  `surname` tinytext NOT NULL,
  `date_of_birth` date NOT NULL,
  `email` tinytext NOT NULL,
  `tel_number` varchar(9) NOT NULL,
  `profile_picture` text NOT NULL,
  `place_of_residence` tinytext NOT NULL,
  `current_position` tinytext DEFAULT NULL,
  `description_of_position` mediumtext DEFAULT NULL,
  `profession_summary` mediumtext DEFAULT NULL,
  `knowledge_of_languages` mediumtext DEFAULT NULL,
  `skills` mediumtext DEFAULT NULL,
  `account_type` varchar(7) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_login`, `user_password`, `firstname`, `surname`, `date_of_birth`, `email`, `tel_number`, `profile_picture`, `place_of_residence`, `current_position`, `description_of_position`, `profession_summary`, `knowledge_of_languages`, `skills`, `account_type`) VALUES
(13, 'admin', '$2y$10$FlOglb0t6XqdoQpEARYq..GOUNhhoCdpvSQBg43dB.w72bxrwrVJO', 'admin', 'admin', '2222-12-23', 'admin@gmail.com', '123123123', 'userProfilePictures/default.jpg', 'admin1', NULL, NULL, NULL, NULL, NULL, 'admin'),
(14, 'asd', '$2y$10$TGx4ilg1g15UsefMFtJjK.tmbVQ/CY0aakb40DFtYMb/tVSkLkgAu', 'asd', 'asd', '0002-02-12', 'asd', '213321123', 'userProfilePictures/default.jpg', 'asd', NULL, NULL, NULL, NULL, NULL, 'user');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `applications`
--
ALTER TABLE `applications`
  ADD PRIMARY KEY (`application_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `job_offer_id` (`job_offer_id`);

--
-- Indeksy dla tabeli `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indeksy dla tabeli `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`company_id`);

--
-- Indeksy dla tabeli `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`courses_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeksy dla tabeli `education`
--
ALTER TABLE `education`
  ADD PRIMARY KEY (`education_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeksy dla tabeli `job_offer`
--
ALTER TABLE `job_offer`
  ADD PRIMARY KEY (`offer_id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `company_id` (`company_id`);

--
-- Indeksy dla tabeli `links`
--
ALTER TABLE `links`
  ADD PRIMARY KEY (`link_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeksy dla tabeli `profession_experience`
--
ALTER TABLE `profession_experience`
  ADD PRIMARY KEY (`profession_experience_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeksy dla tabeli `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `applications`
--
ALTER TABLE `applications`
  MODIFY `application_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `company_id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `courses_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `education`
--
ALTER TABLE `education`
  MODIFY `education_id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `job_offer`
--
ALTER TABLE `job_offer`
  MODIFY `offer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `links`
--
ALTER TABLE `links`
  MODIFY `link_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `profession_experience`
--
ALTER TABLE `profession_experience`
  MODIFY `profession_experience_id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `applications`
--
ALTER TABLE `applications`
  ADD CONSTRAINT `applications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `applications_ibfk_2` FOREIGN KEY (`job_offer_id`) REFERENCES `job_offer` (`offer_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `education`
--
ALTER TABLE `education`
  ADD CONSTRAINT `education_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `job_offer`
--
ALTER TABLE `job_offer`
  ADD CONSTRAINT `job_offer_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `job_offer_ibfk_2` FOREIGN KEY (`company_id`) REFERENCES `company` (`company_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `links`
--
ALTER TABLE `links`
  ADD CONSTRAINT `links_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `profession_experience`
--
ALTER TABLE `profession_experience`
  ADD CONSTRAINT `profession_experience_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
