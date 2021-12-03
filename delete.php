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

    .title-container {
        position: absolute;
        text-align: center;

    }

    .title-container p {
        color: black;
    }

    .content-container {
        margin-top: 20%;
        width: 50%;
        position: relative;

    }

    .content-container button {

        background-color: #555555;
        border: none;
        color: white;
        padding: 15px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        border-radius: 10%;
    }

    .content-container button.no {
        position: relative;
        top: -56px ;
        margin-left: 60%;
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

        $id = $_POST['delete'];
        $sql = "SELECT cat_id, cat_name, cat_description FROM categories WHERE cat_id = $id";
        $sqltop = "SELECT * FROM topics";
        $result = $db->query($sql);




        if (!$result) {
        } else {

            if (mysqli_num_rows($result) == 0) {
                echo 'No categories defined yet.';
            } else {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<div class='center'>";
                    echo "<div class ='title-container'>";
                    echo "<p>Are you sure you want to delete the " . $row['cat_name'] . " category?</p>";
                    echo "</div>";
                    echo "<div class ='content-container'>";
                    echo '<form method="POST" action="deleteconfirm.php?id ="> <button type = "submit" class = "yes" name = "yes" value= ' . $id . '>Yes </input> </form>';
                    echo "<form method='POST' action='index.php?id ''> <button type = 'submit' class = 'no' name = 'no' value = 2>No </input> </form>";                   
                    echo "</div>";
                    echo "</div>";
                }
            }
        }

        ?>
    </div>

</body>

</html>