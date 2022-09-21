<?php 
  include 'includes/__function.php';
  include 'includes/__gen_func.php';
  if (!isset($_GET['setupmeuser']) || $_GET['setupmeuser'] == "") {
      header("location: index.php");
  }
  else{
    $fetchemail = strtolower(base64_decode(base64_decode($_GET['setupmeuser'])));
    checkuserid($conn, $fetchemail);
  }
?>
<!DOCTYPE html>
<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="assets/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Setup User - Admin</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" href="../MEBank/Assets/Images/favicon.ico" type="image/x-icon" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="assets/vendor/js/helpers.js"></script>

    <script src="assets/js/config.js"></script>
  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->
        <?php include 'layout/sidebar.php'; ?>
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->

          <?php include 'layout/nav.php'; ?>

          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Manage and Activate User</span></h4>

              <!-- Bootstrap Table with Header - Footer -->
              <div class="card" id="section_top">
                <h5 class="card-header">Setup Users</h5>
                <div class="table-responsive text-nowrap">
                  <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
                      <div class="card-body card-block">
                          <div id="hero_message" class="alert hidden"></div>
                          <div class="row form-group">
                              <div class="col-md-12 mb-3"><b>Login Data</b></div>
                              <div class="col-md-4">
                                  <label for="customerid" class="text-secondary">Customer ID</label>
                                  <input type="text" placeholder="Customer ID" class="form-control input_validator" id="customerid" value="<?php echo generatecustomerid($conn); ?>">
                              </div>
                              <div class="col-md-4">
                                <label for="accesscode" class="text-secondary">Access Code</label>
                                  <input type="text" placeholder="Access Code" class="form-control input_validator" id="accesscode" value="<?php echo generateaccesscode($conn); ?>">
                              </div>
                              <div class="col-md-4">
                                <label for="accesscode" class="text-secondary">Account Number</label>
                                  <input type="text" placeholder="Account Number" class="form-control input_validator" id="accountnumber" value="<?php echo generatecustomeraccountnum($conn); ?>">
                              </div>

                              <div class="col-md-12 mb-3 mt-3"><b>Balance Section</b></div>
                              <div class="col-md-4">
                                  <input type="number" min="0" placeholder="Balance" class="form-control input_validator" id="balance">
                              </div>
                              <div class="col-md-4">
                                  <input type="number" min="0" placeholder="Total Debit" class="form-control input_validator" id="debit">
                              </div>
                              <div class="col-md-4">
                                  <input type="number" min="0" placeholder="Total Credit" class="form-control input_validator" id="credit">
                              </div>
                              <div class="col-md-12 mb-3 mt-3"><b>transaction Section</b></div>
                              <div class="col-md-4">
                                  <label for="tnxnum" class="text-primary">transaction Length</label>
                                  <input type="number" min="1" value="1" placeholder="No of transaction" class="form-control input_validator" id="tnxnum">
                              </div>
                              <div class="col-md-4">
                                  <label for="failedlength" class="text-danger">Failed Length</label>
                                  <input type="number" min="0" value="1" placeholder="Failure Length" class="form-control input_validator" id="failedlength">
                              </div>
                              <div class="col-md-4">
                                  <label for="pendinglength" class="text-warning">Pending Length</label>
                                  <input type="number" min="0" value="1" placeholder="Pending Length" class="form-control input_validator" id="pendinglength">
                              </div>
                              <?php 
                                  $maindate = date("Y-m-d");                                     
                                  $caldate = strtotime(date("Y-m-d")) - (60*60*24)*(365*1);                                     
                              ?>
                              <div class="col-md-4">
                                  <label for="startdate" class="text-danger">Start Date</label>
                                  <input type="date" value="<?php echo date("Y-m-d", $caldate) ?>" class="form-control input_validator" id="startdate">
                              </div>
                              <div class="col-md-4">
                                  <label for="enddate" class="text-success">End Date</label>
                                  <input type="date" value="<?php echo $maindate ?>" class="form-control input_validator" id="enddate">
                              </div>
                              <div class="col-md-12 mb-3 mt-3"><b>Card Section</b></div>                                                
                              <div class="col-md-4">
                                  <input type="text" placeholder="Card Number MasterCard 5[1-5]" minlength="16" maxlength="19" class="form-control input_validator" id="card_number">
                              </div>
                              <div class="col-md-4">
                                  <input type="text" placeholder="Credit Card Name" class="form-control input_validator" id="creditcardName" value="<?php echo ucfirst(fetchUser($conn, $fetchemail, 'firstname')).' '.ucfirst(fetchUser($conn, $fetchemail, 'lastname')); ?>">
                              </div>
                              <?php 
                                  $date = strtotime(date("d M Y")) + (60*60*24)*(365*4);                                     
                              ?>
                              <div class="col-md-4">
                                  <input type="text" minlength="5" maxlength="5" placeholder="Expiry Year" value="<?php echo date('m/y', $date); ?>" class="form-control input_validator" id="card_expiry">
                              </div>
                              <input type="hidden" class="input_validator" id="useradminID" value="<?php echo $fetchemail; ?>">
                          </div>
                      </div>
                      <div class="card-footer">
                          <button class="btn btn-success btn-sm" id="activate" onclick="return false">Activate Account</button>
                      </div>                                    
                  </form>
                </div>
              </div>
              <!-- Bootstrap Table with Header - Footer -->

              <hr class="my-5" />
            </div>
            <!-- / Content -->

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    <div class="buy-now">
      <a
        href="https://themeselection.com/products/sneat-bootstrap-html-admin-template/"
        target="_blank"
        class="btn btn-danger btn-buy-now"
        >Upgrade to Pro</a
      >
    </div>

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="assets/vendor/libs/jquery/jquery.js"></script>
    <script src="assets/vendor/libs/popper/popper.js"></script>
    <script src="assets/vendor/js/bootstrap.js"></script>
    <script src="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="assets/js/main.js"></script>

    <script type="text/javascript">
      $(document).ready(function () {
        $('#card_number').keyup(function() {
          var foo = $(this).val().split("-").join("");
          if (foo.length > 0) {
            foo = foo.match(new RegExp('.{1,4}', 'g')).join("-");
          }
          $(this).val(foo);
        });
        $('#card_expiry').keyup(function() {
          var valinp = $('#card_expiry').val();
          var foo = $(this).val().split("/").join("");
          if (foo.length > 0) {
            foo = foo.match(new RegExp('.{1,2}', 'g')).join("/");
          }
          $(this).val(foo);
        });
        $("#activate").click(function (e) {
          e.preventDefault();
          $(".input_validator").each(function () {
            if (!$(this).val()) {
              $("#hero_message").html("All fields are required");
              $("#hero_message").show();
              $("#hero_message").addClass('alert-danger');
              $("#hero_message").removeClass('alert-success');
              setTimeout(function () {
                  $("#hero_message").hide(500);
              }, 5000);
              $('html, body').animate({
                scrollTop: $("#section_top").offset().top
              }, 500);  
              return cycheck = false;          
            }
            else{
              return cycheck = true; 
            }
          });

          if (cycheck == true) {
            var uicustomerid = $("#customerid").val();
            var uiaccesscode = $("#accesscode").val();
            var uiaccountnumber = $("#accountnumber").val();
            var uibalance = $("#balance").val();
            var uidebit = $("#debit").val();
            var uicredit = $("#credit").val();
            var uitnxnum = $("#tnxnum").val();
            var uifailedlength = $("#failedlength").val();
            var uipendinglength = $("#pendinglength").val();
            var uistartdate = $("#startdate").val();
            var uienddate = $("#enddate").val();
            var uicard_number = $("#card_number").val();
            var uicreditcardName = $("#creditcardName").val();
            var uicard_expiry = $("#card_expiry").val();
            var uiuserID = $("#useradminID").val();

            $.ajax({
                url: "includes/formdata.php",
                method: "POST",
                beforeSend: function () {
                  $("#activate").attr("disabled", true);
                },
                complete: function () {
                  $("#activate").attr("disabled", false);
                  window.scrollTo({top: 0, behavior: 'smooth'});
                },
                data: {"activateuser":"activateuser", uicustomerid, uiaccesscode, uiaccountnumber, uibalance, uidebit, uicredit, uitnxnum, uifailedlength, uipendinglength, uistartdate, uienddate, uicard_number, uicreditcardName, uicard_expiry, uiuserID},
                success: function (e) {
                  console.log(e);
                    if (e == 1) {
                       $("#hero_message").html("User Account Approved Successfully");
                       $("#hero_message").show();
                       $("#hero_message").addClass('alert-success');
                       $("#hero_message").removeClass('alert-danger');
                       setTimeout(function () {
                           $("#hero_message").hide(500);
                           window.location.href='index.php';
                       }, 8000);
                       $('html, body').animate({
                         scrollTop: $("#section_top").offset().top
                       }, 500); 
                    }
                    else{
                      $("#hero_message").html(e);
                      $("#hero_message").show();
                      $("#hero_message").addClass('alert-danger');
                      $("#hero_message").removeClass('alert-success');
                      setTimeout(function () {
                          $("#hero_message").hide(500);
                      }, 8000);
                      $('html, body').animate({
                        scrollTop: $("#section_top").offset().top
                      }, 500);    
                    }
                }
            }); 
          }
        })
      });
    </script>

  </body>
</html>
