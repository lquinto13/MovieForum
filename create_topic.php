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
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
  <?php
	echo '<h2 style = text-align:center>Create a Topic</h2>';  
  
        //the form hasn't been posted yet, display it
        //retrieve the categories from the database for use in the dropdown
		$db = new mysqli('localhost', 'root', '', 'movieforumdb');

		if($_SERVER['REQUEST_METHOD'] != 'POST')
  		{
		$sql = "SELECT cat_id, cat_name, cat_description FROM categories";

		$name = $_SESSION['username'];  
		$user_check_query = "SELECT  * FROM users WHERE username ='$name'";
		$result2 = mysqli_query($db, $user_check_query);
		$user = mysqli_fetch_assoc($result2);
         
        $result = mysqli_query($db, $sql);
		if(!$result)
        {
            //the query failed, uh-oh :-(
            echo 'Error while selecting from database. Please try again later.';
        }
        else
        {
            if(mysqli_num_rows($result) == 0)
            {
                //there are no categories, so a topic can't be posted
                if($user['usertype'] == 1)
                {
                    echo 'You have not created categories yet.';
                }
                else
                {
                    echo 'Before you can post a topic, you must wait for an admin to create some categories.';
                }
            }
			else
            {
         
                echo '<form method="POST" action="create_topic.php">
                    Subject: <input type="text" name="topic_subject"  />
                    Category:'; 
                 
                echo '<select name="topic_cat">';
                    while($row = mysqli_fetch_assoc($result))
                    {
                        echo '<option value="' . $row['cat_id'] . '">' . $row['cat_name'] . '</option>';
                    }
                echo '</select>'; 
                     
                echo 'Message: <textarea name="post_content" /></textarea>
                    <input type="submit" value="Create topic" />
                 </form>';
            }
        }
		}
		else
		{
				//start the transaction
		$query  = "BEGIN WORK;";
		$result = mysqli_query($db, $query);
	 
			if(!$result)
			{
				//Damn! the query failed, quit
				echo 'An error occured while creating your topic. Please try again later.';
			}
			else
			{
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
						  	" . mysqli_real_escape_string($db,$_POST['topic_cat']) . ",
						   	" . $user['userID'] . "
						   	)";
			}
			$result = mysqli_query($db, $sql);
            if(!$result)
            {
                //something went wrong, display the error
                echo 'An error occured while inserting your data. Please try again later.' . mysqli_error($db);
                $sql = "ROLLBACK;";
                $result = mysqli_query($db, $sql);
            }
            else
            {
                //the first query worked, now start the second, posts query
                //retrieve the id of the freshly created topic for usage in the posts query
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
                 
                if(!$result)
                {
                    //something went wrong, display the error
                    echo 'An error occured while inserting your post. Please try again later.' . mysql_error();
                    $sql = "ROLLBACK;";
                    $result = mysql_query($sql);
                }
                else
                {
                    $sql = "COMMIT;";
                    $result = mysqli_query($db, $sql);
                     
                    //after a lot of work, the query succeeded!
                    echo 'You have successfully created <a href="topic.php?id='. $topicid . '">your new topic</a>.';
                }
            }
        }
    
	
		
    


		
  ?>

</body>
</html>