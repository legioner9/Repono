<?php


//-------------------------------------------------====
//	Инициализация
//-------------------------------------------------====

define( "ROOT_DIR", "../../.." );
define( "ENGINE_DIR", "../.." );

$OptAjax = array(
	"tpl"	=> true,
);

require_once( ENGINE_DIR."/ajax/mfo/OptAjax.php" );

//-------------------------------------------------====
//	Принятие и проверка данных
//-------------------------------------------------====

$postID = intval( $_REQUEST['PostID'] );
if( $postID )
	{
		$row = $db->super_query( "SELECT `id`,`author`,`author_id`,`photos`,`approve` FROM ".PREFIX."_mfo_post WHERE `id`='{$postID}'" );
		if( !$row['id'] ) echoReturn( "Объявление не обнаружено!" );
		if( !$Mfo->AllowEditPost( $row['author_id'], $row['approve'] ) ) echoReturn( "Вы не можете редактировать данное объявление!" );
	}
		else
	{
		if( !$Mfo->AllowAddPost() ) echoReturn( "Вы не можете добавлять объявления!" );
	}

//-------------------------------------------------====
//	Настройки
//-------------------------------------------------====

$ThumbPhotoSize = $Mfo->Config['add_post_thumb_photo']; // Размер уменьшенной картинки в px
$MaxPhotoKB = $Mfo->Config['add_post_size_photo'] * 1024; // Максимальное размер загружаемой фотки в байтах (при умножении на 1024 получается в КБ)
$AllowedExtensions = explode( ",", $Mfo->Config['add_post_photo_type'] ); // Разрешённые типы картинок
$admin = intval( $_REQUEST['admin'] );
if( $admin == 1 && $member_id['user_group'] != 1 ) echoReturn( "Ошибка доступа!" );

//-------------------------------------------------====
//	Загрузка фотографии
//-------------------------------------------------====
		
if( $_REQUEST['upload'] == 1 )
	{
		$countPhoto = $Mfo->CountImages( $row['photos'] );
		if( $countPhoto >= $Mfo->Config['add_post_max_photo'] && !$admin ) echoReturn( "Вы достигли лимита изображений для одного объявления, удалите существующие, чтобы загрузить новые!" );
		
		$FolderPrefix = date( "Y-m" );
		$Folder = ROOT_DIR."/uploads/mfo/post/{$FolderPrefix}";
		$ThumbsFolder = "{$Folder}/thumbs";
		
		if( !is_dir( $Folder ) ) mkdir( $Folder, 0777 );
		if( !is_dir( $ThumbsFolder ) ) mkdir( $ThumbsFolder, 0777 );
		
		$MaxFileSize = intval( intval( @ini_get( "upload_max_filesize" ) ) * 1024 * 1024 );
				
		//	Инфо о фотографии
				
		$image = $_FILES['Filedata']['tmp_name'];
		$image_size = $_FILES['Filedata']['size'];
		$type = end( explode( ".", $_FILES['Filedata']['name'] ) );
		$image_name = explode( ".", str_replace( " ", "_", $_FILES['Filedata']['name'] ) );
		$image_name = totranslit( $image_name[0] );
				
		$Prefix = time() + rand( 1, 500 );
		$DbFile = "{$image_name}.{$type}";
		$ImageFile = "{$Folder}/{$Prefix}_{$DbFile}";
		$ImageThumbFile = "{$ThumbsFolder}/{$Prefix}_{$DbFile}";
				
		// Если фотка весит больше, чем возможно
		if( $image_size > $MaxFileSize || $image_size > $MaxPhotoKB ) echoReturn( "Изображение весит больше, чем разрешено загружать на сервер!" );
				
		//	Начало загрузки фото
				
		if( is_uploaded_file( $image ) ) 
			{
				if( ( in_array( strtolower( $type ), $AllowedExtensions ) ) && $image_name )
					{
						if( !file_exists( ROOT_DIR.$ImageFile ) )
							{
								require_once( ENGINE_DIR."/classes/thumb.class.php" );
								$res = @move_uploaded_file( $image, $ImageFile );
								if( $res ) 
									{											
										$thumb = new thumbnail( $ImageFile );
										$thumb->jpeg_quality( 80 );
										$thumb->size_auto( $ThumbPhotoSize );
										$thumb->save( $ImageThumbFile );
										
										@chmod( $ImageThumbFile, 0666 );
										@chmod( $ImageFile, 0666 );
										
										$Photo = "{$Prefix}_{$DbFile}";
										$Mfo->AddPhotosInfoDB( $Photo, $FolderPrefix, $row );
										
										//	Настройка шаблонов
										
										if( $admin )
											{
												$PhotoEcho = "{photo}[del]<img src=\"engine/inc/mfo/style/images/delete.png\" class=\"del\" alt=\"Удалить\" />[/del]";
												$PhotoEcho = str_replace( "{photo}", "<a href=\"/uploads/mfo/post/{$FolderPrefix}/{$Photo}\" target=\"_blank\"><img src=\"/uploads/mfo/post/{$FolderPrefix}/thumbs/{$Photo}\" alt=\"\" /></a>", $PhotoEcho );
												
												$PhotoEcho = str_replace( "[del]", "<a href=\"javascript:void(0);\" onclick=\"DelMfoPhoto( '{$Photo}', '{$row['id']}' ); return false;\">", $PhotoEcho );
												$PhotoEcho = str_replace( "[/del]", "</a>", $PhotoEcho );
												$PhotoEcho = "<div id=\"{$Photo}\">{$PhotoEcho}</div>";
												
												echo $PhotoEcho;
											}
												else
											{
												$tpl->Load_Template( "mfo/main/add_photos/photo.list.tpl" );
												$tpl->copy_template = "<div id=\"{$Photo}\">".$tpl->copy_template."</div>";
												$tpl->set( "{photo}", "<a href=\"/uploads/mfo/post/{$FolderPrefix}/{$Photo}\" target=\"_blank\" onclick=\"return hs.expand(this)\"><img src=\"/uploads/mfo/post/{$FolderPrefix}/thumbs/{$Photo}\" alt=\"\" /></a>" );
												$tpl->set( "{photo:thumb}", "/uploads/mfo/post/{$FolderPrefix}/thumbs/{$Photo}" );
												$tpl->set( "{photo:url}", "/uploads/mfo/post/{$FolderPrefix}/{$Photo}" );
												$tpl->set( "{photo:name}", $Photo );
														
												$tpl->set( "[del]", "<a href=\"javascript:void(0);\" onclick=\"DelMfoPhoto( '{$Photo}', '{$row['id']}' ); return false;\">" );
												$tpl->set( "[/del]", "</a>" );
														
												$tpl->compile( "result" );
												$tpl->clear();
														
												$tpl->result['result'] = str_replace( "{THEME}", "/templates/{$Skin}", $tpl->result['result'] );
												echo $tpl->result['result'];
											}
									}
										else
									{ 
										echoReturn( "Картинка не загружена." );
									}
							}
								else
							{
								echoReturn( "Файл с таким же именем уже существует." );	
							}
					} 
						else
					{
						echoReturn( "Только JPG, PNG, GIF или SWF!" );
					}
			}
				else
			{
				echoReturn( "Файл не может быть загружен." );
			}
	}
elseif( $_REQUEST['del'] == 1 )
	{
		$PhotoType = explode( ".", $_REQUEST['Photo'] );
		$PhotoType = end( $PhotoType );
		if( !in_array( strtolower( $PhotoType ), array( "gif", "png", "jpg", "jpeg" ) ) ) die( "Недопустимое изображение" );
		$Photo = totranslit( str_replace( ".{$PhotoType}", "", $_REQUEST['Photo'] ), false, false );
		
		if( !$Photo ) die( "Ошибка удаления фотографии" );
		$Photo .= ".{$PhotoType}";
		
		$PhotoDel = "";
		$PhotoThumbsDel = "";
		
		$user = !$is_logged ? $_SERVER['REMOTE_ADDR'] : $member_id['name'];
		if( !$row['id'] )
			{
				$fileDB = ENGINE_DIR."/data/mfo/photos.db";
				$file = file( $fileDB );
				for( $i = 0; $i < count( $file ); $i++ )
					{
						$image = explode( "==", $file[ $i ] );
						if( $image[0] != $user && $edit !== true ) continue;
						$image[1] = explode( "|||", $image[1] );
						if( $image[1][0] != $Photo ) continue;
						
						$PhotoDel = ROOT_DIR."/uploads/mfo/post/{$image[1][1]}/{$image[1][0]}";
						$PhotoThumbsDel = ROOT_DIR."/uploads/mfo/post/{$image[1][1]}/thumbs/{$image[1][0]}";
						unset( $file[ $i ] );
					}	
				
				if( $PhotoDel )
					{
						unlink( $fileDB );
						$fp = fopen( $fileDB, "a" );
						fwrite( $fp, implode( "", $file ) );
						fclose( $fp );
						@chmod( $fileDB, 0666 );
					}
			}
				else
			{
				$photos = explode( "|||", $row['photos'] );
				for( $i = 0; $i < count( $photos ); $i++ )
					{
						$img = explode( "###", $photos[ $i ] );
						if( $img[0] != $Photo ) continue;
						
						$PhotoDel = ROOT_DIR."/uploads/mfo/post/{$img[1]}/{$img[0]}";
						$PhotoThumbsDel = ROOT_DIR."/uploads/mfo/post/{$img[1]}/thumbs/{$img[0]}";
						unset( $photos[ $i ] );
					}
					
				$photos = $db->safesql( implode( "|||", $photos ) );
				$db->query( "UPDATE ".PREFIX."_mfo_post SET `photos`='{$photos}' WHERE `id`='{$row['id']}'" );
			}
		
		if( $PhotoDel )
			{
				unlink( $PhotoDel );
				unlink( $PhotoThumbsDel );
				die();
			}
													
		die( "Ошибка удаления файла!" );
	}
		
//-------------------------------------------------====
//	Вывод результата
//-------------------------------------------------====
		
die();

?>