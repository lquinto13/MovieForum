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
    <title>Create a Category</title>
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

            $db = mysqli_connect('localhost', 'root', '', 'movieforumdb');
            include('errortest.php');
            include('errors.php');
            if ($_SERVER['REQUEST_METHOD'] != 'POST') {
                //the form hasn't been posted yet, display it
                echo "  <div class='row'>
                            <div class='col-md-4'>
                            </div>

                            <div class='col-md-4'>
                                <form method='post' action='' class='create-form shadow'>
                                    <h2 style = text-align:center>Create a Category</h2>
                                    
                                    <hr/>

                                    <!-- Name input -->
                                    <div class='form-outline mb-4'>
                                        <input type='text' id='cat_name' name='cat_name' class='form-control' />
                                        <label class='form-label' for='cat_name'>Category Name</label>
                                    </div>

                                    <!-- Description input -->
                                    <div class='form-outline mb-4'>
                                        <textarea class='form-control' id='cat_description' name='cat_description' rows='4'></textarea>
                                        <label class='form-label' for='cat_description'>Category Description</label>
                                    </div>

                                    <!-- Submit Button -->
                                    <button type='submit' name = 'create-cat' class='btn btn-primary btn-block mb-4'>Add category</button>
                                </form>
                            </div>
                            
                            <div class='col-md-4'>
                            </div>
                        </div>";
            } else {
                if (count($errors) > 0) {
                    echo '  <div class="alert alert-primary" role="alert" style="margin: 1%">
                                Return to  <a href="create_cat.php?id=">create a category</a>.
                            </div';
                } else {
                    $catname = mysqli_real_escape_string($db, $_POST['cat_name']);
                    $catdesc = mysqli_real_escape_string($db, $_POST['cat_description']);
                    $sql = "INSERT INTO categories (cat_name, cat_description) VALUES('$catname', '$catdesc')";


                    $result = mysqli_query($db, $sql);
                    if (!$result) {
                        //something went wrong, display the error
                        echo '  <div class="alert alert-danger" role="alert" style="margin: 1%">
                                    Error: ' . mysqli_error($db). 
                                '</div>';
                    } else {
                        echo '  <div class="alert alert-success" role="alert" style="margin: 1%">
                                    New category successfully added.
                                </div>
                                <div class="alert alert-primary" role="alert" style="margin: 1%">
                                    Return to  <a href="create_cat.php?id=">create a category</a>.
                                </div>';
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