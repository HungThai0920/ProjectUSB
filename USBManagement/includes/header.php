<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

if (isset($_SESSION['user_name'])) {
    $username = $_SESSION['user_name'];
} 
?>

<?php
   $current_page = basename($_SERVER['PHP_SELF'], ".php");
?>

<div class="">
    <nav class="navbar">
      <div class="container-nav">
        <div class="navbar-content">
          <div class="navbar-left">
            <div class="logo">
              <img alt="Your Company" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" class="logo-img" />
            </div>
            <div class="nav-links">
              <a href="manage_users.php" class="nav-link <?= ($current_page == 'manage_users') ? 'current' : '' ?>">Quản lý người dùng</a>
              <a href="manage_usb.php" class="nav-link <?= ($current_page == 'manage_usb') ? 'current' : '' ?>">Quản lý USB</a>
              <a href="borrow_usb.php" class="nav-link <?= ($current_page == 'borrow_usb') ? 'current' : '' ?>">Đăng ký mượn USB</a>
              <a href="approve_borrow.php" class="nav-link <?= ($current_page == 'approve_borrow') ? 'current' : '' ?>">Phê duyệt USB</a>
              <a href="upload_data.php" class="nav-link <?= ($current_page == 'upload_data') ? 'current' : '' ?>">Upload Data</a>
              <a href="download_data.php" class="nav-link <?= ($current_page == 'download_data') ? 'current' : '' ?>">Download Data</a>
              
            </div>
          </div>
          <div class="navbar-right">
            <div class="profile-name">
            <span>Chào mừng <?php echo htmlspecialchars($username); ?>
            </div>
            <div class="profile-menu">
              <button class="profile-button">
               
                <span class="sr-only">Open user menu</span>
                <img alt="" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" class="profile-img" />
              </button>
              <div class="profile-dropdown">
                <a href="#" class="dropdown-item">Đổi mật khẩu</a>
                <a href='logout.php' class="dropdown-item">Đăng xuất</a>
              </div>
            </div>
          </div>
          <div class="mobile-menu-button">
            <button class="menu-button">
              <span class="sr-only">Open main menu</span>
              <svg xmlns="http://www.w3.org/2000/svg" class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
              </svg>
              <svg xmlns="http://www.w3.org/2000/svg" class="icon hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
              </svg>
            </button>
          </div>
        </div>
      </div>
    </nav>
    <div class="mobile-menu">
      <div class="mobile-nav-links">
        <a href="#" class="mobile-nav-link current" aria-current="page">Dashboard</a>
        <a href="#" class="mobile-nav-link">Team</a>
        <a href="#" class="mobile-nav-link">Projects</a>
        <a href="#" class="mobile-nav-link">Calendar</a>
      </div>
      <div class="mobile-profile">
        <div class="mobile-profile-info">
          <img alt="" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" class="mobile-profile-img" />
          <div>
            <div class="mobile-profile-name">Tom Cook</div>
            <div class="mobile-profile-email">tom@example.com</div>
          </div>
          <button type="button" class="notification-button">
            <span class="sr-only">View notifications</span>
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true">
              <path d="M15 17h5l-1.405-1.405C18.791 14.835 19 13.44 19 12V8c0-3.866-3.134-7-7-7S5 4.134 5 8v4c0 1.44.209 2.835.605 4.17L4 17h5m5 0v1a2 2 0 1 1-4 0v-1m4 0H9" />
            </svg>
          </button>
        </div>
        <div class="mobile-profile-dropdown">
          <a href="#" class="dropdown-item">Your Profile</a>
          <a href="#" class="dropdown-item">Settings</a>
          <a href="#" class="dropdown-item">Sign out</a>
        </div>
      </div>
    </div>
  </div>
