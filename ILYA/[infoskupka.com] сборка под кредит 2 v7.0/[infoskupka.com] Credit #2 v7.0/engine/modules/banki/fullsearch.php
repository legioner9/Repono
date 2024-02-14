<?php
/*
=====================================================
 Каталог фирм:   (http://gdetver.ru)
=====================================================
 Файл: fullsearch.php
=====================================================
 Данный код защищен авторскими правами
=====================================================
 Назначение: расширенный поиск
=====================================================
*/

if( !defined( "DATALIFEENGINE" ) ) die( "Hacking attempt!" );

$Folder = "main";

// Сколько выводить новостей на одну страницу
$OnPage = $Banki->Config['view_cat_on_page'] > 0 ? intval( $Banki->Config['view_cat_on_page'] ) : 1;
		
//	Настройка метатитлов
$module['title'][] = "Расширенный поиск";
$module['speedbar'][] = "Расширенный поиск";

//--------------------------------------------------=-=-=-=-=
//	Генерация запроса в БД
//--------------------------------------------------=-=-=-=-=

$SearchSQL = "";
if( isset( $_REQUEST['submit'] ) )
	{
		if( isset( $_POST['submit'] ) ) $_REQUEST['page'] = 1;
		$category = intval( $_REQUEST['category'] );
		$banki_type = intval( $_REQUEST['banki_type'] );
		$currency = intval( $_REQUEST['currency'] );
		$country = intval( $_REQUEST['country'] );
		$city = intval( $_REQUEST['city'] );
		$SearchPriceOt = intval( $_REQUEST['price_ot'] ) > 0 ? intval( $_REQUEST['price_ot'] ) : "";
		$SearchPriceDo = intval( $_REQUEST['price_do'] ) > 0 ? intval( $_REQUEST['price_do'] ) : "";
		$date = intval( $_REQUEST['date'] );
		$SearchOnPage = $_REQUEST['on_page'] > 0 ? intval( $_REQUEST['on_page'] ) : 10;
		$SearchTitle = htmlspecialchars( $Banki->FilterSearchText( $_REQUEST['title'] ), ENT_QUOTES, $config['charset'] );
		$SearchText = htmlspecialchars( $Banki->FilterSearchText( $_REQUEST['text'] ), ENT_QUOTES, $config['charset'] );
		$thread_cats = intval( $_REQUEST['thread_cats'] );
		$Banki->LoadListCity( $country );
		
		$SearchSQL = array();
		if( $category )
			{
				if( $thread_cats )
					{
						$ThreadCatForSql = $Banki->SqlThreadCat( $category );
						$SearchSQL[] = "`category` IN (".implode( ",", $ThreadCatForSql ).")";
					}
						else
					{
						$SearchSQL[] = "`category`='{$category}'";
					}
			}
		
		if( $SearchTitle ) $SearchSQL[] = "`title` LIKE '%".$db->safesql( $SearchTitle )."%'";
		if( $SearchText ) $SearchSQL[] = "`text` LIKE '%".$db->safesql( $SearchText )."%'";
		if( $SearchPriceOt ) $SearchSQL[] = "`price`>='{$SearchPriceOt}'";
		if( $SearchPriceDo ) $SearchSQL[] = "`price`<='{$SearchPriceDo}'";
		
			
		if( $date )
			{
				$added_time = time() + ( $config['date_adjust'] * 60 );
				$NowDate = date( "Y-m-d", $added_time );
				$NowDateTime = date( "Y-m-d H:i:s", $added_time );
				if( $date == 1 )
					{
						$SearchSQL[] = "`date`>='{$NowDate} 00:00:00'";
						$SearchSQL[] = "`date`<='{$NowDate} 23:59:59'";
					}
				elseif( $date == 2 )
					{
						$DateSql = ( time() + ( $config['date_adjust'] * 60 ) ) - 604800;
						$DateSql = date( "Y-m-d 00:00:00", $DateSql );
						$SearchSQL[] = "`date`>='{$DateSql}'";
						$SearchSQL[] = "`date`<='{$NowDate} 23:59:59'";
					}
				elseif( $date == 3 )
					{
						$DateSql = ( time() + ( $config['date_adjust'] * 60 ) ) - 2678400;
						$DateSql = date( "Y-m-d 00:00:00", $DateSql );
						$SearchSQL[] = "`date`>='{$DateSql}'";
						$SearchSQL[] = "`date`<='{$NowDate} 23:59:59'";	
					}
			}
			
		if( count( $SearchSQL ) > 0 )
			$SearchSQL = " AND ".implode( " AND ", $SearchSQL );
		else
			$SearchSQL = "";
			
		$PageLink = "/index.php?do=banki&action=fullsearch&title=".urlencode( $SearchTitle )."&text=".urlencode( $SearchText )."&date={$date}&country={$country}&city={$city}&category={$category}&thread_cats={$thread_cats}&banki_type={$banki_type}&price_ot={$SearchPriceOt}&price_do={$SearchPriceDo}&currency={$currency}&on_page={$SearchOnPage}&submit=1&page={page}";
	}
		else
	{

		$SearchOnPage = 10;
		$thread_cats = 1;
	}
	
//--------------------------------------------------=-=-=-=-=
//	Генерация формы поиска
//--------------------------------------------------=-=-=-=-=

$thread_cats_checked = $thread_cats == 1 ? "checked=\"checked\"" : "";
$SelectDate = $Banki->SelectList( array( 0 => "Без разницы", 1 => "За сегодня", 2 => "За неделю", 3 => "За месяц" ), $date );
$SelectBankiType = $Banki->ReturnSelectBankiType( $banki_type );
$SelectCurrency = $Banki->ReturnSelectCurrency( $currency );
$SelectCategory = $Banki->SelectCategory( $category, "", "", "", true );
$SelectCountry = $Banki->ReturnSelectCountry( $country );
$SelectCity = $Banki->ReturnSelectCity( $country, $city );

$tpl->Load_Template( "/banki/main/full.search.tpl" );
$tpl->set( "{title}", $SearchTitle );
$tpl->set( "{text}", $SearchText );
$tpl->set( "{price_ot}", $SearchPriceOt );
$tpl->set( "{price_do}", $SearchPriceDo );
$tpl->set( "{on_page}", $SearchOnPage );
$tpl->set( "{date}", "<select name=\"date\">{$SelectDate}</select>" );
$tpl->set( "{category}", "<select name=\"category\">{$SelectCategory}</select>" );
$tpl->set( "{banki_type}", "<select name=\"banki_type\">{$SelectBankiType}</select>" );
$tpl->set( "{currency}", "<select name=\"currency\">{$SelectCurrency}</select>" );
$tpl->set( "{country}", "<select name=\"country\" id=\"SelectListCountryAdd\" onchange=\"SelectCountry( 'Add', 'Выберите' );\"><option value=\"\">- Выберите -</option>{$SelectCountry}</select>" );
$tpl->set( "{city}", "<span id=\"FormSelectCityAdd\"><select name=\"city\" id=\"SelectCityAdd\"><option value=\"\">- Выберите -</option>{$SelectCity}</select> <span id=\"FormSelectCityStatusAdd\"></span></span>" );
$tpl->set( "{thread_cats}", "<input type=\"checkbox\" name=\"thread_cats\" id=\"thread_cats\" {$thread_cats_checked} value=\"1\" />" );
$tpl->copy_template = "<form method=\"post\" action=\"\">{$tpl->copy_template}<input type=\"hidden\" name=\"do\" value=\"banki\" /><input type=\"hidden\" name=\"action\" value=\"fullsearch\" /></form>";
$tpl->compile( "banki_search" );
$tpl->clear();

//--------------------------------------------------=-=-=-=-=
//	Вывод найденных
//--------------------------------------------------=-=-=-=-=

if( $SearchSQL )
	{
		$NewsList = array(
		
			"template"		=> "banki/{$Folder}/banki.short.tpl",
			"template_nav"	=> "banki/{$Folder}/navigation.tpl",
			"template_info"	=> "banki/{$Folder}/info.tpl",
			"tpl_compile"	=> "banki_content",
			"cashe_folder"	=> "",
			"cashe_file"	=> "",
			"cache"			=> false,
			"sql_count"		=> "SELECT COUNT(*) as count FROM ".PREFIX."_banki_post WHERE approve='1' {$SearchSQL}",
			"sql_query"		=> "SELECT * FROM ".PREFIX."_banki_post WHERE approve='1' {$SearchSQL} ORDER BY date DESC {limit}",
			"num"			=> $SearchOnPage,
			"nav"			=> $PageLink,
			"search_info"	=> true,
			"no_news_error" => "По вашему запросу ничего не найдено.",
			
		);
			
		require( ENGINE_DIR."/modules/banki/list.post.php" );
	}

// Совмещаем форму поиска и список
$tpl->result['banki_content'] = $tpl->result['banki_search'].$tpl->result['banki_content'];

// Разрешаем вывод формы поиска
$BankiLoadMainTpl = true;
$BankiAllowSearch = false;

?>