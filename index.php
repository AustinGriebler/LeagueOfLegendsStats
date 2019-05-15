<?php
  session_start();
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['id']);
    unset($_SESSION['username']);
  	header("location: index.php");
  }
?>
<!doctype html>
<html class="no-js" lang="en">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>League of Legends Stats</title>
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

<div class="grid-container">
  <div class="grid-x align-middle align-center vertical-container">
    <div class="cell medium-4 shrink">
      <div class="grid-x">
        <div class="cell">
          <img id="logo" src="images/leaguelogo.png">
        </div>
      </div>
        <div class="grid-x">
          <div class="cell">
            <form id="usernameform" class="input-group">
              <input class="input-group-field" type="text" placeholder="Search for Summoner Name">
              <div class="input-group-button">
                <button type="submit" class="button">Search</button>
              </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.5.3/js/foundation.min.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="index.js" type="module"></script>
<script crossorigin="anonymous" src="https://polyfill.io/v3/polyfill.min.js?features=es6"></script>
<script>
      $(document).foundation();
</script>
</body>
</html>
