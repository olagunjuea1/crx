function sentenceSlider(e){const n=e(".sentence-slider__slider");"function"==typeof slickAnimate&&slickAnimate(n),n.slick({infinite:!0,fade:!0,dots:!1,arrows:!0,speed:500,slidesToShow:1,adaptiveHeight:!1,autoplay:!0,nextArrow:e(".sentence-slider__arrow--next"),prevArrow:e(".sentence-slider__arrow--prev")})}jQuery(document).ready(function(e){sentenceSlider(e)});