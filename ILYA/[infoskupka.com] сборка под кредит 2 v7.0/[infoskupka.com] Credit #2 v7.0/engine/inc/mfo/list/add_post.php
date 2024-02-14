<?php


if( !defined( "DATALIFEENGINE" ) ) die( "Hacking attempt!" );

echoheader( "<i class=\"fa fa-home position-left\"></i><span class=\"text-semibold\">Добавление МФО</span>","<a href=\"$PHP_SELF?mod=mfo\">Каталог МФО 7.0</a> / <a href=\"$PHP_SELF?mod=mfo&do=post\">Список МФО</a>" );

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
						$category = intval( $_POST['category'] );
						
						if( $row['allow_br'] != '1' OR $config['allow_admin_wysiwyg'] ) {
							$row['text'] = $parse->decodeBBCodes( $row['text'], true, $config['allow_admin_wysiwyg'] );
						} else {
							$row['text'] = $parse->decodeBBCodes( $row['text'], false );
						}
						
						$author_id = intval( $_POST['author_id'] );
						
						
						$color = $db->safesql( stripslashes( $_POST['color'] ) );
						$color_date = $_POST['color_date'] != "" ? $db->safesql( strtotime( $_POST['color_date'] ) ) : "";
			
						
						if( !$title ) $EditError .= "<li>Введите название МФО.</li>";
						
						
						
						if( $Mfo->Field !== false && empty( $EditError ) )
							{
								$xfields = $db->safesql( $Mfo->Field->SaveField( "edit", $row['xfields'], $category ) );
								if( $Mfo->Field->ErrorSave ) $EditError .= $Mfo->Field->ErrorSave;
							}
							
						if( empty( $EditError ) )
							{
								
								$Mfo->AddPostCategory( $category );
								$LinkPost = $Mfo->ReturnLinkPost( $id, $alt_name, $category );
								$db->query( "INSERT INTO ".PREFIX."_mfo_post (`title`,`alt_name`,`text`,`author`,`author_id`,`category`,`allow_comm`,`xfields`,`photos`,`approve`) VALUES ('{$title}','{$alt_name}','{$text}','{$author}','{$author_id}','{$category}','1','{$xfields}','{$images}','{$Approve}')" );
								miniloader( "Добавление МФО" );
								opentable();
								tableheader( "Добавление МФО" );
								
								echo "<div style=\"padding: 20px;\">МФО успешно добавлен</div><div class=\"hr_line\"></div><div style=\"padding: 20px;\"><a href=\"$PHP_SELF?mod=mfo&do=post\" class=\"btn bg-slate-600 btn-sm btn-raised legitRipple\">Список МФО</a> <a href=\"$PHP_SELF?mod=mfo&do=add_post\" class=\"btn bg-slate-600 btn-sm btn-raised legitRipple\">Добавить еще<a/></div>";
								
								closetable();
								minifooter();							
							}
								else
							{
								miniloader( "Добавление МФО" );
								opentable();
								tableheader( "Добавление МФО" );
								
								echo "<div style=\"padding: 20px;\"><ol style=\"color: #F00; padding: 0px 0px 0px 20px; margin: 0px;\">{$EditError}</ol></div><div class=\"hr_line\"></div><div style=\"padding: 20px;\"><a href=\"javascript:history.go(-1)\">Вернуться назад</a></div>";
								
								closetable();
								minifooter();
							}
					}
						else
					{
						miniloader( "Добавление МФО" );
						opentable();
						tableheader( "Добавление МФО" );
						include_once( ENGINE_DIR."/modules/mfo/editor/bb_news.php" );
						$bb_code = str_replace( "{THEME}", "templates/{$config['skin']}", $bb_code );
						$SelectCategory = $Mfo->SelectCategory( $Mfo->RequestCat );
						$PhotoMainTemplate = <<<HTML
						<div class="MfoImages">
							<div class="List" id="MfoImages">{photos}</div>
							<div>
								<input type="button" id="MfoUploadPhotos" value="Загрузить лого" class="edit" />
								<span id="StatusMfoUploadPhotos">&nbsp;</span>
							</div>
						</div>	
HTML;

						$PhotoListTemplate = <<<HTML
						{photo}
						[del]Удалить[/del]
HTML;
						
						$Photos = $Mfo->MfoNewsImages( $row, $PhotoListTemplate, $PhotoMainTemplate, true, true );
						$noDelChecked = $noDel == 1 ? "checked=\"checked\"" : "";
		
echo <<<HTML


<form method="post" action="" class="form-horizontal" name="MfoPost" enctype="multipart/form-data">
	
		<div class="panel-body">
			<div class="tab-pane active" id="tabhome">
				<div class="form-group">
					<label class="control-label col-sm-2">Название: *</label>
					<div class="col-sm-10">
						<input type="text" name="title" value="{$title}" class="form-control width-700 position-left"  />
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2">Альт. имя: (Формируется автоматом)</label>
					<div class="col-sm-10">
						<input type="text" name="alt_name" value="{$alt_name}" class="form-control width-700 position-left"  />
					</div>
				</div>	
				
			

					
				</div>
		</div>
	<div class="panel-footer hidden-xs">
		<div class="pull-left">
		<ul class="pagination pagination-sm">
		<input type="submit" name="submit" value="Добавить МФО в базу" class="btn bg-brown-600 btn-sm btn-raised legitRipple" />
		
				
		</ul>
		</div>
		<div class="pull-right">
		

		</div>
	</div>	
	
</form>
<script type="text/javascript">
	var cal_language   = {en:{months:['Январь','Февраль','Март','Апрель','Май','Июнь','Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь'],dayOfWeek:["Вс", "Пн", "Вт", "Ср", "Чт", "Пт", "Сб"]}};
	{$CategoryJS}
	MfoFieldsSetCategory();
</script>
HTML;

						echo $Photos['js'];
						echo $JSMfoType;
						closetable();
						echofooter();
						minifooter();
					}

?>