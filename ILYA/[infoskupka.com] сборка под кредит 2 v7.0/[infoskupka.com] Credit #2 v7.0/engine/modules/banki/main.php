<?php


if( !defined( "DATALIFEENGINE" ) ) die( "Hacking attempt!" );


//--------------------------------------------------=-=-=-=-=
//	Настройка метатитлов
//--------------------------------------------------=-=-=-=-=

$module['title'][] = $Banki->Config['tit_main'] ;
$module['speedbar'][] = $Banki->Config['spe_main'];
$metatags['description'] = $Banki->Config['des_main'];
$metatags['keywords'] = $Banki->Config['key_main'];
$full_links = $config['http_home_url']."offers/";
$canonical = $full_links;
//--------------------------------------------------=-=-=-=-=
//	Поиск при необходимости
//--------------------------------------------------=-=-=-=-=

$MainThisSearch = false;

if( ( $_REQUEST['BankiSearch'] != "" || $_REQUEST['banki_type'] != "" ) && $Banki->Config['fastsearch_on'] == "on" )
	{
		$module['title'][] = "Поиск по банкам ";
		$module['speedbar'][] = "Поиск по банкам";
		
		if( isset( $_REQUEST['submit_search'] ) ) $_REQUEST['page'] = 1;
		$SearchTextForm = $Banki->FilterSearchText( $_REQUEST['BankiSearch'] );
		$Story = $db->safesql( $SearchTextForm );

				
		$SqlSearch = array();
		if( $Story ) $SqlSearch[] = "( `title` LIKE '%{$Story}%' OR `text` LIKE '%{$Story}%' )";
		if( $BankiType ) $SqlSearch[] = "`banki_type`='{$BankiType}'";
		
		if( count( $SqlSearch ) > 0 )
			{
				$MainThisSearch = true;
				$SqlSearch = "AND ".implode( " AND ", $SqlSearch );
				$OnPage = $Banki->Config['view_cat_on_page'] > 0 ? intval( $Banki->Config['view_cat_on_page'] ) : 1;
				$CancelSearch = $Banki->AltUrl ? "/banki/" : "/index.php?do=banki";
				
				$PageLink = "/banki/search/".( $SearchTextForm ? urlencode( htmlspecialchars( $SearchTextForm, ENT_QUOTES, $config['charset'] ) ) : "" )."page/{page}";
				$NewsList = array(
				
					"template"		=> "banki/main/banki.short.tpl",
					"template_nav"	=> "banki/main/navigation.tpl",
					"template_info"	=> "banki/main/info.tpl",
					"tpl_compile"	=> "banki_content",
					"cashe_folder"	=> "",
					"cashe_file"	=> "",
					"cache"			=> false,
					"sql_count"		=> "SELECT COUNT(*) as count FROM ".PREFIX."_banki_post WHERE approve='1' {$SqlRegion} {$SqlSearch}",
					"sql_query"		=> "SELECT * FROM ".PREFIX."_banki_post WHERE approve='1' {$SqlRegion} {$SqlSearch} ORDER BY date DESC {limit}",
					"num"			=> $OnPage,
					"nav"			=> $PageLink,
					"search_info"	=> true,
					"search_text"	=> "<div class=\"main-bank-info\">По вашему запросу, найдено {posts} банка(ов).</div>",
					"no_news_error" => "<div class=\"main-bank-info\">По вашему запросу банков не найдено.</div>",
					
				);
					
				require( ENGINE_DIR."/modules/banki/list.post.php" );
			}
	}


if( $MainThisSearch === false )
	{
		
		
		
		
		//--------------------------------------------------=-=-=-=-=
		//	Последние новости
		//--------------------------------------------------=-=-=-=-=
		
		$order = array();
		if( $Banki->Config['echo_post_color'] != "no" ) $order[] = "`color_date` DESC";
		$order[] = "`rate` DESC";
		$order = implode( ", ", $order );
		
		if( $Banki->Config['main_page_on_last'] == "on" )
			{
				$MaxPost = $Banki->Config['main_page_max_last'] > 0 ? intval( $Banki->Config['main_page_max_last'] ) : 1;
				$NewsList = array(
						
					"template"		=> "banki/main/banki.short.tpl",
					"template_nav"	=> "banki/main/navigation.tpl",
					"template_info"	=> "banki/main/info.tpl",
					"tpl_compile"	=> "banki_content",
					"cashe_folder"	=> "",
					"cashe_file"	=> "main_last_post.tmp",
					"cache"			=> true,
					"sql_count"		=> "SELECT COUNT(*) as count FROM ".PREFIX."_banki_post WHERE approve='1'",
					"sql_query"		=> "SELECT * FROM ".PREFIX."_banki_post WHERE approve='1' ORDER BY {$order} LIMIT 0,{$MaxPost}",
					"num"			=> $MaxPost,
					"nav"			=> false,
					"search_info"	=> true,
					"search_text"	=> "",
					"no_news_error" => "<div class=\"main-bank-info\">Банков не обнаружено.</div>",
					"allow_edit"	=> false,							
				);
							
				require( DLEPlugins::Check(ENGINE_DIR."/modules/banki/list.post.php") );
			}
	}
$full_links = $Banki->ReturnLinkCategory( $id ); 
$canonical = $full_links;
//--------------------------------------------------=-=-=-=-=
//	Загрзука шаблона
//--------------------------------------------------=-=-=-=-=

$Folder = "main";
$BankiLoadMainTpl = true;
if( $Banki->Config['fastsearch_on'] != "on" ) $BankiAllowSearch = false;

?>