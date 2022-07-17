setInterval(() => {
  $.ajax({
    url: "../includes/__function.php",
    method: "POST",
    dataType: "JSON", 
    data: {"data_fetcher":"data_fetcher"}, 
    success: function(e){
      var stringyfy = JSON.stringify(e);
      var obj = JSON.parse(stringyfy);
      $('.ex_balance').html(obj.balance); 
      $('.ex_available').html(obj.available);          
      $('.ex_credit').html(obj.credit);          
      $('.ex_debit').html(obj.debit); 
      $('.ex_credit_b').html(obj.credit_b);          
      $('.ex_debit_b').html(obj.debit_b);                 
    }
  });
  
}, 1000);










