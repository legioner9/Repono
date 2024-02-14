<?php


//-------------------------------------------------====
//	Инициализация
//-------------------------------------------------====

echoheader( "<i class=\"fa fa-home position-left\"></i><span class=\"text-semibold\">Редактирование блока</span>","<a href=\"$PHP_SELF?mod=mfo\">Каталог МФО 7.0</a> / <a href=\"$PHP_SELF?mod=mfo&do=blocks\">Блоки</a>" );

opentable();
tableheader( "Редактирование блока" );

//-------------------------------------------------====
//	Само сохранение и вывод данных
//-------------------------------------------------====

$id = intval( $_REQUEST['id'] );
if( $id )
	{
		if( $Mfo->DB['blocks'][ $id ] )
			{
				if( isset( $_POST['submit'] ) )
					{
						$Options['title'] = htmlspecialchars( stripslashes( $_POST['title']  ), ENT_QUOTES, $config['charset'] );
						$Options['post_type'] = totranslit( $_POST['post_type']  );
						$Options['post_sort'] = totranslit( $_POST['post_sort']  );
						$Options['cats_type'] = totranslit( $_POST['cats_type']  );
						$Options['cache'] = intval( $_POST['cache'] );
						$Options['max_post'] = intval( $_POST['max_post'] );
						$Options['template'] = totranslit( $_POST['template'], false, false );
						$Options['post_photo'] = $_POST['post_photo'] == "yes" ? "yes" : "no";
						
						$Options['AllowCats'] = $_REQUEST['AllowCats'];
						
						if( count( $Options['AllowCats'] ) < 1 || !is_array( $Options['AllowCats'] ) )
							$Options['AllowCats'] = "all";
						else
							$Options['AllowCats'] = implode( ",", $Options['AllowCats'] );
						
						if( !$Options['title'] ) die( "<span style=\"color: #F00;\">Введите название блока</span>" );
						if( !$Options['max_post'] ) die( "<span style=\"color: #F00;\">Введите максимальное количество объявлений</span>" );
						$Options = $db->safesql( $Mfo->CompileOpt( $Options ) );
						
						$db->query( "UPDATE ".PREFIX."_mfo_options SET `options`='{$Options}' WHERE `id`='{$id}' LIMIT 1" );
						$Mfo->CleareAllCache();
						
						echo ThisClose();
						echo "<div style=\"padding: 20px;\">Блок отредактирован</div>
<div class=\"hr_line\"></div>
<div style=\"padding: 20px;\">
	<a href=\"$PHP_SELF?mod=mfo&do=blocks\" class=\"btn bg-slate-600 btn-sm btn-raised legitRipple\" style=\"margin-right:5px;\">К списку блоков<a/>
</div>";
					}
						else
					{
						$title = stripslashes( $Mfo->DB['blocks'][ $id ]['title'] );
						$postSort = makeDropDown( array( "asc" => "По порядку", "desc" => "В обратном порядке" ), "post_sort", $Mfo->DB['blocks'][ $id ]['post_sort'] );
						$postType = makeDropDown( array( "default" => "По рейтингу" ), "post_type", $Mfo->DB['blocks'][ $id ]['post_type'] );
						$AllowCats = $Mfo->SelectCategory( explode( ",", $Mfo->DB['blocks'][ $id ]['AllowCats'] ), "", "", "", true );
						$CatsType = makeDropDown( array( "only" => "Только выделенные", "parented" => "С подкатегориями" ), "cats_type", $Mfo->DB['blocks'][ $id ]['cats_type'] );
						$cache = intval( $Mfo->DB['blocks'][ $id ]['cache'] );
						$max_post = intval( $Mfo->DB['blocks'][ $id ]['max_post'] );
						$template = totranslit( $Mfo->DB['blocks'][ $id ]['template'], false, false );
						$postPhoto = makeDropDown( array( "yes" => "Обязательно", "no" => "Не обязательно" ), "post_photo", $Mfo->DB['blocks'][ $id ]['post_photo'] );
		
echo <<<HTML

<form method="post" class="form-horizontal" action="" name="LightWindowForm" onsubmit="formSubmit( 'LightWindowForm', 'blocks/edit.blocks.php', 'LightWindowStatus', 'status.gif', 'LightWindowStatus', 'off' ); return false;">
	<div class="panel-body">
		<div class="form-group">
			<label class="control-label col-sm-2">Название блока: *</label>
				<div class="col-sm-10">
					<input type="text" name="title" value="{$title}" class="form-control width-400 position-left"  />
				</div>
				<div class="clr"></div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-2">Как выводим МФО:</label>
				<div class="col-sm-10">
					{$postType}
				</div>
				<div class="clr"></div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-2">Сортировка:</label>
				<div class="col-sm-10">
					{$postSort}
				</div>
				<div class="clr"></div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-2">Категории:</label>
				<div class="col-sm-10">
					<select name="AllowCats[]" multiple="multiple" style="height: 100px;">
						{$AllowCats}
					</select>
				</div>
				<div class="clr"></div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-2">Тип категорий:</label>
				<div class="col-sm-10">
					{$CatsType}
				</div>
				<div class="clr"></div>
		</div>
		
		<div class="form-group">
			<label class="control-label col-sm-2">Изображения:</label>
				<div class="col-sm-10">
					{$postPhoto}
				</div>
				<div class="clr"></div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-2">Шаблон:*</label>
				<div class="col-sm-10">
					<input type="text" name="template" value="{$template}" class="form-control width-400 position-left"  />
				</div>
				<div class="clr"></div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-2">Максимум МФО:</label>
				<div class="col-sm-10">
					<input type="text" name="max_post" value="{$max_post}" class="form-control width-400 position-left"  />
				</div>
				<div class="clr"></div>
		</div>
		<div class="form-group">
			<label class="control-label col-sm-2">Кэш:</label>
				<div class="col-sm-10">
					<input type="text" name="cache" value="{$cache}" class="form-control width-400 position-left"  />
				</div>
				<div class="clr"></div>
		</div>

HTML;

closetable();	

echo <<<HTML
	<div class="panel-footer">
		<span id="LightWindowStatus" style="padding: 0px 10px 0px 0px;"></span>
		<input type="hidden" name="id" value="{$id}" />
		<input type="submit" name="submit" value="Сохранить" class="btn bg-slate-600 btn-sm btn-raised legitRipple"/>
	</div>
</form>
</div>
HTML;

					}
			}
				else
			{
				echoReturn( "Блока не существует, или он был удалён!" );
			}
	}
		else
	{
		echoReturn( "Не указан идентификатор блока!" );
	}

//-------------------------------------------------====
//	Завершение работы
//-------------------------------------------------====

$db->close();
echofooter();
?>