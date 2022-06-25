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
                  <h2 class="h5 page-title"><small class="text-muted text-uppercase">Invoice</small><br />#1806</h2>
                </div>
                <div class="col-auto">
                  <button type="button" class="btn btn-secondary">Print</button>
                  <button type="button" class="btn btn-primary">Pay</button>
                </div>
              </div>
              <div class="card shadow">
                <div class="card-body p-5">
                  <div class="row mb-5">
                    <div class="col-12 text-center mb-4">
                      <img src="./assets/images/logo.svg" class="navbar-brand-img brand-sm mx-auto mb-4" alt="...">
                      <h2 class="mb-0 text-uppercase">Invoice</h2>
                      <p class="text-muted"> Altavista<br /> 9022 Suspendisse Rd. </p>
                    </div>
                    <div class="col-md-7">
                      <p class="small text-muted text-uppercase mb-2">Invoice from</p>
                      <p class="mb-4">
                        <strong>Imani Lara</strong><br /> Asset Management<br /> 9022 Suspendisse Rd.<br /> High Wycombe<br /> (478) 446-9234<br />
                      </p>
                      <p>
                        <span class="small text-muted text-uppercase">Invoice #</span><br />
                        <strong>1806</strong>
                      </p>
                    </div>
                    <div class="col-md-5">
                      <p class="small text-muted text-uppercase mb-2">Invoice to</p>
                      <p class="mb-4">
                        <strong>Walter Sawyer</strong><br /> Human Resources<br /> Ap #992-8933 Sagittis Street<br /> Ivanteyevka<br /> (803) 792-2559<br />
                      </p>
                      <p>
                        <small class="small text-muted text-uppercase">Due date</small><br />
                        <strong>April, 20, 2020</strong>
                      </p>
                    </div>
                  </div> <!-- /.row -->
                  <table class="table table-borderless table-striped">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Description</th>
                        <th scope="col" class="text-right">Rate</th>
                        <th scope="col" class="text-right">Hours</th>
                        <th scope="col" class="text-right">Ammout</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th scope="row">1</th>
                        <td> Creative Design<br />
                          <span class="small text-muted">Design responsive website with existing prototype</span>
                        </td>
                        <td class="text-right">$15.00</td>
                        <td class="text-right">2</td>
                        <td class="text-right">$30.00</td>
                      </tr>
                      <tr>
                        <th scope="row">2</th>
                        <td> Front-End Development<br />
                          <span class="small text-muted">Markup conversion and adding JavaScript</span>
                        </td>
                        <td class="text-right">$20.00</td>
                        <td class="text-right">5</td>
                        <td class="text-right">$100.00</td>
                      </tr>
                      <tr>
                        <th scope="row">2</th>
                        <td> Back-End Development<br />
                          <span class="small text-muted">Database intergration with model functions</span>
                        </td>
                        <td class="text-right">$25.00</td>
                        <td class="text-right">7</td>
                        <td class="text-right">$155.00</td>
                      </tr>
                    </tbody>
                  </table>
                  <div class="row mt-5">
                    <div class="col-2 text-center">
                      <img src="./assets/images/qrcode.svg" class="navbar-brand-img brand-sm mx-auto my-4" alt="...">
                    </div>
                    <div class="col-md-5">
                      <p class="text-muted small">
                        <strong>Note :</strong> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam hendrerit nisi sed sollicitudin pellentesque. Nunc posuere purus rhoncus pulvinar aliquam. </p>
                    </div>
                    <div class="col-md-5">
                      <div class="text-right mr-2">
                        <p class="mb-2 h6">
                          <span class="text-muted">Subtotal : </span>
                          <strong>$285.00</strong>
                        </p>
                        <p class="mb-2 h6">
                          <span class="text-muted">VAT (10%) : </span>
                          <strong>$28.50</strong>
                        </p>
                        <p class="mb-2 h6">
                          <span class="text-muted">Total : </span>
                          <span>$313.50</span>
                        </p>
                      </div>
                    </div>
                  </div> <!-- /.row -->
                </div> <!-- /.card-body -->
              </div> <!-- /.card -->
            </div> <!-- /.col-12 -->
          </div> <!-- .row -->
        </div> <!-- .container-fluid -->
        <div class="modal fade modal-notif modal-slide" tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="defaultModalLabel">Notifications</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="list-group list-group-flush my-n3">
                  <div class="list-group-item bg-transparent">
                    <div class="row align-items-center">
                      <div class="col-auto">
                        <span class="fe fe-box fe-24"></span>
                      </div>
                      <div class="col">
                        <small><strong>Package has uploaded successfull</strong></small>
                        <div class="my-0 text-muted small">Package is zipped and uploaded</div>
                        <small class="badge badge-pill badge-light text-muted">1m ago</small>
                      </div>
                    </div>
                  </div>
                  <div class="list-group-item bg-transparent">
                    <div class="row align-items-center">
                      <div class="col-auto">
                        <span class="fe fe-download fe-24"></span>
                      </div>
                      <div class="col">
                        <small><strong>Widgets are updated successfull</strong></small>
                        <div class="my-0 text-muted small">Just create new layout Index, form, table</div>
                        <small class="badge badge-pill badge-light text-muted">2m ago</small>
                      </div>
                    </div>
                  </div>
                  <div class="list-group-item bg-transparent">
                    <div class="row align-items-center">
                      <div class="col-auto">
                        <span class="fe fe-inbox fe-24"></span>
                      </div>
                      <div class="col">
                        <small><strong>Notifications have been sent</strong></small>
                        <div class="my-0 text-muted small">Fusce dapibus, tellus ac cursus commodo</div>
                        <small class="badge badge-pill badge-light text-muted">30m ago</small>
                      </div>
                    </div> <!-- / .row -->
                  </div>
                  <div class="list-group-item bg-transparent">
                    <div class="row align-items-center">
                      <div class="col-auto">
                        <span class="fe fe-link fe-24"></span>
                      </div>
                      <div class="col">
                        <small><strong>Link was attached to menu</strong></small>
                        <div class="my-0 text-muted small">New layout has been attached to the menu</div>
                        <small class="badge badge-pill badge-light text-muted">1h ago</small>
                      </div>
                    </div>
                  </div> <!-- / .row -->
                </div> <!-- / .list-group -->
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-block" data-dismiss="modal">Clear All</button>
              </div>
            </div>
          </div>
        </div>
        <div class="modal fade modal-shortcut modal-slide" tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="defaultModalLabel">Shortcuts</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body px-5">
                <div class="row align-items-center">
                  <div class="col-6 text-center">
                    <div class="squircle bg-success justify-content-center">
                      <i class="fe fe-cpu fe-32 align-self-center text-white"></i>
                    </div>
                    <p>Control area</p>
                  </div>
                  <div class="col-6 text-center">
                    <div class="squircle bg-primary justify-content-center">
                      <i class="fe fe-activity fe-32 align-self-center text-white"></i>
                    </div>
                    <p>Activity</p>
                  </div>
                </div>
                <div class="row align-items-center">
                  <div class="col-6 text-center">
                    <div class="squircle bg-primary justify-content-center">
                      <i class="fe fe-droplet fe-32 align-self-center text-white"></i>
                    </div>
                    <p>Droplet</p>
                  </div>
                  <div class="col-6 text-center">
                    <div class="squircle bg-primary justify-content-center">
                      <i class="fe fe-upload-cloud fe-32 align-self-center text-white"></i>
                    </div>
                    <p>Upload</p>
                  </div>
                </div>
                <div class="row align-items-center">
                  <div class="col-6 text-center">
                    <div class="squircle bg-primary justify-content-center">
                      <i class="fe fe-users fe-32 align-self-center text-white"></i>
                    </div>
                    <p>Users</p>
                  </div>
                  <div class="col-6 text-center">
                    <div class="squircle bg-primary justify-content-center">
                      <i class="fe fe-settings fe-32 align-self-center text-white"></i>
                    </div>
                    <p>Settings</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
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