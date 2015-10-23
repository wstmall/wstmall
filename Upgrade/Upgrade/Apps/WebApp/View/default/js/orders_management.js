$(document).ready(function(){
	initFooter('home');
 	
 	$('.condition-li').click(function(){
 		$(this).addClass('condition-active').siblings('li.condition-li').removeClass('condition-active');
 	});

});
