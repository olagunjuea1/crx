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
              <div class="row align-items-center justify-content-between flex-wrap-reverse">                
                <div class="col-md-6 py-5 wow fadeInLeft">
                  <div class="card-deck">
                    <div class="card shadow mb-4">
                      <div class="card-header">
                        <strong class="card-title">International Transfer</strong>
                      </div>
                      <div class="card-body">
                        <form>
                          <div class="form-group">
                            <label for="inputEmail4">Routing Number</label>
                            <input type="email" class="form-control" id="inputEmail4" placeholder="Email">
                          </div>
                          <div class="form-group">
                            <label for="inputPassword4">Account Number</label>
                            <input type="password" class="form-control" id="inputPassword4" placeholder="Password">
                          </div>
                          <div class="form-group">
                            <label for="inputAddress">Amount</label>
                            <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
                          </div>
                          <button type="submit" class="btn btn-primary">Submit</button>
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
                <div class="col-md-6">
                  <div class="card shadow mb-4">
                    <div class="card-header">
                      <strong>Top Transaction</strong>
                    </div>
                    <div class="card-body px-4">
                      <div class="row border-bottom">
                        <div class="col-4 text-center mb-3">
                          <p class="mb-1 small text-muted">Total Balance</p>
                          <span class="h3">26</span><br />
                          <span class="small text-muted">+20%</span>
                          <span class="fe fe-arrow-up text-success fe-12"></span>
                        </div>
                        <div class="col-4 text-center mb-3">
                          <p class="mb-1 small text-muted">Total Debit</p>
                          <span class="h3">$260</span><br />
                          <span class="small text-muted">+6%</span>
                          <span class="fe fe-arrow-up text-success fe-12"></span>
                        </div>
                        <div class="col-4 text-center mb-3">
                          <p class="mb-1 small text-muted">Total Cedit</p>
                          <span class="h3">6%</span><br />
                          <span class="small text-muted">-2%</span>
                          <span class="fe fe-arrow-down text-danger fe-12"></span>
                        </div>
                      </div>
                      <table class="table table-borderless mt-3 mb-1 mx-n1 table-sm">
                        <thead>
                          <tr>
                            <th class="w-50">Goal</th>
                            <th class="text-right">Conversion</th>
                            <th class="text-right">Completions</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>Checkout</td>
                            <td class="text-right">5%</td>
                            <td class="text-right">260</td>
                          </tr>
                          <tr>
                            <td>Add to Cart</td>
                            <td class="text-right">55%</td>
                            <td class="text-right">1260</td>
                          </tr>
                          <tr>
                            <td>Contact</td>
                            <td class="text-right">18%</td>
                            <td class="text-right">460</td>
                          </tr>
                        </tbody>
                      </table>
                    </div> <!-- .card-body -->
                  </div> <!-- .card -->
                </div> <!-- .col -->
                <div class="col-md-6">
                  <div class="card shadow mb-4">
                    <div class="card-header">
                      <strong class="card-title">Recent Transaction</strong>
                      <a class="float-right small text-muted" href="#!">View all</a>
                    </div>
                    <div class="card-body">
                      <div class="list-group list-group-flush my-n3">
                        <div class="list-group-item">
                          <div class="row align-items-center">
                            <div class="col-3 col-md-2">
                              <img src="./assets/products/p1.jpg" alt="..." class="thumbnail-sm">
                            </div>
                            <div class="col">
                              <strong>Fusion Backpack</strong>
                              <div class="my-0 text-muted small">Gear, Bags</div>
                            </div>
                            <div class="col-auto">
                              <strong>+85%</strong>
                              <div class="progress mt-2" style="height: 4px;">
                                <div class="progress-bar" role="progressbar" style="width: 85%" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="list-group-item">
                          <div class="row align-items-center">
                            <div class="col-3 col-md-2">
                              <img src="./assets/products/p2.jpg" alt="..." class="thumbnail-sm">
                            </div>
                            <div class="col">
                              <strong>Luma hoodies</strong>
                              <div class="my-0 text-muted small">Jackets, Men</div>
                            </div>
                            <div class="col-auto">
                              <strong>+75%</strong>
                              <div class="progress mt-2" style="height: 4px;">
                                <div class="progress-bar" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="list-group-item">
                          <div class="row align-items-center">
                            <div class="col-3 col-md-2">
                              <img src="./assets/products/p3.jpg" alt="..." class="thumbnail-sm">
                            </div>
                            <div class="col">
                              <strong>Luma shorts</strong>
                              <div class="my-0 text-muted small">Shorts, Men</div>
                            </div>
                            <div class="col-auto">
                              <strong>+62%</strong>
                              <div class="progress mt-2" style="height: 4px;">
                                <div class="progress-bar" role="progressbar" style="width: 62%" aria-valuenow="62" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="list-group-item">
                          <div class="row align-items-center">
                            <div class="col-3 col-md-2">
                              <img src="./assets/products/p4.jpg" alt="..." class="thumbnail-sm">
                            </div>
                            <div class="col">
                              <strong>Brown Trousers</strong>
                              <div class="my-0 text-muted small">Trousers, Women</div>
                            </div>
                            <div class="col-auto">
                              <strong>+24%</strong>
                              <div class="progress mt-2" style="height: 4px;">
                                <div class="progress-bar" role="progressbar" style="width: 24%" aria-valuenow="24" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div> <!-- / .list-group -->
                    </div> <!-- / .card-body -->
                  </div> <!-- .card -->
                </div> <!-- .col -->
              </div> <!-- .row -->

            </div>
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
    <script src="js/bootstrap.min.js"></script>
    <script src="js/simplebar.min.js"></script>
    <script src="js/tinycolor-min.js"></script>
    <script src="js/config.js"></script>
    <script src="js/apexcharts.min.js"></script>
    <script src="js/apexcharts.custom.js"></script>
    <script src="js/apps.js"></script>
  </body>
</html>