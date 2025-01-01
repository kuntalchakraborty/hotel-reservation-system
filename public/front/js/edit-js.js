
jQuery(function($){

  //////////////////////////// window scroll jQuery

$(window).scroll(function(){
  if($(this).scrollTop() > 100){
      $("header").addClass('fixed')
  }
  else{
      $("header").removeClass('fixed')
  }
});

// ///////////////////////////// NAVBAR JS START
function sidemenu(){
  $('.nav_sec').toggleClass('slidein');
  $('.nav_sec').prepend('<div class="cls-btn"></div>');

  $('.cls-btn').on('click', function(){
      $('.nav_sec').removeClass('slidein');
  });
}
$('body').find('.toggle-menu').on('click',sidemenu);

$('.nav_sec ul > li > ul').parent().prepend('<i class="arw-nav"></i>');
function subMenu(){
    $(this).parent('li').find('> ul').stop(true, true).slideToggle();
    $(this).parents('li').siblings().find('ul').stop(true, true).slideUp();
    $(this).toggleClass('actv');
    $(this).parent().siblings().find('.arw-nav').removeClass('actv');
}
$('.nav_sec ul > li > .arw-nav').on('click',subMenu);

// ///////////////////////////// NAVBAR JS end

//////////////////////// slick js start

$('.banner-slider').slick({
  dots: false,
  infinite: true,
  autoplay:true,
  pauseOnHover:false,
  speed: 500,
  arrows:false,
  slidesToShow: 1,
  slidesToScroll: 1
});

$('.service-slider').slick({
  dots: false,
  infinite: true,
  autoplay:true,
  pauseOnHover:false,
  speed: 500,
  arrows:false,
  slidesToShow: 1,
  slidesToScroll: 1
});

$('.news-slider').slick({
  dots: false,
  infinite: true,
  autoplay:true,
  pauseOnHover:false,
  speed: 500,
  arrows:true,
  slidesToShow: 3,
  slidesToScroll: 3,
  prevArrow:"<button type='button' class='slick-prev pull-left'><i class='fa-solid fa-arrow-left-long' aria-hidden='true'></i></button>",
  nextArrow:"<button type='button' class='slick-next pull-right'><i class='fa-solid fa-arrow-right-long' aria-hidden='true'></i></button>",
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2,
        infinite: true
      }
    },
    {
      breakpoint: 990,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2
      }
    },
    {
      breakpoint: 780,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
  ]
});

$('#togglePassword').on('click', function() {
  // Toggle the password visibility
  const passwordField = $('#userpassword');
  const type = passwordField.attr('type') === 'password' ? 'text' : 'password';
  passwordField.attr('type', type);
  // Toggle the eye icon
  $(this).toggleClass('fa-eye fa-eye-slash');
});

$('#toggleconPassword').on('click', function() {
    // Toggle the password visibility
    const passwordField = $('#confirm_password');
    const type = passwordField.attr('type') === 'password' ? 'text' : 'password';
    passwordField.attr('type', type);
    // Toggle the eye icon
    $(this).toggleClass('fa-eye fa-eye-slash');
  });


//////////////////////////// slick js end

AOS.init({
  duration: 1200,
})

});










