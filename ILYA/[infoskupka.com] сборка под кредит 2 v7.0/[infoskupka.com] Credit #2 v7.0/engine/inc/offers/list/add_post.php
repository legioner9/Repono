<?php


if( !defined( "DATALIFEENGINE" ) ) die( "Hacking attempt!" );

echoheader( "<i class=\"fa fa-home position-left\"></i><span class=\"text-semibold\">Добавление оффера</span>","<a href=\"$PHP_SELF?mod=offers\">Каталог офферов 7.0</a> / <a href=\"$PHP_SELF?mod=offers&do=post\">Список офферов</a>" );

include_once ENGINE_DIR.'/classes/parse.class.php';
$parse = new ParseFilter(Array(), Array(), 1, 1);
$allow_br = isset( $_POST['allow_br'] ) ? intval( $_POST['allow_br'] ) : 0;

if( isset( $_POST['submit'] ) )
					{
						$EditError = "";
					
						$title = $db->safesql( htmlspecialchars( stripslashes( $_POST['title'] ), ENT_QUOTES, $config['charset'] ) );
						$titlelink = $db->safesql( htmlspecialchars( stripslashes( $_POST['titlelink'] ), ENT_QUOTES, $config['charset'] ) );
						$description = $db->safesql( htmlspecialchars( stripslashes( $_POST['description'] ), ENT_QUOTES, $config['charset'] ) );
						$keywords = $db->safesql( htmlspecialchars( stripslashes( $_POST['keywords'] ), ENT_QUOTES, $config['charset'] ) );
						$alt_name = $_POST['alt_name'] != "" ? totranslit( $_POST['alt_name'] ) : totranslit( $title );
						$text = $db->safesql( $parse->BB_Parse( $parse->process( strip_tags( $_POST['text'] ) ), false ) );
						$date = $db->safesql( htmlspecialchars( stripslashes( $_POST['date'] ), ENT_QUOTES, $config['charset'] ) );
						$end_date = $db->safesql( htmlspecialchars( stripslashes( $_POST['end_date'] ), ENT_QUOTES, $config['charset'] ) );
						$category = intval( $_POST['category'] );
						
						if( $row['allow_br'] != '1' OR $config['allow_admin_wysiwyg'] ) {
							$row['text'] = $parse->decodeBBCodes( $row['text'], true, $config['allow_admin_wysiwyg'] );
						} else {
							$row['text'] = $parse->decodeBBCodes( $row['text'], false );
						}
						
						$author_id = intval( $_POST['author_id'] );
						
						$noDel = intval( $row['no_del'] );
						$noDel = $_POST['no_del'] == 1 ? 1 : 1;
						
						
						$color = $db->safesql( stripslashes( $_POST['color'] ) );
						$color_date = $_POST['color_date'] != "" ? $db->safesql( strtotime( $_POST['color_date'] ) ) : "";
			
						
						if( !$title ) $EditError .= "<li>Введите название оффера.</li>";

						
						
						if( $Offers->Field !== false && empty( $EditError ) )
							{
								$xfields = $db->safesql( $Offers->Field->SaveField( "edit", $row['xfields'], $category ) );
								if( $Offers->Field->ErrorSave ) $EditError .= $Offers->Field->ErrorSave;
							}
							
						if( empty( $EditError ) )
							{
								
								$Offers->AddPostCategory( $category );
								$LinkPost = $Offers->ReturnLinkPost( $id, $alt_name, $category );
								$db->query( "INSERT INTO ".PREFIX."_offers_post (`title`, `titlelink`, `description`, `keywords`, `alt_name`,`text`,`author`,`author_id`,`category`,`allow_comm`,`xfields`,`photos`,`approve`) VALUES ('{$title}','{$title_full}','{$description}','{$keywords}','{$alt_name}','{$text}','{$author}','{$author_id}','{$category}','1','{$xfields}','{$images}','{$Approve}')" );
								miniloader( "Добавление оффера" );
								opentable();
								tableheader( "Добавление оффера" );
								
								echo "<div style=\"padding: 20px;\">Оффер успешно добавлен</div><div class=\"hr_line\"></div><div style=\"padding: 20px;\"><a href=\"$PHP_SELF?mod=offers&do=post\" class=\"btn bg-slate-600 btn-sm btn-raised legitRipple\">Список офферов</a> <a href=\"$PHP_SELF?mod=offers&do=add_post\" class=\"btn bg-slate-600 btn-sm btn-raised legitRipple\">Добавить еще<a/></div>";
								
								closetable();
								minifooter();							
							}
								else
							{
								miniloader( "Добавление оффера" );
								opentable();
								tableheader( "Добавление оффера" );
								
								echo "<div style=\"padding: 20px;\"><ol style=\"color: #F00; padding: 0px 0px 0px 20px; margin: 0px;\">{$EditError}</ol></div><div class=\"hr_line\"></div><div style=\"padding: 20px;\"><a href=\"javascript:history.go(-1)\">Вернуться назад</a></div>";
								
								closetable();
								minifooter();
							}
					}
						else
					{
						miniloader( "Добавление оффера" );
						opentable();
						tableheader( "Добавление оффера" );
						include_once( ENGINE_DIR."/modules/offers/editor/bb_news.php" );
						$bb_code = str_replace( "{THEME}", "templates/{$config['skin']}", $bb_code );
						$SelectCategory = $Offers->SelectCategory( $Offers->RequestCat );
						$PhotoMainTemplate = <<<HTML
						<div class="OffersImages">
							<div class="List" id="OffersImages">{photos}</div>
							<div>
								<input type="button" id="OffersUploadPhotos" value="Загрузить лого" class="edit" />
								<span id="StatusOffersUploadPhotos">&nbsp;</span>
							</div>
						</div>	
HTML;

						$PhotoListTemplate = <<<HTML
						{photo}
						[del]Удалить[/del]
HTML;
						
						$Photos = $Offers->OffersNewsImages( $row, $PhotoListTemplate, $PhotoMainTemplate, true, true );
						$noDelChecked = $noDel == 1 ? "checked=\"checked\"" : "";
		
echo <<<HTML


<form method="post" action="" class="form-horizontal" name="OffersPost" enctype="multipart/form-data">
	
		<div class="panel-body">
			<div class="tab-pane active" id="tabhome">
				<div class="form-group">
					<label class="control-label col-sm-2">Название: *</label>
					<div class="col-sm-10">
						<input type="text" name="title" value="{$title}" class="form-control width-700 position-left"  />
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2">Альт. имя (не обязательно): *</label>
					<div class="col-sm-10">
						<input type="text" name="alt_name" value="{$alt_name}" class="form-control width-700 position-left"  />
					</div>
				</div>	
				
			

					
				</div>
		</div>
	<div class="panel-footer hidden-xs">
		<div class="pull-left">
		<ul class="pagination pagination-sm">
		<input type="submit" name="submit" value="Добавить оффер" class="btn bg-brown-600 btn-sm btn-raised legitRipple" />
		
				
		</ul>
		</div>
		<div class="pull-right">
		

		</div>
	</div>	
	
</form>
<script type="text/javascript">
	var cal_language   = {en:{months:['Январь','Февраль','Март','Апрель','Май','Июнь','Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь'],dayOfWeek:["Вс", "Пн", "Вт", "Ср", "Чт", "Пт", "Сб"]}};
	{$CategoryJS}
	OffersFieldsSetCategory();
</script>
HTML;

						echo $Photos['js'];
						echo $JSOffersType;
						closetable();
						echofooter();
						minifooter();
					}

?>