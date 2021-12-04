<?php

if (!isset($_SESSION['username'])) {
  $_SESSION['msg'] = "You must log in first";
  header('location: login.php');
}
if (isset($_GET['logout'])) {
  session_destroy();
  unset($_SESSION['username']);
  header("location: login.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Movie Forum</title>
  <!-- Bootstrap -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <!-- MDB Style -->
  <link rel="stylesheet" href="mdb-bootstrap-3.10.1/css/mdb.min.css" />
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" />
  <!-- Custom Styles -->
  <link rel="stylesheet" href="css/navbar-header-sidebar.css">
</head>

<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <!-- Container wrapper -->
    <div class="container-fluid">
      <button class="btn bg-transparent" type="button" style="color: white;" id="menu-toggle">
        <span><i class="fas fa-bars fa-lg"></i></span>
      </button>
      <!-- Toggle button -->
      <!-- <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fas fa-bars"></i>
      </button> -->

      <!-- Collapsible wrapper -->
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- Navbar brand -->
        <!-- <span class="navbar-brand mb-0 h1">
          <i class="fas fa-film logo-title"></i>
          <strong>MOVIE FORUM</strong>
        </span> -->
        <!-- Left links -->
        <!-- <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="/movieforum/index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/movieforum/create_topic.php">Create a Topic</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/movieforum/create_cat.php">Create a Category</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/movieforum/about_us.php">About Us</a>
          </li>
        </ul> -->
        <!-- Left links -->
      </div>
      <!-- Collapsible wrapper -->

      <!-- Right elements -->
      <div class="d-flex align-items-center">
        <!-- User -->
        <?php
        $db = new mysqli('localhost', 'root', '', 'movieforumdb');
        $name = $_SESSION['username'];
        $user_check_query = "SELECT  * FROM users WHERE username ='$name'";
        $result = mysqli_query($db, $user_check_query);
        $user = mysqli_fetch_assoc($result);
        class User
        {
          public $username;
          public $usertype;

          public function __construct($username, $usertype)
          {
            $this->username = $username;
            $this->usertype = $usertype;
          }
        }
        class Admin extends User
        {
          public function displayAdminPanel()
          {
            echo '<a class="navbar-brand me-3 dropdown-toggle" href="" id="navbarDropdownMenuLink" role="button" data-mdb-toggle="dropdown" aria-expanded="false">';
            echo '<i class="fas fa-user-circle"  style = "padding-right: 5px;"></i>';
            echo "Welcome, <strong style='color: #FF548C; padding-left: 4px'> $this->username </strong>";
            echo '</a>';
            echo '<ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">';
            echo ' <l1> <a class="dropdown-item" style=" float:right;" href="/movieforum/adminpage.php">Admin Controls</a></l1>';
            echo '<li> <a class="dropdown-item" href="index.php?logout=" style="color: #F93154;">Logout</a>  </li>';
            echo ' </ul>';
          }
        }

        class Normal extends User
        {
          public function displayUserSettings()
          {
            echo '<a class="navbar-brand me-3 dropdown-toggle" href="" id="navbarDropdownMenuLink" role="button" data-mdb-toggle="dropdown" aria-expanded="false">';
            echo '<i class="fas fa-user-circle" style = "padding-right: 5px;"></i>';
            echo "Welcome, <strong style='color: #FF548C; padding-left: 4px'>$this->username </strong>";
            echo '</a>';
            echo '<ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">';
            echo ' <l1> <a class="dropdown-item" style=" float:right;" href="/movieforum/usersettings.php">User Settings</a></l1>';
            echo '<li> <a class="dropdown-item" href="index.php?logout=" style="color: #F93154;">Logout</a>  </li>';
            echo ' </ul>';
          }
        }

        if ($user['usertype'] == 1) {
          $admin = new Admin($name, 1);
          $admin->displayAdminPanel();
        } else {
          $normal = new Normal($name, 2);
          $normal->displayUserSettings();
        }


        ?>
      </div>
      <!-- Right elements -->
    </div>
    <!-- Container wrapper -->
  </nav>
  <!-- Navbar -->

  <!-- JQuery -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <!-- Popper JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <!-- Bootstrap Script -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <!-- MDB Script -->
  <!-- <script type="text/javascript" src="mdb-bootstrap-3.10.1/js/mdb.min.js"></script> -->

  <script>
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });
  </script>
</body>

</html>