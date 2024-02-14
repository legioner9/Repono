<?php


if( !defined( "DATALIFEENGINE" ) ) die( "Hacking attempt!" );


//--------------------------------------------------=-=-=-=-=
//	Настройка метатитлов
//--------------------------------------------------=-=-=-=-=

$module['title'][] = $Mfo->Config['tit_main'] ;
$module['speedbar'][] = $Mfo->Config['spe_main'];
$metatags['description'] = $Mfo->Config['des_main'];
$metatags['keywords'] = $Mfo->Config['key_main'];
$full_links = $config['http_home_url']."offers/";
$canonical = $full_links;
//--------------------------------------------------=-=-=-=-=
//	Поиск при необходимости
//--------------------------------------------------=-=-=-=-=

$MainThisSearch = false;
if( $_REQUEST['MfoSearch'] == "---" ) $_REQUEST['MfoSearch'] = "";
if( $_REQUEST['mfo_type'] == "---" ) $_REQUEST['mfo_type'] = "";
if( ( $_REQUEST['MfoSearch'] != "" || $_REQUEST['mfo_type'] != "" ) && $Mfo->Config['fastsearch_on'] == "on" )
	{
		$module['title'][] = "Поиск по МФО";
		$module['speedbar'][] = "Поиск по МФО";
		
		if( isset( $_REQUEST['submit_search'] ) ) $_REQUEST['page'] = 1;
		$SearchTextForm = $Mfo->FilterSearchText( $_REQUEST['MfoSearch'] );
		$Story = $db->safesql( $SearchTextForm );
		$MfoType = intval( $_REQUEST['mfo_type'] );
				
		$SqlSearch = array();
		if( $Story ) $SqlSearch[] = "( `title` LIKE '%{$Story}%' OR `text` LIKE '%{$Story}%' )";
		if( $MfoType ) $SqlSearch[] = "`mfo_type`='{$MfoType}'";
		
		if( count( $SqlSearch ) > 0 )
			{
				$MainThisSearch = true;
				$SqlSearch = "AND ".implode( " AND ", $SqlSearch );
				$OnPage = $Mfo->Config['view_cat_on_page'] > 0 ? intval( $Mfo->Config['view_cat_on_page'] ) : 1;
				$CancelSearch = $Mfo->AltUrl ? "/mfo/" : "/index.php?do=mfo";
				
				$PageLink = "/mfo/search/".( $SearchTextForm ? urlencode( htmlspecialchars( $SearchTextForm, ENT_QUOTES, $config['charset'] ) ) : "---" )."/".( $MfoType ? $MfoType : "---" )."/page/{page}";
				$NewsList = array(
				
					"template"		=> "mfo/main/mfo.short.tpl",
					"template_nav"	=> "mfo/main/navigation.tpl",
					"template_info"	=> "mfo/main/info.tpl",
					"tpl_compile"	=> "mfo_content",
					"cashe_folder"	=> "",
					"cashe_file"	=> "",
					"cache"			=> false,
					"sql_count"		=> "SELECT COUNT(*) as count FROM ".PREFIX."_mfo_post WHERE approve='1' {$SqlRegion} {$SqlSearch}",
					"sql_query"		=> "SELECT * FROM ".PREFIX."_mfo_post WHERE approve='1' {$SqlRegion} {$SqlSearch} ORDER BY date DESC {limit}",
					"num"			=> $OnPage,
					"nav"			=> $PageLink,
					"search_info"	=> true,
					"search_text"	=> "<div class=\"main-bank-info\">По вашему запросу, найдено {posts} МФО.</div>",
					"no_news_error" => "<div class=\"main-bank-info\">По вашему запросу МФО не найдено.</div>",
					
				);
					
				require( ENGINE_DIR."/modules/mfo/list.post.php" );
			}
	}


if( $MainThisSearch === false )
	{
		
		
		//--------------------------------------------------=-=-=-=-=
		//	Генерация категорий
		//--------------------------------------------------=-=-=-=-=
		
		
		
		//--------------------------------------------------=-=-=-=-=
		//	Последние новости
		//--------------------------------------------------=-=-=-=-=
		
		$order = array();
		if( $Mfo->Config['echo_post_color'] != "no" ) $order[] = "`color_date` DESC";
		$order[] = "`rate` DESC";
		$order = implode( ", ", $order );
		
		if( $Mfo->Config['main_page_on_last'] == "on" )
			{
				$MaxPost = $Mfo->Config['main_page_max_last'] > 0 ? intval( $Mfo->Config['main_page_max_last'] ) : 1;
				$NewsList = array(
						
					"template"		=> "mfo/main/mfo.short.tpl",
					"template_nav"	=> "mfo/main/navigation.tpl",
					"template_info"	=> "mfo/main/info.tpl",
					"tpl_compile"	=> "mfo_content",
					"cashe_folder"	=> "",
					"cashe_file"	=> "main_last_post.tmp",
					"cache"			=> true,
					"sql_count"		=> "SELECT COUNT(*) as count FROM ".PREFIX."_mfo_post WHERE approve='1'",
					"sql_query"		=> "SELECT * FROM ".PREFIX."_mfo_post WHERE approve='1' ORDER BY {$order} LIMIT 0,{$MaxPost}",
					"num"			=> $MaxPost,
					"nav"			=> false,
					"search_info"	=> true,
					"search_text"	=> "",
					"no_news_error" => "<div class=\"main-bank-info\">МФО не обнаружено.</div>",
					"allow_edit"	=> false,							
				);
							
				require( ENGINE_DIR."/modules/mfo/list.post.php" );
			}
	}
$full_links = $Mfo->ReturnLinkCategory( $id ); 
$canonical = $full_links;
//--------------------------------------------------=-=-=-=-=
//	Загрзука шаблона
//--------------------------------------------------=-=-=-=-=

$Folder = "main";
$MfoLoadMainTpl = true;
if( $Mfo->Config['fastsearch_on'] != "on" ) $MfoAllowSearch = false;

?>