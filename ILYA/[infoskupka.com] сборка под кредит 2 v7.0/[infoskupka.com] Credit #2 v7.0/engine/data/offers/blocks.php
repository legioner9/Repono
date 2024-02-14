<?php

if( !defined( "DATALIFEENGINE" ) ) die( "Hacking attempt!" );

$this->DB['blocks']['322'] = array(
	"id" => "322",
	"type" => "blocks",
	"sort" => "1",
	"title" => "Дебетовые карты (главная модуля)",
	"post_type" => "color",
	"post_sort" => "desc",
	"cats_type" => "only",
	"cache" => "120",
	"max_post" => "1",
	"template" => "main-debetcard",
	"post_photo" => "no",
	"AllowCats" => "4",
);

$this->DB['blocks']['495'] = array(
	"id" => "495",
	"type" => "blocks",
	"sort" => "1",
	"title" => "Кредит наличными (главная модуля)",
	"post_type" => "color",
	"post_sort" => "asc",
	"cats_type" => "only",
	"cache" => "120",
	"max_post" => "1",
	"template" => "main-nalich",
	"post_photo" => "no",
	"AllowCats" => "1",
);

$this->DB['blocks']['496'] = array(
	"id" => "496",
	"type" => "blocks",
	"sort" => "1",
	"title" => "Кредитные карты (главная модуля)",
	"post_type" => "color",
	"post_sort" => "desc",
	"cats_type" => "only",
	"cache" => "120",
	"max_post" => "1",
	"template" => "main-creditcard",
	"post_photo" => "no",
	"AllowCats" => "2",
);

$this->DB['blocks']['323'] = array(
	"id" => "323",
	"type" => "blocks",
	"sort" => "2",
	"title" => "Микрозаймы (главная модуля)",
	"post_type" => "color",
	"post_sort" => "desc",
	"cats_type" => "only",
	"cache" => "120",
	"max_post" => "1",
	"template" => "main-zaymi",
	"post_photo" => "no",
	"AllowCats" => "3",
);

$this->DB['blocks']['324'] = array(
	"id" => "324",
	"type" => "blocks",
	"sort" => "3",
	"title" => "Кредитные карты",
	"post_type" => "color",
	"post_sort" => "desc",
	"cats_type" => "only",
	"cache" => "120",
	"max_post" => "10",
	"template" => "default-card",
	"post_photo" => "no",
	"AllowCats" => "2",
);

?>