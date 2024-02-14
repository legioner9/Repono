$(document).ready(function(){
	
	$('#bg-bnt').click(function(){
    $(this).toggleClass('active');
	$('#mob-menu').toggleClass("open");
	});
	
	$("#nav").click(function(){
		$(".nav").fadeIn(200);
	});
	
	$("#show-login").click(function(){ 
		$("#overlay").fadeIn(200);
	});
	
	$('#overlay').append('<svg class="icon-black icon-close overlay-close"><use xlink:href="#close"></use></svg>');  
    $(".overlay-close").click(function(){
		$("#overlay").fadeOut(200);
	});
	
	$('.nav').append('<svg class="icon-black icon-close-mob nav-close"><use xlink:href="#close"></use></svg>');  
    $(".nav-close").click(function(){
		$(".nav").fadeOut(200);
	});
	
	$("#show-search").click(function(){
		$("#search-wrap").slideToggle(200);
		$(this).toggleClass('active');
	});
});