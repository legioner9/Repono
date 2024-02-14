<script language="javascript" type="text/javascript" src="/engine/ajax/mfo/mfo.js"></script>
<div class="full-bank-main">
	<div class="full-bank-main-wr">
		<div class="full-bank-main-left">
			<h1 class="full-bank-title">{title_rek}</h1>
			<div class="full-bank-nord">{Mfofield:polnoe-nazvanie-banka}</div>
		</div>
		<div class="full-bank-main-right">
			<img src="{image:1->link}" alt="{title}" title="{title}"/>
		</div>
	</div>
	<div class="menu-bank">
		<a href="{full-link}">О компании</a> <a href="{full-link}#rek">Реквизиты компании</a>   
		<span>Рейтинг: {rate}</span>
	</div>
</div>

<div class="clr"></div>

<div class="full-bank">
	<div class="full-bank-left" id="article">
		<div class="full-bank-otz">
			<h3 class="tit-knopka-usl" id="otz">Отзывы</h3>
			<div class="clr"></div>
		</div>
		<div class="clr"></div>
		[allow-comments]
				<ul class="opinions-list" id="mfo_comments">
					{comments}
				</ul>
			[not-comments]
				<div class="no-otz">Отзывы отсутствуют, вы можете стать первым.</div>
			[/not-comments]
			[not-addcomments]
				<div class="autoriz">
					<a href="#" onclick="document.getElementById('login-open').style.display='block';document.getElementById('login_overlay').style.display='block';">{error_add}</a>
					<div class="text">Отзывы могут оставлять только авторизованные пользователи.</div>
				</div>
			[/not-addcomments]
			[add-comments]
				{addcomments}
			[/add-comments]
		[/allow-comments]
		<div class="clr"></div>
	</div>
	<div class="full-bank-right">
		{include file="right_block.tpl"}
	</div>
</div>
