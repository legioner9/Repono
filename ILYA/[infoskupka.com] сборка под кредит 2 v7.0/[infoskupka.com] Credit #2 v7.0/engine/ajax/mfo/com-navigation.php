<?php


//-------------------------------------------------====
//	Инициализация
//-------------------------------------------------====

define( "ROOT_DIR", "../../.." );
define( "ENGINE_DIR", "../.." );

$OptAjax = array(
	"tpl"	=> true,
);

require_once( ENGINE_DIR."/ajax/mfo/OptAjax.php" );

//-------------------------------------------------====
//	Проверка данных
//-------------------------------------------------====

$id = intval( $_POST['mfo_id'] );
if( !$id ) echoReturn( "Приняты не все данные, попробуйте снова." );
if( $Mfo->Config['com_on'] != "yes" ) echoReturn( "Комментарии для данного объявления отключены" );
$LinkTpl = str_replace( "|-page-|", "{page}", strip_tags( stripslashes( $_REQUEST['link_tpl'] ) ) );

//-------------------------------------------------====
//	Информация об объявлении
//-------------------------------------------------====

$result = $db->query( "SELECT `allow_comm`,`category` FROM ".PREFIX."_mfo_post WHERE `id`='{$id}' AND `approve`='1' LIMIT 1" );
if( $db->num_rows( $retult ) > 0 )
	{
		$row = $db->get_row( $result );
		if( $row['allow_comm'] == 1 )
			{
				$RowCat = $Mfo->DB['category'][ intval( $row['category'] ) ];
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
$allow_group_com_moder = explode( ",", $Mfo->Config['com_groups_moder'] );
$allow_groups_add_com = explode( ",", $Mfo->Config['com_groups_add'] );
if( $is_logged || $Mfo->Config['com_anonim'] == "yes" )
	{
		if( in_array( $member_id['user_group'], $allow_groups_add_com ) || !$is_logged )
			{
				$AllowAdd = true;
			}
	}

// Грузим класс комментариев
require_once( ENGINE_DIR."/modules/mfo/tree.comments.class.php" );

// Небольшая настройка конфигов
$Mfo->Config['com_sort'] = ( $Mfo->Config['com_sort'] == "desc" ) ? "desc" : "asc";

// Запускаем класс и создаём запрос
$TreeCom = new tree_comments();
$TreeCom->CreateDB( "", $Mfo->Config['com_sort'] );

// Настраиваем навигацию
$TreeCom->Navigation = ( $Mfo->Config['com_navigation_on'] == "yes" ) ? true : false;
$TreeCom->Ajax = ( $Mfo->Config['com_ajax_navigation'] == "yes" ) ? true : false;
$TreeCom->ComOnPage = ( intval( $Mfo->Config['com_max_on_page'] ) > 0 ) ? intval( $Mfo->Config['com_max_on_page'] ) : 1;
$TreeCom->Page = intval( $_REQUEST['com_page'] );
$TreeCom->URL = $LinkTpl;

// Разные опции
$TreeCom->AllowAdd = $AllowAdd;
$TreeCom->Alternation = ( $Mfo->Config['com_alternation'] == "yes" ) ? true : false;
$TreeCom->AllocationGroups = ( $Mfo->Config['com_allocation'] == "yes" ) ? true : false;							
$TreeCom->NoCom['template'] = "mfo/{$Folder}/comments/info.tpl";
$TreeCom->ComDIR = "mfo/{$Folder}/comments";
if( in_array( $member_id['user_group'], $allow_group_com_moder ) ) $TreeCom->AllowEdit = true;

// Генерируем комментарии и навигацию если нужно
$TreeCom->start();
$TreeCom->BuildNavigation();		

// Завершаем класс
$TreeCom->apocalypse();

//-------------------------------------------------====
//	Парсим шаблоны
//-------------------------------------------------====

$tpl->result['mfo_comments'] = str_replace( "{THEME}", $THEME, $tpl->result['mfo_comments'] );
$tpl->result['nav_comments'] = str_replace( "{THEME}", $THEME, $tpl->result['nav_comments'] );

//-------------------------------------------------====
//	Выводим пользователю
//-------------------------------------------------====

echo "<div id=\"MfoCommentsList\">{$tpl->result['mfo_comments']}</div>{$tpl->result['nav_comments']}";;

//-------------------------------------------------====
//	Завершаем работу
//-------------------------------------------------====

$db->close();

?>