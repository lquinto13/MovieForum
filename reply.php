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
    <title>Sent Reply</title>

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
            $name = $_SESSION['username'];

            $user_check_query = "SELECT  * FROM users WHERE username ='$name'";
            $result2 = mysqli_query($db, $user_check_query);
            $user = mysqli_fetch_assoc($result2);
            include('replyerror.php');
            include('errors.php');
            if ($_SERVER['REQUEST_METHOD'] != 'POST') {
                //someone is calling the file directly, which we don't want
                echo 'This file cannot be called directly.';
            } else {
                //check for sign in status
                if (!$_SESSION['username']) {
                    echo 'You must be signed in to post a reply.';
                } else {
                    if (count($errors) > 0) {
                        echo '<div class="alert alert-primary" role="alert" style="margin: 1%">Return to  <a href="topic.php?id=' . $_GET['id'] . '">your topic</a>.</div>';
                    } else {
                        //a real user posted a real reply
                        $sql = "INSERT INTO 
                        posts(post_content,
                        post_date,
                        post_topic,
                        post_by) 
                        VALUES ('" . $_POST['reply-content'] . "',
                        NOW(),
                        " . mysqli_real_escape_string($db, $_GET['id']) . ",
                        " . $user['userID'] . ")";

                        $result = mysqli_query($db, $sql);

                        if (!$result) {
                            echo '  <div class="alert alert-danger" role="alert" style="margin: 1%">
                                    <i class="fas fa-exclamation-circle"></i> Your reply has not been saved, please try again later.
                                </div>';
                            echo mysqli_error($db);
                        } else {
                            echo '  <div class="alert alert-success" role="alert" style="margin: 1%">
                                    Your reply has been saved, check out <a href="topic.php?id=' . htmlentities($_GET['id']) . '">the topic</a>.
                                </div>';
                        }
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