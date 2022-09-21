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

          <?php include 'layout/nav.php'; ?>

          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Manage User</h4>

              <!-- Bootstrap Table with Header - Footer -->
              <div class="card">
                <h5 class="card-header">Users</h5>
                <div class="table-responsive text-nowrap">
                  <div class="card-body">
                    <table class="table" id="user_tbl">
                      <thead>
                        <tr>
                          <th>S/N</th>
                          <th>Full Name</th>
                          <th>Account Number</th>
                          <th>Transfer Lock</th>
                          <th>Account Type</th>
                          <th>DOB</th>
                          <th>Email</th>
                          <th>Email Verified</th>
                          <th>Address</th>
                          <th>Mobile</th>
                          <th>Account Status</th>
                          <th>Date Joined</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <div class="col-md-6" id="message_admin">
                        <?php 
                          if (isset($_POST['delete'])) {
                            $data = array($_POST['user_id_admin']);
                            echo delete($conn, $data);
                          }
                          if (isset($_POST['deactivate'])) {
                            $data = array($_POST['user_id_admin']);
                            echo deactivate($conn, $data);
                          }
                          if (isset($_POST['active'])) {
                            $data = array($_POST['user_id_admin']);
                            echo active($conn, $data);
                          }
                          if (isset($_POST['transfer_lock'])) {
                            $data = array($_POST['user_id_admin']);
                            echo tnxlock($conn, $data);
                          }
                        ?>
                      </div>
                      <tbody>
                        <?php   
                          $qry = mysqli_query($conn, "SELECT * FROM `clients`");
                          $count = 1;
                          while ($row = mysqli_fetch_array($qry)) { ?>
                            <tr>
                              <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong><?php   echo $count++; ?></strong></td>
                              <td><?php echo ucfirst($row['firstname'])." ".ucfirst($row['lastname']); ?></td>
                              <td><?php echo $row['account_number']; ?></td>
                              <td>
                                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
                                  <div class="form-check form-switch">
                                    <?php 
                                      if ($row['tnx_lock'] == 'on') {
                                        $row_btn_tnx = 'success';
                                        $btn_tnx_lock_status = 'ON';
                                      }
                                      else{
                                        $row_btn_tnx = 'warning';
                                        $btn_tnx_lock_status = 'OFF';
                                      }
                                    ?>
                                    <span class="badge bg-label-<?php echo $row_btn_tnx; ?> me-1"><?php echo $btn_tnx_lock_status; ?></span>
                                  </div>
                                </form>
                              </td>
                              <td><?php echo $row['account_type']; ?></td>
                              <td><?php echo $row['dob']; ?></td>
                              <td><?php echo $row['email']; ?></td>
                              <td>
                                <?php 
                                  if ($row['email_verified'] == 'Y') {
                                    $row_btn = 'success';
                                    $email_message = 'Verified';
                                  }
                                  elseif ($row['email_verified'] == 'N') {
                                    $row_btn = 'danger';
                                    $email_message = 'Un-verified';
                                  }
                                  else{
                                    $row_btn = 'primary';
                                    $email_message = 'N/A';
                                  }
                                ?>
                                <span class="badge bg-label-<?php echo $row_btn; ?> me-1"><?php echo $email_message; ?></span>
                              </td>
                              <td><?php echo $row['address']; ?></td>
                              <td><?php echo $row['mobile']; ?></td>
                              <td>
                                <?php 
                                  if ($row['account_state'] == 'active') {
                                    $btn_acct_status = 'success';
                                    $acct_message = 'Active';
                                  }
                                  elseif ($row['account_state'] == 'deactivated') {
                                    $btn_acct_status = 'warning';
                                    $acct_message = 'Deactivated';
                                  }
                                  elseif ($row['account_state'] == 'deleted') {
                                    $btn_acct_status = 'danger';
                                    $acct_message = 'Deleted';
                                  }
                                  else{
                                    $btn_acct_status = 'primary';
                                    $acct_message = 'N/A';
                                  }
                                ?>
                                <span class="badge bg-label-<?php echo $btn_acct_status; ?> me-1"><?php echo $acct_message; ?></span>
                              </td>
                              <td><?php echo $row['trn_date']; ?></td>
                              <td>
                                <div class="dropdown">
                                  <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                  </button>
                                  <div class="dropdown-menu">
                                    <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>">
                                      <input type="hidden" name="user_id_admin" value="<?php echo $row['email']; ?>">
                                      <button type="submit" name="deactivate" class="btn_action dropdown-item"><i class='bx bx-user-x me-1' ></i> Deactivate</button>
                                      <button type="submit" name="delete" class="btn_action dropdown-item"><i class="bx bx-trash me-1"></i> Delete</button>
                                      <button type="submit" name="active" class="btn_action dropdown-item"><i class="bx bx-user-plus me-1"></i> Activate</button>
                                      <button type="submit" name="transfer_lock" class="btn_action dropdown-item"><i class="bx bx-lock me-1"></i> TNX_LOCK</button>
                                    </form>
                                    <a href="user_transaction.php?tnxdata=<?php echo base64_encode(base64_encode($row['email'])) ?>" type="submit" name="tnxcancel" class="btn_action dropdown-item"><i class="bx bx-chart me-1"></i> Check transaction</a>
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
      }, 6000);
    </script>

    <script type="text/javascript">
      $(document).ready(function() {
          $('#user_tbl').DataTable();
      });
    </script>
  </body>
</html>
