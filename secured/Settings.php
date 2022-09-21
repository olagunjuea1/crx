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
      <?php 
        $qry = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM `settings` WHERE userid = '$userid'"));
        $fetchval = explode(",", $qry['val']);
        $encodeval = json_encode($fetchval);
      ?>
      <main role="main" class="main-content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-10 col-xl-8">
                  <h2 class="h3 mb-4 page-title">Settings</h2>
                  <div class="my-4">
                    <h5 class="mb-0 mt-5">Account</h5>
                    <p>These settings helps you keep up to date with your account.</p>
                    <div class="list-group mb-5 shadow">
                      <div class="list-group-item">
                        <div class="row align-items-center">
                          <div class="col">
                            <strong class="mb-2">Email me about Account security</strong>
                            <p class="text-muted mb-0">Donec id elit non mi porta gravida at eget metus.</p>
                          </div> <!-- .col -->
                          <div class="col-auto">
                            <div class="custom-control custom-switch">
                              <input type="checkbox" class="custom-control-input" id="activityLog0">
                              <span class="custom-control-label input_checkbox"></span>
                            </div>
                          </div> <!-- .col -->
                        </div> <!-- .row -->
                      </div> <!-- .list-group-item -->
                      <div class="list-group-item">
                        <div class="row align-items-center">
                          <div class="col">
                            <strong class="mb-2">Send me customized newsletter</strong>
                            <p class="text-muted mb-0">Donec id elit non mi porta gravida at eget metus.</p>
                          </div> <!-- .col -->
                          <div class="col-auto">
                            <div class="custom-control custom-switch">
                              <input type="checkbox" class="custom-control-input" id="activityLog1">
                              <span class="custom-control-label input_checkbox"></span>
                            </div>
                          </div> <!-- .col -->
                        </div> <!-- .row -->
                      </div> <!-- .list-group-item -->
                    </div> <!-- .list-group -->
                    <strong class="mb-0">Payment & Updates</strong>
                <p>Control security alert you will be notified.</p>
                <div class="list-group mb-5 shadow">
                  <div class="list-group-item">
                    <div class="row align-items-center">
                      <div class="col">
                        <strong class="mb-0">Email me account statement</strong>
                        <p class="text-muted mb-0">Donec in quam sed urna bibendum tincidunt quis mollis mauris.</p>
                      </div> <!-- .col -->
                      <div class="col-auto">
                        <div class="custom-control custom-switch">
                          <input type="checkbox" class="custom-control-input" id="activityLog2">
                          <span class="custom-control-label input_checkbox"></span>
                        </div>
                      </div> <!-- .col -->
                    </div> <!-- .row -->
                  </div> <!-- .list-group-item -->
                  <div class="list-group-item">
                    <div class="row align-items-center">
                      <div class="col">
                        <strong class="mb-0">Notify me about new features and updates</strong>
                        <p class="text-muted mb-0">Fusce lacinia elementum eros, sed vulputate urna eleifend nec.</p>
                      </div> <!-- .col -->
                      <div class="col-auto">
                        <div class="custom-control custom-switch">
                          <input type="checkbox" class="custom-control-input" id="activityLog3">
                          <span class="custom-control-label input_checkbox"></span>
                        </div>
                      </div> <!-- .col -->
                    </div> <!-- .row -->
                  </div> <!-- .list-group-item -->
                </div> <!-- .list-group -->
                <hr class="my-4">
                <strong class="mb-0">Transaction Summary</strong>
                <p>Please enable system alert you will get.</p>
                <div class="list-group mb-5 shadow">
                  <div class="list-group-item">
                    <div class="row align-items-center">
                      <div class="col">
                        <strong class="mb-0">Monthly account Transaction Summary</strong>
                        <p class="text-muted mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                      </div> <!-- .col -->
                      <div class="col-auto">
                        <div class="custom-control custom-switch">
                          <input type="checkbox" class="custom-control-input" id="activityLog4">
                          <span class="custom-control-label input_checkbox"></span>
                        </div>
                      </div> <!-- .col -->
                    </div> <!-- .row -->
                  </div> <!-- .list-group-item -->
                  <div class="list-group-item">
                    <div class="row align-items-center">
                      <div class="col">
                        <strong class="mb-0">Send me transaction Transaction Summary</strong>
                        <p class="text-muted mb-0">Nulla et tincidunt sapien. Sed eleifend volutpat elementum.</p>
                      </div> <!-- .col -->
                      <div class="col-auto">
                        <div class="custom-control custom-switch">
                          <input type="checkbox" class="custom-control-input" id="activityLog5">
                          <span class="custom-control-label input_checkbox"></span>
                        </div>
                      </div> <!-- .col -->
                    </div> <!-- .row -->
                  </div> <!-- .list-group-item -->
                  <div class="list-group-item">
                    <div class="row align-items-center">
                      <div class="col">
                        <strong class="mb-0">Send me promotional email</strong>
                        <p class="text-muted mb-0">Donec in quam sed urna bibendum tincidunt quis mollis mauris.</p>
                      </div> <!-- .col -->
                      <div class="col-auto">
                        <div class="custom-control custom-switch">
                          <input type="checkbox" class="custom-control-input" id="activityLog6">
                          <span class="custom-control-label input_checkbox"></span>
                        </div>
                      </div> <!-- .col -->
                    </div> <!-- .row -->
                  </div> <!-- .list-group-item -->
                </div>
                  </div> <!-- /.card-body -->
                </div> <!-- /.col-12 -->
              </div>
        </div> 
        <?php include 'layout/notification.php'; ?>
        <?php include 'inc/__chart.php'; ?>
      </main> <!-- main -->
    </div> <!-- .wrapper -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/simplebar.min.js"></script>
    <script src="js/tinycolor-min.js"></script>
    <script src="js/config.js"></script>
    <script type="text/javascript" src="script/settings.js"></script>
    <script src="js/apps.js"></script>
    <script type="text/javascript">
      for (var i = 0; i <= 6; i++) {
        var datasettings = <?php echo json_encode($fetchval);  ?>;
        var flexval = '#activityLog'+i;
        if (datasettings[i] == 'inactive') {
          var flexval = '#activityLog'+i;
          $(flexval).prop('checked', false);
        }
        else{
          $(flexval).prop('checked', true);
        }
    }  
    </script>
  </body>
</html>