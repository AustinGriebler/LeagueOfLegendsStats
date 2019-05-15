<?php include('proxy.php');

  if(isset($_GET['summonerName'])){
    $datastr = getRank($_GET['summonerName']);
    $data = json_decode($datastr, true);
    $flex = $data[0];
    $solo = $data[1];

    if($flex == false){
      echo "unranked";
    };
    if($solo == false){
      echo "unranked";
    };
  }

  $ini = parse_ini_file($_SERVER["DOCUMENT_ROOT"] . "/finalproject/config.ini");
  $user = $ini['user'];
  $pass = $ini['pass'];
  $name = $ini['name'];
  $host = $ini['host'];
  $id = $_SESSION['id'];

  // connect to the database
  $db = mysqli_connect($host, $name, $pass, $user);

  $data_query = "SELECT Data FROM summonerdata WHERE UserID='$id' LIMIT 1";
  $data_result = mysqli_query($db, $data_query);
  $data_fetch = mysqli_fetch_assoc($data_result)['Data'];

  $data_decode = json_decode($data_fetch, true);

 ?>
<!doctype html>
<html class="no-js" lang="en">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>League of Legends Stats</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.5.3/css/foundation.min.css">
<link rel="stylesheet" href="master.css">
<script>
  window.summonerName = "<?php echo $solo['summonerName']; ?>"
</script>
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
    <div class="grid-x grid-margin-x">
      <div class="cell shrink">
        <div class="grid-x">
          <div class="cell">
            <!-- Summoner name and level -->
            <div class="grid-x">
              <div class="cell">
                <h3><?php echo $solo['summonerName'];?></h3>
                <p> Summoner Level: <?php echo $data_decode['summonerLevel']; ?></p>
              </div>
            </div>
            <!-- Solo ranked info -->
            <div class="grid-x">
              <div class="cell">
                <div class="card" style="width: 250px; border-color: gray;">
                  <div class="card-divider">
                    <h4> Ranked Solo </br></h4>
                  </div>
                  <div class="card-section">
                    <strong><?php echo $solo['tier']; echo ' '; echo $solo['rank'];?></strong>
                    <p> Wins: <?php echo $solo['wins']; ?></p>
                    <p> Losses: <?php echo $solo['losses']; ?> </p>
                    <p> LP: <?php echo $solo['leaguePoints']; ?></p>
                  </div>
                </div>
              </div>
            </div>
            <!-- Flex ranked info -->
            <div class="grid-x">
              <div class="cell">
                <div class="card" style="width: 250px; border-color: gray;">
                  <div class="card-divider">
                    <h4> Ranked Flex </br></h4>
                  </div>
                  <div class="card-section">
                    <strong><?php echo $flex['tier']; echo ' '; echo $flex['rank'];?></strong>
                    <p> Wins: <?php echo $flex['wins']; ?></p>
                    <p> Losses: <?php echo $flex['losses']; ?></p>
                    <p> LP: <?php echo $flex['leaguePoints']; ?></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="cell auto">
        <div id="champion-mastery-container" class="grid-x grid-margin-x"></div>
      </div>
    </div>
  </div>
</div>
<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.5.3/js/foundation.min.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="summoner.js" type="module"></script>
<script src="index.js" type="module"></script>
<script crossorigin="anonymous" src="https://polyfill.io/v3/polyfill.min.js?features=es6"></script>
<script>
      $(document).foundation();
    </script>
</body>
</html>
