<?php

ini_set('display_errors','On');
error_reporting('E_ALL');
if( !defined( "DATALIFEENGINE" ) ) die( "Hacking attempt!" );

echoheader( "<i class=\"fa fa-home position-left\"></i><span class=\"text-semibold\">Категории</span>","<a href=\"$PHP_SELF?mod=banki\">Каталог банков 7.0</a> / <a href=\"$PHP_SELF?mod=banki&do=category\">Категории</a>" );

$list = "";	
if( count( $Banki->DB['category'] ) > 0 )
	{
		
		$list .= $Banki->ReturnAdminCat();
	}
		else
	{
		$list = "<tr><td colspan=\"10\" style=\"padding: 15px; text-align: center;\">Категорий не обнаружено</td></tr>";
	}

$list = <<<HTML

<form name="category" method="post" action="" onsubmit="SetFormSubmit( 'category' ); return false;">
	<table class="table table-striped table-xs table-hover">
		<thead>
			<tr height="15px">
				<th width="70px" class="hidden-xs text-center">ID</th>
				<th>Название</th>
				<th width="100px" class="hidden-xs text-center">Сортировка</th>
				<th width="100px" class="hidden-xs text-center">Действие</th>
				<th width="30px">
					<input type="checkbox" name="ChecboxAll" onclick="CheckboxAllSelect( 'category' );" />
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
		<a class="btn bg-teal btn-sm btn-raised position-left legitRipple" href="$PHP_SELF?mod=banki&do=add_category" />Добавить категорию</a>
		</ul>
		</div>
		<div class="pull-right">
		<span id="status_category"></span>
		<select class="uniform" name="action" id="action_category">
						<option value=""> - Выберите действие - </option>
						<option value="sort">Отсортировать</option>
						
					</select>
		
		<input type="submit" class="btn bg-teal btn-sm btn-raised position-right legitRipple" name="submit" value="Выполнить" class="edit" />
		<input type="hidden" name="TypeAction" value="category" />
		
		
		</div>
	</div>	
</form>

HTML;

opentable();
tableheader( "Список категорий" );
echo $list;
closetable();
echofooter();
echo EchoAJAX();
echo EchoJQueryUpload();	
?>