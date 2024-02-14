<?php
/*
=====================================================
 Файл: addcomments.php
=====================================================
 Данный код защищен авторскими правами
=====================================================
 Назначение: ajax добавление комментария
=====================================================
*/

//-------------------------------------------------====
//	Инициализация
//-------------------------------------------------====

define( "ROOT_DIR", "../../.." );
define( "ENGINE_DIR", "../.." );
require_once( ENGINE_DIR."/ajax/offers/OptAjax.php" );
require_once (DLEPlugins::Check(ENGINE_DIR . '/classes/templates.class.php'));

//-------------------------------------------------====
//	Принятие и проверка данных
//-------------------------------------------------====

$id = intval( $_POST['offers_id'] );
$_POST['comments'] = CharsetConvert( $_POST['comments'] );
$_POST['name'] = CharsetConvert( $_POST['name'] );
$_POST['name_otziv'] = CharsetConvert( $_POST['name_otziv'] );
$_POST['tit_otziv'] = CharsetConvert( $_POST['tit_otziv'] );
$_POST['mail'] = CharsetConvert( $_POST['mail'] );

if( !$id ) echoReturn( "Приняты не все данные, попробуйте снова." );
if( $Offers->Config['com_on'] != "yes" ) echoReturn( "Отзывы отключены" );
if( !$is_logged && $Offers->Config['com_anonim'] != "yes" ) echoReturn( "Вы не можете добавить отзыв" );


$result = $db->query( "SELECT `id`,`allow_comm`,`title`,`alt_name`,`category`,`author_id` FROM ".PREFIX."_offers_post WHERE `id`='{$id}' AND `approve`='1' LIMIT 1" );
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

require_once( ENGINE_DIR."/modules/offers/addcomments.php" );

//-------------------------------------------------====
//	Вывод комментария
//-------------------------------------------------====

if( empty( $error ) )
	{
		require_once( ENGINE_DIR."/modules/offers/tree.comments.class.php" );
		
		//	Выкручиваемся от лишних запросов для поиска комментария по его ID, который только что написал пользователь.
		//	То есть просто берём самый последний комментарий и выводим его пользователю.
		
		$TreeCom = new tree_comments();
		
		$comments_query = "SELECT ".PREFIX."_offers_comments.id, offers_id, del, author_id, answer, author, text, otziv, name_otziv, tit_otziv, ip, date, ".PREFIX."_offers_comments.email as com_email, ".USERPREFIX."_users.email, news_num, comm_num, user_group, reg_date, signature, foto, fullname, land, xfields FROM ".PREFIX."_offers_comments LEFT JOIN ".USERPREFIX."_users ON ".PREFIX."_offers_comments.author_id=".USERPREFIX."_users.user_id WHERE ".PREFIX."_offers_comments.offers_id = '{$id}' ORDER BY id DESC LIMIT 0,1";
		
		$TreeCom->CreateDB( "", "", $comments_query );	
		$TreeCom->AllowAdd = true;
		if( $Offers->Config['com_allocation'] == "yes" ) $TreeCom->AllocationGroups = true;
		if( $Offers->Config['com_alternation'] == "yes" ) $TreeCom->Alternation = true;
		$TreeCom->NoCom['template'] = "offers/default/comments/info.tpl";
		$TreeCom->ComDIR = "offers/default/comments";
		
		$allow_group_com_moder = explode( ",", $Offers->Config['com_groups_moder'] );
		if( in_array( $member_id['user_group'], $allow_group_com_moder ) ) $TreeCom->AllowEdit = true;
		
		if( $_POST['answer_id'] )
			$TreeCom->start( 3 );
		else
			$TreeCom->start( 0 );
		
		$TreeCom->apocalypse();
		
		$tpl->result['content'] = str_replace( "{THEME}", $THEME, $tpl->result['offers_comments'] );
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