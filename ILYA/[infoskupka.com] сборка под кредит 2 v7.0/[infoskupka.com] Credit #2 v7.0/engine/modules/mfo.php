<?php


if( !defined( "DATALIFEENGINE" ) ) die( "Hacking attempt!" );

//--------------------------------------------------=-=-=-=-=
//	Запускаем класс
//--------------------------------------------------=-=-=-=-=

if( !class_exists( "Mfo" ) ) require_once( ENGINE_DIR."/inc/mfo/mfo.class.php" );

//--------------------------------------------------=-=-=-=-=
//	Настройки модуля
//--------------------------------------------------=-=-=-=-=

$module['title'] = array( $Mfo->Config['main_title'] );


if( $Mfo->Config['on'] == "yes" )
	{
		$action = totranslit( $_REQUEST['action'] );
		
		//--------------------------------------------------=-=-=-=-=
		//	В каком городе находится пользователь
		//--------------------------------------------------=-=-=-=-=
		
		
		
		//--------------------------------------------------=-=-=-=-=
		//	Грузим файлы
		//--------------------------------------------------=-=-=-=-=
		
		$MfoLoadMainTpl = false;
		$MfoAllowSearch = true;
		switch( $action ){
			
			case "rekv":
				include( DLEPlugins::Check(ENGINE_DIR."/modules/mfo/rekv.post.php") );
				break;
			
			case "post":
				include( DLEPlugins::Check(ENGINE_DIR."/modules/mfo/full.post.php") );
				break;					
				
			case "mfocat":
				include( DLEPlugins::Check(ENGINE_DIR."/modules/mfo/category.php") );
				break;
				
			case "fullsearch":
				include( DLEPlugins::Check(ENGINE_DIR."/modules/mfo/fullsearch.php") );
				break;
				
				
			default:
				$action = "main";
				include( DLEPlugins::Check(ENGINE_DIR."/modules/mfo/main.php") );
				break;
		}
		
		//--------------------------------------------------=-=-=-=-=
		//	Обработка сгенерированного
		//--------------------------------------------------=-=-=-=-=
		
		if( $MfoLoadMainTpl === true )
			{
				
				$FullMfoSearch = "/index.php?do=mfo&action=fullsearch";
				$NewTitle = $module['title'];
				$metatags['main_title'] = implode( "", $NewTitle );
				
				$Folder = $Folder != "" ? $Folder : "default";
				$tpl->Load_Template( "mfo/{$Folder}/main.tpl" );
				$tpl->set( "{opisanie}", $metatags['opisanie'] );
				$tpl->set( "{full_search_link}", $FullMfoSearch );
				$tpl->set( "{content}", $tpl->result['mfo_content'] );
				$tpl->set( "{opisanie_up}", $metatags['opisanie_up'] );
				
				$tpl->set( "{category}", $Mfo->ReturnLinkHrefCategory( $category ) );
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
				
				$tpl->compile( "mfo" );
				$tpl->clear();
			}
		
			$tpl->result['content'] = $tpl->result['content'].$tpl->result['mfo'];
			$tpl->result['content'] = preg_replace_callback( "#\\[(Not|Yes)MfoAllow:(.+?)\\](.+?)\\[/(Not|Yes)MfoAllow\\]#is", function( $matches ) use ( $Mfo ){
				return $Mfo->ReplaceTagBlock( $matches[2], $matches[3], $matches[1] );
			}, $tpl->result['content'] );
			$tpl->result['content'] = preg_replace_callback( "#\\[(Not|Yes)MfoAllowCat:(.+?)\\](.+?)\\[/(Not|Yes)MfoAllowCat\\]#is", function( $matches ) use ( $Mfo ){
				return $Mfo->ReplaceTagBlockCat( $matches[2], $matches[3], $matches[1] );
			}, $tpl->result['content'] );
		
		
		unset( $tpl->result['mfo'] );
	}
		else
	{
		msgbox( "Информация", "Каталог МФО отключен администрацией сайта." );	
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