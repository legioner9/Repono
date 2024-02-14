<?php


if( !defined( "DATALIFEENGINE" ) ) die( "Hacking attempt!" );

// Комментарии
if( $Banki->Config['com_on'] == "yes" && $allow_comm == 1 )
	{
		// Форма добавления комментариев
		$com_groups_captcha = explode( ",", $Banki->Config['com_groups_captcha'] );
		$allow_groups_add_com = explode( ",", $Banki->Config['com_groups_add'] );
		if( $is_logged || $Banki->Config['com_anonim'] == "yes" )
			{
				if( in_array( $member_id['user_group'], $allow_groups_add_com ) || !$is_logged )
					{
						$allow_add_com = true;
						include_once( ENGINE_DIR."/modules/banki/addcomments.php" );
						include_once( ENGINE_DIR."/modules/banki/editor/bb_comment.php" );
						$tpl->Load_Template( "banki/{$Folder}/comments/addcomments.tpl" );
																
						$tpl->copy_template = "<div id=\"addcomments_form\">".$tpl->copy_template."<input type=\"hidden\" name=\"banki_id\" value=\"{$id}\" /></div>";
						$tpl->copy_template = "".$tpl->copy_template."<script language=\"javascript\" type=\"text/javascript\">var form_test = document.getElementById( 'addcomments_form' ).innerHTML;</script>";
						$tpl->set( "{editor}", $bb_code );
						$tpl->set( "{text}", $comment );
						$tpl->set( "{otz}", $otz );
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
								$tpl->set( "{captcha}", "<span id=\"dle-captcha\"><img src=\"/engine/modules/antibot/antibot.php\" border=\"0\" width=\"120\" height=\"50\" onclick=\"BankiReCaptcha(); return false;\" style=\"cursor: pointer;\" /></span>" );
								$tpl->set( "[captcha]", "" );
								$tpl->set( "[/captcha]", "" );
							}
								else
							{
								$tpl->set_block( "'\\[captcha\\](.*?)\\[/captcha\\]'si", "" );
							}
																
						$tpl->compile( "banki_addcomments" );
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
				require_once( ENGINE_DIR."/modules/banki/tree.comments.class.php" );
				$Banki->Config['com_sort'] = ( $Banki->Config['com_sort'] == "desc" ) ? "desc" : "asc";
														
				$TreeCom = new tree_comments();
				$TreeCom->CreateDB( "", $Banki->Config['com_sort'] );
														
				$com_on_page = intval( $Banki->Config['com_max_on_page'] );
				if( $Banki->Config['com_navigation_on'] == "yes" && $com_on_page > 0 )
					{
						$CatAltName = $Banki->DB['category'][ $category ]['alt_name'];
						$LinkCat = $Banki->ReturnLinkCategory( $category );
						if( $config['allow_alt_url'] )
							$com_url = "{$LinkCat}comm-nom-{page}/{$id}-{$alt_name}.html#otz";
						else
							$com_url = "/index.php?do=banki&amp;bankicat={$CatAltName}&amp;id={$id}&amp;com_page={page}";
																
						$TreeCom->URL = $com_url;
						$TreeCom->Navigation = true;
						$TreeCom->ComOnPage = $com_on_page;
						$TreeCom->Page = intval( $_REQUEST['com_page'] );
						if( $Banki->Config['com_ajax_navigation'] == "yes" ) $TreeCom->Ajax = true;
					}
						else
					{
						$TreeCom->Navigation = false;
					}
														
				if( $Banki->Config['com_allocation'] == "yes" ) $TreeCom->AllocationGroups = true;
				if( $Banki->Config['com_alternation'] == "yes" ) $TreeCom->Alternation = true;
				if( $allow_add_com ) $TreeCom->AllowAdd = true;
				if( $config['allow_cmod'] ) $where_approve = " AND " . PREFIX . "_banki_comments.approve=1";
				else $where_approve = "";										
				$allow_group_com_moder = explode( ",", $Banki->Config['com_groups_moder'] );
				if( in_array( $member_id['user_group'], $allow_group_com_moder ) ) $TreeCom->AllowEdit = true;
				$TreeCom->ComDIR = "banki/{$Folder}/comments";
				$TreeCom->Page = intval( $_REQUEST['com_page'] );
				$TreeCom->start();
														
				$TreeCom->BuildNavigation();
				$tpl->result['banki_comments'] = "<div id=\"BankiCommentsList\">{$tpl->result['banki_comments']}</div>{$tpl->result['nav_comments']}";
														
				$TreeCom->apocalypse();
			}
	}
		else
	{
		$not_comments = true;	
	}
						
?>