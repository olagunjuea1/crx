<?php 
  include 'includes/__function.php';
  include 'includes/__gen_func.php';

  if (!isset($_GET['tnxdata']) || $_GET['tnxdata'] == "") {
      header("location: index.php");
  }
  else{
    $fetchemail = strtolower(base64_decode(base64_decode($_GET['tnxdata'])));
    $qry = mysqli_query($conn, "SELECT * FROM `clients` WHERE `email` = '$fetchemail'");
    if (mysqli_num_rows($qry) < 1) {
      echo "<script>window.location.href='index.php';</script>";
    }
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

    <title>Dashboard - Admin</title>

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

    <link rel="stylesheet" href="assets/vendor/libs/apex-charts/apex-charts.css" />

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
              <div class="row">
                <div class="col-lg-12 col-md-4 order-1">
                  <div class="row">
                    <div class="col-lg-2 col-md-12 col-6 mb-4">
                      <div class="card">
                        <div class="card-body">
                          <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                              <img
                                src="assets/img/icons/unicons/chart-success.png"
                                alt="chart success"
                                class="rounded"
                              />
                            </div>
                          </div>
                          <span class="fw-semibold d-block mb-1">Total Balance</span>
                          <h5 class="card-title mb-2"><?php echo "A&#36;".thousandsCurrencyFormat(fetchdata($conn, 'account', 'userid', $fetchemail, 'balance')); ?></h5>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-2 col-md-12 col-6 mb-4">
                      <div class="card">
                        <div class="card-body">
                          <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                              <img
                                src="assets/img/icons/unicons/wallet-info.png"
                                alt="Credit Card"
                                class="rounded"
                              />
                            </div>
                          </div>
                          <span class="fw-semibold d-block mb-1">Available Balance</span>
                          <h5 class="card-title text-nowrap mb-1"><?php echo "A&#36;".thousandsCurrencyFormat(fetchdata($conn, 'account', 'userid', $fetchemail, 'available_balance')); ?></h5>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-2 col-md-12 col-6 mb-4">
                      <div class="card">
                        <div class="card-body">
                          <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                              <img
                                src="assets/img/icons/unicons/chart-success.png"
                                alt="chart success"
                                class="rounded"
                              />
                            </div>
                          </div>
                          <span class="fw-semibold d-block mb-1">Total Credit</span>
                          <h5 class="card-title mb-2"><?php echo "A&#36;".thousandsCurrencyFormat(fetchdata($conn, 'account', 'userid', $fetchemail, 'credit')); ?></h5>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-2 col-md-12 col-6 mb-4">
                      <div class="card">
                        <div class="card-body">
                          <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                              <img
                                src="assets/img/icons/unicons/chart-success.png"
                                alt="chart success"
                                class="rounded"
                              />
                            </div>
                          </div>
                          <span class="fw-semibold d-block mb-1">Total Debit</span>
                          <h5 class="card-title mb-2"><?php echo "A&#36;".thousandsCurrencyFormat(fetchdata($conn, 'account', 'userid', $fetchemail, 'debit')); ?></h5>
                        </div>
                      </div>
                    </div>
                    <?php $fetch_tnx_total = fetchTnxdata_rev($conn, $fetchemail); ?>
                    <div class="col-lg-2 col-md-12 col-6 mb-4">
                      <div class="card">
                        <div class="card-body">
                          <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                              <img
                                src="assets/img/icons/unicons/chart-success.png"
                                alt="chart success"
                                class="rounded"
                              />
                            </div>
                          </div>
                          <span class="fw-semibold d-block mb-1">Total transaction</span>
                          <h3 class="card-title mb-2"><?php echo count($fetch_tnx_total); ?></h3>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Total Revenue -->
                <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2 mb-4">
                  <div class="card">
                    <div class="row row-bordered g-0">
                      <div class="col-md-12">
                        <h5 class="card-header m-0 me-2 pb-3">Manage New User</h5>
                        <div class="card-body">
                          <div class="table-responsive text-nowrap" style="width: 100%;">
                              <table class="table" id="user_tbl">
                                <?php   
                                  $qry = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM `tnx` WHERE `userid` = '$fetchemail' ORDER by `id` DESC"));
                                  $count = 1;
                                  $qryfetchdata = $qry['transaction'];
                                  $txfetchdata = explode(" => ", $qryfetchdata);
                                  $txfetch = array_reverse($txfetchdata);                                    
                                ?>
                                <thead>
                                  <tr class="solid-header">
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
                                    if (!empty($qryfetchdata)) {
                                      if (count($txfetch) > 15) {$ycount = 15;}
                                      else{$ycount = count($txfetch);}
                                      for ($x=0; $x < $ycount; $x++) { ?>
                                      <?php $exp_data = explode("--", $txfetch[$x]); ?>
                                      <tr>
                                        <td><?php echo $count++; ?></td>  
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
                                    else{
                                      echo "";
                                    }
                                  ?>
                                </tbody>
                              </table>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
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

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="assets/vendor/libs/jquery/jquery.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.5/datatables.min.js"></script>

    <script src="assets/vendor/libs/popper/popper.js"></script>
    <script src="assets/vendor/js/bootstrap.js"></script>
    <script src="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="assets/vendor/libs/apex-charts/apexcharts.js"></script>

    <!-- Main JS -->
    <script src="assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="assets/js/dashboards-analytics.js"></script>

    <script type="text/javascript">
      $(document).ready(function() {
          $('#user_tbl').DataTable();
      } );
    </script>
  </body>
</html>
