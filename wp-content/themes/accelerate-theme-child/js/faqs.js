jQuery(document).ready(function($) {

	$(".faq-answer").hide();

	$(".faq-title").click(function(){
		$(this).next().slideToggle("slow");
		$(this).parent().toggleClass("faq-selected").css("border", "1px solid lightgray");
	});

});
