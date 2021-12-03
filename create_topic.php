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
    <title>Home</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- MDB Style -->
    <link rel="stylesheet" href="mdb-bootstrap-3.10.1/css/mdb.min.css" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" />
    <!-- Custom Styles -->
    <link rel="stylesheet" type="text/css" href="css/style.css">
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
            <?php
            //the form hasn't been posted yet, display it
            //retrieve the categories from the database for use in the dropdown
            $db = new mysqli('localhost', 'root', '', 'movieforumdb');
            include('createtopic-errors.php');
            include('errors.php');
            if ($_SERVER['REQUEST_METHOD'] != 'POST') {
                $sql = "SELECT cat_id, cat_name, cat_description FROM categories";

                $name = $_SESSION['username'];
                $user_check_query = "SELECT  * FROM users WHERE username ='$name'";
                $result2 = mysqli_query($db, $user_check_query);
                $user = mysqli_fetch_assoc($result2);

                $result = mysqli_query($db, $sql);
                if (!$result) {
                    //the query failed, uh-oh :-(
                    echo 'Error while selecting from database. Please try again later.';
                } else {
                    if (mysqli_num_rows($result) == 0) {
                        //there are no categories, so a topic can't be posted
                        if ($user['usertype'] == 1) {
                            echo 'You have not created categories yet.';
                        } else {
                            echo 'Before you can post a topic, you must wait for an admin to create some categories.';
                        }
                    } else {
                        echo '  <form method="POST" action="create_topic.php" style="padding: 2%; margin-top: 2%;">
                                    <h2 style = text-align:center>Create a Topic</h2>

                                    <!-- Subject Input and Category Select -->
                                    <div class="row mb-4">
                                        <div class="col">
                                            <div class="form-outline">
                                                <input type="text" id="topic_subject" name="topic_subject" class="form-control" />
                                                <label class="form-label" for="topic_subject">Subject</label>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <select class="form-select" name="topic_cat">';
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo '              <option value="' . $row['cat_id'] . '">' . strtoupper($row['cat_name']) . '</option>';
                        }
                        echo '              </select>
                                        </div>
                                    </div>
                                    
                                    <!-- Message Input-->
                                    <div class="form-outline mb-4">
                                        <textarea class="form-control" id="post_content" name="post_content" rows="4"></textarea>
                                        <label class="form-label" for="post_content">Message</label>
                                    </div>

                                    <!-- Submit Button -->
                                    <button type="submit" name = "create-topic" class="btn btn-primary btn-block mb-4">Create Topic</button>

                                </form>';
                    }
                }
            } else {
                //start the transaction
                $query  = "BEGIN WORK;";
                $result = mysqli_query($db, $query);

                if (!$result) {
                    //Damn! the query failed, quit
                    echo 'An error occured while creating your topic. Please try again later.';
                } else {
                    $name = $_SESSION['username'];
                    $user_check_query = "SELECT  * FROM users WHERE username ='$name'";
                    $result2 = mysqli_query($db, $user_check_query);
                    $user = mysqli_fetch_assoc($result2);

                    //the form has been posted, so save it
                    //insert the topic into the topics table first, then we'll save the post into the posts table
                    $sql = "INSERT INTO 
						topics(topic_subject,
							topic_date,
							topic_cat,
						 	topic_by)
			  				VALUES('" . mysqli_real_escape_string($db, $_POST['topic_subject']) . "',
						 	NOW(),
						  	" . mysqli_real_escape_string($db, $_POST['topic_cat']) . ",
						   	" . $user['userID'] . "
						   	)";
                }
                $result = mysqli_query($db, $sql);
                if (!$result) {
                    //something went wrong, display the error
                    echo 'An error occured while inserting your data. Please try again later.' . mysqli_error($db);
                    $sql = "ROLLBACK;";
                    $result = mysqli_query($db, $sql);
                } else {
                    //the first query worked, now start the second, posts query
                    //retrieve the id of the freshly created topic for usage in the posts query

                    if($errors > 0)
                    {
                        echo 'Return to  <a href="create_topic.php?id=">create topic</a>.';

                    }
                    else
                    {
                        $topicid = mysqli_insert_id($db);
                         $sql = "INSERT INTO
                            posts(post_content,
                                  post_date,
                                  post_topic,
                                  post_by)
                        VALUES
                            ('" . mysqli_real_escape_string($db, $_POST['post_content']) . "',
                                  NOW(),
                                  " . $topicid . ",
                                  " . $user['userID']  . "
                            )";
                    $result = mysqli_query($db, $sql);

                    if (!$result) {
                        //something went wrong, display the error
                        echo 'An error occured while inserting your post. Please try again later.' . mysqli_error($db);
                        $sql = "ROLLBACK;";
                        $result = mysqli_query($db, $sql);
                    } else {
                        $sql = "COMMIT;";
                        $result = mysqli_query($db, $sql);

                        //after a lot of work, the query succeeded!
                        echo '  <div class="alert alert-success" role="alert">
                                    You have successfully created <a href="topic.php?id=' . $topicid . '">your new topic</a>.
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