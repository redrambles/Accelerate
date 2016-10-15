jQuery(document).ready(function($) {
  
  var $ul = document.createElement('ul'),
  $h2 = ('h2'),
  $intro = $('.about-intro'); // This is where the list will be appended to - change accordingly
  $i = 0;

  $($ul).addClass("link-list");

  $( $h2 ).each(function(){
    // Grab h2 text
    var $headerText = $(this).text();
    // Give each h2 a 'subheading-' id followed by a unique number
    $(this).attr('id', 'subheading-'+$i);
    $i++;
    //populate our ul with links that point to their corresponding header
    $( $ul ).append( $('<li><a href="#'+$(this).attr('id')+'" class="header-link" >' + $headerText +'</a></li>' ) );
  });

  $( $intro ).append($ul); // dance 
})