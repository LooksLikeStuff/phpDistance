-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Jun 20, 2022 at 11:28 AM
-- Server version: 8.0.24
-- PHP Version: 8.0.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `distance`
--

-- --------------------------------------------------------

--
-- Table structure for table `groupes`
--

CREATE TABLE `groupes` (
  `group_id` int NOT NULL,
  `group_name` varchar(50) NOT NULL,
  `speciality` varchar(20) NOT NULL,
  `num_of_students` int NOT NULL,
  `course` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `groupes`
--

INSERT INTO `groupes` (`group_id`, `group_name`, `speciality`, `num_of_students`, `course`) VALUES
(2, 'ИС-401', '09.02.04', 25, 4),
(3, 'Д-111', '07.02.01', 25, 1),
(6, 'ИС-201', '09.02.04', 25, 2);

-- --------------------------------------------------------

--
-- Table structure for table `journal`
--

CREATE TABLE `journal` (
  `lession` int NOT NULL,
  `subject` int NOT NULL,
  `student` int NOT NULL,
  `type` enum('Лекция','Тест') NOT NULL,
  `grade` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `journal`
--

INSERT INTO `journal` (`lession`, `subject`, `student`, `type`, `grade`) VALUES
(1, 1, 22, 'Лекция', 3),
(1, 1, 24, 'Тест', 3),
(1, 1, 26, 'Лекция', 3),
(1, 1, 29, 'Тест', 3),
(2, 1, 29, 'Лекция', 3);

-- --------------------------------------------------------

--
-- Table structure for table `lecturers`
--

CREATE TABLE `lecturers` (
  `lect_id` int NOT NULL,
  `lect_name` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `lect_birthdate` date NOT NULL,
  `lect_telephone` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `lect_login` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `lect_pass` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `lecturers`
--

INSERT INTO `lecturers` (`lect_id`, `lect_name`, `lect_birthdate`, `lect_telephone`, `lect_login`, `lect_pass`) VALUES
(1, 'Шпак Галина Трофимовна', '2022-04-01', '89103579641', '519e88c1c2021f6f9f3a6099a0776b80', '6ebc115cd503b86aa92f8b68383f2b1f'),
(2, 'Избаш Светлана Анатольевна', '2022-04-01', '89134865137', 'eb71d35709640f5337fca933cd30d858', 'a371d6cba2da2e906da5438d7e3fb306'),
(3, 'Кузьмин Андрей Викторович', '2002-02-26', '+79992376090', 'Aventure', '123'),
(13, 'Ермоленко Даниил Александрович', '2002-01-31', '+78363463422', 'b8a0a08f9fc37b6f0a173a6d54313f7f', 'cff9a704d4c593030100b44cc22885c0');

-- --------------------------------------------------------

--
-- Table structure for table `lessions`
--

CREATE TABLE `lessions` (
  `lession_id` int NOT NULL,
  `subject` int NOT NULL,
  `class` int NOT NULL,
  `topic` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `work` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `lessions`
--

INSERT INTO `lessions` (`lession_id`, `subject`, `class`, `topic`, `work`) VALUES
(1, 1, 2, 'Массивы PHP', 12),
(2, 1, 2, 'Суперглобальные переменные', 16),
(3, 1, 2, 'СУБД MySQL', 17),
(4, 1, 2, 'Дипломная работа', 18);

-- --------------------------------------------------------

--
-- Table structure for table `specialities`
--

CREATE TABLE `specialities` (
  `speciality_id` varchar(20) NOT NULL,
  `education_form` enum('Очная','Заочная') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `spec_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `abbreviation` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `study_duration` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `specialities`
--

INSERT INTO `specialities` (`speciality_id`, `education_form`, `spec_name`, `abbreviation`, `study_duration`) VALUES
('07.02.01', 'Очная', 'Деревообработка', 'Д', '3г. 10мес.'),
('09.02.04', 'Очная', 'Информационные системы', 'ИС', '3г. 10мес.'),
('09.03.01', 'Очная', 'Информационные технологии', 'ИТ', '4г. 10мес.');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `st_id` int NOT NULL,
  `class` int NOT NULL,
  `st_name` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `st_birthdate` date NOT NULL,
  `st_telephone` varchar(15) NOT NULL,
  `st_login` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `st_pass` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`st_id`, `class`, `st_name`, `st_birthdate`, `st_telephone`, `st_login`, `st_pass`) VALUES
(19, 2, 'Скворцов Данила Валерьевич', '2002-02-26', '89158506935', 'c32726d95e6f84eaed14efa8cc65fec6', '26330091f7f42bf73525d932b9d8e009'),
(21, 2, 'Полторак Андрей Николаевич', '2002-02-26', '+783634634634', '6c977cd491c6c4be992e000fde87d92b', '6160a78967ebd952777b0e26ae66b6bc'),
(22, 2, 'Зверев Андрей Иванович', '2002-01-31', '+7836346346', 'cbeeb75f7acc86ff34e0271e0c431133', '887df88ba90010693c86d9cf85ec919f'),
(23, 2, 'Махначевский Руслан Алексеевич', '2002-10-18', '+78363463422', '17a35e4085d73f63e4e2b9d42530df20', '9ee0cdeded7433fcde46a8783720981c'),
(24, 2, 'Теняева Ксения Сергеевна', '2002-01-31', '+783634634634', '9a79152d6adda053a9afa9ad08628964', 'e1c9336a236003f03d09ec5348257c06'),
(25, 2, 'Белякова Дарья Дмитриевна', '2002-01-31', '89158506935', '62d531aa767438c019961b58da9da868', '3477d305e81db00eac0b4e2f1b2229b0'),
(26, 2, 'Адвеев Сергей-Даниил Сергеевич', '2002-01-31', '+783634634634', '6d367efc337a2c7fb9c6e74837e7b145', '3f391a760fa287d9c4d7e77b2d92b799'),
(27, 2, 'Якимов Сергей Александрович', '2002-01-31', '89158506935', 'd469c25140da4b00bff91a86d6762d83', '4f7c874b22831ff21a8901dbf6180d4f'),
(28, 2, 'Новоселова Екатерина Сергеевна', '2002-01-31', '+78363463422', '51dac7c27ffc03e5de23204d769412e0', '5f6d24469c3c6e088552ca1cad14773f'),
(29, 2, 'Ермоленко Данила Александрович', '2002-01-31', '+783634634634', 'b8a0a08f9fc37b6f0a173a6d54313f7f', 'cff9a704d4c593030100b44cc22885c0');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `subj_id` int NOT NULL,
  `subj_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `lecturer` int NOT NULL,
  `lecture_hours` int NOT NULL,
  `practice_hours` int NOT NULL,
  `speciality` varchar(20) NOT NULL,
  `course` int NOT NULL,
  `semester` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`subj_id`, `subj_name`, `lecturer`, `lecture_hours`, `practice_hours`, `speciality`, `course`, `semester`) VALUES
(1, 'Информационные технологии и платформы', 1, 48, 48, '09.02.04', 4, '7'),
(2, 'Управление проектами', 1, 48, 48, '09.02.04', 4, '7'),
(5, 'Эксплуатация ИС', 2, 48, 48, '09.02.04', 4, '7'),
(6, 'Управленческая психология', 2, 48, 48, '09.02.04', 4, '7'),
(7, 'Безопасность доступа в ИС', 3, 48, 48, '09.02.04', 4, '7'),
(8, 'Технология отрасли (деревообр)', 2, 48, 48, '09.02.04', 4, '7'),
(9, 'Физкультура', 2, 48, 48, '09.02.04', 4, '7'),
(10, 'АСУТП', 2, 48, 48, '09.02.04', 4, '7'),
(11, 'Методы и средства проект', 3, 48, 48, '09.02.04', 4, '7'),
(12, 'Управление карьерой', 1, 48, 48, '09.02.04', 4, '7'),
(16, 'Новый предмет', 3, 48, 48, '07.02.01', 1, '2');

-- --------------------------------------------------------

--
-- Table structure for table `test_answers`
--

CREATE TABLE `test_answers` (
  `answer_id` int NOT NULL,
  `question` int NOT NULL,
  `answer` varchar(200) NOT NULL,
  `correct` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `test_answers`
--

INSERT INTO `test_answers` (`answer_id`, `question`, `answer`, `correct`) VALUES
(525, 167, 'Первый ответ', 1),
(526, 167, 'Второй ответ', 0),
(527, 167, 'Третий ответ', 0),
(528, 167, 'Четвертый ответ', 0),
(529, 168, 'Первый ответ', 0),
(530, 168, 'Второй ответ', 1),
(531, 168, 'Третий ответ', 0),
(532, 168, 'Четвертый ответ', 0),
(533, 169, 'Первый ответ', 0),
(534, 169, 'Второй ответ', 0),
(535, 169, 'Третий ответ', 1),
(536, 169, 'Четвертый ответ', 0),
(537, 170, 'Первый ответ', 0),
(538, 170, 'Второй ответ', 0),
(539, 170, 'Третий ответ', 0),
(540, 170, 'Четвертый ответ', 1),
(541, 171, 'Первый ответ', 1),
(542, 171, 'Второй ответ', 0),
(543, 171, 'Третий ответ', 0),
(544, 171, 'Четвертый ответ', 0);

-- --------------------------------------------------------

--
-- Table structure for table `test_questions`
--

CREATE TABLE `test_questions` (
  `question_id` int NOT NULL,
  `lession` int NOT NULL,
  `subject` int NOT NULL,
  `class` int NOT NULL,
  `question` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `test_questions`
--

INSERT INTO `test_questions` (`question_id`, `lession`, `subject`, `class`, `question`) VALUES
(167, 1, 1, 2, 'Первый вопрос'),
(168, 1, 1, 2, 'Второй вопрос'),
(169, 1, 1, 2, 'Третий вопрос'),
(170, 1, 1, 2, 'Четвертый вопрос'),
(171, 1, 1, 2, 'Пятый вопрос');

-- --------------------------------------------------------

--
-- Table structure for table `timetable`
--

CREATE TABLE `timetable` (
  `tt_id` int NOT NULL,
  `subject` int NOT NULL,
  `tt_num` int NOT NULL,
  `tt_day` varchar(15) NOT NULL,
  `tt_week` enum('Четная','Нечетная','Всегда') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `timetable`
--

INSERT INTO `timetable` (`tt_id`, `subject`, `tt_num`, `tt_day`, `tt_week`) VALUES
(1, 2, 1, 'ПН', 'Четная'),
(5, 5, 2, 'ПН', 'Всегда'),
(6, 5, 3, 'ПН', 'Всегда'),
(7, 6, 4, 'ПН', 'Четная'),
(8, 6, 1, 'ВТ', 'Всегда'),
(9, 2, 3, 'ВТ', 'Всегда'),
(10, 2, 4, 'ВТ', 'Всегда'),
(11, 12, 2, 'ВТ', 'Всегда'),
(12, 7, 1, 'СР', 'Всегда'),
(13, 7, 2, 'СР', 'Четная'),
(14, 8, 3, 'СР', 'Всегда'),
(15, 8, 4, 'СР', 'Всегда'),
(16, 9, 1, 'ЧТ', 'Всегда'),
(17, 10, 2, 'ЧТ', 'Всегда'),
(18, 11, 3, 'ЧТ', 'Всегда'),
(19, 11, 4, 'ЧТ', 'Всегда'),
(20, 1, 1, 'ПТ', 'Всегда'),
(21, 1, 2, 'ПТ', 'Всегда'),
(22, 10, 3, 'ПТ', 'Нечетная'),
(23, 1, 1, 'ПН', 'Нечетная'),
(24, 8, 2, 'СР', 'Нечетная');

-- --------------------------------------------------------

--
-- Table structure for table `works`
--

CREATE TABLE `works` (
  `work_id` int NOT NULL,
  `file_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `works`
--

INSERT INTO `works` (`work_id`, `file_name`) VALUES
(12, 'POPYTKA4.docx'),
(16, 'COPYRIGHT_1.txt'),
(17, 'bd_dimaosnov.accdb'),
(18, 'Ekonomicheskaya_chast_obrazets_rascheta (1).docx');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `groupes`
--
ALTER TABLE `groupes`
  ADD PRIMARY KEY (`group_id`),
  ADD KEY `speciality` (`speciality`),
  ADD KEY `course` (`course`);

--
-- Indexes for table `journal`
--
ALTER TABLE `journal`
  ADD PRIMARY KEY (`lession`,`subject`,`student`,`type`) USING BTREE,
  ADD KEY `Student` (`student`),
  ADD KEY `zanyatie` (`lession`),
  ADD KEY `subject` (`subject`);

--
-- Indexes for table `lecturers`
--
ALTER TABLE `lecturers`
  ADD PRIMARY KEY (`lect_id`);

--
-- Indexes for table `lessions`
--
ALTER TABLE `lessions`
  ADD PRIMARY KEY (`lession_id`,`subject`),
  ADD KEY `Predmet` (`subject`),
  ADD KEY `Group` (`class`),
  ADD KEY `Работа` (`work`);

--
-- Indexes for table `specialities`
--
ALTER TABLE `specialities`
  ADD PRIMARY KEY (`speciality_id`,`education_form`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`st_id`),
  ADD KEY `gruppa` (`class`),
  ADD KEY `group` (`class`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`subj_id`),
  ADD KEY `Specialnost` (`speciality`),
  ADD KEY `lecturer` (`lecturer`),
  ADD KEY `Course` (`course`);

--
-- Indexes for table `test_answers`
--
ALTER TABLE `test_answers`
  ADD PRIMARY KEY (`answer_id`),
  ADD KEY `question` (`question`);

--
-- Indexes for table `test_questions`
--
ALTER TABLE `test_questions`
  ADD PRIMARY KEY (`question_id`),
  ADD KEY `lession` (`lession`),
  ADD KEY `subject` (`subject`),
  ADD KEY `class` (`class`);

--
-- Indexes for table `timetable`
--
ALTER TABLE `timetable`
  ADD PRIMARY KEY (`tt_id`),
  ADD KEY `subject` (`subject`);

--
-- Indexes for table `works`
--
ALTER TABLE `works`
  ADD PRIMARY KEY (`work_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `groupes`
--
ALTER TABLE `groupes`
  MODIFY `group_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `lecturers`
--
ALTER TABLE `lecturers`
  MODIFY `lect_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `lessions`
--
ALTER TABLE `lessions`
  MODIFY `lession_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `st_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `subj_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `test_answers`
--
ALTER TABLE `test_answers`
  MODIFY `answer_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=565;

--
-- AUTO_INCREMENT for table `test_questions`
--
ALTER TABLE `test_questions`
  MODIFY `question_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=177;

--
-- AUTO_INCREMENT for table `timetable`
--
ALTER TABLE `timetable`
  MODIFY `tt_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `works`
--
ALTER TABLE `works`
  MODIFY `work_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `groupes`
--
ALTER TABLE `groupes`
  ADD CONSTRAINT `groupes_ibfk_1` FOREIGN KEY (`speciality`) REFERENCES `specialities` (`speciality_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `journal`
--
ALTER TABLE `journal`
  ADD CONSTRAINT `journal_ibfk_1` FOREIGN KEY (`student`) REFERENCES `students` (`st_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `journal_ibfk_2` FOREIGN KEY (`lession`) REFERENCES `lessions` (`lession_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `journal_ibfk_3` FOREIGN KEY (`subject`) REFERENCES `subjects` (`subj_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `lessions`
--
ALTER TABLE `lessions`
  ADD CONSTRAINT `lessions_ibfk_1` FOREIGN KEY (`subject`) REFERENCES `subjects` (`subj_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lessions_ibfk_5` FOREIGN KEY (`class`) REFERENCES `groupes` (`group_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `lessions_ibfk_6` FOREIGN KEY (`work`) REFERENCES `works` (`work_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`class`) REFERENCES `groupes` (`group_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `subjects`
--
ALTER TABLE `subjects`
  ADD CONSTRAINT `subjects_ibfk_3` FOREIGN KEY (`speciality`) REFERENCES `specialities` (`speciality_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `subjects_ibfk_4` FOREIGN KEY (`lecturer`) REFERENCES `lecturers` (`lect_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `test_answers`
--
ALTER TABLE `test_answers`
  ADD CONSTRAINT `test_answers_ibfk_1` FOREIGN KEY (`question`) REFERENCES `test_questions` (`question_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `test_questions`
--
ALTER TABLE `test_questions`
  ADD CONSTRAINT `test_questions_ibfk_1` FOREIGN KEY (`lession`) REFERENCES `lessions` (`lession_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `test_questions_ibfk_2` FOREIGN KEY (`subject`) REFERENCES `subjects` (`subj_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `test_questions_ibfk_3` FOREIGN KEY (`class`) REFERENCES `groupes` (`group_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `timetable`
--
ALTER TABLE `timetable`
  ADD CONSTRAINT `timetable_ibfk_3` FOREIGN KEY (`subject`) REFERENCES `subjects` (`subj_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
