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
	<title>Home</title>
</head>
<style>
    * {
        margin: 0;
        padding: 0;
        outline: 0;
        font-size: 100%;
        vertical-align: baseline;
        background: transparent;
		font-family: Arial, Helvetica, sans-serif;

    }

	
</style>
<body>

<div >
</div>
<div >
  	<?php
	    include 'header.php';
//create_cat.php
$db = new mysqli('localhost', 'root', '', 'movieforumdb');
if ($db->connect_error) {
	die("Connection failed: " . $db->connect_error);
  }


$sql = "SELECT
posts.post_topic,
posts.post_content,
posts.post_date,
posts.post_by,
users.userID,
users.username
FROM
posts
LEFT JOIN
users
ON
posts.post_by = users.userID
WHERE
posts.post_topic = " . mysqli_real_escape_string($db, $_GET['id']);

$sqltopic = "SELECT  
                    topic_id,
                    topic_subject,
                    topic_date,
                    topic_cat
                FROM
                    topics
                WHERE
				topic_id= ". mysqli_real_escape_string($db, $_GET['id']);

$user_check_query = "SELECT * FROM users  LIMIT 1";
$result = $db->query($sql);
$result3 = $db->query($sqltopic);
$result7 = $db->query($sql);





 
if(!$result)
{
    echo 'The categories could not be displayed, please try again later.';
}
else
{
    if(mysqli_num_rows($result) == 0)
    {
        echo 'No categories defined yet.';
    }
    else
    {

	$name = $_SESSION['username'];  

        $name = $_SESSION['username'];  
		$user_check_query = "SELECT  * FROM users WHERE username ='$name'";
		$result2 = mysqli_query($db, $user_check_query);
		$user = mysqli_fetch_assoc($result2);	
		$title = mysqli_fetch_assoc($result3);

		if($user['usertype'] == 1)
		{
			//prepare the table
			 
		
		echo "<br>";
        echo '<center> <table border="1" > </center>
			  <tr>
			  <td class="bottomreply" colspan= "2">
			  <center><h3> '. $title['topic_subject'] .' </h3></center>
			  </td>
              </tr>'; 
             
        	while($row = mysqli_fetch_assoc($result) )
       		{       
				if($_SERVER['REQUEST_METHOD'] != 'POST')
				{
					echo '<tr>';
                	echo '<td class="leftpart">';
                    	echo '<h3>' . $row['username'] . '</h3>';
                        echo '<br>'. '<h3>' . $row['post_date'] . '</h3>';
				 		echo '<td class="rightpart">';
                     	echo '<h3><p ">' . $row['post_content'] . '</p>';
                    	 echo '</td>';
            			echo '</tr>';
               		 echo '<tr>';
               	
         		  echo '</tr>';
        		}
				else
				{
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
				}
			}
			$row = mysqli_fetch_assoc($result7);
			echo '<td class="bottomreply" colspan= "2">';
					   echo '<center>Reply:<br>';
					   echo "<br>";
					   echo '<form method="post" action="reply.php?id='.$row['post_topic'].'">
					   <textarea name="reply-content"></textarea>
					   <input type="submit" value="Submit reply" />
				   </form> ';
					   echo '</td>';
				  echo '</tr>';
		   
	   
   		}
		   else{
			   //prepare the table
			   
		echo "<br>";
        echo '<center> <table border="1" > </center>
			  <tr>
			  <td class="bottomreply" colspan= "2">
			  <center><h3> '. $title['topic_subject'] .' </h3></center>
			  </td>
              </tr>'; 
		 while($row = mysqli_fetch_assoc($result) )
		 {               
			if($_SERVER['REQUEST_METHOD'] != 'POST')
			{
				echo '<tr>';
				echo '<td class="leftpart">';
					echo '<h3>' . $row['username'] . '</h3>';
					echo '<br>'. '<h3>' . $row['post_date'] . '</h3>';
					 echo '<td class="rightpart">';
					 echo '<h3><p ">' . $row['post_content'] . '</p>';
					 echo '</td>';
					echo '</tr>';
					echo '<tr>';
				   
			}
			else
			{
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
			}
           


		 }
		 $row = mysqli_fetch_assoc($result7);
		 echo '<td class="bottomreply" colspan= "2">';
					echo '<center>Reply:<br>';
					echo "<br>";
					echo '<form method="post" action="reply.php?id='.$row['post_topic'].'">
					<textarea name="reply-content"></textarea>
					<input type="submit" value="Submit reply" />
				</form> ';
					echo '</td>';
			   echo '</tr>';
			   
		}
	}
		
}
?>
</div>
		
</body>
</html>