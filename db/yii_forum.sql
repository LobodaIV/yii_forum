-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Авг 21 2017 г., 12:31
-- Версия сервера: 5.5.53
-- Версия PHP: 5.6.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `yii_forum`
--
CREATE DATABASE IF NOT EXISTS `yii_forum` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `yii_forum`;

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `slug` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`category_id`, `name`, `description`, `slug`) VALUES
(1, 'Web Programming', 'topics about web programming', 'web-programming'),
(2, 'Web Design', 'topics about web design', 'web-design');

-- --------------------------------------------------------

--
-- Структура таблицы `replies`
--

DROP TABLE IF EXISTS `replies`;
CREATE TABLE `replies` (
  `reply_id` int(11) NOT NULL,
  `topic_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `body` text NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `replies`
--

INSERT INTO `replies` (`reply_id`, `topic_id`, `user_id`, `body`, `create_date`) VALUES
(1, 1, 1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce lacinia leo eu magna sodales cursus. Donec justo quam, ultricies a accumsan non, imperdiet a sem. Aliquam erat volutpat. Phasellus sit amet turpis mi. Donec at leo eu neque scelerisque consequat eu et lacus. Nunc ornare bibendum est, sit amet pharetra velit interdum id. Integer finibus massa nisi, id fringilla odio venenatis quis. Curabitur a venenatis velit, sagittis auctor arcu. Mauris vitae enim tincidunt, pharetra tellus eget, vulputate ex. Maecenas eu ultricies urna. Vestibulum pharetra arcu a tellus rutrum facilisis.', '2017-08-09 08:06:57'),
(2, 1, 2, 'Lorem ipsum', '2017-08-09 08:06:57'),
(5, 3, 3, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce lacinia leo eu magna sodales cursus. Donec justo quam, ultricies a accumsan non, imperdiet a sem. Aliquam erat volutpat. Phasellus sit amet turpis mi. Donec at leo eu neque scelerisque consequat eu et lacus. Nunc ornare bibendum est, sit amet pharetra velit interdum id. Integer finibus massa nisi, id fringilla odio venenatis quis. Curabitur a venenatis velit, sagittis auctor arcu. Mauris vitae enim tincidunt, pharetra tellus eget, vulputate ex. Maecenas eu ultricies urna. Vestibulum pharetra arcu a tellus rutrum facilisis.', '2017-08-09 08:33:31'),
(6, 1, 2, 'new reply', '2017-08-12 21:57:08'),
(7, 1, 1, '<p>\r\n	test</p>\r\n', '2017-08-12 22:53:19'),
(11, 24, 22, '<p>\r\n	new reply from newbi</p>\r\n', '2017-08-14 11:37:06'),
(12, 24, 1, '<p>\r\n	reply for newbi from igorl</p>\r\n', '2017-08-14 11:38:08'),
(13, 24, 2, '<p>\r\n	new reply from andyB to topic</p>\r\n', '2017-08-14 11:39:52'),
(15, 22, 1, '<p>\r\n	agree</p>\r\n', '2017-08-16 15:44:14'),
(16, 1, 1, '<p>\r\n	qwereghdfds</p>\r\n', '2017-08-16 18:33:43'),
(17, 3, 1, '<p>\r\n	okey</p>\r\n', '2017-08-16 18:34:14'),
(18, 1, 1, '<p>\r\n	new rpely</p>\r\n', '2017-08-16 19:37:32'),
(19, 1, 34, '<p>\r\n	new reply</p>\r\n', '2017-08-18 16:46:48');

-- --------------------------------------------------------

--
-- Структура таблицы `topics`
--

DROP TABLE IF EXISTS `topics`;
CREATE TABLE `topics` (
  `topic_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `body` text NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `topics`
--

INSERT INTO `topics` (`topic_id`, `category_id`, `user_id`, `title`, `body`, `create_date`) VALUES
(1, 1, 1, 'How can I learn PHP right?', '<p>\r\n	Hello, so here the main question. How can I learn PHP right? Today we have a lot of courses and so on however how is right?</p>\r\n', '2017-08-02 16:04:56'),
(3, 1, 2, 'New features in PHP 7', 'Hello,\r\n\r\nlet\'s discuss what\'s new in PHP 7\r\n', '2017-08-09 05:43:15'),
(8, 1, 1, 'new header from topics management', '<p>\r\n	tests</p>\r\n', '2017-08-10 20:48:29'),
(13, 1, 1, 'New way to learn HTML and CSS!', '<p>\r\n	But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful.</p>\r\n', '2017-08-10 22:56:56'),
(22, 2, 1, 'New features in CSS3', '<p>\r\n	The list of new features in css3</p>\r\n<ul>\r\n	<li>\r\n		animation</li>\r\n	<li>\r\n		transition</li>\r\n	<li>\r\n		semantics</li>\r\n</ul>\r\n', '2017-08-12 20:15:05'),
(24, 1, 1, 'topic', '<p>\r\n	reply in topic</p>\r\n', '2017-08-14 11:35:52'),
(25, 2, 2, 'new topic from darth vader', '<p>\r\n	new topic about design</p>\r\n', '2017-08-18 16:52:59');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `avatar` varchar(100) NOT NULL DEFAULT 'default.png',
  `username` varchar(20) NOT NULL,
  `password` varchar(64) NOT NULL,
  `about` text NOT NULL,
  `join_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `role` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `avatar`, `username`, `password`, `about`, `join_date`, `role`) VALUES
(1, 'Igor Loboda', 'igorl@gmail.com', 'photo.png', 'igorl', '$2y$13$PcAbyqnpS5xdoZ3U4xcjrez2CXgv77I0cvHQww2kfO.KloqkSQgnq', 'some text about', '2017-08-16 07:26:13', 'm'),
(2, 'Andy Brook', 'andy@gmail.com', 'darth-vader.png', 'andyB', '$2y$13$8MhHqB7YNAsOgtxpVh0TeO0TLq1atugk5t5lTCrbo6FPCNIpZjnL6', 'my name is Andy Brook', '2017-08-18 16:52:12', 'm'),
(3, 'John', 'john@gmail.com', 'default.png', 'john', '$2y$13$9uf8BejERxiy0S2euBT6.OL4ZxEG58SmwF8ePgNhu4b8aKAUrQD1a', 'my info', '2017-08-16 12:13:12', 'a'),
(22, 'new user', 'newbi@gmail.com', 'default.png', 'newbi', '$2y$13$X3jSb1IEr3mUT6DRe1MgxO5/LYTdJwG99M89f/dFJDbMDuyihyQpS', '', '2017-08-18 16:56:17', 'a'),
(27, 'addy brown', 'addy@example.com', 'darth-vader.png', 'addy', '$2y$13$WlvWeIWc.pjfEWefgwTWJeVA25WQno0OUgeM3Lxi3mtZSR/KUksbq', '', '2017-08-18 16:49:55', 'a'),
(34, 'user10', 'user10@example.com', 'darth-vader.png', 'user10', '$2y$13$T8jTFIX0NOhODLHZiBMgnOojz7vmOpZuQ7ujCNWnTZStwlGETD/XC', '', '2017-08-18 16:48:32', 'e');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Индексы таблицы `replies`
--
ALTER TABLE `replies`
  ADD PRIMARY KEY (`reply_id`),
  ADD KEY `topic_id` (`topic_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`topic_id`),
  ADD KEY `categoryId` (`category_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `replies`
--
ALTER TABLE `replies`
  MODIFY `reply_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT для таблицы `topics`
--
ALTER TABLE `topics`
  MODIFY `topic_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `replies`
--
ALTER TABLE `replies`
  ADD CONSTRAINT `replies_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `replies_ibfk_2` FOREIGN KEY (`topic_id`) REFERENCES `topics` (`topic_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `topics`
--
ALTER TABLE `topics`
  ADD CONSTRAINT `topics_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `topics_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
