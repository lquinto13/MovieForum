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

            if ($db->connect_error) {
                die("Connection failed: " . $db->connect_error);
            }
            $type = $_SESSION['userID'];
            $sql = "SELECT * FROM users WHERE userID = '$type'";

            $result = mysqli_query($db, $sql);

            if (!$result) {
                //Damn! the query failed, quit
                echo '  <div class="alert alert-danger" role="alert" style="margin: 1%">
                            An error occured while creating your topic. Please try again later.
                        </div>';
            } else {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '  <div class="row">
                                <div class="col-md-3">
                                </div>

                                <div class="col-md-6">
                                    <form method="POST" class="create-form shadow" action="userchange.php?id"=' . $_SESSION['userID'] . '>
                                        <h2 style = "text-align:center">User Settings</h2>
                                        
                                        <hr/>

                                        <div class="row mb-4">
                                            <div class="col">
                                                <center><h5>User Info</h5></center>
                                            </div>
                                            <div class="col">
                                                <center><h5>Change Info</h5></center>
                                            </div>
                                        </div>

                                        <!-- Username -->
                                        <div class="row mb-4">
                                            <div class="col">
                                                <center><strong><label for="username">' . $row['username'] . '</label></strong></center>
                                            </div>
                                            <div class="col">
                                            <div class="form-outline">
                                                <input type="text" id="username" name = "username" class="form-control" placeholder="(leave blank if you don\'t want to change)"/>
                                                <label class="form-label" for="username">Username</label>
                                            </div>
                                            </div>
                                        </div>
                                        
                                        <!-- Email -->
                                        <div class="row mb-4">
                                            <div class="col">
                                                <center><strong><label for="email">' . $row['email'] . '</label></strong></center>
                                            </div>
                                            <div class="col">
                                            <div class="form-outline">
                                                <input type="email" id="email" name = "email" class="form-control" placeholder="(leave blank if you don\'t want to change)"/>
                                                <label class="form-label" for="email">Email</label>
                                            </div>
                                            </div>
                                        </div>

                                        <!-- Password -->
                                        <div class="row mb-4">
                                            <div class="col">
                                                <center><strong><label for="password_1"> Password </label></strong></center>
                                            </div>
                                            <div class="col">
                                            <div class="form-outline">
                                                <input type="password" id="password_1" name = "password_1" class="form-control" placeholder="(leave blank if you don\'t want to change)"/>
                                                <label class="form-label" for="password_1">Password</label>
                                            </div>
                                            </div>
                                        </div>

                                        <!-- Confirm Password -->
                                        <div class="row mb-4">
                                            <div class="col">
                                                <center><strong><label for="password_2"> Confirm Password </label></strong></center>
                                            </div>
                                            <div class="col">
                                            <div class="form-outline">
                                                <input type="password" id="password_2" name = "password_2" class="form-control" placeholder="(leave blank if you don\'t want to change)"/>
                                                <label class="form-label" for="password_2">Confirm Password</label>
                                            </div>
                                            </div>
                                        </div>

                                        <!-- Submit Button -->
                                        <button type="submit" name = "type" class="btn btn-primary btn-block mb-4" value = ' . $type . '  />Save Changes</button>
                                    </form>
                                </div>

                                <div class="col-md-3">
                                </div>
                            </div>';
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