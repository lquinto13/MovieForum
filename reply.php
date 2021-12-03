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
include('header.php');

?>
<!DOCTYPE html>
<html>

<head>
    <title>Home</title>
</head>

<body>

    <div>
    </div>
    <div>
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
                if ($errors > 0) {
                    echo 'Return to  <a href="topic.php?id='.$_GET['id'].'">your topic</a>.';
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
                        echo 'Your reply has not been saved, please try again later.';
                        echo mysqli_error($db);
                    } else {
                        echo 'Your reply has been saved, check out <a href="topic.php?id=' . htmlentities($_GET['id']) . '">the topic</a>.';
                    }
                }
            }
        }



        ?>
    </div>

</body>

</html>