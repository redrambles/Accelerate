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
    var $headerText = $(this).text();
    $( $ul ).append( $('<a href="#'+$(this).attr('id')+'" class="header-link" >' + $headerText +'</a>' ) );
  });

  $( $intro ).append($ul);

})