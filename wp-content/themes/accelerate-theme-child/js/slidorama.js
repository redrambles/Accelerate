/* To use with Slick Slider 
	Documentation here: http://kenwheeler.github.io/slick/
*/
jQuery(document).ready(function($){
	// $('.slick-slider').slick({
  //   infitine: true,
	// 	autoplay: true,
	// 	fade: false, // true will create a fade into the next image - false will slide 
	// 	speed: 1500,
	// 	autoplaySpeed: 5000,
	// 	prevArrow: '<p class="one-half first left-arrow">&#8249;</p>',
	// 	nextArrow: '<p class="one-half right-arrow">&#8250;</p>'
	// });
	$('.slick-slider').slick({ //This would be a great idea for a 'scroll' of blog posts - each image linking to the single blog page
  dots: true,
  arrows: true,
  infinite: false,
  speed: 300,
  slidesToShow: 4,
  slidesToScroll: 4,
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 3,
        infinite: true,
        dots: true
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
  ]
});
			
});
