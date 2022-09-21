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
  </head>
  <body class="vertical  light  ">
    <div class="wrapper">
      <!-- nav bar -->
      <?php include"layout/navbar.php"; ?>
      <!-- nav bar -->
      <main role="main" class="main-content">
        <div class="container-fluid">
          <div class="row justify-content-center">
            <div class="col-12 col-lg-10 col-xl-8">
              <div class="row align-items-center mb-4">
                <div class="col">
                  <h2 class="h5 page-title"><small class="text-muted text-uppercase">Transaction Summary</small><br />#1806</h2>
                </div>
                <div class="col-auto">
                  <button type="button" class="btn btn-secondary">Download</button>
                </div>
              </div>
              <div class="card shadow">
                <div class="card-body p-5">
                  <div class="row mb-5">
                    <div class="col-12 mb-4">
                      <img src="./assets/images/logo.svg" class="navbar-brand-img brand-sm mx-auto mb-4" alt="...">
                      <h2 class="mb-0 text-uppercase">Transaction Receipt</h2>
                    </div>
                    <div class="col-md-6">
                      <p class="small text-muted text-uppercase mb-1">Transfer type</p>
                      <p class="mb-4">
                        <strong>Local Transfer</strong>
                      </p>
                      <p>
                        <span class="small text-muted text-uppercase">Transaction Status</span><br />
                        <strong>Pending</strong>
                      </p>
                      <p>
                        <span class="small text-muted text-uppercase">Transaction ID</span><br />
                        <strong>Pending</strong>
                      </p>
                    </div>
                    <div class="col-md-6">
                      <p class="small text-muted text-uppercase mb-1">Transaction Date</p>
                      <p class="mb-4">
                        <strong>25 Mar, 2022</strong>
                      </p>
                      <p>
                        <span class="small text-muted text-uppercase">Routing Number</span><br />
                        <strong>Pending</strong>
                      </p>
                      <p>
                        <span class="small text-muted text-uppercase">Account Number</span><br />
                        <strong>Pending</strong>
                      </p>
                    </div>
                  </div> <!-- /.row -->
                  <table class="table table-borderless table-striped">
                    <thead>
                      <tr>
                        <th scope="col">Tnx ID</th>
                        <th scope="col">Description</th>
                        <th scope="col" class="text-right">Ammout</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td> Creative Design<br />
                          <span class="small text-muted">Design responsive website with existing prototype</span>
                        </td>
                        <td class="text-right">$15.00</td>
                        <td class="text-right">$30.00</td>
                      </tr>
                    </tbody>
                  </table>
                  <div class="row mt-5">
                    <div class="col-md-12">
                      <p class="text-muted small">
                       Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam hendrerit nisi sed sollicitudin pellentesque. Nunc posuere purus rhoncus pulvinar aliquam. </p>
                    </div>
                  </div> <!-- /.row -->
                </div> <!-- /.card-body -->
              </div> <!-- /.card -->
            </div> <!-- /.col-12 -->
          </div> <!-- .row -->
        </div> <!-- .container-fluid -->
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