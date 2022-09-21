<nav class="topnav navbar navbar-light">
        <button type="button" class="navbar-toggler text-muted mt-2 p-0 mr-3 collapseSidebar">
          <i class="fe fe-menu navbar-toggler-icon"></i>
        </button>
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link text-muted my-2" href="#" id="modeSwitcher" data-mode="light">
              <i class="fe fe-sun fe-16"></i>
            </a>
          </li>
          <li class="nav-item nav-notif">
            <a class="nav-link text-muted my-2" href="./#" data-toggle="modal" data-target=".modal-notif">
              <span class="fe fe-bell fe-16"></span>
              <span class="dot dot-md bg-success"></span>
            </a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-muted pr-0" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <span class="avatar avatar-sm mt-2">
                <img src="./assets/avatars/avatar.png" alt="..." class="avatar-img rounded-circle">
              </span>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href="Profile.php">Profile</a>
              <a class="dropdown-item" href="Settings.php">Settings</a>
              <a class="dropdown-item" href="#">Sign Out</a>
            </div>
          </li>
        </ul>
      </nav>
      <aside class="sidebar-left border-right bg-white shadow" id="leftSidebar" data-simplebar>
        <a href="#" class="btn collapseSidebar toggle-btn d-lg-none text-muted ml-2 mt-3" data-toggle="toggle">
          <i class="fe fe-x"><span class="sr-only"></span></i>
        </a>
        <nav class="vertnav navbar navbar-light">
          <!-- nav bar -->
          <div class="w-100 mb-4 d-flex">
            <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="index.php">
              <img src="assets/images/logo.svg" width="25px">
            </a>
          </div>
          <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item w-100">
              <a class="nav-link" href="index.php">
                <i class="fe fe-home fe-16"></i>
                <span class="ml-3 item-text">Overview</span>
              </a>
            </li>
          </ul>
          <p class="text-muted nav-heading mt-4 mb-1">
            <span>Account</span>
          </p>
          <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item dropdown">
              <a class="nav-link" href="Transaction.php">
                <i class="fe fe-bar-chart-2 fe-16"></i>
                <span class="ml-3 item-text">Transaction</span>
              </a>
            </li>
            <li class="nav-item dropdown">
              <a href="#sendandreceive" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                <i class="fe fe-send fe-16"></i>
                <span class="ml-3 item-text">Send & Receive</span>
              </a>
              <ul class="collapse list-unstyled pl-4 w-100" id="sendandreceive">
                <li class="nav-item">
                  <a class="nav-link pl-3" href="Transfer.php"><span class="ml-1 item-text">Transfer</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link pl-3" href="International_transfer.php"><span class="ml-1 item-text">International Transfer</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link pl-3" href="Receive.php"><span class="ml-1 item-text">Receive</span></a>
                </li>
              </ul>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link" href="Request_Payment.php">
                <i class="fe fe-plus-square fe-16"></i>
                <span class="ml-3 item-text">Request Money</span>
              </a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link" href="Cards.php">
                <i class="fe fe-credit-card fe-16"></i>
                <span class="ml-3 item-text">Cards</span>
              </a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link" href="Analytics.php">
                <i class="fe fe-pie-chart fe-16"></i>
                <span class="ml-3 item-text">Account Analytics</span>
              </a>
            </li>
          </ul>
          <p class="text-muted nav-heading mt-4 mb-1">
            <span>User</span>
          </p>
          <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item w-100">
              <a class="nav-link" href="Profile.php">
                <i class="fe fe-user fe-16"></i>
                <span class="ml-3 item-text">Profile</span>
              </a>
            </li>
            <li class="nav-item w-100">
              <a class="nav-link" href="Notification.php">
                <i class="fe fe-bell fe-16"></i>
                <span class="ml-3 item-text">Notification</span>
              </a>
            </li>
            <li class="nav-item w-100">
              <a class="nav-link" href="Settings.php">
                <i class="fe fe-settings fe-16"></i>
                <span class="ml-3 item-text">Settings</span>
              </a>
            </li>
          </ul>
          <p class="text-muted nav-heading mt-4 mb-1">
            <span>Customer Service</span>
          </p>
          <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item w-100">
              <a class="nav-link" href="mailto:<?php echo fetchdataall($conn, 'site_data', 'customermail'); ?>">
                <i class="fe fe-mail fe-16"></i>
                <span class="ml-3 item-text">Mail Support</span>
              </a>
            </li>
            <li class="nav-item w-100">
              <a class="nav-link" href="#">
                <i class="fe fe-message-circle fe-16"></i>
                <span class="ml-3 item-text">Live Chat</span>
              </a>
            </li>
          </ul>
          <p class="text-muted nav-heading mt-4 mb-1">
            <span>Action</span>
          </p>
          <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item w-100">
              <a class="nav-link" href="../docs/index.php">
                <i class="fe fe-log-out fe-16"></i>
                <span class="ml-3 item-text">Sign Out</span>
              </a>
            </li>
          </ul>
          <div class="btn-box w-100 mt-4 mb-1">
            <a href="mailto:<?php echo fetchdataall($conn, 'site_data', 'customermail'); ?>" class="btn mb-2 btn-primary btn-lg btn-block">
              <i class="fe fe-mail fe-12 mx-2"></i><span class="small">Message Support</span>
            </a>
          </div>
        </nav>
      </aside>