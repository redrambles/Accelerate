jQuery(document).ready(function($) {

	$(".faq-answer").hide();

	$(".faq-title").on('click', function(){
		$(this).next().slideToggle("slow");
		$(this).parent().addClass("faq-selected");
	});

});
