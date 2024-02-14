<?php
/*
=====================================================
 Файл: bb_comment.php
=====================================================
 Данный код защищен авторскими правами
=====================================================
 Назначение: BB Code
=====================================================
*/
if( !defined( "DATALIFEENGINE" ) ) die( "Hacking attempt!" );


include_once ENGINE_DIR . '/classes/plugins.class.php';

$i = 0;
$output = "";
$smilies = explode( ",", $config['smilies'] );
foreach($smilies as $smile)
	{
		$i++;
		$smile = trim( $smile );
		$output .= "<td style=\"padding:2px;\" align=\"center\"><a href=\"#\" onClick=\"dle_smiley(':$smile:'); return false;\"><img style=\"border: none;\" alt=\"$smile\" src=\"".$config['http_home_url']."engine/data/emoticons/$smile.gif\" /></a></td>";
		
		if( $i % 3 == 0 ) $output .= "</tr><tr>";
	}

$output = <<<HTML

<table cellpadding="0" cellspacing="0" border="0" width="120">
	<tr>
		$output
	</tr>
</table>

HTML;

$startform = "comments"; 
  $addform = "document.forms['AddBankiComment']";
  $add_id = false;

   if ($user_group[$member_id['user_group']]['allow_url'])
   {
      $url_link = "<b id=\"b_url\" class=\"bb-btn\" onclick=\"tag_url()\" title=\"{$lang['bb_t_url']}\">{$lang['bb_t_url']}</b><b id=\"b_leech\" class=\"bb-btn\" onclick=\"tag_leech()\" title=\"{$lang['bb_t_leech']}\">{$lang['bb_t_leech']}</b>";
   } 
   else $url_link = "";

   if ($user_group[$member_id['user_group']]['allow_image'])
   {
      $image_link = "<b id=\"b_img\" class=\"bb-btn\" onclick=\"tag_image()\" title=\"{$lang['bb_b_img']}\">{$lang['bb_b_img']}</b>";
   } 
   else $image_link = "";

$code = <<<HTML
<div class="bb-editor">

<div id="dle_emos" style="display: none;" title="{$lang['bb_t_emo']}"><div style="width:100%;height:100%;overflow: auto;">{$output}</div></div>
<textarea name="comments" id="comments" cols="70" rows="10" onfocus="setNewField(this.name, document.getElementById( 'dle-comments-form' ))"></textarea>
</div>
HTML;

if( version_compare( $config['version_id'], "8.3", ">" ) )
	$script_code = @file_get_contents( ENGINE_DIR."/classes/js/bbcodes.js" );
else
	$script_code = @file_get_contents( ENGINE_DIR."/ajax/bbcodes.js" );

$script_code .= <<<HTML

-->
</script>
HTML;

$bb_code = <<<HTML
<script language="javascript" type="text/javascript">
<!--
var text_enter_url       = "$lang[bb_url]";
var text_enter_size       = "$lang[bb_flash]";
var text_enter_flash       = "$lang[bb_flash_url]";
var text_enter_page      = "$lang[bb_page]";
var text_enter_url_name  = "$lang[bb_url_name]";
var text_enter_page_name = "$lang[bb_page_name]";
var text_enter_image    = "$lang[bb_image]";
var text_enter_email    = "$lang[bb_email]";
var text_code           = "$lang[bb_code]";
var text_quote          = "$lang[bb_quote]";
var text_upload         = "$lang[bb_t_up]";
var error_no_url        = "$lang[bb_no_url]";
var error_no_title      = "$lang[bb_no_title]";
var error_no_email      = "$lang[bb_no_email]";
var prompt_start        = "$lang[bb_prompt_start]";
var img_title   		= "$lang[bb_img_title]";
var email_title  	    = "$lang[bb_email_title]";
var text_pages  	    = "$lang[bb_bb_page]";
var image_align  	    = "{$config['image_align']}";
var bb_t_emo  	        = "{$lang['bb_t_emo']}";
var bb_t_col  	        = "{$lang['bb_t_col']}";
var text_enter_list     = "{$lang['bb_list_item']}";
var text_alt_image      = "{$lang['bb_alt_image']}";
var img_align  	        = "{$lang['images_align']}";
var img_align_sel  	    = "<select name='dleimagealign' id='dleimagealign' class='ui-widget-content ui-corner-all'><option value='' {$image_align[0]}>{$lang['images_none']}</option><option value='left' {$image_align['left']}>{$lang['images_left']}</option><option value='right' {$image_align['right']}>{$lang['images_right']}</option><option value='center' {$image_align['center']}>{$lang['images_center']}</option></select>";

var selField  = "{$startform}";
var fombj    = {$addform};

function image_upload()
{

window.open('{$config['http_home_url']}engine/images.php?area=' + selField + '&add_id={$add_id}', '_Addimage', 'toolbar=0,location=0,status=0, left=0, top=0, menubar=0,scrollbars=yes,resizable=0,width=640,height=550');    

}
{$script_code}
{$code}
HTML;

?>