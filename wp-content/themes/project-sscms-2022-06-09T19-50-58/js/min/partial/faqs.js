jQuery(document).ready(function(n){const q=n(".faq");var l=n(".faq__category");const i="btn--outline btn--outline--twotone",s="btn--outline-white",o="faq-item__question--active",_="faq-item__answer--active",d=n(".faq-item__question").not(".faq__category .faq-item__question"),u=window.location.href;function g(t){t.preventDefault();var a=n(this).attr("id");const e=t.data;e.faqBackgroundLight?e.tab.addClass(i):e.tab.addClass(s),n(this).removeClass(i+" "+s),e.tabCategory.hide(),n("#tab-"+a).fadeIn("slow"),e.faqQuestion.removeClass(o),e.faqAnswer.removeClass(_)}function m(){const t=n(this);var a;t.hasClass(o)||(a=(a=t).find(".faq-item__question-text").text(),a={location:u,faq_question:a},void 0!==analytics.Integrations&&segment("track","FAQ Arrow Clicked",a)),t.toggleClass(o).parent(".faq-item").find(".faq-item__answer").toggleClass(_)}for(var t=0;t<l.length;t++){const f=q.eq(t),r=f.find(".faq__tabs").children();var h=f.find(".faq__category");const c=f.find(".faq-item__question");var a=f.find(".faq-item__answer"),e=f.hasClass("faq--light");r.on("click",{tab:r,tabCategory:h,faqQuestion:c,faqAnswer:a,faqBackgroundLight:e},g),c.on("click",m),a=r,e=h,a.first().removeClass(i+" "+s),e.first().show()}d.on("click",m)});