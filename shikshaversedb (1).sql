-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Sep 08, 2025 at 05:57 PM
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
-- Database: `shikshaversedb`
--

-- --------------------------------------------------------

--
-- Table structure for table `certificates`
--

CREATE TABLE `certificates` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `issued_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `certificates`
--

INSERT INTO `certificates` (`id`, `user_id`, `course_id`, `full_name`, `issued_at`) VALUES
(1, 15, 1, 'ritesh macchindra gagare', '2025-07-11 01:06:12'),
(5, 15, 2, 'users', '2025-07-11 13:52:42'),
(6, 15, 3, 'users', '2025-07-11 14:30:10');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `course_id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `duration` varchar(100) DEFAULT NULL,
  `category` varchar(100) DEFAULT NULL,
  `assignment` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`course_id`, `title`, `description`, `duration`, `category`, `assignment`) VALUES
(1, 'web devlopment basics of html', 'Learn the basics of web development HTMLand more.', '3 hours', 'Web Development', 'Create a personal portfolio using HTML and CSS. Submit as a ZIP or PDF.'),
(2, 'web devlopment-CSS', 'Learn the basics of web development CSS and more.', '4 hours', 'Web Development', 'Personal Profile Page (with CSS Styling)'),
(3, 'web devlopment - javascript', 'Learn the basics of web development JavaScript and more.', '1 hour', 'Web Development', 'Title: To-Do List App\r\n\r\nTask:\r\n\r\nCreate a simple web page with:\r\n\r\nAn input box and \"Add Task\" button.\r\n\r\nA list below to show tasks.\r\n\r\nWhen a user enters text and clicks \"Add Task\":\r\n\r\nThe task should be added to the list.\r\n\r\nEach task should have a \"Delete\" button to remove it.\r\n\r\n(Bonus) Add a \"Mark as Done\" button that changes the task’s style (e.g., strikethrough).'),
(4, 'UI UX Design ', 'Learn the basics of UI UX Design and more', '1.5 hour', 'UI/UX Design', 'Title: Mobile App Login Screen\r\n\r\nTask:\r\n\r\nDesign a login screen for a mobile app (use Figma, Adobe XD, or even pen & paper).\r\n\r\nMust include:\r\n\r\nApp logo at the top.\r\n\r\nInput fields for email & password.\r\n\r\nA login button (primary color).\r\n\r\nA \"Forgot Password?\" link.\r\n\r\nA \"Sign Up\" link for new users.\r\n\r\nPay attention to:\r\n\r\nAlignment (centered layout).\r\n\r\nColor contrast (button stands out).\r\n\r\nReadable fonts.'),
(5, 'MY SQL ', 'Learn the basics of MY SQL and more', '3 hour', 'Database', 'Create a table:student Task:\r\n\r\nInsert at least 5 students into the table.\r\n\r\nWrite a query to show all students older than 20.\r\n\r\nWrite a query to count how many students are in each course.\r\n\r\nWrite a query to update one student’s course.\r\n\r\nWrite a query to delete a student by id.');

-- --------------------------------------------------------

--
-- Table structure for table `course_topics`
--

CREATE TABLE `course_topics` (
  `id` int(11) NOT NULL,
  `course_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `video_url` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course_topics`
--

INSERT INTO `course_topics` (`id`, `course_id`, `title`, `video_url`) VALUES
(1, 1, 'Introduction to HTML & Web Basics', 'videos/htmlvideos/html-video1.mp4'),
(2, 1, 'Installing VS Code Live Server & More', 'videos/htmlvideos/html-video2.mp4'),
(3, 1, 'HTML Tutorial : Basic Structure Of Website', 'videos/htmlvideos/html-video3.mp4'),
(4, 1, 'HTML Head : Title , Link , Script & Meta Tags', 'videos/htmlvideos/html-video4.mp4'),
(5, 1, 'HTML Body : Paragraph & Heading Tags', 'videos/htmlvideos/html-video5.mp4'),
(6, 1, 'HTML Body : Adding Imags & Links', 'videos/htmlvideos/html-video6.mp4'),
(7, 1, 'HTML Body : List ul , ol & Tables', 'videos/htmlvideos/html-video7.mp4'),
(8, 1, 'HTML Body : Forms And Input Tags In HTML', 'videos/htmlvideos/html-video8.mp4'),
(9, 1, 'HTML Body : Inline & Block Element In HTML', 'videos/htmlvideos/html-video9.mp4'),
(10, 1, 'HTML Body : Ids & Classes In HTML', 'videos/htmlvideos/html-video10.mp4'),
(11, 1, 'HTML Body : HTML Entities', 'videos/htmlvideos/html-video11.mp4'),
(12, 1, 'HTML Body : HTML Sementic Tags', 'videos/htmlvideos/html-video12.mp4'),
(13, 2, 'Introduction To CSS | Inline, External And Internal CSS', 'videos/cssvideos/css-video1.mp4'),
(14, 2, 'Selectors in CSS', 'videos/cssvideos/css-video2.mp4'),
(15, 2, 'Colors in CSS', 'videos/cssvideos/css-video3.mp4'),
(16, 2, 'CSS Course | Units in CSS | px, vw, vh, %, em, rem', 'videos/cssvideos/css-video4.mp4'),
(17, 2, 'Css Box Model', 'videos/cssvideos/css-video5.mp4'),
(18, 2, 'Text and Font properties in CSS', 'videos/cssvideos/css-video6.mp4'),
(19, 2, 'CSS Display Properties', 'videos/cssvideos/css-video7.mp4'),
(20, 2, 'CSS Position properties', 'videos/cssvideos/css-video8.mp4'),
(21, 2, 'CSS overflow', 'videos/cssvideos/css-video9.mp4'),
(22, 2, 'Mini project', 'videos/cssvideos/css-video10.mp4'),
(23, 2, 'CSS flexbox', 'videos/cssvideos/css-video11.mp4'),
(24, 3, 'What is Javascript and more', 'videos/jsvideos/videoplayback.mp4'),
(25, 4, 'Complete UI/UX Design Course with Projects | Master UI/UX Design', 'videos/uiuxvideos/uiux-video1.mp4'),
(26, 4, '    Master Figma Basics in One Video | Figma Tutorial For Beginners', 'videos/uiuxvideos/uiux-video2.mp4'),
(27, 4, '   Responsive Grid Systems In Web & UI Design', 'videos/uiuxvideos/uiux-video3.mp4'),
(28, 4, '  Color Theory in UI Design', 'videos/uiuxvideos/uiux-video4.mp4'),
(29, 4, ' Glassmorphism UI Design Tutorial for Beginners', 'videos/uiuxvideos/uiux-video5.mp4'),
(30, 5, 'MTSQL Tutorial : 1', 'videos/mysqlvideos/mysql-video1.mp4'),
(31, 5, 'MTSQL Tutorial : 2', 'videos/mysqlvideos/mysql-video2.mp4'),
(32, 5, 'MTSQL Tutorial : 3', 'videos/mysqlvideos/mysql-video3.mp4'),
(33, 5, 'MTSQL Tutorial : 4', 'videos/mysqlvideos/mysql-video4.mp4'),
(34, 5, 'MTSQL Tutorial : 5', 'videos/mysqlvideos/mysql-video5.mp4'),
(35, 5, 'MTSQL Tutorial : 6', 'videos/mysqlvideos/mysql-video6.mp4'),
(36, 5, 'MTSQL Tutorial : 7', 'videos/mysqlvideos/mysql-video7.mp4'),
(37, 5, 'MTSQL Tutorial : 8', 'videos/mysqlvideos/mysql-video8.mp4'),
(38, 5, 'MTSQL Tutorial : 9', 'videos/mysqlvideos/mysql-video9.mp4'),
(39, 5, 'MTSQL Tutorial : 10', 'videos/mysqlvideos/mysql-video10.mp4'),
(40, 5, 'MTSQL Tutorial : 11', 'videos/mysqlvideos/mysql-video11.mp4'),
(41, 5, 'MTSQL Tutorial : 12', 'videos/mysqlvideos/mysql-video12.mp4'),
(42, 5, 'MTSQL Tutorial : 13', 'videos/mysqlvideos/mysql-video13.mp4'),
(43, 5, 'MTSQL Tutorial : 14', 'videos/mysqlvideos/mysql-video14.mp4'),
(44, 5, 'MTSQL Tutorial : 15', 'videos/mysqlvideos/mysql-video15.mp4'),
(45, 5, 'MTSQL Tutorial : 16', 'videos/mysqlvideos/mysql-video16.mp4'),
(46, 5, 'MTSQL Tutorial : 17', 'videos/mysqlvideos/mysql-video17.mp4'),
(47, 5, 'MTSQL Tutorial : 18', 'videos/mysqlvideos/mysql-video18.mp4'),
(48, 5, 'MTSQL Tutorial : 19', 'videos/mysqlvideos/mysql-video19.mp4'),
(49, 5, 'MTSQL Tutorial : 20', 'videos/mysqlvideos/mysql-video20.mp4'),
(50, 5, 'MTSQL Tutorial : 21', 'videos/mysqlvideos/mysql-video21.mp4'),
(51, 5, 'MTSQL Tutorial : 22', 'videos/mysqlvideos/mysql-video22.mp4'),
(52, 5, 'MTSQL Tutorial : 23', 'videos/mysqlvideos/mysql-video23.mp4'),
(53, 5, 'MTSQL Tutorial : 24', 'videos/mysqlvideos/mysql-video24.mp4'),
(54, 5, 'MTSQL Tutorial : 25', 'videos/mysqlvideos/mysql-video25.mp4'),
(55, 5, 'MTSQL Tutorial : 26', 'videos/mysqlvideos/mysql-video26.mp4'),
(56, 5, 'MTSQL Tutorial : 27', 'videos/mysqlvideos/mysql-video27.mp4'),
(57, 5, 'MTSQL Tutorial : 28', 'videos/mysqlvideos/mysql-video28.mp4'),
(58, 5, 'MTSQL Tutorial : 29', 'videos/mysqlvideos/mysql-video29.mp4'),
(59, 5, 'MTSQL Tutorial : 30', 'videos/mysqlvideos/mysql-video30.mp4'),
(60, 5, 'MTSQL Tutorial : 31', 'videos/mysqlvideos/mysql-video31.mp4');

-- --------------------------------------------------------

--
-- Table structure for table `enrollments`
--

CREATE TABLE `enrollments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL,
  `enrolled_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `enrollments`
--

INSERT INTO `enrollments` (`id`, `user_id`, `course_id`, `enrolled_at`) VALUES
(1, 15, 1, '2025-07-10 23:18:26'),
(2, 15, 3, '2025-07-11 13:40:09'),
(3, 15, 2, '2025-07-11 13:40:26'),
(4, 15, 5, '2025-07-11 13:40:44'),
(5, 15, 4, '2025-09-02 22:36:48');

-- --------------------------------------------------------

--
-- Table structure for table `quiz_questions`
--

CREATE TABLE `quiz_questions` (
  `id` int(11) NOT NULL,
  `course_id` int(11) DEFAULT NULL,
  `question` text DEFAULT NULL,
  `option_a` varchar(255) DEFAULT NULL,
  `option_b` varchar(255) DEFAULT NULL,
  `option_c` varchar(255) DEFAULT NULL,
  `option_d` varchar(255) DEFAULT NULL,
  `correct_option` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quiz_questions`
--

INSERT INTO `quiz_questions` (`id`, `course_id`, `question`, `option_a`, `option_b`, `option_c`, `option_d`, `correct_option`) VALUES
(1, 1, 'What does HTML stand for?', 'Hyperlinks and Text Markup Language', 'Hyper Text Markup Language', 'Home Tool Markup Language', 'Hyper Tool Multi Language', 'B'),
(2, 1, 'Which HTML element is used to define a paragraph?', 'para', 'p', 'paragraph', 'pg', 'B'),
(3, 1, 'What is the correct HTML element for inserting a line break?', 'br', 'lb', 'break', 'newline', 'A'),
(4, 1, 'Which HTML tag is used to define an unordered list?', 'ol', 'ul', 'list', 'li', 'B'),
(5, 1, 'What is the correct HTML element for inserting an image?', 'image', 'img', 'pic', 'src', 'B'),
(6, 1, 'Which attribute is used to provide an alternative text for an image?', 'title', 'alt', 'src', 'href', 'B'),
(7, 1, 'How do you create a hyperlink in HTML?', '//<a href=\"url\">link</a>//', '//<link url=\"url\">link</link>//', '//<a>url</a>//', '//<href=\"url\">link</href>//', 'A'),
(8, 1, 'Which tag is used to define a table row?', 'tr', 'td', 'th', 'row', 'A'),
(9, 1, 'What is the purpose of the <head> tag in HTML?', 'To define the header of the document', 'To store metadata and links to scripts/styles', 'To display the main content', 'To define the navigation bar', 'B'),
(10, 1, 'Which tag is used to create a numbered list in HTML?', 'ol', 'ul', 'li', 'dl', 'A'),
(11, 2, 'What does CSS stand for?', 'Creative Style Sheets', 'Cascading Style Sheets', 'Computer Style Sheets', 'Colorful Style Sheets', 'B'),
(12, 2, 'Which property is used to change the font of an element?', 'font-family', 'font-style', 'text-font', 'font-type', 'A'),
(13, 2, 'How do you make a list not show bullet points?', 'list-style-type: none', 'list-style: none', 'no-bullets: true', 'list-none', 'A'),
(14, 2, 'Which CSS property controls the text size?', 'font-size', 'text-size', 'size-text', 'font', 'A'),
(15, 2, 'Which of the following is used to add space between elements?', 'margin', 'padding', 'spacing', 'border', 'A'),
(16, 2, 'How do you add a background color to a web page?', 'background-color', 'background-image', 'color', 'bg-color', 'A'),
(17, 2, 'Which CSS property is used to change the text color?', 'color', 'font-color', 'text-color', 'background-color', 'A'),
(18, 2, 'What is the correct CSS syntax to change the background color of a page?', 'background-color: yellow;', 'background-color: yellow', 'background: yellow;', 'color: yellow;', 'A'),
(19, 2, 'Which CSS property is used to set the space between words?', 'word-spacing', 'line-height', 'letter-spacing', 'text-spacing', 'A'),
(20, 2, 'Which CSS rule is used to make text bold?', 'font-weight: bold;', 'font-style: bold;', 'font-size: bold;', 'font-text: bold;', 'A'),
(21, 3, 'Which of the following is the correct syntax for a JavaScript comment?', '// This is a comment', '/* This is a comment */', '<!-- This is a comment -->', '/* comment', 'A'),
(22, 3, 'Which JavaScript method is used to write text to the document?', 'document.write()', 'console.log()', 'alert()', 'print()', 'A'),
(23, 3, 'How do you declare a JavaScript variable?', 'var x', 'let x', 'const x', 'All of the above', 'D'),
(24, 3, 'Which operator is used to assign a value to a variable?', '=', '==', '===', ':=', 'A'),
(25, 3, 'Which method is used to convert a string to a number?', 'parseInt()', 'toNumber()', 'parseFloat()', 'All of the above', 'D'),
(26, 3, 'Which function is used to prompt the user for input in JavaScript?', 'prompt()', 'alert()', 'confirm()', 'input()', 'A'),
(27, 3, 'Which of the following is the correct way to declare a function in JavaScript?', 'function myFunction()', 'function = myFunction()', 'myFunction() = function', 'myFunction => function', 'A'),
(28, 3, 'Which of the following is a JavaScript data type?', 'Object', 'Boolean', 'String', 'All of the above', 'D'),
(29, 3, 'Which symbol is used for comments in JavaScript?', '//', '/* */', '#', 'All of the above', 'D'),
(30, 3, 'What is the purpose of the JavaScript \"this\" keyword?', 'Refers to the current object', 'Refers to the window object', 'Refers to a function', 'None of the above', 'A'),
(31, 4, 'What does UI stand for?', 'User Interaction', 'User Interface', 'Universal Interface', 'Uniform Interaction', 'B'),
(32, 4, 'Which of these is a principle of UX design?', 'Usability', 'Aesthetics', 'Interactivity', 'All of the above', 'D'),
(33, 4, 'Which color scheme is best for a UI design?', 'Complementary', 'Monochromatic', 'Analogous', 'All of the above', 'D'),
(34, 4, 'What is the main goal of UX design?', 'To create an enjoyable experience for the user', 'To make the UI look beautiful', 'To add as many features as possible', 'To maximize performance', 'A'),
(35, 4, 'What is the purpose of wireframing in UI design?', 'To create a rough sketch of the design layout', 'To add final styling', 'To write code for the interface', 'To perform usability testing', 'A'),
(36, 4, 'Which of the following is a common UX testing method?', 'A/B testing', 'Unit testing', 'Regression testing', 'Stress testing', 'A'),
(37, 4, 'What is a persona in UX design?', 'A fictional character representing the user', 'A software used to create designs', 'A design style', 'A project management tool', 'A'),
(38, 4, 'Which of the following is a part of the UX process?', 'Research', 'Prototyping', 'User testing', 'All of the above', 'D'),
(39, 4, 'Which tool is commonly used for prototyping in UI/UX design?', 'Sketch', 'Figma', 'Adobe XD', 'All of the above', 'D'),
(40, 4, 'Which of the following refers to the consistency of design elements across an interface?', 'Design system', 'User flow', 'Wireframing', 'Prototyping', 'A'),
(41, 5, 'What does SQL stand for?', 'Structured Query Language', 'Simple Query Language', 'Standard Query Language', 'None of the above', 'A'),
(42, 5, 'Which SQL keyword is used to retrieve data from a database?', 'SELECT', 'GET', 'FETCH', 'READ', 'A'),
(43, 5, 'Which SQL clause is used to filter records?', 'WHERE', 'HAVING', 'FILTER', 'WHERE-CLAUSE', 'A'),
(44, 5, 'Which SQL statement is used to update data in a table?', 'UPDATE', 'MODIFY', 'CHANGE', 'SET', 'A'),
(45, 5, 'Which of the following is the correct syntax to delete a record from a table?', 'DELETE FROM table WHERE condition', 'REMOVE FROM table WHERE condition', 'DELETE table WHERE condition', 'REMOVE table WHERE condition', 'A'),
(46, 5, 'What is a primary key in SQL?', 'A unique identifier for records in a table', 'A foreign key', 'A field for indexing data', 'None of the above', 'A'),
(47, 5, 'Which SQL statement is used to create a table?', 'CREATE TABLE', 'MAKE TABLE', 'NEW TABLE', 'BEGIN TABLE', 'A'),
(48, 5, 'What is the correct SQL syntax to add a new column to a table?', 'ALTER TABLE table ADD column', 'ALTER TABLE table INSERT column', 'ADD COLUMN TO table', 'MODIFY table ADD column', 'A'),
(49, 5, 'Which SQL function is used to count the number of rows in a table?', 'COUNT()', 'SUM()', 'TOTAL()', 'ROWS()', 'A'),
(50, 5, 'Which of the following is a SQL aggregate function?', 'COUNT()', 'AVG()', 'SUM()', 'All of the above', 'D');

-- --------------------------------------------------------

--
-- Table structure for table `quiz_results`
--

CREATE TABLE `quiz_results` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL,
  `score` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `passed` tinyint(1) DEFAULT NULL,
  `attempted_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quiz_results`
--

INSERT INTO `quiz_results` (`id`, `user_id`, `course_id`, `score`, `total`, `passed`, `attempted_at`) VALUES
(1, 15, 1, 7, 10, 1, '2025-07-11 00:28:46'),
(2, 15, 1, 7, 10, 1, '2025-07-11 00:58:01'),
(3, 15, 1, 7, 10, 1, '2025-07-11 01:00:54'),
(4, 15, 1, 7, 10, 1, '2025-07-11 01:01:57'),
(5, 15, 1, 0, 0, 1, '2025-07-11 09:56:40'),
(6, 15, 2, 0, 0, 1, '2025-07-11 13:50:49'),
(7, 15, 3, 0, 0, 1, '2025-07-11 14:30:06'),
(8, 15, 1, 0, 0, 1, '2025-07-11 20:45:31'),
(9, 15, 1, 0, 0, 1, '2025-07-16 11:31:46'),
(10, 15, 2, 0, 0, 1, '2025-07-24 20:29:53'),
(11, 15, 1, 0, 0, 1, '2025-08-06 10:33:12'),
(12, 15, 1, 0, 0, 1, '2025-08-19 21:44:38'),
(13, 15, 1, 0, 0, 1, '2025-09-02 22:38:23');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(11) NOT NULL,
  `dt` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `dt`) VALUES
(1, '0', '123', '0000-00-00 00:00:00'),
(2, 'ritz', '1234', '2025-07-10 14:17:55'),
(3, 'ritz', '1234', '2025-07-10 20:21:59'),
(13, 'mmm', 'mmm', '2025-07-10 22:18:33'),
(14, 'nnn', 'nnn', '2025-07-10 22:20:32'),
(15, 'sss', 'sss', '2025-07-10 22:30:53');

-- --------------------------------------------------------

--
-- Table structure for table `user_progress`
--

CREATE TABLE `user_progress` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL,
  `topic_id` int(11) DEFAULT NULL,
  `watched` tinyint(1) DEFAULT 0,
  `watched_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_progress`
--

INSERT INTO `user_progress` (`id`, `user_id`, `course_id`, `topic_id`, `watched`, `watched_at`) VALUES
(1, 15, 1, 1, 1, '2025-07-10 23:45:00'),
(2, 15, NULL, NULL, 1, '2025-07-10 23:45:58'),
(3, 15, 1, 2, 1, '2025-07-11 00:04:43'),
(4, 15, 1, 3, 1, '2025-07-11 00:08:56'),
(5, 15, 1, 4, 1, '2025-07-11 00:10:22'),
(6, 15, 1, 5, 1, '2025-07-11 00:10:36'),
(7, 15, 1, 6, 1, '2025-07-11 00:10:46'),
(8, 15, 1, 7, 1, '2025-07-11 00:10:56'),
(9, 15, 1, 8, 1, '2025-07-11 00:11:05'),
(10, 15, 1, 9, 1, '2025-07-11 00:11:23'),
(11, 15, 1, 10, 1, '2025-07-11 00:11:34'),
(12, 15, 3, 24, 1, '2025-07-11 13:41:07'),
(13, 15, 2, 13, 1, '2025-07-11 13:49:37'),
(14, 15, 2, 14, 1, '2025-07-11 13:49:41'),
(15, 15, 2, 15, 1, '2025-07-11 13:49:43'),
(16, 15, 2, 16, 1, '2025-07-11 13:49:45'),
(17, 15, 2, 17, 1, '2025-07-11 13:49:48'),
(18, 15, 2, 18, 1, '2025-07-11 13:49:51'),
(19, 15, 2, 19, 1, '2025-07-11 13:50:27'),
(20, 15, 2, 20, 1, '2025-07-11 13:50:31'),
(21, 15, 2, 21, 1, '2025-07-11 13:50:35');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `certificates`
--
ALTER TABLE `certificates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_certificate` (`user_id`,`course_id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `course_topics`
--
ALTER TABLE `course_topics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enrollments`
--
ALTER TABLE `enrollments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quiz_questions`
--
ALTER TABLE `quiz_questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quiz_results`
--
ALTER TABLE `quiz_results`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_progress`
--
ALTER TABLE `user_progress`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `certificates`
--
ALTER TABLE `certificates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `course_topics`
--
ALTER TABLE `course_topics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `enrollments`
--
ALTER TABLE `enrollments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `quiz_questions`
--
ALTER TABLE `quiz_questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `quiz_results`
--
ALTER TABLE `quiz_results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `user_progress`
--
ALTER TABLE `user_progress`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
