-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 12 2018 г., 14:00
-- Версия сервера: 5.6.37
-- Версия PHP: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `burgers`
--

-- --------------------------------------------------------

--
-- Структура таблицы `order_burger`
--

CREATE TABLE `order_burger` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `street` varchar(25) NOT NULL,
  `home` int(11) NOT NULL,
  `part` varchar(25) NOT NULL,
  `appt` int(11) NOT NULL,
  `floor` int(11) NOT NULL,
  `comment` text NOT NULL,
  `payment1` varchar(11) NOT NULL,
  `payment2` varchar(11) NOT NULL,
  `callback` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `order_burger`
--

INSERT INTO `order_burger` (`id`, `user_id`, `street`, `home`, `part`, `appt`, `floor`, `comment`, `payment1`, `payment2`, `callback`) VALUES
(1, 2, 'abai', 34, '4', 54, 4, 'sdfgsdfgsdfg', '', '', ''),
(2, 2, 'Abai', 34, '4', 54, 6, 'sfsdfasdfasdf', 'on', 'on', 'on'),
(3, 2, 'Abai', 34, '4', 54, 6, 'sfsdfasdfasdf', 'on', 'on', 'on'),
(4, 2, 'Abai', 34, '4', 54, 6, 'sfsdfasdfasdf', 'on', 'on', 'on'),
(5, 1, 'Kutuzov str. 99-29', 23, '23', 3, 3, 'asdfasdfasdf', 'on', 'on', 'on'),
(6, 1, 'Kutuzov str. 99-29', 23, '23', 3, 3, 'asdfasdfasdf', 'on', 'on', 'on'),
(7, 5, 'Kutuzov str. 99-29', 23, '23', 2, 3, 'asdfasdf', 'on', 'on', 'on'),
(8, 5, 'Kutuzov str. 99-29', 23, '23', 2, 3, 'asdfasdf', 'on', 'on', 'on'),
(9, 0, 'Kutuzov str. 99-29', 23, '23', 2, 3, 'asdfasdf', 'on', 'on', 'on'),
(10, 5, 'Kutuzov str. 99-29', 23, '23', 2, 3, 'asdfasdf', 'on', 'on', 'on'),
(11, 10, 'Kutuzov str. 99-29', 23, '23', 2, 3, 'asdfasdf', 'on', 'on', 'on'),
(17, 1, 'Kutuzov str. 99-29', 23, '23', 2, 3, 'asdfasdf', 'on', 'on', 'on'),
(54, 1, 'Kutuzov str. 99-29', 23, '4', 3, 4, 'asdfasdf', 'Yes', 'No', 'No');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(11) NOT NULL,
  `email` varchar(24) NOT NULL,
  `phone` varchar(18) NOT NULL,
  `orderCount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `phone`, `orderCount`) VALUES
(1, 'admin', 'sayat23@mail.ru', '0', 11),
(6, 'Sayat Bazar', 'sayat@mail.ru', '+7 (701) 872 27 89', 0),
(7, 'Sayat Bazar', 'say@mail.ru', '+7 (701) 872 27 89', 0),
(8, 'Sayat Bazar', 'ssss@mail.ru', '+7 (701) 872 27 89', 0),
(10, 'Sayat Bazar', 'asasdsds@mail.ru', '+7 (701) 872 27 89', 0),
(14, 'Sayat Bazar', '123@mail.ru', '+7 (701) 872 27 89', 4),
(15, 'Sayat Bazar', 'asdasdfasdf@mail.ru', '+7 (701) 872 27 89', 1),
(16, 'Sayat Bazar', '23@mail.ru', '+7 (701) 872 27 89', 1);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `order_burger`
--
ALTER TABLE `order_burger`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `order_burger`
--
ALTER TABLE `order_burger`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
