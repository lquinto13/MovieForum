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
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/table.css">
</head>

<body>
	<div class="d-flex" id="wrapper">
		<!-- Sidebar-->
		<div class="bg-dark border-right" id="sidebar-wrapper">
			<div class="sidebar-heading" id="sidebar-heading">
				<i class="fas fa-film" style="padding-right: 5px; color: #FF8FAB;"></i>
				<strong>MOVIE FORUM</strong>
			</div>
			<div class="list-group list-group-flush" id="button-sidebar">
				<a type="button" href="/movieforum/index.php" class="list-group-item list-group-item-action bg-dark">HOME
					<i class="fa fa-home fa-2x button-icon "></i>
				</a>

				<div class="dropdown">
					<button class="list-group-item list-group-item-action bg-dark dropdown-toggle" type="button" data-toggle="collapse" data-target="#contentManagement" aria-controls="contentManagement" aria-expanded="false" id="content-management-button">CONTENT MANAGEMENT
						<i class="fa fa-cubes fa-2x button-icon" aria-hidden="true"></i>
					</button>

					<div class="collapse" id="contentManagement">
						<a type="button" href="/movieforum/create_cat.php" class="list-group-item list-group-item-action bg-dark">CREATE A CATEGORY</a>
						<a type="button" href="/movieforum/create_topic.php" class="list-group-item list-group-item-action bg-dark">CREATE A TOPIC</a>
					</div>
				</div>

				<a type="button" href="/movieforum/about_us.php" class="list-group-item list-group-item-action bg-dark">ABOUT US
					<i class="fas fa-address-card fa-2x button-icon"></i>
				</a>

				<button class="list-group-item list-group-item-action bg-dark logout-sidebar-button" onclick="location.href='index.php?logout=\'1\''">
					LOGOUT
					<i class="fa fa-power-off fa-2x button-icon"></i>
				</button>
			</div>
		</div>

		<!-- Page content wrapper-->
		<div id="page-content-wrapper">
			<?php include 'header.php' ?>
			<!-- Page content-->
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

			if (!$result) {
				echo 'The categories could not be displayed, please try again later.';
			} else {
				if (mysqli_num_rows($result) == 0) {
					echo 'No categories defined yet.';
				} else {
					$name = $_SESSION['username'];
					$user_check_query = "SELECT  * FROM users WHERE username ='$name'";
					$result2 = mysqli_query($db, $user_check_query);
					$user = mysqli_fetch_assoc($result2);
					$querytop = mysqli_query($db, $sqltop);
					$last_id = mysqli_insert_id($db);

					if ($user['usertype'] == 1) {
						//prepare the table
						echo '	<div class="rounded table-with-FixHead table-bordered">
										<table class="table table-bordered table-striped table-dark text-center">
											<thead>
												<tr>
													<th scope="col"><h4>Category</h4></th>
													<th scope="col"><h4>Description</h4></th>
													<th scope="col"><h4>Action</h4></th>
												</tr>
											</thead>';

						while ($row = mysqli_fetch_assoc($result)) {
							$row2 = mysqli_fetch_assoc($result3);
							echo '<tbody>
										<tr>
											<td>';
							echo '			<h3><a href="category.php?id=' . $row['cat_id'] . '">' . strtoupper($row['cat_name']) . '</a></h3>' . '<td><h5>' . strtoupper($row['cat_description']) . '</h5></td>';
							echo '		<td>
												<form method = "POST" action="delete.php?id =">
												<button type="submit" name = "delete"  value = ' . $row['cat_id'] . ' class="btn btn-danger">DELETE</button>
												</form>
											</td>
										</tr>';
						}
					} else {
						echo '	<div class="rounded table-with-FixHead table-bordered">
										<table class="table table-bordered table-striped table-dark text-center">
											<thead>
												<tr>
													<th scope="col"><h4>Category</h4></th>
													<th scope="col"><h4>Description</h4></th>
												</tr>
											</thead>';

						while ($row = mysqli_fetch_assoc($result)) {
							$row2 = mysqli_fetch_assoc($result3);
							echo '<tbody>
										<tr>
											<td>';
							echo '			<h3><a href="category.php?id=' . $row['cat_id'] . '">' . strtoupper($row['cat_name']) . '</a></h3>' . '<td><h5>' . strtoupper($row['cat_description']) . '</h5></td>';
							echo '	</tr>';
						}
					}
				}
			}
			?>
		</div>
	</div>
</body>

</html>