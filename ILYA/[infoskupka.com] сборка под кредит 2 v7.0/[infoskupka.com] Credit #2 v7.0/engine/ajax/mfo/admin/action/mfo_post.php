<?php


//-------------------------------------------------====
//	Инициализация
//-------------------------------------------------====

if( !defined( "DATALIFEENGINE" ) ) die( "Hacking attempt!" );

//-------------------------------------------------====
//	Само выполнение
//-------------------------------------------------====

$action = $_REQUEST['action'];
$CheckMfoPost = $_REQUEST['CheckMfoPost'];
$Accept = intval( $_REQUEST['accept'] );
if( $action == "sort" && count( $CheckMfoPost ) < 1 ) $CheckMfoPost[] = 1;
if( is_array( $CheckMfoPost ) && count( $CheckMfoPost ) > 0 )
	{
		$HiddenCheck = "";
		foreach( $CheckMfoPost as $key => $id )
			{
				$id = intval( $id );
				if( !$id )
					{
						unset( $CheckMfoPost[ $key ] );
					}
						else
					{
						$CheckMfoPost[ $key ] = $id;
						$HiddenCheck .= "<input type=\"hidden\" name=\"CheckMfoPost[]\" value=\"{$id}\" />";
					}
			}
		
		$HiddenCheck .= "<input type=\"hidden\" name=\"accept\" value=\"1\" />";
		$HiddenCheck .= "<input type=\"hidden\" name=\"action\" value=\"{$action}\" />";
		$HiddenCheck .= "<input type=\"hidden\" name=\"TypeAction\" value=\"mfo_post\" />";
		
		$CountCheck = count( $CheckMfoPost );
		if( $CountCheck > 0 )
			{
				//-------------------------------------------------====
				//	Удаление
				//-------------------------------------------------====

				if( $action == "del" )
					{
						if( $Accept )
							{
								foreach( $CheckMfoPost as $id )
									{
										$id = intval( $id );
										if( $id )
											{
												$result = $db->query( "SELECT `id`,`category` FROM ".PREFIX."_mfo_post WHERE `id`='{$id}'" );
												if( $db->num_rows( $result ) > 0 )
													{
														while( $row = $db->get_row( $result ) )
															{
																$Mfo->DelPostCategory( $row['category'] );
																$db->query( "DELETE FROM ".PREFIX."_mfo_comments WHERE `mfo_id`='{$id}'" );
																$db->query( "DELETE FROM ".PREFIX."_mfo_post WHERE `id`='{$id}' LIMIT 1" );
															}
													}
											}
									}
									
								$Mfo->CleareAllCache();
								
echo <<<HTML

<div style="padding: 25px; text-align: center;">
	Выбранные <strong>({$CountCheck})</strong> офферы, были успешно удалены<br /><br />
	<a href="javascript:void(0);" onclick="UpdateList( 'mainmfo' ); return false;">Вернуться назад</a>
</div>

HTML;
								
							}
								else
							{
								
echo <<<HTML

<form method="post" action="" name="MfoMassAction" onsubmit="formSubmit( 'MfoMassAction', 'action.php', 'mainmfo', 'ajax.gif', 'UpdateStatus', 'UpdateStatus', UpdateButton ); return false;">
	<div style="padding: 25px; text-align: center;">
		Вы уверены, что хотите удалить выбранные <strong>({$CountCheck})</strong> МФО?<br /><br />
		<input type="submit" name="submit" value="Да" class="edit" />
		<input type="button" value="Нет" class="edit" onclick="UpdateList( 'mainmfo' ); return false;" />
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
								foreach( $CheckMfoPost as $id )
									{
										$id = intval( $id );
										if( $id )
											{
												$db->query( "UPDATE ".PREFIX."_mfo_post SET `approve`='1' WHERE `id`='{$id}' LIMIT 1" );
											}
									}
									
								$Mfo->CleareAllCache();
								
echo <<<HTML

<div style="padding: 25px; text-align: center;">
	Выбранные <strong>({$CountCheck})</strong> офферы, были успешно опубликованы<br /><br />
	<a href="javascript:void(0);" onclick="UpdateList( 'mainmfo' ); return false;">Вернуться назад</a>
</div>

HTML;
								
							}
								else
							{
								
echo <<<HTML

<form method="post" action="" name="MfoMassAction" onsubmit="formSubmit( 'MfoMassAction', 'action.php', 'mainmfo', 'ajax.gif', 'UpdateStatus', 'UpdateStatus', UpdateButton ); return false;">
	<div style="padding: 25px; text-align: center;">
		Вы уверены, что хотите опубликовать выбранные <strong>({$CountCheck})</strong> офферы?<br /><br />
		<input type="submit" name="submit" value="Да" class="edit" />
		<input type="button" value="Нет" class="edit" onclick="UpdateList( 'mainmfo' ); return false;" />
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
								foreach( $CheckMfoPost as $id )
									{
										$id = intval( $id );
										if( $id )
											{
												$db->query( "UPDATE ".PREFIX."_mfo_post SET `approve`='0' WHERE `id`='{$id}' LIMIT 1" );
											}
									}
									
								$Mfo->CleareAllCache();
								
echo <<<HTML

<div style="padding: 25px; text-align: center;">
	Выбранные <strong>({$CountCheck})</strong> офферы, были успешно отключены<br /><br />
	<a href="javascript:void(0);" onclick="UpdateList( 'mainmfo' ); return false;">Вернуться назад</a>
</div>

HTML;
								
							}
								else
							{
								
								
echo <<<HTML

<form method="post" action="" name="MfoMassAction" onsubmit="formSubmit( 'MfoMassAction', 'action.php', 'mainmfo', 'ajax.gif', 'UpdateStatus', 'UpdateStatus', UpdateButton ); return false;">
	<div style="padding: 25px; text-align: center;">
		Вы уверены, что хотите отключить выбранные <strong>({$CountCheck})</strong> офферы?<br /><br />
		<input type="submit" name="submit" value="Да" class="edit" />
		<input type="button" value="Нет" class="edit" onclick="UpdateList( 'mainmfo' ); return false;" />
		{$HiddenCheck}
	</div>
</form>

HTML;
								
							}
					}
						else
					{
						
						echo "<div style=\"padding: 25px; text-align: center;\">Выберите действие для офферов<br /><br /><a href=\"javascript:void(0);\" onclick=\"UpdateList( 'mainmfo' ); return false;\">Вернуться назад</a></div>";
								
					}
			}
				else
			{
				
				echo "<div style=\"padding: 25px; text-align: center;\">Выберите как минимум один оффер<br /><br /><a href=\"javascript:void(0);\" onclick=\"UpdateList( 'mainmfo' ); return false;\">Вернуться назад</a></div>";
				
			}
	}
		else
	{
		
		echo "<div style=\"padding: 25px; text-align: center;\">Выберите как минимум один оффер<br /><br /><a href=\"javascript:void(0);\" onclick=\"UpdateList( 'mainmfo' ); return false;\">Вернуться назад</a></div>";
		
	}

//-------------------------------------------------====
//	Завершение работы
//-------------------------------------------------====

$db->close();

?>