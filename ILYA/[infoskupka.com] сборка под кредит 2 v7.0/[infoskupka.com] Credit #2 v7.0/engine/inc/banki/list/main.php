<?php


if( !defined( "DATALIFEENGINE" ) ) die( "Hacking attempt!" );

//------------------------------------------------=-=-=-=-=
//	Вывод шапки и навигации
//------------------------------------------------=-=-=-=-=


echoheader( "<i class=\"fa fa-home position-left\"></i><span class=\"text-semibold\">Главная страница модуля - Каталог Банков</span>","<a href=\"$PHP_SELF?mod=banki\">Каталог банков 7.0</a> / Главная страница модуля" );

opentable();
tableheader( "Разделы модуля - Каталог банков" );


if ( !count($stats_arr) ) {

	
	$row = $db->super_query( "SELECT COUNT(*) as count FROM " . PREFIX . "_banki_comments" );
	$stats_arr['count_comments'] = $row['count'];
	
	$row = $db->super_query( "SELECT COUNT(*) as count FROM " . PREFIX . "_banki_comments WHERE approve ='0'" );
	$stats_arr['count_c_app'] = $row['count'];
	
	
	$db->query( "SHOW TABLE STATUS FROM `" . DBNAME . "`" );
	$mysql_size = 0;
	while ( $r = $db->get_array() ) {
		if( strpos( $r['Name'], PREFIX . "_" ) !== false ) $mysql_size += $r['Data_length'] + $r['Index_length'];
	}
	$db->free();
	
	$stats_arr['mysql_size'] = formatsize( $mysql_size );

	if ( $config['allow_cache'] AND !$config['cache_type'] ) {
		file_put_contents (ENGINE_DIR . "/cache/news_adminstats.tmp", json_encode( $stats_arr, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK ), LOCK_EX);
		@chmod( ENGINE_DIR . "/cache/news_adminstats.tmp", 0666 );
	}

}

if( $stats_arr['count_c_app'] ) {
	
	$stats_arr['count_c_app'] = $stats_arr['count_c_app'] . " [ <a class=\"status-info\" href=\"?mod=banki&do=cotziv\">Отзывы ожидают модерации</a> ]";

}

echo <<<HTML
<div class="list-bordered">
	<div class="row box-section">   
	  <div class="col-sm-6 media-list media-list-linked">
		<a class="media-link" href="$PHP_SELF?mod=banki&amp;do=post">
			<div class="media-left"><img src="engine/skins/images/list.png" class="img-lg section_icon"></div>
			<div class="media-body">
				<h6 class="media-heading  text-semibold">Список банков</h6>
				<span class="text-muted text-size-small">Управление банками, редактирование, удаление.</span>
			</div>
		</a>
      </div>
	    <div class="col-sm-6 media-list media-list-linked">
		<a class="media-link" href="$PHP_SELF?mod=banki&amp;do=add_post">
			<div class="media-left"><img src="engine/skins/images/list3.png" class="img-lg section_icon"></div>
			<div class="media-body">
				<h6 class="media-heading  text-semibold">Добавить банк в базу</h6>
				<span class="text-muted text-size-small">Добавление новых банков РФ в каталог.</span>
			</div>
		</a>
      </div>
    </div>

    <div class="row box-section">  
		<div class="col-sm-6 media-list media-list-linked">
		<a class="media-link" href="$PHP_SELF?mod=banki&amp;do=category">
			<div class="media-left"><img src="engine/skins/images/list2.png" class="img-lg section_icon"></div>
			<div class="media-body">
				<h6 class="media-heading  text-semibold">Категории</h6>
				<span class="text-muted text-size-small">Управление категориями, удаление, редактирование, добавление.</span>
			</div>
		</a>
      </div>
	  <div class="col-sm-6 media-list media-list-linked">
		<a class="media-link" href="$PHP_SELF?mod=banki&amp;do=blocks">
			<div class="media-left"><img src="engine/skins/images/list4.png" class="img-lg section_icon"></div>
			<div class="media-body">
				<h6 class="media-heading  text-semibold">Блоки</h6>
				<span class="text-muted text-size-small">Блоки для банков, вывод в любом месте.</span>
			</div>
		</a>
      </div>
    </div>

    <div class="row box-section">   
		<div class="col-sm-6 media-list media-list-linked">
		<a class="media-link" href="$PHP_SELF?mod=banki&amp;do=fields">
			<div class="media-left"><img src="engine/skins/images/list5.png" class="img-lg section_icon"></div>
			<div class="media-body">
				<h6 class="media-heading  text-semibold">Доп. поля</h6>
				<span class="text-muted text-size-small">Дополнительные поля для банков, редактирование, добавление, удаление.</span>
			</div>
		</a>
      </div>
	   <div class="col-sm-6 media-list media-list-linked">
		<a class="media-link" href="$PHP_SELF?mod=banki&amp;do=set">
			<div class="media-left"><img src="engine/skins/images/list6.png" class="img-lg section_icon"></div>
			<div class="media-body">
				<h6 class="media-heading  text-semibold">Настройки</h6>
				<span class="text-muted text-size-small">Настройки модуля - Банки.</span>
			</div>
		</a>
      </div>
    </div>
	

</div>

 

HTML;



closetable();

opentable();
tableheader( "Связанные модули" );
echo <<<HTML

<div class="list-bordered">
	<div class="row box-section">   
	  <div class="col-sm-6 media-list media-list-linked">
		<a class="media-link" href="$PHP_SELF?mod=offers">
			<div class="media-left"><img src="engine/skins/images/offer.png" class="img-lg section_icon"></div>
			<div class="media-body">
				<h6 class="media-heading  text-semibold">Каталог офферов</h6>
				<span class="text-muted text-size-small">Модуль управления офферами.</span>
			</div>
		</a>
      </div>
	    <div class="col-sm-6 media-list media-list-linked">
		<a class="media-link" href="$PHP_SELF?mod=mfo">
			<div class="media-left"><img src="engine/skins/images/mfo.png" class="img-lg section_icon"></div>
			<div class="media-body">
				<h6 class="media-heading  text-semibold">Каталог МФО</h6>
				<span class="text-muted text-size-small">Модуль управления микрофинансовыми организациями.</span>
			</div>
		</a>
      </div>
    </div>
</div>

HTML;

closetable();

echo <<<HTML

<div class="panel panel-default">
<table class="table table-normal">
    <tr>
        <td width="265">Модуль - Каталог банков</td>
        <td>V 7.0 final</td>
    </tr>
	<tr>
		<td>Всего отзывов</td>
		<td>{$stats_arr['count_comments']} [ <a href="$PHP_SELF?mod=banki&do=otziv&action=edit">Редактирование отзывов</a> ]{$edit_comments}</td>
	</tr>
	<tr>
		<td>Модерация отзывов</td>
		<td>{$stats_arr['count_c_app']}</td>
	</tr>
	<tr>
        <td width="265">Разработчик</td>
        <td>Lapinko</td>
    </tr>

</table>
<div class="panel-footer">
	<a href="/banki/" target="_blank" class="btn bg-slate-600 btn-sm btn-raised legitRipple"><i class="fa fa-exclamation-circle"></i> Перейти на сайт</a>
						
	
	</div>
</div>

HTML;

echofooter();
?>