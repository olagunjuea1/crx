function testimonialSlider(i){for(var e=i(".testimonials"),t=0;t<e.length;t++){const r=i(e[t]),a=r.find(".testimonial__slider");var n=r.find(".next-arrow"),o=r.find(".prev-arrow");"function"==typeof slickAnimate&&slickAnimate(a),a.slick({infinite:!0,fade:!0,dots:!1,arrows:!0,speed:500,slidesToShow:1,adaptiveHeight:!1,autoplay:!0,nextArrow:n,prevArrow:o})}}jQuery(document).ready(function(i){testimonialSlider(i)});