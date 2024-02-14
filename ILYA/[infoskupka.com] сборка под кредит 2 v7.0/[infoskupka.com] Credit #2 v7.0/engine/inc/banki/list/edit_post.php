<?php

ini_set('display_errors','On');
error_reporting('E_ALL');
if( !defined( "DATALIFEENGINE" ) ) die( "Hacking attempt!" );

echoheader( "<i class=\"fa fa-home position-left\"></i><span class=\"text-semibold\">Редактирование банка</span>","<a href=\"$PHP_SELF?mod=banki\">Каталог банков 7.0</a> / <a href=\"$PHP_SELF?mod=banki&do=post\">Список банков</a>" );

include_once ENGINE_DIR.'/classes/parse.class.php';
$parse = new ParseFilter(Array(), Array(), 1, 1);

$allow_br = isset( $_POST['allow_br'] ) ? intval( $_POST['allow_br'] ) : 0;
$id = intval( $_REQUEST['id'] );
if( $id )
	{
		$result = $db->query( "SELECT * FROM ".PREFIX."_banki_post WHERE id='{$id}'" );
		if( $db->num_rows( $result ) > 0 )
			{
				$row = $db->get_row( $result );
				$title = htmlspecialchars( stripslashes( $row['title'] ), ENT_QUOTES, $config['charset'] );
				$titlelink = htmlspecialchars( stripslashes( $row['titlelink'] ), ENT_QUOTES, $config['charset'] );
				$description = htmlspecialchars( stripslashes( $row['description'] ), ENT_QUOTES, $config['charset'] );
				$title_rek = htmlspecialchars( stripslashes( $row['title_rek'] ), ENT_QUOTES, $config['charset'] );
				$title_rek_seo = htmlspecialchars( stripslashes( $row['title_rek_seo'] ), ENT_QUOTES, $config['charset'] );
				$description_rek = htmlspecialchars( stripslashes( $row['description_rek'] ), ENT_QUOTES, $config['charset'] );
				$title_full = htmlspecialchars( stripslashes( $row['title_full'] ), ENT_QUOTES, $config['charset'] );
				$keywords = htmlspecialchars( stripslashes( $row['keywords'] ), ENT_QUOTES, $config['charset'] );
				$alt_name = htmlspecialchars( stripslashes( $row['alt_name'] ), ENT_QUOTES, $config['charset'] );
				$category = intval( $row['category'] );
				$author_id = intval( $row['author_id'] );
				
				
				
				$approve = intval( $row['approve'] );
				$allow_comm = intval( $row['allow_comm'] );
				$comm_num = intval( $row['comm_num'] );
				$color = htmlspecialchars( stripslashes( $row['color'] ), ENT_QUOTES, $config['charset'] );
				$color_date = intval( $row['color_date'] );
				
				require_once( ENGINE_DIR."/classes/parse.class.php" );
				$parse = new ParseFilter( array(), array(), 1, 1 );
				$text = $row['text'];
				
				
				$color_date = $color_date > 0 ? date( "Y-m-d H:i:s", ( $color_date + ( $config['date_adjust'] * 60 ) ) ) : "";
				
				$SelectCategory = $Banki->SelectCategory( explode( ',', $row['category'] ) );
			
				
				$SelectApprove = SelectList( array( 0 => "Нет", 1 => "Да" ), $approve );
				
				if( isset( $_POST['submit'] ) )
					{
						$EditError = "";
						$LastCategory = $category;
						$title = $db->safesql( htmlspecialchars( stripslashes( $_POST['title'] ), ENT_QUOTES, $config['charset'] ) );
						$titlelink = $db->safesql( htmlspecialchars( stripslashes( $_POST['titlelink'] ), ENT_QUOTES, $config['charset'] ) );
						$description = $db->safesql( htmlspecialchars( stripslashes( $_POST['description'] ), ENT_QUOTES, $config['charset'] ) );
						$keywords = $db->safesql( htmlspecialchars( stripslashes( $_POST['keywords'] ), ENT_QUOTES, $config['charset'] ) );
						$title_rek = $db->safesql( htmlspecialchars( stripslashes( $_POST['title_rek'] ), ENT_QUOTES, $config['charset'] ) );
						$title_rek_seo = $db->safesql( htmlspecialchars( stripslashes( $_POST['title_rek_seo'] ), ENT_QUOTES, $config['charset'] ) );
						$description_rek = $db->safesql( htmlspecialchars( stripslashes( $_POST['description_rek'] ), ENT_QUOTES, $config['charset'] ) );
						$title_full = $db->safesql( htmlspecialchars( stripslashes( $_POST['title_full'] ), ENT_QUOTES, $config['charset'] ) );
						
						$alt_name = $_POST['alt_name'] != "" ? totranslit( $_POST['alt_name'] ) : totranslit( $title );
						$text = $db->safesql( $_POST['text']);
						if (!count($_REQUEST['SelectCategory'])) {
							$SelectCategory = array();
							$SelectCategory[] = '0';
						}
						else {
							$SelectCategory = $_REQUEST['SelectCategory'];
						}
						
						$category = $db->safesql(implode(',', $SelectCategory));
						
						

						
						$author_id = intval( $_POST['author_id'] );
						$approve = intval( $_POST['approve'] );
						$noDel = $_POST['no_del'] == 1 ? 1 : 0;		
						$color = $db->safesql( stripslashes( $_POST['color'] ) );
						$color_date = $_POST['color_date'] != "" ? $db->safesql( strtotime( $_POST['color_date'] ) ) : "";
			
						
						if( !$title ) $EditError .= "<li>Введите название банка.</li>";
						
						
						if( $Banki->Config['add_post_email'] == "yes" && empty( $email ) ) $AddError .= "<li>Email адрес введён не верно.</li>";
						if( !preg_match('/^([a-z0-9])(([-a-z0-9._])*([a-z0-9]))*\@([a-z0-9])'.'(([a-z0-9-])*([a-z0-9]))+' . '(\.([a-z0-9])([-a-z0-9_-])?([a-z0-9])+)+$/i', $email ) && !empty( $email ) ) $EditError .= "<li>Email адрес введён не верно.</li>";
						if( !preg_match( "/^http:\/\/([-.a-z0-9]*)\.([a-z]{2,4})(\/?)*$/", $http ) ) $http = "";
						if( !$text ) $EditError .= "<li>Введите описание банка.</li>";
						
						if( count( $phone ) < 1 && $Banki->Config['add_post_phone'] == "yes" ) $AddError .= "<li>Укажите телефон.</li>";
						
						if( $Banki->Field !== false && empty( $EditError ) )
							{
								$xfields = $db->safesql( $Banki->Field->SaveField( "edit", $row['xfields'], $category ) );
								if( $Banki->Field->ErrorSave ) $EditError .= $Banki->Field->ErrorSave;
							}
							
						if( empty( $EditError ) )
							{
								if( $LastCategory != $category )
									{
										$Banki->AddPostCategory( $category );
										$Banki->DelPostCategory( $LastCategory );
									}
								
								$LinkPost = $Banki->ReturnLinkPost( $id, $alt_name, $category );
								$db->query( "UPDATE ".PREFIX."_banki_post SET `title`='{$title}', `title_full`='{$title_full}', `titlelink`='{$titlelink}', `description`='{$description}', `keywords`='{$keywords}', `title_rek`='{$title_rek}', `title_rek_seo`='{$title_rek_seo}', `description_rek`='{$description_rek}', `author_id`='{$author_id}', `alt_name`='{$alt_name}', `category`='{$category}', `text`='{$text}', `approve`='{$approve}', `xfields`='{$xfields}', `color`='{$color}', `color_date`='{$color_date}' WHERE id='{$id}'" );
								
								miniloader( "Редактирование банка" );
								opentable();
								tableheader( "Редактирование банка" );
								
								echo "<div style=\"padding: 20px;\">Банк успешно отредактирован</div><div class=\"hr_line\"></div><div style=\"padding: 20px;\"><a href=\"$PHP_SELF?mod=banki&do=edit_post&id={$id}\" class=\"btn bg-slate-600 btn-sm btn-raised legitRipple\">Вернуться назад</a> <a href=\"$PHP_SELF?mod=banki&do=post\" target=\"_blank\" class=\"btn bg-slate-600 btn-sm btn-raised legitRipple\">Список банков<a/></div>";
								
								closetable();
								minifooter();							
							}
								else
							{
								miniloader( "Редактирование банка" );
								opentable();
								tableheader( "Редактирование банка" );
								
								echo "<div style=\"padding: 20px;\"><ol style=\"color: #F00; padding: 0px 0px 0px 20px; margin: 0px;\">{$EditError}</ol></div><div class=\"hr_line\"></div><div style=\"padding: 20px;\"><a href=\"$PHP_SELF?mod=banki&do=edit_post&id={$id}\" class=\"btn bg-slate-600 btn-sm btn-raised legitRipple\">Вернуться назад</a></div>";
								
								closetable();
								minifooter();
							}
					}
						else
					{
						miniloader( "Редактирование банка" );

						
						
						$PhotoMainTemplate = <<<HTML
						<div class="BankiImages">
							<div class="List" style="border: 1px solid #ddd; margin: 10px 0; padding: 20px 0;" id="BankiImages">{photos}</div>
							<div>
								<input type="button"  id="BankiUploadPhotos" value="Загрузить лого" class="btn bg-teal btn-sm btn-raised legitRipple" />
								<span id="StatusBankiUploadPhotos">&nbsp;</span>
							</div>
						</div>	
HTML;

						$PhotoListTemplate = <<<HTML
						{photo}
						[del]<span class="btn bg-danger btn-sm btn-raised legitRipple"><i class="fa fa-trash-o position-left"></i> Удалить</span>[/del]
HTML;
						
						$Photos = $Banki->BankiNewsImages( $row, $PhotoListTemplate, $PhotoMainTemplate, true, true );
						$noDelChecked = $noDel == 1 ? "checked=\"checked\"" : "";
						
redactor();
		
echo <<<HTML
<script type="text/javascript" src="engine/inc/banki/js/functions.js.php"></script>
<div class="panel panel-default">
	<div class="panel-heading">
		<ul class="nav nav-tabs nav-tabs-solid">
			<li class="active"><a href="#tabhome" data-toggle="tab" class="legitRipple" aria-expanded="true"><i class="fa fa-home position-left"></i> Редактирование</a></li>
			<li class=""><a href="#tabvote" data-toggle="tab" class="legitRipple" aria-expanded="false"><i class="fa fa-bar-chart position-left"></i> Вывод банка</a></li>
			<li id="tab-perimit"><a href="#tabperm" data-toggle="tab" class="legitRipple"><i class="fa fa-tasks position-left"></i> Реквизиты (Доп. поля)</a></li>
		</ul>
        <div class="heading-elements">
	        <ul class="icons-list">
				<li><a href="#" class="panel-fullscreen"><i class="fa fa-expand"></i></a></li>
			</ul>
        </div>
	</div>

	<form method="post" action="" class="form-horizontal" name="BankiPost" enctype="multipart/form-data">
	<div class="panel-tab-content tab-content">
			<div class="tab-pane active" id="tabhome">
				<div class="panel-body">
				<div class="form-group">
					<label class="control-label col-sm-2">Название: *</label>
					<div class="col-sm-10">
						<input type="text" name="title" value="{$title}" class="form-control width-700 position-left"  />
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2">H1: *</label>
					<div class="col-sm-10">
						<input type="text" name="title_full" value="{$title_full}" class="form-control width-700 position-left"  />
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2">SEO title: *</label>
					<div class="col-sm-10">
						<input type="text" name="titlelink" value="{$titlelink}" class="form-control width-700 position-left"  />
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2">SEO description: *</label>
					<div class="col-sm-10">
						<input type="text" name="description" value="{$description}" class="form-control width-700 position-left"  />
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2">SEO keywords: *</label>
					<div class="col-sm-10">
						<input type="text" name="keywords" value="{$keywords}" class="form-control width-700 position-left"  />
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2">Альт. имя: *</label>
					<div class="col-sm-10">
						<input type="text" name="alt_name" value="{$alt_name}" class="form-control width-700 position-left"  />
					</div>
				</div>	
				<hr>
				<div class="form-group">
					<label class="control-label col-sm-2">Отзывы H1: *</label>
					<div class="col-sm-10">
						<input type="text" name="title_rek" value="{$title_rek}" class="form-control width-700 position-left"  />
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2">SEO title (Отзывы): *</label>
					<div class="col-sm-10">
						<input type="text" name="title_rek_seo" value="{$title_rek_seo}" class="form-control width-700 position-left"  />
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-sm-2">SEO description (Отзывы): *</label>
					<div class="col-sm-10">
						<input type="text" name="description_rek" value="{$description_rek}" class="form-control width-700 position-left"  />
					</div>
				</div>
				<hr>
				<div class="form-group">
					<label class="control-label col-sm-2">Категории:</label>
					<div class="col-sm-10">
						<select name="SelectCategory[]" id="BankiSelectCategory" multiple="multiple" onkeyup="CategorySelect();" onkeydown="CategorySelect();" onchange="CategorySelect();">{$SelectCategory}</select>
						
					</div>
				</div>
		
				
HTML;
			if( $config['allow_admin_wysiwyg'] ) {
                         $bb_editor = true;
						include (ENGINE_DIR . '/inc/include/inserttag.php');
			}
						
echo <<<HTML
				<div class="form-group">
					<label class="control-label col-sm-2">Описание: *</label>
					<div class="col-sm-10">
						<div class="editor-panel"><div class="shadow-depth1">
							<textarea class="set_tinyMCE"  name="text" id="BankiStory" onfocus="setFieldName(this.name)" style="width: 100%; height: 520px;">{$text}</textarea>
						</div></div>
					</div>
				</div>	
				<hr>
				<div class="form-group">
					<label class="control-label col-sm-2">Лого:</label>
					<div class="col-sm-10">
						$Photos[list]
					</div>
				</div>	
			</div>
		</div>
		<div class="tab-pane" id="tabvote">
			<div class="panel-body">
				<div class="form-group">
					<label class="control-label col-sm-2">Показывать банк на сайте:</label>
					<div class="col-sm-10">
						<select name="approve">{$SelectApprove}</select>
					</div>
				</div>
			</div>
				</div>
		
			<div class="tab-pane" id="tabperm">
		<div class="panel-body">
							
							
							
			
HTML;

$XfieldsTemplate = <<<HTML

<div class="form-group" {id}>
					<label class="control-label col-sm-2">{title}:[required] *[/required]</label>
					<div class="col-sm-10">
						{form}
					</div>
				</div>

HTML;
						if( $Banki->Field !== false )
							{
								$Xfields = $Banki->Field->ShowForm( "edit", $XfieldsTemplate, $row['xfields'] );
								$CategoryJS = $Banki->Field->ReturnCategoryJS();
								if( $Xfields )
									{
										$Xfields = "<tr><td colspan=\"10\" background=\"engine/skins/images/mline.gif\" height=\"1\"></td></tr><tr><td colspan=\"10\"><div class=\"hr_line\"></div></td></tr><tr><td colspan=\"10\" background=\"engine/skins/images/mline.gif\" height=\"1\"></td></tr>{$Xfields}<tr><td colspan=\"10\"><div class=\"hr_line\"></div></td></tr><tr><td colspan=\"10\" background=\"engine/skins/images/mline.gif\" height=\"1\"></td></tr>";	
									}
										else
									{
										$Xfields = "<tr><td style=\"padding: 10px;\">Дополнительных полей не обнаружено.</td></tr>";
									}
							}
								else
							{
								$Xfields = "<tr><td style=\"padding: 10px;\">Дополнительные поля в настоящий момент отключены.</td></tr>";
							}
			
						echo EchoAJAX( true );
						echo EchoJSColor();

echo <<<HTML
	
					
					{$Xfields}
						</div>
				</div>
		</div>
	<div class="panel-footer hidden-xs">
		<div class="pull-left">
		<ul class="pagination pagination-sm">
		<input type="submit" name="submit" value="Сохранить" class="btn bg-brown-600 btn-sm btn-raised legitRipple" />
		
				
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
			}
				else
			{
				minimsg( "Редактирование банка", "Указанный банк не найден." );	
			}
	}
		else
	{
		minimsg( "Редактирование банка", "Вы не указали идентификатор банка." );	
	}

?>