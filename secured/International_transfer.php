<?php 
  include '../includes/__function.php';
  include 'inc/__user.php';
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">
    <title>Dashboard</title>
    <!-- Simple bar CSS -->
    <link rel="stylesheet" href="css/simplebar.css">
    <!-- Fonts CSS -->
    <link href="https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- Icons CSS -->
    <link rel="stylesheet" href="css/feather.css">
    <!-- Date Range Picker CSS -->
    <link rel="stylesheet" href="css/daterangepicker.css">
    <!-- App CSS -->
    <link rel="stylesheet" href="css/app-light.css" id="lightTheme">
    <link rel="stylesheet" href="css/app-dark.css" id="darkTheme" disabled>
  </head>
  <body class="vertical light">
    <div class="wrapper">
      <!-- nav bar -->
      <?php include"layout/navbar.php"; ?>
      <!-- nav bar -->
      <main role="main" class="main-content">
        <div class="container-fluid">
          <div class="row justify-content-center">
            <div class="col-12">
              <!-- header -->
              <?php include"layout/header.php"; ?>
              <!-- header ends here -->
              <div class="alert bg-warning text-white alert-dismissible fade show mt-2 bk_alert hidden">  
                 <span id="trf_msg"></span>             
                <button type="button" class="close" aria-label="Close">
                  <span aria-hidden="true" id="closeErr"><i class="fe fe-x fe-16"></i></span>
                </button>
              </div>

              <!-- modal -->
              <style type="text/css">
                #trf_modal{
                  width: 300px;
                  right: 0 !important;
                  left: inherit;
                }
              </style>
              <div class="modal fade modal-right modal-slide show" tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel" aria-modal="true" aria-hidden="true" id="trf_modal">
                <div class="modal-dialog modal-sm" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="defaultModalLabel">Pending Transaction</h5>
                    </div>
                    <div class="modal-body"> 
                      <?php 
                        $lasttnx = get_last_pending_tnx_debit($conn, $userid);
                      ?>
                      <p>You have a pending transaction of $<?php echo number_format($lasttnx[0][4], 2) ?> in progress, please verify the transaction to continue transfer</p>

                      <a href="auth/auth-validate.php?verifykey=<?php echo urlencode(base64_encode(base64_encode($lasttnx[0][0]))); ?>"><button class="btn btn-primary btn-md mb-2">Verify Transaction</button></a>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row align-items-center justify-content-between flex-wrap-reverse">                
                <div class="col-md-6 py-5 wow fadeInLeft">
                  <div class="card-deck">
                    <div class="card shadow mb-4">
                      <div class="card-header">
                        <strong class="card-title">International Transfer</strong>
                      </div>
                      <div class="card-body">
                        <form>
                          <div class="form-group">
                            <label for="int_tnx_option">Country</label>
                            <select class="form-control" id="inp_country">
                              <option value="australia" selected>Australia</option>                              
                              <option value="india">India</option>
                              <option value="intdefault">Other countries</option>
                            </select>
                          </div>
                          <div class="form-group">
                            <label for="inp_fullname">Receipient's full name</label>
                            <input type="text" class="form-control" id="inp_fullname" placeholder="Receipient's full name">
                          </div>
                          <div class="form-group">
                            <label for="inp_amount">Amount</label>
                            <input type="text" class="form-control" id="inp_amount" placeholder="Amount">
                          </div>  
                          <div class="form-group hidden int inpbsb">
                            <label for="receipent_bsb_number">Receipient's Bank-State-Branch (BSB) number</label>
                            <input type="text" class="form-control" id="receipent_bsb_number" placeholder="Receipient's BSB number">
                          </div>
                          <div class="form-group hidden inpacctno">
                            <label for="receipent_account_number">Receipient's Account number</label>
                            <input type="text" class="form-control" id="receipent_account_number" placeholder="Receipient's Account number">
                          </div>
                          <div class="form-group hidden inpiban">
                            <label for="receipent_iban_number">Receipient's IBAN</label>
                            <input type="text" class="form-control" id="receipent_iban_number" placeholder="Receipient's IBAN">
                          </div>
                          <div class="form-group hidden inpifsc">
                            <label for="receipent_ifsc_number">Receipient's IFSC</label>
                            <input type="text" class="form-control" id="receipent_ifsc_number" placeholder="Receipient's IFSC">
                          </div>                        
                          <button type="submit" class="btn btn-primary" id="inttrfbtn">Transfer</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-5 py-5 wow zoomIn">
                  <div class="img-fluid text-center">
                    <img src="assets/images/banner_image_1.svg" alt="">
                  </div>
                </div>
              </div>

              <div class="row">
                <?php include 'layout/top_tnx.php'; ?>
                <!-- .col -->
                <?php include 'layout/recent_tnx.php'; ?>
                <!-- .col -->
              </div> <!-- .row -->

            </div>
          </div> <!-- .row -->
        </div> <!-- .container-fluid -->
        <?php include 'layout/notification.php'; ?>
      </main> <!-- main -->
    </div> <!-- .wrapper -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/simplebar.min.js"></script>
    <script src="js/tinycolor-min.js"></script>
    <script src="js/config.js"></script>
    <script src="js/apexcharts.min.js"></script>
    <script src="js/apexcharts.custom.js"></script>
    <script src="js/apps.js"></script>
    <script src="script/inttransfer.js"></script>
  </body>
</html>