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
.container{
    margin:auto;
    width: 25%;
  border: 3px solid green;
  padding: 10px;
}
.category-container{
    margin:auto;
    width: 50%;
    padding: 10px;
}

.category-container{
    margin:auto;
    width: 50%;
    padding: 10px;
}

.category-container textarea{
    margin:auto;
    width: 100%;
    height: 30%;
    padding: 10px;
}
</style>

<body>

<div >
</div>
<div >
<?php
    $db = new mysqli('localhost', 'root', '', 'movieforumdb');

    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
      }
    
    $sql = "SELECT * FROM users";
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
    if($_SERVER['REQUEST_METHOD'] != 'POST')
    {
        if(mysqli_num_rows($result) == 0)
        {
            echo 'No users.';
        }
        else
        {
            $name = $_SESSION['username'];  
            $user_check_query = "SELECT  * FROM users WHERE username ='$name'";
            $result2 = mysqli_query($db, $user_check_query);
            $user = mysqli_fetch_assoc($result2);
            $querytop = mysqli_query($db, $sqltop);
            $last_id = mysqli_insert_id($db);
                //prepare the table
            echo "<br>";
            echo '<center> <table border="1" > </center>
                  <tr>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Account Type</th>
                    <th>Change User</th>

                  </tr>'; 
                 
                while($row = mysqli_fetch_assoc($result) )
                   {   
                    $row2 = mysqli_fetch_assoc($result2);
                    $type = 0;
                    echo '<form method="POST" action="adminpage.php?id =">';
                    echo '<tr>';
                        echo '<td class="leftpart">';
                            echo '<h3><a name = "username">' . $row['username'] . '</a></h3>' ;
                         echo '<td class="rightpart">';
                         echo '<h3><a name = "email">' . $row['email'] . '</a></h3>' ;
                        echo '</td>';
                        echo '<td class="leftpart">';
                            if($row['usertype'] == 1)
                            {
                                echo 'Admin ' ;
                            }
                            else
                            {
                                echo 'User' ; 
                            }     
                            echo '<td class="rightpart">';
                            echo "<center> <button type='submit' name= 'type' value= ". $row['userID']. " /> Select </button></center>";
                           echo '</td>';    
                    echo '</tr>';
                    
                }
                echo "</form>";
            }
    }
    else
    {   
        $type = $_POST['type'];
        echo $type ;
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
                    echo '<form method="POST" action="changeadmin.php?id"=' .$_POST['type'].'>';
                    echo '<tr>';
                        echo '<td class="leftpart">';
                            echo '<h3><a >' . $row['username'] . '</a></h3>' ;
                            echo '<td class="leftpart">';
                            echo '<h3><input = "text"  name = "username" ></input></h3>' ;
                    echo '</tr>';
                    echo '<tr>';
                         echo '<td class="rightpart">';
                    echo '<h3><a">' . $row['email'] . '</a></h3>' ;
                    echo '<td class="rightpart">';
                    echo '<h3><input = "text" name = "email" ></input></h3>'  ;
                    echo '</tr>';
                    echo '<tr>';
                    echo '<td class="rightpart">';
                    if( $row['usertype']== 1)
                    {
                        echo '<h3><a">Admin</a></h3>' ;

                    }
                    else
                    {
                        echo '<h3><a">User</a></h3>' ;

                    }
                    echo '<th class="rightpart">';
                    if( $row['usertype']== 1)
                    {
                        echo '<select name="userrole" id="cars">
                        <option value="1">Admin</option>
                        <option value="2">User</option>
                        </select>' ;

                    }
                    else
                    {
                        echo '<select name="userrole" id="cars">
                        <option value="1">Admin</option>
                        <option value="2" selected = "selected">User</option>
                        </select>' ;
                    }
               
               echo '</tr>';
               echo "<button type='submit' name= 'type'  value = ".$type."  /> Select </button>";
               echo '</form>';

                }   
            }
    }
    
        
    }
?>
</div>
		
</body>
</html>