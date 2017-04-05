-- phpMyAdmin SQL Dump
-- version 4.0.10
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Апр 05 2017 г., 11:41
-- Версия сервера: 5.5.38-log
-- Версия PHP: 5.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `db_bludo`
--

-- --------------------------------------------------------

--
-- Структура таблицы `bludo`
--

CREATE TABLE IF NOT EXISTS `bludo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bludo_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `hidden` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Дамп данных таблицы `bludo`
--

INSERT INTO `bludo` (`id`, `bludo_name`, `hidden`) VALUES
(1, 'plov', 0),
(2, 'kebab', 0),
(3, 'soup', 1),
(4, 'pelmeni', 1),
(6, 'rollton', 1),
(8, 'bla bla bla', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `bludo_ingredient`
--

CREATE TABLE IF NOT EXISTS `bludo_ingredient` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bludo_id` int(11) DEFAULT NULL,
  `ingred_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_bludo` (`bludo_id`),
  KEY `FK_ingred` (`ingred_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=40 ;

--
-- Дамп данных таблицы `bludo_ingredient`
--

INSERT INTO `bludo_ingredient` (`id`, `bludo_id`, `ingred_id`) VALUES
(5, 2, 1),
(6, 2, 5),
(7, 1, 1),
(8, 1, 2),
(9, 1, 3),
(11, 3, 1),
(12, 3, 4),
(13, 3, 6),
(32, 4, 1),
(33, 4, 3),
(34, 4, 4),
(35, 4, 7),
(36, 8, 1),
(37, 8, 9),
(38, 6, 4),
(39, 6, 7);

-- --------------------------------------------------------

--
-- Структура таблицы `ingredient`
--

CREATE TABLE IF NOT EXISTS `ingredient` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ingred_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `hidden` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

--
-- Дамп данных таблицы `ingredient`
--

INSERT INTO `ingredient` (`id`, `ingred_name`, `hidden`) VALUES
(1, 'myaso', 0),
(2, 'ris', 0),
(3, 'morkov', 0),
(4, 'voda', 1),
(5, 'uksus', 0),
(6, 'luk', 0),
(7, 'lapsha', 0),
(9, 'bla-bla-bla', 0);

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `bludo_ingredient`
--
ALTER TABLE `bludo_ingredient`
  ADD CONSTRAINT `FK_ingred_bludo` FOREIGN KEY (`ingred_id`) REFERENCES `ingredient` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_bludo_ingred` FOREIGN KEY (`bludo_id`) REFERENCES `bludo` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
