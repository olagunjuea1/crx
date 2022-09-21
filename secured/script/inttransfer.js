$(document).ready(function () {
  function int_transfer_ctr() {
    var tnx_country = $('#inp_country').val();
    if (tnx_country == 'australia') {
      $('.inpbsb').show();
      $('.inpacctno').show();
      $('.inpiban').hide();
      $('.inpifsc').hide();
    }
    else if (tnx_country == 'india') {
      $('.inpbsb').hide();
      $('.inpacctno').show();
      $('.inpiban').hide();
      $('.inpifsc').show();
    }
    else if (tnx_country == 'intdefault') {
      $('.inpbsb').hide();
      $('.inpacctno').show();
      $('.inpiban').show();
      $('.inpifsc').hide();
    }
    else{
      $('.inpbsb').hide();
      $('.inpacctno').show();
      $('.inpiban').show();
      $('.inpifsc').hide();
    }
  }
  int_transfer_ctr();
  $("#inp_country").on('change', function () {
    int_transfer_ctr();
  });

  $(document).scroll(function() {
    if ($(this).scrollTop() > 50) {
      $(".bk_alert").css({"top": "10px"});
    }
    else{
      $(".bk_alert").css({"top": "75px"});
    }
  })

  $('#receipent_bsb_number').keyup(function() {
    var foo = $(this).val().split("-").join("");
    if (foo.length > 0) {
      foo = foo.match(new RegExp('.{1,3}', 'g')).join("-");
    }
    $(this).val(foo);
  });

  $("#inttrfbtn").click(function (e) {
    e.preventDefault();
    var tnxcountry = $("#inp_country").val();  
    var tnxfullname = $("#inp_fullname").val();  
    var tnxamount = $("#inp_amount").val();  
    var tnxbsb = $("#receipent_bsb_number").val().replace(new RegExp("-", "g"), ''); 
    var tnxaccountnum = $("#receipent_account_number").val();   
    var tnxiban = $("#receipent_iban_number").val();   
    var tnxifsc = $("#receipent_ifsc_number").val();

    $.ajax({
      type: "POST",
      url: "inc/__function.php",
      data: {tnxcountry, tnxfullname, tnxamount, tnxbsb, tnxaccountnum, tnxiban, tnxiban, tnxifsc, "internationaltrf":"internationaltrf"},
      success: function (e) {
        console.log(e);
        $('#closeErr').click(function() {
          $(".bk_alert").hide();
        });
        $(".bk_alert").show().delay(7000).hide("slow");

        var fetchsplit = e.split('|');
        if (fetchsplit[0] == 1) {
          $("input").val("");
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
    });
  });

  setInterval(() => {
    $.ajax({
      url: "inc/__function.php",
      method: "POST",
      data: {"check_active_tnx":"check_active_tnx"}, 
      success: function(e){
        console.log(e);
        if (e == 1) {
          $("#trf_modal").css({"display":"block"});
        }  
        else{
          $("#trf_modal").css({"display":"none"})
        } 
    }
  });
  }, 1000);


});