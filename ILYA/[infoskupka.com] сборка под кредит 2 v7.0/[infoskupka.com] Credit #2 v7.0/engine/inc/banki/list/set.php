<?php
/*
=====================================================
 Файл: main.php
=====================================================
 Данный код защищен авторскими правами
=====================================================
 Назначение: Общее представление админцентра
=====================================================
*/

if( !defined( "DATALIFEENGINE" ) ) die( "Hacking attempt!" );

//------------------------------------------------=-=-=-=-=
//	Вывод шапки и навигации
//------------------------------------------------=-=-=-=-=

echoheader( "<i class=\"fa fa-home position-left\"></i><span class=\"text-semibold\">Настройки модуля</span>","<a href=\"$PHP_SELF?mod=banki\">Каталог банков 7.0</a> / <a href=\"$PHP_SELF?mod=banki&do=set\">Настройки</a>" );




opentable();
tableheader( "Настройки модуля" );

		echo <<<HTML

		<form name="save" method="post" action="" onsubmit="formSubmit( 'save', 'save.php', 'save', 'status.gif', 'save', 'off' ); return false;">
			<div class="tab-content">
				<div class="tab-pane active" id="tabhome">
					<div class="table-responsive">
						<table class="table table-striped">
							<tbody>
HTML;

showRow( "Включить модуль", "Включение и отключения модуля для показа меню на сайте.", makeDropDown( array( "yes" => "Да", "no" => "Нет" ), "save_con[on]", $Banki->Config['on'] ) );

showRow( "Title главной страницы", "Title главной страницы каталога", "<input type=\"text\" name=\"save_con[tit_main]\" value=\"{$Banki->Config['tit_main']}\" class=\"form-control\"  />" );

showRow( "Description главной страницы", "Description главной страницы каталога", "<input type=\"text\" name=\"save_con[des_main]\" value=\"{$Banki->Config['des_main']}\" class=\"form-control\"  />" );

showRow( "Keywords главной страницы", "Введите через запятую основные ключевые слова", "<input type=\"text\" name=\"save_con[key_main]\" value=\"{$Banki->Config['key_main']}\" class=\"form-control\" />" );

showRow( "Speedbar главной страницы", "Коротко название", "<input type=\"text\" name=\"save_con[spe_main]\" value=\"{$Banki->Config['spe_main']}\" class=\"form-control\" />" );

showRow( "Количество отзывов на главной", "Максимальное количество отзывов которые будут отображены на главной страницы", "<input type=\"text\" name=\"save_con[com_glavnay]\" value=\"{$Banki->Config['com_glavnay']}\" class=\"form-control\" />" );

showRow( "Макс. кол. символов в отзыве", "Количество символов в отзыве отображаемое на главной", "<input type=\"text\" name=\"save_con[com_glavnay_text]\" value=\"{$Banki->Config['com_glavnay_text']}\" class=\"form-control\" />" );

showRow( "Включить доп. поля", "Дополнительные поля позволяют заполнять доп. информацию, загружать изображения к банкам, причём у каждой категории могут быть свои собственные доп. поля.", makeDropDown( array( "on" => "Да", "off" => "Нет" ), "save_con[field_on]", $Banki->Config['field_on'] ) );

showRow( "Кэширование", "Кэширование позволяет снизить нагрузку на БД кэшируя вывод результатов.", makeDropDown( array( "yes" => "Да", "no" => "Нет" ), "save_con[cache]", $Banki->Config['cache'] ) );

showRow( "Кэшировать счётчик просмотров", "При каждом просмотре банка обновляется счётчик просмотров в базе данных. Данное действие можно оптимизировать, собирав все просмотры в спец. файл, а затем один раз в 2 часа обновлять.", makeDropDown( array( "yes" => "Да", "no" => "Нет" ), "save_con[cache_views]", $Banki->Config['cache_views'] ) );

showRow( "Время жизни кэша", "Введите в минутах время жизни кэша, по истичении которых, он будет автоматически обновляться.", "<input type=\"text\" name=\"save_con[cache_time]\" value=\"{$Banki->Config['cache_time']}\" class=\"form-control\" />" );

showRow( "Максимум подкатегорий", "Введите максимальное количество подкатегорий, которые могут вывестись. Если количество подкатегорий привысит лимит, они будут выведены через запятую (уже без их подкатегорий). Для отмены ограничения оставьте 0.", "<input type=\"text\" name=\"save_con[main_page_max_echo_thread_cats]\" value=\"{$Banki->Config['main_page_max_echo_thread_cats']}\" class=\"form-control\" />" );

showRow( "Выводить последние банки", "Включить вывод последних банков на главной странице модуля?", makeDropDown( array( "on" => "Включить", "off" => "Выключить" ), "save_con[main_page_on_last]", $Banki->Config['main_page_on_last'] ) );

showRow( "Количество банков на главной", "Введите количество банков, выводящихся на главной странице модуля.", "<input type=\"text\" name=\"save_con[main_page_max_last]\" value=\"{$Banki->Config['main_page_max_last']}\" class=\"form-control\" />" );

showRow( "Банков на страницу", "Введите количество банков на одну страницу.", "<input type=\"text\" name=\"save_con[view_cat_on_page]\" value=\"{$Banki->Config['view_cat_on_page']}\" class=\"form-control\" />" );

showRow( "Количество символов в тексте", "Введите максимальное количество символов, которые могут вывестись из одного банка.", "<input type=\"text\" name=\"save_con[short_echo_max_strlen]\" value=\"{$Banki->Config['short_echo_max_strlen']}\" class=\"form-control\" />" );

showRow( "HTML форматирование", "Включить HTML форматирование в краткой версии банка, при выключенной опции будет разрешён только тег переноса строк \"&lt;br /&gt;\".", makeDropDown( array( "yes" => "Разрешить", "no" => "Запретить" ), "save_con[short_echo_allowhtml]", $Banki->Config['short_echo_allowhtml'] ) );

showRow( "Изображения", "Введите максимальное количество загружаемых изображений при добавлении или редактировании. Поставьте \"0\" для запрета загрузки изображений.", "<input type=\"text\" name=\"save_con[add_post_max_photo]\" value=\"{$Banki->Config['add_post_max_photo']}\" class=\"form-control\" />" );

showRow( "Макс. вес изображения", "Введите максимальный вес загружаемой картинки в KB.", "<input type=\"text\" name=\"save_con[add_post_size_photo]\" value=\"{$Banki->Config['add_post_size_photo']}\" class=\"form-control\" />" );

showRow( "Макс. размер изображения", "Введите максимальный размер наибольшей стороны загружаемой картинки в пикселях для её сужения.", "<input type=\"text\" name=\"save_con[add_post_thumb_photo]\" value=\"{$Banki->Config['add_post_thumb_photo']}\" class=\"form-control\" />" );

showRow( "Расширения изображений", "Введите через запятую расширения изображений, которые будут разрешены для загрузки на сервер.", "<input type=\"text\" name=\"save_con[add_post_photo_type]\" value=\"{$Banki->Config['add_post_photo_type']}\" class=\"form-control\" />" );

showRow( "BB code редактор", "Разрешить использовать BB Code редактор для оформления текста банка?", makeDropDown( array( "yes" => "Да", "no" => "Нет" ), "save_con[add_post_bbcode]", $Banki->Config['add_post_bbcode'] ) );

showRow( "Количество просмотров", "Включить подсчёт и вывод количества просмотров конкретного банка?", makeDropDown( array( "yes" => "Включить", "no"=>"Выключить" ), "save_con[echo_post_views]", $Banki->Config['echo_post_views'] ) );

showRow( "Временной блок рекомендуем", "Разрешить функцию вывода банков через - Блоки - на определенное время.", makeDropDown( array( "hand" => "Да", "no"=>"Запретить" ), "save_con[echo_post_color]", $Banki->Config['echo_post_color'] ) );

showRow( "Использовать отзывы", "Разрешить просматривать и добавлять отзывы к банкам?", makeDropDown( array( "yes"=>"Да", "no"=>"Нет" ), "save_con[com_on]", $Banki->Config['com_on'] ) );

showRow( "Использовать навигацию", "Разбивать отзывы на страницу, если они превышают заданное колличество?", makeDropDown( array( "yes"=>"Да", "no"=>"Нет" ), "save_con[com_navigation_on]", $Banki->Config['com_navigation_on'] ) );

showRow( "Отзывов на страницу", "Максимальное колличество отзывов на страницу. Будет действовать только в том случае, если используется навигация.", "<input type=\"text\" name=\"save_con[com_max_on_page]\" value=\"{$Banki->Config['com_max_on_page']}\" class=\"form-control\" />" );

showRow( "Защита от спама", "Временной период в секундах, когда пользователь снова сможет написать отзыв. Если не хотите использовать данный метод, то поставьте 0.", "<input type=\"text\" name=\"save_con[com_antispam]\" value=\"{$Banki->Config['com_antispam']}\" class=\"form-control\" />" );

showRow( "Удаление отзывов", "Каким способом удалять отзывы:<br /><br />
		
<strong>Маска удаления</strong> - Отзыву будет помечен статус удалённый. На отзыв нельзя будет отвечать, вместо текста комментария будет выводиться уведомлении об удалении. Пользователи смогут видеть, что комментарий удалён, и не будет недоразумений при выводе ответа не него, то есть изначальная структура сохранится. Вы в админцентре сможете посмотреть исходный текст комментария.<br /><br />

<strong>Полное удаление</strong> - Отзыв будет удалён из базы данных, кол-во отзывов к теме пересчетается. Ответы на отзывы будут выводиться, однако может возникнуть непонятия другим пользвателям, почему автор так написал. Структура нарушается.
		
", makeDropDown( array( "mask"=>"Маска удаления", "full"=>"Полное удаление" ), "save_con[com_del]", $Banki->Config['com_del'] ) );

showRow( "Добавлять могут", "Выберите группы пользователей, которым будет разрешено оставлять отзывы.","<div style=\"padding: 5px 0px 5px 0px;\"><select name=\"save_con[com_groups_add][]\" multiple>".SelectGroup( explode( ",", $Banki->Config['com_groups_add'] ), array( 5 ) )."</select></div>" );

showRow( "Изменять и удалять могут", "Выберите группы пользователей, которым будет разрешено изменять и удалять отзывы.","<div style=\"padding: 5px 0px 5px 0px;\"><select name=\"save_con[com_groups_moder][]\" multiple>".SelectGroup( explode( ",", $Banki->Config['com_groups_moder'] ), array( 5 ) )."</select></div>" );


		echo "</div></div></tbody>
				</table></div>";
closetable();
echo <<<HTML

<div class="panel-footer hidden-xs">
		<div class="pull-left">
		<ul class="pagination pagination-sm">
			<span id="save"></span>
			<input type="submit" name="submit" value="Сохранить" class="btn bg-teal btn-sm btn-raised position-right legitRipple" />
			
		</ul>
		</div>
		<div class="pull-right">
			<span id="cache_status"></span>
			<input type="button" value="Очистить кэш" id="cache_btn" onclick="CleareCache(); return false;" class="btn bg-teal btn-sm btn-raised position-right legitRipple" />
		</div>
	</div>	

</form>
HTML;








echo EchoAJAX();
echo EchoJQueryUpload();
echofooter();


?>