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
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<div >
</div>
<div >
  	<?php
//create_cat.php


$db = new mysqli('localhost', 'root', '', 'movieforumdb');
$user_check_query = "SELECT  * FROM users WHERE username ='$name'";
$result2 = mysqli_query($db, $user_check_query);
$user = mysqli_fetch_assoc($result2);
    //check for sign in status
   
        //a real user posted a real reply
        $sql = "INSERT INTO 
                    posts(post_content,
                          post_date,
                          post_topic,
                          post_by) 
                VALUES ('" . $_POST['reply-content'] . "',
                        NOW(),
                        " . mysqli_real_escape_string($db, $_GET['id']) . ",
                        " . $user['username'] . ")";
                         
        $result = mysqli_query($db, $sql);
                         
        if(!$result)
        {
            echo 'Your reply has not been saved, please try again later.';
        }
        else
        {
            echo 'Your reply has been saved, check out <a href="topic.php?id=' . htmlentities($_GET['id']) . '">the topic</a>.';
        }
    

?>
</div>
		
</body>
</html>