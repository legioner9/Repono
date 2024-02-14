<?php
if( !defined( 'DATALIFEENGINE') ) die( 'Hacking attempt!');



require_once( ENGINE_DIR.'/inc/mfo/js/functions.js.php');
$ModServerID = 11;

if( empty( $Mfo->Config['key'] ) &&!$ModInstallPage )
{
$MfoPostCount = $db->super_query( 'SELECT COUNT(*) as count FROM '.PREFIX.'_mfo_post');
$MfoPostCount = $MfoPostCount['count'];
if( $MfoPostCount >10000000 &&$action != 'activation')
{

if( $MfoPostCount >50000000 ) $Mfo->SaveConfig( array( 'on'=>'no'),$Mfo->Config,"\$MfoConfig",ENGINE_DIR.'/data/mfo.config.php','Конфигурация модуля МФО',true );
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