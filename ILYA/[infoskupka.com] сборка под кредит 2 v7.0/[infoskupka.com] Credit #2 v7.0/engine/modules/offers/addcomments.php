<?php


include_once ENGINE_DIR . '/classes/plugins.class.php';

if( !defined( "DATALIFEENGINE" ) ) die( "Hacking attempt!" );

if( ( $is_logged || $Offers->Config['com_anonim'] == "yes" ) && isset( $_POST['addcomment'] ) )
	{
		$error = "";
		if( intval( $Offers->Config['com_antispam'] ) > 0 && $_SESSION['offers_add_com_time'] )
			{
				$limit_sec = intval( $proposal_config['com_antispam'] );
				$this_time = ( time () + ( $config['date_adjust'] * 60 ) );
				$period = $this_time - $_SESSION['offers_add_com_time'];
				if( $period < $limit_sec ) 
					$error = "Сработала антиспам система, следующий отзыв вы сможете добавить через ".( $limit_sec - $period )." сек.";
				else
					@session_unregister( "offers_add_com_time" );
			}
		
		$GroupComCaptcha = explode( ",", $Offers->Config['com_groups_captcha'] );
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
		$name_otziv = $db->safesql( $parse->BB_Parse( $parse->process( $_POST['name_otziv'] ), false ) );
		$tit_otziv = $db->safesql( $parse->BB_Parse( $parse->process( $_POST['tit_otziv'] ), false ) );
		
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
		
		if( strlen( $comment ) < 10 ) $error = "Минимальное колличество символов: 10";
		if( strlen( $comment ) > 2000 ) $error = "Максимальное колличество символов: 2000";
		if( empty( $error ) )
			{
				$ok_add_com = true;
				$db->query( "INSERT INTO ".PREFIX."_offers_comments (author,author_id,email,text,otziv,name_otziv,tit_otziv,date,offers_id,del,ip,answer) VALUES('$author','$author_id','$email','$comment','$otziv','$name_otziv','$tit_otziv','$thisdate','$id','0','$_IP','$answer_id')" ); 
				$db->query( "UPDATE ".PREFIX."_offers_post SET comm_num=comm_num+1 WHERE id='{$id}'" );
				
				if( in_array( "on_create", $Offers->AllowSendEmail ) )
					{
						$rowUser = $db->super_query( "SELECT `name`,`email` FROM ".USERPREFIX."_users WHERE `user_id`='{$row['author_id']}'" );
						if( $rowUser['email'] )
							{
								$Offers->SendEmail( "send_on_comment", "Оставлен отзыв об оффере", "", $rowUser['email'], array(
									"title"			=> stripslashes( $row['title'] ),
									"link"			=> "https://".$_SERVER['HTTP_HOST'].$Offers->ReturnLinkPost( $row['id'], $row['alt_name'], $row['category'] ),
									"user"			=> stripslashes( $rowUser['name'] ),
								) );
							}
					}
				
				@session_register( "offers_add_com_time" );
				$_SESSION['offers_add_com_time'] = ( time () + ( $config['date_adjust'] * 60 ) );
				$_SESSION['sec_code_session'] = "";
				$comm_num++;
						
				$comment = "";
			}
	}
?>