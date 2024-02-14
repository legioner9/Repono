<?php


if( !defined( "DATALIFEENGINE" ) ) die( "Hacking attempt!" );



//--------------------------------------------------=-=-=-=-=
//	Определяем идентификационный номер
//--------------------------------------------------=-=-=-=-=

$id = $_REQUEST['id'];
if( $id )
	{
		//--------------------------------------------------=-=-=-=-=
		//	Достаём из базы
		//--------------------------------------------------=-=-=-=-=
		
		$result = $db->query( "SELECT * FROM ".PREFIX."_offers_post WHERE `alt_name`='{$id}' LIMIT 1" );
		$Allow = ( $db->num_rows( $result ) > 0 ) ? true : false;
		$errorAllow = "Оффер под номером \"{$id}\" не найден.";
		
		if( $Allow === true )
			{
				$row = $db->get_row( $result );
				$approve = intval( $row['approve'] );
				$category = intval( $row['category'] );
				
				//	Смотрим, какую папку с шаблонами грузить
				$RowCat = $Offers->DB['category'][ $category ];
				$Folder = $RowCat['template'] != "" ? totranslit( $RowCat['template'] ) : "default";
				
				if( $approve != 1 )
					{
						$Allow = false;
						$errorAllow = "Оффер временно отключен";
					}
			}
				
		if( $Allow === true )
			{
				$id = $row['id'];
				$author = stripslashes( $row['author'] );
				$author_id = intval( $row['author_id'] );
				$text = stripslashes( $row['text'] );
				$title = htmlspecialchars( stripslashes( $row['title'] ), ENT_QUOTES, $config['charset'] );
				$titlelink = htmlspecialchars( stripslashes( $row['titlelink'] ), ENT_QUOTES, $config['charset'] );
				$title_post = htmlspecialchars( stripslashes( $row['title_post'] ), ENT_QUOTES, $config['charset'] );				
				$alt_name = stripslashes( $row['alt_name'] );
				$rate = stripslashes( $row['rate'] );
				$allow_comm = intval( $row['allow_comm'] );
				$comm_num = intval( $row['comm_num'] );
				$views = intval( $row['views'] );
				$Offers->RequestCat = $category;
				$OffersCategory = $category;
				
				$color = htmlspecialchars( stripslashes( $row['color'] ), ENT_QUOTES, $config['charset'] );
				$color_date = intval( $row['color_date'] );						
				$color_date = $color_date > 0 ? date( "Y-m-d H:i:s", ( $color_date + ( $config['date_adjust'] * 60 ) ) ) : "";
							
				
				$Offers->UpdateViews( $id );
				
				//--------------------------------------------------=-=-=-=-=
				//	Настройка метатитлов
				//--------------------------------------------------=-=-=-=-=
				
				$SpeedBarCat = $Offers->SpeedBarCat( $category );
				
				$module['title']['title'];
				$module['speedbar'][] = "<a href=\"".$SpeedBarCat[ ( $i - 1 ) ]['link']."\">".$SpeedBarCat[ ( $i - 1 ) ]['title_h']."</a>";
				$module['title'][] = $titlelink;
				$module['speedbar'][] = $title;
				$module['description']['description'];
				$module['description'][] = $titlelink;
				$SpeedBarCat = $Offers->SpeedBarCat( $categorys );
				
				//--------------------------------------------------=-=-=-=-=
				//	Комментарии
				//--------------------------------------------------=-=-=-=-=
				
				// Грузим файл комментариев
				include_once( ENGINE_DIR."/modules/offers/comments.php" );
				$TplComments = $tpl->result['offers_comments'];
				$TplAddComments = $tpl->result['offers_addcomments'];
				
				//--------------------------------------------------=-=-=-=-=
				//	Выводим саму новость
				//--------------------------------------------------=-=-=-=-=
				
				$tpl->Load_Template( "offers/{$Folder}/offers.full.tpl" );
				

		
				$tpl->set( "{title}", $title );
				
				if( $TplComments )
					{
						$tpl->set( "[comments]", "" );
						$tpl->set( "[/comments]", "" );
						$tpl->set_block( "'\\[not-comments\\](.*?)\\[/not-comments\\]'si", "" );
					}
						else
					{
						$TplComments = "<div id=\"OffersCommentsList\"></div>";
						$tpl->set( "[not-comments]", "<span id=\"OffersNotComment\">" );
						$tpl->set( "[/not-comments]", "</span>" );
						$tpl->set_block( "'\\[comments\\](.*?)\\[/comments\\]'si", "" );
					}
								
				if( $TplAddComments )
					{
						$tpl->set( "[add-comments]", "" );
						$tpl->set( "[/add-comments]", "" );
						$tpl->set_block( "'\\[not-addcomments\\](.*?)\\[/not-addcomments\\]'si", "" );
					}
						else
					{
						$tpl->set( "{error_add}", $error_add );
						$tpl->set( "[not-addcomments]", "" );
						$tpl->set( "[/not-addcomments]", "" );
						$tpl->set_block( "'\\[add-comments\\](.*?)\\[/add-comments\\]'si", "" );
					}
									
				if( !$not_comments )
					{
						$tpl->set( "[allow-comments]", "<form method=\"post\" action=\"\" name=\"AddOffersComment\" onsubmit=\"OffersAddComments(); return false;\">" );
						$tpl->set( "[/allow-comments]", "</form>" );
					}
						else
					{
						$tpl->set_block( "'\\[allow-comments\\](.*?)\\[/allow-comments\\]'si", "" );
					}
				
		
				// Ссылка
				$full_link = $Offers->ReturnLinkPost( $id, $alt_name, $category );
				$tpl->set( "{full-link}", $full_link );
				$tpl->set( "[full-link]", "<a href=\"{$full_link}\">" );
				$tpl->set( "[/full-link]", "</a>" );
				$canonical_link = $Offers->ReturnLinkPost( $id, $alt_name, $category );
				$canonical = $canonical_link;  
				// Ссылка на комментарии
				if( $comm_num > 0 )
					{
						$tpl->set( "[com-link]", "<a href=\"{$full_link}#comment\">" );
						$tpl->set( "[/com-link]", "</a>");
					}
						else
					{
						$tpl->set( "[com-link]", "" );
						$tpl->set( "[/com-link]", "" );
					}
						
				if( $NewsList['tag_id'] === true )
					$tpl->set( "{id}", $id );
				else
					$tpl->set( "{id}", "" );
				
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
					
				$tpl->copy_template = preg_replace( "#\\[not-approve\\](.+?)\\[/not-approve\\]#is", ( $approve == 1 ? "" : "\\1" ), $tpl->copy_template );
				$tpl->copy_template = preg_replace( "#\\[color\\](.+?)\\[/color\\]#is", ( $color_date ? "\\1" : "" ), $tpl->copy_template );
				$tpl->copy_template = preg_replace( "#\\[no-color\\](.+?)\\[/no-color\\]#is", ( $color_date ? "" : "\\1" ), $tpl->copy_template );
				$tpl->copy_template = preg_replace( "#\\[allow-color\\](.+?)\\[/allow-color\\]#is", ( ( !in_array( $Offers->Config['echo_post_color'], array( "hand", "auto" ) ) ) ? "" : "\\1" ), $tpl->copy_template );
				
						
				$tpl->set( "{id}", $id );
				$tpl->set( "{color}", $color );
				$tpl->set( "{speedbar}", $Offers->ReturnLinkHrefCategory( $category ) );
				$tpl->set( "{category}", $Offers->ReturnLinkHrefCategory( $categorys ) );
				
				$tpl->set( "{title}", $title );
				$tpl->set( "{title_post}", $title_post );
				$tpl->set( "{views}", $views );
				$tpl->set( "{text}", $text );
				$tpl->set( "{rate}", $rate );
				
				$tpl->copy_template = $Offers->ParsePhotosNews( $tpl->copy_template, $row['photos'] );	

				if( $Offers->Field !== false ) $tpl->copy_template = $Offers->Field->ParseTags( $tpl->copy_template, $row['xfields'] );
				
				$tpl->set( "{comments}", "<div id=\"offers_comments\">".$TplComments."</div>" );
				$tpl->set( "{addcomments}", $TplAddComments );
				
				$tpl->copy_template .= "<script language=\"javascript\" type=\"text/javascript\">hs.align = 'center';
				hs.transitions = ['expand', 'crossfade'];
				hs.addSlideshow({
					interval: 4000,
					repeat: false,
					useControls: true,
					fixedControls: 'fit',
					overlayOptions: {
						opacity: .75,
						position: 'bottom center',
						hideOnMouseOut: true
					}
				});</script>";
				
				$tpl->compile( "offers_content" );
				$tpl->clear();
				
				// Запрещаем выводить форму поиска
				$OffersLoadMainTpl = false;
				
				// Ключевые слова и описание для поисковиков
				if( $row['description'] ) $metatags['description'] = stripslashes( $row['description'] );
				if( $row['keywords'] ) $metatags['keywords'] = stripslashes( $row['keywords'] );
				//
			}
				else
			{
				$tpl->Load_Template( "info.tpl" );
				$tpl->set( "{title}", "Ошибка" );
				$tpl->set( "{error}", $errorAllow );
				$tpl->compile( "offers_content" );
				$tpl->clear();
			}

//--------------------------------------------------=-=-=-=-=
//	В случае ошибки, выводим информацию
//--------------------------------------------------=-=-=-=-=

	}
		else
	{
		$tpl->Load_Template( "info.tpl" );
		$tpl->set( "{title}", "Ошибка" );
		$tpl->set( "{error}", "Вы не указали идентификационный номер оффера." );
		$tpl->compile( "offers_content" );
		$tpl->clear();
	}

// Разрешаем вывод формы поиска
$OffersLoadMainTpl = ( in_array( $Offers->Config['echo_post_blocksearch'], array( "yes", "yes_no_search" ) ) ) ? true : false;
if( $Offers->Config['echo_post_blocksearch'] == "yes_no_search" ) $OffersAllowSearch = false;

if( $OffersLoadMainTpl !== true )
	{
		$tpl->result['offers'] = $tpl->result['offers'].$tpl->result['offers_content'];
		unset( $tpl->result['offers_content'] );	
	}

?>