<?php


if( !defined( "DATALIFEENGINE" ) ) die( "Hacking attempt!" );



if( $Mfo->Field === false ) $Mfo->StartField( true );
$ShowAction = $_REQUEST['show_action'];

//---------------------------------------------======
//	Добавление дополнительного поля
//---------------------------------------------======

if( $ShowAction == "add" )
	{
		$OkAdd = false;
		miniloader( "Добавление доп. поля" );
		
		if( isset( $_POST['submit'] ) )
			{
				$OkAdd = $Mfo->Field->AddField();
				if( $OkAdd === true )
					{
						echoheader( "<i class=\"fa fa-home position-left\"></i><span class=\"text-semibold\">Добавление дополнительного поля</span>","<a href=\"$PHP_SELF?mod=mfo\">Каталог МФО 7.0</a> / <a href=\"$PHP_SELF?mod=mfo&do=fields\">Дополнительные поля</a>" );
						opentable();
						echo ThisClose();
						minimsg( "Добавление дополнительного поля", "Дополнительное поле было успешно создано<script language=\"javascript\" type=\"text/javascript\">UpdateFields();</script>" );
						closetable();
					}
						else
					{
						$FieldsValue = $Mfo->Field->ReturnFieldsValueOnError;
						opentable();
						tableheader( "Ошибка" );
						echo "<span style=\"color: #F00;\"><ol>{$OkAdd}</ol></span>";
						closetable();
					}
			}
				else
			{
				$Mfo->Field->ReturnFieldsValueOnError['allow_edit'] = 1;
			}
		
		if( $OkAdd !== true )
			{	
				echoheader( "<i class=\"fa fa-home position-left\"></i><span class=\"text-semibold\">Добавление дополнительного поля</span>","<a href=\"$PHP_SELF?mod=mfo\">Каталог МФО 3.0</a> / <a href=\"$PHP_SELF?mod=mfo&do=fields\">Дополнительные поля</a>" );
				opentable();
				tableheader( "Добавление дополнительного поля" );
				
				$AllowGroups = MfoGroups( explode( ",", $Mfo->Field->ReturnFieldsValueOnError['AllowGroups'] ), "yes", true );
				$EditGroups = MfoGroups( explode( ",", $Mfo->Field->ReturnFieldsValueOnError['EditGroups'] ), "no", true );
				$AllowType = SelectList( $Mfo->Field->TypeName, $Mfo->Field->ReturnFieldsValueOnError['type'] );
				$FormType = $Mfo->Field->ReturnFormType();
				
				$HtmlChecked = $Mfo->Field->ReturnFieldsValueOnError['filtre_html'] == 1 ? "checked=\"checked\"" : "";
				$JsDisabled = $HtmlChecked ? "" : "disabled=\"disabled\"";
				$JsChecked = $Mfo->Field->ReturnFieldsValueOnError['filtre_js'] == 1 && !$JsDisabled ? "checked=\"checked\"" : "";
				$BrChecked = $Mfo->Field->ReturnFieldsValueOnError['filtre_br'] == 1 ? "checked=\"checked\"" : "";
				$ShowCreateChecked = $Mfo->Field->ReturnFieldsValueOnError['show_create'] == 1 ? "checked=\"checked\"" : "";
				$AllowEditChecked = $Mfo->Field->ReturnFieldsValueOnError['allow_edit'] == 1 ? "checked=\"checked\"" : "";
				
				$RequiredDisabled = !$ShowCreateChecked && !$AllowEditChecked ? "disabled=\"disabled\"" : "";
				$RequiredChecked = $Mfo->Field->ReturnFieldsValueOnError['required'] == 1 && !$RequiredDisabled ? "checked=\"checked\"" : "";
				
				$About = $Mfo->Field->ReturnFieldsValueOnError['about'];
				$LinkAbout = empty( $About ) ? "" : "display: none;";
				$divAbout = empty( $About ) ? "display: none;" : "";
				
				if( !$Mfo->Field->ReturnFieldsValueOnError['AllowCats'] ) $Mfo->Field->ReturnFieldsValueOnError['AllowCats'] = "all";
				$AllowCats = $Mfo->SelectCategory( explode( ",", $Mfo->Field->ReturnFieldsValueOnError['AllowCats'] ), "", "", "", true );
		
echo <<<HTML

<form method="post" class="form-horizontal" action="" name="field_add">
	<div class="panel-body">	
		<div class="form-group">
			<label class="control-label col-sm-2">Тип поля: *</label>
				<div class="col-sm-10">
					<select name="type" onkeyup="showtype();" onkeydown="showtype();" onchange="showtype();" id="type">
						{$AllowType}
					</select>
				</div>
				<div class="clr"></div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-2">Имя: *</label>
				<div class="col-sm-10">
					<input type="text" name="name" value="{$FieldsValue[name]}" class="form-control width-400 position-left"  />
				</div>
				<div class="clr"></div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-2">Альтернативное имя:</label>
				<div class="col-sm-10">
					<input type="text" name="alt_name" value="{$FieldsValue[alt_name]}" class="form-control width-400 position-left"  />
				</div>
				<div class="clr"></div>
		</div>
		<div class="form-group" style="display: none;">
			<label class="control-label col-sm-2">Описание:</label>
				<div class="col-sm-10">
					<a style="{$LinkAbout}" id="LinkShowAbout" href="javascript:void(0);" onclick="ShowOrHide( 'LinkShowAbout' ); ShowOrHide( 'FormAbout' ); return false;">Добавить описание</a>
					<div id="FormAbout" style="{$divAbout} padding: 3px 0px 3px 0px;">
						<textarea name="about" style="width: 90%; height: 80px;">{$About}</textarea><br />
						<span style="color: #999;">Разрешён HTML и JS</span>
					</div>
				</div>
				<div class="clr"></div>
		</div>
		

		
	$FormType
		
	<div class="form-group">
			<label class="control-label col-sm-2">Фильтрация:</label>
				<div class="col-sm-10">
					<input type="checkbox" name="filtre_html" value="1" id="filtre_html" onclick="if( this.checked === true ){ document.getElementById( 'filtre_js' ).disabled = false; } else { document.getElementById( 'filtre_js' ).checked = false; document.getElementById( 'filtre_js' ).disabled = true; }" {$HtmlChecked} />
					<label for="filtre_html">Разрешить HTML</label><br />
					<input type="checkbox" name="filtre_js" value="1" id="filtre_js" {$JsDisabled} {$JsChecked} />
					<label for="filtre_js">Разрешить Javascript</label><br />
					<input type="checkbox" name="filtre_br" value="1" id="filtre_br" {$BrChecked} />
					<label for="filtre_br">Новые строки заменять тегом &lt;br /&gt;</label><br />
				</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-2">Разрешить редактировать: *</label>
				<div class="col-sm-10">
					<select name="EditGroups[]" multiple="multiple" style="height: 60px;">
						{$EditGroups}
					</select>
				</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-2">Разрешить просмотр: *</label>
				<div class="col-sm-10">
					<select name="AllowGroups[]" multiple="multiple" style="height: 60px;">
						{$AllowGroups}
					</select>
				</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-2">Разрешённые категории: *</label>
				<div class="col-sm-10">
					<select name="AllowCats[]" multiple="multiple" style="height: 100px;">
						{$AllowCats}
					</select>
				</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-2">Другие опции:</label>
				<div class="col-sm-10">
					<input type="checkbox" name="show_create" value="1" id="show_create" onclick="FieldRequired();" {$ShowCreateChecked} />
					<label for="show_create">Показывать при создании МФО</label><br />
					<input type="checkbox" name="allow_edit" value="1" id="allow_edit" onclick="FieldRequired();" {$AllowEditChecked} />
					<label for="allow_edit">Разрешить изменять после создания</label><br />
					<input type="checkbox" name="required" value="1" id="required" {$RequiredChecked} {$RequiredDisabled} />
					<label for="required">Обязательное поле</label><br />
				</div>
		</div>
HTML;

closetable();	

echo <<<HTML
	<div class="panel-footer">
		
		
		<div class="pull-right">
			<input type="submit" name="submit" value="Сохранить" class="btn bg-slate-600 btn-sm btn-raised legitRipple" />
		</div>
	
	
	</div>
</form>
</div>
HTML;
				closetable();
				echo EchoAJAX( true );
				echo FieldsType( $Mfo->Field->AllowType );
				minifooter();
			}
	}
	
//---------------------------------------------======
//	Редактирование дополнительного поля
//---------------------------------------------======

elseif( $ShowAction == "edit" )
	{
		$id = intval( $_REQUEST['id'] );
		if( !$id ) minimsg( "Ошибка", "Не указан ID редактируемого поля" );
		if( !is_array( $Mfo->Field->DB[ $id ] ) ) minimsg( "Ошибка", "Указнное поле не существует" );
		
		$OkAdd = false;
		miniloader( "Редактирование доп. поля" );
		
		if( isset( $_POST['submit'] ) )
			{
				$OkAdd = $Mfo->Field->AddField( $id );
				if( $OkAdd === true )
					{
						echoheader( "<i class=\"fa fa-home position-left\"></i><span class=\"text-semibold\">Добавление дополнительного поля</span>","<a href=\"$PHP_SELF?mod=mfo\">Каталог МФО 3.0</a> / <a href=\"$PHP_SELF?mod=mfo&do=fields\">Дополнительные поля</a>" );
						opentable();
						echo ThisClose();
						minimsg( "Редактирование дополнительного поля", "Дополнительное поле было успешно отредактировано<script language=\"javascript\" type=\"text/javascript\">UpdateFields( true );</script>", "$PHP_SELF?mod=mfo&amp;action=field&amp;show_action=edit&amp;id={$id}"  );
						closetable();
					}
						else
					{
						$FieldsValue = $Mfo->Field->ReturnFieldsValueOnError;
						opentable();
						tableheader( "Ошибка" );
						echo "<span style=\"color: #F00;\"><ol>{$OkAdd}</ol></span>";
						closetable();
					}
			}
				else
			{
				$Mfo->Field->PreparationEditing( $id );
				$FieldsValue = $Mfo->Field->ReturnFieldsValueOnError;
			}
		
		if( $OkAdd !== true )
			{	
				echoheader( "<i class=\"fa fa-home position-left\"></i><span class=\"text-semibold\">Редактирование дополнительного поля</span>","<a href=\"$PHP_SELF?mod=mfo\">Каталог МФО 3.0</a> / <a href=\"$PHP_SELF?mod=mfo&do=fields\">Дополнительные поля</a>" );
				opentable();
				tableheader( "Редактирование дополнительного поля" );
				$AllowGroups = MfoGroups( explode( ",", $Mfo->Field->ReturnFieldsValueOnError['AllowGroups'] ), "yes", true );
				$EditGroups = MfoGroups( explode( ",", $Mfo->Field->ReturnFieldsValueOnError['EditGroups'] ), "no", true );
				$FormType = $Mfo->Field->ReturnFormType( $id );
				
				$HtmlChecked = $Mfo->Field->ReturnFieldsValueOnError['filtre_html'] == 1 ? "checked=\"checked\"" : "";
				$JsDisabled = $HtmlChecked ? "" : "disabled=\"disabled\"";
				$JsChecked = $Mfo->Field->ReturnFieldsValueOnError['filtre_js'] == 1 && !$JsDisabled ? "checked=\"checked\"" : "";
				$BrChecked = $Mfo->Field->ReturnFieldsValueOnError['filtre_br'] == 1 ? "checked=\"checked\"" : "";
				$ShowCreateChecked = $Mfo->Field->ReturnFieldsValueOnError['show_create'] == 1 ? "checked=\"checked\"" : "";
				$AllowEditChecked = $Mfo->Field->ReturnFieldsValueOnError['allow_edit'] == 1 ? "checked=\"checked\"" : "";
				
				$RequiredDisabled = !$ShowCreateChecked && !$AllowEditChecked ? "disabled=\"disabled\"" : "";
				$RequiredChecked = $Mfo->Field->ReturnFieldsValueOnError['required'] == 1 && !$RequiredDisabled ? "checked=\"checked\"" : "";
				
				$About = $Mfo->Field->ReturnFieldsValueOnError['about'];
				$LinkAbout = empty( $About ) ? "" : "display: none;";
				$divAbout = empty( $About ) ? "display: none;" : "";
				
				$AllowCats = $Mfo->SelectCategory( explode( ",", $Mfo->Field->ReturnFieldsValueOnError['AllowCats'] ), "", "", "", true );
				
		
echo <<<HTML

<form method="post" class="form-horizontal" action="" name="field_add">
	<div class="panel-body">



		<div class="form-group">
			<label class="control-label col-sm-2">Имя: *</label>
				<div class="col-sm-10">
					<input type="text" name="name" value="{$FieldsValue[name]}" class="form-control width-400 position-left"  />
				</div>
		</div>
		<div class="form-group" style="display: none;">
			<label class="control-label col-sm-2">Описание:</label>
				<div class="col-sm-10">
					<a style="{$LinkAbout}" id="LinkShowAbout" href="javascript:void(0);" onclick="ShowOrHide( 'LinkShowAbout' ); ShowOrHide( 'FormAbout' ); return false;">Добавить описание</a>
					<div id="FormAbout" style="{$divAbout} padding: 3px 0px 3px 0px;">
						<textarea name="about" style="width: 90%; height: 80px;">{$About}</textarea><br />
						<span style="color: #999;">Разрешён HTML и JS</span>
					</div>
				</div>
		</div>
		
		
	{$FormType}
		
		<div class="form-group">
			<label class="control-label col-sm-2">Фильтрация:</label>
				<div class="col-sm-10">
					<input type="checkbox" name="filtre_html" value="1" id="filtre_html" onclick="if( this.checked === true ){ document.getElementById( 'filtre_js' ).disabled = false; } else { document.getElementById( 'filtre_js' ).checked = false; document.getElementById( 'filtre_js' ).disabled = true; }" {$HtmlChecked} />
					<label for="filtre_html">Разрешить HTML</label><br />
					<input type="checkbox" name="filtre_js" value="1" id="filtre_js" {$JsDisabled} {$JsChecked} />
					<label for="filtre_js">Разрешить Javascript</label><br />
					<input type="checkbox" name="filtre_br" value="1" id="filtre_br" {$BrChecked} />
					<label for="filtre_br">Новые строки заменять тегом &lt;br /&gt;</label><br />
				</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-2">Разрешить редактировать: *</label>
				<div class="col-sm-10">
					<select name="EditGroups[]" multiple="multiple" style="height: 60px;">
						{$EditGroups}
					</select>
				</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-2">Разрешить просмотр: *</label>
				<div class="col-sm-10">
					<select name="AllowGroups[]" multiple="multiple" style="height: 60px;">
						{$AllowGroups}
					</select>
				</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-2">Разрешённые категории: *</label>
				<div class="col-sm-10">
					<select name="AllowCats[]" multiple="multiple" style="height: 100px;">
						{$AllowCats}
					</select>
				</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-2">Другие опции:</label>
				<div class="col-sm-10">
					
						<input type="checkbox" name="show_create" value="1" id="show_create" onclick="FieldRequired();" {$ShowCreateChecked} />
						<label for="show_create">Показывать при создании МФО</label><br />
						<input type="checkbox" name="allow_edit" value="1" id="allow_edit" onclick="FieldRequired();" {$AllowEditChecked} />
						<label for="allow_edit">Разрешить изменять после создания</label><br />
						<input type="checkbox" name="required" value="1" id="required" {$RequiredChecked} {$RequiredDisabled} />
						<label for="required">Обязательное поле</label><br />
					</select>
				</div>
		</div>

HTML;

closetable();	

echo <<<HTML
	<div class="panel-footer">
		<div class="pull-left">
			<ul class="pagination pagination-sm">
				<input type="submit" name="submit" value="Сохранить" class="btn bg-slate-600 btn-sm btn-raised legitRipple" />
			</ul>
		</div>
		<div class="pull-right">
		
		</div>
	
	
	</div>
</form>
HTML;
				closetable();
				echo EchoAJAX( true );
				echo FieldsType( $Mfo->Field->AllowType );
				minifooter();
			}
	}

//---------------------------------------------======
//	Получение тега дополнительного поля
//---------------------------------------------======

elseif( $ShowAction == "tag" )
	{
		$OneID = 0;
		$ListField = array();
		foreach( $Mfo->Field->DB as $row )
			{
				if( $row[0] < $OneID || !$OneID ) $OneID = $row[0];
				if( $row[0] == $_REQUEST['id'] ) $select = $row[1];
				$ListField[ $row[1] ] = $row[2];
			}
			
		$ListField = SelectList( $ListField, $select );
		if( $Mfo->Field->DB[ $_REQUEST['id'] ] ) $OneID = $_REQUEST['id'];
		$StartAltName = $Mfo->Field->DB[ $OneID ][1];
		
		$preview = "{Mfofield:{$StartAltName}}";
		$block = "[Mfofield:{$StartAltName}]Здесь любой текст[/Mfofield:{$StartAltName}]";
		$tag_preview = "[not-Mfofield:{$StartAltName}]Здесь любой текст[/not-Mfofield:{$StartAltName}]";
		
		miniloader( "Получение кода для показа дополнительного поля" );
		opentable();
		tableheader( "Получение кода для показа дополнительного поля" );
		
echo <<<HTML




<table width="100%">
	<tr>
		<td colspan="2" style="border-bottom: 1px dotted #ccc;" height="1"></td>
	</tr>
    <tr height="29px">
        <td width="130px">Выберите поле:</td>
        <td>
			<select id="field" onKeyUp="select_field();" onKeyDown="select_field();" onChange="select_field();">
				$ListField
			</select>
		</td>
    </tr>
	<tr>
		<td colspan="2" style="border-bottom: 1px dotted #ccc;" height="1"></td>
	</tr>	
</table>

<div class="hr_line"></div>


<table width="100%">
	<tr>
		<td colspan="2" style="border-bottom: 1px dotted #ccc;" height="1"></td>
	</tr>
    <tr height="29px">
        <td width="130px">Код для показа:</td>
        <td>
			<input type="text" class="edit" style="width: 90%;" id="preview" onfocus="this.select()" value="$preview" />
			<img src="engine/inc/mfo/style/images/hint.gif" class="hintanchor" onMouseover="showhint('Данный код вы можете вставлять абсолютно в любые шаблоны вашего сайта (будь то любой чужой модуль или панель пользователя). Вместо этого кода автоматически будет вставляться меню, иначе оно будет также автоматически скрываться.', this, event, '220px')" />
		</td>
    </tr>
	<tr>
		<td colspan="2" style="border-bottom: 1px dotted #ccc;" height="1"></td>
	</tr>
	<tr height="29px">
        <td>Теги для скрытия:</td>
        <td>
			<input type="text" class="edit" style="width: 90%;" id="block" onfocus="this.select()" value="$block" />
			<img src="engine/inc/mfo/style/images/hint.gif" class="hintanchor" onMouseover="showhint('Если меню показалось, то содержимое данных тегов покажется, иначе скроется автоматически. Использовать можете также в любых шаблонах сайта. Текст \'Здесь любой тескт\' заменяете на свой.', this, event, '220px')" />
		</td>
    </tr>
	<tr>
		<td colspan="2" style="border-bottom: 1px dotted #ccc;" height="1"></td>
	</tr>	
	<tr height="29px">
        <td>Теги для показа:</td>
        <td>
			<input type="text" class="edit" style="width: 90%;" id="tag_preview" onfocus="this.select()" value="$tag_preview" />
			<img src="engine/inc/mfo/style/images/hint.gif" class="hintanchor" onMouseover="showhint('Данные теги полностью противоположны тегам для скрытия. Если меню показалось, то содержимое тегов скроется, иначе покажется.', this, event, '220px')" />
		</td>
    </tr>
	<tr>
		<td colspan="2" style="border-bottom: 1px dotted #ccc;" height="1"></td>
	</tr>	
</table>



<div class="hr_line"></div>

	<a class="btn bg-teal btn-sm btn-raised position-left legitRipple" href="$PHP_SELF?mod=mfo" />На главную страницу модулю</a>


<script language="javascript">

function select_field(){
	
	var field = document.getElementById( "field" ).value;
	
	document.getElementById( "preview" ).value = "{Mfofield:" + field + "}";
	document.getElementById( "block" ).value = "[Mfofield:" + field + "]Здесь любой текст[/Mfofield:" + field + "]";
	document.getElementById( "tag_preview" ).value = "[not-Mfofield:" + field + "]Здесь любой текст[/not-Mfofield:" + field + "]";
			
}

</script>

HTML;
		closetable();
		minifooter();
	}
	
//---------------------------------------------======
//	Вывод списка дополнительных полей
//---------------------------------------------======

		else
	{
		minimsg( "Дополнительные поля", "Не верный запрос" );
	}
echofooter();
?>