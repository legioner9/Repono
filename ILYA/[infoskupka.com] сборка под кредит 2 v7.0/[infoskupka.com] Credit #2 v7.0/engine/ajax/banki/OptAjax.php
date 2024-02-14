<?php
/*
=====================================================
 Данный код защищен авторскими правами
=====================================================
 Назначение: Подгрузка необходимых файлов для AJAX
=====================================================
*/

//-------------------------------------------------====
//	Настройки сессий и ошибок
//-------------------------------------------------====

@session_start();
@error_reporting( 7 );
@ini_set( "display_errors", true );
@ini_set( "html_errors", false );

//-------------------------------------------------====
//	Говорим движку, что свои
//-------------------------------------------------====

define( "DATALIFEENGINE", true );

//-------------------------------------------------====
//	Грузим конфиги и нужные файлы
//-------------------------------------------------====

require_once( ENGINE_DIR."/data/config.php" );
require_once( ENGINE_DIR."/classes/mysql.php" );
require_once( ENGINE_DIR."/data/dbconfig.php" );
require_once( ENGINE_DIR."/modules/functions.php" );

$_REQUEST['skin'] = totranslit( $_REQUEST['skin'], false, false );
$Skin = ( @is_dir( ROOT_DIR."/templates/".$_REQUEST['skin'] ) && $_REQUEST['skin'] ) ? $_REQUEST['skin'] : $config['skin'];

//-------------------------------------------------====
//	Определение языка
//-------------------------------------------------====

if( $config[ "lang_{$Skin}" ] )
	@include_once( ROOT_DIR."/language/".$config[ "lang_{$Skin}" ]."/website.lng" );
else
	@include_once( ROOT_DIR."/language/".$config['langs']."/website.lng" );

//-------------------------------------------------====
//	Проверяем язык
//-------------------------------------------------====

$config['charset'] = ( $lang['charset'] != "" ) ? $lang['charset'] : $config['charset'];

//-------------------------------------------------====
//	Настриваем Header информацию для вывода
//-------------------------------------------------====

@header( "Content-type: text/html; charset=".$config['charset'] );
@header( "pragma-cache: no-cache" );

//-------------------------------------------------====
//	Функция, выводящая текст в новом окне
//-------------------------------------------------====

function echoReturn( $text, $echoText = "" ){
	die( "{$echoText}<script language=\"javascript\">alert('{$text}');</script>" );
}

//-------------------------------------------------====
//	Определение групп пользователей
//-------------------------------------------------====

$user_group = get_vars( "usergroup" );
if( !$user_group )
	{
		$user_group = array();
		$db->query( "SELECT * FROM ".USERPREFIX."_usergroups ORDER BY id ASC" );
	
		while( $row = $db->get_row() )
			{
				$user_group[ $row['id'] ] = array();
				foreach ( $row as $key => $value )
					{
						$user_group[ $row['id'] ][ $key ] = stripslashes( $value );
					}
	
			}
		
		set_vars( "usergroup", $user_group );
		$db->free();
	}
	
//-------------------------------------------------====
//	Залогиненность пользователя
//-------------------------------------------------====

require_once( ENGINE_DIR."/modules/sitelogin.php" );
if( !$is_logged ) $member_id['user_group'] = 5;

//-------------------------------------------------====
//	Файлы модуля
//-------------------------------------------------====

require_once( ENGINE_DIR."/inc/banki/banki.class.php" );
$THEME = "{$home_link}/templates/{$Skin}"; 
	
//-------------------------------------------------====
//	Настройка шаблонов
//-------------------------------------------------====

if( $OptAjax['tpl'] === true )
	{
		require_once( ENGINE_DIR."/classes/templates.class.php" );
		$tpl = new dle_template();
		$tpl->dir = ROOT_DIR."/templates/{$Skin}";
		define( "TEMPLATE_DIR", $tpl->dir );
	}

//-------------------------------------------------====
//	Функция конвертации
//-------------------------------------------------====

if( !function_exists( "CharsetConvert" ) )
	{
		function CharsetConvert( $text, $to = "auto" ){
			global $config;
			
			if( version_compare( $config['version_id'], "7.5", "<" ) ) return convert_unicode( $text );
			
			$text = stripslashes( $text );
			$charset = mb_detect_encoding( $text, "utf-8,windows-1251" );
			if( $to == "auto" ) $to = $config['charset'];
			if( $charset != $to && $to != "" ) $text = iconv( $charset, $to."//IGNORE", $text );
			return urldecode( $text );
		}
	}
	
if( !function_exists( "decode_to_utf8" ) )
	{
		function decode_to_utf8($int=0){
			$t = '';
	
			if ( $int < 0 )
			{
				return chr(0);
			}
			else if ( $int <= 0x007f )
			{
				$t .= chr($int);
			}
			else if ( $int <= 0x07ff )
			{
				$t .= chr(0xc0 | ($int >> 6));
				$t .= chr(0x80 | ($int & 0x003f));
			}
			else if ( $int <= 0xffff )
			{
				$t .= chr(0xe0 | ($int  >> 12));
				$t .= chr(0x80 | (($int >> 6) & 0x003f));
				$t .= chr(0x80 | ($int  & 0x003f));
			}
			else if ( $int <= 0x10ffff )
			{
				$t .= chr(0xf0 | ($int  >> 18));
				$t .= chr(0x80 | (($int >> 12) & 0x3f));
				$t .= chr(0x80 | (($int >> 6) & 0x3f));
				$t .= chr(0x80 | ($int  &  0x3f));
			}
			else
			{ 
				return chr(0);
			}
			
			return $t;
		}
	}

if( !function_exists( "convert_unicode" ) )
	{
		function convert_unicode($t, $to = 'windows-1251'){
			$to = strtolower($to);
	
			if ($to == 'utf-8') {
	
				$t = preg_replace( '#%u([0-9A-F]{1,4})#ie', "decode_to_utf8(hexdec('\\1'))", utf8_encode($t) );
				$t = urldecode ($t);
	
			} else {
	
				$t = preg_replace( '#%u([0-9A-F]{1,4})#ie', "'&#' . hexdec('\\1') . ';'", $t );
				$t = urldecode ($t);
				$t = @html_entity_decode($t, ENT_NOQUOTES, $to);
	
			}
	
			return $t;
		}
	}

?>