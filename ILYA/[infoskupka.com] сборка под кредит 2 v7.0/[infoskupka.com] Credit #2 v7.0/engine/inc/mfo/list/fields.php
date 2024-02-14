<?php


if( !defined( "DATALIFEENGINE" ) ) die( "Hacking attempt!" );
echoheader( "<i class=\"fa fa-home position-left\"></i><span class=\"text-semibold\">Дополнительные поля</span>","<a href=\"$PHP_SELF?mod=mfo\">Каталог МФО 7.0</a> / <a href=\"$PHP_SELF?mod=mfo&do=fields\">Дополнительные поля</a>" );


if( $Mfo->Field === false ) $Mfo->StartField( true );

$list = "";	
if( count( $Mfo->Field->DB ) > 0 )
	{
		
		foreach( $Mfo->Field->DB as $row )
			{
				$id = $row[0];
				$alt_name = stripslashes( $row[1] );
				$name = stripslashes( $row[2] );
				$sort = intval( $row['11'] );
				$type = $Mfo->Field->TypeName[ $row[12] ];
						
				$FilterHtml = $row[3] == 1 ? "Да" : "Нет";
				$FilterJs = ( $row[3] == 1 && $row[4] == 1 ) ? "Да" : "Нет";
				$FilterBr = $row[5] == 1 ? "Да" : "Нет";
				$ShowCreate = $row[8] == 1 ? "Да" : "Нет";
				$Allow_Edit = $row[9] == 1 ? "Да" : "Нет";
				$Required = ( $row[10] == 1 && ( $row[9] == 1 || $row[8] == 1 ) ) ? "Да" : "Нет";
				$AllowEdit = implode( ",", $row[6] );
				$AllowShow = implode( ",", $row[7] );
				
$list .= <<<HTML

		<tr id="del_Field_{$id}" height="30px" onmouseover="this.bgColor='#F1F7FE'" onmouseout="this.bgColor='#FFFFFF'">
			<td width="50px" align="center" id="StatusIDField_{$id}">{$id}</td>
			<td>
				<a href="$PHP_SELF?mod=mfo&do=edit_fields&show_action=edit&id={$id}"><b>{$name}</b>   -   Тег для шаблона: {Mfofield:{$alt_name}}</a>
			</td>
			<td width="150px" align="center">{$type}</td>
			<td width="100px" align="center">
				<input type="text" name="sort[{$id}]" value="{$sort}" style="text-align: center; width: 40px;" class="form-control" />
			</td>
			<td width="100px" align="center">
				<div class="btn-group">
					<button class="btn-default dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bars"></i> <span class="caret"></span></button>
					<ul class="dropdown-menu text-left">
						<li><a onclick="DelField( '{$id}' ); return false;" href="#"><i class="icon-trash"></i> удалить</a></li>
					</ul>
				</div>
			</td>
			<td width="30px">
				<input type="checkbox" name="CheckFields[]" value="{$id}" />
			</td>
		</tr>

HTML;

			}
	}
		else
	{
		$list = "<tr><td colspan=\"10\" style=\"padding: 15px; text-align: center;\">Дополнительных полей не обнаружено</td></tr>";
	}

$list = <<<HTML

<form name="fields" method="post" action="" onsubmit="SetFormSubmit( 'fields' ); return false;">
	<table class="table table-striped table-xs table-hover">
		<thead>
			<tr height="15px">
				<th width="50px" class="hidden-xs text-center">ID</th>
				<th>Название</th>
				<th width="150px" class="hidden-xs text-center">Тип</th>
				<th width="100px" class="hidden-xs text-center">Сортировка</th>
				<th width="100px" class="hidden-xs text-center">Действие</th>
				<th width="30px">
					<input type="checkbox" name="ChecboxAll" onclick="CheckboxAllSelect( 'fields' );"/>
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
		<a href="$PHP_SELF?mod=mfo&do=edit_fields&show_action=add" class="btn bg-teal btn-sm btn-raised position-left legitRipple" />Добавить поле</a>
		</ul>
		</div>
		<div class="pull-right">
		<span id="status_fields"></span>
					<select class="uniform" name="action" id="action_fields">
						<option value=""> - Выберите действие - </option>
						<option value="sort">Отсортировать</option>
					</select>
		
		
		<input type="submit" class="btn bg-teal btn-sm btn-raised position-right legitRipple" name="submit" value="Выполнить" class="edit" />
		<input type="hidden" name="TypeAction" value="fields" />
		
		
		</div>
	</div>
</form>

HTML;

opentable();
tableheader( "Дополнительные поля" );
echo $list;
closetable();
echofooter();
echo EchoAJAX();
echo EchoJQueryUpload();
?>