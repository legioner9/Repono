<?php


if( !defined( "DATALIFEENGINE" ) ) die( "Hacking attempt!" );

//--------------------------------------------------=-=-=-=-=
//	Инициализируем категорию
//--------------------------------------------------=-=-=-=-=

if( $Mfo->DefinitionCat() )
	{

		
		$OnPage = $Mfo->Config['view_cat_on_page'] > 0 ? intval( $Mfo->Config['view_cat_on_page'] ) : 1;
		
		//--------------------------------------------------=-=-=-=-=
		//	Настройка метатитлов
		//--------------------------------------------------=-=-=-=-=
		
		$SpeedBarCat = $Mfo->SpeedBarCat( $Mfo->RequestCat );
		$ThreadCatForSql = $Mfo->SqlThreadCat( $Mfo->RequestCat );
		
		for( $i = count( $SpeedBarCat ); $i > 0; $i-- ) $module['title'][] = $SpeedBarCat[ ( $i - 1 ) ]['title'];
		for( $i = count( $SpeedBarCat ); $i > 0; $i-- ) $module['speedbar'][] = $SpeedBarCat[ ( $i - 1 ) ]['title_h'];
		
		//--------------------------------------------------=-=-=-=-=
		//	Смотрим, какую папку с шаблонами нам грузить
		//--------------------------------------------------=-=-=-=-=
		
		$RowCat = $Mfo->DB['category'][ $Mfo->RequestCat ];
		$Folder = $RowCat['template'] != "" ? totranslit( $RowCat['template'] ) : "default";
		$MfoCategory = $RowCat['id'];
		
		//--------------------------------------------------=-=-=-=-=
		//	Поиск при необходимости
		//--------------------------------------------------=-=-=-=-=
		
		if( $_REQUEST['MfoSearch'] == "---" ) $_REQUEST['MfoSearch'] = "";
		if( $_REQUEST['mfo_type'] == "---" ) $_REQUEST['mfo_type'] = "";
		if( ( $_REQUEST['MfoSearch'] != "" || $_REQUEST['mfo_type'] != "" ) && $Mfo->Config['fastsearch_on'] == "on" )
			{
				if( isset( $_REQUEST['submit_search'] ) ) $_REQUEST['page'] = 1;
				$SearchTextForm = $Mfo->FilterSearchText( $_REQUEST['MfoSearch'] );
				$Story = $db->safesql( $SearchTextForm );
				$MfoType = intval( $_REQUEST['mfo_type'] );
				$PageLink = $Mfo->ReturnLinkCategory( $Mfo->RequestCat );
				
				$SqlSearch = array();
				if( $Story ) $SqlSearch[] = "( `title` LIKE '%{$Story}%' OR `text` LIKE '%{$Story}%' )";
				if( $MfoType ) $SqlSearch[] = "`mfo_type`='{$MfoType}'";
				
				if( count( $SqlSearch ) > 0 )
					{
						$SqlSearch = "AND ".implode( " AND ", $SqlSearch );
						$NoNewsError = "<div class=\"main-bank-info\">По вашему запросу МФО не найдено.</div>";
						$SearchText = "<div class=\"main-bank-info\">По вашему запросу, найдено {posts} МФО.</div>";
						$PageLink = "{$PageLink}search/".( $SearchTextForm ? urlencode( htmlspecialchars( $SearchTextForm, ENT_QUOTES, $config['charset'] ) ) : "---" )."/".( $MfoType ? $MfoType : "---" )."/page/{page}";
						$SearchInfo = true;
					}
						else
					{
						$SqlSearch = "";	
					}
			}
		
		//--------------------------------------------------=-=-=-=-=
		//	Если нет поиска, то просто выводим объявления категории
		//--------------------------------------------------=-=-=-=-=
		
				else
			{
				
				$PageLink = $Mfo->ReturnLinkCategory( $Mfo->RequestCat );
				$PageLink = "{$PageLink}page/{page}";
				$NoNewsError = "<div class=\"main-bank-info\">МФО не обнаружено.</div>";
				$SearchInfo = false;
			}
			
		
		if( $Mfo->Config['rss_on'] == "yes" )
			{
				$rssLink = $Mfo->ReturnLinkCategory( $Mfo->RequestCat );
				$rssLink .= $Mfo->AltUrl === true ? "rss.xml" : "&type=rss";
			}
		
		//--------------------------------------------------=-=-=-=-=
		//	Генерация объявлений категории и её подкатегорий
		//--------------------------------------------------=-=-=-=-=
		
		$order = array();
		if( $Mfo->Config['echo_post_color'] != "no" ) $order[] = "`color_date` DESC";
		$order[] = "`rate` DESC";
		$order = implode( ", ", $order );
		
		$ThreadCatForSql = implode( "|", $ThreadCatForSql );

		$NewsList = array(
		
			"template"		=> "mfo/{$Folder}/mfo.short.tpl",
			"template_nav"	=> "mfo/{$Folder}/navigation.tpl",
			"template_info"	=> "mfo/{$Folder}/info.tpl",
			"tpl_compile"	=> "mfo_content",
			"cashe_folder"	=> "category/",
			"cashe_file"	=> "cashe_{$Mfo->RequestCat}.tmp",
			"sql_count"		=> "SELECT COUNT(*) as count FROM ".PREFIX."_mfo_post WHERE category regexp '[[:<:]]({$ThreadCatForSql})[[:>:]]' AND approve='1' {$SqlSearch}",
			"sql_query"		=> "SELECT * FROM ".PREFIX."_mfo_post WHERE category regexp '[[:<:]]({$ThreadCatForSql})[[:>:]]' AND approve='1' {$SqlSearch} ORDER BY {$order} {limit}",
			"num"			=> $OnPage,
			"nav"			=> $PageLink,
			"search_info"	=> $SearchInfo,
			"search_text"	=> $SearchText,
			"no_news_error" => $NoNewsError,
			
		);
		
		
			
		require( ENGINE_DIR."/modules/mfo/list.post.php" );
		
		// Разрешаем вывод формы поиска
		$MfoLoadMainTpl = true;
		if( $Mfo->Config['fastsearch_on'] != "on" ) $MfoAllowSearch = false;
		$full_links = $config['http_home_url']."banki/" . $MfoCategory = $RowCat['alt_name']."/";
		$canonical = $full_links;
		// Ключевые слова и описание для поисковиков
		if( $RowCat['title_h'] ) $metatags['title_h'] = stripslashes( $RowCat['title_h'] );
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
		$tpl->compile( "mfo" );
		$tpl->clear();
	}

?>