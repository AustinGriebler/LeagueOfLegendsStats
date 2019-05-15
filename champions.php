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
  <div class="grid-x align-middle align-center">
    <div class="cell small-12">
      <ul class="tabs" data-tabs id="champion-tabs">
        <li class="tabs-title is-active"><a href="#champion-panel-all" aria-selected="true">All</a></li>
        <li class="tabs-title"><a href="#champion-panel-fighter">Fighter</a></li>
        <li class="tabs-title"><a href="#champion-panel-tank">Tank</a></li>
        <li class="tabs-title"><a href="#champion-panel-mage">Mage</a></li>
        <li class="tabs-title"><a href="#champion-panel-assassin">Assassin</a></li>
        <li class="tabs-title"><a href="#champion-panel-support">Support</a></li>
        <li class="tabs-title"><a href="#champion-panel-marksman">Marksman</a></li>
      </ul>
    </div>
    <div class="cell small-12">
      <div class="tabs-content" data-tabs-content="champion-tabs">
        <div class="tabs-panel is-active" id="champion-panel-all">
          <div class="grid-x grid-margin-x" id="champion-container-all"></div>
        </div>
        <div class="tabs-panel" id="champion-panel-fighter">
          <div class="grid-x grid-margin-x" id="champion-container-Fighter"></div>
        </div>
        <div class="tabs-panel" id="champion-panel-tank">
          <div class="grid-x grid-margin-x" id="champion-container-Tank"></div>
        </div>
        <div class="tabs-panel" id="champion-panel-mage">
          <div class="grid-x grid-margin-x" id="champion-container-Mage"></div>
        </div>
        <div class="tabs-panel" id="champion-panel-assassin">
          <div class="grid-x grid-margin-x" id="champion-container-Assassin"></div>
        </div>
        <div class="tabs-panel" id="champion-panel-support">
          <div class="grid-x grid-margin-x" id="champion-container-Support"></div>
        </div>
        <div class="tabs-panel" id="champion-panel-marksman">
          <div class="grid-x grid-margin-x" id="champion-container-Marksman"></div>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.5.3/js/foundation.min.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="champions.js" type="module"></script>
<script crossorigin="anonymous" src="https://polyfill.io/v3/polyfill.min.js?features=es6"></script>
<script>
      $(document).foundation();
    </script>
</body>
</html>
