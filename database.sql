-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Июн 09 2015 г., 01:12
-- Версия сервера: 5.5.43
-- Версия PHP: 5.5.25-1+deb.sury.org~precise+2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `skyeng`
--

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(40) NOT NULL,
  `status` varchar(20) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `username`, `status`, `phone`, `time`) VALUES
(1, 'ardakshalkar', 'unavailable', '870002323', '2015-06-07 20:17:36'),
(13, 'malikmalik', 'rejected', '322332', '2015-06-07 20:30:08'),
(14, 'malikmalik', 'rejected', '322332', '2015-06-07 21:45:27'),
(15, 'asdfasdf', 'registered', '3223', '2015-06-06 07:00:00'),
(16, 'asdfasf', 'registered', '233223', '2015-06-06 00:00:00'),
(17, 'ardaksh', 'registered', '3233223', '2015-06-01 00:00:00'),
(18, 'llelele', 'rejected', '', '2015-06-25 00:00:00'),
(19, 'wewewe', 'registered', '', '2015-07-16 00:00:00'),
(20, '', 'rejected', '', '2015-07-18 00:00:00');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
