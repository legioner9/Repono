<?php


if( !defined( "DATALIFEENGINE" ) ) die( "Hacking attempt!" );

require_once( ENGINE_DIR."/inc/offers/init.php" );

$do = $_REQUEST['do'];
$action = $_REQUEST['action'];


$navigation = ($do != '') ? '<a href="'.$config['admin_path'].'?mod=offers">Офферы 1.0</a>' : 'Офферы 1.0';
define('MOD_DIR', ENGINE_DIR.'/inc/offers'); // Путь к файлам с модуля
define ('ADMIN_DIR', MOD_DIR.'/list');

switch ($do) {
    case "category":    include ADMIN_DIR.'/category.php';   break;
    case "post":   include ADMIN_DIR.'/post.php';  break;
	case "edit_post":   include ADMIN_DIR.'/edit_post.php';  break;
    case "set":    include ADMIN_DIR.'/set.php';   break;
    case "add_post":   include ADMIN_DIR.'/add_post.php';  break;
    case "fields":     include ADMIN_DIR.'/fields.php';    break;
    case "blocks":       include ADMIN_DIR.'/blocks.php';    break;
    case "info":        include ADMIN_DIR.'/info.php';       break;
	case "add_category":        include ADMIN_DIR.'/add_category.php';       break;
	case "edit_category":        include ADMIN_DIR.'/edit_category.php';       break;
	case "add_block":        include ADMIN_DIR.'/add_block.php';       break;
	case "edit_block":        include ADMIN_DIR.'/edit_block.php';       break;
	case "edit_fields":        include ADMIN_DIR.'/edit_fields.php';       break;
	case "add_fields":        include ADMIN_DIR.'/add_fields.php';       break;
	case "activation":        include ADMIN_DIR.'/activation.php';       break;
	case "licenz":        include ADMIN_DIR.'/licenz.php';       break;
	case "otziv":        include ADMIN_DIR.'/otziv.php';       break;
	case "cotziv":        include ADMIN_DIR.'/cotziv.php';       break;
    case "clearcache":
        faq_clearcache(1);
        msg("info", $faq_lang['info'], $faq_lang['cache_success_clean'], "$PHP_SELF?mod=offers");
    break;
    default:
        include ADMIN_DIR.'/main.php';
}


//----------------------------------------------------
//  Открытие ячейки
//----------------------------------------------------


function tpl_table_open($navigation){
    echo <<<HTML
		
		
		<div class="panel panel-default">
		
		    <div class="panel-heading">
				{$navigation}
			</div>
	
HTML;
}

function redactor(){
    echo <<<HTML
	
<script src="engine/editor/jscripts/tiny_mce/tinymce.min.js"></script>
<script>

    function save_reply(btn_elem){
        var blc = $(btn_elem).parent().parent();
        var id = $(blc).attr('id').split('-')[1];
        var text = $('input[name="reply"]', blc).val();
        var type = $('select[name="replyType"]', blc).val();
        var table = $('input[name="table"]', blc).val();
        
        
        ShowLoading('');
        $.post("engine/ajax/controller.php?mod=reply_editor", 
        {
            id: id,
            text: text,
            type: type,
            table: table
        }, function(data){
            HideLoading('');
        });
    }

    jQuery(function ($) {
        tinyMCE.baseURL = '/engine/editor/jscripts/tiny_mce';
        tinyMCE.suffix = '.min';

        if (dle_theme === null) dle_theme = '';
        tinymce.init({
            selector: 'textarea.set_tinyMCE',
            language: "ru",
            element_format: 'html',
            body_class: dle_theme,
            width: "100%",
            height: 200,
            plugins: ["fullscreen advlist autolink lists link image charmap anchor searchreplace visualblocks visualchars media nonbreaking table contextmenu emoticons paste textcolor colorpicker codemirror spellchecker dlebutton codesample hr"],
            relative_urls: false,
            convert_urls: false,
            remove_script_host: false,
            toolbar_items_size: 'small',
            verify_html: false,
            branding: false,
            menubar: false,
            image_advtab: true,
            image_dimensions: false,
            image_caption: true,
            toolbar1: "formatselect fontselect fontsizeselect | link anchor dleleech unlink | dleupload image dleemo dlemp dletube dlaudio | dlehide dlequote dlespoiler codesample hr visualblocks dlebreak dlepage code",
            toolbar2: "undo redo | copy paste pastetext | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | subscript superscript | table bullist numlist | forecolor backcolor | spellchecker dletypo removeformat searchreplace fullscreen",
            formats: {
                bold: {inline: 'b'},
                italic: {inline: 'i'},
                underline: {inline: 'u', exact: true},
                strikethrough: {inline: 's', exact: true}
            },
            codesample_languages: [{text: 'HTML/JS/CSS', value: 'markup'}],
            spellchecker_language: "ru",
            spellchecker_languages: "Russian=ru,Ukrainian=uk,English=en",
            spellchecker_rpc_url: "https://speller.yandex.net/services/tinyspell",

            dle_root: "",
            dle_upload_area: "short_story",
            dle_upload_user: "redaktor",
            dle_upload_news: "81",

            content_css: "engine/editor/css/content.css"

        });
    });
    
    
    
<!--
var dle_act_lang   = ["Да", "Нет", "Ввод", "Отмена", "Загрузка изображений и файлов на сервер"];
var cal_language   = {en:{months:['Январь','Февраль','Март','Апрель','Май','Июнь','Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь'],dayOfWeek:["Вс", "Пн", "Вт", "Ср", "Чт", "Пт", "Сб"]}};
var filedefaulttext= 'Файл не выбран';
var filebtntext    = 'Выберите файл';
var dle_login_hash = 'bbf56b5f28f8943c1313674ee3c88864d101aacc';
//-->
</script>

HTML;
}

function tpl_table_close(){

    echo <<<HTML
                     </div>
             </div>

HTML;

}



$OpenTableStyle = false;
function opentable( $style = false ) {
	global $OpenTableStyle;
  
	if( $style === true || $OpenTableStyle === false )
		{
			$OpenTableStyle = true;
			echo "";
		}
   
echo <<<HTML
<div class="panel panel-default">
HTML;

}

//----------------------------------------------------
//  Закрытие ячейки
//----------------------------------------------------

//----------------------------------------------------
//  Закрытие ячейки
//----------------------------------------------------

function closetable() {
	
echo <<<HTML
</div>
HTML;
}


//----------------------------------------------------
//  Название ячейки
//----------------------------------------------------

function tableheader($value, $right = "", $unterline="unterline") {
	if( $right ) $right = "<div class=\"titleRight\">{$right}</div>";
	echo <<<HTML
		<div class="panel-heading">
			{$value}
			</div>
			
		
HTML;
}

//----------------------------------------------------
//  Название ячейки
//----------------------------------------------------

function tableheaderList($value,$right="") {
	if( $right ) $right = "<div class=\"titleRight\">{$right}</div>";
	echo <<<HTML
		
		<div class="box-header">
			<div class="title">{$value}</div>
			{$right}
		</div>
		<div class="box-content">
HTML;
}

//----------------------------------------------------
// Полоса разделения
//----------------------------------------------------

function unterline() {
echo <<<HTML
<div class="unterline"></div>
HTML;
}

//----------------------------------------------------
//  Отображение заголовка и описание настройки
//----------------------------------------------------

function showRow( $title="", $description="", $field="" ){

echo <<<HTML

<tr>
        <td class="col-xs-6 col-sm-6 col-md-7"><h6 class="media-heading text-semibold">$title</h6><span class="text-muted text-size-small hidden-xs">$description</span></td>
        <td class="col-xs-6 col-sm-6 col-md-5">$field</td>
</tr>


HTML;
   
}



function showRowWatermark( $title = "", $description = "", $name = "save_con[water_mark_position]", $value = 9 ){
	
	$max = 9;
	$OnLine = 3;
	$List = "";
	$value = ( $value < 1 || $value > $max ) ? $max : intval( $value );
	
	for( $i = 1; $i <= $max; $i++ )
		{			
			$checked = $i == $value ? "checked=\"checked\"" : "";
			$List .= "<td align=\"center\"><input type=\"radio\" name=\"{$name}\" value=\"{$i}\" {$checked} /></td>";
			if( $i % $OnLine == 0 && $i != $max ) $List .= "</tr><tr height=\"26px\">";	
		}

echo <<<HTML

<table width="100%" border="0">
	<tr onmouseover ="this.bgColor = '#FAF4C7'" onmouseout  ="this.bgColor = '#FFFFFF'" $id>
		<td style="padding:4px" class="option"><b>$title</b><br /><span class="small">$description</span></td>
		<td width="250" align="left" style="padding: 7px 0px 7px 0px;">
			<div style="border: 1px solid #ccc; width: 95px; padding: 2px 1px 4px 3px;">
				<table width="90px" border="0" cellpadding="0" cellspacing="0">
					<tr height="26px">
						{$List}
					</tr>
				</table>
			</div>
		</td>
	</tr>
	<tr>
		<td style="border-bottom: 1px dotted #ccc;" height="1" colspan="2"></td>
	</tr>
</table>

HTML;
   
}

//----------------------------------------------------
//  Функция выбора опций (Включить/Выключить)
//----------------------------------------------------

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
			else
		{
			return false;	
		}
		
	return false;
}

function makeDropDown( $options, $name, $selected, $disabled = false, $multiple = false ){ 

	if( $disabled ) $disabled = "disabled";
	if( $multiple ) $multiple = "multiple=\"multiple\"";
	$output = "<select class=\"btn-group bootstrap-select uniform\" name=\"$name\" {$disabled} {$multiple}>\r\n";
	foreach( $options as $value => $description )
		{
			$output .= "<option value=\"$value\"";
			if( is_array( $selected ) )
				{
					if( in_array( $value, $selected ) ) $output .= " selected=\"selected\" ";
				}
					else
				{
					if( trim( $selected ) == trim( $value ) ) $output .= " selected=\"selected\" ";
				} 
					  
			$output .= ">$description</option>\n";
		}
		
	$output .= "</select>";
	return $output;
}

//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
//  Выбор групп пользователей
//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

function OffersGroups( $selected, $visitor = "yes", $all = false ) {
	global $user_group;
	
	foreach( $user_group as $groups ) 
		{    
			$group_id = $groups['id'];    
			if( $group_id == 5 && $visitor != "yes" )
				$visitor_ok = false;
			else
				$visitor_ok = true;
				
			if( $visitor_ok )
				{
					$result .= "<option value=\"{$groups['id']}\"";
					if( in_array( $groups['id'], $selected ) ) 
						{
							$result .= " selected";
						} 
					
					$result .= ">".$groups['group_name']."</option>";
				}
		}
	
	if( $all )
		{
			$select = in_array( "all", $selected ) || count( $selected ) < 1 || !$selected[0] ? "selected=\"selected\"" : "";
			$result = "<option value=\"all\" {$select}> - Все - </option>{$result}";
		}
	
	return $result;
}


//----------------------------------------------------
// Спсиок групп
//----------------------------------------------------

function SelectGroup( $select = array(), $not = array() ){
	global $user_group;
	
	if( !is_array( $select ) ) $select = array();
	if( !is_array( $not ) ) $not = array();
	foreach( $user_group as $row )
		{
			$id = $row['id'];
			$title = stripslashes( $row['group_name'] );
					
			if( !in_array( $id, $not ) )
				{
					if( in_array( $id ,$select ) )
						$selected = "selected=\"selected\"";
					else
						$selected = "";
							
					$return .= "<option value=\"{$id}\" {$selected}>{$title}</option>";
				}
		}
			
	return $return;
}

//----------------------------------------------------
// Конец страницы и копирайты
//----------------------------------------------------

function footer(){
	global $options, $ModuleVersion, $skin_footer;
	
echo  <<<HTML
<div style="padding-top:10px; padding-bottom:10px;">
	<div style="text-align: center;" class="navigation"><strong>DLE Offers</strong> Powered <strong>By SVERENO.RU </a></strong> for DataLife Engine</a></div>
</div>
{$skin_footer}
HTML;

}



//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
//  Функция для сортировки
//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

function offers_sort( $url, $n, $ajax="" ){

   // Делаем переменные
	$img_url = "engine/inc/offers/style/images/arrow";	
	$on_up = "onmouseover=\"this.src='{$img_url}_up-v.gif'\" onmouseout=\"this.src='{$img_url}_up.gif'\"";
	$on_down = "onmouseover=\"this.src='{$img_url}_down-v.gif'\" onmouseout=\"this.src='{$img_url}_down.gif'\"";
	$link = $url."&sort={$n}";
	
	if( $ajax )
		{
			$ajax_k = "onclick=\"UpdateList( 'main', '{$ajax}&sort={$n}_k' ); return false;\"";
			$ajax_d = "onclick=\"UpdateList( 'main', '{$ajax}&sort={$n}_d' ); return false;\"";
		}
	
   // Сортировка по порядку	
	if($_REQUEST['sort'] == $n."_k")
	    $sort_k = "<img src=\"{$img_url}_up-v.gif\" border=\"0\">";
	   else
	    $sort_k = "<a href=\"{$link}_k\" title=\"{$title_k}\"><img src=\"{$img_url}_up.gif\" border=\"0\" {$ajax_k} {$on_up}></a>";
	
   // Сортировка в обратном порядке  
	if($_REQUEST['sort'] == $n."_d")
	    $sort_d = "<img src=\"{$img_url}_down-v.gif\" border=\"0\">";
	   else
	    $sort_d = "<a href=\"{$link}_d\" title=\"{$title_d}\"><img src=\"{$img_url}_down.gif\" border=\"0\" {$ajax_d} {$on_down}></a>";
	  	  
  return $sort_k.$sort_d;
}

//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
//  3 функции для навигации
//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

function navigation_page($url_off,$url_on, $page, $ajax=""){
  global $config;
    if( $ajax ) 
		{
			$ajax = str_replace( "{page}", $page, $ajax );
			$onclick = "onclick=\"{$ajax} return false;\"";
		}
	$page_url = "<li><a href=\"".$url_off.$page."\" {$onclick}>".$page."</a> </li>";
 return $page_url;
}

function navigation_while($i,$page_get,$usl,$url_off,$url_on, $ajax=""){
 
while($i < $usl)
    { 
	  if($i == $page_get)
	    {
		  $navigation .= "<li class='active'><span>".$i."</span></li> ";
		  $i++;
	  }else{
	  	  $navigation .= navigation_page($url_off,$url_on,$i, $ajax);
	      $i++;
		}
	} 

 return $navigation;
}

function Offers_Navigation($url_off,$url_on, $count_page, $page_get, $ajax=""){
  global $config;

// Чтобы не было недоразумений
if($page_get < 0){$page_get = 1;}
if($page_get > $count_page){$page_get = $count_page;}

  $first_pagination = $page_get - 4; // Сколько страниц выводится слева от активной
  $last_pagination = $page_get + 5; // Сколько страниц выводится справа от активной
  $prev_page = $page_get - 1; // Предыдущая страница
  $next_page = $page_get + 1; // Следующая страница
  $page_min = 8; // Минимально значение для начала пагинации
  $page_max = $count_page - 8; // Максимально значение для начала пагинации
  $divider = "... ";  // На что заменяем пробелы
  
  // Работа с ЧПУ 
  $gl = ""; $ss = $url_off; 
  
  if( $ajax )
	{
		$link_prev = str_replace( "{page}", ($page_get - 1), $ajax );
		$link_next = str_replace( "{page}", ($page_get + 1), $ajax );
		$prev_onclick = "onclick=\"{$link_prev} return false;\"";
		$next_onclick = "onclick=\"{$link_next} return false;\"";
	}
  
  // Предыдущая страница
  if($page_get > 1)
	  $prev_page = "<li><a href=\"".$ss.($page_get - 1)."".$gl."\" {$prev_onclick}><i class=\"fa fa-backward\"></i></a></li>";
	else
	  $prev_page = "";
	  
  // Слудеющая страница
  if($page_get < $count_page)
	  $next_page = "<li><a href=\"".$ss.($page_get + 1)."".$gl."\" {$next_onclick}><i class=\"fa fa-forward\"></i></a><li>";
	else
	  $next_page = "";
	  
  // Если страниц меньше чем 10
  if($count_page < 10)
    {
      $i=1;
      $navigation = navigation_while($i,$page_get,$count_page + 1,$url_off,$url_on, $ajax);
	  $navigation = $prev_page.$navigation.$next_page;

  }else{	  
	  
  // По середине  
  if(($page_get >= $page_min - 2) and ($page_get <= $page_max + 2))
    {
      $navigation = navigation_while($first_pagination,$page_get,$last_pagination,$url_off,$url_on, $ajax);
      $navigation = $prev_page.navigation_page($url_off,$url_on,"1", $ajax).$divider.$navigation.$divider.navigation_page($url_off,$url_on,$count_page, $ajax).$next_page;
	
  // Если страница не больше 8 - ой
  }elseif($page_get < $page_min)
    {  
      $i=1;
      $navigation = navigation_while($i,$page_get,$page_min + 1,$url_off,$url_on, $ajax);
      $navigation = $prev_page.$navigation.$divider.navigation_page($url_off,$url_on,$count_page, $ajax).$next_page;

  // Если страница больше пред 8 - ми последней
  }elseif($page_get > $page_max)
    {
	  $i=$page_max;
      $navigation = navigation_while($i,$page_get, $count_page + 1,$url_off,$url_on, $ajax);
      $navigation = $prev_page.navigation_page($url_off,$url_on,"1", $ajax).$divider.$navigation.$next_page;
    } 
  }	
 return $navigation;
}

function SetReferer( $url ){
	@session_register( "AdminoffersReferer" );
	$_SESSION['AdminoffersReferer'] = $url;
}


//----------------------------------------------------
//  Вид для окошка
//----------------------------------------------------

function miniloader( $title = "DataLife Engine - Панель управлениия" ){
	global $config;
	
echo <<<HTML


HTML;
}

function minifooter(){
	echo "\n";
}

//----------------------------------------------------
//  Вывод ошибки для мини окошка
//----------------------------------------------------

function minimsg( $title, $text, $back = "", $close = true ){
	
	if( $close )
		{
			$close = "<a class=\"btn bg-teal btn-sm btn-raised position-left legitRipple\" href=\"$PHP_SELF?mod=offers\" />На главную страницу модуля</a>";	
		}
			else
		{
			$close = "";	
		}
		
	if( $back )
		{
			$back = "<a class=\"btn bg-teal btn-sm btn-raised position-left legitRipple\" href=\"{$back}\">Вернуться назад</a>";
			if( $close ) $close = " | {$close}";
		}
			else
		{
			$back = "";	
		}
	
	miniloader( $title );
	opentable();
	tableheader( $title );
										
	echo "<br /><div style=\"\" align=\"center\">{$text}<br /><br />{$back} {$close}</div><br />";
										
	closetable();
	minifooter();
	die();
}

//----------------------------------------------------
//  Функция вывода js для открытия вкладок
//----------------------------------------------------

function ChangeOption( $options ){

	$options = explode(",", $options);
    foreach($options as $opt)
    	{
        	$Slist .= "document.getElementById('{$opt}').style.display = \"none\";";
        	$list .= "if(selectedOption == '{$opt}') {document.getElementById('$opt').style.display = \"\"; if( \"{$opt}\" != \"options\" && \"{$opt}\" != \"about\" ) UpdateUrl = \"{$opt}\"; }";
        }

return <<<HTML

<script language="JavaScript" type="text/javascript">

function ChangeOption(selectedOption) {
		
    {$Slist}
	{$list}	
}
    
</script>

HTML;

}

if( !function_exists( "CharsetConvert" ) )
	{
		function CharsetConvert( $text, $to = "auto" ){
			global $config;
			
			$text = stripslashes( $text );
			$charset = mb_detect_encoding( $text, "utf-8,windows-1251" );
			if( $to == "auto" ) $to = $config['charset'];
			if( $charset != $to && $to != "" ) $text = iconv( $charset, $to."//IGNORE", $text );
			return urldecode( $text );
		}
	}

?>