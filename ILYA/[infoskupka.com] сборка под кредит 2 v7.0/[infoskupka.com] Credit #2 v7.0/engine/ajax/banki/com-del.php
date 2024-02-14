<?php
/*
=====================================================
 Файл: com-del.php
=====================================================
 Данный код защищен авторскими правами
=====================================================
 Назначение: ajax удаление комментария
=====================================================
*/

//-------------------------------------------------====
//	Инициализация
//-------------------------------------------------====

define( "ROOT_DIR", "../../.." );
define( "ENGINE_DIR", "../.." );
require_once( ENGINE_DIR."/ajax/banki/OptAjax.php" );

//-------------------------------------------------====
//	Принятие и проверка данных
//-------------------------------------------------====

$id = intval( $_POST['id'] );
$banki_id = intval( $_POST['banki_id'] );
$otziv = intval( $_POST['otziv'] );
if( !$id ) echoReturn( "Приняты не все данные, попробуйте снова." );
if( !$banki_id ) echoReturn( "Приняты не все данные, попробуйте снова." );
if( !$is_logged ) echoReturn( "Авторизируйтесь!" );
$allow_group_com_moder = explode( ",", $Banki->Config['com_groups_moder'] );
if( !in_array( $member_id['user_group'], $allow_group_com_moder ) ) echoReturn( "Вы не можете удалять отзывы!" );

//-------------------------------------------------====
//	Само удаление и вывод сгенерированного
//-------------------------------------------------====

if( $Banki->Config['com_del'] == "full" )
	{
		$db->query( "DELETE FROM ".PREFIX."_banki_comments WHERE id='{$id}' LIMIT 1" );
		$db->query( "UPDATE ".PREFIX."_banki_post SET comm_num=comm_num-1 WHERE id='{$banki_id}'" );
		$db->query( "UPDATE ".PREFIX."_banki_post SET rate=rate-{$otziv} WHERE id='{$banki_id}'" ); 
		
echo <<<HTML
<script language="Javascript" type="text/javascript">
	var Element = document.getElementById( "banki-full-com-{$id}" );
	Element.parentNode.removeChild( Element );
</script>
HTML;
								
	}
		else
	{
		$db->query( "UPDATE ".PREFIX."_banki_comments SET del=1 WHERE id='{$id}'" );
		echo "<span class=\"banki-comment-del\">Этот отзыв был удалён...</span>";
	}

//-------------------------------------------------====
//	Завершаем работу
//-------------------------------------------------====

$db->close();

?>