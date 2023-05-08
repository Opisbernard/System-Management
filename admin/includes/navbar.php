<header class="main-header">
  <a href="index.php" class="logo">
    <span class="logo-mini"><b>L</b>MS</span>
    <span class="logo-lg"><b>Library </b>Admin</span>
  </a>
  <nav class="navbar navbar-static-top">
    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a>

    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <li class="dropdown user user-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <img src="<?php echo (!empty($user['photo'])) ? '../images/' . $user['photo'] : '../images/profile.jpg'; ?>"
              class="user-image" alt="User Image">
            <span class="hidden-xs">
              <?php echo $user['firstname'] . ' ' . $user['lastname']; ?>
            </span>
          </a>
          <ul class="dropdown-menu">
            <li class="user-header">
              <img src="<?php echo (!empty($user['photo'])) ? '../images/' . $user['photo'] : '../images/profile.jpg'; ?>"
                class="img-circle" alt="User Image">

              <p>
                <?php echo $user['firstname'] . ' ' . $user['lastname']; ?>
                <small>Admin Since
                  <?php echo date('M. Y', strtotime($user['created_on'])); ?>
                </small>
              </p>
            </li>
            <li class="user-footer">
              <div class="pull-left">
                <a href="#profile" data-toggle="modal" class="btn btn-default btn-flat" id="admin_profile">Update</a>
              </div>
              <div class="pull-right">
                <a href="logout.php" class="btn btn-default btn-flat">Sign out</a>
              </div>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </nav>
</header>
<?php include 'includes/profile_modal.php'; ?>