<script language="javascript" type="text/javascript" src="/engine/ajax/banki/banki.js"></script>
<div class="full-bank-main">
	<div class="full-bank-main-wr">
		<div class="full-bank-main-left">
			<h1 class="full-bank-title">{title_full}</h1>
			<div class="full-bank-nord">{Bankifield:polnoe-nazvanie-banka}</div>
		</div>
		<div class="full-bank-main-right">
			<img src="{image:1->link}" alt="{title}" title="{title}"/>
		</div>
	</div>
	<div class="menu-bank">
		<a href="#ban">О банке</a> <a href="#rek">Реквизиты</a> <a href="{full-link}#otz">Отзывы о банке</a>  
		<span>Рейтинг: {rate} </span>
	</div>
</div>

<div class="clr"></div>

<div class="full-bank">
	<div class="full-bank-left" id="article">
		<div class="full-offer">
			<h2 class="uslov-title" id="ban">О банке</h2>
			<div class="opisan-usl" style="margin-bottom:30px;">
				{text}
			</div>
			<div class="clr"></div>
		
			<h2 class="uslov-title" id="rek">Реквизиты</h2>
			<div class="clr"></div>
			<div class="opisan-usl">
				[Bankifield:licenzija-]
				<div class="rekviz">
					<div class="rekviz-left">
						Лицензия №
					</div>
					<div class="rekviz-right">
						{Bankifield:licenzija-}
					</div>
				</div>
				[/Bankifield:licenzija-]
				[Bankifield:juridicheskij-adres]
				<div class="rekviz">
					<div class="rekviz-left">
						Юридический адрес
					</div>
					<div class="rekviz-right">
						{Bankifield:juridicheskij-adres}
					</div>
				</div>
				[/Bankifield:juridicheskij-adres]
				[Bankifield:golovnoj-ofis]
				<div class="rekviz">
					<div class="rekviz-left">
						Головной офис
					</div>
					<div class="rekviz-right">
						{Bankifield:golovnoj-ofis}
					</div>
				</div>
				[/Bankifield:golovnoj-ofis]
				[Bankifield:gorjachaja-linija]
				<div class="rekviz">
					<div class="rekviz-left">
						Телефон
					</div>
					<div class="rekviz-right">
						{Bankifield:gorjachaja-linija}
					</div>
				</div>
				[/Bankifield:gorjachaja-linija]
				[Bankifield:ogrn]
				<div class="rekviz">
					<div class="rekviz-left">
						ОГРН
					</div>
					<div class="rekviz-right">
						{Bankifield:ogrn}
					</div>
				</div>
				[/Bankifield:ogrn]
				[Bankifield:inn]
				<div class="rekviz">
					<div class="rekviz-left">
						ИНН
					</div>
					<div class="rekviz-right">
						{Bankifield:inn}
					</div>
				</div>
				[/Bankifield:inn]
				[Bankifield:kpp]
				<div class="rekviz">
					<div class="rekviz-left">
						КПП
					</div>
					<div class="rekviz-right">
						{Bankifield:kpp}
					</div>
				</div>
				[/Bankifield:kpp]
				[Bankifield:okpo]
				<div class="rekviz">
					<div class="rekviz-left">
						ОКПО
					</div>
					<div class="rekviz-right">
						{Bankifield:okpo}
					</div>
				</div>
				[/Bankifield:okpo]
				[Bankifield:bik]
				<div class="rekviz">
					<div class="rekviz-left">
						БИК
					</div>
					<div class="rekviz-right">
						{Bankifield:bik}
					</div>
				</div>
				[/Bankifield:bik]
				[Bankifield:swift]
				<div class="rekviz">
					<div class="rekviz-left">
						SWIFT
					</div>
					<div class="rekviz-right">
						{Bankifield:swift}
					</div>
				</div>
				[/Bankifield:swift]
				[Bankifield:iban]
				<div class="rekviz">
					<div class="rekviz-left">
						IBAN
					</div>
					<div class="rekviz-right">
						{Bankifield:iban}
					</div>
				</div>
				[/Bankifield:iban]
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
