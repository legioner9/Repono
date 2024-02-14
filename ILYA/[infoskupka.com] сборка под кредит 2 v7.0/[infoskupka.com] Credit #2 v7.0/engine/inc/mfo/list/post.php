<?php

if( !defined( "DATALIFEENGINE" ) ) die( "Hacking attempt!" );

echoheader( "<i class=\"fa fa-home position-left\"></i><span class=\"text-semibold\">Список МФО</span>","<a href=\"$PHP_SELF?mod=mfo\">Каталог МФО 7.0</a> / <a href=\"$PHP_SELF?mod=mfo&do=post\">Список МФО</a>" );

$AllowApprove = array( "on", "off" );

$STitle = htmlspecialchars( trim( stripslashes( $_REQUEST['title'] ) ), ENT_QUOTES, $config['charset'] );
$SOnPage = intval( $_REQUEST['on_page'] ) > 0 ? intval( $_REQUEST['on_page'] ) : 50;

	
$SCategory = intval( $_REQUEST['category'] );
$SApprove = in_array( $_REQUEST['approve'], $AllowApprove ) ? $_REQUEST['approve'] : "";



$SelectCategory = $Mfo->SelectCategory( $SCategory );


echo <<<HTML
<div class="panel panel-default">		
	<div class="panel-heading">Поиск МФО по базе</div>
<div id="main">
<form method="post" action="" class="form-horizontal" name="SearchMfos">
	<div class="panel-body">
			<div class="col-md-8">
				<div class="form-group">
					<label class="control-label col-lg-2">Название:</label>
					<div class="col-lg-8">
						<input  size="40" type="text" name="title" value="{$STitle}" class="form-control">&nbsp;
					</div>
				</div>
				
						
			
											
							 
							 
							
							 
	  </div>	
	
	</div>	
</div>


HTML;

if( $Mfo->Config['region_on'] == "on" ) echo <<<HTML
			
				
HTML;
if( $Mfo->Config['region_on'] != "on" ) echo <<<HTML
			
				
HTML;
echo <<<HTML
<div class="panel-footer hidden-xs">
		<div class="pull-left">
			<input type="submit" class="btn bg-teal btn-raised position-left legitRipple" name="submit" value="Начать поиск" class="edit" />
					<input type="hidden" name="action" value="main" />
					<input type="hidden" name="sort" id="mfo_hidden_sort" value="" />
					 <span id="status_search_mfo"></span>
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


if( $SApprove )
	{
		$SqlApprove = $SApprove == "on" ? 1 : 0;
		$sql[] = "`approve`='{$SqlApprove}'";
	}

if( count( $sql ) > 0 )
	$sql = "AND ".implode( " AND", $sql );
else
	$sql = "";
	
$temp = $db->super_query( "SELECT COUNT(*) as count FROM ".PREFIX."_mfo_post WHERE id!='' {$sql}" ); 
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
		
		if( !empty( $_REQUEST['sort'] ) )
			{
				$order_mfo = totranslit( $_REQUEST['sort'] );
				$array_sort = array(
				  "id_d" => array( "id", true ),
				  "id_k" => array( "id", false ),
				  "title_d" => array( "title", true ),
				  "title_k" => array( "title", false ),
				  "approve_d" => array( "approve", true ),
				  "approve_k" => array( "approve", false ),
				  "category_d" => array( "category", true ),
				  "category_k" => array( "category", false ),  
				);
		
				foreach( $array_sort as $name_sort => $value )
					{    
						if( $name_sort == $order_mfo )
							{
								$new_sort = $value[0];
								$desc_sort = $value[1];
								if( $desc_sort ) $desc_sort = "ASC";
								$sql_order = "ORDER BY `{$new_sort}` {$desc_sort}";
								echo "<script language=\"Javascript\">document.getElementById( \"mfo_hidden_sort\" ).value=\"{$order_mfo}\";</script>";
							}
					}
			}
				else
			{
				$sql_order = "ORDER BY `id` DESC";
				$order_mfo = totranslit( $_REQUEST['sort'] );
			}
		
		$list = "";
		$result = $db->query( "SELECT * FROM ".PREFIX."_mfo_post WHERE id!='' {$sql} {$sql_order} {$limit}" );
		if( $db->num_rows( $result ) > 0 )
			{
				while( $row = $db->get_row( $result ) )
					{
						$id = $row['id'];
						$alt_name = htmlspecialchars( stripslashes( $row['alt_name'] ), ENT_QUOTES, $config['charset'] );
						$title = htmlspecialchars( stripslashes( $row['title'] ), ENT_QUOTES, $config['charset'] );
						$price = intval( $row['price'] );
						$date = date( "Y-m-d", strtotime( $row['date'] ) );
						$category = intval( $row['category'] );
						$approve = intval( $row['approve'] );
						
						$color = htmlspecialchars( stripslashes( $row['color'] ), ENT_QUOTES, $config['charset'] );
						$color_date = intval( $row['color_date'] );
						$author = htmlspecialchars( stripslashes( $row['author'] ), ENT_QUOTES, $config['charset'] );
						$author_id = intval( $row['author_id'] );

						$comm_num = intval( $row['comm_num'] );
						$photos = $row['photos'] != "" ? "<img src=\"engine/inc/mfo/style/images/photo.png\" alt=\"Имеются фотографии\" title=\"Имеются фотографии\" align=\"absmiddle\" />" : "";
						
						$color_date = $color_date > 0 ? date( "Y-m-d H:i:s", ( $color_date + ( $config['date_adjust'] * 60 ) ) ) : "";
						
						$color = $color_date ? "<span style=\"color: {$color};\">(Рекомендуем до {$color_date})</color>" : "";
						
						$EchoCat = ( $category && $Mfo->DB['category'][ $category ] ) ? htmlspecialchars( stripslashes( $Mfo->DB['category'][ $category ]['title_h'] ), ENT_QUOTES, $config['charset'] ) : "---";
						$EchoApprove = $approve == 1 ? "<span style=\"color: green;\">Да</span>" : "<span style=\"color: #F00;\">Нет</span>";
						$LinkPost = $Mfo->ReturnLinkPost( $id, $alt_name, $category );
				
$list .= <<<HTML

		<tr id="del_MfoPost_{$id}">
			<td width="70px" align="center" id="StatusIDMfoPost_{$id}">{$id}</td>
			<td>
				{$super_vip}
				{$vip}
				{$photos}
				<a href="?mod=mfo&do=edit_post&id={$id}">{$title}</a> <a href="{$LinkPost}" target="_blank" style="float:right;">На сайте <i class="fa fa-play" style="font-size: 10px;"></i></a>
				
				{$color}
			</td>
			<td width="100px" align="center">{$comm_num}</td>
			<td width="120px" align="center">{$EchoApprove}</td>
			<td width="150px" align="center">{$EchoCat}</td>
			<td width="100px" align="center">
				<div class="btn-group">
					<button class="btn-default dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bars"></i> <span class="caret"></span></button>
					<ul class="dropdown-menu text-left">
						<li><a href="?mod=mfo&do=edit_post&id={$id}"><i class="icon-desktop"></i> Редактировать</a></li>
						<li class="divider"></li>
						<li><a onclick="DelMfoPost( '{$id}' ); return false;" href="#"><i class="icon-trash"></i> удалить</a></li>
					</ul>
				</div>
			</td>
			<td width="30px">
				<input type="checkbox" name="CheckMfoPost[]" value="{$id}" />
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
$n_url = "$PHP_SELF?mod=mfo&do=post&{$RequestData}";
$ajax_navigation = "UpdateList( 'mainmfo', '{$RequestData}{page}{$order_mfo}' );";
$navigation = Mfo_Navigation( "{$n_url}{$order_mfo}", "{$n_url}{$order_mfo}", $total, $page, $ajax_navigation );


$list = <<<HTML

<div class="panel panel-default">		
	<div class="panel-heading">Поиск МФО по базе</div>
<form name="main" method="post" action="" onsubmit="SetFormSubmit( 'main' ); return false;">
	<table class="table table-striped table-xs table-hover">
		<thead>
			<tr height="15px">
				<th width="70px" class="hidden-xs text-center">ID</th>
				<th>Название </th>
				<th width="100px" class="hidden-xs text-center">Отзывов </th>
				<th width="120px" class="hidden-xs text-center">Выводится </th>
				<th width="150px" class="hidden-xs text-center">Категория </th>
				<th width="100px" class="hidden-xs text-center">Действие</th>
				<th width="30px">
					<input type="checkbox" name="ChecboxAll" onclick="CheckboxAllSelect( 'main' );" />
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
		
		</div>
	</div>	
	<script language="javascript" type="text/javascript">
		var UpdateUrlMainData = "{$RequestData}{$page}&sort={$order_mfo}";
	</script>

</form>
</div>
<ul class="pagination pagination-sm mb-20">
	{$navigation}
</ul>
</div>
</div>
HTML;


echo $list;


echo EchoAJAX();
?>