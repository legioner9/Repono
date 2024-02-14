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

if( isset( $_POST['submit'] ) )
	{
		$Options['title'] = htmlspecialchars( stripslashes( CharsetConvert( $_POST['title'] ) ), ENT_QUOTES, $config['charset'] );
		$Options['post_type'] = totranslit( CharsetConvert( $_POST['post_type'] ) );
		$Options['post_sort'] = totranslit( CharsetConvert( $_POST['post_sort'] ) );
		$Options['cats_type'] = totranslit( CharsetConvert( $_POST['cats_type'] ) );
		$Options['cache'] = intval( $_POST['cache'] );
		$Options['max_post'] = intval( $_POST['max_post'] );
		$Options['template'] = totranslit( $_POST['template'], false, false );
		$Options['post_photo'] = $_POST['post_photo'] == "yes" ? "yes" : "no";
		
		$Options['AllowCats'] = $_REQUEST['AllowCats'];
		
		if( count( $Options['AllowCats'] ) < 1 || !is_array( $Options['AllowCats'] ) )
			$Options['AllowCats'] = "all";
		else
			$Options['AllowCats'] = implode( ",", $Options['AllowCats'] );
		
		if( !$Options['title'] ) die( "<span style=\"color: #F00;\">Введите название блока</span>" );
		if( !$Options['post_type'] ) die( "<span style=\"color: #F00;\">Ввыберите тип вывода объявлений</span>" );
		if( !$Options['template'] ) die( "<span style=\"color: #F00;\">Введите шаблон блока</span>" );
		if( !$Options['max_post'] ) die( "<span style=\"color: #F00;\">Введите максимальное количество МФО</span>" );
		$Options = $db->safesql( $Mfo->CompileOpt( $Options ) );
		
		$db->query( "INSERT INTO ".PREFIX."_mfo_options (`type`,`options`,`sort`) VALUES ('blocks','{$Options}','1')" );
		$Mfo->CleareAllCache();
		
		echo ThisClose();
		echo "<span style=\"color: green;\">Блок успешно добавлен</span><script type=\"text/javascript\" language=\"javascript\">CloseWindow( 'blocks' );</script>";
	}
		else
	{
		$postSort = makeDropDown( array( "asc" => "По порядку", "desc" => "В обратном порядке" ), "post_sort", "desc" );
		$postType = makeDropDown( array( "default" => "Обычный вывод", "vip" => "Только VIP", "super_vip" => "Только Super Vip", "color" => "Только выделенные цветом", "new" => "Только новые" ), "post_type", "default" );
		$AllowCats = $Mfo->SelectCategory( array( "all" ), "", "", "", true );
		$CatsType = makeDropDown( array( "only" => "Только выделенные", "parented" => "С подкатегориями" ), "cats_type", "onky" );
		$cache = 120;
		$max_post = 10;
		$template = "default";
		$postPhoto = makeDropDown( array( "yes" => "Обязательно", "no" => "Не обязательно" ), "post_photo", "no" );
		
echo <<<HTML

<form method="post" action="" name="LightWindowForm" onsubmit="formSubmit( 'LightWindowForm', 'blocks/add.blocks.php', 'LightWindowStatus', 'status.gif', 'LightWindowStatus', 'off' ); return false;">
	<table width="100%" border="0">
		<tr>
			<td colspan="10" style="border-bottom: 1px dotted #ccc;" height="1"></td>
		</tr>
		<tr height="30px">
			<td>Название блока: *</td>
			<td>
<input type="text" name="title" value="{$title}" style="width: 200px;" class="edit" />
			</td>
		</tr>
		<tr>
			<td colspan="10" style="border-bottom: 1px dotted #ccc;" height="1"></td>
		</tr>
		<tr height="30px">
			<td>Тип постов: *</td>
			<td>
{$postType}
			</td>
		</tr>
		<tr>
			<td colspan="10" style="border-bottom: 1px dotted #ccc;" height="1"></td>
		</tr>
		<tr height="30px">
			<td>Сортировка:</td>
			<td>
{$postSort}
			</td>
		</tr>
		<tr>
			<td colspan="10" style="border-bottom: 1px dotted #ccc;" height="1"></td>
		</tr>
		<tr height="110px">
			<td style="padding: 0px 0px 0px 5px;">Категории: *</td>
			<td>
<select name="AllowCats[]" multiple="multiple" style="height: 100px;">
	{$AllowCats}
</select>
			</td>
		</tr>
		<tr>
			<td colspan="10" style="border-bottom: 1px dotted #ccc;" height="1"></td>
		</tr>
		<tr height="30px">
			<td>Тип категорий:</td>
			<td>
{$CatsType}
			</td>
		</tr>
		<tr>
			<td colspan="10" style="border-bottom: 1px dotted #ccc;" height="1"></td>
		</tr>
		<tr height="30px">
			<td>Фотографии:</td>
			<td>
				{$postPhoto}
			</td>
		</tr>
		<tr>
			<td colspan="10" style="border-bottom: 1px dotted #ccc;" height="1"></td>
		</tr>
		<tr height="30px">
			<td>Шаблон: *</td>
			<td>
				<input type="text" name="template" value="{$template}" style="width: 150px;" class="edit" /> .tpl
			</td>
		</tr>
		<tr>
			<td colspan="10" style="border-bottom: 1px dotted #ccc;" height="1"></td>
		</tr>
		<tr height="30px">
			<td>Макс. объявлений: *</td>
			<td>
				<input type="text" name="max_post" value="{$max_post}" style="text-align: center; width: 80px;" class="edit" />
			</td>
		</tr>
		<tr>
			<td colspan="10" style="border-bottom: 1px dotted #ccc;" height="1"></td>
		</tr>
		<tr height="30px">
			<td>Время кэша:</td>
			<td>
				<input type="text" name="cache" value="{$cache}" style="text-align: center; width: 80px;" class="edit" /> мин. <span style="color: #999;">(0 - не кэшировать)</span>
			</td>
		</tr>
		<tr>
			<td colspan="10" style="border-bottom: 1px dotted #ccc;" height="1"></td>
		</tr>
	</table>
	<div style="text-align: right; padding: 10px 0px 0px 0px;">
		<span id="LightWindowStatus" style="padding: 0px 10px 0px 0px;"></span>
		<input type="hidden" name="id" value="{$id}" />
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