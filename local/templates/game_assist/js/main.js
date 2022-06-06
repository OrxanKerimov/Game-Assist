document.addEventListener("DOMContentLoaded", function () {
  var bannerSlider = new Swiper('#banner-slider', {
    // speed: 1500,
    // effect: 'fade',
    // fadeEffect: {
    //   crossFade: true
    // },
    pagination: {
      el: '.banner-pagination',
      type: 'bullets',
    },
    navigation: {
      nextEl: '.banner-button-next',
      prevEl: '.banner-button-prev',
    },
    on: {
      init: bannerSliderNumber,
      slideChange: bannerSliderNumber
    }
  });

  function bannerSliderNumber() {
    let currentSlide = this.realIndex + 1;
    if (currentSlide < 10) {
      currentSlide = '00' + currentSlide
    }

    $('.banner-slider__number').text(currentSlide);
  }

  var reviewsSlider = new Swiper('#reviews-slider', {
    direction: "vertical",
    slidesPerView: 'auto',
    observeParents: true,
    observeSlideChildren: true,
    observer: true,
    // slideToClickedSlide: true,
    // freeMode: true,
    // mousewheel: true,
    // allowTouchMove: false,
    // slidesPerView: 2,
    // spaceBetween: 34,
    navigation: {
      nextEl: '.reviews-button-next',
      prevEl: '.reviews-button-prev',
    },
    scrollbar: {
      el: '.reviews-scrollbar',
      draggable: true,
    },
  });

  if ($(window).width() >= 769) {
    $('.reviews-slider__item').click(function () {
      $('.reviews-slider__item').removeClass('active');
      $(this).toggleClass('active');
      var data = $(this).data('reviews');
      $('.reviews-text__item').removeClass('active');
      $('.reviews-text__item[data-reviews=' + data + ']').toggleClass('active');
    });
  }

  if ($('#reviews-slider').length) {
    if ($(window).width() <= 768) {
      reviewsSlider.destroy();
    }
  }

  var servicesSlider = new Swiper('#services-slider', {
    slidesPerView: 'auto',
    navigation: {
      nextEl: '.services-button-next',
      prevEl: '.services-button-prev',
    },
  });

  if ($('#services-slider').length) {
    if ($(window).width() >= 769) {
      servicesSlider.destroy();
    }
  }

  $('.header-burger').click(function () {
    $(this).toggleClass('active');
    $('.header').toggleClass('active');
    $('.header-nav').toggleClass('active');
    $('body').toggleClass('o-hidden');
  });

  function scrollHeader() {
    window.addEventListener('scroll', function () {
      let header = document.querySelector('header');
      header.classList.toggle('scroll', window.scrollY > 0);
    });
  }
  scrollHeader();

  $('.header-profile__inner').click(function (e) {
    e.preventDefault();
    $(this).toggleClass('active').next().slideToggle();
  });

  $('.services-filters__sublist').click(function (e) {
    e.preventDefault();
    $(this).toggleClass('active').next().slideToggle();
  });

  $('.filters-sublist-item').click(function () {
    // e.preventDefault();
    $(this).toggleClass('active').find('.services-filters__dropdown-sublist-wrap').slideToggle();
  });

  $('.services-filters__title').click(function (e) {
    e.preventDefault();
    $(this).toggleClass('active').next().slideToggle();
  });

  $('.details-form__info-img').click(function (e) {
    e.preventDefault();
    $('.details-form__info-img').not(this).next().slideUp();
    $(this).toggleClass('active').next().slideToggle();
  });

  $('.faq-item__heading').click(function (e) {
    e.preventDefault();
    $(this).toggleClass('active').next().slideToggle();
  });

  $('.profile-side__btn-action').click(function (e) {
    e.preventDefault();
    $('.profile-side__btn-action').removeClass('active');
    $(this).toggleClass('active');
    var data = $(this).data('profile');
    $('.profile-block__item').removeClass('active');
    $('.profile-block__item[data-profile=' + data + ']').addClass('active');
  });

  $('.modal-up').click(function (e) {
    e.preventDefault();
    $('body').addClass('o-hidden');
    $('#popup').addClass('active');
  });

  $('.review-modal-up').click(function (e) {
    e.preventDefault();
    $('body').addClass('o-hidden');
    $('#popup-review').addClass('active');
  });

  $('.tasks-modal-up').click(function (e) {
    e.preventDefault();
    $('body').addClass('o-hidden');
    $('#popup-tasks').addClass('active');
  });

  if ($(window).width() <= 768) {
    $('.review-slider-modal-up').click(function (e) {
      e.preventDefault();
      $('body').addClass('o-hidden');
      $('#popup-review').addClass('active');
    });
  }



  $('.language-select_checked').click(function () {
    $(this).toggleClass('active').next().slideToggle();
  });

  $('.header-language__item').click(function () {
    var value = $(this).attr('data-language');
    $(this).closest('.header-language').find('.header-language__select').val(value).end().find('.select-text').text(value);
    $(this).closest('.select-dropdown').slideUp();
  });

  $('.quick-select_checked').click(function () {
    $(this).toggleClass('active').next().slideToggle();
  });

  $('.quick-filter__option').click(function () {
    var value = $(this).attr('data-filter');
    $(this).closest('.quick-filter').find('.quick-filter__select').val(value).end().find('.select-text').text(value);
    var id = $(this).attr('selector-id')
    $('.base-id-input').val(id)
    $(this).closest('.select-dropdown').slideUp();
  });






});