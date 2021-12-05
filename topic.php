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

	<!-- Bootstrap -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<!-- MDB Style -->
	<link rel="stylesheet" href="mdb-bootstrap-3.10.1/css/mdb.min.css" />
	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" />
	<!-- Custom Styles -->
	<link rel="stylesheet" href="css/style.css" />
	<link rel="stylesheet" href="css/topic.css" />
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
				<i class="fas fa-film logo-title"></i>
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
					echo '	<div class="alert alert-danger" role="alert" style="margin: 1%">
								<i class="fas fa-exclamation-circle"></i> The categories could not be displayed, please try again later.
							</div>';
				} else {
					if (mysqli_num_rows($result) == 0) {
						echo '	<div class="alert alert-danger" role="alert" style="margin: 1%">
									<i class="fas fa-exclamation-circle"></i> No categories defined yet.
								</div>';
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

							echo '	<div class="row">
										<div class="col-md-3">
										</div>

										<div class="col-md-6">';
							echo '<center> <h1 class="rounded" id = "title-style">' . $title['topic_subject'] . '</h1> </center>';
							echo '<form method="POST" action="topic.php">';
							if ($liked === true) {
								$outsql = "UPDATE likes 
                                SET 
                                    isLike = 0
                                WHERE
                                    userID = $id AND topic_id = $topic;";
								echo '<input type="hidden" name="like" value="' . $outsql . '" />';
								echo '<input type="hidden" name="id" value="' . $topic . '" />';
								echo '<center>';
								echo '<input class="btn btn-dark like-button" type="button" disabled value="Liked" />';
								echo '<input class="btn btn-danger" type="submit" value="Dislike" />';
								echo '</center>';
							} else if ($liked === false) {
								$outsql = "UPDATE likes 
                                SET 
                                    isLike = 1
                                WHERE
                                    userID = $id AND topic_id = $topic;";
								echo '<input type="hidden" name="like" value="' . $outsql . '" />';
								echo '<input type="hidden" name="id" value="' . $topic . '" />';
								echo '<center>';
								echo '<input class="btn btn-success like-button" type="submit" value="Like" />';
								echo '<input class="btn btn-dark" type="button" disabled value="Dislike" />';
								echo '</center>';
							} else {
								$outsql = "INSERT INTO likes (`userID`, `topic_id`, `isLike`) VALUES
                                ($id, $topic, ";
								echo '<input type="hidden" name="like" value="' . $outsql . '" />';
								echo '<input type="hidden" name="id" value="' . $topic . '" />';
								echo '<center>';
								echo '<input class="btn btn-success like-button" type="submit" name="liked" value="Like" />';
								echo '<input class="btn btn-danger" type="submit" name="dis" value="Dislike" />';
								echo '</center>';
							}
							echo '</form>';

							echo '		</div>
							
										<div class="col-md-3">
										</div>
									</div>';

							//prepare the table

							echo '	<div class="rounded reply-card-container col-md-12">';

							while ($row = mysqli_fetch_assoc($result)) {
								if ($_SERVER['REQUEST_METHOD'] != 'POST') {
									echo '
										<div class="inner-main-body p-2 p-sm-3">
											<div class="card mb-1">
												<div class="card-body p-2 p-sm-3">
													<div class="media">
														<div class="media-body">
															<h5 class="text-body">' . $row['username'] . '</h5>
															<p class="reply-text">'
															. $row['post_content'] .
															'</p>
															<p class="text-muted">sent on <span class="reply-text font-weight-bold">' . $row['post_date'] . '</span></p>
														</div>
													</div>
												</div>
											</div>
										</div>';
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
										echo '	<div class="alert alert-danger" role="alert" style="margin: 1%">
													<i class="fas fa-exclamation-circle"></i> Your reply has not been saved, please try again later.
												</div>';
									} else {
										echo '	<div class="alert alert-success" role="alert" style="margin: 1%">
													Your reply has been saved, check out <a href="topic.php?id=' . htmlentities($_GET['id']) . '">the topic</a>.
												</div>';
									}
								}
							}
							echo ' </div>';

							$row = mysqli_fetch_assoc($result7);

							echo '	<form class="create-reply-form" method="post" action="reply.php?id=' . $row['post_topic'] . '">
										<div class="form-outline mb-2">
											<textarea class="form-control create-reply-textarea" id="reply-content" name="reply-content" rows="8"></textarea>
											<label class="form-label" for="reply-content">Reply</label>
										</div>
										<input class="btn btn-primary btn-lg btn-block" type="submit" value="Submit reply" />
									</form> ';

						} else {

							echo '	<div class="row">
										<div class="col-md-3">
										</div>

										<div class="col-md-6">';
							echo '<center> <h1 class="rounded" id = "title-style">' . $title['topic_subject'] . '</h1> </center>';

							echo '<form method="POST" action="topic.php?=' . $topic . '">';
							if ($liked === true) {
								$outsql = "UPDATE likes 
                                SET 
                                    isLike = 0
                                WHERE
                                    userID = $id AND topic_id = $topic;";
								echo '<input type="hidden" name="like" value="' . $outsql . '" />';
								echo '<input type="hidden" name="id" value="' . $topic . '" />';
								echo '<center>';
								echo '<input class="btn btn-dark like-button" type="button" disabled value="Liked" />';
								echo '<input class="btn btn-danger" type="submit" value="Dislike" />';
								echo '</center>';
							} else if ($liked === false) {
								$outsql = "UPDATE likes 
                                SET 
                                    isLike = 1
                                WHERE
                                    userID = $id AND topic_id = $topic;";
								echo '<input type="hidden" name="like" value="' . $outsql . '" />';
								echo '<input type="hidden" name="id" value="' . $topic . '" />';
								echo '<center>';
								echo '<input class="btn btn-success like-button" type="submit" value="Like" />';
								echo '<input class="btn btn-dark" type="button" disabled value="Disliked" />';
								echo '</center>';
							} else {
								$outsql = "INSERT INTO likes (`userID`, `topic_id`, `isLike`) VALUES
                                ($id, $topic, ";
								echo '<input type="hidden" name="like" value="' . $outsql . '" />';
								echo '<input type="hidden" name="id" value="' . $topic . '" />';
								echo '<center>';
								echo '<input class="btn btn-success like-button" type="submit" name="liked" value="Like" />';
								echo '<input class="btn btn-danger" type="submit" name="dis" value="Dislike" />';
								echo '</center>';
							}
							echo '</form>';

							echo '		</div>
							
										<div class="col-md-3">
										</div>
									</div>';

							//prepare the table

							echo '	<div class="rounded reply-card-container col-md-12">';

							while ($row = mysqli_fetch_assoc($result)) {
								if ($_SERVER['REQUEST_METHOD'] != 'POST') {
									echo '
										<div class="inner-main-body p-2 p-sm-3">
											<div class="card mb-1">
												<div class="card-body p-2 p-sm-3">
													<div class="media">
														<div class="media-body">
															<h5 class="text-body">' . $row['username'] . '</h5>
															<p class="reply-text">'
															. $row['post_content'] .
															'</p>
															<p class="text-muted">sent on <span class="reply-text font-weight-bold">' . $row['post_date'] . '</span></p>
														</div>
													</div>
												</div>
											</div>
										</div>';
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
										echo '	<div class="alert alert-danger" role="alert" style="margin: 1%">
													<i class="fas fa-exclamation-circle"></i> Your reply has not been saved, please try again later.
												</div>';
									} else {
										echo '	<div class="alert alert-success" role="alert" style="margin: 1%">
													Your reply has been saved, check out <a href="topic.php?id=' . htmlentities($_GET['id']) . '">the topic</a>.
												</div>';
									}
								}
							}
							echo ' </div>';
							
							$row = mysqli_fetch_assoc($result7);

							echo '	<form class="create-reply-form" method="post" action="reply.php?id=' . $row['post_topic'] . '">
										<div class="form-outline mb-2">
											<textarea class="form-control create-reply-textarea" id="reply-content" name="reply-content" rows="8"></textarea>
											<label class="form-label" for="reply-content">Reply</label>
										</div>
										<input class="btn btn-primary btn-lg btn-block" type="submit" value="Submit reply" />
									</form> ';

						}
					}
				}
			} else {
				$db = mysqli_connect('localhost', 'root', '', 'movieforumdb');
				if (isset($_POST['liked'])) {
					$outsql = $_POST['like'] . "true)";
					$topicID = $_POST['id'];
					echo '	<div class="alert alert-success" role="alert" style="margin: 1%">
								Liked
							</div>';
					echo '	<div class="alert alert-primary" role="alert" style="margin: 1%">
								Return to<a href="topic.php?id=' . htmlentities($topicID) . '"> topic</a>.
							</div>';
				} else if (isset($_POST['dis'])) {
					$outsql = $_POST['like'] . "false)";
					$topicID = $_POST['id'];
					echo '	<div class="alert alert-danger" role="alert" style="margin: 1%">
								Disliked
							</div>';
					echo '	<div class="alert alert-primary" role="alert" style="margin: 1%">
								Return to<a href="topic.php?id=' . htmlentities($topicID) . '"> topic</a>.
							</div>';
				} else {
					$outsql = $_POST['like'];
					$topicID = $_POST['id'];
					echo '	<div class="alert alert-info" role="alert" style="margin: 1%">
								Updated 
							</div>';
					echo '	<div class="alert alert-primary" role="alert" style="margin: 1%">
								Return to<a href="topic.php?id=' . htmlentities($topicID) . '"> topic</a>.
							</div>';
				}
				$out = mysqli_query($db, $outsql);
			}
			?>
		</div>
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