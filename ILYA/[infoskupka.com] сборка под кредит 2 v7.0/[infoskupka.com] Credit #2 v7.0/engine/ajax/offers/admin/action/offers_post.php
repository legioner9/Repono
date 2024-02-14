<?php


//-------------------------------------------------====
//	Инициализация
//-------------------------------------------------====

if( !defined( "DATALIFEENGINE" ) ) die( "Hacking attempt!" );

//-------------------------------------------------====
//	Само выполнение
//-------------------------------------------------====

$action = $_REQUEST['action'];
$CheckOffersPost = $_REQUEST['CheckOffersPost'];
$Accept = intval( $_REQUEST['accept'] );
if( $action == "sort" && count( $CheckOffersPost ) < 1 ) $CheckOffersPost[] = 1;
if( is_array( $CheckOffersPost ) && count( $CheckOffersPost ) > 0 )
	{
		$HiddenCheck = "";
		foreach( $CheckOffersPost as $key => $id )
			{
				$id = intval( $id );
				if( !$id )
					{
						unset( $CheckOffersPost[ $key ] );
					}
						else
					{
						$CheckOffersPost[ $key ] = $id;
						$HiddenCheck .= "<input type=\"hidden\" name=\"CheckOffersPost[]\" value=\"{$id}\" />";
					}
			}
		
		$HiddenCheck .= "<input type=\"hidden\" name=\"accept\" value=\"1\" />";
		$HiddenCheck .= "<input type=\"hidden\" name=\"action\" value=\"{$action}\" />";
		$HiddenCheck .= "<input type=\"hidden\" name=\"TypeAction\" value=\"offers_post\" />";
		
		$CountCheck = count( $CheckOffersPost );
		if( $CountCheck > 0 )
			{
				//-------------------------------------------------====
				//	Сортировка
				//-------------------------------------------------====

				if( $action == "sort" )
					{
						$Sort = $_REQUEST['sort'];
						if( count( $Sort ) > 0 && is_array( $Sort ) )
							{
								foreach( $Sort as $id => $value )
									{
										$value = intval( $value );
										$id = intval( $id );
										if( $id )
											{
												$db->query( "UPDATE ".PREFIX."_offers_post SET `sort`='{$value}' WHERE `id`='{$id}' LIMIT 1" );
											}
									}
											
								echo "<span style=\"color: green; font-weight: bold;\">Отсортировано</span>";
								$Offers->CleareAllCache();
							}
								else
							{
								echo "<span style=\"color: #F00; font-weight: bold;\">Ошибка</span>";
							}
					}
					
				//-------------------------------------------------====
				//	Удаление
				//-------------------------------------------------====

				if( $action == "del" )
					{
						if( $Accept )
							{
								foreach( $CheckOffersPost as $id )
									{
										$id = intval( $id );
										if( $id )
											{
												$result = $db->query( "SELECT `id`,`category` FROM ".PREFIX."_offers_post WHERE `id`='{$id}'" );
												if( $db->num_rows( $result ) > 0 )
													{
														while( $row = $db->get_row( $result ) )
															{
																$Offers->DelPostCategory( $row['category'] );
																$db->query( "DELETE FROM ".PREFIX."_offers_comments WHERE `offers_id`='{$id}'" );
																$db->query( "DELETE FROM ".PREFIX."_offers_post WHERE `id`='{$id}' LIMIT 1" );
															}
													}
											}
									}
									
								$Offers->CleareAllCache();
								
echo <<<HTML

<div style="padding: 25px; text-align: center;">
	Выбранные <strong>({$CountCheck})</strong> офферы, были успешно удалены<br /><br />
	<a href="javascript:void(0);" onclick="UpdateList( 'mainoffers' ); return false;">Вернуться назад</a>
</div>

HTML;
								
							}
								else
							{
								
echo <<<HTML

<form method="post" action="" name="OffersMassAction" onsubmit="formSubmit( 'OffersMassAction', 'action.php', 'mainoffers', 'ajax.gif', 'UpdateStatus', 'UpdateStatus', UpdateButton ); return false;">
	<div style="padding: 25px; text-align: center;">
		Вы уверены, что хотите удалить выбранные <strong>({$CountCheck})</strong> офферы?<br /><br />
		<input type="submit" name="submit" value="Да" class="edit" />
		<input type="button" value="Нет" class="edit" onclick="UpdateList( 'mainoffers' ); return false;" />
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
								foreach( $CheckOffersPost as $id )
									{
										$id = intval( $id );
										if( $id )
											{
												$db->query( "UPDATE ".PREFIX."_offers_post SET `approve`='1' WHERE `id`='{$id}' LIMIT 1" );
											}
									}
									
								$Offers->CleareAllCache();
								
echo <<<HTML

<div style="padding: 25px; text-align: center;">
	Выбранные <strong>({$CountCheck})</strong> офферы, были успешно опубликованы<br /><br />
	<a href="javascript:void(0);" onclick="UpdateList( 'mainoffers' ); return false;">Вернуться назад</a>
</div>

HTML;
								
							}
								else
							{
								
echo <<<HTML

<form method="post" action="" name="OffersMassAction" onsubmit="formSubmit( 'OffersMassAction', 'action.php', 'mainoffers', 'ajax.gif', 'UpdateStatus', 'UpdateStatus', UpdateButton ); return false;">
	<div style="padding: 25px; text-align: center;">
		Вы уверены, что хотите опубликовать выбранные <strong>({$CountCheck})</strong> офферы?<br /><br />
		<input type="submit" name="submit" value="Да" class="edit" />
		<input type="button" value="Нет" class="edit" onclick="UpdateList( 'mainoffers' ); return false;" />
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
								foreach( $CheckOffersPost as $id )
									{
										$id = intval( $id );
										if( $id )
											{
												$db->query( "UPDATE ".PREFIX."_offers_post SET `approve`='0' WHERE `id`='{$id}' LIMIT 1" );
											}
									}
									
								$Offers->CleareAllCache();
								
echo <<<HTML

<div style="padding: 25px; text-align: center;">
	Выбранные <strong>({$CountCheck})</strong> офферы, были успешно отключены<br /><br />
	<a href="javascript:void(0);" onclick="UpdateList( 'mainoffers' ); return false;">Вернуться назад</a>
</div>

HTML;
								
							}
								else
							{
								
								
echo <<<HTML

<form method="post" action="" name="OffersMassAction" onsubmit="formSubmit( 'OffersMassAction', 'action.php', 'mainoffers', 'ajax.gif', 'UpdateStatus', 'UpdateStatus', UpdateButton ); return false;">
	<div style="padding: 25px; text-align: center;">
		Вы уверены, что хотите отключить выбранные <strong>({$CountCheck})</strong> офферы?<br /><br />
		<input type="submit" name="submit" value="Да" class="edit" />
		<input type="button" value="Нет" class="edit" onclick="UpdateList( 'mainoffers' ); return false;" />
		{$HiddenCheck}
	</div>
</form>

HTML;
								
							}
					}
						else
					{
						
						echo "";
								
					}
			}
				else
			{
				
				echo "<div style=\"padding: 25px; text-align: center;\">Выберите как минимум один оффер<br /><br /><a href=\"javascript:void(0);\" onclick=\"UpdateList( 'mainoffers' ); return false;\">Вернуться назад</a></div>";
				
			}
	}
		else
	{
		
		echo "<div style=\"padding: 25px; text-align: center;\">Выберите как минимум один оффер<br /><br /><a href=\"javascript:void(0);\" onclick=\"UpdateList( 'mainoffers' ); return false;\">Вернуться назад</a></div>";
		
	}

//-------------------------------------------------====
//	Завершение работы
//-------------------------------------------------====

$db->close();

?>