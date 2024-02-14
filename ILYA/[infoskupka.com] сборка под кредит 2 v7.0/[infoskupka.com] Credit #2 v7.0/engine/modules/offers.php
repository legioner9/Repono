<?php


if( !defined( "DATALIFEENGINE" ) ) die( "Hacking attempt!" );



//--------------------------------------------------=-=-=-=-=
//	Запускаем класс
//--------------------------------------------------=-=-=-=-=

if( !class_exists( "Offers" ) ) require_once( ENGINE_DIR."/inc/offers/offers.class.php" );

//--------------------------------------------------=-=-=-=-=
//	Настройки модуля
//--------------------------------------------------=-=-=-=-=

$module['title'] = array( $Offers->Config['main_title'] );


if( $Offers->Config['on'] == "yes" )
	{
		$action = totranslit( $_REQUEST['action'] );
		
		
		//--------------------------------------------------=-=-=-=-=
		//	Грузим файлы
		//--------------------------------------------------=-=-=-=-=
		
		$OffersLoadMainTpl = false;
		$OffersAllowSearch = true;
		switch( $action ){
			
			case "post":
				include( DLEPlugins::Check(ENGINE_DIR."/modules/offers/full.post.php") );
				break;
						
			case "userpost":
				include( DLEPlugins::Check(ENGINE_DIR."/modules/offers/user.post.php") );
				break;
			
			case "offerscat":
				include( DLEPlugins::Check(ENGINE_DIR."/modules/offers/category.php") );
				break;
				
								
			default:
				$action = "main";
				include( DLEPlugins::Check(ENGINE_DIR."/modules/offers/main.php") );
				break;
		}
		
		//--------------------------------------------------=-=-=-=-=
		//	Обработка сгенерированного
		//--------------------------------------------------=-=-=-=-=
		
		if( $OffersLoadMainTpl === true )
			{
				
				$NewTitle = $module['title'];
				$metatags['main_title'] = implode( "", $NewTitle );
				
				$Folder = $Folder != "" ? $Folder : "default";
				$tpl->Load_Template( "offers/{$Folder}/main.tpl" );
				$tpl->set( "{opisanie}", $metatags['opisanie'] );
				$tpl->set( "{content}", $tpl->result['offers_content'] );
				$tpl->set( "{opisanie_up}", $metatags['opisanie_up'] );
				$tpl->set( "{category}", $Offers->ReturnLinkHrefCategory( $category ) );
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
				
				$tpl->compile( "offers" );
				$tpl->clear(); 
			}
		
			$tpl->result['content'] = $tpl->result['content'].$tpl->result['offers'];
			$tpl->result['content'] = preg_replace_callback( "#\\[(Not|Yes)OffersAllow:(.+?)\\](.+?)\\[/(Not|Yes)OffersAllow\\]#is", function( $matches ) use ( $Offers ){
				return $Offers->ReplaceTagBlock( $matches[2], $matches[3], $matches[1] );
			}, $tpl->result['content'] );
			$tpl->result['content'] = preg_replace_callback( "#\\[(Not|Yes)OffersAllowCat:(.+?)\\](.+?)\\[/(Not|Yes)OffersAllowCat\\]#is", function( $matches ) use ( $Offers ){
				return $Offers->ReplaceTagBlockCat( $matches[2], $matches[3], $matches[1] );
			}, $tpl->result['content'] );
		
		
		unset( $tpl->result['offers'] );
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