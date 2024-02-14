<?php


//-------------------------------------------------====
//	Инициализация
//-------------------------------------------------====

if( !defined( "DATALIFEENGINE" ) ) die( "Hacking attempt!" );

//-------------------------------------------------====
//	Само выполнение
//-------------------------------------------------====

$action = $_REQUEST['action'];
$CheckBankiPost = $_REQUEST['CheckBankiPost'];
$Accept = intval( $_REQUEST['accept'] );
if( $action == "sort" && count( $CheckBankiPost ) < 1 ) $CheckBankiPost[] = 1;
if( is_array( $CheckBankiPost ) && count( $CheckBankiPost ) > 0 )
	{
		$HiddenCheck = "";
		foreach( $CheckBankiPost as $key => $id )
			{
				$id = intval( $id );
				if( !$id )
					{
						unset( $CheckBankiPost[ $key ] );
					}
						else
					{
						$CheckBankiPost[ $key ] = $id;
						$HiddenCheck .= "<input type=\"hidden\" name=\"CheckBankiPost[]\" value=\"{$id}\" />";
					}
			}
		
		$HiddenCheck .= "<input type=\"hidden\" name=\"accept\" value=\"1\" />";
		$HiddenCheck .= "<input type=\"hidden\" name=\"action\" value=\"{$action}\" />";
		$HiddenCheck .= "<input type=\"hidden\" name=\"TypeAction\" value=\"banki_post\" />";
		
		$CountCheck = count( $CheckBankiPost );
		if( $CountCheck > 0 )
			{
				//-------------------------------------------------====
				//	Удаление
				//-------------------------------------------------====

				if( $action == "del" )
					{
						if( $Accept )
							{
								foreach( $CheckBankiPost as $id )
									{
										$id = intval( $id );
										if( $id )
											{
												$result = $db->query( "SELECT `id`,`category` FROM ".PREFIX."_banki_post WHERE `id`='{$id}'" );
												if( $db->num_rows( $result ) > 0 )
													{
														while( $row = $db->get_row( $result ) )
															{
																$Banki->DelPostCategory( $row['category'] );
																$db->query( "DELETE FROM ".PREFIX."_banki_comments WHERE `banki_id`='{$id}'" );
																$db->query( "DELETE FROM ".PREFIX."_banki_post WHERE `id`='{$id}' LIMIT 1" );
															}
													}
											}
									}
									
								$Banki->CleareAllCache();
								
echo <<<HTML

<div style="padding: 25px; text-align: center;">
	Выбранные <strong>({$CountCheck})</strong> офферы, были успешно удалены<br /><br />
	<a href="javascript:void(0);" onclick="UpdateList( 'mainbanki' ); return false;">Вернуться назад</a>
</div>

HTML;
								
							}
								else
							{
								
echo <<<HTML

<form method="post" action="" name="BankiMassAction" onsubmit="formSubmit( 'BankiMassAction', 'action.php', 'mainbanki', 'ajax.gif', 'UpdateStatus', 'UpdateStatus', UpdateButton ); return false;">
	<div style="padding: 25px; text-align: center;">
		Вы уверены, что хотите удалить выбранные <strong>({$CountCheck})</strong> офферы?<br /><br />
		<input type="submit" name="submit" value="Да" class="edit" />
		<input type="button" value="Нет" class="edit" onclick="UpdateList( 'mainbanki' ); return false;" />
		{$HiddenCheck}
	</div>
</form>

HTML;
								
							}
					}
				
				//-------------------------------------------------====
				//	Опубликовать
				//-------------------------------------------------====
				
				elseif( $action == "public" )
					{
						if( $Accept )
							{
								foreach( $CheckBankiPost as $id )
									{
										$id = intval( $id );
										if( $id )
											{
												$db->query( "UPDATE ".PREFIX."_banki_post SET `approve`='1' WHERE `id`='{$id}' LIMIT 1" );
											}
									}
									
								$Banki->CleareAllCache();
								
echo <<<HTML

<div style="padding: 25px; text-align: center;">
	Выбранные <strong>({$CountCheck})</strong> офферы, были успешно опубликованы<br /><br />
	<a href="javascript:void(0);" onclick="UpdateList( 'mainbanki' ); return false;">Вернуться назад</a>
</div>

HTML;
								
							}
								else
							{
								
echo <<<HTML

<form method="post" action="" name="BankiMassAction" onsubmit="formSubmit( 'BankiMassAction', 'action.php', 'mainbanki', 'ajax.gif', 'UpdateStatus', 'UpdateStatus', UpdateButton ); return false;">
	<div style="padding: 25px; text-align: center;">
		Вы уверены, что хотите опубликовать выбранные <strong>({$CountCheck})</strong> офферы?<br /><br />
		<input type="submit" name="submit" value="Да" class="edit" />
		<input type="button" value="Нет" class="edit" onclick="UpdateList( 'mainbanki' ); return false;" />
		{$HiddenCheck}
	</div>
</form>

HTML;
								
							}
					}
					
				//-------------------------------------------------====
				//	Удаление
				//-------------------------------------------------====
				
				elseif( $action == "unpublic" )
					{
						if( $Accept )
							{
								foreach( $CheckBankiPost as $id )
									{
										$id = intval( $id );
										if( $id )
											{
												$db->query( "UPDATE ".PREFIX."_banki_post SET `approve`='0' WHERE `id`='{$id}' LIMIT 1" );
											}
									}
									
								$Banki->CleareAllCache();
								
echo <<<HTML

<div style="padding: 25px; text-align: center;">
	Выбранные <strong>({$CountCheck})</strong> офферы, были успешно отключены<br /><br />
	<a href="javascript:void(0);" onclick="UpdateList( 'mainbanki' ); return false;">Вернуться назад</a>
</div>

HTML;
								
							}
								else
							{
								
								
echo <<<HTML

<form method="post" action="" name="BankiMassAction" onsubmit="formSubmit( 'BankiMassAction', 'action.php', 'mainbanki', 'ajax.gif', 'UpdateStatus', 'UpdateStatus', UpdateButton ); return false;">
	<div style="padding: 25px; text-align: center;">
		Вы уверены, что хотите отключить выбранные <strong>({$CountCheck})</strong> офферы?<br /><br />
		<input type="submit" name="submit" value="Да" class="edit" />
		<input type="button" value="Нет" class="edit" onclick="UpdateList( 'mainbanki' ); return false;" />
		{$HiddenCheck}
	</div>
</form>

HTML;
								
							}
					}
						else
					{
						
						echo "<div style=\"padding: 25px; text-align: center;\">Выберите действие для офферов<br /><br /><a href=\"javascript:void(0);\" onclick=\"UpdateList( 'mainbanki' ); return false;\">Вернуться назад</a></div>";
								
					}
			}
				else
			{
				
				echo "<div style=\"padding: 25px; text-align: center;\">Выберите как минимум один оффер<br /><br /><a href=\"javascript:void(0);\" onclick=\"UpdateList( 'mainbanki' ); return false;\">Вернуться назад</a></div>";
				
			}
	}
		else
	{
		
		echo "<div style=\"padding: 25px; text-align: center;\">Выберите как минимум один оффер<br /><br /><a href=\"javascript:void(0);\" onclick=\"UpdateList( 'mainbanki' ); return false;\">Вернуться назад</a></div>";
		
	}

//-------------------------------------------------====
//	Завершение работы
//-------------------------------------------------====

$db->close();

?>