checkWindowSize();

// Check if the page has enough content or not. If not then fetch records
function checkWindowSize(){
   if($(window).height() >= $(document).height()){
      // Fetch records
      fetchData();
   }
}
console.log(checkWindowSize())

Fetch records
function fetchData(){
   var start = Number($('#start').val());
   var allcount = Number($('#totalrecords').val());
   var rowperpage = Number($('#rowperpage').val());
   start = start + rowperpage;

   if(start <= allcount){
      $('#start').val(start);

      $.ajax({
         url:"ajaxfile.php",
         type: 'post',
         data: {start:start,rowperpage: rowperpage},
         success: function(response){

            // Add
            $(".post:last").after(response).show().fadeIn("slow");

            // Check if the page has enough content or not. If not then fetch records
            checkWindowSize();
         }
      });
   }
}

// $(document).on('touchmove', onScroll); // for mobile

// function onScroll(){

//    if($(window).scrollTop() > $(document).height() - $(window).height()-100) {
//       fetchData(); 
//    }
// }

// $(window).scroll(function(){

//    var position = $(window).scrollTop();
//    var bottom = $(document).height() - $(window).height();

//    if( position == bottom ){
//       fetchData(); 
//    }

// });