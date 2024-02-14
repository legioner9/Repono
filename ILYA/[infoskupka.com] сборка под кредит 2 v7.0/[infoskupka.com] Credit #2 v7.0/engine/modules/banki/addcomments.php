<?php
/*
=====================================================
 Файл: addcomments.php
=====================================================
 Данный код защищен авторскими правами
=====================================================
 Назначение: добавление комментариев
=====================================================
*/

include_once ENGINE_DIR . '/classes/plugins.class.php';

if( !defined( "DATALIFEENGINE" ) ) die( "Hacking attempt!" );

if( ( $is_logged || $Banki->Config['com_anonim'] == "yes" ) && isset( $_POST['addcomment'] ) )
	{
		$error = "";
		if( intval( $Banki->Config['com_antispam'] ) > 0 && $_SESSION['banki_add_com_time'] )
			{
				$limit_sec = intval( $proposal_config['com_antispam'] );
				$this_time = ( time () + ( $config['date_adjust'] * 60 ) );
				$period = $this_time - $_SESSION['banki_add_com_time'];
				if( $period < $limit_sec ) 
					$error = "Сработала антиспам система, следующий отзыв вы сможете добавить через ".( $limit_sec - $period )." сек.";
				else
					@session_unregister( "banki_add_com_time" );
			}
		
		$GroupComCaptcha = explode( ",", $Banki->Config['com_groups_captcha'] );
		if( in_array( $member_id['user_group'], $GroupComCaptcha ) )
			{
				if( $_REQUEST['sec_code'] != $_SESSION['sec_code_session'] || !$_SESSION['sec_code_session'] ) $error = "Введён не верный код безопастности!";
			}
		
		require_once( ENGINE_DIR."/classes/parse.class.php" );
		$author = $member_id['name'];
		$author_id = $member_id['user_id'];
		$email = $member_id['email'];
		$answer_id = intval( $_POST['answer_id'] );
		
		$parse = new ParseFilter();
		$parse->safe_mode = true;
		$parse->allow_url = $user_group[ $member_id['user_group'] ]['allow_url'];
		$parse->allow_image = $user_group[ $member_id['user_group'] ]['allow_image'];
		$comment = $db->safesql( $parse->BB_Parse( $parse->process( $_POST['comments'] ), false ) );
		$otziv = $db->safesql( $parse->BB_Parse( $parse->process( $_POST['otziv'] ), false ) );
		$tit_otziv = $db->safesql( $parse->BB_Parse( $parse->process( $_POST['tit_otziv'] ), false ) );
		$name_otziv = $db->safesql( $parse->BB_Parse( $parse->process( $_POST['name_otziv'] ), false ) );
		$thisdate = date ( "Y-m-d H:i", ( time () + ( $config['date_adjust'] * 60 ) ) );
		$_IP = $_SERVER['REMOTE_ADDR'];
		
		if( !$is_logged )
			{
				$author_id = "";
				$email = trim( $_POST['email'] );
				$author = $db->safesql( htmlspecialchars( trim( CharsetConvert( $_POST['name'] ) ) ) );
				if( !$author || strlen( $author ) < 3 ) $error = "Имя пользователя, должно быть не менее 4-х символов.";
				if( !preg_match( "/^[\.A-z0-9_\-]+[@][A-z0-9_\-]+([.][A-z0-9_\-]+)+[A-z]{1,4}$/", $email ) ) $error = "Вы ввели неверный E-mail адрес.";
				
				if( empty( $error ) )
					{
						$db->query( "SELECT name FROM ".PREFIX."_users WHERE LOWER(name) = '".strtolower( $author )."' OR email = '{$email}'" );
						if( $db->num_rows() > 0 ) $error = "Имя или email уже используется зарегестрированным пользователем.";
					}
			}
		
		if( strlen( $comment ) < 20 ) $error = "Минимальное колличество символов: 20";
		if( strlen( $comment ) > 2000 ) $error = "Максимальное колличество символов: 2000";
		if( empty( $error ) )
			{
				$ok_add_com = true;
				$db->query( "INSERT INTO ".PREFIX."_banki_comments (author,author_id,email,text,otziv,name_otziv,tit_otziv,date,banki_id,del,ip,answer) VALUES('$author','$author_id','$email','$comment','$otziv','$name_otziv','$tit_otziv','$thisdate','$id','0','$_IP','$answer_id')" );
				$db->query( "UPDATE ".PREFIX."_banki_post SET comm_num=comm_num+1 WHERE id='{$id}'" );
				
				
				if( in_array( "on_create", $Banki->AllowSendEmail ) )
					{
						$rowUser = $db->super_query( "SELECT `name`,`email` FROM ".USERPREFIX."_users WHERE `user_id`='{$row['author_id']}'" );
						if( $rowUser['email'] )
							{
								$Banki->SendEmail( "send_on_comment", "Оставлен отзыв о банке", "", $rowUser['email'], array(
									"title"			=> stripslashes( $row['title'] ),
									"link"			=> "https://".$_SERVER['HTTP_HOST'].$Banki->ReturnLinkPost( $row['id'], $row['alt_name'], $row['category'] ),
									"user"			=> stripslashes( $rowUser['name'] ),
								) );
							}
					}
				
				@session_register( "banki_add_com_time" );
				$_SESSION['banki_add_com_time'] = ( time () + ( $config['date_adjust'] * 60 ) );
				$_SESSION['sec_code_session'] = "";
				$comm_num++;
						
				$comment = "";
			}
	}
?>