<?php


if( !defined( "DATALIFEENGINE" ) ) die( "Hacking attempt!" );

// Комментарии
if( $Offers->Config['com_on'] == "yes" && $allow_comm == 1 )
	{
		// Форма добавления комментариев
		$com_groups_captcha = explode( ",", $Offers->Config['com_groups_captcha'] );
		$allow_groups_add_com = explode( ",", $Offers->Config['com_groups_add'] );
		if( $is_logged || $Offers->Config['com_anonim'] == "yes" )
			{
				if( in_array( $member_id['user_group'], $allow_groups_add_com ) || !$is_logged )
					{
						$allow_add_com = true;
						include_once( ENGINE_DIR."/modules/offers/addcomments.php" );
						include_once( ENGINE_DIR."/modules/offers/editor/bb_comment.php" );
						$tpl->Load_Template( "offers/{$Folder}/comments/addcomments.tpl" );
																
						$tpl->copy_template = "<div id=\"addcomments_form\">".$tpl->copy_template."<input type=\"hidden\" name=\"offers_id\" value=\"{$id}\" /></div>";
						$tpl->copy_template = "".$tpl->copy_template."<script language=\"javascript\" type=\"text/javascript\">var form_test = document.getElementById( 'addcomments_form' ).innerHTML;</script>";
						$tpl->set( "{editor}", $bb_code );
						$tpl->set( "{text}", $comment );
						$tpl->set( "{name_otziv}", $name_otziv );
						$tpl->set( "{tit_otziv}", $tit_otziv );
						$tpl->set( "{otziv}", $otziv );
						if( !$is_logged )
							{
								$tpl->set( "[not-logged]", "" );
								$tpl->set( "[/not-logged]", "" );
							}
								else
							{
																		
								$tpl->set_block( "'\\[not-logged\\](.*?)\\[/not-logged\\]'si", "" );
							}
																	
						if( in_array( $member_id['user_group'], $com_groups_captcha ) )
							{
								$tpl->set( "{captcha}", "<span id=\"dle-captcha\"><img src=\"/engine/modules/antibot/antibot.php\" border=\"0\" width=\"120\" height=\"50\" onclick=\"OffersReCaptcha(); return false;\" style=\"cursor: pointer;\" /></span>" );
								$tpl->set( "[captcha]", "" );
								$tpl->set( "[/captcha]", "" );
							}
								else
							{
								$tpl->set_block( "'\\[captcha\\](.*?)\\[/captcha\\]'si", "" );
							}
																
						$tpl->compile( "offers_addcomments" );
						$tpl->clear();
					}
						else
					{
						$error_add = "Вам запрещено оставлять отзывы.";		
					}
			}
				else
			{
				$error_add = "Авторизироваться";	
			}
										
		// Вывод комментариев
		if( $comm_num > 0 )
			{
				require_once( ENGINE_DIR."/modules/offers/tree.comments.class.php" );
				$Offers->Config['com_sort'] = ( $Offers->Config['com_sort'] == "desc" ) ? "desc" : "asc";
														
				$TreeCom = new tree_comments();
				$TreeCom->CreateDB( "", $Offers->Config['com_sort'] );
														
				$com_on_page = intval( $Offers->Config['com_max_on_page'] );
				if( $Offers->Config['com_navigation_on'] == "yes" && $com_on_page > 0 )
					{
						$CatAltName = $Offers->DB['category'][ $category ]['alt_name'];
						$LinkCat = $Offers->ReturnLinkCategory( $category );
						if( $config['allow_alt_url'])
							$com_url = "{$LinkCat}/otziv-{page}/{$id}-{$alt_name}/";
						else
							$com_url = "/index.php?do=offers&amp;offerscat={$CatAltName}&amp;id={$id}&amp;com_page={page}";
																
						$TreeCom->URL = $com_url;
						$TreeCom->Navigation = true;
						$TreeCom->ComOnPage = $com_on_page;
						$TreeCom->Page = intval( $_REQUEST['com_page'] );
						if( $Offers->Config['com_ajax_navigation'] == "yes" ) $TreeCom->Ajax = true;
					}
						else
					{
						$TreeCom->Navigation = false;
					}
														
				if( $Offers->Config['com_allocation'] == "yes" ) $TreeCom->AllocationGroups = true;
				if( $Offers->Config['com_alternation'] == "yes" ) $TreeCom->Alternation = true;
				if( $allow_add_com ) $TreeCom->AllowAdd = true;
														
				$allow_group_com_moder = explode( ",", $Offers->Config['com_groups_moder'] );
				if( in_array( $member_id['user_group'], $allow_group_com_moder ) ) $TreeCom->AllowEdit = true;
				$TreeCom->ComDIR = "offers/{$Folder}/comments";
				$TreeCom->Page = intval( $_REQUEST['com_page'] );
				$TreeCom->start();
														
				$TreeCom->BuildNavigation();
				$tpl->result['offers_comments'] = "<div id=\"OffersCommentsList\">{$tpl->result['offers_comments']}</div>{$tpl->result['nav_comments']}";
														
				$TreeCom->apocalypse();
			}
	}
		else
	{
		$not_comments = true;	
	}
						
?>