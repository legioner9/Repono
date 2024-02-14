<?php



if( !defined( "DATALIFEENGINE" ) ) die( "Hacking attempt!" );



//--------------------------------------------------=-=-=-=-=
//	Настройка метатитлов
//--------------------------------------------------=-=-=-=-=

$module['title'][] = $Offers->Config['tit_main'] ;
$module['speedbar'][] = $Offers->Config['spe_main'];
$metatags['description'] = $Offers->Config['des_main'];
$metatags['keywords'] = $Offers->Config['key_main'];

$full_links = $config['http_home_url']."offers/";
$canonical = $full_links;
//--------------------------------------------------=-=-=-=-=
//	Поиск при необходимости
//--------------------------------------------------=-=-=-=-=

$MainThisSearch = false;
if( $_REQUEST['OffersSearch'] == "---" ) $_REQUEST['OffersSearch'] = "";


if( $MainThisSearch === false )
	{
		if( $Offers->Config['rss_on'] == "yes" )
			{
				$rssLink = $MainLink;
				$rssLink .= $Offers->AltUrl === true ? "rss.xml" : "&type=rss";
			}
		
		//--------------------------------------------------=-=-=-=-=
		//	Генерация категорий
		//--------------------------------------------------=-=-=-=-=
		
		
		
		//--------------------------------------------------=-=-=-=-=
		//	Последние новости
		//--------------------------------------------------=-=-=-=-=
		
		$order = array();
		if( $Offers->Config['echo_post_color'] != "no" ) $order[] = "`color_date` DESC";
		$order[] = "`sort` DESC";
		$order = implode( ", ", $order );
		
		if( $Offers->Config['main_page_on_last'] == "on" )
			{
				$MaxPost = $Offers->Config['main_page_max_last'] > 0 ? intval( $Offers->Config['main_page_max_last'] ) : 1;
				$NewsList = array(
						
					"template"		=> "offers/main/offers.short.tpl",
					"template_nav"	=> "offers/main/navigation.tpl",
					"template_info"	=> "offers/main/info.tpl",
					"tpl_compile"	=> "offers_content",
					"cashe_folder"	=> "",
					"cashe_file"	=> "main_last_post.tmp",
					"cache"			=> true,
					"sql_count"		=> "SELECT COUNT(*) as count FROM ".PREFIX."_offers_post WHERE approve='1'",
					"sql_query"		=> "SELECT * FROM ".PREFIX."_offers_post WHERE approve='1' ORDER BY {$order} LIMIT 0,{$MaxPost}",
					"num"			=> $MaxPost,
					"nav"			=> false,
					"search_info"	=> true,
					"search_text"	=> "",
					"no_news_error" => "Предложений не обнаружено.",
					"allow_edit"	=> false,							
				);
							
				require( DLEPlugins::Check(ENGINE_DIR."/modules/offers/list.post.php") );
			}
	}

//--------------------------------------------------=-=-=-=-=
//	Загрзука шаблона
//--------------------------------------------------=-=-=-=-=

$Folder = "main";
$OffersLoadMainTpl = true;
if( $Offers->Config['fastsearch_on'] != "on" ) $OffersAllowSearch = false;

?>