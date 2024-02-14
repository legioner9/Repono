<?php


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
require_once( ROOT_DIR."/language/".$config['langs']."/website.lng" );
require_once( ENGINE_DIR."/classes/mysql.php" );
require_once( ENGINE_DIR."/data/dbconfig.php" );

if( version_compare( $config['version_id'], "7.5", ">" ) )
	require_once ( ENGINE_DIR."/inc/include/functions.inc.php" );
else
	require_once ( ENGINE_DIR."/inc/functions.inc.php" );
	
require_once( ENGINE_DIR."/modules/sitelogin.php" );
require_once( ENGINE_DIR."/inc/mfo/mfo.class.php" );


//-------------------------------------------------====
//	Проверка на административность
//-------------------------------------------------====

if( $member_id['user_group'] != 1 && $member_db[1] != 1 )
	{
		header( "HTTP/1.1 401 Unauthorized" );
		die( error );
	}

//-------------------------------------------------====
//	Проверяем язык
//-------------------------------------------------====

$config['charset'] = ( $lang['charset'] != '' ) ? $lang['charset'] : $config['charset'];

//-------------------------------------------------====
//	Настриваем Header информацию для вывода
//-------------------------------------------------====

@header( "Content-type: text/html; charset=".$config['charset'] );
@header( "pragma-cache: no-cache" );

//-------------------------------------------------====
//	Функция, выводящая текст в новом окне
//-------------------------------------------------====

function echoReturn( $text ){
	die("<script language=\"javascript\">alert('{$text}');</script>");
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
		function convert_unicode( $t, $to = "windows-1251" ){
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