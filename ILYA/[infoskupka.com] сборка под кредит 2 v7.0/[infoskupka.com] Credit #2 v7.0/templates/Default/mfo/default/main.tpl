[NotMfoAllow:post]
<div class="content-bank">	
	<div class="content-bank-left" id="article">
		<div class="banki-glav" >
			<h1>{gcategory}</h1>
			<div class="banki-link-all">
				<a href="/mfo/">ТОП 30 МФО</a>
			</div>
			<div class="clr"></div>
		</div>
		<div class="banki-search">
			<form method="post" action=""  onsubmit="if( document.getElementById( 'MfoSearch' ).value == 'Введите название организации...' ) document.getElementById( 'MfoSearch' ).value ='';">
				<input type="text" class="line" id="MfoSearch" name="MfoSearch" value="{search:text->Введите название организации...}" onfocus="if( this.value == 'Введите название организации...' ) this.value = '';" onblur="if( this.value == '' ) this.value = 'Введите название организации...';" />
				<input type="submit" name="submit_search" value="" class="but-search" src="{THEME}/images/search.png"/>
			</form>
		</div>
		<div class="banki-wrap-sort">	
			<div class="banki-sort" >
				<div class="banki-sort-1">
					Логотип
				</div>
				<div class="banki-sort-2">
					Название
				</div>
				<div class="banki-sort-3">
					Телефон
				</div>
				<div class="banki-sort-4">
					Рейтинг
				</div>
				<div class="clr"></div>
			</div>
			{content}
		</div>
	</div>
	<div class="content-bank-right">
		{include file="right_block.tpl"}
	</div>
</div>
[/NotMfoAllow]
[YesMfoAllow:post]
	{content}
[/YesMfoAllow]














