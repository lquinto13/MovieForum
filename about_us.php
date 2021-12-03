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
?>

<!DOCTYPE html>
<html>

<head>
  <title>About Us</title>

  <!-- Bootstrap -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <!-- MDB Style -->
  <link rel="stylesheet" href="mdb-bootstrap-3.10.1/css/mdb.min.css" />
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" />
  <!-- Custom Styles -->
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link rel="stylesheet" type="text/css" href="css/about-us.css">
</head>

<body>
  <div class="d-flex" id="wrapper">
    <!-- Sidebar-->
    <div class="bg-dark border-right" id="sidebar-wrapper">
      <div class="sidebar-heading" id="sidebar-heading">
        <i class="fas fa-film" style="padding-right: 5px; color: #FF8FAB;"></i>
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
      <div class="bg-light">
        <div class="container py-5">
          <div class="row h-100 align-items-center py-5">
            <div class="col-lg-6">
              <h1 class="display-4">About Us</h1>
              <p class="lead text-muted mb-0">We are Group 9 of 4ITF and this project was done in fulfillment for the requirements of the course IT ELEC3C</p>
              </p>
            </div>
            <div class="col-lg-6 d-none d-lg-block"><img src="imgs/teamwork-vector.png" alt="" class="img-fluid" style="width: 80%;"></div>
          </div>
        </div>
      </div>

      <div class="bg-light py-5">
        <div class="container py-5">
          <div class="row mb-4">
            <div class="col-lg-5">
              <h2 class="display-4 font-weight-light">Our team</h2>
              <p class="font-italic text-muted">Members of Group 9</p>
            </div>
          </div>

          <div class="row text-center">
            <!-- Team item-->
            <div class="col-xl-3 col-sm-6 mb-5">
              <div class="bg-white rounded shadow-sm py-5 px-4"><img src="https://bootstrapious.com/i/snippets/sn-about/avatar-2.png" alt="" width="100" class="img-fluid rounded-circle mb-3 img-thumbnail shadow-sm">
                <h5 class="mb-0">Aguayo, Jason</h5><span class="small text-uppercase text-muted">4 - ITF</span>
              </div>
            </div>
            <!-- End-->

            <!-- Team item-->
            <div class="col-xl-3 col-sm-6 mb-5">
              <div class="bg-white rounded shadow-sm py-5 px-4"><img src="https://bootstrapious.com/i/snippets/sn-about/avatar-1.png" alt="" width="100" class="img-fluid rounded-circle mb-3 img-thumbnail shadow-sm">
                <h5 class="mb-0">Quinto, Lance</h5><span class="small text-uppercase text-muted">4 - ITF</span>
              </div>
            </div>
            <!-- End-->

            <!-- Team item-->
            <div class="col-xl-3 col-sm-6 mb-5">
              <div class="bg-white rounded shadow-sm py-5 px-4"><img src="https://bootstrapious.com/i/snippets/sn-about/avatar-2.png" alt="" width="100" class="img-fluid rounded-circle mb-3 img-thumbnail shadow-sm">
                <h5 class="mb-0">Soriano, Adrian</h5><span class="small text-uppercase text-muted">4 - ITF</span>
              </div>
            </div>
            <!-- End-->

            <!-- Team item-->
            <div class="col-xl-3 col-sm-6 mb-5">
              <div class="bg-white rounded shadow-sm py-5 px-4"><img src="https://bootstrapious.com/i/snippets/sn-about/avatar-1.png" alt="" width="100" class="img-fluid rounded-circle mb-3 img-thumbnail shadow-sm">
                <h5 class="mb-0">Yao, Hizon</h5><span class="small text-uppercase text-muted">4 - ITF</span>
              </div>
            </div>
            <!-- End-->

          </div>
        </div>
      </div>

      <!-- <div class="about-section">
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
        </div>
      </div> -->

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