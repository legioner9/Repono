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
		
		$result = $db->query( "SELECT * FROM ".PREFIX."_banki_post WHERE `alt_name`='{$id}' LIMIT 1" );
		$Allow = ( $db->num_rows( $result ) > 0 ) ? true : false;
		$errorAllow = "Банк под номером \"{$id}\" не найден.";
		
		if( $Allow === true )
			{
				$row = $db->get_row( $result );
				$approve = intval( $row['approve'] );
				$category = intval( $row['category'] );
				
				//	Смотрим, какую папку с шаблонами грузить
				$RowCat = $Banki->DB['category'][ $category ];
				$Folder = $RowCat['template'] != "" ? totranslit( $RowCat['template'] ) : "default";
				
				if( $approve != 1 )
					{
						$Allow = false;
						$errorAllow = "Банк временно отключен";
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
				$title_rek = htmlspecialchars( stripslashes( $row['title_rek'] ), ENT_QUOTES, $config['charset'] );
				$title_rek_seo = htmlspecialchars( stripslashes( $row['title_rek_seo'] ), ENT_QUOTES, $config['charset'] );
				$description_rek = htmlspecialchars( stripslashes( $row['description_rek'] ), ENT_QUOTES, $config['charset'] );
				$keywords = htmlspecialchars( stripslashes( $row['keywords'] ), ENT_QUOTES, $config['charset'] );
				$alt_name = stripslashes( $row['alt_name'] );
				$rate = stripslashes( $row['rate'] );
				$allow_comm = intval( $row['allow_comm'] );
				$comm_num = intval( $row['comm_num'] );
				$views = intval( $row['views'] );
				$Banki->RequestCat = $category;
				$BankiCategory = $category;

				
				$color = htmlspecialchars( stripslashes( $row['color'] ), ENT_QUOTES, $config['charset'] );
				$color_date = intval( $row['color_date'] );
						
				$color_date = $color_date > 0 ? date( "Y-m-d H:i:s", ( $color_date + ( $config['date_adjust'] * 60 ) ) ) : "";

				
				$Banki->UpdateViews( $id );
				
				//--------------------------------------------------=-=-=-=-=
				//	Настройка метатитлов
				//--------------------------------------------------=-=-=-=-=
				
				$SpeedBarCat = $Banki->SpeedBarCat( $category );
				
				$module['title']['title'];
				for( $i = count( $SpeedBarCat ); $i > 0; $i-- ) $module['speedbar'][] = "<a href=\"".$SpeedBarCat[ ( $i - 1 ) ]['link']."\">".$SpeedBarCat[ ( $i - 1 ) ]['title_h']."</a> ";
				$module['title'][] = $title_rek_seo;
				$module['speedbar'][] = $title_rek;
				$module['description'][] = $description_rek;
				$module['keywords'][] = $keywords;
				$SpeedBarCat = $Banki->SpeedBarCat( $categorys );
				
				//--------------------------------------------------=-=-=-=-=
				//	Комментарии
				//--------------------------------------------------=-=-=-=-=
				
				// Грузим файл комментариев
				include_once( ENGINE_DIR."/modules/banki/comments.php" );
				$TplComments = $tpl->result['banki_comments'];
				$TplAddComments = $tpl->result['banki_addcomments'];
				
				//--------------------------------------------------=-=-=-=-=
				//	Выводим саму новость
				//--------------------------------------------------=-=-=-=-=
				
				$tpl->Load_Template( "banki/{$Folder}/rekviziti.full.tpl" );
				

		
				$tpl->set( "{title}", $title );
				
				if( $TplComments )
					{
						$tpl->set( "[comments]", "" );
						$tpl->set( "[/comments]", "" );
						$tpl->set_block( "'\\[not-comments\\](.*?)\\[/not-comments\\]'si", "" );
					}
						else
					{
						$TplComments = "<div id=\"BankiCommentsList\"></div>";
						$tpl->set( "[not-comments]", "<span id=\"BankiNotComment\">" );
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
						$tpl->set( "[allow-comments]", "<form method=\"post\" action=\"\" name=\"AddBankiComment\" onsubmit=\"BankiAddComments(); return false;\">" );
						$tpl->set( "[/allow-comments]", "</form>" );
					}
						else
					{
						$tpl->set_block( "'\\[allow-comments\\](.*?)\\[/allow-comments\\]'si", "" );
					}
				

			
				
				// Ссылка
				$full_link = $Banki->ReturnLinkPost( $id, $alt_name, $category );
				$tpl->set( "{full-link}", $full_link );
				$tpl->set( "[full-link]", "<a href=\"{$full_link}\">" );
				$tpl->set( "[/full-link]", "</a>" );
				$canonical_link = $Banki->ReturnLinkRekviziti( $id, $alt_name, $category );
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
					

						
				$tpl->set( "{id}", $id );
				$tpl->set( "{speedbar}", $Banki->ReturnLinkHrefCategory( $category ) );
				$tpl->set( "{category}", $Banki->ReturnLinkHrefCategory( $categorys ) );
				$tpl->set( "{title}", $title );
				$tpl->set( "{title_rek}", $title_rek );
				$tpl->set( "{views}", $views );
				$tpl->set( "{text}", $text );
				$tpl->set( "{rate}", $rate );
				$tpl->set( "{comments-num}", $comm_num );
				$tpl->copy_template = $Banki->ParsePhotosNews( $tpl->copy_template, $row['photos'] );	

				if( $Banki->Field !== false ) $tpl->copy_template = $Banki->Field->ParseTags( $tpl->copy_template, $row['xfields'] );
				
				$tpl->set( "{comments}", "<div id=\"banki_comments\">".$TplComments."</div>" );
				$tpl->set( "{addcomments}", $TplAddComments );
								
				$tpl->compile( "banki_content" );
				$tpl->clear();
				
				// Запрещаем выводить форму поиска
				$BankiLoadMainTpl = false;
				
				// Ключевые слова и описание для поисковиков
				if( $row['description'] ) $metatags['description'] = stripslashes( $row['description_rek'] );
				if( $row['keywords'] ) $metatags['keywords'] = stripslashes( $row['keywords'] );
				//
			}
				else
			{
				$tpl->Load_Template( "info.tpl" );
				$tpl->set( "{title}", "Ошибка" );
				$tpl->set( "{error}", $errorAllow );
				$tpl->compile( "banki_content" );
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
		$tpl->set( "{error}", "Вы не указали идентификационный номер банка." );
		$tpl->compile( "banki_content" );
		$tpl->clear();
	}


if( $BankiLoadMainTpl !== true )
	{
		$tpl->result['banki'] = $tpl->result['banki'].$tpl->result['banki_content'];
		unset( $tpl->result['banki_content'] );	
	}

?>