<?php


//-------------------------------------------------====
//	Инициализация
//-------------------------------------------------====

if( !defined( "DATALIFEENGINE" ) ) die( "Hacking attempt!" );
echoheader( "<i class=\"fa fa-home position-left\"></i><span class=\"text-semibold\">Редактирование категории</span>","<a href=\"$PHP_SELF?mod=banki\">Каталог банков 7.0</a> / <a href=\"$PHP_SELF?mod=banki&do=category\">Категории</a>" );


//-------------------------------------------------====
//	Само сохранение и вывод данных
//-------------------------------------------------====
opentable();
tableheader( "Редактирование категории" );
$id = intval( $_REQUEST['id'] );
if( $id )
	{
		if( $Banki->DB['category'][ $id ] )
			{
				if( isset( $_POST['submit'] ) )
					{
						$sort = intval( $_POST['sort'] );
						$Options['name'] = htmlspecialchars( stripslashes( $_POST['name'] ), ENT_QUOTES, $config['charset'] );
						$Options['alt_name'] = $_POST['alt_name'] != "" ? totranslit( $_POST['alt_name'] ) : totranslit( $Options['name'] );
						$Options['template'] = totranslit( $_POST['template'] );
						$Options['icon'] = htmlspecialchars( strip_tags( stripslashes( $_POST['icon'] )  ), ENT_QUOTES, $config['charset'] );
						$Options['title_h'] = htmlspecialchars( stripslashes( $_POST['title_h'] ) , ENT_QUOTES, $config['charset'] );
						$Options['description'] = htmlspecialchars( stripslashes( $_POST['description'] ), ENT_QUOTES, $config['charset'] );
						$Options['keywords'] = htmlspecialchars( stripslashes( $_POST['keywords'] ), ENT_QUOTES, $config['charset'] );
						$Options['opisanie'] = $_POST['opisanie'];
						$Options['opisanie_up'] = $_POST['opisanie_up'];
						$Options['cat'] = intval( $_POST['MainCategory'] );
						$Options['count_post'] = $Banki->DB['category'][ $id ]['count_post'];
								
						if( !$Options['name'] ) die( "<span style=\"color: #F00;\">Введите название</span>" );
						$Options = $db->safesql( $Banki->CompileOpt( $Options ) );
						
						$db->query( "UPDATE ".PREFIX."_banki_options SET `options`='{$Options}',`sort`='{$sort}' WHERE `id`='{$id}' LIMIT 1" );
						$Banki->CleareAllCache();
						
						echo ThisClose();
						echo "<div style=\"padding: 20px;\">Категория отредактирован</div>
<div class=\"hr_line\"></div>
<div style=\"padding: 20px;\">
	<a href=\"$PHP_SELF?mod=banki&do=category\" class=\"btn bg-slate-600 btn-sm btn-raised legitRipple\" style=\"margin-right:5px;\">Список категорий<a/>
</div>";
					}
						else
					{
						$name = htmlspecialchars( stripslashes( $Banki->DB['category'][ $id ]['name'] ), ENT_QUOTES, $config['charset'] );
						$alt_name = htmlspecialchars( stripslashes( $Banki->DB['category'][ $id ]['alt_name'] ), ENT_QUOTES, $config['charset'] );
						$template = htmlspecialchars( stripslashes( $Banki->DB['category'][ $id ]['template'] ), ENT_QUOTES, $config['charset'] );
						$title_h = htmlspecialchars( stripslashes( $Banki->DB['category'][ $id ]['title_h'] ), ENT_QUOTES, $config['charset'] );
						$description = htmlspecialchars( stripslashes( $Banki->DB['category'][ $id ]['description'] ), ENT_QUOTES, $config['charset'] );
						$keywords = htmlspecialchars( stripslashes( $Banki->DB['category'][ $id ]['keywords'] ), ENT_QUOTES, $config['charset'] );
						$opisanie = $Banki->DB['category'][ $id ]['opisanie'];
						$opisanie_up = $Banki->DB['category'][ $id ]['opisanie_up'];
						
						$icon = htmlspecialchars( strip_tags( stripslashes( $Banki->DB['category'][ $id ]['icon'] ) ), ENT_QUOTES, $config['charset'] );
						$sort = intval( $Banki->DB['category'][ $id ]['sort'] );
						$MainCategory = intval( $Banki->DB['category'][ $id ]['cat'] );
						$SelectCategory = $Banki->SelectCategory( $MainCategory, $id );
						
redactor();
		
echo <<<HTML

<form method="post" class="form-horizontal" action="" name="LightWindowForm" onsubmit="formSubmit( 'LightWindowForm', 'category/edit.category.php', 'LightWindowStatus', 'status.gif', 'LightWindowStatus', 'off' ); return false;">
	<div class="panel-body">
		<div class="form-group">
			<label class="control-label col-sm-2">Название категории {Title}: *</label>
				<div class="col-sm-10">
					<input type="text" name="name" value="{$name}" class="form-control width-700 position-left"  />
				</div>
				<div class="clr"></div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-2">Альтернативное имя:</label>
				<div class="col-sm-10">
					<input type="text" name="alt_name" value="{$alt_name}" class="form-control width-700 position-left"  />
				</div>
				<div class="clr"></div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-2">Заголовок H1:</label>
				<div class="col-sm-10">
					<input type="text" name="title_h" value="{$title_h}" class="form-control width-700 position-left"  />
				</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-2">Папка шаблона:</label>
				<div class="col-sm-10">
					<input type="text" name="template" value="{$template}" class="form-control width-700 position-left"  />
				</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-2">Описание (descr):</label>
				<div class="col-sm-10">
					<input type="text" name="description" value="{$description}" class="form-control width-700 position-left"  />
				</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-2">Ключевые слова (keywords):</label>
				<div class="col-sm-10">
					<input type="text" name="keywords" value="{$keywords}" class="form-control width-700 position-left"  />
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
					<textarea class="set_tinyMCE" name="opisanie_up" onfocus="setFieldName(this.name)" style="width: 100%; height: 520px;">{$opisanie_up}</textarea>
				</div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-2">Описание низ:</label>
				<div class="col-sm-10">
					<textarea class="set_tinyMCE" name="opisanie" onfocus="setFieldName(this.name)" style="width: 100%; height: 520px;">{$opisanie}</textarea>
				</div>
		</div> 
		<div class="form-group">
			<label class="control-label col-sm-2">Сортировка:</label>
				<div class="col-sm-10">
					<input type="text" name="sort" value="{$sort}" class="form-control width-250 position-left"  />
				</div>
		</div>
		

HTML;

closetable();	

echo <<<HTML
	<div class="panel-footer">
		<span id="LightWindowStatus" style="padding: 0px 10px 0px 0px;"></span>
		<input type="hidden" name="id" value="{$id}" />
		<input type="submit" name="submit" value="Сохранить" class="btn bg-slate-600 btn-sm btn-raised legitRipple" />
	</div>
</form>

HTML;

					}
			}
				else
			{
				echoReturn( "Типа не существует, или он был удалён!" );
			}
	}
		else
	{
		echoReturn( "Не указан идентификатр типа!" );
	}

//-------------------------------------------------====
//	Завершение работы
//-------------------------------------------------====

$db->close();
echofooter();
?>