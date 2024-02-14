<?
$mese[0]="-";
$mese[1]="Январь";
$mese[2]="Февраль";
$mese[3]="Март";
$mese[4]="Апрель";
$mese[5]="Май";
$mese[6]="Июнь";
$mese[7]="Июль";
$mese[8]="Август";
$mese[9]="Сентябрь";
$mese[10]="Октябрь";
$mese[11]="Ноябрь";
$mese[12]="Декабрь";

$giorno[0]="Воскресенье";
$giorno[1]="Понедельник";
$giorno[2]="Вторник";
$giorno[3]="Среда";
$giorno[4]="Четверг";
$giorno[5]="Пятница";
$giorno[6]="Суббота";

$gisett=(int)date("w");
$mesnum=(int)date("m");

$full_date = $giorno[$gisett]." ".$mese[$mesnum]." ".date("d")." ".date("Y");
?>