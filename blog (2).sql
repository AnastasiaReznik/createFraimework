-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Мар 11 2021 г., 19:19
-- Версия сервера: 10.3.13-MariaDB-log
-- Версия PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `blog`
--

-- --------------------------------------------------------

--
-- Структура таблицы `admins`
--

CREATE TABLE `admins` (
  `id` int(10) UNSIGNED NOT NULL,
  `login` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `admins`
--

INSERT INTO `admins` (`id`, `login`, `password`) VALUES
(1, 'admin', '$2y$10$1Vf4QK.scmiRC8HJlMbxuOKPqpBpjNF3upZaz.ZkQM.WkWF2OX2ri');

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alias` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `name`, `alias`) VALUES
(1, 'webDesign', 'web-design'),
(2, 'html', 'html'),
(3, 'javaScript', 'java-script'),
(4, 'css', 'css'),
(5, 'tutorial', 'tutorial');

-- --------------------------------------------------------

--
-- Структура таблицы `comments`
--

CREATE TABLE `comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_post` int(10) UNSIGNED NOT NULL,
  `author` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `status` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'moderate'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `comments`
--

INSERT INTO `comments` (`id`, `id_post`, `author`, `mail`, `comment`, `date`, `status`) VALUES
(1, 2, 'dracula', 'retyo@uand.ru', 'Здесь так классно! Слов нет!', '2021-02-15 10:55:53', 'moderate'),
(2, 1, 'Sergey', 'serg@lopt.ru', 'Ну оооочень полезная статья! Автор респект!', '2021-02-15 11:24:08', 'moderate'),
(3, 2, 'апвап', 'rfg@mail.com', 'gfhjgjg', '2021-02-15 18:46:24', 'moderate'),
(4, 2, 'апвап', 'rfg@mail.com', 'gdfgdf', '2021-02-15 18:49:00', 'moderate'),
(5, 2, 'апвап', 'rfg@mail.com', 'вапавпв', '2021-02-15 18:51:53', 'moderate'),
(6, 2, 'апвап', 'rfg@mail.com', 'dgdfg', '2021-02-15 18:59:02', 'moderate'),
(7, 2, 'апвап', 'rfg@mail.com', 'dfgfdg', '2021-02-15 18:59:49', 'moderate'),
(8, 1, 'апdsfd', 'rfg@mail.com', 'asdsaffdsfer', '2021-02-15 19:07:40', 'moderate'),
(9, 1, 'апвап', 'rfg@mail.com', 'fsdfsre', '2021-02-15 19:10:00', 'moderate'),
(10, 1, 'апdsfd', 'rfg@mail.com', 'aredfsdfc', '2021-02-15 19:10:30', 'moderate'),
(11, 1, 'апвап', 'rfg@mail.com', 'sdgdfgd', '2021-02-15 19:14:26', 'moderate'),
(12, 1, 'апвап', 'alexandrovna904@gmail.com', 'erfdf', '2021-02-24 13:22:13', 'moderate'),
(13, 1, 'апвап', 'rfg@mail.com', 'erewrwerw', '2021-02-24 14:11:35', 'moderate'),
(14, 1, 'апвап', 'rfg@mail.com', 'werewrew', '2021-02-24 14:12:05', 'moderate'),
(15, 1, 'апвап', 'rfg@mail.com', 'werewrew', '2021-02-24 14:12:16', 'moderate'),
(16, 1, 'апвап', 'rfg@mail.com', 'werewrew', '2021-02-24 14:12:23', 'moderate'),
(17, 2, 'апвап', 'rfg@mail.com', 'цукуцкуц', '2021-02-24 14:14:59', 'moderate'),
(18, 2, 'апвап', 'rfg@mail.com', 'цукуцкуц', '2021-02-24 14:15:33', 'moderate'),
(19, 2, 'апвап', 'rfg@mail.com', 'qweqweq', '2021-02-24 14:16:03', 'moderate'),
(20, 2, 'Anateissa', 'rfg@mail.com', 'Wooooow pollp', '2021-02-24 14:16:47', 'moderate'),
(21, 2, 'апвап', 'rfg@mail.com', 'wewqewqe', '2021-02-24 14:17:30', 'moderate'),
(22, 5, 'Андрей', 'penaaaaaag@mail.com', 'Впервые на этом сайте!', '2021-03-03 18:51:11', 'moderate'),
(26, 5, 'Margooo', 'rfg@mail.com', 'kjfweiopfl;df', '2021-03-04 13:07:04', 'moderate'),
(27, 5, 'Павлуша', 'rfg@mail.com', 'уеукц', '2021-03-04 13:07:54', 'moderate');

-- --------------------------------------------------------

--
-- Структура таблицы `posts`
--

CREATE TABLE `posts` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_post` int(10) UNSIGNED NOT NULL,
  `id_category` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `posts`
--

INSERT INTO `posts` (`id`, `id_post`, `id_category`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 1, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `posts_content`
--

CREATE TABLE `posts_content` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `alias` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `author` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `posts_content`
--

INSERT INTO `posts_content` (`id`, `title`, `image`, `text`, `date`, `alias`, `author`, `status`) VALUES
(1, 'Главные 7 советов как улучшить интерфейс карточек в веб-дизайне', '/public/image/post1.jpg', 'Цель любого сайта – привлечь внимание посетителей. При этом важно не только то, что вы собираетесь донести до аудитории (содержимое), но и то, каким способом вы собираетесь это сделать (дизайн). В 2018 контент продолжает процветать, благодаря энтузиастам концепции Content First, подразумевающей его первоочередное значение в оформлении веб-проектов. Ниже представлены тенденции типографики 2018 года, многие из которых подразумевают размещение текста спереди, в центре и даже по всему экрану.\r\n\r\nВ 2006 была опубликована статья Оливера Райхенштейна «Веб-дизайн – это 95% типографики» — второе из нашумевших явлений того периода после комедии «Борат». По словам Райхенштейна: «Веб-дизайн – это не просто подбор оригинальных шрифтов, а приемы их умелого использования».\r\n\r\n1. БРОСКИЕ, КРУПНЫЕ ЗАГОЛОВКИ\r\nЦепляющий заголовок, выполненные крупным полужирным или жирным шрифтом – это, пожалуй, наиболее эффективное применение текста в качестве значимого элемента веб-страниц. Сейчас наблюдается тенденция заменять главные «Hero-изображения» крупными заголовками, что связывают главную с названием бренда или важной информацией.\r\n\r\nВ настоящее время красивая типографика сайта постепенно превращается в его дизайн. Компания CreativeDoc, например, мастерски использует броский заголовок из шести букв, набранных жирным белым шрифтом, на строгом черном фоне.', '2021-02-12 13:40:00', '7-recommend-improve-cards', 'admin', 1),
(2, 'Mailto — HTML ссылка на электронную почту на сайте', '/public/image/post2.jpg', 'ОТКРЫТИЕ В НОВОМ ОКНЕ\r\nЕсли на пользовательском компьютере одна из почтовых программ (Apple Mail, MS Outlook и т.п.) установлена как приложение, срабатывающее по умолчанию для текущей задачи, то при клике на mailto-линк откроется соответствующее приложение с новым созданным письмом. Причем не важно указан ли здесь атрибут target=»_blank» (срабатывание в новом окне) или нет – программа всегда реагирует одинаково.\r\n\r\nКогда же для почты вы используете веб-клиент, например, указали в Chrome в качестве базового почтового приложений Gmail, то клик по ссылке выполняет такие же действия, как и в любом другом случае — то есть без указания открытия в новом окне вы просто будете перенаправлены сходу на Gmail (текущая открытая страница пропадет).\r\n\r\nВ принципе, прописывание target=»_blank» для всех линков на сайте такой же спорный вопрос как и отключение правого клика мыши. Но даже если вы против этого атрибута в целом, то как минимум, для ссылки на адрес почты это имеет смысл делать.\r\nКОНСТРУКТОР ССЫЛОК MAILTO\r\nНовичкам, которые так и не поняли как сделать ссылку на почту рекомендуем глянуть сервис mailtolink.me. Он позволяет с помощью визуально понятного интерфейса заполнить все необходимые параметры сообщения и на выходе получить готовый html mailto код.\r\n', '2021-02-12 13:40:00', 'mailto', 'admin', 1),
(5, 'Веб-дизайн сайтов, уроки web дизайна', '/public/image/diza1.jpg', 'Раздел про веб-дизайн сайтов является одним из основных в данном проекте, так как его тематика полностью совпадает с направленностью сайта (даже название одинаковое). По сути, здесь вы найдете всю теоретическую информацию о веб-дизайне, полезные заметки и статьи, которые приоткрывают те или иные особенности веб-дизайна. Это, в частности — верстка, типографика, логотипы, юзабилити, флеш и т.п., публикации из которых, собственно, и объединяются в категорию веб-дизайн сайтов. Таким образом, если вас интересуют общие статьи про web дизайн, то начинать нужно именно с главного раздела, дальше можно углубляться в отдельные ниши.\r\n\r\nВообще веб-дизайн сайтов — это целая наука, здесь есть много нюансов, которые нужно знать, понимать и учитывать. Для дизайна сайтов недостаточно быть просто художником или даже вовсе не обязательно им быть, тут действую свои специфические законы и приемы. В разделе блога про web дизайн сайтов все эти особенности мы и будем рассматривать — начиная от чистой теории и заканчивая рассмотрением практических уроков web дизайна сайтов.', '2021-02-20 10:39:55', 'design-sites', 'admin', 1);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `alias_cat` (`alias`);

--
-- Индексы таблицы `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `posts_content`
--
ALTER TABLE `posts_content`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `alias` (`alias`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT для таблицы `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT для таблицы `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT для таблицы `posts_content`
--
ALTER TABLE `posts_content`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
