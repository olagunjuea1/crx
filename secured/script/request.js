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
    $('#request_btn').prop('disabled', formfilled);
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
  

  $('#request_note').keyup(function() {
      if (validateInputs("#request_note", 5, 150) == true) {
        $('#request_note_msg').html("Inavlid Request Note");
        $('#request_note_msg').addClass("text-danger");
        $('#request_btn').prop('disabled', true);
      }
      else{
        $('#request_note_msg').html("");
        $('#request_btn').prop('disabled', false);
      }
  });

  function validateEmail($email) {
    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    return emailReg.test($email);
  }
  $('#request_email').keyup(function() {
      if (!validateEmail($(this).val())) {
        $('#request_email_msg').html("Invalid Email");
        $('#request_email_msg').addClass("text-danger");
        $('#request_btn').prop('disabled', true);
      }
      else{
        $('#request_email_msg').html("");
        $('#request_btn').prop('disabled', false);
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

  $("#request_btn").click(function (e) {
    e.preventDefault();

    var data_request_email = $("#request_email").val();
    var data_request_amount = $("#request_amount").val();
    var data_request_note = $("#request_note").val();

    $.ajax({
      url: "inc/__function.php",
      method: "POST",
      data: {data_request_email, data_request_amount, data_request_note, "request_pmt":"request_pmt"}, 
      success: function(e){
        console.log(e);
        $('#closeErr').click(function() {
          $(".bk_alert").hide();
        });
        $(".bk_alert").show().delay(7000).hide("slow");

        var fetchsplit = e.split('|');
        if (fetchsplit[0] == 1) {
          $("#data_routing, #data_accountNumber, #data_amount").val("");
          $("#trf_msg").html("Processing Payment Request");
          $(".bk_alert").removeClass("bg-warning");
          $(".bk_alert").addClass("bg-success");
          
          setTimeout(function () {
              window.location.href = "auth/request-confirm.php?paymentkey="+fetchsplit[1];
          }, 2000);
        }   
        else{
          $("#trf_msg").html(e);
          $(".bk_alert").addClass("bg-warning");
          $(".bk_alert").removeClass("bg-success"); 
        } 
      }
    })
    
  })



  

  

})