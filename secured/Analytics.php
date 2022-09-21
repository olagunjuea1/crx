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
    <?php include 'inc/__chart.php'; ?>
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
              <?php $fetch_tnx_total = fetchTnxdata_rev($conn, $userid); ?>
              <div class="my-4">
                <div id="lineChart"></div>
              </div><!-- .row -->
              <!-- widgets -->
              <div class="row my-4">
                <div class="col-md-4">
                  <div class="card shadow mb-4">
                    <div class="card-body">
                      <div class="row align-items-center">
                        <div class="col">
                          <small class="text-muted mb-1">Total Transaction</small>
                          <h3 class="card-title mb-0">
                            <?php                               
                              echo "$".thousandsCurrencyFormatb(calc_sum($conn, $userid));
                            ?>
                          </h3>
                          <p class="small text-muted mb-0"><span><?php echo count($fetch_tnx_total); ?> in Total</span></p>
                        </div>
                        <div class="col-4 text-right">
                          <span class="sparkline inlineline"></span>
                        </div>
                      </div> <!-- /. row -->
                    </div> <!-- /. card-body -->
                  </div> <!-- /. card -->
                </div> <!-- /. col -->
                <div class="col-md-4">
                  <div class="card shadow mb-4">
                    <div class="card-body">
                      <div class="row align-items-center">
                        <div class="col">
                          <small class="text-muted mb-1">Total Credit</small>
                          <h3 class="card-title mb-0">$<?php echo thousandsCurrencyFormatb(calc_sum_type($conn, $userid, 'credit', 'success')) ?></h3>
                          <p class="small text-muted mb-0"><span><?php echo calc_sum_num($conn, $userid, 'credit', 'success'); ?> in Total</span></p>
                        </div>
                        <div class="col-4 text-right">
                          <span class="sparkline inlinepie"></span>
                        </div>
                      </div> <!-- /. row -->
                    </div> <!-- /. card-body -->
                  </div> <!-- /. card -->
                </div> <!-- /. col -->
                <div class="col-md-4">
                  <div class="card shadow mb-4">
                    <div class="card-body">
                      <div class="row align-items-center">
                        <div class="col">
                          <small class="text-muted mb-1">Total Debit</small>
                          <h3 class="card-title mb-0">$<?php echo thousandsCurrencyFormatb(calc_sum_type($conn, $userid, 'debit', 'success')) ?></h3>
                          <p class="small text-muted mb-0"><span><?php echo calc_sum_num($conn, $userid, 'debit', 'success'); ?> in Total</span></p>
                        </div>
                        <div class="col-4 text-right">
                          <span class="sparkline inlinebar"></span>
                        </div>
                      </div> <!-- /. row -->
                    </div> <!-- /. card-body -->
                  </div> <!-- /. card -->
                </div> <!-- /. col -->
              </div> <!-- end section -->
              <div class="row my-4">
                <div class="col-md-6 mb-4">
                  <div class="card shadow">
                    <div class="card-header">
                      <strong class="card-title mb-0">Transaction</strong>
                    </div>
                    <div class="card-body">
                      <canvas id="pieChartjs" width="400" height="300"></canvas>
                    </div> <!-- /.card-body -->
                  </div> <!-- /.card -->
                </div> <!-- /. col -->
                <div class="col-md-6 mb-4">
                  <div class="card shadow">
                    <div class="card-header">
                      <strong class="card-title mb-0">Credit | Debit</strong>
                    </div>
                    <div class="card-body">
                      <canvas id="areaChartjs" width="400" height="300"></canvas>
                    </div> <!-- /.card-body -->
                  </div> <!-- /.card -->
                </div> <!-- /. col -->
              </div> <!-- end section -->
              <div class="row">
                <div class="col-md-12">
                  <div class="card shadow eq-card">
                    <div class="card-header">
                      <strong class="card-title">Transaction</strong>
                    </div>
                    <div class="card-body">
                      <table class="table table-hover table-borderless table-striped mt-n3 mb-n1" id="tnxdata">
                        <thead>
                          <tr>
                            <th>S/N</th>
                            <th>TNX ID</th>
                            <th>Transaction</th>
                            <th>Amount</th>
                            <th>TNX Type</th>
                            <th>Date</th>    
                            <th>Status</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                            $total_data = fetchTnxdata_rev($conn, $userid);
                            if (!empty($total_data)) {
                              if (count($total_data) > 15) {$ycount = 15;}
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
                                  <?php 
                                    $exp_data_account_info = explode(",", $exp_data[3]);   
                                  ?>                             
                                  <td><?php echo ucfirst($exp_data[1]); ?><br /><span class="dot dot-md bg-<?php echo $tnx_color; ?> mr-2"></span><span class="small text-muted"><?php if (!empty($exp_data_account_info[2])) {echo $exp_data_account_info[2];} else{echo "N/A";} ?></span></td>     
                                  <td>
                                    $<?php echo number_format($exp_data[4], 2); ?>                                      
                                  </td> 
                                  <td>
                                    <?php
                                      if (strtolower($exp_data[2]) == 'local') {
                                        echo "Local Transfer";
                                      }
                                      elseif (strtolower($exp_data[2]) == 'inter') {
                                        echo "International Transfer";
                                      }
                                      else{
                                        echo "N/A";
                                      }
                                    ?>                                      
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
    <script src="js/Chart.min.js"></script>
    <script src="js/apps.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#tnxdata').DataTable();
        });
    </script>
  </body>
</html>