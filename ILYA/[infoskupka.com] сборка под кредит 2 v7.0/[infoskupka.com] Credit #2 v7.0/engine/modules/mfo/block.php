<?php
/*
=====================================================
 Файл: my.post.php
=====================================================
 Данный код защищен авторскими правами
=====================================================
 Назначение: вывод всех фирм
=====================================================
*/

if( !defined( "DATALIFEENGINE" ) ) die( "Hacking attempt!" );

if( !function_exists( "echoBlockmfo" ) )
	{
		function echoBlockmfo( $id ){
			global $Mfo, $tpl, $db, $is_logged, $member_id, $config, $_TIME, $user_group;
			
			if( !class_exists( "Mfo" ) ) require_once( ENGINE_DIR."/inc/mfo/mfo.class.php" );
			if( !is_array( $Mfo->DB['blocks'][ $id ] ) ) return false;
				
			$template = totranslit( $Mfo->DB['blocks'][ $id ]['template'], false, false );
			
			$sql = array();
			switch( $Mfo->DB['blocks'][ $id ]['post_type'] ){
				
					
				case "color":
					$sql[] = "`color_date`>'0'";
					break;
					
				default:break;
			}
			
			if( $Mfo->DB['blocks'][ $id ]['post_photo'] == "yes" ) $sql[] = "`photos`!=''";
			
			$limit = intval( $Mfo->DB['blocks'][ $id ]['max_post'] ) > 0 ? intval( $Mfo->DB['blocks'][ $id ]['max_post'] ) : 1;
			$sort = $Mfo->DB['blocks'][ $id ]['post_sort'] == "desc" ? "DESC" : "ASC";
			
			$allowCat = explode( ",", $Mfo->DB['blocks'][ $id ]['AllowCats'] );
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
						
				"template"		=> "mfo/blocks/{$template}.tpl",
				"template_nav"	=> "",
				"template_info"	=> "mfo/blocks/info.tpl",
				"tpl_compile"	=> "mfo_block_content",
				"cashe_folder"	=> "",
				"cashe_file"	=> "",
				"cache"			=> false,
				"sql_count"		=> "SELECT COUNT(*) as count FROM ".PREFIX."_mfo_post {$sql}",
				"sql_query"		=> "SELECT * FROM ".PREFIX."_mfo_post {$sql} ORDER BY rate {$sort} {limit}",
				"num"			=> $limit,
				"nav"			=> false,
				"banners"		=> false,
				"search_info"	=> $SearchInfo,
				"search_text"	=> "Показано {posts} МФО.",
				"no_news_error" => "МФО нет",
							
			);
			
			require( ENGINE_DIR."/modules/mfo/list.post.php" );	
			echo $tpl->result['mfo_block_content'];
			unset( $tpl->result['mfo_block_content'] );
		}
	}

echo echoBlockmfo( $id );

?>