const tabs=document.getElementsByClassName("tabbed-content__tab");function makeContentActive(t,e,n){for(var a=0;a<e.length;a++)e[a].classList.remove(n);t.classList.add(n)}function showTabContent(t,e,n){t=t.getAttribute("data-row");makeContentActive(e.querySelector(".tabbed-content__copy--"+t),n,"tabbed-content__copy--active")}for(var i=0;i<tabs.length;i++)tabs[i].addEventListener("click",function(){const t=this.closest(".tabbed-content");var e=t.querySelectorAll(".tabbed-content__tab"),n=t.querySelectorAll(".tabbed-content__copy");makeContentActive(this,e,"tabbed-content__tab--active"),showTabContent(this,t,n)},!1);