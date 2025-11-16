/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

DROP TABLE IF EXISTS `log_history`;
CREATE TABLE `log_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `login_time` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `log_history_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS `question`;
CREATE TABLE `question` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `quiz_id` int(11) DEFAULT NULL,
  `question_text` varchar(100) NOT NULL,
  `option_a` varchar(100) NOT NULL,
  `option_b` varchar(100) NOT NULL,
  `option_c` varchar(100) NOT NULL,
  `option_d` varchar(100) NOT NULL,
  `correct_option` enum('a','b','c','d') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `fk_question_quiz` (`quiz_id`),
  CONSTRAINT `fk_question_quiz` FOREIGN KEY (`quiz_id`) REFERENCES `quiz` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS `quiz`;
CREATE TABLE `quiz` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `category` enum('quran','hadith','history','fiqh') NOT NULL,
  `total_marks` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  `status` enum('suspend','active') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS `quiz_attempt`;
CREATE TABLE `quiz_attempt` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `quiz_id` int(11) NOT NULL,
  `obtained_score` int(11) NOT NULL,
  `total_incorrect` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `quiz_id` (`quiz_id`),
  CONSTRAINT `quiz_attempt_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  CONSTRAINT `quiz_attempt_ibfk_2` FOREIGN KEY (`quiz_id`) REFERENCES `quiz` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `role` enum('admin','student') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` enum('active','suspended') NOT NULL DEFAULT 'active',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `log_history` (`id`, `user_id`, `login_time`) VALUES
(5, 27, '2025-08-20 08:46:33'),
(7, 22, '2025-08-20 11:45:02'),
(8, 27, '2025-08-20 11:48:18'),
(10, 27, '2025-08-20 12:48:33'),
(11, 27, '2025-08-20 13:06:56'),
(12, 34, '2025-08-20 13:07:22'),
(14, 27, '2025-08-20 13:12:56'),
(16, 37, '2025-08-20 13:52:21'),
(18, 27, '2025-08-20 16:22:31'),
(19, 27, '2025-08-20 16:23:33'),
(20, 27, '2025-08-22 00:45:53'),
(21, 27, '2025-09-05 20:35:42'),
(22, 27, '2025-09-12 03:08:11');
INSERT INTO `question` (`id`, `quiz_id`, `question_text`, `option_a`, `option_b`, `option_c`, `option_d`, `correct_option`, `created_at`) VALUES
(5, 3, 'Who was the first Caliph after Prophet Muhammad (PBUH)?', 'Ali (RA)', 'Umar (RA)', 'Abu Bakr (RA)', 'Usman (RA)', 'c', '2025-08-16 10:00:56'),
(6, 3, 'In which year was the Battle of Badr fought?', '2 AH', '3 AH', '5 AH', '10 AH', 'a', '2025-08-16 10:00:56'),
(7, 4, 'What does \"Fiqh\" mean?', 'Belief', 'Jurisprudence', 'Charity', 'Worship', 'b', '2025-08-16 10:00:56'),
(22, 4, 'What does \"Fiqhah\" mean?', 'Belief', 'Jurisprudence', 'Charity', 'Worship', 'a', '2025-08-18 18:33:10'),
(23, 9, 'What is the meaning of Al-Fatiha?', 'The Opening', 'The Ending', 'The Book', 'The Prayer', 'a', '2025-08-18 22:18:52'),
(24, 9, 'How many verses are in Surah Al-Fatiha?', '5', '6', '7', '8', 'c', '2025-08-18 22:18:52'),
(25, 9, 'What is the significance of Surah Al-Fatiha in Salah?', 'It is optional', 'It is recited in every Rak\'ah', 'It is recited once a day', 'It is Sunnah only', 'b', '2025-08-18 22:18:52'),
(26, 9, 'Which two attributes of Allah are mentioned in the first verse?', 'Al-Malik & Al-Quddus', 'Ar-Rahman & Ar-Raheem', 'Al-Aziz & Al-Jabbar', 'Al-Khaliq & Al-Bari', 'b', '2025-08-18 22:18:52'),
(27, 9, 'What does \"Maliki Yawmid-Deen\" mean?', 'King of the Prophets', 'Master of the Universe', 'Owner of the Day of Judgment', 'Lord of the Worlds', 'c', '2025-08-18 22:18:52'),
(28, 9, 'Which verse in Surah Al-Fatiha is a supplication for guidance?', 'Iyyaka Na\'budu Wa Iyyaka Nasta\'een', 'Ihdinas-Sirat al-Mustaqeem', 'Alhamdulillahi Rabbil Aalameen', 'Ar-Rahman ir-Raheem', 'b', '2025-08-18 22:18:52'),
(29, 9, 'What is meant by As-Sirat al-Mustaqeem?', 'The straight path', 'The path of sins', 'The path of wealth', 'The path of prophets only', 'a', '2025-08-18 22:18:52'),
(30, 9, 'Who are \"those who have earned Allah’s anger\"?', 'Muslims', 'Christians', 'Jews (according to Tafsir)', 'Hypocrites', 'c', '2025-08-18 22:18:52'),
(31, 9, 'Why is Surah Al-Fatiha called Umm al-Kitab?', 'Because it is the first revealed Surah', 'Because it summarizes the Quran', 'Because it is longest Surah', 'Because it is about history', 'b', '2025-08-18 22:18:52'),
(32, 9, 'How many times is Surah Al-Fatiha recited in 5 daily prayers?', '10 times', '17 times', '20 times', '25 times', 'b', '2025-08-18 22:18:52');
INSERT INTO `quiz` (`id`, `name`, `category`, `total_marks`, `time`, `status`, `created_at`) VALUES
(2, 'Hadith Knowledge', 'hadith', 15, 20, 'suspend', '2025-08-16 10:00:56'),
(3, 'Islamic History Overview', 'history', 20, 30, 'active', '2025-08-16 10:00:56'),
(4, 'Fiqh Basics', 'fiqh', 10, 10, 'suspend', '2025-08-16 10:00:56'),
(9, 'Surah Fatiha', 'quran', 10, 20, 'active', '2025-08-18 19:05:12');
INSERT INTO `quiz_attempt` (`id`, `user_id`, `quiz_id`, `obtained_score`, `total_incorrect`, `created_at`) VALUES
(6, 22, 4, 1, 1, '2025-08-20 11:45:34'),
(7, 27, 9, 7, 3, '2025-08-20 12:02:53'),
(12, 37, 4, 1, 1, '2025-08-20 13:52:36'),
(14, 27, 4, 1, 1, '2025-08-20 16:23:44'),
(15, 27, 3, 1, 1, '2025-08-22 00:46:35'),
(16, 27, 9, 6, 4, '2025-09-05 20:37:00'),
(17, 27, 2, 0, 1, '2025-09-12 03:08:24');
INSERT INTO `user` (`id`, `first_name`, `last_name`, `email`, `password`, `gender`, `role`, `created_at`, `status`) VALUES
(4, 'Admin', 'User', 'admin@example.com', '$2y$10$eQlh8L7bBlU3BNrbAVuf2OF9U0PimjowhL3Qs.hFuWD6D6wLils8u', 'male', 'admin', '2025-08-20 13:15:17', 'active'),
(17, 'Chicha', 'Watni', 'chicha@gmail.com', '$2y$10$CJEsST6hbhKX2uQBPYihved8RUhtvqcQu/lKiQS/tE.ss2XMmRcOW', 'male', 'student', '2025-08-19 14:10:00', 'active'),
(18, 'Fatima', 'Ahmed', 'fatima.ahmed2211@example.com', '$2y$10$EMyT/UGO3uv7xrjpNrwz0eYkKctBJhDNWaltKuKCNjkcjCwcYO6oK', 'female', 'student', '2025-08-18 08:50:57', 'active'),
(21, 'Fatima', 'Aisham', 'aisham2211@gmail.com', '$2y$10$t6MeqMl/KORkSU/NLG/bienDOsBrzngEYwTcmNoHI/3a6.3zC0klG', 'female', 'student', '2025-08-19 10:49:50', 'active'),
(22, 'Ibsham', 'Ahmed', 'Ibshamahmed@gmail.com', '$2y$10$eQlh8L7bBlU3BNrbAVuf2OF9U0PimjowhL3Qs.hFuWD6D6wLils8u', 'female', 'student', '2025-08-20 11:44:55', 'active'),
(23, 'Ali', 'Watni', 'aliwatni@gmail.com', '$2y$10$.FVBPyrCOvTevkOqupEhROopQCabGgFu/63SRnbHCPoNeK0I8LQbm', 'female', 'student', '2025-08-19 10:59:39', 'active'),
(24, 'Chicha ', 'Ch', 'chichach@gmail.com', '$2y$10$35OT5ZoijsF6yzdCiCKYaeMx7fdOp7dLOQvM3tObyr6XEEr7N.D6q', 'male', 'student', '2025-08-19 11:02:06', 'active'),
(25, 'Chicha ', 'Aisham', 'chichaaisham@gmail.com', '$2y$10$0PI5OGHqxez9qsfDLgXtK.Q7sAKJNie0krM.dngehwmKbBsZK5tA6', 'female', 'student', '2025-08-19 11:06:19', 'active'),
(26, 'Sabun', 'Watni', 'sabunratan@gmail.com', '$2y$10$lUUxQH9mJIYAvt5F/CBzMO87DvNtzm8RXO5G2ppJI7i7B0sGi6LTC', 'female', 'student', '2025-08-19 11:14:16', 'active'),
(27, 'Ibsham', 'Chaudhary', 'ibshamchaudhary@gmail.com', '$2y$10$eQlh8L7bBlU3BNrbAVuf2OF9U0PimjowhL3Qs.hFuWD6D6wLils8u', 'male', 'student', '2025-08-19 11:32:32', 'active'),
(28, 'Ibsham', 'Ch', 'ibshamch444@gmail.com', '$2y$10$hl/Uy1Hi.mPYwdh0J3F85OZsonk93M1HrU.lohoGg2jRYu/Pr97ua', 'male', 'student', '2025-08-20 12:34:08', 'active'),
(29, 'Ibsham', 'ch', 'ibshamch555@gmail.com', '$2y$10$cRmZgdBG.dMp78J9V3aetuU6aB9HmIDPCESfgBeOl4KXhjcY.bVDW', 'male', 'student', '2025-08-20 12:37:19', 'active'),
(31, 'Ibsham', 'Ch', 'ibshamch888@gmail.com', '$2y$10$eVi5DJWiedtReVFoueyCmeA14QTJvLGNEFiDfRupS.A4JyGhi0.DO', 'male', 'student', '2025-08-20 12:46:14', 'active'),
(32, 'Ibsham', 'Ch', 'ibshamch897@gmail.com', '$2y$10$/yy1JkHy.3NvdAf3.iCfvux5u3QSMPe8HX3jtzwBVpftpq7/0JYSO', 'male', 'student', '2025-08-20 13:53:32', 'suspended'),
(33, 'Ibsham', 'Ch', 'ibshamchaudhary22111@gmail.com', '$2y$10$QSFensH7XTA8dVcLGDMM6eNsaTnsDBZt5NukAJZN2DewLewB3oGfK', 'male', 'student', '2025-08-20 12:54:20', 'active'),
(34, 'Ibsham', 'Chaudhary', 'ibshamchaudhary2211@gmail.com', '$2y$10$k990nW.FlgryLjVB5On/oeb40rfEBv828GoQeDuiAPgpfFXMYpa.G', 'male', 'student', '2025-08-20 13:24:58', 'suspended'),
(37, 'Ibsham', 'Ch', 'ibsham9@gmail.com', '$2y$10$V3T0/LxP10ndaIBDrjn5WestsrofZQjP0j1Dq3VUqI0uvDRUMoSZy', 'male', 'student', '2025-08-20 13:52:21', 'active');


/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;