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
              <div class="card shadow my-4">
                <div class="card-body">
                  <div class="row align-items-center my-4">
                    <div class="col-md-4">
                      <div class="mx-4">
                        <strong class="mb-0 text-uppercase text-muted">Balance</strong><br />
                        <h3>$2,562.30</h3>
                      </div>
                      <div class="row align-items-center">
                        <div class="col-12">
                          <div class="p-4">
                            <p class="small text-uppercase text-muted mb-0">Available Balance</p>
                            <span class="h2 mb-0">$1.2K</span>
                            <p class="small mb-0">
                              <span class="fe fe-arrow-up text-success fe-12"></span>
                              <span class="text-muted ml-1">+1.5%</span>
                            </p>
                          </div>
                        </div>
                      </div>
                      <div class="row align-items-center">
                        <div class="col-6">
                          <div class="p-4">
                            <p class="small text-uppercase text-muted mb-0">Credit</p>
                            <span class="h2 mb-0">$7.2K</span>
                            <p class="small mb-0">
                              <span class="text-muted ml-1">+1.5%</span>
                            </p>
                          </div>
                        </div>
                        <div class="col-6">
                          <div class="p-4">
                            <p class="small text-uppercase text-muted mb-0">Debit</p>
                            <span class="h2 mb-0">$1.6K</span>
                            <p class="small mb-0">
                              <span class="fe fe-arrow-down text-danger fe-12"></span>
                              <span class="text-muted ml-1">-2.5%</span>
                            </p>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-8">
                      <div class="mr-4">
                        <div id="areaChart"></div>
                      </div>
                    </div> <!-- .col-md-8 -->
                  </div> <!-- end section -->
                </div> <!-- .card-body -->
              </div> <!-- .card -->
              <div class="row items-align-baseline">
                <div class="col-md-12 col-lg-4">
                  <div class="card shadow eq-card mb-4">
                    <div class="card-body mb-n3">
                      <div class="row align-items-center h-100">
                        <div class="col-md-6 my-3">
                          <p class="mb-0"><strong class="mb-0 text-uppercase text-muted">Balance</strong></p>
                          <h3>$2,562</h3>
                          <p class="small text-muted mb-0"><span>Check and manage your account balance</span></p>
                        </div>
                        <div class="col-md-6 my-4 text-center">
                          <div lass="chart-box mx-4">
                            <div id="radialbarWidget"></div>
                          </div>
                        </div>
                        <div class="col-md-6 border-top py-3">
                          <p class="mb-1"><strong class="text-muted">Credit</strong></p>
                          <h4 class="mb-0">$108</h4>
                          <p class="small text-muted mb-0"><span>37.7% Last week</span></p>
                        </div> <!-- .col -->
                        <div class="col-md-6 border-top py-3">
                          <p class="mb-1"><strong class="text-muted">Debit</strong></p>
                          <h4 class="mb-0">$1168</h4>
                          <p class="small text-muted mb-0"><span>-18.9% Last week</span></p>
                        </div> <!-- .col -->
                      </div>
                    </div> <!-- .card-body -->
                  </div> <!-- .card -->
                </div> <!-- .col -->
                <div class="col-md-12 col-lg-4">
                  <div class="card shadow eq-card mb-4">
                    <div class="card-body">
                      <div class="chart-widget mb-2">
                        <div id="radialbar"></div>
                      </div>
                      <div class="row items-align-center">
                        <div class="col-4 text-center">
                          <p class="text-muted mb-1">This Month</p>
                          <h6 class="mb-1">$1,823</h6>
                          <p class="text-muted mb-0">+12%</p>
                        </div>
                        <div class="col-4 text-center">
                          <p class="text-muted mb-1">Last Month</p>
                          <h6 class="mb-1">$6,830</h6>
                          <p class="text-muted mb-0">+8%</p>
                        </div>
                        <div class="col-4 text-center">
                          <p class="text-muted mb-1">Credit</p>
                          <h6 class="mb-1">$4,830</h6>
                          <p class="text-muted mb-0">+8%</p>
                        </div>
                      </div>
                    </div> <!-- .card-body -->
                  </div> <!-- .card -->
                </div> <!-- .col -->
                <div class="col-md-12 col-lg-4">
                  <div class="card shadow eq-card mb-4">
                    <div class="card-body">
                      <div class="d-flex mt-3 mb-4">
                        <div class="flex-fill pt-2">
                          <p class="mb-0 text-muted">Total Transaction</p>
                          <h4 class="mb-0">108</h4>
                          <span class="small text-muted">+37.7%</span>
                        </div>
                        <div class="flex-fill chart-box mt-n2">
                          <div id="barChartWidget"></div>
                        </div>
                      </div> <!-- .d-flex -->
                      <div class="row border-top">
                        <div class="col-md-6 pt-4">
                          <h6 class="mb-0">108 <span class="small text-muted">+37.7%</span></h6>
                          <p class="mb-0 text-muted">Total Debit</p>
                        </div>
                        <div class="col-md-6 pt-4">
                          <h6 class="mb-0">1168 <span class="small text-muted">-18.9%</span></h6>
                          <p class="mb-0 text-muted">Total Credit</p>
                        </div>
                      </div> <!-- .row -->
                    </div> <!-- .card-body -->
                  </div> <!-- .card -->
                </div> <!-- .col-md -->
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
              <div class="row">
                <!-- Recent orders -->
                <div class="col-md-8">
                  <div class="card shadow eq-card">
                    <div class="card-header">
                      <strong class="card-title">Transaction</strong>
                      <a class="float-right small text-muted" href="#!">View all</a>
                    </div>
                    <div class="card-body">
                      <table class="table table-hover table-borderless table-striped mt-n3 mb-n1">
                        <thead>
                          <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Company</th>
                            <th>Date</th>
                            <th>Status</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>3224</td>
                            <th scope="col">Keith Baird</th>
                            <td>Enim Limited<br /><span class="small text-muted">901-6206 Cras Av.</span></td>
                            <td>Apr 24, 2019</td>
                            <td><span class="dot dot-lg bg-warning mr-2"></span></td>
                          </tr>
                          <tr>
                            <td>3218</td>
                            <th scope="col">Graham Price</th>
                            <td>Nunc Lectus Incorporated<br /><span class="small text-muted">Ap #705-5389 Id St.</span></td>
                            <td>May 23, 2020</td>
                            <td><span class="dot dot-lg bg-success mr-2"></span></td>
                          </tr>
                          <tr>
                            <td>2651</td>
                            <th scope="col">Reuben Orr</th>
                            <td>Nisi Aenean Eget Limited<br />
                              <span class="small text-muted">7425 Malesuada Rd.</span></td>
                            <td>Nov 4, 2019</td>
                            <td><span class="dot dot-lg bg-warning mr-2"></span></td>
                          </tr>
                          <tr>
                            <td>2636</td>
                            <th scope="col">Akeem Holder</th>
                            <td>Pellentesque Associates<br />
                              <span class="small text-muted">896 Sodales St.</span></td>
                            <td>Mar 27, 2020</td>
                            <td><span class="dot dot-lg bg-danger mr-2"></span></td>
                          </tr>
                          <tr>
                            <td>2757</td>
                            <th scope="col">Beau Barrera</th>
                            <td>Augue Incorporated<br />
                              <span class="small text-muted">4583 Id St.</span></td>
                            <td>Jan 13, 2020</td>
                            <td><span class="dot dot-lg bg-success mr-2"></span></td>
                          </tr>
                        </tbody>
                      </table>
                    </div> <!-- .card-body -->
                  </div> <!-- .card -->
                </div> <!-- / .col-md-8 -->
                <!-- Recent Activity -->
                <div class="col-md-4">
                  <div class="card shadow eq-card timeline">
                    <div class="card-header">
                      <strong class="card-title">Recent Activity</strong>
                      <a class="float-right small text-muted" href="#!">View all</a>
                    </div>
                    <div class="card-body" data-simplebar style="height: 360px; overflow-y: auto; overflow-x: hidden;">
                      <div class="pb-3 timeline-item item-primary">
                        <div class="pl-5">
                          <div class="mb-1 small"><strong>@Brown Asher</strong><span class="text-muted mx-2">Just create new layout Index, form, table</span><strong>Tiny Admin</strong></div>
                          <p class="small text-muted">Creative Design <span class="badge badge-light">1h ago</span>
                          </p>
                        </div>
                      </div>
                      <div class="pb-3 timeline-item item-warning">
                        <div class="pl-5">
                          <div class="mb-3 small"><strong>@Fletcher Everett</strong><span class="text-muted mx-2">created new group for</span><strong>Tiny Admin</strong></div>
                          <ul class="avatars-list mb-2">
                            <li>
                              <a href="#!" class="avatar avatar-sm">
                                <img alt="..." class="avatar-img rounded-circle" src="./assets/avatars/face-1.jpg">
                              </a>
                            </li>
                            <li>
                              <a href="#!" class="avatar avatar-sm">
                                <img alt="..." class="avatar-img rounded-circle" src="./assets/avatars/face-4.jpg">
                              </a>
                            </li>
                            <li>
                              <a href="#!" class="avatar avatar-sm">
                                <img alt="..." class="avatar-img rounded-circle" src="./assets/avatars/face-3.jpg">
                              </a>
                            </li>
                          </ul>
                          <p class="small text-muted">Front-End Development <span class="badge badge-light">1h ago</span>
                          </p>
                        </div>
                      </div>
                      <div class="pb-3 timeline-item item-success">
                        <div class="pl-5">
                          <div class="mb-2 small"><strong>@Kelley Sonya</strong><span class="text-muted mx-2">has commented on</span><strong>Advanced table</strong></div>
                          <div class="card d-inline-flex mb-2">
                            <div class="card-body bg-light small py-2 px-3"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. </div>
                          </div>
                          <p class="small text-muted">Back-End Development <span class="badge badge-light">1h ago</span>
                          </p>
                        </div>
                      </div>
                    </div> <!-- / .card-body -->
                  </div> <!-- / .card -->
                </div> <!-- / .col-md-3 -->
              </div> <!-- end section -->
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