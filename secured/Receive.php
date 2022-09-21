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

              <div class="row align-items-center mb-4">
                <div class="col">
                  <h2 class="h5 page-title">Receive</h2>
                </div>
              </div> <!-- .row -->

              <div class="row align-items-center justify-content-between">  
                <div class="col-md-5 py-5 wow zoomIn">
                    <div class="img-fluid text-center">
                      <img src="assets/images/banner_image_1.svg" alt="">
                    </div>
                  </div>              
                <div class="col-md-6 py-5 wow fadeInLeft">
                  <div class="row">
                    <div class="col-md-9">
                      <p>To start receiving payment, send the routing number and account number to start receiving payment</p>
                    </div>
                  </div>
                  <div class="card-deck">
                    <div class="card shadow mb-4">
                      <div class="card-header">
                        <strong class="card-title">Reveive Payment</strong>
                      </div>
                      <div class="card-body">                        
                        <div class="list-group list-group-flush my-n3">
                           <div class="list-group-item">
                            <div class="row align-items-center">
                              <div class="col-3 col-md-2">
                                <img src="./assets/products/p1.jpg" alt="..." class="thumbnail-sm">
                              </div>
                              <div class="col">
                                <strong>Account</strong>
                                <div class="my-0 text-muted small">Checking</div>
                              </div>
                            </div>
                          </div>
                          <div class="list-group-item">
                            <div class="row align-items-center">
                              <div class="col-3 col-md-2">
                                <img src="./assets/products/p1.jpg" alt="..." class="thumbnail-sm">
                              </div>
                              <div class="col">
                                <strong>Routing Number</strong>
                                <div class="my-0 text-muted small"><?php echo fetchdata($conn, 'clients', 'email', $userid, 'account_number'); ?></div>
                              </div>
                            </div>
                          </div>
                          <div class="list-group-item">
                            <div class="row align-items-center">
                              <div class="col-3 col-md-2">
                                <img src="./assets/products/p1.jpg" alt="..." class="thumbnail-sm">
                              </div>
                              <div class="col">
                                <strong>Account Number</strong>
                                <div class="my-0 text-muted small"><?php echo fetchdata($conn, 'clients', 'email', $userid, 'routing_number'); ?></div>
                              </div>
                            </div>
                          </div>
                        </div> <!-- / .list-group -->
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
                      <strong class="card-title">Payment IN</strong>
                    </div>
                    <div class="card-body">
                      <table class="table table-hover table-borderless table-striped mt-n3 mb-n1">
                        <thead>
                          <tr>
                            <th>S/N</th>
                            <th>TNX ID</th>
                            <th>Transaction</th>
                            <th>Date</th>    
                            <th>Status</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                            $total_data = fetch_data_by_type($conn, $userid, 'credit');
                            if (!empty($total_data)) {
                              if (count($total_data) > 10) {$ycount = 10;}
                              else{$ycount = count($total_data);}
                              $counter = 1;
                              for ($x=0; $x < $ycount; $x++) { ?>
                                <?php $exp_data = explode("--", $total_data[$x]); ?>
                                <tr>
                                  <td><?php echo $counter++; ?></td>  
                                  <td><small><?php echo $exp_data[0]; ?></small></td>  
                                  <?php 
                                    if (strtolower($exp_data[1]) == 'credit') {
                                      $tnx_color = 'success';
                                    }
                                    elseif (strtolower($exp_data[1]) == 'debit') {
                                      $tnx_color = 'danger';
                                    }
                                    else{
                                      $tnx_color = 'muted';
                                    }
                                  ?>                                
                                  <td><?php echo ucfirst($exp_data[1]); ?><br /><span class="dot dot-md bg-<?php echo $tnx_color; ?> mr-2"></span><span class="small text-muted">901-6206 Cras Av.</span></td>                                  
                                  <td>
                                    <?php 
                                      $date_exp = explode(" ", $exp_data[6]);
                                      $time_exp = explode(":", $date_exp[3]);
                                      echo $date_exp[0]." ".$date_exp[1]." ".$date_exp[2]." ".$time_exp[0].":".$time_exp[1];
                                    ?>                                      
                                  </td>
                                  <?php 
                                    if (strtolower($exp_data[5]) == 'success') {
                                      $stat_color = 'success';
                                      $stat_message = 'Successful';
                                    }
                                    elseif (strtolower($exp_data[5]) == 'pending') {
                                      $stat_color = 'warning';
                                      $stat_message = 'pending';
                                    }
                                    elseif (strtolower($exp_data[5]) == 'failed') {
                                      $stat_color = 'danger';
                                      $stat_message = 'Failed';
                                    }
                                    else{
                                      $stat_color = 'secondary';
                                      $stat_message = $exp_data[5];
                                    }
                                  ?>
                                  <td><span class="dot dot-md bg-<?php echo $stat_color; ?> mr-2"></span> <small><?php echo ucfirst($stat_message); ?></small></td>
                                </tr>
                              <?php }  
                            }
                            else{ ?>
                              <tr>
                                <td colspan="5">No Data yet</td>
                              </tr>
                            <?php }
                          ?>
                        </tbody>
                      </table>
                    </div> <!-- .card-body -->
                  </div> <!-- .card -->
                </div> <!-- / .col-md-8 -->
                <!-- Recent Activity -->
              </div> <!-- end section -->

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
  </body>
</html>