[NotOffersAllow:post]
<div class="off-fl">
	<div class="man_of_fl">
		<div class="man_of_fl_left" id="article">
			<div class="offer-poisk">
				<h1>{gcategory}</h1>
				<script src="{THEME}/js/filter2.js" type="text/javascript"></script>
				<div class="filter" id="nal">
					<div class="filter-block">
						<div class="filter-banner">Сумма</div>
						<div class="filter-left-nomer">1000 руб.</div>
						<div class="filter-right-nomer">руб.</div>
						<div class="filter-right-nomer right-nomer-value" id="contentSlider1">50000</div>
						<div class="clr"></div>
						<div id="slider3" class="slider1"></div>
					</div>
					<div class="filter-block">
						<div class="filter-banner">Срок</div>
						<div class="filter-left-nomer">7 дней</div>
						<div class="filter-right-nomer">дней</div>
						<div class="filter-right-nomer right-nomer-value" id="contentSlider2">60</div>
						<div class="clr"></div>
						<div id="slider4" class="slider1"></div>					
					</div>
					<div class="clr"></div>
					<div class="text">
						{opisanie_up}
						<div class="clr"></div>
					</div>
				</div>
			</div>
			<div class="block-kol"> 
				<div class="blokosnova">
					<div class="osnovatitle">Предложения всех компаний</div>
					{content}
					<div class="no-offer">Нет предложений</div>
				</div>
			</div>	
			<div class="clr"></div>
			<div class="wrap-texting">
				{opisanie}
			</div>
		</div>
		<div class="man_of_fl_right">
			{include file="offers/zaymi_poisk.tpl"}
		</div>
	</div>	
</div>
<div class="clr"></div>
[/NotOffersAllow]

[YesOffersAllow:post]
	{content}
[/YesOffersAllow]