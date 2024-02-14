<div class="kr-offer">
	<div class="kr-offer-1">
		<img src="{image:1->link}" alt="{title}" title="{title}"/>
		<div class="nazvbank">{Offersfield:opisanie-3}</div>
    </div>
	<div class="kr-offer-2">
		<div class="kr-offer-title">
			[full-link]{Offersfield:opisanie-2}[/full-link]
		</div>
		<div class="kr-offer-3">
			<div class="kr-offer-stavka">[Offersfield:procentnaya-stavka]{Offersfield:procentnaya-stavka}[/Offersfield:procentnaya-stavka]</div>
			<span>ставка</span>
		</div>
		<div class="kr-offer-4">
			<div class="kr-offer-summa">{Offersfield:summa}</div>
			<span>сумма</span>
		</div>	
		<div class="kr-offer-5">
			<div class="kr-offer-srok">{Offersfield:srok-kredita}</div>   
			<span>срок</span>
		</div>
	</div>
	<div class="kr-offer-7">
		<div class="offer-online"><a class="{Offersfield:id-klassa-ssylki}" style="cursor:pointer;">Оформить</a></div>
	</div>
	<div class="clr"></div>
	<div class="kr-offer-pay">
		<div class="kr-offer-pay-left">
			[Offersfield:nomer-licenzii-cb]ЦБ №{Offersfield:nomer-licenzii-cb}[/Offersfield:nomer-licenzii-cb]
		</div>
		<div class="kr-offer-pay-center">
			<span>Возраст:</span>
			[Offersfield:vozrast]{Offersfield:vozrast}[/Offersfield:vozrast]
					</div>
		<div class="kr-offer-pay-right">
			[full-link]Подробнее[/full-link]
		</div>
	</div>	
</div>
<div class="clr"></div>

<script type="text/javascript">
	$(".{Offersfield:id-klassa-ssylki}").click(function(){
		window.open('{Offersfield:refer-ssylka}', '_blank');
	});
</script> 