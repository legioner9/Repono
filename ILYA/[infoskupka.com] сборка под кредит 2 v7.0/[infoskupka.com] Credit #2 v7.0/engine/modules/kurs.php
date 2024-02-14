<?php 
ini_set('display_errors', 'Off');
function getCourse($currency = array('R01235','R01239'),$shift = 0){ 
    $value = array(); 
    $td = mktime(0,0,0,date('m'),intval(date('d'))+$shift,date('Y')); 
    $ystd = mktime(0,0,0,date('m'),intval(date('d'))+$shift-1,date('Y')); 
    foreach($currency as $cur){ 
        $url = 'http://www.cbr.ru/scripts/XML_dynamic.asp?date_req1='.date('d/m/Y',$ystd).'&date_req2='.date('d/m/Y',$td).'&VAL_NM_RQ='.$cur; 
        $xml = DOMDocument::loadXML(file_get_contents($url)); 
        if(!$xml) return null; 
        $y = 
        $t = 0; 
        $nominal = 1; 
        $xpc = new DOMXPath($xml); 
        if($xpc->evaluate('count(//Record)')<2 && abs($shift)<10){ 
            return getCourse($currency,$shift-1); 
        } 
        $res = $xpc->query('/ValCurs/Record[@Date="'.date('d.m.Y',$ystd).'"]/Value/text()'); 
        if($res->length) $y = floatval(str_replace(',','.',$res->item(0)->data)); 
        $res = $xpc->query('/ValCurs/Record[@Date="'.date('d.m.Y',$td).'"]/Value/text()'); 
        if($res->length) $t = floatval(str_replace(',','.',$res->item(0)->data)); 
        $res = $xpc->query('/ValCurs/Record[@Date="'.date('d.m.Y',$td).'"]/Nominal/text()'); 
        if($res->length) $nominal = floatval(str_replace(',','.',$res->item(0)->data)); 
        $value[$cur]['date'] = $td; 
        $value[$cur]['course'] = $t; 
        $value[$cur]['nominal'] = $nominal; 
        $value[$cur]['spread'] = $t-$y; 
    } 
    return $value; 
} 

$cache_file=$_SERVER['DOCUMENT_ROOT']."/engine/cache/kurs.txt"; //права на папку cache 777

if (file_exists( $cache_file ) && 
    date('Y-m-d',filemtime($cache_file))==
    date("Y-m-d", mktime(0, 0, 0, date("m") , date("d"), date("Y")))){
    $f=fopen($cache_file,"rb");  
   $kurs=fread($f,filesize($cache_file)); 
   fclose($f);
}else{
$style ='<style type="text/css"> 
ul{ 
margin: 0 auto;
} 
</style>'; 

$val = array( 
    'R01235' => 'USD', 
    'R01239' => 'EUR' 
); 
$cur = getCourse(array_flip($val)); 

$tab1='';
 
foreach($val as $i => $cur_name){ 
    $color = $cur[$i]['spread']>=0 ? '53c255' : 'FF0000';        //красный, если понизился, зеленый, если повысился 
    $spread = number_format($cur[$i]['spread']*100,0,',','');    //разницу в курсах переводим в копейки 
    $course = number_format($cur[$i]['course'],2,',',' ');        //текущий курс 
    if($cur[$i]['spread']>=0 )$plus = "+"; else $plus = "";
        
    $tab2 = $tab2.'<div class="kurs">
 '.$cur_name.' - '.$course.' руб.</div>
'; 

} 

$tab3 = '</ul>';
$kurs = $style.$tab1.$tab2.$tab3;

   @file_put_contents($cache_file,$kurs);

}
echo $kurs;