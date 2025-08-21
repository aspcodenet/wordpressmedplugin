jQuery(document).ready(function($) {
  $('.slider-for').slick({
      slidesToShow: 1,
      slidesToScroll: 1,
      arrows: false,
      autoplay: true,
      autoplaySpeed: 2000,
      asNavFor: '.slider-nav',
      fade: true,
      cssEase: 'linear'
    });
    $('.slider-nav').slick({
      slidesToShow: 5,
      slidesToScroll: 1,
      asNavFor: '.slider-for',
      dots: false,
      arrows: false,
      autoplay: true,
      autoplaySpeed: 2000,
      centerMode: true,
      centerPadding: '0px',
      focusOnSelect: true,
      responsive: [
          {
            breakpoint: 1400,
            settings: {
              slidesToShow: 5,
              slidesToScroll:1,
              centerPadding: '0px'
            }
          },
          {
            breakpoint: 1023,
            settings: {
              slidesToShow: 3,
              slidesToScroll: 1,
              centerPadding: '0px'
            }
          },
          {
            breakpoint: 500,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1,
              centerMode: false,
            }
          }
        ]
    });
});