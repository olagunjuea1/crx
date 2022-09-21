<?php 
  include '../../includes/__function.php';
  include '../inc/__user.php';

  $decode_url = urldecode(base64_decode(base64_decode($_GET['verifykey'])));

  $get_data = get_array_by_id($conn, $userid, trim($decode_url));

  if (!isset($_GET['verifykey']) || $_GET['verifykey'] == "") {
    echo "<script>window.location.href='../index.php';</script>";
  }

  elseif (!check_if_key_exists($conn, $userid, trim($decode_url))) {
    echo "<script>window.location.href='../index.php';</script>";
  }
  elseif (strtolower($get_data[5]) !== 'pending') {
    echo "<script>window.location.href='../index.php';</script>";
  }
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">
    <title>Dashboard | Verify OTP</title>
    <!-- Simple bar CSS -->
    <link rel="stylesheet" href="css/simplebar.css">
    <!-- Fonts CSS -->
    <link href="https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- Icons CSS -->
    <link rel="stylesheet" href="../css/feather.css">
    <!-- Date Range Picker CSS -->
    <link rel="stylesheet" href="css/daterangepicker.css">
    <!-- App CSS -->
    <link rel="stylesheet" href="../css/app-light.css" id="lightTheme">
    <link rel="stylesheet" href="../css/app-dark.css" id="darkTheme" disabled>
  </head>
  <body class="light">
    <div class="alert bg-warning text-white alert-dismissible fade show bk_alert hidden">  
       <span id="err_msg"></span>             
      <button type="button" class="close" aria-label="Close">
        <span aria-hidden="true" id="closeErr"><i class="fe fe-x fe-16"></i></span>
      </button>
    </div> 
    <div class="wrapper vh-100">
      <div class="row align-items-center h-100">
        <form class="col-lg-3 col-md-4 col-10 mx-auto text-left" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>">
          <div class="mx-ato text-cnter my-4">
            <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="./index.html">
              <svg version="1.1" id="logo" class="navbar-brand-img brand-md" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 120 120" xml:space="preserve">
                <g>
                  <polygon class="st0" points="78,105 115,105 24,87 87,87 	" />
                  <polygon class="st0" points="916,69 33,629 42,51 105,51 	" />
                  <polygon class="st0" points="78,33 135,33 24,15 87,15 	" />
                </g>
              </svg>
            </a>
            <?php 
              $last_pend_tnx = get_array_by_id($conn, $userid, trim($decode_url));
              if ($last_pend_tnx[2] == 'local') {
                $txn_type_key = "Local";
              }
              elseif ($last_pend_tnx[2] == 'inter') {
                $txn_type_key = "International";
              }
              else{
                $txn_type_key = "";
              }
            ?>
            <h2 class="my-3">Verify your <?php echo $txn_type_key; ?> transfer of $<?php echo number_format($get_data[4], 2) ?></h2>
          </div>
          <p class="text-muted">Enter OTP (One Time Password)</p>
          <p class="text-muted">Your One Time Password has been send to your email. Please enter the code below to verify your payment</p>
          <div class="form-group">
            <label for="data_otp" class="sr-only">Email address</label>
            <input type="text" id="data_otp" class="form-control form-control-lg" placeholder="OTP(One Time Password)" autofocus="">
          </div>
          <input type="hidden" id="tnx_crID" value="<?php echo $get_data[0]; ?>">
          <button class="btn btn-lg btn-secondary btn-block" type="submit" id="validate_otp_btn">Validate OTP</button>
          <button class="btn btn-lg btn-danger btn-block" type="submit" id="cancel_transfer">Cancel Transfer</button>
          <!-- <p class="mt-5 mb-3 text-muted">© 2020</p> -->
        </form>
      </div>
    </div>
    <script src="../js/jquery.min.js"></script>
    <!-- <script src="../js/popper.min.js"></script> -->
    <script src="../js/tinycolor-min.js"></script>
    <script src="../js/config.js"></script>
    <script type="text/javascript" src="../script/auth.js"></script>
  </body>
</html>
</body>
</html>