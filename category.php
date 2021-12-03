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
$db = mysqli_connect('localhost', 'root', '', 'movieforumdb');

//first select the category based on $_GET['cat_id']
$sql = "SELECT cat_id, cat_name, cat_description FROM categories WHERE cat_id = ". mysqli_real_escape_string($db, $_GET['id']);

 
$result = mysqli_query($db, $sql);
 
if(!$result)
{
    echo 'The category could not be displayed, please try again later.' . mysqli_error($db);
    echo mysqli_real_escape_string($db, $_GET['id']);
}
else
{
    if(mysqli_num_rows($result) == 0)
    {
        echo 'This category does not exist.';
    }
    else
    {
        //display category data
        while($row = mysqli_fetch_assoc($result))
        {
            echo '<center> <h2>Topics in ′' . $row['cat_name'] . '′ category</h2> </center>';
        }
     
        //do a query for the topics
        $sql = "SELECT  
                    topic_id,
                    topic_subject,
                    topic_date,
                    topic_cat,
                    topic_by
                FROM
                    topics
                WHERE
                    topic_cat = ". mysqli_real_escape_string($db, $_GET['id']);
         
        $result = mysqli_query($db, $sql);

		$name = $_SESSION['username'];
        $user_check_query = "SELECT * FROM users WHERE username ='$name'";
        $result2 = mysqli_query($db, $user_check_query);
        $user = mysqli_fetch_assoc($result2);
        
        if(!$result)
        {
            echo 'The topics could not be displayed, please try again later.';
        }
        else
        {
            if(mysqli_num_rows($result) == 0)
            {
                echo 'There are no topics in this category yet.';
            }
            else
            {
                //prepare the table
                echo '<center> <table border="1"> </cener>
                      <tr>
                        <th>Topic</th>
                        <th>Created at</th>
                        <th>Rating</th>
                      </tr>'; 
                      class AdminDelete
                      {
                        private $id;
                        function __construct($id) {
                            $this->id = $id;
                          }

                          function get_name() {
                            return $this->id;
                          }
                          // Function geeks of parent class
                          function delete()
                          {
                              echo '<td class="rightpart">';
                              echo '<form method = "POST" action="cattopic-delete.php?id =">';
                              echo '<button name = "delete"  value = ' . $this->id.'>Delete</button>';
                              echo '</form>';
                              echo $this->id;  
                              echo '</td>';
                          }
                      }

                      // This is child class
                      class Userdelete extends AdminDelete
                      {
                        private $id;
                        function __construct($id) {
                            $this->id = $id;
                          }
                          // Overriding geeks method
                          function delete()
                          {
                              echo '<td class="rightpart">';
                              echo '<form method = "POST" action="cattopic-delete.php?id">';
                              echo '<button name = "delete"  value = ' . $this->id.'>Delete</button>';
                              echo '</form>';
                              echo '</td>';
                          }
                      }

                     
                     
                while($row = mysqli_fetch_assoc($result))
                {              
                    $p = new AdminDelete($row['topic_id']);
                    $c = new Userdelete($row['topic_id']); 
                    echo '<tr>';
                        echo '<td class="leftpart">';
                            echo '<h3><a href="topic.php?id=' . $row['topic_id'] . '">' . $row['topic_subject'] . '</a><h3>';
                        echo '</td>';
                        echo '<td class="rightpart">';
                            echo date('d-m-Y', strtotime($row['topic_date']));
                        echo '</td>';
                        


                       

                        $likesql = "SELECT * FROM likes WHERE topic_id = " . $row['topic_id'];
                        $result3 = mysqli_query($db, $likesql);
                        $likes = 0;
                        $liked = NULL;
                        $rate = "No rating";

                        if(!mysqli_num_rows($result3) == 0)
                        {
                            while($row2 = mysqli_fetch_assoc($result3))
                            {
                                if($row2['isLike'] == true) {
                                    $likes++;
                                }
                            }
                            $rate = number_format((($likes / mysqli_num_rows($result3)) * 100), 2) . "%";
                        }
                        echo '<td>';
                            echo $rate;
                        echo '</td>';
                        if ($_SESSION['role'] == 1) {
                            $p->delete();
                        }else if($_SESSION['userID'] == $row['topic_by'])
                        {
                            $c->delete();
                            $c->get_name();
                        }
                        
                    echo '</tr>';
                }
            }
        }
    }
}
 
?>
</div>
		
</body>
</html>