<?php


if( !defined( "DATALIFEENGINE" ) ) die( "Hacking attempt!" );

ini_set('display_errors','Off');

class Banki {
	
	var $Config = array();
	var $AllowOptionsType = array( "category", "country", "city", "currency", "banki_type", "banners", "blocks", "comms" );
	var $Field = false;
	
	var $EchoCatOk = array();
	var $SpeedBar = array();
	var $ThreadCatForSql = array();
	var $Navigation = false;
	var $CacheDir = null;
	var $CacheSkin = null;
	var $AltUrl = false;
	var $LoadCityOk = array();
	var $JsCatSelect = false;
	var $EmailClass = false;
	var $EmailTpl = array();
	var $AllowSendEmail = array();
	
	//------------------------------------------------=-=-=-=-=
	//	Инициализация класса
	//------------------------------------------------=-=-=-=-=
	
	function Start(){
		global $is_logged, $member_id, $config;
		include_once ENGINE_DIR . '/classes/plugins.class.php';
		require( ENGINE_DIR."/data/banki.config.php" );
		include( ENGINE_DIR."/data/banki/cron.php" );
		
		$this->Config = $BankiConfig;
		$this->Cron = $BankiCronConfig;
		$this->CacheDir = ENGINE_DIR."/data/banki/cache/";
		$this->CacheSkin = $config['skin'];
		$this->AllowSendEmail = $this->Config['echo_post_author_email'] ? explode( ",", $this->Config['echo_post_author_email'] ) : array();
		
		$this->AllowEditPost = ( in_array( $member_id['user_group'], explode( ",", $this->Config['post_groups_edit'] ) ) ) ? true : false;
		$this->AllowEditAllPost = ( in_array( $member_id['user_group'], explode( ",", $this->Config['post_groups_edit_all'] ) ) ) ? true : false;
		$this->AllowAddPost = ( in_array( $member_id['user_group'], explode( ",", $this->Config['post_groups_add'] ) ) ) ? true : false;
		$this->AllowAddPostCaptcha = ( in_array( $member_id['user_group'], explode( ",", $this->Config['post_groups_captcha'] ) ) ) ? true : false;
		$this->AllowAddPostNoDel = ( in_array( $member_id['user_group'], explode( ",", $this->Config['post_groups_no_del'] ) ) ) ? true : false;
		
		$this->AltUrl = $config['allow_alt_url'] ? true : false;
		
		if( $this->Config['region_on'] != "on" )
			{
				unset( $this->AllowOptionsType[1] );
				unset( $this->AllowOptionsType[2] );
			}
			
		foreach( $this->AllowOptionsType as $type )
			{
				if( !file_exists( ENGINE_DIR."/data/banki/{$type}.php" ) ) $this->CreateDB();
				include_once( ENGINE_DIR."/data/banki/{$type}.php" );
			}
		
		$this->StartField();
		$this->Cron( 120, "cron_time", "CleareAllCache" );
	}
	
	//----------------------------------------------------------=-=-=-=-=
	//	Запуск класса доп. полей блогов
	//----------------------------------------------------------=-=-=-=-=
	
	function StartField( $Necessarily = false ){
		
		if( ( $this->Field === false && $this->Config['field_on'] == "on" ) || ( $Necessarily === true ) )
			{
				include( ENGINE_DIR."/inc/banki/field.class.php" );
				$this->Field = new BankiField( ENGINE_DIR."/data/banki/fields.banki.db" );
			}
	}
	
	//------------------------------------------------=-=-=-=-=
	//	Сохранение конфигов
	//------------------------------------------------=-=-=-=-=
	
	function SaveConfig( $Opt = array(), $LastOpt, $NameOpt, $File, $title = "", $Ajax = false ){
		
		$save_con = $Opt + $LastOpt;
		$handler = fopen( $File, "w" );
		fwrite( $handler, "<?php \n\n//{$title}\n\n{$NameOpt} = array (\n" );
		foreach( $save_con as $name => $value )
			{
				if( is_array( $value ) ) $value = implode( ",", $value );
				if( $Ajax === true && function_exists( "CharsetConvert" ) ) $value = CharsetConvert( $value );
				$value = addslashes( stripslashes( trim( str_replace( "\n", "<br />", str_replace( "\r", "", $value ) ) ) ) );
				fwrite( $handler, "\t\"{$name}\" => \"{$value}\",\n" );
			}
		fwrite( $handler, ");\n\n?>" );
		fclose( $handler );
	}
	
	//------------------------------------------------=-=-=-=-=
	//	Создание кэша альбомов (без фоток)
	//------------------------------------------------=-=-=-=-=
	
	function CreateDB(){
		global $db;
		
		foreach( $this->AllowOptionsType as $type ) @unlink( ENGINE_DIR."/data/banki/{$type}.php" );
		$this->ClearCache( "../city/" );
		
		$AllowCity = array();
		$result = $db->query( "SELECT * FROM ".PREFIX."_banki_options ORDER BY `sort`" );
		if( $db->num_rows( $result ) > 0 )
			{
				while( $row = $db->get_row( $result ) )
					{
						$ThisOpt = "";
						$id = $row['id'];
						$type = $row['type'];
						$sort = $row['sort'] > 0 ? intval( $row['sort'] ) : 1;
						$options = array();
						$alt_name = "";
						$ForArray = "";
						if( !in_array( $type, $this->AllowOptionsType ) ) continue;
						
						if( $row['options'] )
							{
								$row['options'] = explode( "|||", $row['options'] );
								foreach( $row['options'] as $opt )
									{
										$opt = explode( "=", $opt );
										$opt[0] = $this->FiletrForDb( $opt[0], "read" );
										$opt[1] = $this->FiletrForDb( $opt[1], "read" );
										$options[ $opt[0] ] = $opt[1];
									}
							}
								else
							{
								$options = array();
							}
							
						if( $options['alt_name'] ) $alt_name = addslashes( stripslashes( $options['alt_name'] ) );
						if( $alt_name ) $alt_name = "\n\$this->DBIndex['{$type}']['{$alt_name}'] = \"{$id}\";";
								
						if( $type == "city" && $options['country'] )
							{
								$options['country'] = intval( $options['country'] );
								$ForArray = "['".intval( $options['country'] )."']";
								//$AllowType[ $type ] .= "\n\$this->DBIndex['{$type}']['{$id}'] = \"{$options['country']}\";";
							}
							
						if( $type == "banners" ) $alt_name = "\n\$this->DBIndex['{$type}']['{$row['sort']}']['{$id}'] = \"{$id}\";";
						
						$ThisOpt .= "\t\"id\" => \"{$id}\",\n";
						$ThisOpt .= "\t\"type\" => \"{$type}\",\n";
						$ThisOpt .= "\t\"sort\" => \"{$sort}\",\n";
						foreach( $options as $name => $value )
							{
								$name = addslashes( stripslashes( $name ) );
								$value = addslashes( stripslashes( $value ) );
								$value = str_replace( "\$", "\\\$", $value );
								
								$ThisOpt .= "\t\"{$name}\" => \"{$value}\",\n";
							}
						
						if( $type == "city" )
							{
								$AllowCity[ $options['country'] ] .= "\$this->DB['{$type}']{$ForArray}['{$id}'] = array(\n{$ThisOpt});{$alt_name}\n\n";
							}
								else
							{
								$AllowType[ $type ] .= "\$this->DB['{$type}']{$ForArray}['{$id}'] = array(\n{$ThisOpt});{$alt_name}\n\n";
							}
					}
			}
		
		foreach( $this->AllowOptionsType as $type )
			{
				$Text = "<?php\n\nif( !defined( \"DATALIFEENGINE\" ) ) die( \"Hacking attempt!\" );\n\n".$AllowType[ $type ]."?>";
				$fp = fopen( ENGINE_DIR."/data/banki/{$type}.php", "w+" );
				fwrite( $fp, $Text );
				fclose( $fp );
			}
			
		foreach( $AllowCity as $country_id => $row )
			{
				$Text = "<?php\n\nif( !defined( \"DATALIFEENGINE\" ) ) die( \"Hacking attempt!\" );\n\n".$AllowCity[ $country_id ]."?>";
				$fp = fopen( ENGINE_DIR."/data/banki/city/city_{$country_id}.php", "w+" );
				fwrite( $fp, $Text );
				fclose( $fp );
			}
		
		unset( $AllowType );
		unset( $AllowCity );
	}
	
	
	//------------------------------------------------=-=-=-=-=
	// Отправка письма на почту
	//------------------------------------------------=-=-=-=-=
	
	function SendEmail( $template, $subject, $emailFrom, $emailTo, $options = array() ){
		global $db, $config;
		
		$template = $db->safesql( $template );
		if( !$this->EmailClass )
			{
				include( ENGINE_DIR."/classes/mail.class.php" );
				include( ENGINE_DIR."/data/banki/tpl.email.php" );
				$this->EmailClass = new dle_mail( $config );
				$this->EmailTpl = $BankiEmail;
				if( $emailFrom != "" ) $this->EmailClass->from = $emailFrom;
			}
			
		if( empty( $template ) ) return false;
		if( empty( $subject ) ) return false;
		if( empty( $emailTo ) ) return false;
		
		$Template = stripslashes( $this->EmailTpl[ $template ] );
		if( empty( $Template ) ) return "Template not found";
		
		$options['domain'] = $_SERVER['HTTP_HOST'];
		foreach( $options as $name => $value ) $Template = str_replace( "%{$name}%", $value, $Template );
		$this->EmailClass->send( $emailTo, $subject, $Template );
		
		if( $this->EmailClass->send_error )
			return $this->EmailClass->smtp_msg;
		else
			return true;
	}
	
	//------------------------------------------------=-=-=-=-=
	//	Фильтр данный для сохранения в БД
	//------------------------------------------------=-=-=-=-=
	
	function FiletrForDb( $text, $type = "save" ){
		
		if( $type == "save" )
			{
				$text = str_replace( "\r", "", $text );
				$text = str_replace( "\n", "&567&", $text );
				$text = str_replace( "=", "&744&", $text );
				$text = str_replace( "|", "&421&", $text );
			}
				else
			{
				$text = str_replace( "&567&", "\n", $text );
				$text = str_replace( "&744&", "=", $text );
				$text = str_replace( "&421&", "|", $text );
			}
		
		return $text;
	}
	
	function ReplacePrice( $price ){
		
		$return = "";
		$price = str_replace( " ", "", $price );
		$price = "{$price}";
		if( strlen( $price ) < 4 ) return $price;
		
		$c = 0;
		for( $i = strlen( $price ); $i > 0; $i-- )
			{
				if( $c == 3 )
					{
						$return = $price[ ( $i - 1 ) ]." {$return}";
						$c = 1;
					}
						else
					{
						$return = $price[ ( $i - 1 ) ].$return;
						$c++;
					}
			}
		
		return $return;
	}
	
	function UpdateViews( $id ){
		global $db;
		
		$id = intval( $id );
		if( !$id ) return false;
		if( $this->Config['full_cache_views'] == "yes" )
			{
				$fp = fopen( ENGINE_DIR."/data/banki/post.views.db", "a" );
				fwrite( $fp, "{$id}\n" );
				fclose( $fp );
				@chmod( ENGINE_DIR."/data/banki/post.views.db", 0666 );
			}
				else
			{
				$db->query( "UPDATE ".PREFIX."_banki_post SET `views`=views+1 WHERE `id`='{$id}'" );
			}
		
		return true;
	}
	
	function LastCommentsBlock(){
		global $db, $config, $lang, $tpl, $_TIME;
		
		$maxComm = intval( $this->Config['com_glavnay'] );
		$maxText = intval( $this->Config['com_glavnay_text'] );
		if( !$return )
			{
				$template = file_get_contents( $tpl->dir."/banki/main_otziv.tpl" );
				$result = $db->query( "SELECT ".PREFIX."_banki_comments.id as com_id, ".PREFIX."_banki_comments.banki_id, ".PREFIX."_banki_comments.author_id, ".PREFIX."_banki_comments.otziv, ".PREFIX."_banki_comments.tit_otziv, ".PREFIX."_banki_comments.author, ".PREFIX."_banki_comments.text, ".PREFIX."_banki_comments.ip, ".PREFIX."_banki_comments.date, ".PREFIX."_banki_post.id, ".PREFIX."_banki_post.title, ".PREFIX."_banki_post.alt_name, ".PREFIX."_banki_post.category FROM ".PREFIX."_banki_comments LEFT JOIN ".PREFIX."_banki_post ON ".PREFIX."_banki_comments.banki_id=".PREFIX."_banki_post.id WHERE ".PREFIX."_banki_comments.approve!='0' ORDER BY `date` DESC LIMIT 0," . $maxComm );
				if( $db->num_rows( $result ) > 0 )
					{
						while( $row = $db->get_row( $result ) )
							{
								$id = $row['id'];
								$title = stripslashes( $row['title'] );
								$alt_name = $row['alt_name'];
								$category = $row['category'];
								$author = stripslashes( $row['author'] );
								$author_id = intval( $row['author_id'] );
								$approve = intval( $row['approve'] );
								$otziv = intval( $row['otziv'] );
								$tit_otziv = stripslashes( $row['tit_otziv'] );
								$text = stripslashes( $row['text'] );
								$date = strtotime( $row['date'] );
								$full_link = $this->ReturnLinkPost( $id, $alt_name, $category );
								$authorLink = $config['allow_alt_url'] == "yes" ? "/user/".urldecode( $author )."/" : "/index.php?subaction=userinfo&user={$author}";
								$text = mb_substr( $text, 0, $maxText, 'utf-8' )."...";
								// Работаем с датой
								if( date( "Ymd", $date ) == date( "Ymd", $_TIME ) )
									$date = $lang['time_heute'].langdate( ", H:i", $date );
								elseif( date( "Ymd", $date ) == date( "Ymd", ( $_TIME - 86400 ) ) )
									$date = $lang['time_gestern'].langdate( ", H:i", $date );
								else
									$date = langdate( $config['timestamp_comment'], $date );
						
								if( $approve != 1 )
								{
									$Allow = false;
									$errorAllow = "Банк временно отключен";
								}
								$forReturn = $template;
								$forReturn = str_replace( "{title}", $title, $forReturn );
								$forReturn = str_replace( "{author}", $author, $forReturn );
								$forReturn = str_replace( "{authorLink}", $authorLink, $forReturn );
								$forReturn = str_replace( "{text}", $text, $forReturn );
								$forReturn = str_replace( "{date}", $date, $forReturn );
								$forReturn = str_replace( "{tit_otziv}", $tit_otziv, $forReturn );
								$forReturn = str_replace( "{otziv}", $otziv, $forReturn );
								$forReturn = str_replace( "{full_link}", $full_link, $forReturn );
								$return .= $forReturn;
							}
					}
						else
					{
						$return = "Нет отзывов";	
					}
				
		
			}
		
		return $return;
	}
	
	function SetBanners( $type = "short", $position ){
		
		$return = "";
		if( $type == "short" )
			{
				if( count( $this->DBIndex['banners'][ $position ] ) > 0 )
					{
						foreach( $this->DBIndex['banners'][ $position ] as $id )
							{
								$code = stripslashes( $this->DB['banners'][ $id ]['code'] );
								$return .= $code;	
							}	
					}
			}
		
		return $return;
	}
	
	//------------------------------------------------=-=-=-=-=
	//	Разрешён ли тип для категории
	//------------------------------------------------=-=-=-=-=
	
	
	
	//------------------------------------------------=-=-=-=-=
	//	Создание индекса всех категорий (кто в какой находится)
	//------------------------------------------------=-=-=-=-=
	
	function SetCategoryIndex(){
		
		$this->CategoryIndex = array();
		$this->CategoryOurIndex = array();
		if( count( $this->DB['category'] ) < 1 ) return false;
		foreach( $this->DB['category'] as $id => $row )
			{
				if( $row['cat'] != "" && $this->DB['category'][ $row['cat'] ] )
					{
						$this->CategoryIndex[ $row['cat'] ][] = $id;
						$this->CategoryOurIndex[ $id ] = true;
					}
			}
	}
	
	//------------------------------------------------=-=-=-=-=
	//	Проверка, находится ли какая-то категория, в другой категории (неограниченная вложенность)
	//------------------------------------------------=-=-=-=-=
	
	function InCat( $id, $not ){
		
		if( $id && $this->DB['category'][ $id ] )
			{
				if( $this->DB['category'][ $id ]['cat'] == $not )
					{
						return true;
					}
						else
					{
						if( $this->DB['category'][ $id ]['cat'] )
							{
								if( $this->InCat( $this->DB['category'][ $id ]['cat'], $not ) === true ) return true;
							}
					}					
			}
		
		return false;
	}
	
	//------------------------------------------------=-=-=-=-=
	//	Возвращение самой главной категории подкатегории
	//------------------------------------------------=-=-=-=-=
	
	function MainCat( $id ){
		if( $this->DB['category'][ $id ]['cat'] ) return $this->MainCat( $this->DB['category'][ $id ]['cat'] );
		return $id;
	}
	
	//------------------------------------------------=-=-=-=-=
	//	Возвращение списка категорий для выбора (<select>)
	//------------------------------------------------=-=-=-=-=
	
	function JSSelectCategory( $select = "" ){
		global $config;
		
		$return = "";
		$returnJS = "";
		if( count( $this->DB['category'] ) < 1 ) return false;
		if( !is_array( $this->CategoryIndex ) ) $this->SetCategoryIndex();
		
		foreach( $this->DB['category'] as $id => $row )
			{
				if( in_array( $id, $this->EchoCatOk ) ) continue;
				if( !$this->CategoryOurIndex[ $id ] )
					{
						$this->EchoCatOk[] = $id;
						$name = htmlspecialchars( stripslashes( $this->DB['category'][ $id ]['name'] ), ENT_QUOTES, $config['charset'] );
						$returnJS .= "<div id=\"InCat_{$id}\" style=\"display: none;\"><select name=\"category\" id=\"BankiSelectCategory\" onkeyup=\"CategorySelect();\" onkeydown=\"CategorySelect();\" onchange=\"CategorySelect();\">".$this->SelectCategory( $select, "", -1, $id )."</select></div>";
						
						$selected = ( $this->JsCatSelect === true || $select == $id ) ? "selected=\"selected\"" : "";
						$this->JsCatSelect = false;
						
						$return .= "<option value=\"{$id}\" {$selected}>{$name}</option>";
					}
			}
		
		$JSFunction = <<<HTML
		
		var BankiAddStart = true;
		function BankiInCat(){
			var SelectCat = document.getElementById( "mainCat" ).value;
			if( SelectCat > 0 )
				{
					if( document.getElementById( "InCat_" + SelectCat ).innerHTML != "" )
						{
							document.getElementById( "BankiTextForInCat" ).innerHTML = document.getElementById( "InCat_" + SelectCat ).innerHTML;
						}
					
					if( BankiAddStart == true )
						BankiAddStart = false;
					else
						CategorySelect();
					return;
				}
			
			document.getElementById( "BankiTextForInCat" ).innerHTML = "";
		}
		
		BankiInCat();
			
HTML;
		
		$return = <<<HTML
		
		<select name="MainCategory" id="mainCat" onkeyup="BankiInCat();" onkeydown="BankiInCat();" onchange="BankiInCat();">
			{$return}
		</select>
		<span id="BankiTextForInCat">&nbsp;</span>
		
HTML;
		
		return array(
			"main"	=>	$return,
			"js"	=>	"{$returnJS}<script language=\"javascript\" type=\"text/javascript\">{$JSFunction}</script>",
		);
	}
	
	function SelectCategory( $selected = "", $not = "", $nbsp = "", $id = "", $all = false ){
		global $config;
		
		$return = "";
		if( count( $this->DB['category'] ) < 1 ) return false;
		if( !is_array( $this->CategoryIndex ) ) $this->SetCategoryIndex();
		
		if( !$id )
			{
				$this->EchoCatOk = array();
				
				if( $all === true )
					{
						if( !$selected || count( $selected ) == 0 )
							{
								$okSelected = "selected=\"selected\"";
							}
								else
							{
								if( is_array( $selected ) )
									$okSelected = ( in_array( "all", $selected ) ) ? "selected=\"selected\"" : "";
								else
									$okSelected = ( $selected == "all" ) ? "selected=\"selected\"" : "";
							}
						
						$return = "<option value=\"all\" {$okSelected}> - Все - </option>";
					}
					
				foreach( $this->DB['category'] as $id => $row )
					{
						if( in_array( $id, $this->EchoCatOk ) ) continue;
						if( !$this->CategoryOurIndex[ $id ] )
							{
								$return .= $this->SelectCategory( $selected, $not, $nbsp, $id );
							}
					}
			}
				else
			{
				if( is_array( $not ) )
					{
						foreach( $not as $SId )
							{
								if( $id == $SId ) return;
								if( $this->InCat( $id, $SId ) === true ) return;	
							}
					}
						else
					{
						if( $not == $id ) return;
						if( $not && $this->InCat( $id, $not ) === true ) return;
					}
					
				if( !$this->DB['category'][ $id ] ) return;
				
				if( !in_array( $id, $this->EchoCatOk ) )
					{
						$echoNbsp = "";
						for( $i = 0; $i < ( $nbsp * 4 ); $i++ ) $echoNbsp .= "&nbsp;";
						$echoNbsp = $echoNbsp ? "{$echoNbsp} " : "";
						
						if( is_array( $selected ) )
							$okSelected = ( in_array( $id, $selected ) ) ? "selected=\"selected\"" : "";
						else
							$okSelected = ( $selected == $id ) ? "selected=\"selected\"" : "";
						
						if( $okSelected != "" ) $this->JsCatSelect = true;
						$title_h = htmlspecialchars( stripslashes( $this->DB['category'][ $id ]['title_h'] ), ENT_QUOTES, $config['charset'] );
						$return .= "<option value=\"{$id}\" {$okSelected}>{$echoNbsp}{$title_h}</option>";
						$this->EchoCatOk[] = $id;
					}
				
				if( count( $this->CategoryIndex[ $id ] ) > 0 )
					{
						foreach( $this->CategoryIndex[ $id ] as $NewID )
							{
								if( in_array( $NewID, $this->EchoCatOk ) ) continue;
								$return .= $this->SelectCategory( $selected, $not, ( $nbsp + 1 ), $NewID );
							}
					}
			}
		
		return $return;
	}
	
	//------------------------------------------------=-=-=-=-=
	//	Вывод всех категорий для админцентра
	//------------------------------------------------=-=-=-=-=
	
	function ReturnAdminCat( $nbsp = 0, $id = "" ){
		global $config;
		
		$return = "";
		if( count( $this->DB['category'] ) < 1 ) return false;
		if( !is_array( $this->CategoryIndex ) ) $this->SetCategoryIndex();
		
		if( !$id )
			{
				$this->EchoCatOk = array();
				foreach( $this->DB['category'] as $id => $row )
					{
						if( in_array( $id, $this->EchoCatOk ) ) continue;
						if( !$this->CategoryOurIndex[ $id ] )
							{
								$return .= $this->ReturnAdminCatForm( $row, $nbsp );
								if( count( $this->CategoryIndex[ $id ] ) > 0 ) $return .= $this->ReturnAdminCat( ( $nbsp + 1 ), $id );
							}
					}
			}
				else
			{
				if( count( $this->CategoryIndex[ $id ] ) < 1 ) return;
				foreach( $this->CategoryIndex[ $id ] as $NewID )
					{
						if( in_array( $NewID, $this->EchoCatOk ) ) continue;
						$return .= $this->ReturnAdminCatForm( $this->DB['category'][ $NewID ], $nbsp );
						if( count( $this->CategoryIndex[ $NewID ] ) > 0 ) $return .= $this->ReturnAdminCat( ( $nbsp + 1 ), $NewID );
					}
			}
			
		return $return;
	}
	
	function ReturnAdminCatForm( $row, $nbsp = 0 ){
		global $config;
		
		$return = "";
		$echoNbsp = "";
		for( $i = 0; $i < ( $nbsp * 4 ); $i++ )	$echoNbsp .= "-";
		$echoNbsp = $echoNbsp ? "{$echoNbsp} " : "";
		
		$id = $row['id'];
		$name = htmlspecialchars( stripslashes( $row['title_h'] ), ENT_QUOTES, $config['charset'] );
		$alt_name = htmlspecialchars( stripslashes( $row['alt_name'] ), ENT_QUOTES, $config['charset'] );
		$template = $row['template'] ? htmlspecialchars( stripslashes( $row['template'] ), ENT_QUOTES, $config['charset'] ) : "---";
		$sort = intval( $row['sort'] );
		$link = $this->ReturnLinkCategory( $id );
		$BgColor = !$echoNbsp ? "#FCFDE3" : "#FFFFFF";
		$count_post = intval( $row['count_post'] );
				
$return = <<<HTML

		<tr id="del_Category_{$id}" height="30px"  >
			<td width="70px" class="hidden-xs" align="center" id="StatusCategory_{$id}">{$id}</td>
			<td class="hidden-xs">
				{$echoNbsp}
				<a href="$PHP_SELF?mod=banki&do=edit_category&id={$id}" title="Редактировать категорию" >{$name}</a>
				<a href="{$link}" target="_blank" style="float:right;">На сайте <i class="fa fa-play" style="font-size: 10px;"></i></a>
			</td>
			<td width="100px" align="center" class="hidden-xs">
				<input type="text" name="sort[{$id}]" value="{$sort}" style="text-align: center; width: 50px;" class="form-control" />
			</td>
			<td width="100px" align="center" class="hidden-xs">
				<div class="btn-group">
					<button class="btn-default dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bars"></i> <span class="caret"></span></button>
					<ul class="dropdown-menu text-left">
						<li><a  href="$PHP_SELF?mod=banki&do=edit_category&id={$id}"><i class="icon-desktop"></i> Редактировать</a></li>
						<li><a href="#" onclick="DelCategory( '{$id}' ); return false;" href="#"><i class="icon-trash"></i> Удалить</li>
				</div>
			</td>
			<td width="30px" class="hidden-xs">
				<input type="checkbox" name="CheckCategory[]"  value="{$id}" />
			</td>
		</tr>

HTML;
		$this->EchoCatOk[] = $id;
		return $return;
	}
	
	//------------------------------------------------=-=-=-=-=
	//	Возвращает ссылку на категорию
	//------------------------------------------------=-=-=-=-=
	
	function ReturnLinkCategory( $id, $onlyCat = false ){
		
		if( $this->AltUrl === false )
			{
				if( $this->DB['category'][ $id ]['alt_name'] )
					{
						$alt_name = $this->DB['category'][ $id ]['alt_name'];
						return "/index.php?do=banki&action=bankicat&bankicat={$alt_name}";	
					}
						else
					{
						return "/index.php?do=banki";	
					}
			}
		
		if( !$onlyCat )
			{
				$return = "/banki/";
				$this->LinkCategory = array();
				$this->ReturnLinkCategory( $id, true );
				if( count( $this->LinkCategory ) > 0 )
					{
						$Cat = array();
						for( $i = ( count( $this->LinkCategory ) -1 ); $i >= 0; $i-- )
							{
								$Cat[] = $this->LinkCategory[ $i ];
							}
							
						$Cat = implode( "/", $Cat );
						$return .= "{$Cat}/";
					}
			}
				else
			{
				$return = "";
				if( $this->DB['category'][ $id ] ) $this->LinkCategory[] = $this->DB['category'][ $id ]['alt_name'];
				if( $this->DB['category'][ $id ]['cat'] && $this->DB['category'][ $this->DB['category'][ $id ]['cat'] ] ) $this->ReturnLinkCategory( $this->DB['category'][ $id ]['cat'], true );
			}
			
		return $return;		
	}
	
	//------------------------------------------------=-=-=-=-=
	//	Возвращает ссылку на категорию с уже сгенерированными html тегами
	//------------------------------------------------=-=-=-=-=
	
	function ReturnLinkHrefCategory( $id ){
		global $config;
		
		if( !$this->DB['category'][ $id ] ) return false;
		$CatName = htmlspecialchars( stripslashes( $this->DB['category'][ $id ]['name'] ), ENT_QUOTES, $config['charset'] );
		$CatLink = $this->ReturnLinkCategory( $id );
		$return = "<a href=\"{$CatLink}\">{$CatName}</a>";
		
		return $return;
	}
	
	function ReturnLinkHrefGCategory( $id, $onlyCat = true ){
		global $config;
		
		if( !$this->DB['category'][ $this->RequestCat ] ) return false;
		$CatName = htmlspecialchars( stripslashes( $this->DB['category'][ $id ]['title_h'] ), ENT_QUOTES, $config['charset'] );
		$return = "{$CatName}";
		
		return $return;
	}
	
	//------------------------------------------------=-=-=-=-=
	//	Возвращает ссылку
	//------------------------------------------------=-=-=-=-=
	
	function ReturnLinkPost( $id, $alt_name, $cat_id ){
		
		if( $this->AltUrl === true )
			{
				$cat_link = $this->ReturnLinkCategory( $cat_id );
				$return = "{$cat_link}{$alt_name}/";
			}
				else
			{
				$alt_name = $this->DB['category'][ $cat_id ]['alt_name'];
				$return = "/index.php?do=banki&bankicat={$alt_name}&action=post&id={$id}";
			}
			
		return $return;
	}
	
	function ReturnLinkRekviziti( $id, $alt_name, $cat_id ){
		
		if( $this->AltUrl === true )
			{
				$cat_link = $this->ReturnLinkCategory( $cat_id );
				$return = "{$cat_link}{$alt_name}/review/";
			}
				else
			{
				$alt_name = $this->DB['category'][ $cat_id ]['alt_name'];
				$return = "/index.php?do=banki&bankicat={$alt_name}&action=rekv&id={$id}";
			}
			
		return $return;
	}
	
	//------------------------------------------------=-=-=-=-=
	//	Возвращает ссылку на добавление
	//------------------------------------------------=-=-=-=-=
	
	function ReturnLinkAddPost(){
		
		if( $this->AltUrl === true )
			{
				$return = $this->ReturnLinkCategory( $this->RequestCat )."add";
			}
				else
			{
				$alt_name = $this->DB['category'][ $this->RequestCat ]['alt_name'];
				$return = "/index.php?do=banki&bankicat={$alt_name}&action=add";
			}
			
		return $return;
	}
	
	//------------------------------------------------=-=-=-=-=
	//	Генерация вывода категорий на главной модуля
	//------------------------------------------------=-=-=-=-=
	
	function ListAllCategory( $MainTemplate, $ThreadTemplate, $Columns = 1, $id = "" ){
		
		$i = 1;
		$return = "";
		$TdWidth = intval( 100 / $Columns );
		if( count( $this->DB['category'] ) < 1 ) return false;
		if( !is_array( $this->CategoryIndex ) ) $this->SetCategoryIndex();
		
		$this->EchoCatMainTemplate = $MainTemplate;
		$this->EchoCatThreadTemplate = $ThreadTemplate;
		
		foreach( $this->DB['category'] as $id => $row )
			{
				if( !$this->CategoryOurIndex[ $id ] )
					{
						$return .= "<td width=\"{$TdWidth}%\">".$this->GenerateTemplateCat( $id )."</td>";
						if( $i % $Columns == 0 ) $return .= "</tr><tr>";
						$i++;
					}
			}
				
		$return = "<table width=\"100%\" class=\"BankiMainCats\"><tr>{$return}</tr></table>";			
		return $return;
	}
	
	function GenerateTemplateCat( $id, $thread = false ){
		global $config;
		
		$return = "";
		if( !$thread )
			{
				$link = $this->ReturnLinkCategory( $id );
				$title = htmlspecialchars( stripslashes( $this->DB['category'][ $id ]['name'] ), ENT_QUOTES, $config['charset'] );
				$icon = htmlspecialchars( stripslashes( $this->DB['category'][ $id ]['icon'] ), ENT_QUOTES, $config['charset'] );
				$count_bankis = intval( $this->DB['category'][ $id ]['count_post'] );
				
				$return = str_replace( "{link}", $link, $this->EchoCatMainTemplate );
				$return = str_replace( "{title}", $title, $return );
				$return = str_replace( "{count_bankis}", $count_bankis, $return );
				
				if( $icon )
					{
						$return = preg_replace( "#\\[icon\\](.+?)\\[/icon\\]#is", "\\1", $return );
						$return = str_replace( "{icon}", "{$icon}", $return );
					}
						else
					{
						$return = preg_replace( "#\\[icon\\](.+?)\\[/icon\\]#is", "", $return );
					}
				
				$countThread = count( $this->CategoryIndex[ $id ] );
				if( $countThread > 0 )
					{
						$return = preg_replace( "#\\[thread\\](.+?)\\[/thread\\]#is", "\\1", $return );
						$return = str_replace( "{content}", $this->GenerateTemplateCat( $id, true ), $return );					
					}
						else
					{
						$return = preg_replace( "#\\[thread\\](.+?)\\[/thread\\]#is", "", $return );
					}
			}
				else
			{
				$countThread = count( $this->CategoryIndex[ $id ] );
				$maxThread = intval( $this->Config['main_page_max_echo_thread_cats'] );
				if( $countThread )
					{
						if( $maxThread > 0 && $countThread >= $maxThread )
							{
								$Comma = array();
								foreach( $this->CategoryIndex[ $id ] as $NewId )
									{
										$title = htmlspecialchars( stripslashes( $this->DB['category'][ $NewId ]['name'] ), ENT_QUOTES, $config['charset'] );
										$link = $this->ReturnLinkCategory( $NewId );
										$count_bankis = intval( $this->DB['category'][ $NewId ]['count_post'] );
										$Comma[] = "<a href=\"{$link}\">{$title}</a> <span>({$count_bankis})</span>";
									}
									
								$Comma = ( count( $Comma ) > 0 ) ? implode( ", ", $Comma ) : "";
								$return = $Comma;
							}
								else
							{
								foreach( $this->CategoryIndex[ $id ] as $NewId )
									{
										$ForReturn = "";
										$link = $this->ReturnLinkCategory( $NewId );
										$title = htmlspecialchars( stripslashes( $this->DB['category'][ $NewId ]['name'] ), ENT_QUOTES, $config['charset'] );
										$icon = htmlspecialchars( stripslashes( $this->DB['category'][ $NewId ]['icon'] ), ENT_QUOTES, $config['charset'] );
										$count_bankis = intval( $this->DB['category'][ $NewId ]['count_post'] );
										
										$ForReturn = str_replace( "{link}", $link, $this->EchoCatThreadTemplate );
										$ForReturn = str_replace( "{title}", $title, $ForReturn );
										$ForReturn = str_replace( "{count_bankis}", $count_bankis, $ForReturn );
										
										if( $icon )
											{
												$ForReturn = preg_replace( "#\\[icon\\](.+?)\\[/icon\\]#is", "\\1", $ForReturn );
												$ForReturn = str_replace( "{icon}", "{THEME}/banki/style/{$icon}", $ForReturn );
											}
												else
											{
												$ForReturn = preg_replace( "#\\[icon\\](.+?)\\[/icon\\]#is", "", $ForReturn );
											}
											
										if( count( $this->CategoryIndex[ $NewId ] ) > 0 )
											{
												$ForReturn = preg_replace( "#\\[thread\\](.+?)\\[/thread\\]#is", "\\1", $ForReturn );
												$ForReturn = str_replace( "{content}", $this->GenerateTemplateCat( $NewId, true ), $ForReturn );
											}
												else
											{
												$ForReturn = preg_replace( "#\\[thread\\](.+?)\\[/thread\\]#is", "", $ForReturn );
											}
											
										$return .= $ForReturn;
									}
							}
					}
			}
		
		return $return;
	}
	
	//------------------------------------------------=-=-=-=-=
	//	Генерация подкатегорий просматриваемой категории
	//------------------------------------------------=-=-=-=-=
	
	function GenerateTemplateThreadCat( $MainTemplate, $listTemplate, $id, $Columns = 3, $allReady = false ){
		global $config;
		
		if( !$id ) return false;
		if( !is_array( $this->CategoryIndex ) ) $this->SetCategoryIndex();
		
		$allCat = $this->Config['short_echo_category'] == "default" ? false : true;
		
		if( $this->Config['short_echo_category'] == "all_main_cat" && $allReady !== true ) $id = $this->MainCat( $id );
		if( $this->Config['short_echo_category'] == "all_cat" && $allReady !== true ) $id = $this->DB['category'][ $id ]['cat'] ? $this->DB['category'][ $id ]['cat'] : $id;
		
		if( $this->DB['category'][ $id ] )
			{
				$return = array();
				if( count( $this->CategoryIndex[ $id ] ) > 0 )
					{
						$i = 1;
						
						if( $allCat === true && $allReady !== true )
							{
								$CategoryIndex = array( $id );
								foreach( $this->CategoryIndex[ $id ] as $NewId ) $CategoryIndex[] = $NewId;
							}
								else
							{
								$CategoryIndex = $this->CategoryIndex[ $id ];
							}
						
						foreach( $CategoryIndex as $NewId )
							{
								if( $allCat === true && $this->AllowTypeInCats( $NewId ) !== true ) continue;
								$link = $this->ReturnLinkCategory( $NewId );
								$title = $id == $NewId ? "Все" : htmlspecialchars( stripslashes( $this->DB['category'][ $NewId ]['name'] ), ENT_QUOTES, $config['charset'] );
								$count_bankis = intval( $this->DB['category'][ $NewId ]['count_post'] );
								
								
								$ForReturn = str_replace( "{link}", $link, $listTemplate );
								$ForReturn = str_replace( "{title}", $title, $ForReturn );
								$ForReturn = str_replace( "{count_bankis}", $count_bankis, $ForReturn );
								
								$ForReturn = preg_replace( "#\\[active\\](.*?)\\[/active\\]#is", ( $NewId == $this->RequestCat ? "\\1" : "" ), $ForReturn );
								$ForReturn = preg_replace( "#\\[not-active\\](.*?)\\[/not-active\\]#is", ( $NewId == $this->RequestCat ? "" : "\\1" ), $ForReturn );
								
								if( $allCat === true && $id != $NewId )
									$ForReturn = str_replace( "{inCat}", $this->GenerateTemplateThreadCat( $MainTemplate, $listTemplate, $NewId, $Columns, true ), $ForReturn );
								else
									$ForReturn = str_replace( "{inCat}", "", $ForReturn );
								
								if( $allCat === true && $allReady !== true )
									{
										if( !is_array( $return[ $i ] ) ) $return[ $i ] = array();
										$return[ $i ][] = $ForReturn;
									}
										else
									{
										if( !$return[ $i ] ) $return[ $i ] = "";
										$return[ $i ] .= $ForReturn;
									}
								
								$i = ( $i == $Columns ) ? 1 : ( $i + 1 );
							}
						
						if( $allReady !== true )
							{
								$NewReturn = "";
								$TdWidth = intval( 100 / $Columns );
								
								if( $allCat === true )
									{
										$i = 1;
										foreach( $return as $array )
											{
												foreach( $array as $value )
													{
														$value = str_replace( "{list}", $value, $MainTemplate );
														$NewReturn .= "<td width=\"{$TdWidth}%\">{$value}</td>";
														if( $i % $Columns == 0 ) $NewReturn .= "</tr><tr>";
														$i++;
													}
											}
									}
										else
									{
										foreach( $return as $value )
											{
												$value = str_replace( "{list}", $value, $MainTemplate );
												$NewReturn .= "<td width=\"{$TdWidth}%\">{$value}</td>";
											}
									}
								
								$return = "<table width=\"100%\" border=\"0\"><tr>{$NewReturn}</tr></table>";
							}
								else
							{
								$return = implode( "", $return );
								$return = str_replace( "{list}", $return, $MainTemplate );
							}
					}
						else
					{
						$return = "";	
					}
			}
		
		return $return;
	}
	
	//------------------------------------------------=-=-=-=-=
	//	Возвращает готовый текст для сохранения в БД
	//------------------------------------------------=-=-=-=-=
	
	function CompileOpt( $opt ){
		
		unset( $opt['id'] );
		unset( $opt['sort'] );
		
		$ReturnOpt = array();
		foreach( $opt as $name => $value )
			{
				$name = $this->FiletrForDb( $name );
				$value = $this->FiletrForDb( $value );
						
				$ReturnOpt[] = "{$name}={$value}";
			}
				
		$ReturnOpt = implode( "|||", $ReturnOpt );
		return $ReturnOpt;
	}
	
	//------------------------------------------------=-=-=-=-=
	//	Обновляет опции в БД
	//------------------------------------------------=-=-=-=-=
	
	function SaveBankiOpt( $row, $newRow, $id = "" ){
		global $db;
		
		$id = $id != "" ? intval( $id ) : intval( $row['id'] );
		if( !$id ) return false;
		
		$newRow = $newRow + $row;
		$SqlOpt = $db->safesql( $this->CompileOpt( $newRow ) );
		$db->query( "UPDATE ".PREFIX."_banki_options SET `options`='{$SqlOpt}' WHERE `id`='{$id}' LIMIT 1" );
	}
	
	
	
	
	
	
	
	//------------------------------------------------=-=-=-=-=
	//	Определение ID просматриваемой категории
	//------------------------------------------------=-=-=-=-=
	
	function DefinitionCat(){
		
		$cat = $_REQUEST['bankicat'];
		if( $cat )
			{
				$cat = explode( ",", $cat );
				$cat = end( $cat );
				if( $this->DBIndex['category'][ $cat ] )
					{
						$this->RequestCat = $this->DBIndex['category'][ $cat ];
						return true;
					}
			}
		
		return false;
	}
	
	//------------------------------------------------=-=-=-=-=
	//	Возвращает информацию для генерации метатитлов и спидбара просматриваемой категории
	//------------------------------------------------=-=-=-=-=
	
	function SpeedBarCat( $id, $Clear = true ){
		global $config;
		
		if( $Clear === true ) $this->SpeedBar = array();
		if( $this->DB['category'][ $id ] )
			{
				$title = htmlspecialchars( stripslashes( $this->DB['category'][ $id ]['name'] ), ENT_QUOTES, $config['charset'] );
				$title_h = htmlspecialchars( stripslashes( $this->DB['category'][ $id ]['title_h'] ), ENT_QUOTES, $config['charset'] );
				$link = $this->ReturnLinkCategory( $id );
				$this->SpeedBar[] = array(
					"title_h"		=> $title_h,
					"title"		=> $title,
					"link"		=> $link,
					"id"		=> $id							
				);
						
				if( $this->DB['category'][ $id ]['cat'] && $this->DB['category'][ $this->DB['category'][ $id ]['cat'] ] ) $this->SpeedBarCat( $this->DB['category'][ $id ]['cat'], false );
			}
		
		return $this->SpeedBar;
	}
	
	//------------------------------------------------=-=-=-=-=
	//	Возвращает массив с ID всех подкатегорий просматриваемой категории
	//------------------------------------------------=-=-=-=-=
	
	function SqlThreadCat( $id ){
		
		if( !$id ) return false;
		if( !is_array( $this->CategoryIndex ) ) $this->SetCategoryIndex();
		if( $this->DB['category'][ $id ] )
			{
				$this->ThreadCatForSql[] = $id;
				if( count( $this->CategoryIndex[ $id ] ) > 0 )
					{
						foreach( $this->CategoryIndex[ $id ] as $NewID )
							{
								$this->SqlThreadCat( $NewID );
							}
					}
			}
		
		return $this->ThreadCatForSql;
	}
	
	//------------------------------------------------=-=-=-=-=
	//	Фильтрация текста для начала поиска
	//------------------------------------------------=-=-=-=-=
	
	function FilterSearchText( $text ){
		$quotes = array( "\x27", "\x22", "\x60", "\t", "\n", "\r", "'", ",", "/", "¬", ";", ":", "@", "~", "[", "]", "{", "}", "=", ")", "(", "*", "&", "^", "%", "$", "<", ">", "?", "!", '"', "|" );
		$goodquotes = array( "-", "+", "#" );
		$repquotes = array( "\-", "\+", "\#" );
		$text = stripslashes( $text );
		$text = trim( strip_tags( $text ) );
		$text = str_replace( $quotes, "", $text );
		$text = str_replace( $goodquotes, $repquotes, $text );
		return $text;
	}
	
	//----------------------------------------------------------=-=-=-=-=
	//	Генерация ссылок для навигации
	//----------------------------------------------------------=-=-=-=-=
	
	function CreateNavigation( $url, $page, $total, $tpl = "navigation.tpl", $ajax = "", $result = "banki" ){
		
		if( !$this->Navigation )
			{
				require( ENGINE_DIR."/modules/banki/navigation.class.php" );
				$this->Navigation = new BankiNavigation;
			}
			
		$this->Navigation->URL = $url;
		$this->Navigation->Page = $page;
		$this->Navigation->Total = $total;
		$this->Navigation->Tpl = $tpl;
		$this->Navigation->AjaxURL = $ajax;
		$this->Navigation->Compile = $result;
		if( $ajax ) $this->Navigation->Ajax = true;	
		
		$this->Navigation->BuildNavigation();
	}
	
	function NotepadPost( $id, $span = true ){
		global $is_logged, $member_id;
		
		$return = "";
		if( $is_logged )
			{
				if( $member_id['banki_notepad'] )
					{
						$Notepad = explode( ",", $member_id['banki_notepad'] );
						if( in_array( $id, $Notepad ) )
							{
								$return = "<a href=\"javascript:void(0);\" onclick=\"BankiNotepad( '{$id}', 'del' ); return false;\"return false;\" class='return-to-catalog'>&nbsp;&nbsp;&nbsp;Удалить из избранного</a>";
							}
					}
				
				if( !$return ) $return = "<a href=\"javascript:void(0);\" onclick=\"BankiNotepad( '{$id}', 'add' ); return false;\" class='return-to-catalog'>&nbsp;&nbsp;&nbsp;Добавить в избранное</a>";
				if( $span === true ) $return = "<span id=\"BankiPostNotepad_{$id}\">{$return}</span>";
			}
			
		return $return;
	}
	
	//----------------------------------------------------------=-=-=-=-=
	//	Генерация списка <select> из массива
	//----------------------------------------------------------=-=-=-=-=
	
	function SelectList( $list, $select = "" ){
	
		if( is_array( $list ) )
			{
				foreach( $list as $name => $value )
					{
						if( is_array( $select ) )
							{
								if( in_array( $name, $select ) ) $selected = "selected"; else $selected = "";
							}
								else
							{
								if( $name == $select ) $selected = "selected"; else $selected = "";	
							}
							
						$return .= "<option value=\"{$name}\" {$selected}>{$value}</option>\n";	
					}
					
				return $return;
			}
			
		return false;
	}
	
	function AllowEditPost( $author_id, $approve ){
		global $is_logged, $member_id;
		
		if( !$is_logged ) return false;
		if( $this->AllowEditAllPost === true ) return true;
		if( $this->AllowEditPost !== true ) return false;
		if( $author_id == $member_id['user_id'] ) return true;
		
		return false;
	}
	
	function AllowAddPost(){
		global $is_logged, $member_id;
		
		if( !$is_logged ) return false;
		if( $this->AllowAddPost === true ) return true;
		
		return false;
	}
	
	function AddPostCategory( $CategoryID ){
		
		$InCat = $this->SpeedBarCat( $CategoryID );
		
		$fp = fopen( ENGINE_DIR."/data/banki/post.cat.count.db", "a" );
		foreach( $InCat as $row )
			{
				$CatID = $row['id'];
				fwrite( $fp, "{$CatID}|plus\n" );
			}
		
		fclose( $fp );
	}
	
	function DelPostCategory( $CategoryID ){
		
		$InCat = $this->SpeedBarCat( $CategoryID );
		
		$fp = fopen( ENGINE_DIR."/data/banki/post.cat.count.db", "a" );
		foreach( $InCat as $row )
			{
				$CatID = $row['id'];
				fwrite( $fp, "{$CatID}|minus\n" );
			}
		
		fclose( $fp );
	}
	
	function ReplaceTagBlock( $Opt, $text, $Not ){
		global $action;
		
		if( !$Opt ) return null;
		$Opt = explode( ",", $Opt );
		return ( ( in_array( $action, $Opt ) && $Not != "Not" ) || ( !in_array( $action, $Opt ) && $Not == "Not" ) ) ? stripslashes( $text ) : null;
	}
	
	function ReplaceTagBlockCat( $Cats, $text, $Not ){
		global $action;
		
		if( !$Cats ) return null;
		$Cats = explode( ",", $Cats );
		return ( ( in_array( $this->RequestCat, $Cats ) && $Not != "Not" ) || ( !in_array( $this->RequestCat, $Cats ) && $Not == "Not" ) ) ? stripslashes( $text ) : null;
	}
	
	//------------------------------------------------=-=-=-=-=
	//	Изображение 
	//------------------------------------------------=-=-=-=-=
	
	function ParsePhotosNews( $text, $images ){
		
		if( $images )
			{
				$i = 1;
				$all = "";
				$allBig = "";
				$images = explode( "|||", $images );
				foreach( $images as $img )
					{
						$img = explode( "###", $img );	
						$Photo = "/uploads/banki/post/{$img[1]}/{$img[0]}";
						$PhotoThumb = "/uploads/banki/post/{$img[1]}/thumbs/{$img[0]}";
						
						$hs = "<a href=\"{$Photo}\" target=\"_blank\" onclick=\"return hs.expand(this)\"><img src=\"{$PhotoThumb}\" alt=\"\" /></a>";
						$all .= "<div class=\"BankiPhoto BankiPhoto-{$i}\">{$hs}</div>";
						$allBig .= "<div class=\"BankiPhoto BankiPhoto-{$i}\"><a href=\"{$Photo}\" target=\"_blank\" onclick=\"return hs.expand(this)\"><img src=\"{$Photo}\" alt=\"\" /></a></div>";
						$text = str_replace( "{image:{$i}}", $hs, $text );
						$text = str_replace( "{image:{$i}->link}", $Photo, $text );
						$text = str_replace( "{image:{$i}->thumb}", $PhotoThumb, $text );
						$text = preg_replace( "#\\[not-image:{$i}\\](.+?)\\[/not-image:{$i}\\]#is", "", $text );
						$text = preg_replace( "#\\[image:{$i}\\](.+?)\\[/image:{$i}\\]#is", "\\1", $text );
						$i++;
					}
					
				$text = str_replace( "{image:all}", $all, $text );
				$text = str_replace( "{image:all->big}", $allBig, $text );
				$text = preg_replace( "#\\[not-image\\](.+?)\\[/not-image\\]#is", "", $text );
				$text = preg_replace( "#\\[image\\](.+?)\\[/image\\]#is", "\\1", $text );
			}
		
		$text = str_replace( "{image:all}", "<div class=\"BankiNotImages\">Нет изображений</div>", $text );
		$text = preg_replace( "/{image:(.+?)}/i", "", $text );
		$text = preg_replace( "#\\[not-image:(.+?)\\](.+?)\\[/not-image:(.+?)\\]#is", "\\2", $text );
		$text = preg_replace( "#\\[image:(.+?)\\](.+?)\\[/image:(.+?)\\]#is", "", $text );
		$text = preg_replace( "#\\[not-image\\](.+?)\\[/not-image\\]#is", "\\1", $text );
		$text = preg_replace( "#\\[image\\](.+?)\\[/image\\]#is", "", $text );
		return $text;		
	}
	
	function CompileImages(){
		$imageArr = $this->ArrayListPhotos();
		$this->CleareOnlyDBImages();
		
		$return = array();
		if( count( $imageArr ) > 0 )
			{
				foreach( $imageArr as $img )
					{
						$return[] = "{$img[0]}###{$img[1]}";
					}
				
				$return = implode( "|||", $return );
			}
				else
			{
				$return = "";	
			}
		
		return $return;
	}
	
	function BankiNewsImages( $row, $template, $mainTemplate, $array = false, $admin = false ){
		global $member_id, $is_logged;
		
		$listImg = "";
		$CountPhotos = 0;
		$imgArray = $this->ArrayListPhotos( $row );
		if( count( $imgArray ) > 0 )
			{
				foreach( $imgArray as $img )
					{
						$Photo = "/uploads/banki/post/{$img[1]}/{$img[0]}";
						$PhotoThumb = "/uploads/banki/post/{$img[1]}/thumbs/{$img[0]}";
						$tpl = str_replace( "{photo}", "<a href=\"{$Photo}\" target=\"_blank\" onclick=\"return hs.expand(this)\"><img src=\"{$PhotoThumb}\" alt=\"\" /></a>", $template );
						
						$tpl = str_replace( "[del]", "<a href=\"javascript:void(0);\" onclick=\"DelBankiPhoto( '{$img[0]}', '{$row['id']}' ); return false;\">", $tpl );
						$tpl = str_replace( "[/del]", "</a>", $tpl );
						$tpl = "<div id=\"{$img[0]}\">{$tpl}</div>";
						
						$listImg .= $tpl;
						$CountPhotos++;
					}	
			}
				else
			{
				$listImg = "Нет загруженных фотографий";
			}
		
		$listImg = str_replace( "{photos}", $listImg, $mainTemplate );
		$dle_skin = $admin === true ? "" : "skin : dle_skin,";
		$admin = $admin === true ? "admin: 1," : "";
		$JSPostID = $row['id'] ? $row['id'] : "\"\"";
		$returnJS = <<<HTML
		
			<script type="text/javascript" src="/engine/ajax/banki/ajaxupload.js"></script>
			<script language="javascript" type="text/javascript">
				var BankiCountPhotos = {$CountPhotos};
				function BankiUploadPhotos(){
					$(function(){
						var btnUpload = $( "#BankiUploadPhotos" );
						var status = $( "#StatusBankiUploadPhotos" );
						new AjaxUpload( btnUpload, {
							action: "/engine/ajax/banki/news.photos.php",
							name: 	"Filedata",
								
							data: {
								ajax : 1,
								upload : 1,
								{$admin}
								{$dle_skin}
								PostID: {$JSPostID},
							},
					
							onSubmit: function( file, ext ){
								status.html( "Загрузка, пожалуйста подождите..." );
							},
								
							onComplete: function( file, response ){
									
								status.html( "" );
								if( BankiCountPhotos == 0 ) $( "#BankiImages" ).html( "" );
								$( "#BankiImages" ).html( document.getElementById( "BankiImages" ).innerHTML + response );
								BankiCountPhotos++;
							}
						});
							
					});
				}
					
				function DelBankiPhoto( Photo, PostID ){
						
					var Quest = confirm( "Вы уверены, что хотите удалить данную фотографию?" );
					if( Quest )
						{
							if( !PostID ) PostID = "";
							ShowLoading( "" );
							$.ajax({
								url: "/engine/ajax/banki/news.photos.php",
								data: "del=1&Photo=" + Photo + "&PostID=" + PostID,
								success: function( data ){
									
									HideLoading( "" );
									if( data )
										{
											alert( data );
										}
											else
										{
											var DelElement = document.getElementById( Photo );
											DelElement.parentNode.removeChild( DelElement );
											BankiCountPhotos--;
											if( BankiCountPhotos <= 0 )
												{
													$( "#BankiImages" ).html( "Нет загруженных фотографий" );
												}
										}
								},
								dataType: "html",
								type: "POST"
							});
						}
				}
				BankiUploadPhotos();
			</script>
		
HTML;
		
		return $array === true ? array( "list" => $listImg, "js" => $returnJS ) : $listImg.$returnJS;		
	}
	
	function CountImages( $images = "" ){
		global $is_logged, $member_id;
		
		if( $images ) return count( explode( "|||", $images ) );
		
		$return = 0;
		$fileDB = ENGINE_DIR."/data/banki/photos.db";
		$img = file( $fileDB );
		if( count( $img ) > 0 )
			{
				$user = !$is_logged ? $_SERVER['REMOTE_ADDR'] : $member_id['name'];
				foreach( $img as $image )
					{
						$image = explode( "==", $image );
						if( $image[0] != $user ) continue;
						$return++;
					}
			}
		
		return $return;
	}
	
	function ArrayListPhotos( $row = "" ){
		global $is_logged, $member_id;
		
		$edit = false;
		$return = array();
		if( $row['id'] )
			{
				$edit = true;
				$img = $row['photos'] != "" ? explode( "|||", $row['photos'] ) : array();
			}
				else
			{
				$fileDB = ENGINE_DIR."/data/banki/photos.db";
				$img = file( $fileDB );
			}
				
		if( count( $img ) > 0 )
			{
				$user = !$is_logged ? $_SERVER['REMOTE_ADDR'] : $member_id['name'];
				foreach( $img as $image )
					{
						if( $edit === true )
							{
								$image = explode( "###", $image );
								$return[] = array( $image[0], $image[1] );
							}
								else
							{
								$image = explode( "==", $image );
								if( $image[0] != $user ) continue;
								$image[1] = explode( "|||", $image[1] );
										
								$return[] = array( $image[1][0], $image[1][1] );
							}
					}
			}
		
		return $return;
	}
	
	function AddPhotosInfoDB( $photo, $folder, $row = "" ){
		global $member_id, $is_logged, $config, $db;
		
		if( $row['id'] )
			{
				$photos = $row['photos'] != "" ? explode( "|||", $row['photos'] ) : array();
				$photos[] = "{$photo}###{$folder}";
				$photos = $db->safesql( implode( "|||", $photos ) );
				$db->query( "UPDATE ".PREFIX."_banki_post SET `photos`='{$photos}' WHERE `id`='{$row['id']}'" );
				return true;
			}
		
		$added_time = time() + ( $config['date_adjust'] * 60 );
		$date = date( "Y-m-d H:i:s", $added_time );
		$fileDB = ENGINE_DIR."/data/banki/photos.db";
		
		$user = !$is_logged ? $_SERVER['REMOTE_ADDR'] : $member_id['name'];
		$fp = fopen( $fileDB, "a" );
		fwrite( $fp, "{$user}=={$photo}|||{$folder}|||{$date}\n" );
		fclose( $fp );
		@chmod( $fileDB, 0666 );
	}
	
	function CleareOnlyDBImages(){
		global $member_id, $is_logged;
		
		$fileDB = ENGINE_DIR."/data/banki/photos.db";
		$user = !$is_logged ? $_SERVER['REMOTE_ADDR'] : $member_id['name'];
		$file = file( $fileDB );
		$CountDBPhotos = count( $file );
		for( $i = 0; $i < $CountDBPhotos; $i++ )
			{
				$image = explode( "==", $file[ $i ] );
				if( $image[0] != $user ) continue;
				unset( $file[ $i ] );
			}	
				
		unlink( $fileDB );
		$fp = fopen( $fileDB, "a" );
		fwrite( $fp, implode( "", $file ) );
		fclose( $fp );
		@chmod( $fileDB, 0666 );
	}
	
	function CleareTimeDBImages(){
		global $config;
		
		$thisTime = time() + ( $config['date_adjust'] * 60 );
		$fileDB = ENGINE_DIR."/data/banki/photos.db";
		$file = file( $fileDB );
		$CountDBPhotos = count( $file );
		for( $i = 0; $i < $CountDBPhotos; $i++ )
			{
				$image = explode( "==", $file[ $i ] );
				$image[1] = explode( "|||", $image[1] );
				$imgTime = strtotime( $image[1][2] );
								
				if( ( ( $thisTime - $imgTime ) / 60 ) < $Banki->Config['add_post_photo_del'] ) continue;
				
				@unlink( ROOT_DIR."/uploads/banki/post/{$image[1][1]}/{$image[1][0]}" );
				@unlink( ROOT_DIR."/uploads/banki/post/{$image[1][1]}/thumbs/{$image[1][0]}" );
				
				unset( $file[ $i ] );
			}	
				
		@unlink( $fileDB );
		$fp = fopen( $fileDB, "a" );
		fwrite( $fp, implode( "", $file ) );
		fclose( $fp );
		@chmod( $fileDB, 0666 );
	}
	
	//------------------------------------------------=-=-=-=-=
	//	Работа с кэшэм
	//------------------------------------------------=-=-=-=-=
	
	// Чтение кэша
	function OpenCache( $Folder = "", $File, $Page = 0 ){
		
		$File = str_replace( "..", "", $File );
		if( $Page > $this->MaxPageCache ) return false;
		if( $Page > 1 ) $File = "page{$Page}_{$File}";
		if( !file_exists( $this->CacheDir.$Folder.$this->CacheSkin."_".$File ) ) return false;
		
		return @file_get_contents( $this->CacheDir.$Folder.$this->CacheSkin."_".$File );		
	}
	
	// Создание кэша
	function CreateCache( $Folder, $File, $Text, $Page = 0 ){
		
		$File = str_replace( "..", "", $File );
		if( empty( $Text ) ) return false;
		if( $Page > $this->MaxPageCache ) return false;
		if( $Page > 1 ) $File = "page{$Page}_{$File}";
		
		@unlink( $this->CacheDir.$File );
		$fp = fopen( $this->CacheDir.$Folder.$this->CacheSkin."_".$File, "w+");
		fwrite( $fp, $Text );
		fclose( $fp );
		@chmod( $this->CacheDir.$Folder.$this->CacheSkin."_".$File, 0666 );
	}
	
	// Очистка кэша в конкретной папке
	function ClearCache( $Folder, $FileSearch = false ){
		
		$i = 0;
		$OpenDir = opendir( $this->CacheDir.$Folder );
		while( $File = readdir( $OpenDir ) )
			{
				if( $FileSearch !== false )
					{
						if( is_array( $FileSearch ) )
							{
								foreach( $FileSearch as $StrPos )
									{
										if( is_integer( $StrPos ) ) $StrPos = (string) $StrPos;
										if( strpos( $File, $StrPos ) !== false )
											{
												if( @unlink( $this->CacheDir.$Folder.$File ) ) $i++;
												break;
											}
									}
							}
								else
							{
								if( is_integer( $FileSearch ) ) $FileSearch = (string) $FileSearch;
								if( strpos( $File, $FileSearch ) !== false )
									{
										if( @unlink( $this->CacheDir.$Folder.$File ) ) $i++;
									}
							}
					}
						else
					{
						if( @unlink( $this->CacheDir.$Folder.$File ) ) $i++;
					}
			}
		
		return $i;
	}
	
	// Обновление просмотра страниц
	function ClearCacheCountPost(){
		global $db;
		
		$FileOpen = ENGINE_DIR."/data/banki/post.cat.count.db";
		if( file_exists( $FileOpen ) )
			{
				$IDView = array();
				$File = file( $FileOpen );
				foreach( $File as $value )
					{
						$value = explode( "|", trim( $value ) );
						$id = intval( $value[0] );
						$type = $value[1];
						if( $id )
							{
								$IDView[] = $id;
								$this->DB['category'][ $id ]['count_post'] = intval( $this->DB['category'][ $id ]['count_post'] );
								if( $type == "plus" )
									$this->DB['category'][ $id ]['count_post']++;
								else
									$this->DB['category'][ $id ]['count_post']--;
							}
					}
				
				if( count( $IDView ) > 0 )
					{
						foreach( $IDView as $id )
							{
								$Options = $db->safesql( $this->CompileOpt( $this->DB['category'][ $id ] ) );
								$db->query( "UPDATE ".PREFIX."_banki_options SET `options`='{$Options}' WHERE `id`='{$id}' LIMIT 1" );
							}
					}
				
				unset( $IDView );
				@unlink( $FileOpen );
			}
	}
	
	// Крон ( 1 - время в минутах, 2 - уникальный префикс, 3 - папки которые необходимо очищать, 4 - запуск функции класса )
	function Cron( $Period, $CronName, $OpenMethod = "" ){
		global $db, $config;
		
		$Period = $Period * 60;
		$ThisTime = ( time() + ( $config['date_adjust'] * 60 ) );
		if( ( $this->Cron[ $CronName ] + $Period ) < $ThisTime )
			{
				if( $OpenMethod && method_exists( $this, $OpenMethod ) ) $this->$OpenMethod();
				$this->CronUpdate( array( $CronName => $ThisTime ) );
			}
	}
	
	// Обновление статистики крона
	function CronUpdate( $Update = array() ){
		
		$SaveOpt = $Update + $this->Cron;
		$fp = fopen( ENGINE_DIR."/data/banki/cron.php", "w+" );
		fwrite( $fp, "<?php\n\n//Задачи кронов модуля Banki (Powered by  )\n\n\$BankiCronConfig = array(\n" );
		foreach( $SaveOpt as $Name => $Value )
			{
				$Name = addslashes( stripslashes( $Name ) );
				$Value = addslashes( stripslashes( $Value ) );
				
				fwrite( $fp, "\t\"{$Name}\" => \"{$Value}\",\n" );
			}
		
		fwrite( $fp, ");\n\n?>" );
		fclose( $fp );
	}
	
	// Очистка всего кэша
	function CleareAllCache(){
		
		$NotDelFile = array( ".", "..", ".htaccess", "fields.banki.db", "photos.db", "cron.php", "post.cat.count.db", "post.views.db", "tpl.email.php" );
		$dir = opendir( ENGINE_DIR."/data/banki/" );
		while( $file = readdir( $dir ) )
			{
				if( !in_array( $file, $NotDelFile ) )
					{
						@unlink( ENGINE_DIR."/data/banki/".$file );
					}
			}
		
		
		$this->UpdateColor();
		$this->UpdateDBViews();
		$this->ClearCacheCountPost();
		$this->CleareTimeDBImages();
		$this->ClearCache( "" );
		$this->ClearCache( "category/" );
		$this->ClearCache( "rss/" );

	}
	
	
	
	
	
	
	
	function UpdateColor(){
		global $db, $config;
		
		$thisTime = time() + ( $config['date_adjust'] * 60 );
		$db->query( "UPDATE ".PREFIX."_banki_post SET `color_date`='' WHERE `color_date` < '{$thisTime}'" );
	}
	
	function UpdateDBViews(){
		global $db;
		
		$FileOpen = ENGINE_DIR."/data/banki/post.views.db";
		if( file_exists( $FileOpen ) )
			{
				$IDView = array();
				$File = file( $FileOpen );
				foreach( $File as $id )
					{
						$id = intval( $id );
						if( $id ) $IDView[ $id ]++;
					}
				
				if( count( $IDView ) > 0 )
					{
						$AllowID = array();
						$SqlIDView = "";
						foreach( $IDView as $id => $count )
							{
								$SQLIDView .= "WHEN id='{$id}' THEN views + {$count} ";
								$AllowID[] = $id;
							}
						
						$AllowID = implode( ",", $AllowID );
						$db->query( "UPDATE ".PREFIX."_banki_post SET views = CASE {$SQLIDView} END WHERE id IN ({$AllowID})" );
					}
				
				unset( $IDView );
				unset( $AllowID );
				unset( $SqlIDView );
				@unlink( $FileOpen );
			}
	}
}

$Banki = new Banki;
$Banki->Start();

?>