<?php

if( !defined( "DATALIFEENGINE" ) ) die( "Hacking attempt!" );

if( !function_exists( "echoBlockis" ) )
	{
		function echoBlockis( $id ){
			global $Banki, $tpl, $db, $is_logged, $member_id, $config, $_TIME, $user_group;
			
			if( !class_exists( "Banki" ) ) require_once( ENGINE_DIR."/inc/banki/banki.class.php" );
			if( !is_array( $Banki->DB['blocks'][ $id ] ) ) return false;
				
			$template = totranslit( $Banki->DB['blocks'][ $id ]['template'], false, false );
			
			$sql = array();
			switch( $Banki->DB['blocks'][ $id ]['post_type'] ){
				
					
				case "color":
					$sql[] = "`color_date`>'0'";
					break;
					
				default:break;
			}
			
			if( $Banki->DB['blocks'][ $id ]['post_photo'] == "yes" ) $sql[] = "`photos`!=''";
			
			$limit = intval( $Banki->DB['blocks'][ $id ]['max_post'] ) > 0 ? intval( $Banki->DB['blocks'][ $id ]['max_post'] ) : 1;
			$sort = $Banki->DB['blocks'][ $id ]['post_sort'] == "desc" ? "DESC" : "ASC";
			
			$allowCat = explode( ",", $Banki->DB['blocks'][ $id ]['AllowCats'] );
			if( !in_array( "all", $allowCat ) )
				{
					foreach( $allowCat as $key => $cat )
						{
							$cat = intval( $cat );
							if( $cat ) 
								$allowCat[ $key ] = "'{$cat}'";
							else
								unset( $allowCat[ $key ] );
						}
					
					$allowCat = implode( ",", $allowCat );
					$sql[] = "`category` IN ({$allowCat})";
				}
				
			$sql = count( $sql ) > 0 ? "WHERE ".implode( " AND ", $sql ) : "";
			
			$NewsList = array(
						
				"template"		=> "banki/blocks/{$template}.tpl",
				"template_nav"	=> "",
				"template_info"	=> "banki/blocks/info.tpl",
				"tpl_compile"	=> "banki_block_content",
				"cashe_folder"	=> "",
				"cashe_file"	=> "",
				"cache"			=> false,
				"sql_count"		=> "SELECT COUNT(*) as count FROM ".PREFIX."_banki_post {$sql}",
				"sql_query"		=> "SELECT * FROM ".PREFIX."_banki_post {$sql} ORDER BY rate {$sort} {limit}",
				"num"			=> $limit,
				"nav"			=> false,
				"banners"		=> false,
				"search_info"	=> $SearchInfo,
				"search_text"	=> "Показано {posts} банков.",
				"no_news_error" => "Нет банков",
							
			);
			
			require( ENGINE_DIR."/modules/banki/list.post.php" );	
			echo $tpl->result['banki_block_content'];
			unset( $tpl->result['banki_block_content'] );
		}
	}

echo echoBlockis( $id );

?>