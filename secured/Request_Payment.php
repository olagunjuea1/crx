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

              <div class="row align-items-center mb-4">
                <div class="col">
                  <h2 class="h5 page-title">Request</h2>
                </div>
              </div> <!-- .row -->
              <div class="row align-items-center justify-content-between">  
                <div class="col-md-5 py-5 wow zoomIn">
                    <div class="img-fluid text-center">
                      <img src="assets/images/banner_image_1.svg" alt="">
                    </div>
                  </div>              
                <div class="col-md-6 py-5 wow fadeInLeft">
                  <div class="card-deck">
                    <div class="card shadow mb-4">
                      <div class="card-header">
                        <strong class="card-title">Request Payment</strong>
                      </div>
                      <div class="card-body">
                        <form>
                          <div class="form-group">
                            <label for="request_email">Email</label>
                            <input type="email" class="form-control forminput" id="request_email" placeholder="Email">
                            <div id="request_email_msg" class="mt-1 pb_fxs"></div>
                          </div>
                          <div class="form-group">
                            <label for="request_amount">Amount</label>
                            <input type="text" class="form-control forminput" id="request_amount" placeholder="Amount">
                          </div>
                          <div class="form-group">
                            <label for="request_note">Note</label>
                            <textarea id="request_note" class="form-control forminput"></textarea>
                            <div id="request_note_msg" class="mt-1 pb_fxs"></div>
                          </div>
                          <button type="submit" class="btn btn-primary" id="request_btn">Request Payment</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>               
              </div>

              <div class="row">
                <!-- Recent orders -->
                <div class="col-md-12">
                  <div class="card shadow eq-card">
                    <div class="card-header">
                      <strong class="card-title">Request History</strong>
                    </div>
                    <div class="card-body">
                      <table class="table table-hover table-borderless table-striped mt-n3 mb-n1" id="reqdata">
                        <thead>
                          <tr>
                            <th>S/N</th>
                            <th>Request Type</th>
                            <th>Requested from</th>
                            <th>Request ID</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Date</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php 
                            $qry_fetch = mysqli_query($conn, "SELECT * FROM `pmt_request` WHERE `userid` = '$userid' OR `req_userid` = '$userid' oRDER BY `id` DESC");
                          ?>
                          <?php 
                            $countnum = 1;
                            while ($fetchrowpmt = mysqli_fetch_array($qry_fetch)) { ?>
                              <tr>
                                <td><?php echo $countnum++; ?></td>
                                <?php 
                                  if ($fetchrowpmt['userid'] == $userid) {
                                    $requestType = "Sent Request";
                                    $requestedfrm = $fetchrowpmt['req_userid'];
                                  }
                                  elseif ($fetchrowpmt['req_userid'] == $userid) {
                                     $requestType = "Received Request";
                                     $requestedfrm = $fetchrowpmt['userid'];
                                  }
                                  else{
                                    $requestType = "N/A";
                                    $requestedfrm = "N/A";
                                  }
                                ?>
                                <th scope="col"><?php echo $requestType; ?></th>
                                <td><?php echo $requestedfrm; ?></td>
                                <td><span class="small text-muted"><?php echo $fetchrowpmt['req_id']; ?></span></td>
                                <td><?php echo number_format($fetchrowpmt['amount'], 2); ?></td> 
                                <?php 
                                  if (strtolower($fetchrowpmt['status']) == 'accept') {
                                    $stat_color = 'success';
                                    $stat_message = 'Accepted';
                                  }
                                  elseif (strtolower($fetchrowpmt['status']) == 'pending') {
                                    $stat_color = 'warning';
                                    $stat_message = 'pending';
                                  }
                                  elseif (strtolower($fetchrowpmt['status']) == 'reject') {
                                    $stat_color = 'danger';
                                    $stat_message = 'Rejected';
                                  }
                                  else{
                                    $stat_color = 'secondary';
                                    $stat_message = "N/A";
                                  }
                                ?>   
                                <td><span class="dot dot-md bg-<?php echo $stat_color; ?> mr-2"></span> <?php echo ucfirst($stat_message); ?></td><td>
                                  <?php 
                                    $date_exp = explode(" ", $fetchrowpmt['trn_date']);
                                    $time_exp = explode(":", $date_exp[3]);
                                    echo $date_exp[0]." ".$date_exp[1]." ".$date_exp[2]." ".$time_exp[0].":".$time_exp[1];
                                  ?> 
                                </td>
                              </tr>
                            <?php }
                          ?>
                        </tbody>
                      </table>
                    </div> <!-- .card-body -->
                  </div> <!-- .card -->
                </div> <!-- / .col-md-8 --> <!-- / .col-md-3 -->
              </div>

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
    <script src="script/request.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#reqdata').DataTable();
        });
    </script>
  </body>
</html>