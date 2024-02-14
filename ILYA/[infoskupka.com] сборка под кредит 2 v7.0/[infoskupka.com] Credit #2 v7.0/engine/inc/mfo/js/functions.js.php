<?php


if( !defined( "DATALIFEENGINE" ) ) die( "Hacking attempt!" );

if( version_compare( $config['version_id'], "8.3", ">" ) )
	$JSCat = "/engine/classes/js";
else
	$JSCat = "/engine/ajax";

function EchoAJAX( $Jquery = false ){
	global $JSCat;
		
return <<<HTML
{$return}
<script language="javascript" type="text/javascript">
	
	function ajaxMfo( resultID, fileUrl, dataUrl, statusID, imgUrl, endImgHtml, endFunction ){
		
		if( !statusID ) statusID = "";
		if( !imgUrl ) imgUrl = "status.gif";
		if( statusID != "" ) $( "#" + statusID ).html( "<img src=\"engine/inc/mfo/style/images/" + imgUrl + "\" border=\"0\" alt=\"Загрузка\" align=\"absmiddle\" />" );
		
		$.ajax({
			url: fileUrl,
			data: dataUrl,
			success: function( data ){
				if( endFunction != null ) return endFunction( data, statusID, resultID );
				$( "#" + resultID ).html( data );
				if( statusID != resultID )
					{
						var resultImg = endImgHtml != null ? endImgHtml : "";
						$( "#" + statusID ).html( endImgHtml );
					}
				
				$( "[data-rel=calendar]" ).datetimepicker({
					format: "Y-m-d H:i:s",
					step: 30,
					closeOnDateSelect: true,
					dayOfWeekStart: 1,
					i18n: cal_language
				});
			},
			dataType: "html",
			type: "POST"
		});
	}
	
	if( !UpdateUrl ) var UpdateUrl = "mainmfo";
	var UpdateButton = "<img src=\"engine/inc/mfo/style/images/ajax.png\" alt=\"Обновить\" title=\"Обновить\" style=\"cursor: pointer;\" onclick=\"UpdateList(); return false;\" border=\"0\" />";
	function UpdateList( url, otherData, result, preloder ){
		
		if( !url ) url = UpdateUrl;
		if( url == "mainmfo" && !otherData ) otherData = UpdateUrlMainData;
		if( preloder )
			{
				document.getElementById( preloder ).innerHTML = "<div style=\"padding: 30px; text-align: center;\"><img src=\"engine/inc/mfo/style/images/ajax_preloader.gif\" alt=\"Загрузка\" border=\"0\" /></div>";
			}
		
		document.getElementById( "UpdateStatus" ).innerHTML = "<img src=\"engine/inc/mfo/style/images/ajax.gif\" alt=\"Загрузка\" border=\"0\" />";
		
		var idEcho = ( result ) ? result : url;
		ajaxMfo( idEcho, "/engine/ajax/mfo/admin/list.update.php", otherData + "&action=" + url, "UpdateStatus", "ajax.gif", "", function( data, statusID, resultID ){
			$( "#" + resultID ).html( data );
			document.getElementById( "UpdateStatus" ).innerHTML = "<img src=\"engine/inc/mfo/style/images/ajax.png\" alt=\"Обновить\" title=\"Обновить\" style=\"cursor: pointer;\" onclick=\"UpdateList(); return false;\" border=\"0\" />";
			
			$( "[data-rel=calendar]" ).datetimepicker({
				format: "Y-m-d H:i:s",
				step: 30,
				closeOnDateSelect: true,
				dayOfWeekStart: 1,
				i18n: cal_language
			});
		} );
	}
	
	function CleareCache(){
		
		document.getElementById( "cache_btn" ).value = "Очистить кэш...";
		$.ajax({
			url: "/engine/ajax/mfo/admin/other.options.php",
			data: "type=clear_cache",
			success: function( data ){
				document.getElementById( "cache_btn" ).value = "Очистить кэш (очищен)";
			},
			dataType: "html",
			type: "POST"
		});
		
	}
	
	function EmptyAlbum(){
		
		var title = document.getElementById( "new_album_name" ).value;
		var alt_name = document.getElementById( "new_album_alt_name" ).value;
		
		if( !title && !alt_name )
			{
				document.getElementById( "btn_empty_album" ).value = "Введите название";
				setTimeout( function(){
					document.getElementById( "btn_empty_album" ).value = "Проверить свободность";				 
				}, 1000 );
				return false;
			}
		
		var Album = ( !alt_name ) ? title : alt_name;
				
		$.ajax({
			url: "/engine/ajax/mfo/admin/other.options.php",
			data: "album=" + Album + "&type=empty_album",
			success: function( data ){
				$( "#empty_status" ).html( data );
			},
			dataType: "html",
			type: "POST"
		});
	}
	
	function SetStatusAlbum( type, id ){
		
		document.getElementById( "album_status_" + id ).innerHTML = "<img src=\"engine/inc/mfo/style/images/mini-ajax.gif\" alt=\"Загрузка\" border=\"0\" />";
		
		$.ajax({
			url: "/engine/ajax/mfo/admin/other.options.php",
			data: "album_id=" + id + "&type=status_album&status=" + type,
			success: function( data ){
				$( "#album_status_" + id ).html( data );
			},
			dataType: "html",
			type: "POST"
		});
	}
	
	function DelAlbum( id ){
		
		var Quest = confirm( "Вы уверены, что хотите удалить данный альбом со всеми его фотографиями?" );
		if( Quest )
			{
				document.getElementById( "DelAlbum_" + id ).innerHTML = "<img src=\"engine/inc/mfo/style/images/ajax_preloader.gif\" alt=\"Удаление\" border=\"0\" />";
								
				$.ajax({
					url: "/engine/ajax/mfo/admin/other.options.php",
					data: "album_id=" + id + "&type=del_album",
					success: function( data ){
						$( "#DelAlbum_" + id ).html( data );
					},
					dataType: "html",
					type: "POST"
				});
			}
	}
		
	function SetFormSubmit( nameForm ){
		
		if( document.getElementById( "action_" + nameForm ).value == "" )
			{
				document.getElementById( "status_" + nameForm ).innerHTML = "<span style=\"color: #F00; font-weight: bold; text-decoration: blink;\">Выберите действие!</span>";
				setTimeout( function(){
					document.getElementById(  "status_" + nameForm ).innerHTML = "";				 
				}, 2000 );
			}
				else
			{
				if( document.getElementById( "action_" + nameForm ).value == "sort" )
					formSubmit( nameForm, "action.php", "status_" + nameForm, "status.gif", "status_" + nameForm, "UpdateStatus", UpdateButton );
				else
					formSubmit( nameForm, "action.php", nameForm, "status.gif", "status_" + nameForm, "UpdateStatus", UpdateButton );
			}
	}
	
	function formSubmit( nameForm, file, IdResult, img, imgId, onCompletion, onCompletionValue ){		
		
		if( !IdResult ) IdResult = "MassEdit";
		if( !img ) img = "ajax.gif";
		if( !imgId ) imgId = "MassEditLink";
		if( !file ) file = "massaction.php";
		
		var Url = "";
		var formSend = document.forms[ nameForm ];
		
		document.getElementById( imgId ).innerHTML = "<img src=\"engine/inc/mfo/style/images/" + img + "\" border=\"0\" alt=\"Загрузка\" />";
		
		for( var i=0; i < formSend.elements.length; i++ )
			{
				var radio = false;
				var ElementForm = formSend.elements[i];
				switch( ElementForm.type )
					{
						case "checkbox": {
							if( ElementForm.checked == true )
								{
									Url += "&" + ElementForm.name + "=" + ElementForm.value;
								}
							break
						}
						
						case "select-multiple": {
							for( var imultiple=0; imultiple < ElementForm.options.length; imultiple++ )
								{
									if ( ElementForm.options[imultiple].selected)
										{
											Url += "&" + ElementForm.name + "=" + ElementForm.options[imultiple].value;
										}
								}
							break
						}
						
						case "radio": {
							var radioObj = formSend[ ElementForm.name ];
							for( var imultiple=0; imultiple < radioObj.length; imultiple++ )
								{
									if ( radioObj[imultiple].checked == true )
										{
											Url += "&" + ElementForm.name + "=" + radioObj[imultiple].value;
											radio = true;
										}
								}
								
							// if( !radio ){ ajax.setVar( ElementForm.name, ajax.encodeVAR( ElementForm.value ) ); }
							break
						}
						
						case "hidden": {
							Url += "&" + ElementForm.name + "=" + ElementForm.value;
							break
						}
						
						case "text": {
							Url += "&" + ElementForm.name + "=" + ElementForm.value;
							break
						}
						
						default: {
							Url += "&" + ElementForm.name + "=" + ElementForm.value;
							break
						}
					}
			}
		
		$.ajax({
			url: "/engine/ajax/mfo/admin/" + file,
			data: Url,
			success: function( data ){
				$( "#" + IdResult ).html( data );
				if( onCompletion != null )
					{
						if( document.getElementById( onCompletion ) != null )
							{
								if( !onCompletionValue ) onCompletionValue = "";
								document.getElementById( onCompletion ).innerHTML = onCompletionValue;
							}
					}
				
				$( "[data-rel=calendar]" ).datetimepicker({
					format: "Y-m-d H:i:s",
					step: 30,
					closeOnDateSelect: true,
					dayOfWeekStart: 1,
					i18n: cal_language
				});
			},
			dataType: "html",
			type: "POST"
		});
	}
	
	function getDocumentHeight(){
		return ( document.body.scrollHeight > document.body.offsetHeight ) ? document.body.scrollHeight : document.body.offsetHeight;

	}
	
	function getDocumentWidth(){
		return ( document.body.scrollWidth > document.body.offsetWidth ) ? document.body.scrollWidth  : document.body.offsetWidth;
	}
	
	function LeftWindow( width ){
		var DocumentWidth = document.body.offsetWidth;
		var ContentWidth = ( DocumentWidth / 100 ) * width;
		var Return = ( DocumentWidth - ContentWidth ) / 2;
		return Return;
	}
	
	function CheckboxAllSelect( form ){
		
		var SearchForm = document.forms[ form ];
		var Check = SearchForm.ChecboxAll.checked == true ? true : false;
		
		for( var i = 0; i < SearchForm.elements.length; i++ )
			{
				var ElementForm = SearchForm.elements[i];
				switch( ElementForm.type )
					{
						case "checkbox": {
							if( ElementForm.name != "ChecboxAll" ) ElementForm.checked = Check;
							break
						}
					}
			}
	}
	
	
	
	
	
	
	function AddBlocks(){
		OpenCloseLightWindow();
		document.getElementById( "LightWindow-title" ).innerHTML = "Добавление блока";
		document.getElementById( "LightWindow-content" ).innerHTML = "<div style=\"padding: 15px; text-align: center;\"><img src=\"engine/inc/mfo/style/images/preloader.gif\" alt=\"Загрузка...\" border=\"0\" /></div>";
				
		$.ajax({
			url: "/engine/ajax/mfo/admin/blocks/add.blocks.php",
			data: "",
			success: function( data ){
				$( "#LightWindow-content" ).html( data );
			},
			dataType: "html",
			type: "POST"
		});
	}
	
	function EditBlocks( id ){
		OpenCloseLightWindow();
		document.getElementById( "LightWindow-title" ).innerHTML = "Редактирование блока";
		document.getElementById( "LightWindow-content" ).innerHTML = "<div style=\"padding: 15px; text-align: center;\"><img src=\"engine/inc/mfo/style/images/preloader.gif\" alt=\"Загрузка...\" border=\"0\" /></div>";
		
		$.ajax({
			url: "/engine/ajax/mfo/admin/blocks/edit.blocks.php",
			data: "id=" + id,
			success: function( data ){
				$( "#LightWindow-content" ).html( data );
			},
			dataType: "html",
			type: "POST"
		});
	}
	
	function CodeBlocks( id ){
		prompt( "Вставьте данный код в шаблон:", "{include file=\"engine/modules/mfo/block.php?id=" + id + "\"}" );
	}
	
	function DelBlocks( id ){
		
		var Quest = confirm( "Вы действительно желаете удалить данный блок?" );
		if( Quest )
			{
				document.getElementById( "StatusIDBlocks_" + id ).innerHTML = "<img src=\"engine/inc/mfo/style/images/mini-ajax.gif\" alt=\"...\" border=\"0\" />";
				
				$.ajax({
					url: "/engine/ajax/mfo/admin/blocks/del.blocks.php",
					data: "id=" + id,
					success: function( data ){
						$( "#del_Blocks_" + id ).html( data );
						var Element = document.getElementById( "del_Blocks_" + id );
						Element.parentNode.removeChild( Element );
					},
					dataType: "html",
					type: "POST"
				});				
			}
		
	}
	
	function AddMfoType(){
		OpenCloseLightWindow();
		document.getElementById( "LightWindow-title" ).innerHTML = "Добавление типа предложений";
		document.getElementById( "LightWindow-content" ).innerHTML = "<div style=\"padding: 15px; text-align: center;\"><img src=\"engine/inc/mfo/style/images/preloader.gif\" alt=\"Загрузка...\" border=\"0\" /></div>";
		
		$.ajax({
			url: "/engine/ajax/mfo/admin/mfo/add.mfo_type.php",
			data: "",
			success: function( data ){
				$( "#LightWindow-content" ).html( data );
			},
			dataType: "html",
			type: "POST"
		});
		
	}
	
	function EditMfoType( id ){
		OpenCloseLightWindow();
		document.getElementById( "LightWindow-title" ).innerHTML = "Редактирование типа предложений";
		document.getElementById( "LightWindow-content" ).innerHTML = "<div style=\"padding: 15px; text-align: center;\"><img src=\"engine/inc/mfo/style/images/preloader.gif\" alt=\"Загрузка...\" border=\"0\" /></div>";
		
		$.ajax({
			url: "/engine/ajax/mfo/admin/mfo/edit.mfo_type.php",
			data: "id=" + id,
			success: function( data ){
				$( "#LightWindow-content" ).html( data );
			},
			dataType: "html",
			type: "POST"
		});
	}
	
	function DelMfoType( id ){
		
		var Quest = confirm( "Вы действительно желаете удалить данный тип предложений?" );
		if( Quest )
			{
				document.getElementById( "StatusIDMfoType_" + id ).innerHTML = "<img src=\"engine/inc/mfo/style/images/mini-ajax.gif\" alt=\"...\" border=\"0\" />";
				
				$.ajax({
					url: "/engine/ajax/mfo/admin/mfo/del.mfo_type.php",
					data: "id=" + id,
					success: function( data ){
						$( "#del_MfoType_" + id ).html( data );
						var Element = document.getElementById( "del_MfoType_" + id );
						Element.parentNode.removeChild( Element );
					},
					dataType: "html",
					type: "POST"
				});
			}
	}
	
	function AddCurrency(){
		OpenCloseLightWindow();
		document.getElementById( "LightWindow-title" ).innerHTML = "Добавление валюты";
		document.getElementById( "LightWindow-content" ).innerHTML = "<div style=\"padding: 15px; text-align: center;\"><img src=\"engine/inc/mfo/style/images/preloader.gif\" alt=\"Загрузка...\" border=\"0\" /></div>";
				
		$.ajax({
			url: "/engine/ajax/mfo/admin/currency/add.currency.php",
			data: "",
			success: function( data ){
				$( "#LightWindow-content" ).html( data );
			},
			dataType: "html",
			type: "POST"
		});
	}
	
	function EditCurrency( id ){
		OpenCloseLightWindow();
		document.getElementById( "LightWindow-title" ).innerHTML = "Редактирование валюты";
		document.getElementById( "LightWindow-content" ).innerHTML = "<div style=\"padding: 15px; text-align: center;\"><img src=\"engine/inc/mfo/style/images/preloader.gif\" alt=\"Загрузка...\" border=\"0\" /></div>";
		
		$.ajax({
			url: "/engine/ajax/mfo/admin/currency/edit.currency.php",
			data: "id=" + id,
			success: function( data ){
				$( "#LightWindow-content" ).html( data );
			},
			dataType: "html",
			type: "POST"
		});
	}
	
	function DelCurrency( id ){
		
		var Quest = confirm( "Вы действительно желаете удалить данную валюту?" );
		if( Quest )
			{
				document.getElementById( "StatusIDCurrency_" + id ).innerHTML = "<img src=\"engine/inc/mfo/style/images/mini-ajax.gif\" alt=\"...\" border=\"0\" />";
				
				$.ajax({
					url: "/engine/ajax/mfo/admin/currency/del.currency.php",
					data: "id=" + id,
					success: function( data ){
						$( "#del_Currency_" + id ).html( data );
						var Element = document.getElementById( "del_Currency_" + id );
						Element.parentNode.removeChild( Element );
					},
					dataType: "html",
					type: "POST"
				});				
			}
		
	}
	
	function AddCountry(){
		OpenCloseLightWindow();
		document.getElementById( "LightWindow-title" ).innerHTML = "Добавление страны";
		document.getElementById( "LightWindow-content" ).innerHTML = "<div style=\"padding: 15px; text-align: center;\"><img src=\"engine/inc/mfo/style/images/preloader.gif\" alt=\"Загрузка...\" border=\"0\" /></div>";
		
		$.ajax({
			url: "/engine/ajax/mfo/admin/country/add.country.php",
			data: "",
			success: function( data ){
				$( "#LightWindow-content" ).html( data );
			},
			dataType: "html",
			type: "POST"
		});
	}
	
	function EditCountry( id ){
		OpenCloseLightWindow();
		document.getElementById( "LightWindow-title" ).innerHTML = "Редактирование страны";
		document.getElementById( "LightWindow-content" ).innerHTML = "<div style=\"padding: 15px; text-align: center;\"><img src=\"engine/inc/mfo/style/images/preloader.gif\" alt=\"Загрузка...\" border=\"0\" /></div>";
		
		$.ajax({
			url: "/engine/ajax/mfo/admin/country/edit.country.php",
			data: "id=" + id,
			success: function( data ){
				$( "#LightWindow-content" ).html( data );
			},
			dataType: "html",
			type: "POST"
		});
	}
	
	function DelCountry( id ){
		
		var Quest = confirm( "Вы действительно желаете удалить данную страну со всеми её вложенными городами?" );
		if( Quest )
			{
				document.getElementById( "StatusCountryId_" + id ).innerHTML = "<img src=\"engine/inc/mfo/style/images/mini-ajax.gif\" alt=\"...\" border=\"0\" />";
				
				$.ajax({
					url: "/engine/ajax/mfo/admin/country/del.country.php",
					data: "id=" + id,
					success: function( data ){
						$( "#delCountry_" + id ).html( data );
						var Element = document.getElementById( "delCountry_" + id );
						Element.parentNode.removeChild( Element );
					},
					dataType: "html",
					type: "POST"
				});
			}
		
	}
	
	
	
	function AddCategory(){
		OpenCloseLightWindow();
		document.getElementById( "LightWindow-title" ).innerHTML = "Добавление категории";
		document.getElementById( "LightWindow-content" ).innerHTML = "<div style=\"padding: 15px; text-align: center;\"><img src=\"engine/inc/mfo/style/images/preloader.gif\" alt=\"Загрузка...\" border=\"0\" /></div>";
		
		$.ajax({
			url: "/engine/ajax/mfo/admin/category/add.category.php",
			data: "",
			success: function( data ){
				$( "#LightWindow-content" ).html( data );
			},
			dataType: "html",
			type: "POST"
		});
	}
	
	function EditCategory( id ){
		OpenCloseLightWindow();
		document.getElementById( "LightWindow-title" ).innerHTML = "Редактирование категории";
		document.getElementById( "LightWindow-content" ).innerHTML = "<div style=\"padding: 15px; text-align: center;\"><img src=\"engine/inc/mfo/style/images/preloader.gif\" alt=\"Загрузка...\" border=\"0\" /></div>";
		
		$.ajax({
			url: "/engine/ajax/mfo/admin/category/edit.category.php",
			data: "id=" + id,
			success: function( data ){
				$( "#LightWindow-content" ).html( data );
			},
			dataType: "html",
			type: "POST"
		});
	}
	
	function AddField(){
		
		var OpenWindow = window.open( "{$PHP_SELF}?mod=mfo&action=field&show_action=add", "AddField", "toolbar=0, location=0, status=0, left=300, top=100, menubar=0, scrollbars=yes, resizable=0, width=700, height=405" );
		OpenWindow.focus();
	}
	
	function EditField( id ){
		
		var OpenWindow = window.open( "{$PHP_SELF}?mod=mfo&action=field&show_action=edit&id=" + id, "EditField_" + id, "toolbar=0, location=0, status=0, left=300, top=100, menubar=0, scrollbars=yes, resizable=0, width=700, height=405" );
		OpenWindow.focus();
		
	}
	
	function TagField( id ){
		
		var OpenWindow = window.open( "{$PHP_SELF}?mod=mfo&action=field&show_action=tag&id=" + id, "TagField_" + id, "toolbar=0, location=0, status=0, left=300, top=150, menubar=0, scrollbars=yes, resizable=0, width=700, height=265" );
		OpenWindow.focus();
		
	}
	
	function DelField( id ){
		
		var Quest = confirm( "Вы действительно желаете удалить данное поле?" );
		if( Quest )
			{
				document.getElementById( "StatusIDField_" + id ).innerHTML = "<img src=\"engine/inc/mfo/style/images/mini-ajax.gif\" alt=\"...\" border=\"0\" />";
								
				$.ajax({
					url: "/engine/ajax/mfo/admin/field/del.field.php",
					data: "id=" + id,
					success: function( data ){
						$( "#del_Field_" + id ).html( data );
						var Element = document.getElementById( "del_Field_" + id );
						Element.parentNode.removeChild( Element );
					},
					dataType: "html",
					type: "POST"
				});
			}
		
	}
	
	function DelMfoPost( id ){
		
		var Quest = confirm( "Вы действительно желаете удалить данную МФО со всеми ее отзывами?" );
		if( Quest )
			{
				document.getElementById( "StatusIDMfoPost_" + id ).innerHTML = "<img src=\"engine/inc/mfo/style/images/mini-ajax.gif\" alt=\"...\" border=\"0\" />";
				
				$.ajax({
					url: "/engine/ajax/mfo/admin/mfo_post/del.mfo_post.php",
					data: "id=" + id,
					success: function( data ){
						$( "#del_MfoPost_" + id ).html( data );
						var Element = document.getElementById( "del_MfoPost_" + id );
						Element.parentNode.removeChild( Element );
					},
					dataType: "html",
					type: "POST"
				});
			}
	}
	
	function DelCategory( id ){
		
		var Quest = confirm( "Вы действительно желаете удалить данную категорию?" );
		if( Quest )
			{
				document.getElementById( "StatusCategory_" + id ).innerHTML = "<img src=\"engine/inc/mfo/style/images/mini-ajax.gif\" alt=\"...\" border=\"0\" />";
				
				$.ajax({
					url: "/engine/ajax/mfo/admin/category/del.category.php",
					data: "id=" + id,
					success: function( data ){
						$( "#del_Category_" + id ).html( data );
						var Element = document.getElementById( "del_Category_" + id );
						Element.parentNode.removeChild( Element );
					},
					dataType: "html",
					type: "POST"
				});				
			}
		
	}
	
	
	
	
	function EditMfoPost( id ){
		
		var OpenWindow = window.open( "{$PHP_SELF}?mod=mfo&action=post_edit&id=" + id + "", "EditPost_" + id + "", "toolbar=0, location=0, status=0, left=200, top=50, menubar=0, scrollbars=yes, resizable=0, width=900, height=605" );
		OpenWindow.focus();
	}
	
	function ShowUser( id ){
		
		var OpenWindow = window.open('{$PHP_SELF}?mod=editusers&action=edituser&id=' + id,'User','toolbar=0,location=0,status=0, left=0, top=0, menubar=0,scrollbars=yes,resizable=0,width=540,height=500')
		OpenWindow.focus();
	}
	
	
	
	function CategorySelect(){
		MfoTypeSetCategory();
		MfoFieldsSetCategory();
	}
	
	function MfoTypeSetCategory(){
		
		var Select = "";
		var SelectCategory = document.getElementById( "MfoSelectCategory" ).value;
		var SelectType = document.getElementById( "MfoTypeSelect" ).value;
		for( var i = 0; i < MfoTypeCat[ SelectCategory ].length; i++ )
			{
				var id = MfoTypeCat[ SelectCategory ][ i ];
				var name = MfoTypeName[ id ];
				var selected = SelectType == id ? " selected=\"selected\"" : "";
				Select += "<option value=\"" + id + "\"" + selected + ">" + name + "</option>";
			}
		
		Select = "<select name=\"mfo_type\" id=\"MfoTypeSelect\">" + Select + "</select>";
		document.getElementById( "mfoType" ).innerHTML = Select;
	}
	
	function MfoFieldsSetCategory(){
	
		var SelectCategory = document.getElementById( "MfoSelectCategory" ).value;
		var field_search = document.getElementById( "MfoFields" );
		var field_id = field_search.getElementsByTagName( "tr" );
		var count_field = field_id.length;
		for( var i = 0; i < count_field; i++ )
			{
				if( field_id[ i ] != null )
					{
						if( /MfoField_[0-9]/i.exec( field_id[ i ].id ) != null )
							{
								field_id[ i ].style['display'] = "none";
								var this_field_id = field_id[ i ].id.match( /[0-9]{1,50}/ );
								
								if( MfoFields[ SelectCategory ] != null )
									{
										for( var c = 0; c < MfoFields[ SelectCategory ].length; c++ )
											{
												if( this_field_id == MfoFields[ SelectCategory ][ c ] )
													{
														field_id[ i ].style['display'] = "";
													}
											}
									}
								
								if( field_id[ i ].style['display'] != "" && MfoFields['all'] != null )
									{
										for( var c = 0; c < MfoFields['all'].length; c++ )
											{
												if( this_field_id == MfoFields['all'][ c ] )
													{
														field_id[ i ].style['display'] = "";
													}
											}
									}
							}
					}
			}
	}
	
	
	
</script>
HTML;

}

function ThisClose(){

return <<<HTML
<script language="javascript" type="text/javascript">

	function UpdateFields( NotClose ){
		
		window.opener.UpdateList( "fields" );
		if( !NotClose )
			{
				window.close();
				window.opener.focus();
			}
	}
	
	function CloseWindow( type ){
		
		UpdateList( type );
		setTimeout( function(){
			OpenCloseLightWindow();	 
		}, 1000 );
	}
	
	function CloseCityWindow( type ){
		
		UpdateList( "country", "country_id=" + type, "country_" + type );
		setTimeout( function(){
			OpenCloseLightWindow();	 
		}, 1000 );
	}

</script>
HTML;

}

//----------------------------------------------------
//  Конструктор цвета
//----------------------------------------------------

function EchoJSColor(){

return <<<HTML


HTML;

}

//----------------------------------------------------
//  JQuery загрузка файла
//----------------------------------------------------

function EchoJQueryUpload(){

return <<<HTML

<script type="text/javascript" src="engine/inc/mfo/js/ajaxupload.3.5.js"></script>
<script language="JavaScript" type="text/javascript">
	
	var NotImgAlbum = "<table width=\"100%\" border=\"0\" style=\"margin: 4px 0px 0px 0px;\"><tr><td colspan=\"2\" background=\"engine/skins/images/mline.gif\" height=\"1\"></td></tr></table>";
	var CountImgAlbum = 0;
	
	function NewBtnToUpload( Btn, Status, Album ){
		$(function(){
			var btnUpload = $( "#" + Btn + "" );
			var status = $( "#" + Status + "" );
			new AjaxUpload( btnUpload, {
				action: "engine/ajax/mfo/admin/upload.php",
				name: 	"Filedata",
				
				data: {
	//				upload_name : $("[name=upload_name]").val(),
					album : Album,
				},
	
				onSubmit: function( file, ext ){
					 if( !( ext && /^(jpg|png|jpeg|gif|swf)$/.test( ext ) ) )
						{ 
							status.html( "<span style=\"color: #F00; font-weight: bold;\">Только JPG, PNG, GIF или SWF!</span>" );
							return false;
						}
						
					status.html( "<img src=\"engine/inc/mfo/style/images/preloader.gif\" alt=\"Загрузка...\" border=\"0\" />" );
				},
				
				onComplete: function( file, response ){
					
					if( CountImgAlbum == 0 ) document.getElementById( "images" ).innerHTML = NotImgAlbum;
					var id = Math.floor( Math.random() * ( 100 - 5 + 1 ) ) + 5;
					var Element = document.createElement( "div" );
					document.getElementById( "images" ).appendChild( Element );
					//Element.id = "img_" + id;
					Element.innerHTML = response;
					status.html( "" );
					CountImgAlbum++;
				}
			});
			
		});
	}
</script>

HTML;

}

function LightWindow(){

return <<<HTML

<script type="text/javascript">

	var LightWindowWidth = 40;
	function LightWindowPosition(){
		
		var LightWindowBG = document.getElementById( "LightWindow-bg" );
		var LightWindowDisplay = document.getElementById( "LightWindowDisplay" );
		
		if( LightWindowBG.style['display'] != "none" )
			{
				LightWindowBG.style['height'] = getDocumentHeight() + "px";
				//LightWindowBG.style['width'] = getDocumentWidth() + "px";
				LightWindowDisplay.style['left'] = LeftWindow( LightWindowWidth ) + "px";
				LightWindowDisplay.style['width'] = LightWindowWidth + "%";
				setTimeout( "LightWindowPosition()", 10 );
				return true;
			}
		
		return false;
	}
	
	function OpenCloseLightWindow(){
		
		var LightWindowBG = document.getElementById( "LightWindow-bg" );
		var LightWindowDisplay = document.getElementById( "LightWindowDisplay" );
		
		// Открытие
		if( LightWindowBG.style['display'] == "none" )
			{
				LightWindowBG.onclick = new Function( "OpenCloseLightWindow()" );
				LightWindowBG.style['display'] = "";
				LightWindowDisplay.style['display'] = "";
				LightWindowPosition();			
			}
		// Закрытие
				else
			{
				LightWindowBG.style['display'] = "none";
				LightWindowDisplay.style['display'] = "none";
				LightWindowBG.onclick = "";
			}
		
	}
</script>
<div class="LightWindow-bg" id="LightWindow-bg" style="display: none;"></div>
<div class="LightWindow-content" id="LightWindowDisplay" style="display: none;">
	<a href="javascript:void(0);" class="close" onclick="OpenCloseLightWindow(); return false;" title="Закрыть">&nbsp;</a>
	<div class="WindowTitle" id="LightWindow-title"></div>
	<div id="LightWindow-content"></div>
</div>

HTML;
}


//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
//  Создание доп. поля
//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

function FieldsType( $AllowType = array() ){
	
	$i = 0;
	$AllowShow = "";
	foreach( $AllowType as $type )
		{
			$AllowShow .= "AllowShowType[{$i}] = \"{$type}\";\n";
			$i++;
		}

return <<<HTML
<script language="JavaScript" type="text/javascript">
	var AllowShowType = new Array();
	$AllowShow
	
	function showtype(){
		
		var ThisShow = document.getElementById( "type" ).value;
		for( var i = 0; i < AllowShowType.length; i++ )
			{
				document.getElementById( "filed_" + AllowShowType[ i ] ).style['display'] = ThisShow == AllowShowType[ i ] ? "" : "none";
			}
	}
	
	function FieldRequired(){
		if( document.getElementById( "allow_edit" ).checked === true || document.getElementById( "show_create" ).checked === true )
			{
				document.getElementById( "required" ).disabled = false; 
			}
				else 
			{ 
				document.getElementById( "required" ).checked = false;
				document.getElementById( "required" ).disabled = true;
			}
	}
	
</script>
HTML;
} 

?>