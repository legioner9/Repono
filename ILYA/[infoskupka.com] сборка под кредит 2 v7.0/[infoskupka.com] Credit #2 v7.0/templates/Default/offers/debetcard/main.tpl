[NotOffersAllow:post]
<div class="off-fl">
	<div class="man_of_fl">
		<div class="man_of_fl_left" id="article">
			<div class="offer-poisk">
				<h1>{gcategory}</h1>
				<script src="{THEME}/js/filter4.js" type="text/javascript"></script>
				<div class="filter" id="nal">
					<div class="filter-block-card">
						<div class="filter-banner">Процент кешбека</div>
						<div class="filter-left-nomer">0 %</div>
						<div class="filter-right-nomer">%</div>
						<div class="filter-right-nomer right-nomer-value" id="contentSlider1">30</div>
						<div class="clr"></div>
						<div id="slider_debet_card" class="slider1"></div>
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
					<div class="osnovatitle">Предложения всех банков</div>
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
			{include file="offers/debetcard_poisk.tpl"}
		</div>
	</div>	
</div>
<div class="clr"></div>
[/NotOffersAllow]
[YesOffersAllow:post]
	{content}
[/YesOffersAllow]