<?php

if(!defined('DATALIFEENGINE')) {
	header( "HTTP/1.1 403 Forbidden" );
	header ( 'Location: ../../' );
	die( "Hacking attempt!" );
}


if( !$is_logged OR !$user_group[$member_id['user_group']]['allow_admin'] ) { die ("error"); }

$buffer = "";

function parseJsonArray($jsonArray, $parentID = 0)
{
  $return = array();
  foreach ($jsonArray as $subArray) {
     $returnSubSubArray = array();
     if (isset($subArray['children'])) {
       $returnSubSubArray = parseJsonArray($subArray['children'], $subArray['id']);
     }
     $return[] = array('id' => $subArray['id'], 'parentid' => $parentID);
     $return = array_merge($return, $returnSubSubArray);
  }

  return $return;
}


if ($_REQUEST['action'] == "commentspublic") {

	if ( !$user_group[$member_id['user_group']]['admin_comments']) die ("error");

	if( $_REQUEST['user_hash'] == "" OR $_REQUEST['user_hash'] != $dle_login_hash ) {
		
		die ("error");
	
	}
	
	$c_id = intval( $_REQUEST['id'] );
	$banki_id = intval( $_REQUEST['banki_id'] );
	$otziv = intval( $_REQUEST['otziv'] );
	
	$db->query( "UPDATE " . PREFIX . "_banki_comments SET approve='1' WHERE id='{$c_id}'" );
	
	$db->query( "UPDATE ".PREFIX."_banki_post SET rate=rate+{$otziv} WHERE id='{$banki_id}'" );
	

	$db->query( "INSERT INTO " . USERPREFIX . "_admin_logs (name, date, ip, action, extras) values ('".$db->safesql($member_id['name'])."', '{$_TIME}', '{$_IP}', '19', '')" );
	
	clear_cache();


	$buffer = 'ok';	
}


echo $buffer;

?>