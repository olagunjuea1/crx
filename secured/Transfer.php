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
                <div class="col-md-5 py-5 wow fadeInLeft">
                  <div class="card-deck">
                    <div class="card shadow mb-4">
                      <div class="card-header">
                        <strong class="card-title">Local Transfer</strong>
                      </div>
                      <div class="card-body">
                        <form>
                          <div class="form-group">
                            <label for="routing">Routing Number</label>
                            <input type="text" class="form-control forminput" id="routing" placeholder="Routing Number">
                            <div id="routing_msg" class="mt-1 pb_fxs"></div>
                          </div>
                          <div class="form-group">
                            <label for="accountNumber">Account Number</label>
                            <input type="text" class="form-control forminput" id="accountNumber" placeholder="Account Number">
                            <div id="account_number" class="mt-1 pb_fxs"></div>
                          </div>
                          <div class="form-group">
                            <label for="amount">Amount</label>
                            <input type="text" class="form-control forminput" id="amount" placeholder="Amount">
                          </div>
                          <button type="submit" class="btn btn-primary" id="bk_submit">Submit</button>
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
                <!-- Recent orders -->
                <div class="col-md-12">
                  <div class="card shadow eq-card">
                    <div class="card-header">
                      <strong class="card-title">Payment OUT</strong>
                    </div>
                    <div class="card-body">
                      <table class="table table-hover table-borderless table-striped mt-n3 mb-n1" id="tnxoutdata">
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
                            $total_data = fetch_data_by_type($conn, $userid, 'debit');
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
                </div> <!-- / .col-md-8 -->
                <!-- Recent Activity -->
              </div> <!-- end section -->

              <div class="row">
                <!-- Top transaction -->
                <?php include "layout/top_tnx.php" ?>
                <!-- Top transaction ends here -->
                <!-- recent transaction -->
                <?php include "layout/recent_tnx.php" ?>
                <!-- recent transaction ends here -->
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
    <script src="script/transfer.js"></script>
    <script type="text/javascript" src="../js/DataTables/datatables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#dataTables').dataTable();
        });
    </script>
    
  </body>
</html>