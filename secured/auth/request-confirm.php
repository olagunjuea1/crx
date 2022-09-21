<?php 
  include '../../includes/__function.php';
  include '../inc/__user.php';

  $decode_id = urldecode(base64_decode(base64_decode($_GET['paymentkey']))); 

  $qry_fetch = mysqli_query($conn, "SELECT * FROM `pmt_request` WHERE `userid` = '$userid' AND `req_id` = '$decode_id'");

  $fetch_data = mysqli_fetch_array($qry_fetch);

  if (!isset($_GET['paymentkey']) || $_GET['paymentkey'] == "") {
    echo "<script>window.location.href='../index.php';</script>";
  }
  if (mysqli_num_rows($qry_fetch) < 1) {
    echo "<script>window.location.href='../index.php';</script>";
  }
  elseif (strtolower($fetch_data['status']) !== 'pending') {
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
    <title>Dashboard | Payment Request Confirmation</title>
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
  <body class="light ">
    <div class="wrapper vh-100">
      <div class="align-items-center h-100 d-flex w-50 mx-auto">
        <div class="mx-auto text-center">
          <?php 
            $usermail = $fetch_data['userid'];
            $data_fetch = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM `clients` WHERE `email` = '$usermail'"));
          ?>
          <h2 class="mb-1 text-muted font-weight-bold mb-4">Hello <?php echo ucfirst($data_fetch['firstname']); ?>!</h2>
          <h1 class="display-1 m-0 font-weight-bolder text-muted mt-5" style="font-size:80px;">$<?php echo number_format($fetch_data['amount'], 2); ?></h1>
          <h6 class="mb-3 mt-3 text-muted">Your payment request was successful, <br> we will notify once <?php echo $fetch_data['req_userid']; ?> accept your request</h6>
          <?php 
            if ($fetch_data['status'] == 'pending') {
              $req_stat = 'warning';
              $req_message = 'Pending';
            }
            elseif ($fetch_data['status'] == 'failed') {
              $req_stat = 'danger';
              $req_message = 'failed';
            }
            elseif ($fetch_data['status'] == 'success') {
              $req_stat = 'success';
              $req_message = 'success';
            }
            else{
              $req_stat = 'primary';
              $req_message = 'N/A';
            }
          ?>
          <a href="../index.php" class="btn btn-lg btn-<?php echo $req_stat; ?> px-5 mt-4"><?php echo $req_message ?></a>
        </div>
      </div>
    </div>
    <script src="../js/jquery.min.js"></script>
    <script src="../js/tinycolor-min.js"></script>
    <script src="../js/config.js"></script>
    <script type="text/javascript" src="../script/auth.js"></script>
  </body>
</html>
</body>
</html>