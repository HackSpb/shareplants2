-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Фев 18 2019 г., 11:23
-- Версия сервера: 5.6.41
-- Версия PHP: 5.6.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `share_plants`
--

-- --------------------------------------------------------

--
-- Структура таблицы `adverts`
--

CREATE TABLE `adverts` (
  `advert_id` int(10) UNSIGNED NOT NULL,
  `city_id` int(10) UNSIGNED NOT NULL,
  `catalog_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `landmark_id` int(10) UNSIGNED NOT NULL,
  `advert_name` char(255) NOT NULL,
  `advert_description` text NOT NULL,
  `advert_address` text NOT NULL,
  `advert_condition_id` tinyint(1) UNSIGNED NOT NULL,
  `advert_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `advert_view_count` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `advert_archive` tinyint(1) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `adverts`
--

INSERT INTO `adverts` (`advert_id`, `city_id`, `catalog_id`, `user_id`, `landmark_id`, `advert_name`, `advert_description`, `advert_address`, `advert_condition_id`, `advert_date`, `advert_view_count`, `advert_archive`) VALUES
(1, 1, 10, 1, 1, 'кактус', 'супер кактус', 'чкаловский проспект 15', 3, '2019-02-15 14:48:53', 0, 0),
(11, 1, 5, 1, 1, 'роза', 'выапавп', '', 2, '2019-02-15 17:29:27', 0, 0),
(12, 1, 15, 1, 1, 'горшок', '', '', 1, '2019-02-16 14:13:20', 0, 0),
(13, 1, 5, 1, 1, 'Одуванчик', 'На Василек', '', 1, '2019-02-16 14:19:08', 0, 0),
(17, 1, 5, 1, 2, 'Астра', 'Лютик', '', 1, '2019-02-16 15:52:37', 0, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `adverts_conditions`
--

CREATE TABLE `adverts_conditions` (
  `advert_condition_id` tinyint(1) UNSIGNED NOT NULL,
  `advert_condition_name` char(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `adverts_conditions`
--

INSERT INTO `adverts_conditions` (`advert_condition_id`, `advert_condition_name`) VALUES
(1, 'Бесплатно'),
(2, 'Бонус'),
(3, 'Обмен');

-- --------------------------------------------------------

--
-- Структура таблицы `catalog`
--

CREATE TABLE `catalog` (
  `catalog_id` int(10) UNSIGNED NOT NULL,
  `catalog_parent` int(10) UNSIGNED DEFAULT NULL,
  `catalog_name` char(255) NOT NULL,
  `catalog_description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `catalog`
--

INSERT INTO `catalog` (`catalog_id`, `catalog_parent`, `catalog_name`, `catalog_description`) VALUES
(1, NULL, 'Корень каталога', 'Корень каталога'),
(2, 1, 'Растения', 'Растения'),
(3, 1, 'Услуги', 'Услуги связанные с растениями'),
(4, 1, 'Остальное', 'Все что связано с растениями, но не является ими, и не является услугами.'),
(5, 2, 'Комнатные растения', 'Растения, используемые в качестве декоративных, пригодных для выращивания в жилище и озеленения инте'),
(6, 2, 'Садовые растения', 'Плодовые и ягодные культуры, а также декоративные растения, выращиваемые вне жилых помещений.'),
(7, 2, 'Дикорастущие', 'Растения, за которыми никто не ухаживает, специально не высаживает, не выращивает.'),
(8, 5, 'Цветущие', 'Растения ценящиеся своими цветами.'),
(9, 5, 'Декоративно-лиственные', 'Растения, имеющие оригинальную форму листа и/или его окраску различных оттенков, способные предложит'),
(10, 5, 'Суккуленты', 'Растения, имеющие специальные ткани для запаса воды, поэтому стебли и листья у них плотные и мясисты'),
(11, 5, 'Водные', 'Растущие в воде, они отличаются романтично-фантастическим внешним видом и пышной зеленью.'),
(12, 5, 'Бонсай', 'Искусство выращивания точной копии настоящего (иногда карликового) дерева в миниатюре. Рост растений'),
(13, 4, 'Книги', 'Книги о растениях.'),
(14, 4, 'Удобрения', 'Удобрения для растений.'),
(15, 4, 'Горшки', 'Емкости для растений.'),
(16, 4, 'Семена', 'Семена.'),
(17, 4, 'Другое', 'Все остальное, что связано с растениями.'),
(18, 3, 'Полив', 'Прийти полить, сдуть пыль.'),
(19, 3, 'Аренда', 'Аренда растений.'),
(20, 3, 'Взять на время', 'Взять на время отпуска и т.п.'),
(21, 3, 'Консультации', 'Предоставление информации');

-- --------------------------------------------------------

--
-- Структура таблицы `cities`
--

CREATE TABLE `cities` (
  `city_id` int(10) UNSIGNED NOT NULL,
  `city_name` char(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `cities`
--

INSERT INTO `cities` (`city_id`, `city_name`) VALUES
(1, 'Санкт-Петербург'),
(2, 'Москва');

-- --------------------------------------------------------

--
-- Структура таблицы `connects`
--

CREATE TABLE `connects` (
  `connect_id` int(10) UNSIGNED NOT NULL,
  `connect_session` char(64) NOT NULL,
  `connect_token` char(32) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `connect_token_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `landmarks`
--

CREATE TABLE `landmarks` (
  `landmark_id` int(10) UNSIGNED NOT NULL,
  `city_id` int(10) UNSIGNED NOT NULL,
  `landmark_name` char(255) NOT NULL,
  `landmark_latitude` float NOT NULL,
  `landmark_longitude` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `landmarks`
--

INSERT INTO `landmarks` (`landmark_id`, `city_id`, `landmark_name`, `landmark_latitude`, `landmark_longitude`) VALUES
(1, 1, 'м. Садовая', 59.927, 30.3175),
(2, 1, 'м. Улица Дыбенко', 59.9076, 30.4833);

-- --------------------------------------------------------

--
-- Структура таблицы `pages`
--

CREATE TABLE `pages` (
  `page_id` int(10) UNSIGNED NOT NULL,
  `page_header` char(255) NOT NULL,
  `page_metatitle` char(255) NOT NULL,
  `page_date` datetime NOT NULL,
  `page_text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `parameters`
--

CREATE TABLE `parameters` (
  `param_id` int(10) UNSIGNED NOT NULL,
  `param_name` char(255) NOT NULL,
  `param_type_id` int(10) UNSIGNED NOT NULL,
  `param_min_value` int(10) DEFAULT NULL,
  `param_max_value` int(10) DEFAULT NULL,
  `param_group_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `parameters`
--

INSERT INTO `parameters` (`param_id`, `param_name`, `param_type_id`, `param_min_value`, `param_max_value`, `param_group_id`) VALUES
(1, 'Системный', 5, NULL, NULL, 1),
(2, 'Цвет', 6, NULL, NULL, 1),
(3, 'Высота (см)', 1, 1, 10000, 1),
(4, 'Диаметр (см)', 1, 1, 10000, 1),
(5, 'Внешний вид', 5, NULL, NULL, 1),
(6, 'Температурный режим', 5, NULL, NULL, 2),
(7, 'Режим влажности', 5, NULL, NULL, 2),
(8, 'Требование к освещению', 5, NULL, NULL, 2),
(9, 'Уход', 5, NULL, NULL, 2),
(10, 'Материал', 5, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `parameters_groups`
--

CREATE TABLE `parameters_groups` (
  `param_group_id` int(10) UNSIGNED NOT NULL,
  `param_group_name` char(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `parameters_groups`
--

INSERT INTO `parameters_groups` (`param_group_id`, `param_group_name`) VALUES
(1, 'Общая группа'),
(2, 'Условия');

-- --------------------------------------------------------

--
-- Структура таблицы `parameters_options`
--

CREATE TABLE `parameters_options` (
  `param_option_id` int(10) UNSIGNED NOT NULL,
  `param_id` int(10) UNSIGNED NOT NULL,
  `param_option_name` char(255) NOT NULL,
  `param_option_altername` char(255) DEFAULT NULL COMMENT 'доп. коды или иные обозначения'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `parameters_options`
--

INSERT INTO `parameters_options` (`param_option_id`, `param_id`, `param_option_name`, `param_option_altername`) VALUES
(1, 1, 'Нет опции', NULL),
(2, 5, 'Пряморастущие', ''),
(3, 5, 'Кустарники', ''),
(4, 5, 'Пальмы/Деревья', ''),
(5, 6, 'Теплолюбивые', ''),
(6, 6, 'Холодоустойчивые', ''),
(7, 7, 'Влаголюбивые', ''),
(8, 7, 'Засухоустойчивые', ''),
(9, 8, 'Солнцелюбивые', ''),
(10, 8, 'Теневыносливые', ''),
(11, 9, 'Сложные в уходе', ''),
(12, 9, 'Неприхотливые', ''),
(13, 2, 'Красный', '#F00'),
(14, 2, 'Черный', '#000'),
(15, 2, 'Белый', '#FFF'),
(16, 2, 'Жёлтый', '#FFFF00'),
(17, 2, 'Синий', '#00F'),
(18, 2, 'Фиолетовый', '#800080'),
(19, 10, 'Керамика', NULL),
(20, 10, 'Пластик', NULL),
(21, 10, 'Стекло', NULL),
(22, 10, 'Камень', NULL),
(23, 5, 'Плетистые', '');

-- --------------------------------------------------------

--
-- Структура таблицы `parameters_types`
--

CREATE TABLE `parameters_types` (
  `param_type_id` int(10) UNSIGNED NOT NULL,
  `param_type_name` char(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `parameters_types`
--

INSERT INTO `parameters_types` (`param_type_id`, `param_type_name`) VALUES
(1, 'число'),
(2, 'произвольная строка'),
(3, 'radio button'),
(4, 'checkbox'),
(5, 'select'),
(6, 'color');

-- --------------------------------------------------------

--
-- Структура таблицы `parameters_values`
--

CREATE TABLE `parameters_values` (
  `param_value_id` int(10) UNSIGNED NOT NULL,
  `param_id` int(10) UNSIGNED NOT NULL,
  `param_value_int` int(10) NOT NULL,
  `param_value_str` char(255) NOT NULL,
  `param_option_id` int(10) UNSIGNED NOT NULL,
  `advert_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `parameters_values`
--

INSERT INTO `parameters_values` (`param_value_id`, `param_id`, `param_value_int`, `param_value_str`, `param_option_id`, `advert_id`) VALUES
(3, 3, 17, '0', 1, 11),
(4, 5, 0, '0', 2, 11),
(5, 2, 0, '0', 13, 1),
(6, 2, 0, '0', 18, 1),
(7, 3, 70, '0', 1, 1),
(8, 4, 10, '0', 1, 1),
(9, 5, 0, '0', 2, 1),
(10, 6, 0, '0', 6, 1),
(11, 7, 0, '0', 8, 1),
(12, 8, 0, '0', 10, 1),
(13, 9, 0, '0', 11, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `parameter_catalog`
--

CREATE TABLE `parameter_catalog` (
  `param_id` int(10) UNSIGNED NOT NULL,
  `catalog_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='разные параметры к разным каталогам';

--
-- Дамп данных таблицы `parameter_catalog`
--

INSERT INTO `parameter_catalog` (`param_id`, `catalog_id`) VALUES
(2, 2),
(3, 2),
(4, 2),
(5, 2),
(6, 2),
(7, 2),
(8, 2),
(9, 2),
(2, 4),
(10, 15);

-- --------------------------------------------------------

--
-- Структура таблицы `photos`
--

CREATE TABLE `photos` (
  `photo_id` int(10) UNSIGNED NOT NULL,
  `advert_id` int(10) UNSIGNED NOT NULL,
  `photo_file` char(30) NOT NULL,
  `photo_description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `user_ava` char(30) DEFAULT NULL,
  `user_firstname` char(255) NOT NULL,
  `user_lastname` char(255) NOT NULL,
  `user_gender` tinyint(1) NOT NULL DEFAULT '0',
  `user_login` char(255) NOT NULL,
  `user_password` char(32) NOT NULL,
  `city_id` int(10) UNSIGNED NOT NULL,
  `user_address` char(255) NOT NULL,
  `user_email` char(255) NOT NULL,
  `user_phone` char(11) DEFAULT NULL,
  `user_is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `user_vk` char(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`user_id`, `user_ava`, `user_firstname`, `user_lastname`, `user_gender`, `user_login`, `user_password`, `city_id`, `user_address`, `user_email`, `user_phone`, `user_is_admin`, `user_vk`) VALUES
(1, NULL, 'Админ', 'Админов', 0, 'admin', 'admin', 1, 'Санкт-Петербург', 'admin@admin.ru', '+7121569111', 1, 'loginvk');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `adverts`
--
ALTER TABLE `adverts`
  ADD PRIMARY KEY (`advert_id`),
  ADD KEY `city_id` (`city_id`),
  ADD KEY `catalog_id` (`catalog_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `landmark_id` (`landmark_id`),
  ADD KEY `advert_condition_id` (`advert_condition_id`);

--
-- Индексы таблицы `adverts_conditions`
--
ALTER TABLE `adverts_conditions`
  ADD UNIQUE KEY `advert_condition_id` (`advert_condition_id`);

--
-- Индексы таблицы `catalog`
--
ALTER TABLE `catalog`
  ADD PRIMARY KEY (`catalog_id`);

--
-- Индексы таблицы `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`city_id`);

--
-- Индексы таблицы `connects`
--
ALTER TABLE `connects`
  ADD PRIMARY KEY (`connect_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `landmarks`
--
ALTER TABLE `landmarks`
  ADD PRIMARY KEY (`landmark_id`),
  ADD KEY `city_id` (`city_id`);

--
-- Индексы таблицы `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`page_id`);

--
-- Индексы таблицы `parameters`
--
ALTER TABLE `parameters`
  ADD PRIMARY KEY (`param_id`),
  ADD KEY `param_type_id` (`param_type_id`),
  ADD KEY `param_group_id` (`param_group_id`);

--
-- Индексы таблицы `parameters_groups`
--
ALTER TABLE `parameters_groups`
  ADD PRIMARY KEY (`param_group_id`);

--
-- Индексы таблицы `parameters_options`
--
ALTER TABLE `parameters_options`
  ADD PRIMARY KEY (`param_option_id`),
  ADD KEY `param_id` (`param_id`);

--
-- Индексы таблицы `parameters_types`
--
ALTER TABLE `parameters_types`
  ADD PRIMARY KEY (`param_type_id`);

--
-- Индексы таблицы `parameters_values`
--
ALTER TABLE `parameters_values`
  ADD PRIMARY KEY (`param_value_id`),
  ADD KEY `param_id` (`param_id`),
  ADD KEY `param_option_id` (`param_option_id`),
  ADD KEY `advert_id` (`advert_id`);

--
-- Индексы таблицы `parameter_catalog`
--
ALTER TABLE `parameter_catalog`
  ADD UNIQUE KEY `parametr_id` (`param_id`,`catalog_id`),
  ADD KEY `catalog_id` (`catalog_id`);

--
-- Индексы таблицы `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`photo_id`),
  ADD KEY `advert_id` (`advert_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `city_id` (`city_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `adverts`
--
ALTER TABLE `adverts`
  MODIFY `advert_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT для таблицы `adverts_conditions`
--
ALTER TABLE `adverts_conditions`
  MODIFY `advert_condition_id` tinyint(1) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `catalog`
--
ALTER TABLE `catalog`
  MODIFY `catalog_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT для таблицы `cities`
--
ALTER TABLE `cities`
  MODIFY `city_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `connects`
--
ALTER TABLE `connects`
  MODIFY `connect_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `landmarks`
--
ALTER TABLE `landmarks`
  MODIFY `landmark_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `pages`
--
ALTER TABLE `pages`
  MODIFY `page_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `parameters`
--
ALTER TABLE `parameters`
  MODIFY `param_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `parameters_groups`
--
ALTER TABLE `parameters_groups`
  MODIFY `param_group_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `parameters_options`
--
ALTER TABLE `parameters_options`
  MODIFY `param_option_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT для таблицы `parameters_types`
--
ALTER TABLE `parameters_types`
  MODIFY `param_type_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `parameters_values`
--
ALTER TABLE `parameters_values`
  MODIFY `param_value_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `photos`
--
ALTER TABLE `photos`
  MODIFY `photo_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `adverts`
--
ALTER TABLE `adverts`
  ADD CONSTRAINT `adverts_ibfk_1` FOREIGN KEY (`catalog_id`) REFERENCES `catalog` (`catalog_id`),
  ADD CONSTRAINT `adverts_ibfk_2` FOREIGN KEY (`city_id`) REFERENCES `cities` (`city_id`),
  ADD CONSTRAINT `adverts_ibfk_3` FOREIGN KEY (`landmark_id`) REFERENCES `landmarks` (`landmark_id`),
  ADD CONSTRAINT `adverts_ibfk_4` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `adverts_ibfk_5` FOREIGN KEY (`advert_condition_id`) REFERENCES `adverts_conditions` (`advert_condition_id`);

--
-- Ограничения внешнего ключа таблицы `connects`
--
ALTER TABLE `connects`
  ADD CONSTRAINT `connects_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Ограничения внешнего ключа таблицы `landmarks`
--
ALTER TABLE `landmarks`
  ADD CONSTRAINT `landmarks_ibfk_1` FOREIGN KEY (`city_id`) REFERENCES `cities` (`city_id`);

--
-- Ограничения внешнего ключа таблицы `parameters`
--
ALTER TABLE `parameters`
  ADD CONSTRAINT `parameters_ibfk_1` FOREIGN KEY (`param_group_id`) REFERENCES `parameters_groups` (`param_group_id`),
  ADD CONSTRAINT `parameters_ibfk_2` FOREIGN KEY (`param_type_id`) REFERENCES `parameters_types` (`param_type_id`);

--
-- Ограничения внешнего ключа таблицы `parameters_options`
--
ALTER TABLE `parameters_options`
  ADD CONSTRAINT `parameters_options_ibfk_1` FOREIGN KEY (`param_id`) REFERENCES `parameters` (`param_id`);

--
-- Ограничения внешнего ключа таблицы `parameters_values`
--
ALTER TABLE `parameters_values`
  ADD CONSTRAINT `parameters_values_ibfk_1` FOREIGN KEY (`param_id`) REFERENCES `parameters` (`param_id`),
  ADD CONSTRAINT `parameters_values_ibfk_2` FOREIGN KEY (`param_option_id`) REFERENCES `parameters_options` (`param_option_id`),
  ADD CONSTRAINT `parameters_values_ibfk_3` FOREIGN KEY (`advert_id`) REFERENCES `adverts` (`advert_id`);

--
-- Ограничения внешнего ключа таблицы `parameter_catalog`
--
ALTER TABLE `parameter_catalog`
  ADD CONSTRAINT `parameter_catalog_ibfk_1` FOREIGN KEY (`param_id`) REFERENCES `parameters` (`param_id`),
  ADD CONSTRAINT `parameter_catalog_ibfk_2` FOREIGN KEY (`catalog_id`) REFERENCES `catalog` (`catalog_id`);

--
-- Ограничения внешнего ключа таблицы `photos`
--
ALTER TABLE `photos`
  ADD CONSTRAINT `photos_ibfk_1` FOREIGN KEY (`advert_id`) REFERENCES `adverts` (`advert_id`);

--
-- Ограничения внешнего ключа таблицы `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`city_id`) REFERENCES `cities` (`city_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
