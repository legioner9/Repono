<?php
/*
=====================================================
 Файл: blocks.php
=====================================================
 Данный код защищен авторскими правами
=====================================================
 Назначение: массовые действия с валютами
=====================================================
*/

//-------------------------------------------------====
//	Инициализация
//-------------------------------------------------====

if( !defined( "DATALIFEENGINE" ) ) die( "Hacking attempt!" );

//-------------------------------------------------====
//	Само выполнение
//-------------------------------------------------====

$action = $_REQUEST['action'];
$CheckBlocks = $_REQUEST['CheckBlocks'];
$Accept = intval( $_REQUEST['accept'] );
if( $action == "sort" && count( $CheckBlocks ) < 1 ) $CheckBlocks[] = 1;
if( is_array( $CheckBlocks ) && count( $CheckBlocks ) > 0 )
	{
		$HiddenCheck = "";
		foreach( $CheckBlocks as $key => $id )
			{
				$id = intval( $id );
				if( !$id )
					{
						unset( $CheckBlocks[ $key ] );
					}
						else
					{
						$CheckBlocks[ $key ] = $id;
						$HiddenCheck .= "<input type=\"hidden\" name=\"CheckBlocks[]\" value=\"{$id}\" />";
					}
			}
		
		$HiddenCheck .= "<input type=\"hidden\" name=\"accept\" value=\"1\" />";
		$HiddenCheck .= "<input type=\"hidden\" name=\"action\" value=\"{$action}\" />";
		$HiddenCheck .= "<input type=\"hidden\" name=\"TypeAction\" value=\"blocks\" />";
		
		$CountCheck = count( $CheckBlocks );
		if( $CountCheck > 0 )
			{
				//-------------------------------------------------====
				//	Сортировка
				//-------------------------------------------------====

				if( $action == "sort" )
					{
						$Sort = $_REQUEST['position'];
						if( count( $Sort ) > 0 && is_array( $Sort ) )
							{
								foreach( $Sort as $id => $value )
									{
										$value = intval( $value );
										$id = intval( $id );
										if( $id )
											{
												$db->query( "UPDATE ".PREFIX."_banki_options SET `sort`='{$value}' WHERE `id`='{$id}' LIMIT 1" );
											}
									}
											
								echo "<span style=\"color: green; font-weight: bold;\">Позиции изменены</span><script language=\"javascript\" type=\"text/javascript\">UpdateList( 'blocks' );</script>";
								$Banki->CleareAllCache();
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
								foreach( $CheckBlocks as $id )
									{
										$id = intval( $id );
										if( $id )
											{
												//$Banki->SaveBankiOpt( $Banki->DB['banki_type'][2], array( "qwe" => "123" ) );
												$db->query( "DELETE FROM ".PREFIX."_banki_options WHERE id='{$id}' LIMIT 1" );
											}
									}
									
								$Banki->CleareAllCache();
								opentable();
								tableheader( "Список блоков &raquo; Массовые действия" );
echo <<<HTML

<div style="padding: 25px; text-align: center;">
	Выбранные <strong>({$CountCheck})</strong> блоки, были успешно удалены<br /><br />
	<a href="javascript:void(0);" onclick="UpdateList( 'blocks' ); return false;">Вернуться назад</a>
</div>

HTML;
								closetable();
							}
								else
							{
								opentable();
								tableheader( "Список блоков &raquo; Массовые действия" );
echo <<<HTML

<form method="post" action="" name="BankiMassAction" onsubmit="formSubmit( 'BankiMassAction', 'action.php', 'blocks', 'ajax.gif', 'UpdateStatus', 'UpdateStatus', UpdateButton ); return false;">
	<div style="padding: 25px; text-align: center;">
		Вы уверены, что хотите удалить выбранные <strong>({$CountCheck})</strong> блоки?<br /><br />
		<input type="submit" name="submit" value="Да" class="edit" />
		<input type="button" value="Нет" class="edit" onclick="UpdateList( 'blocks' ); return false;" />
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
						tableheader( "Список блоков &raquo; Массовые действия" );
						echo "<div style=\"padding: 25px; text-align: center;\">Выберите действие для блоков<br /><br /><a href=\"javascript:void(0);\" onclick=\"UpdateList( 'blocks' ); return false;\">Вернуться назад</a></div>";
						closetable();		
					}
			}
				else
			{
				opentable();
				tableheader( "Список блоков &raquo; Массовые действия" );
				echo "<div style=\"padding: 25px; text-align: center;\">Выберите как минимум один блок<br /><br /><a href=\"javascript:void(0);\" onclick=\"UpdateList( 'blocks' ); return false;\">Вернуться назад</a></div>";
				closetable();
			}
	}
		else
	{
		opentable();
		tableheader( "Список блоков &raquo; Массовые действия" );
		echo "<div style=\"padding: 25px; text-align: center;\">Выберите как минимум один блок<br /><br /><a href=\"javascript:void(0);\" onclick=\"UpdateList( 'blocks' ); return false;\">Вернуться назад</a></div>";
		closetable();
	}

//-------------------------------------------------====
//	Завершение работы
//-------------------------------------------------====

$db->close();

?>