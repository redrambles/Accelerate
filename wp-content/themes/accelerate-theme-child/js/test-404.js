// Here is a quick test to see if this code could successfully target the 404 page only
jQuery(document).ready(function($) {

  $('body').css("background-color","lemonchiffon");
  
    if (Modernizr.geolocation) {
    console.log("404-yay!");
    } else {
    console.log("404-boo!")
    }
  
});
