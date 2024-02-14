<?php
if( !defined( 'DATALIFEENGINE') ) die( 'Hacking attempt!');



require_once( ENGINE_DIR.'/inc/offers/js/functions.js.php');

$ModServerID = 11;

if( empty( $Offers->Config['key'] ) &&!$ModInstallPage )
{
$OffersPostCount = $db->super_query( 'SELECT COUNT(*) as count FROM '.PREFIX.'_offers_post');
$OffersPostCount = $OffersPostCount['count'];
if( $OffersPostCount >10000000 &&$action != 'activation')
{

if( $OffersPostCount >50000000 ) $Offers->SaveConfig( array( 'on'=>'no'),$Offers->Config,"\$OffersConfig",ENGINE_DIR.'/data/offers.config.php','Конфигурация модуля Офферы',true );
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