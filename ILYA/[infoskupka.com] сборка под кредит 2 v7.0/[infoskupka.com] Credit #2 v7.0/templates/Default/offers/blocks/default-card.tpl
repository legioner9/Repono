<div class="card-offer-mini">
	<div class="card-offer-mini-wr">
		<div class="card-offer-mini-img">
			<img src="{image:1->link}" alt="{title}" title="{title}"/>
		</div>
		<div class="nazvbankcard-mini">{Offersfield:opisanie-3}</div>
		<div class="card-offer-mini-title">
			[full-link]{Offersfield:opisanie-2}[/full-link]
		</div>
		[Offersfield:summa]
		<div class="card-offer-mini-name">
			{Offersfield:summa}
			<span>сумма</span>
		</div>	
		[/Offersfield:summa]
		[Offersfield:lgotnyj-period]
		<div class="card-offer-mini-name">
			{Offersfield:lgotnyj-period} 
			<span>льготный период</span>
		</div>
		[/Offersfield:lgotnyj-period]
		<div class="clr"></div>
		<div class="offer-mini-online"><a class="{Offersfield:id-klassa-ssylki}" style="cursor:pointer;">Оформить</a></div>
		<div class="clr"></div>
	</div>
</div>
<script type="text/javascript">
	$(".{Offersfield:id-klassa-ssylki}").click(function(){
		window.open('{Offersfield:refer-ssylka}', '_blank');
	});
</script> 