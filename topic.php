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
  include 'header.php'

?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>

<div >
</div>
<div >
  	<?php
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
				
            	echo '<tr>';
                	echo '<td class="leftpart">';
                    	echo '<h3>' . $row['username'] . '</h3>';
                        echo '<br>'. '<h3>' . $row['post_date'] . '</h3>';

				 	echo '<td class="rightpart">';
                     echo '<h3><p ">' . $row['post_content'] . '</p>';
                     echo '</td>';
            	echo '</tr>';
                echo '<tr>';
               		echo '<td class="bottomreply" colspan= "2">';
                	echo '<center>Reply:<br>';
					echo "<br>";
                	echo ' <textarea> </textarea> ';
					echo '<input type = "button" value = "Reply" name = "reply-content"> </button>';	
                echo '</td>';
            echo '</tr>';
        	}
   		}
		   else{
			   //prepare the table
			   echo '<table border="1">
			   <tr>
				 <th>Category</th>
				 <th>Last topic</th>
			   </tr>'; 
			  
		 while($row = mysqli_fetch_assoc($result) )
		 {               
			 echo '<tr>';
				 echo '<td class="leftpart">';
					 echo '<h3><a href="category.php?id">' . $row['cat_name'] . '</a></h3>' . $row['cat_description'];
				 echo '</td>';
				 echo '<td class="rightpart">';
							 echo '<a href="topic.php?id=">Topic subject</a> at 10-10';
				 echo '</td>';
			 echo '</tr>';
           


		 }
		   }
	}
		
}
?>
</div>
		
</body>
</html>