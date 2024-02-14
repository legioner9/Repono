<?php


if( !defined( "DATALIFEENGINE" ) ) die( "Hacking attempt!" );
echoheader( "<i class=\"fa fa-home position-left\"></i><span class=\"text-semibold\">Блоки</span>","<a href=\"$PHP_SELF?mod=offers\">Каталог офферов 7.0</a> / <a href=\"$PHP_SELF?mod=offers&do=blocks\">Блоки</a>" );

$list = "";	
if( count( $Offers->DB['blocks'] ) > 0 )
	{
		foreach( $Offers->DB['blocks'] as $key => $row )
			{
				$id = $row['id'];
				$title = stripslashes( $row['title'] );
				$position = intval( $row['sort'] );
				
$list .= <<<HTML

			<tr id="del_Blocks_{$id}">
			<td width="50px" align="center" id="StatusIDBlocks_{$id}">{$id}</td>
			<td align="center"><a href="$PHP_SELF?mod=offers&do=edit_block&id={$id}" >{$title}</a></td>
			<td width="110px" align="center">
				<input type="text" name="position[{$id}]" value="{$position}" style="text-align: center; width: 50px;" class="form-control" />
				
				
			</td>
			<td width="100px" align="center" class="hidden-xs">
				<div class="btn-group">
					<button class="btn-default dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bars"></i> <span class="caret"></span></button>
					<ul class="dropdown-menu text-left">
						<li><a href="#" onclick="DelBlocks( '{$id}' ); return false;" href="#"><i class="icon-trash"></i> Удалить</li>
				</div>
			</td>
			<td width="360px" align="center">
				{include file="engine/modules/offers/block.php?id={$id}"}
				
			</td>
			
			<td width="40px">
				<input type="checkbox" name="CheckBlocks[]" value="{$id}" />
			</td>
		</tr>

HTML;

			}
	}
		else
	{
		$list = "<tr><td colspan=\"10\" style=\"padding: 15px; text-align: center;\">Блоков не обнаружено</td></tr>";
	}

$list = <<<HTML

<form name="blocks" method="post" action="" onsubmit="SetFormSubmit( 'blocks' ); return false;">
	<table class="table table-striped table-xs table-hover">
		<thead>
			<tr height="15px">
				<th width="70px" class="hidden-xs text-center">ID</th>
				<th>Название</th>
				<th width="100px" class="hidden-xs text-center">Позиция</th>
				<th width="100px" class="hidden-xs text-center">Действие:</th>
				<th width="360px" class="hidden-xs text-center">
					В шаблон
				
			</th>
				<th width="30px">
					<input type="checkbox" name="ChecboxAll" onclick="CheckboxAllSelect( 'blocks' );" />
				</th>
			</tr>
		</thead>
		<tbody>
			{$list}
		</tbody>
	</table>
	<div class="panel-footer hidden-xs">
		<div class="pull-left">
		<ul class="pagination pagination-sm">
		<a  class="btn bg-teal btn-sm btn-raised position-right legitRipple" href="$PHP_SELF?mod=offers&do=add_block" />Добавить блок</a>
		</ul>
		</div>
		<div class="pull-right">
		<span id="status_blocks"></span>
					<select class="uniform" name="action" id="action_blocks">
						<option value=""> - Выберите действие - </option>
						<option value="sort">Отсортировать</option>
					</select>
		
		<input type="submit" class="btn bg-teal btn-sm btn-raised position-right legitRipple" name="submit" value="Выполнить" class="edit" />
		<input type="hidden" name="TypeAction" value="blocks" />
		
		
		</div>
	</div>	
</form>

HTML;

opentable();
tableheader( "Список блоков" );
echo $list;
closetable();
echofooter();
echo EchoAJAX();
echo EchoJQueryUpload();
?>