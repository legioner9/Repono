<?php


//-------------------------------------------------====
//	Инициализация
//-------------------------------------------------====

define( "ROOT_DIR", "../../../../.." );
define( "ENGINE_DIR", "../../../.." );
require_once( ENGINE_DIR."/ajax/mfo/admin/OptAjax.php" );

//-------------------------------------------------====
//	Само добавление и вывод данных
//-------------------------------------------------====

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
				
		if( !$Options['name'] ) die( "<span style=\"color: #F00;\">Введите название</span>" );
		foreach( $Mfo->DBIndex['category'] as $alt_name => $id )
			{
				if( $alt_name == $Options['alt_name'] ) die( "<span style=\"color: #F00;\">Категория уже существует</span>" );
			}
		
		$Options = $db->safesql( $Mfo->CompileOpt( $Options ) );
		
		$db->query( "INSERT INTO ".PREFIX."_mfo_options (`type`,`options`,`sort`) VALUES ('category','{$Options}','{$sort}')" );
		$Mfo->CleareAllCache();
		
		echo ThisClose();
		echo "<span style=\"color: green;\">Категория добавлена</span><script type=\"text/javascript\" language=\"javascript\">CloseWindow( 'category' );</script>";
	}
		else
	{
		$SelectCategory = $Mfo->SelectCategory();
		
echo <<<HTML

<form method="post" action="" name="LightWindowForm" onsubmit="formSubmit( 'LightWindowForm', 'category/add.category.php', 'LightWindowStatus', 'status.gif', 'LightWindowStatus', 'off' ); return false;">
	<table width="100%" border="0">
		<tr>
			<td colspan="10" style="border-bottom: 1px dotted #ccc;" height="1"></td>
		</tr>
		<tr height="30px">
			<td width="150px">Название категории: *</td>
			<td>
				<input type="text" name="name" value="" class="edit" style="width: 70%;" />
			</td>
		</tr>
		<tr>
			<td colspan="10" style="border-bottom: 1px dotted #ccc;" height="1"></td>
		</tr>
		<tr height="30px">
			<td width="150px">Альтернативное имя:</td>
			<td>
				<input type="text" name="alt_name" value="" class="edit" style="width: 70%;" />
			</td>
		</tr>
		<tr height="30px">
			<td width="150px">Название H1:</td>
			<td>
				<input type="text" name="title_h" value="" class="edit" style="width: 70%;" />
			</td>
		</tr>
		<tr>
			<td colspan="10" style="border-bottom: 1px dotted #ccc;" height="1"></td>
		</tr>
		<tr height="30px">
			<td width="150px">Шаблон:</td>
			<td>
				<input type="text" name="template" value="" class="edit" style="width: 70%;" />
				<img src="engine/inc/mfo/style/images/hint.gif" alt="[?]" onmouseover="showhint( 'Название папки, которая должна находиться в &quot;{THEME}/mfo/&quot;. Для неё должны быть созданы новые файлы шаблонов, включая краткие объявления, полные, комментарии, навигация и т.д. Если оставить данное поле пустым, то будет грузиться папка &quot;default&quot;', this, event, '250px')" border="0" style="cursor: help; padding: 0px 0px 0px 3px;" />
			</td>
		</tr>
		<tr>
			<td colspan="10" style="border-bottom: 1px dotted #ccc;" height="1"></td>
		</tr>
		<tr height="30px">
			<td width="150px">Иконка:</td>
			<td>
				<input type="text" name="icon" value="" class="edit" style="width: 70%;" />
				<img src="engine/inc/mfo/style/images/hint.gif" alt="[?]" onmouseover="showhint( 'Картинка должна находится в папке &quot;{THEME}/mfo/style/images/&quot;. Если оставить данное поле пустым, то картинка не будет выводиться.', this, event, '250px')" border="0" style="cursor: help; padding: 0px 0px 0px 3px;" />
			</td>
		</tr>
		<tr>
			<td colspan="10" style="border-bottom: 1px dotted #ccc;" height="1"></td>
		</tr>
		<tr height="30px">
			<td width="150px">Описание (descr):</td>
			<td>
				<input type="text" name="description" value="" class="edit" style="width: 70%;" />
			</td>
		</tr>
		<tr>
			<td colspan="10" style="border-bottom: 1px dotted #ccc;" height="1"></td>
		</tr>
		<tr height="70px">
			<td width="150px">Ключевые слова (keywords):</td>
			<td>
				<textarea name="keywords" style="width: 70%; height: 50px;"></textarea>
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
				<input type="text" name="sort" value="1" style="text-align: center; width: 50px;" class="edit" />
			</td>
		</tr>
		<tr>
			<td colspan="10" style="border-bottom: 1px dotted #ccc;" height="1"></td>
		</tr>
	</table>
	<div style="text-align: right; padding: 10px 0px 0px 0px;">
		<span id="LightWindowStatus" style="padding: 0px 10px 0px 0px;"></span>
		<input type="submit" name="submit" value="Добавить" class="edit" />
		<input type="button" value="Отмена" class="edit" onclick="OpenCloseLightWindow(); return false;" />
	</div>
</form>

HTML;

	}

//-------------------------------------------------====
//	Завершение работы
//-------------------------------------------------====

$db->close();

?>