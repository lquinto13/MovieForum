<?php
// initializing variables


$db = mysqli_connect('localhost', 'root', '', 'movieforumdb');
$category = "";
$description = "";
$query = "SELECT * FROM categories";
$errors = array();
$results = mysqli_query($db, $query);
if (isset($_POST['create-cat'])) {
  $category = mysqli_real_escape_string($db, $_POST['cat_name']);
  $description = mysqli_real_escape_string($db, $_POST['cat_description']);
  if (empty($category) && empty($description)) {
    array_push($errors, "Please input a category name ");
    array_push($errors, "Please input a category description ");
  }


  $sql_u = "SELECT * FROM categories WHERE cat_name='$category'";
  $res_u = mysqli_query($db, $sql_u);

  if (mysqli_num_rows($res_u) > 0) {
    array_push($errors, "Category exists create a new one please");
  }
}
