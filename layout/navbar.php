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
          <li class="nav-item">
            <a class="nav-link text-muted my-2" href="./#" data-toggle="modal" data-target=".modal-shortcut">
              <span class="fe fe-grid fe-16"></span>
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
                <img src="./assets/avatars/face-1.jpg" alt="..." class="avatar-img rounded-circle">
              </span>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href="#">Profile</a>
              <a class="dropdown-item" href="#">Settings</a>
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
            <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="./index.html">
              <svg version="1.1" id="logo" class="navbar-brand-img brand-sm" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 120 120" xml:space="preserve">
                <g>
                  <polygon class="st0" points="78,105 15,105 24,87 87,87 	" />
                  <polygon class="st0" points="96,69 33,69 42,51 105,51 	" />
                  <polygon class="st0" points="78,33 15,33 24,15 87,15 	" />
                </g>
              </svg>
            </a>
          </div>
          <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item w-100">
              <a class="nav-link" href="calendar.html">
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
              <a class="nav-link" href="calendar.html">
                <i class="fe fe-bar-chart-2 fe-16"></i>
                <span class="ml-3 item-text">Transaction</span>
              </a>
            </li>
            <li class="nav-item dropdown">
              <a href="#forms" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                <i class="fe fe-send fe-16"></i>
                <span class="ml-3 item-text">Send & Receive</span>
              </a>
              <ul class="collapse list-unstyled pl-4 w-100" id="forms">
                <li class="nav-item">
                  <a class="nav-link pl-3" href="./form_elements.html"><span class="ml-1 item-text">Transfer</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link pl-3" href="./form_advanced.html"><span class="ml-1 item-text">Internation Transfer</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link pl-3" href="./form_validation.html"><span class="ml-1 item-text">Receive</span></a>
                </li>
              </ul>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link" href="calendar.html">
                <i class="fe fe-plus-square fe-16"></i>
                <span class="ml-3 item-text">Request Money</span>
              </a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link" href="calendar.html">
                <i class="fe fe-credit-card fe-16"></i>
                <span class="ml-3 item-text">Cards</span>
              </a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link" href="calendar.html">
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
              <a class="nav-link" href="calendar.html">
                <i class="fe fe-user fe-16"></i>
                <span class="ml-3 item-text">Profile</span>
              </a>
            </li>
            <li class="nav-item w-100">
              <a class="nav-link" href="calendar.html">
                <i class="fe fe-bell fe-16"></i>
                <span class="ml-3 item-text">Notification</span>
              </a>
            </li>
            <li class="nav-item w-100">
              <a class="nav-link" href="calendar.html">
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
              <a class="nav-link" href="calendar.html">
                <i class="fe fe-tag fe-16"></i>
                <span class="ml-3 item-text">Tickets</span>
              </a>
            </li>
            <li class="nav-item w-100">
              <a class="nav-link" href="calendar.html">
                <i class="fe fe-mail fe-16"></i>
                <span class="ml-3 item-text">Mail Support</span>
              </a>
            </li>
            <li class="nav-item w-100">
              <a class="nav-link" href="calendar.html">
                <i class="fe fe-message-circle fe-16"></i>
                <span class="ml-3 item-text">Live Chat</span>
              </a>
            </li>
          </ul>
          <p class="text-muted nav-heading mt-4 mb-1">
            <span>Documentation</span>
          </p>
          <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item w-100">
              <a class="nav-link" href="../docs/index.html">
                <i class="fe fe-log-out fe-16"></i>
                <span class="ml-3 item-text">Sign Out</span>
              </a>
            </li>
          </ul>
          <div class="btn-box w-100 mt-4 mb-1">
            <a href="https://themeforest.net/item/tinydash-bootstrap-html-admin-dashboard-template/27511269" target="_blank" class="btn mb-2 btn-primary btn-lg btn-block">
              <i class="fe fe-mail fe-12 mx-2"></i><span class="small">Message Support</span>
            </a>
          </div>
        </nav>
      </aside>