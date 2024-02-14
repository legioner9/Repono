<?php


if( !defined( "DATALIFEENGINE" ) ) die( "Hacking attempt!" );



class MfoField {
	
	//----------------------------------------------------------=-=-=-=-=
	//	Настройки модуля
	//----------------------------------------------------------=-=-=-=-=
	
	var $FileDB = "";
	var $AllowType = array( "mini_text", "text", "select", "radio", "checkbox", "img" );
	var $TypeName = array(
		"mini_text"			=> "Маленькое поле",
		"text"				=> "Большое поле",
		"select"			=> "Список",
		"radio"				=> "Радио кнопки",
		"checkbox"			=> "Чекбоксы",
		"img"				=> "Картинка",
	);
	
	var $OkAdd = false;
	var $DB = array();
	var $IndexDB = array();
	var $LastID = 0;
	var $ReturnFieldsValueOnError = array();
	var $ErrorSave = "";
	var $TypeAdd = "add";
	var $MfoXfields = array();
	var $CategoryJS = array();
	
	//----------------------------------------------------------=-=-=-=-=
	//	Инициализация класса
	//----------------------------------------------------------=-=-=-=-=
	
	function MfoField( $db ){
		
		$this->FileDB = $db;
		$this->OpenDB();
		foreach( $this->AllowType as $Type )
			{
				$FormMethod = "Form_{$Type}";
				$SelectMethod = "Filter_{$Type}";
				if( !method_exists( $this, $FormMethod ) || !method_exists( $this, $SelectMethod ) )
					{
						unset( $this->AllowType[ $Type ] );
						unset( $this->TypeName[ $Type ] );
					}
			}
	}
	
	//----------------------------------------------------------=-=-=-=-=
	//	Открытие БД
	//----------------------------------------------------------=-=-=-=-=
	
	function OpenDB(){
		
		if( file_exists( $this->FileDB ) )
			{
				$DB = file( $this->FileDB );
				foreach( $DB as $value )
					{
						$value = trim( $value );
						$value = explode( "|||", $value );
						if( $value[0] )
							{
								$value[1] = $this->FilterText( $value[1], "read" );
								$value[2] = $this->FilterText( $value[2], "read" );
								$value[6] = explode( ",", $this->FilterText( $value[6], "read" ) );
								$value[7] = explode( ",", $this->FilterText( $value[7], "read" ) );
								$value[13] = $this->FilterText( $value[13], "read" );
								$value[14] = explode( ",", $this->FilterText( $value[14], "read" ) );
								
								$TypeOpt = explode( "##-@-##", $this->FilterText( $value[15], "read" ) );
								$value[15] = array();
								foreach( $TypeOpt as $TypeValue )
									{
										$TypeValue = explode( "@#!!!#@", $TypeValue );
										$value[15][ $TypeValue[0] ] = $TypeValue[1];
									}
									
								$this->DB[ $value[0] ] = $value;
								$this->IndexDB[ $value[1] ] = $value[0];
								if( $this->LastID < $value[0] ) $this->LastID = $value[0];
							}
					}
				
				$this->SortField();
			}
	}
	
	//----------------------------------------------------------=-=-=-=-=
	//	Сохранение всех дополнительных полей в БД
	//----------------------------------------------------------=-=-=-=-=
	
	function SaveDB(){
		
		$Rec = "";
		if( count( $this->DB ) > 0 )
			{
				foreach( $this->DB as $value )
					{
						$value[0] = intval( $value[0] );
						$value[1] = $this->FilterText( $value[1] );
						$value[2] = $this->FilterText( $value[2] );
						$value[3] = $value[3] == 1 ? 1 : 0;
						$value[4] = $value[4] == 1 ? 1 : 0;
						$value[5] = $value[5] == 1 ? 1 : 0;
						$value[6] = $this->FilterText( implode( ",", $value[6] ) );
						$value[7] = $this->FilterText( implode( ",", $value[7] ) );
						$value[8] = $value[8] == 1 ? 1 : 0;
						$value[9] = $value[9] == 1 ? 1 : 0;
						$value[10] = $value[10] == 1 ? 1 : 0;
						$value[11] = intval( $value[11] );
						$value[12] = $value[12];
						$value[13] = $this->FilterText( $value[13] );
						$value[14] = $this->FilterText( implode( ",", $value[14] ) );
						
						$TypeOpt = array();
						foreach( $value[15] as $name => $type_value ) $TypeOpt[] = "{$name}@#!!!#@{$type_value}";
						$value[15] = $this->FilterText( implode( "##-@-##", $TypeOpt ) );
						$Rec .= implode( "|||", $value )."\n";
					}
			}	
			
		if( file_exists( $this->FileDB ) )
			{
				$fp = fopen( $this->FileDB, "w+" );
				fwrite( $fp, $Rec );
				fclose( $fp );
				
				return true;
			}
		
		return false;
	}
	
	//----------------------------------------------------------=-=-=-=-=
	//	Удаление дополнительного поля из БД
	//----------------------------------------------------------=-=-=-=-=
	
	function Delete( $id ){
		unset( $this->DB[ $id ] );
		$this->SaveDB();
	}
	
	//----------------------------------------------------------=-=-=-=-=
	//	Сортировка полей
	//----------------------------------------------------------=-=-=-=-=
	
	function SortField() {
		uasort( $this->DB, "MfoSortField" );
	}
	
	//----------------------------------------------------------=-=-=-=-=
	//	Возвращение формы создания полей
	//----------------------------------------------------------=-=-=-=-=
	
	function ReturnFormType( $id = "" ){
		
		if( $id )
			{
				$Type = $this->DB[ $id ][12];
				$method_name = "Form_{$Type}";
				$return = $this->$method_name();
			}
				else
			{
				$i = $this->ReturnFieldsValueOnError['type'] != "" ? 1 : 0;
				$return = "";
				foreach( $this->AllowType as $Type )
					{
						if( $i == 0 || $this->ReturnFieldsValueOnError['type'] == $Type )
							$display = "";
						else
							$display = " style=\"display: none;\"";
						
						$method_name = "Form_{$Type}";
						if( method_exists( $this, $method_name ) )
							$method_return = $this->$method_name();
						else
							$method_return = "Метод в классе не найден, проверьте тип.";
						
						$return .= "<div id=\"filed_{$Type}\"{$display}>{$method_return}</div>";
						$i++;
					}
			}
		
		return $return;
	}
	
	//----------------------------------------------------------=-=-=-=-=
	//	Фильтрация текста для добавлениия в БД
	//----------------------------------------------------------=-=-=-=-=
	
	function FilterText( $text, $type = "save" ){
		$find = array( "\|", "\n", "=" );
		$replace = array( "&864&", "&278&", "&758&" );
		
		$text = str_replace( "\r", "", $text );
		if( $type == "save" )
			{
				foreach( $find as $key => $value ) $find[ $key ] = "'{$value}'";
				$text = preg_replace( $find, $replace, $text );
			}
				else
			{
				foreach( $find as $key => $value ) $find[ $key ] = stripslashes( $value );
				foreach( $replace as $key => $value ) $replace[ $key ] = "'{$value}'";
				$text = preg_replace( $replace, $find, $text );
			}
			
		return $text;
	}
	
	//----------------------------------------------------------=-=-=-=-=
	//	Подготовка к редактированию поля (Имитация ошибок для заполнения полей)
	//----------------------------------------------------------=-=-=-=-=
	
	function PreparationEditing( $id ){
		
		$this->ReturnFieldsValueOnError['name'] = $this->DB[ $id ][2];
		$this->ReturnFieldsValueOnError['filtre_js'] = $this->DB[ $id ][4];
		$this->ReturnFieldsValueOnError['filtre_br'] = $this->DB[ $id ][5];
		$this->ReturnFieldsValueOnError['filtre_html'] = $this->DB[ $id ][3];
		$this->ReturnFieldsValueOnError['EditGroups'] = implode( ",", $this->DB[ $id ][6] );
		$this->ReturnFieldsValueOnError['AllowGroups'] = implode( ",", $this->DB[ $id ][7] );
		$this->ReturnFieldsValueOnError['show_create'] = $this->DB[ $id ][8];
		$this->ReturnFieldsValueOnError['allow_edit'] = $this->DB[ $id ][9];
		$this->ReturnFieldsValueOnError['required'] = $this->DB[ $id ][10];
		$this->ReturnFieldsValueOnError['about'] = $this->DB[ $id ][13];
		$this->ReturnFieldsValueOnError['AllowCats'] = implode( ",", $this->DB[ $id ][14] );
		$this->ReturnFieldsValueOnError['field'][ $this->DB[ $id ][12] ] = $this->DB[ $id ][15];
		
	}
	
	//----------------------------------------------------------=-=-=-=-=
	//	Добавление поля
	//----------------------------------------------------------=-=-=-=-=
	
	function AddField( $id = false ){
		
		$this->OkAdd = "";
		$type = $id !== false ? $this->DB[ $id ][12] : totranslit( $_POST['type'] );
		$name = trim( stripslashes( $_POST['name'] ) );
		$alt_name = $_POST['name'] != "" ? totranslit( trim( $_POST['name'] ) ) : totranslit( $name );
		$about = stripslashes( trim( $_POST['about'] ) );
		
		// Фильтрация
		$filtre_html = $_POST['filtre_html'] == 1 ? 1 : 0;
		$filtre_js = ( $_POST['filtre_js'] == 1 && $filtre_html == 1 ) ? 1 : 0;
		$filtre_br = $_POST['filtre_br'] == 1 ? 1 : 0;
		
		// Разрешить просмотр
		$AllowGroups = is_array( $_POST['AllowGroups'] ) ? $_POST['AllowGroups'] : array( "all" );
			
		// Разрешить редактирование
		$EditGroups = is_array( $_POST['EditGroups'] ) ? $_POST['EditGroups'] : array( "all" );
		
		// Разрешить категории
		$AllowCats = is_array( $_POST['AllowCats'] ) ? $_POST['AllowCats'] : array( "all" );
		
		// Доп. опции
		$show_create = $_POST['show_create'] == 1 ? 1 : 0;
		$allow_edit = $_POST['allow_edit'] == 1 ? 1 : 0;
		$required = ( $_POST['required'] == 1 && ( $show_create == 1 || $allow_edit == 1 ) ) ? 1 : 0;
		
		// Опции типа поля
		$SelectMethod = "Filter_{$type}";
		if( method_exists( $this, $SelectMethod ) )
			$TypeOpt = $this->$SelectMethod();
		else
			$this->OkAdd .= "<li>Не верный тип или метод класса для обработки не найден, повторите попытку.</li>";
		
		// Проверка на ошибки
		if( !$name ) $this->OkAdd .= "<li>Введите название поля.</li>";
		
		if( !@file_exists( $this->FileDB ) ) $this->OkAdd .= "<li>Не верная инициализация класса, необходимо вручную указать путь до файла БД.</li>";
		
		// Само добавление (при условии, что нет ошибок)
		if( $this->OkAdd == "" )
			{
				$this->OkAdd = true;
				
				if( $id !== false )
					{
						$SaveID = $id;
						$SaveSort = $this->DB[ $id ][11];
						
						//die( "{$SaveID}" );
					}
						else
					{
						$this->LastID++;
						$SaveID = $this->LastID;
						$SaveSort = $SaveID;
					}
				
				$this->DB[ $SaveID ][0]		= $SaveID;
				$this->DB[ $SaveID ][1]		= $id !== false ? $this->DB[ $id ][1] : $alt_name;
				$this->DB[ $SaveID ][2]		= $name;
				$this->DB[ $SaveID ][3]		= $filtre_html;
				$this->DB[ $SaveID ][4]		= $filtre_js;
				$this->DB[ $SaveID ][5]		= $filtre_br;
				$this->DB[ $SaveID ][6]		= $EditGroups;
				$this->DB[ $SaveID ][7]		= $AllowGroups;
				$this->DB[ $SaveID ][8]		= $show_create;
				$this->DB[ $SaveID ][9]		= $allow_edit;
				$this->DB[ $SaveID ][10]	= $required;
				$this->DB[ $SaveID ][11]	= $SaveSort;
				$this->DB[ $SaveID ][12]	= $id !== false ? $this->DB[ $id ][12] : $type;
				$this->DB[ $SaveID ][13]	= $about;
				$this->DB[ $SaveID ][14]	= $AllowCats;
				$this->DB[ $SaveID ][15]	= $TypeOpt;
				
				$this->IndexDB[ $this->DB[ $SaveID ][1] ] = $SaveID;
				$this->SaveDB();
			}
				else
			{
				$this->ReturnFieldsValueOnError['type'] = $type;
				$this->ReturnFieldsValueOnError['name'] = $name;
				$this->ReturnFieldsValueOnError['alt_name'] = $alt_name;
				$this->ReturnFieldsValueOnError['filtre_js'] = $filtre_js;
				$this->ReturnFieldsValueOnError['filtre_br'] = $filtre_br;
				$this->ReturnFieldsValueOnError['filtre_html'] = $filtre_html;
				$this->ReturnFieldsValueOnError['EditGroups'] = implode( ",", $EditGroups );
				$this->ReturnFieldsValueOnError['AllowGroups'] = implode( ",", $AllowGroups );
				$this->ReturnFieldsValueOnError['show_create'] = $show_create;
				$this->ReturnFieldsValueOnError['allow_edit'] = $allow_edit;
				$this->ReturnFieldsValueOnError['required'] = $required;
				$this->ReturnFieldsValueOnError['about'] = $about;
				$this->ReturnFieldsValueOnError['AllowCats'] = implode( ",", $AllowCats );
				$this->ReturnFieldsValueOnError['field'][ $type ] = $TypeOpt;
			}
		
		return $this->OkAdd;
	}
	
	//----------------------------------------------------------=-=-=-=-=
	//	Расшифровка БД полей блога
	//----------------------------------------------------------=-=-=-=-=
	
	function ExplodeXfields( $value, $decode = false ){
		
		$this->MfoXfields = array();
		$value = explode( "|||", $value );
				
		foreach( $value as $ToXfields )
			{
				$ToXfields = explode( "=", $ToXfields );
				$this->MfoXfields[ $ToXfields[0] ] = $this->FilterText( $ToXfields[1], "edit" );
				if( $decode === true ) $this->MfoXfields[ $ToXfields[0] ] =  htmlspecialchars_decode( $this->MfoXfields[ $ToXfields[0] ] );
			}		
	}
	
	//----------------------------------------------------------=-=-=-=-=
	//	Вывод формы заполнения полей в блоге
	//----------------------------------------------------------=-=-=-=-=
	
	function ShowForm( $type = "add", $template, $value = "", $CategoryID = "" ){
		global $member_id;
		
		$return = "";
		$this->TypeAdd = $type;
		if( count( $this->DB ) > 0 )
			{
				$i = 1;
				$this->ExplodeXfields( $value, true );
				foreach( $this->DB as $row )
					{
						if( $row[8] != 1 && $this->TypeAdd == "add" ) continue;
						if( $row[9] != 1 && $this->TypeAdd == "edit" ) continue;
						if( !in_array( $member_id['user_group'], $row[6] ) && !in_array( "all", $row[6] ) ) continue;
						
						// Разрешённые категории
						if( $type == "edit" )
							{
								$AllowCategory = ( count( $row[14] ) > 0 && !in_array( "all", $row[14] ) && !in_array( $CategoryID, $row[14] ) ) ? false : true;
								if( !$AllowCategory && $CategoryID != "" ) continue;
							}
						
						$MethodName = "ShowForm_{$row['12']}";
						if( method_exists( $this, $MethodName ) )
							{
								foreach( $row['14'] as $CategoryJsID ) $this->CategoryJS[ $CategoryJsID ][] = $i;
								
								$ForReturn = $template;
								$TypeForm = $this->$MethodName( $row[15], $this->MfoXfields[ $row[1] ], $row[1] );
								$TypeForm = str_replace( "<FieldBr>", "\n", $TypeForm );
								$ForReturn = str_replace( "{title}", stripslashes( $row[2] ), $ForReturn );
								$ForReturn = str_replace( "{about}", $row[13], $ForReturn );
								$ForReturn = str_replace( "{form}", $TypeForm, $ForReturn );
								$ForReturn = str_replace( "{id}", "id=\"MfoField_{$i}\"", $ForReturn );
								
								if( $row[10] == 1 )
									$ForReturn = preg_replace( "#\[required\](.+?)\[/required\]#i", "\\1", $ForReturn );
								else
									$ForReturn = preg_replace( "#\[required\](.+?)\[/required\]#i", "", $ForReturn );									
									
								$return .= $ForReturn;
								$i++;
							}
					}
			}
			
		return $return;
	}
	
	//----------------------------------------------------------=-=-=-=-=
	//	Сохранение полей в блоге
	//----------------------------------------------------------=-=-=-=-=
	
	function SaveField( $type = "add", $value = "", $CategoryID = "" ){
		global $config;
		
		$this->TypeAdd = $type;
		if( count( $this->DB ) > 0 )
			{
				$return = array();
				$this->ExplodeXfields( $value, false );
				foreach( $this->DB as $row )
					{
						// Разрешено ли редактировать данное поле
						$AllowEdit = ( ( ( $row[9] != 1 && $this->TypeAdd == "edit" ) || ( $row[8] != 1 && $this->TypeAdd == "add" ) ) || ( !in_array( $member_id['user_group'], $row[6] ) && !in_array( "all", $row[6] ) ) ) ? false : true;
						
						// Разрешённые категории
						$AllowCategory = ( count( $row[14] ) > 0 && !in_array( "all", $row[14] ) && !in_array( $CategoryID, $row[14] ) ) ? false : true;
						
						$MethodName = "SaveForm_{$row['12']}";
						if( method_exists( $this, $MethodName ) )
							{
								$name = htmlspecialchars( stripslashes( $row[2] ), ENT_QUOTES, $config['charset'] );
								if( !$AllowEdit || !$AllowCategory )
									{
										// Если не разрешённая категория
										if( !$AllowCategory ) continue;
										
										// Если не разрешено редактировать, то берём старое значение поля
										$TypeForm = $this->MfoXfields[ $row[1] ];
									}
										else
									{
										// Если разрешено редактировать
										$TypeForm = $this->$MethodName( $row[1], $row[15], $this->MfoXfields );
										if( empty( $TypeForm ) && $row[10] == 1 && $AllowEdit )
											{
												$this->ErrorSave .= "<li>Поле \"{$name}\" обязательно к заполнению.</li>";
												continue;
											}
									}
								
								// Если разрешён HTML
								if( $row[3] == 1 )
									{
										$AllowedTags = "<pre><h1><h2><h3><h4><h5><h6><b><i><tt><cite><em><strong><font><a><p><br><blockquote><dl><dt><img><hr><ol><li><ul><div><table><tr><td><th>";
										
										// Если разрешены скрипты
										if( $row[4] == 1 ) $AllowedTags .= "<script>";
										$TypeForm = strip_tags( $TypeForm, $AllowedTags );
										
										// Если скрипты запрещены
										if( $row[4] != 1 )
											{
												$NotAllowedOpt = array( "onclick", "onload", "onunload", "onabort", "onerror", "onblur", "onchange", "onfocus", "onreset", "onsubmit", "ondblclick", "onkeydown", "onkeypress", "onkeyup", "onmousedown", "onmouseup", "onmouseover", "onmouseout", "onselect", "javascript" );
														
												foreach( $NotAllowedOpt as $value )
													{
														$TypeForm = preg_replace( "/{$value}(.+?)\"(.+?)\"/i", "", $TypeForm );
														$TypeForm = preg_replace( "/{$value}:(.+?)\"/is", "\"", $TypeForm );
													}
											}
									}
										else
									{
										// Если HTML запрещён
										$TypeForm = htmlspecialchars( $TypeForm, ENT_QUOTES, $config['charset'] );
									}
								
								// Если новые строки заменять на <br />, то временно кодируем перевод строки
								if( $row[5] == 1 ) $TypeForm = str_replace( "\n", "<FieldBr>", $TypeForm );
								
								$TypeForm = $this->FilterText( $TypeForm );
								$return[] = "{$row[1]}={$TypeForm}";
							}
					}
				
				$return = implode( "|||", $return );
			}
			
		return $return;
	}
	
	function ParseTagsType( $TagValue ){
		global $member_id;
		
		$TagValue = explode( "->", $TagValue );
		$id = $this->IndexDB[ $TagValue[0] ];
		$Type = $this->DB[ $id ][12];
		$method_name = "ParseTags_{$Type}";
		
		if( in_array( $Type, $this->AllowType ) && method_exists( $this, $method_name ) )
			{
				if( !in_array( "all", $this->DB[ $id ][7] ) )
					{
						if( !in_array( $member_id['user_group'], $this->DB[ $id ][7] ) )
							{
								return "";
							}
					}
				
				$FieldValue = $this->MfoXfields[ $TagValue[0] ];
				$FieldValue = str_replace( "<FieldBr>", "<br />\n", $FieldValue );
				return $this->$method_name( $TagValue, $FieldValue, $this->DB[ $this->IndexDB[ $TagValue[0] ] ][15] );
			}
		
		return "";
	}
	
	function ParseTagsBlock( $TagValue, $Text, $Type = "show" ){
		
		$TypeReturn = $this->ParseTagsType( $TagValue );
		if( $Type == "show" )
			return $TypeReturn != "" ? str_replace( "\\\"", "\"", $Text ) : "";
		else
			return $TypeReturn != "" ? "" : str_replace( "\\\"", "\"", $Text );
			
	}
	
	function ParseTags( $value, $xfields ){
		
		$this->ExplodeXfields( $xfields , false );
		$value = preg_replace_callback( "#\[Mfofield:(.+?)\](.+?)\[/Mfofield:(.+?)\]#is", function( $matches ){
			return $this->ParseTagsBlock( $matches[1], $matches[2] );
		}, $value );
		$value = preg_replace_callback( "#\[not-Mfofield:(.+?)\](.+?)\[/not-Mfofield:(.+?)\]#is", function( $matches ){
			return $this->ParseTagsBlock( $matches[1], $matches[2], 'block' );
		}, $value );
		$value = preg_replace_callback( "#{Mfofield:(.+?)}#is", function( $matches ){
			return $this->ParseTagsType( $matches[1] );
		}, $value );
		
		return $value;		
	}
	
	function ReturnCategoryJS(){
		
		if( count( $this->CategoryJS ) < 1 ) return;
		
		$return = "";
		$Fields = array();
		$CategoryArray = array();
		foreach( $this->CategoryJS as $Category => $FieldsID )
			{
				if( $Category != "all" ) $CategoryArray[] = $Category;
				$Fields[] = "MfoFields['{$Category}'] = [".implode( ",", $FieldsID )."];"; 
			}
		
		$Fields = implode( "\n", $Fields );
		$Category = implode( ",", $CategoryArray );
		$return = "var MfoFieldsCat = [{$Category}];\nvar MfoFields = new Array();\n{$Fields}";
		return $return;		
	}
	
	
	/*
			--------------------------------------------
	
			Дальше идёт типы полей
			У каждого типа должно быть по 5 функций
	
			--------------------------------------------
	*/
	
	
	
	/*
		//--------------------------------------------------------//
		
			Тип "Маленькое поле"
			
		//--------------------------------------------------------//
	*/
	
	function Form_mini_text(){
		
		$Value = $this->ReturnFieldsValueOnError['field']['mini_text']['value'];
		$Width = $this->ReturnFieldsValueOnError['field']['mini_text']['width'];
		
		if( !$Width ) $Width = 100;
		
return <<<HTML

		<div class="form-group">
			<label class="control-label col-sm-2">Значение по умолчанию:</label>
				<div class="col-sm-10">
					<input type="text" name="field[mini_text][value]" value="{$Value}"  class="form-control width-400 position-left"  />
				</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-2">Ширина:</label>
				<div class="col-sm-10">
					<input type="text" name="field[mini_text][width]" value="{$Width}"  class="form-control width-400 position-left"  />
				</div>
		</div>
		


HTML;

	}
	
	function Filter_mini_text(){
		global $config;
		
		$Value = htmlspecialchars( stripslashes( trim( $_POST['field']['mini_text']['value'] ) ), ENT_QUOTES, $config['charset'] );
		$Width = intval( $_POST['field']['mini_text']['width'] );
		
		return array(
			"value"		=> $Value,
			"width"		=> $Width,
		);
	}
	
	function ShowForm_mini_text( $options, $value = "", $alt_name ){
		global $config;
		
		$width = intval( $options['width'] ) > 0 ? intval( $options['width'] ) : 100;
		$value = htmlspecialchars( stripslashes( $value ), ENT_QUOTES, $config['charset'] );
		if( $this->TypeAdd == "add" )
			{
				if( !isset( $_POST['submit'] ) )
					{
						$value = htmlspecialchars( stripslashes( $options['value'] ), ENT_QUOTES, $config['charset'] );
					}
						else
					{
						$value = htmlspecialchars( stripslashes( $_POST['field'][ $alt_name ] ), ENT_QUOTES, $config['charset'] );
					}
			}
		
		return "<input type=\"text\" name=\"field[{$alt_name}]\" value=\"{$value}\" class=\"Mfofield Mfofield-{$alt_name} form-control\" style=\"width: {$width}px;\" />";
		
	}
	
	function SaveForm_mini_text( $alt_name, $options, $xfields ){
		
		$Value = stripslashes( $_POST['field'][ $alt_name ] );
		return $Value;
		
	}
	
	function ParseTags_mini_text( $Tags, $value, $FieldOpt ){
		return $value;
	}
	
	/*
		//--------------------------------------------------------//
		
			Тип "Большое поле"
			
		//--------------------------------------------------------//
	*/
	
	function Form_text(){
		
		$Value = $this->ReturnFieldsValueOnError['field']['text']['value'];
		$Width = $this->ReturnFieldsValueOnError['field']['text']['width'];
		$Height = $this->ReturnFieldsValueOnError['field']['text']['height'];
		
		if( !$Width ) $Width = "400";
		if( !$Height ) $Height = "100";
		
return <<<HTML



		<div class="form-group">
			<label class="control-label col-sm-2">Значение по умолчанию:</label>
				<div class="col-sm-10">
					<input type="text" name="field[mini_text][value]" value="{$Value}"  class="form-control width-400 position-left"  />
				</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-2">Ширина:</label>
				<div class="col-sm-10">
					<input type="text" name="field[mini_text][width]" value="{$Width}"  class="form-control width-400 position-left"  />
				</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-2">Высота:</label>
				<div class="col-sm-10">
					<input type="text" name="field[text][height]" value="{$Height}"  class="form-control width-400 position-left"  />
				</div>
		</div>


HTML;

	}
	
	function Filter_text(){
		global $config;
		
		$Value = htmlspecialchars( stripslashes( trim( $_POST['field']['text']['value'] ) ), ENT_QUOTES, $config['charset'] );
		$Width = intval( $_POST['field']['text']['width'] );
		$Height = intval( $_POST['field']['text']['height'] );
		
		return array(
			"value"		=> $Value,
			"width"		=> $Width,
			"height"	=> $Height,
		);
	}
	
	function ShowForm_text( $options, $value = "", $alt_name ){
		global $config;
		
		$width = intval( $options['width'] ) > 0 ? intval( $options['width'] ) : 100;
		$height = intval( $options['height'] ) > 0 ? intval( $options['height'] ) : 100;
		$value = stripslashes( $value );
		
		if( $this->TypeAdd == "add" )
			{
				if( !isset( $_POST['submit'] ) )
					{
						$value = stripslashes( $options['value'] );
					}
						else
					{
						$value = htmlspecialchars( stripslashes( $_POST['field'][ $alt_name ] ), ENT_QUOTES, $config['charset'] );
					}
			}
		
		return "<textarea name=\"field[{$alt_name}]\" class=\"Mfofield  Mfofield-{$alt_name}\" style=\"width: 600px; height: 200px;\">{$value}</textarea>";
		
	}
	
	function SaveForm_text( $alt_name, $options, $xfields ){
		
		$Value = stripslashes( $_POST['field'][ $alt_name ] );
		return $Value;
		
	}
	
	function ParseTags_text( $Tags, $value, $FieldOpt ){
		return $value;
	}
	
	/*
		//--------------------------------------------------------//
		
			Тип "Список"
			
		//--------------------------------------------------------//
	*/
	
	function Form_select(){
		
		$Value = $this->ReturnFieldsValueOnError['field']['select']['value'];
		$MultipleChecked = $this->ReturnFieldsValueOnError['field']['select']['multiple'] == 1 ? "checked=\"checked\"" : "";
		$Width = intval( $this->ReturnFieldsValueOnError['field']['select']['width'] );
		$Height = intval( $this->ReturnFieldsValueOnError['field']['select']['height'] );
		
		if( !$Width ) $Width = 200;
		if( !$Height ) $Height = 60;
		
return <<<HTML


		<div class="form-group">
			<label class="control-label col-sm-2">Список возможных значений: *</label>
				<div class="col-sm-10">
					<textarea name="field[select][value]" style="width: 70%; height: 100px;">{$Value}</textarea>
				</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-2">Ширина:</label>
				<div class="col-sm-10">
					<input type="text" name="field[select][width]" value="{$Width}"  class="form-control width-400 position-left"  />
				</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-2">Высота:</label>
				<div class="col-sm-10">
					<input type="text" name="field[select][height]" value="{$Height}"  class="form-control width-400 position-left"  />
				</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-2">Настройка</label>
				<div class="col-sm-10">
					<input type="checkbox" name="field[select][multiple]" value="1" id="allow_multiple_select" {$MultipleChecked} />
					<label for="allow_multiple_select">Разрешить множественный выбор</label>
				</div>
		</div>


HTML;

	}
	
	function Filter_select(){
		global $config;
		
		$Value = htmlspecialchars( stripslashes( trim( $_POST['field']['select']['value'] ) ), ENT_QUOTES, $config['charset'] );
		$Multiple = intval( $_POST['field']['select']['multiple'] );
		$Width = intval( $_POST['field']['select']['width'] );
		$Height = intval( $_POST['field']['select']['height'] );
		if( !$Value ) $this->OkAdd .= "<li>Введите как минимум одно значение списка</li>";
		
		return array(
			"value"		=> $Value,
			"multiple"	=> $Multiple,
			"width"		=> $Width,
			"height"	=> $Height,
		);
	}
	
	function ShowForm_select( $options, $value = "", $alt_name ){
		
		$return = "";
		$Style = "";
		$Multiple = $options['multiple'] == 1 ? "multiple=\"multiple\"" : "";
		$AllowArray = $options['multiple'] == 1 ? "[]" : "";
		$Width = intval( $options['width'] ) > 0 ? intval( $options['width'] ) : 200;
		$Height = intval( $options['height'] ) > 0 ? intval( $options['height'] ) : 60;
		
		$Style .= "width: {$Width}px; height: {$Height}px;";
		
		if( $options['multiple'] == 1 ) $value = explode( ",", $value );
		$options['value'] = str_replace( "\r", "", $options['value'] );
		
		if( $this->TypeAdd == "add" )
			{
				if( isset( $_POST['submit'] ) )
					{
						if( $options['multiple'] == 1 )
							{
								$value = $_POST['field'][ $alt_name ];
								if( !is_array( $value ) ) $value = array();
							}
								else
							{
								$value = intval( $_POST['field'][ $alt_name ] );
							}
					}
			}
		
		$Explode = explode( "\n", $options['value'] );
		foreach( $Explode as $i => $List )
			{
				$i = $i + 1;
				if( $options['multiple'] == 1 )
					$selected = ( in_array( $i, $value ) && $value != "" ) ? "selected=\"selected\"" : "";
				else
					$selected = ( $value == $i && $value != "" ) ? "selected=\"selected\"" : "";
				$return .= "<option value=\"{$i}\" {$selected}>{$List}</option>";
			}
			
		$return = "<select name=\"field[{$alt_name}]{$AllowArray}\" class=\"Mfofield Mfofield-{$alt_name}\" style=\"{$Style}\" {$Multiple}>{$return}</select>";
		return $return;
	}
	
	function SaveForm_select( $alt_name, $options, $xfields ){
		
		if( $options['multiple'] == 1 )
			{
				if( is_array( $_POST['field'][ $alt_name ] ) )
					{
						foreach( $_POST['field'][ $alt_name ] as $key => $replace )
							{
								$replace = intval( $replace );
								if( $replace )
									$_POST['field'][ $alt_name ][ $key ] = $replace;
								else
									unset( $_POST['field'][ $alt_name ][ $key ] );
							}
						
						$Value = implode( ",", $_POST['field'][ $alt_name ] );
					}
						else
					{
						$Value = "";
					}
			}
				else
			{
				$Value = intval( $_POST['field'][ $alt_name ] );
			}
		
		return $Value;
	}
	
	function ParseTags_select( $Tags, $value, $FieldOpt ){
		
		$Explode = array();
		$NewExplode = explode( "\n", $FieldOpt['value'] );
		foreach( $NewExplode as $key => $ToExplode ) $Explode[ ( $key + 1 ) ] = $ToExplode;
		$value = explode( ",", $value );
		
		if( $Tags[1] != "" )
			{
				unset( $Tags[0] );
				foreach( $Tags as $Serach )
					{
						$stop = true;
						foreach( $value as $figure )
							{
								if( in_array( $figure, $Tags ) ) $stop = false;
							}
							
						if( $stop === false )
							{
								foreach( $value as $key => $figure ) $value[ $key ] = $Explode[ $figure ];
								$value = implode( ", ", $value );
								return $value;
							}
					}
				
				return "";
			}
		
		foreach( $value as $key => $figure ) $value[ $key ] = $Explode[ $figure ];
		$value = implode( ", ", $value );
		return $value;
	}
	
	/*
		//--------------------------------------------------------//
		
			Тип "Радио кнопки"
			
		//--------------------------------------------------------//
	*/
	
	function Form_radio(){
		
		$Value = $this->ReturnFieldsValueOnError['field']['radio']['value'];
		$Show = SelectList( array(
			""		=> "В одну строчку",
			"li"	=> "Каждое значение с новой строчки &lt;li&gt;",
			"br"	=> "Каждое значение с новой строчки &lt;br /&gt;",
		), $this->ReturnFieldsValueOnError['field']['radio']['show'] );
		
return <<<HTML

		

		<div class="form-group">
			<label class="control-label col-sm-2">Список возможных значений: *</label>
				<div class="col-sm-10">
					<textarea name="field[radio][value]" style="width: 70%; height: 100px;">{$Value}</textarea>
				</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-2">Способ вывода:</label>
				<div class="col-sm-10">
					<select name="field[radio][show]">
						{$Show}
					</select>
				</div>
		</div>


HTML;

	}
	
	function Filter_radio(){
		global $config;
		
		$Value = htmlspecialchars( stripslashes( trim( $_POST['field']['radio']['value'] ) ), ENT_QUOTES, $config['charset'] );
		$Show = $_POST['field']['radio']['show'];
		if( $Show != "br" && $Show != "li" ) $Show = "";
		if( !$Value ) $this->OkAdd .= "<li>Введите как минимум одно значение списка</li>";
		
		return array(
			"value"		=> $Value,
			"show"		=> $Show,
		);
	}
	
	function ShowForm_radio( $options, $value = "", $alt_name ){
					
		switch( $options['show'] ){
			
			case "br":
				$template = "{value}<br />";
				$MainTeplate = "<span class=\"Mfofield-radio Mfofield-radio-{$alt_name}\">{content}</span>";
				break;
				
			case "li":
				$template = "<li>{value}</li>";
				$MainTeplate = "<ul class=\"Mfofield-radio Mfofield-radio-{$alt_name}\">{content}</ul>";
				break;
				
			default:
				$template = "{value} ";
				$MainTeplate = "<span class=\"Mfofield-radio Mfofield-radio-{$alt_name}\">{content}</span>";
				break;
		}
		
		$return = "";
		$options['value'] = str_replace( "\r", "", $options['value'] );
		$Explode = explode( "\n", $options['value'] );
		
		if( $this->TypeAdd == "add" )
			{
				if( isset( $_POST['submit'] ) )
					{
						$value = intval( $_POST['field'][ $alt_name ] );
					}
			}
		
		foreach( $Explode as $i => $List )
			{
				$i = $i + 1;
				$ForReturn = "";
				$checked = ( $value == $i && $value != "" ) ? "checked=\"checked\"" : "";
				$ForReturn = "<input type=\"radio\" name=\"field[{$alt_name}]\" id=\"field_{$alt_name}_{$i}\" value=\"{$i}\" {$checked} /> <label for=\"field_{$alt_name}_{$i}\">{$List}</label>";
				$return .= str_replace( "{value}", $ForReturn, $template );
			}
			
		$return = str_replace( "{content}", $return, $MainTeplate );
		return $return;
		
	}
	
	function SaveForm_radio( $alt_name, $options, $xfields ){
		
		$Value = intval( $_POST['field'][ $alt_name ] );
		return $Value;
		
	}
	
	function ParseTags_radio( $Tags, $value, $FieldOpt ){
		
		$Explode = array();
		$NewExplode = explode( "\n", $FieldOpt['value'] );
		foreach( $NewExplode as $key => $ToExplode ) $Explode[ ( $key + 1 ) ] = $ToExplode;
		if( $Tags[1] != "" )
			{
				unset( $Tags[0] );
				foreach( $Tags as $Serach )
					{
						if( in_array( $value, $Tags ) ) return $Explode[ $value ];
					}
				
				return "";
			}
			
		return $Explode[ $value ];
	}
	
	/*
		//--------------------------------------------------------//
		
			Тип "Чекбоксы"
			
		//--------------------------------------------------------//
	*/
	
	function Form_checkbox(){
		
		$Value = $this->ReturnFieldsValueOnError['field']['checkbox']['value'];
		$Show = SelectList( array(
			""		=> "В одну строчку",
			"li"	=> "Каждое значение с новой строчки &lt;li&gt;",
			"br"	=> "Каждое значение с новой строчки &lt;br /&gt;",
		), $this->ReturnFieldsValueOnError['field']['checkbox']['show'] );
		
return <<<HTML



		<div class="form-group">
			<label class="control-label col-sm-2">Список возможных значений:*</label>
				<div class="col-sm-10">
					<textarea name="field[checkbox][value]" style="width: 70%; height: 100px;">{$Value}</textarea>
				</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-2">Способ вывода:</label>
				<div class="col-sm-10">
					<select name="field[checkbox][show]">
						{$Show}
					</select>
				</div>
		</div>
		
		

HTML;

	}
	
	function Filter_checkbox(){
		global $config;
		
		$Value = htmlspecialchars( stripslashes( trim( $_POST['field']['checkbox']['value'] ) ), ENT_QUOTES, $config['charset'] );
		$Show = $_POST['field']['checkbox']['show'];
		if( $Show != "br" && $Show != "li" ) $Show = "";
		if( !$Value ) $this->OkAdd .= "<li>Введите как минимум одно значение списка</li>";
		
		return array(
			"value"		=> $Value,
			"show"		=> $Show,
		);
	}
	
	function ShowForm_checkbox( $options, $value = "", $alt_name ){
					
		switch( $options['show'] ){
			
			case "br":
				$template = "{value}<br />";
				$MainTeplate = "<span class=\"Mfofield-checkbox Mfofield-checkbox-{$alt_name}\">{content}</span>";
				break;
				
			case "li":
				$template = "<li>{value}</li>";
				$MainTeplate = "<ul class=\"Mfofield-checkbox Mfofield-checkbox-{$alt_name}\">{content}</ul>";
				break;
				
			default:
				$template = "{value} ";
				$MainTeplate = "<span class=\"Mfofield-checkbox Mfofield-checkbox-{$alt_name}\">{content}</span>";
				break;
		}
		
		$return = "";
		$value = explode( ",", $value );
		foreach( $value as $key => $search )
			{
				if( $search == "" ) unset( $value[ $key ] );
			}
			
		if( $this->TypeAdd == "add" )
			{
				if( isset( $_POST['submit'] ) )
					{
						$value = $_POST['field'][ $alt_name ];
						if( !is_array( $value ) ) $value = array();
					}
			}
			
		$options['value'] = str_replace( "\r", "", $options['value'] );
		$Explode = explode( "\n", $options['value'] );
		foreach( $Explode as $i => $List )
			{
				$i = $i + 1;
				$ForReturn = "";
				$checked = ( in_array( $i, $value ) && $value[0] != "" ) ? "checked=\"checked\"" : "";
				$ForReturn = "<input type=\"checkbox\" name=\"field[{$alt_name}][]\" id=\"field_{$alt_name}_{$i}\" value=\"{$i}\" {$checked} /> <label for=\"field_{$alt_name}_{$i}\">{$List}</label>";
				$return .= str_replace( "{value}", $ForReturn, $template );
			}
			
		$return = str_replace( "{content}", $return, $MainTeplate );
		return $return;
		
	}
	
	function SaveForm_checkbox( $alt_name, $options, $xfields ){
		
		if( is_array( $_POST['field'][ $alt_name ] ) )
			{
				foreach( $_POST['field'][ $alt_name ] as $key => $replace )
					{
						$replace = intval( $replace );
						$_POST['field'][ $alt_name ][ $key ] = $replace;
					}
					
				$Value = implode( ",", $_POST['field'][ $alt_name ] );
			}
				else
			{
				$Value = "";
			}
			
		return $Value;
	}
	
	function ParseTags_checkbox( $Tags, $value, $FieldOpt ){
		
		$Explode = array();
		$NewExplode = explode( "\n", $FieldOpt['value'] );
		foreach( $NewExplode as $key => $ToExplode ) $Explode[ ( $key + 1 ) ] = $ToExplode;
		$value = explode( ",", $value );
		
		if( $Tags[1] != "" )
			{
				unset( $Tags[0] );
				foreach( $Tags as $Serach )
					{
						$stop = true;
						foreach( $value as $figure )
							{
								if( in_array( $figure, $Tags ) ) $stop = false;
							}
							
						if( $stop === false )
							{
								foreach( $value as $key => $figure ) $value[ $key ] = $Explode[ $figure ];
								$value = implode( ", ", $value );
								return $value;
							}
					}
				
				return "";
			}
		
		foreach( $value as $key => $figure ) $value[ $key ] = $Explode[ $figure ];
		$value = implode( ", ", $value );
		return $value;
	}
	
	/*
		//--------------------------------------------------------//
		
			Тип "Картинки"
			
		//--------------------------------------------------------//
	*/
	
	function Form_img(){
		global $config;
		
		$allow_type = htmlspecialchars( $this->ReturnFieldsValueOnError['field']['img']['allow_type'], ENT_QUOTES, $config['charset'] );
		$width = intval( $this->ReturnFieldsValueOnError['field']['img']['width'] );
		$height = intval( $this->ReturnFieldsValueOnError['field']['img']['height'] );
		$max_size = intval( $this->ReturnFieldsValueOnError['field']['img']['max_size'] );
		$quality = intval( $this->ReturnFieldsValueOnError['field']['img']['quality'] );
		$sizekb = intval( $this->ReturnFieldsValueOnError['field']['img']['sizekb'] );
		$folder = htmlspecialchars( str_replace( "../", "", trim( $this->ReturnFieldsValueOnError['field']['img']['folder'] ) ), ENT_QUOTES, $config['charset'] );
		$HighslideChecked = $this->ReturnFieldsValueOnError['field']['img']['highslide'] == 1 ? "checked=\"checked\"" : "";
		$Resize = SelectList( array(
			"0"		=> "По максимальной стороне",
			"1"		=> "По ширине",
			"2"		=> "По высоте",
		), $this->ReturnFieldsValueOnError['field']['img']['resize'] );
		
		if( !$max_size && !$width && !$height ) $max_size = 150;
		if( !$quality ) $quality = 85;
		if( !$allow_type ) $allow_type = "gif, png, jpeg, jpg";
		if( !$sizekb ) $sizekb = 100;
		
return <<<HTML

		<div class="form-group">
			<label class="control-label col-sm-2">Разрешённые типы: *</label>
				<div class="col-sm-10">
					<input type="text" name="field[img][allow_type]"  value="{$allow_type}" class="form-control width-400 position-left"/>
				</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-2">Ширина и высота: *</label>
				<div class="col-sm-10">
					<input type="text" size="5" name="field[img][width]" value="{$width}" class="form-control width-400 position-left"/>
					<input type="text" size="5" name="field[img][height]" value="{$height}" class="form-control width-400 position-left"/>
				</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-2">Или сжать по:</label>
				<div class="col-sm-10">
					<input type="text" size="5" name="field[img][max_size]" value="{$max_size}" class="form-control width-400 position-left"/>
					<select name="field[img][resize]">
						{$Resize}
					</select>
				</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-2">Папка для сохранения: *</label>
				<div class="col-sm-10">
					<input type="text" name="field[img][folder]" value="{$folder}" class="form-control width-400 position-left"/>
				</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-2">Максимальный вес: *</label>
				<div class="col-sm-10">
					<input type="text" size="5" name="field[img][sizekb]" value="{$sizekb}" class="form-control width-400 position-left"/>
				</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-2">Качество сжатия .jpg:</label>
				<div class="col-sm-10">
					<input type="text" size="5" name="field[img][quality]" value="{$quality}" class="form-control width-400 position-left"/>
				</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-2">Настройки</label>
				<div class="col-sm-10">
					<input type="checkbox" name="field[img][highslide]" value="1" id="img_highslide" {$HighslideChecked} />
					<label for="img_highslide">Увеличивать при нажатии</label>
				</div>
		</div>

				

HTML;

	}
	
	function Filter_img(){
		global $config;
			
		$allow_type = htmlspecialchars( stripslashes( trim( $_POST['field']['img']['allow_type'] ) ), ENT_QUOTES, $config['charset'] );
		$width = intval( $_POST['field']['img']['width'] );
		$height = intval( $_POST['field']['img']['height'] );
		$max_size = intval( $_POST['field']['img']['max_size'] );
		$quality = intval( $_POST['field']['img']['quality'] );
		$Resize = intval( $_POST['field']['img']['resize'] );
		$sizekb = intval( $_POST['field']['img']['sizekb'] );
		$folder = htmlspecialchars( str_replace( "../", "", trim( $_POST['field']['img']['folder'] ) ), ENT_QUOTES, $config['charset'] );
		$highslide = intval( $_POST['field']['img']['highslide'] );
		
		if( !$max_size && ( !$width || !$height ) ) $this->OkAdd .= "<li>Ширина или высота не может равняться 0</li>";			
		if( !$allow_type ) $this->OkAdd .= "<li>Введите как минимум один разрешённый тип картинки</li>";
		if( !$sizekb ) $this->OkAdd .= "<li>Введите максимальный вес картинки</li>";
		if( !$folder )
			{
				$this->OkAdd .= "<li>Введите папку для загрузки картинки</li>";
			}
				else
			{
				if( !preg_match( "/^([A-Za-z0-9\.\_\/]+)$/", $folder ) ) $this->OkAdd .= "<li>Не верный адрес папки</li>";
			}
			
		return array(
			"allow_type"	=> $allow_type,
			"width"			=> $width,
			"height"		=> $height,
			"max_size"		=> $max_size,
			"quality"		=> $quality,
			"resize"		=> $Resize,
			"folder"		=> $folder,
			"sizekb"		=> $sizekb,
			"highslide"		=> $highslide,
		);
	}
	
	function ShowForm_img( $options, $value = "", $alt_name ){
		
		$allReadyUpload = $value != "" ? "<span style=\"color: #666;\">(Загружена: <a href=\"/uploads/{$options['folder']}/{$value}\" target=\"_blank\">{$value}</a>)</span>" : "";
		$return = <<<HTML

<span class="Mfofield-file Mfofield-file-{$alt_name}">
	<input type="file" name="field[{$alt_name}]" id="field_file_{{$alt_name}}" />

HTML;
		
		if( $this->TypeAdd == "add" )
			$return .= "</span>";
		else
			$return .= <<<HTML
	
	<input type="checkbox" name="field[{$alt_name}_check]" id="field_filecheck_{{$alt_name}}" value="1" onclick="if( this.checked === true ) document.getElementById( 'field_file_{{$alt_name}}' ).disabled = true; else document.getElementById( 'field_file_{{$alt_name}}' ).disabled = false;" />
	<label for="field_filecheck_{{$alt_name}}">Удалить</label>
	{$allReadyUpload}
</span>

HTML;
		
		return $return;		
	}
	
	function SaveForm_img( $alt_name, $options, $xfields ){
		
		$oldPhoto = $xfields[ $alt_name ];
		$delPhoto = intval( $_POST['field']["{$alt_name}_check"] );
		$folder = $options['folder'];
		if( !is_dir( ROOT_DIR."/uploads/{$folder}/" ) )
			{
				if( preg_match( "/\//i", $folder ) )
					{
						$MkDir = ROOT_DIR."/uploads/";
						$MkFolder = explode( "/", $folder );
						foreach( $MkFolder as $thisDir )
							{
								@mkdir( "{$MkDir}/{$thisDir}", 0777 );	
								$MkDir .= "/{$thisDir}";
							}
					}
						else
					{
						@mkdir( ROOT_DIR."/uploads/{$folder}", 0777 );
					} 
			}
		
		if( !is_dir( ROOT_DIR."/uploads/{$folder}/thumbs/" ) ) @mkdir( ROOT_DIR."/uploads/{$folder}/thumbs", 0777 );
		
		if( $delPhoto == 1 )
			{
				if( $oldPhoto )
					{
						@unlink( ROOT_DIR."/uploads/{$folder}/{$oldPhoto}" );
						@unlink( ROOT_DIR."/uploads/{$folder}/thumbs/{$oldPhoto}" );
					}
					
				return "";
			}
				else
			{
				if( $_FILES['field']['name'][ $alt_name ] )
					{							
						$image_upload = $_FILES['field']['tmp_name'][ $alt_name ];
						$image_name = explode( ".", $_FILES['field']['name'][ $alt_name ] );
						$image_size = intval( $_FILES['field']['size'][ $alt_name ] );
						$image_type = end( explode( ".", $_FILES['field']['name'][ $alt_name ] ) );
						
						$sizekb = $options['sizekb'] * 1024;
						$imagekb = intval( $image_size / 1024 );
						
						if( $image_size <= $sizekb )
							{
								$AllowType = explode( ",", $options['allow_type'] );
								foreach( $AllowType as $key => $Type ) $AllowType[ $key ] = trim( $Type );
								if( in_array( strtolower( $image_type ), $AllowType ) )
									{
										$Prefix = time() + rand( 1, 300 );
										$image_name = $Prefix."_".$image_name[0].".".strtolower( $image_type );
										
										$FileUpload = ROOT_DIR."/uploads/{$folder}/{$image_name}";
										$FileThubms = $options['highslide'] == 1 ? ROOT_DIR."/uploads/{$folder}/thumbs/{$image_name}" : $FileUpload;								
										
										if( is_uploaded_file( $image_upload ) )
											{
												require_once( ENGINE_DIR."/inc/mfo/makethumb.php" );
												$res = @move_uploaded_file( $image_upload, $FileUpload );
												if( $res ) 
													{
														// Удаление старой фотки
														if( $oldPhoto )
															{
																@unlink( ROOT_DIR."/uploads/{$folder}/{$oldPhoto}" );
																@unlink( ROOT_DIR."/uploads/{$folder}/thumbs/{$oldPhoto}" );
															}
															
														$width = $options['width'] > 0 ? intval( $options['width'] ) : 150;
														$height = $options['height'] > 0 ? intval( $options['height'] ) : 150;
														$max_size = intval( $options['max_size'] );
														$quality = $options['max_size'] > 0 ? intval( $options['max_size'] ) : 80;
														$resize = intval( $options['resize'] );
														
														if( !$max_size )
															$thumb_size = "{$width}x{$height}";
														else
															$thumb_size = $max_size;
														
														$thumb = new thumbnail( $FileUpload );														
														$thumb->size_auto( $thumb_size, $resize );	
														$thumb->jpeg_quality( $quality );
														$thumb->save( $FileThubms );
														
														return $image_name;
													}
														else
													{ 
														$this->ErrorSave .= "<li>Невозможно загрузить изображение</li>";
													}
												
											}
												else
											{
												$this->ErrorSave .= "<li>Невозможно загрузить изображение</li>";
											}
									}
										else
									{
										$this->ErrorSave .= "<li>Разрешённые типы для загрузки изображений: {$options['allow_type']}</li>";
									}
							}
								else
							{
								$this->ErrorSave .= "<li>Максимальный размер фотографии {$options['sizekb']}KB, ваша картинка весит {$imagekb}KB.</li>";
							}
					}
						else
					{
						return $xfields[ $alt_name ];
					}
			}
		
		return "";
	}	
	
	function ParseTags_img( $Tags, $value, $FieldOpt ){
		
		if( !$value ) return "";
		
		$host = $_SERVER['HTTP_HOST'];
		$folder = $FieldOpt['folder'];
		if( $Tags[1] == "name" ) return "{$value}";
		
		if( $FieldOpt['highslide'] == 1 && file_exists( ROOT_DIR."/uploads/{$folder}/thumbs/{$value}" ) )
			{
				if( $Tags[1] == "link" ) return "http://{$host}/uploads/{$folder}/thumbs/{$value}";
				$value = "<a href=\"http://{$host}/uploads/{$folder}/{$value}\" onclick=\"return hs.expand(this)\"><img src=\"http://{$host}/uploads/{$folder}/thumbs/{$value}\" title=\"Увеличить картинку\" alt=\"\" border=\"0\" /></a>";
			}
				else
			{
				if( $Tags[1] == "link" ) return "http://{$host}/uploads/{$folder}/{$value}";
				$value = "<img src=\"http://{$host}/uploads/{$folder}/{$value}\" title=\"\" alt=\"\" border=\"0\" />";
			}
			
		return $value;
	}
}

function MfoSortField( $a, $b ) {
	if( $a[11] == $b[11] ) return 0;
	return( $a[11] > $b[11] ) ? 1 : -1;
}

?>