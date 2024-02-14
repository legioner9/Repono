<div class="card-offer">
	<div class="card-offer-1">
		<img src="{image:1->link}" alt="{title}" title="{title}"/>
    </div>
	<div class="card-offer-2">
		<div class="nazvbankcard">{Offersfield:opisanie-3}</div>
		<div class="card-offer-title">
			[full-link]{Offersfield:opisanie-2}[/full-link]
		</div>
		
		[Offersfield:procentnaya-stavka]
		<div class="card-offer-info">
			<i class="icon-lightbulb-1"></i> {Offersfield:procentnaya-stavka} <span>годовая ставка</span>
		</div>
		[/Offersfield:procentnaya-stavka]

		[Offersfield:cashback-karty-deb.]
		<div class="card-offer-info cach">
			<i class="icon-lightbulb-1"></i> {Offersfield:cashback-karty-deb.} <span>Cashback</span>
		</div>
		[/Offersfield:cashback-karty-deb.]

		[Offersfield:summa]
		<div class="card-offer-info sm-card">
			<i class="icon-lightbulb-1"></i> {Offersfield:summa}
			<span>сумма</span>
		</div>	
		[/Offersfield:summa]
		[Offersfield:lgotnyj-period]
		<div class="card-offer-info">
			<i class="icon-lightbulb-1"></i> {Offersfield:lgotnyj-period} 
			<span>льготный период</span>
		</div>
		[/Offersfield:lgotnyj-period]
		[Offersfield:godovoe-obsluzhivanie]
		<div class="card-offer-info">
			<i class="icon-lightbulb-1"></i> {Offersfield:godovoe-obsluzhivanie} <span>годовое обслуживание</span>
		</div>
		[/Offersfield:godovoe-obsluzhivanie]
	</div>
	<div class="card-offer-3">
		<div class="offer-online"><a class="{Offersfield:id-klassa-ssylki}" style="cursor:pointer;">Оформить</a></div>
		<div class="offer-post">[full-link]Подробнее[/full-link]</div>
	</div>	
</div>


<script type="text/javascript">
	$(".{Offersfield:id-klassa-ssylki}").click(function(){
		window.open('{Offersfield:refer-ssylka}', '_blank');
	});
</script> 