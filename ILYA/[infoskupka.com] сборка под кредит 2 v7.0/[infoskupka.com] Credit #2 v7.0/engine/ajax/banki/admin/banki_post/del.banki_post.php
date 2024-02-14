<?php


//-------------------------------------------------====
//	Инициализация
//-------------------------------------------------====

define( "ROOT_DIR", "../../../../.." );
define( "ENGINE_DIR", "../../../.." );
require_once( ENGINE_DIR."/ajax/banki/admin/OptAjax.php" );

//-------------------------------------------------====
//	Само удаление
//-------------------------------------------------====

$id = intval( $_REQUEST['id'] );
if( $id )
	{
		$result = $db->query( "SELECT `id`,`category` FROM ".PREFIX."_banki_post WHERE `id`='{$id}'" );
		if( $db->num_rows( $result ) > 0 )
			{
				while( $row = $db->get_row( $result ) )
					{
						$Banki->DelPostCategory( $row['category'] );
						$db->query( "DELETE FROM ".PREFIX."_banki_comments WHERE `banki_id`='{$id}'" );
						$db->query( "DELETE FROM ".PREFIX."_banki_post WHERE `id`='{$id}' LIMIT 1" );
					}
			}
				else
			{
				echoReturn( "Указанный оффер не найден, возможно он был удален ранее!" );
			}
	}
		else
	{
		echoReturn( "Не указан идентификатор объявления!" );
	}

//-------------------------------------------------====
//	Завершение работы
//-------------------------------------------------====

$db->close();

?>