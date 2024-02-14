<script language="javascript" type="text/javascript" src="/engine/ajax/mfo/mfo.js"></script>
<div class="full-bank-main">
	<div class="full-bank-main-wr">
		<div class="full-bank-main-left">
			<h1 class="full-bank-title">{title_full}</h1>
			<div class="full-bank-nord">{Mfofield:polnoe-nazvanie-banka}</div>
		</div>
		<div class="full-bank-main-right">
			<img src="{image:1->link}" alt="{title}" title="{title}"/>
		</div>
	</div>
	<div class="menu-bank">
		<a href="#ban">О МФО</a> <a href="#rek">Реквизиты</a> <a href="{full-link}">Отзывы клиентов</a>  
		<span>Рейтинг: {rate}</span>
	</div>
</div>
<div class="clr"></div>
<div class="full-bank">
	<div class="full-bank-left" id="article">
		<div class="clr"></div>
		<div class="full-offer">
			<h2 class="uslov-title" id="ban">О МФО</h2>
			<div class="opisan-usl">
				{text}
			</div>
			<div class="clr"></div>
		</div>
		<div class="full-offer" style="margin-top: 20px;">
			<h2 class="uslov-title" id="rek">Реквизиты</h2>
			<div class="clr"></div>
			<div class="opisan-usl">
				[Mfofield:licenzija-]
				<div class="rekviz">
					<div class="rekviz-left">
						Лицензия ЦБ №
					</div>
					<div class="rekviz-right">
						{Mfofield:licenzija-}
					</div>
				</div>
				[/Mfofield:licenzija-]
				[Mfofield:juridicheskij-adres]
				<div class="rekviz">
					<div class="rekviz-left">
						Юридический адрес
					</div>
					<div class="rekviz-right">
						{Mfofield:juridicheskij-adres}
					</div>
				</div>
				[/Mfofield:juridicheskij-adres]
				[Mfofield:gorjachaja-linija]
				<div class="rekviz">
					<div class="rekviz-left">
						Телефон
					</div>
					<div class="rekviz-right">
						{Mfofield:gorjachaja-linija}
					</div>
				</div>
				[/Mfofield:gorjachaja-linija]
				[Mfofield:ogrn]
				<div class="rekviz">
					<div class="rekviz-left">
						ОГРН
					</div>
					<div class="rekviz-right">
						{Mfofield:ogrn}
					</div>
				</div>
				[/Mfofield:ogrn]
				[Mfofield:inn]
				<div class="rekviz">
					<div class="rekviz-left">
						ИНН
					</div>
					<div class="rekviz-right">
						{Mfofield:inn}
					</div>
				</div>
				[/Mfofield:inn]

			</div>
			<div class="clr"></div>
			<div class="soc-icon">
				<script src="//yastatic.net/es5-shims/0.0.2/es5-shims.min.js"></script>
				<script src="//yastatic.net/share2/share.js"></script>
				<div class="ya-share2" data-services="vkontakte,facebook,odnoklassniki,twitter,telegram"></div>
			</div>	
			<div class="clr"></div>
		</div>
	</div>
	<div class="full-bank-right">
		{include file="right_block.tpl"}
	</div>
</div>
