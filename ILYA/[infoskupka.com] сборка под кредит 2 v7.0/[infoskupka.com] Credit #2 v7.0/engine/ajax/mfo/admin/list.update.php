<?php


//-------------------------------------------------====
//	Инициализация
//-------------------------------------------------====

define( "ROOT_DIR", "../../../.." );
define( "ENGINE_DIR", "../../.." );
require_once( ENGINE_DIR."/ajax/mfo/admin/OptAjax.php" );

//-------------------------------------------------====
//	Принятие и проверка данных
//-------------------------------------------------====

$action = $_REQUEST['action'];

//-------------------------------------------------====
//	Грузим нужный файл
//-------------------------------------------------====

switch( $action ){
	
	case "category":
		require( ENGINE_DIR."/inc/mfo/list/category.php" );
		break;
		
	case "fields":
		require( ENGINE_DIR."/inc/mfo/list/fields.php" );
		break;
		
	case "blocks":
		require( ENGINE_DIR."/inc/mfo/list/blocks.php" );
		break;
		
	case "main":
		require( ENGINE_DIR."/inc/mfo/list/post.php" );
		break;
}

//-------------------------------------------------====
//	Завершение работы
//-------------------------------------------------====

$db->close();

?>