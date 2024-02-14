<?php

//-------------------------------------------------====
//	Инициализация
//-------------------------------------------------====

define( "ROOT_DIR", "../../.." );
define( "ENGINE_DIR", "../.." );



require_once( ENGINE_DIR."/ajax/banki/OptAjax.php" );

//-------------------------------------------------====
//	Принятие и проверка данных
//-------------------------------------------------====

$id = intval( $_POST['banki_id'] );
$_POST['comments'] = CharsetConvert( $_POST['comments'] );
$_POST['name'] = CharsetConvert( $_POST['name'] );
$_POST['name_otziv'] = CharsetConvert( $_POST['name_otziv'] );
$_POST['tit_otziv'] = CharsetConvert( $_POST['tit_otziv'] );
$_POST['mail'] = CharsetConvert( $_POST['mail'] );

if( !$id ) echoReturn( "Приняты не все данные, попробуйте снова." );
if( $Banki->Config['com_on'] != "yes" ) echoReturn( "Отзывы отключены" );
if( !$is_logged && $Banki->Config['com_anonim'] != "yes" ) echoReturn( "Вы не можете добавить отзыв" );

$result = $db->query( "SELECT `id`,`allow_comm`,`title`,`alt_name`,`category`,`author_id` FROM ".PREFIX."_banki_post WHERE `id`='{$id}' AND `approve`='1' LIMIT 1" );
if( $db->num_rows( $result ) > 0 )
	{
		$row = $db->get_row( $result );
		if( $row['allow_comm'] != 1 ) echoReturn( "Отзывы отключены" );
	}
		else
	{
		echoReturn( "Банк не найден" );
	}

//-------------------------------------------------====
//	Добавление комментария
//-------------------------------------------------====

require_once( ENGINE_DIR."/modules/banki/addcomments.php" );

//-------------------------------------------------====
//	Вывод комментария
//-------------------------------------------------====

if( empty( $error ) )
	{
		require_once( ENGINE_DIR."/modules/banki/tree.comments.class.php" );
		
		//	Выкручиваемся от лишних запросов для поиска комментария по его ID, который только что написал пользователь.
		//	То есть просто берём самый последний комментарий и выводим его пользователю.
		
		$TreeCom = new tree_comments();
		
		$comments_query = "SELECT ".PREFIX."_banki_comments.id, banki_id, del, author_id, answer, author, text, otziv, name_otziv, tit_otziv, ip, date, ".PREFIX."_banki_comments.email as com_email, ".USERPREFIX."_users.email, news_num, comm_num, user_group, reg_date, signature, foto, fullname, land, xfields FROM ".PREFIX."_banki_comments LEFT JOIN ".USERPREFIX."_users ON ".PREFIX."_banki_comments.author_id=".USERPREFIX."_users.user_id WHERE ".PREFIX."_banki_comments.banki_id = '{$id}' ORDER BY id DESC LIMIT 0,1";
		
		$TreeCom->CreateDB( "", "", $comments_query );	
		$TreeCom->AllowAdd = true;
		if( $Banki->Config['com_allocation'] == "yes" ) $TreeCom->AllocationGroups = true;
		if( $Banki->Config['com_alternation'] == "yes" ) $TreeCom->Alternation = true;
		$TreeCom->NoCom['template'] = "banki/default/comments/info.tpl";
		$TreeCom->ComDIR = "banki/default/comments";
		
		$allow_group_com_moder = explode( ",", $Banki->Config['com_groups_moder'] );
		if( in_array( $member_id['user_group'], $allow_group_com_moder ) ) $TreeCom->AllowEdit = true;
		
		if( $_POST['answer_id'] )
			$TreeCom->start( 3 );
		else
			$TreeCom->start( 0 );
		
		$TreeCom->apocalypse();
		
		$tpl->result['content'] = str_replace( "{THEME}", $THEME, $tpl->result['banki_comments'] );
		echo $tpl->result['content'];
	}
		else
	{
		echoReturn( $error );
	}

//-------------------------------------------------====
//	Завершаем работу
//-------------------------------------------------====

$db->close();

?>