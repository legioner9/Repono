<?php


//-------------------------------------------------====
//	Инициализация
//-------------------------------------------------====

if( !defined( "DATALIFEENGINE" ) ) die( "Hacking attempt!" );
echoheader( "<i class=\"fa fa-home position-left\"></i><span class=\"text-semibold\">Добавление категории</span>","<a href=\"$PHP_SELF?mod=mfo\">Каталог МФО 7.0</a> / <a href=\"$PHP_SELF?mod=mfo&do=category\">Категории</a>" );

//-------------------------------------------------====
//	Само добавление и вывод данных
//-------------------------------------------------====
opentable();
tableheader( "Добавление категории" );
if( isset( $_POST['submit'] ) )
	{
		$sort = intval( $_POST['sort'] );
		$Options['name'] = htmlspecialchars( stripslashes(  $_POST['name'] ) , ENT_QUOTES, $config['charset'] );
		$Options['alt_name'] = $_POST['alt_name'] != "" ? totranslit(  $_POST['alt_name']  ) : totranslit( $Options['name'] );
		$Options['template'] = totranslit( $_POST['template']  );
		$Options['icon'] = htmlspecialchars( strip_tags( stripslashes( $_POST['icon'] )  ), ENT_QUOTES, $config['charset'] );
		$Options['title_h'] = htmlspecialchars( stripslashes( $_POST['title_h']  ), ENT_QUOTES, $config['charset'] );
		$Options['description'] = htmlspecialchars( stripslashes( $_POST['description'] ) , ENT_QUOTES, $config['charset'] );
		$Options['opisanie'] = $_POST['opisanie'];
		$Options['opisanie_up'] = $_POST['opisanie_up'];
		
		$Options['keywords'] = htmlspecialchars( stripslashes(  $_POST['keywords'] ), ENT_QUOTES, $config['charset'] );
		$Options['cat'] = intval( $_POST['MainCategory'] );
				
		if( !$Options['name'] ) die( "<span style=\"color: #F00;\">Введите название</span>" );
		foreach( $Mfo->DBIndex['category'] as $alt_name => $id )
			{
				if( $alt_name == $Options['alt_name'] ) die( "<span style=\"color: #F00;\">Категория уже существует</span>" );
			}
		
		$Options = $db->safesql( $Mfo->CompileOpt( $Options ) );
		
		$db->query( "INSERT INTO ".PREFIX."_mfo_options (`type`,`options`,`sort`) VALUES ('category','{$Options}','{$sort}')" );
		$Mfo->CleareAllCache();
		
		echo ThisClose();
		echo "<div class=\"panel-body\"><div style=\"color: green; float: left; margin: 40px 40px 40px 0;\">Категория добавлена <a style=s\"float: left; href=\"$PHP_SELF?mod=mfo&amp;do=category\">Список категорий</a></div></div>";
	}
		else
	{
		$SelectCategory = $Mfo->SelectCategory();
		
		
redactor();
		
echo <<<HTML

<form method="post" class="form-horizontal" action="" name="LightWindowForm" onsubmit="formSubmit( 'LightWindowForm', 'category/add.category.php', 'LightWindowStatus', 'status.gif', 'LightWindowStatus', 'off' ); return false;">
	<div class="panel-body">
		<div class="form-group">
			<label class="control-label col-sm-2">Название категории {Title}: *</label>
				<div class="col-sm-10">
					<input type="text" name="name" value="" class="form-control width-700 position-left"  />
				</div>
				<div class="clr"></div>
		</div>
		
		<div class="form-group">
			<label class="control-label col-sm-2">Альтернативное имя:</label>
				<div class="col-sm-10">
					<input type="text" name="alt_name" value="" class="form-control width-700 position-left"  />
				</div>
				<div class="clr"></div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-2">Заголовок H1:</label>
				<div class="col-sm-10">
					<input type="text" name="title_h" value="" class="form-control width-700 position-left"  />
				</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-2">Папка шаблона:</label>
				<div class="col-sm-10">
					<input type="text" name="template" value="" class="form-control width-700 position-left"  />
				</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-2">Иконка:</label>
				<div class="col-sm-10">
					<input type="text" name="icon" value="" class="form-control width-700 position-left"  />
				</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-2">Описание (descr):</label>
				<div class="col-sm-10">
					<input type="text" name="description" value="" class="form-control width-700 position-left"  />
				</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-2">Ключевые слова (keywords):</label>
				<div class="col-sm-10">
					<input type="text" name="keywords" value="" class="form-control width-700 position-left"  />
				</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-2">Основная категория:</label>
				<div class="col-sm-10">
					
						<select name="MainCategory" class="categoryselect " style="width: 100%; max-width: 350px;">
							<option value="">---</option>
							{$SelectCategory}
						</select>
				
				</div>
		</div>
		
HTML;
			if( $config['allow_admin_wysiwyg'] ) {
                         $bb_editor = true;
						include (ENGINE_DIR . '/inc/include/inserttag.php');
			}
						
echo <<<HTML

		<div class="form-group">
			<label class="control-label col-sm-2">Описание верх:</label>
				<div class="col-sm-10">
					<textarea class="set_tinyMCE" name="opisanie_up" onfocus="setFieldName(this.name)" style="width: 100%; height: 220px;"></textarea>
				</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-2">Описание низ:</label>
				<div class="col-sm-10">
					<textarea class="set_tinyMCE" name="opisanie" onfocus="setFieldName(this.name)" style="width: 100%; height: 520px;"></textarea>
				</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-2">Сортировка:</label>
				<div class="col-sm-10">
					<input type="text" name="sort" value="" class="form-control width-250 position-left"  />
				</div>
		</div>
		

HTML;

closetable();	

echo <<<HTML
	<div class="panel-footer">
		<span id="LightWindowStatus" style="padding: 0px 10px 0px 0px;"></span>
		<input type="submit" name="submit" value="Добавить" class="btn bg-slate-600 btn-sm btn-raised legitRipple" />
	</div>
	</div>
</form>

HTML;

	}

//-------------------------------------------------====
//	Завершение работы
//-------------------------------------------------====

$db->close();
echofooter();
?>