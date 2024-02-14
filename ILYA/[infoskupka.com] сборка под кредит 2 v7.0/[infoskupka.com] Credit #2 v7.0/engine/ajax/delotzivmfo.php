<?php


if(!defined('DATALIFEENGINE')) {
	header( "HTTP/1.1 403 Forbidden" );
	header ( 'Location: ../../' );
	die( "Hacking attempt!" );
}

if( !$is_logged ) die( "error" );

$id = intval( $_REQUEST['id'] );

$mfo_id = intval( $_REQUEST['mfo_id'] );

$otziv = intval( $_REQUEST['otziv'] );

$row = $db->query( "DELETE FROM ".PREFIX."_mfo_comments WHERE id='{$id}'" );

$row = $db->query( "UPDATE ".PREFIX."_mfo_post SET comm_num=comm_num-1 WHERE id='{$mfo_id}'" );

$row = $db->query( "UPDATE ".PREFIX."_mfo_post SET rate=rate-{$otziv} WHERE id='{$mfo_id}'" );


?>