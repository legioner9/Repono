<?php
/*
=====================================================
 Файл: save.php
=====================================================
 Данный код защищен авторскими правами
=====================================================
 Назначение: ajax сохранение настроек модуля
=====================================================
*/

//-------------------------------------------------====
//	Инициализация
//-------------------------------------------------====

define( "ROOT_DIR", "../../../.." );
define( "ENGINE_DIR", "../../.." );
require_once( ENGINE_DIR."/ajax/offers/admin/OptAjax.php" );
require( ENGINE_DIR."/data/offers/tpl.email.php" );

//-------------------------------------------------====
//	Само сохранение
//-------------------------------------------------====

if( !is_array( $_REQUEST['email'] ) ) echoReturn( "Приняты не верные данные!" );
if( !is_array( $OffersEmail ) ) $OffersEmail = array();
$save_con = $_REQUEST['email'] + $OffersEmail;
$handler = fopen( ENGINE_DIR.'/data/offers/tpl.email.php', "w" );
fwrite($handler, "<?PHP \n\n//Offers module email \n\n\$OffersEmail = array (\n\n");
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