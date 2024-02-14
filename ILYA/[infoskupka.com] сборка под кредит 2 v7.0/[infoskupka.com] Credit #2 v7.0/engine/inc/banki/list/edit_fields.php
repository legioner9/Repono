<?php


if( !defined( "DATALIFEENGINE" ) ) die( "Hacking attempt!" );



if( $Banki->Field === false ) $Banki->StartField( true );
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
				$OkAdd = $Banki->Field->AddField();
				if( $OkAdd === true )
					{
						echoheader( "<i class=\"fa fa-home position-left\"></i><span class=\"text-semibold\">Добавление дополнительного поля</span>","<a href=\"$PHP_SELF?mod=banki\">Каталог банков 7.0</a> / <a href=\"$PHP_SELF?mod=banki&do=fields\">Дополнительные поля</a>" );
						opentable();
						echo ThisClose();
						minimsg( "Добавление дополнительного поля", "Дополнительное поле было успешно создано<script language=\"javascript\" type=\"text/javascript\">UpdateFields();</script>" );
						closetable();
					}
						else
					{
						$FieldsValue = $Banki->Field->ReturnFieldsValueOnError;
						opentable();
						tableheader( "Ошибка" );
						echo "<span style=\"color: #F00;\"><ol>{$OkAdd}</ol></span>";
						closetable();
					}
			}
				else
			{
				$Banki->Field->ReturnFieldsValueOnError['allow_edit'] = 1;
			}
		
		if( $OkAdd !== true )
			{	
				echoheader( "<i class=\"fa fa-home position-left\"></i><span class=\"text-semibold\">Добавление дополнительного поля</span>","<a href=\"$PHP_SELF?mod=banki\">Каталог банков 3.0</a> / <a href=\"$PHP_SELF?mod=banki&do=fields\">Дополнительные поля</a>" );
				opentable();
				tableheader( "Добавление дополнительного поля" );
				
				$AllowGroups = BankiGroups( explode( ",", $Banki->Field->ReturnFieldsValueOnError['AllowGroups'] ), "yes", true );
				$EditGroups = BankiGroups( explode( ",", $Banki->Field->ReturnFieldsValueOnError['EditGroups'] ), "no", true );
				$AllowType = SelectList( $Banki->Field->TypeName, $Banki->Field->ReturnFieldsValueOnError['type'] );
				$FormType = $Banki->Field->ReturnFormType();
				
				$HtmlChecked = $Banki->Field->ReturnFieldsValueOnError['filtre_html'] == 1 ? "checked=\"checked\"" : "";
				$JsDisabled = $HtmlChecked ? "" : "disabled=\"disabled\"";
				$JsChecked = $Banki->Field->ReturnFieldsValueOnError['filtre_js'] == 1 && !$JsDisabled ? "checked=\"checked\"" : "";
				$BrChecked = $Banki->Field->ReturnFieldsValueOnError['filtre_br'] == 1 ? "checked=\"checked\"" : "";
				$ShowCreateChecked = $Banki->Field->ReturnFieldsValueOnError['show_create'] == 1 ? "checked=\"checked\"" : "";
				$AllowEditChecked = $Banki->Field->ReturnFieldsValueOnError['allow_edit'] == 1 ? "checked=\"checked\"" : "";
				
				$RequiredDisabled = !$ShowCreateChecked && !$AllowEditChecked ? "disabled=\"disabled\"" : "";
				$RequiredChecked = $Banki->Field->ReturnFieldsValueOnError['required'] == 1 && !$RequiredDisabled ? "checked=\"checked\"" : "";
				
				$About = $Banki->Field->ReturnFieldsValueOnError['about'];
				$LinkAbout = empty( $About ) ? "" : "display: none;";
				$divAbout = empty( $About ) ? "display: none;" : "";
				
				if( !$Banki->Field->ReturnFieldsValueOnError['AllowCats'] ) $Banki->Field->ReturnFieldsValueOnError['AllowCats'] = "all";
				$AllowCats = $Banki->SelectCategory( explode( ",", $Banki->Field->ReturnFieldsValueOnError['AllowCats'] ), "", "", "", true );
		
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
					<label for="show_create">Показывать при создании Банка</label><br />
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
				echo FieldsType( $Banki->Field->AllowType );
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
		if( !is_array( $Banki->Field->DB[ $id ] ) ) minimsg( "Ошибка", "Указнное поле не существует" );
		
		$OkAdd = false;
		miniloader( "Редактирование доп. поля" );
		
		if( isset( $_POST['submit'] ) )
			{
				$OkAdd = $Banki->Field->AddField( $id );
				if( $OkAdd === true )
					{
						echoheader( "<i class=\"fa fa-home position-left\"></i><span class=\"text-semibold\">Добавление дополнительного поля</span>","<a href=\"$PHP_SELF?mod=banki\">Каталог банков 3.0</a> / <a href=\"$PHP_SELF?mod=banki&do=fields\">Дополнительные поля</a>" );
						opentable();
						echo ThisClose();
						minimsg( "Редактирование дополнительного поля", "Дополнительное поле было успешно отредактировано<script language=\"javascript\" type=\"text/javascript\">UpdateFields( true );</script>", "$PHP_SELF?mod=banki&amp;action=field&amp;show_action=edit&amp;id={$id}"  );
						closetable();
					}
						else
					{
						$FieldsValue = $Banki->Field->ReturnFieldsValueOnError;
						opentable();
						tableheader( "Ошибка" );
						echo "<span style=\"color: #F00;\"><ol>{$OkAdd}</ol></span>";
						closetable();
					}
			}
				else
			{
				$Banki->Field->PreparationEditing( $id );
				$FieldsValue = $Banki->Field->ReturnFieldsValueOnError;
			}
		
		if( $OkAdd !== true )
			{	
				echoheader( "<i class=\"fa fa-home position-left\"></i><span class=\"text-semibold\">Редактирование дополнительного поля</span>","<a href=\"$PHP_SELF?mod=banki\">Каталог банков 3.0</a> / <a href=\"$PHP_SELF?mod=banki&do=fields\">Дополнительные поля</a>" );
				opentable();
				tableheader( "Редактирование дополнительного поля" );
				$AllowGroups = BankiGroups( explode( ",", $Banki->Field->ReturnFieldsValueOnError['AllowGroups'] ), "yes", true );
				$EditGroups = BankiGroups( explode( ",", $Banki->Field->ReturnFieldsValueOnError['EditGroups'] ), "no", true );
				$FormType = $Banki->Field->ReturnFormType( $id );
				
				$HtmlChecked = $Banki->Field->ReturnFieldsValueOnError['filtre_html'] == 1 ? "checked=\"checked\"" : "";
				$JsDisabled = $HtmlChecked ? "" : "disabled=\"disabled\"";
				$JsChecked = $Banki->Field->ReturnFieldsValueOnError['filtre_js'] == 1 && !$JsDisabled ? "checked=\"checked\"" : "";
				$BrChecked = $Banki->Field->ReturnFieldsValueOnError['filtre_br'] == 1 ? "checked=\"checked\"" : "";
				$ShowCreateChecked = $Banki->Field->ReturnFieldsValueOnError['show_create'] == 1 ? "checked=\"checked\"" : "";
				$AllowEditChecked = $Banki->Field->ReturnFieldsValueOnError['allow_edit'] == 1 ? "checked=\"checked\"" : "";
				
				$RequiredDisabled = !$ShowCreateChecked && !$AllowEditChecked ? "disabled=\"disabled\"" : "";
				$RequiredChecked = $Banki->Field->ReturnFieldsValueOnError['required'] == 1 && !$RequiredDisabled ? "checked=\"checked\"" : "";
				
				$About = $Banki->Field->ReturnFieldsValueOnError['about'];
				$LinkAbout = empty( $About ) ? "" : "display: none;";
				$divAbout = empty( $About ) ? "display: none;" : "";
				
				$AllowCats = $Banki->SelectCategory( explode( ",", $Banki->Field->ReturnFieldsValueOnError['AllowCats'] ), "", "", "", true );
				
		
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
						<label for="show_create">Показывать при создании банка</label><br />
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
				echo FieldsType( $Banki->Field->AllowType );
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
		foreach( $Banki->Field->DB as $row )
			{
				if( $row[0] < $OneID || !$OneID ) $OneID = $row[0];
				if( $row[0] == $_REQUEST['id'] ) $select = $row[1];
				$ListField[ $row[1] ] = $row[2];
			}
			
		$ListField = SelectList( $ListField, $select );
		if( $Banki->Field->DB[ $_REQUEST['id'] ] ) $OneID = $_REQUEST['id'];
		$StartAltName = $Banki->Field->DB[ $OneID ][1];
		
		$preview = "{Bankifield:{$StartAltName}}";
		$block = "[Bankifield:{$StartAltName}]Здесь любой текст[/Bankifield:{$StartAltName}]";
		$tag_preview = "[not-Bankifield:{$StartAltName}]Здесь любой текст[/not-Bankifield:{$StartAltName}]";
		
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
			<img src="engine/inc/banki/style/images/hint.gif" class="hintanchor" onMouseover="showhint('Данный код вы можете вставлять абсолютно в любые шаблоны вашего сайта (будь то любой чужой модуль или панель пользователя). Вместо этого кода автоматически будет вставляться меню, иначе оно будет также автоматически скрываться.', this, event, '220px')" />
		</td>
    </tr>
	<tr>
		<td colspan="2" style="border-bottom: 1px dotted #ccc;" height="1"></td>
	</tr>
	<tr height="29px">
        <td>Теги для скрытия:</td>
        <td>
			<input type="text" class="edit" style="width: 90%;" id="block" onfocus="this.select()" value="$block" />
			<img src="engine/inc/banki/style/images/hint.gif" class="hintanchor" onMouseover="showhint('Если меню показалось, то содержимое данных тегов покажется, иначе скроется автоматически. Использовать можете также в любых шаблонах сайта. Текст \'Здесь любой тескт\' заменяете на свой.', this, event, '220px')" />
		</td>
    </tr>
	<tr>
		<td colspan="2" style="border-bottom: 1px dotted #ccc;" height="1"></td>
	</tr>	
	<tr height="29px">
        <td>Теги для показа:</td>
        <td>
			<input type="text" class="edit" style="width: 90%;" id="tag_preview" onfocus="this.select()" value="$tag_preview" />
			<img src="engine/inc/banki/style/images/hint.gif" class="hintanchor" onMouseover="showhint('Данные теги полностью противоположны тегам для скрытия. Если меню показалось, то содержимое тегов скроется, иначе покажется.', this, event, '220px')" />
		</td>
    </tr>
	<tr>
		<td colspan="2" style="border-bottom: 1px dotted #ccc;" height="1"></td>
	</tr>	
</table>



<div class="hr_line"></div>

	<a class="btn bg-teal btn-sm btn-raised position-left legitRipple" href="$PHP_SELF?mod=banki" />На главную страницу модулю</a>


<script language="javascript">

function select_field(){
	
	var field = document.getElementById( "field" ).value;
	
	document.getElementById( "preview" ).value = "{Bankifield:" + field + "}";
	document.getElementById( "block" ).value = "[Bankifield:" + field + "]Здесь любой текст[/Bankifield:" + field + "]";
	document.getElementById( "tag_preview" ).value = "[not-Bankifield:" + field + "]Здесь любой текст[/not-Bankifield:" + field + "]";
			
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