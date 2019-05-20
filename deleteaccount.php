<?php
include('db.php');
session_start();

$id = $_SESSION['id'];

// connect to the database
$db = mysqli_connect($host, $name, $pass, $user);
  if($db === false){
      die("ERROR: Could not connect. " . mysqli_connect_error());
  }
  if(isset($_SESSION['id'])){
  $sql = "DELETE FROM users WHERE id='$id'";

  if(mysqli_query($db, $sql)){
      echo "Record was deleted successfully.";
  }
  else{
      echo "ERROR: Could not able to execute $sql. "
                                     . mysqli_error($db);
  }
}
mysqli_close($db);
session_destroy();
unset($_SESSION['id']);
unset($_SESSION['username']);
header("Location:index.php");
?>
