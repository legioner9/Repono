<?php
/*
=====================================================
 Файл: com-navigation.php
=====================================================
 Данный код защищен авторскими правами
=====================================================
 Назначение: ajax навигация по комментариям
=====================================================
*/

//-------------------------------------------------====
//	Инициализация
//-------------------------------------------------====

define( "ROOT_DIR", "../../.." );
define( "ENGINE_DIR", "../.." );

$OptAjax = array(
	"tpl"	=> true,
);

require_once( ENGINE_DIR."/ajax/offers/OptAjax.php" );

//-------------------------------------------------====
//	Проверка данных
//-------------------------------------------------====

$id = intval( $_POST['offers_id'] );
if( !$id ) echoReturn( "Приняты не все данные, попробуйте снова." );
if( $Offers->Config['com_on'] != "yes" ) echoReturn( "Комментарии для данного объявления отключены" );
$LinkTpl = str_replace( "|-page-|", "{page}", strip_tags( stripslashes( $_REQUEST['link_tpl'] ) ) );

//-------------------------------------------------====
//	Информация об объявлении
//-------------------------------------------------====

$result = $db->query( "SELECT `allow_comm`,`category` FROM ".PREFIX."_offers_post WHERE `id`='{$id}' AND `approve`='1' LIMIT 1" );
if( $db->num_rows( $retult ) > 0 )
	{
		$row = $db->get_row( $result );
		if( $row['allow_comm'] == 1 )
			{
				$RowCat = $Offers->DB['category'][ intval( $row['category'] ) ];
				$Folder = $RowCat['template'] != "" ? totranslit( $RowCat['template'] ) : "default";
			}
				else
			{
				echoReturn( "Комментарии для данного объявления отключены" );
			}
	}
		else
	{
		echoReturn( "Объявление не обнаружено" );
	}

//-------------------------------------------------====
//	Запускаем класс комментариев
//-------------------------------------------------====

$AllowAdd = false;
$allow_group_com_moder = explode( ",", $Offers->Config['com_groups_moder'] );
$allow_groups_add_com = explode( ",", $Offers->Config['com_groups_add'] );
if( $is_logged || $Offers->Config['com_anonim'] == "yes" )
	{
		if( in_array( $member_id['user_group'], $allow_groups_add_com ) || !$is_logged )
			{
				$AllowAdd = true;
			}
	}

// Грузим класс комментариев
require_once( ENGINE_DIR."/modules/offers/tree.comments.class.php" );

// Небольшая настройка конфигов
$Offers->Config['com_sort'] = ( $Offers->Config['com_sort'] == "desc" ) ? "desc" : "asc";

// Запускаем класс и создаём запрос
$TreeCom = new tree_comments();
$TreeCom->CreateDB( "", $Offers->Config['com_sort'] );

// Настраиваем навигацию
$TreeCom->Navigation = ( $Offers->Config['com_navigation_on'] == "yes" ) ? true : false;
$TreeCom->Ajax = ( $Offers->Config['com_ajax_navigation'] == "yes" ) ? true : false;
$TreeCom->ComOnPage = ( intval( $Offers->Config['com_max_on_page'] ) > 0 ) ? intval( $Offers->Config['com_max_on_page'] ) : 1;
$TreeCom->Page = intval( $_REQUEST['com_page'] );
$TreeCom->URL = $LinkTpl;

// Разные опции
$TreeCom->AllowAdd = $AllowAdd;
$TreeCom->Alternation = ( $Offers->Config['com_alternation'] == "yes" ) ? true : false;
$TreeCom->AllocationGroups = ( $Offers->Config['com_allocation'] == "yes" ) ? true : false;							
$TreeCom->NoCom['template'] = "offers/{$Folder}/comments/info.tpl";
$TreeCom->ComDIR = "offers/{$Folder}/comments";
if( in_array( $member_id['user_group'], $allow_group_com_moder ) ) $TreeCom->AllowEdit = true;

// Генерируем комментарии и навигацию если нужно
$TreeCom->start();
$TreeCom->BuildNavigation();		

// Завершаем класс
$TreeCom->apocalypse();

//-------------------------------------------------====
//	Парсим шаблоны
//-------------------------------------------------====

$tpl->result['offers_comments'] = str_replace( "{THEME}", $THEME, $tpl->result['offers_comments'] );
$tpl->result['nav_comments'] = str_replace( "{THEME}", $THEME, $tpl->result['nav_comments'] );

//-------------------------------------------------====
//	Выводим пользователю
//-------------------------------------------------====

echo "<div id=\"OffersCommentsList\">{$tpl->result['offers_comments']}</div>{$tpl->result['nav_comments']}";;

//-------------------------------------------------====
//	Завершаем работу
//-------------------------------------------------====

$db->close();

?>