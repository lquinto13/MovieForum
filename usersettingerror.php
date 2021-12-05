<?php
// initializing variables
$username = "";
$email    = "";
$password_1 = "";
$password_2 = "";
$errors = array();

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'movieforumdb');
$type = mysqli_real_escape_string($db, $_POST['type']);

$query = "SELECT * FROM users WHERE userID = '$type'";
$results = mysqli_query($db, $query);
$row = mysqli_fetch_assoc($results);


if (isset($_POST['type'])) {
  // receive all input values from the form
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

  if (empty($username) && empty($email)) {
    $_POST['username'] = $row['username'];
    $_POST['email'] = $row['email'];
  }
  if (empty($email)) {
    $_POST['email'] = $row['email'];
  }
  if (empty($username)) {
    $_POST['username'] = $row['username'];
  }

  if (empty($password_1)) {
    $_POST['password_1'] = $row['password'];
  }

  if (empty($password_2)) {
    $_POST['password_2'] = $row['password'];
  }

  if ($password_1 != $password_2) {
    array_push($errors, "The two passwords do not match");
  }



  $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' OR usertype = '$type' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);

  $sql_u = "SELECT * FROM users WHERE username='$username'";
  $sql_e = "SELECT * FROM users WHERE email='$email'";
  $res_u = mysqli_query($db, $sql_u);
  $res_e = mysqli_query($db, $sql_e);

  if (mysqli_num_rows($res_u) > 0) {
    array_push($errors, "Username already exists");
  } else if (mysqli_num_rows($res_e) > 0) {
    array_push($errors, "Email already exists");
  }

  /*
  if ($user) { // if user exists
    if ($user['username'] === $username) {
      array_push($errors, "Username already exists");
    }

    if ($user['email'] === $email) {
      array_push($errors, "Email already exists");
    }
  }*/
}
