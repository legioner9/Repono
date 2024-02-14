<?php
/*
=====================================================
 Файл: category.php
=====================================================
 Данный код защищен авторскими правами
=====================================================
 Назначение: вывод категории
=====================================================
*/

if( !defined( "DATALIFEENGINE" ) ) die( "Hacking attempt!" );

//--------------------------------------------------=-=-=-=-=
//	Инициализируем категорию
//--------------------------------------------------=-=-=-=-=

if( $Banki->DefinitionCat() )
	{

		
		$OnPage = $Banki->Config['view_cat_on_page'] > 0 ? intval( $Banki->Config['view_cat_on_page'] ) : 1;
		
		//--------------------------------------------------=-=-=-=-=
		//	Настройка метатитлов
		//--------------------------------------------------=-=-=-=-=
		
		$SpeedBarCat = $Banki->SpeedBarCat( $Banki->RequestCat );
		$ThreadCatForSql = $Banki->SqlThreadCat( $Banki->RequestCat );
		
		for( $i = count( $SpeedBarCat ); $i > 0; $i-- ) $module['title'][] = $SpeedBarCat[ ( $i - 1 ) ]['title'];
		for( $i = count( $SpeedBarCat ); $i > 0; $i-- ) $module['speedbar'][] = $SpeedBarCat[ ( $i - 1 ) ]['title_h'];
		
		//--------------------------------------------------=-=-=-=-=
		//	Смотрим, какую папку с шаблонами нам грузить
		//--------------------------------------------------=-=-=-=-=
		
		$RowCat = $Banki->DB['category'][ $Banki->RequestCat ];
		$Folder = $RowCat['template'] != "" ? totranslit( $RowCat['template'] ) : "default";
		$BankiCategory = $RowCat['id'];
		
		//--------------------------------------------------=-=-=-=-=
		//	Поиск при необходимости
		//--------------------------------------------------=-=-=-=-=
		

		if( ( $_REQUEST['BankiSearch'] != "" || $_REQUEST['banki_type'] != "" ) && $Banki->Config['fastsearch_on'] == "on" )
			{
				if( isset( $_REQUEST['submit_search'] ) ) $_REQUEST['page'] = 1;
				$SearchTextForm = $Banki->FilterSearchText( $_REQUEST['BankiSearch'] );
				$Story = $db->safesql( $SearchTextForm );
				$PageLink = $Banki->ReturnLinkCategory( $Banki->RequestCat );
				
				$SqlSearch = array();
				if( $Story ) $SqlSearch[] = "( `title` LIKE '%{$Story}%' OR `text` LIKE '%{$Story}%' )";

				
				if( count( $SqlSearch ) > 0 )
					{
						$SqlSearch = "AND ".implode( " AND ", $SqlSearch );
						$NoNewsError = "<div class=\"main-bank-info\">По вашему запросу банков не найдено.</div>";
						$SearchText = "<div class=\"main-bank-info\">По вашему запросу, найдено {posts} банка(ов).</div>";
						$PageLink = "{$PageLink}search/".( $SearchTextForm ? urlencode( htmlspecialchars( $SearchTextForm, ENT_QUOTES, $config['charset'] ) ) : "---" )."/page/{page}/";
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

				
				$PageLink = $Banki->ReturnLinkCategory( $Banki->RequestCat );
				$PageLink = "{$PageLink}page/{page}";
				$NoNewsError = "Банков не обнаружено.";
				$SearchInfo = false;
			}
			
		
		
		
		//--------------------------------------------------=-=-=-=-=
		//	Генерация объявлений категории и её подкатегорий
		//--------------------------------------------------=-=-=-=-=
		
		$order = array();
		if( $Banki->Config['echo_post_color'] != "no" ) $order[] = "`color_date` DESC";
		$order[] = "`rate` DESC";
		$order = implode( ", ", $order );
		
		$ThreadCatForSql = implode( "|", $ThreadCatForSql );

		$NewsList = array(
		
			"template"		=> "banki/{$Folder}/banki.short.tpl",
			"template_nav"	=> "banki/{$Folder}/navigation.tpl",
			"template_info"	=> "banki/{$Folder}/info.tpl",
			"tpl_compile"	=> "banki_content",
			"cashe_folder"	=> "category/",
			"cashe_file"	=> "cashe_{$Banki->RequestCat}.tmp",
			"sql_count"		=> "SELECT COUNT(*) as count FROM ".PREFIX."_banki_post WHERE category regexp '[[:<:]]({$ThreadCatForSql})[[:>:]]' AND approve='1' {$SqlSearch}",
			"sql_query"		=> "SELECT * FROM ".PREFIX."_banki_post WHERE category regexp '[[:<:]]({$ThreadCatForSql})[[:>:]]' AND approve='1' {$SqlSearch} ORDER BY {$order} {limit}",
			"num"			=> $OnPage,
			"nav"			=> $PageLink,
			"search_info"	=> $SearchInfo,
			"search_text"	=> $SearchText,
			"no_news_error" => $NoNewsError,
			
		);
		
		
			
		require( ENGINE_DIR."/modules/banki/list.post.php" );
		
		// Разрешаем вывод формы поиска
		$BankiLoadMainTpl = true;
		if( $Banki->Config['fastsearch_on'] != "on" ) $BankiAllowSearch = false;
		$full_links = $config['http_home_url']."banki/" . $BankiCategory = $RowCat['alt_name']."/";
		$canonical = $full_links;
		// Ключевые слова и описание для поисковиков
		if( $RowCat['title_h'] ) $metatags['title_h'] = stripslashes( $RowCat['title_h'] );
		if( $RowCat['description'] ) $metatags['description'] = stripslashes( $RowCat['description'] );
		if( $RowCat['keywords'] ) $metatags['keywords'] = stripslashes( $RowCat['keywords'] );
		if( $RowCat['opisanie'] ) $metatags['opisanie'] = stripslashes( $RowCat['opisanie'] );
		if( $RowCat['opisanie_up'] ) $metatags['opisanie_up'] = stripslashes( $RowCat['opisanie_up'] );
	}

//--------------------------------------------------=-=-=-=-=
//	В случае ошибки, выводим информацию
//--------------------------------------------------=-=-=-=-=

		else
	{
		$tpl->Load_Template( "info.tpl" );
		$tpl->set( "{title}", "Ошибка" );
		$tpl->set( "{error}", "Категория не найдена" );
		$tpl->compile( "banki" );
		$tpl->clear();
	}

?>