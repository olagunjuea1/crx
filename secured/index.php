<?php 
  include '../includes/__function.php';
  include 'inc/__user.php';
  include 'inc/__chart.php';
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
    <script src="js/jquery.min.js"></script>
    <script src="script/main.js"></script>
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
              <div class="card shadow my-4">
                <div class="card-body">
                  <div class="row align-items-center my-4">
                    <div class="col-md-4">
                      <div class="mx-4">
                        <strong class="mb-0 text-uppercase text-muted">Balance</strong><br />
                        <h3>$<span class="ex_balance"></span></h3>
                      </div>
                      <div class="row align-items-center">
                        <div class="col-12">
                          <div class="p-4">
                            <p class="small text-uppercase text-muted mb-0">Available Balance</p>
                            <span class="h2 mb-0">$<span class="ex_available"></span></span>
                          </div>
                        </div>
                      </div>
                      <div class="row align-items-center">
                        <div class="col-6">
                          <div class="p-4">
                            <p class="small text-uppercase text-muted mb-0">Credit</p>
                            <span class="h2 mb-0">$<span class="ex_credit_b"></span></span>
                          </div>
                        </div>
                        <div class="col-6">
                          <div class="p-4">
                            <p class="small text-uppercase text-muted mb-0">Debit</p>
                            <span class="h2 mb-0">$<span class="ex_debit_b"></span></span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-8">
                      <div class="mr-4">
                        <div id="areaChart"></div>
                      </div>
                    </div> <!-- .col-md-8 -->
                  </div> <!-- end section -->
                </div> <!-- .card-body -->
              </div> <!-- .card -->
              <div class="row items-align-baseline">
                <div class="col-md-12 col-lg-4">
                  <div class="card shadow eq-card mb-4">
                    <div class="card-body mb-n3">
                      <div class="row align-items-center h-100">
                        <div class="col-md-6 my-3">                          
                          <p class="mb-0"><strong class="mb-0 text-uppercase text-muted">Balance</strong></p>
                          <h3>$<span class="ex_balance"></span></h3>
                          <p class="small text-muted mb-0"><span>Check and manage your account balance</span></p>
                        </div>
                        <div class="col-md-6 my-4 text-center">
                          <div lass="chart-box mx-4">
                            <div id="radialbarWidget"></div>
                          </div>
                        </div>
                        <div class="col-md-6 border-top py-3">
                          <p class="mb-1"><strong class="text-muted">Credit</strong></p>
                          <h4 class="mb-0">$<span class="ex_credit_b"></span></h4>
                          <p class="small text-muted mb-0"><span>$<?php echo thousandsCurrencyFormatb(calc_sum_last_week($conn, $userid, 'credit', 'success')); ?> Last week</span></p>
                        </div> <!-- .col -->
                        <div class="col-md-6 border-top py-3">
                          <p class="mb-1"><strong class="text-muted">Debit</strong></p>
                          <h4 class="mb-0">$<span class="ex_debit_b"></span></h4>
                          <p class="small text-muted mb-0"><span>$<?php echo thousandsCurrencyFormatb(calc_sum_last_week($conn, $userid, 'debit', 'success')); ?> Last week</span></p>
                        </div> <!-- .col -->
                      </div>
                    </div> <!-- .card-body -->
                  </div> <!-- .card -->
                </div> <!-- .col -->
                <div class="col-md-12 col-lg-4">
                  <div class="card shadow eq-card mb-4">
                    <div class="card-body">
                      <div class="chart-widget mb-2">
                        <div id="radialbar"></div>
                      </div>
                      <div class="row items-align-center">
                        <div class="col-4 text-center">
                          <p class="text-muted mb-1">Total Credit</p>
                          <h5 class="mb-1">$<span class="ex_credit_b"></span></h5>
                        </div>
                        <div class="col-4 text-center">                          
                          <p class="text-muted mb-1">This Month</p>
                          <h5 class="mb-1">$<?php echo thousandsCurrencyFormatb(calc_sum_this_month($conn, $userid, 'credit', 'success')) ?></h5>
                        </div>
                        <div class="col-4 text-center">
                          <p class="text-muted mb-1">Last Month</p>
                          <h5 class="mb-1">$<?php echo thousandsCurrencyFormatb(calc_sum_last_month($conn, $userid, 'credit', 'success')) ?></h5>
                        </div>                        
                      </div>
                    </div> <!-- .card-body -->
                  </div> <!-- .card -->
                </div> <!-- .col -->
                <?php $fetch_tnx_total = fetchTnxdata_rev($conn, $userid); ?>
                <div class="col-md-12 col-lg-4">
                  <div class="card shadow eq-card mb-4">
                    <div class="card-body">
                      <div class="d-flex mt-3 mb-4">
                        <div class="flex-fill pt-2">
                          <p class="mb-0 text-muted"><?php echo count($fetch_tnx_total); ?> Transaction in Total</p>
                          <h4 class="mb-0 mt-2 ">
                            <?php                               
                              echo "$".thousandsCurrencyFormatb(calc_sum($conn, $userid));
                            ?>
                          </h4>
                        </div>
                        <div class="flex-fill chart-box mt-n2">
                          <div id="barChartWidget"></div>
                        </div>
                      </div> <!-- .d-flex -->
                      <div class="row border-top">
                        <div class="col-md-6 pt-4">
                          <h4 class="mb-0">$<?php echo thousandsCurrencyFormatb(calc_sum_type($conn, $userid, 'credit', 'success')) ?></h4>
                          <p class="mb-0 text-muted"><?php echo calc_sum_num($conn, $userid, 'credit', 'success'); ?> Credit in Total</p>
                        </div>
                        <div class="col-md-6 pt-4">
                          <h4 class="mb-0">$<?php echo thousandsCurrencyFormatb(calc_sum_type($conn, $userid, 'debit', 'success')) ?></h4>
                          <p class="mb-0 text-muted"><?php echo calc_sum_num($conn, $userid, 'debit', 'success'); ?> Debit in Total</p>
                        </div>
                      </div> <!-- .row -->
                    </div> <!-- .card-body -->
                  </div> <!-- .card -->
                </div> <!-- .col-md -->
              </div>
              <div class="row">                
                <!-- Recent transaction -->
                <?php include "layout/recent_tnx.php" ?>
                <!-- Recent transaction ends here -->
                <!-- Top transaction -->
                <?php include "layout/top_tnx.php" ?>
                <!-- Top transaction ends here -->
              </div> <!-- .row -->
              <div class="row">
                <!-- Recent orders -->
                <div class="col-md-8">
                  <div class="card shadow eq-card">
                    <div class="card-header">
                      <strong class="card-title">Transaction</strong>
                      <a class="float-right small text-muted" href="Transaction.php">View all</a>
                    </div>
                    <div class="card-body">
                      <table class="table table-hover table-borderless table-striped mt-n3 mb-n1" style="font-size: 13px;">
                        <thead>
                          <tr>
                            <th>S/N</th>
                            <th>Transaction</th>
                            <th>Amount</th>
                            <th>Date</th>    
                            <th>Status</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                            $total_data = fetchTnxdata_rev($conn, $userid);
                            if (!empty($total_data)) {
                              if (count($total_data) > 5) {$ycount = 5;}
                              else{$ycount = count($total_data);}
                              $counter = 1;
                              for ($x=0; $x < $ycount; $x++) { ?>
                                <?php $exp_data = explode("--", $total_data[$x]); ?>
                                <tr>
                                  <td><?php echo $counter++; ?></td>  
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
                                  <?php 
                                    $exp_data_account_info = explode(",", $exp_data[3]);   
                                  ?>                           
                                  <td><?php echo ucfirst($exp_data[1]); ?><br /><span class="dot dot-md bg-<?php echo $tnx_color; ?> mr-2"></span><span class="small text-muted"><?php if (!empty($exp_data_account_info[2])) {echo $exp_data_account_info[2];} else{echo "N/A";} ?></span></td>      
                                  <td>
                                    $<?php echo number_format($exp_data[4], 2) ?>                                      
                                  </td>                            
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
                                      $stat_color = 'muted';
                                      $stat_message = $exp_data[5];
                                    }
                                  ?>
                                  <td><span class="dot dot-md bg-<?php echo $stat_color; ?> mr-2"></span> <small class="text-muted"><?php echo ucfirst($stat_message); ?></small></td>
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
                <div class="col-md-4">
                  <div class="card shadow eq-card timeline">
                    <div class="card-header">
                      <strong class="card-title">Recent Activity</strong>
                      <a class="float-right small text-muted" href="Transaction.php">View all</a>
                    </div>
                    <div class="card-body" data-simplebar style="height: 360px; overflow-y: auto; overflow-x: hidden;">
                      <div class="pb-3 timeline-item item-primary">
                        <?php 
                          $fetch_tnx_arry = fetchdata($conn, 'tbl_notif', 'userid', $userid, 'message');
                          $notif = explode("=>", $fetch_tnx_arry);
                          if (!empty($notif)) {
                            if (count($notif) > 40) {$ycount = 40;}
                            else{$ycount = count($notif);}
                            $counter = 1;
                            for ($x=0; $x < $ycount; $x++) { ?>
                              <?php $exp_data = explode("--", $notif[$x]); ?>
                              <div class="pb-3 timeline-item item-primary">
                                <div class="pl-5">
                                  <div><span class="badge badge-light">1h ago</span></div>
                                  <div class="mb-1"><strong><?php echo ucfirst($exp_data[1]); ?></strong></div>
                                  <p class="small text-muted"><?php echo ucfirst($exp_data[2]); ?> 
                                  </p>
                                </div>
                              </div>
                            <?php }  
                          }
                          else{ ?>
                            <div class="pb-3 timeline-item item-primary">
                              <div class="pl-5">
                                <div class="mb-1"><strong>No New Notification</strong></div>
                              </div>
                            </div>
                          <?php }
                        ?>                        
                      </div>
                    </div> <!-- / .card-body -->
                  </div> <!-- / .card -->
                </div> <!-- / .col-md-3 -->
              </div> <!-- end section -->
            </div>
          </div> <!-- .row -->
        </div> 
        <?php include 'layout/notification.php'; ?>
      </main> <!-- main -->
    </div> <!-- .wrapper -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/simplebar.min.js"></script>
    <script src="js/tinycolor-min.js"></script>
    <script src="js/config.js"></script>
    <script src="js/apexcharts.min.js"></script>
    <script src="js/apexcharts.custom.js"></script>
    <script src="js/apps.js"></script>
  </body>
</html>