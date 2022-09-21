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
    <title>Tiny Dashboard - A Bootstrap Dashboard Template</title>
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
  <body class="vertical  light  ">
    <div class="wrapper">
      <!-- nav bar -->
      <?php include"layout/navbar.php"; ?>
      <!-- nav bar -->
      <main role="main" class="main-content">
        <div class="container-fluid">
          <div class="row justify-content-center">
            <div class="col-12">
              <h2 class="h3 mb-4 page-title">Profile</h2>
              <div class="row mt-5 align-items-center">
                <div class="col-md-2 text-center mb-5">
                  <div class="avatar avatar-xl">
                    <img src="./assets/avatars/avatar.png" alt="Profile Picture" class="avatar-img rounded-circle">
                  </div>
                </div>
                <div class="col">
                  <div class="row align-items-center">
                    <div class="col-md-7">
                      <h4 class="mb-1"><span class="ex_firstname capitilizey"></span>, <span class="ex_lastname capitilizey"></span></h4>
                      <p class="small mb-3"><span class="badge badge-dark py-2">New York, USA</span></p>
                    </div>
                  </div>
                  <div class="row mb-4">
                    <div class="col-md-4 mt-3">
                      <div class="row align-items-center mb-2">
                        <div class="col">                            
                          <strong>Account Type:</strong>
                        </div>
                        <div class="col">
                          <div class="my-0 text-muted small"><?php echo strtolower(fetchdata($conn, 'clients', 'email', $userid, 'account_type')); ?></div>
                        </div>
                      </div>

                      <div class="row align-items-center mb-2">
                        <div class="col">                            
                          <strong>Account Number:</strong>
                        </div>
                        <div class="col">
                          <div class="my-0 text-muted small"><?php echo strtolower(fetchdata($conn, 'clients', 'email', $userid, 'account_number')); ?></div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4 mt-3">
                      <div class="row align-items-center mb-2">
                        <div class="col">                            
                          <strong>Email:</strong>
                        </div>
                        <div class="col">
                          <div class="my-0 text-muted small"><?php echo strtolower(fetchdata($conn, 'clients', 'email', $userid, 'email')); ?></div>
                        </div>
                      </div>

                      <div class="row align-items-center mb-2">
                        <div class="col">                            
                          <strong>Mobile:</strong>
                        </div>
                        <div class="col">
                          <div class="my-0 text-muted small"><?php echo strtolower(fetchdata($conn, 'clients', 'email', $userid, 'mobile')); ?></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row my-4">
                <div class="col-md-6">
                  <div class="card mb-4 shadow">
                    <div class="card-body my-n3">
                      <div class="row align-items-center">
                        <div class="col-3 text-center">
                          <span class="circle circle-lg bg-light">
                            <i class="fe fe-shield fe-24 text-primary"></i>
                          </span>
                        </div> <!-- .col -->
                        <div class="col">
                          <a href="Settings.php">
                            <h3 class="h5 mt-4 mb-1">Security</h3>
                          </a>
                          <p class="text-muted">Manage and modify your account settings to keep your account updated.</p>
                        </div> <!-- .col -->
                      </div> <!-- .row -->
                    </div> <!-- .card-body -->
                    <div class="card-footer">
                      <a href="Settings.php" class="d-flex justify-content-between text-muted"><span>Settings</span><i class="fe fe-chevron-right"></i></a>
                    </div> <!-- .card-footer -->
                  </div> <!-- .card -->
                </div>
                <div class="col-md-6">
                  <div class="card mb-4 shadow">
                    <div class="card-body my-n3">
                      <div class="row align-items-center">
                        <div class="col-3 text-center">
                          <span class="circle circle-lg bg-light">
                            <i class="fe fe-bell fe-24 text-primary"></i>
                          </span>
                        </div> <!-- .col -->
                        <div class="col">
                          <a href="Notification.php">
                            <h3 class="h5 mt-4 mb-1">Notifications</h3>
                          </a>
                          <p class="text-muted">To learn about the most recent action on your account, check your account notice.</p>
                        </div> <!-- .col -->
                      </div> <!-- .row -->
                    </div> <!-- .card-body -->
                    <div class="card-footer">
                      <a href="Notification.php" class="d-flex justify-content-between text-muted"><span>Notification Settings</span><i class="fe fe-chevron-right"></i></a>
                    </div> <!-- .card-footer -->
                  </div> <!-- .card -->
                </div>
              </div> 
              <h6 class="mb-5">Recent Transaction</h6>
              <table class="table table-hover table-borderless table-striped mt-n3 mb-n1">
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
                        if (count($total_data) > 5) {$ycount = 5;}
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
            </div> <!-- /.col-12 -->
          </div> <!-- .row -->
        </div> 
         <?php include 'layout/notification.php'; ?>
      </main> <!-- main -->
    </div> <!-- .wrapper -->
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/moment.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/simplebar.min.js"></script>
    <script src='js/daterangepicker.js'></script>
    <script src='js/jquery.stickOnScroll.js'></script>
    <script src="js/tinycolor-min.js"></script>
    <script src="js/config.js"></script>
    <script src="js/apps.js"></script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-56159088-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];

      function gtag()
      {
        dataLayer.push(arguments);
      }
      gtag('js', new Date());
      gtag('config', 'UA-56159088-1');
    </script>
  </body>
</html>