<div class="ban_main">
	<div class="ban_main_wrap">
		<div class="ban_main_block">
			<div class="ban_main_left">
				<div class="ban_main_title">
					<h1>Подбор займа онлайн</h1>
				</div>
				<div class="ban_main_text">
					Бесплатный подбор займов c моментальным решением. Заполните онлайн заявку и получите деньги на карту! Для 100% одобрения отправьте заявку в несколько компаний.							
				</div>
				<div class="ban_main_bnt">
					<a href="/offers/mikrozajmy/" title="Микрозаймы">Подобрать займ</a>
				</div>
			</div>
			<div class="ban_main_right">
				<img src="{THEME}/images/bg_main.svg" alt="Подбор займов онлайн" />
			</div>
		</div>
	</div>
</div>
<div class="clr"></div>
<div class="main">
	<div class="wrapper">
		<div class="block-mini">
			<div class="block-mini-col">
				<a href="/offers/potrebitelskij-kredit/" title="Кредит наличными"> 
				<div class="mini">
					<div class="mini-left">
						<div class="mini-title">
							Кредит наличными
						</div>
						<div class="mini-predl">
							Ставка от 8,99%
						</div>
					</div>
					<div class="mini-right">
						<img src="{THEME}/images/kredit.svg" alt="Кредит наличными" title="Кредит наличными"/>
					</div>
				</div>
				</a>
			</div>
			<div class="block-mini-col">
				<a href="/offers/mikrozajmy/" title="Микрозаймы"> 
				<div class="mini">
					<div class="mini-left">
						<div class="mini-title">
							Микрозаймы
						</div>
						<div class="mini-predl">
							Ставка от 0%
						</div>
					</div>
					<div class="mini-right">
						<img src="{THEME}/images/zaym.svg" alt="Микрозаймы" title="Микрозаймы"/>
					</div>
				</div>
				</a>
			</div>
			<div class="block-mini-col">
				<a href="/offers/kreditnye-karty/" title="Кредитные карты">
				<div class="mini">
					<div class="mini-left">
						<div class="mini-title">
							Кредитные карты
						</div>
						<div class="mini-predl">
							Ставка от 13,99%
						</div>
					</div>
					<div class="mini-right">
						<img src="{THEME}/images/kreditcard.svg" alt="Кредитные карты" title="Кредитные карты"/>
					</div>
				</div>
				</a>
			</div>
			<div class="block-mini-col">
				<a href="/offers/debetovye-karty/" title="Дебетовые карты">  
				<div class="mini">
					<div class="mini-left">
						<div class="mini-title">
							Дебетовые карты
						</div>
						<div class="mini-predl">
							Кэшбек до 20%
						</div>
					</div>
					<div class="mini-right">
						<img src="{THEME}/images/debetcard.svg" alt="Дебетовые карты" title="Дебетовые карты"/>
					</div>
				</div>
				</a>
			</div>
		</div>
	</div>
</div>
<div class="clr"></div>
<div class="main">
	<div class="wrapper">
		<h2 class="man_h2">Рейтинг банков и микрофинансовых компаний</h2>
		<div class="clr"></div>
		<div class="wrp_hoop">
			<div class="wrp_hoop_b1">
				<div class="wrp_hoop_b1_left">
					95
				</div>
				<div class="wrp_hoop_b1_right">
					Предложений от банков
				</div>
			</div>
			<div class="wrp_hoop_b2">
				<div class="wrp_hoop_b2_left">
					562
				</div>
				<div class="wrp_hoop_b2_right">
					Отзывов клиентов
				</div>
			</div>
			<div class="wrp_hoop_b3">
				<div class="wrp_hoop_b3_left">
					79
				</div>
				<div class="wrp_hoop_b3_right">
					Заявок сегодня
				</div>
			</div>
		</div>
		<div class="clr"></div>
		<h3 class="bnk_title"><a href="/banki/all/">Все банки России</a></h3>
		<div class="wrap-carusel">
			<div id="carousel">
				{include file="engine/modules/banki/block.php?id=491"}
			</div>
		</div>
		<div class="clr"></div>
		<h3 class="bnk_title"><a href="/mfo/all/">Все микрофинансовые компании</a></h3>
		<div class="clr"></div>
		<div class="wrap-carusel">
			<div id="carousel2">
				{include file="engine/modules/mfo/block.php?id=491"}
			</div>
		</div>
<script>
	$(document).ready(function() {
		$("#owl-demo").owlCarousel({
			navigation : true
		});
	});
</script>
<div class="clr"></div>
		
	</div>
</div>

<div class="main-white">
	<div class="main-white-wrap">		
		<div class="list_news">
			<input type="radio" name="inset" value="" id="tab_1" checked>
			<label for="tab_1">Последние публикации</label>
			<input type="radio" name="inset" value="" id="tab_2">
			<label for="tab_2">Советы</label>
			<input type="radio" name="inset" value="" id="tab_3">
			<label for="tab_3">Кредитование</label>
			<input type="radio" name="inset" value="" id="tab_4">
			<label for="tab_4">Банковские карты</label>
			<input type="radio" name="inset" value="" id="tab_5">
			<label for="tab_5">Страхование</label>
			<input type="radio" name="inset" value="" id="tab_6">
			<label for="tab_6">Новости</label>
			
			<div class="listing" id="txt_1">
				{custom category="2,3,4,5" template="mini-news" aviable="global" from="0" limit="8" cache="no"}
				
				<div class="all-main-news">
					<a href="/news/">Последние новости</a>
				</div>
			</div>
			<div class="listing" id="txt_2">
				{custom category="5" template="mini-news" aviable="global" from="0" limit="4" cache="no"}
				<div class="all-main-news">
					<a href="/sovety/">Все статьи</a>
				</div>
			</div>
			<div class="listing" id="txt_3">
				{custom category="2" template="mini-news" aviable="global" from="0" limit="4" cache="no"} 
				<div class="all-main-news">
					<a href="/kreditovanie/">Все статьи</a>
				</div>
			</div>
			<div class="listing" id="txt_4">
				{custom category="3" template="mini-news" aviable="global" from="0" limit="4" cache="no"}
				<div class="all-main-news">
					<a href="/karty/">Все статьи</a>
				</div>
			</div>
			<div class="listing" id="txt_5">
				{custom category="4" template="mini-news" aviable="global" from="0" limit="4" cache="no"}
				<div class="all-main-news">
					<a href="/strahovanie/">Все статьи</a>
				</div>
			</div>
			<div class="listing" id="txt_6">
				{custom category="1" template="mini-news" aviable="global" from="0" limit="4" cache="no"}
				<div class="all-main-news">
					<a href="/news/">Все новости</a>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="clr"></div>
<div class="main">
	<div class="wrapper">
		<h3 class="bnk_title topmar"><a href="/offers/kreditnye-karty/">Популярные кредитные карты</a></h3>
		<div class="wrap-carusel">
			<div id="carousel3">
				{include file="engine/modules/offers/block.php?id=324"}
			</div>
		</div>
	</div>
</div>

