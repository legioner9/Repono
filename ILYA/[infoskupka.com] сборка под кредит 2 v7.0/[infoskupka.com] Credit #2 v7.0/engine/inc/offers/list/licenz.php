<?php


if( !defined( "DATALIFEENGINE" ) ) die( "Hacking attempt!" );

echoheader( "<i class=\"fa fa-home position-left\"></i><span class=\"text-semibold\">Лицензия модуля</span>","<a href=\"$PHP_SELF?mod=offers\">Каталог офферов 6.0</a> / Лицензия модуля" );


opentable();
tableheader( "Информация о лицензии" );

echo <<<HTML
<div class="panel-body form-horizontal">
	<div class="form-group">
		<label class="control-label col-sm-2">Ваша версия модуля:</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" style="width:100px;" name="stat_priority" value="6.0">
			</div>
	</div>


HTML;

closetable();

echo <<<HTML



<div class="panel-footer hidden-xs">
	<div class="pull-left">
		<ul class="pagination pagination-sm">
			
		</ul>
	</div>
	<div class="pull-right">
		
			
	</div>
</div>	

</div>
HTML;




echo EchoAJAX();
echo EchoJQueryUpload();
echofooter();