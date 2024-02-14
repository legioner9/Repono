<?php


//-------------------------------------------------====
//	Инициализация
//-------------------------------------------------====

define( "ROOT_DIR", "../../../.." );
define( "ENGINE_DIR", "../../.." );
require_once( ENGINE_DIR."/ajax/banki/admin/OptAjax.php" );

//-------------------------------------------------====
//	Само выполнение
//-------------------------------------------------====

$TypeAction = $_REQUEST['TypeAction'];
switch( $TypeAction ){
	
	case "fields":
		require_once( ENGINE_DIR."/ajax/banki/admin/action/fields.php" );
		break;
		
	case "category":
		require_once( ENGINE_DIR."/ajax/banki/admin/action/category.php" );
		break;
		
		
	case "banki_post":
		require_once( ENGINE_DIR."/ajax/banki/admin/action/banki_post.php" );
		break;
		

	case "blocks":
		require_once( ENGINE_DIR."/ajax/banki/admin/action/blocks.php" );
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