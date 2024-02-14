<?php


//-------------------------------------------------====
//	Инициализация
//-------------------------------------------------====

if( !defined( "DATALIFEENGINE" ) ) die( "Hacking attempt!" );

//-------------------------------------------------====
//	Само выполнение
//-------------------------------------------------====

if( $Mfo->Field === false ) $Mfo->StartField( true );

$action = $_REQUEST['action'];
$CheckFields = $_REQUEST['CheckFields'];
$Accept = intval( $_REQUEST['accept'] );
if( $action == "sort" && count( $CheckFields ) < 1 ) $CheckFields[] = 1;
if( is_array( $CheckFields ) && count( $CheckFields ) > 0 )
	{
		$HiddenCheck = "";
		foreach( $CheckFields as $key => $id )
			{
				$id = intval( $id );
				if( !$id )
					{
						unset( $CheckFields[ $key ] );
					}
						else
					{
						$CheckFields[ $key ] = $id;
						$HiddenCheck .= "<input type=\"hidden\" name=\"CheckFields[]\" value=\"{$id}\" />";
					}
			}
		
		$HiddenCheck .= "<input type=\"hidden\" name=\"accept\" value=\"1\" />";
		$HiddenCheck .= "<input type=\"hidden\" name=\"action\" value=\"{$action}\" />";
		$HiddenCheck .= "<input type=\"hidden\" name=\"TypeAction\" value=\"fields\" />";
		
		$CountCheck = count( $CheckFields );
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
												$Mfo->Field->DB[ $id ][11] = $value;
											}
									}
											
								echo "<span style=\"color: green; font-weight: bold;\">Отсортировано</span><script language=\"javascript\" type=\"text/javascript\">UpdateList( 'fields' );</script>";
								$Mfo->Field->SaveDB();
							}
								else
							{
								echo "<span style=\"color: #F00; font-weight: bold;\">Ошибка</span>";
							}
					}
					
				//-------------------------------------------------====
				//	Удаление
				//-------------------------------------------------====

				elseif( $action == "del" )
					{
						if( $Accept )
							{
								foreach( $CheckFields as $id )
									{
										$id = intval( $id );
										if( $id )
											{
												$Mfo->Field->Delete( $id );
											}
									}
								
								opentable();
								tableheader( "Список дополнительных полей &raquo; Массовые действия" );
echo <<<HTML

<div style="padding: 25px; text-align: center;">
	Выбранные <strong>({$CountCheck})</strong> доп. поля, были успешно удалены<br /><br />
	<a href="javascript:void(0);" onclick="UpdateList( 'fields' ); return false;">Вернуться назад</a>
</div>

HTML;
								closetable();
							}
								else
							{
								opentable();
								tableheader( "Список дополнительных полей &raquo; Массовые действия" );
								$SelectCategory = $Mfo->SelectCategory( "", $CheckFields );
echo <<<HTML

<form method="post" action="" name="MfoMassAction" onsubmit="formSubmit( 'MfoMassAction', 'action.php', 'fields', 'ajax.gif', 'UpdateStatus', 'UpdateStatus', UpdateButton ); return false;">
	<div style="padding: 25px; text-align: center;">
		Вы уверены, что хотите удалить выбранные <strong>({$CountCheck})</strong> доп. поля?<br /><br />
		<input type="submit" name="submit" value="Да" class="edit" />
		<input type="button" value="Нет" class="edit" onclick="UpdateList( 'fields' ); return false;" />
		{$HiddenCheck}
	</div>
</form>

HTML;
								closetable();
							}
					}
						else
					{
						opentable();
						tableheader( "Список дополнительных полей &raquo; Массовые действия" );
						echo "<div style=\"padding: 25px; text-align: center;\">Выберите действие для доп. полей<br /><br /><a href=\"javascript:void(0);\" onclick=\"UpdateList( 'fields' ); return false;\">Вернуться назад</a></div>";
						closetable();		
					}
			}
				else
			{
				opentable();
				tableheader( "Список дополнительных полей &raquo; Массовые действия" );
				echo "<div style=\"padding: 25px; text-align: center;\">Выберите как минимум одно доп. поле<br /><br /><a href=\"javascript:void(0);\" onclick=\"UpdateList( 'fields' ); return false;\">Вернуться назад</a></div>";
				closetable();
			}
	}
		else
	{
		opentable();
		tableheader( "Список дополнительных полей &raquo; Массовые действия" );
		echo "<div style=\"padding: 25px; text-align: center;\">Выберите как минимум одно доп. поле<br /><br /><a href=\"javascript:void(0);\" onclick=\"UpdateList( 'fields' ); return false;\">Вернуться назад</a></div>";
		closetable();
	}

//-------------------------------------------------====
//	Завершение работы
//-------------------------------------------------====

$db->close();

?>