<?php


//-------------------------------------------------====
//	Инициализация
//-------------------------------------------------====
ini_set('display_errors','On');
error_reporting('E_ALL');
if( !defined( "DATALIFEENGINE" ) ) die( "Hacking attempt!" );

//-------------------------------------------------====
//	Само выполнение
//-------------------------------------------------====

$action = $_REQUEST['action'];
$CheckCategory = $_REQUEST['CheckCategory'];
$Accept = intval( $_REQUEST['accept'] );
if( $action == "sort" && count( $CheckCategory ) < 1 ) $CheckCategory[] = 1;
if( is_array( $CheckCategory ) && count( $CheckCategory ) > 0 )
	{
		$HiddenCheck = "";
		foreach( $CheckCategory as $key => $id )
			{
				$id = intval( $id );
				if( !$id )
					{
						unset( $CheckCategory[ $key ] );
					}
						else
					{
						$CheckCategory[ $key ] = $id;
						$HiddenCheck .= "<input type=\"hidden\" name=\"CheckCategory[]\" value=\"{$id}\" />";
					}
			}
		
		$HiddenCheck .= "<input type=\"hidden\" name=\"accept\" value=\"1\" />";
		$HiddenCheck .= "<input type=\"hidden\" name=\"action\" value=\"{$action}\" />";
		$HiddenCheck .= "<input type=\"hidden\" name=\"TypeAction\" value=\"category\" />";
		
		$CountCheck = count( $CheckCategory );
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
												$db->query( "UPDATE ".PREFIX."_mfo_options SET `sort`='{$value}' WHERE `id`='{$id}' LIMIT 1" );
											}
									}
											
								echo "<span style=\"color: green; font-weight: bold;\">Отсортировано</span>";
								$Mfo->CleareAllCache();
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
								$NewCategory = intval( $_REQUEST['NewCategory'] );
								foreach( $CheckCategory as $id )
									{
										$id = intval( $id );
										if( $id )
											{
												$CountRow = $db->super_query( "SELECT COUNT(*) AS count FROM ".PREFIX."_mfo_post WHERE category='{$id}'" );
												$Count = intval( $CountRow['count'] );
												for( $i = 0; $i < $Count; $i++ )
													{
														$Mfo->AddPostCategory( $NewCategory );
														$Mfo->DelPostCategory( $id );
													}
												$db->query( "UPDATE ".PREFIX."_mfo_post SET `category`='{$NewCategory}' WHERE `category`='{$id}'" );
												$db->query( "DELETE FROM ".PREFIX."_mfo_options WHERE id='{$id}' LIMIT 1" );
											}
									}
									
								$Mfo->CleareAllCache();
								tpl_table_open($navigation);
								tableheader( "Список категорий &raquo; Массовые действия" );
echo <<<HTML

<div style="padding: 25px; text-align: center;">
	Выбранные <strong>({$CountCheck})</strong> категории, были успешно удалены<br /><br />
	<a href="javascript:void(0);" onclick="UpdateList( 'category' ); return false;">Вернуться назад</a>
</div>

HTML;
								closetable();
							}
								else
							{
								tpl_table_open($navigation);
								tableheader( "Список категорий &raquo; Массовые действия" );
								$SelectCategory = $Mfo->SelectCategory( "", $CheckCategory );
echo <<<HTML

<form method="post" action="" name="MfoMassAction" onsubmit="formSubmit( 'MfoMassAction', 'action.php', 'category', 'ajax.gif', 'UpdateStatus', 'UpdateStatus', UpdateButton ); return false;">
	<div style="padding: 25px; text-align: center;">
		Вы выбрали  <strong>({$CountCheck})</strong> категорий, выберите в какую категорию переместить их МФО:<br /><br />
		<select name="NewCategory">
			{$SelectCategory}
		</select><br /><br />
		<input type="submit" name="submit" value="Выполнить" class="edit" />
		<input type="button" value="Отменить" class="edit" onclick="UpdateList( 'category' ); return false;" />
		{$HiddenCheck}
	</div>
</form>

HTML;
								closetable();
							}
					}
						else
					{
						tpl_table_open($navigation);
						tableheader( "Список категорий &raquo; Массовые действия" );
						echo "<div style=\"padding: 25px; text-align: center;\">Выберите действие для категорий<br /><br /><a href=\"javascript:void(0);\" onclick=\"UpdateList( 'category' ); return false;\">Вернуться назад</a></div>";
						closetable();		
					}
			}
				else
			{
				tpl_table_open($navigation);
				tableheader( "Список категорий &raquo; Массовые действия" );
				echo "<div style=\"padding: 25px; text-align: center;\">Выберите как минимум одну категорию<br /><br /><a href=\"javascript:void(0);\" onclick=\"UpdateList( 'category' ); return false;\">Вернуться назад</a></div>";
				closetable();
			}
	}
		else
	{
		tpl_table_open($navigation);
		tableheader( "Список категорий &raquo; Массовые действия" );
		echo "<div style=\"padding: 25px; text-align: center;\">Выберите как минимум одну категорию<br /><br /><a href=\"javascript:void(0);\" onclick=\"UpdateList( 'category' ); return false;\">Вернуться назад</a></div>";
		closetable();
	}

//-------------------------------------------------====
//	Завершение работы
//-------------------------------------------------====

$db->close();

?>