<!DOCTYPE html>
<html[available=lostpassword|register] class="page_form_style"[/available] lang="ru">
<head>
	{headers}
	<meta name="HandheldFriendly" content="true">
	<meta name="format-detection" content="telephone=no">
	<meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0, width=device-width"> 
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-status-bar-style" content="default">
	<meta name="theme-color" content="#10d54c">
	<link rel="shortcut icon" href="{THEME}/images/favicon.ico" type="image/x-icon" />
	<link rel="apple-touch-icon" href="{THEME}/images/apple-touch-icon.png" />
	<link rel="apple-touch-icon" sizes="76x76" href="{THEME}/images/apple-touch-icon-76x76.png" />
	<link rel="apple-touch-icon" sizes="114x114" href="{THEME}/images/apple-touch-icon-114x114.png" />
	<link rel="apple-touch-icon" sizes="144x144" href="{THEME}/images/apple-touch-icon-144x144.png" />
	<link rel="apple-touch-icon" sizes="180x180" href="{THEME}/images/apple-touch-icon-180x180.png" />
	<link href="{THEME}/css/engine.css" type="text/css" rel="stylesheet">
	<link href="{THEME}/css/styles.css" type="text/css" rel="stylesheet">
	<link href="{THEME}/css/credit.css" type="text/css" rel="stylesheet">
	<script type="text/javascript" src="{THEME}/js/lib.js"></script>
	<script src="{THEME}/js/carusel.js" type="text/javascript"></script>
	<script src="{THEME}/js/pagin.js" type="text/javascript"></script>
	<script src="{THEME}/js/pagin2.js" type="text/javascript"></script>
	<script src="{THEME}/js/pagin3.js" type="text/javascript"></script>
	<script type="text/javascript" src="{THEME}/js/svgxuse.min.js"></script>
<script type="text/javascript">
    jQuery(function ($) {
        $.get("{THEME}/images/sprite.svg", function (data) {
            var div = document.createElement("div");
            div.innerHTML = new XMLSerializer().serializeToString(data.documentElement);
            document.body.insertBefore(div, document.body.childNodes[0]);
        });
    });
</script>
</head>
<body>
	[not-available=lostpassword|register|feedback]
		{include file="modules/menu.tpl"}
		[aviable=main]
		<div class="clr"></div>
		<div class="main">
			<div class="wrapper">
				{info}
			</div>
		</div>
		<div class="clr"></div>
		[/aviable]
		[available=main]
			{include file="modules/main_pages.tpl"}
		[/available]

		[aviable=offers|banki|mfo]
		<div class="clr"></div>
		<div class="time-menu">
			<div class="time-menu-wrap">
				<div class="tit-naz">
					{speedbar}
				</div>
				<div class="clr"></div>
			</div>
		</div>
		[/aviable]
		[aviable=showfull|cat|static|userinfo]
		<div class="clr"></div>
		<div class="time-menu">
			<div class="time-menu-wrap">
				<div class="tit-naz">
					{speedbar}
				</div>
				<div class="clr"></div>
			</div>
		</div>
		[/aviable]
		
		[aviable=offers]
			{info}
			{content}
		[/aviable]
		[not-aviable=main|offers|banki|mfo]  
		<div class="main">
			<div class="wrapper">
				<div class="content" [aviable=search]style="margin:30px 0;"[/aviable]>
					<div class="content-left" id="article">
					[category=1]
						[aviable=cat]<div class="short-cat-tit"><h1>Новости</h1></div>[/aviable]
					[/category]
					[category=2]
						[aviable=cat]<div class="short-cat-tit"><h1>Кредитование</h1></div>[/aviable]
					[/category]
					[category=3]
						[aviable=cat]<div class="short-cat-tit"><h1>Банковские карты</h1></div>[/aviable]
					[/category]
					[category=4]
						[aviable=cat]<div class="short-cat-tit"><h1>Страхование</h1></div>[/aviable]
					[/category]
					[category=5]
						[aviable=cat]<div class="short-cat-tit"><h1>Советы</h1></div>[/aviable]
					[/category]
					{info}
					{content}
					<div class="clr"></div>
					
				</div>
				<div class="content-right">
					{include file="right_block.tpl"}
				</div>
			</div>
			<div class="clr"></div>

			[aviable=showfull|cat|userinfo|static]
			<div class="clr"></div>
				{include file="modules/carusel_katy.tpl"}
			</div>
			[/aviable]
		</div>
		[/not-aviable]
		[aviable=banki|mfo]
		<div class="main">
			<div class="wrapper">
				{info}
				{content}
				<div class="clr"></div>
				{include file="modules/carusel_katy.tpl"}
			</div>
		</div>
		[/aviable]
	[/not-available]	
	[available=lostpassword|register|feedback]
		<div class="main-reg">
			<div class="main-reg-wpap">
				<div class="logo-reg">
					<a href="/" title="На главную страницу"><img src="{THEME}/images/logo.svg" alt="Подбор кредитов, микрозаймов, кредитных карт" /></a>
				</div>
				{info}
				{content}
			</div>
		</div>
	[/available]
	<div class="clr"></div>
	<footer id="footer">
		<div class="wrap">
			{include file="modules/footer.tpl"}
		<div>
	</footer>
	{AJAX}
	<div class="overlay" id="overlay">  
		{login}
	</div>
	<script src="{THEME}/js/banner.js" type="text/javascript"></script>
	<script src="https://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
</body>
</html>