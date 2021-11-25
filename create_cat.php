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
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<div >
</div>
<div >


 <?php
//create_cat.php
$db = mysqli_connect('localhost', 'root', '', 'movieforumdb');
echo '<h2 style = text-align:center>Create a Category</h2>';  

if($_SERVER['REQUEST_METHOD'] != 'POST')
{
    //the form hasn't been posted yet, display it
    echo "<form method='post' action=''>
        Category name: <input type='text' name='cat_name' />
        Category description: <textarea name='cat_description' /></textarea>
        <input type='submit' value='Add category' />
     </form>";
}
else
{
    $catname = mysqli_real_escape_string($db, $_POST['cat_name']);
    $catdesc = mysqli_real_escape_string($db, $_POST['cat_description']);
    $sql = "INSERT INTO categories (cat_name, cat_description) 
    VALUES('$catname', '$catdesc')";


    $result = mysqli_query($db, $sql);
    if(!$result)
    {
        //something went wrong, display the error
        echo 'Error' . mysqli_error($db);
    }
    else
    {
        echo 'New category successfully added.';
    }
}
?>
		
</body>
</html>