<?php 
  include 'includes/__function.php';
  include 'includes/__gen_func.php';
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

    <title>Manage User - Admin</title>

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

          <nav
            class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
            id="layout-navbar"
          >
            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
              <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="bx bx-menu bx-sm"></i>
              </a>
            </div>

            <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
              <!-- Search -->
              <div class="navbar-nav align-items-center">
                <div class="nav-item d-flex align-items-center">
                  <i class="bx bx-search fs-4 lh-0"></i>
                  <input
                    type="text"
                    class="form-control border-0 shadow-none"
                    placeholder="Search..."
                    aria-label="Search..."
                  />
                </div>
              </div>
              <!-- /Search -->

              <ul class="navbar-nav flex-row align-items-center ms-auto">
                <!-- Place this tag where you want the button to render. -->
                <li class="nav-item lh-1 me-3">
                  <a
                    class="github-button"
                    href="https://github.com/themeselection/sneat-html-admin-template-free"
                    data-icon="octicon-star"
                    data-size="large"
                    data-show-count="true"
                    aria-label="Star themeselection/sneat-html-admin-template-free on GitHub"
                    >Star</a
                  >
                </li>

                <!-- User -->
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                  <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                      <img src="assets/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" />
                    </div>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                      <a class="dropdown-item" href="#">
                        <div class="d-flex">
                          <div class="flex-shrink-0 me-3">
                            <div class="avatar avatar-online">
                              <img src="assets/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" />
                            </div>
                          </div>
                          <div class="flex-grow-1">
                            <span class="fw-semibold d-block">John Doe</span>
                            <small class="text-muted">Admin</small>
                          </div>
                        </div>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="#">
                        <i class="bx bx-user me-2"></i>
                        <span class="align-middle">My Profile</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="#">
                        <i class="bx bx-cog me-2"></i>
                        <span class="align-middle">Settings</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="#">
                        <span class="d-flex align-items-center align-middle">
                          <i class="flex-shrink-0 bx bx-credit-card me-2"></i>
                          <span class="flex-grow-1 align-middle">Billing</span>
                          <span class="flex-shrink-0 badge badge-center rounded-pill bg-danger w-px-20 h-px-20">4</span>
                        </span>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="auth-login-basic.html">
                        <i class="bx bx-power-off me-2"></i>
                        <span class="align-middle">Log Out</span>
                      </a>
                    </li>
                  </ul>
                </li>
                <!--/ User -->
              </ul>
            </div>
          </nav>

          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Restricted transaction</span></h4>

              <!-- Bootstrap Table with Header - Footer -->
              <div class="card">
                <h5 class="card-header">Users</h5>
                <div class="table-responsive text-nowrap">
                  <div class="card-body">
                    <table class="table" id="user_tbl">
                      <thead>
                        <tr>
                          <th>S/N</th>
                          <th>User ID</th>
                          <th>transaction ID</th>
                          <th>transaction Type</th>
                          <th>transaction Data</th>
                          <th>Amount</th>
                          <th>Status</th>
                          <th>OTP</th>
                          <th>Date</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <div class="col-md-6" id="message_admin">
                        <?php 
                          if (isset($_POST['tnxfailed_hold'])) {
                            $data_hold = array($_POST['user_id_admin'], $_POST['user_tnx_id_admin_hold']);
                            echo failedtnx_hold($conn, $data_hold, $mail);
                          }
                          if (isset($_POST['tnxsuccess_hold'])) {
                            $data_hold = array($_POST['user_id_admin'], $_POST['user_tnx_id_admin_hold']);
                            echo successtnx_hold($conn, $data_hold, $mail);
                          }
                        ?>
                      </div>
                      <tbody>
                        <?php   
                          $qry = mysqli_query($conn, "SELECT * FROM `locked_tnx` WHERE `status` = 'locked' ORDER by `id` DESC");
                          $count = 1;
                          while ($row = mysqli_fetch_array($qry)) { ?>
                            <tr>
                              <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong><?php   echo $count++; ?></strong></td>
                              <td><?php echo $row['userid'] ?></td>
                              <td><?php echo $row['tnx_id']; ?></td>
                              <td><?php echo ucfirst($row['tnx_type']); ?></td>
                              <td>
                                <?php 
                                  $expy = explode(",", $row['tnx_data']);
                                ?>
                                <div>BSB: <?php echo $expy[0]; ?></div>
                                <div>Account Number: <?php echo $expy[1]; ?></div>
                              </td>
                              <td><?php echo "A&#36;".number_format($row['amount'], 2); ?></td>
                              <td>
                                <?php 
                                  if ($row['status'] == 'success') {
                                    $row_btn = 'success';
                                    $email_message = 'Successful';
                                  }
                                  elseif ($row['status'] == 'pending') {
                                    $row_btn = 'warning';
                                    $email_message = 'Pending';
                                  }
                                  elseif ($row['status'] == 'failed') {
                                    $row_btn = 'danger';
                                    $email_message = 'Failed';
                                  }
                                  elseif ($row['status'] == 'cancel') {
                                    $row_btn = 'dark';
                                    $email_message = 'Canceled';
                                  }
                                  else{
                                    $row_btn = 'primary';
                                    $email_message = 'N/A';
                                  }
                                ?>
                                <span class="badge bg-label-<?php echo $row_btn; ?> me-1"><?php echo $email_message; ?></span>
                              </td>
                              <td><?php echo $row['otp']; ?></td>
                              <td><?php echo $row['trn_date']; ?></td>
                              <td>
                                <div class="dropdown">
                                  <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                  </button>
                                  <div class="dropdown-menu">
                                    <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>">
                                      <input type="hidden" name="user_id_admin" value="<?php echo $row['userid']; ?>">
                                      <input type="hidden" name="user_tnx_id_admin_hold" value="<?php echo $row['tnx_id']; ?>">
                                      <button type="submit" name="tnxfailed_hold" class="btn_action dropdown-item"><i class='bx bx-error me-1' ></i> Failed</button>
                                      <button type="submit" name="tnxsuccess_hold" class="btn_action dropdown-item"><i class="bx bx-check-circle me-1"></i> Successful</button>
                                    </form>                                    
                                  </div>
                                </div>
                              </td>
                            </tr>
                          <?php }
                        ?>
                        
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <!-- Bootstrap Table with Header - Footer -->

              <hr class="my-5" />
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

    <!-- Main JS -->
    <script src="assets/js/main.js"></script>
    <script type="text/javascript">
      setTimeout(function () {
        $("#message_admin").hide(1000);
      }, 6000)
    </script>

    <script type="text/javascript">
      $(document).ready(function() {
          $('#user_tbl').DataTable();
      } );
    </script>
  </body>
</html>
