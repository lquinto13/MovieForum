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
          <i class="fas fa-film" style="padding-right: 5px; color: #FF8FAB;"></i>
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
        <a class="text-reset me-3 dropdown-toggle" href="" id="navbarDropdownMenuLink" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
          <i class="fas fa-user-circle"></i>
          Welcome, <strong style="color: #FF8FAB;"><?php echo $_SESSION['username']; ?></strong>
        </a>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
          <li>
            <a class="dropdown-item" href="index.php?logout='1'" style="color: #F93154;">Logout</a>
          </li>
        </ul>
      </div>
      <!-- Right elements -->
    </div>
    <!-- Container wrapper -->
  </nav>
  <!-- Navbar -->

  <!-- Original Code -->

  <!-- <div id="wrapper" class="topnav">
    <h1 style="text-align:center; font-size: 50px">Movie Forum</h1>
    <div id="menu">
      <a class="item" href="/movieforum/index.php">Home</a>
      <a class="item" href="/movieforum/create_topic.php">Create a topic</a>
      <a class="item" href="/movieforum/create_cat.php">Create a category</a>
      <a class="item" href="/movieforum/about_us.php">About Us</a>


      <a href="index.php?logout='1'" style="color: red; float:right;">logout</a>
      <p>Welcome <strong><? // php echo $_SESSION['username']; 
                          ?></strong></p>


      <br> <br>

      <div id="userbar">
      </div>
    </div>
  </div>

  <div id="content">
  </div> -->

  <!-- JQuery -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <!-- Popper JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <!-- Bootstrap Script -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <!-- MDB Script -->
  <script type="text/javascript" src="mdb-bootstrap-3.10.1/js/mdb.min.js"></script>

  <script>
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });
  </script>
</body>

</html>