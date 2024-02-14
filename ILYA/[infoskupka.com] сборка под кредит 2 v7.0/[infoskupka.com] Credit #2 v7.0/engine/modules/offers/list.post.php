<?php



if( !defined( "DATALIFEENGINE" ) ) die( "Hacking attempt!" );


$tpl->result[ $NewsList['tpl_compile'] ] = "";
if( $NewsList['cache'] ) $tpl->result[ $NewsList['tpl_compile'] ] = $Offers->OpenCache( $NewsList['cashe_folder'], $NewsList['cashe_file'], intval( $_REQUEST['page'] ) );
if( !$tpl->result[ $NewsList['tpl_compile'] ] )
	{
		$temp = $db->super_query( $NewsList['sql_count'] );
		$posts = $temp['count'];
		
		if( $posts > 0 )
			{
				$num = $NewsList['num'] > 0 ? $NewsList['num'] : 1;
				$page = intval( $_REQUEST['page'] );
				$total = intval( ( ( $posts - 1 ) / $num ) + 1 );
				if( $page <= 0 ) $page = 1;
				if( $page > $total ) $page = $total;
				$start = $page * $num - $num;
				$limit = "LIMIT $start, $num";
				$NewsList['sql_query'] = str_replace( "{limit}", $limit, $NewsList['sql_query'] );
				
				
				
				//--------------------------------------------------
				//  Вывод 
				//--------------------------------------------------
				
				$i = 1;
				$result = $db->query( $NewsList['sql_query'] );
				$tpl->load_template( $NewsList['template'] );	
				while( $row = $db->get_row( $result ) )
					{
						$id = $row['id'];
						$author = stripslashes( $row['author'] );
						$author_id = stripslashes( $row['author_id'] );
						$text = stripslashes( $row['text'] );
						$rate = stripslashes( $row['rate'] );
						$title = htmlspecialchars( stripslashes( $row['title'] ), ENT_QUOTES, $config['charset'] );
						$alt_name = stripslashes( $row['alt_name'] );
						$category = intval( $row['category'] );
						$approve = intval( $row['approve'] );
						$views = intval( $row['views'] );						
						$color = htmlspecialchars( stripslashes( $row['color'] ), ENT_QUOTES, $config['charset'] );
						$color_date = intval( $row['color_date'] );
						$comm_num = intval( $row['comm_num'] );
						$LastComm = $Offers->LastCommentsBlock();
						
						if( $Offers->Config['short_echo_allowhtml'] != "yes" ) $text = strip_tags( $text, "<br>" );
						if( strlen( $text ) > $Offers->Config['short_echo_max_strlen'] ) $text = substr( $text, 0, $Offers->Config['short_echo_max_strlen'] )."..";
						
						if( $Offers->Config['short_echo_city'] == "yes" ) $Offers->LoadListCity( $country );
						
						$color_date = $color_date > 0 ? date( "Y-m-d H:i:s", ( $color_date + ( $config['date_adjust'] * 60 ) ) ) : "";
						

						// Ссылка на оффер
						$full_link = $Offers->ReturnLinkPost( $id, $alt_name, $category );
						$tpl->set( "{full-link}", $full_link );
						$tpl->set( "[full-link]", "<a href=\"{$full_link}\">" );
						$tpl->set( "[/full-link]", "</a>" );
		
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
						
						$tpl->copy_template = preg_replace( "#\\[not-approve\\](.+?)\\[/not-approve\\]#is", ( $approve == 1 ? "" : "\\1" ), $tpl->copy_template );
						$tpl->copy_template = preg_replace( "#\\[color\\](.+?)\\[/color\\]#is", ( $color_date ? "\\1" : "" ), $tpl->copy_template );
						$tpl->copy_template = preg_replace( "#\\[no-color\\](.+?)\\[/no-color\\]#is", ( $color_date ? "" : "\\1" ), $tpl->copy_template );
						$tpl->copy_template = preg_replace( "#\\[allow-color\\](.+?)\\[/allow-color\\]#is", ( ( !in_array( $Offers->Config['echo_post_color'], array( "hand", "auto" ) ) ) ? "" : "\\1" ), $tpl->copy_template );
						
						$tpl->set( "{color}", $color );
						
						$tpl->set( "{category}", $Offers->ReturnLinkHrefCategory( $category ) );
						$tpl->set( "{gcategory}", $Offers->ReturnLinkHrefGCategory( $category ) );
						$tpl->set( "{title}", $title );
						$tpl->set( "{views}", $views );
						$tpl->set( "{text}", $text );
						$tpl->set( "{rate}", $rate );
						$tpl->set( "{comments-num}", $comm_num );
		
						
						$tpl->copy_template = $Offers->ParsePhotosNews( $tpl->copy_template, $row['photos'] );
						if( $Offers->Field !== false ) $tpl->copy_template = $Offers->Field->ParseTags( $tpl->copy_template, $row['xfields'] );
						if( $NewsList['banners'] !== false ) $tpl->copy_template .= $Offers->SetBanners( "short", $i );
						
						$tpl->compile( $NewsList['tpl_compile'] );
						$i++;
					}
				
				$tpl->clear();
				
				//--------------------------------------------------
				//  Навигация
				//--------------------------------------------------
				
				if( $NewsList['nav'] !== false ) $Offers->CreateNavigation( $NewsList['nav'], $page, $total, $NewsList['template_nav'], $page_ajax, $NewsList['tpl_compile'] );
				
			}
				else
			{
				$tpl->Load_Template( $NewsList['template_info'] );
				$tpl->set( "{title}", "Информация" );
				$tpl->set( "{error}", $NewsList['no_news_error'] );
				$tpl->compile( $NewsList['tpl_compile'] );
				$tpl->clear();
			}
		
		if( $NewsList['cache'] && $Offers->Config['cache'] == "yes" ) $Offers->CreateCache( $NewsList['cashe_folder'], $NewsList['cashe_file'], $tpl->result[ $NewsList['tpl_compile'] ], intval( $_REQUEST['page'] ) );
	}
	

?>