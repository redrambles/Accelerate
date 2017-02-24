// FAQ page
jQuery(document).ready(function($) {
// This solution is compliant with progressive enhancement principles - as the content will still show if JS is disabled.
	$(".faq-answer").hide();

	$(".faq-title").on('click', function(){
		$(this).next().slideToggle("slow");
		$(this).parent().addClass("faq-selected");
	});

});

// Mobile menu
jQuery(document).ready(function($) {
	
	$(".mobile-menu").on('click', function(){
		$(this).next().toggleClass("menu-toggle");
		$( window ).resize(function() {
			var width = $(window).width();
			if ( width > 800 ){
				$('.site-navigation').removeClass('menu-toggle');
			 }
		});
	});
});
