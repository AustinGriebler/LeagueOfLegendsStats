<?php
    session_start();
    $ini = parse_ini_file($_SERVER["DOCUMENT_ROOT"] . "/finalproject/config.ini");
    $user = $ini['user'];
    $pass = $ini['pass'];
    $name = $ini['name'];
    $host = $ini['host'];

    // connect to the database
    $db = mysqli_connect($host, $name, $pass, $user);
    // Is the user logged in?
    if(!isset($_SESSION['id']) || !isset($_SESSION['username'])){
        header('Location: registration/login.php');
    }

    // Did the user submit the form?
    if(!empty($_POST)) {
      // Process the form
      $id=$_SESSION['id'];
      $newUsername = mysqli_real_escape_string($db,$_POST['newUsername']);

      if($newUsername!=""):
        $fetch=$db->query("UPDATE users SET username = '$newUsername' WHERE id='$id'");
        $_SESSION['username']=$newUsername;

      else:
        $error = "You have entered an empty string";
      endif;
    }
?>
<!doctype html>
<html class="no-js" lang="en">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Change Password</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.5.3/css/foundation.min.css">
<link rel="stylesheet" href="master.css">
</head>
<body>
  <div class="top-bar">
    <div class="top-bar-left">
      <ul class="menu">
        <img id="leaguelogo" src="images/leaguelogosmall.png">
          <li class="menu-text">League of Legends</li>
        </ul>
      </div>
      <div class="top-bar-right">
        <ul class="dropdown menu" data-dropdown-menu>
          <li><a href="index.php">Home</a></li>
          <li><a href="champions.php">Champions</a></li>
          <?php if(isset($_SESSION['id'])): ?>
          <li>
            <a href="#"><?php echo $_SESSION['username']; ?></a>
            <ul class="menu vertical">
              <li><a href="account.php">Account</a></li>
              <li><a href="index.php?logout='1'">Logout</a></li>
            </ul>
          </li>
          <?php else: ?>
          <li>
            <a href="registration/login.php">Login</a>
            <ul class="menu vertical">
              <li><a href="registration/register.php">Register</a><li>
            </ul>
          </li>
          <?php endif ?>
        </ul>
      </div>
  </div>

<form method="post" action="changeusername.php">
  <?php if(isset($error)): ?>
            <h2><?php echo $error; ?></h2>
        <?php endif; ?>
  <div class="grid-container">
    <div class="grid-x align-middle align-center vertical-container">
      <div class="cell medium-4 shrink">
          <div class="grid-x">
            <div class="cell">
                <div class="cell small-4">
                  <label>Username
                    <input value="<?php echo $_SESSION['username'];?>" type="text" name="newUsername" placeholder="New Username" id="newUsername" required >
                  </label>
                </div>
                <div class="cell">
                  <button type="submit" class="expanded button" name="submit">Change Username</button>
                </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>
<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.5.3/js/foundation.min.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="../index.js" type="module"></script>
<script crossorigin="anonymous" src="https://polyfill.io/v3/polyfill.min.js?features=es6"></script>
<script>
  $(document).foundation();
</script>
</body>
</html>
