<?php
include('server.php');
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
<html>

<head>
  <title>User Settings</title>

  <!-- Bootstrap -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <!-- MDB Style -->
  <link rel="stylesheet" href="mdb-bootstrap-3.10.1/css/mdb.min.css" />
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" />
  <!-- Custom Styles -->
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link rel="stylesheet" type="text/css" href="css/navbar-header-sidebar.css">
</head>

<body>
  <div class="d-flex" id="wrapper">
    <!-- Sidebar-->
    <div class="bg-dark border-right" id="sidebar-wrapper">
      <div class="sidebar-heading" id="sidebar-heading">
        <i class="fas fa-film logo-title"></i>
        <strong>MOVIE FORUM</strong>
      </div>
      <div class="list-group list-group-flush" id="button-sidebar">
        <a type="button" href="/movieforum/index.php" class="list-group-item list-group-item-action bg-dark">HOME
          <i class="fa fa-home fa-2x button-icon "></i>
        </a>

        <div class="dropdown">
          <button class="list-group-item list-group-item-action bg-dark dropdown-toggle" type="button" data-toggle="collapse" data-target="#contentManagement" aria-controls="contentManagement" aria-expanded="false" id="content-management-button">CONTENT MANAGEMENT
            <i class="fa fa-cubes fa-2x button-icon" aria-hidden="true"></i>
          </button>

          <div class="collapse" id="contentManagement">
            <a type="button" href="/movieforum/create_cat.php" class="list-group-item list-group-item-action bg-dark">CREATE A CATEGORY</a>
            <a type="button" href="/movieforum/create_topic.php" class="list-group-item list-group-item-action bg-dark">CREATE A TOPIC</a>
          </div>
        </div>

        <a type="button" href="/movieforum/about_us.php" class="list-group-item list-group-item-action bg-dark">ABOUT US
          <i class="fas fa-address-card fa-2x button-icon"></i>
        </a>

        <button class="list-group-item list-group-item-action bg-dark logout-sidebar-button" onclick="location.href='index.php?logout=\'1\''">
          LOGOUT
          <i class="fa fa-power-off fa-2x button-icon"></i>
        </button>
      </div>
    </div>

    <!-- Page content wrapper-->
    <div id="page-content-wrapper">
      <?php include 'header.php' ?>
      <!-- Page content-->
      <?php
      //create_cat.php


      $db = new mysqli('localhost', 'root', '', 'movieforumdb');
      $type = $_POST['type'];
      include('usersettingerror.php');
      include('errors.php');
      if (count($errors) > 0) {
        echo '  <div class="alert alert-primary" role="alert" style="margin: 1%">
                  Return to  <a href="usersettings.php?id=' . htmlentities($_GET['id']) . '">settings </a>.
                </div>';
      } else {

        class changedInfo
        {
          private $username;
          private $email;
          private $password_1;
          private $password_2;


          public function setFName($username)
          {
            $this->username = $username;
          }

          public function getFName()
          {
            return $this->username;
          }

          public function setEmail($email)
          {
            $this->email = $email;
          }

          public function getEmail()
          {
            return $this->email;
          }

          public function setPassOne($password_1)
          {
            $this->password_1 = $password_1;
          }

          public function getPassOne()
          {
            return $this->password_1;
          }

          public function setPassTwo($password_2)
          {
            $this->password_2 = $password_2;
          }

          public function getPassTwo()
          {
            return $this->password_2;
          }
        }

        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
        } else {
          $user = new changedInfo();
          $user->setFName($_POST['username']);
          $user->setEmail($_POST['email']);
          $user->setPassOne($_POST['password_1']);
          $user->setPassTwo($_POST['password_2']);

          $uname =   $user->getFName();

          $email =    $user->getEmail();

          $password_1 =  md5($user->getPassOne());

          $password_2 = md5($user->getPassTwo());

          echo md5($user->getPassOne());
          $sql = "UPDATE users SET username='$uname', email = '$email', password = '$password_1' WHERE  userID = '$type'";

          if ($db->query($sql) === TRUE) {
            echo '  <div class="alert alert-success" role="alert" style="margin: 1%">
                      Record updated successfully
                    </div>';
            echo '<div class="alert alert-primary" role="alert" style="margin: 1%">
                    Return to  <a href="index.php?id=' . htmlentities($_GET['id']) . '">Home Page </a>.
                  </div>';
          } else {
            echo '  <div class="alert alert-danger" role="alert" style="margin: 1%">
                      Error updating record: ' . $db->error . 
                    '</div>';
          }
          if ($_SESSION['userID'] == $type) {
            $_SESSION['username'] = $uname;
          }
        }
      }
      ?>
    </div>
  </div>

  <!-- JQuery -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <!-- Popper JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <!-- Bootstrap Script -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <!-- MDB Script -->
  <script type="text/javascript" src="mdb-bootstrap-3.10.1/js/mdb.min.js"></script>
</body>

</html>