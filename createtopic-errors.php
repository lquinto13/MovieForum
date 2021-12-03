<?php
// initializing variables


$db = mysqli_connect('localhost', 'root', '', 'movieforumdb');
$top_subject = "";
$top_content = "";
$query = "SELECT * FROM topics";
$errors = array();
$results = mysqli_query($db, $query);
if (isset($_POST['create-topic'])) {
  $top_subject = mysqli_real_escape_string($db, $_POST['topic_subject']);
  $top_content = mysqli_real_escape_string($db, $_POST['post_content']);

  if (empty($top_subject) && empty($top_content)) {
    array_push($errors, "Please enter a subject and message ");
  }
  else if (empty($top_subject)) {
    array_push($errors, "Please enter a subject ");
  }

  else if (empty($top_content)) {
    array_push($errors, "Please enter a messsage ");
  }

}
