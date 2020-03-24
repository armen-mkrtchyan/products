-- phpMyAdmin SQL Dump
-- version 4.4.15.7
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Мар 24 2020 г., 21:01
-- Версия сервера: 5.7.13
-- Версия PHP: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `user`
--

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  `update_time` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `name`, `create_time`, `update_time`) VALUES
(1, 'Auto', '2020-03-18 13:22:45', '2020-03-18 09:22:45'),
(2, 'Phone', '2020-03-18 13:22:52', '2020-03-18 09:22:52'),
(3, 'Tv', '2020-03-18 18:57:08', '2020-03-18 14:57:08'),
(4, 'Bmw', '2020-03-24 21:54:43', '2020-03-24 17:54:43'),
(5, 'OPel', '2020-03-24 21:54:47', '2020-03-24 17:54:47'),
(6, 'bmw', '2020-03-24 21:54:58', '2020-03-24 17:54:58'),
(7, 'OPel', '2020-03-24 21:55:07', '2020-03-24 17:55:07');

-- --------------------------------------------------------

--
-- Структура таблицы `models`
--

CREATE TABLE IF NOT EXISTS `models` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `create_time` date DEFAULT NULL,
  `update_time` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `models`
--

INSERT INTO `models` (`id`, `name`, `category_id`, `create_time`, `update_time`) VALUES
(2, 'Bmw', 1, '2020-03-18', '2020-03-18 09:24:05'),
(7, 'infiniti', 1, '2020-03-18', '2020-03-18 10:16:08'),
(8, 'Maybach', 1, '2020-03-18', '2020-03-18 14:34:28'),
(9, 'Mazda', 1, '2020-03-18', '2020-03-18 14:34:40'),
(10, 'Rolls-Royce', 1, '2020-03-18', '2020-03-18 14:34:46'),
(11, 'Nissan', 1, '2020-03-18', '2020-03-18 14:35:22'),
(12, 'Lexus', 1, '2020-03-18', '2020-03-18 14:35:27'),
(13, 'Kia', 1, '2020-03-18', '2020-03-18 14:35:33'),
(14, 'Lada', 1, '2020-03-18', '2020-03-18 14:35:39'),
(15, 'Volga', 1, '2020-03-18', '2020-03-18 14:35:45'),
(16, 'Toyota', 1, '2020-03-18', '2020-03-18 14:40:00'),
(17, 'Mercedes', 1, '2020-03-18', '2020-03-18 14:56:29'),
(18, 'Iphone X', 2, '2020-03-20', '2020-03-20 11:14:44');

-- --------------------------------------------------------

--
-- Структура таблицы `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) unsigned NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `model_id` int(11) DEFAULT NULL,
  `img_path` varchar(255) DEFAULT NULL,
  `isNew` tinyint(1) DEFAULT NULL,
  `desc_info` text,
  `price` int(11) DEFAULT NULL,
  `create_time` date DEFAULT NULL,
  `update_time` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `product`
--

INSERT INTO `product` (`id`, `name`, `category_id`, `model_id`, `img_path`, `isNew`, `desc_info`, `price`, `create_time`, `update_time`) VALUES
(16, 'Telephone', 2, 18, 'img/tel.jpg', 1, '24 meagpixel', 1000, '2020-03-23', '2020-03-23 07:47:50'),
(19, 'jk', 1, 2, 'jkbkj', 0, 'kljnkl', 5, '2020-03-24', '2020-03-24 17:56:01'),
(20, 'dfgds', 1, 2, 'dsfsd', 1, 'fdsf', 5445, '2020-03-24', '2020-03-24 17:56:12'),
(22, 't', 1, 12, 'tgt', 0, 'gtgt', 595, '2020-03-24', '2020-03-24 17:58:27');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(5) unsigned NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `cookie_key` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `cookie_key`) VALUES
(1, 'admin', '123', 'b34x1i3r40e65z72w39d15s27n50v');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `models`
--
ALTER TABLE `models`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Индексы таблицы `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `model_id` (`model_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT для таблицы `models`
--
ALTER TABLE `models`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT для таблицы `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(5) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `models`
--
ALTER TABLE `models`
  ADD CONSTRAINT `models_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`model_id`) REFERENCES `models` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
