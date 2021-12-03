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
</head>
<!-- <style>
	* {
		margin: 0;
		padding: 0;
		outline: 0;
		font-size: 100%;
		vertical-align: baseline;
		background: transparent;
		font-family: Arial, Helvetica, sans-serif;

	}
</style> -->

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

			if ($_SERVER['REQUEST_METHOD'] != 'POST') {

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
				topic_id= " . mysqli_real_escape_string($db, $_GET['id']);

				$user_check_query = "SELECT * FROM users  LIMIT 1";
				$result = $db->query($sql);
				$result3 = $db->query($sqltopic);
				$result7 = $db->query($sql);

				if (!$result) {
					echo 'The categories could not be displayed, please try again later.';
				} else {
					if (mysqli_num_rows($result) == 0) {
						echo 'No categories defined yet.';
					} else {

						$name = $_SESSION['username'];

						$name = $_SESSION['username'];
						$user_check_query = "SELECT  * FROM users WHERE username ='$name'";
						$result2 = mysqli_query($db, $user_check_query);
						$user = mysqli_fetch_assoc($result2);
						$title = mysqli_fetch_assoc($result3);

						$likesql = "SELECT * FROM likes WHERE topic_id = " . $_GET['id'];
						$result4 = mysqli_query($db, $likesql);
						$liked = NULL;
						$id = $user['userID'];
						$topic = $_GET['id'];
						while ($row2 = mysqli_fetch_assoc($result4)) {
							if ($row2['userID'] == $user['userID']) {
								if ($row2['isLike'] == true) {
									$liked = true;
								} else if ($row2['isLike'] == false) {
									$liked = false;
								}
							}
						}


						if ($user['usertype'] == 1) {
							//prepare the table


							echo "<br>";
							echo '<center> <table border="1" > </center>
									<tr>
									<td class="bottomreply" colspan= "2">
									<center><h3> ' . $title['topic_subject'] . ' </h3></center>
									</td>';
							echo '<form method="POST" action="topic.php">';
							echo '<td>';
							if ($liked === true) {
								$outsql = "UPDATE likes 
                                SET 
                                    isLike = 0
                                WHERE
                                    userID = $id AND topic_id = $topic;";
								echo '<input type="hidden" name="like" value="' . $outsql . '" />';
								echo '<input type="hidden" name="id" value="' . $topic . '" />';
								echo '<input type="button" disabled value="Liked" />';
								echo '<input type="submit" value="Dislike" />';
							} else if ($liked === false) {
								$outsql = "UPDATE likes 
                                SET 
                                    isLike = 1
                                WHERE
                                    userID = $id AND topic_id = $topic;";
								echo '<input type="hidden" name="like" value="' . $outsql . '" />';
								echo '<input type="hidden" name="id" value="' . $topic . '" />';
								echo '<input type="submit" value="Like" />';
								echo '<input type="button" disabled value="Dislike" />';
							} else {
								$outsql = "INSERT INTO likes (`userID`, `topic_id`, `isLike`) VALUES
                                ($id, $topic, ";
								echo '<input type="hidden" name="like" value="' . $outsql . '" />';
								echo '<input type="hidden" name="topicID" value="' . $topic . '" />';
								echo '<input type="submit" name="liked" value="Like" />';
								echo '<input type="submit" name="dis" value="Dislike" />';
							}
							echo '</td>';
							echo '</form>';
							echo '</tr>';

							while ($row = mysqli_fetch_assoc($result)) {
								if ($_SERVER['REQUEST_METHOD'] != 'POST') {
									echo '<tr>';
									echo '<td class="leftpart">';
									echo '<h3>' . $row['username'] . '</h3>';
									echo '<br>' . '<h3>' . $row['post_date'] . '</h3>';
									echo '<td class="rightpart">';
									echo '<h3><p ">' . $row['post_content'] . '</p>';
									echo '</td>';
									echo '</tr>';
									echo '<tr>';

									echo '</tr>';
								} else {
									$sql = "INSERT INTO 
                    posts(post_content,
                          post_date,
                          post_topic,
                          post_by) 
                VALUES ('" . $_POST['reply-content'] . "',
                        NOW(),
                        " . mysqli_real_escape_string($db, $_GET['id']) . ",
                        " . $user['username'] . ")";

									$result = mysqli_query($db, $sql);

									if (!$result) {
										echo 'Your reply has not been saved, please try again later.';
									} else {
										echo 'Your reply has been saved, check out <a href="topic.php?id=' . htmlentities($_GET['id']) . '">the topic</a>.';
									}
								}
							}
							$row = mysqli_fetch_assoc($result7);
							echo '<td class="bottomreply" colspan= "2">';
							echo '<center>Reply:<br>';
							echo "<br>";
							echo '<form method="post" action="reply.php?id=' . $row['post_topic'] . '">
					   <textarea name="reply-content"></textarea>
					   <input type="submit" value="Submit reply" />
				   </form> ';
							echo '</td>';
							echo '</tr>';
						} else {
							//prepare the table

							echo "<br>";
							echo '<center> <table border="1" > </center>
			  <tr>
			  <td class="bottomreply" colspan= "2">
			  <center><h3> ' . $title['topic_subject'] . ' </h3></center>
			  </td>';

							echo '<form method="POST" action="topic.php?=' . $topic . '">';
							echo '<td>';
							if ($liked === true) {
								$outsql = "UPDATE likes 
                                SET 
                                    isLike = 0
                                WHERE
                                    userID = $id AND topic_id = $topic;";
								echo '<input type="hidden" name="like" value="' . $outsql . '" />';
								echo '<input type="hidden" name="id" value="' . $topic . '" />';
								echo '<input type="button" disabled value="Liked" />';
								echo '<input type="submit" value="Dislike" />';
							} else if ($liked === false) {
								$outsql = "UPDATE likes 
                                SET 
                                    isLike = 1
                                WHERE
                                    userID = $id AND topic_id = $topic;";
								echo '<input type="hidden" name="like" value="' . $outsql . '" />';
								echo '<input type="hidden" name="id" value="' . $topic . '" />';
								echo '<input type="submit" value="Like" />';
								echo '<input type="button" disabled value="Disliked" />';
							} else {
								$outsql = "INSERT INTO likes (`userID`, `topic_id`, `isLike`) VALUES
                                ($id, $topic, ";
								echo '<input type="hidden" name="like" value="' . $outsql . '" />';
								echo '<input type="hidden" name="id" value="' . $topic . '" />';
								echo '<input type="submit" name="liked" value="Like" />';
								echo '<input type="submit" name="dis" value="Dislike" />';
							}
							echo '</td>';
							echo '</form>';
							echo '</tr>';
							while ($row = mysqli_fetch_assoc($result)) {
								if ($_SERVER['REQUEST_METHOD'] != 'POST') {
									echo '<tr>';
									echo '<td class="leftpart">';
									echo '<h3>' . $row['username'] . '</h3>';
									echo '<br>' . '<h3>' . $row['post_date'] . '</h3>';
									echo '<td class="rightpart">';
									echo '<h3><p ">' . $row['post_content'] . '</p>';
									echo '</td>';
									echo '</tr>';
									echo '<tr>';
								} else {
									$sql = "INSERT INTO 
				posts(post_content,
					  post_date,
					  post_topic,
					  post_by) 
			VALUES ('" . $_POST['reply-content'] . "',
					NOW(),
					" . mysqli_real_escape_string($db, $_GET['id']) . ",
					" . $user['username'] . ")";

									$result = mysqli_query($db, $sql);

									if (!$result) {
										echo 'Your reply has not been saved, please try again later.';
									} else {
										echo 'Your reply has been saved, check out <a href="topic.php?id=' . htmlentities($_GET['id']) . '">the topic</a>.';
									}
								}
							}
							$row = mysqli_fetch_assoc($result7);
							echo '<td class="bottomreply" colspan= "2">';
							echo '<center>Reply:<br>';
							echo "<br>";
							echo '<form method="post" action="reply.php?id=' . $row['post_topic'] . '">
					<textarea name="reply-content"></textarea>
					<input type="submit" value="Submit reply" />
				</form> ';
							echo '</td>';
							echo '</tr>';
						}
					}
				}
			} else {
				$db = mysqli_connect('localhost', 'root', '', 'movieforumdb');
				if (isset($_POST['liked'])) {
					$outsql = $_POST['like'] . "true)";
					$topicID = $_POST['id'];
					echo "Liked <br>";
					echo 'Return to<a href="topic.php?id=' . htmlentities($topicID) . '"> topic</a>.';
				} else if (isset($_POST['dis'])) {
					$outsql = $_POST['like'] . "false)";
					$topicID = $_POST['id'];
					echo "Disliked <br>";
					echo 'Return to<a href="topic.php?id=' . htmlentities($topicID) . '"> topic</a>.';
				} else {
					$outsql = $_POST['like'];
					$topicID = $_POST['id'];
					echo "Updated <br>";
					echo 'Return to<a href="topic.php?id=' . htmlentities($topicID) . '"> topic</a>.';
				}
				$out = mysqli_query($db, $outsql);
			}
			?>
		</div>
	</div>

</body>

</html>