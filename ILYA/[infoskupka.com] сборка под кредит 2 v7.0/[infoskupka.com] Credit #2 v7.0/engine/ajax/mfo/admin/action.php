<?php


//-------------------------------------------------====
//	Инициализация
//-------------------------------------------------====

define( "ROOT_DIR", "../../../.." );
define( "ENGINE_DIR", "../../.." );
require_once( ENGINE_DIR."/ajax/mfo/admin/OptAjax.php" );

//-------------------------------------------------====
//	Само выполнение
//-------------------------------------------------====

$TypeAction = $_REQUEST['TypeAction'];
switch( $TypeAction ){
	
	case "fields":
		require_once( ENGINE_DIR."/ajax/mfo/admin/action/fields.php" );
		break;
		
	case "category":
		require_once( ENGINE_DIR."/ajax/mfo/admin/action/category.php" );
		break;
		
		
	case "mfo_post":
		require_once( ENGINE_DIR."/ajax/mfo/admin/action/mfo_post.php" );
		break;
		

	case "blocks":
		require_once( ENGINE_DIR."/ajax/mfo/admin/action/blocks.php" );
		break;
		
	default:
		echoReturn( "Не верный запрос!" );
		break;
}

//-------------------------------------------------====
//	Завершение работы
//-------------------------------------------------====

$db->close();

?>