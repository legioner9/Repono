<?php


if( !defined( "DATALIFEENGINE" ) ) die( "Hacking attempt!" );

//--------------------------------------------------=-=-=-=-=
//	Запускаем класс
//--------------------------------------------------=-=-=-=-=

if( !class_exists( "Banki" ) ) require_once( ENGINE_DIR."/inc/banki/banki.class.php" );

//--------------------------------------------------=-=-=-=-=
//	Настройки модуля
//--------------------------------------------------=-=-=-=-=


$module['title'] = array( $Banki->Config['main_title'] );


if( $Banki->Config['on'] == "yes" )
	{
		$action = totranslit( $_REQUEST['action'] );
		
		//--------------------------------------------------=-=-=-=-=
		//	В каком городе находится пользователь
		//--------------------------------------------------=-=-=-=-=
		
		
		
		//--------------------------------------------------=-=-=-=-=
		//	Грузим файлы
		//--------------------------------------------------=-=-=-=-=
		
		$BankiLoadMainTpl = false;
		$BankiAllowSearch = true;
		switch( $action ){
			
			case "rekv":
				include( DLEPlugins::Check(ENGINE_DIR."/modules/banki/rekv.post.php") );
				break;
			
			case "post":
				include( DLEPlugins::Check(ENGINE_DIR."/modules/banki/full.post.php") );
				break;
						
				
			case "bankicat":
				include( DLEPlugins::Check(ENGINE_DIR."/modules/banki/category.php") );
				break;
				
			case "fullsearch":
				include( DLEPlugins::Check(ENGINE_DIR."/modules/banki/fullsearch.php") );
				break;
				
				
			default:
				$action = "main";
				include( DLEPlugins::Check(ENGINE_DIR."/modules/banki/main.php") );
				break;
				
		}
		
		//--------------------------------------------------=-=-=-=-=
		//	Обработка сгенерированного
		//--------------------------------------------------=-=-=-=-=
		
		if( $BankiLoadMainTpl === true )
			{


				$FullBankiSearch = "/index.php?do=banki&action=fullsearch";
				$NewTitle = $module['title'];
				$metatags['main_title'] = implode( "", $NewTitle );
				
				$Folder = $Folder != "" ? $Folder : "default";
				$tpl->Load_Template( "banki/{$Folder}/main.tpl" );
				$tpl->set( "{metadis}", $metatags['description'] );
				$tpl->set( "{opisanie}", $metatags['opisanie'] );
				$tpl->set( "{opisanie_up}", $metatags['opisanie_up'] );
				$tpl->set( "{content}", $tpl->result['banki_content'] );
				$tpl->set( "{MainLink}", $MainLink );
				$tpl->set( "{rssLink}", $rssLink );
				
				$tpl->set( "{category}", $Banki->ReturnLinkHrefCategory( $category ) );
				$tpl->set( "{gcategory}", $metatags['title_h'] );
				
				if( $config['allow_banner'] ) include_once ENGINE_DIR . '/modules/banners.php';
		
				if( $config['allow_banner'] AND count( $banners ) ) {
			
					foreach ( $banners as $name => $value ) {
							$tpl->copy_template = str_replace( "{banner_" . $name . "}", $value, $tpl->copy_template );

								if ( $value ) {
									$tpl->copy_template = str_replace ( "[banner_" . $name . "]", "", $tpl->copy_template );
									$tpl->copy_template = str_replace ( "[/banner_" . $name . "]", "", $tpl->copy_template );
								}
					}
				}
				$tpl->set_block( "'{banner_(.*?)}'si", "" );
				$tpl->set_block ( "'\\[banner_(.*?)\\](.*?)\\[/banner_(.*?)\\]'si", "" );
				
				
				$SearchTextForm = htmlspecialchars( $SearchTextForm, ENT_QUOTES, $config['charset'] );
				$tpl->set_block( "#{search:text->(.+?)}#is", ( ( $SearchTextForm != "" ) ? $SearchTextForm : "\\1" ) );
				
				$tpl->compile( "banki" );
				$tpl->clear();
			}
		
			$tpl->result['content'] = $tpl->result['content'].$tpl->result['banki'];
			$tpl->result['content'] = preg_replace_callback( "#\\[(Not|Yes)BankiAllow:(.+?)\\](.+?)\\[/(Not|Yes)BankiAllow\\]#is", function( $matches ) use ( $Banki ){
				return $Banki->ReplaceTagBlock( $matches[2], $matches[3], $matches[1] );
			}, $tpl->result['content'] );
			$tpl->result['content'] = preg_replace_callback( "#\\[(Not|Yes)BankiAllowCat:(.+?)\\](.+?)\\[/(Not|Yes)BankiAllowCat\\]#is", function( $matches ) use ( $Banki ){
				return $Banki->ReplaceTagBlockCat( $matches[2], $matches[3], $matches[1] );
			}, $tpl->result['content'] );
		
		
		unset( $tpl->result['banki'] );
	}
		else
	{
		msgbox( "Информация", "Каталог отключен администраций сайта." );	
	}

//--------------------------------------------------=-=-=-=-=
//	Метатег <title> и модуль SpeedBar
//--------------------------------------------------=-=-=-=-=

$NewTitle = array();
for( $i = count( $module['title'] ); $i > 0; $i-- ) $NewTitle[] = $module['title'][ $i - 1 ];
$metatags['header_title'] = implode( "", $NewTitle );
$module['speedbar'] = implode( " &raquo; ", $module['speedbar'] );
$module['title'] = "";

?>