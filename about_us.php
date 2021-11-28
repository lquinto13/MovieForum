<?php 
  session_start(); 

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
<style>
body {
  font-family: Arial, Helvetica, sans-serif;
}

html {
  box-sizing: border-box;
}

*, *:before, *:after {
  box-sizing: inherit;
}

.column {
  float: left;
  width: 50%;
  margin-bottom: 16px;
  padding: 0 16px;
}

.card {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  margin: 30px;
}

.about-section {
  padding: 50px;
  text-align: center;
  background-color: #474e5d;
  color: white;
}

.container {
  padding: 0 16px;
}

.container::after, .row::after {
  content: "";
  clear: both;
  display: table;
}

.title {
  color: grey;
}

.button {
  border: none;
  outline: 0;
  display: inline-block;
  padding: 8px;
  color: white;
  background-color: #000;
  text-align: center;
  cursor: pointer;
  width: 100%;
}

.button:hover {
  background-color: #555;
}

@media screen and (max-width: 650px) {
  .column {
    width: 100%;
    display: block;
  }
}

</style>
<!DOCTYPE html>
<html>
<head>
	<title>About Us</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<div class="about-section">
  <h1>About Us Page</h1>
  <p>Some text about who we are and what we do.</p>
  <p>Resize the browser window to see that this page is responsive by the way.</p>
</div>

<h2 style="text-align:center">Our Team</h2>
<div class="row">
  <div class="column">
    <div class="card">
      <img src="imgs/human.jpg" alt="Jane" style="width:100%">
      <div class="container">
        <h2>Lance Quinto</h2>
        <p class="title">Student</p>
        <p>Some text that describes me lorem ipsum ipsum lorem.</p>
        <p>lancegabriel.quinto.iics@ust.edu.ph</p>
        <p><button class="button">Contact</button></p>
        <br>
      </div>
    </div>
  </div>

  <div class="column">
    <div class="card">
      <img src="imgs/human.jpg" alt="Mike" style="width:100%">
      <div class="container">
        <h2>Mike Ross</h2>
        <p class="title">Student</p>
        <p>Some text that describes me lorem ipsum ipsum lorem.</p>
        <p>@gmail.com</p>
        <p><button class="button">Contact</button></p>
        <br>
      </div>
    </div>
  </div>

 <div class="row">
  <div class="column">
    <div class="card">
      <img src="imgs/human.jpg" alt="Jane" style="width:100%">
      <div class="container">
        <h2>Lance Quinto</h2>
        <p class="title">Student</p>
        <p>Some text that describes me lorem ipsum ipsum lorem.</p>
        <p>jane@example.com</p>
        <p><button class="button">Contact</button></p>
        <br>
      </div>
    </div>
  </div>

  <div class="column">
    <div class="card">
      <img src="imgs/human.jpg" alt="Mike" style="width:100%">
      <div class="container">
        <h2>Mike Ross</h2>
        <p class="title">Studentr</p>
        <p>Some text that describes me lorem ipsum ipsum lorem.</p>
        <p>mike@example.com</p>
        <p><button class="button">Contact</button></p>
        <br>
      </div>
    </div>
  </div>

</body>
</html>