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

<style>
.topnav {
  background-color: #59b6ec61;
  overflow: hidden;
  font-family: Arial, Helvetica, sans-serif;

}

/* Style the links inside the navigation bar */
.topnav a {
  float: left;
  color: "black";
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

.topnav p {
  float: right;
  color: "black";
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

/* Change the color of links on hover */
.topnav a:hover {
  background-color: #ddd;
  color: black;
}

/* Add a color to the active/current link */
.topnav a.active {
  background-color: #04AA6D;
  color: white;
}


</style>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="description" content="A short description." />
    <meta name="keywords" content="put, keywords, here" />
    <title>Movie Forum</title>
</head>
<body>

    <div id="wrapper" class = "topnav"> 
    <h1 style="text-align:center">Movie Forum</h1>
    <div id="menu" >
        <a class="item" href="/movieforum/index.php">Home</a> 
        <a class="item" href="/movieforum/create_topic.php">Create a topic</a> 
        <a class="item" href="/movieforum/create_cat.php">Create a category</a>
        <a class="item" href="/movieforum/about_us.php">About Us</a>


        <a href="index.php?logout='1'" style="color: red; float:right;">logout</a> 
        <p>Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>


        <br> <br>
         
        <div id="userbar">
    </div>
    </div>
    </div>

        <div id="content">