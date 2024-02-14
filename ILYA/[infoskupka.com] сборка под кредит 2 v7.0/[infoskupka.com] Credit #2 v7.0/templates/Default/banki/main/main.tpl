<div class="content-bank">	
	<div class="content-bank-left" id="article">
		<div class="banki-glav" >
			<h1>Рейтинг банков</h1>
			<div class="banki-link-all">
				<a href="/banki/all/">все банки<i class="icon-angle-right"></i></a>
			</div>
			<div class="clr"></div>
		</div>
		<div class="banki-search">
			<form method="post" action=""  onsubmit="if( document.getElementById( 'BankiSearch' ).value == 'Введите название банка...' ) document.getElementById( 'BankiSearch' ).value ='';">
				<input type="text" class="line" id="BankiSearch" name="BankiSearch" value="{search:text->Введите название банка...}" onfocus="if( this.value == 'Введите название банка...' ) this.value = '';" onblur="if( this.value == '' ) this.value = 'Введите название банка...';" />
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