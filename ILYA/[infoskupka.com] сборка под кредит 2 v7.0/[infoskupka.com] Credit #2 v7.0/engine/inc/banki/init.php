<?php
if( !defined( 'DATALIFEENGINE') ) die( 'Hacking attempt!');



require_once( ENGINE_DIR.'/inc/banki/js/functions.js.php');
$ModServerID = 11;

if( empty( $Banki->Config['key'] ) &&!$ModInstallPage )
{
$BankiPostCount = $db->super_query( 'SELECT COUNT(*) as count FROM '.PREFIX.'_banki_post');
$BankiPostCount = $BankiPostCount['count'];
if( $BankiPostCount >10000000 &&$action != 'activation')
{

if( $BankiPostCount >50000000 ) $Banki->SaveConfig( array( 'on'=>'no'),$Banki->Config,"\$BankiConfig",ENGINE_DIR.'/data/banki.config.php','Конфигурация модуля Банки',true );
die();
}
else
{

}
}
else
{

}

?>