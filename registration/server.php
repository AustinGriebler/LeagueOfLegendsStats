<?php
session_start();

// initializing variables
$username = "";
$id = "";
$errors = array();

$ini = parse_ini_file($_SERVER["DOCUMENT_ROOT"] . "/finalproject/config.ini");
$user = $ini['user'];
$pass = $ini['pass'];
$name = $ini['name'];
$host = $ini['host'];

// connect to the database
$db = mysqli_connect($host, $name, $pass, $user);

// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
  }

  // first check the database to make sure
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM users WHERE username='$username' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);

  if ($user) { // if user exists
    if ($user['username'] === $username) {
      array_push($errors, "Username already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$password = password_hash($password_1, PASSWORD_BCRYPT);//encrypt the password before saving in the database
  	$user_query = "INSERT INTO users (username, password)
  			  VALUES('$username', '$password')";
  	$suer_result = mysqli_query($db, $user_query);

    $id_query = "SELECT id FROM users WHERE username='$username'";
    $id_result = mysqli_query($db, $id_query);
    $id = mysqli_fetch_assoc($id_result)['id'];

  	$_SESSION['username'] = $username;
    $_SESSION['id'] = $id;
    header('Location: ../index.php');
  }
}


// LOGIN USER
if (isset($_POST['login_user'])) {
  $hashed_password = "";
  $id = "";
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($username)) {
  	array_push($errors, "Username is required");
  }
  if (empty($password)) {
  	array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {
    $stmt = mysqli_prepare($db, "SELECT password, id FROM users WHERE username = ?");
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $hashed_password, $id);
    mysqli_stmt_fetch($stmt);

  	if (password_verify($password, $hashed_password)) {
  	  $_SESSION['username'] = $username;
      $_SESSION['id'] = $id;
      header('Location: ../index.php');
  	}else {
  		array_push($errors, "Wrong username/password combination");
  	}
  }
}


?>
