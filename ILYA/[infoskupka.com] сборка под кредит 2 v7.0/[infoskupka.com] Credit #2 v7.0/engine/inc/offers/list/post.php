<?php

if( !defined( "DATALIFEENGINE" ) ) die( "Hacking attempt!" );

echoheader( "<i class=\"fa fa-home position-left\"></i><span class=\"text-semibold\">Список офферов</span>","<a href=\"$PHP_SELF?mod=offers\">Каталог офферов 7.0</a> / <a href=\"$PHP_SELF?mod=offers&do=post\">Список офферов</a>" );

$AllowApprove = array( "on", "off" );

$STitle = htmlspecialchars( trim( stripslashes( $_REQUEST['title'] ) ), ENT_QUOTES, $config['charset'] );
$SDateOt = htmlspecialchars( trim( stripslashes( $_REQUEST['date_ot'] ) ), ENT_QUOTES, $config['charset'] );
$SDateDo = htmlspecialchars( trim( stripslashes( $_REQUEST['date_do'] ) ), ENT_QUOTES, $config['charset'] );
$SEndDateOt = htmlspecialchars( trim( stripslashes( $_REQUEST['end_date_ot'] ) ), ENT_QUOTES, $config['charset'] );
$SEndDateDo = htmlspecialchars( trim( stripslashes( $_REQUEST['end_date_do'] ) ), ENT_QUOTES, $config['charset'] );
$SOnPage = intval( $_REQUEST['on_page'] ) > 0 ? intval( $_REQUEST['on_page'] ) : 50;
	
$SCategory = explode(',', $_REQUEST['category']);
$SApprove = in_array( $_REQUEST['approve'], $AllowApprove ) ? $_REQUEST['approve'] : "";

if( !in_array( "all", $SCategory ) )
				{
					foreach( $SCategory as $key => $cat )
						{
							$cat = intval( $cat );
							if( $cat ) 
								$SCategory[ $key ] = "{$cat}";
							else
								unset( $SCategory[ $key ] );
						}
					
					$SCategory = implode( ',', $SCategory );
					$sql[] = "`category` IN ({$cat})";
				}

$SelectCategory = $Offers->SelectCategory( $SCategory );


echo <<<HTML
<div class="panel panel-default">		
	<div class="panel-heading">Поиск офферов</div>
<div id="main">
<form method="post" action="" class="form-horizontal" name="SearchOfferss" >
	<div class="panel-body">
			<div class="col-md-5">
				<div class="form-group">
					<label class="control-label col-lg-2">Название:</label>
					<div class="col-lg-8">
						<input  size="40" type="text" name="title" value="{$STitle}" class="form-control">&nbsp;
					</div>
				</div>
			</div>				
			<div class="col-md-7">
				<div class="form-group">
					<label class="control-label col-md-2">Категория:</label>
					<div class="btn-group bootstrap-select uniform">
						<select name="category" class="uniform">
							<option value="" >- Без разницы -</option>
							{$SelectCategory}
						</select>
				</div>
			</div>
											
							 
							 
							
							 
	  </div>	
	
	</div>	
</div>


HTML;

if( $Offers->Config['region_on'] == "on" ) echo <<<HTML
			
				
HTML;
if( $Offers->Config['region_on'] != "on" ) echo <<<HTML
			
				
HTML;
echo <<<HTML
<div class="panel-footer hidden-xs">
		<div class="pull-left">
			<input type="submit" class="btn bg-teal btn-raised position-left legitRipple" name="submit" value="Начать поиск" class="edit" />
					<input type="hidden" name="action" value="main" />
					<input type="hidden" name="sort" id="offers_hidden_sort" value="" />
					 <span id="status_search_offers"></span>
		</div>
		<div class="pull-right">
		
		</div>
</div>	




</form>
</div>
HTML;



$sql = array();
if( $STitle ) $sql[] = "`title` LIKE '%".$db->safesql( $STitle )."%'";
if( $SPriceOt ) $sql[] = "`price` >= '{$SPriceOt}'";
if( $SPriceDo ) $sql[] = "`price` <= '{$SPriceDo}'";
	
if( $SCategory ) 
				{
					foreach( $SCategory as $key => $cat )
						{
							$cat = intval( $cat );
							if( $cat ) 
								$SCategory[ $key ] = "{$cat}";
							else
								unset( $SCategory[ $key ] );
						}
					
					$SCategory = implode( ',', $SCategory );
					$sql[] = "`category` IN ({$cat})";
				}


if( $SApprove )
	{
		$SqlApprove = $SApprove == "on" ? 1 : 0;
		$sql[] = "`approve`='{$SqlApprove}'";
	}

if( count( $sql ) > 0 )
	$sql = "AND ".implode( " AND", $sql );
else
	$sql = "";
	
$temp = $db->super_query( "SELECT COUNT(*) as count FROM ".PREFIX."_offers_post WHERE id!='' {$sql}" ); 
$posts = $temp['count'];
if( $posts > 0 )
	{
		$page = intval( $_REQUEST['page'] );
		$total = ( ( $posts - 1 ) / $SOnPage  ) + 1;
		$total =  intval( $total );
		if( $page <= 0 ) $page = 1;
		if( $page > $total ) $page = $total;
		$start = $page * $SOnPage - $SOnPage;
		$limit ="LIMIT {$start}, {$SOnPage}";
		$sort = intval( $row['sort'] );
		
		if( !empty( $_REQUEST['sort'] ) )
			{
				$order_offers = totranslit( $_REQUEST['sort'] );
				$array_sort = array(
				  "approve_d" => array( "approve", true ),
				  "approve_k" => array( "approve", false ),
				  "category_d" => array( "category", true ),
				  "category_k" => array( "category", false ),  
				);
		
				foreach( $array_sort as $name_sort => $value )
					{    
						if( $name_sort == $order_offers ) 
							{
								$new_sort = $value[0];
								$desc_sort = $value[1];
								if( $desc_sort ) $desc_sort = "DESC";
								$sql_order = "ORDER BY `{$new_sort}` {$desc_sort}";
								echo "<script language=\"Javascript\">document.getElementById( \"offers_hidden_sort\" ).value=\"{$order_offers}\";</script>";
							}
					}
			}
				else
			{
				$sql_order = "ORDER BY `sort`";
			}
		
		$list = "";
		$result = $db->query( "SELECT * FROM ".PREFIX."_offers_post WHERE id!='' {$sql} {$sql_order} {$limit}" );
		if( $db->num_rows( $result ) > 0 )
			{
				while( $row = $db->get_row( $result ) )
					{
						$id = $row['id'];
						$alt_name = htmlspecialchars( stripslashes( $row['alt_name'] ), ENT_QUOTES, $config['charset'] );
						$title = htmlspecialchars( stripslashes( $row['title'] ), ENT_QUOTES, $config['charset'] );
						$price = intval( $row['price'] );
						$category = intval( $row['category'] );
						$approve = intval( $row['approve'] );
						$sort = intval( $row['sort'] );
						$color = htmlspecialchars( stripslashes( $row['color'] ), ENT_QUOTES, $config['charset'] );
						$color_date = intval( $row['color_date'] );
						$author = htmlspecialchars( stripslashes( $row['author'] ), ENT_QUOTES, $config['charset'] );
						$author_id = intval( $row['author_id'] );

						$comm_num = intval( $row['comm_num'] );
						$photos = $row['photos'] != "" ? "<img src=\"engine/inc/offers/style/images/photo.png\" alt=\"Имеются фотографии\" title=\"Имеются фотографии\" align=\"absmiddle\" />" : "";
						
						$color_date = $color_date > 0 ? date( "Y-m-d H:i:s", ( $color_date + ( $config['date_adjust'] * 60 ) ) ) : "";
						
						$color = $color_date ? "<span style=\"color: {$color};\">(Рекомендуем)</color>" : "";
						
						$EchoCat = ( $category && $Offers->DB['category'][ $category ] ) ? htmlspecialchars( stripslashes( $Offers->DB['category'][ $category ]['title_h'] ), ENT_QUOTES, $config['charset'] ) : "---";
						$EchoApprove = $approve == 1 ? "<span style=\"color: green;\">Да</span>" : "<span style=\"color: #F00;\">Нет</span>";
						$LinkPost = $Offers->ReturnLinkPost( $id, $alt_name, $category );
				
$list .= <<<HTML

		<tr id="del_OffersPost_{$id}">
			<td width="70px" align="center" id="StatusIDOffersPost_{$id}">{$id}</td>
			<td>
				{$super_vip}
				{$vip}
				{$photos}
				<a href="?mod=offers&do=edit_post&id={$id}">{$title}</a> <a href="{$LinkPost}" target="_blank" style="float:right;">На сайте <i class="fa fa-play" style="font-size: 10px;"></i></a>
				
				{$color}
			</td>
			<td width="100px" align="center">{$comm_num}</td>
			<td width="120px" align="center">{$EchoApprove}</td>
			<td width="150px" align="center">{$EchoCat}</td>
			<td width="50px" align="center">
				<input type="text" name="sort[{$id}]" value="{$sort}" style="text-align: center; width: 50px;" class="form-control" />
			</td>
			<td width="100px" align="center">
				<div class="btn-group">
					<button class="btn-default dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bars"></i> <span class="caret"></span></button>
					<ul class="dropdown-menu text-left">
						<li><a href="?mod=offers&do=edit_post&id={$id}"><i class="icon-desktop"></i> Редактировать</a></li>
						<li class="divider"></li>
						<li><a onclick="DelOffersPost( '{$id}' ); return false;" href="#"><i class="icon-trash"></i> удалить</a></li>
					</ul>
				</div>
			</td>
			<td width="30px">
				<input type="checkbox" name="CheckOffersPost[]" value="{$id}" />
			</td>
		</tr>

HTML;

					}
			}
				else
			{
				$list = "<tr><td colspan=\"10\" style=\"padding: 15px; text-align: center;\">не обнаружено</td></tr>";
			}
	}
		else
	{
		$list = "<tr><td colspan=\"10\" style=\"padding: 15px; text-align: center;\">не обнаружено</td></tr>";
	}

$RequestData = "title={$STitle}&on_page={$SOnPage}&category={$SCategory}&approve={$SApprove}&page=";
$n_url = "$PHP_SELF?mod=offers&do=post&{$RequestData}";
$ajax_navigation = "UpdateList( 'mainoffers', '{$RequestData}{page}{$order_offers}' );";
$navigation = Offers_Navigation( "{$n_url}{$order_offers}", "{$n_url}{$order_offers}", $total, $page, $ajax_navigation );



$list = <<<HTML

<div class="panel panel-default">		
	<div class="panel-heading">Поиск офферов</div>
<form name="mainoffers" method="post" action="" onsubmit="SetFormSubmit( 'mainoffers' ); return false;">
	<table class="table table-striped table-xs table-hover">
		<thead>
			<tr height="15px">
				<th width="70px" class="hidden-xs text-center">ID</th>
				<th>Название </th>
				<th width="100px" class="hidden-xs text-center">Отзывов </th>
				<th width="120px" class="hidden-xs text-center">Выводится </th>
				<th width="150px" class="hidden-xs text-center">Категория </th>
				<th width="100px" class="hidden-xs text-center">Сортировка</th>
				<th width="100px" class="hidden-xs text-center">Действие</th>
				<th width="30px">
					<input type="checkbox" name="ChecboxAll" onclick="CheckboxAllSelect( 'mainoffers' );" />
				</th>
			</tr>
		</thead>
		<tbody>
			{$list}
		</tbody>
	</table>
	<div class="panel-footer hidden-xs"> 
		<div class="pull-left">
		
		</div>
		<div class="pull-right">
			<span id="status_mainoffers"></span>
					<select name="action" id="action_mainoffers" class="uniform">
						<option value=""> - Выберите действие - </option>
						<option value="sort">Отсортировать</option>
					</select>
					<input type="submit" name="submit" value="Выполнить" class="btn bg-teal btn-sm btn-raised position-right legitRipple" />
					<input type="hidden" name="TypeAction" value="offers_post" />
		</div>
	</div>	
	<script language="javascript" type="text/javascript">
		var UpdateUrlMainData = "{$RequestData}{$page}&sort={$order_offers}";
	</script>

</form>
</div>
<ul class="pagination pagination-sm mb-20">
	{$navigation}
</ul>
</div>

</div>

<script language="javascript" type="text/javascript">
	
	function ajaxOffers( resultID, fileUrl, dataUrl, statusID, imgUrl, endImgHtml, endFunction ){
		
		if( !statusID ) statusID = "";
		if( !imgUrl ) imgUrl = "status.gif";
		if( statusID != "" ) $( "#" + statusID ).html( "<img src=\"engine/inc/offers/style/images/" + imgUrl + "\" border=\"0\" alt=\"Загрузка\" align=\"absmiddle\" />" );
		
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
	
	if( !UpdateUrl ) var UpdateUrl = "mainoffers";
	var UpdateButton = "<img src=\"engine/inc/offers/style/images/ajax.png\" alt=\"Обновить\" title=\"Обновить\" style=\"cursor: pointer;\" onclick=\"UpdateList(); return false;\" border=\"0\" />";
	function UpdateList( url, otherData, result, preloder ){
		
		if( !url ) url = UpdateUrl;
		if( url == "mainoffers" && !otherData ) otherData = UpdateUrlMainData;
		if( preloder )
			{
				document.getElementById( preloder ).innerHTML = "<div style=\"padding: 30px; text-align: center;\"><img src=\"engine/inc/offers/style/images/ajax_preloader.gif\" alt=\"Загрузка\" border=\"0\" /></div>";
			}
		
		document.getElementById( "UpdateStatus" ).innerHTML = "<img src=\"engine/inc/offers/style/images/ajax.gif\" alt=\"Загрузка\" border=\"0\" />";
		
		var idEcho = ( result ) ? result : url;
		ajaxOffers( idEcho, "/engine/ajax/offers/admin/list.update.php", otherData + "&action=" + url, "UpdateStatus", "ajax.gif", "", function( data, statusID, resultID ){
			$( "#" + resultID ).html( data );
			document.getElementById( "UpdateStatus" ).innerHTML = "<img src=\"engine/inc/offers/style/images/ajax.png\" alt=\"Обновить\" title=\"Обновить\" style=\"cursor: pointer;\" onclick=\"UpdateList(); return false;\" border=\"0\" />";
			
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
			url: "/engine/ajax/offers/admin/other.options.php",
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
			url: "/engine/ajax/offers/admin/other.options.php",
			data: "album=" + Album + "&type=empty_album",
			success: function( data ){
				$( "#empty_status" ).html( data );
			},
			dataType: "html",
			type: "POST"
		});
	}
	
	function SetStatusAlbum( type, id ){
		
		document.getElementById( "album_status_" + id ).innerHTML = "<img src=\"engine/inc/offers/style/images/mini-ajax.gif\" alt=\"Загрузка\" border=\"0\" />";
		
		$.ajax({
			url: "/engine/ajax/offers/admin/other.options.php",
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
				document.getElementById( "DelAlbum_" + id ).innerHTML = "<img src=\"engine/inc/offers/style/images/ajax_preloader.gif\" alt=\"Удаление\" border=\"0\" />";
								
				$.ajax({
					url: "/engine/ajax/offers/admin/other.options.php",
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
		
		document.getElementById( imgId ).innerHTML = "<img src=\"engine/inc/offers/style/images/" + img + "\" border=\"0\" alt=\"Загрузка\" />";
		
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
			url: "/engine/ajax/offers/admin/" + file,
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
		document.getElementById( "LightWindow-content" ).innerHTML = "<div style=\"padding: 15px; text-align: center;\"><img src=\"engine/inc/offers/style/images/preloader.gif\" alt=\"Загрузка...\" border=\"0\" /></div>";
				
		$.ajax({
			url: "/engine/ajax/offers/admin/blocks/add.blocks.php",
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
		document.getElementById( "LightWindow-content" ).innerHTML = "<div style=\"padding: 15px; text-align: center;\"><img src=\"engine/inc/offers/style/images/preloader.gif\" alt=\"Загрузка...\" border=\"0\" /></div>";
		
		$.ajax({
			url: "/engine/ajax/offers/admin/blocks/edit.blocks.php",
			data: "id=" + id,
			success: function( data ){
				$( "#LightWindow-content" ).html( data );
			},
			dataType: "html",
			type: "POST"
		});
	}
	
	function CodeBlocks( id ){
		prompt( "Вставьте данный код в шаблон:", "{include file=\"engine/modules/offers/block.php?id=" + id + "\"}" );
	}
	
	function DelBlocks( id ){
		
		var Quest = confirm( "Вы действительно желаете удалить данный блок?" );
		if( Quest )
			{
				document.getElementById( "StatusIDBlocks_" + id ).innerHTML = "<img src=\"engine/inc/offers/style/images/mini-ajax.gif\" alt=\"...\" border=\"0\" />";
				
				$.ajax({
					url: "/engine/ajax/offers/admin/blocks/del.blocks.php",
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
	
	

	
	function AddCategory(){
		OpenCloseLightWindow();
		document.getElementById( "LightWindow-title" ).innerHTML = "Добавление категории";
		document.getElementById( "LightWindow-content" ).innerHTML = "<div style=\"padding: 15px; text-align: center;\"><img src=\"engine/inc/offers/style/images/preloader.gif\" alt=\"Загрузка...\" border=\"0\" /></div>";
		
		$.ajax({
			url: "/engine/ajax/offers/admin/category/add.category.php",
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
		document.getElementById( "LightWindow-content" ).innerHTML = "<div style=\"padding: 15px; text-align: center;\"><img src=\"engine/inc/offers/style/images/preloader.gif\" alt=\"Загрузка...\" border=\"0\" /></div>";
		
		$.ajax({
			url: "/engine/ajax/offers/admin/category/edit.category.php",
			data: "id=" + id,
			success: function( data ){
				$( "#LightWindow-content" ).html( data );
			},
			dataType: "html",
			type: "POST"
		});
	}
	
	function AddField(){
		
		var OpenWindow = window.open( "?mod=offers&action=field&show_action=add", "AddField", "toolbar=0, location=0, status=0, left=300, top=100, menubar=0, scrollbars=yes, resizable=0, width=700, height=405" );
		OpenWindow.focus();
	}
	
	function EditField( id ){
		
		var OpenWindow = window.open( "?mod=offers&action=field&show_action=edit&id=" + id, "EditField_" + id, "toolbar=0, location=0, status=0, left=300, top=100, menubar=0, scrollbars=yes, resizable=0, width=700, height=405" );
		OpenWindow.focus();
		
	}
	
	function TagField( id ){
		
		var OpenWindow = window.open( "?mod=offers&action=field&show_action=tag&id=" + id, "TagField_" + id, "toolbar=0, location=0, status=0, left=300, top=150, menubar=0, scrollbars=yes, resizable=0, width=700, height=265" );
		OpenWindow.focus();
		
	}
	
	function DelField( id ){
		
		var Quest = confirm( "Вы действительно желаете удалить данное поле?" );
		if( Quest )
			{
				document.getElementById( "StatusIDField_" + id ).innerHTML = "<img src=\"engine/inc/offers/style/images/mini-ajax.gif\" alt=\"...\" border=\"0\" />";
								
				$.ajax({
					url: "/engine/ajax/offers/admin/field/del.field.php",
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
	
	function DelOffersPost( id ){
		
		var Quest = confirm( "Вы действительно желаете удалить данный оффер со всеми его отзывами?" );
		if( Quest )
			{
				document.getElementById( "StatusIDOffersPost_" + id ).innerHTML = "<img src=\"engine/inc/offers/style/images/mini-ajax.gif\" alt=\"...\" border=\"0\" />";
				
				$.ajax({
					url: "/engine/ajax/offers/admin/offers_post/del.offers_post.php",
					data: "id=" + id,
					success: function( data ){
						$( "#del_OffersPost_" + id ).html( data );
						var Element = document.getElementById( "del_OffersPost_" + id );
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
				document.getElementById( "StatusCategory_" + id ).innerHTML = "<img src=\"engine/inc/offers/style/images/mini-ajax.gif\" alt=\"...\" border=\"0\" />";
				
				$.ajax({
					url: "/engine/ajax/offers/admin/category/del.category.php",
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
	
	
	
	
	function EditOffersPost( id ){
		
		var OpenWindow = window.open( "?mod=offers&action=post_edit&id=" + id + "", "EditPost_" + id + "", "toolbar=0, location=0, status=0, left=200, top=50, menubar=0, scrollbars=yes, resizable=0, width=900, height=605" );
		OpenWindow.focus();
	}
	
	function ShowUser( id ){
		
		var OpenWindow = window.open('?mod=editusers&action=edituser&id=' + id,'User','toolbar=0,location=0,status=0, left=0, top=0, menubar=0,scrollbars=yes,resizable=0,width=540,height=500')
		OpenWindow.focus();
	}
	
	
	
	function CategorySelect(){
		OffersTypeSetCategory();
		OffersFieldsSetCategory();
	}
	
	function OffersTypeSetCategory(){
		
		var Select = "";
		var SelectCategory = document.getElementById( "OffersSelectCategory" ).value;
		var SelectType = document.getElementById( "OffersTypeSelect" ).value;
		for( var i = 0; i < OffersTypeCat[ SelectCategory ].length; i++ )
			{
				var id = OffersTypeCat[ SelectCategory ][ i ];
				var name = OffersTypeName[ id ];
				var selected = SelectType == id ? " selected=\"selected\"" : "";
				Select += "<option value=\"" + id + "\"" + selected + ">" + name + "</option>";
			}
		
		Select = "<select name=\"offers_type\" id=\"OffersTypeSelect\">" + Select + "</select>";
		document.getElementById( "offersType" ).innerHTML = Select;
	}
	
	function OffersFieldsSetCategory(){
	
		var SelectCategory = document.getElementById( "OffersSelectCategory" ).value;
		var field_search = document.getElementById( "OffersFields" );
		var field_id = field_search.getElementsByTagName( "tr" );
		var count_field = field_id.length;
		for( var i = 0; i < count_field; i++ )
			{
				if( field_id[ i ] != null )
					{
						if( /OffersField_[0-9]/i.exec( field_id[ i ].id ) != null )
							{
								field_id[ i ].style['display'] = "none";
								var this_field_id = field_id[ i ].id.match( /[0-9]{1,50}/ );
								
								if( OffersFields[ SelectCategory ] != null )
									{
										for( var c = 0; c < OffersFields[ SelectCategory ].length; c++ )
											{
												if( this_field_id == OffersFields[ SelectCategory ][ c ] )
													{
														field_id[ i ].style['display'] = "";
													}
											}
									}
								
								if( field_id[ i ].style['display'] != "" && OffersFields['all'] != null )
									{
										for( var c = 0; c < OffersFields['all'].length; c++ )
											{
												if( this_field_id == OffersFields['all'][ c ] )
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


echo $list;



?>