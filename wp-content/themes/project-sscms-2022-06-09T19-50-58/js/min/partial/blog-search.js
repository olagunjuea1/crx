const search=document.querySelectorAll(".searchform");function trackSearchSubmit(e,r,t){void 0!==analytics.Integrations&&segment("track","Blog Search Submitted",{search_term:e,search_location:r},t)}for(i=0;i<search.length;i++){const e=search[i],f=e.classList.contains("searchform--header")?"header":"body",g=e.querySelector("form");g.addEventListener("submit",function(e){e.preventDefault();var e=g.querySelector(".searchform__input").value,r="/?s="+encodeURIComponent(e),r=redirect(r);trackSearchSubmit(e,f,r)})}