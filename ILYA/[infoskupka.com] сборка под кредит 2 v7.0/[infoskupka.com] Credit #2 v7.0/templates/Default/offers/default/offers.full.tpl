<script language="javascript" type="text/javascript" src="/engine/ajax/offers/offers.js"></script>
<div class="off-fl">
	<div class="man_of_full">
		<div class="man_of_full_left">
			<h1 class="full-off-title">{Offersfield:opisanie-2} от {Offersfield:opisanie-3}</h1>
		</div>
		<div class="man_of_full_right">
			<img src="{image:1->link}" alt="{title}" title="{title}"/>
		</div>
	</div>
	<div class="clr"></div>
	<div class="man_of_full_center">
		<a href="#usl">Условия</a> <a href="#ops">Описание</a> <a href="#otz">Отзывы</a>
		<span>  
			<a class="{Offersfield:id-klassa-ssylki}" style="cursor:pointer;">Онлайн-заявка</a>
		</span>
	</div>
	<div class="clr"></div>
	<div class="man_of_fl">
		<div class="man_of_fl_left" id="article">  
			<div class="info_full_offers" id="ops">
				<div class="info_full_offers_opis" id="opisan">
					{text}
				</div>
			</div>
			<div class="info_full_offers">
				<h2 class="uslov-title" id="usl">Условия</h2>
				[Offersfield:procentnaya-stavka]
				<div class="offers_line_full">
					<div class="offers_line_full_left">
						Процентная ставка
					</div>
					<div class="offers_line_full_right">
						{Offersfield:procentnaya-stavka}
					</div>
				</div>
				[/Offersfield:procentnaya-stavka]
				[Offersfield:minimal.-summa]
				<div class="offers_line_full">
					<div class="offers_line_full_left">
						Сумма
					</div>
					<div class="offers_line_full_right">
						{Offersfield:minimal.-summa} {Offersfield:summa}
					</div>
				</div>
				[/Offersfield:minimal.-summa]
				[Offersfield:srok-kredita]
				<div class="offers_line_full">
					<div class="offers_line_full_left">
						Срок кредита
					</div>
					<div class="offers_line_full_right">
						{Offersfield:srok-kredita}
					</div>
				</div>
				[/Offersfield:srok-kredita]
				[Offersfield:vozrast]
				<div class="offers_line_full">
					<div class="offers_line_full_left">
						Возраст
					</div>
					<div class="offers_line_full_right">
						{Offersfield:vozrast}
					</div>
				</div>
				[/Offersfield:vozrast]
				[Offersfield:dokumenty]
				<div class="offers_line_full">
					<div class="offers_line_full_left">
						Документы
					</div>
					<div class="offers_line_full_right">
						{Offersfield:dokumenty}
					</div>
				</div>
				[/Offersfield:dokumenty]
				[Offersfield:reshenie]
				<div class="offers_line_full">
					<div class="offers_line_full_left">
						Решение
					</div>
					<div class="offers_line_full_right">
						{Offersfield:reshenie}
					</div>
				</div>
				[/Offersfield:reshenie]
				[Offersfield:poluchenie]
				<div class="offers_line_full">
					<div class="offers_line_full_left">
						Получение
					</div>
					<div class="offers_line_full_right">
						{Offersfield:poluchenie}
					</div>
				</div>
				[/Offersfield:poluchenie]
				[Offersfield:poluchenie-mikrozajmy]
				<div class="offers_line_full">
					<div class="offers_line_full_left">
						Получение
					</div>
					<div class="offers_line_full_right">
						{Offersfield:poluchenie-mikrozajmy}
					</div>
				</div>
				[/Offersfield:poluchenie-mikrozajmy]
				[Offersfield:rabota]
				<div class="offers_line_full">
					<div class="offers_line_full_left">
						Работа
					</div>
					<div class="offers_line_full_right">
						{Offersfield:rabota}
					</div>
				</div>
				[/Offersfield:rabota]
				<div class="clr"></div>
				<div class="bnt-lost">
					<a class="{Offersfield:id-klassa-ssylki}" style="cursor:pointer;">Подать заявку онлайн</a>
				</div>
			</div>
			<div class="clr"></div>
			<div class="wrap_comp_left"> 
				<div class="kolon_title" id="otz">
					<h3>Последние отзывы о банке «{title}»</h3>
				</div>
				[allow-comments]
					<ul class="opinions-list" id="banki_comments">
						{comments}
					</ul>
					[not-comments]
						<div class="no-otz">Отзывы отсутствуют, вы можете стать первым.</div> 
					[/not-comments]
					[add-comments]
						{addcomments}
					[/add-comments]
				[/allow-comments]
			</div>
		</div>
		<div class="man_of_fl_right">
			{include file="offers/credit_poisk.tpl"}
		</div>
	</div>	
</div>
<div class="clr"></div>
<script type="text/javascript">
	$(".{Offersfield:id-klassa-ssylki}").click(function(){
		window.open('{Offersfield:refer-ssylka}', '_blank');
	});
</script> 