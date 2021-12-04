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
    <!-- Bootstrap -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<!-- MDB Style -->
	<link rel="stylesheet" href="mdb-bootstrap-3.10.1/css/mdb.min.css" />
	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" />
	<!-- Custom Styles -->
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/table.css">
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
        $sql = "SELECT cat_id, cat_name, cat_description FROM categories WHERE cat_id = $id";
        $sqltop = "SELECT * FROM topics";
        $result = $db->query($sql);




        if (!$result) {
        } else {

            if (mysqli_num_rows($result) == 0) {
                echo 'No categories defined yet.';
            } else {
                while ($row = mysqli_fetch_assoc($result)) {
                    $sql = "DELETE FROM categories WHERE cat_id = $id";
                    if (mysqli_query($db, $sql)) {
                        echo "<div class='center'>";
                        echo "<div class="alert alert-primary" role="alert"><p>You have deleted the category succesfully.</p></div>";
                        echo "<div class='content-container'>";
                        echo 'Return to  <a href="index.php?id=) ">Home Page</a>.';
                        echo "</div>";


                        echo "</div>";
                    } else {
                        echo "Error deleting record: " . mysqli_error($conn);
                    }
                }
            }
        }

        ?>
    </div>
<!-- JQuery -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<!-- Popper JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<!-- Bootstrap Script -->
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<!-- MDB Script -->
	<script type="text/javascript" src="mdb-bootstrap-3.10.1/js/mdb.min.js"></script>
</body>

</html>