<?php


//-------------------------------------------------====
//	Инициализация
//-------------------------------------------------====

define( "ROOT_DIR", "../../../../.." );
define( "ENGINE_DIR", "../../../.." );
require_once( ENGINE_DIR."/ajax/mfo/admin/OptAjax.php" );

//-------------------------------------------------====
//	Само сохранение и вывод данных
//-------------------------------------------------====

$id = intval( $_REQUEST['id'] );
if( $id )
	{
		if( $Mfo->DB['category'][ $id ] )
			{
				if( isset( $_POST['submit'] ) )
					{
						$sort = intval( $_POST['sort'] );
						$Options['name'] = htmlspecialchars( stripslashes( CharsetConvert( $_POST['name'] ) ), ENT_QUOTES, $config['charset'] );
						$Options['alt_name'] = $_POST['alt_name'] != "" ? totranslit( CharsetConvert( $_POST['alt_name'] ) ) : totranslit( $Options['name'] );
						$Options['template'] = totranslit( CharsetConvert( $_POST['template'] ) );
						$Options['icon'] = htmlspecialchars( strip_tags( stripslashes( CharsetConvert( $_POST['icon'] ) ) ), ENT_QUOTES, $config['charset'] );
						$Options['title_h'] = htmlspecialchars( stripslashes( CharsetConvert( $_POST['title_h'] ) ), ENT_QUOTES, $config['charset'] );
						$Options['description'] = htmlspecialchars( stripslashes( CharsetConvert( $_POST['description'] ) ), ENT_QUOTES, $config['charset'] );
						$Options['keywords'] = htmlspecialchars( stripslashes( CharsetConvert( $_POST['keywords'] ) ), ENT_QUOTES, $config['charset'] );
						$Options['cat'] = intval( $_POST['MainCategory'] );
						$Options['count_post'] = $Mfo->DB['category'][ $id ]['count_post'];
								
						if( !$Options['name'] ) die( "<span style=\"color: #F00;\">Введите название</span>" );
						$Options = $db->safesql( $Mfo->CompileOpt( $Options ) );
						
						$db->query( "UPDATE ".PREFIX."_mfo_options SET `options`='{$Options}',`sort`='{$sort}' WHERE `id`='{$id}' LIMIT 1" );
						$Mfo->CleareAllCache();
						
						echo ThisClose();
						echo "<span style=\"color: green;\">Сохранено</span><script type=\"text/javascript\" language=\"javascript\">CloseWindow( 'category' );</script>";
					}
						else
					{
						$name = htmlspecialchars( stripslashes( $Mfo->DB['category'][ $id ]['name'] ), ENT_QUOTES, $config['charset'] );
						$alt_name = htmlspecialchars( stripslashes( $Mfo->DB['category'][ $id ]['alt_name'] ), ENT_QUOTES, $config['charset'] );
						$template = htmlspecialchars( stripslashes( $Mfo->DB['category'][ $id ]['template'] ), ENT_QUOTES, $config['charset'] );
						$title_h = htmlspecialchars( stripslashes( $Mfo->DB['category'][ $id ]['title_h'] ), ENT_QUOTES, $config['charset'] );
						$description = htmlspecialchars( stripslashes( $Mfo->DB['category'][ $id ]['description'] ), ENT_QUOTES, $config['charset'] );
						$keywords = htmlspecialchars( stripslashes( $Mfo->DB['category'][ $id ]['keywords'] ), ENT_QUOTES, $config['charset'] );
						$icon = htmlspecialchars( strip_tags( stripslashes( $Mfo->DB['category'][ $id ]['icon'] ) ), ENT_QUOTES, $config['charset'] );
						$sort = intval( $Mfo->DB['category'][ $id ]['sort'] );
						$MainCategory = intval( $Mfo->DB['category'][ $id ]['cat'] );
						$SelectCategory = $Mfo->SelectCategory( $MainCategory, $id );
		
echo <<<HTML

<form method="post" action="" name="LightWindowForm" onsubmit="formSubmit( 'LightWindowForm', 'category/edit.category.php', 'LightWindowStatus', 'status.gif', 'LightWindowStatus', 'off' ); return false;">
	<table width="100%" border="0">
		<tr>
			<td colspan="10" style="border-bottom: 1px dotted #ccc;" height="1"></td>
		</tr>
		<tr height="30px">
			<td width="150px">Название типа: *</td>
			<td>
				<input type="text" name="name" value="{$name}" class="edit" style="width: 70%;" />
			</td>
		</tr>
		<tr>
			<td colspan="10" style="border-bottom: 1px dotted #ccc;" height="1"></td>
		</tr>
		<tr height="30px">
			<td width="150px">Альтернативное имя:</td>
			<td>
				<input type="text" name="alt_name" value="{$alt_name}" class="edit" style="width: 70%;" />
			</td>
		</tr>
		<tr height="30px">
			<td width="150px">Название H1:</td>
			<td>
				<input type="text" name="title_h" value="{$title_h}" class="edit" style="width: 70%;" />
			</td>
		</tr>
		<tr>
			<td colspan="10" style="border-bottom: 1px dotted #ccc;" height="1"></td>
		</tr>
		<tr height="30px">
			<td width="150px">Шаблон:</td>
			<td>
				<input type="text" name="template" value="{$template}" class="edit" style="width: 70%;" />
				<img src="engine/inc/mfo/style/images/hint.gif" alt="[?]" onmouseover="showhint( 'Название папки, которая должна находиться в &quot;{THEME}/mfo/&quot;. Для неё должны быть созданы новые файлы шаблонов, включая краткие объявления, полные, комментарии, навигация и т.д. Если оставить данное поле пустым, то будет грузиться папка &quot;default&quot;', this, event, '250px')" border="0" style="cursor: help; padding: 0px 0px 0px 3px;" />
			</td>
		</tr>
		<tr>
			<td colspan="10" style="border-bottom: 1px dotted #ccc;" height="1"></td>
		</tr>
		<tr height="30px">
			<td width="150px">Иконка:</td>
			<td>
				<input type="text" name="icon" value="{$icon}" class="edit" style="width: 70%;" />
				<img src="engine/inc/mfo/style/images/hint.gif" alt="[?]" onmouseover="showhint( 'Картинка должна находится в папке &quot;{THEME}/mfo/style/images/&quot;. Если оставить данное поле пустым, то картинка не будет выводиться.', this, event, '250px')" border="0" style="cursor: help; padding: 0px 0px 0px 3px;" />
			</td>
		</tr>
		<tr>
			<td colspan="10" style="border-bottom: 1px dotted #ccc;" height="1"></td>
		</tr>
		<tr height="30px">
			<td width="150px">Описание (descr):</td>
			<td>
				<input type="text" name="description" value="{$description}" class="edit" style="width: 70%;" />
			</td>
		</tr>
		<tr>
			<td colspan="10" style="border-bottom: 1px dotted #ccc;" height="1"></td>
		</tr>
		<tr height="70px">
			<td width="150px">Ключевые слова (keywords):</td>
			<td>
				<textarea name="keywords" style="width: 70%; height: 50px;">{$keywords}</textarea>
			</td>
		</tr>
		<tr>
			<td colspan="10" style="border-bottom: 1px dotted #ccc;" height="1"></td>
		</tr>
		<tr height="30px">
			<td width="150px">Основная категория:</td>
			<td>
				<select name="MainCategory">
					<option value="">---</option>
					{$SelectCategory}
				</select>
			</td>
		</tr>
		<tr>
			<td colspan="10" style="border-bottom: 1px dotted #ccc;" height="1"></td>
		</tr>
		<tr height="30px">
			<td>Сортировка</td>
			<td>
				<input type="text" name="sort" value="{$sort}" style="text-align: center; width: 50px;" class="edit" />
			</td>
		</tr>
		<tr>
			<td colspan="10" style="border-bottom: 1px dotted #ccc;" height="1"></td>
		</tr>
	</table>
	<div style="text-align: right; padding: 10px 0px 0px 0px;">
		<span id="LightWindowStatus" style="padding: 0px 10px 0px 0px;"></span>
		<input type="hidden" name="id" value="{$id}" />
		<input type="submit" name="submit" value="Сохранить" class="edit" />
		<input type="button" value="Отмена" class="edit" onclick="OpenCloseLightWindow(); return false;" />
	</div>
</form>

HTML;

					}
			}
				else
			{
				echoReturn( "Типа не существует, или он был удалён!" );
			}
	}
		else
	{
		echoReturn( "Не указан идентификатр типа!" );
	}

//-------------------------------------------------====
//	Завершение работы
//-------------------------------------------------====

$db->close();

?>