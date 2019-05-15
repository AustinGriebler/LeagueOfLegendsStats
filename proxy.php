<?php
session_start();

define('INI', parse_ini_file($_SERVER["DOCUMENT_ROOT"] . "/finalproject/config.ini"));
$db_user = INI['user'];
$db_pass = INI['pass'];
$db_name = INI['name'];
$db_host = INI['host'];

// connect to the database
$db = mysqli_connect($db_host, $db_name, $db_pass, $db_user);

$input = json_decode(file_get_contents("php://input"), true);

if($input['action']){
  //create output variable
  $output;

  if ($input['action'] === 'updateSummoner') {
    $output = updateSummoner($input['name']);
  } else if ($input['action'] === 'getRank') {
    $output = getRank($input['name']);
  }

  echo $output;
}

// Input: Summoner Name (String)
function updateSummoner($name) {
  $id = $_SESSION['id'];
  $data = getSummoner($name);

  $sql = "INSERT INTO summonerdata (Data, UserID)
          VALUES ('{$file}', {$id})
          ON DUPLICATE KEY UPDATE Data = '{$data}'";

  $db->query($sql);
}

// Input: Summoner Name (String)
// Output: Summoner Account Data (String)
function getSummoner($name) {
  $opts = array(
    'http'=>array(
      'method'=>"GET",
      'header'=>'X-Riot-Token: ' . INI['API_KEY']
    )
  );

  $context = stream_context_create($opts);

  // Open the file using the HTTP headers set above
  $file = file_get_contents("https://na1.api.riotgames.com/lol/summoner/v4/summoners/by-name/{$name}", false, $context);

  return $file;
}

// Input: Summoner Name (String)
// Output: Summoner Ranked Data (String)
function getRank($name) {
  $datastr = getSummoner($name);
  $data = json_decode($datastr, true);
  $summonerID = $data['id'];

  // Make call to API using Summoner
  $opts = array(
    'http'=>array(
      'method'=>"GET",
      'header'=>'X-Riot-Token: ' . INI['API_KEY']
    )
  );
  $context = stream_context_create($opts);
  $file = file_get_contents("https://na1.api.riotgames.com/lol/league/v4/entries/by-summoner/{$summonerID}", false, $context);

  return $file;
}

function getMatch($name){
  $matchID =

  $opts = array(
    'http'=>array(
      'method'=>"GET",
      'header'=>'X-Riot-Token: ' . INI['API_KEY']
    )
  );
  $context = stream_context_create($opts);
  $file = file_get_contents("https://na1.api.riotgames.com/lol/match/v4/matches/{$matchID}", false, $context);

  return $file;
}
?>
