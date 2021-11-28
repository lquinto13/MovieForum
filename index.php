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

$sql = "SELECT cat_id, cat_name, cat_description FROM categories";
$sqltop = "SELECT * FROM topics";

$user_check_query = "SELECT * FROM users  LIMIT 1";

$result = $db->query($sql);
$result3 = $db->query($sqltop);



 
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
		$user_check_query = "SELECT  * FROM users WHERE username ='$name'";
		$result2 = mysqli_query($db, $user_check_query);
		$user = mysqli_fetch_assoc($result2);
		$querytop = mysqli_query($db, $sqltop);
		$last_id = mysqli_insert_id($db);

	


		if($user['usertype'] == 1)
		{
			//prepare the table
		echo "<br>";
        echo '<center> <table border="1" > </center>
              <tr>
                <th>Category</th>
				<th>Setting</th>
              </tr>'; 
             
        	while($row = mysqli_fetch_assoc($result) )
       		{       
				$row2 = mysqli_fetch_assoc($result3);
            	echo '<tr>';
                	echo '<td class="leftpart">';
                    	echo '<h3><a href="category.php?id='.$row['cat_id'].'">' . $row['cat_name'] . '</a></h3>' . $row['cat_description'];
				 	echo '<td class="rightpart">';
                            echo '<center><button>Delete</button></center>';
                	echo '</td>';
            	echo '</tr>';
        	}
   		}
		   else{
			echo "<br>";
			echo '<center> <table border="1" > </center>
				  <tr>
					<th>Category</th>
				  </tr>'; 
			  
		 while($row = mysqli_fetch_assoc($result) )
		 {               
			$row2 = mysqli_fetch_assoc($result3);
			echo '<tr>';
				echo '<td class="leftpart">';
					echo '<h3><a href="category.php?id='.$row['cat_id'].'">' . $row['cat_name'] . '</a></h3>' . $row['cat_description'];
			echo '</tr>';
		}
		   }
	}
		
}
?>
</div>
		
</body>
</html>