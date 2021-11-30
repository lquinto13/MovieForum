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
	<link rel="stylesheet" type="text/css" href="style.css">
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
.container{
    margin:auto;
    width: 25%;
  border: 3px solid green;
  padding: 10px;
}
.category-container{
    margin:auto;
    width: 50%;
    padding: 10px;
}

.category-container{
    margin:auto;
    width: 50%;
    padding: 10px;
}

.category-container textarea{
    margin:auto;
    width: 100%;
    height: 30%;
    padding: 10px;
}
</style>

<body>

<div >
</div>
<div >
  	<?php
//create_cat.php


$db = new mysqli('localhost', 'root', '', 'movieforumdb');

 
if($_SERVER['REQUEST_METHOD'] != 'POST')
{
    
}
else
{
 

    $username =  $_POST['username'];
    $email = $_POST['email'];
    $userrole = $_POST['userrole'];
    $type = $_POST['type'];

    echo  $_POST['type'];
    $sql = "UPDATE users SET username='$username', email = '$email', usertype = $userrole WHERE  userID = $type";

    if ($db->query($sql) === TRUE) {
        echo "Record updated successfully";
      } else {
        echo "Error updating record: " . $db->error;
      }
    }


		

?>
</div>
		
</body>
</html>
