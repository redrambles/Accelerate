jQuery(document).ready(function($) {
  
var $ul = document.createElement('ul'),
$h2 = ('h2'),
$intro = $('.about-intro'); // I want to put the list right after this element
$i = 0;

$($ul).addClass("link-list");
$( $h2 ).each(function(){
  $(this).attr('id', 'subheading-'+$i);
  $i++;
});

$( $h2 ).each(function() {
  $( $ul ).append( $('<a href="#'+$(this).attr('id')+'" class="header-link" />', ({text: $(this).text()})) );
  $help = $($ul).children();
  $( $help ).innerHTML = "barf";
});

$( $ul.children ).each(function() {
  console.log( $(this).attr('href'));
  $link = $(".header-link").children();
  $link.html("fjakslfjkasjf");
  console.log($link);
  //  console.log( $(this).children());
});

//console.log($ul.children);
// console.log($help);

console.log($ul);
$($ul).appendTo($intro);
$('body').append($ul);

})