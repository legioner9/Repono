<?php

if( !defined( "DATALIFEENGINE" ) ) die( "Hacking attempt!" );

$this->DB['blocks']['490'] = array(
	"id" => "490",
	"type" => "blocks",
	"sort" => "1",
	"title" => "Банки на главной",
	"post_type" => "default",
	"post_sort" => "desc",
	"cats_type" => "only",
	"cache" => "120",
	"max_post" => "5",
	"template" => "banki",
	"post_photo" => "yes",
	"AllowCats" => "all",
);

$this->DB['blocks']['491'] = array(
	"id" => "491",
	"type" => "blocks",
	"sort" => "1",
	"title" => "Рейтинг банков на главной",
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