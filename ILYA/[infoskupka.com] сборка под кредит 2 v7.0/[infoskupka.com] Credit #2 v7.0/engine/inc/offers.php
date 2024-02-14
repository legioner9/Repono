<?php


if( !defined( "DATALIFEENGINE" ) ) die( "Hacking attempt!" );
if( $member_id['user_group'] != 1 && $member_db[1] != 1 ) die( "Нет доступа" );


require_once( ENGINE_DIR."/data/offers.config.php" );
require_once( ENGINE_DIR."/inc/offers/offers.class.php" );
require_once( ENGINE_DIR."/inc/offers/functions.php" );

//----------------------------------------------------
//  Разрешённые файлы
//----------------------------------------------------



//----------------------------------------------------
//  Подгружаем файлы
//----------------------------------------------------


define('MOD_DIR', ENGINE_DIR.'/inc/offers'); // Путь к файлам с модуля






?>