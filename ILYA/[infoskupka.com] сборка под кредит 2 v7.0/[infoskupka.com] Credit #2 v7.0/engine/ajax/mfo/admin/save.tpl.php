<?php


//-------------------------------------------------====
//	Инициализация
//-------------------------------------------------====

define( "ROOT_DIR", "../../../.." );
define( "ENGINE_DIR", "../../.." );
require_once( ENGINE_DIR."/ajax/mfo/admin/OptAjax.php" );
require( ENGINE_DIR."/data/mfo/tpl.email.php" );

//-------------------------------------------------====
//	Само сохранение
//-------------------------------------------------====

if( !is_array( $_REQUEST['email'] ) ) echoReturn( "Приняты не верные данные!" );
if( !is_array( $MfoEmail ) ) $MfoEmail = array();
$save_con = $_REQUEST['email'] + $MfoEmail;
$handler = fopen( ENGINE_DIR.'/data/mfo/tpl.email.php', "w" );
fwrite($handler, "<?PHP \n\n//Mfo module email \n\n\$MfoEmail = array (\n\n");
foreach( $save_con as $name => $value )
	{
		$value = CharsetConvert( $value );					
		$value = addslashes( stripslashes( $value ) );
		fwrite( $handler, "	\"{$name}\" => \"{$value}\",\n" );
	}
fwrite( $handler, ");\n\n?>" );
fclose( $handler );

//-------------------------------------------------====
//	Вывод данных
//-------------------------------------------------====

echo "<span style=\"color: green; font-weight: bold;\">Сохранено</span>";

//-------------------------------------------------====
//	Завершение работы
//-------------------------------------------------====

$db->close();

?>