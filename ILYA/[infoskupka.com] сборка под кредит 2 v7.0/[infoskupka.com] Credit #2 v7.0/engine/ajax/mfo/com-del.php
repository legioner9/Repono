<?php


//-------------------------------------------------====
//	Инициализация
//-------------------------------------------------====

define( "ROOT_DIR", "../../.." );
define( "ENGINE_DIR", "../.." );
require_once( ENGINE_DIR."/ajax/mfo/OptAjax.php" );

//-------------------------------------------------====
//	Принятие и проверка данных
//-------------------------------------------------====

$id = intval( $_POST['id'] );
$mfo_id = intval( $_POST['mfo_id'] );
$otziv = intval( $_POST['otziv'] );
if( !$id ) echoReturn( "Приняты не все данные, попробуйте снова." );
if( !$mfo_id ) echoReturn( "Приняты не все данные, попробуйте снова." );
if( !$is_logged ) echoReturn( "Авторизируйтесь!" );
$allow_group_com_moder = explode( ",", $Mfo->Config['com_groups_moder'] );
if( !in_array( $member_id['user_group'], $allow_group_com_moder ) ) echoReturn( "Вы не можете удалять отзывы!" );

//-------------------------------------------------====
//	Само удаление и вывод сгенерированного
//-------------------------------------------------====

if( $Mfo->Config['com_del'] == "full" )
	{
		$db->query( "DELETE FROM ".PREFIX."_mfo_comments WHERE id='{$id}' LIMIT 1" );
		$db->query( "UPDATE ".PREFIX."_mfo_post SET comm_num=comm_num-1 WHERE id='{$mfo_id}'" );
		$db->query( "UPDATE ".PREFIX."_mfo_post SET rate=rate-{$otziv} WHERE id='{$mfo_id}'" );
								
echo <<<HTML
<script language="Javascript" type="text/javascript">
	var Element = document.getElementById( "mfo-full-com-{$id}" );
	Element.parentNode.removeChild( Element );
</script>
HTML;
								
	}
		else
	{
		$db->query( "UPDATE ".PREFIX."_mfo_comments SET del=1 WHERE id='{$id}'" );
		echo "<span class=\"mfo-comment-del\">Этот отзыв был удалён...</span>";
	}

//-------------------------------------------------====
//	Завершаем работу
//-------------------------------------------------====

$db->close();

?>