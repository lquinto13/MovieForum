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
include 'header.php'

?>
<!DOCTYPE html>
<html>

<head>
  <title>Home</title>
  <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<style>
  * {
    margin: 0;
    padding: 0;
    outline: 0;
    font-size: 100%;
    vertical-align: baseline;
    background: transparent;
    font-family: Arial, Helvetica, sans-serif;

  }

  .container {
    margin: auto;
    width: 25%;
    border: 3px solid green;
    padding: 10px;
  }

  .category-container {
    margin: auto;
    width: 50%;
    padding: 10px;
  }

  .category-container {
    margin: auto;
    width: 50%;
    padding: 10px;
  }

  .category-container textarea {
    margin: auto;
    width: 100%;
    height: 30%;
    padding: 10px;
  }
</style>

<body>

  <div>
  </div>
  <div>
    <?php
    //create_cat.php


    $db = new mysqli('localhost', 'root', '', 'movieforumdb');
    $type = $_POST['type'];
    include('usersettingerror.php');
    include('errors.php');
    if (count($errors) > 0) {
      echo 'Return to  <a href="usersettings.php?id=' . htmlentities($_GET['id']) . '">settings </a>.';
    } else {

      class changedInfo
      {
        private $username;
        private $email;
        private $userrole;
        private $type;

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

        public function setRole($userrole)
        {
          $this->userrole = $userrole;
        }

        public function getRole()
        {
          return $this->userrole;
        }

        public function setCurrentRole($type)
        {
          $this->type = $type;
        }


        public function getCurrentRole()
        {
          return $this->type;
        }
      }

      if ($_SERVER['REQUEST_METHOD'] != 'POST') {
      } else {
        $user = new changedInfo();
        $user->setCurrentRole($_POST['type']);
        $user->setFName($_POST['username']);
        $user->setEmail($_POST['email']);        $uname =   $user->getFName();

        $email =    $user->getEmail();


        $type =   $user->getCurrentRole();
        $sql = "UPDATE users SET username='$uname', email = '$email' WHERE  userID = '$type'";

        if ($db->query($sql) === TRUE) {
          echo "Record updated successfully <br>";
          echo 'Return to  <a href="index.php?id=' . htmlentities($_GET['id']) . '">Home Page </a>.';

        } else {
          echo "Error updating record: " . $db->error;
        }
        if ($_SESSION['userID'] == $type) {
          $_SESSION['username'] = $uname;
        }
      }
    }



    ?>
  </div>

</body>

</html>