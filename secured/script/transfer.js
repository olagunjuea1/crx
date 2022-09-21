validateABA = function(t){
    t = String(t);
    n = 0;
    for (i = 0; i < t.length; i += 3) {
        n += parseInt(t.charAt(i),     10) * 3
          +  parseInt(t.charAt(i + 1), 10) * 7
          +  parseInt(t.charAt(i + 2), 10);
    }

    if (n != 0 && n % 10 == 0){
        return true;
    } else {
        return false;
    }
}

$(document).ready(function () {

  var data_routing = $("#routing").val();
  var data_accountNumber = $("#accountNumber").val();
  var data_amount = $("#amount").val();


  function validateForm() {
    var formfilled = false;
    $(".forminput").each(function () {
      if ($(this).val() === "") {
        formfilled = true;
      }
    });
    $('#bk_submit').prop('disabled', formfilled);
  }
  validateForm();

  $(".forminput").keyup(function() {
      validateForm()
  });


  function validateInputs(id, length, maxlength) {
      var disableButton = false;

      var val = $(id).val();

      if (val.length < length || val.length > maxlength)
          disableButton = true;

      return disableButton;
  }
  

  $('#routing').keyup(function() {
      if (validateInputs("#routing", 9, 9) == true) {
        $('#routing_msg').html("Invalid Routing Number");
        $('#routing_msg').addClass("text-danger");
      }
      else if (validateABA($(this).val()) == false) {
        $('#routing_msg').html("Invalid Routing Number");
        $('#routing_msg').addClass("text-danger");
      }
      else{
        $('#routing_msg').html("");
      }
  });

  $('#accountNumber').keyup(function() {
      if (validateInputs("#accountNumber", 8, 10) == true) {
        $('#account_number').html("Invalid Account Number");
        $('#account_number').addClass("text-danger");
      }
      else{
        $('#account_number').html("");
      }
  });

  $(document).scroll(function() {
    if ($(this).scrollTop() > 50) {
      $(".bk_alert").css({"top": "10px"});
    }
    else{
      $(".bk_alert").css({"top": "75px"});
    }
  })

  $("#bk_submit").click(function (e) {
    e.preventDefault();

    var data_routing = $("#routing").val();
    var data_accountNumber = $("#accountNumber").val();
    var data_amount = $("#amount").val();

    if (validateABA(data_routing) == false) {
      $(".bk_alert").show().delay(7000).hide("slow");
      $("#trf_msg").text("Invalid Routing Number");
    }
    else{
      $.ajax({
        url: "inc/__function.php",
        method: "POST",
        beforeSend: function () {
          $(".py_loader").show();
        },
        complete: function () {
          $(".py_loader").hide();
        },
        data: {data_routing, data_accountNumber, data_amount, "make_transfer":"make_transfer"}, 
        success: function(e){
          $('#closeErr').click(function() {
            $(".bk_alert").hide();
          });
          $(".bk_alert").show().delay(7000).hide("slow");

          var fetchsplit = e.split('|');
          if (fetchsplit[0] == 1) {
            $("#data_routing, #data_accountNumber, #data_amount").val("");
            $("#trf_msg").html("Processing Transaction, Please check your mail for OTP");
            $(".bk_alert").removeClass("bg-warning");
            $(".bk_alert").addClass("bg-success");
            
            setTimeout(function () {
                window.location.href = "auth/auth-validate.php?verifykey="+fetchsplit[1];
            }, 2000);
          }   
          else{
            $("#trf_msg").html(e);
            $(".bk_alert").addClass("bg-warning");
            $(".bk_alert").removeClass("bg-success"); 
          } 

        }
      })
    }
    
  })

  setInterval(() => {
    $.ajax({
      url: "inc/__function.php",
      method: "POST",
      data: {"check_active_tnx":"check_active_tnx"}, 
      success: function(e){
        if (e == 1) {
          $("#trf_modal").css({"display":"block"});
        }  
        else{
          $("#trf_modal").css({"display":"none"})
        } 
    }
  });
  }, 1000);

  

})