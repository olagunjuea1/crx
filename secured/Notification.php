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
                  <div class="card card-fill timeline">
                    <div class="card-header">
                      <strong class="card-title">Notification</strong>
                    </div>        
                    <div class="card-body">
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
                                <div><span class="badge badge-light"><?php echo time_elapsed_string(strtotime(str_replace(",", "", $exp_data[3]))); ; ?></span></div>
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
                    </div> <!-- / .card-body -->
                  </div> <!-- / .card -->
                </div> <!-- .col-12 -->
            </div>
        </div> 
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