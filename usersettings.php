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
	<link rel="stylesheet" type="text/css">
</head>
<style>
.center {
        position: relative;
        background-color: whitesmoke;
        border: 2px solid black;
        width: 30%;
        display: flex;
        justify-content: center;
        margin: auto;
        margin-top: 10%;
        padding-bottom: 2%;
    }

	.center h2 {
     padding-top: 5%;
    }
::placeholder {
  font-size: 16px;
}
</style>

<body>

	<div>
	</div>
	<div>
		<?php
		//create_cat.php


		$db = new mysqli('localhost', 'root', '', 'movieforumdb');

		if ($db->connect_error) {
			die("Connection failed: " . $db->connect_error);
		}
        $type = $_SESSION['userID'];
        $sql = "SELECT * FROM users WHERE userID = '$type'";
        
        $result = mysqli_query($db, $sql);

			if(!$result)
			{
				//Damn! the query failed, quit
				echo 'An error occured while creating your topic. Please try again later.';
			}
			else
			{
                       
				//the form has been posted, so save it
				//insert the topic into the topics table first, then we'll save the post into the posts table
                echo "<br>";
                echo '<center> <table border="1" > </center>
                      <tr>
                        <th>User Info</th>
                        <th>Change   Info</th>

                        
    
                      </tr>'; 
                while($row = mysqli_fetch_assoc($result) )
                {   
                    echo '<form method="POST" action="userchange.php?id"=' .$_SESSION['userID'].'>';
                    echo '<tr>';
                        echo '<td class="leftpart">';
                            echo '<h3><a >' . $row['username'] . '</a></h3>' ;
                            echo '<td class="leftpart">';
                            echo '<h3><input = "text"  name = "username" placeholder= "username (leave blank if you dont want to change)"></input></h3>' ;
                    echo '</tr>';
                    echo '<tr>';
                         echo '<td class="rightpart">';
                    echo '<h3><a">' . $row['email'] . '</a></h3>' ;
                    echo '<td class="rightpart">';
                    echo '<h3><input = "text" name = "email"  placeholder= "email (leave blank if you dont want to change)"></input></h3>'  ;
                    echo '</tr>';
                    echo '<tr>';
                    echo '<td class="rightpart">';
                   
               echo "<button type='submit' name= 'type'  value = ".$type."  /> Save Changes </button>";
               echo '</form>';

                }   
            }

		?>
	</div>

</body>

</html>