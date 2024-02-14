<?php
/*
 This code is protected by copyright
=====================================================
 File: otziv.php
-----------------------------------------------------
 Use: otziv moder
=====================================================
*/
if( !defined( 'DATALIFEENGINE' ) OR !defined( 'LOGGED_IN' ) ) {
	header( "HTTP/1.1 403 Forbidden" );
	header ( 'Location: ../../' );
	die( "Hacking attempt!" );
}

if( ! $user_group[$member_id['user_group']]['admin_comments'] ) {
	msg( "error", $lang['index_denied'], $lang['index_denied'], "?mod=main" );
}


if ($config['allow_comments_wysiwyg'] == "2") {
	
	$js_array[] = "engine/editor/jscripts/tiny_mce/tinymce.min.js";
	
}

if ($config['allow_comments_wysiwyg'] == "1") {
	
	$js_array[] = "engine/skins/codemirror/js/code.js";
	$js_array[] = "engine/editor/jscripts/froala/editor.js";
	$js_array[] = "engine/editor/jscripts/froala/languages/{$lang['wysiwyg_language']}.js";
	$css_array[] = "engine/editor/jscripts/froala/css/editor.css";
	
}

echoheader( "<i class=\"fa fa-home position-left\"></i><span class=\"text-semibold\">Модерация отзывов</span>","<a href=\"$PHP_SELF?mod=offers\">Каталог офферов 7.0</a> / Модерация отзывов" );
	
$entries = "";

$db->query( "SELECT " . PREFIX . "_offers_comments.id, " . PREFIX . "_offers_comments.offers_id, " . PREFIX . "_offers_comments.otziv, " . PREFIX . "_offers_comments.tit_otziv, ". PREFIX . "_offers_comments.otziv, " . PREFIX . "_offers_comments.name_otziv, " . PREFIX . "_offers_comments.date, " . PREFIX . "_offers_comments.author, " . PREFIX . "_offers_comments.text, " . PREFIX . "_offers_post.title, " . PREFIX . "_offers_post.category FROM " . PREFIX . "_offers_comments LEFT JOIN " . PREFIX . "_offers_post ON " . PREFIX . "_offers_comments.offers_id=" . PREFIX . "_offers_post.id WHERE " . PREFIX . "_offers_comments.approve = '0' ORDER BY " . PREFIX . "_offers_comments.date DESC" );

while ( $row = $db->get_array() ) {

	$row['text'] = "<div id='comm-id-" . $row['id'] . "'>" . stripslashes( $row['text'] ) . "</div>";
	$row['newsdate'] = strtotime( $row['newsdate'] );
	$row['date'] = strtotime( $row['date'] );
	if( !$langformatdatefull ) $langformatdatefull = "d.m.Y H:i:s";
	$date = date( $langformatdatefull, $row['date'] );
	$offers_id =  stripslashes( $row['offers_id'] );
	
	$otziv =  stripslashes( $row['otziv'] );
	$tit_otziv =  stripslashes( $row['tit_otziv'] );
	$name_otziv =  stripslashes( $row['name_otziv'] );
	$news_title =  stripslashes( $row['title'] ) ;
	$row['author'] = "<a href=\"?mod=editusers&action=edituser&user=".urlencode($row['author'])."\" target=\"_blank\">{$row['author']}</a>";
	
	$entries .= <<<HTML
<div id='table-comm-{$row['id']}' class="panel panel-default">
  <div class="panel-heading">
    <span class="label label-info position-left">Логин:</span><strong class="position-left">{$row['author']}</strong><span class="label label-info position-left">ФИО:</span> <strong class="position-left">{$name_otziv}</strong> <span class="label label-info position-left">Оффер:</span> <strong class="position-left">{$news_title}</strong> <span class="label label-info position-left">Оценка:</span> <strong class="position-left">{$otziv}</strong>
  </div>
  <div class="panel-body">
	<b>Заголовок отзыва:</b> {$row['tit_otziv']}
  </div>
  <div class="panel-body"> 
  <b>Полный текст отзыва:</b>
  {$row['text']}
  </div>
  <div class="panel-footer">
    <button id="save-button-{$row['id']}" onclick="public_comm('{$row['id']}', '{$row['offers_id']}' , '{$row['otziv']}'); return false;" type="button" class="btn bg-teal btn-sm btn-raised position-left"><i class="fa fa-check-square-o position-left"></i>{$lang['bb_b_approve']}</button>
	<button onclick="ajax_comm_edit('{$row['id']}'); return false;" type="button" class="btn bg-primary-600 btn-sm btn-raised position-left"><i class="fa fa-pencil-square-o position-left"></i>{$lang['group_sel1']}</button>
	<button onclick="DeleteComments('{$row['id']}', '{$row['offers_id']}'); return false;" type="button" class="btn bg-danger btn-sm btn-raised"><i class="fa fa-trash-o position-left"></i>{$lang['edit_dnews']}</button>
	<span class="pull-right" style="margin-top: 4px;"><i class="fa fa-clock-o position-left"></i>{$date}</span>
  </div>
</div>

HTML;

}

$db->free();


echo <<<HTML
<style type="text/css">
.bb-pane {
  height: 1%; overflow: hidden;
  padding-bottom: 5px;
  padding-left: 5px;
  margin: 0;
  height: auto !important;
  text-decoration:none;
  border-bottom-left-radius: 0px;
  border-top:1px solid #cccccc;
  border-left:1px solid #cccccc;
  border-right:1px solid #cccccc;
  box-shadow: none !important;
  margin: 0;
  text-decoration: none;
  box-shadow: none !important;
  background-color: #f6f6f6;
}
.dle_theme_dark .bb-pane {
    color: #fefefe;
    background-color: #363636;
    border-color: #363636;
}
.bb-pane>b {
    margin-top: 5px;
    margin-left: 0;
	vertical-align: middle;
}
.bb-pane .bb-btn + .bb-btn, .bb-pane .bb-btn + .bb-pane,.bb-pane .bb-pane + .bb-btn,.bb-pane .bb-pane + .bb-pane {
    margin-left:-1px;
}
.bb-btn {
	display: inline-block; overflow: hidden; float: left;
	padding: 4px 10px;
    border: 1px solid transparent;
}
 

.bb-btn:hover {
	background-color: #e6e6e6;
    border: 1px solid rgba(0, 0, 0, 0.23);
}

.dle_theme_dark .bb-btn:hover {
	background-color: transparent;
    border: 1px solid rgba(0, 0, 0, 0.23);
}

.bb-editor textarea { 
	font-size: 12px;
	font-family: verdana;
	-webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
	box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
	-webkit-transition: border-color ease-in-out 0.15s, box-shadow ease-in-out 0.15s;
	transition: border-color ease-in-out 0.15s, box-shadow ease-in-out 0.15s;
	-webkit-border-radius: 0;
	border-radius: 0;
	color: #000;
	padding: 3px 5px 3px 5px;
	border:1px solid #cccccc;
	background: #ffffff;
	resize: vertical;
	outline: none;
	height: 300px;
	width: 100%;
}
.dle_theme_dark .bb-editor textarea {
    color: #ddd;
    background-color: #262626;
	border:1px solid #363636;
}
.ui-dialog input[type="text"], input[type="password"], textarea {
  -webkit-box-shadow:inset 0 1px 1px rgba(0, 0, 0, 0.075);
  box-shadow:inset 0 1px 1px rgba(0, 0, 0, 0.075);
  -webkit-transition:border-color ease-in-out 0.15s, box-shadow ease-in-out 0.15s;
  transition:border-color ease-in-out 0.15s, box-shadow ease-in-out 0.15s;
  -webkit-border-radius: 0;
  border-radius: 0;
  color: #000;
  padding: 3px 5px 3px 5px;
  border: 1px solid #cccccc;
  display: inline-block;
  background: #ffffff;
  font-size: 13px;
}

.ui-dialog input[type="text"]:focus, input[type="password"]:focus, .ui-dialog textarea:focus {
    border: 1px solid #009688; 
}

.dle_theme_dark .ui-dialog input[type="text"], .dle_theme_dark .ui-dialog input[type="password"], .dle_theme_dark .ui-dialog textarea {
  color: #fefefe;
  background-color: #555;
  border-color: #cbcbcb;
}

	.bb-pane-dropdown {
		position: absolute;
		top: 100%; left: 0;
		z-index: 1000;
		display: none;
		min-width: 180px;
		padding: 5px 0 !important;
		margin: 2px 0 0;
		list-style: none;
		font-size: 11px;
		border-radius: 2px;
		background: #fff;
		background-clip: padding-box;
		-webkit-box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
		max-height: 300px;
    	overflow: auto;
	}
	.bb-pane-dropdown > li > a {
		display: block;
		padding: 3px 10px;
		clear: both;
		font-weight: normal;
		line-height: 1.42857;
		color: #353535;
		white-space: nowrap;
	}
	.bb-pane-dropdown > li > a:hover { text-decoration:none; color: #262626; background-color:whitesmoke; }
	.bb-pane-dropdown .color-palette div .color-btn {
		width: 17px; height: 17px;
		padding: 0; margin: 0;
		border: 1px solid #fff;
		cursor: pointer;
	}
	.bb-pane-dropdown .color-palette { padding: 0px 5px; }

	.bb-pane-dropdown table { margin: 0px; }
	
	.dle_theme_dark .bb-pane-dropdown {
		color: #fefefe;
		background-color: #363636!important;
	}
	
	.bb-sel { float: left; padding: 2px 2px 0 2px; }
	.bb-sel select { font-size: 11px; }
	.bb-sep { display: inline-block; float: left; width: 1px; padding: 2px; }
	.bb-btn { cursor: pointer;  outline: 0; }

	#b_font select, #b_size select { padding: 0;}

	.bb-pane h1, .bb-pane h2, .bb-pane h3, .bb-pane h4, .bb-pane h5, .bb-pane h6 { margin-top: 5px; margin-bottom: 5px; }
	.bb-pane h1 { font-size: 36px; }
	.bb-pane h2 { font-size: 30px; }
	.bb-pane h3 { font-size: 24px; }
	.bb-pane h4 { font-size:18px; }
	.bb-pane h5 { font-size:14px; }
	.bb-pane h6 { font-size:12px; }

	[class^="bb-btn"], [class*=" bb-btn"] {
	    font-family: 'bb-editor-font';
	    speak: none;
	    font-style: normal;
	    font-weight: normal;
	    font-variant: normal;
	    text-transform: none;
	    line-height: 1;
	    font-size: 14px;
	    -webkit-font-smoothing: antialiased;
	    -moz-osx-font-smoothing: grayscale;
	}

	.bb-sel { float: left; padding: 2px 2px 0 2px; }
	.bb-sel select { font-size: 11px; }
	.bb-sep { display: inline-block; float: left; width: 1px; padding: 2px; }
	.bb-btn { cursor: pointer;  outline: 0; }

	#b_font select, #b_size select { padding: 0;}

	#b_b:before {content: "\\f032";}
	#b_i:before {content: "\\f033";}
	#b_u:before {content: "\\f0cd";}
	#b_s:before {content: "\\f0cc";}
	#b_img:before { content: "\\f03e"; }
	#b_up:before { content: "\\e930"; }
	#b_emo:before { content: "\\f118"; }
	#b_url:before { content: "\\f0c1"; }
	#b_leech:before { content: "\\e98d"; }
	#b_mail:before { content: "\\f003"; }
	#b_video:before { content: "\\e913"; }
	#b_audio:before { content: "\\e911"; }
	#b_hide:before { content: "\\e9d1"; }
	#b_quote:before { content: "\\e977"; }
	#b_code:before { content: "\\f121"; }
	#b_left:before { content: "\\f036"; }
	#b_center:before { content: "\\f037"; }
	#b_right:before { content: "\\f038"; }
	#b_color:before { content: "\\e601"; }
	#b_spoiler:before { content: "\\e600"; }
	#b_fla:before { content: "\\ea8d"; }
	#b_yt:before { content: "\\f16a"; }
	#b_tf:before { content: "\\ea61"; }
	#b_list:before { content: "\\f0ca"; }
	#b_ol:before { content: "\\f0cb"; }
	#b_tnl:before { content: "\\ea61"; }
	#b_br:before { content: "\\ea68"; }
	#b_pl:before { content: "\\ea72"; }
	#b_size:before { content: "\\f034"; }
	#b_font:before { content: "\\f031"; }
	#b_header:before { content: "\\f1dc"; }
	#b_sub:before { content: "\\f12c"; }
	#b_sup:before { content: "\\f12b"; }
	#b_justify:before { content: "\\f039"; }
	.bbcodes {
		display:inline-block;
		padding: 4px 10px;
		margin-bottom:0;
		line-height: 1.5;
		cursor:pointer;
		border-width: 0;
        background-color: #1e88e5;
        border-color: #1e88e5;
        color: #fff;
		border-radius: 3px;
		white-space:nowrap;
		outline:0;
        -webkit-box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
        -webkit-transition: all ease-in-out 0.15s;
        transition: all ease-in-out 0.15s;

	}
	.bbcodes:hover {
      -webkit-box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.23);
      box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.23);
	}
	 .btn:focus {
		outline:0;
	}
</style>
<script type="text/javascript">
<!--

var c_cache = [];
var dle_root = '';
var dle_prompt = '{$lang['p_prompt']}';
var dle_wysiwyg    = '{$config['allow_comments_wysiwyg']}';

function setNewField(which, formname)
{
	if (which != selField)
	{
		fombj    = formname;
		selField = which;

	}
};

function ajax_comm_edit( c_id )
{

	for (var i = 0, length = c_cache.length; i < length; i++) {
	    if (i in c_cache) {
			if ( c_cache[ i ] !== '' )
			{
				ajax_cancel_comm_edit( i );
			}
	    }
	}

	if ( ! c_cache[ c_id ] || c_cache[ c_id ] === '' )
	{
		c_cache[ c_id ] = $('#comm-id-'+c_id).html();
	}

	ShowLoading('');

	$.get("engine/ajax/controller.php?mod=editotzivoffers", { id: c_id, area: 'news', action: "edit" }, function(data){

		HideLoading('');

		$('#comm-id-'+c_id).html(data);

		setTimeout(function() {
           $("html,body").stop().animate({scrollTop: $("#comm-id-" + c_id).offset().top - 70}, 700);
        }, 100);

	}, 'html');
	return false;
};

function ajax_cancel_comm_edit( c_id ) {
	if ( c_cache[ c_id ] != "" )
	{
		$("#comm-id-"+c_id).html(c_cache[ c_id ]);
	}

	c_cache[ c_id ] = '';

	return false;
};

function ajax_save_comm_edit( c_id, area ) {

	if (dle_wysiwyg == "2") {

		tinyMCE.triggerSave();

	}

	var comm_txt = $('#dleeditcomments'+c_id).val();


	ShowLoading('');

	$.post("engine/ajax/controller.php?mod=editotzivoffers", { id: c_id, comm_txt: comm_txt, area: area, action: "save", user_hash: "{$dle_login_hash}" }, function(data){

		HideLoading('');
		c_cache[ c_id ] = '';
		ShowOrHide('table-comm-'+c_id);

	});
	return false;
	
};

function public_comm( c_id, offers_id, otziv ) {

	ShowLoading('');

	$.post('engine/ajax/controller.php?mod=moderoffers', { id: c_id, offers_id:offers_id, otziv: otziv, action: "commentspublic", user_hash: '{$dle_login_hash}' }, function(data){
	
		HideLoading('');
		ShowOrHide('table-comm-'+c_id);
	
	});

	return false;
};

function DeleteComments(id, offers_id) {

    DLEconfirm( 'Вы уверены что хотите удалить данный отзыв?', '{$lang['p_confirm']}', function () {

		ShowLoading('');
	
		$.get("engine/ajax/controller.php?mod=delotzivoffers", { id: id, offers_id: offers_id }, function(data){
	
			HideLoading('');
	
			ShowOrHide('table-comm-'+id);
	
		});

	} );

};

function ckeck_uncheck_all() {
    var frm = document.dlemasscomments;
    for (var i=0;i<frm.elements.length;i++) {
        var elmnt = frm.elements[i];
        if (elmnt.type=='checkbox') {
            if(frm.master_box.checked == true){ elmnt.checked=false; $(elmnt).parents('.panel').find('.panel-body').removeClass('warning'); }
            else{ elmnt.checked=true; $(elmnt).parents('.panel').find('.panel-body').addClass('warning'); }
        }
    }
    if(frm.master_box.checked == true){ frm.master_box.checked = false; }
    else{ frm.master_box.checked = true; }
	
	$.uniform.update();
	
	return false;
};
$(function() {
    $('.heading-elements input[type=checkbox]').on('change', function() {
        if($(this).is(':checked')) {
            $(this).parents('.panel').find('.panel-body').addClass('warning');
        }
        else {
            $(this).parents('.panel').find('.panel-body').removeClass('warning');
        }
    });
});
//-->
</script>
<form action="" method="post" name="dlemasscomments" id="dlemasscomments">
<input type="hidden" name="mod" value="cmoderation">
<input type="hidden" name="user_hash" value="{$dle_login_hash}" />
<div class="panel panel-flat">
	<div class="panel-heading">
		<span class="text-semibold" style="font-size:15px;">Отзывы ожидающие модерации</span>
	</div>
</div>
{$entries}
<div class="pull-right">
</div>
</form>
HTML;

	if( strpos ( $entries, "dlevideoplayer" ) !== false ) {
		echo <<<HTML
		<link href="{$config['http_home_url']}engine/classes/html5player/player.css" rel="stylesheet" type="text/css">
		<script type="text/javascript" src="{$config['http_home_url']}engine/classes/html5player/player.js"></script>
		<script type="text/javascript">$(".dlevideoplayer").cleanvideoplayer();</script>
HTML;

	}

echofooter();
?>