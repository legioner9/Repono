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

if( $Mfo->Field === false ) $Mfo->StartField( true );
$id = intval( $_REQUEST['id'] );
if( $id )
	{
		if( $Mfo->Field->DB[ $id ] )
			{
				$Mfo->Field->Delete( $id );
			}
				else
			{
				echoReturn( "Доп. поля не существует, или оно было удалено!" );
			}
	}
		else
	{
		echoReturn( "Не указан идентификатор доп. поля!" );
	}

//-------------------------------------------------====
//	Завершение работы
//-------------------------------------------------====

$db->close();

?>