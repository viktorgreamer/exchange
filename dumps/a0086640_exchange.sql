-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июл 20 2019 г., 11:20
-- Версия сервера: 5.6.41
-- Версия PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `a0086640_exchange`
--

-- --------------------------------------------------------

--
-- Структура таблицы `auth`
--

CREATE TABLE `auth` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `source` varchar(255) NOT NULL,
  `source_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `auth_assignment`
--

CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('admin', '1', 1563608574);

-- --------------------------------------------------------

--
-- Структура таблицы `auth_item`
--

CREATE TABLE `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('admin', 1, NULL, NULL, NULL, 1563608574, 1563608574),
('entity', 1, NULL, NULL, NULL, 1563608574, 1563608574),
('managePoint', 2, 'Manage an exchange point', NULL, NULL, 1563608574, 1563608574);

-- --------------------------------------------------------

--
-- Структура таблицы `auth_item_child`
--

CREATE TABLE `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `auth_item_child`
--

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('admin', 'entity'),
('admin', 'managePoint'),
('entity', 'managePoint');

-- --------------------------------------------------------

--
-- Структура таблицы `auth_rule`
--

CREATE TABLE `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `cities`
--

CREATE TABLE `cities` (
  `id` int(11) NOT NULL COMMENT 'id',
  `name` varchar(256) DEFAULT NULL COMMENT 'Наименование'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `cities`
--

INSERT INTO `cities` (`id`, `name`) VALUES
(1, 'Киев'),
(2, 'Харьков'),
(3, 'Одесса'),
(4, 'Львов');

-- --------------------------------------------------------

--
-- Структура таблицы `currencies`
--

CREATE TABLE `currencies` (
  `id` int(11) NOT NULL COMMENT 'id',
  `name` varchar(255) DEFAULT NULL COMMENT 'Наименование',
  `mark` varchar(10) NOT NULL COMMENT 'Краткое обозначение'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `currencies`
--

INSERT INTO `currencies` (`id`, `name`, `mark`) VALUES
(1, 'Рубль', 'RUB'),
(2, 'Доллар США', 'USD'),
(3, 'ЕВРО', 'EUR'),
(4, 'Гривна', 'UAH'),
(5, 'Польской злотый', 'PLN'),
(6, 'Беларусский рубль', 'BYR');

-- --------------------------------------------------------

--
-- Структура таблицы `entities`
--

CREATE TABLE `entities` (
  `id` int(11) NOT NULL COMMENT 'id',
  `user_id` int(11) NOT NULL COMMENT 'id Пользователя',
  `name` varchar(256) NOT NULL COMMENT 'Наименование',
  `has_one_currency` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Единый курс',
  `has_one_opening_hours` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Единый график работы',
  `phone` varchar(30) DEFAULT NULL COMMENT 'Телефон',
  `status` int(1) DEFAULT NULL COMMENT 'Статус'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `entities`
--

INSERT INTO `entities` (`id`, `user_id`, `name`, `has_one_currency`, `has_one_opening_hours`, `phone`, `status`) VALUES
(1, 1, 'Лям баксов', 1, 1, '+898889457789877', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `exchange_points`
--

CREATE TABLE `exchange_points` (
  `id` int(11) NOT NULL COMMENT 'id',
  `address` varchar(256) DEFAULT NULL COMMENT 'Адрес',
  `latitude` float DEFAULT NULL COMMENT 'Широта',
  `longitude` float DEFAULT NULL COMMENT 'Долгота',
  `entity_id` int(11) NOT NULL COMMENT 'Юрлицо',
  `city_id` int(11) NOT NULL COMMENT 'Город',
  `region_id` int(11) NOT NULL COMMENT 'Район',
  `phone1` varchar(20) DEFAULT NULL COMMENT 'Телефон1',
  `phone2` varchar(20) DEFAULT NULL COMMENT 'Телефон2',
  `name` varchar(256) DEFAULT NULL COMMENT 'Наименование',
  `link` varchar(256) DEFAULT NULL COMMENT 'Ссылка на сайт',
  `status` int(1) DEFAULT NULL COMMENT 'Статус',
  `rating` float DEFAULT NULL COMMENT 'Рейтинг',
  `rating_geo` float DEFAULT NULL COMMENT 'Рейтинг расположения',
  `rating_actuality` float DEFAULT NULL COMMENT 'Рейтинг актуальности курса',
  `rating_service` float DEFAULT NULL COMMENT 'Рейтинг обслуживания',
  `main` tinyint(1) DEFAULT NULL COMMENT 'Главная точка'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `exchange_points`
--

INSERT INTO `exchange_points` (`id`, `address`, `latitude`, `longitude`, `entity_id`, `city_id`, `region_id`, `phone1`, `phone2`, `name`, `link`, `status`, `rating`, `rating_geo`, `rating_actuality`, `rating_service`, `main`) VALUES
(1, 'вулиця Антоновича, 50, Київ, Украина,', NULL, NULL, 1, 1, 1, '+79374054140', '+79374054140', 'Лям Баксов', 'http://ffru.com.ua/', NULL, NULL, NULL, NULL, NULL, 1),
(2, 'Волотовская д. 8', NULL, NULL, 1, 1, 2, '89632409945', '89632409945', 'Лям Баксов2', 'http://ffru.com.ua/', NULL, NULL, NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `exchange_rates`
--

CREATE TABLE `exchange_rates` (
  `id` int(11) NOT NULL COMMENT 'id',
  `point_id` int(11) DEFAULT NULL COMMENT 'Точка обмена',
  `pair_id` int(11) DEFAULT NULL COMMENT 'Валюты',
  `status` int(1) DEFAULT NULL COMMENT 'Статус',
  `buy` float DEFAULT NULL COMMENT 'Цена покупки',
  `sell` float DEFAULT NULL COMMENT 'Цена прожи',
  `created_at` int(11) NOT NULL COMMENT 'Создан в',
  `updated_at` int(11) NOT NULL COMMENT 'Обновлен в'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `exchange_rates`
--

INSERT INTO `exchange_rates` (`id`, `point_id`, `pair_id`, `status`, `buy`, `sell`, `created_at`, `updated_at`) VALUES
(1, 1, 2, NULL, 12.34, 34.45, 1563602862, 1563602879),
(2, 1, 3, NULL, 12.4, 45.67, 1563602862, 1563602879),
(3, 1, 4, NULL, 35.66, 34.55, 1563602862, 1563602879),
(4, 2, 2, NULL, 12.34, 34.45, 1563606072, 1563606072),
(5, 2, 3, NULL, 12.4, 45.67, 1563606072, 1563606072),
(6, 2, 4, NULL, 35.66, 34.55, 1563606072, 1563606072);

-- --------------------------------------------------------

--
-- Структура таблицы `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1563513081),
('m130524_201442_init', 1563513085),
('m140506_102106_rbac_init', 1563514789),
('m170907_052038_rbac_add_index_on_auth_assignment_user_id', 1563514789),
('m180523_151638_rbac_updates_indexes_without_prefix', 1563514789),
('m190124_110200_add_verification_token_column_to_user_table', 1563513085),
('m190711_053926_social_user_auth', 1563513085),
('m190718_161510_cities', 1563513085),
('m190718_161511_regions', 1563513086),
('m190718_170000_add_entities', 1563513086),
('m190718_190119_add_exchange_point', 1563513480),
('m190718_200310_add_currencies', 1563513480),
('m190718_200328_add_pairs', 1563513480),
('m190719_034128_create_table_exchange_rates', 1563513481),
('m190719_035703_create_table_opening_hours', 1563513481),
('m190719_041717_create_table_reviews', 1563513481),
('m190719_044409_create_table_request', 1563513481),
('m190719_181931_add_column_description_currencies', 1563560579),
('m190719_184236_fix_currency_id', 1563561919),
('m190720_063457_add_column_main_point_exchange', 1563604636);

-- --------------------------------------------------------

--
-- Структура таблицы `opening_hours`
--

CREATE TABLE `opening_hours` (
  `id` int(11) NOT NULL COMMENT 'id',
  `exchange_point_id` int(11) DEFAULT NULL COMMENT 'Точка обмена',
  `day` int(1) DEFAULT NULL COMMENT 'День недели',
  `time_start` int(7) DEFAULT NULL COMMENT 'Начало',
  `time_end` int(7) DEFAULT NULL COMMENT 'Окончание'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `opening_hours`
--

INSERT INTO `opening_hours` (`id`, `exchange_point_id`, `day`, `time_start`, `time_end`) VALUES
(8, 1, 1, 430, 1055),
(9, 1, 2, 480, 1080),
(10, 1, 3, 480, 1080),
(11, 1, 4, 480, 1080),
(12, 1, 5, 480, 1080),
(13, 1, 6, 480, 1080),
(14, 1, 7, 300, 1080),
(15, NULL, 1, 480, 1080),
(16, NULL, 2, 480, 1080),
(17, NULL, 3, 480, 1080),
(18, NULL, 4, 480, 1080),
(19, NULL, 5, 480, 1080),
(20, NULL, 6, 480, 1080),
(21, NULL, 7, 480, 1080);

-- --------------------------------------------------------

--
-- Структура таблицы `pairs`
--

CREATE TABLE `pairs` (
  `id` int(11) NOT NULL COMMENT 'id',
  `name` varchar(255) DEFAULT NULL COMMENT 'Наименование',
  `currency_from_id` int(3) DEFAULT NULL COMMENT 'С валюта',
  `currency_to_id` int(3) DEFAULT NULL COMMENT 'С валюта'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `pairs`
--

INSERT INTO `pairs` (`id`, `name`, `currency_from_id`, `currency_to_id`) VALUES
(2, 'Доллар/Рубль', 2, 1),
(3, 'Доллар/Евро', 2, 3),
(4, 'Рубль/Гривна', 1, 4),
(5, 'Евро/Гривна', 3, 4),
(6, 'Доллар/Гривна', 2, 4);

-- --------------------------------------------------------

--
-- Структура таблицы `regions`
--

CREATE TABLE `regions` (
  `id` int(11) NOT NULL COMMENT 'id',
  `name` varchar(256) DEFAULT NULL COMMENT 'Наименование',
  `city_id` int(11) NOT NULL COMMENT 'id города'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `regions`
--

INSERT INTO `regions` (`id`, `name`, `city_id`) VALUES
(1, 'Западный', 1),
(2, 'Восточный', 1),
(3, 'Центральный', 1),
(4, 'Южный', 1),
(5, 'Северный', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `request`
--

CREATE TABLE `request` (
  `id` int(11) NOT NULL COMMENT 'id',
  `created_at` int(11) DEFAULT NULL COMMENT 'Создан',
  `reason` int(11) DEFAULT NULL COMMENT 'Причина',
  `user_id` int(11) DEFAULT NULL COMMENT 'Пользователь',
  `body` text NOT NULL COMMENT 'Вопрос',
  `email` varchar(255) DEFAULT NULL COMMENT 'Email'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL COMMENT 'id',
  `user_id` int(11) DEFAULT NULL COMMENT 'Пользователь',
  `created_at` int(11) NOT NULL COMMENT 'Создан',
  `status` int(1) DEFAULT NULL COMMENT 'Статус',
  `rating_geo` int(1) DEFAULT NULL COMMENT 'Рейтинг расположения',
  `rating_actuality` int(1) DEFAULT NULL COMMENT 'Рейтинг актуальности курса',
  `rating_service` int(1) DEFAULT NULL COMMENT 'Рейтинг обслуживания'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `verification_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`, `verification_token`) VALUES
(1, 'admin', '', '$2y$13$oPzjp/0RUIov4hQwFZoAeedjRWq0Vap2GIjBAELEahHy68pGZUNh.', NULL, 'an.viktory@gmail.com', 10, 1563515521, 1563515521, NULL);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `auth`
--
ALTER TABLE `auth`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk-auth-user_id-user-id` (`user_id`);

--
-- Индексы таблицы `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD PRIMARY KEY (`item_name`,`user_id`),
  ADD KEY `idx-auth_assignment-user_id` (`user_id`);

--
-- Индексы таблицы `auth_item`
--
ALTER TABLE `auth_item`
  ADD PRIMARY KEY (`name`),
  ADD KEY `rule_name` (`rule_name`),
  ADD KEY `idx-auth_item-type` (`type`);

--
-- Индексы таблицы `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD PRIMARY KEY (`parent`,`child`),
  ADD KEY `child` (`child`);

--
-- Индексы таблицы `auth_rule`
--
ALTER TABLE `auth_rule`
  ADD PRIMARY KEY (`name`);

--
-- Индексы таблицы `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `entities`
--
ALTER TABLE `entities`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `exchange_points`
--
ALTER TABLE `exchange_points`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx-exchange_points-entity_id` (`entity_id`),
  ADD KEY `idx-exchange_points-city_id` (`city_id`),
  ADD KEY `idx-exchange_points-region_id` (`region_id`) USING BTREE;

--
-- Индексы таблицы `exchange_rates`
--
ALTER TABLE `exchange_rates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx-pair_id` (`pair_id`),
  ADD KEY `idx-point_id` (`point_id`) USING BTREE;

--
-- Индексы таблицы `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Индексы таблицы `opening_hours`
--
ALTER TABLE `opening_hours`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx-exchange_point_id` (`exchange_point_id`);

--
-- Индексы таблицы `pairs`
--
ALTER TABLE `pairs`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `regions`
--
ALTER TABLE `regions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx-city_id` (`city_id`);

--
-- Индексы таблицы `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx-user_id` (`user_id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `auth`
--
ALTER TABLE `auth`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id', AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id', AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `entities`
--
ALTER TABLE `entities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `exchange_points`
--
ALTER TABLE `exchange_points`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `exchange_rates`
--
ALTER TABLE `exchange_rates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id', AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `opening_hours`
--
ALTER TABLE `opening_hours`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id', AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT для таблицы `pairs`
--
ALTER TABLE `pairs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id', AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `regions`
--
ALTER TABLE `regions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id', AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `request`
--
ALTER TABLE `request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id';

--
-- AUTO_INCREMENT для таблицы `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id';

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `auth`
--
ALTER TABLE `auth`
  ADD CONSTRAINT `fk-auth-user_id-user-id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `exchange_points`
--
ALTER TABLE `exchange_points`
  ADD CONSTRAINT `fk-exchange_points-city_id-id` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk-exchange_points-entity_id-id` FOREIGN KEY (`entity_id`) REFERENCES `entities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk-exchange_points-region_id-id` FOREIGN KEY (`region_id`) REFERENCES `regions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `exchange_rates`
--
ALTER TABLE `exchange_rates`
  ADD CONSTRAINT `fk-entity_id-id` FOREIGN KEY (`point_id`) REFERENCES `exchange_points` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk-pair_id-id` FOREIGN KEY (`pair_id`) REFERENCES `pairs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `opening_hours`
--
ALTER TABLE `opening_hours`
  ADD CONSTRAINT `fk-exchange_point_id-id` FOREIGN KEY (`exchange_point_id`) REFERENCES `exchange_points` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `regions`
--
ALTER TABLE `regions`
  ADD CONSTRAINT `fk-city_id-id` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `fk-user_id-id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
