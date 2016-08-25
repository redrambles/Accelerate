jQuery(document).ready(function($) {
  if (Modernizr.geolocation) {
  console.log("yay!");
  } else {
  console.log("boo!")
  }
});

