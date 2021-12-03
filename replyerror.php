<?php
// initializing variables


$db = mysqli_connect('localhost', 'root', '', 'movieforumdb');
$reply = "";
$description = "";
$query = "SELECT * FROM posts";
$errors = array();
$results = mysqli_query($db, $query);
if (isset($_POST['reply-content'])) {
  $reply = mysqli_real_escape_string($db, $_POST['reply-content']);
  if (empty($reply) && empty($description)) {
    array_push($errors, "Please enter a message ");
  }

}
