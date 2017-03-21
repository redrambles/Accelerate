jQuery(document).ready(function($){

/* Dynamically create link listand append to #float-menu div */
var $ul = document.createElement('ul');
var $h2 = ('.container h2:not(.widget-title)');
var $intro = $('#float-menu'); // I want to put the list right after this element

if($intro.length !== 0) {
  $intro.show();
}
  
$i = 0;
$($ul).addClass("list-unstyled");
$( $h2 ).each(function(){
  $(this).attr('id', 'subheading-'+$i);
  $i++
});

$( $h2 ).each(function(){
  var $headerText = $(this).text();
  $( $ul ).append( $('<li><a href="#' + $(this).attr('id')+ '"class="header-link" >' + $headerText + '</a></li>' ) );
});
$($intro).append.($ul);

});

/* Smooth Scroll */
$('a[href^="#"]').on('click', function(event) {
  var target = $(this.getAttribute('href'));
  if(target.length) {
    event.preventDefault();
    $('html, body').stop().animate({
      scrollTop: (target.offset().top - 50)
    }, 1000);
   }
 });

});
