<?php


if( !defined( "DATALIFEENGINE" ) ) die( "Hacking attempt!" );

if( !function_exists( "echoBlock" ) )
	{
		function echoBlock( $id ){
			global $Offers, $tpl, $db, $is_logged, $member_id, $config, $_TIME, $user_group;
			
			if( !class_exists( "Offers" ) ) require_once( ENGINE_DIR."/inc/offers/offers.class.php" );
			if( !is_array( $Offers->DB['blocks'][ $id ] ) ) return false;
				
			$template = totranslit( $Offers->DB['blocks'][ $id ]['template'], false, false );
			
			$sql = array();
			switch( $Offers->DB['blocks'][ $id ]['post_type'] ){
				
					
				case "color":
					$sql[] = "`color_date`>'0'";
					break;
					
				default:break;
			}
			
			if( $Offers->DB['blocks'][ $id ]['post_photo'] == "yes" ) $sql[] = "`photos`!=''";
			
			$limit = intval( $Offers->DB['blocks'][ $id ]['max_post'] ) > 0 ? intval( $Offers->DB['blocks'][ $id ]['max_post'] ) : 1;
			$sort = $Offers->DB['blocks'][ $id ]['post_sort'] == "desc" ? "DESC" : "ASC";
			
			$allowCat = explode( ",", $Offers->DB['blocks'][ $id ]['AllowCats'] );
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
					$sql[] = "`category` IN ({$cat})";
				}
				
			$sql = count( $sql ) > 0 ? "WHERE ".implode( " AND ", $sql ) : "";
			
			$NewsList = array(
						
				"template"		=> "offers/blocks/{$template}.tpl", 
				"template_nav"	=> "",
				"template_info"	=> "offers/blocks/info.tpl",
				"tpl_compile"	=> "offers_block_content",
				"cashe_folder"	=> "",
				"cashe_file"	=> "",
				"cache"			=> false,
				"sql_count"		=> "SELECT COUNT(*) as count FROM ".PREFIX."_offers_post {$sql}",
				"sql_query"		=> "SELECT * FROM ".PREFIX."_offers_post {$sql} ORDER BY sort {$sort} {limit}",
				"num"			=> $limit,
				"nav"			=> false,
				"banners"		=> false,
				"search_info"	=> $SearchInfo,
				"search_text"	=> "Показано {posts} предложений.",
				"no_news_error" => "<div class=\"cat-error\">Нет предложений</div>",
							
			);
			
			require( ENGINE_DIR."/modules/offers/list.post.php" );	
			echo $tpl->result['offers_block_content'];
			unset( $tpl->result['offers_block_content'] );
		}
	}

echo echoBlock( $id );

?>