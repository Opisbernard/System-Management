<header class="main-header">
  <nav class="navbar navbar-static-top">
    <div class="container">
      <div class="navbar-header">
        <a href="#" class="navbar-brand"><b>School</b> Library</a>
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
          <i class="fa fa-bars"></i>
        </button>
      </div>

      <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
        <ul class="nav navbar-nav">
          <?php
          if (isset($_SESSION['student'])) {
            echo "
                <li><a href='index.php'>HOME</a></li>
                <li><a href='transaction.php'>TRANSACTION</a></li>
              ";
          }
          ?>
        </ul>
      </div>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <?php
          if (isset($_SESSION['student'])) {
            $photo = (!empty($student['photo'])) ? 'images/' . $student['photo'] : 'images/profile.jpg';
            echo "
                <li class='user user-menu'>
                  <a href='#'>
                    <img src='" . $photo . "' class='user-image' alt='User Image'>
                    <span class='hidden-xs'>" . $student['firstname'] . ' ' . $student['lastname'] . "</span>
                  </a>
                </li>
                <li><a href='logout.php'><i class='fa fa-sign-out'></i> LOGOUT</a></li>
              ";
          } else {
            echo "
                <li><a href='#login' data-toggle='modal'><i class='fa fa-sign-in'></i> STUDENT TRANSACTION LOG</a></li>
                <li><a href='admin/index.php' data-toggle='modal'><i class='fa fa-key'></i> ADMIN LOGIN</a></li>
              ";
          }
          ?>
        </ul>
      </div>
    </div>
  </nav>
</header>
<?php include 'includes/login_modal.php'; ?>