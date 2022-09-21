$(document).ready(function () {

  function validateForm() {
    var formfilled = false;
    $("#data_otp").each(function () {
      if ($(this).val() === "") {
        formfilled = true;
      }
    });
    $('#validate_otp_btn').prop('disabled', formfilled);
  }
  validateForm();

  $("#data_otp").keyup(function() {
      validateForm()
  });


  function validateInputs(id, length, maxlength) {
      var disableButton = false;

      var val = $(id).val().replace(new RegExp("-", "g"), '');

      if (val.length < length || val.length > maxlength)
          disableButton = true;

      return disableButton;
  }
  

  $('#data_otp').keyup(function() {
      if (validateInputs("#data_otp", 9, 9) == true) {
        $('#validate_otp_btn').prop('disabled', true);
      }
      else{
        $('#validate_otp_btn').prop('disabled', false)
      }
  });



  $('#data_otp').keyup(function() {
    var foo = $(this).val().split("-").join("");
    if (foo.length > 0) {
      foo = foo.match(new RegExp('.{1,3}', 'g')).join("-");
    }
    $(this).val(foo);
  });
  

  $("#validate_otp_btn").click(function (e) {
    var data_otp = $("#data_otp").val().replace(new RegExp("-", "g"), '');
    var data_ID = $("#tnx_crID").val();

    var errors = false;
    e.preventDefault();
    var numericRegex = /[^0-9-]/g;
    $('#closeErr').click(function() {
      $(".bk_alert").hide();
    });    
    if (numericRegex.test(data_otp)) {
        errors = true;
    }
    if (errors) {
        $(".bk_alert").show().delay(7000).hide("slow");
        $("#err_msg").text("Please enter a valid OTP.");
    }
    else{
      $.ajax({
        url: "../inc/__function.php",
        method: "POST",
        // beforeSend: function () {
        //   $(".py_loader").show();
        // },
        // complete: function () {
        //   $(".py_loader").hide();
        // },
        data: {data_otp, data_ID, "py_submitOTP":"py_submitOTP"}, 
        success: function(e){ 
         $(".bk_alert").show().delay(7000).hide("slow");

         var fetchsplit = e.split('|');
         if (fetchsplit[0] == 1) {
           $("#data_otp").val("");
           $("#err_msg").html("Transaction Verified");
           $(".bk_alert").removeClass("bg-warning");
           $(".bk_alert").addClass("bg-success");
           
           setTimeout(function () {
              window.location.href = "../Tnx_receipt.php?tnxkeyid="+fetchsplit[1];
           }, 1000);
         }   
         else if (fetchsplit[0] == 1) {
           $("#data_otp").val("");
           $("#err_msg").html("OTP has been Verified");
           $(".bk_alert").removeClass("bg-warning");
           $(".bk_alert").addClass("bg-success");
           
           setTimeout(function () {
              window.location.href = "../Tnx_receipt.php?tnxkeyid="+fetchsplit[1];
           }, 2000);
         }   
         else{
           $("#err_msg").html(e);
           $(".bk_alert").addClass("bg-warning");
           $(".bk_alert").removeClass("bg-success"); 
         } 
        }
      });
    }
  });


  $("#cancel_transfer").click(function (e) {
    var data_ID = $("#tnx_crID").val();
    e.preventDefault();
   
    $.ajax({
      url: "../inc/__function.php",
      method: "POST",
      // beforeSend: function () {
      //   $(".py_loader").show();
      // },
      // complete: function () {
      //   $(".py_loader").hide();
      // },
      data: {data_ID, "cancel_tnx":"cancel_tnx"}, 
      success: function(e){ 
       $(".bk_alert").show().delay(7000).hide("slow"); 
       $(".bk_alert").addClass("bg-danger");
       $("#err_msg").html(e);
       setTimeout(function () {
          window.location.href = "../index.php";
       }, 1000);
      }
    });
  });
})