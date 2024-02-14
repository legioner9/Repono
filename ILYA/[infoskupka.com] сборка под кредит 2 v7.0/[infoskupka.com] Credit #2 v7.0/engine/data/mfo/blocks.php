<?php

if( !defined( "DATALIFEENGINE" ) ) die( "Hacking attempt!" );

$this->DB['blocks']['491'] = array(
	"id" => "491",
	"type" => "blocks",
	"sort" => "1",
	"title" => "Рейтинг на главной",
	"post_type" => "default",
	"post_sort" => "desc",
	"cats_type" => "only",
	"cache" => "120",
	"max_post" => "5",
	"template" => "rate",
	"post_photo" => "no",
	"AllowCats" => "all",
);

?>