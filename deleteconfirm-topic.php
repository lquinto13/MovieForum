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
    }

    .title-container {
        position: absolute;
        text-align: center;

    }

    .center p {
        position: absolute;
        margin-top: 2%;
        color: black;
    }


    .content-container {
        margin-top: 10%;
        width: 50%;
        text-align: center;
        position: relative;
        padding-bottom: 1%;

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
        margin-left: 20%;
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

        $id = $_POST['yes'];
        $cattopicid= $_GET['id'];
        $sql = "SELECT * FROM topics WHERE topic_id = $id";
        $sqltop = "SELECT * FROM topics";
        $result = $db->query($sql);




        if (!$result) {
            echo mysqli_error($db);

        } else {

            if (mysqli_num_rows($result) == 0) {
                echo 'No categories defined yet.';
            } else {
                while ($row = mysqli_fetch_assoc($result)) {

                    $sql = "DELETE FROM topics WHERE topic_id = $id";
                    if (mysqli_query($db, $sql)) {
                        echo "<div class='center'>";
                        echo "<p>You have deleted the topic succesfully.</p>";
                        echo "<div class='content-container'>";
                        echo 'Return to  <a href="index.php?id=) ">Home Page</a>.';
                        echo "</div>";


                        echo "</div>";
                    } else {
                        echo "Error deleting record: " . mysqli_error($db);
                    }
                }
            }
        }

        ?>
    </div>

</body>

</html>