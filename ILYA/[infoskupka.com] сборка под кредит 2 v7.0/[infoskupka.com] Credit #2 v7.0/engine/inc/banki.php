<?php


if( !defined( "DATALIFEENGINE" ) ) die( "Hacking attempt!" );
if( $member_id['user_group'] != 1 && $member_db[1] != 1 ) die( "Нет доступа" );


require_once( ENGINE_DIR."/data/banki.config.php" );
require_once( ENGINE_DIR."/inc/banki/banki.class.php" );
require_once( ENGINE_DIR."/inc/banki/functions.php" );

//----------------------------------------------------
//  Разрешённые файлы
//----------------------------------------------------



//----------------------------------------------------
//  Подгружаем файлы
//----------------------------------------------------


define('MOD_DIR', ENGINE_DIR.'/inc/banki'); // Путь к файлам с модуля






?>