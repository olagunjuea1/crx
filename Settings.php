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
                <div class="col-12 col-lg-10 col-xl-8">
                  <h2 class="h3 mb-4 page-title">Settings</h2>
                  <div class="my-4">
                    <h5 class="mb-0 mt-5">Security Settings</h5>
                    <p>These settings are helps you keep your account secure.</p>
                    <div class="list-group mb-5 shadow">
                      <div class="list-group-item">
                        <div class="row align-items-center">
                          <div class="col">
                            <strong class="mb-2">Enable Activity Logs</strong>
                            <p class="text-muted mb-0">Donec id elit non mi porta gravida at eget metus.</p>
                          </div> <!-- .col -->
                          <div class="col-auto">
                            <div class="custom-control custom-switch">
                              <input type="checkbox" class="custom-control-input" id="activityLog" checked>
                              <span class="custom-control-label"></span>
                            </div>
                          </div> <!-- .col -->
                        </div> <!-- .row -->
                      </div> <!-- .list-group-item -->
                      <div class="list-group-item">
                        <div class="row align-items-center">
                          <div class="col">
                            <strong class="mb-2">2FA Authentication</strong>
                            <span class="badge badge-pill badge-success">Enabled</span>
                            <p class="text-muted mb-0">Maecenas sed diam eget risus varius blandit.</p>
                          </div> <!-- .col -->
                          <div class="col-auto">
                            <button class="btn btn-primary btn-sm">Disable</button>
                          </div> <!-- .col -->
                        </div> <!-- .row -->
                      </div> <!-- .list-group-item -->
                      <div class="list-group-item">
                        <div class="row align-items-center">
                          <div class="col">
                            <strong class="mb-2">Activate Pin Code</strong>
                            <p class="text-muted mb-0">Donec id elit non mi porta gravida at eget metus.</p>
                          </div> <!-- .col -->
                          <div class="col-auto">
                            <div class="custom-control custom-switch">
                              <input type="checkbox" class="custom-control-input" id="pinCode">
                              <span class="custom-control-label"></span>
                            </div>
                          </div> <!-- .col -->
                        </div> <!-- .row -->
                      </div> <!-- .list-group-item -->
                    </div> <!-- .list-group -->
                    <strong class="mb-0">Security</strong>
                <p>Control security alert you will be notified.</p>
                <div class="list-group mb-5 shadow">
                  <div class="list-group-item">
                    <div class="row align-items-center">
                      <div class="col">
                        <strong class="mb-0">Unusual activity notifications</strong>
                        <p class="text-muted mb-0">Donec in quam sed urna bibendum tincidunt quis mollis mauris.</p>
                      </div> <!-- .col -->
                      <div class="col-auto">
                        <div class="custom-control custom-switch">
                          <input type="checkbox" class="custom-control-input" id="alert1" checked>
                          <span class="custom-control-label"></span>
                        </div>
                      </div> <!-- .col -->
                    </div> <!-- .row -->
                  </div> <!-- .list-group-item -->
                  <div class="list-group-item">
                    <div class="row align-items-center">
                      <div class="col">
                        <strong class="mb-0">Unauthorized financial activity</strong>
                        <p class="text-muted mb-0">Fusce lacinia elementum eros, sed vulputate urna eleifend nec.</p>
                      </div> <!-- .col -->
                      <div class="col-auto">
                        <div class="custom-control custom-switch">
                          <input type="checkbox" class="custom-control-input" id="alert2">
                          <span class="custom-control-label"></span>
                        </div>
                      </div> <!-- .col -->
                    </div> <!-- .row -->
                  </div> <!-- .list-group-item -->
                </div> <!-- .list-group -->
                <hr class="my-4">
                <strong class="mb-0">System</strong>
                <p>Please enable system alert you will get.</p>
                <div class="list-group mb-5 shadow">
                  <div class="list-group-item">
                    <div class="row align-items-center">
                      <div class="col">
                        <strong class="mb-0">Notify me about new features and updates</strong>
                        <p class="text-muted mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                      </div> <!-- .col -->
                      <div class="col-auto">
                        <div class="custom-control custom-switch">
                          <input type="checkbox" class="custom-control-input" id="alert3" checked>
                          <span class="custom-control-label"></span>
                        </div>
                      </div> <!-- .col -->
                    </div> <!-- .row -->
                  </div> <!-- .list-group-item -->
                  <div class="list-group-item">
                    <div class="row align-items-center">
                      <div class="col">
                        <strong class="mb-0">Notify me by email for latest news</strong>
                        <p class="text-muted mb-0">Nulla et tincidunt sapien. Sed eleifend volutpat elementum.</p>
                      </div> <!-- .col -->
                      <div class="col-auto">
                        <div class="custom-control custom-switch">
                          <input type="checkbox" class="custom-control-input" id="alert4" checked>
                          <span class="custom-control-label"></span>
                        </div>
                      </div> <!-- .col -->
                    </div> <!-- .row -->
                  </div> <!-- .list-group-item -->
                  <div class="list-group-item">
                    <div class="row align-items-center">
                      <div class="col">
                        <strong class="mb-0">Notify me about tips on using account</strong>
                        <p class="text-muted mb-0">Donec in quam sed urna bibendum tincidunt quis mollis mauris.</p>
                      </div> <!-- .col -->
                      <div class="col-auto">
                        <div class="custom-control custom-switch">
                          <input type="checkbox" class="custom-control-input" id="alert5">
                          <span class="custom-control-label"></span>
                        </div>
                      </div> <!-- .col -->
                    </div> <!-- .row -->
                  </div> <!-- .list-group-item -->
                </div>
                    <h5 class="mb-0">Recent Activity</h5>
                    <p>Last activities with your account.</p>
                    <table class="table border bg-white">
                      <thead>
                        <tr>
                          <th>Device</th>
                          <th>Location</th>
                          <th>IP</th>
                          <th>Time</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <th scope="col"><i class="fe fe-globe fe-12 text-muted mr-2"></i>Chrome - Windows 10</th>
                          <td>Paris, France</td>
                          <td>192.168.1.10</td>
                          <td>Apr 24, 2019</td>
                          <td><a hreff="#" class="text-muted"><i class="fe fe-x"></i></a></td>
                        </tr>
                        <tr>
                          <th scope="col"><i class="fe fe-smartphone fe-12 text-muted mr-2"></i>App - Mac OS</th>
                          <td>Newyork, USA</td>
                          <td>10.0.0.10</td>
                          <td>Apr 24, 2019</td>
                          <td><a hreff="#" class="text-muted"><i class="fe fe-x"></i></a></td>
                        </tr>
                        <tr>
                          <th scope="col"><i class="fe fe-globe fe-12 text-muted mr-2"></i>Chrome - iOS</th>
                          <td>London, UK</td>
                          <td>255.255.255.0</td>
                          <td>Apr 24, 2019</td>
                          <td><a hreff="#" class="text-muted"><i class="fe fe-x"></i></a></td>
                        </tr>
                      </tbody>
                    </table>
                  </div> <!-- /.card-body -->
                </div> <!-- /.col-12 -->
              </div>
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
    <script src="js/bootstrap.min.js"></script>
    <script src="js/simplebar.min.js"></script>
    <script src="js/tinycolor-min.js"></script>
    <script src="js/config.js"></script>
    <script src="js/apexcharts.min.js"></script>
    <script src="js/apexcharts.custom.js"></script>
    <script src="js/apps.js"></script>
  </body>
</html>