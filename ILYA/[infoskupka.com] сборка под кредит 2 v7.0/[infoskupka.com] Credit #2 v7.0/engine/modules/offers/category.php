<?php

if( !defined( "DATALIFEENGINE" ) ) die( "Hacking attempt!" );

//--------------------------------------------------=-=-=-=-=
//	Инициализируем категорию
//--------------------------------------------------=-=-=-=-=

if( $Offers->DefinitionCat() )
	{

		
		$OnPage = $Offers->Config['view_cat_on_page'] > 0 ? intval( $Offers->Config['view_cat_on_page'] ) : 1;
		
		//--------------------------------------------------=-=-=-=-=
		//	Настройка метатитлов
		//--------------------------------------------------=-=-=-=-=
		
		$SpeedBarCat = $Offers->SpeedBarCat( $Offers->RequestCat );
		$ThreadCatForSql = $Offers->SqlThreadCat( $Offers->RequestCat );
		
		$module['title'][] = $SpeedBarCat[ ( $i - 1 ) ]['title'];
		$module['speedbar'][] = $SpeedBarCat[ ( $i - 1 ) ]['title_h'];
		
		
		
		//--------------------------------------------------=-=-=-=-=
		//	Смотрим, какую папку с шаблонами нам грузить
		//--------------------------------------------------=-=-=-=-=
		
		$RowCat = $Offers->DB['category'][ $Offers->RequestCat ];
		$Folder = $RowCat['template'] != "" ? totranslit( $RowCat['template'] ) : "default";
		$OffersCategory = $RowCat['id'];
		
		//--------------------------------------------------=-=-=-=-=
		//	Поиск при необходимости
		//--------------------------------------------------=-=-=-=-=
		
			
		
		if( $Offers->Config['rss_on'] == "yes" )
			{
				$rssLink = $Offers->ReturnLinkCategory( $Offers->RequestCat );
				$rssLink .= $Offers->AltUrl === true ? "rss.xml" : "&type=rss";
			}
		
		//--------------------------------------------------=-=-=-=-=
		//	Генерация объявлений категории и её подкатегорий
		//--------------------------------------------------=-=-=-=-=
		
		$order = array();
		if( $Offers->Config['echo_post_color'] != "no" ) $order[] = "`color_date` DESC";
		$order[] = "`sort`";
		$order = implode( ", ", $order );
		
		$ThreadCatForSql = implode( "|", $ThreadCatForSql );

		$NewsList = array(
		
			"template"		=> "offers/{$Folder}/offers.short.tpl",
			"template_nav"	=> "offers/{$Folder}/navigation.tpl",
			"template_info"	=> "offers/{$Folder}/info.tpl",
			"tpl_compile"	=> "offers_content",
			"cashe_folder"	=> "category/",
			"cashe_file"	=> "cashe_{$Offers->RequestCat}.tmp",
			"sql_count"		=> "SELECT COUNT(*) as count FROM ".PREFIX."_offers_post WHERE category regexp '[[:<:]]({$ThreadCatForSql})[[:>:]]' AND approve='1' {$SqlSearch}",
			"sql_query"		=> "SELECT * FROM ".PREFIX."_offers_post WHERE category regexp '[[:<:]]({$ThreadCatForSql})[[:>:]]' AND approve='1' {$SqlSearch} ORDER BY {$order} {limit}",
			"num"			=> $OnPage,
			"nav"			=> $PageLink,
			"search_info"	=> $SearchInfo,
			"search_text"	=> $SearchText,
			"no_news_error" => $NoNewsError,
			
		);
		
		
			
		require( ENGINE_DIR."/modules/offers/list.post.php" );
		$full_links = $config['http_home_url']."offers/" . $OffersCategory = $RowCat['alt_name']."/";
		$canonical = $full_links;
		// Разрешаем вывод формы поиска
		$OffersLoadMainTpl = true;
		if( $Offers->Config['fastsearch_on'] != "on" ) $OffersAllowSearch = false;
		
		// Ключевые слова и описание для поисковиков
		if( $RowCat['title_h'] ) $metatags['title_h'] = stripslashes( $RowCat['title_h'] );
		if( $RowCat['opisanie'] ) $metatags['opisanie'] = $RowCat['opisanie'];
		if( $RowCat['opisanie_up'] ) $metatags['opisanie_up'] = $RowCat['opisanie_up'];
		if( $RowCat['description'] ) $metatags['description'] = stripslashes( $RowCat['description'] );
		if( $RowCat['keywords'] ) $metatags['keywords'] = stripslashes( $RowCat['keywords'] );
	}

//--------------------------------------------------=-=-=-=-=
//	В случае ошибки, выводим информацию
//--------------------------------------------------=-=-=-=-=

		else
	{
		$tpl->Load_Template( "info.tpl" );
		$tpl->set( "{title}", "Ошибка" );
		$tpl->set( "{error}", "Категория не найдена" );
		$tpl->compile( "offers" );
		$tpl->clear();
	}

?>