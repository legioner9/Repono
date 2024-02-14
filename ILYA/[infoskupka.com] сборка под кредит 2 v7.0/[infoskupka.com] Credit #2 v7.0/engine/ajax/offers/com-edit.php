<?php
/*
=====================================================
 Файл: com-edit.php
=====================================================
 Данный код защищен авторскими правами
=====================================================
 Назначение: ajax редактирование комментариев
=====================================================
*/

//-------------------------------------------------====
//	Инициализация
//-------------------------------------------------====

define( "ROOT_DIR", "../../.." );
define( "ENGINE_DIR", "../.." );
require_once( ENGINE_DIR."/ajax/offers/OptAjax.php" );

//-------------------------------------------------====
//	Принятие и проверка данных
//-------------------------------------------------====

$id = intval( $_POST['id'] );
if( !$id ) echoReturn( "Приняты не все данные, попробуйте снова." );
if( !$is_logged ) echoReturn( "Авторизируйтесь!" );
$allow_group_com_moder = explode( ",", $Offers->Config['com_groups_moder'] );
if( !in_array( $member_id['user_group'], $allow_group_com_moder ) ) echoReturn( "Вы не можете редактировать отзыв!" );

//-------------------------------------------------====
//	Запрос для получения информации о комментарие
//-------------------------------------------------====

$query_com = $db->query( "SELECT text FROM ".PREFIX."_offers_comments WHERE id='{$id}'" );
if( $db->num_rows( $query_com ) > 0 )
	{
		$row_com = $db->get_row( $query_com );
		require_once( ENGINE_DIR."/classes/parse.class.php" );		
		
		//-------------------------------------------------====
		//	Сохранение редактирования
		//-------------------------------------------------====
		
		if( $_POST['save'] == 1 )
			{
				$ErrorEditCom = "";
				$comments = CharsetConvert( stripslashes( trim( $_POST['comments'] ) ) );
				if( strlen( $comments ) < 11 ) $ErrorEditCom = "Слишком короткий отзыв!";
								
				if( empty( $ErrorEditCom ) )
					{
						$parse = new ParseFilter();
						$parse->safe_mode = true;
						$parse->allow_url = $user_group[ $member_id['user_group'] ]['allow_url'];
						$parse->allow_image = $user_group[ $member_id['user_group'] ]['allow_image'];
										
						$comments = $parse->BB_Parse( $parse->process( $comments ), false );
						
						$comments_save = $db->safesql( $comments );
						$db->query( "UPDATE ".PREFIX."_offers_comments SET `text`='{$comments_save}' WHERE id='{$id}'" );
										
						$comments = stripslashes( stripslashes( $comments ) );
						echo "{$comments}<script language=\"javascript\" type=\"text/javascript\">delete( OffersCasheComEdit['{$id}'] );</script>";
					}
						else
					{
						echo "Обнаружена ошибка, идёт повторная загрузка формы редактирования комментария...<script language=\"javascript\" type=\"text/javascript\">alert( '{$ErrorEditCom}' ); OffersEditCom( '{$id}' );</script>";
					}
			}
			
			//-------------------------------------------------====
			//	Вывод формы редактирования комментария
			//-------------------------------------------------====
			
				else
			{
				$parse = new ParseFilter();
				$parse->safe_mode = true;
				$parse->allow_url = $user_group[ $member_id['user_group'] ]['allow_url'];
				$parse->allow_image = $user_group[ $member_id['user_group'] ]['allow_image'];						
						
				include_once( ENGINE_DIR."/ajax/bbcode.php" );
				$comm_txt = $parse->decodeBBCodes( $row_com['text'], false );
				$JS = "<script language=\"javascript\" type=\"text/javascript\">var fombj = document.forms['AddOffersComment']</script>";
						
echo <<<HTML

<div class="editor">
	{$bb_code}
	<textarea name="dleeditcomments{$id}" id="dleeditcomments{$id}" onclick="setNewField(this.name, document.forms['AddOffersComment'] )" style="width: 99%; height: 150px; border: 1px solid #E0E0E0; margin: 0px 1px 0px 0px;padding: 0px;">{$comm_txt}</textarea><br />
	<div align="right" style="width: 99%; padding-top: 5px;">
		<input class="bbcodes" title="$lang[bb_t_apply]" type="button" onclick="OffersSaveEditCom( '{$id}', '{$post_id}' ); return false;" value="$lang[bb_b_apply]" />
		<input class="bbcodes" title="$lang[bb_t_cancel]" type="button" onclick="CanceOffersEditCom( '{$id}' ); return false;" value="$lang[bb_b_cancel]" />
	</div>
</div>
$JS

HTML;

			}
	}
		else
	{
		echoReturn( "Указанный комментарий не найден!" );
	}

//-------------------------------------------------====
//	Завершаем работу
//-------------------------------------------------====

$db->close();

?>