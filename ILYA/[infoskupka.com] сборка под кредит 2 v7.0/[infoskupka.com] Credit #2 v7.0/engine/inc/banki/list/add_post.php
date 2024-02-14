<?php


if( !defined( "DATALIFEENGINE" ) ) die( "Hacking attempt!" );

echoheader( "<i class=\"fa fa-home position-left\"></i><span class=\"text-semibold\">Добавление банка</span>","<a href=\"$PHP_SELF?mod=banki\">Каталог банков 7.0</a> / <a href=\"$PHP_SELF?mod=banki&do=post\">Добавление банка</a>" );

include_once ENGINE_DIR.'/classes/parse.class.php';
$parse = new ParseFilter(Array(), Array(), 1, 1);
$allow_br = isset( $_POST['allow_br'] ) ? intval( $_POST['allow_br'] ) : 0;

if( isset( $_POST['submit'] ) )
					{
						$EditError = "";
					
						$title = $db->safesql( htmlspecialchars( stripslashes( $_POST['title'] ), ENT_QUOTES, $config['charset'] ) );
						$titlelink = $db->safesql( htmlspecialchars( stripslashes( $_POST['titlelink'] ), ENT_QUOTES, $config['charset'] ) );
						$description = $db->safesql( htmlspecialchars( stripslashes( $_POST['description'] ), ENT_QUOTES, $config['charset'] ) );
						$title_rek = htmlspecialchars( stripslashes( $row['title_rek'] ), ENT_QUOTES, $config['charset'] );
						$title_rek_seo = htmlspecialchars( stripslashes( $row['title_rek_seo'] ), ENT_QUOTES, $config['charset'] );
						$description_rek = htmlspecialchars( stripslashes( $row['description_rek'] ), ENT_QUOTES, $config['charset'] );
						$title_full = htmlspecialchars( stripslashes( $row['title_full'] ), ENT_QUOTES, $config['charset'] );
			
						$keywords = $db->safesql( htmlspecialchars( stripslashes( $_POST['keywords'] ), ENT_QUOTES, $config['charset'] ) );
						$alt_name = $_POST['alt_name'] != "" ? totranslit( $_POST['alt_name'] ) : totranslit( $title );
						$category = intval( $_POST['category'] );
						
						if( $row['allow_br'] != '1' OR $config['allow_admin_wysiwyg'] ) {
							$row['text'] = $parse->decodeBBCodes( $row['text'], true, $config['allow_admin_wysiwyg'] );
						} else {
							$row['text'] = $parse->decodeBBCodes( $row['text'], false );
						}
						
						$author_id = intval( $_POST['author_id'] );
						
						
						
						$color = $db->safesql( stripslashes( $_POST['color'] ) );
						$color_date = $_POST['color_date'] != "" ? $db->safesql( strtotime( $_POST['color_date'] ) ) : "";
			
						
						if( !$title ) $EditError .= "<li>Введите название банка.</li>";
						
						
						
						if( $Banki->Field !== false && empty( $EditError ) )
							{
								$xfields = $db->safesql( $Banki->Field->SaveField( "edit", $row['xfields'], $category ) );
								if( $Banki->Field->ErrorSave ) $EditError .= $Banki->Field->ErrorSave;
							}
							
						if( empty( $EditError ) )
							{
								
								$Banki->AddPostCategory( $category );
								$LinkPost = $Banki->ReturnLinkPost( $id, $alt_name, $category );
								$db->query( "INSERT INTO ".PREFIX."_banki_post (`title`, `title_full`, `titlelink`, `description`, `keywords`, `title_rek`, `alt_name`,`text`,`author`,`author_id`,`category`,`allow_comm`,`xfields`,`photos`,`approve`) VALUES ('{$title}','{$title_full}','{$titlelink}','{$description}','{$keywords}','{$title_rek}','{$alt_name}','{$text}','{$author}','{$author_id}','{$category}','1','{$xfields}','{$images}','{$Approve}')" );
								miniloader( "Добавление банка" );
								opentable();
								tableheader( "Добавление банка" );
								
								echo "<div style=\"padding: 20px;\">Банк успешно добавлен</div><div class=\"hr_line\"></div><div style=\"padding: 20px;\"><a href=\"$PHP_SELF?mod=banki&do=post\" class=\"btn bg-slate-600 btn-sm btn-raised legitRipple\">Список банков</a> <a href=\"$PHP_SELF?mod=banki&do=add_post\" class=\"btn bg-slate-600 btn-sm btn-raised legitRipple\">Добавить еще<a/></div>";
								
								closetable();
								minifooter();							
							}
								else
							{
								miniloader( "Добавление банка" );
								opentable();
								tableheader( "Добавление банка" );
								
								echo "<div style=\"padding: 20px;\"><ol style=\"color: #F00; padding: 0px 0px 0px 20px; margin: 0px;\">{$EditError}</ol></div><div class=\"hr_line\"></div><div style=\"padding: 20px;\"><a href=\"javascript:history.go(-1)\">Вернуться назад</a></div>";
								
								closetable();
								minifooter();
							}
					}
						else
					{
						miniloader( "Добавление банка" );
						opentable();
						tableheader( "Добавление банка" );
						include_once( ENGINE_DIR."/modules/banki/editor/bb_news.php" );
						$bb_code = str_replace( "{THEME}", "templates/{$config['skin']}", $bb_code );
						$SelectCategory = $Banki->SelectCategory( $Banki->RequestCat );
						$PhotoMainTemplate = <<<HTML
						<div class="BankiImages">
							<div class="List" id="BankiImages">{photos}</div>
							<div>
								<input type="button" id="BankiUploadPhotos" value="Загрузить лого" class="edit" />
								<span id="StatusBankiUploadPhotos">&nbsp;</span>
							</div>
						</div>	
HTML;

						$PhotoListTemplate = <<<HTML
						{photo}
						[del]Удалить[/del]
HTML;
						
						$Photos = $Banki->BankiNewsImages( $row, $PhotoListTemplate, $PhotoMainTemplate, true, true );
						$noDelChecked = $noDel == 1 ? "checked=\"checked\"" : "";
		
echo <<<HTML


<form method="post" action="" class="form-horizontal" name="BankiPost" enctype="multipart/form-data">
	
		<div class="panel-body">
			<div class="tab-pane active" id="tabhome">
				<div class="form-group">
					<label class="control-label col-sm-2">Название: *</label>
					<div class="col-sm-10">
						<input type="text" name="title" value="{$title}" class="form-control width-700 position-left"  />
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2">Альт. имя: (формируется автоматом)</label>
					<div class="col-sm-10">
						<input type="text" name="alt_name" value="{$alt_name}" class="form-control width-700 position-left"  />
					</div>
				</div>	
				
			

					
				</div>
		</div>
	<div class="panel-footer hidden-xs">
		<div class="pull-left">
		<ul class="pagination pagination-sm">
		<input type="submit" name="submit" value="Добавить банк в базу" class="btn bg-brown-600 btn-sm btn-raised legitRipple" />
		
				
		</ul>
		</div>
		<div class="pull-right">
		

		</div>
	</div>	
	
</form>
<script type="text/javascript">
	var cal_language   = {en:{months:['Январь','Февраль','Март','Апрель','Май','Июнь','Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь'],dayOfWeek:["Вс", "Пн", "Вт", "Ср", "Чт", "Пт", "Сб"]}};
	{$CategoryJS}
	BankiFieldsSetCategory();
</script>
HTML;

						echo $Photos['js'];
						echo $JSBankiType;
						closetable();
						echofooter();
						minifooter();
					}

?>