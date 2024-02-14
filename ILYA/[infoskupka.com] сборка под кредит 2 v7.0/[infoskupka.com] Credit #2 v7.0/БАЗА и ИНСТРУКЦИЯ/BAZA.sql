-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Мар 16 2020 г., 20:46
-- Версия сервера: 5.6.43-84.3-log
-- Версия PHP: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `demo`
--

-- --------------------------------------------------------

--
-- Структура таблицы `dle_admin_logs`
--

CREATE TABLE `dle_admin_logs` (
  `id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL DEFAULT '',
  `date` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `ip` varchar(46) NOT NULL DEFAULT '',
  `action` int(11) NOT NULL DEFAULT '0',
  `extras` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `dle_admin_logs`
--

INSERT INTO `dle_admin_logs` (`id`, `name`, `date`, `ip`, `action`, `extras`) VALUES
(245, 'redaktor', 1541768747, '1675.255.567.111', 82, ''),
(343, 'redaktor', 1578608368, '90.154.72.152', 101, ''),
(344, 'redaktor', 1578608374, '90.154.72.152', 86, 'http://site1.radimid.ru/'),
(345, 'redaktor', 1578647471, '90.154.72.152', 101, ''),
(346, 'redaktor', 1578647476, '90.154.72.152', 86, 'http://site1.radimid.ru/offers/'),
(347, 'redaktor', 1578658739, '90.154.72.152', 64, 'redaktor'),
(348, 'redaktor', 1578658757, '90.154.72.152', 90, ''),
(349, 'info@admin.ru', 1578658766, '90.154.72.152', 89, ''),
(350, 'redaktor', 1578658770, '90.154.72.152', 82, ''),
(351, 'redaktor', 1578658783, '90.154.72.152', 64, 'redaktor'),
(352, 'redaktor', 1578658784, '90.154.72.152', 90, ''),
(353, 'redaktor', 1579009366, '90.154.72.152', 91, ''),
(354, 'redaktor', 1579009375, '90.154.72.152', 101, ''),
(355, 'redaktor', 1580296862, '109.238.80.82', 91, ''),
(356, 'redaktor', 1580296883, '109.238.80.82', 91, ''),
(357, 'redaktor', 1584372527, '90.154.72.152', 91, ''),
(358, 'redaktor', 1584372541, '90.154.72.152', 101, ''),
(359, 'redaktor', 1584372545, '90.154.72.152', 86, 'http://site2.radimid.ru/'),
(360, 'redaktor', 1584372566, '90.154.72.152', 48, ''),
(361, 'redaktor', 1584373325, '90.154.72.152', 38, ''),
(362, 'redaktor', 1584373522, '90.154.72.152', 38, ''),
(363, 'redaktor', 1584380706, '90.154.72.152', 64, 'redaktor'),
(364, 'redaktor', 1584380708, '90.154.72.152', 90, ''),
(365, 'redaktor', 1584380717, '90.154.72.152', 82, '');

-- --------------------------------------------------------

--
-- Структура таблицы `dle_admin_sections`
--

CREATE TABLE `dle_admin_sections` (
  `id` mediumint(8) NOT NULL,
  `name` varchar(100) NOT NULL DEFAULT '',
  `title` varchar(255) NOT NULL DEFAULT '',
  `descr` varchar(255) NOT NULL DEFAULT '',
  `icon` varchar(255) NOT NULL DEFAULT '',
  `allow_groups` varchar(255) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `dle_admin_sections`
--

INSERT INTO `dle_admin_sections` (`id`, `name`, `title`, `descr`, `icon`, `allow_groups`) VALUES
(1, 'offers', 'Каталог офферов', 'Управление офферами', 'engine/skins/images/offer.png', '1'),
(3, 'banki', 'Каталог Банков', 'Управление банками', 'engine/skins/images/bank.png', '1'),
(4, 'mfo', 'Каталог МФО', 'Управление МФО', 'engine/skins/images/mfo.png', '1');

-- --------------------------------------------------------

--
-- Структура таблицы `dle_banki_comments`
--

CREATE TABLE `dle_banki_comments` (
  `id` mediumint(8) NOT NULL,
  `author` char(40) NOT NULL,
  `author_id` mediumint(8) NOT NULL,
  `email` char(255) NOT NULL,
  `text` text NOT NULL,
  `name_otziv` text NOT NULL,
  `tit_otziv` text NOT NULL,
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `banki_id` mediumint(8) NOT NULL,
  `del` tinyint(1) NOT NULL DEFAULT '0',
  `ip` char(255) NOT NULL,
  `answer` mediumint(10) NOT NULL DEFAULT '0',
  `approve` tinyint(4) NOT NULL,
  `otziv` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `dle_banki_comments`
--

INSERT INTO `dle_banki_comments` (`id`, `author`, `author_id`, `email`, `text`, `name_otziv`, `tit_otziv`, `date`, `banki_id`, `del`, `ip`, `answer`, `approve`, `otziv`) VALUES
(230, 'redaktor', 1, 'info@admin.ru', 'Тут все плохо тест прошел', 'Иванов Сергей', 'Все плохо', '2019-12-11 21:47:00', 3288, 0, '90.154.72.152', 0, 1, '1'),
(231, 'redaktor', 1, 'info@admin.ru', 'sdf asdf asdf asdf asdf asdf asdf asd f', 'Иванов Сергей', 'fasdf asdf', '2019-12-11 21:49:00', 3288, 0, '90.154.72.152', 0, 1, '5');

-- --------------------------------------------------------

--
-- Структура таблицы `dle_banki_options`
--

CREATE TABLE `dle_banki_options` (
  `id` int(10) NOT NULL,
  `type` char(255) NOT NULL,
  `options` text NOT NULL,
  `sort` smallint(8) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `dle_banki_options`
--

INSERT INTO `dle_banki_options` (`id`, `type`, `options`, `sort`) VALUES
(1, 'category', 'name=Список банков России с действующей лицензией|||alt_name=all|||template=|||icon=|||title_h=Банки России|||description=Все банки России в одном каталоге. Полная информация о банковских продуктах, сервисах, рейтинг и отзывы клиентов банков.|||keywords=|||cat=0|||count_post=457', 1),
(490, 'blocks', 'title=Банки на главной|||post_type=default|||post_sort=desc|||cats_type=only|||cache=120|||max_post=5|||template=banki|||post_photo=yes|||AllowCats=all', 1),
(491, 'blocks', 'title=Рейтинг банков на главной|||post_type=default|||post_sort=desc|||cats_type=only|||cache=120|||max_post=5|||template=rate|||post_photo=no|||AllowCats=all', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `dle_banki_post`
--

CREATE TABLE `dle_banki_post` (
  `id` int(10) NOT NULL,
  `title` char(255) NOT NULL,
  `titlelink` char(255) NOT NULL,
  `description` char(255) NOT NULL,
  `keywords` char(255) NOT NULL,
  `title_full` char(255) NOT NULL,
  `title_rek` char(255) NOT NULL,
  `title_rek_seo` char(255) NOT NULL,
  `description_rek` char(255) NOT NULL,
  `alt_name` char(255) NOT NULL,
  `text` text NOT NULL,
  `author` varchar(255) NOT NULL,
  `author_id` mediumint(8) NOT NULL,
  `comm_num` smallint(10) NOT NULL DEFAULT '0',
  `category` char(255) NOT NULL,
  `allow_comm` tinyint(1) NOT NULL DEFAULT '0',
  `xfields` text NOT NULL,
  `photos` text NOT NULL,
  `views` mediumint(8) NOT NULL DEFAULT '0',
  `color` char(255) NOT NULL,
  `color_date` int(11) NOT NULL,
  `approve` tinyint(1) NOT NULL DEFAULT '0',
  `rate` varchar(255) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `dle_banki_post`
--

INSERT INTO `dle_banki_post` (`id`, `title`, `titlelink`, `description`, `keywords`, `title_full`, `title_rek`, `title_rek_seo`, `description_rek`, `alt_name`, `text`, `author`, `author_id`, `comm_num`, `category`, `allow_comm`, `xfields`, `photos`, `views`, `color`, `color_date`, `approve`, `rate`) VALUES
(3288, 'Ассоциация', 'Информация о Ассоциация Банке', '', '', 'Ассоциация Банк', 'Отзывы о Ассоциация Банке', 'Отзывы клиентов о Ассоциация Банке', '', 'bank-associacija', '<p>Коммерческий банк &laquo;Ассоциация&raquo; &ndash; это компетентный и рентабельный банк, один из крупнейших в Нижегородской области.<br><br>Создание паевого банка было обусловлено производственной необходимостью и инициировано руководством предприятий, составляющих НАПП &ndash; Нижегородскую ассоциацию промышленников и предпринимателей. В числе участников НАПП были ОАО &laquo;Авиационный завод &laquo;Сокол&raquo;, ОАО &laquo;Нижегородский машиностроительный завод&raquo;, ГУП &laquo;Завод им. Свердлова&raquo; и др.<br><br>Для успешного развития предприятиям необходимо было объединить ресурсную базу и инвестировать ее в собственные проекты. Благодаря согласованной работе промышленников и эффективному управлению бессменного руководства банка, КБ &laquo;Ассоциация&raquo; пережил кризисные периоды без финансовых потерь.<br><br>Целью смены организационно-правовой формы на ОАО в 2002 году было нарастить финансовый ресурс банка, что и произошло. Его уставный капитал вырос в семь раз, а прибыль &ndash; в четыре. В том же году банк стал одним из пяти банков с максимальным ростом капитала.<br><br>КБ &laquo;Ассоциация&raquo; сегодня продолжает успешно развивать все направления своей деятельности, среди которых &ndash; операции с рублями и иностранной валютой, эмиссия и обслуживание карт системы MasterCard.</p>', 'redaktor', 0, 2, '1', 1, 'polnoe-nazvanie-banka=Акционерное общество коммерческий Банк «Ассоциация»|||polnaja-licenzija=Лицензия ЦБРФ № 732 от 12.11.1990|||licenzija-=Лицензия ЦБРФ № 732 от 12.11.1990|||juridicheskij-adres=603000, г. Нижний Новгород, ул. М. Горького, д. 61|||golovnoj-ofis=603000, г. Нижний Новгород, ул. М. Горького, д. 61|||gorjachaja-linija=+7 (831) 4-219-200|||ogrn=1025200000352|||inn=5253004326|||kpp=526001001|||okpo=09116810|||bik=042282751|||swift=ASOJRU2N|||iban=Для безналичных переводов используются идентификаторы SWIFT', '1532901425_associacija.png###2018-07', 138, '', 0, 1, '6'),
(3289, 'Аспект', 'Информация о Аспект Банке', '', '', 'Аспект Банк', 'Отзывы о Аспект Банке', 'Отзывы клиентов о Аспект Банке', '', 'bank-aspekt', '<p>Акционерный банк &laquo;Аспект&raquo; (с 1947 года &ndash; отделение Госбанка СССР) начал свое восхождение на финансовый рынок в 1990 году (лицензия Центрального банка РФ № 608 от 1996 года).<br><br>Московский универсальный банк с одним дополнительным офисом АБ &laquo;Аспект&raquo; располагает возможностью предлагать своим клиентам (физическим и юридическим лицам) расчетно-кассовое обслуживание, кредитование, депозитные программы и другое.<br><br>Некоторое время он выступал Уполномоченным банком для правительства Москвы, был гарантом Муниципальной жилищной программы &laquo;Комбиинвест&raquo;.<br><br>Среди 3000 клиентов банка крупнейшими являются: НПО &laquo;Химавтоматика&raquo; (ОАО), &laquo;Лосиноостровский электротехнический завод&raquo; ФГУП, &laquo;Яуза-Хлеб&raquo; (ОАО), &laquo;Завод Водоприбор&raquo; (ОАО) и другие.<br><br>Устойчивое положение банка подкреплено высоким коэффициентом ликвидности, достаточным размером собственного капитала, уверенной динамикой развития.</p>', 'redaktor', 0, 0, '1', 1, 'polnoe-nazvanie-banka=Акционерный Банк «Аспект» (Акционерное общество)|||polnaja-licenzija=Лицензия ЦБРФ № 608 от 26.10.1990|||licenzija-=Лицензия ЦБРФ № 608 от 26.10.1990|||juridicheskij-adres=129327, г. Москва, ул. Ленская, д. 28|||golovnoj-ofis=129327, г. Москва, ул. Ленская, д. 28|||gorjachaja-linija=+7 (495) 587-75-01|||ogrn=1027739326207|||inn=7716081564|||kpp=771601001|||okpo=|||bik=044525401|||swift=ASPTRUMM|||iban=Для безналичных переводов используются идентификаторы SWIFT', '1532901224_aspekt.png###2018-07', 15, '', 0, 1, '0'),
(3290, 'Арзамас', 'Информация о Арзамас Банке', '', '', 'Арзамас Банк', 'Отзывы о Арзамас Банке', 'Отзывы клиентов о Арзамас Банке', '', 'bank-arzamas', '<p>АО КОМБАНК &laquo;АРЗАМАС&raquo; официально зарегистрирован 24 января 1994 года. С тех пор был проведен комплекс операций по расширению линейки услуг, предоставляемых банком как организациям, так и физическим лицам.<br><br>Банк предоставляет услуги кредитования для физических и юридических лиц. Кроме того, его клиентам доступно овердрафтное кредитование, широкий спектр потребительских и автомобильных кредитов, выдаваемых на разные сроки.<br><br>Он предлагает ипотечное кредитование, а также открытие расчетных счетов в максимально сжатые сроки. АО КОМБАНК &laquo;АРЗАМАС&raquo; разработал удобную линейку депозитных вкладов, в том числе потребителям доступны срочные вклады.<br><br>Банк выпускает пластиковые карты, работа с которыми возможна как в отделениях банка в г. Арзамас, так и в сети его банкоматов. Головной офис банка находится в Нижегородской области.</p>', 'redaktor', 0, 0, '1', 1, 'polnoe-nazvanie-banka=Акционерное общество коммерческий банк «Арзамас»|||polnaja-licenzija=Лицензия ЦБРФ № 1281 от 24.12.1990|||licenzija-=Лицензия ЦБРФ № 1281 от 24.12.1990|||juridicheskij-adres=607220, Нижегородская область, г. Арзамас, улица Кирова, д. 33|||golovnoj-ofis=607220, Нижегородская область, г. Арзамас, улица Кирова, д. 33|||gorjachaja-linija=+7 (83147) 702-24|||ogrn=1025200000011|||inn=5243006236|||kpp=524301001|||okpo=09116036|||bik=042202731|||swift=|||iban=', '1532901293_arzamas.png###2018-07', 12, '', 0, 1, '0'),
(3305, 'Акрополь', 'Информация о Акрополь Банке', '', '', 'Акрополь Банк', 'Отзвывы о Акрополь Банке', 'Отзывы клиентов о Акрополь Банке', '', 'bank-akropol', '<p>АО Коммерческий банк &laquo;Акрополь&raquo; получило лицензию, позволяющую осуществлять операции, в августе 1994 года. Основная клиентская база на сегодняшний день представлена предприятиями, работающими в сферах:<br><br>угольного комплекса;<br>металлургической промышленности;<br>переработки и реализации энергоресурсов;<br>и осуществляющими внешнеэкономическую деятельность.<br><br>Банк разработал и активно развивает программу поддержки бизнеса своих клиентов, применяя различные технологии и финансовые инструменты. Эта программа предполагает содействие в создании и реализации экономических систем, целью которых является оптимизация финансово-хозяйственной деятельности клиентов.<br><br>Частные лица, клиенты &laquo;Акрополя&raquo;, имеют возможность выгодно воспользоваться услугами, а именно:<br><br>разместить денежные средства во вклады, в том числе и срочные;<br>перевести деньги или обменять валюту;<br>оформить кредит;<br>заплатить за коммунальные услуги и услуги связи;<br>арендовать банковский сейф;<br>получить пластиковую банковскую карту и многое другое.<br>Клиенты банка &laquo;Акрополь&raquo; могут постоянно рассчитывать на поддержку банка в любом вопросе.</p>', 'redaktor', 0, 0, '1', 1, 'polnoe-nazvanie-banka=Коммерческий Банк «Акрополь» акционерное общество|||polnaja-licenzija=Лицензия ЦБРФ № 3027 от 04.08.1994|||licenzija-=Лицензия ЦБРФ № 3027 от 04.08.1994|||juridicheskij-adres=123557, г. Москва, ул. Грузинский вал, д. 10, стр. 4|||golovnoj-ofis=123557, г. Москва, ул. Грузинский вал, д. 10, стр. 4|||gorjachaja-linija=+7 (499) 253-31-33|||ogrn=1077711000091|||inn=7750004168|||kpp=775001001|||okpo=40061721|||bik=044585677|||swift=|||iban=', '1532903784_akropol.png###2018-07', 3, '', 0, 1, '0'),
(3306, 'Акибанк', 'Информация о Акибанке', '', '', 'Акибанк', 'Отзывы о Акибанке', 'Отзывы клиентов о Акибанке', '', 'akibank', '<p>ПАО &laquo;Акибанк&raquo; является Акционерным коммерческим ипотечным банком. 25 ноября 1993 года Центральный банк России зарегистрировал данную организацию и выдал ей лицензию №2587.<br><br>&laquo;Акибанк&raquo; состоит в реестре банков (№237), которые являются участниками системы обязательного страхования вложений.<br><br>По результатам деятельности в 1 квартале 2018 года АКИБАНК вновь подтвердил позиции одного из самых надёжных банков Республики Татарстан. За отчетный период банком принимались меры по сохранению высокого качества активов, увеличению капитала банка, а также повышению эффективности деятельности и усилению контроля рисков.<br>Балансовая прибыль превысила 54 млн рублей, что в полтора раза выше аналогичного показателя за 1 квартал 2017 года.<br>Собственный капитал вырос на 19,3 млн рублей и составил 4,8 млрд рублей.<br>По состоянию на 1 апреля 2018 года норматив достаточности капитала (Н1.0) составил 21,7%, при установленном нормативном значении &ndash; не ниже 8%. Норматив мгновенной ликвидности (Н2) составил 78,6%, норматив краткосрочной ликвидности (Н3) - 176,0%.</p>', 'redaktor', 0, 0, '1', 1, 'polnoe-nazvanie-banka=Акционерный коммерческий ипотечный Банк «Акибанк» (публичное акционерное общество)|||polnaja-licenzija=Лицензия ЦБРФ № 2587 от 25.11.1993|||licenzija-=Лицензия ЦБРФ № 2587 от 25.11.1993|||juridicheskij-adres=423818, г. Набережные Челны, пр. Мира, д. 88 А|||golovnoj-ofis=423818, г. Набережные Челны, пр. Мира, д. 88 А|||gorjachaja-linija=8 (800) 100-25-42|||ogrn=1021600000839|||inn=1650002455|||kpp=165001001|||okpo=13001981|||bik=049240803|||swift=AKOARU22|||iban=Для безналичных переводов используются идентификаторы SWIFT', '1532903814_akibank.png###2018-07', 4, '', 0, 1, '0'),
(3314, 'Агропромкредит', 'Информация о Банке Агропромкредит', '', '', 'Банк Агропромкредит', 'Отзывы о Банке Агропромкредит', 'Отзывы клиентов о Банке Агропромкредит', '', 'agropromkredit', '<p>Банк &laquo;АГРОПРОМКРЕДИТ&raquo; ведет свою историю с 1994-го года и известен на российском финансовом рынке как универсальный банк федерального уровня, оказывающий клиентам весь комплекс услуг, которые может предложить современное финансово-кредитное учреждение.<br><br>Банк &laquo;АГРОПРОМКРЕДИТ&raquo; имеет ряд профессиональных наград:<br><br>2003 году Банк стал лауреатом V конкурса &laquo;Компания года&raquo;, проводимого деловым еженедельником &laquo;Компания&raquo; при поддержке Министерства финансов РФ, в номинации &laquo;За динамичное развитие розничного бизнеса в регионах России&raquo;;<br>2004 году Банк получил премию &laquo;Лучший банк года&raquo;, учрежденную Ассоциацией российских банков и Национальным Банковским Журналом, и был признан лучшим банком года по деятельности в регионах;<br>2008 год принес Банку &laquo;АГРОПРОМКРЕДИТ&raquo; премию &laquo;Финансовая Элита России&raquo; в номинации &laquo;Региональный банк года&raquo;;<br>в 2009 году Банк признан лауреатом ежегодной премии журнала &laquo;Финанс.&raquo; в номинации &laquo;За стабильное положение на финансовом рынке&raquo;;<br>в 2009 году Банк также награжден премией &laquo;Финансовая Элита России&raquo; в номинации &laquo;Эффективная антикризисная стратегия&raquo;.</p>', 'redaktor', 0, 0, '1', 1, 'polnoe-nazvanie-banka=Акционерное общество коммерческий Банк «Агропромкредит»|||polnaja-licenzija=Лицензия ЦБРФ № 2880 от 09.06.1994|||licenzija-=Лицензия ЦБРФ № 2880 от 09.06.1994|||juridicheskij-adres=107023, г. Москва, Электрозаводская улица, д. 27с5|||golovnoj-ofis=107023, г. Москва, Электрозаводская улица, д. 27с5|||gorjachaja-linija=8 (800) 100-80-08|||ogrn=1095000004252|||inn=5026014060|||kpp=502701001|||okpo=34922679|||bik=044525710|||swift=AGCORUMM|||iban=Для безналичных переводов используются идентификаторы SWIFT', '1532904840_agropromkredit.png###2018-07', 3, '', 0, 1, '0'),
(3315, 'Автоторгбанк', 'Информация о Автоторгбанке', '', '', 'Отзывы о Автоторгбанке', 'Отзывы о Автоторгбанке', 'Отзывы клиентов о Автоторгбанке', '', 'avtotorgbank', '<p>ООО &laquo;Автоторгбанк&raquo; &ndash; это небольшой по ключевым показателям банк, который имеет достаточно узкую специализацию &ndash; обслуживание юридических лиц, а также автокредитование. Кредитная организация является подконтрольной группе автодилера &laquo;Major Auto&raquo;, которая выкупила банк в 2008-ом году.<br><br>Изначально банк работал на территории Москвы, а сегодня &ndash; и в Санкт-Петербурге располагается 2 офиса &laquo;Автоторгбанка&raquo;. Кроме этого, в Москве работает более 10 операционных касс банка и 15 дополнительных офисов. Общее число сотрудников всех офисов кредитной организации составляет около 200 человек.<br><br>Клиенты &laquo;Автоторгбанка&raquo; &ndash; это преимущественно компании, которые работают в сфере транспорта, торговли и промышленного производства. А для частных клиентов, которых у банка не так много, наиболее актуальной услугой является оформление автокредитов. Такой услугой они могут воспользоваться в салоне Major Auto, что делает ее еще более доступной для клиентов.<br><br>Кроме кредитования, все клиенты &laquo;Автоторгбанка&raquo; могут получить стандартные банковские продукты или услуги &ndash; например, открытие и ведение депозитных счетов, получение пластиковых карт банка, а также, при желании, &ndash; оформить аренду ячеек для хранения ценностей.</p>', 'redaktor', 0, 0, '1', 1, 'polnoe-nazvanie-banka=Общество с ограниченной ответственностью «Автоторгбанк»|||polnaja-licenzija=Лицензия ЦБРФ № 2776 от 05.04.1994|||licenzija-=Лицензия ЦБРФ № 2776 от 05.04.1994|||juridicheskij-adres=123007, г. Москва, 1-я Магистральная улица, д. 13, стр. 2|||golovnoj-ofis=123007, г. Москва, 1-я Магистральная улица, д. 13, стр. 2|||gorjachaja-linija=+7 (495) 730-51-15|||ogrn=1027739408290|||inn=7727038017|||kpp=771401001|||okpo=29294134|||bik=044525097|||swift=ATBTRUMM|||iban=Для безналичных переводов используются идентификаторы SWIFT', '1532905070_avtotorgbank.png###2018-07', 3, '', 0, 1, '0'),
(3316, 'АвтоКредитБанк', 'Информация о АвтоКредитБанке', '', '', 'АвтоКредитБанк', 'Отзывы о АвтоКредитБанке', 'Отзывы клиентов о АвтоКредитБанке', '', 'avtokreditbank', '<p>Название &laquo;АвтоКредитБанк&raquo; говорит само за себя: профилирующей деятельностью этого общества с ограниченной ответственностью является предоставление населению и предприятиям кредитов на приобретение транспортных средств. Основой для этого стало сотрудничество с крупнейшим региональным автодилером.<br><br>Стартовало учреждение на финансовом рынке РФ в Казани в 1992 году под названием &laquo;Вятский коммерческий банк&raquo;. Переименован он был в декабре 2004-го. После ряда изменений в 2006 году учредителями стали несколько крупных строительных фирм и нефтедобытчиков Татарстана.<br><br>В настоящее время &laquo;АвтоКредитБанк&raquo; &ndash; универсальная финансовая институция и осуществляет множество операций в рублях, евро, долларах. Среди пользующихся особым спросом населения и клиентов-юридических лиц &ndash; вклады, кредитование, кассовое обслуживание.<br><br>Лицензию на участие в рынке ценных бумаг ФСФР аннулировала данной кредитной организации в 2011 году. Основанием для такого решения было заявление самого ООО. До этого общество имело право на дилерскую, брокерскую и управленческую (по ценным бумагам) деятельность.<br><br>&laquo;АвтоКредитБанк&raquo; располагает двумя подразделениями на территории Федерации (одним филиалом и одним представительством).</p>', 'redaktor', 0, 0, '1', 1, 'polnoe-nazvanie-banka=Общество с ограниченной ответственностью «АвтоКредитБанк»|||polnaja-licenzija=Лицензия ЦБРФ № 1973 от 22.07.1992|||licenzija-=Лицензия ЦБРФ № 1973 от 22.07.1992|||juridicheskij-adres=420081, г. Казань, пр-т А. Камалеева, д. 16а|||golovnoj-ofis=420081, г. Казань, пр-т А. Камалеева, д. 16а|||gorjachaja-linija=+7 (843) 294-98-80|||ogrn=1021600000366|||inn=1626000087|||kpp=166001001|||okpo=12998664|||bik=049205795|||swift=|||iban=', '1532904893_avtokreditbank.png###2018-07', 3, '', 0, 1, '0'),
(3317, 'Автоградбанк', 'Информация о Автоградбанке', '', '', 'Автоградбанк', 'Отзывы о Автоградбанке', 'Отзывы клиентов о Автоградбанке', '', 'avtogradbank', '<p>АО &laquo;Автоградбанк&raquo; - универсальный коммерческий банк, основанный в Набережных Челнах в 1991 году.<br><br>Сегодня помимо Набережных Челнов банк представлен в Казани, Альметьевске, Заинске, Нижнекамске, Лениногорске, Елабуге, Сарапуле и Можге.<br><br>Автоградбанк &ndash; это банк, который помогает клиентам в Набережных Челнах и других городах Татарстана быстрее достигнуть поставленных целей, экономит их силы и время за счет постоянного инновационного совершенствования продуктов, услуг и бизнес-процессов, а также лучшего понимания своих клиентов.</p>', 'redaktor', 0, 0, '1', 1, 'polnoe-nazvanie-banka=Акционерное общество «Автоградбанк»|||polnaja-licenzija=Лицензия ЦБРФ № 1455 от 26.04.1991|||licenzija-=Лицензия ЦБРФ № 1455 от 26.04.1991|||juridicheskij-adres=423831, г. Набережные Челны, проспект Хасана Туфана, д. 43|||golovnoj-ofis=423831, г. Набережные Челны, проспект Хасана Туфана, д. 43|||gorjachaja-linija=8 (800) 2005-245|||ogrn=1021600000806|||inn=1650072068|||kpp=165001001|||okpo=|||bik=049240748|||swift=AVGRRU22|||iban=Для безналичных переводов используются идентификаторы SWIFT', '1532905363_avtogradbank.png###2018-07', 3, '', 0, 1, '0'),
(3320, 'Абсолют Банк', 'Информация о Абсолют Банке', '', '', 'Абсолют Банк', 'Отзывы о Абсолют Банке', 'Отзывы клиентов о Абсолют Банке', '', 'absoljut-bank', '<p>Акционерный коммерческий банк &laquo;Абсолют банк&raquo; ОАО начал свое гордое шествие по просторам валютного рынка в 1993 году.<br><br>Руководство банка ценит в своих сотрудниках умение работать в команде, инициативность, ответственность, и нацеленность на результат, поэтому профессионализм оказываемых банком услуг растет из года в год.<br><br>Самыми востребованными услугами являются услуги долгосрочного кредитования населения, автокредиты, программы денежных вкладов и сбережений, инвестиционные продукты, а также страхование и пенсионный пакет. Финансовым институтам банк предлагает услуги депозитария, всевозможную помощь при работе на рынке ценных бумаг (биржевое/внебиржевое РЕПО, торговые операции, выпуск собственных векселей банка). Он проводит также операции торгового финансирования и обслуживание на правах корреспондента.<br><br>Принимая во внимание занятость современных людей, руководство банка разработало специальную программу по обслуживанию VIP-клиентов, ориентированную на обеспеченную прослойку населения, которая ценит свое время.</p>', 'redaktor', 0, 0, '1', 1, 'polnoe-nazvanie-banka=Акционерный коммерческий Банк «Абсолют Банк» (публичное акционерное общество)|||polnaja-licenzija=Лицензия ЦБРФ № 2306 от 22.04.1993|||licenzija-=Лицензия ЦБРФ № 2306 от 22.04.1993|||juridicheskij-adres=127051, г. Москва, Цветной бульвар, д. 18|||golovnoj-ofis=127051, г. Москва, Цветной бульвар, д. 18|||gorjachaja-linija=8 (800) 200-200-5|||ogrn=1027700024560|||inn=7736046991|||kpp=770201001|||okpo=17527415|||bik=044525976|||swift=ABSLRUMM|||iban=Для безналичных переводов используются идентификаторы SWIFT', '1532905628_absoljut_bank.png###2018-07', 2, '', 0, 1, '0');

-- --------------------------------------------------------

--
-- Структура таблицы `dle_banned`
--

CREATE TABLE `dle_banned` (
  `id` smallint(5) NOT NULL,
  `users_id` int(11) NOT NULL DEFAULT '0',
  `descr` text NOT NULL,
  `date` varchar(15) NOT NULL DEFAULT '',
  `days` smallint(4) NOT NULL DEFAULT '0',
  `ip` varchar(46) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблицы `dle_banners`
--

CREATE TABLE `dle_banners` (
  `id` smallint(5) NOT NULL,
  `banner_tag` varchar(40) NOT NULL DEFAULT '',
  `descr` varchar(200) NOT NULL DEFAULT '',
  `code` text NOT NULL,
  `approve` tinyint(1) NOT NULL DEFAULT '0',
  `short_place` tinyint(1) NOT NULL DEFAULT '0',
  `bstick` tinyint(1) NOT NULL DEFAULT '0',
  `main` tinyint(1) NOT NULL DEFAULT '0',
  `category` varchar(255) NOT NULL DEFAULT '',
  `grouplevel` varchar(100) NOT NULL DEFAULT 'all',
  `start` varchar(15) NOT NULL DEFAULT '',
  `end` varchar(15) NOT NULL DEFAULT '',
  `fpage` tinyint(1) NOT NULL DEFAULT '0',
  `innews` tinyint(1) NOT NULL DEFAULT '0',
  `devicelevel` varchar(10) NOT NULL DEFAULT '',
  `allow_views` tinyint(1) NOT NULL DEFAULT '0',
  `max_views` int(11) NOT NULL DEFAULT '0',
  `allow_counts` tinyint(1) NOT NULL DEFAULT '0',
  `max_counts` int(11) NOT NULL DEFAULT '0',
  `views` int(11) NOT NULL DEFAULT '0',
  `clicks` int(11) NOT NULL DEFAULT '0',
  `rubric` mediumint(8) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `dle_banners`
--

INSERT INTO `dle_banners` (`id`, `banner_tag`, `descr`, `code`, `approve`, `short_place`, `bstick`, `main`, `category`, `grouplevel`, `start`, `end`, `fpage`, `innews`, `devicelevel`, `allow_views`, `max_views`, `allow_counts`, `max_counts`, `views`, `clicks`, `rubric`) VALUES
(2, 'header', 'Езаем', '<div class=\"aktiv-banner\" id=\"aside1\">\r\n	<div class=\"inner\">\r\n		<a href=\"/offers/mikrozajmy/e-zaem/\"><img src=\"{THEME}/images/ezaym.png\" alt=\"Микрозайм «Первый заем без процентов» от Ё-заем\" /></a>\r\n	</div>\r\n</div>', 1, 0, 0, 0, '0', 'all', '', '', 0, 0, 'all', 0, 0, 2, 0, 0, 9, 0),
(4, 'banner-1', 'Баннер кредитные карты', '<div class=\"clr\"></div>\r\n<div class=\"full-banner-wrap\">\r\n	<div class=\"full-banner-center\">\r\n		<img src=\"{THEME}/images/credit-card-banner.svg\" alt=\"Кредитные карты\" title=\"Кредитные карты\"/>\r\n	</div>\r\n	<div class=\"full-banner-left\">\r\n		<div class=\"name\">\r\n			Кредитные карты\r\n		</div>\r\n		<div class=\"text\">\r\n			Бесплатный сервис по подбору кредитных карт\r\n		</div>\r\n	</div>\r\n	<div class=\"full-banner-right\">\r\n		<div class=\"link\">\r\n			<a href=\"/offers/kreditnye-karty/\"> <span>Подобрать</span></a></a>\r\n		</div>\r\n	</div>\r\n</div>\r\n<div class=\"clr\"></div>', 1, 0, 0, 0, '0', 'all', '', '', 0, 0, 'all', 0, 0, 2, 0, 0, 2, 0),
(5, 'banner-1', 'Баннер кредит наличными', '<div class=\"clr\"></div>\r\n<div class=\"full-banner-wrap\">\r\n	<div class=\"full-banner-center\">\r\n		<img src=\"{THEME}/images/walletmin.svg\" alt=\"Кредит наличными\" title=\"Кредит наличными\"/>\r\n	</div>\r\n	<div class=\"full-banner-left\">\r\n		<div class=\"name\">\r\n			Кредит наличными\r\n		</div>\r\n		<div class=\"text\">\r\n			Бесплатный сервис по подбору потребительских кредитов\r\n		</div>\r\n	</div>\r\n	<div class=\"full-banner-right\">\r\n		<div class=\"link\">\r\n			<a href=\"/offers/potrebitelskij-kredit/\"> <span>Подобрать</span></a></a>\r\n		</div>\r\n	</div>\r\n</div>\r\n<div class=\"clr\"></div>', 1, 0, 0, 0, '0', 'all', '', '', 0, 0, 'all', 0, 0, 2, 0, 0, 1, 0),
(6, 'banner-1', 'Баннер займы', '<div class=\"clr\"></div>\r\n<div class=\"full-banner-wrap\">\r\n	<div class=\"full-banner-center\">\r\n		<img src=\"{THEME}/images/walletmin.svg\" alt=\"Микрозаймы\" title=\"Микрозаймы\"/>\r\n	</div>\r\n	<div class=\"full-banner-left\">\r\n		<div class=\"name\">\r\n			Микрозаймы\r\n		</div>\r\n		<div class=\"text\">\r\n			Бесплатный сервис по подбору микрозаймов\r\n		</div>\r\n	</div>\r\n	<div class=\"full-banner-right\">\r\n		<div class=\"link\">\r\n			<a href=\"/offers/mikrozajmy/\"> <span>Подобрать</span></a></a>\r\n		</div>\r\n	</div>\r\n</div>\r\n<div class=\"clr\"></div>', 1, 0, 0, 0, '0', 'all', '', '', 0, 0, 'all', 0, 0, 2, 0, 0, 7, 0),
(7, 'banner-1', 'Баннер дебетовые карты', '<div class=\"clr\"></div>\r\n<div class=\"full-banner-wrap\">\r\n	<div class=\"full-banner-center\">\r\n		<img src=\"{THEME}/images/credit-card-banner.svg\" alt=\"Дебетовые карты\" title=\"Дебетовые карты\"/>\r\n	</div>\r\n	<div class=\"full-banner-left\">\r\n		<div class=\"name\">\r\n			Дебетовые карты\r\n		</div>\r\n		<div class=\"text\">\r\n			Бесплатный сервис по подбору дебетовых карт\r\n		</div>\r\n	</div>\r\n	<div class=\"full-banner-right\">\r\n		<div class=\"link\">\r\n			<a href=\"/offers/debetovye-karty/\"> <span>Подобрать</span></a></a>\r\n		</div>\r\n	</div>\r\n</div>\r\n<div class=\"clr\"></div>', 1, 0, 0, 0, '0', 'all', '', '', 0, 0, 'all', 0, 0, 2, 0, 0, 6, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `dle_banners_logs`
--

CREATE TABLE `dle_banners_logs` (
  `id` int(11) UNSIGNED NOT NULL,
  `bid` int(11) NOT NULL DEFAULT '0',
  `click` tinyint(1) NOT NULL DEFAULT '0',
  `ip` varchar(46) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблицы `dle_banners_rubrics`
--

CREATE TABLE `dle_banners_rubrics` (
  `id` mediumint(8) NOT NULL,
  `parentid` mediumint(8) NOT NULL DEFAULT '0',
  `title` varchar(70) NOT NULL DEFAULT '',
  `description` varchar(255) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблицы `dle_category`
--

CREATE TABLE `dle_category` (
  `id` mediumint(8) NOT NULL,
  `parentid` mediumint(8) NOT NULL DEFAULT '0',
  `posi` mediumint(8) NOT NULL DEFAULT '1',
  `name` varchar(50) NOT NULL DEFAULT '',
  `alt_name` varchar(50) NOT NULL DEFAULT '',
  `icon` varchar(200) NOT NULL DEFAULT '',
  `skin` varchar(50) NOT NULL DEFAULT '',
  `descr` varchar(300) NOT NULL DEFAULT '',
  `keywords` text NOT NULL,
  `news_sort` varchar(10) NOT NULL DEFAULT '',
  `news_msort` varchar(4) NOT NULL DEFAULT '',
  `news_number` smallint(5) NOT NULL DEFAULT '0',
  `short_tpl` varchar(40) NOT NULL DEFAULT '',
  `full_tpl` varchar(40) NOT NULL DEFAULT '',
  `metatitle` varchar(255) NOT NULL DEFAULT '',
  `show_sub` tinyint(1) NOT NULL DEFAULT '0',
  `allow_rss` tinyint(1) NOT NULL DEFAULT '1',
  `fulldescr` text NOT NULL,
  `disable_search` tinyint(1) NOT NULL DEFAULT '0',
  `disable_main` tinyint(1) NOT NULL DEFAULT '0',
  `disable_rating` tinyint(1) NOT NULL DEFAULT '0',
  `disable_comments` tinyint(1) NOT NULL DEFAULT '0',
  `enable_dzen` tinyint(1) NOT NULL DEFAULT '1',
  `enable_turbo` tinyint(1) NOT NULL DEFAULT '1',
  `active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `dle_category`
--

INSERT INTO `dle_category` (`id`, `parentid`, `posi`, `name`, `alt_name`, `icon`, `skin`, `descr`, `keywords`, `news_sort`, `news_msort`, `news_number`, `short_tpl`, `full_tpl`, `metatitle`, `show_sub`, `allow_rss`, `fulldescr`, `disable_search`, `disable_main`, `disable_rating`, `disable_comments`, `enable_dzen`, `enable_turbo`, `active`) VALUES
(1, 0, 1, 'Новости', 'news', '', '', 'Последние новости России и мира на тему «Финансы» за сегодня. На сайте site1.radimid.ru в рубрике «Новости» всегда свежая информация за день и неделю.', 'новости, экономика, финансы', '', '', 12, '', '', 'Финансовые новости', 0, 0, '', 0, 0, 0, 0, 1, 1, 1),
(2, 0, 1, 'Кредитование', 'kreditovanie', '', '', 'Полезные статьи о кредитовании.', '', '', '', 12, '', '', 'Кредитование - статьи про кредитование', 0, 1, '', 0, 0, 0, 0, 1, 1, 1),
(3, 0, 1, 'Банковские карты', 'karty', '', '', 'Все о банковских картах - обзоры, отзывы многое другое.', '', '', '', 12, '', '', 'Банковские карты', 0, 1, '', 0, 0, 0, 0, 1, 1, 1),
(4, 0, 1, 'Страхование', 'strahovanie', '', '', 'Статьи о страховании.', '', '', '', 12, '', '', 'Страхование', 0, 1, '', 0, 0, 0, 0, 1, 1, 1),
(5, 0, 1, 'Советы', 'sovety', '', '', 'Статьи с советами для заемщиком и не только.', '', '', '', 12, '', '', 'Финансовые советы для заемщиков', 0, 1, '', 0, 0, 0, 0, 1, 1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `dle_comments`
--

CREATE TABLE `dle_comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `post_id` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `date` datetime NOT NULL DEFAULT '2000-01-01 00:00:00',
  `autor` varchar(40) NOT NULL DEFAULT '',
  `email` varchar(40) NOT NULL DEFAULT '',
  `text` text NOT NULL,
  `ip` varchar(46) NOT NULL DEFAULT '',
  `is_register` tinyint(1) NOT NULL DEFAULT '0',
  `approve` tinyint(1) NOT NULL DEFAULT '1',
  `rating` int(11) NOT NULL DEFAULT '0',
  `vote_num` int(11) NOT NULL DEFAULT '0',
  `parent` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `dle_comments`
--

INSERT INTO `dle_comments` (`id`, `post_id`, `user_id`, `date`, `autor`, `email`, `text`, `ip`, `is_register`, `approve`, `rating`, `vote_num`, `parent`) VALUES
(1, 27, 1, '2019-12-10 23:29:36', 'redaktor', 'info@admin.ru', 'Тестовый коммент', '90.154.72.152', 1, 1, 0, 0, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `dle_comments_files`
--

CREATE TABLE `dle_comments_files` (
  `id` int(10) NOT NULL,
  `c_id` int(10) NOT NULL DEFAULT '0',
  `author` varchar(40) NOT NULL DEFAULT '',
  `date` varchar(15) NOT NULL DEFAULT '',
  `name` varchar(255) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблицы `dle_comment_rating_log`
--

CREATE TABLE `dle_comment_rating_log` (
  `id` int(10) UNSIGNED NOT NULL,
  `c_id` int(11) NOT NULL DEFAULT '0',
  `member` varchar(40) NOT NULL DEFAULT '',
  `ip` varchar(46) NOT NULL DEFAULT '',
  `rating` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблицы `dle_complaint`
--

CREATE TABLE `dle_complaint` (
  `id` int(11) UNSIGNED NOT NULL,
  `p_id` int(11) NOT NULL DEFAULT '0',
  `c_id` int(11) NOT NULL DEFAULT '0',
  `n_id` int(11) NOT NULL DEFAULT '0',
  `text` text NOT NULL,
  `from` varchar(40) NOT NULL DEFAULT '',
  `to` varchar(255) NOT NULL DEFAULT '',
  `date` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `email` varchar(50) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблицы `dle_email`
--

CREATE TABLE `dle_email` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `name` varchar(10) NOT NULL DEFAULT '',
  `template` text NOT NULL,
  `use_html` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `dle_email`
--

INSERT INTO `dle_email` (`id`, `name`, `template`, `use_html`) VALUES
(1, 'reg_mail', '{%username%},\r\n\r\nЭто письмо отправлено с сайта http://site1.radimid.ru/\r\n\r\nВы получили это письмо, так как этот e-mail адрес был использован при регистрации на сайте. Если Вы не регистрировались на этом сайте, просто проигнорируйте это письмо и удалите его. Вы больше не получите такого письма.\r\n\r\n------------------------------------------------\r\nВаш логин и пароль на сайте:\r\n------------------------------------------------\r\n\r\nЛогин: {%username%}\r\nПароль: {%password%}\r\n\r\n------------------------------------------------\r\nИнструкция по активации\r\n------------------------------------------------\r\n\r\nБлагодарим Вас за регистрацию.\r\nМы требуем от Вас подтверждения Вашей регистрации, для проверки того, что введённый Вами e-mail адрес - реальный. Это требуется для защиты от нежелательных злоупотреблений и спама.\r\n\r\nДля активации Вашего аккаунта, зайдите по следующей ссылке:\r\n\r\n{%validationlink%}\r\n\r\nЕсли и при этих действиях ничего не получилось, возможно Ваш аккаунт удалён. В этом случае, обратитесь к Администратору, для разрешения проблемы.\r\n\r\nС уважением,\r\n\r\nАдминистрация http://site1.radimid.ru/.', 0),
(2, 'feed_mail', '{%username_to%},\r\n\r\nДанное письмо вам отправил {%username_from%} с сайта http://site1.radimid.ru/\r\n\r\n------------------------------------------------\r\nТекст сообщения\r\n------------------------------------------------\r\n\r\n{%text%}\r\n\r\nIP адрес отправителя: {%ip%}\r\nГруппа: {%group%}\r\n\r\n------------------------------------------------\r\nПомните, что администрация сайта не несет ответственности за содержание данного письма\r\n\r\nС уважением,\r\n\r\nАдминистрация http://site1.radimid.ru/', 0),
(3, 'lost_mail', 'Уважаемый {%username%},\r\n\r\nВы сделали запрос на получение забытого пароля на сайте http://site1.radimid.ru/ Однако в целях безопасности все пароли хранятся в зашифрованном виде, поэтому мы не можем сообщить вам ваш старый пароль, поэтому если вы хотите сгенерировать новый пароль, зайдите по следующей ссылке: \r\n\r\n{%lostlink%}\r\n\r\nЕсли вы не делали запроса для получения пароля, то просто удалите данное письмо, ваш пароль храниться в надежном месте, и недоступен посторонним лицам.\r\n\r\nIP адрес отправителя: {%ip%}\r\n\r\nС уважением,\r\n\r\nАдминистрация http://site1.radimid.ru/', 0),
(4, 'new_news', 'Уважаемый администратор,\r\n\r\nуведомляем вас о том, что на сайт  http://site1.radimid.ru/ была добавлена новость, которая в данный момент ожидает модерации.\r\n\r\n------------------------------------------------\r\nКраткая информация о новости\r\n------------------------------------------------\r\n\r\nАвтор: {%username%}\r\nЗаголовок новости: {%title%}\r\nКатегория: {%category%}\r\nДата добавления: {%date%}\r\n\r\nС уважением,\r\n\r\nАдминистрация http://site1.radimid.ru/', 0),
(5, 'comments', 'Уважаемый {%username_to%},\r\n\r\nуведомляем вас о том, что на сайт  http://site1.radimid.ru/ был добавлен комментарий к новости, на которую вы были подписаны.\r\n\r\n------------------------------------------------\r\nКраткая информация о комментарии\r\n------------------------------------------------\r\n\r\nАвтор: {%username%}\r\nДата добавления: {%date%}\r\nСсылка на новость: {%link%}\r\n\r\n------------------------------------------------\r\nТекст комментария\r\n------------------------------------------------\r\n\r\n{%text%}\r\n\r\n------------------------------------------------\r\n\r\nЕсли вы не хотите больше получать уведомлений о новых комментариях к данной новости, то проследуйте по данной ссылке: {%unsubscribe%}\r\n\r\nС уважением,\r\n\r\nАдминистрация http://site1.radimid.ru/', 0),
(6, 'pm', 'Уважаемый {%username%},\r\n\r\nуведомляем вас о том, что на сайте  http://site1.radimid.ru/ вам было отправлено персональное сообщение.\r\n\r\n------------------------------------------------\r\nКраткая информация о сообщении\r\n------------------------------------------------\r\n\r\nОтправитель: {%fromusername%}\r\nДата  получения: {%date%}\r\nЗаголовок: {%title%}\r\n\r\n------------------------------------------------\r\nТекст сообщения\r\n------------------------------------------------\r\n\r\n{%text%}\r\n\r\nС уважением,\r\n\r\nАдминистрация http://site1.radimid.ru/', 0),
(7, 'wait_mail', 'Уважаемый {%username%},\r\n\r\nВы сделали запрос на обьединение  вашего аккаунта на сайте http://site1.radimid.ru/ с аккаунтом в социальной сети {%network%}.  Однако в целях безопасности вам необходимо подтвердить данное действие по следующей ссылке: \r\n\r\n------------------------------------------------\r\n{%link%}\r\n------------------------------------------------\r\n\r\nЕсли вы не делали данного запроса, то просто удалите это письмо, данные вашего аккаунта хранятся в надежном месте, и недоступны посторонним лицам.\r\n\r\nIP адрес отправителя: {%ip%}\r\n\r\nС уважением,\r\n\r\nАдминистрация http://site1.radimid.ru/', 0),
(8, 'newsletter', '<html>\r\n<head>\r\n<title>{%title%}</title>\r\n<meta content=\"text/html; charset={%charset%}\" http-equiv=Content-Type>\r\n<style type=\"text/css\">\r\nhtml,body{\r\n    font-family: Verdana;\r\n    word-spacing: 0.1em;\r\n    letter-spacing: 0;\r\n    line-height: 1.5em;\r\n    font-size: 11px;\r\n}\r\n\r\np {\r\n	margin:0px;\r\n	padding: 0px;\r\n}\r\n\r\na:active,\r\na:visited,\r\na:link {\r\n	color: #4b719e;\r\n	text-decoration:none;\r\n}\r\n\r\na:hover {\r\n	color: #4b719e;\r\n	text-decoration: underline;\r\n}\r\n</style>\r\n</head>\r\n<body>\r\n{%content%}\r\n</body>\r\n</html>', 0),
(9, 'twofactor', '{%username%},\r\n\r\nЭто письмо отправлено с сайта http://site1.radimid.ru/\r\n\r\nВы получили это письмо, так как для вашего аккаунта включена двухфакторная авторизация. Для авторизации на сайте вам необходимо ввести полученный вами пин-код.\r\n\r\n------------------------------------------------\r\nПин-код:\r\n------------------------------------------------\r\n\r\n{%pin%}\r\n\r\n------------------------------------------------\r\nЕсли Вы не авторизовывались на нашем сайте, то ваш пароль известен посторонним лицам. Вам нужно незамедлительно зайти на сайт под своим логином и паролем, и в своем профиле изменить свой пароль.\r\n\r\nIP пользователя который ввел пароль: {%ip%}\r\n\r\nС уважением,\r\n\r\nАдминистрация http://site1.radimid.ru/', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `dle_files`
--

CREATE TABLE `dle_files` (
  `id` int(11) NOT NULL,
  `news_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(250) NOT NULL DEFAULT '',
  `onserver` varchar(250) NOT NULL DEFAULT '',
  `author` varchar(40) NOT NULL DEFAULT '',
  `date` varchar(15) NOT NULL DEFAULT '',
  `dcount` int(11) NOT NULL DEFAULT '0',
  `size` bigint(20) NOT NULL DEFAULT '0',
  `checksum` char(32) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблицы `dle_flood`
--

CREATE TABLE `dle_flood` (
  `f_id` int(11) UNSIGNED NOT NULL,
  `ip` varchar(46) NOT NULL DEFAULT '',
  `id` varchar(20) NOT NULL DEFAULT '',
  `flag` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблицы `dle_ignore_list`
--

CREATE TABLE `dle_ignore_list` (
  `id` int(10) UNSIGNED NOT NULL,
  `user` int(11) NOT NULL DEFAULT '0',
  `user_from` varchar(40) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблицы `dle_images`
--

CREATE TABLE `dle_images` (
  `id` int(10) UNSIGNED NOT NULL,
  `images` text NOT NULL,
  `news_id` int(10) NOT NULL DEFAULT '0',
  `author` varchar(40) NOT NULL DEFAULT '',
  `date` varchar(15) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `dle_images`
--

INSERT INTO `dle_images` (`id`, `images`, `news_id`, `author`, `date`) VALUES
(21, '2018-11/1541766501_1kartinka.jpg', 24, 'redaktor', '1541766403'),
(22, '2018-11/1541766636_1kartinka.jpg', 25, 'redaktor', '1541766615'),
(23, '2018-11/1541766817_1kartinka.jpg', 26, 'redaktor', '1541766769'),
(24, '2018-11/1541767020_1kartinka.jpg', 27, 'redaktor', '1541766920'),
(25, '2018-11/1541767207_1kartinka.jpg', 28, 'redaktor', '1541767138'),
(26, '2019-12/1576091117_images.jpg', 36, 'redaktor', '1576091072'),
(27, '2019-12/1576091263_images.jpg', 37, 'redaktor', '1576091240'),
(28, '2019-12/1576091384_images.jpg', 38, 'redaktor', '1576091338');

-- --------------------------------------------------------

--
-- Структура таблицы `dle_links`
--

CREATE TABLE `dle_links` (
  `id` int(11) UNSIGNED NOT NULL,
  `word` varchar(255) NOT NULL DEFAULT '',
  `link` varchar(255) NOT NULL DEFAULT '',
  `only_one` tinyint(1) NOT NULL DEFAULT '0',
  `replacearea` tinyint(1) NOT NULL DEFAULT '1',
  `rcount` tinyint(3) NOT NULL DEFAULT '0',
  `targetblank` tinyint(1) NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблицы `dle_login_log`
--

CREATE TABLE `dle_login_log` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip` varchar(46) NOT NULL DEFAULT '',
  `count` smallint(6) NOT NULL DEFAULT '0',
  `date` int(11) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблицы `dle_logs`
--

CREATE TABLE `dle_logs` (
  `id` int(10) UNSIGNED NOT NULL,
  `news_id` int(10) NOT NULL DEFAULT '0',
  `member` varchar(40) NOT NULL DEFAULT '',
  `ip` varchar(46) NOT NULL DEFAULT '',
  `rating` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблицы `dle_lostdb`
--

CREATE TABLE `dle_lostdb` (
  `id` mediumint(8) NOT NULL,
  `lostname` mediumint(8) NOT NULL DEFAULT '0',
  `lostid` varchar(40) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблицы `dle_mail_log`
--

CREATE TABLE `dle_mail_log` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `mail` varchar(50) NOT NULL DEFAULT '',
  `hash` varchar(40) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблицы `dle_metatags`
--

CREATE TABLE `dle_metatags` (
  `id` int(11) UNSIGNED NOT NULL,
  `url` varchar(250) NOT NULL DEFAULT '',
  `title` varchar(200) NOT NULL DEFAULT '',
  `description` varchar(300) NOT NULL DEFAULT '',
  `keywords` text NOT NULL,
  `page_title` varchar(255) NOT NULL DEFAULT '',
  `page_description` text NOT NULL,
  `robots` varchar(255) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблицы `dle_mfo_comments`
--

CREATE TABLE `dle_mfo_comments` (
  `id` mediumint(8) NOT NULL,
  `author` char(40) NOT NULL,
  `author_id` mediumint(8) NOT NULL,
  `email` char(255) NOT NULL,
  `text` text NOT NULL,
  `name_otziv` text NOT NULL,
  `tit_otziv` text NOT NULL,
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `mfo_id` mediumint(8) NOT NULL,
  `del` tinyint(1) NOT NULL DEFAULT '0',
  `ip` char(255) NOT NULL,
  `answer` mediumint(10) NOT NULL DEFAULT '0',
  `approve` tinyint(4) NOT NULL,
  `otziv` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `dle_mfo_options`
--

CREATE TABLE `dle_mfo_options` (
  `id` int(10) NOT NULL,
  `type` char(255) NOT NULL,
  `options` text NOT NULL,
  `sort` smallint(8) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `dle_mfo_options`
--

INSERT INTO `dle_mfo_options` (`id`, `type`, `options`, `sort`) VALUES
(1, 'category', 'type=category|||name=Все микрофинансовые организации|||alt_name=all|||template=|||icon=|||title_h=Микрофинансовые организации|||description=Все МФО России в одном каталоге. Полная информация о микрофинансовых организациях, рейтинг и отзывы клиентов.|||keywords=|||cat=0|||count_post=-2', 1),
(491, 'blocks', 'title=Рейтинг на главной|||post_type=default|||post_sort=desc|||cats_type=only|||cache=120|||max_post=5|||template=rate|||post_photo=no|||AllowCats=all', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `dle_mfo_post`
--

CREATE TABLE `dle_mfo_post` (
  `id` int(10) NOT NULL,
  `title` char(255) NOT NULL,
  `title_full` char(255) NOT NULL,
  `titlelink` char(255) NOT NULL,
  `description` char(255) NOT NULL,
  `keywords` char(255) NOT NULL,
  `title_rek` char(255) NOT NULL,
  `title_rek_seo` char(255) NOT NULL,
  `description_rek` char(255) NOT NULL,
  `alt_name` char(255) NOT NULL,
  `text` text NOT NULL,
  `author` varchar(255) NOT NULL,
  `author_id` mediumint(8) NOT NULL,
  `comm_num` smallint(10) NOT NULL DEFAULT '0',
  `category` char(255) NOT NULL,
  `allow_comm` tinyint(1) NOT NULL DEFAULT '0',
  `xfields` text NOT NULL,
  `photos` text NOT NULL,
  `views` mediumint(8) NOT NULL DEFAULT '0',
  `color` char(255) NOT NULL,
  `color_date` int(11) NOT NULL,
  `approve` tinyint(1) NOT NULL DEFAULT '0',
  `rate` varchar(255) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `dle_mfo_post`
--

INSERT INTO `dle_mfo_post` (`id`, `title`, `title_full`, `titlelink`, `description`, `keywords`, `title_rek`, `title_rek_seo`, `description_rek`, `alt_name`, `text`, `author`, `author_id`, `comm_num`, `category`, `allow_comm`, `xfields`, `photos`, `views`, `color`, `color_date`, `approve`, `rate`) VALUES
(2881, 'Платиза.ру', 'Платиза.ру', 'Информация о МФО Платиза.ру', '', '', 'Отзывы о МФО Платиза.ру', 'Отзывы клиентов о МФО Платиза.ру', '', 'mfo-platizaru', '<p>ООО \\\"Платиза.ру\\\" работает на рынке микрофинансирования с 2016 года. ООО \\\"Платиза.ру\\\" выдает микрокредиты, микрозаймы всем категориям лиц.</p>', 'redaktor', 0, 0, '1', 1, 'polnoe-nazvanie-banka=Общество с ограниченной ответственностью \"Микрокредитная компания Азимут\"|||polnaja-licenzija=Рег. номер: 01603045007976|||licenzija-=01603045007976|||juridicheskij-adres=121609, г. Москва, ул. Осенняя, д. 23, оф. I, комн. 16|||gorjachaja-linija=+7 (905) 931-95-02|||ogrn=1167746378910|||inn=7731313932', '1535375687_mfo_azimut.png###2018-08', 15, '', 0, 1, '0'),
(2882, 'Займер', 'Займер', 'Информация о МФО Займер', '', '', 'Отзывы о МФО Займер', 'Отзывы клиентов о МФО Займер', '', 'mfo-zaymert', '<p>ООО МФО &laquo;Займер&raquo; предлагает свои услуги в области микрофинансирования. ООО МФО &laquo;Займер&raquo; выдает микрокредиты, микрозаймы, краткосрочные займы всем категориям лиц.</p>', 'redaktor', 0, 0, '1', 1, 'polnoe-nazvanie-banka=Общество с ограниченной ответственностью \"МИКРОКРЕДИТНАЯ КОМПАНИЯ \"АЗБУКА ДЕНЕГ\"|||polnaja-licenzija=Рег. номер: 01503703006492|||licenzija-=01503703006492|||juridicheskij-adres=354340, Краснодарский край, г. Сочи, ул. Старонасыпная, д. 22, оф. 710|||gorjachaja-linija=|||ogrn=1152367002094|||inn=2317076884', '1535375376_mfo_azbuka_deneg.png###2018-08', 68, '', 0, 1, '0');

-- --------------------------------------------------------

--
-- Структура таблицы `dle_notice`
--

CREATE TABLE `dle_notice` (
  `id` mediumint(8) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `notice` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `dle_notice`
--

INSERT INTO `dle_notice` (`id`, `user_id`, `notice`) VALUES
(1, 1, '');

-- --------------------------------------------------------

--
-- Структура таблицы `dle_offers_comments`
--

CREATE TABLE `dle_offers_comments` (
  `id` mediumint(8) NOT NULL,
  `author` char(40) NOT NULL,
  `author_id` mediumint(8) NOT NULL,
  `email` char(255) NOT NULL,
  `text` text NOT NULL,
  `otziv` text NOT NULL,
  `tit_otziv` text NOT NULL,
  `name_otziv` text NOT NULL,
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `offers_id` mediumint(8) NOT NULL,
  `del` tinyint(1) NOT NULL DEFAULT '0',
  `ip` char(255) NOT NULL,
  `answer` mediumint(10) NOT NULL DEFAULT '0',
  `approve` tinyint(4) NOT NULL,
  `otz` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `dle_offers_comments`
--

INSERT INTO `dle_offers_comments` (`id`, `author`, `author_id`, `email`, `text`, `otziv`, `tit_otziv`, `name_otziv`, `date`, `offers_id`, `del`, `ip`, `answer`, `approve`, `otz`) VALUES
(298, 'redaktor', 1, 'info@admin.ru', 'Тестовый отзыв', '5', 'выапы вап ывап ыв', 'Иванов Сергей', '2019-12-11 15:44:00', 2777, 0, '90.154.72.152', 0, 1, '');

-- --------------------------------------------------------

--
-- Структура таблицы `dle_offers_options`
--

CREATE TABLE `dle_offers_options` (
  `id` int(10) NOT NULL,
  `type` char(255) NOT NULL,
  `options` text NOT NULL,
  `sort` smallint(8) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `dle_offers_options`
--

INSERT INTO `dle_offers_options` (`id`, `type`, `options`, `sort`) VALUES
(342, 'category', 'name=Кредиты наличными &421& Оформить онлайн заявку|||alt_name=kredity-nalichnymi|||template=|||icon=|||title_h=Кредиты наличными|||description=Какие банки выдают кредиты наличными и какие документы для этого потребуются.|||opisanie=|||keywords=|||cat=1|||count_post=', 10),
(341, 'category', 'name=Кредиты наличными в день обращения - взять кредит в день обращения по паспорту|||alt_name=kredity-nalichnymi-v-den-obraschenija|||template=|||icon=|||title_h=Кредиты в день обращения|||description=Какие банки одобряют кредиты в день обращения. Перечень документов для оформления кредита в день обращения.|||opisanie=|||keywords=|||cat=1|||count_post=', 9),
(340, 'category', 'name=Кредиты наличными без поручителей и залога оформить|||alt_name=kredity-nalichnymi-bez-poruchitelej-i-zaloga|||template=|||icon=|||title_h=Кредиты без поручителей и залога|||description=Кредиты наличными без поручителей и залога дают все банки — сверьте выгодные предложения всех банков. Высокий процент одобрения.|||opisanie=|||keywords=|||cat=1|||count_post=', 8),
(338, 'category', 'name=Кредиты наличными без комиссии и переплат &421& Оформить онлайн заявку|||alt_name=kredity-bez-komissii-i-pereplat|||template=|||icon=|||title_h=Кредиты без комиссии и переплат|||description=Потребительские кредиты без комиссии и переплат, дают возможность заемщикам экономить на ежемесячных расходах.|||opisanie=|||keywords=|||cat=1|||count_post=', 6),
(339, 'category', 'name=Кредиты наличными без справок о доходах|||alt_name=kredity-nalichnymi-bez-spravok-o-dohodah|||template=|||icon=|||title_h=Кредиты без справок о доходах|||description=Кредит наличными без справок о доходах — это потребительский кредит, для получения которого нужен только паспорт.|||opisanie=|||keywords=|||cat=1|||count_post=0', 7),
(322, 'blocks', 'title=Дебетовые карты (главная модуля)|||post_type=color|||post_sort=desc|||cats_type=only|||cache=120|||max_post=1|||template=main-debetcard|||post_photo=no|||AllowCats=4', 1),
(323, 'blocks', 'title=Микрозаймы (главная модуля)|||post_type=color|||post_sort=desc|||cats_type=only|||cache=120|||max_post=1|||template=main-zaymi|||post_photo=no|||AllowCats=3', 2),
(324, 'blocks', 'title=Кредитные карты|||post_type=color|||post_sort=desc|||cats_type=only|||cache=120|||max_post=10|||template=default-card|||post_photo=no|||AllowCats=2', 3),
(3, 'category', 'name=Микрозаймы &421& Взять онлайн займ|||alt_name=mikrozajmy|||template=zaymi|||icon=|||title_h=Микрозаймы|||description=Микрозайм — сверьте выгодные предложения всех компаний и выбирайте лучшее. Все МФО с высоким процентом одобрения, развернутые условия и реальные отзывы заемщиков.|||opisanie=<p>Тут текст какой то</p>|||opisanie_up=<p>Бывают ситуации, когда обращаясь в один МФО и получив отказ, вы подаете заявку в следующий, где происходит повторение отказа. Для упрощения задачи и был создан сервис для нахождения микрозаймов данный сайт.</p>|||keywords=|||cat=0|||count_post=20', 2),
(4, 'category', 'name=Дебетовые карты &421& Оформить онлайн заявку|||alt_name=debetovye-karty|||template=debetcard|||icon=|||title_h=Дебетовые карты|||description=Список банков где можно получить дебетовую карту с онлайн оформлением. Узнайте все условия обслуживания.|||opisanie=<p>Тут сео текст</p>|||opisanie_up=<p>Дебетовки выпускаются на основе трех основных платежных систем: VISA, Mastercard, МИР. Национальная платежная система МИР только набирает обороты.</p>|||keywords=|||cat=0|||count_post=6', 4),
(1, 'category', 'name=Потребительские кредиты оформить заявку онлайн|||alt_name=potrebitelskij-kredit|||template=|||icon=|||title_h=Потребительские кредиты|||description=Потребительские кредиты — сверьте самые выгодные предложения от всех банков и выбирайте лучшее на нашем портале site1.radimid.ru.|||opisanie=<p>Тут <b>какой-то</b> текст</p>|||opisanie_up=<p>Чтобы получить деньги в кредит наличными нужно быть старше 21-го года. При этом многие банки ставят возрастное ограничение в 65 лет (на момент выплаты кредитного займа).</p>|||keywords=|||cat=0|||count_post=5', 1),
(2, 'category', 'name=Кредитные карты онлайн заявка для всех|||alt_name=kreditnye-karty|||template=krcard|||icon=|||title_h=Кредитные карты|||description=Список всех банков где можно оформить кредитную карту с онлайн заявкой. Узнайте все условия и процентные ставки.|||opisanie=<p>Тут сео <b>описание</b></p>|||opisanie_up=<p>Банковская карта хорошо заменяет наличные средства оплаты. Это очень выгодно как в повседневной жизни, так и для поездок в другие страны (при наличии на карте отличительного знака VISA).</p>|||keywords=|||cat=0|||count_post=8', 3),
(343, 'category', 'name=Кредиты наличными на товары и услуги &421& оформить онлайн заявку|||alt_name=kredity-nalichnymi-na-tovary-i-uslugi|||template=|||icon=|||title_h=Кредиты на товары и услуги|||description=Выгодные кредиты на товары или услуги предлагают банки, что позволяет заемщикам покупать в кредит любые товары и услуги на выгодных условиях. |||opisanie=|||keywords=|||cat=1|||count_post=', 11),
(344, 'category', 'name=Кредиты на образование, взять кредит на учебу|||alt_name=kredity-na-obrazovanie|||template=|||icon=|||title_h=Кредиты на образование|||description=В каких банках выдают кредиты на образование, особенности кредитования, условия получения.|||opisanie=|||keywords=|||cat=1|||count_post=', 12),
(345, 'category', 'name=Кредиты наличными по паспорту без справок|||alt_name=kredity-nalichnymi-po-pasportu|||template=|||icon=|||title_h=Кредиты по паспорту|||description=Оформить кредит наличными по паспорту без справок о доходах и поручителей можно далеко не в любом банке.|||opisanie=|||keywords=|||cat=1|||count_post=', 13),
(382, 'category', 'name=Микрозаймы 100 процентов одобрения онлайн|||alt_name=mikrozajmy-100-procentov-odobrenija|||template=zaymi|||icon=|||title_h=Микрозаймы 100 процентов одобрения|||description=Микрозаймы 100% одобрения. Список микрофинансовых организаций дающие сто процентное одобрение на получение займа, условия, процентные ставки.|||opisanie=|||keywords=|||cat=3|||count_post=', 100),
(383, 'category', 'name=Микрозаймы без отказа онлайн: быстро и срочно|||alt_name=mikrozajmy-bez-otkaza-onlajn|||template=zaymi|||icon=|||title_h=Микрозаймы без отказа|||description=Микрозаймы без отказа - это лучшее решение для всех категорий заемщиков! Мы сотрудничаем только с проверенными и надежными микрофинансовыми компаниями.|||opisanie=|||keywords=|||cat=3|||count_post=', 101),
(384, 'category', 'name=Микрозаймы без паспорта и паспортных данных|||alt_name=mikrozajmy-bez-pasporta|||template=zaymi|||icon=|||title_h=Микрозаймы без паспорта|||description=Список микрофинансовых организаций выдающих займы без паспорта и паспортных данных, условия, процентные ставки, документы.|||opisanie=|||keywords=|||cat=3|||count_post=', 102),
(385, 'category', 'name=Микрозаймы без справок и поручителей для всех|||alt_name=mikrozajmy-bez-spravok-i-poruchitelej|||template=zaymi|||icon=|||title_h=Микрозаймы без справок и поручителей|||description=Список микрофинансовых организаций выдающих займы до 20000 рублей без справок и поручителей, условия, процентные ставки, документы.|||opisanie=|||keywords=|||cat=3|||count_post=', 103),
(386, 'category', 'name=Микрозаймы без прописки в паспорте онлайн|||alt_name=mikrozajm-bez-propiski-v-pasporte|||template=zaymi|||icon=|||title_h=Микрозаймы без прописки|||description=Список микрофинансовых организаций выдающих займы без прописки в паспорте, процентные ставки и условия. Высокий процент одобрения.|||opisanie=|||keywords=|||cat=3|||count_post=', 104),
(387, 'category', 'name=Микрозаймы безработным на карту без отказа|||alt_name=mikrozajmy-bezrabotnym-na-kartu|||template=zaymi|||icon=|||title_h=Микрозаймы безработным|||description=Список микрофинансовых организаций которые не требуют официального трудоустройства при выдаче займа, процентные ставки и условия.|||opisanie=|||keywords=|||cat=3|||count_post=', 105),
(388, 'category', 'name=Срочные микрозаймы для всех|||alt_name=srochnye-mikrozajmy|||template=zaymi|||icon=|||title_h=Срочные микрозаймы|||description=Список микрофинансовых организаций выдающих срочных займы на карту, процентные ставки, условия. Займы выдаются круглосуточно и без посещения офиса.|||opisanie=|||keywords=|||cat=3|||count_post=', 106),
(389, 'category', 'name=Микрозаймы не выходя из дома для каждого|||alt_name=mikrozajmy-ne-vyhodja-iz-doma|||template=zaymi|||icon=|||title_h=Микрозаймы не выходя из дома|||description=Список микрофинансовых организаций где взять займ не выходя из дома, условия и процентные ставки. |||opisanie=|||keywords=|||cat=3|||count_post=', 107),
(438, 'category', 'name=Кредитные карты с плохой кредитной историей онлайн|||alt_name=kreditnye-karty-s-plohoj-kreditnoj-istoriej|||template=krcard|||icon=|||title_h=Кредитные карты с плохой кредитной историей|||description=Список всех банков которые выдают кредитные карты онлайн с плохой кредитной историей. Узнайте все условия и процентные ставки.|||opisanie=|||keywords=|||cat=2|||count_post=', 200),
(439, 'category', 'name=Самые выгодные кредитные карты онлайн|||alt_name=samye-vygodnye-kreditnye-karty|||template=krcard|||icon=|||title_h=Выгодные кредитные карты|||description=Список выгодных предложение по оформлению кредитных карт. Узнайте все условия и процентные ставки.|||opisanie=|||keywords=|||cat=2|||count_post=', 201),
(440, 'category', 'name=Кредитные карты с заявкой через интернет для каждого|||alt_name=kreditnye-karty-s-zajavkoj-cherez-internet|||template=krcard|||icon=|||title_h=Кредитные карты с заявкой через интернет|||description=Заказать кредитную карту через интернет – просто и быстро. Для этого необходимо заполнить заявку с личными данными оформляющего и, при необходимости, информацию об официальном месте работы.|||opisanie=|||keywords=|||cat=2|||count_post=', 202),
(441, 'category', 'name=Кредитные карты без отказа и проверок|||alt_name=kreditnye-karty-bez-otkaza|||template=krcard|||icon=|||title_h=Кредитные карты без отказа|||description=Список банков где получить кредитные карты без проверок и отказов. Узнайте условия, процентные ставки.|||opisanie=|||keywords=|||cat=2|||count_post=', 203),
(442, 'category', 'name=Кредитные карты по паспорту с онлайн заявкой|||alt_name=kreditnye-karty-po-pasportu|||template=krcard|||icon=|||title_h=Кредитные карты по паспорту|||description=Список банков где можно оформить кредитную карту по паспорту без посещения офиса. Узнайте условия и процентные ставки.|||opisanie=|||keywords=|||cat=2|||count_post=', 204),
(443, 'category', 'name=Кредитные карты в день обращения для всех|||alt_name=kreditnye-karty-v-den-obraschenija|||template=krcard|||icon=|||title_h=Кредитные карты в день обращения|||description=Список банков выдающих кредитные карты в день обращения. Узнайте все условия и процентные ставки.|||opisanie=|||keywords=|||cat=2|||count_post=', 205),
(444, 'category', 'name=Кредитные карты без справок о доходах срочно|||alt_name=kreditnye-karty-bez-spravok-o-dohodah|||template=krcard|||icon=|||title_h=Кредитные карты без справок о доходах|||description=Список банков где можно оформить кредитную карту без справок о доходах. Узнайте условия и процентные ставки.|||opisanie=|||keywords=|||cat=2|||count_post=', 206),
(445, 'category', 'name=Кредитные карты с бесплатным льготным периодом |||alt_name=kreditnye-karty-s-besplatnym-lgotnym-periodom|||template=krcard|||icon=|||title_h=Кредитные карты с льготным периодом|||description=Список банков где получить кредитную карту с льготным переодом. Узнайте условия и процентные ставки.|||opisanie=|||keywords=|||cat=2|||count_post=', 207),
(446, 'category', 'name=Калькулятор кредитных карт онлайн|||alt_name=kalkuljator-kreditnyh-kart|||template=krcard|||icon=|||title_h=Калькулятор кредитных карт|||description=Если вы решили получить кредитную карту, но знаете, какую выбрать, наш калькулятор кредитной карты онлайн поможет вам в этом разобраться.|||opisanie=|||keywords=|||cat=2|||count_post=', 208),
(447, 'category', 'name=Кредитные карты с кэшбеком для всех|||alt_name=kreditnye-karty-s-kjeshbekom|||template=krcard|||icon=|||title_h=Кредитные карты с кэшбеком|||description=Список банков где можно получить кредитную карту с кэшбеком не выходя из дома. Узнайте условия и процентные ставки.|||opisanie=|||keywords=|||cat=2|||count_post=', 209),
(477, 'category', 'name=Дебетовые карты с кэшбеком, оформить онлайн заявку|||alt_name=debetovye-karty-s-kjeshbekom|||template=debetcard|||icon=|||title_h=Дебетовые карты с кэшбеком|||description=Список банков выдающих дебетовые карты с кэшбеком на выгодных условиях. Узнайте все условия оформления.|||opisanie=|||keywords=|||cat=4|||count_post=', 300),
(478, 'category', 'name=Виртуальные дебетовые карты - все предложения банков|||alt_name=virtualnye-debetovye-karty|||template=debetcard|||icon=|||title_h=Виртуальные дебетовые карты|||description=Список банков где можно оформить виртуальную дебетовую карту. Узнайте все условия оформления.|||opisanie=|||keywords=|||cat=4|||count_post=', 301),
(479, 'category', 'name=Дебетовые карты с овердрафтом, оформить онлайн заявку|||alt_name=debetovye-karty-s-overdraftom|||template=debetcard|||icon=|||title_h=Дебетовые карты с овердрафтом|||description=Список банков где можно оформить дебетовую карту с овердрафтом онлайн. Все условия получения карты.|||opisanie=|||keywords=|||cat=4|||count_post=', 302),
(480, 'category', 'name=Дебетовые карты с бесплатным обслуживанием, онлайн заявка|||alt_name=debetovye-karty-s-besplatnym-obsluzhivaniem|||template=debetcard|||icon=|||title_h=Дебетовые карты с бесплатным обслуживанием|||description=Список банков выдающих дебетовые карты с бесплатным годовым обслуживанием. Узнайте все условия оформления.|||opisanie=|||keywords=|||cat=4|||count_post=', 303),
(481, 'category', 'name=Дебетовые карты с начислением процентов на остаток - все предложения банков|||alt_name=debetovye-karty-s-nachisleniem-procentov-na-ostatok|||template=debetcard|||icon=|||title_h=Дебетовые карты с начислением процентов на остаток|||description=Список банков предоставляющий дебетовые карты с начислением процентов на остаток. Узнайте все условия оформления.|||opisanie=|||keywords=|||cat=4|||count_post=', 304),
(482, 'category', 'name=Дебетовые карты с бонусами на покупки - все предложения|||alt_name=debetovye-karty-s-bonusami-na-pokupki|||template=debetcard|||icon=|||title_h=Дебетовые карты с бонусами на покупки|||description=Список банков где можно получить дебетовую карту с бонусами на покупки. Узнайте все условия оформления и обслуживания.|||opisanie=|||keywords=|||cat=4|||count_post=', 305),
(483, 'category', 'name=Дебетовые карты VISA - оформить карту VISA онлайн|||alt_name=debetovye-karty-visa|||template=debetcard|||icon=|||title_h=Дебетовые карты VISA|||description=Список банков выдающих дебетовые карты VISA. Узнайте все условия оформления и обслуживания.|||opisanie=|||keywords=|||cat=4|||count_post=', 306),
(484, 'category', 'name=Дебетовые карты MasterCard - оформить карту MasterCard онлайн|||alt_name=debetovye-karty-mastercard|||template=debetcard|||icon=|||title_h=Дебетовые карты MasterCard|||description=Список банков где можно оформить дебетовую карту MasterCard онлайн. Все условия получения и обслуживания карты.|||opisanie=|||keywords=|||cat=4|||count_post=', 307),
(485, 'category', 'name=Дебетовые карты для путешествий - оформить онлайн|||alt_name=debetovye-karty-dlja-puteshestvij|||template=debetcard|||icon=|||title_h=Дебетовые карты для путешествий|||description=Список банков где можно оформить банковскую карту для путешествий. Узнайте все условия оформления и обслуживания.|||opisanie=|||keywords=|||cat=4|||count_post=', 308),
(486, 'category', 'name=Выгодные дебетовые карты - все предложения банков|||alt_name=vygodnye-debetovye-karty|||template=debetcard|||icon=|||title_h=Выгодные дебетовые карты|||description=Список выгодных дебетовых карт от известных Российских банков. Узнайте все условия оформления и обслуживания.|||opisanie=|||keywords=|||cat=4|||count_post=', 309),
(495, 'blocks', 'title=Кредит наличными (главная модуля)|||post_type=color|||post_sort=asc|||cats_type=only|||cache=120|||max_post=1|||template=main-nalich|||post_photo=no|||AllowCats=1', 1),
(496, 'blocks', 'title=Кредитные карты (главная модуля)|||post_type=color|||post_sort=desc|||cats_type=only|||cache=120|||max_post=1|||template=main-creditcard|||post_photo=no|||AllowCats=2', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `dle_offers_post`
--

CREATE TABLE `dle_offers_post` (
  `id` int(10) NOT NULL,
  `title` char(255) NOT NULL,
  `titlelink` char(255) NOT NULL,
  `description` char(255) NOT NULL,
  `keywords` char(255) NOT NULL,
  `alt_name` char(255) NOT NULL,
  `text` text NOT NULL,
  `author` varchar(255) NOT NULL,
  `author_id` mediumint(8) NOT NULL,
  `comm_num` smallint(10) NOT NULL DEFAULT '0',
  `category` char(255) NOT NULL,
  `allow_comm` tinyint(1) NOT NULL DEFAULT '0',
  `xfields` text NOT NULL,
  `photos` text NOT NULL,
  `views` mediumint(8) NOT NULL DEFAULT '0',
  `color` char(255) NOT NULL,
  `color_date` int(11) NOT NULL,
  `approve` tinyint(1) NOT NULL DEFAULT '0',
  `rate` varchar(255) NOT NULL DEFAULT '0',
  `sort` varchar(255) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `dle_offers_post`
--

INSERT INTO `dle_offers_post` (`id`, `title`, `titlelink`, `description`, `keywords`, `alt_name`, `text`, `author`, `author_id`, `comm_num`, `category`, `allow_comm`, `xfields`, `photos`, `views`, `color`, `color_date`, `approve`, `rate`, `sort`) VALUES
(2775, 'Райффайзенбанк', 'Кредит «Персональный» от Райффайзенбанка - отзывы, условия, оформить онлайн', 'Кредит на счет без залога и поручительства на любые цели от Райффайзенбанка с минимальной ставкой 9,99% годовых.', 'Райффайзенбанк, кредит', 'rajffajzenbank', '<!--dle_list-->\r\n<ul>\r\n<li>При подаче заявки необходимо предоставить наименование компании-работодателя, фактический адрес и номер телефона компании.<br><br></li>\r\n<!--dle_li-->\r\n<li>Заемщик - физическое лицо, не являющееся индивидуальным предпринимателем, собственником бизнеса, адвокатом, учредившим адвокатский кабинет, (за исключением адвокатов, являющихся членами адвокатских коллегий/адвокатских бюро/юридических консультаций, нотариусов (в т.ч. нотариусов, занимающихся частной практикой)).<br><br></li>\r\n<!--dle_li-->\r\n<li>Предоставление документов, подтверждающих доход по форме 3-НДФЛ возможно для нотариусов, занимающихся частной практикой или при подтверждении дохода от сдачи собственности в аренду.<br><br></li>\r\n<!--dle_li-->\r\n<li>Подтверждение занятости не требуется при сумме кредита не более 500 000 рублей.<br><br></li>\r\n<!--dle_li-->\r\n<li>Ежемесячный совокупный собственный доход заемщика после налогообложения за последние 6 месяцев по справке 2-НДФЛ составляет: 25 000 рублей - для Москвы и Московской области, Санкт-Петербурга и Ленинградской области; 15 000 рублей - для всех остальных регионов.</li>\r\n</ul>\r\n<!--dle_list_end-->\r\n<p><br><br>В рамках данного предложения бесплатно выпускается дебетовая карта MasterCard Standard.<br><br>Возможность отсрочки первого платежа на 2 месяца.<br><br>Ставка 9.99% <u>действует</u> со второго <i>года</i> кредита.<br><br>Для зарплатных клиентов кредит выдается только по паспорту.</p>', 'redaktor', 0, 0, '1,338,339,340,341,342,343,344,345', 1, 'procentnaya-stavka=от 10.99%|||opisanie=АО «Райффайзенбанк» является дочерним подразделением одного из крупнейших банков Австрии с одноимённым названием. Данная кредитная организация является одной из самых развитых на российском рынке. Всем своим клиентам она предлагает полный комплекс банковских услуг, работая как с физическими, так и юридическими лицами. Банк довольно активен на валютном и межбанковском рынке.|||minimal.-summa=от 90 000 руб.|||summa=до 2 000 000 руб.|||srok-kredita=до 60 мес.|||rabota=Стаж на последнем месте работы от 3 месяцев|||vozrast=от 23 года|||dokumenty=Паспорт, доход - подтверждаемый справкой 2 НДФЛ 25 000 рублей (Москва и Санкт-Петербург), 15 000 рублей (другие регионы РФ), копия трудовой книжки.|||reshenie=от 15 минут|||poluchenie=Выдача кредита происходит в отделениях банка|||opisanie-2=Кредит «Персональный»|||opisanie-3=Райффайзенбанк|||opisanie-4=|||refer-ssylka=https://pxl.leads.su/click/d67eec2f1d3a80855a906a265024fe4b|||id-klassa-ssylki=rayfaz|||lgotnyj-period=|||godovoe-obsluzhivanie=|||cashback-karty-deb.=|||nomer-licenzii-cb=', '1527852220_raifayzen.png###2018-06', 30, '', 0, 1, '0', '0'),
(2769, 'Уральский Банк реконструкции и развития', 'Кредит «Открытый» от Уральского Банка реконструкции и развития - отзывы, условия, оформить', 'Выгодное кредитное предложение от УБРиР со ставкой от 11,9% и максимальным сроком до 5 лет.', 'УБРиР', 'uralskij-bank-rekonstrukcii-i-razvitija', 'Кредиты до 200000,00 рублей выдаются без подтверждения дохода.<br><br>В зависимости от оценки кредитоспособности заемщика, годовые ставки по кредиту могут быть следующими: 11,99%, 15%, 18%, 20%, 25/36% с возможностью снижения до 17% в течение года.<br><br>Для каждого этапа снижения процентной ставки необходимо предоставить справку о доходах по форме 2-НДФЛ или по форме банка за последние 6 месяцев.<br><br>Пени, начисляемые в случае нарушения сроков возврата кредита, уплаты процентов за пользование каждым из указанных кредитов: 20% годовых от суммы просроченной задолженности по кредиту или процентам.', 'redaktor', 0, 0, '1,338,339,340,341,342,343,344,345', 1, 'procentnaya-stavka=от 11.99%|||opisanie=ОАО «Уральский банк реконструкции и развития» (УБРиР) является открытым акционерным обществом, зарегистрированным в 1990 году. Деятельность банка регулируется ЦБ РФ в соответствии с генеральной лицензией №429 от 16.08.2012 и предоставляет полный комплекс банковских услуг для корпоративных клиентов, занятых в различных сферах деятельности, клиентов, занимающихся малым бизнесом и частных лиц.|||minimal.-summa=от 50 000 руб.|||summa=до 1 000 000 руб.|||srok-kredita=до 60 мес.|||rabota=Стаж на последнем месте работы от 3 месяцев|||vozrast=от 21 года до 75 лет|||dokumenty=Паспорт, справка о доходах 2-НДФЛ или по форме банка|||reshenie=от 15 минут|||poluchenie=Выдача кредита происходит в отделениях банка|||opisanie-2=Кредит «Открытый»|||opisanie-3=УБРиР|||opisanie-4=|||refer-ssylka=https://pxl.leads.su/click/3f69b3dc1d9de38704fbe0e7fcc8a11d|||id-klassa-ssylki=vostokminuta|||lgotnyj-period=|||godovoe-obsluzhivanie=|||cashback-karty-deb.=|||nomer-licenzii-cb=', '1534072865_ubrr.png###2018-08', 268, '', 0, 1, '74', '0'),
(2770, 'Тинькофф Банк', 'Кредит наличными от Тинькофф банка - условия, отзывы, оформить', 'Все актуальны условия кредита наличными в Тинькофф Банке, а так же отзывы и рекомендации.', 'Тинькофф Банк', 'tinkoff-bank', '<p>Кэшбэк. От 1% до 30% от суммы покупки вернутся деньгами.<br><br>Бесплатное годовое обслуживание карты, если активен кредит.<br><br>Снимайте наличные без комиссии от 3 000 ₽ в ближайшем банкомате, до 3 000 ₽ комиссия составит 90 ₽.<br><br>Погасить кредит можно: моментальным переводом с банковской карты другого банка, бесплатным переводом из любого банка (1-2 рабочих дня), без комиссии наличными у партнеров в любой из 300 000 точек пополнений.<br><br>Документы для оформления кредита доставляются курьером и подписываются в любом удобном для вас месте.</p>', 'redaktor', 0, 0, '1,338,339,340,341,342,343,344,345', 1, 'procentnaya-stavka=от 12.00%|||opisanie=Банк был зарегистрирован в январе 1994 года как Химмашбанк. В 2005 году стал участником системы страхования вкладов, а в 2006 году был приобретен известным бизнесменом Олегом Тиньковым* и переименован в ЗАО «Тинькофф Кредитные Системы», а также переориентирован на работу с физическими лицами. На данный момент является единственным банк обслуживающий клиентов дистанционно.|||minimal.-summa=от 50 000 руб.|||summa=до 1 000 000 руб.|||srok-kredita=до 36 мес.|||rabota=Стаж на последнем месте работы от 3 месяцев|||vozrast=от 18 лет|||dokumenty=Паспорт|||reshenie=10 минут|||poluchenie=Карта выданная курьером при подписании документов|||opisanie-2=Кредит «Наличными»|||opisanie-3=Тинькофф Банк|||opisanie-4=|||refer-ssylka=https://pxl.leads.su/click/fefff708f695d23fc5166293ed7ddc2f|||id-klassa-ssylki=tinkoffnal|||lgotnyj-period=|||godovoe-obsluzhivanie=|||cashback-karty-deb.=|||nomer-licenzii-cb=', '1534072848_tinkoff.png###2018-08', 254, '', 1602450000, 1, '4', '0'),
(2771, 'Альфа-Банк', 'Кредит «Наличными» от Альфа-Банка - отзывы, условия, оформить', 'Уникальное кредитное предложение от Альфа-Банка до 1000000 рублей со ставкой 11,99%', 'Альфа-Банк', 'alfa-bank', 'Постоянный доход от 10 000 рублей после вычета налогов.<br><br>Необязательные документы: справка 2-НДФЛ или по форме банка, копия трудовой книжки.<br><br>Банк вправе запросить дополнительную информацию, а также документы, необходимые для подтверждения информации.<br><br>Индивидуальным предпринимателям и их работникам продукт кредит наличными не предоставляется.<br><br>Неустойка 0,1% от суммы просроченной задолженности за каждый день нарушения обязательств.', 'redaktor', 0, 0, '1,338,339,340,341,342,343,344,345', 1, 'procentnaya-stavka=от 11.99%|||opisanie=ОАО «Альфа-Банк» был основан в 1990 году. ОАО «Альфа-Банк» является универсальным банком, осуществляющим все основные виды банковских операций, представленных на рынке финансовых услуг, включая обслуживание частных и корпоративных клиентов, инвестиционный банковский бизнес, торговое финансирование и управление активами.|||minimal.-summa=от 50 000 руб.|||summa=до 1 000 000 руб.|||srok-kredita=до 60 мес.|||rabota=Стаж на последнем месте работы от 3 месяцев|||vozrast=от 21 года|||dokumenty=Паспорт, + второй документ на выбор (загранпаспорт, водительские права, СНИЛС, банковская карта, ИНН, ОМС)|||reshenie=от 15 минут|||poluchenie=Выдача кредита в отделениях банка|||opisanie-2=Кредит «Наличными»|||opisanie-3=Альфа-Банк|||opisanie-4=|||refer-ssylka=https://pxl.leads.su/click/5086d02801b79f5f2c86e2fbfb6b3e3e|||id-klassa-ssylki=alfanal|||lgotnyj-period=|||godovoe-obsluzhivanie=|||cashback-karty-deb.=|||nomer-licenzii-cb=53252352345', '1527850118_alfa.png###2018-06', 25, '', 0, 1, '0', '0'),
(2772, 'Росбанк', 'Кредит «Просто деньги» от Росбанка - отзывы, условия, оформить онлайн', 'Выгодное предложение от Росбанка потребительский кредит всего за 1 день, без справок и пручителей.', 'Росбанк', 'rosbank', 'Процентные ставки определяются индивидуально для каждого заемщика в соответствии с оценкой данных заемщика.<br><br>Суммы до 499000,00 рублей - процентная ставка в год составляет - 18-20%.<br><br>Суммы от 500000,00 рублей - процентная ставка в год составляет - 16-20%.<br><br>При сумме кредита от 400 000 рублей, в случае если доход подтвержден документом, отличным от справки по форме 2-НДФЛ, дополнительно предоставляется копия трудовой книжки, заверенная работодателем.', 'redaktor', 0, 0, '1,338,339,340,341,342,343,344,345', 1, 'procentnaya-stavka=от 16.00%|||opisanie=Акционерный коммерческий банк «РОСБАНК» был зарегистрирован в Банке России 2 марта 1993 года под названием АКБ «Независимость» (АОЗТ) с присвоением регистрационного номера 2272. ОАО АКБ «РОСБАНК» является акционерным коммерческим банком и осуществляет свою деятельность в Российской Федерации с 1993 года.|||minimal.-summa=от 50 000 руб.|||summa=до 3 000 000 руб.|||srok-kredita=до 60 мес.|||rabota=Стаж на последнем месте работы от 3 месяцев|||vozrast=от 18 лет|||dokumenty=паспорт, справка о доходах|||reshenie=15 минут|||poluchenie=Выдача кредита происходит в отделениях банка|||opisanie-2=Кредит «Просто деньги»|||opisanie-3=Росбанк|||opisanie-4=|||refer-ssylka=https://pxl.leads.su/click/8bde6ce0d967eacb3d1026ed78319dda|||id-klassa-ssylki=rosbanknal|||lgotnyj-period=|||godovoe-obsluzhivanie=|||cashback-karty-deb.=|||nomer-licenzii-cb=', '1527850629_rosbank.png###2018-06', 7, '', 0, 1, '0', '0'),
(2773, 'Восточный экспресс банк', 'Кредит «Сезонный» от Восточного экспресс Банка - отзывы, условия, оформить', 'Кредит наличными без залога и поручительства на любые цели от Восточного экспресс банка.', 'Восточный экспресс банк', 'vostochnyj-jekspress-bank', 'Минимальный возраст заемщика от 21 года. Для лиц моложе 26 лет требования к стажу работы не менее 12 месяцев.<br><br>Штраф за нарушение клиентом сроков очередного погашения кредитной задолженности в рамках одного кредитного договора: от 590 до 1 800 рублей за факт образования просрочки (в зависимости от суммы кредита и количества просроченных платежей), но не более 20% от просроченной суммы текущего ежемесячного платежа.', 'redaktor', 0, 0, '1,338,339,340,341,342,343,344,345', 1, 'procentnaya-stavka=от 11.50%|||opisanie=ПАО «КБ «Восточный Экспресс Банк» — это один из самых крупных специализированных розничных банков. У Банка хорошо развита сеть продаж, а также широк выбор услуг — таких, как предоставление кредитов и привлечение депозитов населению и корпоративным клиентам. Над Восточным Экспресс Банком взяли контроль инвестфонды (55%), а также Игорь Ким и его партнеры.|||minimal.-summa=от 25 000 руб.|||summa=до 500 000 руб.|||srok-kredita=до 36 мес.|||rabota=Стаж на последнем месте работы от 3 месяцев|||vozrast=от 21 лет|||dokumenty=Паспорт, + второй документ на выбор (загранпаспорт, водительские права, СНИЛС, банковская карта, ИНН, ОМС)|||reshenie=от 15 минут|||poluchenie=Выдача кредита на картсчет|||opisanie-2=Кредит «Сезонный»|||opisanie-3=Восточный экспресс банк|||opisanie-4=|||refer-ssylka=https://pxl.leads.su/click/22b52df66700d556221a8028e2bd2a3d|||id-klassa-ssylki=vosnal|||lgotnyj-period=|||godovoe-obsluzhivanie=|||cashback-karty-deb.=|||nomer-licenzii-cb=', '1527851670_vostochniy.png###2018-06', 18, '', 0, 1, '0', '0'),
(2774, 'Совкомбанк', 'Кредит «Денежный под 8,90%» от Совкомбанка - отзывы, условия, оформить', 'Кредит на счет без залога и поручительства на любые цели от Совкомбанка.', 'Совкомбанк, кредит', 'sovkombank', 'Ежемесячный платеж составляет - 8741,00 рублей.<br><br>Общая сумма переплаты составит 4905,00 рублей (переплата за весь срок кредита).<br><br>Дополнительные требования:<br><!--dle_list--><ul><li>Постоянная регистрация не менее 4-х последних месяцев (на территории одного населенного пункта РФ) и проживание в городе;<br></li><!--dle_li--><li>Присутствия подразделения Банка или прилегающих населенных пунктах (но не более 70 километров от границы населенного пункта);<br></li></ul><!--dle_list_end--><br><br>В случае нарушения срока возврата кредита (части кредита) заемщик уплачивает неустойку в виде пени равной 20% годовых от суммы остатка задолженности по основному долгу за каждый календарный день просрочки.', 'redaktor', 0, 0, '1,338,339,340,341,342,343,344,345', 1, 'procentnaya-stavka=8,90%|||opisanie=ООО ИКБ «СОВКОМБАНК» считается одним из самых надежных финансовых учреждений России. С 2008 года он входит в ТОП-50 лидеров банковского сектора. Специализированные международные и российские рейтинги («Русрейтинг», Standard&Poor’s) дают положительные оценки его деятельности. Кроме того, он занимает 42 место по количеству активов, 26 место по объему кредитов для физических лиц, 27 место по объему депозитов. По другим показателям работы он уверенно входит в ТОП-100 в своей сфере.|||minimal.-summa=|||summa=100 000 руб.|||srok-kredita=12 мес.|||rabota=Стаж на последнем месте работы от 4 месяцев|||vozrast=от 20 лет|||dokumenty=Паспорт, + второй документ на выбор (загранпаспорт, водительские права, СНИЛС, банковская карта, ИНН, ОМС)|||reshenie=от 1 дня|||poluchenie=Выдача кредита происходит в отделениях банка|||opisanie-2=Кредит «Денежный под 8,90%»|||opisanie-3=Совкомбанк|||opisanie-4=|||refer-ssylka=https://pxl.leads.su/click/acb771dcfe8a879d45ff421d0a6b092e|||id-klassa-ssylki=sovkonnal|||lgotnyj-period=|||godovoe-obsluzhivanie=|||cashback-karty-deb.=|||nomer-licenzii-cb=', '1527852084_sovkombank.png###2018-06', 47, '', 0, 1, '0', '0'),
(2768, 'ОТП Банк', 'Кредит «Наличными за 15 минут» в ОТП Банке – отзывы, условия, оформить', 'Уникальное кредитное предложение от ОТП Банка, за 15 минут до 200 000 рублей по паспорту.', 'ОТП Банк', 'otp-bank', 'Размер процентной ставки в каждом конкретном случае определяется Банком и может варьироваться в зависимости от уровня риска потенциального клиента, определяемого по результатам скоринга.<br><br>Основные требования:<br><!--dle_list--><ul><li>являетесь гражданином России;<br></li><!--dle_li--><li>имеете постоянную регистрацию на территории РФ в любом регионе присутствия Банка и фактически проживаете в регионе (субъекте РФ2) оформления кредита;<br></li><!--dle_li--><li>имеете постоянное место работы, и ваш трудовой стаж на последнем месте работы составляет не менее 3-х месяцев;<br></li><!--dle_li--><li>ваш возраст от 21 года на момент подачи заявки и до 65 лет включительно на момент погашения кредита;<br></li><!--dle_li--><li>ИНН организации-работодателя.<br></li></ul><!--dle_list_end--><br><br><br>Неустойка за просрочку возврата кредита или уплаты процентов за пользование кредитом — 20% годовых от остатка основного долга (кредита) по кредитному договору.', 'redaktor', 0, 0, '1,338,339,340,341,342,343,344,345', 1, 'procentnaya-stavka=от 14,9%|||opisanie=Открытое акционерное общество \"ОТП Банк\" было образовано в 1994 году. При учреждении Банк имел следующее наименование: Акционерный коммерческий банк \"Сберегательный банк \"Гермес\" (Акционерное общество закрытого типа), \"ГермесСбербанк\".|||minimal.-summa=от 15 000 руб.|||summa=до 200 000 руб.|||srok-kredita=до 36 мес.|||rabota=Стаж на последнем месте работы от 3 месяцев|||vozrast=от 21 года|||dokumenty=Паспорт, дополнительный документ на выбор Заемщика: водительское удостоверение, загранпаспорт, свидетельство пенсионного страхования, ИНН, военный билет;|||reshenie=15 минут|||poluchenie=Выдача кредита происходит в отделениях банка|||opisanie-2=«Наличные за 15 минут»|||opisanie-3=ОТП Банк|||opisanie-4=выдача кредита в отделениях банка|||refer-ssylka=https://pxl.leads.su/click/13fc118963b911017d4303d606905c6b|||id-klassa-ssylki=otppat|||lgotnyj-period=|||godovoe-obsluzhivanie=|||cashback-karty-deb.=|||nomer-licenzii-cb=', '1527846612_otp.png###2018-06', 14, '', 0, 1, '0', '0'),
(2776, 'Хоум Kредит Банк', 'Кредит «Наличные деньги» от Хоум Kредит Банка - отзывы, условия, оформить онлайн', 'Кредит на счет без залога и поручительства для клиентов банка на любые цели от Хоум Kредит Банка.', 'Хоум Kредит Банк', 'houm-kredit-bank', 'Для крупных городов обязательно наличие домашнего телефона.<br><br>Процентные ставки определяются индивидуально для каждого заемщика в соответствии с оценкой данных заемщика.<br><br>За просрочку оплаты ежемесячного платежа - с 1-го до 150 дня - 0,1% в день от суммы просроченной задолженности по кредиту и процентам.<br><br>За просрочку исполнения требования о полном досрочном погашении задолженности - 0,1% в день с 1-го дня до полного погашения просроченной задолженности по Кредиту и процентам.', 'redaktor', 0, 0, '1,338,339,340,341,342,343,344,345', 1, 'procentnaya-stavka=от 12.50%|||opisanie=ООО \"Хоум Кредит энд Финанс Банк\", один из лидеров российского рынка банковской розницы, работает на российском рынке с 2002 года. &278&&278&|||minimal.-summa=от 10 000 руб.|||summa=до 1 000 000 руб.|||srok-kredita=до 60 мес.|||rabota=Стаж на последнем месте работы от 3 месяцев|||vozrast=от 23 лет|||dokumenty=Паспорт, + второй документ на выбор (загранпаспорт, водительские права, СНИЛС, банковская карта, ИНН, ОМС)|||reshenie=До 2х часов|||poluchenie=В отделениях банка, онлайн в интернет-банке, дистанционно с курьером|||opisanie-2=Кредит «Наличные деньги»|||opisanie-3=Хоум Kредит Банк|||opisanie-4=|||refer-ssylka=https://pxl.leads.su/click/674df3a4f1e1015859d8eb78e79cea6f|||id-klassa-ssylki=houmkrenal|||lgotnyj-period=|||godovoe-obsluzhivanie=|||cashback-karty-deb.=|||nomer-licenzii-cb=', '1533029121_houmkeredit.png###2018-07', 20, '', 0, 1, '0', '0'),
(2777, 'Ренессанс Кредит', 'Кредит «Потребительский» от банка Ренессанс Кредит - отзывы, условия, оформить', 'Кредит наличными или на карту без залога и поручительства на любые цели от банка Ренессанс Кредит.', 'Ренессанс Кредит', 'renessans-kredit', 'Для действующих клиентов с предодобренным предложением доступно дистанционное оформление без визита в отделение. Перевод средств на счет в любом банке без комиссии.<br><br>При посещении банка возмите с собой дополнительные документы - это предоставит Вам возможность снизить ставку.<br><br>Обязательным условием является: наличие постоянной работы или наличие постоянной регистрации в регионе оформления.', 'redaktor', 0, 1, '1,338,339,340,341,342,343,344,345', 1, 'procentnaya-stavka=от 11.30%|||opisanie=Банк «Ренессанс Кредит» был зарегистрирован Центральным Банком Российской Федерации 24 ноября 2000 г. под номером №3354.|||minimal.-summa=от 30 000 руб.|||summa=до 700 000 руб.|||srok-kredita=до 36 мес.|||rabota=Стаж на последнем месте работы от 3 месяцев|||vozrast=от 24 лет|||dokumenty=Паспорт, + второй документ на выбор (загранпаспорт, водительские права, СНИЛС, банковская карта, ИНН, ОМС)|||reshenie=от 15 минут|||poluchenie=Выдача кредита в отделениях банка|||opisanie-2=Кредит «Потребительский»|||opisanie-3=Ренессанс Кредит|||opisanie-4=|||refer-ssylka=https://pxl.leads.su/click/02d8a57d4a9759fd5b1b288286e4a56e|||id-klassa-ssylki=renesanal|||lgotnyj-period=|||godovoe-obsluzhivanie=|||cashback-karty-deb.=|||nomer-licenzii-cb=', '1527853810_renesans.png###2018-06', 126, '', 0, 1, '5', '0'),
(2778, 'Joymoney', 'Микрозайм «Потребительский» от Joymoney - отзывы, условия, оформить онлайн', 'Выгодное предложение по предоставлению микрозайма от Joymoney с минимальной ставкой.', 'Joymoney', 'joymoney', 'Помимо займов, организация предлагает исправление кредитной истории клиента. Если несколько раз получать микрозаймы и вовремя возвращать их, информация передается в БКИ, в результате улучшается кредитный рейтинг клиента.<br><br>«JoyMoney» на сегодняшний день работает только с одним тарифным планом. Вы можете получить в займы сумму до двадцати тысяч рублей сроком до тридцати дней.<br><br>Есть возможность управлять займом: продлять договор или досрочно погашать задолженность.', 'redaktor', 1, 0, '3,382,383,384,385,386,387,388,389,390,391,392,393,394,395,396,397,398,399,400,401,402,403,404,405,406,407,408,409,410,411,412,413,414,415,416,417,418,419,420,421,422,423,424,425,426,427,428,429,430,431,432,433,434,435,436,437', 1, 'opisanie=(МФК) ООО «Джой Мани» состоит в государственном реестре микрофинансовых организаций за номером 651403550005450 от 28.07.2014 года.&278&|||procentnaya-stavka=2,17%|||minimal.-summa=от 5 000 руб.|||summa=до 20 000 руб.|||srok-kredita=до 30 дней|||vozrast=от 23 до 60 лет|||rabota=Стаж на последнем месте работы от 3 месяцев (необязательно) |||dokumenty=Паспорт, СНИЛС|||reshenie=10 минут|||poluchenie=На банковскую карту VISA или MasterCard|||opisanie-2=Микрозайм «Потребительский»|||opisanie-3=Joymoney|||opisanie-4=|||refer-ssylka=https://pxl.leads.su/click/170f194ed41446a575b71c16bdf6bf52|||id-klassa-ssylki=joymonezaym|||licenziya=|||lgotnyj-period=|||godovoe-obsluzhivanie=|||cashback-karty-deb.=|||zajavok-oformleno=', '1527857919_joy.png###2018-06', 55, '', 0, 1, '0', '0'),
(2779, 'Moneyclick', 'Микрозайм «Стандартный» от Moneyclick - отзывы, условия, оформить онлайн', 'Оформить быстрый микрозайм до 8000 рублей, можно в компании Moneyclick.', 'Moneyclick', 'moneyclick', 'Нельзя сделать пролонгацию займа.<br><br>Есть возможность вернуть досрочно всю сумму с уплатой процентов, только за фактический срок пользования средствами, но не менее чем за 3 дня пользования займом.<br><br>Система автоматически рассчитает дату платежа и сумму для погашения долга. Это позволит более точно оценить свои финансовые возможности и избежать просрочек.', 'redaktor', 0, 0, '3,382,383,384,385,386,387,388,389', 1, 'procentnaya-stavka=2,10%|||opisanie=ООО МКК «Мани-Клик» зарегистрирован в государственном реестре МФО под номером 001503046007229.&278&<br><br>&278&Полное наименование - Общество с ограниченной ответственностью Микрокредитная компания «Мани-Клик».|||minimal.-summa=от 3000 руб.|||summa=до 13000 руб.|||srok-kredita=до 30 дней|||rabota=Постоянный источник дохода|||vozrast=от 25 лет|||dokumenty=Паспорт|||reshenie=10 минут|||poluchenie=На банковскую карту VISA или MasterCard, банковский счет|||opisanie-2=Микрозайм «Стандартный»|||opisanie-3=Moneyclick|||opisanie-4=|||refer-ssylka=https://pxl.leads.su/click/22ba013a3aeaee27f182ecacf59291c3|||id-klassa-ssylki=jdsmoney|||lgotnyj-period=|||godovoe-obsluzhivanie=|||cashback-karty-deb.=|||nomer-licenzii-cb=', '1527858344_klickmoney.png###2018-06', 11, '', 0, 1, '0', '0'),
(2780, 'Webbankir', 'Займ «До зарплаты» от Webbankir - отзывы, условия, оформить онлайн', 'Полное описание займа «До зарплаты» от микрофинансовой компании Webbankir.', 'Webbankir', 'webbankir', 'Для каждого клиента процентная ставка рассчитывается индивидуально и колеблется от 1.2% до 1.95% в день.<br><br>Продлить займ можно на срок до 30 дней. Комиссия за продление 60 рублей за каждый день продления займа, плюс проценты по займу, начисленные на день оплаты продления. Количество продлений займа не ограничено.<br><br>Вы можете досрочно вернуть всю сумму с уплатой процентов только за фактический срок пользования средствами.', 'redaktor', 1, 0, '3,382,383,384,385,386,387,388,389,390,391,392,393,394,395,396,397,398,399,400,401,402,403,404,405,406,407,408,409,410,411,412,413,414,415,416,417,418,419,420,421,422,423,424,425,426,427,428,429,430,431,432,433,434,435,436,437', 1, 'opisanie=ООО МФК «ВЭББАНКИР» - система моментального электронного кредитования - предоставляет онлайн микрозаймы «под ключ», начиная с рассмотрения заявки до получения клиентом денежных средств. Клиенты получают займы без посещения офиса. \"Webbankir\" - выгодная альтернатива банковскому кредитованию - получить займ онлайн можно круглосуточно.&278&<br><br>&278&Свидетельство о внесении сведений о юридическом лице в государственный реестр микрофинансовых организаций за регистрационным номером 2120177002077.|||procentnaya-stavka=1,90%|||minimal.-summa=от 3 000 руб.|||summa=до 20 000 руб.|||srok-kredita=до 30 дней|||vozrast=от 20 лет|||rabota=Постоянный источник дохода|||dokumenty=Паспорт|||reshenie=15 минут|||poluchenie=На банковскую карту VISA или MasterCard или банковский счет|||opisanie-2=Займ «До зарплаты»|||opisanie-3=Webbankir|||opisanie-4=|||refer-ssylka=https://pxl.leads.su/click/f81da77474946767f4e8facebd12e4e9|||id-klassa-ssylki=webbankirnal|||licenziya=|||lgotnyj-period=|||godovoe-obsluzhivanie=|||cashback-karty-deb.=|||zajavok-oformleno=', '1527859000_bankir.png###2018-06', 10, '', 0, 1, '0', '0'),
(2781, 'Platiza', 'Микрозайм «Стандартный» Platiza - отзывы, условия, оформить онлайн', 'Популярный сервис микрозаймов Platiza, выгодные условия и низкая ставка по займам.', 'Platiza', 'platiza', '<p>Есть возможность подключить автоматическое погашение займа путем списание с карты. Этот вариант самый удобный для заемщика. Клиент должен зарегистрировать карту в личном кабинете на сайте Платизы. На дату окончания договора обеспечить на счету необходимую сумму средств.<br><br>Оформить заём можно с любого устройства - компьютера, планшета или мобильного телефона, благодаря удобной мобильной версии сайта.<br><br>На platiza одобряется почти 80% займов. Деньги выдаются физическим лицам даже с плохой кредитной историей.</p>', 'redaktor', 0, 0, '3,382,383,384,385,386,387,388,389', 1, 'procentnaya-stavka=от 1,00%|||opisanie=Сервис Platiza был запущен 10 ноября 2012 года. Его инвесторы — это такие крупные компании как FinSight Ventures, Flint Capital и Prostor Capital. Партнеры — самые популярные платёжные системы Яндекс.Деньги, QIWI Visa Wallet, поставщик услуг информационной безопасности Deiteriy, бюро кредитных историй НБКИ, ОКБ и Equifax, а также крупные российские банки.|||minimal.-summa=от 1000 руб.|||summa=до 15 000 руб.|||srok-kredita=до 30 дней|||rabota=Стаж на последнем месте работы от 3 месяцев|||vozrast=от 18 лет до 60 лет|||dokumenty=Паспорт, СНИЛС|||reshenie=10 минут|||poluchenie=На банковскую карту VISA или MasterCard|||opisanie-2=Микрозайм «Стандартный»|||opisanie-3=Platiza|||opisanie-4=|||refer-ssylka=https://pxl.leads.su/click/bacc8b442d72851b4f4d11080cbb9e7f|||id-klassa-ssylki=platizajk|||lgotnyj-period=|||godovoe-obsluzhivanie=|||cashback-karty-deb.=|||nomer-licenzii-cb=', '1527859892_platiza.png###2018-06', 65, '', 1602450000, 1, '0', '0'),
(2782, 'Turbozaim', 'Микрозайм «Начальный» от Turbozaim - отзывы, условия, оформить', 'Срочно требуется микрозайм? Turbozaim предоставляет самые выгодные условия.', 'Turbozaim', 'turbozaim', 'Огромное преимущество организации - прозрачная политика в отношении денежных средств к выдаче, возврату и процентов по займу. Также в некоторых случаях можно бесплатно продлить займ на несколько дней.<br><br>Новым клиентам предоставляется возможность пользоваться займом три дня бесплатно!<br><br>Займы выдаются для всех совершеннолетних жителей России.', 'redaktor', 1, 0, '3,382,383,384,385,386,387,388,389,390,391,392,393,394,395,396,397,398,399,400,401,402,403,404,405,406,407,408,409,410,411,412,413,414,415,416,417,418,419,420,421,422,423,424,425,426,427,428,429,430,431,432,433,434,435,436,437', 1, 'opisanie=МФК «Турбозайм» — современный высокотехнологичный сервис онлайн-займов, запущенный в 2013 г. Он является перспективным каналом взаимодействия с клиентом. Весь процесс оформления займа — от регистрации на сайте до момента погашения займа — клиент проходит, оставаясь онлайн.&278&<br><br>&278&МФК Турбозайм (ООО) — включена в Государственный реестр микрофинансовых организаций под номером 651303045003951 и имеет статус микрофинансовой компании.|||procentnaya-stavka=2,24%|||minimal.-summa=от 3 000 руб.|||summa=до 10 000 руб.|||srok-kredita=до 30 дней|||vozrast=от 21 года|||rabota=Стаж на последнем месте работы от 3 месяцев|||dokumenty=Паспорт|||reshenie=10 минут|||poluchenie=На банковскую карту VISA или MasterCard|||opisanie-2=Микрозайм «Начальный»|||opisanie-3=Turbozaim|||opisanie-4=|||refer-ssylka=https://pxl.leads.su/click/6d1494ac99cb1646d9a933bdaca65675|||id-klassa-ssylki=turbozaymn|||licenziya=|||lgotnyj-period=|||godovoe-obsluzhivanie=|||cashback-karty-deb.=|||zajavok-oformleno=', '1527860052_turbozaym.png###2018-06', 6, '', 0, 1, '0', '0'),
(2783, 'SmartCredit', 'SmartCredit (СмартКредит) микрозайм: отзывы, условия, оформить', 'SmartCredit поможет взять займ на максимально выгодных условиях без обеспечения и поручительства.', 'SmartCredit', 'smartcredit', 'Есть возможность погасить займ досрочно: частично или полностью. Проценты в этом случае будут пересчитаны по количеству реальных дней пользования микрозаймом.<br><br>Если у заемщика нет возможности погасить займ в установленный срок, компания предлагает продлить микрокредит. Для этого нужно выбрать любой период до 30 дней в личном кабинете и внести оплату за начисленные проценты. Дополнительной комиссии за предоставление услуги нет.<br><br>', 'redaktor', 1, 0, '3,382,383,384,385,386,387,388,389,390,391,392,393,394,395,396,397,398,399,400,401,402,403,404,405,406,407,408,409,410,411,412,413,414,415,416,417,418,419,420,421,422,423,424,425,426,427,428,429,430,431,432,433,434,435,436,437', 1, 'opisanie=Предлагаем изучит обзор SmartCredit — микрофинансовой компании, репутация которой подтверждается многочисленными отзывами заемщиков. МФО работает в сфере микрокредитования с 2015 года и предлагает отличные условия предоставления микрокредитов.&278&<br><br>&278&ООО МФК «Смартмани» состоит в государственном реестре микрофинансовых организаций за номером 651503045006429 от 07.05.2015 года.|||procentnaya-stavka=1,90%|||minimal.-summa=от 2 000 руб.|||summa=до 14 000 руб.|||srok-kredita=до 30 дней|||vozrast=от 21 года|||rabota=Стаж на последнем месте работы от 3 месяцев|||dokumenty=Gаспорт|||reshenie=15 минут|||poluchenie=На банковскую карту VISA или MasterCard, Яндекс, QIWI и CONTACT|||opisanie-2=Микрозайм «Smart»|||opisanie-3=SmartCredit|||opisanie-4=|||refer-ssylka=https://pxl.leads.su/click/57896b4f8092e5ea20a7d699ef3a10e5|||id-klassa-ssylki=smartxaym|||licenziya=|||lgotnyj-period=|||godovoe-obsluzhivanie=|||cashback-karty-deb.=|||zajavok-oformleno=', '1527860834_smart.png###2018-06', 3, '', 0, 1, '0', '0'),
(2784, 'Creditplus', 'Creditplus (Кредит Плюс) микрозайм: отзывы, условия, оформить', 'Микрокредит без залога и поручительства от Creditplus на выгодных условиях.', 'Creditplus', 'creditplus', 'Cashback до 10% от суммы займа при своевременном погашении.<br><br>Максимальная сумма займа для новых клиентов 15000 рублей.<br><br>Заем можно погасить досрочно в любое время. Оплата производиться только за фактический период пользования заемными средствами.<br><br>Для продления займа вы оплачиваете часть суммы от 14% до 30% и продлеваете срок займа от 7 до 15 дней, при этом начисление процентов по займу полностью останавливается.<br><br>Займы выдаются для всех жителей России.', 'redaktor', 1, 0, '3,382,383,384,385,386,387,388,389,390,391,392,393,394,395,396,397,398,399,400,401,402,403,404,405,406,407,408,409,410,411,412,413,414,415,416,417,418,419,420,421,422,423,424,425,426,427,428,429,430,431,432,433,434,435,436,437', 1, 'opisanie=Онлайн сервис CreditPlus (Кредит Плюс) - это принципиально новый подход к микрокредитованию в России, который изменит Ваше представление о краткосрочном кредитовании. Сервис CreditPlus дает возможность в течение нескольких минут оформить онлайн заявку на сайте, используя мобильный телефон, по телефону через оператора. Также для клиента мы создаем личный кабинет, где он самостоятельно может воспользоваться услугами сервиса: продлить текущий займ, оформить новый, использовать бонусы по программе Кэшбэк.&278&<br><br>&278&ООО МФК “Экофинанс” состоит в государственном реестре микрофинансовых организаций за номером 651503045006452 от 13.05.2015 года.|||procentnaya-stavka=1,90%|||minimal.-summa=от 1000 руб.|||summa=до 30 000 руб.|||srok-kredita=до 21 дня|||vozrast=от 21 года|||rabota=Стаж на последнем месте работы от 3 месяцев|||dokumenty=Паспорт|||reshenie=10 минут|||poluchenie=На банковскую карту VISA или MasterCard|||opisanie-2=Микрозайм «Новичок»|||opisanie-3=Creditplus|||opisanie-4=|||refer-ssylka=https://pxl.leads.su/click/5c9db4aa20fda3bb0daf96615c458536|||id-klassa-ssylki=plusnal|||licenziya=|||lgotnyj-period=|||godovoe-obsluzhivanie=|||cashback-karty-deb.=|||zajavok-oformleno=', '1527861142_plus.png###2018-06', 3, '', 0, 1, '0', '0'),
(2785, 'СМСФИНАНС', 'СМСфинанс (Smsfinance) микрозайм: отзывы, условия, оформить', 'Займ без залога и поручительства. Действует акция «В срок на 20% дешевле».', '', 'smsfinans', 'Сумма которая доступна для первого займа от 1000 до 15000 рублей.<br><br>Процентная ставка для каждого заемщика индивидуальная  0,9% - 2,10%.<br><br>Есть возможность продления долга или выплаты его частями или полностью в течение указанного срока.<br><br>Оформить микрозайм в СМС Финанс можно только дистанционно.', 'redaktor', 1, 0, '3,382,383,384,385,386,387,388,389,390,391,392,393,394,395,396,397,398,399,400,401,402,403,404,405,406,407,408,409,410,411,412,413,414,415,416,417,418,419,420,421,422,423,424,425,426,427,428,429,430,431,432,433,434,435,436,437', 1, 'opisanie=СМС финанс ведет деятельность на основании свидетельства о внесении в реестр микрофинансовых организаций №2120177002022, выданного Банком России 30 августа 2012 года. МФК зарегистрирована в Москве. Центральный офис находится по адресу улица Пресненская набережная, дом 12.|||procentnaya-stavka=2,00%|||minimal.-summa=от 3 000 руб.|||summa=до 30 000 руб.|||srok-kredita=до 30 дней|||vozrast=от 18 лет|||rabota=Стаж на последнем месте работы от 3 месяцев|||dokumenty=Паспорт|||reshenie=15 минут|||poluchenie=На банковскую карту VISA или MasterCard|||opisanie-2=Микрозайм «Потребительский»|||opisanie-3=СМСФИНАНС|||opisanie-4=|||refer-ssylka=https://pxl.leads.su/click/02a649f668fc3e2aa240c42d22b834e6|||id-klassa-ssylki=smsfinan|||licenziya=|||lgotnyj-period=|||godovoe-obsluzhivanie=|||cashback-karty-deb.=|||zajavok-oformleno=', '1527861323_smsfinans.png###2018-06', 5, '', 0, 1, '0', '0'),
(2786, 'Omoney', 'Оманей (Omoney) микрозайм: отзывы, условия, оформить', 'Займ без залога и поручительства на выгодных условиях от компании Omoney.', 'Omoney', 'omoney', 'Способы получения денег: на карту Visa и MasterCard, через систему переводов Contact, на Яндекс.Деньги, Киви кошелек, наличными в офисе МФО.<br><br>Есть возможность пролонгации микрозайма.<br><br>При оформлении займа с залогом автомобиля необходимо дополнительно передать в компанию оригинал ПТС, а при залоге недвижимости — представить полный пакет документов, подтверждающих право собственности.', 'redaktor', 1, 0, '3,382,383,384,385,386,387,388,389,390,391,392,393,394,395,396,397,398,399,400,401,402,403,404,405,406,407,408,409,410,411,412,413,414,415,416,417,418,419,420,421,422,423,424,425,426,427,428,429,430,431,432,433,434,435,436,437', 1, 'opisanie=Сервис Omoney создан и поддерживается ООО МФК «ФИН-Дрим» (ИНН 9715233088, ОГРН 5157746150656). Юридический адрес организации: 115114, г. Москва, ул. Дербеневская, д. 20, стр. 23. Фактический адрес местонахождения юридического лица: 115114, г. Москва, ул. Дербеневская, д. 20, стр. 8, 3 этаж.|||procentnaya-stavka=2,10%|||minimal.-summa=от 5 000 руб.|||summa=до 15 000 руб.|||srok-kredita=до 30 дней|||vozrast=от 19 года|||rabota=Стаж на последнем месте работы от 3 месяцев|||dokumenty=Паспорт, ИНН или СНИЛС|||reshenie=15 минут|||poluchenie=На банковскую карту VISA или MasterCard|||opisanie-2=Микрозайм «Удобный»|||opisanie-3=Omoney|||opisanie-4=|||refer-ssylka=https://pxl.leads.su/click/d386a78745b364b217e748e970195f21|||id-klassa-ssylki=omoneya|||licenziya=|||lgotnyj-period=|||godovoe-obsluzhivanie=|||cashback-karty-deb.=|||zajavok-oformleno=', '1527861670_omoney.png###2018-06', 5, '', 0, 1, '0', '0'),
(2787, 'Zaimon', 'Займон (Zaimon) микрозайм: отзывы, условия, оформить', 'Займ на любые цели без обеспечения и с минимальной ставкой от компании Zaimon.', '', 'zaimon', 'Первый займ в Займоне можно оформить на сумму от 2 500 до 8 000 руб. Деньги выдаются на срок до 1 месяца в любом регионе России.<br><br>Если вы в первый раз обратились в указанную организацию, процентная ставка составит до 1,9% в день. При повторном получении микрокредита она уменьшится на 0,9%.<br><br>Система скидок и бонусов для постоянных клиентов. (При неоднократных обращениях в микрофинансовую организацию заемщик может получить до 50000 рублей займа.)<br><br>Работает со всеми регионами России.', 'redaktor', 1, 0, '3,382,383,384,385,386,387,388,389,390,391,392,393,394,395,396,397,398,399,400,401,402,403,404,405,406,407,408,409,410,411,412,413,414,415,416,417,418,419,420,421,422,423,424,425,426,427,428,429,430,431,432,433,434,435,436,437', 1, 'opisanie=Займон – российская микрофинансовая компания. Сервис принадлежит крупной МФК Pay P.S. Выдает займы с 2014 года.&278&<br><br>&278&Займон ведет деятельность на основании свидетельства о внесении в реестр микрофинансовых организаций №2120177001838, выданного Банком России 24 июля 2012 года. МФК зарегистрирована в Москве. Центральный офис находится по адресу улица Спиридоновка, дом 27/24.|||procentnaya-stavka=1,90%|||minimal.-summa=от 2 500 руб.|||summa=до 30 000 руб.|||srok-kredita=до 25 дней|||vozrast=от 21 года|||rabota=Стаж на последнем месте работы от 3 месяцев|||dokumenty=Паспорт, ИНН или СНИЛС|||reshenie=10 минут|||poluchenie=На банковскую карту VISA или MasterCard, Яндекс, QIWI и CONTACT|||opisanie-2=Микрозайм «Кошерный»|||opisanie-3=Zaimon|||opisanie-4=|||refer-ssylka=https://pxl.leads.su/click/282f9959cc524344411d7c14b1c20b73|||id-klassa-ssylki=zaymon|||licenziya=|||lgotnyj-period=|||godovoe-obsluzhivanie=|||cashback-karty-deb.=|||zajavok-oformleno=', '1527861924_zaymon.png###2018-06', 9, '', 0, 1, '0', '0'),
(2788, 'Dozarplati', 'Дозарплаты (Dozarplati) микрозайм: отзывы, условия, оформить', 'Займ до зарплаты на текущие или внеплановые расходы. Срок пользования займом – до зарплаты, но не более 30 календарных дней.', 'Дозарплаты', 'dozarplati', 'Заем можно вернуть досрочно с 1 по 15 день. Если договор займа рассчитан на 30 дней, то в день планового платежа. В том случае, если средства брались на срок от 2 до 6 месяцев, необходимо уведомить МФК за 30 дней до возврата денег о своем намерении.<br><br>Продления микрозайма возможно на срок до 30 дней.<br><br>Займы выдаются во всех регионах России.', 'redaktor', 1, 0, '3,382,383,384,385,386,387,388,389,390,391,392,393,394,395,396,397,398,399,400,401,402,403,404,405,406,407,408,409,410,411,412,413,414,415,416,417,418,419,420,421,422,423,424,425,426,427,428,429,430,431,432,433,434,435,436,437', 1, 'opisanie=Компания Дозарплаты ведет деятельность на основании свидетельства о внесении в реестр микрофинансовых организаций №651403140005467, выданного Банком России 4 августа 2014 года. МФК зарегистрирована в Санкт-Петербурге. Центральный офис находится по адресу – Спасский переулок, дом 14/35, офис 602.|||procentnaya-stavka=2,18%|||minimal.-summa=от 3 000 руб.|||summa=до 10 000 руб.|||srok-kredita=до 20 дней|||vozrast=от 21 года|||rabota=Стаж на последнем месте работы от 3 месяцев|||dokumenty=Паспорт|||reshenie=15 минут|||poluchenie=На банковскую карту VISA, MasterCard или наличными в офисе компании.|||opisanie-2=Микрозайм «До зарплаты»|||opisanie-3=Dozarplati|||opisanie-4=|||refer-ssylka=https://pxl.leads.su/click/bef1d1e64b7303e1a83e2bb7dc930bcd|||id-klassa-ssylki=dozar|||licenziya=|||lgotnyj-period=|||godovoe-obsluzhivanie=|||cashback-karty-deb.=|||zajavok-oformleno=', '1527862563_dozp.png###2018-06', 5, '', 0, 1, '0', '0'),
(2789, 'Konga', 'Конга (Konga) микрозайм: отзывы, условия, оформить', 'Займ онлайн на любые цели и без поручителей от компании Конга.', 'Konga', 'konga', 'Точный тариф (сумма займа и процентная ставка) определяются в автоматическом режиме системой на индивидуальных условиях.<br><br>Первый займ выдается на сумму не более 5000 рублей, в последующих обращениях сумма будет увеличиваться.<br><br>Продление займа возможно на срок 14 дней неограниченное количество раз. Вы можете продлить даже просроченный займ.<br><br>Займ выдается во всех регионах России.', 'redaktor', 0, 0, '3,382,383,384,385,386,387,388,389,390,391,392,393,394,395,396,397,398,399,400,401,402,403,404,405,406,407,408,409,410,411,412,413,414,415,416,417,418,419,420,421,422,423,424,425,426,427,428,429,430,431,432,433,434,435,436,437', 1, 'procentnaya-stavka=2.17%|||opisanie=ООО МФО “Лайм-НСК” предоставляет микрозаймы под брендом Konga. Данное учреждение в реестр микрофинансовых компаний России было внесено 15 февраля 2016 года. Всего лишь за один год существования организация смогла добиться высоких результатов и значительно увеличить свою клиентскую базу.|||minimal.-summa=от 1 500 руб.|||summa=до 10 000 руб.|||srok-kredita=до 30 дней|||rabota=Постоянный источник дохода|||vozrast=от 21 года|||dokumenty=Паспорт|||reshenie=10 минут|||poluchenie=На банковскую карту VISA или MasterCard|||opisanie-2=Микрозайм «Старт»|||opisanie-3=Konga|||opisanie-4=|||refer-ssylka=https://pxl.leads.su/click/07239cfdd4f7acdd519d51ed6b765edd|||id-klassa-ssylki=kongas|||licenziya=|||lgotnyj-period=|||godovoe-obsluzhivanie=|||cashback-karty-deb.=|||zajavok-oformleno=|||mikrozajmy-visa=1|||mikrozajmy-mastercard=1|||mikrozajmy-mir=1|||mikrozajmy-qiwi=1|||mikrozajmy-jandeks.dengi=1|||mikrozajmy-nalichnye=1', '1527863120_konga.png###2018-06', 22, '', 0, 1, '0', '0'),
(2790, 'MoneyMan', 'MoneyMan (МонейМен) микрозаймы: отзывы, условия, оформить', 'Срочный микрозайм онлайн до зарплаты на карту от компании МонейМен.', 'MoneyMan', 'moneyman', 'Первый займ можно получить до 8000 рублей, при повторном обращении до 30000 рублей (при условии, что первый микрозайм был закрыт и погашен согласно договору).<br><br>Обязательное условие - именная банковская карта выданная Российским банком.<br><br>Чтобы погасить задолженность перед Манимен, можно воспользоваться одним из многочисленных способов в зависимости от того, который кажется вам удобным. Доступна оплата банковской картой, переводом со счета в банке, через QIWI или Элекснет. Кроме того, можно наличными оплатить через Contact или оператора сотовой связи МТС.<br><br>', 'redaktor', 1, 0, '3,382,383,384,385,386,387,388,389,390,391,392,393,394,395,396,397,398,399,400,401,402,403,404,405,406,407,408,409,410,411,412,413,414,415,416,417,418,419,420,421,422,423,424,425,426,427,428,429,430,431,432,433,434,435,436,437', 1, 'opisanie=Moneyman – это одна из первых микрофинансовых организаций в России, полностью ведущая свою деятельность онлайн. Каждый день компания помогает гражданам решать срочные финансовые проблемы без сбора документов и стояния в очередях.|||procentnaya-stavka=1.85%|||minimal.-summa=от 1 500 руб.|||summa=до 10 000 руб.|||srok-kredita=до 30 дней|||vozrast=от 21 года|||rabota=Стаж на последнем месте работы от 3 месяцев|||dokumenty=Паспорт, СНИЛС|||reshenie=15 минут|||poluchenie=На банковскую карту VISA или MasterCard|||opisanie-2=Микрозайм «Старт»|||opisanie-3=MoneyMan|||opisanie-4=|||refer-ssylka=https://pxl.leads.su/click/c204c746d1b69de4fa063d4760fd432a|||id-klassa-ssylki=moneyman|||licenziya=|||lgotnyj-period=|||godovoe-obsluzhivanie=|||cashback-karty-deb.=|||zajavok-oformleno=', '1527863626_moneyman.png###2018-06', 16, '', 0, 1, '0', '0'),
(2791, 'Oneclickmoney', 'OneClickMoney (ВанКликМоней) микрозайм: отзывы, условия, оформить', 'Микрозайм на потребительские цели без залога и поручителей от компании Oneclickmoney.', 'Oneclickmoney', 'oneclickmoney', 'Возможность досрочно вернуть всю сумму займа с уплатой процентов только за фактический срок пользования средствами.<br><br>Способы погашения займа: Банковская карта, Webmoney, Яндекс деньги, банковские сервисы Сбербанк Онлайн, Промсвязьбанк, Альфа-клик.<br><br>Для оформления займа не потребуются дополнительные справки и привлечение поручителей.<br><br>В личном кабинете на сайте МФО вы также можете подключить услугу «Автоплатёж»: привязав свою карту или онлайн-кошелек, вы можете не беспокоиться о просрочках, система сама спишет обозначенную сумму в определенное время, установленное договором.', 'redaktor', 1, 0, '3,382,383,384,385,386,387,388,389,390,391,392,393,394,395,396,397,398,399,400,401,402,403,404,405,406,407,408,409,410,411,412,413,414,415,416,417,418,419,420,421,422,423,424,425,426,427,428,429,430,431,432,433,434,435,436,437', 1, 'opisanie=Микрокредитная компания OneClickMoney занимается выдачей срочных займов населению. Она готова предоставлять быстрые онлайн-займы, не требуя от клиентов справок, поручителей и залога. Компания не имеет филиальной сети, так как выдает денежные средства через интернет.|||procentnaya-stavka=1,80%|||minimal.-summa=от 1 000 руб.|||summa=до 20 000 руб.|||srok-kredita=до 21 дня|||vozrast=от 18 лет|||rabota=Постоянный источник дохода|||dokumenty=Паспорт|||reshenie=10 минут|||poluchenie=На банковскую карту VISA или MasterCard|||opisanie-2=Микрозайм «До зарплаты»|||opisanie-3=Oneclickmoney|||opisanie-4=|||refer-ssylka=https://pxl.leads.su/click/a5c5b74854287e458e47188dab556695|||id-klassa-ssylki=jksdf|||licenziya=|||lgotnyj-period=|||godovoe-obsluzhivanie=|||cashback-karty-deb.=|||zajavok-oformleno=', '1533062441_1oneclickmoney.png###2018-07', 6, '', 0, 1, '0', '0'),
(2792, 'Главфинанс', 'Главфинанс микрозайм: отзывы, условия, оформить', 'Займ без залога и поручительства, самый маленький процент среди конкурентов.', 'Главфинанс', 'glavfinans', 'Потенциальный заемщик обязательно должен быть официально трудоустроенным, либо иметь постоянный источник дохода в виде стипендии, пенсии, социальной помощи от государства и другое.<br><br>Возможно понадобится второй документ, подтверждающий личность (на выбор): загранпаспорт, водительские права, военный билет или пенсионное удостоверение. Необходим для дополнительной проверки данных о клиенте.<br><br>Вся процедура от заполнения анкеты до получения средств на карту не занимает и более 30 минут.', 'redaktor', 1, 0, '3,382,383,384,385,386,387,388,389,390,391,392,393,394,395,396,397,398,399,400,401,402,403,404,405,406,407,408,409,410,411,412,413,414,415,416,417,418,419,420,421,422,423,424,425,426,427,428,429,430,431,432,433,434,435,436,437', 1, 'opisanie=«ГлавФинанс» работает на рынке микрофинансирования с июня 2012 года. Компания дает возможность оформить заем онлайн на решение срочных денежных вопросов. Вы можете взять микрокредит до зарплаты на короткий срок с минимальной процентной ставкой.|||procentnaya-stavka=0,75%|||minimal.-summa=от 1 000 руб.|||summa=до 20 000 руб.|||srok-kredita=до 15 дней|||vozrast=от 18 лет|||rabota=Стаж на последнем месте работы от 3 месяцев|||dokumenty=Паспорт|||reshenie=10 минут|||poluchenie=На банковскую карту VISA или MasterCard|||opisanie-2=Микрозайм «До зарплаты»|||opisanie-3=Главфинанс|||opisanie-4=|||refer-ssylka=https://pxl.leads.su/click/aafdfa0fc81e3dbe0a9361e080e6e08e|||id-klassa-ssylki=glavfingh|||licenziya=|||lgotnyj-period=|||godovoe-obsluzhivanie=|||cashback-karty-deb.=|||zajavok-oformleno=', '1527864682_glavfin.png###2018-06', 6, '', 0, 1, '0', '0'),
(2793, 'МигКредит', 'МигКредит (migcredit) микрозайм: отзывы, условия, оформить', 'Займ онлайн без справок, без посещения офиса, без очередей на срок до 30 дней.', 'МигКредит', 'migkredit', 'Справки и поручители не требуются, наличные выдается только по паспорту и второму документу удостоверяющий личность.<br><br>Первый займ можно получить до 55 000 рублей с постепенным погашением (до 24 недель) и до 14500 рублей (и до 29 дней) — с погашением за 1 раз. Вторичный — уже до 99500 рублей и на больший срок (до 48 недель).<br><br>За нарушение сроков оплаты кредита компания начисляет штрафные санкции в размере 20% годовых от суммы просрочки. Если у клиента отсутствует возможность оплатить долг, ему необходимо обратиться к финансовому консультанту компании с просьбой реструктуризировать долг.', 'redaktor', 0, 0, '3,382,383,384,385,386,387,388,389', 1, 'procentnaya-stavka=от 0,26%|||opisanie=Компания «МигКредит» была основана в 2011 году. На сегодня она входит в ТОП-3 крупнейших микрофинансовых организаций России и имеет высокие оценки рейтинговых агентств.&278&<br><br>&278&Данное учреждение специализируется на предоставлении микрозаймов физическим лицам в режиме онлайн. Оформить заем можно в любом регионе страны. При этом не требуется ни залог, ни поручительство.|||minimal.-summa=от 3 000 руб.|||summa=до 100 000 руб.|||srok-kredita=до 365 дней|||rabota=Стаж на последнем месте работы от 3 месяцев|||vozrast=от 21 года|||dokumenty=Паспорт, + второй документ на выбор (загранпаспорт, водительские права, СНИЛС, ИНН, ОМС)|||reshenie=15 минут|||poluchenie=На банковскую карту VISA или MasterCard, CONTACT|||opisanie-2=Микрозайм «До зарплаты»|||opisanie-3=МигКредит|||opisanie-4=|||refer-ssylka=https://pxl.leads.su/click/11dae069fef94db55feb79230e409a0e|||id-klassa-ssylki=migkredits|||lgotnyj-period=|||godovoe-obsluzhivanie=|||cashback-karty-deb.=|||nomer-licenzii-cb=', '1527865003_migkredit.png###2018-06', 7, '', 0, 1, '0', '0');
INSERT INTO `dle_offers_post` (`id`, `title`, `titlelink`, `description`, `keywords`, `alt_name`, `text`, `author`, `author_id`, `comm_num`, `category`, `allow_comm`, `xfields`, `photos`, `views`, `color`, `color_date`, `approve`, `rate`, `sort`) VALUES
(2794, 'Lime-zaim', 'Лайм-Займ (Lime-zaim) микрозайм: отзывы, условия, оформить', 'Займы физическим лицам на потребительские нужды от компании Lime-zaim.', 'Lime-zaim', 'lime-zaim', 'Для получения займа необходимо создать личный кабинет, а далее следовать инструкции.<br><br>Потребуется именная банковская карта, выданная банком России, с положительным балансом является тоже обязательной.<br><br>Все процедура от регистрации до получения денежных средств не займет и более 20 минут.', 'redaktor', 0, 0, '3,382,383,384,385,386,387,388,389', 1, 'procentnaya-stavka=2,17%|||opisanie=Лайм-Займ существует с 2013 года, за это время организация заслужила положительную репутацию. Сейчас здесь оформляют займы тысячи клиентов по всей стране, также была подключена Польша и границы будут расширятся. Здесь используется индивидуальная система безопасности, пользователи могут не переживать, все их личные данные надежно защищены.&278&|||minimal.-summa=от 1 500 руб.|||summa=до 15 000 руб.|||srok-kredita=до 30 дней|||rabota=Стаж на последнем месте работы от 3 месяцев|||vozrast=от 21 года|||dokumenty=Паспорт, ИНН или СНИЛС|||reshenie=15 минут|||poluchenie=На банковскую карту VISA, MasterCard, МИР|||opisanie-2=Микрозайм «Старт»|||opisanie-3=Lime-zaim|||opisanie-4=|||refer-ssylka=https://pxl.leads.su/click/ce2f79631bda718d8360e1c390c5125a|||id-klassa-ssylki=lamin|||lgotnyj-period=|||godovoe-obsluzhivanie=|||cashback-karty-deb.=|||nomer-licenzii-cb=', '1527865339_bez_imeni-3.png###2018-06', 5, '', 0, 1, '0', '0'),
(2795, 'Займер', 'Займер (Zaymer) микрозайм: отзывы, условия, оформить', 'Займ на любые цели для клиентов, обратившихся первый раз.', 'Займер', 'zajmer', 'Как правило, заполнение анкеты занимает не более 10 минут. После отправки заявки остается только дождаться SMS-сообщения с положительным или отрицательным решением. Поскольку весь процесс роботизирован, решение принимается буквально за несколько минут.<br><br>Вернуть займ можно в личном кабинете заемщика, с помощью электронных кошельков, банковской карты или переводом на банковский счет.<br><br>Пользоваться сервисом «Займер» достаточно просто, удобно и выгодно.', 'redaktor', 1, 0, '3,382,383,384,385,386,387,388,389,390,391,392,393,394,395,396,397,398,399,400,401,402,403,404,405,406,407,408,409,410,411,412,413,414,415,416,417,418,419,420,421,422,423,424,425,426,427,428,429,430,431,432,433,434,435,436,437', 1, 'opisanie=ООО МФК \"Займер\" - это первый в России полностью автоматизированный сервис, выдающий онлайн займы без участия человека быстро, круглосуточно, без праздников и выходных.&278&<br>&278&В основе работы системы - сверхскоростной робот ООО МФК \"Займер\", который быстро анализирует более 1 800 параметров заявки обратившегося клиента и в течение 1 минуты принимает решение о выдаче кредита.|||procentnaya-stavka=от 0,63%|||minimal.-summa=от 1 000 руб.|||summa=до 30 000 руб.|||srok-kredita=до 30 дней|||vozrast=от 18 лет|||rabota=Стаж на последнем месте работы от 3 месяцев|||dokumenty=Паспорт|||reshenie=10 минут|||poluchenie=На банковскую карту VISA или MasterCard, Яндекс, QIWI и CONTACT|||opisanie-2=Микрозайм «Старт»|||opisanie-3=Займер|||opisanie-4=|||refer-ssylka=https://pxl.leads.su/click/1aa10809936f565ec620b194cf45cc70|||id-klassa-ssylki=zaymera|||licenziya=|||lgotnyj-period=|||godovoe-obsluzhivanie=|||cashback-karty-deb.=|||zajavok-oformleno=', '1533060293_1zajmer.png###2018-07', 32, '', 0, 1, '0', '0'),
(2796, 'Ekapusta', 'Екапуста (Екапуста) микрозайм: отзывы, условия, оформить', 'Подробная информация о компании еКапуста. Реквизиты, контактные данные службы поддержки и действующие документы.', 'Ekapusta', 'ekapusta', 'Микрозаймы в сервисе Екапуста выдаются на срок от 7 до 21 дня.<br><br>После успешно одобренной заявки перечисление средств на карту, происходит практически мгновенно.<br><br>Срок погашения микрозайма может быть продлен с согласия администрации сервиса на срок от 7 до 21 дня в любой день.<br><br>Погасить займ можно любыми способами: банковской картой, электронными кошельками и в любом отделении банка.', 'redaktor', 1, 0, '3,388,389,390,391,392,393,394,395,396,397,398,399,400,401,402,403,404,405,406,407,408,409,410,411,412,413,414,415,416,417,418,419,420,421,422,423,424,425,426,427,428,429,430,431,432,433,434,435,436,437', 1, 'opisanie=Сервис онлайн-займов еКапуста принадлежит и управляется компанией ООО МКК «Русинтерфинанс» (ИНН 5408292849, ОГРН 1125476023298). Лицензия на микрофинансовую деятельность №2120754001243 выдана Федеральной Службой по Финансовым Рынкам 22.03.2012г. Компания ведет свою деятельность на территории и в соответствии с законодательством Российской Федерации.|||procentnaya-stavka=от 0,00%|||minimal.-summa=от 100 руб.|||summa=до 30 000 руб.|||srok-kredita=до 30 дней|||vozrast=от 18 лет|||rabota=Стаж на последнем месте работы от 3 месяцев|||dokumenty=Паспорт, мобильный телефон, именная банковская карта|||reshenie=10 минут|||poluchenie=На банковскую карту VISA или MasterCard, Яндекс, QIWI и CONTACT|||opisanie-2=Микрозайм «Онлайн»|||opisanie-3=Ekapusta|||opisanie-4=|||refer-ssylka=https://pxl.leads.su/click/af8b1fa07b7362d413fcb6aa3d322698|||id-klassa-ssylki=kapusta|||licenziya=|||lgotnyj-period=|||godovoe-obsluzhivanie=|||cashback-karty-deb.=|||zajavok-oformleno=', '1527865576_ekapusta.png###2018-06', 8, '', 0, 1, '0', '0'),
(2797, 'Ё-заем', 'Ezaem (Езаем) микрозайм: отзывы, условия, оформить', 'При первичном обращении нужно зарегистрироваться на сайте компании и получить беспроцентный займ.', 'Ezaem', 'e-zaem', 'Езаем способен выдавать на ограниченный срок небольшие деньги для того, чтобы каждый мог мгновенно решить свои материальные проблемы. Есть несколько основных преимуществ у этого ресурса:<br><br><!--dle_list--><ul><li>Скорость работы, деньги будут получены спустя несколько минут после окончания оформления заявки.<br><br></li><!--dle_li--><li>Нет необходимости собирать документы, достаточно только паспортных данных и фотографии этого документа для того, чтобы подтвердить свою личность.<br></li></ul><!--dle_list_end--><br><br>Оформление может происходить, не выходя из дома, средства будут перечислены на карту или указанный счет. Банковская карта заемщика обязательно должна быть именной.<br><br>К сожалению, первоначально получить крупную сумму невозможно. Новичкам выдается символический займ всего в 3-5 тысяч рублей, а затем при повторном обращении сумма может расти, конечно, при учете своевременного погашения займа.<br><br><b>Способы погашения займа:</b><br> <!--dle_list--><ul><li>В личном кабинете на сайте «Е заем» при помощи: Банковских карт VISA и MASTERCARD;<br></li><!--dle_li--><li>Электронный кошелек QIWI;<br></li><!--dle_li--><li>Через электронный терминал QIWI;<br></li><!--dle_li--><li>Наличными, через систему денежных переводов CONTACT;<br></li><!--dle_li--><li>В отделении любого банка.<br></li></ul><!--dle_list_end-->', 'redaktor', 1, 0, '3,382,383,384,385,386,387,388,389,390,391,392,393,394,395,396,397,398,399,400,401,402,403,404,405,406,407,408,409,410,411,412,413,414,415,416,417,418,419,420,421,422,423,424,425,426,427,428,429,430,431,432,433,434,435,436,437', 1, 'opisanie=ООО «Е заем» является частью европейского холдинга FinaBay и предоставляет краткосрочные денежные займы на территории России с 2012 года. Использую наработанный годами опыт и современные технологические решения, МФО «Е заем» реализует индивидуальный и качественный подход к каждому клиенту. &278&&278&В рамках оказания услуг быстрого кредитования «Е заем» предоставляет краткосрочные займы от 1 000 до 30 000 рублей сроком до 30 дней. Новым клиентам первый займ предоставляется без уплаты процентов за его пользование.&278&|||procentnaya-stavka=0.00%|||minimal.-summa=от 1 000 руб.|||summa=до 15 000 руб.|||srok-kredita=до 30 дней|||vozrast=от 20 года|||rabota=Стаж на последнем месте работы от 3 месяцев|||dokumenty=паспорт|||reshenie=5 минут|||poluchenie=На банковскую карту VISA или MasterCard, Яндекс, QIWI и CONTACT|||opisanie-2=Микрозайм «Первый заем»|||opisanie-3=Ё-заем|||opisanie-4=|||refer-ssylka=https://pxl.leads.su/click/2e2e7e1e381420a02c6497da79f4b473|||id-klassa-ssylki=ezaem|||licenziya=|||lgotnyj-period=|||godovoe-obsluzhivanie=|||cashback-karty-deb.=|||zajavok-oformleno=', '1527865800_ezaem.png###2018-06', 71, '', 0, 1, '0', '0'),
(2798, 'Альфа-Банк', 'Кредитная карта 100 дней без процентов Альфа-Банка - условия, описание, отзывы', 'Тарифы кредитной карты «100 дней без процентов» от Альфа-Банка: процентные ставки, условия получения и погашения кредита.', 'Альфа-Банк', 'alfa-bank-sto-dney', '<p>Карта от Альфа Банка &laquo;100 дней без %&raquo; &mdash; это кредитный продукт, предоставляемый банком на выгодных условиях. Название карты говорит само за себя, и означает, что при пользовании заемными средствами с клиента не берутся проценты в течение 100 календарных дней.<br><br>Постоянный доход заемщика от 9 000 руб. после вычета налогов для Москвы и 5 000 руб. для регионов России.<br><br>Минимальная сумма кредитного лимита для клиентов Московских подразделений Банка - 10800 руб.<br><br>Минимальный ежемесячный платеж не превышает 10% от суммы задолженности по кредитной карте, но не менее 300 руб. и не более задолженности.<br><br>Неустойка 0,1 % от суммы просроченной задолженности за каждый день нарушения обязательств.</p>', 'redaktor', 0, 0, '2,438,439,440,441,442,443,444,445,446,447', 1, 'procentnaya-stavka=от 14,99%|||opisanie=ОАО «Альфа-Банк» был основан в 1990 году. ОАО «Альфа-Банк» является уникальным банком, осуществляющим все основные виды банковских операций, представленных на рынке финансовых услуг, включая обслуживание частных и корпоративных клиентов, инвестиционный банковский бизнес, торговое финансирование и управление активами.|||minimal.-summa=от 30 000 руб.|||summa=до 500 000 руб.|||srok-kredita=|||rabota=Стаж на последнем месте работы от 3 месяцев|||vozrast=от 21 года|||dokumenty=Паспорт, справка о доходах 2-НДФЛ или по форме банка|||reshenie=15 минут|||poluchenie=Выдача карты в отделении банка|||opisanie-2=Карта «100 дней без процентов» Masterсard|||opisanie-3=Альфа-Банк|||opisanie-4=|||refer-ssylka=https://pxl.leads.su/click/e4ca3d7940605c7507460b4d15f17a53|||id-klassa-ssylki=alfacardf|||lgotnyj-period=100 дней|||godovoe-obsluzhivanie=от 1 490 руб.|||cashback-karty-deb.=|||nomer-licenzii-cb=', '1527867093_alfa_bank.PNG###2018-06', 135, '', 1602450000, 1, '11', '0'),
(2799, 'Альфа-Банк', 'Кредитная карта «Перекресток» MasterCard World от Альфа-Банка: условия, отзывы, оформить', 'Тарифы кредитной карты «Перекресток» от Альфа-Банка: процентные ставки, условия получения и погашения кредита.', '', 'alfa-bank-perekrestok', '<p>Скидки и специальные предложения в мобильном приложении &laquo;Мой Перекресток&raquo;.<br><br>Возможность оплачивать свои покупки при помощи Apple Pay, Android Pay и Samsung Pay.<br><br>Бесплатные переводы с карт любых банков на карту &laquo;Альфа-Банка&raquo;.<br><br>Баллы &laquo;Перекресток&raquo; за любые покупки:</p>\r\n<!--dle_list-->\r\n<ul>\r\n<li>5000 баллов &laquo;Перекресток&raquo; в подарок после первой покупки;</li>\r\n<!--dle_li-->\r\n<li>3 балла за каждые 10 руб. покупки в Перекрестке;</li>\r\n<!--dle_li-->\r\n<li>2 балла за каждые 10 руб. покупок в других магазинах;</li>\r\n<!--dle_li-->\r\n<li>7 баллов за каждые 10 руб., потраченные на товары в супермаркетах &laquo;Перекресток&raquo; из категории</li>\r\n</ul>\r\n<!--dle_list_end-->', 'redaktor', 0, 0, '2,438,439,440,441,442,443,444,445,446,447', 1, 'procentnaya-stavka=от 23,99%|||opisanie=ОАО «Альфа-Банк» был основан в 1990 году. ОАО «Альфа-Банк» является универсальным банком, осуществляющим все основные виды банковских операций, представленных на рынке финансовых услуг, включая обслуживание частных и корпоративных клиентов, инвестиционный банковский бизнес и торговое финансирование.|||minimal.-summa=|||summa=до 300 000 руб.|||srok-kredita=|||rabota=Стаж на последнем месте работы от 3 месяцев|||vozrast=от 21 года|||dokumenty=Паспорт, справка о доходах 2-НДФЛ или по форме банка|||reshenie=15 минут|||poluchenie=Выдача карта в отделении банка|||opisanie-2=Кредитная карта «Перекресток»|||opisanie-3=Альфа-Банк|||opisanie-4=|||refer-ssylka=https://pxl.leads.su/click/4668a655e31326342b77f67ffac705b0|||id-klassa-ssylki=bfkarta|||lgotnyj-period=60 дней|||godovoe-obsluzhivanie=490 руб.|||cashback-karty-deb.=|||nomer-licenzii-cb=', '1528099407_alfa_perekrestok.PNG###2018-06', 13, '', 0, 1, '0', '0'),
(2800, 'Восточный экспресс Банк', 'Кредитная карта «CashBack» от Восточного экспресс Банка: условия, описание, отзывы', 'Полное описание условий получения карты CashBack от Восточный экспресс Банк. Новые отзывы от пользователей.', '', 'vostochnyj-jekspress-bank-cashback', '<p>Как видно из названия, кредитная карта сделана для извлечения выгоды от совершения покупок. Восточный экспресс Банк предоставляет кредитные деньги на 5 лет, при этом для оформления заявки достаточно только паспорта и подтверждение дохода. Как и любой кредитной картой, этой выгодно пользоваться не снимая наличные. В таком случае ставка будет 29.9%.<br><br>Вносите вовремя плату за пользование заемным лимитом, не допускайте просрочек, и тогда эта карточка станет хорошим финансовым помощником.<br><br>5% кэшбек действует на определенные категории: кафе быстрого питания, рестораны, бары, авиабилеты, железнодорожные билеты, медикаменты в аптеках, СТО, магазины для автолюбителей, магазины косметики.<br><br><br></p>', 'redaktor', 0, 0, '2,438,439,440,441,442,443,444,445,446,447', 1, 'procentnaya-stavka=от 24 %|||opisanie=ПАО «КБ «Восточный Экспресс Банк» — это один из самых крупных специализированных розничных банков. У Банка хорошо развита сеть продаж, а также широк выбор услуг — таких, как предоставление кредитов и привлечение депозитов населению и корпоративным клиентам.|||minimal.-summa=от 55 000 руб.|||summa=до 300 000 руб.|||srok-kredita=|||rabota=Стаж на последнем месте работы от 3 месяцев|||vozrast=от 20 года|||dokumenty=Паспорт, справка о доходах 2-НДФЛ или по форме банка|||reshenie=15 минут|||poluchenie=Выдача карты в отделении банка|||opisanie-2=Кредитная карта «CashBack» Visa Classic|||opisanie-3=Восточный экспресс Банк|||opisanie-4=|||refer-ssylka=https://pxl.leads.su/click/24a76bdc8fea5d64cc0bac3d242cd9c9|||id-klassa-ssylki=hostinf|||lgotnyj-period=56 дней|||godovoe-obsluzhivanie=бесплатно|||cashback-karty-deb.=|||nomer-licenzii-cb=', '1528110225_vostochnyj_bank.PNG###2018-06', 8, '', 1602450000, 1, '0', '0'),
(2801, 'Совкомбанк', 'Кредитная карта «Халва» от Совкомбанка: условия, описание, отзывы', 'Полное описание условий получения карты рассрочки Халва от Совкомбанка. Новые отзывы от пользователей карты Халва.', '', 'sovkombank-halva', '<p>Карта рассрочки Халва - это возможность совершать ежедневные покупки в рассрочку до 12 месяцев без первоначального взноса, комиссий и переплат в магазинах-партнерах.<br><br>Обязательные требования:<br>-</p>\r\n<!--dle_list-->\r\n<ul>\r\n<li>Наличие постоянной регистрации не менее 4 последних месяцев (на территории одного населенного пункта РФ) и проживание в городе присутствия подразделения Банка или прилегающих населенных пунктах (но не более 70 километров от границы населенного пункта).</li>\r\n<!--dle_li-->\r\n<li>Наличие стационарного рабочего или домашнего телефона.</li>\r\n</ul>\r\n<!--dle_list_end-->\r\n<p><br><br><br>Льготный период составляет 1-36 месяцев. По истечении льготного периода начисляется 10%, если по карте просрочка в течении 36 месяцев. Если после льготного периода сумма не будет внесена, то начисляются штрафы.<br><br>Фиксированная ставка на остаток &ndash; 6,5% годовых, в отчётный месяц она может быть увеличена до 7,5% - если сделано 5 и более расходных операций.<br><br>Размер неустойки при неоплате минимального ежемесячного платежа - 19% годовых.</p>', 'redaktor', 0, 0, '2,438,439,440,441,442,443,444,445,446,447', 1, 'procentnaya-stavka=от 0,00%|||opisanie=ООО ИКБ «СОВКОМБАНК» считается одним из самых надежных финансовых учреждений России. С 2008 года он входит в ТОП-50 лидеров банковского сектора. Специализированные международные и российские рейтинги («Русрейтинг», Standard&Poor’s) дают положительные оценки его деятельности. Кроме того, он занимает 42 место по количеству активов, 26 место по объему кредитов для физических лиц, 27 место по объему депозитов.|||minimal.-summa=|||summa=до 350 000 руб.|||srok-kredita=|||rabota=Стаж на последнем месте работы от 3 месяцев|||vozrast=от 20 года|||dokumenty=Паспорт, справка о доходах 2-НДФЛ или по форме банка|||reshenie=15 минут|||poluchenie=Выдача карты в отделении банка|||opisanie-2=Кредитная карта «Халва» Masterсard World|||opisanie-3=Совкомбанк|||opisanie-4=|||refer-ssylka=https://pxl.leads.su/click/0d70727333c4dfe1f04228e40674dd91|||id-klassa-ssylki=halvakr|||lgotnyj-period=365 дней|||godovoe-obsluzhivanie=бесплатно|||cashback-karty-deb.=|||nomer-licenzii-cb=', '1528110532_halva.PNG###2018-06', 47, '', 1602450000, 1, '0', '0'),
(2802, 'Киви Банк', 'Кредитная карта «Совесть» от Киви Банк: условия, описание, отзывы', 'Полное описание условий получения карты Совесть от Киви Банка. Новые отзывы от пользователей карты Совесть.', '', 'kivi-bank-sovest', '<p>Карта рассрочки - это банковская предоплаченная карта, которая может быть использована для оплаты товаров и услуг только в магазинах-партнерах. <br><br>Банк открывает клиенту счет в рублях и предоставляет кредит на сумму покупки, а для того, чтобы рассрочка была удобной, банк выпускает карту рассрочки, привязанную к такому счету.<br><br>Период рассрочки - в зависимости от партнера, от 1 до 12 месяцев.<br><br>Проценты не будут взиматься при условии полного погашения ссуды в течение срока рассрочки ежемесячными платежами.<br><br><u>Комиссия за внесение платежа отсутствуют.</u> <br><br>По истечении периода рассрочки начисляются проценты в размере 10% годовых (0,03% в день) от неоплаченной суммы.<br><br>Оформление новой карты взамен выпущенной 690 руб. (по инициативе клиента, по причине утраты/порчи).<br><br>Суточный лимит: 7500 рулей.<br><br>Месячный лимит: 15000 рублей.</p>', 'redaktor', 0, 0, '2,438,439,440,441,442,443,444,445,446,447', 1, 'procentnaya-stavka=10%|||opisanie=КИВИ Банк (АО) входит в состав Группы QIWI. Ежедневно через точки розничного обслуживания, количество которых составляет около 169 тысяч, Банк проводит более 750 тыс. транзакций в сутки.|||minimal.-summa=|||summa=до 300 000 руб.|||srok-kredita=|||rabota=Стаж на последнем месте работы от 3 месяцев|||vozrast=от 18 лет|||dokumenty=Паспорт|||reshenie=15 минут|||poluchenie=|||opisanie-2=Кредитная карта «Совесть» Visa Classic|||opisanie-3=Киви Банк|||opisanie-4=|||refer-ssylka=https://pxl.leads.su/click/20b8969ed9c53132a264eafff72f773c|||id-klassa-ssylki=sovesti|||lgotnyj-period=до 365 дней|||godovoe-obsluzhivanie=490 руб.|||cashback-karty-deb.=|||nomer-licenzii-cb=', '1528110748_sovest.PNG###2018-06', 43, '', 1602450000, 1, '0', '0'),
(2803, 'Райффайзенбанк', 'Кредитная карта «#ВCЁСРАЗУ» от Райффайзенбанк: условия, описание, отзывы', 'Полная информация по обслуживанию кредитной карты - #ВCЁСРАЗУ. Новые отзывы клиентов о Райффайзенбанк.', '', 'rajffajzenbank-vsesrazy', '<p>Условия оформления кредитной карты &laquo;#ВcёСразу&raquo; Виза Голд Райффайзенбанка с начислением бонусов. <br><br>Ставка по кредиту от 29 до 39% годовых, льготный период пятьдесят дней. Возможно получение решения банка без справки о доходах 2-НДФЛ. <br><br>Стоимость обслуживания &mdash; 1 490 рублей в год.<br><br>SMS-уведомление по счёту 60 рублей. За первые 2 месяца предоставления услуги при первичном подключении услуги комиссия не взимается.<br><br>Основные требования:</p>\r\n<!--dle_list-->\r\n<ul>\r\n<li>Минимальный доход после налогообложения составляет 25 000 рублей;</li>\r\n<!--dle_li-->\r\n<li>постоянное место работы на территории РФ;</li>\r\n<!--dle_li-->\r\n<li>Справка о зарплате по форме 2-НДФЛ (оригинал) с указанным доходом не менее чем за 3 последних месяца. Дата выдачи справки 2-НДФЛ не более 30 календарных дней ранее, чем дата подачи Заявление-Анкета на кредитную карту;</li>\r\n<!--dle_li-->\r\n<li>Справка по форме Банка о доходах, заверенная работодателем, за предыдущие 3 месяца.</li>\r\n</ul>\r\n<!--dle_list_end-->', 'redaktor', 0, 0, '2,438,439,440,441,442,443,444,445,446,447', 1, 'procentnaya-stavka=от 29%|||opisanie=АО «Райффайзенбанк» является дочерним подразделением одного из крупнейших банков Австрии с одноимённым названием. Данная кредитная организация является одной из самых развитых на российском рынке. Всем своим клиентам она предлагает полный комплекс банковских услуг, работая как с физическими, так и юридическими лицами. Банк довольно активен на валютном и межбанковском рынке.|||minimal.-summa=|||summa=до 600 000 руб.|||srok-kredita=|||rabota=Стаж на последнем месте работы от 6 месяцев|||vozrast=от 21 года|||dokumenty=Паспорт, справка о доходах 2-НДФЛ или по форме банка|||reshenie=от 1 дня|||poluchenie=Выдача карты в отделении банка|||opisanie-2=Кредитная карта «#ВCЁСРАЗУ» Visa|||opisanie-3=Райффайзенбанк|||opisanie-4=|||refer-ssylka=https://pxl.leads.su/click/dbc796b86fe260faedb9a7bc91c38a02|||id-klassa-ssylki=raqfin|||lgotnyj-period=50 дней|||godovoe-obsluzhivanie=1 490 руб.|||cashback-karty-deb.=|||nomer-licenzii-cb=', '1528112025_rajfajzen.png###2018-06', 8, '', 0, 1, '0', '0'),
(2804, 'Тинькофф Банк', 'Кредитная карта «Тинькофф Платинум» от Тинькофф Банка: условия, описание, отзывы', 'Полная информация по обслуживанию кредитной карты - Тинькофф Платинум. Новые отзывы клиентов.', '', 'tinkoff-bank-platinum', '<p>Тарифный план каждому клиенту устанавливается индивидуально, в зависимости от его кредитной истории.<br><br>Бесплатные Интернет банк и Мобильный банк.<br><br>Бесплатная услуга SMS-инфо (информация о действиях с картой: о выпуске кредитной карты, пополнении счета, активации и блокировке карты, обо всех операциях в интернет-банке и мобильном банке).<br><br>Бесплатные сообщения о пополнениях карты, SMS-выписки, напоминания о платежах и прочие сообщения.<br><br>Бесплатная доставка домой или в офис по всей территории России за 1-7 дней.<br><br>Используйте средства карты, чтобы погасить кредит в любом другом банке на льготных условиях:</p>\r\n<!--dle_list-->\r\n<ul>\r\n<li>0% - комиссия за перевод задолженности;</li>\r\n<!--dle_li-->\r\n<li>120 дней не надо платить проценты за кредит.</li>\r\n</ul>\r\n<!--dle_list_end-->', 'redaktor', 0, 0, '2,438,439,440,441,442,443,444,445,446,447', 1, 'procentnaya-stavka=от 15%|||opisanie=Банк был зарегистрирован в январе 1994 года как Химмашбанк. В 2005 году стал участником системы страхования вкладов, а в 2006 году был приобретен известным бизнесменом Олегом Тиньковым и переименован в ЗАО «Тинькофф Кредитные Системы», а также переориентирован на работу с физическими лицами. На данный момент является единственным банк обслуживающий клиентов дистанционно.|||minimal.-summa=|||summa=до 300 000 руб.|||srok-kredita=|||rabota=Стаж на последнем месте работы от 3 месяцев|||vozrast=от 18 лет|||dokumenty=Паспорт, + второй документ на выбор (загранпаспорт, водительские права, СНИЛС, ИНН, ОМС)|||reshenie=10 минут|||poluchenie=Карта выдается курьером при подписании договора|||opisanie-2=Кредитная карта «Тинькофф Платинум» Masterсard|||opisanie-3=Тинькофф Банк|||opisanie-4=|||refer-ssylka=https://pxl.leads.su/click/2b1d457d7753e1c8c810c04c65a12458|||id-klassa-ssylki=tinkoffcar|||lgotnyj-period=120 дней|||godovoe-obsluzhivanie=590 руб.|||cashback-karty-deb.=|||nomer-licenzii-cb=', '1528112932_tinkoff_karta.PNG###2018-06', 115, '', 1602450000, 1, '0', '0'),
(2805, 'Ренессанс Кредит', 'Кредитная карта «Ренессанс Кредит» от банка Ренессанс Кредит: условия, описание, отзывы', 'Подробное описание кредитной карты от банка Ренессанс Кредит. Новые отзывы от пользователей.', '', 'renessans-kredit-creditcard', '<p>Ежемесячный доход заемщика за вычетом налогов должен составлять не менее 12 000 рублей для жителей Москвы, 8 000 рублей для жителей других регионов.<br><br>Штраф за нарушение сроков платежей, в том числе в погашение Задолженности по Договору - 750 рублей.<br><br>Действует система бонусов, подробнее расскажут при получении карты в отделении банка.</p>', 'redaktor', 0, 0, '2,438,439,440,441,442,443,444,445,446,447', 1, 'procentnaya-stavka=от 24,9%|||opisanie=Банк «Ренессанс Кредит» был зарегистрирован Центральным Банком Российской Федерации 24 ноября 2000 г. под номером №3354.|||minimal.-summa=|||summa=до 200 000 руб.|||srok-kredita=|||rabota=Стаж на последнем месте работы от 3 месяцев|||vozrast=от 21 года|||dokumenty=Паспорт, + второй документ на выбор (загранпаспорт, водительские права, СНИЛС, ИНН, ОМС)|||reshenie=30 минут|||poluchenie=Выдача карты в отделении банка|||opisanie-2=Кредитная карта «Ренессанс Кредит» Masterсard|||opisanie-3=Ренессанс Кредит|||opisanie-4=|||refer-ssylka=https://pxl.leads.su/click/1aff668ab9e42b26a810ca6fd980f931|||id-klassa-ssylki=renessav|||lgotnyj-period=55 дней|||godovoe-obsluzhivanie=бесплатно|||cashback-karty-deb.=|||nomer-licenzii-cb=', '1528113243_renesans.PNG###2018-06', 41, '', 0, 1, '0', '0'),
(2806, 'Росбанк', 'Дебетовая карта «Сверхкарта+» Visa Platinum от Росбанка: условия использования и отзывы клиентов', 'Тарифы дебетовой карты «Сверхкарта+» от Росбанка: процентные ставки, условия получения отзывы.', 'Росбанк', 'rosbank-sverhkarta', '<p>В рамках пакета услуг \\\"Сверхкарта+\\\" клиенту предоставляются 2 бесплатные дополнительные карты (классическая и золотая), до 4-х счетов (в рублях, долларах США, евро и китайских юанях), в т. ч. сберегательных с начислением 5,5% годовых в рублях, 0,15-0,2% годовых в долларах США, 0,01% годовых в евро.<br><br></p>', 'redaktor', 0, 0, '4,477,478,479,480,481,482,483,484,485,486', 1, 'procentnaya-stavka=|||opisanie=Акционерный коммерческий банк «РОСБАНК» был зарегистрирован в Банке России 2 марта 1993 года под названием АКБ «Независимость» (АОЗТ) с присвоением регистрационного номера 2272. ОАО АКБ «РОСБАНК» является акционерным коммерческим банком и осуществляет свою деятельность в Российской Федерации с 1993 года.|||minimal.-summa=|||summa=|||srok-kredita=|||rabota=|||vozrast=от 18 лет|||dokumenty=Паспорт|||reshenie=|||poluchenie=Выдача карты в отделении банка|||opisanie-2=Дебетовая карта «Сверхкарта+» Visa|||opisanie-3=Росбанк|||opisanie-4=|||refer-ssylka=https://pxl.leads.su/click/ba2764d74df8b7b426a42052f73d1626|||id-klassa-ssylki=rosdebkard|||lgotnyj-period=|||godovoe-obsluzhivanie=от 0 руб.|||cashback-karty-deb.=до 7%|||nomer-licenzii-cb=', '1528113566_ros_bank.png###2018-06', 39, '', 0, 1, '0', '0'),
(2807, 'Промсвязьбанк', 'Дебетовая карта «Карта мира без границ» от Промсвязьбанка: условия, описание, отзывы', 'Полная информация по обслуживанию дебетовой карты - «Карта мира без границ». Новые отзывы клиентов о Промсвязьбанка.', '', 'promsvjazbank-katamirabezgranic', '<p>Начисление бонусных миль за покупки по карте, которыми в дальнейшем можно компенсировать через интернет-банк стоимость произведенных операций в категориях \\\"Авиабилеты\\\", \\\"Билеты на поезд\\\", \\\"Круизы\\\", \\\"Аренда автомобиля\\\", \\\"Бронирование отеля\\\", \\\"Заказ готового тура\\\" по курсу 1 миля = 1 рубль.</p>', 'redaktor', 0, 0, '4,477,478,479,480,481,482,483,484,485,486', 1, 'procentnaya-stavka=|||opisanie=Промсвязьбанк – универсальный государственный банк, основанный в 1995 году. Входит в десятку крупнейших банков России и в список системно значимых кредитных организаций, утвержденный Центробанком. Промсвязьбанк выбран в качестве опорного банка для операций по гособоронзаказу и крупным госконтрактам. Услугами банка пользуются 2,5 миллиона физических и свыше 200 тысяч юридических лиц.|||minimal.-summa=|||summa=|||srok-kredita=|||rabota=|||vozrast=от 18 лет|||dokumenty=|||reshenie=|||poluchenie=Выдача карты в отделении банка|||opisanie-2=Дебетовая карта «Карта мира без границ» Visa|||opisanie-3=Промсвязьбанк|||opisanie-4=|||refer-ssylka=https://pxl.leads.su/click/dbb0a13d8f7d1eac9ec7691d724239d8|||id-klassa-ssylki=promcards|||lgotnyj-period=|||godovoe-obsluzhivanie=1990 руб.|||cashback-karty-deb.=Начисляется милями|||nomer-licenzii-cb=', '1528114381_promsvjazbank.png###2018-06', 9, '', 0, 1, '0', '0'),
(2808, 'Хоум Kредит Банк', 'Дебетовая карта «Польза» от Хоум Kредит Банка: условия, описание, отзывы', 'Полная информация по обслуживанию дебетовой карты -«Польза» от Хоум Kредит Банк. Новые отзывы клиентов.', '', 'houm-kredit-bank-polza', '<p>При покупках в торговых сетях-партнерах банка начисляется повышенный кэшбэк. Лимита по начислению баллов нет. Самые известные партнеры банка с повышенным кэшбэком:</p>\r\n<!--dle_list-->\r\n<ul>\r\n<li>ЛитРес &mdash; 21%;</li>\r\n<!--dle_li-->\r\n<li>Reebok, Adidas &mdash; 11%;</li>\r\n<!--dle_li-->\r\n<li>Booking. com &mdash; 9%;</li>\r\n<!--dle_li-->\r\n<li>AliExpress &mdash; 7%;</li>\r\n<!--dle_li-->\r\n<li>Спортмастер &mdash; 5%;</li>\r\n<!--dle_li-->\r\n<li>Кораблик &mdash; 4%;</li>\r\n<!--dle_li-->\r\n<li>М.Видео &mdash; 3% и другие.</li>\r\n</ul>\r\n<!--dle_list_end-->\r\n<p><br><br>До 7,5% годовых на остаток.<br><br>SMS-уведомление по счёту 59 рублей.<br><br>Договор на получение карты может быть заключен и с несовершеннолетним физическим лицом &ndash; гражданином РФ при предъявлении следующих документов: документ, удостоверяющий личность и письменное согласие законных представителей.</p>', 'redaktor', 0, 0, '4,477,478,479,480,481,482,483,484,485,486', 1, 'procentnaya-stavka=|||opisanie=ООО \"Хоум Кредит энд Финанс Банк\", один из лидеров российского рынка банковской розницы, работает на российском рынке с 2002 года.|||minimal.-summa=|||summa=|||srok-kredita=|||rabota=|||vozrast=от 18 лет|||dokumenty=|||reshenie=|||poluchenie=Выдача карты в отделении банка|||opisanie-2=Дебетовая карта «Польза» Visa|||opisanie-3=Хоум Kредит Банк|||opisanie-4=|||refer-ssylka=https://pxl.leads.su/click/97ee0b55849a4398a9ba590a7ee569a2|||id-klassa-ssylki=homasjd|||lgotnyj-period=|||godovoe-obsluzhivanie=1 190 руб.|||cashback-karty-deb.=до 3%|||nomer-licenzii-cb=', '1528115066_polza.png###2018-06', 17, '', 0, 1, '0', '0'),
(2809, 'Альфа-Банк', 'Дебетовая карта «Cashback» Visa от Альфа-Банка - условия, отзывы, описание', 'Тарифы и условия по дебетовой карте с кэшбеком от Альфа-Банка.', 'Альфа-Банк, дебетовая карта', 'alfa-bank-cashback', '<p>Cash Back:</p>\r\n<!--dle_list-->\r\n<ul>\r\n<li>- 5% в ресторанах и кафе;</li>\r\n<!--dle_li-->\r\n<li>- 10% от покупок на заправках;</li>\r\n<!--dle_li-->\r\n<li>- 1% от всех остальных покупок каждый месяц возвращаются обратно на карту.</li>\r\n</ul>\r\n<!--dle_list_end-->\r\n<p><br><br>Возврат осуществляется при общей сумме покупок по карте от 20 000/30 000 рублей за календарный месяц. Сумма возврата не более 2 000/3 000/5 000 рублей в месяц в зависимости от пакета услуг.</p>', 'redaktor', 0, 0, '4,477,478,479,480,481,482,483,484,485,486', 1, 'procentnaya-stavka=|||opisanie=ОАО «Альфа-Банк» был основан в 1990 году. ОАО «Альфа-Банк» является универсальным банком, осуществляющим все основные виды банковских операций, представленных на рынке финансовых услуг, включая обслуживание частных и корпоративных клиентов, инвестиционный банковский бизнес, торговое финансирование и управление активами.|||minimal.-summa=|||summa=|||srok-kredita=|||rabota=|||vozrast=от 18 лет|||dokumenty=Паспорт|||reshenie=|||poluchenie=выдача карты в отделении банка|||opisanie-2=Дебетовая карта «Cashback» Visa|||opisanie-3=Альфа-Банк|||opisanie-4=|||refer-ssylka=https://pxl.leads.su/click/57d70aa1f26afbb4956142f53e808283|||id-klassa-ssylki=alfacals|||lgotnyj-period=|||godovoe-obsluzhivanie=от 1 190 руб.|||cashback-karty-deb.=до 10 %|||nomer-licenzii-cb=', '1534072386_alfabank.png###2018-08', 27, '', 0, 1, '0', '0'),
(2839, 'Тинькофф Банк', 'Дебетовая карта «Tinkoff Black» от Тинькофф Банка: условия, отзывы, описание', 'Подробное описание дебетовой карты  «Tinkoff Black» от Тинькофф Банка. Отзывы от пользователей.', '', 'tinkoff-bank-blacks', '<p>Клиенты Банка могут сделать дебетовые карты Tinkoff Black мультивалютными, с доступными счетами в рублях, долларах, евро и фунтах стерлингов. Переключить карту на нужный валютный счет можно в личном кабинете на сайте банка, в мобильном приложении Тинькофф или обратившись в службу поддержки.<br><br>Возможно подключение Разрешенного овердрафта, плата за который взимается ежедневно, и составляет: 0 руб. для суммы до 3 000 руб.; 19 руб. для суммы от 3 000 руб. до 10 000 руб.; 39 руб. для суммы от 10 000 руб. до 25 000 руб.; 59 руб. для суммы свыше 25 000 руб.<br><br>В мобильном приложении Тинькофф или в личном кабинете можно бесплатно оформить дополнительную виртуальную карту. Её легко привязать её к Apple Pay, Samsung Pay и Google Pay для оплаты покупок в одно касание. Можно самостоятельно устанавливать лимиты на ежемесячные расходы и снятие наличных по данной карте.</p>', 'redaktor', 0, 0, '4,477,478,479,480,481,482,483,484,485,486', 1, 'procentnaya-stavka=|||opisanie=Банк был зарегистрирован в январе 1994 года как Химмашбанк. В 2005 году стал участником системы страхования вкладов, а в 2006 году был приобретен известным бизнесменом Олегом Тиньковым и переименован в ЗАО «Тинькофф Кредитные Системы», а также переориентирован на работу с физическими лицами. На данный момент является единственным банк обслуживающий клиентов дистанционно.|||minimal.-summa=|||summa=|||srok-kredita=|||rabota=|||vozrast=от 18 лет|||dokumenty=Паспорт|||reshenie=|||poluchenie=Карта выдается курьером при подписании документов|||opisanie-2=Дебетовая карта «Tinkoff Black» Visa Classic|||opisanie-3=Тинькофф Банк|||opisanie-4=|||refer-ssylka=https://pxl.leads.su/click/c2743f17e796540f0b1c2dc1813e8bc7|||id-klassa-ssylki=blacktinn|||lgotnyj-period=|||godovoe-obsluzhivanie=99 руб в месяц|||cashback-karty-deb.=до 30%|||nomer-licenzii-cb=', '1533120463_tinkoff.PNG###2018-08', 21, '', 1602450000, 1, '5', '0'),
(2841, 'Greenmoney', 'Greenmoney (ГринМани) микрозаймы: отзывы, условия, оформить', 'Срочные микрозаймы онлайн до зарплаты на карту от компании Greenmoney.', '', 'greenmoney', 'Greenmoney имеет несколько кредитных пакетов, поэтому каждый клиент имеет возможность выбрать для себя оптимальный:<br><!--dle_list--><ul><li>Если клиент обращается в Greenmoney первый раз, он имеет возможность получить 1000-8000 руб. При повторном обращении он может уже рассчитывать на сумму до 30 000 руб;<br><br></li><!--dle_li--><li>Погасить займ нужно на протяжении 1-30 дней;<br><br></li><!--dle_li--><li>Процентная ставка по кредиту до 2,2% в сутки, однако, она может быть понижена в будущем, если клиент будет своевременно погасит существующий займ и будет придерживаться всех остальных взятых на себя обязательств перед микрофинансовой организацией. Во время каждого последующего обращения за займом, такой клиент может рассчитывать на самые выгодные предложения.<br></li></ul><!--dle_list_end-->', 'redaktor', 1, 0, '3,382,383,384,385,386,387,388,389,390,391,392,393,394,395,396,397,398,399,400,401,402,403,404,405,406,407,408,409,410,411,412,413,414,415,416,417,418,419,420,421,422,423,424,425,426,427,428,429,430,431,432,433,434,435,436,437', 1, 'opisanie=ООО МФК «ГринМани» работает с 2012 года. Адрес: 650000, Кемеровская область, город Кемерово, улица Орджоникидзе, 5-28.&278&<br><br>&278&ГринМани ведет деятельность на основании свидетельства о внесении в реестр микрофинансовых организаций №2120742002054, выданного Банком России 6 сентября 2012 года.|||procentnaya-stavka=от 0,95%|||minimal.-summa=от 1000 руб.|||summa=до 30000 руб.|||srok-kredita=до 30 дней|||vozrast=от 20 лет|||rabota=Стаж на последнем месте работы от 3 месяцев|||dokumenty=Паспорт|||reshenie=30 минут|||poluchenie=На банковскую карту VISA или MasterCard|||opisanie-2=Микрозайм «ГринМани»|||opisanie-3=Greenmoney|||opisanie-4=Онлайн|||refer-ssylka=https://pxl.leads.su/click/8ce343a15bd7fb222dd9973d2b071a01|||id-klassa-ssylki=greemon|||licenziya=|||lgotnyj-period=|||godovoe-obsluzhivanie=|||cashback-karty-deb.=|||zajavok-oformleno=', '1534067320_greenmoney.png###2018-08', 8, '', 0, 1, '0', '0');

-- --------------------------------------------------------

--
-- Структура таблицы `dle_plugins`
--

CREATE TABLE `dle_plugins` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL DEFAULT '',
  `description` varchar(255) NOT NULL DEFAULT '',
  `icon` varchar(255) NOT NULL DEFAULT '',
  `version` varchar(10) NOT NULL DEFAULT '',
  `dleversion` varchar(10) NOT NULL DEFAULT '',
  `versioncompare` char(2) NOT NULL DEFAULT '',
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `mysqlinstall` text NOT NULL,
  `mysqlupgrade` text NOT NULL,
  `mysqlenable` text NOT NULL,
  `mysqldisable` text NOT NULL,
  `mysqldelete` text NOT NULL,
  `filedelete` tinyint(1) NOT NULL DEFAULT '0',
  `filelist` text NOT NULL,
  `upgradeurl` varchar(255) NOT NULL DEFAULT '',
  `needplugin` varchar(100) NOT NULL DEFAULT '',
  `phpinstall` text NOT NULL,
  `phpupgrade` text NOT NULL,
  `phpenable` text NOT NULL,
  `phpdisable` text NOT NULL,
  `phpdelete` text NOT NULL,
  `notice` text NOT NULL,
  `mnotice` tinyint(1) NOT NULL DEFAULT '0',
  `posi` mediumint(8) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблицы `dle_plugins_files`
--

CREATE TABLE `dle_plugins_files` (
  `id` int(11) NOT NULL,
  `plugin_id` int(11) NOT NULL DEFAULT '0',
  `file` varchar(255) NOT NULL DEFAULT '',
  `action` varchar(10) NOT NULL DEFAULT '',
  `searchcode` text NOT NULL,
  `replacecode` mediumtext NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `searchcount` smallint(6) NOT NULL DEFAULT '0',
  `replacecount` smallint(6) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблицы `dle_plugins_logs`
--

CREATE TABLE `dle_plugins_logs` (
  `id` int(11) NOT NULL,
  `plugin_id` int(11) NOT NULL DEFAULT '0',
  `area` text NOT NULL,
  `error` text NOT NULL,
  `type` varchar(10) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблицы `dle_pm`
--

CREATE TABLE `dle_pm` (
  `id` int(11) UNSIGNED NOT NULL,
  `subj` varchar(255) NOT NULL DEFAULT '',
  `text` text NOT NULL,
  `user` mediumint(8) NOT NULL DEFAULT '0',
  `user_from` varchar(40) NOT NULL DEFAULT '',
  `date` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `pm_read` tinyint(1) NOT NULL DEFAULT '0',
  `folder` varchar(10) NOT NULL DEFAULT '',
  `reply` tinyint(1) NOT NULL DEFAULT '0',
  `sendid` int(10) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблицы `dle_poll`
--

CREATE TABLE `dle_poll` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `news_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `title` varchar(200) NOT NULL DEFAULT '',
  `frage` varchar(200) NOT NULL DEFAULT '',
  `body` text NOT NULL,
  `votes` mediumint(8) NOT NULL DEFAULT '0',
  `multiple` tinyint(1) NOT NULL DEFAULT '0',
  `answer` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблицы `dle_poll_log`
--

CREATE TABLE `dle_poll_log` (
  `id` int(10) UNSIGNED NOT NULL,
  `news_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `member` varchar(40) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблицы `dle_post`
--

CREATE TABLE `dle_post` (
  `id` int(11) NOT NULL,
  `autor` varchar(40) NOT NULL DEFAULT '',
  `date` datetime NOT NULL DEFAULT '2000-01-01 00:00:00',
  `short_story` mediumtext NOT NULL,
  `full_story` mediumtext NOT NULL,
  `xfields` mediumtext NOT NULL,
  `title` varchar(255) NOT NULL DEFAULT '',
  `descr` varchar(300) NOT NULL DEFAULT '',
  `keywords` text NOT NULL,
  `category` varchar(190) NOT NULL DEFAULT '0',
  `alt_name` varchar(190) NOT NULL DEFAULT '',
  `comm_num` mediumint(8) UNSIGNED NOT NULL DEFAULT '0',
  `allow_comm` tinyint(1) NOT NULL DEFAULT '1',
  `allow_main` tinyint(1) UNSIGNED NOT NULL DEFAULT '1',
  `approve` tinyint(1) NOT NULL DEFAULT '0',
  `fixed` tinyint(1) NOT NULL DEFAULT '0',
  `allow_br` tinyint(1) NOT NULL DEFAULT '1',
  `symbol` varchar(3) NOT NULL DEFAULT '',
  `tags` varchar(255) NOT NULL DEFAULT '',
  `metatitle` varchar(255) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `dle_post`
--

INSERT INTO `dle_post` (`id`, `autor`, `date`, `short_story`, `full_story`, `xfields`, `title`, `descr`, `keywords`, `category`, `alt_name`, `comm_num`, `allow_comm`, `allow_main`, `approve`, `fixed`, `allow_br`, `symbol`, `tags`, `metatitle`) VALUES
(24, 'redaktor', '2018-11-09 15:27:06', '<img src=\\\"http://site1.radimid.ru/uploads/posts/2018-11/1541766501_1kartinka.jpg\\\" alt=\\\"\\\" class=\\\"fr-dib\\\"><br>Ввиду отсутствия стационарных пунктов обслуживания, в Тинькофф банка на высоком уровне развиты мобильные и интернет сервисы. Для того чтобы контролировать затраты и не пропустить обязательный платеж, клиент должен быть проинформирован, как узнать баланс карты Тинькофф через интернет по номеру карты.<br><br>Проверка информации для держателей карт возможна следующими способами:<ol><li>Через интернет:</li><li>Интернет-банкинг;</li><li>Мобильный банкинг;</li><li>Рассылка на электронную почту.</li><li>По телефону:</li><li>Звонок на горячую линию;</li><li>Запрос по смс.</li><li>В отделении/банкомате другого банка, но за это взимается дополнительная плата.</li></ol>Высокого уровня популярности кредитные карты Тинькофф банка достигли благодаря простоте их оформления – это можно сделать быстро и легко в интернете. Поскольку на кредитке устанавливается достаточно большой лимит, чтобы не потратить незапланированные деньги, важно знать, как на карте Тинькофф проверить баланс. Целесообразным будет подключение всех доступных сервисов вместе вначале сотрудничества, что позволит самостоятельно провести любой платеж.<br><br><h2>Проверка баланса через интернет по номеру карты</h2>Самый удобный способ проверки доступного остатка и движения средств – это интернет-банкинг.  А если есть телефон с современной операционной системой, то можно установить специальное приложение и управлять счетом с любого места, где есть интернет.<br>Как воспользоваться интернет приложением:<ol><li>Пройти процедуру регистрации:</li><li>В адресной строке браузера прописываете tcsbank.ru, после загрузки нажимаете кнопку “войти”;</li><li>Вводите номер телефона, что указан при получении карты;</li><li>Получаете логин и пароль, в дальнейшем его можно изменить.</li><li>На главной странице сайта выбираете сервис mybank и вводите данные для входа</li></ol>После регистрации на сайте Вам доступна вся история операций по счетам, также есть возможность совершать платежи.<br><br>В настройках интернет-банкинга можно выбрать функцию – рассылка на электронную почту. Указавши свою почту, ежемесячно вы будете получать сообщения, где можете посмотреть выписку по счету. Также эту услугу можно оформить в процессе звонка на горячую линию.', '', '', 'Как узнать баланс Тинькофф карты', 'Ввиду отсутствия стационарных пунктов обслуживания, в Тинькофф банка на высоком уровне развиты мобильные и интернет сервисы. Для того чтобы контролировать затраты и не пропустить обязательный платеж, клиент должен быть проинформирован, как узнать баланс карты Тинькофф через интернет по номеру', 'интернет, можно, Тинькофф, карты, банка, банкинг, почту, баланс, Проверка, через, электронную, линию, горячую, платеж, регистрации, номеру, чтобы, средств, движения, кнопку', '2', 'kak-uznat-balans-tinkoff-karty', 0, 1, 1, 1, 0, 0, '', '', 'Как узнать баланс Тинькофф карты'),
(25, 'redaktor', '2018-11-09 15:30:33', '<img src=\\\"http://site1.radimid.ru/uploads/posts/2018-11/1541766636_1kartinka.jpg\\\" alt=\\\"\\\" class=\\\"fr-dib\\\"><br>Как было сказано ранее, Сбербанк предлагает несколько способов проверки лицевого счета карты. На данный момент доступно 4 способа проверки баланса: «Мобильный банк»; «Онлайн-банкинг»; банкоматы; Контактный центр. Для использования первых двух вариантов придется предварительно активировать упомянутые услуги. Перед активацией услуги «Мобильный банк» нужно учесть, что сервис имеет два тарифных пакета — Полный и Экономный, которые отличаются между собой наличием абонентской платы. Чтобы активировать сервис «Сбербанк Онлайн», нужно получить персональный идентификатор для входа с систему. <br><br>Данные сервисы обладают широким функционалом и предоставляют клиентам возможность осуществлять денежные переводы, оплачивать услуги различных организаций, создавать автоплатежи и т.д.<br><br><h2>Баланс карты в Личном кабинете «Сбербанк Онлайн»</h2>Для регистрации в Личном кабинете Сбербанка, рекомендуется позвонить в Контактный Центр Сбербанка, либо обратиться в банковское отделение. Это необходимо для получения логина, идентификатора и пароля. Также можно осуществить самостоятельную регистрацию в сервисе, в том случае если на карте Сбербанка активирована услуга «Мобильный банк». Для этого нужно перейти на официальную страницу регистрации и ввести номер действующей карты Сбербанка. После этого на телефон поступит SMS-пароль, который нужно ввести в отдельное окно, а также придумать логин и пароль для постоянного входа в систему. После завершения регистрации клиенту будет доступен вход в Онлайн-банк.<br><br>При повторном посещении достаточно ввести в соответствующие графы логин и пароль, а также одноразовый СМС-код, полученный от Сбербанка.Имея в распоряжении доступ к Личному кабинету, для пользователя будет открыт дистанционный контроль баланс банковской карты. <br><br>Выбрав опцию «Все операции», можно проследить расход средств по карте, переводимые суммы и даты поступлений. Таким образом можно выявить постороннее вмешательство. Главное меню «Сбербанк Онлайн» отображает все существующие карты и счета. В правой части от наименования карты будет размещена основная информация.', '', '', 'Как узнать баланс карты Сбербанка', 'Как было сказано ранее, Сбербанк предлагает несколько способов проверки лицевого счета карты. На данный момент доступно 4 способа проверки баланса: «Мобильный банк»; «Онлайн-банкинг»; банкоматы; Контактный центр. Для использования первых двух вариантов придется предварительно активировать', 'карты, Сбербанка, нужно, будет, банк», ввести, услуги, пароль, регистрации, «Мобильный, можно, «Сбербанк, кабинете, карте, Онлайн», логин, проверки, После, входа, сервис', '2', 'kak-uznat-balans-karty-sberbanka', 0, 1, 1, 1, 0, 0, '', '', 'Как узнать баланс карты Сбербанка'),
(26, 'redaktor', '2018-11-08 15:32:56', '<img src=\\\"http://site1.radimid.ru/uploads/posts/2018-11/1541766817_1kartinka.jpg\\\" alt=\\\"\\\" class=\\\"fr-dib\\\"><br>Определить величину остатка на карточке клиента можно несколькими способами. Большинство из них являются дистанционными, что упрощает процесс получения интересующей информации в онлайн-режиме. Таким образом узнать размер баланса можно в любом месте в удобное время.<br><br>Существует 4 основных способа определения остатка средств на карте:<br><ul><li>при помощи оператора call-центра;</li><li>через мобильный или интернет-банкинг;</li><li>с помощью опции «Альфа-Чек»;</li><li>через банкоматы.</li></ul><div class=\\\"quote\\\">Если запрос баланса осуществляется через терминал или банкомат партнёров банка, с клиента может быть взыскан определённый сбор, величина которого зависит от финансовой организации. В остальных случаях, как правило, оплаты сбора за предоставление нужных данных не требуется.</div><br><h2>Через СМС</h2>Опция «Альфа-Чек» позволяет собственнику счёта отслеживать любые совершаемые с ним операции в онлайн-режиме с помощью присылаемых на актуальный мобильный номер уведомлений.<br><br>Чтобы посредством СМС проверить баланс карты от Альфа-Банка, нужно послать текст «баланс» на один из указанных телефонных номеров:<br><ul><li>2265;</li><li>8-903-767-22-65.</li></ul>Владельцы карт, подключенные к пакету услуг «Комфорт», «Максимум», «Оптимум» либо «Максимум+», могут использовать услугу бесплатно. Остальные клиенты должны ежемесячно оплачивать 79 рублей за данную опцию (за первые 30 дней плата не взимается).<br>Если сервис активирован на кредитке или корпоративной карточке, величина сбора, взимаемого с клиента ежемесячно, составляет 59 рублей.', '', '', 'Как посмотреть баланс карты Альфа банк', 'Определить величину остатка на карточке клиента можно несколькими способами. Большинство из них являются дистанционными, что упрощает процесс получения интересующей информации в онлайн-режиме. Таким образом узнать размер баланса можно в любом месте в удобное время.  Существует 4 основных способа', 'клиента, через, ежемесячно, баланса, помощью, онлайн, рублей, сбора, «Альфа, можно, карточке, величина, мобильный, режиме, остатка, Альфа, карты, текст, указанных, телефонных', '2', 'kak-posmotret-balans-karty-alfa-bank', 0, 1, 1, 1, 0, 0, '', '', 'Как посмотреть баланс карты Альфа банк'),
(27, 'redaktor', '2018-11-09 15:35:38', '<img src=\\\"http://site1.radimid.ru/uploads/posts/2018-11/1541767020_1kartinka.jpg\\\" alt=\\\"\\\" class=\\\"fr-dib\\\"><br>Как погасить кредитную карту? Далеко не каждый человек может это сделать правильно. Чаще всего карту начинают воспринимать как наказание, хотя это отличный финансовый инструмент. А все потому что люди не знают, как погасить кредитную карту правильно.<br>Есть несколько способов, которые помогут это сделать грамотно.<br><br><h2>Первый способ: минимальные платежи</h2>Самый простой способ, как погасить кредитную карту, — это постоянное внесение минимальных платежей. Безусловно, это действенный метод, но он довольно долгий. Все потому что банк рассчитывает график платежей так, чтобы он растянулся на срок всего договора. Еще одним важным моментом является то, что если гасить долг минимальными платежами, то снимать деньги в этом случае нельзя. Иначе смысла в таком погашении нет.<br><br><h2>Второй способ: полное погашение</h2>Одним из самых простых способов для погашения кредитки является внесение всей суммы долга. К его плюсам можно отнести возможность закрыть карту быстро и пользоваться ею в случае необходимости в будущем.<br><br>Проблема в том, что гасить долг подобным образом могут не все просто ввиду отсутствия свободных средств в таком количестве. Но не стоит отчаиваться, потому что есть еще несколько вариантов, как погасить кредитную карту.<br><br><h2>Третий способ: увеличенные платежи</h2>Если желание избавиться от кредитной карты появилось, а вот денег на полное погашение долга не хватает, то все дальнейшие действия следует хорошо продумать.<br><br>Сначала нужно прийти в банк, который выдал кредитную карту, и узнать там размер платежа для закрытия долга. Кроме того, важно узнать и то, какие проценты начисляются на долг каждый месяц.', '', '', 'Как погасить кредитную карту', 'Как погасить кредитную карту? Далеко не каждый человек может это сделать правильно. Чаще всего карту начинают воспринимать как наказание, хотя это отличный финансовый инструмент. А все потому что люди не знают, как погасить кредитную карту правильно. Есть несколько способов, которые помогут это', 'карту, кредитную, способ, погасить, потому, долга, платежей, узнать, несколько, каждый, способов, гасить, является, сделать, случае, внесение, правильно, всего, полное, таком', '3', 'kak-pogasit-kreditnuju-kartu', 1, 1, 1, 1, 0, 0, '', '', 'Как погасить кредитную карту'),
(28, 'redaktor', '2018-11-07 15:37:09', '<img src=\\\"http://site1.radimid.ru/uploads/posts/2018-11/1541767207_1kartinka.jpg\\\" alt=\\\"\\\" class=\\\"fr-dib\\\"><br>Невыплата кредита не является столь тяжким преступлением, как кажется первоначально. Основные проблемы или последствия при невыплате кредита для неплательщика можно назвать по убыванию:<br>Потеря ипотечной квартиры или предмета покупки, коллекторы, плохая кредитная история, испорченные отношения с родственниками и поручителем по кредиту.<br><br>Если у вас нет денег для выплаты кредита, это не значит, что у вас нет прав.  Рассмотрим первую и самую реальную опасность — потерю той вещи, которую вы купили в кредит. Это может быть как авто, так и ипотечная квартира.<br><br><h2>Если это ипотека, квартиру можно потерять</h2>Когда вы перестаете платить ипотеку банку, то банк начинает реализовывать свои права требования на вашу квартиру. При оформлении ипотечного договора банк должен получить вашу квартиру в залог. Если у вас долевка — залог права требования по договору долевого участия. При вступлении в собственность мы также закладываем квартиру банку и имеем квартиру в собственности банка до полной выплаты кредита.  Если у вас денежные трудности, рекомендую обратиться  в банк и попросить отсрочку. Другой вариант — перекредитоваться в другом банке под меньший процент или на больший срок. Больший срок — меньший ежемесячный платеж.  Это поможет уменьшить долговую нагрузку и возможно избежать просрочки.<br><br>Ну а что делать, если все таки платить нечем. Нужно заявить об этом банку. Ваше молчание — потерянные деньги и банка и ваши. Квартира принадлежит банку и она будет выставлена на продажу. Банк попытается продать квартиру по меньшей цене — ему важно покрыть остаток долга на дату просрочки. Тут советуем принимать участие в продаже и попытаться все-таки самому реализовать квартиру по рыночной цене. Когда ипотечная квартира будет продана, залог будет снят. Банк заберет себе деньги для покрытия долга(сумму к полному досрочному погашению). Оставшаяся сумма окажется у вас.<br><br><h2>К вам придут коллекторы</h2>Коллекторы — это люди, которые занимаются возвратом денег банка. Это может быть внутрення служба банка или же банк может продать ваш долг в специальное коллекторское агенство. Сейчас не разрешаются звонки от коллекторов поздно ночью по закону. Законодательство в этой сфере скорректировано. Однако сообщения в соц. сетях, звонки с требованием возврата долга — этого не избежать.<br>Банк подаст на вас в суд и вскоре судебные приставы придут описывать ваше имущество.<br><br>Запомните — <b>деньги все равно придется отдать</b>. Никто просто так про свои деньги не забудет. Нередки случаи нечестной игры коллекторов, которые звонят ночью, угрожают. Нередки звонки вашим родственниками и на работу. Эти люди знают свое дело, где и как вас найти. Лучше не связываться и зараннее позаботиться о погашении кредита. Тут занять у родственников — один из вариантов. Поверьте ваши нервы не выдержат постоянного противостояния с коллекторами. Особенно если вы больны или у вас дети.', '', '', 'Как быстро погасить кредит в банке?', 'Невыплата кредита не является столь тяжким преступлением, как кажется первоначально. Основные проблемы или последствия при невыплате кредита для неплательщика можно назвать по убыванию: Потеря ипотечной квартиры или предмета покупки, коллекторы, плохая кредитная история, испорченные отношения с', 'квартиру, кредита, банку, банка, залог, может, звонки, деньги, будет, долга, платить, квартира, продать, Нередки, денег, выплаты, ипотечная, права, которые, придут', '5', 'kak-bystro-pogasit-kredit-v-banke', 0, 1, 1, 1, 0, 0, '', '', ''),
(29, 'redaktor', '2018-11-09 13:00:50', '<p align=\\\"left\\\">Котировки нефти Brent ускорили снижение в пятницу. В ходе торгов они падали ниже $70 впервые с начала апреля. Январские фьючерсы на Brent на лондонской бирже ICE Futures к 13.15 мск подешевели на $0,85 до $69,80 за баррель. Стоимость фьючерса на WTI на декабрь на электронной сессии на Нью-Йоркской товарной бирже (NYMEX) к 13.25 мск упала ниже $60 за баррель ($59,92).</p><br><p>С начала недели нефть Brent подешевела на 3,9%, WTI – на 4,7%. Цены на оба сорта нефти снижаются пятую неделю подряд.</p><p>Цена нефти Brent падает с начала октября, когда она превышала $86 за баррель. В эти выходные представители стран ОПЕК и России соберутся, чтобы обсудить ситуацию на рынке. «Учитывая падение цен в последнее время и вероятность образования избытка предложения в следующем году, ОПЕК думает над сокращением добычи», – отмечают в отчете аналитики Commerzbank.</p><br><p>Однако Financial Times на этой неделе написала, что Россия готовится увеличить добычу к началу следующего года на 300 000 баррелей в день, если не будет достигнута новая договоренность с Саудовской Аравией об ограничении добычи. Помимо этого рынок ожидает, что снижение поставок нефти из Ирана будет меньше прогноза: власти США сделали исключение для восьми стран и позволили им временно закупать иранскую нефть после вступления в силу санкций против страны.</p>', '', '', 'Котировки нефти Brent упали ниже $70 впервые с апреля', 'Котировки нефти Brent ускорили снижение в пятницу. В ходе торгов они падали ниже 70 впервые с начала апреля. Январские фьючерсы на Brent на лондонской бирже ICE Futures к 13.15 мск подешевели на 0,85 до 69,80 за баррель. Стоимость фьючерса на WTI на декабрь на электронной сессии на Нью-Йоркской', 'нефти, Brent, начала, баррель, бирже, стран, будет, снижение, нефть, новая, договоренность, увеличить, добычу, началу, готовится, баррелей, следующего, достигнута, неделе, отчете', '1', 'kotirovki-nefti-brent-upali-nizhe-70-vpervye-s-aprelja', 0, 1, 1, 1, 0, 0, '', '', 'Котировки нефти Brent упали ниже 70 впервые с апреля'),
(30, 'redaktor', '2018-11-09 15:42:14', 'Государство в скором времени может получить право узнавать все детали сделок по купле-продаже недвижимости, пишет «Коммерсантъ» со ссылкой на внесенный в Госдуму законопроект. Это затруднит жизнь тем, кто пытается скрыть реальную сумму сделки и не платить налоги с нее.<br><br>В документе перечислены ситуации, при которых банки и риелторы обязаны информировать Росфинмониторинг о совершенной сделке. В частности, кредитные организации будут сообщать о сделках на сумму более трех миллионов рублей. От них потребуется информация не только о факте перечисления денег от покупателя продавцу, но и о движении средств до и после непосредственной продажи.<br><br>Так, если покупатель зачислил необходимую для оплаты квартиры или дома сумму незадолго до сделки, банк сообщит об этом в Росфинмониторинг. Отдельно будут указываться случаи, при которых оплата совершается наличными. Сделки на сумму менее трех миллионов перейдут в сферу ответственности риелторов.<br><br>Законопроект принимается в целях ужесточения борьбы с отмыванием денег, однако главный удар, как полагают опрошенные изданием эксперты, он нанесет по тем продавцам недвижимости, которые пытаются уйти от налогов. В настоящее время закон позволяет не платить 13-процентный НДФЛ, если недвижимость находилась в собственности продавца более пяти лет. В противном случае он получит только вычет в размере миллиона рублей.<br><br>Нередки случаи, когда в официальных документах указывается заниженная цена за квартиру или дом, отмечает «Коммерсантъ». Как правило, оплата производится наличными. Теперь же налоговики, традиционно сотрудничающие с Росфинмониторингом, смогут узнавать об этом из информации, переданной банками.<br><br>', '', '', 'Продающих жилье россиян заставят платить налоги', 'Государство в скором времени может получить право узнавать все детали сделок по купле-продаже недвижимости, пишет «Коммерсантъ» со ссылкой на внесенный в Госдуму законопроект. Это затруднит жизнь тем, кто пытается скрыть реальную сумму сделки и не платить налоги с нее.  В документе перечислены', 'сумму, только, «Коммерсантъ», сделки, которых, денег, платить, будут, рублей, недвижимости, оплата, случаи, более, узнавать, наличными, миллионов, нанесет, эксперты, время, настоящее', '1', 'prodajuschih-zhile-rossijan-zastavjat-platit-nalogi', 0, 1, 1, 1, 0, 0, '', '', 'Продающих жилье россиян заставят платить налоги'),
(31, 'redaktor', '2018-11-08 15:42:33', 'Торжественная церемония награждения состоится 19 ноября. Награду вручит посол Франции в России Сильви Берманн.<br><br>«Я благодарен президенту Франции Эммануэлю Макрону за проявленное внимание и столь высокую оценку вклада РФПИ в укрепление двусторонних отношений между Россией и Францией. Эта награда является отражением прогресса в инвестиционном сотрудничестве, которого нам удалось достигнуть за последние годы, а также стимулом к дальнейшей активной работе», — сказал Дмитриев.<br><br>По его словам, в рамках Российско-французской инвестиционной платформы, созданной совместно с CDC International Capital, РФПИ намерен увеличить объём инвестиций в четыре раза в ближайшие пять лет.<br><br>Как отметил глава фонда, это позволит существенно превысить результат начала 2018 года, когда максимальный объём накопленных французских прямых инвестиций в России составил $16,3 млрд.<br><br>Орден Почётного легиона — старейший французский национальный орден, учреждённый Наполеоном Бонапартом в 1802 году.<br><br>', '', '', 'Макрон присвоил главе РФПИ звание кавалера ордена Почётного легиона', 'Торжественная церемония награждения состоится 19 ноября. Награду вручит посол Франции в России Сильви Берманн.  «Я благодарен президенту Франции Эммануэлю Макрону за проявленное внимание и столь высокую оценку вклада РФПИ в укрепление двусторонних отношений между Россией и Францией. Эта награда', 'России, инвестиций, объём, Франции, увеличить, в четыре, ближайшие, позволит, фонда, глава, отметил, намерен, International, французской, Российско, в рамках, инвестиционной, платформы, существенно, совместно', '1', 'makron-prisvoil-glave-rfpi-zvanie-kavalera-ordena-pochetnogo-legiona', 0, 1, 1, 1, 0, 0, '', '', ''),
(32, 'redaktor', '2018-11-09 15:43:49', 'Новые поправки в закон «О защите конкуренции» заработают к 1 января 2020 года, рассказал глава ФАС Игорь Артемьев в интервью телеканалу РБК. Он отметил, что сроки принятия поправок зависят от позиций Госдумы и депутатов, а также отношения политических партий к законопроекту. «Мы традиционно в Государственной думе чувствуем поддержку депутатов», — указал Артемьев.<br><br>По его словам, поправки поддерживает большинство рыночных структур, работающих в ИT-сфере. Если правительство окончательно одобрит законопроект, он будет закончен к весне 2019 года, пояснил глава ФАС. «Как обычно, для сложных законов дается не меньше трех месяцев, а то и полугода переходного периода до вступления его в силу. То есть, полноценно, я думаю, что к 1 января 2020 года он заработает и будет приносить свое благо», — прогнозирует он.<br><br>ФАС представила пятый антимонопольный пакет в начале года. Поправки направлены на регулирование новых цифровых рынков. Законопроект предполагает возможность отнести к доминирующим субъектам владельцев крупных инфраструктурных, а также интернет-платформ; предлагает обеспечить недискриминационный доступ к большим данным; антимонопольное регулирование можно будет распространять на результаты интеллектуальной деятельности (произведения науки, литературы, программы, базы данных, изобретения, товарные знаки и др.) и ряд других нововведений.<br><br>Весной 2018 года против законопроекта выступил интернет-холдинг Mail.Ru Group. Его гендиректор Борис Добродеев написал письмо премьер-министру России Дмитрию Медведеву, в котором указал, что поправки продвигают интересы «отдельной незначительной части интернет-бизнеса» и помешают развитию в России компаний в области интернет-коммуникаций, которые будут конкурентоспособны на мировом рынке. В октябре 2018 года пятый антимонопольный пакет получил отрицательный отзыв от Минэкономразвития. Ведомство посчитало предложенные поправки недостаточно обоснованными. В отзыве отмечалось, что проект содержит избыточные обязанности, запреты и ограничения для физических и юридических лиц. По мнению министерства, введение поправок в представленном виде привело бы к возникновению необоснованных расходов со стороны предпринимателей и из бюджета страны.', '', '', 'Глава ФАС назвал сроки принятия новых мер по регулированию Рунета', 'Новые поправки в закон «О защите конкуренции» заработают к 1 января 2020 года, рассказал глава ФАС Игорь Артемьев в интервью телеканалу РБК. Он отметил, что сроки принятия поправок зависят от позиций Госдумы и депутатов, а также отношения политических партий к законопроекту. «Мы традиционно в', 'интернет, поправки, будет, пятый, Артемьев, также, России, поправок, антимонопольный, глава, указал, регулирование, января, пакет, Добродеев, написал, премьер, письмо, Медведеву, «отдельной', '1', 'glava-fas-nazval-sroki-prinjatija-novyh-mer-po-regulirovaniju-runeta', 0, 1, 1, 1, 0, 0, '', '', ''),
(33, 'redaktor', '2018-11-09 15:44:45', '<b>МОСКВА, 9 ноя — РИА Недвижимость.</b> На устойчивый снос аварийного жилого фонда в России планируется выйти в 2023 году, заявил в пятницу министр строительства и жилищно-коммунального хозяйства РФ Владимир Якушев.<br><br>В 2023 году мы выйдем на устойчивый снос аварийного фонда. Что значит устойчивый? На учёт аварийного фонда должно ставиться меньше, чем его нужно сносить\\\", — сказал Якушев.<br><br>Он также сообщил, что за время реализации национального проекта \\\"Жилье и городская среда\\\" с учётом прогнозов, аварийным могут признать ещё порядка 12 миллионов квадратных метров жилья.<br><br>Якушев напомнил, что с учётом согласованного с Минфином графика финансирования проекта, за 2019-2024 годы планируется переселить из аварийных домов около 530,9 тысячи граждан. На реализацию проекта планируется направить 500 миллиардов рублей, в том числе 432 миллиарда рублей из федерального бюджета, 68 миллиардов рублей — из региональных.<br><br>\\\"С учётом специфики строительного цикла, мы поймаем ещё хвост этой программы в 2025 году\\\", — уточнил министр.', '', '', 'Минстрой: на устойчивый снос аварийного жилья в РФ выйдут в 2023 году', 'МОСКВА, 9 ноя — РИА Недвижимость. На устойчивый снос аварийного жилого фонда в России планируется выйти в 2023 году, заявил в пятницу министр строительства и жилищно-коммунального хозяйства РФ Владимир Якушев.  В 2023 году мы выйдем на устойчивый снос аварийного фонда. Что значит устойчивый? На', 'аварийного, планируется, фонда, проекта, Якушев, министр, с учётом, рублей, миллиардов, устойчивый, из аварийных, тысячи, граждан, переселить, около 530, домов, графика, жилья, метров, квадратных', '1', 'minstroj-na-ustojchivyj-snos-avarijnogo-zhilja-v-rf-vyjdut-v-2023-godu', 0, 1, 1, 1, 0, 0, '', '', ''),
(34, 'redaktor', '2018-11-09 15:45:19', 'Сбербанк пока не решил, что делать с головным офисом на улице Вавилова в Москве. \\\"Сейчас об этом говорить рано. Ремонт на Кульнева, 32 займет значительное время, в течение которого мы определим наилучший способ использования комплекса зданий на Вавилова, 19\\\", — сообщили \\\"Интерфаксу\\\" в пресс-службе банка.<br><br>\\\"Переезд в новый комплекс будет осуществляться поэтапно. Полное заселение планируется к концу 2021 года\\\", — отмечается в сообщении.<br><br>Сбербанк задумался о переезде с целью повышения эффективности управления бизнесом, банк реализует целенаправленную программу оптимизации портфеля недвижимости во всех регионах присутствия. Эта программа направлена на снижение операционных издержек, улучшение условий работы для сотрудников, сокращение времени на переезды между разными офисами.<br><br>В рамках этой программы принято решение об объединении ключевых подразделений штаб-квартиры Сбербанка на единой площадке. В этой связи дочерняя компания Сбербанка и АО \\\"Международный центр\\\" подписали договор купли-продажи офисного комплекса площадью более 300 тыс. кв. м, расположенного на улице Кульнева, напротив \\\"Москва-Сити\\\". Комплекс состоит из трех зданий на едином земельном участке, при этом две башни (41 и 47 этажей) являются объектами незавершенного строительства.<br><br>Банк отмечает, что сейчас сотрудники группы размещены более чем в 40 офисных объектах (как собственных, так и арендованных) на территории Москвы. Новый проект позволит снизить операционные затраты на содержание недвижимости, высвободив более 100 тыс. кв. м площадей, существенно снизить расходы на логистику. Банк разработал детальные стратегии по высвобождаемой недвижимости, включая возможную реализацию объектов, находящихся у банка на праве собственности, отказ от аренды, сдачу в аренду на открытом рынке.<br>\\\"Выбор в пользу комплекса на улице Кульнева объясняется удобной позицией с развитой инфраструктурой, выгодными ценовыми условиями и качественными характеристиками объекта, хорошей транспортной доступностью, а также наличием в собственности группы Сбербанк современного офиса Agile Home в близлежащем здании по адресу: Кутузовский проспект, 32\\\", — отмечает кредитная организация.<br><br>\\\"Консолидация команды банка на одной площадке также полностью отвечает задаче по созданию экосистемы Сбербанка. Приобретение зданий комплекса с учетом уже используемых бизнес-центров \\\"Президент Плаза\\\" и \\\"Поклонка Плейс\\\" позволит нам создать единую штаб-квартиру — так называемый Сбербанк-Сити — более чем для 23 тыс. наших сотрудников\\\", — приводятся слова зампреда правления Сбербанка Станислава Кузнецова в сообщении.<br><br>', '', '', 'Сбербанк переедет в головной офис напротив «Москва-Сити» в 2021 году', 'Сбербанк пока не решил, что делать с головным офисом на улице Вавилова в Москве. Сейчас об этом говорить рано. Ремонт на Кульнева, 32 займет значительное время, в течение которого мы определим наилучший способ использования комплекса зданий на Вавилова, 19, — сообщили Интерфаксу в пресс-службе', 'Сбербанк, комплекса, Сбербанка, более, недвижимости, Кульнева, зданий, улице, банка, сообщении, площадке, собственности, также, позволит, снизить, Вавилова, группы, сотрудников, отмечает, находящихся', '1', 'sberbank-pereedet-v-golovnoj-ofis-naprotiv-moskva-siti-v-2021-godu', 0, 1, 1, 1, 0, 0, '', '', ''),
(36, 'redaktor', '2019-12-10 22:02:09', '<p><span><img src=\\\"http://site1.radimid.ru/uploads/posts/2019-12/1576091117_images.jpg\\\" alt=\\\"\\\" style=\\\"display:block;margin-left:auto;margin-right:auto;\\\"></span></p>\n<p><span>В честь всемирного дня борьбы с бронхиальной астмой подмосковные врачи рассказали жителям региона о том, как распознать первичные признаки болезни и чем можно помочь человеку с приступом удушья. Об этом РИА LIVE24 сообщили в пресс-службе министерства здравоохранения Подмосковья.</span></p>\n<p><span>По словам врача-пульмонолога Королевской городской больницы Татьяны Кунафиной, для начала нужно обратить внимание на первичные симптомы. Если человек начал упорно кашлять, часто испытывать дискомфорт в дыхании и чувствовать сдавливания в области грудной клетки – все это верные признаки бронхиальной астмы. </span></p>\n<p><span>Симптомы усиливаются при физической нагрузке, а также при контакте с пылью, резкими запахами и домашними животными, например кошками или собаками, а точнее с их шерстью, пояснила Кунафина. </span></p>\n<p><span>Она добавила, что астма в первую очередь опасна своими обострениями. В эти периоды симптомы усиливаются почти в два раза, что сильно затрудняет повседневную активность пациента. В случае обострения необходимо срочно начинать ингаляции через небулайзер с препаратами, которые прописаны лечащим врачом. Если же это не помогает, то нужно вызывать бригаду скорой медицинской помощи, заключила Кунафина.</span><br><br></p>', '', '', 'Кредит на авто как оформить и не статься без машины', 'В честь всемирного дня борьбы с бронхиальной астмой подмосковные врачи рассказали жителям региона о том, как распознать первичные признаки болезни и чем можно помочь человеку с приступом удушья. Об этом РИА LIVE24 сообщили в пресс-службе министерства здравоохранения Подмосковья.По словам', 'усиливаются, бронхиальной, нужно, симптомы, первичные, признаки, Кунафина, честь, пояснила, своими, опасна, очередь, первую, астма, добавила, собаками, шерстью, точнее, периоды, кошками', '4', 'kredit-na-avto-kak-oformit-i-ne-statsja-bez-mashiny', 0, 1, 1, 1, 0, 0, '', '', ''),
(37, 'redaktor', '2019-12-11 22:07:34', '<p><span><img src=\\\"http://site1.radimid.ru/uploads/posts/2019-12/1576091263_images.jpg\\\" alt=\\\"\\\" style=\\\"display:block;margin-left:auto;margin-right:auto;\\\"></span><span>В честь всемирного дня борьбы с бронхиальной астмой подмосковные врачи рассказали жителям региона о том, как распознать первичные признаки болезни и чем можно помочь человеку с приступом удушья. Об этом РИА LIVE24 сообщили в пресс-службе министерства здравоохранения Подмосковья.</span></p>\n<p><span>По словам врача-пульмонолога Королевской городской больницы Татьяны Кунафиной, для начала нужно обратить внимание на первичные симптомы. Если человек начал упорно кашлять, часто испытывать дискомфорт в дыхании и чувствовать сдавливания в области грудной клетки – все это верные признаки бронхиальной астмы.</span></p>\n<p><span>Симптомы усиливаются при физической нагрузке, а также при контакте с пылью, резкими запахами и домашними животными, например кошками или собаками, а точнее с их шерстью, пояснила Кунафина.</span></p>\n<p><span>Она добавила, что астма в первую очередь опасна своими обострениями. В эти периоды симптомы усиливаются почти в два раза, что сильно затрудняет повседневную активность пациента. В случае обострения необходимо срочно начинать ингаляции через небулайзер с препаратами, которые прописаны лечащим врачом. Если же это не помогает, то нужно вызывать бригаду скорой медицинской помощи, заключила Кунафина.</span></p>', '', '', 'Где восстановить доступ к телефону если он потерян', 'В честь всемирного дня борьбы с бронхиальной астмой подмосковные врачи рассказали жителям региона о том, как распознать первичные признаки болезни и чем можно помочь человеку с приступом удушья. Об этом РИА LIVE24 сообщили в пресс-службе министерства здравоохранения Подмосковья.По словам', 'усиливаются, бронхиальной, нужно, симптомы, первичные, признаки, Кунафина, честь, пояснила, своими, опасна, очередь, первую, астма, добавила, собаками, шерстью, точнее, периоды, кошками', '2', 'gde-vosstanovit-dostup-k-telefonu-esli-on-poterjan', 0, 1, 1, 1, 0, 0, '', '', ''),
(38, 'redaktor', '2019-12-06 22:09:09', '<p><img src=\\\"http://site1.radimid.ru/uploads/posts/2019-12/1576091384_images.jpg\\\" alt=\\\"\\\" style=\\\"display:block;margin-left:auto;margin-right:auto;\\\"></p>\n<p><span>В честь всемирного дня борьбы с бронхиальной астмой подмосковные врачи рассказали жителям региона о том, как распознать первичные признаки болезни и чем можно помочь человеку с приступом удушья. Об этом РИА LIVE24 сообщили в пресс-службе министерства здравоохранения Подмосковья.</span></p>\n<p><span>По словам врача-пульмонолога Королевской городской больницы Татьяны Кунафиной, для начала нужно обратить внимание на первичные симптомы. Если человек начал упорно кашлять, часто испытывать дискомфорт в дыхании и чувствовать сдавливания в области грудной клетки – все это верные признаки бронхиальной астмы.</span></p>\n<p><span>Симптомы усиливаются при физической нагрузке, а также при контакте с пылью, резкими запахами и домашними животными, например кошками или собаками, а точнее с их шерстью, пояснила Кунафина.</span></p>\n<p><span>Она добавила, что астма в первую очередь опасна своими обострениями. В эти периоды симптомы усиливаются почти в два раза, что сильно затрудняет повседневную активность пациента. В случае обострения необходимо срочно начинать ингаляции через небулайзер с препаратами, которые прописаны лечащим врачом. Если же это не помогает, то нужно вызывать бригаду скорой медицинской помощи, заключила Кунафина.</span></p>', '', '', 'Зачем брать деньги на отпуск в кредит?', 'В честь всемирного дня борьбы с бронхиальной астмой подмосковные врачи рассказали жителям региона о том, как распознать первичные признаки болезни и чем можно помочь человеку с приступом удушья. Об этом РИА LIVE24 сообщили в пресс-службе министерства здравоохранения Подмосковья.По словам', 'усиливаются, бронхиальной, нужно, симптомы, первичные, признаки, Кунафина, честь, пояснила, своими, опасна, очередь, первую, астма, добавила, собаками, шерстью, точнее, периоды, кошками', '2', 'zachem-brat-dengi-na-otpusk-v-kredit', 0, 1, 1, 1, 0, 0, '', '', '');

-- --------------------------------------------------------

--
-- Структура таблицы `dle_post_extras`
--

CREATE TABLE `dle_post_extras` (
  `eid` int(11) NOT NULL,
  `news_id` int(11) NOT NULL DEFAULT '0',
  `news_read` int(11) NOT NULL DEFAULT '0',
  `allow_rate` tinyint(1) NOT NULL DEFAULT '1',
  `rating` int(11) NOT NULL DEFAULT '0',
  `vote_num` int(11) NOT NULL DEFAULT '0',
  `votes` tinyint(1) NOT NULL DEFAULT '0',
  `view_edit` tinyint(1) NOT NULL DEFAULT '0',
  `disable_index` tinyint(1) NOT NULL DEFAULT '0',
  `related_ids` varchar(255) NOT NULL DEFAULT '',
  `access` varchar(150) NOT NULL DEFAULT '',
  `editdate` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `editor` varchar(40) NOT NULL DEFAULT '',
  `reason` varchar(255) NOT NULL DEFAULT '',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `disable_search` tinyint(1) NOT NULL DEFAULT '0',
  `need_pass` tinyint(1) NOT NULL DEFAULT '0',
  `allow_rss` tinyint(1) NOT NULL DEFAULT '1',
  `allow_rss_turbo` tinyint(1) NOT NULL DEFAULT '1',
  `allow_rss_dzen` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `dle_post_extras`
--

INSERT INTO `dle_post_extras` (`eid`, `news_id`, `news_read`, `allow_rate`, `rating`, `vote_num`, `votes`, `view_edit`, `disable_index`, `related_ids`, `access`, `editdate`, `editor`, `reason`, `user_id`, `disable_search`, `need_pass`, `allow_rss`, `allow_rss_turbo`, `allow_rss_dzen`) VALUES
(24, 24, 11, 1, 0, 0, 0, 0, 0, '26,27,28,25', '', 1541766494, 'redaktor', '', 1, 0, 0, 1, 1, 1),
(25, 25, 11, 1, 0, 0, 0, 0, 0, '24', '', 0, '', '', 1, 0, 0, 1, 1, 1),
(26, 26, 6, 1, 0, 0, 0, 0, 0, '24,25', '', 0, '', '', 1, 0, 0, 1, 1, 1),
(27, 27, 76, 1, 0, 0, 0, 0, 0, '24,25,26,28', '', 0, '', '', 1, 0, 0, 1, 1, 1),
(28, 28, 15, 1, 0, 0, 0, 0, 0, '27,24,25,26', '', 0, '', '', 1, 0, 0, 1, 1, 1),
(29, 29, 12, 1, 0, 0, 0, 0, 0, '28,33,34,31', '', 0, '', '', 1, 0, 0, 1, 1, 1),
(30, 30, 3, 1, 0, 0, 0, 0, 0, '28,34,32,33', '', 0, '', '', 1, 0, 0, 1, 1, 1),
(31, 31, 6, 1, 0, 0, 0, 0, 0, '32,34,33,29', '', 0, '', '', 1, 0, 0, 1, 1, 1),
(32, 32, 5, 1, 0, 0, 0, 0, 0, '30,28,29,31', '', 0, '', '', 1, 0, 0, 1, 1, 1),
(33, 33, 5, 1, 0, 0, 0, 0, 0, '31,34,30,26', '', 0, '', '', 1, 0, 0, 1, 1, 1),
(34, 34, 23, 1, 0, 0, 0, 0, 0, '24,25,26,27', '', 0, '', '', 1, 0, 0, 1, 1, 1),
(36, 36, 6, 1, 0, 0, 0, 0, 0, '31,28,34,32', '', 0, '', '', 1, 0, 0, 1, 1, 1),
(37, 37, 12, 1, 0, 0, 0, 0, 0, '36,31,32,34', '', 0, '', '', 1, 0, 0, 1, 1, 1),
(38, 38, 6, 1, 0, 0, 0, 0, 0, '36,37,31,28', '', 0, '', '', 1, 0, 0, 1, 1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `dle_post_extras_cats`
--

CREATE TABLE `dle_post_extras_cats` (
  `id` int(11) NOT NULL,
  `news_id` int(11) NOT NULL DEFAULT '0',
  `cat_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `dle_post_extras_cats`
--

INSERT INTO `dle_post_extras_cats` (`id`, `news_id`, `cat_id`) VALUES
(12, 24, 2),
(14, 25, 2),
(13, 26, 2),
(4, 27, 3),
(5, 28, 5),
(6, 29, 1),
(7, 30, 1),
(8, 31, 1),
(9, 32, 1),
(10, 33, 1),
(11, 34, 1),
(15, 36, 4),
(16, 37, 2),
(17, 38, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `dle_post_log`
--

CREATE TABLE `dle_post_log` (
  `id` int(11) NOT NULL,
  `news_id` int(11) NOT NULL DEFAULT '0',
  `expires` varchar(15) NOT NULL DEFAULT '',
  `action` tinyint(1) NOT NULL DEFAULT '0',
  `move_cat` varchar(190) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблицы `dle_post_pass`
--

CREATE TABLE `dle_post_pass` (
  `id` int(11) NOT NULL,
  `news_id` int(11) NOT NULL DEFAULT '0',
  `password` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблицы `dle_question`
--

CREATE TABLE `dle_question` (
  `id` int(11) NOT NULL,
  `question` varchar(255) NOT NULL DEFAULT '',
  `answer` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблицы `dle_read_log`
--

CREATE TABLE `dle_read_log` (
  `id` int(11) UNSIGNED NOT NULL,
  `news_id` int(11) NOT NULL DEFAULT '0',
  `ip` varchar(46) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблицы `dle_redirects`
--

CREATE TABLE `dle_redirects` (
  `id` int(11) UNSIGNED NOT NULL,
  `from` varchar(250) NOT NULL DEFAULT '',
  `to` varchar(250) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблицы `dle_rss`
--

CREATE TABLE `dle_rss` (
  `id` smallint(5) NOT NULL,
  `url` varchar(255) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  `allow_main` tinyint(1) NOT NULL DEFAULT '0',
  `allow_rating` tinyint(1) NOT NULL DEFAULT '0',
  `allow_comm` tinyint(1) NOT NULL DEFAULT '0',
  `text_type` tinyint(1) NOT NULL DEFAULT '0',
  `date` tinyint(1) NOT NULL DEFAULT '0',
  `search` text NOT NULL,
  `max_news` tinyint(3) NOT NULL DEFAULT '0',
  `cookie` text NOT NULL,
  `category` smallint(5) NOT NULL DEFAULT '0',
  `lastdate` int(11) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `dle_rss`
--

INSERT INTO `dle_rss` (`id`, `url`, `description`, `allow_main`, `allow_rating`, `allow_comm`, `text_type`, `date`, `search`, `max_news`, `cookie`, `category`, `lastdate`) VALUES
(1, 'https://dle-news.ru/rss.xml', 'Официальный сайт DataLife Engine', 1, 1, 1, 1, 1, '<div class=\"full-post-content row\">{get}</div><div class=\"full-post-footer ignore-select\">', 5, '', 1, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `dle_rssinform`
--

CREATE TABLE `dle_rssinform` (
  `id` smallint(5) NOT NULL,
  `tag` varchar(40) NOT NULL DEFAULT '',
  `descr` varchar(255) NOT NULL DEFAULT '',
  `category` varchar(200) NOT NULL DEFAULT '',
  `url` varchar(255) NOT NULL DEFAULT '',
  `template` varchar(40) NOT NULL DEFAULT '',
  `news_max` smallint(5) NOT NULL DEFAULT '0',
  `tmax` smallint(5) NOT NULL DEFAULT '0',
  `dmax` smallint(5) NOT NULL DEFAULT '0',
  `approve` tinyint(1) NOT NULL DEFAULT '1',
  `rss_date_format` varchar(20) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `dle_rssinform`
--

INSERT INTO `dle_rssinform` (`id`, `tag`, `descr`, `category`, `url`, `template`, `news_max`, `tmax`, `dmax`, `approve`, `rss_date_format`) VALUES
(1, 'dle', 'Новости с Яндекса', '0', 'https://news.yandex.ru/index.rss', 'informer', 3, 0, 200, 1, 'j F Y H:i');

-- --------------------------------------------------------

--
-- Структура таблицы `dle_sendlog`
--

CREATE TABLE `dle_sendlog` (
  `id` int(11) UNSIGNED NOT NULL,
  `user` varchar(40) NOT NULL DEFAULT '',
  `date` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `flag` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблицы `dle_social_login`
--

CREATE TABLE `dle_social_login` (
  `id` int(11) NOT NULL,
  `sid` varchar(40) NOT NULL DEFAULT '',
  `uid` int(11) NOT NULL DEFAULT '0',
  `password` varchar(32) NOT NULL DEFAULT '',
  `provider` varchar(15) NOT NULL DEFAULT '',
  `wait` tinyint(1) NOT NULL DEFAULT '0',
  `waitlogin` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблицы `dle_spam_log`
--

CREATE TABLE `dle_spam_log` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip` varchar(46) NOT NULL DEFAULT '',
  `is_spammer` tinyint(1) NOT NULL DEFAULT '0',
  `email` varchar(50) NOT NULL DEFAULT '',
  `date` int(11) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблицы `dle_static`
--

CREATE TABLE `dle_static` (
  `id` mediumint(8) NOT NULL,
  `name` varchar(100) NOT NULL DEFAULT '',
  `descr` varchar(255) NOT NULL DEFAULT '',
  `template` mediumtext NOT NULL,
  `allow_br` tinyint(1) NOT NULL DEFAULT '0',
  `allow_template` tinyint(1) NOT NULL DEFAULT '0',
  `grouplevel` varchar(100) NOT NULL DEFAULT 'all',
  `tpl` varchar(40) NOT NULL DEFAULT '',
  `metadescr` varchar(300) NOT NULL DEFAULT '',
  `metakeys` text NOT NULL,
  `views` mediumint(8) NOT NULL DEFAULT '0',
  `template_folder` varchar(50) NOT NULL DEFAULT '',
  `date` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `metatitle` varchar(255) NOT NULL DEFAULT '',
  `allow_count` tinyint(1) NOT NULL DEFAULT '1',
  `sitemap` tinyint(1) NOT NULL DEFAULT '1',
  `disable_index` tinyint(1) NOT NULL DEFAULT '0',
  `disable_search` tinyint(1) NOT NULL DEFAULT '0',
  `password` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `dle_static`
--

INSERT INTO `dle_static` (`id`, `name`, `descr`, `template`, `allow_br`, `allow_template`, `grouplevel`, `tpl`, `metadescr`, `metakeys`, `views`, `template_folder`, `date`, `metatitle`, `allow_count`, `sitemap`, `disable_index`, `disable_search`, `password`) VALUES
(1, 'dle-rules-page', 'Общие правила на сайте', '<b>Общие правила поведения на сайте:</b><br /><br />Начнем с того, что на сайте общаются сотни людей, разных религий и взглядов, и все они являются полноправными посетителями нашего сайта, поэтому если мы хотим чтобы это сообщество людей функционировало нам и необходимы правила. Мы настоятельно рекомендуем прочитать настоящие правила, это займет у вас всего минут пять, но сбережет нам и вам время и поможет сделать сайт более интересным и организованным.<br /><br />Начнем с того, что на нашем сайте нужно вести себя уважительно ко всем посетителям сайта. Не надо оскорблений по отношению к участникам, это всегда лишнее. Если есть претензии - обращайтесь к Админам или Модераторам (воспользуйтесь личными сообщениями). Оскорбление других посетителей считается у нас одним из самых тяжких нарушений и строго наказывается администрацией. <b>У нас строго запрещен расизм, религиозные и политические высказывания.</b> Заранее благодарим вас за понимание и за желание сделать наш сайт более вежливым и дружелюбным.<br /><br /><b>На сайте строго запрещено:</b> <br /><br />- сообщения, не относящиеся к содержанию статьи или к контексту обсуждения<br />- оскорбление и угрозы в адрес посетителей сайта<br />- в комментариях запрещаются выражения, содержащие ненормативную лексику, унижающие человеческое достоинство, разжигающие межнациональную рознь<br />- спам, а также реклама любых товаров и услуг, иных ресурсов, СМИ или событий, не относящихся к контексту обсуждения статьи<br /><br />Давайте будем уважать друг друга и сайт, на который Вы и другие читатели приходят пообщаться и высказать свои мысли. Администрация сайта оставляет за собой право удалять комментарии или часть комментариев, если они не соответствуют данным требованиям.<br /><br />При нарушении правил вам может быть дано <b>предупреждение</b>. В некоторых случаях может быть дан бан <b>без предупреждений</b>. По вопросам снятия бана писать администратору.<br /><br /><b>Оскорбление</b> администраторов или модераторов также караются <b>баном</b> - уважайте чужой труд.<br /><br /><div style=\"text-align:center;\">{ACCEPT-DECLINE}</div>', 1, 1, 'all', '', 'Общие правила', 'Общие правила', 11, '', 1536763163, '', 1, 1, 0, 0, ''),
(2, 'credit', 'О проекте', 'site1.radimid.ru — это информационный проект о банках и банковских услугах. <br><br>На сайте собраны лучшие предложения банков по потребительским кредитам, кредитным картам, ипотеке, автокредитам, кредитам для бизнеса и вкладам. Любая из этих слуг доступна для оформления онлайн.<br><br>Проект основан в 2015 году и на сегодня содержит информацию о более чем 200 банках. Около 100 различных банковских предложений можно оформить онлайн. В базе сайта содержится несколько тысяч клиентских отзывов. <br><br>Каждую неделю мы размещаем на сайте статьи и обзоры, позволяющие лучше понять банковские продукты, повысить финансовую грамотность.', 0, 1, 'all', '', 'site1.radimid.ru — это информационный проект о банках и банковских услугах.   На сайте собраны лучшие предложения банков по потребительским кредитам, кредитным картам, ипотеке, автокредитам, креди', 'сайте, кредитам, онлайн, банковских, банках, несколько, отзывов, клиентских, тысяч, оформить, предложений, различных, можно, Каждую, сайта, содержится, статьи, продукты, банковские, повысить', 21, '', 1475004296, 'О проекте - site1.radimid.ru', 0, 0, 1, 0, ''),
(3, 'reklama', 'Реклама', 'По вопросам сотрудничества и рекламы обращайтесь через форму <a href=\\\"/feedback.html\\\">обратной связи</a>.<br><br>Все предложения рассматриваются не более 24 часов.<br><br><br>С уважением, команда site1.radimid.ru!', 0, 1, 'all', '', 'По вопросам сотрудничества и рекламы обращайтесь через форму обратной связи.  Все предложения рассматриваются не более 24 часов.   С уважением, команда site1.radimid.ru!', 'более, рассматриваются, часов, уважением, site1.radimid.ru, команда, предложения, связи, рекламы, сотрудничества, обращайтесь, через, обратной, форму, вопросам', 21, '', 1475004751, 'Реклама на сайте - site1.radimid.ru', 1, 1, 1, 0, '');

-- --------------------------------------------------------

--
-- Структура таблицы `dle_static_files`
--

CREATE TABLE `dle_static_files` (
  `id` int(11) NOT NULL,
  `static_id` int(11) NOT NULL DEFAULT '0',
  `author` varchar(40) NOT NULL DEFAULT '',
  `date` varchar(15) NOT NULL DEFAULT '',
  `name` varchar(200) NOT NULL DEFAULT '',
  `onserver` varchar(190) NOT NULL DEFAULT '',
  `dcount` int(11) NOT NULL DEFAULT '0',
  `size` bigint(20) NOT NULL DEFAULT '0',
  `checksum` char(32) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблицы `dle_subscribe`
--

CREATE TABLE `dle_subscribe` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(40) NOT NULL DEFAULT '',
  `email` varchar(50) NOT NULL DEFAULT '',
  `news_id` int(11) NOT NULL DEFAULT '0',
  `hash` varchar(32) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблицы `dle_tags`
--

CREATE TABLE `dle_tags` (
  `id` int(11) NOT NULL,
  `news_id` int(11) NOT NULL DEFAULT '0',
  `tag` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблицы `dle_twofactor`
--

CREATE TABLE `dle_twofactor` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `pin` varchar(10) NOT NULL DEFAULT '',
  `attempt` tinyint(1) NOT NULL DEFAULT '0',
  `date` int(11) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблицы `dle_usergroups`
--

CREATE TABLE `dle_usergroups` (
  `id` smallint(5) NOT NULL,
  `group_name` varchar(50) NOT NULL DEFAULT '',
  `allow_cats` text NOT NULL,
  `allow_adds` tinyint(1) NOT NULL DEFAULT '1',
  `cat_add` text NOT NULL,
  `allow_admin` tinyint(1) NOT NULL DEFAULT '0',
  `allow_addc` tinyint(1) NOT NULL DEFAULT '0',
  `allow_editc` tinyint(1) NOT NULL DEFAULT '0',
  `allow_delc` tinyint(1) NOT NULL DEFAULT '0',
  `edit_allc` tinyint(1) NOT NULL DEFAULT '0',
  `del_allc` tinyint(1) NOT NULL DEFAULT '0',
  `moderation` tinyint(1) NOT NULL DEFAULT '0',
  `allow_all_edit` tinyint(1) NOT NULL DEFAULT '0',
  `allow_edit` tinyint(1) NOT NULL DEFAULT '0',
  `allow_pm` tinyint(1) NOT NULL DEFAULT '0',
  `max_pm` smallint(5) NOT NULL DEFAULT '0',
  `max_foto` varchar(10) NOT NULL DEFAULT '',
  `allow_files` tinyint(1) NOT NULL DEFAULT '0',
  `allow_hide` tinyint(1) NOT NULL DEFAULT '1',
  `allow_short` tinyint(1) NOT NULL DEFAULT '0',
  `time_limit` tinyint(1) NOT NULL DEFAULT '0',
  `rid` smallint(5) NOT NULL DEFAULT '0',
  `allow_fixed` tinyint(1) NOT NULL DEFAULT '0',
  `allow_feed` tinyint(1) NOT NULL DEFAULT '1',
  `allow_search` tinyint(1) NOT NULL DEFAULT '1',
  `allow_poll` tinyint(1) NOT NULL DEFAULT '1',
  `allow_main` tinyint(1) NOT NULL DEFAULT '1',
  `captcha` tinyint(1) NOT NULL DEFAULT '0',
  `icon` varchar(200) NOT NULL DEFAULT '',
  `allow_modc` tinyint(1) NOT NULL DEFAULT '0',
  `allow_rating` tinyint(1) NOT NULL DEFAULT '1',
  `allow_offline` tinyint(1) NOT NULL DEFAULT '0',
  `allow_image_upload` tinyint(1) NOT NULL DEFAULT '0',
  `allow_file_upload` tinyint(1) NOT NULL DEFAULT '0',
  `allow_signature` tinyint(1) NOT NULL DEFAULT '0',
  `allow_url` tinyint(1) NOT NULL DEFAULT '1',
  `news_sec_code` tinyint(1) NOT NULL DEFAULT '1',
  `allow_image` tinyint(1) NOT NULL DEFAULT '0',
  `max_signature` smallint(6) NOT NULL DEFAULT '0',
  `max_info` smallint(6) NOT NULL DEFAULT '0',
  `admin_addnews` tinyint(1) NOT NULL DEFAULT '0',
  `admin_editnews` tinyint(1) NOT NULL DEFAULT '0',
  `admin_comments` tinyint(1) NOT NULL DEFAULT '0',
  `admin_categories` tinyint(1) NOT NULL DEFAULT '0',
  `admin_editusers` tinyint(1) NOT NULL DEFAULT '0',
  `admin_wordfilter` tinyint(1) NOT NULL DEFAULT '0',
  `admin_xfields` tinyint(1) NOT NULL DEFAULT '0',
  `admin_userfields` tinyint(1) NOT NULL DEFAULT '0',
  `admin_static` tinyint(1) NOT NULL DEFAULT '0',
  `admin_editvote` tinyint(1) NOT NULL DEFAULT '0',
  `admin_newsletter` tinyint(1) NOT NULL DEFAULT '0',
  `admin_blockip` tinyint(1) NOT NULL DEFAULT '0',
  `admin_banners` tinyint(1) NOT NULL DEFAULT '0',
  `admin_rss` tinyint(1) NOT NULL DEFAULT '0',
  `admin_iptools` tinyint(1) NOT NULL DEFAULT '0',
  `admin_rssinform` tinyint(1) NOT NULL DEFAULT '0',
  `admin_googlemap` tinyint(1) NOT NULL DEFAULT '0',
  `allow_html` tinyint(1) NOT NULL DEFAULT '1',
  `group_prefix` text NOT NULL,
  `group_suffix` text NOT NULL,
  `allow_subscribe` tinyint(1) NOT NULL DEFAULT '0',
  `allow_image_size` tinyint(1) NOT NULL DEFAULT '0',
  `cat_allow_addnews` text NOT NULL,
  `flood_news` smallint(6) NOT NULL DEFAULT '0',
  `max_day_news` smallint(6) NOT NULL DEFAULT '0',
  `force_leech` tinyint(1) NOT NULL DEFAULT '0',
  `edit_limit` smallint(6) NOT NULL DEFAULT '0',
  `captcha_pm` tinyint(1) NOT NULL DEFAULT '0',
  `max_pm_day` smallint(6) NOT NULL DEFAULT '0',
  `max_mail_day` smallint(6) NOT NULL DEFAULT '0',
  `admin_tagscloud` tinyint(1) NOT NULL DEFAULT '0',
  `allow_vote` tinyint(1) NOT NULL DEFAULT '0',
  `admin_complaint` tinyint(1) NOT NULL DEFAULT '0',
  `news_question` tinyint(1) NOT NULL DEFAULT '0',
  `comments_question` tinyint(1) NOT NULL DEFAULT '0',
  `max_comment_day` smallint(6) NOT NULL DEFAULT '0',
  `max_images` smallint(6) NOT NULL DEFAULT '0',
  `max_files` smallint(6) NOT NULL DEFAULT '0',
  `disable_news_captcha` smallint(6) NOT NULL DEFAULT '0',
  `disable_comments_captcha` smallint(6) NOT NULL DEFAULT '0',
  `pm_question` tinyint(1) NOT NULL DEFAULT '0',
  `captcha_feedback` tinyint(1) NOT NULL DEFAULT '1',
  `feedback_question` tinyint(1) NOT NULL DEFAULT '0',
  `files_type` varchar(255) NOT NULL DEFAULT '',
  `max_file_size` mediumint(9) NOT NULL DEFAULT '0',
  `files_max_speed` smallint(6) NOT NULL DEFAULT '0',
  `spamfilter` tinyint(1) NOT NULL DEFAULT '2',
  `allow_comments_rating` tinyint(1) NOT NULL DEFAULT '1',
  `max_edit_days` tinyint(1) NOT NULL DEFAULT '0',
  `spampmfilter` tinyint(1) NOT NULL DEFAULT '0',
  `force_reg` tinyint(1) NOT NULL DEFAULT '0',
  `force_reg_days` mediumint(9) NOT NULL DEFAULT '0',
  `force_reg_group` smallint(6) NOT NULL DEFAULT '4',
  `force_news` tinyint(1) NOT NULL DEFAULT '0',
  `force_news_count` mediumint(9) NOT NULL DEFAULT '0',
  `force_news_group` smallint(6) NOT NULL DEFAULT '4',
  `force_comments` tinyint(1) NOT NULL DEFAULT '0',
  `force_comments_count` mediumint(9) NOT NULL DEFAULT '0',
  `force_comments_group` smallint(6) NOT NULL DEFAULT '4',
  `force_rating` tinyint(1) NOT NULL DEFAULT '0',
  `force_rating_count` mediumint(9) NOT NULL DEFAULT '0',
  `force_rating_group` smallint(6) NOT NULL DEFAULT '4',
  `not_allow_cats` text NOT NULL,
  `allow_up_image` tinyint(1) NOT NULL DEFAULT '0',
  `allow_up_watermark` tinyint(1) NOT NULL DEFAULT '0',
  `allow_up_thumb` tinyint(1) NOT NULL DEFAULT '0',
  `up_count_image` smallint(6) NOT NULL DEFAULT '0',
  `up_image_side` varchar(20) NOT NULL DEFAULT '',
  `up_image_size` mediumint(9) NOT NULL DEFAULT '0',
  `up_thumb_size` varchar(20) NOT NULL DEFAULT '',
  `allow_mail_files` tinyint(1) NOT NULL DEFAULT '0',
  `max_mail_files` smallint(6) NOT NULL DEFAULT '0',
  `max_mail_allfiles` mediumint(9) NOT NULL DEFAULT '0',
  `mail_files_type` varchar(100) NOT NULL DEFAULT '',
  `video_comments` tinyint(1) NOT NULL DEFAULT '0',
  `media_comments` tinyint(1) NOT NULL DEFAULT '0',
  `min_image_side` varchar(20) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `dle_usergroups`
--

INSERT INTO `dle_usergroups` (`id`, `group_name`, `allow_cats`, `allow_adds`, `cat_add`, `allow_admin`, `allow_addc`, `allow_editc`, `allow_delc`, `edit_allc`, `del_allc`, `moderation`, `allow_all_edit`, `allow_edit`, `allow_pm`, `max_pm`, `max_foto`, `allow_files`, `allow_hide`, `allow_short`, `time_limit`, `rid`, `allow_fixed`, `allow_feed`, `allow_search`, `allow_poll`, `allow_main`, `captcha`, `icon`, `allow_modc`, `allow_rating`, `allow_offline`, `allow_image_upload`, `allow_file_upload`, `allow_signature`, `allow_url`, `news_sec_code`, `allow_image`, `max_signature`, `max_info`, `admin_addnews`, `admin_editnews`, `admin_comments`, `admin_categories`, `admin_editusers`, `admin_wordfilter`, `admin_xfields`, `admin_userfields`, `admin_static`, `admin_editvote`, `admin_newsletter`, `admin_blockip`, `admin_banners`, `admin_rss`, `admin_iptools`, `admin_rssinform`, `admin_googlemap`, `allow_html`, `group_prefix`, `group_suffix`, `allow_subscribe`, `allow_image_size`, `cat_allow_addnews`, `flood_news`, `max_day_news`, `force_leech`, `edit_limit`, `captcha_pm`, `max_pm_day`, `max_mail_day`, `admin_tagscloud`, `allow_vote`, `admin_complaint`, `news_question`, `comments_question`, `max_comment_day`, `max_images`, `max_files`, `disable_news_captcha`, `disable_comments_captcha`, `pm_question`, `captcha_feedback`, `feedback_question`, `files_type`, `max_file_size`, `files_max_speed`, `spamfilter`, `allow_comments_rating`, `max_edit_days`, `spampmfilter`, `force_reg`, `force_reg_days`, `force_reg_group`, `force_news`, `force_news_count`, `force_news_group`, `force_comments`, `force_comments_count`, `force_comments_group`, `force_rating`, `force_rating_count`, `force_rating_group`, `not_allow_cats`, `allow_up_image`, `allow_up_watermark`, `allow_up_thumb`, `up_count_image`, `up_image_side`, `up_image_size`, `up_thumb_size`, `allow_mail_files`, `max_mail_files`, `max_mail_allfiles`, `mail_files_type`, `video_comments`, `media_comments`, `min_image_side`) VALUES
(1, 'Редактор', 'all', 1, 'all', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 50, '101', 1, 1, 1, 0, 1, 1, 1, 1, 1, 1, 0, '{THEME}/images/icon_1.gif', 0, 1, 1, 1, 1, 1, 1, 0, 1, 500, 1000, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, '<b><span style=\"color:red\">', '</span></b>', 1, 1, 'all', 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 'zip,rar,exe,doc,pdf,swf', 4096, 0, 2, 1, 0, 0, 0, 0, 1, 0, 0, 1, 0, 0, 1, 0, 0, 1, '', 1, 1, 1, 3, '800x600', 300, '200x150', 1, 3, 1000, 'jpg,png,zip,pdf', 1, 1, '10x10'),
(2, 'Главные редакторы', 'all', 1, 'all', 1, 1, 1, 1, 1, 0, 1, 1, 1, 1, 50, '101', 1, 1, 1, 0, 2, 1, 1, 1, 1, 1, 0, '{THEME}/images/icon_2.gif', 0, 1, 0, 1, 1, 1, 1, 0, 1, 500, 1000, 1, 1, 1, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, '', '', 1, 1, 'all', 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 'zip,rar,exe,doc,pdf,swf', 4096, 0, 2, 1, 0, 0, 0, 0, 2, 0, 0, 2, 0, 0, 2, 0, 0, 2, '', 1, 1, 1, 3, '800x600', 300, '200x150', 1, 3, 1000, 'jpg,png,zip,pdf', 1, 1, '10x10'),
(3, 'Журналисты', 'all', 1, 'all', 1, 1, 1, 1, 0, 0, 1, 0, 1, 1, 50, '101', 1, 1, 1, 0, 3, 0, 1, 1, 1, 1, 0, '{THEME}/images/icon_3.gif', 0, 1, 0, 1, 1, 1, 1, 0, 1, 500, 1000, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, '', '', 1, 1, 'all', 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 'zip,rar,exe,doc,pdf,swf', 4096, 0, 2, 1, 0, 0, 0, 0, 3, 0, 0, 3, 0, 0, 3, 0, 0, 3, '', 1, 1, 1, 3, '800x600', 300, '200x150', 0, 3, 1000, 'jpg,png,zip,pdf', 1, 1, '10x10'),
(4, 'Новичок', 'all', 0, 'all', 0, 1, 1, 0, 0, 0, 0, 0, 0, 0, 20, '101', 1, 1, 1, 0, 4, 0, 1, 1, 1, 0, 0, '{THEME}/images/icon_4.gif', 1, 0, 0, 0, 0, 0, 1, 1, 0, 500, 1000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', 1, 0, 'all', 0, 0, 0, 30, 1, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 'zip,rar,exe,doc,pdf,swf', 4096, 0, 2, 1, 0, 2, 0, 0, 4, 0, 0, 4, 0, 0, 4, 0, 0, 4, '', 0, 0, 0, 1, '800x600', 300, '200x150', 0, 3, 1000, 'jpg,png,zip,pdf', 0, 0, '10x10'),
(5, 'Гости', 'all', 0, 'all', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0', 1, 0, 1, 0, 5, 0, 1, 1, 1, 0, 1, '{THEME}/images/icon_5.gif', 0, 1, 0, 0, 0, 0, 1, 0, 0, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '', '', 0, 0, 'all', 0, 0, 0, 0, 1, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, '', 0, 0, 2, 1, 0, 2, 0, 0, 5, 0, 0, 5, 0, 0, 5, 0, 0, 5, '', 0, 0, 0, 1, '800x600', 300, '200x150', 0, 3, 1000, 'jpg,png,zip,pdf', 0, 0, '10x10');

-- --------------------------------------------------------

--
-- Структура таблицы `dle_users`
--

CREATE TABLE `dle_users` (
  `email` varchar(50) NOT NULL DEFAULT '',
  `password` varchar(255) NOT NULL DEFAULT '',
  `name` varchar(40) NOT NULL DEFAULT '',
  `user_id` int(11) NOT NULL,
  `news_num` mediumint(8) NOT NULL DEFAULT '0',
  `comm_num` mediumint(8) NOT NULL DEFAULT '0',
  `user_group` smallint(5) NOT NULL DEFAULT '4',
  `lastdate` varchar(20) NOT NULL DEFAULT '',
  `reg_date` varchar(20) NOT NULL DEFAULT '',
  `banned` varchar(5) NOT NULL DEFAULT '',
  `allow_mail` tinyint(1) NOT NULL DEFAULT '1',
  `info` text NOT NULL,
  `signature` text NOT NULL,
  `foto` varchar(255) NOT NULL DEFAULT '',
  `fullname` varchar(100) NOT NULL DEFAULT '',
  `land` varchar(100) NOT NULL DEFAULT '',
  `favorites` text NOT NULL,
  `pm_all` smallint(5) NOT NULL DEFAULT '0',
  `pm_unread` smallint(5) NOT NULL DEFAULT '0',
  `time_limit` varchar(20) NOT NULL DEFAULT '',
  `xfields` text NOT NULL,
  `allowed_ip` varchar(255) NOT NULL DEFAULT '',
  `hash` varchar(32) NOT NULL DEFAULT '',
  `logged_ip` varchar(46) NOT NULL DEFAULT '',
  `restricted` tinyint(1) NOT NULL DEFAULT '0',
  `restricted_days` smallint(4) NOT NULL DEFAULT '0',
  `restricted_date` varchar(15) NOT NULL DEFAULT '',
  `timezone` varchar(100) NOT NULL DEFAULT '',
  `news_subscribe` tinyint(1) NOT NULL DEFAULT '0',
  `comments_reply_subscribe` tinyint(1) NOT NULL DEFAULT '0',
  `twofactor_auth` tinyint(1) NOT NULL DEFAULT '0',
  `cat_add` varchar(500) NOT NULL DEFAULT '',
  `cat_allow_addnews` varchar(500) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `dle_users`
--

INSERT INTO `dle_users` (`email`, `password`, `name`, `user_id`, `news_num`, `comm_num`, `user_group`, `lastdate`, `reg_date`, `banned`, `allow_mail`, `info`, `signature`, `foto`, `fullname`, `land`, `favorites`, `pm_all`, `pm_unread`, `time_limit`, `xfields`, `allowed_ip`, `hash`, `logged_ip`, `restricted`, `restricted_days`, `restricted_date`, `timezone`, `news_subscribe`, `comments_reply_subscribe`, `twofactor_auth`, `cat_add`, `cat_allow_addnews`) VALUES
('info@admin.ru', '$2y$10$4v/1.kttyJT1fZWf01zjZeQpmeTiX9v6SH6q1RrSyjY/P0ne19wAO', 'redaktor', 1, 14, 1, 1, '1584380717', '1536763163', '', 1, '', '', '', 'Дмитрий', 'Москва', '', 0, 0, '', '', '', 'b726a21e9ec426c0d78e2ac36232536f', '90.154.72.152', 0, 0, '', '', 0, 0, 0, '', '');

-- --------------------------------------------------------

--
-- Структура таблицы `dle_views`
--

CREATE TABLE `dle_views` (
  `id` int(11) NOT NULL,
  `news_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблицы `dle_vote`
--

CREATE TABLE `dle_vote` (
  `id` mediumint(8) NOT NULL,
  `category` text NOT NULL,
  `vote_num` mediumint(8) NOT NULL DEFAULT '0',
  `date` varchar(25) NOT NULL DEFAULT '0',
  `title` varchar(200) NOT NULL DEFAULT '',
  `body` text NOT NULL,
  `approve` tinyint(1) NOT NULL DEFAULT '1',
  `start` varchar(15) NOT NULL DEFAULT '',
  `end` varchar(15) NOT NULL DEFAULT '',
  `grouplevel` varchar(250) NOT NULL DEFAULT 'all'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `dle_vote`
--

INSERT INTO `dle_vote` (`id`, `category`, `vote_num`, `date`, `title`, `body`, `approve`, `start`, `end`, `grouplevel`) VALUES
(1, 'all', 7, '2018-09-12 17:39:23', 'Оцените работу движка', 'Лучший из новостных<br />Неплохой движок<br />Устраивает ... но ...<br />Встречал и получше<br />Совсем не понравился', 1, '', '', 'all');

-- --------------------------------------------------------

--
-- Структура таблицы `dle_vote_result`
--

CREATE TABLE `dle_vote_result` (
  `id` int(10) NOT NULL,
  `ip` varchar(46) NOT NULL DEFAULT '',
  `name` varchar(40) NOT NULL DEFAULT '',
  `vote_id` mediumint(8) NOT NULL DEFAULT '0',
  `answer` tinyint(3) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `dle_vote_result`
--

INSERT INTO `dle_vote_result` (`id`, `ip`, `name`, `vote_id`, `answer`) VALUES
(1, '111.255.111.111', 'redaktor', 1, 2),
(2, '66.102.9.137', 'guest', 1, 1),
(3, '176.114.186.234', 'guest', 1, 1),
(4, '176.52.32.214', 'guest', 1, 1),
(5, '212.90.62.133', 'guest', 1, 1),
(6, '92.53.72.106', 'guest', 1, 1),
(7, '90.154.71.145', 'guest', 1, 4);

-- --------------------------------------------------------

--
-- Структура таблицы `dle_xfsearch`
--

CREATE TABLE `dle_xfsearch` (
  `id` int(11) NOT NULL,
  `news_id` int(11) NOT NULL DEFAULT '0',
  `tagname` varchar(50) NOT NULL DEFAULT '',
  `tagvalue` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `dle_admin_logs`
--
ALTER TABLE `dle_admin_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `date` (`date`);

--
-- Индексы таблицы `dle_admin_sections`
--
ALTER TABLE `dle_admin_sections`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Индексы таблицы `dle_banki_comments`
--
ALTER TABLE `dle_banki_comments`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `dle_banki_options`
--
ALTER TABLE `dle_banki_options`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `dle_banki_post`
--
ALTER TABLE `dle_banki_post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category` (`category`),
  ADD KEY `approve` (`approve`);

--
-- Индексы таблицы `dle_banned`
--
ALTER TABLE `dle_banned`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`users_id`);

--
-- Индексы таблицы `dle_banners`
--
ALTER TABLE `dle_banners`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `dle_banners_logs`
--
ALTER TABLE `dle_banners_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bid` (`bid`),
  ADD KEY `ip` (`ip`);

--
-- Индексы таблицы `dle_banners_rubrics`
--
ALTER TABLE `dle_banners_rubrics`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `dle_category`
--
ALTER TABLE `dle_category`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `dle_comments`
--
ALTER TABLE `dle_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `approve` (`approve`),
  ADD KEY `parent` (`parent`),
  ADD KEY `rating` (`rating`);
ALTER TABLE `dle_comments` ADD FULLTEXT KEY `text` (`text`);

--
-- Индексы таблицы `dle_comments_files`
--
ALTER TABLE `dle_comments_files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `c_id` (`c_id`),
  ADD KEY `author` (`author`);

--
-- Индексы таблицы `dle_comment_rating_log`
--
ALTER TABLE `dle_comment_rating_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `c_id` (`c_id`),
  ADD KEY `member` (`member`),
  ADD KEY `ip` (`ip`);

--
-- Индексы таблицы `dle_complaint`
--
ALTER TABLE `dle_complaint`
  ADD PRIMARY KEY (`id`),
  ADD KEY `c_id` (`c_id`),
  ADD KEY `p_id` (`p_id`),
  ADD KEY `n_id` (`n_id`);

--
-- Индексы таблицы `dle_email`
--
ALTER TABLE `dle_email`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `dle_files`
--
ALTER TABLE `dle_files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `news_id` (`news_id`);

--
-- Индексы таблицы `dle_flood`
--
ALTER TABLE `dle_flood`
  ADD PRIMARY KEY (`f_id`),
  ADD KEY `ip` (`ip`),
  ADD KEY `id` (`id`),
  ADD KEY `flag` (`flag`);

--
-- Индексы таблицы `dle_ignore_list`
--
ALTER TABLE `dle_ignore_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user` (`user`),
  ADD KEY `user_from` (`user_from`);

--
-- Индексы таблицы `dle_images`
--
ALTER TABLE `dle_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `author` (`author`),
  ADD KEY `news_id` (`news_id`);

--
-- Индексы таблицы `dle_links`
--
ALTER TABLE `dle_links`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `dle_login_log`
--
ALTER TABLE `dle_login_log`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ip` (`ip`),
  ADD KEY `date` (`date`);

--
-- Индексы таблицы `dle_logs`
--
ALTER TABLE `dle_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `news_id` (`news_id`),
  ADD KEY `member` (`member`),
  ADD KEY `ip` (`ip`);

--
-- Индексы таблицы `dle_lostdb`
--
ALTER TABLE `dle_lostdb`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lostid` (`lostid`);

--
-- Индексы таблицы `dle_mail_log`
--
ALTER TABLE `dle_mail_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hash` (`hash`);

--
-- Индексы таблицы `dle_metatags`
--
ALTER TABLE `dle_metatags`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `dle_mfo_comments`
--
ALTER TABLE `dle_mfo_comments`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `dle_mfo_options`
--
ALTER TABLE `dle_mfo_options`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `dle_mfo_post`
--
ALTER TABLE `dle_mfo_post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category` (`category`),
  ADD KEY `approve` (`approve`);

--
-- Индексы таблицы `dle_notice`
--
ALTER TABLE `dle_notice`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `dle_offers_comments`
--
ALTER TABLE `dle_offers_comments`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `dle_offers_options`
--
ALTER TABLE `dle_offers_options`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `dle_offers_post`
--
ALTER TABLE `dle_offers_post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category` (`category`),
  ADD KEY `approve` (`approve`);

--
-- Индексы таблицы `dle_plugins`
--
ALTER TABLE `dle_plugins`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `dle_plugins_files`
--
ALTER TABLE `dle_plugins_files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `plugin_id` (`plugin_id`),
  ADD KEY `active` (`active`);

--
-- Индексы таблицы `dle_plugins_logs`
--
ALTER TABLE `dle_plugins_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `plugin_id` (`plugin_id`);

--
-- Индексы таблицы `dle_pm`
--
ALTER TABLE `dle_pm`
  ADD PRIMARY KEY (`id`),
  ADD KEY `folder` (`folder`),
  ADD KEY `user` (`user`),
  ADD KEY `user_from` (`user_from`),
  ADD KEY `pm_read` (`pm_read`);

--
-- Индексы таблицы `dle_poll`
--
ALTER TABLE `dle_poll`
  ADD PRIMARY KEY (`id`),
  ADD KEY `news_id` (`news_id`);

--
-- Индексы таблицы `dle_poll_log`
--
ALTER TABLE `dle_poll_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `news_id` (`news_id`),
  ADD KEY `member` (`member`);

--
-- Индексы таблицы `dle_post`
--
ALTER TABLE `dle_post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `autor` (`autor`),
  ADD KEY `alt_name` (`alt_name`),
  ADD KEY `category` (`category`),
  ADD KEY `approve` (`approve`),
  ADD KEY `allow_main` (`allow_main`),
  ADD KEY `date` (`date`),
  ADD KEY `symbol` (`symbol`),
  ADD KEY `comm_num` (`comm_num`),
  ADD KEY `fixed` (`fixed`);
ALTER TABLE `dle_post` ADD FULLTEXT KEY `short_story` (`short_story`,`full_story`,`xfields`,`title`);

--
-- Индексы таблицы `dle_post_extras`
--
ALTER TABLE `dle_post_extras`
  ADD PRIMARY KEY (`eid`),
  ADD KEY `news_id` (`news_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `rating` (`rating`),
  ADD KEY `disable_search` (`disable_search`),
  ADD KEY `news_read` (`news_read`),
  ADD KEY `allow_rss` (`allow_rss`);

--
-- Индексы таблицы `dle_post_extras_cats`
--
ALTER TABLE `dle_post_extras_cats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `news_id` (`news_id`),
  ADD KEY `cat_id` (`cat_id`);

--
-- Индексы таблицы `dle_post_log`
--
ALTER TABLE `dle_post_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `news_id` (`news_id`),
  ADD KEY `expires` (`expires`);

--
-- Индексы таблицы `dle_post_pass`
--
ALTER TABLE `dle_post_pass`
  ADD PRIMARY KEY (`id`),
  ADD KEY `news_id` (`news_id`);

--
-- Индексы таблицы `dle_question`
--
ALTER TABLE `dle_question`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `dle_read_log`
--
ALTER TABLE `dle_read_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `news_id` (`news_id`),
  ADD KEY `ip` (`ip`);

--
-- Индексы таблицы `dle_redirects`
--
ALTER TABLE `dle_redirects`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `dle_rss`
--
ALTER TABLE `dle_rss`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `dle_rssinform`
--
ALTER TABLE `dle_rssinform`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `dle_sendlog`
--
ALTER TABLE `dle_sendlog`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user` (`user`),
  ADD KEY `date` (`date`),
  ADD KEY `flag` (`flag`);

--
-- Индексы таблицы `dle_social_login`
--
ALTER TABLE `dle_social_login`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sid` (`sid`);

--
-- Индексы таблицы `dle_spam_log`
--
ALTER TABLE `dle_spam_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ip` (`ip`),
  ADD KEY `is_spammer` (`is_spammer`);

--
-- Индексы таблицы `dle_static`
--
ALTER TABLE `dle_static`
  ADD PRIMARY KEY (`id`),
  ADD KEY `name` (`name`),
  ADD KEY `disable_search` (`disable_search`);
ALTER TABLE `dle_static` ADD FULLTEXT KEY `template` (`template`);

--
-- Индексы таблицы `dle_static_files`
--
ALTER TABLE `dle_static_files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `static_id` (`static_id`),
  ADD KEY `onserver` (`onserver`),
  ADD KEY `author` (`author`);

--
-- Индексы таблицы `dle_subscribe`
--
ALTER TABLE `dle_subscribe`
  ADD PRIMARY KEY (`id`),
  ADD KEY `news_id` (`news_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `dle_tags`
--
ALTER TABLE `dle_tags`
  ADD PRIMARY KEY (`id`),
  ADD KEY `news_id` (`news_id`),
  ADD KEY `tag` (`tag`);

--
-- Индексы таблицы `dle_twofactor`
--
ALTER TABLE `dle_twofactor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pin` (`pin`),
  ADD KEY `date` (`date`);

--
-- Индексы таблицы `dle_usergroups`
--
ALTER TABLE `dle_usergroups`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `dle_users`
--
ALTER TABLE `dle_users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Индексы таблицы `dle_views`
--
ALTER TABLE `dle_views`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `dle_vote`
--
ALTER TABLE `dle_vote`
  ADD PRIMARY KEY (`id`),
  ADD KEY `approve` (`approve`);

--
-- Индексы таблицы `dle_vote_result`
--
ALTER TABLE `dle_vote_result`
  ADD PRIMARY KEY (`id`),
  ADD KEY `answer` (`answer`),
  ADD KEY `vote_id` (`vote_id`),
  ADD KEY `ip` (`ip`),
  ADD KEY `name` (`name`);

--
-- Индексы таблицы `dle_xfsearch`
--
ALTER TABLE `dle_xfsearch`
  ADD PRIMARY KEY (`id`),
  ADD KEY `news_id` (`news_id`),
  ADD KEY `tagname` (`tagname`),
  ADD KEY `tagvalue` (`tagvalue`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `dle_admin_logs`
--
ALTER TABLE `dle_admin_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=366;

--
-- AUTO_INCREMENT для таблицы `dle_admin_sections`
--
ALTER TABLE `dle_admin_sections`
  MODIFY `id` mediumint(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `dle_banki_comments`
--
ALTER TABLE `dle_banki_comments`
  MODIFY `id` mediumint(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=232;

--
-- AUTO_INCREMENT для таблицы `dle_banki_options`
--
ALTER TABLE `dle_banki_options`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=492;

--
-- AUTO_INCREMENT для таблицы `dle_banki_post`
--
ALTER TABLE `dle_banki_post`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4001;

--
-- AUTO_INCREMENT для таблицы `dle_banned`
--
ALTER TABLE `dle_banned`
  MODIFY `id` smallint(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `dle_banners`
--
ALTER TABLE `dle_banners`
  MODIFY `id` smallint(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `dle_banners_logs`
--
ALTER TABLE `dle_banners_logs`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `dle_banners_rubrics`
--
ALTER TABLE `dle_banners_rubrics`
  MODIFY `id` mediumint(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `dle_category`
--
ALTER TABLE `dle_category`
  MODIFY `id` mediumint(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `dle_comments`
--
ALTER TABLE `dle_comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `dle_comments_files`
--
ALTER TABLE `dle_comments_files`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `dle_comment_rating_log`
--
ALTER TABLE `dle_comment_rating_log`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `dle_complaint`
--
ALTER TABLE `dle_complaint`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `dle_email`
--
ALTER TABLE `dle_email`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `dle_files`
--
ALTER TABLE `dle_files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `dle_flood`
--
ALTER TABLE `dle_flood`
  MODIFY `f_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `dle_ignore_list`
--
ALTER TABLE `dle_ignore_list`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `dle_images`
--
ALTER TABLE `dle_images`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT для таблицы `dle_links`
--
ALTER TABLE `dle_links`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `dle_login_log`
--
ALTER TABLE `dle_login_log`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `dle_logs`
--
ALTER TABLE `dle_logs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `dle_lostdb`
--
ALTER TABLE `dle_lostdb`
  MODIFY `id` mediumint(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `dle_mail_log`
--
ALTER TABLE `dle_mail_log`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `dle_metatags`
--
ALTER TABLE `dle_metatags`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `dle_mfo_comments`
--
ALTER TABLE `dle_mfo_comments`
  MODIFY `id` mediumint(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=216;

--
-- AUTO_INCREMENT для таблицы `dle_mfo_options`
--
ALTER TABLE `dle_mfo_options`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=492;

--
-- AUTO_INCREMENT для таблицы `dle_mfo_post`
--
ALTER TABLE `dle_mfo_post`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2901;

--
-- AUTO_INCREMENT для таблицы `dle_notice`
--
ALTER TABLE `dle_notice`
  MODIFY `id` mediumint(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `dle_offers_comments`
--
ALTER TABLE `dle_offers_comments`
  MODIFY `id` mediumint(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=299;

--
-- AUTO_INCREMENT для таблицы `dle_offers_options`
--
ALTER TABLE `dle_offers_options`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1062;

--
-- AUTO_INCREMENT для таблицы `dle_offers_post`
--
ALTER TABLE `dle_offers_post`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2845;

--
-- AUTO_INCREMENT для таблицы `dle_plugins`
--
ALTER TABLE `dle_plugins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `dle_plugins_files`
--
ALTER TABLE `dle_plugins_files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `dle_plugins_logs`
--
ALTER TABLE `dle_plugins_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `dle_pm`
--
ALTER TABLE `dle_pm`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `dle_poll`
--
ALTER TABLE `dle_poll`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `dle_poll_log`
--
ALTER TABLE `dle_poll_log`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `dle_post`
--
ALTER TABLE `dle_post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT для таблицы `dle_post_extras`
--
ALTER TABLE `dle_post_extras`
  MODIFY `eid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT для таблицы `dle_post_extras_cats`
--
ALTER TABLE `dle_post_extras_cats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT для таблицы `dle_post_log`
--
ALTER TABLE `dle_post_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `dle_post_pass`
--
ALTER TABLE `dle_post_pass`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `dle_question`
--
ALTER TABLE `dle_question`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `dle_read_log`
--
ALTER TABLE `dle_read_log`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `dle_redirects`
--
ALTER TABLE `dle_redirects`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `dle_rss`
--
ALTER TABLE `dle_rss`
  MODIFY `id` smallint(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `dle_rssinform`
--
ALTER TABLE `dle_rssinform`
  MODIFY `id` smallint(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `dle_sendlog`
--
ALTER TABLE `dle_sendlog`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `dle_social_login`
--
ALTER TABLE `dle_social_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `dle_spam_log`
--
ALTER TABLE `dle_spam_log`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `dle_static`
--
ALTER TABLE `dle_static`
  MODIFY `id` mediumint(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `dle_static_files`
--
ALTER TABLE `dle_static_files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `dle_subscribe`
--
ALTER TABLE `dle_subscribe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `dle_tags`
--
ALTER TABLE `dle_tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `dle_twofactor`
--
ALTER TABLE `dle_twofactor`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `dle_usergroups`
--
ALTER TABLE `dle_usergroups`
  MODIFY `id` smallint(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `dle_users`
--
ALTER TABLE `dle_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `dle_views`
--
ALTER TABLE `dle_views`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `dle_vote`
--
ALTER TABLE `dle_vote`
  MODIFY `id` mediumint(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `dle_vote_result`
--
ALTER TABLE `dle_vote_result`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `dle_xfsearch`
--
ALTER TABLE `dle_xfsearch`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
