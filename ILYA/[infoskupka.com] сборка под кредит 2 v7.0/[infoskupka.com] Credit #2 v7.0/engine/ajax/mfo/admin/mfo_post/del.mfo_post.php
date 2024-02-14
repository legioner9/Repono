<?php


//-------------------------------------------------====
//	Инициализация
//-------------------------------------------------====

define( "ROOT_DIR", "../../../../.." );
define( "ENGINE_DIR", "../../../.." );
require_once( ENGINE_DIR."/ajax/mfo/admin/OptAjax.php" );

//-------------------------------------------------====
//	Само удаление
//-------------------------------------------------====

$id = intval( $_REQUEST['id'] );
if( $id )
	{
		$result = $db->query( "SELECT `id`,`category` FROM ".PREFIX."_mfo_post WHERE `id`='{$id}'" );
		if( $db->num_rows( $result ) > 0 )
			{
				while( $row = $db->get_row( $result ) )
					{
						$Mfo->DelPostCategory( $row['category'] );
						$db->query( "DELETE FROM ".PREFIX."_mfo_comments WHERE `mfo_id`='{$id}'" );
						$db->query( "DELETE FROM ".PREFIX."_mfo_post WHERE `id`='{$id}' LIMIT 1" );
					}
			}
				else
			{
				echoReturn( "Указанный МФО не найден, возможно он был удален ранее!" );
			}
	}
		else
	{
		echoReturn( "Не указан идентификатор МФО!" );
	}

//-------------------------------------------------====
//	Завершение работы
//-------------------------------------------------====

$db->close();

?>